<?php


include("modeles/commonModel.php");



function referendumsFavoris($idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM favoriref INNER JOIN referendum ON favoriref.id_referendum=referendum.id WHERE id_user=:id_user and statut=1 ORDER BY dateCreation DESC");
		$requete->bindParam(':id_user', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}




function addFavoriReferendum($idUser, $idRef)
{
	if(!estReferendumFavori($idUser, $idRef))
	{
		$pdo=PDO2::getInstance();

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
		try
		{
			$requete=$pdo->prepare("INSERT INTO favoriref(id_user, id_referendum, statut) VALUES (:id_user, :id_referendum, 1)");
			$requete->bindParam(':id_user', $idUser);
			$requete->bindParam(':id_referendum', $idRef);
			return $requete->execute();

		}
		catch(PDOException $e)
		{
			return False;
		}
	}
	else
	{
		return True;
	}
	
}








function removeReferendumFavori($idUser, $idRef)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("UPDATE favoriref SET statut=0 WHERE id_user=:id_user and id_referendum=:id_referendum");
		$requete->bindParam(':id_user', $idUser);
		$requete->bindParam(':id_referendum', $idRef);
		return $requete->execute();

	}
	catch(PDOException $e)
	{
		return False;
	}
}




?>