-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 12:26 PM
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
-- Database: `dice-game`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(266) NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `points`, `created_at`, `updated_at`) VALUES
(1, 'user 1', 100, '2024-11-11 09:38:47', '2024-11-11 09:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_bets`
--

CREATE TABLE `user_bets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `predicted_number` varchar(266) NOT NULL,
  `result` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `is_reset` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_bets`
--

INSERT INTO `user_bets` (`id`, `user_id`, `predicted_number`, `result`, `points`, `is_reset`, `created_at`, `updated_at`) VALUES
(1, 1, 'Below 7', 10, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(2, 1, 'Below 7', 7, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(3, 1, 'Below 7', 4, 20, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(4, 1, 'Below 7', 10, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(5, 1, 'Above 7', 2, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(6, 1, 'Above 7', 9, 20, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(7, 1, 'Above 7', 6, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(8, 1, '7', 7, 30, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(9, 1, '7', 7, 30, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56'),
(10, 1, '7', 8, -10, 1, '2024-11-11 09:38:56', '2024-11-11 09:38:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bets`
--
ALTER TABLE `user_bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_bets`
--
ALTER TABLE `user_bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_bets`
--
ALTER TABLE `user_bets`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
