<?php
define('SQL_DSN', 'mysql:dbname=db735871295;host=db735871295.db.1and1.com');  //TODO: modify
define('SQL_USERNAME', 'dbo735871295');
define('SQL_PASSWORD', 'Boule2Suif!');

$module=(empty($module)) ? !empty($_GET['module']) ? $_GET['module'] : 'index' :$module;

define('CHEMIN_VUE', 'modules/'.$module.'/vues/');
define('CHEMIN_MODELE', 'modeles/'.$module.'/');
define('CHEMIN_CONTROLEUR', 'modules/'.$module.'/controleur/');
define('CHEMIN_JS', 'modules/'.$module.'/js/');
define('CHEMIN_LIB', 'libs/');

define('CHEMIN_DEBUT', '');

?>