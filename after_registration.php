<?php

	session_start();
	if (!isset($_SESSION['udanarejestracja'])) 
	{
		header('Location rejestracja.php');
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rejestracja użytkownika</title>
</head>
<body>
	<p>Udana rejestracja</p>
	<br/>
	<a href="zaloguj.php">Zaloguj się</a>

</body>
</html>