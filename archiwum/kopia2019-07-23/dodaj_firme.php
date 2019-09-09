<?php

	session_start();

	//dane do dostępu do bazy danych
	$host = 'localhost';
	$baza = 'baza_firm';
	$uzytkownik = 'root';
	$haslo = '';

	if (isset($_POST['nazwa'])) 
	{
		$nazwa = $_POST['nazwa'];
		$miejscowosc = $_POST['miejscowosc'];
		$kod = $_POST['kod'];
		$ulica = $_POST['ulica'];
		$numer = $_POST['numer'];
		$telefon = $_POST['telefon'];
		//usuń białe znaki i znaczniki html
		trim(strip_tags($nazwa));
		trim(strip_tags($miejscowosc));
		trim(strip_tags($kod));
		trim(strip_tags($ulica));
		trim(strip_tags($numer));
		trim(strip_tags($telefon));
		//walidacja może czegoś w niej brakuje?
		//odczytanie nzawy zaloggowanego
		$login = $_SESSION['zalogowany'];

		//flaga
		$wszystkoOk = true;


		//sprawdź czy wszystkie pola są wypełnione
		if ($nazwa=="" || $miejscowosc=="" || $kod=="" || $ulica=="" || $numer=="" || $telefon=="") 
		{
			$wszystkoOk = false;
			$_SESSION['komunikat']= "Uzupełnij wszystkie pola";
		}
		//czy kod pocztowy jest prawidłowy(udoskonalić)
		if (strlen($kod)<>6)
		{
			$wszystkoOk = false;
			$_SESSION['e_kod']= "Podaj poprawny kod pocztowy w formie(xx-xxx)";
		}
		

		if ($wszystkoOk == true) 
		{
			$_SESSION['komunikat']= "wszystko ok";
			$polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);
			

			if ($polaczenie->connect_errno) 
			{
				//wystąpił błąd podczas połączenia
				//rzuć nowym wyjątkiem
                throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Sukces połączenia wykonaj zapytania
            	//pobierz id użytkownika
            	$query = "SELECT id FROM users WHERE nazwa='$login' OR email='$login'";
            	if (!$rezultat=$polaczenie->query($query)) throw new Exception(mysqli_connect_errno());
            	//przechwić wynik zapytanie
            	$row = $rezultat->fetch_row();
            	$id = $row[0];
            	//dodaj zabezpieczenie na brak wyników lub kilka wyników

            	//zabiezpieczenie znaków specjalnych w parametrach
            	$nazwa = $polaczenie->real_escape_string($nazwa);
				$miejscowosc = $polaczenie->real_escape_string($miejscowosc);
				$kod = $polaczenie->real_escape_string($kod);
				$ulica = $polaczenie->real_escape_string($ulica);
				$numer = $polaczenie->real_escape_string($numer);
				$telefon = $polaczenie->real_escape_string($telefon);

				//dodaj dane do bazy
				//po dodaniu firmy nie można przejść do moja_firma.php (trzeba się ponownie zalogować)
				$query="INSERT INTO firmy VALUES (NULL, '$id', '$nazwa', '$miejscowosc', '$kod', '$ulica', '$numer', '$telefon', '')";
				if ($rezultat = $polaczenie->query($query)) 
				{
					$_SESSION['udanedodanie']=true;
                    
				}
				else
				{
					throw new Exception(mysqli_connect_errno());
					
				}

            }
            $polaczenie->close();


		}

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

	
	
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
			<li><a href="firmy.html">Firmy</a></li>
			<li><a href="rejestracja.php">Dołącz do firm</a></li>
			<li><a href="login.php">Zaloguj się</a></li>
			<li><a href="#">PL DE ENG</a></li>
		</ul>
	</div>
	</div>
	</div>
	<div class="cont">
        <div id="description">
        	<h1>Dodaj firmę</h1>
        	<form method="post" name="formularz">
        		<label for="nazwa" class="col-sm-3">Nazwa firmy:</label>
        		<input type="text" name="nazwa"  />
        		<br/>
        		
        		<label for="miejscowosc" class="col-sm-3">Miejscowość:</label>
        		<input type="text" name="miejscowosc"  />
        		<br/>        		
        		<label for="kod" class="col-sm-3">Kod pocztowy:</label>
        		<input type="text" name="kod"  />
        		<br/> 
        		<?php 
      
			     if (isset($_SESSION['e_kod'])) 
			     {
			     	echo '<div class ="error">'.$_SESSION['e_kod'].'</div>';
			     	unset($_SESSION['e_kod']);
			     }

				 ?>       		   
        		<label for="ulica" class="col-sm-3">Ulica</label>
        		<input type="text" name="ulica"  />
        		<br/>        		   
        		
        		<label for="numer" class="col-sm-3">Nr. budynku</label>
        		<input type="text" name="numer"  />
        		<br/>   
        		
        		<label for="telefon" class="col-sm-3">Telefon</label>
        		<input type="text" name="telefon"  />  
        		<br/>  
        		
        		
      			<?php
     			if (isset($_SESSION['komunikat'])) 
			     {
			     	echo '<div class ="error">'.$_SESSION['komunikat'].'</div>';
			     	unset($_SESSION['komunikat']);
			     }
			     
			     if (isset($_SESSION['udanedodanie'])) 
			     {
			     	echo "<p>udane dodanie</p>";
			     	unset($_SESSION['udanedodanie']);
			     }
				 ?>

        		<input type="submit" value="Dodaj firmę"  class="btn btn-primary">
        		<br/>
        	</form>
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