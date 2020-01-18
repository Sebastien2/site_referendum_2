<?php

include('modeles/commonModel.php');


function prendreReferendumSansVote($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE 1");
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{
			foreach($res as $ref)
			{
				if(droitDeVote($idUser, $ref['id']) and voteExistant($ref['id'], $idUser)==-1)
				{
					return $ref;
				}
			}

		}
		return array();


	}
	catch(PDOException $e)
	{
		return array();
	}
}





function prendreReferendumSansVoteParCategorie($idUser, $idCat)
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
		if($size>0)
		{
			foreach($res as $ref)
			{
				if(droitDeVote($idUser, $ref['id']) and voteExistant($ref['id'], $idUser)==-1)
				{
					return $ref;
				}
			}

		}
		return array();


	}
	catch(PDOException $e)
	{
		return array();
	}
}










?>