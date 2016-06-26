	<?php
	session_start();
	include_once('../php/default.php');
	$un = recupFournisseur(1);
	$deux = recupFournisseur(2);
	$trois = recupFournisseur(3);
	$quatre = recupFournisseur(4);
	$cinq = recupFournisseur(5);

	$logo1 = explode(";",$un[0]['images'])[0];
	$logo2 = explode(";",$deux[0]['images'])[0];
	$logo3 = explode(";",$trois[0]['images'])[0];
	$logo4 = explode(";",$quatre[0]['images'])[0];
	$logo5 = explode(";",$cinq[0]['images'])[0];
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
		<link rel="stylesheet" type="text/css" href="../css/fotorama.css">

	</head>
	<body>
	<?php

	include_once("header.php");

	?>

	<div class="ui page grid total" style="padding-left: 0px;padding-right: 0px;height:100%;width:100%">
			<div class="row" style="padding : 0px;">
			<?php
				
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////   	Premiere partie  	////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
				echo '<div class="cinquo left column" style="background-image: url('.$logo1.');">';

				//Partie normale
				echo'
					<div class="paragraphe">
						<br>				
						<p class="align">
							';
						foreach ($un as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($un as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';

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
								foreach ($un as $fournisseur) {
									$temp = explode(";",$fournisseur['images']);
									foreach ($temp as $image) {
										echo '<img src="'.$image.'" style="width:100%;">';
									}

								}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
						</div>
					</div>';


			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////	Deuxieme Partie 	////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
				echo '<div class="cinquo left column" style="background-image: url('.$logo2.');">';

				//Partie normale
				echo'
					<div class="paragraphe">
						<br>				
						<p class="align">
							';
						foreach ($deux as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($deux as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';

				echo'</div>';





				//Modal Gallerie
				echo '<div class="ui modal deux">
						<i class="close icon"></i>
						<div class="header">
							Catalogues des fournisseurs
						</div>
						<div class="content">
							<div class="fotorama">
								';
								foreach ($deux as $fournisseur) {
									$temp = explode(";",$fournisseur['images']);
									foreach ($temp as $image) {
										echo '<img src="'.$image.'" style="width:100%;">';
									}

								}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
						</div>
					</div>';
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////	Troisieme Partie 	////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
				echo '<div class="cinquo left column" style="background-image: url('.$logo3.');">';

				//Partie normale
				echo'
					<div class="paragraphe">
						<br>				
						<p class="align">
							';
						foreach ($trois as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($trois as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';

				echo'</div>';





				//Modal Gallerie
				echo '<div class="ui modal trois">
						<i class="close icon"></i>
						<div class="header">
							Catalogues des fournisseurs
						</div>
						<div class="content">
							<div class="fotorama">
								';
								foreach ($trois as $fournisseur) {
									$temp = explode(";",$fournisseur['images']);
									foreach ($temp as $image) {
										echo '<img src="'.$image.'" style="width:100%;">';
									}

								}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
						</div>
					</div>';
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////	Quatrieme Partie 	////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
				echo '<div class="cinquo left column" style="background-image: url('.$logo4.');">';

				//Partie normale
				echo'
					<div class="paragraphe">
						<br>				
						<p class="align">
							';
						foreach ($quatre as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($quatre as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';

				echo'</div>';





				//Modal Gallerie
				echo '<div class="ui modal quatre">
						<i class="close icon"></i>
						<div class="header">
							Catalogues des fournisseurs
						</div>
						<div class="content">
							<div class="fotorama">
								';
								foreach ($quatre as $fournisseur) {
									$temp = explode(";",$fournisseur['images']);
									foreach ($temp as $image) {
										echo '<img src="'.$image.'" style="width:100%;">';
									}

								}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
						</div>
					</div>';
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////	Cinquième Partie 	////////////////////////
			////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
				echo '<div class="cinquo left column" style="background-image: url('.$logo5.');">';

				//Partie normale
				echo'
					<div class="paragraphe">
						<br>				
						<p class="align">
							';
						foreach ($cinq as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content">

				';

				foreach ($cinq as $fournisseur) {
					echo'<a href="'.$fournisseur["catalogue"].'">Télécharger le catalogue de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Télécharger le catalogue des tarifs de '.$fournisseur["nom"].'<i class="file text icon"></i></a><br><br>';
				}

				echo'</div>';

				echo'</div>';





				//Modal Gallerie
				echo '<div class="ui modal cinq">
						<i class="close icon"></i>
						<div class="header">
							Catalogues des fournisseurs
						</div>
						<div class="content">
							<div class="fotorama">
								';
								foreach ($cinq as $fournisseur) {
									$temp = explode(";",$fournisseur['images']);
									foreach ($temp as $image) {
										echo '<img src="'.$image.'" style="width:100%;">';
									}

								}
				echo'</div>	
						</div>
						<div class="actions">
							<div class="ui button">Cancel</div>
							<div class="ui button">OK</div>
						</div>
					</div>';

			?>
			</div>


	</div>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../js/fotorama.js"></script>
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
