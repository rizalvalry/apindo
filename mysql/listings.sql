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

/*Table structure for table `listings` */

DROP TABLE IF EXISTS `listings`;

CREATE TABLE `listings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` text DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `place_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `long` varchar(191) DEFAULT NULL,
  `youtube_video_id` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 =>pending, 1=> approved, 2=> rejected',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>deactive, 1=>active',
  `rejected_reason` longtext DEFAULT NULL,
  `deactive_reason` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `fb_app_id` varchar(191) DEFAULT NULL,
  `fb_page_id` varchar(191) DEFAULT NULL,
  `whatsapp_number` varchar(191) DEFAULT NULL,
  `replies_text` text DEFAULT NULL,
  `body_text` longtext DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_user_id_index` (`user_id`),
  KEY `listings_category_id_index` (`category_id`(768)),
  KEY `listings_purchase_package_id_index` (`purchase_package_id`),
  KEY `listings_place_id_index` (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listings` */

insert  into `listings`(`id`,`user_id`,`category_id`,`purchase_package_id`,`place_id`,`title`,`email`,`phone`,`description`,`address`,`lat`,`long`,`youtube_video_id`,`thumbnail`,`driver`,`status`,`is_active`,`rejected_reason`,`deactive_reason`,`created_at`,`fb_app_id`,`fb_page_id`,`whatsapp_number`,`replies_text`,`body_text`,`updated_at`,`deleted_at`) values 
(1,1,'[\"5\"]',2,1,'Next Level Electronics','cawangbsi@gmail.com',2147483647,'<p>This is the Electronics Component Item</p>','Jakarta Special Capital Region, Gambir, Jakarta, IDN','-6.1747565','106.8270734',NULL,'listingsThumbnail/e5ldQwWvhKuLJmI8TgVOpt8QK3jZYhZMmrmmON8S.jpg','local',1,1,NULL,NULL,'2024-05-28 05:22:19',NULL,NULL,NULL,NULL,'Hi there ? <br> <br> How can i help you?','2024-05-28 12:39:10',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
