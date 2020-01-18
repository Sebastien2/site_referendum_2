<!--affiche la liste des membres du groupe-->

<?php

$nb=count($membres);

if($nb>0)
{
	$i=0;
	?>
	<div class="panel panel-info">
		<div class="panel-heading">
			Demandes d'intégration:
		</div>
		<div class="panel-body">
			<ul>
				<?php
				while($i<$nb)
				{
					if($membres[$i]['statut']==1)
					{
						$membre=$membres[$i];
						include(CHEMIN_VUE.'presentationCourteMembre.php');
					}
					$i+=1;
				}
				$i=0;
				?>
			</ul>
		</div>
	</div>





	<div class="panel panel-info">
		<div class="panel-heading">
			Membres:
		</div>
		<div class="panel-body">
			<ul>
				<?php
				while($i<$nb)
				{
					if($membres[$i]['statut']==2)
					{
						$membre=$membres[$i];
						include(CHEMIN_VUE.'presentationCourteMembre.php');
					}
					$i+=1;
				}
				$i=0;
				?>
			</ul>
		</div>
	</div>




	<div class="panel panel-info">
		<div class="panel-heading">
			Demandes du statut d'administrateur:
		</div>
		<div class="panel-body">
			<ul>
				<?php
				while($i<$nb)
				{
					if($membres[$i]['statut']==3)
					{
						$membre=$membres[$i];
						include(CHEMIN_VUE.'presentationCourteMembre.php');
					}
					$i+=1;
				}
				$i=0;
				?>
			</ul>
		</div>
	</div>



	<div class="panel panel-info">
		<div class="panel-heading">
			Adminsitrateurs:
		</div>
		<div class="panel-body">
			<ul>
				<?php
				while($i<$nb)
				{
					if($membres[$i]['statut']==4)
					{
						$membre=$membres[$i];
						include(CHEMIN_VUE.'presentationCourteMembre.php');
					}
					$i+=1;
				}
				?>
			</ul>
		</div>
	</div>

	
	<?php
}
else
{
	echo "Pas de membre";
}


?>


<!--Puis un lien de retour vers le descriptif du groupe-->
<form method="post" action=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$idGroupe; ?> >
	<input type="submit" value="Retour au groupe" class="btn btn-primary">
</form>
