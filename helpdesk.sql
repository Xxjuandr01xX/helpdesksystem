-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2022 a las 03:10:54
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `helpdesk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_nacionalidades`
--

CREATE TABLE `hlp_nacionalidades` (
  `id` int NOT NULL,
  `cod_nac` varchar(3) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cod_tel` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_nacionalidades`
--

INSERT INTO `hlp_nacionalidades` (`id`, `cod_nac`, `cod_tel`, `descripcion`) VALUES
(1, 'VEN', '+058', 'VELEZUELA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_personas`
--

CREATE TABLE `hlp_personas` (
  `id` int NOT NULL,
  `id_nacionalidad_fk` int NOT NULL,
  `dni` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo` varchar(80) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `fec_nac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_personas`
--

INSERT INTO `hlp_personas` (`id`, `id_nacionalidad_fk`, `dni`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `fec_nac`) VALUES
(1, 1, 'V-23445978', 'JUAN DIEGO', 'RINCON URANETA', 'jd.rincon021@gmail.com', '04146801859', 'AV LA LIMPIA CALLE 79E', '1994-12-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_roles`
--

CREATE TABLE `hlp_roles` (
  `id` int NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_roles`
--

INSERT INTO `hlp_roles` (`id`, `descripcion`) VALUES
(1, 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_ticket`
--

CREATE TABLE `hlp_ticket` (
  `id` int NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `titulo` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_usuario_solicitante` int NOT NULL,
  `id_usuario_soporte` int NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_status_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_ticket_historico`
--

CREATE TABLE `hlp_ticket_historico` (
  `id` int NOT NULL,
  `id_ticket_fk` int NOT NULL,
  `fech_modi` date NOT NULL,
  `hora_modi` time NOT NULL,
  `id_status_fk` int NOT NULL,
  `observacion` text COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_ticket_status`
--

CREATE TABLE `hlp_ticket_status` (
  `id` int NOT NULL,
  `denominacion` varchar(20) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_ticket_status`
--

INSERT INTO `hlp_ticket_status` (`id`, `denominacion`) VALUES
(1, 'ABIERTO'),
(2, 'CERRADO'),
(3, 'RESUELTO'),
(4, 'ASIGNADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_usuarios`
--

CREATE TABLE `hlp_usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(80) COLLATE utf8mb3_spanish_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_rol_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_usuarios`
--

INSERT INTO `hlp_usuarios` (`id`, `usuario`, `passwd`, `id_rol_fk`) VALUES
(1, 'admin', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hlp_nacionalidades`
--
ALTER TABLE `hlp_nacionalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_personas`
--
ALTER TABLE `hlp_personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_roles`
--
ALTER TABLE `hlp_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_ticket`
--
ALTER TABLE `hlp_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_ticket_historico`
--
ALTER TABLE `hlp_ticket_historico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_ticket_status`
--
ALTER TABLE `hlp_ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hlp_usuarios`
--
ALTER TABLE `hlp_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hlp_nacionalidades`
--
ALTER TABLE `hlp_nacionalidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hlp_personas`
--
ALTER TABLE `hlp_personas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hlp_roles`
--
ALTER TABLE `hlp_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket`
--
ALTER TABLE `hlp_ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket_historico`
--
ALTER TABLE `hlp_ticket_historico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket_status`
--
ALTER TABLE `hlp_ticket_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hlp_usuarios`
--
ALTER TABLE `hlp_usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
