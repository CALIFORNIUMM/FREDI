<?php
  $title = "Contrôleur";
  include('header.php');
  $session = $_SESSION['user'];
?>
  <h1>Menu Contrôleur</h1>
  <h2>Page de contrôle</h2>

  <ul>
    <li><a href="liste_note_controleur.php">Liste</a> des notes actives</li>
  </ul>

<?php include('footer.php'); ?>
