<?php

$sousGroupes=groupesFilsComplet($groupe['id']);

//var_dump($sousGroupes);


if(count($sousGroupes)>0)
{
	include(CHEMIN_VUE.'listeGroupesEnfants.php');
}
else
{
	echo "<p>Aucun groupe enfant</p>";
}
?>