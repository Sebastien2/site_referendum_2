<?php


include(CHEMIN_MODELE.'getPartieRefsDeconnecte.php');


//on vérifie la connexion

//Puis les données
if(empty($_POST['cat']) or empty($_POST['categorie']) or empty($_POST['periodeVote']))
{
	echo "erreur de transmission";
}
else
{
	$cat=htmlspecialchars($_POST['cat']);
	$categorie=htmlspecialchars($_POST['categorie']);
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


	$resultat=extractionReferendums($cat, $categorie, $periodeVote, $dateDebut, $dateFin);

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
	if($res['dateFin']<$now)
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
	
}





