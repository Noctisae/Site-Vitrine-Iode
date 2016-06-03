	<?php
	session_start();
	include_once('../php/default.php');
	$un = recupFournisseurUn();
	$deux = recupFournisseurDeux();
	$trois = recupFournisseurTrois();
	$quatre = recupFournisseurQuatre();
	$cinq = recupFournisseurCinq();
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<!-- Standard Meta -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

		<!-- Site Properties -->
		<title>Agence Iode</title>
		<link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../slick/slick.css">
		<link rel="stylesheet" type="text/css" href="../slick/slick-theme.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
		<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
		<script type="text/javascript" src="../slick/slick.min.js"></script>

	</head>
	<body>
	<?php

	include_once("header.php");

	?>

	<div class="ui page grid" style="padding-left: 0px;padding-right: 0px;height:100%;">
			<div class="row" style="padding : 0px;">
			<?php
			foreach ($un as $fournisseur) {
				echo '<div class="cinquo left column" style="background-image: url("'.$fournisseur['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$fournisseur["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($fournisseur['secondaire'] as $secondaire) {
					echo'<a href="'.$secondaire["url"].'"><img src="'.$secondaire["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';
			}

			foreach ($deux as $fournisseur) {
				echo '<div class="cinquo left column" style="background-image: url("'.$fournisseur['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$fournisseur["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($fournisseur['secondaire'] as $secondaire) {
					echo'<a href="'.$secondaire["url"].'"><img src="'.$secondaire["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';
			}

			foreach ($trois as $fournisseur) {
				echo '<div class="cinquo left column" style="background-image: url("'.$fournisseur['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$fournisseur["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($fournisseur['secondaire'] as $secondaire) {
					echo'<a href="'.$secondaire["url"].'"><img src="'.$secondaire["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';
			}


			foreach ($quatre as $fournisseur) {
				echo '<div class="cinquo left column" style="background-image: url("'.$fournisseur['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$fournisseur["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($fournisseur['secondaire'] as $secondaire) {
					echo'<a href="'.$secondaire["url"].'"><img src="'.$secondaire["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';
			}


			foreach ($cinq as $fournisseur) {
				echo '<div class="cinquo left column" style="background-image: url("'.$fournisseur['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$fournisseur["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($fournisseur['secondaire'] as $secondaire) {
					echo'<a href="'.$secondaire["url"].'"><img src="'.$secondaire["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';
			}

			?>
			</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		$('.right.menu.open').on("click",function(e){
		e.preventDefault();
		$('.ui.vertical.menu').toggle();
		});
		
		$('.ui.dropdown').dropdown();
	});
	</script>

	<?php

	include_once("footer.php");

	?>
	</body>
	</html>
