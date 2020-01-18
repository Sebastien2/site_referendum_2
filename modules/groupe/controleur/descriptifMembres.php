<?php

//renvoie la liste des membres du groupe

include(CHEMIN_MODELE.'groupe.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['idGroupe']))
{
	$erreur="Groupe inconnu";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


//action
$idGroupe=htmlspecialchars($_GET['idGroupe']);
$membres=prendreListeMembresGroupe($idGroupe, $_SESSION['id']);


//redirection
include(CHEMIN_VUE.'descriptifMembres.php');

?>