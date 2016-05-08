<?php


if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){

		//Gestion des administrateurs
		if(!empty($_POST['add_admin_id']) && !empty($_POST['add_admin_mdp'])){
			return json_encode(array('success' => addAdmin($_POST['add_admin_id'],$_POST['add_admin_mdp'])));
		}

		if(!empty($_POST['del_admin_id'])){
			return json_encode(array('success' => supprAdmin($_POST['del_admin_id'])));
		}

		if(!empty($_POST['update_admin_id']) && !empty($_POST['update_admin_mdp']) && !empty($_POST['update_admin_old_mdp'])){
			return json_encode(array('success' => modifMDP($_POST['update_admin_id'],$_POST['update_admin_mdp'],$_POST['update_admin_old_mdp'])));
		}

		//Gestion des fournisseurs
		if(!empty($_POST['add_fournisseur_nom']) && !empty($_POST['add_fournisseur_url'] && !empty($_POST['add_fournisseur_catalogue'] && !empty($_POST['add_fournisseur_photos']) && !empty($_POST['add_fournisseur_priorite'])){
			return json_encode(array('success' => addFournisseurPrincipal($_POST['add_fournisseur_nom'],$_POST['add_fournisseur_url'],$_POST['add_fournisseur_catalogue'],$_POST['add_fournisseur_photos'],$_POST['add_fournisseur_priorite'])));
		}

		if(!empty($_POST['del_fournisseur_id'])){
			return json_encode(array('success' => removeFournisseurPrincipal($_POST['del_fournisseur_id'])));
		}

		if(!empty($_POST['update_fournisseur_id']) && !empty($_POST['update_fournisseur_nom']) && !empty($_POST['update_fournisseur_url'] && !empty($_POST['update_fournisseur_catalogue'] && !empty($_POST['update_fournisseur_photos']) && !empty($_POST['update_fournisseur_priorite'])){
			return json_encode(array('success' => updateFournisseurPrincipal($_POST['update_fournisseur_id'],$_POST['update_fournisseur_nom'],$_POST['update_fournisseur_url'],$_POST['update_fournisseur_catalogue'],$_POST['update_fournisseur_photos'],$_POST['update_fournisseur_priorite'])));
		}


		//Gestion des projets
		if(!empty($_POST['add_projet_photos']) && !empty($_POST['add_projet_nom']) && !empty($_POST['add_projet_adresse'])){
			return json_encode(array('success' => addProjet($_POST['add_projet_photos'],$_POST['add_projet_nom'],$_POST['add_projet_adresse'])));
		}

		if(!empty($_POST['del_projet_id'])){
			return json_encode(array('success' => removeProjet($_POST['del_projet_id'])));
		}

		if(!empty($_POST['update_projet_id']) && !empty($_POST['update_projet_nom']) && !empty($_POST['update_projet_adresse'])&& !empty($_POST['update_projet_photos'])){
			return json_encode(array('success' => updateProjet($_POST['update_projet_id'],$_POST['update_projet_nom'],$_POST['update_projet_adresse'],$_POST['update_projet_photos'])));
		}


	}
	
}

?>