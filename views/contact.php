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
