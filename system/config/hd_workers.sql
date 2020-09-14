-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2018. Sze 11. 10:46
-- Kiszolgáló verziója: 10.1.35-MariaDB-1
-- PHP verzió: 7.2.9-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hd`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hd_users`
--

CREATE TABLE `hd_workers` (
  `wid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `other` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `hd_users`
--
ALTER TABLE `hd_workers`
  ADD PRIMARY KEY (`wid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
