<?php


include(CHEMIN_MODELE.'inscription.php');

if(empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['mail']) or empty($_POST['codePostal']) or empty($_POST['dateNaissance']) or empty($_POST['mdp']) or empty($_POST['mdp2']))
{
	header('Location:index.php?module=user&action=inscription');
}
else
{
	$nom=htmlspecialchars($_POST['nom']);
	$prenom=htmlspecialchars($_POST['prenom']);
	$mail=htmlspecialchars($_POST['mail']);
	$dateNaissance=htmlspecialchars($_POST['dateNaissance']);
	$codePostal=htmlspecialchars($_POST['codePostal']);
	$mdp=htmlspecialchars($_POST['mdp']);
	$mdp2=htmlspecialchars($_POST['mdp2']);

	if($mdp!=$mdp2)
	{
		header("Location:index.php?module=user&action=inscription");
	}
	else
	{
		//header("Location:index.php?module=user&action=inscription");
		$enregistrement=enregistrerProfil($nom, $prenom, $mail, $dateNaissance, $codePostal, $mdp);
		//var_dump($enregistrement);
		
		//var_dump($enregistrement);
		if($enregistrement=="succes")
		{
			$resultat="Inscription réussie";
			header("Location: index.php?resultat=".$resultat);
		}
		elseif($enregistrement=="Identifiant déjà existant")
		{
			echo "Le mail choisi n'est pas disponible, veuillez en fournir un autre"; //A passer en javascript
			header("Location:index.php?module=user&action=inscription");
		}
		else
		{
			$erreur="Une erreur est survenue";
			header("Location:index.php?module=user&action=inscription&erreur=".$erreur);
		}
		

	}



}

?>