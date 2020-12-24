/*
SQLyog Enterprise v10.42 
MySQL - 5.5.20-log : Database - photogallery
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_album` */

DROP TABLE IF EXISTS `tbl_album`;

CREATE TABLE `tbl_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `shareable` tinyint(3) DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `tbl_album_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_album` */

insert  into `tbl_album`(`id`,`name`,`tags`,`owner_id`,`shareable`,`created_dt`) values (1,'Beaches',NULL,2,1,'2013-02-15 12:43:39');

/*Table structure for table `tbl_comment` */

DROP TABLE IF EXISTS `tbl_comment`;

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `created_dt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_photo_comment` (`photo_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `FK_photo_comment` FOREIGN KEY (`photo_id`) REFERENCES `tbl_photo` (`id`),
  CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_comment` */

insert  into `tbl_comment`(`id`,`content`,`status`,`author_id`,`photo_id`,`created_dt`) values (1,'This is a test comment.',2,2,2,'0000-00-00 00:00:00');

/*Table structure for table `tbl_option` */

DROP TABLE IF EXISTS `tbl_option`;

CREATE TABLE `tbl_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL,
  `option_value` varchar(20) NOT NULL,
  `sort_order` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameidx` (`option_name`,`option_value`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_option` */

insert  into `tbl_option`(`id`,`option_name`,`option_value`,`sort_order`) values (1,'PAGESIZE','50',NULL),(2,'PAGE','500',NULL);

/*Table structure for table `tbl_photo` */

DROP TABLE IF EXISTS `tbl_photo`;

CREATE TABLE `tbl_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `caption` text,
  `alt_text` text,
  `tags` varchar(256) DEFAULT NULL,
  `sort_order` smallint(6) DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate_dt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `tbl_photo_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `tbl_album` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_photo` */

insert  into `tbl_photo`(`id`,`album_id`,`filename`,`caption`,`alt_text`,`tags`,`sort_order`,`created_dt`,`lastupdate_dt`) values (1,1,'IMG_1134.jpg','Pebbles through clear water','',NULL,1,'2013-02-05 12:27:53','2013-02-05 12:27:53'),(2,1,'IMG_1152.jpg','Going with the flow','',NULL,2,'2013-02-05 12:25:27','2013-02-05 12:27:53'),(3,1,'IMG_1289.jpg','Calm after the storm',NULL,NULL,3,'2013-02-04 14:26:35','2013-02-05 12:27:53'),(4,1,'IMG_1291.jpg','Peaceful evening on the beach',NULL,NULL,4,'2013-02-05 11:28:47','2013-02-05 12:27:53'),(5,1,'IMG_1331.jpg','Sand Waves',NULL,NULL,5,'2013-02-05 10:15:55','2013-02-05 12:27:53'),(6,1,'IMG_9609.jpg','Rippled sand','',NULL,6,'2013-01-30 01:29:05','2013-02-05 12:27:53');

/*Table structure for table `tbl_tag` */

DROP TABLE IF EXISTS `tbl_tag`;

CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tbl_tag` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `url` varchar(256) DEFAULT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`email`,`url`,`firstname`,`lastname`,`password`,`status`,`last_login_time`,`create_date`) values (2,'admin@photogallery.lan',NULL,'Admin','Root','c7275c106bbcf51180fa445ebde5a405',1,'2013-01-14 15:07:05','2013-01-14 15:06:55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
