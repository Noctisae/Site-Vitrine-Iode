<?php

function getDB() {
	$dbHost = 'localhost';
	$db     = 'Iode';
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
	$query = $db->prepare('SELECT fichier FROM fournisseurs');
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
	update_RSS();
	return true;
}

function updateActualite($id,$titre,$texte,$images){
	$db = getDB();
	$query = $db->prepare("UPDATE Actualites SET Texte=?, Titre=?, Images=? WHERE ID=?");
	$query->execute(array($texte,$titre,$images,$id));
	update_RSS();
	return true;
}

function removeActualite($id){
	$db = getDB();
	$query = $db->prepare("DELETE FROM Actualites WHERE ID=?");
	$query->execute(array($id));
	update_RSS();
	return true;
}

function update_RSS(){
	$db = getDB();
	$query = $db->prepare("SELECT * FROM Actualites");
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

?>