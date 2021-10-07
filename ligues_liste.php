<?php
  include('header.php'); 
  $title = "Ligues";

  //chargement de la classe ligues
  $ligues = new LigueDAO();
  $ligues = $ligues->findAll();

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
echo "<p>". count($ligues) ." motif(s)</p>";
?>
<?php include('footer.php'); ?>