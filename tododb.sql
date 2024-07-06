-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 05:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tododb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasktb`
--

CREATE TABLE `tasktb` (
  `taskID` int(255) NOT NULL,
  `username` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `due_dates` date NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasktb`
--

INSERT INTO `tasktb` (`taskID`, `username`, `title`, `description`, `due_dates`, `status`) VALUES
(40, 'lasankith', 'Project Setup', 'Create the project directory structure.\r\nSet up HTML, CSS, JavaScript, and PHP files.', '2024-07-08', '1'),
(41, 'lasankith', 'Front-End Development:', 'Create the main HTML layout.\r\nStyle the website using Bootstrap and custom CSS.\r\nImplement JavaScript for interactivity.', '2024-07-15', '0'),
(42, 'lasankith', 'Back-End Development:', 'Set up the MySQL database.\r\nCreate PHP scripts for handling tasks (add, view, update, delete).', '2024-07-22', '0'),
(43, 'lasankith', 'Integration:', 'Connect the front-end and back-end.\r\nTest the functionality.', '2024-07-27', '0'),
(45, 'lasankith', 'asdad', 'sdas', '2025-05-07', '0'),
(46, 'lasankith', 'test', 'a', '2024-07-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `usertb`
--

CREATE TABLE `usertb` (
  `fullName` varchar(500) NOT NULL,
  `userName` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertb`
--

INSERT INTO `usertb` (`fullName`, `userName`, `email`, `password`) VALUES
('lasankith', 'lasankith', 'lasankith@gmail.com', 'lasankith');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasktb`
--
ALTER TABLE `tasktb`
  ADD PRIMARY KEY (`taskID`);

--
-- Indexes for table `usertb`
--
ALTER TABLE `usertb`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasktb`
--
ALTER TABLE `tasktb`
  MODIFY `taskID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
