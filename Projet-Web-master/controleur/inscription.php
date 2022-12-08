<?php
/**
 * Created by IntelliJ IDEA.
 * User: julien
 * Date: 22/05/17
 * Time: 18:54
 */

 /*
    Script d'inscription d'un utilisateur au site

    Auteurs : JV, RC
 */

 // si l'utilisateur a entré toutes les valeurs attendues
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['psw']) && !empty($_POST['pswVerif'])) {

        // récupération des variables passées en paramètre POST
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $psw = $_POST['psw'];
        $pswVerif = $_POST['pswVerif'];

        // si les mots de passe donnés ne sont pas identiques, il y a eu une erreur de saisie par l'utilisateur
        if(strcmp($psw,$pswVerif)!=0){
            echo"<script language=\"javascript\">";
            echo"alert('Les mots de passes ne sont pas identiques');";
            echo"</script>";
            $_GET['page'] = 'inscription';
            include '../controleur/index.php';
            exit;
        }

        // ouverture de la DAO et inscription de l'utilisateur à la base
        include '../modele/DAO.php';
        $dao=new DAO();
        $util=new Utilisateur($nom, $prenom, $mail, $psw);
        try{
            $dao->createUtilisateur($util);
        }catch(Exception $e){
            echo "ERREUR inscription.php : ".$e->getMessage();
            echo "<br><a href=\"../controleur/index.php?page=accueil\">Accueil</a>";
            exit;
        }

        // si on arrive ici, c'est que l'inscription s'est bien passée
        echo"<script language=\"javascript\">";
        echo"alert('Inscription complete ! Vous pouvez vous connecter ! ')";
        echo"</script>";

        // -----------------------
        // INFORMATIONS DE DEBUG
        // $data[] = $dao->getAllUtilisateurs();
        // var_dump(sizeof($data));
        // for($i=0;$i<sizeof($data);$i++){
        //     var_dump($data[$i]);
        // }
        // -----------------------

        // l'utilisateur retourne à l'accueil, connecté
        setcookie("connecte", $mail);
        setcookie("nom", $nom);
        setcookie("prenom", $prenom);
        $_GET['page']='compte';
        include '../controleur/index.php';

    }else{
        // si l'utilisateur n'a pas rempli tous les champs
        echo"<script language=\"javascript\">";
        echo"alert('Veuillez remplir tous les champs')";
        echo"</script>";
        $_GET['page'] = 'inscription';
        include '../controleur/index.php';
    }
?>
