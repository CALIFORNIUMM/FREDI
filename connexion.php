<?php
  include('header.php');
  $title = "Connexion";
  
  if(isset($_POST['submit'])){
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
    if($pseudo != NULL && $mdp  != NULL){
        $user = new UserDAO();
        if($user->isExistPseudo($pseudo) == TRUE){
            $user = $user->connexionUser($pseudo);
            if(password_verify($user['mdp'], $mdp)){
                echo 'ok';
            }else{
                echo 'non';
            }
        }
    }
    die();
}
?>
    <h1>M2L</h1>
    <h2>Connexion</h2>
    <form method="POST">

        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" id="pseudo"><br>

        <label for="mdp">Mot de Passe</label><br>
        <input type="password" name="mdp" id="mdp"><br><br>

        <input name="submit" type="submit" id="submit" value="Se connecter">
    </form>
<?php include('footer.php'); ?>