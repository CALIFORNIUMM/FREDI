<?php
   include "init.php";
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
                <ul>
                  <?php

                  if (isset($_SESSION['user'])){
                    if ($_SESSION['user']['id_utilisateur']==2) {
                      echo "<li><a href='admin.php'>Page Admin</a></li>";
                    }
                    elseif ($_SESSION['user']['id_utilisateur']==1) {
                      echo "<li><a href='admin.php'>Page contrôleur.</a></li>";
                    }
                    elseif ($_SESSION['user']['id_utilisateur']==0) {
                      echo "<li><a href='admin.php'>Page Utilisateur.</a></li>";
                    }
                  }
                  else {
                    echo "<li><a href='connexion.php'>SE CONNECTER.</a></li>";
                    echo "<li><a href='inscription.php'>S'INSCRIRE.</a></li>";
                  }

                   ?>

                </ul>
            </div>
            <div class="bas-nav"></div>
        </div>
    </header>

        <div id="content">

        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>

</body>

</html>
