-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 02. 14:43
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `project_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `email` text NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Created` datetime NOT NULL DEFAULT current_timestamp(),
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`ID`, `email`, `Password`, `Created`, `User_ID`) VALUES
(13, 'teszt@gmail.com', '$2y$10$qeIc1iQM6OrbWI7jiTvaxuf0lkv.qfzgPtIAsRKbpmbsy0crR2Ztm', '2024-11-09 09:48:12', 4),
(15, 'asdasdas@gmail.com', '$2y$10$9foYkon3W9Rb0JzFMZNwM.RW1BSoryVb5acSdMxVUQJBfzeTJCQ7u', '2024-12-02 14:17:26', 10),
(16, 'zolika.nanasi@gmail.com', '$2y$10$MTG5hLXcvV4Mb4Kglds9megdT9oufy60HfGJzXLTxs2wnW3e2ujGa', '2024-12-02 14:34:39', 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `genres`
--

CREATE TABLE `genres` (
  `ID` int(11) NOT NULL,
  `Genre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `genres`
--

INSERT INTO `genres` (`ID`, `Genre`) VALUES
(1, 'unknown'),
(2, 'comedy'),
(3, 'action'),
(4, 'thriller'),
(5, 'horror');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `media`
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
-- A tábla adatainak kiíratása `media`
--

INSERT INTO `media` (`ID`, `Title`, `url`, `Description`, `Released`, `Img_path`, `Ss_id`, `Type`) VALUES
(1, 'Filmcím', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\n', '2024-11-04', 'movieimg1.jpg', 1, ''),
(24, 'Outer Banks', 'https://www.netflix.com/browse?jbv=80236318', 'Film leírás', '2024-11-09', 'outerbanks.jpg', 1, ''),
(33, 'Teszt képpel új', 'teszt', 'Teszt képpel új módszer', '2024-11-09', '1731145704_911855e82d1192893630.jpg', 2, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mediaxgenre`
--

CREATE TABLE `mediaxgenre` (
  `GenreID` int(11) NOT NULL,
  `MediaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mediaxgenre`
--

INSERT INTO `mediaxgenre` (`GenreID`, `MediaID`) VALUES
(2, 24),
(3, 1),
(4, 33),
(5, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `streamingservices`
--

CREATE TABLE `streamingservices` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Link` varchar(255) NOT NULL,
  `Lowest_price_plan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `streamingservices`
--

INSERT INTO `streamingservices` (`ID`, `Name`, `Link`, `Lowest_price_plan`) VALUES
(1, 'Netflix', 'asd', 1800),
(2, 'HBO', 'asdasd', 1800);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `First_name` varchar(45) NOT NULL,
  `Last_name` varchar(45) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `Created` date NOT NULL DEFAULT current_timestamp(),
  `profile_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`ID`, `First_name`, `Last_name`, `Username`, `Email`, `Password`, `Is_admin`, `Created`, `profile_img`) VALUES
(1, 'Asd', 'Asd', 'asdf', 'asd@gmail.com', '$2y$10$NtvEGW/khZAIiRr8LXEcN.JP2uTxyP3SVG8u58dAvBEHa6uNCRoSi', 0, '2024-11-04', ''),
(4, 'User', 'Teszt', 'tesztuser', 'teszt@gmail.com', '$2y$10$zgL0hSodmevkNwzDrSGUi.ZUzgFWQTBekjXhbr8ed4rASXHuVafY.', 1, '2024-11-08', ''),
(9, 'User', 'Teszt', 'testuser', 'zolika.nanasi@gmail.com', '$2y$10$VE41rhNcAwuE33qrVu/VIuAvjmsD/8qo.E7OSKBm0gyC3EvKcmdLq', 1, '2024-11-25', ''),
(10, 'Asztuser', 'Tesztuser', 'testuser30', 'asdasdas@gmail.com', '$2y$10$dTvq200PQGxd4e3XIW64VeBZ3jTiKppVaVVd6o6sqpsp.7cyDbrzC', 1, '2024-11-25', '1733142743_cd89bd1f7a8450337fd4.png'),
(11, 'Asdsd', 'Asdsd', 'asdasd', 'asd@asd2.com', '$2y$10$ruL1Avk8Ia3WlbLRggV2Quab.r/PyWE0n7UwjRuQN8H.CXjfpdHCu', 0, '2024-12-02', '1733146894_31f8f7bbbcb13169c811.png');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `admin_user` (`User_ID`);

--
-- A tábla indexei `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `media` (`Ss_id`);

--
-- A tábla indexei `mediaxgenre`
--
ALTER TABLE `mediaxgenre`
  ADD PRIMARY KEY (`GenreID`,`MediaID`),
  ADD KEY `media_fk` (`MediaID`);

--
-- A tábla indexei `streamingservices`
--
ALTER TABLE `streamingservices`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_un` (`Username`),
  ADD UNIQUE KEY `unique_email` (`Email`) USING BTREE;

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `genres`
--
ALTER TABLE `genres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `streamingservices`
--
ALTER TABLE `streamingservices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media` FOREIGN KEY (`Ss_id`) REFERENCES `streamingservices` (`ID`);

--
-- Megkötések a táblához `mediaxgenre`
--
ALTER TABLE `mediaxgenre`
  ADD CONSTRAINT `genre_fk` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media_fk` FOREIGN KEY (`MediaID`) REFERENCES `media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
