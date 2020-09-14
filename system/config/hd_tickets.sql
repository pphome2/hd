-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2018. Sze 25. 12:05
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
-- Tábla szerkezet ehhez a táblához `hd_tickets`
--

CREATE TABLE `hd_tickets` (
  `tid` varchar(20) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `cont` varchar(200) NOT NULL,
  `dev` text NOT NULL,
  `err` text NOT NULL,
  `stat` varchar(200) NOT NULL,
  `worker` varchar(200) NOT NULL,
  `work` text NOT NULL,
  `part` text NOT NULL,
  `hour` int(4) NOT NULL,
  `km` int(8) NOT NULL,
  `wdate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `hd_tickets`
  ADD PRIMARY KEY (`tid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


