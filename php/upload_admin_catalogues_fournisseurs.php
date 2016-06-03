<?php
//Début de la procédure d'upload
error_log("On arrive au moins ici");

if($_SERVER['HTTP_REFERER'] == 'https://francoistoquer.com/iode/views/admin.php'){
	error_log("On vient de la bonne URL");

	if(!empty($_FILES))
	{
		error_log("Un fichier a été recu");

		$ds = DIRECTORY_SEPARATOR;

		$storeFolder = 'catalogues';

		$nom_file = $_FILES['file']['name'];

		$tempFile = $_FILES['file']['tmp_name'];

		$infosfichier = pathinfo($_FILES['file']['name']);
		$extension_upload = $infosfichier['extension'];

		error_log("On récupère les infos du fichier");

		if($nom_file != '')
		{

			error_log("On vérifie le nom du fichie");

			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

			$targetFile = $targetPath. $_FILES['file']['name'];

			// On vérifie l'extension du fichier
			$extensions_autorisees = array('gif', 'png','jpeg','jpg','bmp');
			if (in_array($extension_upload, $extensions_autorisees))
			{
				error_log("On essaie d'uploader le fichier");

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
					echo 'Un problème est survenu lors de l\'upload, merci de réessayer.';
				}
				
			}
			else
			{
				//  erreur pour l'extension
				echo 'Votre fichier n\'a pas une extension valide !';
			}
		}
		else
		{
			// Sinon on affiche une erreur pour le champ vide
			echo 'Veuillez sélectionner une image !';
		}
	}
}
?>