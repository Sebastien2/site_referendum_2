<?php

include(CHEMIN_MODELE.'groupe.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['idGroupe']) or empty($_GET['idGroupeParent']))
{
	
	$erreur="Proposition de lien inconnue";
	header('Location: index.php?erreur='.$erreur);
}



$idGroupe=htmlspecialchars($_GET['idGroupe']);
$idGroupeParent=htmlspecialchars($_GET['idGroupeParent']);

$statut=statutDansGroupe($idGroupe, $_SESSION['id']);

if($statut!=4)
{
	$erreur="Vous n'avez pas les droits suffisants pour effectuer cette opération";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$idGroupe.'&erreur='.$erreur);
}


//on enregistre l'offre dans les groupes, et on la marque comme validée
$res=retirerLienParent($idGroupe, $idGroupeParent); //on valide le lien



//on redirige
if($res)
{
	$resultat="Retrait effectué";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$idGroupe.'&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors du retrait de ce lien";
	header('Location: index.php?module=groupe&action=presentation&idGroupe='.$idGroupe.'&erreur='.$erreur);
}


?>