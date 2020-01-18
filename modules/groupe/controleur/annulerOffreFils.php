<?php

include(CHEMIN_MODELE.'groupe.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['offre']))
{
	
	$erreur="Proposition de lien inconnue";
	header('Location: index.php?erreur='.$erreur);
}


$offreId=htmlspecialchars($_GET['offre']);

//on vérifie les droits
$offre=trouverLien($offreId);
$groupeParentId=$offre['parent'];
$groupeFilsId=$offre['fils'];
$statut=statutDansGroupe($groupeFilsId, $_SESSION['id']);

if($statut!=4)
{
	$erreur="Vous n'avez pas les droits suffisants pour effectuer cette opération";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeParentId.'&erreur='.$erreur);
}


//on enregistre l'offre dans les groupes, et on la marque comme validée

$res=annnulerLien($offreId); //on valide le llien



//on redirige
if($res)
{
	$resultat="Offre annulée";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeParentId.'&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors de l'annulation de ce lien";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeParentId.'&erreur='.$erreur);
}


?>