<?php


include("modeles/commonModel.php");


function personneExiste($mail, $mdp)
{
	try
	{
		$pdo=PDO2::getInstance();

		$request=$pdo->prepare("SELECT * FROM user WHERE mail = :mail");
		$request->bindParam(':mail', $mail);
		$request->execute();

		$result=$request->fetchAll();


		if(count($result)!=1)
		{
			$res=-1;
			return [$res, 0];
		}
		elseif (current($result)['password']==hash('sha256', $mdp.$result[0]['salt'])) {
			return [current($result)['id'], current($result)];
		}
		else
		{
			$res=-1;
			return [$res, 0];
		}
	}catch(PDOException $e)
	{
		$res=-1;
		return [$res, 0];
	}

}








?>