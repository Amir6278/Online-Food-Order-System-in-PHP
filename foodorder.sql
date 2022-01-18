-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2022 at 01:32 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin@mail.com', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_detaill_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_detaill_id`, `product_quantity`, `dt`) VALUES
(1, 2, 26, 2, '2022-01-18 12:20:31'),
(2, 1, 26, 4, '2022-01-18 12:13:13'),
(3, 2, 27, 2, '2022-01-18 12:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(11) NOT NULL,
  `order_num` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `order_num`, `status`, `added_on`) VALUES
(2, 'Desi Food', 1, 1, '2021-10-28 11:52:23'),
(3, 'Biriyani', 2, 1, '2021-10-28 11:52:59'),
(40, 'Fast Food', 3, 1, '2021-10-28 11:53:13'),
(41, 'Chinese ', 4, 1, '2021-10-28 11:53:27'),
(42, 'Desert', 5, 1, '2021-10-28 11:53:39'),
(43, 'Snacks', 6, 1, '2021-10-28 11:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(11) NOT NULL,
  `coupon_type` varchar(11) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `expired_on` datetime(6) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_code`
--

INSERT INTO `coupon_code` (`id`, `coupon_code`, `coupon_type`, `cart_min_value`, `expired_on`, `status`, `added_on`) VALUES
(1, 'ABARPIZZA10', 'FOOD', 300, '0000-00-00 00:00:00.000000', 1, '2021-09-09 10:43:38'),
(2, 'piiza40', 'R', 500, '0000-00-00 00:00:00.000000', 1, '2021-09-08 12:39:26'),
(5, 'new50', 'H', 1000, '2021-09-19 00:00:00.000000', 1, '2021-11-03 11:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` int(5) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `pass`, `mobile`, `status`, `added_on`) VALUES
(1, 'joHnA', '12345', 1969261257, 1, '2021-10-22 13:05:16'),
(2, 'xyz', '', 856123, 0, '2021-10-22 13:04:46'),
(3, 'xyz', '', 789, 1, '2021-09-07 11:36:48'),
(4, 'xyz', '', 456, 1, '2021-09-07 11:37:58'),
(5, 'xyz', '', 1258, 1, '2021-09-07 11:38:41'),
(6, 'xyz', '', 456789, 1, '2021-09-07 14:54:39'),
(7, 'xyz', '', 12345678, 1, '2021-09-07 14:56:57'),
(8, 'planet', '', 99999999, 1, '2021-10-26 16:04:33'),
(9, 'xyz', '', 2147483647, 0, '2021-10-26 16:03:13'),
(10, 'amir', '', 2273278, 1, '2022-01-18 09:21:34'),
(11, 'planet', '', 7777, 1, '2022-01-18 09:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dish` varchar(100) NOT NULL,
  `dish_detail` text NOT NULL,
  `image` text NOT NULL,
  `status` int(5) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `dish`, `dish_detail`, `image`, `status`, `added_on`) VALUES
(6, 2, 'Rice with Fish and Vegitable', 'jhal', 'IMG-617a902934c728.37788645.jpg', 1, '2021-09-11 10:49:16'),
(15, 2, 'Rice and Vorta', 'Rice and different Vorta and fish', 'IMG-617a91c4cc45f5.51910876.jpg', 0, '2021-10-28 12:03:36'),
(16, 2, 'Khichuri', 'Special Chicken Khichuri', 'IMG-617a9203d66687.85295529.jpg', 0, '2021-10-28 12:05:23'),
(17, 40, 'Burger', 'Chicken Cheese Burger', 'IMG-617a958d42b7d2.23156521.jpeg', 1, '2021-10-28 12:20:29'),
(18, 40, 'Pizza', 'BBQ Chicken Cheese Pizza', 'IMG-617a95c650af00.10035018.jpg', 1, '2021-10-28 12:21:26'),
(19, 42, 'Sweets', 'Collection of sweets', 'IMG-617a964e0bb006.52169846.jpg', 1, '2021-10-28 12:23:42'),
(20, 41, 'Thai Soup', 'Special Thai Soup', 'IMG-617a966ba4cbb7.16593684.jpg', 1, '2021-10-28 12:24:11'),
(21, 41, 'Platter', 'Fried Rice with  Chicken & Vegetable', 'IMG-617a96c45dc321.29402730.jpg', 1, '2021-10-28 12:25:40'),
(22, 3, 'Morog Polaw', 'Shahi morog polaw', 'IMG-617a9a88f0f177.72318847.jpg', 1, '2021-10-28 12:41:44'),
(23, 3, 'Mutton kacchi', 'Basmati Mutton Kacchi', 'IMG-617a9ab42d69c9.09440343.jpg', 1, '2021-10-28 12:42:28'),
(24, 3, 'Beef Tehari', ' Beef Tehari', 'IMG-617a9b1ae65423.63265921.jpg', 0, '2021-10-28 12:44:10'),
(25, 43, 'Fuchka', 'Doi Fuchka', 'IMG-617a9b331f1981.44561752.jpg', 1, '2021-10-28 12:44:35'),
(26, 43, 'Chips', 'Crispy Potato', 'IMG-617bb67eee2d07.62346557.jpg', 1, '2021-10-29 08:53:18'),
(27, 40, 'Pasta', 'Chicken Pasta', 'IMG-6182e29dab18b1.86400780.jpg', 1, '2021-11-03 19:27:25'),
(28, 0, 'Shahi Morog Polaw with Beef', 'Morog Polaw with beef', 'IMG-618a878f0d05f1.86792570.jpg', 1, '2021-11-03 19:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `dish_detail`
--

CREATE TABLE `dish_detail` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_detail`
--

INSERT INTO `dish_detail` (`id`, `dish_id`, `attribute`, `price`, `status`, `added_on`) VALUES
(23, 6, 'Full Plate', 150, 1, '2021-10-30 15:20:59'),
(24, 6, '1:3', 400, 1, '2021-10-30 15:20:59'),
(25, 15, '1 plate', 100, 1, '2021-10-30 15:21:31'),
(26, 16, 'Per Plate', 120, 1, '2021-10-30 15:22:08'),
(27, 18, '6 inch', 120, 1, '2021-10-30 15:22:48'),
(28, 18, '9 inch', 180, 1, '2021-10-30 15:22:48'),
(29, 18, '12 inch', 300, 1, '2021-10-30 15:22:48'),
(30, 17, 'Mini', 50, 1, '2021-10-30 15:23:46'),
(31, 17, 'Regular', 100, 1, '2021-10-30 15:23:46'),
(32, 17, 'Double layer Chicken', 200, 1, '2021-10-30 15:23:46'),
(33, 19, '250gm', 200, 1, '2021-10-30 15:24:44'),
(34, 19, '500 gm', 380, 1, '2021-10-30 15:24:44'),
(35, 19, '1kg', 750, 1, '2021-10-30 15:24:44'),
(36, 22, 'Full Plate', 150, 1, '2021-10-30 15:25:07'),
(37, 22, '1:3', 400, 1, '2021-10-30 15:25:07'),
(38, 23, 'Regular', 180, 1, '2021-10-30 15:25:35'),
(39, 23, 'Special', 250, 1, '2021-10-30 15:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `dish_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oprice` float NOT NULL,
  `order_status` int(11) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`od_id`, `user_id`, `order_id`, `dish_detail_id`, `quantity`, `oprice`, `order_status`, `dt`) VALUES
(1, 2, 'food61e6b09c6ceb3', 26, 2, 530, 0, '2022-01-18 12:20:44'),
(2, 2, 'food61e6b09c6ceb3', 27, 2, 530, 0, '2022-01-18 12:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `total_price` float NOT NULL,
  `gst` float NOT NULL,
  `delivery_boy_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `mobile`, `address`, `status`, `added_on`) VALUES
(1, 'khadok', 'khadok@mail.com', '$2y$10$EVn6OhxI32ys4B0YQ4m./ueMCL.sl1oLdooE.xg0SPSymC41rwv1S', 1969261258, 'dhaka', 1, '2022-01-18 10:24:20.19431'),
(2, 'amir', 'amir@mail.com', '$2y$10$Px5cEM4p24JiTl4wE3mtWufjzI4CPZ.vcFOnjnbeQMkLgUoTVgapy', 1969261259, 'dhaka', 1, '2022-01-18 10:26:42.04711'),
(3, 'test', 'test@mail.com', '$2y$10$/kzEOoSQed9beNexR2e3gOBRmwmEZC0fk4r.SryTR.LogTmNr/7Zy', 12345, 'dhaka', 1, '2022-01-18 11:13:23.20219'),
(4, 'sparko', 'sparko@mail.com', '$2y$10$5rGpdHOOBT6Boq6EsBQ/7OvQftQMYklgV8mRoOor15vW2Pe55qmk2', 1234, 'dhaka', 1, '2022-01-18 11:14:00.63508');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_detail`
--
ALTER TABLE `dish_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `dish_detail`
--
ALTER TABLE `dish_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
