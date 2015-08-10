/*
Navicat MySQL Data Transfer

Source Server         : JF
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : gpis88ce_fresher

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-05-31 08:48:27
*/

SET FOREIGN_KEY_CHECKS=0;

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
