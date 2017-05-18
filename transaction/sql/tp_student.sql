/*
Navicat MySQL Data Transfer

Source Server         : www
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2017-05-18 16:36:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_student
-- ----------------------------
DROP TABLE IF EXISTS `tp_student`;
CREATE TABLE `tp_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `age` int(3) NOT NULL COMMENT '年龄',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别：0：男，1：女',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_student
-- ----------------------------
INSERT INTO `tp_student` VALUES ('1', '姚明', '34', '0');
INSERT INTO `tp_student` VALUES ('2', '李娜', '35', '1');
INSERT INTO `tp_student` VALUES ('3', '孙杨', '26', '0');
INSERT INTO `tp_student` VALUES ('4', '朱婷', '23', '1');
INSERT INTO `tp_student` VALUES ('5', '惠若琪', '28', '1');
INSERT INTO `tp_student` VALUES ('6', '郜林', '28', '0');
INSERT INTO `tp_student` VALUES ('7', '林依蓝', '23', '0');
INSERT INTO `tp_student` VALUES ('8', '林利', '28', '0');
