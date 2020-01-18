<?php

include(CHEMIN_MODELE.'monCompte.php');

if(isIdentified())
{
	$erreur="Connexion requise";
	header('Location: index.php?erreur='.$erreur);
}

$idUser=$_SESSION['id'];

//Liste de mes statuts dans tous mes groupes
$mesStatuts=prendreTousMesStatuts($idUser);

//Liste de mes votes
$mesVotes=prendreTousMesVotes($idUser);


//Liste de mes referendums
$mesRefs=prendreTousMesRefs($idUser);


//Liste de mes paramètres personnels
$mesParams=prendreTousMesParams($idUser);

/*
var_dump($mesStatuts);
var_dump($mesVotes);
var_dump($mesRefs);
var_dump($mesParams);
*/


include(CHEMIN_VUE.'monCompte.php');


?>