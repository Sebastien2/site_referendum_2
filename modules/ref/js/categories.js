//alert("Ostracisme");

function getCategories()
{
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {

        	document.getElementById("categorie").innerHTML = this.responseText;
        	//alert(this.responseText);
        	
    	}
    	
    };
    xmlhttp.open("GET", "indexAjax?module=ref&action=getCategories", true);
    xmlhttp.send();
}


document.getElementById("categorie").onload=getCategories();