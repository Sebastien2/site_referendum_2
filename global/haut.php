<!DOCTYPE html>
<html>
<head>

	<title>Rufus</title>
	<meta charset='utf-8'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>

	<div class="navbar navbar-inverse navbar-default">  <!-- navbar-fixed-top-->
		<div>
			<div class="navbar-header">
				
				<a href="index.php?module=listes&amp;action=accueil" class="navbar-brand">Rufus</a>

				<button id="commandSmallScreen" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>

				</button>
				
			</div>
			<div class="container-fluid">
				<div class="navbar-collapse collapse" id="menu">
					<ul class="nav navbar-nav">
						<!--<li><a href="index.php?module=listes&amp;action=accueil">Accueil</a></li>-->
						<li><a href="index.php?module=user&amp;action=inscription">Inscription</a></li>
						<?php
						if(!empty($_SESSION['id']))
						{
							?>
							<li><a href="index.php?module=user&amp;action=deconnexion">Déconnexion</a></li>
							<?php
						}
						else
						{
							?>
							<li><a href="index.php?module=user&amp;action=connexion">Connexion</a></li>
							<?php
						}
						?>
						
						<li><a href="index.php?module=groupe&amp;action=creerGroupe">Créer un groupe</a></li>
						<li><a href="index.php?module=listes&amp;action=listeGroupes">Liste des groupes</a></li>
						<li><a href="index.php?module=listes&amp;action=listeRefs">Liste de référendums</a></li>
						<!--
						<?php
						if(empty($_SESSION['id']))
						{
						?>
						<li class="navbar-form">
							<form method="post" action="index.php?module=user&amp;action=connexionValidation" class="form-inline">
								<div class='form-group row'>
									<input type="email" name="mail" id="mail2" class='form-control' placeholder="mail">

									<input type="password" name="mdp" id="mdp2" class='form-control' placeholder="password">
									
									<input type="submit" value="connexion" class="btn btn-primary">
								</div>
							</form>

						</li>
						<?php
						}
						?>
						-->
					</ul>

					<div class="navbar-form navbar-right">
						<form method="post" action="index.php?module=research&amp;action=search">
							<input type="text" name="search" class="form-control" placeholder="Search">
							<button class="btn btn-default" type="submit">
						        <i class="glyphicon glyphicon-search"></i>
						    </button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<script type="text/javascript" src="global/js/menuExtend.js"></script>

	<div class="container-fluid">
		<div class="row">
			<div class="container col-md-2">

				<?php
				
				include("modules/leftColumn/controleur/classique.php");
				?>

			</div>


			<div class="container col-md-10">

	