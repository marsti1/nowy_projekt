<?php

session_start();
//dane do dostępu do bazy danych
    require_once "connect.php";
//sprawdź czy zalogowany aby ustawić przycisk login/logout
                    if (isset($_SESSION['zalogowany']))
                        {
                            $zalogowany = "logout.php";
                        } 
                        else
                        {
                            $zalogowany = "#";
                        }
//połączenie z bazą w celu pszeszukania istniejących firm
     
            $polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);
            if ($rezultat = $polaczenie->connect_errno)
            {
                $blad = "Połączenie nieudane";
                
            }
            else
            {   
                //sprawdź nazwę firmy
                $query = "SELECT NazwaFirmy, id FROM firmy";
                if (!$rezultat = $polaczenie->query($query))
                {
                    //$blad= "zle zapytanie ";
                }
                else
                {
                    while ($row = $rezultat->fetch_row())
                    {
                        
                        $firmy[] =$row[0];
                        $id[] = $row[1];
                        $table[] = $row;
                        
                    }
                }

                $query = "SELECT info FROM firmy";
                if (!$rezultat = $polaczenie->query($query))
                {
                    //$blad= "zle zapytanie ";
                }
                else
                {
                    while ($row = $rezultat->fetch_row())
                    {
                        
                        $info[] = $row[0];
                        
                    }
                }
                
                
                
            }


            $polaczenie->close();
      
        //złap wyjątki, jeśli jakieś zostały rzucone
        /*
        catch(Exception $e)
        {
            echo 'Błąd serwera przepraszamy za niedogodności';
            echo '<br />Informacja developerska:'.$e;
        }
        */


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
			<li id="loginbtn"><a href="#">Zaloguj się</a></li>
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
		
        <?php
        if (isset($_GET['firma'])) 
        {
            
            include 'opis_firmy.php';
        }
        else
        {
            echo"<div><h1>Lista firm</h1></div>
        <ul>";
            
                foreach ($table as $key) 
                {
                    echo '<li><a href="firmy.php?firma='.$key[1].'">'.$key[0].'</a></li>';
                }
                
            
            
        echo "</ul>";
        }
        
        ?>

        <p><?//=$blad?></p>
    </div>
    
        <div class="clear"></div>
    <div class="container">

        

        <?php    foreach ($table as $key): ?>
                

        

        <div class="row divwizytowka">
            <div class="divfirmy d-none d-md-block col-md-3 col-lg-3">
                <img class="img-responsive" src="img/wizytowka.jpg" alt="">
            </div>
            <div class="divfirmy col-md-9 col-lg-9">
                <h3><?=$key[0]?></h3>
                <div class="opisfirmy"></div>
                <p><?=$info[$key[1] -1] ?></p>
            </div>
        </div>
    	
    	<?php endforeach; ?>
    </div>

    <div class="clear"></div>
    </div>
		<div id="footer">
			stopka
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