<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="../vue/accueil.css">
    <link rel="stylesheet" href="../vue/connect.css">
    <link rel="stylesheet" href="../vue/inscription.css">

</head>
<body>
  <header>
		<div id="Banderole">

			<h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>
		</div>
  </header>
<form method="post" id="formulaire" action="../controleur/ajoutProduit.php">
    <fieldset>
      <div class="hr"><span>Ajouter un produit</span></div>
        <label>Nom :</label>
        <input type="text" name="nom" id="nom" required=""/>
        <br>
        <label>Réference : </label>
        <input type="text" name="prenom" id="reference"  required=""/>
        <br>
        <label>Catégorie : </label>
        <input type="text" name="mail" id="categorie"  required=""/>
        <br>
        <label>Photo : </label>
        <input type="text" name="psw" id="photo" required=""/>
        <br>
        <label>Information complementaire</label>
        <textarea name="infoComplementaire" rows="2" cols="40"></textarea>
        <br>
        <input type="submit" value="Envoyer"/>
    </fieldset>
</form>
<footer>
	<p>Le projet web de Julien, Brenda, Alexandre et Raphael.</p>
</footer>
</body>
</html>
