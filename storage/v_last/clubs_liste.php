<?php
  include('header.php'); 
  $title = "Clubs";

  //chargement de la classe club
  $clubs = new ClubDAO();
  $clubs = $clubs->findAll();

?>

  <h1>Admin</h1>
  <h2>Liste des clubs</h2>
  <ul>
    <li><a href="motifs_charger.php">Charger motifs</a></li>
    <li><a href="motifs_liste.php">Liste motifs</a></li>
    <li><a href="clubs_charger.php">Charger clubs</a></li>
    <li><a href="clubs_liste.php">Liste clubs</a></li>
    <li><a href="ligues_charger.php">Charger ligues</a></li>
    <li><a href="ligues_liste.php">Liste ligues</a></li>
  </ul>

  <?php
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
        echo '<td>' . $club->get_id_club() . '</td>';
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
  echo "<p>". count($clubs) ." club(s)</p>";

  ?>

<?php include('footer.php'); ?>
