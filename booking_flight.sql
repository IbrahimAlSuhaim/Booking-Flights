-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 26, 2019 at 04:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_flight`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(2, 'Admin', '$2y$10$YzzuFRS/mbaILIfPnAbVpeNLqBjmd/9/3MxZNkNNR52Yk4Bg03VHe');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `flight_number` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `carrier` varchar(50) NOT NULL,
  `airplane` varchar(50) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time(6) NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time(6) NOT NULL,
  `capacity` int(10) NOT NULL,
  PRIMARY KEY (`flight_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_number`, `from`, `to`, `carrier`, `airplane`, `departure_date`, `departure_time`, `arrival_date`, `arrival_time`, `capacity`) VALUES
('5d8cc1c245954', 'Riyadh (RUH )', 'Jeddah (JED)', 'Saudi Airlines', 'Boeing 777-300ER', '2019-09-26', '02:50:00.000000', '2019-09-27', '05:50:00.000000', 365),
('5d8cea001ff62', 'Jeddah (JED)', 'Riyadh (RUH )', 'Saudi Airlines', 'Airbus A330', '2019-09-26', '02:50:00.000000', '2019-09-27', '05:50:00.000000', 293),
('5d8cea8a85e17', 'Riyadh (RUH )', 'Jeddah (JED)', 'Choose...', 'Airbus A330', '2019-09-20', '02:50:00.000000', '2019-09-30', '05:50:00.000000', 293),
('5d8cec9c68abe', 'Riyadh (RUH )', 'Jeddah (JED)', 'Saudi Airlines', 'Boeing 777-300ER', '2019-09-26', '02:50:00.000000', '2019-09-27', '05:50:00.000000', 365);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(320) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`) VALUES
(9, 'php@php.com', '$2y$10$PaGcb7P9bek2z3u4dCmBBu4kWdIfr1HyAVWpcR2tBZLKtDFaOaQ6K', 'php', 'php'),
(8, 'e@e.com', '$2y$10$BsVnE.9N3IJXimy78L0ja.kWG/fPy2329hnTUy9k38H0ZXhI.d9H.', 'e', 'e'),
(7, '', '$2y$10$jhr.HBgZhzPd10tvzUPEIu7pXDmJ4fFn4yesVetFL7AR0yDnHyCo6', '', ''),
(6, 'a@a.com', '$2y$10$lvNQd9APwgosGpuqF2cHOe2c7fnIMY9UcvXZ5McUuo5mY82L3RudC', 'a', 'a'),
(10, 'test@test.com', '$2y$10$MhD3blLJCIvGsJidaZNY0ew.PluDuAjxEYOQFfURhRaq1rLdilKIu', 'test', 'test');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
