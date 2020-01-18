<!--on met toute la conversation-->
<h3><?php echo $conversation['titre'] ; ?>  <small class='text-muted'><?php echo $groupe['nom'] ; ?></small></h3>
<ul id="liste" class="list-group">
<?php

foreach($messages as $message)
{
	?>
	<li name="<?php echo $message['id'] ; ?>"  class="list-group-item">
		<strong><?php echo $message['name']." ".$message['prename'] ; ?></strong><br>
		<?php echo $message['commentaire'] ; ?><br>
		<small class="text-muted"> <?php echo $message['dateCreation'] ; ?></small>
	</li>
	<?php
}




?>
</ul>
<!--puis on met un formulaire relié à du js pour ajouter des messages-->


<form method="post" action="" id="posterComm">
	<label for="ajoutComm">Nouveau commentaire</label>
	<textarea name="ajoutComm" id="ajoutComm" class='form-control'></textarea>
</form>
<br>
<button id="Poster" class="btn btn-primary">Poster</button>


<script type="text/javascript" src="<?php echo CHEMIN_JS."presentationConversation.js" ; ?>" ></script>