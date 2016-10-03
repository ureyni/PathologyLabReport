-- MySQL dump 10.15  Distrib 10.0.26-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: LabReport
-- ------------------------------------------------------
-- Server version	10.0.26-MariaDB

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
-- Current Database: `LabReport`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `LabReport` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `LabReport`;

--
-- Table structure for table `langs`
--

DROP TABLE IF EXISTS `langs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `langs` (
  `langs_id` int(2) NOT NULL AUTO_INCREMENT,
  `lang` varchar(32) NOT NULL,
  `key` varchar(32) NOT NULL,
  `value` varchar(1024) NOT NULL,
  PRIMARY KEY (`langs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langs`
--

LOCK TABLES `langs` WRITE;
/*!40000 ALTER TABLE `langs` DISABLE KEYS */;
/*!40000 ALTER TABLE `langs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_report_details`
--

DROP TABLE IF EXISTS `patient_report_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_report_details` (
  `patient_report_details_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_reports_id` int(10) NOT NULL,
  `test_types_id` int(5) NOT NULL,
  `test_value` text,
  `user_id` int(5) DEFAULT NULL,
  `reg_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_report_details_id`),
  KEY `user_id` (`user_id`),
  KEY `patient_reports_id` (`patient_reports_id`),
  KEY `test_types_id` (`test_types_id`),
  CONSTRAINT `patient_report_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `patient_report_details_ibfk_2` FOREIGN KEY (`patient_reports_id`) REFERENCES `patient_reports` (`patient_reports_id`) ON UPDATE CASCADE,
  CONSTRAINT `patient_report_details_ibfk_3` FOREIGN KEY (`test_types_id`) REFERENCES `test_types` (`test_types_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patient_reports`
--

DROP TABLE IF EXISTS `patient_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_reports` (
  `patient_reports_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `report_date` date NOT NULL,
  `date_of_sample_received` date NOT NULL,
  `user_id` int(5) NOT NULL,
  `reg_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `report_name` varchar(64) DEFAULT NULL,
  `file_path` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`patient_reports_id`),
  UNIQUE KEY `patient_reports_PK` (`report_name`),
  KEY `user_id` (`user_id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `patient_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `patient_reports_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patients_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `patients_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(128) NOT NULL,
  `code` varchar(128) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `reg_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patients_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(2) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `settings_id` int(2) NOT NULL AUTO_INCREMENT,
  `modul_type` varchar(32) NOT NULL,
  `modul_field` varchar(32) NOT NULL,
  `modul_value` varchar(1024) NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'SMTPINFO','SMTP_HOST','smtp.live.com'),(2,'LABINFO','LAB_ADDRESS_1','dont know street know no USA'),(3,'LABINFO','LAB_NAME','DEMO LABO'),(4,'SMTPINFO','SMTP_FROM_NAME','\"Hasan UÇAK\"'),(5,'SMTPINFO','SMTP_PASSWORD','xxxxxxx'),(6,'SMTPINFO','SMTP_USER','ucak_hasan@hotmail.com'),(7,'LABINFO','LAB_ADDRESS_2','5022 CA USA'),(8,'LABINFO','LAB_PHONE','+1 123 2545 2524'),(9,'LABINFO','LAB_EMAIL','info@demolab.com'),(10,'LABINFO','LAB_LOG_LINK','/opt/abc/demo.jpg'),(11,'SMTPINFO','SMTP_PORT','587');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_types`
--

DROP TABLE IF EXISTS `test_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_types` (
  `test_types_id` int(5) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(128) NOT NULL,
  `explain` varchar(1024) DEFAULT NULL,
  `user_id` int(5) NOT NULL,
  `reg_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_types_id`),
  UNIQUE KEY `test_types_PK` (`test_name`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `test_types_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(2) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `reg_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_PK` (`username`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','System Admin','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1,'hasan.ucak@gmail.com','+905322409448','2016-10-01 19:31:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-03 22:27:29
