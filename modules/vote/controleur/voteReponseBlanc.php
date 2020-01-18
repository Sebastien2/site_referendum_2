<?php

//on vérifie la connexion
include(CHEMIN_MODELE.'vote.php');

if(isIdentified())
{
	$erreur="Identification requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


//on vérifie les variables
if(empty($_GET['idRef']))
{
	$erreur="Referendum inconnu";
	header('Location: index.php?erreur='.$erreur);
}
else
{
	$idRef=htmlspecialchars($_GET['idRef']);
	//on vérifie les droits
	$droit=droitDeVote( $_SESSION['id'], $idRef);
	if(!$droit)
	{
		//on le renvoie
		$erreur="Vous n'êtes pas autorisé à voter sur ce referendum";
		header('Location: index.php?erreur='.$erreur);
	}
	else
	{
		//on ajoute le vote, en considérant la possibliité que il y en ait déjà un
		$res=enregistrerVote($idRef, $_SESSION['id'], "blanc");
		if($res)
		{
			$resultat="Vote enregistré";
			header('Location: index.php?module=ref&action=presentationRef&idRef='.$idRef.'&resultat='.$resultat);
		}
		else
		{
			$erreur="Erreur lors de l'enregistrement du vote";
			header('Location: index.php?module=ref&action=presentationRef&idRef='.$idRef.'&erreur='.$erreur);
		}
	}
}




?>