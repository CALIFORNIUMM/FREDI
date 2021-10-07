<?php
/**
 * Liste des pays
 */
// Initialisations
include 'init.php';

$clubs = new ClubDAO();
$clubs = $clubs->findAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREDI - Admin/clubs_liste</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h2>Liste des clubs</h2>
 
  <?php
  include "menu.php";
  if (count($clubs) > 0) {
  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Club</th>
        <th>Adresse 1</th>
        <th>Adresse 2</th>
        <th>Adresse 3</th>
        <th>ID Ligue</th>
      </tr>
      <?php
      foreach ($clubs as $club) {
        echo '<tr>';
        echo '<td>' . $club->get_id_adherent() . '</td>';
        echo '<td>' . $club->get_lib_club() . '</td>';
        echo '<td>' . $club->get_adr1() . '</td>';
        echo '<td>' . $club->get_adr2() . '</td>';
        echo '<td>' . $club->get_adr3() . '</td>';
        echo '<td>' . $club->get_id_ligue() . '</td>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <?php
  echo "<p>". count($clubs) ." club(s)</p>";

  ?>

</body>

</html>

