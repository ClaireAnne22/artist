-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 01:37 PM
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
-- Database: `group4`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `works` text NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `name`, `birth_date`, `birthplace`, `nationality`, `works`, `specialty`, `image`) VALUES
(15, 'Czarina Khan', '2222-02-22', 'alicia isabela', 'filipino', 'wala', 'matulog', 'https://hips.hearstapps.com/hmg-prod/images/dahlia-1508785047.jpg?crop=1.00xw:0.669xh;0,0.0136xh&resize=980:*'),
(16, 'Czarina Khan', '2222-02-22', 'alicia isabela', 'filipino', 'diko alam', 'matulog', 'https://hips.hearstapps.com/hmg-prod/images/dahlia-1508785047.jpg?crop=1.00xw:0.669xh;0,0.0136xh&resize=980:*'),
(17, 'Claire Anne Domingo', '2222-02-22', 'alicia isabela', 'Filipino', 'hatdog', 'singer', 'https://cdn.britannica.com/84/73184-050-05ED59CB/Sunflower-field-Fargo-North-Dakota.jpg'),
(18, 'Claire Anne Domingo', '0000-00-00', 'alicia isabela', 'Filipino', 'wala', 'singer', 'https://cdn.britannica.com/84/73184-050-05ED59CB/Sunflower-field-Fargo-North-Dakota.jpg'),
(19, 'Claire Anne Domingo', '2222-02-22', 'alicia isabela', 'Filipino', 'wala', 'singer', 'https://cdn.britannica.com/84/73184-050-05ED59CB/Sunflower-field-Fargo-North-Dakota.jpg'),
(20, 'Claire Anne Domingo', '0000-00-00', 'alicia isabela', 'Filipino', '2222', 'singer', 'https://cdn.britannica.com/84/73184-050-05ED59CB/Sunflower-field-Fargo-North-Dakota.jpg'),
(21, 'Czarina Khan', '2222-02-22', '22', '22', 'wala', 'singer', 'https://cdn.britannica.com/84/73184-050-05ED59CB/Sunflower-field-Fargo-North-Dakota.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(0, 'Cza', 'czarinajane.deguzman@gmail.com', '$2y$10$cDkzXKHBVkY7WLoKOggPyOBWwLfl/E5n2TkRLoPiI.0XAT/8NMnGm', '2025-02-15 08:24:52'),
(0, 'az', 'rkhansaif1999@gmail.com', '$2y$10$QWQKF9X3oyujARaRRFRjs.PHAhRg/YGagkaBNPRkAa8yt9a.okDKi', '2025-02-15 13:49:59'),
(0, 'az', 'rkhansaif1999@gmail.com', '$2y$10$19Z.brcMb/W57AatGxiIjOO.DiMojO7YNEbUmV33XTcQiM417n4vK', '2025-02-15 13:58:12'),
(0, 'admin', 'wheepup@gmail.com', '$2y$10$Ez2Va.cKmqhW3smzbslHfepciXllZAvoOWwQd/eIGlI.O/wdUTW6i', '2025-02-16 10:42:09'),
(0, 'claire', 'claire@gmail.com', '$2y$10$QZtWiBriObH3fUfKHfOMaeJDbp.rAUhiPg8x4pvo1rwNi0Bxbq3ae', '2025-02-19 02:51:51'),
(0, 'claire', 'claire@gmail.com', '$2y$10$FHA4M.iMviEA9NyqjVg/COiQ8TGl2y3TBSOBKkqd/2.JbM5FFSFiG', '2025-02-20 04:32:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
