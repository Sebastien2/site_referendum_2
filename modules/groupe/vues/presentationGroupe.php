<!--INUTILE-->

<h2>Groupe: <?php echo $groupe['nom']; ?> </h2>

<p>
	Description: <?php echo $groupe['descriptif']; ?>
	<br/>
	Date de création: <?php echo $groupe['dateCreation']; ?>
</p>

<?php
if($statut>=2)
{
	?>
	<a href=<?php echo "index.php?module=groupe&amp;action=descriptifMembres&amp;idGroupe=".$groupe['id'] ; ?> >Liste des membres du groupes</a>
	<?php
}

