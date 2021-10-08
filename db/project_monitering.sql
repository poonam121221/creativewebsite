-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 10:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comm_int_educational_qualification`
--

CREATE TABLE `comm_int_educational_qualification` (
  `id` int(11) NOT NULL,
  `int_id` int(11) NOT NULL,
  `degree` varchar(64) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `univercity_board` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `passing_year` int(11) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comm_int_experience`
--

CREATE TABLE `comm_int_experience` (
  `id` int(11) NOT NULL,
  `int_id` int(11) NOT NULL,
  `post_name` int(100) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `responsbility` varchar(255) NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comm_int_project_monitoring`
--

CREATE TABLE `comm_int_project_monitoring` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `mother_name` varchar(64) NOT NULL,
  `dob` date NOT NULL,
  `present_address` varchar(200) NOT NULL,
  `permanant_address` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `computer_proficiency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comm_int_educational_qualification`
--
ALTER TABLE `comm_int_educational_qualification`
  ADD KEY `int_id` (`int_id`);

--
-- Indexes for table `comm_int_experience`
--
ALTER TABLE `comm_int_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comm_int_project_monitoring`
--
ALTER TABLE `comm_int_project_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comm_int_experience`
--
ALTER TABLE `comm_int_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comm_int_project_monitoring`
--
ALTER TABLE `comm_int_project_monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comm_int_educational_qualification`
--
ALTER TABLE `comm_int_educational_qualification`
  ADD CONSTRAINT `comm_int_educational_qualification_ibfk_1` FOREIGN KEY (`int_id`) REFERENCES `comm_int_project_monitoring` (`id`),
  ADD CONSTRAINT `comm_int_educational_qualification_ibfk_2` FOREIGN KEY (`int_id`) REFERENCES `comm_int_project_monitoring` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `comm_consultancy_firms` ADD `application_status` TINYINT NOT NULL AFTER `payment_status`;

ALTER TABLE `comm_consultancy_firms` CHANGE `application_status` `application_status` INT(4) NOT NULL DEFAULT '0';
ALTER TABLE `comm_consultancy_firms` ADD `reject_region` VARCHAR(250) NOT NULL AFTER `application_status`;

ALTER TABLE `comm_users` ADD `application_status` INT NOT NULL AFTER `user_photo_id`, ADD `reject_region` VARCHAR(250) NOT NULL AFTER `application_status`;
ALTER TABLE `comm_users` ADD `tnx_id` INT NOT NULL AFTER `reject_region`;