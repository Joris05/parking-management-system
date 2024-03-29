-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 04:38 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `message`, `currency`) VALUES
(1, 'Parking Management', 'Bohol, Philippines', 'Thank your purchase please come back soon', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:28:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:14:\"createCategory\";i:9;s:14:\"updateCategory\";i:10;s:12:\"viewCategory\";i:11;s:14:\"deleteCategory\";i:12;s:11:\"createRates\";i:13;s:11:\"updateRates\";i:14;s:9:\"viewRates\";i:15;s:11:\"deleteRates\";i:16;s:11:\"createSlots\";i:17;s:11:\"updateSlots\";i:18;s:9:\"viewSlots\";i:19;s:11:\"deleteSlots\";i:20;s:13:\"createParking\";i:21;s:13:\"updateParking\";i:22;s:11:\"viewParking\";i:23;s:13:\"deleteParking\";i:24;s:13:\"updateCompany\";i:25;s:13:\"updateSetting\";i:26;s:11:\"viewReports\";i:27;s:11:\"viewProfile\";}'),
(5, 'Staff', 'a:6:{i:0;s:12:\"viewCategory\";i:1;s:9:\"viewRates\";i:2;s:9:\"viewSlots\";i:3;s:13:\"createParking\";i:4;s:13:\"updateParking\";i:5;s:11:\"viewParking\";}'),
(6, 'admin', 'a:22:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:11:\"createGroup\";i:4;s:11:\"updateGroup\";i:5;s:9:\"viewGroup\";i:6;s:14:\"createCategory\";i:7;s:14:\"updateCategory\";i:8;s:12:\"viewCategory\";i:9;s:11:\"createRates\";i:10;s:11:\"updateRates\";i:11;s:9:\"viewRates\";i:12;s:11:\"createSlots\";i:13;s:11:\"updateSlots\";i:14;s:9:\"viewSlots\";i:15;s:13:\"createParking\";i:16;s:13:\"updateParking\";i:17;s:11:\"viewParking\";i:18;s:13:\"updateCompany\";i:19;s:13:\"updateSetting\";i:20;s:11:\"viewReports\";i:21;s:11:\"viewProfile\";}');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `parking_code` varchar(255) NOT NULL,
  `customer` varchar(150) NOT NULL,
  `vehicle_cat_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `earned_amount` varchar(255) NOT NULL,
  `paid_status` int(1) NOT NULL,
  `vehicle_status` int(2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `parking_code`, `customer`, `vehicle_cat_id`, `rate_id`, `slot_id`, `in_time`, `out_time`, `total_time`, `earned_amount`, `paid_status`, `vehicle_status`, `user_id`) VALUES
(1, 'P-69B835', 'Joseph Santos', 1, 1, 4, '1682737675', '1682750861', '4', '50', 1, 0, 1),
(2, 'P-90F2AE', 'asdsad', 1, 1, 1, '1682750909', '1682750947', '1', '50', 1, 0, 1),
(3, 'P-FE0D8C', 'Migo', 1, 1, 2, '1682755286', '1682755342', '1', '50', 1, 0, 1),
(4, 'P-056A0F', 'ssdsd', 3, 3, 5, '1682757375', '1682757379', '1', '35', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `rate_name` varchar(255) NOT NULL,
  `vehicle_cat_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate_name`, `vehicle_cat_id`, `type`, `rate`, `active`) VALUES
(1, 'Vehicle Parking Fee', 1, 1, '50', 1),
(2, 'Motorcycle Parking Fee', 2, 1, '30', 1),
(3, 'Tricab Parking Fee', 3, 1, '35', 1),
(8, 'Dump Truck Fee', 11, 1, '200', 1),
(9, '10 Wheeler Vehicle Rate', 11, 1, '150', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `availability_status` int(11) NOT NULL,
  `vehicle_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot_name`, `active`, `availability_status`, `vehicle_cat_id`) VALUES
(1, 'Slot 1', 1, 1, 1),
(2, 'Slot 2', 1, 1, 1),
(3, 'Slot 1', 1, 1, 2),
(4, 'Slot 3', 1, 1, 1),
(5, 'Slot 1', 1, 1, 3),
(6, '1', 1, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@gmail.com', 'john', 'doe', '80789998', 1),
(8, 'test1', '5f4dcc3b5aa765d61d8327deb882cf99', 'test@gmail.com', 'test', 'test', '123123123123', 1),
(11, 'asdasd', 'a3dcb4d229de6fde0db5686dee47145d', 'asdasd@gmail.com', 'asd', 'asd', '23123123213', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(3, 2, 4),
(4, 3, 4),
(5, 4, 6),
(6, 5, 5),
(7, 6, 5),
(8, 7, 6),
(9, 8, 5),
(10, 11, 6);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_category`
--

CREATE TABLE `vehicle_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_category`
--

INSERT INTO `vehicle_category` (`id`, `name`, `active`) VALUES
(1, 'Vehicle', 1),
(2, 'Motorcycle', 1),
(3, 'Tricab', 1),
(11, 'Dump Truck', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `paid_status` (`paid_status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_cat_id` (`vehicle_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_category`
--
ALTER TABLE `vehicle_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
