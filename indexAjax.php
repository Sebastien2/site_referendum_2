<?php


include 'global/init.php';

ob_start();

if(!empty($_GET['erreur']))
{
	echo $_GET['erreur'];
}
if(!empty($_GET['resultat']))
{
	echo $_GET['resultat'];
}

if(!empty($_GET['idGroupe']))
{
	echo $_GET['idGroupe'];
}


if(!empty($_GET['module']))
{
	$module=dirname(__FILE__).'/modules/'.htmlspecialchars($_GET['module']).'/';


	$action=(!empty($_GET['action'])) ? htmlspecialchars($_GET['action']).'.php' : 'index.php';
	//echo $module;
	//echo $action;
	//echo CHEMIN_CONTROLEUR.$action;

	if(is_file(CHEMIN_CONTROLEUR.$action))
	{
		
		include CHEMIN_CONTROLEUR.$action;
	}
	else
	{
		include 'global/erreurAjax.php';
	}
}
else
{
	include 'global/erreurAjax.php';
}


$contenu=ob_get_clean();



echo $contenu;



?>