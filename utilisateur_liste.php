
<?php
  include('header.php');
  $title = "Utilisateur";

  //chargement de la classe ligues
  $users = new UserDAO();
  $users = $users->findAll();

?>
  <h1>Admin</h1>
  <h2>Liste des Utilisateur</h2>
  <ul>
    <li><a href="motifs_charger.php">Charger motifs</a></li>
    <li><a href="motifs_liste.php">Liste motifs</a></li>
    <li><a href="clubs_charger.php">Charger clubs</a></li>
    <li><a href="clubs_liste.php">Liste clubs</a></li>
    <li><a href="ligues_charger.php">Charger ligues</a></li>
    <li><a href="ligues_liste.php">Liste ligues</a></li>
  </ul>

  <?php
  if (count($users) > 0) {
  ?>
    <table>
      <tr>
        <th>Pseudo</th>
        <th>Role</th>
      </tr>
      <?php
      foreach ($users as $user) {
        $role= "";
        if ($user->get_role() == 0){
          $role = "Administrateur";
        }
        elseif ($user->get_role() == 1){
          $role = "Contrôleur.";
        }
        elseif ($user->get_role() == 2){
          $role = "Adhérent,.";
        }
        echo '<tr>';
        echo '<td>' . $user->get_pseudo(). '</td>';
        echo '<td>' . $role. '</td>';
        echo "</tr>";
      } ?>
    </table>
<?php
} else {
  echo "<p>Rien à afficher</p>";
}
echo "<p>". count($users) ." Utilisateur(s)</p>";
?>
<?php include('footer.php'); ?>
