-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 01:18 AM
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
  `email` text NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Created` datetime NOT NULL DEFAULT current_timestamp(),
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `email`, `Password`, `Created`, `User_ID`) VALUES
(13, 'teszt@gmail.com', '$2y$10$qeIc1iQM6OrbWI7jiTvaxuf0lkv.qfzgPtIAsRKbpmbsy0crR2Ztm', '2024-11-09 09:48:12', 4);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `ID` int(11) NOT NULL,
  `Genre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`ID`, `Genre`) VALUES
(1, 'unknown'),
(2, 'comedy'),
(3, 'action'),
(4, 'thriller'),
(5, 'horror');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `url` text DEFAULT NULL,
  `Description` text NOT NULL,
  `Released` date NOT NULL,
  `Img_path` varchar(255) NOT NULL,
  `Ss_id` int(11) NOT NULL,
  `Type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`ID`, `Title`, `url`, `Description`, `Released`, `Img_path`, `Ss_id`, `Type`) VALUES
(1, 'Filmcím', NULL, 'asdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2024-11-04', 'movieimg1.jpg', 1, ''),
(24, 'Outer Banks', 'https://www.netflix.com/browse?jbv=80236318', 'Film leírás', '2024-11-09', 'outerbanks.jpg', 1, ''),
(33, 'Teszt képpel új', 'teszt', 'Teszt képpel új módszer', '2024-11-09', '1731145704_911855e82d1192893630.jpg', 2, ''),
(34, 'Pókember: Nincs hazaút', NULL, 'With Spider-Man\'s identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear.', '2021-12-07', 'movieimg2.jpg', 2, 'Film');

-- --------------------------------------------------------

--
-- Table structure for table `mediaxgenre`
--

CREATE TABLE `mediaxgenre` (
  `GenreID` int(11) NOT NULL,
  `MediaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mediaxgenre`
--

INSERT INTO `mediaxgenre` (`GenreID`, `MediaID`) VALUES
(2, 24),
(3, 1),
(4, 33),
(5, 1);

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
(1, 'Netflix', 'asd', 1800),
(2, 'HBO', 'asdasd', 1800);

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
  `Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_name`, `Last_name`, `Username`, `Email`, `Password`, `Is_admin`, `Created`) VALUES
(1, 'Asd', 'Asd', 'asdf', 'asd@gmail.com', '$2y$10$NtvEGW/khZAIiRr8LXEcN.JP2uTxyP3SVG8u58dAvBEHa6uNCRoSi', 0, '2024-11-04'),
(4, 'User', 'Teszt', 'tesztuser', 'teszt@gmail.com', '$2y$10$zgL0hSodmevkNwzDrSGUi.ZUzgFWQTBekjXhbr8ed4rASXHuVafY.', 1, '2024-11-08');

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
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `media` (`Ss_id`);

--
-- Indexes for table `mediaxgenre`
--
ALTER TABLE `mediaxgenre`
  ADD PRIMARY KEY (`GenreID`,`MediaID`),
  ADD KEY `media_fk` (`MediaID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `streamingservices`
--
ALTER TABLE `streamingservices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

--
-- Constraints for table `mediaxgenre`
--
ALTER TABLE `mediaxgenre`
  ADD CONSTRAINT `genre_fk` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media_fk` FOREIGN KEY (`MediaID`) REFERENCES `media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
