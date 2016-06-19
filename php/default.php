<?php
session_start();
function getDB() {
	$dbHost = 'localhost';
	$db	 = 'Iode';
	$dbUser = 'iode';
	$dbPass = 'iode29';

	$db = new PDO("mysql:host=$dbHost;port=3305;dbname=$db;charset=utf8", $dbUser, $dbPass);
	return $db;
}


function jsonSuccess($data) {
	return json_encode(array('success' => 1, 'data' => $data));
}

function jsonErr($errMsg) {
	return json_encode(array('success' => 0, 'errMsg' => $errMsg));
}


function recupCatalogues(){
	$db = getDB();
	$query = $db->prepare('SELECT Catalogue FROM fournisseurs');
	$query->execute();
	$temp = $query->fetchAll();
	return $temp;
}

function recupAdmins(){
	$db = getDB();
	$query = $db->prepare('SELECT identifiant FROM Admin');
	$query->execute();
	$temp = $query->fetchAll();
	return $temp;
}

function recupFournisseurs(){
	$db = getDB();
	$query = $db->prepare('SELECT Nom FROM Fournisseurs');
	$query->execute();
	$temp = $query->fetchAll();
	return $temp;
}

function recupProjets(){
	$db = getDB();
	$query = $db->prepare('SELECT ID,Nom FROM Projets');
	$query->execute();
	$temp = $query->fetchAll();
	return $temp;
}

function addFournisseurPrincipal($nom,$priorite,$catalogue,$URL,$images){
	$db = getDB();
	$query = $db->prepare("INSERT INTO Fournisseurs VALUES (?,?,?,?,?)");
	$query->execute(array($nom,$catalogue,$priorite,$URL,$images));
	return true;
}

function updateFournisseurPrincipal($ancien_nom,$nom,$priorite,$catalogue,$URL,$images){
	$db = getDB();
	$query = $db->prepare("UPDATE Fournisseurs SET Nom=?, Catalogue=?,Priorité=?, URL=?, Images=? WHERE Nom=?");
	$query->execute(array($nom,$priorite,$catalogue,$URL,$images,$ancien_nom));
	return true;
}

function removeFournisseurPrincipal($nom){
	$db = getDB();
	$query = $db->prepare("DELETE FROM Fournisseurs WHERE Nom=?");
	$query->execute(array($nom_principal));
	return true;
}


function addProjet($photos,$nom,$adresse){
	$db = getDB();
	$query = $db->prepare("INSERT INTO Projets (Photos,Nom,Adresse) VALUES (?,?,?)");
	$query->execute(array($photos,$nom,$adresse));
	return true;
}

function updateProjet($id,$photos,$nom,$adresse){
	$db = getDB();
	$query = $db->prepare("UPDATE Projets SET Photos=?, Nom=?, Adresse=? WHERE ID=?");
	$query->execute(array($photos,$nom,$adresse,$id));
	return true;
}

function removeProjet($id){
	$db = getDB();
	$query = $db->prepare("DELETE FROM Projets WHERE ID=?");
	$query->execute(array($id));
	return true;
}

function addActualite($titre,$texte,$images){
	$db = getDB();
	$query = $db->prepare("INSERT INTO Actualites (Date, Texte, Titre, Images) VALUES (?,?,?,?)");
	$query->execute(array(new DateTime(),$texte,$titre,$images));
	updateRSS();
	return true;
}

function updateActualite($id,$titre,$texte,$images){
	$db = getDB();
	$query = $db->prepare("UPDATE Actualites SET Texte=?, Titre=?, Images=? WHERE ID=?");
	$query->execute(array($texte,$titre,$images,$id));
	updateRSS();
	return true;
}

function removeActualite($id){
	$db = getDB();
	$query = $db->prepare("DELETE FROM Actualites WHERE ID=?");
	$query->execute(array($id));
	updateRSS();
	return true;
}

function updateRSS(){
	$db = getDB();
	$query = $db->prepare("SELECT * FROM Actualites ORDER BY Date Asc");
	$query->execute();
	$temp = $query->fetchAll();
	$chaine_xml = '<?xml version="1.0" encoding="UTF-8"?>
					<rss version="2.0">
					<channel>

						<title>Agence Iode</title>
						<link>http://agenceiode.com</link>
						<description>Les news de l\'agence iode</description>';

	foreach ($temp as $actualite) {
		$chaine_xml .= '
		<item>
			<title>'.$actualite['Titre'].'</title>
			<link>http://www.agenceiode.com/equipe.php</link>
			<guid isPermaLink="true">http://www.agenceiode.com/equipe.php</guid>
			<description>'.$actualite['Texte'].'</description>
			<pubDate>'.$actualite['Date'].'</pubDate>
		</item>';
	}

	$chaine_xml .= '</channel></rss>';

	$file = fopen('news.xml', 'w+'); 
	fwrite($file, $chaine_xml);
	fclose($file);
}

function isAdmin($id, $mdp){
	$db = getDB();
	$query = $db->prepare("SELECT mdp FROM Admin WHERE identifiant=?");
	$query->execute(array($id));
	$temp = $query->fetch();
	error_log('On a recup les infos');
	if(!empty($temp)){
		error_log($temp["mdp"]);
		if(password_verify($mdp, $temp['mdp'])){
			$_SESSION["authentifie"]=true;
			$_SESSION["identifiant"]=$id;
			return True;
		}
		else{
			return False;
		}
	}
	else{
		return False;
	}
}


//FONCTION D'AJOUT D'UN ADMIN DANS LA BASE
function addAdmin($identifiant,$mdp){
	$db = getDB();
	$mdp = password_hash($mdp,PASSWORD_DEFAULT);
	$query = $db->prepare("INSERT INTO Admin VALUES(?,?)");
	$query->execute(array($identifiant,$mdp));
	return true;
}

//FONCTION DE SUPPRESSION D'UN ADMIN DANS LA BASE
function supprAdmin($identifiant){
	$db = getDB();
	$query = $db->prepare("DELETE FROM Admin WHERE identifiant=?");
	$query->execute(array($identifiant));
	return true;
}

//FONCTION DE CHANGEMENT DE MOT DE PASSE POUR L'ADMINISTRATEUR COURANT
function modifMDP($identifiant, $mdp, $oldMDP){
	$db = getDB();
	$query = $db->prepare("SELECT mdp FROM Admin WHERE identifiant=?");
	$query->execute(array($identifiant));
	$query->store_result();
	$query->bind_result($hash);
	$query->fetch();
	if(password_verify($oldMDP, $hash)){
		$mdp = password_hash($mdp,PASSWORD_DEFAULT);
		$query = $db->prepare("UPDATE Admin SET mdp=? WHERE identifiant=?");
		$query->execute(array($mdp,$identifiant));
		return true;
	}
	return false;
}



function recupFournisseur($place){
	$db = getDB();
	$query = $db->prepare("SELECT nom,image FROM fournisseurs_principaux WHERE priorite=?");
	$query->execute(array($place));
	$temp = $query->fetch();
	$query = $db->prepare("SELECT nom,url,logo,catalogue_tarifs,catalogue,images FROM fournisseurs_secondaires WHERE fournisseur_principal=?");
	$query->execute(array($temp["nom"]));
	$temp2 = $query->fetchAll();
	$final["principal"] = $temp;
	$final["secondaires"] = $temp2;
	return $final;
}

?>