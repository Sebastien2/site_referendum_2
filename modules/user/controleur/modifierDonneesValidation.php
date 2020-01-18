<?php

//On récupère les données puis on met à jour
include(CHEMIN_MODELE.'monCompte.php');

if(isIdentified())
{
	$erreur="Connexion requise";
	header('Location: index.php?erreur='.$erreur);
}

if(empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['mail']) or empty($_POST['codePostal']) or empty($_POST['dateNaissance']))
{
	$resultat="Veuillez remplir tous les champs";
	header('Location: index.php?module=user&action=modifierDonnees&resultat='.$resultat);
}

$idUser=$_SESSION['id'];
$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom']);
$mail=htmlspecialchars($_POST['mail']);
$codePostal=htmlspecialchars($_POST['codePostal']);
$dateNaissance=htmlspecialchars($_POST['dateNaissance']);

$res=mettreAJourUser($idUser, $nom, $prenom, $mail, $codePostal, $dateNaissance);


if($res)
{
	$resultat="Mise à jour de vos données effectuée";
	header('Location: index.php?module=user&action=modifierDonnees&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors de la mise à jour";
	header('Location: index.php?module=user&action=modifierDonnees&erreur='.$erreur);
}


?>