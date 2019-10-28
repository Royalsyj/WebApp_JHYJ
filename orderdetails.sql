-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2019 at 12:26 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f31ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderID` int(40) NOT NULL,
  `menuID` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `shape` int(11) NOT NULL,
  `topping` int(11) NOT NULL,
  `layer1` int(11) NOT NULL,
  `layer2` int(11) NOT NULL,
  `layer3` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `menuID`, `size`, `shape`, `topping`, `layer1`, `layer2`, `layer3`, `quantity`) VALUES
(4, 4, 0, 0, 0, 0, 0, 0, 1),
(5, 1, 0, 0, 0, 0, 0, 0, 1),
(5, 3, 0, 0, 0, 0, 0, 0, 1),
(5, 4, 0, 0, 0, 0, 0, 0, 1),
(6, 6, 0, 0, 0, 0, 0, 0, 1),
(6, 7, 0, 0, 0, 0, 0, 0, 1),
(6, 8, 0, 0, 0, 0, 0, 0, 3),
(6, 9, 0, 0, 0, 0, 0, 0, 5),
(7, 6, 0, 0, 0, 0, 0, 0, 1),
(7, 7, 0, 0, 0, 0, 0, 0, 1),
(7, 8, 0, 0, 0, 0, 0, 0, 3),
(8, 8, 0, 0, 0, 0, 0, 0, 3),
(8, 9, 0, 0, 0, 0, 0, 0, 5),
(9, 6, 0, 0, 0, 0, 0, 0, 2),
(9, 7, 0, 0, 0, 0, 0, 0, 2),
(10, 8, 0, 0, 0, 0, 0, 0, 1),
(10, 5, 0, 0, 0, 0, 0, 0, 1),
(11, 0, 0, 0, 0, 0, 0, 0, 1),
(11, 4, 0, 0, 0, 0, 0, 0, 1),
(12, 1, 0, 0, 0, 0, 0, 0, 1),
(13, 1, 0, 0, 0, 0, 0, 0, 1),
(13, 2, 0, 0, 0, 0, 0, 0, 1),
(14, 0, 0, 0, 0, 0, 0, 0, 1),
(14, 1, 0, 0, 0, 0, 0, 0, 1),
(15, 3, 0, 0, 0, 0, 0, 0, 1),
(15, 4, 0, 0, 0, 0, 0, 0, 2),
(16, 0, 0, 0, 0, 0, 0, 0, 1),
(16, 1, 0, 0, 0, 0, 0, 0, 1),
(17, 0, 0, 0, 0, 0, 0, 0, 1),
(17, 0, 0, 0, 0, 0, 0, 0, 1),
(19, 0, 0, 0, 0, 0, 0, 0, 1),
(19, 1, 0, 0, 0, 0, 0, 0, 1),
(20, 0, 0, 0, 0, 0, 0, 0, 2),
(21, 1, 0, 0, 0, 0, 0, 0, 1),
(22, 1, 0, 0, 0, 0, 0, 0, 1),
(23, 1, 0, 0, 0, 0, 0, 0, 1),
(24, 1, 0, 0, 0, 0, 0, 0, 1),
(24, 2, 0, 0, 0, 0, 0, 0, 1),
(25, 1, 0, 0, 0, 0, 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
