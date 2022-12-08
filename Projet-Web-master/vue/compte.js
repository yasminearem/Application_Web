
/*

Script de récupération des informations utilisateur pour affichage des informations sur sa page perso.

Auteur: RC

*/


function init() {
    // appelle une page du controleur pour récupérer les informations
    // les affiche sur la page

    var mail = getCookie("connecte"); // adresse mail de l'utilisateur qu'on veut afficher

    ajax_get_request(afficheInfosUtilisateur, "../controleur/recupCompte.php?mail="+mail, true); // appel asynchrone à la récupération de l'utilisateur
}

function afficheInfosUtilisateur(json) {
    var infos = document.getElementById('info'); // récupération de la division concernée par les changements
    var h2 = infos.getElementsByTagName("h2")[0]; // identification de l'utilisateur
    h2.innerHTML = json.prenom + " " + json.nom;
    var p = infos.getElementsByTagName("p")[0]; // mail de l'utilisateur
    p.innerHTML = json.mail;
    p.nextElementSibling.remove(); // suppression d'un paramètre pas encore utilisé
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
