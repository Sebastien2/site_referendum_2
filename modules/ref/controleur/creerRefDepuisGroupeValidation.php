<?php

//on récupère les données du formulaire, puis on crée le referendum

include(CHEMIN_MODELE.'referendum.php');

if(isIdentified())
{
	//echo 'pb1';
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['idGroupe']))
{
	//echo 'pb2';
	$erreur="Groupe inconnu bis";
	header('Location: index.php?erreur='.$erreur);
}

//on vérifie la validité de tous les champs
if(empty($_POST['nom']) or empty($_POST['explication']) or empty($_POST['question']) or empty($_POST['dateDebut']) or empty($_POST['dateFin']) or empty($_POST['categorie']) or empty($_POST['visible']))
{
	//echo 'pb3';
	$erreur="Certains champs n'ont pas été remplis";
	header('Location: index.php?module=ref&action=creerRefDepuisGroupe&idGroupe='.$idGroupe.'&erreur='.$erreur);

}

$idGroupe=$_GET['idGroupe'];

$nom=htmlspecialchars($_POST['nom']);
$explication=htmlspecialchars($_POST['explication']);
$question=htmlspecialchars($_POST['question']);
$dateDebut=htmlspecialchars($_POST['dateDebut']);
$dateFin=htmlspecialchars($_POST['dateFin']);
$createur=htmlspecialchars($_SESSION['id']);
$visible=htmlspecialchars($_POST['visible']);
$categorie=htmlspecialchars($_POST['categorie']);

//Puis on l'ajoute à la bdd

$res=creerReferendumDepuisGroupe($nom, $explication, $question, $dateDebut, $dateFin, $createur, $visible, $categorie, $idGroupe);


if($res)
{
	//echo 'succes 1';
	$resultat="Referendum créé";
	header('Location: index.php?odule=listes&action=accueil&resultat='.$resultat);
}
else
{
	
	//echo 'pb4';
	$erreur="Echec de création du référendum";
	header('Location: index.php?module=ref&action=creerRefDepuisGroupe&idGroupe='.$idGroupe.'&erreur='.$erreur);
}


?>