<?php


include("modeles/commonModel.php");


function resultatsRefsUnknownMot($search)
{
	//On récupère tous les refs visibles contenant au moins l'un de ces mots
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE visible=1 AND (titre LIKE :search OR descriptif LIKE :search OR question LIKE :search) ORDER BY dateCreation ASC");
		$elem="%".$search."%";
		$requete->bindParam(':search', $elem);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}


function resultatsRefsUnknown($search)
{
	$elems=explode(" ", $search);
	$resultat=array();

	foreach($elems as $elem)
	{
		$res=resultatsRefsUnknownMot($elem);
		foreach($res as $key=>$value)
		{
			if(!in_array($value, $resultat))
			{
				$resultat[]=$value;
			}
		}
	}
	return $resultat;
}





function resultatsRefsKnown($search, $idUser)
{
	//on réupère chaque mot un à un
	$elems=explode(" ", $search);
	$resultat=array();

	foreach($elems as $elem)
	{
		$res=resultatsRefsKnownMot($elem, $idUser);
		foreach($res as $key=>$value)
		{
			if(!in_array($value, $resultat))
			{
				$resultat[]=$value;
			}
		}
	}
	return $resultat;


}



function resultatsRefsKnownMot($search, $idUser)
{
	//On récupère tous les refs visibles contenant au moins l'un de ces mots
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE titre LIKE :search OR descriptif LIKE :search OR question LIKE :search ORDER BY dateCreation ASC");
		$elem="%".$search."%";
		$requete->bindParam(':search', $elem);
		$requete->execute();

		$res=$requete->fetchAll();

		$resultat=array();
		foreach($res as $ref)
		{
			if(droitDeVote($idUser, $ref['id']) or $ref['visible']==1)
			{
				$resultat[]=$ref;
			}
		}

		return $resultat;
	}
	catch(PDOException $e)
	{
		return array();
	}
}



function resultatsGroupes($search)
{
	$elems=explode(" ", $search);
	$resultat=array();

	foreach($elems as $elem)
	{
		$res=resultatsGroupesMot($elem);
		foreach($res as $key=>$value)
		{
			if(!in_array($value, $resultat))
			{
				$resultat[]=$value;
			}
		}
	}
	return $resultat;
}





function resultatsGroupesMot($search)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe WHERE nom LIKE :search OR descriptif LIKE :search ORDER BY dateCreation ASC");
		$elem="%".$search."%";
		$requete->bindParam(':search', $elem);
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}




?>