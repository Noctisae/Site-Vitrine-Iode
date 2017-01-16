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
	$query = $db->prepare('SELECT catalogue FROM Fournisseurs');
	$query->execute();
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupAdmins(){
	$db = getDB();
	$query = $db->prepare('SELECT identifiant FROM Admin');
	$query->execute();
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupFournisseurs(){
	$db = getDB();
	$query = $db->prepare('SELECT id,nom,priorite FROM Fournisseurs');
	$query->execute();
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupProjets(){
	$db = getDB();
	$query = $db->prepare('SELECT id,nom, adresse, photos, description FROM Projets');
	$query->execute();
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function addFournisseur($nom,$priorite,$url,$catalogue,$catalogue_tarifs,$images,$logo){
	$db = getDB();
	error_log($nom.$priorite.$url.$catalogue.$catalogue_tarifs.$images.$logo);
	$query = $db->prepare("INSERT INTO Fournisseurs(nom, priorite, url, catalogue, catalogue_tarifs, images, logo) VALUES (?,?,?,?,?,?,?)");
	$query->execute(array($nom,$priorite,$url,$catalogue,$catalogue_tarifs,$images,$logo));
	return true;
}

function updateFournisseur($id,$nom,$priorite,$url,$catalogue,$catalogue_tarifs,$images,$logo){
	$db = getDB();
	error_log("Affichage des variables recues");
	error_log($id);
	error_log($nom);
	error_log($priorite);
	error_log($url);
	error_log($catalogue);
	error_log($catalogue_tarifs);
	error_log($images);
	error_log($logo);
	$query = $db->prepare("UPDATE Fournisseurs SET nom=?, priorite=?, url=?, catalogue=?, catalogue_tarifs=?, images=?, logo=? WHERE id=?");
	$query->execute(array($nom,$priorite,$url,$catalogue,$catalogue_tarifs,$images,$logo,$id));
	return true;
}

function removeFournisseur($id){
	$db = getDB();
	$query = $db->prepare("SELECT images FROM Fournisseurs WHERE id=?");
	$query->execute(array($id));
	$temp = $query->fetchAll();

	$images = explode(";",$temp['images']);
	foreach ($images as $image) {
		$image = substr($image,3);
		$image_a_effacer = "/home/fanch/www/iode/" + $image;
		unlink($image_a_effacer);

	}
	$query = $db->prepare("DELETE FROM Fournisseurs WHERE id=?");
	$query->execute(array($id));
	return true;
}


function addProjet($nom,$adresse,$description,$photos){
	$db = getDB();
	$query = $db->prepare("INSERT INTO Projets (nom,adresse,description,photos) VALUES (?,?,?,?)");
	$query->execute(array($nom,$adresse,$description,$photos));
	return true;
}

function updateProjet($id,$nom,$adresse,$description,$photos){
	$db = getDB();
	$query = $db->prepare("UPDATE Projets SET nom=?, adresse=?, description=?, photos=? WHERE id=?");
	$query->execute(array($nom,$adresse,$description,$photos,$id));
	return true;
}

function removeProjet($id){
	$db = getDB();
	$query = $db->prepare("SELECT photos FROM Projets WHERE id=?");
	$query->execute(array($id));
	$temp = $query->fetch();

	$images = explode(";",$temp['photos']);
	foreach ($images as $image) {
		$image = substr($image,3);
		$image_a_effacer = "/home/fanch/www/iode/" + $image;
		unlink($image_a_effacer);

	}
	$query = $db->prepare("DELETE FROM Projets WHERE id=?");
	$query->execute(array($id));
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
			<title>'.$actualite['titre'].'</title>
			<link>http://www.agenceiode.com/equipe.php</link>
			<guid isPermaLink="true">http://www.agenceiode.com/equipe.php</guid>
			<description>'.$actualite['description'].'</description>
			<pubDate>'.$actualite['date'].'</pubDate>
		</item>';
	}

	$chaine_xml .= '</channel></rss>';

	$file = fopen('../views/news.xml', 'w+'); 
	fwrite($file, $chaine_xml);
	fclose($file);
	return true;
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
	$query = $db->prepare("SELECT id,nom,url,logo,catalogue,catalogue_tarifs,images FROM Fournisseurs WHERE priorite=?");
	$query->execute(array($place));
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupFournisseurId($id){
	$db = getDB();
	$query = $db->prepare("SELECT id,nom,url,logo,catalogue,catalogue_tarifs,images,priorite FROM Fournisseurs WHERE id=?");
	$query->execute(array($id));
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupFournisseurIdWithNameAndPhotos($nom, $photos){
	$db = getDB();
	$query = $db->prepare("SELECT id,nom,url,logo,catalogue,catalogue_tarifs,images FROM Fournisseurs WHERE nom=? AND images=?");
	$query->execute(array($nom,$photos));
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupProjetId($id){
	$db = getDB();
	$query = $db->prepare('SELECT id,nom,adresse,description,photos FROM Projets WHERE id=?');
	$query->execute(array($id));
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupProjetIdWithNameAndPhotos($nom,$photos){
	$db = getDB();
	$query = $db->prepare('SELECT id,nom,adresse,description,photos FROM Projets WHERE nom=? AND photos=?');
	$query->execute(array($nom,$photos));
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupActualites(){
	$db = getDB();
	$query = $db->prepare('SELECT id,date,titre,description,images FROM Actualites');
	$query->execute();
	$temp = $query->fetchAll();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupActualiteIdWithTitleAndPhotos($titre, $photos){
	$db = getDB();
	$query = $db->prepare("SELECT id,date,titre,description,images FROM Actualites WHERE titre=? AND images=?");
	$query->execute(array($titre,$photos));
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function recupSurMesure(){
	$db = getDB();
	$query = $db->prepare('SELECT images FROM Surmesure');
	$query->execute();
	$temp = $query->fetch();
	if(empty($temp)){
		$temp = [];
	}
	return $temp;
}

function addSurMesure($photos){
	$db = getDB();
	$temp = recupSurMesure();
	if(!empty($temp)){
		$temporaire = $photos . $temp[0];
		$query = $db->prepare('UPDATE Surmesure SET images=?');
		$query->execute(array($temporaire));
	}
	else{
		$query = $db->prepare('INSERT INTO Surmesure (images) VALUES (?)');
		$query->execute(array($photos));
	}
	return true;
}

function removeSurMesure(){
	$db = getDB();
	$query = $db->prepare("SELECT images FROM Surmesure");
	$query->execute(array($id));
	$temp = $query->fetchAll();

	$images = explode(";",$temp['images']);
	foreach ($images as $image) {
		$image = substr($image,3);
		$image_a_effacer = "/home/fanch/www/iode/" + $image;
		unlink($image_a_effacer);

	}
	$query = $db->prepare('DELETE FROM Surmesure');
	$query->execute();
	return true;
}

function delActualite($id){
	$db = getDB();
	$query = $db->prepare("SELECT images FROM Actualites WHERE id=?");
	$query->execute(array($id));
	$temp = $query->fetchAll();

	$images = explode(";",$temp['images']);
	foreach ($images as $image) {
		$image = substr($image,3);
		$image_a_effacer = "/home/fanch/www/iode/" + $image;
		unlink($image_a_effacer);

	}
	$query = $db->prepare('DELETE FROM Actualites WHERE id=?');
	$query->execute(array($id));
	updateRSS();
	return true;
}

function addActualite($titre,$description,$photos){
	$db = getDB();
	$query = $db->prepare('INSERT INTO Actualites (titre, date, description, images) VALUES (?,?,?,?) ');
	$date = new DateTime();
	error_log($date->getTimestamp());
	$query->execute(array($titre,$date->getTimestamp(),$description,$photos));
	updateRSS();
	return true;
}


?>
