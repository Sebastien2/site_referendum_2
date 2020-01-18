<!--on met d'abord la liste des liaisons, avec la possibilité de les retirer-->
<h3><?php echo $groupeCentral['nom'] ; ?></h3>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Groupes fils:</h3>
	</div>
	<div class="panel-body">
		<ul>
		<?php

		foreach($groupesFils as $gr)
		{
			
			?>

			<li> <?php echo $gr['nom'] ; ?>: <a href=<?php echo "index.php?module=groupe&amp;action=retirerLiaisonFils&amp;idGroupe=".$idGroupe."&amp;idGroupeFils=".$gr['id']  ; ?> > Retirer la liaison avec <?php echo $gr['nom'] ; ?></a></li><br/>
			<?php
		}
		?>
		</ul>
	</div>
</div>



<div class="panel panel-info">
	<div class="panel-heading">
		<h3>Groupes parents:</h3>
	</div>
	<div class="panel-body">

		<ul>
		<?php

		foreach($groupesParents as $gr)
		{
			?>
			<li><a href=<?php echo "index.php?module=groupe&amp;action=retirerLiaisonParent&amp;idGroupe=".$idGroupe."&amp;idGroupeParent=".$gr['id'] ; ?> > <?php echo $gr['nom'] ; ?> </a></li><br/>

			<?php
			
		}
		?>
		</ul>
	</div>
</div>


<!--Puis la possibilités de rajouter des liens-->
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Ajouter un groupe fils</h3>
	</div>
	<div class="panel-body">
		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=ajoutGroupeFils&amp;idGroupe=".$idGroupe ; ?> >

			<label for="groupeFils">Choisir le groupe fils à qui faire la demande</label>
			<select name="groupeFils" id="groupeFils" class="form-control">
				<?php
				foreach($groupesFilsPossibles as $gr)
				{
					echo "<option value=".$gr['id']." >".$gr['id']."-".$gr['nom']."</option>";
				}
				?>
				
			</select>
			<br/>
			<input type="submit" value="Envoyer la demande" class="btn btn-primary"/>
		</form>
	</div>
</div>

<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Ajouter un groupe parent</h3>
	</div>
	<div class="panel-body">

		<form method="post" action=<?php echo "index.php?module=groupe&amp;action=ajoutGroupeParent&amp;idGroupe=".$idGroupe ; ?> >

			<label for="groupeParents">Choisir le groupe parent à qui faire la demande</label>
			<select name="groupeParents" id="groupeParents" class="form-control">
				<?php
				foreach($groupesParentsPossibles as $gr)
				{
					echo "<option value=".$gr['id']." >".$gr['id']."-".$gr['nom']."</option>";
				}
				?>
			</select>
			<br/>
			<input type="submit" value="Envoyer la demande" class="btn btn-primary"/>

		</form>
	</div>
</div>


<!--Offres reçues-->
<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Offre reçues de groupes parents</h3>
	</div>
	<div class="panel-body">
		<ul>
		<?php
		foreach($offresFils as $g)
		{
			echo "<li>";
			include(CHEMIN_VUE.'offreGroupeFils.php');
			echo "</li>";
		}
		?>
		</ul>
	</div>
</div>


<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Offre reçues de groupes fils</h3>
	</div>
	<div class="panel-body">

		<ul>
		<?php
		foreach($offresParents as $g)
		{
			echo "<li>";
			include(CHEMIN_VUE.'offreGroupeParent.php');
			echo "</li>";
		}
		?>
		</ul>
	</div>
</div>


<!--Offres émises-->
<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Offre émises de groupes parents</h3>
	</div>
	<div class="panel-body">
		<ul>
		<?php
		foreach($offresFilsEmises as $g)
		{
			echo "<li>";
			include(CHEMIN_VUE.'offreGroupeFilsEmise.php');
			echo "</li>";
		}
		?>
		</ul>
	</div>
</div>


<div class="panel panel-success">
	<div class="panel-heading">
		<h3>Offre émises de groupes fils</h3>
	</div>
	<div class="panel-body">

		<ul>
		<?php
		foreach($offresParentsEmises as $g)
		{
			echo "<li>";
			include(CHEMIN_VUE.'offreGroupeParentEmise.php');
			echo "</li>";
		}
		?>
		</ul>
	</div>
</div>


<form method="post" action=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$idGroupe ; ?> >
	<input type="submit" value="Retour à la présentation du groupe" class="btn btn-primary">
</form>