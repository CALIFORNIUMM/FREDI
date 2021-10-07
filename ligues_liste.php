<?php
/**
 * Liste des pays
 */
// Initialisations
include 'init.php';

$ligues = new LigueDAO();
$ligues = $ligues->findAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREDI - Admin/ligues_liste</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h2>Liste des ligues</h2>
 
  <?php
  include "menu.php";
  if (count($ligues) > 0) {
  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Ligue</th>
      </tr>
      <?php
      foreach ($ligues as $ligue) {
        echo '<tr>';
        echo '<td>' . $ligue->get_id_ligue() . '</td>';
        echo '<td>' . $ligue->get_lib_ligue() . '</td>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <?php
  echo "<p>". count($ligues) ." motif(s)</p>";

  ?>

</body>

</html>

