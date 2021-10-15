<?php
  include('header.php'); 
  
  $title = "Profil";
?>
  <h1>Bienvenu(e) <?= $session->get_pseudo() ?></h1>
  <h2>Page de mon profil</h2>
  <p>Mon rôle : <?= $session->get_role() ?></p>

  ee

<?php include('footer.php'); ?>