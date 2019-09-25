      <?php
        $idfirmy = $_GET['firma'];
        try
        {
            $polaczenie = new mysqli($host, $uzytkownik, $haslo, $baza);
            if ($rezultat = $polaczenie->connect_errno) 
            {
                throw new Exception(mysqli_connect_errno());
            }
            else 
            {
                $query = "SELECT info FROM firmy WHERE id='$idfirmy'";
                if (!$rezultat = $polaczenie->query($query)) throw new Exception(mysqli_connect_errno());
                $row = $rezultat->fetch_row();
                $info = $row[0];

            }

            $polaczenie->close();
        }

        catch(Exception $e)
        {
            echo 'Błąd serwera przepraszamy za niedogodności';
            echo '<br />Informacja developerska:'.$e;
        }



       ?>
        <div class="firmy">
        <div>
        	<h1>INFO</h1>
            <p><?=$info?></p>
         
            
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