<?php

//retire dans la bdd le statut s'admin de l'user
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

$res=quitterStatutAdmin($idGroupe, $_SESSION['id']);



//redirection
if($res)
{
	$resultat="Statut d'aadministrateur retiré";
	header('Location: index.php?module=groupe&action=presentation&resultat='.$resultat);
}
else
{
	$erreur="Erreur durant l'enregistrement de votre demande";
	header('Location: index.php?module=groupe&action=presentation&resultat='.$erreur);
}



?>