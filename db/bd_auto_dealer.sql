-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.32-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             8.0.0.4445
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for bd_auto_dealer
CREATE DATABASE IF NOT EXISTS `bd_auto_dealer` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_auto_dealer`;


-- Dumping structure for table bd_auto_dealer.auto
CREATE TABLE IF NOT EXISTS `auto` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.auto: ~0 rows (approximately)
/*!40000 ALTER TABLE `auto` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.auto_version
CREATE TABLE IF NOT EXISTS `auto_version` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `engineId` mediumint(8) unsigned DEFAULT NULL,
  `weight` float unsigned NOT NULL,
  `seatsNumber` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `doorsNumber` tinyint(1) unsigned NOT NULL DEFAULT '5',
  `price` float unsigned NOT NULL,
  `modelId` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modelId` (`modelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.auto_version: ~0 rows (approximately)
/*!40000 ALTER TABLE `auto_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto_version` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.engine
CREATE TABLE IF NOT EXISTS `engine` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `capacity` smallint(6) DEFAULT NULL COMMENT 'cm3',
  `name` varchar(100) DEFAULT NULL,
  `horsePower` smallint(3) DEFAULT NULL,
  `fuelAverage` float DEFAULT NULL,
  `fuelUrban` float DEFAULT NULL,
  `fuelExtra` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.engine: ~0 rows (approximately)
/*!40000 ALTER TABLE `engine` DISABLE KEYS */;
/*!40000 ALTER TABLE `engine` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.equipmentoptions
CREATE TABLE IF NOT EXISTS `equipmentoptions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `equipmentId` mediumint(8) unsigned NOT NULL,
  `value` varchar(2000) NOT NULL,
  `fieldType` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.equipmentoptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `equipmentoptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipmentoptions` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.equipments
CREATE TABLE IF NOT EXISTS `equipments` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` double unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.equipments: ~0 rows (approximately)
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `autoId` smallint(5) unsigned NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `releaseYear` year(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autoId` (`autoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.model: ~0 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
/*!40000 ALTER TABLE `model` ENABLE KEYS */;


-- Dumping structure for table bd_auto_dealer.versionequipment
CREATE TABLE IF NOT EXISTS `versionequipment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `equipmentId` mediumint(8) unsigned NOT NULL,
  `versionId` mediumint(8) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `equipmentId` (`equipmentId`),
  KEY `versionId` (`versionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bd_auto_dealer.versionequipment: ~0 rows (approximately)
/*!40000 ALTER TABLE `versionequipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `versionequipment` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
