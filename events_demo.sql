-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Lut 2016, 18:39
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klasa24`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdarzenia`
--

CREATE TABLE IF NOT EXISTS `zdarzenia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `allDay` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `backgroundColor` varchar(20) COLLATE cp1250_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1250 COLLATE=cp1250_polish_ci AUTO_INCREMENT=109 ;

--
-- Zrzut danych tabeli `zdarzenia`
--

INSERT INTO `zdarzenia` (`id`, `title`, `start`, `end`, `url`, `allDay`, `backgroundColor`) VALUES
(103, 'Ferie Zimowe', '2016-02-15 00:00:00', '2016-02-27 00:00:00', '', 'false', '#E7505A'),
(104, 'Wiosenna Przerwa ÅšwiÄ…teczna', '2016-03-24 00:00:00', '2016-03-30 00:00:00', '', 'false', '#E7505A'),
(106, 'WyraÅ¼enia Algebraiczne', '2016-02-02 00:00:00', '2016-02-03 00:00:00', '', 'false', '#1bbc9b'),
(107, 'Sprawdzian Europa i Mieszko', '2016-02-08 00:00:00', '2016-02-09 00:00:00', '', 'false', '#b38600'),
(108, 'Lektura', '2016-02-29 00:00:00', '2016-03-01 00:00:00', '', 'false', '#F8CB00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
