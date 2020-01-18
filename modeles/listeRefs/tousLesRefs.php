<?php


include("modeles/commonModel.php");


function recuperer_tous_les_refs()
{
	$pdo=PDO2::getInstance();

	$requete=$pdo->prepare("SELECT * FROM referendum ORDER BY dateCreation ASC");
	$requete->execute();

	//$requete->bindValue(":nom_utilisateur", "Baranne");



	return $requete->fetchAll();

}


?>