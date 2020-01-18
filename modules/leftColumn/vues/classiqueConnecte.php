<!--on met un lien vers mon profil, mes groupes, les derniers referendums où je peux voter par catégorie-->

<nav >
	<div ><!--class="container-fluid"-->
		<div class="list-group"><!--class="collapse navbar-collapse"-->
			
			<a href='index.php?module=user&amp;action=monCompte' class="list-group-item">Mon compte: <?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ; ?></a>

			<a href="index.php?module=listes&amp;action=mesGroupes" class="list-group-item">Mes groupes</a>
			
			<div id="choixDev">
				<div class="list-group-item">
					
						Générer les référendums
						<span class="caret"></span>
					
				</div>
			</div>

			<a href="index.php?module=listes&amp;action=referendumsFavoris" class="list-group-item">Referendums suivis</a>
			
		</div>
	</div>
</nav>




<script type="text/javascript" src="modules/leftColumn/js/classiqueConnecte.js"></script>