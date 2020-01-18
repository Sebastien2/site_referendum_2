<!--on affiche le résultat-->

<h3>Résultats du référendum <?php echo $ref['titre']; ?></h3>
<div class="panel panel-success">
	<div class="panel-heading">
		<div class="text-center">
		
			<strong>Nombre de votes: <?php echo $resultat['nb_votes']; ?></strong>
		</div>
	</div>

	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Oui</th>
					<th>Non</th>
					<th>Blanc</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Nombre</td>
					<td><?php echo $resultat['nb_oui']; ?></td>
					<td><?php echo $resultat['nb_non']; ?></td>
					<td><?php echo $resultat['nb_votes']-$resultat['nb_oui']-$resultat['nb_non']; ?></td>
				</tr>

				<?php
				if($resultat['nb_votes']>0)
				{
				?>
				<tr>
					<td>Pourcentages avec les votes blanc</td>
					<td><?php echo $resultat['nb_oui']*100/$resultat['nb_votes']; ?>%</td>
					<td><?php echo $resultat['nb_non']*100/$resultat['nb_votes']; ?>%</td>
					<td><?php echo ($resultat['nb_votes']-$resultat['nb_oui']-$resultat['nb_non'])*100/$resultat['nb_votes']; ?>%</td>
				</tr>
				<?php
				}
				if(($resultat['nb_oui']+$resultat['nb_non'])>0)
				{
				?>
				<tr>
					<td>Pourcentages sans les votes blancs</td>
					<td><?php echo $resultat['nb_oui']*100/($resultat['nb_oui']+$resultat['nb_non']) ; ?>%</td>
					<td><?php echo $resultat['nb_non']*100/($resultat['nb_oui']+$resultat['nb_non']) ; ?>%</td>
					<td></td>
				</tr>
				<?php
				}
				?>

			</tbody>
		</table>
			
	</div>


</div>

<form method="post" action=<?php echo "index.php?module=ref&amp;action=presentationRef&amp;idRef=".$ref['id']; ?> >
	<input type="submit" value="Retour à la présentation du référendum" class="btn btn-primary">
</form>
