
<ul>
<?php
foreach($surGroupes as $sg)
{
	?>
	<li><a href=<?php echo "index.php?module=groupe&amp;action=presentation&amp;idGroupe=".$sg['id'] ; ?> ><?php echo $sg['nom'] ; ?></a></li>
	<?php
}


?>
</ul>