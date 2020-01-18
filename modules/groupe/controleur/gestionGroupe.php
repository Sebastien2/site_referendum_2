<?php

//Doit permettre de créer ou retirer des liens entre les groupes



include(CHEMIN_MODELE.'groupe.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}

if(empty($_GET['idGroupe']))
{
	
	$erreur="Groupe inconnu";
	header('Location: index.php?erreur='.$erreur);
}


$idGroupe=htmlspecialchars($_GET['idGroupe']);
$groupeCentral=recupererGroupe($idGroupe);

$groupesFils=groupesFilsComplet($idGroupe);
$groupesParents=groupesParentsComplet($idGroupe);

//var_dump($groupesFils);
//var_dump($groupesParents);


//Puis les listes de groupes possibles pour autre fils ou parents
$groupesFilsPossibles=groupesFilsPossibles($idGroupe);
$groupesParentsPossibles=groupesParentsPossibles($idGroupe);
//var_dump($groupesFilsPossibles);
//var_dump($groupesParentsPossibles);

//Puis la liste des demandes de liaison de groupe
$offresFils=offresGroupesParents($idGroupe);
$offresParents=offresGroupesFils($idGroupe);
//var_dump($offresFils);
//var_dump($offresParents);

$offresParentsEmises=offresGroupesFilsEmises($idGroupe);
$offresFilsEmises=offresGroupesParentsEmises($idGroupe);


include(CHEMIN_VUE.'gestionGroupe.php');

?>