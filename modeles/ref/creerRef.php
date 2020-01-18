<?php

include("modeles/commonModel.php");


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


?>