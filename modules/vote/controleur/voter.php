<?php


include(CHEMIN_MODELE.'vote.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}



//On récupère le referendum
if(empty($_GET['idRef']))
{
	$erreur="Referendum inconnu pourquoi";
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
		$ref=prendreRef($idRef);


		//on vérifie les dates
		$enCours=False;
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($now>=$ref['dateDebut'] and $now<=$ref['dateFin'])
		{
			$enCours=True;
		}
		if($enCours)
		{
			//on regarde si la personne a déjà votée
			$voteActuel=voteExistant($idRef, $_SESSION['id']);


			//on peut afficher la vue
			include(CHEMIN_VUE.'voter.php');
		}
		else
		{
			$erreur="Hors période de vote";
			header('Location: index.php?module=ref&action=presentationRef&erreur='.$erreur.'&idRef='.$idRef);
		}


		
	}
}




?>