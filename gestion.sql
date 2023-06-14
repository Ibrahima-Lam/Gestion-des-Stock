-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestion
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `idArticle` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nomArticle` varchar(50) DEFAULT NULL,
  `prix_vente` decimal(10,0) DEFAULT 0,
  `description` text DEFAULT NULL,
  `idCategorie` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `fk_categorie` (`idCategorie`),
  CONSTRAINT `fk_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Ordinateur',10000,'ordinateur portable hp core i7',1),(15,'Telephone A10s',6000,'Telephone Samsung A10s',1),(16,'Iphone13',20000,'Iphone 13 americain',1),(17,'Machine toshiba',10000,'machine toshiba core i7',1),(18,'ipad',500,'ipad iphone',1),(21,'cream',120,'cream nivea',2),(22,'Sucre',200,'sac sucre 5kg',3),(23,'marteau',200,'marteau 5kg',6),(24,'tenaille',250,'tenaille de fil de fer',6),(25,'parfum',100,'parfum nova',2),(26,'bourrouette',300,'bourroute',6),(27,'cable',25,'cable electrique ingelec ',4),(28,'contact',10,'contact ingelec',4),(29,'pelle',250,'pelle',6),(30,'Lait en  poudre',250,'lait en poudre inco',3);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `idCategorie` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Eléctronique'),(2,'Cosmetique'),(3,'Nourriture'),(4,'Eléctrique'),(6,'Industrielle');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `idClient` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nomClient` varchar(50) DEFAULT NULL,
  `adresseClient` varchar(50) DEFAULT NULL,
  `telClient` varchar(12) DEFAULT NULL,
  `emailClient` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'amadou lam','basra, NKTT','41022382','lam@gmail.com'),(2,'med Sall','medina  3, NkTT',' 22241916418','med@gmail.com'),(3,'mamadou yatera','ilot k,NKtt','3354535432','yatera@gmail.fr');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `idCommande` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `dateCommande` date DEFAULT NULL,
  `delaiCommande` tinyint(3) unsigned DEFAULT 0,
  `idClient` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `fk_Client` (`idClient`),
  CONSTRAINT `fk_Client` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES (1,'2023-06-12',3,1),(2,'2023-06-11',4,2);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenir` (
  `idCommande` tinyint(3) unsigned DEFAULT NULL,
  `idArticle` tinyint(3) unsigned DEFAULT NULL,
  `quantite` tinyint(3) unsigned DEFAULT 0,
  KEY `fk_Commande_c` (`idCommande`),
  KEY `fk_Article_c` (`idArticle`),
  CONSTRAINT `fk_Article_c` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE SET NULL,
  CONSTRAINT `fk_Commande_c` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenir`
--

LOCK TABLES `contenir` WRITE;
/*!40000 ALTER TABLE `contenir` DISABLE KEYS */;
INSERT INTO `contenir` VALUES (1,1,10),(1,16,2),(1,16,2),(2,1,2),(2,16,4);
/*!40000 ALTER TABLE `contenir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fournisseur` (
  `idFournisseur` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nomFournisseur` varchar(50) DEFAULT NULL,
  `adresseFournisseur` varchar(50) DEFAULT NULL,
  `telFournisseur` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`idFournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES (1,'ibrahima lam','Kouva, NKTT','41916418'),(2,'Ciré Lam','kossovo, NkTT','483535336'),(3,'Amadou Dia','jeddida ; Kiffa','26666506');
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposer`
--

DROP TABLE IF EXISTS `proposer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proposer` (
  `idArticle` tinyint(3) unsigned DEFAULT NULL,
  `idFournisseur` tinyint(3) unsigned DEFAULT NULL,
  `dateProposer` date DEFAULT NULL,
  `quantiteProposer` tinyint(3) unsigned DEFAULT NULL,
  KEY `fk_Article` (`idArticle`),
  KEY `fk_Fournisseur` (`idFournisseur`),
  CONSTRAINT `fk_Article` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
  CONSTRAINT `fk_Fournisseur` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposer`
--

LOCK TABLES `proposer` WRITE;
/*!40000 ALTER TABLE `proposer` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-13 13:45:00
