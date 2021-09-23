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
                <label for="nom">Pseudo<br><input type="text" name="nom"><br><br></label>
                <label for="Email">Email<br><input type="text" name="Email"><br><br></label>
                <label for="passe">Mot de Passe<br><input type="password" name="passe"><br><br></label>
                <label for="passe2">Confirmation du mot de passe: <br><input type="password" name="passe2"/></label><br><br>
                <label for="Ligue">Ligue</label><br>
                <select name="ligue" id="ligue-select">
                    <option value=""selected>--Please choose an option--</option>
                    <option value= 5 >Football</option>
                    <option value= 2 >BasketBall</option>
                    <option value= 4 >Handball</option>
                    <option value= 3 >Volley</option>
                </select><br><br>
                <p>
                    <input name="inscrire" type="submit" id="s'inscrire" value="s'inscrire">
                </p>
            </form>
        </div>

        <footer id="footer">
                <p>&copy;2021 | <a href="#">Site</a> | <a href="#">A propos</a> | <a href="#">Contact</a></p>
        </footer>
    
</body>

</html>