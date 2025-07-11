-- MySQL dump 10.13  Distrib 8.3.0, for macos12.6 (x86_64)
--
-- Host: 127.0.0.1    Database: db_Dentis
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_icons`
--

DROP TABLE IF EXISTS `tbl_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iconName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_icons`
--

LOCK TABLES `tbl_icons` WRITE;
/*!40000 ALTER TABLE `tbl_icons` DISABLE KEYS */;
INSERT INTO `tbl_icons` VALUES (1,'home'),(2,'user'),(3,'setting'),(4,'help'),(5,'info'),(6,'question'),(7,'warning'),(8,'error'),(9,'success'),(10,'search'),(11,'menu'),(12,'chevron-up'),(13,'chevron-down'),(14,'chevron-left'),(15,'chevron-right'),(16,'refresh'),(17,'calendar'),(18,'clock'),(19,'file'),(20,'folder'),(21,'document'),(22,'pdf'),(23,'word'),(24,'excel'),(25,'powerpoint'),(26,'image'),(27,'video'),(28,'audio'),(29,'code'),(30,'arrow-up'),(31,'arrow-down'),(32,'arrow-left'),(33,'arrow-right'),(34,'angle-up'),(35,'angle-down'),(36,'ngle-left'),(37,'angle-right'),(38,'expand'),(39,'collapse'),(40,'back'),(41,'forward'),(42,'top'),(43,'bottom'),(44,'first'),(45,'last'),(46,'facebook'),(47,'twitter'),(48,'instagram'),(49,'linkedin'),(50,'youtube'),(51,'github'),(52,'codepen'),(53,'dribbble'),(54,'behance'),(55,'pinterest'),(56,'whatsapp'),(57,'telegram'),(58,'credit-card'),(59,'bank'),(60,'money'),(61,'dollar'),(62,'euro'),(63,'pound'),(64,'bitcoin'),(65,'wallet'),(66,'shopping-cart'),(67,'basket'),(68,'check'),(69,'check-circle'),(70,'cross'),(71,'close'),(72,'plus'),(73,'minus'),(74,'star'),(75,'heart'),(76,'heart-broken'),(77,'radio'),(78,'checkbox'),(79,'switch'),(80,'lock'),(81,'unlock'),(82,'edit'),(83,'delete'),(84,'upload'),(85,'download'),(86,'copy'),(87,'cut'),(88,'paste'),(89,'print'),(90,'lightbulb'),(91,'thumb-up'),(92,'thumb-down'),(93,'flag'),(94,'star-empty'),(95,'share'),(96,'reply'),(97,'settings-alt'),(98,'compass'),(99,'bell'),(100,'megaphone'),(101,'globe'),(102,'chat'),(103,'mail'),(104,'phone'),(105,'paper-plane'),(106,'layers'),(107,'bulb'),(108,'calculator'),(109,'monitor'),(110,'tablet'),(111,'laptop'),(112,'shield');
/*!40000 ALTER TABLE `tbl_icons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-26  6:50:04
