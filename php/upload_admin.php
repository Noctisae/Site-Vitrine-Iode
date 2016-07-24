<?php
ini_set ( 'max_execution_time', 1200);
session_start();
include_once("default.php");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		//Gestion des administrateurs
		if(!empty($_POST['add_admin_id']) && !empty($_POST['add_admin_mdp'])){
			error_log();
			if(addAdmin($_POST['add_admin_id'],$_POST['add_admin_mdp'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Cet administrateur a bien ete ajoute !')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de l\'ajout de cet administrateur !')));
			}
		}

		if(!empty($_POST['del_admin_id'])){
			if(supprAdmin($_POST['del_admin_id'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Cet administrateur a bien ete supprime !')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la suppression de cet administrateur !')));
			}
			
		}

		if(!empty($_POST['update_admin_id']) && !empty($_POST['update_admin_mdp']) && !empty($_POST['update_admin_old_mdp'])){
			if(modifMDP($_POST['update_admin_id'],$_POST['update_admin_mdp'],$_POST['update_admin_old_mdp'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Votre mot de passe a bien ete modifie !')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors du changement de votre mot de passe')));
			}
			
		}

		//Gestion des fournisseurs
		if(!empty($_POST['add_fournisseur_nom']) && !empty($_POST['add_fournisseur_url']) && !empty($_POST['add_fournisseur_catalogue']) && !empty($_POST['add_fournisseur_photos']) && !empty($_POST['add_fournisseur_priorite']) && !empty($_POST['add_fournisseur_catalogue_tarifs']) && !empty($_POST['add_fournisseur_logo'])){
			if(addFournisseur($_POST['add_fournisseur_nom'],$_POST['add_fournisseur_priorite'],$_POST['add_fournisseur_url'],$_POST['add_fournisseur_catalogue'],$_POST['add_fournisseur_catalogue_tarifs'],$_POST['add_fournisseur_photos'],$_POST['add_fournisseur_logo'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce fournisseur a bien ete ajoute dans la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de l\'ajout de ce fournisseur dans la base de donnees')));			
			}

		}

		if(!empty($_POST['del_fournisseur_id'])){
			if(removeFournisseur($_POST['del_fournisseur_id'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce fournisseur a bien ete supprime de la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('une erreur s\'est produite lors de la suppression de ce fournisseur')));			
			}

		}

		if(!empty($_POST['update_fournisseur_id']) && !empty($_POST['update_fournisseur_nom']) && !empty($_POST['update_fournisseur_url']) && !empty($_POST['update_fournisseur_catalogue']) && !empty($_POST['update_fournisseur_photos']) && !empty($_POST['update_fournisseur_catalogue_tarifs']) && !empty($_POST['update_fournisseur_logo']) && !empty($_POST['update_fournisseur_priorite'])){
			if(updateFournisseur($_POST['update_fournisseur_id'],$_POST['update_fournisseur_nom'],$_POST['update_fournisseur_priorite'],$_POST['update_fournisseur_url'],$_POST['update_fournisseur_catalogue'],$_POST['update_fournisseur_catalogue_tarifs'],$_POST['update_fournisseur_photos'],$_POST['update_fournisseur_logo'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce fournisseur a bien ete modifie dans la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la modification de ce fournisseur')));
			}
			
		}


		//Gestion des projets
		if(!empty($_POST['add_projet_photos']) && !empty($_POST['add_projet_nom']) && !empty($_POST['add_projet_description']) && !empty($_POST['add_projet_adresse'])){
			if(addProjet($_POST['add_projet_nom'],$_POST['add_projet_adresse'],$_POST['add_projet_description'],$_POST['add_projet_photos'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce projet a bien ete ajoute dans la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de l\'ajout de ce projet dans la base de donnees')));
			}

		}

		if(!empty($_POST['del_projet_id'])){
			if(removeProjet($_POST['del_projet_id'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce projet a bien ete supprime de la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la suppression de ce projet')));
			}
			
		}

		if(!empty($_POST['update_projet_id']) && !empty($_POST['update_projet_nom']) && !empty($_POST['update_projet_adresse']) && !empty($_POST['update_projet_photos']) && !empty($_POST['update_projet_description'])){
			if(updateProjet($_POST['update_projet_id'],$_POST['update_projet_nom'],$_POST['update_projet_adresse'],$_POST['update_projet_description'],$_POST['update_projet_photos'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Ce projet a bien ete modifie dans la base de donnees')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la modification de ce projet')));
			}
		}

		if(!empty($_POST['del_surmesure'])){
			if(removeSurMesure()){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Les photos du sur-mesure ont bien été supprimées ! ')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la suppression des photos du sur-mesure')));
			}
			
		}

		if(!empty($_POST['add_surmesure_photos'])){
			if(addSurMesure($_POST['add_surmesure_photos'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Les photos du sur-mesure ont bien été mises à jour ! ')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de l\'ajout des photos du sur-mesure')));
			}
			
		}

		if(!empty($_POST['del_actualite_id'])){
			if(delActualite($_POST['del_actualite_id'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Cette actualité a bien été mise à jour !')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de la suppression de cette actualité !')));
			}
			
		}
		if(!empty($_POST['add_actualite_titre']) && !empty($_POST['add_actualite_description']) && !empty($_POST['add_actualite_photo'])){
			if(addActualite($_POST['add_actualite_titre'],$_POST['add_actualite_description'],$_POST['add_actualite_photo'])){
				echo json_encode(array('success' => true, 'msg' => utf8_encode('Cette actualité a bien été ajoutée !')));
			}
			else{
				echo json_encode(array('success' => false, 'msg' => utf8_encode('Une erreur s\'est produite lors de l\'ajout de cette actualité !')));
			}
		}
	}
	
}

?>