<h2>Derniers référendums</h2>

<div class="container well">
	<div class="list-group">
		<?php
		foreach($refs as $ref)
		{
			?>
			
			<a href=<?php echo "index.php?module=ref&amp;action=presentationRef&amp;idRef=".$ref['id'] ; ?> class="list-group-item" ><strong><?php echo $ref['titre'] ; ?></strong>
				<small class="text-muted">
				<?php
					$now=(new Datetime())->format('Y-m-d');
					if($now>$ref['dateFin'])
					{
						echo "Vote clos";
					}
					elseif($now<$ref['dateDebut'])
					{
						echo "Vote non ouvert";
					}
					else
					{
						echo "Vote en cours";
					}

				?>
				</small>
				<br>
				<?php echo $ref['descriptif'] ; ?>
				<p><?php echo $ref['question'] ; ?></p>
				
					
				
			</a>

			<?php
		}

		?>
	</div>
</div>