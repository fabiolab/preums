<?php

abstract class ListeAnnonces {
	
	/**
	 * Domaine
	 * @var String
	 */
	var $_domaine;
	
	/**
	 * Url contenant la liste des annonces
	 * @var String
	 */
	var $_baseUrl;
	
	/**
	 * Identifiant de la dernière annonce récupérée
	 * (peut être un id, une url, ...)
	 * @var String
	 */
	var $_idDerniereAnnonce;
	
	/**
	 * La liste d'annonces est-elle active ?
	 * (ie est-ce qu'on récupère les annonces ?)
	 * @var boolean
	 */
	var $_active;
	
	/**
	 * Fréquence de vérification des annonces
	 * @var Entier
	 */
	var $_frequence;
	
	/**
	 * Date de dernière vérification des annonces
	 * @var DateTime
	 */
	var $_dateDerniereVerif;
	
	/**
	 * Libellé associé à la liste d'annonces
	 * @var String
	 */
	var $_libelle;
	
	/**
	 * Récupère la liste des annonces publiées depuis la dernière visite sur la page de base
	 * 
	 * @return Une liste d'annonces (objet de la classe Annonce)
	 */
	public abstract function getDernieresAnnonces();
	
	/**
	* @param String $domaine
	* @return ListeAnnonces
	*/
	public function setDomaine($domaine)
	{
	    $this->_domaine = $domaine;
	    return $this;
	}
	 
	/**
	* @return String
	*/
	public function getDomaine()
	{
	    return $this->_domaine;
	}
	
	/**
	* @param String $baseUrl
	* @return ListeAnnonces
	*/
	public function setBaseUrl($baseUrl)
	{
	    $this->_baseUrl = $baseUrl;
	    return $this;
	}
	 
	/**
	* @return String
	*/
	public function getBaseUrl()
	{
	    return $this->_baseUrl;
	}
	
	/**
	* @param String $idDerniereAnnonce
	* @return ListeAnnonces
	*/
	public function setIdDerniereAnnonce($idDerniereAnnonce)
	{
	    $this->_idDerniereAnnonce = $idDerniereAnnonce;
	    return $this;
	}
	 
	/**
	* @return String
	*/
	public function getIdDerniereAnnonce()
	{
	    return $this->_idDerniereAnnonce;
	}
}