-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: realestate
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
-- Table structure for table `Area_details`
--

DROP TABLE IF EXISTS `Area_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Area_details` (
  `Area_Name` varchar(20) NOT NULL,
  `Block_details` text,
  PRIMARY KEY (`Area_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Area_details`
--

LOCK TABLES `Area_details` WRITE;
/*!40000 ALTER TABLE `Area_details` DISABLE KEYS */;
INSERT INTO `Area_details` VALUES ('Abdullah Al Mubarak','1,2,3,4,5,6'),('Abu Al Hasania','1,2,3,4,5'),('Al Bida','1,2,3,4,5'),('Dasma','1,2,3,4,5'),('Fahaheel','1,2,3,4,5'),('Grenada','1,2,3,4,5'),('Hateen','1,2,3,4,5'),('Indiranagar','Phase I, Phase II, 80 Feet Road, 100 Feet Road'),('Jabriya','1,2,3,4,5,6,7,8'),('Jaya Nagar','Block 1, Block 2, Block 3, Block 4, Block 4, Block 5, Block 6'),('JP Nagar','Phase I, Phase II, Phase III, Phase IV, Phase V, Phase VI, Phase VII'),('Kundanahalli','Green Garden Layout, AECS Layout, BEML Layout, Sai Baba Colony'),('Messilah','1,2,3,4,5,6,7,8'),('Qortuba','1,2,3,4,5,6,7,8'),('Rawda','1,2,3,4,5,6,7,8'),('Salam','1,2,3,4,5,6'),('Shaab','1,2,3,4,5,6'),('Surra','1,2,3,4,5,6,7,8'),('West Mishref','1,2,3,4,5,6,7,8'),('Zahra','1,2,3,4,5');
/*!40000 ALTER TABLE `Area_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location_details`
--

DROP TABLE IF EXISTS `Location_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location_details` (
  `propId` varchar(20) NOT NULL,
  `Area` text,
  `Street` text,
  `Block` int(11) DEFAULT NULL,
  `Jada` int(11) DEFAULT NULL,
  `HouseNo` int(11) DEFAULT NULL,
  `square_mtrs` int(11) DEFAULT NULL,
  `token_No` int(11) DEFAULT NULL,
  `Location` text,
  `features` text,
  `docs_path` text,
  `description` text,
  PRIMARY KEY (`propId`),
  CONSTRAINT `Location_details_ibfk_1` FOREIGN KEY (`propId`) REFERENCES `property` (`propId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location_details`
--

LOCK TABLES `Location_details` WRITE;
/*!40000 ALTER TABLE `Location_details` DISABLE KEYS */;
INSERT INTO `Location_details` VALUES ('Al Bida4225','dale','M G Road',4,2,225,2500,225,'Al Bida','ghhj kj jg ksfj','4225','Flat with all latest fittings and amenities'),('Hateen4111','Bari','Lakeview Street',4,2,111,1250,111,'Hateen','Beach front swimming pool and garden','4111','Villa with 4 bed rooms'),('Jabriya5123','regal','Church Street',5,1,123,1500,123,'Jabriya','swimming pool and garden','5123','Villa with 2 bed rooms and one study room'),('Rawda2122','abbey','China Town',2,3,122,2100,122,'Rawda','landscape garden','2122','Independent house with garden');
/*!40000 ALTER TABLE `Location_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Property_details`
--

DROP TABLE IF EXISTS `Property_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Property_details` (
  `propId` varchar(20) NOT NULL,
  `Mode` text,
  `Type` text,
  `owner_Name` text,
  `Price` float DEFAULT NULL,
  `Commission` float DEFAULT NULL,
  `min_Price` float DEFAULT NULL,
  `purpose` text,
  `phone_Num` int(11) DEFAULT NULL,
  PRIMARY KEY (`propId`),
  CONSTRAINT `Property_details_ibfk_1` FOREIGN KEY (`propId`) REFERENCES `property` (`propId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Property_details`
--

LOCK TABLES `Property_details` WRITE;
/*!40000 ALTER TABLE `Property_details` DISABLE KEYS */;
INSERT INTO `Property_details` VALUES ('Al Bida4225','Direct','Buy','Ansari',9000,100,8750,'jdhgsd lhsdg',2147483647),('Hateen4111','Indirect','Rent','Ahmed Patel',7500,100,7250,'hsdjgsh ld skldhg ',2147483647),('Jabriya5123','Direct','Buy','Dilawar Ahmed',8500,150,8000,'jddj sdkgjhs dg skdjgh ',2147483647),('Rawda2122','Indirect','Rent','Dilawar Ahmed',8500,150,8000,'jddj sdkgjhs dg skdjgh ',2147483647);
/*!40000 ALTER TABLE `Property_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property` (
  `propId` varchar(20) NOT NULL,
  `OwnerName` text,
  `phoneNum` int(11) DEFAULT NULL,
  `blockNo` int(11) DEFAULT NULL,
  `houseNo` int(11) DEFAULT NULL,
  `street` text,
  `Location` text,
  `description` text,
  `pic_path` text,
  `status` text,
  PRIMARY KEY (`propId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` VALUES ('Al Bida4225','Ansari',2147483647,4,225,'M G Road','Al Bida','4 bedroom house with all amenities','4225/','new'),('Hateen4111','Ahmed Patel',2147483647,4,111,'Lakeview Street','Hateen','Villa with 4 bed rooms','4111/','sold'),('Jabriya5123','Dilawar Ahmed ',2147483647,5,123,'Church Street','Jabriya','Villa with 3 bed rooms Jacuzzi','5123/','sold'),('Rawda2122','Dilawar Ahmed ',2147483647,2,122,'China Town','Rawda','Villa with 5 bed rooms ','2122/','new');
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `name` varchar(20) NOT NULL,
  `passwd` text,
  `role` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('Abraham','password','Agent'),('Admin','password','Admin'),('Hari','password','Agent'),('John','password','User'),('Krishna','password','User'),('Rahul','password','User'),('Sai','password','Admin'),('Swathi','password','Admin');
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

-- Dump completed on 2013-10-28 22:31:12
