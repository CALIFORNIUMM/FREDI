<?php
  include('header.php'); 
  $title = "Mot de passe oublié";

  $mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
  $submit = isset($_POST['submit']) ? $_POST['submit'] : NULL;

  if(isset($submit)){
    echo "oklm";
  }
?>

<form action="" method="POST">
  <label for="mail">Adresse mail du compte</label><br>
  <input type="text" name="mail" id="mail" value="<?= $mail ?>"><br><br>
  <input type="submit" value="Recevoir" name="submit">


</form>

<?php include('footer.php'); ?>