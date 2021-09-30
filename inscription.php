<?php
    include "init.php";
    //Liste des ligues existantes
    $ligues = New LigueDAO();
    $ligues = $ligues->findAll();

    //DAO des users
    $users = New UserDAO();

    if(isset($_POST['submit'])){
        
        $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
        $mail=isset($_POST['mail']) ? $_POST['mail'] : NULL;
        $mdp=isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
        $mdp2=isset($_POST['mdp2']) ? $_POST['mdp2'] : NULL;
        $ligue=isset($_POST['ligue']) ? $_POST['ligue'] : NULL;
        $nom=isset($_POST['nom']) ? $_POST['nom'] : NULL;
        $prenom=isset($_POST['prenom']) ? $_POST['prenom'] : NULL;

        if($pseudo != NULL && $mail != NULL && $mdp != NULL && $mdp2 != NULL && $ligue != NULL && $nom != NULL && $prenom != NULL) { //si tout les champs sonts remplis
            if($users->isExistPseudo($pseudo) == FALSE ){
                if($users->isExistMail($mail) == FALSE){
                    if(strlen($mdp)>7 && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$#%^&]).*$/', $mdp) == TRUE){
                        if($mdp == $mdp2){   //si les mots de passes sont identique
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
                    }else{
                        echo "Le mot de passe n'est pas assez sécurisé";
                    }
                }else{
                    echo "exception : mail deja existant";
                }
            }else{
                echo "exception : pseudo deja existant";
            }
        }else{
            echo "exception : champs vides";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>FREDI - ACCUEIL</title>
</head>

<body>
    
    <div class="banner">
        <div class="banner-inner">
            <h1>HEADER</h1>
        </div>
    </div>

    <header id="header">
        <div id="header-inner">
            <div id="logo">
                <h1><a href="#">LOGO</a></h1>
            </div>

            <div id="top-nav">
                <ul>
                    <li><a href="#">PAGE1</a></li>
                    <li><a href="#">PAGE2</a></li>
                    <li><a href="#">PAGE3</a></li>
                    <li><a href="#">SE CONNECTER</a></li>
                    <li><a href="#">S'INSCRIRE</a></li>
                </ul>
            </div>
            <div class="bas-nav"></div>
        </div>
    </header>

        <div id="content">
            <h1>M2L</h1>
            <h2>Inscription</h2>
            <form method="POST">
                <label for="pseudo">Pseudo</label><br>
                <input type="text" id="pseudo" name="pseudo"><br>

                <label for="mdp">Mot de Passe</label><br>
                <input type="password" id="mdp" name="mdp"><br>
            
                <label for="mdp2">Confirmation du mot de passe:</label><br>
                <input type="password" id="mdp2" name="mdp2"/><br>

                <label for="mail">Mail</label><br>
                <input type="text" id="mail" name="mail"><br>

                <label for="nom">Nom</label><br>
                <input type="text" id="nom" name="nom"><br>

                <label for="prenom">Prénom</label><br>
                <input type="text" id="prenom" name="prenom"><br>
                
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
        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>
    
</body>

</html>