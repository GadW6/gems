-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: gems
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `c_title` varchar(255) NOT NULL,
  `c_description` text NOT NULL,
  `c_image` varchar(255) DEFAULT NULL,
  `c_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `c_url_UNIQUE` (`c_url`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Diamonds','The diamonds collection. The most well-known precious stone','diamonds.jpg','diamonds','2020-07-23 15:44:22','2020-07-23 15:44:22'),(2,'Precious Stones','The precious stones are fine collection of piece of mineral crystal which, in cut and polished form, is used to make jewelry or other adornments.','precious_stones.jpg','precious-stones','2020-07-20 19:46:08','2020-07-20 19:46:08'),(3,'Gold','The gold collection. Our gold is a bright, yellow precious metal','gold_rings.jpg','gold','2020-07-21 12:06:59','2020-07-21 12:06:59');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `c_title` varchar(255) NOT NULL,
  `c_article` longtext NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `toMenuId_idx` (`menu_id`),
  CONSTRAINT `toMenuId` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,1,'About the company','<p class=\"mt-8 mb-8\">This template is inspired by the stunning nordic minamalist design - in particular:\n      <br>\n      <a class=\"text-gray-800 underline hover:text-gray-900\" href=\"http://savoy.nordicmade.com/\" target=\"_blank\">Savoy Theme</a> created by <a class=\"text-gray-800 underline hover:text-gray-900\" href=\"https://nordicmade.com/\">https://nordicmade.com/</a> and <a class=\"text-gray-800 underline hover:text-gray-900\" href=\"https://www.metricdesign.no/\" target=\"_blank\">https://www.metricdesign.no/</a></p>\n\n    <p class=\"mb-8\">Lorem ipsum dolor sit amet, consectetur <a href=\"#\">random link</a> adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vel risus commodo viverra maecenas accumsan lacus vel facilisis volutpat. Vitae aliquet nec ullamcorper sit. Nullam eget felis eget nunc lobortis mattis aliquam. In est ante in nibh mauris. Egestas congue quisque egestas diam in. Facilisi nullam vehicula ipsum a arcu. Nec nam aliquam sem et tortor consequat. Eget mi proin sed libero enim sed faucibus turpis in. Hac habitasse platea dictumst quisque. In aliquam sem fringilla ut. Gravida rutrum quisque non tellus orci ac auctor augue mauris. Accumsan lacus vel facilisis volutpat est velit egestas dui id. At tempor commodo ullamcorper a. Volutpat commodo sed egestas egestas fringilla. Vitae congue eu consequat ac.</p>','2020-08-08 17:13:25','2020-08-08 17:13:25');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'About','about-us','About Our Shop','2020-07-17 21:39:14','2020-07-17 21:39:14'),(2,'Services','services','Our Service','2020-07-17 21:39:14','2020-07-17 21:39:14'),(3,'Contact','contact-us','Contact Us','2020-07-17 21:39:42','2020-07-17 21:39:42');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `data` text NOT NULL,
  `shipping` varchar(45) NOT NULL,
  `total` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (20,13,'a:2:{i:1;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"bracelet\";s:5:\"price\";i:400;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:4:\"gold\";s:3:\"url\";s:13:\"gold-bracelet\";s:5:\"image\";s:12:\"bracelet.jpg\";}s:10:\"conditions\";a:0:{}}i:2;a:6:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:8:\"necklace\";s:5:\"price\";i:600;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:4:\"gold\";s:3:\"url\";s:13:\"gold-necklace\";s:5:\"image\";s:12:\"necklace.jpg\";}s:10:\"conditions\";a:0:{}}}','standard',1010,'2020-08-22 14:19:06','2020-08-22 14:19:06'),(21,13,'a:4:{i:8;a:6:{s:2:\"id\";s:1:\"8\";s:4:\"name\";s:8:\"necklace\";s:5:\"price\";i:14500;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-necklace\";s:5:\"image\";s:12:\"necklace.jpg\";}s:10:\"conditions\";a:0:{}}i:6;a:6:{s:2:\"id\";s:1:\"6\";s:4:\"name\";s:10:\"ring (2Ct)\";s:5:\"price\";i:6500;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-ring-2ct\";s:5:\"image\";s:12:\"2ct_ring.jpg\";}s:10:\"conditions\";a:0:{}}i:5;a:6:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:10:\"ring (1Ct)\";s:5:\"price\";i:4000;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-ring-1ct\";s:5:\"image\";s:12:\"1ct_ring.jpg\";}s:10:\"conditions\";a:0:{}}i:20;a:6:{s:2:\"id\";s:2:\"20\";s:4:\"name\";s:15:\"earrings (Ruby)\";s:5:\"price\";i:7000;s:8:\"quantity\";i:3;s:10:\"attributes\";a:3:{s:8:\"category\";s:15:\"precious-stones\";s:3:\"url\";s:18:\"gems-ruby-earrings\";s:5:\"image\";s:17:\"ruby_earrings.jpg\";}s:10:\"conditions\";a:0:{}}}','standard',46019,'2020-08-22 14:19:53','2020-08-22 14:19:53'),(22,13,'a:3:{i:2;a:6:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:8:\"necklace\";s:5:\"price\";i:600;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:4:\"gold\";s:3:\"url\";s:13:\"gold-necklace\";s:5:\"image\";s:12:\"necklace.jpg\";}s:10:\"conditions\";a:0:{}}i:5;a:6:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:10:\"ring (1Ct)\";s:5:\"price\";i:4000;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-ring-1ct\";s:5:\"image\";s:12:\"1ct_ring.jpg\";}s:10:\"conditions\";a:0:{}}i:8;a:6:{s:2:\"id\";s:1:\"8\";s:4:\"name\";s:8:\"necklace\";s:5:\"price\";i:14500;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-necklace\";s:5:\"image\";s:12:\"necklace.jpg\";}s:10:\"conditions\";a:0:{}}}','standard',19110,'2020-08-23 15:00:10','2020-08-23 15:00:10'),(23,13,'a:3:{i:1;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"bracelet\";s:5:\"price\";i:400;s:8:\"quantity\";i:1;s:10:\"attributes\";a:3:{s:8:\"category\";s:4:\"gold\";s:3:\"url\";s:13:\"gold-bracelet\";s:5:\"image\";s:12:\"bracelet.jpg\";}s:10:\"conditions\";a:0:{}}i:4;a:6:{s:2:\"id\";s:1:\"4\";s:4:\"name\";s:12:\"ring (1.5Ct)\";s:5:\"price\";i:5000;s:8:\"quantity\";i:2;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:18:\"diamond-ring-1.5ct\";s:5:\"image\";s:14:\"1.5ct_ring.jpg\";}s:10:\"conditions\";a:0:{}}i:7;a:6:{s:2:\"id\";s:1:\"7\";s:4:\"name\";s:8:\"earrings\";s:5:\"price\";i:8000;s:8:\"quantity\";i:3;s:10:\"attributes\";a:3:{s:8:\"category\";s:8:\"diamonds\";s:3:\"url\";s:16:\"diamond-earrings\";s:5:\"image\";s:12:\"earrings.jpg\";}s:10:\"conditions\";a:0:{}}}','express',34419,'2020-08-23 15:00:52','2020-08-23 15:00:52'),(25,20,'a:1:{i:2;a:6:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:8:\"necklace\";s:5:\"price\";i:600;s:8:\"quantity\";s:1:\"1\";s:10:\"attributes\";a:3:{s:8:\"category\";s:4:\"gold\";s:3:\"url\";s:13:\"gold-necklace\";s:5:\"image\";s:12:\"necklace.jpg\";}s:10:\"conditions\";a:0:{}}}','express',619,'2020-08-25 11:58:24','2020-08-25 11:58:24');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `p_title` varchar(255) DEFAULT NULL,
  `p_article` text,
  `p_image` varchar(255) DEFAULT NULL,
  `p_price` int DEFAULT NULL,
  `p_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p_id_UNIQUE` (`id`),
  UNIQUE KEY `p_url_UNIQUE` (`p_url`),
  KEY `prod_id to cat_id_idx` (`category_id`),
  CONSTRAINT `prod_id to cat_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,3,'bracelet','Here\'s an everyday bracelet that won\'t go out of style. Crafted in Italy, the Bismark links glow in polished 14kt yellow gold. Lobster clasp, 14kt yellow gold Bismark-link bracelet.','bracelet.jpg',400,'gold-bracelet','2020-08-02 12:36:03','2020-08-02 12:36:03'),(2,3,'necklace',NULL,'necklace.jpg',600,'gold-necklace','2020-07-27 12:24:08','2020-07-27 12:24:08'),(3,3,'rings',NULL,'rings.jpg',250,'gold-rings','2020-07-27 12:24:08','2020-07-27 12:24:08'),(4,1,'ring (1.5Ct)',NULL,'1.5ct_ring.jpg',5000,'diamond-ring-1.5ct','2020-07-27 14:03:04','2020-07-27 14:03:04'),(5,1,'ring (1Ct)',NULL,'1ct_ring.jpg',4000,'diamond-ring-1ct','2020-07-27 12:44:07','2020-07-27 12:44:07'),(6,1,'ring (2Ct)',NULL,'2ct_ring.jpg',6500,'diamond-ring-2ct','2020-07-27 12:44:07','2020-07-27 12:44:07'),(7,1,'earrings',NULL,'earrings.jpg',8000,'diamond-earrings','2020-07-27 12:44:07','2020-07-27 12:44:07'),(8,1,'necklace',NULL,'necklace.jpg',14500,'diamond-necklace','2020-07-27 12:44:07','2020-07-27 12:44:07'),(9,1,'raw',NULL,'raw.jpg',750,'diamond-raw','2020-07-27 12:44:07','2020-07-27 12:44:07'),(10,1,'shaped',NULL,'shaped.jpg',11500,'diamond-shaped','2020-07-27 12:44:07','2020-07-27 12:44:07'),(12,2,'ring (Sapphire)',NULL,'sapphire_ring.jpg',1200,'gems-sapphire-ring','2020-07-27 16:38:57','2020-07-27 16:38:57'),(13,2,'earrings (Sapphire)',NULL,'sapphire_earrings.jpg',2400,'gems-sapphire-earrings','2020-07-27 16:38:57','2020-07-27 16:38:57'),(14,2,'necklace (Sapphire)',NULL,'sapphire_necklace.jpg',3000,'gems-sapphire-necklace','2020-07-27 16:38:57','2020-07-27 16:38:57'),(15,2,'earrings (Emerald)',NULL,'emerald_earrings.jpg',2800,'gems-emerald-earrings','2020-07-27 17:13:20','2020-07-27 17:13:20'),(16,2,'necklace (Emerald)',NULL,'emerald_necklace.jpg',3500,'gems-emerald-necklace','2020-07-27 17:11:21','2020-07-27 17:11:21'),(17,2,'ring (Emerald)',NULL,'emerald_ring.jpg',1400,'gems-emerald-ring','2020-07-27 17:11:21','2020-07-27 17:11:21'),(18,2,'ring (Ruby)',NULL,'ruby_ring.jpg',3500,'gems-ruby-ring','2020-07-27 19:39:41','2020-07-27 19:39:41'),(19,2,'necklace (Ruby)',NULL,'ruby_necklace.jpg',8000,'gems-ruby-necklace','2020-07-27 19:39:41','2020-07-27 19:39:41'),(20,2,'earrings (Ruby)',NULL,'ruby_earrings.jpg',7000,'gems-ruby-earrings','2020-07-27 19:39:41','2020-07-27 19:39:41'),(21,2,'ring (Onyx)',NULL,'onyx_ring.jpg',350,'gems-onyx-ring','2020-07-27 23:34:43','2020-07-27 23:34:43'),(22,2,'earrings (Onyx)',NULL,'onyx_earrings.jpg',500,'gems-onyx-earrings','2020-07-27 23:34:43','2020-07-27 23:34:43'),(23,2,'necklace (Onyx)',NULL,'onyx_necklace.jpg',400,'gems-onyx-necklace','2020-07-27 23:34:43','2020-07-27 23:34:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `toUser_idx` (`u_id`),
  CONSTRAINT `toUser` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,13,NULL,NULL,NULL,NULL),(2,20,'Sure','Nakhshol 8','Ramla','Israel');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `u_id` int NOT NULL,
  `r_id` int NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_id_UNIQUE` (`u_id`),
  CONSTRAINT `toUserId` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (13,6),(20,6);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'no-image.png',
  `password` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (13,'Gary','gary@gmail.com','1597750197*_*13*_*pexels-creation-hill-1681010.jpg','$2y$10$wosQYkPi4/cBe7fDyijL/OYSOdTBFkbcNAIjXISFj6mkvm8.L/322','2020-08-18 11:29:57','2020-08-18 14:29:57'),(20,'Anne','anne@email.com','1597751335*_*20*_*user-310807_1280.png','$2y$10$yBUm.PNJM8fKdKxqEHOI4e/AwVdnNU2E4zp2A4ZSJIR/SAX13psQe','2020-08-24 14:08:55','2020-08-24 17:08:55');
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

-- Dump completed on 2020-08-25 20:43:11
