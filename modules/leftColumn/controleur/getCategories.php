<?php


//on récupère la liste des categories
include(CHEMIN_MODELE.'classique.php');


$categories=getCategories();

$res="<div class='list-group-item' id='genererCategories2'><p>Générer les référendums<span class='dropup'><span class='caret'></span></span></p><div class='list-group'>";
$nb=prendreNbRefsAVoterTous($_SESSION['id']);
$res.="<a href='index.php?module=listes&amp;action=referendumSuccessif' class='list-group-item'>Tous"."<span class='badge'>".$nb."</span></a>";
foreach($categories as $cat)
{
	$nb=prendreNbRefsAVoterParCategorie($_SESSION['id'], $cat['id']);
	$res.="<a href='index.php?module=listes&amp;action=referendumSuccessif&amp;idCat='".$cat['id']." class='list-group-item'>".$cat['nom']."<span class='badge'>".$nb."</span>"."</a>";
}

$res.="</div></div>";

echo $res;









?>