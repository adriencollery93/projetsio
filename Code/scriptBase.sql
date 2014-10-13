-- MySQL dump 10.10
--
-- Host: localhost    Database: projet_notes
-- ------------------------------------------------------
-- Server version	5.0.27-community-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE `classe` (
  `code_classe` varchar(8) NOT NULL,
  `lib_classe` varchar(50) default NULL,
  `effectif_classe` int(11) default NULL,
  PRIMARY KEY  (`code_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classe`
--

LOCK TABLES `classe` WRITE;
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` VALUES ('BTGIGDA','Bts Informatique de Gestion option d‚veloppeur',32),('BTSIGAR','Bts Informatique de Gestion option R‚seaux',32);
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseigner`
--

DROP TABLE IF EXISTS `enseigner`;
CREATE TABLE `enseigner` (
  `code_user` varchar(11) NOT NULL default '',
  `code_mat` int(4) NOT NULL default '0',
  PRIMARY KEY  (`code_user`,`code_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enseigner`
--

LOCK TABLES `enseigner` WRITE;
/*!40000 ALTER TABLE `enseigner` DISABLE KEYS */;
INSERT INTO `enseigner` VALUES ('edondelin',1),('edondelin',2);
/*!40000 ALTER TABLE `enseigner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE `evaluation` (
  `code_eval` int(8) NOT NULL,
  `lib_eval` varchar(120) default NULL,
  `date_eval` char(8) default NULL,
  `libplus_eval` varchar(255) default NULL,
  `coef_eval` int(11) default NULL,
  `code_mat` int(4) default NULL,
  PRIMARY KEY  (`code_eval`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

LOCK TABLES `evaluation` WRITE;
/*!40000 ALTER TABLE `evaluation` DISABLE KEYS */;
INSERT INTO `evaluation` VALUES (1,'Devoir 1 D‚veloppement','20070924','',2,1),(2,'TP1 D‚veloppement','20070927','',1,1),(3,'Devoir numéro 2','20071105','Devoir sur les fonctions et les procédures',2,1);
/*!40000 ALTER TABLE `evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE `matiere` (
  `code_mat` int(4) NOT NULL auto_increment,
  `lib_mat` varchar(50) default NULL,
  `code_classe` varchar(8) default NULL,
  PRIMARY KEY  (`code_mat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matiere`
--

LOCK TABLES `matiere` WRITE;
/*!40000 ALTER TABLE `matiere` DISABLE KEYS */;
INSERT INTO `matiere` VALUES (1,'DAIGL','BTSIGDA'),(2,'AMSI','BTSIGAR'),(3,'AMSI','BTSIGDA');
/*!40000 ALTER TABLE `matiere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE `resultat` (
  `code_eval` int(8) NOT NULL default '0',
  `code_user` varchar(11) NOT NULL default '',
  `note` float default NULL,
  PRIMARY KEY  (`code_eval`,`code_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultat`
--

LOCK TABLES `resultat` WRITE;
/*!40000 ALTER TABLE `resultat` DISABLE KEYS */;
INSERT INTO `resultat` VALUES (1,'dpascal',-1),(1,'fpichon',7),(1,'rstallman',13.5),(2,'dpascal',12),(2,'fpichon',6.5),(2,'rstallman',18),(3,'dpascal',5),(3,'fpichon',-1),(3,'rstallman',0);
/*!40000 ALTER TABLE `resultat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `code_user` varchar(11) NOT NULL,
  `nom_user` varchar(50) default NULL,
  `prenom_user` varchar(50) default NULL,
  `pass_user` char(8) default NULL,
  `code_classe` varchar(8) default NULL,
  PRIMARY KEY  (`code_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('dpascal','Pascal','David','pascalou','BTSIGDA'),('edondelin','Dondelinger','Eric','prof',''),('fpichon','Pichon','Fabrice','piche','BTSIGDA'),('rstallman','Stallman','Richard','gnugnurs','BTSIGDA');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2007-11-13 14:19:05
