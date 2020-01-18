<!--formulaire de création de référendum-->

<h2>Création d'un référendum sur les membres de <?php echo $groupe['nom']; ?> </h2>
<form method="post" action=<?php echo"index.php?module=ref&action=creerRefDepuisGroupeValidation&idGroupe=".$idGroupe; ?> >
	<div class='form-group'>
		<label for="nom">Titre:</label>
		<input type="text" name="nom" class="form-control"/><br/>

		<label for="explication">Texte explicatif:</label>
		<textarea name="explication" class="form-control"></textarea><br/>

		<label for="question">Question (réponse par oui ou non):</label>
		<textarea name="question" class="form-control"></textarea><br/>
	</div>


	<div class='form-group'>
		<label for="dateDebut">Date de début de vote</label>
		<input type="date" name="dateDebut" class="form-control"/><br/>

		<label for="dateFin">Date de fin de vote:</label>
		<input type="date" name="dateFin" class="form-control" /><br/>
	</div>


	<div class='form-group'>
		<label for="visible">Visible par des non-votants:</label>
		<select name="visible" class="form-control">
			<option value="1">Vrai</option>
			<option value="0">Faux</option>
		</select><br/>
	
		<label for="categorie">Catégorie:</label>
		<select name="categorie" id="categorie" class="form-control">
			<!--script js fournit les options-->
		</select><br/>
	</div>


	<input type="submit" value="Créer" class="btn btn-primary"/>

</form>


<script type="text/javascript" src=<?php echo CHEMIN_JS."categories.js"; ?> ></script>