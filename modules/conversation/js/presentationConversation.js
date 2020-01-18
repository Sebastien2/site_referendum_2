
function ajoutCommentaire()
{
	//alert('blo');
	//on récupère le conenue
	var contenu=document.getElementById('ajoutComm').value;
	document.getElementById('ajoutComm').value="";
	//on récupère l'id de la conversation
	var args=getParamsURL(document.URL);
	var idConv=Number(args['idConversation']);
	
	requeteAjax(contenu, idConv);

}



document.getElementById('Poster').addEventListener("click", ajoutCommentaire);



function getParamsURL(url)
{
	var queryString=url.split('?')[1];
	queryString=queryString.split('#')[0];
	var obj={};

	if(queryString)
	{
		var arr=queryString.split('&');
		for(var i=0; i<arr.length; i++)
		{
			var a=arr[i].split('=');
			var paramNum=undefined;
			var paramName=a[0];
			var paramValue=typeof(a[1])==="undefined" ? true : a[1];

			if(obj[paramName])
			{
				obj[paramName]=paramValue;
			}
			else
			{
				obj[paramName]=paramValue;
			}
		}
	}
	else
	{

	}
	return obj;
}




function requeteAjax(contenu, idConv)
{
	var args="contenu="+contenu+"&idConv="+idConv;
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {

        	document.getElementById("liste").innerHTML = this.responseText;
        	//alert(this.responseText);
        	
    	}
    	
    };
    xmlhttp.open("POST", "indexAjax?module=conversation&action=addMessage", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(args);
}





//Puis on maintient à jour les messages
setInterval(updateMessages, 1000);



function updateMessages()
{
	//alert("appel");
	//on vérifie le nombre de messages
	var nb=document.getElementById('liste').childNodes.length;

	var args=getParamsURL(document.URL);
	var idConv=Number(args['idConversation']);

	var nbActuel=prendreNbMessages(idConv);

	if(nbActuel!==nb)
	{
		mettreAJourMessages(idConv);
	}
}




function prendreNbMessages(idConv)
{
	var args="idConv="+idConv;
	var xmlhttp = new XMLHttpRequest();
	var resultat=0;
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {

        	resultat = Number(this.responseText);
        	//alert(this.responseText);
        	
    	}
    	
    };

    xmlhttp.open("POST", "indexAjax?module=conversation&action=countMessages", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(args);

    return resultat;
}




function mettreAJourMessages(idConv)
{
	var args="idConv="+idConv;
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {

        	document.getElementById("liste").innerHTML = this.responseText;
        	//alert(this.responseText);
        	
    	}
    	
    };
    xmlhttp.open("POST", "indexAjax?module=conversation&action=getMessages", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(args);
}