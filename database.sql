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
  `parcel_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_keyword` int NOT NULL,
  KEY `FK_linked_uri_uri_table` (`id_keyword`),
  KEY `FK_linked_uri_parcel_table` (`parcel_id`) USING BTREE,
  CONSTRAINT `FK_linked_uri_parcel_table` FOREIGN KEY (`parcel_id`) REFERENCES `parcel_table` (`parcel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_linked_uri_uri_table` FOREIGN KEY (`id_keyword`) REFERENCES `uri_table` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.linked_uri: ~0 rows (approximately)
REPLACE INTO `linked_uri` (`parcel_id`, `id_keyword`) VALUES
	('3578071002010101', 20),
	('3578071002010102', 20),
	('3578071002010102', 9),
	('357807100201BT', 20),
	('357807100201GSB', 20),
	('357807100201GSB', 9);

-- Dumping structure for table rrrcadastre.parcel_table
CREATE TABLE IF NOT EXISTS `parcel_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parcel_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `parcel_name` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parcel_occupant` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parcel_id` (`parcel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=921708 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.parcel_table: ~181 rows (approximately)
REPLACE INTO `parcel_table` (`id`, `parcel_id`, `parcel_name`, `parcel_occupant`) VALUES
	(550615, '3578071001010101', 'L1.1', NULL),
	(558371, '3578071001010102', 'L1.2', NULL),
	(559588, '3578071001010103', 'L1.3', NULL),
	(560626, '3578071001010105', 'L1.5', NULL),
	(592037, '3578071001010106', 'L1.6', NULL),
	(595885, '3578071001010108', 'L1.8', NULL),
	(596362, '3578071001010109', 'L1.9', NULL),
	(596892, '3578071001010110', 'L1.10', NULL),
	(598132, '3578071001010111', 'L1.11', NULL),
	(598583, '35730310050101BT', 'Upperground space', NULL),
	(598698, '35730310050101BB', 'Underground space', NULL),
	(599276, '3573031005010101', 'L1.2 Shared Space', NULL),
	(599448, '3578071001010112', 'L1.12', NULL),
	(599584, '3573031005010117', 'L1.17 Parking', NULL),
	(599642, '3573031005010102', 'L1.2 Warehouse', NULL),
	(599868, '3573031005010116', 'Unit', NULL),
	(599963, '3573031005010115', 'Unit', NULL),
	(600045, '3573031005010114', 'Unit', NULL),
	(600145, '3573031005010113', 'L1.13 Manager Room', NULL),
	(600222, '3573031005010112', 'L1.12 Panel Room', NULL),
	(600292, '3573031005010111', 'L1.11 Parking', NULL),
	(600414, '3573031005010109', 'L1.9 Jantor', NULL),
	(600819, '3578071001010104', 'L1.4', NULL),
	(600975, '3573031005010110', 'L1.10 Trash Bin', NULL),
	(601254, '3578071001010113', 'L1.13', NULL),
	(601694, '3573031005010106', 'L1.6 Office', NULL),
	(601835, '3573031005010107', 'L1.7 Toilet', NULL),
	(601952, '3573031005010108', 'L1.8 Prayer room ', NULL),
	(602333, '3573031005010201', 'L2.1 Shared Space', NULL),
	(602474, '3573031005010214', 'L2.14 Trash Bin', NULL),
	(606558, '3573031005010301', 'L3.1 Shared Space', NULL),
	(606910, '3573031005010314', 'L3.14 Trash Bin', NULL),
	(606926, '3573031005010414', 'L4.14 Trash Bin', NULL),
	(606942, '3573031005010514', 'L5.14 Trash Bin', NULL),
	(607296, '3573031005010401', 'L4.1 Shared Space', NULL),
	(607326, '3573031005010501', 'L5.1 Shared Space', NULL),
	(609329, '3578071001010009', 'L0.9', NULL),
	(610016, '3578071001010008', 'L0.8', NULL),
	(610552, '3578071001010005', 'L0.5', NULL),
	(611250, '3578071001010006', 'L0.6', NULL),
	(611746, '3578071001010007', 'L0.7', NULL),
	(612232, '3578071001010002', 'L0.2', NULL),
	(612619, '3578071001010001', 'L0.1', NULL),
	(613040, '3578071001010003', 'L0.3', NULL),
	(613441, '3578071001010004', 'L0.4', NULL),
	(615229, '35730310050101GSB', 'Building boundary line', NULL),
	(618222, '3573031005010516', 'Unit', NULL),
	(618223, '3573031005010517', 'Unit', NULL),
	(618224, '3573031005010518', 'Unit', NULL),
	(618225, '3573031005010519', 'Unit', NULL),
	(618226, '3573031005010520', 'Unit', NULL),
	(618227, '3573031005010521', 'Unit', NULL),
	(618228, '3573031005010522', 'Unit', NULL),
	(618229, '3573031005010523', 'Unit', NULL),
	(618230, '3573031005010524', 'Unit', NULL),
	(618231, '3573031005010525', 'Unit', NULL),
	(618232, '3573031005010526', 'Unit', NULL),
	(618233, '3573031005010515', 'Unit', NULL),
	(618333, '3573031005010416', 'Unit', NULL),
	(618334, '3573031005010417', 'Unit', NULL),
	(618335, '3573031005010418', 'Unit', NULL),
	(618336, '3573031005010419', 'Unit', NULL),
	(618337, '3573031005010420', 'Unit', NULL),
	(618338, '3573031005010421', 'Unit', NULL),
	(618339, '3573031005010422', 'Unit', NULL),
	(618340, '3573031005010423', 'Unit', NULL),
	(618341, '3573031005010424', 'Unit', NULL),
	(618342, '3573031005010425', 'Unit', NULL),
	(618343, '3573031005010426', 'Unit', NULL),
	(618344, '3573031005010415', 'Unit', NULL),
	(618444, '3573031005010316', 'Unit', NULL),
	(618445, '3573031005010317', 'Unit', NULL),
	(618446, '3573031005010318', 'Unit', NULL),
	(618447, '3573031005010319', 'Unit', NULL),
	(618448, '3573031005010320', 'Unit', NULL),
	(618449, '3573031005010321', 'Unit', NULL),
	(618450, '3573031005010322', 'Unit', NULL),
	(618451, '3573031005010323', 'Unit', NULL),
	(618452, '3573031005010324', 'Unit', NULL),
	(618453, '3573031005010325', 'Unit', NULL),
	(618454, '3573031005010326', 'Unit', NULL),
	(618455, '3573031005010315', 'Unit', NULL),
	(618555, '3573031005010216', 'Unit', NULL),
	(618556, '3573031005010217', 'Unit', NULL),
	(618557, '3573031005010218', 'Unit', NULL),
	(618558, '3573031005010219', 'Unit', NULL),
	(618559, '3573031005010220', 'Unit', NULL),
	(618560, '3573031005010221', 'Unit', NULL),
	(618561, '3573031005010222', 'Unit', NULL),
	(618562, '3573031005010223', 'Unit', NULL),
	(618563, '3573031005010224', 'Unit', NULL),
	(618564, '3573031005010225', 'Unit', NULL),
	(618565, '3573031005010226', 'Unit', NULL),
	(618566, '3573031005010215', 'Unit', NULL),
	(618690, '3573031005010502', 'Unit', NULL),
	(618691, '3573031005010504', 'Unit', NULL),
	(618692, '3573031005010505', 'Unit', NULL),
	(618693, '3573031005010506', 'Unit', NULL),
	(618694, '3573031005010507', 'Unit', NULL),
	(618695, '3573031005010508', 'Unit', NULL),
	(618696, '3573031005010509', 'Unit', NULL),
	(618697, '3573031005010510', 'Unit', NULL),
	(618698, '3573031005010511', 'Unit', NULL),
	(618699, '3573031005010513', 'Unit', NULL),
	(618700, '3573031005010503', 'Unit', NULL),
	(618701, '3573031005010512', 'Unit', NULL),
	(618801, '3573031005010402', 'Unit', NULL),
	(618802, '3573031005010404', 'Unit', NULL),
	(618803, '3573031005010405', 'Unit', NULL),
	(618804, '3573031005010406', 'Unit', NULL),
	(618805, '3573031005010407', 'Unit', NULL),
	(618806, '3573031005010408', 'Unit', NULL),
	(618807, '3573031005010409', 'Unit', NULL),
	(618808, '3573031005010410', 'Unit', NULL),
	(618809, '3573031005010411', 'Unit', NULL),
	(618810, '3573031005010413', 'Unit', NULL),
	(618811, '3573031005010403', 'Unit', NULL),
	(618812, '3573031005010412', 'Unit', NULL),
	(618912, '3573031005010302', 'Unit', NULL),
	(618913, '3573031005010304', 'Unit', NULL),
	(618914, '3573031005010305', 'Unit', NULL),
	(618915, '3573031005010306', 'Unit', NULL),
	(618916, '3573031005010307', 'Unit', NULL),
	(618917, '3573031005010308', 'Unit', NULL),
	(618918, '3573031005010309', 'Unit', NULL),
	(618919, '3573031005010310', 'Unit', NULL),
	(618920, '3573031005010311', 'Unit', NULL),
	(618921, '3573031005010313', 'Unit', NULL),
	(618922, '3573031005010303', 'Unit', NULL),
	(618923, '3573031005010312', 'Unit', NULL),
	(619134, '3573031005010202', 'Unit', NULL),
	(619135, '3573031005010204', 'Unit', NULL),
	(619136, '3573031005010205', 'Unit', NULL),
	(619137, '3573031005010206', 'Unit', NULL),
	(619138, '3573031005010207', 'Unit', NULL),
	(619139, '3573031005010208', 'Unit', NULL),
	(619140, '3573031005010209', 'Unit', NULL),
	(619141, '3573031005010210', 'Unit', NULL),
	(619142, '3573031005010211', 'Unit', NULL),
	(619143, '3573031005010212', 'Unit', NULL),
	(619144, '3573031005010203', 'Unit', NULL),
	(619145, '3573031005010213', 'Unit', NULL),
	(619194, '3573031005010104', 'L1.4 Commercial', NULL),
	(619195, '3573031005010103', 'L1.3 Commercial', NULL),
	(619196, '3573031005010105', 'L1.5 Commercial', NULL),
	(639829, '3578071001010107', 'L1.7', NULL),
	(670768, '35780710010101BB', 'Underground space', NULL),
	(671122, '35780710010101BT', 'Upperground space', NULL),
	(700690, '01HNJTPGK9HQHBAMDGJ14QVAZH', NULL, NULL),
	(701720, '35780710010101GSB', 'Building boundary line', NULL),
	(817240, '3578071002010101', 'L1.1', NULL),
	(820143, '3578071002010106', 'L1.6 Museum', NULL),
	(820815, '3578071002010104', 'L1.4 Stairs', NULL),
	(820896, '3578071002010103', 'L1.3 Toilet Nursery', NULL),
	(821077, '3578071002010107', 'L1.7 UPTSA', NULL),
	(821964, '3578071002010109', 'L1.9 ATM', NULL),
	(823865, '3578071002010108', 'L1.8 Emergency Staircase', NULL),
	(825386, '3578071002010102', 'L1.2', NULL),
	(826868, '35780710020101010', 'L1.10 Pantry Room', NULL),
	(829098, '3578071002010205', 'L2.5 Disparta', NULL),
	(829358, '3578071002010204', 'L2.4 Command Center', NULL),
	(830288, '3578071002010304', 'L3.4', NULL),
	(831096, '3578071002010305', 'L3.5 Dispenduk', NULL),
	(831440, '3578071002010302', 'L.3.2 Dispora', NULL),
	(838147, '3578071002010202', 'L2.1 Disperindag', NULL),
	(839609, '3578071002010206', 'L2.6', NULL),
	(840850, '3578071002010203', 'L2.3 2nd Floor Corridor', NULL),
	(841116, '3578071002010201', 'L2.1 Jembatan', NULL),
	(843868, '3578071002010303', 'L3.3 3nd Floor Corridor', NULL),
	(847875, '3578071002010307', 'L3.7 Dinkop', NULL),
	(848368, '3578071002010306', 'L3.6 Secretary Room', NULL),
	(849039, '3578071002010401', 'L4.1 Hall', NULL),
	(849276, '3578071002010403', 'L4.3 Dispusip', NULL),
	(850924, '3578071002010501', 'L5.1 Parking', NULL),
	(886033, '3578071002010402', 'L4.2 Shared Space', NULL),
	(910222, '357807100201BT', 'Upperground space', 5),
	(913870, '3578071002010207', 'L2.7 Ramp', NULL),
	(914699, '3578071002010301', 'L3.1 Jembatan', NULL),
	(915961, '357807100201BB', 'Underground space', NULL),
	(919493, '3578071002010105', 'L1.5', NULL),
	(921704, '357807100201GSB', 'Building boundary line', 4);

-- Dumping structure for table rrrcadastre.residents_table
CREATE TABLE IF NOT EXISTS `residents_table` (
  `id_resident` int NOT NULL AUTO_INCREMENT,
  `resident_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `resident_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `started` date DEFAULT NULL,
  `finished` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resident`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.residents_table: ~0 rows (approximately)
REPLACE INTO `residents_table` (`id_resident`, `resident_code`, `resident_name`, `phone_number`, `started`, `finished`, `created_at`, `updated_at`) VALUES
	(4, '3453245235', 'Ahmad Zaki Alawi', '085707625406', '2024-02-01', '2025-02-01', NULL, '2024-02-05 15:49:39'),
	(5, '35345335387', 'Im User 2', '08254867856', '2024-02-03', '2024-02-23', NULL, '2024-02-05 16:07:29');

-- Dumping structure for table rrrcadastre.uri_table
CREATE TABLE IF NOT EXISTS `uri_table` (
  `id_keyword` int NOT NULL AUTO_INCREMENT,
  `word_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `isUrl` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'false',
  `uri_content` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_keyword`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.uri_table: ~0 rows (approximately)
REPLACE INTO `uri_table` (`id_keyword`, `word_name`, `slug`, `isUrl`, `uri_content`) VALUES
	(9, 'Tanah Kosong', 'tanah-kosong', 'true', 'http://my.its.ac.id/'),
	(20, 'Tes Lorem', 'altest', 'false', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><figure class="image"><img style="aspect-ratio:1742/1062;" src="/assets/img/uploads/1705933264_rtaImage3.png" width="1742" height="1062"></figure><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>&nbsp;</p><p>alert("??")</p><p>&lt;script&gt;alert("?")&lt;/script&gt;</p><p>alert("?")</p>'),
	(36, 'Latitude', 'latitude', 'true', 'https://en.wikipedia.org/wiki/Latitude'),
	(37, 'Longitude', 'longitude', 'true', 'https://en.wikipedia.org/wiki/Longitude');

-- Dumping structure for table rrrcadastre.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table rrrcadastre.users: ~0 rows (approximately)
REPLACE INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'admin@mail.com', '$2y$10$bG4QsXup/sKlS0tD8Jv5l.NcgoUYP0ZH3S7B4X1LDIFA1ZhOE9sOu', '2024-01-27 14:11:39', '2024-01-28 01:45:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
