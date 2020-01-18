<?php

include(CHEMIN_MODELE.'referendumSuccessif.php');


if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}




//Puis on prend un referendum sans vote, au hasard
$idCat=-1;
if(!empty($_GET['idCat']))
{
	$idCat=htmlspecialchars($_GET['idCat']);
}
$ref=array();
if($idCat<0)
{
	$ref=prendreReferendumSansVote($_SESSION['id']);
}
else
{
	$ref=prendreReferendumSansVoteParCategorie($_SESSION['id'], $idCat);
	
}


if(count($ref)==0)
{
	echo "<div class='jumbotron text-center'>Aucun nouveau referendum auquel participer</div>";
}
else
{


	include(CHEMIN_VUE.'referendumSuccessif.php');


}


?>