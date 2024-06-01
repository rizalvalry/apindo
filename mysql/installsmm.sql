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
-- CREATE DATABASE /*!32312 IF NOT EXISTS*/`installsmm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

-- USE `installsmm`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `driver` varchar(20) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `admin_access` longtext DEFAULT NULL,
  `last_login` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`username`,`email`,`password`,`image`,`driver`,`phone`,`address`,`admin_access`,`last_login`,`status`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','admin','admin@gmail.com','$2y$10$MjIGHeJr/lPkyrQrHhPK8usJwoFVYdpmpVG807ZhBWxGtDslyCtbC','adminProfile/YiKSqPeNWPDIgCBI5l7wsqM0RyIw3Cg1vJzYukl9.jpg','local','+5641 455646','TX, USA','[\"admin.dashboard\",\"admin.staff\",\"admin.storeStaff\",\"admin.updateStaff\",\"admin.identify-form\",\"admin.identify-form.store\",\"admin.identify-form.action\",\"admin.users\",\"admin.user-multiple-active\",\"admin.user-multiple-inactive\",\"admin.user-edit\",\"admin.email-send\",\"admin.kyc.users.pending\",\"admin.kyc.kyc.users\",\"admin.email-send.store\",\"admin.user-update\",\"admin.userPasswordUpdate\",\"admin.userKycHistory\",\"admin.send-email\",\"admin.login-as-user\",\"admin.users.Kyc.action\",\"admin.package\",\"admin.purchasePackageList\",\"admin.packageCreate\",\"admin.packageEdit\",\"admin.packageDelete\",\"admin.userPurchasePackageDelete\",\"admin.listingCategory\",\"admin.viewListings\",\"admin.listingSettings\",\"admin.wishList\",\"admin.productEnquiry\",\"admin.listingAnalytics\",\"admin.showListingAnalytics\",\"admin.listingReview\",\"admin.listingCategoryCreate\",\"admin.listingCategoryEdit\",\"admin.editListing\",\"admin.listingCategoryDelete\",\"admin.viewListingDelete\",\"admin.wishListDelete\",\"admin.listingReviewDelete\",\"admin.listingAnalyticsDelete\",\"admin.amenities\",\"admin.amenitiesCreate\",\"admin.amenitiesEdit\",\"admin.amenitiesDelete\",\"admin.place\",\"admin.placeCreate\",\"admin.placeEdit\",\"admin.placeDelete\",\"admin.claimBusiness\",\"admin.claimMessageDelete\",\"admin.contactMessage\",\"admin.contactMessageDelete\",\"admin.transaction\",\"admin.transaction.search\",\"admin.subscriber.index\",\"admin.subscriber.sendEmail\",\"admin.subscriber.remove\",\"admin.payment.methods\",\"admin.deposit.manual.index\",\"admin.deposit.manual.create\",\"admin.edit.payment.methods\",\"admin.deposit.manual.edit\",\"admin.payment.pending\",\"admin.payment.log\",\"admin.payment.search\",\"admin.payment.action\",\"admin.ticket\",\"admin.ticket.view\",\"admin.ticket.reply\",\"admin.ticket.delete\",\"admin.basic-controls\",\"admin.email-controls\",\"admin.email-template.show\",\"admin.sms.config\",\"admin.sms-template\",\"admin.notify-config\",\"admin.notify-template.show\",\"admin.notify-template.edit\",\"admin.basic-controls.update\",\"admin.email-controls.update\",\"admin.email-template.edit\",\"admin.sms-template.edit\",\"admin.notify-config.update\",\"admin.notify-template.update\",\"admin.language.index\",\"admin.language.create\",\"admin.language.edit\",\"admin.language.keywordEdit\",\"admin.language.delete\",\"admin.manage.theme\",\"admin.logo-seo\",\"admin.breadcrumb\",\"admin.template.show\",\"admin.content.index\",\"admin.content.create\",\"admin.logoUpdate\",\"admin.seoUpdate\",\"admin.breadcrumbUpdate\",\"admin.content.show\",\"admin.content.delete\",\"admin.blogCategory\",\"admin.blogList\",\"admin.blogCategoryCreate\",\"admin.blogCreate\",\"admin.blogCategoryEdit\",\"admin.blogEdit\",\"admin.blogCategoryDelete\",\"admin.blogDelete\"]','2024-05-31 17:15:49',1,'mSTT5Hxb18mRckMPU9by93ryOAUSoVOkMslGOs078nAX0Ui6e3MaA72Cfj3t','2021-12-17 11:00:01','2024-05-31 17:15:49'),
(2,'Staff','staff','staff@staff.com','$2y$10$wnKJKURjEzNQ90OEvNleG.jbM5h9mFd5ZuuMfj.Mzr/DU8fM5.PPm',NULL,NULL,'+9454 4541541',NULL,'[\"admin.dashboard\",\"admin.staff\",\"admin.storeStaff\",\"admin.updateStaff\",\"admin.identify-form\",\"admin.identify-form.store\",\"admin.identify-form.action\",\"admin.users\",\"admin.user-multiple-active\",\"admin.user-multiple-inactive\",\"admin.user-edit\",\"admin.email-send\",\"admin.kyc.users.pending\",\"admin.kyc.kyc.users\",\"admin.email-send.store\",\"admin.user-update\",\"admin.userPasswordUpdate\",\"admin.userKycHistory\",\"admin.send-email\",\"admin.login-as-user\",\"admin.users.Kyc.action\",\"admin.package\",\"admin.purchasePackageList\",\"admin.packageCreate\",\"admin.packageEdit\",\"admin.packageDelete\",\"admin.userPurchasePackageDelete\",\"admin.listingCategory\",\"admin.viewListings\",\"admin.listingSettings\",\"admin.wishList\",\"admin.productEnquiry\",\"admin.listingAnalytics\",\"admin.showListingAnalytics\",\"admin.listingReview\",\"admin.listingCategoryCreate\",\"admin.listingCategoryEdit\",\"admin.editListing\",\"admin.listingCategoryDelete\",\"admin.viewListingDelete\",\"admin.wishListDelete\",\"admin.listingReviewDelete\",\"admin.listingAnalyticsDelete\",\"admin.amenities\",\"admin.amenitiesCreate\",\"admin.amenitiesEdit\",\"admin.amenitiesDelete\",\"admin.place\",\"admin.placeCreate\",\"admin.placeEdit\",\"admin.placeDelete\",\"admin.claimBusiness\",\"admin.claimMessageDelete\",\"admin.contactMessage\",\"admin.contactMessageDelete\",\"admin.transaction\",\"admin.transaction.search\",\"admin.subscriber.index\",\"admin.subscriber.sendEmail\",\"admin.subscriber.remove\",\"admin.payment.methods\",\"admin.deposit.manual.index\",\"admin.deposit.manual.create\",\"admin.edit.payment.methods\",\"admin.deposit.manual.edit\",\"admin.payment.pending\",\"admin.payment.log\",\"admin.payment.search\",\"admin.payment.action\",\"admin.ticket\",\"admin.ticket.view\",\"admin.ticket.reply\",\"admin.ticket.delete\",\"admin.basic-controls\",\"admin.email-controls\",\"admin.email-template.show\",\"admin.sms.config\",\"admin.sms-template\",\"admin.notify-config\",\"admin.notify-template.show\",\"admin.notify-template.edit\",\"admin.basic-controls.update\",\"admin.email-controls.update\",\"admin.email-template.edit\",\"admin.sms-template.edit\",\"admin.notify-config.update\",\"admin.notify-template.update\",\"admin.language.index\",\"admin.language.create\",\"admin.language.edit\",\"admin.language.keywordEdit\",\"admin.language.delete\",\"admin.manage.theme\",\"admin.logo-seo\",\"admin.breadcrumb\",\"admin.template.show\",\"admin.content.index\",\"admin.content.create\",\"admin.logoUpdate\",\"admin.seoUpdate\",\"admin.breadcrumbUpdate\",\"admin.content.show\",\"admin.content.delete\",\"admin.blogCategory\",\"admin.blogList\",\"admin.blogCategoryCreate\",\"admin.blogCreate\",\"admin.blogCategoryEdit\",\"admin.blogEdit\",\"admin.blogCategoryDelete\",\"admin.blogDelete\"]','2024-05-28 04:27:59',1,NULL,'2022-05-25 22:29:03','2024-05-28 04:27:59');

/*Table structure for table `amenities` */

DROP TABLE IF EXISTS `amenities`;

CREATE TABLE `amenities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `amenities` */

insert  into `amenities`(`id`,`icon`,`status`,`created_at`,`updated_at`) values 
(1,'fas fa-heart',1,'2024-05-28 09:19:14','2024-05-28 09:19:14'),
(2,'fas fa-headphones-alt',1,'2024-05-28 04:29:58','2024-05-28 04:29:58');

/*Table structure for table `amenity_details` */

DROP TABLE IF EXISTS `amenity_details`;

CREATE TABLE `amenity_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amenity_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amenity_details_amenity_id_index` (`amenity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `amenity_details` */

insert  into `amenity_details`(`id`,`amenity_id`,`language_id`,`title`,`created_at`,`updated_at`) values 
(1,1,1,'Amenities','2024-05-28 09:19:14','2024-05-28 09:19:14'),
(2,2,1,'New Test','2024-05-28 04:29:58','2024-05-28 04:29:58');

/*Table structure for table `analytics` */

DROP TABLE IF EXISTS `analytics`;

CREATE TABLE `analytics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_owner_id` bigint(20) unsigned DEFAULT NULL,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `visitor_ip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `os_platform` varchar(255) DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analytics_listing_owner_id_index` (`listing_owner_id`),
  KEY `analytics_listing_id_index` (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `analytics` */

insert  into `analytics`(`id`,`listing_owner_id`,`listing_id`,`visitor_ip`,`country`,`city`,`code`,`lat`,`long`,`os_platform`,`browser`,`created_at`,`updated_at`) values 
(1,1,2,'::1',NULL,NULL,NULL,NULL,NULL,'Windows 10','Chrome','2023-05-27 16:31:56','2023-05-27 16:31:56'),
(2,1,1,'::1',NULL,NULL,NULL,NULL,NULL,'Windows 10','Chrome','2024-05-28 12:34:18','2024-05-28 12:34:18'),
(3,1,1,'::1',NULL,NULL,NULL,NULL,NULL,'Windows 10','Chrome','2024-05-28 05:37:43','2024-05-28 05:37:43');

/*Table structure for table `blog_categories` */

DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_categories` */

/*Table structure for table `blog_category_details` */

DROP TABLE IF EXISTS `blog_category_details`;

CREATE TABLE `blog_category_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_category_details_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blog_category_details_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_category_details` */

/*Table structure for table `blog_details` */

DROP TABLE IF EXISTS `blog_details`;

CREATE TABLE `blog_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_details_blog_id_foreign` (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_details` */

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blogs` */

/*Table structure for table `business_hours` */

DROP TABLE IF EXISTS `business_hours`;

CREATE TABLE `business_hours` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `working_day` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_hours_listing_id_index` (`listing_id`),
  KEY `business_hours_purchase_package_id_index` (`purchase_package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `business_hours` */

insert  into `business_hours`(`id`,`listing_id`,`purchase_package_id`,`working_day`,`start_time`,`end_time`,`created_at`,`updated_at`) values 
(3,1,2,'Monday',NULL,NULL,'2024-05-28 12:39:10','2024-05-28 12:39:10');

/*Table structure for table `claim_businesses` */

DROP TABLE IF EXISTS `claim_businesses`;

CREATE TABLE `claim_businesses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `claim_businesses_listing_id_index` (`listing_id`),
  KEY `claim_businesses_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `claim_businesses` */

/*Table structure for table `configures` */

DROP TABLE IF EXISTS `configures`;

CREATE TABLE `configures` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(20) DEFAULT NULL,
  `base_color` varchar(10) NOT NULL DEFAULT '',
  `time_zone` varchar(30) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `currency_symbol` varchar(20) DEFAULT NULL,
  `theme` varchar(60) DEFAULT NULL,
  `fraction_number` int(11) DEFAULT NULL,
  `paginate` int(11) DEFAULT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `email_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_verification` tinyint(1) NOT NULL DEFAULT 0,
  `sms_notification` tinyint(1) NOT NULL DEFAULT 0,
  `sender_email` varchar(60) DEFAULT NULL,
  `sender_email_name` varchar(91) DEFAULT NULL,
  `email_description` longtext DEFAULT NULL,
  `email_configuration` text DEFAULT NULL,
  `push_notification` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `error_log` tinyint(1) NOT NULL,
  `strong_password` tinyint(1) NOT NULL,
  `registration` tinyint(1) NOT NULL,
  `address_verification` tinyint(1) NOT NULL,
  `identity_verification` tinyint(1) NOT NULL,
  `maintenance_mode` tinyint(1) NOT NULL,
  `is_active_cron_notification` tinyint(1) NOT NULL DEFAULT 0,
  `tawk_id` varchar(191) DEFAULT NULL,
  `tawk_status` tinyint(1) NOT NULL DEFAULT 0,
  `fb_messenger_status` tinyint(1) NOT NULL DEFAULT 0,
  `fb_app_id` varchar(191) DEFAULT NULL,
  `fb_page_id` varchar(191) DEFAULT NULL,
  `reCaptcha_status_login` tinyint(1) NOT NULL DEFAULT 0,
  `reCaptcha_status_registration` tinyint(1) NOT NULL DEFAULT 0,
  `MEASUREMENT_ID` varchar(191) DEFAULT NULL,
  `analytic_status` tinyint(1) DEFAULT 0,
  `listing_approval` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `configures` */

insert  into `configures`(`id`,`site_title`,`base_color`,`time_zone`,`currency`,`currency_symbol`,`theme`,`fraction_number`,`paginate`,`email_verification`,`email_notification`,`sms_verification`,`sms_notification`,`sender_email`,`sender_email_name`,`email_description`,`email_configuration`,`push_notification`,`created_at`,`updated_at`,`error_log`,`strong_password`,`registration`,`address_verification`,`identity_verification`,`maintenance_mode`,`is_active_cron_notification`,`tawk_id`,`tawk_status`,`fb_messenger_status`,`fb_app_id`,`fb_page_id`,`reCaptcha_status_login`,`reCaptcha_status_registration`,`MEASUREMENT_ID`,`analytic_status`,`listing_approval`) values 
(1,'Apindo','#184af9','Asia/Jakarta','Rupiah','Rp','classic',0,20,0,0,0,0,'support@mail.com','Bug Finder','<h1>\r\n                            </h1><h1></h1><p style=\"font-style:normal;font-weight:normal;color:rgb(68,168,199);font-size:36px;font-family:bitter, georgia, serif;text-align:center;\"> <br /></p>\r\n                        \r\n\r\n                        \r\n\r\n                            <p><strong>Hello [[name]],</strong></p>\r\n                            <p><strong>[[message]]</strong></p>\r\n                            <p><br /></p>\r\n                        \r\n\r\n                    \r\n                \r\n            \r\n\r\n            \r\n                \r\n                    \r\n                        <p style=\"font-style:normal;font-weight:normal;color:#ffffff;font-size:16px;font-family:bitter, georgia, serif;text-align:center;\">\r\n                            2021 ©  All Right Reserved\r\n                        </p>','{\"name\":\"smtp\",\"smtp_host\":\"smtp.mailtrap.io\",\"smtp_port\":\"2525\",\"smtp_encryption\":\"tls\",\"smtp_username\":\"b5aaa07f2d9897\",\"smtp_password\":\"3716d37da0fc95\"}',0,NULL,'2024-05-31 10:32:13',1,0,1,0,0,0,0,'sddgfsdf',0,0,NULL,NULL,0,0,'MEASUREMENT ID',0,0);

/*Table structure for table `contact_messages` */

DROP TABLE IF EXISTS `contact_messages`;

CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_user_id_index` (`user_id`),
  KEY `contact_messages_client_id_index` (`client_id`),
  KEY `contact_messages_listing_id_index` (`listing_id`),
  KEY `contact_messages_message_index` (`message`(768))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contact_messages` */

/*Table structure for table `content_details` */

DROP TABLE IF EXISTS `content_details`;

CREATE TABLE `content_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned DEFAULT NULL,
  `language_id` int(11) unsigned DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_details_content_id_foreign` (`content_id`),
  KEY `content_details_language_id_foreign` (`language_id`),
  CONSTRAINT `content_details_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  CONSTRAINT `content_details_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `content_details` */

insert  into `content_details`(`id`,`content_id`,`language_id`,`description`,`created_at`,`updated_at`) values 
(13,7,1,'{\"title\":\"ACTIVE CLIENTS\",\"number_of_data\":\"320\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(14,8,1,'{\"title\":\"PROJECTS DONE\",\"number_of_data\":\"850\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(15,9,1,'{\"title\":\"TEAM ADVISORS\",\"number_of_data\":\"28\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(16,10,1,'{\"title\":\"GLORIOUS YEARS\",\"number_of_data\":\"8\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(28,15,1,'{\"title\":\"Data Analytics\",\"short_description\":\"Favourite tolerably engrossed. Truth short why she their balls Excellence super powr sed eiusmodsed do eiusmod.\",\"button_name\":\"Read More\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(29,16,1,'{\"title\":\"Website Growth\",\"short_description\":\"Favourite tolerably engrossed. Truth short why she their balls Excellence super powr sed eiusmodsed do eiusmod.\",\"button_name\":\"Read More\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(30,17,1,'{\"title\":\"Smm Ranking\",\"short_description\":\"Favourite tolerably engrossed. Truth short why she their balls Excellence super powr sed eiusmodsed do eiusmod.\",\"button_name\":\"Read More\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(43,23,1,'{\"title\":\"What is your directory listing website?\",\"description\":\"Our directory listing website is a platform where businesses can list their products or services to increase their visibility and reach a wider audience.\"}','2021-12-17 11:00:13','2023-03-28 07:13:00'),
(44,24,1,'{\"title\":\"How do I submit my business to your directory listing website?\",\"description\":\"To submit your business, simply go to our website and click on the \\\"Add Listing\\\" button. You will be prompted to fill out a form with your business information and upload relevant images.\"}','2021-12-17 11:00:13','2023-03-28 07:14:39'),
(45,25,1,'{\"title\":\"Is there a fee to submit my business to your directory listing website?\",\"description\":\"We offer both free and paid listings on our website. The free listing allows you to list your business name, address, and phone number, while our paid listings offer additional features such as a custom description, photos, and higher visibility.\"}','2021-12-17 11:00:13','2023-03-28 07:27:51'),
(47,27,1,'{\"title\":\"How do I edit my business information on your directory listing website?\",\"description\":\"To edit your business information, log in to your account and go to your listing. From there, you can make any necessary changes to your business information and click \\\"Save\\\" to update it.\"}','2021-12-17 11:00:13','2023-03-28 07:32:19'),
(63,33,1,'{\"title\":\"Terms &amp; Conditions\",\"description\":\"<p>Welcome to ListPlace! By using our website, you agree to comply with and be bound by the following terms and conditions of use. Please read these terms carefully before using our website.<\\/p><ol><li>\\r\\n\\r\\nThe content of the pages of this website is for general information and use only. It is subject to change without notice.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nThis website may contain links to other websites that are not under the control of ListPlace. We have no control over the nature, content, and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorsement of the views expressed within them.\\r\\n<br \\/><br \\/><\\/li><li>\\r\\nUnauthorized use of this website may give rise to a claim for damages and\\/or be a criminal offense.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nYour use of this website and any dispute arising out of such use of the website is subject to the laws of the United States.\\r\\n<br \\/><br \\/><\\/li><li>\\r\\nListPlace reserves the right to modify, suspend or discontinue, temporarily or permanently, the website or any service to which it connects, with or without notice and without liability to you.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nListPlace reserves the right to change these terms and conditions at any time without prior notice. It is your responsibility to check for updates and changes to these terms and conditions regularly.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nListPlace is not responsible for any errors or omissions in any content, or for any loss or damage of any kind incurred as a result of the use of any content posted or otherwise transmitted via our website.<br \\/><br \\/><\\/li><li>\\u00a0All trademarks reproduced on this website which are not the property of, or licensed to the operator, are acknowledged on the website.<\\/li><li>\\r\\n\\r\\nYour use of this website and any dispute arising out of such use of the website is subject to the Privacy Policy available on our website.\\r\\n<br \\/><br \\/><br \\/><\\/li><\\/ol><p>By using ListPlace, you agree to comply with these terms and conditions of use. If you do not agree to these terms, please do not use our website.<br \\/><\\/p>\"}','2021-12-17 11:00:13','2023-03-28 08:01:45'),
(64,34,1,'{\"title\":\"Privacy Policy\",\"description\":\"<p>At ListPlace, we are committed to protecting your privacy and ensuring the security of your personal information. This privacy policy explains how we collect, use, and protect your personal information when you use our website.<\\/p><ol><li>\\r\\n\\r\\nInformation We Collect: We may collect personal information that you voluntarily provide to us, such as your name, email address, and phone number, when you use our website. We may also collect non-personal information, such as your IP address, browser type, and operating system.<br \\/><br \\/><\\/li><li>Use of Your Information: We may use your personal information to provide you with the services and products you request, to communicate with you about our products and services, and to improve our website and services. We may also use your information for analytics and research purposes.<br \\/><br \\/><\\/li><li>Protection of Your Information: We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. We use industry-standard security technologies and procedures to help protect your information.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nSharing Your Information: We do not sell or rent your personal information to third parties. However, we may share your information with third-party service providers that help us operate our website and provide our services to you. We may also share your information as required by law or to protect our legal rights.<br \\/><br \\/><\\/li><li>Cookies: We may use cookies to improve your experience on our website. Cookies are small text files that are placed on your device when you visit our website. You can set your browser to refuse cookies or to alert you when cookies are being sent.<br \\/><br \\/><\\/li><li>\\r\\n\\r\\nLinks to Other Websites: Our website may contain links to other websites that are not under our control. We are not responsible for the privacy practices or content of these websites.<br \\/><br \\/><\\/li><li>Contact Us: If you have any questions or concerns about our privacy policy, please contact us.<br \\/><br \\/><\\/li><\\/ol><p>By using our website, you agree to the terms of this privacy policy. If you do not agree to this privacy policy, please do not use our website.<br \\/><\\/p>\"}','2021-12-17 11:00:13','2023-03-28 07:59:34'),
(95,56,1,'{\"name\":\"Facebook\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(99,58,1,'{\"name\":\"Twitter\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(101,59,1,'{\"name\":\"Linkedin\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(103,60,1,'{\"name\":\"Instagram\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(105,61,1,'{\"title\":\"Amet pulvinar varius one\",\"description\":\"<p><span>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore is dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco. Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliq Ut enim ad minim veniam quis nostrud\\u00a0<\\/span><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliqu ip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <\\/span><\\/p><p><span><br \\/><\\/span><\\/p><p><span>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit volupt atem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia sit voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet sedit consectetur, adipisci velit, sed quia doloremque laudantium.<\\/span><\\/p>\"}','2021-12-17 11:00:13','2022-05-10 12:53:16'),
(107,62,1,'{\"title\":\"Amet pulvinar varius two\",\"description\":\"<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliqu ip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit volupt atem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia sit voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet sedit consectetur, adipisci velit, sed quia doloremque laudantium.<\\/span>\"}','2021-12-17 11:00:13','2022-05-10 10:37:29'),
(109,63,1,'{\"title\":\"Amet pulvinar varius three\",\"description\":\"Give lady of they such they sure it. Me contained explained my education. Vulgar as hearts by garret.Peived determine departure explained no forfeited he something an. Contrasted dissimilar getjoy petual you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence perpetual menorthward as difficult preserved daughters. Continued at up to zealously necessary breakfastshe end literature. Gay direction neglected but supported yet her.\\r\\n\\r\\nNew had happen unable uneasy. Drawings can explained my education. Vulgar as hearts by garret.me Perceived determine departure explained no forfeited he something an. Contrasted dissimilar get detereoy you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence meant stnorthward as difficult preserved daughters. Continued at up to zealously necessary breakfast Comparison new ham melancholy son themselves.\"}','2021-12-17 11:00:13','2022-05-10 10:29:13'),
(143,64,1,'{\"title\":\"All Members\",\"information\":\"25609\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(144,65,1,'{\"title\":\"Average Investment\",\"information\":\"12.5M\"}','2021-12-17 11:00:13','2022-05-08 07:36:29'),
(145,66,1,'{\"title\":\"Countries Supported\",\"information\":\"200\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(146,67,1,'{\"title\":\"Expert Management\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2022-05-08 00:28:20'),
(147,68,1,'{\"title\":\"Registered Company\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(148,69,1,'{\"title\":\"Secure Investment\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(149,70,1,'{\"title\":\"Verified Security\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(150,71,1,'{\"title\":\"Instant Withdrawal\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(151,72,1,'{\"title\":\"Registered Company\",\"information\":\"Replacing a maintains the amount of lines. When replacing a selection. help agencies to define their new business objectives and then create.\"}','2021-12-17 11:00:13','2021-12-17 11:00:13'),
(225,83,1,'{\"title\":\"sdfagdf\",\"description\":\"<p>i am jubayer<\\/p>\"}','2022-09-18 03:03:55','2022-09-18 03:04:06'),
(226,84,1,'{\"name\":\"Anik Vai\",\"description\":\"<p><strong>Lorem Ipsum<\\/strong><span>\\u00a0is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<\\/span><br \\/><\\/p>\",\"button_name\":\"Learn More\"}','2022-09-18 06:01:33','2022-09-18 06:01:33'),
(227,85,1,'{\"name\":\"Jubayer Vai\",\"description\":\"<p><span>here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.<\\/span><br \\/><\\/p>\",\"button_name\":\"Click Here\"}','2022-09-18 06:02:53','2022-09-18 06:02:53'),
(228,86,1,'{\"name\":\"Suzan Vai\",\"description\":\"<p><strong>Lorem Ipsum<\\/strong><span>\\u00a0is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<\\/span><br \\/><\\/p>\",\"button_name\":\"Go Somewhere\"}','2022-09-18 06:09:29','2022-09-18 06:09:29'),
(235,92,1,'{\"name\":\"Alex Gender\",\"designation\":\"Owner Of OFT\",\"description\":\"Amezing Platform for directory listing.\\u00a0<span>Good luck with sales<\\/span>\"}','2022-09-20 01:55:05','2023-05-16 18:13:27'),
(237,93,1,'{\"name\":\"jim morison\",\"designation\":\"Director, IUBAT\",\"description\":\"<span>Hi, nice script<\\/span><span>\\u00a0Congrats!, <\\/span><span>This script works very well with my business<\\/span><br \\/>\"}','2022-09-20 01:57:09','2023-05-16 18:19:47'),
(239,94,1,'{\"name\":\"selena gomez\",\"designation\":\"Manager, DUDT\",\"description\":\"I like your script very much.\\u00a0<span>Great project. Any plans for apps in near future ?<\\/span>\"}','2022-09-20 02:09:02','2023-05-16 18:15:37'),
(240,95,1,'{\"name\":\"Alex Turner\",\"designation\":\"CEO of WTI\",\"description\":\"Awesome listing platform. i like your script. price is also correct\\u00a0\"}','2022-09-20 02:09:54','2023-05-16 11:04:33'),
(246,96,1,'{\"title\":\"How do I claim ownership of my business listing on your directory listing website?\",\"description\":\"If your business is already listed on our website, you can claim ownership by clicking the \\\"Claim Listing\\\" button on the listing page. You will be prompted to verify your ownership through email or phone verification.\"}','2022-09-20 03:48:43','2023-03-28 07:33:21'),
(248,97,1,'{\"title\":\"How long does it take for my business to appear on your directory listing website?\",\"description\":\"Your business listing should appear on our website within 24-48 hours after submission. However, please note that our team manually reviews each submission to ensure accuracy and quality, which may cause a delay in the publication of your listing.\"}','2022-09-20 03:49:57','2023-03-28 07:34:05'),
(250,98,1,'{\"title\":\"Registration\",\"short_description\":\"<p>A user need to register in ListPlace by filling up very few details.<\\/p>\"}','2022-09-25 00:41:44','2023-05-16 11:50:59'),
(251,99,1,'{\"title\":\"Buy Package\",\"short_description\":\"A user needs to purchase a package to add a listing\"}','2022-09-25 00:42:01','2023-05-16 11:51:57'),
(252,100,1,'{\"title\":\"Add Listing\",\"short_description\":\"After purchasing a package users can enlist their business easily.\\u00a0\"}','2022-09-25 00:42:23','2023-05-16 11:53:00'),
(275,101,1,'{\"title\":\"Can I promote my business on your directory listing website?\",\"description\":\"Yes, we offer various advertising and promotional options for businesses looking to increase their visibility on our website. Please contact us for more information on our advertising options.\"}','2023-03-28 07:34:33','2023-03-28 07:34:33'),
(276,102,1,'{\"title\":\"How do I contact customer support if I have any issues with my business listing?\",\"description\":\"You can contact our customer support team by filling out the contact form on our website or by sending an email to our support email address. We aim to respond to all inquiries within 24-48 hours.\"}','2023-03-28 07:34:47','2023-03-28 07:34:47');

/*Table structure for table `content_media` */

DROP TABLE IF EXISTS `content_media`;

CREATE TABLE `content_media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_media_content_id_foreign` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `content_media` */

insert  into `content_media`(`id`,`content_id`,`description`,`driver`,`created_at`,`updated_at`) values 
(11,15,'{\"image\":\"6017b7984e39a1612167064.png\",\"button_link\":\"http:\\/\\/localhost\\/smm\\/admin\\/content-show\\/4\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(12,16,'{\"image\":\"6017b7b3451ce1612167091.png\",\"button_link\":\"http:\\/\\/localhost\\/smm\\/admin\\/content-show\\/4\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(13,17,'{\"image\":\"6017b7c0aa29f1612167104.png\",\"button_link\":\"http:\\/\\/localhost\\/smm\\/admin\\/content-show\\/4\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(34,56,'{\"link\":\"https:\\/\\/www.facebook.com\\/\",\"icon\":\"fab fa-facebook-f\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(36,58,'{\"link\":\"https:\\/\\/twitter.com\\/\",\"icon\":\"fab fa-twitter\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(37,59,'{\"link\":\"https:\\/\\/bd.linkedin.com\\/\",\"icon\":\"fab fa-linkedin-in\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(38,60,'{\"link\":\"https:\\/\\/www.instagram.com\\/\",\"icon\":\"fab fa-instagram\"}',NULL,'2021-12-17 11:00:20','2021-12-17 11:00:20'),
(39,61,'{\"image\":\"635e03dfb43991667105759.jpg\"}',NULL,'2021-12-17 11:00:20','2022-10-29 23:56:00'),
(40,62,'{\"image\":\"635e03e8b70db1667105768.jpg\"}',NULL,'2021-12-17 11:00:20','2022-10-29 23:56:08'),
(41,63,'{\"image\":\"635e03f1444191667105777.jpg\"}',NULL,'2021-12-17 11:00:20','2022-10-29 23:56:17'),
(42,64,'{\"image\":\"62778aa5540f51652001445.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:17:25'),
(43,65,'{\"image\":\"62778ac829ad41652001480.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:18:00'),
(44,66,'{\"image\":\"62778add42d101652001501.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:18:21'),
(45,67,'{\"image\":\"62778b2410ed91652001572.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:19:32'),
(46,68,'{\"image\":\"62778b32be6671652001586.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:19:46'),
(47,69,'{\"image\":\"62778b44d5d3b1652001604.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:20:04'),
(48,70,'{\"image\":\"62778b4d64d651652001613.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:20:13'),
(49,71,'{\"image\":\"62778b6116c9b1652001633.png\"}',NULL,'2021-12-17 11:00:20','2022-05-08 04:20:33'),
(50,72,'{\"image\":\"628e2e55809db1653485141.png\"}',NULL,'2021-12-17 11:00:20','2022-05-25 08:25:41'),
(60,83,'{\"image\":\"6326d0ebbe5721663488235.jpg\"}',NULL,'2022-09-18 03:03:55','2022-09-18 03:03:55'),
(61,84,'{\"image\":\"6326fa8df0d881663498893.jpg\",\"button_link\":\"https:\\/\\/www.facebook.com\\/\"}',NULL,'2022-09-18 06:01:34','2022-09-18 06:01:34'),
(62,85,'{\"image\":\"6326fadde10a41663498973.jpg\",\"button_link\":\"https:\\/\\/www.youtube.com\\/embed\\/webtraininginstitute\"}',NULL,'2022-09-18 06:02:53','2022-09-18 06:02:53'),
(63,86,'{\"image\":\"6326fc69c065c1663499369.jpg\",\"button_link\":\"https:\\/\\/www.google.com\\/\"}',NULL,'2022-09-18 06:09:29','2022-09-18 06:09:29'),
(69,92,'{\"image\":\"content\\/vHgfCKvT1aay4au8SV1ccEJ2dzEGOf0ucYbggxo0.jpg\"}','local','2022-09-20 01:55:05','2023-05-16 11:00:00'),
(70,93,'{\"image\":\"content\\/MdKSSmqsEzNzgPNORSbUBmX562nBiQhGhuWJAxG9.jpg\"}','local','2022-09-20 01:57:09','2023-05-16 11:01:20'),
(71,94,'{\"image\":\"content\\/JSM9hNF8wWUptciMzSeHR2IboSDBIqM1Gj2MZZ3y.jpg\"}','local','2022-09-20 02:09:02','2023-05-16 11:02:49'),
(72,95,'{\"image\":\"content\\/6qOCho4gOe8NrrQkk93boehkBQ9y2SEEozYNwOPA.jpg\"}','local','2022-09-20 02:09:54','2023-05-16 11:04:35'),
(73,98,'{\"image\":\"content\\/Ncj6z1QdhrU96yqDIHQjoQzLgn14OcqpKkd8igpE.png\"}','local','2022-09-25 00:41:44','2023-05-16 10:50:15'),
(74,99,'{\"image\":\"content\\/Lzi0KvA1sZxEkKSafhfBN2XM37V9p7AS6cF1g7wf.png\"}','local','2022-09-25 00:42:01','2023-05-16 10:54:23'),
(75,100,'{\"image\":\"content\\/A16Le6uEFARdVlB9CUFaaqenfZuj8Vq5SJJD1nZv.png\"}','local','2022-09-25 00:42:23','2023-05-16 10:55:26');

/*Table structure for table `contents` */

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contents` */

insert  into `contents`(`id`,`name`,`created_at`,`updated_at`) values 
(7,'counter','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(8,'counter','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(9,'counter','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(10,'counter','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(15,'service','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(16,'service','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(17,'service','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(23,'faq','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(24,'faq','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(25,'faq','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(27,'faq','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(33,'support','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(34,'support','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(56,'social','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(58,'social','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(59,'social','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(60,'social','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(61,'blog','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(62,'blog','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(63,'blog','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(64,'feature','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(65,'feature','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(66,'feature','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(67,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(68,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(69,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(70,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(71,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(72,'why-chose-us','2021-12-17 10:59:33','2021-12-17 10:59:33'),
(83,'jubayer','2022-09-18 03:03:55','2022-09-18 03:03:55'),
(84,'team-member','2022-09-18 06:01:33','2022-09-18 06:01:33'),
(85,'team-member','2022-09-18 06:02:53','2022-09-18 06:02:53'),
(86,'team-member','2022-09-18 06:09:29','2022-09-18 06:09:29'),
(92,'testimonial','2022-09-20 01:55:05','2022-09-20 01:55:05'),
(93,'testimonial','2022-09-20 01:57:09','2022-09-20 01:57:09'),
(94,'testimonial','2022-09-20 02:08:39','2022-09-20 02:08:39'),
(95,'testimonial','2022-09-20 02:09:53','2022-09-20 02:09:53'),
(96,'faq','2022-09-20 03:48:43','2022-09-20 03:48:43'),
(97,'faq','2022-09-20 03:49:57','2022-09-20 03:49:57'),
(98,'how-it-work','2022-09-25 00:41:44','2022-09-25 00:41:44'),
(99,'how-it-work','2022-09-25 00:42:01','2022-09-25 00:42:01'),
(100,'how-it-work','2022-09-25 00:42:23','2022-09-25 00:42:23'),
(101,'faq','2023-03-28 07:34:33','2023-03-28 07:34:33'),
(102,'faq','2023-03-28 07:34:47','2023-03-28 07:34:47');

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) unsigned DEFAULT NULL,
  `template_key` varchar(120) DEFAULT NULL,
  `email_from` varchar(191) DEFAULT 'support@exampl.com',
  `name` varchar(191) NOT NULL,
  `subject` varchar(191) NOT NULL,
  `template` text DEFAULT NULL,
  `sms_body` text DEFAULT NULL,
  `short_keys` text DEFAULT NULL,
  `mail_status` tinyint(1) NOT NULL DEFAULT 0,
  `sms_status` tinyint(1) NOT NULL DEFAULT 0,
  `lang_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_templates_language_id_foreign` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `email_templates` */

insert  into `email_templates`(`id`,`language_id`,`template_key`,`email_from`,`name`,`subject`,`template`,`sms_body`,`short_keys`,`mail_status`,`sms_status`,`lang_code`,`created_at`,`updated_at`) values 
(1,1,'PROFILE_UPDATE','support@mail.com','Profile has been updated','Profile has been updated','Your first name [[firstname]]\r\n\r\nlast name [[lastname]]\r\n\r\nemail [[email]]\r\n\r\nphone number [[phone]]\r\n','Your first name [[firstname]]\r\n\r\nlast name [[lastname]]\r\n\r\nemail [[email]]\r\n\r\nphone number [[phone]]\r\n','{\"trx\":\"Transaction Number\",\"amount\":\"Request Amount By user\",\"charge\":\"Gateway Charge\",\"currency\":\"Site Currency\",\"rate\":\"Conversion Rate\",\"method_name\":\"Deposit Method Name\",\"method_currency\":\"Deposit Method Currency\",\"method_amount\":\"Deposit Method Amount After Conversion\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(2,1,'ADMIN_SUPPORT_REPLY','support@mail.com','Support Ticket Reply ','Support Ticket Reply','<p>Ticket ID [[ticket_id]]\r\n</p><p><span><br /></span></p><p><span>Subject [[ticket_subject]]\r\n</span></p><p><span>-----Replied------</span></p><p><span>\r\n[[reply]]</span><br /></p>','Ticket ID [[ticket_id]]\r\n\r\n\r\n\r\nSubject [[ticket_subject]]\r\n\r\n-----Replied------\r\n\r\n[[reply]]','{\"ticket_id\":\"Support Ticket ID\",\"ticket_subject\":\"Subject Of Support Ticket\",\"reply\":\"Reply from Staff\\/Admin\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(3,1,'PASSWORD_CHANGED','support@mail.com','PASSWORD CHANGED ','Your password changed ','Your password changed \r\n\r\nNew password [[password]]\r\n\r\n','Your password changed\r\n\r\nNew password [[password]]\r\n\r\n\r\nNews [[test]]','{\"password\":\"password\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(4,1,'ADD_BALANCE','support@mail.com','Balance Add by Admin','Your Account has been credited','[[amount]] [[currency]] credited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}',0,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(6,1,'DEDUCTED_BALANCE','support@mail.com','Balance deducted by Admin','Your Account has been debited','[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(9,1,'PAYMENT_COMPLETE','support@mail.com','Payment Completed','Your Payment Has Been Completed','[[package]] [[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\n\r\n','[[package]] [[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\n','{\"package\":\"package\",\"gateway_name\":\"gateway name\",\"amount\":\"amount\",\"charge\":\"charge\", \"currency\":\"currency\",\"transaction\":\"transaction\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(11,1,'PASSWORD_RESET','support@mail.com','Reset Password Notification','Reset Password Notification','You are receiving this email because we received a password reset request for your account.[[message]]\r\n\r\n\r\nThis password reset link will expire in 60 minutes.\r\n\r\nIf you did not request a password reset, no further action is required.','You are receiving this email because we received a password reset request for your account. [[message]]','{\"message\":\"message\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(12,1,'VERIFICATION_CODE','support@mail.com','Verification Code','Verify Your Email ','Your Email verification Code  [[code]]','Your SMS verification Code  [[code]]','{\"code\":\"code\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(21,1,'TWO_STEP_ENABLED','support@mail.com','TWO STEP ENABLED','TWO STEP ENABLED','Your verification code is: [[code]]','Your verification code is: [[code]]','{\"action\":\"Enabled Or Disable\",\"ip\":\"Device Ip\",\"browser\":\"browser and Operating System \",\"time\":\"Time\",\"code\":\"code\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(22,1,'TWO_STEP_DISABLED','support@mail.com','TWO STEP DISABLED','TWO STEP DISABLED','Google two factor verification is disabled','Google two factor verification is disabled','{\"action\":\"Enabled Or Disable\",\"ip\":\"Device Ip\",\"browser\":\"browser and Operating System \",\"time\":\"Time\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(24,1,'PAYOUT_REQUEST','support@mail.com','Withdraw request has been sent','Withdraw request has been sent','[[amount]] [[currency]] withdraw requested by [[method_name]]\r\n\r\n\r\nCharge [[charge]] [[currency]]\r\n\r\nTransaction [[trx]]\r\n','[[amount]] [[currency]] withdraw requested by [[method_name]]\r\n\r\n\r\nCharge [[charge]] [[currency]]\r\n\r\nTransaction [[trx]]\r\n','{\"method_name\":\"method name\",\"amount\":\"amount\",\"charge\":\"charge\",\"currency\":\"currency\",\"trx\":\"transaction\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(27,1,'PAYOUT_REJECTED','support@mail.com','Withdraw request has been rejected','Withdraw request has been rejected','[[amount]] [[currency]] withdraw has been rejeced\n\nPayout Method [[method]]\nCharge [[charge]] [[currency]]\nTransaction [[transaction]]\n\n\nAdmin feedback [[feedback]]\n\n','[[amount]] [[currency]] withdraw has been rejeced\r\n\r\nPayout Method [[method]]\r\nCharge [[charge]] [[currency]]\r\nTransaction [[transaction]]\r\n\r\n\r\nAdmin feedback [[feedback]]\r\n\r\n','{\"method\":\"Payout method\",\"amount\":\"amount\",\"charge\":\"charge\",\"currency\":\"currency\",\"transaction\":\"transaction\",\"feedback\":\"Admin feedback\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(28,1,'PAYOUT_APPROVE ','support@mail.com','Withdraw request has been approved','Withdraw request has been approved','[[amount]] [[currency]] withdraw has been approved\r\n\r\nPayout Method [[method]]\r\nCharge [[charge]] [[currency]]\r\nTransaction [[transaction]]\r\n\r\n\r\nAdmin feedback [[feedback]]\r\n\r\n','[[amount]] [[currency]] withdraw has been approved\n\nPayout Method [[method]]\nCharge [[charge]] [[currency]]\nTransaction [[transaction]]\n\n\nAdmin feedback [[feedback]]\n\n','{\"method\":\"Payout method\",\"amount\":\"amount\",\"charge\":\"charge\",\"currency\":\"currency\",\"transaction\":\"transaction\",\"feedback\":\"Admin feedback\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(40,1,'KYC_APPROVED','support@mail.com','KYC has been approved','KYC has been approved','[[kyc_type]] has been approved\r\n\r\n','[[kyc_type]] has been approved\r\n','{\"kyc_type\":\"kyc type\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(41,1,'KYC_REJECTED','support@mail.com','KYC has been rejected','KYC has been rejected','[[kyc_type]] has been rejected\r\n\r\n','[[kyc_type]] has been rejected\r\n','{\"kyc_type\":\"kyc type\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(44,1,'LISTING_MESSAGE','support@mail.com','Listing Message','Listing Message','<p>[[from]] has sent a message to [[listingTitle]] listing </p>','<p>[[from]] has sent a message to [[listingTitle]] listing </p>','{\"listingTitle\":\"listingTitle\",\"from\":\"from\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:38:19'),
(50,1,'VIEWER_MESSAGE','support@mail.com','VIEWER MESSAGE','VIEWER MESSAGE','[[from]] has sent a contact message Email: [[email]]\r\n','[[from]] has sent a contact message Email: [[email]]','{\"from\":\"from\",\"email\":\"email\"}',1,1,'US','2022-11-24 01:24:32','2022-11-24 01:24:32'),
(51,1,'PAYMENT_APPROVED','support@mail.com','PAYMENT APPROVED','Your [[package]] Payment Has Been Approved','Your [[package]] [[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nFeedback [[feedback]]\r\n\r\n','Your [[package]] [[amount]] [[currency]] Payment Has Been successful via [[gateway_name]]\r\n\r\nCharge[[charge]] [[currency]]\r\n\r\nTranaction [[transaction]]\r\n\r\nFeedback [[feedback]]\r\n\r\n','{\"package\":\"package\",\"gateway_name\":\"gateway_name\",\"amount\":\"amount\",\"charge\":\"charge\", \"currency\":\"currency\",\"transaction\":\"transaction\",\"feedback\":\"feedback\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(52,1,'PAYMENT_REJECTED','support@mail.com','PAYMENT REJECTED','Your [[package]] Payment Has Been Rejected','Your [[package]] [[amount]] [[currency]] Payment Has Been Rejected\r\n\r\nFeedback [[feedback]]','Your [[package]] [[amount]] [[currency]] Payment Has Been Rejected\r\n\r\nFeedback [[feedback]]\r\n\r\n','{\"package\":\"package\",\"gateway_name\":\"gateway_name\",\"amount\":\"amount\",\"currency\":\"currency\",\"transaction\":\"transaction\",\"feedback\":\"feedback\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(53,1,'USER_MAIL_HIS_KYC_REQUEST_SEND','support@mail.com','KYC REQUEST','KYC REQUEST','[[name]] send your kyc request at [[date]] \r\n','[[name]] send your kyc request at [[date]]\r\n','{\"name\":\"name\",\"date\":\"date\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(54,1,'ADMIN_MAIL_USER_KYC_REQUEST','support@mail.com','KYC REQUEST','KYC REQUEST','[[name]] send kyc request at [[date]] \r\n','[[name]] send kyc request at [[date]] \r\n','{\"name\":\"name\",\"date\":\"date\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(55,1,'USER_MAIL_ADDRESS_VERIFICATION_REQUEST_SEND','support@mail.com','Address Verification Request','Address Verification Request','[[name]] send your address verification request at [[date]] \r\n','[[name]] send your address verification request at [[date]] ','{\"name\":\"name\",\"date\":\"date\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19'),
(56,1,'ADMIN_MAIL_USER_ADDRESS_VERIFICATION_REQUEST','support@mail.com','Address Verification Request','Address Verification Request','[[name]] send your address verification request at [[date]] \r\n','[[name]] send your address verification request at [[date]] ','{\"name\":\"name\",\"date\":\"date\"}',1,1,'en','2021-12-17 11:00:26','2022-10-25 07:03:19');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `favourites` */

DROP TABLE IF EXISTS `favourites`;

CREATE TABLE `favourites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favourites_user_id_index` (`user_id`),
  KEY `favourites_client_id_index` (`client_id`),
  KEY `favourites_purchase_package_id_index` (`purchase_package_id`),
  KEY `favourites_listing_id_index` (`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `favourites` */

/*Table structure for table `followers` */

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `following_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `followers_user_id_index` (`user_id`),
  KEY `followers_following_id_index` (`following_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `followers` */

/*Table structure for table `funds` */

DROP TABLE IF EXISTS `funds`;

CREATE TABLE `funds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `purchase_package_id` int(11) unsigned DEFAULT NULL,
  `gateway_id` int(11) unsigned DEFAULT NULL,
  `gateway_currency` varchar(191) DEFAULT NULL,
  `amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) DEFAULT 0.00000000,
  `final_amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `btc_amount` decimal(18,8) DEFAULT NULL,
  `btc_wallet` varchar(191) DEFAULT NULL,
  `transaction` varchar(25) DEFAULT NULL,
  `remarks` varchar(191) DEFAULT NULL,
  `try` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=> Complete, 2=> Pending, 3 => Cancel',
  `detail` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `funds_user_id_foreign` (`user_id`),
  KEY `funds_gateway_id_foreign` (`gateway_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `funds` */

insert  into `funds`(`id`,`user_id`,`purchase_package_id`,`gateway_id`,`gateway_currency`,`amount`,`charge`,`rate`,`final_amount`,`btc_amount`,`btc_wallet`,`transaction`,`remarks`,`try`,`status`,`detail`,`feedback`,`created_at`,`updated_at`,`payment_id`) values 
(1,1,1,10,'INR',15.00000000,0.50000000,1.00000000,15.50000000,0.00000000,'','EQMMQB2XWSAW','Buy Basic',0,0,NULL,NULL,'2024-05-28 04:20:30','2024-05-28 04:20:30',NULL);

/*Table structure for table `gateways` */

DROP TABLE IF EXISTS `gateways`;

CREATE TABLE `gateways` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `currency` varchar(191) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `parameters` text DEFAULT NULL,
  `extra_parameters` text DEFAULT NULL,
  `convention_rate` decimal(18,8) NOT NULL DEFAULT 1.00000000,
  `currencies` text DEFAULT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percentage_charge` decimal(8,4) NOT NULL DEFAULT 0.0000,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: inactive, 1: active',
  `note` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `sort_by` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gateways_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `gateways` */

insert  into `gateways`(`id`,`name`,`code`,`currency`,`symbol`,`parameters`,`extra_parameters`,`convention_rate`,`currencies`,`min_amount`,`max_amount`,`percentage_charge`,`fixed_charge`,`status`,`note`,`image`,`driver`,`sort_by`,`created_at`,`updated_at`) values 
(1,'Paypal','paypal','USD','USD','{\"cleint_id\":\"\",\"secret\":\"\"}',NULL,0.01200000,'{\"0\":{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}}',1.00000000,10000.00000000,1.0000,0.50000000,1,'','gateway/qT6seiZr2kNglMEn0P4ckco9tEAVZAut8PWreIf1.jpg','local',14,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(2,'Stripe ','stripe','USD','USD','{\"secret_key\":\"\",\"publishable_key\":\"\"}',NULL,1.00000000,'{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/4vc5td6nxihEAxv7JKXw9IuPN4VQIJAJFtXXRA5h.jpg','local',23,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(3,'Skrill','skrill','USD','USD','{\"pay_to_email\":\"\",\"secret_key\":\"\"}',NULL,1.00000000,'{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/dPkoLpcQIWvd5VDtSOQK3PoM0WLq7vjEbGaAqIdn.jpg','local',22,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(4,'Perfect Money','perfectmoney','USD','USD','{\"passphrase\":\"\",\"payee_account\":\"\"}',NULL,1.00000000,'{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/jVjkg0JKsFZBTQ3wtsI8fGhOcVEtYwYc7AnlpQSn.jpg','local',18,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(5,'PayTM','paytm','INR','INR','{\"MID\":\"\",\"merchant_key\":\"\",\"WEBSITE\":\"\",\"INDUSTRY_TYPE_ID\":\"\",\"CHANNEL_ID\":\"\",\"environment_url\":\"\",\"process_transaction_url\":\"\"}',NULL,1.00000000,'{\"0\":{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/IETV7RvQAwJYbmfAjG0xeGdU4MdqFnJAkKYkcOfS.jpg','local',16,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(6,'Payeer','payeer','RUB','USD','{\"merchant_id\":\"\",\"secret_key\":\"\"}','{\"status\":\"ipn\"}',1.00000000,'{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/AYsJ4k44hCs8vovNyEPXkMycI8YyFiOZoFPcDbun.jpg','local',12,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(7,'PayStack','paystack','NGN','NGN','{\"public_key\":\"\",\"secret_key\":\"\"}','{\"callback\":\"ipn\",\"webhook\":\"ipn\"}\r\n',1.00000000,'{\"0\":{\"USD\":\"USD\",\"NGN\":\"NGN\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/9PMqvh0Km71QqZjAGd1l4e8IRDcdAbLg7CKsrMtJ.jpg','local',15,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(8,'VoguePay','voguepay','USD','USD','{\"merchant_id\":\"\"}',NULL,1.00000000,'{\"0\":{\"NGN\":\"NGN\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"ZAR\":\"ZAR\",\"JPY\":\"JPY\",\"INR\":\"INR\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PLN\":\"PLN\"}}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/kbFUn64IRVNcGoPvQGRxkLoineS4XxviT2WQFvf8.jpg','local',21,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(9,'Flutterwave','flutterwave','USD','USD','{\"public_key\":\"\",\"secret_key\":\"\",\"encryption_key\":\"\"}',NULL,0.01200000,'{\"0\":{\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/mQ1ZKXNhyfWO58vxSjcXpSTmMMXerAWsoigHmr22.jpg','local',13,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(10,'RazorPay','razorpay','INR','INR','{\"key_id\":\"\",\"key_secret\":\"\"}',NULL,1.00000000,'{\"0\": {\"INR\": \"INR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/9dGNp4nkoWsuYcoaT9wj29piUFBQWIqX5IlVLHTE.jpg','local',19,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(11,'instamojo','instamojo','INR','INR','{\"api_key\":\"\",\"auth_token\":\"\",\"salt\":\"\"}',NULL,73.51000000,'{\"0\":{\"INR\":\"INR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/hBccmeWOWKNEDG0JButgIE316UySOFbDrl2317QM.jpg','local',5,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(12,'Mollie','mollie','USD','USD','{\"api_key\":\"\"}',NULL,0.01200000,'{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/DPYZrfG6pnfbpnsmMmLawZkVfU1gPLyco7C1F5Hv.jpg','local',10,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(13,'2checkout','twocheckout','USD','USD','{\"merchant_code\":\"\",\"secret_key\":\"\"}','{\"approved_url\":\"ipn\"}',1.00000000,'{\"0\":{\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"DZD\":\"DZD\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AZN\":\"AZN\",\"BSD\":\"BSD\",\"BDT\":\"BDT\",\"BBD\":\"BBD\",\"BZD\":\"BZD\",\"BMD\":\"BMD\",\"BOB\":\"BOB\",\"BWP\":\"BWP\",\"BRL\":\"BRL\",\"GBP\":\"GBP\",\"BND\":\"BND\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"XCD\":\"XCD\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"GTQ\":\"GTQ\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JMD\":\"JMD\",\"JPY\":\"JPY\",\"KZT\":\"KZT\",\"KES\":\"KES\",\"LAK\":\"LAK\",\"MMK\":\"MMK\",\"LBP\":\"LBP\",\"LRD\":\"LRD\",\"MOP\":\"MOP\",\"MYR\":\"MYR\",\"MVR\":\"MVR\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PGK\":\"PGK\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"WST\":\"WST\",\"SAR\":\"SAR\",\"SCR\":\"SCR\",\"SGD\":\"SGD\",\"SBD\":\"SBD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"SYP\":\"SYP\",\"THB\":\"THB\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TRY\":\"TRY\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"USD\":\"USD\",\"VUV\":\"VUV\",\"VND\":\"VND\",\"XOF\":\"XOF\",\"YER\":\"YER\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/IowgjHXpMoV67TuppEKi8c2lAxqvMF6D2jWQhVq9.jpg','local',24,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(14,'Authorize.Net','authorizenet','USD','USD','{\"login_id\":\"\",\"current_transaction_key\":\"\"}',NULL,0.01200000,'{\"0\":{\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"USD\":\"USD\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/R72NmTWNX26w6bJRqq1v3gvXjVSyjkkMGpE7M5qZ.jpg','local',2,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(15,'SecurionPay','securionpay','USD','USD','{\"public_key\":\"\",\"secret_key\":\"\"}',NULL,1.00000000,'{\"0\":{\"AFN\":\"AFN\", \"DZD\":\"DZD\", \"ARS\":\"ARS\", \"AUD\":\"AUD\", \"BHD\":\"BHD\", \"BDT\":\"BDT\", \"BYR\":\"BYR\", \"BAM\":\"BAM\", \"BWP\":\"BWP\", \"BRL\":\"BRL\", \"BND\":\"BND\", \"BGN\":\"BGN\", \"CAD\":\"CAD\", \"CLP\":\"CLP\", \"CNY\":\"CNY\", \"COP\":\"COP\", \"KMF\":\"KMF\", \"HRK\":\"HRK\", \"CZK\":\"CZK\", \"DKK\":\"DKK\", \"DJF\":\"DJF\", \"DOP\":\"DOP\", \"EGP\":\"EGP\", \"ETB\":\"ETB\", \"ERN\":\"ERN\", \"EUR\":\"EUR\", \"GEL\":\"GEL\", \"HKD\":\"HKD\", \"HUF\":\"HUF\", \"ISK\":\"ISK\", \"INR\":\"INR\", \"IDR\":\"IDR\", \"IRR\":\"IRR\", \"IQD\":\"IQD\", \"ILS\":\"ILS\", \"JMD\":\"JMD\", \"JPY\":\"JPY\", \"JOD\":\"JOD\", \"KZT\":\"KZT\", \"KES\":\"KES\", \"KWD\":\"KWD\", \"KGS\":\"KGS\", \"LVL\":\"LVL\", \"LBP\":\"LBP\", \"LTL\":\"LTL\", \"MOP\":\"MOP\", \"MKD\":\"MKD\", \"MGA\":\"MGA\", \"MWK\":\"MWK\", \"MYR\":\"MYR\", \"MUR\":\"MUR\", \"MXN\":\"MXN\", \"MDL\":\"MDL\", \"MAD\":\"MAD\", \"MZN\":\"MZN\", \"NAD\":\"NAD\", \"NPR\":\"NPR\", \"ANG\":\"ANG\", \"NZD\":\"NZD\", \"NOK\":\"NOK\", \"OMR\":\"OMR\", \"PKR\":\"PKR\", \"PEN\":\"PEN\", \"PHP\":\"PHP\", \"PLN\":\"PLN\", \"QAR\":\"QAR\", \"RON\":\"RON\", \"RUB\":\"RUB\", \"SAR\":\"SAR\", \"RSD\":\"RSD\", \"SGD\":\"SGD\", \"ZAR\":\"ZAR\", \"KRW\":\"KRW\", \"IKR\":\"IKR\", \"LKR\":\"LKR\", \"SEK\":\"SEK\", \"CHF\":\"CHF\", \"SYP\":\"SYP\", \"TWD\":\"TWD\", \"TZS\":\"TZS\", \"THB\":\"THB\", \"TND\":\"TND\", \"TRY\":\"TRY\", \"UAH\":\"UAH\", \"AED\":\"AED\", \"GBP\":\"GBP\", \"USD\":\"USD\", \"VEB\":\"VEB\", \"VEF\":\"VEF\", \"VND\":\"VND\", \"XOF\":\"XOF\", \"YER\":\"YER\", \"ZMK\":\"ZMK\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/BXAZyGxRpcEq92OL7Uj1jgn6YFGKA42qAPnodTwE.jpg','local',20,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(16,'PayUmoney','payumoney','INR','INR','{\"merchant_key\":\"\",\"salt\":\"\"}',NULL,0.87000000,'{\"0\":{\"INR\":\"INR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/DQxgy2e40gkbzAyoouiWq015qHkT3C91pxicap2O.jpg','local',17,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(17,'Mercado Pago','mercadopago','BRL','BRL','{\"access_token\":\"\"}',NULL,0.06300000,'{\"0\":{\"ARS\":\"ARS\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"DOP\":\"DOP\",\"EUR\":\"EUR\",\"GTQ\":\"GTQ\",\"HNL\":\"HNL\",\"MXN\":\"MXN\",\"NIO\":\"NIO\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PYG\":\"PYG\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"VEF\":\"VEF\",\"VES\":\"VES\"}}',3715.12000000,371500000.12000000,0.0000,0.50000000,1,'','gateway/HT6RQkBlkCeTAe1gldE7D0mtDQnUsmyDavdvZ5Ms.jpg','local',8,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(18,'Coingate','coingate','USD','USD','{\"api_key\":\"\"}',NULL,1.00000000,'{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/URfiuwxBkh9kWU6gfJ8FDhuHqTLX0QeTbnHo0zN0.jpg','local',9,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(19,'Coinbase Commerce','coinbasecommerce','USD','USD','{\"api_key\":\"\",\"secret\":\"\"}','{\"webhook\":\"ipn\"}',1.00000000,'{\"0\":{\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/kB79yTsOzfW54gMlQNAG7xRGt6yLx7yBRtnod8va.jpg','local',4,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(20,'Monnify','monnify','NGN','NGN','{\"api_key\":\"\",\"secret_key\":\"\",\"contract_code\":\"\"}',NULL,4.52000000,'{\"0\":{\"NGN\":\"NGN\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/56lBwNRN28PONxfUsIEmmC7c8nVIvZ0xHxQkcjyv.jpg','local',11,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(21,'Block.io','blockio','BTC','BTC','{\"api_key\":\"\",\"api_pin\":\"\"}','{\"cron\":\"ipn\"}',0.00004200,'{\"1\":{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}}',10.10000000,10000.00000000,0.0000,0.50000000,1,'','gateway/sKCml0fpaFRF5QfIYAgLZ0aDT4pyd8vg9ggC4N1R.jpg','local',3,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(22,'CoinPayments','coinpayments','BTC','BTC','{\"merchant_id\":\"\",\"private_key\":\"\",\"public_key\":\"\"}','{\"callback\":\"ipn\"}',1.00000000,'{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"},\"1\":{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}}',10.00000000,99999.00000000,1.0000,0.50000000,1,'','gateway/rfhoebPsWP740DiykaiyRESguisGRTooYHx5MJe0.jpg','local',6,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(23,'Blockchain','blockchain','BTC','BTC','{\"api_key\":\"\",\"xpub_code\":\"\"}',NULL,1.00000000,'{\"1\":{\"BTC\":\"BTC\"}}',100.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/KeFT1Zq26LjSxyY3hsOt3N1IVmAiUdJssfK9jJ84.jpg','local',1,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(25,'cashmaal','cashmaal','PKR','PKR','{\"web_id\":\"\",\"ipn_key\":\"\"}','{\"ipn_url\":\"ipn\"}',0.85000000,'{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}',100.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/YEptXBuilfwgIX12hldQ7UOleOZ9CeYKy6vvz0gg.jpg','local',7,'2020-09-10 10:05:02','2023-05-27 16:12:52'),
(26,'Midtrans','midtrans','IDR','IDR','{\"client_key\":\"\",\"server_key\":\"\"}','{\"payment_notification_url\":\"ipn\", \"finish redirect_url\":\"ipn\", \"unfinish redirect_url\":\"failed\",\"error redirect_url\":\"failed\"}',14835.20000000,'{\"0\":{\"IDR\":\"IDR\"}}',1.00000000,10000.00000000,0.0000,0.05000000,1,'','gateway/vehyK7qPYVRk54Ypds1PSeHEUilLZNnRELj2oHQq.png','local',2,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(27,'peachpayments','peachpayments','USD','USD','{\"Authorization_Bearer\":\"\",\"Entity_ID\":\"\",\"Recur_Channel\":\"\"}',NULL,1.00000000,'{\"0\":{\"AED\":\"AED\",\"AFA\":\"AFA\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZM\":\"AZM\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYR\":\"BYR\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CYP\":\"CYP\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EEK\":\"EEK\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHC\":\"GHC\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LTL\":\"LTL\",\"LVL\":\"LVL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MTL\":\"MTL\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZM\":\"MZM\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PTS\":\"PTS\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDD\":\"SDD\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SIT\":\"SIT\",\"SKK\":\"SKK\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SPL\":\"SPL\",\"SRD\":\"SRD\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMM\":\"TMM\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRL\":\"TRL\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TVD\":\"TVD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMK\":\"ZMK\",\"ZWD\":\"ZWD\"}}',100.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/N2G5SHVeDPtrlQsDvr2f22v55BfRMKIP1HzsMwHs.png','local',24,'2020-09-09 16:05:02','2023-05-27 16:12:52'),
(28,'Nowpayments','nowpayments','BTC','BTC','{\"api_key\":\"\"}','{\"cron\":\"ipn\"}',1.00000000,'{\"1\":{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}}',10.10000000,10000.00000000,0.0000,0.50000000,1,'','gateway/QTH62qOZj0svrVwdytTHY1akRCaapUHTWnjpim8x.jpg','local',16,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(29,'Khalti Payment','khalti','NPR','NPR','{\"secret_key\":\"\",\"public_key\":\"\"}',NULL,132.04000000,'{\"0\":{\"NPR\":\"NPR\"}}',100.00000000,10000.00000000,0.0000,0.00000000,1,'','gateway/zBHM1fnjQZoJVNDBSOIyHOxIHLDBXtAyLdIjiFu4.webp','local',20,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(30,'MAGUA PAY','swagger','EUR','EUR','{\"MAGUA_PAY_ACCOUNT\":\"\",\"MerchantKey\":\"\",\"Secret\":\"\"}',NULL,1.00000000,'{\"0\":{\"EUR\":\"EUR\"}}',100.00000000,10000.00000000,0.0000,0.00000000,1,'','gateway/jiHRzGXawxi3Y0SxLH5aGgHqNW58sQQbfYrovdcU.jpg','local',18,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(31,'Free kassa','freekassa','RUB','RUB','{\"merchant_id\":\"\",\"merchant_key\":\"\",\"secret_word\":\"\",\"secret_word2\":\"\"}','{\"ipn_url\":\"ipn\"}',1.00000000,'{\"0\":{\"RUB\":\"RUB\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"UAH\":\"UAH\",\"KZT\":\"KZT\"}}',10.00000000,10000.00000000,0.1000,0.00000000,1,'','gateway/T5fHfycSRs3Vm7rbURrGMR209s6mkngVo7xYCxwK.jpg','local',13,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(32,'Konnect','konnect','USD','USD','{\"api_key\":\"\",\"receiver_wallet_Id\":\"\"}','{\"webhook\":\"ipn\"}',1.00000000,'{\"0\":{\"TND\":\"TND\",\"EUR\":\"EUR\",\"USD\":\"USD\"}}',1.00000000,10000.00000000,0.0000,0.00000000,1,'','gateway/okXqSCfEaUVA1LomOICG3kb25Hm6O2rVwHZ6VXHz.jpg','local',11,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(33,'Mypay Np','mypay','NPR','NPR','{\"merchant_username\":\"\",\"merchant_api_password\":\"\",\"merchant_id\":\"\",\"api_key\":\"\"}',NULL,1.00000000,'{\"0\":{\"NPR\":\"NPR\"}}',1.00000000,100000.00000000,1.5000,0.00000000,1,'','gateway/LCV5XfIUZ274zLZdDPuvIMOs9cnDQR062l6h5qdN.png','local',22,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(34,'PayThrow','paythrow','USD','USD','{\"client_id\":\"\",\"client_secret\":\"\"}','{\"ipn_url\":\"ipn\"}',1.00000000,'{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}',1.00000000,10000.00000000,0.0000,0.50000000,1,'','gateway/6FkWFmTa5BJwCmB3XHNoWojMonBgwYO1cQVtlSSS.jpg','local',3,'2020-09-09 16:05:02','2023-05-27 16:12:52'),
(35,'IME PAY','imepay','NPR','NPR','{\"MerchantModule\":\"\",\"MerchantCode\":\"\",\"username\":\"\",\"password\":\"\"}',NULL,1.00000000,'{\"0\":{\"NPR\":\"NPR\"}}',1.00000000,100000.00000000,1.5000,0.00000000,1,'','gateway/pzsWcnPraOIwjNXeEjgDjqZm5lTm7qW8c5uhyAVN.png','local',4,'2020-09-09 10:05:02','2023-05-27 16:12:52'),
(36,'Cashonex Hosted','cashonexHosted','USD','USD','{\"idempotency_key\":\"\",\"salt\":\"\"}',NULL,1.00000000,'{\"0\":{\"USD\":\"USD\"}}',1.00000000,1000.00000000,0.0000,0.00000000,1,'','gateway/w2VnP6svfWu8bUDWbyNC1QlDu6czhIQQo81SMJJQ.jpg','local',6,'2023-04-03 07:31:33','2023-05-27 16:12:52'),
(37,'cashonex','cashonex','USD','USD','{\"idempotency_key\":\"\",\"salt\":\"\"}',NULL,1.00000000,'{\"0\":{\"USD\":\"USD\"}}',1.00000000,1000.00000000,0.0000,0.00000000,1,'','gateway/DNF1Lyi7ASGvAEYpQrvtnzh47H9oeAqIcEJEIrAF.jpg','local',7,'2023-04-03 07:34:54','2023-05-27 16:12:52'),
(38,'Binance','binance','USDT','USDT','{\"mercent_api_key\":\"\",\"mercent_secret\":\"\"}',NULL,1.00000000,'{\"1\":{\"ADA\":\"ADA\",\"ATOM\":\"ATOM\",\"AVA\":\"AVA\",\"BCH\":\"BCH\",\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"BUSD\":\"BUSD\",\"CTSI\":\"CTSI\",\"DASH\":\"DASH\",\"DOGE\":\"DOGE\",\"DOT\":\"DOT\",\"EGLD\":\"EGLD\",\"EOS\":\"EOS\",\"ETC\":\"ETC\",\"ETH\":\"ETH\",\"FIL\":\"FIL\",\"FRONT\":\"FRONT\",\"FTM\":\"FTM\",\"GRS\":\"GRS\",\"HBAR\":\"HBAR\",\"IOTX\":\"IOTX\",\"LINK\":\"LINK\",\"LTC\":\"LTC\",\"MANA\":\"MANA\",\"MATIC\":\"MATIC\",\"NEO\":\"NEO\",\"OM\":\"OM\",\"ONE\":\"ONE\",\"PAX\":\"PAX\",\"QTUM\":\"QTUM\",\"STRAX\":\"STRAX\",\"SXP\":\"SXP\",\"TRX\":\"TRX\",\"TUSD\":\"TUSD\",\"UNI\":\"UNI\",\"USDC\":\"USDC\",\"USDT\":\"USDT\",\"WRX\":\"WRX\",\"XLM\":\"XLM\",\"XMR\":\"XMR\",\"XRP\":\"XRP\",\"XTZ\":\"XTZ\",\"XVS\":\"XVS\",\"ZEC\":\"ZEC\",\"ZIL\":\"ZIL\"}}',1.00000000,1000.00000000,0.0000,0.00000000,1,'','gateway/54LEIgyf05n7JRUUK7QdDywId3JEDPG5p2uQOZ75.png','local',5,'2023-04-03 08:36:14','2023-05-27 16:12:52'),
(1000,'Bank Transfer','bank-transfer','BDT','BDT','{\"AccountNumber\":{\"field_name\":\"AccountNumber\",\"field_level\":\"Account Number\",\"type\":\"text\",\"validation\":\"required\"},\"BeneficiaryName\":{\"field_name\":\"BeneficiaryName\",\"field_level\":\"Beneficiary Name\",\"type\":\"text\",\"validation\":\"required\"},\"NID\":{\"field_name\":\"NID\",\"field_level\":\"NID\",\"type\":\"file\",\"validation\":\"nullable\"},\"Address\":{\"field_name\":\"Address\",\"field_level\":\"Address\",\"type\":\"text\",\"validation\":\"nullable\"}}',NULL,84.00000000,NULL,10.00000000,10000.00000000,0.0000,5.00000000,1,'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).','gateway/pGcWhoAVOGusz0j8Egw681d7NKpk0j7KrIXCDPzz.jpg','local',1,'2022-01-02 04:18:56','2023-05-15 14:31:33');

/*Table structure for table `identify_forms` */

DROP TABLE IF EXISTS `identify_forms`;

CREATE TABLE `identify_forms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `services_form` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `identify_forms` */

insert  into `identify_forms`(`id`,`name`,`slug`,`services_form`,`status`,`created_at`,`updated_at`) values 
(1,'Driving License','driving-license','{\"FrontPage\":{\"field_name\":\"FrontPage\",\"field_level\":\"Front Page\",\"type\":\"file\",\"field_length\":\"2500\",\"length_type\":\"max\",\"validation\":\"required\"},\"RearPage\":{\"field_name\":\"RearPage\",\"field_level\":\"Rear Page\",\"type\":\"file\",\"field_length\":\"2500\",\"length_type\":\"max\",\"validation\":\"required\"},\"PassportNumber\":{\"field_name\":\"PassportNumber\",\"field_level\":\"Passport Number\",\"type\":\"text\",\"field_length\":\"20\",\"length_type\":\"max\",\"validation\":\"required\"},\"Address\":{\"field_name\":\"Address\",\"field_level\":\"Address\",\"type\":\"textarea\",\"field_length\":\"300\",\"length_type\":\"max\",\"validation\":\"required\"}}',1,'2021-09-30 23:07:40','2022-05-17 07:29:36'),
(2,'Passport','passport','{\"PassportNumber\":{\"field_name\":\"PassportNumber\",\"field_level\":\"Passport Number\",\"type\":\"text\",\"field_length\":\"25\",\"length_type\":\"max\",\"validation\":\"required\"},\"PassportImage\":{\"field_name\":\"PassportImage\",\"field_level\":\"Passport Image\",\"type\":\"file\",\"field_length\":\"1040\",\"length_type\":\"max\",\"validation\":\"required\"}}',1,'2021-09-30 23:16:23','2022-05-17 07:29:40'),
(4,'National ID','national-id','{\"FrontPage\":{\"field_name\":\"FrontPage\",\"field_level\":\"Front Page\",\"type\":\"file\",\"field_length\":\"500\",\"length_type\":\"max\",\"validation\":\"required\"},\"RearPage\":{\"field_name\":\"RearPage\",\"field_level\":\"Rear Page\",\"type\":\"file\",\"field_length\":\"500\",\"length_type\":\"max\",\"validation\":\"required\"},\"NidNumber\":{\"field_name\":\"NidNumber\",\"field_level\":\"Nid Number\",\"type\":\"text\",\"field_length\":\"10\",\"length_type\":\"digits\",\"validation\":\"required\"},\"Address\":{\"field_name\":\"Address\",\"field_level\":\"Address\",\"type\":\"textarea\",\"field_length\":\"300\",\"length_type\":\"max\",\"validation\":\"required\"}}',1,'2021-10-01 08:58:40','2022-05-17 07:29:48');

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `kycs` */

DROP TABLE IF EXISTS `kycs`;

CREATE TABLE `kycs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `kyc_type` varchar(20) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=> Approved, 2 => Reject',
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `kycs` */

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `short_name` varchar(10) DEFAULT NULL,
  `flag` varchar(100) DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = inactive',
  `rtl` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `default_lang` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

insert  into `languages`(`id`,`name`,`short_name`,`flag`,`driver`,`is_active`,`rtl`,`created_at`,`updated_at`,`default_lang`) values 
(1,'English','US',NULL,NULL,1,0,'2021-12-17 11:00:55','2021-12-17 11:00:55',1),
(20,'Indonesia','ID',NULL,NULL,1,1,'2023-05-07 13:25:27','2024-05-28 09:21:18',0);

/*Table structure for table `listing_aminities` */

DROP TABLE IF EXISTS `listing_aminities`;

CREATE TABLE `listing_aminities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `amenity_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_aminities_listing_id_index` (`listing_id`),
  KEY `listing_aminities_purchase_package_id_index` (`purchase_package_id`),
  KEY `listing_aminities_amenity_id_index` (`amenity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listing_aminities` */

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

/*Table structure for table `listing_category_details` */

DROP TABLE IF EXISTS `listing_category_details`;

CREATE TABLE `listing_category_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_category_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_category_details_listing_category_id_index` (`listing_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listing_category_details` */

insert  into `listing_category_details`(`id`,`listing_category_id`,`language_id`,`name`,`created_at`,`updated_at`) values 
(1,1,1,'Gym','2024-05-27 11:27:43','2024-05-27 11:27:43'),
(2,2,1,'Hotel','2024-05-27 11:28:04','2024-05-27 11:28:04'),
(3,3,1,'Shopping','2024-05-27 11:28:21','2024-05-27 11:28:21'),
(4,4,1,'Travel Agency','2024-05-27 11:28:54','2024-05-27 11:28:54'),
(5,5,1,'Electronics Accessories','2024-05-27 11:29:30','2024-05-27 11:29:30'),
(6,6,1,'Furniture','2024-05-27 11:30:06','2024-05-27 11:30:06'),
(7,7,1,'Resort','2024-05-27 11:31:22','2024-05-27 11:31:22'),
(8,8,1,'Health And Medical','2024-05-27 11:31:54','2024-05-27 11:31:54'),
(9,9,1,'Fitness','2024-05-27 11:32:15','2024-05-27 11:32:15'),
(10,10,1,'Education','2024-05-27 11:32:30','2024-05-27 11:32:30'),
(11,11,1,'Real Estate','2024-05-27 11:32:45','2024-05-27 11:32:45'),
(12,12,1,'E-Commerce','2024-05-27 11:32:58','2024-05-27 11:32:58');

/*Table structure for table `listing_images` */

DROP TABLE IF EXISTS `listing_images`;

CREATE TABLE `listing_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `listing_image` varchar(255) DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_images_listing_id_index` (`listing_id`),
  KEY `listing_images_purchase_package_id_index` (`purchase_package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listing_images` */

insert  into `listing_images`(`id`,`listing_id`,`purchase_package_id`,`listing_image`,`driver`,`created_at`,`updated_at`) values 
(2,1,2,'listings/TdOhS3Y9SEU2RTxltioOg5NrIxVZksRCmyrc8ysI.jpg','local','2024-05-28 12:39:10','2024-05-28 12:39:10');

/*Table structure for table `listing_seos` */

DROP TABLE IF EXISTS `listing_seos`;

CREATE TABLE `listing_seos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `seo_image` varchar(255) DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_seos_listing_id_index` (`listing_id`),
  KEY `listing_seos_purchase_package_id_index` (`purchase_package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `listing_seos` */

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(8,'2020_09_29_074810_create_jobs_table',1),
(32,'2020_11_12_075639_create_transactions_table',6),
(36,'2020_10_14_113046_create_admins_table',9),
(42,'2020_11_24_064711_create_email_templates_table',11),
(48,'2014_10_12_000000_create_users_table',300),
(51,'2020_09_16_103709_create_controls_table',15),
(59,'2021_01_03_061604_create_tickets_table',17),
(60,'2021_01_03_061834_create_ticket_messages_table',18),
(61,'2021_01_03_065607_create_ticket_attachments_table',18),
(62,'2021_01_07_095019_create_funds_table',19),
(66,'2021_01_21_050226_create_languages_table',21),
(69,'2020_12_17_075238_create_sms_controls_table',23),
(70,'2021_01_26_051716_create_site_notifications_table',24),
(72,'2021_01_26_075451_create_notify_templates_table',25),
(73,'2021_01_28_074544_create_contents_table',26),
(74,'2021_01_28_074705_create_content_details_table',26),
(75,'2021_01_28_074829_create_content_media_table',26),
(76,'2021_01_28_074847_create_templates_table',26),
(77,'2021_01_28_074905_create_template_media_table',26),
(83,'2021_02_03_100945_create_subscribers_table',27),
(86,'2021_01_21_101641_add_language_to_email_templates_table',28),
(87,'2021_02_14_064722_create_manage_plans_table',28),
(88,'2021_02_14_072251_create_manage_times_table',29),
(89,'2021_03_09_100340_create_investments_table',30),
(90,'2021_03_13_132414_create_payout_methods_table',31),
(91,'2021_03_13_133534_create_payout_logs_table',32),
(93,'2021_03_18_091710_create_referral_bonuses_table',33),
(94,'2021_10_25_060950_create_money_transfers_table',34),
(96,'2021_03_18_091710_create_users_table',35),
(97,'2022_09_21_061118_create_blog_categories_table',36),
(98,'2022_09_21_061624_create_blog_category_details_table',36),
(99,'2022_09_21_094009_create_blogs_table',37),
(100,'2022_09_21_094323_create_blog_details_table',37),
(101,'2022_09_22_170724_create_sessions_table',38),
(102,'2022_09_26_051330_create_listing_categories_table',38),
(103,'2022_09_26_051751_create_listing_category_details_table',39),
(105,'2022_09_28_120136_create_package_details_table',41),
(115,'2022_10_02_071328_create_amenities_table',43),
(116,'2022_10_02_071409_create_amenity_details_table',43),
(124,'2022_10_02_094929_create_place_details_table',46),
(139,'2022_10_15_075823_create_business_hours_table',303),
(140,'2022_10_15_075947_create_website_and_socials_table',303),
(142,'2022_10_15_120844_create_listing_aminities_table',304),
(146,'2022_10_15_132113_create_listing_seos_table',305),
(151,'2022_10_16_064657_create_product_images_table',309),
(153,'2022_10_17_130026_create_listing_images_table',311),
(154,'2022_10_16_064632_create_products_table',312),
(155,'2022_10_23_095621_create_user_reviews_table',313),
(156,'2022_10_25_061640_create_user_socials_table',314),
(159,'2022_10_25_145903_create_followers_table',315),
(164,'2022_10_13_074911_create_listings_table',318),
(166,'2022_10_02_094715_create_places_table',320),
(169,'2022_10_12_082206_create_purchase_packages_table',322),
(170,'2022_09_28_115043_create_packages_table',323),
(176,'2022_10_26_081545_create_viewers_table',327),
(181,'2022_11_06_101356_create_product_replies_table',329),
(182,'2022_11_05_045537_create_product_queries_table',330),
(183,'2022_11_08_055020_create_listing_approvals_table',331),
(184,'2022_11_10_203957_create_contact_messages_table',332),
(188,'2022_10_31_070724_create_favourites_table',334),
(189,'2022_11_04_115300_create_claim_businesses_table',335),
(190,'2022_11_20_093345_create_package_expiry_crons_table',336),
(202,'2022_11_23_093805_create_analytics_table',337),
(203,'2023_05_10_051032_create_storages_table',338);

/*Table structure for table `notify_templates` */

DROP TABLE IF EXISTS `notify_templates`;

CREATE TABLE `notify_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `template_key` varchar(191) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `short_keys` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `notify_for` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=> Admin, 0=> User',
  `lang_code` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notify_templates_language_id_foreign` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notify_templates` */

insert  into `notify_templates`(`id`,`language_id`,`name`,`template_key`,`body`,`short_keys`,`status`,`notify_for`,`lang_code`,`created_at`,`updated_at`) values 
(1,1,'ADMIN NOTIFY USER PROFILE INFORMATION UPDATE','ADMIN_NOTIFY_USER_PROFILE_INFORMATION_UPDATE','[[name]] update your profile information\r\n\r\n','{\"name\":\"name\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(2,1,'SUPPORT TICKET REPLIED','SUPPORT_TICKET_REPLIED','[[username]] replied  ticket\r\nTicket : [[ticket_id]]\r\n\r\n','{\"ticket_id\":\"Support Ticket ID\",\"username\":\"username\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(3,1,'ADMIN REPLIED SUPPORT TICKET ','ADMIN_REPLIED_TICKET','Admin replied  \r\nTicket : [[ticket_id]]','{\"ticket_id\":\"Support Ticket ID\"}',1,0,'en','2021-12-17 11:01:53','2021-12-17 11:01:53'),
(4,1,'ADMIN DEPOSIT NOTIFICATION','PAYMENT_COMPLETE','[[username]] deposited [[amount]] [[currency]] via [[gateway]]\r\n','{\"gateway\":\"gateway\",\"amount\":\"amount\",\"currency\":\"currency\",\"username\":\"username\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(5,1,'ADD BALANCE','ADD_BALANCE','[[amount]] [[currency]] credited in your account. \r\n\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}',1,0,'en','2021-12-17 11:01:53','2021-12-17 11:01:53'),
(6,1,'DEDUCTED BALANCE','DEDUCTED_BALANCE','[[amount]] [[currency]] debited in your account.\r\n\r\nYour Current Balance [[main_balance]][[currency]]\r\n\r\nTransaction: #[[transaction]]','{\"transaction\":\"Transaction Number\",\"amount\":\"Request Amount By Admin\",\"currency\":\"Site Currency\", \"main_balance\":\"Users Balance After this operation\"}',1,0,'en','2021-12-17 11:01:53','2021-12-17 11:01:53'),
(7,1,'NEW USER ADDED','ADDED_USER','[[username]] has been joined\r\n\r\n','{\"username\":\"username\"}',1,1,'en','2021-12-17 11:01:53','2021-12-17 11:01:53'),
(8,1,'WITHDRAW REQUEST NOTIFICATION TO ADMIN','PAYOUT_REQUEST','[[username]] withdraw requested by [[amount]] [[currency]] \r\n\r\n','{\"amount\":\"amount\",\"currency\":\"currency\",\"username\":\"username\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(9,1,'PAYOUT REJECTED ','PAYOUT_REJECTED','[[amount]] [[currency]]  withdraw requested has been rejected\r\n\r\n','{\"amount\":\"amount\",\"currency\":\"currency\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(10,1,'PAYOUT APPROVE ','PAYOUT_APPROVE ','[[amount]] [[currency]]  withdraw requested has been approved\r\n\r\n','{\"amount\":\"amount\",\"currency\":\"currency\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(11,1,'ADMIN DEPOSIT REQUEST NOTIFICATION','PAYMENT_REQUEST','[[username]] deposit request [[amount]] [[currency]] via [[gateway]]\r\n','{\"gateway\":\"gateway\",\"amount\":\"amount\",\"currency\":\"currency\",\"username\":\"username\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(12,1,'PAYMENT REJECTED','PAYMENT_REJECTED','[[amount]] [[currency]] payment has been requested \r\n\r\n','{\"amount\":\"amount\",\"currency\":\"currency\",\"feedback\":\"Admin feedback\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(13,1,'KYC APPROVED','KYC_APPROVED','[[kyc_type]] has been approved\r\n','{\"kyc_type\":\"kyc type\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(14,1,'KYC REJECTED','KYC_REJECTED','[[kyc_type]] has been rejected\r\n\r\n','{\"kyc_type\":\"kyc type\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(15,1,'LISTING MESSAGE','LISTING_MESSAGE','[[from]] has sent a message to [[listingTitle]] listing\r\n\r\n','{\"listingTitle\":\"listingTitle\",\"from\":\"from\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(16,1,'VIEWER MESSAGE','VIEWER_MESSAGE','[[from]] has sent a contact message\r\n\r\n','{\"from\":\"from\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(17,1,'LISTING CLAIM','LISTING_CLAIM','[[from]] made a claim on [[listing]] listing.\r\n\r\n\r\n','{\"from\":\"from\",\"listing\":\"listing\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(18,1,'PRODUCT ENQUIRY REPLY','PRODUCT_ENQUIRY_REPLY','[[from]] has send a message to [[product]] product\r\n\r\n\r\n','{\"from\":\"from\",\"product\":\"product\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(19,1,'Create Listing','Create_Listing','[[from]] has created a listing\r\n\r\n\r\n','{\"from\":\"from\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(20,1,'Listing Rejected','LISTING_REJECTED','[[from]] has rejected your [[userListing]] listing Because [[rejectReason]]\r\n\r\n\r\n','{\"from\":\"from\",\"userListing\":\"userListing\",\"rejectReason\":\"rejectReason\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(21,1,'Listing Approved','LISTING_APPROVED','[[from]] has approved your [[userListing]] listing\r\n\r\n\r\n','{\"from\":\"from\",\"userListing\":\"userListing\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(22,1,'Package Approved','PACKAGE_APPROVED','[[from]] has approved your [[userPackage]] package\r\n\r\n\r\n','{\"from\":\"from\",\"userPackage\":\"userPackage\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(23,1,'Package Cancelled','PACKAGE_CANCELLED','[[from]] has cancelled your [[userPackage]] package Because [[cancelReason]]\r\n\r\n\r\n','{\"from\":\"from\",\"userPackage\":\"userPackage\",\"cancelReason\":\"cancelReason\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(24,1,'REVIEW MESSAGE','REVIEW_MESSAGE','[[from]] given a review on [[listingTitle]] listing\r\n\r\n\r\n','{\"from\":\"from\",\"listingTitle\":\"listingTitle\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(25,1,'PRODUCT QUERY','PRODUCT_QUERY','[[from]] has sent a query on [[productTitle]] product\r\n\r\n\r\n','{\"from\":\"from\",\"productTitle\":\"productTitle\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(26,1,'PURCHASE PACKAGE','PURCHASE_PACKAGE','[[from]] buy [[package]] package\r\n\r\n\r\n','{\"from\":\"from\",\"package\":\"package\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(27,1,'RENEW PACKAGE','RENEW_PACKAGE','[[from]] renew [[package]] package\r\n\r\n\r\n','{\"from\":\"from\",\"package\":\"package\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(28,1,'ACTIVE LISTING','ACTIVE_LISTING','[[from]] has been active your [[listing]] listing\r\n\r\n\r\n','{\"listing\":\"listing\",\"from\":\"from\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(29,1,'DEACTIVE LISTING','DEACTIVE_LISTING','[[from]] has been deactive your [[listing]] listing\r\n\r\n\r\n','{\"listing\":\"listing\",\"from\":\"from\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(30,1,'EXPIRY DATE NOTIFICATION','EXPIRY_DATE_NOTIFICATION','[[message]]\r\n\r\n','{\"message\":\"message\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(31,1,'PAYMENT APPROVED','PAYMENT_APPROVED','[[plan]]\r\n\r\n\r\n','{\"plan\":\"plan\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(32,1,'PAYMENT REJECTED','PAYMENT_REJECTED','[[plan]]\r\n\r\n\r\n','{\"plan\":\"plan\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(33,1,'PACKAGE RENEW COMPLETED','PACKAGE_RENEW_COMPLETED','[[plan]]\r\n\r\n\r\n','{\"plan\":\"plan\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(34,1,'USER NOTIFY HIS PROFILE INFORMATION UPDATE','USER_NOTIFY_HIS_PROFILE_INFORMATION_UPDATE','[[name]] update your profile information\r\n\r\n','{\"name\":\"name\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(35,1,'ADMIN NOTIFY USER PROFILE PASSWORD UPDATE','ADMIN_NOTIFY_USER_PROFILE_PASSWORD_UPDATE','[[name]] update your profile password','{\"name\":\"name\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(36,1,'USER NOTIFY HIS PROFILE PASSWORD UPDATE','USER_NOTIFY_HIS_PROFILE_PASSWORD_UPDATE','[[name]] update your profile password\r\n\r\n','{\"name\":\"name\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(37,1,'ADMIN NOTIFY USER KYC REQUEST','ADMIN_NOTIFY_USER_KYC_REQUEST','[[name]] send kyc request\r\n\r\n','{\"name\":\"name\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(38,1,'USER NOTIFY HIS KYC REQUEST SEND','USER_NOTIFY_HIS_KYC_REQUEST_SEND','[[name]] send your kyc request\r\n\r\n','{\"name\":\"name\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(39,1,'ADMIN NOTIFY USER ADDRESS VERIFICATION REQUEST','ADMIN_NOTIFY_USER_ADDRESS_VERIFICATION_REQUEST','[[name]] send address verification request\r\n\r\n','{\"name\":\"name\"}',1,1,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53'),
(40,1,'USER NOTIFY ADDRESS VERIFICATION REQUEST SEND','USER_NOTIFY_ADDRESS_VERIFICATION_REQUEST_SEND','[[name]] send your address verification request\r\n\r\n','{\"name\":\"name\"}',1,0,NULL,'2021-12-17 11:01:53','2021-12-17 11:01:53');

/*Table structure for table `package_details` */

DROP TABLE IF EXISTS `package_details`;

CREATE TABLE `package_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_details_package_id_index` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `package_details` */

insert  into `package_details`(`id`,`package_id`,`language_id`,`title`,`created_at`,`updated_at`) values 
(1,1,1,'Daftar Anggota','2024-05-28 08:29:19','2024-05-28 11:04:51');

/*Table structure for table `package_expiry_crons` */

DROP TABLE IF EXISTS `package_expiry_crons`;

CREATE TABLE `package_expiry_crons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `before_expiry_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `package_expiry_crons` */

insert  into `package_expiry_crons`(`id`,`before_expiry_date`,`created_at`,`updated_at`) values 
(3,'30','2024-05-31 10:32:18','2024-05-31 10:32:18');

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `price` double(12,2) DEFAULT NULL,
  `is_multiple_time_purchase` tinyint(1) NOT NULL DEFAULT 0,
  `is_renew` tinyint(1) NOT NULL DEFAULT 0,
  `expiry_time` int(11) DEFAULT NULL,
  `expiry_time_type` varchar(255) DEFAULT NULL,
  `is_image` tinyint(1) NOT NULL DEFAULT 0,
  `is_video` tinyint(1) NOT NULL DEFAULT 0,
  `is_amenities` tinyint(1) NOT NULL DEFAULT 0,
  `is_product` tinyint(1) NOT NULL DEFAULT 0,
  `is_business_hour` tinyint(1) NOT NULL DEFAULT 0,
  `no_of_listing` varchar(255) DEFAULT NULL,
  `no_of_img_per_listing` int(11) DEFAULT NULL,
  `no_of_categories_per_listing` int(11) NOT NULL DEFAULT 1,
  `no_of_amenities_per_listing` int(11) DEFAULT NULL,
  `no_of_product` int(11) DEFAULT NULL,
  `no_of_img_per_product` int(11) DEFAULT NULL,
  `seo` tinyint(1) NOT NULL DEFAULT 1,
  `is_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `is_messenger` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `packages` */

insert  into `packages`(`id`,`price`,`is_multiple_time_purchase`,`is_renew`,`expiry_time`,`expiry_time_type`,`is_image`,`is_video`,`is_amenities`,`is_product`,`is_business_hour`,`no_of_listing`,`no_of_img_per_listing`,`no_of_categories_per_listing`,`no_of_amenities_per_listing`,`no_of_product`,`no_of_img_per_product`,`seo`,`is_whatsapp`,`is_messenger`,`status`,`image`,`driver`,`created_at`,`updated_at`) values 
(1,NULL,1,1,NULL,NULL,1,1,1,1,1,NULL,NULL,1,NULL,NULL,NULL,1,1,1,1,'package/STsXwLB4aBtne1Ol60cWTwwUCtk5pdBBFp7W032M.png','local','2024-05-28 08:29:19','2024-05-28 04:20:11');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `place_details` */

DROP TABLE IF EXISTS `place_details`;

CREATE TABLE `place_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `place_id` bigint(20) unsigned NOT NULL,
  `place` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `place_details_place_id_index` (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `place_details` */

insert  into `place_details`(`id`,`place_id`,`place`,`created_at`,`updated_at`) values 
(1,1,'Jakarta Special Capital Region, Gambir, Jakarta, IDN','2024-05-28 08:33:14','2024-05-28 08:33:14'),
(2,2,'Aceh, IDN','2024-05-28 03:33:51','2024-05-28 03:33:51');

/*Table structure for table `places` */

DROP TABLE IF EXISTS `places`;

CREATE TABLE `places` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `places` */

insert  into `places`(`id`,`lat`,`long`,`status`,`created_at`,`updated_at`) values 
(1,'-6.1747565','106.8270734',1,'2024-05-28 08:33:14','2024-05-28 08:33:14'),
(2,'4.226376059822','96.91037490012',1,'2024-05-28 03:33:51','2024-05-28 03:33:51');

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_images` */

/*Table structure for table `product_queries` */

DROP TABLE IF EXISTS `product_queries`;

CREATE TABLE `product_queries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'receiver',
  `client_id` bigint(20) unsigned DEFAULT NULL COMMENT 'sender',
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `customer_enquiry` varchar(255) NOT NULL DEFAULT '0',
  `my_enquiry` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_queries_user_id_index` (`user_id`),
  KEY `product_queries_client_id_index` (`client_id`),
  KEY `product_queries_listing_id_index` (`listing_id`),
  KEY `product_queries_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_queries` */

/*Table structure for table `product_replies` */

DROP TABLE IF EXISTS `product_replies`;

CREATE TABLE `product_replies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'sender',
  `client_id` bigint(20) unsigned DEFAULT NULL COMMENT 'receiver',
  `product_query_id` bigint(20) unsigned DEFAULT NULL,
  `reply` longtext DEFAULT NULL,
  `file` varchar(191) DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=> unseen, 1=> seen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_replies_user_id_index` (`user_id`),
  KEY `product_replies_client_id_index` (`client_id`),
  KEY `product_replies_product_query_id_index` (`product_query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_replies` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_description` longtext DEFAULT NULL,
  `product_thumbnail` varchar(255) DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_listing_id_index` (`listing_id`),
  KEY `products_purchase_package_id_index` (`purchase_package_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`user_id`,`listing_id`,`purchase_package_id`,`product_title`,`product_price`,`product_description`,`product_thumbnail`,`driver`,`created_at`,`updated_at`) values 
(1,1,1,2,NULL,NULL,NULL,NULL,NULL,'2024-05-28 05:22:19','2024-05-28 05:22:19');

/*Table structure for table `purchase_packages` */

DROP TABLE IF EXISTS `purchase_packages`;

CREATE TABLE `purchase_packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `package_id` bigint(20) unsigned NOT NULL,
  `price` double(12,2) DEFAULT NULL,
  `is_renew` tinyint(1) NOT NULL DEFAULT 0,
  `is_image` tinyint(1) NOT NULL DEFAULT 0,
  `is_video` tinyint(1) NOT NULL DEFAULT 0,
  `is_amenities` tinyint(1) NOT NULL DEFAULT 0,
  `is_product` tinyint(1) NOT NULL DEFAULT 0,
  `is_business_hour` tinyint(1) NOT NULL DEFAULT 0,
  `no_of_listing` varchar(255) DEFAULT NULL,
  `no_of_img_per_listing` int(11) DEFAULT NULL,
  `no_of_categories_per_listing` int(11) NOT NULL DEFAULT 1,
  `no_of_amenities_per_listing` int(11) DEFAULT NULL,
  `no_of_product` int(11) DEFAULT NULL,
  `no_of_img_per_product` int(11) DEFAULT NULL,
  `seo` tinyint(1) NOT NULL DEFAULT 1,
  `is_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `is_messenger` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>pending, (fund=2) 1=>approved, 2=>cancel (fund=3)',
  `purchase_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `last_reminder_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_packages_user_id_index` (`user_id`),
  KEY `purchase_packages_package_id_index` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchase_packages` */

insert  into `purchase_packages`(`id`,`user_id`,`package_id`,`price`,`is_renew`,`is_image`,`is_video`,`is_amenities`,`is_product`,`is_business_hour`,`no_of_listing`,`no_of_img_per_listing`,`no_of_categories_per_listing`,`no_of_amenities_per_listing`,`no_of_product`,`no_of_img_per_product`,`seo`,`is_whatsapp`,`is_messenger`,`status`,`purchase_date`,`expire_date`,`last_reminder_at`,`created_at`,`updated_at`,`deleted_at`,`type`) values 
(1,1,2,15.00,1,1,1,1,1,1,NULL,NULL,1,NULL,NULL,NULL,1,1,1,0,'2024-05-28',NULL,NULL,'2024-05-28 04:20:30','2024-05-28 04:20:30',NULL,'Purchase'),
(2,1,1,NULL,1,1,1,1,1,1,NULL,NULL,1,NULL,NULL,NULL,1,1,1,1,'2024-05-28',NULL,NULL,'2024-05-28 05:19:53','2024-05-28 05:19:53',NULL,'Purchase');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

/*Table structure for table `site_notifications` */

DROP TABLE IF EXISTS `site_notifications`;

CREATE TABLE `site_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_notificational_id` int(11) NOT NULL,
  `site_notificational_type` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `site_notifications` */

/*Table structure for table `sms_controls` */

DROP TABLE IF EXISTS `sms_controls`;

CREATE TABLE `sms_controls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `actionMethod` varchar(191) DEFAULT NULL,
  `actionUrl` varchar(191) DEFAULT NULL,
  `headerData` text DEFAULT NULL,
  `paramData` text DEFAULT NULL,
  `formData` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sms_controls` */

insert  into `sms_controls`(`id`,`actionMethod`,`actionUrl`,`headerData`,`paramData`,`formData`,`created_at`,`updated_at`) values 
(1,'POST','https://rest.nexmo.com/sms/json','{\"Content-Type\":\"application\\/x-www-form-urlencoded\"}',NULL,'{\"from\":\"Rownak\",\"text\":\"[[message]]\",\"to\":\"[[receiver]]\",\"api_key\":\"930cc608\",\"api_secret\":\"2pijsaMOUw5YKOK5\"}','2021-12-17 11:02:43','2021-12-17 11:02:43');

/*Table structure for table `storages` */

DROP TABLE IF EXISTS `storages`;

CREATE TABLE `storages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `driver` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>inactive,1=>active',
  `parameters` text DEFAULT NULL COMMENT 'storage credentials',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `storages` */

insert  into `storages`(`id`,`code`,`name`,`logo`,`driver`,`status`,`parameters`,`created_at`,`updated_at`) values 
(1,'s3','Amazon S357','driver/XS6uuOfKlhf6M3ot2EDsMxwvEJw1Ed8fwzEObgkO.jpg','local',0,'{\"access_key_id\":\"xys67\",\"secret_access_key\":\"xys1\",\"default_region\":\"xys52\",\"bucket\":\"xys63\",\"url\":\"xysds43\"}',NULL,'2023-05-10 10:44:18'),
(3,'sftp','SFTP','driver/2v3l0NA2zWhVuWe994DBEjAmhk3yZnNkq9qHtxyY.png','local',0,'{\"sftp_username\":\"xys6\",\"sftp_password\":\"xys\"}',NULL,'2023-05-10 10:47:37'),
(4,'do','Digitalocean Spaces','driver/4ZObjGjJm8vxa4MVIL7JB8b7sOqr8GyO4zqDKZvd.png','local',0,'{\"spaces_key\":\"hj\",\"spaces_secret\":\"vh\",\"spaces_endpoint\":\"jk\",\"spaces_region\":\"sfo2\",\"spaces_bucket\":\"assets-coral\"}',NULL,'2023-05-16 11:46:51'),
(5,'ftp','FTP','driver/HYCArqS7c316TCydiXWRvAcJB7jZOy2bt8UjLH6H.png','local',0,'{\"ftp_host\":\"xys6\",\"ftp_username\":\"xys\",\"ftp_password\":\"xys6\"}',NULL,'2023-05-10 10:45:40'),
(6,'local','Local Storage','driver/local.png','local',1,'',NULL,'2023-05-16 11:46:51');

/*Table structure for table `subscribers` */

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subscribers` */

/*Table structure for table `template_media` */

DROP TABLE IF EXISTS `template_media`;

CREATE TABLE `template_media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_name` varchar(191) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `template_media_section_name_index` (`section_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `template_media` */

insert  into `template_media`(`id`,`section_name`,`description`,`driver`,`created_at`,`updated_at`) values 
(1,'hero','{\"image\":\"6059cf96cc1ca1616498582.jpg\",\"button_link\":\"http:\\/\\/localhost\\/smm\\/admin\\/content-show\\/4\"}',NULL,'2021-12-17 11:02:53','2021-12-17 11:02:53'),
(2,'about-us','{\"image\":\"template\\/dN3unxUW45rdDlHioTtk1BGdg5diiQwpo0MYJOZm.jpg\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/embed\\/LXb3EKWsInQ?controls=0\"}','local','2021-12-17 11:02:53','2023-05-16 11:10:43'),
(3,'call-to-action','{\"image\":\"60193254de30d1612264020.png\",\"button_link\":\"http:\\/\\/localhost\\/smm\\/admin\\/content-show\\/4\"}',NULL,'2021-12-17 11:02:53','2021-12-17 11:02:53'),
(4,'how-it-work','{\"image\":\"6059d2c2654921616499394.jpg\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/embed\\/LXb3EKWsInQ?controls=0\"}',NULL,'2021-12-17 11:02:53','2021-12-17 11:02:53'),
(5,'request-a-call','{\"button_link\":\"http:\\/\\/localhost\\/hyip_pro\\/contact\"}',NULL,'2022-05-17 02:03:05','2022-05-17 02:03:05'),
(6,'banner-heading','{\"image\":\"template\\/jxHO3Fusv74Vh54UBuIvpY5Aax9wvdi7D0c7pgNa.jpg\",\"button_link\":\"https:\\/\\/www.facebook.com\\/\"}','local','2022-09-18 04:11:32','2023-05-16 10:34:01'),
(7,'single-card','{\"image\":\"6326eafde79bc1663494909.jpg\",\"button_link\":\"https:\\/\\/www.youtube.com\\/embed\\/webtraininginstitute\"}',NULL,'2022-09-18 04:55:09','2022-09-18 04:55:09'),
(8,'maintenance-page','{\"image\":\"template\\/6CpFGLeGuNG3Jw5b6aV7sN3skGqcJ8i3edd1LDHz.png\"}','local','2023-03-24 20:52:51','2023-05-16 11:39:43');

/*Table structure for table `templates` */

DROP TABLE IF EXISTS `templates`;

CREATE TABLE `templates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(11) unsigned DEFAULT NULL,
  `section_name` varchar(191) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `templates` */

insert  into `templates`(`id`,`language_id`,`section_name`,`description`,`created_at`,`updated_at`) values 
(1,1,'hero','{\"title\":\"BEST INVESTMENTS\",\"sub_title\":\"PLAN FOR WORLDWIDE\",\"short_description\":\"A Profitable platform for high-margin investment\",\"button_name\":\"Learn More\"}','2021-12-17 11:02:59','2022-05-12 05:51:22'),
(3,1,'about-us','{\"title\":\"About Us\",\"sub_title\":\"Connecting businesses worldwide\",\"description\":\"<p>Welcome to ListPlace, a comprehensive online directory for businesses of all types and sizes.\\r\\n<\\/p><p>\\r\\nAt ListPlace, we believe that every business deserves to have a platform to showcase their products and services to a wider audience. Our mission is to provide a user-friendly platform where businesses can easily list their information and connect with potential customers.<\\/p><p>\\r\\n\\r\\nOur directory is designed to be easy to navigate and search, making it simple for users to find the businesses they need. We offer both free and paid listings to accommodate businesses with varying budgets and needs. Our paid listings offer additional features such as higher visibility and customization options to help businesses stand out from the crowd.<\\/p><p>\\r\\n\\r\\nAt ListPlace, we take pride in providing exceptional customer service to our users. Our team is always ready to assist with any questions or concerns, and we strive to provide quick and efficient solutions.<\\/p><p>\\r\\nThank you for choosing ListPlace as your go-to directory for businesses. We look forward to helping your business grow and succeed.<\\/p>\"}','2021-12-17 11:02:59','2023-03-28 08:02:51'),
(5,1,'service','{\"title\":\"Services\",\"sub_title\":\"WHAT WE DO\",\"short_title\":\"How We\'re Helping\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(7,1,'call-to-action','{\"title\":\"We Will Drive More Customers To Your Business Than Any Other Online Source.\",\"sub_title\":\"Multiply your Business\\u2019 Facebook Traffic 10x\",\"button_name\":\"Learn More\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(9,1,'contact-us','{\"left_title\":\"Leave Us Your Info\",\"left_details\":\"<p><span>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions.<\\/span><br \\/><\\/p>\",\"heading\":\"Get In Touch\",\"short_details\":\"<p><span>Give us a call or drop by anytime, we endeavour to answer all enquiries within 24 hours on business days. We will be happy to answer your questions.<\\/span><br \\/><\\/p>\",\"address\":\"457 Morningview, New York USA\",\"email\":\"contact@example.net\",\"phone\":\"+880 654 321 23\",\"footer_short_details\":\"<p><b>ASOSIASI <\\/b><\\/p><p><b>PENGUSAHA <\\/b><\\/p><p><b>INDONESIA<\\/b><\\/p>\"}','2021-12-17 11:02:59','2024-05-25 08:51:08'),
(11,1,'testimonial','{\"title\":\"Customer Feedback\",\"sub_title\":\"Explore the best listings in your city. You won\\u2019t be disappointed.\"}','2021-12-17 11:02:59','2023-05-16 11:23:15'),
(13,1,'login','{\"title\":\"Proclamations About Us\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p>Lorem ipsum dolor sit amet.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Adipisicing elit. Beatae, repellendus!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Consectetur adipisicing elit. A, eos!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Aliquid numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Voluptas est nesciunt qui necessitatibus<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Lorem numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li><\\/ul>\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(15,1,'register','{\"title\":\"Proclamations About Us\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p>Lorem ipsum dolor sit amet.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Adipisicing elit. Beatae, repellendus!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Consectetur adipisicing elit. A, eos!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Aliquid numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Voluptas est nesciunt qui necessitatibus<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Lorem numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li><\\/ul>\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(17,1,'forget-password','{\"title\":\"Proclamations About Us\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p>Lorem ipsum dolor sit amet.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Adipisicing elit. Beatae, repellendus!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Consectetur adipisicing elit. A, eos!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Aliquid numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Voluptas est nesciunt qui necessitatibus<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Lorem numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li><\\/ul>\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(19,1,'reset-password','{\"title\":\"Proclamations About Us\",\"description\":\"<ul>\\r\\n                                    <li>\\r\\n                                        <p>Lorem ipsum dolor sit amet.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Adipisicing elit. Beatae, repellendus!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Consectetur adipisicing elit. A, eos!<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Aliquid numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Voluptas est nesciunt qui necessitatibus<\\/p>\\r\\n                                    <\\/li>\\r\\n                                    <li>\\r\\n                                        <p>Lorem numquam reiciendis nisi placeat.<\\/p>\\r\\n                                    <\\/li><\\/ul>\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(21,1,'how-it-work','{\"title\":\"How It Works\",\"sub_title\":\"Working Process\"}','2021-12-17 11:02:59','2022-09-20 01:02:02'),
(23,1,'blog','{\"title\":\"News &amp; Articles\",\"sub_title\":\"Popular Blog Post\",\"short_title\":\"Explore the best listings near you. You won\\u2019t be disappointed.\"}','2021-12-17 11:02:59','2023-05-16 11:24:28'),
(25,1,'faq','{\"title\":\"ANY QUESTIONS\",\"sub_title\":\"We\'ve Got Answers\",\"short_details\":\"Help agencies to define their new business objectives and then create professional software.\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(39,1,'investment','{\"title\":\"INVEST OFFER\",\"sub_title\":\"Investment Plans\",\"short_details\":\"Help agencies to define their new business objectives and then create professional software.\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(40,1,'why-chose-us','{\"title\":\"CHOOSE INVESTMENT\",\"sub_title\":\"Why Choose Investment Plan\",\"short_details\":\"Help agencies to define their new business objectives and then create professional software.\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(42,1,'investor','{\"title\":\"INVESTOR\",\"sub_title\":\"World Wide Top Investor\",\"short_title\":\"Help agencies to define their new business objectives and then create professional software.\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(43,1,'news-letter','{\"title\":\"Join Our Newsletter\",\"sub_title\":\"Enter your email address to register to our newsletter subscription delivered on a regular basis!\"}','2021-12-17 11:02:59','2022-09-20 06:45:53'),
(45,1,'we-accept','{\"title\":\"PAYMENTS\",\"sub_title\":\"Payments Gateway\",\"short_details\":\"Help agencies to define their new business objectives and then create professional software.\"}','2021-12-17 11:02:59','2021-12-17 11:02:59'),
(78,1,'know-more-us','{\"title\":\"INVESTON HISTORY\",\"sub_title\":\"KNOW MORE US\",\"short_details\":\"Help agencies to define their new business objectives and then create professional software.\"}','2022-05-11 04:10:19','2022-05-11 04:10:19'),
(79,1,'calculate-profit','{\"title\":\"PLANS CALCULATOR\",\"sub_title\":\"CALCULATE THE AMAZING PROFITS\",\"short_details\":\"worldwide investment company who are committed provides a straight forward and transparent mechanism\",\"profit_title\":\"YOUR PROFIT\",\"profit_sub_title\":\"Calculate how much your invest profit\"}','2022-05-16 01:48:16','2022-05-16 01:48:16'),
(81,1,'jubayer','{\"title\":\"How its work\"}','2022-09-18 03:06:47','2022-09-18 03:06:47'),
(82,1,'banner-heading','{\"top_title\":\"Track Down Your Best Listing\",\"main_title\":\"You can get your desired listing items here by name, category or location.\"}','2022-09-18 04:11:32','2023-05-16 08:58:31'),
(83,1,'single-card','{\"title\":\"Rajiur Rahman\",\"description\":\"<p>I am a professional Web Developer. I have 2 years experience in this sector. I have completed more then 6 projects.\\u00a0<\\/p>\",\"button_name\":\"Learn More\"}','2022-09-18 04:55:09','2022-09-18 05:18:20'),
(86,1,'package','{\"title\":\"Packages\",\"short_details\":\"Here are the pricing plans for unlimited business directory listings from the free plan to the basic. You can buy whatever you like.\"}','2022-10-01 03:03:31','2023-05-16 11:27:41'),
(87,1,'cookie-consent','{\"title\":\"Cookies &amp; Privacy\",\"popup_short_description\":\"<p><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our<\\/span><br \\/><\\/p>\",\"description\":\"<p><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to ourv<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our\\u00a0<\\/span><span>This website uses cookies or similar techonoglies to enhance your browsing experience and provide personalized recommendations. By contrinuing to use our website, you agree to our<\\/span><br \\/><\\/p>\"}','2022-11-05 06:47:57','2022-11-05 06:47:57'),
(90,1,'maintenance-page','{\"title\":\"WE ARE COMING SOON\",\"sub_title\":\"The website under maintenance!\",\"short_description\":\"<p>Someone has kidnapped our site. We are negotiation ransom and<br \\/>will resolve this issue in 24\\/7 hours<br \\/><\\/p>\"}','2023-03-24 20:52:50','2023-03-24 20:52:50'),
(92,1,'popular-listing','{\"title\":\"Popular Listings\",\"sub_title\":\"Explore the best listings near you. You won\\u2019t be disappointed.\"}','2023-05-07 12:53:30','2023-05-16 11:22:32');

/*Table structure for table `ticket_attachments` */

DROP TABLE IF EXISTS `ticket_attachments`;

CREATE TABLE `ticket_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_message_id` int(11) unsigned DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `driver` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_attachments_ticket_message_id_foreign` (`ticket_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ticket_attachments` */

/*Table structure for table `ticket_messages` */

DROP TABLE IF EXISTS `ticket_messages`;

CREATE TABLE `ticket_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_messages_ticket_id_foreign` (`ticket_id`),
  KEY `ticket_messages_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ticket_messages` */

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(91) DEFAULT NULL,
  `ticket` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed	',
  `last_reply` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tickets` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fund_id` int(11) DEFAULT NULL,
  `amount` double(11,2) DEFAULT NULL,
  `charge` decimal(11,2) NOT NULL DEFAULT 0.00,
  `final_balance` varchar(30) DEFAULT NULL,
  `trx_type` varchar(10) DEFAULT NULL,
  `remarks` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `trx_id` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fund_id` (`fund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

/*Table structure for table `user_reviews` */

DROP TABLE IF EXISTS `user_reviews`;

CREATE TABLE `user_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `rating2` double(8,2) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_reviews_listing_id_index` (`listing_id`),
  KEY `user_reviews_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_reviews` */

/*Table structure for table `user_socials` */

DROP TABLE IF EXISTS `user_socials`;

CREATE TABLE `user_socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `social_icon` varchar(255) DEFAULT NULL,
  `social_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_socials_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_socials` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `website` varchar(191) DEFAULT NULL,
  `referral_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `country_code` varchar(20) DEFAULT NULL,
  `phone_code` varchar(20) DEFAULT NULL,
  `phone` varchar(91) DEFAULT NULL,
  `balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `image` varchar(191) DEFAULT NULL,
  `driver` varchar(50) DEFAULT NULL,
  `cover_photo` varchar(191) DEFAULT NULL,
  `cover_driver` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `provider_id` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `identity_verify` tinyint(4) NOT NULL COMMENT '	0 => Not Applied, 1=> Applied, 2=> Approved, 3 => Rejected	',
  `address_verify` tinyint(4) NOT NULL COMMENT '0 => Not Applied, 1=> Applied, 2=> Approved, 3 => Rejected	',
  `two_fa` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: two-FA off, 1: two-FA on',
  `two_fa_verify` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: two-FA unverified, 1: two-FA verified',
  `two_fa_code` varchar(50) DEFAULT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 1,
  `sms_verification` tinyint(1) NOT NULL DEFAULT 1,
  `verify_code` varchar(50) DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`lastname`,`username`,`website`,`referral_id`,`language_id`,`email`,`country_code`,`phone_code`,`phone`,`balance`,`image`,`driver`,`cover_photo`,`cover_driver`,`address`,`bio`,`provider`,`provider_id`,`status`,`identity_verify`,`address_verify`,`two_fa`,`two_fa_verify`,`two_fa_code`,`email_verification`,`sms_verification`,`verify_code`,`sent_at`,`last_login`,`password`,`email_verified_at`,`remember_token`,`created_at`,`updated_at`,`last_seen`) values 
(1,'rizalvalry','valry','valry',NULL,NULL,NULL,'cawangbsi@gmail.com',NULL,'+62','+6285781571742',0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,0,0,0,1,NULL,1,1,NULL,NULL,'2024-05-31 17:28:04','$2y$10$WNtC6cDrOmJ/WzJhNm88.ObPeBECm4kAD7DW81Fe/ole8.jVocAMe',NULL,NULL,'2024-05-28 03:36:05','2024-05-31 19:29:10','2024-05-31 19:29:10');

/*Table structure for table `viewers` */

DROP TABLE IF EXISTS `viewers`;

CREATE TABLE `viewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `viewer_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `viewers_user_id_index` (`user_id`),
  KEY `viewers_listing_id_index` (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `viewers` */

insert  into `viewers`(`id`,`user_id`,`listing_id`,`viewer_ip`,`created_at`,`updated_at`) values 
(1,1,2,'::1','2023-05-27 16:31:56','2023-05-27 16:31:56'),
(2,1,1,'::1','2024-05-28 12:34:17','2024-05-28 12:34:17'),
(3,1,1,'::1','2024-05-28 05:37:42','2024-05-28 05:37:42');

/*Table structure for table `website_and_socials` */

DROP TABLE IF EXISTS `website_and_socials`;

CREATE TABLE `website_and_socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) unsigned DEFAULT NULL,
  `purchase_package_id` bigint(20) unsigned DEFAULT NULL,
  `social_icon` varchar(191) DEFAULT NULL,
  `social_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `website_and_socials_listing_id_index` (`listing_id`),
  KEY `website_and_socials_purchase_package_id_index` (`purchase_package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `website_and_socials` */

insert  into `website_and_socials`(`id`,`listing_id`,`purchase_package_id`,`social_icon`,`social_url`,`created_at`,`updated_at`) values 
(3,1,2,'bi bi-whatsapp','https://wa.me','2024-05-28 12:39:10','2024-05-28 12:39:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
