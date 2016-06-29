<script type="text/javascript">
	var url = document.location.href;
	var nom = url.substring(url.lastIndexOf( "/" )+1 );
	var x = document.getElementsByClassName(nom.split(".")[0]);
	var i;
	for (i = 0; i < x.length; i++) {
		x[i].className += " active";
	}
</script>
<script type="text/javascript">
	var returnMenuToNormal = function(){
		$(".ui.menu .menu div").css("transition-duration","1s");
		$(".ui.menu .menu div").css("transition-property","color");
		$(".ui.menu .menu div").css("transition-property","background-color");
		$(".ui.menu .menu div a").css("color","black");
		$(".ui.menu .menu div").css("background-color","rgba(255,255,255,1)");
	}

	$(".ui.menu .menu div").hover(function(){
		$(this).css("transition-duration","1s");
		$(this).css("transition-property","color");
		$(this).css("transition-property","background-color");
		$(this).css("color","white");
		$(this).children("a").css("color","white");
		$(this).css("background-color","rgba(0,0,0,0.8)");
	},returnMenuToNormal);

</script>