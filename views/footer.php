<script type="text/javascript">
	var url = document.location.href;
	var nom = url.substring(url.lastIndexOf( "/" )+1 );
	var x = document.getElementsByClassName(nom.split(".")[0]);
	var i;
	for (i = 0; i < x.length; i++) {
		x[i].className += " active";
	}
</script>