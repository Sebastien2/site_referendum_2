<?php

include(CHEMIN_MODELE.'conversation.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


if(empty($_GET['idGroupe']))
{
	$erreur="Groupe inconnu";
	header('Location: index.php?erreur='.$erreur);
}

$idGroupe=htmlspecialchars($_GET['idGroupe']);
$groupe=recupererGroupe($idGroupe);
$idUser=$_SESSION['id'];


$droit=droitAcces($idGroupe, $idUser);
if($droit)
{
	

	include(CHEMIN_VUE.'creerConversation.php');
}
else
{
	$erreur="Vous n'avez pas les droits suffisants.";
	header('Location: index.php?erreur='.$erreur);
}



?>