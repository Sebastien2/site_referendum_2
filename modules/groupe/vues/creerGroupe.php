<h2>Création de groupe</h2>

<form method="post" action="index.php?module=groupe&amp;action=creerGroupeValidation">
	<div class='form-group'>

		<label for='nom'>Nom du groupe:</label>
		<input type='text' name='nom' id='nom' class="form-control"/><br/>

		<label for='descriptif'>Description:</label>
		<textarea name='descriptif' id='descriptif' class="form-control" rows="4"></textarea>

	</div>
	<div class="">
		<input type="submit" value="Créer" class="btn btn-primary"/>
	</div>
</form>