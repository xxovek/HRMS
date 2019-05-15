-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2019 at 08:38 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

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
-- Table structure for table `SalaryHeads`
--

CREATE TABLE `SalaryHeads` (
  `SalaryHeadId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `HeadName` varchar(50) DEFAULT NULL,
  `CredDebit` enum('C','D') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SalaryHeads`
--

INSERT INTO `SalaryHeads` (`SalaryHeadId`, `UserId`, `HeadName`, `CredDebit`, `created_at`, `updated_at`) VALUES
(1, 20, 'medical allownces', 'C', '2019-05-15 06:29:29', '2019-05-15 06:29:29'),
(2, NULL, 'Basic Salary', 'C', '2019-05-15 06:30:32', '2019-05-15 06:30:32'),
(3, NULL, 'CTC(Cost to company)', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(4, NULL, 'PF', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(5, NULL, 'Gratuity', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(6, NULL, 'Other Allowances', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(7, NULL, 'HRA(House Rent Allowance)', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(8, NULL, 'Conveyance Allowance', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(9, NULL, 'Leave Travel Allowance (LTA)', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(10, NULL, 'Dearness Allowance', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(11, NULL, 'EPF(Employer Provident fund)/Provident Fund', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(12, NULL, 'Public provident fund/PPF', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15'),
(13, NULL, 'Professional tax', 'C', '2019-05-15 06:36:15', '2019-05-15 06:36:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `SalaryHeads`
--
ALTER TABLE `SalaryHeads`
  ADD PRIMARY KEY (`SalaryHeadId`),
  ADD KEY `UserId` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `SalaryHeads`
--
ALTER TABLE `SalaryHeads`
  MODIFY `SalaryHeadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `SalaryHeads`
--
ALTER TABLE `SalaryHeads`
  ADD CONSTRAINT `SalaryHeads_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
