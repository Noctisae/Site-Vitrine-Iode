<div class="ui grid" style="height: 115px;">
	<div class="computer tablet only row" style="font-family:'Swiss LT'!important;">
		<div class="ui fixed menu navbar page grid cut-marge" style="font-family:'Swiss LT'!important;">
			<div class="left item" style="padding:0px 0px 0px 0px;width:108px;height:100px;">
				<a href="index.php" style="width:108px;height:100px;"><img src="../logos/logo iode.jpeg" class="logo"></a>
			</div>
			<div class="right menu">
				<div class="item index" style="text-align:center;">
					<a href="index.php" style="margin:auto">Accueil</a>
				</div>
				<div class="item references" style="text-align:center;">
					<a href="references.php" style="margin:auto">Références</a>
				</div>
				<div  class="item telechargements" style="text-align:center;">
					<a href="telechargements.php" style="margin:auto">Téléchargement</a>
				</div>
				<div class="item contact" style="text-align:center;">
					<a href="contact.php" style="margin:auto" >Contact</a>
				</div>
				<div class="item equipe" style="text-align:center;">
					<a href="equipe.php" style="margin:auto" >A propos de nous</a>
				</div>
				<div class="item" style="text-align:center;">
					<a href="news.xml" style="margin:auto"><img src="../img/rss.jpg" style="width:50px;height:50px;"></a>
				</div>
				
				
				
				
				
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
	<div class="mobile only row" style="font-family:'Swiss LT'!important;">
		<div class="ui fixed navbar menu" style="font-family:'Swiss LT'!important;">
			<a href="index.php" style="width:108px;height:100px;"><img src="../logos/logo iode.jpeg" class="logo"></a>
						<div class="right menu">
				<div class="item index" style="text-align:center;">
					<a href="index.php" style="margin:auto">Accueil</a>
				</div>
				<div class="item references" style="text-align:center;">
					<a href="references.php" style="margin:auto">Références</a>
				</div>
				<div  class="item telechargements" style="text-align:center;">
					<a href="telechargements.php" style="margin:auto">Téléchargement</a>
				</div>
				<div class="item contact" style="text-align:center;">
					<a href="contact.php" style="margin:auto" >Contact</a>
				</div>
				<div class="item equipe" style="text-align:center;">
					<a href="equipe.php" style="margin:auto" >A propos de nous</a>
				</div>
				<div class="item" style="text-align:center;">
					<a href="news.xml" style="margin:auto"><img src="../img/rss.jpg" style="width:50px;height:50px;"></a>
				</div>
				
				
				
				
				
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
		<div class="ui vertical navbar menu" style="font-family:'Swiss LT'!important;">
			<a href="index.php" style="margin:auto">Accueil</a>
			<a href="references.php" style="margin:auto">Références</a>
			<a href="telechargements.php" style="margin:auto">Téléchargement</a>
			<a href="contact.php" style="margin:auto" >Contact</a>
			<a href="equipe.php" style="margin:auto" >A propos de nous</a>
			<a href="news.xml" style="margin:auto"><img src="../img/rss.jpg" style="width:50px;height:50px;"></a>
		</div>
	</div>
</div>