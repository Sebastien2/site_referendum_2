<?php

//On met les derniers référendums créés, et les derniers groupes

include(CHEMIN_MODELE.'accueil.php');


if(isIdentified())
{
	$refs=getLastRefsUnknown(10);
}
else
{
	$refs=getLastRefsKnown(10, $_SESSION['id']);
}

//var_dump($refs);

include(CHEMIN_VUE.'accueil.php');





?>