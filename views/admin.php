<?php
	session_start();
	$admin = False;
	//Protection contre XSS
	foreach( $_POST as $cle=>$value )
	{
		if(is_array($_POST[$cle])) {
			foreach($_POST[$cle] as $cle2 =>$value2){
				$_POST[$cle2] = strip_tags(htmlentities($value2, ENT_QUOTES, 'UTF-8'));
			}
		}
		else{
			$_POST[$cle] = strip_tags(htmlentities($value, ENT_QUOTES, 'UTF-8'));
		}
	}
	foreach( $_GET as $cle=>$value )
	{
		if(is_array($_GET[$cle])) {
			foreach($_GET[$cle] as $cle2 =>$value2){
				$_GET[$cle2] = strip_tags(htmlentities($value2, ENT_QUOTES, 'UTF-8'));
			}
		}
		else{
			$_GET[$cle] = strip_tags(htmlentities($value, ENT_QUOTES, 'UTF-8'));
		}
	}

	if(empty($_SESSION["authentifie"])){
		if(!empty($_POST["id"]) && !empty($_POST["mdp"])){
			usleep(200000); // Protection contre brute-force, maximum 5 requetes par seconde
			$admin = isAdmin($_POST["id"],$_POST["mdp"])
		}
	}


?>
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

<?php
	//Si l'utilisateur est administrateur
	if($admin){
		echo'';
	}
	else{
		echo'<div class="ui one column center aligned grid">
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
			</div>';
	}

?>
	

	<script type="text/javascript">
		$('.ui.checkbox').checkbox();
	</script>
</body>
</html>