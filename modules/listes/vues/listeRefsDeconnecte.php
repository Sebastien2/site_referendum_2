<!--formulaire de sélection en haut-->
<div>
	<h3>Sélection de référendums</h3>
	<form method="post" action="index.php?module=listes&amp;action=listeRefs" id="formulaire">
		<div class="col-md-6">
			<div  class="form-group">
				<label for="categorie">Catégorie</label><br>
				
				<input type="radio" name="categorie" value="tous" checked>Toutes les catégories<br>
				<input type="radio" name="categorie" value="restreint">Choisir des catégories<br>
				
				<div id="categories">
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div  class="form-group">
				<label for="dateDebut">Date minimale d'ouverture des votes</label>
				<input type="date" name="dateDebut" id="dateDebut" class="form-control"/><br>

				<label for="dateFin">Date maximale d'ouverture des votes</label>
				<input type="date" name="dateFin" id="dateFin" class="form-control"/><br>
			</div>
			<div  class="form-group">
				<div class="checkbox">
					<label for="periodeVote"><strong>Etat du référendum</strong></label><br>
					<input type="radio" name="periodeVote" value="tous" checked>Tous<br>
					<input type="radio" name="periodeVote" value="nonOuverte">Période de vote non ouverte<br>
					<input type="radio" name="periodeVote" value="enCours">Période de vote en cours<br>
					<input type="radio" name="periodeVote" value="close">Période de vote close<br>
				</div>
			</div>
		</div>

		<!--<input type="submit" value="Lister">-->

	</form>
		
</div>


<p id="liste" class="col-md-12">

</p>



<script type="text/javascript" src=<?php echo CHEMIN_JS.'listeRefsDeconnecte.js'; ?> ></script>