<!--formulaire de sélection en haut-->
<div>

	<form method="post" action="index.php?module=listes&amp;action=listeRefs" id="formulaire">
		<div class="col-md-6">
			<div  class="form-group">
				<label for="categorie">Catégorie</label><br>
				<div class="checkbox">
					<input type="radio" name="categorie" value="tous"" checked>Toutes les catégories<br>
					<input type="radio" name="categorie" value="restreint">Choisir des catégories<br>
				</div>
				<div id="categories">

				</div>
			</div>

			<div  class="form-group">
				<label for="dateDebut">Date minimale d'ouverture des votes</label>
				<input type="date" name="dateDebut" id="dateDebut" class="form-control"/><br>

				<label for="dateFin">Date maximale d'ouverture des votes</label>
				<input type="date" name="dateFin" id="dateFin" class="form-control"/><br>
			</div>
		</div>


		<div class="col-md-6">

			<div  class="form-group">
				<div class="checkbox">
					<label for="droitDeVote"><strong>Restriction sur les droits d'accès</strong></label><br>
					<input type="radio" name="droitDeVote" value="tousVisible" checked>Tous les referendums<br>
					<input type="radio" name="droitDeVote" value="droitVote">Referendums avec droits de vote<br>
				</div>
			</div>

			<div  class="form-group">
				<div class="checkbox">
					<label for="historique"><strong>Restriction sur mes votes</strong></label><br>
					<input type="radio" name="historique" value="tous" checked>Tous<br>
					<input type="radio" name="historique" value="dejaVote">Où j'ai déjà voté<br>
					<input type="radio" name="historique" valeu="pasEncoreVote">Où je n'ai pas encore voté<br>
				</div>
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



<script type="text/javascript" src=<?php echo CHEMIN_JS.'listeRefsConnecte.js'; ?> ></script>