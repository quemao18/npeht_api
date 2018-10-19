/*
Navicat MySQL Data Transfer

Source Server         : NPEHT
Source Server Version : 50718
Source Host           : 144.217.255.53:3306
Source Database       : npeht

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-10-19 11:26:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for access
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `all_access` tinyint(1) NOT NULL DEFAULT '0',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for audios
-- ----------------------------
DROP TABLE IF EXISTS `audios`;
CREATE TABLE `audios` (
  `id_audio` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rute` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ita_user_create` int(11) DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL,
  `ita_user_update` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_audio` int(11) DEFAULT '1',
  `file_name` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_audio`),
  KEY `id_module_audio` (`id_module`),
  KEY `audios_ibfk_4` (`ita_user_create`),
  CONSTRAINT `audios_ibfk_4` FOREIGN KEY (`ita_user_create`) REFERENCES `users` (`ita`),
  CONSTRAINT `id_module_audio` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for keys
-- ----------------------------
DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for limits
-- ----------------------------
DROP TABLE IF EXISTS `limits`;
CREATE TABLE `limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36202 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for medias
-- ----------------------------
DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id_media` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rute` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ita_user_create` int(11) DEFAULT NULL,
  `ita_user_update` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_sub_category` int(11) DEFAULT NULL,
  `id` varchar(255) DEFAULT NULL,
  `is_audio` int(11) DEFAULT '0',
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_media`),
  KEY `medias_ibfk_2` (`id_category`),
  KEY `medias_ibfk_3` (`id_sub_category`),
  KEY `medias_ibfk_4` (`ita_user_create`),
  CONSTRAINT `medias_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  CONSTRAINT `medias_ibfk_3` FOREIGN KEY (`id_sub_category`) REFERENCES `sub_categories` (`id_sub_category`),
  CONSTRAINT `medias_ibfk_4` FOREIGN KEY (`ita_user_create`) REFERENCES `users` (`ita`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT '',
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  KEY `id_module` (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id_new` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `ita_user_create` int(11) DEFAULT NULL,
  `ita_user_update` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id_new`),
  KEY `id_event` (`id_event`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id_position` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_position`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for rols
-- ----------------------------
DROP TABLE IF EXISTS `rols`;
CREATE TABLE `rols` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
  `id_school` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_finish` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `ita_user_create` int(11) DEFAULT NULL,
  `ita_user_update` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `description` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_school`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sub_categories
-- ----------------------------
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id_sub_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sub_category`),
  KEY `fk_1` (`id_category`),
  CONSTRAINT `fk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `last` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `ita` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `phone` varchar(255) DEFAULT '',
  `id_rol` int(11) DEFAULT NULL,
  `id_position` int(11) DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT '',
  `ita_platinum` int(11) DEFAULT NULL,
  `ita_sponsor` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT '',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`) USING BTREE,
  KEY `id_position` (`id_position`),
  KEY `id_rol` (`id_rol`),
  KEY `id_question` (`id_question`) USING BTREE,
  KEY `ita` (`ita`),
  CONSTRAINT `id_position` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`),
  CONSTRAINT `id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`),
  CONSTRAINT `id_rol` FOREIGN KEY (`id_rol`) REFERENCES `rols` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6018 DEFAULT CHARSET=latin1;
