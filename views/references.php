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

$references = recupReferences();

foreach ($references as $reference) {
	echo'
	<div class="paragraphe">
	<h1>'.$reference['Nom'].'</h1>
	<h3>'.$reference['Adresse'].'</h3>
	
	';
	foreach ($reference['Photos'] as $photo) {
		echo'
		<img src="'.$photo.'""/>
		';
	}


	echo'</div>';

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
