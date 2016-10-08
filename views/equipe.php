<?php
	require_once('../php/default.php');
	$actualites = recupActualites();
	$surmesure = recupSurMesure();
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
	<link rel="stylesheet" type="text/css" href="../swiper/swiper.min.css"/>

</head>
<body>
<?php

include_once("header.php");

?>

<div class="ui raised very padded text segment equipe-container">
	<h1 class="ui header white-color">Équipe et philosophie</h1>
		<p>L’Agence Iode est animée par une équipe commerciale en relation directe avec des fabricants européens de référence, chacun dans son domaine d’activité.
	Notre offre de mobilier et d’accessoires est inspirée principalement de la tendance indoor-outdoor.<br>
	Nous répondons avec l’aide de nos partenaires (fabricants, distributeurs) aux demandes diverses de lieux professionnels, de manière personnalisée, par notre écoute et notre mobilité.
	</p>
	<hr>
	<h1 class="ui header white-color">Actualités</h1>
	<?php
	if(!empty($actualites)){
		foreach ($actualites as $actualite) {
			echo'
			<h1 style="font-size:14">'.$actualite['titre'].'</h1>
			<h3 style="font-size:14">'.date("d/m/Y",$actualite['date']).'</h3>
			<div class="swiper-container">

			<div class="swiper-wrapper">
			';
			$temp = explode(";",$actualite['images']);
			foreach ($temp as $photo) {
				if($photo != ""){
					echo'
						<div class="swiper-slide centered"><img src="'.$photo.'" style="height:300px;" /></div>
					';
				}
			}


			echo'</div>
			<!-- If we need pagination -->
			<div class="swiper-pagination"></div>
			
			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
			
			<!-- If we need scrollbar -->
			<div class="swiper-scrollbar"></div>

			</div>
			<p style="margin-top:10px;">'.nl2br($actualite['description']).'</p>';

		}
	}
	else{
		echo'<p>Désolé, il n\'y a pas encore d\'actualités !</p>';
	}

	?>
	<hr>
	<h1 class="ui header white-color">Sur mesure</h1>
	<?php
	if(!empty($surmesure)){
		echo'<p>Notre offre s’appuie sur des fabricants reconnus avec un savoir-faire spécifique dans leurs domaines, ce qui nous permet de répondre à différentes demandes de personnalisation. Notre expérience depuis vingt ans sur le marché de l’indoor-outdoor  est une opportunité que nous proposons de partager ensemble.<br>
				<div class="swiper-container">
					<div class="swiper-wrapper">';
					$temp = explode(";",$surmesure[0]);
					foreach ($temp as $photo) {
						if($photo != ""){
							echo'
								<div class="swiper-slide centered"><img src="'.$photo.'" style="height:370px;" /></div>
									';
						}
					}

					echo'
					</div>
					<!-- If we need pagination -->
					<div class="swiper-pagination"></div>
						
					<!-- If we need navigation buttons -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
							
					<!-- If we need scrollbar -->
					<div class="swiper-scrollbar"></div>
				</div>
			</p>';
	}
	else{
		echo'<p>Désolé, il n\'y a pas encore de photos de sur-mesure !</p>';
	}

	?>
	
	
</div>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../swiper/swiper.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		$('.right.menu.open').on("click",function(e){
		e.preventDefault();
		$('.ui.vertical.menu').toggle();
		});
		
		$('.ui.dropdown').dropdown();
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.right.menu.open').on("click",function(e){
			e.preventDefault();
			$('.ui.vertical.menu').toggle();
		});
		var mySwiper = new Swiper ('.swiper-container', {
				// Optional parameters
				loop: true,
				height: '300px',
				centeredSlides: true,
				slidesPerView: 3,
				
				// If we need pagination
				pagination: '.swiper-pagination',
				
				// Navigation arrows
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev',
				
				// And if we need scrollbar
				scrollbar: '.swiper-scrollbar'
		});
	});
	</script>
<?php

include_once("footer.php");

?>
</body>
</html>
