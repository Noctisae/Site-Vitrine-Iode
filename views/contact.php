<!DOCTYPE html>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- Site Properties -->
	<title>Agence Iode</title>
	<link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="../semantic/dist/semantic.min.js"></script>

</head>
<body style="display:flex;">
<?php

include_once("header.php");
	/*
		********************************************************************************************
		CONFIGURATION
		********************************************************************************************
	*/
	// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
	$destinataire = 'contact@agenceiode.com';
	 
	// copie ? (envoie une copie au visiteur)
	$copie = 'non';
	 
	// Action du formulaire (si votre page a des paramètres dans l'URL)
	// si cette page est index.php?page=contact alors mettez index.php?page=contact
	// sinon, laissez vide
	$form_action = '';
	 
	// Messages de confirmation du mail
	$message_envoye = "Votre message nous est bien parvenu !";
	$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";
	 
	// Message d'erreur du formulaire
	$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
	 
	/*
		********************************************************************************************
		FIN DE LA CONFIGURATION
		********************************************************************************************
	*/
	 
	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
	 
		$text = nl2br($text);
		return $text;
	};
	 
	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}
	 
	// formulaire envoyé, on récupère tous les champs.
	$raison_sociale   = (isset($_POST['raison_sociale']))   ? Rec($_POST['raison_sociale'])   : '';
	$nom	 = (isset($_POST['nom']))	 ? Rec($_POST['nom'])	 : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$telephone   = (isset($_POST['telephone']))   ? Rec($_POST['telephone'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
	 
	// On va vérifier les variables et l'email ...
	$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
	$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin
	 
	if (isset($_POST['envoi']))
	{
		if (($nom != '') && ($email != '') && ($telephone != '') && ($message != '') && ($raison_sociale != ''))
		{
			$headers  = 'From:'.$nom.' ('.$raison_sociale.') <'.$email.'>' . "\r\n";
			//$headers .= 'Reply-To: '.$email. "\r\n" ;
			//$headers .= 'X-Mailer:PHP/'.phpversion();
	 
			// envoyer une copie au visiteur ?
			if ($copie == 'oui')
			{
				$cible = $destinataire.';'.$email;
			}
			else
			{
				$cible = $destinataire;
			};
	 
			// Remplacement de certains caractères spéciaux
			$message = str_replace("&#039;","'",$message);
			$message = str_replace("&#8217;","'",$message);
			$message = str_replace("&quot;",'"',$message);
			$message = str_replace('&lt;br&gt;','',$message);
			$message = str_replace('&lt;br /&gt;','',$message);
			$message = str_replace("&lt;","&lt;",$message);
			$message = str_replace("&gt;","&gt;",$message);
			$message = str_replace("&amp;","&",$message);
	 
			// Envoi du mail
			$num_emails = 0;
			$tmp = explode(';', $cible);
			foreach($tmp as $email_destinataire)
			{
				if (mail($email_destinataire, "Contact du site web : numéro ".$telephone, $message, $headers))
					$num_emails++;
			}
	 
			if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1)))
			{
				echo '<p>'.$message_envoye.'</p>';
			}
			else
			{
				echo '<p>'.$message_non_envoye.'</p>';
			};
		}
		else
		{
			// une des 3 variables (ou plus) est vide ...
			echo '<p>'.$message_formulaire_invalide.'</p>';
			$err_formulaire = true;
		};
	}; // fin du if (!isset($_POST['envoi']))
	 
	if (($err_formulaire) || (!isset($_POST['envoi'])))
	{
		echo'<div class="ui raised very padded text segment" style="margin:auto;height:800px;margin-top:150px;text-align:center">
			<div style="display:flex;flex-direction: column;height:80px;justify-content: space-between;font-family: "Swiss LT"!important;">
				<div style="display:flex;">
					<div style="margin:auto;"><b>Nathalie Jézéquel</b><br> 06 01 83 86 52</div>
					<div style="margin:auto;"><b>Olivier Morazé </b><br> 06 84 15 30 72</div>
				</div>
				<div style="display:flex;">
					<p style="text-decoration: underline;margin:auto;height:40px;"><b>contact@agenceiode.com</b></p>
				</div>
			</div>
			<form action="contact.php" method="post" class="ui form" style="height:100%;width:950px;text-align:left;">
				<div class="ui horizontal segments" style="height:540px;">
					<div class="ui segment" style="width:100%;">
						<div class="ui form" style="height:100%;">
							<div class="field" style="height:80%;padding-top:15px;text-align:center;">
								<label>Message</label>
								<textarea style="height:100%;" id="message" value="'.stripslashes($message).'" ></textarea>
							</div>
							<div class="ui submit button" style="width:100%;">Envoyer</div>
						</div>
					</div>
					<div class="ui segment" style="width:100%;">
						<div class="ui form">
							<div class="field" style="padding-top:75px;">
								<label>Raison Sociale *</label>
								<input placeholder="John" type="text" id="raison_sociale" value="'.stripslashes($raison_sociale).'" >
							</div>
							<div class="field">
								<label>Nom *</label>
								<input placeholder="Doe" type="text" id="nom" value="'.stripslashes($nom).'" >
							</div>
							<div class="field">
								<label>Email * </label>
								<input placeholder="john.doe@orange.fr" type="text" id="email" value="'.stripslashes($email).'" >
							</div>
							<div class="field">
								<label>Téléphone *</label>
								<input placeholder="06 00 00 00 00" type="text" id="telephone" value="'.stripslashes($telephone).'" >
							</div>
							<img src="../logos/logo iode.jpeg" style="position:absolute;top:0px;right:0px;width:90px;height:90px;">
						</div>
					</div>
				</div>
			</form>
		</div>';
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
	$('.right.menu.open').on("click",function(e){
	e.preventDefault();
	$('.ui.vertical.menu').toggle();
	});
	
	$('.ui.dropdown').dropdown();
});
</script>

<?php

include_once("footer.php");

?>
</body>
</html>
