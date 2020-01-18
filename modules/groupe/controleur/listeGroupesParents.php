<?php

$surGroupes=groupesParentsComplet($groupe['id']);

//var_dump($surGroupes);
//var_dump($groupe);

if(count($surGroupes)>0)
{
	include(CHEMIN_VUE.'listeGroupesParents.php');
}
else
{
	echo "<p>Aucun groupe parent</p>";
}


?>