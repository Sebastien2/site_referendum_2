<?php

function getCategories()
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM categorie");
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			
			return $res;
				
		}
		return $res;
	}
	catch(PDOException $e)
	{
		return array();
	}
}



?>