<?php



if(!isIdentified())
{
	//erreur car incoherent
	$erreur="Problème de connexion";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

$categorie=null;
if(!empty($_POST['categorie']))
{
	$categorie=htmlspecialchars($_POST['categorie']);
}

$dateDebut=null;
if(!empty($_POST['dateDebut']))
{
	$dateDebut=htmlspecialchars($_POST['dateDebut']);
}

$dateFin=null;
if(!empty($_POST['dateFin']))
{
	$dateFin=htmlspecialchars($_POST['dateFin']);
}

$periodeVote=null;
if(!empty($_POST['periodeVote']))
{
	$periodeVote=htmlspecialchars($_POST['periodeVote']);
}


 include(CHEMIN_VUE.'listeRefsDeconnecte.php');






?>