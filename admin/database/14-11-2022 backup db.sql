-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for simple_news_website
CREATE DATABASE IF NOT EXISTS `simple_news_website` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `simple_news_website`;

-- Dumping structure for table simple_news_website.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` int DEFAULT NULL,
  `maneger_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_and_token` (`email`,`token`) USING BTREE,
  KEY `FK_admin_admin` (`maneger_id`),
  CONSTRAINT `FK_admin_admin` FOREIGN KEY (`maneger_id`) REFERENCES `admin` (`id`),
  CONSTRAINT `admin_email_check` CHECK ((`email` like _utf8mb4'%gmail.com')),
  CONSTRAINT `admin_phone_number_check` CHECK ((`phone_number` > 99999999))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table simple_news_website.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simple_news_website.classify
CREATE TABLE IF NOT EXISTS `classify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `news_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_classify_category` (`category_id`),
  KEY `FK_classify_news` (`news_id`),
  CONSTRAINT `FK_classify_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_classify_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simple_news_website.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email_and_token` (`email`,`token`) USING BTREE,
  CONSTRAINT `customer_email_check` CHECK ((`email` like _utf8mb4'%@gmail.com')),
  CONSTRAINT `customer_phone_number_check` CHECK ((`phone_number` > 99999999))
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table simple_news_website.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customers_id` int NOT NULL,
  `browse_admin_id` int NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_pinned` bit(1) NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_id` (`customers_id`),
  KEY `FK_news_admin` (`browse_admin_id`),
  CONSTRAINT `FK_news_admin` FOREIGN KEY (`browse_admin_id`) REFERENCES `admin` (`id`),
  CONSTRAINT `FK_news_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `is_pinned_check` CHECK ((`is_pinned` < 2)),
  CONSTRAINT `status_check` CHECK ((`status` < 4))
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='status:\r\n0 - this news have been denied by admin or super admin\r\n1 - customer recently push this news and waiting for admin check\r\n2 - admin accept this news and push request for supper admin browse\r\n3 - super admin accept request and public this news\r\n\r\n';

-- Data exporting was unselected.

-- Dumping structure for table simple_news_website.rating_comment
CREATE TABLE IF NOT EXISTS `rating_comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `rating` bit(1) DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `customer_id` (`customer_id`),
  KEY `news_id` (`news_id`),
  KEY `FK_rating_comment_rating_comment` (`reply_id`),
  CONSTRAINT `FK_rating_comment_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `FK_rating_comment_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `FK_rating_comment_rating_comment` FOREIGN KEY (`reply_id`) REFERENCES `rating_comment` (`id`),
  CONSTRAINT `rating_check` CHECK ((`rating` < 6))
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
