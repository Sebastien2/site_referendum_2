<?php

if(!empty($_SESSION['mail']))
{
	unset($_SESSION['mail']);
}
if(!empty($_SESSION['mdp']))
{
	unset($_SESSION['mdp']);
}
if(!empty($_SESSION['nom']))
{
	unset($_SESSION['nom']);
}
if(!empty($_SESSION['id']))
{
	unset($_SESSION['id']);
}
if(!empty($_SESSION['prenom']))
{
	unset($_SESSION['prenom']);
}
if(!empty($_SESSION['hashedpassword']))
{
	unset($_SESSION['hashedpassword']);
}
header('Location: index.php?module=listes&action=accueil');

?>