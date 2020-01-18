<!--on présente le groupe $g, et on met les boutons pour accepter la proposition ou la refuser-->
<p>
	<strong><?php echo $g['nom']; ?></strong> souhaite être intégré à vos membres.<br/>
	<?php echo $g['descriptif']; ?>
	<?php //echo $g['id']; ?>

	<form method="post" action=<?php echo "index.php?module=groupe&amp;action=accepterOffreParent&amp;offre=".$g['id']; ?> >
		<input type="submit" value="Accepter" class="btn btn-success"/>
	</form>

	<form method="post" action=<?php echo "index.php?module=groupe&amp;action=refuserOffreParent&amp;offre=".$g['id']; ?> >
		<input type="submit" value="Refuser" class="btn btn-danger"/>
	</form>

</p>



