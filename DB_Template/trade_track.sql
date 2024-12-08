-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 04:22 PM
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
(1, '3', 'check', 'new message\r\nnew message\r\nnew message\r\nnew message\r\nnew messagenew message\r\nnew message\r\nnew message\r\nnew message\r\nnew messagenew message\r\nnew message\r\nnew message\r\nnew message\r\nnew messagenew message\r\nnew message\r\nnew message\r\nnew message\r\nnew messagenew message\r\nnew message\r\nnew message\r\nnew message\r\nnew messagenew message\r\nnew message\r\nnew message\r\nnew message\r\nnew message', '2024-11-30', '13:53:35'),
(4, '0', 'Vj3CZpLusq', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '08:05:00'),
(5, '0', 'BU53BZHFAb', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '12:50:05'),
(7, '3', 'wzD0zXIdAa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '13:54:03'),
(8, '2', '2Sryje0i3d', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '13:54:21'),
(9, '2', 'CyGEtc08uQ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '13:54:31'),
(10, '2', 'Y2MWxLO9AR', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '13:54:42'),
(11, '2', 'ihE6NiYbs5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including dversions of Lorem Ipsum', '2024-11-30', '13:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime(),
  `cus_phone` varchar(10) NOT NULL,
  `so_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `date`, `time`, `cus_phone`, `so_phone`) VALUES
(182, '2024-10-17', '00:33:34', '0123456789', '0112223333'),
(183, '2024-10-24', '00:39:15', '0987654321', '0112223333'),
(184, '2024-11-11', '13:08:29', '0123456789', '0112223333'),
(185, '2024-11-15', '23:44:32', '0123456789', '0112223333'),
(186, '2024-11-17', '19:52:30', '0123456789', '0112223333'),
(187, '2024-11-18', '11:11:03', '0123456789', '0112223333'),
(188, '2024-11-20', '10:37:24', '', '0112223333'),
(189, '2024-11-20', '10:38:24', '', '0112223333'),
(190, '2024-11-20', '10:42:41', '', '0112223333'),
(191, '2024-11-20', '10:43:19', '', '0112223333'),
(192, '2024-11-20', '10:43:59', '', '0112223333'),
(193, '2024-11-20', '14:41:23', '', '0112223333'),
(194, '2024-11-20', '15:39:14', '0123456789', '0112223333'),
(195, '2024-11-20', '15:45:03', '0123456789', '0112223333'),
(197, '2024-11-23', '14:13:27', '0123456789', '0112223333'),
(198, '2024-11-30', '00:00:45', '0123456789', '0112223333'),
(199, '2024-11-30', '19:21:53', '0123456789', '0112223333'),
(200, '2024-11-30', '19:23:51', '0123456789', '0112223333'),
(201, '2024-11-30', '19:24:33', '0123456789', '0112223333'),
(202, '2024-11-30', '19:25:11', '', '0112223333'),
(203, '2024-11-30', '19:45:03', '0987654321', '0112223333'),
(204, '2024-11-30', '20:19:39', '', '0112223333');

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `bill_id` int(11) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`bill_id`, `barcode`, `quantity`) VALUES
(182, '8888101611705', 1),
(183, '4790015950624', 1),
(184, '4791010040044', 12),
(185, '4791010040044', 4),
(186, '4790015950624', 2),
(187, '4790015950624', 3),
(188, '4790015950624', 2),
(189, '4790015950624', 3),
(190, '4790015950624', 2),
(191, '4790015950624', 2),
(192, '4790015950624', 6),
(193, '4790015950624', 3),
(194, '4790015950624', 2),
(195, '4790015950624', 7),
(195, '4791010040044', 3),
(197, '4790015950624', 2),
(198, '4790015950624', 2),
(199, '4790015950624', 2),
(199, '4791010040044', 1),
(199, '4791034015318', 1),
(199, '4791034070287', 1),
(199, '4791034072366', 4),
(199, '4791034072663', 4),
(200, '4791034072663', 1),
(201, '4791034072663', 1),
(202, '4791034072663', 1),
(203, '4791034072366', 3),
(204, '4791034072366', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bulk_order`
--

CREATE TABLE `bulk_order` (
  `order_id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `sa_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `date` date NOT NULL DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime(),
  `status` enum('placed','done') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `chat_sa_su`
--

CREATE TABLE `chat_sa_su` (
  `message_id` int(11) NOT NULL,
  `sa_phone` varchar(10) NOT NULL,
  `su_phone` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `direction` enum('sa_su','su_sa') NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_so_sa`
--

CREATE TABLE `chat_so_sa` (
  `message_id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `sa_phone` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `direction` enum('so_sa','sa_so') NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_phone` varchar(10) NOT NULL,
  `cus_first_name` varchar(20) NOT NULL,
  `cus_last_name` varchar(20) NOT NULL,
  `cus_address` varchar(100) NOT NULL,
  `cus_password` varchar(256) NOT NULL,
  `pic_format` varchar(10) NOT NULL DEFAULT 'jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_phone`, `cus_first_name`, `cus_last_name`, `cus_address`, `cus_password`, `pic_format`) VALUES
('0123456789', 'Saman', 'Rathnayaka', 'No.120/1, Karadana, Gampaha', 'password', 'jpg'),
('0701122334', 'Sarath', 'Gunasekara', 'No.12/3, Dutugemunu Mawatha, Maharagama', 'sarath12', ''),
('0709876543', 'Mala', 'Jayawardena', 'No.20, Madampe Junction, Chilaw', 'mala@123', ''),
('0712345678', 'Nimal', 'Perera', 'No.12, Kadawatha Road, Ragama', 'nimal123', ''),
('0718976543', 'Kumari', 'Rathnayake', 'No.45/7, Malwatte Road, Matara', 'kumari@pw', ''),
('0721112223', 'Shanika', 'Jayasinghe', 'No.25, Kandy Road, Mawanella', 'shanika98', ''),
('0747654321', 'Ruwan', 'Wickramasinghe', 'No.3/1, Aluthgama Road, Bandaragama', 'ruwan654', ''),
('0756789123', 'Gayan', 'Kumarasinghe', 'No.14, Temple Lane, Kurunegala', 'gayanpass', ''),
('0763322110', 'Hemantha', 'Dias', 'No.9, Lake Road, Anuradhapura', 'hemanthapw', ''),
('0765432198', 'Anura', 'Bandara', 'No.44, Rathnapura Road, Eheliyagoda', 'anura321', ''),
('0772233445', 'Piumi', 'Senarath', 'No.7, Hospital Lane, Kalutara', 'piumi22', ''),
('0776543210', 'Samantha', 'Fernando', 'No.66, Beach Road, Negombo', 'sampass01', ''),
('0778765432', 'Sunil', 'Wijesinghe', 'No.55, Main Street, Piliyandala', 'sunilpw', ''),
('0781234567', 'Chandani', 'Silva', 'No.30, Galle Road, Hikkaduwa', 'chandu89', ''),
('0787766554', 'Janaka', 'Karunaratne', 'No.10/2, Rajagiriya Road, Nawala', 'janaka456', ''),
('0789988776', 'Harsha', 'Abeysekara', 'No.5, Peradeniya Road, Kandy', 'harsha321', ''),
('0987654321', 'Kamala', 'Gunawardana', 'No.111, Batuwaththa, Meerigama', 'Kamala', '');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `so_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `discount_price` float NOT NULL
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
  `status` enum('Ready','Pending','Done','') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributer_orders`
--

INSERT INTO `distributer_orders` (`order_id`, `date`, `time`, `dis_phone`, `man_phone`, `status`) VALUES
(1, '2024-11-25', '08:00:00', '0372222690', '0771111111', 'Ready'),
(2, '2024-11-25', '08:15:00', '0372222690', '0771111111', 'Pending'),
(3, '2024-11-25', '08:30:00', '0372222690', '0771111111', 'Done'),
(4, '2024-11-25', '08:45:00', '0372222690', '0771111111', 'Ready'),
(5, '2024-11-25', '09:00:00', '0372222690', '0771111111', 'Pending'),
(6, '2024-11-25', '09:15:00', '0372222690', '0771111111', 'Done'),
(7, '2024-11-25', '09:30:00', '0372222690', '0771111111', 'Ready'),
(8, '2024-11-25', '09:45:00', '0372222690', '0771111111', 'Pending'),
(9, '2024-11-25', '10:00:00', '0372222690', '0771111111', 'Done'),
(10, '2024-11-25', '10:15:00', '0372222690', '0771111111', 'Ready'),
(11, '2024-11-25', '10:30:00', '0372222690', '0771111111', 'Pending'),
(12, '2024-11-25', '10:45:00', '0372222690', '0771111111', 'Done'),
(13, '2024-11-25', '11:00:00', '0372222690', '0771111111', 'Ready'),
(14, '2024-11-25', '11:15:00', '0372222690', '0771111111', 'Pending'),
(15, '2024-11-25', '11:30:00', '0372222690', '0771111111', 'Done'),
(16, '2024-11-25', '11:45:00', '0372222690', '0771111111', 'Ready'),
(17, '2024-11-25', '12:00:00', '0372222690', '0771111111', 'Pending'),
(18, '2024-11-25', '12:15:00', '0372222690', '0771111111', 'Done'),
(19, '2024-11-25', '12:30:00', '0372222690', '0771111111', 'Ready'),
(20, '2024-11-25', '12:45:00', '0372222690', '0771111111', 'Pending'),
(22, '2024-11-26', '20:23:59', '0372222690', '0771111111', 'Pending'),
(24, '2024-11-26', '20:45:56', '0372222690', '0771111111', 'Pending'),
(25, '2024-11-26', '20:46:36', '0372222690', '0771111111', 'Pending'),
(26, '2024-11-26', '22:11:45', '0372222690', '0771111111', 'Pending'),
(27, '2024-11-26', '22:22:54', '0372222690', '0771111111', 'Pending'),
(28, '2024-11-29', '19:58:07', '0372222690', '0771111111', 'Pending'),
(29, '2024-11-29', '19:58:50', '0372222690', '0771111111', 'Pending');

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
(24, '4791034015318', 1),
(24, '4791034070287', 1),
(24, '4791034072366', 1),
(25, '4791034015318', 600),
(26, '4790015950624', 1),
(27, '4790015950624', 10),
(27, '4791034015318', 15),
(27, '4791034070287', 9),
(27, '4791034072366', 8),
(28, '4791034015318', 2),
(29, '4791034072366', 1);

-- --------------------------------------------------------

--
-- Table structure for table `distributor_stocks`
--

CREATE TABLE `distributor_stocks` (
  `dis_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0112223333', '0123456789', 13980, '2024-10-24'),
('0112223333', '0712345678', 1500, '2024-10-24'),
('0112223333', '0756789123', 2000, '2024-10-24'),
('0112223333', '0763322110', 0, '2024-11-20'),
('0112223333', '0776543210', 500, '2024-10-24'),
('0112223333', '0778765432', 2300, '2024-10-24'),
('0112223333', '0781234567', 3000, '2024-10-24'),
('0112223333', '0789988776', 3200, '2024-10-24'),
('0112223333', '0987654321', 950, '2024-10-24'),
('0701234567', '0123456789', 0, '2024-11-18'),
('0711234567', '0123456789', 0, '2024-11-18'),
('0714567890', '0123456789', 0, '2024-11-18'),
('0759876543', '0123456789', 0, '2024-11-18');

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
('0123456789', '0112223333', '2024-11-15 23:55:02'),
('0123456789', '0721234567', '2024-11-18 22:51:29'),
('0721112223', '0112223333', '2024-11-18 22:52:46');

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
  `barcode` varchar(13) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `bulk_price` float NOT NULL,
  `pic_format` varchar(10) NOT NULL,
  `man_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_product_requests`
--

INSERT INTO `pending_product_requests` (`barcode`, `product_name`, `unit_price`, `bulk_price`, `pic_format`, `man_phone`) VALUES
('1231233213211', 'Maliban Smart Cream Cracker 200g', 890, 450, '', '0771111111'),
('8976785674563', 'Maliban Gold Marie 500g', 200, 180, '', '0771111111'),
('9187265341231', 'Maliban Sun Cracker 80g', 170, 140, '', '0771111111');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order`
--

CREATE TABLE `pre_order` (
  `cus_phone` varchar(10) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `barcode` varchar(13) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit_price` float NOT NULL,
  `bulk_price` float NOT NULL,
  `pic_format` varchar(10) NOT NULL DEFAULT 'jpeg',
  `man_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `product_name`, `unit_price`, `bulk_price`, `pic_format`, `man_phone`) VALUES
('4790015950624', 'MALIBAN Full Cream Milk Powder 400g', 1050, 0, 'png', '0771111111'),
('4791010040044', 'NINJA POWER 12 0.01% MOSQUITO COILS', 200, 0, 'jpeg', ''),
('4791034015318', 'Maliban Krisco Snack Crackers Biscuits (170g)', 380, 0, 'jpg', '0771111111'),
('4791034070287', 'Maliban Chocolate Puff Biscuit 200g', 260, 0, 'png', '0771111111'),
('4791034072366', 'MALIBAN Real Chocolate Cream Biscuit', 240, 0, 'jpeg', '0771111111'),
('4791034072663', 'Maliban Orange Cream Biscuit 200g', 220, 0, 'webp', ''),
('4791111102948', 'CLOGARD fluoridated Toothpaste 120g', 240, 0, 'jpeg', ''),
('4792024019545', 'NESTOMOALT 450g', 780, 0, 'jpeg', ''),
('4792081031580', 'LUX soap 70g', 135, 0, 'jpeg', ''),
('4792173000005', 'WIJAYA Chilli Pieces 50g', 80, 0, 'jpeg', ''),
('4792225001189', 'DIAMOND full cream milk powder 400g', 1050, 0, 'jpeg', ''),
('4796000301471', 'MATARA FREELAN Roasted Curry Powder 50g', 100, 0, 'jpeg', ''),
('4796010610921', 'PURE DALE Full cream milk powder', 910, 0, 'jpeg', ''),
('4796020480217', 'ARALIYA PREMIUM NADU RICE 5kg', 1100, 0, 'jpeg', ''),
('8888101611705', 'MUNCHEE Cheese Buttons Biscuits', 400, 0, 'jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_agents`
--

CREATE TABLE `sales_agents` (
  `sa_phone` varchar(10) NOT NULL,
  `sa_busines_name` varchar(255) NOT NULL,
  `su_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_agents`
--

INSERT INTO `sales_agents` (`sa_phone`, `sa_busines_name`, `su_phone`) VALUES
('0372222690', 'Sumudu Bedaharinno', '0771111111'),
('0718976543', 'ghibibibin', '0771111111');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `so_phone` varchar(10) NOT NULL,
  `shop_name` varchar(20) NOT NULL,
  `shop_address` varchar(30) NOT NULL,
  `cash_drawer_balance` float NOT NULL,
  `bank_balance` float NOT NULL,
  `shop_pic_format` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`so_phone`, `shop_name`, `shop_address`, `cash_drawer_balance`, `bank_balance`, `shop_pic_format`) VALUES
('0112223333', 'Gamunu Stores', 'No. 13, Negombo Road, Kurunega', 64860, 0, '.jpg'),
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
('0774567890', 'Hambantota Corner', 'No. 22, Tissa Road, Hambantota', 13000, 40000, '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `order_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_unique_products`
--

CREATE TABLE `shop_unique_products` (
  `so_phone` varchar(10) NOT NULL,
  `product_code` varchar(3) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `unit_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `so_stocks`
--

CREATE TABLE `so_stocks` (
  `so_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `low_stock_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_stocks`
--

INSERT INTO `so_stocks` (`so_phone`, `barcode`, `quantity`, `low_stock_level`) VALUES
('0112223333', '4790015950624', 100, 50),
('0112223333', '4791010040044', 40, 50),
('0112223333', '4791034072366', 95, 100),
('0112223333', '4791111102948', 350, 100),
('0112223333', '4792024019545', 240, 50),
('0112223333', '4792173000005', 380, 100),
('0112223333', '8888101611705', 146, 20),
('0701234567', '4790015950624', 300, 0),
('0712345678', '4790015950624', 100, 0),
('0718765432', '4790015950624', 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `su_phone` varchar(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`su_phone`, `company_name`, `company_address`) VALUES
('0771111111', 'Maliban Biscuit Manufactories (Pvt) Limited ', '389 Galle Rd, Dehiwala-Mount Lavinia');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactions_id` int(11) NOT NULL,
  `type` enum('owner-bank','owner-business','bank-business','') NOT NULL,
  `amount` float NOT NULL,
  `so_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_description`
--

CREATE TABLE `transactions_description` (
  `transactions_id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `phone` varchar(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pic_format` varchar(10) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`phone`, `first_name`, `last_name`, `address`, `password`, `pic_format`, `role`) VALUES
('0112223333', 'Gamunu', 'Jayawardhana', 'No. 10, Negambo Road, Kurunegala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0123456789', 'Saman', 'Rathnayaka', 'No.120/1, Karadana, Gampaha', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', 'jpg', 0),
('0372222690', 'Sumudu', 'Karunarathna', 'No.6, High level road, Nugegoda', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', 'jpeg', 3),
('0701122334', 'Sarath', 'Gunasekara', 'No.12/3, Dutugemunu Mawatha, Maharagama', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0701234567', 'Rajan', 'Nadarajah', 'No. 10, Main Street, Jaffna', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0702345678', 'Suresh', 'Kanagarajah', 'No. 8, 2nd Cross Street, Vavuniya', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0709876543', 'Mala', 'Jayawardena', 'No.20, Madampe Junction, Chilaw', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0711234567', 'Nimal', 'Perera', 'No. 5, Temple Lane, Kandy', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0712345678', 'Nimal', 'Perera', 'No.12, Kadawatha Road, Ragama', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0713456789', 'Upul', 'Rajapaksha', 'No. 4, New Town, Polonnaruwa', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0714567890', 'Tharindu', 'Gunasekara', 'No. 8, Mallawapitiya, Kurunegala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0718765432', 'Chaminda', 'Edirisinghe', 'No. 3, Yakkala Road, Gampaha', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0718976543', 'Kumari', 'Rathnayake', 'No.45/7, Malwatte Road, Matara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 3),
('0719876543', 'Kasun', 'Bandara', 'No. 12, Muwagama, Ratnapura', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0721112223', 'Shanika', 'Jayasinghe', 'No.25, Kandy Road, Mawanella', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0721234567', 'Ruwan', 'Karunaratne', 'No. 10, Queen Elizabeth Drive, Nuwara Eliya', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0723456789', 'Kumara', 'De Silva', 'No. 30, Lighthouse Street, Galle', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0731234567', 'Roshan', 'Amarasinghe', 'No. 22, Orrs Hill, Trincomalee', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0734567890', 'Indika', 'Weerasinghe', 'No. 6, Kottukuliya, Puttalam', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0741234567', 'Chandana', 'Hettiarachchi', 'No. 12, Mihintale Road, Anuradhapura', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0747654321', 'Ruwan', 'Wickramasinghe', 'No.3/1, Aluthgama Road, Bandaragama', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0749876543', 'Nuwan', 'Dissanayake', 'No. 9, Kattankudy Road, Batticaloa', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0751234567', 'Samantha', 'Wijesinghe', 'No. 15, Wewahamanduwa, Matara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0756789123', 'Gayan', 'Kumarasinghe', 'No.14, Temple Lane, Kurunegala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0759876543', 'Sanjeewa', 'Ranasinghe', 'No. 1, Panadura Road, Kalutara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0761234567', 'Anura', 'Jayasinghe', 'No. 7, Sea Street, Negombo', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0762345678', 'Ranjith', 'Abeykoon', 'No. 11, Munneswaram Road, Chilaw', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0763322110', 'Hemantha', 'Dias', 'No.9, Lake Road, Anuradhapura', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0765432198', 'Anura', 'Bandara', 'No.44, Rathnapura Road, Eheliyagoda', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0770000000', 'Piyal', 'Karunarathna', 'No.6, High level road, Nugegoda.', '$2y$10$A7D1CK3gzVHgC5qx24EsYO2FXjvmu9v1U.HiqvXy8oVwJVhePO.Ry', '', 0),
('0771111111', 'Jagath', 'Madurapperuma', 'No.54/3, Negombo road, Kurunegala', '$2y$10$kDyZIwnOk2SKDkfYTYURDuCfrSMYFZ55dMewsclqK9fm3gJzzsUZO', '', 2),
('0772233445', 'Piumi', 'Senarath', 'No.7, Hospital Lane, Kalutara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0772345678', 'Mahesh', 'Senanayake', 'No. 6, Welimada Road, Badulla', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0774567890', 'Jagath', 'Mendis', 'No. 10, New Bazaar, Hambantota', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0776543210', 'Samantha', 'Fernando', 'No.66, Beach Road, Negombo', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0778765432', 'Sunil', 'Wijesinghe', 'No.55, Main Street, Piliyandala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0781234567', 'Chandani', 'Silva', 'No.30, Galle Road, Hikkaduwa', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0787766554', 'Janaka', 'Karunaratne', 'No.10/2, Rajagiriya Road, Nawala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0789988776', 'Harsha', 'Abeysekara', 'No.5, Peradeniya Road, Kandy', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0987654321', 'Kamala', 'Gunawardana', 'No.111, Batuwaththa, Meerigama', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', 'jpg', 0),
('22020586', 'Admin', 'Admin', 'Admin', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye', '', 4),
('6099649217', 'IhMaPZT9Ak', 'Z5YL4BjXrN', 'BJ8YRJPSu7', '$2y$10$CtBX9j.sUahzoQLPZQ9GgOMvztTkP/.hGuWVfSPks6.i7o4SxOBz2', '', 3),
('9089105656', 'm1uE3QtBIX', 'EYVLYqjOrM', 'stNCXXBTM8', '$2y$10$DP/GFByRCs9rVBEkSyT9aetwq/Haft6S0bWrZdqjlEbwL6sxJlGd6', '', 3),
('9208856537', 'bqajuME11B', 'hkxc37fBoR', 'ILobQm4cdb', '$2y$10$6UGxA/bLrX0zPO34c8jQr.eLJbM4DATl5JZEx7D9aJHxMFRqTvWCO', '', 3);

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
  ADD KEY `bills_ibfk_2` (`cus_phone`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`bill_id`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `sa_phone` (`sa_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `cus_phone` (`cus_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `chat_sa_su`
--
ALTER TABLE `chat_sa_su`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sa_phone` (`sa_phone`),
  ADD KEY `su_phone` (`su_phone`);

--
-- Indexes for table `chat_so_sa`
--
ALTER TABLE `chat_so_sa`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sa_phone` (`sa_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_phone`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD KEY `barcode` (`barcode`),
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
  ADD PRIMARY KEY (`order_id`,`barcode`);

--
-- Indexes for table `distributor_stocks`
--
ALTER TABLE `distributor_stocks`
  ADD PRIMARY KEY (`dis_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `loyalty_customers`
--
ALTER TABLE `loyalty_customers`
  ADD PRIMARY KEY (`so_phone`,`cus_phone`),
  ADD KEY `cus_phone` (`cus_phone`);

--
-- Indexes for table `loyalty_requests`
--
ALTER TABLE `loyalty_requests`
  ADD PRIMARY KEY (`cus_phone`,`so_phone`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `manufacturer_stock`
--
ALTER TABLE `manufacturer_stock`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  ADD PRIMARY KEY (`barcode`,`man_phone`),
  ADD KEY `man_phone` (`man_phone`);

--
-- Indexes for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`cus_phone`,`so_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `sales_agents`
--
ALTER TABLE `sales_agents`
  ADD PRIMARY KEY (`sa_phone`,`su_phone`),
  ADD KEY `su_phone` (`su_phone`);

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
-- Indexes for table `shop_unique_products`
--
ALTER TABLE `shop_unique_products`
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `so_stocks`
--
ALTER TABLE `so_stocks`
  ADD PRIMARY KEY (`so_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`su_phone`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactions_id`),
  ADD KEY `so_phone` (`so_phone`);

--
-- Indexes for table `transactions_description`
--
ALTER TABLE `transactions_description`
  ADD PRIMARY KEY (`transactions_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `bulk_order`
--
ALTER TABLE `bulk_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_sa_su`
--
ALTER TABLE `chat_sa_su`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_so_sa`
--
ALTER TABLE `chat_so_sa`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributer_orders`
--
ALTER TABLE `distributer_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bill_items_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD CONSTRAINT `bulk_order_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bulk_order_ibfk_2` FOREIGN KEY (`sa_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bulk_order_ibfk_3` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_cus_so`
--
ALTER TABLE `chat_cus_so`
  ADD CONSTRAINT `chat_cus_so_ibfk_1` FOREIGN KEY (`cus_phone`) REFERENCES `customers` (`cus_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_cus_so_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_sa_su`
--
ALTER TABLE `chat_sa_su`
  ADD CONSTRAINT `chat_sa_su_ibfk_1` FOREIGN KEY (`sa_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_sa_su_ibfk_2` FOREIGN KEY (`su_phone`) REFERENCES `suppliers` (`su_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_so_sa`
--
ALTER TABLE `chat_so_sa`
  ADD CONSTRAINT `chat_so_sa_ibfk_1` FOREIGN KEY (`sa_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_so_sa_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`cus_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributer_orders`
--
ALTER TABLE `distributer_orders`
  ADD CONSTRAINT `distributer_orders_ibfk_1` FOREIGN KEY (`dis_phone`) REFERENCES `sales_agents` (`sa_phone`) ON UPDATE CASCADE,
  ADD CONSTRAINT `distributer_orders_ibfk_2` FOREIGN KEY (`man_phone`) REFERENCES `suppliers` (`su_phone`) ON UPDATE CASCADE;

--
-- Constraints for table `distributer_order_items`
--
ALTER TABLE `distributer_order_items`
  ADD CONSTRAINT `distributer_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `distributer_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributor_stocks`
--
ALTER TABLE `distributor_stocks`
  ADD CONSTRAINT `distributor_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distributor_stocks_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loyalty_customers`
--
ALTER TABLE `loyalty_customers`
  ADD CONSTRAINT `loyalty_customers_ibfk_1` FOREIGN KEY (`cus_phone`) REFERENCES `customers` (`cus_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loyalty_customers_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loyalty_requests`
--
ALTER TABLE `loyalty_requests`
  ADD CONSTRAINT `loyalty_requests_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loyalty_requests_ibfk_2` FOREIGN KEY (`cus_phone`) REFERENCES `customers` (`cus_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufacturer_stock`
--
ALTER TABLE `manufacturer_stock`
  ADD CONSTRAINT `manufacturer_stock_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON UPDATE CASCADE;

--
-- Constraints for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  ADD CONSTRAINT `pending_product_requests_ibfk_1` FOREIGN KEY (`man_phone`) REFERENCES `suppliers` (`su_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD CONSTRAINT `pre_order_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pre_order_ibfk_2` FOREIGN KEY (`cus_phone`) REFERENCES `customers` (`cus_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pre_order_ibfk_3` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_agents`
--
ALTER TABLE `sales_agents`
  ADD CONSTRAINT `sales_agents_ibfk_1` FOREIGN KEY (`su_phone`) REFERENCES `suppliers` (`su_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_agents_ibfk_2` FOREIGN KEY (`sa_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `shop_orders_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `sales_agents` (`sa_phone`) ON UPDATE CASCADE;

--
-- Constraints for table `shop_unique_products`
--
ALTER TABLE `shop_unique_products`
  ADD CONSTRAINT `shop_unique_products_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `so_stocks`
--
ALTER TABLE `so_stocks`
  ADD CONSTRAINT `so_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_stocks_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`su_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions_description`
--
ALTER TABLE `transactions_description`
  ADD CONSTRAINT `transactions_description_ibfk_1` FOREIGN KEY (`transactions_id`) REFERENCES `transactions` (`transactions_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
