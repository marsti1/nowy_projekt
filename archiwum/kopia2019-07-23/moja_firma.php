<?php
    session_start();
    //dane do dostępu do bazy danych
    $host = 'localhost';
    $baza = 'baza_firm';
    $uzytkownik = 'root';
    $haslo = '';
    //sprawdz czy użytkownik ma firmę 
    //czy id istnieje w bazie danycj DODAC!!!
    if (!isset($_SESSION['mamfirme'])) 
    {
        header("Location: main.php");
        exit();
    }
    else
    {
        if ($_SESSION['mamfirme']==true)
        {
            //wszystko ok
        }
        else
        {
            header("Location: main.php");
            exit();
        }
    }

    if (isset($_SESSION['id']))
    {   
        $id = $_SESSION['id'];
        
        // polączenie z bazą
        try
        {
            $polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);
            if ($rezultat = $polaczenie->connect_errno)
            {
                
                throw new Exception(mysqli_connect_errno());
                
            }
            else
            {   
                //sprawdź nazwę firmy
                 $query = "SELECT NazwaFirmy FROM firmy WHERE UserId='$id'";
                if (!$rezultat = $polaczenie->query($query)) throw new Exception(mysqli_connect_errno());
                $row = $rezultat->fetch_row();
                $NazwaFirmy = $row[0];
                //sprawdzanie czy jest dodane
                $query = "SELECT info FROM firmy WHERE UserId='$id'";
                if (!$rezultat = $polaczenie->query($query)) throw new Exception(mysqli_connect_errno());
                $row = $rezultat->fetch_row();
                $info = $row[0];

                if($info =="")
                {
                    $info = "Uzupełnij dane na temat";
                }
                //edycja
                if (isset($_POST['info'])) 
                {   
                    $update = $_POST['info'];
                    $query = "UPDATE firmy SET info='$update' WHERE UserId='$id'";
                    if (!$rezultat = $polaczenie->query($query)) throw new Exception(mysqli_connect_errno());
                    
                }

            }


            $polaczenie->close();
        }
        //złap wyjątki, jeśli jakieś zostały rzucone
        catch(Exception $e)
        {
            echo 'Błąd serwera przepraszamy za niedogodności';
            echo '<br />Informacja developerska:'.$e;
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
		
        <div class="menu-firmy">
        	<h1><?=$NazwaFirmy?></h1>
		<ul>
			<li><a href="#">O Firmie</a></li>
			<li><a href="#">Usługi</a></li>
			<li><a href="#">Realizacje</a></li>
			<li><a href="#">Kontakt</a></li>
		</ul>
        	
        </div>
        <div class="clear"></div>
        <div class="firmy">
        <div>
        	<h1>INFO</h1>
            
            <?php 
            /*
             if (isset($_SESSION['mamfirme'])) 
             {
                 echo '<div>'.$_SESSION['mamfirme'].'</div>';
                 unset($_SESSION['mamfirme']);
                
             }
              echo '<div>'.$info.'</div>';
              */
            ?>
            <?php 
                if (isset($_POST['edycja'])) 
                {
                echo '<form method="post">
                <textarea name="info">'.$info.'</textarea>   
                <br/>
                <input type="submit" name="forminfo" value="Edytuj">
            </form>';
                }
                else
                {
                    echo '<div>'.$info.'</div>';
                    echo '<form method="post">
                            <input type="submit" name="edycja" value="Edytuj"> 
                         </form>';

                }
            ?>
           
            
        </div>
                <div>
        	<h1>Usługi</h1>
        	<p>
        		

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis orci libero, pretium id sem sit amet, scelerisque gravida velit. Maecenas nec erat sagittis, interdum tellus a, finibus neque. Donec tristique tempor est, sodales sodales felis molestie non. Suspendisse id turpis eget justo elementum commodo et non est. In blandit dignissim tristique. Proin in egestas enim, ut ullamcorper enim. Quisque commodo lacus nec dui commodo, vel iaculis eros posuere.

Nam pretium bibendum tellus eu pharetra. Donec venenatis vestibulum turpis, sed tincidunt risus imperdiet ac. Integer viverra nulla feugiat, tempor risus et, mattis ipsum. Quisque molestie convallis tempor. Aliquam sed est et erat eleifend aliquet et eu lectus. Nunc volutpat nisl magna, eu pretium tellus bibendum at. Cras imperdiet massa nec ante congue, at luctus nulla hendrerit. 
        	</p>
        </div>
                <div>
        	<h1>Realizacje</h1>
        	<p>
        		

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis orci libero, pretium id sem sit amet, scelerisque gravida velit. Maecenas nec erat sagittis, interdum tellus a, finibus neque. Donec tristique tempor est, sodales sodales felis molestie non. Suspendisse id turpis eget justo elementum commodo et non est. In blandit dignissim tristique. Proin in egestas enim, ut ullamcorper enim. Quisque commodo lacus nec dui commodo, vel iaculis eros posuere.

Nam pretium bibendum tellus eu pharetra. Donec venenatis vestibulum turpis, sed tincidunt risus imperdiet ac. Integer viverra nulla feugiat, tempor risus et, mattis ipsum. Quisque molestie convallis tempor. Aliquam sed est et erat eleifend aliquet et eu lectus. Nunc volutpat nisl magna, eu pretium tellus bibendum at. Cras imperdiet massa nec ante congue, at luctus nulla hendrerit. 
        	</p>
        </div>
                <div>
        	<h1>Kontakt</h1>
        	<p>
        		

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis orci libero, pretium id sem sit amet, scelerisque gravida velit. Maecenas nec erat sagittis, interdum tellus a, finibus neque. Donec tristique tempor est, sodales sodales felis molestie non. Suspendisse id turpis eget justo elementum commodo et non est. In blandit dignissim tristique. Proin in egestas enim, ut ullamcorper enim. Quisque commodo lacus nec dui commodo, vel iaculis eros posuere.

Nam pretium bibendum tellus eu pharetra. Donec venenatis vestibulum turpis, sed tincidunt risus imperdiet ac. Integer viverra nulla feugiat, tempor risus et, mattis ipsum. Quisque molestie convallis tempor. Aliquam sed est et erat eleifend aliquet et eu lectus. Nunc volutpat nisl magna, eu pretium tellus bibendum at. Cras imperdiet massa nec ante congue, at luctus nulla hendrerit. 
        	</p>
        </div>
                <div>
        	<h1></h1>
        	<p>
        		

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis orci libero, pretium id sem sit amet, scelerisque gravida velit. Maecenas nec erat sagittis, interdum tellus a, finibus neque. Donec tristique tempor est, sodales sodales felis molestie non. Suspendisse id turpis eget justo elementum commodo et non est. In blandit dignissim tristique. Proin in egestas enim, ut ullamcorper enim. Quisque commodo lacus nec dui commodo, vel iaculis eros posuere.

Nam pretium bibendum tellus eu pharetra. Donec venenatis vestibulum turpis, sed tincidunt risus imperdiet ac. Integer viverra nulla feugiat, tempor risus et, mattis ipsum. Quisque molestie convallis tempor. Aliquam sed est et erat eleifend aliquet et eu lectus. Nunc volutpat nisl magna, eu pretium tellus bibendum at. Cras imperdiet massa nec ante congue, at luctus nulla hendrerit. 
        	</p>
        </div>
    </div>
        <div class="clear"></div>
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