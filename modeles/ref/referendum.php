<?php

include("modeles/commonModel.php");




function creerReferendumDepuisGroupe($nom, $explication, $question, $dateDebut, $dateFin, $createur, $visible, $categorie, $idGroupe)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$dateCreation=(new DateTime())->format('Y-m-d H:i:s');
		$accesIndirect=1;
		$pourTous=0;


		$conversation_id=null;


		$requete=$pdo->prepare("INSERT INTO referendum(categorie_id, createur_id, groupe_id, conversation_id, titre, descriptif, question, pourTous, visible, dateCreation, dateDebut, dateFin, acces_indirect) VALUES (:categorie_id, :createur_id, :groupe_id, :conversation_id, :titre, :descriptif, :question, :pourTous, :visible, :dateCreation, :dateDebut, :dateFin, :acces_indirect)");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':createur_id', $createur);
		$requete->bindParam(':categorie_id', $categorie);
		$requete->bindParam(':conversation_id', $conversation_id);
		$requete->bindParam(':titre', $nom);
		$requete->bindParam(':descriptif', $explication);
		$requete->bindParam(':question', $question);
		$requete->bindParam(':pourTous', $pourTous);
		$requete->bindParam(':visible', $visible);
		$requete->bindParam(':dateCreation', $dateCreation);
		$requete->bindParam(':dateDebut', $dateDebut);
		$requete->bindParam(':dateFin', $dateFin);
		$requete->bindParam(':acces_indirect', $accesIndirect);

		return $requete->execute();

		
	}
	catch(PDOException $e)
	{
		return False;
	}
}






//Merdeux: il n'y a pas de statut pour un ref, juste un droit de vote ou pas de droit de vote
function statutPersonne($idRef, $idUser)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN groupe ON referendum.groupe_id = groupe.id WHERE id = :idRef");
		$requete->bindParam(':idRef', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$res=$res[0];
			$groupeId=$res['groupe_id'];
			if(empty($groupeId))
			{
				return 0;
			}
			else
			{
				//on trouve le statut de membre
				try
				{
					$requete=$pdo->prepare("SELECT * FROM membre WHERE groupe_id = :groupe_id AND user_id = :user_id");
					$requete->bindParam(':groupe_id', $groupeId);
					$requete->bindParam(':user_id', $idUser);
					
					$requete->execute();

					$membre=$requete->fetchAll();
					$size=count($rmembre);
					if($size>0)
					{
						//var_dump($res);
						$membre=$membre[0];
						return $membre['statut'];
							
					}
					else
					{
						return 0;
					}
						
				}
				catch(PDOException $e)
				{
					return 0;
				}

			}

				
		}
		return 0;
			
	}
	catch(PDOException $e)
	{
		return 0;
	}
}










?>