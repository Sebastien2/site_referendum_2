

function request(callback)
{
	var mail=mailElem.value;
	//nvElem.innerHTML+="Fonction appelée";
	
	
	var xhr=getXMLHttpRequest();

	xhr.onreadystatechange=function(){
		if(xhr.readyState==4 && (xhr.status==200 || xhr.status==0))
		{
			callback(xhr.responseText);
			//nvElem.innerHTML+="reponse recue"+xhr.responseText;
		}
	}
	//alert(mail);

	xhr.open("GET", "modules/user/controleur/numberOfPseudos.php?mail="+mail, true);
	xhr.send(null);

}


function appliquerNbMails(nb)
{
	var mail=mailElem.value;
	//nvElem.innerHTML+=mail;

	if(nb>0)
	{
		mailCommentElem.textContent="Ce mail existe déjà, il ne peut pas être utilisé";
		validElem.hidden=true;
	}
	else
	{
		mailCommentElem.textContent="";
		validElem.hidden=false;
	}

	if(mailCommentElem.textContent=="")
	{
		mailCommentElem.hidden=true;
	}
	else
	{
		mailCommentElem.hidden=false;
	}
}





function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}