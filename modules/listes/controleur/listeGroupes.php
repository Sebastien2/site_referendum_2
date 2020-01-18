<?php

//renvoie la liste de tous les groupes

include(CHEMIN_MODELE.'listeGroupes.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

$groupes=listeTousGroupes();

include(CHEMIN_VUE.'listeGroupes.php');


?>