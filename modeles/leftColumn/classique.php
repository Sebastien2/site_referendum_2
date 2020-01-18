<?php

/*
function droitDeVote2($idUser, $idRef)
{
	$ref=prendreRef($idRef);
	$groupesVotant=listeGroupesVotant($idRef);

	$mesGroupes=groupesUser($idUser);

	//return $groupesVotant;
	//return $mesGroupes;

	$votant=False;
	foreach ($groupesVotant as $key => $value) {
		if(in_array($value, $mesGroupes))
		{
			$votant=True;
		}
	}

	return $votant;


}


function voteExistant2($idRef, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM vote WHERE user_id=:user_id AND referendum_id=:referendum_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':referendum_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{
			return $res[0]['valeur'];

		}
		return -1;


	}
	catch(PDOException $e)
	{
		return -1;
	}
}
*/

include_once('modeles/commonModel.php');





function listeMesGroupes($idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe INNER JOIN membre ON groupe.id=membre.groupe_id WHERE user_id = :user_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}


function getCategories()
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM categorie");
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}






function prendreNbRefsAVoterTous($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE 1");
		$requete->bindParam(":idCat", $idCat);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		$nb=0;
		if($size>0)
		{
			foreach($res as $ref)
			{
				if(droitDeVote($idUser, $ref['id']) and voteExistant($ref['id'], $idUser)==-1)
				{
					$nb+=1;
				}
			}
		}
		return $nb;
	}
	catch(PDOException $e)
	{
		return 0;
	}
}







function prendreNbRefsAVoterParCategorie($idUser, $idCat)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE categorie_id=:idCat");
		$requete->bindParam(":idCat", $idCat);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		$nb=0;
		if($size>0)
		{
			foreach($res as $ref)
			{
				if(droitDeVote($idUser, $ref['id']) and voteExistant($ref['id'], $idUser)==-1)
				{
					$nb+=1;
				}
			}
		}
		return $nb;
	}
	catch(PDOException $e)
	{
		return 0;
	}
}



?>