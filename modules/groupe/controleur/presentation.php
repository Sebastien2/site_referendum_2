<?php


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
else
{
	$idGroupe=htmlspecialchars($_GET['idGroupe']);
	$groupe=recupererGroupe($idGroupe);

	if($groupe==-1)
	{
		$erreur="Groupe inconnu";
		header('Location: index.php?erreur='.$erreur);
	}
	else
	{
		//var_dump($groupe);
		//On récupère le statut de l'utilsateur dans le groupe, pour savoir ses possibilté de changement
		$statut=statutDansGroupe($idGroupe, $_SESSION['id']);
		//var_dump($statut);
		$nbAdmin=nbAdministrateurs($idGroupe);

		//Puis on prend tous les referendums lies à ce projet: directRefs et undirectRefs

		$directRefs=prendreReferendumDirectGroupe($idGroupe, $_SESSION['id']);
		$undirectRefs=prendreReferendumUndirectGroupe($idGroupe, $_SESSION['id']);
		//var_dump($undirectRefs);
		//var_dump($directRefs);


		//Il faut ajouter les conversations associées à ce groupe
		$conversations=prendreConversationsGroupe($idGroupe);


		//echo "bris".var_dump(groupesParentsRecursifs($idGroupe));

		include(CHEMIN_VUE.'presentation.php');
	}
}

?>