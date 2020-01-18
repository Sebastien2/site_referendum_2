<h2>Inscription</h2>

<div class="container">
	<div class="container col-sm-6">

		<form method="post" action="index.php?module=user&amp;action=inscriptionValidation">
			
			<div class="form-group">
				<label for="prenom">Prénom</label><br/>
				<input type="text" name="prenom" class="form-control"/><br/>

				<label for="nom">Nom</label><br/>
				<input type="text" name="nom" class="form-control"/><br/>
			</div>

			<div class="form-group">
				<small id="emailHelp" class="form-text text-muted">Nous ne partageons pas vos données personnelles: elle nous permettent uniquement d'effectuer des contrôle de sécurité.</small>

				<p id="mailComment"></p>

				<label for="mail">Mail</label><br/>
				<input type="email" name="mail" id="mail" onchange="request(appliquerNbMails)"  class="form-control"/><br/>

				<label for="codePostal">Code postal:</label><br/>
				<input type="number" name="codePostal" id="codePostal"  class="form-control"/><br/>

				

				<label for="dateNaissance">Date de naissance</label><br/>
				<input type="date" name="dateNaissance"  class="form-control"/><br/>
			</div>


			<div class='form-group'>
				<label for="mdp">Mot de passe</label><br/>
				<input type="password" name="mdp" class="form-control"><br/>

				<label for="mdp2">Confirmez le mot de passe</label><br/>
				<input type="password" name="mdp2" class="form-control"><br/>
			</div>

			<input type="submit" id="submit" value="Créer le profil" class="btn btn-primary"><br/>

		</form>

	</div>
</div>


<script type="text/javascript" src="modules/user/js/inscription.js"></script>
<script>

	var mailElem=document.getElementById("mail");
	var mailCommentElem=document.getElementById("mailComment");
	var validElem=document.getElementById('submit');
	var nvElem=document.createElement('p');
	document.body.appendChild(nvElem);
</script>