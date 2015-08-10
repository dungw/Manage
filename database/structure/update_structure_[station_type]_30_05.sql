-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2015 at 09:11 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpis`
--

-- --------------------------------------------------------

--
-- Table structure for table `station_type`
--

CREATE TABLE IF NOT EXISTS `station_type` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(3) DEFAULT '1' COMMENT '0: không sử dụng | 1: sử dụng'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `station_type`
--

INSERT INTO `station_type` (`id`, `name`, `active`) VALUES
(1, 'Trạm ko có ATM', 0),
(2, 'Trạm có ATM', 1),
(3, 'Trạm BTS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `station_type`
--
ALTER TABLE `station_type`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `station_type`
--
ALTER TABLE `station_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
