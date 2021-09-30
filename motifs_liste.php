<?php
/**
 * Liste des pays
 */
// Initialisations
include 'init.php';

$motifs = new MotifDAO();
$motifs = $motifs->findAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>FREDI - Admin/motifs_liste</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <h2>Liste des motifs</h2>
 
  <?php
  include "menu.php";
  if (count($motifs) > 0) {
  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Pays</th>
      </tr>
      <?php
      foreach ($motifs as $motif) {
        echo '<tr>';
        echo '<td>' . $motif->get_id_motif() . '</td>';
        echo '<td>' . $motif->get_lib_motif() . '</td>';
        echo "</tr>";
      } ?>
    </table>
  <?php
  } else {
    echo "<p>Rien à afficher</p>";
  }
  ?>
  <?php
  echo "<p>". count($motifs) ." motif(s)</p>";

  ?>

</body>

</html>

