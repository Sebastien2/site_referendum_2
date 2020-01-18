<h3>Création d'un nouveau fil de discussion  <small class="text-muted"><?php echo $groupe['nom'] ; ?></small></h3>

<form method="post" action=<?php echo "index.php?module=conversation&amp;action=creerConversationValidation&amp;idGroupe=".$idGroupe ; ?> >
	<label for="titre">Nom de la discussion</label>
	<input type="text" name="titre" class="form-control"><br>
	<input type="submit" value="Créer" class="btn btn-primary">
</form>