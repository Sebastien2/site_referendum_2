//alert("Ostracisme");

function getRefs(cat, categorie, dateDebut, dateFin, droitDeVote, historique, periodeVote)
{
	var data="cat="+cat+"&categorie="+categorie+"&droitDeVote="+droitDeVote+"&historique="+historique+"&periodeVote="+periodeVote;
    if(!(dateDebut===null))
    {
        data+="&dateDebut="+dateDebut;
    }
    if(!(dateFin===null))
    {
        data+="&dateFin="+dateFin;
    }

    //on met toute les données dans cette variable
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    	//console.log(this.readyState+" "+this.status);

        if (this.readyState == 4 && this.status == 200) {
            
            document.getElementById("liste").innerHTML +=this.responseText;
            //console.log("resultat "+this.responseText);
    	}
        
    	
    };
    xmlhttp.open("POST", "indexAjax?module=listeRefs&action=getPartieRefs", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);

}


function getDonnees()
{
    //alert("juniper");
    //on prend l'état du formulaire
    [cat, categories, dateDebut, dateFin, droitDeVote, historique, periodeVote]=etatFormulaire();
    //console.log(cat, categories, dateDebut, dateFin, droitDeVote, historique, periodeVote);
        

    document.getElementById("liste").innerHTML ="";
    if(cat!="tous")
    {
        for(var i=0; i<categories.length; i++)
        {
            var categorie=categories[i];
            getRefs(cat, categorie, dateDebut, dateFin, droitDeVote, historique, periodeVote);
        }
    }
    else
    {
        getRefs(cat, "inutile", dateDebut, dateFin, droitDeVote, historique, periodeVote); //l'argument categries n'a pas d'intérêt
    }
    

}


function etatFormulaire()
{
    //récupère tous les champs du formulaire
    var cat="";
    var categorie=document.getElementsByName("categorie");
    for(var i=0; i<categorie.length;i++)
    {
        if(categorie[i].checked)
        {
            cat=categorie[i].value;
        }
    }


    //puis toutes les catégories
    var categories=[];
    var categorie=document.getElementsByName("choixCategorie");
    for(var i=0; i<categorie.length; i++)
    {
        if(categorie[i].checked)
        {
            categories.push(categorie[i].value);
        }
    }

    //puis les autres valeurs
    var dateDebut=document.getElementById('dateDebut').value;
    var dateFin=document.getElementById('dateFin').value;

    var droitDeVote="";
    var droits=document.getElementsByName("droitDeVote");
    for(var i=0; i<droits.length;i++)
    {
        if(droits[i].checked)
        {
            droitDeVote=droits[i].value;
        }
    }

    var historique="";
    var histo=document.getElementsByName('historique');
    for(var i=0; i<histo.length;i++)
    {
        if(histo[i].checked)
        {
            historique=histo[i].value;
        }
    }

    var periodeVote="";
    var perVote=document.getElementsByName('periodeVote');
    for(var i=0; i<perVote.length;i++)
    {
        if(perVote[i].checked)
        {
            periodeVote=perVote[i].value;
        }
    }



    return [cat, categories, dateDebut, dateFin, droitDeVote, historique, periodeVote];
}



getDonnees();
document.getElementById("formulaire").addEventListener("change", getDonnees);
//document.getElementById("formulaire").addEventListener("load", getDonnees);





//Puis l'apparition d'un champ avec toutes les catégories










var choixCat=document.getElementsByName("categorie");
for(var i=0; i<choixCat.length;i++)
{
    choixCat[i].addEventListener("click", miseAJourCategories);
}




function miseAJourCategories()
{
    var choixCat2=document.getElementsByName("categorie");
    if(choixCat2[1].checked)
    {
        //On met la liste des catégories
        //alert("bouh!");
        getCategories();
    }
    if((choixCat2[0].checked))
    {
        //alert("blah");
        document.getElementById('categories').innerHTML="";
    }
}


function getCategories()
{
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            document.getElementById('categories').innerHTML = this.responseText;
            //alert(this.responseText);
            
        }
        
    };
    xmlhttp.open("GET", "indexAjax?module=listes&action=getCategories", true);
    xmlhttp.send();
}