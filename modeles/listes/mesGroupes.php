<?php

include('modeles/commonModel.php');

function listeMesGroupesIndirects($idUser)
{
	$idGroupes=groupesUserPouvantVoter($idUser);
	$res=array();
	foreach($idGroupes as $idGroupe)
	{
		$groupe=recupererGroupe($idGroupe);
		$res[]=$groupe;
	}
	return $res;
}


?>