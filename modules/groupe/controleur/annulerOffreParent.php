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
$groupeFilsId=$offre['fils'];
$groupeParentId=$offre['parent'];
$statut=statutDansGroupe($groupeParentId, $_SESSION['id']);

if($statut!=4)
{
	$erreur="Vous n'avez pas les droits suffisants pour effectuer cette opération";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeFilsId.'&erreur='.$erreur);
}


//on enregistre l'offre dans les groupes, et on la marque comme validée
$res=annulerLien($offreId); //on valide le lien



//on redirige
if($res)
{
	$resultat="Offre annulée";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeFilsId.'&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors de l'annulation de ce lien";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$groupeFilsId.'&erreur='.$erreur);
}


?>