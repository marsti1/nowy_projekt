
<?php

session_start();

//dane do dostępu do bazy danych
require_once "connect.php";

	if (isset($_POST['email']))
	{
		//Udana walidacja
		$wszystko_OK=true;

		//sprawdzenie nazwy użytkownika
		$username = $_POST['username'];

		//sprawdzenie długości nazwy użytkownika
		if (strlen($username)<3 || strlen($username)>20)
		{
		 $wszystko_OK =false;
		 $_SESSION['e_username']='nazwa użytkownika musi posiadać od 3 do 20 znaków';
        }
        //sprawdż czy znaki są alfanumeryczne
        if (ctype_alnum($username)==false) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_username']="nazwa użytkownika może składać się tylko z liter i cyfr";
        }
		//sprawdż poprawność adresu e-mail
        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) ||($emailB != $email)) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_email'] = "Podaj poprawny adres email";
        }
        //sprawdź poprawność hasła
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if (strlen($password)<8 || (strlen($haslo1)>20)) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_password'] = "Hasło musi posiadać od 8 do 20 znaków";
        }

        if ($password != $password2) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_password'] = "Podane hasła nie są identyczne";
        }
        //haszowanie hasła
        $password_hash = crypt($password);
        //$password_hash = password_hash($password, PASSWORD_DEFAULT); 
        
        // Czy regulamin jest zaakceptowany
        if (!isset($_POST['regulamin'])) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_regulamin'] = "Zatwierdź regulamin";
        }
        //recaptcha sprawdż
        $sekret = "6LdS6LcUAAAAAIwyBlpVqLqHh6G_jdUFkWmuHgel";
        $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
        $odpowiedz = json_decode($sprawdz);
        if ($odpowiedz->success==false) 
        {
        	$wszystko_OK=false;
        	$_SESSION['e_bot'] = "Potierdź że nie jesteś robotem";
        }
        //pobierz pozostałe dane
        $imie = $_POST['name'];
        $nazwisko = $_POST['surname'];
        //łączenie z mysql
        //require_once "connect.php";
        //sposób raportowania błedów
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
          $polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);
         if ($polaczenie->connect_errno!=0)
            {
                //rzuć nowym wyjątkiem
                throw new Exception(mysqli_connect_errno());
                
            }
         else
         {
            //Sukces połączenia wykonaj zapytania
            //czy email już istnieje
            $rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
            if (!$rezultat) throw new Exception($polaczenie->error);
            
            $ile_takich_maili = $rezultat->num_rows;
            if ($ile_takich_maili>0) 
            {
                $wszystko_OK=false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu";
            }
            //czy nick już istnieje
            $rezultat = $polaczenie->query("SELECT id FROM users WHERE nazwa='$username'");
            if (!$rezultat) throw new Exception($polaczenie->error);
            
            $ile_takich_nickow = $rezultat->num_rows;
            if ($ile_takich_nickow>0) 
            {
                $wszystko_OK=false;
                $_SESSION['e_username'] = "Istnieje już użytkownik o takim nicku";
            }


             if ($wszystko_OK==true) 
             {
                //wszystkie testy zaliczone dodajemy użytkownika do bazy
                if($polaczenie->query("INSERT INTO users VALUES (Null, '$username','$password_hash','$imie','$nazwisko','$email')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: after_registration.php');
                }
                else
                {
                    throw new Exception($polaczenie->error);
                    
                }
             }
             else
             {
                header('Location: rejestracja.php');
             }
        

            $polaczenie->close();
         }   
        }
        //złap wyjątki, jeśli jakieś zostały rzucone
        catch(Exception $e)
        {
            echo 'Błąd serwera przepraszamy za niedogodności';
            echo '<br />Informacja developerska:'.$e;
        }
	}
    else
    {
        header('Location: rejestracja.php');
    }
	/*
	if ($wszystko_OK==true) 
	{
		$_SESSION['komunikat'] = "wszystko ok";
	}
	header('Location: rejestracja.php');
	*/
?>
