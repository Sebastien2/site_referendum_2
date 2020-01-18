<?php

include('../../../global/config.php');
include('../../../libs/PDO2.php');

$mail=htmlspecialchars($_GET['mail']);
$pdo=PDO2::getInstance();
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
	{
		$requete=$pdo->prepare("SELECT * FROM user WHERE mail = :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		
		echo $size;
		
		//var_dump($res);
		
		
	}
	catch(PDOException $e)
	{
		echo 0;
	}

?>