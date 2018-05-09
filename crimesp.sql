-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2018 at 11:01 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crimesp`
--

-- --------------------------------------------------------

--
-- Table structure for table `criminoso`
--

DROP TABLE IF EXISTS `criminoso`;
CREATE TABLE IF NOT EXISTS `criminoso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `sentenca` int(11) NOT NULL,
  `dataExec` date DEFAULT NULL,
  `tempoCadeia` int(11) DEFAULT NULL COMMENT 'Meses',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `criminoso`
--

INSERT INTO `criminoso` (`id`, `nome`, `endereco`, `dataNasc`, `cpf`, `sentenca`, `dataExec`, `tempoCadeia`) VALUES
(1, 'Joao não sei das quantas', 'Rua do Jão, casa do joão', '2001-10-17', '', 1, NULL, 12),
(2, 'Maria', NULL, '2001-02-28', '98746', 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
