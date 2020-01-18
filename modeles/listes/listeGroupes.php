<?php


include("modeles/commonModel.php");

function listeTousGroupes()
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe WHERE expired=0");
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





function prendreToutesCategories()
{
	$pdo=PDO2::getInstance();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM categorie WHERE 1");
		$requete->execute();

		$res=$requete->fetchAll();
		return $res;
		/*
		$size=count($res);
		$liste=array();
		foreach($res as $r)
		{
			$liste[]=$r['id'];
		}
		return $liste;
		*/
	}
	catch(PDOException $e)
	{
		return array();
	}
}









?>