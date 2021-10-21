
<?php
$title = "Admin Liste des utilisateurs";
include('header.php');

//chargement de la classe ligues
$users = new UserDAO();
$users = $users->findAll();

?>
  <h1>Admin</h1>
  <h2>Liste des Utilisateur</h2>
  <ul>
    <li><a href="charger_tables.php">Charger</a> les tables</li>
    <li><a href="utilisateur_liste.php">Liste</a> des utilisateurs</li>
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
        if ($user->get_role() == 2){
          $role = "Administrateur";
        }
        elseif ($user->get_role() == 1){
          $role = "Contrôleur";
        }
        elseif ($user->get_role() == 0){
          $role = "Adhérent";
        }
        echo '<tr>';
        echo '<td>' . $user->get_pseudo(). '</td>';
        echo '<td>' . $role. '</td>';
        echo '<td><a href="role_modifiers.php?id='.$user->get_id_utilisateur().'">Modifier Le role</a>';
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
