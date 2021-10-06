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
-- Table structure for table `insurance`
--

CREATE TABLE IF NOT EXISTS `insurance` (
`ID` int(11) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `Vehicle_Number` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `Insurance_Number` varchar(50) NOT NULL,
  `Validity` date NOT NULL,
  `Insurance_Company` varchar(50) NOT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`ID`, `DateTime`, `Vehicle_Number`, `dept`, `Insurance_Number`, `Validity`, `Insurance_Company`, `AddedBy`) VALUES
(1, '2021-09-06 20:36:44', 'TN061111', 'commercial', 'I111111111', '2021-09-30', 'ACKO', 'Firdouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Vehicle_Number` (`Vehicle_Number`,`Insurance_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
