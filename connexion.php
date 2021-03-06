<?php
    $title = "Connexion";
    include('header.php');
    
    //DAO user
    $user = new UserDAO();
    //liste des messages
    $messages = New Messages("error");
    $flash = New Flash();

    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
    //si form envoyé
    if(isset($_POST['submit'])){
        if(empty(trim($pseudo))){
            $messages->add_messages("Pseudo vide");
        }

        if(empty(trim($mdp))){
            $messages->add_messages("Mot de passe vide");
        }

        if($user->isExistPseudo($pseudo) == FALSE){
            $messages->add_messages("Le pseudo n'existe pas");
        }

        $log = new Log();
        $log->logConnexion($_SERVER['PHP_SELF'], $pseudo, $mdp);

        if($messages->is_empty() == TRUE){
            $utilisateur = $user->connexionUser($pseudo);
            if(password_verify($mdp, $utilisateur['mdp'])){
                $_SESSION['user'] = $user->find($utilisateur['id_utilisateur']);
                echo $_SESSION['user']->get_role();
                if($_SESSION['user']->get_role() == 1) {
                    $flash->set_type('succes')->add_messages('Vous vous êtes bien connecté : '.$_SESSION['user']->get_pseudo().'')->put();
                    header('Location: controleur.php');
                }
                else if($_SESSION['user']->get_role() == 2) {
                    $flash->set_type('succes')->add_messages('Vous vous êtes bien connecté : '.$_SESSION['user']->get_pseudo().'')->put();
                    header('Location: admin.php');
                }
                else {
                    $flash->set_type('succes')->add_messages('Vous vous êtes bien connecté : '.$_SESSION['user']->get_pseudo().'')->put();
                    header('Location: adherent.php');
                }
            }
            else{
                $messages->add_messages("Le mot de passe est faux");
            }
        }
    }
?>
    <h1>Utilisateur</h1>
    <h2>Connexion</h2>
    <?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }
?>
    <form method="POST">

        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" id="pseudo" value="<?= $pseudo ?>"><br>

        <label for="mdp">Mot de Passe</label><br>
        <input type="password" name="mdp" id="mdp"><br><br>

        <input name="submit" type="submit" id="submit" value="Se connecter">
    </form>
    <a href="mdpoublie.php">Mot de passe oublié ?</a>
<?php include('footer.php'); ?>