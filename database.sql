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

-- Dumping structure for table rrrcadastre.linked_uri
CREATE TABLE IF NOT EXISTS `linked_uri` (
  `parcel_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `id_keyword` int NOT NULL,
  KEY `FK_linked_uri_uri_table` (`id_keyword`),
  KEY `FK_linked_uri_parcel_table` (`parcel_id`) USING BTREE,
  CONSTRAINT `FK_linked_uri_parcel_table` FOREIGN KEY (`parcel_id`) REFERENCES `parcel_table` (`parcel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_linked_uri_uri_table` FOREIGN KEY (`id_keyword`) REFERENCES `uri_table` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.linked_uri: ~3 rows (approximately)
REPLACE INTO `linked_uri` (`parcel_id`, `id_keyword`) VALUES
	('357807100201BT', 9),
	('357807100201BT', 20),
	('357807100201GSB', 9);

-- Dumping structure for table rrrcadastre.parcel_table
CREATE TABLE IF NOT EXISTS `parcel_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parcel_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `parcel_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parcel_occupant` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parcel_id` (`parcel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.parcel_table: ~2 rows (approximately)
REPLACE INTO `parcel_table` (`id`, `parcel_id`, `parcel_name`, `parcel_occupant`) VALUES
	(29, '357807100201BT', 'Paap', 'SS'),
	(34, '357807100201GSB', 'GSB', 'AA');

-- Dumping structure for table rrrcadastre.uri_table
CREATE TABLE IF NOT EXISTS `uri_table` (
  `id_keyword` int NOT NULL AUTO_INCREMENT,
  `word_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isUrl` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'true',
  `uri_content` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_keyword`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.uri_table: ~2 rows (approximately)
REPLACE INTO `uri_table` (`id_keyword`, `word_name`, `slug`, `isUrl`, `uri_content`) VALUES
	(9, 'Tanah Kosong', 'tanah-kosong', 'true', 'http://my.its.ac.id/'),
	(20, 'Tes Lorem', 'altest', 'false', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><figure class="image"><img style="aspect-ratio:1742/1062;" src="/assets/img/uploads/1705933264_rtaImage3.png" width="1742" height="1062"></figure><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p><p>alert("??")</p><p>&lt;script&gt;alert("?")&lt;/script&gt;</p><p>alert("?")</p>');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
