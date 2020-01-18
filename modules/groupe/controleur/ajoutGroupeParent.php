<?php

//Droits
include(CHEMIN_MODELE.'groupe.php');

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

//Vérification du statut
$statut=statutDansGroupe($idGroupe, $_SESSION['id']);
if($statut<4)
{
	$erreur="Vous n'avez pas es droits suffisants pour effectuer cette opération";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}





//Puis on récupère le candidat, et on l'insère dans la table
$candidatParent=htmlspecialchars($_POST['groupeParents']);

//On vérifie que cette liaison est toujours possible
$groupesParentsPossibles=groupesParentsPossibles($idGroupe);
if(in_array(recupererGroupe($candidatParent), $groupesParentsPossibles))
{
	//On l'ajoute à la bdd
	$res=ajouterCandidatureNvParent($idGroupe, $candidatParent);

	//Redirection
	if($res)
	{
		$resultat="Demande envoyée";
		header('Location: index.php?module=groupe&action=gestionGroupe&idGroupe='.$idGroupe.'&resultat='.$resultat);
	}
	else
	{
		$erreur="Erreur dans la gestion de la demande";
		header('Location: index.php?module=groupe&action=gestionGroupe&idGroupe='.$idGroupe.'&erreur='.$erreur);
	}
}
else
{
	//La liaison n'est plus possible: il fat la retirer
	$res=retirerCandidatureNvParent($idGroupe, $candidatParent);
	$erreur="La demande de filiation n'était plus valide: elle a été retirée.";
	header('Location: index.php?module=groupe&action=gestionGroupe&idGroupe='.$idGroupe.'&erreur='.$erreur);
}




?>