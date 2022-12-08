<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admnistration utilisateur</title>
  <link rel="stylesheet" href="../vue/accueil.css" media="screen" title="no title" >
  <link rel="stylesheet" href="../vue/compte.css" >
  <link rel="stylesheet" href="../vue/admin.css">
  <link rel="stylesheet" href="../vue/administrationUtilisateur.css">
</head>
<body>
  <header>
    <div id="Banderole">
      <h1><a href="../controleur/index.php?page=accueil"><img src="../data/logo-chat.png" alt="logo" id="logo"/></a> Bienvenue sur le site des chatons</h1>
    </div>
    <nav id="menu">
      <a href="../controleur/index.php?page=admin"><img src="../data/utilisateur.png" alt="Image compte" id="monCompte" />Mon compte</a>
      <a href="../controleur/index.php?page=deconnexion"><img src="../data/menu_logout.png" alt="Image deconnect" id="deconnect" />Deconnexion</a>
      <ul>
        <li><a href="../controleur/index.php?page=administrationUtilisateur">Utilisateurs</a></li>
        <li><a href="../controleur/index.php?page=administrationProduit">Produits</a></li>
      </ul>
    </nav>
  </header>

  <section>
    <!-- <input type="button" name="name" value="Ajouter utilisateur"> -->
    <a href="../controleur/index.php?page=inscription">Ajouter utilisateur</a>
    <table>
      <caption>Liste utilisateurs</caption>
      <?php require_once( '../modele/DAO.php');
      require_once( '../modele/classes.php');
      $dao=new DAO();

      $utilisateur = $dao->getAllUtilisateurs();


    ?>
      <tr>

        <th>Nom</th>
        <th>Prenom</th>
        <th>Mail</th>
        <th>Action</th>
      </tr>
      <tr>
        <?php $i=0;
          for($i; $i<(count($utilisateur)-1);$i++){
         ?>
        <?php echo "<tr><td>".$utilisateur[$i]->getNom()."</td>
        <td>".$utilisateur[$i]->getPrenom()."</td></td>
        <td>".$utilisateur[$i]->getMail()."</td>
        <td><a href=''>Supprimer</a> <a href=''>Modifier</a>"."</tr>";}?>



      <tr>
        <td><?php echo $utilisateur[1]->getNom(); ?></td>
        <td><?php echo $utilisateur[1]->getPrenom(); ?></td>
        <td><?php echo $utilisateur[1]->getMail(); ?></td>
        <td><a href="#">Supprimer</a> <a href="#">Modifier</a></td>
      </tr>
      <tr>
        <td><?php echo $utilisateur[2]->getNom(); ?></td>
        <td><?php echo $utilisateur[2]->getPrenom(); ?></td>
        <td><?php echo $utilisateur[2]->getMail(); ?></td>
        <td><a href="#">Supprimer</a> <a href="#">Modifier</a></td>
      </tr>
      <tr>
        <td><?php echo $utilisateur[3]->getNom(); ?></td>
        <td><?php echo $utilisateur[3]->getPrenom(); ?></td>
        <td><?php echo $utilisateur[3]->getMail(); ?></td>
        <td><a href="#">Supprimer</a> <a href="#">Modifier</a></td>
      </tr>
    </table>
    <a href="#" id="precedent"><img src="../data/fleche1.png" alt="test"></a>
    <a href="#" id="suivant"><img src="../data/fleche2.png" alt="test"></a>
  </section>

</body>
</html>
