<?php

class Annonce {
	
	/**
	 * Titre de l'annonce
	 * @var String
	 */
	var $_titre;

	/**
	 * Url de l'annonce 
	 * @var unknown_type
	 */
	var $_url;
	
	/**
	 * Date de création de l'annonce
	 * @var DateTime
	 */
	var $_date;
	
	/**
	 * Description de l'annonce
	 * @var String
	 */
	var $_description;
	
	/**
	 * Photo associée à l'annonce (url)
	 * @var String
	 */
	var $_photo;
	
	/**
	 * Prix
	 * @var String
	 */
	var $_prix;
	
	/**
	 * Catégorie
	 * @var String
	 */
	var $_categorie;
	
	/**
	 * Ville
	 * @var Ville
	 */
	var $_ville;
	
	/**
	 * Crée une annonce
	 * @param String $pTitre
	 * @param String $pUrl
	 * @param DateTime $pDate
	 * @param String $pDescription
	 * @param String $pPhoto
	 * @param String $pPrix
	 * @param String $pCategorie
	 * @param String $pVille
	 */
	public function __construct($pTitre, $pUrl, $pDate, $pDescription, $pPhoto, $pPrix, $pCategorie, $pVille){
		$this->_titre = $pTitre;
		$this->_url = $pUrl;
		$this->_description = $pDescription;
		$this->_date = $pDate;
		$this->_photo = $pPhoto;
		$this->_prix = $pPrix;
		$this->_categorie = $pCategorie;
		$this->_ville = $pVille;
	} 
	
	/**
	* @param String $url
	* @return Annonce
	*/
	public function setUrl($url)
	{
	    $this->_url = $url;
	    return $this;
	}
	 
	/**
	* @return String
	*/
	public function getUrl()
	{
	    return $this->_url;
	}

	/**
	* @return String
	*/
	public function getTitre()
	{
	    return $this->_titre;
	}

	/**
	* @return String
	*/
	public function getPhoto()
	{
	    return $this->_photo;
	}

	/**
	* @return String
	*/
	public function getPrix()
	{
	    return $this->_prix;
	}

	/**
	* @return String
	*/
	public function getDescription()
	{
	    return $this->_description;
	}

}