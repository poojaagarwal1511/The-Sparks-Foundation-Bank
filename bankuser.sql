-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 01:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `sno` int(3) NOT NULL,
  `sender` text NOT NULL,
  `receiver` text NOT NULL,
  `balance` int(8) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`sno`, `sender`, `receiver`, `balance`, `datetime`) VALUES
(1, 'Ayush raj', 'Virat Ojha', 1000, '2021-06-07 06:19:25'),
(2, 'Nishtha Gupta', 'Bhavesh Jain', 5000, '2021-06-07 06:23:46'),
(3, 'Prisha Rathore', 'Nehal Singh', 10000, '2021-06-07 06:25:07'),
(4, 'Nishtha Gupta', 'Rajesh Raj', 10000, '2021-01-06 08:31:25'),
(5, 'Nishtha Gupta', 'Nisha Kulkarni', 10000, '2021-06-08 07:43:34'),
(6, 'Prisha Rathore', 'Nishtha Gupta', 20000, '2021-06-08 07:43:52'),
(7, 'Nehal Singh', 'Paakhi Desai', 15000, '2021-06-08 07:44:15'),
(8, 'Rajesh Raj', 'Aditya Pai', 20000, '2021-06-08 07:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `balance` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `balance`) VALUES
(1, 'Nishtha Gupta', 'nishtha@gmail.com', 50000),
(2, 'Nisha Kulkarni', 'nisha@gmail.com', 85098),
(3, 'Bhavesh Jain ', 'bhavesh@gmail.com', 50090),
(4, 'Prisha Rathore', 'prisha@gmail.com', 89000),
(5, 'Virat Ojha', 'virat@gmail.com', 78988),
(6, 'Nehal Singh', 'nehal@gmail.com', 85890),
(7, 'Ayush Raj', 'ayush@gmail.com', 56889),
(8, 'Paakhi Desai', 'paakhi@gmail.com', 48586),
(9, 'Aditya Pai', 'aditya@gmail.com', 78584),
(10, 'Rajesh Raj', 'rajesh@gmail.com', 105000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `sno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
