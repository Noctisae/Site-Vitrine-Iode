<?php
session_start();
//Début de la procédure d'upload
if(!empty($_SESSION["authentifie"])){
	if($_SESSION["authentifie"]){
		if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php'){
			if(!empty($_FILES))
			{
				$ds = DIRECTORY_SEPARATOR;

				$storeFolder = 'photos_fournisseurs';

				$nom_file = $_FILES['file']['name'];

				$tempFile = $_FILES['file']['tmp_name'];

				$infosfichier = pathinfo($_FILES['file']['name']);
				$extension_upload = $infosfichier['extension'];

				if($nom_file != '')
				{
					$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

					$targetFile = $targetPath. $_FILES['file']['name'];

					// On vérifie l'extension du fichier
					$extensions_autorisees = array('gif', 'png','jpeg','jpg','bmp');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						//upload du fichier
						if(move_uploaded_file($tempFile,$targetFile))
						{
							// Si upload OK alors on affiche le message de réussite
							error_log("fichier correctement uploadé");
							return $targetFile;				
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