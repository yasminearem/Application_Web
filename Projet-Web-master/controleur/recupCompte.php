<?php
/*

Script de récupération d'un objet JSON représentant un utilisateur (pour afficher ses informations sur sa page perso)

Auteur : RC.

*/


// inclusion des fhciers du modèle
include "../modele/classes.php"; // n'est pas forcément utile ici
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
    $res = $dao->getUtilisateur($mail);
} catch (Exception $e) {
    echo "ERREUR : ".$e->getMessage();
}

// extraction de l'utilisateur depuis le tableau qui le contient
$util = $res[0];

// retour de l'objet au format objet json
echo json_encode($util);


?>
