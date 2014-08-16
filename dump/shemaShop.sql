<?xml version="1.0" encoding="UTF-8"?>
<schemadesigner version="6.5">
<source>
<database charset="utf8" collation="utf8_general_ci">shop_st</database>
</source>
<canvas zoom="100">
<tables>
<table name="product2category" view="colnames">
<left>19</left>
<top>185</top>
<width>109</width>
<height>129</height>
<sql_create_table>CREATE TABLE `product2category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idCategory` int(10) unsigned NOT NULL,
  `idProduct` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product2category_category` (`idCategory`),
  KEY `product2category_product` (`idProduct`),
  CONSTRAINT `product2category_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`),
  CONSTRAINT `product2category_category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_category" view="colnames">
<left>153</left>
<top>12</top>
<width>108</width>
<height>129</height>
<sql_create_table>CREATE TABLE `st_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_items" view="colnames">
<left>663</left>
<top>151</top>
<width>114</width>
<height>146</height>
<sql_create_table>CREATE TABLE `st_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idOrder` int(10) unsigned NOT NULL,
  `idProduct` int(10) unsigned NOT NULL,
  `numProduct` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order2product_product` (`idProduct`),
  KEY `order2product_order` (`idOrder`),
  CONSTRAINT `order2product_order` FOREIGN KEY (`idOrder`) REFERENCES `st_orders` (`id`),
  CONSTRAINT `order2product_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_orders" view="colnames">
<left>473</left>
<top>10</top>
<width>89</width>
<height>146</height>
<sql_create_table>CREATE TABLE `st_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(10) unsigned NOT NULL,
  `idItems` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `oreder2item` (`idItems`),
  KEY `oreder2user` (`idUser`),
  CONSTRAINT `oreder2user` FOREIGN KEY (`idUser`) REFERENCES `st_users` (`id`),
  CONSTRAINT `oreder2item` FOREIGN KEY (`idItems`) REFERENCES `st_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_product2property" view="colnames">
<left>570</left>
<top>362</top>
<width>105</width>
<height>129</height>
<sql_create_table>CREATE TABLE `st_product2property` (
  `idProduct` int(10) unsigned NOT NULL,
  `idProperty` int(10) unsigned NOT NULL,
  `value` text NOT NULL,
  KEY `product2property_product` (`idProduct`),
  KEY `product2property_property` (`idProperty`),
  CONSTRAINT `product2property_product` FOREIGN KEY (`idProduct`) REFERENCES `st_products` (`id`),
  CONSTRAINT `product2property_property` FOREIGN KEY (`idProperty`) REFERENCES `st_properties` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_products" view="colnames">
<left>303</left>
<top>178</top>
<width>109</width>
<height>163</height>
<sql_create_table>CREATE TABLE `st_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float DEFAULT NULL,
  `idCategory` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product2category` (`idCategory`),
  CONSTRAINT `product2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_properties" view="colnames">
<left>303</left>
<top>10</top>
<width>109</width>
<height>129</height>
<sql_create_table>CREATE TABLE `st_properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `property` varchar(255) NOT NULL,
  `idCategory` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property2category` (`idCategory`),
  CONSTRAINT `property2category` FOREIGN KEY (`idCategory`) REFERENCES `st_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
<table name="st_users" view="colnames">
<left>809</left>
<top>11</top>
<width>99</width>
<height>163</height>
<sql_create_table>CREATE TABLE `st_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8</sql_create_table>
</table>
</tables>
</canvas>
</schemadesigner>