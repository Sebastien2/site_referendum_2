<?php



include(CHEMIN_MODELE.'referendumsFavoris.php');

if(isIdentified())
{
	//$erreur="Identifiaction requise";
	//header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
	echo "0";
}
elseif(empty($_POST['idRef']))
 {
 	//$erreur="Referendum inconnu";
 	//header('Location: index.php?erreur='.$erreur);
 	echo "0";
 }
 else
 {
 	//On enregistre le referendum dans la liste des favoris
 	$res=addFavoriReferendum($_SESSION['id'], htmlspecialchars($_POST['idRef']));
 	if($res)
 	{
 		echo "1";
 	}
 	else
 	{
 		echo "0";
 	}
 }











?>