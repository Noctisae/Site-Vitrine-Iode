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

<div class="ui raised very padded text container segment">
	<h1 class="ui header align">Équipe et philosophie</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam venenatis arcu et felis luctus porttitor. Donec pellentesque, diam id finibus feugiat, nulla lectus consectetur ante, sed molestie lacus purus eu sem. Donec facilisis dapibus eros ut ultrices. Nulla posuere consequat porta. In rhoncus leo sed enim maximus molestie. Fusce elementum nunc facilisis enim porttitor pulvinar. Etiam porta in libero at iaculis. Suspendisse non risus tellus. Morbi ultricies est ac libero vestibulum, sit amet fermentum tortor mattis. Integer sem magna, porta ut lacus ac, tristique dapibus diam. Mauris viverra sodales efficitur.

	Donec id nisl et mi semper scelerisque eu et nisl. Ut lobortis lobortis tristique. Suspendisse mattis orci ac ligula mattis aliquam et at est. Phasellus ultricies nisi vel mi scelerisque, id pharetra turpis dapibus. Nam bibendum nisl eu posuere imperdiet. Vivamus sit amet mauris eget erat congue commodo. Nam eu tellus eleifend, vestibulum lectus sed, mattis tortor. Suspendisse malesuada ante eu augue imperdiet viverra ac sit amet arcu. </p>
	<hr>
	<h1 class="ui header align">Sur mesure</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam venenatis arcu et felis luctus porttitor. Donec pellentesque, diam id finibus feugiat, nulla lectus consectetur ante, sed molestie lacus purus eu sem. Donec facilisis dapibus eros ut ultrices. Nulla posuere consequat porta. In rhoncus leo sed enim maximus molestie. Fusce elementum nunc facilisis enim porttitor pulvinar. Etiam porta in libero at iaculis. Suspendisse non risus tellus. Morbi ultricies est ac libero vestibulum, sit amet fermentum tortor mattis. Integer sem magna, porta ut lacus ac, tristique dapibus diam. Mauris viverra sodales efficitur.

	Donec id nisl et mi semper scelerisque eu et nisl. Ut lobortis lobortis tristique. Suspendisse mattis orci ac ligula mattis aliquam et at est. Phasellus ultricies nisi vel mi scelerisque, id pharetra turpis dapibus. Nam bibendum nisl eu posuere imperdiet. Vivamus sit amet mauris eget erat congue commodo. Nam eu tellus eleifend, vestibulum lectus sed, mattis tortor. Suspendisse malesuada ante eu augue imperdiet viverra ac sit amet arcu. </p>
	<hr>
	<h1 class="ui header align">Actualités</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam venenatis arcu et felis luctus porttitor. Donec pellentesque, diam id finibus feugiat, nulla lectus consectetur ante, sed molestie lacus purus eu sem. Donec facilisis dapibus eros ut ultrices. Nulla posuere consequat porta. In rhoncus leo sed enim maximus molestie. Fusce elementum nunc facilisis enim porttitor pulvinar. Etiam porta in libero at iaculis. Suspendisse non risus tellus. Morbi ultricies est ac libero vestibulum, sit amet fermentum tortor mattis. Integer sem magna, porta ut lacus ac, tristique dapibus diam. Mauris viverra sodales efficitur.

	Donec id nisl et mi semper scelerisque eu et nisl. Ut lobortis lobortis tristique. Suspendisse mattis orci ac ligula mattis aliquam et at est. Phasellus ultricies nisi vel mi scelerisque, id pharetra turpis dapibus. Nam bibendum nisl eu posuere imperdiet. Vivamus sit amet mauris eget erat congue commodo. Nam eu tellus eleifend, vestibulum lectus sed, mattis tortor. Suspendisse malesuada ante eu augue imperdiet viverra ac sit amet arcu. </p>
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
