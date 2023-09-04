-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 02:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservas`
--

-- --------------------------------------------------------

--
-- Table structure for table `aerolinea`
--

CREATE TABLE `aerolinea` (
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aerolinea`
--

INSERT INTO `aerolinea` (`nombre`) VALUES
('Aerolínea A'),
('Aerolínea B'),
('Aerolínea C'),
('Aerolínea X'),
('Aerolínea Y'),
('Aerolínea Z');

-- --------------------------------------------------------

--
-- Table structure for table `aeropuerto`
--

CREATE TABLE `aeropuerto` (
  `nombre` varchar(255) NOT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aeropuerto`
--

INSERT INTO `aeropuerto` (`nombre`, `pais`, `ciudad`) VALUES
('Aeropuerto Internacional A', 'País A', 'Ciudad A'),
('Aeropuerto Internacional B', 'País B', 'Ciudad B'),
('Aeropuerto Internacional C', 'País C', 'Ciudad C');

-- --------------------------------------------------------

--
-- Table structure for table `asiento`
--

CREATE TABLE `asiento` (
  `claseAsiento` varchar(255) NOT NULL,
  `fila` varchar(255) NOT NULL,
  `letra` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asiento`
--

INSERT INTO `asiento` (`claseAsiento`, `fila`, `letra`) VALUES
('Económica', '10', 'A'),
('Económica', '10', 'B'),
('Ejecutiva', '2', 'A'),
('Ejecutiva', '2', 'B'),
('Premium', '5', 'A'),
('Premium', '5', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `avion`
--

CREATE TABLE `avion` (
  `identificacion` int(11) NOT NULL,
  `fabricante` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `capacidadPasajeros` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avion`
--

INSERT INTO `avion` (`identificacion`, `fabricante`, `modelo`, `capacidadPasajeros`) VALUES
(1, 'Boeing', '737', 180),
(2, 'Airbus', 'A320', 160),
(3, 'Boeing', '787', 250);

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horario`
--

INSERT INTO `horario` (`fecha`, `hora`) VALUES
('2023-08-01', '08:00:00'),
('2023-08-01', '12:00:00'),
('2023-08-02', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pasajero`
--

CREATE TABLE `pasajero` (
  `identificacion` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `codigoPostal` int(11) DEFAULT NULL,
  `numeroTelefonico` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasajero`
--

INSERT INTO `pasajero` (`identificacion`, `usuario`, `contrasena`, `nombre`, `pais`, `ciudad`, `direccion`, `codigoPostal`, `numeroTelefonico`, `email`) VALUES
(1000163023, 'admin', '$2y$10$42.xI/YdNleqOmYt6J2pzefthtHPu6BWk.BVHXfjqtOC3PHt2af2u', 'andres', 'colombia', 'bogota', 'cl 65', 11654, 2147483647, 'anfevo01@gmail.com'),
(2147483647, 'anfevo01', '$2y$10$vn5f24v/soCbWgm2HGR4ges8VCSU6db.O0bh81E4bjy9rvwBXxCfO', 'andres', 'colombia', 'bogota', 'cll 65', 1324154, 2147483647, 'anfevo01@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `codigoReserva` varchar(255) NOT NULL,
  `vueloNumero` varchar(255) DEFAULT NULL,
  `pasajeroIdentificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`codigoReserva`, `vueloNumero`, `pasajeroIdentificacion`) VALUES
('', 'V001', 1000163023);

-- --------------------------------------------------------

--
-- Table structure for table `tarifa`
--

CREATE TABLE `tarifa` (
  `claseAsiento` varchar(255) NOT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarifa`
--

INSERT INTO `tarifa` (`claseAsiento`, `precio`) VALUES
('Económica', 100),
('Premium', 150),
('Primera Clase', 300);

-- --------------------------------------------------------

--
-- Table structure for table `tarjeta`
--

CREATE TABLE `tarjeta` (
  `numero` int(11) NOT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `empresaTarjeta` varchar(255) DEFAULT NULL,
  `pasajeroIdentificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarjeta`
--

INSERT INTO `tarjeta` (`numero`, `fechaVencimiento`, `nombre`, `empresaTarjeta`, `pasajeroIdentificacion`) VALUES
(1000163023, '2023-08-19', 'andres', 'visa', 1000163023);

-- --------------------------------------------------------

--
-- Table structure for table `vuelo`
--

CREATE TABLE `vuelo` (
  `numero` varchar(255) NOT NULL,
  `aerolineaNombre` varchar(255) DEFAULT NULL,
  `aeropuertoOrigen` varchar(255) DEFAULT NULL,
  `aeropuertoDestino` varchar(255) DEFAULT NULL,
  `fechaLlegada` date DEFAULT NULL,
  `fechaSalida` date DEFAULT NULL,
  `avionIdentificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vuelo`
--

INSERT INTO `vuelo` (`numero`, `aerolineaNombre`, `aeropuertoOrigen`, `aeropuertoDestino`, `fechaLlegada`, `fechaSalida`, `avionIdentificacion`) VALUES
('V001', 'Aerolínea X', 'Aeropuerto Internacional A', 'Aeropuerto Internacional B', '2023-08-01', '2023-08-01', 1),
('V002', 'Aerolínea Y', 'Aeropuerto Internacional B', 'Aeropuerto Internacional C', '2023-08-02', '2023-08-02', 2),
('V003', 'Aerolínea Z', 'Aeropuerto Internacional C', 'Aeropuerto Internacional A', '2023-08-01', '2023-08-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vueloaerolinea`
--

CREATE TABLE `vueloaerolinea` (
  `id` int(11) NOT NULL,
  `vueloNumero` varchar(255) DEFAULT NULL,
  `aerolineaNombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vueloaerolinea`
--

INSERT INTO `vueloaerolinea` (`id`, `vueloNumero`, `aerolineaNombre`) VALUES
(5, 'V001', 'Aerolínea X'),
(6, 'V002', 'Aerolínea Y'),
(7, 'V003', 'Aerolínea Z');

-- --------------------------------------------------------

--
-- Table structure for table `vuelotarifa`
--

CREATE TABLE `vuelotarifa` (
  `id` int(11) NOT NULL,
  `vueloNumero` varchar(255) DEFAULT NULL,
  `tarifaClaseAsiento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vuelotarifa`
--

INSERT INTO `vuelotarifa` (`id`, `vueloNumero`, `tarifaClaseAsiento`) VALUES
(9, 'V001', 'Económica'),
(10, 'V001', 'Premium'),
(11, 'V002', 'Primera Clase');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aerolinea`
--
ALTER TABLE `aerolinea`
  ADD PRIMARY KEY (`nombre`);

--
-- Indexes for table `aeropuerto`
--
ALTER TABLE `aeropuerto`
  ADD PRIMARY KEY (`nombre`);

--
-- Indexes for table `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`claseAsiento`,`fila`,`letra`);

--
-- Indexes for table `avion`
--
ALTER TABLE `avion`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`fecha`,`hora`);

--
-- Indexes for table `pasajero`
--
ALTER TABLE `pasajero`
  ADD PRIMARY KEY (`identificacion`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`codigoReserva`),
  ADD KEY `vueloNumero` (`vueloNumero`),
  ADD KEY `pasajeroIdentificacion` (`pasajeroIdentificacion`);

--
-- Indexes for table `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`claseAsiento`);

--
-- Indexes for table `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `pasajeroIdentificacion` (`pasajeroIdentificacion`);

--
-- Indexes for table `vuelo`
--
ALTER TABLE `vuelo`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `aerolineaNombre` (`aerolineaNombre`),
  ADD KEY `aeropuertoOrigen` (`aeropuertoOrigen`),
  ADD KEY `aeropuertoDestino` (`aeropuertoDestino`),
  ADD KEY `fechaLlegada` (`fechaLlegada`),
  ADD KEY `fechaSalida` (`fechaSalida`),
  ADD KEY `avionIdentificacion` (`avionIdentificacion`);

--
-- Indexes for table `vueloaerolinea`
--
ALTER TABLE `vueloaerolinea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vueloNumero` (`vueloNumero`),
  ADD KEY `aerolineaNombre` (`aerolineaNombre`);

--
-- Indexes for table `vuelotarifa`
--
ALTER TABLE `vuelotarifa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vueloNumero` (`vueloNumero`),
  ADD KEY `tarifaClaseAsiento` (`tarifaClaseAsiento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vueloaerolinea`
--
ALTER TABLE `vueloaerolinea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vuelotarifa`
--
ALTER TABLE `vuelotarifa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`vueloNumero`) REFERENCES `vuelo` (`numero`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`pasajeroIdentificacion`) REFERENCES `pasajero` (`identificacion`);

--
-- Constraints for table `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`pasajeroIdentificacion`) REFERENCES `pasajero` (`identificacion`);

--
-- Constraints for table `vuelo`
--
ALTER TABLE `vuelo`
  ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`aerolineaNombre`) REFERENCES `aerolinea` (`nombre`),
  ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`aeropuertoOrigen`) REFERENCES `aeropuerto` (`nombre`),
  ADD CONSTRAINT `vuelo_ibfk_3` FOREIGN KEY (`aeropuertoDestino`) REFERENCES `aeropuerto` (`nombre`),
  ADD CONSTRAINT `vuelo_ibfk_4` FOREIGN KEY (`fechaLlegada`) REFERENCES `horario` (`fecha`),
  ADD CONSTRAINT `vuelo_ibfk_5` FOREIGN KEY (`fechaSalida`) REFERENCES `horario` (`fecha`),
  ADD CONSTRAINT `vuelo_ibfk_6` FOREIGN KEY (`avionIdentificacion`) REFERENCES `avion` (`identificacion`);

--
-- Constraints for table `vueloaerolinea`
--
ALTER TABLE `vueloaerolinea`
  ADD CONSTRAINT `vueloaerolinea_ibfk_1` FOREIGN KEY (`vueloNumero`) REFERENCES `vuelo` (`numero`),
  ADD CONSTRAINT `vueloaerolinea_ibfk_2` FOREIGN KEY (`aerolineaNombre`) REFERENCES `aerolinea` (`nombre`);

--
-- Constraints for table `vuelotarifa`
--
ALTER TABLE `vuelotarifa`
  ADD CONSTRAINT `vuelotarifa_ibfk_1` FOREIGN KEY (`vueloNumero`) REFERENCES `vuelo` (`numero`),
  ADD CONSTRAINT `vuelotarifa_ibfk_2` FOREIGN KEY (`tarifaClaseAsiento`) REFERENCES `tarifa` (`claseAsiento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
