-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2021 at 02:28 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SSS`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `syear` varchar(255) NOT NULL,
  `phno` varchar(11) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `submitted_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `regno`, `sname`, `dob`, `course`, `branch`, `syear`, `phno`, `address`, `email`, `password`, `submitted_time`) VALUES
(2, '4735756', 'Parthiban S', '2021-03-11', '1', '1', '1', '06383117625', NULL, 'parthibans452@gmail.com', 'riya24$2y$10$CFRmJNEfP4FbfMcW/chqEOHUFMrFzwDixWDKXuOB0Z4LAMqj8pm7W', '2021-03-14 13:10:19'),
(3, '123456', 'Parthiban S', '2021-03-04', '2', '2', '3', '06383117625', NULL, 'parthibans452@gmail.com', 'riya24$2y$10$sP/HepYfuKqwBO78Nlpp4OCnHRxag9Aa.TNxe9Sh3GpsSAqAb75OO', '2021-03-14 13:12:20'),
(4, '142536', 'Parthiban S', '2021-03-11', '2', '2', '1', '06383117625', NULL, 'parthibans452@gmail.com', 'riya24$2y$10$CiwktEtxjWmaMC1paL3rauw8RgCK9eEFXMFLK7BLfrcJFr/lLySlW', '2021-03-14 13:15:49'),
(5, '53153132', 'Parthiban S', '2021-03-11', '2', '1', '1', '06383117625', NULL, 'parthibans452@gmail.com', 'riya24$2y$10$cGD9sSo7OplpW41iiihufOmQHzJ0lGYLdOx6KrqWBmVZhSPbdyDlq', '2021-03-14 13:26:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'parthiban', '$2y$10$XTS4kvezXplwnt7mnMMS1O2noDa0w8CyBxje1EytYeZDkp0MxVtOe', '2021-03-07 15:41:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
