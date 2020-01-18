<div class="jumbotron">
	<p class="text-center"><a href=<?php echo "index.php?module=ref&amp;action=presentationRef&amp;idRef=".$ref['id'] ; ?> ><?php echo $ref['titre'] ; ?></a><br>
		<?php echo $ref['descriptif'] ; ?><br>
		<?php echo $ref['question'] ; ?><br>

		<div class="col-md-5 text-center">
			<form method="post" action=<?php echo "index.php?module=listes&amp;action=voteOui&amp;idRef=".$ref['id'] ; ?> >
				<input type="submit"value="Oui" class="btn btn-lg btn-info">
			</form>
		</div>
		<div class="col-md-2">
		</div>
		<div class="col-md-5 text-center">
			<form method="post" action=<?php echo "index.php?module=listes&amp;action=voteNon&amp;idRef=".$ref['id'] ; ?> >
				<input type="submit"value="Non" class="btn btn-lg btn-info">
			</form>
		</div>
		
		<div class="text-center">
			<form method="post" action=<?php echo "index.php?module=listes&amp;action=voteBlanc&amp;idRef=".$ref['id'] ; ?> >
				<input type="submit"value="Vote blanc" class="btn btn-lg btn-default">
			</form>
		</div>

		
	</p>



</div>