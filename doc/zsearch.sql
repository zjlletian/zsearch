/*
Navicat MySQL Data Transfer

Source Server         : zhoujunlong.dev
Source Server Version : 50173
Source Host           : zhoujunlong.dev:3306
Source Database       : zsearch

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-04-28 19:42:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`) USING BTREE,
  KEY `count` (`count`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
