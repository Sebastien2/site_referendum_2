<?php 

//on présente un référendum

include(CHEMIN_MODELE.'referendum.php');
if(empty($_GET['idRef']))
{
	//var_dump($_GET);
	$erreur="Referendum inconnu jourdi";
	header('Location: index.php?erreur='.$erreur);
}

//On récupère le refereendum
$idRef=htmlspecialchars($_GET['idRef']);
$ref=prendreRef($idRef);
//On prend le statut de la personne
$statut=False; //par défaut, pas de droit de vote
if(!empty($_SESSION['id']))
{
	$statut=droitDeVote( $_SESSION['id'], $idRef);

}

$enCours=False;
$now=(new DateTime())->format('Y-m-d H:i:s');
if($now>=$ref['dateDebut'] and $now<=$ref['dateFin'])
{
	$enCours=True;
}

$groupe=recupererGroupe(groupeDuRef($idRef));

//var_dump($enCours);
//var_dump($statut);

//echo "statut".$statut;
//var_dump($statut);


include(CHEMIN_VUE.'presentationRef.php');



?>