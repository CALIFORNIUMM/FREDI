<?php
   include "init.php";
   $db=new sql();
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
            <form method="post">
                <label for="pseudo">Pseudo<br><input type="text" name="pseudo"><br><br></label>
                <label for="mdp">Mot de Passe<br><input type="password" name="mdp"><br><br></label>
                <p>
                    <input name="connexion" type="submit" id="connexion" value="Se connecter">
                </p>
            </form>
            <?php
                if (!empty($_POST['pseudo']) && !empty($_POST['mdp']))  { //si tout les champs sonts remplis
                    if($db->is_exist_pseudo($_POST['pseudo'] == TRUE)) {
                    $user = $db->connexion_user($_POST['pseudo']);
                        if(password_verify($_POST['mdp'],$user['mdp'])){
                            $user = new User($db->get_user($user['id_utilisateur']));
                            $_SESSION['user']=$user;
                        }
                    } else {
                        echo "erreur";
                    }
                }




                // $pseudo=isset($_POST['pseudo']) ? $_POST['pseudo'] :  "";
                // $password=isset($_POST['password']) ? $_POST['password'] :  "";
                // $sql="SELECT * FROM utilisateur WHERE pseudo=:pseudo";
                // try {
                //     $sth = $db->prepare($sql);
                //     $sth->execute(array(
                //         ':pseudo' => $pseudo
                //     ));
                //     $user = $sth->fetch(PDO::FETCH_ASSOC);
                // } 
                // catch (PDOException $ex) {
                //     die("Erreur lors de la requête SQL : " . $ex->getMessage());
                // }
                    
                // if($pseudo === $user['pseudo'] && password_verify($password,$user['mdp'])){
                //     unset($user["mdp"]);
                //     $_SESSION['user']=$user;
                //     $_SESSION['messages']=array(
                //         "connexion" => ["green", "Vous vous êtes bien connecté"]
                //     );

                // header("Location: index.php");

                // } else {
                //     $_SESSION['messages']=array("Account" => ["red", "Ces identifiants sont incorrects"]);
                //     header("Location: connexion.php");
                // }
        ?>
        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>
    
</body>

</html>