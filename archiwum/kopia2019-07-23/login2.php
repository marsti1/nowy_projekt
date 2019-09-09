
<?php
	/*
	
	session_start();
	*/
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
		/*
		header("Location: logout.php");
		popraw na $-SESSION jakby coś nie działało
		*/
		



	}
?>

	<div class="cont">
        <div id="modal-content">
        	<div class="test">&times</div>
        	<h1>Zaloguj się</h1>
        	<form action="http://localhost/php-mysql/zaloguj.php" method="POST">
        		<label for="username" class="col-sm-3">Login lub e-mail:</label>
        		<input type="text" name="username" required />
        		<br/>
        		<label for="password" class="col-sm-3">Hasło:</label>
        		<input type="password" name="password" required />
        		<br/>
        		<button type="submit" class="btn btn-primary">Zaloguj się</button>
        	</form>
        	<p><?php echo $komunikat; ?></p>
        	<div class="login" style="background-color:#f1f1f1">
			    <button type="button" class="cancelbtn">Cancel</button>
			    <span class="psw">Forgot <a href="#">password?</a></span>
			</div>
        </div>
 
	</div>
	
	


	