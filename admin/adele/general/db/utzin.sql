-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2025 a las 05:16:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `utzin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id_acceso` int(11) NOT NULL,
  `id_usuario` int(9) DEFAULT NULL,
  `id_aplicacion` int(9) DEFAULT NULL,
  `fecha_expiracion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id_acceso`, `id_usuario`, `id_aplicacion`, `fecha_expiracion`) VALUES
(2, 2, 1, '3000-01-01'),
(3, 2, 10, '3000-01-01'),
(4, 2, 4, '3000-01-01'),
(5, 2, 2, '2025-04-30'),
(6, 2, 11, '2025-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE `aplicacion` (
  `id_aplicacion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `categoria` int(3) NOT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aplicacion`
--

INSERT INTO `aplicacion` (`id_aplicacion`, `nombre`, `icono`, `url`, `categoria`, `estado`) VALUES
(1, 'Mi perfil', NULL, 'perfil', 1, 1),
(2, 'Mis Materias', NULL, 'materia', 1, 1),
(4, 'Documentos', NULL, 'documentos', 1, 1),
(10, 'Administrador', NULL, 'admin', 2, 1),
(11, 'Configuración', NULL, 'configura', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `mp_lista` int(9) DEFAULT NULL,
  `id_alumno` int(9) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `carrera` varchar(100) DEFAULT NULL,
  `siglas` varchar(10) DEFAULT NULL,
  `duracion` int(2) DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `carrera`, `siglas`, `duracion`, `tipo`, `estado`) VALUES
(1, 'T.S.U. en ENTORNOS VIRTUALES Y NEGOCIOS DIGITALES', 'EVN', 6, 1, 2),
(2, 'T.S.U en DESARROLLO DE SOFTWARE MULTIPLATAFORMA', 'DSM', 6, 1, 2),
(3, 'T.S.U en INTERCONEXIÓN DE REDES\r\n', 'RED', 6, 1, 2),
(4, 'ING. en ENTORNOS VIRTUALES Y NEGOCIOS DIGITALES', 'EVN', 5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `materia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `materia`) VALUES
(1, 'Sistemas Operativos'),
(2, 'Programación Estructurada'),
(3, 'Base de datos para negocios digitales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_carrera`
--

CREATE TABLE `materia_carrera` (
  `id_mc` int(11) NOT NULL,
  `id_materia` int(9) DEFAULT NULL,
  `id_carrera` int(9) DEFAULT NULL,
  `cuatrimestre` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia_carrera`
--

INSERT INTO `materia_carrera` (`id_mc`, `id_materia`, `id_carrera`, `cuatrimestre`) VALUES
(2, 1, 1, 2),
(3, 1, 2, 2),
(4, 2, 3, 2),
(5, 3, 4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_profesor`
--

CREATE TABLE `materia_profesor` (
  `id_mp` int(11) NOT NULL,
  `id_materia` int(9) DEFAULT NULL,
  `id_profesor` int(9) DEFAULT NULL,
  `id_pa` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia_profesor`
--

INSERT INTO `materia_profesor` (`id_mp`, `id_materia`, `id_profesor`, `id_pa`) VALUES
(3, 1, 2, 1),
(4, 2, 2, 1),
(5, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `nombre`) VALUES
(1, 'Enero - Abril'),
(2, 'Mayo - Agosto'),
(3, 'Septiembre - Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_anio`
--

CREATE TABLE `periodo_anio` (
  `id_pa` int(11) NOT NULL,
  `id_periodo` int(9) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `fi` date DEFAULT NULL,
  `ff` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo_anio`
--

INSERT INTO `periodo_anio` (`id_pa`, `id_periodo`, `anio`, `fi`, `ff`, `estado`) VALUES
(1, 1, 2025, '2025-01-07', '2025-04-25', 1),
(2, 2, 2025, '2025-05-01', '2025-08-31', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_inicio`
--

CREATE TABLE `periodo_inicio` (
  `id_pi` int(11) NOT NULL,
  `cuatri` int(1) DEFAULT NULL,
  `id_periodo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodo_inicio`
--

INSERT INTO `periodo_inicio` (`id_pi`, `cuatri`, `id_periodo`) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `id_telefono` int(11) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `id_usuario` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`id_telefono`, `numero`, `id_usuario`) VALUES
(2, '7202874706', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ap` varchar(100) DEFAULT NULL,
  `am` varchar(100) DEFAULT NULL,
  `fn` date DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `clave` varchar(300) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `ap`, `am`, `fn`, `correo`, `clave`, `estado`) VALUES
(2, 'Alfredo Tomás', 'Dorado', 'Flores', NULL, 'alfredo.dorado@utzin.edu.mx', '$2y$10$.C/F1Lora2QXYN.OCaO.7eeiKJ6EHSoDBUEepj8TV3I8JrU6UCwKy', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_estudios`
--

CREATE TABLE `usuario_estudios` (
  `id_us_est` int(11) NOT NULL,
  `acronimo` varchar(15) DEFAULT NULL,
  `carrera` varchar(50) DEFAULT NULL,
  `nivel` int(1) DEFAULT NULL,
  `id_usuario` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_estudios`
--

INSERT INTO `usuario_estudios` (`id_us_est`, `acronimo`, `carrera`, `nivel`, `id_usuario`) VALUES
(1, 'Ing.', 'Ingeniería en Informática', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id_acceso`);

--
-- Indices de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`id_aplicacion`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `materia_carrera`
--
ALTER TABLE `materia_carrera`
  ADD PRIMARY KEY (`id_mc`);

--
-- Indices de la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  ADD PRIMARY KEY (`id_mp`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `periodo_anio`
--
ALTER TABLE `periodo_anio`
  ADD PRIMARY KEY (`id_pa`);

--
-- Indices de la tabla `periodo_inicio`
--
ALTER TABLE `periodo_inicio`
  ADD PRIMARY KEY (`id_pi`);

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`id_telefono`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_estudios`
--
ALTER TABLE `usuario_estudios`
  ADD PRIMARY KEY (`id_us_est`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  MODIFY `id_aplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materia_carrera`
--
ALTER TABLE `materia_carrera`
  MODIFY `id_mc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materia_profesor`
--
ALTER TABLE `materia_profesor`
  MODIFY `id_mp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `periodo_anio`
--
ALTER TABLE `periodo_anio`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `periodo_inicio`
--
ALTER TABLE `periodo_inicio`
  MODIFY `id_pi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `id_telefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario_estudios`
--
ALTER TABLE `usuario_estudios`
  MODIFY `id_us_est` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
