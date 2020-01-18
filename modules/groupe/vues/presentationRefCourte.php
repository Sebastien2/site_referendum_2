<!--utilise la variable ref-->

<a class="list-group-item" href=<?php echo "index.php?module=ref&action=presentationRef&idRef=".$ref['id']; ?> >
	<h4>
		<?php echo $ref['titre']; ?>
	</h4>
	<div class="">
		<?php echo $ref['question']; ?> <br/>
		Période de vote: du <?php echo (new Datetime($ref['dateDebut']))->format('d/m/Y').' au '.(new Datetime($ref['dateFin']))->format('d/m/Y'); ?>, 
		<?php
		$now=(new Datetime())->format('Y-m-d');
		if($now<$ref['dateDebut'])
		{
			echo "non débuté";
		}
		elseif($now>$ref['dateFin'])
		{
			echo "clos";
		}
		else
		{
			echo "en cours";
		}
		?>
		<br/>

	</div>
</a>
