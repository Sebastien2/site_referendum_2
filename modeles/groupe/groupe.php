<?php

	
include("modeles/commonModel.php");






function nbAdministrateurs($idGroupe)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM membre WHERE groupe_id = :groupe_id");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		return $size;
	}
	catch(PDOException $e)
	{
		return 0;
	}
}



function demandeIntegration($idGroupe, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	
	try
	{
		$requete=$pdo->prepare("SELECT * FROM membre WHERE user_id=:user_id AND groupe_id=:groupe_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{
			$requete=$pdo->prepare("UPDATE membre SET statut=1 WHERE user_id = :user_id AND groupe_id = :groupe_id");
			$requete->bindParam(':user_id', $idUser);
			$requete->bindParam(':groupe_id', $idGroupe);
			return $requete->execute();

		}
		else
		{
			//On crée l'instance
			$statut=1;
			$dateAcquisition=(new DateTime())->format('Y-m-d H:i:s');
			$expired=0;
			$dateExpired=null;

			$requete=$pdo->prepare("INSERT INTO membre(user_id, groupe_id, statut, dateAcquisition, expired, dateExpiration) VALUES (:user_id, :groupe_id, :statut, :dateAcquisition, :expired, :dateExpired)");
			$requete->bindParam(':user_id', $idUser);
			$requete->bindParam(':groupe_id', $idGroupe);
			$requete->bindParam(':statut', $statut);
			$requete->bindParam(':dateAcquisition', $dateAcquisition);
			$requete->bindParam(':expired', $expired);
			$requete->bindParam(':dateExpired', $dateExpired);
			return $requete->execute();			
		}
	}
	catch(PDOException $e)
	{
		return False;
	}
}



function demandeStatutAdmin($idGroupe, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("UPDATE membre SET statut=3 WHERE user_id = :user_id AND groupe_id = :groupe_id AND statut=2");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
		}
	}
	catch(PDOException $e)
	{
		return False;
	}
}


function quitterGroupe($idGroupe, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("UPDATE membre SET statut=0 WHERE user_id = :user_id AND groupe_id = :groupe_id AND statut=2");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			return True;
		}
	}
	catch(PDOException $e)
	{
		return False;
	}
}


function quitterStatutAdmin($idGroupe, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("UPDATE membre SET statut=2 WHERE user_id = :user_id AND groupe_id = :groupe_id AND statut=4");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
		}
	}
	catch(PDOException $e)
	{
		return False;
	}
}



function estAdministrateurGroupe($idGroupe, $idUser)
{
	//vérifie si une personne est un administrateur ounon
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM membre WHERE groupe_id = :groupe_id AND user_id = :user_id");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$res=$res[0];
			return $res['statut']==4;
				
		}
		return False;
	}
	catch(PDOException $e)
	{
		return False;
	}
}





function prendreListeMembresGroupe($idGroupe, $idUser) //on fait une jointure
{
	$pdo=PDO2::getInstance();

	//On vérifie es drois d'accès

	if(estAdministrateurGroupe($idGroupe, $idUser))
	{
		//On peut renvoyer la liste des membres avec les statuts
		try
		{
			$requete=$pdo->prepare("SELECT * FROM membre LEFT JOIN user ON membre.user_id=user.id WHERE groupe_id = :groupe_id");
			$requete->bindParam(':groupe_id', $idGroupe);
			$requete->execute();

			$res=$requete->fetchAll();
			$size=count($res);
			if($size>0)
			{
				//var_dump($res);
				
				return $res;
			}
			return array();
		}
		catch(PDOException $e)
		{
			return array();
		}

	}

}



function prendreGroupe($idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe WHERE id = :groupe_id");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$res=$res[0];
			return $res;
				
		}
		return array();
	}
	catch(PDOException $e)
	{
		return array();
	}
}





function accepterCandidature($idUser, $idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("UPDATE groupe SET statut=2 WHERE groupe_id = :groupe_id AND user_id= :user_id AND statut=1");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
				
		}
		return False;
	}
	catch(PDOException $e)
	{
		return False;
	}
}




function refuserCandidature($idUser, $idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("UPDATE membre SET statut=0 WHERE groupe_id = :groupe_id AND user_id= :user_id AND statut=1");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
				
		}
		return False;
	}
	catch(PDOException $e)
	{
		return False;
	}
}









function accepterCandidatureAdmin($idUser, $idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("UPDATE groupe SET statut=4 WHERE groupe_id = :groupe_id AND user_id= :user_id AND statut=3");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
				
		}
		return False;
	}
	catch(PDOException $e)
	{
		return False;
	}
}




function refuserCandidatureAdmin($idUser, $idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("UPDATE groupe SET statut=2 WHERE groupe_id = :groupe_id AND user_id= :user_id AND statut=3");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return True;
				
		}
		return False;
	}
	catch(PDOException $e)
	{
		return False;
	}
}















/* ************************************** */
//Gestion des candidatures




//RF: check
function ajouterCandidatureNvParent($idGroupe, $candidatParent)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{

		$requete=$pdo->prepare("INSERT INTO liensGroupe(parent, fils, initiateur, etat) VALUES (:parent, :fils, :fils, 1)");
		$requete->bindParam(':parent', $candidatParent);
		$requete->bindParam(':fils', $idGroupe);
		return $requete->execute();

	}
	catch(PDOException $e)
	{
		return False;
	}
}


//RF: check
function ajouterCandidatureNvFils($idGroupe, $candidatfils)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("INSERT INTO liensGroupe(parent, fils, initiateur, etat) VALUES (:parent, :fils, :parent, 1)");
		$requete->bindParam(':parent', $idGroupe);
		$requete->bindParam(':fils', $candidatfils);
		return $requete->execute();

	}
	catch(PDOException $e)
	{
		return False;
	}
}


//RF: check
//Fournit la liste des candidatures reçues
function offresGroupesFils($idGroupe)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("SELECT * FROM groupe INNER JOIN liensGroupe ON liensGroupe.fils=groupe.id WHERE parent = :idGroupe AND initiateur<>:idGroupe AND etat=1");
		$requete->bindParam(':idGroupe', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}


//RF: check
//Fournit la liste des candidatures reçues
function offresGroupesParents($idGroupe)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("SELECT * FROM groupe INNER JOIN liensGroupe ON liensGroupe.parent=groupe.id WHERE fils = :idGroupe AND initiateur<>:idGroupe AND etat=1");
		$requete->bindParam(':idGroupe', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}




function offresGroupesFilsEmises($idGroupe)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("SELECT * FROM groupe INNER JOIN liensGroupe ON liensGroupe.fils=groupe.id WHERE parent = :idGroupe AND initiateur=:idGroupe AND etat=1");
		$requete->bindParam(':idGroupe', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}







function offresGroupesParentsEmises($idGroupe)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("SELECT * FROM groupe INNER JOIN liensGroupe ON liensGroupe.parent=groupe.id WHERE fils = :idGroupe AND initiateur=:idGroupe AND etat=1");
		$requete->bindParam(':idGroupe', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}




//RF: check
//Fournit une candidature, avant trouverOffreCandidatureNvFils
function trouverLien($offreId)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try
	{
		$repondu=0;
		$accepte=0;

		$requete=$pdo->prepare("SELECT * FROM liensGroupe WHERE id=:id");
		$requete->bindParam(':id', $offreId);
		$requete->execute();

		$res=$requete->fetchAll();
		if(count($res)>0)
		{
			return $res[0];
		}
		return array();
	}
	catch(PDOException $e)
	{
		return array();
	}
}




//RF: check
function effacerOffre($offreId)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensgroupe SET etat=0 WHERE id=:id");
		$requete->bindParam(':id', $offreId);
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}
}






//RF: check
function enregistrerLien($offreId)
{
	//On le met dans les tableaux des 2 groupes
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=2 WHERE id=:id");
		$requete->bindParam(':id', $offreId);
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}

}





//RF: check
function annulerLien($offreId)
{
	//On le met dans les tableaux des 2 groupes
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=-1 WHERE id=:id");
		$requete->bindParam(':id', $offreId);
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}

}







function prendreConversationsGroupe($idGroupe)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM conversation INNER JOIN liengroupeconversation ON conversation.id=liengroupeconversation.conversation_id WHERE liengroupeconversation.groupe_id=:idGroupe");
		$requete->bindParam(':idGroupe', $idGroupe);
		$requete->execute();

		return $requete->fetchAll();
	}
	catch(PDOException $e)
	{
		return array();
	}
}





function retirerCandidatureNvParent($idGroupe, $candidatParent)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=0 WHERE parent=:parent AND fils=:fils AND etat=1"); //L'offre est morte
		$requete->bindParam(':parent', $candidatParent);
		$requete->bindParam(':fils', $idGroupe);
		
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}
}



function retirerCandidatureNvFils($idGroupe, $candidatFils)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=0 WHERE parent=:parent AND fils=:fils AND etat=1"); //L'offre est morte
		$requete->bindParam(':parent', $idGroupe);
		$requete->bindParam(':fils', $candidatFils);
		
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}
}





function retirerLienFils($idGroupe, $candidatFils)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=0 WHERE parent=:parent AND fils=:fils AND etat=2"); //L'offre est morte
		$requete->bindParam(':parent', $idGroupe);
		$requete->bindParam(':fils', $candidatFils);
		
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}
}



function retirerLienParent($idGroupe, $candidatParent)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("UPDATE liensGroupe SET etat=0 WHERE parent=:parent AND fils=:fils AND etat=2"); //L'offre est morte
		$requete->bindParam(':parent', $candidatParent);
		$requete->bindParam(':fils', $idGroupe);
		
		return $requete->execute();
	}
	catch(PDOException $e)
	{
		return False;
	}
}







?>