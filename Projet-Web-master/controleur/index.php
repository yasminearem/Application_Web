<?php
/**
 * Created by IntelliJ IDEA.
 * User: julien
 * Date: 22/05/17
 * Time: 15:41
 */

/*
    Point d'entrée du contrôleur
    Vérifie la présence des paramètres GET et POST pour afficher la bonne page de la vue

    Auteurs : JV, RC
*/

// variable qui indique si l'utilisateur est connecté
$est_connecte = isset($_COOKIE['connecte']);

if(!empty($_GET['page'])) { // si le paramètre GET 'page' est non vide, on affiche la page demandée, sinon on renvoie à l'accueil

    switch ($_GET['page']) {
        // selon la valeur de la page demandée, on va inclure certaines pages

        case 'accueil':
            include '../vue/accueil.php';
            break;

        case 'compte':
            // on vérifie que l'utilisateur est connecté
            if (!$est_connecte){
                include '../vue/connect.php';
            }else{
                include '../vue/compte.php';
            }
            break;

        case 'descriptionProd':
            include '../vue/descriptionProduit.php';
            break;

        case 'ajoutProduit':
            include '../vue/ajoutProduit.php';
            break;

        case 'inscription':
            include '../vue/inscription.php';
            break;

        case 'panier':
            // on vérifie que l'utilisateur est connecté
            if(!$est_connecte) {
                include '../vue/connect.php';
            }
            else {
                include '../vue/commande.php';
            }
            break;

        case 'achat':
            // on vérifie que l'utilisateur est connecté
            if(!$est_connecte) {
                include '../vue/connect.php';
            }
            else {
                include '../vue/commande.php';
            }
            break;

        case 'admin':
            // on vérifie que l'utilisateur est connecté
            if(!$est_connecte) {
                include '../vue/connect.php';
            }
            else {
                include '../vue/admin.php';
            }
            break;

        case 'liste':
            if(empty($_GET['categorie'])) {
                include 'index.php?page=error';
            } else {
                $_GET['cate'] = $_GET['categorie'];
                include '../vue/listeProduit.php';
            }
            break;

        case 'deconnexion':
            // cohérence des deux lignes qui suivent?? RC
            setcookie('connecte','',time()-1);
            unset($_COOKIE["connecte"]);

            include '../vue/accueil.php';
            break;

        case 'administrationUtilisateur':
            include '../vue/administrationUtilisateur.php';
            break;

        case 'administrationProduit':
            include '../vue/administrationProduit.php';
            break;

        case 'ajoutProduit':
          include '../vue/ajoutProduit.php';
          break;

        case 'commande':
          include '../vue/paiement.php';
          break;

        case 'erreur':
            // renvoyer vers une page d'erreur
            include '../vue/erreur.php';
            break;

        default:
            include '../vue/accueil.php';
            break;
    }

}

else {
    // aucune page n'est demandée, on renvoie à l'accueil
    include '../vue/accueil.php';
}


?>
