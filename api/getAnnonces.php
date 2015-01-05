<?php
require_once '../conf/conf.inc.php';

// Connexion à la base de données
if	(!($cxn = mysql_connect($DB['host'],$DB['username'],$DB['password']))){
	trace("ERREUR","Impossible de se connecter au serveur de base de données");
	trace("ERREUR",'mysql:host='.$DB['host'].';dbname='.$DB['dbname'],$DB['username'],$DB['password']);
	exit(0);
}
mysql_select_db($DB['dbname'],$cxn);

// Récupération des listes annonces triées par utilisateur
$query = 'select * from annonce order by email, libelle';
$resultats = mysql_query($query,$cxn);

$jsonRes = array();
while ($laCourante = mysql_fetch_array($resultats))
{
	$jsonRes[] = $laCourante;
}

header('Content-Type: application/json');
echo json_encode($jsonRes);
