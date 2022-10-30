-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-10-2022 a las 21:46:30
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
  `descripcion` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cod` varchar(3) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_nacionalidades`
--

INSERT INTO `hlp_nacionalidades` (`id`, `cod_nac`, `cod_tel`, `descripcion`, `cod`) VALUES
(1, 'VEN', '+058', 'VELEZUELA', 'V.-'),
(2, 'COL', '+044', 'COLOMBIA', 'C.-');

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
(1, 1, 'V-23445978', 'JUAN DIEGO', 'RINCON URANETA', 'jd.rincon021@gmail.com', '04146801859', 'AV LA LIMPIA CALLE 79E', '1994-12-13'),
(4, 1, 'V.-24734747', 'LUIS', 'MEDINA', 'luis@gmail.com', '0414-0000000', '                                                              ESTO ES UNA PRUEBA DE INSERCION DE DATOS                                        \r\n                                                                                              ', '2022-10-31'),
(5, 1, 'V.-24734747', 'LUIS', 'RINCON', 'luis@gmail.com', '0414-6801859', '           AV LAS DELICIAS                                        \r\n                                               ', '1997-01-16'),
(6, 1, '', 'MARCOS', 'MEDINA', 'marcos@gmail.com', '0414-6000000', '                       AV BELLA VISTA SANTA LUCIA                          \r\n                                               ', '2022-10-30');

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
(1, 'ADMINISTRADOR'),
(2, 'CLIENTE'),
(3, 'SOPORTE TECNICO');

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

--
-- Volcado de datos para la tabla `hlp_ticket`
--

INSERT INTO `hlp_ticket` (`id`, `codigo`, `titulo`, `descripcion`, `id_usuario_solicitante`, `id_usuario_soporte`, `fecha_ini`, `fecha_fin`, `id_status_fk`) VALUES
(2, '0000000002', 'SEGUNDA INSIDENCIA PARA REGIST', '                                                                                                                \r\n                                                    ESTO ES UTRA PRUEBA PRA VERIFICAR                                                                                                         ', 1, 1, '2022-10-13', '2022-10-12', 3),
(3, '0000000003', 'SEGUNDA INSIDENCIA PARA REGIST', '\r\n                                                    ESTO ES UTRA PRUEBA PRA VERIFICAR ', 1, 1, '2022-10-12', '2022-10-12', 1),
(4, '0000000004', 'SEGUNDA INSIDENCIA PARA REGIST', '\r\n                                                    ESTO ES UTRA PRUEBA PRA VERIFICAR ', 1, 1, '2022-10-12', '2022-10-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hlp_ticket_historico`
--

CREATE TABLE `hlp_ticket_historico` (
  `id` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_ticket_fk` int NOT NULL,
  `fech_modi` date NOT NULL,
  `hora_modi` time NOT NULL,
  `id_status_fk` int NOT NULL,
  `observacion` text COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_ticket_historico`
--

INSERT INTO `hlp_ticket_historico` (`id`, `username`, `id_ticket_fk`, `fech_modi`, `hora_modi`, `id_status_fk`, `observacion`) VALUES
(1, 'admin', 2, '0000-00-00', '838:59:59', 3, 'ACTUALIZACION DE INFORMACION'),
(2, 'admin', 2, '2022-10-18', '838:59:59', 3, 'PRUEBA DE INSERCION DE UNA OBSERVACION (1)                                 \r\n                                                    ');

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
  `id_rol_fk` int NOT NULL,
  `id_persona_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `hlp_usuarios`
--

INSERT INTO `hlp_usuarios` (`id`, `usuario`, `passwd`, `id_rol_fk`, `id_persona_fk`) VALUES
(1, 'admin', 'admin', 1, 1),
(3, 'LMEDINA', '1234567', 2, 4),
(6, 'LRINCON', '123456', 3, 5),
(7, 'MMEDINA', '123456', 2, 6);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hlp_personas`
--
ALTER TABLE `hlp_personas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `hlp_roles`
--
ALTER TABLE `hlp_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket`
--
ALTER TABLE `hlp_ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket_historico`
--
ALTER TABLE `hlp_ticket_historico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hlp_ticket_status`
--
ALTER TABLE `hlp_ticket_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hlp_usuarios`
--
ALTER TABLE `hlp_usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
