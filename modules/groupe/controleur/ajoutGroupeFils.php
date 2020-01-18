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
else
{
	$idGroupe=htmlspecialchars($_GET['idGroupe']);
	
	//Vérification du statut
	$statut=statutDansGroupe($idGroupe, $_SESSION['id']);
	if($statut<4)
	{
		$erreur="Vous n'avez pas les droits suffisants pour effectuer cette opération";
		header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
	}



	//Puis on récupère le candidat, et on l'insère dans la table
	$candidatFils=htmlspecialchars($_POST['groupeFils']);

	$groupesFilsPossibles=groupesFilsPossibles($idGroupe);
	if(in_array(recupererGroupe($candidatFils), $groupesFilsPossibles))
	{
		//On l'ajoute à la bdd
		$res=ajouterCandidatureNvFils($idGroupe, $candidatFils);

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
		$res=retirerCandidatureNvFils($idGroupe, $candidatFils);
		$erreur="La demande de filiation n'était plus valide: elle a été retirée.";
		header('Location: index.php?module=groupe&action=gestionGroupe&idGroupe='.$idGroupe.'&erreur='.$erreur);
	}
}




?>

