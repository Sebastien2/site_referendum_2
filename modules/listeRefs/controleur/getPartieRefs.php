<?php


include(CHEMIN_MODELE.'getPartieRefs.php');


//on vérifie la connexion
if(isIdentified())
{
	//erreur car incoherent
	echo "bilbao";
}

$idUser=$_SESSION['id'];

//Puis les données
if(empty($_POST['cat']) or empty($_POST['categorie']) or empty($_POST['droitDeVote']) or empty($_POST['historique']) or empty($_POST['periodeVote']))
{
	echo "erreur de transmission";
}

/*
if(empty($_POST['cat']))
{
	echo 'cat';
}
if(empty($_POST['categorie']))
{
	echo 'categorie';
}
if(empty($_POST['droitDeVote']))
{
	echo 'droitDeVote';
}
if(empty($_POST['historique']))
{
	echo 'historique';
}
if(empty($_POST['periodeVote']))
{
	echo 'periodeVote';
}
*/


$cat=htmlspecialchars($_POST['cat']);
$categorie=htmlspecialchars($_POST['categorie']);
$droitDeVote=htmlspecialchars($_POST['droitDeVote']);
$historique=htmlspecialchars($_POST['historique']);
$periodeVote=htmlspecialchars($_POST['periodeVote']);


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

//Puis on fait appel à la bdd


$resultat=extractionReferendums($cat, $categorie, $droitDeVote, $historique, $periodeVote, $dateDebut, $dateFin);

//Puis on génère le html correspondant
//echo $resultat;
//echo $cat;
//echo $resultat[0]['descriptif'];

$now=(new DateTime())->format('Y-m-d H:i:s');
$retour="<ul class='jumbotron'>";
foreach($resultat as $res)
{
	$gr=recupererGroupe(groupeDuRef($res['id']));
	$retour.="<li class='panel panel-warning'><div class='panel-heading'><a href=index.php?module=ref&action=presentationRef&idRef=".$res['id']." >".$res['titre']."</a>:";
	//On met les dates de vote
	if($res['dateDebut']>$now)
	{
		$retour.=" vote non ouvert";
	}
	if($res['dateFin']<=$now)
	{
		$retour.=" vote clos";
	}
	else
	{
		$retour.=" vote en cours";
	}
	$retour.=" - <a href='index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$gr['id']."'>".$gr['nom']."</a>";
	$retour.="</div> <div class='panel-body'>".$res['descriptif']."<br><strong>Question</strong>: ".$res['question']."</div></li>";
}

$retour.="</ul>";

echo $retour;





?>