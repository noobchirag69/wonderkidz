-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 11:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wonderkidz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Chirag Chakraborty', 'chiragchakraborty48@gmail.com', 'f0e897aeb6e1e775eb3657e7e46718ce', 'admin'),
(2, 'John Doe', 'john@doe.com', 'd299a92004734135de74355770b7c785', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prizes` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `eventDate` date DEFAULT NULL,
  `mode` varchar(255) NOT NULL,
  `fees` int(11) NOT NULL,
  `commission` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `last_registration` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`id`, `title`, `description`, `prizes`, `date`, `user`, `image`, `organizer`, `eventDate`, `mode`, `fees`, `commission`, `discount`, `last_registration`) VALUES
(11, 'YAA Anime Fest', '&lt;p&gt;Please include Rules, Eligibility, Process, Registration Fees, Format, Venue etc., to make the contest clearer to the potential participants. Use bullet points for more clarity. The more details you provide, higher goes the chance of someone participating!&lt;/p&gt;', 'Anime Merchandise', '2023-05-05', '1', '6455c980ef9e4_2602058.jpg', '#You Are Awesome', '2023-05-31', 'offline', 350, 20, 20, NULL),
(12, 'Marvel Quiz', '&lt;p&gt;Please include Rules, Eligibility, Process, Registration Fees, Format, Venue etc., to make the contest clearer to the potential participants. Use bullet points for more clarity. The more details you provide, higher goes the chance of someone participating!&lt;/p&gt;', 'Prize Pool of Rs. 6K, Certificates for all participants.', '2023-05-06', '2', '6455fb5157072_463445.jpg', 'Pragya - The Official Quiz Club of UEM Kolkata', '2023-05-16', 'online', 100, 20, 10, '2023-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `contest_participants`
--

CREATE TABLE `contest_participants` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contest_participants`
--

INSERT INTO `contest_participants` (`id`, `contest_id`, `student_id`) VALUES
(1, 11, 1),
(2, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `institute` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `role`, `birthday`, `institute`, `gender`) VALUES
(1, 'Sanchayeeta Saha', 'sanchayeeta7@gmail.com', 'bdd86c19173f966272c80dbf20835ae9', 'student', '2000-07-26', 'University of Engineering &amp; Management (UEM), Kolkata', 'female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_participants`
--
ALTER TABLE `contest_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contest_id` (`contest_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contest_participants`
--
ALTER TABLE `contest_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contest_participants`
--
ALTER TABLE `contest_participants`
  ADD CONSTRAINT `contest_participants_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`id`),
  ADD CONSTRAINT `contest_participants_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
