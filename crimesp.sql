-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2018 at 02:29 PM
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
-- Table structure for table `crime`
--

DROP TABLE IF EXISTS `crime`;
CREATE TABLE IF NOT EXISTS `crime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) COLLATE utf8_bin NOT NULL,
  `local` varchar(150) COLLATE utf8_bin NOT NULL,
  `dataCrime` date NOT NULL,
  `criminoso` int(11) NOT NULL,
  `vitima` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `sexo` char(1) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `sentenca` int(11) NOT NULL,
  `dataExec` date DEFAULT NULL,
  `tempoCadeia` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `delito`
--

DROP TABLE IF EXISTS `delito`;
CREATE TABLE IF NOT EXISTS `delito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(180) COLLATE utf8_bin NOT NULL,
  `sentenca` int(11) NOT NULL,
  `tempoCadeia` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vitima`
--

DROP TABLE IF EXISTS `vitima`;
CREATE TABLE IF NOT EXISTS `vitima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_bin NOT NULL,
  `endereco` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
