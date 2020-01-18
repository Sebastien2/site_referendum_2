
	<a href=<?php echo "index.php?module=ref&amp;action=presentationRef&amp;idRef=".$vote['id']; ?> class="list-group-item">
		<strong><?php echo $vote['titre']; ?></strong>: <?php echo $vote['question']; ?><br>
		Réponse: <?php 
		if($vote['valeur']==0)
		{
			echo "Non";
		} 
		else
		{
			echo "Oui";
		}
		?>
	</a>

	