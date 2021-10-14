<?php
    include('init.php');
    $messages = array();  // Message d'erreur
    $title = NULL;
    if(isset($_SESSION['user'])){
        $session = $_SESSION['user'];
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>FREDI - <?= $title ?></title>
</head>

<body>
    <div class="banner">
        <div class="banner-inner">
            <h1>FREDI - <?= $title ?></h1>
        </div>
    </div>

    <header id="header">
        <div id="header-inner">
            <div id="logo">
                <h1><a href="index.php">Accueil</a></h1>
            </div>

            <div id="top-nav">
                <ul>
                <?php 
                    if(isset($session)){
                        if($session->get_role() == 2){
                            echo '<li><a href="admin.php">ADMIN</a></li>';
                        }
                        if($session->get_role() == 1){
                            echo '<li><a href="controleur.php">CONTROLEUR</a></li>';
                        }
                        echo '<li><a href="profil.php">MON COMPTE</a></li>';
                        echo '<li><a href="deconnexion.php">DECONNEXION</a></li>';
                    }else{
                        echo '<li><a href="inscription.php">S\'INSCRIRE</a></li>';
                        echo '<li><a href="connexion.php">SE CONNECTER</a></li>';
                    }
                ?>
                    
                    
                </ul>
            </div>
            <div class="bas-nav"></div>
        </div>
    </header>

    <div id="content">