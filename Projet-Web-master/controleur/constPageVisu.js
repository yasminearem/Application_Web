/**
 * Created by julien on 23/05/17.
 */


//========================https://www.creativejuiz.fr/blog/javascript/recuperer-parametres-get-url-javascript==================//
function $_GET(param) {
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function( m, key, value ) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );

    if ( param ) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}
//=========================================================================================================================//




function init(){
    var categ = $_GET('categorie');
    var data = encodeURIComponent(categ);
    try{
        // Pourquoi faire ça?? RC
        ajax_get_request(placementDiv, '../controleur/recupVisuelProduit.php?categorie='+data, true);
    }catch(err){
        alert("erreur : "+err);
    }
}



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

function placementDiv(result){
    //console.log("retour result : " + result);

    var sect= document.getElementById('emplacementProd')
    var art = document.createElement("article");
    art.setAttribute("class", "artic");
    for($i=0;$i<result.length;$i++){
        var lien = document.createElement("a");
        lien.setAttribute("href","../controleur/index.php?page=descriptionProd&ref="+result[$i].ref);
        lien.setAttribute("class","Chat");
        var div = document.createElement("div");
        var figure = document.createElement("figure");
        var img = document.createElement("img");
        img.setAttribute("src", "../data/"+result[$i].photo);
        var figcapt = document.createElement("figcaption");
        var intit = document.createTextNode(result[$i].intitule);
        figcapt.appendChild(intit);
        var p = document.createElement("p");
        var descrip = document.createTextNode(result[$i].prix+'€');
        p.appendChild(descrip);
        figure.appendChild(img);
        div.appendChild(figure);
        div.appendChild(figcapt);
        div.appendChild(p);
        lien.appendChild(div);
        art.appendChild(lien);
    }
    var aside = document.getElementsByTagName('aside');
    sect.insertBefore(art,aside[0]);
}

function maj_produits(button) {
    // Que fait cette fonction?? RC
    var sect = document.getElementById('emplacementProd'); // section HTML qui contient tous les produits
    //var art = document.getElementsByTagName('article'); // articles HTML qui décrivent les produits
    sect.removeChild(sect.firstElementChild);
    var categ = button.innerText;
    var datas = encodeURIComponent(categ);
    try{
        ajax_get_request(placementDiv, '../controleur/recupVisuelProduit.php?categorie='+datas, true);
    }catch(err){
        alert("erreur : "+err);
    }

}
