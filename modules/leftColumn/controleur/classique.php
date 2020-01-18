<?php

//On regarde si la personne est connectée ou non



if(!(empty($_SESSION['id']) or empty($_SESSION['nom']) or empty($_SESSION['mail']) or empty($_SESSION['prenom'])))
{
	include('modules/leftColumn/controleur/classiqueConnecte.php');
}
else
{
	include('modules/leftColumn/controleur/classiqueDeconnecte.php');
}

?>