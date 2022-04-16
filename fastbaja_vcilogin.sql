-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2022 at 02:29 PM
-- Server version: 10.2.41-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastbaja_vcilogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `router` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `cargo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `customer`, `router`, `email`, `clave`, `cargo`) VALUES
(4, 'colonia soto', 'vci001', '10.100.99.11', 'coloniasoto@vci.fastbaja.com', 'c4744db4dc2cf9c3ba3d5b65eb48a1ed', '1'),
(5, 'colonia soto', 'vci001', '10.100.99.11', 'vci001', '31a367d3649d1ba01056f33e505428aa', '3'),
(6, 'colonia casitas', 'vci002', '10.100.99.12', 'vci002', '759564e24b20642886d6c7e895865227', '3'),
(7, 'colonia soledad', 'vci003', '10.100.99.13', 'vci003', 'aa394795a6d439fcae7627c1eb23681f', '3'),
(8, 'colonia huevachi', 'vci004', '10.100.99.14', 'vci004', '7456a8bd6c19606a2ecff41f636cedb8', '3'),
(9, 'colonia casitas', 'vci002', '10.100.99.12', 'casitaschihuahua@vci.fastbaja.com', 'c3aee8bb98ec318a9b031b74e4d0c29c', '1'),
(10, 'la soledad chihuahua', 'vci003', '10.100.99.13', 'lasoledadcuu@vci.fastbaja.com', '4f6b520b55971e0eacc86e29ee06fb5e', '1'),
(11, 'huevachi', 'vci004', '10.100.99.14', 'huevachicuu@vci.fastbaja.com', 'b5c4afa4bef43d38441319e665ebbc1a', '1'),
(12, 'San Juan Nepomuceno', 'vci005', '10.100.99.15', 'vci005', 'e79be4d4da2be8469e2a0977686d1c8b', '3'),
(13, 'San Juan Nepomuceno', 'vci005', '10.100.99.15', 'sjnepomucenocuu@vci.fastbaja.com', '1861839c2d7f59811bdb2aec2baa75ee', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
