<h3>Modifier les données personnelles</h3>

<div class="container">
	<div class="container col-sm-6">

		<form method="post" action="index.php?module=user&amp;action=modifierDonneesValidation">
			
			<div class="form-group">
				<label for="prenom">Prénom</label><br/>
				<input type="text" name="prenom" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" /><br/>

				<label for="nom">Nom</label><br/>
				<input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($user['prename']); ?>" /><br/>
			</div>

			<div class="form-group">
				<small id="emailHelp" class="form-text text-muted">We do not share your personal information with anyone: it allows us to check your identity, and therefore prevent security flaws.</small>

				<p id="mailComment"></p>

				<label for="mail">Mail</label><br/>
				<input type="email" name="mail" id="mail" onchange="request(appliquerNbMails)"  class="form-control" value="<?php echo htmlspecialchars($user['mail']); ?>" /><br/>

				<label for="codePostal">Code postal:</label><br/>
				<input type="number" name="codePostal" id="codePostal"  class="form-control" value="<?php echo htmlspecialchars($user['code_postal']); ?>" /><br/>

				

				<label for="dateNaissance">Date de naissance</label><br/>
				<input type="date" name="dateNaissance"  class="form-control" value="<?php echo (new Datetime(htmlspecialchars($user['dateNaissance'])))->format('Y-m-d'); ?>" /><br/>
			</div>




			<input type="submit" id="submit" value="Mettre à jour le profil" class="btn btn-primary"><br/>

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