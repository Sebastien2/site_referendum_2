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
	
	$renvoi="";
	$messages=prendreMessagesConversation($idConv);
	//echo var_dump($messages);
	foreach($messages as $message)
	{
			
		$renvoi.="<li id='".$message['id']."' class='list-group-item'><strong>". $message['name']." ".$message['prename']."</strong><br>".$message['commentaire']."<br><small class='text-muted'>".$message['dateCreation']."</small></li>";
			
	}
	echo $renvoi;
	
	



}

?>