<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<?php
    $title = "Inscription";
    include('header.php'); 
    
    //Liste des ligues existantes
    $ligues = New LigueDAO();
    $ligues = $ligues->findAll();
    //Liste des clubs existantes
    $clubs = New ClubDAO();
    $clubs = $clubs->findAll();
    //liste des données déjà existantes
    $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
    $mail=isset($_POST['mail']) ? $_POST['mail'] : NULL;
    $mdp=isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
    $mdp2=isset($_POST['mdp2']) ? $_POST['mdp2'] : NULL;
    $ligue=isset($_POST['ligue']) ? $_POST['ligue'] : NULL;
    $nom=isset($_POST['nom']) ? $_POST['nom'] : NULL;
    $prenom=isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
    $adresse=isset($_POST['adresse']) ? $_POST['adresse'] : NULL;
    $cp=isset($_POST['cp']) ? $_POST['cp'] : NULL;
    $ville=isset($_POST['ville']) ? $_POST['ville'] : NULL;
    $club=isset($_POST['club']) ? $_POST['club'] : NULL;
    $licence=isset($_POST['licence']) ? $_POST['licence'] : NULL;
    //DAO des users
    $users = New UserDAO();

    $note = New NoteDAO();
    //messages
    $messages = New Messages("error");
    $flash = New Flash();

    //Vérifie l'inscription
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

        if(empty(trim($adresse))){
            $messages->add_messages("Adresse vide");
        }

        if(empty(trim($cp))){
            $messages->add_messages("Code postal vide");
        }

        if(empty(trim($ville))){
            $messages->add_messages("Ville vide");
        }

        if(empty(trim($licence))){
            $messages->add_messages("Licence vide");
        }

        if(empty(trim($club))){
            $messages->add_messages("Club vide");
        }

        if($users->isExistPseudo($pseudo) == TRUE ){
            $messages->add_messages("Le pseudo éxiste déjà");
        }

        if($users->isExistMail($mail) == TRUE){
            $messages->add_messages("L'email existe déjà");
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

        $pattern = '/[\'\/~`\!@#$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        if(!preg_match($pattern, $mdp)){
            $messages->add_messages("Le mot de passe doit contenir au moins un caractère spécial");
            $messages->add_messages("Utilisez l'un de ses caractères spéciaux dans votre mot de passe : ^'£$%^&*()}{@:'#~?><>,;@|\-=-_+-`");
        }
            
        if(!($mdp === $mdp2)){
            $messages->add_messages("Les deux mots de passes ne sont pas identiques");
        }  
        
        if (!filter_input(INPUT_POST,"mail",FILTER_VALIDATE_EMAIL)){
            $messages->add_messages("Le champ email doit contenir une adresse mail");
        }
    
        //Si aucun message Inscription réussie et insertion dans BD
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
            $lastUser = new UserDAO();
            $lastUser = $lastUser->connexionUser($pseudo);
            $values = array(
                "nr_licence" => $licence,
                "adr1" => $adresse,
                "adr2" => $cp,
                "adr3" => $ville,
                "id_utilisateur" => $lastUser['id_utilisateur'],
                "id_club" => $club
            );
            $note->createNote($lastUser['id_utilisateur']);
            $adherent = new Adherent($values);
            $nAdherent = new AdherentDAO();
            $nAdherent = $nAdherent->newAdherent($adherent);

            $flash->set_type('succes')->add_messages('Vous vous êtes bien inscrit : '.$user->get_pseudo().'')->put();
            header("Location: connexion.php");
        }

    }
?>
<h1>Utilisateur</h1>
<h2>Inscription</h2>
<?php 
    if($messages->is_empty() == FALSE){
        $messages->afficher();
    }

?>



<form method="POST">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>"><br><br>

    <label for="mdp">Mot de Passe</label><br>
    <input type="password" id="mdp" name="mdp"><br><br>

    <label for="mdp2">Confirmation du mot de passe:</label><br>
    <input type="password" id="mdp2" name="mdp2"><br><br>

    <label for="mail">Mail</label><br>
    <input type="text" id="mail" name="mail" value="<?= $mail ?>"><br><br>

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" value="<?= $nom ?>"><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>"><br><br>


    <script language="Javascript">
				function getclub(val) {
					$.ajax({
					type: "POST",
					url: "get_club.php",
					data:'id_ligue='+val,
					success: function(data){
						$("#club").html(data);
					}
					});
				}

                function selectligue(val) {
                    $("#search-box").val(val);
                    $("#suggesstion-box").hide();
                }
    </script>

<label for="ligue">Ligue</label><br>
    <select name="ligue" id="ligue" onChange="getclub(this.value);">
        <option value=""selected>--Please choose an option--</option>
        <?php
            foreach($ligues as $liguee){
                $selected = NULL;
                if($ligue == $liguee->get_id_ligue()){
                    $selected = "selected";
                }else{
                    $selected = NULL;
                }
                echo "<option value=\"".$liguee->get_id_ligue()."\" $selected>".$liguee->get_lib_ligue()."</option>";
            }
        ?>
    </select><br><br>

<label for="club">Club</label><br>
            <select name="club" id="club">
                <option value="">--Please choose an option--</option>
            </select><br><br>
 

    <label for="adresse">Adresse</label><br>
    <input type="text" name="adresse" id="adresse" value="<?= $adresse ?>"><br><br>  

    <label for="cp">Code postal</label><br>
    <input type="text" name="cp" id="cp" value="<?= $cp ?>"><br><br>

    <label for="ville">Ville</label><br>
    <input type="text" name="ville" id="ville" value="<?= $ville ?>"><br><br>

    
    
    <label for="licence">N°Licence</label><br>
    <input type="text" name="licence" id="licence" value="<?= $licence ?>"><br><br>
    
    <input name="submit" type="submit" id="submit" value="S'inscrire">
</form>
<?php include('footer.php'); ?>