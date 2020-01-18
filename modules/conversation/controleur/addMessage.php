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
elseif(empty($_POST['contenu']))
{
	echo "echec 3";
}
else
{
	$idConv=htmlspecialchars($_POST['idConv']);
	$contenu=htmlspecialchars($_POST['contenu']);
	$idUser=htmlspecialchars($_SESSION['id']);
	

	//Puis modele
	$renvoi="";
	$res=ajouterMessage($idConv, $contenu, $idUser);
	if($res)
	{
		$messages=prendreMessagesConversation($idConv);
		//echo var_dump($messages);
		foreach($messages as $message)
		{
			
			$renvoi.="<li id='".$message['id']."' class='list-group-item'><strong>". $message['name']." ".$message['prename']."</strong><br>".$message['commentaire']."<br><small class='text-muted'>".$message['dateCreation']."</small></li>";
			
		}
		echo $renvoi;
	}
	else
	{
		echo "erreur survenue";
	}
	



}






?>