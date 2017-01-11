	<?php
	session_start();
	include_once('../php/default.php');
	$tous_les_fournisseurs = array(recupFournisseur(1),recupFournisseur(2),recupFournisseur(3),recupFournisseur(4),recupFournisseur(5));
	$temp = array(count(recupFournisseur(1)),count(recupFournisseur(2)),count(recupFournisseur(3)),count(recupFournisseur(4)),count(recupFournisseur(5)));

	$height_max = max($temp);
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
	<body id="body_accueil">
	<?php

	include_once("header.php");

	?>

	<div class="ui page grid total" style="padding-left: 0px;padding-right: 0px;height:100%;width:100%">
			<div class="row" style="padding : 0px;">
			<?php
				$i = 1;
				foreach ($tous_les_fournisseurs as $partie_de_page){
					echo '<div class="cinquo cinquo'.$i.' left column" style="background-image: url(\''.explode(";",$tous_les_fournisseurs[($i-1)][0]['images'])[0].'\');-webkit-background-size:cover;
		-moz-background-size:cover;
		-o-background-size:cover;
		background-size:cover;
		background-position:center;width:20%">';

					//Partie normale
						echo'
						<div id="hoverr'.$i.'" style="margin:auto!important;width:100%!important;">
							<div class="paragraphe paragraphe_accueil" id="paragraphe'.$i.'" style="margin:auto!important;text-align:center;display:flex;flex-direction: column;height:35vh!important">			
									';
								foreach ($partie_de_page as $fournisseur) {
									echo'<a style="width:95%;height:'.(float)(90.0/$height_max).'%!important;margin:auto!important;display:flex;"><img src="'.explode(";",$fournisseur["logo"])[0].'" style="width:70%;height:auto!important;margin:auto;max-height:'.(float)(35.0/$height_max).'vh!important"></a>';	
								}
						echo'
							</div>';
					//partie Hover
					echo'<div class="hovered_content_telechargement" id="hovered_content'.$i.'" style="margin-top:0px">
							<div class="alignement" style="display:flex;flex-direction: column;margin:auto!important;justify-content:space-around;">
					';

					foreach ($partie_de_page as $fournisseur) {
						echo'<div style="max-height:'.(float)85.0/$height_max.'vh!important;">

								<div style="display:flex;flex-direction: column;width:100%!important;background-color:rgba(255,255,255,0.75);height:10vh!important"><img src="';
													$temp = explode(";",$fournisseur["logo"])[1];
													if(!empty($temp)){
														$logo_1 = $temp;
													}
													else{
														$logo_1 = explode(";",$fournisseur["logo"])[0];
													}
												echo $logo_1.'" style="width:70%;height:auto!important;max-height:9vh!important;margin:auto;"/></div>
								<a style="color:white;" href="'.$fournisseur["catalogue"].'">Catalogue<br><i class="file text icon"></i></a><br>';
						echo'	<a style="color:white;" href="'.$fournisseur["catalogue_tarifs"].'">Tarifs<br><i class=" file text icon"></i></a><br><br></div>';
					}

					echo'	</div>
						</div>';

					echo'</div></div>';

					$i++;
					}
				
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
		
		var grosseurFile = 2;
		var width = $( window ).width();
		if(width < 1024){
			grosseurFile = 1;
		}
		$('.file').css("font-size",grosseurFile+"em");

		$('.ui.dropdown').dropdown();
	});

		var returnToNormal = function(){
		$(".cinquo1").css("width","20%");
		$(".cinquo2").css("width","20%");
		$(".cinquo3").css("width","20%");
		$(".cinquo4").css("width","20%");
		$(".cinquo5").css("width","20%");
		$("#hovered_content1").css("display","none");
		$("#paragraphe1").css("display","flex");
		$("#hovered_content2").css("display","none");
		$("#paragraphe2").css("display","flex");
		$("#hovered_content3").css("display","none");
		$("#paragraphe3").css("display","flex");
		$("#hovered_content4").css("display","none");
		$("#paragraphe4").css("display","flex");
		$("#hovered_content5").css("display","none");
		$("#paragraphe5").css("display","flex");
	}

	$("#hoverr1").hover(function(){
		$(".cinquo1").css("width","100%");
		$("#hovered_content1").css("display","flex");
		$("#hovered_content1").css("width","20%!important");
		$("#hovered_content1").css("height","100%");
		$("#hovered_content1").css("text-align","center");
		$("#hovered_content1").css("color","white");
		$("#paragraphe1").css("display","none");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$("#hoverr2").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","100%");
		$("#hovered_content2").css("display","flex");
		$("#hovered_content2").css("width","20%!important");
		$("#hovered_content2").css("height","100%");
		$("#hovered_content2").css("text-align","center");
		$("#hovered_content2").css("color","white");
		$("#paragraphe2").css("display","none");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$("#hoverr3").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","100%");
		$("#hovered_content3").css("display","flex");
		$("#hovered_content3").css("width","20%!important");
		$("#hovered_content3").css("height","100%");
		$("#hovered_content3").css("text-align","center");
		$("#hovered_content3").css("color","white");
		$("#paragraphe3").css("display","none");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$("#hoverr4").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","100%");
		$("#hovered_content4").css("display","flex");
		$("#hovered_content4").css("width","20%!important");
		$("#hovered_content4").css("height","100%");
		$("#hovered_content4").css("text-align","center");
		$("#hovered_content4").css("color","white");
		$("#paragraphe4").css("display","none");
		$(".cinquo5").css("width","0%");
	},returnToNormal);
	$("#hoverr5").hover(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","100%");
		$("#hovered_content5").css("display","flex");
		$("#hovered_content5").css("width","20%!important");
		$("#hovered_content5").css("height","100%");
		$("#hovered_content5").css("text-align","center");
		$("#hovered_content5").css("color","white");
		$("#paragraphe5").css("display","none");
	},returnToNormal);
		$("#hoverr1").click(function(){
		$(".cinquo1").css("width","100%");
		$("#hovered_content1").css("display","flex");
		$("#hovered_content1").css("height","99.9vh");
		$("#hovered_content1").css("width","99.9vw");
		$("#hovered_content1").css("text-align","center");
		$("#hovered_content1").css("color","white");
		$("#paragraphe1").css("display","none");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	});
	$("#hoverr2").click(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","100%");
		$("#hovered_content2").css("display","flex");
		$("#hovered_content2").css("height","99.9vh");
		$("#hovered_content2").css("width","99.9vw");
		$("#hovered_content2").css("text-align","center");
		$("#hovered_content2").css("color","white");
		$("#paragraphe2").css("display","none");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	});
	$("#hoverr3").click(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","100%");
		$("#hovered_content3").css("display","flex");
		$("#hovered_content3").css("height","99.9vh");
		$("#hovered_content3").css("width","99.9vw");
		$("#hovered_content3").css("text-align","center");
		$("#hovered_content3").css("color","white");
		$("#paragraphe3").css("display","none");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","0%");
	});
	$("#hoverr4").click(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","100%");
		$("#hovered_content4").css("display","flex");
		$("#hovered_content4").css("height","99.9vh");
		$("#hovered_content4").css("width","99.9vw");
		$("#hovered_content4").css("text-align","center");
		$("#hovered_content4").css("color","white");
		$("#paragraphe4").css("display","none");
		$(".cinquo5").css("width","0%");
	});
	$("#hoverr5").click(function(){
		$(".cinquo1").css("width","0%");
		$(".cinquo2").css("width","0%");
		$(".cinquo3").css("width","0%");
		$(".cinquo4").css("width","0%");
		$(".cinquo5").css("width","99vw");
		$("#hovered_content5").css("display","flex");
		$("#hovered_content5").css("height","99.9vh");
		$("#hovered_content5").css("width","99.9vw");
		$("#hovered_content5").css("text-align","center");
		$("#hovered_content5").css("color","white");
		$("#paragraphe5").css("display","none");
	});

	$(".menu_click").click(function(){
		$(".cinquo1").css("width","20%");
		$(".cinquo2").css("width","20%");
		$(".cinquo3").css("width","20%");
		$(".cinquo4").css("width","20%");
		$(".cinquo5").css("width","20%");
		$("#hovered_content1").css("display","none");
		$("#paragraphe1").css("display","flex");
		$("#hovered_content2").css("display","none");
		$("#paragraphe2").css("display","flex");
		$("#hovered_content3").css("display","none");
		$("#paragraphe3").css("display","flex");
		$("#hovered_content4").css("display","none");
		$("#paragraphe4").css("display","flex");
		$("#hovered_content5").css("display","none");
		$("#paragraphe5").css("display","flex");
	});
	</script>

	<?php

	include_once("footer.php");

	?>
	</body>
	</html>
