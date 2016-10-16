<?php
ini_set ( 'max_execution_time', 1200);
session_start();
//Début de la procédure d'upload
error_log("Début de l'upload de fichier");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		error_log("On est authentifie");
		error_log($_SERVER['HTTP_REFERER']);
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php' | $_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php?PageSpeed=Off'){
			error_log("On est authentifie et on vient bien de la bonne adresse");
			if(!empty($_FILES))
			{
				$ds = DIRECTORY_SEPARATOR;

				$path = "/home/fanch/www/iode";

				$storeFolder = 'logos_fournisseurs';

				$nom_file = $_FILES['file']['name'];

				$tempFile = $_FILES['file']['tmp_name'];

				$infosfichier = pathinfo($_FILES['file']['name']);
				$extension_upload = strtolower($infosfichier['extension']);
				error_log("Définition des variables d'utilisation");
				if($nom_file != '')
				{
					$targetPath = $path . $ds. $storeFolder . $ds;

					$targetFile = $targetPath. $_FILES['file']['name'];

					// On vérifie l'extension du fichier
					$extensions_autorisees = array('gif', 'png','jpeg','jpg','bmp');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						error_log("Extension autorisée");
						//upload du fichier
						error_log($targetFile);
						if(move_uploaded_file($tempFile,$targetFile))
						{
							// Si upload OK alors on affiche le message de réussite
							error_log("fichier correctement uploadé");
							echo '..'.$ds.$storeFolder.$ds.$_FILES['file']['name'].';';				
						}
						else
						{
								//  erreur système
							echo 'Erreur: Un problème est survenu lors de l\'upload, merci de réessayer.';
						}
						
					}
					else
					{
						//  erreur pour l'extension
						echo 'Erreur: Votre fichier n\'a pas une extension valide !';
					}
				}
				else
				{
					// Sinon on affiche une erreur pour le champ vide
					echo 'Erreur: Veuillez sélectionner une image !';
				}
			}
		}
	}
}
?>