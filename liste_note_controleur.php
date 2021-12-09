
<?php
$title = "Controleur Liste des Notes";
include('header.php');

//chargement de la classe ligues
$notes = new NoteDAO();
$notes = $notes->findPeriode();


?>
  <h1>Controleur</h1>

  <ul>
    <li><a href="liste_note_controleur.php">Liste</a> des notes actives</li>
  </ul>

  <?php
  if (count($notes) > 0) {
  ?>
    <table>
      <tr>
        <th>ID Utilisateur</th>
        <th>Pseudo</th>
        <th>ID Note</th>
        <th>Est valide ?</th>
        <th>Montant total</th>
        <th>Date de remise</th>
        <th>Numero d'ordre</th>
      </tr>

      <?php

      foreach ($notes as $note) {
        echo '<tr>';
        echo '<td>' . $note['id_utilisateur']. '</td>';
        echo '<td>' . $note['pseudo']. '</td>';
        echo '<td>' . $note['id_note']. '</td>';
        if ($note['est_valide']==1){
          echo '<td><p>Oui</p></td>';
        }
        else {
          echo '<td><p>Non</p></td>';
          }
        echo '<td>' . $note['mt_total']. '</td>';
        echo '<td>' . $note['dat_remise']. '</td>';
        echo '<td>' . $note['nr_ordre']. '</td>';
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
