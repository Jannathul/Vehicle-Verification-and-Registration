-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 04:20 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `theft`
--

CREATE TABLE IF NOT EXISTS `theft` (
`ID` int(10) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `Vehicle_No` varchar(50) NOT NULL,
  `Tdate` date NOT NULL,
  `Place` varchar(50) NOT NULL,
  `Complaint_Number` varchar(50) NOT NULL,
  `Document` varchar(50) NOT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theft`
--

INSERT INTO `theft` (`ID`, `DateTime`, `Vehicle_No`, `Tdate`, `Place`, `Complaint_Number`, `Document`, `AddedBy`) VALUES
(1, '2021-09-07 18:46:57', 'TN061111', '2021-09-07', 'chennai', 'h111111111', 'theft1.png', 'Firdouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `theft`
--
ALTER TABLE `theft`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Vehicle_Number` (`Vehicle_No`,`Complaint_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `theft`
--
ALTER TABLE `theft`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
