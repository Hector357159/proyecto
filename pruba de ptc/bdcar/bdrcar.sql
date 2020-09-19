-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2019 a las 18:45:02
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdrcar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbalquiler`
--

CREATE TABLE `tbalquiler` (
  `ID_Alquiler` int(9) NOT NULL,
  `ID_Usuario` int(9) NOT NULL,
  `ID_Vehiculo` int(9) NOT NULL,
  `Freserva` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Fentrega` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Fpago` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `Total` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `Tpago` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `DateNewRow` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcuentas`
--

CREATE TABLE `tbcuentas` (
  `ID_Cuenta` int(9) NOT NULL,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `TCuenta` int(2) NOT NULL,
  `DateNewRow` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdatosecundario`
--

CREATE TABLE `tbdatosecundario` (
  `ID_Dsecundario` int(9) NOT NULL,
  `ID_Vehiculo` int(9) NOT NULL,
  `Año` int(4) NOT NULL,
  `Color` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Puertas` int(3) NOT NULL,
  `Descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdatospago`
--

CREATE TABLE `tbdatospago` (
  `ID_DatosPago` int(9) NOT NULL,
  `ID_Usuario` int(9) NOT NULL,
  `Tarjeta` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `FechaVencimiento` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `CVV` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `NoCuenta` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdepartamento`
--

CREATE TABLE `tbdepartamento` (
  `ID_Departamento` int(9) NOT NULL,
  `Departamento` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetallealquiler`
--

CREATE TABLE `tbdetallealquiler` (
  `ID_DetalleAlquiler` int(9) NOT NULL,
  `ID_Alquiler` int(9) NOT NULL,
  `SubTotal` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `Impuestos` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `Dservicio` varchar(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmunicipio`
--

CREATE TABLE `tbmunicipio` (
  `ID_Municipio` int(9) NOT NULL,
  `ID_Departamento` int(9) NOT NULL,
  `Municipio` varchar(25) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpago`
--

CREATE TABLE `tbpago` (
  `ID_Pago` int(9) NOT NULL,
  `Recibo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `NoCuenta` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `CantidadL` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ID_Usuario` int(9) NOT NULL,
  `DateNewRow` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `ID_Usuario` int(9) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `numeroIdentidad` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `licencia` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `Tlicencia` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(19) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `ID_Departamento` int(9) NOT NULL,
  `ID_Municipio` int(9) NOT NULL,
  `FechaNac` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `DateNewRow` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbvehiculo`
--

CREATE TABLE `tbvehiculo` (
  `ID_Vehiculo` int(9) NOT NULL,
  `ID_Usuario` int(9) NOT NULL,
  `Matricula` varchar(10) COLLATE utf32_spanish_ci NOT NULL,
  `rkm` int(5) NOT NULL,
  `rmi` int(5) NOT NULL,
  `Rendimiento` int(3) NOT NULL,
  `Tcombustible` varchar(10) COLLATE utf32_spanish_ci NOT NULL,
  `Tmotor` varchar(12) COLLATE utf32_spanish_ci NOT NULL,
  `Tvehiculo` varchar(20) COLLATE utf32_spanish_ci NOT NULL,
  `Poliza` varchar(3) COLLATE utf32_spanish_ci NOT NULL,
  `Modelo` varchar(20) COLLATE utf32_spanish_ci NOT NULL,
  `Marca` varchar(20) COLLATE utf32_spanish_ci NOT NULL,
  `Tlimite` varchar(10) COLLATE utf32_spanish_ci NOT NULL,
  `Disponible` varchar(2) COLLATE utf32_spanish_ci NOT NULL,
  `DateNewRow` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbalquiler`
--
ALTER TABLE `tbalquiler`
  ADD PRIMARY KEY (`ID_Alquiler`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Vehiculo` (`ID_Vehiculo`);

--
-- Indices de la tabla `tbcuentas`
--
ALTER TABLE `tbcuentas`
  ADD PRIMARY KEY (`ID_Cuenta`);

--
-- Indices de la tabla `tbdatosecundario`
--
ALTER TABLE `tbdatosecundario`
  ADD PRIMARY KEY (`ID_Dsecundario`),
  ADD KEY `ID_Vehiculo` (`ID_Vehiculo`);

--
-- Indices de la tabla `tbdatospago`
--
ALTER TABLE `tbdatospago`
  ADD PRIMARY KEY (`ID_DatosPago`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `tbdepartamento`
--
ALTER TABLE `tbdepartamento`
  ADD PRIMARY KEY (`ID_Departamento`);

--
-- Indices de la tabla `tbdetallealquiler`
--
ALTER TABLE `tbdetallealquiler`
  ADD PRIMARY KEY (`ID_DetalleAlquiler`),
  ADD KEY `ID_Alquiler` (`ID_Alquiler`);

--
-- Indices de la tabla `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  ADD PRIMARY KEY (`ID_Municipio`),
  ADD KEY `ID_Departamento` (`ID_Departamento`);

--
-- Indices de la tabla `tbpago`
--
ALTER TABLE `tbpago`
  ADD PRIMARY KEY (`ID_Pago`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `ID_Departamento` (`ID_Departamento`),
  ADD KEY `ID_Municipio` (`ID_Municipio`);

--
-- Indices de la tabla `tbvehiculo`
--
ALTER TABLE `tbvehiculo`
  ADD PRIMARY KEY (`ID_Vehiculo`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbalquiler`
--
ALTER TABLE `tbalquiler`
  MODIFY `ID_Alquiler` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbcuentas`
--
ALTER TABLE `tbcuentas`
  MODIFY `ID_Cuenta` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbdatosecundario`
--
ALTER TABLE `tbdatosecundario`
  MODIFY `ID_Dsecundario` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbdatospago`
--
ALTER TABLE `tbdatospago`
  MODIFY `ID_DatosPago` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbdepartamento`
--
ALTER TABLE `tbdepartamento`
  MODIFY `ID_Departamento` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbdetallealquiler`
--
ALTER TABLE `tbdetallealquiler`
  MODIFY `ID_DetalleAlquiler` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  MODIFY `ID_Municipio` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbpago`
--
ALTER TABLE `tbpago`
  MODIFY `ID_Pago` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `ID_Usuario` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbvehiculo`
--
ALTER TABLE `tbvehiculo`
  MODIFY `ID_Vehiculo` int(9) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbalquiler`
--
ALTER TABLE `tbalquiler`
  ADD CONSTRAINT `tbalquiler_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbusuarios` (`ID_Usuario`),
  ADD CONSTRAINT `tbalquiler_ibfk_2` FOREIGN KEY (`ID_Vehiculo`) REFERENCES `tbvehiculo` (`ID_Vehiculo`);

--
-- Filtros para la tabla `tbdatosecundario`
--
ALTER TABLE `tbdatosecundario`
  ADD CONSTRAINT `tbdatosecundario_ibfk_1` FOREIGN KEY (`ID_Vehiculo`) REFERENCES `tbvehiculo` (`ID_Vehiculo`);

--
-- Filtros para la tabla `tbdatospago`
--
ALTER TABLE `tbdatospago`
  ADD CONSTRAINT `tbdatospago_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbusuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `tbdetallealquiler`
--
ALTER TABLE `tbdetallealquiler`
  ADD CONSTRAINT `tbdetallealquiler_ibfk_1` FOREIGN KEY (`ID_Alquiler`) REFERENCES `tbalquiler` (`ID_Alquiler`);

--
-- Filtros para la tabla `tbmunicipio`
--
ALTER TABLE `tbmunicipio`
  ADD CONSTRAINT `tbmunicipio_ibfk_1` FOREIGN KEY (`ID_Departamento`) REFERENCES `tbdepartamento` (`ID_Departamento`);

--
-- Filtros para la tabla `tbpago`
--
ALTER TABLE `tbpago`
  ADD CONSTRAINT `tbpago_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbusuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD CONSTRAINT `tbusuarios_ibfk_1` FOREIGN KEY (`ID_Departamento`) REFERENCES `tbdepartamento` (`ID_Departamento`),
  ADD CONSTRAINT `tbusuarios_ibfk_2` FOREIGN KEY (`ID_Municipio`) REFERENCES `tbmunicipio` (`ID_Municipio`);

--
-- Filtros para la tabla `tbvehiculo`
--
ALTER TABLE `tbvehiculo`
  ADD CONSTRAINT `tbvehiculo_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `tbusuarios` (`ID_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
