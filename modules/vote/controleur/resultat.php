<?php

//On regarde la définition des variables

include(CHEMIN_MODELE.'resultat.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


if(empty($_GET['idRef']))
{
	$erreur="Referendum inconnu";
	header('Location: index.php?erreur='.$erreur);
}

//On récupère le refereendum
$idRef=htmlspecialchars($_GET['idRef']);
$ref=prendreRef($idRef);
//On prend le statut de la personne
$statut=False; //par défaut, pas de droit de vote
if(!empty($_SESSION['id']))
{
	$statut=droitDeVote( $_SESSION['id'], $idRef);

}

$enCours=False;
$now=(new DateTime())->format('Y-m-d H:i:s');
if($now>=$ref['dateDebut'] and $now<=$ref['dateFin'])
{
	$enCours=True;
}

if(!$statut and $ref['visible']==0)
{
	$erreur="Vous n'avez pas les droits d'accès à ce résultat.";
	header('Location: index.php?module=ref&action=presentationRef&idRef='.$idRef.'erreur='.$erreur);
}
elseif(!($now>$ref['dateFin']))
{
	$erreur="Les résultats ne sont pas encore disponibles.";
	header('Location: index.php?module=ref&action=presentationRef&idRef='.$idRef.'erreur='.$erreur);
}
else
{
	//On peut les afficher
	$resultat=obtenirResultatReferendum($idRef);
	
	//$resultat=creerResultatReferendum($idRef);
	//var_dump($resultat);
	
	if(count($resultat)==0)
	{
		$erreur="Une erreur est survenue lors de l'obtention des résultats.";
		header('Location: index.php?module=ref&action=presentationRef&idRef='.$idRef.'erreur='.$erreur);
	}
	else
	{
		include(CHEMIN_VUE.'resultat.php');
	}
	
	
}



?>