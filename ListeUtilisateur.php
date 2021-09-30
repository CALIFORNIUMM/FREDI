<?php
   include "init.php";

   $users = new UserDAO();
   $users = $users->findAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>FREDI - ACCUEIL</title>
</head>

<body>

    <div class="banner">
        <div class="banner-inner">
            <h1>HEADER</h1>
        </div>
    </div>

    <header id="header">
        <div id="header-inner">
            <div id="logo">
                <h1><a href="#">LOGO</a></h1>
            </div>

            <div id="top-nav">

            </div>
            <div class="bas-nav"></div>
        </div>
    </header>

        <div id="content">

          <ul>

            <?php

            foreach($users as $user){
              echo "<li>". $user->get_pseudo()."</li>";
            }

             ?>

          </ul>

        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>

</body>

</html>
