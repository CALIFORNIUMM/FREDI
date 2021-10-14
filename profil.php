<?php
  include('header.php'); 
  
  $title = "Profil";
  $session = $_SESSION['user'];
?>
  <h1>Bienvenu(e) <?= $session->get_pseudo() ?></h1>
  <h2>Page de mon profil</h2>
  <p>Mon rôle : <?= $session->get_role() ?></p>

  

<?php include('footer.php'); ?>