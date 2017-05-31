/*
Navicat MySQL Data Transfer

Source Server         : enhancing
Source Server Version : 50631
Source Host           : enhancing.com:3306
Source Database       : wxseats

Target Server Type    : MYSQL
Target Server Version : 50631
File Encoding         : 65001

Date: 2017-05-26 18:00:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_id` int(11) NOT NULL,
  `trade_id` int(1) NOT NULL DEFAULT '0' COMMENT '0未付款， 1已付款',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '93', '5', '0', '2017-01-01 00:00:00', '2017-05-08 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for seat_type_price_relations
-- ----------------------------
DROP TABLE IF EXISTS `seat_type_price_relations`;
CREATE TABLE `seat_type_price_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_type_id` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seat_type_price_relations
-- ----------------------------
INSERT INTO `seat_type_price_relations` VALUES ('1', '1', '200');
INSERT INTO `seat_type_price_relations` VALUES ('2', '2', '600');

-- ----------------------------
-- Table structure for seat_types
-- ----------------------------
DROP TABLE IF EXISTS `seat_types`;
CREATE TABLE `seat_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seat_types
-- ----------------------------
INSERT INTO `seat_types` VALUES ('1', '开放工位');
INSERT INTO `seat_types` VALUES ('2', '三人间');
INSERT INTO `seat_types` VALUES ('3', '五人间');
INSERT INTO `seat_types` VALUES ('4', '六人间');

-- ----------------------------
-- Table structure for seats
-- ----------------------------
DROP TABLE IF EXISTS `seats`;
CREATE TABLE `seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0为空闲',
  `room_id` int(11) NOT NULL COMMENT '为当前办公室的编号',
  `real_id` char(20) NOT NULL COMMENT '座位的实际编号',
  `version` int(2) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL,
  `price` float DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of seats
-- ----------------------------
INSERT INTO `seats` VALUES ('1', '1', '1', '93', '7', '1', null, '2017-05-24 22:17:57', '2017-05-24 22:17:57', '0');
INSERT INTO `seats` VALUES ('2', '0', '1', '96', '0', '1', null, '2017-05-24 22:17:57', '2017-05-24 22:17:57', '0');
INSERT INTO `seats` VALUES ('3', '0', '1', '96', '0', '2', null, '2017-05-24 22:17:57', '2017-05-24 22:17:57', '0');

-- ----------------------------
-- Table structure for trades
-- ----------------------------
DROP TABLE IF EXISTS `trades`;
CREATE TABLE `trades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '0普通单，1手工单',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trades
-- ----------------------------
INSERT INTO `trades` VALUES ('1', '1', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trades` VALUES ('2', '1', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trades` VALUES ('3', '1', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trades` VALUES ('4', '1', '0', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `trades` VALUES ('5', '1', '0', '0', '0', '2017-05-25 22:11:24', '2017-05-25 22:11:24');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'cage', '123456', '2017-05-23 21:26:40', '2017-05-23 21:33:11');
