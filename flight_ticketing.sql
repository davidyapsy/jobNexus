-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 04:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `airplane`
--

CREATE TABLE `airplane` (
  `airplane_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_seats` int(6) NOT NULL,
  `year_of_manufacture` int(4) NOT NULL,
  `purchase_price` double NOT NULL,
  `plane_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airplane`
--

INSERT INTO `airplane` (`airplane_id`, `name`, `total_seats`, `year_of_manufacture`, `purchase_price`, `plane_type`, `status`) VALUES
(1, 'MH301', 50, 2000, 60000000, 'passenger airlines', 'active'),
(2, 'MH302', 50, 2001, 70000000, 'passenger airlines', 'maintenance'),
(3, 'MH303', 50, 2000, 60000000, 'passenger airlines', 'active'),
(4, 'MH304', 50, 2002, 65000000, 'passenger airlines', 'active'),
(5, 'MH305', 50, 2000, 70000000, 'passenger airlines', 'disposed'),
(6, 'MH306', 50, 2000, 65000000, 'passenger airlines', 'active'),
(7, 'MH307', 50, 2010, 80000000, 'passenger airlines', 'active'),
(8, 'MH308', 50, 2001, 60000000, 'passenger airlines', 'active'),
(9, 'MH309', 50, 2002, 65000000, 'passenger airlines', 'active'),
(10, 'MH310', 50, 2000, 70000000, 'passenger airlines', 'disposed'),
(11, 'MH311', 50, 2000, 80000000, 'passenger airlines', 'active'),
(12, 'MH312', 50, 2001, 82000000, 'passenger airlines', 'active'),
(13, 'MH313', 50, 2002, 81000000, 'passenger airlines', 'active'),
(14, 'MH314', 50, 2000, 86000000, 'passenger airlines', 'active'),
(15, 'MH315', 50, 2001, 81000000, 'passenger airlines', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(6) UNSIGNED NOT NULL,
  `payment_id` int(6) UNSIGNED NOT NULL,
  `emergency_contact_id` int(6) UNSIGNED NOT NULL,
  `customer_id` int(6) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(8) NOT NULL,
  `total_passenger` int(1) NOT NULL,
  `total_amount` double NOT NULL,
  `departure_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `payment_id`, `emergency_contact_id`, `customer_id`, `booking_date`, `booking_time`, `total_passenger`, `total_amount`, `departure_date`, `return_date`) VALUES
(1, 1, 1, 1, '2023-05-08', '10:56:44', 2, 20, NULL, NULL),
(2, 2, 2, 2, '2023-05-08', '10:56:44', 2, 20, NULL, NULL),
(3, 3, 3, 3, '2023-05-08', '10:56:44', 2, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `date_of_birth`, `password`, `email_address`, `phone_number`) VALUES
(1, 'David Deacon', '2001-08-17', 'd4750a053f123d1767b139f51322f356', 'david@gmail.com', '011-1234567'),
(2, 'Harry Potter', '2002-06-27', '9fcac4cdd4c4443853b7da187fb4016b', 'harry@gmail.com', '010-2345678'),
(3, 'Alicia Shau', '2000-12-13', 'aafc170dc39fae4441717ba003bf801d', 'shauyx-wm20@student.tarc.edu.my', '017-3456789'),
(4, 'Tommy David', '1995-05-31', '013886fca6427a50e47370cc2936d5d3', 'tommy@gmail.com', '012-1289901'),
(5, 'Felicia Lily', '1998-04-02', '160f55177590bdf99d8a1d9fecd61bfa', 'felicia@gmail.com', '011-3451267'),
(6, 'Shirley Woo', '2002-12-17', 'aa37a67fcb03cd02f69c6b39f2dc87ba', 'sy123@gmail.com', '016-1234567'),
(7, 'David Yap', '1998-09-30', '55fc5b709962876903785fd64a6961e5', 'davidspam404@gmail.com', '016-4567551'),
(8, 'Kelvin Ong', '1995-06-30', 'cf34a25425735f7fad37a236b4415ba0', 'kelvin123@gmail.com', '011-1528967'),
(9, 'Daisy Gilbi', '2000-11-13', '8e9f8de4301620be681b5fb9ba3615cf', 'daisy@gmail.com', '012-5676981'),
(10, 'Billie Ellish', '1999-12-09', '62b5b79fc2387f3f2620376cd9ca17dd', 'bbi@gmail.com', '016-4432567');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contact`
--

CREATE TABLE `emergency_contact` (
  `emergency_contact_id` int(6) UNSIGNED NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `contact_phone_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_contact`
--

INSERT INTO `emergency_contact` (`emergency_contact_id`, `contact_name`, `relationship`, `contact_phone_num`) VALUES
(1, 'Ceci', 'Child', '0125368855'),
(2, 'Shella', 'Parent', '0145559595'),
(3, 'David Chong', 'Friend', '0125368855'),
(4, 'Lim Heng C', 'Relative', '0115659595'),
(5, 'Tiny', 'Relative', '0125325655'),
(6, 'Lim Huay Zi', 'Relative', '0115252656'),
(7, 'Hanini', 'Child', '0166235959'),
(8, 'Teressa', 'Other', '0164562233'),
(9, 'Kelvin', 'Parent', '0135689555'),
(10, 'Osama', 'Friend', '0135663555');

-- --------------------------------------------------------

--
-- Table structure for table `flight_schedule`
--

CREATE TABLE `flight_schedule` (
  `flight_schedule_id` int(6) UNSIGNED NOT NULL,
  `route_id` int(6) UNSIGNED NOT NULL,
  `airplane_id` int(6) UNSIGNED NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_day` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `starting_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_schedule`
--

INSERT INTO `flight_schedule` (`flight_schedule_id`, `route_id`, `airplane_id`, `departure_time`, `arrival_time`, `departure_day`, `price`, `starting_date`) VALUES
(2, 1, 1, '08:00:00', '10:30:00', 'Monday', 100.00, '2023-01-01'),
(3, 7, 1, '11:30:00', '13:00:00', 'Monday', 100.00, '2023-01-01'),
(4, 2, 4, '08:00:00', '12:00:00', 'Tuesday', 200.00, '2023-01-01'),
(5, 8, 4, '13:00:00', '17:00:00', 'Tuesday', 200.00, '2023-01-01'),
(6, 3, 6, '08:00:00', '20:00:00', 'Monday', 600.00, '2023-01-01'),
(7, 9, 6, '21:00:00', '09:00:00', 'Monday', 600.00, '2023-01-01'),
(8, 1, 7, '08:00:00', '10:30:00', 'Wednesday', 250.00, '2023-01-01'),
(28, 7, 11, '20:41:00', '23:11:00', 'Thursday', 150.00, '1900-01-01'),
(29, 1, 15, '10:09:00', '12:39:00', 'Thursday', 100.00, '1900-01-01'),
(30, 11, 13, '23:41:00', '05:11:00', 'Monday', 200.00, '1900-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `luggage`
--

CREATE TABLE `luggage` (
  `luggage_id` int(6) UNSIGNED NOT NULL,
  `passenger_id` int(6) UNSIGNED NOT NULL,
  `weight` double NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `luggage`
--

INSERT INTO `luggage` (`luggage_id`, `passenger_id`, `weight`, `price`) VALUES
(1, 1, 27, 100.6),
(2, 2, 7, 0),
(3, 3, 32, 125.6),
(4, 4, 27, 100.6),
(5, 5, 32, 125.6),
(6, 6, 32, 125.6),
(7, 7, 37, 150.6),
(8, 8, 37, 150.6),
(9, 9, 27, 100.6),
(10, 10, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(6) UNSIGNED NOT NULL,
  `passenger_name` varchar(255) NOT NULL,
  `ic_number` varchar(14) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `passenger_name`, `ic_number`, `date_of_birth`, `gender`) VALUES
(1, 'Chong Jim Sheng', '030205-06-2255', '2003-02-05', 'Male'),
(2, 'Evane Lim Xiao Xiao', '021101-06-5513', '2002-11-01', 'Male'),
(3, 'Yap Sen Yong', '021225-10-6521', '2002-12-25', 'Male'),
(4, 'Ong Wai Chong', '010811-10-2359', '2001-08-11', 'Male'),
(5, 'Tan Jun Kin', '980613-06-2551', '1998-06-13', 'Male'),
(6, 'Phun Huey Zhi', '020602-06-0612', '2002-06-02', 'Female'),
(7, 'Harini A/P Kaniathran', '970416-08-1216', '1997-04-16', 'Female'),
(8, 'Shau Yhong Xuan', '060324-06-1252', '2006-03-24', 'Female'),
(9, 'Tan Sim Kim', '020719-06-1232', '2012-07-19', 'Female'),
(10, 'Lee Chong Hua', '010126-04-1218', '2001-01-26', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(6) UNSIGNED NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `amount_paid` double NOT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `txn_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_status`, `amount_paid`, `currency`, `txn_id`, `created_at`) VALUES
(1, 'Successful', 20, 'MYR', '8963410143', '2023-05-07 16:00:00'),
(2, 'Successful', 20, 'MYR', '4144303600', '2023-05-07 16:00:00'),
(3, 'Successful', 20, 'MYR', '2402617950', '2023-05-07 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(6) UNSIGNED NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `time_taken_hour` int(2) NOT NULL,
  `time_taken_min` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `origin`, `destination`, `time_taken_hour`, `time_taken_min`) VALUES
(1, 'KLIA2', 'Haneda', 2, 30),
(2, 'KLIA2', 'Indira Gandhi', 4, 0),
(3, 'KLIA2', 'Orlando', 12, 0),
(4, 'KLIA2', 'Changi', 2, 0),
(5, 'KLIA2', 'Istanbul', 5, 30),
(6, 'KLIA2', 'Beijing', 4, 30),
(7, 'Haneda', 'KLIA2', 2, 30),
(8, 'Indira Gandhi', 'KLIA2', 4, 0),
(9, 'Orlando', 'KLIA2', 12, 0),
(10, 'Changi', 'KLIA2', 2, 0),
(11, 'Istanbul', 'KLIA2', 5, 30),
(12, 'Beijing', 'KLIA2', 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(6) UNSIGNED NOT NULL,
  `seat_type` varchar(50) NOT NULL,
  `seat_row` int(11) NOT NULL,
  `seat_column` int(11) NOT NULL,
  `seat_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `seat_type`, `seat_row`, `seat_column`, `seat_price`) VALUES
(1, 'premium', 1, 1, 35.9),
(2, 'premium', 1, 2, 35.9),
(3, 'premium', 1, 3, 35.9),
(4, 'premium', 1, 4, 35.9),
(5, 'premium', 1, 5, 35.9),
(6, 'premium', 1, 6, 35.9),
(7, 'premium', 2, 1, 35.9),
(8, 'premium', 2, 2, 35.9),
(9, 'premium', 2, 3, 35.9),
(10, 'premium', 2, 4, 35.9),
(11, 'premium', 2, 5, 35.9),
(12, 'premium', 2, 6, 35.9),
(13, 'premium', 3, 1, 35.9),
(14, 'premium', 3, 2, 35.9),
(15, 'premium', 3, 3, 35.9),
(16, 'premium', 3, 4, 35.9),
(17, 'premium', 3, 5, 35.9),
(18, 'premium', 3, 6, 35.9),
(19, 'premium', 4, 1, 35.9),
(20, 'premium', 4, 2, 35.9),
(21, 'premium', 4, 3, 35.9),
(22, 'premium', 4, 4, 35.9),
(23, 'premium', 4, 5, 35.9),
(24, 'premium', 4, 6, 35.9),
(25, 'premium', 5, 1, 35.9),
(26, 'premium', 5, 2, 35.9),
(27, 'premium', 5, 3, 35.9),
(28, 'premium', 5, 4, 35.9),
(29, 'premium', 5, 5, 35.9),
(30, 'premium', 5, 6, 35.9),
(31, 'premium', 6, 1, 35.9),
(32, 'premium', 6, 2, 35.9),
(33, 'premium', 6, 3, 35.9),
(34, 'premium', 6, 4, 35.9),
(35, 'premium', 6, 5, 35.9),
(36, 'premium', 6, 6, 35.9),
(37, 'premium', 7, 1, 15),
(38, 'premium', 7, 2, 15),
(39, 'premium', 7, 3, 15),
(40, 'premium', 7, 4, 15),
(41, 'premium', 7, 5, 15),
(42, 'premium', 7, 6, 15),
(43, 'normal', 8, 1, 15),
(44, 'normal', 8, 2, 15),
(45, 'normal', 8, 3, 15),
(46, 'normal', 8, 4, 15),
(47, 'normal', 8, 5, 15),
(48, 'normal', 8, 6, 15),
(49, 'normal', 9, 1, 15),
(50, 'normal', 9, 2, 15),
(51, 'normal', 9, 3, 15),
(52, 'normal', 9, 4, 15),
(53, 'normal', 9, 5, 15),
(54, 'normal', 9, 6, 15),
(55, 'normal', 10, 1, 15),
(56, 'normal', 10, 2, 15),
(57, 'normal', 10, 3, 15),
(58, 'normal', 10, 4, 15),
(59, 'normal', 10, 5, 15),
(60, 'normal', 10, 6, 15),
(61, 'normal', 11, 1, 15),
(62, 'normal', 11, 2, 15),
(63, 'normal', 11, 3, 15),
(64, 'normal', 11, 4, 15),
(65, 'normal', 11, 5, 15),
(66, 'normal', 11, 6, 15),
(67, 'normal', 12, 1, 15),
(68, 'normal', 12, 2, 15),
(69, 'normal', 12, 3, 15),
(70, 'normal', 12, 4, 15),
(71, 'normal', 12, 5, 15),
(72, 'normal', 12, 6, 15),
(73, 'normal', 13, 1, 15),
(74, 'normal', 13, 2, 15),
(75, 'normal', 13, 3, 15),
(76, 'normal', 13, 4, 15),
(77, 'normal', 13, 5, 15),
(78, 'normal', 13, 6, 15),
(79, 'normal', 14, 1, 15),
(80, 'normal', 14, 2, 15),
(81, 'normal', 14, 3, 15),
(82, 'normal', 14, 4, 15),
(83, 'normal', 14, 5, 15),
(84, 'normal', 14, 6, 15),
(85, 'normal', 15, 1, 15),
(86, 'normal', 15, 2, 15),
(87, 'normal', 15, 3, 15),
(88, 'normal', 15, 4, 15),
(89, 'normal', 15, 5, 15),
(90, 'normal', 15, 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `seat_detail`
--

CREATE TABLE `seat_detail` (
  `seat_id` int(6) UNSIGNED NOT NULL,
  `airplane_id` int(6) UNSIGNED NOT NULL,
  `availability` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat_detail`
--

INSERT INTO `seat_detail` (`seat_id`, `airplane_id`, `availability`) VALUES
(1, 1, 'Y'),
(2, 1, 'N'),
(3, 1, 'Y'),
(4, 1, 'Y'),
(5, 1, 'Y'),
(6, 1, 'Y'),
(7, 1, 'Y'),
(8, 1, 'Y'),
(9, 1, 'Y'),
(10, 1, 'Y'),
(11, 1, 'Y'),
(12, 1, 'Y'),
(13, 1, 'Y'),
(14, 1, 'Y'),
(15, 1, 'Y'),
(16, 1, 'Y'),
(17, 1, 'Y'),
(18, 1, 'Y'),
(19, 1, 'Y'),
(20, 1, 'Y'),
(21, 1, 'Y'),
(22, 1, 'Y'),
(23, 1, 'Y'),
(24, 1, 'Y'),
(25, 1, 'Y'),
(26, 1, 'Y'),
(27, 1, 'Y'),
(28, 1, 'Y'),
(29, 1, 'Y'),
(30, 1, 'Y'),
(31, 1, 'Y'),
(32, 1, 'Y'),
(33, 1, 'Y'),
(34, 1, 'Y'),
(35, 1, 'Y'),
(36, 1, 'Y'),
(37, 1, 'Y'),
(38, 1, 'Y'),
(39, 1, 'Y'),
(40, 1, 'Y'),
(41, 1, 'Y'),
(42, 1, 'Y'),
(43, 1, 'Y'),
(44, 1, 'Y'),
(45, 1, 'Y'),
(46, 1, 'Y'),
(47, 1, 'Y'),
(48, 1, 'Y'),
(49, 1, 'Y'),
(50, 1, 'Y'),
(51, 1, 'Y'),
(52, 1, 'Y'),
(53, 1, 'Y'),
(54, 1, 'Y'),
(55, 1, 'Y'),
(56, 1, 'Y'),
(57, 1, 'Y'),
(58, 1, 'Y'),
(59, 1, 'Y'),
(60, 1, 'Y'),
(61, 1, 'Y'),
(62, 1, 'Y'),
(63, 1, 'Y'),
(64, 1, 'Y'),
(65, 1, 'Y'),
(66, 1, 'Y'),
(67, 1, 'Y'),
(68, 1, 'Y'),
(69, 1, 'Y'),
(70, 1, 'Y'),
(71, 1, 'Y'),
(72, 1, 'Y'),
(73, 1, 'Y'),
(74, 1, 'Y'),
(75, 1, 'Y'),
(76, 1, 'Y'),
(77, 1, 'Y'),
(78, 1, 'Y'),
(79, 1, 'Y'),
(80, 1, 'Y'),
(81, 1, 'Y'),
(82, 1, 'Y'),
(83, 1, 'Y'),
(84, 1, 'Y'),
(85, 1, 'Y'),
(86, 1, 'Y'),
(87, 1, 'Y'),
(88, 1, 'Y'),
(89, 1, 'Y'),
(90, 1, 'Y'),
(1, 2, 'Y'),
(2, 2, 'Y'),
(3, 2, 'Y'),
(4, 2, 'Y'),
(5, 2, 'Y'),
(6, 2, 'Y'),
(7, 2, 'Y'),
(8, 2, 'Y'),
(9, 2, 'Y'),
(10, 2, 'Y'),
(11, 2, 'Y'),
(12, 2, 'Y'),
(13, 2, 'Y'),
(14, 2, 'Y'),
(15, 2, 'Y'),
(16, 2, 'Y'),
(17, 2, 'Y'),
(18, 2, 'Y'),
(19, 2, 'Y'),
(20, 2, 'Y'),
(21, 2, 'Y'),
(22, 2, 'Y'),
(23, 2, 'Y'),
(24, 2, 'Y'),
(25, 2, 'Y'),
(26, 2, 'Y'),
(27, 2, 'Y'),
(28, 2, 'Y'),
(29, 2, 'Y'),
(30, 2, 'Y'),
(31, 2, 'Y'),
(32, 2, 'Y'),
(33, 2, 'Y'),
(34, 2, 'Y'),
(35, 2, 'Y'),
(36, 2, 'Y'),
(37, 2, 'Y'),
(38, 2, 'Y'),
(39, 2, 'Y'),
(40, 2, 'Y'),
(41, 2, 'Y'),
(42, 2, 'Y'),
(43, 2, 'Y'),
(44, 2, 'Y'),
(45, 2, 'Y'),
(46, 2, 'Y'),
(47, 2, 'Y'),
(48, 2, 'Y'),
(49, 2, 'Y'),
(50, 2, 'Y'),
(51, 2, 'Y'),
(52, 2, 'Y'),
(53, 2, 'Y'),
(54, 2, 'Y'),
(55, 2, 'Y'),
(56, 2, 'Y'),
(57, 2, 'Y'),
(58, 2, 'Y'),
(59, 2, 'Y'),
(60, 2, 'Y'),
(61, 2, 'Y'),
(62, 2, 'Y'),
(63, 2, 'Y'),
(64, 2, 'Y'),
(65, 2, 'Y'),
(66, 2, 'Y'),
(67, 2, 'Y'),
(68, 2, 'Y'),
(69, 2, 'Y'),
(70, 2, 'Y'),
(71, 2, 'Y'),
(72, 2, 'Y'),
(73, 2, 'Y'),
(74, 2, 'Y'),
(75, 2, 'Y'),
(76, 2, 'Y'),
(77, 2, 'Y'),
(78, 2, 'Y'),
(79, 2, 'Y'),
(80, 2, 'Y'),
(81, 2, 'Y'),
(82, 2, 'Y'),
(83, 2, 'Y'),
(84, 2, 'Y'),
(85, 2, 'Y'),
(86, 2, 'Y'),
(87, 2, 'Y'),
(88, 2, 'Y'),
(89, 2, 'Y'),
(90, 2, 'Y'),
(1, 3, 'Y'),
(2, 3, 'Y'),
(3, 3, 'Y'),
(4, 3, 'Y'),
(5, 3, 'Y'),
(6, 3, 'Y'),
(7, 3, 'Y'),
(8, 3, 'Y'),
(9, 3, 'Y'),
(10, 3, 'Y'),
(11, 3, 'Y'),
(12, 3, 'Y'),
(13, 3, 'Y'),
(14, 3, 'Y'),
(15, 3, 'Y'),
(16, 3, 'Y'),
(17, 3, 'Y'),
(18, 3, 'Y'),
(19, 3, 'Y'),
(20, 3, 'Y'),
(21, 3, 'Y'),
(22, 3, 'Y'),
(23, 3, 'Y'),
(24, 3, 'Y'),
(25, 3, 'Y'),
(26, 3, 'Y'),
(27, 3, 'Y'),
(28, 3, 'Y'),
(29, 3, 'Y'),
(30, 3, 'Y'),
(31, 3, 'Y'),
(32, 3, 'Y'),
(33, 3, 'Y'),
(34, 3, 'Y'),
(35, 3, 'Y'),
(36, 3, 'Y'),
(37, 3, 'Y'),
(38, 3, 'Y'),
(39, 3, 'Y'),
(40, 3, 'Y'),
(41, 3, 'Y'),
(42, 3, 'Y'),
(43, 3, 'Y'),
(44, 3, 'Y'),
(45, 3, 'Y'),
(46, 3, 'Y'),
(47, 3, 'Y'),
(48, 3, 'Y'),
(49, 3, 'Y'),
(50, 3, 'Y'),
(51, 3, 'Y'),
(52, 3, 'Y'),
(53, 3, 'Y'),
(54, 3, 'Y'),
(55, 3, 'Y'),
(56, 3, 'Y'),
(57, 3, 'Y'),
(58, 3, 'Y'),
(59, 3, 'Y'),
(60, 3, 'Y'),
(61, 3, 'Y'),
(62, 3, 'Y'),
(63, 3, 'Y'),
(64, 3, 'Y'),
(65, 3, 'Y'),
(66, 3, 'Y'),
(67, 3, 'Y'),
(68, 3, 'Y'),
(69, 3, 'Y'),
(70, 3, 'Y'),
(71, 3, 'Y'),
(72, 3, 'Y'),
(73, 3, 'Y'),
(74, 3, 'Y'),
(75, 3, 'Y'),
(76, 3, 'Y'),
(77, 3, 'Y'),
(78, 3, 'Y'),
(79, 3, 'Y'),
(80, 3, 'Y'),
(81, 3, 'Y'),
(82, 3, 'Y'),
(83, 3, 'Y'),
(84, 3, 'Y'),
(85, 3, 'Y'),
(86, 3, 'Y'),
(87, 3, 'Y'),
(88, 3, 'Y'),
(89, 3, 'Y'),
(90, 3, 'Y'),
(1, 4, 'Y'),
(2, 4, 'Y'),
(3, 4, 'Y'),
(4, 4, 'Y'),
(5, 4, 'Y'),
(6, 4, 'Y'),
(7, 4, 'Y'),
(8, 4, 'Y'),
(9, 4, 'Y'),
(10, 4, 'Y'),
(11, 4, 'Y'),
(12, 4, 'Y'),
(13, 4, 'Y'),
(14, 4, 'Y'),
(15, 4, 'Y'),
(16, 4, 'Y'),
(17, 4, 'Y'),
(18, 4, 'Y'),
(19, 4, 'Y'),
(20, 4, 'Y'),
(21, 4, 'Y'),
(22, 4, 'Y'),
(23, 4, 'Y'),
(24, 4, 'Y'),
(25, 4, 'Y'),
(26, 4, 'Y'),
(27, 4, 'Y'),
(28, 4, 'Y'),
(29, 4, 'Y'),
(30, 4, 'Y'),
(31, 4, 'Y'),
(32, 4, 'Y'),
(33, 4, 'Y'),
(34, 4, 'Y'),
(35, 4, 'Y'),
(36, 4, 'Y'),
(37, 4, 'Y'),
(38, 4, 'Y'),
(39, 4, 'Y'),
(40, 4, 'Y'),
(41, 4, 'Y'),
(42, 4, 'Y'),
(43, 4, 'Y'),
(44, 4, 'Y'),
(45, 4, 'Y'),
(46, 4, 'Y'),
(47, 4, 'Y'),
(48, 4, 'Y'),
(49, 4, 'Y'),
(50, 4, 'Y'),
(51, 4, 'Y'),
(52, 4, 'Y'),
(53, 4, 'Y'),
(54, 4, 'Y'),
(55, 4, 'Y'),
(56, 4, 'Y'),
(57, 4, 'Y'),
(58, 4, 'Y'),
(59, 4, 'Y'),
(60, 4, 'Y'),
(61, 4, 'Y'),
(62, 4, 'Y'),
(63, 4, 'Y'),
(64, 4, 'Y'),
(65, 4, 'Y'),
(66, 4, 'Y'),
(67, 4, 'Y'),
(68, 4, 'Y'),
(69, 4, 'Y'),
(70, 4, 'Y'),
(71, 4, 'Y'),
(72, 4, 'Y'),
(73, 4, 'Y'),
(74, 4, 'Y'),
(75, 4, 'Y'),
(76, 4, 'Y'),
(77, 4, 'Y'),
(78, 4, 'Y'),
(79, 4, 'Y'),
(80, 4, 'Y'),
(81, 4, 'Y'),
(82, 4, 'Y'),
(83, 4, 'Y'),
(84, 4, 'Y'),
(85, 4, 'Y'),
(86, 4, 'Y'),
(87, 4, 'Y'),
(88, 4, 'Y'),
(89, 4, 'Y'),
(90, 4, 'Y'),
(1, 5, 'Y'),
(2, 5, 'Y'),
(3, 5, 'Y'),
(4, 5, 'Y'),
(5, 5, 'Y'),
(6, 5, 'Y'),
(7, 5, 'Y'),
(8, 5, 'Y'),
(9, 5, 'Y'),
(10, 5, 'Y'),
(11, 5, 'Y'),
(12, 5, 'Y'),
(13, 5, 'Y'),
(14, 5, 'Y'),
(15, 5, 'Y'),
(16, 5, 'Y'),
(17, 5, 'Y'),
(18, 5, 'Y'),
(19, 5, 'Y'),
(20, 5, 'Y'),
(21, 5, 'Y'),
(22, 5, 'Y'),
(23, 5, 'Y'),
(24, 5, 'Y'),
(25, 5, 'Y'),
(26, 5, 'Y'),
(27, 5, 'Y'),
(28, 5, 'Y'),
(29, 5, 'Y'),
(30, 5, 'Y'),
(31, 5, 'Y'),
(32, 5, 'Y'),
(33, 5, 'Y'),
(34, 5, 'Y'),
(35, 5, 'Y'),
(36, 5, 'Y'),
(37, 5, 'Y'),
(38, 5, 'Y'),
(39, 5, 'Y'),
(40, 5, 'Y'),
(41, 5, 'Y'),
(42, 5, 'Y'),
(43, 5, 'Y'),
(44, 5, 'Y'),
(45, 5, 'Y'),
(46, 5, 'Y'),
(47, 5, 'Y'),
(48, 5, 'Y'),
(49, 5, 'Y'),
(50, 5, 'Y'),
(51, 5, 'Y'),
(52, 5, 'Y'),
(53, 5, 'Y'),
(54, 5, 'Y'),
(55, 5, 'Y'),
(56, 5, 'Y'),
(57, 5, 'Y'),
(58, 5, 'Y'),
(59, 5, 'Y'),
(60, 5, 'Y'),
(61, 5, 'Y'),
(62, 5, 'Y'),
(63, 5, 'Y'),
(64, 5, 'Y'),
(65, 5, 'Y'),
(66, 5, 'Y'),
(67, 5, 'Y'),
(68, 5, 'Y'),
(69, 5, 'Y'),
(70, 5, 'Y'),
(71, 5, 'Y'),
(72, 5, 'Y'),
(73, 5, 'Y'),
(74, 5, 'Y'),
(75, 5, 'Y'),
(76, 5, 'Y'),
(77, 5, 'Y'),
(78, 5, 'Y'),
(79, 5, 'Y'),
(80, 5, 'Y'),
(81, 5, 'Y'),
(82, 5, 'Y'),
(83, 5, 'Y'),
(84, 5, 'Y'),
(85, 5, 'Y'),
(86, 5, 'Y'),
(87, 5, 'Y'),
(88, 5, 'Y'),
(89, 5, 'Y'),
(90, 5, 'Y'),
(1, 6, 'Y'),
(2, 6, 'Y'),
(3, 6, 'Y'),
(4, 6, 'Y'),
(5, 6, 'Y'),
(6, 6, 'Y'),
(7, 6, 'Y'),
(8, 6, 'Y'),
(9, 6, 'Y'),
(10, 6, 'Y'),
(11, 6, 'Y'),
(12, 6, 'Y'),
(13, 6, 'Y'),
(14, 6, 'Y'),
(15, 6, 'Y'),
(16, 6, 'Y'),
(17, 6, 'Y'),
(18, 6, 'Y'),
(19, 6, 'Y'),
(20, 6, 'Y'),
(21, 6, 'Y'),
(22, 6, 'Y'),
(23, 6, 'Y'),
(24, 6, 'Y'),
(25, 6, 'Y'),
(26, 6, 'Y'),
(27, 6, 'Y'),
(28, 6, 'Y'),
(29, 6, 'Y'),
(30, 6, 'Y'),
(31, 6, 'Y'),
(32, 6, 'Y'),
(33, 6, 'Y'),
(34, 6, 'Y'),
(35, 6, 'Y'),
(36, 6, 'Y'),
(37, 6, 'Y'),
(38, 6, 'Y'),
(39, 6, 'Y'),
(40, 6, 'Y'),
(41, 6, 'Y'),
(42, 6, 'Y'),
(43, 6, 'Y'),
(44, 6, 'Y'),
(45, 6, 'Y'),
(46, 6, 'Y'),
(47, 6, 'Y'),
(48, 6, 'Y'),
(49, 6, 'Y'),
(50, 6, 'Y'),
(51, 6, 'Y'),
(52, 6, 'Y'),
(53, 6, 'Y'),
(54, 6, 'Y'),
(55, 6, 'Y'),
(56, 6, 'Y'),
(57, 6, 'Y'),
(58, 6, 'Y'),
(59, 6, 'Y'),
(60, 6, 'Y'),
(61, 6, 'Y'),
(62, 6, 'Y'),
(63, 6, 'Y'),
(64, 6, 'Y'),
(65, 6, 'Y'),
(66, 6, 'Y'),
(67, 6, 'Y'),
(68, 6, 'Y'),
(69, 6, 'Y'),
(70, 6, 'Y'),
(71, 6, 'Y'),
(72, 6, 'Y'),
(73, 6, 'Y'),
(74, 6, 'Y'),
(75, 6, 'Y'),
(76, 6, 'Y'),
(77, 6, 'Y'),
(78, 6, 'Y'),
(79, 6, 'Y'),
(80, 6, 'Y'),
(81, 6, 'Y'),
(82, 6, 'Y'),
(83, 6, 'Y'),
(84, 6, 'Y'),
(85, 6, 'Y'),
(86, 6, 'Y'),
(87, 6, 'Y'),
(88, 6, 'Y'),
(89, 6, 'Y'),
(90, 6, 'Y'),
(1, 7, 'Y'),
(2, 7, 'Y'),
(3, 7, 'Y'),
(4, 7, 'Y'),
(5, 7, 'Y'),
(6, 7, 'Y'),
(7, 7, 'Y'),
(8, 7, 'Y'),
(9, 7, 'Y'),
(10, 7, 'Y'),
(11, 7, 'Y'),
(12, 7, 'Y'),
(13, 7, 'Y'),
(14, 7, 'Y'),
(15, 7, 'Y'),
(16, 7, 'Y'),
(17, 7, 'Y'),
(18, 7, 'Y'),
(19, 7, 'Y'),
(20, 7, 'Y'),
(21, 7, 'Y'),
(22, 7, 'Y'),
(23, 7, 'Y'),
(24, 7, 'Y'),
(25, 7, 'Y'),
(26, 7, 'Y'),
(27, 7, 'Y'),
(28, 7, 'Y'),
(29, 7, 'Y'),
(30, 7, 'Y'),
(31, 7, 'Y'),
(32, 7, 'Y'),
(33, 7, 'Y'),
(34, 7, 'Y'),
(35, 7, 'Y'),
(36, 7, 'Y'),
(37, 7, 'Y'),
(38, 7, 'Y'),
(39, 7, 'Y'),
(40, 7, 'Y'),
(41, 7, 'Y'),
(42, 7, 'Y'),
(43, 7, 'Y'),
(44, 7, 'Y'),
(45, 7, 'Y'),
(46, 7, 'Y'),
(47, 7, 'Y'),
(48, 7, 'Y'),
(49, 7, 'Y'),
(50, 7, 'Y'),
(51, 7, 'Y'),
(52, 7, 'Y'),
(53, 7, 'Y'),
(54, 7, 'Y'),
(55, 7, 'Y'),
(56, 7, 'Y'),
(57, 7, 'Y'),
(58, 7, 'Y'),
(59, 7, 'Y'),
(60, 7, 'Y'),
(61, 7, 'Y'),
(62, 7, 'Y'),
(63, 7, 'Y'),
(64, 7, 'Y'),
(65, 7, 'Y'),
(66, 7, 'Y'),
(67, 7, 'Y'),
(68, 7, 'Y'),
(69, 7, 'Y'),
(70, 7, 'Y'),
(71, 7, 'Y'),
(72, 7, 'Y'),
(73, 7, 'Y'),
(74, 7, 'Y'),
(75, 7, 'Y'),
(76, 7, 'Y'),
(77, 7, 'Y'),
(78, 7, 'Y'),
(79, 7, 'Y'),
(80, 7, 'Y'),
(81, 7, 'Y'),
(82, 7, 'Y'),
(83, 7, 'Y'),
(84, 7, 'Y'),
(85, 7, 'Y'),
(86, 7, 'Y'),
(87, 7, 'Y'),
(88, 7, 'Y'),
(89, 7, 'Y'),
(90, 7, 'Y'),
(1, 8, 'Y'),
(2, 8, 'Y'),
(3, 8, 'Y'),
(4, 8, 'Y'),
(5, 8, 'Y'),
(6, 8, 'Y'),
(7, 8, 'Y'),
(8, 8, 'Y'),
(9, 8, 'Y'),
(10, 8, 'Y'),
(11, 8, 'Y'),
(12, 8, 'Y'),
(13, 8, 'Y'),
(14, 8, 'Y'),
(15, 8, 'Y'),
(16, 8, 'Y'),
(17, 8, 'Y'),
(18, 8, 'Y'),
(19, 8, 'Y'),
(20, 8, 'Y'),
(21, 8, 'Y'),
(22, 8, 'Y'),
(23, 8, 'Y'),
(24, 8, 'Y'),
(25, 8, 'Y'),
(26, 8, 'Y'),
(27, 8, 'Y'),
(28, 8, 'Y'),
(29, 8, 'Y'),
(30, 8, 'Y'),
(31, 8, 'Y'),
(32, 8, 'Y'),
(33, 8, 'Y'),
(34, 8, 'Y'),
(35, 8, 'Y'),
(36, 8, 'Y'),
(37, 8, 'Y'),
(38, 8, 'Y'),
(39, 8, 'Y'),
(40, 8, 'Y'),
(41, 8, 'Y'),
(42, 8, 'Y'),
(43, 8, 'Y'),
(44, 8, 'Y'),
(45, 8, 'Y'),
(46, 8, 'Y'),
(47, 8, 'Y'),
(48, 8, 'Y'),
(49, 8, 'Y'),
(50, 8, 'Y'),
(51, 8, 'Y'),
(52, 8, 'Y'),
(53, 8, 'Y'),
(54, 8, 'Y'),
(55, 8, 'Y'),
(56, 8, 'Y'),
(57, 8, 'Y'),
(58, 8, 'Y'),
(59, 8, 'Y'),
(60, 8, 'Y'),
(61, 8, 'Y'),
(62, 8, 'Y'),
(63, 8, 'Y'),
(64, 8, 'Y'),
(65, 8, 'Y'),
(66, 8, 'Y'),
(67, 8, 'Y'),
(68, 8, 'Y'),
(69, 8, 'Y'),
(70, 8, 'Y'),
(71, 8, 'Y'),
(72, 8, 'Y'),
(73, 8, 'Y'),
(74, 8, 'Y'),
(75, 8, 'Y'),
(76, 8, 'Y'),
(77, 8, 'Y'),
(78, 8, 'Y'),
(79, 8, 'Y'),
(80, 8, 'Y'),
(81, 8, 'Y'),
(82, 8, 'Y'),
(83, 8, 'Y'),
(84, 8, 'Y'),
(85, 8, 'Y'),
(86, 8, 'Y'),
(87, 8, 'Y'),
(88, 8, 'Y'),
(89, 8, 'Y'),
(90, 8, 'Y'),
(1, 9, 'Y'),
(2, 9, 'Y'),
(3, 9, 'Y'),
(4, 9, 'Y'),
(5, 9, 'Y'),
(6, 9, 'Y'),
(7, 9, 'Y'),
(8, 9, 'Y'),
(9, 9, 'Y'),
(10, 9, 'Y'),
(11, 9, 'Y'),
(12, 9, 'Y'),
(13, 9, 'Y'),
(14, 9, 'Y'),
(15, 9, 'Y'),
(16, 9, 'Y'),
(17, 9, 'Y'),
(18, 9, 'Y'),
(19, 9, 'Y'),
(20, 9, 'Y'),
(21, 9, 'Y'),
(22, 9, 'Y'),
(23, 9, 'Y'),
(24, 9, 'Y'),
(25, 9, 'Y'),
(26, 9, 'Y'),
(27, 9, 'Y'),
(28, 9, 'Y'),
(29, 9, 'Y'),
(30, 9, 'Y'),
(31, 9, 'Y'),
(32, 9, 'Y'),
(33, 9, 'Y'),
(34, 9, 'Y'),
(35, 9, 'Y'),
(36, 9, 'Y'),
(37, 9, 'Y'),
(38, 9, 'Y'),
(39, 9, 'Y'),
(40, 9, 'Y'),
(41, 9, 'Y'),
(42, 9, 'Y'),
(43, 9, 'Y'),
(44, 9, 'Y'),
(45, 9, 'Y'),
(46, 9, 'Y'),
(47, 9, 'Y'),
(48, 9, 'Y'),
(49, 9, 'Y'),
(50, 9, 'Y'),
(51, 9, 'Y'),
(52, 9, 'Y'),
(53, 9, 'Y'),
(54, 9, 'Y'),
(55, 9, 'Y'),
(56, 9, 'Y'),
(57, 9, 'Y'),
(58, 9, 'Y'),
(59, 9, 'Y'),
(60, 9, 'Y'),
(61, 9, 'Y'),
(62, 9, 'Y'),
(63, 9, 'Y'),
(64, 9, 'Y'),
(65, 9, 'Y'),
(66, 9, 'Y'),
(67, 9, 'Y'),
(68, 9, 'Y'),
(69, 9, 'Y'),
(70, 9, 'Y'),
(71, 9, 'Y'),
(72, 9, 'Y'),
(73, 9, 'Y'),
(74, 9, 'Y'),
(75, 9, 'Y'),
(76, 9, 'Y'),
(77, 9, 'Y'),
(78, 9, 'Y'),
(79, 9, 'Y'),
(80, 9, 'Y'),
(81, 9, 'Y'),
(82, 9, 'Y'),
(83, 9, 'Y'),
(84, 9, 'Y'),
(85, 9, 'Y'),
(86, 9, 'Y'),
(87, 9, 'Y'),
(88, 9, 'Y'),
(89, 9, 'Y'),
(90, 9, 'Y'),
(1, 10, 'Y'),
(2, 10, 'Y'),
(3, 10, 'Y'),
(4, 10, 'Y'),
(5, 10, 'Y'),
(6, 10, 'Y'),
(7, 10, 'Y'),
(8, 10, 'Y'),
(9, 10, 'Y'),
(10, 10, 'Y'),
(11, 10, 'Y'),
(12, 10, 'Y'),
(13, 10, 'Y'),
(14, 10, 'Y'),
(15, 10, 'Y'),
(16, 10, 'Y'),
(17, 10, 'Y'),
(18, 10, 'Y'),
(19, 10, 'Y'),
(20, 10, 'Y'),
(21, 10, 'Y'),
(22, 10, 'Y'),
(23, 10, 'Y'),
(24, 10, 'Y'),
(25, 10, 'Y'),
(26, 10, 'Y'),
(27, 10, 'Y'),
(28, 10, 'Y'),
(29, 10, 'Y'),
(30, 10, 'Y'),
(31, 10, 'Y'),
(32, 10, 'Y'),
(33, 10, 'Y'),
(34, 10, 'Y'),
(35, 10, 'Y'),
(36, 10, 'Y'),
(37, 10, 'Y'),
(38, 10, 'Y'),
(39, 10, 'Y'),
(40, 10, 'Y'),
(41, 10, 'Y'),
(42, 10, 'Y'),
(43, 10, 'Y'),
(44, 10, 'Y'),
(45, 10, 'Y'),
(46, 10, 'Y'),
(47, 10, 'Y'),
(48, 10, 'Y'),
(49, 10, 'Y'),
(50, 10, 'Y'),
(51, 10, 'Y'),
(52, 10, 'Y'),
(53, 10, 'Y'),
(54, 10, 'Y'),
(55, 10, 'Y'),
(56, 10, 'Y'),
(57, 10, 'Y'),
(58, 10, 'Y'),
(59, 10, 'Y'),
(60, 10, 'Y'),
(61, 10, 'Y'),
(62, 10, 'Y'),
(63, 10, 'Y'),
(64, 10, 'Y'),
(65, 10, 'Y'),
(66, 10, 'Y'),
(67, 10, 'Y'),
(68, 10, 'Y'),
(69, 10, 'Y'),
(70, 10, 'Y'),
(71, 10, 'Y'),
(72, 10, 'Y'),
(73, 10, 'Y'),
(74, 10, 'Y'),
(75, 10, 'Y'),
(76, 10, 'Y'),
(77, 10, 'Y'),
(78, 10, 'Y'),
(79, 10, 'Y'),
(80, 10, 'Y'),
(81, 10, 'Y'),
(82, 10, 'Y'),
(83, 10, 'Y'),
(84, 10, 'Y'),
(85, 10, 'Y'),
(86, 10, 'Y'),
(87, 10, 'Y'),
(88, 10, 'Y'),
(89, 10, 'Y'),
(90, 10, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `password`, `phone_number`, `email_address`, `status`, `position`, `is_deleted`) VALUES
(1, 'Derrick Beacon', '42bcc415032a42ed189abd518a17e838', '011-1234567', 'dderick@gmail.com', 'available', 'pilot', 0),
(2, 'Kimmy Yeoh', 'c04fde79ac608e9eae5c189aa511e8c6', '012-3412907', 'kimmm@gmail.com', 'available', 'steward', 0),
(3, 'Lucas Neo', '1308dfed71297a652cc42a390e211489', '016-5261799', 'ln@gmail.com', 'available', 'stewardess', 0),
(4, 'Kyle Shaffer', 'dc7ec2c24c331c750852cdc13c32c3f4', '011-0498561', 'kyle@gmail.com', 'available', 'steward', 0),
(5, 'Mark Skyle', '6d295738eb6579053ac46a9ca1902583', '016-0901231', 'ms22@gmail.com', 'available', 'pilot', 0),
(6, 'Lewys Sims', 'b950b8ef4d90ba6f1f46bfd16d452b04', '011-1347712', 'simss@gmail.com', 'available', 'steward', 0),
(7, 'Harmony Kelly', '12f617aaa47c8a8a2d08e2c9159569d4', '012-0034916', 'harmony@gmail.com', 'available', 'stewardess', 0),
(8, 'Andrew Hush', '18d804479aafa97dbbdde41419c494bd', '016-2231192', 'andreww@gmail.com', 'available', 'stewardess', 0),
(9, 'Adam Skype', '00adce3744f9f09c06e04480ba9cd451', '016-9113267', 'adammm@gmail.com', 'available', 'manager', 0),
(10, 'Bellerin Yeoh', '0864df70e3c09e985f63accca17c9c86', '012-7872102', 'yeohb@gmail.com', 'unavailable', 'manager', 0),
(16, 'tes', '51ce84a6db96daaa7081869fd38c517a', '011-111111', 'test@gmail.com', 'unavailable', 'pilot', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(6) UNSIGNED NOT NULL,
  `flight_schedule_id` int(6) UNSIGNED NOT NULL,
  `booking_id` int(6) UNSIGNED NOT NULL,
  `passenger_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `flight_schedule_id`, `booking_id`, `passenger_id`) VALUES
(1, 2, 1, 1),
(2, 2, 1, 2),
(3, 3, 2, 3),
(4, 3, 2, 4),
(5, 4, 3, 5),
(6, 4, 3, 6),
(7, 5, 4, 7),
(8, 6, 5, 8),
(9, 6, 5, 9),
(10, 6, 5, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airplane`
--
ALTER TABLE `airplane`
  ADD PRIMARY KEY (`airplane_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_payment` (`payment_id`),
  ADD KEY `fk_emergency_Contact` (`emergency_contact_id`),
  ADD KEY `fk_customer` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  ADD PRIMARY KEY (`emergency_contact_id`);

--
-- Indexes for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD PRIMARY KEY (`flight_schedule_id`),
  ADD KEY `fk_route` (`route_id`),
  ADD KEY `fk_airplane` (`airplane_id`);

--
-- Indexes for table `luggage`
--
ALTER TABLE `luggage`
  ADD PRIMARY KEY (`luggage_id`),
  ADD KEY `fk_luggage_passenger` (`passenger_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `seat_detail`
--
ALTER TABLE `seat_detail`
  ADD KEY `fk_seat` (`seat_id`),
  ADD KEY `airplane_id` (`airplane_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_flight_schedule` (`flight_schedule_id`),
  ADD KEY `fk_booking` (`booking_id`),
  ADD KEY `fk_ticket_passenger` (`passenger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airplane`
--
ALTER TABLE `airplane`
  MODIFY `airplane_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emergency_contact`
--
ALTER TABLE `emergency_contact`
  MODIFY `emergency_contact_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  MODIFY `flight_schedule_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `luggage`
--
ALTER TABLE `luggage`
  MODIFY `luggage_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fk_emergency_Contact` FOREIGN KEY (`emergency_contact_id`) REFERENCES `emergency_contact` (`emergency_contact_id`),
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`);

--
-- Constraints for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD CONSTRAINT `fk_airplane` FOREIGN KEY (`airplane_id`) REFERENCES `airplane` (`airplane_id`),
  ADD CONSTRAINT `fk_route` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`);

--
-- Constraints for table `luggage`
--
ALTER TABLE `luggage`
  ADD CONSTRAINT `fk_luggage_passenger` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`passenger_id`);

--
-- Constraints for table `seat_detail`
--
ALTER TABLE `seat_detail`
  ADD CONSTRAINT `fk_seat` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`seat_id`),
  ADD CONSTRAINT `seat_detail_ibfk_1` FOREIGN KEY (`airplane_id`) REFERENCES `airplane` (`airplane_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `fk_flight_schedule` FOREIGN KEY (`flight_schedule_id`) REFERENCES `flight_schedule` (`flight_schedule_id`),
  ADD CONSTRAINT `fk_ticket_passenger` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`passenger_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
