<?php

//On récupère les données puis on met à jour

//echo "roussi";
include(CHEMIN_MODELE.'monCompte.php');

if(isIdentified())
{
	//echo "dobby";
	$erreur="Connexion requise";
	header('Location: index.php?erreur='.$erreur);
}

if(empty($_POST['ancienPassword']) or empty($_POST['nvPassword1']) or empty($_POST['nvPassword2']))
{
	//echo "wiccan";
	$resultat="Veuillez remplir tous les champs";
	header('Location: index.php?module=user&action=modifierPassword&resultat='.$resultat);
}

$idUser=$_SESSION['id'];
$ancienPassword=htmlspecialchars($_POST['ancienPassword']);
$nvPassword1=htmlspecialchars($_POST['nvPassword1']);
$nvPassword2=htmlspecialchars($_POST['nvPassword2']);

$res=mettreAJourUserPassword($idUser, $ancienPassword, $nvPassword1, $nvPassword2);


if($res)
{
	$resultat="Mise à jour de vos données effectuée";
	header('Location: index.php?module=user&action=monCompte&resultat='.$resultat);
}
else
{
	$erreur="Erreur lors de la mise à jour";
	header('Location: index.php?module=user&action=monCompte&erreur='.$erreur);
}





?>