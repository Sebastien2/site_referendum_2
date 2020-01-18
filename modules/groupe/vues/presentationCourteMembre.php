<!--fournit un descriptif rapide de membre-->

<li class="list-group-item">
	<?php echo $membre['name']." ".$membre['prename'].": entré le ".(new Datetime($membre['dateAcquisition']))->format('d/m/Y'); ?><br/>
	<?php
	//on met les liens correspondant à son statut
	if($membre['statut']==1)
	{
		?>
		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=accepterCandidature&amp;idGroupe=". $membre['groupe_id'] . "&amp;idUser=". $membre['user_id'] ; ?> >
			<input type="submit" value="Accepter" class="btn btn-success">
		</form>
		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=refuserCandidature&amp;idGroupe=". $membre['groupe_id'] . "&amp;idUser=". $membre['user_id'] ; ?> >
			<input type="submit" value="Refuser" class="btn btn-danger">
		</form>
		<?php
		
		
	}
	if($membre['statut']==3)
	{
		?>
		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=accepterCandidatureAdmin&amp;idGroupe=". $membre['groupe_id'] . "&amp;idUser=". $membre['user_id'] ; ?> >
			<input type="submit" value="Accepter" class="btn btn-success">
		</form>
		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=refuserCandidatureAdmin&amp;idGroupe=". $membre['groupe_id'] . "&amp;idUser=". $membre['user_id'] ; ?> >
			<input type="submit" value="Refuser" class="btn btn-danger">
		</form>
		<?php
		
	}

	?>
</li>