<?php

include('modeles/commonModel.php');


function droitAccesConversation($idConv, $idUser)
{
	$idGroupe=prendreGroupeConversation($idConv);
	if($idGroupe<0)
	{
		return False;
	}
	else
	{
		return droitAcces($idGroupe, $idUser);
	}
	
}



function droitAcces($idGroupe, $idUser)
{
	$groupes=groupesUserPouvantVoter($idUser);
	return (in_array($idGroupe, $groupes));

}



function prendreGroupeConversation($idConv)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM liengroupeconversation WHERE conversation_id=:conv_id");
		$requete->bindParam(':conv_id', $idConv);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$res=$res[0];
			return $res['groupe_id'];
		}
		else
		{
			return -1;
		}
	}
	catch(PDOException $e)
	{
		return -1;
	}
}




function prendreConversation($idConv, $idUser) //idUser peut servir à l'identification
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM conversation WHERE id=:conv_id");
		$requete->bindParam(':conv_id', $idConv);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$res=$res[0];
			return $res;
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




function prendreMessagesConversation($idConv)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT user.name, user.id, user.prename, com.* FROM commentaire as com INNER JOIN user as user ON  com.user_id=user.id WHERE com.conversation_id=:conv_id ORDER BY com.dateCreation ASC");
		$requete->bindParam(':conv_id', $idConv);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return "bleu";
	}
}


function creerConversation($idUser, $idGroupe, $titre)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$now=(new DateTime())->format('Y-m-d H:i:s');
		$expired=0;
		$dateExpiration=null;

		$requete=$pdo->prepare("INSERT INTO conversation(createur_id, titre, dateCreation, expired, dateExpiration) VALUES (:createur_id, :titre, :dateCreation, :expired, :dateExpiration)");
		$requete->bindParam(':createur_id', $idUser);
		$requete->bindParam(':titre', $titre);
		$requete->bindParam(':dateCreation', $now);
		$requete->bindParam(':expired', $expired);
		$requete->bindParam(':dateExpiration', $dateExpiration);

		$res=$requete->execute();
		$idConv=$pdo->lastInsertId();
		if($res)
		{
			//On ajoute la liaison
			try
			{
				$requete=$pdo->prepare("INSERT INTO liengroupeconversation(groupe_id, conversation_id) VALUES (:groupe_id, :conversation_id)");
				$requete->bindParam(':conversation_id', $idConv);
				$requete->bindParam(':groupe_id', $idGroupe);
				return $requete->execute();

			}
			catch(PDOException $e)
			{
				return False;
			}
		}
		
	}
	catch(PDOException $e)
	{
		return False;
	}
}




function ajouterMessage($idConv, $contenu, $idUser)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$dateCreation=(new DateTime())->format('Y-m-d H:i:s');

		$requete=$pdo->prepare("INSERT INTO commentaire(user_id, conversation_id, commentaire, dateCreation) VALUES (:user_id, :conversation_id, :commentaire, :dateCreation)");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':conversation_id', $idConv);
		$requete->bindParam(':commentaire', $contenu);
		$requete->bindParam(':dateCreation', $dateCreation);
		return $requete->execute();

	}
	catch(PDOException $e)
	{
		return False;
	}
}








?>