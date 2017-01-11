<div class="ui grid">
	<div class="computer tablet only row" style="font-family:'Swiss LT'!important;">
		<div class="ui fixed menu navbar page grid cut-marge menu_click" style="font-family:'Swiss LT'!important;">
			<div class="left" style="padding:0px 0px 0px 0px;width:108px;height:70px;">
				<a href="index.php" style="width:70px;height:auto;"><img src="../logos/logo iode.jpeg" class="logo"></a>
			</div>
			<?php 
			if(isset($logo_header)){
				if(!empty($logo_header)){
					echo '<div class="left " style="padding:0px 0px 0px 0px;width:150px;margin-left:30px!important;margin:auto;display:flex;">
							<img src="'.$logo_header.'" class="logo_fournisseur" style="width:auto!important;height:auto!important;max-height:75px!important;margin:auto;">
						</div>';
				}
			}

			?>
			
			<div class="right menu">
				<div class="index div_menu" style="text-align:center;display: flex;">
					<a href="index.php" style="margin:auto;font-size:15px;">Accueil</a>
				</div>
				<div class="references div_menu" style="text-align:center;display: flex;">
					<a href="references.php" style="margin:auto;font-size:15px;">Références</a>
				</div>
				<div  class="telechargements div_menu" style="text-align:center;display: flex;">
					<a href="telechargements.php" style="margin:auto;font-size:15px;">Téléchargement</a>
				</div>
				<div class="contact div_menu" style="text-align:center;display: flex;">
					<a href="contact.php" style="margin:auto;font-size:15px;" >Contact</a>
				</div>
				<div class="equipe div_menu" style="text-align:center;display: flex;">
					<a href="equipe.php" style="margin:auto;font-size:15px;" >A propos de nous</a>
				</div>
				<div class="div_menu" style="text-align:center;display: flex;">
					<a href="news.xml" style="margin:auto"><img src="../img/rss.jpg" style="width:50px;height:50px;"></a>
				</div>
				<!--<span style="text-align:center;display: flex; width:150px!important;">
					<a href="https://facebook.com" style="margin:auto" target="_blank"><i class="big facebook square icon" style="margin:auto"></i></a>
					<a href="https://twitter.com" style="margin:auto" target="_blank"><i class="big twitter square icon" style="margin:auto"></i></a>
				</span>-->
				
				
				
				
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
		<div class="ui fixed menu navbar page grid cut-marge menu_click" style="font-family:'Swiss LT'!important;">
			<a href="index.php" class="brand item">Agence Iode</a>
			
			<div class="right menu open">
				<a href="" class="menu item">
                    <i class="content icon"></i>
              	</a>
         	</div>
        </div>
         <div class="ui vertical navbar menu" style="z-index:999;">
				<a class="item" href="index.php" style="margin:auto">Accueil</a>
				<a class="item" href="references.php" style="margin:auto">Références</a>
				<a class="item" href="telechargements.php" style="margin:auto">Téléchargement</a>
				<a class="item" href="contact.php" style="margin:auto" >Contact</a>
				<a class="item" href="equipe.php" style="margin:auto" >A propos de nous</a>
				<a class="item" href="news.xml" style="margin:auto"><img src="../img/rss.jpg" style="width:50px;height:auto;"></a>
		</div>
	</div>
</div>