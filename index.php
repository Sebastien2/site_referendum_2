<?php


include 'global/init.php';

ob_start();

if(!empty($_GET['erreur']))
{
	
	echo "<div class='alert alert-danger'>".$_GET['erreur']."</div>";
}
if(!empty($_GET['resultat']))
{
	echo "<div class='alert alert-success'>".$_GET['resultat']."</div>";
}

/*
if(!empty($_GET['idGroupe']))
{
	echo $_GET['idGroupe'];
}
*/

if(!empty($_GET['module']))
{
	$module=dirname(__FILE__).'/modules/'.htmlspecialchars($_GET['module']).'/';


	$action=(!empty($_GET['action'])) ? htmlspecialchars($_GET['action']).'.php' : 'index.php';
	//echo "<div class='alert alert-danger'>".$module;
	//echo $action."</div>";
	//echo CHEMIN_CONTROLEUR.$action;

	if(is_file(CHEMIN_CONTROLEUR.$action))
	{
		
		include CHEMIN_CONTROLEUR.$action;
	}
	else
	{
		include 'global/accueil.php';
	}
}
else
{
	include 'global/accueil.php';
}


$contenu=ob_get_clean();



include('global/haut.php');

echo $contenu;


include('global/bas.php');

?>