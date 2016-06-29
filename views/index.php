	<?php
	session_start();
	include_once('../php/default.php');
	$un = recupFournisseur(1);
	$deux = recupFournisseur(2);
	$trois = recupFournisseur(3);
	$quatre = recupFournisseur(4);
	$cinq = recupFournisseur(5);

	$logo1 = explode(";",$un[0]['images'])[0];
	error_log($logo1);
	$logo2 = explode(";",$deux[0]['images'])[0];
	$logo3 = explode(";",$trois[0]['images'])[0];
	$logo4 = explode(";",$quatre[0]['images'])[0];
	$logo5 = explode(";",$cinq[0]['images'])[0];
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<!-- Standard Meta -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
				echo '<div class="cinquo cinquo1 left column" style="background-image: url(\''.$logo1.'\');-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;width:20%">';

				//Partie normale
				echo'
					<div class="paragraphe" id="paragraphe1">
						<br>				
						<p class="align">
							';
						foreach ($un as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content" id="hovered_content1" style="margin-top:0px">
					<div class="alignement">
					<h3 class="ui header">Les catalogues</h3>
				';

				foreach ($un as $fournisseur) {
					echo'

						<h4 class="ui header">'.strtoupper($fournisseur["nom"]).'</h4>
						<a href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="big file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Catalogue des tarifs<br><i class=" big file text icon"></i></a><br><br>';
				}

				echo'</div></div>';

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
				echo '<div class="cinquo cinquo2 left column" style="background-image: url(\''.$logo2.'\');-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;width:20%">';

				//Partie normale
				echo'
					<div class="paragraphe" id="paragraphe2">
						<br>				
						<p class="align">
							';
						foreach ($deux as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content" id="hovered_content2" style="margin-top:0px">
					<div class="alignement">
					<br>
					<br>
					<h3 class="ui header">Les catalogues</h3>
				';

				foreach ($deux as $fournisseur) {
					echo'

						<h4 class="ui header">'.strtoupper($fournisseur["nom"]).'</h4>
						<a href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="big file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Catalogue des tarifs<br><i class=" big file text icon"></i></a><br><br>';
				}

				echo'</div></div>';

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
				echo '<div class="cinquo cinquo3 left column" style="background-image: url(\''.$logo3.'\');-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;width:20%">';

				//Partie normale
				echo'
					<div class="paragraphe" id="paragraphe3">
						<br>				
						<p class="align">
							';
						foreach ($trois as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content" id="hovered_content3" style="margin-top:0px">
					<div class="alignement">
					<br>
					<br>
					<h3 class="ui header">Les catalogues</h3>
				';

				foreach ($trois as $fournisseur) {
					echo'

						<h4 class="ui header">'.strtoupper($fournisseur["nom"]).'</h4>
						<a href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="big file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Catalogue des tarifs<br><i class=" big file text icon"></i></a><br><br>';
				}

				echo'</div></div>';

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
				echo '<div class="cinquo cinquo4 left column" style="background-image: url(\''.$logo4.'\');-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;width:20%">';

				//Partie normale
				echo'
					<div class="paragraphe" id="paragraphe4">
						<br>				
						<p class="align">
							';
						foreach ($quatre as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content" id="hovered_content4" style="margin-top:0px">
					<div class="alignement">
					<br>
					<br>
					<h3 class="ui header">Les catalogues</h3>
				';

				foreach ($quatre as $fournisseur) {
					echo'

						<h4 class="ui header">'.strtoupper($fournisseur["nom"]).'</h4>
						<a href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="big file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Catalogue des tarifs<br><i class=" big file text icon"></i></a><br><br>';
				}

				echo'</div></div>';

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
				echo '<div class="cinquo cinquo5 left column" style="background-image: url(\''.$logo5.'\');-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
background-position:center;width:20%">';

				//Partie normale
				echo'
					<div class="paragraphe" id="paragraphe5">
						<br>				
						<p class="align">
							';
						foreach ($cinq as $fournisseur) {
							echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
						}
				echo'	</p>
					</div>';
				
				//partie Hover
				echo'<div class="hovered_content" id="hovered_content5" style="margin-top:0px">
					<div class="alignement">
					<br>
					<br>
					<h3 class="ui header">Les catalogues</h3>
				';

				foreach ($cinq as $fournisseur) {
					echo'

						<h4 class="ui header">'.strtoupper($fournisseur["nom"]).'</h4>
						<a href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="big file text icon"></i></a><br><br>';
					echo'<a href="'.$fournisseur["catalogue_tarifs"].'">Catalogue des tarifs<br><i class=" big file text icon"></i></a><br><br>';
				}

				echo'</div></div>';

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

		var returnToNormal = function(){
		$(".cinquo1").css("width","20%");
		$(".cinquo2").css("width","20%");
		$(".cinquo3").css("width","20%");
		$(".cinquo4").css("width","20%");
		$(".cinquo5").css("width","20%");
		$("#hovered_content1").css("display","none");
		$("#paragraphe1").css("display","block");
		$("#hovered_content2").css("display","none");
		$("#paragraphe2").css("display","block");
		$("#hovered_content3").css("display","none");
		$("#paragraphe3").css("display","block");
		$("#hovered_content4").css("display","none");
		$("#paragraphe4").css("display","block");
		$("#hovered_content5").css("display","none");
		$("#paragraphe5").css("display","block");
	}

	$(".cinquo1").hover(function(){
		$(".cinquo1").css("width","100%");
		$("#hovered_content1").css("display","block");
		$("#hovered_content1").css("width","20%");
		$("#hovered_content1").css("height","100%");
		$("#hovered_content1").css("text-align","center");
		$("#hovered_content1").css("color","white");
		$("#paragraphe1").css("display","none");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$(".cinquo2").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","100%");
		$("#hovered_content2").css("display","block");
		$("#hovered_content2").css("width","20%");
		$("#hovered_content2").css("height","100%");
		$("#hovered_content2").css("text-align","center");
		$("#hovered_content2").css("color","white");
		$("#paragraphe2").css("display","none");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$(".cinquo3").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","100%");
		$("#hovered_content3").css("display","block");
		$("#hovered_content3").css("width","20%");
		$("#hovered_content3").css("height","100%");
		$("#hovered_content3").css("text-align","center");
		$("#hovered_content3").css("color","white");
		$("#paragraphe3").css("display","none");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$(".cinquo4").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","100%");
		$("#hovered_content4").css("display","block");
		$("#hovered_content4").css("width","20%");
		$("#hovered_content4").css("height","100%");
		$("#hovered_content4").css("text-align","center");
		$("#hovered_content4").css("color","white");
		$("#paragraphe4").css("display","none");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$(".cinquo5").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","100%");
		$("#hovered_content5").css("display","block");
		$("#hovered_content5").css("width","20%");
		$("#hovered_content5").css("height","100%");
		$("#hovered_content5").css("text-align","center");
		$("#hovered_content5").css("color","white");
		$("#paragraphe5").css("display","none");
	},returnToNormal);
	</script>

	<?php

	include_once("footer.php");

	?>
	</body>
	</html>
