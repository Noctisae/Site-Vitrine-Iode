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
			<a href="" class="brand item">Project Name</a>
			<div class="right menu open">
				<a href="" class="menu item">
					<i class="content icon"></i>
				</a>
			</div>
		</div>
		<div class="ui vertical navbar menu" style="font-family:'Swiss LT'!important;">
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