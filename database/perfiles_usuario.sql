-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2022 a las 12:19:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `perfiles_usuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logistica`
--

CREATE TABLE `logistica` (
  `id` int(11) NOT NULL,
  `cantidad` int(100) DEFAULT NULL,
  `precio` int(20) NOT NULL,
  `producto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logistica`
--

INSERT INTO `logistica` (`id`, `cantidad`, `precio`, `producto`) VALUES
(1, 12, 1600000, 'Televisor Samsung 4k'),
(2, 15, 5000000, 'Celular iphone 13'),
(3, 300, 1562000, 'Audifonos Apple'),
(4, 50, 3400000, 'Portatil Azus'),
(5, 70, 750000, 'Tablet Lenovo'),
(6, 130, 130000, 'Mouse inalambrico'),
(7, 96, 345000, 'Control play 5'),
(8, 356, 3900000, 'Xbox one'),
(9, 38, 4800000, 'Play Station 5'),
(10, 49, 6000000, 'Impresora 3D'),
(11, 1285, 165000, 'Teclado inalambrico');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mainlogin`
--

CREATE TABLE `mainlogin` (
  `id` int(11) NOT NULL,
  `card` int(10) NOT NULL,
  `username` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 NOT NULL,
  `role` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `mainlogin`
--

INSERT INTO `mainlogin` (`id`, `card`, `username`, `email`, `password`, `role`) VALUES
(23, 123456, 'maria', 'maria@gmail.com', '123456', 'vendedor'),
(24, 0, 'adrian', 'adrian@gmail.com', '123456789', 'logistica'),
(26, 0, 'Andres1', 'andres1@gmail.com', 'andres1', 'admin'),
(28, 0, 'pepito', 'pepito@hotmail.com', '123456', 'admin'),
(40, 12345678, 'daaj', 'daaj@gmail.com', '123456', 'vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reingreso`
--

CREATE TABLE `reingreso` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reingreso`
--

INSERT INTO `reingreso` (`Id`, `Descripcion`) VALUES
(1, 'Devolucion'),
(2, 'Cambio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal` varchar(250) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `producto` varchar(200) DEFAULT NULL,
  `cedula_clientes` int(11) DEFAULT NULL,
  `precio` int(50) DEFAULT NULL,
  `peticion` varchar(300) DEFAULT NULL,
  `motivo` varchar(300) NOT NULL,
  `nombre_vendedor` varchar(300) DEFAULT NULL,
  `valor_total` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`Id`, `Descripcion`) VALUES
(1, 'Bogota'),
(2, 'Neiva'),
(3, 'Cali');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reingreso`
--
ALTER TABLE `reingreso`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logistica`
--
ALTER TABLE `logistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `mainlogin`
--
ALTER TABLE `mainlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `reingreso`
--
ALTER TABLE `reingreso`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
