/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - installsmm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`installsmm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `installsmm`;

/*Table structure for table `listing_categories` */

DROP TABLE IF EXISTS `listing_categories`;

CREATE TABLE `listing_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listing_categories` */

insert  into `listing_categories`(`id`,`icon`,`status`,`created_at`,`updated_at`) values 
(1,'fab fa-accessible-icon',1,'2024-05-27 11:27:42','2024-05-27 11:27:42'),
(2,'fas fa-hotel',1,'2024-05-27 11:28:04','2024-05-27 11:28:04'),
(3,'fas fa-shopping-cart',1,'2024-05-27 11:28:21','2024-05-27 11:28:21'),
(4,'fab fa-amilia',1,'2024-05-27 11:28:54','2024-05-27 11:28:54'),
(5,'fas fa-battery-quarter',1,'2024-05-27 11:29:30','2024-05-27 11:29:30'),
(6,'fas fa-bed',1,'2024-05-27 11:30:06','2024-05-27 11:30:06'),
(7,'fas fa-warehouse',1,'2024-05-27 11:31:22','2024-05-27 11:31:22'),
(8,'fas fa-file-medical-alt',1,'2024-05-27 11:31:54','2024-05-27 11:31:54'),
(9,'fab fa-accessible-icon',1,'2024-05-27 11:32:15','2024-05-27 11:32:15'),
(10,'fas fa-book-open',1,'2024-05-27 11:32:30','2024-05-27 11:32:30'),
(11,'far fa-building',1,'2024-05-27 11:32:45','2024-05-27 11:32:45'),
(12,'fas fa-shopping-bag',1,'2024-05-27 11:32:58','2024-05-27 11:32:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
