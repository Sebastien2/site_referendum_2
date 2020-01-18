
<div class="list-group">
	<div class="list-group-item active">
		<h4>Liste des groupes auxquels je peux articiper</h4>
	</div>
	<?php
	foreach($mesGroupes as $groupe)
	{
		?>
		<a href=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$groupe['id'] ; ?> class="list-group-item"><?php echo $groupe['nom'] ; ?> </a>
		<?php
	}
	?>
</div>