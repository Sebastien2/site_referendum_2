<?php



include(CHEMIN_MODELE.'search.php');


//On récupère le contenu
if(empty($_POST['search']))
{
	header('Location: index.php');
}


$search=htmlspecialchars($_POST['search']);


$resultsGroupe=resultatsGroupes($search);

$resultsRefs="";
if(empty($_SESSION['id']))
{
	$resultsRefs=resultatsRefsUnknown($search);
}
else
{
	$resultsRefs=resultatsRefsKnown($search, $_SESSION['id']);
}

//var_dump($resultsGroupe);
//var_dump($resultsRefs);


include(CHEMIN_VUE.'search.php');

//Et ensuite on affiche tout ça








?>