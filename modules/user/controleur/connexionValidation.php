<?php

include(CHEMIN_MODELE.'connexionValidation.php');


if(empty($_POST['mail']) or empty($_POST['mdp']))
{
	$erreur="Identifiant ou mot de passe incorrect";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


$mail=htmlspecialchars($_POST['mail']);
$mdp=htmlspecialchars($_POST['mdp']);


//On le recherche dans la bdd
$res=personneExiste($mail, $mdp);
$id=$res[0];
$pers=$res[1];


/*
ini_set('sendmail_from', "boire.sebastien@gmail.com");

$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$header .= "To: <boire.sebastien@gmail.com>" . "\r\n";
$header .= 'From: boire.sebastien@gmail.com \r\n';
//ini_set("SMTP", "boire.sebastien@gmail.com");
$msg="Et voici un magnifique message";
$msg=wordwrap($msg, 70);
var_dump(mail("boire.sebastien@gmail.com", "Super mail", $msg, $header));
*/

if($id<0)
{
	$erreur="Identifiant ou mot de passe incorrect";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}
else
{
	//On l'nregistre dans la session
	$_SESSION['id']=$id;
	$_SESSION['mail']=$mail;
	$_SESSION['nom']=$pers['name'];
	$_SESSION['prenom']=$pers['prename'];
	

	//include('index.php?module=user&action=connectee');
	header('Location: index.php?module=listes&action=accueil');
}


?>