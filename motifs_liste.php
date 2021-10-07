<?php
  include('header.php'); 
  $title = "Ligues";

  //chargement de la classe motifs
  $motifs = new MotifDAO();
  $motifs = $motifs->findAll();

?>
  <h1>Admin</h1>
  <h2>Liste des ligues</h2>
  <ul>
    <li><a href="motifs_charger.php">Charger motifs</a></li>
    <li><a href="motifs_liste.php">Liste motifs</a></li>
    <li><a href="clubs_charger.php">Charger clubs</a></li>
    <li><a href="clubs_liste.php">Liste clubs</a></li>
    <li><a href="ligues_charger.php">Charger ligues</a></li>
    <li><a href="ligues_liste.php">Liste ligues</a></li>
  </ul>
 
  <?php
  if (count($motifs) > 0) {
  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Motif</th>
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
  echo "<p>". count($motifs) ." motif(s)</p>";
  ?>
<?php include('footer.php'); ?>
