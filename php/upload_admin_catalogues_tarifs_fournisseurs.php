<?php
//Début de la procédure d'upload
session_start();
error_log("On arrive au moins ici");
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php' | $_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php?PageSpeed=Off'){
			error_log("On vient de la bonne URL");

			if(!empty($_FILES))
			{
				error_log("Un fichier a été recu");

				$ds = DIRECTORY_SEPARATOR;

				$path = "/home/fanch/www/iode";

				$storeFolder = 'catalogues_tarifs';

				$nom_file = $_FILES['file']['name'];

				$tempFile = $_FILES['file']['tmp_name'];

				$infosfichier = pathinfo($_FILES['file']['name']);
				$extension_upload = $infosfichier['extension'];

				error_log("On récupère les infos du fichier");

				if($nom_file != '')
				{

					error_log("On vérifie le nom du fichie");

					$targetPath = $path . $ds. $storeFolder . $ds;

					$targetFile = $targetPath. $_FILES['file']['name'];

					// On vérifie l'extension du fichier
					$extensions_autorisees = array('pdf','doc','docx');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						error_log("On essaie d'uploader le fichier");

						//upload du fichier
						if(move_uploaded_file($tempFile,$targetFile))
						{
							// Si upload OK alors on affiche le message de réussite
							error_log("fichier correctement uploadé");
							echo '.'.$ds.$storeFolder.$ds.$_FILES['file']['name'].';';				
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