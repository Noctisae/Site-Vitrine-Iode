<?php

	include_once('../php/default.php');

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
	<script type="text/javascript" src="../semantic/jquery.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>

</head>
<body>
<?php

include_once("header.php");

?>
<div class="ui raised very padded text container segment flex-contain">

<?php

$catalogues = recupCatalogues();

foreach ($catalogues as $catalogue) {
	echo'
	<div class="paragraphe">
	<a href="../catalogues/'.$catalogue['fichier'].'"></a>
		<div>
			<i class="cloud download icon"></i>
			<p>Télécharger ce catalogue</p>
		</div>
	</div>';

}


?>
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
