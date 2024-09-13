-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 07:26 AM
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
USE trade_track;
-- --------------------------------------------------------

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `product_name`, `unit_price`, `pic_format`) VALUES
('4790015950624', 'MALIBAN Full Cream Milk Powder 400g', 1050, 'png'),
('4791010040044', 'NINJA POWER 12 0.01% MOSQUITO COILS', 200, 'jpeg'),
('4791034072366', 'MALIBAN Real Chocolate Cream Biscuit', 240, 'jpeg'),
('4792024019545', 'NESTOMOALT 450g', 780, 'jpeg'),
('4792081031580', 'LUX soap 70g', 135, 'jpeg'),
('4792173000005', 'WIJAYA Chilli Pieces 50g', 80, 'jpeg'),
('4792225001189', 'DIAMOND full cream milk powder 400g', 1050, 'jpeg'),
('4796000301471', 'MATARA FREELAN Roasted Curry Powder 50g', 100, 'jpeg'),
('4796010610921', 'PURE DALE Full cream milk powder', 910, 'jpeg'),
('4796020480217', 'ARALIYA PREMIUM NADU RICE 5kg', 1100, 'jpeg'),
('8888101611705', 'MUNCHEE Cheese Buttons Biscuits', 400, 'jpeg')
ON DUPLICATE KEY UPDATE
`product_name` = VALUES(`product_name`),
`unit_price` = VALUES(`unit_price`),
`pic_format` = VALUES(`pic_format`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
