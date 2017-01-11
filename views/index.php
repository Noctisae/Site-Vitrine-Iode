	<?php
	session_start();
	include_once('../php/default.php');
	$affichage_fotorama = false;
	$appel_fournisseur = explode('?',$_SERVER['REQUEST_URI'])[1];
	if(!empty($appel_fournisseur)){
		$id = explode('=',$appel_fournisseur)[1];
		if(!empty($id)){
			$fournisseur = recupFournisseurId($id);
			if(!empty($fournisseur['nom']) && !empty($fournisseur['url']) && !empty($fournisseur['images'])){
				$affichage_fotorama = true;
				$temp = explode(";",$fournisseur["logo"])[1];
				if(!empty($temp)){
					$logo_header = $temp;
				}
				else{
					$logo_header = explode(";",$fournisseur["logo"])[0];
				}
			}
		}
	}
	if($affichage_fotorama == false){
		$tous_les_fournisseurs = array(recupFournisseur(1),recupFournisseur(2),recupFournisseur(3),recupFournisseur(4),recupFournisseur(5));

		$temp = array(count(recupFournisseur(1)),count(recupFournisseur(2)),count(recupFournisseur(3)),count(recupFournisseur(4)),count(recupFournisseur(5)));

		$height_max = max($temp);
	}

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
				if($affichage_fotorama){
					echo'
					<div class="fotorama" data-nav="thumbs" data-width="100%" data-height="88%" data-minwidth="400"
	     data-maxwidth="1920"  data-minheight="300" data-thumbwidth="130" data-thumbheight="130" data-navposition="bottom"
	     data-maxheight="88%" data-allowfullscreen="native" data-loop="true" data-click="true"
     data-swipe="true" data-arrows="true" data-keyboard=\'{"space": true, "home": true, "end": true, "up": true, "down": true}\' style="margin-top:10px;">
											';
					$temp = explode(";",$fournisseur['images']);
					foreach ($temp as $image) {
						if($image != ''){
							echo '<img src="'.$image.'" style="width:100%;">';
						}
					}
					echo'		</div>	';
				}
				else{
					$i = 1;
					foreach ($tous_les_fournisseurs as $partie_de_page) {
						switch (count($partie_de_page)){
							case 1:
								$class= "seul";
								$lien = "increment_";
								break;
							case 2:
								$class= "duo";
								$lien = "increment_deux_";
								break;
							case 3:
								$class= "trio";
								$lien = "increment_trois_";
								break;
							case 4:
								$class= "quatuor";
								$lien = "increment_quatre_";
								break;
							default:
								$class= "quintet";
								$lien = "increment_cinq_";
								break;
						}
						echo '<div class="cinquo cinquo'.$i.' left column" style="background-image: url(\''.explode(";",$tous_les_fournisseurs[($i-1)][0]['images'])[0].'\');-webkit-background-size:cover;
						-moz-background-size:cover;
						-o-background-size:cover;
						background-size:cover;
						background-position:center;width:20%;display:flex!important;">';

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
							echo'<div class="hovered_content_index" id="hovered_content'.$i.'" style="margin-top:0px">
							';
							$j = 1;
							foreach ($partie_de_page as $fournisseur) {
								echo'
									<div class="'.$class.' click '.$lien.$j.'" id="para'.$fournisseur['id'].'" style="background-image:url(\''.explode(';',$fournisseur["images"])[0].'\');-webkit-background-size:cover!important;
						-moz-background-size:cover!important;
						-o-background-size:cover!important;
						background-size:cover!important;
						background-position:center!important;z-index:100!important;" >
										<a class="clickable '.$class.'" href="index.php?id='.$fournisseur['id'].'"></a>
										<div class="paragraphe paragraphe_accueil">
											<p class="align alignement_index">
												<a href="'.$fournisseur["url"].'" style="width:100%!important;margin:auto!important;text-align:center;display:flex!important;flex-direction: column;height:18vh!important"><img src="';
													$temp = explode(";",$fournisseur["logo"])[1];
													if(!empty($temp)){
														$logo_1 = $temp;
													}
													else{
														$logo_1 = explode(";",$fournisseur["logo"])[0];
													}
												echo $logo_1.'" style="max-width:80%;height:auto!important;margin:auto;max-height:75%!important"></a><br><br>
											</p>
										</div>
									</div>';
							$j++;
							}

							echo'</div></div></div>';
							$i++;
					}
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
		$("#hovered_content1").css("height","99.9vh");
		$("#hovered_content1").css("width","99.9vw");
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
		$("#hovered_content2").css("height","99.9vh");
		$("#hovered_content2").css("width","99.9vw");
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
		$("#hovered_content3").css("height","99.9vh");
		$("#hovered_content3").css("width","99.9vw");
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
		$("#hovered_content4").css("height","99.9vh");
		$("#hovered_content4").css("width","99.9vw");
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
		$(".cinquo5").css("width","99vw");
		$("#hovered_content5").css("display","flex");
		$("#hovered_content5").css("height","99.9vh");
		$("#hovered_content5").css("width","99.9vw");
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