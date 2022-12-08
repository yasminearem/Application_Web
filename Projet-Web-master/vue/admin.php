<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="../vue/accueil.css" media="screen" title="no title" >
  <link rel="stylesheet" href="../vue/compte.css" >
  <link rel="stylesheet" href="../vue/admin.css">
</head>
<body>
  <header>
    <div id="Banderole">
      <h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>
    </div>
    <nav id="menu">
      <span><a href="../controleur/index.php?page=deconnexion"><img src="../data/menu_logout.png" alt="Image deconnect" id="monCompte" />Deconnexion</a></span>
      <ul>
        <li><a href="../controleur/index.php?page=administrationUtilisateur">Utilisateurs</a></li>
        <li><a href="../controleur/index.php?page=administrationProduit">Produits</a></li>
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
    </aside>

    </section>
    <footer>
      <p>Le projet web de Julien, Brenda, Alexandre et Raphael.</p>
    </footer>
  </body>
  </html>
