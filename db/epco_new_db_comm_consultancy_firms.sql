-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: epco_new_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
-- Table structure for table `comm_consultancy_firms`
--

DROP TABLE IF EXISTS `comm_consultancy_firms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comm_consultancy_firms` (
  `id` int(11) NOT NULL,
  `consultancy_name` varchar(200) NOT NULL,
  `contact_name` varchar(200) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `exp_year` varchar(60) NOT NULL,
  `specialization` varchar(200) NOT NULL,
  `tournover_year` float NOT NULL,
  `no_of_core_staff` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `pincode` int(11) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `mobile` int(11) NOT NULL,
  `landline` int(11) NOT NULL,
  `profile_attachment` varchar(200) NOT NULL,
  `work_attachment` varchar(200) NOT NULL,
  `taxcertificate_attachment` varchar(200) NOT NULL,
  `staff_attachment` varchar(200) NOT NULL,
  `balencesheet_attachment` varchar(200) NOT NULL,
  `article_attachment` varchar(200) NOT NULL,
  `terms_condition` tinyint(4) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comm_consultancy_firms`
--

LOCK TABLES `comm_consultancy_firms` WRITE;
/*!40000 ALTER TABLE `comm_consultancy_firms` DISABLE KEYS */;
INSERT INTO `comm_consultancy_firms` VALUES (0,'Xcvxcvxcv','Xcvxcv','Xcvxcv','','',0,0,'','','',0,'Xcvxcv@dsrg.cb',1234567890,0,'','','','','','',0,'2021-05-03 17:09:44');
/*!40000 ALTER TABLE `comm_consultancy_firms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03 18:13:22
