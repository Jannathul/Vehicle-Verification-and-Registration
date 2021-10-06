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
-- Table structure for table `rcbook`
--

CREATE TABLE IF NOT EXISTS `rcbook` (
`ID` int(10) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `Vehicle_Number` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Vehicle_Type` varchar(50) NOT NULL,
  `Model_Make` varchar(50) NOT NULL,
  `Manufacture_Date` date NOT NULL,
  `FC` date NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `RcBook_Document` varchar(50) DEFAULT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rcbook`
--

INSERT INTO `rcbook` (`ID`, `DateTime`, `Vehicle_Number`, `Name`, `Vehicle_Type`, `Model_Make`, `Manufacture_Date`, `FC`, `Photo`, `RcBook_Document`, `AddedBy`) VALUES
(1, '2021-09-06 20:33:55', 'TN061111', 'AAAAAAAA', 'BIKE', 'HONDA ACTIVA 6G', '2013-04-15', '2028-04-14', '1.png', 'RCBOOK1.png', 'Firdouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rcbook`
--
ALTER TABLE `rcbook`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Vehicle_Number` (`Vehicle_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rcbook`
--
ALTER TABLE `rcbook`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
