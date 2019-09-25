<?php

	session_start();
	//sprawdź czy zalogowany aby ustawić przycisk login/logout
                    if (isset($_SESSION['zalogowany']))
                        {
                            $zalogowany = "logout.php";
                        } 
                        else
                        {
                            $zalogowany = "#";
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

	
	<script type="text/javascript">
		//kod jascript sprawdzający dane z formularz
		function sprawdz()
		{
			var f = document.forms.formularz;
			if (f.username.value.length < 3 || f.username.value.length > 20)
			 {
			 	alert('Nazwa musi mieć od 3 do 20 znaków');
			 	return;
			 }
			 if (f.password.value.length < 6 || f.password.value.length > 40)
			  {
			  	alert('Hasło musi mieć od 6 do 40 znaków');
			  	return;
			  }
			  if (f.password.value != f.password2.value) 
			  {
			  	alert('Hasła są różne');
			  	return;
			  }
			  if (f.surname.value == ""  || f.email.value == "")
			   {
			   	alert("wypełnij wszystkie pola formularza");
			   	return;
			   }
			   document.forms.formularz.submit();
		}
	</script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<div id="container">

<nav class="navbar navbar-dark navbar-expand-lg menu">
        <a href="index.php" class="navbar-brand">HOME</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainmenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a href="firmy.php" class="nav-link">Firmy</a></li>
                <li class="nav-item"> <a href="rejestracja.php" class="nav-link">Dołącz do firm</a></li>
                <li id="loginbtn" class="nav-item"> <a href="<?=$zalogowany ?>" class="nav-link">
                    <?php
                        if (isset($_SESSION['zalogowany']))
                        {
                            echo "Wyloguj się";
                        } 
                        else
                        {
                            echo "Zaloguj się";
                        }
                    ?>
                    </a></li>

                <li class="nav-item dropdown"> 
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" id="submenu">PL DE ENG</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Polski</a>
                        <a href="#" class="dropdown-item">Deutsch</a>
                        <a href="#" class="dropdown-item">English</a>
                    </div>
                </li>
                
            </ul>
            <form class="form-inline">
                
                    <input class="form-control mr-1" type="search" placeholder="Wyszukaj" aria-label="Wyszukaj">
                    <button class="btn btn-light" type="submit">Znajdź</button>
                
                </form>
        </div>
    </nav>

        <div class="modal" id="login">
            <?php 
                include 'login2.php'
            ?>
            
        </div>

	<div class="cont">
        <div id="description">
        	<h1>Załóż konto</h1>
        	<form action="add_new_user.php" method="post" name="formularz">
        		<label for="username" class="col-sm-3">Nazwa użytkownika:</label>
        		<input type="text" name="username"  />
        		<br/>
        		<?php 
      
     			if (isset($_SESSION['e_username'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['e_username'].'</div>';
			     	unset($_SESSION['e_username']);
			     }


				 ?>
        		<label for="name" class="col-sm-3">Imię:</label>
        		<input type="text" name="name"  />
        		<br/>        		
        		<label for="surname" class="col-sm-3">Nazwisko:</label>
        		<input type="text" name="surname"  />
        		<br/>        		   
        		<label for="e-mail" class="col-sm-3">e-mail:</label>
        		<input type="text" name="email"  />
        		<br/>        		   
        		<?php 
      
     			if (isset($_SESSION['e_email'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['e_email'].'</div>';
			     	unset($_SESSION['e_email']);
			     }


				 ?>
				 
        		<label for="password" class="col-sm-3">Hasło:</label>
        		<input type="password" name="password"  />
        		<br/>   
        		<?php 
      
     			if (isset($_SESSION['e_password'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['e_password'].'</div>';
			     	unset($_SESSION['e_password']);
			     }


				 ?>
        		<label for="password" class="col-sm-3">Powtórz hasło:</label>
        		<input type="password" name="password2"  />  
        		<br/>  
        		<label for="regulamin" class="col-sm-3">Akceptuję regulamin</label> 
        		<input type="checkbox" name="regulamin">	
        		<br/>	  		
        		<?php 
      
     			if (isset($_SESSION['e_regulamin'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['e_regulamin'].'</div>';
			     	unset($_SESSION['e_regulamin']);
			     }


				 ?>
        		<div class="g-recaptcha" data-sitekey="6LdS6LcUAAAAABkdLVaFAq5YpQYSxIu_T9Nh53OR"></div>
        		<br/>
        		<?php 
      
     			if (isset($_SESSION['e_bot'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['e_bot'].'</div>';
			     	unset($_SESSION['e_bot']);
			     }


				 ?>
        		<?php 
      
     			if (isset($_SESSION['komunikat'])) 
			     {
			     	echo '<div id ="error">'.$_SESSION['komunikat'].'</div>';
			     	unset($_SESSION['komunikat']);
			     }
			     

				 ?>

        		<input type="submit" value="rejestracja"  class="btn btn-primary">
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
    <script src="logika.js"></script>
  </body>
</body>
</html>