<?php include('header.php'); 
    $title = "Inscription";

    //Liste des ligues existantes
    $ligues = New LigueDAO();
    $ligues = $ligues->findAll();
    //liste des données déjà existantes
    $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
    $mail=isset($_POST['mail']) ? $_POST['mail'] : NULL;
    $mdp=isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
    $mdp2=isset($_POST['mdp2']) ? $_POST['mdp2'] : NULL;
    $ligue=isset($_POST['ligue']) ? $_POST['ligue'] : NULL;
    $nom=isset($_POST['nom']) ? $_POST['nom'] : NULL;
    $prenom=isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
    //DAO des users
    $users = New UserDAO();
    //messages
    $messages = New Messages("error");

    if(isset($_POST['submit'])){
        if(empty(trim($pseudo))){
            $messages->add_messages("Pseudo vide");
        }

        if(empty(trim($mail))){
            $messages->add_messages("Email vide");
        }
        
        if(empty(trim($mdp))){
            $messages->add_messages("Mot de passe vide");
        }

        if(empty(trim($mdp2))){
            $messages->add_messages("Second mot de passe vide");
        }

        if(empty(trim($ligue))){
            $messages->add_messages("Ligue vide");
        }

        if(empty(trim($nom))){
            $messages->add_messages("Nom vide");
        }

        if(empty(trim($prenom))){
            $messages->add_messages("Prénom vide");
        }

        if($users->isExistPseudo($pseudo) == TRUE ){
            $messages->add_messages("Le pseudo éxiste déjà");
        }

        if($users->isExistMail($mail) == TRUE){
            $messages->add_messages("L'email éxiste déjà");
        }

        if(mb_strlen($mdp) < 8){
            $messages->add_messages("Le mot de passe doit faire 8 caractères");
        }

        if(!preg_match("#[a-z]#", $mdp)){
            $messages->add_messages("Le mot de passe doit contenir au moins une minuscule");
        }

        if(!preg_match("#[A-Z]#", $mdp)){
            $messages->add_messages("Le mot de passe doit contenir au moins une majuscule");
        }

        if(!preg_match("#[0-9]#", $mdp)){
            $messages->add_messages("Le mot de passe doit contenir au moins un chiffre");
        }

        if(!preg_match("#[\W]#", $mdp)){
            $messages->add_messages("Le mot de passe doit contenir au moins uncaractère spécial");
        }
            
        if(!($mdp === $mdp2)){
            $messages->add_messages("Les deux mots de passes ne sont pas identiques");
        }  
        
        if (!filter_input(INPUT_POST,"mail",FILTER_VALIDATE_EMAIL)){
            $messages->add_messages("Le champ email doit contenir une adresse mail");
        }
    
        if($messages->is_empty() == TRUE){
            $hash=password_hash($mdp, PASSWORD_BCRYPT); //hachage du mot de passe
            $values = array(
                'pseudo' => $pseudo,
                'mdp' => $hash,
                'mail' => $mail,
                'nom' => $nom,
                'prenom' => $prenom,
                'role' => 0
            );
            $user = new User($values);
            $nUser = new UserDAO();
            $nUser = $nUser->newUser($user);
            echo 'Vous vous êtes bien inscrit';
            header("Location: connexion.php");
        }

    }
?>
<h1>M2L</h1>
<h2>Inscription</h2>
<?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }
?>
<form method="POST">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>"><br>

    <label for="mdp">Mot de Passe</label><br>
    <input type="password" id="mdp" name="mdp"><br>

    <label for="mdp2">Confirmation du mot de passe:</label><br>
    <input type="password" id="mdp2" name="mdp2"><br>

    <label for="mail">Mail</label><br>
    <input type="text" id="mail" name="mail" value="<?= $mail ?>"><br>

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" value="<?= $nom ?>"><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>"><br>
    
    <label for="ligue">Ligue</label><br>
    <select name="ligue" id="ligue">
        <option value=""selected>--Please choose an option--</option>
        <?php
            foreach($ligues as $ligue){
                echo "<option value=\"".$ligue->get_id_ligue()."\">".$ligue->get_lib_ligue()."</option>";
            }
        ?>
        
    </select><br><br>
    
    <input name="submit" type="submit" id="submit" value="S'inscrire">
</form>
<?php include('footer.php'); ?>