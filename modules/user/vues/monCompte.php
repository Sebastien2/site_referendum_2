<!--on met toutes les données joliement-->
<div class="panel panel-success">
	<div class="panel-heading"><h4>Mes données</h4></div>
	<div class="panel-body">
		<p id="mesDonnees" class="col-md-6">
		
			Nom: <?php echo $mesParams['name']; ?><br>
			Prénom: <?php echo $mesParams['prename']; ?><br>
			Mail: <?php echo $mesParams['mail']; ?><br>
			Date de naissance: <?php echo (new Datetime($mesParams['dateNaissance']))->format('d/m/Y'); ?><br>
			Code postal: <?php echo $mesParams['code_postal']; ?><br>
			Création du compte: <?php echo (new Datetime($mesParams['dateCreation']))->format('d/m/Y'); ?><br>
		</p>
		<br>
		<form method="post" action="index.php?module=user&amp;action=modifierDonnees" class="text-center">
			<input type="submit" class="btn btn-default" value="Modifier mes données">
		</form><br>
		<form method="post" action="index.php?module=user&amp;action=modifierPassword" class="text-center">
			<input type="submit" class="btn btn-default" value="Modifier mon mot de passe">
		</form>
		<!--<a href="index.php?module=user&amp;action=modifierDonnees">Modifier mes données</a><br>
		<a href="index.php?module=user&amp;action=modifierPassword">Modifier mon mot de passe</a><br>-->
	
	</div>

</div>

<div class="panel-info">
	<div class="panel-heading"><h4>Mes groupes</h4></div>
	<div class="panel-body">
		<p id="mesGroupes">
			
			<?php
			foreach($mesStatuts as $groupe)
			{
				include(CHEMIN_VUE.'presentationCourteStatutGroupe.php');
			}

			?>
		</p>
	</div>
</div>


<div class="panel-info list-group">
	<div class="panel-heading list-group-item"><h4>Mes votes</h4></div>
	<div class="panel-body">
		<div id="mesVotes">
			
			<?php
			foreach($mesVotes as $vote)
			{
				include(CHEMIN_VUE.'presentationCourteVote.php');
			}

			?>
			

		</div>
	</div>
</div>


<div class="panel-info list-group">
	<div class="panel-heading list-group-item"><h4>Mes referendums</h4></div>
	<div class="panel-body">
		<div id="mesRefs">
			
			<?php
			foreach($mesRefs as $ref)
			{
				include(CHEMIN_VUE.'presentationCourteRef.php');
			}
			?>
			
		</div>
	</div>
</div>