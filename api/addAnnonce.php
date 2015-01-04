<?php

require_once '../conf/conf.inc.php';

header('Content-Type: application/json');

$json = file_get_contents('php://input'); 
$body = json_decode($json,true);
// var_dump($body);
if (!empty($body)){

	// Connexion à la base de données
	if	(!($cxn = mysql_connect($DB['host'],$DB['username'],$DB['password']))){
		echo json_encode(array('message'=>'Technical error'));
		exit(0);
	}

	mysql_select_db($DB['dbname'],$cxn);

	try {
		$query = "insert into annonce (`baseUrl`, `active`, `frequence`, `libelle`, `email`) values 
									('".$body['url']."', 1, 1, '".$body['titre']."', '".$body['email']."')";
		// echo $query;
		$resultats = mysql_query($query,$cxn);
		// var_dump($resultats);
		$message = "Ok";
	} catch (Exception $e) {
		$message = "Erreur lors de la création de l'annonce ".$body;
	}

	echo json_encode(array('message' => $message));
}else{
	echo json_encode(array('message'=>'No body found'));
}
