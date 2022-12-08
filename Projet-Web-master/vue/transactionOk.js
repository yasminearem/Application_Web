//  ***************************Create By Hoareau Brenda Marinasy***************************
//Simule la transaction avec des alert
var an = false;
function transactionOk (){
  var numCarte = document.getElementById('numero').value;
  var bouton = document.getElementById("ab");
  //trace(bouton.hasBeenClicked);
  if(numCarte!="" && an==false){
    alert('La transaction validée');
    document.location.href="../controleur/index.php";
  }
  else if(an==true){
    alert('La transaction annulée');
    document.location.href="../controleur/index.php";
  }
}

function boutonAn(){
  an=true;
}
