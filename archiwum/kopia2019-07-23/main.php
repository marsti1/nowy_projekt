
<?php



session_start();
include 'constants.php';

//dane do dostępu do bazy danych
$host = 'localhost';
$baza = 'baza_firm';
$uzytkownik = 'root';
$haslo = '';


	if(!isset($_SESSION['zalogowany']))
	{
		$_SESSION['komunikat'] = "Nie jesteś zalogowany";
		header("Location: login.php");
		exit();
	}

//Nawiązanie połączenia z bazą danych
	$db_obj = new mysqli($host, $uzytkownik, $haslo, $baza);
	if ($db_obj->connect_errno) 
	{
		return SERVER_ERROR;
	}
	//należy to zmienić gdyż w przeszłości może to generować problemy
	$nazwa = $_SESSION['zalogowany'];
	$query = "SELECT * FROM users WHERE nazwa='$nazwa' OR email='$nazwa'";
	if (!$result = $db_obj->query($query)) 
	{
		//echo "Wystąpił błąd nieprawidłowe zapytanie";
		$db_obj->close();
		return SERVER_ERROR;
	}
	else
	{
		$wiersz = $result->fetch_assoc();
		
		$imie = $wiersz['imie'];
		$nazwisko = $wiersz['nazwisko'];
		$username = $wiersz['nazwa'];
		
		//zwolnij pamieć
		$result->free_result();
		//zamknij połączenie z bazą
		$db_obj->close();
	}


?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
</head>

<body>
	<div id="container">
<div class="container-fluid">
	<div class="row menu">
			
		
			<div class="col-xs-6 col-md-6">
				<div><a href="index.php">Home</a></div>
			</div>
			<div class="col-xs-6 col-md-6">
		<ul>
			<li><a href="firmy.php">Firmy</a></li>
			<li><a href="rejestracja.php">Dołącz do firm</a></li>
			<li><a href="login.php">Zaloguj się</a></li>
			<li><a href="#">PL DE ENG</a></li>
		</ul>
	</div>
	</div>
	</div>
	<div class="cont">
        <div id="description">
        	<p>Jesteś zalogowany jako:</p>
        	<p><?=$username?></p>
        	<form action="dodaj_firme.php">
   				 <input type="submit" value="Dodaj firmę" />
			</form>
        	<p><a href="logout.php">Wyloguj się</a></p>
        	<p><?php echo $imie; ?><p>
        	<p><?php echo $nazwisko; ?><p>
        	<p><?=$_SESSION['id']?></p>
        	<p><?=$_SESSION['mamfirme']?></p>
        	<p><a href="moja_firma.php">Moja Firma</a></p>
        	
        </div>
 
		<div id="footer">
			stopka
		</div>
	</div>
	</div>
	


	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</body>
</html>