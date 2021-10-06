<?php
  include('header.php'); 
  $title = "Mot de passe oublié";

  $mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
  $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
  $submit = isset($_POST['submit']) ? $_POST['submit'] : NULL;

  //messages
  $messages = New Messages("error");
  
  if(isset($submit)){

    //DAO user
    $user = new UserDAO();
    
    if(empty(trim($pseudo))){
      $messages->add_messages("Pseudo vide");
    }

    if(empty(trim($mail))){
      $messages->add_messages("Email vide");
    }

    if (!filter_input(INPUT_POST,"mail",FILTER_VALIDATE_EMAIL)){
      $messages->add_messages("Le champ email doit contenir une adresse mail");
    }

    if($user->isExistPseudo($pseudo) == FALSE ){
      $messages->add_messages("Le pseudo n'éxiste pas");
    }

    if($user->isExistMail($mail) == FALSE){
      $messages->add_messages("L'email n'éxiste pas");
    }

    if($messages->is_empty() == TRUE){
      $newmdp = new UserDAO();
      $newmdp = $newmdp->mdpOublieUser($pseudo);
      header('Location: connexion.php');
    }
  }
?>

<h1>Utilisateur</h1>
<h2>Mot de passe oublié</h2>

<?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }
?>
<form action="" method="POST">
  <label for="pseudo">Pseudo du compte</label><br>
  <input type="text" name="pseudo" id="pseudo" value="<?= $pseudo ?>"><br><br>
  <label for="mail">Adresse mail du compte</label><br>
  <input type="text" name="mail" id="mail" value="<?= $mail ?>"><br><br>
  <input type="submit" value="Recevoir" name="submit">


</form>

<?php include('footer.php'); ?>