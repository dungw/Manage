/*
Navicat MySQL Data Transfer

Source Server         : JF
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : gpis88ce_fresher

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-05-31 08:35:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `area`
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='Bảng Khu vực';

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES ('1', 'An Giang');
INSERT INTO `area` VALUES ('2', 'Bà Rịa - Vũng Tàu');
INSERT INTO `area` VALUES ('3', 'Bắc Giang');
INSERT INTO `area` VALUES ('4', 'Bắc Kạn');
INSERT INTO `area` VALUES ('5', 'Bạc Liêu');
INSERT INTO `area` VALUES ('6', 'Bắc Ninh');
INSERT INTO `area` VALUES ('7', 'Bến Tre');
INSERT INTO `area` VALUES ('8', 'Bình Định');
INSERT INTO `area` VALUES ('9', 'Bình Dương');
INSERT INTO `area` VALUES ('10', 'Bình Phước');
INSERT INTO `area` VALUES ('11', 'Bình Thuận');
INSERT INTO `area` VALUES ('12', 'Cà Mau');
INSERT INTO `area` VALUES ('13', 'Cao Bằng');
INSERT INTO `area` VALUES ('14', 'Đắk Lắk');
INSERT INTO `area` VALUES ('15', 'Đắk Nông');
INSERT INTO `area` VALUES ('16', 'Điện Biên');
INSERT INTO `area` VALUES ('17', 'Đồng Nai');
INSERT INTO `area` VALUES ('18', 'Đồng Tháp');
INSERT INTO `area` VALUES ('19', 'Gia Lai');
INSERT INTO `area` VALUES ('20', 'Hà Giang');
INSERT INTO `area` VALUES ('21', 'Hà Nam');
INSERT INTO `area` VALUES ('22', 'Hà Tĩnh');
INSERT INTO `area` VALUES ('23', 'Hải Dương');
INSERT INTO `area` VALUES ('24', 'Hậu Giang');
INSERT INTO `area` VALUES ('25', 'Hòa Bình');
INSERT INTO `area` VALUES ('26', 'Hưng Yên');
INSERT INTO `area` VALUES ('27', 'Khánh Hòa');
INSERT INTO `area` VALUES ('28', 'Kiên Giang');
INSERT INTO `area` VALUES ('29', 'Kon Tum');
INSERT INTO `area` VALUES ('30', 'Lai Châu');
INSERT INTO `area` VALUES ('31', 'Lâm Đồng');
INSERT INTO `area` VALUES ('32', 'Lạng Sơn');
INSERT INTO `area` VALUES ('33', 'Lào Cai');
INSERT INTO `area` VALUES ('34', 'Long An');
INSERT INTO `area` VALUES ('35', 'Nam Định');
INSERT INTO `area` VALUES ('36', 'Nghệ An');
INSERT INTO `area` VALUES ('37', 'Ninh Bình');
INSERT INTO `area` VALUES ('38', 'Ninh Thuận');
INSERT INTO `area` VALUES ('39', 'Phú Thọ');
INSERT INTO `area` VALUES ('40', 'Quảng Bình');
INSERT INTO `area` VALUES ('41', 'Quảng Nam');
INSERT INTO `area` VALUES ('42', 'Quảng Ngãi');
INSERT INTO `area` VALUES ('43', 'Quảng Ninh');
INSERT INTO `area` VALUES ('44', 'Quảng Trị');
INSERT INTO `area` VALUES ('45', 'Sóc Trăng');
INSERT INTO `area` VALUES ('46', 'Sơn La');
INSERT INTO `area` VALUES ('47', 'Tây Ninh');
INSERT INTO `area` VALUES ('48', 'Thái Bình');
INSERT INTO `area` VALUES ('49', 'Thái Nguyên');
INSERT INTO `area` VALUES ('50', 'Thanh Hóa');
INSERT INTO `area` VALUES ('51', 'Thừa Thiên Huế');
INSERT INTO `area` VALUES ('52', 'Tiền Giang');
INSERT INTO `area` VALUES ('53', 'Trà Vinh');
INSERT INTO `area` VALUES ('54', 'Tuyên Quang');
INSERT INTO `area` VALUES ('55', 'Vĩnh Long');
INSERT INTO `area` VALUES ('56', 'Vĩnh Phúc');
INSERT INTO `area` VALUES ('57', 'Yên Bái');
INSERT INTO `area` VALUES ('58', 'Phú Yên');
INSERT INTO `area` VALUES ('59', 'Cần Thơ');
INSERT INTO `area` VALUES ('60', 'Đà Nẵng');
INSERT INTO `area` VALUES ('61', 'Hải Phòng');
INSERT INTO `area` VALUES ('62', 'Hà Nội');
INSERT INTO `area` VALUES ('63', 'TP HCM');

-- ----------------------------
-- Table structure for `center`
-- ----------------------------
DROP TABLE IF EXISTS `center`;
CREATE TABLE `center` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Bảng Trung tâm';

-- ----------------------------
-- Records of center
-- ----------------------------
INSERT INTO `center` VALUES ('1', 'Trung tâm 01');
INSERT INTO `center` VALUES ('2', 'Trung tâm 02');
INSERT INTO `center` VALUES ('3', 'Trung tâm 03');
INSERT INTO `center` VALUES ('4', 'Trung tâm 04');
INSERT INTO `center` VALUES ('5', 'Trung tâm 05');
INSERT INTO `center` VALUES ('6', 'Trung tâm 06');
INSERT INTO `center` VALUES ('7', 'Trung tâm 07');
INSERT INTO `center` VALUES ('8', 'Trung tâm 08');
INSERT INTO `center` VALUES ('9', 'Trung tâm 09');
INSERT INTO `center` VALUES ('10', 'Trung tâm 10');

-- ----------------------------
-- Table structure for `dc_equipment`
-- ----------------------------
DROP TABLE IF EXISTS `dc_equipment`;
CREATE TABLE `dc_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Bảng Thiết bị của tủ DC';

-- ----------------------------
-- Records of dc_equipment
-- ----------------------------
INSERT INTO `dc_equipment` VALUES ('1', 'Tủ ắc quy 1');
INSERT INTO `dc_equipment` VALUES ('2', 'Tủ ắc quy 2');

-- ----------------------------
-- Table structure for `dc_equipment_status`
-- ----------------------------
DROP TABLE IF EXISTS `dc_equipment_status`;
CREATE TABLE `dc_equipment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(11) DEFAULT NULL,
  `amperage` float DEFAULT '0' COMMENT 'cường độ dòng điện',
  `voltage` float DEFAULT '0' COMMENT 'điện áp',
  `temperature` float DEFAULT '0' COMMENT 'nhiệt độ',
  `station_id` int(11) NOT NULL DEFAULT '0',
  `status` int(5) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng thiết bị của tủ DC';

-- ----------------------------
-- Records of dc_equipment_status
-- ----------------------------

-- ----------------------------
-- Table structure for `equipment`
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(3) DEFAULT '1',
  `binary_pos` int(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Thiết bị';

-- ----------------------------
-- Records of equipment
-- ----------------------------
INSERT INTO `equipment` VALUES ('1', 'Điều hòa 1', '1', '0');
INSERT INTO `equipment` VALUES ('2', 'Điều hòa 2', '1', '1');
INSERT INTO `equipment` VALUES ('3', 'Còi báo động', '1', '2');
INSERT INTO `equipment` VALUES ('4', 'Máy hút ẩm', '1', '3');

-- ----------------------------
-- Table structure for `equipment_status`
-- ----------------------------
DROP TABLE IF EXISTS `equipment_status`;
CREATE TABLE `equipment_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(11) NOT NULL,
  `station_id` int(11) DEFAULT '0',
  `station_code` varchar(100) NOT NULL COMMENT 'mã trạm',
  `configure` int(2) DEFAULT '0' COMMENT '0:auto | 1:manual',
  `active` int(2) DEFAULT '1' COMMENT '1:active | 0:unactive',
  `status` int(2) DEFAULT '1' COMMENT '0:Tắt | 1:Bật',
  `last_update` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FkStation` (`station_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equipment_status
-- ----------------------------

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `message_0` varchar(255) DEFAULT NULL,
  `message_1` varchar(255) DEFAULT NULL,
  `active` int(3) DEFAULT '1' COMMENT '0:unactive | 1:active',
  `sensor_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Thông báo';

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', 'Tình trạng đầu báo 3 chức năng', 'Không có đập phá', 'Báo đập phá máy', '1', '5');
INSERT INTO `message` VALUES ('2', 'Tình trạng cửa', 'Cửa đang đóng', 'Báo mở cửa', '1', '6');
INSERT INTO `message` VALUES ('3', 'Tình trạng dây loa', 'Dây loa an toàn', 'Dây loa bị cắt', '1', '12');
INSERT INTO `message` VALUES ('4', 'Tình trạng điện lưới', 'Có điện lưới', 'Mất điện lưới', '1', '13');

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1428253609');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1428253616');

-- ----------------------------
-- Table structure for `power_equipment`
-- ----------------------------
DROP TABLE IF EXISTS `power_equipment`;
CREATE TABLE `power_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Bảng Các thành phần của nguồn điện';

-- ----------------------------
-- Records of power_equipment
-- ----------------------------
INSERT INTO `power_equipment` VALUES ('1', 'Điện áp', 'voltage');
INSERT INTO `power_equipment` VALUES ('2', 'Công suất', 'capacity');
INSERT INTO `power_equipment` VALUES ('3', 'Điện năng tiêu thụ', 'consume');
INSERT INTO `power_equipment` VALUES ('4', 'Tần số', 'frequency');

-- ----------------------------
-- Table structure for `power_status`
-- ----------------------------
DROP TABLE IF EXISTS `power_status`;
CREATE TABLE `power_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng nguồn điện của trạm';

-- ----------------------------
-- Records of power_status
-- ----------------------------

-- ----------------------------
-- Table structure for `sensor`
-- ----------------------------
DROP TABLE IF EXISTS `sensor`;
CREATE TABLE `sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unit_type` varchar(20) DEFAULT NULL,
  `type` int(3) DEFAULT '1' COMMENT '1:không có giá trị | 2:có giá trị',
  `binary_pos` int(3) DEFAULT '0',
  `active` int(3) DEFAULT '1' COMMENT '0: not active | 1:active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Bảng Cảm biến';

-- ----------------------------
-- Records of sensor
-- ----------------------------
INSERT INTO `sensor` VALUES ('1', 'Chế độ báo động', '', '2', '0', '1');
INSERT INTO `sensor` VALUES ('3', 'Nhiệt độ trong phòng', 'temperature', '2', '0', '1');
INSERT INTO `sensor` VALUES ('4', 'Độ ẩm trong phòng', 'humidity', '2', '0', '1');
INSERT INTO `sensor` VALUES ('5', 'Cảm biến đập phá khoan cắt', null, '1', '0', '1');
INSERT INTO `sensor` VALUES ('6', 'Cảm biến mở cửa', null, '1', '1', '1');
INSERT INTO `sensor` VALUES ('12', 'Cảm biến đứt dây loa', null, '1', '2', '1');
INSERT INTO `sensor` VALUES ('13', 'Điện lưới', null, '1', '3', '1');

-- ----------------------------
-- Table structure for `sensor_status`
-- ----------------------------
DROP TABLE IF EXISTS `sensor_status`;
CREATE TABLE `sensor_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '1:bình thường',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Tình trạng cảm biến';

-- ----------------------------
-- Records of sensor_status
-- ----------------------------

-- ----------------------------
-- Table structure for `station`
-- ----------------------------
DROP TABLE IF EXISTS `station`;
CREATE TABLE `station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Trạm';

-- ----------------------------
-- Records of station
-- ----------------------------

-- ----------------------------
-- Table structure for `station_status`
-- ----------------------------
DROP TABLE IF EXISTS `station_status`;
CREATE TABLE `station_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `station_id` int(11) DEFAULT NULL,
  `request_string` tinytext,
  `received` int(3) DEFAULT '1' COMMENT '2: gửi đi | 1: nhận được',
  `time_update` int(11) DEFAULT '0',
  `status` int(3) DEFAULT '1' COMMENT '0: thất bại | 1: thành công',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Trạng thái của trạm';

-- ----------------------------
-- Records of station_status
-- ----------------------------

-- ----------------------------
-- Table structure for `station_status_handler`
-- ----------------------------
DROP TABLE IF EXISTS `station_status_handler`;
CREATE TABLE `station_status_handler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_id` int(11) DEFAULT '0',
  `station_id` int(11) DEFAULT '0',
  `type` int(3) DEFAULT '1' COMMENT '1:equipment | 2:sensor(security)',
  `status` int(11) DEFAULT '0',
  `configure` int(11) DEFAULT '0',
  `updated` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of station_status_handler
-- ----------------------------

-- ----------------------------
-- Table structure for `station_type`
-- ----------------------------
DROP TABLE IF EXISTS `station_type`;
CREATE TABLE `station_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(3) DEFAULT '1' COMMENT '0: không sử dụng | 1: sử dụng',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of station_type
-- ----------------------------
INSERT INTO `station_type` VALUES ('1', 'Trạm ko có ATM', '0');
INSERT INTO `station_type` VALUES ('2', 'Trạm có ATM', '1');
INSERT INTO `station_type` VALUES ('3', 'Trạm BTS', '1');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` smallint(6) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'root', 'jeBxBMGrgkdyPGDQlflewk0-bOfpIdn3', '$2y$13$BkQWiW7C0jg3OfRaDV4r1uxehk3dazAi8Ygo.4uQP4N6dbqA84UxO', null, 'vvdung88@gmail.com', '1429442709', '1429442709', '10', null, '0', 'Vương Dũng', '10');

-- ----------------------------
-- Table structure for `warning`
-- ----------------------------
DROP TABLE IF EXISTS `warning`;
CREATE TABLE `warning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_type` int(11) DEFAULT '0' COMMENT 'loại cảnh báo',
  `station_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `warning_time` int(11) DEFAULT NULL COMMENT 'thời điểm cảnh báo',
  `read` int(3) DEFAULT '0' COMMENT '0: chưa xem | 1: đã xem',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng Cảnh báo';

-- ----------------------------
-- Records of warning
-- ----------------------------

-- ----------------------------
-- Table structure for `warning_picture`
-- ----------------------------
DROP TABLE IF EXISTS `warning_picture`;
CREATE TABLE `warning_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of warning_picture
-- ----------------------------
