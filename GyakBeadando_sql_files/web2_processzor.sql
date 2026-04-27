-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: web2
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `processzor`
--

DROP TABLE IF EXISTS `processzor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processzor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gyarto` varchar(100) NOT NULL,
  `tipus` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processzor`
--

LOCK TABLES `processzor` WRITE;
/*!40000 ALTER TABLE `processzor` DISABLE KEYS */;
INSERT INTO `processzor` VALUES (1,'AMD','Athlon 64 X2 QL64'),(4,'AMD','Athlon TM Neo MV-40'),(5,'AMD','Mobil Sempron SI-40'),(6,'AMD','Turion64 X2 TL60'),(7,'AMD','Turion64 X2 TL64'),(8,'AMD','Turion64 X2 TL62'),(10,'Intel','Celeron 900'),(12,'Intel','Celeron Dual-Core T1600'),(13,'Intel','Celeron Dual-Core T1700'),(14,'Intel','Celeron Dual-Core T3000'),(17,'Intel','Celeron M 560'),(18,'Intel','Centrino Atom 1600'),(19,'Intel','Centrino Atom N270'),(20,'Intel','Centrino Atom N280'),(21,'Intel','Centrino Atom Z520'),(22,'Intel','Centrino Atom Z530'),(23,'Intel','Core Duo T3400'),(24,'Intel','Core2 Duo P7350'),(25,'Intel','Core2 Duo P8400'),(26,'Intel','Core2 Duo P8600'),(27,'Intel','Core2 Duo P8700'),(28,'Intel','Core2 Duo SL9400'),(29,'Intel','Core2 Duo SU7300'),(30,'Intel','Core2 Duo SU9300'),(31,'Intel','Core2 Duo SU9400'),(32,'Intel','Core2 Duo T5670'),(34,'Intel','Core2 Duo T5870'),(35,'Intel','Core2 Duo T6400'),(36,'Intel','Core2 Duo T6500'),(37,'Intel','Core2 Duo T6570'),(38,'Intel','Core2 Duo T6600'),(39,'Intel','Core2 Duo T6670'),(40,'Intel','Core2 Duo T7300'),(41,'Intel','Core2 Duo T7500'),(42,'Intel','Core2 Duo T8300'),(43,'Intel','Core2 Duo T9300'),(44,'Intel','Core2 Duo T9400'),(45,'Intel','Core2 Solo SU3500 ULV'),(46,'Intel','Pentium Dual Core SU4100'),(48,'Intel','Pentium dual-core T4200'),(49,'Intel','Pentium dual-core T4300'),(51,'Intel','Celeron M ULV723'),(52,'VIA','Via Nano ULV 2250'),(53,'AMD','Athlon 64 X2 QL65');
/*!40000 ALTER TABLE `processzor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-12 15:20:23
