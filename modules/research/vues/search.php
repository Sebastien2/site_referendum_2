<h3>Résultats de la recherche <?php echo $search ; ?></h3>

<div class="container">
	<ul>
		<?php
		foreach($resultsRefs as $ref)
		{
			echo "<li>Référendum <a href='index.php?module=ref&amp;action=presentationRef&amp;idRef=".$ref['id']."'>".$ref['titre']."</a>: ".$ref['descriptif']."</li>";
		}
		foreach($resultsGroupe as $g)
		{
			echo "<li>Groupe <a href='index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$g['id']."'>".$g['nom']."</a>: ".$g['descriptif']."</li>";
		}


		?>
	</ul>

</div>