/*
SQLyog Ultimate v9.02 
MySQL - 5.5.25 : Database - shop_st
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`shop_st` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `shop_st`;

/*Table structure for table `st_category` */

DROP TABLE IF EXISTS `st_category`;

CREATE TABLE `st_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_category` */

/*Table structure for table `st_items` */

DROP TABLE IF EXISTS `st_items`;

CREATE TABLE `st_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idOrder` int(10) unsigned NOT NULL,
  `idProduct` int(10) unsigned NOT NULL,
  `numProduct` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order2product_product` (`idProduct`),
  KEY `order2product_order` (`idOrder`),
  CONSTRAINT `order2product_order` FOREIGN KEY (`idOrder`) REFERENCES `st_orders` (`id`),
  CONSTRAINT `order2product_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_items` */

/*Table structure for table `st_orders` */

DROP TABLE IF EXISTS `st_orders`;

CREATE TABLE `st_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `idItems` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `oreder2item` (`idItems`),
  KEY `oreder2user` (`idUser`),
  CONSTRAINT `oreder2user` FOREIGN KEY (`idUser`) REFERENCES `st_users` (`id`),
  CONSTRAINT `oreder2item` FOREIGN KEY (`idItems`) REFERENCES `st_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_orders` */

/*Table structure for table `st_product2property` */

DROP TABLE IF EXISTS `st_product2property`;

CREATE TABLE `st_product2property` (
  `idProduct` int(10) unsigned NOT NULL,
  `idProperty` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  KEY `product2property_product` (`idProduct`),
  KEY `product2property_property` (`idProperty`),
  CONSTRAINT `product2property_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`),
  CONSTRAINT `product2property_property` FOREIGN KEY (`idProperty`) REFERENCES `st_properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_product2property` */

/*Table structure for table `st_products` */

DROP TABLE IF EXISTS `st_products`;

CREATE TABLE `st_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float DEFAULT NULL,
  `idCategory` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product2category` (`idCategory`),
  CONSTRAINT `product2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_products` */

/*Table structure for table `st_properties` */

DROP TABLE IF EXISTS `st_properties`;

CREATE TABLE `st_properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property` varchar(255) NOT NULL,
  `idCategory` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property2category` (`idCategory`),
  CONSTRAINT `property2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_properties` */

/*Table structure for table `st_users` */

DROP TABLE IF EXISTS `st_users`;

CREATE TABLE `st_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
