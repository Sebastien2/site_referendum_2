<!--on affiche la question, sans rien aux alentours-->
<div class="text-center">
<h3>
	<?php
	echo $ref['question']."<br/>";

	?>
	<?php
	if($voteActuel>=0)
	{
		echo "Ma réponse actuellement: ";
		if($voteActuel==0)
		{
			echo "Non";
		}
		elseif($voteActuel==1)
		{
			echo "Oui";
		}
		elseif($voteActuel==2)
		{
			echo "Vote blanc";
		}
	}
	?>

</h3>

<p>
	<button class="btn btn-default"><a href=<?php echo "index.php?module=vote&amp;action=voteReponseOui&amp;idRef=".$idRef; ?> >Oui</a></button>
	<button class="btn btn-default"><a href=<?php echo "index.php?module=vote&amp;action=voteReponseNon&amp;idRef=".$idRef; ?> >Non</a></button>
	<button class="btn btn-default"><a href=<?php echo "index.php?module=vote&amp;action=voteReponseBlanc&amp;idRef=".$idRef; ?> >Vote blanc</a></button>

	
</p>
</div>