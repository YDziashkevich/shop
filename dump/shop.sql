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
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `folder` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `st_category` */

insert  into `st_category`(`id`,`name`,`description`,`img`,`folder`) values (1,'Процессоры','Центра́льный проце́ссор (ЦП; также центральное процессорное устройство — ЦПУ; англ. central processing unit, CPU, дословно — центральное обрабатывающее устройство)','img/','processors '),(3,'Видеокарты','Видеока́рта (также видео ка́рта, видеоада́птер, графический ада́птер, графи́ческая пла́та, графи́ческая ка́рта, графи́ческий ускори́тель, 3D-ка́рта)  — электронное устройство, преобразующее графический образ, хранящийся как содержимое памяти компьютера (или самого адаптера), в форму, пригодную для дальнейшего вывода на экран монитора. Первые мониторы, построенные на электронно-лучевых трубках, работали по телевизионному принципу сканирования экрана электронным лучом, и для отображения требовался видеосигнал, генерируемый видеокартой.','videokart/videokart.jpg','video'),(4,'Жесткие диски','Накопи́тель на жёстких магни́тных ди́сках или НЖМД (англ. hard (magnetic) disk drive, HDD, HMDD), жёсткий диск, в компьютерном сленге «винче́стер» — запоминающее устройство (устройство хранения информации) произвольного доступа, основанное на принципе магнитной записи. Является основным накопителем данных в большинстве компьютеров.','hdd/hdd.jpg','hdd'),(5,'Системы охлаждения','','cooller/cooller.jpg','cooling'),(6,'Материнские платы','Материнская плата (англ. motherboard, MB; также mainboard, сленг. мама, мать, материнка) — сложная многослойная печатная плата, являющаяся основой построения вычислительной системы (компьютера).','mb/mb.jpg','motherboard '),(7,'Оперативная память','Операти́вная па́мять (англ. Random Access Memory, RAM, память с произвольным доступом; ОЗУ; комп. жарг. память, оперативка) — энергозависимая часть системы компьютерной памяти, в которой временно хранятся входные, выходные и промежуточные данные программы процессора. Наиболее распространенные типы DIMM и SIMM.','ram/ram.jpg','ram'),(8,'Корпуса','','body/body.jpg','housing'),(9,'Блоки питания','','powerSupply/powerSupply.jpg','power'),(10,'23423','234234234234234234234','img/1409861990.0513L98BABlwzYw.jpg','1'),(11,'5555555555','55555555555555555555555555','img//1409863695.78911.jpg','2');

/*Table structure for table `st_contacts` */

DROP TABLE IF EXISTS `st_contacts`;

CREATE TABLE `st_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `topic` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `st_contacts` */

insert  into `st_contacts`(`id`,`name`,`email`,`topic`,`message`,`time`) values (1,'asf sd','anya.sergey@yandex.by','asdf asda sdf asdf','a sdfas dfasd fasdf asdf','2014-08-19 14:06:16'),(2,'Сергей','serge@serge.ru','Тест формы','тестовое сообщение для формы....','2014-08-19 14:07:10');

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

/*Table structure for table `st_messages` */

DROP TABLE IF EXISTS `st_messages`;

CREATE TABLE `st_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `st_messages` */

insert  into `st_messages`(`id`,`name`,`email`,`message`,`time`) values (1,'Андрей','andry@mail.ru','Привет, как дела?','2014-09-03 09:04:53'),(2,'Пример текста','sdfsdf@fsdf.ff','Пример текстаПример текстаПример текстаПример текста','2014-09-03 09:42:07'),(3,'Пример текста','sf@fs.rl','Пример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текстаПример текста','2014-09-03 09:43:17'),(4,'sajf dlkjasd','sdfsdf@fsdf.ff','l;kjds ;lakfjs ;laskd f;alsdkf','2014-09-03 09:44:54'),(5,'asdf asdf adsf','sdfsdf@fsdf.ff','kla jd;flkaj ;sldkj a;sldfjas;dl kjas;dfl kjasdf;akl sd;alsdja;sdlk','2014-09-03 09:45:42'),(6,'qqqqq','qwerty@mail.ru','qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq qqqqqqqqqqqqqqqqq q q','2014-09-03 09:47:13'),(7,'qwer','qwerty@mail.ru','qwer qwer qwer qwr qw r qwer qwe qwer qwe qew qwr wre','2014-09-03 09:47:31');

/*Table structure for table `st_orders` */

DROP TABLE IF EXISTS `st_orders`;

CREATE TABLE `st_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oreder2user` (`idUser`),
  CONSTRAINT `oreder2user` FOREIGN KEY (`idUser`) REFERENCES `st_users` (`id`)
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
  CONSTRAINT `product2property_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product2property_property` FOREIGN KEY (`idProperty`) REFERENCES `st_properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_product2property` */

insert  into `st_product2property`(`idProduct`,`idProperty`,`value`) values (1,1,'3000'),(1,2,'2'),(1,3,'6'),(2,1,'5000'),(2,2,'6'),(2,3,'10'),(3,1,'2500'),(3,2,'3'),(3,3,'2'),(7,4,'400'),(7,5,'1024'),(8,4,'300'),(8,5,'512'),(10,4,'500'),(10,5,'1024'),(12,6,'hdd'),(12,7,'1024'),(12,8,'24'),(14,6,'hdd'),(14,7,'512'),(14,8,'6'),(13,6,'ssd'),(13,7,'512'),(13,8,'10'),(15,9,'LGA775, LGA1366, LGA1150, LGA1155, LGA1156, AM2, AM2+, AM3, AM3+, FM1, FM2'),(15,10,'21 dBA '),(16,9,'LGA775, LGA1366, LGA1155, LGA1156, AM2, AM2+, AM3'),(16,10,'19.8 dBA '),(17,9,''),(17,10,'20.5 dBA '),(18,11,'Intel \r\n'),(18,9,' LGA1366'),(20,11,'AMD '),(20,9,'AM3 '),(21,11,'Intel '),(21,9,'LGA1155 '),(22,7,'1024'),(22,1,'100'),(23,7,'512'),(23,1,'200'),(24,7,'2048'),(24,1,'300'),(25,12,'mini-ATX '),(25,13,'top'),(26,12,''),(26,13,''),(28,12,''),(28,13,'bottom'),(29,14,'500'),(30,14,''),(32,14,'750'),(36,1,''),(36,2,''),(36,3,''),(37,1,''),(37,2,''),(37,3,''),(38,1,''),(38,2,''),(38,3,''),(39,1,''),(39,2,''),(39,3,''),(40,12,''),(40,13,''),(41,1,''),(41,2,''),(41,3,'');

/*Table structure for table `st_products` */

DROP TABLE IF EXISTS `st_products`;

CREATE TABLE `st_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float DEFAULT NULL,
  `idCategory` int(10) unsigned NOT NULL,
  `img` varchar(255) NOT NULL,
  `delite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product2category` (`idCategory`),
  CONSTRAINT `product2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `st_products` */

insert  into `st_products`(`id`,`name`,`description`,`price`,`idCategory`,`img`,`delite`) values (1,'Intel Core i5-4570','2013 г. (Q2) Core i5 Haswell ',5,1,'img/1/1409864126.0351',NULL),(2,'Intel Core i7-4790K','2014 г. (Q2) Core i7 Devil\'s Canyon LGA1150 ',7,1,'cpu/i7.jpg',NULL),(3,'AMD A8-6600K','2013 г. (Q2) A8  Richland  FM2 ',4,1,'cpu/a8.jpg',NULL),(7,'MSI GeForce GTX 760','2013 г.  PCI Express x16 3.0  NVIDIA GeForce GTX 760 ',10,3,'videokart/gtx750ti.jpg',NULL),(8,'ASUS GeForce GTX 650 Ti','2012 г. PCI Express x16 3.0 NVIDIA GeForce GTX 650 Ti \r\n ',8,3,'videokart/gtx760oc.jpg',NULL),(10,'ASUS GeForce GTX 750 Ti','2014 г. \r\nPCI Express x16 3.0 NVIDIA GeForce GTX 750 Ti ',6,3,'videokart/gtx650.jpg',NULL),(12,'Seagate Enterprise Capacity 6TB','2014 г. \r\n',2,4,'hdd/enterprise.jpg',NULL),(13,'SSD Silicon-Power Extreme','2012 г. \r\n',3,4,'hdd/ssdSiliconPower.jpg',NULL),(14,'Seagate Barracuda 7200.14 1TB','2011 г. ',4,4,'hdd/seagateBarracuda.jpg',NULL),(15,'Thermalright HR-02 Macho','для процессора  воздушное ',1,5,'cooller/noctua.jpg',NULL),(16,'Noctua NH-D14','для процессора воздушное ',2,5,'cooller/thermalright.jpg',NULL),(17,'Xilence RedWing COO-XPF120.R','для корпуса воздушное ',1,5,'cooller/xilence.jpg',NULL),(18,'ASUS Rampage IV Extreme','2011 г. ',3,6,'mb/rampage.jpg',NULL),(20,'BIOSTAR N68S3B Ver. 6.x','',2,6,'mb/biostar.jpg',NULL),(21,'ASUS P8Z77-V LX','2012 г. ',4,6,'mb/p8z77.jpg',NULL),(22,'Hynix DDR2 PC2-6400 2 Гб','',2,7,'ram/hynix.jpg',NULL),(23,'Kingston HyperX Genesis','',3,7,'ram/kingston.jpg',NULL),(24,'Corsair Vengeance Blue 2x4GB','',3,7,'ram/corsair.jpg',NULL),(25,'Zalman Z11 plus Black','',5,8,'body/zalman.jpg',NULL),(26,'In Win GT1 BWR145 Black','',7,8,'body/bwr145.jpg',NULL),(28,'Cooler Master Elite 110','',8,8,'body/masterElite.jpg',NULL),(29,'Zalman ZM500-LE 500W','',5,9,'powerSupply/zalman.jpg',NULL),(30,'Chieftec Navitas GPM-850C','',5,9,'powerSupply/750c.jpg',NULL),(32,'Chieftec A-135 APS-750CB','',7,9,'powerSupply/750.jpg',NULL),(33,'ASUS GeForce GTX TITAN Z 12GB GDDR5','2014 г. PCI Express x16 3.0 ',20,3,'videokart/GeForceGtxTITAN.jpg',NULL),(34,'Palit GeForce GTX 760 JETSTREAM 4GB GDDR5','2013 г PCI Express x16 3.0 ',10,3,'videokart/GTX760.jpg',NULL),(36,'22222222222','22222222',22222,1,'img/0.91924500 14098585971.jpg',NULL),(37,'qwe','qwe',123,1,'img/1409859161.43381.jpg',NULL),(38,'qqqqqqqqqqq','',0,1,'img/1/1409864202.3553',NULL),(39,'sssssssssss','',0,1,'img/1/1409865592.7953',NULL),(40,'23423','234',234,8,'img/8/1409864057.6687L98BABlwzYw.jpg',NULL),(41,'2','2',2,1,'img/1/1409869224.6298PDO-Cheat-Sheet-SQL-SRV.png',NULL);

/*Table structure for table `st_properties` */

DROP TABLE IF EXISTS `st_properties`;

CREATE TABLE `st_properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property` varchar(255) NOT NULL,
  `idCategory` int(10) unsigned NOT NULL,
  `for_input` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property2category` (`idCategory`),
  CONSTRAINT `property2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `st_properties` */

insert  into `st_properties`(`id`,`property`,`idCategory`,`for_input`) values (1,'frequency',1,'frequency'),(2,'number of cores',1,'cores'),(3,'cache',1,'cache'),(4,'gpu frequency',3,'gpu_frequency'),(5,'video Memory',3,'video_memory'),(6,'type of drive',4,'type_drive'),(7,'volume',4,'volume'),(8,'buffer',4,'buffer'),(9,'socket',5,'socket'),(10,'noise',5,'noise'),(11,'cpu',6,'cpu'),(12,'form factor motherboard',8,'form_factor'),(13,'location of the power supply',8,'location_power'),(14,'power',9,'power');

/*Table structure for table `st_users` */

DROP TABLE IF EXISTS `st_users`;

CREATE TABLE `st_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text,
  `phone` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isAdmin` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `st_users` */

insert  into `st_users`(`id`,`name`,`email`,`address`,`phone`,`password`,`isAdmin`) values (1,'guest','',NULL,NULL,NULL,0),(2,'admin','',NULL,NULL,'admin',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
