-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2019 at 06:03 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(2, 'Admin', '$2y$10$YzzuFRS/mbaILIfPnAbVpeNLqBjmd/9/3MxZNkNNR52Yk4Bg03VHe');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

DROP TABLE IF EXISTS `airports`;
CREATE TABLE IF NOT EXISTS `airports` (
  `code` varchar(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`code`, `name`) VALUES
('MED', 'Madinah'),
('AHB', 'Abha'),
('BHH', 'Bisha'),
('GIZ', 'Jazan'),
('ABT', 'Al-Baha'),
('ELQ', 'Gassim'),
('DMM', 'Dammam'),
('JED', 'Jeddah'),
('RUH', 'Riyadh'),
('TUU', 'Tabuk');

-- --------------------------------------------------------

--
-- Table structure for table `booked_tickets`
--

DROP TABLE IF EXISTS `booked_tickets`;
CREATE TABLE IF NOT EXISTS `booked_tickets` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `class` varchar(10) NOT NULL,
  `seat` varchar(5) NOT NULL,
  `meal` varchar(100) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `FK_flight` (`flight_id`),
  KEY `FK_user` (`user_id`),
  KEY `FK_passenger` (`passenger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booked_tickets`
--

INSERT INTO `booked_tickets` (`ticket_id`, `user_id`, `flight_id`, `passenger_id`, `class`, `seat`, `meal`) VALUES
(18, 14, 24, 19, 'Guest', '', ''),
(19, 14, 24, 20, 'Guest', '', ''),
(20, 15, 23, 21, 'Guest', '', ''),
(21, 15, 25, 19, 'Guest', '', ''),
(22, 14, 30, 22, 'Guest', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `flight_id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `carrier` varchar(50) NOT NULL,
  `airplane` varchar(50) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `capacity` int(10) NOT NULL,
  `reserved` int(3) NOT NULL DEFAULT '0',
  `price_factor` double NOT NULL,
  PRIMARY KEY (`flight_id`),
  UNIQUE KEY `flight_number` (`flight_number`,`departure_date`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `flight_number`, `from`, `to`, `carrier`, `airplane`, `departure_date`, `departure_time`, `arrival_date`, `arrival_time`, `capacity`, `reserved`, `price_factor`) VALUES
(21, 'SV1001', 'Riyadh (RUH)', 'Madinah (MED)', 'SV', 'Airbus A330', '2019-12-10', '01:10:00', '2019-12-10', '02:45:00', 293, 0, 3),
(22, 'SV1002', 'Madinah (MED)', 'Jeddah (JED)', 'SV', 'Airbus A330', '2019-12-10', '05:55:00', '2019-12-10', '06:55:00', 293, 0, 3),
(23, 'SV1003', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Airbus A330', '2019-12-17', '07:00:00', '2019-12-17', '08:35:00', 293, 1, 3),
(24, 'SV1004', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Airbus A330', '2019-12-10', '11:00:00', '2019-12-10', '12:35:00', 293, 2, 3),
(25, 'XY1005', 'Riyadh (RUH)', 'Jeddah (JED)', 'XY', 'Airbus A330', '2019-12-10', '00:30:00', '2019-12-10', '02:15:00', 293, 1, 3),
(26, 'XY1006', 'Riyadh (RUH)', 'Jeddah (JED)', 'XY', 'Boeing 777-300ER', '2019-12-10', '17:30:00', '2019-12-10', '19:15:00', 365, 0, 3.5),
(27, 'XY1007', 'Jeddah (JED)', 'Riyadh (RUH)', 'XY', 'Boeing 777-300ER', '2019-12-17', '21:00:00', '2019-12-17', '22:35:00', 365, 0, 3.5),
(28, 'SV1008', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-12-10', '09:00:00', '2019-12-10', '10:35:00', 365, 0, 3.5),
(29, 'SV1009', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Boeing 777-300ER', '2019-12-17', '15:00:00', '2019-12-17', '16:30:00', 365, 0, 3.5),
(30, 'SV1010', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-12-10', '22:00:00', '2019-12-10', '23:40:00', 365, 1, 3.5),
(31, 'SV1011', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Boeing 777-300ER', '2019-12-17', '10:00:00', '2019-12-17', '11:30:00', 365, 0, 3.5),
(32, 'SV1012', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-12-10', '10:00:00', '2019-12-10', '11:35:00', 365, 0, 3.5),
(33, 'SV1013', 'Jeddah (JED)', 'Dammam (DMM)', 'SV', 'Boeing 777-300ER', '2019-12-17', '21:00:00', '2019-12-17', '23:00:00', 365, 0, 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `flights_archive`
--

DROP TABLE IF EXISTS `flights_archive`;
CREATE TABLE IF NOT EXISTS `flights_archive` (
  `flight_id` int(11) NOT NULL,
  `flight_number` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `carrier` varchar(50) NOT NULL,
  `airplane` varchar(50) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `capacity` int(4) NOT NULL,
  `reserved` int(4) NOT NULL,
  `price_factor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights_archive`
--

INSERT INTO `flights_archive` (`flight_id`, `flight_number`, `from`, `to`, `carrier`, `airplane`, `departure_date`, `departure_time`, `arrival_date`, `arrival_time`, `capacity`, `reserved`, `price_factor`) VALUES
(3, 'SV1002', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-09-23', '09:00:00', '2019-09-23', '10:35:00', 365, 0, 4),
(6, 'SV1013', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-10-05', '00:00:00', '2019-10-05', '00:00:00', 365, 0, 4),
(7, 'SV1010', 'Madinah (MED)', 'Jeddah (JED)', 'SV', 'Airbus A330', '2019-09-23', '05:55:00', '2019-09-23', '06:55:00', 293, 0, 3.5),
(8, 'SV1011', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Airbus A330', '2019-09-30', '07:00:00', '2019-09-30', '08:35:00', 293, 0, 3.5),
(9, 'SV1012', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Airbus A330', '2019-09-23', '11:00:00', '2019-09-23', '12:35:00', 293, 0, 3.5),
(10, 'XY1000', 'Riyadh (RUH)', 'Jeddah (JED)', 'XY', 'Airbus A330', '2019-09-23', '00:30:00', '2019-09-23', '02:15:00', 293, 2, 3.5),
(11, 'XY1015', 'Riyadh (RUH)', 'Jeddah (JED)', 'XY', 'Boeing 777-300ER', '2019-10-08', '00:00:00', '2019-10-08', '00:00:00', 365, 0, 4),
(12, 'XY1014', 'Riyadh (RUH)', 'Jeddah (JED)', 'XY', 'Airbus A330', '2019-10-07', '00:00:00', '2019-10-07', '00:00:00', 293, 0, 3),
(14, 'SV1016', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Boeing 777-300ER', '2019-10-11', '00:00:00', '2019-10-11', '00:00:00', 365, 0, 3),
(15, 'SV1017', 'Jeddah (JED)', 'Riyadh (RUH)', 'SV', 'Airbus A330', '2019-10-11', '00:00:00', '2019-10-11', '00:00:00', 293, 0, 5),
(17, 'SV1437', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-10-14', '00:00:00', '2019-10-14', '02:00:00', 365, 0, 4),
(18, 'XZ0000', 'Riyadh (RUH)', 'Jeddah (JED)', 'SV', 'Boeing 777-300ER', '2019-09-30', '00:00:00', '2019-09-30', '02:00:00', 365, 0, 3),
(20, 'SV1000', 'Dammam (DMM)', 'Riyadh (RUH)', 'SV', 'Airbus A330', '2019-10-01', '00:20:00', '2019-10-01', '01:30:00', 293, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `passenger_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `family_name` varchar(30) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `document_type` varchar(30) NOT NULL,
  `document_number` varchar(30) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  PRIMARY KEY (`passenger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `first_name`, `middle_name`, `family_name`, `nationality`, `document_type`, `document_number`, `birth_date`, `gender`, `number`, `email`) VALUES
(16, 'Abdul-Wakil', 'Jaun', 'Tahan', 'American', 'passport', '116647397', '1956-01-04', 'male', '+13347537200', 'Abdul-WakilJaunTahan@armyspy.com'),
(17, 'Afya', 'Dunya', 'Amari', 'Egyptian', 'passport', '269959264', '1975-07-23', 'male', '+14844161405', 'AfyaDunyaAmari@armyspy.com'),
(19, 'aaa', 'bbb', 'ccc', 'Afghan', 'iqama', '123321', '1900-01-01', 'male', '+935555555', 'jjj@jjj.com'),
(20, 'AAA', 'BBB', 'CCC', 'Afghan', 'passport', '123321456', '1900-01-01', 'female', '+93555576575', 'iii@uuu.com'),
(21, 'h', 'b', 'o', 'Afghan', 'passport', '1111111', '1916-08-18', 'male', '+1 2465555555', 'ffa@dda.com'),
(22, 'ttt', 'ttt', 'ttt', 'Guyanese', 'passport', '123321', '1922-12-19', 'male', '+2545555555', 'ttt@ttt.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`) VALUES
(14, 'Ibrahim@ksu.com', '$2y$10$GDoIc8yujfKuwi1Ar7Gt9OwwCwp20CE.64.kRnDvUxRfFt6h5e4Ka', 'Ibrahim', 'AlSuhaim'),
(15, 'hamad@ksu.com', '$2y$10$H3xeiJbBksXjqVzewaUTjuV65Y7E/vy2R02CCWWR.xNM2YzfV8qOC', 'hamad', 'bader');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked_tickets`
--
ALTER TABLE `booked_tickets`
  ADD CONSTRAINT `FK_flight` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`flight_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_passenger` FOREIGN KEY (`passenger_id`) REFERENCES `passengers` (`passenger_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
