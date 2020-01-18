<?php

if(empty($_SESSION['id']))
{
	$erreur="Veuillez vous identifier";
	header('Location: index.php?erreur='.$erreur);
}
//On renvoie vers la vue
include(CHEMIN_VUE.'creerGroupe.php');




?>