<?php

//On récupère les données depuis la bdd
include(CHEMIN_MODELE.$action);
$refs=recuperer_tous_les_refs();

include(CHEMIN_VUE.$action);

foreach($refs as $ref)
{
	include(CHEMIN_VUE."presentationReferendum.php");
}



?>

