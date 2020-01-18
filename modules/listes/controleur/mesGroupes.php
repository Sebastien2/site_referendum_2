<?php

//On établit la lliste des groupes auxquels j'ai accès: groupes dont je suis membres, et tous les surGroupes

include(CHEMIN_MODELE.'mesGroupes.php');



if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}
$idUser=$_SESSION['id'];

$mesGroupes=listeMesGroupesIndirects($idUser);

//var_dump($mesGroupes);

include(CHEMIN_VUE.'mesGroupes.php');


?>