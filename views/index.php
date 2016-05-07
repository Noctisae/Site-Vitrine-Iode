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
		<script type="text/javascript" src="../semantic/jquery.min.js"></script>
		<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>

	</head>
	<body>
	<?php

	include_once("header.php");

	?>

	<div class="ui page grid" style="padding-left: 0px;padding-right: 0px;height:100%;">
			<div class="row" style="padding : 0px;">
				<div class="cinquo left column" style="background-image: url('../img/1.png');">
					<div class="paragraphe">
						<div class="ui huge header align">Header de test</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">				
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
						</p>
					</div>
				</div>
				<div class="cinquo left column" style="background-image: url('../img/2.jpg')";>
					<div class="paragraphe">
						<div class="ui huge header align">Header de test</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">				
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
						</p>
					</div>
				</div>
				<div class="cinquo left column" style="background-image: url('../img/3.jpg')";>
					<div class="paragraphe">
						<div class="ui huge header align">Header de test</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">				
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
						</p>
					</div>
				</div>
				<div class="cinquo left column" style="background-image: url('../img/4.png');">
					<div class="paragraphe">
						<div class="ui huge header align">Header de test</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">				
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
						</p>
					</div>
				</div>
				<div class="cinquo left column" style="background-image: url('../img/5.jpg');">
					<div class="paragraphe">
						<div class="ui huge header align">Header de test</div>
						<br>
						<br>
						<br>
						<br>				
						<p class="align">				
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
							<a href="">Lien de test</a>
							<br>
							<br>
						</p>
					</div>
				</div>
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
