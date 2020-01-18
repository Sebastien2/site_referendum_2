<?php

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}
else
{
	$titre=htmlspecialchars($_POST['nom']);
	$descriptif=htmlspecialchars($_POST['descriptif']);
	$createur=$_SESSION['id'];
	

	include(CHEMIN_MODELE.'creationGroupe.php');

	$idGroupe=creerGroupe($titre, $descriptif, $createur);


	if($idGroupe>0)
	{
		//On doit récupérer ce groupe

		$resultat="Groupe créé";
		header('Location: index.php?module=groupe&action=presentation&idGroupe='. $idGroupe .'&resultat='.$resultat);
	}
	else
	{
		$erreur="Echec de création de groupe";//.$idGroupe;
		header('Location: index.php?erreur='.$erreur);
	}
}

?>