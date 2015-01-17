<?php

require_once '../conf/conf.inc.php';
require_once 'LALeBonCoin.php';

function getAnnonces(){	
	global $DB;
 
	// Connexion à la base de données
	if	(!($cxn = mysql_connect($DB['host'],$DB['username'],$DB['password']))){
		trace("ERREUR","Impossible de se connecter au serveur de base de données");
		trace("ERREUR",'mysql:host='.$DB['host'].';dbname='.$DB['dbname'],$DB['username'],$DB['password']);
		exit(0);
	}

	mysql_select_db($DB['dbname'],$cxn);
	
	// Récupération des listes annonces triées par utilisateur
	$query = 'select * from annonce order by email';
	$resultats = mysql_query($query,$cxn);
 
	$idUserCourant='';
	$tsNow = mktime();
	$dateHeure = date('Y-m-d H:i:s',$tsNow);
 	while ($laCourante = mysql_fetch_array($resultats))
 	{
		if ($idUserCourant != $laCourante['email']){
			$idUserCourant = $laCourante['email'];
		}

		$tsLa = strtotime($laCourante['dateDerniereVerif']);
		// On ne vérifie les annonces que si la liste est active et qu'il s'est passé suffisamment de temps
		// depuis la dernière verif (ie : "frequence" heures depuis la dernière vérif )
		if ($laCourante['active'] && ($tsNow >= $tsLa + ($laCourante['frequence'] * 3500)))
		// if ($laCourante['active'] && ($tsNow >= $tsLa + 3600))
		{
			trace ('INFO', 'Traitement des annonces '.$laCourante['libelle'].' pour '.$laCourante['email']);
			// Récupération des annonces
			$laLbc = new LALeBonCoin();
			$laLbc->setBaseUrl($laCourante['baseUrl']);
			$laLbc->setIdDerniereAnnonce($laCourante['idDerniereAnnonce']);
			$annonces = $laLbc->getDernieresAnnonces();

			trace ('INFO', '    => '.count($annonces).' nouvelles annonce(s) depuis '.$laCourante['dateDerniereVerif']);

			// On continue seulement si on a récupéré des annonces
			// Mise à jour de la liste d'annonces
			if (count($annonces) > 0){
				$queryUpdate = "update annonce set idDerniereAnnonce = '{$annonces[0]->getUrl()}',dateDerniereVerif = '$dateHeure' where idAnnonces = {$laCourante['idAnnonces']}";
	 			mysql_query($queryUpdate,$cxn);

				$htmlMail = getHtml($annonces);
				
				// Création du mail
				mailTo('[preums] Annonces à '.$laCourante['libelle'], $htmlMail, $laCourante['email']);
			}else{
				// On ne met à jour que la date de verif
				$queryUpdate = "update annonce set dateDerniereVerif = '$dateHeure' where idAnnonces = {$laCourante['idAnnonces']}";
	 			mysql_query($queryUpdate,$cxn);

			}
		}else{
			trace('INFO', 'Aucune maj a remonter');
		}

		// On attend 5sec avant de parser une nouvelle page (histoire de pas se faire blacklister)
		sleep(5);
	}
	return $dateHeure;	
}

/**
 * Crée un description HTML d'une liste d'annonces
 * @param Liste d'Annonces $pAnnonces Liste d'objet de la classe Annonce
 * 
 * @return Une chaine de caractères contenant la description HTML des annonces de pAnnonces
 */
function getHtml($pAnnonces){
	$rHtml = '';
	foreach ($pAnnonces as $annonce){
		$rHtml .= '
		<div style="font-family: \'Nimbus Sans L\'; border-top: 1px solid #CCC; border-top-width:1px; border-top-style: solid; border-top-color: #CCC;">
			
			<div style="float:left; margin:5px;">
				<a href="'.$annonce->getUrl().'" target="_blank">
					<img src="'.$annonce->getPhoto().'" style="border: 2px solid black;border-radius: 30px;-moz-border-radius: 30px;-khtml-border-radius: 30px;-webkit-border-radius: 30px;" />
				</a>
			</div>
			<div style="float:left; ">
				<div style="font-size: 14px;font-weight: bold;margin:5px;">'.$annonce->getTitre().'</div>
				<div style="font-size: 18px;font-weight: bold;margin:5px;">'.$annonce->getPrix().'</div>
				<div style="margin:5px;">à '.$annonce->getVille().'</div>
			</div>
		</div>
		<div style="clear:both;"></div>';
	}
	return $rHtml;
}
	
function mailTo($pSujet, $pTexte, $pDest){

	$message_txt = "Message texte";
	$message_html = "<html><body>".$pTexte."</body></html>";

	// Boundary
	$boundary = "-----=".md5(rand());

	// Header.
	$header  = "From: \"Preums\"<fabio@fabiolab.fr>\n";
	$header .= "Reply-to: \"Preums\" <fabio@fabiolab.fr>\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/alternative;\n";
	$header .= "boundary=\"$boundary\"\n";

	// Corps du message.
	$message = "\n--".$boundary."\n";

	// Format texte.
	$message.= "Content-Type: text/plain; charset=\"UTF-8\"\n";
	$message.= "Content-Transfer-Encoding: 8bit\n";
	$message.= "\n$message_txt\n";

	$message.= "\n--$boundary\n";

	// Format HTML
	$message.= "Content-Type: text/html; charset=\"UTF-8\"\n";
	$message.= "Content-Transfer-Encoding: 8bit\n";
	$message.= "\n$message_html\n";

	$message.= "\n--$boundary--\n";
	$message.= "\n--$boundary--\n";

	// Envoi de l'e-mail.
	mail($pDest,$pSujet,$message,$header);
}

function trace($pNiveau, $pMessage){
	echo "[$pNiveau] - $pMessage \n";
}

?>
