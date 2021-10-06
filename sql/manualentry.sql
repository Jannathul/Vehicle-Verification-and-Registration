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
-- Table structure for table `manualentry`
--

CREATE TABLE IF NOT EXISTS `manualentry` (
`ID` int(11) NOT NULL,
  `Licence_Number` varchar(50) NOT NULL,
  `Vehicle_Number` varchar(50) NOT NULL,
  `DateTime` varchar(50) NOT NULL,
  `AddedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manualentry`
--
ALTER TABLE `manualentry`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Licence Number` (`Licence_Number`,`Vehicle_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manualentry`
--
ALTER TABLE `manualentry`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
