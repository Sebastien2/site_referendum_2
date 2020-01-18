
	<a href=<?php echo "index.php?module=ref&amp;action=presentationRef&amp;idRef=".$ref['id']; ?>  class="list-group-item">
		<strong>
			<?php echo $ref['titre']; ?>
				
		</strong>: <?php echo $ref['descriptif'] ; ?><br>
		<p>
			<?php echo $ref['question']; ?><br>
			Du <?php echo (new Datetime($ref['dateDebut']))->format('d/m/Y') ; ?> au <?php echo (new Datetime($ref['dateFin']))->format('d/m/Y') ; ?>: 
			<?php
			//On met l'état du référendum
			$now=(new Datetime())->format('Y-m-d');
			if($now>$ref['dateFin'])
			{
				echo "votes clos";
			}
			elseif($now<$ref['dateDebut'])
			{
				echo "votes non entamés";
			}
			else
			{
				echo "votes en cours";
			}

			?>
		</p>
	</a>


