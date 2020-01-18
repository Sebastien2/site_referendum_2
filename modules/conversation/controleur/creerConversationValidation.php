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
$idUser=$_SESSION['id'];


if(empty($_POST['titre']))
{
	$erreur="Veuillez remplir le champ titre";
	header('Location: index.php?module=conversation&action=creerConversation&idGroupe='.$idGroupe."&erreur=".$erreur);
}
else
{
	$titre=htmlspecialchars($_POST['titre']);

	$res=creerConversation($idUser, $idGroupe, $titre);
	if($res)
	{
		$resultat="Conversation créée.";
		header('Location: index.php?module=groupe&action=presentation&idGroupe='.$idGroupe."&resultat=".$resultat);
	}
	else
	{
		$erreur="Une erreur est survenue";
	header('Location: index.php?module=conversation&action=creerConversation&idGroupe='.$idGroupe."&erreur=".$erreur);
	}
}



?>