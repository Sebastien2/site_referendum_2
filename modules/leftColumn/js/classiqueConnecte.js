document.getElementById("choixDev").addEventListener("click", menuChangement);




function menuChangement()
{
	if(developpe)
	{
		menuReduction();
	}
	else
	{
		menuDeveloppement();
	}
	developpe=!developpe;
}


var developpe=false;


function menuDeveloppement()
{
	var xmlhttp = new XMLHttpRequest();
	
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		//alert(this.responseText);
        	document.getElementById("choixDev").innerHTML=this.responseText;
        	//alert(this.responseText);
        	
    	}
    	
    };
    xmlhttp.open("POST", "indexAjax?module=leftColumn&action=getCategories", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}


function menuReduction()
{
	
	document.getElementById("choixDev").innerHTML="<div class='list-group-item'>Générer les référendums<span class='caret'></span></div>";
}