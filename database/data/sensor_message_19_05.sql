-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2015 at 05:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gpis88ce`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message_0` varchar(255) DEFAULT NULL,
  `message_1` varchar(255) DEFAULT NULL,
  `active` int(3) DEFAULT '1' COMMENT '0:unactive | 1:active',
  `sensor_id` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='B?ng Th�ng b�o';

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `message_0`, `message_1`, `active`, `sensor_id`) VALUES
(1, 'T�nh tr?ng d?u b�o 3 ch?c nang', 'Kh�ng c� d?p ph�', 'B�o d?p ph� m�y', 1, 5),
(2, 'T�nh tr?ng c?a', 'C?a dang d�ng', 'B�o m? c?a', 1, 6),
(3, 'T�nh tr?ng d�y loa', 'D�y loa an to�n', 'D�y loa b? c?t', 1, 12),
(4, 'T�nh tr?ng di?n lu?i', 'C� di?n lu?i', 'M?t di?n lu?i', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE IF NOT EXISTS `sensor` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_type` varchar(20) DEFAULT NULL,
  `type` int(3) DEFAULT '1' COMMENT '1:kh�ng c� gi� tr? | 2:c� gi� tr?',
  `binary_pos` int(3) DEFAULT '0',
  `active` int(3) DEFAULT '1' COMMENT '0: not active | 1:active'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='B?ng C?m bi?n';

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id`, `name`, `unit_type`, `type`, `binary_pos`, `active`) VALUES
(1, 'Ch? d? b�o d?ng', '', 2, 0, 1),
(3, 'Nhi?t d? trong ph�ng', 'temperature', 2, 0, 1),
(4, '�? ?m trong ph�ng', 'humidity', 2, 0, 1),
(5, 'C?m bi?n d?p ph� khoan c?t', NULL, 1, 0, 1),
(6, 'C?m bi?n m? c?a', NULL, 1, 1, 1),
(7, 'C?m bi?n kh�i', NULL, 1, 0, 0),
(8, 'C?m bi?n nhi?t d?', NULL, 1, 0, 0),
(9, 'C?m bi?n l?t', NULL, 1, 0, 0),
(10, 'C?m bi?n k�nh', NULL, 1, 0, 0),
(11, '�i?n m�y ph�t', NULL, 1, 0, 0),
(12, 'C?m bi?n d?t d�y loa', NULL, 1, 2, 1),
(13, '�i?n lu?i', NULL, 1, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;