-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2012 at 01:29 AM
-- Server version: 5.5.28
-- PHP Version: 5.4.6-1ubuntu1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `treat`
--

-- --------------------------------------------------------

--
-- Table structure for table `float`
--

CREATE TABLE IF NOT EXISTS `float` (
  `variable_id` int(11) NOT NULL,
  `test_execution_id` int(11) NOT NULL,
  `float_value` double NOT NULL,
  PRIMARY KEY (`variable_id`,`test_execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `integer`
--

CREATE TABLE IF NOT EXISTS `integer` (
  `variable_id` int(11) NOT NULL,
  `test_execution_id` int(11) NOT NULL,
  `integer_value` int(11) NOT NULL,
  PRIMARY KEY (`variable_id`,`test_execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `string`
--

CREATE TABLE IF NOT EXISTS `string` (
  `variable_id` int(11) NOT NULL,
  `string_value` varchar(64) NOT NULL,
  `test_execution_id` int(11) NOT NULL,
  PRIMARY KEY (`variable_id`,`test_execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_execution`
--

CREATE TABLE IF NOT EXISTS `test_execution` (
  `test_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_execution_time` datetime NOT NULL,
  `test_execution_report_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`,`test_execution_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `variable`
--

CREATE TABLE IF NOT EXISTS `variable` (
  `variable_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `variable_name` varchar(64) NOT NULL,
  `mandatory` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`variable_id`),
  KEY `test_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
