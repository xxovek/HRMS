-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2019 at 01:33 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HrmsRecent`
--

-- --------------------------------------------------------

--
-- Table structure for table `TdsDetails`
--

CREATE TABLE `TdsDetails` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `FromBal` bigint(20) NOT NULL,
  `UptoBal` bigint(20) NOT NULL,
  `Percentage` int(4) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TdsDetails`
--

INSERT INTO `TdsDetails` (`id`, `userId`, `FromBal`, `UptoBal`, `Percentage`, `Created_at`) VALUES
(1, NULL, 0, 250000, 0, '2019-05-16 11:10:53'),
(3, NULL, 250000, 500000, 5, '2019-05-16 11:11:10'),
(4, NULL, 500000, 1000000, 20, '2019-05-16 11:11:33'),
(5, NULL, 1000000, 2000000, 30, '2019-05-16 11:12:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TdsDetails`
--
ALTER TABLE `TdsDetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TdsDetails`
--
ALTER TABLE `TdsDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `TdsDetails`
--
ALTER TABLE `TdsDetails`
  ADD CONSTRAINT `TdsDetails_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
