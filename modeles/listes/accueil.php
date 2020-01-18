<?php

include('modeles/commonModel.php');


function getLastRefsUnknown($nb)
{
	//On récupère les nb derniers refs visibles
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE visible=1 ORDER BY dateCreation DESC");
		$requete->bindParam(':nb', $nb);
		$requete->execute();

		$res=$requete->fetchAll();
		$resultat=array();
		$qt=0;
		foreach($res as $ref)
		{
			if($qt<$nb)
			{
				if($ref['visible']==1 or droitDeVote($idUser, $ref['id']))
				{
					$resultat[]=$ref;
					$qt+=1;
				}
			}
		}
		return $resultat;
	}
	catch(PDOException $e)
	{
		return array();
	}
}




function getLastRefsKnown($nb, $idUser)
{
	//On récupère les nb derniers refs visibles
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE 1 ORDER BY dateCreation DESC");
		$requete->bindParam(':nb', $nb);
		$requete->execute();

		$res=$requete->fetchAll();
		$resultat=array();
		$qt=0;
		foreach($res as $ref)
		{
			if($qt<$nb)
			{
				if($ref['visible']==1 or droitDeVote($idUser, $ref['id']))
				{
					$resultat[]=$ref;
					$qt+=1;
				}
			}
		}
		return $resultat;
	}
	catch(PDOException $e)
	{
		return array();
	}
}









?>