-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2019 at 11:33 PM
-- Server version: 5.6.26-enterprise-commercial-advanced-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locations`
--
CREATE DATABASE IF NOT EXISTS `locations` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `locations`;

-- --------------------------------------------------------

--
-- Table structure for table `shoplocations`
--

DROP TABLE IF EXISTS `shoplocations`;
CREATE TABLE IF NOT EXISTS `shoplocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `distance` float NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shoplocations`
--

INSERT INTO `shoplocations` (`id`, `name`, `address`, `distance`, `latitude`, `longitude`) VALUES
(1, 'Bingo Super', 'fkjaslkf', 22, 18.222, 14.188),
(2, 'Bingo mini', 'address', 12, 12.0125, 12.2),
(3, 'abc', 'aaa', 43, 53.4353, 21.5435);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
