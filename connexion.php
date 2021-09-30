<?php
    include "init.php";

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
            <h2>Connexion</h2>
            <form method="POST">

                <label for="pseudo">Pseudo</label><br>
                <input type="text" name="pseudo" id="pseudo"><br>

                <label for="mdp">Mot de Passe</label><br>
                <input type="password" name="mdp" id="mdp"><br><br>

                <input name="submit" type="submit" id="submit" value="Se connecter">
            </form>
        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>
    
</body>

</html>