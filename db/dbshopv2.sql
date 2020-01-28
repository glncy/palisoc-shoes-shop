-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 06:46 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcheckout`
--

CREATE TABLE `tblcheckout` (
  `id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `products_id` varchar(200) NOT NULL,
  `qtys` varchar(200) NOT NULL,
  `billing_info` text NOT NULL,
  `shipping_info` text NOT NULL,
  `status` text NOT NULL,
  `price` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  `checkout_date` date NOT NULL,
  `user_id` int(255) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblitems`
--

CREATE TABLE `tblitems` (
  `id` int(255) NOT NULL,
  `category` varchar(10) NOT NULL,
  `size` int(10) NOT NULL,
  `picture` text NOT NULL,
  `qty` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sold` int(255) NOT NULL,
  `discount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbllist`
--

CREATE TABLE `tbllist` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblnotif`
--

CREATE TABLE `tblnotif` (
  `id` int(255) NOT NULL,
  `json_notif` text NOT NULL,
  `user_id` int(255) NOT NULL,
  `read_notif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `id` int(255) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblreviews`
--

CREATE TABLE `tblreviews` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `comment` text NOT NULL,
  `product_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblshipping_rates`
--

CREATE TABLE `tblshipping_rates` (
  `id` int(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `birth` date NOT NULL,
  `phone` varchar(50) NOT NULL,
  `house_no` int(10) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `q1` varchar(200) NOT NULL,
  `q2` varchar(200) NOT NULL,
  `q1_ans` varchar(200) NOT NULL,
  `q2_ans` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcheckout`
--
ALTER TABLE `tblcheckout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllist`
--
ALTER TABLE `tbllist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnotif`
--
ALTER TABLE `tblnotif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblshipping_rates`
--
ALTER TABLE `tblshipping_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcheckout`
--
ALTER TABLE `tblcheckout`
  MODIFY `id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblitems`
--
ALTER TABLE `tblitems`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbllist`
--
ALTER TABLE `tbllist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblnotif`
--
ALTER TABLE `tblnotif`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblshipping_rates`
--
ALTER TABLE `tblshipping_rates`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

INSERT INTO `tblusers` (`id`, `email`, `password`, `role`, `fname`, `lname`, `birth`, `phone`, `house_no`, `street`, `barangay`, `city`, `province`, `postal`, `q1`, `q2`, `q1_ans`, `q2_ans`) VALUES (NULL, 'admin', '9474421e91bdfef25ccb26e1d464633a', 'admin', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
