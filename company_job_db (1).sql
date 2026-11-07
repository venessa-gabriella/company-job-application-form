-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2026 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_job_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `position_applied` varchar(100) NOT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `full_name`, `email`, `phone`, `gender`, `position_applied`, `education_level`, `experience`, `address`, `cover_letter`, `application_date`) VALUES
(1, 'Jane Waithera', 'waitheranyoikejane@gmail.com', '0116887107', 'Female', 'IT Officer', 'Degree', 'Less than 1 year', '6007', 'I\'m a ICT Support expertee and i want to advance my skills and bring more impact in your company', '2026-11-06 12:42:42'),
(2, 'Purity Nyambura', 'pnyambura059@gmail.com', '0112172185', 'Female', 'Sales Representative', 'Degree', '4-6 years', '122790', 'gain more skills', '2026-11-06 12:43:40'),
(3, 'george Amilia', 'mercy3@gmail.com', '0712907890', 'Male', 'Human Resource Officer', 'Masters', '4-6 years', '342200', 'to bring more value to the company', '2026-11-06 13:04:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
