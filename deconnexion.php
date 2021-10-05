<?php
    include('header.php');
    $title = "Deconnexion";
    unset($_SESSION['user']);
    header('Location: connexion.php');
?>