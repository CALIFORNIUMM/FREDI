<?php include('header.php'); 
  $title = "Profil";
  $session = $_SESSION['user'];
  var_dump($session);
?>
  <h1>M2L</h1>
  <h2>Page de mon profil</h2>
  <p>Mon rôle : <?= $session['role'] ?></p>

  

<?php include('footer.php'); ?>