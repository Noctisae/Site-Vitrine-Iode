<?php
//Début de la procédure d'upload
session_start();
include_once("default.php");
error_log("Récupérationu  projet demandé");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php'){
			error_log("On vient de la bonne URL");
			error_log($_POST['id']);
                        $temp = recupProjetId($_POST['id']);
                        
			if(!empty($temp)){
                                error_log("On a trouve le projet");
				echo json_encode(array('success' => 'true', 'id' => $temp['id'], 'nom' => $temp['nom'], 'adresse' => $temp['adresse'], 'description' => $temp['description'], 'images' => $temp['photos']));
			}
			else{
                                error_log("pas de projet trouvé");
				echo json_encode(array('success' => 'false'));
			}
		}
	}
}
?>
