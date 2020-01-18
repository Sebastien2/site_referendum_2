<?php
//Fournit des listes de referendums. Par défaut, ce sont tous les référendus en ordre chronologique. On met un formulaire pour choisir les referendums voulus


include(CHEMIN_MODELE.'listeGroupes.php');

if(isIdentified())
{
	include(CHEMIN_CONTROLEUR.'listeRefsDeconnecte.php');
}
else
{
	include(CHEMIN_CONTROLEUR.'listeRefsConnecte.php');
}




?>