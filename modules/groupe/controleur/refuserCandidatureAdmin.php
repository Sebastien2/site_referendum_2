<?php

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

if(empty($_GET['idUser']))
{
	$erreur="Personne inconnue";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


$idUser=htmlspecialchars($_GET['idUser']);
$idGroupe=htmlspecialchars($_GET['idGroupe']);

$res=refuserCandidatureAdmin($idUser, $idGroupe);
if($res)
{
	$resultat="Candidature rejetée";
	header('Location: index.php?module=groupe&action=descriptifMembre&idGroupe='.$idGroupe.'&resultat='.$resultat);
}
else
{
	$erreur="Une erreur est survenue";
	header('Location: index.php?module=groupe&action=descriptifMembre&idGroupe='.$idGroupe.'&erreur='.$erreur);
}


?>