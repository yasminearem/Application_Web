<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mon Compte</title>
  <link rel="stylesheet" href="../vue/accueil.css" media="screen" title="no title" >
  <link rel="stylesheet" href="../vue/compte.css" >
  <link rel="stylesheet" href="../vue/commande.css">
</head>
<body onload="init()">
  <header>
    <div id="Banderole">
      <h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>
    </div>
    <nav id="menu">
      <a href="../controleur/index.php?page=connexion"><img src="../data/utilisateur.png" alt="Image compte" id="monCompte" />Mon compte</a>
      <a href="../controleur/index.php?page=panier"><img src="../data/panier.png" alt="Image panier" id="panier"/>Mon panier</a>
      <a value="Accueil" href="../controleur/index.php?page=accueil"><img src="../data/maison.png" alt="Image accueil" id="accueil" /> Accueil</a>
      <a href="../controleur/index.php?page=deconnexion"><img src="../data/menu_logout.png" alt="Image deconnect" id="deconnect" />Deconnexion</a>

      <ul>
          <li><a href="../controleur/index.php?page=liste&categorie=mignon">Mignons</a></li>
          <li><a href="../controleur/index.php?page=liste&categorie=joli">Jolis</a></li>
          <li><a href="../controleur/index.php?page=liste&categorie=beaux">Beaux</a></li>
          <li><a href="../controleur/index.php?page=liste&categorie=craquand">Craquants</a></li>
          <li><a href="../controleur/index.php?page=liste&categorie=tous">Tous</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <article id="info">
      <img src="../data/utilisateur.png" alt="photo" />
      <h2>Nom Prenom </h2>
      <p>nom.prenom@utilisateur.fr</p>
    </article>

    <aside class="modification">
      <input type="button" name="name" value="Modifier mon profil">
    </aside>

    </section>
    <footer>
      <p>Le projet web de Julien, Brenda, Alexandre et Raphael.</p>
    </footer>

    <script type="text/javascript" src="../vue/compte.js"></script>
  </body>

  </html>
