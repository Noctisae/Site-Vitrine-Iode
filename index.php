<<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- Site Properities -->
	<title>Agence Iode</title>
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">

	<script type="text/javascript" src="semantic/dist/semantic.min.js"></script>

</head>
<body>

</body>
</html>
<div class="ui grid">
	<div class="computer tablet only row">
	<div class="ui inverted fixed menu navbar page grid">
		<a href="" class="brand item">Agence Iode</a>
		<a href="" class="active item">Accueil</a>
		<a href="" class="item">Références</a>
		<a href="" class="item">Téléchargement</a>
		<a href="" class="item">Contact</a>
		<a class="ui dropdown item">Dropdown
		<i class="dropdown icon"></i>
		<div class="menu">
			<div class="item">Action</div>
			<div class="item">Another action</div>
			<div class="item">Something else here</div>
			<div class="ui divider"></div>
			<div class="item">Seperated link</div>
			<div class="item">One more seperated link</div>
		</div>
		</a>
		<div class="right menu">
		<a href="" class="item">Fixed top</a>
		</div>
	</div>
	</div>
	<div class="mobile only row">
		<div class="ui fixed inverted navbar menu">
			<a href="" class="brand item">Project Name</a>
			<div class="right menu open">
				<a href="" class="menu item">
					<i class="content icon"></i>
				</a>
			</div>
		</div>
		<div class="ui vertical navbar menu">
			<a href="" class="active item">Home</a>
			<a href="" class="item">About</a>
			<a href="" class="item">Contact</a>
			<div class="ui item">
				<div class="text">Dropdown</div>
				<div class="menu">
					<a class="item">Action</a>
					<a class="item">Another action</a>
					<a class="item">Something else here</a>
					<a class="ui aider"></a>
					<a class="item">Seperated link</a>
					<a class="item">One more seperated link</a>
				</div>
			</div>
			<div class="menu">
				<a href="" class="active item">Default</a>
				<a href="" class="item">Static top</a>
				<a href="" class="item">Fixed top</a>
			</div>
		</div>
	</div>
</div>
<div class="ui page grid main">
	<div class="row">
	<div class="column padding-reset">
		<div class="ui large message">
		<h1 class="ui huge header">Navbar example</h1>
		<p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
		<p>To see the difference between static and fixed top navbars, just scroll.</p>
		<br><br><br><br><br><br><br><br><br><br>
		<a href="" class="ui blue button">View navbar docs »</a>
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
