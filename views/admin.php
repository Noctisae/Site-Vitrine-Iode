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
					<h1>Gestion des administrateurs</h1>
				</div>
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
								<button value="Ajouter un nouvel administrateur" id="add_admin" class="ui button large fluid green">
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
								<button value="Supprimer cet administrateur" id="del_admin" class="ui button large fluid red">
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
								<button value="Modifier mon mot de passe" id="update_admin" class="ui button large fluid blue">
							</div>
						</form>
					</div>
				</div>







				<div class="column ten wide form-holder">
					<h1>Gestion des fournisseurs</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Ajouter un nouveau fournisseur</h2>
					<div class="ui form">
						<form method="post" action="admin.php" enctype="multipart/form-data" >
							<div class="field">
								<label>Nom du fournisseur</label>
								<input type="text" placeholder="nom" name="add_fournisseur_nom" id="add_fournisseur_nom">
							</div>
							<div class="field">
								<label>URL (une ou plusieurs) du (ou des) site(s) du fournisseur</label>
								<input type="text" multiple="multiple" placeholder="http://example.com" name="add_fournisseur_url[]" id="add_fournisseur_url[]">
							</div>
							<div class="field">
								<label>Catalogue</label>
								<input type="file" multiple="multiple" name="add_fournisseur_catalogue[]" id="add_fournisseur_catalogue[]">
							</div>
							<div class="field">
								<label>Photos</label>
								<input type="file" multiple="multiple" name="add_fournisseur_photos[]" id="add_fournisseur_photos[]">
							</div>
							<div class="field">
								<label>Priorité du fournisseur (entre 0 et 100, 100 étant le fournisseur le plus prioritaire)</label>
								<input type="number" name="add_fournisseur_priorite" id="add_fournisseur_priorite">
							</div>
							<div class="field">
								<button value="Ajouter un nouveau fournisseur" id="add_fournisseur" class="ui button large fluid green">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Supprimer un fournisseur</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<label>Fournisseur</label>
								<select class="ui search dropdown" id="del_fournisseur_id" name="del_fournisseur_id">
									';

									$fournisseurs = recupFournisseurs();
									foreach ($fournisseurs as $fournisseur) {
										echo('<option value="'.$fournisseur['Nom'].'">'.$fournisseur['Nom'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button value="Supprimer ce fournisseur" id="del_fournisseur" class="ui button large fluid red">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Modifier un fournisseur</h2>
					<div class="ui form">
						<form method="post" action="admin.php" enctype="multipart/form-data">
							<div class="field">
								<label>Fournisseur</label>
								<select class="ui search dropdown" id="update_fournisseur_id" name="update_fournisseur_id">
									';

									$fournisseurs = recupFournisseurs();
									foreach ($fournisseurs as $fournisseur) {
										echo('<option value="'.$fournisseur['Nom'].'">'.$fournisseur['Nom'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button value="Modifier ce fournisseur" id="update_fournisseur" class="ui button large fluid blue">
							</div>
						</form>
					</div>
				</div>





				<div class="column ten wide form-holder">
					<h1>Gestion des projets et références</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Ajouter un nouveau projet</h2>
					<div class="ui form">
						<form method="post" action="admin.php" enctype="multipart/form-data">
							<div class="field">
								<label>Nom du projet</label>
								<input type="text" required placeholder="Projet Réverie" name="add_projet_nom" id="add_projet_nom">
							</div>
							<div class="field">
								<label>Adresse du projet</label>
								<input type="text" placeholder="27, rue du Léon, 29200 Brest" name="add_projet_adresse" id="add_projet_adresse">
							</div>
							<div class="field">
								<label>Photos du projet</label>
								<input type="file" multiple="multiple" name="add_projet_photos[]" id="add_projet_photos[]">
							</div>
							<div class="field">
								<button value="Ajouter un nouveau projet" id="add_projet" class="ui button large fluid green">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Supprimer un projet</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<label>Projets</label>
								<select class="ui search dropdown" id="del_projet_id" name="del_projet_id">
									';

									$projets = recupProjets();
									foreach ($projets as $projet) {
										echo('<option value="'.$projet['ID'].'">'.$projet['Nom'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button value="Supprimer ce projet" id="del_projet" class="ui button large fluid red">
							</div>
						</form>
					</div>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Modifier un projet</h2>
					<div class="ui form">
						<form method="post" action="admin.php" enctype="multipart/form-data">
							<div class="field">
								<label>Projets</label>
								<select class="ui search dropdown" id="update_projet_id" name="update_projet_id">
									';

									$fournisseurs = recupFournisseurs();
									foreach ($fournisseurs as $fournisseur) {
										echo('<option value="'.$fournisseur['Nom'].'">'.$fournisseur['Nom'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button value="Modifier mon mot de passe" id="update_projet" class="ui button large fluid blue">
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
	<script type="text/javascript">
		$(document).ready(function(){

			$("#add_admin").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						add_admin_id : $("#add_admin_id").val(),
						add_admin_mdp : $("#add_admin_mdp").val()

					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#del_admin").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						del_admin_id : $("#del_admin_id").val()

					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#update_admin").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						update_admin_id : $("#update_admin_id").val(),
						update_admin_mdp : $("#update_admin_mdp").val(),
						update_admin_old_mdp : $("#update_admin_old_mdp").val()

					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#add_fournisseur").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						add_fournisseur_nom : $("#add_fournisseur_nom").val(),
						add_fournisseur_url : $("#add_fournisseur_url").val(),
						add_fournisseur_catalogue : $("#add_fournisseur_catalogue").val(),
						add_fournisseur_photos : $("#add_fournisseur_photos").val(),
						add_fournisseur_priorite : $("#add_fournisseur_priorite").val()
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#del_fournisseur").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						del_fournisseur_id : $("#del_fournisseur_id").val()
						
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#update_fournisseur").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						update_fournisseur_id : $("#update_fournisseur_id").val(),
						update_fournisseur_nom : $("#update_fournisseur_nom").val(),
						update_fournisseur_url : $("#update_fournisseur_url").val(),
						update_fournisseur_catalogue : $("#update_fournisseur_catalogue").val(),
						update_fournisseur_photos : $("#update_fournisseur_photos").val(),
						update_fournisseur_priorite : $("#update_fournisseur_priorite").val()
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#add_projet").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						add_projet_photos : $("#add_projet_photos").val(),
						add_projet_nom : $("#add_projet_nom").val(),
						add_projet_adresse : $("#add_projet_adresse").val()
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#del_projet").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						del_projet_id : $("#del_projet_id").val()
						
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});

			$("#update_projet").click(function{

				$.post(
					'../php/upload_admin.php', // Un script PHP que l'on va créer juste après
					{

						update_projet_id : $("#update_projet_id").val(),
						update_projet_nom : $("#update_projet_nom").val(),
						update_projet_adresse : $("#update_projet_adresse").val(),
						update_projet_photos : $("#update_projet_photos").val()
					},
					function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard

					},
					'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
				);
			});
		});
	
	</script>
</body>
</html>