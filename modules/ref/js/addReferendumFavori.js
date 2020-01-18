if(document.getElementById('addFavoriRef'))
{
	document.getElementById('addFavoriRef').addEventListener("click", ajouterAuxFavoris);
}



function ajouterAuxFavoris()
{
	//On prend le ref
	var idRef=Number(document.getElementById("idRef").textContent);

	//Puis on l'envoie au serveur
	envoyerAuServeur(idRef);



}



function envoyerAuServeur(idRef)
{
	var xmlhttp = new XMLHttpRequest();
	var contenu="idRef="+idRef;
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		alert(this.responseText);
        	if(this.responseText==="0")
        	{
        		alert("Echec de l'ajout de ce referendum à votre espace personnel");
        	}
        	else
        	{
        		alert("Referendum ajouté à vos suivis");
        		document.getElementById('favoriRef').innerHTML="";
        	}
        	//alert(this.responseText);
        	
    	}
    	
    };
    xmlhttp.open("POST", "indexAjax?module=listes&action=addFavoriRef", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(contenu);
}