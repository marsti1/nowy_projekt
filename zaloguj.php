<?php

	session_start();
	
	//dane do dostępu do bazy danych
	$host = 'localhost';
	$baza = 'baza_firm';
	$uzytkownik = 'root';
	$haslo = '';

	//funkcja logująca
	function checkPass($user, $pass)
	{
		//dostęp do zmiennych globalnych
		global $host, $baza, $uzytkownik, $haslo;

		//sprawdzenie długości przekazanych ciągów
		$userNameLength = mb_strlen($user, 'UTF-8');
		$userPassLength = mb_strlen($pass, 'UTF-8');

		if ($userNameLength < 3 || $userNameLength >20 || $userPassLength < 3 || $userPassLength > 40) 
		{
			return 2;
			echo "error";
		}

		//połącz z serwerem MYSQL

		$db_obj = new mysqli($host, $uzytkownik, $haslo, $baza);

		if ($db_obj->connect_errno)
		 {
			//wystąpił błąd podczas połączenia
			//echo $db_obj->connect_error
			return 1;
		 }

		//zabezpieczenie znaków specjalnych w parametrach
		$user = $db_obj->real_escape_string($user);
		$pass = $db_obj->real_escape_string($pass);

		//zapytanie sprawdzające poprawność danych
		$query ="SELECT haslo FROM users WHERE nazwa='$user' OR email='$user'";

		if (!$result = $db_obj->query($query)) 
		{
			//echo "Nieprawidłowe zapytanie";
			$db_obj->close();
			return 1;
		}

		//sprawdzenie wyników zapytania
		if($result->num_rows <> 1)
		{
			//brak użytkowników o tej nazwie lub zbyt wiele wyników
			$result = 2;
		}
		else
		{
			$row = $result->fetch_row();
			$pass_db =$row[0];
			//wersja testowa bez kodowania hasel
			//if ($pass != $pass_db) {
				//wersja docelowa z kodowaniem haseł
			if (crypt($pass, $pass_db) !=$pass_db) {
					
				$result = 2;
			}
			else
			{
				$result =0;
			}
		}
		//zamknięcie połączenia z bazą i zwrócenie wyniku
		$db_obj->close();
		return $result;
	}

	//rozpoczęcie procedur weryfikacji danych i logowania


	//użytkownik jest zalogowany
	if (isset($_SESSION['zalogowany'])) 
	{
		header("Location: main.php");
	}
	//użytkownik niezalogowany i btak parametru hasło lub nazwa użytkownika
	else if (!isset($_POST["password"]) || !isset($_POST["username"]))
	{
		if (!$_SESSION['komunikat']) 
		{
			$_SESSION['komunikat'] = "Wprowadż hasło i nazwę użytkownika";
		}

		//include('form.php');
		header("Location: login.php");
	}
	//użytkownik niezalogowany i ustawione arametry użytkownik i hasł
	else
	{
		$val = checkPass($_POST["username"],$_POST["password"]);
		if ($val ==0) 
		{
			//Logowanie poprawne
			$_SESSION["zalogowany"] = $_POST["username"];

				$db_obj = new mysqli($host, $uzytkownik, $haslo, $baza);
				//pobierz id użytkownika
				$login=$_POST["username"];
            	$query = "SELECT id FROM users WHERE nazwa='$login' OR email='$login'";
            	if (!$rezultat=$db_obj->query($query)) throw new Exception(mysqli_connect_errno());
            	//przechwić wynik zapytanie
            	$row = $rezultat->fetch_row();
            	$id = $row[0];
            	$_SESSION['id']=$id;
            	//sprawdż czy użytkownik ma firmę
            	$query = "SELECT * FROM firmy WHERE UserId='$id'";
            	if (!$rezultat=$db_obj->query($query)) 
            	{
            		//$_SESSION['test'] = "złe zapytanie";
            	}
            	else
            	{	
            		//przechwić wynik zapytanie
	            	$row = $rezultat->fetch_row();
	            	$row = $row[0];
	            	//sprawdż liczbę zwróconych wyników
            		if ($rezultat->num_rows <>1) 
            		{
            			$_SESSION['mamfirme'] = false;
            		}
            		else
            		{
            			$_SESSION['mamfirme'] = true;
            		}

            	}
            	
            	//zamknięcie połączenia z bazą i zwrócenie wyniku
            	//$rezultat->free_result();
				$db_obj->close();

			header("Location: main.php");
		}
		else if ($val == 1)
		{
			//błąd serwera
			$_SESSION['komunikat'] = "Błąd serwera zalogowanie nie było możliwe";
			header("Location: login.php");
		}
		else if ($val == 2)
		{
			//niepoprawne dane logowania
			$_SESSION['komunikat'] = "Niepoprawne hasło lub nazwa użytkownika";
			header("Location: login.php");

		}
		else
		{
			//błąd systemu logowania nieprawidłowa wartość zwrócona przez checkPass
			$_SESSION['komunikat'] = "Błąd serwera zalogowanie nie było możliwe";
			header("Location: login.php");

		}
	}
	

?>