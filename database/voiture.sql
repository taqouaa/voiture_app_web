-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 06:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personnevoiture`
--

-- --------------------------------------------------------

--
-- Table structure for table `voiture`
--

CREATE TABLE `voiture` (
  `mat` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `idp` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voiture`
--

INSERT INTO `voiture` (`mat`, `type`, `couleur`, `idp`, `image`) VALUES
('00jn', 'bmw', 'vert', 'taq', 'uploads/cc.jpg'),
('00jnh', 'bmw', 'vert', 'taq', 'uploads/cc.jpg'),
('00jnhu', 'bmw', 'vert', 'taq', 'uploads/cc.jpg'),
('011z', 'benz', 'noir', 'taq', 'uploads/ee.jpg'),
('01E', 'benz', 'noir', 'di', 'uploads/ee.jpg'),
('01E2', 'audi', 'noir', 'taq', ''),
('aaaa', 'skoda', 'noirr', 'bnmo', 'uploads/470956230_509058545521414_175608549224272724_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`mat`),
  ADD KEY `idp` (`idp`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `voiture_ibfk_1` FOREIGN KEY (`idp`) REFERENCES `personne` (`nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
