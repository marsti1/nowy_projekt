
<?php
	session_start();
	if(isset($_SESSION['komunikat']))
	{
		$komunikat = $_SESSION['komunikat'];
		unset($_SESSION['komunikat']);
	}
	else
	{
		$komunikat = "Wprowadź nazwę i hasło użytkownika" ;
	}
	if (isset($_SESSION['zalogowany'])) 
	{
		header("Location: main.php");
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
        	<h1>Zaloguj się</h1>
        	<form action="zaloguj.php" method="POST">
        		<label for="username" class="col-sm-3">Login lub e-mail:</label>
        		<input type="text" name="username" required />
        		<br/>
        		<label for="password" class="col-sm-3">Hasło:</label>
        		<input type="password" name="password" required />
        		<br/>
        		<button type="submit" class="btn btn-primary">Zaloguj się</button>
        	</form>
        	<p><?php echo $komunikat; ?></p>
        	
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