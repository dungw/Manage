/*
Navicat MySQL Data Transfer

Source Server         : JF
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : gpis88ce_fresher

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-05-31 08:48:15
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
