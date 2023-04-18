-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 03:31 AM
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
  `paid_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `parking_code`, `customer`, `vehicle_cat_id`, `rate_id`, `slot_id`, `in_time`, `out_time`, `total_time`, `earned_amount`, `paid_status`) VALUES
(6, 'P-AB9C3F', '', 3, 3, 1, '1677917562', '1678072550', '44', '35', 1),
(9, 'P-BD3936', '', 1, 1, 2, '1678072869', '1678089399', '5', '50', 1),
(10, 'P-194548', '', 3, 3, 1, '1678089535', '1678089569', '1', '35', 1),
(11, 'P-CBBE6A', '', 2, 2, 2, '1678089544', '1678089577', '1', '30', 1),
(12, 'P-A92B6B', '', 2, 2, 6, '1678089549', '1678089574', '1', '30', 1),
(13, 'P-36DA23', '', 3, 3, 1, '1678090571', '1678090574', '1', '35', 1),
(14, 'P-6A91F5', '', 11, 8, 7, '1678263326', '1678263353', '1', '200', 1),
(15, 'P-B7718C', 'Joseph Santos', 2, 2, 1, '1681780914', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
