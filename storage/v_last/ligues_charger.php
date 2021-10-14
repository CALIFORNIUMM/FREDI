<?php
/**
 * Chargement du fichier CSV dans la base MySQL
 */
// Initialisations
include 'init.php';

$csv = new CsvDAO();
$csv = $csv->insert('ligues');

// Affichage
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREDI - Admin/ligues_charger</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h2>Chargement des ligues</h2>
    <?php
    include "menu.php";
    ?>
</body>

</html>