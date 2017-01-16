<?php
//Début de la procédure d'upload
session_start();
include_once("default.php");
error_log("Récupération du fournisseur demandé");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php'){
			error_log("On vient de la bonne URL");
                        error_log($_POST['id']);
			$temp = recupFournisseurId($_POST['id']);
	                error_log(implode(":",$temp));
         		if(!empty($temp)){
			    error_log("On a trouv� le fournisseur");	
                            $asap = json_encode(array('success' => 'true', 'id' => $temp['id'], 'nom' => $temp['nom'], 'url' => $temp['url'], 'logo' => $temp['logo'], 'catalogue' => $temp['catalogue'], 'catalogue_tarifs' => $temp['catalogue_tarifs'], 'images' => $temp['images'], 'priorite'  => $temp['priorite']));
                            error_log($asap);
                            echo $asap;
			}
			else{
                            error_log("On a pas trouv� le fournisseur");
			    echo json_encode(array('success' => 'false'));
			}
			
		}
	}
}
?>
