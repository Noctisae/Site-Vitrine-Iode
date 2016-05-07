<?php
	session_start();

	if(!empty($_POST['logout'])){
		unset($_SESSION['authentifie']);
		unset($_SESSION['identifiant']);
	}

	$admin = False;
	if(!empty($_SESSION["authentifie"])){
		$admin = $_SESSION["authentifie"];
	}
	include_once('../php/default.php');
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
		error_log('On rentre dans la vérification des infos');
		if(!empty($_POST["id"]) && !empty($_POST["mdp"])){
			usleep(200000); // Protection contre brute-force, maximum 5 requetes par seconde
			error_log('On regarde si les infos envoyées correspondent à un admin');
			$admin = isAdmin($_POST["id"],$_POST["mdp"]);
			error_log('maintenant, admin vaut '.$admin);
		}
	}

	if(!empty($_SESSION["authentifie"])){
		if(!empty($_POST['add_admin_id']) && !empty($_POST['add_admin_mdp'])){
			$temp = addAdmin($_POST['add_admin_id'],$_POST['add_admin_mdp']);
		}

		if(!empty($_POST['del_admin_id'])){
			$temp = supprAdmin($_POST['del_admin_id']);
		}

		if(!empty($_POST['update_admin_id']) && !empty($_POST['update_admin_mdp']) && !empty($_POST['update_admin_old_mdp'])){
			$temp = modifMDP($_POST['update_admin_id'],$_POST['update_admin_mdp'],$_POST['update_admin_old_mdp']);
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
		echo'<div class="ui one column center aligned grid">
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Ajouter un nouvel administrateur</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<label>Identifiant</label>
								<input type="text" placeholder="identifiant" name="add_admin_id" id="add_admin_id">
							</div>
							<div class="field">
								<label>Mot de passe</label>
								<input type="password" placeholder="mot de passe" name="add_admin_mdp" id="add_admin_mdp">
							</div>
							<div class="field">
								<input type="submit" value="Ajouter un nouvel administrateur" class="ui button large fluid green">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Supprimer un administrateur</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<label>Administrateur</label>
								<select class="ui search dropdown" id="del_admin_id" name="del_admin_id">
									';

									$admins = recupAdmins();
									error_log($admins);
									foreach ($admins as $admin) {
										echo('<option value="'.$admin['identifiant'].'">'.$admin['identifiant'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<input type="submit" value="Supprimer cet administrateur" class="ui button large fluid red">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Modifier votre mot de passe</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<input type="hidden" value="'.$_SESSION['identifiant'].'" name="update_admin_id" id="update_admin_id">
							</div>
							<div class="field">
								<label>Ancien mot de passe</label>
								<input type="password" placeholder="mot de passe" name="update_admin_old_mdp" id="update_admin_old_mdp">
							</div>
							<div class="field">
								<label>Nouveau mot de passe</label>
								<input type="password" placeholder="mot de passe" name="update_admin_mdp" id="update_admin_mdp">
							</div>
							<div class="field">
								<label>Veuillez répéter votre nouveau mot de passe</label>
								<input type="password" placeholder="mot de passe" name="update_admin_mdp_2" id="update_admin_mdp_2">
							</div>
							<div class="field">
								<input type="submit" value="Modifier mon mot de passe" class="ui button large fluid blue">
							</div>
						</form>
					</div>
				</div>
			</div>';
	}
	else{
		echo'<div class="ui one column center aligned grid">
				<div class="column six wide form-holder">
					<h2 class="center aligned header form-head">Se connecter</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<input type="text" placeholder="identifiant" name="id" id="id">
							</div>
							<div class="field">
								<input type="password" placeholder="mot de passe" name="mdp" id="mdp">
							</div>
							<div class="field">
								<input type="submit" value="Se connecter" class="ui button large fluid green">
							</div>
						</form>
					</div>
				</div>
			</div>';
	}

?>
	

	<script type="text/javascript">
		$('.ui.checkbox').checkbox();
		$('select.dropdown')
			.dropdown()
		;
	</script>
</body>
</html>