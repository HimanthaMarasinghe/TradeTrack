-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 03:32 PM
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
(197, '2024-11-23', '14:13:27', '0123456789', '0112223333');

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
(197, '4790015950624', 2);

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
('0112223333', '0123456789', 5400, '2024-10-24'),
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
  `pic_format` enum('jpeg','jpg','png','') NOT NULL DEFAULT 'jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `product_name`, `unit_price`, `pic_format`) VALUES
('4790015950624', 'MALIBAN Full Cream Milk Powder 400g', 1050, 'png'),
('4791010040044', 'NINJA POWER 12 0.01% MOSQUITO COILS', 200, 'jpeg'),
('4791034072366', 'MALIBAN Real Chocolate Cream Biscuit', 240, 'jpeg'),
('4791111102948', 'CLOGARD fluoridated Toothpaste 120g', 240, 'jpeg'),
('4792024019545', 'NESTOMOALT 450g', 780, 'jpeg'),
('4792081031580', 'LUX soap 70g', 135, 'jpeg'),
('4792173000005', 'WIJAYA Chilli Pieces 50g', 80, 'jpeg'),
('4792225001189', 'DIAMOND full cream milk powder 400g', 1050, 'jpeg'),
('4796000301471', 'MATARA FREELAN Roasted Curry Powder 50g', 100, 'jpeg'),
('4796010610921', 'PURE DALE Full cream milk powder', 910, 'jpeg'),
('4796020480217', 'ARALIYA PREMIUM NADU RICE 5kg', 1100, 'jpeg'),
('8888101611705', 'MUNCHEE Cheese Buttons Biscuits', 400, 'jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `sales_agents`
--

CREATE TABLE `sales_agents` (
  `sa_phone` varchar(10) NOT NULL,
  `sa_busines_name` varchar(255) NOT NULL,
  `su_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sa_stocks`
--

CREATE TABLE `sa_stocks` (
  `sa_phone` varchar(10) NOT NULL,
  `barcode` varchar(13) NOT NULL,
  `quantity` float NOT NULL,
  `wholesale_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0112223333', 'Gamunu Stores', 'No. 13, Negombo Road, Kurunega', 47300, 0, '.jpg'),
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
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_stocks`
--

INSERT INTO `so_stocks` (`so_phone`, `barcode`, `quantity`) VALUES
('0112223333', '4790015950624', 100),
('0112223333', '4791010040044', 50),
('0112223333', '4791034072366', 400),
('0112223333', '4791111102948', 350),
('0112223333', '4792024019545', 240),
('0112223333', '4792173000005', 380),
('0112223333', '8888101611705', 146),
('0701234567', '4790015950624', 300),
('0712345678', '4790015950624', 100),
('0718765432', '4790015950624', 200);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `su_phone` varchar(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('0718976543', 'Kumari', 'Rathnayake', 'No.45/7, Malwatte Road, Matara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
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
('0772233445', 'Piumi', 'Senarath', 'No.7, Hospital Lane, Kalutara', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0772345678', 'Mahesh', 'Senanayake', 'No. 6, Welimada Road, Badulla', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0774567890', 'Jagath', 'Mendis', 'No. 10, New Bazaar, Hambantota', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 1),
('0776543210', 'Samantha', 'Fernando', 'No.66, Beach Road, Negombo', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0778765432', 'Sunil', 'Wijesinghe', 'No.55, Main Street, Piliyandala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0781234567', 'Chandani', 'Silva', 'No.30, Galle Road, Hikkaduwa', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0787766554', 'Janaka', 'Karunaratne', 'No.10/2, Rajagiriya Road, Nawala', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0789988776', 'Harsha', 'Abeysekara', 'No.5, Peradeniya Road, Kandy', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0),
('0987654321', 'Kamala', 'Gunawardana', 'No.111, Batuwaththa, Meerigama', '$2y$10$UQ1xkopG8jblh/53K.XWOuIdGJQv8ZSW/WfZoqlHJ8PVqX8rDcpNi', '', 0);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`sa_phone`),
  ADD KEY `su_phone` (`su_phone`);

--
-- Indexes for table `sa_stocks`
--
ALTER TABLE `sa_stocks`
  ADD PRIMARY KEY (`sa_phone`,`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`so_phone`);

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
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

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
-- Constraints for table `sa_stocks`
--
ALTER TABLE `sa_stocks`
  ADD CONSTRAINT `sa_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sa_stocks_ibfk_2` FOREIGN KEY (`sa_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`so_phone`) REFERENCES `users` (`phone`) ON UPDATE CASCADE;

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
