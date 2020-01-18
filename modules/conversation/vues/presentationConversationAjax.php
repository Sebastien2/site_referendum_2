<?php

foreach($messages as $message)
{
	?>
	<li><?php echo $message['name']." ".$message['prename'] ; ?>: <?php echo $message['commentaire'] ; ?>, <?php echo $message['dateCreation'] ; ?></li>
	<?php
}
?>