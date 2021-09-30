<?php
    include "init.php";
    //Liste des ligues existantes
    $ligues = New LigueDAO();
    $ligues = $ligues->findAll();

    //DAO des users
    $users = New UserDAO();

    if(isset($_POST['submit'])){
        $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
        $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
        $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
    }
    if(!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mdp']) && !empty($_POST['mdp2']) && !empty($_POST['ligue']) && !empty($_POST['nom']) && !empty($_POST['prenom']))  { //si tout les champs sonts remplis
        if($users->isExistPseudo($_POST['pseudo']) == FALSE ){
            if($users->isExistMail($_POST['email']) == FALSE){
                if($_POST['passe'] == $_POST['passe2']){   //si les mots de passes sont identique        
                    $mdp = $_POST['passe'];
                    $hash=password_hash($mdp, PASSWORD_BCRYPT); //hachage du mot de passe
                    $db->new_user(Array(
                        $_POST['pseudo'],
                        $hash,
                        $_POST['email'],
                        $_POST['nom'],
                        $_POST['prenom']
                    ));
                }
            }
        }else{
            echo "exception : mail deja existant";
        }
    }else{
        echo "exception : pseudo deja existant";
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
                            echo "<option value=".$ligue->get_id_ligue().">".$ligue->get_lib_ligue()."</option>";
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