-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 22, 2021 at 06:21 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpooling`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int NOT NULL,
  `price` int NOT NULL,
  `placeStart` varchar(255) NOT NULL,
  `placeEnd` varchar(255) NOT NULL,
  `dateStart` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `price`, `placeStart`, `placeEnd`, `dateStart`) VALUES
(1, 50, 'Paris', 'Marseille', '2021-11-22 16:15:28'),
(2, 30, 'Nantes', 'Angers', '2021-11-19 16:18:33'),
(7, 60, 'Nice', 'Paris', '2021-12-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `nbrSlots` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `nbrSlots`) VALUES
(1, 'Skoda', 'Fabia', 'Noire', 5),
(2, 'Huandai', 'Getz', 'Rouge', 5),
(3, 'Mercedes', 'Classe C', 'Noire', 4),
(4, 'Renault', 'Twingo', 'Rose', 5),
(6, 'Tesla', 'Model 3', 'Rouge', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08 00:00:00'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08 00:00:00'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08 00:00:00'),
(4, 'Paul', 'Jean', 'sonmail@mail.fr', '2021-11-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_cars`
--

CREATE TABLE `users_cars` (
  `user_id` int NOT NULL,
  `car_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_cars`
--

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`user_id`,`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
