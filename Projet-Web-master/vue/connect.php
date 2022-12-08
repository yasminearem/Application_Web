<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="initial-scale=1, width=device-width"/>
    <title>Connexion</title>
    <link rel="stylesheet" href="../vue/connect.css" media="screen" title="no title">
    <link rel="stylesheet" href="../vue/accueil.css">
</head>
<body>
  <header>
		<div id="Banderole">

			<h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>
		</div>
  </header>

    <form method="post" id="formulaire" action="../controleur/verifIdent.php">

        <fieldset>
          <div class="hr"><span>Connexion</span></div>
            <label for="zone_id">E-Mail :</label>
            <input type="text" name="login" id="zone_id" required=""/>
            <br>
            <label for="zone_mdp">Mot de passe : </label>
            <input type="password" name="psw" id="zone_mdp" required=""/>
            <br>
            <input type="submit" value="Se Connecter"/>
            <br>
            <a href="../controleur/index.php?page=inscription">Vous n'avez pas de compte ?</a>
        </fieldset>
    </form>
    <br>

    <footer>
    	<p>Le projet web de Julien, Brenda, Alexandre et Raphael.</p>
    </footer>
</body>
</html>
