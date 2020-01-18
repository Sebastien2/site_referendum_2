<?php


include("modeles/commonModel.php");









function prendreResultatExistantReferendum($idRef)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM resultat WHERE referendum_id=:referendum_id");
		$requete->bindParam(':referendum_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{
			//On se contente de renvoyer cette instance
			return $res[0];
		}
		else
		{
			//Il faut calculer le resultat
			return array();
		}


	}
	catch(PDOException $e)
	{
		return array();
	}
}






function obtenirResultatReferendum($idRef)
{
	$possible=prendreResultatExistantReferendum($idRef);
	if(count($possible)==0)
	{
		$res=calculerResultatReferendum($idRef);
	}
	return prendreResultatExistantReferendum($idRef);
}




function calculerResultatReferendum($idRef)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$requete=$pdo->prepare("SELECT * FROM vote WHERE referendum_id=:referendum_id");
		$requete->bindParam(':referendum_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$nb=count($res);
		//return $size;
		$oui=0;
		foreach($res as $vote)
		{
			if($vote['valeur']==1)
			{
				$oui+=1;
			}
		}

		try
		{
			$now=(new DateTime())->format('Y-m-d H:i:s');
			$dateUpdate=null;

			$requete=$pdo->prepare("INSERT INTO resultat(referendum_id, nb_votes, nb_oui, dateCreation, dateUpdate) VALUES (:referendum_id, :nb_votes, :nb_oui, :dateCreation, :dateUpdate)");
			$requete->bindParam(':referendum_id', $idRef);
			$requete->bindParam(':nb_votes', $nb);
			$requete->bindParam(':nb_oui', $oui);
			$requete->bindParam(':dateCreation', $now);
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