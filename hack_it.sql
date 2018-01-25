-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2018 at 05:19 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hack_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_no` int(11) NOT NULL,
  `hint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_no`, `hint`, `answer`, `points`) VALUES
(1, 'hint', '1', 10),
(2, 'no hint', 'hello world', 20);

-- --------------------------------------------------------

--
-- Table structure for table `track_records`
--

CREATE TABLE `track_records` (
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_level` int(11) NOT NULL DEFAULT '0',
  `total_score` int(11) NOT NULL DEFAULT '0',
  `current_hint_took` int(11) NOT NULL DEFAULT '0',
  `on_block` int(11) NOT NULL DEFAULT '0',
  `when_to_unblock` datetime NOT NULL,
  `last_success` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_records`
--

INSERT INTO `track_records` (`username`, `current_level`, `total_score`, `current_hint_took`, `on_block`, `when_to_unblock`, `last_success`) VALUES
('sas', 1, 10, 0, 0, '2018-01-25 06:41:54', '2018-01-25 06:44:29'),
('sourabh', 2, 20, 0, 0, '2018-01-25 06:41:14', '2018-01-25 17:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(11) NOT NULL,
  `college` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `temp_pwd` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `phone`, `college`, `activated`, `temp_pwd`, `hash`) VALUES
('sas', 'sas@sas.com', '8ad17dadafdf341124084e302023fc75bc5cf7b265b7ff84e383a5da182aa7f48d70e9e70b96b0045c10c911dadbcff9817ab7b1760c5366e6df3f33af5fc51c', 1234567890, 'sjce', 1, NULL, '19305891765a697c2e3ff68'),
('sourabh', 'ss@ss.com', '8ad17dadafdf341124084e302023fc75bc5cf7b265b7ff84e383a5da182aa7f48d70e9e70b96b0045c10c911dadbcff9817ab7b1760c5366e6df3f33af5fc51c', 1234567890, 'sjce', 1, NULL, '17588021755a697c076cd86');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_no`);

--
-- Indexes for table `track_records`
--
ALTER TABLE `track_records`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `track_records`
--
ALTER TABLE `track_records`
  ADD CONSTRAINT `fk_track_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
