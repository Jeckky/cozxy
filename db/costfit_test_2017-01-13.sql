# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.100.8 (MySQL 5.6.31-0ubuntu0.14.04.2)
# Database: costfit_test
# Generation Time: 2017-01-13 03:01:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `addressId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `tax` varchar(45) DEFAULT NULL,
  `address` text,
  `countryId` varchar(3) DEFAULT NULL,
  `provinceId` bigint(20) unsigned DEFAULT NULL,
  `amphurId` bigint(20) unsigned DEFAULT NULL,
  `districtId` bigint(20) unsigned DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT 'default Address First \n - BILLING = 1; // ที่อยู่จัดส่งเอกสาร\n - SHIPPING = 2; // ที่อยู่จัดส่งสินค้า',
  `isDefault` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Check status\n\n 1 : default\n 0 : not default\n\n',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Check status\n\n- show : 1\n- hidden : 0',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `longitude` varchar(150) DEFAULT NULL,
  `latitude` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`addressId`),
  KEY `fk_a_to_u_idx` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;

INSERT INTO `address` (`addressId`, `userId`, `firstname`, `lastname`, `company`, `tax`, `address`, `countryId`, `provinceId`, `amphurId`, `districtId`, `zipcode`, `tel`, `type`, `isDefault`, `status`, `createDateTime`, `updateDateTime`, `longitude`, `latitude`, `email`, `fax`)
VALUES
	(1,1,'test','test','test','222','test','THA',2523,79675,1,'222','06165398899',2,1,1,'2016-09-07 13:27:32','2016-09-07 13:27:32',NULL,NULL,'2222@gmail.com',NULL),
	(2,1,'xx','xx','xx','222','xxx','THA',2523,79675,1,'222','06165398899',1,1,1,'2016-09-07 13:27:51','2016-09-07 13:27:51',NULL,NULL,'2222@gmail.com',NULL),
	(3,3,'pornphun','p','na','na','na','THA',2523,79704,182,'10900','08100012123',1,1,1,'2016-09-28 09:21:28','2016-09-28 09:21:28',NULL,NULL,'phamsaksom@gmail.com',NULL),
	(4,5,'ประเสริฐ','ศาสตร์ภักดี','','1234567890124','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,182,'10900','1234567890',1,0,1,'2017-01-04 09:36:20','2016-09-30 15:43:05',NULL,NULL,'prayut.j@gmail.com',NULL),
	(5,2,'กมล','พวงเกษม','','','เลขที่ 1 ชั้น 7 อาคารเกล้าพูลทรัพย์ ','THA',2523,79704,182,'10900','0836134241',1,1,1,'2016-09-30 15:56:31','2016-09-30 15:56:31',NULL,NULL,'kamyjap@gmail.com',NULL),
	(6,6,'ณัฐวุฒิ ','เพียรปัญญารักษ์','','','1 ซอยลาดพร้าว 19 ถนนลาดพร้าว ','THA',2523,79704,182,'10900','1234123412',1,1,1,'2016-10-03 09:21:12','2016-10-03 09:21:12',NULL,NULL,'kurtumm@gmail.com',NULL),
	(7,9,'','','ขวัญข้าว จำกัด มหาชน','123456789','1111','THA',2523,79704,182,'10900',NULL,1,1,1,'2016-12-23 15:27:38','2016-12-23 15:27:38',NULL,NULL,NULL,'029383464'),
	(9,5,'Prasert','Satphakdee','aaa bbb ccc co.,ltd  สำนักงานใหญ่ ','1234567890123','เลขที่ 1 ซอยลาดพร้าว 1 ถ.ลาดพร้าว','THA',2523,79704,182,'10900','123456789',1,0,1,'2017-01-04 09:36:00','2016-12-27 09:18:25',NULL,NULL,'ton@ton.com',NULL);

/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bank
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `bankId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bankId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;

INSERT INTO `bank` (`bankId`, `title`, `description`, `image`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'ธนาคาร กรุงศีอยุธยา','','/images/Bank/5LlgcfoBI7.png',1,'2016-07-13 16:03:10','2016-07-13 16:03:10');

/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bank_transfer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank_transfer`;

CREATE TABLE `bank_transfer` (
  `bankTransferId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paymentMethodId` bigint(20) unsigned NOT NULL,
  `bankId` bigint(20) unsigned NOT NULL,
  `branch` varchar(25) NOT NULL,
  `accNo` text NOT NULL,
  `accName` varchar(300) NOT NULL,
  `accType` varchar(100) NOT NULL,
  `compCode` varchar(5) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bankTransferId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `brandId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `parentId` bigint(20) unsigned DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;

INSERT INTO `brand` (`brandId`, `userId`, `title`, `description`, `image`, `status`, `parentId`, `createDateTime`, `updateDateTime`)
VALUES
	(1,0,'NARS','','/images/Brand/q-qWeH9rLT.jpg',1,NULL,'2016-08-30 14:16:22','2016-09-15 10:17:22'),
	(2,0,'MAC','','/images/Brand/uZkhwjT297.jpg',1,NULL,'2016-09-01 13:47:42','2016-09-15 10:17:29'),
	(3,0,'LANCÔME','','/images/Brand/wiWPzXsZMX.jpg',1,NULL,'2016-09-08 10:18:49','2016-09-15 10:17:37'),
	(4,0,'BOBBI BROWN','','/images/Brand/mUpfYAQp7v.jpg',1,NULL,'2016-09-08 10:19:10','2016-09-15 10:17:50'),
	(5,0,'SK-II','','/images/Brand/7PVTCCtoLO.jpg',1,NULL,'2016-09-08 10:19:29','2016-09-15 10:17:56'),
	(6,0,'NAKED','','/images/Brand/Jk_OTy6pa9.jpg',1,NULL,'2016-09-08 11:27:39','2016-09-08 11:28:29'),
	(7,0,'Clinique','','/images/Brand/DIIulMAwsB.jpg',1,NULL,'2016-09-08 11:29:28','2016-09-15 10:18:20'),
	(8,0,'Estée Lauder','','/images/Brand/nCWFlGr0cR.jpg',1,NULL,'2016-09-08 11:30:43','2016-09-15 10:18:27'),
	(9,0,'SHISEIDO','','/images/Brand/T1CVu7z7Am.jpg',1,NULL,'2016-09-09 09:33:34','2016-09-15 10:18:36'),
	(10,0,'LA MER','','/images/Brand/pJkht4CyKn.jpg',1,NULL,'2016-09-09 09:34:47','2016-09-15 10:18:44'),
	(11,0,'COVERMARK','','/images/Brand/NejkTThXSh.jpg',1,NULL,'2016-09-09 09:36:27','2016-09-15 10:18:53'),
	(13,0,'PAYOT','','/images/Brand/dwiczPiqGp.jpg',1,NULL,'2016-09-13 10:12:18','2016-09-15 10:19:02'),
	(14,0,'BIOTHERM','','/images/Brand/xuiZNwfise.jpg',1,NULL,'2016-09-13 11:38:51','2016-09-15 10:19:11'),
	(15,0,' LANEIGE','','/images/Brand/RJr9NafBxB.png',1,NULL,'2016-09-19 10:15:43','2016-09-28 10:50:34'),
	(16,0,'GIORGIO ARMANI','','/images/Brand/lQzojWnXOL.png',1,16,'2016-09-20 09:37:11','2016-09-29 08:36:03'),
	(17,0,'LACOSTE','','/images/Brand/Bf573pgXFk.png',1,NULL,'2016-09-22 15:34:13','2016-09-28 16:19:21'),
	(18,0,'COACH','','/images/Brand/MJzUnhwqED.png',1,NULL,'2016-09-22 15:41:39','2016-09-28 16:24:29'),
	(20,0,'The history of whoo ','','/images/Brand/dtOio3Ndax.png',1,NULL,'2016-09-27 13:36:52','2016-09-28 16:30:17'),
	(21,0,'BOLON','','',1,NULL,'2016-09-29 15:02:13','2016-09-29 15:02:13'),
	(22,0,'CASIO ','','',1,NULL,'2016-09-29 15:09:32','2016-09-29 15:09:32'),
	(23,0,'LACOSTE','','/images/Brand/6M5-aL6XNl.png',1,NULL,'2016-09-29 15:25:20','2017-01-10 08:11:31'),
	(24,0,'AWAROVSKI','','/images/Brand/PHZR2w9lX7.png',1,NULL,'2016-09-29 15:35:00','2017-01-10 08:18:52'),
	(25,0,'TOSCOW ','','',1,NULL,'2016-09-29 15:35:09','2016-09-29 15:35:09'),
	(26,0,'SENNHEISER ','','/images/Brand/0mNGyb2Rkk.png',1,NULL,'2016-09-29 15:47:37','2016-09-29 15:47:37'),
	(27,0,'OLYMPUS ','','',1,NULL,'2016-09-29 15:59:08','2016-09-29 15:59:08'),
	(28,0,'PANASONIC ','','',1,NULL,'2016-09-29 16:04:12','2016-09-29 16:04:12'),
	(30,9,'fitnes','<p><br></p>','/images/Brand/zqeVD8icLWqUu4V9TAQJwebD_boHgc2J.jpg',1,NULL,'2016-12-01 13:54:10','2016-12-01 13:54:10'),
	(31,9,'ผ้าคราม ','<p>สกลผ้าทอ : จำหน่ายผ้าพันคอ ผ้าคลุมไหล่จากฝ้ายทอมือ โ<br></p>','/images/Brand/5sJvWiDOGSDDaDLn3ANmat2Ts_r7LpbN.jpg',1,NULL,'2016-12-02 09:44:11','2016-12-27 13:47:44'),
	(32,0,'DR.JILL','','/images/Brand/fuzRcV2aWc.jpg',1,NULL,'2017-01-06 13:45:24','2017-01-06 13:45:24'),
	(33,0,'SONY','','/images/Brand/vZrIUjNUL4.jpg',1,NULL,'2017-01-10 08:47:31','2017-01-10 08:47:31'),
	(34,0,'Unbranded/Generic','','',1,NULL,'2017-01-10 08:58:03','2017-01-10 08:58:03'),
	(35,0,'SKINFOOD','','/images/Brand/x9mS8oUty8.png',1,NULL,'2017-01-10 08:59:46','2017-01-10 08:59:46');

/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `categoryId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `parentId` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`categoryId`, `title`, `description`, `image`, `parentId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'ความงาม','','/images/Category/U2N9YqEENJ.jpg',NULL,1,'2016-08-30 11:31:35','2016-09-23 15:39:28'),
	(2,'เครื่องสำอาง ความงาม','','/images/Category/7oBFYUHvBz.jpg',1,1,'2016-08-30 11:32:46','2017-01-06 13:39:32'),
	(3,'ผลิตภัณฑ์บำรุงผิว','','/images/Category/xvm8lDxobo.jpg',1,1,'2016-08-30 11:33:11','2016-09-23 15:42:24'),
	(5,'ริมฝีปาก','','/images/Category/P3gjFCCsaF.jpg',2,1,'2016-08-30 11:35:25','2016-09-23 15:33:12'),
	(6,'ใบหน้า','','/images/Category/044chBqKln.jpg',2,1,'2016-08-30 11:36:00','2016-09-23 15:32:46'),
	(7,'ดวงตา','','/images/Category/sTdFbV5Rwi.jpg',2,1,'2016-08-30 11:36:41','2016-09-23 15:32:03'),
	(11,'ลดเลือนริ้วรอย','','/images/Category/1taFLgqbqx.jpg',3,1,'2016-09-02 10:08:49','2016-09-23 15:33:20'),
	(12,'ผลิตภัณฑ์ดูแลผิวหน้า','','/images/Category/RZ4v2qdduN.jpg',3,1,'2016-09-02 10:09:24','2017-01-06 13:40:15'),
	(13,'เพิ่มความชุ่มชื้น','','/images/Category/Q-gTfBX9Jp.jpg',3,1,'2016-09-02 10:09:47','2016-09-23 15:31:55'),
	(30,'เครื่องหนัง','','',37,1,'2016-09-16 14:04:04','2016-09-29 14:45:31'),
	(31,'แว่นตากันแดด','','',37,1,'2016-09-16 14:04:45','2016-09-20 09:23:01'),
	(32,'นาฬิกา','','',37,1,'2016-09-16 14:05:35','2016-09-20 09:23:10'),
	(33,'เครื่องแต่งกาย','','',37,1,'2016-09-16 14:05:47','2016-09-20 09:23:21'),
	(34,'เครื่องประดับ','','',37,1,'2016-09-16 14:06:03','2016-09-20 09:23:30'),
	(35,'กระเป๋า','','',37,1,'2016-09-16 14:07:20','2016-09-29 14:44:53'),
	(37,'แฟชั่น','','',NULL,1,'2016-09-20 09:22:04','2016-09-20 09:25:50'),
	(38,'อิเล็กทรอนิกส์','','',NULL,1,'2016-09-20 09:25:37','2016-09-20 09:25:44'),
	(39,'น้ำหอม ','','',1,1,'2016-09-20 09:27:39','2016-09-20 09:27:39'),
	(41,'GIORGIO','','',40,0,'2016-09-20 09:35:51','2016-09-20 09:35:51'),
	(42,'กระเป๋า','','/images/Category/mSjsnDo0Sn.jpg',35,1,'2016-09-22 15:38:53','2016-09-28 10:11:26'),
	(43,'น้ำหอม','','',39,1,'2016-09-29 08:33:57','2016-09-29 08:33:57'),
	(44,'ชุดน้ำหอม','','',39,1,'2016-09-29 08:34:15','2016-09-29 08:34:15'),
	(45,'อุปกรณ์เสริม','','',38,1,'2016-09-29 15:51:41','2016-09-29 15:58:06'),
	(46,'กล้องถ่ายรูป','','',38,1,'2016-09-29 15:59:40','2016-09-29 16:02:55');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table category_to_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category_to_product`;

CREATE TABLE `category_to_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `category_to_product` WRITE;
/*!40000 ALTER TABLE `category_to_product` DISABLE KEYS */;

INSERT INTO `category_to_product` (`id`, `categoryId`, `productId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(73,7,6,1,'2016-09-08 11:29:53','2016-09-08 11:29:53'),
	(74,2,6,1,'2016-09-08 11:29:53','2016-09-08 11:29:53'),
	(75,1,6,1,'2016-09-08 11:29:53','2016-09-08 11:29:53'),
	(117,13,15,1,'2016-09-13 10:22:22','2016-09-13 10:22:22'),
	(118,3,15,1,'2016-09-13 10:22:22','2016-09-13 10:22:22'),
	(119,1,15,1,'2016-09-13 10:22:22','2016-09-13 10:22:22'),
	(120,13,14,1,'2016-09-13 10:24:23','2016-09-13 10:24:23'),
	(121,3,14,1,'2016-09-13 10:24:23','2016-09-13 10:24:23'),
	(122,1,14,1,'2016-09-13 10:24:23','2016-09-13 10:24:23'),
	(126,14,18,1,'2016-09-13 11:45:58','2016-09-13 11:45:58'),
	(127,3,18,1,'2016-09-13 11:45:58','2016-09-13 11:45:58'),
	(128,1,18,1,'2016-09-13 11:45:58','2016-09-13 11:45:58'),
	(129,14,17,1,'2016-09-13 11:46:17','2016-09-13 11:46:17'),
	(130,3,17,1,'2016-09-13 11:46:17','2016-09-13 11:46:17'),
	(131,1,17,1,'2016-09-13 11:46:17','2016-09-13 11:46:17'),
	(135,15,20,1,'2016-09-14 09:00:33','2016-09-14 09:00:33'),
	(136,3,20,1,'2016-09-14 09:00:33','2016-09-14 09:00:33'),
	(137,1,20,1,'2016-09-14 09:00:33','2016-09-14 09:00:33'),
	(141,16,23,1,'2016-09-14 09:07:08','2016-09-14 09:07:08'),
	(142,3,23,1,'2016-09-14 09:07:08','2016-09-14 09:07:08'),
	(143,1,23,1,'2016-09-14 09:07:08','2016-09-14 09:07:08'),
	(147,16,25,1,'2016-09-14 09:46:32','2016-09-14 09:46:32'),
	(148,3,25,1,'2016-09-14 09:46:32','2016-09-14 09:46:32'),
	(149,1,25,1,'2016-09-14 09:46:32','2016-09-14 09:46:32'),
	(150,16,24,1,'2016-09-14 09:50:44','2016-09-14 09:50:44'),
	(151,3,24,1,'2016-09-14 09:50:44','2016-09-14 09:50:44'),
	(152,1,24,1,'2016-09-14 09:50:44','2016-09-14 09:50:44'),
	(156,5,26,1,'2016-09-16 10:27:34','2016-09-16 10:27:34'),
	(157,2,26,1,'2016-09-16 10:27:34','2016-09-16 10:27:34'),
	(158,1,26,1,'2016-09-16 10:27:34','2016-09-16 10:27:34'),
	(162,5,27,1,'2016-09-16 10:32:11','2016-09-16 10:32:11'),
	(163,2,27,1,'2016-09-16 10:32:11','2016-09-16 10:32:11'),
	(164,1,27,1,'2016-09-16 10:32:11','2016-09-16 10:32:11'),
	(174,14,10,1,'2016-09-19 10:09:29','2016-09-19 10:09:29'),
	(175,3,10,1,'2016-09-19 10:09:29','2016-09-19 10:09:29'),
	(176,1,10,1,'2016-09-19 10:09:29','2016-09-19 10:09:29'),
	(177,14,9,1,'2016-09-19 10:09:47','2016-09-19 10:09:47'),
	(178,3,9,1,'2016-09-19 10:09:47','2016-09-19 10:09:47'),
	(179,1,9,1,'2016-09-19 10:09:47','2016-09-19 10:09:47'),
	(180,10,28,1,'2016-09-19 10:16:28','2016-09-19 10:16:28'),
	(181,3,28,1,'2016-09-19 10:16:28','2016-09-19 10:16:28'),
	(182,1,28,1,'2016-09-19 10:16:28','2016-09-19 10:16:28'),
	(183,10,29,1,'2016-09-19 10:20:22','2016-09-19 10:20:22'),
	(184,3,29,1,'2016-09-19 10:20:22','2016-09-19 10:20:22'),
	(185,1,29,1,'2016-09-19 10:20:22','2016-09-19 10:20:22'),
	(189,14,12,1,'2016-09-19 10:23:41','2016-09-19 10:23:41'),
	(190,3,12,1,'2016-09-19 10:23:41','2016-09-19 10:23:41'),
	(191,1,12,1,'2016-09-19 10:23:41','2016-09-19 10:23:41'),
	(192,12,31,1,'2016-09-19 10:24:45','2016-09-19 10:24:45'),
	(193,3,31,1,'2016-09-19 10:24:45','2016-09-19 10:24:45'),
	(194,1,31,1,'2016-09-19 10:24:45','2016-09-19 10:24:45'),
	(198,13,33,1,'2016-09-19 10:30:54','2016-09-19 10:30:54'),
	(199,3,33,1,'2016-09-19 10:30:54','2016-09-19 10:30:54'),
	(200,1,33,1,'2016-09-19 10:30:55','2016-09-19 10:30:55'),
	(228,5,38,1,'2016-09-27 08:49:40','2016-09-27 08:49:40'),
	(229,2,38,1,'2016-09-27 08:49:40','2016-09-27 08:49:40'),
	(230,1,38,1,'2016-09-27 08:49:40','2016-09-27 08:49:40'),
	(324,33,45,1,'2016-09-29 15:28:34','2016-09-29 15:28:34'),
	(325,37,45,1,'2016-09-29 15:28:34','2016-09-29 15:28:34'),
	(330,34,48,1,'2016-09-29 15:41:32','2016-09-29 15:41:32'),
	(331,37,48,1,'2016-09-29 15:41:32','2016-09-29 15:41:32'),
	(335,45,50,1,'2016-09-29 15:54:23','2016-09-29 15:54:23'),
	(336,38,50,1,'2016-09-29 15:54:23','2016-09-29 15:54:23'),
	(377,33,46,1,'2016-10-07 11:34:10','2016-10-07 11:34:10'),
	(378,37,46,1,'2016-10-07 11:34:10','2016-10-07 11:34:10'),
	(379,34,47,1,'2016-10-07 11:39:36','2016-10-07 11:39:36'),
	(380,37,47,1,'2016-10-07 11:39:36','2016-10-07 11:39:36'),
	(387,45,49,1,'2016-10-10 09:04:36','2016-10-10 09:04:36'),
	(388,38,49,1,'2016-10-10 09:04:36','2016-10-10 09:04:36'),
	(391,46,51,1,'2016-10-10 09:27:21','2016-10-10 09:27:21'),
	(392,38,51,1,'2016-10-10 09:27:21','2016-10-10 09:27:21'),
	(393,46,52,1,'2016-10-10 09:27:43','2016-10-10 09:27:43'),
	(394,38,52,1,'2016-10-10 09:27:43','2016-10-10 09:27:43'),
	(408,30,36,1,'2016-10-17 13:27:05','2016-10-17 13:27:05'),
	(409,37,36,1,'2016-10-17 13:27:05','2016-10-17 13:27:05'),
	(413,32,53,1,'2016-10-17 13:27:32','2016-10-17 13:27:32'),
	(414,37,53,1,'2016-10-17 13:27:32','2016-10-17 13:27:32'),
	(415,32,54,1,'2016-10-17 13:27:45','2016-10-17 13:27:45'),
	(416,37,54,1,'2016-10-17 13:27:45','2016-10-17 13:27:45'),
	(429,5,1,1,'2016-10-17 15:32:03','2016-10-17 15:32:03'),
	(430,2,1,1,'2016-10-17 15:32:03','2016-10-17 15:32:03'),
	(431,1,1,1,'2016-10-17 15:32:04','2016-10-17 15:32:04'),
	(432,5,2,1,'2016-10-17 16:24:52','2016-10-17 16:24:52'),
	(433,2,2,1,'2016-10-17 16:24:52','2016-10-17 16:24:52'),
	(434,1,2,1,'2016-10-17 16:24:52','2016-10-17 16:24:52'),
	(435,6,3,1,'2016-10-17 16:25:01','2016-10-17 16:25:01'),
	(436,2,3,1,'2016-10-17 16:25:01','2016-10-17 16:25:01'),
	(437,1,3,1,'2016-10-17 16:25:01','2016-10-17 16:25:01'),
	(438,7,4,1,'2016-10-17 16:25:17','2016-10-17 16:25:17'),
	(439,2,4,1,'2016-10-17 16:25:17','2016-10-17 16:25:17'),
	(440,1,4,1,'2016-10-17 16:25:17','2016-10-17 16:25:17'),
	(441,7,5,1,'2016-10-17 16:25:43','2016-10-17 16:25:43'),
	(442,2,5,1,'2016-10-17 16:25:43','2016-10-17 16:25:43'),
	(443,1,5,1,'2016-10-17 16:25:43','2016-10-17 16:25:43'),
	(444,5,7,1,'2016-10-17 16:25:57','2016-10-17 16:25:57'),
	(445,2,7,1,'2016-10-17 16:25:57','2016-10-17 16:25:57'),
	(446,1,7,1,'2016-10-17 16:25:57','2016-10-17 16:25:57'),
	(447,5,8,1,'2016-10-17 16:26:16','2016-10-17 16:26:16'),
	(448,2,8,1,'2016-10-17 16:26:16','2016-10-17 16:26:16'),
	(449,1,8,1,'2016-10-17 16:26:16','2016-10-17 16:26:16'),
	(450,11,11,1,'2016-10-17 16:26:26','2016-10-17 16:26:26'),
	(451,3,11,1,'2016-10-17 16:26:26','2016-10-17 16:26:26'),
	(452,1,11,1,'2016-10-17 16:26:26','2016-10-17 16:26:26'),
	(453,11,16,1,'2016-10-17 16:26:37','2016-10-17 16:26:37'),
	(454,3,16,1,'2016-10-17 16:26:37','2016-10-17 16:26:37'),
	(455,1,16,1,'2016-10-17 16:26:37','2016-10-17 16:26:37'),
	(456,12,30,1,'2016-10-17 16:27:45','2016-10-17 16:27:45'),
	(457,3,30,1,'2016-10-17 16:27:45','2016-10-17 16:27:45'),
	(458,1,30,1,'2016-10-17 16:27:45','2016-10-17 16:27:45'),
	(459,13,32,1,'2016-10-17 16:28:02','2016-10-17 16:28:02'),
	(460,3,32,1,'2016-10-17 16:28:02','2016-10-17 16:28:02'),
	(461,1,32,1,'2016-10-17 16:28:02','2016-10-17 16:28:02'),
	(462,43,34,1,'2016-10-17 16:28:13','2016-10-17 16:28:13'),
	(463,39,34,1,'2016-10-17 16:28:13','2016-10-17 16:28:13'),
	(464,1,34,1,'2016-10-17 16:28:13','2016-10-17 16:28:13'),
	(465,42,35,1,'2016-10-17 16:28:27','2016-10-17 16:28:27'),
	(466,35,35,1,'2016-10-17 16:28:27','2016-10-17 16:28:27'),
	(467,37,35,1,'2016-10-17 16:28:27','2016-10-17 16:28:27'),
	(468,42,37,1,'2016-10-17 16:28:40','2016-10-17 16:28:40'),
	(469,35,37,1,'2016-10-17 16:28:40','2016-10-17 16:28:40'),
	(470,37,37,1,'2016-10-17 16:28:40','2016-10-17 16:28:40'),
	(471,44,39,1,'2016-10-17 16:28:57','2016-10-17 16:28:57'),
	(472,39,39,1,'2016-10-17 16:28:57','2016-10-17 16:28:57'),
	(473,1,39,1,'2016-10-17 16:28:57','2016-10-17 16:28:57'),
	(474,30,40,1,'2016-10-17 16:29:06','2016-10-17 16:29:06'),
	(475,37,40,1,'2016-10-17 16:29:06','2016-10-17 16:29:06'),
	(476,31,41,1,'2016-10-17 16:29:16','2016-10-17 16:29:16'),
	(477,37,41,1,'2016-10-17 16:29:16','2016-10-17 16:29:16'),
	(478,31,42,1,'2016-10-17 16:29:35','2016-10-17 16:29:35'),
	(479,37,42,1,'2016-10-17 16:29:35','2016-10-17 16:29:35'),
	(480,32,43,1,'2016-10-17 16:29:54','2016-10-17 16:29:54'),
	(481,37,43,1,'2016-10-17 16:29:54','2016-10-17 16:29:54'),
	(482,32,44,1,'2016-10-17 16:30:30','2016-10-17 16:30:30'),
	(483,37,44,1,'2016-10-17 16:30:30','2016-10-17 16:30:30'),
	(484,31,55,1,'2016-11-21 09:24:58','2016-11-21 09:24:58'),
	(485,37,55,1,'2016-11-21 09:24:58','2016-11-21 09:24:58'),
	(486,35,78,1,'2016-12-08 11:35:37','2016-12-08 11:35:37'),
	(487,37,78,1,'2016-12-08 11:35:37','2016-12-08 11:35:37'),
	(488,37,79,1,'2016-12-08 15:06:30','2016-12-08 15:06:30'),
	(489,45,80,1,'2016-12-08 15:08:18','2016-12-08 15:08:18'),
	(490,38,80,1,'2016-12-08 15:08:18','2016-12-08 15:08:18'),
	(491,45,81,1,'2016-12-08 15:10:20','2016-12-08 15:10:20'),
	(492,38,81,1,'2016-12-08 15:10:20','2016-12-08 15:10:20'),
	(493,45,82,1,'2016-12-09 10:58:09','2016-12-09 10:58:09'),
	(494,38,82,1,'2016-12-09 10:58:09','2016-12-09 10:58:09'),
	(508,45,83,1,'2016-12-27 09:17:15','2016-12-27 09:17:15'),
	(509,38,83,1,'2016-12-27 09:17:15','2016-12-27 09:17:15'),
	(510,45,84,1,'2016-12-27 09:44:17','2016-12-27 09:44:17'),
	(511,38,84,1,'2016-12-27 09:44:17','2016-12-27 09:44:17'),
	(516,45,88,1,'2016-12-27 10:54:16','2016-12-27 10:54:16'),
	(517,38,88,1,'2016-12-27 10:54:16','2016-12-27 10:54:16'),
	(518,34,89,1,'2016-12-27 11:06:33','2016-12-27 11:06:33'),
	(519,37,89,1,'2016-12-27 11:06:33','2016-12-27 11:06:33'),
	(520,34,90,1,'2016-12-27 11:08:54','2016-12-27 11:08:54'),
	(521,37,90,1,'2016-12-27 11:08:54','2016-12-27 11:08:54'),
	(529,34,92,1,'2016-12-27 16:05:27','2016-12-27 16:05:27'),
	(530,37,92,1,'2016-12-27 16:05:27','2016-12-27 16:05:27'),
	(539,12,93,1,'2017-01-06 13:48:56','2017-01-06 13:48:56'),
	(540,3,93,1,'2017-01-06 13:48:56','2017-01-06 13:48:56'),
	(541,1,93,1,'2017-01-06 13:48:56','2017-01-06 13:48:56'),
	(544,34,94,1,'2017-01-09 16:33:29','2017-01-09 16:33:29'),
	(545,37,94,1,'2017-01-09 16:33:29','2017-01-09 16:33:29'),
	(546,38,85,1,'2017-01-10 08:33:10','2017-01-10 08:33:10'),
	(547,45,86,1,'2017-01-10 08:47:49','2017-01-10 08:47:49'),
	(548,38,86,1,'2017-01-10 08:47:49','2017-01-10 08:47:49'),
	(551,32,87,1,'2017-01-10 08:53:57','2017-01-10 08:53:57'),
	(552,37,87,1,'2017-01-10 08:53:57','2017-01-10 08:53:57'),
	(555,33,91,1,'2017-01-10 08:58:22','2017-01-10 08:58:22'),
	(556,37,91,1,'2017-01-10 08:58:22','2017-01-10 08:58:22'),
	(557,42,95,1,'2017-01-11 09:28:39','2017-01-11 09:28:39'),
	(558,35,95,1,'2017-01-11 09:28:39','2017-01-11 09:28:39'),
	(559,37,95,1,'2017-01-11 09:28:39','2017-01-11 09:28:39'),
	(560,42,96,1,'2017-01-11 09:31:44','2017-01-11 09:31:44'),
	(561,35,96,1,'2017-01-11 09:31:44','2017-01-11 09:31:44'),
	(562,37,96,1,'2017-01-11 09:31:44','2017-01-11 09:31:44');

/*!40000 ALTER TABLE `category_to_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table configuration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `configuration`;

CREATE TABLE `configuration` (
  `configurationId` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` varchar(45) NOT NULL,
  `status` tinyint(6) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`configurationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table contact_us
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contact_us`;

CREATE TABLE `contact_us` (
  `contactId` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(6) DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contactId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `contentId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contentGroupId` bigint(20) unsigned NOT NULL,
  `headTitle` varchar(200) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `linkTitle` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contentId`),
  KEY `fk_c_to_cg_idx` (`contentGroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;

INSERT INTO `content` (`contentId`, `contentGroupId`, `headTitle`, `title`, `description`, `image`, `linkTitle`, `link`, `startDate`, `endDate`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,'Health & Beauty             ','สุขภาพ และ ความสวย                                            ','<p>เพราะผู้หญิงกับเรื่องความสวยความงามเป็นของคู่กัน<span></span><br>แต่ไม่ใช่ว่าทุกคนจะสามารถหยิบเครื่องสำอางและละเลงหน้าได้โดยไม่มีผิดพลาด<br> ต้องอาศัยประสบการณ์และเทคนิคต่างๆ ถึงจะเนรมิตให้สวยได้</p>','/images/Content/pbCpsvXd40.png','GO','http://192.168.100.8/cost.fit-test/frontend/web/search/เครื่องสำอาง/mbxQxo0nv4athEf7YhQyU_VlvEac17UA','2016-09-01 00:00:00','2016-10-29 00:00:00',1,'2016-07-04 10:04:51','2016-09-29 10:08:28'),
	(2,2,'ECO Life','.','<p>.</p><p>.</p><p>.</p><p>.</p>','/images/Content/GjJdc0ohEK.png','-','-',NULL,NULL,1,'2016-07-22 11:47:51','2016-09-23 14:59:51'),
	(3,3,'How Cozxy Works','How Cozxy Works','<p>1.Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that!</p>','','-','-',NULL,NULL,1,'2016-07-22 13:16:45','2016-09-27 15:45:08'),
	(4,3,'High Quality Leather','High Quality Leather','2.Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that!','','-','-',NULL,NULL,1,'2016-07-22 13:19:34','2016-07-22 13:19:34'),
	(5,3,'Smart deliver transfer','Smart deliver transfer','3.Outline the main advantages a one can get by purchasing a product from your store. Have you got expensive items and at the same time a flexible return policy? Make a customer aware of that!','','-','-',NULL,NULL,1,'2016-07-22 13:20:47','2016-07-22 13:20:47'),
	(6,4,'Subscribe to our news','Subscribe to our news','Get more followers. In case of high quality newsletters the customers return rate can increase up to 20%! Have you already estimated your possible income? We took that into account and created a decent subscription form. \r\nEnable edit.....','','-','-',NULL,NULL,1,'2016-07-22 13:51:07','2016-07-22 13:51:07'),
	(7,5,'PRIVACY POLICY','PRIVACY POLICY','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.  Enable Edit......','','-','-',NULL,NULL,1,'2016-07-22 14:09:54','2016-07-22 14:09:54'),
	(8,5,'SHIPPING AGREEMENT','SHIPPING AGREEMENT','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis. Enable edit','','-','-',NULL,NULL,1,'2016-07-22 14:10:34','2016-07-22 14:10:34'),
	(9,6,'FAQ Collapsible section 01 Edit....','FAQ Collapsible section 01 Edit....','Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table.','','-','-',NULL,NULL,1,'2016-07-22 14:42:29','2016-07-22 14:42:29'),
	(10,6,'FAQ Collapsible section 02','FAQ Collapsible section 02','Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.','','-','-',NULL,NULL,1,'2016-07-22 14:43:01','2016-07-22 14:43:01'),
	(11,6,'FAQ Collapsible section 03','FAQ Collapsible section 03','Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\'t heard of them accusamus labore sustainable VHS.','','-','-',NULL,NULL,1,'2016-07-22 14:43:31','2016-07-22 14:43:31'),
	(12,7,'name','name','บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)\r\nDaii Group Public Company Limited','','-','-',NULL,NULL,1,'2016-07-22 15:06:16','2016-07-22 15:06:16'),
	(13,7,'address','address','เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 ถนนลาดพร้าว แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900','','-','-',NULL,NULL,1,'2016-07-22 15:07:08','2016-07-22 15:07:08'),
	(14,7,'email','email','mail@Limo.com','','-','-',NULL,NULL,1,'2016-07-22 15:08:31','2016-07-22 15:08:31'),
	(15,7,'tel1','tel1','02-938-3464','','-','-',NULL,NULL,1,'2016-07-22 15:09:13','2016-07-22 15:09:13'),
	(16,7,'tel2','tel2','02-938-3463','','-','-',NULL,NULL,1,'2016-07-22 15:09:53','2016-07-22 15:09:53'),
	(17,8,'website','website','www.fenzer.biz','','-','-',NULL,NULL,1,'2016-07-22 15:12:22','2016-07-22 15:12:22'),
	(18,8,'website','website','www.ginzadesigns.com','','-','-',NULL,NULL,1,'2016-07-22 15:12:55','2016-07-22 15:12:55'),
	(19,8,'website','website','www.atechwindow.com','','-','-',NULL,NULL,1,'2016-07-22 15:14:22','2016-07-22 15:14:22'),
	(20,9,'description under logo','description under logo','Describe the mission of your online store and the advantages a customer can get once he makes a\r\n                        purchase. If you have something to tell let customers know about it.','','','',NULL,NULL,1,'2016-07-25 11:30:37','2016-07-25 11:30:37'),
	(21,9,'icon','icon','','','','',NULL,NULL,1,'2016-07-25 11:44:55','2016-07-25 11:44:55'),
	(22,10,'25 of May','new arrivals in Spring','และอีกนัยหนึ่ง ในตำนานแห่งกรณียเมตตสูตร สมเด็จพระผู้มีพระภาคเจ้าก็เคยสอนให้พระภิกษุที่ไปบำเพ็ญสมณธรรมอยู่ในป่า ซึ่งถูกภูตผีปีศาจไปรบกวนโดยพระองค์ทรงแนะนำว่า เมื่อเธอทั้งหลายเข้าไปสู่ประตูแห่งป่าแล้ว ให้ยืนกำหนดจิตระลึกถึงเราตถาคต โดยนัยแห่ง อิติปิ โส ภควา อรหํ สัมมาสัมพุทโธ... ภควาติ เจริญพุทธคุณ ธรรมคุณ สังฆคุณ แล้วให้สวดกรณียเมตตสูตร แล้วจึงเข้าไปในป่านั้น บรรดาภูตผีปีศาจที่คิดร้ายรบกวนต่อพระภิกษุทั้งหลายเหล่านั้นก็จะหายไปและจะช่วยอุปการะรักษาความสงัดเงียบมิให้มีสิ่งรบกวนเกิดขึ้นแก่พระคุณเจ้าทั้งหลายเหล่านั้น พระคุณเจ้าทั้งหลายก็เรียน พุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร จากสำนักของสมเด็จพระผู้มีพระภาคเจ้าแล้ว ก็เข้าไปสู่ป่าแห่งนั้น ปฏิบัติตามพุทธดำรัสทุกประการ แล้วก็เข้าไปบำเพ็ญสมณธรรมอยู่ในป่า ภูตผีปีศาจที่เคยแสดงความน่าเกลียดน่ากลัว หรือรบกวนท่านเหล่านั้นก็สงบเงียบไป มิหนำซ้ำยังช่วยรักษาความสงบ คือมิให้เกิดมีเสียงต่างๆรบกวน แม้แต่เสียงนกเสียงกาก็ไม่มี เป็นการสะดวกแก่การเจริญสมณธรรมของท่านเหล่านั้น ซึ่งในที่สุดท่านเหล่านั้นก็สำเร็จมรรคผลนิพพานไปตามๆกัน อันนี้เป็นกิจสำคัญอย่างหนึ่ง ที่จำเป็นจะต้องกล่าวการเจริญพุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร ตามนัยตำนานแห่งกรณียเมตตสูตรที่ปรากฏอยู่แล้ว','','','','2016-07-10 00:00:00','2017-07-10 00:00:00',1,'2016-07-25 14:09:44','2016-07-25 14:09:44'),
	(23,10,'24 of April','5 facts about clutches','และอีกนัยหนึ่ง ในตำนานแห่งกรณียเมตตสูตร สมเด็จพระผู้มีพระภาคเจ้าก็เคยสอนให้พระภิกษุที่ไปบำเพ็ญสมณธรรมอยู่ในป่า ซึ่งถูกภูตผีปีศาจไปรบกวนโดยพระองค์ทรงแนะนำว่า เมื่อเธอทั้งหลายเข้าไปสู่ประตูแห่งป่าแล้ว ให้ยืนกำหนดจิตระลึกถึงเราตถาคต โดยนัยแห่ง อิติปิ โส ภควา อรหํ สัมมาสัมพุทโธ... ภควาติ เจริญพุทธคุณ ธรรมคุณ สังฆคุณ แล้วให้สวดกรณียเมตตสูตร แล้วจึงเข้าไปในป่านั้น บรรดาภูตผีปีศาจที่คิดร้ายรบกวนต่อพระภิกษุทั้งหลายเหล่านั้นก็จะหายไปและจะช่วยอุปการะรักษาความสงัดเงียบมิให้มีสิ่งรบกวนเกิดขึ้นแก่พระคุณเจ้าทั้งหลายเหล่านั้น พระคุณเจ้าทั้งหลายก็เรียน พุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร จากสำนักของสมเด็จพระผู้มีพระภาคเจ้าแล้ว ก็เข้าไปสู่ป่าแห่งนั้น ปฏิบัติตามพุทธดำรัสทุกประการ แล้วก็เข้าไปบำเพ็ญสมณธรรมอยู่ในป่า ภูตผีปีศาจที่เคยแสดงความน่าเกลียดน่ากลัว หรือรบกวนท่านเหล่านั้นก็สงบเงียบไป มิหนำซ้ำยังช่วยรักษาความสงบ คือมิให้เกิดมีเสียงต่างๆรบกวน แม้แต่เสียงนกเสียงกาก็ไม่มี เป็นการสะดวกแก่การเจริญสมณธรรมของท่านเหล่านั้น ซึ่งในที่สุดท่านเหล่านั้นก็สำเร็จมรรคผลนิพพานไปตามๆกัน อันนี้เป็นกิจสำคัญอย่างหนึ่ง ที่จำเป็นจะต้องกล่าวการเจริญพุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร ตามนัยตำนานแห่งกรณียเมตตสูตรที่ปรากฏอยู่แล้ว','','','','2016-07-10 00:00:00','2017-07-10 00:00:00',1,'2016-07-25 14:11:02','2016-07-25 14:11:02'),
	(24,10,'25 of May','new arrivals in Spring','และอีกนัยหนึ่ง ในตำนานแห่งกรณียเมตตสูตร สมเด็จพระผู้มีพระภาคเจ้าก็เคยสอนให้พระภิกษุที่ไปบำเพ็ญสมณธรรมอยู่ในป่า ซึ่งถูกภูตผีปีศาจไปรบกวนโดยพระองค์ทรงแนะนำว่า เมื่อเธอทั้งหลายเข้าไปสู่ประตูแห่งป่าแล้ว ให้ยืนกำหนดจิตระลึกถึงเราตถาคต โดยนัยแห่ง อิติปิ โส ภควา อรหํ สัมมาสัมพุทโธ... ภควาติ เจริญพุทธคุณ ธรรมคุณ สังฆคุณ แล้วให้สวดกรณียเมตตสูตร แล้วจึงเข้าไปในป่านั้น บรรดาภูตผีปีศาจที่คิดร้ายรบกวนต่อพระภิกษุทั้งหลายเหล่านั้นก็จะหายไปและจะช่วยอุปการะรักษาความสงัดเงียบมิให้มีสิ่งรบกวนเกิดขึ้นแก่พระคุณเจ้าทั้งหลายเหล่านั้น พระคุณเจ้าทั้งหลายก็เรียน พุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร จากสำนักของสมเด็จพระผู้มีพระภาคเจ้าแล้ว ก็เข้าไปสู่ป่าแห่งนั้น ปฏิบัติตามพุทธดำรัสทุกประการ แล้วก็เข้าไปบำเพ็ญสมณธรรมอยู่ในป่า ภูตผีปีศาจที่เคยแสดงความน่าเกลียดน่ากลัว หรือรบกวนท่านเหล่านั้นก็สงบเงียบไป มิหนำซ้ำยังช่วยรักษาความสงบ คือมิให้เกิดมีเสียงต่างๆรบกวน แม้แต่เสียงนกเสียงกาก็ไม่มี เป็นการสะดวกแก่การเจริญสมณธรรมของท่านเหล่านั้น ซึ่งในที่สุดท่านเหล่านั้นก็สำเร็จมรรคผลนิพพานไปตามๆกัน อันนี้เป็นกิจสำคัญอย่างหนึ่ง ที่จำเป็นจะต้องกล่าวการเจริญพุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร ตามนัยตำนานแห่งกรณียเมตตสูตรที่ปรากฏอยู่แล้ว','','','','2016-07-10 00:00:00','2017-07-10 00:00:00',1,'2016-07-25 14:11:48','2016-07-25 14:11:48'),
	(25,10,'24 of April','5 facts about clutches','และอีกนัยหนึ่ง ในตำนานแห่งกรณียเมตตสูตร สมเด็จพระผู้มีพระภาคเจ้าก็เคยสอนให้พระภิกษุที่ไปบำเพ็ญสมณธรรมอยู่ในป่า ซึ่งถูกภูตผีปีศาจไปรบกวนโดยพระองค์ทรงแนะนำว่า เมื่อเธอทั้งหลายเข้าไปสู่ประตูแห่งป่าแล้ว ให้ยืนกำหนดจิตระลึกถึงเราตถาคต โดยนัยแห่ง อิติปิ โส ภควา อรหํ สัมมาสัมพุทโธ... ภควาติ เจริญพุทธคุณ ธรรมคุณ สังฆคุณ แล้วให้สวดกรณียเมตตสูตร แล้วจึงเข้าไปในป่านั้น บรรดาภูตผีปีศาจที่คิดร้ายรบกวนต่อพระภิกษุทั้งหลายเหล่านั้นก็จะหายไปและจะช่วยอุปการะรักษาความสงัดเงียบมิให้มีสิ่งรบกวนเกิดขึ้นแก่พระคุณเจ้าทั้งหลายเหล่านั้น พระคุณเจ้าทั้งหลายก็เรียน พุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร จากสำนักของสมเด็จพระผู้มีพระภาคเจ้าแล้ว ก็เข้าไปสู่ป่าแห่งนั้น ปฏิบัติตามพุทธดำรัสทุกประการ แล้วก็เข้าไปบำเพ็ญสมณธรรมอยู่ในป่า ภูตผีปีศาจที่เคยแสดงความน่าเกลียดน่ากลัว หรือรบกวนท่านเหล่านั้นก็สงบเงียบไป มิหนำซ้ำยังช่วยรักษาความสงบ คือมิให้เกิดมีเสียงต่างๆรบกวน แม้แต่เสียงนกเสียงกาก็ไม่มี เป็นการสะดวกแก่การเจริญสมณธรรมของท่านเหล่านั้น ซึ่งในที่สุดท่านเหล่านั้นก็สำเร็จมรรคผลนิพพานไปตามๆกัน อันนี้เป็นกิจสำคัญอย่างหนึ่ง ที่จำเป็นจะต้องกล่าวการเจริญพุทธคุณ ธรรมคุณ สังฆคุณ และกรณียเมตตสูตร ตามนัยตำนานแห่งกรณียเมตตสูตรที่ปรากฏอยู่แล้ว','','','','2016-07-06 00:00:00','2017-07-06 00:00:00',1,'2016-07-25 14:13:33','2016-07-25 14:13:33'),
	(26,11,'contact','contact','1 7th Fl. Soi Ladprao 19, Ladprao Road Jomphon, Chatuchak 10900 Bangkok Thailand\r\nmail@daiigroup.com\r\nTel +66 29383464\r\nFax +66 29383463','','','',NULL,NULL,1,'2016-07-25 14:56:05','2016-07-28 13:58:27'),
	(29,1,'Health and Beauty','ความสวย ความงาม','<p>เครื่องสำอาง ครีม แป้ง แบรนเนม ชื่อดัง<br> ราคาสุดคุ้ม ส่วนลดมากมาย<br>สินค้าของแท้ แน่นอน</p>','/images/Content/u5-sDBFaRz.png','GO','http://192.168.100.8/cost.fit-test/frontend/web/search/ผลิตภัณฑ์บำรุงผิว/mbxQxo0nv4bH65e2g75E0vVlvEac17UA',NULL,NULL,1,'2016-07-28 12:54:04','2016-09-29 08:25:28'),
	(34,1,'MOM & BABY','คุณแม่และเด็ก','<p>ของใช้สำหรับสำหรับคุณแม่ และลูกน้อย<br>สำหรับคุณแม่ ที่ต้องการสินค้าเกี่ยวกับลูกน้อย<br>ที่มีทุกอย่างที่คุณต้องการ</p>','/images/Content/neA5FzCfs0.png','','','2016-09-01 00:00:00','2017-12-30 00:00:00',1,'2016-09-28 09:46:47','2016-09-29 08:26:25'),
	(35,12,'Term','','<p>1. บทนำ</p><p><br>บริษัท คอซซี่ดอทคอม จำกัด อันรวมไปถึงบริษัทสาขาและพันธมิตรทางธุรกิจที่นำเสนอการบริการให้กับคุณ (ในข้อตกลงนี้จะเรียกว่า \"เว็บไซต์\") ภายใต้เงื่อนไขดังต่อไปนี้ เราขอความกรุณาให้คุณได้อ่านข้อตกลงดังต่อไปนี้อย่างละเอียด หากคุณไม่ยอมรับข้อตกลงและเงื่อนไขดังกล่าว กรุณาหลีกเลี่ยงหรืออย่าเข้าใช้งานที่เว็บไซต์นี้ การที่คุณใช้เว็บไซต์นี้หรือเข้าไปดูข้อมูลในหน้าใดๆของเว็บไซต์นี้ ถือว่าคุณยอมรับข้อผูกพันทางกฎหมายที่ระบุไว้ในข้อตกลงและเงื่อนไขการใช้บริการนี้ โดยรวมถึงนโยบายความเป็นส่วนตัวที่บริษัทกำหนดขึ้นด้วย<br><br><br>2. ข้อมูลต่างๆในเว็บไซต์<br><br>ถึงแม้ว่าบริษัทจะได้พยายามทุกวิถีทางที่จะทำให้ข้อมูลต่างๆในเว็บไซต์มีความถูกต้องมากที่สุด แต่ทางบริษัทหรือตัวแทนจำหน่ายของเรา ก็ไม่สามารถรับประกันว่าข้อมูลและส่วนประกอบดังกล่าวมีความถูกต้อง สมบูรณ์เพียงพอ ทันกาลทันเวลา หรือ เหมาะสมกับวัตถุประสงค์ใดโดยเฉพาะ ทั้งนี้บริษัทจะไม่รับผิดสำหรับความผิดพลาดหรือการละเว้นใดๆในข้อมูลและส่วนประกอบนั้น (รวมไปถึงข้อมูลหรือเนื้อหาใดๆก็ตามที่มีบุคคลที่สามหรือรวมไปถึง ข้อมูลและการรับประกันที่มีการนำเสนอขึ้นมา บริษัทขอสงวนสิทธิ์ที่จะทำการแก้ไขเปลี่ยนแปลงส่วนหนึ่งส่วนใดของเว็บไซต์หรือยุติการให้บริการได้ทุกเมื่อ ทั้งที่เป็นการถาวรหรือชั่วคราว โดยไม่จำเป็นต้องมีการแจ้งให้ทราบล่วงหน้าก็ได้ ข้อมูลและองค์ประกอบทุกๆส่วนในเว็บไซด์นี้ มีวัตถุประสงค์เพื่อให้ข้อมูลแก่ผู้บริโภคทั่วไปเท่านั้น ไม่มีข้อมูลส่วนหนึ่งส่วนใดที่มีวัตถุประสงค์เพื่อเป็นการให้คำแนะนำ การวินิจฉัย การให้คำปรึกษา แต่อย่างใด รวมถึงมิได้มีวัตถุประสงค์เพื่อการแลกเปลี่ยน พึงระลึกไว้ว่าคุณและผู้ติดตามของคุณใช้ข้อมูลที่ประกอบขึ้นในเว็บไซต์ของเราด้วยความเสี่ยงของตัวคุณเอง หากคุณพบข้อผิดพลาดหรือการละเลย เว้นว่างในส่วนใดของเว็บไซต์ของเรา กรุณาแจ้งให้เราทราบ<br><br><br>3. เครื่องหมายการค้าและลิขสิทธิ์<br><br>บริษัทเป็นเจ้าของลิขสิทธิ์ เครื่องหมายการค้า สัญลักษณ์และส่วนประกอบอื่นๆ ที่ปรากฏในทุกๆหน้าของเว็บไซต์นี้ (กล่าวโดยรวมคือ \"เครื่องหมายการค้า\") ห้ามมิให้ผู้ใด หรือ บริษัทใด ทำการดัดแปลง จัดเก็บในระบบที่สามารถนำมาใช้งานได้ ถ่ายโอน ลอกเลียนแบบ เผยแพร่ หรือ ใช้ข้อมูลและส่วนประกอบนั้นโดยมิได้รับความยินยอมเป็นลายลักษณ์อักษรจาก บริษัท.<br><br><br>4. การเชื่อมโยงกับเว็บไซต์อื่น<br><br>เว็บไซต์ของ บริษัท อาจมีการเชื่อมโยงกับเว็บไซต์อื่น เพื่อวัตถุประสงค์ในการให้ข้อมูลและเพื่อความสะดวกของคุณ บริษัท มิได้ให้การรับรองหรือยืนยันความถูกต้องในเนื้อหาของเว็บไซต์เหล่านั้น และมิได้สื่อโดยนัยว่า บริษัท ให้การรับรองหรือแนะนำข้อมูลในเว็บไซต์เหล่านั้น การเข้าเยี่ยมชมหรือใช้ข้อมูลจากเว็บไซต์อื่นๆนั้นถือเป็นหน้าที่ของคุณในการพิจารณาวิเคราะห์ความเสี่ยงที่อาจเกิดขึ้นจากการใช้ข้อมูลในเว็บไซด์เหล่านั้นด้วยตนเอง การเข้าเยี่ยมชมเว็บไซต์อื่นๆนั้น เราขอแนะนำให้คุณอ่านรายละเอียดข้อตกลงและเงื่อนไขการใช้บริการ ตลอดจนนโยบายการรักษาความปลอดภัยของเว็บไซต์ที่เชื่อมโยงนั้นก่อนเข้าใช้เว็บไซต์ดังกล่าว และเราไม่อนุญาตให้คุณทำลิงค์จากเว็บไซต์ของตนเองเพื่อเชื่อมโยงไปยังเว็บไซต์เหล่านั้นโดยมิได้มีการขออนุญาตจาก บริษัท เป็นลายลักษณ์อักษรเสียก่อน กรุณาติดต่อเรา หากคุณต้องการทำลิงค์เชื่อมโยงไปยังเว็บไซต์ของคุณ<br><br><br>5. กฎ กติกา มารยาทในการใช้งานเว็บบอร์ดและการนำเสนอข้อมูลของผู้ใช้งานเว็บไซต์<br><br>บริษัทจะไม่รับผิดชอบต่อเนื้อหาใดๆที่คุณได้ทำการนำเสนอต่อสาธารณชน (ทั้งนี้รวมถึงเว็บบอร์ด หน้าข้อมูลต่างๆของเว็บไซต์ ห้องแชท หรือพื้นที่สาธารณะใดๆก็ตามที่ปรากฏอยู่ในเว็บไซต์) ทางบริษัทไม่จำเป็นต้องเห็นด้วย และ ไม่มีส่วนเกี่ยวข้องกับเนื้อหาใดๆ (ที่คุณหรือผู้ใช้งานท่านอื่นแสดงความคิดเห็นขึ้นมา) บริษัท ขอสงวนสิทธิ์ในการใช้ดุลยพินิจที่จะลบเนื้อหาหรือความคิดเห็นของคุณได้โดยไม่ต้องแจ้งให้คุณทราบล่วงหน้า ถ้าหากเนื้อหาหรือความคิดเห็นนั้นๆมีเจตนาหรือมีข้อสงสัยว่าเป็น<br><br>5.1 ข้อความหรือเนื้อหาอันเป็นการทำลายชื่อเสียง หมิ่นประมาท ส่อเสียด คุกคาม ว่ากล่าวให้ร้าย แก่สมาชิกท่านอื่นหรือบุคคลที่ 3<br><br>5.2 การนำเสนอ เผยแพร่ ข้อความหรือเนื้อหาที่เป็นการนำเสนอที่ส่อไปในทางลามก อนาจารหรือขัดต่อกฎหมายใดๆ<br><br>5.3 การเผยแพร่หรืออัพโหลดไฟล์ข้อมูลที่มีไวรัส ไฟล์ที่ส่งผลให้เกิดการทำงานที่ไม่ปกติ หรือ ซอฟท์แวร์ หรือโปรแกรมใดๆที่อาจก่อให้เกิดความเสียหายต่อการทำงานของเว็บไซต์ของ บริษัท และ/หรือระบบคอมพิวเตอร์ รวมถึงระบบเครือข่ายของบุคคลที่สาม<br><br>5.4 ข้อความหรือเนื้อหาที่เป็นการละเมิดลิขสิทธิ์หรือเครื่องหมายการค้า ที่เป็นการผิดกฎหมายของประเทศไทยหรือ นานาประเทศ รวมถึงการละเมิดลิขสิทธิ์ทรัพย์สินทางปัญญาของ บริษัท หรือบุคคลที่สาม<br><br>5.5 การนำเสนอข้อความหรือเนื้อหาที่เป็นการโฆษณา หรือเนื้อหาที่เป็นการประชาสัมพันธ์อันมีเจตนาเพื่อจะกระตุ้นให้เกิดการซื้อสินค้า<br><br><br>6. สมาชิกภาพ<br><br>เว็บไซต์ของ บริษัท ไม่ให้บริการกับผู้ใช้งานที่มีอายุต่ำกว่า 18 ปี ซึ่งเป็นผู้ที่อยู่นอกเหนือจากกลุ่มเป้าหมายของเรา หรือสมาชิกที่เคยถูก บริษัท ตัดสิทธิ์การใช้งานไปแล้ว ผู้ใช้งานแต่ละท่านจะได้รับอนุญาตให้มีบัญชีผู้ใช้งานได้เพียงบัญชีเดียวเท่านั้น การละเมิดเงื่อนไขที่ได้กล่าวมาแล้วนั้นอาจส่งผลให้เกิดการระงับบัญชีผู้ใช้งานได้<br><br>บริษัท อาจมีโปรโมชั่น หรือ รางวัลพิเศษให้แก่สมาชิกของเราเป็นครั้งคราว ในการรับโปรโมชั่นพิเศษดังกล่าวหากสมาชิกผู้ใช้งานท่านใดที่ได้รับรางวัล (จะเป็นของรางวัล เครดิตพิเศษ บัตรของขวัญ คูปอง หรือ ผลประโยชน์อื่นใด นอกเหนือจากนี้) จาก บริษัท แต่มีการสมัครสมาชิกซ้ำซ้อนเอาไว้ในหลายชื่อ หรือใช้อีเมล์แอดเดรสหลายชื่อ รวมถึง การให้ข้อมูลที่เป็นเท็จ หรือ มีการกระทำอันเป็นการหลอกลวงจะถูกตัดสิทธิในการได้รับรางวัลใดๆในกิจกรรมที่ทางเราได้จัดขึ้นและอาจจะถูกดำเนินคดีตามกฎหมายหรือมีโทษปรับตามกฎหมายอาญา<br><br>การใช้งานเว็บไซต์ของ บริษัท พึงตระหนักว่าคุณต้องมีอายุครบตามที่กฎหมายกำหนดในการทำสัญญากับเราและต้องมิใช่บุคคลที่เคยถูกระงับการให้บริการตามกฎหมายของประเทศไทยหรือขอบเขตกฎหมายอื่นใด และเมื่อทาง บริษัท แจ้งความประสงค์ไป คุณต้องยินยอมที่จะให้ข้อมูลที่เป็นจริงและถูกต้องของตนเอง หากทาง บริษัท ตรวจสอบพบว่า คุณได้ให้ข้อมูลอันเป็นเท็จ ไม่ถูกต้อง หรือ ไม่ครบถ้วนสมบูรณ์ บริษัท มีสิทธิ์ที่จะระงับสิทธิ์ในการเป็นสมาชิกชั่วคราว ตลอดจนยกเลิกการเป็นสมาชิกของคุณ หรือปฏิเสธการสมัครสมาชิกเพื่อใช้งานของคุณอีกในอนาคต คุณจะต้องเป็นผู้รับผิดชอบแต่ผู้เดียวในการเก็บรักษาชื่อบัญชีผู้ใช้งานและรหัสผ่านของตนเองให้เป็นความลับ คุณตกลงยินยอมที่จะรับผิดชอบต่อกิจกรรมใดๆที่เกิดขึ้นภายใต้ชื่อบัญชีผู้ใช้งานของคุณเอง<br><br><br>7. การยกเลิกอันเกิดจากความผิดพลาด<br><br>บริษัทมีสิทธิอย่างเต็มที่ที่จะยกเลิกคำสั่งซื้อได้ทุกเมื่อ หากความผิดพลาดนั้นเกิดมาจากความผิดพลาดในการพิมพ์หรือความผิดพลาดที่มิได้มีการคาดการณ์ไว้ล่วงหน้า อันเป็นผลมาจากสินค้าในเว็บไซต์ที่มีการลงรายการไว้ไม่ถูกต้อง (ไม่ว่าจะเป็นการลงราคาผิด หรือ ลงรายละเอียดที่ผิด เป็นต้น) ในกรณีที่รายการสั่งซื้อนั้นเกิดการยกเลิกขึ้นและเราได้รับการชำระเงินสำหรับคำสั่งซื้อนั้นเสร็จสมบูรณ์เรียบร้อยแล้ว บริษัท จะทำการคืนเงินให้ท่านเต็มจำนวนราคาสินค้า<br><br><br>8. การใช้งานอันไม่เหมาะสม<br><br>คุณตกลงใจที่จะไม่ใช้เว็บไซต์ของบริษัท เพื่อเป็นการส่งหรือประกาศถึงเนื้อหาหรือข้อมูลใดๆอันเป็นการขัดต่อกฎหมาย ข่มขู่ รังควาน เจตนาทำลายชื่อเสียง หมิ่นประมาท หยาบคาย คุกคาม มุ่งร้าย ลามกอนาจาร ส่อไปในทางเรื่องเพศ ก้าวร้าว ทำให้ผู้อื่นไม่พอใจ ดูหมิ่นศาสนา รวมถึงรูปภาพลามกหรือผิดกฎหมายใดๆที่บังคับใช้ ด้วยเหตุนี้หากคุณได้ทำการส่งหรือประกาศถึงเนื้อหา หรือ ข้อความ รวมถึง รูปภาพใดๆที่กล่าวมาแล้วนั้น และทาง บริษัท หรือ บุคคลที่สามใดๆก็ตาม ได้รับความเสียหายอันเนื่องมาจากเนื้อหาหรือข้อมูลของคุณ ไม่ว่าจะทางตรงหรือทางอ้อมก็ตามที คุณจะต้องเป็นผู้รับผิดชอบความเสียหาย รวมถึงหนี้สิน ค่าเสียหายและรายจ่ายอันเกิดขึ้นจากการที่ บริษัท หรือ บุคคลที่ 3 ต้องสูญเสียไป</p><p>9. การรับประกัน</p><p><br>ไม่ว่าในกรณีใดๆ บริษัท ไม่ขอรับประกัน รับรอง หรือ เป็นตัวแทน ต่อการนำเสนอเนื้อหาของผู้ใช้งาน หรือ ความคิดเห็น คำแนะนำ หรือคำรับประกันใดๆที่ปรากฏ (ไม่ว่าจะแจ้งไว้อย่างชัดเจนหรือบอกเป็นนัยยะทางกฎหมายก็ตามที) ในเว็บไซต์ของเรา โดยหมายรวมถึงข้อมูลส่วนตัวของคุณหรือผู้ติดตามของคุณที่มีการส่งผ่านระบบของเราด้วย<br><br><br>10. ข้อจำกัดความรับผิด<br><br>บริษัท จะไม่รับผิดชอบในความเสียหายใดๆ รวมถึง ความเสียหาย สูญเสียและค่าใช้จ่ายที่เกิดขึ้นไม่ว่าโดยทางตรงหรือโดยทางอ้อม โดยเฉพาะเจาะจง โดยบังเอิญ หรือ เป็นผลสืบเนื่องที่ตามมา อาการบาดเจ็บทางร่างกาย หรือ ค่าใช้จ่ายอันเกิดขึ้นจากอาการบาดเจ็บของคุณหรือบุคคลที่สามคนใดก็ตาม (รวมถึงผู้ติดตามของคุณด้วย) รวมถึงผลลัพธ์อันเนื่องมาจากการเข้าใช้งานในเว็บไซต์ของเรา ไม่ว่าจะโดยตรงหรือโดยอ้อม ทั้งข้อมูลใดๆที่ปรากฏอยู่บนเว็บไซต์ ข้อมูลส่วนตัวของคุณหรือข้อมูลผู้ติดตามของคุณ ตลอดจนเนื้อหาและข้อมูลต่างๆที่มีการส่งผ่านระบบของเรา กล่าวให้เฉพาะเจาะจงลงไปคือ บริษัท หรือ บุคคลที่สามใดๆ หรือ ข้อมูล เนื้อหาที่มีการนำเสนอขึ้นมา จะไม่ต้องรับผิดชอบทางกฎหมายใดๆต่อคุณหรือต่อบุคคลอื่นใด ทั้งต่อบริษัทใดๆก็ตามที่ต้องประสบกับความสูญเสีย เกิดค่าใช้จ่าย ไม่ว่าจะโดยตรงหรือโดยอ้อม การบาดเจ็บทางร่างกายหรือค่าใช้จ่ายอันเกิดขึ้นจากความล่าช้า ความไม่ถูกต้อง ความผิดพลาด หรือ การเว้นว่างของข้อมูลด้านราคาที่มีการแบ่งสรรปันส่วนกัน หรือ การส่งต่อกัน หรือ การกระทำใดๆอันเกิดจากความเชื่อถือในเนื้อหา หรือ เป็นเหตุให้เกิดการไม่ประสบผลสำเร็จ หรือ การหยุดชะงัก หรือ การสิ้นสุด</p><p>โปรแกรมแนะนำเพื่อนเพื่อรับเครดิตฟรีและโปรแกรมการรับเครดิตคืน รวมถึงโปรแกรมรับผลตอบแทนอื่นๆ ของเว็บไซต์ <a href=\"http://www.Cozxy.com\">www.Cozxy.com</a>  ขึ้นอยู่กับดุลพินิจของ บริษัท คอซซี่ดอทคอม จำกัด เท่านั้น บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลง ยกเลิกโปรแกรมทั้งเป็นการชั่วคราวหรือถาวรในทุกๆโปรแกรม ทั้งโปรแกรมแนะนำเพื่อนเพื่อรับเครดิตฟรีและโปรแกรมการรับเครดิตคืนหรือโปรแกรมรับผลตอบแทนอื่นๆ โดยไม่ต้องแจ้งสมาชิกล่วงหน้า</p><p>บริษัทฯ อาจทำการเพิกถอน จำกัด เปลี่ยนแปลงเครดิต เพิ่มหรือลดจำนวนเครดิตคืน ตามความเหมาะสมของแต่ละดีลที่สอดคล้องกับโปรแกรมการแนะนำเพื่อนเพื่อรับฟรีเครดิตและโปรแกรมการรับเครดิตคืน</p><p>การสมัครเป็นสมาชิก บริษัท ถือว่าท่านได้ยอมรับเงื่อนไขข้อตกลง ของโปรแกรมการแนะนำเพื่อนเพื่อรับฟรีเครดิต และการรับเครดิตคืน ซึ่งท่านหรือบุคคลที่สามไม่มีสิทธิ์เปลี่ยนแปลงหรือยกเลิกโปรแกรมดังกล่าวได้</p><p>11. การชดเชยค่าเสียหาย</p><p><br>ผู้ใช้งานยอมรับที่จะชดเชยค่าเสียหาย และค่าใช้จ่ายอันเกิดจากการละเมิดเงื่อนไขและข้อกำหนดในการให้บริการหรือการกระทำอื่นใดที่เกี่ยวข้องกับบัญชีผู้ใช้งานของสมาชิก อันเนื่องมาจากการละเลยไม่ใส่ใจหรือการกระทำที่ผิดกฎหมาย และผู้ใช้งานจะไม่ยึดให้ บริษัท (หรือพนักงานของบริษัททุกคน ผู้บริหารของบริษัท ผู้ผลิตสินค้า บริษัทสาขา บริษัทร่วมทุนตลอดจนหุ้นส่วนทางกฎหมาย) ต้องรับผิดชอบต่อการเรียกร้องค่าเสียหายรวมถึงค่าใช้จ่ายของทนายความที่เกิดขึ้นด้วย<br><br><br>12. การใช้งานเว็บไซต์<br><br>บริษัท มิได้รับรอง รับประกัน หรือ เป็นตัวแทนของข้อมูล เนื้อหาใดๆที่ปรากฏบนหน้าเว็บไซต์ซึ่งอาจนำไปใช้เพื่อขอบเขตทางกฎหมายของประเทศอื่นใด (นอกเหนือจากประเทศไทย) เมื่อคุณเข้ามาที่เว็บไซต์ของเรา ถือว่าคุณได้รับรู้และหมายถึงการแสดงตนต่อ บริษัท แล้วว่า คุณมีสิทธิตามกฎหมายในการทำเช่นนั้นและให้ใช้ข้อมูลเหล่านั้นได้ในเว็บไซต์ของเรา<br><br><br>13. บททั่วไป<br><br>13.1 ข้อตกลงทั้งหมด เงื่อนไขการให้บริการของเว็บไซต์ <a href=\"http://www.cozxy.com/\">Cozxy.com</a>  ทั้งหมดนี้เป็นข้อตกลงเบ็ดเสร็จและเด็ดขาดระหว่างคุณและ บริษัท เกี่ยวกับการที่ท่านเข้ามาใช้งานเว็บไซต์ของเรา ทั้งคุณและบริษัท มิได้ถูกผูกมัด หรือแสดงนัยยะถึงการเป็นตัวแทน รับรอง หรือสัญญาใดๆที่ไม่ได้บันทึกไว้ในนี้ นอกเสียจากจะมีการเอ่ยถึงไว้อย่างเป็นพิเศษ ข้อกำหนดและเงื่อนไขในการให้บริการของเว็บไซต์ของเราเป็นฉบับปัจจุบันที่ถือเป็นฉบับล่าสุดที่ใช้แทนที่ทุกความรับผิดชอบ ภาระผูกพัน หรือ การเป็นตัวแทน ที่แล้วๆมา ไม่ว่าจะเป็นลายลักษณ์อักษรหรือปากเปล่าก็ตามที ระหว่างคุณและ บริษัท ที่เกี่ยวข้องกับการที่คุณใช้งานเว็บไซต์ของเรา<br><br>13.2 การเปลี่ยนแปลงแก้ไข บริษัท อาจมีการเปลี่ยนแปลง แก้ไขข้อกำหนด และ เงื่อนไขเหล่านี้ได้ทุกเวลา พึงตระหนักไว้เสมอว่า การเข้าเยี่ยมชมเว็บไซต์ของเราในแต่ละครั้ง ถือว่าคุณตกลงยินยอมต่อข้อกำหนดและเงื่อนไขที่ได้รับการแก้ไขล่าสุดแล้ว และถึงแม้ว่าการเปลี่ยนแปลงแก้ไขข้อกำหนดและเงื่อนไขครั้งล่าสุดจะมิได้มีการระบุไว้ก็ตามที แต่ให้ยึดเอาข้อกำหนดและเงื่อนไขฉบับปัจจุบันเป็นสำคัญ การเข้าเยี่ยมชมเว็บไซต์ บริษัท ของคุณในแต่ละครั้ง จะต้องถือเอาข้อกำหนดและเงื่อนไขล่าสุดเป็นสำคัญ และเป็นความรับผิดชอบของคุณเองที่ควรจะเยี่ยมชมหน้าดังกล่าวของเว็บไซต์เป็นระยะๆ เพื่อให้ทราบถึงเนื้อหาล่าสุดของข้อบังคับและเงื่อนไขในการใช้งานที่คุณมี<br><br>13.3 ความขัดแย้ง กรณีที่มีการกำหนดข้อตกลงและเงื่อนไขการใช้บริการในหน้าอื่นที่ขัดแย้งกับ ข้อตกลงและเงื่อนไขการใช้บริการนี้ ไม่ว่าจะเป็น นโยบาย หรือ ประกาศ หรือ เงื่อนไขและข้อตกลงในการใช้บริการอื่นใดก็ตาม ในส่วนที่กำหนดไว้เป็นพิเศษหรือมาตรฐานของเว็บไซต์ ให้คุณถือปฏิบัติตามข้อตกลงและเงื่อนไขการใช้บริการที่ปรากฏในหน้าอื่นนั้นอย่างเป็นกรณีพิเศษก่อน และข้อกำหนดข้อนั้นจะถือว่าแยกออกจากข้อกำหนดเหล่านี้และไม่มีผลกระทบต่อการมีผลใช้บังคับของข้อตกลงที่เหลือนี้<br><br>13.4 การสละสิทธิ์ ทั้งคุณหรือ บริษัท ไม่สามารถมอบหมาย, ถ่ายโอน, หรือให้สิทธิช่วงในสิทธิของคุณส่วนหนึ่งส่วนใดหรือทั้งหมดภาย ใต้ข้อตกลงนี้โดยปราศจากการอนุญาตเป็นลายลักษณ์อักษรล่วงหน้าก่อนได้ ยกเว้นแต่จะมีการทำคำสละสิทธิ์ออกมาเป็นลายลักษณ์อักษรชัดเจนและมีการลงนาม ของบุคคลที่มีอำนาจเพียงพอจากฝ่ายที่อนุญาตให้มีการบอกเลิกสิทธิ์<br><br>13.5 การถือครองสิทธิ์ บริษัท มีสิทธิขาดในการยกให้ โอนสิทธิ หรือ มอบหมายลิขสิทธิ์และสัญญาผูกมัดทั้งหมด ให้ตัวแทนหรือบุคคลที่สามคนอื่นใดก็ได้ จะเป็นในแง่ของเงื่อนไขการให้บริการ นโยบายและประกาศใดๆที่เกี่ยวข้องกันก็ตามที<br><br>13.6 การเป็นโมฆะเป็นบางส่วน ข้อกำหนดทุกประการรวมถึงเงื่อนไขในการให้บริการ นโยบาย และ ประกาศใดๆก็ตามที่เกี่ยวเนื่องกัน ไม่ว่าจะพิจารณาแบบรวมเข้าด้วยกันหรือมีการเกี่ยวโยงกันตามหลักไวยากรณ์ ประการใดก็ตามที จะมีการบังคับใช้เป็นเอกเทศ แยกเป็นอิสระจากกัน หากมีข้อกำหนดใดของเงื่อนไขในการให้บริการ นโยบาย หรือ ประกาศ ซึ่งเป็น หรือ กลายเป็น การไม่สามารถบังคับใช้ขอบเขตอำนาจในการบังคับคดีได้ ไม่ว่าจะเป็น การเป็นโมฆะ การใช้งานไม่ได้ การทำผิดกฎหมาย หรือ การไม่ชอบด้วยกฎหมาย หรือด้วยเหตุผลอื่นใดก็ตามที หรือ หากศาลหรือเขตอำนาจศาลใดเห็นว่า ข้อกำหนดเงื่อนไขของสัญญานี้ หรือ ส่วนใดส่วนหนึ่ง ของสัญญานี้ ใช้บังคับไม่ได้ ให้ใช้ข้อบังคับอื่นใดนอกเหนือจากข้อนั้นๆ เท่าที่สามารถจะใช้ได้ และ โดยให้ ส่วนที่เหลือ ของสัญญานี้มีผลบังคับใช้ได้อย่างเต็มที่<br><br>13.7 กฎหมายที่บังคับใช้ ข้อตกลงนี้ได้รับการควบคุมโดยกฎหมายแห่งประเทศไทย โดยไม่คำนึงถึงความขัดแย้งของหลักกฎหมาย ดังนี้เองคุณจึงเห็นชอบด้วยว่าข้อโต้แย้งหรือข้อเรียกร้องที่เกิดขึ้นจาก หรือ เกี่ยวข้องกับ ข้อตกลงนี้จะได้รับการแก้ไขด้วยศาลสูงที่ตั้งอยู่ในกรุงเทพมหานคร ประเทศไทยเท่านั้น และดังนี้เอง คุณจึงได้อนุญาตและยอมรับต่ออำนาจศาลดังกล่าวในการฟ้องร้อง ข้อโต้แย้ง หรือ ข้อเรียกร้องใดๆ อันเกิดขึ้นจากการเกี่ยวพันกับเว็บไซต์ของเรา หรือ เงื่อนไขในการให้บริการข้ออื่นๆที่เกี่ยวเนื่องกัน รวมไปถึง ประกาศ นโยบาย หรือ เนื้อหาสาระข้อมูลอื่นใดที่มีความเกี่ยวข้องหรือมีความเกี่ยวโยงกัน<br><br>13.8 ความคิดเห็นหรือข้อสงสัย หากคุณมีข้อสงสัย หรือ คำถามประการใดเกี่ยวกับข้อกำหนดและเงื่อนไขในการให้บริการ นโยบายความเป็นส่วนตัว หรือ เงื่อนไขการให้บริการ นโยบาย และ ประกาศ หรือแนวทางที่เราบริหารจัดการข้อมูลส่วนบุคคลของคุณก็ตาม กรุณาติดต่อเราได้ทันที<br><br><br>14. การสิ้นสุด<br><br>คุณต้องปฏิบัติตามและยึดเอาเงื่อนไขในการให้บริการทั้งหมดนี้เป็นสำคัญเมื่อคุณเข้าใช้งานในเว็บไซต์ของ บริษัท และ/หรือเมื่อคุณทำการลงทะเบียนเพื่อเป็นสมาชิก หรือ ระหว่างการดำเนินการซื้อของคุณ ข้อกำหนดและเงื่อนไขในการให้บริการทั้งหมดนี้ หรือ แม้เพียงข้อหนึ่งข้อใดก็ตาม ทาง บริษัท อาจจะมีการปรับเปลี่ยน แก้ไข หรือ ตัดออก โดยไม่จำเป็นต้องมีการแจ้งให้ทราบล่วงหน้า ข้อกำหนดหรือเงื่อนไขใดๆที่เกี่ยวข้องกับ ลิขสิทธิ์ เครื่องหมายการค้า การปฏิเสธความรับผิดชอบ การอ้างสิทธิ ข้อจำกัดของความรับผิดชอบ การชดเชย กฎหมายที่นำมาบังคับใช้ การตัดสินโดยอนุญาโตตุลาการ จะยังคงมีผลอยู่อย่างสมบูรณ์ถึงแม้จะมีการยกเลิกหรือ สิ้นสุดส่วนใดส่วนหนึ่งไปก็ตามที<br><br><br>15. การคืนและการยกเลิกคำสั่งซื้อ<br><br>คำสั่งซื้อสามารถจะทำการยกเลิกได้ หากใบยืนยันการสั่งซื้อของท่านยังมิได้ทำการส่งไปถึงท่าน หากเมื่อใบยืนยันการสั่งสินค้า ได้ทำการส่งไปยังบัญชีผู้ใช้งานของท่านเรียบร้อยแล้ว ท่านจะไม่สามารถทำการยกเลิกคำสั่งซื้อนั้นได้ การขอคืนหลังจากนั้นจะมีการพิจารณาบนพื้นฐานเป็นกรณีๆไป เราจะพยายามรักษาผลประโยชน์ให้สมาชิกอย่างสูงสุด ภายใต้ข้อจำกัดที่เรามี ทว่าเราไม่สามารถจะรับคืนได้ ถ้าหากว่ามิได้มีสิ่งใดผิดปกติเกิดขึ้นในการซื้อ<br> <br><br>16. ข้อตกลงและเงื่อนไขการใช้เว็บไซต์<br><br>โปรแกรมแนะนำเพื่อนเพื่อรับเครดิตฟรีและโปรแกรมการรับเครดิตคืน รวมถึงโปรแกรมรับผลตอบแทนอื่นๆ ของเว็บไซต์ ขึ้นอยู่กับดุลพินิจของ บริษัท คอซซี่ดอทคอม จำกัด เท่านั้น บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลง ยกเลิกโปรแกรมทั้งเป็นการชั่วคราวหรือถาวรในทุกๆโปรแกรม ทั้งโปรแกรมแนะนำเพื่อนเพื่อรับเครดิตฟรีและโปรแกรมการรับเครดิตคืนหรือโปรแกรมรับผลตอบแทนอื่นๆ โดยไม่ต้องแจ้งสมาชิกล่วงหน้า<br>บริษัทฯ อาจทำการเพิกถอน จำกัด เปลี่ยนแปลงเครดิต เพิ่มหรือลดจำนวนเครดิตคืน ตามความเหมาะสมของแต่ละดีลที่สอดคล้องกับโปรแกรมการแนะนำเพื่อนเพื่อรับฟรีเครดิตและโปรแกรมการรับเครดิตคืน<br>การสมัครเป็นสมาชิก บริษัท ถือว่าท่านได้ยอมรับเงื่อนไขข้อตกลง ของโปรแกรมการแนะนำเพื่อนเพื่อรับฟรีเครดิต และการรับเครดิตคืน ซึ่งท่านหรือบุคคลที่สามไม่มีสิทธิ์เปลี่ยนแปลงหรือยกเลิกโปรแกรมดังกล่าวได้<br> </p><p>17. ความเป็นส่วนตัว<br><br>ในส่วนของบริการนำส่ง เราตระหนักดีถึงภาระหน้าที่ของเราในการรักษาข้อมูลความลับทั้งปวงของลูกค้า และนอกเหนือจากภาระหน้าที่รักษาความลับต่อลูกค้า เรายังปฏิบัติตามบทบัญญัติว่าด้วยข้อมูลส่วนตัว (Personal Data (Privacy) Ordinance) (\"บทบัญญัติ\") ตลอดเวลา ในการรวบรวม รักษา และใช้ข้อมูลส่วนตัวของลูกค้า โดยเฉพาะอย่างยิ่งเราได้ปฏิบัติตามหลักปฏิบัติดังต่อไปนี้ เว้นแต่ในกรณีที่ลูกค้าตกลงเป็นอย่างอื่นตามความเหมาะสม<br>1. การรวบรวมข้อมูลส่วนตัวจากลูกค้าจะเป็นไปเพื่อวัตถุประสงค์ในการจัดหาบริการโลจิสติกส์ หรือบริการที่เกี่ยวข้อง<br>2. ในทุกขั้นตอนการปฏิบัติจะมีการดำเนินการเพื่อให้แน่ใจว่าข้อมูลส่วนตัวของลูกค้ามีความถูกต้อง และจะไม่ถูกจัดเก็บข้อมูลไว้นานเกินความจำเป็น หรือจะถูกทำลายทิ้งตามระเบียบว่าด้วยระยะเวลาการเก็บรักษาข้อมูลภายในของเรา<br>3. ข้อมูลส่วนตัวจะไม่ถูกนำไปใช้เพื่อวัตถุประสงค์อื่นใดนอกเหนือไปจากวัตถุประสงค์ ณ เวลาที่รวบรวมข้อมูลหรือวัตถุประสงค์ที่เกี่ยวข้องโดยตรง<br>4. ข้อมูลส่วนตัวของลูกค้าจะได้รับการคุ้มครองจากการเข้าถึง การประมวลผล หรือการลบทิ้งที่เกิดขึ้นโดยไม่ได้รับอนุญาตหรือโดยบังเอิญ<br>5. ลูกค้ามีสิทธิแก้ไขข้อมูลส่วนตัวของตนซึ่งเราเก็บรักษาไว้ โดยเราจะดำเนินการกับคำร้องขอเข้าถึงหรือขอแก้ไขข้อมูลของลูกค้ารายนั้น ๆ ตามบทบัญญัติดังกล่าวข้างต้น<br><br>18. นโยบายการชำระเงิน<br><br>ชำระที่ที่ทำการ  <a href=\"http://www.cozxy.com/\"></a>บริษัท คอซซี่ดอทคอม จำกัด (เฉพาะกรุงเทพฯ และปริมณฑล)<br>กรุณาทำการติดต่อเพื่อชำระเงินภายใน 24 ชั่วโมงหลังทำการสั่งซื้อ หากไม่ชำระเงินภายในเวลาที่กำหนด ระบบจะทำการยกเลิกคำสั่งซื้อของท่านโดยอัตโนมัติ เวลาทำการ วันจันทร์ ถึง ศุกร์ เวลา 09.00 - 18.00 น.<br>จ่ายผ่าน ธนาคารต่างๆ<br>กรุณาชำระเงินภายใน 24 ชั่วโมงหลังทำการสั่งซื้อ หากไม่ชำระเงินภายในเวลาที่กำหนด ระบบจะทำการยกเลิกคำสั่งซื้อของท่านโดยอัตโนมัติ<br>จุดชำระเงินเทสโก้โลตัส และ ชำระผ่านเคาน์เตอร์เซอร์วิส<br>กรุณาชำระเงินภายใน 24 ชั่วโมงหลังทำการสั่งซื้อ หากไม่ชำระเงินภายในเวลาที่กำหนด ระบบจะทำการยกเลิกคำสั่งซื้อของท่านโดยอัตโนมัติ<br>บัตรเครดิต, ชำระเงินด้วยบัตรวีซ่า, เครดิต<br>ขอขอบคุณสำหรับการสั่งซื้อ เมื่อระบบกำลังดำเนินการแล้วเสร็จ ท่านจะได้รับคูปองภายใน 24 ชั่วโมง หากการชำระเงินไม่สำเร็จระบบจะยกเลิกคำสั่งซื้อโดยอัตโนมัติ<br><br>ข้อมูลส่วนตัวของลูกค้าถือเป็นความลับ และเราจะสามารถเปิดเผยข้อมูลส่วนตัวของลูกค้าได้เท่าที่บทบัญญัติอนุญาตไว้หรือตามที่กฎหมายกำหนดเท่านั้น</p>','','','',NULL,NULL,1,'2016-09-29 11:25:33','2016-09-29 11:37:00');

/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_group`;

CREATE TABLE `content_group` (
  `contentGroupId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contentGroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content_group` WRITE;
/*!40000 ALTER TABLE `content_group` DISABLE KEYS */;

INSERT INTO `content_group` (`contentGroupId`, `title`, `description`, `image`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'Banner','','',1,'2016-07-04 09:56:03','2016-07-04 09:56:03'),
	(2,'topOne','หน้า index   มี background \r\n','/images/ContentGroup/dcyBmhz73M.jpg',1,'2016-07-22 10:52:30','2016-07-22 13:48:41'),
	(3,'bottomIndex','หน้า index  เม้าส์ ชี้ที่ icon แล้วเปลี่ยน ข้อความ','',1,'2016-07-22 13:15:43','2016-07-22 13:49:00'),
	(4,'lastIndex','หน้า Index ส่วนล่างสุด','',1,'2016-07-22 13:49:39','2016-07-22 13:49:39'),
	(5,'HowWork','<p>How Cozxy Works</p>','',1,'2016-07-22 14:08:15','2016-09-27 15:45:34'),
	(6,'HowWork2','หน้า HowWork 2 collapse','',1,'2016-07-22 14:41:29','2016-07-22 14:41:29'),
	(7,'contactInfo','<p>หน้า How Cozxy work      contact Info</p>','',1,'2016-07-22 15:04:20','2016-09-27 15:45:59'),
	(8,'website','<p>หน้า How Cozxy work      website</p>','',1,'2016-07-22 15:11:43','2016-09-27 15:46:07'),
	(9,'logoImage','<p>รูปภาพส่วน footer</p>','/images/ContentGroup/nMWsxfnlCT.png',1,'2016-07-25 11:05:23','2016-09-20 10:57:06'),
	(10,'NEWS','ข่าว','',1,'2016-07-25 11:47:38','2016-07-25 13:04:54'),
	(11,'contactFooter','contact footer','',1,'2016-07-25 14:55:22','2016-07-25 14:55:22'),
	(12,'term','เงื่อนไขข้อตกลง','',1,'2016-07-25 16:07:31','2016-07-25 16:07:31');

/*!40000 ALTER TABLE `content_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table coupon
# ------------------------------------------------------------

DROP TABLE IF EXISTS `coupon`;

CREATE TABLE `coupon` (
  `couponId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `couponOwnerId` bigint(20) unsigned DEFAULT NULL,
  `noCoupon` tinyint(4) NOT NULL,
  `oneTimeUse` tinyint(4) NOT NULL DEFAULT '1',
  `orderSummaryToDiscount` decimal(15,2) DEFAULT NULL,
  `discountValue` decimal(15,2) DEFAULT NULL,
  `discountPercent` decimal(5,2) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`couponId`),
  KEY `fk_c_to_co_idx` (`couponOwnerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;

INSERT INTO `coupon` (`couponId`, `code`, `couponOwnerId`, `noCoupon`, `oneTimeUse`, `orderSummaryToDiscount`, `discountValue`, `discountPercent`, `startDate`, `endDate`, `image`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'SUMMER09WpAjA',1,127,1,1000.00,110.00,11.00,'2016-09-28 00:00:00','2016-11-30 00:00:00','/images/Coupon/_IiSHR2tey.jpg',1,'2016-09-28 09:14:28','2016-10-03 10:03:47'),
	(2,'DTAC001kCr6n',2,0,1,100.00,100.00,10.00,'2016-09-28 00:00:00','2016-11-30 00:00:00','/images/Coupon/rO-lwUIrHu.png',1,'2016-09-28 09:16:46','2016-10-26 10:03:00'),
	(3,'MXZZZXVSK_',3,127,1,1000.00,50.00,5.00,'2016-09-28 00:00:00','2016-11-30 00:00:00','/images/Coupon/Tz7kfqZCY6.jpg',1,'2016-09-28 09:26:23','2016-10-26 10:03:18'),
	(4,'KUNGSRI001rk6yD',4,127,1,2000.00,100.00,10.00,'2016-09-28 00:00:00','2016-11-30 00:00:00','/images/Coupon/iHPak2p9ec.jpg',1,'2016-09-28 09:29:11','2016-10-26 10:03:36');

/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table coupon_owner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `coupon_owner`;

CREATE TABLE `coupon_owner` (
  `couponOwnerId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`couponOwnerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `coupon_owner` WRITE;
/*!40000 ALTER TABLE `coupon_owner` DISABLE KEYS */;

INSERT INTO `coupon_owner` (`couponOwnerId`, `code`, `name`, `description`, `image`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'SUMMER09','Discount','<p>ddddddddddddddddddddddddddd</p>','/images/CouponOwner/lfc-UD3KoC.jpg',1,'2016-09-27 08:43:43','2016-10-03 09:55:02'),
	(2,'DTAC001','dtac discount xxx','','/images/CouponOwner/fgrp4pE_Mk.jpg',1,'2016-09-27 15:38:44','2016-09-28 09:30:51'),
	(3,'MXZZZ','Voucher','','/images/CouponOwner/kHwLTHJRTD.jpg',1,'2016-09-28 09:25:37','2016-09-28 09:25:37'),
	(4,'KUNGSRI001','KUNGSRI','','/images/CouponOwner/-OiXwNey6u.jpg',1,'2016-09-28 09:28:15','2016-09-28 09:28:15');

/*!40000 ALTER TABLE `coupon_owner` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table e_payment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `e_payment`;

CREATE TABLE `e_payment` (
  `ePaymentId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paymentMethodId` bigint(20) unsigned NOT NULL,
  `bankId` bigint(20) unsigned NOT NULL,
  `ePaymentTel` varchar(30) NOT NULL,
  `ePaymentMerchantId` varchar(50) NOT NULL,
  `ePaymentOrgId` varchar(50) NOT NULL,
  `ePaymentUrl` text NOT NULL,
  `ePaymentAccessKey` text NOT NULL,
  `ePaymentSecretKey` text NOT NULL,
  `ePaymentProfileId` varchar(50) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ePaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `e_payment` WRITE;
/*!40000 ALTER TABLE `e_payment` DISABLE KEYS */;

INSERT INTO `e_payment` (`ePaymentId`, `paymentMethodId`, `bankId`, `ePaymentTel`, `ePaymentMerchantId`, `ePaymentOrgId`, `ePaymentUrl`, `ePaymentAccessKey`, `ePaymentSecretKey`, `ePaymentProfileId`, `type`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,2,1,'02-938-3464','kr950211813','k8vif92e','https://secureacceptance.cybersource.com/pay','71fc36f1549d3551b2e863912a59ce4e','77f8a25a7aa34013bde83a41bd55190951e55c77b77748e1b155fd34fefe44923255ddde3f154a8797a70a1eb9ab3ecb2a74e5d8803249ecad13b51258c57d50140a9bd1cb654e0aa1c5a42066411621efb1dd1e0ae14d51868f6ea6d453afc9b1a77f6e1f314dfc978e2c960560c6d95be50018231f4620ae8812cf79ee8f7d','291F3EB0-68B9-4DE5-94B4-C8EACAF5A816',2,1,'2016-07-25 11:46:40','2016-07-25 11:58:10'),
	(2,2,1,'02-938-3464','kr950211813','1snn5n9w','https://testsecureacceptance.cybersource.com/pay','a618d2a279ed3399b84b0d8080169c9d','19c214b706374b349e64f1df7f5f0abff61e8498d5844787b02f61bf78dc24273a33ba8c924c409d84c87d506ef1834b083c52fba916486ebf210f6bf3edd21baa30f311edb8442fb782e52c5fb27fa0dbece61c86e144b09e5e004492e1ba248008215eedf54a7bb9498634a06d03ae3baf2b76d7ba4f9dbdb4dad4ddb36e88','4E7BEB74-DFF7-46F9-A83E-BEE15E9D6F36',1,1,'2016-08-15 11:54:10','2016-08-24 14:11:41');

/*!40000 ALTER TABLE `e_payment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table led
# ------------------------------------------------------------

DROP TABLE IF EXISTS `led`;

CREATE TABLE `led` (
  `ledId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL COMMENT 'code : ของกล่องไฟ ที่ติดแต่ shelf',
  `ip` varchar(45) NOT NULL COMMENT 'code : ของกล่องไฟ ที่ติดแต่ shelf',
  `slot` varchar(45) DEFAULT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ledId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `led` WRITE;
/*!40000 ALTER TABLE `led` DISABLE KEYS */;

INSERT INTO `led` (`ledId`, `code`, `ip`, `slot`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'LED1','192.168.101.43','R2C1S1',1,'2016-09-14 14:38:46','2016-09-14 14:38:46'),
	(2,'LED2','192.168.101.45','R1C1S2',1,'2016-09-14 14:39:17','2016-09-14 14:39:17'),
	(5,'LED3','192.168.101.47','R1C1S3',1,'2016-09-16 10:57:46','2016-09-16 10:57:46'),
	(6,'SHELF1','192.168.101.44','R1',1,'2016-09-16 14:26:18','2016-09-16 14:26:18'),
	(9,'Led20','192.168.100.12','R1C2S2',0,'2016-09-19 08:54:30','2016-09-19 08:54:30'),
	(10,'SHELF2','192.168.101.46','R2',1,'2016-09-19 10:19:56','2016-09-19 10:19:56'),
	(11,'Led 2','192.168.100.19','R2C1S3',0,'2016-09-19 10:19:56','2016-09-19 10:19:56'),
	(12,'Led 3','192.168.100.20','R2C2S4',0,'2016-09-19 10:19:56','2016-09-19 10:19:56'),
	(25,'bq222','192.168.1.111','R2C1S1',0,'2016-09-19 12:56:32','2016-09-19 12:56:32'),
	(42,'Led4','192.108.100.253','R2C2S2',0,'2016-09-19 13:56:35','2016-09-19 13:56:35'),
	(43,'Led5','192.108.100.252','R3C1S3',0,'2016-09-19 14:11:29','2016-09-19 14:11:29'),
	(44,'Led1','192.168.100.13',NULL,0,'2016-09-21 08:37:39','2016-09-21 08:37:39'),
	(45,'Led2','192.168.100.14',NULL,0,'2016-09-21 08:37:39','2016-09-21 08:37:39'),
	(46,'Led1','192.167.120.3',NULL,0,'2016-10-13 15:52:11','2016-10-13 15:52:11'),
	(47,'Led2','192.167.120.4',NULL,0,'2016-10-13 15:52:11','2016-10-13 15:52:11');

/*!40000 ALTER TABLE `led` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table led_color
# ------------------------------------------------------------

DROP TABLE IF EXISTS `led_color`;

CREATE TABLE `led_color` (
  `ledColorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ledColor` bigint(20) NOT NULL,
  `htmlCode` varchar(45) NOT NULL,
  `r` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `status` tinyint(6) DEFAULT '0',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ledColorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `led_color` WRITE;
/*!40000 ALTER TABLE `led_color` DISABLE KEYS */;

INSERT INTO `led_color` (`ledColorId`, `ledColor`, `htmlCode`, `r`, `g`, `b`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,'#f51e50',30,0,0,0,'2016-12-02 14:56:47','2016-09-21 13:10:59'),
	(2,2,'#f5ed1e',20,20,0,0,NULL,'2016-09-21 13:10:59'),
	(3,3,'#2c9bd5',0,0,30,0,NULL,'2016-09-21 13:10:59'),
	(4,4,'#d32cd5',20,0,10,0,NULL,'2016-09-21 13:10:59'),
	(5,5,'#2cd540',0,30,0,0,NULL,'2016-09-21 13:10:59'),
	(6,6,'#e7963f',20,8,0,0,NULL,'2016-09-21 13:10:59'),
	(7,7,'#3fe7e5',0,20,20,0,NULL,'2016-09-21 13:10:59'),
	(8,8,'#f8ebfb',30,30,30,0,NULL,'2016-09-21 13:10:59');

/*!40000 ALTER TABLE `led_color` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table led_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `led_item`;

CREATE TABLE `led_item` (
  `ledItemId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ledId` bigint(20) NOT NULL,
  `color` tinyint(6) DEFAULT NULL,
  `sortOrder` tinyint(6) DEFAULT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ledItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `led_item` WRITE;
/*!40000 ALTER TABLE `led_item` DISABLE KEYS */;

INSERT INTO `led_item` (`ledItemId`, `ledId`, `color`, `sortOrder`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(23,2,2,2,0,'2016-09-15 14:01:23','2016-09-15 14:04:06'),
	(24,2,1,1,0,'2016-09-15 14:03:04','2016-09-15 15:17:13'),
	(25,2,3,3,0,'2016-09-15 14:03:12','2016-09-16 16:45:26'),
	(32,1,2,2,0,'2016-09-15 14:37:23','2016-09-16 11:00:24'),
	(33,1,1,1,0,'2016-09-15 14:37:42','2016-09-15 14:38:11'),
	(43,3,1,1,0,'2016-09-15 15:12:29','2016-09-15 15:12:29'),
	(45,3,4,3,0,'2016-09-15 15:12:43','2016-09-15 15:12:43'),
	(46,3,3,4,0,'2016-09-15 15:12:49','2016-09-15 15:12:49'),
	(47,3,5,5,0,'2016-09-15 15:12:54','2016-09-15 15:13:36'),
	(48,3,2,2,0,'2016-09-15 15:13:11','2016-09-15 15:13:45'),
	(50,1,3,3,0,'2016-09-16 10:59:43','2016-09-16 15:52:43'),
	(51,1,4,4,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(60,6,1,1,0,'2016-09-16 15:40:35','2016-09-16 15:41:59'),
	(61,6,2,2,0,'2016-09-16 15:40:44','2016-09-16 15:40:44'),
	(62,6,3,3,0,'2016-09-16 15:40:52','2016-09-16 15:40:52'),
	(63,6,4,4,0,'2016-09-16 15:40:56','2016-09-16 15:40:56'),
	(64,6,5,5,0,'2016-09-16 15:41:00','2016-09-16 15:41:00'),
	(65,7,1,1,0,'2016-09-16 15:55:28','2016-09-16 15:56:25'),
	(66,7,3,4,0,'2016-09-16 15:55:45','2016-09-16 15:58:17'),
	(67,7,2,3,0,'2016-09-16 15:56:05','2016-09-16 15:56:05'),
	(70,7,4,4,0,'2016-09-16 15:58:02','2016-09-16 15:58:02'),
	(72,7,5,5,0,'2016-09-16 15:58:24','2016-09-16 15:58:24'),
	(73,7,5,5,0,'2016-09-16 15:58:29','2016-09-16 15:58:29'),
	(75,1,5,5,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(77,2,4,4,0,'2016-09-16 16:44:58','2016-09-19 10:05:41'),
	(80,9,1,1,0,'0000-00-00 00:00:00','2016-09-19 10:21:13'),
	(81,9,2,2,0,'0000-00-00 00:00:00','2016-09-19 10:21:16'),
	(82,9,3,3,0,'0000-00-00 00:00:00','2016-09-19 10:21:19'),
	(83,9,4,4,0,'0000-00-00 00:00:00','2016-09-19 10:21:22'),
	(84,9,5,5,0,'0000-00-00 00:00:00','2016-09-19 10:21:25'),
	(85,5,1,1,0,'2016-09-19 10:06:14','2016-09-19 10:06:14'),
	(86,5,2,2,0,'2016-09-19 10:06:19','2016-09-19 10:06:19'),
	(87,5,3,3,0,'2016-09-19 10:06:24','2016-09-19 10:06:24'),
	(88,5,4,4,0,'2016-09-19 10:06:31','2016-09-19 10:06:31'),
	(89,5,5,5,0,'2016-09-19 10:06:37','2016-09-19 10:06:37'),
	(95,11,1,1,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(96,11,2,2,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(97,11,3,3,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(98,11,4,4,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(99,11,5,5,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(100,12,1,1,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(101,12,2,2,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(102,12,3,3,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(103,12,4,4,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(104,12,5,5,0,'0000-00-00 00:00:00','2016-09-19 10:19:56'),
	(165,25,4,1,0,'2016-09-19 12:56:47','2016-09-19 12:56:47'),
	(166,25,5,2,0,'2016-09-19 12:56:52','2016-09-19 12:56:52'),
	(247,42,1,1,0,'0000-00-00 00:00:00','2016-09-19 13:56:35'),
	(248,42,2,2,0,'0000-00-00 00:00:00','2016-09-19 13:56:35'),
	(249,42,3,3,0,'0000-00-00 00:00:00','2016-09-19 13:56:35'),
	(250,42,4,4,0,'0000-00-00 00:00:00','2016-09-19 13:56:35'),
	(251,42,5,5,0,'0000-00-00 00:00:00','2016-09-19 13:56:35'),
	(252,43,1,1,0,'0000-00-00 00:00:00','2016-09-19 14:11:30'),
	(253,43,2,2,0,'0000-00-00 00:00:00','2016-09-19 14:11:30'),
	(254,43,3,3,0,'0000-00-00 00:00:00','2016-09-19 14:11:30'),
	(255,43,4,4,0,'0000-00-00 00:00:00','2016-09-19 14:24:54'),
	(257,43,5,5,0,'2016-09-19 14:26:01','2016-09-19 14:26:01'),
	(258,44,1,1,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(259,44,2,2,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(260,44,3,3,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(261,44,4,4,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(262,44,5,5,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(263,45,1,1,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(264,45,2,2,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(265,45,3,3,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(266,45,4,4,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(267,45,5,5,0,'0000-00-00 00:00:00','2016-09-21 08:37:39'),
	(268,46,1,1,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(269,46,2,2,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(270,46,3,3,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(271,46,4,4,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(272,46,5,5,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(273,47,1,1,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(274,47,2,2,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(275,47,3,3,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(276,47,4,4,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(277,47,5,5,0,'0000-00-00 00:00:00','2016-10-13 15:52:11'),
	(278,1,6,6,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(279,1,7,7,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(280,1,8,8,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(281,2,5,5,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(282,2,6,6,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(283,2,7,7,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(284,2,8,8,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(285,5,6,6,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(286,5,7,7,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(287,5,8,8,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(288,6,6,6,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(289,6,7,7,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(290,6,8,8,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(291,10,1,1,0,'2016-09-16 15:40:35','2016-09-16 15:41:59'),
	(292,10,2,2,0,'2016-09-16 15:40:44','2016-09-16 15:40:44'),
	(293,10,3,3,0,'2016-09-16 15:40:52','2016-09-16 15:40:52'),
	(294,10,4,4,0,'2016-09-16 15:40:56','2016-09-16 15:40:56'),
	(295,10,5,5,0,'2016-09-16 15:41:00','2016-09-16 15:41:00'),
	(296,10,6,6,0,'2016-09-16 11:00:20','2016-09-19 08:14:35'),
	(297,10,7,7,0,'2016-09-16 15:59:24','2016-09-16 15:59:24'),
	(298,10,8,8,0,'2016-09-16 15:59:24','2016-09-16 15:59:24');

/*!40000 ALTER TABLE `led_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table level
# ------------------------------------------------------------

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `levelId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`levelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `menuId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `levelId` varchar(100) DEFAULT NULL,
  `user_group_Id` varchar(200) NOT NULL DEFAULT '[]',
  `parent_id` bigint(20) unsigned DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `parents` int(11) unsigned DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`menuId`, `levelId`, `user_group_Id`, `parent_id`, `name`, `desc`, `link`, `parents`, `sort`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(10,NULL,'[25,26,31,34]',0,'Dashboard','','dashboard',NULL,NULL,1,'2016-11-06 13:42:22','2016-11-09 13:13:03'),
	(11,NULL,'[25,26,31]',0,'จัดการข้อมูล User',NULL,'#',NULL,NULL,1,'2016-11-06 13:48:13','2016-11-06 06:48:13'),
	(12,NULL,'[31]',11,'สมาชิก',NULL,'user/user',NULL,NULL,1,'2016-11-06 13:51:54','2016-11-06 06:51:54'),
	(13,NULL,'[31]',0,'จัดการรายการสั่งซื้อสินค้า  ',NULL,'#',NULL,NULL,1,'2016-11-06 13:52:21','2016-11-06 06:52:21'),
	(14,NULL,'[31]',13,'Order',NULL,'order/order',NULL,NULL,1,'2016-11-06 13:55:22','2016-11-06 06:55:22'),
	(15,NULL,'[31]',0,'Store',NULL,'#',NULL,NULL,1,'2016-11-06 13:57:01','2016-11-06 06:57:01'),
	(16,NULL,'[31]',0,'LED Control',NULL,'#',NULL,NULL,1,'2016-11-06 14:08:05','2016-11-06 07:08:05'),
	(17,NULL,'[31]',16,'Leds',NULL,'led/led',NULL,NULL,1,'2016-11-06 14:08:27','2016-11-06 07:08:27'),
	(18,NULL,'[31]',15,'Virtual',NULL,'store/virtual',NULL,NULL,1,'2016-11-06 14:12:36','2016-11-06 07:12:36'),
	(19,NULL,'[31]',0,'Picking Points',NULL,'#',NULL,NULL,1,'2016-11-06 14:13:04','2016-11-06 07:13:04'),
	(20,NULL,'[31]',19,'Picking',NULL,'picking/picking',NULL,NULL,1,'2016-11-06 14:13:57','2016-11-06 07:13:57'),
	(21,NULL,'[31]',15,'Import Product',NULL,'store/store-product-group',NULL,NULL,1,'2016-11-06 14:17:25','2016-11-06 07:17:25'),
	(22,NULL,'[31]',15,'จัดเรียง',NULL,'store/store-product/choose-po',NULL,NULL,1,'2016-11-06 14:17:53','2016-11-06 07:17:53'),
	(23,NULL,'[31]',15,'Picking',NULL,'store/picking',NULL,NULL,1,'2016-11-06 14:18:28','2016-11-06 07:18:28'),
	(24,NULL,'[31]',15,'Packing',NULL,'store/packing',NULL,NULL,1,'2016-11-06 14:18:58','2016-11-06 07:18:58'),
	(25,NULL,'[31,32]',15,'Shipping',NULL,'store/shipping',NULL,NULL,1,'2016-11-06 14:19:21','2016-11-06 07:19:21'),
	(26,NULL,'[31,33]',15,'Lockers',NULL,'lockers/lockers',NULL,NULL,1,'2016-11-06 14:20:18','2016-11-06 07:20:18'),
	(27,NULL,'[31]',15,'Location',NULL,'#',NULL,NULL,1,'2016-11-06 14:20:47','2016-11-06 07:20:47'),
	(28,NULL,'[31]',27,'Region',NULL,'store/region',NULL,NULL,1,'2016-11-06 14:21:28','2016-11-06 07:21:28'),
	(29,NULL,'[31]',0,'Supplier ','supplier เก็บข้อมูล ผู้แทนจำหน่าย','#',NULL,NULL,1,'2016-11-06 14:34:34','2016-11-06 07:34:34'),
	(30,NULL,'[31,34]',0,'Product  ','เก็บรายการเกี่ยวกับสินค้าทั้งหมด','#',NULL,NULL,1,'2016-11-06 21:53:18','2016-11-07 14:58:53'),
	(31,NULL,'[31]',30,'Brands','เก็บรายละเอียดแบรนด์สินค้าทั้งหมด','product/brand',NULL,NULL,1,'2016-11-07 13:04:06','2016-11-07 06:04:06'),
	(32,NULL,'[31,34]',30,'Show Category','เก็บรายละเอียดหมวดหมู่สินค้าทั้งหมด มี 2 แบบ\r\n1. Save Category คือ ??\r\n2. Popular Category คือ ??','product/show-category',NULL,NULL,1,'2016-11-07 13:07:12','2016-11-07 06:10:22'),
	(33,NULL,'[31]',30,'Categories','','product/category',NULL,NULL,1,'2016-11-07 15:50:41','2016-11-07 08:50:41'),
	(34,NULL,'[31]',30,'Product Groups','','product/product-group',NULL,NULL,1,'2016-11-07 15:51:28','2016-11-07 08:51:28'),
	(35,NULL,'[31]',30,'Product Price Match','','product/product-price-match-group',NULL,NULL,1,'2016-11-07 15:52:03','2016-11-07 08:52:03'),
	(36,NULL,'[31]',30,'Products List','','product/product',NULL,NULL,1,'2016-11-07 15:52:32','2016-11-07 08:52:32'),
	(37,NULL,'[31]',30,'Coupon Owners','','product/coupon-owner',NULL,NULL,1,'2016-11-07 15:52:58','2016-11-07 08:52:58'),
	(38,NULL,'[31]',30,'Units','','product/unit',NULL,NULL,1,'2016-11-07 15:53:40','2016-11-07 08:53:40'),
	(39,NULL,'[31]',0,'Product Hots','','#',NULL,NULL,1,'2016-11-07 15:54:18','2016-11-07 08:54:34'),
	(40,NULL,'[31]',39,'Product Hots List','','product/product-hot',NULL,NULL,1,'2016-11-07 15:56:11','2016-11-07 08:56:11'),
	(41,NULL,'[31]',0,'Package','','#',NULL,NULL,1,'2016-11-07 15:57:27','2016-11-07 08:57:27'),
	(42,NULL,'[31]',41,'Package List','','shipping/package',NULL,NULL,1,'2016-11-07 15:58:04','2016-11-07 08:58:04'),
	(43,NULL,'[31]',41,'Package Types','','shipping/package-type',NULL,NULL,1,'2016-11-07 15:58:37','2016-11-07 09:12:29'),
	(44,NULL,'[31]',0,'รายงาน','','#',NULL,NULL,1,'2016-11-07 15:59:56','2016-11-14 14:14:24'),
	(45,NULL,'[31]',44,'รายงานยอดขาย','','report/report',NULL,NULL,1,'2016-11-07 16:00:24','2016-11-14 14:15:55'),
	(46,NULL,'[31]',44,'รายงานสินค้ายอดนิยม','','report/popular-report',NULL,NULL,1,'2016-11-07 16:00:56','2016-11-14 14:17:48'),
	(47,NULL,'[31]',44,'รายงานวันเกิดลูกค้า','','report/birthday-report',NULL,NULL,1,'2016-11-07 16:01:24','2016-11-07 09:01:24'),
	(48,NULL,'[31]',44,'รายงานจุดส่งสินค้ายอดนิยม','','report/picking-point-report',NULL,NULL,1,'2016-11-07 16:01:53','2016-11-07 09:01:53'),
	(49,NULL,'[31]',44,'รายงานลูกค้าดีเด่น','','report/top-customer-report',NULL,NULL,1,'2016-11-07 16:02:19','2016-11-07 09:02:19'),
	(50,NULL,'[31]',44,'รายงานยอดสินค้าขายดี','','report/best-seller-report',NULL,NULL,1,'2016-11-07 16:02:48','2016-11-07 09:02:48'),
	(51,NULL,'[31]',44,'รายงานสินค้าที่ต้องส่งล่วงหน้า','','report/future-plan-report',NULL,NULL,1,'2016-11-07 16:03:55','2016-11-07 09:03:55'),
	(52,NULL,'[31]',0,'จัดการข้อมูลหลัก  ','','#',NULL,NULL,1,'2016-11-07 16:04:30','2016-11-07 09:04:30'),
	(53,NULL,'[31]',52,'Content Groups','','content/content-group',NULL,NULL,1,'2016-11-07 16:04:59','2016-11-07 09:04:59'),
	(54,NULL,'[31,34]',0,'Payment','','#',NULL,NULL,1,'2016-11-07 16:05:23','2016-11-07 09:08:12'),
	(55,NULL,'[31,34]',54,'Payment Methods','','payment/payment-method',NULL,NULL,1,'2016-11-07 16:05:48','2016-11-07 14:37:36'),
	(56,NULL,'[31,34]',54,'Banks','','#',NULL,NULL,1,'2016-11-07 16:06:13','2016-11-07 14:58:29'),
	(57,NULL,'[31,34]',29,'Supplier','','supplier/supplier',NULL,NULL,1,'2016-11-07 19:21:42','2016-11-07 14:36:29'),
	(58,NULL,'[31]',15,'Store List','','store/store',NULL,NULL,1,'2016-11-07 20:11:52','2016-11-07 13:11:52'),
	(59,NULL,'[31,34]',11,'ตั้งค่า สมาชิก','','management/settings',NULL,NULL,1,'2016-11-08 15:05:48','2016-11-08 15:05:48'),
	(60,NULL,'[31]',16,'Led Colors',NULL,'led/led/index-color',NULL,NULL,1,NULL,'2016-11-29 15:51:20'),
	(61,NULL,'[31,34]',13,'Create Purchase Order (PO)',NULL,'order/order/purchase-order',NULL,NULL,1,NULL,'2016-12-19 14:34:56');

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notiId` bigint(20) NOT NULL AUTO_INCREMENT,
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createBy` varchar(45) DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notiId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`notiId`, `id`, `userId`, `title`, `type`, `status`, `createBy`, `createDateTime`, `updateDateTime`)
VALUES
	(4,153,12,'แจ้งเตือนให้ Suppliers ปรับปรุงเนื้อแล้ว ','1',1,'1','2017-01-05 10:07:44','2017-01-05 10:07:44'),
	(5,156,10,'แจ้งเตือนให้ Suppliers ปรับปรุงเนื้อแล้ว ','1',1,'1','2017-01-04 10:55:15','2017-01-05 10:55:15'),
	(6,157,10,'แจ้งเตือนให้ Suppliers ปรับปรุงเนื้อแล้ว ','1',1,'1','2017-01-03 10:55:17','2017-01-05 10:55:17'),
	(7,150,9,'แจ้งเตือนให้ Suppliers ปรับปรุงเนื้อแล้ว ','1',1,'1','2017-01-05 12:55:53','2017-01-05 12:55:53'),
	(8,151,10,'แจ้งเตือนให้ Suppliers ปรับปรุงเนื้อแล้ว ','1',1,'1','2017-01-05 16:25:04','2017-01-05 16:25:04');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `orderId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `pickingId` bigint(20) DEFAULT NULL,
  `token` text,
  `orderNo` varchar(45) DEFAULT NULL,
  `invoiceNo` varchar(45) DEFAULT NULL,
  `totalExVat` decimal(15,2) DEFAULT NULL,
  `vat` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `grandTotal` decimal(15,2) DEFAULT NULL,
  `shippingRate` decimal(15,2) DEFAULT NULL,
  `summary` decimal(15,2) DEFAULT NULL,
  `sendDate` datetime DEFAULT NULL,
  `billingFirstname` varchar(200) DEFAULT NULL,
  `billingLastname` varchar(200) DEFAULT NULL,
  `billingCompany` varchar(200) DEFAULT NULL,
  `billingTax` varchar(45) DEFAULT NULL,
  `billingAddress` text,
  `billingCountryId` varchar(3) DEFAULT NULL,
  `billingProvinceId` bigint(20) unsigned DEFAULT NULL,
  `billingAmphurId` bigint(20) unsigned DEFAULT NULL,
  `billingDistrictId` varchar(45) DEFAULT NULL,
  `billingZipcode` varchar(10) DEFAULT NULL,
  `billingTel` varchar(45) DEFAULT NULL,
  `shippingFirstname` varchar(200) DEFAULT NULL,
  `shippingLastname` varchar(200) DEFAULT NULL,
  `shippingCompany` varchar(200) DEFAULT NULL,
  `shippingTax` varchar(45) DEFAULT NULL,
  `shippingAddress` text,
  `shippingCountryId` varchar(3) DEFAULT NULL,
  `shippingProvinceId` bigint(20) unsigned DEFAULT NULL,
  `shippingAmphurId` bigint(20) unsigned DEFAULT NULL,
  `shippingDistrictId` varchar(45) DEFAULT NULL,
  `shippingZipcode` varchar(10) DEFAULT NULL,
  `shippingTel` varchar(45) DEFAULT NULL,
  `paymentType` tinyint(4) NOT NULL,
  `couponId` bigint(20) DEFAULT NULL,
  `checkStep` tinyint(4) NOT NULL DEFAULT '0',
  `note` text,
  `paymentDateTime` datetime DEFAULT NULL,
  `isSlowest` tinyint(4) NOT NULL DEFAULT '0',
  `color` bigint(20) DEFAULT '0',
  `pickerId` tinyint(4) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL COMMENT 'รหัสยืนยันตัวตน',
  `otp` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่านสำหรับเปิดตู้',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'status 0 : "ตระกร้าสินค้า",\nstatus 1 :  "ลงทะเบียนผู้ใช้แล้ว",\nstatus 2 :''รอการชำระเงิน'',\nstatus 3 : ''ชำระบัตรเครดิตไม่สำเร็จ'',\nstatus 4 : ''ยืนยันชำระเงิน'',\nstatus 5 : ''ชำระบัตรเครดิตสำเร็จ'',\nstatus 7 : ''การเงินตรวจสอบแล้ว'',\nstatus 13 : แพ็คเสร็จแล้ว\nstatus 100 : ลูกค้ารับของแล้ว\nstatus 8 : ''การเงินส่งกลับ'',\nstatus 9 : ''กำลังจัดส่ง'',\nstatus 10 : ''จัดส่งแล้ว'',\nstatus 11 : กำลังหยิบ\nstatus 12 : หยิบเสร็จแล้ว\nstatus 13 : แพ๊กเสร็จแล้ว\nstatus 14 : กำลังจะส่ง\nstatus 15 : นำจ่าย\nstatus 16 : ลูกค้ารับแล้ว\nstatus 17 : ลูกค',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `fk_or_to_u_idx` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;

INSERT INTO `order` (`orderId`, `userId`, `pickingId`, `token`, `orderNo`, `invoiceNo`, `totalExVat`, `vat`, `total`, `discount`, `grandTotal`, `shippingRate`, `summary`, `sendDate`, `billingFirstname`, `billingLastname`, `billingCompany`, `billingTax`, `billingAddress`, `billingCountryId`, `billingProvinceId`, `billingAmphurId`, `billingDistrictId`, `billingZipcode`, `billingTel`, `shippingFirstname`, `shippingLastname`, `shippingCompany`, `shippingTax`, `shippingAddress`, `shippingCountryId`, `shippingProvinceId`, `shippingAmphurId`, `shippingDistrictId`, `shippingZipcode`, `shippingTel`, `paymentType`, `couponId`, `checkStep`, `note`, `paymentDateTime`, `isSlowest`, `color`, `pickerId`, `password`, `otp`, `status`, `createDateTime`, `updateDateTime`, `email`)
VALUES
	(70,5,13,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW','OD201611-0000023','IV2016110000022',18.23,1.37,19.60,NULL,19.60,0.00,19.60,NULL,NULL,NULL,'ขวัญข้าว จำกัด','1234567890123','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,'182','10900','1234567890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2016-12-22 11:49:37',0,NULL,NULL,NULL,NULL,5,'2016-12-14 09:36:39','2016-12-27 15:12:21',NULL),
	(71,8,13,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW','OD201611-0000024','IV2016110000024',36.83,2.77,39.60,NULL,39.60,0.00,39.60,NULL,NULL,NULL,'ขวัญข้าว จำกัด','1234567890123','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,'182','10900','1234567890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2016-12-22 11:49:37',0,NULL,NULL,NULL,NULL,5,'2016-12-14 10:27:48','2016-12-27 15:12:21',NULL),
	(78,5,13,'qGWcnxtwemrMGRLKGp7ToZLl79CDoVEP','OD201612-0000025','IV2016120000025',37.20,2.80,40.00,NULL,40.00,0.00,40.00,NULL,NULL,NULL,'ขวัญข้าว จำกัด','1234567890123','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,'182','10900','1234567890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2016-12-23 15:06:04',0,NULL,NULL,NULL,NULL,5,'2016-12-23 14:48:42','2016-12-27 15:12:21',NULL),
	(79,1,9,'4nruAaq-Ygm40mjV909b7Vz5KO8af0XN','OD201701-0000033','IV2017010000031',18.60,1.40,20.00,NULL,20.00,0.00,20.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 13:45:20',0,0,NULL,NULL,NULL,5,'2016-12-23 14:54:42','2017-01-09 13:37:15',NULL),
	(81,5,14,'eC5GAIMXZXqliq4jIPe3Lb8szx7faN38','OD201612-0000026',NULL,18.60,1.40,20.00,NULL,20.00,0.00,20.00,NULL,NULL,NULL,'ขวัญข้าว จำกัด','1234567890123','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,'182','10900','1234567890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,3,'2016-12-23 15:09:52','2016-12-23 15:11:35',NULL),
	(82,2,9,'duOr8fh4styue8FuVnYSM7ixvQJvwL1d','OD201612-0000027',NULL,18.60,1.40,20.00,NULL,20.00,0.00,20.00,NULL,NULL,NULL,'','','เลขที่ 1 ชั้น 7 อาคารเกล้าพูลทรัพย์ ','THA',2523,79704,'182','10900','0836134241',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,3,'2016-12-23 15:37:23','2016-12-23 15:38:06',NULL),
	(83,5,13,'nP7NC_nXIoqFnD2dAn3xuklIMh2uFwog','OD201612-0000028','IV2016120000026',74.40,5.60,80.00,NULL,80.00,0.00,80.00,NULL,NULL,NULL,'aaa bbb ccc','','1 abc defg','THA',2523,79704,'182','10900','123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2016-12-27 09:19:40',0,0,NULL,NULL,NULL,5,'2016-12-26 15:00:29','2016-12-27 15:12:22',NULL),
	(85,5,13,'BxtUFeovAK9lHuusA161OsXtoKwudxzL','OD201612-0000029','IV2016120000027',660.30,49.70,710.00,NULL,710.00,0.00,710.00,NULL,NULL,NULL,'aaa bbb ccc','','1 abc defg','THA',2523,79704,'182','10900','123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2016-12-28 13:56:12',0,0,NULL,NULL,NULL,5,'2016-12-28 13:52:28','2016-12-28 13:55:08',NULL),
	(86,5,13,'BxtUFeovAK9lHuusA161OsXtoKwudxzL','OD201701-0000030','IV2017010000028',1980.90,149.10,2130.00,NULL,2130.00,0.00,2130.00,NULL,NULL,NULL,'aaa bbb ccc','','1 abc defg','THA',2523,79704,'182','10900','123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-04 09:27:17',0,0,NULL,NULL,NULL,5,'2016-12-28 13:59:20','2017-01-04 09:26:12',NULL),
	(87,5,14,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy','OD201701-0000031','IV2017010000029',660.30,49.70,710.00,NULL,710.00,0.00,710.00,NULL,NULL,NULL,'aaa bbb ccc co.,ltd  สำนักงานใหญ่ ','1234567890123','เลขที่ 1 ซอยลาดพร้าว 1 ถ.ลาดพร้าว','THA',2523,79704,'182','10900','123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-04 09:55:06',0,0,NULL,NULL,NULL,5,'2017-01-04 09:42:29','2017-01-04 09:42:48',NULL),
	(88,5,13,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy','OD201701-0000032','IV2017010000030',1390.35,104.65,1495.00,NULL,1495.00,0.00,1495.00,NULL,NULL,NULL,'','1234567890124','1 ซอยลาดพร้าว19 ถนนลาดพร้าว','THA',2523,79704,'182','10900','1234567890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-04 10:18:41',0,0,NULL,NULL,NULL,5,'2017-01-04 10:09:16','2017-01-04 10:11:33',NULL),
	(89,5,NULL,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy',NULL,NULL,0.00,0.00,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,0,'2017-01-04 10:21:36','2017-01-04 10:21:36',NULL),
	(90,1,11,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000034','IV2017010000032',1395.00,105.00,1500.00,NULL,1500.00,0.00,1500.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 14:18:10',0,0,NULL,NULL,NULL,5,'2017-01-09 14:15:24','2017-01-09 14:16:12',NULL),
	(91,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000035','IV2017010000033',2055.30,154.70,2210.00,NULL,2210.00,0.00,2210.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 14:28:37',0,0,NULL,NULL,NULL,5,'2017-01-09 14:18:51','2017-01-09 14:27:56',NULL),
	(92,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000036','IV2017010000034',3785.10,284.90,4070.00,NULL,4070.00,0.00,4070.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 14:33:54',0,0,NULL,NULL,NULL,5,'2017-01-09 14:32:27','2017-01-09 14:33:16',NULL),
	(93,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000037','IV2017010000037',3162.00,238.00,3400.00,NULL,3400.00,0.00,3400.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-11 15:57:48',0,0,NULL,NULL,NULL,5,'2017-01-09 15:08:43','2017-01-09 15:08:59',NULL),
	(94,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000038','IV2017010000035',3162.00,238.00,3400.00,NULL,3400.00,0.00,3400.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 15:13:58',0,0,NULL,NULL,NULL,5,'2017-01-09 15:12:06','2017-01-09 15:12:42',NULL),
	(95,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000039','IV2017010000036',4557.00,343.00,4900.00,NULL,4900.00,0.00,4900.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,'2017-01-09 15:19:05',0,0,NULL,NULL,NULL,5,'2017-01-09 15:16:54','2017-01-09 15:18:20',NULL),
	(96,1,9,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81','OD201701-0000040',NULL,1767.00,133.00,1900.00,NULL,1900.00,0.00,1900.00,NULL,NULL,NULL,'xx','222','xxx','THA',2523,79675,'1','222','06165398899',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,0,NULL,NULL,0,0,NULL,NULL,NULL,3,'2017-01-09 16:09:36','2017-01-09 16:09:49',NULL);

/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_item`;

CREATE TABLE `order_item` (
  `orderItemId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `productSuppId` bigint(20) unsigned DEFAULT NULL,
  `productGroupId` bigint(20) unsigned DEFAULT NULL,
  `brandId` bigint(20) unsigned DEFAULT NULL,
  `categoryId` bigint(20) unsigned DEFAULT NULL,
  `priceOnePiece` decimal(15,2) NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `subTotal` decimal(15,2) DEFAULT NULL,
  `discountValue` decimal(15,2) DEFAULT NULL,
  `shippingDiscountValue` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `sendDate` tinyint(4) DEFAULT NULL,
  `sendDateTime` datetime DEFAULT NULL,
  `firstTimeSendDate` tinyint(4) DEFAULT NULL,
  `pickerId` bigint(20) DEFAULT NULL,
  `color` bigint(20) DEFAULT NULL,
  `bagNo` varchar(20) DEFAULT NULL COMMENT 'หมายเลขถุงที่ได้จากตอน packing',
  `supplierId` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderItemId`),
  KEY `fk_oi_to_o_idx` (`orderId`),
  KEY `fk_oi_to_p_idx` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;

INSERT INTO `order_item` (`orderItemId`, `orderId`, `productId`, `productSuppId`, `productGroupId`, `brandId`, `categoryId`, `priceOnePiece`, `quantity`, `price`, `subTotal`, `discountValue`, `shippingDiscountValue`, `total`, `sendDate`, `sendDateTime`, `firstTimeSendDate`, `pickerId`, `color`, `bagNo`, `supplierId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(275,71,83,147,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.40,39.60,1,'2016-12-25 00:00:00',1,NULL,NULL,NULL,10,1,'2016-12-20 14:32:33','2016-12-23 09:20:11'),
	(276,70,83,147,NULL,NULL,NULL,20.00,1.00,20.00,20.00,0.00,0.40,19.60,1,'2016-12-25 00:00:00',1,NULL,NULL,NULL,10,1,'2016-12-20 14:38:53','2016-12-23 10:00:58'),
	(288,78,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2016-12-25 00:00:00',1,NULL,NULL,NULL,9,1,'2016-12-23 14:56:02','2016-12-26 14:16:46'),
	(289,79,84,146,NULL,NULL,NULL,20.00,1.00,20.00,20.00,0.00,0.00,20.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2016-12-23 14:54:42','2016-12-23 14:54:42'),
	(291,81,84,146,NULL,NULL,NULL,20.00,1.00,20.00,20.00,0.00,0.00,20.00,1,NULL,1,NULL,NULL,NULL,9,1,'2016-12-23 15:09:52','2016-12-23 15:09:52'),
	(292,82,84,146,NULL,NULL,NULL,20.00,1.00,20.00,20.00,0.00,0.00,20.00,1,NULL,1,NULL,NULL,NULL,9,1,'2016-12-23 15:37:23','2016-12-23 15:37:23'),
	(293,83,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2016-12-29 00:00:00',1,NULL,NULL,NULL,9,1,'2016-12-27 09:10:16','2016-12-26 15:00:29'),
	(295,83,83,147,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2016-12-29 00:00:00',1,NULL,NULL,NULL,10,1,'2016-12-27 09:16:29','2016-12-27 09:16:29'),
	(296,85,86,152,NULL,NULL,NULL,710.00,1.00,710.00,710.00,0.00,0.00,710.00,1,'2016-12-30 00:00:00',1,NULL,NULL,NULL,10,1,'2016-12-28 13:52:28','2016-12-28 13:52:28'),
	(297,86,86,152,NULL,NULL,NULL,710.00,3.00,710.00,2130.00,0.00,0.00,2130.00,1,'2017-01-06 00:00:00',1,NULL,NULL,NULL,10,1,'2016-12-28 13:59:26','2016-12-28 13:59:20'),
	(298,87,86,152,NULL,NULL,NULL,710.00,1.00,710.00,710.00,0.00,0.00,710.00,1,'2017-01-06 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-04 09:42:29','2017-01-04 09:42:29'),
	(299,88,83,147,NULL,NULL,NULL,20.00,2.00,20.00,40.00,5.00,0.00,35.00,1,'2017-01-06 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-04 10:09:16','2017-01-04 10:09:16'),
	(300,88,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-06 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-04 10:09:38','2017-01-04 10:09:38'),
	(301,88,86,152,NULL,NULL,NULL,710.00,2.00,710.00,1420.00,0.00,0.00,1420.00,1,'2017-01-06 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-04 10:10:04','2017-01-04 10:10:04'),
	(306,90,83,147,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 14:15:40','2017-01-09 14:15:24'),
	(307,90,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 14:15:30','2017-01-09 14:15:30'),
	(308,90,86,152,NULL,NULL,NULL,710.00,2.00,710.00,1420.00,0.00,0.00,1420.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 14:15:34','2017-01-09 14:15:34'),
	(309,91,86,152,NULL,NULL,NULL,710.00,2.00,710.00,1420.00,0.00,0.00,1420.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 14:18:52','2017-01-09 14:18:52'),
	(310,91,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 14:19:48','2017-01-09 14:19:43'),
	(312,91,89,159,NULL,NULL,NULL,750.00,1.00,750.00,750.00,0.00,NULL,750.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 14:27:48','2017-01-09 14:27:48'),
	(313,92,89,159,NULL,NULL,NULL,750.00,1.00,750.00,750.00,0.00,NULL,750.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 14:32:27','2017-01-09 14:32:27'),
	(314,92,92,163,NULL,NULL,NULL,950.00,2.00,950.00,1900.00,0.00,NULL,1900.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,11,1,'2017-01-09 14:32:34','2017-01-09 14:32:31'),
	(315,92,86,152,NULL,NULL,NULL,710.00,2.00,710.00,1420.00,0.00,0.00,1420.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 14:33:04','2017-01-09 14:33:01'),
	(316,93,89,159,NULL,NULL,NULL,750.00,2.00,750.00,1500.00,0.00,NULL,1500.00,1,'2017-01-13 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 15:08:43','2017-01-09 15:08:43'),
	(317,93,92,163,NULL,NULL,NULL,950.00,2.00,950.00,1900.00,0.00,NULL,1900.00,1,'2017-01-13 00:00:00',1,NULL,NULL,NULL,11,1,'2017-01-09 15:08:51','2017-01-09 15:08:51'),
	(318,94,89,159,NULL,NULL,NULL,750.00,2.00,750.00,1500.00,0.00,NULL,1500.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 15:12:07','2017-01-09 15:12:07'),
	(319,94,92,163,NULL,NULL,NULL,950.00,2.00,950.00,1900.00,0.00,NULL,1900.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,11,1,'2017-01-09 15:12:31','2017-01-09 15:12:31'),
	(320,95,89,159,NULL,NULL,NULL,750.00,2.00,750.00,1500.00,0.00,NULL,1500.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 15:16:54','2017-01-09 15:16:54'),
	(321,95,92,163,NULL,NULL,NULL,950.00,2.00,950.00,1900.00,0.00,NULL,1900.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,11,1,'2017-01-09 15:17:09','2017-01-09 15:17:09'),
	(322,95,86,152,NULL,NULL,NULL,710.00,2.00,710.00,1420.00,0.00,0.00,1420.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 15:17:30','2017-01-09 15:17:30'),
	(323,95,83,147,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,10,1,'2017-01-09 15:17:57','2017-01-09 15:17:57'),
	(324,95,84,146,NULL,NULL,NULL,20.00,2.00,20.00,40.00,0.00,0.00,40.00,1,'2017-01-11 00:00:00',1,NULL,NULL,NULL,9,1,'2017-01-09 15:18:02','2017-01-09 15:18:02'),
	(325,96,92,163,NULL,NULL,NULL,950.00,2.00,950.00,1900.00,0.00,NULL,1900.00,1,NULL,1,NULL,NULL,NULL,11,1,'2017-01-09 16:09:38','2017-01-09 16:09:37');

/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_item_packing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_item_packing`;

CREATE TABLE `order_item_packing` (
  `orderItemPackingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderItemId` bigint(20) NOT NULL,
  `pickingItemsId` bigint(20) DEFAULT NULL,
  `bagNo` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) NOT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '1' COMMENT '4: ปิดถุงแล้ว\n5 : กำลังจัดส่ง\n99: กำลัง pack  \n7 : นำจ่าย\n8:ลูกค้ารับของแล้ว\n9 : ตรวจช่อง OK\n10 :ตรวจช่อง No',
  `type` tinyint(6) DEFAULT NULL COMMENT '1 : แจ้งตู้มีปัญหา หลายๆสาเหตุ\n2 : ลูกค้าไม่มารับสินค้า',
  `shipDate` datetime DEFAULT NULL COMMENT 'แสดงวันที่ คนเข้าของไปใส่ตู้',
  `remark` varchar(150) DEFAULT NULL,
  `userId` tinyint(6) DEFAULT NULL,
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'แสดงวันที่ลูกค้ามารับสินค้า',
  `lastvisitDate` datetime DEFAULT NULL,
  PRIMARY KEY (`orderItemPackingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_item_packing` WRITE;
/*!40000 ALTER TABLE `order_item_packing` DISABLE KEYS */;

INSERT INTO `order_item_packing` (`orderItemPackingId`, `orderItemId`, `pickingItemsId`, `bagNo`, `quantity`, `status`, `type`, `shipDate`, `remark`, `userId`, `createDateTime`, `updateDateTime`, `lastvisitDate`)
VALUES
	(8,68,1,'BG20161017-0000001',2,8,NULL,NULL,NULL,NULL,'2016-10-17 14:57:02','2016-10-17 15:16:02',NULL),
	(9,68,2,'BG20161017-0000002',2,8,NULL,NULL,NULL,NULL,'2016-10-17 14:57:25','2016-10-17 15:16:02',NULL),
	(10,69,2,'BG20161017-0000003',1,8,NULL,NULL,NULL,NULL,'2016-10-17 14:58:04','2016-10-17 15:16:02',NULL),
	(11,70,2,'BG20161017-0000004',1,8,NULL,NULL,NULL,NULL,'2016-10-17 14:58:25','2016-10-17 15:16:02',NULL),
	(12,70,3,'BG20161017-0000005',1,8,NULL,NULL,NULL,NULL,'2016-10-17 14:58:35','2016-10-17 15:16:02',NULL),
	(13,71,3,'BG20161017-0000006',1,8,NULL,NULL,NULL,NULL,'2016-10-17 14:58:55','2016-10-17 15:16:02',NULL),
	(14,72,109,'BG20161019-0000007',1,10,1,'2016-10-19 11:00:15','ช่องเปิดไม่ได้',1,'2016-10-19 11:00:15','2016-10-26 15:40:13','2016-11-14 11:58:55'),
	(15,73,109,'BG20161019-0000007',1,10,NULL,'2016-10-19 11:00:15','ช่องเปิดไม่ได้',5,'2016-10-19 11:01:27','2016-10-26 15:40:13',NULL),
	(16,72,119,'BG20161019-0000008',2,9,NULL,'2016-10-19 11:00:15',NULL,NULL,'2016-10-19 11:02:16','2016-10-26 15:20:13',NULL),
	(17,72,119,'BG20161019-0000009',1,9,NULL,'2016-10-19 11:00:15',NULL,NULL,'2016-10-19 11:02:53','2016-10-26 15:20:13',NULL),
	(18,74,119,'BG20161019-0000009',2,9,NULL,'2016-10-19 11:00:15',NULL,NULL,'2016-10-19 11:03:25','2016-10-26 15:20:13',NULL),
	(19,75,119,'BG20161019-0000009',1,9,NULL,'2016-10-19 11:00:15',NULL,NULL,'2016-10-19 11:03:44','2016-10-26 15:20:13',NULL),
	(20,63,NULL,'BG20161031-0000010',1,5,NULL,NULL,NULL,NULL,'2016-10-31 11:52:39','2016-10-31 16:22:01',NULL),
	(23,57,115,'BG20161031-0000011',1,9,NULL,'2016-11-01 09:39:36',NULL,NULL,'2016-10-31 16:32:08','2016-11-01 09:49:06',NULL),
	(64,86,NULL,'BG20161103-0000016',1,5,NULL,'0000-00-00 00:00:00',NULL,NULL,'2016-11-03 09:54:23','2016-11-03 09:55:13',NULL),
	(65,84,NULL,'BG20161103-0000017',3,5,NULL,'0000-00-00 00:00:00',NULL,NULL,'2016-11-03 09:55:45','2016-11-03 09:57:04',NULL),
	(66,86,NULL,'BG20161103-0000018',1,5,NULL,'0000-00-00 00:00:00',NULL,NULL,'2016-11-03 09:57:28','2016-11-03 09:57:30',NULL),
	(67,85,NULL,'BG20161103-0000019',1,5,NULL,NULL,NULL,NULL,'2016-11-03 09:57:43','2016-11-03 09:57:45',NULL),
	(68,119,NULL,'BG20161103-0000020',1,5,NULL,NULL,NULL,NULL,'2016-11-03 10:00:03','2016-11-03 10:00:06',NULL),
	(69,121,NULL,'BG20161103-0000021',1,5,NULL,NULL,NULL,NULL,'2016-11-03 10:04:18','2016-11-03 10:04:21',NULL),
	(70,136,195,'BG20161103-0000022',1,9,NULL,'2016-11-03 10:52:06',NULL,5,'2016-11-03 10:05:16','2016-11-07 17:27:59',NULL),
	(71,137,196,'BG20161103-0000023',1,10,NULL,'2016-11-03 10:52:36','test',8,'2016-11-03 10:05:41','2016-11-07 17:27:59',NULL),
	(72,138,197,'BG20161103-0000024',1,9,NULL,'2016-11-03 10:54:01',NULL,1,'2016-11-03 10:06:18','2016-11-07 17:27:59',NULL),
	(136,139,205,'BG20161110-0000025',1,7,NULL,'2016-11-10 13:26:42',NULL,NULL,'2016-11-10 11:10:33','2016-11-10 11:10:37',NULL),
	(137,140,206,'BG20161110-0000026',1,7,NULL,'2016-11-10 13:27:05',NULL,NULL,'2016-11-10 11:10:43','2016-11-10 11:10:47',NULL),
	(138,122,207,'BG20161110-0000027',1,7,NULL,'2016-11-10 13:34:40',NULL,NULL,'2016-11-10 13:31:31','2016-11-10 13:31:36',NULL),
	(139,123,208,'BG20161110-0000028',1,7,NULL,'2016-11-10 13:35:02',NULL,NULL,'2016-11-10 13:32:04','2016-11-10 13:32:08',NULL),
	(140,124,103,'BG20161110-0000029',1,8,NULL,'2016-11-11 08:52:29',NULL,5,'2016-11-10 15:38:25','2016-11-11 08:56:45',NULL),
	(141,125,104,'BG20161110-0000030',1,10,2,'2016-11-11 08:53:09','ลูกค้าไม่รับสินค้า',1,'2016-11-10 15:41:29','2016-11-11 08:56:46','2016-11-14 10:38:18');

/*!40000 ALTER TABLE `order_item_packing` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_item_packing_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_item_packing_items`;

CREATE TABLE `order_item_packing_items` (
  `remarkId` bigint(20) NOT NULL AUTO_INCREMENT,
  `pickingItemsId` bigint(20) NOT NULL,
  `orderItemPackingId` bigint(20) NOT NULL,
  `desc` varchar(250) DEFAULT NULL,
  `status` tinyint(6) NOT NULL DEFAULT '1' COMMENT '4: ปิดถุงแล้ว\n5 : กำลังจัดส่ง\n99: กำลัง pack  \n7 : นำจ่าย\n8:ลูกค้ารับของแล้ว\n9 : ตรวจช่อง OK\n10 :ตรวจช่อง No',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'แสดงวันที่ลูกค้ามารับสินค้า',
  `lastvisitDate` datetime DEFAULT NULL,
  PRIMARY KEY (`remarkId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_item_packing_items` WRITE;
/*!40000 ALTER TABLE `order_item_packing_items` DISABLE KEYS */;

INSERT INTO `order_item_packing_items` (`remarkId`, `pickingItemsId`, `orderItemPackingId`, `desc`, `status`, `createDateTime`, `updateDateTime`, `lastvisitDate`)
VALUES
	(1,109,14,'ช่องเปิดไม่ได้',1,'2016-11-14 10:38:06','2016-11-14 10:38:06','2016-11-14 10:38:06'),
	(2,104,141,'ลูกค้าไม่รับสินค้า',1,'2016-11-14 10:38:18','2016-11-14 10:38:18','2016-11-14 10:38:18'),
	(3,109,14,'ช่องเปิดไม่ได้',1,'2016-11-14 11:58:55','2016-11-14 11:58:55','2016-11-14 11:58:55');

/*!40000 ALTER TABLE `order_item_packing_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_payment_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_payment_history`;

CREATE TABLE `order_payment_history` (
  `orderPaymentHistoryId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` bigint(20) unsigned NOT NULL,
  `decision` varchar(45) NOT NULL,
  `reasonCode` varchar(45) NOT NULL,
  `reason` text NOT NULL,
  `userIp` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderPaymentHistoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `order_payment_history` WRITE;
/*!40000 ALTER TABLE `order_payment_history` DISABLE KEYS */;

INSERT INTO `order_payment_history` (`orderPaymentHistoryId`, `orderId`, `decision`, `reasonCode`, `reason`, `userIp`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,31,'ACCEPT','100','100 : Successful transaction.','101.51.91.104',1,'2016-10-04 08:35:16','2016-10-04 08:35:16'),
	(2,32,'ACCEPT','100','100 : Successful transaction.','101.51.91.104',1,'2016-10-04 14:01:12','2016-10-04 14:01:12'),
	(3,36,'ACCEPT','100','100 : Successful transaction.','182.52.249.241',1,'2016-10-14 07:59:48','2016-10-14 07:59:48'),
	(4,40,'ACCEPT','100','100 : Successful transaction.','182.52.249.241',1,'2016-10-14 09:13:25','2016-10-14 09:13:25'),
	(5,36,'ACCEPT','100','100 : Successful transaction.','182.52.249.241',1,'2016-10-14 09:48:31','2016-10-14 09:48:31'),
	(6,36,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-14 09:56:35','2016-10-14 09:56:35'),
	(7,36,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-14 09:57:46','2016-10-14 09:57:46'),
	(8,42,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-17 14:46:37','2016-10-17 14:46:37'),
	(9,43,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-17 15:21:23','2016-10-17 15:21:23'),
	(10,44,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-19 10:21:35','2016-10-19 10:21:35'),
	(11,46,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-10-21 09:30:20','2016-10-21 09:30:20'),
	(12,50,'ACCEPT','100','100 : Successful transaction.','1.10.147.75',1,'2016-10-31 14:42:43','2016-10-31 14:42:43'),
	(13,52,'ACCEPT','100','100 : Successful transaction.','1.10.147.75',1,'2016-10-31 14:47:11','2016-10-31 14:47:11'),
	(14,54,'ACCEPT','100','100 : Successful transaction.','182.52.50.211',1,'2016-11-01 11:13:35','2016-11-01 11:13:35'),
	(15,53,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-11-01 11:14:44','2016-11-01 11:14:44'),
	(16,47,'ACCEPT','100','100 : Successful transaction.','182.52.50.211',1,'2016-11-01 11:18:49','2016-11-01 11:18:49'),
	(17,53,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2016-11-01 11:20:38','2016-11-01 11:20:38'),
	(18,53,'ACCEPT','100','100 : Successful transaction.','182.52.50.211',1,'2016-11-01 11:35:11','2016-11-01 11:35:11'),
	(19,53,'ACCEPT','100','100 : Successful transaction.','182.52.50.211',1,'2016-11-01 15:01:23','2016-11-01 15:01:23'),
	(20,55,'ACCEPT','100','100 : Successful transaction.','101.51.189.215',1,'2016-11-02 13:27:57','2016-11-02 13:27:57'),
	(21,56,'ACCEPT','100','100 : Successful transaction.','101.51.189.215',1,'2016-11-03 09:39:28','2016-11-03 09:39:28'),
	(22,58,'ACCEPT','100','100 : Successful transaction.','101.51.189.215',1,'2016-11-03 11:49:37','2016-11-03 11:49:37'),
	(23,57,'ACCEPT','100','100 : Successful transaction.','101.51.191.170',1,'2016-11-09 10:22:00','2016-11-09 10:22:00'),
	(24,78,'ACCEPT','100','100 : Successful transaction.','203.113.57.140',1,'2016-12-23 15:06:04','2016-12-23 15:06:04'),
	(25,83,'ACCEPT','100','100 : Successful transaction.','203.113.57.112',1,'2016-12-27 09:19:40','2016-12-27 09:19:40'),
	(26,85,'ACCEPT','100','100 : Successful transaction.','101.51.189.198',1,'2016-12-28 13:56:12','2016-12-28 13:56:12'),
	(27,86,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2017-01-04 09:27:17','2017-01-04 09:27:17'),
	(28,87,'ACCEPT','100','100 : Successful transaction.','182.53.231.140',1,'2017-01-04 09:55:06','2017-01-04 09:55:06'),
	(29,88,'ACCEPT','100','100 : Successful transaction.','182.53.231.140',1,'2017-01-04 10:18:41','2017-01-04 10:18:41'),
	(30,79,'ACCEPT','100','100 : Successful transaction.','203.113.57.221',1,'2017-01-09 13:45:20','2017-01-09 13:45:20'),
	(31,90,'ACCEPT','100','100 : Successful transaction.','203.113.57.221',1,'2017-01-09 14:18:10','2017-01-09 14:18:10'),
	(32,91,'ACCEPT','100','100 : Successful transaction.','203.113.57.221',1,'2017-01-09 14:28:37','2017-01-09 14:28:37'),
	(33,92,'ACCEPT','100','100 : Successful transaction.','203.113.57.221',1,'2017-01-09 14:33:54','2017-01-09 14:33:54'),
	(34,94,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2017-01-09 15:13:58','2017-01-09 15:13:58'),
	(35,95,'ACCEPT','100','100 : Successful transaction.','203.113.57.221',1,'2017-01-09 15:19:05','2017-01-09 15:19:05'),
	(36,93,'ACCEPT','100','100 : Successful transaction.','103.10.231.34',1,'2017-01-11 15:57:48','2017-01-11 15:57:48');

/*!40000 ALTER TABLE `order_payment_history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table package
# ------------------------------------------------------------

DROP TABLE IF EXISTS `package`;

CREATE TABLE `package` (
  `packageId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `packageTypeId` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `width` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `depth` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `maxWeight` decimal(15,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`packageId`),
  KEY `fk_pack_to_pack_type_idx` (`packageTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;

INSERT INTO `package` (`packageId`, `packageTypeId`, `title`, `description`, `width`, `height`, `depth`, `weight`, `maxWeight`, `image`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ ก.','<p>เกรดKW/KA125</p><p>ขนาด  14*20*6 ซม.</p><p>ราคา ใบล่ะ 5.20 บาท</p>',20.00,14.00,6.00,5.00,10.00,'/images/Package/Q94p0QyM_B.jpg',1,'2016-06-22 13:20:37','2016-07-07 14:24:08'),
	(2,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ ข.  ','<p>เกรดKW/KA125</p><p>ขนาด  17*25*9 ซม.  <br></p><p>ราคา ใบล่ะ 7.20 บาท</p>',25.00,17.00,9.00,0.00,10.00,'/images/Package/pTNKPd37xr.jpg',1,'2016-06-22 13:22:41','2016-06-22 13:22:41'),
	(3,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ ค.','<p>เกรดKW/KA125</p><p>ขนาด  20*31*11 ซม.</p><p>ราคา ใบล่ะ 10.20 บาท</p>',31.00,20.00,11.00,0.00,10.00,'/images/Package/PlNaU929dT.jpg',1,'2016-06-22 13:23:55','2016-06-22 13:23:55'),
	(4,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ ง.','<p>เกรดKW/KA125</p><p>ขนาด  25*35*14 ซม.</p><p>ราคา ใบล่ะ 14.20 บาท</p><p>กล่องไปรษณีย์  กล่องไปรษณีย์ราคาถูก ขายกล่องไปรษณีย์</p>',35.00,25.00,14.00,0.00,10.00,'/images/Package/6ft0FbAyS7.jpg',1,'2016-06-22 13:25:03','2016-06-22 13:25:03'),
	(5,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ 0.','<p>เกรดKW/KA125</p><p>ขนาด  11*17*6 ซม.</p><p>ราคา ใบล่ะ 4.20 บาท</p>',17.00,11.00,6.00,0.00,10.00,'/images/Package/pd3dbcVIYz.jpg',1,'2016-06-22 13:25:48','2016-06-22 13:25:48'),
	(6,1,'กล่องไปรษณีย์แบบมาตรฐาน สีขาว ไซด์ จ.','<p>เกรดKW/KI 125</p><p>ขนาด  24*40*17 ซม.</p><p>ราคา ใบล่ะ 20 บาท</p>',40.00,24.00,17.00,0.00,10.00,'/images/Package/LxRiKZBzZR.jpg',1,'2016-06-22 13:26:47','2016-06-22 13:26:47');

/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table package_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `package_type`;

CREATE TABLE `package_type` (
  `packageTypeId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`packageTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `package_type` WRITE;
/*!40000 ALTER TABLE `package_type` DISABLE KEYS */;

INSERT INTO `package_type` (`packageTypeId`, `title`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'กระดาษ','',1,'2016-06-22 13:00:48','2016-06-22 13:00:48'),
	(2,'พลาสติก','',1,'2016-06-22 13:00:53','2016-06-22 13:00:53'),
	(3,'ไม้','',1,'2016-06-22 13:00:58','2016-06-22 13:00:58'),
	(4,'เหล็ก','',1,'2016-06-22 13:01:02','2016-06-22 13:01:02');

/*!40000 ALTER TABLE `package_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payment_method
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method` (
  `paymentMethodId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`paymentMethodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payment_method` WRITE;
/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;

INSERT INTO `payment_method` (`paymentMethodId`, `title`, `description`, `image`, `type`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'โอนเงินผ่านธนาคาร','','/images/PaymentMethod/G89gbqV4sJ.jpg',1,0,'2016-07-13 16:12:58','2016-07-14 15:01:06'),
	(2,'ชำระผ่านบัตรเครดิต','','/images/PaymentMethod/2glJogvE5_.png',2,1,'2016-07-13 16:13:12','2016-07-14 15:02:07');

/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table picking_point
# ------------------------------------------------------------

DROP TABLE IF EXISTS `picking_point`;

CREATE TABLE `picking_point` (
  `pickingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `code` varchar(30) NOT NULL,
  `description` varchar(45) NOT NULL,
  `countryId` varchar(45) NOT NULL DEFAULT 'THA',
  `provinceId` bigint(20) unsigned NOT NULL,
  `amphurId` bigint(20) unsigned NOT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1 : ',
  `ip` varchar(100) DEFAULT NULL,
  `macAddress` varchar(100) DEFAULT NULL,
  `authCode` varchar(100) DEFAULT NULL COMMENT 'รหัสสำหรับเช็คต้นทางกับปลายทาง',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pickingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `picking_point` WRITE;
/*!40000 ALTER TABLE `picking_point` DISABLE KEYS */;

INSERT INTO `picking_point` (`pickingId`, `title`, `code`, `description`, `countryId`, `provinceId`, `amphurId`, `type`, `ip`, `macAddress`, `authCode`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'ฟิวเจอร์พาร์ครังสิต','PP-0001','<p>ฟิวเจอร์พาร์ครังสิต</p>','THA',2526,79740,1,NULL,NULL,NULL,1,'2016-09-21 13:47:09','2016-09-21 06:47:09'),
	(2,'MRT - รัชดา','PP-0002','<p>MRT - รัชดา</p>','THA',2523,79712,1,NULL,NULL,NULL,1,'2016-09-21 13:47:19','2016-09-21 06:47:19'),
	(9,'คลอง 3 - บิ๊กซี ซูเปอร์เซ็นเตอร์','PP-0003','<p>คลอง 3 - บิ๊กซี ซูเปอร์เซ็นเตอร์</p>','THA',2526,79740,1,NULL,NULL,NULL,1,'2016-09-22 08:59:49','2016-09-22 01:59:49'),
	(10,'MRT - พระรามเก้า','PP-0004','<p>MRT - พระรามเก้า</p>','THA',2523,79691,1,NULL,NULL,NULL,1,'2016-09-22 10:20:35','2016-09-22 03:20:35'),
	(11,'ศูนย์การค้าเซียร์ รังสิต','PP-0005','<p>ศูนย์การค้าเซียร์ รังสิต</p>','THA',2526,79740,1,NULL,NULL,NULL,1,'2016-09-23 08:48:28','2016-09-23 01:48:28'),
	(12,'MRT- ลาดพร้าว ','PP-0006','<p>MRT- ลาดพร้าว </p>','THA',2523,79712,1,NULL,NULL,NULL,1,'2016-09-23 08:51:02','2016-09-23 01:51:02'),
	(13,'เซ็นทรัล ลาดพร้าว','PP-0007','<p>แมคโดนัล  โซน อาหาร ชั้น1</p>','THA',2523,79704,NULL,NULL,NULL,NULL,1,'2016-09-30 15:39:56','2016-09-30 15:39:56'),
	(14,'BTS หมอชิต ทางออกประตู 3','PP-0008','<p>ตู้ตั้งอยู่บริเวณทางออก ประตู 3 </p>','THA',2523,79704,NULL,NULL,NULL,NULL,1,'2016-10-04 14:02:47','2016-10-04 14:02:47'),
	(15,'สนามบินสุวรรณภูมิ ชั้น4 โซนA','PP-0009','<p>สนามบินสุวรรณภูมิ ชั้น4 โซน A</p>','THA',2523,79685,NULL,NULL,NULL,NULL,1,'2016-10-06 08:30:13','2016-10-06 08:30:13');

/*!40000 ALTER TABLE `picking_point` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table picking_point_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `picking_point_items`;

CREATE TABLE `picking_point_items` (
  `pickingItemsId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickingId` bigint(20) unsigned NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `portIndex` varchar(45) DEFAULT NULL COMMENT 'สั่งไปเปิดฮาร์ดแวย์',
  `height` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pickingItemsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `picking_point_items` WRITE;
/*!40000 ALTER TABLE `picking_point_items` DISABLE KEYS */;

INSERT INTO `picking_point_items` (`pickingItemsId`, `pickingId`, `code`, `name`, `portIndex`, `height`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(18,1,'aa-001','1','11',60,'0','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(36,1,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(37,1,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(38,1,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(39,1,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(54,1,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(55,1,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(56,1,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(57,1,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(58,1,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(59,1,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(60,1,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(61,1,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(62,1,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(63,1,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(64,1,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(65,1,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(66,1,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(67,2,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(68,2,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(69,2,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(70,2,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(71,2,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(72,2,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(73,2,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(74,2,'aa-008','8','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(75,2,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(76,2,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(77,2,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(78,2,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(79,2,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(80,2,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(81,2,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(82,2,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(83,2,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(84,2,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(85,9,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(86,9,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(87,9,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(88,9,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(89,9,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(90,9,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(91,9,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(92,9,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(93,9,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(94,9,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(95,9,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(96,9,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(97,9,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(98,9,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(99,9,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(100,9,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(101,9,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(102,9,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(103,10,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(104,10,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(105,10,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(106,10,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(107,10,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(108,10,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(109,10,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(110,10,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(111,10,'aa-009','9','23',20,'0','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(112,10,'aa-010','10','24',20,'0','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(113,10,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(114,10,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(115,10,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(116,10,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(117,10,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(118,10,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(119,10,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(120,10,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(121,11,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(122,11,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(123,11,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(124,11,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(125,11,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(126,11,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(127,11,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(128,11,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(129,11,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(130,11,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(131,11,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(132,11,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(133,11,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(134,11,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(135,11,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(136,11,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(137,11,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(138,11,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(139,12,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(140,12,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(141,12,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(142,12,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(143,12,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(144,12,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(145,12,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(146,12,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(147,12,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(148,12,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(149,12,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(150,12,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(151,12,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(152,12,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(153,12,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(154,12,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(155,12,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(156,12,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(157,14,'aa-001','1','11',60,'0','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(158,14,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(159,14,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(160,14,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(161,14,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(162,14,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(163,14,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(164,14,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(165,14,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(166,14,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(167,14,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(168,14,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(169,14,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(170,14,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(171,14,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(172,14,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(173,14,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(174,14,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(175,15,'aa-001','1','11',60,'0','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(176,15,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(177,15,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(178,15,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(179,15,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(180,15,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(181,15,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(182,15,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(183,15,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(184,15,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(185,15,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(186,15,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(187,15,'aa-013','13','31',60,'1','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(188,15,'aa-014','14','32',40,'1','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(189,15,'aa-015','15','33',20,'1','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(190,15,'aa-016','16','34',20,'1','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(191,15,'aa-017','17','35',20,'1','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(192,15,'aa-018','18','36',20,'1','2016-10-14 10:45:59','2016-10-14 10:45:59'),
	(193,13,'aa-001','1','11',60,'1','2016-09-22 08:13:27','2016-09-22 08:13:27'),
	(194,13,'aa-002','2','12',40,'1','2016-10-13 15:24:21','2016-10-13 15:24:21'),
	(195,13,'aa-003','3','13',20,'1','2016-10-13 15:24:30','2016-10-13 15:24:30'),
	(196,13,'aa-004','4','14',20,'1','2016-10-13 15:24:38','2016-10-13 15:24:38'),
	(197,13,'aa-005','5','15',20,'1','2016-10-13 15:24:45','2016-10-13 15:24:45'),
	(198,13,'aa-006','6','16',20,'1','2016-10-14 10:38:27','2016-10-14 10:38:27'),
	(199,13,'aa-007','7','21',40,'1','2016-10-14 10:39:07','2016-10-14 10:39:07'),
	(200,13,'aa-008','Controller','22',60,'1','2016-10-14 10:39:48','2016-10-14 10:39:48'),
	(201,13,'aa-009','9','23',20,'1','2016-10-14 10:40:30','2016-10-14 10:40:30'),
	(202,13,'aa-010','10','24',20,'1','2016-10-14 10:40:57','2016-10-14 10:40:57'),
	(203,13,'aa-011','11','25',20,'1','2016-10-14 10:41:24','2016-10-14 10:41:24'),
	(204,13,'aa-012','12','26',20,'1','2016-10-14 10:42:02','2016-10-14 10:42:02'),
	(205,13,'aa-013','13','31',60,'0','2016-10-14 10:42:50','2016-10-14 10:42:50'),
	(206,13,'aa-014','14','32',40,'0','2016-10-14 10:43:32','2016-10-14 10:43:32'),
	(207,13,'aa-015','15','33',20,'0','2016-10-14 10:44:34','2016-10-14 10:44:34'),
	(208,13,'aa-016','16','34',20,'0','2016-10-14 10:44:59','2016-10-14 10:44:59'),
	(209,13,'aa-017','17','35',20,'0','2016-10-14 10:45:26','2016-10-14 10:45:26'),
	(210,13,'aa-018','18','36',20,'0','2016-10-14 10:45:59','2016-10-14 10:45:59');

/*!40000 ALTER TABLE `picking_point_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table points_reward_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `points_reward_member`;

CREATE TABLE `points_reward_member` (
  `pointsMemberId` bigint(20) NOT NULL AUTO_INCREMENT,
  `rankId` bigint(20) DEFAULT NULL,
  `userId` bigint(20) DEFAULT NULL,
  `orderId` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createBy` varchar(45) DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pointsMemberId`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

LOCK TABLES `points_reward_member` WRITE;
/*!40000 ALTER TABLE `points_reward_member` DISABLE KEYS */;

INSERT INTO `points_reward_member` (`pointsMemberId`, `rankId`, `userId`, `orderId`, `status`, `createBy`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,1,90,1,NULL,'0000-00-00 00:00:00','2017-01-09 14:18:10'),
	(2,1,1,91,1,NULL,'0000-00-00 00:00:00','2017-01-09 14:28:37'),
	(3,3,1,94,1,NULL,'0000-00-00 00:00:00','2017-01-09 15:13:58'),
	(4,4,1,95,1,NULL,'2017-01-09 15:19:04','2017-01-09 15:19:04'),
	(5,3,1,93,1,NULL,'2017-01-11 15:57:48','2017-01-11 15:57:48');

/*!40000 ALTER TABLE `points_reward_member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table points_reward_rank
# ------------------------------------------------------------

DROP TABLE IF EXISTS `points_reward_rank`;

CREATE TABLE `points_reward_rank` (
  `rankId` bigint(20) NOT NULL AUTO_INCREMENT,
  `num1` decimal(15,2) DEFAULT NULL,
  `num2` decimal(15,2) DEFAULT NULL,
  `cash` varchar(45) DEFAULT NULL,
  `points` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createBy` varchar(45) DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rankId`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

LOCK TABLES `points_reward_rank` WRITE;
/*!40000 ALTER TABLE `points_reward_rank` DISABLE KEYS */;

INSERT INTO `points_reward_rank` (`rankId`, `num1`, `num2`, `cash`, `points`, `status`, `createBy`, `createDateTime`, `updateDateTime`)
VALUES
	(1,500.00,1500.00,'20','1',1,'1','0000-00-00 00:00:00','2017-01-09 13:35:38'),
	(2,1501.00,3000.00,'25','2',1,'1','0000-00-00 00:00:00','2017-01-09 07:08:34'),
	(3,3001.00,4000.00,'30','3',1,'1','2017-01-09 09:24:53','2017-01-09 09:24:53'),
	(4,4001.00,5000.00,'35','4',1,'1','0000-00-00 00:00:00','2017-01-09 09:31:57'),
	(5,5001.00,6000.00,'40','5',1,'1','0000-00-00 00:00:00','2017-01-09 09:32:16'),
	(6,6001.00,7000.00,'45','6',1,'1','0000-00-00 00:00:00','2017-01-09 09:35:03'),
	(7,7001.00,8000.00,'55','7',1,'1','0000-00-00 00:00:00','2017-01-09 09:35:03'),
	(8,8001.00,9000.00,'60','8',1,'1','0000-00-00 00:00:00','2017-01-09 09:35:03'),
	(9,9001.00,10000.00,'65','9',1,'1','0000-00-00 00:00:00','2017-01-09 13:59:29'),
	(10,10001.00,20000.00,'70','10',1,'1','0000-00-00 00:00:00','2017-01-09 13:59:29'),
	(11,20001.00,30000.00,'75','11',1,'1','0000-00-00 00:00:00','2017-01-09 13:59:29'),
	(12,40001.00,50000.00,'80','12',1,'1','0000-00-00 00:00:00','2017-01-09 13:59:29'),
	(13,50001.00,60000.00,'85','13',1,'1','0000-00-00 00:00:00','2017-01-09 13:59:29');

/*!40000 ALTER TABLE `points_reward_rank` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `productId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `productGroupId` bigint(20) unsigned DEFAULT NULL,
  `brandId` bigint(20) unsigned DEFAULT NULL,
  `categoryId` bigint(20) unsigned DEFAULT NULL,
  `isbn` text,
  `code` varchar(100) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `optionName` varchar(200) DEFAULT NULL,
  `shortDescription` text,
  `description` text,
  `specification` text,
  `width` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `depth` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `unit` bigint(20) unsigned DEFAULT NULL,
  `smallUnit` bigint(20) unsigned DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve` varchar(10) DEFAULT NULL COMMENT 'old : เพิ่มจาก Product system\nnew : เพิ่มใหม่ รออนูมัติ\napprove : อนูมัติ\n\nใช้กับกรณีอันใหม่',
  `productSuppId` bigint(20) unsigned DEFAULT NULL,
  `approveCreateBy` bigint(20) unsigned DEFAULT NULL,
  `approvecreateDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`productId`),
  KEY `fk_p_to_pg_idx` (`productGroupId`),
  KEY `fk_p_to_c_idx` (`categoryId`),
  KEY `fk_p_to_u_idx` (`userId`),
  KEY `fk_p_to_b_idx` (`brandId`),
  KEY `fk_p_to_u_idx1` (`unit`),
  KEY `fk_p_to_su_idx` (`smallUnit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`productId`, `userId`, `productGroupId`, `brandId`, `categoryId`, `isbn`, `code`, `title`, `optionName`, `shortDescription`, `description`, `specification`, `width`, `height`, `depth`, `weight`, `price`, `unit`, `smallUnit`, `tags`, `status`, `createDateTime`, `updateDateTime`, `approve`, `productSuppId`, `approveCreateBy`, `approvecreateDateTime`)
VALUES
	(1,NULL,NULL,20,5,'CZ1610000001','hw1234','The history of whoo Glow lip balm ','','','<p>ลิปบาล์มออกสีอ่อนๆให้สีระเรื่อ ดูเป็นธรรมชาติ พร้อมด้วยสารบำรุงสมุนไพรนานาชนิด คัดสรรพิเศษ ที่จะทำให้ให้ริมฝีปากที่แห้งเสีย ดำคล้ำค่อยๆมีสุขภาพดีขึ้น</p>','',1.00,1.00,1.00,1.00,1900.00,4,4,'aa',1,'2016-08-30 11:38:50','2016-10-17 15:32:03',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(2,NULL,NULL,2,5,'CZ1610000002','mac2222','M∙A∙C  Cremesheen Pearl Lipstick','','','<p>ลิปสติกที่เปล่งประกายความความหรูหราในสไตล์สุดคลาสสิคแบบ M∙A∙C Cremesheen Pearl เจิดจรัสแวววาวกว่าที่เคยด้วยประกายมุกชิมเมอร์ของ Cremesheen Lipstick ให้ฟินิชที่เคลือบประกายเรืองรองด้วย pearlized pigments พิกเมินท์ประกายมุก มีให้เลือกถึงหลากเฉดสีใหม่ที่ครีเอทมาเพื่อสาวเอเชียโดยเฉพาะ อีกหนึ่งลิปสติกสีสดใสใหม่ที่ควรมีพกคู่กันไว้ในประเป๋า</p>','',1.00,1.00,1.00,1.00,900.00,4,4,'',1,'2016-08-30 11:41:27','2016-10-17 16:24:52',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(3,NULL,NULL,1,6,'CZ1610000003','nar3333','NARS Blush Orgasm Iconic shades','','<p>สีปัดแก้มของนาร์สทุกเฉดสี ได้รับความนิยมอย่างสูงทั่วโลก ผลิตโดยเทคโนโลยีพิเศษ ทาติดบนผิวทันที ไม่ร่วงและเป็นฝุ่นฟุ้งกระจาย ทำให้ง่ายต่อการแต่งหน้าเม็ดสีแห่ง คุณภาพ ให้สีสันอย่างที่คุณเห็นและสัมผัสเป็นอย่างที่คุณต้องการ อีกทั้งสดสวยทนนาน ไม่แปรเปลี่ยนหรือซีดจางในเวลาอันสั้น พลังแห่งการสร้างสรรค์ คิดค้นโดย ฟรองซัวส์ นาร์ส เมคอัพ อาร์ตทิส ระดับโลก สีสันพิเศษที่ไม่สามารถหาได้จาก ที่ไหน สวยงามอย่างที่คุณคาดไม่ถึง</p>','<p>The ultimate authority in blush, NARS offers the industry\'s most iconic shades for cheeks. Natural, healthy-looking color that immediately enlivens the complexion. A light application of even the highest-intensity hues delivers a natural-looking flush.</p>','<ul><li>Silky texture in matte and shimmering shades</li><li>Micronized powder ensures soft, blendable application</li><li>Iconic NARS shades</li></ul>',1.00,1.00,1.00,1.00,1500.00,4,4,'',1,'2016-08-30 13:05:03','2016-10-17 16:25:00',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(4,NULL,NULL,6,7,'CZ1610000004','nak4444','Eyeshadow Urban Decay Naked Palette','','','<p>ชุด <strong>Urban Decay Naked Palette </strong>อายชาโดว์ (Eyeshadow) เอนกประสงค์ยอดนิยมที่มาพร้อมกับสีโทนนู้ด 12 สี ที่จะช่วยให้คุณดูโดดเด่นและมีสไตล์ สามารถใช้ได้ทุกโอกาสตั้งแต่ทำงานในออฟฟิศไปจนถึงออกงานกลางคืน</p><p>ในกล่องประกอบด้วย Eyeshadow สีโทน Neutral 12 สี ที่สามารถใช้ได้กับทุกคน โทนสีจะไล่ตั้งแต่สี Champagne ไปจนถึงสี Gunmetal นอกจากนั้นยังเพิ่มสีใหม่อีก 5 สี มีทั้งแบบด้านและแบบเป็นประกาย ทั้ง Glitter และ shimmer เพื่อให้คุณมั่นใจได้ว่าคุณจะไม่เบื่อชุด <strong>Urban Decay Naked Palette</strong> ง่ายๆอย่างแน่นอน สามารถใข้แต่งหน้าได้หลายสถานการณ์ทั้งสำหรับไปทำงานที่ออฟฟิศ ไปจนถึงออกงานกลางคืน นอกจากนั้นในกล่องบรรจุ แปลงคุณภาพสูง Karma Eyeshadow brush และ Eyeshadow primer potion สูตรต้นตำหรับของ Urban decay</p>','<ul><li>Eyeshadow 12 สี แต่ละสีขนาด 1.3 กรัม ประกอบด้วย สี Virgin (nude satin), สี Sin (champagne shimmer), สี Naked (buff matte), สี Sidecar (beige sparkle), สี Buck (brown matte), สี Half Baked (bronze), สี Smog (golden brown shimmer), สี Darkhorse (bronze-plum shimmer), สี Toasted (taupe-bronze),สี Hustle (mocha shimmer), สี Creep (near-black metallic) และ สี Gunmetal (dark grey metallic)</li><li>Eyeshadow Primer Potion ขนาดพกพา 3.7ml</li><li>แปรง Good Karma Eyeshadow Brush</li></ul>',1.00,1.00,1.00,1.00,2000.00,4,4,'',1,'2016-08-30 13:10:01','2016-10-17 16:25:17',NULL,138,NULL,'0000-00-00 00:00:00'),
	(5,NULL,NULL,7,7,'CZ1610000005','lash5555','Lash Power Feathering Mascara','','<p>.</p>','<p>ยืดขนตาดูยาวได้ดั่งใจ ขนตาเรียงสวยเส้นต่อเส้น ด้วยสูตรที่ให้ขนตาดูสวยตลอดวัน ไม่เลอะเลือน ทำความสะอาดได้ง่ายด้วยน้ำอุ่น ทุกครั้งที่ปัดคุณจะรักขนตาทุกเส้นที่เรียงสวยราวกับขนนก ลองปัดสักครั้ง แล้วคุณจะตกหลุมรัก</p>','<p>- หมุนหัวแปรงขึ้นมา และปัดขนตาให้สวยตามต้องการ<br>- สามารถล้างออกได้อย่างง่ายดายและอ่อนโยนด้วยน้ำอุ่น (39°C / 103°F)<br>- หรือใช้คอนตอนบัดจุ่มลงในน้ำอุ่นแล้วกดเบาๆบนขนตาเพื่อทำให้มาสคาราอ่อนตัวลง จากนั้นล้างหน้าตามปกติ</p>',1.00,1.00,1.00,1.00,900.00,4,4,'',1,'2016-08-30 13:12:45','2016-10-17 16:25:43',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(7,NULL,NULL,7,5,'CZ1610000006','clin7557','Clinique Pop Lip Colour-Primer','','','<p>ลิปสติกสีสวยหวานขนาดพกพา ให้สีสันชุ่มฉ่ำที่ผสานด้วยไพร์เมอร์ ติดทนนาน ให้เนื้อสัมผัสที่เบาสบาย</p><p>ลิปสติกสีสวยโดนใจ คมชัด ริมฝีปากเรียบเนียนในแท่งเดียวเผยริมฝีปากนุ่ม และอวบอิ่ม </p><p>นอกจากนั้นส่วนผสมที่มีความชุ่มชื่น ไม่ทำให้ริมปากแห้ง และยังช่วยให้สีของลิปสติกไม่ซีดจางและติดทนยาวนาน</p>','<ul><li>คุณภาพดี</li><li>ติดทนนาน</li><li>15 เฉดสี</li><li>3.9 g.</li></ul>',1.00,1.00,1.00,1.00,1200.00,4,4,'',1,'2016-08-30 13:17:58','2016-10-17 16:25:57',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(8,NULL,NULL,8,5,'CZ1610000007','est8888','Estee Lauder Pure Color Long Lasting Lipstick','','','<p>ลิปสติกเนื้อครีม สี Bois De Rose ชมพูกลีบกุหลาบ สีหวานสดใสมีเสน่ห์สุดๆ เพื่อเรียวปากที่อวบอิ่มน่าหลงไหล เนื้อครีมเกลี่ยง่ายให้ปากสวย พร้อมเติมความชุ่มชื่น สบายให้ริมฝีปากด้วยมอยส์เจอร์ไรเซอร์ ทันที่ที่ใช้จะรู้สึกได้ถึง ความนุ่มนวล เนียนเรียบ และ เบาสบายผิว อีกทั้งช่วยเลือนริ้วรอยและความแห้งบริเวณริมฝีปากด้วยคุณสมบัติของการผสมผสานครีมบำรุงให้ความชุ่มชื่นผิวเข้ากับเม็ดสีลิปสติก ริมฝีปากจึงดูชุ่มชื่น เนียนเรียบ<br></p>','',1.00,1.00,1.00,1.00,2000.00,4,4,'',1,'2016-08-30 13:20:54','2016-10-17 16:26:16',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(11,NULL,NULL,10,11,'CZ1610000008','lm85558','LA MER The Regenerating Serum','','','<p>ผลิตภัณฑ์บำรุงผิวและรับมือกับริ้วรอย ช่วยลดเลือนเส้นริ้วต่างๆ ร่วมกับน้ำ</p><p>สกัดเข้มข้น Miracle Broth™ หัวใจหลักสำคัญในการช่วยฟื้นบำรุงผิวของ</p><p>ลาแมร์ ช่วยให้ผิวรู้สึกกระชับแลดูอ่อนเยาว์ ทำงานร่วมกับ Regenerating</p><p>Ferment™ สารหมักบ่มทางชีวภาพด้วยเซลล์จากพืช และ The Marine</p><p>Peptide Ferment ช่วยเติมความชุ่มชื้นและช่วยปกป้องผิว เมื่อใช้เป็นประจำ</p><p>อย่างต่อเนื่อง จะช่วยให้รูขุมขนกระชับ เส้นริ้วและริ้วรอยบนใบหน้าจะแลดู</p><p>จางลงอย่างเห็นได้ชัด ผิวแลดูอ่อนเยาว์ </p>','',1.00,1.00,1.00,1.00,8330.00,4,4,'',1,'2016-09-09 10:02:50','2016-10-17 16:26:26',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(16,NULL,NULL,14,11,'CZ1610000009','bio6666','Biotherm Aquasource Everplump','','','<p>น่าจะถูกใจสาวๆ ที่ชอบให้ผิวนุ่ม ชุ่มชื้นแต่ไม่เหนียวเหนอะหนะ BIOTHERM Aquasource Everplump จะเป็นเนื้อเจล มี Blue Hyaluron<sup>TM</sup> น้ำตาลชนิดพิเศษจากแหล่งน้ำของเฟรนช์โปลินีเซีย มาเสริมประสิทธิภาพของไฮยาลูโรนิก แอซิดในผิว ซึ่งจะช่วยให้ผิวอุ้มน้ำได้ดีขึ้น ลดเลือนริ้วรอย ให้ผิวดูเรียบเนียนและมีกลีเซอรินมาเติมความชุ่มชื้นให้ผิว <br></p>','',1.00,1.00,NULL,1.00,2500.00,4,4,'',1,'2016-09-13 11:42:56','2016-10-17 16:26:37',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(19,NULL,NULL,3,NULL,'CZ1610000010','lc00001','LANCÔME Blanc ','','','<p>LANCÔME Blanc Expert Beautiful Skin Tone Brightening Cream บำรุงผิวของคุณด้วยครีมบำรุงผิวสำหรับกลางวันมอบความชุ่มชื้นล้ำลึก มาพร้อมคุณสมบัติช่วยปรับผิวให้กระจ่างใส เนียนนุ่มขึ้นอย่างที่คุณไม่เคยสัมผัส</p>','',1.00,1.00,1.00,1.00,3800.00,4,4,'',1,'2016-09-13 11:49:35','2016-10-17 16:26:58',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(22,NULL,NULL,13,NULL,'CZ1610000011','payot33333','PAYOT Perform Sculpt','','','<p>PAYOT Perform Sculpt Nuit ทรีทเม้นท์การปรับรูปหน้าและคืนความกระชับให้กับผิวหน้าของคุณ ให้คุณตื่นมาพร้อมผิวที่กระชับดูอ่อนเยาว์ ดุจนักปั้นผิวมืออาชีพ ผลิตภัณฑ์ทางเลือกนอกเหนือจากการศัลยกรรม</p>','',1.00,1.00,1.00,1.00,3900.00,4,4,'',1,'2016-09-14 09:03:02','2016-10-17 16:27:15',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(30,NULL,NULL,2,12,'CZ1610000012','mac5555','MAC Pro Eye Makeup Remover','','','<p>ผลิตภัณฑ์สำหรับเช็ดเครื่องสำอางประสิทธิภาพเยี่ยม สามารถลบเครื่องสำอางรอบดวงตาได้อย่างหมดจด แม้เป็นเครื่องสำอางสูตรกันน้ำออกได้หมด ไม่ว่าจะเป็นการแต่งแบบอ่อนๆ หรือแบบที่สะดุดตา โดยไม่ทำให้เลอะ ไม่ทำให้แสบตาหรือให้ความรู้สึกรุนแรง คุณภาพระดับมืออาชีพทว่าอ่อนโยนต่อผิว ด้วยสารสกัดจากแตงกวาทำให้ผิวรู้สึกสบาย ชุ่มชื้นและผ่อนคลาย สามารถแต่งหน้าใหม่โดยไม่ต้องล้างหน้า</p>','',1.01,1.01,1.00,1.00,800.00,4,4,'',1,'2016-09-19 10:22:40','2016-10-17 16:27:45',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(32,NULL,NULL,15,13,'CZ1610000013','lan2222','Laneige Water Bank Gel Cream','','','<p>สุดของมอยส์เจอร์ไรเซอร์ชนิดครีมเจลสำหรับอากาศร้อนชื้น ซึมซาบล้ำลึก คืนความชุ่มฉ่ำให้ผิวแห้งกร้าน พร้อมเสริมปราการความแข็งแรงของผิว ให้ผิวชุ่มชื่นยาวนาน 24 ชั่วโมงโดยไม่ก่อให้เกิดความมัน เหนียวเหนอะ ด้วยเทคโนโลยี Moisturizing BiogeneTM เอกสิทธิ์เฉพาะของลาเนจ ที่ช่วยปลุกกลไกเก็บกักความชุ่มชื้นตามธรรมชาติของผิว กระตุ้นให้ผิวผลิตความชุ่มชื้นมาปกป้องผิวยาวนานตลอดวัน เผยประกายอิ่มน้ำให้ผิว พร้อมมอบคุณค่าการบำรุงให้ผิวไม่สูญเสียความชุ่มชื้น<span class=\"redactor-invisible-space\"></span></p>','',1.00,1.00,1.00,1.00,1500.00,4,4,'',1,'2016-09-19 10:27:30','2016-10-17 16:28:02',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(34,NULL,NULL,16,43,'CZ1610000014','gio7667','GIORGIO ARMANI Acqua di Gio Pour Homme','','','<p>กลิ่นหอมแนวอโรมาติค อควาติคที่เปิดตัวด้วยความสดชื่นของ Calabrian bergamot, neroli, และ green tangerine ผสมผสานความชุ่มฉ่ำแบบ aquatic เข้ากับความหอมที่อ่อนโยนของ jasmine petal, rock rose, rosemary กลิ่นผลลูกพลับชวนลิ้มลอง และ Indonesian patchouli แสนอบอุ่น หลอมรวมเป็นกลิ่นหอมในแบบผู้ชายที่ทั้งสดชื่นและมีเสน่ห์น่าหลงใหลอย่างเป็นธรรมชาติ</p>','<ul><li>Brand Name: GIORGIO ARMANI</li><li>Product Type: Duty Free</li><li>Country of Origin: France</li><li>เพศ: Men</li><li>Ingredient: Bergamot, Marine Notes, Cedar Wood</li></ul>',1.00,1.00,1.00,1.00,3200.00,4,4,'',1,'2016-09-20 09:38:08','2016-10-17 16:28:13',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(35,NULL,NULL,17,42,'CZ1610000015','lacos7897','LACOSTE BAG TT','','','<p>กระเป๋าสะพาย ยอดนิยม น้ำหนักเบา ใส่ของได้มาก </p>','<p>- กระเป๋าขนาด M1 <br>- รุ่นนี้มีสีกระเป๋ามากกว่า 10 สี <br>- มีช่องซิปภายในกระเป๋า 1 ช่อง <br>- ขนาด 26 x 35 x 16 ซม. </p>',1.00,1.00,1.00,1.00,4000.00,2,2,'',1,'2016-09-22 15:35:33','2016-10-17 16:28:27',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(36,NULL,NULL,18,30,'CZ1610000016','ew111','COACH FA16 COACH SWAGGER WRISTLET ','','','<p>กระเป๋า COACH รุ่น SWAGGER WRISTLET IN PEBBLE LEATHER กระเป๋าคล้องมือสุดเท่ห์ โดดเด่นที่การออกแบบตัวหมุนล็อคสองอันทางด้านหน้าของกระเป๋า และวัสดุหนัง pebble คุณภาพเยี่ยม ให้คุณดูเท่ห์ เก๋ สไตล์ swagger ได้ไม่ยาก<br>พร้อมสายสะพายยาวถอดออกได้ สามารถปรับเป็นกระเป๋าสะพายข้างได้ <br><br><br></p>','<p>- วัสดุหนัง pebble<br>- มีช่องใส่ของด้านในกระเป๋า <br>- มีซิปปิดกระเป๋า พร้อมบุด้านใน<br>- มีสายสำหรับคล้องข้อมือ<br>- ขนาด 21 ซม. (ยาว) x 14 ซม. (สูง) x 5 ซม. (กว้าง)</p>',1.00,1.00,1.00,1.00,13500.00,2,2,'',1,'2016-09-22 15:43:06','2016-10-17 13:27:05',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(37,NULL,NULL,NULL,42,'CZ1610000017','les3455','LeSportsac  BAG','','','<p>กระเป๋าสะพายไหล่  ด้านบนเป็นช่องใส่ของ 2 ช่องหลักพร้อมซิป สามารถใส่ของได้อย่างเป็นสัดส่วน อีกทั้งมีซิปขยายเพิ่มขนาดกระเป๋าได้สะดวกสบาย ด้านหน้าของกระเป๋ามีช่องใส่ของเล็กๆ 2 ช่อง และอีก 1 ช่องทางด้านหลังพร้อมซิปทั้งสองด้าน สามารถปรับสายสะพายไหล่ให้สั้นยาวได้ตามความต้องการ (มากสุด 50 นิ้ว/127 ซม.) แถมพร้อมกระเป๋าซิปใบเล็กในลายเดียวกัน</p>','',1.00,1.00,1.00,1.00,3900.00,2,2,'',1,'2016-09-22 15:49:05','2016-10-17 16:28:39',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(39,NULL,NULL,3,44,'CZ1610000018','laco112312','Lancôme La Collection De Parfums','','','<ul><li>Brand Name: LANCÔME</li><li>Product Type: Duty Free</li><li>Country of Origin: France</li></ul>','<p>Trésor EDP 7.5ml. <br>Miracle EDP 5ml.<br>Hypnôse EDP 5ml.<br>La Vie Est Belle EDP 4ml.<br>Trésor In Love EDP 5ml.</p>',1.00,1.00,1.00,1.00,2500.00,4,4,'',1,'2016-09-29 09:55:38','2016-10-17 16:28:56',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(40,NULL,NULL,18,30,'CZ1610000019','co4444','BALLY GROSVENOR','','','<p>กระเป๋าสตางค์สุภาพสตรีจากแบรนด์ BALLY รุ่น GROSVENOR ผลิตจากวัสดุหนังแท้ชั้นดี ป้องกันการขีดข่วน และช่วยยืดอายุการใช้งานให้คงทน ขนาดพอเหมาะกับการพกพาธนบัตร, การ์ด และของจำเป็นอื่นๆ มาในสีที่เรียบหรูคลาสสิค ดูสวยงามน่าใช้</p>','<ul><li>Brand Name: BALLY</li><li>Product Type: Non-Duty Free</li><li>Country of Origin: ITALY</li><li>เพศ: Women</li><li>Dimension: W 19cm/ 7.5\" X H 10cm/ 4\" X D 2.5cm/ 1\"</li><li>color: NUDE</li><li>Material: 0, Calf Leather</li></ul>',1.00,1.00,1.00,1.00,30000.00,2,2,'',1,'2016-09-29 14:58:03','2016-10-17 16:29:06',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(41,NULL,NULL,21,31,'CZ1610000020','bol444444','BOLON FP 0216','','','<p>การรวมตัวของดีไซน์อันโฉบเฉี่ยวของ Colani กรอบทรงแคทอายสามมิติ โครงขาแว่นโลหะ พร้อมเชื่อมต่อความแตกต่างอันเด่นชัดของกรอบแว่นและขาแว่นด้วยบานพับที่แต่งด้วยโลโก้ BOLON ด้วยวัสดุยางและโลหะ ผลงานละเอียดประณีต ผ่านการรังสรรค์ที่ชาญฉลาดและละเมียดละไมของดีไซเนอร์ กรอบแว่นทรงแคทอายให้ความโค้งเว้าด้านข้างอย่างมีศิลปะ<br><br></p>','<p>เลนส์: Purplish Red HD Polarized Nylon Mirror Lenses <br>วัสดุกรอบแว่น: Black TR Frame<br>ความกว้างช่วงสันจมูก: 58-13<br>ความยาวขาแว่น: 145<br>100% UV Protection</p>',1.00,1.00,1.00,1.00,4000.00,4,4,'',1,'2016-09-29 15:03:37','2016-10-17 16:29:16',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(42,NULL,NULL,18,31,'CZ1610000021','coch777777','COACH FN 55 PUR','','','<p>ตัวแว่นกันแดดกรอบเลนส์เป็นอลูมิเนียม ตัวเลนส์สีชา</p>','<ul><li>Brand Name: COACH</li><li>Product Type: Duty Free</li><li>เพศ: Women</li><li>color: BROWN</li></ul>',1.00,1.00,1.00,1.00,5500.00,2,2,'',1,'2016-09-29 15:07:25','2016-10-17 16:29:34',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(43,NULL,NULL,22,32,'CZ1610000022','cas555555','CASIO BABY-G BGA-210-7B3DR','','','<p>• กระจกมิเนอรัล<br>• นีโอไบรท์<br>• ทนทานต่อแรงสั่นสะเทือน<br>• กันน้ำลึก 100 เมตร<br>• วัสดุตัวเรือน / กรอบ: เรซิน / อะลูมิเนียม<br>• สายเรซิน<br>• ไฟ LED<br>• แสดงเวลาโลก<br>• คุณสมบัติในการเลื่อนเข็มนาฬิกา (จะย้ายเข็มนาฬิกาออกเพื่อการดูข้อมูลบนหน้าปัดดิจิตอลได้ง่ายขึ้น)<br>• ตัวจับเวลาละเอียด 1 วินาที<br>• นาฬิกาจับเวลาถอยหลัง<br>• นาฬิกาปลุกที่ทำงานทุกวัน<br>• สัญญาณแจ้งต้นชั่วโมง<br>• แสดงปฏิทินแบบเต็มโดยอัตโนมัติ (ถึงปี 2099)<br>• แสดงเวลารูปแบบ 12/24 ชั่วโมง<br>• เปิด/ปิดเสียงการทำงานของปุ่ม<br>• บอกเวลาปกติแบบทั่วไป</p>','<ul><li>Brand Name: CASIO</li><li>Product Type: Duty Free</li><li>Material: 0, Resin</li></ul>',1.00,1.00,1.00,1.00,6000.00,4,4,'',1,'2016-09-29 15:19:15','2016-10-17 16:29:54',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(44,NULL,NULL,18,32,'CZ1610000023','coa999999','COACH Boyfriend','','','<p>• แสดงเวลาหลายหน้าปัดย่อย<br>• หน้าปัดทรงกลม<br>• ตัวเรือน Gold-Plated Case with Set Bezel<br>• สายถักสีทอง <br>• ขีดบอกเวลา Gold-plated Sunray</p>','<ul><li>Brand Name: COACH</li><li>Product Type: Duty Free</li><li>Size: 34mm</li></ul>',1.00,1.00,1.00,1.00,13000.00,4,4,'',1,'2016-09-29 15:22:34','2016-10-17 16:30:30',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(45,NULL,NULL,23,33,'CZ1610000024','122222','LACOSTE L.12.12 POLO','','','<p>สไตล์แฟชั่นอเมริกา ใส่รู้สึกเย็น ผ่อนคลาย สบายๆ ให้ทุกวันเป็นวันแห่งความสุขของคุณ</p>','',1.00,1.00,1.00,1.00,3500.00,4,4,'',1,'2016-09-29 15:28:34','2016-09-29 15:28:34',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(46,NULL,NULL,23,33,'CZ1610000025','3333','LACOSTE The Feminine polo','','','<p>สไตล์แฟชั่นอเมริกา ใส่รู้สึกเย็น ผ่อนคลาย สบายๆ ให้ทุกวันเป็นวันแห่งความสุขของคุณ</p>','',1.00,1.00,1.00,1.00,30000.00,4,4,'',1,'2016-09-29 15:31:32','2016-10-07 11:34:10',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(47,NULL,NULL,24,34,'CZ1610000026','000','TOSCOW Sterling Silver Stud Earrings','','','<p>มอบของขวัญอันล้ำค่าประดับกาย ต่างหู TOSCOW Sterling Silver Cultured Pearl Stud คัดสรรมุกน้ำจืดขนาด 8-9 มม. คุณภาพดีจากฟาร์มเพาะเลี้ยง แต่งด้วยคริสตัล3 เม็ดฝังบนเนื้อเงินสเตอร์ลิง ซิลเวอร์ โดดเด่นสะดุดตาไม่ว่าจะสวมใส่ไปร่วมงานปาร์ตี้หรือสวมใส่ในโอกาสพิเศษต่างๆ<br>สายสร้อยเงินสเตอร์ลิง ซิลเวอร์ (ความยาว 40-45 ซม.ปรับระดับได้) <br>วัสดุ: Sterling Silver, มุกน้ำจืดจากฟาร์ม</p>','<ul><li>Brand Name: TOSCOW</li><li>Product Type: Duty Free</li><li>Country of Origin: China</li><li>เพศ: Women</li><li>Weight: 2.73 g</li></ul>',1.00,1.00,1.00,1.00,4000.00,4,4,'',1,'2016-09-29 15:35:59','2016-10-07 11:39:36',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(48,NULL,NULL,24,34,'CZ1610000027','1111111','SWAROVSKI SWAN BANGLE','','','<p>เครื่องประดับ  คุณภาพดี ดีไซน์สวยงาม เหมาะสำหรับเป็นของขวัญให้คุณที่คุณรักหรือสำหรับตัวคุณเอง ทุกชิ้นผ่านการตรวจสอบมาอย่างปราณีตว่าเป็นเครื่องประดับที่สวยงามดูดี เหมาะแก่ผู้ใส่ </p>','',1.00,1.00,1.00,1.00,6000.00,4,4,'',1,'2016-09-29 15:41:32','2016-09-29 15:41:32',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(49,NULL,NULL,26,45,'CZ1610000028','0000000','SENNHEISER Black Momentum On-Ear','','','<ul><li>ระดับคุณภาพทั้งตัวเครื่องและคุณภาพเสียง</li><li>ตัวหูฟังสวมใส่สบาย</li><li>พกพาง่าย</li></ul><p><del></del></p>','',1.00,1.00,1.00,1.00,8900.00,4,4,'',1,'2016-09-29 15:49:29','2016-10-10 09:04:36',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(50,NULL,NULL,26,45,'CZ1610000029','9999','SENNHEISER WHI MM30G','','','<ul><li>ระดับคุณภาพทั้งตัวเครื่องและคุณภาพเสียง</li><li>ตัวหูฟังสวมใส่สบาย</li><li>พกพาง่าย</li></ul>','',1.00,1.00,1.00,1.00,1500.00,4,4,'',1,'2016-09-29 15:54:23','2016-09-29 15:54:23',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(51,NULL,NULL,27,46,'CZ1610000030','2222','OLYMPUS E-M10 MII','','','<p>เซนเซอร์ Live MOS TruePic VII, ระบบกันสั่น 5 แกน, ขนาดกะทัดรัด, หน้าจอ Flip-up, Touch AF Shutter, เก็บทุกความประทับใจด้วยฟังก์ชั่นถ่ายภาพต่อเนื่อง 8.5 ภาพ/วินาที, Electronic Viewfinder ความละเอียด 2.36 ล้านพิกเซล, AF Targeting Pad, Live composite, Live Bulb/ Live Time, Photo Story, Art Filter, Art Effects, 4K Time Lapse movie, S-OVF (Simulated OVF) ถ่ายภาพแบบย้อนแสงได้ง่ายดาย, Silent Mode, Focus Bracketing, Built-in Wi-Fi<br>วัสดุ: โลหะและพลาสติก<br>ข้อควรระวัง: เก็บให้ห่างจากเปลวไฟ</p>','<ul><li>Brand Name: OLYMPUS</li><li>Product Type: Non-Duty Free</li><li>เพศ: Unisex</li><li>Dimension: 11.9 x 8.3 x 4.6</li><li>color: SILVER</li><li>Weight: 342g</li></ul>',1.00,1.00,1.00,1.00,35000.00,4,4,'',1,'2016-09-29 16:00:41','2016-10-10 09:27:21',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(52,NULL,NULL,28,46,'CZ1610000031','666666666','PANASONIC LUMIX DMC-LX100GCS','','','<p>ทะยานสู่เส้นขอบฟ้าอันโดดเด่นในมุมมองใหม่ด้วยกล้อง PANASONIC LUMIX DMC-LX100 ออกแบบมาเพื่อแสดงการใส่สีอันน่าทึ่งและพื้นผิวที่สมบูรณ์ตามธรรมชาติทั้งหมด โดยรวมเอาเซ็นเซอร์ MOS ความไวสูงขนาดใหญ่ 4/3 นิ้วใหม่ที่มีอัตราส่วนภาพหลายขนาดไว้ด้วย</p><p>ด้วยความละเอียด 12.8 ล้านพิกเซล (ในการตั้งค่า 4:3) ทำให้สามารถคงระดับปริมาณแสงไว้เพื่อปรับปรุงอัตราส่วน S/N ซึ่งช่วยให้สามารถเก็บภาพที่คมชัดจุดนอยส์ต่ำสุดแม้เวลาถ่ายรูปที่ระดับ ISO25600 นำ DMC-LX100 พร้อมภาพสวยที่อัดแน่นอยู่ในตัวเครื่องขนาดกะทัดรัดไปกับคุณได้ทุกที่มาพร้อมระบบป้องกันการสั่นไหว ทำงานด้วยแบตเตอรี่ Litieum ion ใช้งานได้นานถึง 350 ชม.</p>','<p>ขนาดภาพ(สูงสุด) : 4112×3088 ขนาดภาพ(เล็กสุด) : 1536×1536<br>OpticalZoom(X) : 3.1 DigitalZoom(X) : 6.2<br>ขนาดจอ(นิ้ว) : 3 ความละเอียดจอ(พิกเซล) : 921,000<br>ช่องมองภาพ : Electronics<br>ประเภทการ์ด : SD CARD/SDHC/SDXC<br>ความเร็วชัตเตอร์ : 1/1600<br>VDOFileFormat : AVCHD/MP4<br>ขนาดMovieClip : UHD 4K/FULL HD<br>FrameRate : 40 FPS<br>ระยะเวลาสูงสุดในการบันทึก(นาที) : 4</p>',1.00,1.00,1.00,1.00,22000.00,4,4,'',1,'2016-09-29 16:05:02','2016-10-10 09:27:43',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(53,NULL,NULL,22,32,'CZ1610000032','133223','CONCORD	0320054','','','<p>ที่สุดกับการออกแบบด้วยวัสดุคุณภาพเยี่ยม จึงเป็นนาฬิกาที่ดีที่สุดสำหรับคุณ<br>ตัวเรือนนาฬิกาผลิตจาก Titanium and Rubber<br>หน้าปัดนาฬิกาสี Black<br>สายนาฬิกาผลิตจาก Silicone<br>หน้าปัดขนาด 45 mm<br>หน้าจอ Anti reflective sapphire ทนทานต่อรอยขีดข่วน<br>ระบบ Swiss automatic พร้อมกันน้ำได้ 200 m.</p>','',NULL,NULL,NULL,NULL,714500.00,4,4,'',1,'2016-10-06 10:53:13','2016-10-17 13:27:32',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(54,NULL,NULL,22,32,'CZ1610000033','4423','DIOR CD1245E9C001','เพชรแท้ เครื่อง AUTOMATIC CERAMIC ทั้งเรือน (38MM)','','<p>ซีรีย์ DIOR VIII รุ่นใหม่เอี่ยมชนช๊อป </p><p>ตัวเรือนทำจาก Ceramic กระจกทำจาก Sapphire<br>พูดง่ายๆเลยว่าใส่เรือนนี้ไม่มีทางเป็นรอยค่ะ อยู่ยงคงกระพัน</p><p><em>\"Striking, elegant and timeless, Dior VIII is reminiscent of the emblematic ‘Bar’ tailored jacket. As if to further accentuate Monsieur Dior’s favourite number, its name recalls the date the fashion house was created on 8th October 1946, the name of his first collection named ‘En Huit’ or the 8th arrondissement of Paris where the Dior house was founded on Avenue Montaigne\"</em></p><p>ขนาดหน้าปัด 38 มิลลิเมตร<br>กระจกหน้าปัด Anti-Reflective Sapphire Crystal<br>วัสดุตัวเรือน High-Tech Ceramic สีขาว<br>วัสดุสาย High-Tech Ceramic สีขาว<br>ความกว้างสาย 17 มิลลิเมตร<br>สีตัวเรือนและสายสีขาว<br>ประดับด้วยเพชรแท้ล้อมรอบด้านนอกและใน <br>หน้าปัดทำจาก Mother of Pearls<br>เครื่อง Automatic Movement<br>เก็บพลังงานได้นาน 38 ชั่วโมง<br>กันน้ำ 50 เมตร<br>ผลิตที่ Switzerland</p>','',NULL,NULL,NULL,NULL,556000.00,4,4,'',1,'2016-10-06 10:55:44','2016-10-17 13:27:45',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(85,9,NULL,29,38,'IN309ELAA1OEDEANTH-3649873','','Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)  ',' Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)  ','<p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ลำโพง ที่สะดวกต่อการพกพา สามารถเชื่อมต่อผ่านระบบ Bluetooth ไร้สาย และยังสามารถใช้ในระบบ Radio และ SD player อีกด้วย ลำโพง Bluetooth Radio with SD player มาพร้อมกับคุณภาพเสียงที่น่าประทับใจ ข้อมูลจำเพาะ - Bluetooth V2.1 - ระยะทาง 10 เมตร - ความจุแบตเตอรี่ 520 mA - ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) - เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br></p>','<p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">nnotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ลำโพง ที่สะดวกต่อการพกพา สามารถเชื่อมต่อผ่านระบบ Bluetooth ไร้สาย และยังสามารถใช้ในระบบ Radio และ SD player อีกด้วย ลำโพง Bluetooth Radio with SD player มาพร้อมกับคุณภาพเสียงที่น่าประทับใจ ข้อมูลจำเพาะ - Bluetooth V2.1 - ระยะทาง 10 เมตร - ความจุแบตเตอรี่ 520 mA - ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) - เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เชื่อมต่อผ่านโทรศัพท์ที่มี Bluetooth </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ฟังวิทยุ FM.ได้ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เสียบ USB.ฟังเพลงได้ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- รองรับ Micro SD Card </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ฟังเพลงจากมือถือ โดยเชื่อมผ่านบลูทูธ และสนทนาโทรศัพท์ได้</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ข้อมูลจำเพาะ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Bluetooth V2.1 </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ระยะทาง 10 เมตร </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความจุแบตเตอรี่ 520 mA </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br></p>','<ul><li>เชื่อมต่อแบบไร้สายได้ทุกอุปกรณ์</li><li>เสียง BASS แน่น พร้อมรับวิทยุได้ในตัว</li><li>รองรับการใช้งาน Handfree จากโทรศัพท์</li><li>รองรับ Micro SD Card, TF Card &amp; Flash Drive</li><li>พกพาสะดวก ชาร์จด้วยสาย USB</li></ul>',5.20,11.00,3.30,0.26,NULL,NULL,NULL,'',1,'2016-12-15 09:02:55','2017-01-10 08:33:10','new',150,NULL,'0000-00-00 00:00:00'),
	(86,10,NULL,33,45,'SO911ELAEH28ANTH-681547','asd','Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์ ','Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์ ','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">รสนิยมและไลฟ์สไตล์นั้นเป็นสิ่งแรกที่จะบ่งบอกความเป็นตัวตนของคุณได้เป็นอย่างดี ไม่ว่าจะเป็นการแต่งตัว ทรงผม หรือ accessories ต่างๆ รวมไปถึง สไตล์การฟังเพลง การเลือกใช้หูฟัง ที่มีดีไซน์เข้ากับตัวคุณเอง และ </span><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ก็เป็นหูฟังที่ดี เหมาะสำหรับคนรักดนตรีที่ชื่นชอบการจังหวะที่แข็งแกร่งซึ่งถือว่าเป็นการ ตอบโจทย์คุณได้เป็นอย่างดีเลยทีเดียว </span><br></p>','<p><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\"><span style=\"margin: 0px; padding: 0px;\">คุณสมบัติเด่น</span></span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"></p><ul class=\"ui-listBulleted\" style=\"padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; margin-right: 0px; margin-bottom: 0px; margin-left: 13px;\"><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">หูฟังประเภท On-ear Headphone จาก SONY</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">น้ำหนักเบา สามารถพับได้ ทำให้การฟังเพลงของคุณง่ายขึ้นในทุกๆ ที่</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">Driver Unit ขนาด 30 มม. เพื่อเสียงที่สมดุลและทรงพลัง</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">ทรงพลังด้วยช่วงความถี่ 10–24,000Hz</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">เอียร์คัพบุนวมเพื่อการฟังเพลงที่สบาย</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px;\">มีสีสันให้คุณเลือกมากมายเพื่อไลฟ์สไตล์ของตัวคุณ</li></ul><p><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">รสนิยมและไลฟ์สไตล์นั้นเป็นสิ่งแรกที่จะบ่งบอกความเป็นตัวตนของคุณได้เป็นอย่างดี ไม่ว่าจะเป็นการแต่งตัว ทรงผม หรือ accessories ต่างๆ รวมไปถึง สไตล์การฟังเพลง การเลือกใช้หูฟัง ที่มีดีไซน์เข้ากับตัวคุณเอง และ </span><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ก็เป็นหูฟังที่ดี เหมาะสำหรับคนรักดนตรีที่ชื่นชอบการจังหวะที่แข็งแกร่งซึ่งถือว่าเป็นการ ตอบโจทย์คุณได้เป็นอย่างดีเลยทีเดียว </span><br></p><p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br></span></p><p><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\"><span style=\"margin: 0px; padding: 0px;\">ขนาดลำโพง 30 มม.</span></span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> เป็นหูฟังคาดศรีษะแบบ Sound Monitoring เเละมีขนาดลำโพง 30 มม. ทำให้สามารถเข้าถึงอรรถรสได้ดีกว่าที่เคย เเละ เพื่อให้สะดวกในการใช้งานมากยิ่งขึ้งจึงมีความยาวสาย 1.2 เมตร เเละสามารถใช้ไมค์เป็น small talk ได้อีกด้วย </span><br></p><p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br></span></p><p><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\"><span style=\"margin: 0px; padding: 0px;\">เอียร์คัพบุนวมเพื่อการฟังเพลงที่สบาย</span></span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">เพิ่มความสบายไปอีกขั้นยามที่คุณฟังเพลงกับ </span><span style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px; font-weight: 700;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ที่มาพร้อมกับเอียร์คัพบุนวมช่วยกระชับตัวหูฟังไปกับสรีระของศีรษะคุณ ได้อย่างพอดี นอกจากนี้ให้หูของนิ่มสบาย ไม่เจ็บอีกด้วย </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"></p><p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br></span></p><p><br></p>','<p><span style=\"color: black; font-family: Helvetica, Arial, sans-serif; font-size: large; font-weight: 700;\">tions</span><br></p><p><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Driver Unit : 30mm Dynamic</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Sensitivity : 98 dB/mW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Impedance : 24 Ω</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Frequency Response : 10 - 24,000Hz</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Cord : 1.2m cord (both sides) with In-line Remote and Mic</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Plug : Four-conductor gold-plated L-shaped stereo mini plug</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Weight (Without Cord) : 125g</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"></p>',19.80,15.00,5.20,0.13,NULL,2,2,'',1,'2016-12-15 09:15:41','2017-01-10 08:47:49','approve',152,5,'2016-12-23 10:21:15'),
	(87,11,NULL,22,32,'CA182FAAST1MANTH-1296247','8i8i8i8i8i8i8','Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส',' รุ่น MTP-E301D-7B1VDF ','<h1 id=\"prod_title\" style=\"margin-top: 0px; margin-bottom: 5px; padding: 0px; font-size: 24px; line-height: 26px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF </h1>','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- วัสดุตัวเรือน / กรอบ: สเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ล็อคพับสามทบและกดเพียงครั้งเดียวเพื่อล็อค</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- สายสเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กระจกมิเนอรัล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กันน้ำลึก 50 เมตร</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- บอกเวลาปกติแบบทั่วไป</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">อะนาล็อก: 3 เข็ม (ชั่วโมง นาที วินาที)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">3 หน้าปัด (วันที่ วันในรอบสัปดาห์ เวลา 24 ชั่วโมง)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความแม่นยำ: ?20 วินาทีต่อเดือน</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- อายุการใช้งานแบตเตอรี่ประมาณ: 3 ปีกับถ่านกระดุม SR927SW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ขนาดตัวเรือน : 50.0?38.5?10.6mm</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- น้ำหนักรวม : 132g</span><br></p>','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- วัสดุตัวเรือน / กรอบ: สเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ล็อคพับสามทบและกดเพียงครั้งเดียวเพื่อล็อค</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- สายสเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กระจกมิเนอรัล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กันน้ำลึก 50 เมตร</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- บอกเวลาปกติแบบทั่วไป</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">อะนาล็อก: 3 เข็ม (ชั่วโมง นาที วินาที)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">3 หน้าปัด (วันที่ วันในรอบสัปดาห์ เวลา 24 ชั่วโมง)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความแม่นยำ: ?20 วินาทีต่อเดือน</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- อายุการใช้งานแบตเตอรี่ประมาณ: 3 ปีกับถ่านกระดุม SR927SW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ขนาดตัวเรือน : 50.0?38.5?10.6mm</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- น้ำหนักรวม : 132g</span><br></p>',NULL,NULL,NULL,NULL,NULL,2,2,'',1,'2016-12-27 08:57:08','2017-01-10 08:53:57','approve',154,1,'2016-12-27 09:03:02'),
	(91,9,NULL,34,33,'UN355FAAA59R5HANTH-11384925','k9k9k9k9',' New Hot Men\'s Fashion Slim Fit Stylish Casual Dress corduroy Suit Blazer Coats Jackets (Khaki)  ',' New Hot Men\'s Fashion Slim Fit Stylish Casual Dress corduroy Suit Blazer Coats Jackets (Khaki)  ','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2016-12-27 13:19:01','2017-01-10 08:58:22','approve',162,1,'2016-12-27 16:15:11'),
	(93,NULL,NULL,32,12,'DR553HBAQBJUANTH-1141958','P0001','DR.JILL G5 ESSENCEเอสเซ้นส์น้ำนมเข้มข้นด๊อกเตอร์จิล30ml. (2ขวด)','','<ul><li>เอสเซ้นส์น้ำนมเข้มข้นประสิทธิภาพสูง</li><li>มอบความสมดุลให้ผิวเรียบเนียน</li><li>คืนความกระชับยืดหยุ่น</li><li>ผิวขาวกระจ่างใส</li><li>ลดเลือนริ้วรอยเสมือนผิวกำเนิดใหม่</li></ul>','<h2>Product details of DR.JILL G5 ESSENCEเอสเซ้นส์น้ำนมเข้มข้นด๊อกเตอร์จิล30ml. (2ขวด)</h2>DR.JILL G5 ESSENCEเอสเซ้นส์น้ำนมเข้มข้นด๊อกเตอร์จิล30ml. (2ขวด)<p><br><br>Dr.JILL G5 Essenceเอสเซ้นส์น้ำนมเข้มข้นประสิทธิภาพสูง บางเบา ซึมซาบสู่ผิวได้อย่างง่ายดาย<br>ทำให้คุณได้รับผลลัพธ์ที่รวดเร็วและมองเห็นได้อย่างชัดเจน ผสมผสานสารสำคัญMoisturizer Complexให้ได้สูตรที่มีประสิทธิภาพสูงสุด เพื่อให้คุณได้ครอบครองผิวที่ดูอ่อนเยาว์ ดุจวัยแรกเริ่ม5 EGF (Epidermis Growth Factors)นวัตกรรมล่าสุดเพื่อการบำรุงผิวระดับเซลล์Essenceน้ำนมเข้มข้นประสิทธิภาพสูงแต่มีเนื้อสัมผัสบางเบา สามารถซึมซาบสู่ผิวแก้ไขปัญหาผิวทั้ง5ประการได้อย่างรวดเร็ว<br>เพียงคืนแรกรู้สึกได้ทันทีว่าหน้านุ่ม ชุ่มชื้น ดูกระจ่างใสขึ้นอย่างเห็นได้ชัดROSE EGFมอบความชุ่มชื้น ให้ผิวเนียนเรียบ กระจ่างใส ลดเลือนริ้วรอย พร้อมทั้งคืนความอ่อนเยาว์ให้กับผิวหน้าได้อย่างมีประสิทธิภาพDr.JILL G5 ESSENCE จากการวิจัยของประเทศเยอรมันสู่Essenceที่แพทย์ผู้ใช้จริงแนะนำCENTELLA EGFเป็นสารAntioxidantที่ช่วยกระตุ้นการไหลเวียนโลหิตสมานแผล ลดการอักเสบ และช่วยให้การฟื้นฟูสภาพผิวเร็วขึ้น<br>หนึ่งในส่วนประกอบที่สำคัญของ Dr.JILL G5 ESSENCE จากการวิจัยของประเทศเยอรมันสู่Essenceที่แพทย์ผู้ใช้จริงแนะนำ<br>คุณค่าจากGrape EGFที่มีอยู่ในDr.JILL G5 ESSENCEเป็นส่วนประกอบสำคัญที่ช่วยในการปกป้องผิวของคุณจากอันตรายของแสงแดดในแต่ละวันช่วยให้เซลล์มีความแข็งแรงมากยิ่งขึ้นกว่าเดิม<br>จึงสามารถปกป้องผิวจากการรบกวนของมลภาวะในสิ่งแวดล้อม ที่อาจก่อให้เกิดการระคายเคืองต่อผิว<br>พร้อมทั้งฟื้นฟูเซลล์ผิวให้กลับมาทำงานได้อย่างมีประสิทธิภาพมากยิ่งขึ้น<br></p><p>อีกหนึ่งส่วนประกอบสำคัญของ Dr.JILL, Docter Solution G5 Essenceที่มีส่วนช่วยในการลดเลือนริ้วรอยแห่งวัยRGAN EGF (ARGAN Epidermis Growth Factors)</p>','<h2>ข้อมูลจำเพาะของ DR.JILL G5 ESSENCEเอสเซ้นส์น้ำนมเข้มข้นด๊อกเตอร์จิล30ml. (2ขวด)</h2><span class=\"product-subheader__element\">รายการสินค้าในกล่อง</span><ul><li>DR.JILL G5 ESSENCEเอสเซ้นส์น้ำนมเข้มข้นด๊อกเตอร์จิล30ml. (2ขวด)</li></ul><p>คุณสมบัติทั่วไป</p><table class=\"specification-table\"><tbody><tr><td>SKU</td><td>DR553HBAQBJUANTH-1141958</td></tr><tr><td>โมเดล</td><td>Skinfinity-Drjill_02</td></tr><tr><td>Size (cm)</td><td>2 x 2 x 14</td></tr><tr><td>Weight (kg)</td><td>0.3</td></tr><tr><td>Warranty type</td><td>ไม่มีการรับประกัน</td></tr></tbody></table>',2.00,2.00,14.00,0.30,1690.00,4,NULL,'',1,'2017-01-06 13:48:56','2017-01-06 13:48:56',NULL,NULL,NULL,'0000-00-00 00:00:00'),
	(96,1,NULL,22,42,'Ga-100B-4Adr','434343434','Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red)  ','Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red)  ','<p>นาฬิกา ถือได้ว่าเป็นเครื่องประดับที่หลายๆ คนชื่นชอบและมักจะพกติดตัวเสมอ ทั้งใส่เอาไว้ใช้ดูเวลาหรือใส่เพื่อช่วยเสริมสร้างบุคลิกและเสน่ห์ก็ได้ คุณจะไม่พลาดทุกการนัดหมายด้วย Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red) นาฬิกาที่จะทำให้คุณดูดี และมีบุคลิกที่ทันสมัยอยู่ตลอดเวลา ต่อจากนี้นาฬิกาจะไม่ใช่แค่เครื่องดูเวลาอีกต่อไป แต่ยังจะเป็นเครื่องประดับที่บ่งบอกถึงรสนิยมอันมีระดับของคุณได้อีกด้วย</p>','<p>ดีไซน์ทันสมัย<br>Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red) ที่จะเนรมิตให้คุณดูมีบุคลิกที่ดี โดดเด่นได้อย่างมีสไตล์ในแบบของคุณ มาพร้อมดีไซน์ทันสมัย เเละใช้งานอย่างลงตัว พร้อมให้คุณออกไปใช้ชีวิตข้างนอกบ้านได้อย่างราบรื่น เเละมีสีสัน และยังคงคอนเซ็ปต์ตามแนวทางของคุณได้เป็นอย่างดี<br></p><p><br></p><p>แมตช์ได้กับทุกสไตล์<br>Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red) มาพร้อมฟังก์ชั่นการใช้งานอย่างลงตัว พร้อมให้คุณมีสไตล์ได้ทุกวันทุกเวลานอกจากจะมีดีไซน์ที่ดูโดดเด่นอย่างลงตัวเเล้วนั้น ยังเป็นนาฬิกาที่สามารถใส่เข้ากับสไตล์ของคุณได้อย่างง่ายดาย และยังสามารถใส่ได้ทุกโอกาสตามที่คุณต้องการ<br></p>','<p>คุณสมบัติเด่น</p><ul><li>นาฬิกาข้อมือสุดคูลรุ่นดัง G-Shock จากแบรนด์ CASIO</li><li>เหมาะกับคุณผู้ชาย</li><li>สายเรซิน สีแดงสดใส</li><li>วัสดุตัวเรือน/กรอบ : เรซิน</li><li>ประกอบไปด้วย 3 หน้าปัดโดยหน้าปัดตรงกลางเป็นกลไกอะนาล็อกส่วนหน้าปัดย่อยด้านข้าง 2 หน้าปัดเป็นแบบดิจิตอล</li><li>ระบบกันน้ำลึกถึง 200 เมตร หรือ 20 ATM</li><li>กระจกมิเนอรัล</li><li>ทนทานต่อแรงสั่นสะเทือนและคลื่นแม่เหล็ก</li><li>ไฟ LED</li><li>แสดงเวลาโลก</li></ul><p>ข้อมูลจำเพาะ<br><br>- Shock resistant (G-SHOCK)<br>- Magnetic resistant ทนต่อคลื่นแม่เหล็ก<br>- ไฟ Auto LED<br>- World time แสดงเวลา 29 time zones (48 เมืองสำคัญทั่วโลก)<br>- จับเวลา 1/1000 วินาที - 100 ชั่วโมง<br>- กำหนดระยะทาง 0-99.99km/mile<br>- แสดงความเร็วเฉลี่ยต่อชั่วโมง<br>- จับเวลาถอยหลัง 1 นาที - 24 ชั่วโมง<br>- ตั้งปลุก 5 ครั้งต่อวัน พร้อมระบบ snooze alarm<br>- เสียงเตือนทุกๆชั่วโมง<br>- ปฏิทินอัตโนมัติ (ถึงปี 2099)<br>- แสดงเวลา 12/24 ชั่วโมง<br>- อายุแบตเตอรรี่ประมาณ 2 ปี<br>- ขนาดตัวเรือน (ยาว x กว้าง x หนา) 55.0 X 51.2 X 16.9 mm<br>- น้ำหนักรวม 70 g</p>',51.20,55.00,16.90,70.00,2969.00,NULL,NULL,'',1,'2017-01-11 09:31:44','2017-01-11 09:31:44',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_group`;

CREATE TABLE `product_group` (
  `productGroupId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productGroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_group` WRITE;
/*!40000 ALTER TABLE `product_group` DISABLE KEYS */;

INSERT INTO `product_group` (`productGroupId`, `title`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'MAC รุ่น 1','',1,'2016-09-27 08:46:12','2016-09-27 08:46:12'),
	(2,'test','<p>test</p>',1,'2016-11-21 09:20:16','2016-11-21 09:20:16');

/*!40000 ALTER TABLE `product_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_hot
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_hot`;

CREATE TABLE `product_hot` (
  `productHotId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) unsigned NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productHotId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_hot` WRITE;
/*!40000 ALTER TABLE `product_hot` DISABLE KEYS */;

INSERT INTO `product_hot` (`productHotId`, `productId`, `price`, `startDate`, `endDate`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(2,8,1000.00,'2016-09-01 00:00:00','2016-10-28 00:00:00',1,'2016-09-23 14:39:50','2016-10-03 09:27:01'),
	(3,3,199.00,'2016-09-23 00:00:00','2016-10-28 00:00:00',1,'2016-09-23 14:40:32','2016-10-03 09:27:09'),
	(4,4,199.00,'2016-09-23 00:00:00','2016-10-28 00:00:00',1,'2016-09-23 14:46:01','2016-10-03 09:27:17'),
	(5,5,199.00,'2016-09-23 00:00:00','2016-09-30 00:00:00',1,'2016-09-23 14:53:01','2016-09-23 14:53:01'),
	(6,32,1000.00,'2016-09-28 00:00:00','2016-10-31 00:00:00',1,'2016-09-28 11:18:29','2016-09-28 11:18:57');

/*!40000 ALTER TABLE `product_hot` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_image
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_image`;

CREATE TABLE `product_image` (
  `productImageId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL COMMENT 'รูปใหญ่ขนาด 553 x 484 “images/ProductImage/”\n',
  `imageThumbnail1` varchar(255) DEFAULT NULL COMMENT 'ขนาด 356 x 390 “images/ProductImage/thumbnail1”\n',
  `imageThumbnail2` varchar(255) DEFAULT NULL COMMENT ' รูปเล็กขนาด 137 x 130 “images/ProductImage/thumbnail2”\n',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productImageId`),
  KEY `fk_pi_to_p_idx` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;

INSERT INTO `product_image` (`productImageId`, `productId`, `title`, `description`, `image`, `imageThumbnail1`, `imageThumbnail2`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,' Lipstick','<p>THE HISTORY OF WHOO Mi 25 Coral Lipstick</p>','images/ProductImage/_UQkZMkaKy.jpg','images/ProductImage/thumbnail1/xpDYW5nSZa.jpg','images/ProductImage/thumbnail2/welbG1Pf5U.jpg',1,'2016-08-30 11:39:32','2016-09-26 08:13:26'),
	(2,2,'LIPSTICK','','images/ProductImage/-rwTXhmdqd.jpg','images/ProductImage/thumbnail1/dq5nNEDg4p.jpg','images/ProductImage/thumbnail2/QD8NxbXOSd.jpg',1,'2016-08-30 11:41:38','2016-09-26 07:41:18'),
	(3,3,'NARS','','images/ProductImage/7HWNqvnb_J.jpg','images/ProductImage/thumbnail1/aN4EufOyvR.jpg','images/ProductImage/thumbnail2/ClBg_Df9U0.jpg',1,'2016-08-30 13:05:28','2016-09-26 07:43:32'),
	(4,4,'NAKED','','images/ProductImage/1cSKsnxt7A.jpg','images/ProductImage/thumbnail1/VE0VaWpEFg.jpg','images/ProductImage/thumbnail2/PVg_PoigvU.jpg',1,'2016-08-30 13:10:24','2016-09-26 07:45:19'),
	(5,5,'Clinique','','images/ProductImage/U_VrA652oy.jpg','images/ProductImage/thumbnail1/5n-VRF8wcu.jpg','images/ProductImage/thumbnail2/NqnpC7jnFV.jpg',1,'2016-08-30 13:13:07','2016-09-26 10:10:49'),
	(6,6,'NARS','','images/ProductImage/M6lUizsjBE.jpg','images/ProductImage/thumbnail1/cUzdgqVKOR.jpg','images/ProductImage/thumbnail2/Dwc73ndqiK.jpg',1,'2016-08-30 13:16:01','2016-09-26 07:48:54'),
	(8,8,'Estée Lauder','','images/ProductImage/074oynlUtF.jpg','images/ProductImage/thumbnail1/eaHpFVA06v.jpg','images/ProductImage/thumbnail2/1mt8C_MGV_.jpg',1,'2016-08-30 13:21:18','2016-09-26 08:26:05'),
	(10,7,'Clinique','','images/ProductImage/VjTwRyhNMU.jpg','images/ProductImage/thumbnail1/WIgwg_fJmK.jpg','images/ProductImage/thumbnail2/CUcOhg6-lO.jpg',1,'2016-08-30 15:44:12','2016-09-26 09:11:09'),
	(11,9,'โลชั่นเช็ดผิว Clarifying','','images/ProductImage/v1j0t0I9O9.jpg','images/ProductImage/thumbnail1/ftdqlo9xKf.jpg','images/ProductImage/thumbnail2/TU9iCbvyUp.jpg',1,'2016-09-09 08:57:13','2016-09-15 10:31:32'),
	(12,10,'BIOTHERM','','images/ProductImage/jwkW_9a2N-.jpg','images/ProductImage/thumbnail1/IkPmicNL9E.jpg','images/ProductImage/thumbnail2/lCazyrsH92.jpg',1,'2016-09-09 09:45:00','2016-09-15 10:31:44'),
	(13,11,'LAMER','','images/ProductImage/ZkqVvYAs9n.jpg','images/ProductImage/thumbnail1/i0kGIjwr1l.jpg','images/ProductImage/thumbnail2/wtWvB66Kvd.jpg',1,'2016-09-09 10:03:46','2016-09-26 09:22:30'),
	(14,12,'PAYOT ','<p>PAYOT Perform Lift Regard ดูแลผิวรอบดวงตาของคุณด้วยผลิตภัณฑ์ที่ช่วยบำรุงและกระชับผิวรอบดวงตา ช่วยลดเลือนริ้วรอย ความหมองคล้ำ พร้อมเผยผิวรอบดวงตาที่เรียบเนียน</p>','images/ProductImage/5iXUzcaFz6.jpg','images/ProductImage/thumbnail1/K2hr6CKAU0.jpg','images/ProductImage/thumbnail2/rQbNf5ELIw.jpg',1,'2016-09-13 10:13:35','2016-09-15 10:36:42'),
	(16,15,'LAMER','<p>ต้นกำเนิดจากท้องทะเล ผลิตภัณฑ์อันเป็นตำนานที่อุดมด้วยคุณค่าแห่งการฟื้นบำรุงผิวจากธรรมชาติ ช่วยให้เส้นริ้วและริ้วรอยลดเลือนลง ผิวแลดูกระชับ รูขุมขนดูจางลง ผิวแลดูอ่อนเยาว์ขึ้น ด้วยส่วนผสมทรงประสิทธิภาพช่วยฟื้นบำรุงได้แม้กระทั่งผิวที่แห้งที่สุด ช่วยให้ผิวสดใส แลดูอ่อนเยาว์ ด้วยคุณค่าจากสารอาหารมากมายที่มีอยู่ในน้ำสกัดเข้มข้น Miracle Broth™</p>','images/ProductImage/MvjeqRxdPE.jpg','images/ProductImage/thumbnail1/oNOr3rOIXY.jpg','images/ProductImage/thumbnail2/hbENPiyUPU.jpg',1,'2016-09-13 10:22:51','2016-09-15 10:37:44'),
	(17,16,'BIOTHERM ','','images/ProductImage/QcQeQVEZaB.jpg','images/ProductImage/thumbnail1/8-sEsp7d8X.jpg','images/ProductImage/thumbnail2/gXsm_FcCX_.jpg',1,'2016-09-13 11:43:18','2016-09-26 08:16:39'),
	(18,17,'SK-II ','','images/ProductImage/Hp9q_w6OwP.jpg','images/ProductImage/thumbnail1/OSXMvFyY4_.jpg','images/ProductImage/thumbnail2/y17NrIY8cJ.jpg',1,'2016-09-13 11:46:34','2016-09-15 10:38:27'),
	(19,19,'LANCOME','','images/ProductImage/KGoVm-PZlF.jpg','images/ProductImage/thumbnail1/sq0gGpP8Fx.jpg','images/ProductImage/thumbnail2/k7l1Z0y2lc.jpg',1,'2016-09-13 11:49:58','2016-09-26 08:19:26'),
	(20,20,'BIOTHERM','','images/ProductImage/DptG4x7UUT.jpg','images/ProductImage/thumbnail1/aKMKexf0Pi.jpg','images/ProductImage/thumbnail2/yBiFG6Kan1.jpg',1,'2016-09-14 09:00:54','2016-09-26 08:15:26'),
	(21,22,'PAYOT','<p>PAYOT Perform Sculpt Nuit ทรีทเม้นท์การปรับรูปหน้าและคืนความกระชับให้กับผิวหน้าของคุณ ให้คุณตื่นมาพร้อมผิวที่กระชับดูอ่อนเยาว์ ดุจนักปั้นผิวมืออาชีพ ผลิตภัณฑ์ทางเลือกนอกเหนือจากการศัลยกรรม</p>','images/ProductImage/jLcd5pwdqh.jpg','images/ProductImage/thumbnail1/4fozXwbXE2.jpg','images/ProductImage/thumbnail2/aXN36nKZwL.jpg',1,'2016-09-14 09:03:36','2016-09-26 08:23:01'),
	(22,23,'Clinique','','images/ProductImage/P7ISM7vOgt.png','images/ProductImage/thumbnail1/wtYv--Le54.png','images/ProductImage/thumbnail2/X_GLWcfyEs.png',1,'2016-09-14 09:07:21','2016-09-14 09:07:21'),
	(23,24,'Clinique','','images/ProductImage/M6Y9rw2biq.jpg','images/ProductImage/thumbnail1/Q2XR8D1rol.jpg','images/ProductImage/thumbnail2/IW46O3hPWd.jpg',1,'2016-09-14 09:46:50','2016-09-26 08:28:06'),
	(24,26,'Mac','','images/ProductImage/i7JJXAzwz-.jpg','images/ProductImage/thumbnail1/hMomrDvYyW.jpg','images/ProductImage/thumbnail2/p59kMhLDVc.jpg',1,'2016-09-16 10:28:01','2016-09-26 08:33:20'),
	(25,27,'Mac','','images/ProductImage/WBJ0WeGQjz.jpg','images/ProductImage/thumbnail1/H4WUtHdoO_.jpg','images/ProductImage/thumbnail2/ExJAsd8jGg.jpg',1,'2016-09-16 10:30:45','2016-09-16 10:33:27'),
	(26,28,' LANEIGE','','images/ProductImage/yY5LiAjh_d.jpg','images/ProductImage/thumbnail1/oshC7-lVhd.jpg','images/ProductImage/thumbnail2/AQtKZbv9O4.jpg',1,'2016-09-19 10:16:50','2016-09-26 09:26:39'),
	(27,19,'LANCOME','','images/ProductImage/w2_3G4xVFq.jpg','images/ProductImage/thumbnail1/N_RdDtmQFU.jpg','images/ProductImage/thumbnail2/3WKV6GHsqU.jpg',1,'2016-09-19 10:19:41','2016-09-26 07:58:33'),
	(28,29,'LANCOME','','images/ProductImage/_rcKIuDjaA.jpg','images/ProductImage/thumbnail1/LT3H_fQXrR.jpg','images/ProductImage/thumbnail2/EVa1XukNEK.jpg',1,'2016-09-19 10:20:37','2016-09-19 10:20:37'),
	(29,30,'Mac','','images/ProductImage/oJzQRzJpGw.jpg','images/ProductImage/thumbnail1/nvS9NLa71b.jpg','images/ProductImage/thumbnail2/T-KN1XaQqW.jpg',1,'2016-09-19 10:22:54','2016-09-26 09:02:23'),
	(30,31,'Clinique','','images/ProductImage/O_eEPg1AL3.jpg','images/ProductImage/thumbnail1/TxmEtSKIVg.jpg','images/ProductImage/thumbnail2/ohps_uXwxv.jpg',1,'2016-09-19 10:25:01','2016-09-19 10:25:01'),
	(31,32,'LANEIGE','','images/ProductImage/brovp80Gyy.jpg','images/ProductImage/thumbnail1/4gyDmzixM7.jpg','images/ProductImage/thumbnail2/3c0leI4erj.jpg',1,'2016-09-19 10:27:52','2016-09-26 08:58:20'),
	(32,33,'Clinique','','images/ProductImage/Vk_LpsG3e3.jpg','images/ProductImage/thumbnail1/rMJaw-ffUs.jpg','images/ProductImage/thumbnail2/RVGn2ZWc5B.jpg',1,'2016-09-19 10:31:08','2016-09-19 10:31:08'),
	(33,34,'GIORGIO','','images/ProductImage/Tt9BCEAm64.jpg','images/ProductImage/thumbnail1/rzHT_A-8Eq.jpg','images/ProductImage/thumbnail2/wHE2xFoSRw.jpg',1,'2016-09-20 09:38:48','2016-11-06 19:51:02'),
	(34,35,'LACOSTE','','images/ProductImage/6CS8cxi-LO.jpg','images/ProductImage/thumbnail1/q8YEKCRQW_.jpg','images/ProductImage/thumbnail2/scqbKR3Bgl.jpg',1,'2016-09-22 15:35:57','2016-10-07 11:42:28'),
	(35,36,'COACH','','images/ProductImage/84uXBL44kB.jpg','images/ProductImage/thumbnail1/36Jb1SKnrf.jpg','images/ProductImage/thumbnail2/07MYV_QXnc.jpg',1,'2016-09-22 15:43:22','2016-10-07 09:09:40'),
	(36,37,'LeSportsac','','images/ProductImage/wpsTe-fLYg.jpg','images/ProductImage/thumbnail1/Mdoo8LWzql.jpg','images/ProductImage/thumbnail2/xSZKZbWyou.jpg',1,'2016-09-22 15:49:17','2016-10-07 11:43:56'),
	(37,38,'MAC Lipstick / Star Trek Pink','<p>44444</p>','images/ProductImage/K808bnTWzM.jpg','images/ProductImage/thumbnail1/NECEDkmp6W.jpg','images/ProductImage/thumbnail2/6hS38KAowM.jpg',1,'2016-09-27 08:51:07','2016-09-27 08:51:07'),
	(38,39,'a','','images/ProductImage/l6T3zYqKWf.png','images/ProductImage/thumbnail1/dvv8P6RM6J.png','images/ProductImage/thumbnail2/7y4Le3-t8C.png',1,'2016-09-29 10:04:25','2016-09-29 10:04:25'),
	(39,40,'BALLY GROSVENOR','','images/ProductImage/eErNXzGVCN.jpg','images/ProductImage/thumbnail1/aGC_zVhNqz.jpg','images/ProductImage/thumbnail2/1qU-2335gl.jpg',1,'2016-09-29 15:00:15','2016-10-07 09:05:48'),
	(40,41,'BOLON FP 0216','','images/ProductImage/iV9oOlgX7Z.jpg','images/ProductImage/thumbnail1/sUNPzB5Izp.jpg','images/ProductImage/thumbnail2/C3Q03hMp6p.jpg',1,'2016-09-29 15:04:02','2016-10-07 08:53:57'),
	(41,42,'COACH FN 55 PUR','','images/ProductImage/0u8EM_I6QM.jpg','images/ProductImage/thumbnail1/5PfoAAE5VW.jpg','images/ProductImage/thumbnail2/Qeuw1x9IOm.jpg',1,'2016-09-29 15:07:49','2016-10-07 08:56:37'),
	(42,43,'CASIO BABY-G BGA-210-7B3DR','','images/ProductImage/6MKoSvzL1R.jpg','images/ProductImage/thumbnail1/0D_Q4sJpBq.jpg','images/ProductImage/thumbnail2/lOej_PjIfX.jpg',1,'2016-09-29 15:19:42','2016-10-06 11:10:44'),
	(43,44,'COACH Boyfriend','','images/ProductImage/5z0cwZ66SI.jpg','images/ProductImage/thumbnail1/f2_voL8jXN.jpg','images/ProductImage/thumbnail2/XNeqJ1Tg5W.jpg',1,'2016-09-29 15:22:51','2016-10-06 11:15:32'),
	(44,45,'LACOSTE L.12.12 POLO','','images/ProductImage/Krl1JfQzSH.jpg','images/ProductImage/thumbnail1/Ck0zVCefi-.jpg','images/ProductImage/thumbnail2/hxkrJN0-_4.jpg',1,'2016-09-29 15:29:08','2016-10-07 11:31:36'),
	(45,46,'LACOSTE The Feminine Lacoste polo in stretch cotton','','images/ProductImage/CoCJcXN-J-.jpg','images/ProductImage/thumbnail1/IvIyiGclWj.jpg','images/ProductImage/thumbnail2/bmyuDsodBH.jpg',1,'2016-09-29 15:31:48','2016-10-07 11:33:29'),
	(46,47,'TOSCOW Sterling Silver Cultured Pearl Stud Earrings','','images/ProductImage/JAzaKwkNtL.jpg','images/ProductImage/thumbnail1/7Cj253Qy3d.jpg','images/ProductImage/thumbnail2/Qs6ywZfRhl.jpg',1,'2016-09-29 15:36:22','2016-10-07 11:39:53'),
	(47,48,' SWAROVSKI SWAN BANGLE','','images/ProductImage/slssWYafDn.jpg','images/ProductImage/thumbnail1/Xf-PsVISX-.jpg','images/ProductImage/thumbnail2/ES4RLovuEU.jpg',1,'2016-09-29 15:41:48','2016-10-07 11:37:31'),
	(48,49,'SENNHEISER Black Momentum On-Ear+CD','','images/ProductImage/BfrCxPlSyv.jpg','images/ProductImage/thumbnail1/TeIYL5_caR.jpg','images/ProductImage/thumbnail2/8clIFg14jU.jpg',1,'2016-09-29 15:49:46','2016-10-10 09:07:22'),
	(49,50,'SENNHEISER WHI MM30G','','images/ProductImage/GbAUk9ezcc.jpg','images/ProductImage/thumbnail1/r8o15R2Vpv.jpg','images/ProductImage/thumbnail2/97kADoomTj.jpg',1,'2016-09-29 15:55:55','2016-10-10 09:15:17'),
	(50,51,'OLYMPUS E-M10 MII + 14-42mm. - Silver','','images/ProductImage/z818At964e.jpg','images/ProductImage/thumbnail1/YTHuSSq7ge.jpg','images/ProductImage/thumbnail2/V07VlR07Bf.jpg',1,'2016-09-29 16:01:18','2016-10-10 09:19:31'),
	(51,52,'PANASONIC กล้องดิจิตอล LUMIX รุ่น DMC-LX100GCS','','images/ProductImage/rRs5FuFtMu.jpg','images/ProductImage/thumbnail1/qWx-h2fPLo.jpg','images/ProductImage/thumbnail2/faGNaVzKzf.jpg',1,'2016-09-29 16:05:32','2016-10-10 09:24:02'),
	(52,53,'aaaa','','images/ProductImage/AB3vF-xSAW.jpg','images/ProductImage/thumbnail1/YP-NjTmXxa.jpg','images/ProductImage/thumbnail2/NP-V9zfQPk.jpg',1,'2016-10-07 08:36:52','2016-10-07 08:38:52'),
	(53,53,'bbbb','','images/ProductImage/H3iyQ0sOrV.jpg','images/ProductImage/thumbnail1/7QVasHbuKo.jpg','images/ProductImage/thumbnail2/iUklypCIXW.jpg',1,'2016-10-07 08:41:07','2016-10-07 08:41:46'),
	(54,54,'aaaa','','images/ProductImage/pWFZzJswIs.jpg','images/ProductImage/thumbnail1/-WDT08VUf1.jpg','images/ProductImage/thumbnail2/4HmZmsG-SU.jpg',1,'2016-10-07 08:45:12','2016-10-07 08:45:12'),
	(55,54,'bbbb','','images/ProductImage/_Uk8q4ALMI.jpg','images/ProductImage/thumbnail1/zMwu2w_BpQ.jpg','images/ProductImage/thumbnail2/yC40isxE-a.jpg',1,'2016-10-07 08:46:38','2016-10-07 08:46:38'),
	(56,55,'cc','<p>cc</p>','images/ProductImage/hOhr268ByM.png','images/ProductImage/thumbnail1/5uAHVhD0w6.png','images/ProductImage/thumbnail2/_pKuZD69lz.png',1,'2016-11-21 09:25:58','2016-11-21 09:25:58'),
	(57,55,'ccc','<p>ccc</p>','images/ProductImage/NO-NdOaEk2.png','images/ProductImage/thumbnail1/3OlagWMw_l.png','images/ProductImage/thumbnail2/liGiQmY18f.png',1,'2016-11-21 09:26:09','2016-11-21 09:26:09'),
	(58,93,'1','','images/ProductImage/cg895g3X7-.jpg','images/ProductImage/thumbnail1/iqYgOfWKeF.jpg','images/ProductImage/thumbnail2/W86C_RowkW.jpg',1,'2017-01-06 16:03:45','2017-01-06 16:03:45'),
	(59,93,'2','','images/ProductImage/Z2rl9Yp2SX.jpg','images/ProductImage/thumbnail1/0FFaHVk_Wz.jpg','images/ProductImage/thumbnail2/yImHgWGugl.jpg',1,'2017-01-06 16:04:03','2017-01-06 16:04:03'),
	(60,85,'1','','images/ProductImage/YVr6IdzUrd.jpg','images/ProductImage/thumbnail1/wrDMUCv7cJ.jpg','images/ProductImage/thumbnail2/SbiWpDVHr-.jpg',1,'2017-01-10 08:50:37','2017-01-10 08:50:37'),
	(61,86,'1','','images/ProductImage/LeXLsSTBSR.jpg','images/ProductImage/thumbnail1/xyIdrVdoqj.jpg','images/ProductImage/thumbnail2/19EXn-0H0x.jpg',1,'2017-01-10 08:52:14','2017-01-10 08:52:14'),
	(62,87,'1','','images/ProductImage/bClPP4lt6K.jpg','images/ProductImage/thumbnail1/8fisacxRzE.jpg','images/ProductImage/thumbnail2/NOXfMn-mvR.jpg',1,'2017-01-10 08:53:48','2017-01-10 08:53:48'),
	(63,91,'1','','images/ProductImage/B4GE6JiGPl.jpg','images/ProductImage/thumbnail1/iuqJr49QOe.jpg','images/ProductImage/thumbnail2/9rXomPpS66.jpg',1,'2017-01-10 08:55:44','2017-01-10 08:55:44'),
	(64,96,'แมตช์ได้กับทุกสไตล์','','images/ProductImage/LoOnoy3IJ0.jpg','images/ProductImage/thumbnail1/u31B6eKHbb.jpg','images/ProductImage/thumbnail2/FICWpq7Ewy.jpg',1,'2017-01-11 09:34:53','2017-01-11 09:34:53'),
	(65,96,'Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red)','','images/ProductImage/ilrD7ARQv9.jpg','images/ProductImage/thumbnail1/qo8b5f-AZF.jpg','images/ProductImage/thumbnail2/VWh4m_vEqm.jpg',1,'2017-01-11 09:35:22','2017-01-11 09:35:22'),
	(66,96,'Casio G-Shock นาฬิกาข้อมือผู้ชาย รุ่น Ga-100B-4Adr (Red)','','images/ProductImage/g1Ok3c04wL.jpg','images/ProductImage/thumbnail1/7EVy7As2z7.jpg','images/ProductImage/thumbnail2/1mi48ixZFw.jpg',1,'2017-01-11 09:35:36','2017-01-11 09:35:36');

/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_image_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_image_suppliers`;

CREATE TABLE `product_image_suppliers` (
  `productImageId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productSuppId` bigint(20) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `original_name` varchar(500) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'รูปใหญ่ขนาด 553 x 484 “images/ProductImage/”\n',
  `imageThumbnail1` varchar(255) DEFAULT NULL COMMENT 'ขนาด 356 x 390 “images/ProductImage/thumbnail1”\n',
  `imageThumbnail2` varchar(255) DEFAULT NULL COMMENT ' รูปเล็กขนาด 137 x 130 “images/ProductImage/thumbnail2”\n',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `ordering` tinyint(4) DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productImageId`),
  KEY `fk_pi_to_p_idx` (`productSuppId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_image_suppliers` WRITE;
/*!40000 ALTER TABLE `product_image_suppliers` DISABLE KEYS */;

INSERT INTO `product_image_suppliers` (`productImageId`, `productSuppId`, `title`, `description`, `original_name`, `image`, `imageThumbnail1`, `imageThumbnail2`, `status`, `ordering`, `createDateTime`, `updateDateTime`)
VALUES
	(160,111,'',NULL,NULL,'images/ProductImageSuppliers/vVbJSsKxXf169aiwB5nCQDVE0jnb4sBp.png','images/ProductImageSuppliers/thumbnail1/vVbJSsKxXf169aiwB5nCQDVE0jnb4sBp.png','images/ProductImageSuppliers/thumbnail2/vVbJSsKxXf169aiwB5nCQDVE0jnb4sBp.png',1,NULL,'2016-12-01 13:37:10','2016-12-01 13:37:10'),
	(161,111,'',NULL,NULL,'images/ProductImageSuppliers/fdaM9Mnu-FMDiQEQBAuocgPBEGEbfmbz.png','images/ProductImageSuppliers/thumbnail1/fdaM9Mnu-FMDiQEQBAuocgPBEGEbfmbz.png','images/ProductImageSuppliers/thumbnail2/fdaM9Mnu-FMDiQEQBAuocgPBEGEbfmbz.png',1,NULL,'2016-12-01 13:37:10','2016-12-01 13:37:10'),
	(162,111,'',NULL,NULL,'images/ProductImageSuppliers/hQd45VvYiIW0lDtYjTCP247jLdKdWpkW.png','images/ProductImageSuppliers/thumbnail1/hQd45VvYiIW0lDtYjTCP247jLdKdWpkW.png','images/ProductImageSuppliers/thumbnail2/hQd45VvYiIW0lDtYjTCP247jLdKdWpkW.png',1,NULL,'2016-12-01 13:37:11','2016-12-01 13:37:11'),
	(163,111,'',NULL,NULL,'images/ProductImageSuppliers/LvIAat5NLZWZNJkQmFwujl80TElE9UfL.png','images/ProductImageSuppliers/thumbnail1/LvIAat5NLZWZNJkQmFwujl80TElE9UfL.png','images/ProductImageSuppliers/thumbnail2/LvIAat5NLZWZNJkQmFwujl80TElE9UfL.png',1,NULL,'2016-12-01 13:37:12','2016-12-01 13:37:12'),
	(164,111,'',NULL,NULL,'images/ProductImageSuppliers/u1VYgDUcvQh6QU7g096ecwL6L3joE0Rt.png','images/ProductImageSuppliers/thumbnail1/u1VYgDUcvQh6QU7g096ecwL6L3joE0Rt.png','images/ProductImageSuppliers/thumbnail2/u1VYgDUcvQh6QU7g096ecwL6L3joE0Rt.png',1,NULL,'2016-12-01 13:37:13','2016-12-01 13:37:13'),
	(165,111,'',NULL,NULL,'images/ProductImageSuppliers/BnuFSV2SdWN1UnUvRvJDl_-vLzbHBtEm.jpg','images/ProductImageSuppliers/thumbnail1/BnuFSV2SdWN1UnUvRvJDl_-vLzbHBtEm.jpg','images/ProductImageSuppliers/thumbnail2/BnuFSV2SdWN1UnUvRvJDl_-vLzbHBtEm.jpg',1,NULL,'2016-12-01 13:37:13','2016-12-01 13:37:13'),
	(166,111,'',NULL,NULL,'images/ProductImageSuppliers/c-WkkGe0avO_J84MYhuyFodesEmA_VqG.jpg','images/ProductImageSuppliers/thumbnail1/c-WkkGe0avO_J84MYhuyFodesEmA_VqG.jpg','images/ProductImageSuppliers/thumbnail2/c-WkkGe0avO_J84MYhuyFodesEmA_VqG.jpg',1,NULL,'2016-12-01 13:37:14','2016-12-01 13:37:14'),
	(167,111,'',NULL,NULL,'images/ProductImageSuppliers/SDrD0QmTQHHkiwZvAgYF5grRHvLi5dtm.png','images/ProductImageSuppliers/thumbnail1/SDrD0QmTQHHkiwZvAgYF5grRHvLi5dtm.png','images/ProductImageSuppliers/thumbnail2/SDrD0QmTQHHkiwZvAgYF5grRHvLi5dtm.png',1,NULL,'2016-12-01 13:37:15','2016-12-01 13:37:15'),
	(168,111,'',NULL,NULL,'images/ProductImageSuppliers/mPx2xsYntOtI1_QryIDroLNXqvT4GOMP.jpg','images/ProductImageSuppliers/thumbnail1/mPx2xsYntOtI1_QryIDroLNXqvT4GOMP.jpg','images/ProductImageSuppliers/thumbnail2/mPx2xsYntOtI1_QryIDroLNXqvT4GOMP.jpg',1,NULL,'2016-12-01 13:37:15','2016-12-01 13:37:15'),
	(169,111,'',NULL,NULL,'images/ProductImageSuppliers/Sh9l8sOK7uN4CYZhrE77XlzFmHov0Zh7.jpg','images/ProductImageSuppliers/thumbnail1/Sh9l8sOK7uN4CYZhrE77XlzFmHov0Zh7.jpg','images/ProductImageSuppliers/thumbnail2/Sh9l8sOK7uN4CYZhrE77XlzFmHov0Zh7.jpg',1,NULL,'2016-12-01 13:37:16','2016-12-01 13:37:16'),
	(170,112,'',NULL,NULL,'images/ProductImageSuppliers/iTTBOBaAjIoE7hfExQiUSsOjuqREYzVg.jpg','images/ProductImageSuppliers/thumbnail1/iTTBOBaAjIoE7hfExQiUSsOjuqREYzVg.jpg','images/ProductImageSuppliers/thumbnail2/iTTBOBaAjIoE7hfExQiUSsOjuqREYzVg.jpg',1,NULL,'2016-12-01 13:44:55','2016-12-01 13:44:55'),
	(171,112,'',NULL,NULL,'images/ProductImageSuppliers/0kC32_TZT7lmz5DDPUSWXYqqc-3HBZaD.jpeg','images/ProductImageSuppliers/thumbnail1/0kC32_TZT7lmz5DDPUSWXYqqc-3HBZaD.jpeg','images/ProductImageSuppliers/thumbnail2/0kC32_TZT7lmz5DDPUSWXYqqc-3HBZaD.jpeg',1,NULL,'2016-12-01 13:44:55','2016-12-01 13:44:55'),
	(172,112,'',NULL,NULL,'images/ProductImageSuppliers/LuGgI_R_imCg01A5cDldpDd8RVa4-FA0.jpg','images/ProductImageSuppliers/thumbnail1/LuGgI_R_imCg01A5cDldpDd8RVa4-FA0.jpg','images/ProductImageSuppliers/thumbnail2/LuGgI_R_imCg01A5cDldpDd8RVa4-FA0.jpg',1,NULL,'2016-12-01 13:44:55','2016-12-01 13:44:55'),
	(173,113,'',NULL,NULL,'images/ProductImageSuppliers/W9h7a2W-vXeoseQGW_lNJBimEcRRwvvI.jpg','images/ProductImageSuppliers/thumbnail1/W9h7a2W-vXeoseQGW_lNJBimEcRRwvvI.jpg','images/ProductImageSuppliers/thumbnail2/W9h7a2W-vXeoseQGW_lNJBimEcRRwvvI.jpg',1,NULL,'2016-12-01 13:47:52','2016-12-01 13:47:52'),
	(174,113,'',NULL,NULL,'images/ProductImageSuppliers/FqEjRI1toPcy-o8TH5p8pfrmJut_3HR3.jpg','images/ProductImageSuppliers/thumbnail1/FqEjRI1toPcy-o8TH5p8pfrmJut_3HR3.jpg','images/ProductImageSuppliers/thumbnail2/FqEjRI1toPcy-o8TH5p8pfrmJut_3HR3.jpg',1,NULL,'2016-12-01 13:47:52','2016-12-01 13:47:52'),
	(175,113,'',NULL,NULL,'images/ProductImageSuppliers/V--kG350La2JmwRkqQxG4ZbzSY8TkAHh.jpg','images/ProductImageSuppliers/thumbnail1/V--kG350La2JmwRkqQxG4ZbzSY8TkAHh.jpg','images/ProductImageSuppliers/thumbnail2/V--kG350La2JmwRkqQxG4ZbzSY8TkAHh.jpg',1,NULL,'2016-12-01 13:47:53','2016-12-01 13:47:53'),
	(176,113,'',NULL,NULL,'images/ProductImageSuppliers/0jtVZ8wsw3vUQBbuXF1vcaEI1cwNKsc1.jpg','images/ProductImageSuppliers/thumbnail1/0jtVZ8wsw3vUQBbuXF1vcaEI1cwNKsc1.jpg','images/ProductImageSuppliers/thumbnail2/0jtVZ8wsw3vUQBbuXF1vcaEI1cwNKsc1.jpg',1,NULL,'2016-12-01 13:47:53','2016-12-01 13:47:53'),
	(177,114,'',NULL,NULL,'images/ProductImageSuppliers/TTXLduE-4snzzwt2ihlu04-IFnl5U29h.png','images/ProductImageSuppliers/thumbnail1/TTXLduE-4snzzwt2ihlu04-IFnl5U29h.png','images/ProductImageSuppliers/thumbnail2/TTXLduE-4snzzwt2ihlu04-IFnl5U29h.png',1,NULL,'2016-12-01 13:50:30','2016-12-01 13:50:30'),
	(178,115,'',NULL,NULL,'images/ProductImageSuppliers/HwfnjTgHAuE18ENs1eDnw0NhyJYUNm51.jpg','images/ProductImageSuppliers/thumbnail1/HwfnjTgHAuE18ENs1eDnw0NhyJYUNm51.jpg','images/ProductImageSuppliers/thumbnail2/HwfnjTgHAuE18ENs1eDnw0NhyJYUNm51.jpg',1,NULL,'2016-12-01 14:03:24','2016-12-01 14:03:24'),
	(179,115,'',NULL,NULL,'images/ProductImageSuppliers/4Ve_3DIkQKaUjXpf_dojqzqpn1cwZ27V.jpg','images/ProductImageSuppliers/thumbnail1/4Ve_3DIkQKaUjXpf_dojqzqpn1cwZ27V.jpg','images/ProductImageSuppliers/thumbnail2/4Ve_3DIkQKaUjXpf_dojqzqpn1cwZ27V.jpg',1,NULL,'2016-12-01 14:03:24','2016-12-01 14:03:24'),
	(180,115,'',NULL,NULL,'images/ProductImageSuppliers/L7UyafPgLR8fAbsfzU8CqxHwfL1zDVBt.jpg','images/ProductImageSuppliers/thumbnail1/L7UyafPgLR8fAbsfzU8CqxHwfL1zDVBt.jpg','images/ProductImageSuppliers/thumbnail2/L7UyafPgLR8fAbsfzU8CqxHwfL1zDVBt.jpg',1,NULL,'2016-12-01 14:03:24','2016-12-01 14:03:24'),
	(181,115,'',NULL,NULL,'images/ProductImageSuppliers/pYCNk02-AlWMgWOsbqmP5mqroBlTSqhh.jpg','images/ProductImageSuppliers/thumbnail1/pYCNk02-AlWMgWOsbqmP5mqroBlTSqhh.jpg','images/ProductImageSuppliers/thumbnail2/pYCNk02-AlWMgWOsbqmP5mqroBlTSqhh.jpg',1,NULL,'2016-12-01 14:03:24','2016-12-01 14:03:24'),
	(182,115,'',NULL,NULL,'images/ProductImageSuppliers/-mUr6fXH0bVMvJk-3mwkdOIOVMXszGZp.jpg','images/ProductImageSuppliers/thumbnail1/-mUr6fXH0bVMvJk-3mwkdOIOVMXszGZp.jpg','images/ProductImageSuppliers/thumbnail2/-mUr6fXH0bVMvJk-3mwkdOIOVMXszGZp.jpg',1,NULL,'2016-12-01 14:03:25','2016-12-01 14:03:25'),
	(183,115,'',NULL,NULL,'images/ProductImageSuppliers/YFvnvqudwKKGrcHm76-6U_F7SexpuFUs.jpg','images/ProductImageSuppliers/thumbnail1/YFvnvqudwKKGrcHm76-6U_F7SexpuFUs.jpg','images/ProductImageSuppliers/thumbnail2/YFvnvqudwKKGrcHm76-6U_F7SexpuFUs.jpg',1,NULL,'2016-12-01 14:03:25','2016-12-01 14:03:25'),
	(184,115,'',NULL,NULL,'images/ProductImageSuppliers/DciaXZKFqQsZd5SpTRbZ6dMj9wEXUFMZ.jpg','images/ProductImageSuppliers/thumbnail1/DciaXZKFqQsZd5SpTRbZ6dMj9wEXUFMZ.jpg','images/ProductImageSuppliers/thumbnail2/DciaXZKFqQsZd5SpTRbZ6dMj9wEXUFMZ.jpg',1,NULL,'2016-12-01 14:03:25','2016-12-01 14:03:25'),
	(185,115,'',NULL,NULL,'images/ProductImageSuppliers/CcEZQqavuFcoUwMbeoMFROJIBZeVClCo.jpg','images/ProductImageSuppliers/thumbnail1/CcEZQqavuFcoUwMbeoMFROJIBZeVClCo.jpg','images/ProductImageSuppliers/thumbnail2/CcEZQqavuFcoUwMbeoMFROJIBZeVClCo.jpg',1,NULL,'2016-12-01 14:03:25','2016-12-01 14:03:25'),
	(186,115,'',NULL,NULL,'images/ProductImageSuppliers/Ccp3XgweTTkpZOUyVCIsBMWMEF3ISnDJ.jpg','images/ProductImageSuppliers/thumbnail1/Ccp3XgweTTkpZOUyVCIsBMWMEF3ISnDJ.jpg','images/ProductImageSuppliers/thumbnail2/Ccp3XgweTTkpZOUyVCIsBMWMEF3ISnDJ.jpg',1,NULL,'2016-12-01 14:03:25','2016-12-01 14:03:25'),
	(187,115,'',NULL,NULL,'images/ProductImageSuppliers/RZ4-n0fpqbOJeN1PS5f1G0u0MRAnXzuy.jpg','images/ProductImageSuppliers/thumbnail1/RZ4-n0fpqbOJeN1PS5f1G0u0MRAnXzuy.jpg','images/ProductImageSuppliers/thumbnail2/RZ4-n0fpqbOJeN1PS5f1G0u0MRAnXzuy.jpg',1,NULL,'2016-12-01 14:03:26','2016-12-01 14:03:26'),
	(188,115,'',NULL,NULL,'images/ProductImageSuppliers/YA6CXLtWXJBwTp0cOFkHn_sUzzkIQBIt.jpg','images/ProductImageSuppliers/thumbnail1/YA6CXLtWXJBwTp0cOFkHn_sUzzkIQBIt.jpg','images/ProductImageSuppliers/thumbnail2/YA6CXLtWXJBwTp0cOFkHn_sUzzkIQBIt.jpg',1,NULL,'2016-12-01 14:03:26','2016-12-01 14:03:26'),
	(189,115,'',NULL,NULL,'images/ProductImageSuppliers/YaojzqKxdCQ623eEGB_aVu85Z4uVe4zy.jpg','images/ProductImageSuppliers/thumbnail1/YaojzqKxdCQ623eEGB_aVu85Z4uVe4zy.jpg','images/ProductImageSuppliers/thumbnail2/YaojzqKxdCQ623eEGB_aVu85Z4uVe4zy.jpg',1,NULL,'2016-12-01 14:03:26','2016-12-01 14:03:26'),
	(190,116,'',NULL,NULL,'images/ProductImageSuppliers/n-h0-wL7c8nmUhAXAg0eJoBN8FZGYPtd.jpg','images/ProductImageSuppliers/thumbnail1/n-h0-wL7c8nmUhAXAg0eJoBN8FZGYPtd.jpg','images/ProductImageSuppliers/thumbnail2/n-h0-wL7c8nmUhAXAg0eJoBN8FZGYPtd.jpg',1,NULL,'2016-12-01 14:10:13','2016-12-01 14:10:13'),
	(191,116,'',NULL,NULL,'images/ProductImageSuppliers/eBo6N2bIaSj1F8CojNWR04hyVICT4Fur.jpg','images/ProductImageSuppliers/thumbnail1/eBo6N2bIaSj1F8CojNWR04hyVICT4Fur.jpg','images/ProductImageSuppliers/thumbnail2/eBo6N2bIaSj1F8CojNWR04hyVICT4Fur.jpg',1,NULL,'2016-12-01 14:10:17','2016-12-01 14:10:17'),
	(192,116,'',NULL,NULL,'images/ProductImageSuppliers/0tTUBUi7q14pnc5wuy7vXn0bQIaBroZl.jpg','images/ProductImageSuppliers/thumbnail1/0tTUBUi7q14pnc5wuy7vXn0bQIaBroZl.jpg','images/ProductImageSuppliers/thumbnail2/0tTUBUi7q14pnc5wuy7vXn0bQIaBroZl.jpg',1,NULL,'2016-12-01 14:10:18','2016-12-01 14:10:18'),
	(193,116,'',NULL,NULL,'images/ProductImageSuppliers/tZOjSDVbpCalEnZRiycC-iGjw3bdX504.jpg','images/ProductImageSuppliers/thumbnail1/tZOjSDVbpCalEnZRiycC-iGjw3bdX504.jpg','images/ProductImageSuppliers/thumbnail2/tZOjSDVbpCalEnZRiycC-iGjw3bdX504.jpg',1,NULL,'2016-12-01 14:10:18','2016-12-01 14:10:18'),
	(194,116,'',NULL,NULL,'images/ProductImageSuppliers/xoiC5hWN0S5adtRq_h0KDjW9zu00RMXN.jpg','images/ProductImageSuppliers/thumbnail1/xoiC5hWN0S5adtRq_h0KDjW9zu00RMXN.jpg','images/ProductImageSuppliers/thumbnail2/xoiC5hWN0S5adtRq_h0KDjW9zu00RMXN.jpg',1,NULL,'2016-12-01 14:10:18','2016-12-01 14:10:18'),
	(195,116,'',NULL,NULL,'images/ProductImageSuppliers/DXXH_4aPpa-22ng9tXACqAT8mUBq9OIj.jpg','images/ProductImageSuppliers/thumbnail1/DXXH_4aPpa-22ng9tXACqAT8mUBq9OIj.jpg','images/ProductImageSuppliers/thumbnail2/DXXH_4aPpa-22ng9tXACqAT8mUBq9OIj.jpg',1,NULL,'2016-12-01 14:10:18','2016-12-01 14:10:18'),
	(196,116,'',NULL,NULL,'images/ProductImageSuppliers/UimCjj6DZ2A_XH-RcLZgx6rYqEF7vtkg.jpg','images/ProductImageSuppliers/thumbnail1/UimCjj6DZ2A_XH-RcLZgx6rYqEF7vtkg.jpg','images/ProductImageSuppliers/thumbnail2/UimCjj6DZ2A_XH-RcLZgx6rYqEF7vtkg.jpg',1,NULL,'2016-12-01 14:10:18','2016-12-01 14:10:18'),
	(197,116,'',NULL,NULL,'images/ProductImageSuppliers/x3VpjOTOlzBO7gMUs03_Y8eYJgfVW90D.jpg','images/ProductImageSuppliers/thumbnail1/x3VpjOTOlzBO7gMUs03_Y8eYJgfVW90D.jpg','images/ProductImageSuppliers/thumbnail2/x3VpjOTOlzBO7gMUs03_Y8eYJgfVW90D.jpg',1,NULL,'2016-12-01 14:10:19','2016-12-01 14:10:19'),
	(198,117,'',NULL,NULL,'images/ProductImageSuppliers/kvaliJkROYnxx5D3-60BOMV8WzQiiZlD.jpg','images/ProductImageSuppliers/thumbnail1/kvaliJkROYnxx5D3-60BOMV8WzQiiZlD.jpg','images/ProductImageSuppliers/thumbnail2/kvaliJkROYnxx5D3-60BOMV8WzQiiZlD.jpg',1,NULL,'2016-12-02 09:49:35','2016-12-02 09:49:35'),
	(199,117,'',NULL,NULL,'images/ProductImageSuppliers/FJs8YxnVjsjZXYT1UOeX99azmw-p1bj6.jpg','images/ProductImageSuppliers/thumbnail1/FJs8YxnVjsjZXYT1UOeX99azmw-p1bj6.jpg','images/ProductImageSuppliers/thumbnail2/FJs8YxnVjsjZXYT1UOeX99azmw-p1bj6.jpg',1,NULL,'2016-12-02 09:49:36','2016-12-02 09:49:36'),
	(200,117,'',NULL,NULL,'images/ProductImageSuppliers/w2oJ5sO0MIdh-ueMBaELa55ZD4ra-f1S.jpg','images/ProductImageSuppliers/thumbnail1/w2oJ5sO0MIdh-ueMBaELa55ZD4ra-f1S.jpg','images/ProductImageSuppliers/thumbnail2/w2oJ5sO0MIdh-ueMBaELa55ZD4ra-f1S.jpg',1,NULL,'2016-12-02 09:49:36','2016-12-02 09:49:36'),
	(201,117,'',NULL,NULL,'images/ProductImageSuppliers/O9smxH4Z2hyn0eKIlppmclLPb25fTMci.jpg','images/ProductImageSuppliers/thumbnail1/O9smxH4Z2hyn0eKIlppmclLPb25fTMci.jpg','images/ProductImageSuppliers/thumbnail2/O9smxH4Z2hyn0eKIlppmclLPb25fTMci.jpg',1,NULL,'2016-12-02 09:49:36','2016-12-02 09:49:36'),
	(202,117,'',NULL,NULL,'images/ProductImageSuppliers/pPrnAkMuJP3lw1RKJl1g0ofXr4xOvFPv.jpg','images/ProductImageSuppliers/thumbnail1/pPrnAkMuJP3lw1RKJl1g0ofXr4xOvFPv.jpg','images/ProductImageSuppliers/thumbnail2/pPrnAkMuJP3lw1RKJl1g0ofXr4xOvFPv.jpg',1,NULL,'2016-12-02 10:01:01','2016-12-02 10:01:01'),
	(203,117,'',NULL,NULL,'images/ProductImageSuppliers/XFKm-iT--YY52y3ScVVIOPwSQCa_Gz1U.jpg','images/ProductImageSuppliers/thumbnail1/XFKm-iT--YY52y3ScVVIOPwSQCa_Gz1U.jpg','images/ProductImageSuppliers/thumbnail2/XFKm-iT--YY52y3ScVVIOPwSQCa_Gz1U.jpg',1,NULL,'2016-12-02 10:01:02','2016-12-02 10:01:02'),
	(204,117,'',NULL,NULL,'images/ProductImageSuppliers/rdGzC1NXjr_FV1nKAw2Rc2C20w1XO-ay.jpg','images/ProductImageSuppliers/thumbnail1/rdGzC1NXjr_FV1nKAw2Rc2C20w1XO-ay.jpg','images/ProductImageSuppliers/thumbnail2/rdGzC1NXjr_FV1nKAw2Rc2C20w1XO-ay.jpg',1,NULL,'2016-12-02 10:01:02','2016-12-02 10:01:02'),
	(205,117,'',NULL,NULL,'images/ProductImageSuppliers/aOAiXD_6l_c3dDRBK5IePLQU9WARpfeS.jpg','images/ProductImageSuppliers/thumbnail1/aOAiXD_6l_c3dDRBK5IePLQU9WARpfeS.jpg','images/ProductImageSuppliers/thumbnail2/aOAiXD_6l_c3dDRBK5IePLQU9WARpfeS.jpg',1,NULL,'2016-12-02 10:01:02','2016-12-02 10:01:02'),
	(206,117,'',NULL,NULL,'images/ProductImageSuppliers/RsTNYVI8SRHcOSHgGVfFf1Gaetez0O06.jpg','images/ProductImageSuppliers/thumbnail1/RsTNYVI8SRHcOSHgGVfFf1Gaetez0O06.jpg','images/ProductImageSuppliers/thumbnail2/RsTNYVI8SRHcOSHgGVfFf1Gaetez0O06.jpg',1,NULL,'2016-12-02 10:01:03','2016-12-02 10:01:03'),
	(207,119,'',NULL,NULL,'images/ProductImageSuppliers/tiIu_SvJtXeWUUwNV2z-22Q_q6nOxkbp.jpg','images/ProductImageSuppliers/thumbnail1/tiIu_SvJtXeWUUwNV2z-22Q_q6nOxkbp.jpg','images/ProductImageSuppliers/thumbnail2/tiIu_SvJtXeWUUwNV2z-22Q_q6nOxkbp.jpg',1,NULL,'2016-12-02 13:13:08','2016-12-02 13:13:08'),
	(208,119,'',NULL,NULL,'images/ProductImageSuppliers/QfDdBOMtDnbl1HiiUMGN1kg0vfLaRVfM.jpg','images/ProductImageSuppliers/thumbnail1/QfDdBOMtDnbl1HiiUMGN1kg0vfLaRVfM.jpg','images/ProductImageSuppliers/thumbnail2/QfDdBOMtDnbl1HiiUMGN1kg0vfLaRVfM.jpg',1,NULL,'2016-12-02 13:13:09','2016-12-02 13:13:09'),
	(209,119,'',NULL,NULL,'images/ProductImageSuppliers/VlX9JgmfGJziImBcc2E2E-R4-YbOhkGr.jpg','images/ProductImageSuppliers/thumbnail1/VlX9JgmfGJziImBcc2E2E-R4-YbOhkGr.jpg','images/ProductImageSuppliers/thumbnail2/VlX9JgmfGJziImBcc2E2E-R4-YbOhkGr.jpg',1,NULL,'2016-12-02 13:13:09','2016-12-02 13:13:09'),
	(210,119,'',NULL,NULL,'images/ProductImageSuppliers/Y44uBj9JxwSHUR4-k9zCDepCSSVfHGFR.jpg','images/ProductImageSuppliers/thumbnail1/Y44uBj9JxwSHUR4-k9zCDepCSSVfHGFR.jpg','images/ProductImageSuppliers/thumbnail2/Y44uBj9JxwSHUR4-k9zCDepCSSVfHGFR.jpg',1,NULL,'2016-12-02 13:13:10','2016-12-02 13:13:10'),
	(211,119,'',NULL,NULL,'images/ProductImageSuppliers/iB2jtDdvN54U1asCyS7owu-qDZKjA0_j.jpg','images/ProductImageSuppliers/thumbnail1/iB2jtDdvN54U1asCyS7owu-qDZKjA0_j.jpg','images/ProductImageSuppliers/thumbnail2/iB2jtDdvN54U1asCyS7owu-qDZKjA0_j.jpg',1,NULL,'2016-12-02 13:13:10','2016-12-02 13:13:10'),
	(214,125,'',NULL,NULL,'images/ProductImageSuppliers/a5Y97QxjDxLWRns_StxW981ygmk8wjbv.jpg','images/ProductImageSuppliers/thumbnail1/a5Y97QxjDxLWRns_StxW981ygmk8wjbv.jpg','images/ProductImageSuppliers/thumbnail2/a5Y97QxjDxLWRns_StxW981ygmk8wjbv.jpg',1,NULL,'2016-12-06 13:50:29','2016-12-06 13:50:29'),
	(215,125,'',NULL,NULL,'images/ProductImageSuppliers/QqqbFus6HpbT6ORwHWKaGr9KJ8lD4UlY.jpg','images/ProductImageSuppliers/thumbnail1/QqqbFus6HpbT6ORwHWKaGr9KJ8lD4UlY.jpg','images/ProductImageSuppliers/thumbnail2/QqqbFus6HpbT6ORwHWKaGr9KJ8lD4UlY.jpg',1,NULL,'2016-12-06 13:50:29','2016-12-06 13:50:29'),
	(216,125,'',NULL,NULL,'images/ProductImageSuppliers/6lyFy0bdVWkCk4CfZU2AzyI0T-ViPQNf.jpg','images/ProductImageSuppliers/thumbnail1/6lyFy0bdVWkCk4CfZU2AzyI0T-ViPQNf.jpg','images/ProductImageSuppliers/thumbnail2/6lyFy0bdVWkCk4CfZU2AzyI0T-ViPQNf.jpg',1,NULL,'2016-12-06 13:50:30','2016-12-06 13:50:30'),
	(217,125,'',NULL,NULL,'images/ProductImageSuppliers/Y_jAFR-swDDutPGaT4zRc9X3U9e67jYz.jpg','images/ProductImageSuppliers/thumbnail1/Y_jAFR-swDDutPGaT4zRc9X3U9e67jYz.jpg','images/ProductImageSuppliers/thumbnail2/Y_jAFR-swDDutPGaT4zRc9X3U9e67jYz.jpg',1,NULL,'2016-12-06 13:50:31','2016-12-06 13:50:31'),
	(218,125,'',NULL,NULL,'images/ProductImageSuppliers/sTuHzJ3TgApbR5V4tjeM0Gvav0q1H33C.jpg','images/ProductImageSuppliers/thumbnail1/sTuHzJ3TgApbR5V4tjeM0Gvav0q1H33C.jpg','images/ProductImageSuppliers/thumbnail2/sTuHzJ3TgApbR5V4tjeM0Gvav0q1H33C.jpg',1,NULL,'2016-12-06 13:50:31','2016-12-06 13:50:31'),
	(219,125,'',NULL,NULL,'images/ProductImageSuppliers/dJmsiM0qveTR260Pf8pYAUhF36LVCkZ7.jpg','images/ProductImageSuppliers/thumbnail1/dJmsiM0qveTR260Pf8pYAUhF36LVCkZ7.jpg','images/ProductImageSuppliers/thumbnail2/dJmsiM0qveTR260Pf8pYAUhF36LVCkZ7.jpg',1,NULL,'2016-12-06 13:50:31','2016-12-06 13:50:31'),
	(220,125,'',NULL,NULL,'images/ProductImageSuppliers/aBCWpifRiQzAe4aof11QbN9ZYUshPrGq.jpg','images/ProductImageSuppliers/thumbnail1/aBCWpifRiQzAe4aof11QbN9ZYUshPrGq.jpg','images/ProductImageSuppliers/thumbnail2/aBCWpifRiQzAe4aof11QbN9ZYUshPrGq.jpg',1,NULL,'2016-12-06 13:50:32','2016-12-06 13:50:32'),
	(221,125,'',NULL,NULL,'images/ProductImageSuppliers/RV-BItdwVVV0_iRg-EOMQOZWjjruNheT.jpg','images/ProductImageSuppliers/thumbnail1/RV-BItdwVVV0_iRg-EOMQOZWjjruNheT.jpg','images/ProductImageSuppliers/thumbnail2/RV-BItdwVVV0_iRg-EOMQOZWjjruNheT.jpg',1,NULL,'2016-12-06 13:50:32','2016-12-06 13:50:32'),
	(222,125,'',NULL,NULL,'images/ProductImageSuppliers/GFdCCxeArR8C0ww1uWxphAT_VYWh4f-U.jpg','images/ProductImageSuppliers/thumbnail1/GFdCCxeArR8C0ww1uWxphAT_VYWh4f-U.jpg','images/ProductImageSuppliers/thumbnail2/GFdCCxeArR8C0ww1uWxphAT_VYWh4f-U.jpg',1,NULL,'2016-12-06 13:50:32','2016-12-06 13:50:32'),
	(223,125,'',NULL,NULL,'images/ProductImageSuppliers/L0vHMXcnHcAv2PATULRaYP0ChPYhTWz6.jpg','images/ProductImageSuppliers/thumbnail1/L0vHMXcnHcAv2PATULRaYP0ChPYhTWz6.jpg','images/ProductImageSuppliers/thumbnail2/L0vHMXcnHcAv2PATULRaYP0ChPYhTWz6.jpg',1,NULL,'2016-12-06 13:50:33','2016-12-06 13:50:33'),
	(224,125,'',NULL,NULL,'images/ProductImageSuppliers/6i0FzNidirLAC8B7I0V8KBQJWMSGNmBc.jpg','images/ProductImageSuppliers/thumbnail1/6i0FzNidirLAC8B7I0V8KBQJWMSGNmBc.jpg','images/ProductImageSuppliers/thumbnail2/6i0FzNidirLAC8B7I0V8KBQJWMSGNmBc.jpg',1,NULL,'2016-12-06 13:50:33','2016-12-06 13:50:33'),
	(225,125,'',NULL,NULL,'images/ProductImageSuppliers/Iw5d0PgsBYgrc-eR2WRiJ6d0778usWnW.jpg','images/ProductImageSuppliers/thumbnail1/Iw5d0PgsBYgrc-eR2WRiJ6d0778usWnW.jpg','images/ProductImageSuppliers/thumbnail2/Iw5d0PgsBYgrc-eR2WRiJ6d0778usWnW.jpg',1,NULL,'2016-12-06 13:50:34','2016-12-06 13:50:34'),
	(227,126,'',NULL,NULL,'images/ProductImageSuppliers/ZZj4heN8_iA3IEVYieShqufd7_BOER9l.jpg','images/ProductImageSuppliers/thumbnail1/ZZj4heN8_iA3IEVYieShqufd7_BOER9l.jpg','images/ProductImageSuppliers/thumbnail2/ZZj4heN8_iA3IEVYieShqufd7_BOER9l.jpg',1,NULL,'2016-12-06 13:57:57','2016-12-06 13:57:57'),
	(228,126,'',NULL,NULL,'images/ProductImageSuppliers/j6QNQHyXcm-jGjHG3fPyW0qciuqz0PIq.jpg','images/ProductImageSuppliers/thumbnail1/j6QNQHyXcm-jGjHG3fPyW0qciuqz0PIq.jpg','images/ProductImageSuppliers/thumbnail2/j6QNQHyXcm-jGjHG3fPyW0qciuqz0PIq.jpg',1,NULL,'2016-12-06 13:57:57','2016-12-06 13:57:57'),
	(229,126,'',NULL,NULL,'images/ProductImageSuppliers/SAXFmDKWi0EwpqZnotv8jcXROs1dGgUI.jpg','images/ProductImageSuppliers/thumbnail1/SAXFmDKWi0EwpqZnotv8jcXROs1dGgUI.jpg','images/ProductImageSuppliers/thumbnail2/SAXFmDKWi0EwpqZnotv8jcXROs1dGgUI.jpg',1,NULL,'2016-12-06 13:57:58','2016-12-06 13:57:58'),
	(230,126,'',NULL,NULL,'images/ProductImageSuppliers/FO5A0Srx9iPm7vT_redXsncyvm7BrdZy.jpg','images/ProductImageSuppliers/thumbnail1/FO5A0Srx9iPm7vT_redXsncyvm7BrdZy.jpg','images/ProductImageSuppliers/thumbnail2/FO5A0Srx9iPm7vT_redXsncyvm7BrdZy.jpg',1,NULL,'2016-12-06 13:57:58','2016-12-06 13:57:58'),
	(231,126,'',NULL,NULL,'images/ProductImageSuppliers/yODymcwNcpt2Yb2gnBxgVtnDXthd9Sox.jpg','images/ProductImageSuppliers/thumbnail1/yODymcwNcpt2Yb2gnBxgVtnDXthd9Sox.jpg','images/ProductImageSuppliers/thumbnail2/yODymcwNcpt2Yb2gnBxgVtnDXthd9Sox.jpg',1,NULL,'2016-12-06 13:57:58','2016-12-06 13:57:58'),
	(232,127,'',NULL,NULL,'images/ProductImageSuppliers/-7L1KRM_QM0Q5X77xNo_RjMdgG0mmgrm.jpg','images/ProductImageSuppliers/thumbnail1/-7L1KRM_QM0Q5X77xNo_RjMdgG0mmgrm.jpg','images/ProductImageSuppliers/thumbnail2/-7L1KRM_QM0Q5X77xNo_RjMdgG0mmgrm.jpg',1,NULL,'2016-12-06 14:05:34','2016-12-06 14:05:34'),
	(233,127,'',NULL,NULL,'images/ProductImageSuppliers/5LxtQMxQ8RYAf5SwQIo8TLW80lpylES2.jpg','images/ProductImageSuppliers/thumbnail1/5LxtQMxQ8RYAf5SwQIo8TLW80lpylES2.jpg','images/ProductImageSuppliers/thumbnail2/5LxtQMxQ8RYAf5SwQIo8TLW80lpylES2.jpg',1,NULL,'2016-12-06 14:05:34','2016-12-06 14:05:34'),
	(234,127,'',NULL,NULL,'images/ProductImageSuppliers/8kfKDwTHsPRkOHn3pFUXsVJDUuFzLNYP.jpg','images/ProductImageSuppliers/thumbnail1/8kfKDwTHsPRkOHn3pFUXsVJDUuFzLNYP.jpg','images/ProductImageSuppliers/thumbnail2/8kfKDwTHsPRkOHn3pFUXsVJDUuFzLNYP.jpg',1,NULL,'2016-12-06 14:05:34','2016-12-06 14:05:34'),
	(235,127,'',NULL,NULL,'images/ProductImageSuppliers/0ipAv8Gbogp1E2VMIhVS6P29lD0dOOWA.jpg','images/ProductImageSuppliers/thumbnail1/0ipAv8Gbogp1E2VMIhVS6P29lD0dOOWA.jpg','images/ProductImageSuppliers/thumbnail2/0ipAv8Gbogp1E2VMIhVS6P29lD0dOOWA.jpg',1,NULL,'2016-12-06 14:05:34','2016-12-06 14:05:34'),
	(237,128,'',NULL,NULL,'images/ProductImageSuppliers/ehyppB1LCpjsG-dibFrSaxGS7GgE2nlr.jpg','images/ProductImageSuppliers/thumbnail1/ehyppB1LCpjsG-dibFrSaxGS7GgE2nlr.jpg','images/ProductImageSuppliers/thumbnail2/ehyppB1LCpjsG-dibFrSaxGS7GgE2nlr.jpg',1,NULL,'2016-12-07 09:04:42','2016-12-07 09:04:42'),
	(238,128,'',NULL,NULL,'images/ProductImageSuppliers/J2lRgrqgvri-eeeQPMY8trbMFWs8g77j.jpg','images/ProductImageSuppliers/thumbnail1/J2lRgrqgvri-eeeQPMY8trbMFWs8g77j.jpg','images/ProductImageSuppliers/thumbnail2/J2lRgrqgvri-eeeQPMY8trbMFWs8g77j.jpg',1,NULL,'2016-12-07 09:04:42','2016-12-07 09:04:42'),
	(239,128,'',NULL,NULL,'images/ProductImageSuppliers/rNWhcKK_jay036OauQLtQ8YaQFlSk-cH.jpg','images/ProductImageSuppliers/thumbnail1/rNWhcKK_jay036OauQLtQ8YaQFlSk-cH.jpg','images/ProductImageSuppliers/thumbnail2/rNWhcKK_jay036OauQLtQ8YaQFlSk-cH.jpg',1,NULL,'2016-12-07 09:04:42','2016-12-07 09:04:42'),
	(240,128,'',NULL,NULL,'images/ProductImageSuppliers/pWmCSx-Ynw31RgNSjcp7X9V5IPo8YPi0.jpg','images/ProductImageSuppliers/thumbnail1/pWmCSx-Ynw31RgNSjcp7X9V5IPo8YPi0.jpg','images/ProductImageSuppliers/thumbnail2/pWmCSx-Ynw31RgNSjcp7X9V5IPo8YPi0.jpg',1,NULL,'2016-12-07 09:04:43','2016-12-07 09:04:43'),
	(241,128,'',NULL,NULL,'images/ProductImageSuppliers/xBPZycDcUm8BHKSqfmMDkf-Sdd9AnStI.jpg','images/ProductImageSuppliers/thumbnail1/xBPZycDcUm8BHKSqfmMDkf-Sdd9AnStI.jpg','images/ProductImageSuppliers/thumbnail2/xBPZycDcUm8BHKSqfmMDkf-Sdd9AnStI.jpg',1,NULL,'2016-12-07 09:04:43','2016-12-07 09:04:43'),
	(242,129,'',NULL,NULL,'images/ProductImageSuppliers/s9x_OA9BASfZ6ONf96_pEz43g5LNgzKi.jpg','images/ProductImageSuppliers/thumbnail1/s9x_OA9BASfZ6ONf96_pEz43g5LNgzKi.jpg','images/ProductImageSuppliers/thumbnail2/s9x_OA9BASfZ6ONf96_pEz43g5LNgzKi.jpg',1,NULL,'2016-12-07 09:10:58','2016-12-07 09:10:58'),
	(243,129,'',NULL,NULL,'images/ProductImageSuppliers/omKn94SG1rnCW4Xir6sLGWCrm_gco-SP.jpg','images/ProductImageSuppliers/thumbnail1/omKn94SG1rnCW4Xir6sLGWCrm_gco-SP.jpg','images/ProductImageSuppliers/thumbnail2/omKn94SG1rnCW4Xir6sLGWCrm_gco-SP.jpg',1,NULL,'2016-12-07 09:10:58','2016-12-07 09:10:58'),
	(244,129,'',NULL,NULL,'images/ProductImageSuppliers/Gqlfs8RjnumouZ1o5RrK61_bRmKwjWXd.jpg','images/ProductImageSuppliers/thumbnail1/Gqlfs8RjnumouZ1o5RrK61_bRmKwjWXd.jpg','images/ProductImageSuppliers/thumbnail2/Gqlfs8RjnumouZ1o5RrK61_bRmKwjWXd.jpg',1,NULL,'2016-12-07 09:10:59','2016-12-07 09:10:59'),
	(245,130,'',NULL,NULL,'images/ProductImageSuppliers/P2b-00JgDNO2iAR-qdkMEFIR32YKY_oK.jpg','images/ProductImageSuppliers/thumbnail1/P2b-00JgDNO2iAR-qdkMEFIR32YKY_oK.jpg','images/ProductImageSuppliers/thumbnail2/P2b-00JgDNO2iAR-qdkMEFIR32YKY_oK.jpg',1,NULL,'2016-12-07 09:13:35','2016-12-07 09:13:35'),
	(246,130,'',NULL,NULL,'images/ProductImageSuppliers/EfrjY68sPyU4OuXX_UG57xz9pQhRyyWr.jpg','images/ProductImageSuppliers/thumbnail1/EfrjY68sPyU4OuXX_UG57xz9pQhRyyWr.jpg','images/ProductImageSuppliers/thumbnail2/EfrjY68sPyU4OuXX_UG57xz9pQhRyyWr.jpg',1,NULL,'2016-12-07 09:13:35','2016-12-07 09:13:35'),
	(247,130,'',NULL,NULL,'images/ProductImageSuppliers/QECfOyqA3MspVbNf64YPIvCA5TDjfCiJ.jpg','images/ProductImageSuppliers/thumbnail1/QECfOyqA3MspVbNf64YPIvCA5TDjfCiJ.jpg','images/ProductImageSuppliers/thumbnail2/QECfOyqA3MspVbNf64YPIvCA5TDjfCiJ.jpg',1,NULL,'2016-12-07 09:13:35','2016-12-07 09:13:35'),
	(248,131,'',NULL,NULL,'images/ProductImageSuppliers/dNcUUKLd-WOetisKOwX9GTbjh0IT6dQa.jpg','images/ProductImageSuppliers/thumbnail1/dNcUUKLd-WOetisKOwX9GTbjh0IT6dQa.jpg','images/ProductImageSuppliers/thumbnail2/dNcUUKLd-WOetisKOwX9GTbjh0IT6dQa.jpg',1,NULL,'2016-12-07 09:16:26','2016-12-07 09:16:26'),
	(249,131,'',NULL,NULL,'images/ProductImageSuppliers/XgzZMNWK3qxM4RgD2L-ZHhHCiHpeddrC.jpg','images/ProductImageSuppliers/thumbnail1/XgzZMNWK3qxM4RgD2L-ZHhHCiHpeddrC.jpg','images/ProductImageSuppliers/thumbnail2/XgzZMNWK3qxM4RgD2L-ZHhHCiHpeddrC.jpg',1,NULL,'2016-12-07 09:16:33','2016-12-07 09:16:33'),
	(250,131,'',NULL,NULL,'images/ProductImageSuppliers/9hX0VUc81qcC09UQwndmBaQKPl4SmsCT.jpg','images/ProductImageSuppliers/thumbnail1/9hX0VUc81qcC09UQwndmBaQKPl4SmsCT.jpg','images/ProductImageSuppliers/thumbnail2/9hX0VUc81qcC09UQwndmBaQKPl4SmsCT.jpg',1,NULL,'2016-12-07 09:16:33','2016-12-07 09:16:33'),
	(251,128,'',NULL,NULL,'images/ProductImageSuppliers/TMUVGYigt2EdR_6DDQBA9e4f9x7FuUTr.jpg','images/ProductImageSuppliers/thumbnail1/TMUVGYigt2EdR_6DDQBA9e4f9x7FuUTr.jpg','images/ProductImageSuppliers/thumbnail2/TMUVGYigt2EdR_6DDQBA9e4f9x7FuUTr.jpg',1,NULL,'2016-12-07 09:17:33','2016-12-07 09:17:33'),
	(252,128,'',NULL,NULL,'images/ProductImageSuppliers/dnbSkdE8fUsJBLRgIQzITFbkE8Ydlz2u.jpg','images/ProductImageSuppliers/thumbnail1/dnbSkdE8fUsJBLRgIQzITFbkE8Ydlz2u.jpg','images/ProductImageSuppliers/thumbnail2/dnbSkdE8fUsJBLRgIQzITFbkE8Ydlz2u.jpg',1,NULL,'2016-12-07 09:17:34','2016-12-07 09:17:34'),
	(253,133,'',NULL,NULL,'images/ProductImageSuppliers/GyWDfkPraDs8XnoWFsMgSmdDb5LN2EE2.png','images/ProductImageSuppliers/thumbnail1/GyWDfkPraDs8XnoWFsMgSmdDb5LN2EE2.png','images/ProductImageSuppliers/thumbnail2/GyWDfkPraDs8XnoWFsMgSmdDb5LN2EE2.png',1,NULL,'2016-12-08 10:40:30','2016-12-08 10:40:30'),
	(254,133,'',NULL,NULL,'images/ProductImageSuppliers/l7BrurLISEPjDBtFEXKvO6SetW-5FuRo.png','images/ProductImageSuppliers/thumbnail1/l7BrurLISEPjDBtFEXKvO6SetW-5FuRo.png','images/ProductImageSuppliers/thumbnail2/l7BrurLISEPjDBtFEXKvO6SetW-5FuRo.png',1,NULL,'2016-12-08 10:40:31','2016-12-08 10:40:31'),
	(255,133,'',NULL,NULL,'images/ProductImageSuppliers/0Hhieq71dyQDqV7_cNx5nQUChGa2z1dD.png','images/ProductImageSuppliers/thumbnail1/0Hhieq71dyQDqV7_cNx5nQUChGa2z1dD.png','images/ProductImageSuppliers/thumbnail2/0Hhieq71dyQDqV7_cNx5nQUChGa2z1dD.png',1,NULL,'2016-12-08 10:40:32','2016-12-08 10:40:32'),
	(256,133,'',NULL,NULL,'images/ProductImageSuppliers/6kCtyHzRfKf5gS3HLV8ahxi9B3VWj5Wg.png','images/ProductImageSuppliers/thumbnail1/6kCtyHzRfKf5gS3HLV8ahxi9B3VWj5Wg.png','images/ProductImageSuppliers/thumbnail2/6kCtyHzRfKf5gS3HLV8ahxi9B3VWj5Wg.png',1,NULL,'2016-12-08 10:40:33','2016-12-08 10:40:33'),
	(257,139,'',NULL,NULL,'images/ProductImageSuppliers/IZNwHSpOWDbwWAXSV3YNi9XiewrLcV4_.jpg','images/ProductImageSuppliers/thumbnail1/IZNwHSpOWDbwWAXSV3YNi9XiewrLcV4_.jpg','images/ProductImageSuppliers/thumbnail2/IZNwHSpOWDbwWAXSV3YNi9XiewrLcV4_.jpg',1,NULL,'2016-12-08 11:35:50','2016-12-08 11:35:50'),
	(258,122,'',NULL,NULL,'images/ProductImageSuppliers/I0-LJ3s1LIOEWuGd6uXxl47wlztX8hqR.jpg','images/ProductImageSuppliers/thumbnail1/I0-LJ3s1LIOEWuGd6uXxl47wlztX8hqR.jpg','images/ProductImageSuppliers/thumbnail2/I0-LJ3s1LIOEWuGd6uXxl47wlztX8hqR.jpg',1,NULL,'2016-12-08 11:41:32','2016-12-08 11:41:32'),
	(259,122,'',NULL,NULL,'images/ProductImageSuppliers/L2-J7CBOJfe4u0KoIvTK9GJrCShEYB7T.jpg','images/ProductImageSuppliers/thumbnail1/L2-J7CBOJfe4u0KoIvTK9GJrCShEYB7T.jpg','images/ProductImageSuppliers/thumbnail2/L2-J7CBOJfe4u0KoIvTK9GJrCShEYB7T.jpg',1,NULL,'2016-12-08 11:41:32','2016-12-08 11:41:32'),
	(260,122,'',NULL,NULL,'images/ProductImageSuppliers/u7noWvQ6q8jC1eCZSmhvrgDxA-2aX4Z-.jpg','images/ProductImageSuppliers/thumbnail1/u7noWvQ6q8jC1eCZSmhvrgDxA-2aX4Z-.jpg','images/ProductImageSuppliers/thumbnail2/u7noWvQ6q8jC1eCZSmhvrgDxA-2aX4Z-.jpg',1,NULL,'2016-12-08 11:41:33','2016-12-08 11:41:33'),
	(261,140,'',NULL,NULL,'images/ProductImageSuppliers/2lHfT-6ekEIu0WCrioEDn2WiA0Bg4I3N.jpg','images/ProductImageSuppliers/thumbnail1/2lHfT-6ekEIu0WCrioEDn2WiA0Bg4I3N.jpg','images/ProductImageSuppliers/thumbnail2/2lHfT-6ekEIu0WCrioEDn2WiA0Bg4I3N.jpg',1,NULL,'2016-12-08 15:06:46','2016-12-08 15:06:46'),
	(262,140,'',NULL,NULL,'images/ProductImageSuppliers/i76chaXMHCKPQIXppfxL6R3RAamSIuaI.jpg','images/ProductImageSuppliers/thumbnail1/i76chaXMHCKPQIXppfxL6R3RAamSIuaI.jpg','images/ProductImageSuppliers/thumbnail2/i76chaXMHCKPQIXppfxL6R3RAamSIuaI.jpg',1,NULL,'2016-12-08 15:06:46','2016-12-08 15:06:46'),
	(263,140,'',NULL,NULL,'images/ProductImageSuppliers/MoTO-f7kt-n2K3oJbwyw4rSyYr7OCEeC.jpg','images/ProductImageSuppliers/thumbnail1/MoTO-f7kt-n2K3oJbwyw4rSyYr7OCEeC.jpg','images/ProductImageSuppliers/thumbnail2/MoTO-f7kt-n2K3oJbwyw4rSyYr7OCEeC.jpg',1,NULL,'2016-12-08 15:06:46','2016-12-08 15:06:46'),
	(264,141,'',NULL,NULL,'images/ProductImageSuppliers/IS2Qff242BJ296wlYiiaZJtcYzeNHHYN.jpg','images/ProductImageSuppliers/thumbnail1/IS2Qff242BJ296wlYiiaZJtcYzeNHHYN.jpg','images/ProductImageSuppliers/thumbnail2/IS2Qff242BJ296wlYiiaZJtcYzeNHHYN.jpg',1,NULL,'2016-12-08 15:08:31','2016-12-08 15:08:31'),
	(265,141,'',NULL,NULL,'images/ProductImageSuppliers/Bsh1_-8A49wXE7AuPdr3BNbvzxV7vf7M.jpg','images/ProductImageSuppliers/thumbnail1/Bsh1_-8A49wXE7AuPdr3BNbvzxV7vf7M.jpg','images/ProductImageSuppliers/thumbnail2/Bsh1_-8A49wXE7AuPdr3BNbvzxV7vf7M.jpg',1,NULL,'2016-12-08 15:08:32','2016-12-08 15:08:32'),
	(266,141,'',NULL,NULL,'images/ProductImageSuppliers/nnwphD3fFmwjcQm2eIDcEoi4Nyy0ouzC.jpg','images/ProductImageSuppliers/thumbnail1/nnwphD3fFmwjcQm2eIDcEoi4Nyy0ouzC.jpg','images/ProductImageSuppliers/thumbnail2/nnwphD3fFmwjcQm2eIDcEoi4Nyy0ouzC.jpg',1,NULL,'2016-12-08 15:08:32','2016-12-08 15:08:32'),
	(267,141,'',NULL,NULL,'images/ProductImageSuppliers/8yL45Din9ySXjyuasTXGdf4_7N-tPo27.png','images/ProductImageSuppliers/thumbnail1/8yL45Din9ySXjyuasTXGdf4_7N-tPo27.png','images/ProductImageSuppliers/thumbnail2/8yL45Din9ySXjyuasTXGdf4_7N-tPo27.png',1,NULL,'2016-12-08 15:08:32','2016-12-08 15:08:32'),
	(268,142,'',NULL,NULL,'images/ProductImageSuppliers/atsBxWOewUhZ6e6q9mcS9awX0QaOU-Q2.jpg','images/ProductImageSuppliers/thumbnail1/atsBxWOewUhZ6e6q9mcS9awX0QaOU-Q2.jpg','images/ProductImageSuppliers/thumbnail2/atsBxWOewUhZ6e6q9mcS9awX0QaOU-Q2.jpg',1,NULL,'2016-12-08 15:10:30','2016-12-08 15:10:30'),
	(269,142,'',NULL,NULL,'images/ProductImageSuppliers/F-bewxtzhN3hgo4hZ-y98hATS4rOf-ud.jpg','images/ProductImageSuppliers/thumbnail1/F-bewxtzhN3hgo4hZ-y98hATS4rOf-ud.jpg','images/ProductImageSuppliers/thumbnail2/F-bewxtzhN3hgo4hZ-y98hATS4rOf-ud.jpg',1,NULL,'2016-12-08 15:10:30','2016-12-08 15:10:30'),
	(270,142,'',NULL,NULL,'images/ProductImageSuppliers/ARBFn_Rgjbs2TIO-WTvbVaTiT1QqvmrM.jpg','images/ProductImageSuppliers/thumbnail1/ARBFn_Rgjbs2TIO-WTvbVaTiT1QqvmrM.jpg','images/ProductImageSuppliers/thumbnail2/ARBFn_Rgjbs2TIO-WTvbVaTiT1QqvmrM.jpg',1,NULL,'2016-12-08 15:10:30','2016-12-08 15:10:30'),
	(271,142,'',NULL,NULL,'images/ProductImageSuppliers/g99rEYeVrvGheoIujusk_Dng-9hpcJcE.jpg','images/ProductImageSuppliers/thumbnail1/g99rEYeVrvGheoIujusk_Dng-9hpcJcE.jpg','images/ProductImageSuppliers/thumbnail2/g99rEYeVrvGheoIujusk_Dng-9hpcJcE.jpg',1,NULL,'2016-12-08 15:10:30','2016-12-08 15:10:30'),
	(272,143,'',NULL,NULL,'images/ProductImageSuppliers/2VAfEF5yRSDRxHS2voUN-SrtvWco60rG.jpg','images/ProductImageSuppliers/thumbnail1/2VAfEF5yRSDRxHS2voUN-SrtvWco60rG.jpg','images/ProductImageSuppliers/thumbnail2/2VAfEF5yRSDRxHS2voUN-SrtvWco60rG.jpg',1,NULL,'2016-12-09 11:01:11','2016-12-09 11:01:11'),
	(273,144,'',NULL,NULL,'images/ProductImageSuppliers/PcjSAGgF67Hmw2VbOpM81-aIM4ofd6F0.jpg','images/ProductImageSuppliers/thumbnail1/PcjSAGgF67Hmw2VbOpM81-aIM4ofd6F0.jpg','images/ProductImageSuppliers/thumbnail2/PcjSAGgF67Hmw2VbOpM81-aIM4ofd6F0.jpg',1,NULL,'2016-12-15 07:43:26','2016-12-15 07:43:26'),
	(274,144,'',NULL,NULL,'images/ProductImageSuppliers/1Ai7F2YP5m7K85Z8rIdCzRNgvpGnZ1uI.jpg','images/ProductImageSuppliers/thumbnail1/1Ai7F2YP5m7K85Z8rIdCzRNgvpGnZ1uI.jpg','images/ProductImageSuppliers/thumbnail2/1Ai7F2YP5m7K85Z8rIdCzRNgvpGnZ1uI.jpg',1,NULL,'2016-12-15 07:43:38','2016-12-15 07:43:38'),
	(297,154,'',NULL,NULL,'images/ProductImageSuppliers/-GcBY0zmkI3-4O12Y5qGNbBAvZUpBUyJ.png','images/ProductImageSuppliers/thumbnail1/-GcBY0zmkI3-4O12Y5qGNbBAvZUpBUyJ.png','images/ProductImageSuppliers/thumbnail2/-GcBY0zmkI3-4O12Y5qGNbBAvZUpBUyJ.png',1,NULL,'2016-12-27 08:58:21','2016-12-27 08:58:21'),
	(299,161,'',NULL,NULL,'images/ProductImageSuppliers/PFKfHAPeSC8zqR3QfnBSFmiZpshAE3oX.jpg','images/ProductImageSuppliers/thumbnail1/PFKfHAPeSC8zqR3QfnBSFmiZpshAE3oX.jpg','images/ProductImageSuppliers/thumbnail2/PFKfHAPeSC8zqR3QfnBSFmiZpshAE3oX.jpg',1,NULL,'2016-12-27 13:12:41','2016-12-27 13:12:41'),
	(300,161,'',NULL,NULL,'images/ProductImageSuppliers/2fuGbr5CYzlIjWfvnCwJdi4bmCL_5rFE.jpg','images/ProductImageSuppliers/thumbnail1/2fuGbr5CYzlIjWfvnCwJdi4bmCL_5rFE.jpg','images/ProductImageSuppliers/thumbnail2/2fuGbr5CYzlIjWfvnCwJdi4bmCL_5rFE.jpg',1,NULL,'2016-12-27 13:12:44','2016-12-27 13:12:44'),
	(301,159,'',NULL,NULL,'images/ProductImageSuppliers/9YvrP3LCjs8MBLl5mINKnHnk5zy5gIZc.jpg','images/ProductImageSuppliers/thumbnail1/9YvrP3LCjs8MBLl5mINKnHnk5zy5gIZc.jpg','images/ProductImageSuppliers/thumbnail2/9YvrP3LCjs8MBLl5mINKnHnk5zy5gIZc.jpg',1,NULL,'2016-12-27 13:14:02','2016-12-27 13:14:02'),
	(302,159,'',NULL,NULL,'images/ProductImageSuppliers/QLm884L5lIhjRbDvaZuU6oRIGU6wnyzK.jpg','images/ProductImageSuppliers/thumbnail1/QLm884L5lIhjRbDvaZuU6oRIGU6wnyzK.jpg','images/ProductImageSuppliers/thumbnail2/QLm884L5lIhjRbDvaZuU6oRIGU6wnyzK.jpg',1,NULL,'2016-12-27 13:14:03','2016-12-27 13:14:03'),
	(303,162,'',NULL,NULL,'images/ProductImageSuppliers/A2tO1Nyx2pGb--svrBkOITXsRwt6TP-q.png','images/ProductImageSuppliers/thumbnail1/A2tO1Nyx2pGb--svrBkOITXsRwt6TP-q.png','images/ProductImageSuppliers/thumbnail2/A2tO1Nyx2pGb--svrBkOITXsRwt6TP-q.png',1,NULL,'2016-12-27 13:19:19','2016-12-27 13:19:19'),
	(304,162,'',NULL,NULL,'images/ProductImageSuppliers/FzIXKMp0a5oeua_dP6gcTXFeab_N7eFo.png','images/ProductImageSuppliers/thumbnail1/FzIXKMp0a5oeua_dP6gcTXFeab_N7eFo.png','images/ProductImageSuppliers/thumbnail2/FzIXKMp0a5oeua_dP6gcTXFeab_N7eFo.png',1,NULL,'2016-12-27 13:19:19','2016-12-27 13:19:19'),
	(305,162,'',NULL,NULL,'images/ProductImageSuppliers/3vBxV8JeWnwpVOWJKEP_f-IUyQTwhUBh.png','images/ProductImageSuppliers/thumbnail1/3vBxV8JeWnwpVOWJKEP_f-IUyQTwhUBh.png','images/ProductImageSuppliers/thumbnail2/3vBxV8JeWnwpVOWJKEP_f-IUyQTwhUBh.png',1,NULL,'2016-12-27 13:19:20','2016-12-27 13:19:20'),
	(306,155,'',NULL,NULL,'images/ProductImageSuppliers/UpzdwFkZ9JsACS8PWqBe_acEIKmrx_4G.png','images/ProductImageSuppliers/thumbnail1/UpzdwFkZ9JsACS8PWqBe_acEIKmrx_4G.png','images/ProductImageSuppliers/thumbnail2/UpzdwFkZ9JsACS8PWqBe_acEIKmrx_4G.png',1,NULL,'2016-12-27 13:35:14','2016-12-27 13:35:14'),
	(307,148,'',NULL,NULL,'images/ProductImageSuppliers/d6Bx3nyEg5JAGEI_rCZz9reSstbnfC9W.jpg','images/ProductImageSuppliers/thumbnail1/d6Bx3nyEg5JAGEI_rCZz9reSstbnfC9W.jpg','images/ProductImageSuppliers/thumbnail2/d6Bx3nyEg5JAGEI_rCZz9reSstbnfC9W.jpg',1,NULL,'2016-12-27 13:35:47','2016-12-27 13:35:47'),
	(308,148,'',NULL,NULL,'images/ProductImageSuppliers/U8xr0JQlzcSyrD6rPNgzwo6s0PXULIoF.jpg','images/ProductImageSuppliers/thumbnail1/U8xr0JQlzcSyrD6rPNgzwo6s0PXULIoF.jpg','images/ProductImageSuppliers/thumbnail2/U8xr0JQlzcSyrD6rPNgzwo6s0PXULIoF.jpg',1,NULL,'2016-12-27 13:35:50','2016-12-27 13:35:50'),
	(309,145,'',NULL,NULL,'images/ProductImageSuppliers/IEby0uSUtkNCmK9QBP9wX4hjuv8bWznf.jpg','images/ProductImageSuppliers/thumbnail1/IEby0uSUtkNCmK9QBP9wX4hjuv8bWznf.jpg','images/ProductImageSuppliers/thumbnail2/IEby0uSUtkNCmK9QBP9wX4hjuv8bWznf.jpg',1,NULL,'2016-12-27 13:36:48','2016-12-27 13:36:48'),
	(310,145,'',NULL,NULL,'images/ProductImageSuppliers/1mnP2JwDTmk9wk6pGwp0ZE2Zm8H6FyzV.jpg','images/ProductImageSuppliers/thumbnail1/1mnP2JwDTmk9wk6pGwp0ZE2Zm8H6FyzV.jpg','images/ProductImageSuppliers/thumbnail2/1mnP2JwDTmk9wk6pGwp0ZE2Zm8H6FyzV.jpg',1,NULL,'2016-12-27 13:36:52','2016-12-27 13:36:52'),
	(311,146,'',NULL,NULL,'images/ProductImageSuppliers/UGz1F7VfXS-Qi4peiXsTEH5m59nZZI-w.jpg','images/ProductImageSuppliers/thumbnail1/UGz1F7VfXS-Qi4peiXsTEH5m59nZZI-w.jpg','images/ProductImageSuppliers/thumbnail2/UGz1F7VfXS-Qi4peiXsTEH5m59nZZI-w.jpg',1,NULL,'2016-12-27 13:37:17','2016-12-27 13:37:17'),
	(312,150,'',NULL,NULL,'images/ProductImageSuppliers/GnYjB0xN9p74FDS78W3Ett_uEWJJ7_ar.png','images/ProductImageSuppliers/thumbnail1/GnYjB0xN9p74FDS78W3Ett_uEWJJ7_ar.png','images/ProductImageSuppliers/thumbnail2/GnYjB0xN9p74FDS78W3Ett_uEWJJ7_ar.png',1,NULL,'2016-12-27 13:38:59','2016-12-27 13:38:59'),
	(313,150,'',NULL,NULL,'images/ProductImageSuppliers/t4o7sM4jbvEWbO__SoLkhlYjo_9K9paF.png','images/ProductImageSuppliers/thumbnail1/t4o7sM4jbvEWbO__SoLkhlYjo_9K9paF.png','images/ProductImageSuppliers/thumbnail2/t4o7sM4jbvEWbO__SoLkhlYjo_9K9paF.png',1,NULL,'2016-12-27 13:39:09','2016-12-27 13:39:09'),
	(314,150,'',NULL,NULL,'images/ProductImageSuppliers/PsCZGktJZcA7Yk-0ZbxoCXSBW75r1Xio.png','images/ProductImageSuppliers/thumbnail1/PsCZGktJZcA7Yk-0ZbxoCXSBW75r1Xio.png','images/ProductImageSuppliers/thumbnail2/PsCZGktJZcA7Yk-0ZbxoCXSBW75r1Xio.png',1,NULL,'2016-12-27 13:39:12','2016-12-27 13:39:12'),
	(315,150,'',NULL,NULL,'images/ProductImageSuppliers/KGnwMz3uIUnQdeGIYY9rmzvQFOLAOIXG.png','images/ProductImageSuppliers/thumbnail1/KGnwMz3uIUnQdeGIYY9rmzvQFOLAOIXG.png','images/ProductImageSuppliers/thumbnail2/KGnwMz3uIUnQdeGIYY9rmzvQFOLAOIXG.png',1,NULL,'2016-12-27 13:39:12','2016-12-27 13:39:12'),
	(316,150,'',NULL,NULL,'images/ProductImageSuppliers/Evpm87nTrT8bwRG_e0TxFwmPw7Lx8K0C.png','images/ProductImageSuppliers/thumbnail1/Evpm87nTrT8bwRG_e0TxFwmPw7Lx8K0C.png','images/ProductImageSuppliers/thumbnail2/Evpm87nTrT8bwRG_e0TxFwmPw7Lx8K0C.png',1,NULL,'2016-12-27 13:39:13','2016-12-27 13:39:13'),
	(317,158,'',NULL,NULL,'images/ProductImageSuppliers/ejBIKwNzsMf7RNILnWH4WDGfeNvQ4nIg.jpg','images/ProductImageSuppliers/thumbnail1/ejBIKwNzsMf7RNILnWH4WDGfeNvQ4nIg.jpg','images/ProductImageSuppliers/thumbnail2/ejBIKwNzsMf7RNILnWH4WDGfeNvQ4nIg.jpg',1,NULL,'2016-12-27 13:42:57','2016-12-27 13:42:57'),
	(318,158,'',NULL,NULL,'images/ProductImageSuppliers/hEojOueqDOBTK2PJr789aGSfHQ5r02JQ.jpg','images/ProductImageSuppliers/thumbnail1/hEojOueqDOBTK2PJr789aGSfHQ5r02JQ.jpg','images/ProductImageSuppliers/thumbnail2/hEojOueqDOBTK2PJr789aGSfHQ5r02JQ.jpg',1,NULL,'2016-12-27 13:43:24','2016-12-27 13:43:24'),
	(322,152,'',NULL,NULL,'images/ProductImageSuppliers/BChKyW-eXkSuv6YMmZE_z9ZPaqPBpfyY.jpg','images/ProductImageSuppliers/thumbnail1/BChKyW-eXkSuv6YMmZE_z9ZPaqPBpfyY.jpg','images/ProductImageSuppliers/thumbnail2/BChKyW-eXkSuv6YMmZE_z9ZPaqPBpfyY.jpg',1,NULL,'2016-12-27 14:02:11','2016-12-27 14:02:11'),
	(323,152,'',NULL,NULL,'images/ProductImageSuppliers/nkK9LUxDIFi07QEaxbyZ144NQ2KKYqh8.jpg','images/ProductImageSuppliers/thumbnail1/nkK9LUxDIFi07QEaxbyZ144NQ2KKYqh8.jpg','images/ProductImageSuppliers/thumbnail2/nkK9LUxDIFi07QEaxbyZ144NQ2KKYqh8.jpg',1,NULL,'2016-12-27 14:02:13','2016-12-27 14:02:13'),
	(324,152,'',NULL,NULL,'images/ProductImageSuppliers/ijPSvSay_UNCm8y6OaeyW-W4l15dxQ1r.jpg','images/ProductImageSuppliers/thumbnail1/ijPSvSay_UNCm8y6OaeyW-W4l15dxQ1r.jpg','images/ProductImageSuppliers/thumbnail2/ijPSvSay_UNCm8y6OaeyW-W4l15dxQ1r.jpg',1,NULL,'2016-12-27 14:02:16','2016-12-27 14:02:16'),
	(325,157,'',NULL,NULL,'images/ProductImageSuppliers/WkRLz5mn-FZKWTA-Ko4adtruismgU3wU.jpg','images/ProductImageSuppliers/thumbnail1/WkRLz5mn-FZKWTA-Ko4adtruismgU3wU.jpg','images/ProductImageSuppliers/thumbnail2/WkRLz5mn-FZKWTA-Ko4adtruismgU3wU.jpg',1,NULL,'2016-12-27 14:03:53','2016-12-27 14:03:53'),
	(326,157,'',NULL,NULL,'images/ProductImageSuppliers/652rAKZ4wCRzzgwH2JGiWKdh-oOjrLN1.jpg','images/ProductImageSuppliers/thumbnail1/652rAKZ4wCRzzgwH2JGiWKdh-oOjrLN1.jpg','images/ProductImageSuppliers/thumbnail2/652rAKZ4wCRzzgwH2JGiWKdh-oOjrLN1.jpg',1,NULL,'2016-12-27 14:03:53','2016-12-27 14:03:53'),
	(327,151,'',NULL,NULL,'images/ProductImageSuppliers/Put9jHeFGEZsBTeaj5v1hC_CnWSfpOi-.jpg','images/ProductImageSuppliers/thumbnail1/Put9jHeFGEZsBTeaj5v1hC_CnWSfpOi-.jpg','images/ProductImageSuppliers/thumbnail2/Put9jHeFGEZsBTeaj5v1hC_CnWSfpOi-.jpg',1,NULL,'2016-12-27 14:04:25','2016-12-27 14:04:25'),
	(328,151,'',NULL,NULL,'images/ProductImageSuppliers/fQey-x8TQejuN9sXXgOhztodLrFWoLQi.jpg','images/ProductImageSuppliers/thumbnail1/fQey-x8TQejuN9sXXgOhztodLrFWoLQi.jpg','images/ProductImageSuppliers/thumbnail2/fQey-x8TQejuN9sXXgOhztodLrFWoLQi.jpg',1,NULL,'2016-12-27 14:04:26','2016-12-27 14:04:26'),
	(329,151,'',NULL,NULL,'images/ProductImageSuppliers/P76hiReVNTE4h6Q7XeLJX0NSP4FL9cyG.jpg','images/ProductImageSuppliers/thumbnail1/P76hiReVNTE4h6Q7XeLJX0NSP4FL9cyG.jpg','images/ProductImageSuppliers/thumbnail2/P76hiReVNTE4h6Q7XeLJX0NSP4FL9cyG.jpg',1,NULL,'2016-12-27 14:04:26','2016-12-27 14:04:26'),
	(330,151,'',NULL,NULL,'images/ProductImageSuppliers/wYVH5yql9luDNGnDjwS6gwYfa_JQ8N5V.jpg','images/ProductImageSuppliers/thumbnail1/wYVH5yql9luDNGnDjwS6gwYfa_JQ8N5V.jpg','images/ProductImageSuppliers/thumbnail2/wYVH5yql9luDNGnDjwS6gwYfa_JQ8N5V.jpg',1,NULL,'2016-12-27 14:04:26','2016-12-27 14:04:26'),
	(331,147,'',NULL,NULL,'images/ProductImageSuppliers/hhUQWHRuVx2JknrzQic7X6SEskcDslgz.jpeg','images/ProductImageSuppliers/thumbnail1/hhUQWHRuVx2JknrzQic7X6SEskcDslgz.jpeg','images/ProductImageSuppliers/thumbnail2/hhUQWHRuVx2JknrzQic7X6SEskcDslgz.jpeg',1,NULL,'2016-12-27 14:05:09','2016-12-27 14:05:09'),
	(332,147,'',NULL,NULL,'images/ProductImageSuppliers/6_m-sYUF2w0DTzBSsVccdw8hgp-N9ZgZ.jpg','images/ProductImageSuppliers/thumbnail1/6_m-sYUF2w0DTzBSsVccdw8hgp-N9ZgZ.jpg','images/ProductImageSuppliers/thumbnail2/6_m-sYUF2w0DTzBSsVccdw8hgp-N9ZgZ.jpg',1,NULL,'2016-12-27 14:05:09','2016-12-27 14:05:09'),
	(333,163,'',NULL,NULL,'images/ProductImageSuppliers/D-SrnRaGpWyUfaBYSdB1epy6sC-5R9_8.jpg','images/ProductImageSuppliers/thumbnail1/D-SrnRaGpWyUfaBYSdB1epy6sC-5R9_8.jpg','images/ProductImageSuppliers/thumbnail2/D-SrnRaGpWyUfaBYSdB1epy6sC-5R9_8.jpg',1,NULL,'2016-12-27 16:05:57','2016-12-27 16:05:57'),
	(334,163,'',NULL,NULL,'images/ProductImageSuppliers/ECzDJKrqqwvWdh0eivBC2Ln6sx5S4Hnw.jpg','images/ProductImageSuppliers/thumbnail1/ECzDJKrqqwvWdh0eivBC2Ln6sx5S4Hnw.jpg','images/ProductImageSuppliers/thumbnail2/ECzDJKrqqwvWdh0eivBC2Ln6sx5S4Hnw.jpg',1,NULL,'2016-12-27 16:05:57','2016-12-27 16:05:57'),
	(335,163,'',NULL,NULL,'images/ProductImageSuppliers/RiXnRyQQaQk6BR-VLKgPve6K8sfroQFm.jpg','images/ProductImageSuppliers/thumbnail1/RiXnRyQQaQk6BR-VLKgPve6K8sfroQFm.jpg','images/ProductImageSuppliers/thumbnail2/RiXnRyQQaQk6BR-VLKgPve6K8sfroQFm.jpg',1,NULL,'2016-12-27 16:05:58','2016-12-27 16:05:58'),
	(336,166,'',NULL,NULL,'images/ProductImageSuppliers/gPEtvKyfF5QmwVu0VA6-XIwVPCF3XMq3.jpg','images/ProductImageSuppliers/thumbnail1/gPEtvKyfF5QmwVu0VA6-XIwVPCF3XMq3.jpg','images/ProductImageSuppliers/thumbnail2/gPEtvKyfF5QmwVu0VA6-XIwVPCF3XMq3.jpg',1,NULL,'2017-01-09 16:15:29','2017-01-09 16:15:29'),
	(337,166,'',NULL,NULL,'images/ProductImageSuppliers/v1iEVNR1_5akiSPNEBIBkFac2fVQFKHh.jpg','images/ProductImageSuppliers/thumbnail1/v1iEVNR1_5akiSPNEBIBkFac2fVQFKHh.jpg','images/ProductImageSuppliers/thumbnail2/v1iEVNR1_5akiSPNEBIBkFac2fVQFKHh.jpg',1,NULL,'2017-01-09 16:15:29','2017-01-09 16:15:29'),
	(338,166,'',NULL,NULL,'images/ProductImageSuppliers/R3yrrBcUxP5-PMAVuX6NrUhiMgP6oNpH.jpg','images/ProductImageSuppliers/thumbnail1/R3yrrBcUxP5-PMAVuX6NrUhiMgP6oNpH.jpg','images/ProductImageSuppliers/thumbnail2/R3yrrBcUxP5-PMAVuX6NrUhiMgP6oNpH.jpg',1,NULL,'2017-01-09 16:15:29','2017-01-09 16:15:29'),
	(339,167,'',NULL,NULL,'images/ProductImageSuppliers/gVuxWevJP0s8h3nOmmJk62FZkpLXTVsm.jpg','images/ProductImageSuppliers/thumbnail1/gVuxWevJP0s8h3nOmmJk62FZkpLXTVsm.jpg','images/ProductImageSuppliers/thumbnail2/gVuxWevJP0s8h3nOmmJk62FZkpLXTVsm.jpg',1,NULL,'2017-01-09 16:29:28','2017-01-09 16:29:28'),
	(340,167,'',NULL,NULL,'images/ProductImageSuppliers/G5rX8dBAkUeLQ2FM9bCESxMmyHTcVExu.jpg','images/ProductImageSuppliers/thumbnail1/G5rX8dBAkUeLQ2FM9bCESxMmyHTcVExu.jpg','images/ProductImageSuppliers/thumbnail2/G5rX8dBAkUeLQ2FM9bCESxMmyHTcVExu.jpg',1,NULL,'2017-01-09 16:29:29','2017-01-09 16:29:29'),
	(341,167,'',NULL,NULL,'images/ProductImageSuppliers/Py5AawWzEKDQSagCiUe4viwIWNEJq2Ac.jpg','images/ProductImageSuppliers/thumbnail1/Py5AawWzEKDQSagCiUe4viwIWNEJq2Ac.jpg','images/ProductImageSuppliers/thumbnail2/Py5AawWzEKDQSagCiUe4viwIWNEJq2Ac.jpg',1,NULL,'2017-01-09 16:29:29','2017-01-09 16:29:29'),
	(342,167,'',NULL,NULL,'images/ProductImageSuppliers/iWgtbpq-GpaOYqyYUK2mGVCrVQUdEGKZ.jpg','images/ProductImageSuppliers/thumbnail1/iWgtbpq-GpaOYqyYUK2mGVCrVQUdEGKZ.jpg','images/ProductImageSuppliers/thumbnail2/iWgtbpq-GpaOYqyYUK2mGVCrVQUdEGKZ.jpg',1,NULL,'2017-01-09 16:29:29','2017-01-09 16:29:29');

/*!40000 ALTER TABLE `product_image_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price`;

CREATE TABLE `product_price` (
  `productPriceId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) unsigned NOT NULL,
  `quantity` decimal(5,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `discountType` tinyint(4) DEFAULT NULL,
  `discountValue` decimal(15,2) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPriceId`),
  KEY `fk_pp_to_p_idx` (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_price` WRITE;
/*!40000 ALTER TABLE `product_price` DISABLE KEYS */;

INSERT INTO `product_price` (`productPriceId`, `productId`, `quantity`, `price`, `discountType`, `discountValue`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,1.00,1400.00,1,0.00,'',1,'2016-08-30 11:39:04','2016-09-29 10:06:38'),
	(2,1,2.00,1400.00,1,100.00,'',1,'2016-08-30 11:41:56','2016-10-04 11:03:54'),
	(3,1,3.00,1400.00,1,200.00,'',1,'2016-08-30 11:43:31','2016-10-04 11:03:59'),
	(4,1,4.00,1400.00,1,300.00,'',1,'2016-08-30 11:44:17','2016-10-04 11:04:05'),
	(5,1,5.00,1400.00,1,400.00,'',1,'2016-08-30 11:44:22','2016-10-04 11:04:10'),
	(6,1,6.00,1400.00,1,500.00,'',1,'2016-08-30 11:45:51','2016-10-04 11:04:16'),
	(7,2,1.00,725.00,1,NULL,'',1,'2016-08-30 11:46:30','2016-08-30 11:46:30'),
	(8,3,1.00,1060.00,1,NULL,'',1,'2016-08-30 13:06:53','2016-08-30 13:06:53'),
	(9,4,1.00,1110.00,1,NULL,'',1,'2016-08-30 13:10:43','2016-08-30 13:10:43'),
	(10,5,1.00,765.00,1,NULL,'',1,'2016-08-30 13:13:39','2016-10-04 11:08:25'),
	(11,6,1.00,1190.00,1,NULL,'',1,'2016-08-30 13:16:18','2016-08-30 13:16:18'),
	(12,7,1.00,1090.00,1,NULL,'',1,'2016-08-30 13:18:52','2016-08-30 13:18:52'),
	(13,8,1.00,1100.00,1,NULL,'',1,'2016-08-30 13:21:49','2016-09-27 15:16:48'),
	(14,7,2.00,1090.00,1,110.00,'',1,'2016-09-09 08:56:39','2016-10-04 11:09:16'),
	(15,5,2.00,765.00,1,100.00,'',1,'2016-09-09 09:01:09','2016-10-04 11:08:30'),
	(16,5,3.00,765.00,1,200.00,'',1,'2016-09-09 09:01:29','2016-10-04 11:08:35'),
	(17,5,4.00,765.00,1,300.00,'',1,'2016-09-09 09:01:34','2016-10-04 11:08:43'),
	(18,9,1.00,990.00,1,0.00,'',1,'2016-09-09 09:03:57','2016-09-09 09:04:10'),
	(19,10,1.00,950.00,1,NULL,'',1,'2016-09-09 09:45:49','2016-09-09 09:45:49'),
	(20,11,1.00,8330.00,1,NULL,'',1,'2016-09-09 10:04:05','2016-09-19 10:09:03'),
	(21,12,1.00,2200.00,1,NULL,'',1,'2016-09-13 10:16:01','2016-09-13 10:16:01'),
	(22,13,1.00,1200.00,1,NULL,'',1,'2016-09-13 10:19:01','2016-09-13 10:19:01'),
	(23,13,1.00,1200.00,1,NULL,'',1,'2016-09-13 10:20:15','2016-09-13 10:20:15'),
	(24,14,1.00,1200.00,1,NULL,'',1,'2016-09-13 10:20:28','2016-09-13 10:20:28'),
	(25,11,2.00,8330.00,1,830.00,'',1,'2016-09-13 10:23:17','2016-10-04 11:10:49'),
	(26,11,3.00,8330.00,1,1330.00,'',1,'2016-09-13 10:23:26','2016-10-04 11:10:54'),
	(27,15,1.00,45000.00,1,NULL,'',1,'2016-09-13 10:23:37','2016-09-13 10:23:37'),
	(28,16,1.00,1800.00,1,NULL,'',1,'2016-09-13 11:43:36','2016-09-27 15:49:20'),
	(29,17,1.00,5300.00,1,NULL,'',1,'2016-09-13 11:46:58','2016-09-13 11:46:58'),
	(30,19,1.00,3800.00,1,NULL,'',1,'2016-09-13 11:50:20','2016-09-13 11:50:20'),
	(31,10,1.00,2650.00,1,NULL,'',1,'2016-09-14 09:01:13','2016-09-14 09:01:13'),
	(32,20,1.00,2650.00,1,NULL,'',1,'2016-09-14 09:01:29','2016-09-14 09:01:29'),
	(33,22,1.00,3900.00,1,NULL,'',1,'2016-09-14 09:04:43','2016-09-14 09:04:43'),
	(34,7,3.00,1090.00,1,240.00,'',1,'2016-09-14 09:07:40','2016-10-04 11:09:44'),
	(36,7,4.00,1090.00,1,340.00,'',1,'2016-09-14 09:08:19','2016-10-04 11:09:49'),
	(46,24,1.00,850.00,1,0.00,'',1,'2016-09-14 09:49:39','2016-09-14 09:52:17'),
	(47,2,2.00,725.00,1,125.00,'',1,'2016-09-16 10:28:20','2016-10-04 11:05:16'),
	(48,2,3.00,725.00,1,225.00,'',1,'2016-09-16 10:28:31','2016-10-04 11:05:21'),
	(49,2,4.00,725.00,1,325.00,'',1,'2016-09-16 10:29:05','2016-10-04 11:05:25'),
	(50,26,1.00,725.00,1,NULL,'',1,'2016-09-16 10:29:36','2016-09-16 10:29:36'),
	(51,27,1.00,765.00,1,NULL,'',1,'2016-09-16 10:31:11','2016-09-16 10:31:11'),
	(52,28,1.00,1450.00,1,NULL,'',1,'2016-09-19 10:17:13','2016-09-19 10:17:13'),
	(53,29,1.00,4630.00,1,NULL,'',1,'2016-09-19 10:20:55','2016-09-19 10:20:55'),
	(54,30,1.00,550.00,1,NULL,'',1,'2016-09-19 10:23:09','2016-11-06 19:24:37'),
	(55,24,1.00,895.00,1,NULL,'',1,'2016-09-19 10:25:15','2016-09-19 10:25:15'),
	(56,31,1.00,895.00,1,NULL,'',1,'2016-09-19 10:25:35','2016-09-19 10:25:35'),
	(57,32,1.00,1105.00,1,NULL,'',1,'2016-09-19 10:28:14','2016-09-19 10:28:14'),
	(58,33,1.00,2765.00,1,NULL,'',1,'2016-09-19 10:31:26','2016-09-19 10:31:26'),
	(59,34,1.00,3000.00,1,NULL,'',1,'2016-09-20 09:41:47','2016-11-06 19:52:03'),
	(60,35,1.00,3350.00,1,NULL,'',1,'2016-09-22 15:36:15','2016-09-22 15:36:15'),
	(61,36,1.00,12500.00,1,NULL,'',1,'2016-09-22 15:43:43','2016-09-22 15:43:43'),
	(62,37,1.00,2380.00,1,NULL,'',1,'2016-09-22 15:49:34','2016-09-22 15:49:34'),
	(63,30,2.00,550.00,1,15.00,'',1,'2016-09-27 08:51:42','2016-11-06 19:24:52'),
	(64,30,3.00,550.00,1,25.00,'',1,'2016-09-27 08:52:20','2016-11-06 19:24:59'),
	(65,30,4.00,550.00,1,35.00,'',1,'2016-09-27 08:52:32','2016-11-06 19:25:06'),
	(67,6,2.00,900.00,1,160.00,'',1,'2016-09-27 14:28:06','2016-09-27 14:28:06'),
	(68,6,2.00,900.00,1,160.00,'',1,'2016-09-27 14:28:20','2016-09-27 14:28:20'),
	(69,6,2.00,900.00,1,160.00,'',1,'2016-09-27 14:28:46','2016-09-27 14:28:46'),
	(70,3,2.00,1060.00,1,160.00,'',1,'2016-09-27 14:29:52','2016-10-04 11:05:43'),
	(71,3,3.00,1060.00,1,260.00,'',1,'2016-09-27 14:30:36','2016-10-04 11:05:48'),
	(72,3,4.00,1060.00,1,360.00,'',1,'2016-09-27 14:30:59','2016-10-04 11:05:53'),
	(73,4,2.00,1110.00,1,100.00,'',1,'2016-09-27 14:34:25','2016-10-04 11:06:13'),
	(74,4,3.00,1110.00,1,200.00,'',1,'2016-09-27 14:34:44','2016-10-04 11:06:18'),
	(75,4,4.00,1110.00,1,300.00,'',1,'2016-09-27 14:35:07','2016-10-04 11:06:23'),
	(76,8,2.00,1100.00,1,100.00,'',1,'2016-09-27 15:17:14','2016-10-04 11:10:04'),
	(77,8,3.00,1100.00,1,200.00,'',1,'2016-09-27 15:17:31','2016-10-04 11:10:09'),
	(78,8,4.00,1100.00,1,300.00,'',1,'2016-09-27 15:17:59','2016-10-04 11:10:18'),
	(80,16,2.00,1800.00,1,300.00,'',1,'2016-09-27 15:28:21','2016-10-04 11:11:40'),
	(81,11,4.00,8330.00,1,1830.00,'',1,'2016-09-27 15:42:55','2016-10-04 11:11:09'),
	(82,16,3.00,1800.00,1,600.00,'',1,'2016-09-27 15:49:52','2016-10-04 11:11:45'),
	(83,16,4.00,1800.00,1,800.00,'',1,'2016-09-27 15:50:26','2016-10-04 11:11:57'),
	(84,32,2.00,1105.00,1,105.00,'',1,'2016-09-27 15:58:19','2016-10-04 11:18:34'),
	(85,32,3.00,1105.00,1,205.00,'',1,'2016-09-27 15:58:37','2016-10-04 11:18:54'),
	(86,32,4.00,1105.00,1,405.00,'',1,'2016-09-27 15:58:59','2016-10-04 11:18:59'),
	(87,39,1.00,2400.00,1,0.00,'',1,'2016-09-29 10:05:26','2016-09-29 10:06:57'),
	(88,39,2.00,2400.00,1,450.00,'',1,'2016-09-29 10:05:51','2016-10-04 11:27:15'),
	(89,40,1.00,20700.00,1,NULL,'',1,'2016-09-29 14:58:34','2016-09-29 14:58:34'),
	(90,40,2.00,20700.00,1,200.00,'',1,'2016-09-29 14:58:50','2016-10-04 11:26:52'),
	(91,40,3.00,20700.00,1,300.00,'',1,'2016-09-29 14:59:05','2016-10-04 11:26:57'),
	(92,40,4.00,20700.00,1,400.00,'',1,'2016-09-29 14:59:16','2016-10-04 11:27:02'),
	(93,41,1.00,3300.00,1,NULL,'',1,'2016-09-29 15:04:26','2016-09-29 15:04:26'),
	(94,41,2.00,3300.00,1,100.00,'',1,'2016-09-29 15:04:37','2016-10-04 11:26:28'),
	(95,41,3.00,3300.00,1,200.00,'',1,'2016-09-29 15:04:47','2016-10-04 11:26:32'),
	(96,41,4.00,3300.00,1,300.00,'',1,'2016-09-29 15:04:59','2016-10-04 11:26:37'),
	(97,42,1.00,4800.00,1,NULL,'',1,'2016-09-29 15:08:03','2016-09-29 15:08:03'),
	(98,42,2.00,4800.00,1,200.00,'',1,'2016-09-29 15:08:12','2016-10-04 11:28:07'),
	(99,42,3.00,4800.00,1,400.00,'',1,'2016-09-29 15:08:32','2016-10-04 11:28:11'),
	(100,42,4.00,4800.00,1,600.00,'',1,'2016-09-29 15:08:56','2016-10-04 11:28:16'),
	(101,43,1.00,4950.00,1,NULL,'',1,'2016-09-29 15:19:58','2016-09-29 15:19:58'),
	(102,43,2.00,4950.00,1,350.00,'',1,'2016-09-29 15:20:20','2016-10-04 11:28:34'),
	(103,43,3.00,4950.00,1,550.00,'',1,'2016-09-29 15:20:39','2016-10-04 11:28:38'),
	(104,43,4.00,4950.00,1,750.00,'',1,'2016-09-29 15:20:57','2016-10-04 11:28:43'),
	(105,44,1.00,10800.00,1,NULL,'',1,'2016-09-29 15:23:18','2016-09-29 15:23:18'),
	(106,44,2.00,10800.00,1,500.00,'',1,'2016-09-29 15:24:03','2016-10-04 11:29:05'),
	(107,44,3.00,10800.00,1,700.00,'',1,'2016-09-29 15:24:28','2016-10-04 11:29:10'),
	(108,44,4.00,10800.00,1,1000.00,'',1,'2016-09-29 15:24:49','2016-10-04 11:29:14'),
	(109,45,1.00,2400.00,1,NULL,'',1,'2016-09-29 15:29:25','2016-09-29 15:29:25'),
	(110,45,2.00,2200.00,1,200.00,'',1,'2016-09-29 15:29:35','2016-09-29 15:29:35'),
	(111,45,2.00,2000.00,1,400.00,'',1,'2016-09-29 15:29:45','2016-09-29 15:29:45'),
	(112,45,4.00,1800.00,1,600.00,'',1,'2016-09-29 15:30:00','2016-09-29 15:30:00'),
	(113,46,1.00,2500.00,1,NULL,'',1,'2016-09-29 15:32:03','2016-09-29 15:32:03'),
	(114,46,2.00,2300.00,1,200.00,'',1,'2016-09-29 15:32:28','2016-09-29 15:32:28'),
	(115,46,3.00,2100.00,1,400.00,'',1,'2016-09-29 15:32:55','2016-09-29 15:32:55'),
	(116,46,4.00,1900.00,1,600.00,'',1,'2016-09-29 15:33:09','2016-09-29 15:33:09'),
	(117,47,1.00,3500.00,1,NULL,'',1,'2016-09-29 15:36:59','2016-09-29 15:38:16'),
	(118,47,2.00,3200.00,1,300.00,'',1,'2016-09-29 15:37:10','2016-09-29 15:37:10'),
	(119,47,3.00,3000.00,1,500.00,'',1,'2016-09-29 15:37:21','2016-09-29 15:37:21'),
	(120,47,4.00,2800.00,1,700.00,'',1,'2016-09-29 15:37:36','2016-09-29 15:37:36'),
	(121,48,1.00,5500.00,1,NULL,'',1,'2016-09-29 15:42:03','2016-09-29 15:42:03'),
	(122,48,2.00,5200.00,1,300.00,'',1,'2016-09-29 15:42:13','2016-09-29 15:42:13'),
	(123,48,3.00,5100.00,1,400.00,'',1,'2016-09-29 15:42:26','2016-09-29 15:42:26'),
	(124,48,4.00,5000.00,1,500.00,'',1,'2016-09-29 15:42:53','2016-09-29 15:42:53'),
	(125,49,1.00,8900.00,1,NULL,'',1,'2016-09-29 15:50:01','2016-09-29 15:50:01'),
	(126,49,2.00,8700.00,1,200.00,'',1,'2016-09-29 15:50:12','2016-09-29 15:50:12'),
	(127,49,3.00,8500.00,1,400.00,'',1,'2016-09-29 15:50:28','2016-09-29 15:50:28'),
	(128,49,4.00,8300.00,1,600.00,'',1,'2016-09-29 15:50:51','2016-09-29 15:50:51'),
	(129,50,1.00,1000.00,1,NULL,'',1,'2016-09-29 15:56:12','2016-09-29 15:56:12'),
	(130,50,2.00,800.00,1,200.00,'',1,'2016-09-29 15:56:23','2016-09-29 15:56:23'),
	(131,50,3.00,700.00,1,300.00,'',1,'2016-09-29 15:56:35','2016-09-29 15:56:35'),
	(132,50,4.00,600.00,1,400.00,'',1,'2016-09-29 15:56:46','2016-09-29 15:56:46'),
	(133,51,1.00,33000.00,1,NULL,'',1,'2016-09-29 16:01:51','2016-09-29 16:01:51'),
	(134,51,2.00,32000.00,1,1000.00,'',1,'2016-09-29 16:02:02','2016-09-29 16:02:11'),
	(135,51,3.00,31000.00,1,2000.00,'',1,'2016-09-29 16:02:22','2016-09-29 16:02:22'),
	(136,51,4.00,30000.00,1,3000.00,'',1,'2016-09-29 16:02:32','2016-09-29 16:02:32'),
	(137,52,1.00,20000.00,1,NULL,'',1,'2016-09-29 16:05:59','2016-09-29 16:05:59'),
	(138,52,2.00,18000.00,1,200.00,'',1,'2016-09-29 16:06:11','2016-09-29 16:06:11'),
	(139,52,3.00,16000.00,1,400.00,'',1,'2016-09-29 16:06:31','2016-09-29 16:06:31'),
	(140,52,4.00,14000.00,1,600.00,'',1,'2016-09-29 16:06:45','2016-09-29 16:06:45'),
	(141,19,2.00,3800.00,1,200.00,'',1,'2016-10-04 11:13:31','2016-10-04 11:13:31'),
	(142,22,2.00,3900.00,1,100.00,'',1,'2016-10-04 11:15:24','2016-10-04 11:15:24'),
	(143,34,2.00,3000.00,1,100.00,'',1,'2016-10-04 11:19:37','2016-11-06 19:52:10'),
	(144,35,2.00,3350.00,1,100.00,'',1,'2016-10-04 11:21:20','2016-10-04 11:21:20'),
	(145,36,2.00,12500.00,1,100.00,'',1,'2016-10-04 11:23:47','2016-10-04 11:23:47'),
	(146,37,2.00,2380.00,1,100.00,'',1,'2016-10-04 11:27:34','2016-10-04 11:27:34'),
	(147,53,1.00,119000.00,1,0.00,'',1,'2016-10-06 10:56:14','2016-10-06 10:56:29'),
	(148,54,1.00,149000.00,1,0.00,'',1,'2016-10-06 10:56:51','2016-10-06 10:56:51'),
	(149,34,3.00,3000.00,1,150.00,'',1,'2016-11-06 19:52:24','2016-11-06 19:52:32'),
	(150,55,1.00,100.00,1,0.00,'',1,'2016-11-21 09:27:06','2016-11-21 09:27:06'),
	(151,55,5.00,150.00,1,0.00,'<p>123</p>',1,'2016-11-24 10:23:00','2016-11-24 10:23:00'),
	(152,55,6.00,600.00,1,50.00,'<p>test</p>',1,'2016-11-24 10:24:40','2016-11-24 10:24:40'),
	(154,78,1.00,1500.00,2,1.50,'',1,'2016-12-08 13:30:10','2016-12-13 16:20:53'),
	(157,78,2.00,1500.00,2,2.00,'',1,'2016-12-13 16:19:49','2016-12-13 16:20:24'),
	(158,78,3.00,1500.00,2,2.50,'',1,'2016-12-13 16:20:04','2016-12-13 16:20:31'),
	(159,78,4.00,1500.00,2,3.00,'',1,'2016-12-13 16:20:13','2016-12-13 16:20:40'),
	(160,84,1.00,20.00,2,0.00,'',1,'2016-12-23 13:56:55','2016-12-23 14:59:32'),
	(161,84,2.00,20.00,2,5.00,'',1,'2016-12-23 13:57:23','2016-12-23 14:59:20'),
	(162,83,1.00,20.00,1,0.00,'',1,'2016-12-27 09:14:49','2016-12-27 09:16:02'),
	(163,83,2.00,20.00,1,5.00,'',1,'2016-12-27 09:15:16','2016-12-27 09:16:13'),
	(164,86,1.00,710.00,1,0.00,'',1,'2016-12-28 13:51:34','2016-12-28 13:51:34'),
	(165,86,2.00,710.00,1,1.00,'',1,'2016-12-28 13:51:49','2016-12-28 13:51:49'),
	(166,89,1.00,750.00,1,NULL,'',1,'2017-01-09 14:22:19','2017-01-09 14:24:08'),
	(167,89,2.00,750.00,1,NULL,'',1,'2017-01-09 14:23:07','2017-01-09 14:24:18'),
	(168,92,1.00,950.00,NULL,NULL,'',1,'2017-01-09 14:31:56','2017-01-09 14:31:56'),
	(169,92,2.00,950.00,NULL,NULL,'',1,'2017-01-09 14:32:06','2017-01-09 14:32:06'),
	(170,94,1.00,1450.00,NULL,NULL,'',1,'2017-01-09 16:31:08','2017-01-09 16:31:08'),
	(171,94,2.00,1400.00,NULL,NULL,'',1,'2017-01-09 16:31:27','2017-01-09 16:31:27'),
	(172,96,1.00,2969.00,NULL,NULL,'',1,'2017-01-11 09:36:34','2017-01-11 09:36:34'),
	(173,96,2.00,2900.00,1,NULL,'',1,'2017-01-11 09:36:52','2017-01-11 09:36:52'),
	(174,96,3.00,2800.00,1,NULL,'',1,'2017-01-11 09:37:06','2017-01-11 09:37:06');

/*!40000 ALTER TABLE `product_price` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_price_match
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price_match`;

CREATE TABLE `product_price_match` (
  `productPriceMatchId` bigint(20) NOT NULL AUTO_INCREMENT,
  `productPriceMatchGroupId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPriceMatchId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_price_match` WRITE;
/*!40000 ALTER TABLE `product_price_match` DISABLE KEYS */;

INSERT INTO `product_price_match` (`productPriceMatchId`, `productPriceMatchGroupId`, `productId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(6,3,35,1,'2016-10-11 14:06:20','2016-10-11 14:06:20'),
	(7,3,43,1,'2016-10-11 14:06:28','2016-10-11 14:06:28'),
	(8,3,41,1,'2016-10-11 14:06:39','2016-10-11 14:06:39'),
	(9,4,43,1,'2016-10-11 14:19:25','2016-10-11 14:19:25'),
	(10,4,37,1,'2016-10-11 14:19:40','2016-10-11 14:19:40'),
	(11,4,42,1,'2016-10-11 14:19:51','2016-10-11 14:19:51');

/*!40000 ALTER TABLE `product_price_match` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_price_match_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price_match_group`;

CREATE TABLE `product_price_match_group` (
  `productPriceMatchGroupId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `discountPercent` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPriceMatchGroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_price_match_group` WRITE;
/*!40000 ALTER TABLE `product_price_match_group` DISABLE KEYS */;

INSERT INTO `product_price_match_group` (`productPriceMatchGroupId`, `title`, `description`, `discountPercent`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(3,'sm1','',1,1,'2016-10-11 14:05:40','2016-10-11 14:09:14'),
	(4,'sm2','',1,1,'2016-10-11 14:19:07','2016-10-11 14:19:07');

/*!40000 ALTER TABLE `product_price_match_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_price_other_web
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price_other_web`;

CREATE TABLE `product_price_other_web` (
  `productPriceOtherWebId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) NOT NULL,
  `webId` bigint(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPriceOtherWebId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_price_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price_suppliers`;

CREATE TABLE `product_price_suppliers` (
  `productPriceId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productSuppId` bigint(20) unsigned NOT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `discountType` tinyint(4) DEFAULT NULL,
  `discountValue` bigint(20) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPriceId`),
  KEY `fk_pp_to_p_idx` (`productSuppId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_price_suppliers` WRITE;
/*!40000 ALTER TABLE `product_price_suppliers` DISABLE KEYS */;

INSERT INTO `product_price_suppliers` (`productPriceId`, `productSuppId`, `quantity`, `price`, `discountType`, `discountValue`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(40,144,NULL,25.00,1,NULL,'<p><br></p>',1,'2016-12-15 07:43:20','2016-12-15 07:43:20'),
	(41,145,NULL,27.00,NULL,NULL,'<p><br></p>',1,'2016-12-15 07:44:32','2016-12-27 13:44:55'),
	(42,146,NULL,20.00,1,NULL,'<p><br></p>',1,'2016-12-15 07:45:32','2016-12-23 10:40:29'),
	(43,147,NULL,20.00,NULL,NULL,'<p><br></p>',1,'2016-12-15 07:46:28','2016-12-15 07:46:28'),
	(44,148,NULL,22.00,1,NULL,'<p><br></p>',1,'2016-12-15 07:47:47','2016-12-15 07:47:47'),
	(46,150,NULL,199.00,1,NULL,'<p><br></p>',1,'2016-12-15 09:03:28','2016-12-15 09:03:28'),
	(47,151,NULL,120.00,NULL,NULL,'<p><br></p>',1,'2016-12-15 09:08:46','2016-12-15 09:08:46'),
	(48,152,NULL,710.00,1,NULL,'<p><br></p>',1,'2016-12-15 09:16:00','2016-12-15 09:16:00'),
	(49,154,NULL,1740.00,1,NULL,'<p><br></p>',1,'2016-12-27 08:57:19','2016-12-27 08:57:19'),
	(50,155,NULL,1390.00,1,NULL,'<p><br></p>',1,'2016-12-27 09:01:24','2016-12-27 09:01:24'),
	(51,158,NULL,12.00,1,NULL,'<p><br></p>',1,'2016-12-27 11:04:24','2016-12-27 11:05:52'),
	(52,159,NULL,750.00,1,NULL,'<p><br></p>',1,'2016-12-27 11:16:00','2016-12-27 11:16:00'),
	(53,161,NULL,950.00,1,NULL,'<p>test</p>',1,'2016-12-27 11:22:31','2016-12-27 11:22:31'),
	(54,162,NULL,860.00,1,NULL,'<p><br></p>',1,'2016-12-27 13:19:09','2016-12-27 13:19:09'),
	(55,163,NULL,950.00,1,NULL,'<p><br></p>',1,'2016-12-27 16:05:35','2016-12-27 16:05:35'),
	(56,164,NULL,100.00,NULL,NULL,'<p><br></p>',1,'2017-01-09 10:48:04','2017-01-09 10:48:04'),
	(57,165,NULL,100.00,NULL,NULL,'<p><br></p>',1,'2017-01-09 11:04:51','2017-01-09 11:04:51'),
	(58,166,NULL,1090.00,1,NULL,'<p><br></p>',1,'2017-01-09 16:15:22','2017-01-09 16:15:22'),
	(59,167,NULL,1450.00,1,NULL,'<p><br></p>',1,'2017-01-09 16:29:23','2017-01-09 16:29:23');

/*!40000 ALTER TABLE `product_price_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_promotion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_promotion`;

CREATE TABLE `product_promotion` (
  `productPromotionId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) unsigned DEFAULT NULL,
  `statusDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `discountType` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productPromotionId`),
  KEY `fk_ppm_to_p_idx` (`productId`),
  CONSTRAINT `fk_ppm_to_p` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_shipping_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_shipping_price`;

CREATE TABLE `product_shipping_price` (
  `productShippingPriceId` bigint(20) NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) NOT NULL,
  `shippingTypeId` bigint(20) NOT NULL,
  `date` bigint(20) NOT NULL DEFAULT '0',
  `discount` varchar(45) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `status` tinyint(5) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productShippingPriceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_shipping_price` WRITE;
/*!40000 ALTER TABLE `product_shipping_price` DISABLE KEYS */;

INSERT INTO `product_shipping_price` (`productShippingPriceId`, `productId`, `shippingTypeId`, `date`, `discount`, `type`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,1,2,'0','1',1,'2016-08-30 11:38:50','2016-08-30 11:38:50'),
	(2,1,2,5,'100','1',1,'2016-08-30 11:38:50','2016-08-30 11:38:50'),
	(3,2,1,2,'0','1',1,'2016-08-30 11:41:27','2016-08-30 11:41:27'),
	(4,2,2,5,'100','1',1,'2016-08-30 11:41:27','2016-08-30 11:41:27'),
	(5,3,1,2,'0','1',1,'2016-08-30 13:05:04','2016-08-30 13:05:04'),
	(6,3,2,5,'100','1',1,'2016-08-30 13:05:04','2016-08-30 13:05:04'),
	(7,4,1,2,'0','1',1,'2016-08-30 13:10:01','2016-08-30 13:10:01'),
	(8,4,2,5,'50','1',1,'2016-08-30 13:10:01','2016-08-30 13:10:01'),
	(9,5,1,2,'0','1',1,'2016-08-30 13:12:45','2016-08-30 13:12:45'),
	(10,5,2,5,'100','1',1,'2016-08-30 13:12:45','2016-08-30 13:12:45'),
	(11,6,1,2,'0','1',1,'2016-08-30 13:15:44','2016-08-30 13:15:44'),
	(12,6,2,5,'0','1',1,'2016-08-30 13:15:44','2016-08-30 13:15:44'),
	(13,7,1,2,'0','1',1,'2016-08-30 13:17:58','2016-08-30 13:17:58'),
	(14,7,2,5,'100','1',1,'2016-08-30 13:17:58','2016-08-30 13:17:58'),
	(15,8,1,2,'0','1',1,'2016-08-30 13:20:54','2016-08-30 13:20:54'),
	(16,8,2,5,'50','1',1,'2016-08-30 13:20:54','2016-08-30 13:20:54'),
	(17,9,1,2,'0','1',1,'2016-09-09 08:56:09','2016-09-09 08:56:09'),
	(18,9,2,5,'0','1',1,'2016-09-09 08:56:10','2016-09-09 08:56:10'),
	(19,10,1,2,'0','1',1,'2016-09-09 09:44:47','2016-09-09 09:44:47'),
	(20,10,2,5,'0','1',1,'2016-09-09 09:44:47','2016-09-09 09:44:47'),
	(21,11,1,2,'0','1',1,'2016-09-09 10:02:50','2016-09-09 10:02:50'),
	(22,11,2,5,'100','1',1,'2016-09-09 10:02:50','2016-09-09 10:02:50'),
	(23,12,1,2,'0','1',1,'2016-09-13 10:13:15','2016-09-13 10:13:15'),
	(24,12,2,5,'0','1',1,'2016-09-13 10:13:15','2016-09-13 10:13:15'),
	(25,14,1,2,'0','1',1,'2016-09-13 10:18:10','2016-09-13 10:18:10'),
	(26,14,2,5,'0','1',1,'2016-09-13 10:18:10','2016-09-13 10:18:10'),
	(27,15,1,2,'0','1',1,'2016-09-13 10:22:22','2016-09-13 10:22:22'),
	(28,15,2,5,'0','1',1,'2016-09-13 10:22:22','2016-09-13 10:22:22'),
	(29,16,1,2,'0','1',1,'2016-09-13 11:42:56','2016-09-13 11:42:56'),
	(30,16,2,5,'100','1',1,'2016-09-13 11:42:56','2016-09-13 11:42:56'),
	(31,18,1,2,'0','1',1,'2016-09-13 11:45:58','2016-09-13 11:45:58'),
	(32,18,2,5,'0','1',1,'2016-09-13 11:45:58','2016-09-13 11:45:58'),
	(33,17,1,2,'0','1',1,'2016-09-13 11:46:17','2016-09-13 11:46:17'),
	(34,17,2,5,'0','1',1,'2016-09-13 11:46:17','2016-09-13 11:46:17'),
	(35,19,1,2,'0','1',1,'2016-09-13 11:49:35','2016-09-13 11:49:35'),
	(36,19,2,5,'50','1',1,'2016-09-13 11:49:35','2016-09-13 11:49:35'),
	(37,20,1,2,'0','1',1,'2016-09-14 09:00:33','2016-09-14 09:00:33'),
	(38,20,2,5,'0','1',1,'2016-09-14 09:00:33','2016-09-14 09:00:33'),
	(39,22,1,2,'0','1',1,'2016-09-14 09:03:02','2016-09-14 09:03:02'),
	(40,22,2,5,'50','1',1,'2016-09-14 09:03:02','2016-09-14 09:03:02'),
	(43,24,1,2,'0','1',1,'2016-09-14 09:09:35','2016-09-14 09:09:35'),
	(44,24,2,5,'0','1',1,'2016-09-14 09:09:35','2016-09-14 09:09:35'),
	(45,25,1,2,'0','1',1,'2016-09-14 09:46:32','2016-09-14 09:46:32'),
	(46,25,2,5,'0','1',1,'2016-09-14 09:46:32','2016-09-14 09:46:32'),
	(47,26,1,2,'0','1',1,'2016-09-16 10:27:34','2016-09-16 10:27:34'),
	(48,26,2,5,'0','1',1,'2016-09-16 10:27:34','2016-09-16 10:27:34'),
	(49,27,1,2,'0','1',1,'2016-09-16 10:30:30','2016-09-16 10:30:30'),
	(50,27,2,5,'0','1',1,'2016-09-16 10:30:30','2016-09-16 10:30:30'),
	(51,28,1,2,'0','1',1,'2016-09-19 10:16:28','2016-09-19 10:16:28'),
	(52,28,2,5,'0','1',1,'2016-09-19 10:16:28','2016-09-19 10:16:28'),
	(53,29,1,2,'0','1',1,'2016-09-19 10:20:22','2016-09-19 10:20:22'),
	(54,29,2,5,'0','1',1,'2016-09-19 10:20:22','2016-09-19 10:20:22'),
	(55,30,1,2,'0','1',1,'2016-09-19 10:22:40','2016-09-19 10:22:40'),
	(56,30,2,5,'100','1',1,'2016-09-19 10:22:40','2016-09-19 10:22:40'),
	(57,31,1,2,'0','1',1,'2016-09-19 10:24:45','2016-09-19 10:24:45'),
	(58,31,2,5,'0','1',1,'2016-09-19 10:24:45','2016-09-19 10:24:45'),
	(59,32,1,2,'0','1',1,'2016-09-19 10:27:30','2016-09-19 10:27:30'),
	(60,32,2,5,'100','1',1,'2016-09-19 10:27:30','2016-09-19 10:27:30'),
	(61,33,1,2,'0','1',1,'2016-09-19 10:30:55','2016-09-19 10:30:55'),
	(62,33,2,5,'0','1',1,'2016-09-19 10:30:55','2016-09-19 10:30:55'),
	(63,34,1,2,'0','1',1,'2016-09-20 09:38:08','2016-09-20 09:38:08'),
	(64,34,3,10,'100','1',1,'2016-09-20 09:38:08','2016-09-20 09:38:08'),
	(65,35,1,2,'0','1',1,'2016-09-22 15:35:33','2016-09-22 15:35:33'),
	(66,35,2,5,'100','1',1,'2016-09-22 15:35:33','2016-09-22 15:35:33'),
	(67,36,1,2,'0','1',1,'2016-09-22 15:43:06','2016-09-22 15:43:06'),
	(68,36,2,5,'100','1',1,'2016-09-22 15:43:06','2016-09-22 15:43:06'),
	(69,37,1,2,'0','1',1,'2016-09-22 15:49:05','2016-09-22 15:49:05'),
	(70,37,2,5,'100','1',1,'2016-09-22 15:49:05','2016-09-22 15:49:05'),
	(71,38,1,2,'0','1',1,'2016-09-27 08:49:40','2016-09-27 08:49:40'),
	(72,38,2,5,'0','1',1,'2016-09-27 08:49:40','2016-09-27 08:49:40'),
	(73,39,1,2,'0','1',1,'2016-09-29 09:56:07','2016-09-29 09:56:07'),
	(74,39,2,5,'50','1',1,'2016-09-29 09:56:07','2016-09-29 09:56:07'),
	(75,40,1,2,'0','1',1,'2016-09-29 14:58:03','2016-09-29 14:58:03'),
	(76,40,2,5,'50','1',1,'2016-09-29 14:58:03','2016-09-29 14:58:03'),
	(77,41,1,2,'0','1',1,'2016-09-29 15:03:37','2016-09-29 15:03:37'),
	(78,41,2,5,'50','1',1,'2016-09-29 15:03:37','2016-09-29 15:03:37'),
	(79,42,1,2,'0','1',1,'2016-09-29 15:07:25','2016-09-29 15:07:25'),
	(80,42,2,5,'50','1',1,'2016-09-29 15:07:26','2016-09-29 15:07:26'),
	(81,43,2,5,'0','1',1,'2016-09-29 15:19:16','2016-09-29 15:19:16'),
	(82,43,3,10,'50','1',1,'2016-09-29 15:19:16','2016-09-29 15:19:16'),
	(83,44,2,5,'0','1',1,'2016-09-29 15:22:34','2016-09-29 15:22:34'),
	(84,44,3,10,'100','1',1,'2016-09-29 15:22:34','2016-09-29 15:22:34'),
	(85,45,1,2,'0','1',1,'2016-09-29 15:28:34','2016-09-29 15:28:34'),
	(86,45,2,5,'50','1',1,'2016-09-29 15:28:34','2016-09-29 15:28:34'),
	(87,46,1,2,'0','1',1,'2016-09-29 15:31:32','2016-09-29 15:31:32'),
	(88,46,2,5,'50','1',1,'2016-09-29 15:31:32','2016-09-29 15:31:32'),
	(89,47,1,2,'0','1',1,'2016-09-29 15:35:59','2016-09-29 15:35:59'),
	(90,47,2,5,'100','1',1,'2016-09-29 15:35:59','2016-09-29 15:35:59'),
	(91,48,1,2,'0','1',1,'2016-09-29 15:41:32','2016-09-29 15:41:32'),
	(92,48,2,5,'100','1',1,'2016-09-29 15:41:33','2016-09-29 15:41:33'),
	(93,49,1,2,'0','1',1,'2016-09-29 15:49:29','2016-09-29 15:49:29'),
	(94,49,2,5,'100','1',1,'2016-09-29 15:49:29','2016-09-29 15:49:29'),
	(95,50,1,2,'0','1',1,'2016-09-29 15:54:23','2016-09-29 15:54:23'),
	(96,50,2,5,'50','1',1,'2016-09-29 15:54:23','2016-09-29 15:54:23'),
	(97,51,2,5,'0','1',1,'2016-09-29 16:00:41','2016-09-29 16:00:41'),
	(98,51,3,10,'100','1',1,'2016-09-29 16:00:41','2016-09-29 16:00:41'),
	(99,52,2,5,'0','1',1,'2016-09-29 16:05:03','2016-09-29 16:05:03'),
	(100,52,3,10,'100','1',1,'2016-09-29 16:05:03','2016-09-29 16:05:03'),
	(101,53,2,5,'0','1',1,'2016-10-06 10:53:13','2016-10-06 10:53:13'),
	(102,53,3,10,'50','1',1,'2016-10-06 10:53:13','2016-10-06 10:53:13'),
	(103,54,2,5,'0','1',1,'2016-10-06 10:55:44','2016-10-06 10:55:44'),
	(104,54,3,10,'50','1',1,'2016-10-06 10:55:44','2016-10-06 10:55:44'),
	(105,55,1,2,'0','1',1,'2016-11-21 09:24:58','2016-11-21 09:24:58'),
	(106,55,2,5,'0','1',1,'2016-11-21 09:24:58','2016-11-21 09:24:58'),
	(107,78,1,2,'1','2',1,NULL,'2016-12-08 15:54:42'),
	(109,78,2,5,'0.5','2',1,NULL,'2016-12-13 16:21:35'),
	(110,84,1,2,'0','1',1,'2016-12-23 13:44:50','2016-12-23 13:44:50'),
	(111,84,2,5,'10','1',1,'2016-12-23 13:44:50','2016-12-23 13:44:50'),
	(112,83,1,2,'0','1',1,NULL,'2016-12-27 09:14:29'),
	(115,86,1,2,'0','2',1,NULL,'2016-12-28 13:47:54'),
	(116,93,1,2,'0','1',1,'2017-01-06 13:48:56','2017-01-06 13:48:56'),
	(117,93,2,5,'0','1',1,'2017-01-06 13:48:56','2017-01-06 13:48:56'),
	(118,89,1,2,'','1',1,NULL,'2017-01-09 14:27:07'),
	(119,92,1,2,'','1',1,NULL,'2017-01-09 14:32:16'),
	(120,94,1,2,'','1',1,NULL,'2017-01-09 16:31:37'),
	(121,85,1,2,'0','1',1,'2017-01-10 08:33:10','2017-01-10 08:33:10'),
	(122,85,2,5,'0','1',1,'2017-01-10 08:33:10','2017-01-10 08:33:10'),
	(123,87,1,2,'0','1',1,'2017-01-10 08:49:03','2017-01-10 08:49:03'),
	(124,87,2,5,'0','1',1,'2017-01-10 08:49:03','2017-01-10 08:49:03'),
	(125,91,1,2,'0','1',1,'2017-01-10 08:57:18','2017-01-10 08:57:18'),
	(126,91,2,5,'0','1',1,'2017-01-10 08:57:18','2017-01-10 08:57:18'),
	(127,95,1,2,'0','1',1,'2017-01-11 09:28:39','2017-01-11 09:28:39'),
	(128,95,2,5,'0','1',1,'2017-01-11 09:28:39','2017-01-11 09:28:39'),
	(129,96,1,2,'0','1',1,'2017-01-11 09:31:44','2017-01-11 09:31:44'),
	(130,96,2,5,'0','1',1,'2017-01-11 09:31:44','2017-01-11 09:31:44');

/*!40000 ALTER TABLE `product_shipping_price` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_shipping_price_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_shipping_price_suppliers`;

CREATE TABLE `product_shipping_price_suppliers` (
  `productShippingPriceId` bigint(20) NOT NULL AUTO_INCREMENT,
  `productSuppId` bigint(20) NOT NULL,
  `shippingTypeId` bigint(20) NOT NULL,
  `date` bigint(20) NOT NULL DEFAULT '0',
  `discount` varchar(45) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `status` tinyint(5) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productShippingPriceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_shipping_price_suppliers` WRITE;
/*!40000 ALTER TABLE `product_shipping_price_suppliers` DISABLE KEYS */;

INSERT INTO `product_shipping_price_suppliers` (`productShippingPriceId`, `productSuppId`, `shippingTypeId`, `date`, `discount`, `type`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(17,111,1,2,'100','1',1,'2016-12-01 13:39:57','2016-12-01 13:39:57'),
	(18,112,1,2,'10','1',1,'2016-12-01 13:45:26','2016-12-01 13:45:26'),
	(19,115,1,2,'440','1',1,'2016-12-01 14:05:58','2016-12-01 14:05:58');

/*!40000 ALTER TABLE `product_shipping_price_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_suppliers`;

CREATE TABLE `product_suppliers` (
  `productSuppId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `productGroupId` bigint(20) unsigned DEFAULT NULL,
  `brandId` bigint(20) unsigned DEFAULT NULL,
  `categoryId` bigint(20) unsigned DEFAULT NULL,
  `isbn` text,
  `code` varchar(100) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `optionName` varchar(200) DEFAULT NULL,
  `shortDescription` text,
  `description` text,
  `specification` text,
  `width` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `depth` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `unit` bigint(20) unsigned DEFAULT NULL,
  `smallUnit` bigint(20) unsigned DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` bigint(20) NOT NULL COMMENT 'จำนวนสินค้า',
  `result` bigint(20) NOT NULL,
  `approve` varchar(10) DEFAULT NULL COMMENT 'old : เพิ่มจาก Product system\nnew : เพิ่มใหม่ รออนูมัติ\napprove : อนูมัติ\n\nใช้กับกรณีอันใหม่',
  `productId` bigint(20) DEFAULT NULL,
  `approveCreateBy` bigint(20) unsigned DEFAULT NULL,
  `approvecreateDateTime` datetime NOT NULL,
  PRIMARY KEY (`productSuppId`),
  KEY `fk_p_to_pg_idx` (`productGroupId`),
  KEY `fk_p_to_c_idx` (`categoryId`),
  KEY `fk_p_to_u_idx` (`userId`),
  KEY `fk_p_to_b_idx` (`brandId`),
  KEY `fk_p_to_u_idx1` (`unit`),
  KEY `fk_p_to_su_idx` (`smallUnit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_suppliers` WRITE;
/*!40000 ALTER TABLE `product_suppliers` DISABLE KEYS */;

INSERT INTO `product_suppliers` (`productSuppId`, `userId`, `productGroupId`, `brandId`, `categoryId`, `isbn`, `code`, `title`, `optionName`, `shortDescription`, `description`, `specification`, `width`, `height`, `depth`, `weight`, `unit`, `smallUnit`, `tags`, `status`, `createDateTime`, `updateDateTime`, `quantity`, `result`, `approve`, `productId`, `approveCreateBy`, `approvecreateDateTime`)
VALUES
	(144,11,NULL,29,45,'CZ1','xxxx','ป๊อกกี้','ป๊อกกี้','<p>ป๊อกกี้<br></p>','<p>ป๊อกกี้<br></p>','<p>ป๊อกกี้<br></p>',NULL,NULL,NULL,NULL,3,NULL,'',1,'2016-12-15 07:43:08','2016-12-15 07:43:08',50,0,'approve',83,5,'2016-12-27 10:49:43'),
	(145,9,NULL,29,45,'CZ1','xxxx','ป๊อกกี้','ป๊อกกี้','<p><br></p>','<p>ป๊อกกี้<br></p>','<p>ป๊อกกี้<br></p>',NULL,NULL,NULL,NULL,3,NULL,'',1,'2016-12-15 07:44:16','2016-12-15 07:44:16',60,0,'approve',83,5,'2016-12-27 10:49:44'),
	(146,9,NULL,29,45,'CZ2','1111','ถั่วรสวาซาบิ','ถั่วรสวาซาบิ','<p>ถั่วรสวาซาบิ<br></p>','<p>ถั่วรสวาซาบิ<br></p>','<p>ถั่วรสวาซาบิ<br></p>',NULL,NULL,NULL,NULL,3,2,'',1,'2016-12-23 10:23:15','2016-12-15 07:45:25',100,0,'approve',84,1,'2016-12-23 10:30:24'),
	(147,10,NULL,29,45,'CZ1','xxxx','ป๊อกกี้','ป๊อกกี้','<p><br></p>','<p>ป๊อกกี้<br></p>','<p>ป๊อกกี้<br></p>',NULL,NULL,NULL,NULL,3,NULL,'',1,'2016-12-15 07:46:16','2016-12-15 07:46:16',60,0,'approve',83,5,'2016-12-27 10:49:45'),
	(148,12,NULL,29,45,'CZ1','xxxx','ป๊อกกี้','ป๊อกกี้','<p><br></p>','<p>ป๊อกกี้<br></p>','<p>ป๊อกกี้<br></p>',NULL,NULL,NULL,NULL,3,NULL,'',1,'2016-12-15 07:47:28','2016-12-15 07:47:28',50,0,'approve',83,5,'2016-12-27 10:49:46'),
	(150,9,NULL,29,45,'','',' Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)  ',' Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)  ','<span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Innotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ลำโพง ที่สะดวกต่อการพกพา สามารถเชื่อมต่อผ่านระบบ Bluetooth ไร้สาย และยังสามารถใช้ในระบบ Radio และ SD player อีกด้วย ลำโพง Bluetooth Radio with SD player มาพร้อมกับคุณภาพเสียงที่น่าประทับใจ ข้อมูลจำเพาะ - Bluetooth V2.1 - ระยะทาง 10 เมตร - ความจุแบตเตอรี่ 520 mA - ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) - เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br>','<span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">nnotech Mini Bluetooth Speaker ลำโพงบลูทูธ รุ่น N10U (Orange)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ลำโพง ที่สะดวกต่อการพกพา สามารถเชื่อมต่อผ่านระบบ Bluetooth ไร้สาย และยังสามารถใช้ในระบบ Radio และ SD player อีกด้วย ลำโพง Bluetooth Radio with SD player มาพร้อมกับคุณภาพเสียงที่น่าประทับใจ ข้อมูลจำเพาะ - Bluetooth V2.1 - ระยะทาง 10 เมตร - ความจุแบตเตอรี่ 520 mA - ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) - เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เชื่อมต่อผ่านโทรศัพท์ที่มี Bluetooth </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ฟังวิทยุ FM.ได้ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เสียบ USB.ฟังเพลงได้ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- รองรับ Micro SD Card </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ฟังเพลงจากมือถือ โดยเชื่อมผ่านบลูทูธ และสนทนาโทรศัพท์ได้</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">ข้อมูลจำเพาะ </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Bluetooth V2.1 </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ระยะทาง 10 เมตร </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความจุแบตเตอรี่ 520 mA </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ระบบการชาร์จไฟ 5.0 V (ระยะเวลาชาร์จ 2 ชั่วโมง) </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- เวลาการใช้งานอย่างต่อเนื่อง: 5 ชั่วโมง</span><br>','<ul><li>เชื่อมต่อแบบไร้สายได้ทุกอุปกรณ์<br></li><li>เสียง BASS แน่น พร้อมรับวิทยุได้ในตัว<br></li><li>รองรับการใช้งาน Handfree จากโทรศัพท์<br></li><li>รองรับ Micro SD Card, TF Card & Flash Drive<br></li><li>พกพาสะดวก ชาร์จด้วยสาย USB<br></li></ul>',5.20,11.00,3.30,0.26,3,NULL,'',1,'2016-12-27 10:00:51','2016-12-15 09:02:55',10,0,'new',85,NULL,'0000-00-00 00:00:00'),
	(151,10,NULL,29,45,'CZ212345','1111222333','ถั่วพิสตาชิโอ้ รสวาซาบิ','ถั่วพิสตาชิโอ้ รสวาซาบิ','<p>ถั่วพิสตาชิโอ้ รสวาซาบิ<br></p>','<p>ถั่วพิสตาชิโอ้ รสวาซาบิ<br></p>','<p>ถั่วพิสตาชิโอ้ รสวาซาบิ<br></p>',NULL,NULL,NULL,NULL,3,NULL,'',1,'2016-12-27 09:44:17','2016-12-15 09:08:40',100,0,'new',84,NULL,'0000-00-00 00:00:00'),
	(152,10,NULL,29,45,'abdfef','hhhh','Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์ ','Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์ ','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">รสนิยมและไลฟ์สไตล์นั้นเป็นสิ่งแรกที่จะบ่งบอกความเป็นตัวตนของคุณได้เป็นอย่างดี ไม่ว่าจะเป็นการแต่งตัว ทรงผม หรือ accessories ต่างๆ รวมไปถึง สไตล์การฟังเพลง การเลือกใช้หูฟัง ที่มีดีไซน์เข้ากับตัวคุณเอง และ </span><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ก็เป็นหูฟังที่ดี เหมาะสำหรับคนรักดนตรีที่ชื่นชอบการจังหวะที่แข็งแกร่งซึ่งถือว่าเป็นการ ตอบโจทย์คุณได้เป็นอย่างดีเลยทีเดียว </span><br></p>','<p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><font size=\"5\" color=\"Orange\" style=\"margin: 0px; padding: 0px;\">คุณสมบัติเด่น</font></span><br></p><ul class=\"ui-listBulleted\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 13px; padding: 0px; list-style-position: initial; list-style-image: initial; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">น้ำหนักเบา สามารถพับได้ ทำให้การฟังเพลงของคุณง่ายขึ้นในทุกๆ ที่</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">Driver Unit ขนาด 30 มม. เพื่อเสียงที่สมดุลและทรงพลัง</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ทรงพลังด้วยช่วงความถี่ 10–24,000Hz</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">เอียร์คัพบุนวมเพื่อการฟังเพลงที่สบาย</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">มีสีสันให้คุณเลือกมากมายเพื่อไลฟ์สไตล์ของตัวคุณ</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\"><span style=\"line-height: 17.1428px;\">หูฟังประเภท On-ear Headphone จาก SONY</span><br></li></ul><p><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">รสนิยมและไลฟ์สไตล์นั้นเป็นสิ่งแรกที่จะบ่งบอกความเป็นตัวตนของคุณได้เป็นอย่างดี ไม่ว่าจะเป็นการแต่งตัว ทรงผม หรือ accessories ต่างๆ รวมไปถึง สไตล์การฟังเพลง การเลือกใช้หูฟัง ที่มีดีไซน์เข้ากับตัวคุณเอง และ </span><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ก็เป็นหูฟังที่ดี เหมาะสำหรับคนรักดนตรีที่ชื่นชอบการจังหวะที่แข็งแกร่งซึ่งถือว่าเป็นการ ตอบโจทย์คุณได้เป็นอย่างดีเลยทีเดียว </span><br></p><p><span style=\"color: black; font-size: large; font-family: Helvetica, Arial, sans-serif; font-weight: 700; line-height: 1.42857;\">ขนาดลำโพง 30 มม.</span><br></p><p><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> เป็นหูฟังคาดศรีษะแบบ Sound Monitoring เเละมีขนาดลำโพง 30 มม. ทำให้สามารถเข้าถึงอรรถรสได้ดีกว่าที่เคย เเละ เพื่อให้สะดวกในการใช้งานมากยิ่งขึ้งจึงมีความยาวสาย 1.2 เมตร เเละสามารถใช้ไมค์เป็น small talk ได้อีกด้วย </span><br></p><p><span style=\"color: black; font-size: large; font-family: Helvetica, Arial, sans-serif; font-weight: 700; line-height: 1.42857;\">เอียร์คัพบุนวมเพื่อการฟังเพลงที่สบาย</span><br></p><p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">เพิ่มความสบายไปอีกขั้นยามที่คุณฟังเพลงกับ </span><span style=\"margin: 0px; padding: 0px; font-weight: 700; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Sony หูฟังแบบครอบหู รุ่น MDRZX310APR (สีแดง) + ไมค์</span><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"> ที่มาพร้อมกับเอียร์คัพบุนวมช่วยกระชับตัวหูฟังไปกับสรีระของศีรษะคุณ ได้อย่างพอดี นอกจากนี้ให้หูของนิ่มสบาย ไม่เจ็บอีกด้วย </span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"></p><p><br></p>','<p><span style=\"color: black; font-size: large; font-family: Helvetica, Arial, sans-serif; font-weight: 700;\">Ootions</span><br></p><p><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Driver Unit : 30mm Dynamic</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Sensitivity : 98 dB/mW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Impedance : 24 Ω</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Frequency Response : 10 - 24,000Hz</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Cord : 1.2m cord (both sides) with In-line Remote and Mic</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Plug : Four-conductor gold-plated L-shaped stereo mini plug</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- Weight (Without Cord) : 125g</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"></p>',19.80,15.00,5.20,0.13,3,NULL,'',1,'2017-01-04 09:40:11','2016-12-15 09:15:41',15,0,'approve',86,5,'2017-01-04 09:40:35'),
	(153,12,NULL,2,5,'CZ1610000002','mac2222',' M∙A∙C  Cremesheen Pearl Lipstick','','<p><br></p>','<p>ลิปสติกที่เปล่งประกายความความหรูหราในสไตล์สุดคลาสสิคแบบ M∙A∙C Cremesheen Pearl เจิดจรัสแวววาวกว่าที่เคยด้วยประกายมุกชิมเมอร์ของ Cremesheen Lipstick ให้ฟินิชที่เคลือบประกายเรืองรองด้วย pearlized pigments พิกเมินท์ประกายมุก มีให้เลือกถึงหลากเฉดสีใหม่ที่ครีเอทมาเพื่อสาวเอเชียโดยเฉพาะ อีกหนึ่งลิปสติกสีสดใสใหม่ที่ควรมีพกคู่กันไว้ในประเป๋า</p>','',1.00,1.00,1.00,1.00,4,4,'',1,'2016-12-20 10:33:24','2016-12-20 10:33:24',10,0,'old',2,NULL,'0000-00-00 00:00:00'),
	(154,11,NULL,22,32,'8i8i8i8i','8i8i8i8i8i8i8',' Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส',' รุ่น MTP-E301D-7B1VDF ','<div class=\"prod_header\" style=\"margin: 0px; padding: 0px; display: table; width: 1170px; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><div class=\"prod_header_main\" style=\"margin: 0px; padding: 0px 15px 0px 0px; display: table-cell; vertical-align: top;\"><div class=\"prod_header_title\" style=\"margin: 0px; padding: 0px;\"><h1 id=\"prod_title\" style=\"margin-top: 0px; margin-bottom: 5px; padding: 0px; font-size: 24px; line-height: 26px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF </h1></div></div></div>','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- วัสดุตัวเรือน / กรอบ: สเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ล็อคพับสามทบและกดเพียงครั้งเดียวเพื่อล็อค</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- สายสเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กระจกมิเนอรัล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กันน้ำลึก 50 เมตร</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- บอกเวลาปกติแบบทั่วไป</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">อะนาล็อก: 3 เข็ม (ชั่วโมง นาที วินาที)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">3 หน้าปัด (วันที่ วันในรอบสัปดาห์ เวลา 24 ชั่วโมง)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความแม่นยำ: ?20 วินาทีต่อเดือน</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- อายุการใช้งานแบตเตอรี่ประมาณ: 3 ปีกับถ่านกระดุม SR927SW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ขนาดตัวเรือน : 50.0?38.5?10.6mm</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- น้ำหนักรวม : 132g</span><br></p>','<p><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือผู้ชาย สีเงิน สายสแตนเลส รุ่น MTP-E301D-7B1VDF</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">คุณสมบัติ</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- วัสดุตัวเรือน / กรอบ: สเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ล็อคพับสามทบและกดเพียงครั้งเดียวเพื่อล็อค</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- สายสเตนเลสสตีล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กระจกมิเนอรัล</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- กันน้ำลึก 50 เมตร</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- บอกเวลาปกติแบบทั่วไป</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">อะนาล็อก: 3 เข็ม (ชั่วโมง นาที วินาที)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">3 หน้าปัด (วันที่ วันในรอบสัปดาห์ เวลา 24 ชั่วโมง)</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ความแม่นยำ: ?20 วินาทีต่อเดือน</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- อายุการใช้งานแบตเตอรี่ประมาณ: 3 ปีกับถ่านกระดุม SR927SW</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- ขนาดตัวเรือน : 50.0?38.5?10.6mm</span><br style=\"margin: 0px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><span style=\"color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">- น้ำหนักรวม : 132g</span><br></p>',NULL,NULL,NULL,NULL,2,2,'',1,'2016-12-27 08:57:08','2016-12-27 08:57:08',10,0,'approve',87,1,'2016-12-27 09:02:59'),
	(155,12,NULL,22,32,'8i8i8i8i','8i8i8i8i8i8i8',' Casio Standard นาฬิกาข้อมือสุภาพบุรุษ สายสแตนเลส ','รุ่น MTP-V301D-1AUDF - BLACK  ','<p> Casio Standard นาฬิกาข้อมือสุภาพบุรุษ สายสแตนเลส รุ่น MTP-V301D-1AUDF - BLACK  </p>','<p style=\"margin-bottom: 10px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือสุภาพบุรุษ สายสแตนเลส รุ่น MTP-V301D-1AUDF - BLACK</p><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ตัวเรือน / กรอบ: ชุบไอออน</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">เข็มสามเท่า</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">วงสแตนเลส</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กระจกมิเนอรัล</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กันน้ำ</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">บอกเวลาแบบทั่วไป</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">อะนาล็อก: 3 เข็ม (ชั่วโมงนาทีวินาที) 3 หน้าปัด (วันตลอด 24 ชั่วโมงวันที่)</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ความแม่นยำ? 20 วินาทีต่อเดือน</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ประมาณ. แบตเตอรี่: 3 ปีกับ SR920SW</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กรณีขนาดของเรือน: 44 ? 39.4 ? 8.4 มม.(ยาวxกว้างxสูง)</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">น้ำหนักรวม: 90 กรัม</li></ul>','<p style=\"margin-bottom: 10px; padding: 0px; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\">Casio Standard นาฬิกาข้อมือสุภาพบุรุษ สายสแตนเลส รุ่น MTP-V301D-1AUDF - BLACK</p><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; color: rgb(64, 64, 64); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ตัวเรือน / กรอบ: ชุบไอออน</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">เข็มสามเท่า</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">วงสแตนเลส</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กระจกมิเนอรัล</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กันน้ำ</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">บอกเวลาแบบทั่วไป</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">อะนาล็อก: 3 เข็ม (ชั่วโมงนาทีวินาที) 3 หน้าปัด (วันตลอด 24 ชั่วโมงวันที่)</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ความแม่นยำ? 20 วินาทีต่อเดือน</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">ประมาณ. แบตเตอรี่: 3 ปีกับ SR920SW</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">กรณีขนาดของเรือน: 44 ? 39.4 ? 8.4 มม.(ยาวxกว้างxสูง)</li><li style=\"margin: 0px 0px 0px 14px; padding: 0px; list-style: disc;\">น้ำหนักรวม: 90 กรัม</li></ul>',NULL,NULL,NULL,NULL,2,2,'',1,'2016-12-27 09:01:14','2016-12-27 09:01:14',10,0,'old',87,NULL,'0000-00-00 00:00:00'),
	(156,10,NULL,26,45,'CZ1610000029','9999','SENNHEISER WHI MM30G','','<p><br></p>','<ul><li>ระดับคุณภาพทั้งตัวเครื่องและคุณภาพเสียง</li><li>ตัวหูฟังสวมใส่สบาย</li><li>พกพาง่าย</li></ul>','',1.00,1.00,1.00,1.00,4,4,'',1,'2016-12-27 09:46:26','2016-12-27 09:46:26',2,0,'old',50,NULL,'0000-00-00 00:00:00'),
	(157,10,NULL,29,45,'aaaa','aaa','ปาร์ตี้','ปาร์ตี้','<p>ปาร์ตี้<br></p>','<p>ปาร์ตี้<br></p>','<p>ปาร์ตี้<br></p>',1.00,1.00,1.00,1.00,4,4,'',1,'2016-12-27 10:54:16','2016-12-27 10:54:16',10,0,'new',88,NULL,'0000-00-00 00:00:00'),
	(158,9,NULL,29,45,'aaaa','aaa','ปาร์ตี้','ปาร์ตี้','<p><br></p>','<p>ปาร์ตี้<br></p>','<p>ปาร์ตี้<br></p>',1.00,1.00,1.00,1.00,4,4,'',1,'2016-12-27 10:55:11','2016-12-27 10:55:11',20,0,'approve',88,5,'2016-12-27 10:58:59'),
	(159,9,NULL,31,34,'t5t5t5t5t','5t5t5t5t5t','ผ้าพันคอ','ผ้าพันคอ','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em; text-align: center;\"><div style=\"text-align: left; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"text-align: left; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div></div>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>',NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2016-12-27 11:06:33','2016-12-27 11:06:33',15,0,'approve',89,1,'2016-12-27 16:15:00'),
	(161,9,NULL,31,34,'t5t5t5t5t','5t5t5t5t5t','ผ้าพันคอ ผ้าฝ้าย 100 %','ผ้าพันคอ ผ้าฝ้าย 100 %','<p><br></p>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>',NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2016-12-27 11:16:40','2016-12-27 11:16:40',15,0,'approve',89,1,'2016-12-27 16:14:59'),
	(162,9,NULL,29,33,'k9k9k9k9','k9k9k9k9',' New Hot Men\'s Fashion Slim Fit Stylish Casual Dress corduroy Suit Blazer Coats Jackets (Khaki)  ',' New Hot Men\'s Fashion Slim Fit Stylish Casual Dress corduroy Suit Blazer Coats Jackets (Khaki)  ','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>','<ul class=\"prd-attributesList ui-listBulleted js-short-description\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style-position: initial; list-style-image: initial; column-count: 2; color: rgb(58, 67, 70); font-family: Helvetica, Arial, sans-serif; font-size: 12px;\"><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">color :Khaki</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">size: M  L  XL  2XL  3XL</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">sleeved:long sleeve</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">style: Suit Jackets</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">After the slits</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">material：corduroy</span></li><li class=\"\" style=\"margin: 0px; padding: 0px; list-style: none; line-height: 16px; font-size: 13px; break-inside: initial; overflow: hidden;\"><span style=\"margin: 0px 0px 0px 10px; padding: 0px; display: block; color: rgb(84, 83, 81);\">tide</span></li></ul>',NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2016-12-27 13:44:31','2016-12-27 13:19:01',50,0,'new',91,NULL,'0000-00-00 00:00:00'),
	(163,11,NULL,31,34,'deedfwdewde','wdwedewded','ผ้าพันคอ ผ้าฝ้ายย้อมคราม 100%','ฟ้าครามหลากเฉดสี คือความพิเศษเหนือจินตนาการ','<p>สืบสานหัตถศิลป์ ถิ่นผ้าย้อมคราม @ สกลนคร มรดกแห่งภูมิปัญญา สู่ผืนผ้าครามงามเลอค่า  ฟ้าครามหลากเฉดสี คือความพิเศษเหนือจินตนาการ<br></p>','<p>เขาเล่าว่า... “ผ้าผิวสวย”</p><p><br></p><p>“ผ้า” สามารถช่วยบำรุงผิวของเราให้สวยได้</p><p><br></p><p>          จากภูมิปัญญาชาวบ้าน ที่นำพืชโบราณ “ต้นคราม” ที่เป็นที่เลื่องลือในสรรพคุณด้านสุขภาพมาย้อมสีผ้าแบบไร้สารเคมีที่ทำให้เมื่อใส่จะรู้สึกเย็นสบาย ไม่ร้อน ซึ่งถูกวิจัยมาแล้วโดยประเทศญี่ปุ่นและอเมริกา ว่าสามารถป้องกันรังสียูวีได้ แพทย์พื้นบ้านโบราณยังเชื่อว่ากลิ่นหอมของผ้าทำให้รู้สึกผ่อนคลาย “ท่องเที่ยววิถีไทย เก๋ไก๋ไม่เหมือนใคร” สัมผัสกรรมวิธีผลิตผ้าย้อมคราม และเลือกซื้อผลิตภัณฑ์ผ้าย้อมครามแปรรูปหลากหลาย อาทิ ผ้าซิ่น ผ้าคลุมไหล่ ผ้าพันคอ  กระเป๋าถือ กระเป๋าเป้สะพายหลัง หมวก เสื้อยืดย้อมคราม ตุ๊กตาผ้าย้อมคราม  ได้ที่ \"สกลนคร\"</p>','<p>เสน่ห์ของผ้าย้อมคราม</p><p><br></p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>มีเฉดสีฟ้าถึงสีน้ำเงินเข้ม เป็นเอกลักษณ์เฉพาะของคราม เป็นการย้อมสีที่ได้จากธรรมชาติ 100 %  </p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>มีกลิ่นหอมอ่อนๆ ซึ่งเป็นกลิ่นจากคราม</p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>เนื้อผ้านุ่ม สวมใส่สบาย อากาศหนาวใส่แล้วอุ่น อากาศร้อนใส่แล้วเย็น</p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>สามารถกันยุงได้ เพราะผ้าครามมีกลิ่นที่ยุงไม่ชอบ</p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>ป้องกัน UV สามารถป้องกันรังสีอัลตราไวโอเลต หรือ รังสียูวีได้</p><p>Ø<span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>ชาวไทยกะเลิงเชื่อว่าครามเป็นต้นไม้ที่มีชีวิตและจิตวิญญาณของธรรมชาติเทียบเท่าเทพยดา เมื่อนำครามมาย้อมผ้า จะทำให้ผู้สวมใส่สุขกายสบายใจ</p><div><br></div>',NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2016-12-27 16:05:27','2016-12-27 16:05:27',10,0,'approve',92,1,'2016-12-27 16:14:58'),
	(164,9,NULL,2,5,'CZ1610000002','mac2222','M∙A∙C  Cremesheen Pearl Lipstick','','<p><br></p>','<p>ลิปสติกที่เปล่งประกายความความหรูหราในสไตล์สุดคลาสสิคแบบ M∙A∙C Cremesheen Pearl เจิดจรัสแวววาวกว่าที่เคยด้วยประกายมุกชิมเมอร์ของ Cremesheen Lipstick ให้ฟินิชที่เคลือบประกายเรืองรองด้วย pearlized pigments พิกเมินท์ประกายมุก มีให้เลือกถึงหลากเฉดสีใหม่ที่ครีเอทมาเพื่อสาวเอเชียโดยเฉพาะ อีกหนึ่งลิปสติกสีสดใสใหม่ที่ควรมีพกคู่กันไว้ในประเป๋า</p>','',1.00,1.00,1.00,1.00,4,4,'',1,'2017-01-09 10:47:52','2017-01-09 10:47:52',10,0,'old',2,NULL,'0000-00-00 00:00:00'),
	(165,9,NULL,2,5,'CZ1610000002','mac2222','M∙A∙C  Cremesheen Pearl Lipstick','','<p><br></p>','<p>ลิปสติกที่เปล่งประกายความความหรูหราในสไตล์สุดคลาสสิคแบบ M∙A∙C Cremesheen Pearl เจิดจรัสแวววาวกว่าที่เคยด้วยประกายมุกชิมเมอร์ของ Cremesheen Lipstick ให้ฟินิชที่เคลือบประกายเรืองรองด้วย pearlized pigments พิกเมินท์ประกายมุก มีให้เลือกถึงหลากเฉดสีใหม่ที่ครีเอทมาเพื่อสาวเอเชียโดยเฉพาะ อีกหนึ่งลิปสติกสีสดใสใหม่ที่ควรมีพกคู่กันไว้ในประเป๋า</p>','',1.00,1.00,1.00,1.00,4,4,'',1,'2017-01-09 11:03:58','2017-01-09 11:03:58',100,0,'old',2,NULL,'0000-00-00 00:00:00'),
	(166,9,NULL,31,34,'t5t5t5t5t','5t5t5t5t5t','ผ้าพันคอ 100%','ผ้าพันคอผ้าพันคอ 100%','<p><br></p>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>','<div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">การย้อมผ้าคราม</div><div style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 20px; margin-bottom: 0.5em; margin-top: 0.5em;\">สีครามเป็นสีย้อมธรรมชาติที่เก่าแก่มาก    ซึ่งมนุษย์รู้จักกันมามากว่า   6000   ปี    ประชากรที่อาศัยในเขตร้อนของโลกล้วนเคยทำสีครามจากต้นไม้ชนิดต่างๆตามภูมิภาคนั้นๆ แต่สีครามคุณภาพดีผลิตจากเอเชีย   ดังเช่น    สีครามจากอินเดียเป็นที่นิยมของคนอังกฤษมากกว่าสีครามจากเยอรมันและฝรั่งเศส   แต่การใช้สีครามลดลงเหลือเพียง 4 % ของทั่วโลกในปี  2457    ต่อมาประมาณปี พ.ศ.  2535 ประเทศของเราพบกับปัญหา มลพิษจากสิ่งแวดล้อม สาเหตุหนึ่ง เกิดจากสารเคมีสังเคราะห์ซึ่งรวมถึงสีย้อมด้วย สีย้อมผ้าส่วนใหญ่เป็นออกไซด์ของโลหะหนัก ซึ่งโลหะหนักหลายชนิดเป็นสารก่อมะเร็ง ใส่แล้วรู้สึกร้อน  ดังนั้น   จึงหันมานิยมสีย้อมธรรมชาติ ซึ่งในขณะ เดียวกันก็ได้นำภูมิปัญญาเก่า ๆ ที่ได้สืบทอดกันมาแต่สมัยโบราณจากเดิมเกือบลือหายไปแล้วนั้น  กลับมาพัฒนาเป็นอาชีพหลักของลูกหลานในทุกวันนี้</div>',NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2017-01-09 16:15:10','2017-01-09 16:15:10',50,0,'approve',89,1,'2017-01-09 16:17:04'),
	(167,9,NULL,31,34,'534534543534543','54354334r34r34r','ผ้าคลุมไหล่','ผ้าคลุมไหล่','<p>ผ้าคลุมไหล่<br></p>','<p>ผ้าคลุมไหล่<br></p>','<p>ผ้าคลุมไหล่<br></p>',NULL,NULL,NULL,NULL,NULL,NULL,'ผ้าคลุมไหล่,ผ้าคราม',1,'2017-01-09 16:29:13','2017-01-09 16:29:13',50,0,'approve',94,1,'2017-01-09 16:30:01');

/*!40000 ALTER TABLE `product_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_view
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_view`;

CREATE TABLE `product_view` (
  `productViewId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `productId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned DEFAULT NULL,
  `token` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`productViewId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_view` WRITE;
/*!40000 ALTER TABLE `product_view` DISABLE KEYS */;

INSERT INTO `product_view` (`productViewId`, `productId`, `userId`, `token`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(15,8,5,NULL,1,'2016-10-11 14:12:57','2016-10-11 14:12:57'),
	(16,35,5,NULL,1,'2016-10-11 14:13:38','2016-10-11 14:13:38'),
	(17,43,5,NULL,1,'2016-10-11 14:14:11','2016-10-11 14:14:11'),
	(18,41,5,NULL,1,'2016-10-11 14:14:34','2016-10-11 14:14:34'),
	(19,43,5,NULL,1,'2016-10-11 14:19:55','2016-10-11 14:19:55'),
	(20,41,5,NULL,1,'2016-10-11 14:21:11','2016-10-11 14:21:11'),
	(21,41,5,NULL,1,'2016-10-11 16:48:59','2016-10-11 16:48:59'),
	(22,41,5,NULL,1,'2016-10-12 08:47:02','2016-10-12 08:47:02'),
	(23,8,NULL,'D1QZ3uNH6-ME_UaMTwgD7AE7Vp_f8W0g',1,'2016-10-12 11:42:56','2016-10-12 11:42:56'),
	(24,3,1,NULL,1,'2016-10-14 07:54:32','2016-10-14 07:54:32'),
	(25,4,1,NULL,1,'2016-10-14 07:54:45','2016-10-14 07:54:45'),
	(26,8,1,NULL,1,'2016-10-14 07:54:52','2016-10-14 07:54:52'),
	(27,30,1,NULL,1,'2016-10-14 07:55:04','2016-10-14 07:55:04'),
	(28,43,5,NULL,1,'2016-10-14 08:01:54','2016-10-14 08:01:54'),
	(29,35,5,NULL,1,'2016-10-14 08:03:18','2016-10-14 08:03:18'),
	(30,41,5,NULL,1,'2016-10-14 08:03:25','2016-10-14 08:03:25'),
	(31,43,5,NULL,1,'2016-10-14 08:08:34','2016-10-14 08:08:34'),
	(32,41,5,NULL,1,'2016-10-14 08:51:46','2016-10-14 08:51:46'),
	(33,2,1,NULL,1,'2016-10-14 09:11:46','2016-10-14 09:11:46'),
	(34,11,1,NULL,1,'2016-10-14 09:54:04','2016-10-14 09:54:04'),
	(35,8,1,NULL,1,'2016-10-14 10:30:29','2016-10-14 10:30:29'),
	(36,35,1,NULL,1,'2016-10-14 10:32:01','2016-10-14 10:32:01'),
	(37,3,1,NULL,1,'2016-10-14 10:32:46','2016-10-14 10:32:46'),
	(38,1,1,NULL,1,'2016-10-14 10:34:14','2016-10-14 10:34:14'),
	(39,19,1,NULL,1,'2016-10-14 11:23:22','2016-10-14 11:23:22'),
	(40,3,1,NULL,1,'2016-10-14 11:37:13','2016-10-14 11:37:13'),
	(41,4,1,NULL,1,'2016-10-14 11:37:15','2016-10-14 11:37:15'),
	(42,8,1,NULL,1,'2016-10-14 11:38:23','2016-10-14 11:38:23'),
	(43,32,1,NULL,1,'2016-10-14 11:38:31','2016-10-14 11:38:31'),
	(44,30,1,NULL,1,'2016-10-14 11:39:05','2016-10-14 11:39:05'),
	(45,8,5,NULL,1,'2016-10-17 13:46:29','2016-10-17 13:46:29'),
	(46,1,5,NULL,1,'2016-10-17 14:35:33','2016-10-17 14:35:33'),
	(47,2,5,NULL,1,'2016-10-17 14:35:41','2016-10-17 14:35:41'),
	(48,7,5,NULL,1,'2016-10-17 14:35:47','2016-10-17 14:35:47'),
	(49,8,5,NULL,1,'2016-10-17 14:36:18','2016-10-17 14:36:18'),
	(50,11,5,NULL,1,'2016-10-17 14:36:48','2016-10-17 14:36:48'),
	(51,16,5,NULL,1,'2016-10-17 14:37:04','2016-10-17 14:37:04'),
	(52,19,5,NULL,1,'2016-10-17 14:37:18','2016-10-17 14:37:18'),
	(53,8,5,NULL,1,'2016-10-17 15:18:49','2016-10-17 15:18:49'),
	(54,11,5,NULL,1,'2016-10-17 15:19:01','2016-10-17 15:19:01'),
	(55,16,5,NULL,1,'2016-10-17 15:19:15','2016-10-17 15:19:15'),
	(56,19,5,NULL,1,'2016-10-17 15:19:21','2016-10-17 15:19:21'),
	(57,35,1,NULL,1,'2016-10-18 12:20:18','2016-10-18 12:20:18'),
	(58,4,NULL,'-dK1bxv23NdwZZ5YIw509N012Sdz1KPy',1,'2016-10-18 15:34:10','2016-10-18 15:34:10'),
	(59,1,5,NULL,1,'2016-10-18 15:34:41','2016-10-18 15:34:41'),
	(60,1,NULL,'-dK1bxv23NdwZZ5YIw509N012Sdz1KPy',1,'2016-10-18 15:37:42','2016-10-18 15:37:42'),
	(61,11,NULL,'C_fYboU04BDw_VAq17MIqToo9ZWsuPSN',1,'2016-10-18 15:50:56','2016-10-18 15:50:56'),
	(62,53,NULL,'C_ob1goztLj4Lq596tvYC--mAJsUfK1d',1,'2016-10-19 09:59:31','2016-10-19 09:59:31'),
	(63,43,NULL,'C_ob1goztLj4Lq596tvYC--mAJsUfK1d',1,'2016-10-19 10:00:50','2016-10-19 10:00:50'),
	(64,41,5,NULL,1,'2016-10-19 10:04:44','2016-10-19 10:04:44'),
	(65,43,5,NULL,1,'2016-10-19 10:05:53','2016-10-19 10:05:53'),
	(66,1,5,NULL,1,'2016-10-19 10:06:06','2016-10-19 10:06:06'),
	(67,4,5,NULL,1,'2016-10-19 10:06:33','2016-10-19 10:06:33'),
	(68,2,5,NULL,1,'2016-10-19 10:11:53','2016-10-19 10:11:53'),
	(69,1,5,NULL,1,'2016-10-19 10:12:01','2016-10-19 10:12:01'),
	(70,32,NULL,'ggENPhqnAN3izFvium8p30IwhgjmYvWF',1,'2016-10-19 11:18:42','2016-10-19 11:18:42'),
	(71,2,NULL,'ggENPhqnAN3izFvium8p30IwhgjmYvWF',1,'2016-10-19 11:37:54','2016-10-19 11:37:54'),
	(72,43,NULL,'ggENPhqnAN3izFvium8p30IwhgjmYvWF',1,'2016-10-19 11:39:44','2016-10-19 11:39:44'),
	(73,1,1,NULL,1,'2016-10-20 13:50:41','2016-10-20 13:50:41'),
	(74,3,NULL,'0_BQyDtsTvIBrBVMihj0SQ8q2IZhj64m',1,'2016-10-20 13:51:27','2016-10-20 13:51:27'),
	(75,2,1,NULL,1,'2016-10-20 13:51:28','2016-10-20 13:51:28'),
	(76,1,1,NULL,1,'2016-10-20 13:58:21','2016-10-20 13:58:21'),
	(77,8,5,NULL,1,'2016-10-20 14:07:34','2016-10-20 14:07:34'),
	(78,51,5,NULL,1,'2016-10-21 08:42:14','2016-10-21 08:42:14'),
	(79,52,5,NULL,1,'2016-10-21 08:42:18','2016-10-21 08:42:18'),
	(80,1,5,NULL,1,'2016-10-21 09:11:04','2016-10-21 09:11:04'),
	(81,3,5,NULL,1,'2016-10-21 09:12:08','2016-10-21 09:12:08'),
	(82,8,5,NULL,1,'2016-10-21 09:12:19','2016-10-21 09:12:19'),
	(83,4,5,NULL,1,'2016-10-21 09:12:28','2016-10-21 09:12:28'),
	(84,43,5,NULL,1,'2016-10-21 09:16:58','2016-10-21 09:16:58'),
	(85,41,5,NULL,1,'2016-10-21 09:17:08','2016-10-21 09:17:08'),
	(86,1,5,NULL,1,'2016-10-21 09:18:41','2016-10-21 09:18:41'),
	(87,8,5,NULL,1,'2016-10-21 10:18:48','2016-10-21 10:18:48'),
	(88,8,NULL,'tGVwbDWdbvjYAqbC1xzlnDhjC77LNCHv',1,'2016-10-21 11:17:43','2016-10-21 11:17:43'),
	(89,32,5,NULL,1,'2016-10-21 11:25:34','2016-10-21 11:25:34'),
	(90,1,1,NULL,1,'2016-10-21 11:34:00','2016-10-21 11:34:00'),
	(91,2,1,NULL,1,'2016-10-21 11:36:42','2016-10-21 11:36:42'),
	(92,8,1,NULL,1,'2016-10-21 11:56:14','2016-10-21 11:56:14'),
	(93,1,1,NULL,1,'2016-10-21 12:04:11','2016-10-21 12:04:11'),
	(94,8,1,NULL,1,'2016-10-21 12:04:30','2016-10-21 12:04:30'),
	(95,30,1,NULL,1,'2016-10-21 12:04:55','2016-10-21 12:04:55'),
	(96,2,1,NULL,1,'2016-10-21 12:05:22','2016-10-21 12:05:22'),
	(97,7,1,NULL,1,'2016-10-21 12:05:23','2016-10-21 12:05:23'),
	(98,42,5,NULL,1,'2016-10-21 12:54:10','2016-10-21 12:54:10'),
	(99,35,5,NULL,1,'2016-10-21 12:54:17','2016-10-21 12:54:17'),
	(100,43,5,NULL,1,'2016-10-21 12:54:28','2016-10-21 12:54:28'),
	(101,51,5,NULL,1,'2016-10-21 13:00:08','2016-10-21 13:00:08'),
	(102,11,5,NULL,1,'2016-10-21 13:12:37','2016-10-21 13:12:37'),
	(103,4,5,NULL,1,'2016-10-21 13:12:53','2016-10-21 13:12:53'),
	(104,2,1,NULL,1,'2016-10-21 13:29:08','2016-10-21 13:29:08'),
	(105,1,1,NULL,1,'2016-10-21 15:30:03','2016-10-21 15:30:03'),
	(106,8,1,NULL,1,'2016-10-21 15:31:33','2016-10-21 15:31:33'),
	(107,2,1,NULL,1,'2016-10-21 15:31:53','2016-10-21 15:31:53'),
	(108,3,NULL,'tGVwbDWdbvjYAqbC1xzlnDhjC77LNCHv',1,'2016-10-21 16:02:05','2016-10-21 16:02:05'),
	(109,19,NULL,'tGVwbDWdbvjYAqbC1xzlnDhjC77LNCHv',1,'2016-10-21 16:03:05','2016-10-21 16:03:05'),
	(110,3,1,NULL,1,'2016-10-21 16:04:25','2016-10-21 16:04:25'),
	(111,1,1,NULL,1,'2016-10-21 16:04:47','2016-10-21 16:04:47'),
	(112,2,1,NULL,1,'2016-10-21 16:04:49','2016-10-21 16:04:49'),
	(113,7,1,NULL,1,'2016-10-21 16:04:50','2016-10-21 16:04:50'),
	(114,5,1,NULL,1,'2016-10-21 16:04:51','2016-10-21 16:04:51'),
	(115,4,1,NULL,1,'2016-10-21 16:04:52','2016-10-21 16:04:52'),
	(116,35,1,NULL,1,'2016-10-25 16:23:50','2016-10-25 16:23:50'),
	(117,3,1,NULL,1,'2016-10-25 16:31:06','2016-10-25 16:31:06'),
	(118,4,1,NULL,1,'2016-10-25 16:31:26','2016-10-25 16:31:26'),
	(119,1,5,NULL,1,'2016-10-26 09:16:48','2016-10-26 09:16:48'),
	(120,35,5,NULL,1,'2016-10-26 09:33:40','2016-10-26 09:33:40'),
	(121,2,5,NULL,1,'2016-10-26 09:34:29','2016-10-26 09:34:29'),
	(122,7,5,NULL,1,'2016-10-26 10:07:09','2016-10-26 10:07:09'),
	(123,1,5,NULL,1,'2016-10-26 10:11:56','2016-10-26 10:11:56'),
	(124,4,5,NULL,1,'2016-10-26 14:28:51','2016-10-26 14:28:51'),
	(125,8,5,NULL,1,'2016-10-26 15:08:51','2016-10-26 15:08:51'),
	(126,4,5,NULL,1,'2016-10-26 15:09:06','2016-10-26 15:09:06'),
	(127,8,5,NULL,1,'2016-10-26 15:29:09','2016-10-26 15:29:09'),
	(128,4,5,NULL,1,'2016-10-26 15:30:04','2016-10-26 15:30:04'),
	(129,1,5,NULL,1,'2016-10-26 15:42:10','2016-10-26 15:42:10'),
	(130,8,5,NULL,1,'2016-10-26 15:43:42','2016-10-26 15:43:42'),
	(131,1,5,NULL,1,'2016-10-27 09:48:31','2016-10-27 09:48:31'),
	(132,8,5,NULL,1,'2016-10-27 09:50:56','2016-10-27 09:50:56'),
	(133,3,5,NULL,1,'2016-10-27 09:51:13','2016-10-27 09:51:13'),
	(134,11,5,NULL,1,'2016-10-27 09:52:49','2016-10-27 09:52:49'),
	(135,34,5,NULL,1,'2016-10-27 09:53:02','2016-10-27 09:53:02'),
	(136,30,5,NULL,1,'2016-10-27 09:54:07','2016-10-27 09:54:07'),
	(137,32,NULL,'bUkDgNrUS8Mutxz1i6q8xwNoXaOEq6Th',1,'2016-10-27 11:27:57','2016-10-27 11:27:57'),
	(138,30,5,NULL,1,'2016-10-27 11:33:29','2016-10-27 11:33:29'),
	(139,30,5,NULL,1,'2016-10-27 11:41:25','2016-10-27 11:41:25'),
	(140,30,5,NULL,1,'2016-10-27 11:49:10','2016-10-27 11:49:10'),
	(141,2,NULL,'nsU6-HCq_6BTnuExR_MQWGrp5w0ztkHU',1,'2016-10-27 11:54:53','2016-10-27 11:54:53'),
	(142,8,NULL,'nsU6-HCq_6BTnuExR_MQWGrp5w0ztkHU',1,'2016-10-27 11:55:08','2016-10-27 11:55:08'),
	(143,1,NULL,'nsU6-HCq_6BTnuExR_MQWGrp5w0ztkHU',1,'2016-10-27 11:55:48','2016-10-27 11:55:48'),
	(144,30,5,NULL,1,'2016-10-27 13:23:16','2016-10-27 13:23:16'),
	(145,8,NULL,'bUkDgNrUS8Mutxz1i6q8xwNoXaOEq6Th',1,'2016-10-27 14:27:05','2016-10-27 14:27:05'),
	(146,34,5,NULL,1,'2016-10-27 16:04:48','2016-10-27 16:04:48'),
	(147,34,5,NULL,1,'2016-10-31 10:30:20','2016-10-31 10:30:20'),
	(148,41,5,NULL,1,'2016-10-31 10:44:49','2016-10-31 10:44:49'),
	(149,32,5,NULL,1,'2016-10-31 14:17:15','2016-10-31 14:17:15'),
	(150,1,5,NULL,1,'2016-10-31 14:17:47','2016-10-31 14:17:47'),
	(151,43,5,NULL,1,'2016-10-31 14:25:52','2016-10-31 14:25:52'),
	(152,34,5,NULL,1,'2016-10-31 14:26:03','2016-10-31 14:26:03'),
	(153,43,5,NULL,1,'2016-10-31 14:36:40','2016-10-31 14:36:40'),
	(154,34,5,NULL,1,'2016-10-31 14:36:41','2016-10-31 14:36:41'),
	(155,43,5,NULL,1,'2016-10-31 14:43:53','2016-10-31 14:43:53'),
	(156,35,5,NULL,1,'2016-10-31 14:44:06','2016-10-31 14:44:06'),
	(157,43,5,NULL,1,'2016-10-31 14:51:54','2016-10-31 14:51:54'),
	(158,35,5,NULL,1,'2016-10-31 14:52:04','2016-10-31 14:52:04'),
	(159,43,5,NULL,1,'2016-11-01 10:11:27','2016-11-01 10:11:27'),
	(160,43,5,NULL,1,'2016-11-01 10:26:59','2016-11-01 10:26:59'),
	(161,43,5,NULL,1,'2016-11-01 11:07:24','2016-11-01 11:07:24'),
	(162,34,5,NULL,1,'2016-11-01 11:08:03','2016-11-01 11:08:03'),
	(163,1,NULL,'Ql6IPHKlyoW3-Mf0bDa4YIAW3oeI3wDr',1,'2016-11-01 16:34:19','2016-11-01 16:34:19'),
	(164,1,5,NULL,1,'2016-11-02 09:23:47','2016-11-02 09:23:47'),
	(165,35,5,NULL,1,'2016-11-02 10:54:01','2016-11-02 10:54:01'),
	(166,11,5,NULL,1,'2016-11-02 13:14:52','2016-11-02 13:14:52'),
	(167,49,5,NULL,1,'2016-11-02 13:24:36','2016-11-02 13:24:36'),
	(168,1,5,NULL,1,'2016-11-02 14:50:15','2016-11-02 14:50:15'),
	(169,2,5,NULL,1,'2016-11-02 14:50:45','2016-11-02 14:50:45'),
	(170,3,5,NULL,1,'2016-11-02 14:50:57','2016-11-02 14:50:57'),
	(171,32,5,NULL,1,'2016-11-02 14:52:09','2016-11-02 14:52:09'),
	(172,3,5,NULL,1,'2016-11-02 14:57:40','2016-11-02 14:57:40'),
	(173,4,5,NULL,1,'2016-11-02 14:57:51','2016-11-02 14:57:51'),
	(174,1,5,NULL,1,'2016-11-03 09:13:03','2016-11-03 09:13:03'),
	(175,4,5,NULL,1,'2016-11-03 09:37:05','2016-11-03 09:37:05'),
	(176,30,5,NULL,1,'2016-11-03 09:37:34','2016-11-03 09:37:34'),
	(177,41,5,NULL,1,'2016-11-03 10:55:22','2016-11-03 10:55:22'),
	(178,35,5,NULL,1,'2016-11-03 10:55:32','2016-11-03 10:55:32'),
	(179,44,5,NULL,1,'2016-11-03 10:55:43','2016-11-03 10:55:43'),
	(180,34,5,NULL,1,'2016-11-03 11:38:03','2016-11-03 11:38:03'),
	(181,1,5,NULL,1,'2016-11-03 11:38:14','2016-11-03 11:38:14'),
	(182,4,5,NULL,1,'2016-11-03 11:42:20','2016-11-03 11:42:20'),
	(183,3,5,NULL,1,'2016-11-03 11:42:27','2016-11-03 11:42:27'),
	(184,34,5,NULL,1,'2016-11-03 11:44:04','2016-11-03 11:44:04'),
	(185,1,5,NULL,1,'2016-11-03 11:45:12','2016-11-03 11:45:12'),
	(186,1,3,NULL,1,'2016-11-03 15:11:34','2016-11-03 15:11:34'),
	(187,4,NULL,'96gkgD-YKEsg-NBKGMIXDVoTEBhoG2dt',1,'2016-11-06 17:46:24','2016-11-06 17:46:24'),
	(188,30,5,NULL,1,'2016-11-06 19:23:53','2016-11-06 19:23:53'),
	(189,34,5,NULL,1,'2016-11-06 19:38:59','2016-11-06 19:38:59'),
	(190,34,5,NULL,1,'2016-11-06 19:51:11','2016-11-06 19:51:11'),
	(191,11,NULL,'QJ7oqm9x6vFdRHuzfCQMGPCyJwxwS5fm',1,'2016-11-07 19:03:00','2016-11-07 19:03:00'),
	(192,16,NULL,'QJ7oqm9x6vFdRHuzfCQMGPCyJwxwS5fm',1,'2016-11-07 20:30:19','2016-11-07 20:30:19'),
	(193,1,5,NULL,1,'2016-11-07 21:10:13','2016-11-07 21:10:13'),
	(194,1,5,NULL,1,'2016-11-08 14:54:50','2016-11-08 14:54:50'),
	(195,3,5,NULL,1,'2016-11-08 14:54:56','2016-11-08 14:54:56'),
	(196,2,8,NULL,1,'2016-11-11 10:52:34','2016-11-11 10:52:34'),
	(197,16,8,NULL,1,'2016-11-11 15:42:46','2016-11-11 15:42:46'),
	(198,1,5,NULL,1,'2016-11-14 14:00:16','2016-11-14 14:00:16'),
	(199,1,NULL,'afB4KCtQksVqlq13syE8v9ppkpVwKFDu',1,'2016-11-14 14:02:06','2016-11-14 14:02:06'),
	(200,11,NULL,'afB4KCtQksVqlq13syE8v9ppkpVwKFDu',1,'2016-11-14 14:02:19','2016-11-14 14:02:19'),
	(201,43,NULL,'afB4KCtQksVqlq13syE8v9ppkpVwKFDu',1,'2016-11-14 14:02:27','2016-11-14 14:02:27'),
	(202,3,NULL,'afB4KCtQksVqlq13syE8v9ppkpVwKFDu',1,'2016-11-14 14:03:38','2016-11-14 14:03:38'),
	(203,4,NULL,'afB4KCtQksVqlq13syE8v9ppkpVwKFDu',1,'2016-11-14 14:04:51','2016-11-14 14:04:51'),
	(204,2,NULL,'DXbQ9qsKCT0SMeCsXust_tTfz1iUIWTR',1,'2016-11-18 08:55:05','2016-11-18 08:55:05'),
	(205,1,1,NULL,1,'2016-11-21 09:21:00','2016-11-21 09:21:00'),
	(206,2,1,NULL,1,'2016-11-21 09:21:07','2016-11-21 09:21:07'),
	(207,55,1,NULL,1,'2016-11-21 09:27:41','2016-11-21 09:27:41'),
	(208,5,NULL,'IiOvjc-3ifF5Wrva2qGMP6VwA6UTxHdg',1,'2016-11-21 16:14:00','2016-11-21 16:14:00'),
	(209,1,NULL,'us48GBOkmGr1bO6qcvxq9tNbI1Rf_bFV',1,'2016-11-23 09:40:03','2016-11-23 09:40:03'),
	(210,2,NULL,'us48GBOkmGr1bO6qcvxq9tNbI1Rf_bFV',1,'2016-11-23 09:40:39','2016-11-23 09:40:39'),
	(211,55,1,NULL,1,'2016-11-24 10:23:50','2016-11-24 10:23:50'),
	(212,19,1,NULL,1,'2016-12-01 14:42:29','2016-12-01 14:42:29'),
	(213,1,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-06 11:33:15','2016-12-06 11:33:15'),
	(214,2,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-06 11:33:28','2016-12-06 11:33:28'),
	(215,45,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-06 11:34:45','2016-12-06 11:34:45'),
	(216,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 11:46:52','2016-12-08 11:46:52'),
	(217,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 15:24:58','2016-12-08 15:24:58'),
	(218,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 15:37:31','2016-12-08 15:37:31'),
	(219,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 15:43:18','2016-12-08 15:43:18'),
	(220,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 15:54:49','2016-12-08 15:54:49'),
	(221,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 16:11:07','2016-12-08 16:11:07'),
	(222,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 16:18:30','2016-12-08 16:18:30'),
	(223,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 16:25:21','2016-12-08 16:25:21'),
	(224,78,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-08 16:31:18','2016-12-08 16:31:18'),
	(225,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 08:19:23','2016-12-13 08:19:23'),
	(226,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 08:27:03','2016-12-13 08:27:03'),
	(227,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 09:03:29','2016-12-13 09:03:29'),
	(228,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 09:31:06','2016-12-13 09:31:06'),
	(229,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 09:49:43','2016-12-13 09:49:43'),
	(230,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 09:56:20','2016-12-13 09:56:20'),
	(231,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:07:51','2016-12-13 10:07:51'),
	(232,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:13:31','2016-12-13 10:13:31'),
	(233,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:21:31','2016-12-13 10:21:31'),
	(234,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:34:41','2016-12-13 10:34:41'),
	(235,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:39:41','2016-12-13 10:39:41'),
	(236,30,NULL,'lIXc3aZhJn-BIpW9qx9Wpg17LDm5j8lI',1,'2016-12-13 10:44:44','2016-12-13 10:44:44'),
	(237,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:46:06','2016-12-13 10:46:06'),
	(238,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:51:45','2016-12-13 10:51:45'),
	(239,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 10:59:46','2016-12-13 10:59:46'),
	(240,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:12:16','2016-12-13 11:12:16'),
	(241,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:17:28','2016-12-13 11:17:28'),
	(242,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:22:57','2016-12-13 11:22:57'),
	(243,3,NULL,'9S5LY8fIUKJxVBcGc3cMpG9QjZJynKEJ',1,'2016-12-13 11:25:48','2016-12-13 11:25:48'),
	(244,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:29:34','2016-12-13 11:29:34'),
	(245,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:34:37','2016-12-13 11:34:37'),
	(246,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 11:44:03','2016-12-13 11:44:03'),
	(247,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 12:02:04','2016-12-13 12:02:04'),
	(248,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 13:13:57','2016-12-13 13:13:57'),
	(249,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 13:35:45','2016-12-13 13:35:45'),
	(250,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 13:41:11','2016-12-13 13:41:11'),
	(251,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 13:49:22','2016-12-13 13:49:22'),
	(252,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 13:54:39','2016-12-13 13:54:39'),
	(253,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 14:07:50','2016-12-13 14:07:50'),
	(254,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 14:13:12','2016-12-13 14:13:12'),
	(255,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 14:21:26','2016-12-13 14:21:26'),
	(256,4,NULL,'1RujRZSEgtHfrnxtEJ0iX-wKQv0nigEW',1,'2016-12-13 14:30:41','2016-12-13 14:30:41'),
	(260,4,5,NULL,1,'2016-12-13 14:44:27','2016-12-13 14:44:27'),
	(261,4,5,NULL,1,'2016-12-13 15:02:05','2016-12-13 15:02:05'),
	(262,4,5,NULL,1,'2016-12-13 15:07:38','2016-12-13 15:07:38'),
	(263,4,5,NULL,1,'2016-12-13 15:14:20','2016-12-13 15:14:20'),
	(264,4,5,NULL,1,'2016-12-13 15:21:01','2016-12-13 15:21:01'),
	(265,4,5,NULL,1,'2016-12-13 15:32:12','2016-12-13 15:32:12'),
	(266,4,5,NULL,1,'2016-12-13 15:37:36','2016-12-13 15:37:36'),
	(267,4,5,NULL,1,'2016-12-13 15:44:00','2016-12-13 15:44:00'),
	(268,4,5,NULL,1,'2016-12-13 16:03:01','2016-12-13 16:03:01'),
	(269,4,5,NULL,1,'2016-12-14 08:26:11','2016-12-14 08:26:11'),
	(270,4,5,NULL,1,'2016-12-14 08:43:10','2016-12-14 08:43:10'),
	(271,78,5,NULL,1,'2016-12-14 08:46:41','2016-12-14 08:46:41'),
	(272,78,5,NULL,1,'2016-12-14 08:55:05','2016-12-14 08:55:05'),
	(273,4,5,NULL,1,'2016-12-14 08:57:01','2016-12-14 08:57:01'),
	(274,78,5,NULL,1,'2016-12-14 09:00:29','2016-12-14 09:00:29'),
	(275,78,5,NULL,1,'2016-12-14 09:17:19','2016-12-14 09:17:19'),
	(276,78,5,NULL,1,'2016-12-14 09:23:06','2016-12-14 09:23:06'),
	(277,78,5,NULL,1,'2016-12-14 09:28:11','2016-12-14 09:28:11'),
	(278,4,5,NULL,1,'2016-12-14 09:31:21','2016-12-14 09:31:21'),
	(279,78,5,NULL,1,'2016-12-14 09:35:45','2016-12-14 09:35:45'),
	(280,78,5,NULL,1,'2016-12-14 09:41:01','2016-12-14 09:41:01'),
	(281,78,5,NULL,1,'2016-12-14 09:46:13','2016-12-14 09:46:13'),
	(282,4,5,NULL,1,'2016-12-14 09:49:41','2016-12-14 09:49:41'),
	(283,4,5,NULL,1,'2016-12-14 09:55:48','2016-12-14 09:55:48'),
	(284,78,5,NULL,1,'2016-12-14 09:58:51','2016-12-14 09:58:51'),
	(285,78,5,NULL,1,'2016-12-14 10:04:30','2016-12-14 10:04:30'),
	(286,78,5,NULL,1,'2016-12-14 10:10:54','2016-12-14 10:10:54'),
	(287,78,5,NULL,1,'2016-12-14 10:15:54','2016-12-14 10:15:54'),
	(288,4,8,NULL,1,'2016-12-14 10:27:35','2016-12-14 10:27:35'),
	(289,4,8,NULL,1,'2016-12-14 10:34:46','2016-12-14 10:34:46'),
	(290,4,8,NULL,1,'2016-12-14 10:41:09','2016-12-14 10:41:09'),
	(291,78,8,NULL,1,'2016-12-14 10:41:41','2016-12-14 10:41:41'),
	(292,78,8,NULL,1,'2016-12-14 10:47:39','2016-12-14 10:47:39'),
	(293,78,8,NULL,1,'2016-12-14 10:53:38','2016-12-14 10:53:38'),
	(294,78,8,NULL,1,'2016-12-14 11:02:34','2016-12-14 11:02:34'),
	(295,4,8,NULL,1,'2016-12-14 11:11:06','2016-12-14 11:11:06'),
	(296,4,8,NULL,1,'2016-12-14 11:33:09','2016-12-14 11:33:09'),
	(297,4,8,NULL,1,'2016-12-14 11:41:44','2016-12-14 11:41:44'),
	(298,4,8,NULL,1,'2016-12-14 13:21:11','2016-12-14 13:21:11'),
	(299,4,8,NULL,1,'2016-12-14 13:39:12','2016-12-14 13:39:12'),
	(300,4,8,NULL,1,'2016-12-14 14:03:27','2016-12-14 14:03:27'),
	(301,78,8,NULL,1,'2016-12-14 14:04:45','2016-12-14 14:04:45'),
	(302,4,8,NULL,1,'2016-12-14 14:08:50','2016-12-14 14:08:50'),
	(303,78,8,NULL,1,'2016-12-14 14:18:18','2016-12-14 14:18:18'),
	(304,78,8,NULL,1,'2016-12-14 14:27:38','2016-12-14 14:27:38'),
	(305,78,8,NULL,1,'2016-12-14 14:33:16','2016-12-14 14:33:16'),
	(306,4,8,NULL,1,'2016-12-14 14:40:14','2016-12-14 14:40:14'),
	(307,78,8,NULL,1,'2016-12-14 14:48:14','2016-12-14 14:48:14'),
	(308,4,8,NULL,1,'2016-12-14 14:51:06','2016-12-14 14:51:06'),
	(309,4,8,NULL,1,'2016-12-14 15:01:14','2016-12-14 15:01:14'),
	(310,4,8,NULL,1,'2016-12-14 15:06:26','2016-12-14 15:06:26'),
	(311,4,8,NULL,1,'2016-12-14 15:12:03','2016-12-14 15:12:03'),
	(312,4,8,NULL,1,'2016-12-14 15:18:02','2016-12-14 15:18:02'),
	(313,4,8,NULL,1,'2016-12-14 15:31:06','2016-12-14 15:31:06'),
	(314,78,8,NULL,1,'2016-12-14 15:35:33','2016-12-14 15:35:33'),
	(315,4,8,NULL,1,'2016-12-14 15:37:49','2016-12-14 15:37:49'),
	(316,4,8,NULL,1,'2016-12-14 15:44:31','2016-12-14 15:44:31'),
	(317,4,8,NULL,1,'2016-12-14 15:54:51','2016-12-14 15:54:51'),
	(318,78,8,NULL,1,'2016-12-14 15:59:14','2016-12-14 15:59:14'),
	(319,4,8,NULL,1,'2016-12-14 16:00:14','2016-12-14 16:00:14'),
	(320,78,8,NULL,1,'2016-12-14 16:06:01','2016-12-14 16:06:01'),
	(321,4,8,NULL,1,'2016-12-14 16:08:27','2016-12-14 16:08:27'),
	(322,4,8,NULL,1,'2016-12-14 16:15:28','2016-12-14 16:15:28'),
	(323,4,8,NULL,1,'2016-12-14 16:22:14','2016-12-14 16:22:14'),
	(324,4,8,NULL,1,'2016-12-14 16:27:32','2016-12-14 16:27:32'),
	(325,4,8,NULL,1,'2016-12-15 08:28:43','2016-12-15 08:28:43'),
	(326,2,NULL,'TOCzKE_ApHZiPvCzuc4jvc__jjBOQWdN',1,'2016-12-23 10:04:19','2016-12-23 10:04:19'),
	(327,84,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:11:08','2016-12-23 10:11:08'),
	(328,83,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:11:14','2016-12-23 10:11:14'),
	(329,83,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:16:20','2016-12-23 10:16:20'),
	(330,84,9,NULL,1,'2016-12-23 10:22:41','2016-12-23 10:22:41'),
	(331,83,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:24:36','2016-12-23 10:24:36'),
	(332,84,9,NULL,1,'2016-12-23 10:28:22','2016-12-23 10:28:22'),
	(333,83,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:30:34','2016-12-23 10:30:34'),
	(334,84,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:32:04','2016-12-23 10:32:04'),
	(335,84,9,NULL,1,'2016-12-23 10:33:52','2016-12-23 10:33:52'),
	(336,83,9,NULL,1,'2016-12-23 10:38:25','2016-12-23 10:38:25'),
	(337,84,9,NULL,1,'2016-12-23 10:39:42','2016-12-23 10:39:42'),
	(338,84,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 10:46:35','2016-12-23 10:46:35'),
	(339,84,9,NULL,1,'2016-12-23 10:51:57','2016-12-23 10:51:57'),
	(340,84,9,NULL,1,'2016-12-23 11:10:07','2016-12-23 11:10:07'),
	(341,84,9,NULL,1,'2016-12-23 13:49:11','2016-12-23 13:49:11'),
	(342,84,9,NULL,1,'2016-12-23 13:59:07','2016-12-23 13:59:07'),
	(343,84,9,NULL,1,'2016-12-23 14:08:52','2016-12-23 14:08:52'),
	(344,84,NULL,'Q7ZUJX0oBVzQ34LX8rQwQEO8kCr8WGZh',1,'2016-12-23 14:11:58','2016-12-23 14:11:58'),
	(345,84,9,NULL,1,'2016-12-23 14:14:09','2016-12-23 14:14:09'),
	(346,84,9,NULL,1,'2016-12-23 14:19:52','2016-12-23 14:19:52'),
	(347,83,9,NULL,1,'2016-12-23 14:20:39','2016-12-23 14:20:39'),
	(348,84,8,NULL,1,'2016-12-23 14:23:33','2016-12-23 14:23:33'),
	(349,84,9,NULL,1,'2016-12-23 14:28:50','2016-12-23 14:28:50'),
	(350,84,NULL,'P8R9z-m5QPIl1x1_ehh1di8tIhCw_j26',1,'2016-12-23 14:29:04','2016-12-23 14:29:04'),
	(351,83,2,NULL,1,'2016-12-23 14:29:18','2016-12-23 14:29:18'),
	(352,84,2,NULL,1,'2016-12-23 14:29:23','2016-12-23 14:29:23'),
	(353,84,NULL,'3HKpkIa5CJiFkkvcSOYUFD5mkGwHphcd',1,'2016-12-23 14:30:35','2016-12-23 14:30:35'),
	(354,84,5,NULL,1,'2016-12-23 14:48:40','2016-12-23 14:48:40'),
	(355,83,1,NULL,1,'2016-12-23 14:53:54','2016-12-23 14:53:54'),
	(356,84,1,NULL,1,'2016-12-23 14:54:40','2016-12-23 14:54:40'),
	(357,84,5,NULL,1,'2016-12-23 14:55:56','2016-12-23 14:55:56'),
	(358,84,NULL,'4nruAaq-Ygm40mjV909b7Vz5KO8af0XN',1,'2016-12-23 15:00:50','2016-12-23 15:00:50'),
	(359,84,5,NULL,1,'2016-12-23 15:02:19','2016-12-23 15:02:19'),
	(360,84,5,NULL,1,'2016-12-23 15:09:50','2016-12-23 15:09:50'),
	(361,84,2,NULL,1,'2016-12-23 15:37:18','2016-12-23 15:37:18'),
	(362,84,NULL,'7mIqtdLba_RSwkv8mfJEJmiAI1GpDR6C',1,'2016-12-26 10:26:24','2016-12-26 10:26:24'),
	(363,83,NULL,'7mIqtdLba_RSwkv8mfJEJmiAI1GpDR6C',1,'2016-12-26 10:26:29','2016-12-26 10:26:29'),
	(364,84,5,NULL,1,'2016-12-26 15:00:27','2016-12-26 15:00:27'),
	(365,84,NULL,'nP7NC_nXIoqFnD2dAn3xuklIMh2uFwog',1,'2016-12-26 15:01:09','2016-12-26 15:01:09'),
	(366,84,1,NULL,1,'2016-12-26 15:04:31','2016-12-26 15:04:31'),
	(367,84,5,NULL,1,'2016-12-27 09:10:11','2016-12-27 09:10:11'),
	(368,83,5,NULL,1,'2016-12-27 09:10:26','2016-12-27 09:10:26'),
	(369,83,5,NULL,1,'2016-12-27 09:15:41','2016-12-27 09:15:41'),
	(370,4,NULL,'vM9Y9yIwLmUR2M5iS_aecoeypp_Udfv4',1,'2016-12-27 09:55:01','2016-12-27 09:55:01'),
	(371,84,5,NULL,1,'2016-12-27 09:57:48','2016-12-27 09:57:48'),
	(372,4,NULL,'vM9Y9yIwLmUR2M5iS_aecoeypp_Udfv4',1,'2016-12-27 10:02:36','2016-12-27 10:02:36'),
	(373,84,5,NULL,1,'2016-12-27 10:18:48','2016-12-27 10:18:48'),
	(374,84,5,NULL,1,'2016-12-27 10:30:04','2016-12-27 10:30:04'),
	(375,87,5,NULL,1,'2016-12-27 10:36:31','2016-12-27 10:36:31'),
	(376,87,5,NULL,1,'2016-12-27 10:51:29','2016-12-27 10:51:29'),
	(377,87,5,NULL,1,'2016-12-27 10:59:03','2016-12-27 10:59:03'),
	(378,83,5,NULL,1,'2016-12-27 11:13:55','2016-12-27 11:13:55'),
	(379,84,5,NULL,1,'2016-12-27 11:13:59','2016-12-27 11:13:59'),
	(380,87,5,NULL,1,'2016-12-27 11:24:25','2016-12-27 11:24:25'),
	(381,86,5,NULL,1,'2016-12-27 11:40:19','2016-12-27 11:40:19'),
	(382,86,10,NULL,1,'2016-12-27 14:07:29','2016-12-27 14:07:29'),
	(383,86,11,NULL,1,'2016-12-27 16:09:47','2016-12-27 16:09:47'),
	(384,89,1,NULL,1,'2016-12-27 16:15:52','2016-12-27 16:15:52'),
	(385,92,1,NULL,1,'2016-12-27 16:15:53','2016-12-27 16:15:53'),
	(386,86,5,NULL,1,'2016-12-27 16:32:00','2016-12-27 16:32:00'),
	(387,86,NULL,'BxtUFeovAK9lHuusA161OsXtoKwudxzL',1,'2016-12-28 09:22:02','2016-12-28 09:22:02'),
	(388,86,8,NULL,1,'2016-12-28 09:33:16','2016-12-28 09:33:16'),
	(389,86,5,NULL,1,'2016-12-28 09:45:18','2016-12-28 09:45:18'),
	(390,86,5,NULL,1,'2016-12-28 09:55:14','2016-12-28 09:55:14'),
	(391,86,8,NULL,1,'2016-12-28 09:55:54','2016-12-28 09:55:54'),
	(392,86,5,NULL,1,'2016-12-28 10:01:42','2016-12-28 10:01:42'),
	(393,86,8,NULL,1,'2016-12-28 10:50:15','2016-12-28 10:50:15'),
	(394,86,5,NULL,1,'2016-12-28 13:52:06','2016-12-28 13:52:06'),
	(395,86,5,NULL,1,'2016-12-28 13:59:13','2016-12-28 13:59:13'),
	(396,92,1,NULL,1,'2017-01-04 07:16:45','2017-01-04 07:16:45'),
	(397,89,1,NULL,1,'2017-01-04 07:16:47','2017-01-04 07:16:47'),
	(398,86,1,NULL,1,'2017-01-04 07:17:20','2017-01-04 07:17:20'),
	(399,86,NULL,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy',1,'2017-01-04 07:42:04','2017-01-04 07:42:04'),
	(400,86,NULL,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy',1,'2017-01-04 09:01:20','2017-01-04 09:01:20'),
	(401,86,NULL,'wViX8dL_EEhuZ_1KW7H6p9S5_rBs-QUy',1,'2017-01-04 09:14:59','2017-01-04 09:14:59'),
	(402,86,8,NULL,1,'2017-01-04 09:21:14','2017-01-04 09:21:14'),
	(403,92,NULL,'93PLmOsgZZZCTFANxuYCTCQwyNlqooyr',1,'2017-01-04 09:23:45','2017-01-04 09:23:45'),
	(404,86,5,NULL,1,'2017-01-04 09:25:05','2017-01-04 09:25:05'),
	(405,86,8,NULL,1,'2017-01-04 09:36:48','2017-01-04 09:36:48'),
	(406,86,5,NULL,1,'2017-01-04 09:42:26','2017-01-04 09:42:26'),
	(407,83,5,NULL,1,'2017-01-04 10:09:13','2017-01-04 10:09:13'),
	(408,84,5,NULL,1,'2017-01-04 10:09:33','2017-01-04 10:09:33'),
	(409,86,5,NULL,1,'2017-01-04 10:10:00','2017-01-04 10:10:00'),
	(410,83,5,NULL,1,'2017-01-04 10:21:22','2017-01-04 10:21:22'),
	(411,84,5,NULL,1,'2017-01-04 10:21:41','2017-01-04 10:21:41'),
	(412,86,5,NULL,1,'2017-01-04 13:13:54','2017-01-04 13:13:54'),
	(413,84,NULL,'NzQXcXYGYPEhpUm4-rrac7V-sobBJc5_',1,'2017-01-06 11:25:13','2017-01-06 11:25:13'),
	(414,83,NULL,'NzQXcXYGYPEhpUm4-rrac7V-sobBJc5_',1,'2017-01-06 11:25:15','2017-01-06 11:25:15'),
	(415,1,NULL,'xLnLX3hjFcTlAvjak6KJ0oAJQIJU2IgN',1,'2017-01-06 13:42:07','2017-01-06 13:42:07'),
	(416,92,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:13:35','2017-01-09 14:13:35'),
	(417,87,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:14:16','2017-01-09 14:14:16'),
	(418,89,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:14:34','2017-01-09 14:14:34'),
	(419,83,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:15:20','2017-01-09 14:15:20'),
	(420,84,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:15:21','2017-01-09 14:15:21'),
	(421,86,NULL,'5b-lweDRwMOiJTAZPxA8I5J31gtVzH81',1,'2017-01-09 14:15:22','2017-01-09 14:15:22'),
	(422,86,1,NULL,1,'2017-01-09 14:18:47','2017-01-09 14:18:47'),
	(423,84,1,NULL,1,'2017-01-09 14:19:41','2017-01-09 14:19:41'),
	(424,89,1,NULL,1,'2017-01-09 14:20:18','2017-01-09 14:20:18'),
	(425,92,1,NULL,1,'2017-01-09 14:22:33','2017-01-09 14:22:33'),
	(426,89,5,NULL,1,'2017-01-09 14:26:09','2017-01-09 14:26:09'),
	(427,89,1,NULL,1,'2017-01-09 14:27:46','2017-01-09 14:27:46'),
	(428,92,1,NULL,1,'2017-01-09 14:32:25','2017-01-09 14:32:25'),
	(429,86,1,NULL,1,'2017-01-09 14:32:57','2017-01-09 14:32:57'),
	(430,89,1,NULL,1,'2017-01-09 15:08:39','2017-01-09 15:08:39'),
	(431,92,1,NULL,1,'2017-01-09 15:08:48','2017-01-09 15:08:48'),
	(432,89,1,NULL,1,'2017-01-09 15:16:58','2017-01-09 15:16:58'),
	(433,92,1,NULL,1,'2017-01-09 15:17:03','2017-01-09 15:17:03'),
	(434,86,1,NULL,1,'2017-01-09 15:17:21','2017-01-09 15:17:21'),
	(435,83,1,NULL,1,'2017-01-09 15:17:50','2017-01-09 15:17:50'),
	(436,84,1,NULL,1,'2017-01-09 15:17:52','2017-01-09 15:17:52'),
	(437,92,1,NULL,1,'2017-01-09 16:09:33','2017-01-09 16:09:33'),
	(438,94,1,NULL,1,'2017-01-09 16:33:47','2017-01-09 16:33:47'),
	(439,86,1,NULL,1,'2017-01-12 15:38:21','2017-01-12 15:38:21'),
	(440,86,5,NULL,1,'2017-01-13 08:57:30','2017-01-13 08:57:30');

/*!40000 ALTER TABLE `product_view` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table receive
# ------------------------------------------------------------

DROP TABLE IF EXISTS `receive`;

CREATE TABLE `receive` (
  `receiveId` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `pickingId` bigint(20) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `otp` varchar(45) DEFAULT NULL,
  `isUse` tinyint(6) DEFAULT NULL,
  `status` tinyint(6) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`receiveId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `receive` WRITE;
/*!40000 ALTER TABLE `receive` DISABLE KEYS */;

INSERT INTO `receive` (`receiveId`, `orderId`, `userId`, `pickingId`, `password`, `otp`, `isUse`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,42,5,13,'45681220','812681',0,2,'2016-10-17 15:14:35','2016-10-17 15:14:35'),
	(2,43,5,10,'34167480','294494',0,2,'2016-10-26 15:20:01','2016-10-26 15:20:01'),
	(3,36,1,10,'50796240','962877',0,2,'2016-11-01 09:48:45','2016-11-01 09:48:45'),
	(4,56,5,13,'94005156','703639',0,2,'2016-11-07 17:26:48','2016-11-07 17:26:48'),
	(5,57,5,13,'37199610','632883',0,2,'2016-11-10 08:58:27','2016-11-10 08:58:27'),
	(6,57,5,13,'15685118','511589',0,2,'2016-11-10 09:08:33','2016-11-10 09:08:33'),
	(7,54,5,10,'38245335','690727',0,2,'2016-11-11 08:55:51','2016-11-11 08:55:51');

/*!40000 ALTER TABLE `receive` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table region
# ------------------------------------------------------------

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `regionId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`regionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;

INSERT INTO `region` (`regionId`, `title`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'ภาคกลาง','',1,'2016-06-17 08:23:54','2016-06-17 08:23:57'),
	(2,'ภาคตะวันออก','',1,'2016-06-17 08:24:08','2016-06-17 08:24:08'),
	(3,'ภาคใต้','',1,'2016-06-17 08:24:17','2016-06-17 08:24:17'),
	(4,'ภาคเหนือ','',1,'2016-06-17 08:24:24','2016-06-17 08:24:24'),
	(5,'ภาคตะวันตก','',1,'2016-06-17 08:24:33','2016-06-17 08:24:33'),
	(6,'ภาคตะวันออกเฉียงเหนือ','',1,'2016-06-17 08:25:00','2016-06-17 08:25:00');

/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shipping_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shipping_type`;

CREATE TABLE `shipping_type` (
  `shippingTypeId` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` bigint(10) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shippingTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `shipping_type` WRITE;
/*!40000 ALTER TABLE `shipping_type` DISABLE KEYS */;

INSERT INTO `shipping_type` (`shippingTypeId`, `title`, `date`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'2 Days.',2,1,NULL,'2016-07-28 14:11:41'),
	(2,'5 Days.',5,1,NULL,'2016-07-28 14:11:41'),
	(3,'10 Days.',10,1,NULL,'2016-07-28 14:11:41'),
	(4,'15 Days.',15,1,NULL,'2016-07-28 14:11:41');

/*!40000 ALTER TABLE `shipping_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table show_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `show_category`;

CREATE TABLE `show_category` (
  `showCategoryId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` bigint(20) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`showCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `show_category` WRITE;
/*!40000 ALTER TABLE `show_category` DISABLE KEYS */;

INSERT INTO `show_category` (`showCategoryId`, `categoryId`, `type`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(5,3,1,1,'2016-09-28 11:23:03','2016-07-04 12:45:49'),
	(6,4,1,1,'2016-08-23 14:45:48','2016-07-04 12:45:49'),
	(7,5,1,1,'2016-09-28 11:23:03','2016-07-04 12:45:49'),
	(12,8,1,1,'2016-09-15 09:57:01','2016-07-04 12:54:02'),
	(14,80,1,1,'2016-08-23 14:45:48','2016-07-04 15:05:42'),
	(15,94,1,1,'2016-08-23 14:45:48','2016-08-04 09:01:46'),
	(17,10,1,1,'2016-09-15 09:57:01','2016-09-15 09:48:19'),
	(18,11,1,1,'2016-09-28 11:23:03','2016-09-15 09:48:19'),
	(19,12,2,1,'2016-09-28 11:23:03','2016-09-15 09:48:19'),
	(20,13,1,1,'2016-09-28 11:23:03','2016-09-15 09:48:19'),
	(21,14,1,1,'2016-09-15 09:57:01','2016-09-15 09:48:19'),
	(22,15,1,1,'2016-09-15 09:57:01','2016-09-15 09:48:19'),
	(23,16,1,1,'2016-09-15 09:57:01','2016-09-15 09:48:19'),
	(24,17,1,1,'2016-09-15 09:57:01','2016-09-15 09:48:19'),
	(25,18,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(26,19,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(27,20,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(28,21,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(29,22,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(30,23,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(31,24,1,1,'2016-09-15 09:57:01','2016-09-15 09:57:01'),
	(32,1,2,1,'2016-09-28 11:23:03','2016-09-23 14:56:50'),
	(33,2,2,1,'2016-09-28 11:23:03','2016-09-23 14:56:50'),
	(36,42,2,1,'2016-09-28 11:23:03','2016-09-28 10:10:46');

/*!40000 ALTER TABLE `show_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stock_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stock_history`;

CREATE TABLE `stock_history` (
  `stockHistoryId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderItemId` bigint(20) NOT NULL,
  `productSuppId` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stockHistoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table store
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `storeId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `regionId` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeId`),
  KEY `fk_s_to_re_idx` (`regionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;

INSERT INTO `store` (`storeId`, `regionId`, `title`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,'COzxy','',1,'2016-06-17 08:33:10','2016-10-14 09:27:06');

/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store_location
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_location`;

CREATE TABLE `store_location` (
  `storeLocationId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeId` bigint(20) unsigned NOT NULL,
  `provinceId` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeLocationId`),
  KEY `fk_spro_to_s_idx` (`storeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store_location` WRITE;
/*!40000 ALTER TABLE `store_location` DISABLE KEYS */;

INSERT INTO `store_location` (`storeLocationId`, `storeId`, `provinceId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,2523,1,'2016-06-17 09:46:38','2016-06-22 09:11:10'),
	(2,1,2525,1,'2016-06-17 09:48:31','2016-06-17 09:48:31'),
	(3,1,2526,1,'2016-06-17 09:48:35','2016-06-17 09:48:35'),
	(4,1,2524,1,'2016-06-17 09:48:45','2016-06-17 09:48:45');

/*!40000 ALTER TABLE `store_location` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store_picking
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_picking`;

CREATE TABLE `store_picking` (
  `storePickingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `pickerId` bigint(20) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `status` tinyint(6) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storePickingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store_picking` WRITE;
/*!40000 ALTER TABLE `store_picking` DISABLE KEYS */;

INSERT INTO `store_picking` (`storePickingId`, `pickerId`, `orderId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1234,'36',5,'2016-10-17 14:01:23','2016-10-17 14:27:37'),
	(2,1234,'42',5,'2016-10-17 14:47:39','2016-10-17 14:49:03'),
	(3,1234,'42',5,'2016-10-17 14:56:32','2016-10-17 14:56:42'),
	(4,1234,'43',5,'2016-10-19 10:51:33','2016-10-19 10:58:01'),
	(53,8,'78',5,'2016-12-26 14:16:39','2016-12-26 14:16:47');

/*!40000 ALTER TABLE `store_picking` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_product`;

CREATE TABLE `store_product` (
  `storeProductId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeProductGroupId` bigint(20) unsigned NOT NULL,
  `storeId` bigint(20) unsigned DEFAULT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `productSuppId` bigint(20) DEFAULT NULL,
  `paletNo` decimal(15,2) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `shippingFromType` tinyint(4) NOT NULL,
  `importQuantity` bigint(20) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `orderItemId` bigint(20) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeProductId`),
  KEY `fk_sp_to_p_idx` (`productId`),
  KEY `fk_sp_to_spg_idx` (`storeProductGroupId`),
  KEY `fk_sp_to_s_idx` (`storeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table store_product_arrange
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_product_arrange`;

CREATE TABLE `store_product_arrange` (
  `storeProductArrangeId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeProductId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `productSuppId` bigint(20) unsigned NOT NULL,
  `slotId` bigint(20) unsigned NOT NULL,
  `quantity` decimal(15,2) NOT NULL,
  `orderId` bigint(20) DEFAULT '0',
  `parentId` bigint(20) DEFAULT '0',
  `result` bigint(20) DEFAULT '0' COMMENT 'ยอดคงเหลือ',
  `pickerId` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeProductArrangeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store_product_arrange` WRITE;
/*!40000 ALTER TABLE `store_product_arrange` DISABLE KEYS */;

INSERT INTO `store_product_arrange` (`storeProductArrangeId`, `storeProductId`, `productId`, `productSuppId`, `slotId`, `quantity`, `orderId`, `parentId`, `result`, `pickerId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,2,35,0,3,5.00,0,0,2,NULL,4,'2016-10-14 09:04:48','2016-11-09 11:37:51'),
	(2,2,35,0,4,5.00,0,0,2,NULL,4,'2016-10-14 09:05:12','2016-11-10 11:09:49'),
	(3,3,41,0,6,10.00,0,0,2,NULL,4,'2016-10-14 09:06:27','2016-11-10 11:09:49'),
	(4,19,1,0,4,10.00,0,0,6,NULL,4,'2016-10-31 11:44:33','2016-12-06 10:12:47'),
	(7,10,8,0,3,100.00,0,0,2,NULL,4,'2016-10-17 13:55:20','2016-10-17 13:55:20'),
	(8,11,11,0,4,100.00,0,0,2,NULL,4,'2016-10-17 13:55:52','2016-10-17 13:55:52'),
	(9,12,16,0,6,100.00,0,0,2,NULL,4,'2016-10-17 13:56:11','2016-10-17 13:56:11'),
	(10,13,19,0,13,100.00,0,0,2,NULL,4,'2016-10-17 13:56:57','2016-10-17 13:56:57'),
	(11,14,22,0,13,50.00,0,0,2,NULL,4,'2016-10-17 13:57:45','2016-10-17 13:58:31'),
	(12,14,22,0,16,50.00,0,0,2,NULL,4,'2016-10-17 13:58:31','2016-10-17 13:58:31'),
	(13,15,30,0,17,100.00,0,0,2,NULL,4,'2016-10-17 13:59:48','2016-11-03 09:48:50'),
	(15,10,8,0,3,-1.00,36,7,2,NULL,99,'2016-10-17 14:08:23','2016-10-17 14:08:23'),
	(20,10,8,0,3,-4.00,42,7,2,NULL,99,'2016-10-17 14:56:32','2016-10-17 14:56:32'),
	(21,11,11,0,4,-1.00,42,8,2,NULL,99,'2016-10-17 14:56:32','2016-10-17 14:56:32'),
	(22,12,16,0,6,-2.00,42,9,2,NULL,99,'2016-10-17 14:56:32','2016-10-17 14:56:32'),
	(23,13,19,0,13,-1.00,42,10,2,NULL,99,'2016-10-17 14:56:32','2016-10-17 14:56:32'),
	(24,18,41,0,3,50.00,0,0,2,NULL,4,'2016-10-19 10:31:15','2016-10-19 10:31:53'),
	(25,18,41,0,4,450.00,0,0,2,NULL,4,'2016-10-19 10:31:53','2016-10-19 10:31:53'),
	(26,18,41,0,4,150.00,0,0,2,NULL,4,'2016-10-19 10:31:53','2016-10-19 10:31:53'),
	(27,1,43,0,6,90.00,0,0,2,NULL,4,'2016-10-19 10:50:35','2016-11-09 10:28:15'),
	(28,1,43,0,6,100.00,0,0,2,NULL,4,'2016-10-19 10:50:35','2016-10-19 10:50:35'),
	(29,10,8,0,3,-4.00,43,7,2,NULL,99,'2016-10-19 10:51:33','2016-10-19 10:51:33'),
	(30,11,11,0,4,-1.00,43,8,2,NULL,99,'2016-10-19 10:51:33','2016-10-19 10:51:33'),
	(31,12,16,0,6,-2.00,43,9,2,NULL,99,'2016-10-19 10:51:33','2016-10-19 10:51:33'),
	(32,13,19,0,13,-1.00,43,10,2,NULL,99,'2016-10-19 10:51:33','2016-10-19 10:51:33'),
	(33,20,2,0,3,5.00,0,0,2,NULL,4,'2016-10-31 11:45:49','2016-10-31 11:47:28'),
	(34,20,2,0,4,5.00,0,0,2,NULL,4,'2016-10-31 11:46:12','2016-10-31 11:46:12'),
	(35,21,3,0,4,5.00,0,0,6,NULL,4,'2016-10-31 11:46:34','2016-12-06 10:12:48'),
	(36,21,3,0,6,5.00,0,0,6,NULL,4,'2016-10-31 11:46:47','2016-11-14 16:36:35'),
	(37,20,2,0,3,-1.00,40,33,2,5,99,'2016-10-31 11:47:28','2016-10-31 11:47:28'),
	(38,19,1,0,3,-2.00,44,4,6,5,99,'2016-10-31 11:47:28','2016-10-31 11:47:28'),
	(39,20,2,0,3,-1.00,44,33,2,5,99,'2016-10-31 11:47:28','2016-10-31 11:47:28'),
	(44,23,41,0,6,10.00,0,0,2,NULL,4,'2016-10-31 15:47:07','2016-10-31 15:47:07'),
	(45,24,35,0,3,5.00,0,0,2,NULL,4,'2016-10-31 15:47:16','2016-10-31 15:47:24'),
	(46,24,35,0,6,5.00,0,0,2,NULL,4,'2016-10-31 15:47:24','2016-10-31 15:47:24'),
	(48,26,35,0,4,10.00,0,0,2,NULL,4,'2016-10-31 15:47:58','2016-10-31 15:47:58'),
	(49,27,43,0,6,10.00,0,0,2,NULL,4,'2016-10-31 15:48:07','2016-10-31 15:48:07'),
	(54,28,43,0,3,10.00,0,0,2,NULL,4,'2016-11-03 09:34:07','2016-11-01 09:02:03'),
	(75,1,43,0,6,-1.00,52,27,2,8,100,'2016-11-02 10:34:02','2016-11-02 10:34:02'),
	(76,2,35,0,4,-1.00,52,2,2,8,100,'2016-11-02 10:34:02','2016-11-02 10:34:02'),
	(77,1,43,0,6,-1.00,54,27,2,8,100,'2016-11-02 10:34:02','2016-11-02 10:34:02'),
	(78,22,34,0,3,-1.00,54,40,6,8,100,'2016-11-02 10:34:02','2016-11-02 10:34:02'),
	(79,29,34,0,6,10.00,0,0,6,NULL,4,'2016-11-03 09:34:21','2016-12-06 10:12:48'),
	(80,30,35,0,6,5.00,0,0,2,NULL,4,'2016-11-03 09:34:31','2016-11-03 09:34:42'),
	(81,30,35,0,3,5.00,0,0,2,NULL,4,'2016-11-03 09:34:42','2016-11-03 09:34:42'),
	(83,32,4,0,4,5.00,0,0,6,NULL,4,'2016-11-03 09:47:46','2016-12-06 10:12:47'),
	(84,33,30,0,3,5.00,0,0,2,NULL,4,'2016-11-03 09:47:56','2016-11-03 09:47:56'),
	(152,34,1,0,6,4.00,0,0,6,NULL,4,'2016-11-09 10:26:03','2016-12-06 10:12:48'),
	(153,35,4,0,4,1.00,0,0,6,NULL,4,'2016-11-09 10:26:19','2016-11-14 16:36:35'),
	(154,36,3,0,4,1.00,0,0,6,NULL,4,'2016-11-09 10:27:16','2016-11-09 10:27:16'),
	(155,37,34,0,4,2.00,0,0,6,NULL,4,'2016-11-09 10:27:30','2016-11-14 16:36:35'),
	(156,1,43,0,6,-1.00,53,27,2,5,100,'2016-11-09 10:28:15','2016-11-09 10:28:15'),
	(157,2,35,0,3,-1.00,53,1,2,5,100,'2016-11-09 10:28:15','2016-11-09 10:28:15'),
	(173,3,41,0,6,-1.00,57,3,2,8,100,'2016-11-10 11:09:49','2016-11-10 11:09:49'),
	(174,2,35,0,4,-1.00,57,2,2,8,100,'2016-11-10 11:09:49','2016-11-10 11:09:49'),
	(175,40,34,0,4,10.00,0,0,6,NULL,4,'2016-11-10 14:41:53','2016-11-10 14:41:53'),
	(176,41,43,0,3,10.00,0,0,2,NULL,4,'2016-11-10 14:42:17','2016-11-10 14:42:17');

/*!40000 ALTER TABLE `store_product_arrange` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table store_product_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_product_group`;

CREATE TABLE `store_product_group` (
  `storeProductGroupId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplierId` bigint(20) unsigned DEFAULT NULL,
  `poNo` varchar(45) DEFAULT NULL,
  `summary` decimal(15,2) DEFAULT NULL,
  `receiveDate` datetime DEFAULT NULL,
  `receiveBy` bigint(20) DEFAULT NULL,
  `arranger` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeProductGroupId`),
  KEY `fk_spg_to_s_idx` (`supplierId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table store_product_order_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_product_order_item`;

CREATE TABLE `store_product_order_item` (
  `storeProductOrderItemId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orderId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `storeProductId` bigint(20) unsigned DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeProductOrderItemId`),
  KEY `fk_sp_to_p_idx` (`productId`),
  KEY `fk_sp_to_spg0_idx` (`orderId`),
  KEY `fk_spo_to_sp_idx` (`storeProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table store_slot
# ------------------------------------------------------------

DROP TABLE IF EXISTS `store_slot`;

CREATE TABLE `store_slot` (
  `storeSlotId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `storeId` bigint(20) unsigned NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text,
  `width` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `depth` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `maxWeight` decimal(15,2) DEFAULT NULL,
  `parentId` bigint(20) unsigned DEFAULT NULL,
  `level` tinyint(4) NOT NULL,
  `qrCode` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`storeSlotId`),
  KEY `fk_ss_to_s_idx` (`storeId`),
  KEY `fk_ss_to_parent_idx` (`parentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `store_slot` WRITE;
/*!40000 ALTER TABLE `store_slot` DISABLE KEYS */;

INSERT INTO `store_slot` (`storeSlotId`, `storeId`, `barcode`, `code`, `title`, `description`, `width`, `height`, `depth`, `weight`, `maxWeight`, `parentId`, `level`, `qrCode`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,'R1','R1','Row 1','',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,'2016-06-22 08:21:47','2016-09-14 15:54:39'),
	(2,1,'R1C1','C1','Row 1 Column 1','',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,'2016-06-22 08:28:51','2016-09-14 15:52:01'),
	(3,1,'R1C1S1','S1','Row 1 Column 1 Slot 1','',NULL,NULL,NULL,NULL,NULL,2,3,NULL,1,'2016-06-22 08:32:48','2016-09-16 11:20:19'),
	(4,1,'R1C1S2','S2','Row 1 Column 1 Slot 2','',NULL,NULL,NULL,NULL,NULL,2,3,NULL,1,'2016-06-22 08:41:22','2016-09-14 15:59:54'),
	(5,1,'R1C2','C2','Row 1 Column 2','',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,'2016-06-22 08:43:18','2016-09-14 15:55:27'),
	(6,1,'R1C1S3','S3','Row 1 Column 1 Slot 3','',NULL,NULL,NULL,NULL,NULL,2,3,NULL,1,'2016-06-22 08:43:39','2016-09-14 15:55:58'),
	(13,1,'R1C2S1','S1','Row 1 Column 2 Slot 1','',NULL,NULL,NULL,NULL,NULL,5,3,NULL,1,'2016-09-14 11:40:10','2016-09-14 15:55:35'),
	(14,1,'R1C3','C3','Row 1 Column 3','',NULL,NULL,NULL,NULL,NULL,1,2,NULL,1,'2016-09-14 11:49:24','2016-09-14 15:55:30'),
	(16,1,'R1C2S2','S2','Row 1 Column 2 Slot 2','',NULL,NULL,NULL,NULL,NULL,5,3,NULL,1,'2016-09-14 11:52:33','2016-09-14 15:55:37'),
	(17,1,'R1C2S3','S3','Row 1 Column 2 Slot 3','',NULL,NULL,NULL,NULL,NULL,5,3,NULL,1,'2016-09-14 11:52:42','2016-09-14 15:55:40'),
	(18,1,'R1C3S1','S1','Row 1 Column 3 Slot 1','',NULL,NULL,NULL,NULL,NULL,14,3,NULL,1,'2016-09-14 11:53:03','2016-09-14 15:56:09'),
	(19,1,'R1C3S2','S2','Row 1 Column 3 Slot 2','',NULL,NULL,NULL,NULL,NULL,14,3,NULL,1,'2016-09-14 11:53:15','2016-09-14 15:56:12'),
	(20,1,'R1C3S3','S3','Row 1 Column 3 Slot 3','',NULL,NULL,NULL,NULL,NULL,14,3,NULL,1,'2016-09-14 11:53:26','2016-09-14 15:56:18'),
	(21,1,'R2','R2','Row 2','',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,'2016-09-14 12:43:21','2016-09-14 15:54:43'),
	(22,1,'R2C1','C1','Row 2 Column 1','',NULL,NULL,NULL,NULL,NULL,21,2,NULL,1,'2016-09-14 12:43:55','2016-09-14 15:54:52'),
	(23,1,'R2C2','C2','Row 2 Column 2','',NULL,NULL,NULL,NULL,NULL,21,2,NULL,1,'2016-09-14 12:44:06','2016-09-14 15:54:55'),
	(24,1,'R2C3','C3','Row 2 Column 3','',NULL,NULL,NULL,NULL,NULL,21,2,NULL,1,'2016-09-14 12:44:17','2016-09-14 15:54:58'),
	(25,1,'R2C1S1','S1','Row 2 Column 1 Slot 1','',NULL,NULL,NULL,NULL,NULL,22,3,NULL,1,'2016-09-14 12:44:45','2016-09-14 15:55:04'),
	(26,1,'R2C1S2','S2','Row 2 Column 1 Slot 2','',NULL,NULL,NULL,NULL,NULL,22,3,NULL,1,'2016-09-14 12:44:57','2016-09-14 15:55:07'),
	(27,1,'R2C1S3','S3','Row 2 Column 1 Slot 3','',NULL,NULL,NULL,NULL,NULL,22,3,NULL,1,'2016-09-14 12:45:07','2016-09-14 15:55:10'),
	(28,1,'R2C2S1','S1','Row 2 Column 2 Slot 1','',NULL,NULL,NULL,NULL,NULL,23,3,NULL,1,'2016-09-14 12:46:16','2016-09-19 09:54:33'),
	(29,1,'R2C2S2','S2','Row 2 Column 2 Slot 2','',NULL,NULL,NULL,NULL,NULL,23,3,NULL,1,'2016-09-14 12:46:26','2016-09-19 09:54:30'),
	(30,1,'R2C2S3','S3','Row 2 Column 2 Slot 3','',NULL,NULL,NULL,NULL,NULL,23,3,NULL,1,'2016-09-14 12:46:36','2016-09-19 09:54:27'),
	(31,1,'R2C3S1','S1','Row 2 Column 3 Slot 1','',NULL,NULL,NULL,NULL,NULL,24,3,NULL,1,'2016-09-14 12:47:16','2016-09-19 09:56:17'),
	(32,1,'R2C3S2','S2','Row 2 Column 3 Slot 2','',NULL,NULL,NULL,NULL,NULL,24,3,NULL,1,'2016-09-14 12:47:26','2016-09-19 09:56:14'),
	(33,1,'R2C3S3','S3','Row 2 Column 3 Slot 3','',NULL,NULL,NULL,NULL,NULL,24,3,NULL,1,'2016-09-14 12:47:38','2016-09-19 09:56:11'),
	(34,1,'R3','R3','Row 3','',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,'2016-09-14 12:48:12','2016-09-14 15:54:46'),
	(35,1,'R3C1','C1','Row 3 Column 1','',NULL,NULL,NULL,NULL,NULL,34,2,NULL,1,'2016-09-14 12:48:33','2016-09-14 15:54:24'),
	(36,1,'R3C2','C2','Row 3 Column  2','',NULL,NULL,NULL,NULL,NULL,34,2,NULL,1,'2016-09-14 12:48:46','2016-09-14 15:54:29'),
	(37,1,'R3C3','C3','Row 3 Column 3','',NULL,NULL,NULL,NULL,NULL,34,2,NULL,1,'2016-09-14 12:48:53','2016-09-14 15:51:59'),
	(38,1,'R3C1S1','S1','Row 3 Column 1 Slot 1','',NULL,NULL,NULL,NULL,NULL,35,3,NULL,1,'2016-09-14 12:49:24','2016-09-14 15:52:26'),
	(39,1,'R3C1S2','S2','Row 3 Column 1 Slot 2','',NULL,NULL,NULL,NULL,NULL,35,3,NULL,1,'2016-09-14 12:49:33','2016-09-14 15:52:36'),
	(40,1,'R3C1S3','S3','Row 3 Column 1 Slot 3','',NULL,NULL,NULL,NULL,NULL,35,3,NULL,1,'2016-09-14 12:49:43','2016-09-14 15:52:48'),
	(41,1,'R3C2S1','S1','Row 3 Column 2 Slot 1','',NULL,NULL,NULL,NULL,NULL,36,3,NULL,1,'2016-09-14 12:50:03','2016-09-14 15:53:13'),
	(42,1,'R3C2S2','S2','Row 3 Column 2 Slot 2','',NULL,NULL,NULL,NULL,NULL,36,3,NULL,1,'2016-09-14 12:50:12','2016-09-14 15:53:21'),
	(43,1,'R3C2S3','S3','Row 3 Column 2 Slot 3','',NULL,NULL,NULL,NULL,NULL,36,3,NULL,1,'2016-09-14 12:50:21','2016-09-14 15:53:29'),
	(44,1,'R3C3S1','S1','Row 3 Column 2 Slot 1','',NULL,NULL,NULL,NULL,NULL,37,3,NULL,1,'2016-09-14 12:51:53','2016-09-14 15:54:00'),
	(45,1,'R3C3S2','S2','Row 3 Column 2 Slot 2','',NULL,NULL,NULL,NULL,NULL,37,3,NULL,1,'2016-09-14 12:52:02','2016-09-14 15:54:08'),
	(46,1,'R3C3S3','S3','Row 3 Column 2 Slot 3','',NULL,NULL,NULL,NULL,NULL,37,3,NULL,1,'2016-09-14 12:52:11','2016-09-14 15:54:15'),
	(47,1,'R2C1S4','S4','Row 2 Column 1 Slot 4','',NULL,NULL,NULL,NULL,NULL,22,3,NULL,1,'2016-09-19 07:50:42','2016-09-19 07:50:52');

/*!40000 ALTER TABLE `store_slot` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `supplierId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` text,
  `taxId` bigint(20) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;

INSERT INTO `supplier` (`supplierId`, `name`, `address`, `taxId`, `tel`, `email`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'K of World','',NULL,NULL,NULL,'',1,'2016-09-26 09:21:51','2016-10-14 09:28:57'),
	(2,'AABC','<p>123</p>',NULL,NULL,NULL,'<p>เทสสสส</p>',1,'2016-09-27 08:41:43','2016-10-14 09:29:10');

/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supplier_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier_product`;

CREATE TABLE `supplier_product` (
  `supplierProductId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplierId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) unsigned NOT NULL,
  `leaseTime` int(11) NOT NULL,
  `maxQuantity` decimal(15,2) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplierProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `supplier_product` WRITE;
/*!40000 ALTER TABLE `supplier_product` DISABLE KEYS */;

INSERT INTO `supplier_product` (`supplierProductId`, `supplierId`, `productId`, `leaseTime`, `maxQuantity`, `price`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,1,1,7,10.00,1000.00,1,'2016-11-02 13:59:23','2016-11-06 17:33:07'),
	(2,1,8,5,5.00,500.00,1,'2016-11-02 14:25:49','2016-11-06 19:22:36'),
	(3,1,30,5,5.00,350.00,1,'2016-11-02 14:26:59','2016-11-06 19:25:35'),
	(4,1,43,5,5.00,3300.00,1,'2016-11-02 14:43:43','2016-11-06 19:19:39'),
	(5,2,43,5,5.00,3200.00,1,'2016-11-02 14:45:36','2016-11-06 19:19:53'),
	(6,2,8,5,5.00,550.00,1,'2016-11-02 14:46:04','2016-11-06 19:22:27'),
	(7,2,1,5,5.00,1100.00,1,'2016-11-02 14:46:16','2016-11-06 17:33:29'),
	(8,2,30,5,5.00,300.00,1,'2016-11-02 14:46:45','2016-11-06 19:25:58'),
	(9,1,2,5,5.00,500.00,1,'2016-11-02 14:46:54','2016-11-06 19:27:09'),
	(10,2,2,5,5.00,500.00,1,'2016-11-02 14:47:03','2016-11-06 19:27:18'),
	(11,1,3,5,5.00,800.00,1,'2016-11-06 19:55:20','2016-11-06 19:55:20'),
	(12,1,4,5,5.00,800.00,1,'2016-11-06 19:57:11','2016-11-06 19:57:11'),
	(13,1,5,5,5.00,599.00,1,'2016-11-06 19:57:44','2016-11-06 19:57:44'),
	(14,1,7,5,5.00,800.00,1,'2016-11-06 19:59:10','2016-11-06 19:59:10'),
	(15,1,11,5,5.00,7500.00,1,'2016-11-06 20:00:11','2016-11-06 20:01:37'),
	(16,1,16,5,5.00,1500.00,1,'2016-11-06 20:01:12','2016-11-06 20:01:12'),
	(17,1,32,5,5.00,1500.00,1,'2016-11-06 20:01:12','2016-11-06 20:02:57'),
	(18,1,34,5,5.00,2500.00,1,'2016-11-06 20:04:31','2016-11-06 20:04:31'),
	(19,1,35,5,5.00,2300.00,1,'2016-11-06 20:05:30','2016-11-06 20:05:30'),
	(20,1,39,5,5.00,1800.00,1,'2016-11-06 20:06:40','2016-11-06 20:06:40'),
	(21,1,37,5,5.00,1100.00,1,'2016-11-06 20:10:20','2016-11-06 20:10:20'),
	(22,1,36,5,5.00,1100.00,1,'2016-11-06 20:11:23','2016-11-06 20:11:23');

/*!40000 ALTER TABLE `supplier_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table unit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit` (
  `unitId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`unitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;

INSERT INTO `unit` (`unitId`, `title`, `description`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,'ฟอง','',1,'2016-06-22 12:53:53','2016-06-22 12:53:53'),
	(2,'ใบ','',1,'2016-06-22 12:53:58','2016-06-22 12:53:58'),
	(3,'แพ็ค','',1,'2016-06-22 12:54:09','2016-06-22 12:54:09'),
	(4,'กล่อง','',1,'2016-06-22 12:54:15','2016-06-22 12:54:15');

/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table update_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `update_price`;

CREATE TABLE `update_price` (
  `updatePriceId` bigint(20) NOT NULL AUTO_INCREMENT,
  `productPriceOtherWebId` bigint(20) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `status` tinyint(5) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`updatePriceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `userId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password_hash` text,
  `firstname` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `token` text,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 : frontend\n2 : backend\n3 : frontend and backend\n4 : suppliers',
  `auth_key` text,
  `auth_type` varchar(45) DEFAULT NULL,
  `birthDate` datetime DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1  = ''Male'',\n 0 = ''Female''',
  `tel` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `code` varchar(45) DEFAULT NULL COMMENT 'ใช้กับ Suppliers',
  `passportNo` varchar(100) DEFAULT NULL,
  `passportImage` varchar(255) DEFAULT NULL,
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisitDate` datetime DEFAULT '0000-00-00 00:00:00',
  `user_group_Id` varchar(200) NOT NULL DEFAULT '[]' COMMENT 'User Group \nสิทธิ์เข้าใช้เมนู',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`userId`, `username`, `password_hash`, `firstname`, `password`, `lastname`, `email`, `token`, `type`, `auth_key`, `auth_type`, `birthDate`, `gender`, `tel`, `status`, `code`, `passportNo`, `passportImage`, `createDateTime`, `updateDateTime`, `lastvisitDate`, `user_group_Id`)
VALUES
	(1,'taninut.b@daiigroup.com','$2y$13$bUjr2uJ02ggOdQG2QuU5feZqeRb5VI0Pt69v6pS585typyqp56yCK','Pew','1234','Daiigroup','taninut.b@daiigroup.com','Rj82FpPK3D',3,NULL,NULL,'2016-10-11 00:00:00',0,'0616539889',1,NULL,NULL,NULL,'2016-09-02 08:08:09','2016-11-18 15:44:45','2017-01-12 09:34:32','[26,31,34]'),
	(2,'kamyjap@gmail.com','$2y$13$SSGsM.kCvri0yyhZry5vse1pHq37fIzYXj7qrEWNvYOoK8WhVdSqa','กมล','1234','พวงเกษม','kamyjap@gmail.com','8YEeShnnm9',3,NULL,NULL,'2016-02-11 00:00:00',NULL,NULL,1,NULL,NULL,NULL,'2016-09-27 09:10:06','2016-09-27 09:10:06','2017-01-10 15:25:27','[31]'),
	(3,'phamsaksom@gmail.com','$2y$13$cTgmlHTO0wkSnri.iFZAm.u9d.eQRSggQQWUVF0L8ocOOkLwG05xW','pornphun','pla12410','phamsaksom','phamsaksom@gmail.com','5Vj8ojTEf7',1,NULL,NULL,'2016-03-11 00:00:00',NULL,NULL,1,NULL,NULL,NULL,'2016-09-28 08:50:57','2016-11-08 15:00:19','0000-00-00 00:00:00','[35]'),
	(4,'chadakorn.k@daiigroup.com','$2y$13$01BB.JnuFT5cKzRht5eqzOCygJmTc6uoZInXmK8mrz3qFii5hPctq','chadakorn','jojoeckchadakorn','chadakorn','chadakorn.k@daiigroup.com','FH2HGO_xg-',1,NULL,NULL,'2016-04-11 00:00:00',NULL,NULL,1,NULL,NULL,NULL,'2016-09-29 11:18:21','2016-09-29 11:18:21','0000-00-00 00:00:00','[]'),
	(5,'prasert.s@daiigroup.com','$2y$13$ckUf7SlbvqkKB4fz4Zhcs.jhRWOi/kw8lD9Tzq3nQ.VhWmcjBcKLm','ประเสริฐ','12345','ศาสตร์ภักดี','prasert.s@daiigroup.com','9qJ0myG_ZH',3,NULL,NULL,'2016-12-20 00:00:00',1,'0846059677',1,NULL,NULL,NULL,'2016-09-30 14:48:42','2016-11-08 14:59:00','2017-01-06 13:09:52','[31]'),
	(6,'kurtumm@gmail.com','$2y$13$LMBMjP2dLqPYTMFU85DCquRiNU95LJSzhpXmU..LDC8JeSEU8TgZm','Nattawoot','Kt1234','Peanpunyaruk','kurtumm@gmail.com','hb02PHI2BT',3,NULL,NULL,'2016-05-11 00:00:00',NULL,NULL,1,NULL,NULL,NULL,'2016-10-03 08:42:58','2016-10-03 08:42:58','2017-01-09 10:43:34','[31]'),
	(7,'sukanya.n@daiigroup.com','$2y$13$fmDOuEY/4NGvKPcAHjdbv.kz.ihh9HZ13EGZTWoUT8coyIZ1AJeaK','sukanya','pppppppp','n','sukanya.n@daiigroup.com','pSAbBRJBOi',1,NULL,'','2016-07-11 00:00:00',NULL,NULL,0,NULL,NULL,NULL,'2016-10-05 09:31:18','2016-10-05 09:31:18','0000-00-00 00:00:00','[]'),
	(8,'saknakhngam@hotmail.com','$2y$13$upwqRutroBx4YrcCOk0k9uZ2n/WesfIl86BkQcFXHi.lL5CdF2E56','สุรศักดิ์','10202063180338156','นาคงาม','saknakhngam@hotmail.com','oz5v5Zo7AW',3,'$2y$13$upwqRutroBx4YrcCOk0k9uZ2n/WesfIl86BkQcFXHi.lL5CdF2E56','google,facebook','2016-01-05 00:00:00',NULL,NULL,1,NULL,NULL,NULL,'2016-08-30 13:19:50','2016-08-30 13:19:50','2017-01-09 08:23:10','[31]'),
	(9,'p1@gmail.com','$2y$13$bUjr2uJ02ggOdQG2QuU5feZqeRb5VI0Pt69v6pS585typyqp56yCK','ธนินัช','4711210099',NULL,'sodapew17@gmail.com','tx9O2CEwFS',4,NULL,'','2016-08-11 00:00:00',NULL,NULL,1,'SUB-0001',NULL,'/images/passport/nqFprrWLsE1TjiGTVqq93Ea1TqwsY_m4.jpg','2016-11-09 10:53:31','2017-01-09 12:13:04','2017-01-11 11:10:20','[35]'),
	(10,'p2@hotmail.com','$2y$13$AhjDNVR1r5npHszMp/keg.8N0twX6LvmA28QgmlVeMHl5m5UgKUrS','Deadpool','1234','comics','piew-17@hotmail.com','N6NFewFi8f',4,NULL,'Backend',NULL,0,NULL,1,'SUB-0002',NULL,NULL,'2016-12-01 13:33:07','2016-12-01 13:33:07','2017-01-11 11:08:59','[]'),
	(11,'p3@cozxy.com','$2y$13$AhjDNVR1r5npHszMp/keg.8N0twX6LvmA28QgmlVeMHl5m5UgKUrS','cozxy','1234','cozxy','taninut.b@cozxy.com','N6NFewFi8f',4,NULL,'Backend',NULL,0,NULL,1,'SUB-0003',NULL,NULL,'2016-12-01 13:33:07','2016-12-01 13:33:07','2017-01-11 11:09:30','[]'),
	(12,'p4@indigojp.com','$2y$13$AhjDNVR1r5npHszMp/keg.8N0twX6LvmA28QgmlVeMHl5m5UgKUrS','indigo','1234','jp','taninut.b@cozxy.com','N6NFewFi8f',4,NULL,'Backend',NULL,0,NULL,1,'SUB-0004',NULL,NULL,'2016-12-01 13:33:07','2016-12-01 13:33:07','2017-01-11 11:09:48','[]');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `user_group_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_group_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;

INSERT INTO `user_groups` (`user_group_Id`, `name`, `parent_id`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(25,'Cozxy',0,1,'2016-11-04 09:51:51','2016-11-04 08:54:06'),
	(26,'Manager',25,1,'2016-11-04 09:59:08','2016-11-04 02:59:08'),
	(31,'Administrator',26,1,'2016-11-04 14:13:28','2016-11-04 07:13:28'),
	(32,'Shipping',31,1,'2016-11-04 14:13:44','2016-11-04 07:13:44'),
	(33,'Lockers',31,1,'2016-11-04 14:13:57','2016-11-04 07:13:57'),
	(34,'Super Administrator',26,1,'2016-11-04 15:51:45','2016-11-04 08:51:45'),
	(35,'Service',25,1,'2016-11-04 15:54:49','2016-11-04 08:54:49');

/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_visit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_visit`;

CREATE TABLE `user_visit` (
  `visitId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisitDate` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`visitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_visit` WRITE;
/*!40000 ALTER TABLE `user_visit` DISABLE KEYS */;

INSERT INTO `user_visit` (`visitId`, `userId`, `status`, `createDateTime`, `updateDateTime`, `lastvisitDate`)
VALUES
	(1,1,1,'0000-00-00 00:00:00','2016-11-09 08:35:48','2016-11-09 15:35:48'),
	(2,1,1,'0000-00-00 00:00:00','2016-11-09 08:36:04','2016-11-09 15:36:04'),
	(3,1,1,'0000-00-00 00:00:00','2016-11-09 15:44:41','2016-11-09 15:44:41'),
	(4,8,1,'0000-00-00 00:00:00','2016-11-11 14:01:14','2016-11-11 14:01:14'),
	(5,5,1,'0000-00-00 00:00:00','2016-11-14 14:46:45','2016-11-14 14:46:45'),
	(6,1,1,'0000-00-00 00:00:00','2016-11-17 12:54:05','2016-11-17 12:54:05'),
	(7,1,1,'0000-00-00 00:00:00','2016-11-21 11:13:10','2016-11-21 11:13:10'),
	(8,2,1,'0000-00-00 00:00:00','2016-12-13 11:02:28','2016-12-13 11:02:28'),
	(9,2,1,'0000-00-00 00:00:00','2016-12-13 11:56:36','2016-12-13 11:56:36'),
	(10,5,1,'0000-00-00 00:00:00','2016-12-13 14:31:05','2016-12-13 14:31:05'),
	(11,5,1,'0000-00-00 00:00:00','2016-12-14 09:58:27','2016-12-14 09:58:27'),
	(12,8,1,'0000-00-00 00:00:00','2016-12-14 10:22:39','2016-12-14 10:22:39'),
	(13,8,1,'0000-00-00 00:00:00','2016-12-15 08:37:05','2016-12-15 08:37:05'),
	(14,9,1,'0000-00-00 00:00:00','2016-12-23 10:14:41','2016-12-23 10:14:41'),
	(15,8,1,'0000-00-00 00:00:00','2016-12-23 14:23:22','2016-12-23 14:23:22'),
	(16,5,1,'0000-00-00 00:00:00','2016-12-23 14:31:25','2016-12-23 14:31:25'),
	(17,5,1,'0000-00-00 00:00:00','2016-12-23 14:34:18','2016-12-23 14:34:18'),
	(18,5,1,'0000-00-00 00:00:00','2016-12-23 14:37:18','2016-12-23 14:37:18'),
	(19,5,1,'0000-00-00 00:00:00','2016-12-23 14:50:36','2016-12-23 14:50:36'),
	(20,1,1,'0000-00-00 00:00:00','2016-12-23 14:53:44','2016-12-23 14:53:44'),
	(21,5,1,'0000-00-00 00:00:00','2016-12-23 14:58:45','2016-12-23 14:58:45'),
	(22,1,1,'0000-00-00 00:00:00','2016-12-23 14:59:03','2016-12-23 14:59:03'),
	(23,1,1,'0000-00-00 00:00:00','2016-12-23 15:01:46','2016-12-23 15:01:46'),
	(24,1,1,'0000-00-00 00:00:00','2016-12-23 15:02:29','2016-12-23 15:02:29'),
	(25,1,1,'0000-00-00 00:00:00','2016-12-26 10:27:11','2016-12-26 10:27:11'),
	(26,5,1,'0000-00-00 00:00:00','2016-12-26 15:00:19','2016-12-26 15:00:19'),
	(27,5,1,'0000-00-00 00:00:00','2016-12-26 15:01:25','2016-12-26 15:01:25'),
	(28,5,1,'0000-00-00 00:00:00','2017-01-04 09:24:35','2017-01-04 09:24:35'),
	(29,8,1,'0000-00-00 00:00:00','2017-01-09 08:23:10','2017-01-09 08:23:10'),
	(30,1,1,'0000-00-00 00:00:00','2017-01-09 13:37:03','2017-01-09 13:37:03'),
	(31,1,1,'0000-00-00 00:00:00','2017-01-09 14:16:03','2017-01-09 14:16:03'),
	(32,1,1,'0000-00-00 00:00:00','2017-01-10 08:37:00','2017-01-10 08:37:00'),
	(33,1,1,'0000-00-00 00:00:00','2017-01-10 15:44:15','2017-01-10 15:44:15'),
	(34,1,1,'0000-00-00 00:00:00','2017-01-12 09:34:32','2017-01-12 09:34:32');

/*!40000 ALTER TABLE `user_visit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table view_levels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `view_levels`;

CREATE TABLE `view_levels` (
  `viewLevelsId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `desc` varchar(200) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(200) NOT NULL DEFAULT '[]' COMMENT 'JSON encoded access control.',
  `status` tinyint(4) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`viewLevelsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `view_levels` WRITE;
/*!40000 ALTER TABLE `view_levels` DISABLE KEYS */;

INSERT INTO `view_levels` (`viewLevelsId`, `title`, `desc`, `ordering`, `rules`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(13,'Public','ทุกคนสามารถเปิดดูได้',0,'[25]',1,'2016-11-04 10:04:21','2016-11-07 05:47:27'),
	(14,'Registered','เฉพาะผู้ที่ผ่านการ Log in เข้าระบบสมาชิกจึงจะสามารถเปิดดูได้',0,'[]',1,'2016-11-04 10:08:40','2016-11-04 08:41:03'),
	(15,'Special','สำหรับผู้ที่อยู่กลุ่มพิเศษ(กลุ่มที่แก้ไขข้อมูลได้)เท่านั้นที่เปิดดูได้',0,'[]',1,'2016-11-04 10:10:06','2016-11-04 08:41:21');

/*!40000 ALTER TABLE `view_levels` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table web
# ------------------------------------------------------------

DROP TABLE IF EXISTS `web`;

CREATE TABLE `web` (
  `webId` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `status` tinyint(5) DEFAULT '1',
  `createDateTime` datetime DEFAULT NULL,
  `updateDateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`webId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table wishlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `wishlistId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `productId` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createDateTime` datetime NOT NULL,
  `updateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wishlistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;

INSERT INTO `wishlist` (`wishlistId`, `userId`, `productId`, `status`, `createDateTime`, `updateDateTime`)
VALUES
	(1,3,2,1,'2016-09-28 09:07:33','2016-09-28 09:07:33'),
	(2,5,4,1,'2016-10-21 09:16:44','2016-10-21 09:16:44'),
	(3,5,43,1,'2016-10-21 09:17:00','2016-10-21 09:17:00'),
	(4,5,41,1,'2016-10-21 09:17:10','2016-10-21 09:17:10'),
	(5,1,2,1,'2016-10-21 13:29:15','2016-10-21 13:29:15'),
	(6,5,86,1,'2016-12-28 13:59:14','2016-12-28 13:59:14');

/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
