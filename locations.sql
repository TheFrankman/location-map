# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.53-0ubuntu0.14.04.1)
# Database: locations
# Generation Time: 2017-12-19 00:15:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table location
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;

INSERT INTO `location` (`id`, `title`, `long`, `lat`, `type`)
VALUES
	(22,'Kemptown, Brighton, UK','-0.1238787','50.8189103','home'),
	(23,'03730 Xàbia, Alicante, Spain','0.1660813','38.7890109','home'),
	(24,'Al Safa 2 - Dubai - United Arab Emirates','55.2245398','25.1586178','home'),
	(25,'Poole, UK','-1.987248','50.71505','home'),
	(26,'Bournemouth, UK','-1.880769','50.719164','home'),
	(27,'Westbourne, Bournemouth, UK','-1.9009375','50.7226257','home'),
	(28,'Brussels, Belgium','4.3517211','50.8503463','visited'),
	(29,'Ghent, Belgium','3.7174243','51.0543422','visited'),
	(31,'Bruges, Belgium','3.2246995','51.209348','visited'),
	(32,'Amsterdam, Netherlands','4.8951679','52.3702157','visited'),
	(33,'Cologne, Germany','6.9602786','50.937531','visited'),
	(34,'Düsseldorf, Germany','6.7734556','51.2277411','visited'),
	(35,'1800 S Kirkman Rd, Orlando, FL 32811, USA','-81.4657554','28.5212941','visited'),
	(36,'Alicante, Spain','-0.4906855','38.3459963','visited'),
	(37,'1800 S Kirkman Rd, Orlando, FL 32811, USA','-81.4657554','28.5212941','visited'),
	(38,'Barcelona, Spain','2.1734035','41.3850639','visited'),
	(39,'Madrid, Spain','-3.7037902','40.4167754','visited'),
	(40,'Palma, Balearic Islands, Spain','2.6501603','39.5696005','visited'),
	(41,'Andorra','1.521801','42.506285','visited'),
	(42,'Prague, Czechia','14.4378005','50.0755381','destination'),
	(43,'Dubrovnik, Croatia','18.0944238','42.6506606','visited'),
	(44,'00053 Civitavecchia, Metropolitan City of Rome, Italy','11.7954132','42.0924239','visited'),
	(45,'Naples, Metropolitan City of Naples, Italy','14.2681244','40.8517746','visited'),
	(46,'Messina, Province of Messina, Italy','15.5540152','38.1938137','visited'),
	(47,'Kotor, Montenegro','18.771234','42.424662','visited'),
	(48,'Corfu, Greece','19.9216777','39.6242621','visited'),
	(49,'Corsica, France','9.0128926','42.0396042','visited'),
	(50,'Toulon, France','5.928','43.124228','visited'),
	(51,'Mt Etna, 95031 Adrano, Province of Catania, Italy','14.9934349','37.751005','visited'),
	(52,'Abu Dhabi - United Arab Emirates','54.3773438','24.453884','visited'),
	(53,'Florida, USA','-81.5157535','27.6648274','visited'),
	(54,'San Francisco, CA, USA','-122.4194155','37.7749295','visited'),
	(55,'Thailand','100.992541','15.870032','visited'),
	(56,'Bali, Indonesia','115.188916','-8.4095178','visited'),
	(57,'Phuket, Thailand','98.3380884','7.9519331','visited'),
	(58,'Monaco','7.4246158','43.7384176','destination'),
	(59,'Marrakesh, Morocco','-7.9810845','31.6294723','destination'),
	(60,'Mexico City, CDMX, Mexico','-99.133208','19.4326077','destination'),
	(61,'Switzerland','8.227512','46.818188','destination'),
	(62,'Berlin, Germany','13.404954','52.5200066','destination');

/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
