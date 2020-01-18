<?php



function isIdentified()
{
	if(empty($_SESSION['id']) or empty($_SESSION['nom']) or empty($_SESSION['mail']) or empty($_SESSION['prenom']))
	{
		return true;
	}
	return false;
}







function voteExistant($idRef, $idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$requete=$pdo->prepare("SELECT * FROM vote WHERE user_id=:user_id AND referendum_id=:referendum_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':referendum_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{
			return $res[0]['valeur'];

		}
		return -1;


	}
	catch(PDOException $e)
	{
		return -1;
	}
}










function enregistrerVote($idRef, $idUser, $reponse)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$valeur=0;
	if($reponse=="oui")
	{
		$valeur=1;
	}
	elseif($reponse=="blanc")
	{
		$valeur=2;
	}

	//Vérification des dates
	$ref=prendreRef($idRef);
	$enCours=False;
	$now=(new DateTime())->format('Y-m-d H:i:s');
	if($now>=$ref['dateDebut'] and $now<=$ref['dateFin'])
	{
		$enCours=True;
	}
	if(!$enCours)
	{
		return False;
	}

	
	try
	{
		$requete=$pdo->prepare("SELECT * FROM vote WHERE user_id=:user_id AND referendum_id=:referendum_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':referendum_id', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		//return $size;
		if($size>0)
		{

			$requete=$pdo->prepare("UPDATE vote SET valeur=:valeur WHERE user_id = :user_id AND referendum_id = :referendum_id");
			$requete->bindParam(':user_id', $idUser);
			$requete->bindParam(':referendum_id', $idRef);
			$requete->bindParam(':valeur', $valeur);
			return $requete->execute();

		}
		else
		{
			//On crée l'instance
			$dateVote=(new DateTime())->format('Y-m-d H:i:s');

			$requete=$pdo->prepare("INSERT INTO vote(user_id, referendum_id, valeur, dateVote) VALUES (:user_id, :referendum_id, :valeur, :dateVote)");
			$requete->bindParam(':user_id', $idUser);
			$requete->bindParam(':referendum_id', $idRef);
			$requete->bindParam(':valeur', $valeur);
			$requete->bindParam(':dateVote', $dateVote);
			return $requete->execute();			
		}
	}
	catch(PDOException $e)
	{
		return False;
	}
}







function prendreUser($idUser)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM user WHERE id = :id");
		$requete->bindParam(':id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			return $res[0];
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


function groupeDuRef($idRef)
{
	$ref=prendreRef($idRef);
	if(count($ref)==0)
	{
		return -1;
	}
	if(!empty($ref['groupe_id']))
	{
		return $ref['groupe_id'];
	}
	return 0; //pour les referendums pour tous
}




function listeGroupesVotant($idRef)
{
	$ref=prendreRef($idRef);
	$idGroupe=groupeDuRef($idRef);
	if($idGroupe==0)
	{
		return array(0);
	}
	if($idGroupe<0)
	{
		return array();
	}
	if($idGroupe>0)
	{
		//on crée la liste des sous-groupes
		$sousGroupes=groupesFilsRecursifs($idGroupe);
		if(!in_array($idGroupe, $sousGroupes))
		{
			$sousGroupes[]=$idGroupe;
		}
		return $sousGroupes;
	}
}




function droitDeVote($idUser, $idRef)
{
	$ref=prendreRef($idRef);
	$groupesVotant=listeGroupesVotant($idRef);

	$mesGroupes=groupesUser($idUser);

	//return $groupesVotant;
	//return $mesGroupes;

	$votant=False;
	foreach ($groupesVotant as $key => $value) {
		if(in_array($value, $mesGroupes))
		{
			$votant=True;
		}
	}

	return $votant;


}



function recupererGroupe($idGroupe)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe WHERE id = :id");
		$requete->bindParam(':id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			return $res[0];
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



function prendreRef($idRef)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM referendum WHERE id = :idRef");
		$requete->bindParam(':idRef', $idRef);
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




function statutDansGroupe($idGroupe, $idUser)
{
	//On récupère les membres existant
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM membre WHERE user_id = :user_id AND groupe_id = :groupe_id");
		$requete->bindParam(':user_id', $idUser);
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		$size=count($res);
		if($size>0)
		{
			//var_dump($res);
			$membre=$res[0];
			return $membre['statut'];
		}
		else
		{
			return 0;
		}
	}
	catch(PDOException $e)
	{
		return -1;
	}
}





//RF: check
function groupesParents($idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM liensGroupe WHERE fils = :groupe_id AND etat=2");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();
		$res=$requete->fetchAll();
		if(count($res)>0)
		{
			$liste=array();
			foreach($res as $r)
			{
				$reponse[]=$r['parent'];
			}
			return $reponse;
		}
		return array();
	}
	catch(PDOException $e)
	{
		return array();
	}
}


//RF: check
function groupesFils($idGroupe)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM liensGroupe WHERE parent = :groupe_id AND etat=2");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();
		$res=$requete->fetchAll();
		if(count($res)>0)
		{
			$liste=array();
			foreach($res as $r)
			{
				$reponse[]=$r['fils'];
			}
			return $reponse;
		}
		return array();
	}
	catch(PDOException $e)
	{
		return array();
	}
}



function groupesParentsComplet($idGroupe)
{
	$groupesParents=groupesParents($idGroupe);

	$res=array();
	foreach($groupesParents as $gr)
	{
		$g=recupererGroupe($gr);
		if(count($g)>0 and $g>0)
		{
			$res[]=$g;
		}
		
	}

	return $res;


}


function groupesFilsComplet($idGroupe)
{
	$groupesParents=groupesFils($idGroupe);

	$res=array();
	foreach($groupesParents as $gr)
	{
		$g=recupererGroupe($gr);
		if(count($g)>0 and $g>0)
		{
			$res[]=$g;
		}
		
	}

	return $res;
}


//RF: check
function groupesFilsRecursifs($idGroupe)
{
	$aAjouter=array($idGroupe);
	$resultat=array();

	while(count($aAjouter)>0)
	{
		reset($aAjouter);
		$key=key($aAjouter);
		$gr=$aAjouter[$key];
		unset($aAjouter[$key]);

		$desc=groupesFils($gr);

		foreach($desc as $d)
		{
			//Si on n'a pas déjà ajouté ce groupe(pour éviter une boucle infine qi ne devrait normalemnt pas se produire)
			if(!in_array($d, $resultat))
			{
				$aAjouter[]=$d;
			}
		}
		$resultat[]=$gr;
	}

	$key=array_search($idGroupe, $resultat);
	unset($resultat[$key]);
	return $resultat;
}


//RF: check
function groupesParentsRecursifs($idGroupe)
{
	$aAjouter=array($idGroupe);
	$resultat=array();

	while(count($aAjouter)>0)
	{
		reset($aAjouter);
		$key=key($aAjouter);
		$gr=$aAjouter[$key];
		unset($aAjouter[$key]);

		$desc=groupesParents($gr);

		foreach($desc as $d)
		{
			if(!in_array($d, $resultat))
			{
				$aAjouter[]=$d;
			}
		}
		$resultat[]=$gr;
	}

	//Puis on retire $idGroupe
	$key=array_search($idGroupe, $resultat);
	unset($resultat[$key]);
	return $resultat;
}





//RF: check
function groupesFilsPossibles($idGroupe)
{
	//on prend tous les groupes sauf les parents
	$parents=groupesParentsRecursifs($idGroupe);
	$enfants=groupesFils($idGroupe);

	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		foreach($res as $key=>$value)
		{
			if(in_array($value['id'], $parents))
			{
				//on le retire des choix possibles
				unset($res[$key]);
			}
		}
		foreach($res as $key=>$value)
		{
			if(in_array($value['id'], $enfants))
			{
				unset($res[$key]);
			}
		}
		//Puis on retire le groupe lui-même
		$key=array_search(recupererGroupe($idGroupe), $res);
		unset($res[$key]);

		return $res;

	}
	catch(PDOException $e)
	{
		return array();
	}

}



//RF: check
function groupesParentsPossibles($idGroupe)
{
	//on prend tous les groupes sauf les parents
	$fils=groupesFilsRecursifs($idGroupe);
	$parents=groupesParents($idGroupe);

	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT * FROM groupe");
		$requete->bindParam(':groupe_id', $idGroupe);
		$requete->execute();

		$res=$requete->fetchAll();
		foreach($res as $key=>$value)
		{
			if(in_array($value['id'], $fils))
			{
				//on le retire des choix possibles
				unset($res[$key]);
			}
		}
		foreach($res as $key=>$value)
		{
			if(in_array($value['id'], $parents))
			{
				unset($res[$key]);
			}
		}
		
		$key=array_search(recupererGroupe($idGroupe), $res);
		unset($res[$key]);

		return $res;

	}
	catch(PDOException $e)
	{
		return array();
	}

}





function groupesUser($idUser)
{
	$pdo=PDO2::getInstance();
	try
	{
		$requete=$pdo->prepare("SELECT groupe_id FROM membre WHERE user_id=:user_id AND expired=0");
		$requete->bindParam(':user_id', $idUser);
		$requete->execute();

		$res=$requete->fetchAll();
		$r=array();
		foreach($res as $g)
		{
			$r[]=$g['groupe_id'];
		}
		return $r;

	}
	catch(PDOException $e)
	{
		return array();
	}
}





function groupesUserPouvantVoter($idUser)
{
	$groupesDirects=groupesUser($idUser);
	$res=array();
	foreach($groupesDirects as $groupe)
	{
		if(!in_array($groupe, $res))
		{
			$res[]=$groupe;
		}
		$surGroupes=groupesParentsRecursifs($groupe);
		foreach($surGroupes as $sg)
		{
			if(!in_array($sg, $res))
			{
				$res[]=$sg;
			}
		}
	}
	return $res;
}



//OK
function prendreReferendumDirectGroupe($idGroupe, $idUser)
{
	$statut=statutDansGroupe($idGroupe, $idUser);
	if($statut>=2)
	{
		$pdo=PDO2::getInstance();
		try
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE groupe_id = :groupe_id ORDER BY dateCreation DESC");
			$requete->bindParam(':groupe_id', $idGroupe);
			$requete->execute();

			$res=$requete->fetchAll();
			return $res;
		}
		catch(PDOException $e)
		{
			return array();
		}
	}
	else
	{
		//On ne renvoit que les referendums visibles
		$pdo=PDO2::getInstance();
		try
		{
			$requete=$pdo->prepare("SELECT * FROM referendum WHERE groupe_id = :groupe_id AND visible=1 ORDER BY dateCreation DESC");
			$requete->bindParam(':groupe_id', $idGroupe);
			$requete->execute();

			$res=$requete->fetchAll();
			return $res;
		}
		catch(PDOException $e)
		{
			return array();
		}
	}

	
}



//OK
function prendreReferendumUndirectGroupe($idGroupe, $idUser)
{
	//on prend tous les groupes parents, puis tous les referendums visibles créés dasn ces groupes
	$surGroupes=groupesParentsRecursifs($idGroupe);
	//return $surGroupes;

	$refs=array();
	//Puis on prend pour chaque groupe la liste des referendums 
	foreach($surGroupes as $surGroupe)
	{
		if($surGroupe!=$idGroupe)
		{
			$nvRefs=prendreReferendumDirectGroupe($surGroupe, $idUser);
			//$refs[]=$nvRefs;
			foreach($nvRefs as $r)
			{
				$refs[]=$r;
			}
		}
		
	}


	return $refs;
}






function estReferendumFavori($idUser, $idRef)
{
	$pdo=PDO2::getInstance();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//On vérifie qu'il n'y ait pas une telle adresse mail déjà existant
	try
	{
		$requete=$pdo->prepare("SELECT * FROM favoriref WHERE id_user=:id_user AND id_referendum=:id_referendum AND statut=1");
		$requete->bindParam(':id_user', $idUser);
		$requete->bindParam(':id_referendum', $idRef);
		$requete->execute();

		$res=$requete->fetchAll();
		return (count($res)==1);
	}
	catch(PDOException $e)
	{
		return False;
	}
}










?>