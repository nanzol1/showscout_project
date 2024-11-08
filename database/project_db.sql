-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 05:39 PM
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
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Created` datetime NOT NULL DEFAULT current_timestamp(),
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Released` date NOT NULL,
  `Img_path` varchar(255) NOT NULL,
  `Ss_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`ID`, `Title`, `Description`, `Released`, `Img_path`, `Ss_id`) VALUES
(1, 'Filmcím', 'asdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2024-11-04', 'movieimg1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `streamingservices`
--

CREATE TABLE `streamingservices` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Link` varchar(255) NOT NULL,
  `Lowest_price_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `streamingservices`
--

INSERT INTO `streamingservices` (`ID`, `Name`, `Link`, `Lowest_price_plan`) VALUES
(1, 'Netflix', 'asd', 1800);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `Created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_name`, `Last_name`, `Username`, `Email`, `Password`, `Is_admin`, `Created`) VALUES
(1, 'Asd', 'Asd', 'asdf', 'asd@gmail.com', '$2y$10$NtvEGW/khZAIiRr8LXEcN.JP2uTxyP3SVG8u58dAvBEHa6uNCRoSi', 0, '2024-11-04 00:00:00'),
(2, 'Aff', 'Asd', 'sdfsfgsg', 'dsg@gmail.com', '$2y$10$ZR8UxglL84bXinMxDf6Ehewx34CEHVM1IGpKSvNexY.JnPrUUz4VO', 0, '2024-11-04 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `admin_user` (`User_ID`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `media` (`Ss_id`);

--
-- Indexes for table `streamingservices`
--
ALTER TABLE `streamingservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_un` (`Username`),
  ADD UNIQUE KEY `unique_email` (`Email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `streamingservices`
--
ALTER TABLE `streamingservices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media` FOREIGN KEY (`Ss_id`) REFERENCES `streamingservices` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
