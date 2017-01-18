<?php
	session_start();
	usleep(200000);
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
			$admin = isAdmin($_POST["id"],$_POST["mdp"]);
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
	<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
	<script type="text/javascript" src="../js/sweetalert.min.js"></script>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../js/dropzone.js"></script>

</head>
<body>
<?php

include_once("header.php");

?>

<?php
	//Si l'utilisateur est administrateur
	if($admin){
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////	Partie Administrateurs 	//////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		echo'

		<div class="ui fluid four item tabular menu menu-adaptive" style="margin-top:100px;">
			<a class="item active" data-tab="admin">Administrateurs</a>
			<a class="item" data-tab="fournisseurs">Fournisseurs</a>
			<a class="item" data-tab="Projets">Projets</a>
			<a class="item" data-tab="surmesure">Sur-mesure & Actualités</a>
		</div>
		<div class="ui bottom attached tab segment active" style="text-align:center;" data-tab="admin">
			<div class="ui main container">
				<div class="column ten wide form-holder">
					<h1>Gestion des administrateurs</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Ajouter un nouvel administrateur</h2>
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
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Supprimer un administrateur</h2>
					<div class="ui form">
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
					</div>
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Modifier votre mot de passe</h2>
					<div class="ui form">
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
					</div>
					
				</div>

			</div>
		</div>';


		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////	Partie Fournisseurs 	//////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		




		echo'
		<div class="ui bottom attached tab segment" style="text-align:center;" data-tab="fournisseurs">
			<div class="ui main container">
				<div class="column ten wide form-holder">
					<h1>Gestion des fournisseurs</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Ajouter un nouveau fournisseur</h2>
					<div class="ui form">
							<div class="field">
								<label>Nom du fournisseur</label>
								<input type="text" placeholder="nom" name="add_fournisseur_nom" id="add_fournisseur_nom">
							</div>
							<div class="field">
								<label>URL du site du fournisseur</label>
								<input type="text" placeholder="http://example.com" name="add_fournisseur_url" id="add_fournisseur_url">
							</div>
							<div class="field">
								<input type="hidden" name="add_fournisseur_catalogue" id="add_fournisseur_catalogue">
							</div>
							<div class="field">
								<input type="hidden" name="add_fournisseur_catalogue_tarifs" id="add_fournisseur_catalogue_tarifs">
							</div>
							<div class="field">
								<input type="hidden" name="add_fournisseur_logo" id="add_fournisseur_logo">
							</div>
							<div class="field">
								<input type="hidden" name="add_fournisseur_photos" id="add_fournisseur_photos">
							</div>
							<div class="field">
								<label>Priorité du fournisseur (entre 1 et 5, selon le placement sur la page d\'accueil : un fournisseur de priorité 1 sera dans le bloc le plus à gauche de la page d\'accueil, tandis qu\'un fournisseur de priorité 5 sera dans le bloc le plus à droite)</label>
								<input type="number" min="1" max="5" name="add_fournisseur_priorite" id="add_fournisseur_priorite">
							</div>

						<label>Logo du fournisseur</label>
						<form action="/file-upload" class="dropzone" id="dropzone_logo_add"></form>
						<label>Catalogue</label>
						<form action="/file-upload" class="dropzone" id="dropzone_catalogues_add"></form>
						<label>Catalogue des tarifs</label>
						<form action="/file-upload" class="dropzone" id="dropzone_catalogues_tarifs_add"></form>
						<label>Photos</label>
						<form action="/file-upload" class="dropzone" id="dropzone_photos_fournisseurs_add"></form>
						<div class="field">
							<button id="add_fournisseur" class="ui button large fluid green">Ajouter un nouveau fournisseur</button>
						</div>
					</div>
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Supprimer un fournisseur</h2>
					<div class="ui form">
							<div class="field">
								<label>Fournisseur</label>
								<select class="ui search dropdown" id="del_fournisseur_id" name="del_fournisseur_id">
									';

									$fournisseurs = recupFournisseurs();
									foreach ($fournisseurs as $fournisseur) {
										echo('<option value="'.$fournisseur['id'].'">'.$fournisseur['nom'].'</option>');
									}
									echo '
								</select>
							</div>
							<div class="field">
								<button id="del_fournisseur" class="ui button large fluid red">Supprimer ce fournisseur</button>
							</div>
					</div>
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Modifier un fournisseur</h2>
					<div class="ui form">
						<div class="field">
								<label>Fournisseur</label>
								<select class="ui search dropdown" id="update_fournisseur_id" name="update_fournisseur_id">
									';

									$fournisseurs = recupFournisseurs();
									foreach ($fournisseurs as $fournisseur) {
										echo('<option value="'.$fournisseur['id'].'">'.$fournisseur['nom'].', partie de page '.$fournisseur['priorite'].'</option>');
									}
									echo '
								</select>
							</div>
							<input type="hidden" name="update_fournisseur_id" id="update_fournisseur_id">
							<div class="field">
								<label>Nom du fournisseur</label>
								<input type="text" placeholder="nom" name="update_fournisseur_nom" id="update_fournisseur_nom">
							</div>
							<div class="field">
								<label>URL du site du fournisseur</label>
								<input type="text" placeholder="http://example.com" name="update_fournisseur_url" id="update_fournisseur_url">
							</div>
							<div class="field">
								<input type="hidden" name="update_fournisseur_catalogue" id="update_fournisseur_catalogue">
							</div>
							<div class="field">
								<input type="hidden" name="update_fournisseur_catalogue_tarifs" id="update_fournisseur_catalogue_tarifs">
							</div>
							<div class="field">
								<input type="hidden" name="update_fournisseur_photos" id="update_fournisseur_photos">
							</div>
                                                        <div class="field">
                                                                <input type="hidden" name="update_fournisseur_logo" id="update_fournisseur_logo">
                                                        </div>
							<div class="field">
								<label>Priorité du fournisseur (entre 1 et 5, selon le placement sur la page d\'accueil : un fournisseur de priorité 1 sera dans le bloc le plus à gauche de la page d\'accueil, tandis qu\'un fournisseur de priorité 5 sera dans le bloc le plus à droite)</label>
								<input type="number" min="1" max="5" name="update_fournisseur_priorite" id="update_fournisseur_priorite">
							</div>
						<label>Logo du fournisseur</label>
						<form action="/file-upload" class="dropzone" id="dropzone_logo_update"></form>
						<label>Catalogue</label>
						<form action="/file-upload" class="dropzone" id="dropzone_catalogues_update"></form>
						<label>Catalogue des tarifs</label>
						<form action="/file-upload" class="dropzone" id="dropzone_catalogues_tarifs_update"></form>
						<label>Photos</label>
						<form action="/file-upload" class="dropzone" id="dropzone_photos_fournisseurs_update"></form>
						<div class="field">
								<button id="update_fournisseur" class="ui button large fluid blue">Modifier ce fournisseur</button>
							</div>
					</div>
					
				</div>
			</div>
		</div>';




		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////	Partie Projets 	//////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////



		echo'
		<div class="ui bottom attached tab segment" style="text-align:center;" data-tab="Projets">
			<div class="ui main container">
				<div class="column ten wide form-holder">
					<h1>Gestion des projets et références</h1>
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Ajouter un nouveau projet</h2>
					<div class="ui form">
							<div class="field">
								<label>Nom du projet</label>
								<input type="text" required placeholder="Projet Réverie" name="add_projet_nom" id="add_projet_nom">
							</div>
							<div class="field">
								<label>Adresse du projet</label>
								<input type="text" placeholder="27, rue du Léon, 29200 Brest" name="add_projet_adresse" id="add_projet_adresse">
							</div>
							<div class="field">
								<label>Description du projet</label>
								<textarea placeholder="27, rue du Léon, 29200 Brest" name="add_projet_description" id="add_projet_description" rows="3"></textarea>
							</div>
							<div class="field">
								<input type="hidden" name="add_projet_photos" id="add_projet_photos">
							</div>
						<label>Photos du projet</label>
						<form action="/file-upload" class="dropzone" id="dropzone_photos_projets_add"></form>
						<div class="field">
							<button id="add_projet" class="ui button large fluid green">Ajouter un nouveau projet</button>
						</div>
					</div>
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Supprimer un projet</h2>
					<div class="ui form">
						<form method="post" action="admin.php">
							<div class="field">
								<label>Projets</label>
								<select class="ui search dropdown" id="del_projet_id" name="del_projet_id">
									';

									$projets = recupProjets();
									foreach ($projets as $projet) {
										echo('<option value="'.$projet['id'].'">'.$projet['nom'].'</option>');
									}
									echo '
								</select>
							</div>
						</form>
						<div class="field">
							<button id="del_projet" class="ui button large fluid red">Supprimer ce projet</button>
						</div>
					</div>
					
				</div>
				<div class="column ten wide form-holder">
					<h2 class="center aligned header form-head" style="color:black;">Modifier un projet</h2>
					<div class="ui form">
						<div class="field">
							<label>Projets</label>
							<p>Veuillez sélectionner le projet à modifier</p>
							<select class="ui search dropdown" id="update_projet_id" name="update_projet_id">
									';

									$projets = recupProjets();
									foreach ($projets as $projet) {
										echo('<option value="'.$projet['id'].'">'.$projet['nom'].'</option>');
									}
									echo '
							</select>

						</div>
						<div class="field">
							<label>Nom du projet</label>
							<input type="text" required placeholder="Projet Réverie" name="update_projet_nom" id="update_projet_nom">
						</div>
						<div class="field">
							<label>Adresse du projet</label>
							<input type="text" placeholder="27, rue du Léon, 29200 Brest" name="update_projet_adresse" id="update_projet_adresse">
						</div>
						<div class="field">
							<label>Description du projet</label>
							<textarea placeholder="27, rue du Léon, 29200 Brest" name="update_projet_description" id="update_projet_description" rows="3"></textarea>
						</div>
						<div class="field">
							<input type="hidden" name="update_projet_photos" id="update_projet_photos">
						</div>
						<label>Photos du projet</label>
						<form action="/file-upload" class="dropzone" id="dropzone_photos_projets_update"></form>
						<div class="field">
							<button value="" id="update_projet" class="ui button large fluid blue">Modifier ce projet</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>';

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////       Partie Actualités et sur-mesure 	////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


		echo'<div class="ui bottom attached tab segment" style="text-align:center;" data-tab="surmesure">
				<div class="ui main container">
					<div class="column ten wide form-holder">
						<h1>Gestion des actualités et du sur-mesure</h1>
					</div>
					<div class="column ten wide form-holder">
						<h2 class="center aligned header form-head" style="color:black;">Ajouter une actualité</h2>
						<div class="ui form">
							<div class="field">
								<label>Titre de l\'actualité</label>
								<input type="text" required placeholder="Nouveau séminaire !" name="add_actualite_titre" id="add_actualite_titre">
							</div>
							<div class="field">
								<label>Actualité</label>
								<textarea placeholder="27, rue du Léon, 29200 Brest" name="add_actualite_description" id="add_actualite_description" rows="3"></textarea>
							</div>
							<div class="field">
								<input type="hidden" name="add_actualite_photo" id="add_actualite_photo">
							</div>
							<label>Photos de l\'actualité</label>
							<form action="/file-upload" class="dropzone" id="dropzone_photos_actualite_add"></form>
							<div class="field">
								<button id="add_actualite" class="ui button large fluid green">Ajouter une nouvelle actualité</button>
							</div>
						</div>
						
					</div>
					<div class="column ten wide form-holder">
						<h2 class="center aligned header form-head" style="color:black;">Supprimer une actualité</h2>
						<div class="ui form">
							<form method="post" action="admin.php">
								<div class="field">
									<label>Projets</label>
									<select class="ui search dropdown" id="del_actualite_id" name="del_actualite_id">
										';

										$actualites = recupActualites();
										foreach ($actualites as $actualite) {
											echo('<option value="'.$actualite['id'].'">'.$actualite['titre'].'</option>');
										}
										echo '
									</select>
								</div>
							</form>
							<div class="field">
								<button id="del_actualite" class="ui button large fluid red">Supprimer cette actualité</button>
							</div>
						</div>
						
					</div>
					<div class="column ten wide form-holder">
						<h2 class="center aligned header form-head" style="color:black;">Ajouter des photos de sur-mesure</h2>
						<div class="ui form">
							<div class="field">
								<input type="hidden" name="add_surmesure_photos" id="add_surmesure_photos">
							</div>
							<label>Photos du Sur-Mesure</label>
							<form action="/file-upload" class="dropzone" id="dropzone_photos_surmesure_add"></form>
							<div class="field">
								<button id="add_surmesure" class="ui button large fluid green">Ajouter de nouvelles photos au sur-mesure</button>
							</div>
						</div>
						
					</div>
					<div class="column ten wide form-holder">
						<h2 class="center aligned header form-head" style="color:black;">Supprimer les photos sur le Sur-Mesure</h2>
							<div class="field">
								<button id="del_surmesure" class="ui button large fluid red">Supprimer toutes les photos de sur-mesure</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			';
	}
	else{
		echo'
		<div class="ui raised very padded text segment form-holder-connexion marge">
			<div class="ui one column center aligned grid mid">
				<div class="column connexion wide">
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
			</div>
		</div>';


				if(!empty($_POST["id"]) && !empty($_POST["mdp"])){
					echo'<div class="ui raised very padded text segment form-holder red-admin">Les informations rentrées n\'ont pas permis de vous authentifier.</div>';
				}

	}

?>
	

	<script type="text/javascript">
		$( document ).ready(function() {
			$('.ui.checkbox').checkbox();
			$('select.dropdown')
				.dropdown()
			;
			$('.menu .item').tab();
			Dropzone.autoDiscover = false;
			//Dropzones ajout de fournisseur
			myDropzone = new Dropzone("#dropzone_catalogues_add", { 
				url: "../php/upload_admin_catalogues_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload du catalogue du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_fournisseur_catalogue").val($("#add_fournisseur_catalogue").val()+response);
					}
				}
			});

			myDropzone2 = new Dropzone("#dropzone_catalogues_tarifs_add", { 
				url: "../php/upload_admin_catalogues_tarifs_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload du catalogue de tarifs du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_fournisseur_catalogue_tarifs").val($("#add_fournisseur_catalogue_tarifs").val()+response);
					}
				}
			});

			myDropzone3 = new Dropzone("#dropzone_logo_add", { 
				url: "../php/upload_admin_logo_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des logos du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_fournisseur_logo").val($("#add_fournisseur_logo").val()+response);
					}
				}
			});

			myDropzone4 = new Dropzone("#dropzone_photos_fournisseurs_add", { 
				url: "../php/upload_admin_photos_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_fournisseur_photos").val($("#add_fournisseur_photos").val()+response);
					}
				}
			});

			
			//Dropzone Update de fournisseurs
			myDropzone5 = new Dropzone("#dropzone_catalogues_update", { 
				url: "../php/upload_admin_catalogues_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload du catalogue du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#update_fournisseur_catalogue").val($("#update_fournisseur_catalogue").val()+response);
					}
				}
			});

			myDropzone6 = new Dropzone("#dropzone_catalogues_tarifs_update", { 
				url: "../php/upload_admin_catalogues_tarifs_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload du catalogue de tarifs du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#update_fournisseur_catalogue_tarifs").val($("#update_fournisseur_catalogue_tarifs").val()+response);
					}
				}
			});

			myDropzone7 = new Dropzone("#dropzone_logo_update", { 
				url: "../php/upload_admin_logo_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des logos du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#update_fournisseur_logo").val($("#update_fournisseur_logo").val()+response);
					}
				}
			});

			myDropzone8 = new Dropzone("#dropzone_photos_fournisseurs_update", { 
				url: "../php/upload_admin_photos_fournisseurs.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos du fournisseur",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#update_fournisseur_catalogue").val($("#update_fournisseur_catalogue").val()+response);
					}
				}
			});

			//Dropzone ajout de projets
			myDropzone9 = new Dropzone("#dropzone_photos_projets_add", { 
				url: "../php/upload_admin_photos_projets.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos du projet",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_projet_photos").val($("#add_projet_photos").val()+response);
					}
				}
			});


			//Dropzone update de projets
			myDropzone10 = new Dropzone("#dropzone_photos_projets_update", { 
				url: "../php/upload_admin_photos_projets.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos du projet",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#update_projet_photos").val($("#update_projet_photos").val()+response);
					}
				}
			});

			//Dropzone Actualités
			myDropzone12 = new Dropzone("#dropzone_photos_actualite_add", { 
				url: "../php/upload_admin_photos_actualites.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos de l'actualité",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_actualite_photo").val($("#add_actualite_photo").val()+response);
					}
				}
			});

			//Dropzone Sur-Mesure
			myDropzone13 = new Dropzone("#dropzone_photos_surmesure_add", { 
				url: "../php/upload_admin_photos_sur_mesure.php", 
				success : function(file, response){
					if(response.includes("Erreur: ")){
						swal({
							title: "Erreur lors de l'upload des photos du sur-mesure",
							text: response,
							type: "error"
						});
					}
					else{
				   		$("#add_surmesure_photos").val($("#add_surmesure_photos").val()+response);
					}
				}
			});

		});

		$(document).ready(function(){


                        $("#update_projet_id").change(function() {
                                $.post(
                                                '../php/recup_projet.php',
                                                {

                                                        id : $("#update_projet_id").val()

                                                },
                                                function(data){
                                                        console.log(data);
                                                        console.log("test");
                                                        true_data = data.split("}");
                                                        console.log(true_data);
                                                        true_data[0] = encode_utf8(true_data[0]) + '}';
                                                        json    = JSON.parse(true_data[0]);
                                                        if(json.success){
                                                                $("#return_update_projet_div").css("backgroundColor", "rgba(0,255,0,0.3)");
                                                                $("#update_projet_id").val(json.id);
                                                                $("#update_projet_nom").val(json.nom);
                                                                $("#update_projet_adresse").val(json.adresse);
                                                                $("#update_projet_description").val(json.description);
                                                                $("#update_projet_photos").val(json.images);
                                                        }
                                                        else{
                                                                $("#return_update_projet_div").css("backgroundColor", "rgba(255,0,0,0.3)");
                                                        }
                                                        $("#return_update_projet_para").text(json.msg);
                                                        $("#return_update_projet_div").css("height", "150px");
                                                        setTimeout(function(){$("#return_update_projet_div").css("height", "0px")}, 10000);
                                                },
                                                "text"
                                      );
                        });




			 $("#update_fournisseur_id").change(function() {
                                $.post(
                                                '../php/recup_fournisseur.php',
                                                {

                                                        id : $("#update_fournisseur_id").val()

                                                },
                                                function(data){
                                                        console.log(data);
                                                        true_data = data.split("}");
                                                        console.log(true_data);
                                                        true_data[0] = encode_utf8(true_data[0]) + '}';
                                                        json    = JSON.parse(true_data[0]);
                                                        if(json.success){
                                                                $("#return_update_fournisseur_div").css("backgroundColor", "rgba(0,255,0,0.3)");
                                                                $("#update_fournisseur_id").val(json.id);
                                                                $("#update_fournisseur_nom").val(json.nom);
                                                                $("#update_fournisseur_url").val(json.url);
                                                                $("#update_fournisseur_logo").val(json.logo);
                                                                $("#update_fournisseur_catalogue").val(json.catalogue);
                                                                $("#update_fournisseur_catalogue_tarifs").val(json.catalogue_tarifs);
                                                                $("#update_fournisseur_photos").val(json.images);
                                                                $("#update_fournisseur_priorite").val(json.priorite);
                                                        }
                                                        else{
                                                                $("#return_update_fournisseur_div").css("backgroundColor", "rgba(255,0,0,0.3)");
                                                        }
                                                        $("#return_update_fournisseur_para").text(json.msg);
                                                        $("#return_update_fournisseur_div").css("height", "50px");
                                                        $("#return_update_fournisseur_div").css("margin", "auto");
                                                        setTimeout(function(){$("#return_update_fournisseur_div").css("height", "0px");$("#return_update_fournisseur_para").text("");}, 10000);
                                                },
                                                'text'
                                        );
                        });





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
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#add_admin_id").val('');
							$("#add_admin_mdp").val('');
							swal({
								title: "Administrateur ajouté !",
								text: json.msg,
								type: "success"
							});
							$("#del_admin_id").append('<option value="'+json.admin_id+'">'+json.admin_id+'</option>');
						}
						else{
							swal({
								title: "Erreur lors de l'ajout de cet administrateur !",
								text: json.msg,
								type: "error"
							});
						}
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
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#del_admin_id").val('');
							swal({
								title: "Administrateur supprimé !",
								text: json.msg,
								type: "success"
							});
							$("#del_admin_id option:selected").remove();
						}
						else{
							swal({
								title: "Erreur lors de la suppression de cet administrateur !",
								text: json.msg,
								type: "error"
							});
						}
					},
					'text' 
				);
			});

			$("#update_admin").click(function(){
				if($("#update_admin_mdp").val() == $("#update_admin_mdp2").val()){
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
							json	= JSON.parse(true_data[0]);
							if(json.success){
								$("#update_admin_id").val('');
								$("#update_admin_mdp").val('');
								$("#update_admin_old_mdp").val('');
								swal({
									title: "Mot de passe changé avec succés !",
									text: json.msg,
									type: "success"
								});
							}
							else{
								swal({
									title: "Erreur lors de la modification de votre mot de passe !",
									text: json.msg,
									type: "error"
								});
							}
						},
						'text' 
					);
				}
				else{
					$("#return_update_admin_div").css("backgroundColor", "rgba(255,0,0,0.3)");
					$("#return_update_admin_para").text("Les deux mots de passe doivent correspondre.");
					$("#return_update_admin_div").css("height", "150px");
					setTimeout(function(){$("#return_update_admin_div").css("height", "0px")}, 10000);
				}
			});

			$("#add_fournisseur").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						add_fournisseur_nom : $("#add_fournisseur_nom").val(),
						add_fournisseur_url : $("#add_fournisseur_url").val(),
						add_fournisseur_catalogue : $("#add_fournisseur_catalogue").val(),
						add_fournisseur_catalogue_tarifs : $("#add_fournisseur_catalogue_tarifs").val(),
						add_fournisseur_logo : $("#add_fournisseur_logo").val(),
						add_fournisseur_photos : $("#add_fournisseur_photos").val(),
						add_fournisseur_priorite : $("#add_fournisseur_priorite").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#return_add_fournisseur_div").css("backgroundColor", "rgba(0,255,0,0.3)");
							$("#add_fournisseur_nom").val('');
							$("#add_fournisseur_url").val('');
							$("#add_fournisseur_catalogue").val('');
							$("#add_fournisseur_catalogue_tarifs").val('');
							$("#add_fournisseur_logo").val('');
							$("#add_fournisseur_photos").val('');
							$("#add_fournisseur_priorite").val('');
							myDropzone.removeAllFiles();
							myDropzone2.removeAllFiles();
							myDropzone3.removeAllFiles();
							myDropzone4.removeAllFiles();
							swal({
								title: "Fournisseur ajouté avec succès",
								text: json.msg,
								type: "success"
							});
							$("#del_fournisseur_id").append('<option value="'+json.fournisseur_id+'">'+json.fournisseur_nom+'</option>');
							$("#update_fournisseur_id").append('<option value="'+json.fournisseur_id+'">'+json.fournisseur_nom+'</option>');
						}
						else{
							swal({
								title: "Erreur lors de l'ajout de ce fournisseur",
								text: json.msg,
								type: "error"
							});	
						}
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
						json	= JSON.parse(true_data[0]);
						if(json.success){
							swal({
								title: "Fournisseur effacé avec succès",
								text: json.msg,
								type: "success"
							});
							$("#del_fournisseur_id option:selected").remove();
							$("#update_fournisseur_id option[value='"+json.id+"']").remove();
						}
						else{
							swal({
								title: "Erreur lors de la suppression de ce fournisseur",
								text: json.msg,
								type: "error"
							});
							$("#del_fournisseur_id").val();
						}
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
						update_fournisseur_catalogue_tarifs : $("#update_fournisseur_catalogue_tarifs").val(),
						update_fournisseur_logo : $("#update_fournisseur_logo").val(),
						update_fournisseur_photos : $("#update_fournisseur_photos").val(),
						update_fournisseur_priorite : $("#update_fournisseur_priorite").val()
					},
					function(data){ 
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){

							$("#update_fournisseur_nom").val('');
							$("#update_fournisseur_url").val('');
							$("#update_fournisseur_catalogue").val('');
							$("#update_fournisseur_catalogue_tarifs").val('');
							$("#update_fournisseur_logo").val('');
							$("#update_fournisseur_photos").val('');
							$("#update_fournisseur_priorite").val('');
							$("#del_fournisseur_id option[value='"+json.id+"']").text(json.nom);
							$("#update_fournisseur_id option[value='"+json.id+"']").text(json.nom);
							myDropzone5.removeAllFiles();
							myDropzone6.removeAllFiles();
							myDropzone7.removeAllFiles();
							myDropzone8.removeAllFiles();
							swal({
								title: "Fournisseur modifié avec succès",
								text: json.msg,
								type: "success"
							});
						}
						else{
							swal({
								title: "Erreur lors de la modification de ce fournisseur",
								text: json.msg,
								type: "error"
							});
						}
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
						add_projet_adresse : $("#add_projet_adresse").val(),
						add_projet_description : $("#add_projet_description").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#add_projet_photos").val('');
							$("#add_projet_nom").val('');
							$("#add_projet_adresse").val('');
							$("#add_projet_description").val('');
							alert(json.projet_id);
							$("#del_projet_id").append('<option value="'+json.projet_id+'">'+json.projet_nom+'</option>');
							$("#update_projet_id").append('<option value="'+json.projet_id+'">'+json.projet_nom+'</option>');
							myDropzone9.removeAllFiles();
							swal({
								title: "Projet ajouté avec succès",
								text: json.msg,
								type: "success"
							});
						}
						else{
							swal({
								title: "Erreur lors de l'ajout de ce projet",
								text: json.msg,
								type: "error"
							});
						}
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
						json	= JSON.parse(true_data[0]);
						if(json.success){
							swal({
								title: "Projet supprimé avec succès",
								text: json.msg,
								type: "success"
							});
							$("#del_projet_id option:selected").remove();
							$("#update_projet_id option[value='"+json.id+"']").remove();
						}
						else{
							swal({
								title: "Erreur lors de la suppression de ce projet",
								text: json.msg,
								type: "error"
							});
						}
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
						update_projet_description : $("#update_projet_description").val(),
						update_projet_photos : $("#update_projet_photos").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#update_projet_nom").val('');
							$("#update_projet_adresse").val('');
							$("#update_projet_description").val('');
							$("#update_projet_photos").val('');
							$("#del_projet_id option[value='"+json.id+"']").text(json.nom);
							$("#update_projet_id option[value='"+json.id+"']").text(json.nom);
							myDropzone10.removeAllFiles();
							swal({
								title: "Projet modifié avec succès",
								text: json.msg,
								type: "success"
							});
						}
						else{
							swal({
								title: "Erreur lors de la modification de ce projet",
								text: json.msg,
								type: "error"
							});
						}
					},
					'text' 
				);
			});

			$("#add_actualite").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						add_actualite_titre : $("#add_actualite_titre").val(),
						add_actualite_description : $("#add_actualite_description").val(),
						add_actualite_photo : $("#add_actualite_photo").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#add_actualite_titre").val('');
							$("#add_actualite_description").val('');
							$("#add_actualite_photo").val('');
							myDropzone12.removeAllFiles();
							swal({
								title: "Actualité ajoutée avec succès",
								text: json.msg,
								type: "success"
							});
							$("#del_actualite_id").append('<option value="'+json.actualite_id+'">'+json.actualite_titre+'</option>');
						}
						else{
							swal({
								title: "Erreur lors de l'ajout de cette actualité",
								text: json.msg,
								type: "error"
							});
						}
					},
					'text' 
				);
			});

			$("#del_actualite").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{

						del_actualite_id : $("#del_actualite_id").val()
						
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							swal({
								title: "Actualité supprimée avec succès",
								text: json.msg,
								type: "success"
							});
							$("#del_actualite_id option:selected").remove();
						}
						else{
							swal({
								title: "Erreur lors de la suppression de cette actualité",
								text: json.msg,
								type: "error"
							});
						}
					},
					'text' 
				);
			});

			$("#add_surmesure").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{
						add_surmesure_photos : $("#add_surmesure_photos").val()
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							$("#add_surmesure_photos").val('');
							myDropzone13.removeAllFiles();
							swal({
								title: "Photos de sur-mesure ajoutées avec succès",
								text: json.msg,
								type: "success"
							});
						}
						else{
							swal({
								title: "Erreur lors de l'ajout des photos de sur-mesure",
								text: json.msg,
								type: "error"
							});
						}
						},
					'text' 
				);
			});

			$("#del_surmesure").click(function(){

				$.post(
					'../php/upload_admin.php', 
					{
						del_surmesure: true
					},
					function(data){
						true_data = data.split("}");
						true_data[0] = encode_utf8(true_data[0]) + '}';
						json	= JSON.parse(true_data[0]);
						if(json.success){
							swal({
								title: "Sur-mesure ajouté avec succès",
								text: json.msg,
								type: "success"
							});
						}
						else{
							swal({
								title: "Erreur lors de la suppression des photos de sur-mesure",
								text: json.msg,
								type: "error"
							});
						}
					},
					'text' 
				);
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
