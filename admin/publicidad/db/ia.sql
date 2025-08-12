-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 18:59:35
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
-- Base de datos: `ia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `prioridad` int(100) DEFAULT NULL,
  `realizado` int(1) NOT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_accion`, `nombre`, `direccion`, `prioridad`, `realizado`, `estado`) VALUES
(1, 'Publicar campañas', 'publicidad', 2, 1, 1),
(2, 'Actualizar Campañas', 'publicidad/actualiza.php', 7, 1, 1),
(3, 'Enviar mensajes', 'mensajes', 4, 0, 0),
(4, 'Crear Expedientes Curp', 'alumno/curp.php', 1, 0, 0),
(5, 'Completar datos de alumnos', 'alumno/expediente.php', 1, 0, 0),
(6, 'Repaso de examenes', 'alumno/repaso.php', 1, 0, 0),
(7, 'Seguir conversación', 'conversa', 5, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_complemento`
--

CREATE TABLE `chat_complemento` (
  `id_complemento` int(11) NOT NULL,
  `palabra` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_mensaje`
--

CREATE TABLE `chat_mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `mensaje` varchar(500) DEFAULT NULL,
  `prioridad` int(3) NOT NULL,
  `funcion` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat_mensaje`
--

INSERT INTO `chat_mensaje` (`id_mensaje`, `mensaje`, `prioridad`, `funcion`) VALUES
(1, 'Nuestro curso dura 6 meses y en este tiempo aprenderás:\n✅ Uso de la computadora (prender, apagar, mouse, teclado, conectar dispositivos)\n✅ Crear documentos (Word)\n✅ Crear hojas de cálculo (Excel)\n✅ Crear presentaciones (Power Point)\n✅ Uso de internet, redes sociales, tramites y pagos en línea, localización de lugares por Google maps, documentos en la nube.\n\n¿Gustas que te indique los costos?', 3, 0),
(2, '¿Ya eres mayor de edad?.', 3, 0),
(3, 'Hola. ', 1, 0),
(4, 'Con gusto te doy información.', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_patron`
--

CREATE TABLE `chat_patron` (
  `id_patron` int(11) NOT NULL,
  `patron` varchar(500) DEFAULT NULL,
  `contexto` int(1) NOT NULL DEFAULT 0,
  `id_mensaje` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_texto`
--

CREATE TABLE `chat_texto` (
  `id_texto` int(11) NOT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_usuario`
--

CREATE TABLE `chat_usuario` (
  `id_chat_us` int(11) NOT NULL,
  `destino` varchar(300) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time NOT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `liga` varchar(200) DEFAULT NULL,
  `acceso` date DEFAULT NULL,
  `tipo` int(1) DEFAULT NULL,
  `sesion` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `liga`, `acceso`, `tipo`, `sesion`) VALUES
(1, 'https://www.facebook.com/groups/227306239337007/', '2024-04-17', 1, 1),
(2, 'https://www.facebook.com/groups/3040434419317513/', '2024-04-20', 0, 1),
(3, 'https://www.facebook.com/groups/acahualco/', '2024-04-20', 0, 1),
(4, 'https://www.facebook.com/groups/1480142168913612/', '2024-04-20', 0, 1),
(5, 'https://www.facebook.com/groups/406839000745756/', '2024-04-20', 0, 1),
(6, 'https://www.facebook.com/groups/174568133449864/', '2024-04-20', 0, 1),
(7, 'https://www.facebook.com/groups/543893603439878/', '2024-04-20', 0, 1),
(8, 'https://www.facebook.com/groups/305126906659325/', '2024-04-18', 1, 1),
(9, 'https://www.facebook.com/groups/373747773250115/', '2024-04-20', 0, 1),
(10, 'https://www.facebook.com/groups/2116184841861191/', '2024-04-16', 1, 1),
(11, 'https://www.facebook.com/groups/280314803599121/', '2024-04-20', 0, 1),
(12, 'https://www.facebook.com/groups/567734552095482/', '2024-04-20', 0, 1),
(13, 'https://www.facebook.com/groups/344623519218843/', '2024-04-20', 0, 1),
(14, 'https://www.facebook.com/groups/1149384678577243/', '2024-04-20', 0, 1),
(15, 'https://www.facebook.com/groups/1104163583389279/', '2024-04-16', 1, 1),
(16, 'https://www.facebook.com/groups/212008656268955/', '2024-04-18', 1, 1),
(17, 'https://www.facebook.com/groups/483720496582524/', '2024-04-23', 0, 1),
(18, 'https://www.facebook.com/groups/4079542175419963/', '2024-04-23', 0, 1),
(19, 'https://www.facebook.com/groups/391714577928126/', '2024-04-18', 1, 1),
(20, 'https://www.facebook.com/groups/1750531681894749/', '2024-04-16', 1, 1),
(21, 'https://www.facebook.com/groups/808594632521084/', '2024-04-23', 0, 1),
(22, 'https://www.facebook.com/groups/1185397742320379/', '2024-04-18', 1, 1),
(23, 'https://www.facebook.com/groups/buscotrabajotolucametepec/', '2024-04-18', 1, 1),
(24, 'https://www.facebook.com/groups/1809928905833186/', '2024-04-18', 1, 1),
(25, 'https://www.facebook.com/groups/501650424095850/', '2024-04-23', 0, 1),
(26, 'https://www.facebook.com/groups/400770378315043/', '2024-04-23', 0, 1),
(27, 'https://www.facebook.com/groups/637525450372120/', '2024-04-23', 0, 1),
(28, 'https://www.facebook.com/groups/177646331163156/', '2024-04-23', 0, 1),
(29, 'https://www.facebook.com/groups/1756634887811322/', '2024-04-23', 0, 1),
(30, 'https://www.facebook.com/groups/1003573119846889/', '2024-04-18', 1, 1),
(31, 'https://www.facebook.com/groups/866356627427277/', '2024-04-18', 1, 1),
(32, 'https://www.facebook.com/groups/1067276880465079/', '2024-04-23', 0, 1),
(33, 'https://www.facebook.com/groups/2117322298385633/', '2024-04-16', 1, 1),
(34, 'https://www.facebook.com/groups/2476031876039436/', '2024-04-23', 0, 1),
(35, 'https://www.facebook.com/groups/243243620816746/', '2024-04-16', 1, 1),
(36, 'https://www.facebook.com/groups/319672669448669/', '2024-04-23', 0, 1),
(37, 'https://www.facebook.com/groups/222352371225488/', '2024-04-18', 1, 1),
(38, 'https://www.facebook.com/groups/962893040803213/', '2024-04-18', 1, 1),
(39, 'https://www.facebook.com/groups/2260979463958070/', '2024-04-23', 0, 1),
(40, 'https://www.facebook.com/groups/2141254886094391/', '2024-04-09', 0, 1),
(41, 'https://www.facebook.com/groups/169249224526533/', '2024-04-09', 0, 1),
(42, 'https://www.facebook.com/groups/406367203165937/', '2024-04-09', 0, 1),
(43, 'https://www.facebook.com/groups/891903058299755/', '2024-04-18', 1, 1),
(44, 'https://www.facebook.com/groups/3275329862691453/', '2024-04-18', 1, 1),
(45, 'https://www.facebook.com/groups/1385804261477625/', '2024-04-18', 1, 1),
(46, 'https://www.facebook.com/groups/196102557798116/', '2024-04-18', 1, 1),
(47, 'https://www.facebook.com/groups/448235412255570/', '2024-04-18', 1, 1),
(48, 'https://www.facebook.com/groups/645948432213693/', '2024-04-16', 1, 1),
(49, 'https://www.facebook.com/groups/empleosentoluca/', '2024-04-16', 1, 1),
(50, 'https://www.facebook.com/groups/255847585157942/', '2024-04-16', 1, 1),
(51, 'https://www.facebook.com/groups/439468453061642/', '2024-04-17', 1, 1),
(52, 'https://www.facebook.com/groups/empleostolucametepec/', '2024-04-17', 1, 1),
(53, 'https://www.facebook.com/groups/256404984849990/', '2024-04-17', 1, 1),
(54, 'https://www.facebook.com/groups/1048214055256880/', '2024-04-17', 1, 1),
(55, 'https://www.facebook.com/groups/362334834740017/', '2024-04-09', 0, 1),
(56, 'https://www.facebook.com/groups/1203820856676869/', '2024-04-16', 0, 1),
(57, 'https://www.facebook.com/groups/624272265047729/', '2024-04-16', 0, 1),
(58, 'https://www.facebook.com/groups/ExpresionSanLuisMextepec/', '2024-04-16', 0, 1),
(59, 'https://www.facebook.com/groups/484940945356736/', '2024-04-16', 0, 1),
(60, 'https://www.facebook.com/groups/1159536427880178/', '2024-04-16', 0, 1),
(61, 'https://www.facebook.com/groups/226815631919146/', '2024-04-16', 0, 1),
(62, 'https://www.facebook.com/groups/2885203981765976/', '2024-04-18', 1, 1),
(63, 'https://www.facebook.com/groups/304994606533040/', '2024-04-16', 0, 1),
(64, 'https://www.facebook.com/groups/455639899020296/', '2024-04-18', 1, 1),
(65, 'https://www.facebook.com/groups/213998045915633/', '2024-04-18', 1, 1),
(66, 'https://www.facebook.com/groups/640871789850691/', '2024-04-17', 0, 1),
(67, 'https://www.facebook.com/groups/2431183187129567/', '2024-04-17', 0, 1),
(68, 'https://www.facebook.com/groups/1384894922071792/', '2024-04-18', 1, 1),
(69, 'https://www.facebook.com/groups/169887207866737/', '2024-04-18', 1, 1),
(70, 'https://www.facebook.com/groups/4899504680093753/', '2024-04-18', 1, 1),
(71, 'https://www.facebook.com/groups/LermaDeVillada/', '2024-04-18', 1, 1),
(72, 'https://www.facebook.com/groups/3124316727658095/', '2024-04-09', 0, 1),
(73, 'https://www.facebook.com/groups/1149503245967776/', '2024-04-18', 1, 1),
(74, 'https://www.facebook.com/groups/1385393228461355/', '2024-04-09', 0, 1),
(75, 'https://www.facebook.com/groups/969832750043692/', '2024-04-09', 0, 1),
(76, 'https://www.facebook.com/groups/689939181515135/', '2024-04-20', 1, 1),
(77, 'https://www.facebook.com/groups/927613354284034/', '2024-04-20', 1, 1),
(78, 'https://www.facebook.com/groups/318603822019655/', '2024-04-09', 0, 1),
(79, 'https://www.facebook.com/groups/1122334118295571/', '2024-04-14', 0, 1),
(80, 'https://www.facebook.com/groups/921331091657811/', '2024-04-14', 0, 1),
(81, 'https://www.facebook.com/groups/2687047754890147/', '2024-04-14', 0, 1),
(82, 'https://www.facebook.com/groups/684607068640730/', '2024-04-14', 0, 1),
(83, 'https://www.facebook.com/groups/524903941603379/', '2024-04-14', 0, 1),
(84, 'https://www.facebook.com/groups/2110655042566971/', '2024-04-14', 0, 1),
(85, 'https://www.facebook.com/groups/1467132180174735/', '2024-04-20', 1, 1),
(86, 'https://www.facebook.com/groups/156167241245771/', '2024-04-20', 1, 1),
(87, 'https://www.facebook.com/groups/trabajotoluca/', '2024-04-20', 1, 1),
(88, 'https://www.facebook.com/groups/631183897046991/', '2024-04-20', 1, 1),
(89, 'https://www.facebook.com/groups/407620104405299/', '2024-04-20', 1, 1),
(90, 'https://www.facebook.com/groups/Otzolotepec/', '2024-04-20', 1, 1),
(91, 'https://www.facebook.com/groups/267473617273970/', '2024-04-20', 1, 1),
(92, 'https://www.facebook.com/groups/162707333940169/', '2024-04-20', 1, 1),
(93, 'https://www.facebook.com/groups/228099556127950/', '2024-04-14', 0, 1),
(94, 'https://www.facebook.com/groups/885351178688917/', '2024-04-14', 0, 1),
(95, 'https://www.facebook.com/groups/941605666415531/', '2024-04-20', 1, 1),
(96, 'https://www.facebook.com/groups/207474197250752/', '2024-04-20', 1, 1),
(97, 'https://www.facebook.com/groups/1271926856506710/', '2024-04-14', 0, 1),
(98, 'https://www.facebook.com/groups/1742430255992191/', '2024-04-14', 0, 1),
(99, 'https://www.facebook.com/groups/289676971384378/', '2024-04-14', 0, 1),
(100, 'https://www.facebook.com/groups/sanjuandelashuertas/', '2024-04-14', 0, 1),
(101, 'https://www.facebook.com/groups/267387994840989/', '2024-04-14', 0, 1),
(102, 'https://www.facebook.com/groups/2436727466399291/', '2024-04-14', 0, 1),
(103, 'https://www.facebook.com/groups/931905000599608/', '2024-04-14', 0, 1),
(104, 'https://www.facebook.com/groups/2342867092675066/', '2024-04-14', 0, 1),
(105, 'https://www.facebook.com/groups/385952545721009/', '2024-04-14', 0, 1),
(106, 'https://www.facebook.com/groups/141357957517921/', '2024-04-20', 1, 1),
(107, 'https://www.facebook.com/groups/697281408120739/', '2024-04-14', 0, 1),
(108, 'https://www.facebook.com/groups/265753301208488/', '2024-04-14', 0, 1),
(109, 'https://www.facebook.com/groups/667921793846596/', '2024-04-14', 0, 1),
(110, 'https://www.facebook.com/groups/2233920896694609/', '2024-04-16', 0, 1),
(111, 'https://www.facebook.com/groups/199550487701886/', '2024-04-16', 0, 1),
(112, 'https://www.facebook.com/groups/1875737112456408/', '2024-04-23', 1, 1),
(113, 'https://www.facebook.com/groups/373098692841667/', '2024-04-16', 0, 1),
(114, 'https://www.facebook.com/groups/1708032316158625/', '2024-04-16', 0, 1),
(115, 'https://www.facebook.com/groups/2101422723495793/', '2024-04-23', 1, 1),
(116, 'https://www.facebook.com/groups/724867417931342/', '2024-04-23', 1, 1),
(117, 'https://www.facebook.com/groups/249708825398114/', '2024-04-17', 0, 1),
(118, 'https://www.facebook.com/groups/233307151153236/', '2024-04-23', 1, 1),
(119, 'https://www.facebook.com/groups/269868387658263/', '2024-04-17', 0, 1),
(120, 'https://www.facebook.com/groups/260982349548885/', '2024-04-23', 1, 1),
(121, 'https://www.facebook.com/groups/359341757834371/', '2024-04-17', 0, 1),
(122, 'https://www.facebook.com/groups/521566568821612/', '2024-04-17', 0, 1),
(123, 'https://www.facebook.com/groups/1444174222503281/', '2024-04-23', 1, 1),
(124, 'https://www.facebook.com/groups/233009043558550/', '2024-04-23', 1, 1),
(125, 'https://www.facebook.com/groups/607886049716958/', '2024-04-23', 1, 1),
(126, 'https://www.facebook.com/groups/1047612472312975/', '2024-04-23', 1, 1),
(127, 'https://www.facebook.com/groups/756330164907253/', '2024-04-23', 1, 1),
(128, 'https://www.facebook.com/groups/401522080363885/', '2024-04-23', 1, 1),
(129, 'https://www.facebook.com/groups/279761472790961/', '2024-04-23', 1, 1),
(130, 'https://www.facebook.com/groups/667479877005020/', '2024-04-17', 0, 1),
(131, 'https://www.facebook.com/groups/3487597324826945/', '2024-04-18', 0, 1),
(132, 'https://www.facebook.com/groups/1004367549988933/', '2024-04-18', 0, 1),
(133, 'https://www.facebook.com/groups/606934130721153/', '2024-04-18', 0, 1),
(134, 'https://www.facebook.com/groups/615829220059334/', '2024-04-23', 1, 1),
(135, 'https://www.facebook.com/groups/626341844228514/', '2024-04-09', 1, 1),
(136, 'https://www.facebook.com/groups/3533557640000242/', '2024-04-09', 1, 1),
(137, 'https://www.facebook.com/groups/3140425149573281/', '2024-04-09', 1, 1),
(138, 'https://www.facebook.com/groups/918854068218601/', '2024-04-18', 0, 1),
(139, 'https://www.facebook.com/groups/299071881458488/', '2024-04-14', 1, 1),
(140, 'https://www.facebook.com/groups/2410710342571200/', '2024-04-15', 1, 1),
(141, 'https://www.facebook.com/groups/430550090837049/', '2024-04-16', 1, 1),
(142, 'https://www.facebook.com/groups/147647129403306/', '2024-04-16', 1, 1),
(143, 'https://www.facebook.com/groups/249121888968425/', '2024-04-18', 0, 1),
(144, 'https://www.facebook.com/groups/498637887156106/', '2024-04-16', 1, 1),
(145, 'https://www.facebook.com/groups/259510165671484/', '2024-04-17', 1, 1),
(146, 'https://www.facebook.com/groups/1231164904303244/', '2024-04-18', 0, 1),
(147, 'https://www.facebook.com/groups/760077291376894/', '2024-04-17', 1, 1),
(148, 'https://www.facebook.com/groups/371457954069626/', '2024-04-18', 0, 1),
(149, 'https://www.facebook.com/groups/3232048033497316/', '2024-04-18', 0, 1),
(150, 'https://www.facebook.com/groups/410407386373559/', '2024-04-18', 0, 1),
(151, 'https://www.facebook.com/groups/2359748384240181/', '2024-04-18', 0, 1),
(152, 'https://www.facebook.com/groups/163590532294633/', '2024-04-17', 1, 1),
(153, 'https://www.facebook.com/groups/448156883274736/', '2024-04-17', 1, 1),
(154, 'https://www.facebook.com/groups/147070200965358/', '2024-04-17', 1, 1),
(155, 'https://www.facebook.com/groups/343065974373840/', '2024-04-18', 1, 1),
(156, 'https://www.facebook.com/groups/141367597854356/', '2024-04-18', 1, 1),
(157, 'https://www.facebook.com/groups/465689050962014/', '2024-04-18', 1, 1),
(158, 'https://www.facebook.com/groups/218423023248924/', '2024-04-18', 1, 1),
(159, 'https://www.facebook.com/groups/354630269015757/', '2024-04-18', 0, 1),
(160, 'https://www.facebook.com/groups/4320537944742481/', '2024-04-18', 1, 1),
(161, 'https://www.facebook.com/groups/903834890117183/', '2024-04-18', 0, 1),
(162, 'https://www.facebook.com/groups/1288308644891467/', '2024-04-15', 0, 1),
(163, 'https://www.facebook.com/groups/2818284908498769/', '2024-04-15', 0, 1),
(164, 'https://www.facebook.com/groups/160727912261026/', '2024-04-18', 1, 1),
(165, 'https://www.facebook.com/groups/5412321478782477/', '2024-04-15', 0, 1),
(166, 'https://www.facebook.com/groups/1622775584573605/', '2024-04-15', 0, 1),
(167, 'https://www.facebook.com/groups/759857801575606/', '2024-04-16', 0, 1),
(168, 'https://www.facebook.com/groups/782482548474294/', '2024-04-17', 0, 1),
(169, 'https://www.facebook.com/groups/verdadesyrumores/', '2024-04-18', 0, 1),
(170, 'https://www.facebook.com/groups/353318968391843/', '2024-04-18', 1, 1),
(171, 'https://www.facebook.com/groups/2565535747108860/', '2024-04-18', 1, 1),
(172, 'https://www.facebook.com/groups/407434969444159/', '2024-04-18', 1, 1),
(173, 'https://www.facebook.com/groups/422145213306588/', '2024-04-18', 1, 1),
(174, 'https://www.facebook.com/groups/262401307638700/', '2024-04-18', 0, 1),
(175, 'https://www.facebook.com/groups/2243151419164433/', '2024-04-18', 1, 1),
(176, 'https://www.facebook.com/groups/353446503497695/', '2024-04-18', 0, 1),
(177, 'https://www.facebook.com/groups/578928859686808/', '2024-04-09', 1, 1),
(178, 'https://www.facebook.com/groups/2853908558054375/', '2024-04-09', 1, 1),
(179, 'https://www.facebook.com/groups/131439271511435/', '2024-04-16', 0, 1),
(180, 'https://www.facebook.com/groups/681235406348939/', '2024-04-16', 0, 1),
(181, 'https://www.facebook.com/groups/334695660443742', '2024-04-20', 0, 1),
(182, 'https://www.facebook.com/groups/2192108500944672/', '2024-04-20', 0, 1),
(183, 'https://www.facebook.com/groups/1129865784218295', '2024-04-20', 0, 1),
(184, 'https://www.facebook.com/groups/548867173974961?locale=es_LA', '2024-04-20', 1, 1),
(185, 'https://www.facebook.com/groups/1002243824523533', '2024-04-20', 0, 1),
(186, 'https://www.facebook.com/groups/395106058871422/', '2024-04-20', 0, 1),
(187, 'https://www.facebook.com/groups/1225341544668441/', '2024-04-18', 1, 1),
(188, 'https://www.facebook.com/groups/1833134523696529/', '2024-04-18', 0, 1),
(189, 'https://www.facebook.com/groups/204524477920960/', '2024-04-18', 0, 1),
(190, 'https://www.facebook.com/groups/1002243824523533/', '2024-04-18', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `mensaje` varchar(500) DEFAULT NULL,
  `destino` varchar(100) NOT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `f_sol` date DEFAULT NULL,
  `f_atencion` date DEFAULT NULL,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id_mensaje`, `mensaje`, `destino`, `tipo`, `f_sol`, `f_atencion`, `estado`) VALUES
(1, 'Hola, esta es una prueba', '7223744252', 'wp', '2024-04-03', '2024-04-03', 0),
(2, 'Hola, esta es una prueba', '7221122248', 'wp', '2024-04-03', '2024-04-03', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `id_publicidad` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `imagen` varchar(50) NOT NULL,
  `prioridad` int(2) DEFAULT NULL,
  `n_grupos` int(2) DEFAULT NULL,
  `lugar` int(11) NOT NULL DEFAULT 0,
  `estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`id_publicidad`, `nombre`, `contenido`, `imagen`, `prioridad`, `n_grupos`, `lugar`, `estado`) VALUES
(1, 'Computación', 'Hola vecino, ¿Conoces a alguien que le interese aprender computación? ¡Tenemos curso en 6 meses, empezamos desde lo básico hasta convertirte en experto!♥\r\n\r\n😍Costo desde $250 por semana  😍\r\n\r\nInfo wa.me/7226352407 \r\n', 'vianey.png', 2, 25, 0, 0),
(2, 'Prepa', '🏅🏅Hola vecinos, ¿conocen a alguien que no tenga aún su PREPARATORIA terminada?, para inscribirlo a campaña de certificación en un solo examen:\r\n\r\n✅ SIN PAGO DE INSCRIPCIÓN\r\n✅ Aplicación de examen GRATIS\r\n✅ Pago de certificado con facilidades (solo se paga si acreditas)\r\n\r\ninfo wa.me/7294504745', 'prepa.jpg', 2, 0, 1, 1),
(3, 'Creación páginas web', 'Hola vecino, ¿tienes algún negocio o empresa? ¿te gustaría tener tu propia página web?.  💻\n\n✅Manejo desde páginas informativas, páginas de ventas en línea, inventarios, pedidos, cotizaciones automáticas y muchas otras funciones.\n\nMe ajusto a tu presupuesto 😉\n\nInformes wa.me/7226352407', 'web.png', 1, 13, 1, 0),
(4, 'Asistente Administrativo', '🌟 ¡Hola vecino, conoces a alguien que quiera estudiar para ASISTENTE ADMINISTRATIV@! 🎓\r\n\r\n¿Tienes secundaria concluida?¿Buscas una carrera dinámica y con amplias oportunidades laborales? ¡Entonces nuestra carrera de Asistente Administrativ@ es perfecta para ti!\r\n\r\nEn solo 16 meses, adquirirás todas las habilidades y conocimientos necesarios para destacar en el mundo empresarial. Nuestro programa te proporcionará:\r\n\r\n✅ Fundamentos de Administración y Organización\r\n✅ Herramientas de Oficina y Tecnología\r\n✅ Organización de Eventos y Gestión de Recursos\r\n✅ Prácticas Profesionales en Empresas de Prestigio\r\n\r\nInformes: wa.me/7226352407', 'asistente.jpg', 3, 38, 0, 0),
(5, 'Prepa a tu ritmo', '🏫 Hola Vecino, ¿Te has preguntado alguna vez si podrías terminar la PREPARATORIA a tu propio ritmo, desde la comodidad de tu hogar y con una duración que se adapte a tu vida? ¡La respuesta es sí!\r\n\r\n📚 En nuestra plataforma de estudios en línea, te ofrecemos la oportunidad de completar tus estudios de preparatoria en un período flexible de 2 a 12 meses. ¡Sí, lo escuchaste bien! Puedes diseñar tu propio camino educativo, ajustándolo a tus horarios y responsabilidades diarias.\r\n\r\n✅Horario flexible\r\n✅Avanza a tu propio ritmo\r\n✅Apoyo personalizado\r\n✅Costo desde $500 al mes\r\n\r\nInformes: wa.me/7226352407', 'ritmo.jpg', 2, 25, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variables`
--

CREATE TABLE `variables` (
  `id_variable` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `variables`
--

INSERT INTO `variables` (`id_variable`, `nombre`, `valor`) VALUES
(1, 'dia', '2024-04-23'),
(2, 'grupos', '25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `chat_complemento`
--
ALTER TABLE `chat_complemento`
  ADD PRIMARY KEY (`id_complemento`);

--
-- Indices de la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `chat_patron`
--
ALTER TABLE `chat_patron`
  ADD PRIMARY KEY (`id_patron`);

--
-- Indices de la tabla `chat_texto`
--
ALTER TABLE `chat_texto`
  ADD PRIMARY KEY (`id_texto`),
  ADD UNIQUE KEY `texto` (`texto`);

--
-- Indices de la tabla `chat_usuario`
--
ALTER TABLE `chat_usuario`
  ADD PRIMARY KEY (`id_chat_us`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`id_publicidad`);

--
-- Indices de la tabla `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`id_variable`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id_accion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `chat_complemento`
--
ALTER TABLE `chat_complemento`
  MODIFY `id_complemento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `chat_patron`
--
ALTER TABLE `chat_patron`
  MODIFY `id_patron` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_texto`
--
ALTER TABLE `chat_texto`
  MODIFY `id_texto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chat_usuario`
--
ALTER TABLE `chat_usuario`
  MODIFY `id_chat_us` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `id_publicidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `variables`
--
ALTER TABLE `variables`
  MODIFY `id_variable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
