<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->
<!DOCTYPE html>
<html>
<head>
	<title>Accueil - Chatons</title>
	<link rel="stylesheet" type="text/css" href="../vue/accueil.css">
</head>
<body>

	<header>
		<div id="Banderole">

			<h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>


		</div>
		<nav id="menu">
			<a href="../controleur/index.php?page=compte"><img src="../data/utilisateur.png" alt="Image compte" id="monCompte" />Mon compte</a>
			<a href="../controleur/index.php?page=panier"><img src="../data/panier.png" alt="Image panier" id="panier"/>Mon panier</a>
			<ul>
                <li><a href="../controleur/index.php?page=liste&categorie=Mignons">Mignons</a></li>
                <li><a href="../controleur/index.php?page=liste&categorie=Jolis">Jolis</a></li>
                <li><a href="../controleur/index.php?page=liste&categorie=Beaux">Beaux</a></li>
                <li><a href="../controleur/index.php?page=liste&categorie=Craquants">Craquants</a></li>
                <li><a href="../controleur/index.php?page=liste&categorie=Tous">Tous</a></li>
			</ul>
		</nav>

	</header>

	<div id="erreur" style="text-align:center;">
		<h1>Une erreur est survenue</h1>
	</div>
<footer>
	<p>Le projet web de Julien, Brenda, Alexandre et Raphael.</p>
</footer>
</body>
</html>
