<!--Affiche un référeendum-->
<div class="jumbotron">
	<h1><?php echo $ref['titre']; ?></h1>
	  <small class="text-molded">Groupe: <a href=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$groupe['id'] ; ?> ><?php echo $groupe['nom'] ; ?></a></small> 

	<p hidden id="idRef"><?php echo $ref['id'] ; ?></p> 

	<p>
		<?php echo $ref['descriptif']; ?><br/>
	</p>
	<p>
		<?php echo $ref['question']; ?><br/>
	</p>
	<p>
		Période de vote: du <?php echo (new Datetime($ref['dateDebut']))->format('d/m/Y'); ?> au <?php echo (new Datetime($ref['dateFin']))->format('d/m/Y'); ?><br/>
		
	</p>
	<!--à changer-->
	<div id="favoriRef">
		<?php
		if(!empty($_SESSION['id']) and !estReferendumFavori($_SESSION['id'], $ref['id']))
		{
			?>
			<p>
			<button class="btn btn-primary" id="addFavoriRef">Suivre le référendum</button> 
			</p>
			<?php
		}
		?>
	</div>
	</form>
		<?php
		//echo $ref['id'];
		if($statut and $enCours)
		{
			?>
			<form method="post" action=<?php echo 'index.php?module=vote&amp;action=voter&amp;idRef='.$ref['id'] ; ?> >
				<input type="submit" value="Voter" class="btn btn-primary"/>
			</form>
			
			<?php
		}
		if($now>$ref['dateFin'])
		{
			//on peut mettre les résultats, si c'est visible ou si c'est un membre votant
			if($statut or $ref['visible']==1)
			{
				?>
				<form method="post" action=<?php echo 'index.php?module=vote&amp;action=resultat&amp;idRef='.$ref['id'] ; ?> >
					<input type="submit" value="Résultats" class="btn btn-primary"/>
				</form>
				<?php
			}

		}
		?>

	
</div>



<script type="text/javascript" src=<?php echo CHEMIN_JS.'addReferendumFavori.js' ; ?> ></script>