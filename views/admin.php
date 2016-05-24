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
	<link rel="stylesheet" type="text/css" href="../css/dropzone.css">
	<script type="text/javascript" src="../semantic/jquery.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../js/dropzone.js"></script>

</head>
<body style="background-image: url('../img/ad.jpg')">
<?php

include_once("header.php");

?>

<?php
	//Si l'utilisateur est administrateur
	if($admin){
		echo'<div class="ui one column center aligned grid" >
				<div class="column ten wide form-holder">
					<h1>Gestion des administrateurs</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head">Ajouter un nouvel administrateur</h2>
					<div class="ui form">
						<div class="field">
								<label>Identifiant</label>
								<input type="text" placeholder="identifiant" name="add_admin_id" id="add_admin_id">
							</div>
							<div class="field">
								<label>Mot de passe</label>
								<input type="password" placeholder="mot de passe" name="add_admin_mdp" id="add_admin_mdp">
							</div>
							<div class="field">
								<button id="add_admin" class="ui button large fluid green">Ajouter un nouvel administrateur</button>
							</div>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_add_admin_div">
						<p id="return_add_admin_para"></p>
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
									foreach ($admins as $admin) {
										echo('<option value="'.$admin['identifiant'].'">'.$admin['identifiant'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button id="del_admin" class="ui button large fluid red">Supprimer cet administrateur</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_del_admin_div">
						<p id="return_del_admin_para"></p>
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
								<button id="update_admin" class="ui button large fluid blue">Modifier mon mot de passe</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_update_admin_div">
						<p id="return_update_admin_para"></p>
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
								<input type="text" name="add_fournisseur_catalogue" id="add_fournisseur_catalogue">
								<form action="../php/upload_admin_catalogues_fournisseurs.php" class="dropzone" id="dropzone_catalogues_add">
									<div class="fallback">
										<input name="file" type="file" multiple />
									</div>
								</form>
							</div>
							<div class="field">
								<label>Photos</label>
								<input type="text" name="add_fournisseur_photos" id="add_fournisseur_photos">
								<form action="../php/upload_admin_photos_fournisseurs.php" class="dropzone" id="dropzone_photos_fournisseurs_add">
									<div class="fallback">
										<input name="file" type="file" multiple />
									</div>
								</form>
							</div>
							<div class="field">
								<label>Priorité du fournisseur (entre 0 et 100, 100 étant le fournisseur le plus prioritaire)</label>
								<input type="number" name="add_fournisseur_priorite" id="add_fournisseur_priorite">
							</div>
							<div class="field">
								<button id="add_fournisseur" class="ui button large fluid green">Ajouter un nouveau fournisseur</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_add_fournisseur_div">
						<p id="return_add_fournisseur_para"></p>
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
								<button id="del_fournisseur" class="ui button large fluid red">Supprimer ce fournisseur</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_del_fournisseur_div">
						<p id="return_del_fournisseur_para"></p>
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
								<button id="update_fournisseur" class="ui button large fluid blue">Modifier ce fournisseur</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_update_fournisseur_div">
						<p id="return_update_fournisseur_para"></p>
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
								<input type="text" multiple="multiple" name="add_projet_photos" id="add_projet_photos">
								<form action="../php/upload_admin_photos_projets.php" class="dropzone" id="dropzone_photos_projets_add">
									<div class="fallback">
										<input name="file" type="file" multiple />
									</div>
								</form>
							</div>
							<div class="field">
								<button id="add_projet" class="ui button large fluid green">Ajouter un nouveau projet</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_add_projet_div">
						<p id="return_add_projet_para"></p>
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
								<button id="del_projet" class="ui button large fluid red">Supprimer ce projet</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_del_projet_div">
						<p id="return_del_projet_para"></p>
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
								<button value="" id="update_projet" class="ui button large fluid blue">Modifier ce projet</button>
							</div>
						</form>
					</div>
					<div style="display:hidden;margin-top:20px;" class="ui large fluid" id="return_update_fournisseur_div">
						<p id="return_update_fournisseur_para"></p>
					</div>
				</div>
			</div>';
	}
	else{
		echo'<div class="ui one column center aligned grid mid">
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

			$("#add_admin").click(function(){

				$.post(
					'../php/upload_admin.php',
					{

						add_admin_id : $("#add_admin_id").val(),
						add_admin_mdp : $("#add_admin_mdp").val()

					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_add_admin_div").css("backgroundColor", "green");
						}
						else{
							$("#return_add_admin_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_add_admin_para").text(json.msg);
						$("#return_add_admin_div").css("display", "block");
						setTimeout(function(){$("#return_add_admin_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#del_admin").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						del_admin_id : $("#del_admin_id").val()

					},
					function(data){ 
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_del_admin_div").css("backgroundColor", "green");
						}
						else{
							$("#return_del_admin_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_del_admin_para").text(json.msg);
						$("#return_del_admin_div").css("display", "block");
						setTimeout(function(){$("#return_del_admin_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#update_admin").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						update_admin_id : $("#update_admin_id").val(),
						update_admin_mdp : $("#update_admin_mdp").val(),
						update_admin_old_mdp : $("#update_admin_old_mdp").val()

					},
					function(data){ 
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_update_admin_div").css("backgroundColor", "green");
						}
						else{
							$("#return_update_admin_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_update_admin_para").text(json.msg);
						$("#return_update_admin_div").css("display", "block");
						setTimeout(function(){$("#return_update_admin_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#add_fournisseur").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						add_fournisseur_nom : $("#add_fournisseur_nom").val(),
						add_fournisseur_url : $("#add_fournisseur_url").val(),
						add_fournisseur_catalogue : $("#add_fournisseur_catalogue").val(),
						add_fournisseur_photos : $("#add_fournisseur_photos").val(),
						add_fournisseur_priorite : $("#add_fournisseur_priorite").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_add_fournisseur_div").css("backgroundColor", "green");
						}
						else{
							$("#return_add_fournisseur_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_add_fournisseur_para").text(json.msg);
						$("#return_add_fournisseur_div").css("display", "block");
						setTimeout(function(){$("#return_add_fournisseur_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#del_fournisseur").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						del_fournisseur_id : $("#del_fournisseur_id").val()
						
					},
					function(data){ 
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_del_fournisseur_div").css("backgroundColor", "green");
						}
						else{
							$("#return_del_fournisseur_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_del_fournisseur_para").text(json.msg);
						$("#return_del_fournisseur_div").css("display", "block");
						setTimeout(function(){$("#return_del_fournisseur_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#update_fournisseur").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						update_fournisseur_id : $("#update_fournisseur_id").val(),
						update_fournisseur_nom : $("#update_fournisseur_nom").val(),
						update_fournisseur_url : $("#update_fournisseur_url").val(),
						update_fournisseur_catalogue : $("#update_fournisseur_catalogue").val(),
						update_fournisseur_photos : $("#update_fournisseur_photos").val(),
						update_fournisseur_priorite : $("#update_fournisseur_priorite").val()
					},
					function(data){ 
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_update_fournisseur_div").css("backgroundColor", "green");
						}
						else{
							$("#return_update_fournisseur_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_update_fournisseur_para").text(json.msg);
						$("#return_update_fournisseur_div").css("display", "block");
						setTimeout(function(){$("#return_update_fournisseur_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#add_projet").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						add_projet_photos : $("#add_projet_photos").val(),
						add_projet_nom : $("#add_projet_nom").val(),
						add_projet_adresse : $("#add_projet_adresse").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_add_projet_div").css("backgroundColor", "green");
						}
						else{
							$("#return_add_projet_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_add_projet_para").text(json.msg);
						$("#return_add_projet_div").css("display", "block");
						setTimeout(function(){$("#return_add_projet_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#del_projet").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						del_projet_id : $("#del_projet_id").val()
						
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_del_projet_div").css("backgroundColor", "green");
						}
						else{
							$("#return_del_projet_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_del_projet_para").text(json.msg);
						$("#return_del_projet_div").css("display", "block");
						setTimeout(function(){$("#return_del_projet_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			$("#update_projet").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						update_projet_id : $("#update_projet_id").val(),
						update_projet_nom : $("#update_projet_nom").val(),
						update_projet_adresse : $("#update_projet_adresse").val(),
						update_projet_photos : $("#update_projet_photos").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json  = JSON.parse(true_data[0]);
						if(json.success){
							$("#return_update_projet_div").css("backgroundColor", "green");
						}
						else{
							$("#return_update_projet_div").css("backgroundColor", "red");
						}
						alert(json.msg);
						$("#return_update_projet_para").text(json.msg);
						$("#return_update_projet_div").css("display", "block");
						setTimeout(function(){$("#return_update_projet_div").css("display", "none")}, 10000);
					},
					'text' 
				);
			});

			new Dropzone("#dropzone_catalogues_add", { 
				maxFilesize: 2, // MB
				init: function() {
					this.on("success", function(file, response) {
						if($("add_fournisseur_catalogue").val() != ''){
							$("add_fournisseur_catalogue").val() = $("add_fournisseur_catalogue").val() +','+ response;
						}
						else{
							$("add_fournisseur_catalogue").val() = response;
						}
					});
				}
			});

			new Dropzone("#dropzone_photos_projets_add", { 
				maxFilesize: 2, // MB
				init: function() {
					this.on("success", function(file, response) {
						if($("add_projet_photos").val() != ''){
							$("add_projet_photos").val() = $("add_projet_photos").val() +','+ response;
						}
						else{
							$("add_projet_photos").val() = response;
						}
					});
				}
			});

			new Dropzone("#dropzone_photos_fournisseurs_add", { 
				maxFilesize: 2, // MB
				init: function() {
					this.on("success", function(file, response) {
						if($("add_fournisseur_photos").val() != ''){
							$("add_fournisseur_photos").val() = $("add_fournisseur_photos").val() +','+ response;
						}
						else{
							$("add_fournisseur_photos").val() = response;
						}					});
				}
			});
		});
	

	function encode_utf8(s) {
		return unescape(encodeURIComponent(s));
	}

	function decode_utf8(s) {
		return decodeURIComponent(escape(s));
	}
	</script>
</body>
</html>