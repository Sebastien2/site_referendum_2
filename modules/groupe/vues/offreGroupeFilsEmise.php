<!--on présente le groupe $g, et on met les boutons pour accepter la proposition ou la refuser-->
<p>
	<strong><?php echo $g['nom']; ?></strong> peut vous intégrer en acceptant votre invitation.<br/>
	<?php echo $g['descriptif']; ?>
	<?php //echo $g['id']; ?>


	<form method="post" action=<?php echo "index.php?module=groupe&amp;action=annulerOffreFils&amp;offre=".$g['id']; ?> >
		<input type="submit" value="Annuler" class="btn btn-danger"/>
	</form>

</p>
