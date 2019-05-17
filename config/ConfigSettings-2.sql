-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2019 at 02:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RecentHrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ConfigSettings`
--

CREATE TABLE `ConfigSettings` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PFPercent` int(11) NOT NULL,
  `SalComponentId` int(11) NOT NULL,
  `PT` int(11) DEFAULT NULL,
  `WorkHours` varchar(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ConfigSettings`
--

INSERT INTO `ConfigSettings` (`id`, `UserId`, `PFPercent`, `SalComponentId`, `PT`, `WorkHours`, `created_at`, `updated_at`) VALUES
(4, 20, 20, 20, 200, NULL, '2019-05-08 15:08:34', '2019-05-08 15:08:34'),
(5, 21, 5, 0, 5, NULL, '2019-05-08 16:41:27', '2019-05-08 16:41:27'),
(6, 21, 5, 0, 222, NULL, '2019-05-08 16:42:22', '2019-05-08 16:42:22'),
(7, 22, 20, 0, 100, NULL, '2019-05-10 15:47:46', '2019-05-10 15:47:46'),
(8, 22, 0, 0, 0, NULL, '2019-05-10 15:48:23', '2019-05-10 15:48:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ConfigSettings`
--
ALTER TABLE `ConfigSettings`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `CompanyDetails_ibfk_1` (`UserId`),
  ADD KEY `SalaryHeadId` (`SalComponentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ConfigSettings`
--
ALTER TABLE `ConfigSettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
