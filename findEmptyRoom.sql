-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administer`
--

DROP TABLE IF EXISTS `administer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `administer` (
  `a_id` int(11) NOT NULL,
  `a_pwd` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administer`
--

LOCK TABLES `administer` WRITE;
/*!40000 ALTER TABLE `administer` DISABLE KEYS */;
INSERT INTO `administer` VALUES (1111,'aaaa'),(1112,'bbbb');
/*!40000 ALTER TABLE `administer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `building` (
  `b_num` int(11) NOT NULL,
  `b_name` varchar(45) NOT NULL,
  `b_floor` int(11) NOT NULL,
  PRIMARY KEY (`b_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` VALUES (101,'sejong',4),(102,'chungmu',10),(103,'daeyang AI',15),(104,'gunja',5),(105,'jin',5);
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecture`
--

DROP TABLE IF EXISTS `lecture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lecture` (
  `l_num` int(11) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `week` varchar(45) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `r_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`l_num`),
  KEY `p_id` (`p_id`),
  KEY `r_id` (`r_id`),
  CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `professor` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`r_id`) REFERENCES `room` (`r_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture`
--

LOCK TABLES `lecture` WRITE;
/*!40000 ALTER TABLE `lecture` DISABLE KEYS */;
INSERT INTO `lecture` VALUES (3000,'OS','monwed','13:00:00','14:30:00',1,1),(3001,'C programming','tuetur','11:00:00','13:00:00',2,2),(3002,'java','monwed','15:30:00','17:00:00',3,3),(3003,'web','tuetur','14:00:00','16:00:00',4,4),(3004,'C++','monwed','10:30:00','12:00:00',5,5),(3005,'database','monfri','13:30:00','15:00:00',6,6),(3006,'digital system','monwed','10:00:00','12:00:00',7,7),(3007,'multimedia','tuetur','16:30:00','18:00:00',8,8),(3008,'signal and system','tuefri','12:00:00','13:30:00',9,9),(3009,'AI','monwed','14:00:00','16:00:00',10,10),(3010,'computer structure','monwed','13:00:00','14:30:00',10,2),(3011,'algorism','tuetur','11:00:00','12:30:00',8,3),(3012,'network','monfri','10:30:00','12:00:00',2,5),(3013,'unix','tuetur','14:00:00','16:00:00',3,6),(3014,'linux','monwed','15:30:00','17:00:00',7,8);
/*!40000 ALTER TABLE `lecture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `professor` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(45) NOT NULL,
  `p_num` int(11) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,'kim',2001),(2,'rho',2002),(3,'lee',2003),(4,'kang',2004),(5,'park',2005),(6,'jo',2006),(7,'song',2010),(8,'moon',2009),(9,'hong',2008),(10,'han',2007);
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `room` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(45) NOT NULL,
  `b_num` int(11) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `b_num` (`b_num`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`b_num`) REFERENCES `building` (`b_num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'s111',101),(2,'c101',102),(3,'d211',103),(4,'g113',104),(5,'j114',105),(6,'s104',101),(7,'c204',102),(8,'d303',103),(9,'g202',104),(10,'j306',105),(11,'s203',101);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-10  3:34:57
