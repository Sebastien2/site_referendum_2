<?php

include(CHEMIN_MODELE.'referendumSuccessif.php');


if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}



if(empty($_GET['idRef']))
{
	//echo 'rostrom';
	$erreur="Referendum inconnu";
	header('Location: index.php?erreur='.$erreur);
}

//echo "sarrabuse";


$idRef=htmlspecialchars($_GET['idRef']);
$idUser=htmlspecialchars($_SESSION['id']);

if(droitDeVote($idUser, $idRef))
{
	$res=enregistrerVote($idRef, $idUser, "oui");
}

if($res)
{
	$resultat="Vote enregistré";
	header('Location: index.php?module=listes&action=referendumSuccessif&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors de l'enregistrement";
	header('Location: index.php?module=listes&action=referendumSuccessif&erreur='.$erreur);
}



?>