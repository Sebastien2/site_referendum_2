<?php

include(CHEMIN_MODELE.'referendumsFavoris.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


$idUser=$_SESSION['id'];

$refsFavoris=referendumsFavoris($idUser);

//var_dump($refsFavoris);
//Puis on les affiche



include(CHEMIN_VUE.'referendumsFavoris.php');




?>