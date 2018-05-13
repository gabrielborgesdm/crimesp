-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2018 at 05:28 PM
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
  `delito` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`id`, `descricao`, `local`, `dataCrime`, `criminoso`, `vitima`, `delito`) VALUES
(1, 'AgressÃ£o envolvendo tainha vinho e ...', 'Casa dos bobos lindos', '2018-05-09', 1, 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `criminoso`
--

INSERT INTO `criminoso` (`id`, `nome`, `endereco`, `dataNasc`, `sexo`, `cpf`, `sentenca`, `dataExec`, `tempoCadeia`) VALUES
(1, 'Mateus Borges', 'Rua dos Bobos, 242, Avenida Bobona', '1860-02-05', 'M', '2147483647', 2, NULL, '{\"anos\":\"2\",\"meses\":\"2\",\"dias\":\"2\"}');

-- --------------------------------------------------------

--
-- Table structure for table `delito`
--

DROP TABLE IF EXISTS `delito`;
CREATE TABLE IF NOT EXISTS `delito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(180) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `delito`
--

INSERT INTO `delito` (`id`, `nome`, `descricao`) VALUES
(1, 'AgressÃ£o Corporal', 'AgressÃ£o com os punhos'),
(2, 'AgressÃ£o PsicolÃ³gica', 'Tainha vinho...');

-- --------------------------------------------------------

--
-- Stand-in structure for view `infocrime`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `infocrime`;
CREATE TABLE IF NOT EXISTS `infocrime` (
`criminosoNome` varchar(80)
,`vitimaNome` varchar(80)
,`delitoNome` varchar(80)
,`crimeLocal` varchar(150)
,`crimeData` date
,`crimeDescricao` varchar(200)
);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vitima`
--

INSERT INTO `vitima` (`id`, `nome`, `endereco`, `dataNasc`, `sexo`, `cpf`) VALUES
(1, 'Gabriel Lindo de Moraes', 'Rua dos lindos', '2001-02-02', 'F', '2147483647');

-- --------------------------------------------------------

--
-- Structure for view `infocrime`
--
DROP TABLE IF EXISTS `infocrime`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infocrime`  AS  select `criminoso`.`nome` AS `criminosoNome`,`vitima`.`nome` AS `vitimaNome`,`delito`.`nome` AS `delitoNome`,`crime`.`local` AS `crimeLocal`,`crime`.`dataCrime` AS `crimeData`,`crime`.`descricao` AS `crimeDescricao` from (((`crime` join `criminoso` on((`crime`.`criminoso` = `criminoso`.`id`))) join `vitima` on((`crime`.`vitima` = `vitima`.`id`))) join `delito` on((`crime`.`delito` = `delito`.`id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
