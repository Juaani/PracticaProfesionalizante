-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parcial2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `roles` (
  `Id` int(11) NOT NULL,
  `Denominacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='roles de las incidencias';

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `roles` (`Id`, `Denominacion`) VALUES
(1, 'Administrador'),
(2, 'Usuario Normal'),
(3, 'Soporte Técnico'),
(4, 'Analista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar (1000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IdSolicitud` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Registro` datetime NOT NULL,
  `FechaSolicitud` datetime NOT NULL,
  `IdUsuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='incidencias que se cargan en el sistema';

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`Id`, `Titulo`, `Descripcion`,`IdSolicitud`,  `Registro`,  `FechaSolicitud`,`IdUsuario`) VALUES
(1, 'El monitor enciende, pero con brillo muy bajo', 'Al encender el equipo, el monitor enciende pero con muy poco brillo (las primeras 20 palabras)...', 3, '2023-11-01 10:23:56',  '2013-11-02 10:23:56',  2),
(2, 'Modificar lista de precios', 'Generar cálculo automático de precio segun variación del dólar.', 1, '2023-11-01 12:55:56',  '2023-11-03 12:55:56',  3),
(3,'Sin acceso a la VPN', 'Solicito me habiliten el ingreso a la red de la empresa', 3 , '2023-11-01 13:55:21',  '2023-11-02 13:55:21',  4 ),
(4,'No muestra mensaje al fallar la clave de acceso', 'En acceso al sistema debe mostrar mensaje si hay fallo en la clave.', 2 , '2023-11-02 08:25:42',  '2023-11-05 08:25:42',  5 ),
(5,'En el login, se ve mensaje', 'Al ingresar al equipo de trabajo con mi login y clave, veo error de conexion con la base de datos.', 2 , '2023-11-02 14:30:15',  '2023-11-09 14:30:15',  6 );


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `Id` int(11) NOT NULL,
  `Denominacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`Id`, `Denominacion`) VALUES
(1, 'Desarrollo de nuevas funcionalidades'),
(2, 'Reporte de errores'),
(3, 'Soporte Técnico');

-- --------------------------------------------------------


--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `IdRol` int(11) NOT NULL,
  `UltimaFechaAcceso` date NOT NULL,
  `Activo` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Apellido`,`Imagen`, `Email`, `Clave`, `IdRol`, `UltimaFechaAcceso`, `Activo`) VALUES
(1, 'Sue', 'Palacios', 'sue.png', 'sue@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2021-05-30',  1),
(2, 'Carmen', 'Ramirez','team-3.png', 'carmen@gmail.com', '202cb962ac59075b964b07152d234b70', 2, '2021-05-30',  1),
(3, 'Gisela', 'Marquez', 'team-2.png', 'gisela@gmail.com', '202cb962ac59075b964b07152d234b70', 4, '2021-05-30',  1),
(4, 'Martin', 'Cardozo', 'team-1.png', 'martin@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '2021-05-30', 1),
(5, 'Paola', 'Torres', NULL,  'paola@gmail.com', '202cb962ac59075b964b07152d234b70', 4, '2021-05-31',  1),
(6, 'Mario', 'Gimenez', NULL, 'mario@gmail.com', '202cb962ac59075b964b07152d234b70', 4, '2021-06-03', 1);


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`Id`);


-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
