-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 07:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trade_track`
--
CREATE DATABASE IF NOT EXISTS `trade_track` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trade_track`;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `role` enum('0','1','2','3') NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `role`, `title`, `message`, `date`, `time`) VALUES
(13, '0', 'Scheduled System Maintenance - Security patch', 'We would like to inform you that our system will undergo scheduled maintenance on 9th of December from 12 pm to 12:30 am. During this time, some features may be unavailable. We apologize for any inconvenience this may cause and appreciate your understanding as we work to enhance system performance. Thank you for your patience. ( Team Trade Track)', '2024-12-02', '09:54:00'),
(14, '1', 'Schedule System Maintenance (Product update)', 'Dear valued Customer, We would like to inform you that our system will undergo scheduled maintenance on 9th of December from 12 pm to 12:30 am. During this time, some features may be unavailable. We apologize for any inconvenience this may cause and appreciate your understanding as we work to enhance system performance. Thank you for your patience.(Samudu traders) ( Powered by Team Trade Track)', '2024-12-02', '09:53:45'),
(16, '0', 'Warm Wishes for the Season!', 'Dear valued Customers,\r\nAs the holiday season approaches, we would like to extend our warmest wishes to you and your families. Thank you for being a valued part of our community. Happy Holidays. (Team Trade Track) ', '2024-12-02', '09:55:56'),
(17, '1', 'Seasonal greetings', 'Dear Shop Owners,\r\nAs the Christmas season approaches, we would like to extend our warmest wishes to you and your families. Thank you for being a valued part of our community. Happy Holidays. (Team Trade Track) ', '2024-12-02', '09:57:51'),
(18, '2', 'Happy holidays ', 'Dear Manufacturers,\r\nAs the holiday season approaches, we would like to extend our warmest wishes to you and your families. Thank you for being a valued part of our community. Happy Holidays. (Team Trade Track) ', '2024-12-02', '09:57:04'),
(19, '3', 'Merry Christmas!', 'Dear Distributors,\r\nAs the holiday season approaches, we would like to extend our warmest wishes to you and your families. Thank you for being a valued part of our community. Happy shopping. (Team Trade Track) ', '2024-12-02', '09:58:41'),
(21, '1', 'Important Update: Changes of shop owner protection', 'Dear User, We have recently updated our \"Shop owner protection\" policy to align with industry standards and better serve our users. The updated policy will take effect from 9th of December 2024.', '2024-12-02', '10:03:56'),
(25, '0', 'holiday', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2024-12-02', '15:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime(),
  `cus_phone` varchar(10) DEFAULT NULL,
  `so_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `date`, `time`, `cus_phone`, `so_phone`) VALUES
(220, '2025-02-12', '18:54:44', '0770000000', '0112223333'),
(221, '2025-02-12', '18:55:49', NULL, '0112223333'),
(222, '2025-02-12', '19:21:12', '0770000000', '0112223333'),
(223, '2025-02-12', '19:59:13', '0770000000', '0112223333'),
(224, '2025-02-12', '20:16:04', NULL, '0112223333'),
(225, '2025-02-12', '20:48:26', NULL, '0112223333'),
(226, '2025-02-12', '22:14:53', '0770000000', '0112223333'),
(227, '2025-02-12', '22:21:11', '0770000000', '0112223333'),
(228, '2025-02-12', '22:24:32', '0123456789', '0112223333'),
(229, '2025-02-19', '21:55:04', '0770000000', '0112223333'),
(230, '2025-02-19', '21:57:41', '0770000000', '0112223333'),
(232, '2025-02-19', '22:10:46', '0770000000', '0112223333'),
(233, '2025-02-19', '22:13:12', NULL, '0112223333'),
(234, '2025-02-20', '17:19:16', NULL, '0112223333'),
(235, '2025-02-20', '17:19:54', NULL, '0112223333'),
(236, '2025-04-05', '09:00:33', '0987654321', '0112223333'),
(237, '2025-04-05', '09:26:42', '0987654321', '0112223333'),
(238, '2025-04-05', '09:29:13', '0123456789', '0112223333'),
(239, '2025-04-05', '09:40:45', NULL, '0112223333'),
(240, '2025-04-05', '12:00:42', NULL, '0112223333'),
(241, '2025-04-05', '12:01:02', NULL, '0112223333'),
(242, '2025-04-05', '12:55:58', NULL, '0112223333'),
(243, '2025-04-05', '13:12:40', NULL, '0112223333'),
(244, '2025-04-06', '12:37:36', '0770000000', '0112223333'),
(245, '2025-04-06', '12:40:05', '0770000000', '0112223333'),
(246, '2025-04-06', '12:40:07', '0770000000', '0112223333'),
(247, '2025-04-06', '12:56:39', '0770000000', '0112223333'),
(248, '2025-04-06', '13:00:47', '0770000000', '0112223333'),
(249, '2025-04-06', '13:06:33', '0770000000', '0112223333'),
(250, '2025-04-06', '13:08:03', '0770000000', '0112223333'),
(251, '2025-04-06', '13:09:43', '0770000000', '0112223333'),
(252, '2025-04-06', '13:21:29', '0770000000', '0112223333'),
(253, '2025-04-06', '13:24:52', NULL, '0112223333'),
(254, '2025-04-06', '13:25:46', NULL, '0112223333'),
(269, '2025-04-12', '15:58:48', NULL, '0112223333'),
(270, '2025-04-12', '16:00:20', NULL, '0112223333'),
(277, '2025-04-12', '16:13:25', NULL, '0112223333'),
(279, '2025-04-12', '16:16:44', NULL, '0112223333'),
(280, '2025-04-12', '16:20:11', NULL, '0112223333'),
(281, '2025-04-12', '16:20:54', NULL, '0112223333'),
(283, '2025-04-15', '08:53:37', NULL, '0112223333'),
(291, '2025-04-15', '16:23:55', NULL, '0112223333'),
(298, '2025-04-15', '16:35:15', NULL, '0112223333'),
(299, '2025-04-15', '17:09:20', NULL, '0112223333'),
(300, '2025-04-15', '17:11:26', NULL, '0112223333'),
(301, '2025-04-15', '17:22:40', NULL, '0112223333'),
(304, '2025-04-16', '16:28:46', '0123456789', '0112223333'),
(305, '2025-04-16', '16:30:17', '0987654321', '0112223333'),
(306, '2025-04-16', '17:52:37', '0770000000', '0112223333'),
(307, '2025-04-16', '17:57:24', '0770000000', '0112223333'),
(308, '2025-04-16', '18:03:43', NULL, '0112223333'),
(310, '2025-04-16', '18:06:00', '0770000000', '0112223333'),
(311, '2025-04-16', '18:08:43', NULL, '0112223333'),
(312, '2025-04-16', '18:11:02', '0770000000', '0112223333'),
(313, '2025-04-21', '09:13:12', '0770000000', '0112223333'),
(314, '2025-04-21', '22:59:18', '0770000000', '0112223333'),
(316, '2025-04-21', '23:02:39', NULL, '0112223333'),
(318, '2025-04-21', '23:08:54', '0987654321', '0112223333'),
(319, '2025-04-21', '23:14:42', '0770000000', '0112223333'),
(320, '2025-04-25', '13:52:59', '0770000000', '0112223333'),
(321, '2025-04-25', '13:54:24', '0770000000', '0112223333'),
(322, '2025-04-27', '18:46:29', '0987654321', '0112223333'),
(323, '2025-04-27', '18:49:20', NULL, '0112223333'),
(324, '2025-04-27', '18:50:47', NULL, '0112223333'),
(325, '2025-04-27', '20:50:52', NULL, '0112223333'),
(331, '2025-04-27', '22:13:58', '0770000000', '0112223333'),
(332, '2025-04-27', '22:36:18', NULL, '0112223333'),
(333, '2025-04-27', '22:39:06', '0770000000', '0112223333'),
(334, '2025-04-28', '11:41:54', NULL, '0112223333'),
(335, '2025-04-28', '21:45:00', '0770000000', '0112223333'),
(336, '2025-04-28', '21:45:43', '0770000000', '0112223333'),
(337, '2025-04-28', '21:46:04', '0770000000', '0112223333');

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `bill_id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `sold_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`bill_id`, `barcode`, `quantity`, `sold_price`) VALUES
(220, '4791010040044', 4, 0),
(221, '4791010040044', 9, 0),
(222, '4791010040044', 9, 200),
(223, '4791010040044', 3, 200),
(223, '4791010040044', 3, 400),
(224, '4791010040044', 3, 100),
(224, '4791010040044', 12, 200),
(225, '4791010040044', 24, 200.5),
(226, '4791010040044', 3, 50),
(226, '4791010040044', 2, 200),
(227, '4791010040044', 4, 200),
(228, '4791010040044', 3, 200),
(229, '4790015950624', 200, 1050),
(230, '4790015950624', 10, 1050),
(232, '4790015950624', 5, 1050),
(233, '4790015950624', 4, 1050),
(234, '4791034072663', 89, 220),
(235, '4791034072663', 89, 220),
(236, '4791010040044', 15, 200),
(237, '4791010040044', 15, 200),
(238, '4791010040044', 5, 200),
(239, '4791010040044', 10, 200),
(240, '4791010040044', 5, 200),
(241, '4791010040044', 5, 200),
(242, '4791010040044', 15, 200),
(243, '4791010040044', 8, 200),
(244, '4792081031580', 2, 135),
(245, '4791111102948', 1, 240),
(246, '4791111102948', 1, 240),
(247, '4796020480217', 2, 1100),
(248, '4791111102948', 3, 240),
(249, '4791111102948', 4, 240),
(250, '4790015950624', 3, 1050),
(251, '8888101611705', 4, 400),
(252, '4790015950624', 5, 1050),
(252, '4791010040044', 5, 200),
(252, '4791034072663', 10, 220),
(252, '4791111102948', 10, 240),
(252, '4792024019545', 5, 780),
(252, '4792081031580', 15, 135),
(252, '4792173000005', 10, 80),
(252, '4796020480217', 2, 1100),
(252, '8888101611705', 5, 400),
(253, '4790015950624', 7, 1050),
(254, '4790015950624', 20, 1050),
(269, '4790015950624', 1, 1050),
(270, '4790015950624', 1, 1050),
(277, '4790015950624', 11, 1050),
(279, '4790015950624', 3, 1050),
(280, '4790015950624', 3, 1050),
(281, '4790015950624', 3, 1050),
(298, '4790015950624', 9, 1050),
(299, '4790015950624', 1, 1050),
(300, '4790015950624', 500, 1050),
(301, '4790015950624', 234, 1050),
(304, '4790015950624', 2, 1050),
(305, '4790015950624', 1, 1050),
(306, '4790015950624', 4, 1050),
(307, '4790015950624', 3, 1050),
(308, '4790015950624', 3, 1050),
(310, '4790015950624', 7, 1050),
(311, '4790015950624', 10, 50),
(312, '4796010610921', 5, 910),
(312, 'sug', 10, 0),
(313, '4790015950624', 2, 1050),
(313, '4796000301471', 10, 80),
(320, '4790015950624', 4, 1050),
(321, '4796020480217', 2, 1100),
(333, '4796020480217', 1, 1100),
(335, '4792225001189', 2, 1050),
(337, '4792225001189', 3, 1050);

-- --------------------------------------------------------

--
-- Table structure for table `bill_unique_items`
--

CREATE TABLE `bill_unique_items` (
  `bill_id` int(11) NOT NULL,
  `product_code` varchar(2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_unique_items`
--

INSERT INTO `bill_unique_items` (`bill_id`, `product_code`, `quantity`, `sold_price`) VALUES
(283, 'ap', 10, 130),
(291, 'ap', 9, 130),
(298, 'ap', 9, 130),
(301, 'ap', 111, 130),
(304, 'bs', 23, 77),
(305, 'sp', 5, 100),
(306, 'ap', 2, 130),
(306, 'mm', 3, 300),
(306, 'sp', 1, 100),
(307, 'ap', 2, 130),
(307, 'bs', 4, 77),
(307, 'mm', 1, 300),
(308, 'ap', 4, 130),
(308, 'mm', 2, 300),
(308, 'sp', 3, 100),
(310, 'ap', 3, 130),
(310, 'mm', 5, 300),
(311, 'ap', 8, 130),
(311, 'mm', 3, 30),
(313, 'ap', 5, 130),
(314, 'ap', 12, 130),
(316, 'ap', 5, 130),
(318, 'nc', 2, 450),
(319, 'nc', 3, 450),
(320, 'ap', 3, 130),
(322, 'ma', 5, 100),
(323, 'ma', 3, 100),
(324, 'ma', 2, 100),
(325, 'ma', 4, 100),
(331, 'ma', 2, 100),
(332, 'ma', 10, 100),
(333, 'ma', 4, 100),
(334, 'ap', 2, 130),
(335, 'ap', 2, 130),
(336, 'sp', 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `c_from` varchar(10) NOT NULL,
  `c_to` varchar(10) NOT NULL,
  `text` longtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `c_from`, `c_to`, `text`, `date`, `time`) VALUES
(65, '0770000000', '0112223333', 'Hi', '2025-04-28', '11:53:05'),
(66, '0112223333', '0123456789', 'hello', '2025-04-28', '11:54:06'),
(67, '0770000000', '0112223333', 'hello', '2025-04-28', '11:54:12'),
(68, '0770000000', '0112223333', 'hfs', '2025-04-28', '11:54:23'),
(69, '0770000000', '0112223333', 'hi', '2025-04-28', '12:40:01'),
(70, '0112223333', '0770000000', 'hello', '2025-04-28', '12:40:06'),
(71, '0770000000', '0112223333', 'hi', '2025-04-28', '12:40:21'),
(72, '0112223333', '0123456789', 'hello', '2025-04-28', '12:40:27'),
(73, '0770000000', '0112223333', 'hello', '2025-04-28', '12:40:51'),
(74, '0770000000', '0112223333', 'apple', '2025-04-28', '12:43:05'),
(75, '0112223333', '0770000000', 'hi', '2025-04-28', '13:09:51'),
(76, '0770000000', '0112223333', 'hello', '2025-04-28', '13:10:07'),
(77, '0770000000', '0112223333', 'hi', '2025-04-28', '13:16:46'),
(78, '0112223333', '0770000000', 'hello', '2025-04-28', '13:16:51'),
(79, '0770000000', '0112223333', 'hi', '2025-04-28', '13:17:52'),
(80, '0112223333', '0770000000', 'hello', '2025-04-28', '13:17:57'),
(81, '0770000000', '0112223333', 'hi', '2025-04-28', '13:20:40'),
(82, '0770000000', '0112223333', 'hello', '2025-04-28', '13:20:47'),
(83, '0987654321', '0112223333', 'hi', '2025-04-28', '13:21:06'),
(84, '0987654321', '0112223333', 'hello', '2025-04-28', '13:21:14'),
(85, '0112223333', '0987654321', 'hi', '2025-04-28', '13:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `chat_cus_so`
--

CREATE TABLE `chat_cus_so` (
  `message_id` int(11) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `direction` enum('cus_so','so_cus') NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_dis_man`
--

CREATE TABLE `chat_dis_man` (
  `message_id` int(11) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `direction` enum('sa_su','su_sa') NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_so_dis`
--

CREATE TABLE `chat_so_dis` (
  `message_id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `direction` enum('so_sa','sa_so') NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributer_orders`
--

CREATE TABLE `distributer_orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `dis_phone` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `status` enum('Ready','Pending','Done','Processing') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributer_orders`
--

INSERT INTO `distributer_orders` (`order_id`, `date`, `time`, `dis_phone`, `man_phone`, `status`) VALUES
(31, '2024-12-01', '22:25:05', '0372222690', '0771111111', 'Ready'),
(32, '2024-12-01', '23:01:06', '0372222690', '0771111111', 'Processing'),
(33, '2024-12-02', '11:35:05', '0372222690', '0771111111', 'Processing'),
(37, '2024-12-26', '15:09:28', '0372222690', '0771111111', 'Processing'),
(38, '2024-12-26', '17:07:35', '0372222690', '0771111111', 'Processing'),
(39, '2025-01-07', '12:36:04', '0372222690', '0771111111', 'Pending'),
(40, '2025-04-06', '14:46:01', '0372222690', '0771111111', 'Processing'),
(41, '2025-04-28', '11:44:46', '0372222690', '0771111111', 'Pending'),
(42, '2025-04-28', '11:45:37', '0372222690', '0771111111', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `distributer_order_items`
--

CREATE TABLE `distributer_order_items` (
  `order_id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributer_order_items`
--

INSERT INTO `distributer_order_items` (`order_id`, `barcode`, `quantity`) VALUES
(31, '4790015950624', 200),
(31, '4791034015318', 150),
(31, '4791034070287', 130),
(31, '4791034072366', 400),
(32, '4790015950624', 100),
(32, '4791034015318', 20),
(32, '4791034070287', 100),
(32, '4791034072366', 30),
(33, '4790015950624', 300),
(33, '4791034015318', 100),
(37, '4791034015318', 56),
(38, '4791034070287', 600),
(39, '4790015950624', 12),
(40, '4790015950624', 600),
(41, '4790015950624', 2),
(42, '4791034015318', 200);

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `dis_phone` varchar(10) NOT NULL,
  `dis_busines_name` varchar(255) NOT NULL,
  `dis_busines_address` varchar(255) NOT NULL,
  `man_phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`dis_phone`, `dis_busines_name`, `dis_busines_address`, `man_phone`) VALUES
('0372222690', 'Sumudu Bedaharinno', 'No.112, High level road, Nugegoda.', '0771111111'),
('0718976543', 'ghibibibin', 'No.23/A, Negombo road, Kurunegala.', '0771111111'),
('0774343434', 'Hamdhi Distributors', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `distributor_stocks`
--

CREATE TABLE `distributor_stocks` (
  `dis_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `low_quantity_level` float NOT NULL,
  `quantity_shown` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributor_stocks`
--

INSERT INTO `distributor_stocks` (`dis_phone`, `barcode`, `quantity`, `low_quantity_level`, `quantity_shown`) VALUES
('0372222690', '4790015950624', 868, 50, 211),
('0372222690', '4791034015318', 389, 400, 0),
('0372222690', '4791034070287', 400, 0, 0),
('0372222690', '4791034072366', 150, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dis_man_payment`
--

CREATE TABLE `dis_man_payment` (
  `payment_id` int(11) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `ammount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dis_man_payment`
--

INSERT INTO `dis_man_payment` (`payment_id`, `dis_phone`, `man_phone`, `ammount`, `status`, `date`, `time`) VALUES
(1, '0372222690', '0771111111', 1000, 0, '2025-04-25', '16:09:43'),
(2, '0372222690', '0771111111', 1000, 0, '2025-04-25', '16:11:22'),
(3, '0372222690', '0771111111', 50000, 0, '2025-04-25', '18:40:24'),
(4, '0372222690', '0771111111', 0, 0, '2025-04-26', '12:10:53'),
(5, '0372222690', '0771111111', 2500, 0, '2025-04-27', '02:51:21'),
(6, '0372222690', '0771111111', 10000, 0, '2025-04-28', '19:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `dis_req`
--

CREATE TABLE `dis_req` (
  `id` int(11) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dis_req`
--

INSERT INTO `dis_req` (`id`, `dis_phone`, `man_phone`, `date`, `time`) VALUES
(10, '0372222690', '0771111111', '2025-04-28', '19:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_customers`
--

CREATE TABLE `loyalty_customers` (
  `so_phone` varchar(10) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `wallet` float NOT NULL DEFAULT 0,
  `since` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loyalty_customers`
--

INSERT INTO `loyalty_customers` (`so_phone`, `cus_phone`, `wallet`, `since`) VALUES
('0112223333', '0123456789', 21749, '2024-10-24'),
('0112223333', '0712345678', 1500, '2024-10-24'),
('0112223333', '0756789123', 2000, '2024-10-24'),
('0112223333', '0770000000', -2410, '2025-04-27'),
('0112223333', '0781234567', 0, '2025-02-11'),
('0112223333', '0789988776', 0, '2024-10-24'),
('0112223333', '0897867564', 0, '2025-04-05'),
('0112223333', '0987654321', 11610, '2024-10-24'),
('0701234567', '0123456789', 0, '2024-11-18'),
('0711234567', '0123456789', 0, '2024-11-18'),
('0714567890', '0123456789', 0, '2024-11-18');

--
-- Triggers `loyalty_customers`
--
DELIMITER $$
CREATE TRIGGER `check_user_role_on_insert` BEFORE INSERT ON `loyalty_customers` FOR EACH ROW IF (SELECT role FROM users WHERE phone = NEW.cus_phone) != 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'The user must have the role of customer to be added as a loyalty customer.';
    END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_user_role_on_update` BEFORE UPDATE ON `loyalty_customers` FOR EACH ROW IF (SELECT role FROM users WHERE phone = NEW.cus_phone) != 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'The user must have the role of customer to be added as a loyalty customer.';
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_requests`
--

CREATE TABLE `loyalty_requests` (
  `cus_phone` varchar(10) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loyalty_requests`
--

INSERT INTO `loyalty_requests` (`cus_phone`, `so_phone`, `created_time`) VALUES
('0770000000', '0701234567', '2025-04-26 13:12:16'),
('0770000000', '0702345678', '2025-01-20 20:16:52'),
('0770000000', '0711234567', '2025-01-20 20:08:36'),
('0770000000', '0712345678', '2025-01-28 11:08:03'),
('0770000000', '0713456789', '2025-01-20 20:17:02'),
('0770000000', '0749876543', '2025-04-25 11:48:01'),
('0770000000', '1153294893', '2025-04-25 11:48:12');

--
-- Triggers `loyalty_requests`
--
DELIMITER $$
CREATE TRIGGER `check_user_role_on_insert_lr` BEFORE INSERT ON `loyalty_requests` FOR EACH ROW IF (SELECT role FROM users WHERE phone = NEW.cus_phone) != 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'The user must have the role of customer to be added as a loyalty customer.';
    END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_user_role_on_update_lr` BEFORE UPDATE ON `loyalty_requests` FOR EACH ROW IF (SELECT role FROM users WHERE phone = NEW.cus_phone) != 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'The user must have the role of customer to be updated as a loyalty customer.';
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `man_phone` varchar(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`man_phone`, `company_name`, `company_address`) VALUES
('0333333333', 'Jafna stores', 'Jafna'),
('0771111111', 'Maliban Biscuit Manufactories (Pvt) Limited ', '389 Galle Rd, Dehiwala-Mount Lavinia');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_stock`
--

CREATE TABLE `manufacturer_stock` (
  `barcode` varchar(13) NOT NULL,
  `quantity` int(11) NOT NULL,
  `low_stock_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer_stock`
--

INSERT INTO `manufacturer_stock` (`barcode`, `quantity`, `low_stock_level`) VALUES
('4790015950624', 10000, 10000),
('4791034015318', 30000, 10000),
('4791034070287', 25000, 10000),
('4791034072366', 20000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pending_product_requests`
--

CREATE TABLE `pending_product_requests` (
  `id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `bulk_price` float NOT NULL,
  `pic_format` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `proof_format` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_product_requests`
--

INSERT INTO `pending_product_requests` (`id`, `barcode`, `product_name`, `unit_price`, `bulk_price`, `pic_format`, `man_phone`, `proof_format`) VALUES
(4, '9187265341231', 'Maliban Sun Cracker 100g', 180, 140, '', '0771111111', '');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order`
--

CREATE TABLE `pre_order` (
  `so_phone` varchar(10) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `pre_order_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Ready','Picked','Rejected','Updated','Canceled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_order`
--

INSERT INTO `pre_order` (`so_phone`, `cus_phone`, `pre_order_id`, `date_time`, `status`) VALUES
('0112223333', '0770000000', 131, '2025-04-27 02:12:55', 'Pending'),
('0112223333', '0770000000', 148, '2025-04-27 11:35:01', 'Pending'),
('0112223333', '0770000000', 149, '2025-04-27 17:05:21', 'Pending'),
('0112223333', '0770000000', 150, '2025-04-27 17:05:42', 'Pending'),
('0112223333', '0770000000', 153, '2025-04-27 18:45:22', 'Canceled'),
('0112223333', '0770000000', 154, '2025-04-27 18:48:48', 'Canceled'),
('0112223333', '0770000000', 155, '2025-04-27 18:50:30', 'Pending'),
('0112223333', '0770000000', 156, '2025-04-27 20:38:52', 'Pending'),
('0112223333', '0770000000', 157, '2025-04-27 20:40:05', 'Pending'),
('0112223333', '0770000000', 158, '2025-04-27 20:41:52', 'Pending'),
('0112223333', '0770000000', 159, '2025-04-27 20:42:56', 'Pending'),
('0112223333', '0770000000', 160, '2025-04-27 20:47:36', 'Canceled'),
('0112223333', '0770000000', 161, '2025-04-27 20:49:14', 'Picked'),
('0112223333', '0770000000', 162, '2025-04-27 22:19:52', 'Canceled'),
('0112223333', '0770000000', 163, '2025-04-27 22:26:06', 'Canceled'),
('0112223333', '0770000000', 164, '2025-04-27 22:28:19', 'Canceled'),
('0112223333', '0770000000', 165, '2025-04-27 22:33:12', 'Canceled'),
('0112223333', '0770000000', 166, '2025-04-27 22:34:20', 'Canceled'),
('0112223333', '0770000000', 167, '2025-04-27 22:35:37', 'Picked'),
('0112223333', '0770000000', 168, '2025-04-27 22:45:19', 'Canceled'),
('0112223333', '0770000000', 169, '2025-04-27 23:01:55', 'Canceled'),
('0112223333', '0770000000', 170, '2025-04-27 23:23:03', 'Canceled'),
('0112223333', '0770000000', 171, '2025-04-27 23:24:38', 'Canceled'),
('0112223333', '0770000000', 172, '2025-04-27 23:36:37', 'Canceled'),
('0112223333', '0770000000', 173, '2025-04-27 23:44:12', 'Rejected'),
('0112223333', '0770000000', 174, '2025-04-27 23:52:25', 'Canceled'),
('0112223333', '0770000000', 175, '2025-04-28 11:38:49', 'Picked'),
('0112223333', '0770000000', 176, '2025-04-28 20:47:02', 'Pending'),
('0112223333', '0770000000', 177, '2025-04-28 20:48:21', 'Picked'),
('0112223333', '0770000000', 178, '2025-04-28 20:48:44', 'Picked'),
('0112223333', '0781234567', 84, '2025-02-11 14:16:32', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order_items`
--

CREATE TABLE `pre_order_items` (
  `pre_order_id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` int(11) NOT NULL,
  `po_unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_order_items`
--

INSERT INTO `pre_order_items` (`pre_order_id`, `barcode`, `quantity`, `po_unit_price`) VALUES
(84, '4792173000005', 1, 80),
(131, '4791010040044', 1, 200),
(131, '4792225001189', 2, 1050),
(131, '4796000301471', 4, 80),
(131, '4796020480217', 2, 1100),
(148, '4796020480217', 2, 1100),
(150, '4796020480217', 1, 1100),
(154, '4796020480217', 2, 1100),
(156, '4796020480217', 1, 1100),
(166, '4796020480217', 2, 1100),
(167, '4796020480217', 1, 1100),
(168, '4796020480217', 2, 1100),
(170, '4796000301471', 5, 80),
(171, '4796000301471', 5, 80),
(172, '4796000301471', 1, 80),
(173, '4796000301471', 1, 80),
(174, '4796000301471', 3, 80),
(175, '4792225001189', 3, 1050),
(176, '4792225001189', 2, 1050),
(178, '4792225001189', 2, 1050);

-- --------------------------------------------------------

--
-- Table structure for table `pre_order_unique_items`
--

CREATE TABLE `pre_order_unique_items` (
  `pre_order_id` int(11) NOT NULL,
  `product_code` varchar(2) NOT NULL,
  `po_quantity` float NOT NULL,
  `po_unit_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_order_unique_items`
--

INSERT INTO `pre_order_unique_items` (`pre_order_id`, `product_code`, `po_quantity`, `po_unit_price`) VALUES
(148, 'sp', 4, 100),
(149, 'ap', 1, 130),
(153, 'ma', 10, 100),
(154, 'ma', 5, 100),
(155, 'ma', 2, 100),
(157, 'ap', 5, 130),
(158, 'ap', 5, 130),
(159, 'ap', 6, 130),
(160, 'ma', 1, 100),
(161, 'ma', 2, 100),
(162, 'ma', 7, 100),
(163, 'ma', 7, 100),
(164, 'ma', 7, 100),
(165, 'ma', 7, 100),
(167, 'ma', 4, 100),
(168, 'ma', 1, 100),
(169, 'ma', 2, 100),
(170, 'ma', 1, 100),
(173, 'ma', 1, 100),
(174, 'ma', 3, 100),
(177, 'sp', 2, 100),
(178, 'ap', 2, 130);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `barcode` varchar(13) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit_price` float NOT NULL,
  `bulk_price` float NOT NULL,
  `pic_format` varchar(10) DEFAULT 'jpeg',
  `man_phone` varchar(10) DEFAULT NULL,
  `unit_type` enum('Packets','Bottles','Kg','L','Tubes','Cans','Bars','Pieces','Units','Boxes') NOT NULL DEFAULT 'Units'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `product_name`, `unit_price`, `bulk_price`, `pic_format`, `man_phone`, `unit_type`) VALUES
('4790015950624', 'MALIBAN Full Cream Milk Powder 400g', 1050, 900, 'png', '0771111111', 'Packets'),
('4791010040044', 'NINJA POWER 12 0.01% MOSQUITO COILS', 200, 150, 'jpeg', NULL, 'Packets'),
('4791034015318', 'Maliban Krisco Snack Crackers Biscuits (170g)', 380, 280, 'jpg', '0771111111', 'Packets'),
('4791034070287', 'Maliban Chocolate Puff Biscuit 200g', 260, 180, 'png', '0771111111', 'Packets'),
('4791034072366', 'MALIBAN Real Chocolate Cream Biscuit', 240, 180, 'jpeg', '0771111111', 'Packets'),
('4791034072663', 'Maliban Orange Cream Biscuit 200g', 220, 180, 'webp', NULL, 'Units'),
('4791111102948', 'CLOGARD fluoridated Toothpaste 120g', 240, 190, 'jpeg', NULL, 'Tubes'),
('4792024019545', 'NESTOMOALT 450g', 780, 670, 'jpeg', NULL, 'Packets'),
('4792081031580', 'LUX soap 70g', 135, 100, 'jpeg', NULL, 'Bars'),
('4792173000005', 'WIJAYA Chilli Pieces 50g', 80, 65, 'jpeg', NULL, 'Packets'),
('4792225001189', 'DIAMOND full cream milk powder 400g', 1050, 900, 'jpeg', NULL, 'Packets'),
('4796000301471', 'MATARA FREELAN Roasted Curry Powder 50g', 100, 80, 'jpeg', NULL, 'Packets'),
('4796010610921', 'PURE DALE Full cream milk powder', 910, 800, 'jpeg', NULL, 'Packets'),
('4796020480217', 'ARALIYA PREMIUM NADU RICE 5kg', 1100, 1000, 'jpeg', NULL, 'Packets'),
('8888101611705', 'MUNCHEE Cheese Buttons Biscuits', 400, 320, 'jpeg', NULL, 'Boxes'),
('coc', 'Coconuts', 0, 0, NULL, NULL, 'Units'),
('egg', 'Eggs', 30, 0, NULL, NULL, 'Units'),
('oil', 'Coconut Oil', 0, 0, NULL, NULL, 'Bottles'),
('sug', 'Sugar', 0, 0, NULL, NULL, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `so_phone` varchar(10) NOT NULL,
  `shop_name` varchar(20) NOT NULL,
  `shop_address` varchar(30) NOT NULL,
  `cash_drawer_balance` float NOT NULL,
  `non_registerd_creditors` float NOT NULL,
  `shop_pic_format` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`so_phone`, `shop_name`, `shop_address`, `cash_drawer_balance`, `non_registerd_creditors`, `shop_pic_format`) VALUES
('0000000111', 'New Dharmawamsa Stor', 'Main Road,  Rathnapura town', 0, 0, '.jpg'),
('0112223333', 'Gamunu Stores', 'No. 13, Negombo Road, Kurunega', 5840, 114664, '.jpg'),
('0122334456', 'Janaka stores', 'No.6, High level road, Nugegod', 0, 0, '.jpg'),
('0222222222', 'Himantha Stores', 'Pogahawela', 0, 0, NULL),
('0701234567', 'Jaffna Stores', 'No. 55, Stanley Road, Jaffna', 18000, 45000, '.webp'),
('0702345678', 'Vavuniya Market', 'No. 45, Bazaar Street, Vavuniy', 15000, 48000, '.jpg'),
('0711234567', 'Kandy Grocers', 'No. 12, Peradeniya Road, Kandy', 10000, 50000, '.jpeg'),
('0712345678', 'Colombo Super', 'No. 45, Galle Road, Colombo 3', 15000, 60000, '.jpg'),
('0713456789', 'Polonnaruwa Market', 'No. 9, Lake Road, Polonnaruwa', 17000, 40000, '.jpg'),
('0714567890', 'Kurunegala Supplies', 'No. 10, Dambulla Road, Kuruneg', 19000, 45000, '.jpg'),
('0718765432', 'Gampaha Groceries', 'No. 7, Miriswatte Road, Gampah', 18000, 55000, '.jpg'),
('0719876543', 'Ratnapura Foods', 'No. 25, Gem Street, Ratnapura', 17000, 52000, ''),
('0721234567', 'Nuwara Eliya Greens', 'No. 50, Bazaar Street, Nuwara ', 20000, 48000, ''),
('0723456789', 'Galle Mart', 'No. 8, Wakwella Road, Galle', 20000, 40000, ''),
('0731234567', 'Trincomalee Fresh', 'No. 18, Main Street, Trincomal', 16000, 46000, ''),
('0734567890', 'Puttalam Grocers', 'No. 14, Station Road, Puttalam', 14000, 51000, ''),
('0741234567', 'Anuradhapura Central', 'No. 5, New Town Road, Anuradha', 13000, 52000, ''),
('0749876543', 'Batticaloa Central', 'No. 12, Bar Road, Batticaloa', 20000, 43000, ''),
('0751234567', 'Matara Mini Mart', 'No. 23, Beach Road, Matara', 12000, 55000, ''),
('0759876543', 'Kalutara Foods', 'No. 16, Nagoda Road, Kalutara', 14000, 52000, ''),
('0761234567', 'Negombo Fresh Market', 'No. 19, Main Street, Negombo', 14000, 30000, ''),
('0762345678', 'Chilaw Stores', 'No. 30, New Bazaar, Chilaw', 18000, 39000, ''),
('0772345678', 'Badulla Bazaar', 'No. 34, Passara Road, Badulla', 11000, 62000, ''),
('0774567890', 'Hambantota Corner', 'No. 22, Tissa Road, Hambantota', 13000, 40000, ''),
('0775648392', 'Maple Shop', 'No.111/11, Maple street, Londo', 0, 0, NULL),
('1153294893', 'Amber Gilbert', 'Obcaecati molestiae ', 0, 0, '.jpg'),
('2416052903', 'Garrison Byers', 'In esse fugiat aliq', 0, 0, NULL),
('4995352045', 'Abigail Cain', 'Ut qui duis occaecat', 0, 0, '.jpg'),
('7747511805', 'Mufutau Tillman', 'Commodo voluptate au', 0, 0, '.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Delivering','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`order_id`, `date`, `time`, `status`, `so_phone`, `dis_phone`) VALUES
(6, '2025-04-06', '18:29:30', 'Delivered', '0112223333', '0372222690'),
(7, '2025-04-06', '18:31:53', 'Delivering', '0112223333', '0372222690'),
(11, '2025-04-11', '00:00:00', 'Delivered', '0112223333', NULL),
(12, '2025-04-12', '00:24:45', 'Delivered', '0112223333', NULL),
(13, '2025-04-12', '00:26:22', 'Delivered', '0112223333', NULL),
(14, '2025-04-12', '00:44:05', 'Delivered', '0112223333', NULL),
(15, '2025-04-12', '00:45:14', 'Delivered', '0112223333', NULL),
(16, '2025-04-12', '00:47:22', 'Delivered', '0112223333', NULL),
(17, '2025-04-12', '00:49:31', 'Delivered', '0112223333', NULL),
(18, '2025-04-12', '01:12:21', 'Delivered', '0112223333', NULL),
(19, '2025-04-12', '01:13:18', 'Delivered', '0112223333', NULL),
(20, '2025-04-12', '01:14:05', 'Delivered', '0112223333', NULL),
(21, '2025-04-12', '01:20:40', 'Delivered', '0112223333', NULL),
(22, '2025-04-12', '01:21:11', 'Delivered', '0112223333', NULL),
(23, '2025-04-12', '02:16:41', 'Delivered', '0112223333', NULL),
(24, '2025-04-12', '02:18:19', 'Delivered', '0112223333', NULL),
(25, '2025-04-12', '02:18:53', 'Delivered', '0112223333', NULL),
(26, '2025-04-12', '20:37:31', 'Delivered', '0112223333', NULL),
(36, '2025-04-16', '14:54:29', 'Delivered', '0112223333', NULL),
(37, '2025-04-16', '22:46:50', 'Delivered', '0112223333', NULL),
(38, '2025-04-16', '23:03:09', 'Cancelled', '0112223333', '0372222690'),
(39, '2025-04-16', '23:17:48', 'Delivered', '0112223333', NULL),
(40, '2025-04-16', '23:18:34', 'Delivered', '0112223333', NULL),
(41, '2025-04-16', '23:21:07', 'Pending', '0112223333', '0372222690'),
(42, '2025-04-16', '23:33:01', 'Pending', '0112223333', '0372222690'),
(43, '2025-04-16', '23:34:59', 'Pending', '0112223333', '0372222690'),
(44, '2025-04-21', '09:15:08', 'Delivered', '0112223333', NULL),
(45, '2025-04-24', '18:45:38', 'Delivered', '0112223333', NULL),
(46, '2025-04-24', '18:57:55', 'Delivered', '0112223333', NULL),
(47, '2025-04-24', '19:07:57', 'Delivered', '0112223333', NULL),
(48, '2025-04-24', '19:22:26', 'Delivered', '0112223333', NULL),
(49, '2025-04-24', '19:33:35', 'Delivered', '0112223333', NULL),
(50, '2025-04-26', '21:40:29', 'Delivered', '0112223333', NULL),
(51, '2025-04-26', '21:40:39', 'Delivered', '0112223333', NULL),
(52, '2025-04-26', '23:28:17', 'Delivered', '0112223333', '0372222690'),
(53, '2025-04-27', '00:15:46', 'Delivered', '0112223333', NULL),
(54, '2025-04-27', '18:43:07', 'Delivered', '0112223333', NULL),
(55, '2025-04-27', '18:51:13', 'Delivered', '0112223333', NULL),
(56, '2025-04-27', '20:46:29', 'Delivered', '0112223333', NULL),
(57, '2025-04-27', '20:48:38', 'Delivered', '0112223333', NULL),
(59, '2025-04-27', '22:41:17', 'Delivered', '0112223333', NULL),
(60, '2025-04-27', '22:41:27', 'Delivered', '0112223333', NULL),
(61, '2025-04-27', '22:43:41', 'Delivered', '0112223333', NULL),
(62, '2025-04-27', '22:43:49', 'Delivered', '0112223333', NULL),
(63, '2025-04-27', '22:43:58', 'Delivered', '0112223333', NULL),
(64, '2025-04-27', '22:45:02', 'Delivered', '0112223333', NULL),
(65, '2025-04-27', '23:20:49', 'Delivered', '0112223333', NULL),
(66, '2025-04-27', '23:27:01', 'Delivered', '0112223333', NULL),
(67, '2025-04-27', '23:42:53', 'Delivered', '0112223333', NULL),
(68, '2025-04-27', '23:43:04', 'Delivered', '0112223333', NULL),
(69, '2025-04-27', '23:51:27', 'Delivered', '0112223333', NULL),
(70, '2025-04-27', '23:51:45', 'Delivered', '0112223333', NULL),
(71, '2025-04-28', '10:18:08', 'Delivered', '0112223333', '0372222690'),
(72, '2025-04-28', '10:39:29', 'Delivered', '0112223333', '0372222690'),
(73, '2025-04-28', '22:00:08', 'Delivered', '0112223333', NULL),
(74, '2025-04-28', '22:40:06', 'Delivered', '0112223333', NULL),
(75, '2025-04-28', '23:48:51', 'Delivered', '0000000111', NULL),
(76, '2025-04-28', '23:53:25', 'Delivered', '0000000111', NULL),
(77, '2025-04-28', '23:55:32', 'Delivered', '0000000111', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_items`
--

CREATE TABLE `shop_order_items` (
  `order_id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `sold_bulk_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_order_items`
--

INSERT INTO `shop_order_items` (`order_id`, `barcode`, `quantity`, `sold_bulk_price`) VALUES
(6, '4790015950624', 111, 900),
(7, '4791034015318', 111, 280),
(11, '4792024019545', 100, 670),
(12, '4791111102948', 7, 190),
(13, '4796020480217', 4, 1000),
(14, '4792081031580', 11, 0),
(15, '4796000301471', 20, 0),
(16, '4796000301471', 5, 0),
(17, '4791034015318', 100, 200),
(18, '4791034070287', 11, 172.727),
(19, '4796010610921', 10, 800.1),
(20, '4796010610921', 3, 333.333),
(21, '4792225001189', 3, 3.33333),
(22, '4791034015318', 2, 277.5),
(23, '4791010040044', 33, 150),
(24, '4791034070287', 100, 180),
(25, '4796010610921', 77, 800),
(26, 'sug', 50, 460),
(38, '4790015950624', 100, 900),
(40, '4791034072663', 99, 180),
(41, '4790015950624', 35, 900),
(42, '4790015950624', 200, 900),
(43, '4790015950624', 20, 900),
(43, '4791034070287', 200, 180),
(43, '4791034072366', 40, 180),
(44, '4796000301471', 500, 80),
(50, '4796010610921', -100, 800),
(51, '4796010610921', 100, 800),
(52, '4791034072366', 300, 180),
(53, '4796010610921', 100, 800),
(61, '4796020480217', 4, 1000),
(62, '4796020480217', 4, 1000),
(63, '4796020480217', 10, 1000),
(64, '4796020480217', 10, 1000),
(65, '4796000301471', 10, 80),
(68, '4796000301471', 5, 80),
(69, '4796000301471', 5, 80),
(71, '4790015950624', 11, 900),
(72, '4790015950624', 10, 900),
(76, '4790015950624', 100, 900),
(77, '4790015950624', 100, 900);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_unique_items`
--

CREATE TABLE `shop_order_unique_items` (
  `order_id` int(11) NOT NULL,
  `product_code` varchar(2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold_bulk_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_order_unique_items`
--

INSERT INTO `shop_order_unique_items` (`order_id`, `product_code`, `quantity`, `sold_bulk_price`) VALUES
(36, 'bs', 100, 5),
(37, 'nc', 200, 175),
(39, 'ap', 30, 50),
(45, 'bv', 100, 80),
(46, 'bv', 20, 1000),
(47, 'bv', 20, 1000),
(48, 'bv', 60, 8),
(49, 'bv', 20, 50),
(54, 'ma', 10, 20),
(55, 'ma', 1, 100),
(56, 'ma', 1, 10),
(57, 'ma', 5, 100),
(59, 'ma', 7, 1),
(60, 'ma', 7, 1),
(66, 'ma', 2, 30),
(67, 'ma', 5, 100),
(70, 'ma', 5, 100),
(73, 'ma', 100, 1),
(74, 'ma', 100, 69),
(75, 'aa', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_unique_products`
--

CREATE TABLE `shop_unique_products` (
  `so_phone` varchar(10) NOT NULL,
  `product_code` varchar(2) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `unit_price` float NOT NULL,
  `pic_format` varchar(5) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_type` enum('Packets','Bottles','Kg','L','Tubes','Cans','Bars','Pieces','Units','Boxes') NOT NULL DEFAULT 'Units',
  `low_stock_level` int(11) NOT NULL,
  `pre_orderable_stock` int(11) NOT NULL,
  `amount_alowed_per_pre_Order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_unique_products`
--

INSERT INTO `shop_unique_products` (`so_phone`, `product_code`, `product_name`, `unit_price`, `pic_format`, `quantity`, `unit_type`, `low_stock_level`, `pre_orderable_stock`, `amount_alowed_per_pre_Order`) VALUES
('0000000111', 'aa', 'Elakiri', 10, NULL, 100, 'Bottles', 1000, 100, 10),
('0112223333', 'ap', 'Apples', 130, NULL, 9871, 'Units', 0, 125, 10),
('0112223333', 'bs', 'Incense Sticks', 77, NULL, 50, 'Packets', 7, 0, 10),
('0112223333', 'bv', 'Bulath', 110, NULL, 200, 'Kg', 20, 200, 9),
('0112223333', 'ma', 'Mantra', 100, NULL, 193, 'Bars', 10, 192, 10),
('0112223333', 'mm', 'Candles', 300, 'jpg', 586, 'Pieces', 0, 300, 10),
('0112223333', 'nc', 'Nelli Cordial', 450, 'jpeg', 195, 'Bottles', 0, 195, 0),
('0112223333', 'sp', 'Bananas', 100, 'jpg', 10189, 'Units', 0, 98, 10),
('7747511805', 'bs', 'Oranges', 230, 'jpg', 200, 'Units', 0, 230, 15);

-- --------------------------------------------------------

--
-- Table structure for table `so_cash_drawer_flow`
--

CREATE TABLE `so_cash_drawer_flow` (
  `id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` enum('Personnel Use','Bank Deposit','Invest in other businesses','Other withdrawal','Add cash in') NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_cash_drawer_flow`
--

INSERT INTO `so_cash_drawer_flow` (`id`, `so_phone`, `date`, `time`, `type`, `amount`) VALUES
(1, '0112223333', '2025-04-10', '11:47:00', 'Add cash in', 1000),
(2, '0112223333', '2025-04-10', '08:48:00', 'Add cash in', 7925),
(3, '0112223333', '2025-04-10', '09:16:00', 'Add cash in', 9000),
(4, '0112223333', '2025-04-10', '09:17:00', 'Add cash in', 1000),
(5, '0112223333', '2025-04-10', '09:18:00', 'Add cash in', 1000),
(6, '0112223333', '2025-04-10', '06:19:00', 'Add cash in', 500),
(7, '0112223333', '2025-04-09', '09:24:00', 'Add cash in', 50),
(8, '0112223333', '2025-04-10', '10:42:00', 'Add cash in', 50),
(9, '0112223333', '2025-04-10', '10:43:00', 'Add cash in', 500),
(10, '0112223333', '2025-04-01', '10:50:00', 'Add cash in', 7000),
(11, '0112223333', '2025-04-01', '10:57:00', 'Bank Deposit', -1111),
(12, '0112223333', '2025-04-10', '13:01:00', 'Add cash in', 100),
(13, '0112223333', '2025-04-10', '13:20:00', 'Bank Deposit', -999),
(14, '0112223333', '2025-04-10', '13:24:00', 'Other withdrawal', -9090),
(15, '0112223333', '2025-04-10', '13:27:00', 'Add cash in', 99876),
(16, '0112223333', '2025-04-10', '13:28:00', 'Add cash in', 784352),
(17, '0112223333', '2025-04-10', '13:30:00', 'Add cash in', 1628394),
(18, '0112223333', '2025-04-10', '13:42:00', 'Bank Deposit', -200000),
(19, '0112223333', '2025-04-10', '13:45:00', 'Invest in other businesses', -430),
(20, '0112223333', '2025-04-10', '15:47:00', 'Invest in other businesses', -1234),
(21, '0112223333', '2025-04-10', '17:53:00', 'Add cash in', 1234567890),
(22, '0112223333', '2025-04-10', '16:00:00', 'Invest in other businesses', -666666),
(23, '0112223333', '2025-04-21', '23:24:00', 'Add cash in', 35000),
(24, '0112223333', '2025-04-21', '23:31:00', 'Bank Deposit', -5000),
(25, '0112223333', '2025-04-21', '23:55:00', 'Add cash in', 500),
(26, '0112223333', '2025-04-21', '00:02:00', 'Personnel Use', -45),
(27, '0112223333', '2025-04-21', '00:14:00', 'Add cash in', 300),
(28, '0112223333', '2025-04-21', '00:23:00', 'Add cash in', 500),
(29, '0112223333', '2025-04-21', '00:25:00', 'Personnel Use', -100),
(30, '0112223333', '2025-04-26', '23:41:00', 'Add cash in', 100000),
(31, '0112223333', '2025-04-26', '00:16:00', 'Add cash in', 80000),
(32, '0112223333', '2025-04-26', '00:16:00', 'Personnel Use', 0),
(33, '0112223333', '2025-04-26', '00:21:00', 'Personnel Use', 100),
(34, '0112223333', '2025-04-26', '00:22:00', 'Personnel Use', -100),
(35, '0112223333', '2025-04-26', '00:25:00', 'Add cash in', 800),
(36, '0112223333', '2025-04-26', '00:26:00', 'Personnel Use', -1221),
(37, '0112223333', '2025-04-26', '00:31:00', 'Personnel Use', -6000),
(38, '0112223333', '2025-04-26', '00:31:00', 'Personnel Use', -79),
(39, '0112223333', '2025-04-27', '00:34:00', 'Personnel Use', -1000),
(40, '0112223333', '2025-04-26', '01:01:00', 'Add cash in', 0),
(41, '0112223333', '2025-04-27', '22:18:00', 'Add cash in', 10000000),
(42, '0000000111', '2025-04-28', '23:34:00', 'Add cash in', 10),
(43, '0000000111', '2025-04-28', '00:07:00', 'Personnel Use', -10),
(44, '0000000111', '2025-04-28', '00:09:00', 'Add cash in', 10),
(45, '0000000111', '2025-04-28', '00:10:00', 'Personnel Use', -10);

-- --------------------------------------------------------

--
-- Table structure for table `so_dis_payment`
--

CREATE TABLE `so_dis_payment` (
  `id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `ammount` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_dis_payment`
--

INSERT INTO `so_dis_payment` (`id`, `so_phone`, `dis_phone`, `ammount`, `status`, `date`, `time`) VALUES
(1, '0112223333', '0372222690', 0, 1, '2025-04-24', '11:06:54'),
(2, '0112223333', '0372222690', 10000, 1, '2025-04-24', '11:08:05'),
(3, '0112223333', '0372222690', 1000, 0, '2025-04-24', '14:29:38'),
(4, '0112223333', '0372222690', 50000, 0, '2025-04-24', '16:35:02'),
(5, '0112223333', '0372222690', 50000, 0, '2025-04-24', '16:35:16'),
(6, '0112223333', '0372222690', 600, 0, '2025-04-24', '16:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `so_my_price`
--

CREATE TABLE `so_my_price` (
  `so_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_my_price`
--

INSERT INTO `so_my_price` (`so_phone`, `barcode`, `price`) VALUES
('0112223333', '4791034015318', 360),
('0112223333', '4796000301471', 80);

-- --------------------------------------------------------

--
-- Table structure for table `so_other_expences`
--

CREATE TABLE `so_other_expences` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `cashDrawer` tinyint(1) NOT NULL,
  `type` enum('Electricity','Water','Telephone','Rent','Tax','Payed to Creditors','Other') NOT NULL,
  `amount` float NOT NULL,
  `so_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_other_expences`
--

INSERT INTO `so_other_expences` (`id`, `date`, `time`, `cashDrawer`, `type`, `amount`, `so_phone`) VALUES
(2, '2025-04-10', '11:40:00', 1, 'Water', 889, '0112223333'),
(3, '2025-04-10', '11:41:00', 1, 'Electricity', 78, '0112223333'),
(4, '2025-04-10', '11:42:00', 1, 'Electricity', 56, '0112223333'),
(5, '2025-04-10', '11:43:00', 0, 'Electricity', 50, '0112223333'),
(6, '2025-04-10', '14:47:00', 1, 'Electricity', 400, '0112223333'),
(7, '2025-04-10', '14:51:00', 0, 'Telephone', 234, '0112223333'),
(8, '2025-04-01', '15:51:00', 1, 'Tax', 300, '0112223333'),
(9, '2025-03-10', '21:13:00', 1, 'Electricity', 100, '0112223333'),
(10, '2025-04-10', '21:19:00', 1, 'Payed to Creditors', 1234, '0112223333'),
(11, '2025-04-11', '04:33:00', 1, 'Payed to Creditors', 12345, '0112223333'),
(12, '0000-00-00', '00:00:00', 0, 'Payed to Creditors', 200, '0112223333'),
(13, '0000-00-00', '00:00:00', 1, 'Payed to Creditors', 680000, '0112223333'),
(14, '2025-04-16', '23:52:37', 0, 'Payed to Creditors', 700, '0112223333'),
(15, '2025-04-16', '23:58:20', 1, 'Payed to Creditors', 1000, '0112223333'),
(16, '2025-04-16', '23:59:20', 1, 'Payed to Creditors', 20, '0112223333'),
(17, '2025-04-17', '00:00:54', 0, 'Payed to Creditors', 5, '0112223333'),
(18, '2025-04-17', '00:01:46', 1, 'Payed to Creditors', 300, '0112223333'),
(19, '2025-04-17', '00:02:01', 1, 'Payed to Creditors', 500, '0112223333'),
(20, '2025-04-17', '00:03:09', 1, 'Payed to Creditors', 50000, '0112223333'),
(21, '2025-04-17', '00:03:45', 1, 'Payed to Creditors', 5, '0112223333'),
(22, '2025-04-17', '00:05:50', 1, 'Payed to Creditors', 20, '0112223333'),
(23, '2025-04-17', '00:07:59', 1, 'Payed to Creditors', 5000, '0112223333'),
(24, '2025-04-17', '00:08:22', 1, 'Payed to Creditors', 50000, '0112223333'),
(25, '2025-04-17', '00:08:45', 1, 'Payed to Creditors', 5, '0112223333'),
(26, '2025-04-17', '00:09:29', 1, 'Payed to Creditors', 1000, '0112223333'),
(27, '2025-04-17', '00:09:45', 1, 'Payed to Creditors', 5, '0112223333'),
(28, '2025-04-17', '00:15:13', 0, 'Payed to Creditors', 995, '0112223333'),
(29, '2025-04-21', '00:02:00', 1, 'Electricity', 200, '0112223333'),
(30, '2025-04-21', '00:14:00', 1, 'Electricity', 500, '0112223333'),
(31, '2025-04-21', '00:25:00', 0, 'Electricity', 600, '0112223333'),
(32, '2025-04-24', '11:01:02', 1, 'Payed to Creditors', 100, '0112223333'),
(33, '2025-04-24', '11:08:05', 0, 'Payed to Creditors', 10000, '0112223333'),
(34, '2025-04-24', '14:29:38', 1, 'Payed to Creditors', 1000, '0112223333'),
(35, '2025-04-24', '16:35:02', 0, 'Payed to Creditors', 50000, '0112223333'),
(36, '2025-04-24', '16:35:16', 0, 'Payed to Creditors', 50000, '0112223333'),
(37, '2025-04-24', '16:47:14', 0, 'Payed to Creditors', 600, '0112223333');

-- --------------------------------------------------------

--
-- Table structure for table `so_stocks`
--

CREATE TABLE `so_stocks` (
  `so_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `low_stock_level` int(11) NOT NULL,
  `pre_orderable_stock` int(11) NOT NULL,
  `amount_alowed_per_pre_Order` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_stocks`
--

INSERT INTO `so_stocks` (`so_phone`, `barcode`, `quantity`, `low_stock_level`, `pre_orderable_stock`, `amount_alowed_per_pre_Order`) VALUES
('0112223333', '4790015950624', 215, 50, 184, 5),
('0112223333', '4791010040044', 400, 50, 394, 5),
('0112223333', '4791034015318', 102, 100, 102, 10),
('0112223333', '4791034070287', 111, 100, 111, 10),
('0112223333', '4791034072366', 495, 100, 195, 10),
('0112223333', '4791034072663', 200, 10, 200, 10),
('0112223333', '4791111102948', 462, 100, 455, 10),
('0112223333', '4792024019545', 235, 50, 230, 5),
('0112223333', '4792081031580', 190, 20, 190, 15),
('0112223333', '4792173000005', 417, 100, 415, 10),
('0112223333', '4792225001189', 998, 100, 976, 10),
('0112223333', '4796000301471', 3, 10, 3, 10),
('0112223333', '4796010610921', 180, 10, 175, 10),
('0112223333', '4796020480217', 32, 20, 2, 2),
('0112223333', '8888101611705', 137, 20, 137, 10),
('0112223333', 'sug', 40, 10, 40, 10),
('0701234567', '4790015950624', 314, 20, 283, 5),
('0712345678', '4790015950624', 114, 10, 83, 2),
('0718765432', '4790015950624', 214, 10, 183, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `phone` varchar(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pic_format` varchar(10) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`phone`, `first_name`, `last_name`, `address`, `pic_format`, `role`) VALUES
('0000000111', 'Himesha', 'Dahami', '1st Street, Rathnapura', 'jpg', 1),
('0111111111', 'Hmadi', 'Hamsa', 'Galle', 'png', 0),
('0112223333', 'Gamunu', 'Jayawardhana', 'No. 10, Negambo Road, Kurunegala', '', 1),
('0122334456', 'Janaka', 'Bandara', 'No.6, High level road, Nugegoda.', '', 1),
('0123456789', 'Saman', 'Rathnayaka', 'No.120/1, Karadana, Gampaha', 'jpg', 0),
('0222222222', 'Himantha', 'Marasinghe', 'Kurunegala', '', 1),
('0333333333', 'Niroshan', 'P', 'Jafna', '', 2),
('0372222690', 'Sumudu', 'Karunarathna', 'No.6, High level road, Nugegoda', 'jpeg', 3),
('0701122334', 'Sarath', 'Gunasekara', 'No.12/3, Dutugemunu Mawatha, Maharagama', '', 0),
('0701234567', 'Rajan', 'Nadarajah', 'No. 10, Main Street, Jaffna', '', 1),
('0702345678', 'Suresh', 'Kanagarajah', 'No. 8, 2nd Cross Street, Vavuniya', '', 1),
('0709876543', 'Mala', 'Jayawardena', 'No.20, Madampe Junction, Chilaw', '', 0),
('0711234567', 'Nimal', 'Perera', 'No. 5, Temple Lane, Kandy', '', 1),
('0712345678', 'Nimal', 'Perera', 'No.12, Kadawatha Road, Ragama', '', 0),
('0713456789', 'Upul', 'Rajapaksha', 'No. 4, New Town, Polonnaruwa', '', 1),
('0714567890', 'Tharindu', 'Gunasekara', 'No. 8, Mallawapitiya, Kurunegala', '', 1),
('0718765432', 'Chaminda', 'Edirisinghe', 'No. 3, Yakkala Road, Gampaha', '', 1),
('0718976543', 'Kumari', 'Rathnayake', 'No.45/7, Malwatte Road, Matara', '', 3),
('0719876543', 'Kasun', 'Bandara', 'No. 12, Muwagama, Ratnapura', '', 1),
('0721112223', 'Shanika', 'Jayasinghe', 'No.25, Kandy Road, Mawanella', '', 0),
('0721234567', 'Ruwan', 'Karunaratne', 'No. 10, Queen Elizabeth Drive, Nuwara Eliya', '', 1),
('0723456789', 'Kumara', 'De Silva', 'No. 30, Lighthouse Street, Galle', '', 1),
('0731234567', 'Roshan', 'Amarasinghe', 'No. 22, Orrs Hill, Trincomalee', '', 1),
('0734567890', 'Indika', 'Weerasinghe', 'No. 6, Kottukuliya, Puttalam', '', 1),
('0741234567', 'Chandana', 'Hettiarachchi', 'No. 12, Mihintale Road, Anuradhapura', '', 1),
('0747654321', 'Ruwan', 'Wickramasinghe', 'No.3/1, Aluthgama Road, Bandaragama', '', 0),
('0749876543', 'Nuwan', 'Dissanayake', 'No. 9, Kattankudy Road, Batticaloa', '', 1),
('0751234567', 'Samantha', 'Wijesinghe', 'No. 15, Wewahamanduwa, Matara', '', 1),
('0756789123', 'Gayan', 'Kumarasinghe', 'No.14, Temple Lane, Kurunegala', '', 0),
('0759876543', 'Sanjeewa', 'Ranasinghe', 'No. 1, Panadura Road, Kalutara', '', 1),
('0761234567', 'Anura', 'Jayasinghe', 'No. 7, Sea Street, Negombo', '', 1),
('0762345678', 'Ranjith', 'Abeykoon', 'No. 11, Munneswaram Road, Chilaw', '', 1),
('0763322110', 'Hemantha', 'Dias', 'No.9, Lake Road, Anuradhapura', '', 0),
('0765432198', 'Anura', 'Bandara', 'No.44, Rathnapura Road, Eheliyagoda', '', 0),
('0770000000', 'Piyal', 'Karunarathna', 'No.6, High level road, Nugegoda.', '', 0),
('0771111111', 'Jagath', 'Madurapperuma', 'No.54/3, Negombo road, Kurunegala', '', 2),
('0772233445', 'Piumi', 'Senarath', 'No.7, Hospital Lane, Kalutara', '', 0),
('0772345678', 'Mahesh', 'Senanayake', 'No. 6, Welimada Road, Badulla', '', 1),
('0774343434', 'Hamdhi', 'Hamsa', 'Galle', '', 3),
('0774567890', 'Jagath', 'Mendis', 'No. 10, New Bazaar, Hambantota', '', 1),
('0775648392', 'Jagath', 'Gunawardhana', 'No.111/11, Maple street, London', '', 1),
('0776543210', 'Samantha', 'Fernando', 'No.66, Beach Road, Negombo', '', 0),
('0778765432', 'Sunil', 'Wijesinghe', 'No.55, Main Street, Piliyandala', '', 0),
('0781234567', 'Chandani', 'Silva', 'No.30, Galle Road, Hikkaduwa', '', 0),
('0787766554', 'Janaka', 'Karunaratne', 'No.10/2, Rajagiriya Road, Nawala', '', 0),
('0789988776', 'Harsha', 'Abeysekara', 'No.5, Peradeniya Road, Kandy', '', 0),
('0897867564', 'Maduranga', 'Kuruppu', 'Mawatta, Polgahawela', 'jpg', 0),
('0987654321', 'Kamala', 'Gunawardana', 'No.111, Batuwaththa, Meerigama', 'jpg', 0),
('1153294893', 'Ali', 'Baxter', 'Amet suscipit error', 'jpg', 1),
('22020586', 'Admin', 'Admin', 'Admin', '', 4),
('2416052903', 'Halla', 'Pena', 'Soluta laudantium n', '', 1),
('2910382947', 'Harry', 'Potter', 'Hogwarts', 'jpg', 0),
('4995352045', 'Fletcher', 'Perkins', 'Ut quia adipisci con', 'jpg', 1),
('7747511805', 'Lawrence', 'Velez', 'Ab repudiandae est m', 'jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_notificatoin`
--

CREATE TABLE `user_notificatoin` (
  `id` int(11) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `type` varchar(25) NOT NULL,
  `ref_id` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(255) NOT NULL,
  `link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notificatoin`
--

INSERT INTO `user_notificatoin` (`id`, `phone`, `type`, `ref_id`, `title`, `body`, `link`) VALUES
(277, '0701234567', 'loyaltyReq', '0770000000', 'New Loyalty Request', 'Piyal Karunarathna requested to be a loyalty customer', 'ShopOwner/loyaltyCustomerRequest/0770000000'),
(278, '0372222690', 'stkOrdr', '52', 'New Order', 'Gamunu Jayawardhana placed an order', 'ShopOwner/preOrder/52'),
(279, '0112223333', 'preOrder', '129', 'New Pre Order', 'Piyal Karunarathna placed a pre-order', 'ShopOwner/preOrder/129'),
(280, '0112223333', 'preOrder', '130', 'New Pre Order', 'Piyal Karunarathna placed a pre-order', 'ShopOwner/preOrder/130'),
(290, '0987654321', 'bill', '322', 'Bill Settled (ID : 322)', 'Your bill at Gamunu Stores has been settled.', 'Customer/shop/0112223333'),
(295, '0112223333', 'preOrder', '154', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/154'),
(308, '0112223333', 'preOrder', '162', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/162'),
(310, '0112223333', 'preOrder', '163', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/163'),
(314, '0112223333', 'preOrder', '165', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/165'),
(316, '0112223333', 'preOrder', '166', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/166'),
(330, '0112223333', 'preOrder', '160', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/160'),
(332, '0112223333', 'preOrder', '168', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/168'),
(333, '0112223333', 'preOrder', '170', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/170'),
(337, '0112223333', 'preOrder', '171', 'Pre-Order got Canceled', 'Piyal Karunarathna canceled the pre-order', 'ShopOwner/preOrder/171'),
(349, '0372222690', 'stkOrdr', '71', 'New Order', 'Gamunu Jayawardhana placed an order', 'ShopOwner/preOrder/71'),
(350, '0372222690', 'stkOrdr', '72', 'New Order', 'Gamunu Jayawardhana placed an order', 'ShopOwner/preOrder/72'),
(352, '0770000000', 'preOrder', '175', 'Pre-Order Picked', 'Your pre-order at Gamunu Stores has been picked.', 'Customer/preOrder/175'),
(356, '0123456789', 'chat', '0112223333', 'New Message from Gamunu Jayawardhana', 'hello', 'Customer/shop//0112223333'),
(372, '0770000000', 'chat', '0112223333', 'New Message from Gamunu Jayawardhana', 'hello', 'Customer/shop//0112223333'),
(377, '0987654321', 'chat', '0112223333', 'New Message from Gamunu Jayawardhana', 'hi', 'Customer/shop//0112223333'),
(381, '0770000000', 'preOrder', '178', 'Pre-Order Picked', 'Your pre-order at Gamunu Stores has been picked.', 'Customer/preOrder/178'),
(384, '0770000000', 'preOrder', '177', 'Pre-Order Picked', 'Your pre-order at Gamunu Stores has been picked.', 'Customer/preOrder/177'),
(388, '0123456789', 'loyWal', '0112223333', 'Wallet Updated', 'Gamunu Stores updated your wallet', 'Customer/shop/0112223333');

-- --------------------------------------------------------

--
-- Table structure for table `user_passwords`
--

CREATE TABLE `user_passwords` (
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_passwords`
--

INSERT INTO `user_passwords` (`phone`, `password`) VALUES
('0000000111', '$2y$10$fBYvOis/fQekR2Hx7mc6xuIJ.HSAJ4U4/DBmFGS6lQy46QCabs.Wi'),
('0111111111', '$2y$10$lFJWhX2jWurledf7ecmb5uTFTJj/1vDdg6vV1Ft1A2mAv6YDjdnd6'),
('0112223333', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0122334456', '$2y$10$Z4mvGQeW5uybMo8fRRmU1Okay8nfHTQShuDJdaYu09CO9KoZ2Yf96'),
('0123456789', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0222222222', '$2y$10$qaTPt643arWcK5ZChwyHcuv7yHDoRLxz6bseFEpqbr.EQKbbqoS1y'),
('0333333333', '$2y$10$zRvhbUTA1XYfHQKWZrH.ZuTd.VJPcKQ41HQiGI84Ti1F5zyCGmR1.'),
('0372222690', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0701122334', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0701234567', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0702345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0709876543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0711234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0712345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0713456789', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0714567890', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0718765432', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0718976543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0719876543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0721112223', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0721234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0723456789', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0731234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0734567890', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0741234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0747654321', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0749876543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0751234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0756789123', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0759876543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0761234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0762345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0763322110', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0765432198', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0770000000', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0771111111', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0772233445', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0772345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0774343434', '$2y$10$c2PmZ0nOT0wImUpJuV9jz.MiaU6ZA1VGv3fNoaE6YyoQU2e9m2gUW'),
('0774567890', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0775648392', '$2y$10$7wkdCu9BaKKhKrEuhRVXSOWXIjP1rAEXFmA47Tkj2zUBjZjCwqPyO'),
('0776543210', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0778765432', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0781234567', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0787766554', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0789988776', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0897867564', '$2y$10$Kdn3T4scMIGrn.twjkVE2OfAWqRfCqwWJnKfnlWGa0fwrsrqGJMoC'),
('0987654321', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('1153294893', '$2y$10$Yj0vXT2nGMOMLkYHq2wnN.hmNbJM4lLxf2ikm5bNEvDihYzYQew/i'),
('22020586', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('2416052903', '$2y$10$S.rXb2Y//OddB2Os9xphYOhYkJK2wkH7SEgz3ecogFTnJmK1THLHC'),
('2910382947', '$2y$10$LEWH7lQXGhtAMJK91hGRZ.R3z6ekh6ewrcJTpyIha5z4DulAuRh4m'),
('4995352045', '$2y$10$3GK.vF4/VyY4479eVqjXcOkLZp8uUOAlNhQO4Z2wJ1yrUHkjrpBbC'),
('7747511805', '$2y$10$2aSuSTv8o3JvcKjuQIv2xO0xELd7tnK0kodvrxEwzhhKQSljnpRqW');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_dis_man`
--

CREATE TABLE `wallet_dis_man` (
  `dis_phone` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL,
  `wallet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_dis_man`
--

INSERT INTO `wallet_dis_man` (`dis_phone`, `man_phone`, `wallet`) VALUES
('0372222690', '0771111111', -351350);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_so_dis`
--

CREATE TABLE `wallet_so_dis` (
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `wallet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet_so_dis`
--

INSERT INTO `wallet_so_dis` (`so_phone`, `dis_phone`, `wallet`) VALUES
('0112223333', '0372222690', -56525),
('0112223333', '0718976543', -53330);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `so_phone` (`so_phone`),
  ADD KEY `cus_phone` (`cus_phone`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`bill_id`,`barcode`,`sold_price`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `bill_unique_items`
--
ALTER TABLE `bill_unique_items`
  ADD PRIMARY KEY (`bill_id`,`product_code`),
  ADD KEY `so_phone` (`product_code`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_from` (`c_from`),
  ADD KEY `c_to` (`c_to`);

--
-- Indexes for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `so_phone` (`so_phone`),
  ADD KEY `chat_cus_so_ibfk_1` (`cus_phone`);

--
-- Indexes for table `chat_dis_man`
--
ALTER TABLE `chat_dis_man`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sa_phone` (`dis_phone`),
  ADD KEY `su_phone` (`man_phone`);

--
-- Indexes for table `chat_so_dis`
--
ALTER TABLE `chat_so_dis`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sa_phone` (`dis_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `distributer_orders`
--
ALTER TABLE `distributer_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `dis_phone` (`dis_phone`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `distributer_order_items`
--
ALTER TABLE `distributer_order_items`
  ADD PRIMARY KEY (`order_id`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`dis_phone`),
  ADD KEY `su_phone` (`man_phone`);

--
-- Indexes for table `distributor_stocks`
--
ALTER TABLE `distributor_stocks`
  ADD PRIMARY KEY (`dis_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `dis_man_payment`
--
ALTER TABLE `dis_man_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `dis_phone` (`dis_phone`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `dis_req`
--
ALTER TABLE `dis_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dis_phone` (`dis_phone`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `loyalty_customers`
--
ALTER TABLE `loyalty_customers`
  ADD PRIMARY KEY (`so_phone`,`cus_phone`),
  ADD KEY `loyalty_customers_ibfk_1` (`cus_phone`);

--
-- Indexes for table `loyalty_requests`
--
ALTER TABLE `loyalty_requests`
  ADD PRIMARY KEY (`cus_phone`,`so_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`man_phone`);

--
-- Indexes for table `manufacturer_stock`
--
ALTER TABLE `manufacturer_stock`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`so_phone`,`cus_phone`,`pre_order_id`),
  ADD KEY `barcode` (`pre_order_id`),
  ADD KEY `cus_phone` (`cus_phone`,`so_phone`);

--
-- Indexes for table `pre_order_items`
--
ALTER TABLE `pre_order_items`
  ADD PRIMARY KEY (`pre_order_id`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `pre_order_unique_items`
--
ALTER TABLE `pre_order_unique_items`
  ADD PRIMARY KEY (`pre_order_id`,`product_code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`barcode`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`so_phone`);

--
-- Indexes for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `so_phone` (`so_phone`),
  ADD KEY `dis_phone` (`dis_phone`);

--
-- Indexes for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  ADD PRIMARY KEY (`order_id`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `shop_order_unique_items`
--
ALTER TABLE `shop_order_unique_items`
  ADD PRIMARY KEY (`order_id`,`product_code`);

--
-- Indexes for table `shop_unique_products`
--
ALTER TABLE `shop_unique_products`
  ADD PRIMARY KEY (`so_phone`,`product_code`);

--
-- Indexes for table `so_cash_drawer_flow`
--
ALTER TABLE `so_cash_drawer_flow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `so_dis_payment`
--
ALTER TABLE `so_dis_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_phone` (`so_phone`),
  ADD KEY `dis_phone` (`dis_phone`);

--
-- Indexes for table `so_my_price`
--
ALTER TABLE `so_my_price`
  ADD PRIMARY KEY (`so_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `so_other_expences`
--
ALTER TABLE `so_other_expences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `so_stocks`
--
ALTER TABLE `so_stocks`
  ADD PRIMARY KEY (`so_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `user_notificatoin`
--
ALTER TABLE `user_notificatoin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_2` (`phone`,`type`,`ref_id`);

--
-- Indexes for table `user_passwords`
--
ALTER TABLE `user_passwords`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `wallet_dis_man`
--
ALTER TABLE `wallet_dis_man`
  ADD PRIMARY KEY (`dis_phone`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `wallet_so_dis`
--
ALTER TABLE `wallet_so_dis`
  ADD PRIMARY KEY (`so_phone`,`dis_phone`),
  ADD KEY `dis_phone` (`dis_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_dis_man`
--
ALTER TABLE `chat_dis_man`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_so_dis`
--
ALTER TABLE `chat_so_dis`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributer_orders`
--
ALTER TABLE `distributer_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `dis_man_payment`
--
ALTER TABLE `dis_man_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dis_req`
--
ALTER TABLE `dis_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `pre_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `so_cash_drawer_flow`
--
ALTER TABLE `so_cash_drawer_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `so_dis_payment`
--
ALTER TABLE `so_dis_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `so_other_expences`
--
ALTER TABLE `so_other_expences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_notificatoin`
--
ALTER TABLE `user_notificatoin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`cus_phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_items_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_unique_items`
--
ALTER TABLE `bill_unique_items`
  ADD CONSTRAINT `bill_unique_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`c_from`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`c_to`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  ADD CONSTRAINT `chat_cus_so_ibfk_1` FOREIGN KEY (`cus_phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_cus_so_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_dis_man`
--
ALTER TABLE `chat_dis_man`
  ADD CONSTRAINT `chat_dis_man_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_dis_man_ibfk_2` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_so_dis`
--
ALTER TABLE `chat_so_dis`
  ADD CONSTRAINT `chat_so_dis_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_so_dis_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributer_orders`
--
ALTER TABLE `distributer_orders`
  ADD CONSTRAINT `distributer_orders_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distributer_orders_ibfk_2` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`) ON UPDATE CASCADE;

--
-- Constraints for table `distributer_order_items`
--
ALTER TABLE `distributer_order_items`
  ADD CONSTRAINT `distributer_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `distributer_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributer_order_items_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributors`
--
ALTER TABLE `distributors`
  ADD CONSTRAINT `distributors_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributors_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

--
-- Constraints for table `distributor_stocks`
--
ALTER TABLE `distributor_stocks`
  ADD CONSTRAINT `distributor_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_stocks_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dis_man_payment`
--
ALTER TABLE `dis_man_payment`
  ADD CONSTRAINT `dis_man_payment_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`),
  ADD CONSTRAINT `dis_man_payment_ibfk_2` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`);

--
-- Constraints for table `dis_req`
--
ALTER TABLE `dis_req`
  ADD CONSTRAINT `dis_req_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`),
  ADD CONSTRAINT `dis_req_ibfk_2` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`);

--
-- Constraints for table `loyalty_customers`
--
ALTER TABLE `loyalty_customers`
  ADD CONSTRAINT `loyalty_customers_ibfk_1` FOREIGN KEY (`cus_phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loyalty_customers_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loyalty_requests`
--
ALTER TABLE `loyalty_requests`
  ADD CONSTRAINT `loyalty_requests_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loyalty_requests_ibfk_2` FOREIGN KEY (`cus_phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD CONSTRAINT `manufacturers_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

--
-- Constraints for table `manufacturer_stock`
--
ALTER TABLE `manufacturer_stock`
  ADD CONSTRAINT `manufacturer_stock_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON UPDATE CASCADE;

--
-- Constraints for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  ADD CONSTRAINT `pending_product_requests_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD CONSTRAINT `pre_order_ibfk_1` FOREIGN KEY (`cus_phone`,`so_phone`) REFERENCES `loyalty_customers` (`cus_phone`, `so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pre_order_items`
--
ALTER TABLE `pre_order_items`
  ADD CONSTRAINT `pre_order_items_ibfk_1` FOREIGN KEY (`pre_order_id`) REFERENCES `pre_order` (`pre_order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pre_order_items_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON UPDATE CASCADE;

--
-- Constraints for table `pre_order_unique_items`
--
ALTER TABLE `pre_order_unique_items`
  ADD CONSTRAINT `pre_order_unique_items_ibfk_1` FOREIGN KEY (`pre_order_id`) REFERENCES `pre_order` (`pre_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

--
-- Constraints for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD CONSTRAINT `shop_orders_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shop_orders_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON UPDATE CASCADE;

--
-- Constraints for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  ADD CONSTRAINT `shop_order_items_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shop_order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_order_unique_items`
--
ALTER TABLE `shop_order_unique_items`
  ADD CONSTRAINT `shop_order_unique_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_unique_products`
--
ALTER TABLE `shop_unique_products`
  ADD CONSTRAINT `shop_unique_products_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_cash_drawer_flow`
--
ALTER TABLE `so_cash_drawer_flow`
  ADD CONSTRAINT `so_cash_drawer_flow_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_dis_payment`
--
ALTER TABLE `so_dis_payment`
  ADD CONSTRAINT `so_dis_payment_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_dis_payment_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_my_price`
--
ALTER TABLE `so_my_price`
  ADD CONSTRAINT `so_my_price_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_my_price_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_other_expences`
--
ALTER TABLE `so_other_expences`
  ADD CONSTRAINT `so_other_expences_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_stocks`
--
ALTER TABLE `so_stocks`
  ADD CONSTRAINT `so_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_stocks_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `user_passwords` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notificatoin`
--
ALTER TABLE `user_notificatoin`
  ADD CONSTRAINT `user_notificatoin_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallet_dis_man`
--
ALTER TABLE `wallet_dis_man`
  ADD CONSTRAINT `wallet_dis_man_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `manufacturers` (`man_phone`),
  ADD CONSTRAINT `wallet_dis_man_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`);

--
-- Constraints for table `wallet_so_dis`
--
ALTER TABLE `wallet_so_dis`
  ADD CONSTRAINT `wallet_so_dis_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wallet_so_dis_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
