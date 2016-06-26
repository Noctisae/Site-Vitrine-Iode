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
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>

</head>
<body style="display:flex;">
<?php

include_once("header.php");

?>


<div class="ui raised inverted very padded text container segment" style="margin:auto;">
	<h1 class="ui inverted header align">Nous contacter</h1>
	<div class="ui inverted segment">
		<div class="ui inverted form">
			<form action="contact.php" method="post" class="ui form">
				<div class="two fields">
					<div class="field">
						<label>Prénom</label>
						<input placeholder="John" type="text">
					</div>
					<div class="field">
						<label>Nom</label>
						<input placeholder="Doe" type="text">
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Votre email</label>
						<input placeholder="john.doe@orange.fr" type="text">
					</div>
					<div class="field">
						<label>Votre téléphone</label>
						<input placeholder="06 00 00 00 00" type="text">
					</div>
				</div>
				<div class="field">
					<label>Votre message</label>
					<textarea></textarea>
				  </div>
				<div class="field">
					<div class="ui checkbox">
						<input required type="checkbox" tabindex="0" class="required">
						<label>J'accepte les conditions d'utilisation de ce formulaire</label>
					</div>
				</div>
				<div class="ui submit button">Submit</div>
			</form>
		</div>
	</div>
</div>		

<!-- Formulaire de contact récupéré -->
<div id="cardWrap">
	<form id="contactForm" action="php/send_email.php" method="post"> 
		<div class="col50">
			<div class="mailWrap">
					<textarea name="message" id="message" required="" placeholder="Schrijf ons een kaartje" rows="11">Votre message</textarea>
					<input name="email" id="email" required="" type="email" placeholder="Votre adresse mail">
					<button class="btn submit submitHover" type="submit">Envoyer</button>
			</div>
		</div>
		<div class="col50">
			<div id="stamp"></div>
			<img id="stampImg" alt="contact Saus stempel" src="img/stamp.png">
			<div class="inner">
				<h3>Iode</h3>
				<p><span class="icon adresIco"></span>Adresse xxxxx<br>
				Code postal Ville<br>
				France</p>

				<p><a class="icon emailIco sprite" href="mailto:mail@saus.co"><span style="display: none;"></span>mail@iode.com</a></p>
				<p><a class="icon telIco sprite" style="margin-top: 3em;" href="tel:0031432602000"><span style="display: none;"></span>+31&nbsp;(0)&nbsp;43&nbsp;260&nbsp;20&nbsp;00</a></p>
			</div>
		</div>
	</form>
	<div class="clear"></div>
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
