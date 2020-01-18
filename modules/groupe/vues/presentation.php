<div class="jumbotron">

	<h1><?php echo $groupe['nom']; ?></h1>

	<p><?php echo $groupe['descriptif']; ?></p>
	
</div>


	<div class="col-md-6 text-center">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4>Groupes enfants:</h4>
			</div>
			<div class="panel-body">
			<?php include(CHEMIN_CONTROLEUR.'listeGroupesEnfants.php'); ?>
			</div>
		</div>
	</div>

	<div class="col-md-6 text-center">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4>Groupes parents:</h4>
			</div>
			<div class="panel-body">
				<?php include(CHEMIN_CONTROLEUR.'listeGroupesParents.php'); ?>
			</div>
		</div>
	</div>

	
		
	<div class="col-md-12">

		<?php
		if($statut==0)
		{
			?>
			<div class='col-md-12 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=demanderIntegration&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Demande d'intégration" class='btn btn-default'>
				</form>
			</div>
			<?php
		}
		if($statut==2)
		{
			?>
			<div class='col-md-6 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=demanderStatutAdmin&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Demande du statut d'administrateur" class='btn btn-default'>
				</form>
			</div>

			<?php
		}
		if($statut==2)
		{
			?>
			<div class='col-md-6 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=quitterGroupe&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Quitter le groupe" class='btn btn-default'>
				</form>
			</div>
			
			<?php
		}
		if($statut==4 and $nbAdmin>1)
		{
			?>
			<div class='col-md-4 text-center'>
			<form method="post" action=<?php echo "index.php?module=groupe&amp;action=quitterStatutAdmin&amp;idGroupe=".$idGroupe ; ?> >
				<input type="submit" value="Abandonner le statut d'administrateur" class='btn btn-default'>
			</form>
			</div>
			<div class='col-md-4 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=descriptifMembres&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Liste des membres du groupe" class='btn btn-default'>
				</form>
			</div>
			<div class='col-md-4 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=gestionGroupe&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Gestion du groupe" class='btn btn-default'>
				</form>
			</div>
			<?php
		}
		if($statut==4 and $nbAdmin<=1)
		{
			?>
			<div class='col-md-6 text-center'>
			<form method="post" action=<?php echo "index.php?module=groupe&amp;action=descriptifMembres&amp;idGroupe=".$idGroupe ; ?> >
				<input type="submit" value="Liste des membres du groupe" class='btn btn-default'>
			</form>
			</div>
			<div class='col-md-6 text-center'>
				<form method="post" action=<?php echo "index.php?module=groupe&amp;action=gestionGroupe&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Gestion du groupe" class='btn btn-default'>
				</form>
			</div>
			<?php
		}
		?>


		<?php
		if($statut>=2)
		{
			//on met le bouton 'créer un référendum'
			?>
			<br>
			<div class='col-md-12 text-center'>
				<form method="post" action= <?php echo "index.php?module=ref&amp;action=creerRefDepuisGroupe&amp;idGroupe=".$idGroupe ; ?> >
					<input type="submit" value="Créer un référendum" class='btn btn-primary'>
				</form><br>
			</div>
			<?php
		}

		?>

	</div>



	<!--Puis on présente la liste des referendums liés à ce groupe directement-->
	<div class="col-md-12">
		<div class="panel panel-info list-group">
			<div class="panel-heading list-group-item-heading">
				<h4>Référendums initiés par ce groupe</h4>
			</div>
			<div class="panel-body">
				
				<?php
				foreach($directRefs as $ref)
				{
					include('presentationRefCourte.php');
				}

				?>
				
			</div>
		</div>
	</div>

	<!--Puis on présente la liste des référendums liés à ce groupe indirectement (auxquels ce groupe participe)-->
	<div class="col-md-12">
		<div class="panel panel-info list-group">
			<div class="panel-heading list-group-item-heading">
				<h4>Référendums auxquel le groupe prend part</h4>
			</div>
			<div class="panel-body">
	
				<?php
				if(count($undirectRefs)>0)
				{
					foreach($undirectRefs as $ref)
					{
						include('presentationRefCourte.php');
					}
				}
				else
				{
					echo "<h4>Aucun referendum</h4>";
				}
				

				?>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h4>Conversations liées à ce groupe</h4>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					<?php
					foreach($conversations as $conversation)
					{
						?>
						<a href=<?php echo "index.php?module=conversation&amp;action=presentationConversation&amp;idConversation=".$conversation['id'] ; ?> class="list-group-item"> <?php echo $conversation['titre'] ; ?></a>
						<?php
					}
					?>
				</ul>
				<form method="post" action=<?php echo "index.php?module=conversation&amp;action=creerConversation&amp;idGroupe=".$groupe['id'] ; ?> >
					<input type="submit" value="Créer un nouveau fil de conversation" class='btn btn-default'>
				</form>
			</div>
		</div>
	</div>