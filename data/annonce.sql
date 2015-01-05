-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: depaulis.sql.free.fr
-- Generation Time: Dec 27, 2014 at 11:20 AM
-- Server version: 5.0.83
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `depaulis`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `idAnnonces` int(11) NOT NULL auto_increment,
  `email` varchar(250) NOT NULL,
  `baseUrl` varchar(500) NOT NULL,
  `idDerniereAnnonce` varchar(500) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `frequence` int(11) NOT NULL,
  `dateDerniereVerif` datetime NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY  (`idAnnonces`),
  UNIQUE KEY `idAnnonces` (`idAnnonces`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `annonce`
--

INSERT INTO `annonce` (`idAnnonces`, `idUser`, `domaine`, `baseUrl`, `idDerniereAnnonce`, `active`, `frequence`, `dateDerniereVerif`, `libelle`) VALUES
(1, 1, 'leboncoin', 'http://www.leboncoin.fr/annonces/offres/bretagne/?f=a&th=1&q=bistrot', 'http://www.leboncoin.fr/arts_de_la_table/98346814.htm?ca=6_s', 1, 2, '2012-04-28 10:50:04', 'Bistrot');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
