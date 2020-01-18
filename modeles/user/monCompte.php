<?php

include('modeles/commonModel.php');

function mettreAJourUserPassword($idUser, $ancienPassword, $nvPassword1, $nvPassword2)
{
	if($nvPassword1!=$nvPassword2)
	{
		return False;
	}
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$user=prendreUser($idUser);
	if($user['password']!=hash('sha256', $ancienPassword.$user['salt']))
	{
		return False;
	}

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$nv=hash('sha256', $nvPassword1.$user['salt']);
		$requete=$pdo->prepare("UPDATE user SET password=:password WHERE id = :id");
		$requete->bindParam(':id', $idUser);
		$requete->bindParam(':password', $nv);
		return $requete->execute();

		
	}
	catch(PDOException $e)
	{
		return False;
	}

}


function mettreAJourUser($idUser, $nom, $prenom, $mail, $codePostal, $dateNaissance)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("UPDATE user SET name=:nom, prename=:prenom, mail=:mail, dateNaissance=:dateNaissance, code_postal=:codePostal WHERE id = :id");
		$requete->bindParam(':id', $idUser);
		$requete->bindParam(':nom', $nom);
		$requete->bindParam(':prenom', $prenom);
		$requete->bindParam(':mail', $mail);
		$requete->bindParam(':dateNaissance', $dateNaissance);
		$requete->bindParam(':codePostal', $codePostal);
		return $requete->execute();

		
	}
	catch(PDOException $e)
	{
		return False;
	}
}



function prendreTousMesStatuts($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare('SELECT * FROM membre INNER JOIN groupe ON groupe.id=membre.groupe_id WHERE membre.user_id=:user_id');
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



function prendreTousMesVotes($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare('SELECT * FROM vote INNER JOIN referendum ON referendum.id=vote.referendum_id WHERE vote.user_id=:user_id');
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



function prendreTousMesRefs($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare('SELECT * FROM referendum WHERE referendum.createur_id=:user_id');
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



function prendreTousMesParams($idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare('SELECT * FROM user WHERE user.id=:user_id');
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		if(count($res)>0)
		{
			return $res[0];
		}
		else
		{
			return array();
		}
	}
	catch(PDOException $e)
	{
		return array();
	}
}




?>