<?php

include(CHEMIN_MODELE.'conversation.php');

//echo var_dump($_POST);


if(isIdentified())
{
	echo "echec 1";
}
elseif(empty($_POST['idConv']))
{
	echo "echec 2";
}
else
{
	$idConv=htmlspecialchars($_POST['idConv']);
	$idUser=$_SESSION['id'];
	
	//Puis modele
	$messages=prendreMessagesConversation($idConv);
	//echo var_dump($messages);
	echo count($messages);
	
}

?>