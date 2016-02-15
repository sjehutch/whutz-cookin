-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: whutz
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cook_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `details` text,
  `status` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,2,3,3,'2015-12-18 06:00:00','not found',12,'one two three','open','2015-11-30 05:53:50','2015-11-30 05:53:50');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (12,4,2,NULL,5,NULL,NULL),(23,4,3,NULL,1,'2015-12-11 08:47:34','2015-12-11 08:47:34'),(24,4,3,NULL,1,'2015-12-11 08:47:36','2015-12-11 08:47:36'),(25,4,3,NULL,1,'2015-12-11 08:47:37','2015-12-11 08:47:37'),(26,3,2,NULL,1,'2015-12-15 10:01:47','2015-12-15 10:01:47'),(88,3,2,NULL,1,'2015-12-16 05:00:19','2015-12-16 05:00:19'),(89,4,3,NULL,1,'2016-02-10 08:43:31','2016-02-10 08:43:31');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Vivek','Joshi','jvivek15@gmail.com','9888698578','test','2015-12-23 08:26:02','2015-12-23 08:26:02'),(2,'Vivek','Joshi','jvivek15@gmail.com','9888698578','test','2015-12-23 08:28:45','2015-12-23 08:28:45'),(3,'amit','vasdev','amitvasdev01@gmail.com','8557988984','If you watch any professional ASP.NET Webform project you will notice that code behind class is where you have huge amount of code and the code is really complicated.Now this code behind page class inherits from “System.Web.UI.Page” class. This class is n','2016-01-06 09:28:47','2016-01-06 09:28:47'),(4,'amit','vasdev','amitvasdev01@gmail.com','8557988984','If you watch any professional ASP.NET Webform project you will notice that code behind class is where you have huge amount of code and the code is really complicated.Now this code behind page class inherits from “System.Web.UI.Page” class. This class is n','2016-01-06 12:44:29','2016-01-06 12:44:29');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cook_payments`
--

DROP TABLE IF EXISTS `cook_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cook_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cook_id` int(11) DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `payment_mode` varchar(45) DEFAULT NULL,
  `remarks` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cook_payments`
--

LOCK TABLES `cook_payments` WRITE;
/*!40000 ALTER TABLE `cook_payments` DISABLE KEYS */;
INSERT INTO `cook_payments` VALUES (2,3,1,'Via Transfer',NULL,'2016-02-09 12:36:15','2016-02-09 12:36:15'),(3,3,2,'Via Transfer',NULL,'2016-02-09 12:43:57','2016-02-09 12:43:57'),(4,3,1,'Via Transfer',NULL,'2016-02-09 12:45:42','2016-02-09 12:45:42'),(5,3,2,'Via Transfer',NULL,'2016-02-09 12:47:04','2016-02-09 12:47:04');
/*!40000 ALTER TABLE `cook_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cook_plan`
--

DROP TABLE IF EXISTS `cook_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cook_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cook_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cook_plan`
--

LOCK TABLES `cook_plan` WRITE;
/*!40000 ALTER TABLE `cook_plan` DISABLE KEYS */;
INSERT INTO `cook_plan` VALUES (1,24,1,'2015-12-21 20:09:36','2015-12-21 20:09:36','2015-12-21 07:39:36','2015-12-21 07:39:36'),(2,24,1,'2015-12-21 20:14:16','2015-12-21 20:14:16','2015-12-21 07:44:16','2015-12-21 07:44:16'),(3,24,1,'2015-12-21 20:14:44','2015-12-21 20:14:44','2015-12-21 07:44:44','2015-12-21 07:44:44'),(4,24,1,'2015-12-21 20:18:34','2015-12-21 20:18:34','2015-12-21 07:48:34','2015-12-21 07:48:34'),(5,25,1,'2015-12-21 22:14:00','2015-12-21 22:14:00','2015-12-21 09:44:00','2015-12-21 09:44:00'),(6,25,1,'2015-12-21 22:50:45','2015-12-21 22:50:45','2015-12-21 10:20:45','2015-12-21 10:20:45'),(7,25,1,'2015-12-21 22:56:39','2015-12-21 22:56:39','2015-12-21 10:26:39','2015-12-21 10:26:39'),(8,25,1,'2015-12-21 22:57:15','2015-12-21 22:57:15','2015-12-21 10:27:15','2015-12-21 10:27:15'),(9,25,1,'2015-12-21 23:07:56','2015-12-21 23:07:56','2015-12-21 10:37:56','2015-12-21 10:37:56'),(10,25,1,'2015-12-21 23:11:07','2015-12-21 23:11:07','2015-12-21 10:41:07','2015-12-21 10:41:07'),(11,25,1,'2015-12-21 23:11:31','2015-12-21 23:11:31','2015-12-21 10:41:31','2015-12-21 10:41:31'),(12,25,1,'2015-12-21 23:12:57','2015-12-21 23:12:57','2015-12-21 10:42:57','2015-12-21 10:42:57'),(13,25,1,'2015-12-21 23:15:15','2015-12-21 23:15:15','2015-12-21 10:45:15','2015-12-21 10:45:15'),(14,25,1,'2015-12-21 23:19:03','2015-12-21 23:19:03','2015-12-21 10:49:03','2015-12-21 10:49:03'),(15,25,1,'2015-12-21 23:19:57','2015-12-21 23:19:57','2015-12-21 10:49:57','2015-12-21 10:49:57'),(16,25,1,'2015-12-21 23:20:37','2015-12-21 23:20:37','2015-12-21 10:50:37','2015-12-21 10:50:37'),(17,25,1,'2015-12-21 23:21:32','2015-12-21 23:21:32','2015-12-21 10:51:32','2015-12-21 10:51:32'),(18,25,1,'2015-12-21 23:24:33','2015-12-21 23:24:33','2015-12-21 10:54:33','2015-12-21 10:54:33'),(19,25,1,'2015-12-21 23:49:40','2015-12-21 23:49:40','2015-12-21 11:19:40','2015-12-21 11:19:40'),(20,25,1,'2015-12-21 23:53:49','2015-12-21 23:53:49','2015-12-21 11:23:49','2015-12-21 11:23:49'),(21,25,1,'2015-12-21 23:54:19','2015-12-21 23:54:19','2015-12-21 11:24:19','2015-12-21 11:24:19'),(22,25,1,'2015-12-22 00:30:16','2015-12-22 00:30:16','2015-12-21 12:00:16','2015-12-21 12:00:16'),(23,25,1,'2015-12-22 00:31:15','2015-12-22 00:31:15','2015-12-21 12:01:15','2015-12-21 12:01:15'),(24,25,1,'2015-12-22 00:49:08','2015-12-22 00:49:08','2015-12-21 12:19:08','2015-12-21 12:19:08'),(25,25,1,'2015-12-22 00:54:27','2015-12-22 00:54:27','2015-12-21 12:24:27','2015-12-21 12:24:27'),(26,25,1,'2015-12-22 01:01:58','2015-12-22 01:01:58','2015-12-21 12:31:58','2015-12-21 12:31:58'),(27,43,1,NULL,NULL,'2015-12-23 09:50:12','2015-12-23 09:50:12'),(28,43,1,NULL,NULL,'2015-12-23 09:52:54','2015-12-23 09:52:54'),(29,43,1,NULL,NULL,'2015-12-23 09:55:27','2015-12-23 09:55:27'),(30,43,1,NULL,NULL,'2015-12-23 09:56:19','2015-12-23 09:56:19'),(31,43,1,NULL,NULL,'2015-12-23 09:59:03','2015-12-23 09:59:03'),(32,43,1,NULL,NULL,'2015-12-23 10:06:56','2015-12-23 10:06:56'),(33,46,1,NULL,NULL,'2015-12-23 18:39:08','2015-12-23 18:39:08'),(34,3,1,NULL,NULL,'2015-12-28 07:02:55','2015-12-28 07:02:55'),(35,48,1,NULL,NULL,'2015-12-29 08:36:21','2015-12-29 08:36:21'),(36,50,2,NULL,NULL,'2016-01-06 10:22:26','2016-01-06 10:22:26'),(37,50,2,NULL,NULL,'2016-01-06 10:22:27','2016-01-06 10:22:27'),(38,50,2,NULL,NULL,'2016-01-06 10:22:28','2016-01-06 10:22:28'),(39,50,2,NULL,NULL,'2016-01-06 10:22:28','2016-01-06 10:22:28'),(40,50,1,NULL,NULL,'2016-01-06 10:22:35','2016-01-06 10:22:35'),(41,51,2,NULL,NULL,'2016-01-06 10:44:27','2016-01-06 10:44:27'),(42,52,1,NULL,NULL,'2016-01-12 10:40:51','2016-01-12 10:40:51');
/*!40000 ALTER TABLE `cook_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dish_rating`
--

DROP TABLE IF EXISTS `dish_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dish_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dish_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dish_rating`
--

LOCK TABLES `dish_rating` WRITE;
/*!40000 ALTER TABLE `dish_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `dish_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dishs`
--

DROP TABLE IF EXISTS `dishs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dishs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cook_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dish_for_day_night` varchar(45) DEFAULT NULL,
  `delivery_method` varchar(45) DEFAULT NULL,
  `dish_type` varchar(45) DEFAULT NULL,
  `dish_img` varchar(255) DEFAULT NULL,
  `dish_video` varchar(255) DEFAULT NULL,
  `special_notes` varchar(255) DEFAULT NULL,
  `other` varchar(45) DEFAULT NULL,
  `description` text,
  `address` varchar(255) DEFAULT NULL,
  `zipcode` int(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `unfulfilled` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dishs`
--

LOCK TABLES `dishs` WRITE;
/*!40000 ALTER TABLE `dishs` DISABLE KEYS */;
INSERT INTO `dishs` VALUES (3,4,'Egg roll','day','delivery only','Main Dish','2015-12-04-10-47-23-DAwVgnYqqfOYSsoEjggkPxIlvOsVMKVu8KaBFXUr.jpg','2015-12-07-09-38-43-jt8H9ESdJNW3KvRBqLX8tVl7FRVLvre0pAt871EQ.mp4','{\"one\":\"CONTAINS MILK, EGGS\",\"two\":\"CONTAINS NUTS\",\"four\":\"VEGETARIAN\"}',NULL,NULL,NULL,5,4,'22',5,'2015-12-04 08:44:38','2015-12-04 08:44:38'),(4,3,'store','day','delivery only','Dessert','2015-12-09-09-58-31-TxNYomJAmMJzeg32vO53Ctt94O0ntcxVgPUvx2aO.jpg',NULL,'{}',NULL,'DESCRIPTION ABOUT DISH','ADDRESS FOR DISH',2332,3434,'12',344,'2015-12-09 09:59:02','2015-12-09 09:59:02'),(5,3,'sd3','day','pick up only','Dessert','2015-12-09-10-00-04-vFqkwnJwEqWYgOlGfeoQ249KOXmIkXeJWKxVU06w.jpg',NULL,'{}',NULL,'432423','423423',234234,234324,'4',234,'2015-12-09 10:00:18','2015-12-09 10:00:18'),(6,51,'test dish','dinner','pick up only','Main Dish','2016-01-06-12-27-42-thHZN9bQo6xs0vKrXYNTCaJyADYKGedyUpZSCeZc.png',NULL,'{\"one\":false,\"three\":\"CONTAINS SHELLFISH\",\"six\":\"NON VEGETARIAN\",\"two\":\"CONTAINS NUTS\"}',NULL,'If you watch any professional ASP.NET Webform project you will notice that code behind class is where you have huge amount of code and the code is really complicated.Now this code behind page class inherits from “System.Web.UI.Page” class. This class is not a normal class which can be reused and instantiated anywhere. In other words you can never do something as shown below for a Webform class:-','22 park street ca',160071,300,'df',20,'2016-01-06 12:28:29','2016-01-06 12:28:29'),(7,51,'Butter Chicken','lunch','pick up only','Main Dish','2016-01-12-09-44-32-HaHAogY3JOgoQjYIn0gvNVgX3zcj2XxiPKNRyOUJ.jpg',NULL,'{\"one\":\"CONTAINS MILK, EGGS\",\"six\":\"NON VEGETARIAN\"}',NULL,'Butter chicken Test Butter chicken Test','fgghfgf',147001,50,'fg',12,'2016-01-12 09:47:28','2016-01-12 09:47:28'),(8,51,'Butter Chicken','lunch','pick up only','Main Dish','2016-01-12-09-44-32-HaHAogY3JOgoQjYIn0gvNVgX3zcj2XxiPKNRyOUJ.jpg',NULL,'{\"one\":\"CONTAINS MILK, EGGS\",\"six\":\"NON VEGETARIAN\"}',NULL,'Butter chicken Test Butter chicken Test','fgghfgf',147001,50,'fg',12,'2016-01-12 09:49:23','2016-01-12 09:49:23'),(9,51,'Butter Chicken','lunch','pick up only','Main Dish','2016-01-12-09-44-32-HaHAogY3JOgoQjYIn0gvNVgX3zcj2XxiPKNRyOUJ.jpg',NULL,'{\"one\":\"CONTAINS MILK, EGGS\",\"six\":\"NON VEGETARIAN\"}',NULL,'Butter chicken Test Butter chicken Test','fgghfgf',147001,50,'fg',12,'2016-01-12 09:49:28','2016-01-12 09:49:28'),(10,51,'Butter Chicken','lunch','pick up only','Main Dish','2016-01-12-09-44-32-HaHAogY3JOgoQjYIn0gvNVgX3zcj2XxiPKNRyOUJ.jpg',NULL,'{\"one\":\"CONTAINS MILK, EGGS\",\"six\":\"NON VEGETARIAN\"}',NULL,'Butter chicken Test Butter chicken Test','fgghfgf',147001,50,'fg',12,'2016-01-12 09:49:31','2016-01-12 09:49:31');
/*!40000 ALTER TABLE `dishs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `text` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,3,3,NULL,'2016-02-13 06:30:55','2016-02-13 06:30:55'),(2,3,3,'text','2016-02-13 06:31:08','2016-02-13 06:31:08');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `cook_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `payment_done` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,14,54,2,3,1,NULL,NULL,NULL,'2016-01-11 09:03:01','2016-01-11 09:03:01'),(2,14,54,2,3,1,NULL,NULL,NULL,'2016-01-11 09:05:59','2016-01-11 09:05:59'),(3,14,54,3,5,1,NULL,NULL,NULL,'2016-01-11 09:06:01','2016-01-11 09:06:01'),(4,14,54,3,3,1,'pending',NULL,NULL,'2016-01-11 09:07:26','2016-01-11 10:32:52'),(5,6,49,3,3,1,NULL,NULL,NULL,'2016-01-12 10:34:07','2016-01-12 10:34:07'),(6,6,49,3,5,1,NULL,NULL,NULL,'2016-01-12 10:34:07','2016-01-12 10:34:07'),(7,6,49,3,3,1,'2',NULL,NULL,'2016-01-12 10:34:08','2016-02-11 12:26:07'),(8,6,49,2,3,1,NULL,NULL,NULL,'2016-01-12 10:34:08','2016-01-12 10:34:08');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dish_id` varchar(45) DEFAULT NULL,
  `cook_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL,
  `order_type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,4,'2',3,2,NULL,NULL,NULL,NULL,NULL,'2015-11-23 05:58:42','2015-11-23 05:58:42'),(2,49,'3',NULL,2,NULL,NULL,NULL,NULL,NULL,'2016-01-06 09:11:15','2016-01-06 09:11:15'),(3,49,'2',NULL,3,NULL,NULL,NULL,NULL,NULL,'2016-01-06 09:11:15','2016-01-06 09:11:15'),(4,49,'2',NULL,1,NULL,NULL,NULL,NULL,NULL,'2016-01-06 12:21:07','2016-01-06 12:21:07'),(5,49,'2',NULL,1,NULL,NULL,NULL,NULL,NULL,'2016-01-07 07:46:30','2016-01-07 07:46:30'),(6,49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-01-12 10:34:07','2016-01-12 10:34:07');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `ideal_for` text NOT NULL,
  `videos_limit` int(11) NOT NULL,
  `pics_limit` int(11) NOT NULL,
  `plates_limit` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'Silver Plan',0,'home cooks',3,5,20,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.','2015-12-18 00:00:00','2015-12-18 00:00:00'),(2,'Gold Plan',10,'professional cooks',10,20,50,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.','2015-12-18 00:00:00','2015-12-18 00:00:00'),(3,'Platinum Plan',599,'restaraunts',100,500,1000,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.','2015-12-18 00:00:00','2015-12-18 00:00:00');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `	id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text,
  `book_date` text NOT NULL,
  `book_time` text,
  `party_size` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`	id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,'2015-12-23 08:34:43','Vivek','Joshi','jvivek@gmail.com','343243242','12/12/2005',NULL,'1','2015-12-23 08:34:43','2015-12-23 08:34:43'),(2,'2016-01-06 09:41:13','amit','vasdev','amitvasdev01@gmail.com','8557988984','10 january 2016',NULL,'10+','2016-01-06 09:41:13','2016-01-06 09:41:13'),(3,'2016-01-06 12:43:21','amit','vasdev','amitvasdev01@gmail.com','885555652','10 january 2016',NULL,'9','2016-01-06 12:43:21','2016-01-06 12:43:21');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `delivery_option` varchar(45) DEFAULT NULL,
  `area_code` varchar(45) DEFAULT NULL,
  `kind_of_dish` text,
  `comments` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,'2016-02-10 06:29:54','2016-02-10 06:29:54'),(2,NULL,NULL,NULL,NULL,NULL,NULL,'2016-02-10 06:34:34','2016-02-10 06:34:34');
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_like`
--

DROP TABLE IF EXISTS `user_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_like`
--

LOCK TABLES `user_like` WRITE;
/*!40000 ALTER TABLE `user_like` DISABLE KEYS */;
INSERT INTO `user_like` VALUES (1,4,NULL,'follow','2016-02-12 08:56:47','2016-02-12 08:56:47'),(2,4,NULL,'follow','2016-02-12 08:57:07','2016-02-12 08:57:07'),(3,4,NULL,'follow','2016-02-12 08:58:31','2016-02-12 08:58:31'),(4,4,NULL,'follow','2016-02-12 08:58:36','2016-02-12 08:58:36'),(5,4,NULL,'follow','2016-02-12 08:59:12','2016-02-12 08:59:12'),(6,4,NULL,'follow','2016-02-12 08:59:25','2016-02-12 08:59:25'),(7,4,NULL,'follow','2016-02-12 08:59:44','2016-02-12 08:59:44'),(8,4,NULL,'follow','2016-02-12 09:00:50','2016-02-12 09:00:50'),(14,4,1,'follow','2016-02-12 09:06:27','2016-02-12 09:06:27'),(18,3,3,'favorite','2016-02-12 09:59:00','2016-02-12 09:59:00'),(19,3,NULL,'follow','2016-02-12 10:27:54','2016-02-12 10:27:54'),(24,3,4,'favoriteCook','2016-02-12 12:52:05','2016-02-12 12:52:05');
/*!40000 ALTER TABLE `user_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `verification` tinyint(1) DEFAULT NULL,
  `email_verification_code` varchar(100) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `remember_token` varchar(70) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` int(7) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `specialty` text,
  `work_history` text,
  `profile_photo` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `business_name` varchar(45) DEFAULT NULL,
  `ssn_ein` varchar(45) DEFAULT NULL,
  `amount_time` varchar(45) DEFAULT NULL,
  `award` varchar(255) DEFAULT NULL,
  `write_book` varchar(255) DEFAULT NULL,
  `travel` varchar(255) DEFAULT NULL,
  `fav_food` varchar(255) DEFAULT NULL,
  `least_fav` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `cooking_type` varchar(255) DEFAULT NULL,
  `licence_no` varchar(255) DEFAULT NULL,
  `licence_img` varchar(255) DEFAULT NULL,
  `reset_code` varchar(60) DEFAULT NULL,
  `car_type` varchar(45) DEFAULT NULL,
  `car_model` varchar(45) DEFAULT NULL,
  `isTravel` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_complete` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'1','2222222',NULL,'123@gmail.com',1,'',NULL,NULL,NULL,NULL,NULL,NULL,122,NULL,NULL,NULL,'2016-02-08-08-59-14-4SrqWu5knEPO8Wii9o4LQfC8W9u3MjDwC4arNLtt.jpg','cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-23 05:45:48','2016-02-08 09:05:34',NULL),(3,'vnt2','1234','9999999994','vnt@gmail.com',0,'','$2y$10$W7cc8q0p5cI5syvSQZsS5eptAFfSxX3B84K0rD.csTm0.Wk/ljxjS','VP2iMOjgQYjcNBsyurjVG2kMDE2eWDZTO6sbOKwskPRROnaBh0b66Z1lXv4B','1995-11-30','#23 sec 39A chandigarh','chandigarh','chandigarh',123456,'abc.com','Roll','Historical information ranging from Great Speeches (in audio) to facts about This Day in History. Show guide and scheduled air times, discussion boards, and ...','2015-12-07-07-01-13-RJD55i9daLnJQBAFWirZr1hJYEKzt4mnWrnJ7w2g.jpg','cook',1,'30.743048','76.7253379',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-23 05:58:42','2016-02-10 09:11:23','1'),(4,'vnt','123456789','9876543210','vnt2@gmail.com',0,'','$2y$10$W7cc8q0p5cI5syvSQZsS5eptAFfSxX3B84K0rD.csTm0.Wk/ljxjS','a3hmT3pYBlTdja8XJwcSGOtGHzqMSLxg7FBrSAFEcqJwI5PqH3szRD5VZJH5',NULL,'404 Not found','chd','chd',19200,'404.com',NULL,'tree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtmltree dhtml','2015-12-09-11-58-06-W0bOopKTEY3LAwLGx90LOBb7nUk6DVjwYgg8Xzr6.jpg','user',NULL,'30.744048','76.7453379',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 05:53:50','2016-02-10 09:03:57',NULL),(5,'23',NULL,NULL,'vnt3@gmail.com',0,'','123456',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 06:57:24','2015-11-30 06:57:24',NULL),(6,'34@gmail.com',NULL,NULL,'34@gmail.com',0,'','123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 06:59:41','2015-11-30 06:59:41',NULL),(7,'34@gmail.com',NULL,NULL,'341@gmail.com',0,'','1234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 07:04:22','2015-11-30 07:04:22',NULL),(8,'34@gmail.com',NULL,NULL,'vnt231@gmail.com',0,'','sad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 07:08:22','2015-11-30 07:08:22',NULL),(9,'1@gmail.com',NULL,NULL,'1@gmail.com',0,'','1@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'user',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 07:12:51','2015-11-30 07:12:51',NULL),(10,'234',NULL,NULL,'3242@sdfds.com',0,'','324',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-11-30 07:44:56','2015-11-30 07:44:56',NULL),(11,'Test first',NULL,NULL,'test@gmail.com',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-18 09:37:15','2015-12-18 09:57:23',NULL),(24,'333','2312312','99778678678','333@gmail.com',1,NULL,'$2y$10$hrm2V9zrD64.8eKR92MMbuwSzjKDFQSMU4gszy/K68P9mG4W.J9EO','mDiXpetCTeRDz1VmmKONmrvmWv1Vem4XTk0CwkGRmVWOh3LeZNaDzwK7Yib3',NULL,'StateState','State','v',324234,'Payment','Payment','Work history',NULL,'cook',1,'37.4315734','-78.6568942','BUSINESS NAME','Payment','43242','fdsf',NULL,NULL,'food','roll','Facebook','Youtube','Twitter','Instagram','6','',NULL,NULL,'',NULL,NULL,NULL,'2015-12-21 06:39:38','2015-12-21 09:40:37',NULL),(25,'44',NULL,NULL,'44@gmail.com',1,NULL,'$2y$10$MhtcB8CvUsvvxqg0eA3/M.A6UlAApCA2/fFLLvDAJYlw40dmAr6my','QphKyuC5IgmkqEmu7qXiY2neYdbOM347obDfVAjylMW9C6KD0FqtLGRJnVp9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3242','2015-12-21-12-24-57-UIwbUPcngXYJaLjC8Tq56U0MfqDypj2e3tinKBWO.png','',NULL,NULL,NULL,'2015-12-21 08:48:59','2015-12-21 12:41:35','1'),(43,'vivek',NULL,NULL,'jvivek15@gmail.com',1,NULL,'$2y$10$SHP/cE7E/9FI4YtIe.fa.ugPHetbyjINdHrVhrZQETcu4xk5cKfEu','coOlWTyznIedEcWhcnYYb8kzF3Xkwb4588SujBd3VmvNwMHQi4IzxpwrgzRW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-23 06:30:45','2015-12-23 10:07:02','1'),(44,'preeti',NULL,NULL,'pathankot24@gmail.com',1,NULL,'$2y$10$TERP54KfgXsyVeAwwWq7Pe.VnMU8iiw./UxhV0YB6LdHado97vTkK','t6sbRRgnHM3WTYobdsZh7ZqZuCFEeWTlrAZCae74Fo7zxXqKiOHnzI59WujM',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'user',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-23 06:32:52','2015-12-23 08:53:50','1'),(45,'prty',NULL,NULL,'cook@gmail.com',NULL,'Np0pQ8z8kcS4IFwwquKdbLaIEG0euKLNqAMuJdyAokUqI9m84fsdwL9SFSp9','$2y$10$nTLVVf/CeCO3x0HLUGnEGeD3zy/qTZ3cdSN2oX8u3pNnnpqWHL/oK','rAxmtkIOohTTrdN90YXoswDBfxeyuItLWawBHwxuBR8wfRYHPSeKiIHiQUhA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-23 08:58:48','2015-12-23 09:24:00',NULL),(46,'Monica Lockett',NULL,NULL,'monica.lockett@gmail.com',1,NULL,'$2y$10$pXfWi56Ug/4UCrwEa9ybseurVqd/YKE5o7SkriLek0WfR0PqKsjMW','vuekSO1k7cZLP2vfrsjjvQ8fTY50ndAj4qrCAks01RYg5C9iQH3MNpYHwugk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-23 18:37:59','2016-01-12 04:48:21','1'),(47,'Monica',NULL,NULL,'monica.lockett@accenture.com',1,NULL,'$2y$10$LCbS2HB4foOaO4j282fO6eRjXqr0lcFg/QHl1TtFZfaRQdeZFe6zq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'user',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,'2015-12-23 18:42:04','2015-12-23 18:52:45','1'),(48,'vnt100',NULL,NULL,'vnt100100@gmail.com',NULL,'ciyDIT1RXh8Uv8urxGA5gMBw4Jw8nR3EETkSugKUwl4DqHGy6D6fillgVTKr','$2y$10$yf7gSve6ahi2eDhANvDDbOvAmQ90b6WyYVBQtDdsNM3MI7nzD2G7q','MK58koKmwyScl8puH96lLnL8B8UVHbU1NJHncRNrA5bFkYGI1slsu0Gqpfjt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-12-29 08:33:05','2015-12-29 08:53:00','1'),(49,'Amit vasdev',NULL,'8557988984','amitvasdev01@gmail.com',NULL,'K8OTmh3cEpOuSS34y1JqviV5Y7vQ51VHVb6zNVHY2Cny475GfeIlI444hcMj','$2y$10$dHeonHTvHKvNsg4EbF2.nes9fNo6tnAuT.e2iESGveKCIQRV01rky','zRjpI7UyejyFXHZIUxGja1ID9gE4Jp8F9hDTZz06k4iy55acuWNtwihD6e3Y',NULL,'','test','test 124',160071,NULL,NULL,'If you watch any professional ASP.NET Webform project you will notice that code behind class is where you have huge amount of code and the code is really complicated.Now this code behind page class inherits from “System.Web.UI.Page” class. This class is not a normal class which can be reused and instantiated anywhere. In other words you can never do something as shown below for a Webform class:-','2016-01-06-12-19-12-CwDOwmyfMP3SqHq0YK3h9PIGVTb8bYXFeRJ71WIZ.png','user',NULL,'51.1532027','-1.4401605',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ZfqqZeCQW1cG5XizfkWVhUw4iH6pvs3FCAQ9bnzRZm8XCi7sBmNG6Ohc5rcQ',NULL,NULL,NULL,'2016-01-06 08:47:40','2016-01-12 10:39:48',NULL),(50,'vasdev amit',NULL,NULL,'vasdev.1984@yahoo.in',NULL,'T1O01NIrmNUXQSnoHN2iml2leuEI7zxS8tNF6MhzpTdEctNArf1byMQ8sNV7','$2y$10$8b1VtwoyrYAg6/SAt1XbaOD7X04bvHIP/aDvPrcjTea/BpPEjGxEO','8aLaCKaF7vhiwJdpWj53ufvCkq59CX4GArb2yAoPEo1c9EE5S2o8GwHCMiCR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-01-06 10:21:27','2016-01-06 10:28:25',NULL),(51,'vasdev amit',NULL,NULL,'vasdev.amit@yahoo.in',NULL,'Afgx6MxPqazEmGwpv7G5PuevrjkbBXytkxjhQXGLo1WXCcGK0P8HEwc0xgu1','$2y$10$x67RydextU1929QTuohp5OJ2DFcGwdr2I3FJ9bSNf33IKahyTlYfS','1PZ0bqJDV2AIAB57zP3uvFfj5Fo05u9nwnDhRy9f1LJqtYYngcS1uklcdDc5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-01-06 10:38:17','2016-01-12 10:06:41','1'),(52,'av',NULL,NULL,'nidhi.moudgil2@gmail.com',1,NULL,'$2y$10$B1qvM1P5.KbGF0G3Pm8q..lvL3S2kCsIsJ7Q6fPM3QXZH7i7cNEPq','fGfnoDyTbBAgIqLzIOk5XAWUUko2FJFWbW0lfwE9Rsa9rZnzTpFu3dw4GMdY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'cook',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-01-12 10:40:24','2016-01-12 10:45:30','1');
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

-- Dump completed on 2016-02-15 11:44:14
