<?php

include('modeles/commonModel.php');



function obtenirResultatReferendum($idRef)
{
	//On doit obtenir le résultat
	$resultat=recupererResultatReferendum($idRef);
	if(count($resultat)==0)
	{
		$res=creerResultatReferendum($idRef);
	}
	$resultat=recupererResultatReferendum($idRef);
	if(count($resultat)>0)
	{
		return $resultat[0];
	}
	else
	{
		return array();
	}
	
}


function recupererResultatReferendum($idRef)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$requete=$pdo->prepare("SELECT * FROM resultat WHERE referendum_id=:ref_id");
		$requete->bindParam(':ref_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		if(count($res)==0)
		{
			return array();
		}
		else
		{
			return $res;
		}
	}
	catch(PDOException $e)
	{
		return array();
	}
}


function creerResultatReferendum($idRef)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On récupère tous les votes
	try
	{
		$requete=$pdo->prepare("SELECT * FROM vote WHERE referendum_id=:idRef");
		$requete->bindParam(':idRef', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();

		$oui=0;
		$non=0;
		$blanc=0;

		foreach($res as $vote)
		{
			if($vote['valeur']==0)
			{
				$non+=1;
			}
			elseif($vote['valeur']==1)
			{
				$oui+=1;
			}
			elseif($vote['valeur']==2)
			{
				$blanc+=1;
			}
		}
		//return array($oui, $non, $blanc);

		//Puis on l'insère dans la table des résultats
		try
		{
			$nbVotes=$oui+$non+$blanc;
			$dateUpdate=null;
			$dateCreation=(new DateTime())->format('Y-m-d H:i:s');

			$requete=$pdo->prepare("INSERT INTO resultat(referendum_id, nb_votes, nb_oui, nb_non, dateCreation, dateUpdate) VALUES(:referendum_id, :nb_votes, :nb_oui, :nb_non, :dateCreation, :dateUpdate)");
			$requete->bindParam(':referendum_id', $idRef);
			$requete->bindParam(':nb_votes', $nbVotes);
			$requete->bindParam(':nb_oui', $oui);
			$requete->bindParam(':nb_non', $non);
			$requete->bindParam(':dateCreation', $dateCreation);
			$requete->bindParam(':dateUpdate', $dateUpdate);
			return $requete->execute();
		}
		catch(PDOException $e)
		{
			return False;
		}




	}
	catch(PDOException $e)
	{
		return False;
	}


}








?>