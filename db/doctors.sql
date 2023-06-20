-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: db:3306
-- Timp de generare: iun. 08, 2023 la 11:11 AM
-- Versiune server: 8.0.33
-- Versiune PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `php_docker`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Eliminarea datelor din tabel `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `description`) VALUES
(1, 'Andrei Popescu', 'Dr. Andrei Popescu is a compassionate and highly skilled physician dedicated to providing exceptional medical care to her patients. With over 15 years of experience, Dr. Popescu is board-certified in internal medicine and has a deep understanding of the complexities of the human body.');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
