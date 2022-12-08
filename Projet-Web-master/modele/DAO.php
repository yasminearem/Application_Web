<?php

/*

Fichier PHP de gestion des objets du modèle.

Auteurs : AG, RC.

*/

include_once "classes.php";

// ----------------------
// DAO
// ----------------------
class DAO {

  private $db; /* PDO de la base */

  function __construct() {
    try {
      $this->db=new PDO('sqlite:../modele/data/base.db');
    } catch (PDOException $e) {
      throw new Exception("\nERREUR : ".$e->getMessage());
    }
  }

  // ----------------------
  // Fonctions CRUD classe Utilisateur
  // ----------------------

  function getUtilisateur($mail, $mdp='') {
    // Renvoie un tableau contenant 1 utilisateur (si il existe)
    // Sécurité : attention aux passages de code SQL (injections possibles)
    if ($mdp == '') {
      $req="SELECT * FROM utilisateur WHERE mail='$mail'";
    } else {
      $req="SELECT * FROM utilisateur WHERE mail='$mail' AND mdp='$mdp'";
    }
    $ligne=$this->db->query($req);
    if ($ligne == FALSE) {
      return FALSE;
    } else {
      $util=$ligne->fetchAll(PDO::FETCH_CLASS, "Utilisateur");
      return $util;
    }
  }

  function createUtilisateur($util) {
    // Crée un utilisatuer à partir de l'objet utilisateur passé en paramètre
    $nom=$util->getNom();
    $prenom=$util->getPrenom();
    $mail=$util->mail;
    $mdp=$util->getMdp();
    $existant=$this->getUtilisateur($mail);
    if($existant == FALSE) {
      $req="INSERT INTO utilisateur VALUES('$nom', '$prenom', '$mail', '$mdp')";
      $resExec=$this->db->exec($req);
      //var_dump($resExec);
      if ($resExec === FALSE) {
        throw new Exception("ERREUR : Impossible de créer l'utilisateur\n");
      }
    } else {
      throw new Exception("ERREUR : l'adresse mail ".$util->mail." existe déjà\n");
    }
  }

  function getAllUtilisateurs() {
    // Renvoie un tableau contenant tous les utilisateurs
    $req="SELECT * FROM utilisateur";
    $ligne=$this->db->query($req);
    if ($ligne == FALSE) {
      var_dump($this->db->errorInfo());
      throw new Exception("Erreur dans getAllUtilisateurs");
    }
    else {
      $utils=$ligne->fetchAll(PDO::FETCH_CLASS, "Utilisateur");
      return $utils;
    }
  }

  function deleteUtilisateur($mail) {
    // Supprime un utilisateur dont l'adresse mail est passée en paramètre
    $req="DELETE FROM utilisateur WHERE mail='$mail'";
    $resExec=$this->db->exec($req);
    if($resExec == 0)
    echo("L'utilisateur d'adresse mail ".$mail." n'existe pas\n");
  }

  function updateUtilisateur($nom, $prenom, $mail, $mdp) {
    // Modifie un utilisateur existant avec les nouvelles valeurs
    $existant=$this->getUtilisateur($mail);
    if ($existant == FALSE)
        throw new Exception("ERREUR : L'utilisateur d'adresse mail ".$mail." n'existe pas\n");
    else {
      $req="UPDATE utilisateur SET nom='$nom', prenom='$prenom', mail='$mail', mdp='$mdp' WHERE mail='$mail'";
      $resExec=$this->db->exec($req);
      if ($resExec == 0) {
        throw new Exception("ERREUR : impossible de mettre à jour les informations de l'utilisateur d'adresse mail ".$mail."\n");
      }
    }
  }

  // ----------------------
  // fonctions CRUD classe Produit
  // ----------------------

  function createProduit($prod) {
    // Ajoute un produit à la base, à condition que sa ref n'existe pas encore
    $ref=$prod->getRef();
    $complement=$prod->getComplement();
    $intitule=$prod->getIntitule();
    $prix=$prod->getPrix();
    $photo=$prod->getPhoto();
    $existant=$this->getProduitRef($ref);
    if ($existant == FALSE) { // Ce test ne marche pas !!!
      if ($prix < 0)
        throw new Exception("ERREUR : le prix est invalide (négatif)\n");
      else {
        $req="INSERT INTO produit VALUES('$intitule', '$complement', $prix, '$ref', '$photo')";
        $this->db->exec($req);
      }
    } else
      throw new Exception("ERREUR : le produit de référence ".$ref." existe déjà\n");
  }

  function getProduitRef($ref) {
    // Renvoie le produit de référence $REF

    // Ajouter test : si pas de ref passée, renvoyer une erreur
    // ou alors renvoyer tous
    // ou alors envoyer false
    // ...

    $req="SELECT * FROM produit WHERE ref='$ref'";
    $ligne=$this->db->query($req);
    if ($ligne == FALSE) return FALSE;
    else {
      $prod=$ligne->fetchAll(PDO::FETCH_CLASS, "Produit");
      return $prod;
    }
  }

  function getProduits() {
    // Renvoie un tableau contenant tous les produits de la base
    $req="SELECT * FROM produit";
    $ligne=$this->db->query($req);
    if ($ligne==FALSE)
      throw new Exception("Erreur dans getProduits()\n");
    else
      return $ligne->fetchAll(PDO::FETCH_CLASS, "Produit");
  }

  function getProduitsMinMax($prixMin, $prixMax) {
    // Renvoie un tableau contenant tous les produits dont le prix est compris entre les bornes passées en paramètre
    $req="SELECT * FROM produit WHERE (prix>=$prixMin AND prix<=$prixMax)";
    $ligne=$this->db->query($req);
    if ($ligne==FALSE)
      throw new Exception("Erreur dans getProduitsMinMax()\n");
    else
      return($ligne->fetchAll(PDO::FETCH_CLASS, "Produit"));
  }

  function getProduitsCategorie($nom) {
    // Renvoie un tableau contenant les produits de la catégorie passée en paramètre
    $req="SELECT * FROM produit NATURAL JOIN appartient_a WHERE nom='$nom'";
    $ligne=$this->db->query($req);
    // Attention : si une catégorie n'est associée à aucun produit, ce n'est pas parce qu'elle est fausse!
    if ($ligne==FALSE)
      //throw new Exception("Erreur dans getProduitsCategorie()\n");
      return FALSE;
    else
      return($ligne->fetchAll(PDO::FETCH_CLASS, "Produit"));
  }

  function getProduitsUtilisateur($mail) {
    // Renvoie un tableau contenant les produits de l'utilisateur (donc son panier) dont le mail est passé en paramètre
    $util=$this->getUtilisateur($mail);
    if ($util == FALSE)
      throw new Exception("ERREUR : l'utilisateur d'adresse mail ".$mail." n'existe pas\n");
    else {
      $req="SELECT intitule, complement, prix, ref, photo FROM utilisateur NATURAL JOIN ligne_panier NATURAL JOIN produit WHERE mail='$mail'";
      $ligne=$this->db->query($req);
      if ($ligne==FALSE)
        throw new Exception("Erreur dans getProduitsUtilisateur()\n");
      else
        return($ligne->fetchAll(PDO::FETCH_CLASS, "Produit"));
    }
  }

  function deleteProduit($ref) {
    // Supprime de la table produit le produit dont la référence est passée en paramètre
    $req="DELETE FROM produit WHERE ref='$ref'";
    $resExec=$this->db->exec($req);
    if ($resExec==0)
      throw new Exception("ERREUR : Produit de référence ".$ref." inexistant\n");
    }

  function updateProduit($intitule, $complement='', $prix, $ref, $photo) {
    $prod=getProduitRef($ref);
    if ($prod == FALSE)
      throw new Exception("ERREUR : Produit de référence ".$ref." inexistant\n");
    else {
      $req="UPDATE produit SET ($intitule, '$complement', '$prix', '$ref', '$photo') WHERE ref='$ref'";
      $resExec=$this->db->exec($req);
      if ($resExec == 0)
        throw new Exception("ERREUR : Produit de référence ".$ref." inexistant\n");
    }
  }
  function getProduitRefTest($name){
    $req= "SELECT intitule,ref FROM produit WHERE ref LIKE '$name%'";
    $resExec=$this->db->query($req);
    return $resExec->fetchAll();
  }
  function getProduitNom($name){
    $req= "SELECT * FROM produit WHERE intitule='$name'";
    $resExec=$this->db->query($req);
    return $resExec->fetchAll();
  }



  // ----------------------
  // fonctions CRUD classe Categorie
  // ----------------------


  /*
    Ajouter les tests :
    -vérifier qu'on a bien les arguments passés en paramètre

    Attention aux valeurs de retour et aux comportements d'erreur
  */
  function getCategorie($nom) {
    $req="SELECT * FROM categorie WHERE nom='$nom'";
    $ligne=$this->db->query($req);
    if ($ligne == FALSE) {
      throw new Exception("Catégorie ".$nom." inexistante\n");
      return FALSE;
    }
    else
      return ($ligne->fetchAll(PDO::FETCH_CLASS, "Categorie"));
  }

  function createCategorie($nom) {
    $cat=$this->getCategorie($nom);
    if ($cat == FALSE)
    {
      $req="INSERT INTO categorie VALUES('$nom')";
      $this->db->exec($req);
    } else
      throw new Exception("ERREUR : la catégorie ".$nom." existe déjà\n");
  }

  function deleteCategorie($nom) {
    $cat=$this->getCategorie($nom);
    if ($cat == FALSE)
      throw new Exception("ERREUR : catégorie ".$nom." inexistante\n");
    else {
      $req="DELETE FROM categorie WHERE nom='$nom'";
      $resExec=$this->db->exec($req);
      if ($resExec == 0)
        echo("Aucun produit de la catégorie ".$nom."\n");
  		}
	}

  function updateCategorie($nom) {
    $cat=$this->getCategorie($nom);
    if ($cat == FALSE)
      throw new Exception("ERREUR : catégorie ".$nom." inexistante\n");
    else {
      $req="UPDATE categorie SET nom='$nom' WHERE nom='$nom'";
      $resExec=$this->db->exec($req);
      if ($resExec == 0)
        echo("Aucun produit de la catégorie ".$nom."\n");
    }
  }

  // ----------------------
  // fonctions CRUD classe LignePanier
  // ----------------------

  function getLignePanier($date, $mail, $ref) {
    // Renvoie une ligne de panier pour un utilisateur donnée, pour une date et un produit
    $req="SELECT * FROM ligne_PANIER WHERE date='$date' AND mail='$mail' AND ref='$ref'";
    $ligne=$this->db->query($req);
    if ($ligne == FALSE) {
      echo("Ligne de panier inexistante\n");
      return FALSE;
    } else
        return $ligne->fetchAll(PDO::FETCH_CLASS, "LignePanier");
  }

  function createLignePanier($lignePanier) {
    // Ajoute une ligne de panier à la base si elle n'existe pas
    $ligne=$this->getLignePanier($lignePanier->date, $lignePanier->mail, $lignePanier->ref);
    if ($ligne == FALSE) {
      $util=$this->getUtilisateur($lignePanier->mail);
      $prod=$this->getProduitRef($lignePanier->ref);
      if ($util == FALSE)
        throw new Exception("ERREUR : Utilisateur inexistant\n");
      elseif ($prod == FALSE)
        throw new Exception("ERREUR : Produit inexistant\n");
      else {
        $req="INSERT INTO ligne_panier VALUES ('$lignePanier->date', $lignePanier->mail, $lignePanier->ref, '$lignePanier->quantite', $lignePanier->valide)";
        $this->db->exec($req);
      }
    }
    else
      throw new Exception("ERREUR : La ligne de panier existe déjà\n");
  }

  function deleteLignePanier($date, $mail, $ref) {
    $req="DELETE FROM ligne_panier WHERE date='$date' AND mail='$mail' AND ref='$ref'";
    $resExec=$this->db->exec($req);
    if ($resExec == 0)
      echo("Aucune ligne de panier correspondant à la date correspondant à la date, mail et référence\n");
  }

  // ----------------------
  // fonctions CRUD classe AppartientA
  // ----------------------

  function createAppartientA($nom, $ref) {
    $cat=$this->getCategorie($nom);
    $prod=$this->getProduit($ref);
    if ($cat == FALSE) {
      throw new Exception("ERREUR : Catégorie inexistante\n");
    } elseif ($prod == FALSE)
        throw new Exception("ERREUR : Produit inexistant\n");
    else {
      $req="INSERT INTO appartient_a VALUES ($ref, '$nom')";
      $this->db->exec($req);
    }
  }


}
?>
