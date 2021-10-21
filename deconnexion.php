<?php
$title = "Deconnexion";
include('header.php');

unset($_SESSION['user']);
header('Location: connexion.php');
?>