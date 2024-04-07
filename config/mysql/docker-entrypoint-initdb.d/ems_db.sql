-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 172.20.0.2
-- Generation Time: Apr 07, 2024 at 10:36 PM
-- Server version: 5.7.24
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems_db`
--
CREATE DATABASE IF NOT EXISTS `ems_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ems_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'sports', NULL),
(2, 'tech', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `attendees` text,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `lon` float NOT NULL,
  `lat` float NOT NULL,
  `timezone_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `events`
--

TRUNCATE TABLE `events`;
--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `attendees`, `date_time`, `address`, `country`, `city`, `country_code`, `lon`, `lat`, `timezone_name`) VALUES
(1, 'event1', NULL, NULL, '2024-04-07 11:15:50', NULL, 'malta', 'St pauls bay', 'mt', 12.3, 12.3, 'Europe/Malta'),
(2, 'event2', NULL, NULL, '2024-04-07 11:15:50', NULL, 'malta', 'St pauls bay', 'mt', 12.3, 12.3, 'Europe/Malta');

-- --------------------------------------------------------

--
-- Table structure for table `events_categories`
--

CREATE TABLE `events_categories` (
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `events_categories`
--

TRUNCATE TABLE `events_categories`;
--
-- Dumping data for table `events_categories`
--

INSERT INTO `events_categories` (`event_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_categories`
--
ALTER TABLE `events_categories`
  ADD PRIMARY KEY (`event_id`,`category_id`),
  ADD KEY `events_categories_categories_FK` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_categories`
--
ALTER TABLE `events_categories`
  ADD CONSTRAINT `events_categories_categories_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_categories_events_FK` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
