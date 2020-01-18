<?php


include("modeles/commonModel.php");


//On y met la fonction permettant d'eregistrer un nouveau profil
function enregistrerProfil($nom, $prenom, $mail, $dateNaissance, $codePostal, $mdp)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM user WHERE mail = :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			return "Identifiant déjà existant";
		}
	}
	catch(PDOException $e)
	{
		return "erreur de la base";
	}


	try
	{
		$salt=(new Datetime())->format('Y-m-d H:i:s');
		$requete=$pdo->prepare("INSERT INTO user (name, prename, mail, dateNaissance, code_postal, password, salt, expired, groupes, dateCreation) VALUES (:name, :prename, :mail, :dateNaissance, :codePostal, :password, :salt, :expired, :groupes, NOW())");


		$expired=0;

		$requete->bindParam(":expired", $expired);
		$requete->bindParam(":name", $nom);
		$requete->bindParam("prename", $prenom);
		$requete->bindParam(":mail", $mail);
		$requete->bindParam(":dateNaissance", $dateNaissance);
		$requete->bindParam(":codePostal", $codePostal);
		$code=hash('sha256', $mdp.$salt);
		$requete->bindParam(":password", $code);
		$requete->bindParam(":salt", $salt);
		$groupes="";
		$requete->bindParam(":groupes", $groupes);
		
		$requete->execute();
		$idUser=$pdo->lastInsertId();
		
		$res=ajoutAuGroupeUniversel($idUser);
		//echo "blov";
		//var_dump (($pdo->errorInfo()));
		return "succes";
	}
	catch(PDOException $e)
	{
		//echo "Error:".$e->getMessage();
		return "erreur de la base";
	}
}



function ajoutAuGroupeUniversel($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$idGroupe=2;
		$statut=2;
		$dateAcquisition=(new DateTime())->format('Y-m-d H:i:s');
		$expired=0;
		$dateExpiration=null;
		$requete=$pdo->prepare("INSERT INTO membre(user_id, groupe_id, statut, dateAcquisition, expired, dateExpiration) VALUES(:user_id, :groupe_id, :statut, :dateAcquisition, :expired, :dateExpiration)");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->bindParam(':statut', $statut);
		$requete->bindParam(':dateAcquisition', $dateAcquisition);
		$requete->bindParam(':expired', $expired);
		$requete->bindParam(':dateExpiration', $dateExpiration);
		
		return $requete->execute();

		
	}
	catch(PDOException $e)
	{
		return False;
	}
}

?>