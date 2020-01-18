<?php

include('modeles/commonModel.php');


function extractionReferendums($cat, $categorie, $droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin)
{
	
	//return "bibo baggins";
	//Puis on distingue les cas
	if($cat=="tous")
	{
		//return 'tous';
		if(empty($dateDebut))
		{
			if(empty($dateFin))
			{
				return extractionReferendums1($droitDeVote, $historique, $periodeVote);
			}
			else
			{
				return extractionReferendums2($droitDeVote, $historique, $periodeVote, $dateFin);
			}
		}
		else
		{
			if(empty($dateFin))
			{
				return extractionReferendums3($droitDeVote, $historique, $periodeVote, $dateDebut);
			}
			else
			{
				return extractionReferendums4($droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin);
			}
		}
		
	}
	else
	{
		//return "pasTous";
		if(empty($dateDebut))
		{
			if(empty($dateFin))
			{
				return extractionReferendums5($categorie, $droitDeVote, $historique, $periodeVote);
			}
			else
			{
				return extractionReferendums6($categorie, $droitDeVote, $historique, $periodeVote, $dateFin);
			}
		}
		else
		{
			if(empty($dateFin))
			{
				return extractionReferendums7($categorie, $droitDeVote, $historique, $periodeVote, $dateDebut);
			}
			else
			{
				return extractionReferendums8($categorie, $droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin);
			}
		}
	}
	
}



function extractionReferendums1($droitDeVote, $historique, $periodeVote)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum ORDER BY dateCreation DESC");
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut<=:datenow AND dateFin>=:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateFin<:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}



function extractionReferendums2($droitDeVote, $historique, $periodeVote, $dateFin)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':dateDebut', $dateFin);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateFin<:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}
function extractionReferendums3($droitDeVote, $historique, $periodeVote, $dateDebut)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateFin<:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}

function extractionReferendums4($droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam('dateFin', $dateFin);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut>:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam('dateFin', $dateFin);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam('dateFin', $dateFin);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE dateFin<:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam('dateFin', $dateFin);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}

function extractionReferendums5($categorie, $droitDeVote, $historique, $periodeVote)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie ORDER BY dateCreation DESC");
			$requete->bindParam(':categorie', $categorie);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut<=:datenow AND dateFin>=:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateFin<:datenow ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}

function extractionReferendums6($categorie, $droitDeVote, $historique, $periodeVote, $dateFin)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateFin<:datenow AND dateDebut<=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateFin);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}

function extractionReferendums7($categorie, $droitDeVote, $historique, $periodeVote, $dateDebut)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateFin<:datenow AND dateDebut>=:dateDebut ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}

function extractionReferendums8($categorie, $droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete="";
		$now=(new DateTime())->format('Y-m-d H:i:s');
		if($periodeVote=="tous")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam(':dateFin', $dateFin);
		}
		elseif($periodeVote=="nonOuverte")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut>:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam(':dateFin', $dateFin);
		}
		elseif($periodeVote=="enCours")
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateDebut<=:datenow AND dateFin>=:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam(':dateFin', $dateFin);
		}
		else
		{
			$requete=$pdo->prepare("SELECT * FROM referendum INNER JOIN categorie ON referendum.categorie_id=categorie.id WHERE categorie.id=:categorie AND dateFin<:datenow AND dateDebut>=:dateDebut AND dateFin<=:dateFin ORDER BY dateCreation DESC");
			$requete->bindParam(':datenow', $now);
			$requete->bindParam(':categorie', $categorie);
			$requete->bindParam(':dateDebut', $dateDebut);
			$requete->bindParam(':dateFin', $dateFin);
		}
		$requete->execute();

		$refs=$requete->fetchAll();
		$res=array();
		//Puis on regarde les droits sur chacun
		foreach($refs as $ref)
		{
			//on regarde les choix demandés
			$idUser=$_SESSION['id'];
			$voteEffectue=voteSurReferendumPresent($idUser, $ref['id']);
			$droitVote=droitDeVote($idUser, $ref['id']);
			if($historique=="tous" or ($historique=="dejaVote" and $voteEffectue) or ($historique=="pasEncoreVote" and !$voteffectue))
			{
				if($droitDeVote=="tousVisible" or $droitVote)
				{
					$res[]=$ref;
				}
			}
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}


function voteSurReferendumPresent($idUser, $idRef)
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		
		$now=(new DateTime())->format('Y-m-d H:i:s');
		
		$requete=$pdo->prepare("SELECT * FROM vote WHERE referendum_id=:referendum_id AND user_id=:user_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam('referendum_id', $idRef);
		$requete->execute();

		$refs=$requete->fetchAll();
		if(count($refs)>0)
		{
			return True;
		}
		else
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