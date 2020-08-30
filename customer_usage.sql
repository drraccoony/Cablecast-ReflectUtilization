-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2020 at 08:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reflect_usage`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_usage`
--

CREATE TABLE `customer_usage` (
  `id` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `date` date NOT NULL,
  `data_use` int(11) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_usage`
--

INSERT INTO `customer_usage` (`id`, `customerID`, `date`, `data_use`, `cost`) VALUES
(1, 10033, '2020-08-30', 0, 0.0507740421),
(2, 10052, '2020-08-30', 0, 0.2783909412),
(3, 10093, '2020-08-30', 0, 2.4624945368),
(4, 10356, '2020-08-30', 0, 2.4003513964),
(5, 10369, '2020-08-30', 0, 0.4020887183),
(6, 10441, '2020-08-30', 0, 0.0345204578),
(7, 10570, '2020-08-30', 0, 0.0293239218),
(8, 10685, '2020-08-30', 0, 0.5815670744),
(9, 10857, '2020-08-30', 0, 0.0048866202),
(10, 1101, '2020-08-30', 0, 0.0000934025);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_usage`
--
ALTER TABLE `customer_usage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_usage`
--
ALTER TABLE `customer_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
