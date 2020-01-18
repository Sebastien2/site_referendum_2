<!--INUTILE-->

<?php

//Identification requise
if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

//On récupère le groupe

include(CHEMIN_MODELE.'groupe.php');



if(empty($_GET['idGroupe']))
{
	$erreur="Groupe inconnu";
	header('Location: index.php?erreur='.$erreur);
}



$idGroupe=htmlspecialchars($_GET['idGroupe']);


$groupe=prendreGroupe($idGroupe);

if(count($groupe)==0)
{
	//var_dump($groupe);
	$erreur="Groupe inconnu, non récupéré du serveur";
	header('Location: index.php?erreur='.$erreur);
}

//On voit s'il est membre du groupe
$statut=statutDansGroupe($groupe['id'], $_SESSION['id']);

include(CHEMIN_VUE.'presentationGroupe.php');


?>