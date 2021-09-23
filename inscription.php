<?php
   include "autoload.php";
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
            <h2>Inscription</h2>
            <form method="post">
                <label for="pseudo">Pseudo<br><input type="text" name="pseudo"><br><br></label>
                <label for="passe">Mot de Passe<br><input type="password" name="passe"><br><br></label>
                <label for="passe2">Confirmation du mot de passe: <br><input type="password" name="passe2"/></label><br><br>
                <label for="Email">Email<br><input type="text" name="Email"><br><br></label>
                <label for="Nom">Nom<br><input type="text" name="Nom"><br><br></label>
                <label for="Prenom">Prénom<br><input type="text" name="Prenom"><br><br></label>
                <label for="Ligue">Ligue</label><br>
                <select name="ligue" id="ligue-select">
                    <option value=""selected>--Please choose an option--</option>
                    <?php
                        foreach($db->select_all("ligue") as $ligue){
                            echo "<option value= ".$ligue['id_ligue'].">".$ligue['lib_ligue']."</option>";
                        }
                    ?>
                </select><br><br>
                <p>
                    <input name="inscrire" type="submit" id="s'inscrire" value="s'inscrire">
                </p>
            </form>
            <?php
            if (!empty($_POST['pseudo']) && !empty($_POST['Email']) && !empty($_POST['passe']) && !empty($_POST['passe2']) && !empty($_POST['ligue']) && !empty($_POST['nom']) && !empty($_POST['prenom']))  { //si tout les champs sonts remplis
            if($_POST['passe'] == $_POST['passe2']){   //si les mots de passes sont identique        
                $mdp = $_POST['passe'];
                $hash=password_hash($mdp, PASSWORD_BCRYPT); //hachage du mot de passe
                $db->new_user(Array(
                    $_POST['pseudo'],
                    $hash,
                    $_POST['Email'],
                    $_POST['nom'],
                    $_POST['prenom']
                ));
            }   
         }
        ?>
        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>
    
</body>

</html>