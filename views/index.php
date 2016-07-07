	<?php
	session_start();
	include_once('../php/default.php');

	$tous_les_fournisseurs = array(recupFournisseur(1),recupFournisseur(2),recupFournisseur(3),recupFournisseur(4),recupFournisseur(5));

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
				$i = 1;
				foreach ($tous_les_fournisseurs as $partie_de_page) {
					switch (count($partie_de_page)){
						case 1:
							$class= "seul";
							break;
						case 2:
							$class= "duo";
							break;
						case 3:
							$class= "trio";
							break;
						case 4:
							$class= "quatuor";
							break;
						default:
							$class= "quintet";
							break;
					}
					echo '<div class="cinquo cinquo'.$i.' left column" style="background-image: url(\''.explode(";",$tous_les_fournisseurs[($i-1)][0]['images'])[0].'\');-webkit-background-size:cover;
					-moz-background-size:cover;
					-o-background-size:cover;
					background-size:cover;
					background-position:center;width:20%">';

					//Partie normale
					echo'
						<div class="paragraphe paragraphe_accueil" id="paragraphe'.$i.'">
							<br>				
							<p class="align">
								';
							foreach ($partie_de_page as $fournisseur) {
								echo'<a href="'.$fournisseur["url"].'"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>';	
							}
					echo'	</p>
						</div>';

						//partie Hover
						echo'<div class="hovered_content_index" id="hovered_content'.$i.'" style="margin-top:0px">
						';

						foreach ($partie_de_page as $fournisseur) {
							echo'
								<div class="'.$class.' height_important" id="'.$fournisseur['id'].'" style="background-image:url(\''.explode(';',$fournisseur["images"])[0].'\';-webkit-background-size:cover;
					-moz-background-size:cover;
					-o-background-size:cover;
					background-size:cover;
					background-position:center;">
							<div class="paragraphe paragraphe_accueil">
									<p class="align alignement_index">
									<a href="'.$fournisseur["url"].'" style="width:100%!important;"><img src="'.$fournisseur["logo"].'" style="width:50%;height:75px;"></a><br><br>
									</p>
								</div>
							</div>';
						//Modal Gallerie
						echo '<div class="ui modal '.$fournisseur['id'].'">
								<i class="close icon"></i>
								<div class="header">
									Galerie de '.$fournisseur['nom'].'
								</div>
								<div class="content">
									<div class="fotorama">
										';
										$temp = explode(";",$fournisseur['images']);
										foreach ($temp as $image) {
											if($image != ''){
												echo '<img src="'.$image.'" style="width:100%;">';
											}
										}
						echo'		</div>	
								</div>
								<div class="actions">
									<div class="ui button">Cancel</div>
									<div class="ui button">OK</div>
								</div>
							</div>';
						}

						echo'</div></div>';
						$i++;
				}
			?>


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
		$("#hovered_content5").css("height","100%");
		$("#hovered_content5").css("text-align","center");
		$("#hovered_content5").css("color","white");
		$("#paragraphe5").css("display","none");
	},returnToNormal);
	</script>
	
	<?php
	echo'<script type="text/javascript">';
	foreach($tous_les_fournisseurs as $partie_de_page){
		foreach ($partie_de_page as $fournisseur) {
			echo"$('.ui.modal.".$fournisseur['id']."').modal();";
		}
	}

	foreach($tous_les_fournisseurs as $partie_de_page){
		foreach ($partie_de_page as $fournisseur) {
			echo"$('#".$fournisseur['id']."').click(function(){
				alert('test !');
				$('.".$fournisseur['id']."').modal('show');    
			});";
		}
	}
			
	echo"</script>";

	include_once("footer.php");

	?>
	</body>
	</html>
