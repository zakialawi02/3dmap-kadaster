-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2024 at 07:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rrrcadastre2`
--

-- --------------------------------------------------------

--
-- Table structure for table `critics`
--

CREATE TABLE `critics` (
  `id` int NOT NULL,
  `critics` varchar(5000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `critics`
--

INSERT INTO `critics` (`id`, `critics`, `created_at`) VALUES
(4, 'Tes', '2024-02-16 07:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `land_parcel_table`
--

CREATE TABLE `land_parcel_table` (
  `id` int NOT NULL,
  `parcel_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `building` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `land_parcel_table`
--

INSERT INTO `land_parcel_table` (`id`, `parcel_id`, `building`) VALUES
(1, '3578071002B0001', 'Siola'),
(2, '3578071002B0002', 'Balai Pemuda'),
(3, '3573031005B0001', 'Rusunawa Buring 2');

-- --------------------------------------------------------

--
-- Table structure for table `legal_objects_table`
--

CREATE TABLE `legal_objects_table` (
  `id` int NOT NULL,
  `parcel_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `parcel_name` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `legal_objects_table`
--

INSERT INTO `legal_objects_table` (`id`, `parcel_id`, `parcel_name`) VALUES
(550615, '3578071002B0002', 'Tourism Information Center'),
(558371, '3578071002B0002', 'PISA (Pusat Informasi Sahabat Anak)'),
(559588, '3578071002B0002', 'public space'),
(560626, '3578071002B0002', 'Main Room'),
(592037, '3578071002B0002', 'Back Main Room'),
(595885, '3578071002B0002', 'Staff Office'),
(596362, '3578071002B0002', 'Storage'),
(596892, '3578071002B0002', 'Bengkel Muda Surabaya'),
(598132, '3578071002B0002', 'Hallway'),
(598583, '3573031005B0001', 'Upperground space'),
(598698, '3573031005B0001', 'Underground space'),
(599276, '3573031005B0001', 'Shared Space 1st floor'),
(599448, '3578071002B0002', 'DKS Gallery'),
(599584, '3573031005B0001', 'Parking Rusunawa'),
(599642, '3573031005B0001', 'Warehouse'),
(599868, '3573031005B0001', 'Unit A.1.03'),
(599963, '3573031005B0001', 'Unit A.1.02'),
(600045, '3573031005B0001', 'Unit A.1.01'),
(600145, '3573031005B0001', 'Manager Room'),
(600222, '3573031005B0001', 'Panel Room'),
(600292, '3573031005B0001', 'Parking Rusunawa'),
(600414, '3573031005B0001', 'Jantor 1st floor'),
(600819, '3578071002B0002', 'Mathematics House'),
(600975, '3573031005B0001', 'Trash Bin 1st floor'),
(601254, '3578071002B0002', 'Merah Putih Gallery'),
(601694, '3573031005B0001', 'Office'),
(601835, '3573031005B0001', 'Toilet 1st floor'),
(601952, '3573031005B0001', 'Prayer room '),
(602333, '3573031005B0001', 'Shared Space 2nd floor'),
(602474, '3573031005B0001', 'Trash Bin 2nd floor'),
(606558, '3573031005B0001', 'Shared Space  3rd floor'),
(606910, '3573031005B0001', 'Trash Bin 3rd floor'),
(606926, '3573031005B0001', 'Trash Bin 4th floor'),
(606942, '3573031005B0001', 'Trash Bin 5th floor'),
(607296, '3573031005B0001', 'Shared Space 4th floor'),
(607326, '3573031005B0001', 'Shared Space 5th floor'),
(609329, '3578071002B0002', 'Indoor Skateboard'),
(610016, '3578071002B0002', 'Central doorway'),
(610552, '3578071002B0002', 'Entrance Door'),
(611250, '3578071002B0002', 'Exhibition space'),
(611746, '3578071002B0002', 'Below Space'),
(612232, '3578071002B0002', 'Hallway'),
(612619, '3578071002B0002', 'Elevator'),
(613040, '3578071002B0002', 'Toilet'),
(613441, '3578071002B0002', 'Operator Room'),
(615229, '3573031005B0001', 'Building boundary line'),
(618222, '3573031005B0001', 'Unit A.5.23'),
(618223, '3573031005B0001', 'Unit A.5.24'),
(618224, '3573031005B0001', 'Unit A.5.13'),
(618225, '3573031005B0001', 'Unit A.5.14'),
(618226, '3573031005B0001', 'Unit A.5.15'),
(618227, '3573031005B0001', 'Unit A.5.16'),
(618228, '3573031005B0001', 'Unit A.5.17'),
(618229, '3573031005B0001', 'Unit A.5.18'),
(618230, '3573031005B0001', 'Unit A.5.19'),
(618231, '3573031005B0001', 'Unit A.5.20'),
(618232, '3573031005B0001', 'Unit A.5.21'),
(618233, '3573031005B0001', 'Unit A.5.22'),
(618333, '3573031005B0001', 'Unit A.4.14'),
(618334, '3573031005B0001', 'Unit A.4.15'),
(618335, '3573031005B0001', 'Unit A.4.16'),
(618336, '3573031005B0001', 'Unit A.4.17'),
(618337, '3573031005B0001', 'Unit A.4.18'),
(618338, '3573031005B0001', 'Unit A.4.19'),
(618339, '3573031005B0001', 'Unit A.4.20'),
(618340, '3573031005B0001', 'Unit A.4.21'),
(618341, '3573031005B0001', 'Unit A.4.22'),
(618342, '3573031005B0001', 'Unit A.4.23'),
(618343, '3573031005B0001', 'Unit A.4.24'),
(618344, '3573031005B0001', 'Unit A.4.13'),
(618444, '3573031005B0001', 'Unit A.3.14'),
(618445, '3573031005B0001', 'Unit A.3.15'),
(618446, '3573031005B0001', 'Unit A.3.16'),
(618447, '3573031005B0001', 'Unit A.3.17'),
(618448, '3573031005B0001', 'Unit A.3.18'),
(618449, '3573031005B0001', 'Unit A.3.19'),
(618450, '3573031005B0001', 'Unit A.3.20'),
(618451, '3573031005B0001', 'Unit A.3.21'),
(618452, '3573031005B0001', 'Unit A.3.22'),
(618453, '3573031005B0001', 'Unit A.3.23'),
(618454, '3573031005B0001', 'Unit A.3.24'),
(618455, '3573031005B0001', 'Unit A.3.13'),
(618555, '3573031005B0001', 'Unit A.2.14'),
(618556, '3573031005B0001', 'Unit A.2.15'),
(618557, '3573031005B0001', 'Unit A.2.16'),
(618558, '3573031005B0001', 'Unit A.2.17'),
(618559, '3573031005B0001', 'Unit A.2.18'),
(618560, '3573031005B0001', 'Unit A.2.19'),
(618561, '3573031005B0001', 'Unit A.2.20'),
(618562, '3573031005B0001', 'Unit A.2.21'),
(618563, '3573031005B0001', 'Unit A.2.22'),
(618564, '3573031005B0001', 'Unit A.2.23'),
(618565, '3573031005B0001', 'Unit A.2.24'),
(618566, '3573031005B0001', 'Unit A.2.13'),
(618690, '3573031005B0001', 'Unit A.5.01'),
(618691, '3573031005B0001', 'Unit A.5.03'),
(618692, '3573031005B0001', 'Unit A.5.04'),
(618693, '3573031005B0001', 'Unit A.5.05'),
(618694, '3573031005B0001', 'Unit A.5.06'),
(618695, '3573031005B0001', 'Unit A.5.07'),
(618696, '3573031005B0001', 'Unit A.5.08'),
(618697, '3573031005B0001', 'Unit A.5.09'),
(618698, '3573031005B0001', 'Unit A.5.10'),
(618699, '3573031005B0001', 'Unit A.5.12'),
(618700, '3573031005B0001', 'Unit A.5.02'),
(618701, '3573031005B0001', 'Unit A.5.11'),
(618801, '3573031005B0001', 'Unit A.4.01'),
(618802, '3573031005B0001', 'Unit A.4.03'),
(618803, '3573031005B0001', 'Unit A.4.04'),
(618804, '3573031005B0001', 'Unit A.4.05'),
(618805, '3573031005B0001', 'Unit A.4.06'),
(618806, '3573031005B0001', 'Unit A.4.07'),
(618807, '3573031005B0001', 'Unit A.4.08'),
(618808, '3573031005B0001', 'Unit A.4.09'),
(618809, '3573031005B0001', 'Unit A.4.10'),
(618810, '3573031005B0001', 'Unit A.4.12'),
(618811, '3573031005B0001', 'Unit A.4.02'),
(618812, '3573031005B0001', 'Unit A.4.11'),
(618912, '3573031005B0001', 'Unit A.3.01'),
(618913, '3573031005B0001', 'Unit A.3.03'),
(618914, '3573031005B0001', 'Unit A.3.04'),
(618915, '3573031005B0001', 'Unit A.3.05'),
(618916, '3573031005B0001', 'Unit A.3.06'),
(618917, '3573031005B0001', 'Unit A.3.07'),
(618918, '3573031005B0001', 'Unit A.3.08'),
(618919, '3573031005B0001', 'Unit A.3.09'),
(618920, '3573031005B0001', 'Unit A.3.10'),
(618921, '3573031005B0001', 'Unit A.3.12'),
(618922, '3573031005B0001', 'Unit A.3.02'),
(618923, '3573031005B0001', 'Unit A.3.11'),
(619134, '3573031005B0001', 'Unit A.2.01'),
(619135, '3573031005B0001', 'Unit A.2.03'),
(619136, '3573031005B0001', 'Unit A.2.04'),
(619137, '3573031005B0001', 'Unit A.2.05'),
(619138, '3573031005B0001', 'Unit A.2.06'),
(619139, '3573031005B0001', 'Unit A.2.07'),
(619140, '3573031005B0001', 'Unit A.2.08'),
(619141, '3573031005B0001', 'Unit A.2.09'),
(619142, '3573031005B0001', 'Unit A.2.10'),
(619143, '3573031005B0001', 'Unit A.2.12'),
(619144, '3573031005B0001', 'Unit A.2.02'),
(619145, '3573031005B0001', 'Unit A.2.11'),
(619194, '3573031005B0001', 'Commercial K2'),
(619195, '3573031005B0001', 'Commercial K3'),
(619196, '3573031005B0001', 'Commercial K1'),
(639829, '3578071002B0002', 'UPT Balai Pemuda'),
(670768, '3578071002B0002', 'Underground space'),
(671122, '3578071002B0002', 'Upperground space'),
(700690, '3578071002B0002', 'Tourism Information Center'),
(701720, '3578071002B0002', 'Building boundary line'),
(817240, '3578071002B0001', 'Kriya Gallery'),
(820143, '3578071002B0001', 'Museum'),
(820815, '3578071002B0001', 'Stairs'),
(820896, '3578071002B0001', 'Toilet Nursery'),
(821077, '3578071002B0001', 'UPTSA'),
(821964, '3578071002B0001', 'ATM 1st floor'),
(823865, '3578071002B0001', 'Emergency Staircase'),
(825386, '3578071002B0001', 'Shaft'),
(826868, '3578071002B0001', 'Pantry Room'),
(829098, '3578071002B0001', 'Disparta'),
(829358, '3578071002B0001', 'Command Center'),
(830288, '3578071002B0001', 'DPM'),
(831096, '3578071002B0001', 'Dispenduk'),
(831440, '3578071002B0001', 'Dispora'),
(838147, '3578071002B0001', 'Disperindag'),
(839609, '3578071002B0001', 'Dispendukcapil'),
(840850, '3578071002B0001', '2nd Floor Corridor'),
(841116, '3578071002B0001', 'Bridge 2nd floor'),
(843868, '3578071002B0001', '3rd Floor Corridor'),
(847875, '3578071002B0001', 'Dinkop'),
(848368, '3578071002B0001', 'Secretary Room'),
(849039, '3578071002B0001', 'Convention Hall 4th floor'),
(849276, '3578071002B0001', 'Dispusip'),
(850924, '3578071002B0001', 'Parking Siola'),
(886033, '3578071002B0001', 'Shared Space 4th floor'),
(910222, '3578071002B0001', 'Upperground space'),
(913870, '3578071002B0001', 'L2.7 Ramp'),
(914699, '3578071002B0001', 'Bridge 3rd floor'),
(915961, '3578071002B0001', 'Underground space'),
(919493, '3578071002B0001', 'Shaft'),
(921704, '3578071002B0001', 'Building boundary line');

-- --------------------------------------------------------

--
-- Table structure for table `linked_uri`
--

CREATE TABLE `linked_uri` (
  `object_id` int NOT NULL,
  `id_keyword` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linked_uri`
--

INSERT INTO `linked_uri` (`object_id`, `id_keyword`) VALUES
(817240, 40),
(820143, 40),
(820815, 40),
(820896, 40),
(821077, 40),
(821964, 40),
(823865, 40),
(825386, 40),
(826868, 40),
(829098, 40),
(829358, 40),
(830288, 40),
(831096, 40),
(831440, 40),
(838147, 40),
(839609, 40),
(840850, 40),
(841116, 40),
(843868, 40),
(847875, 40),
(848368, 40),
(849039, 40),
(849276, 40),
(850924, 40),
(886033, 40),
(913870, 40),
(914699, 40),
(919493, 40),
(817240, 42),
(820143, 42),
(820815, 42),
(820896, 42),
(821077, 42),
(821964, 42),
(823865, 42),
(825386, 42),
(826868, 42),
(829098, 42),
(829358, 42),
(830288, 42),
(831096, 42),
(831440, 42),
(838147, 42),
(839609, 42),
(840850, 42),
(841116, 42),
(843868, 42),
(847875, 42),
(848368, 42),
(849039, 42),
(849276, 42),
(850924, 42),
(886033, 42),
(913870, 42),
(914699, 42),
(919493, 42),
(550615, 41),
(558371, 41),
(559588, 41),
(560626, 41),
(592037, 41),
(595885, 41),
(596362, 41),
(596892, 41),
(598132, 41),
(599448, 41),
(600819, 41),
(601254, 41),
(609329, 41),
(610016, 41),
(610552, 41),
(611250, 41),
(611746, 41),
(612232, 41),
(612619, 41),
(613040, 41),
(613441, 41),
(639829, 41),
(700690, 41),
(550615, 42),
(558371, 42),
(559588, 42),
(560626, 42),
(592037, 42),
(595885, 42),
(596362, 42),
(596892, 42),
(598132, 42),
(599448, 42),
(600819, 42),
(601254, 42),
(609329, 42),
(610016, 42),
(610552, 42),
(611250, 42),
(611746, 42),
(612232, 42),
(612619, 42),
(613040, 42),
(613441, 42),
(639829, 42),
(700690, 42),
(599276, 39),
(599584, 39),
(599642, 39),
(599868, 39),
(599963, 39),
(600045, 39),
(600145, 39),
(600222, 39),
(600292, 39),
(600414, 39),
(600975, 39),
(601694, 39),
(601835, 39),
(601952, 39),
(602333, 39),
(602474, 39),
(606558, 39),
(606910, 39),
(606926, 39),
(606942, 39),
(607296, 39),
(607326, 39),
(618222, 39),
(618223, 39),
(618224, 39),
(618225, 39),
(618226, 39),
(618227, 39),
(618228, 39),
(618229, 39),
(618230, 39),
(618231, 39),
(618232, 39),
(618233, 39),
(618333, 39),
(618334, 39),
(618335, 39),
(618336, 39),
(618337, 39),
(618338, 39),
(618339, 39),
(618340, 39),
(618341, 39),
(618342, 39),
(618343, 39),
(618344, 39),
(618444, 39),
(618445, 39),
(618446, 39),
(618447, 39),
(618448, 39),
(618449, 39),
(618450, 39),
(618451, 39),
(618452, 39),
(618453, 39),
(618454, 39),
(618455, 39),
(618555, 39),
(618556, 39),
(618557, 39),
(618558, 39),
(618559, 39),
(618560, 39),
(618561, 39),
(618562, 39),
(618563, 39),
(618564, 39),
(618565, 39),
(618566, 39),
(618690, 39),
(618691, 39),
(618692, 39),
(618693, 39),
(618694, 39),
(618695, 39),
(618696, 39),
(618697, 39),
(618698, 39),
(618699, 39),
(618700, 39),
(618701, 39),
(618801, 39),
(618802, 39),
(618803, 39),
(618804, 39),
(618805, 39),
(618806, 39),
(618807, 39),
(618808, 39),
(618809, 39),
(618810, 39),
(618811, 39),
(618812, 39),
(618912, 39),
(618913, 39),
(618914, 39),
(618915, 39),
(618916, 39),
(618917, 39),
(618918, 39),
(618919, 39),
(618920, 39),
(618921, 39),
(618922, 39),
(618923, 39),
(619134, 39),
(619135, 39),
(619136, 39),
(619137, 39),
(619138, 39),
(619139, 39),
(619140, 39),
(619141, 39),
(619142, 39),
(619143, 39),
(619144, 39),
(619145, 39),
(619194, 39),
(619195, 39),
(619196, 39),
(599276, 43),
(599584, 43),
(599642, 43),
(599868, 43),
(599963, 43),
(600045, 43),
(600145, 43),
(600222, 43),
(600292, 43),
(600414, 43),
(600975, 43),
(601694, 43),
(601835, 43),
(601952, 43),
(602333, 43),
(602474, 43),
(606558, 43),
(606910, 43),
(606926, 43),
(606942, 43),
(607296, 43),
(607326, 43),
(618222, 43),
(618223, 43),
(618224, 43),
(618225, 43),
(618226, 43),
(618227, 43),
(618228, 43),
(618229, 43),
(618230, 43),
(618231, 43),
(618232, 43),
(618233, 43),
(618333, 43),
(618334, 43),
(618335, 43),
(618336, 43),
(618337, 43),
(618338, 43),
(618339, 43),
(618340, 43),
(618341, 43),
(618342, 43),
(618343, 43),
(618344, 43),
(618444, 43),
(618445, 43),
(618446, 43),
(618447, 43),
(618448, 43),
(618449, 43),
(618450, 43),
(618451, 43),
(618452, 43),
(618453, 43),
(618454, 43),
(618455, 43),
(618555, 43),
(618556, 43),
(618557, 43),
(618558, 43),
(618559, 43),
(618560, 43),
(618561, 43),
(618562, 43),
(618563, 43),
(618564, 43),
(618565, 43),
(618566, 43),
(618690, 43),
(618691, 43),
(618692, 43),
(618693, 43),
(618694, 43),
(618695, 43),
(618696, 43),
(618697, 43),
(618698, 43),
(618699, 43),
(618700, 43),
(618701, 43),
(618801, 43),
(618802, 43),
(618803, 43),
(618804, 43),
(618805, 43),
(618806, 43),
(618807, 43),
(618808, 43),
(618809, 43),
(618810, 43),
(618811, 43),
(618812, 43),
(618912, 43),
(618913, 43),
(618914, 43),
(618915, 43),
(618916, 43),
(618917, 43),
(618918, 43),
(618919, 43),
(618920, 43),
(618921, 43),
(618922, 43),
(618923, 43),
(619134, 43),
(619135, 43),
(619136, 43),
(619137, 43),
(619138, 43),
(619139, 43),
(619140, 43),
(619141, 43),
(619142, 43),
(619143, 43),
(619144, 43),
(619145, 43),
(619194, 43),
(619195, 43),
(619196, 43),
(598583, 39),
(598583, 43),
(598583, 45),
(598698, 39),
(598698, 43),
(598698, 45),
(915961, 40),
(915961, 42),
(915961, 45),
(670768, 41),
(670768, 42),
(670768, 45),
(671122, 41),
(671122, 42),
(671122, 45),
(910222, 40),
(910222, 42),
(910222, 45),
(615229, 39),
(615229, 43),
(615229, 45),
(701720, 41),
(701720, 42),
(701720, 45),
(921704, 40),
(921704, 42),
(921704, 45);

-- --------------------------------------------------------

--
-- Table structure for table `managements_table`
--

CREATE TABLE `managements_table` (
  `id` int NOT NULL,
  `organizer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uri_organizer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `organizer_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `organizer_city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `organizer_head` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managements_table`
--

INSERT INTO `managements_table` (`id`, `organizer_name`, `uri_organizer`, `organizer_address`, `organizer_city`, `organizer_head`) VALUES
(1, 'Dinas Pekerjaan Umum, Penataan Ruang, Perumahan dan Kawasan Permukiman Permukiman', NULL, 'Jl.  Bingkil  Nomor  1', 'Malang', 'Drs. R. Dandung Julhardjanto, MT'),
(2, 'Dinas Perumahan Rakyat dan Kawasan Permukiman, Cipta Karya dan Tata Ruang', NULL, 'Jl. Taman Surya No.1', 'Surabaya', 'Lilik Arijanto, ST, MT');

-- --------------------------------------------------------

--
-- Table structure for table `renters_tenants`
--

CREATE TABLE `renters_tenants` (
  `id` int NOT NULL,
  `tenant_id` int NOT NULL,
  `room_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `due_started` date DEFAULT NULL,
  `due_finished` date DEFAULT NULL,
  `tenure_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agreement_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `permit_flats` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renters_tenants`
--

INSERT INTO `renters_tenants` (`id`, `tenant_id`, `room_id`, `due_started`, `due_finished`, `tenure_status`, `agreement_number`, `permit_flats`) VALUES
(9, 9, '0065', NULL, NULL, 'lease', NULL, NULL),
(10, 10, '0064', NULL, NULL, 'lease', NULL, NULL),
(11, 11, '0063', NULL, NULL, 'lease', NULL, NULL),
(13, 13, '0167', NULL, NULL, 'lease', NULL, NULL),
(14, 14, '0177', NULL, NULL, 'lease', '0014/1679/3573403/2024', 'S_0014.1679.3573403.2024.pdf'),
(15, 15, '0168', NULL, NULL, 'lease', NULL, NULL),
(16, 16, '0169', NULL, NULL, 'lease', NULL, NULL),
(17, 17, '0170', NULL, NULL, 'lease', '0017/1679/3573403/2024', 'S_0017.1679.3573403.2024.pdf'),
(18, 18, '0171', NULL, NULL, 'lease', '0018/1679/3573403/2024', 'S_0018.1679.3573403.2024.pdf'),
(19, 19, '0172', NULL, NULL, 'lease', '0019/1679/3573403/2024', 'S_0019.1679.3573403.2024.pdf'),
(20, 20, '0173', NULL, NULL, 'lease', '0020/1679/3573403/2024', 'S_0020.1679.3573403.2024.pdf'),
(21, 21, '0174', NULL, NULL, 'lease', '0021/1679/3573403/2024', 'S_0021.1679.3573403.2024.pdf'),
(22, 22, '0175', NULL, NULL, 'lease', '0022/1679/3573403/2024', 'S_0022.1679.3573403.2024.pdf'),
(23, 23, '0178', NULL, NULL, 'lease', '0023/1679/3573403/2024', 'S_0023.1679.3573403.2024.pdf'),
(24, 24, '0176', NULL, NULL, 'lease', '0024/1679/3573403/2024', 'S_0024.1679.3573403.2024.pdf'),
(25, 25, '0130', NULL, NULL, 'lease', NULL, NULL),
(26, 26, '0119', NULL, NULL, 'lease', NULL, NULL),
(27, 27, '0120', NULL, NULL, 'lease', NULL, NULL),
(28, 28, '0121', NULL, NULL, 'lease', NULL, NULL),
(29, 29, '0122', NULL, NULL, 'lease', NULL, NULL),
(30, 30, '0123', NULL, NULL, 'lease', NULL, NULL),
(31, 31, '0124', NULL, NULL, 'lease', NULL, NULL),
(32, 32, '0125', NULL, NULL, 'lease', NULL, NULL),
(33, 33, '0126', NULL, NULL, 'lease', NULL, NULL),
(34, 34, '0127', NULL, NULL, 'lease', NULL, NULL),
(35, 35, '0128', NULL, NULL, 'lease', NULL, NULL),
(36, 36, '0129', NULL, NULL, 'lease', NULL, NULL),
(37, 37, '0155', NULL, NULL, 'lease', NULL, NULL),
(38, 38, '0165', NULL, NULL, 'lease', NULL, NULL),
(39, 39, '0156', NULL, NULL, 'lease', NULL, NULL),
(40, 40, '0157', NULL, NULL, 'lease', NULL, NULL),
(41, 41, '0158', NULL, NULL, 'lease', NULL, NULL),
(42, 42, '0159', NULL, NULL, 'lease', NULL, NULL),
(43, 43, '0160', NULL, NULL, 'lease', NULL, NULL),
(44, 44, '0161', NULL, NULL, 'lease', NULL, NULL),
(45, 45, '0162', NULL, NULL, 'lease', NULL, NULL),
(46, 46, '0163', NULL, NULL, 'lease', NULL, NULL),
(47, 47, '0166', NULL, NULL, 'lease', NULL, NULL),
(48, 48, '0164', NULL, NULL, 'lease', NULL, NULL),
(49, 49, '0118', NULL, NULL, 'lease', NULL, NULL),
(50, 50, '0107', NULL, NULL, 'lease', NULL, NULL),
(51, 51, '0108', NULL, NULL, 'lease', NULL, NULL),
(52, 52, '0109', NULL, NULL, 'lease', NULL, NULL),
(53, 53, '0110', NULL, NULL, 'lease', NULL, NULL),
(54, 54, '0111', NULL, NULL, 'lease', NULL, NULL),
(55, 55, '0112', NULL, NULL, 'lease', NULL, NULL),
(56, 56, '0113', NULL, NULL, 'lease', NULL, NULL),
(57, 57, '0114', NULL, NULL, 'lease', NULL, NULL),
(58, 58, '0115', NULL, NULL, 'lease', NULL, NULL),
(59, 59, '0116', NULL, NULL, 'lease', NULL, NULL),
(60, 60, '0117', NULL, NULL, 'lease', NULL, NULL),
(61, 61, '0143', NULL, NULL, 'lease', NULL, NULL),
(62, 62, '0153', NULL, NULL, 'lease', NULL, NULL),
(63, 63, '0144', NULL, NULL, 'lease', NULL, NULL),
(64, 64, '0145', NULL, NULL, 'lease', NULL, NULL),
(65, 65, '0146', NULL, NULL, 'lease', NULL, NULL),
(66, 66, '0147', NULL, NULL, 'lease', NULL, NULL),
(67, 67, '0148', NULL, NULL, 'lease', NULL, NULL),
(68, 68, '0149', NULL, NULL, 'lease', NULL, NULL),
(69, 69, '0150', NULL, NULL, 'lease', NULL, NULL),
(70, 70, '0151', NULL, NULL, 'lease', NULL, NULL),
(71, 71, '0154', NULL, NULL, 'lease', NULL, NULL),
(72, 72, '0152', NULL, NULL, 'lease', NULL, NULL),
(73, 73, '0106', NULL, NULL, 'lease', NULL, NULL),
(74, 74, '0095', NULL, NULL, 'lease', NULL, NULL),
(75, 75, '0096', NULL, NULL, 'lease', NULL, NULL),
(76, 76, '0097', NULL, NULL, 'lease', NULL, NULL),
(77, 77, '0098', NULL, NULL, 'lease', NULL, NULL),
(78, 78, '0099', NULL, NULL, 'lease', NULL, NULL),
(79, 79, '0100', NULL, NULL, 'lease', NULL, NULL),
(80, 80, '0101', NULL, NULL, 'lease', NULL, NULL),
(81, 81, '0102', NULL, NULL, 'lease', NULL, NULL),
(82, 82, '0103', NULL, NULL, 'lease', NULL, NULL),
(83, 83, '0104', NULL, NULL, 'lease', NULL, NULL),
(84, 84, '0105', NULL, NULL, 'lease', NULL, NULL),
(85, 85, '0131', NULL, NULL, 'lease', NULL, NULL),
(86, 86, '0141', NULL, NULL, 'lease', NULL, NULL),
(87, 87, '0132', NULL, NULL, 'lease', NULL, NULL),
(88, 88, '0133', NULL, NULL, 'lease', NULL, NULL),
(89, 89, '0134', NULL, NULL, 'lease', NULL, NULL),
(90, 90, '0135', NULL, NULL, 'lease', NULL, NULL),
(91, 91, '0136', NULL, NULL, 'lease', NULL, NULL),
(92, 92, '0137', NULL, NULL, 'lease', NULL, NULL),
(93, 93, '0138', NULL, NULL, 'lease', NULL, NULL),
(94, 94, '0139', NULL, NULL, 'lease', NULL, NULL),
(95, 95, '0142', NULL, NULL, 'lease', NULL, NULL),
(96, 96, '0140', NULL, NULL, 'lease', NULL, NULL),
(97, 97, '0085', NULL, NULL, 'lease', NULL, NULL),
(98, 98, '0086', NULL, NULL, 'lease', NULL, NULL),
(99, 99, '0087', NULL, NULL, 'lease', NULL, NULL),
(100, 100, '0088', NULL, NULL, 'lease', NULL, NULL),
(101, 101, '0089', NULL, NULL, 'lease', NULL, NULL),
(102, 102, '0090', NULL, NULL, 'lease', NULL, NULL),
(103, 103, '0091', NULL, NULL, 'lease', NULL, NULL),
(104, 104, '0092', NULL, NULL, 'lease', NULL, NULL),
(105, 105, '0093', NULL, NULL, 'lease', NULL, NULL),
(106, 106, '0094', NULL, NULL, 'lease', NULL, NULL),
(107, 107, '0083', NULL, NULL, 'lease', NULL, NULL),
(108, 108, '0084', NULL, NULL, 'lease', NULL, NULL),
(109, 109, '0087', NULL, NULL, 'in queue', NULL, NULL),
(121, 121, '0051', '2024-02-05', NULL, 'lease', '0121/1679/3578071/2024', 'S_0121.1679.3578071.2024.pdf'),
(123, 123, '0027', '2024-08-01', '2099-07-31', 'lease', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_table`
--

CREATE TABLE `rooms_table` (
  `room_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `legal_object_id` int DEFAULT NULL,
  `organizer_id` int DEFAULT NULL,
  `room_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `space_usage` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rent_fee` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uri_room` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_table`
--

INSERT INTO `rooms_table` (`room_id`, `legal_object_id`, `organizer_id`, `room_name`, `space_usage`, `rent_fee`, `uri_room`, `is_public`) VALUES
('0001', 550615, 2, 'Tourism Information Center', 'Tourism Information Center', '', NULL, 0),
('0002', 558371, 2, 'PISA (Pusat Informasi Sahabat Anak)', 'PISA (Pusat Informasi Sahabat Anak)', '', NULL, 0),
('0003', 559588, 2, 'public space', 'public space', '', NULL, 0),
('0004', 560626, 2, 'Main Room', 'Main Room', '', NULL, 0),
('0005', 592037, 2, 'Back Main Room', 'Back Main Room', '', NULL, 0),
('0006', 595885, 2, 'Staff Office', 'Staff Office', '', NULL, 0),
('0007', 596362, 2, 'Storage', 'Storage', '', NULL, 0),
('0008', 596892, 2, 'Bengkel Muda Surabaya', 'Bengkel Muda Surabaya', '', NULL, 0),
('0009', 598132, 2, 'Hallway', 'Hallway', '', NULL, 0),
('0010', 599448, 2, 'DKS Gallery', 'DKS Gallery', '', NULL, 0),
('0011', 600819, 2, 'Mathematics House', 'Mathematics House', '', NULL, 0),
('0012', 601254, 2, 'Merah Putih Gallery', 'Merah Putih Gallery', '', NULL, 0),
('0013', 609329, 2, 'Indoor Skateboard', 'Indoor Skateboard', '', NULL, 0),
('0014', 610016, 2, 'Central doorway', 'Central doorway', '', NULL, 0),
('0015', 610552, 2, 'Entrance Door', 'Entrance Door', '', NULL, 0),
('0016', 611250, 2, 'Exhibition space', 'Exhibition space', '', NULL, 0),
('0017', 611746, 2, 'Below Space', 'Below Space', '', NULL, 0),
('0018', 612232, 2, 'Hallway', 'Hallway', '', NULL, 0),
('0019', 612619, 2, 'Elevator', 'Elevator', '', NULL, 0),
('0020', 613040, 2, 'Toilet', 'Toilet', '', NULL, 0),
('0021', 613441, 2, 'Operator Room', 'Operator Room', '', NULL, 0),
('0022', 639829, 2, 'UPT Balai Pemuda', 'UPT Balai Pemuda', '', NULL, 0),
('0025', 700690, 2, 'Tourism Information Center', 'Tourism Information Center', '', NULL, 0),
('0027', 817240, 2, 'Kriya Gallery', 'Pertokoan', '', NULL, 0),
('0028', 820143, 2, 'Museum', 'Museum', '', NULL, 0),
('0029', 820815, 2, 'Tangga', 'Benda Bersama', '', NULL, 1),
('0030', 820896, 2, 'Toilet Nursery', 'Toilet Nursery', '', NULL, 0),
('0031', 821077, 2, 'UPTSA', 'UPTSA', '', NULL, 0),
('0032', 821964, 2, 'ATM 1st floor', 'ATM 1st floor', '', NULL, 0),
('0033', 823865, 2, 'Emergency Staircase', 'Emergency Staircase', '', NULL, 0),
('0034', 825386, 2, 'Lorong', 'Bagian Bersama', '', '', 1),
('0035', 826868, 2, 'Pantry Room', 'Pantry Room', '', NULL, 0),
('0036', 829098, 2, 'Disparta', 'Disparta', '', NULL, 0),
('0037', 829358, 2, 'Command Center', 'Command Center', '', NULL, 0),
('0038', 830288, 2, 'DPM', 'DPM', '', NULL, 0),
('0039', 831096, 2, 'Dispenduk', 'Dispenduk', '', NULL, 0),
('0040', 831440, 2, 'Dispora', 'Dispora', '', NULL, 0),
('0041', 838147, 2, 'Disperindag', 'Disperindag', '', NULL, 0),
('0042', 839609, 2, 'Dispendukcapil', 'Dispendukcapil', '', NULL, 0),
('0043', 840850, 2, '2nd Floor Corridor', '2nd Floor Corridor', '', NULL, 0),
('0044', 841116, 2, 'Bridge 2nd floor', 'Bridge 2nd floor', '', NULL, 0),
('0045', 843868, 2, '3rd Floor Corridor', '3rd Floor Corridor', '', NULL, 0),
('0046', 847875, 2, 'Dinkop', 'Dinkop', '', NULL, 0),
('0047', 848368, 2, 'Secretary Room', 'Secretary Room', '', NULL, 0),
('0048', 849039, 2, 'Convention Hall 4th floor', 'Convention Hall 4th floor', '', NULL, 0),
('0049', 849276, 2, 'Dispusip', 'Dispusip', '', NULL, 0),
('0050', 850924, 2, 'Parking Siola', 'Parking Siola', '', NULL, 0),
('0051', 886033, 2, 'Shared Space 4th floor', 'Shared Space 4th floor', '', NULL, 0),
('0053', 913870, 2, 'L2.7 Ramp', 'L2.7 Ramp', '', NULL, 0),
('0054', 914699, 2, 'Bridge 3rd floor', 'Bridge 3rd floor', '', NULL, 0),
('0056', 919493, 2, 'Lorong', 'Bagian Bersama', '', NULL, 1),
('0060', 599276, 1, 'Shared Space 1st floor', 'Shared Space 1st floor', '', NULL, 0),
('0061', 599584, 1, 'Parking Rusunawa', 'Parking Rusunawa', '', NULL, 0),
('0062', 599642, 1, 'Warehouse', 'Warehouse', '', NULL, 0),
('0063', 599868, 1, 'Unit A.1.03', 'Residence', '400000', NULL, 0),
('0064', 599963, 1, 'Unit A.1.02', 'Residence', '400000', NULL, 0),
('0065', 600045, 1, 'Unit A.1.01', 'Residence', '400000', NULL, 0),
('0066', 600145, 1, 'Manager Room', 'Manager Room', '', NULL, 0),
('0067', 600222, 1, 'Panel Room', 'Panel Room', '', NULL, 0),
('0068', 600292, 1, 'Parking Rusunawa', 'Parking Rusunawa', '', NULL, 0),
('0069', 600414, 1, 'Jantor 1st floor', 'Jantor 1st floor', '', NULL, 0),
('0070', 600975, 1, 'Trash Bin 1st floor', 'Trash Bin 1st floor', '', NULL, 0),
('0071', 601694, 1, 'Office', 'Office', '', NULL, 0),
('0072', 601835, 1, 'Toilet 1st floor', 'Toilet 1st floor', '', NULL, 0),
('0073', 601952, 1, 'Prayer room', 'Prayer room', '', NULL, 0),
('0074', 602333, 1, 'Shared Space 2nd floor', 'Shared Space 2nd floor', '', NULL, 0),
('0075', 602474, 1, 'Trash Bin 2nd floor', 'Trash Bin 2nd floor', '', NULL, 0),
('0076', 606558, 1, 'Shared Space 3rd floor', 'Shared Space 3rd floor', '', NULL, 0),
('0077', 606910, 1, 'Trash Bin 3rd floor', 'Trash Bin 3rd floor', '', NULL, 0),
('0078', 606926, 1, 'Trash Bin 4th floor', 'Trash Bin 4th floor', '', NULL, 0),
('0079', 606942, 1, 'Trash Bin 5th floor', 'Trash Bin 5th floor', '', NULL, 0),
('0080', 607296, 1, 'Shared Space 4th floor', 'Shared Space 4th floor', '', NULL, 0),
('0081', 607326, 1, 'Shared Space 5th floor', 'Shared Space 5th floor', '', NULL, 0),
('0083', 618222, 1, 'Unit A.5.23', 'Residence', '200000', NULL, 0),
('0084', 618223, 1, 'Unit A.5.24', 'Residence', '200000', NULL, 0),
('0085', 618224, 1, 'Unit A.5.13', 'Residence', '200000', NULL, 0),
('0086', 618225, 1, 'Unit A.5.14', 'Residence', '200000', NULL, 0),
('0087', 618226, 1, 'Unit A.5.15', 'Residence', '200000', NULL, 0),
('0088', 618227, 1, 'Unit A.5.16', 'Residence', '200000', NULL, 0),
('0089', 618228, 1, 'Unit A.5.17', 'Residence', '200000', NULL, 0),
('0090', 618229, 1, 'Unit A.5.18', 'Residence', '200000', NULL, 0),
('0091', 618230, 1, 'Unit A.5.19', 'Residence', '200000', NULL, 0),
('0092', 618231, 1, 'Unit A.5.20', 'Residence', '200000', NULL, 0),
('0093', 618232, 1, 'Unit A.5.21', 'Residence', '200000', NULL, 0),
('0094', 618233, 1, 'Unit A.5.22', 'Residence', '200000', NULL, 0),
('0095', 618333, 1, 'Unit A.4.14', 'Residence', '250000', NULL, 0),
('0096', 618334, 1, 'Unit A.4.15', 'Residence', '250000', NULL, 0),
('0097', 618335, 1, 'Unit A.4.16', 'Residence', '250000', NULL, 0),
('0098', 618336, 1, 'Unit A.4.17', 'Residence', '250000', NULL, 0),
('0099', 618337, 1, 'Unit A.4.18', 'Residence', '250000', NULL, 0),
('0100', 618338, 1, 'Unit A.4.19', 'Residence', '250000', NULL, 0),
('0101', 618339, 1, 'Unit A.4.20', 'Residence', '250000', NULL, 0),
('0102', 618340, 1, 'Unit A.4.21', 'Residence', '250000', NULL, 0),
('0103', 618341, 1, 'Unit A.4.22', 'Residence', '250000', NULL, 0),
('0104', 618342, 1, 'Unit A.4.23', 'Residence', '250000', NULL, 0),
('0105', 618343, 1, 'Unit A.4.24', 'Residence', '250000', NULL, 0),
('0106', 618344, 1, 'Unit A.4.13', 'Residence', '250000', NULL, 0),
('0107', 618444, 1, 'Unit A.3.14', 'Residence', '300000', NULL, 0),
('0108', 618445, 1, 'Unit A.3.15', 'Residence', '300000', NULL, 0),
('0109', 618446, 1, 'Unit A.3.16', 'Residence', '300000', NULL, 0),
('0110', 618447, 1, 'Unit A.3.17', 'Residence', '300000', NULL, 0),
('0111', 618448, 1, 'Unit A.3.18', 'Residence', '300000', NULL, 0),
('0112', 618449, 1, 'Unit A.3.19', 'Residence', '300000', NULL, 0),
('0113', 618450, 1, 'Unit A.3.20', 'Residence', '300000', NULL, 0),
('0114', 618451, 1, 'Unit A.3.21', 'Residence', '300000', NULL, 0),
('0115', 618452, 1, 'Unit A.3.22', 'Residence', '300000', NULL, 0),
('0116', 618453, 1, 'Unit A.3.23', 'Residence', '300000', NULL, 0),
('0117', 618454, 1, 'Unit A.3.24', 'Residence', '300000', NULL, 0),
('0118', 618455, 1, 'Unit A.3.13', 'Residence', '300000', NULL, 0),
('0119', 618555, 1, 'Unit A.2.14', 'Residence', '350000', NULL, 0),
('0120', 618556, 1, 'Unit A.2.15', 'Residence', '350000', NULL, 0),
('0121', 618557, 1, 'Unit A.2.16', 'Residence', '350000', NULL, 0),
('0122', 618558, 1, 'Unit A.2.17', 'Residence', '350000', NULL, 0),
('0123', 618559, 1, 'Unit A.2.18', 'Residence', '350000', NULL, 0),
('0124', 618560, 1, 'Unit A.2.19', 'Residence', '350000', NULL, 0),
('0125', 618561, 1, 'Unit A.2.20', 'Residence', '350000', NULL, 0),
('0126', 618562, 1, 'Unit A.2.21', 'Residence', '350000', NULL, 0),
('0127', 618563, 1, 'Unit A.2.22', 'Residence', '350000', NULL, 0),
('0128', 618564, 1, 'Unit A.2.23', 'Residence', '350000', NULL, 0),
('0129', 618565, 1, 'Unit A.2.24', 'Residence', '350000', NULL, 0),
('0130', 618566, 1, 'Unit A.2.13', 'Residence', '350000', NULL, 0),
('0131', 618690, 1, 'Unit A.5.01', 'Residence', '200000', NULL, 0),
('0132', 618691, 1, 'Unit A.5.03', 'Residence', '200000', NULL, 0),
('0133', 618692, 1, 'Unit A.5.04', 'Residence', '200000', NULL, 0),
('0134', 618693, 1, 'Unit A.5.05', 'Residence', '200000', NULL, 0),
('0135', 618694, 1, 'Unit A.5.06', 'Residence', '200000', NULL, 0),
('0136', 618695, 1, 'Unit A.5.07', 'Residence', '200000', NULL, 0),
('0137', 618696, 1, 'Unit A.5.08', 'Residence', '200000', NULL, 0),
('0138', 618697, 1, 'Unit A.5.09', 'Residence', '200000', NULL, 0),
('0139', 618698, 1, 'Unit A.5.10', 'Residence', '200000', NULL, 0),
('0140', 618699, 1, 'Unit A.5.12', 'Residence', '200000', NULL, 0),
('0141', 618700, 1, 'Unit A.5.02', 'Residence', '200000', NULL, 0),
('0142', 618701, 1, 'Unit A.5.11', 'Residence', '200000', NULL, 0),
('0143', 618801, 1, 'Unit A.4.01', 'Residence', '250000', NULL, 0),
('0144', 618802, 1, 'Unit A.4.03', 'Residence', '250000', NULL, 0),
('0145', 618803, 1, 'Unit A.4.04', 'Residence', '250000', NULL, 0),
('0146', 618804, 1, 'Unit A.4.05', 'Residence', '250000', NULL, 0),
('0147', 618805, 1, 'Unit A.4.06', 'Residence', '250000', NULL, 0),
('0148', 618806, 1, 'Unit A.4.07', 'Residence', '250000', NULL, 0),
('0149', 618807, 1, 'Unit A.4.08', 'Residence', '250000', NULL, 0),
('0150', 618808, 1, 'Unit A.4.09', 'Residence', '250000', NULL, 0),
('0151', 618809, 1, 'Unit A.4.10', 'Residence', '250000', NULL, 0),
('0152', 618810, 1, 'Unit A.4.12', 'Residence', '250000', NULL, 0),
('0153', 618811, 1, 'Unit A.4.02', 'Residence', '250000', NULL, 0),
('0154', 618812, 1, 'Unit A.4.11', 'Residence', '250000', NULL, 0),
('0155', 618912, 1, 'Unit A.3.01', 'Residence', '300000', NULL, 0),
('0156', 618913, 1, 'Unit A.3.03', 'Residence', '300000', NULL, 0),
('0157', 618914, 1, 'Unit A.3.04', 'Residence', '300000', NULL, 0),
('0158', 618915, 1, 'Unit A.3.05', 'Residence', '300000', NULL, 0),
('0159', 618916, 1, 'Unit A.3.06', 'Residence', '300000', NULL, 0),
('0160', 618917, 1, 'Unit A.3.07', 'Residence', '300000', NULL, 0),
('0161', 618918, 1, 'Unit A.3.08', 'Residence', '300000', NULL, 0),
('0162', 618919, 1, 'Unit A.3.09', 'Residence', '300000', NULL, 0),
('0163', 618920, 1, 'Unit A.3.10', 'Residence', '300000', NULL, 0),
('0164', 618921, 1, 'Unit A.3.12', 'Residence', '300000', NULL, 0),
('0165', 618922, 1, 'Unit A.3.02', 'Residence', '300000', NULL, 0),
('0166', 618923, 1, 'Unit A.3.11', 'Residence', '300000', NULL, 0),
('0167', 619134, 1, 'Unit A.2.01', 'Residence', '350000', NULL, 0),
('0168', 619135, 1, 'Unit A.2.03', 'Residence', '350000', NULL, 0),
('0169', 619136, 1, 'Unit A.2.04', 'Residence', '350000', NULL, 0),
('0170', 619137, 1, 'Unit A.2.05', 'Residence', '350000', NULL, 0),
('0171', 619138, 1, 'Unit A.2.06', 'Residence', '350000', NULL, 0),
('0172', 619139, 1, 'Unit A.2.07', 'Residence', '350000', NULL, 0),
('0173', 619140, 1, 'Unit A.2.08', 'Residence', '350000', NULL, 0),
('0174', 619141, 1, 'Unit A.2.09', 'Residence', '350000', NULL, 0),
('0175', 619142, 1, 'Unit A.2.10', 'Residence', '350000', NULL, 0),
('0176', 619143, 1, 'Unit A.2.12', 'Residence', '350000', NULL, 0),
('0177', 619144, 1, 'Unit A.2.02', 'Residence', '350000', NULL, 0),
('0178', 619145, 1, 'Unit A.2.11', 'Residence', '350000', NULL, 0),
('0179', 619194, 1, 'Commercial K2', 'Commercial K2', '', NULL, 0),
('0180', 619195, 1, 'Commercial K3', 'Commercial K3', '', NULL, 0),
('0181', 619196, 1, 'Commercial K1', 'Commercial K1', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenants_table`
--

CREATE TABLE `tenants_table` (
  `id` int NOT NULL,
  `tenant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tenant_job` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_religion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `marriage_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `number_residents` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_rt_rw` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_village` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_district` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tenant_province` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants_table`
--

INSERT INTO `tenants_table` (`id`, `tenant_name`, `name_number`, `tenant_job`, `tenant_religion`, `marriage_status`, `number_residents`, `tenant_address`, `tenant_rt_rw`, `tenant_village`, `tenant_district`, `tenant_city`, `tenant_province`) VALUES
(9, 'Mochamad Sholeh', '358000000001', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(10, 'Dewi Andrias', '358000000002', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(11, 'Leo Sigit Prasetyo', '358000000003', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(13, 'Relman Laia', '358000000004', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(14, 'Rani Setia Anggraeni', '358000000005', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(15, 'Fatmawati', '358000000006', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(16, 'Khrisna Budiarta', '358000000007', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(17, 'Trio Prayogi', '358000000008', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(18, 'Suparno', '358000000009', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(19, 'Deri Rubys Anugerah', '358000000010', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(20, 'Denny VIcky Kurniawan', '358000000011', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(21, 'Afiful Haq', '358000000012', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(22, 'Marwan', '358000000013', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(23, 'Diah Susanti Udayana', '358000000014', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(24, 'Agus Suroso', '358000000015', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(25, 'Moch. Yusuf', '358000000016', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(26, 'Sugianto', '358000000017', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(27, 'Umbar Yulianto', '358000000018', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(28, 'Aris Priyanto', '358000000019', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(29, 'Edi Siswantoko', '358000000020', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(30, 'Dian Aprilya', '358000000021', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(31, 'Eko Budi Susanto', '358000000022', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(32, 'Dedy Widianto', '358000000023', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(33, 'Dany Suharmanto', '358000000024', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(34, 'Krisdianto', '358000000025', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(35, 'Diah Megawati', '358000000026', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(36, 'Joko Waluyo', '358000000027', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(37, 'Yuliana', '358000000028', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(38, 'Achmad Zam Zam', '358000000029', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(39, 'Suparlan', '358000000030', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(40, 'Zainoel Answar', '358000000031', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(41, 'Naser Risky', '358000000032', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(42, 'Lucky Tiara Chandra', '358000000033', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(43, 'Suprapto', '358000000034', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(44, 'Betha Retanti', '358000000035', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(45, 'Mustofa', '358000000036', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(46, 'Aniwati', '358000000037', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(47, 'Fajar Setiawan', '358000000038', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(48, 'Murniningtijas', '358000000039', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(49, 'Setyo Christina W', '358000000040', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(50, 'Maryati', '358000000041', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(51, 'Nova Eko Prastyo', '358000000042', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(52, 'Triana', '358000000043', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(53, 'Ridwan Hamsayu Satria Prakoso', '358000000044', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(54, 'Lisnawati', '358000000045', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(55, 'Wahyu Sukariyaningsih', '358000000046', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(56, 'Mokhamad Ari Setyawan', '358000000047', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(57, 'Danu Siswanto', '358000000048', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(58, 'Hari Budi', '358000000049', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(59, 'Asih Julia Hendrampuni', '358000000050', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(60, 'Wiwik Supartinah', '358000000051', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(61, 'Dian Sujatmiko', '358000000052', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(62, 'Relly Pamungkas', '358000000053', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(63, 'Aynurido', '358000000054', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(64, 'Titik Margowati', '358000000055', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(65, 'Soedarmadji', '358000000056', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(66, 'Sudjono', '358000000057', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(67, 'Pancoro Indyanto', '358000000058', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(68, 'Isnawati Indriani', '358000000059', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(69, 'Anang Kuswandi', '358000000060', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(70, 'Dwi Indrawati', '358000000061', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(71, 'Rachmad Tabah SUkoco', '358000000062', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(72, 'Adi Satria', '358000000063', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(73, 'Krisman Indra', '358000000064', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(74, 'Rizal Effendi', '358000000065', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(75, 'Mochamad Pausi', '358000000066', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(76, 'Romi Cahyono', '358000000067', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(77, 'Endro Sudiono', '358000000068', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(78, 'Prasetijo Adam Marcianus', '358000000069', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(79, 'Kholidul Azis', '358000000070', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(80, 'Agus Suharto', '358000000071', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(81, 'Anastasia Venny J', '358000000072', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(82, 'Moch Dzikri Rathomy', '358000000073', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(83, 'Anwar Tehuayo', '358000000074', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(84, 'Kartini', '358000000075', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(85, 'Resnati', '358000000076', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(86, 'Aditya Hendrawan', '358000000077', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(87, 'Arris', '358000000078', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(88, 'Choirul Soleh', '358000000079', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(89, 'Kisworo Ari Wibowo', '358000000080', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(90, 'Sukarno', '358000000081', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(91, 'Budi Susanto', '358000000082', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(92, 'Yanto', '358000000083', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(93, 'Sandi Hadi Susanto', '358000000084', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(94, 'Dwi Yulianto Binawan', '358000000085', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(95, 'Bagus Hendi Christanto', '358000000086', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(96, 'Judha Bagus Prasetyo', '358000000087', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(97, 'Nur Djunaidi', '358000000088', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(98, 'Nanang Supriono', '358000000089', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(99, 'Sunardi', '358000000090', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(100, 'Achmad Fahmi A', '358000000091', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(101, 'Djodi Surya Pamungkas', '358000000092', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(102, 'Elus', '358000000093', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(103, 'Eko Purnomo W', '358000000094', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(104, 'Yudhi Handoyoputro', '358000000095', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(105, 'Doni Arianto', '358000000096', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(106, 'Dewi Ratih Ayu Rachmani', '358000000097', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(107, 'Laga Widya Eka Putera', '358000000098', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(108, 'Wawan Hermanto', '358000000099', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(109, 'Ahmad Zaki Alawi', '158000000000', 'guru', 'islam', NULL, NULL, 'jl. sasdedfsdf', '{\"tenant_rt\":\"01\",\"tenant_rw\":\"04\"}', 'Keputih', 'Sukolilo', 'E', 'F'),
(121, 'Yanto Budisusanto', '54656454364', 'Kepala Bagian', 'Islam', NULL, NULL, 'Perumahan Mangiawan', '{\"tenant_rt\":\"04\",\"tenant_rw\":\"15\"}', 'Mangliawan', 'Pakis', 'Kabupaten Malang', 'Jawa Timur'),
(123, 'Pemilik Toko', '357809 000000000', 'Wiraswasta', 'Islam', NULL, NULL, 'Jalan Persimpangan', '{\"tenant_rt\":\"00\",\"tenant_rw\":\"00\"}', 'Kelurahan/Desa', 'Kecamatan', 'Kota', 'Propinsi');

-- --------------------------------------------------------

--
-- Table structure for table `uri_table`
--

CREATE TABLE `uri_table` (
  `id_keyword` int NOT NULL,
  `word_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `isUrl` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'false',
  `uri_content` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uri_table`
--

INSERT INTO `uri_table` (`id_keyword`, `word_name`, `slug`, `isUrl`, `uri_content`) VALUES
(36, 'Latitude', 'latitude', 'true', 'https://wikipedia.org/wiki/Latitude'),
(37, 'Longitude', 'longitude', 'true', 'https://wikipedia.org/wiki/Longitude'),
(39, 'Rumah Susun', 'rumah-susun', 'true', 'https://id.wikipedia.org/wiki/Rumah_susun'),
(40, 'Siola Building', 'siola-building', 'true', 'https://id.wikipedia.org/wiki/Siola'),
(41, 'Balai Pemuda Surabaya', 'balai-pemuda-surabaya', 'true', 'https://disbudporapar.surabaya.go.id/adinda/portaldata/cagarbudaya/detail/balai-pemuda-surabaya'),
(42, 'Surabaya', 'surabaya', 'true', 'https://en.wikipedia.org/wiki/Surabaya'),
(43, 'Malang', 'malang', 'true', 'https://id.wikipedia.org/wiki/Kota_Malang'),
(44, 'what is domain', 'what-is-domain', 'false', '<h2>What is a domain name?</h2><p>A domain name is a string of text that maps to an alphanumeric IP address, used to access a website from client software. In plain English, a domain name is the text that a user types into a browser window to reach a particular website. For instance, the domain name for Google is Ã¢â‚¬Ëœgoogle.comÃ¢â‚¬â„¢.</p><p>The actual address of a website is a complex numerical IP address (e.g. 192.0.2.2), but thanks to DNS, users are able to enter human-friendly domain names and be routed to the websites they are looking for. This process is known as a DNS lookup.</p><figure class=\"image\"><img style=\"aspect-ratio:1024/506;\" src=\"/assets/img/uploads/1708066244_url-structure.jpg\" width=\"1024\" height=\"506\"></figure><h3>Who manages domain names?</h3><p>Domain names are all managed by domain registries, which delegate the reservation of domain names to registrars. Anyone who wants to create a website can register a domain name with a registrar, and there are currently over 300 million registered domain names.</p><h3>What is the difference between a domain name and a URL?</h3><p>A uniform resource locator (URL), sometimes called a web address, contains the domain name of a site as well as other information, including the protocol and the path. For example, in the URL Ã¢â‚¬Ëœhttps://cloudflare.com/learning/Ã¢â‚¬â„¢, Ã¢â‚¬Ëœcloudflare.comÃ¢â‚¬â„¢ is the domain name, while Ã¢â‚¬ËœhttpsÃ¢â‚¬â„¢ is the protocol and Ã¢â‚¬Ëœ/learning/Ã¢â‚¬â„¢ is the path to a specific page on the website.</p><figure class=\"image\"><img style=\"aspect-ratio:1068/792;\" src=\"/assets/img/uploads/1708066215_how-do-domain-names-work.png\" width=\"1068\" height=\"792\"></figure>'),
(45, 'Legal space building', 'legal-space-building', 'false', '<h2>Legal space building</h2><p>Before discussing the right to space on land more deeply, one needs to know in advance the definition of the space on the land itself. RAT is the space above the land surface that is used for certain activities whose control, ownership, use and utilization are separate from the control, ownership, use and utilization of land plot. So, if for example we have ownership of right of management or any land rights, with a certain limit, there is also a space on the land separated from its underlying right.</p><p>To make it easier to imagine the meaning and visualization of the RAT and RBT, we can imagine the existence of different layers and dimensions in each segment where each layer has its own rules. The rights on (surface) land have their own provisions, as well as the RAT and RBT. This is different from the previous rule, where we can only have rights to 1 dimension, namely the rights over (surface) land.</p><figure class=\"image\"><img style=\"aspect-ratio:850/576;\" src=\"/assets/img/uploads/1708067401_Building-Legal-Space-3D-including-Premises-3D-Building-Common-Part-3D-and.png\" width=\"850\" height=\"576\"></figure><p>Then how is the granting of land rights/right of management in the upper land space? Is it true that we can have space?</p><p>Provisions regarding the granting of land rights/right of management on space on land are regulated in paragraph (4) of Job Creation Law. Under Article 146 of the Job Creation Law, land or space formed by space on land used for certain activities may be granted several rights, such as:</p><ul><li>right to build;&nbsp;</li><li>right of use; or&nbsp;</li><li>right of management.</li></ul><p>Then what about the limits of ownership of the upper land space? To what extent can the upper ground space be owned? By the holder of the right of management, the land is given in accordance with the basic building coefficient (KDB), building floor coefficient (KLB) and adjusted to the spatial plan. Therefore, this allows for different provisions in each region, province, and region, because of course each region will have different spatial plans.</p><p>Further provisions regarding RAT are regulated in the Government Regulation No. 18 of 2021 (GR 18/2021) which is divided into 4 parts, including:</p><ul><li>Part 1 (Articles 74 and 75 concerning upper space on land objects), regulates:</li></ul><ol><li>The use and utilization of land rights is limited by height limits according to the KDB and KLB;</li><li>The depth limit is regulated in the spatial plan or up to a depth of 30 (thirty) meters from the land surface in the event that it has not been regulated in the spatial plan;</li><li>If there is utilization of oil and gas resources as well as minerals and coal, land rights in the underground space cannot be granted.</li></ol><ul><li>Part 2 (Emergence of right of Management, Right to Build, Right of Use in the upper space on land)<br>These provisions are regulated in the second part of the GR 18/2021, namely, under the Articles 76 until 80;</li><li>Part 3 (Subject, Time Period, Encumbrance, Transfer, Release, Cancellation of Right of Management, Right to Build and Right of Use on upper space on land)</li></ul><p>Provisions regarding the subject, the period, assignment, transfer and release, and cancellation of right of management, right to build, and right of use shall apply <i>mutatis mutandis</i> to the provisions regarding the subject, time period, assignment, transfer and release, and cancellation of right of management, right to build, and the right to use over the RAT;</p><ul><li>Part 4 (Removal of Management Rights, Right to Build and Right of Use in RAT)</li></ul><p>Regarding the details of the provisions and several conditions related to the removal of right of management, right to build, and right of use are regulated in Articles 82 and 83 of GR 18/2021.<br>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', '$2y$10$bG4QsXup/sKlS0tD8Jv5l.NcgoUYP0ZH3S7B4X1LDIFA1ZhOE9sOu', '2024-01-27 14:11:39', '2024-01-28 01:45:41'),
(47, 'yantobudisusanto@gmail.com', '$2y$10$syLTNdl/hH288qSb9WqzCOjscBT1hLWPJN3R5ikH4P2g6FJDjNhXK', '2024-02-06 02:55:44', '2024-02-06 02:55:44'),
(52, 'yantobudisusanto72@mail.ugm.ac.id', '$2y$10$gNOLeLBoQjDABcCJohZO6ujDRrx4S0gIc7Ap/cdEYksfsshkSzWc6', '2024-08-11 09:47:22', '2024-08-11 09:47:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `critics`
--
ALTER TABLE `critics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_parcel_table`
--
ALTER TABLE `land_parcel_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parcel_id` (`parcel_id`);

--
-- Indexes for table `legal_objects_table`
--
ALTER TABLE `legal_objects_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linked_uri`
--
ALTER TABLE `linked_uri`
  ADD KEY `object_id` (`object_id`),
  ADD KEY `id_keyword` (`id_keyword`);

--
-- Indexes for table `managements_table`
--
ALTER TABLE `managements_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renters_tenants`
--
ALTER TABLE `renters_tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms_table`
--
ALTER TABLE `rooms_table`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`),
  ADD KEY `organizer_id` (`organizer_id`),
  ADD KEY `parcel_id` (`legal_object_id`) USING BTREE;

--
-- Indexes for table `tenants_table`
--
ALTER TABLE `tenants_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_number` (`name_number`);

--
-- Indexes for table `uri_table`
--
ALTER TABLE `uri_table`
  ADD PRIMARY KEY (`id_keyword`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `critics`
--
ALTER TABLE `critics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `land_parcel_table`
--
ALTER TABLE `land_parcel_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `managements_table`
--
ALTER TABLE `managements_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `renters_tenants`
--
ALTER TABLE `renters_tenants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tenants_table`
--
ALTER TABLE `tenants_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `uri_table`
--
ALTER TABLE `uri_table`
  MODIFY `id_keyword` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `linked_uri`
--
ALTER TABLE `linked_uri`
  ADD CONSTRAINT `FK_linked_uri_legal_objects_table` FOREIGN KEY (`object_id`) REFERENCES `legal_objects_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_linked_uri_uri_table` FOREIGN KEY (`id_keyword`) REFERENCES `uri_table` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `renters_tenants`
--
ALTER TABLE `renters_tenants`
  ADD CONSTRAINT `FK_renters_tenants_rooms_table` FOREIGN KEY (`room_id`) REFERENCES `rooms_table` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_renters_tenants_tenants_table` FOREIGN KEY (`tenant_id`) REFERENCES `tenants_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms_table`
--
ALTER TABLE `rooms_table`
  ADD CONSTRAINT `FK_rooms_table_legal_objects_table` FOREIGN KEY (`legal_object_id`) REFERENCES `legal_objects_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rooms_table_managements_table` FOREIGN KEY (`organizer_id`) REFERENCES `managements_table` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
