-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 09. 11:07
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
(13, 'teszt@gmail.com', '$2y$10$qeIc1iQM6OrbWI7jiTvaxuf0lkv.qfzgPtIAsRKbpmbsy0crR2Ztm', '2024-11-09 09:48:12', 4);

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
  `Ss_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `media`
--

INSERT INTO `media` (`ID`, `Title`, `url`, `Description`, `Released`, `Img_path`, `Ss_id`) VALUES
(1, 'Filmcím', NULL, 'asdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhasdasdfsdgdgfhdghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '2024-11-04', 'movieimg1.jpg', 1),
(24, 'Outer Banks', 'https://www.netflix.com/browse?jbv=80236318', 'Film leírás', '2024-11-09', 'outerbanks.jpg', 1),
(33, 'Teszt képpel új', 'teszt', 'Teszt képpel új módszer', '2024-11-09', '1731145704_911855e82d1192893630.jpg', 2);

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
  `Created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`ID`, `First_name`, `Last_name`, `Username`, `Email`, `Password`, `Is_admin`, `Created`) VALUES
(1, 'Asd', 'Asd', 'asdf', 'asd@gmail.com', '$2y$10$NtvEGW/khZAIiRr8LXEcN.JP2uTxyP3SVG8u58dAvBEHa6uNCRoSi', 0, '2024-11-04'),
(4, 'User', 'Teszt', 'tesztuser', 'teszt@gmail.com', '$2y$10$zgL0hSodmevkNwzDrSGUi.ZUzgFWQTBekjXhbr8ed4rASXHuVafY.', 1, '2024-11-08');

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
-- A tábla indexei `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `media` (`Ss_id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `streamingservices`
--
ALTER TABLE `streamingservices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
