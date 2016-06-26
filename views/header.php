<div class="ui grid" style="height: 54px;">
	<div class="computer tablet only row">
	<div class="ui fixed menu navbar page grid cut-marge">
		<div class="left item">
			<a href="index.php"><img src="../logos/logo iode.jpeg" class="logo"></a>
		</div>
		<div class="right menu">
			<a href="index.php" class="item index">Accueil</a>
			<a href="references.php" class="item references">Références</a>
			<a href="telechargements.php" class="item telechargements">Téléchargement</a>
			<a href="contact.php" class="item contact">Contact</a>
			<a href="equipe.php" class="item equipe">A propos de nous</a>
			<a href="news.xml" class="item"><img src="../img/rss.jpg" style="width:50px;height:50px;"></a>
			<?php
			if(!empty($_SESSION['authentifie'])){
				echo'<div class="ui form flex-centered">
							<form method="post" action="admin.php">
								<div class="field">
								<input type="hidden" value="true" name="logout" id="logout">
									<input type="submit" value="Se deconnecter" class="ui button large fluid red">
								</div>
							</form>
						</div>';
			}

			?>
		</div>
	</div>
	</div>
	<div class="mobile only row">
		<div class="ui fixed navbar menu">
			<a href="" class="brand item">Project Name</a>
			<div class="right menu open">
				<a href="" class="menu item">
					<i class="content icon"></i>
				</a>
			</div>
		</div>
		<div class="ui vertical navbar menu">
			<a href="index.php" class="item index" style="margin-top: 40px;">Accueil</a>
			<a href="equipe.php" class="item equipe">A propos de nous</a>
			<a href="contact.php" class="item contact">Contact</a>
			<div class="menu">
				<a href="" class="item">Default</a>
				<a href="" class="item">Static top</a>
				<a href="" class="item">Fixed top</a>
			</div>
		</div>
	</div>
</div>