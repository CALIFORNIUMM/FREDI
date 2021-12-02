
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
        <th>id note</th>
        <th>utilisateur</th>
      </tr>

      <?php
      foreach ($notes as $note) {
        echo '<tr>';
        echo '<td>' . $note->get_id_note(). '</td>';
        echo '<td>' . $note->get_pseudo(). '</td>';
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
