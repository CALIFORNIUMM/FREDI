
<?php
$title = "Controleur Liste des Notes";
include('header.php');

//chargement de la classe ligues
$notes = new NoteDAO();
$notes = $notes->findPeriode();


?>
  <h1>Controleur</h1>
  <ul>
    <li><a href="utilisateur_liste.php">Liste</a> des utilisateurs</li>
  </ul>

  <?php
  if (count($notes) > 0) {
  ?>
    <table>
      <tr>
        <th>ID Utilisateur</th>
        <th>Pseudo</th>
        <th>ID Note</th>
      </tr>

      <?php
      foreach ($notes as $note) {
        echo '<tr>';
        echo '<td>' . $note['id_utilisateur']. '</td>';
        echo '<td>' . $note['pseudo']. '</td>';
        echo '<td>' . $note['id_note']. '</td>';
        echo "</tr>";
      } ?>
    </table>
<?php
} else {
  echo "<p>Rien à afficher</p>";
}
echo "<p>". count($notes) ." Utilisateur(s)</p>";
?>
<?php include('footer.php'); ?>
