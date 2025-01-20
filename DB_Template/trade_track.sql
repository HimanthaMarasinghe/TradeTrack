-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 10:00 AM
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
(204, '2024-11-30', '20:19:39', '', '0112223333'),
(205, '2024-12-02', '11:23:38', '0123456789', '0112223333'),
(206, '2024-12-02', '12:45:29', '0123456789', '0112223333'),
(207, '2024-12-02', '12:47:55', '0123456789', '0112223333'),
(208, '2024-12-02', '13:47:35', '0123456789', '0112223333'),
(209, '2024-12-02', '15:46:01', '0123456789', '0112223333'),
(210, '2024-12-22', '13:52:48', '0987654321', '0112223333'),
(212, '2024-12-26', '17:06:24', '0123456789', '0112223333'),
(213, '2025-01-07', '11:23:01', '0123456789', '0112223333');

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
(204, '4791034072366', 3),
(205, '4790015950624', 3),
(205, '4791034015318', 4),
(206, '4791034070287', 3),
(206, '4791034072366', 3),
(207, '4791034070287', 2),
(207, '4791034072366', 3),
(207, '4791034072663', 4),
(208, '4791034070287', 3),
(208, '4791034072366', 1),
(208, '4791034072663', 3),
(209, '4791034070287', 4),
(209, '4791034072366', 7),
(209, '4791034072663', 1),
(210, '4791111102948', 6),
(212, '4790015950624', 22),
(213, '4791034072366', 12);

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
  `status` enum('Ready','Pending','Done','Processing') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributer_orders`
--

INSERT INTO `distributer_orders` (`order_id`, `date`, `time`, `dis_phone`, `man_phone`, `status`) VALUES
(31, '2024-12-01', '22:25:05', '0372222690', '0771111111', 'Processing'),
(32, '2024-12-01', '23:01:06', '0372222690', '0771111111', 'Processing'),
(33, '2024-12-02', '11:35:05', '0372222690', '0771111111', 'Processing'),
(37, '2024-12-26', '15:09:28', '0372222690', '0771111111', 'Processing'),
(38, '2024-12-26', '17:07:35', '0372222690', '0771111111', 'Processing'),
(39, '2025-01-07', '12:36:04', '0372222690', '0771111111', 'Pending');

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
(39, '4790015950624', 12);

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `dis_phone` varchar(10) NOT NULL,
  `dis_busines_name` varchar(255) NOT NULL,
  `dis_busines_address` varchar(255) NOT NULL,
  `man_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`dis_phone`, `dis_busines_name`, `dis_busines_address`, `man_phone`) VALUES
('0372222690', 'Sumudu Bedaharinno', 'No.112, High level road, Nugegoda.', '0771111111'),
('0718976543', 'ghibibibin', 'No.23/A, Negombo road, Kurunegala.', '0771111111');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_stocks`
--

CREATE TABLE `distributor_stocks` (
  `dis_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributor_stocks`
--

INSERT INTO `distributor_stocks` (`dis_phone`, `barcode`, `quantity`) VALUES
('0372222690', '4790015950624', 1000),
('0372222690', '4791034015318', 400),
('0372222690', '4791034070287', 300),
('0372222690', '4791034072366', 100);

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
('0112223333', '0123456789', 28220, '2024-10-24'),
('0112223333', '0712345678', 1500, '2024-10-24'),
('0112223333', '0756789123', 2000, '2024-10-24'),
('0112223333', '0770000000', 0, '2024-12-26'),
('0112223333', '0776543210', 0, '2024-10-24'),
('0112223333', '0789988776', 0, '2024-10-24'),
('0112223333', '0987654321', 560, '2024-10-24'),
('0701234567', '0123456789', 0, '2024-11-18'),
('0711234567', '0123456789', 0, '2024-11-18'),
('0714567890', '0123456789', 0, '2024-11-18'),
('0759876543', '0770000000', 0, '2024-11-18');

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
('0123456789', '0112223333', '2024-11-18 22:51:29');

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
  `man_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_product_requests`
--

INSERT INTO `pending_product_requests` (`id`, `barcode`, `product_name`, `unit_price`, `bulk_price`, `pic_format`, `man_phone`) VALUES
(4, '9187265341231', 'Maliban Sun Cracker 100g', 180, 140, '', '0771111111');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order`
--

CREATE TABLE `pre_order` (
  `so_phone` varchar(10) NOT NULL,
  `cus_phone` varchar(10) NOT NULL,
  `pre_order_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` enum('Pending','Processing','Ready','Picked','Rejected','Updated') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pre_order`
--

INSERT INTO `pre_order` (`so_phone`, `cus_phone`, `pre_order_id`, `date_time`, `status`) VALUES
('0112223333', '0123456789', 2, '2025-01-18 09:04:24', 'Rejected'),
('0112223333', '0123456789', 5, '2025-01-17 17:17:58', 'Rejected'),
('0112223333', '0756789123', 6, '2025-01-08 19:40:21', 'Picked'),
('0112223333', '0987654321', 4, '2025-01-17 17:17:58', 'Rejected');

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
(2, '4790015950624', 1, 1050),
(2, '4791010040044', 1, 200),
(2, '4792081031580', 110, 80);

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
('4790015950624', 'MALIBAN Full Cream Milk Powder 400g', 1050, 900, 'png', '0771111111'),
('4791010040044', 'NINJA POWER 12 0.01% MOSQUITO COILS', 200, 150, 'jpeg', ''),
('4791034015318', 'Maliban Krisco Snack Crackers Biscuits (170g)', 380, 280, 'jpg', '0771111111'),
('4791034070287', 'Maliban Chocolate Puff Biscuit 200g', 260, 180, 'png', '0771111111'),
('4791034072366', 'MALIBAN Real Chocolate Cream Biscuit', 240, 180, 'jpeg', '0771111111'),
('4791034072663', 'Maliban Orange Cream Biscuit 200g', 220, 180, 'webp', ''),
('4791111102948', 'CLOGARD fluoridated Toothpaste 120g', 240, 190, 'jpeg', ''),
('4792024019545', 'NESTOMOALT 450g', 780, 670, 'jpeg', ''),
('4792081031580', 'LUX soap 70g', 135, 100, 'jpeg', ''),
('4792173000005', 'WIJAYA Chilli Pieces 50g', 80, 65, 'jpeg', ''),
('4792225001189', 'DIAMOND full cream milk powder 400g', 1050, 900, 'jpeg', ''),
('4796000301471', 'MATARA FREELAN Roasted Curry Powder 50g', 100, 80, 'jpeg', ''),
('4796010610921', 'PURE DALE Full cream milk powder', 910, 800, 'jpeg', ''),
('4796020480217', 'ARALIYA PREMIUM NADU RICE 5kg', 1100, 1000, 'jpeg', ''),
('8888101611705', 'MUNCHEE Cheese Buttons Biscuits', 400, 320, 'jpeg', '');

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
('0112223333', 'Gamunu Stores', 'No. 13, Negombo Road, Kurunega', -876010, 0, '.jpg'),
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
-- Table structure for table `shop_order_items`
--

CREATE TABLE `shop_order_items` (
  `order_id` int(11) NOT NULL,
  `so_phone` varchar(10) NOT NULL,
  `dis_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL
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
  `low_stock_level` int(11) NOT NULL,
  `pre_orderable_stock` int(11) NOT NULL,
  `non_preorderable_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_stocks`
--

INSERT INTO `so_stocks` (`so_phone`, `barcode`, `quantity`, `low_stock_level`, `pre_orderable_stock`, `non_preorderable_stock`) VALUES
('0112223333', '4790015950624', 206, 50, 201, 5),
('0112223333', '4791010040044', 140, 50, 135, 5),
('0112223333', '4791034072366', 95, 100, 85, 10),
('0112223333', '4791111102948', 380, 100, 370, 10),
('0112223333', '4792024019545', 240, 50, 235, 5),
('0112223333', '4792081031580', 100, 20, 98, 2),
('0112223333', '4792173000005', 400, 100, 390, 10),
('0112223333', '4796020480217', 1000, 20, 998, 2),
('0112223333', '8888101611705', 146, 20, 144, 2),
('0701234567', '4790015950624', 300, 20, 298, 2),
('0712345678', '4790015950624', 100, 10, 99, 1),
('0718765432', '4790015950624', 200, 10, 199, 1);

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
  `pic_format` varchar(10) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`phone`, `first_name`, `last_name`, `address`, `pic_format`, `role`) VALUES
('0112223333', 'Gamunu', 'Jayawardhana', 'No. 10, Negambo Road, Kurunegala', '', 1),
('0123456789', 'Saman', 'Rathnayaka', 'No.120/1, Karadana, Gampaha', 'jpg', 0),
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
('0774567890', 'Jagath', 'Mendis', 'No. 10, New Bazaar, Hambantota', '', 1),
('0776543210', 'Samantha', 'Fernando', 'No.66, Beach Road, Negombo', '', 0),
('0778765432', 'Sunil', 'Wijesinghe', 'No.55, Main Street, Piliyandala', '', 0),
('0781234567', 'Chandani', 'Silva', 'No.30, Galle Road, Hikkaduwa', '', 0),
('0787766554', 'Janaka', 'Karunaratne', 'No.10/2, Rajagiriya Road, Nawala', '', 0),
('0789988776', 'Harsha', 'Abeysekara', 'No.5, Peradeniya Road, Kandy', '', 0),
('0987654321', 'Kamala', 'Gunawardana', 'No.111, Batuwaththa, Meerigama', 'jpg', 0),
('22020586', 'Admin', 'Admin', 'Admin', '', 4);

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
('0112223333', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('0123456789', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
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
('0774567890', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0776543210', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0778765432', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0781234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0787766554', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0789988776', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('0987654321', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('22020586', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('759876543', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('761234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('762345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('763322110', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('765432198', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('770000000', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('771111111', '$2y$10$LEyOQFzgjQNmezi9Yo0/E.8VQgfFPXcbRYB6P0mDQI.RDPMn88/ye'),
('772233445', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('772345678', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('774567890', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('776543210', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('778765432', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('781234567', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('787766554', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('789988776', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi'),
('987654321', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi');

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
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`dis_phone`,`man_phone`),
  ADD KEY `su_phone` (`man_phone`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`barcode`);

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
  ADD KEY `barcode` (`barcode`),
  ADD KEY `sa_phone` (`dis_phone`),
  ADD KEY `so_phone` (`so_phone`);

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
-- Indexes for table `user_passwords`
--
ALTER TABLE `user_passwords`
  ADD PRIMARY KEY (`phone`);

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
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pending_product_requests`
--
ALTER TABLE `pending_product_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `pre_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shop_orders`
--
ALTER TABLE `shop_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
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
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_ibfk_2` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `distributer_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `distributer_orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `shop_order_items_ibfk_2` FOREIGN KEY (`dis_phone`) REFERENCES `distributors` (`dis_phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shop_order_items_ibfk_3` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `shops` (`so_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions_description`
--
ALTER TABLE `transactions_description`
  ADD CONSTRAINT `transactions_description_ibfk_1` FOREIGN KEY (`transactions_id`) REFERENCES `transactions` (`transactions_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`phone`) REFERENCES `user_passwords` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
