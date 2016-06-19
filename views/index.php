	<?php
	session_start();
	include_once('../php/default.php');
	$un = recupFournisseur(1);
	$deux = recupFournisseur(2);
	$trois = recupFournisseur(3);
	$quatre = recupFournisseur(4);
	$cinq = recupFournisseur(5);
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
		<link rel="stylesheet" type="text/css" href="../css/fotorama.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
		<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
		<script type="text/javascript" src="../slick/slick.min.js"></script>
		<script type="text/javascript" src="../js/fotorama.js"></script>

	</head>
	<body>
	<?php

	include_once("header.php");

	?>

	<div class="ui page grid" style="padding-left: 0px;padding-right: 0px;height:100%;">
			<div class="row" style="padding : 0px;">
			<?php
				//Partie normale
				echo '<div class="cinquo left column" style="background-image: url("'.$un['principal']['logo'].'");">
					<div class="paragraphe">
						<div class="ui huge header align">'.$un['principal']["nom"].'</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">
							';

				foreach ($un['secondaires'] as $fournisseur) {
					echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'"></a><br><br>';	
				}
				echo'</p>
					</div>
				</div>';


				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($un['secondaires'] as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';


				//Modal Gallerie
				echo '<div class="ui modal un">
						<i class="close icon"></i>
						<div class="header">
							Catalogues des fournisseurs
						</div>
						<div class="content">
							<div class="fotorama">
								';
				foreach ($un['secondaires'] as $fournisseur) {
					$temp = explode(";",$un['secondaires']['images']);
					foreach ($temp as $image) {
						echo '<img src="'.$image.'">';
					}

				}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
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

				echo '<div class="ui modal deux">
						<i class="close icon"></i>
						<div class="header">
							Modal Title
						</div>
						<div class="image content">
							<div class="image">
								An image can appear on left or an icon
							</div>
							<div class="description">
								A description can appear on the right
							</div>
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
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

				echo '<div class="ui modal trois">
						<i class="close icon"></i>
						<div class="header">
							Modal Title
						</div>
						<div class="image content">
							<div class="image">
								An image can appear on left or an icon
							</div>
							<div class="description">
								A description can appear on the right
							</div>
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
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

				echo '<div class="ui modal quatre">
						<i class="close icon"></i>
						<div class="header">
							Modal Title
						</div>
						<div class="image content">
							<div class="image">
								An image can appear on left or an icon
							</div>
							<div class="description">
								A description can appear on the right
							</div>
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
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

				echo '<div class="ui modal cinq">
						<i class="close icon"></i>
						<div class="header">
							Modal Title
						</div>
						<div class="image content">
							<div class="image">
								An image can appear on left or an icon
							</div>
							<div class="description">
								A description can appear on the right
							</div>
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
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
		$('.ui.modal.un').modal();
		$('.ui.modal.deux').modal();
		$('.ui.modal.trois').modal();
		$('.ui.modal.quatre').modal();
		$('.ui.modal.cinq').modal();
	});
	</script>

	<?php

	include_once("footer.php");

	?>
	</body>
	</html>
