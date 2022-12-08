
/*

Script de récupération des produits d'un utilisateur pour son panier.

Auteur : RC

*/



function init() {

    var mail = getCookie("connecte");

    ajax_get_request(afficheProduitsPanier, "../controleur/recupCommande.php?mail="+mail, true); // appel asynchrone à la récupération de produits

}


function afficheProduitsPanier(json) {

    var somme = 0; // prix total des produits

    var table = document.getElementsByTagName('table')[0];
    for (var i = 0; i < json.length; i++) {
        var ligne = document.createElement("tr");

        var intitule = document.createElement("td");
        var intituleText = document.createTextNode(json[i].intitule);
        intitule.appendChild(intituleText);
        ligne.appendChild(intitule);

        var ref = document.createElement("td");
        var refText = document.createTextNode(json[i].ref);
        ref.appendChild(refText);
        ligne.appendChild(ref);

        var prix = document.createElement("td");
        var prixText = document.createTextNode(json[i].prix);
        prix.appendChild(prixText);
        ligne.appendChild(prix);

        var qte = document.createElement("td");
        var qteText = document.createTextNode(1); // à remplacer par la bonne quantité
        qte.appendChild(qteText);
        ligne.appendChild(qte);

        somme += json[i].prix * 1; // à remplacer

        table.appendChild(ligne);
    }

    // ajout de la valeur totale du panier en bas du tableau
    var total = document.getElementById("total");
    total.innerHTML = somme;
}





// Cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


// AJAX
function ajax_get_request(callback, url, async)
{
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if ((xhr.readyState==4) && (xhr.status==200))
            callback(JSON.parse(xhr.responseText));
    };
    xhr.open("GET",url,async);
    xhr.send();
}
