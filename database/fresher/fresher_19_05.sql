-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2015 at 10:15 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpis88ce`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Bảng Khu vực';

-- --------------------------------------------------------

--
-- Table structure for table `center`
--

CREATE TABLE IF NOT EXISTS `center` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Bảng Trung tâm';

-- --------------------------------------------------------

--
-- Table structure for table `dc_equipment`
--

CREATE TABLE IF NOT EXISTS `dc_equipment` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Bảng Thiết bị của tủ DC';

--
-- Dumping data for table `dc_equipment`
--

INSERT INTO `dc_equipment` (`id`, `name`) VALUES
(1, 'Tủ ắc quy 1'),
(2, 'Tủ ắc quy 2');

-- --------------------------------------------------------

--
-- Table structure for table `dc_equipment_status`
--

CREATE TABLE IF NOT EXISTS `dc_equipment_status` (
`id` int(11) NOT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `amperage` float DEFAULT '0' COMMENT 'cường độ dòng điện',
  `voltage` float DEFAULT '0' COMMENT 'điện áp',
  `temperature` float DEFAULT '0' COMMENT 'nhiệt độ',
  `station_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng thiết bị của tủ DC';

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(3) DEFAULT '1',
  `binary_pos` int(3) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Thiết bị';

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `active`, `binary_pos`) VALUES
(1, 'Điều hòa 1', 1, 0),
(2, 'Điều hòa 2', 1, 1),
(3, 'Còi báo động', 1, 2),
(4, 'Máy hút ẩm', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_status`
--

CREATE TABLE IF NOT EXISTS `equipment_status` (
`id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `station_id` int(11) DEFAULT '0',
  `station_code` varchar(100) NOT NULL COMMENT 'mã trạm',
  `configure` int(2) DEFAULT '0' COMMENT '0:auto | 1:manual',
  `active` int(2) DEFAULT '1' COMMENT '1:active | 0:unactive',
  `status` int(2) DEFAULT '1' COMMENT '0:Tắt | 1:Bật',
  `last_update` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Thông báo';

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `message_0`, `message_1`, `active`, `sensor_id`) VALUES
(1, 'Tình trạng đầu báo 3 chức năng', 'Không có đập phá', 'Báo đập phá máy', 1, 5),
(2, 'Tình trạng cửa', 'Cửa đang đóng', 'Báo mở cửa', 1, 6),
(3, 'Tình trạng dây loa', 'Dây loa an toàn', 'Dây loa bị cắt', 1, 12),
(4, 'Tình trạng điện lưới', 'Có điện lưới', 'Mất điện lưới', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1428253609),
('m130524_201442_init', 1428253616);

-- --------------------------------------------------------

--
-- Table structure for table `power_equipment`
--

CREATE TABLE IF NOT EXISTS `power_equipment` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Các thành phần của nguồn điện';

--
-- Dumping data for table `power_equipment`
--

INSERT INTO `power_equipment` (`id`, `name`, `unit_type`) VALUES
(1, 'Điện áp', 'voltage'),
(2, 'Công suất', 'capacity'),
(3, 'Điện năng tiêu thụ', 'consume'),
(4, 'Tần số', 'frequency');

-- --------------------------------------------------------

--
-- Table structure for table `power_status`
--

CREATE TABLE IF NOT EXISTS `power_status` (
`id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng nguồn điện của trạm';

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE IF NOT EXISTS `sensor` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_type` varchar(20) DEFAULT NULL,
  `type` int(3) DEFAULT '1' COMMENT '1:không có giá trị | 2:có giá trị',
  `binary_pos` int(3) DEFAULT '0',
  `active` int(3) DEFAULT '1' COMMENT '0: not active | 1:active'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Bảng Cảm biến';

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`id`, `name`, `unit_type`, `type`, `binary_pos`, `active`) VALUES
(1, 'Chế độ báo động', '', 2, 0, 1),
(3, 'Nhiệt độ trong phòng', 'temperature', 2, 0, 1),
(4, 'Độ ẩm trong phòng', 'humidity', 2, 0, 1),
(5, 'Cảm biến đập phá khoan cắt', NULL, 1, 0, 1),
(6, 'Cảm biến mở cửa', NULL, 1, 1, 1),
(12, 'Cảm biến đứt dây loa', NULL, 1, 2, 1),
(13, 'Điện lưới', NULL, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_status`
--

CREATE TABLE IF NOT EXISTS `sensor_status` (
`id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '1:bình thường'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng cảm biến';

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE IF NOT EXISTS `station` (
`id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `center_id` int(11) NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL DEFAULT '0',
  `type` int(3) NOT NULL DEFAULT '0',
  `firmware` varchar(255) DEFAULT NULL,
  `staff` varchar(50) DEFAULT NULL COMMENT 'nhân viên trực',
  `addition` tinytext COMMENT 'thông tin thêm',
  `picture_url` varchar(255) DEFAULT NULL COMMENT 'url chụp ảnh',
  `video_url` varchar(255) DEFAULT NULL COMMENT 'url video',
  `latitude` varchar(20) DEFAULT NULL COMMENT 'vĩ độ',
  `longtitude` varchar(20) DEFAULT NULL COMMENT 'kinh độ',
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT '3' COMMENT 'created by user id',
  `status` int(3) DEFAULT '0' COMMENT '0: not connect | 1:connected',
  `picture_warning_numb` int(11) DEFAULT '1' COMMENT 'số ảnh chụp khi có cảnh báo',
  `ip` varchar(50) DEFAULT '',
  `port` varchar(20) DEFAULT '',
  `change_equipment_status` int(3) DEFAULT '0' COMMENT '0: no change | 1: changed',
  `updated_at` int(11) DEFAULT '0',
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Bảng Trạm';

-- --------------------------------------------------------

--
-- Table structure for table `station_status`
--

CREATE TABLE IF NOT EXISTS `station_status` (
`id` int(11) NOT NULL,
  `station_id` int(11) DEFAULT NULL,
  `request_string` tinytext,
  `received` int(3) DEFAULT '1' COMMENT '2: gửi đi | 1: nhận được',
  `time_update` int(11) DEFAULT '0',
  `status` int(3) DEFAULT '1' COMMENT '0: thất bại | 1: thành công'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Trạng thái của trạm';

-- --------------------------------------------------------

--
-- Table structure for table `station_status_handler`
--

CREATE TABLE IF NOT EXISTS `station_status_handler` (
`id` int(11) NOT NULL,
  `equip_id` int(11) DEFAULT '0',
  `station_id` int(11) DEFAULT '0',
  `type` int(3) DEFAULT '1' COMMENT '1:equipment | 2:sensor(security)',
  `status` int(11) DEFAULT '0',
  `configure` int(11) DEFAULT '0',
  `updated` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `type` int(3) DEFAULT '1' COMMENT '1: user level 1 | 2: user level 2 | 10: (administrator)',
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT '0' COMMENT 'User id create',
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `created_at`, `updated_at`, `type`, `mobile`, `created_by`, `fullname`, `status`) VALUES
(1, 'root', 'jeBxBMGrgkdyPGDQlflewk0-bOfpIdn3', '$2y$13$BkQWiW7C0jg3OfRaDV4r1uxehk3dazAi8Ygo.4uQP4N6dbqA84UxO', NULL, 'vvdung88@gmail.com', 1429442709, 1429442709, 10, NULL, 0, 'Vương Dũng', 10);

-- --------------------------------------------------------

--
-- Table structure for table `warning`
--

CREATE TABLE IF NOT EXISTS `warning` (
`id` int(11) NOT NULL,
  `warning_type` int(11) DEFAULT '0' COMMENT 'loại cảnh báo',
  `station_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `warning_time` int(11) DEFAULT NULL COMMENT 'thời điểm cảnh báo',
  `read` int(3) DEFAULT '0' COMMENT '0: chưa xem | 1: đã xem'
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COMMENT='Bảng Cảnh báo';

-- --------------------------------------------------------

--
-- Table structure for table `warning_picture`
--

CREATE TABLE IF NOT EXISTS `warning_picture` (
`id` int(11) NOT NULL,
  `warning_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `center`
--
ALTER TABLE `center`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dc_equipment`
--
ALTER TABLE `dc_equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dc_equipment_status`
--
ALTER TABLE `dc_equipment_status`
 ADD PRIMARY KEY (`id`), ADD KEY `FkEquipment` (`equipment_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_status`
--
ALTER TABLE `equipment_status`
 ADD PRIMARY KEY (`id`), ADD KEY `FkStation` (`station_code`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `power_equipment`
--
ALTER TABLE `power_equipment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_status`
--
ALTER TABLE `power_status`
 ADD PRIMARY KEY (`id`), ADD KEY `FkItem` (`item_id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor_status`
--
ALTER TABLE `sensor_status`
 ADD PRIMARY KEY (`id`), ADD KEY `FkSensor` (`sensor_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UniqueCode` (`code`) USING BTREE, ADD KEY `FkCenter` (`center_id`), ADD KEY `FkArea` (`area_id`), ADD KEY `code` (`code`);

--
-- Indexes for table `station_status`
--
ALTER TABLE `station_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_status_handler`
--
ALTER TABLE `station_status_handler`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning`
--
ALTER TABLE `warning`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning_picture`
--
ALTER TABLE `warning_picture`
 ADD PRIMARY KEY (`id`), ADD KEY `PkWarning` (`warning_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `center`
--
ALTER TABLE `center`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dc_equipment`
--
ALTER TABLE `dc_equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dc_equipment_status`
--
ALTER TABLE `dc_equipment_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipment_status`
--
ALTER TABLE `equipment_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `power_equipment`
--
ALTER TABLE `power_equipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `power_status`
--
ALTER TABLE `power_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sensor_status`
--
ALTER TABLE `sensor_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `station_status`
--
ALTER TABLE `station_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `station_status_handler`
--
ALTER TABLE `station_status_handler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `warning`
--
ALTER TABLE `warning`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `warning_picture`
--
ALTER TABLE `warning_picture`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dc_equipment_status`
--
ALTER TABLE `dc_equipment_status`
ADD CONSTRAINT `FkEquipment` FOREIGN KEY (`equipment_id`) REFERENCES `dc_equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `power_status`
--
ALTER TABLE `power_status`
ADD CONSTRAINT `FkItem` FOREIGN KEY (`item_id`) REFERENCES `power_equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sensor_status`
--
ALTER TABLE `sensor_status`
ADD CONSTRAINT `FkSensor` FOREIGN KEY (`sensor_id`) REFERENCES `sensor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `station`
--
ALTER TABLE `station`
ADD CONSTRAINT `FkArea` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `FkCenter` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `warning_picture`
--
ALTER TABLE `warning_picture`
ADD CONSTRAINT `PkWarning` FOREIGN KEY (`warning_id`) REFERENCES `warning` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
