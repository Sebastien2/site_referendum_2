
	<a href=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$groupe['id']; ?> class="list-group-item">
		<strong><?php echo $groupe['nom']; ?></strong>: <?php echo $groupe['descriptif'] ; ?><br>
		<?php
		if($groupe['statut']==0)
		{
			echo "Pas membre";
		}
		elseif($groupe['statut']==1)
		{
			echo "Candidature pour le statut de membre";
		}
		elseif($groupe['statut']==2)
		{
			echo "Mebre";
		}
		elseif($groupe['statut']==3)
		{
			echo "Candidature pour le statut d'administrateur";
		}
		elseif($groupe['statut']==4)
		{
			echo "Administrateur";
		}
		?>

	</a>