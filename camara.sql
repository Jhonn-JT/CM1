-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 16:21:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `camara`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camaras`
--

CREATE TABLE `camaras` (
  `codigo_camara` varchar(10) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `resolucion` varchar(20) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `proveedor` varchar(50) DEFAULT NULL,
  `garantia` varchar(20) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `dimensiones` varchar(20) DEFAULT NULL,
  `tipo_sensor` varchar(50) DEFAULT NULL,
  `lente_incluido` varchar(50) DEFAULT NULL,
  `tipo_almacenamiento` varchar(50) DEFAULT NULL,
  `bateria` varchar(50) DEFAULT NULL,
  `observaciones` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camaras`
--

INSERT INTO `camaras` (`codigo_camara`, `modelo`, `marca`, `precio`, `resolucion`, `tipo`, `proveedor`, `garantia`, `peso`, `dimensiones`, `tipo_sensor`, `lente_incluido`, `tipo_almacenamiento`, `bateria`, `observaciones`) VALUES
('FC001', 'EOS 5D', 'Canon', 2000.00, '30.4 MP', 'Reflex', 'Proveedor A', '2 años', 1.00, '15x10x7\r\ncm', 'Full Frame', '24-105mm', 'CompactFlash', 'LP-E6', 'Incluye correa'),
('FC002', 'Alpha 7R', 'Sony', 2500.00, '42.4 MP', 'Mirrorless', 'Proveedor B', '2 años', 0.60, '13x9x5\r\ncm', 'Full Frame', '28-70mm', 'SD Card', 'NP-FZ100', 'Incluye funda'),
('FC003', 'D850', 'Nikon', 3000.00, '45.7 MP', 'Reflex', 'Proveedor C', '2 años', 1.10, '15x11x8 cm', 'Full Frame', '24-120mm', 'XQD Card', 'EN-EL15', 'Incluye cargador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_sis`
--

CREATE TABLE `login_sis` (
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camaras`
--
ALTER TABLE `camaras`
  ADD PRIMARY KEY (`codigo_camara`);

--
-- Indices de la tabla `login_sis`
--
ALTER TABLE `login_sis`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
