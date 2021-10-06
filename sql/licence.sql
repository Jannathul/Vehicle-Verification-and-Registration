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
-- Table structure for table `licence`
--

CREATE TABLE IF NOT EXISTS `licence` (
`ID` int(10) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Licence_Number` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Vehicle_Type` varchar(50) NOT NULL,
  `Valid_Till` date NOT NULL,
  `Birth_Date` varchar(50) NOT NULL,
  `Licence_Photo` varchar(100) NOT NULL,
  `Licence_Document` varchar(100) DEFAULT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`ID`, `DateTime`, `Licence_Number`, `LName`, `Vehicle_Type`, `Valid_Till`, `Birth_Date`, `Licence_Photo`, `Licence_Document`, `AddedBy`) VALUES
(1, '2021-09-06 20:25:24', 'A11111111', 'AAAAAAAA', 'without Gear', '0000-00-00', '04/09/1980', '2.jpg', 'LICENCE1.png', 'Firdouse'),
(2, '2021-09-08 11:39:55', 'A22222222', 'BBBBBBBBBB', 'without gear', '2022-06-05', '04/09/1970', '4.jpg', 'LICENCE2.png', 'Firdouse'),
(3, '2021-09-08 11:47:31', 'A33333333333', 'CCCCCCCCCCC', 'with gear', '2040-06-05', '04/09/2000', 'image7.jpg', 'LICENCE3.png', 'Firdouse');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Licence_Number` (`Licence_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `licence`
--
ALTER TABLE `licence`
MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
