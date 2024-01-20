-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 10:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expresswait`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmins`
--

CREATE TABLE `tbladmins` (
  `admin_id` int(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_org` int(100) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmins`
--

INSERT INTO `tbladmins` (`admin_id`, `admin_name`, `admin_org`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'victor', 1, 'victor', '827ccb0eea8a706c4c34a16891f84e7b', 'victor@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblorganizations`
--

CREATE TABLE `tblorganizations` (
  `org_id` int(100) NOT NULL,
  `org_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorganizations`
--

INSERT INTO `tblorganizations` (`org_id`, `org_name`) VALUES
(0, 'Sample'),
(1, 'Victor and Vy Boba');

-- --------------------------------------------------------

--
-- Table structure for table `tblwaitlist`
--

CREATE TABLE `tblwaitlist` (
  `record_id` bigint(255) NOT NULL,
  `org_id` int(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `datetime_submitted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblwaitlist`
--

INSERT INTO `tblwaitlist` (`record_id`, `org_id`, `customer_name`, `customer_phone`, `datetime_submitted`) VALUES
(14, 1, 'first', '123', '12/18/2023, 2:10:35 AM'),
(15, 1, 'second', '123', '12/18/2023, 2:11:45 AM'),
(16, 1, '12', '', '12/18/2023, 2:27:35 AM'),
(17, 0, 'test', '', '12/18/2023, 2:50:54 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmins`
--
ALTER TABLE `tbladmins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tblorganizations`
--
ALTER TABLE `tblorganizations`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `tblwaitlist`
--
ALTER TABLE `tblwaitlist`
  ADD PRIMARY KEY (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmins`
--
ALTER TABLE `tbladmins`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblorganizations`
--
ALTER TABLE `tblorganizations`
  MODIFY `org_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblwaitlist`
--
ALTER TABLE `tblwaitlist`
  MODIFY `record_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
