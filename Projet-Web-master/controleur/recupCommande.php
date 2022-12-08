<?php

/*

Script de récupération des produits d'un utilisateur

Auteur : RC

*/

include "../modele/DAO.php";

// récupération du paramètre mail passé par GET
if (isset($_GET["mail"])) {
    $mail = $_GET["mail"];
}

// ouverture de la base
try {
    $dao = new DAO();
} catch (Exception $e) {
    echo "ERREUR : ".$e->getMessage();
}

// récupération de l'utilisateur
try {
    $res = $dao->getProduitsUtilisateur($mail);
} catch (Exception $e) {
    echo "ERREUR : ".$e->getMessage();
}

// retour de l'objet au format objet json
echo json_encode($res);


?>
