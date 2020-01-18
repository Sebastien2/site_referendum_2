<?php



include(CHEMIN_MODELE.'conversation.php');

if(isIdentified())
{
	$erreur="Identifiaction requise";
	header('Location: index.php?module=user&action=connexion&erreur='.$erreur);
}


if(empty($_GET['idConversation']))
{
	$erreur="Conversation inconnue";
	header('Location: index.php?erreur='.$erreur);
}

$idConv=htmlspecialchars($_GET['idConversation']);
$idUser=$_SESSION['id'];


$droit=droitAccesConversation($idConv, $idUser);
if($droit)
{
	$conversation=prendreConversation($idConv, $idUser); //on vérifie les droits au passage

	$idGroupe=prendreGroupeConversation($idConv);
	$groupe=recupererGroupe($idGroupe);

	//Puis on prend tous les messages
	$messages=prendreMessagesConversation($idConv);

	//var_dump($conversation);
	//var_dump($messages);

	include(CHEMIN_VUE.'presentationConversation.php');
}
else
{
	$erreur="Vous n'avez pas les droits d'accès à cette conversation";
	header('Location: index.php?erreur='.$erreur);
}



?>