<?php

if(isIdentified())
{
	//erreur car incoherent
	$erreur="Problème de connexion";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

$idUser=$_SESSION['id'];
//On regarde si le formulaire est rempli

$categorie=null;
if(!empty($_POST['categorie']))
{
	$categorie=htmlspecialchars($_POST['categorie']);
}

$droitDeVote=null;
if(!empty($_POST['droitDeVote']))
{
	$droitDeVote=htmlspecialchars($_POST['droitDeVote']);
}

$dateDebut=null;
if(!empty($_POST['dateDebut']))
{
	$dateDebut=htmlspecialchars($_POST['dateDebut']);
}

$dateFin=null;
if(!empty($_POST['dateFin']))
{
	$dateFin=htmlspecialchars($_POST['dateFin']);
}

$historique=null;
if(!empty($_POST['historique']))
{
	$historique=htmlspecialchars($_POST['historique']);
}

$periodeVote=null;
if(!empty($_POST['periodeVote']))
{
	$periodeVote=htmlspecialchars($_POST['periodeVote']);
}

/*
var_dump($categorie);
var_dump($droitDeVote);
var_dump($dateDebut);
var_dump($dateFin);
var_dump($historique);
var_dump($periodeVote);
 */

//Puis on précise le formulaire en fonction des besoins

/*$listeCategories=prendreToutesCategories();
$retenues=array();
if($categorie!="tous")
{
	//on récupère la liste des catégories cochées
	
	foreach($listeCategories as $cat)
	{
		if(!empty($_POST[$cat['id']]))
		{
			$retenues[]=$cat;
		}
	}
}
else
{
	foreach($listeCategories as $cat)
	{
		$retenues[]=$cat;
	}
}


//on donne tout ça au modèle
$listeRefs=extractionListeRefs($retenues, $droitDeVote, $dateDebut, $dateFin, $historique, $periodeVote);

*/

 include(CHEMIN_VUE.'listeRefsConnecte.php');
?>