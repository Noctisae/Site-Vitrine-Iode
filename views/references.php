<?php
	session_start();
	include_once('../php/default.php');
	$references = recupProjets();

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
	<?php
	foreach ($references as $reference) {
		echo'
		<div class="ui raised very padded text segment flex-contain references-container">
		<div class="paragraphe" style="width:100%;">
		<h1 style="font-size:14">'.$reference['nom'].'</h1>
		<div class="swiper-container">

		<div class="swiper-wrapper">
		';
		$temp = explode(";",$reference['photos']);
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
		<p style="margin-top:10px;text-align:justify;">'.nl2br($reference['description']).'</p>

		</div></div>';

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
