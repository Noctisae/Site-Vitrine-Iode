<?php
//Début de la procédure d'upload
session_start();
include_once("default.php");
error_log("Récupération du fournisseur demandé");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php'){
			error_log("On vient de la bonne URL");
			$temp = recupFournisseurId($_POST['id']);
			if(!empty($temp)){
				return json_encode(array('success' => 'true', 'id' => $temp['id'], 'nom' => $temp['nom'], 'url' => $temp['url'], 'logo' => $temp['logo'], 'catalogue' => $temp['catalogue'], 'catalogue_tarifs' => $temp['catalogue_tarifs'], 'images' => $temp['images']));
			}
			else{
				return json_encode('success' => 'false');
			}
			
		}
	}
}
?>