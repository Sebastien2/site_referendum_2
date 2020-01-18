<?php

//on vérifie les droits
//renvoie la liste des membres du groupe

include(CHEMIN_MODELE.'creerRef.php');

if(isIdentified())
{
	$erreur="Identification requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['idGroupe']))
{
	$erreur="Groupe inconnu";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}



$idGroupe=htmlspecialchars($_GET['idGroupe']);
//echo $idGroupe;
$groupe=prendreGroupe($idGroupe);
if(count($groupe)==0)
{
	$erreur="Groupe inconnu";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

include(CHEMIN_VUE.'creerRefDepuisGroupe.php');

?>