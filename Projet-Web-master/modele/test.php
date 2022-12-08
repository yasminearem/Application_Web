<?php

/*

Fichier de test pour la DAO et les classes.

Auteurs : AG, RC.

*/

include_once "classes.php";
include_once "DAO.php";

echo "\n === TESTS CLASSES ET DAO === \n\n";



// -------------------
// Test des classes
// -------------------


// création, lecture, mise à jour et suppression d'un produit
$prod = new Produit("chaton", "animal poilu", 100, "reference bidon", "chaton-01.jpg");
try {
    $prod = new Produit("chaton", "animal poilu", 100, "reference bidon", "chaton-01.jpg", "argument en trop");
    /*
        Étonnament, cet appel fonctionne, alors qu'il ne devrait pas,
        c'est inattendu!!
    */
}
catch (Exception $e) {
    echo "Erreur : ".$e->getMessage();
}
$prod2 = new Produit();
assert($prod->getProduit()==$prod);
assert($prod->getRef()=="reference bidon");
unset($prod, $prod2);
echo "Produit OK\n";


// création, lecture, mise à jour et suppression d'un utilisateur
$util=new Utilisateur("casta", "raf", "r.c@free.fr", "mdptoutpourri");
$util2 = new Utilisateur();
assert($util->getMail()=="r.c@free.fr");
$util->setPrenom("Pierre");
assert($util->getPrenom()=="Pierre");
unset($util, $util2);
echo "Utilisateur OK\n";


// création, lecture, mise à jour et suppression d'une categorie
$cat1 = new Categorie("Mignons");
$cat2 = new Categorie('Jolis');
$cat3 = new Categorie();
assert($cat1->nom=="Mignons");
$cat2->nom = "Miaou";
assert($cat2->nom=="Miaou");
unset($cat1, $cat2, $cat3);
echo "Categorie OK\n";


// création, lecture, mise à jour et suppression d'une ligne de panier
$ligne1 = new LignePanier("date coucou", "mel", "ref", 2, TRUE);
$ligne2 = new LignePanier();
$ligne3 = new LignePanier("date", "r.c@free.fr", "bla");
assert($ligne1->mail == "mel");
assert($ligne3->ref=="bla");
assert($ligne2->date=='');
$ligne2->mail="r.c@free.fr";
$ligne2->valide=TRUE;
unset($ligne1, $ligne2, $ligne3);
echo "Ligne de Panier OK\n";


// création, lecture, mise à jour et suppression d'une association appartient à
$app1 = new AppartientA();
$app2 = new AppartientA("plouf", "plic");
$app3 = new AppartientA("cocou");
assert($app2->ref == "plic");
assert($app3->nom == "cocou");
$app1->nom = 'nome';
$app3->ref = "reference";
unset($app1, $app2, $app3);
echo "AppartientA OK\n";




// ----------------------------
// Test des Méthodes de la DAO
// ----------------------------


// ----------------------------
// création de la DAO
// ----------------------------
try {
    $dao=new DAO();
} catch (Exception $e) {
    echo "DEBUG : ".$e->getMessage();
}
echo "DAO OK\n";


// ----------------------------
// utilisateur DAO
// ----------------------------
echo "\n --- Utilisateur ---\n";
try {
    $dao->deleteUtilisateur("vialaj@gmail.com");
} catch (Exception $e) {
    echo "0 DEBUG : ".$e->getMessage();
}
$user = new Utilisateur("viala", "julien", "vialaj@gmail.com", "plouf");
try {
    $dao->createUtilisateur($user);
} catch (Exception $e) {
    echo "1 DEBUG : ".$e->getMessage();
}
assert($dao->getUtilisateur($user->mail)[0]==$user);
try {
    $dao->createUtilisateur($user);
} catch (Exception $e) {
    echo "2 OK : ".$e->getMessage();
}
$utilisateurs = $dao->getAllUtilisateurs();
try {
    $dao->updateUtilisateur("hoareau", "brenda", "chatons", "idem");
} catch (Exception $e) {
    echo "3 OK : ".$e->getMessage();
}
try {
    $dao->updateUtilisateur("hoareau", "brenda", "vialaj@gmail.com", "idem");
} catch (Exception $e) {
    echo "4 DEBUG : ".$e->getMessage();
}
//assert($dao->getAllUtilisateurs()[0]->prenom == "brenda");
// On préfèrera ne pas supprimer tous les utilisateurs à chaque test, cela peut agir sur les utilisateurs ajoutés par d'autres programmeurs
// foreach ($utilisateurs as $key => $util) {
//     $dao->deleteUtilisateur($util->mail);
// }
// assert($dao->getAllUtilisateurs()== []);
echo "Utilisateur DAO OK\n";


// ----------------------------
// produit DAO
// ----------------------------
echo "\n --- Create Produit ---\n";
$prod1 = new Produit("chaton1", "animal tout doux", 10, "ch4T", "chaton.jpg");
$prod2 = new Produit("chaton2", "animal poilu", 100, "reference bidon", "chaton-01.jpg", "argument en trop");
try {
    $dao->createProduit($prod1);
    $dao->createProduit($prod1);
} catch (Exception $e) {
    echo "1 DEBUG : ".$e->getMessage();
}
try {
    $dao->createProduit(new Produit());
} catch (Exception $e) {
    echo "2 OK : ".$e->getMessage();
}
try {
    $dao->createProduit($prod2);
} catch (Exception $e) {
    echo "3 DEBUG : ".$e->getMessage();
}
try {
    $dao->createProduit(new Produit(123, 'poqsdf', -20));
} catch (Exception $e) {
    echo "4 OK : ".$e->getMessage();
}
try {
    $dao->createProduit($prod1);
} catch (Exception $e) {
    echo "5 OK : ".$e->getMessage();
}
echo "Create Produit OK\n";


// ----------------------------
// produits tous
// ----------------------------
echo "\n --- Get Produits ---\n";
try {
    $prods = $dao->getProduits();
} catch (Exception $e) {
    echo "1 DEBUG : ".$e->getMessage();
}
echo "Nombre de produits : ".count($prods)."\n";
try {
    // Meme problème ici : on peut passer des paramètres, ça ne pose apparemment pas de problème ...
    $dao->getProduits();
} catch (Exception $e) {
    echo "2 OK : ".$e->getMessage();
}
echo "Get Produits OK\n";


// ----------------------------
// produit par reference
// ----------------------------
echo "\n --- Get Produit Ref ---\n";

// echo "Debut 6\n";
// try {
//     $dao->getProduitRef();
// } catch (Exception $e) {
//     echo "6 OK : ".$e->getMessage();
// }
// echo "Fin 6\n";
try {
    $dao->getProduitRef("blabla");
} catch (Exception $e) {
    echo "7 OK : ".$e->getMessage();
}
echo "Get Produit Ref OK\n";


// ----------------------------
// categorie DAO
// ----------------------------
echo "\n --- Categorie ---\n";
try {
    $dao->createCategorie("Mignons");
} catch (Exception $e) {
    echo "1 DEBUG : ".$e->getMessage();
}
try {
    $dao->createCategorie(123);
} catch (Exception $e) {
    echo "2 DEBUG : ".$e->getMessage();
}
// echo "Debut 3 DEBUG : \n";
// try {
//     $dao->createCategorie();
// } catch (Exception $e) {
//     echo "3 OK : ".$e->getMessage();
// }
// echo "Fin 3 DEBUG : \n";
// try {
//     $dao->deleteCategorie();
// } catch (Exception $e) {
//     echo "4 OK : ".$e->getMessage();
// }
// echo "Fin 4 DEBUG : \n";
try {
    $dao->deleteCategorie("Mignons");
} catch (Exception $e) {
    echo "5 DEBUG : ".$e->getMessage();
}
echo "Categorie DAO OK\n";


// ----------------------------
// produit par categorie
// ----------------------------
echo "\n --- Get Produit Catégorie ---\n";
try {
    $mignons = $dao->getProduitsCategorie("Mignons");
} catch (Exception $e) {
    echo "8 DEBUG : ".$e->getMessage();
}
//assert($mignons == []);
echo "Get Produit Cat OK\n";


// ----------------------------
// produit par utilisateur
// ----------------------------
echo "\n --- Produits Utilisateur ---\n";
$util=new Utilisateur("casta", "raf", "r.c@free.fr", "mdppourri");
$dao->deleteUtilisateur($util->mail);
$prod1 = new Produit("chaton1", "animal tout doux", 10, "ch4T", "chaton.jpg");
$prod2 = new Produit("chaton2", "animal poilu", 100, "reference bidon", "chaton-01.jpg");
$lignePanier1 = new LignePanier("date normale", $util->mail, $prod1->ref, 2);
$lignePanier2 = new LignePanier("date hier", $util->mail, $prod2->ref, 5, TRUE);
try {
    $dao->createUtilisateur($util);
    $dao->createProduit($prod1);
    $dao->createProduit($prod2);
    $dao->createLignePanier($lignePanier1);
    $dao->createLignePanier($lignePanier2);
} catch (Exception $e) {
    echo "01 DEBUG : ".$e->getMessage();
}
echo "Création util, prod et ligne OK\n";
try {
    $produits = $dao->getProduitsUtilisateur($util->mail);
} catch (Exception $e) {
    echo "02 DEBUG : ".$e->getMessage();
}
//var_dump($dao->getProduits());
echo "Produits Utilisateur DAO OK\n";


echo "\n === FIN TESTS === \n\n";

?>
