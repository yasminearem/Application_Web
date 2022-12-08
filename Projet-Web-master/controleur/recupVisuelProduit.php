<?php
/**
 * Created by IntelliJ IDEA.
 * User: julien
 * Date: 22/05/17
 * Time: 09:36
 * Description : Générer les images de produits qui seront affichées sur les pages web.
 *
 *version1 : Recupere les images dans le dossier ( a renseigner au moment de l'appel). Utiliser scanImage.
 */

include '../modele/DAO.php';
$dao = new DAO();

/**
 * @param $groupDir : dossier où se trouve les autres dossiers (categories?) contenant les images.
 * @return mixed
 *
 */

/**
 * @param $dataDir : Dossier contenant toutes les photos.
 * @return array : Tableau contenant tout les chemins relatifs vers les images.
 */
    function scanImage($dataDir){
        if(is_dir($dataDir)){
            if($dh = opendir($dataDir)){
                while(($dir = readdir($dh))!== false){
                    if($dir[0]!='.')
                        $data[] = $dir.'/'.(recupererImages($dataDir.'/'.$dir));
                }
            }
        }
        return $data;
    }


    function recupererProduits($categorie){
        //Permet de recuperer un tableau contenant les produits d'une catégorie donnée

        global $dao;
        if($categorie == 'tous'){
            $produits = $dao->getProduits();
        }else{
            $produits = $dao->getProduitsCategorie($categorie);
        }
        return $produits;
    }

    if(!empty($_GET['categorie']))
    {
        echo json_encode(recupererProduits($_GET['categorie']));
    }
    function recupererProduitsRech($nom){
      global $dao;

    }
?>
