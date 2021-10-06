-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 04:19 PM
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
-- Table structure for table `epass`
--

CREATE TABLE IF NOT EXISTS `epass` (
`ID` int(10) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `VehicleNumber` varchar(50) NOT NULL,
  `PersonName` varchar(50) NOT NULL,
  `VehicleType` varchar(50) NOT NULL,
  `Additional` varchar(10) DEFAULT NULL,
  `Reason` varchar(50) NOT NULL,
  `FromAndTo` varchar(50) NOT NULL,
  `passvalid` date NOT NULL,
  `EPass` varchar(50) NOT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `epass`
--

INSERT INTO `epass` (`ID`, `DateTime`, `VehicleNumber`, `PersonName`, `VehicleType`, `Additional`, `Reason`, `FromAndTo`, `passvalid`, `EPass`, `AddedBy`) VALUES
(1, '2021-09-06 20:48:20', 'TN/CHN/OD/O/2131/2312', 'AAAAAAAA', 'MSME', '1', 'GOVERNMENT DUTIES', 'INTRA STATE', '2021-10-06', 'EPASS1.jpg', 'Firdouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `epass`
--
ALTER TABLE `epass`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`,`VehicleNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `epass`
--
ALTER TABLE `epass`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
