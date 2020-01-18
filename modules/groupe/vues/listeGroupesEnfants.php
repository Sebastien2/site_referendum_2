<!--on préente la liste des groupes sous forme de liens-->
<ul>
<?php
foreach($sousGroupes as $sg)
{
	?>
	<li><a href=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$sg['id'] ; ?> ><?php echo $sg['nom'] ; ?></a></li>
	<?php
}


?>
</ul>