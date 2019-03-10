-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2019 at 10:44 AM
-- Server version: 5.6.15-log
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nearbyshops`
--
CREATE DATABASE IF NOT EXISTS `nearbyshops` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nearbyshops`;

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `shop_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` tinytext NOT NULL,
  `latitude` float(10,8) NOT NULL,
  `longitude` float(11,8) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `description`, `latitude`, `longitude`, `image`) VALUES
(1, 'Pizza shop', 'Some quick example text to build on the Card title and make up the bulk of the card\'s content.', 33.96448135, -6.86653137, 'https://via.placeholder.com/100x100\r\n'),
(2, 'Hamburger shop', 'Some quick example text to build on the Card title and make up the bulk of the card\'s content.', 34.00217056, -6.83129978, 'https://via.placeholder.com/100x100\r\n'),
(3, 'Grocery shop', 'Some quick example text to build on the Card title and make up the bulk of the card\'s content.', 33.98743820, -6.88020325, 'https://via.placeholder.com/100x100\r\n'),
(4, 'Electronics shop', 'Some quick example text to build on the Card title and make up the bulk of the card\'s content.', 33.99940872, -6.85043573, 'https://via.placeholder.com/100x100\r\n'),
(5, 'Clothing shop', 'Some quick example text to build on the Card title and make up the bulk of the card\'s content.', 33.96648788, -6.82083225, 'https://via.placeholder.com/100x100\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'testuser@example.com', '$2y$10$rF13DGJ7YwqZOzHEmE0b8.6CT751lRlWHJqVFfTccCFUbfOf9ES/G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `Dislikes made by User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Dislikes made on Shop ID` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `Likes made by User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Likes made on Shop ID` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
