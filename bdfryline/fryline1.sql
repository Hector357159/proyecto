-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2020 a las 16:46:37
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fryline1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `id_reserva`
--

CREATE TABLE `id_reserva` (
  `ID_reserva` int(11) NOT NULL,
  `ID_boleto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `DsalidaV` varchar(100) NOT NULL,
  `DllegadaV` varchar(100) NOT NULL,
  `Psalida` varchar(200) NOT NULL,
  `Pentrada` varchar(200) NOT NULL,
  `Nvuelo` int(30) NOT NULL,
  `Presio` varchar(30) NOT NULL,
  `DateNewRow` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `id_reserva`
--

INSERT INTO `id_reserva` (`ID_reserva`, `ID_boleto`, `id_usuario`, `DsalidaV`, `DllegadaV`, `Psalida`, `Pentrada`, `Nvuelo`, `Presio`, `DateNewRow`) VALUES
(1, 1, 43, '08/26/2020', '08/27/2020', 'El salvador  ', 'Costa Rica', 8888, '$215.16', '0000-00-00 00:00:00'),
(2, 7, 43, '08/22/2020', '08/27/2020', 'El salvador  ', 'Costa Rica', 8456, '$582.36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbboleto`
--

CREATE TABLE `tbboleto` (
  `ID_boleto` int(10) NOT NULL,
  `DsalidaV` varchar(100) NOT NULL,
  `DllegadaV` varchar(100) NOT NULL,
  `Psalida` varchar(200) NOT NULL,
  `Pentrada` varchar(200) NOT NULL,
  `Hsalida` varchar(100) NOT NULL,
  `Hentrada` varchar(100) NOT NULL,
  `Tiempo` varchar(100) NOT NULL,
  `Presio` varchar(30) NOT NULL,
  `Aerolinia` varchar(200) NOT NULL,
  `Nvuelo` int(100) NOT NULL,
  `reserva` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbboleto`
--

INSERT INTO `tbboleto` (`ID_boleto`, `DsalidaV`, `DllegadaV`, `Psalida`, `Pentrada`, `Hsalida`, `Hentrada`, `Tiempo`, `Presio`, `Aerolinia`, `Nvuelo`, `reserva`) VALUES
(1, '08/26/2020', '08/27/2020', 'El salvador ', 'Nicaragua', '01:05', '13:06', '1', '$215.16', 'avianca ', 8888, 'SI'),
(2, '08/26/2020', '08/28/2020', 'El salvador ', 'Nicaragua', '09:55', '09:55', '1', '$151.65', 'avianca ', 1559, 'NO'),
(3, '', '', 'El Salvador ', 'Brasil', '12:00', '05:00', '5 horas', '$500.00', 'BHT line', 2986, 'NO'),
(4, '08/29/2020', '09/04/2020', 'El Salvador  ', 'Panama', '18:43', '20:45', '2', '$100.00', 'Delta ', 7894, 'NO'),
(5, '', '', 'El Salvador  ', 'EspaÃ±a', '19:00', '02:00', '7 horas', '$200.00', 'Ter stegen airline ', 98, 'NO'),
(6, '09/24/2020', '10/22/2020', 'El Salvador  ', 'Argentina ', '01:53', '13:47', '5', '$120.00', 'Volaris ', 7539, 'NO'),
(7, '08/22/2020', '08/27/2020', 'El salvador ', 'El salvador', '02:09', '08:08', '8', '$582.36', 'avianca ', 8456, 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdatosdeescala`
--

CREATE TABLE `tbdatosdeescala` (
  `ID_boleto` int(11) NOT NULL,
  `Nescala` int(20) NOT NULL,
  `DsalidaV` date NOT NULL,
  `Dllegadav` date NOT NULL,
  `Lsalida` varchar(50) NOT NULL,
  `Lentrada` varchar(50) NOT NULL,
  `Hsalida` datetime NOT NULL,
  `Hentrada` datetime NOT NULL,
  `Tiempo` time NOT NULL,
  `presio` decimal(30,0) NOT NULL,
  `Aerolinia` varchar(100) NOT NULL,
  `Nbuelo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbescala`
--

CREATE TABLE `tbescala` (
  `ID_boleto` int(11) NOT NULL,
  `DsalidaV` date NOT NULL,
  `DllegadaV` date NOT NULL,
  `Lsalida` varchar(100) NOT NULL,
  `Lentrada` varchar(100) NOT NULL,
  `Hsalida` varchar(100) NOT NULL,
  `Hentrada` varchar(100) NOT NULL,
  `Tiempo` varchar(100) NOT NULL,
  `precio` varchar(30) NOT NULL,
  `Aerolinia` varchar(100) NOT NULL,
  `Nbuelo` int(4) NOT NULL,
  `reserva` varchar(10) NOT NULL,
  `TBESCALA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbescala`
--

INSERT INTO `tbescala` (`ID_boleto`, `DsalidaV`, `DllegadaV`, `Lsalida`, `Lentrada`, `Hsalida`, `Hentrada`, `Tiempo`, `precio`, `Aerolinia`, `Nbuelo`, `reserva`, `TBESCALA`) VALUES
(1, '2020-08-28', '2020-08-29', 'El salvador ', 'Costa Rica', '13:06', '15:06', '6', '$215.16', 'avianca', 8646, 'SI', 0),
(2, '2020-08-22', '2020-08-23', 'El salvador ', 'Costa Rica', '09:55', '09:55', '6', '$151.65', 'avianca', 5165, 'NO', 0),
(3, '2021-07-12', '2021-07-13', 'El Salvador  ', 'Brasil', '02:00', '17:00', '3 horas', '$500.00', 'BHT line', 7640, 'NO', 0),
(4, '2020-08-08', '2020-09-24', 'El salvador  ', 'Guatemala ', '18:43', '17:01', '1', '$100.00', 'Delta', 7894, 'NO', 0),
(5, '2021-09-07', '2021-09-08', 'El Salvador  ', 'EspaÃ±a', '23:00', '14:00', '3 horas', '$200.00', 'Ter stegen airline', 9872, 'NO', 0),
(6, '2020-09-24', '2020-10-22', 'El salvador  ', 'Argentina ', '13:52', '22:55', '5', '$120.00', 'Volaris', 7539, 'NO', 0),
(7, '2020-08-28', '2020-08-29', 'El salvador ', 'Costa Rica', '15:10', '03:10', '6', '$582.36', 'avianca', 8564, 'SI', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbescala2`
--

CREATE TABLE `tbescala2` (
  `ID_boleto` int(11) NOT NULL,
  `Nescala` int(10) NOT NULL,
  `DsalidaV` date NOT NULL,
  `DllegadaV` date NOT NULL,
  `Lsalida` varchar(100) NOT NULL,
  `Lentrada` varchar(100) NOT NULL,
  `Hsalida` datetime NOT NULL,
  `Hentrada` datetime NOT NULL,
  `Tiempo` datetime NOT NULL,
  `precio` decimal(30,0) NOT NULL,
  `Aerolinia` varchar(100) NOT NULL,
  `Nbuelo` int(4) NOT NULL,
  `ID_bescala` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbescala3`
--

CREATE TABLE `tbescala3` (
  `ID_boleto` int(11) NOT NULL,
  `Nescala` int(10) NOT NULL,
  `DsalidaV` varchar(100) NOT NULL,
  `DllegadaV` varchar(100) NOT NULL,
  `Lsalida` varchar(100) NOT NULL,
  `Lentrada` varchar(100) NOT NULL,
  `Hsalida` varchar(100) NOT NULL,
  `Hentrada` varchar(100) NOT NULL,
  `Tiempo` int(20) NOT NULL,
  `presio` int(20) NOT NULL,
  `Aerolinia` varchar(100) NOT NULL,
  `Nbuelo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_usuario` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` int(2) NOT NULL,
  `gmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_usuario`, `user`, `password`, `type`, `gmail`) VALUES
(6, '456', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, 'hec@gmail.com'),
(19, 'Hector Gerardo', 'd9e6762dd1c8eaf6d61b3c6192fc408d4d6d5f1176d0c29169bc24e71c3f274ad27fcd5811b313d681f7e55ec02d73d499c95455b6b5bb503acf574fba8ffe85', 0, 'hec@gmail.com'),
(43, '123', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '123@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `id_reserva`
--
ALTER TABLE `id_reserva`
  ADD PRIMARY KEY (`ID_reserva`),
  ADD KEY `F-K id_reserva` (`id_usuario`),
  ADD KEY `F-k id_boleto` (`ID_boleto`);

--
-- Indices de la tabla `tbboleto`
--
ALTER TABLE `tbboleto`
  ADD PRIMARY KEY (`ID_boleto`);

--
-- Indices de la tabla `tbdatosdeescala`
--
ALTER TABLE `tbdatosdeescala`
  ADD UNIQUE KEY `ID_boleto` (`ID_boleto`);

--
-- Indices de la tabla `tbescala`
--
ALTER TABLE `tbescala`
  ADD UNIQUE KEY `ID_boleto` (`ID_boleto`);

--
-- Indices de la tabla `tbescala2`
--
ALTER TABLE `tbescala2`
  ADD PRIMARY KEY (`ID_boleto`);

--
-- Indices de la tabla `tbescala3`
--
ALTER TABLE `tbescala3`
  ADD PRIMARY KEY (`ID_boleto`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `id_reserva`
--
ALTER TABLE `id_reserva`
  MODIFY `ID_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbboleto`
--
ALTER TABLE `tbboleto`
  MODIFY `ID_boleto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbescala`
--
ALTER TABLE `tbescala`
  MODIFY `ID_boleto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbescala2`
--
ALTER TABLE `tbescala2`
  MODIFY `ID_boleto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbescala3`
--
ALTER TABLE `tbescala3`
  MODIFY `ID_boleto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `id_reserva`
--
ALTER TABLE `id_reserva`
  ADD CONSTRAINT `ID_boleto` FOREIGN KEY (`ID_boleto`) REFERENCES `tbboleto` (`ID_boleto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_reserva_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbescala`
--
ALTER TABLE `tbescala`
  ADD CONSTRAINT `tbescala_ibfk_1` FOREIGN KEY (`ID_boleto`) REFERENCES `tbboleto` (`ID_boleto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
