<?php
/**
 * Gère la récupération des dernières annonces d'une page sur 'Le Bon Coin'
 * @author fabio
 */

require_once 'ListeAnnonces.php';
require_once 'Annonce.php';

class LALeBonCoin extends ListeAnnonces {

	/**
	 * Récupère la liste des annonces publiées depuis la dernière visite sur la page de base
	 *
	 * @return Une liste d'annonces (objet de la classe Annonce)
	 */
	public function getDernieresAnnonces(){
		// Liste des annonces a construire
		$rListeAnnonces = array();

		// Récupération de la page contenant les annonces
		$pageAnnonces = file_get_contents($this->getBaseUrl());

		// Création de l'objet DOM
		$dom = new DOMDocument();
		if (!@$dom->loadHTML($pageAnnonces)) {
			echo $pageAnnonces;
			echo "Impossible de charger les infos XML de la page ".$this->getBaseUrl()."\n";
			return $rListeAnnonces;
		}

		// Les annonces sont dans un div
		// <div class="list-ads">
		$xpath = new DOMXpath($dom);
		$listeAnnoncesDiv = $xpath->query("//div[@class='list-lbc']");
		if (!empty($listeAnnoncesDiv)){
			$listeAnnonces = $listeAnnoncesDiv->item(0)->getElementsByTagName('a');
			foreach ($listeAnnonces as $ligneAnnonce){
				$tAnnonce = $this->getAnnonce($ligneAnnonce);
				// On s'arrête si on retrouve la dernière annonce de la dernière visite
				if ($tAnnonce->getUrl() == $this->getIdDerniereAnnonce()){
					break;
				}
				$rListeAnnonces[] = $tAnnonce;
			}
		}
		return $rListeAnnonces;
	}

	/**
	 * Crée un objet de type annonce à partir d'un noeud 'a' contenant la description
	 * d'une annonce lbc
	 * @param DomElement $pAAnnonceNode
	 */
	private function getAnnonce($pAAnnonceNode){
		
		$tUrl = $pAAnnonceNode->getAttribute('href');
		
		// Récupération des div et traitement
		$listeDivAnnonce = $pAAnnonceNode->getElementsByTagName('div');
		foreach ($listeDivAnnonce as $divAnnonce){
			$class = $divAnnonce->getAttribute('class');
			if ($class == 'date'){
				$divDateListe = $divAnnonce->getElementsByTagName('div');
				foreach ($divDateListe as $divDate){
					$tDateTab[] = $divDate->nodeValue;
				}
				$tDate = implode(' ', $tDateTab);
			}
			if ($class == 'image'){
				$tTagImage = $divAnnonce->getElementsByTagName('img')->item(0);
				$tUrlImage = '';
				if (!empty($tTagImage)){
					$tUrlImage = $tTagImage->getAttribute('src');
				}
			}
			if ($class == 'detail'){
				$tDivList = $divAnnonce->getElementsByTagName('div');
				$tPrix = 0;
				foreach ($tDivList as $div){
					$classDiv = $div->getAttribute('class');
					if ($classDiv == 'title'){
						$tTitre = $div->nodeValue;
					}
					if ($classDiv == 'price'){
						$tPrix = $div->nodeValue;
					}
					if ($classDiv == 'category'){
						$tCategorie = $div->nodeValue;
					}
					if ($classDiv == 'placement'){
						$tVille = $div->nodeValue;
					}
				}
			}
		}

		$annonce = new Annonce(trim($tTitre), trim($tUrl), trim(str_replace('<br>', ' ', $tDate)), '', trim($tUrlImage), trim($tPrix), trim($tCategorie), trim($tVille));
		return $annonce;
	}

}