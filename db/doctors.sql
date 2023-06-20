-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Jun 20, 2023 at 11:46 AM
-- Server version: 8.0.33
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `description`) VALUES
(1, 'Andrei Popescu', 'Dr. Andrei Popescu is a compassionate and highly skilled physician dedicated to providing exceptional medical care to her patients. With over 15 years of experience, Dr. Popescu is board-certified in internal medicine and has a deep understanding of the complexities of the human body.'),
(2, 'Mihai Ionescu', 'Dr. Mihai Ionescu is a highly experienced and dedicated physician known for his exceptional expertise in orthopedic surgery. With a career spanning over two decades, Dr. Ionescu has become a trusted name in his field, renowned for his surgical skills and compassionate patient care.'),
(3, 'Andrei Mihaescu', 'Dr. Andrei Mihaescu is a highly skilled and compassionate cardiologist dedicated to the diagnosis and treatment of cardiovascular diseases. With a strong background in cardiology, Dr. Mihaescu has established himself as a respected authority in the field.'),
(4, 'Elena Voda', 'Dr. Elena Voda is a highly compassionate and experienced pediatrician dedicated to providing comprehensive care to infants, children, and adolescents. With a genuine love for working with young patients, Dr. Voda creates a warm and welcoming environment where children feel comfortable.'),
(5, 'Elena Popescu', 'Dr. Elena Popescu is a highly skilled and compassionate obstetrician-gynecologist committed to providing women\'s healthcare. With a focus on the unique needs of women throughout their reproductive years, Dr. Popescu offers personalized care in a comfortable environment.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
