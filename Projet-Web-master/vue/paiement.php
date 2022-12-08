<!-- ***************************Create By Hoareau Brenda Marinasy***************************-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <link rel="stylesheet" href="../vue/paiement.css">
</head>
<body>
  <img src="../data/carte.jpg" alt="image banque" />
<hr>
<form method="post" id="formulaire" action="../controleur/index.php"  onclick="transactionOk()">
    <fieldset>
      <div><span>Montant de la transaction </span></div>
        <label>N° carte bancaire : </label>
        <input type="text" name="nom" id="numero" required=""/>
        <br>
        <label>Date d'éxpiration : </label>
         <input type="number" name="mois" id="mois" min="1" max="12" required=""/> /
        <input type="number" name="annee" id="annee" min="2017" max=2030 required="">
        <br>
        <label>Code de vérification : </label>
        <input type="text" name="codeVerif" id="codeVerif" required=""/>
        <br>
        <input type="submit" name="valider" value="Valider">
        <input type="button" name="abandonner" value="Abandonner" onclick="boutonAn()">
    </fieldset>

</form>
<script src="../vue/transactionOk.js">

</script>
</body>
</html>
