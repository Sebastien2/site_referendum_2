<?php


//On prend toutes les catégories, et on renoie le code HTML correspondant

include(CHEMIN_MODELE.'categories.php');
$categories=getCategories();

$reponse="";

if(count($categories)>0)
{
	foreach($categories as $categorie)
	{
		$reponse.="<input type='checkbox' name='choixCategorie' value='".$categorie['id']."'>".$categorie['nom']."<br>";
	}
}
else
{

}

echo $reponse;
//echo count($categories);

?>