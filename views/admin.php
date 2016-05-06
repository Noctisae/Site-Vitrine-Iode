<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- Site Properities -->
	<title>Agence Iode Administration</title>
	<link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<script type="text/javascript" src="../semantic/jquery.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>


</head>
<body style="background-image: url('../img/ad.jpg')">
<?php

include_once("header.php");

?>
	<div class="ui one column center aligned grid">
	  <div class="column six wide form-holder">
	    <h2 class="center aligned header form-head">Sign in</h2>
	    <div class="ui form">
	      <div class="field">
	        <input type="text" placeholder="username">
	      </div>
	      <div class="field">
	        <input type="password" placeholder="password">
	      </div>
	      <div class="field">
	        <input type="submit" value="sign in" class="ui button large fluid green">
	      </div>
	      <div class="inline field">
	        <div class="ui checkbox">
	          <input type="checkbox">
	          <label>Remember me</label>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		$('.ui.checkbox').checkbox();
	</script>
</body>
</html>