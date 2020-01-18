<?php


include(CHEMIN_MODELE.'monCompte.php');

if(isIdentified())
{
	$erreur="Connexion requise";
	header('Location: index.php?erreur='.$erreur);
}

$idUser=$_SESSION['id'];

$user=prendreUser($idUser);





include(CHEMIN_VUE.'modifierDonnees.php');

?>