-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 12:52 PM
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
(185, '2024-11-15', '23:44:32', '0123456789', '0112223333');

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
(185, '4791010040044', 4);

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
('0112223333', '0123456789', 2850, '2024-10-24'),
('0112223333', '0712345678', 1500, '2024-10-24'),
('0112223333', '0721112223', 0, '2024-11-16'),
('0112223333', '0756789123', 2000, '2024-10-24'),
('0112223333', '0776543210', 500, '2024-10-24'),
('0112223333', '0778765432', 2300, '2024-10-24'),
('0112223333', '0781234567', 3000, '2024-10-24'),
('0112223333', '0789988776', 3200, '2024-10-24'),
('0112223333', '0987654321', 950, '2024-10-24');

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
('0712345678', '0112223333', '2024-11-15 23:55:02'),
('0763322110', '0112223333', '2024-11-15 23:55:18'),
('0776543210', '0112223333', '2024-11-15 23:55:18'),
('0781234567', '0112223333', '2024-11-15 23:56:01');

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
  `sa_first_name` varchar(20) NOT NULL,
  `sa_last_name` varchar(20) NOT NULL,
  `sa_busines_name` varchar(255) NOT NULL,
  `sa_address` varchar(100) NOT NULL,
  `sa_pic_format` varchar(8) NOT NULL,
  `sa_password` varchar(256) NOT NULL DEFAULT 'password',
  `su_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_agents`
--

INSERT INTO `sales_agents` (`sa_phone`, `sa_first_name`, `sa_last_name`, `sa_busines_name`, `sa_address`, `sa_pic_format`, `sa_password`, `su_phone`) VALUES
('22', '3', 'd', 'q', 'c', '', 'password', '0112223333'),
('4111', 'd111', 'x111', 'a111', 'w111', 'png', 'password', '0112223333');

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
  `so_first_name` varchar(20) NOT NULL,
  `so_last_name` varchar(20) NOT NULL,
  `so_address` varchar(100) NOT NULL,
  `so_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`so_phone`, `shop_name`, `shop_address`, `cash_drawer_balance`, `bank_balance`, `so_first_name`, `so_last_name`, `so_address`, `so_password`) VALUES
('0112223333', 'default', 'default', 8450, 0, 'default', 'default', 'default', 'default');

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

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `su_phone` varchar(10) NOT NULL,
  `business_name` varchar(20) NOT NULL,
  `su_first_name` varchar(20) NOT NULL,
  `su_last_name` varchar(20) NOT NULL,
  `su_address` varchar(100) NOT NULL,
  `su_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`su_phone`, `business_name`, `su_first_name`, `su_last_name`, `su_address`, `su_password`) VALUES
('0112223333', 'Test', 'Sunil', 'Perera', 'Colombo', 'DEFAULT');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

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
  ADD CONSTRAINT `sales_agents_ibfk_1` FOREIGN KEY (`su_phone`) REFERENCES `suppliers` (`su_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sa_stocks`
--
ALTER TABLE `sa_stocks`
  ADD CONSTRAINT `sa_stocks_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sa_stocks_ibfk_2` FOREIGN KEY (`sa_phone`) REFERENCES `sales_agents` (`sa_phone`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
