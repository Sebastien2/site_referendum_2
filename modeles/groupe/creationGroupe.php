<?php


include("modeles/commonModel.php");

function creerGroupe($titre, $descriptif, $createur)
{
	try
	{
		$pdo=PDO2::getInstance();

		$request=$pdo->prepare("INSERT INTO groupe(createur_id, nom, descriptif, dateCreation, groupes_fils, groupes_parents, expired, dateExpired) VALUES (:createur, :titre, :descriptif, :datenow, :fils, :parents, :expired, NULL)");

		$fils='';
		$parents='';
		$expired=0;
		$date=new DateTime();
		$date=$date->format('Y-m-d H:i:s');


		$request->bindParam(':createur', $createur);
		$request->bindParam(':titre', $titre);
		$request->bindParam(':descriptif', $descriptif);
		$request->bindParam(':fils', $fils);
		$request->bindParam(':parents', $parents);
		$request->bindParam(':expired', $expired);
		$request->bindParam('datenow', $date);
		//$request->bindValue(':dateExpired', null, PDO2::PARAM_INT);
		
		if($request->execute())
		{
			
			$groupe=$pdo->lastInsertId();
			//Puis on crée le membre avec statut d'administrateur
			$membre=creerMembreAdmin($groupe, $createur);
			if($membre<0)
			{
				return $membre; //nb. négatif
			}
			else
			{
				return $groupe;
			}
			
		}
		
		return -2;
		
				

	}catch(PDOException $e)
	{
		return -1;
	}

}





function creerMembreAdmin($idGroupe, $createur)
{
	try
	{
		$pdo=PDO2::getInstance();

		$request=$pdo->prepare("INSERT INTO membre(user_id, groupe_id, statut, dateAcquisition, expired, dateExpiration) VALUES (:user_id, :groupe_id, :statut, :datenow, :expired, NULL)");

		$statut=4;
		$expired=0;
		$date=new DateTime();
		$date=$date->format('Y-m-d H:i:s');


		$request->bindParam(':user_id', $createur);
		$request->bindParam(':groupe_id', $idGroupe);
		$request->bindParam(':statut', $statut);
		$request->bindParam(':expired', $expired);
		$request->bindParam('datenow', $date);
		//$request->bindValue(':dateExpired', null, PDO2::PARAM_INT);
		
		if($request->execute())
		{
			
			$membre=$pdo->lastInsertId();
			return $membre;
		}
		
		return -1;
		
				

	}catch(PDOException $e)
	{
		return -1;
	}
}


?>