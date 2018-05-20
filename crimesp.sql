-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2018 at 01:24 AM
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
(1, 'Briga de bebados.', 'Bar do Zeca', '2018-05-18', 3, 2, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `criminoso`
--

INSERT INTO `criminoso` (`id`, `nome`, `endereco`, `dataNasc`, `sexo`, `cpf`, `sentenca`, `dataExec`, `tempoCadeia`) VALUES
(1, 'Zeca Pilantrinha', 'Rua dos Loucos Magos, 327, Araraquara', '1988-03-02', 'M', '13214519698', 2, NULL, '{\"anos\":\"1\",\"dias\":\"2\"}'),
(2, 'Maria Vai e Volta', 'Avenida Dos que não foram, 1003, São Carlos', '1994-10-09', 'F', '3225698655', 2, NULL, '{\"meses\":\"12\"}'),
(3, 'Mané Brabinho da Silva', NULL, '1967-11-05', 'M', NULL, 1, NULL, NULL),
(4, 'Joana do Escuro', NULL, '1999-05-14', 'F', '16917825489', 3, '2018-05-31', NULL);

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
(1, 'Agressão Corporal', 'Agressão  física-corporal'),
(2, 'Assalto a mão armada', 'Assalto com a mão armada');

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
-- Stand-in structure for view `infocriminoso`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `infocriminoso`;
CREATE TABLE IF NOT EXISTS `infocriminoso` (
`id` int(11)
,`nome` varchar(80)
,`endereco` varchar(150)
,`dataNasc` date
,`sexo` char(1)
,`cpf` varchar(11)
,`sentenca` varchar(40)
,`dataExec` date
,`tempoCadeia` varchar(300)
);

-- --------------------------------------------------------

--
-- Table structure for table `sentenca`
--

DROP TABLE IF EXISTS `sentenca`;
CREATE TABLE IF NOT EXISTS `sentenca` (
  `id` int(11) NOT NULL,
  `sentenca` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sentenca`
--

INSERT INTO `sentenca` (`id`, `sentenca`) VALUES
(1, 'Incerta'),
(2, 'Prisão'),
(3, 'Execução');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vitima`
--

INSERT INTO `vitima` (`id`, `nome`, `endereco`, `dataNasc`, `sexo`, `cpf`) VALUES
(1, 'Jão Vitiminha da Silva', 'Rua dos Comadres, 753, São Paulo', '2001-02-03', 'M', '16814716889'),
(2, 'Madalena Maria e Silva', 'Avenida Padre de Não das quantas, 255, Araraquara', '1979-03-30', 'F', '1641788995');

-- --------------------------------------------------------

--
-- Structure for view `infocrime`
--
DROP TABLE IF EXISTS `infocrime`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infocrime`  AS  select `criminoso`.`nome` AS `criminosoNome`,`vitima`.`nome` AS `vitimaNome`,`delito`.`nome` AS `delitoNome`,`crime`.`local` AS `crimeLocal`,`crime`.`dataCrime` AS `crimeData`,`crime`.`descricao` AS `crimeDescricao` from (((`crime` join `criminoso` on((`crime`.`criminoso` = `criminoso`.`id`))) join `vitima` on((`crime`.`vitima` = `vitima`.`id`))) join `delito` on((`crime`.`delito` = `delito`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `infocriminoso`
--
DROP TABLE IF EXISTS `infocriminoso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `infocriminoso`  AS  select `criminoso`.`id` AS `id`,`criminoso`.`nome` AS `nome`,`criminoso`.`endereco` AS `endereco`,`criminoso`.`dataNasc` AS `dataNasc`,`criminoso`.`sexo` AS `sexo`,`criminoso`.`cpf` AS `cpf`,`sentenca`.`sentenca` AS `sentenca`,`criminoso`.`dataExec` AS `dataExec`,`criminoso`.`tempoCadeia` AS `tempoCadeia` from (`criminoso` join `sentenca` on((`criminoso`.`sentenca` = `sentenca`.`id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
