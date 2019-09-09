
<?php

session_start();
//constant
include 'constants.php';
//dane do dostępu do bazy danych
$host = 'localhost';
$baza = 'baza_firm';
$uzytkownik = 'root';
$haslo = '';

function addUser($nazwa, $pass, $pass2, $imie, $nazwisko, $email)
{
	global $host, $baza, $uzytkownik, $haslo;

	$userPassLenght = mb_strlen($pass, 'UTF-8');

	//zła długość hasła
	if ($userPassLenght < 6 || $userPassLenght > 40) 
	{
		return INVALID_USER_PASS;
	}

	//czy hasła są identyczne
	if ($pass != $pass2)
	{
		return PASSWORDS_DO_NOT_MATCH;
	}

	if ($nazwa == "" || $imie == "" || $nazwisko =="" || $email = "") 
	{
		return EMPTY_FIELDS;
	}

	//sprawdzenie poprawności danych
	if (!preg_match("/^[a-zA-Z0-9_.]{3,20}/", $nazwa)) 
	{
		return INVALID_USER_NAME;
	}

	

	//Tu można stawić dalsze instrukcje weryfikujące dane


	//Nawiązanie połączenia z bazą danych
	$db_obj = new mysqli($host, $uzytkownik, $haslo, $baza);
	if ($db_obj->connect_errno) 
	{
		return SERVER_ERROR;
	}

	//zabezpieczenie znaków specjalnych w parametrach
	$nazwa = $db_obj->real_escape_string($nazwa);
	$imie = $db_obj->real_escape_string($imie);
	$nazwisko = $db_obj->real_escape_string($nazwisko);
	$email = $db_obj->real_escape_string($email);

	//sprawdzenie czy użytkownik o podanej nazwie istnieje w bazie
	$query = "SELECT COUNT(*) FROM users WHERE nazwa='$nazwa' ";

	if (!$result = $db_obj->query($query)) 
	{
		//echo "Wystąpił błąd nieprawidłowe zapytanie";
		$db_obj->close();
		return SERVER_ERROR;
	}
	if (!$row = $result->fetch_row())
	{
		//echo "Wystąpił błąd nieprawidłowe zapytanie";
		$db_obj->close();
		return SERVER_ERROR;
	}
	else
	{
		if ($row[0] >0)
		 {
			//użytkownik o podanej nazwie już istnieje
			$db_obj->close();
			return USER_NAME_ALREADY_EXISTS;
		}
	}

	//dodanie nowego użytkownika
	$pass = crypt($pass);

	$query = "INSERT INTO users VALUES (NULL, '$nazwa', '$pass', '$imie', '$nazwisko', '$email')" ;

	if (!$result = $db_obj->query($query)) 
	{
		//błąd instrukcji insert
		$db_obj->close();
		return SERVER_ERROR;
	}
	//pobranie liczby dodanych rekordóe
	$count = $db_obj->affected_rows;

	if ($count <> 1)
	{
		//niewjaściwe wyniki zapytania
		$db_obj->close();
		return SERVER_ERROR;
	}
	else
	{
		//poprawne dodanie rekordu
		$db_obj->close();
		return OK;
	}

}

//sprawdzanie czy użytkownik jest zalogowany
if(isset($_SESSION['zalogowany']))
{
	header('Location: main.php');
}
else if(!isset($_POST["username"]) || !isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["e-mail"]) || !isset($_POST["password"]) || !isset($_POST["password2"]))
{
	header('Location: rejestracja.php');
	//echo "błąd";
}
else
{
	//odczytanie danych z formularz
	$nazwa = $_POST["username"];
	$pass = $_POST["password"];
	$pass2 = $_POST["password2"];
	$imie = $_POST["name"];
	$nazwisko = $_POST["surname"];
	$email = $_POST["email"];
	


//wywołanie funkcji rejestrującej użytkownika
	$val = addUser($nazwa, $pass, $pass2, $imie, $nazwisko, $email);

//reakcja na wartość zwrócona przez funkcję
	switch ($_SESSION['kod'] = $val) {
		case OK:
			$_SESSION['komunikat'] = "Rejestracja poprawna.";
			break;
		case INVALID_USER_NAME:
			$_SESSION['komunikat'] = "Nazwa użytkownika musi mieć od 3 do 20 znaków";
			break;
		case INVALID_USER_PASS:
			$_SESSION['komunikat'] = "Hasło musi mieć od 6 do 40 znaków";
			break;
		case USER_NAME_ALREADY_EXISTS:
			$_SESSION['komunikat'] = "użytkownik o takiej nazwie już istnieje";
			break;
		case EMPTY_FIELDS:
			$_SESSION['komunikat'] = "Wszystkie pola muszą być wypełnione";
			break;
		case PASSWORDS_DO_NOT_MATCH:
			$_SESSION['komunikat'] = "Hasło nie jest takie samo";
			break;
		case NO_REGULAMIN:
			$_SESSION['komunikat'] = "Zaakceptu regulamin";
			break;

		default:
			$_SESSION['komunikat'] = "Błąd serwera rejestracja nie powiodła się";
			break;
	}
	header('Location: after_registration.php');

}


?>
