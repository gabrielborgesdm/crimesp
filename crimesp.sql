-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2018 at 12:21 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `crime` (
  `id` int(11) NOT NULL,
  `descricao` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `local` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `data_crime` date NOT NULL,
  `id_criminoso` int(11) NOT NULL,
  `id_vitima` int(11) NOT NULL,
  `id_delito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `criminoso`
--

CREATE TABLE `criminoso` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `endereco` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_sentenca` int(11) NOT NULL,
  `dataExec` date DEFAULT NULL,
  `tempoCadeia` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `delito`
--

CREATE TABLE `delito` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descricao` varchar(180) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sentenca`
--

CREATE TABLE `sentenca` (
  `id` int(11) NOT NULL,
  `sentenca` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sentenca`
--

INSERT INTO `sentenca` (`id`, `sentenca`) VALUES
(1, 'Incerta'),
(2, 'Prisão'),
(3, 'Execução');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_crime`
--
CREATE TABLE `view_crime` (
`id` int(11)
,`descricao` varchar(200)
,`local` varchar(150)
,`data_crime` date
,`id_criminoso` int(11)
,`id_vitima` int(11)
,`id_delito` int(11)
,`nome_criminoso` varchar(80)
,`nome_vitima` varchar(80)
,`nome_delito` varchar(80)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_criminoso`
--
CREATE TABLE `view_criminoso` (
`id` int(11)
,`nome` varchar(80)
,`endereco` varchar(150)
,`dataNasc` date
,`sexo` char(1)
,`cpf` varchar(11)
,`id_sentenca` int(11)
,`dataExec` date
,`tempoCadeia` varchar(300)
,`sentenca` varchar(40)
);

-- --------------------------------------------------------

--
-- Table structure for table `vitima`
--

CREATE TABLE `vitima` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `endereco` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure for view `view_crime`
--
DROP TABLE IF EXISTS `view_crime`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_crime`  AS  select `crime`.`id` AS `id`,`crime`.`descricao` AS `descricao`,`crime`.`local` AS `local`,`crime`.`data_crime` AS `data_crime`,`crime`.`id_criminoso` AS `id_criminoso`,`crime`.`id_vitima` AS `id_vitima`,`crime`.`id_delito` AS `id_delito`,`criminoso`.`nome` AS `nome_criminoso`,`vitima`.`nome` AS `nome_vitima`,`delito`.`nome` AS `nome_delito` from (((`crime` join `criminoso` on((`crime`.`id_criminoso` = `criminoso`.`id`))) join `vitima` on((`crime`.`id_vitima` = `vitima`.`id`))) join `delito` on((`crime`.`id_delito` = `delito`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_criminoso`
--
DROP TABLE IF EXISTS `view_criminoso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_criminoso`  AS  select `criminoso`.`id` AS `id`,`criminoso`.`nome` AS `nome`,`criminoso`.`endereco` AS `endereco`,`criminoso`.`dataNasc` AS `dataNasc`,`criminoso`.`sexo` AS `sexo`,`criminoso`.`cpf` AS `cpf`,`criminoso`.`id_sentenca` AS `id_sentenca`,`criminoso`.`dataExec` AS `dataExec`,`criminoso`.`tempoCadeia` AS `tempoCadeia`,`sentenca`.`sentenca` AS `sentenca` from (`criminoso` join `sentenca` on((`criminoso`.`id_sentenca` = `sentenca`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_criminoso` (`id_criminoso`),
  ADD KEY `id_vitima` (`id_vitima`),
  ADD KEY `id_delito` (`id_delito`);

--
-- Indexes for table `criminoso`
--
ALTER TABLE `criminoso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delito`
--
ALTER TABLE `delito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sentenca`
--
ALTER TABLE `sentenca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vitima`
--
ALTER TABLE `vitima`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crime`
--
ALTER TABLE `crime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `criminoso`
--
ALTER TABLE `criminoso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `delito`
--
ALTER TABLE `delito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vitima`
--
ALTER TABLE `vitima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `crime`
--
ALTER TABLE `crime`
  ADD CONSTRAINT `crime_ibfk_1` FOREIGN KEY (`id_vitima`) REFERENCES `vitima` (`id`),
  ADD CONSTRAINT `crime_ibfk_2` FOREIGN KEY (`id_delito`) REFERENCES `delito` (`id`),
  ADD CONSTRAINT `crime_ibfk_3` FOREIGN KEY (`id_criminoso`) REFERENCES `criminoso` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
