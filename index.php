<?php 
session_start();
	if (isset($_SESSION['zalogowany'])) 
	{
		header("Location: main.php");
	}

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
	<title>Eksportuj swoje usługi</title>
	
	<meta name="description" content="Opis w Google" />
	<meta name="keywords" content="słowa, kluczowe, wypisane, po, porzecinku" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
</head>

<body>
	<div id="container">
		<!--
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
-->
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
        	<h1>Odbieraj zlecenia od firm zagranicznych</h1>
        	<h2>Zarejestruj się i dodaj swoją firmę na stronę, opisz profil jej działalności a my ci pomożemy w znalezieniu klienta zagranicznego. Korzystanie z naszych usług pomoże ci zaoszczędzić czas i pieniądze.</h2>
        	<button type="submit" class="btn btn-primary btn-block button">Dołącz do nas</button>
        </div>
        <div class="how">
        	<h1>Jak to działa</h1>
        	
             <img src="img/numer1.jpg" class="img-responsive">
            
             <img src="img/numer2.jpg" class="img-responsive">
            
            <div class="clear"></div>
        </div>
        </div>
		<div id="footer">
			stopka
		</div>
	</div>
	</div>
	


	 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="logika.js"></script>
  </body>
</body>
</html>