<?php

require_once '../conf/conf.inc.php';

header('Content-Type: application/json');

if (!empty($_GET['id'])){

	// Connexion à la base de données
	if	(!($cxn = mysql_connect($DB['host'],$DB['username'],$DB['password']))){
		echo json_encode(array('message'=>'Technical error'));
		exit(0);
	}

	mysql_select_db($DB['dbname'],$cxn);

	try {
		$query = 'delete from annonce where idAnnonces='.$_GET['id'];
		$resultats = mysql_query($query,$cxn);
		$message = "Ok";
	} catch (Exception $e) {
		$message = "Erreur lors de la suppression de ".$_GET['id'];
	}

	echo json_encode(array('message' => $message));
}else{
	echo json_encode(array('message'=>'No id'));
}
