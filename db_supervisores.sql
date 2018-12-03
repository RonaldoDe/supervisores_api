-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2018 a las 16:11:10
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_supervisores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `nombre_tabla` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_actividad` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_plan_trabajo`, `id_prioridad`, `nombre_tabla`, `nombre_actividad`) VALUES
(11, 169, 2, 'apertura', 'Apertura'),
(12, 170, 1, 'apertura', 'Apertura'),
(13, 172, 2, 'apertura', 'Apertura'),
(14, 173, 5, 'apertura', 'Apertura'),
(15, 166, 5, 'apertura', 'Apertura'),
(16, 166, 1, 'documentacion_legal', 'Documentación legal'),
(17, 175, 1, 'apertura', 'Apertura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apertura`
--

CREATE TABLE `apertura` (
  `id_apertura` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `calificacion_pv` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nocalificado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apertura`
--

INSERT INTO `apertura` (`id_apertura`, `id_plan_trabajo`, `fecha_inicio`, `fecha_fin`, `fecha_mod`, `observaciones`, `id_prioridad`, `estado`, `calificacion`, `calificacion_pv`) VALUES
(85, 166, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(86, 166, '2018-12-01 00:00:00', '2018-12-02 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(87, 167, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 1, 'Activo', NULL, 'nocalificado'),
(88, 168, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(89, 169, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(90, 170, '2018-11-30 00:00:00', '2018-12-01 23:59:00', NULL, '', 1, 'Activo', NULL, 'nocalificado'),
(91, 170, '2018-12-02 00:00:00', '2018-12-03 23:59:00', NULL, '', 1, 'Activo', NULL, 'nocalificado'),
(92, 172, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(93, 172, '2018-12-01 00:00:00', '2018-12-02 23:59:00', NULL, '', 2, 'Activo', NULL, 'nocalificado'),
(94, 173, '2018-11-29 00:00:00', '2018-11-30 23:59:00', NULL, '', 5, 'Activo', NULL, 'nocalificado'),
(95, 175, '2018-12-03 00:00:00', '2018-12-04 23:59:00', NULL, '', 1, 'Activo', NULL, 'nocalificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `captura_cliente`
--

CREATE TABLE `captura_cliente` (
  `id_captura_cliente` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones_locativas`
--

CREATE TABLE `condiciones_locativas` (
  `id_condiciones` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` int(11) DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio_exhibicion`
--

CREATE TABLE `convenio_exhibicion` (
  `iid_convenio_exhibicion` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinadores`
--

CREATE TABLE `coordinadores` (
  `id_cordinador` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asignado` int(11) NOT NULL,
  `foto` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`id_cordinador`, `nombre`, `apellido`, `cedula`, `codigo`, `correo`, `password`, `telefono`, `asignado`, `foto`, `id_api`) VALUES
(1, 'EFREN', 'OSORIO', '91.259.553', '00007', 'efoscar26@hotmail.com', '', '3174420553', 0, '../../../sieunidrogas/gestion/documentos/10062014/SIERH0007_104746_11710676_efren_osorio.jpg', 265795),
(2, 'RODRIGO', 'HERNANDEZ', '8.694.539', '00613', 'rhernandez@unidrogas.net.co', '', '6323877-317', 0, '../../../sieunidrogas/gestion/documentos/13012015/SIERH0007_180930_11710676_Captura_de_pantalla_2015-01-13_18.08.42.png', 835274),
(3, 'ALESSANDRO', 'MONTERO', '79.466.536', '00614', 'ffreytte@gmail.com', '', '3574132', 0, '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_141823_11710676_ALEXANDER_MONTERO.jpg', 851441),
(4, 'DANIEL', 'MELENDEZ', '1.098.615.330', '06754', 'daniels.melendez86@gmail.com', '', '3204634614', 0, '../../../sieunidrogas/gestion/documentos/07052016/SIERH0007_110716_11777387_Melendez_Daniel.jpg', 11788526),
(5, 'DIEGO ', 'DURAN', '16.260.356', '08262', 'DIEGODURANDAZA@OUTLOOK.COM', '', '3182528652-', 0, '../../../sieunidrogas/gestion/documentos/12032018/SIERH0007_110659_11778082_16260356_DURAN_DAZA_DIEGO.jpg', 11790034);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentacion_legal`
--

CREATE TABLE `documentacion_legal` (
  `id_documentacion` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documentacion_legal`
--

INSERT INTO `documentacion_legal` (`id_documentacion`, `id_plan_trabajo`, `id_prioridad`, `calificacion`, `fecha_inicio`, `fecha_fin`, `fecha_mod`, `observacion`, `calificacion_pv`, `estado`) VALUES
(12, 166, 5, NULL, '2018-11-30 00:00:00', '2018-11-30 23:00:00', NULL, '', NULL, 'activo'),
(13, 157, 5, NULL, '2018-11-29 00:00:00', '2018-11-29 23:00:00', NULL, '', NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_pedidos`
--

CREATE TABLE `evaluacion_pedidos` (
  `id_evaluacion_pedidos` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `num_remision` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excesos`
--

CREATE TABLE `excesos` (
  `id_excesos` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas_despachos`
--

CREATE TABLE `formulas_despachos` (
  `id_formula` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_sucursal`
--

CREATE TABLE `ingreso_sucursal` (
  `id_ingreso_sucursal` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_faltantes`
--

CREATE TABLE `libros_faltantes` (
  `id_librofaltante` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_agendaclientes`
--

CREATE TABLE `libro_agendaclientes` (
  `id_libro_agendaclientes` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_vencimientos`
--

CREATE TABLE `libro_vencimientos` (
  `id_libro_vencimientos` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_10_29_042808_create_posts_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('001b3461e4738c0ee44df40f6e9482b3e71cd0a73c44dcf33ee5a4e66dd6527859cb672c32129c79', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:00:20', '2018-11-01 21:00:20', '2018-11-02 16:00:20'),
('011e2ad30c5253c721ee0b8b0686cbdd0aa2ccdf701a175c30647d93a96732a8f62e98b7b901ab56', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:26:20', '2018-11-10 00:26:20', '2018-11-10 19:26:20'),
('031dfadb533df33cc35654edf6ecacc5f7a146501a2ed3c500476f8e395a0f583fb2dc2c8fe6687d', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:30:19', '2018-11-27 01:30:19', '2018-11-27 20:30:19'),
('032cf017c54db30d8764f913d2377c1dc864696ab3375b84dca899dfda293d648f6223521041c291', 4, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:05:02', '2018-11-09 02:05:02', '2018-11-09 21:05:02'),
('03e9a5f11c24fffd826249d23609880c588b224c47f7b94d4ad56b27155163f8f3be3d1e47eb87e7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:26:01', '2018-11-28 22:26:01', '2018-11-29 17:26:01'),
('03f3b275fd0759fc246f386887ac4990b93fd8923f1f5a679a18399d771387bac7d9fc44123e021f', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:48:58', '2018-12-01 16:48:58', '2018-12-02 11:48:58'),
('0448c1a8d379ff9e387597dca387e223bbb795e232313e30aed07c555c6ac30c31080d9f6d8e7b8f', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:37:51', '2018-11-29 20:37:51', '2018-11-30 15:37:51'),
('04cc6bf4a92203b3128d9fb7ab8f66b92a037ca50a82869e36cc55d458d7ec006c5ed48ff86a4ec6', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:26', '2018-11-27 00:59:26', '2018-11-27 19:59:25'),
('05d82f1a8d0b7d258e41bf6c87a00acb9ace1b140401a21a2b56a7dffe99de51a973403516b949fd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:14:31', '2018-11-07 00:14:31', '2018-11-07 19:14:31'),
('076f64ebc5cf61e43cfbaa5ae39ad62c34427049efbdcac8edc4e5fe0a82e55ae384d8c145f64384', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:58:04', '2018-11-21 18:58:04', '2018-11-22 13:58:03'),
('0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 23:53:32', '2018-11-01 23:53:32', '2018-11-02 18:53:32'),
('07b0aae70ba6122ee13ab98f25dc820be83587b9371998d755d59f98fdc31a5384a861dc4d946553', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:18:27', '2018-11-27 01:18:27', '2018-11-27 20:18:26'),
('0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:37:29', '2018-11-01 21:37:29', '2018-11-02 16:37:29'),
('087d7cf350f5322fa84ac974be411d753a3744abe8f0fb1f381a731d0df5a7b52b17704dc10f5362', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:09:31', '2018-12-01 17:09:31', '2018-12-02 12:09:31'),
('090ef8cdb9e1a41a9cef13242aa110f23f35c6b257a99eaa64911e874e1f5aee88c27c98e4bb50ac', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 18:57:33', '2018-11-29 18:57:33', '2018-11-30 13:57:33'),
('0ad9365c341d9e68a021ffcd7244420a19c4a8ed187171b6bb231fe2044d6b2ff4cce29071d6e69e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:48:49', '2018-11-15 01:48:49', '2018-11-15 20:48:49'),
('0b315c61671ef2d9e30197f215e17d57496a0ebe911fc89c2e4cb16ae3137e5338360a53c9fe5777', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:25:37', '2018-11-14 03:25:37', '2018-11-14 22:25:37'),
('0f201e258c95c555dba55d12780227442300b6b9640045bbcceb61f9de220a976bcdcf6532014ba8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 19:15:32', '2018-11-29 19:15:32', '2018-11-30 14:15:32'),
('0f36417468931c16d37529f6228ccb6d3a7b3940563b53d946e1b1c2340621509c702a8d48d892b7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 02:12:46', '2018-11-14 02:12:46', '2018-11-14 21:12:46'),
('10f634e0ae4c4f647a5c7e3a1fdb1785c952649403d0eae5453a1e52f6d7b0bb39d58966c2ebed41', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:23:57', '2018-12-01 17:23:57', '2018-12-02 12:23:57'),
('127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:08', '2018-11-01 21:59:08', '2018-11-02 16:59:08'),
('13165a9b3478f3fa04d8cafd104b4be2652cf7b83c051156ce2bda6387cb12ca452a3332bb8c1fc4', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:00:37', '2018-11-27 00:00:37', '2018-11-27 19:00:33'),
('136db9ed2c7475d6d260eb309ea0d58e7c791a7ec4d5a7204ce075d6caa832ebcace2e68bb02bc1c', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:19:34', '2018-12-03 14:19:34', '2018-12-04 09:19:34'),
('14e2c3dfdea2b974287d43bad96392b5db7eb725aa6badf32275b75a8c748a7069f3309343d75d8c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:22:30', '2018-11-15 02:22:30', '2018-11-15 21:22:30'),
('14f0f3bb307af6c77e6f52d9cd3d88b473523a67c444812277db093a68bf367438df7321bb897fca', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 03:06:30', '2018-11-27 03:06:30', '2018-11-27 22:06:29'),
('164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:11', '2018-11-01 20:24:11', '2018-11-02 15:24:11'),
('1739ab16f2d887102a200f737808c55bbbdf9851cb151a3109e9b2710004d6018b632c3b759a9858', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:21', '2018-11-27 00:59:21', '2018-11-27 19:59:21'),
('177781d4bbd65184e0d754a98433ec192389f4eb0b7df3ba03aef62af18449bb1c5eeb5c08137b28', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 19:12:16', '2018-11-28 19:12:16', '2018-11-29 14:12:16'),
('17c31704f0dfffaf1169d22d231246c0ff41664c76b84f43413e9b6f5620bbe9ad1b159b6f1391b7', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:08:33', '2018-12-01 17:08:33', '2018-12-02 12:08:33'),
('18a269572a9e484b010ad0c4d9a565d020be841be84dfac798b4e7dc2bca89eb60a2654a5d0a03f2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 21:55:11', '2018-11-15 21:55:11', '2018-11-16 16:55:10'),
('19a290bb7a78ce80a4bd95f2862c43f57357beeee4d2656bec0054c195b5bc56c73a37d0ed1b3ef7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:00:56', '2018-11-10 01:00:56', '2018-11-10 20:00:56'),
('19e0361372da6b9569c9823a39859613d86b2048750e6cbe6db7fa6e00e585a6f441e616480ead2a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 04:29:52', '2018-11-22 04:29:52', '2018-11-22 23:29:52'),
('1a284a5bdb861456cb01c861e27c934065937ab83e838acbf2742ea2f71f2df0185f0eaeba379385', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:38:27', '2018-11-21 18:38:27', '2018-11-22 13:38:27'),
('1a85bd33cbe1b4b723e160e1781685bdc8cf90745029731f2933ceeaeb5905bbaebd7241134cc24d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 02:36:30', '2018-11-21 02:36:30', '2018-11-21 21:36:29'),
('1c138d7d27550c6ace5b52ab496a9f75b4f7706fcd5b74e36dce0eb3fa980bc6c2fd49ccdc9e2aa4', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:25:11', '2018-11-10 00:25:11', '2018-11-10 19:25:11'),
('1c8282bc5af92c8ccec2028b625f8760feb857d6c73b856dac1b5043f4fe2ea4c3ac2e8e5be24230', 5, 1, NULL, '[\"*\"]', 0, '2018-11-08 20:42:50', '2018-11-08 20:42:50', '2018-11-09 15:42:48'),
('1d403c575c9e0c621aedc54bf0e5ac69d3c03c5eb81baeca63d35d335765c656b56d1a3220ac7023', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:25', '2018-11-27 00:59:25', '2018-11-27 19:59:25'),
('1d6377af047073965ceccd43a765adbc7b299e705aea22a21e2f9ca0769346ef003506e8d7c08539', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 20:11:11', '2018-11-14 20:11:11', '2018-11-15 15:11:10'),
('1d7807420c5f07e3a508a4cb1ec1b3ac80f06714f552194fff13011e778498ae02aa9dec8e140bf7', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:43:47', '2018-12-03 14:43:47', '2018-12-04 09:43:47'),
('1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:16', '2018-11-01 21:20:16', '2018-11-02 16:20:16'),
('20d904b36ab31e6f7631d891b4c44deecb9f5cf2721613e17c550ab993579395a5a8bc7ac9f3b485', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:00:45', '2018-11-27 00:00:45', '2018-11-27 19:00:45'),
('215c6af65af791e6b2740c0d6fc10dce317a518564b77b0ae11c28426d77b3eb9b58ae1f80634efd', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:43:51', '2018-11-29 16:43:51', '2018-11-30 11:43:51'),
('21cf3d8c0c68edda4c4ccce2eda99dce9641fc797935e81982022f19ebcd00d89c0ecf090455abd3', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:29:46', '2018-11-27 00:29:46', '2018-11-27 19:29:46'),
('23341fb96061be38a34b4dfc93e79edffdd605c7f5638cdf7e4f7f686a8fe7f73614d19bcc3be96a', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:05:56', '2018-11-28 22:05:56', '2018-11-29 17:05:56'),
('25d740cda866cd28b5da2551359f7924b2fb99fe2a5c3541ed3a39ab75159c2f07149342d21b726d', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:09:37', '2018-12-01 17:09:37', '2018-12-02 12:09:37'),
('26307e19863b5e7e0936a995609c0b80ed46f42b4f9b6a59389ce486f6836a248c2b4d46859e123b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 19:35:07', '2018-11-07 19:35:07', '2018-11-08 14:35:06'),
('2699d9dc01d7438b6c333205efdae42160d035560909a25b5e1fc433cd1bfabaa83d189eee0e5f66', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:33:57', '2018-11-07 00:33:57', '2018-11-07 19:33:57'),
('280e6f6cf9265a98265e30bb2d8ed7d6de8ca86927a43725e3faca9f2dd2b06101c7f525e2e3c3f1', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 03:08:27', '2018-11-27 03:08:27', '2018-11-27 22:08:27'),
('293d8f0ca7809f9c731b986dd3eeb37404e07b6c6b50b94220fb8cf08a381fb83445216b8abd545b', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:37:15', '2018-11-27 00:37:15', '2018-11-27 19:37:15'),
('2bcb381f76493d17b00a3316bd0252179a44d23ee7463916f61c8e8cf4b4f2bb7e65fa7359b333c1', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:31:34', '2018-11-28 22:31:34', '2018-11-29 17:31:34'),
('2c20d8b709616e3284a102be7aefe466db6e004c287fe3fff04a49ca77356f517fa240522afdb7d7', 18, 1, NULL, '[\"*\"]', 0, '2018-11-03 21:55:04', '2018-11-03 21:55:04', '2018-11-04 16:55:04'),
('2c37d683dd5bb10e9b0df00217b770d5dd10483b1e71e77286eb0cf3a18941f945d735417a7cc192', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 19:58:12', '2018-11-21 19:58:12', '2018-11-22 14:58:10'),
('2de3b566d48234244738a534e4dab6ae5b150bcef6304ab19348241b91aacfd66c100c34833c8b5f', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:55:13', '2018-11-29 21:55:13', '2018-11-30 16:55:13'),
('2f0dbcd0a076c2033bd55eee71c08fa4112828600596b9dda8cac27d64d957fd0101638758ac2c58', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:18:24', '2018-11-15 02:18:24', '2018-11-15 21:18:24'),
('2ffcccf6d9cc1098c96e2d06b18446a54d308654a00d27e306b376fafc686b672153c52900989f58', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:16', '2018-11-15 01:47:16', '2018-11-15 20:47:16'),
('31cf0819eb33716c8567a3e9f30096d7be5357e0221687b228edee425e986be0909d3e548697dc26', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 03:20:22', '2018-11-03 03:20:22', '2018-11-03 22:20:20'),
('344980f9fd8697cc023d89a238cb50c6f89d83ca030b59fde9f85d321d9d90f3da2af7fa83760886', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:37:23', '2018-11-27 00:37:23', '2018-11-27 19:37:23'),
('3472a6c526a5f0b28972b1a8c017061dd23f47678e15e7b3adfe447dea3f91ea4febe5bece9dc59e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:10:06', '2018-11-21 03:10:06', '2018-11-21 22:10:06'),
('3512e555d6b92bf6b9baa5215653be1c5fcff911840a5824da9904d61bacdbf39a6affd2603faa44', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 21:15:03', '2018-11-28 21:15:03', '2018-11-29 16:15:03'),
('35a371b52d9e985d6b74da9c417d8a9dd52962b9c4139064af45985179d1d2b3c2cade420af5d481', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:09:49', '2018-12-01 17:09:49', '2018-12-02 12:09:49'),
('36c8f9fb52e49c1801ebb9d115ab45799066a4da41aa7894e157039022c8de80da31327b4b8a529b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:41:33', '2018-11-15 01:41:33', '2018-11-15 20:41:32'),
('375c616324594ced36f5af01ce0e2d38b0d8a8685ad510b84334e49d1ff80d674a3388f9862c3a9d', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:00:50', '2018-11-29 22:00:50', '2018-11-30 17:00:50'),
('38a83441a7339badb4b8b7fda5a4580539534e55b4fc74935a65af3ac58f642895672ec0fc695716', 1, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:54:05', '2018-11-29 15:54:05', '2018-11-30 10:54:05'),
('3a0b2a17a3e7544e9a0c8d1b18719a3eadde9e4a3cbc9f2cd4e6a7805aeac453c0362bd6d72bd739', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:18:02', '2018-11-29 22:18:02', '2018-11-30 17:18:02'),
('3a8e3169c4d1fb1c34c5b1b605c29c6d44cf787574680feed21b3973967da45ba6177dad0d522d65', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 23:16:11', '2018-11-28 23:16:11', '2018-11-29 18:16:09'),
('3ace7d465e75573b58dcbfbeb311ad856aaad51ee12ea693f10e8cf7e4a14f90278da1a25fd9252e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:04:49', '2018-11-09 02:04:49', '2018-11-09 21:04:49'),
('3ae8eec9d12a3f300f0d67ccd22c1c60dc46b162e887396f141a066ab0a55a944dc0880c8ce61bad', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:48:50', '2018-12-01 16:48:50', '2018-12-02 11:48:50'),
('3b41a83806a95514cfffa64448d8e235dbd2f53998ebba454bea0a540ed98e5fe6f3e7915c094247', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:35:50', '2018-11-07 00:35:50', '2018-11-07 19:35:50'),
('3b7967067a409cf53f3ed6ee102648cb12dc5604097f102922aefaf1211640943303fca5f5ceb8e2', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:34:21', '2018-11-29 16:34:21', '2018-11-30 11:34:21'),
('3c7eea6a98a408614bb2a94580f5bb641b1a5adc5984a6a6c6a997b9a8d1a91d6ce534da71bd2f65', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:24:41', '2018-12-01 17:24:41', '2018-12-02 12:24:41'),
('3c8e087ccfb8d3ea2716fa6a29bac6f6ae359ee2b5e366e7af56ea9fd4b7610a4809294ad8c19520', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 03:40:29', '2018-11-15 03:40:29', '2018-11-15 22:40:29'),
('3da8eb9c6ac2b1466b646d90d3a1a53f6566e8bc082368ef07cba8e1d79b86611a5d52e40257ffa5', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:09:31', '2018-11-27 02:09:31', '2018-11-27 21:09:31'),
('3e1280b1ec5032d01cb82943169eecb7be7a582a12bb3b18f65b962f65fcfaf289e34b103093e89e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:25:40', '2018-11-27 01:25:40', '2018-11-27 20:25:40'),
('3e67f124430d598c745bc9a170bdfcf8d452ad78a3fdcfa371d6ab464a1881c2879a76bbc16f252e', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:32:50', '2018-11-28 22:32:50', '2018-11-29 17:32:50'),
('3e68dda3d1a4f648869728489d339581d600dbed3af1a21b9cae4c3b87f06072a885abf11d7c4267', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:49:13', '2018-12-01 16:49:13', '2018-12-02 11:49:13'),
('3e7a6a22fc7ce0f9ad6577c35dcbb08414769a18849c9c1a22bef5a2e71e0570826da6b56f9dcc02', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:56:21', '2018-11-29 21:56:21', '2018-11-30 16:56:21'),
('3e906e144d9b89cc884b65475c8bc85ea0a92268770066f6813c754459014169f0dcd6df3ff6364c', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:22:41', '2018-12-01 17:22:41', '2018-12-02 12:22:41'),
('3f517f6b978c9e6cb39fd02c536cc1b59bca98dae9df8e0c482c514ee3284edc04ff4044bd0838dc', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:28:01', '2018-11-27 01:28:01', '2018-11-27 20:28:01'),
('3f94f536ae868d4973b63b8ed2918f313bba799532fcf79d8326b3726749fa49f4b235378db1be23', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:16:54', '2018-11-09 02:16:54', '2018-11-09 21:16:54'),
('40a811bb005bf00c28e1a010f6372002cda948fe046a44a3990659be5a1cd57d7793e1b8b25eae32', 41, 1, NULL, '[\"*\"]', 0, '2018-12-03 13:57:29', '2018-12-03 13:57:29', '2018-12-04 08:57:26'),
('413f31856afb63203627a5043282ba38362496de0a4a90149abc9d7f2f7e3dbe80e1b2baad2e2527', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:42:11', '2018-11-15 01:42:11', '2018-11-15 20:42:11'),
('415cc0897732444e7b5969807bd0d65d95e03913d7457311b26aa6787372f3deb4d0e752eb770b9d', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 20:53:25', '2018-11-28 20:53:25', '2018-11-29 15:53:23'),
('417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:49', '2018-11-01 20:28:49', '2018-11-02 15:28:49'),
('4198cdbe9db3c2c2e670eac7436a7228a5f709cac37b3fa66f2cd1fe2aa6358d70a04227f4ed7d51', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 23:46:01', '2018-11-28 23:46:01', '2018-11-29 18:46:01'),
('4356d217e7b984cad7e0d6fac25188099790d170c5e766431d3c1bb5aa20929625b3c796df23772e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:03:36', '2018-12-01 17:03:36', '2018-12-02 12:03:36'),
('460ccbeb41686ca6e64208e81af9077bad6c43b054fbdc1be6f779300a02d0ecc474de963015c21c', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:56:38', '2018-11-29 20:56:38', '2018-11-30 15:56:38'),
('4816787151f1c99658585232a1ca96cdd63bb324712f15c3bacc934ed35556daa02463935d779bfb', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:45:06', '2018-11-14 03:45:06', '2018-11-14 22:45:06'),
('481e5d90320c7a9473379f6f9c93ef9348a48ccbf43fc69b38fa68568e3dbba290968ebf3342a604', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:32:16', '2018-11-27 01:32:16', '2018-11-27 20:32:16'),
('48569dc830fc263ecf3de4fcdc9c247c64c50fdb8ae8d70b8f40272ccf07fe943d59bdf87ec471de', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:30:16', '2018-11-10 00:30:16', '2018-11-10 19:30:15'),
('487ee222eb2b05afb34c9c872dcfb5e8bf3b270295a644379b2c9f7ffcc8d030009df31181d4b58c', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:59:47', '2018-12-01 16:59:47', '2018-12-02 11:59:47'),
('49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:46', '2018-11-01 21:04:46', '2018-11-02 16:04:46'),
('4a3ef85eb3e67800105bacc66f66fcbdc911d4049566a4785b893b8870d2494c8cf54eccf72852e8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:38:45', '2018-11-29 16:38:45', '2018-11-30 11:38:45'),
('4aa15ccd88d42fc5797ba88d17825b2f3bc34c514c7db445c8faedf01db2f65f1245747d99e138f7', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:23:47', '2018-11-27 01:23:47', '2018-11-27 20:23:47'),
('4ad01dbfb164f5ddb8d30a99fb3769a82b540d456ca99589be1ea94f400619c6e2fd9458858f787a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:49:16', '2018-11-15 01:49:16', '2018-11-15 20:49:16'),
('4ba9b5a7fc580d5ab2b17a5b02257e2ef80945242ac19b8becd65eea1d570c13be2ade82a8aef35d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:00:36', '2018-11-15 02:00:36', '2018-11-15 21:00:36'),
('4c2e7a902fca135e6fd398a7a81731eb882c90f94a4dbeb7e67a088070668a365bb7b1dfdaed66c4', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:01:13', '2018-11-27 01:01:13', '2018-11-27 20:01:13'),
('4c496332966e1a142b82494637a441e3cc1ebd4f1b6dac121ba5989c4f1ca5b29144348a7be3a255', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:21:15', '2018-11-29 22:21:15', '2018-11-30 17:21:14'),
('4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:11:21', '2018-11-01 21:11:21', '2018-11-02 16:11:21'),
('4da07451c6ba15fb6137dbc974fcd138f18cc0b812ea9b1c03d8ba01a85b2517507e4b4160a9db3f', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:43', '2018-11-15 01:46:43', '2018-11-15 20:46:43'),
('4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:05', '2018-11-01 21:20:05', '2018-11-02 16:20:05'),
('4ef4fdbcc588390a395435d8f10b665ca5a9083998c55b6b5889175358a4bde6a12fb37926a1ed79', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:16:23', '2018-12-01 17:16:23', '2018-12-02 12:16:23'),
('4f3b5b8274f5f48d7389355ffbf40bbcf6ebb2d94213656ce864ec182961a12d10db8bc753a63f05', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:29:41', '2018-11-27 01:29:41', '2018-11-27 20:29:41'),
('4fb701d22bb71c4822a1e95e4205c74c997b501fefbf65c08fc929dd66eeb1a6a779a7b8c62eea42', 5, 1, NULL, '[\"*\"]', 0, '2018-11-17 04:34:22', '2018-11-17 04:34:22', '2018-11-17 23:34:19'),
('508243a82af3dc011bea7e56b5a6024c1fb0957bfa791849b81e4832d3f51f5a0c7e80eb6bae5bad', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 00:59:40', '2018-11-02 00:59:40', '2018-11-02 19:59:39'),
('50ff640820ba7972b3fad6c57f853ffb4178c7183e820c0ba6a549485d4b71c67b84cfc1597a5cd7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 19:42:08', '2018-11-29 19:42:08', '2018-11-30 14:42:07'),
('51c9da7b1389d47ed2b5255f4a72bc68fe908b662249cc30b88656124bac3ed1076cdc8b49b2a8ad', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:08:34', '2018-12-01 17:08:34', '2018-12-02 12:08:34'),
('51f6a992a5ca6007541353badabcfc8412dabe153319cfa122574bd85e98a3aeb7143c469120e5f8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:03:57', '2018-11-09 02:03:57', '2018-11-09 21:03:53'),
('520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:00:34', '2018-11-01 21:00:34', '2018-11-02 16:00:34'),
('52c17dc3de24c66ed7113364019d430cdf6e27da45e3e69226a432c66ba5d226a0e8befd4656e37e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 21:37:57', '2018-11-28 21:37:57', '2018-11-29 16:37:56'),
('52d6b64b46f443c51cfa12468ced34607460323682192f6a8d731433d5001728afeb2d1b3073f466', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:07:12', '2018-11-28 22:07:12', '2018-11-29 17:07:12'),
('5372aec8f067b85a63f521aa446e0a1e3cf09398e30714cee3de888bcb5da8bf837cc1a4f7107d8e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:05:49', '2018-12-01 17:05:49', '2018-12-02 12:05:49'),
('53b9e684b82c30db819e8a8a103651434f7b4e8a7785500b82668a7d07b6cb880870f850f0892667', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 01:05:35', '2018-11-02 01:05:35', '2018-11-02 20:05:35'),
('54169e10b14d09881eaeaa11753dcdca325d93e4a6f442e1f4eb16278f5b057220b27180ef2df344', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:04:30', '2018-12-01 17:04:30', '2018-12-02 12:04:30'),
('541ae5232ad78d30de5f04ba41f2a974fb8099f967d000b3175576cadbcc1fa04a0dfbad14da1b07', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:37:55', '2018-11-21 18:37:55', '2018-11-22 13:37:55'),
('543f6a1a78fc9b405f51d96a61c5fd09145d8a26e770fb6bd783e3c551b009d9ecfe5a71808b0499', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 18:58:11', '2018-11-28 18:58:11', '2018-11-29 13:58:11'),
('54562846e6e7419d584a4c79ff76398e7e874af70c78a5fc9b756d0a459582c8be25cfff916c9821', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 17:01:23', '2018-11-29 17:01:23', '2018-11-30 12:01:20'),
('54ef77f0fb9ccd1111e443c076b49dacbccb9abc0cd2e4a58a33e1423db6992dba394f966b2d1a4e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 02:52:56', '2018-11-21 02:52:56', '2018-11-21 21:52:56'),
('555aba5493567164adbb30fabdfecb541a4d180e35af013f55533f78e98502e7da4ec745e5b9877c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 01:14:02', '2018-11-22 01:14:02', '2018-11-22 20:14:01'),
('55c9d617dc963ce793be18197d290b7b7dddf0541d9f01d6f9cc2708d268659c9793b38d0e213dc1', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 04:49:38', '2018-11-21 04:49:38', '2018-11-21 23:49:35'),
('572fac41f901ce6400d691c8f3c82660039f4617dccdea32b67d69237bf3763ae0144d7628cd4545', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:29:46', '2018-11-21 03:29:46', '2018-11-21 22:29:44'),
('59b9b6f9d67165073d2f69df8c2df61503e1b43f1b73888ba370b20cc65694bff294761009ea6c75', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 00:56:05', '2018-11-29 00:56:05', '2018-11-29 19:56:02'),
('5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:30:22', '2018-11-01 20:30:22', '2018-11-02 15:30:22'),
('5a9e18777f2e142e12860c1a14cb4d222b7977aece909e963f75119bc70f1cea1a6ef292765e4709', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:39:11', '2018-11-21 18:39:11', '2018-11-22 13:39:10'),
('5ac03113ca656d1bb0b0ad7192d75dc97f6125412a679c28862d8edc1203c0d3e93e50fae5b15c20', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:43:25', '2018-11-15 01:43:25', '2018-11-15 20:43:25'),
('5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:56', '2018-11-01 21:04:56', '2018-11-02 16:04:56'),
('5bfbfa12cefbc80484d550c54a067dbfeea6d1bf5eca37ca6ba650b2412eb7fd387d11520db3dbfd', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:08:37', '2018-11-28 22:08:37', '2018-11-29 17:08:37'),
('5d16904659bace8912ebb823cbdb8e75fcc6cec5c7202a821f8aafa1251e1b49fd53b035c5a37231', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 19:18:31', '2018-11-29 19:18:31', '2018-11-30 14:18:31'),
('5d1aa2e4eb5ab82443e27768ff86c9fda15db9de5b7a601751ca07cedf2841cf4fb63ec46feb4cfd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:00:02', '2018-11-14 03:00:02', '2018-11-14 22:00:02'),
('5dd84cbc98d3ea5d9fa719360e9a928270ee6bafb2af84c46a75c19f6bc4f443d093efcca064b671', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:51:52', '2018-11-27 02:51:52', '2018-11-27 21:51:52'),
('5df12947523558914ba58bd42f23c586db11afea33b51ff31ca3c41bf27b81de59534d62db357ac8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:05:15', '2018-11-29 22:05:15', '2018-11-30 17:05:15'),
('5e429a9e78764d32465ec73f80b8d704dc88e54b115a7db3c59af94ef59ccf2c869762713215c715', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:13:25', '2018-11-27 02:13:25', '2018-11-27 21:13:25'),
('5e44b34a1e7a2f0cd418b2942015b1e395cc1d5839c90c7d0cb82afa372c4a047d854a43d8573251', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:34:52', '2018-12-03 14:34:52', '2018-12-04 09:34:52'),
('5e4936a20fddcfb36104aa4037c3c72be1a572697f53c4c527de363c48736afe9c6925c28bf54aba', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:40:26', '2018-11-29 20:40:26', '2018-11-30 15:40:26'),
('5e783f07f3876c32aa281b138f6a88898b2e8794990e68c3c619c27704e951d0f1ddb0f6a24719d8', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:20', '2018-11-27 00:59:20', '2018-11-27 19:59:20'),
('5e7905375083b90e73c4926101867f637d447f98bcff7000deeb4c04e75e7250c7de261e51b6188e', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:33:25', '2018-11-28 22:33:25', '2018-11-29 17:33:25'),
('5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:53:26', '2018-11-01 21:53:26', '2018-11-02 16:53:26'),
('5fb5e4dc7237f496be72f6c247c9ac02bb7249862d10f19ece2e9d4b140995dbe835b053d9c21f90', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:04:33', '2018-11-09 02:04:33', '2018-11-09 21:04:33'),
('60b749bf878489a305f6950400893860f4b55582663ecbe21af174589e3bcbc09c104793e07cee2e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 19:12:08', '2018-11-29 19:12:08', '2018-11-30 14:12:08'),
('611890e4735e67786045a462555063af3c87ca390dd4039075fcb9cd8e4c8e440b84c4bbbb970071', 17, 1, NULL, '[\"*\"]', 0, '2018-11-30 19:56:36', '2018-11-30 19:56:36', '2018-12-01 14:56:36'),
('6145557d4ac916183e226f1c606ea9ff5950e59e20be898cc3b439758fd72657efb0546edf74f66a', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:05:11', '2018-12-01 17:05:11', '2018-12-02 12:05:11'),
('62ae3fb5c4d4ca16dc7c525ea00abaebb13c73800dc376298efffb48720ef9f713908ae7c939a3a0', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 15:01:39', '2018-12-03 15:01:39', '2018-12-04 10:01:39'),
('636a7ba7f6b57b68c08ac434f57109ecac87733824423f6e1301857d8511f7c40d53a992d7369dde', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:59:00', '2018-11-29 21:59:00', '2018-11-30 16:59:00'),
('63c77b461a9e33928cdb31b0f2094f629e2128b375b37fca29d0f17530fb66bd103f3ac73c295175', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:48:29', '2018-11-29 21:48:29', '2018-11-30 16:48:29'),
('644f24ffe0c8bb6072a531360446b77acfeafcd74c1ce80eb6cfe22b2855c09e8785f2af6fd8df96', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:54:33', '2018-11-29 20:54:33', '2018-11-30 15:54:32'),
('648228a94fc3012b5cbd897ba906431302c020a8db82e5d26df400a36193b0b4fa6380e8ae4cb6b7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:55', '2018-11-15 01:59:55', '2018-11-15 20:59:55'),
('648700c3e5b9366b3e90e20d41490b6d16eec62fa0a005f16229cca72f85a5291044a8439c3dc6b7', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:25:05', '2018-11-27 01:25:05', '2018-11-27 20:25:05'),
('64c73001bc1c1f8e1ff956120701d0d8b1e6667bf76ce1c085f7f80d3538ec6a108a97bea55f1444', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:51:49', '2018-11-29 20:51:49', '2018-11-30 15:51:49'),
('66824d7df298de700a170ecf14e4ca1eec32dcca6ae6d2d1a3c725e152f988e0b3efd319bb212ffd', 41, 1, NULL, '[\"*\"]', 0, '2018-11-30 18:50:21', '2018-11-30 18:50:21', '2018-12-01 13:50:17'),
('67f28138dc05f6de3c6838673a98c1293b60e537f04b688537fc9692444348b82d61ed4668f4468f', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:24:20', '2018-11-10 00:24:20', '2018-11-10 19:24:20'),
('690860c6a307aa410bb2ce72e623c26a966c7d3ecd18ae61e7c1da9a336a610c37d56b3e6ed93496', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:34:25', '2018-11-27 00:34:25', '2018-11-27 19:34:25'),
('6ade2824311df05226e5e55d86d6179e426773cab825a5b5bd0f64a931b776f5d710250e076a9f9b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:29', '2018-11-15 01:59:29', '2018-11-15 20:59:29'),
('6bbeebd2f0d412a026d2f4f9c6802cfebf427e6567e3bf91aff0d8a27e2437deea5d744343d25eea', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:52:57', '2018-11-27 02:52:57', '2018-11-27 21:52:57'),
('6c229799c74e7c0c7ba0a1ba4662156f08ab2066e227943ac4c8694d40829fb4b002a08ffdaecf94', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:51:59', '2018-11-27 01:51:59', '2018-11-27 20:51:59'),
('6c71fb58216ecb7e1c0ab1d66188df07ae2ae1e4c326d9bde139eb83974dbe53c350a32454045af7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:04:41', '2018-11-29 22:04:41', '2018-11-30 17:04:41'),
('6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:34', '2018-11-01 21:08:34', '2018-11-02 16:08:34'),
('6cc362d8f25c5a18530afa4e75508c471ff44103555b9e056f55ca95d2210333cd84f97d7116be76', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:59:44', '2018-12-01 16:59:44', '2018-12-02 11:59:44'),
('6d0da120fd840bd05caba0ca35b6f4decaeb656330f205f83f784c172f0d7e5af18cc37fe09b6d51', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:20', '2018-11-27 00:59:20', '2018-11-27 19:59:14'),
('6f1b3dc94965662e1ffac7a1493cd09ab89023ed94b790c401f30b37960d71a417d16712a6efb39d', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:51:58', '2018-11-29 16:51:58', '2018-11-30 11:51:58'),
('6f1ee8aafac3de4aa722ceb75bfb93b5656324698590800e30a36d175cf849322f0e24b7be70d840', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:02:29', '2018-11-27 01:02:29', '2018-11-27 20:02:29'),
('7133114f95fe4268613057a1884b4b831e6aec6c98189508ee1d074f021a7101e03c1dbac807ac30', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:52:47', '2018-11-27 01:52:47', '2018-11-27 20:52:47'),
('71b4d373509788d120026bfff92bf160c392b5ebd4cae8db2691cd0da998a142f6e3a2e2bf98dcde', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 02:59:26', '2018-11-22 02:59:26', '2018-11-22 21:59:25'),
('73cfa0462199a045bd425bb67150c294cb83fc815f11db7032d63f01545f7b2bfb59007830d22faf', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:53:59', '2018-12-03 14:53:59', '2018-12-04 09:53:59'),
('73fd7a8dbb3f94aaa12498f400c1c5126f612b1e24924d79872fc282d8e4f7e824f524bfc3fe0641', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:11:34', '2018-11-10 00:11:34', '2018-11-10 19:11:33'),
('75f5bb9788f0e2d1ba7d346d6433d13ff22ba2cce3f100db792b822d41ec93b416f697f262bcc989', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:31:20', '2018-11-27 01:31:20', '2018-11-27 20:31:20'),
('7669e4e012fc345ce6956683d32f5b3cf581c232417d1714b19591395f8c4d8b6c42349b76573ee9', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 17:01:23', '2018-11-29 17:01:23', '2018-11-30 12:01:20'),
('76adb15e5c5523cc5fdbe9cc24fb7c230725a61f4e68db22ea6ab670dbc28605901d0c2038319b1e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:24:56', '2018-11-27 00:24:56', '2018-11-27 19:24:55'),
('77854ca9424790506bcf6c7915a709310ccd4501565c3ca705d41cc3d0f135f47bb69e973266e493', 5, 1, NULL, '[\"*\"]', 0, '2018-11-06 20:40:21', '2018-11-06 20:40:21', '2018-11-07 15:40:16'),
('77a54106e29c0629068a2a9f810637c8110db92fd60a3605ec6849d7dd74e67c8c3bd4c1dbba6819', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:13:07', '2018-11-27 02:13:07', '2018-11-27 21:13:07'),
('781e415dbdf8523bf3e4a32720c9b5a73c678275682a890633a314ad23fe02aad7401574a0297b9e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:46:42', '2018-12-01 16:46:42', '2018-12-02 11:46:42'),
('7862894de790726c5f930b97d34bb2ac875fbaad4b56bc6b1fdc566b0b88c275e8cd121aa98c7f8c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:23:57', '2018-11-14 03:23:57', '2018-11-14 22:23:57'),
('7ae121074eccbe7203bb0a4e9fe9094ce9e9ad682e6afd2fa0861e27de712880bdc3bae1e2731253', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:41', '2018-11-15 01:59:41', '2018-11-15 20:59:41'),
('7bce1f5fc71dcd7723523ff366d18f2bd93c5cd74e4eec1085492ce490894a895b4336b9a5ec691b', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:07:47', '2018-11-27 02:07:47', '2018-11-27 21:07:47'),
('7c52127e134f1fc168599c5d3f85594852460d9a6e2573718e02039d128bcb167131cffbdc1a6095', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:13:50', '2018-11-29 20:13:50', '2018-11-30 15:13:50'),
('7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:05', '2018-11-01 21:02:05', '2018-11-02 16:02:04'),
('7d0cf616af51978d07b90babceb790c6b3e37b832c1543d8a5870fcff407d1e6a8d30f75937fd340', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:08:33', '2018-11-29 21:08:33', '2018-11-30 16:08:33'),
('7d4f5ac5543891b55705c7b821dd8b62e162439eef0a7f2b4baaf70fbe0ca0b26687cce811685e23', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 01:50:07', '2018-11-22 01:50:07', '2018-11-22 20:50:06'),
('81300083f18f51a4fe1fd7d9644adeef00384f0a061322716da5fd749b38de285a3a0c3b4ba1355e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:36:03', '2018-12-03 14:36:03', '2018-12-04 09:36:03'),
('81760047d1550921b6c08b8871480a8d178ea7bd88bfba9df7c2ce4c1ef3ce686a07bce2162cdd8a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:23:57', '2018-11-21 03:23:57', '2018-11-21 22:23:57'),
('83a168ffc00df3a239bfb3ae69b8adf8e7a8db0841ee1972684aa531b6464021b7caff3905f7d850', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:30:51', '2018-11-27 01:30:51', '2018-11-27 20:30:51'),
('83ed82aaae5d8d06bafc2aec94da3e756ed495c6288461243882a6f93ecdb25214f4362fb7d9d90b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 21:11:12', '2018-11-03 21:11:12', '2018-11-04 16:11:12'),
('84bc9cccc7118d94dcebbd01c2870a565cf6fdcd4e6ed371ee74dcc6a9beb4bea9faf88f573cfe47', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:03:57', '2018-12-01 17:03:57', '2018-12-02 12:03:57'),
('852e3046cfadae97b328144da51401cef2b44e32c33939bf680bad2446d2bac28086afdb68786af6', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:35:20', '2018-11-29 21:35:20', '2018-11-30 16:35:20'),
('8555731f6a352dc6a5b107260a8a5825ccb9f6c48b76996e66fd70feaf1b5136563993f71e792781', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:40:10', '2018-11-29 15:40:10', '2018-11-30 10:40:09'),
('856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:59:51', '2018-11-01 20:59:51', '2018-11-02 15:59:51'),
('85b6854c1c13287fa219e261862212e8524edde852cea75248fc470fa20ebf4d176b9bba648ccdb0', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 22:26:01', '2018-11-03 22:26:01', '2018-11-04 17:26:00'),
('87dca1f0a7020d558cb005686737772bbc7c14b3aa39fdcea7c2c617f2ef94d6bd71ce0aa0850a91', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:37:20', '2018-11-21 18:37:20', '2018-11-22 13:37:18'),
('89220362a98f77668b0e55a298f10722a95e2a1f09bdf83397b23b52503e1f1d1cb98696a11d20f5', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:51', '2018-11-15 01:47:51', '2018-11-15 20:47:51'),
('89a76593cd524b1219cd98902ff2171992eccce2573b145d973cfd51b0ea21ec58276c4cea1e2cd5', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:25:57', '2018-11-29 20:25:57', '2018-11-30 15:25:57'),
('8dba48846ec8700720d16b188ab33c2bf0fe79f955119b628c4c6e47a12a53526cbdca69351110c9', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:07:17', '2018-11-28 22:07:17', '2018-11-29 17:07:17'),
('8fb4c9f1d28262faeda8fa8731675cbbd6f8aa4c1876e31e9dc7c5a24cda33c1b606bc06c2d9a734', 4, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:30:39', '2018-11-21 03:30:39', '2018-11-21 22:30:39'),
('900908d12310cc895eeb16ccf68e8dfce9ded8d4082f8f85e6ea4d7a86b74f74ac49bfa679b2546e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:27:08', '2018-12-01 16:27:08', '2018-12-02 11:27:03'),
('909cf61d0a64451e9a9fe2669d9e9c7168ee6e1d2f8a6200a14d40816af6ece39783c5c80358b154', 4, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:19:04', '2018-11-21 03:19:04', '2018-11-21 22:19:04'),
('9275425ad6ca7b5cb4904fe8b6c9783653647032f9b7f340323b41d85dbaef1d069317ad145830d6', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:43:14', '2018-12-03 14:43:14', '2018-12-04 09:43:14'),
('949cd4932f25b125dc9603344996616a90582192e4f9d6c37b03c2c00fe2e651b6c618ca19dbff63', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:01:13', '2018-11-27 01:01:13', '2018-11-27 20:01:10'),
('94fedcc688bbdcd5a402e00f1feb939ee05c36c05817989a80b2a2f918a9c3484e9a0d9a29518d96', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:13:58', '2018-11-07 00:13:58', '2018-11-07 19:13:58'),
('9681dc1a47619318a3b9aa89428b6cf32a7dee7a2fbac4496e85a1d9d3ea7e6b3cd340c5b4d36414', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:34:05', '2018-11-28 22:34:05', '2018-11-29 17:34:05'),
('96fcb5c7c23a8f7f89c26654766b23a200ece915fbb490a0bb0f1af2bdfc90a74af4624f6f856b6c', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:28:43', '2018-11-27 01:28:43', '2018-11-27 20:28:43'),
('9719ae011bc5b68a8a0bbb2c4d5fc884198481eae5654e49b77a42fbc6694883ff3c94d5c1d4fdda', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:04:01', '2018-12-01 17:04:01', '2018-12-02 12:04:01'),
('97aeb19f32ef1a0405adda0bab665f16968f7c681edb470bb2cf4031345d4e3c6d868190fc7ad538', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 00:34:59', '2018-11-28 00:34:59', '2018-11-28 19:34:55'),
('98440fcd13de7391e90696372d06f2dac6cdfcd005301f47ea1a653fffc12dbf8f1dd1b229bd08cd', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:19:51', '2018-11-29 15:19:51', '2018-11-30 10:19:49'),
('99c898a963b3fe03d406e54eeeff4f2f0860807ef3f41225349ab2d227e8162716b625c521af7a33', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:17:57', '2018-11-21 03:17:57', '2018-11-21 22:17:57'),
('9a737066e293983d36e886a892f39644e632ad6c2263a18d4ea5c4fbd5576ba5b669528946258253', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:43:29', '2018-11-07 00:43:29', '2018-11-07 19:43:29'),
('9b6caaaf06adfdea93ac8e556c14cafbbbc5a6372350bb9a76cc5053c709a1d0ee6e19b86b5d5fa7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:41:36', '2018-11-29 16:41:36', '2018-11-30 11:41:36'),
('9e7add972ef2fdf32f2b15a3eb2f190f13179acec26a665ca0729d23356ba34969d9afb639c79d03', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:35:30', '2018-11-27 00:35:30', '2018-11-27 19:35:30'),
('a0f1abe426f95f10bf10f5018b2c720d91ea75cfd88b408ab129a99ff8ba47ad0cae83b261f92c56', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:13:30', '2018-11-28 22:13:30', '2018-11-29 17:13:30'),
('a19dfccd8a6252f6cb8b67093857ec4e280eea6adfbb3b423a6eadf3e3948e6e93d32c8804731ea2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:22', '2018-11-15 01:46:22', '2018-11-15 20:46:22'),
('a2cbf5884cf0d3a0edb6d745d52096a38a63b95526d9cf108a19c99f2f0f573f835986d50f576f59', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:31:26', '2018-11-07 00:31:26', '2018-11-07 19:31:26'),
('a308283db4377cd35548bb9e41e2e90add7089861b4d746038bfae42be40b55f3f03c04ad57ee05f', 17, 1, NULL, '[\"*\"]', 0, '2018-11-30 21:27:09', '2018-11-30 21:27:09', '2018-12-01 16:27:09'),
('a31bb24aff241b36e2db65f717a6031da528604c3043cd438cd71f84fdb0b0e0bba22cf459af2f78', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:55:58', '2018-11-27 01:55:58', '2018-11-27 20:55:58'),
('a367007a656639a2237f9fb898ca7c697afacad5a576cf630301d712b7b6a35daf91da8a54e46782', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:33:42', '2018-11-28 22:33:42', '2018-11-29 17:33:42'),
('a38f351e6d8129b062d898044c77155f6b274581f0d2e2dc6e3a5e985c251b99a4ab5332980f618b', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:22:25', '2018-11-28 22:22:25', '2018-11-29 17:22:25'),
('a4ce197a434757f8f4c10fd9b02e97c634bb36413c15b6077cbc366b1d02378fde354c47b14b05eb', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:45:43', '2018-12-01 16:45:43', '2018-12-02 11:45:43'),
('a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:32', '2018-11-01 21:59:32', '2018-11-02 16:59:32'),
('a5d35c303b0caa8b766baa33856f9641c1c0c326c73c6e959edd9a3d20198f48eea1af3d3d5a5e46', 17, 1, NULL, '[\"*\"]', 0, '2018-11-30 21:27:08', '2018-11-30 21:27:08', '2018-12-01 16:27:07'),
('a61685ee7aa364d16b790f41c9e6ecea51ed09b6df5a7e69cc4e029fadd59ae4732ed0ae4b6c2ca8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:08', '2018-11-15 01:46:08', '2018-11-15 20:46:08'),
('a78aec244fa6fdc3c379a89de5d87c81dd5168e8d5a42f9e2793f54d620420b0d369e59dd88485d0', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 19:19:46', '2018-11-29 19:19:46', '2018-11-30 14:19:46'),
('a7c0987a46ac3ced7d00c5d2bda0d1ff37f794acc19b76baacc38d5b164b0c2be9bbed56cf556af9', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:58:15', '2018-11-29 15:58:15', '2018-11-30 10:58:15'),
('a8a04e9199e7ef9573085a02efec1e6f2c7722b70494dd4cde28b7310bc93b3f613b4dba4ee6f7f3', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:05:22', '2018-11-29 20:05:22', '2018-11-30 15:05:22'),
('a8ab160268dbf75eebb635bc3788d741abdd83339eb990adffa6333a613c311c476281fae1fd6672', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:34:58', '2018-12-03 14:34:58', '2018-12-04 09:34:58'),
('a95905954bc92d7a2955ccf0badb886f37f5645817519ccd0e78b0cf516dc388d03e3db75cd114f9', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:03:40', '2018-12-01 17:03:40', '2018-12-02 12:03:40'),
('a997f49d9445ea92eec29f1172047a08ed8846d1b727daa2f4250bbd9b323a178c1789eba668b728', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 01:25:29', '2018-11-14 01:25:29', '2018-11-14 20:25:28'),
('a99b2ab25cfffafd20dc355ab8ef5a117f11b7dd4ef09d70d354e4800cf5965ccd5187a7b287b96a', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:02:48', '2018-11-29 22:02:48', '2018-11-30 17:02:48'),
('aa283d5a97cedbde852ed1f6bda72495c55b02516de84d452a3be0702bc318cf7b8f7d92192e10cb', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 23:41:05', '2018-11-14 23:41:05', '2018-11-15 18:40:59'),
('aabdd1e40b15776612ed769e7bfc99206ca8969ac99c366a5ab4624adadc35084a68a415bab64062', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:49:26', '2018-12-01 16:49:26', '2018-12-02 11:49:26'),
('aaf4cb54bd9442049a210929bfbc92d463b061b0ec529a9e7507fbd8348c78f5e8700e76255ffc1d', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:23:44', '2018-11-28 22:23:44', '2018-11-29 17:23:44'),
('acc389bca008e13b37bef267dba56c67c37f0909bfb9e320b807b1398fa8b00e78b7f28e9f692cbe', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:02:57', '2018-12-01 17:02:57', '2018-12-02 12:02:57'),
('ae0c05c52fc01af8b14cc7eb56ce44acfd7dcdc057a520e3524c18c1def102a58b77c75540f8ab60', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:21:57', '2018-11-29 16:21:57', '2018-11-30 11:21:57'),
('b03c93f72258e4dd87516a40b3da6e3498b938436509f78bfc49054dc7ffc5ef321b21129b853da2', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:35:06', '2018-12-03 14:35:06', '2018-12-04 09:35:06'),
('b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:20:26', '2018-11-01 20:20:26', '2018-11-02 15:20:26'),
('b084930759576e49fd770b3920a4c83e5b684d15e0c79b1b75f46d5b80835c292133dd1f365eb59d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:32:56', '2018-11-14 03:32:56', '2018-11-14 22:32:56'),
('b1bd5df09ad853c1f0deb4c3733baf6e2c826e6ab1750e82fe7bd5303c900fe00d16a574c8e6c682', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:18:38', '2018-11-10 00:18:38', '2018-11-10 19:18:38'),
('b25ded02527ff1637745006dc48c34ab45cc09cf7f3c6ce30ab4632967dabbe697acf715205191f6', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:26:19', '2018-11-29 22:26:19', '2018-11-30 17:26:18'),
('b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:05:50', '2018-11-01 21:05:50', '2018-11-02 16:05:50'),
('b38bf9c77cacb84f81a2d6abfc48364ca78f2ea19948c198e1aa4e8cc4a4cf1aa74730d0b2a3977a', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:29:30', '2018-11-27 01:29:30', '2018-11-27 20:29:30'),
('b3f45e1a5830b95fbed42eb4acf56825d7f856ae8aaeb37372f1db7f37711fd4ad1b79ab9c88d723', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:12:19', '2018-11-14 19:12:19', '2018-11-15 14:12:14'),
('b4649f511a6416d76ef8d03dca86d6c262a70734dc3044a924af37617b606057c2dea0dba58fc261', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:19:03', '2018-11-27 01:19:03', '2018-11-27 20:19:03'),
('b5b89535597112df675602f3f202211101ce34bfa7e7c1b60c94ffa16a7688d6fa2c87afea830d26', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:48:47', '2018-12-01 16:48:47', '2018-12-02 11:48:47'),
('b5c59adbfd24a111790ab731795eade90d3e260f028be74e5fab29699f69af8db9c0e3f9ce49c0dd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:49:05', '2018-11-15 01:49:05', '2018-11-15 20:49:05'),
('b630ebd270dd09f45d2d95881eef47bd33ae99f9820b76864a00ba6b9289c854dead7126fa65a243', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 23:30:46', '2018-11-28 23:30:46', '2018-11-29 18:30:45'),
('b64799c894adfc5a0619e5cf7296970a71b38047b3f13a0eca6cd69e535280442b5385391589dc3a', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:29:15', '2018-11-27 00:29:15', '2018-11-27 19:29:15'),
('b6a1cdb173211dbd6f68d169d74fcb6e887ed021509367592bf503ac50130a8b4623c269f037ba08', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:04:04', '2018-11-28 22:04:04', '2018-11-29 17:04:04'),
('b6aadb8ed13777caf919ba85a523bea3fb7aaad1dc23dd00250887cf170c59ffdc21ba07ac965aa6', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:52:57', '2018-11-27 01:52:57', '2018-11-27 20:52:56'),
('b6befdcbc6a8abde9b7aa0b504332309196f7314df001b974269e691bee9b21206d295b992a3c0de', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:40:46', '2018-11-27 02:40:46', '2018-11-27 21:40:46'),
('b7086c6bbac63724c48ea779253e591483390a20b5e0e3141283d24d511bd8b77f4f8257e8d01ed8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 17:03:43', '2018-11-29 17:03:43', '2018-11-30 12:03:43'),
('b7c50f863849c6f2b6c3eec49013bf489b4de0d76a4bdd046195d2d625711cdfcbc4b9ab71858bc7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:18:31', '2018-11-15 02:18:31', '2018-11-15 21:18:31'),
('b8490871552976bcd632a55d97df14d61fce55ae48d8f5d7eff0037b4f7a7bcdb8e864487f2f0c8c', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:43:15', '2018-11-27 01:43:15', '2018-11-27 20:43:15'),
('b8517a1f0173d744c151c0d78d754e29b319dc1e3f7b3b1b79ad5536c4df9d89ed6ef5c3a5a758bd', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:04:34', '2018-11-29 21:04:34', '2018-11-30 16:04:34'),
('b87f78b4ce12481f43948be378db7376c80734186a1fef17c552738d82e279ec64b140a67322099e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:06:29', '2018-11-27 02:06:29', '2018-11-27 21:06:29'),
('b88bb94d31a89b2b891f63cd87b09f397a8c29702a222384afbc6b28f3195d4739971c40e8676c9c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:52:36', '2018-11-15 01:52:36', '2018-11-15 20:52:36'),
('b9a3b481be1da27de8c68f30f8bd0d62edf463f347cc5dfe8aab827a0d46b8b7c3f85791d8cdd7b7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:26:22', '2018-11-21 03:26:22', '2018-11-21 22:26:22'),
('ba2ca337e994e8e39974d192d1efe9193b1a486ff4b1c6463f7e5c6cf4887a6b0c2b1bcc307ba2c1', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:19:44', '2018-12-03 14:19:44', '2018-12-04 09:19:44'),
('ba5170d762930c9c8616ea3574833f0c8875858670a758518c1070a44a41109c680cf4197f620240', 35, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:32:51', '2018-11-15 01:32:51', '2018-11-15 20:32:46'),
('ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:37', '2018-11-01 21:02:37', '2018-11-02 16:02:37'),
('bb148451a12a51a155d8bac396f08ee6b80bc5d2da32f58381efa793286e4eb6041ccad9c63bd5b7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:30:36', '2018-11-29 20:30:36', '2018-11-30 15:30:36'),
('bb2994c48b40d6b0ed3e7619ff32c54d2830795530271067569f764615e22623f67b7c7b81f622d0', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:22:05', '2018-12-01 17:22:05', '2018-12-02 12:22:05'),
('bb6c074b6b1f5475c748ebcfb829f5f7fe5081c78ba9bfeba28edce5f40d0df62bf560cb8ee7c1a1', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:05:46', '2018-12-01 17:05:46', '2018-12-02 12:05:46'),
('bc5b734c7582563f9a553b3c2d865861af3d1673977104ec1ea4cdc4abb6fe8c2d948f205cab2301', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:51:05', '2018-11-15 01:51:05', '2018-11-15 20:51:05'),
('bc9db1916f4a2ef77bf7d61b4eb755cc7cbd4a15e5bc9b3e4209485367858f4d7a2e3c6c23ebc4b8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:06:15', '2018-11-10 01:06:15', '2018-11-10 20:06:15'),
('bcd84b85ba160eca1d6639063cf3537929f89a8b939e18dd0a6569df636b96c181deef3545b0c5fb', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:25', '2018-11-27 00:59:25', '2018-11-27 19:59:25'),
('be7ca61cc8c98de6ef1b2667db48178c192aeb6cbe2b7648e65959b562133c129e34c26dad1e6618', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:23:32', '2018-11-29 16:23:32', '2018-11-30 11:23:32'),
('bf5ccc5deaf0903e6090e3a03aaadca452e5331a6e3a910a88ddfd70a7b64bbd5898e06d19627348', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:45:47', '2018-12-01 16:45:47', '2018-12-02 11:45:47'),
('c04424b9ccbb1fc478aa9a058a8f9335477ce59c9e8a5ba42c5aec42e9bef9bf857d98001b88b1a6', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:04:04', '2018-12-01 17:04:04', '2018-12-02 12:04:04'),
('c098217b30b7adc9d4e00829aa4d332cdc934111e2fa9d5b842346c3c7ca72d0e1cfb629c1e447b0', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:49:52', '2018-12-01 16:49:52', '2018-12-02 11:49:51'),
('c2524caec08ca0969e92211da832e92150360a01db065ef64d29d2197f071b0ddf0063405c726a8e', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:02:54', '2018-12-01 17:02:54', '2018-12-02 12:02:54'),
('c2b024ec8305d4e215e5ec7720cd2a7485dc2cd7eb7b97eeeef28806ac8395c81f560f7916d46fac', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:27:08', '2018-12-01 16:27:08', '2018-12-02 11:27:03'),
('c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:56:08', '2018-11-01 20:56:08', '2018-11-02 15:56:01'),
('c2fdd2aa164853e1531dde4946a73a9a2ca077ff51e0c8913949a0782ec7d3a4f01dfdfc19cf6ddc', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:51:13', '2018-11-27 01:51:13', '2018-11-27 20:51:12'),
('c32ff9c55bc74da15c7c589549e0a17a168dee12163a08b77e96bf702716eb3c23f1081d8a626f36', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:33:43', '2018-11-27 00:33:43', '2018-11-27 19:33:43'),
('c332c876f32271b8d489d7fba04f04bdf4a04af650c7177e69beae5ff6ae4c161e34a4b90ee0f24c', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 03:06:01', '2018-11-27 03:06:01', '2018-11-27 22:06:01'),
('c4561aa92e81b4e9f0b54176d2a98ec19326bc871c4960b08689c0bf525f260f787ef70bfc191d4a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 03:16:28', '2018-11-21 03:16:28', '2018-11-21 22:16:28'),
('c45ae7198c3b7962147955938b4e50b4a209ebc3d971148ae878994cc157eebd56e4ccb14f561b57', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:33:38', '2018-11-07 00:33:38', '2018-11-07 19:33:38'),
('c47eac0e04dc7938256385315c4855a78de14699e1fc2584c11f9bf20d86ad238f3e0a496696993b', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:37:53', '2018-11-27 02:37:53', '2018-11-27 21:37:53'),
('c48557585c005cb258561ed382d48119d698990c44c356739023031c62cdba0b0559c2821dd4f185', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:36:31', '2018-11-29 20:36:31', '2018-11-30 15:36:31'),
('c4d8738e94372016931a8856e8dd2f45cd990bf95c856c7d663f2295c955c2c37f69640a4af63732', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:45:09', '2018-11-29 16:45:09', '2018-11-30 11:45:09'),
('c54737712afe14f3d7ac136148ab85091d0a84253a3b7b835b9ce1c415a91f0e540110bcdd8cff7b', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:32:23', '2018-11-28 22:32:23', '2018-11-29 17:32:23'),
('c699f02a398940d5fd74230ff91552bbc79242c2d3409f1e920c2e0e1400fc1c239671a7513d7e99', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:33:19', '2018-12-03 14:33:19', '2018-12-04 09:33:19'),
('c6e9b556edda02599fef1aaefa4b68e415da957cede3680f229a2bc1bedee93a1bf856411902d857', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 19:01:11', '2018-11-22 19:01:11', '2018-11-23 14:01:07');
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('c762b5f0d75feb25202ff6d6ea617ab2230e2314940dd712af73b11f539fa67cf0f86f08502354c3', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:34:11', '2018-11-27 00:34:11', '2018-11-27 19:34:11'),
('c77787f8603d6da7cda7ac9956d3f721be19580c521d5b2f04c3b717d092846e57c40dfb02d158e9', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:25:08', '2018-11-28 22:25:08', '2018-11-29 17:25:08'),
('c7786bbd110ea330db7e004f5d883f08adf5b6e74ac0c7e7cbc86cb62d120088827ebc0abe13b8bf', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 20:10:18', '2018-11-03 20:10:18', '2018-11-04 15:10:15'),
('c7ef4d5fd6e96403af72064f8912244ab9ce40abcc80bf5bc098bd084fb362f88e0bef00773bb1fd', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:30:53', '2018-11-28 22:30:53', '2018-11-29 17:30:53'),
('c7f8e2fb4344a31dcf31a8f393bf741d2c1a217e62b88f003a7d6c55899319270cf061a13823695a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:14:13', '2018-11-07 00:14:13', '2018-11-07 19:14:13'),
('c94a43b3faf6ad4f39de06e35ea1abb3f82408a44e3b50022e82453868b0b4e3a942c4e119380e31', 5, 1, NULL, '[\"*\"]', 0, '2018-11-13 22:40:12', '2018-11-13 22:40:12', '2018-11-14 17:40:11'),
('c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:26:03', '2018-11-01 20:26:03', '2018-11-02 15:26:03'),
('cbe11352ff9e00bbe08703fba6302a044f936dba028e77903345e0dfa019857af54ff7523b909adc', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:46:12', '2018-11-29 15:46:12', '2018-11-30 10:46:12'),
('cc14da9269a01e228a582bbfdcad60e2c72dc6b9e82e18c1ee8cff30b27b60229e5aa2ab9e3e77dd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:58:29', '2018-11-15 01:58:29', '2018-11-15 20:58:29'),
('cd59822f006ebca1283bb9ce3224cbf04b2ed830ae08cf5a6c3c651b6f1fd05e10ff8ec8b97298f1', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:09:28', '2018-11-28 22:09:28', '2018-11-29 17:09:28'),
('ce3c3dd6056624558648c53d539112d8eb32dd527534d971952f8651446703a175096653b69a4c92', 29, 1, NULL, '[\"*\"]', 0, '2018-11-06 23:58:46', '2018-11-06 23:58:46', '2018-11-07 18:58:43'),
('ce5046a6fbece6911567ee0025898c04bc4dc7e6789c0348cdbfe656d484eacb045dd9ce9434467a', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 21:09:08', '2018-11-28 21:09:08', '2018-11-29 16:09:05'),
('cea6036ebb389b7efb557236fe8283402a48edf26514d5cd3c2afa5b4922d9da8050f7a217471ec7', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:28:29', '2018-12-03 14:28:29', '2018-12-04 09:28:29'),
('cf8756fdb72dc89cb4f72f1c4bd80ec51a45bd5769e97fc8278e80d79e3bbd5cfb74169d9b00048f', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:05:08', '2018-12-01 17:05:08', '2018-12-02 12:05:08'),
('d13f7deb11a75cd135c3871d6d911f7fd6ecdd0c62618444018960fd63e14e0a2efa683a94e6eb93', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:34', '2018-11-15 01:47:34', '2018-11-15 20:47:34'),
('d1401edaaa28c09473c41c4bea1fa86df91263c54d6e291d07519753f2c20eb6793749f3ccfae849', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:22:24', '2018-12-03 14:22:24', '2018-12-04 09:22:24'),
('d176548485eaf9d6339dc431e3724e7c7c47906ff4fc58ae5a274b25f90610db51d8e4f0c88ab93c', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:46:48', '2018-12-01 16:46:48', '2018-12-02 11:46:48'),
('d2935526316482c152e4587ff8133e411b97aa152d952922f21eab7641a9f4c9b9ce420e8ba64351', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:32', '2018-11-15 01:46:32', '2018-11-15 20:46:32'),
('d359a224fce51322b683e2aa9ab667f08f01279423198af73807daa0774433d002e547fbd6b75943', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:44:07', '2018-12-03 14:44:07', '2018-12-04 09:44:07'),
('d35de1dee55646fa086acff4d97868c4ab27e8799dcc8390eebf179b42c3641505ba0bda5d1db79b', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:08:32', '2018-11-28 22:08:32', '2018-11-29 17:08:32'),
('d426a11ee43ef4ab2a613f033ff584d93604090ae48b21eb4525a5f997f5d5520274ae7918671d0b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-22 00:20:54', '2018-11-22 00:20:54', '2018-11-22 19:20:53'),
('d459838c22bfa168d9236ba596e21e32580d0b425520c0cdf7bec7d7bf32503d5ebe30f34cdcbcd7', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:02:31', '2018-11-27 01:02:31', '2018-11-27 20:02:30'),
('d51c610d9a3792eff87a1341ae36ddab02a4c796e657a693689f70ebe648c97e7d4c223cf9cc6c07', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 20:49:25', '2018-11-02 20:49:25', '2018-11-03 15:49:23'),
('d52af45d282197f41731e7ec711ab6dc62875d22f1235ed8e10ddf59461d53285307409881cfecb5', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:11:45', '2018-11-27 02:11:45', '2018-11-27 21:11:45'),
('d5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:27', '2018-11-01 21:08:27', '2018-11-02 16:08:27'),
('d74a4f2819eb4830809b5e7b903c3923dce76f2fff491ad6071697823f7c0f3162be793124387371', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:04:39', '2018-12-01 17:04:39', '2018-12-02 12:04:39'),
('d7a152df1b30b71dd23d7f12dd7540b636a92d55879d00c2487e56b00f83b185c17ce4a95cd15585', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 18:56:08', '2018-11-28 18:56:08', '2018-11-29 13:56:06'),
('d7e87fb06459cbff41bdb715dbba003159366ed0816c10a6d9c85c584ce8cab3c61f4663b0f5df64', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:22:22', '2018-11-29 22:22:22', '2018-11-30 17:22:22'),
('d89f8c9a7316e0e1773a7d9b9787f19c1ee5b3fee1fafe63c8d082a65ee7829286a71834088ab47c', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 03:06:50', '2018-11-27 03:06:50', '2018-11-27 22:06:50'),
('d8cf67f8b039a5ee1a0867dfc2cb3ed29c295791cd9e736a6ba3252a7de6e3f9df0fb23545e8d3eb', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:55:43', '2018-11-29 16:55:43', '2018-11-30 11:55:42'),
('d90cda9748d4e6d23f2c1200ecbeb823a0262f1c2cb370dc22793d78c57b12c0726eb75e4b83bee7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 17:01:26', '2018-11-29 17:01:26', '2018-11-30 12:01:25'),
('d973e17a483be2774819f4d07b2e9ea612d77d4cc1ab8e320adc0706a9f351f0f15f43f60fa9c062', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:57:14', '2018-11-27 01:57:14', '2018-11-27 20:57:14'),
('da2ed132c08932fa093ab7ad20425ff3209f2db847769b928952d36215f6c5990260b4399b3b1ef7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 22:17:15', '2018-11-29 22:17:15', '2018-11-30 17:17:15'),
('dac308744696aad0f197c6336443a13656f79c56cadf125a054e03e654e9055e1ed18d5fb967fc5b', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:22:19', '2018-11-29 16:22:19', '2018-11-30 11:22:18'),
('daf5fe3a24b7ae97536471cf5e11e66a876496451cb14f8d830360244d1bdaf04c44f9a82c8f80a1', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 23:43:22', '2018-11-21 23:43:22', '2018-11-22 18:43:21'),
('dc04a737ce7169cb09c88d43f4598cca335b1c2ec06675e02e651a69f32f6205e2187b4c981dfc4e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 02:13:22', '2018-11-14 02:13:22', '2018-11-14 21:13:22'),
('dca81bf2f5b6e7d7f4db4d45ba20cf64b28d3339492267256339cdfda1faad31bdcbd38b0e754be1', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:41:08', '2018-11-29 20:41:08', '2018-11-30 15:41:08'),
('dcda87de2bccb3887e49c12aadd0134ac8a271233e890bfb5dce1bb48f6d9050c8708d2c72dce326', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:49:55', '2018-12-01 16:49:55', '2018-12-02 11:49:55'),
('df5e99bcee850046416959db2e4c59808131f2c992a3f7503c1eec6de20401b88be44b7e54724c9c', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:04:34', '2018-12-01 17:04:34', '2018-12-02 12:04:34'),
('e039c6d3b0910c91500158287a25cf512ad9d4f6f9b45b71ef95eb16f052e6ebae02abc1c2153e00', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:48:41', '2018-12-01 16:48:41', '2018-12-02 11:48:41'),
('e11475201aa87316ed623c4a7a626f62bd7e6928e3788d9bb5e03db8f1735ed7b9f260cf350d7012', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 01:54:41', '2018-11-28 01:54:41', '2018-11-28 20:54:40'),
('e20026ffddda27e4eb1e25b4c5f5fd0e81ed6ffe116b59c7a32a9f08454ad00ecb3d7d929db9b755', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:15:42', '2018-12-01 17:15:42', '2018-12-02 12:15:41'),
('e343764dce83b36b2e69f4484dcc5276722b481e6104fd983801170a282f60fea7839d55a6394c32', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:20', '2018-11-27 00:59:20', '2018-11-27 19:59:18'),
('e3e4aac6e1a158df8092a7845b570cffbadc44d5f9966866eab1ae1319b596a041ca57c951c76cd8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:22:25', '2018-11-28 22:22:25', '2018-11-29 17:22:25'),
('e560c1038789c555c815afc43c7d321aca2428faada47e9eb8095dba20976cf00e959320bccbf640', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:12:49', '2018-11-14 19:12:49', '2018-11-15 14:12:49'),
('e7f4f287983ccadb79524ce78092cc10cd456146d77c66af71b1d0e8ede0d07e095ef15bbd48f733', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:25:42', '2018-12-01 17:25:42', '2018-12-02 12:25:41'),
('e8eed6fbd5728f0ce8974d9f395bc29f0e700a256b57da76a4649d026231f8f8f65ce0b5adf03287', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:15:59', '2018-12-01 17:15:59', '2018-12-02 12:15:59'),
('e971ce64e958a4b515474c8b764ec4014fec2f0b851967eb0c621a393f1d467dbc7af4dd4c299755', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 19:35:19', '2018-11-07 19:35:19', '2018-11-08 14:35:19'),
('ea39cc9d8c848771c9ac26fe1651aef5a0114412fc3298dc709a930375b63aaf47fc4306427fdd9b', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 16:40:28', '2018-11-29 16:40:28', '2018-11-30 11:40:28'),
('ea4030b0e4434652e20c510d8d8bd1efde4f26b017a4ef4baf47e7e8c0b3db09e059fd12971249de', 35, 1, NULL, '[\"*\"]', 0, '2018-11-14 21:59:11', '2018-11-14 21:59:11', '2018-11-15 16:59:09'),
('ea8f5d94f3dbd9e53a1254bc18e05ceda0aa24cd96c81ab991be74e2e23a20ec61597c3dc787db9b', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:34:17', '2018-11-07 00:34:17', '2018-11-07 19:34:17'),
('eaa3c2ab1df047f392183de45a4b395a04f0a3309c586c3cee8724ba712dfa20d0cdd10319ecbd05', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:25:45', '2018-12-01 17:25:45', '2018-12-02 12:25:45'),
('ebb3b879c8c79deb48c3da7147dfff0591d7f2e4905a5272f31adccf19da1565f19c73da85d8e9e8', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:14:57', '2018-11-29 21:14:57', '2018-11-30 16:14:57'),
('edb454f6a2b5d8cf1d8c90ae943c4f029ecc0cd47bf854caab3388c16314bf471877537b7262c605', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:01:42', '2018-11-15 02:01:42', '2018-11-15 21:01:42'),
('edfc94577fba9d4a52e91cfeced7ceaf63b8060dad62f97547b174b3ce486a2fa865fc5d503d96c9', 35, 1, NULL, '[\"*\"]', 0, '2018-11-14 22:10:15', '2018-11-14 22:10:15', '2018-11-15 17:10:14'),
('ef81eda3345791218b48451301b8e0ba2066f3636083743f314886dd338aa562abacc035077cb90a', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:47:12', '2018-11-29 21:47:12', '2018-11-30 16:47:12'),
('efab4b13a5f40600bf81f4d8f096d2422977703a90a455461c2cd916d54e6a03f66a71af0183f4be', 18, 1, NULL, '[\"*\"]', 0, '2018-11-03 20:58:23', '2018-11-03 20:58:23', '2018-11-04 15:58:21'),
('f1294337030e7a975a446937b255c12e60c6a1f06e89e14f0328ee9cdd7b581c3833f31e42d009b4', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:25', '2018-11-27 00:59:25', '2018-11-27 19:59:25'),
('f158342c1ab69df7cc97d886e0ceface483740480b96d99afb824cc358be8bec8af2b726ac41ae7c', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 15:28:42', '2018-11-29 15:28:42', '2018-11-30 10:28:42'),
('f16288d3d55f4b428b26e04815507f00a54d15b78ae6370bd8f2e621455ba79b0eb3688cd8aabc89', 17, 1, NULL, '[\"*\"]', 0, '2018-12-03 14:29:41', '2018-12-03 14:29:41', '2018-12-04 09:29:41'),
('f23c7c5eec357e163786790ef9be93a120666e85a0e83fddf9f802613cb4969d9fa12d03991359ca', 5, 1, NULL, '[\"*\"]', 0, '2018-11-21 18:58:37', '2018-11-21 18:58:37', '2018-11-22 13:58:37'),
('f276fb0f6edb1158535133598ebedf76cea2bc1ace12c4f71499a27c54cb9eb8b630e8cb84668e0c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:16:06', '2018-11-14 19:16:06', '2018-11-15 14:16:05'),
('f30ff10032e72eae7a6ccf2510f24ebe36892dd548125d74e4d7dd352f4e643c617044ca784b9bf7', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:53:32', '2018-11-29 20:53:32', '2018-11-30 15:53:32'),
('f41a8c78d61b9d9b89abd599d0b97d7bbfad75cbcef21f9430ea0d43139391e8ff64cc293287d811', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 02:54:25', '2018-11-27 02:54:25', '2018-11-27 21:54:25'),
('f7b7b1c1db46a4822c463708c71c329e58184c72f3c233e8eed873257208ef788eee05df1de07d4a', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 23:20:37', '2018-11-28 23:20:37', '2018-11-29 18:20:35'),
('f7d585c34803f9d0cde35b434936c8a0f0de1943c06e6856a58cffc541541319bad0e072b89ddc32', 17, 1, NULL, '[\"*\"]', 0, '2018-11-30 20:44:11', '2018-11-30 20:44:11', '2018-12-01 15:44:10'),
('f80a5d37826b936282fd65a90ebdab5d9574667bae196651c15548d5de79bbd78bdb33f7c3c2fba7', 18, 1, NULL, '[\"*\"]', 0, '2018-11-21 02:59:42', '2018-11-21 02:59:42', '2018-11-21 21:59:42'),
('f8d4d63308ab809d67999bba766be2d6644d070f5d73cfc92bad767c20cf4b1c12f9cdc236cc7c3b', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 01:23:46', '2018-11-27 01:23:46', '2018-11-27 20:23:46'),
('f8e442db25b00428b7ae856ae7710c2f974363560e06d70517d980ecda181abf00791cf48ff3039d', 17, 1, NULL, '[\"*\"]', 0, '2018-11-29 21:10:11', '2018-11-29 21:10:11', '2018-11-30 16:10:10'),
('f8e5c3729e53028d11afbd862b61edaf45cc7feb64d6c14a44ddd174abfeda379e14db402f8beb5c', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:05:56', '2018-11-28 22:05:56', '2018-11-29 17:05:55'),
('f92c652714b810262e9388153f5508596dd626545e905c29c5570cad77b572b0ce80183662e9c704', 17, 1, NULL, '[\"*\"]', 0, '2018-11-28 22:12:44', '2018-11-28 22:12:44', '2018-11-29 17:12:44'),
('f94e50b41b5bab08a7671bf8ea403c72e6dab0c5be9b2fb88ba99056cc409c7c567830f3e9e0d871', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:50:02', '2018-11-15 01:50:02', '2018-11-15 20:50:02'),
('f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:35', '2018-11-01 20:28:35', '2018-11-02 15:28:34'),
('fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:20', '2018-11-01 20:24:20', '2018-11-02 15:24:20'),
('fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:25:48', '2018-11-01 20:25:48', '2018-11-02 15:25:48'),
('fcbd116a4a20f5ea09db4c59f033d56b65b503121d4b9af129037baa75b51f80292e867b8f1f871e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-28 21:44:51', '2018-11-28 21:44:51', '2018-11-29 16:44:51'),
('fcbef178dd13210c316beb788f455483654614fc3ed5f80f5b23c6ac95565f06c270c0ecc30ba7e5', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 16:49:03', '2018-12-01 16:49:03', '2018-12-02 11:49:03'),
('fce23485fef1971e9b07c16eff2eb47bdec66319fe423d6541383e3e74a0969b4536dc890bfef6ae', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:00:56', '2018-11-10 01:00:56', '2018-11-10 20:00:53'),
('fdc59e1207bf0d143abac71aeee5b8cb9ec9f0ddeb820fd96e323263b47353babd17618f730ca230', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:59:20', '2018-11-27 00:59:20', '2018-11-27 19:59:14'),
('fe0f0a61fb3494ca78f1e336d259971d0e5edc89e475aeb8f27b064943081b523b4a86d03738ee96', 41, 1, NULL, '[\"*\"]', 0, '2018-11-29 20:32:37', '2018-11-29 20:32:37', '2018-11-30 15:32:37'),
('feac7ae96f08266bd5eb56990382f8e995c51bae5b6c7566616463d60ac061bd8cdd886f5844bd4e', 41, 1, NULL, '[\"*\"]', 0, '2018-11-27 00:28:24', '2018-11-27 00:28:24', '2018-11-27 19:28:24'),
('fed93845f8624db333ffa440659ea9f0cfdab88ef06f47ab87309b79327782e53914a6a48d066818', 17, 1, NULL, '[\"*\"]', 0, '2018-12-01 17:22:23', '2018-12-01 17:22:23', '2018-12-02 12:22:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'cudris', 'HtVlCdYlRJuMWOgEtJtGN2NMIYmnP4u8GeyGz1sU', 'http://localhost', 0, 1, 0, '2018-10-31 01:38:29', '2018-10-31 01:38:29'),
(2, NULL, 'ronaldo', 'igU1utYkSsbypgN2xErxJbONsgsM9na26Rf87olf', 'http://localhost', 0, 1, 0, '2018-10-31 02:31:13', '2018-10-31 02:31:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('01465efd34e1e6ffdde1813c47d63cd7e954dcedf6e7c77d148fd806c2fedb148d68cf0d6c95f10e', '6bbeebd2f0d412a026d2f4f9c6802cfebf427e6567e3bf91aff0d8a27e2437deea5d744343d25eea', 0, '2018-12-26 21:52:57'),
('01910dab201a35706a688224951ce744a32455dee58c16663382feeb36fc11b9f72509f30bf0df12', '03f3b275fd0759fc246f386887ac4990b93fd8923f1f5a679a18399d771387bac7d9fc44123e021f', 0, '2018-12-31 11:48:58'),
('01a746acf1b42cbfac3ad84e4837b9713f4791d97cd588ef52816fc8caee9f9846234c6e46bb47fa', '508243a82af3dc011bea7e56b5a6024c1fb0957bfa791849b81e4832d3f51f5a0c7e80eb6bae5bad', 0, '2018-12-01 19:59:39'),
('02443467a2e8d30c2303c8c99da32a5a630332a10f72346a400120dabf2c0c8b6667ee7bf957cef5', 'a0f1abe426f95f10bf10f5018b2c720d91ea75cfd88b408ab129a99ff8ba47ad0cae83b261f92c56', 0, '2018-12-28 17:13:30'),
('02879985f8da1907325b8fd50791f4c3800758d527bc426f3f2879c2250fb964116a83e8cccc78c7', '1c138d7d27550c6ace5b52ab496a9f75b4f7706fcd5b74e36dce0eb3fa980bc6c2fd49ccdc9e2aa4', 0, '2018-12-09 19:25:11'),
('02dfe74babfeee3840bf924e2ce4d41cea714c7b8155487273bb5119637fd7afeada6cc05deda287', 'b25ded02527ff1637745006dc48c34ab45cc09cf7f3c6ce30ab4632967dabbe697acf715205191f6', 0, '2018-12-29 17:26:19'),
('0319817900fc28ff025be9466ccd9b8e2804b3377d5bd04aa49408ce983869c77293f3bf435b93a1', '5e4936a20fddcfb36104aa4037c3c72be1a572697f53c4c527de363c48736afe9c6925c28bf54aba', 0, '2018-12-29 15:40:26'),
('078150626af4c3d7a4dbac1f631c4d37d9ebe6d4340a334584b4fcb9cedd10f7936d23db82230a0e', '4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 0, '2018-12-01 16:20:05'),
('08a106a849f9b1032c936a3eec73c81b788567b1e9649895d9ef4fd10d7fb7f72f956d266c587b8f', '856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 0, '2018-12-01 15:59:51'),
('08b7165259074d7110835abd42f36b90d0fcd96b011fdcb6d174daa2731fa6b318fad455a2dd1acf', 'c4d8738e94372016931a8856e8dd2f45cd990bf95c856c7d663f2295c955c2c37f69640a4af63732', 0, '2018-12-29 11:45:09'),
('09599a550284ff909e138ad55829059c9ad6e2a8f06d4c7321ffc4d3ee516f385209ce49a8532313', 'cbe11352ff9e00bbe08703fba6302a044f936dba028e77903345e0dfa019857af54ff7523b909adc', 0, '2018-12-29 10:46:12'),
('09e990d37c091cf68c04e1de53d4c680fa8b8a54add0e6cf0d11cd7c4be83a734ba5966afaf1d748', '5fb5e4dc7237f496be72f6c247c9ac02bb7249862d10f19ece2e9d4b140995dbe835b053d9c21f90', 0, '2018-12-08 21:04:33'),
('0a396d6c9d5e50022340bff6546a39463e3827e5e690e7616831d7ac1bae25f6e571fa69d2b566e5', '1d6377af047073965ceccd43a765adbc7b299e705aea22a21e2f9ca0769346ef003506e8d7c08539', 0, '2018-12-14 15:11:11'),
('0d6c7f3f0054e40e02b11ceb63a2464c6d65eb3d87e3ad9ebf8ae80a37493aac438eb2dd23c11be1', '6145557d4ac916183e226f1c606ea9ff5950e59e20be898cc3b439758fd72657efb0546edf74f66a', 0, '2018-12-31 12:05:11'),
('0e8c6c76c0a6946bac9ef394bb73cb2f5a55d4d1a4edfe9675389dc27c700f093136b2691a5dd055', '7c52127e134f1fc168599c5d3f85594852460d9a6e2573718e02039d128bcb167131cffbdc1a6095', 0, '2018-12-29 15:13:50'),
('0f517964a0e850547eb665d0e0e4f81175217494d4cb51e7e5fed876c9ef385d29653b0584b4876b', 'b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 0, '2018-12-01 16:05:50'),
('0f844d7ce394e9ce2c8e1849dac16094d888ac455489a1ba99220d1a362c1dc5021756e22788d874', 'cc14da9269a01e228a582bbfdcad60e2c72dc6b9e82e18c1ee8cff30b27b60229e5aa2ab9e3e77dd', 0, '2018-12-14 20:58:29'),
('119c43c6324c50364a7851aa108552f0da0a680fa328413bffbf7e8e97218306d17ef5d12fca0244', 'edb454f6a2b5d8cf1d8c90ae943c4f029ecc0cd47bf854caab3388c16314bf471877537b7262c605', 0, '2018-12-14 21:01:42'),
('1307a9aec4332a4a4b4f860feb0ed794b04d8f0213925cddd922d7413b6ded7f268bcf44befba2e6', '543f6a1a78fc9b405f51d96a61c5fd09145d8a26e770fb6bd783e3c551b009d9ecfe5a71808b0499', 0, '2018-12-28 13:58:11'),
('1385c9e08ca7b7057f5501c0dd14851590d3302e2d437a8b2cf0c2eb22c35d64fd2e0da85a72840b', '644f24ffe0c8bb6072a531360446b77acfeafcd74c1ce80eb6cfe22b2855c09e8785f2af6fd8df96', 0, '2018-12-29 15:54:33'),
('13c33a5b19b4f380f6d90fd234d5a78168e3bdfabf84f15e42e29f2ac3dff3b3de253b3051b59785', '1a85bd33cbe1b4b723e160e1781685bdc8cf90745029731f2933ceeaeb5905bbaebd7241134cc24d', 0, '2018-12-20 21:36:30'),
('14020f96e4c325324e656262a669a74f0b0cec210cf16bd3a0b7fa7b036a415a9ab627cd2e8c5dde', '487ee222eb2b05afb34c9c872dcfb5e8bf3b270295a644379b2c9f7ffcc8d030009df31181d4b58c', 0, '2018-12-31 11:59:47'),
('154a5b9fb13ca35bbc8f871220b8642e028a7a3ab1f78419ac27a36289ee1df1d2eff4c7715849a8', '36c8f9fb52e49c1801ebb9d115ab45799066a4da41aa7894e157039022c8de80da31327b4b8a529b', 0, '2018-12-14 20:41:33'),
('1696d46f3ca7666768108ecf21d0460d53779ad29aa25ef3276696fa9cf97e5551a5bc39d5d680e9', '611890e4735e67786045a462555063af3c87ca390dd4039075fcb9cd8e4c8e440b84c4bbbb970071', 0, '2018-12-30 14:56:36'),
('17cf77d6ace0a0411c49043ad2ebaa80bf7df998f6c7756c9763885683cdf544aade1747918d23cb', '3f94f536ae868d4973b63b8ed2918f313bba799532fcf79d8326b3726749fa49f4b235378db1be23', 0, '2018-12-08 21:16:54'),
('1814f73ab8b153dd8e5a70d5b8404718172db290b7bf7f3c89ae2d1cdd29f33bc608f6dd4ea4fab3', '53b9e684b82c30db819e8a8a103651434f7b4e8a7785500b82668a7d07b6cb880870f850f0892667', 0, '2018-12-01 20:05:35'),
('18b82cbbc26067f97f756d604af1e69d52e85d5503f0e4697368b1d399479f3e0506db4f27cae66f', '5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 0, '2018-12-01 16:04:56'),
('19add29023929cf823acc34443e27e73949201c8193795f796c12f1ddcf9413ef04e6151b1614529', 'f7d585c34803f9d0cde35b434936c8a0f0de1943c06e6856a58cffc541541319bad0e072b89ddc32', 0, '2018-12-30 15:44:11'),
('19f7afcfff88d3b01add70f984bd48a575fb5825d9e31afd0f8ddce498ea7c918dfc2e386427d8b1', '293d8f0ca7809f9c731b986dd3eeb37404e07b6c6b50b94220fb8cf08a381fb83445216b8abd545b', 0, '2018-12-26 19:37:15'),
('19feb6fb1ec03e13d854065344aa066b341364358bb863a86b52eb3d6bb1c1f17f42d209f13d6d86', '73cfa0462199a045bd425bb67150c294cb83fc815f11db7032d63f01545f7b2bfb59007830d22faf', 0, '2019-01-02 09:53:59'),
('1aa35f7dade8c3cb34fc9e125d2465fcb10bf13821f00790d0a253fbd6a73ea4b6f6846ae2f3f5df', '75f5bb9788f0e2d1ba7d346d6433d13ff22ba2cce3f100db792b822d41ec93b416f697f262bcc989', 0, '2018-12-26 20:31:20'),
('1bf87b4b6511a8a7b371c816a4b505699ac2d64d3dcf08a0cba05c92ce9f6d3122e5c807c5f45756', 'bc9db1916f4a2ef77bf7d61b4eb755cc7cbd4a15e5bc9b3e4209485367858f4d7a2e3c6c23ebc4b8', 0, '2018-12-09 20:06:15'),
('1c329ea5b4c02345151dcf54dfb5e62a4abf7b27e4856eca3bf686c1221c2b23192334de32853e0b', 'c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 0, '2018-12-01 15:26:03'),
('1cc10f02f7d1dad68f4c835db9080dae637e371344e01874948ea34574c9a8e631d12e037291901a', '1d403c575c9e0c621aedc54bf0e5ac69d3c03c5eb81baeca63d35d335765c656b56d1a3220ac7023', 0, '2018-12-26 19:59:25'),
('1fa56c4ae29a741f0be79b7e60f99a6f6d1ce8a73f6d928390adfdd93781f2b6006e981239235e2c', '6cc362d8f25c5a18530afa4e75508c471ff44103555b9e056f55ca95d2210333cd84f97d7116be76', 0, '2018-12-31 11:59:44'),
('20b4ea1efcf66ecd9106504759b032f8e64d4bb3102b70b309bdb16416b8e19f69b251af4256ced5', 'cd59822f006ebca1283bb9ce3224cbf04b2ed830ae08cf5a6c3c651b6f1fd05e10ff8ec8b97298f1', 0, '2018-12-28 17:09:28'),
('20c5997ca38135e1ef707227a240b928774568b49bc73acb30e4e329d646fe898d23dbf014321ada', 'bb6c074b6b1f5475c748ebcfb829f5f7fe5081c78ba9bfeba28edce5f40d0df62bf560cb8ee7c1a1', 0, '2018-12-31 12:05:46'),
('2158a84c72b48514a3f61dc85e3242c5071c06f9a6576ed8fbfab3b854240b9a761c48efe06d76cc', 'a38f351e6d8129b062d898044c77155f6b274581f0d2e2dc6e3a5e985c251b99a4ab5332980f618b', 0, '2018-12-28 17:22:25'),
('22f97429fcde116728c1b18ad90ce24d137586789b95c010ab8bea2aa37a3918fb19350c949ebaf7', '2699d9dc01d7438b6c333205efdae42160d035560909a25b5e1fc433cd1bfabaa83d189eee0e5f66', 0, '2018-12-06 19:33:57'),
('238091d1fb5ffe541b682d795fd9107d4a31166cf2ba13032739993ad019a6c4a0d348861e5a9310', '4356d217e7b984cad7e0d6fac25188099790d170c5e766431d3c1bb5aa20929625b3c796df23772e', 0, '2018-12-31 12:03:36'),
('250177c88d0542253eca59ef335d9cf7c371f22821dd6d24a4a0becad241b6981372bd3ecc4a50b9', '3c7eea6a98a408614bb2a94580f5bb641b1a5adc5984a6a6c6a997b9a8d1a91d6ce534da71bd2f65', 0, '2018-12-31 12:24:41'),
('25528bd28006c20acedded63c789e50ea4d0f66b809de9854cc177bc2960cf6ecbbcec6865e7e21e', '87dca1f0a7020d558cb005686737772bbc7c14b3aa39fdcea7c2c617f2ef94d6bd71ce0aa0850a91', 0, '2018-12-21 13:37:18'),
('258ec220ef9f3492a5aaa3e3ed02dc8d757d86c298b4e556b760dba310be670b96058d74e40df682', '6f1ee8aafac3de4aa722ceb75bfb93b5656324698590800e30a36d175cf849322f0e24b7be70d840', 0, '2018-12-26 20:02:29'),
('25e4a253a39be27e98d88f94e61d8d98625e248ed57e4755a9935a028a999f189c660a06329f3695', '136db9ed2c7475d6d260eb309ea0d58e7c791a7ec4d5a7204ce075d6caa832ebcace2e68bb02bc1c', 0, '2019-01-02 09:19:34'),
('26baeb8dba0be3d4ad591a06ec221d2d80097435a68464c20549ddc102b37e1b546bc066bf930365', 'd176548485eaf9d6339dc431e3724e7c7c47906ff4fc58ae5a274b25f90610db51d8e4f0c88ab93c', 0, '2018-12-31 11:46:48'),
('279ba5367496f192d6fc254bcc87a63a8a8f82b2af68bf13afd310aebd1f7685370c89484dd7af8e', '6c229799c74e7c0c7ba0a1ba4662156f08ab2066e227943ac4c8694d40829fb4b002a08ffdaecf94', 0, '2018-12-26 20:51:59'),
('27d3e6c89af5a2b0930b21210a3d3c7e855e8a2942f029ab05070312cd71be5ddb18b54739754dba', '852e3046cfadae97b328144da51401cef2b44e32c33939bf680bad2446d2bac28086afdb68786af6', 0, '2018-12-29 16:35:20'),
('28466b97378c472e987d6aa1e8bc7e86b89b8fbb9716eb13ec5c84b4200d2a8abcf50fbaf323c25c', 'ea8f5d94f3dbd9e53a1254bc18e05ceda0aa24cd96c81ab991be74e2e23a20ec61597c3dc787db9b', 0, '2018-12-06 19:34:17'),
('29483f51c09b66538a04a62f58df7d3575dcc2bd7e3188f46be415a1cb696694bcbefbdf1a7c5f19', '55c9d617dc963ce793be18197d290b7b7dddf0541d9f01d6f9cc2708d268659c9793b38d0e213dc1', 0, '2018-12-20 23:49:36'),
('2adda6dc78d66f84662ab2127b16fb7618bd096edc89ac841838e497866fb64ae588a70d8fa98418', '076f64ebc5cf61e43cfbaa5ae39ad62c34427049efbdcac8edc4e5fe0a82e55ae384d8c145f64384', 0, '2018-12-21 13:58:03'),
('2b1c79a33e59bb569dab8d60f267c5542f6cfc41dd536c54e29cd19af06d89b1beeb031db7a9337b', '5d1aa2e4eb5ab82443e27768ff86c9fda15db9de5b7a601751ca07cedf2841cf4fb63ec46feb4cfd', 0, '2018-12-13 22:00:02'),
('2b840355da08ef2e8e16f9e1a19eab401b7c79703ad66654df3371bbd7573bbbb84b700cac5dbac1', 'fe0f0a61fb3494ca78f1e336d259971d0e5edc89e475aeb8f27b064943081b523b4a86d03738ee96', 0, '2018-12-29 15:32:37'),
('2c112fb11d74a5ead08635726a2e5ce7f6c1d4350992ebe69e62a11cfcbf3ac963c33b355b7d52e4', 'b7c50f863849c6f2b6c3eec49013bf489b4de0d76a4bdd046195d2d625711cdfcbc4b9ab71858bc7', 0, '2018-12-14 21:18:31'),
('2d278744ceebba6eb2a668c84817abcff8ec64b2607ec4e7dc310e3598920cf778155b7fee244960', '5e7905375083b90e73c4926101867f637d447f98bcff7000deeb4c04e75e7250c7de261e51b6188e', 0, '2018-12-28 17:33:25'),
('2d7d0097f2920e110488464b263ccdf21f480c46da3689a8084d62472b20f8816cb6d0b4c149aa4a', '031dfadb533df33cc35654edf6ecacc5f7a146501a2ed3c500476f8e395a0f583fb2dc2c8fe6687d', 0, '2018-12-26 20:30:19'),
('2e5062eb23bf801a2aa1aa6fb4124798fdc3faac8f09497b038f6145639a03d60102e5c51081d0cf', '54ef77f0fb9ccd1111e443c076b49dacbccb9abc0cd2e4a58a33e1423db6992dba394f966b2d1a4e', 0, '2018-12-20 21:52:56'),
('2f333094b341f593e049f827872b5dc06cd617624ec9e6fb012896be6f48f398ecdf0b64f9d7d4fc', '8dba48846ec8700720d16b188ab33c2bf0fe79f955119b628c4c6e47a12a53526cbdca69351110c9', 0, '2018-12-28 17:07:17'),
('2f8de5c5353fd23fd27d36bc01032ec07796f8a7ebb524976d92e2eddbfcac80c092bc491ff47756', '7ae121074eccbe7203bb0a4e9fe9094ce9e9ad682e6afd2fa0861e27de712880bdc3bae1e2731253', 0, '2018-12-14 20:59:41'),
('2fa7f4a52c35d91fa663d87cb0d153610d1e96299cfe6bd2fb191824508997e3c51bf674fe01ee54', 'a4ce197a434757f8f4c10fd9b02e97c634bb36413c15b6077cbc366b1d02378fde354c47b14b05eb', 0, '2018-12-31 11:45:43'),
('2fd202553edf416b2b5680fd8833a4590681a872617390dc448626fda2565d5189f27384e83d1838', '19e0361372da6b9569c9823a39859613d86b2048750e6cbe6db7fa6e00e585a6f441e616480ead2a', 0, '2018-12-21 23:29:52'),
('3012f4f2d2bf9cd9b00b46530f07733dc0233eaa24a7a61762295b55a4712b266e120f90921ef840', 'c2524caec08ca0969e92211da832e92150360a01db065ef64d29d2197f071b0ddf0063405c726a8e', 0, '2018-12-31 12:02:54'),
('31f1c412972e4b89e30356f77fac11ab5faa5d62204ec95e9bfdb33700d960d2322598e2f6e601f2', 'b6befdcbc6a8abde9b7aa0b504332309196f7314df001b974269e691bee9b21206d295b992a3c0de', 0, '2018-12-26 21:40:46'),
('31f6a0dc9119f1497a07227101e0c421cc1842c1e152da9931023693c7501de933e1259257cbbf78', '2ffcccf6d9cc1098c96e2d06b18446a54d308654a00d27e306b376fafc686b672153c52900989f58', 0, '2018-12-14 20:47:16'),
('322a2e4514013d2830088d99189a84ae36bf570a95c84746a2a2711041e132a599250e5be8e96052', '3b7967067a409cf53f3ed6ee102648cb12dc5604097f102922aefaf1211640943303fca5f5ceb8e2', 0, '2018-12-29 11:34:21'),
('32c76d7b38445892e6405acc5434f4bfc337ef015aa133fcbe4dfc348a15333419c6dc61d32f8342', '0ad9365c341d9e68a021ffcd7244420a19c4a8ed187171b6bb231fe2044d6b2ff4cce29071d6e69e', 0, '2018-12-14 20:48:49'),
('33ac79a542d012b89b7fc9a00e9374927005296fd57a44e334afa5a4bdf75eed13fcf46ad5306d94', 'fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 0, '2018-12-01 15:24:20'),
('342548af9438db13a6708e8812da6e9a6c624966d42868dc2a7d2731ca8e390d45111015fe47aca9', '26307e19863b5e7e0936a995609c0b80ed46f42b4f9b6a59389ce486f6836a248c2b4d46859e123b', 0, '2018-12-07 14:35:06'),
('3440d06bdcda3fdd5f075265613e4814af54d41a86d99410db16509ba89358a1b00b321d34030461', 'fcbef178dd13210c316beb788f455483654614fc3ed5f80f5b23c6ac95565f06c270c0ecc30ba7e5', 0, '2018-12-31 11:49:03'),
('3526f2292037b4301d41cd2b16676c3b4ab0537bb041043f41baa7a6e3b62ecfa041b96560577012', 'fcbd116a4a20f5ea09db4c59f033d56b65b503121d4b9af129037baa75b51f80292e867b8f1f871e', 0, '2018-12-28 16:44:51'),
('3792fb90764fd5f1dc24b5bc35b4806b49ffc6688af11cb26216e2eac3ca5c9cf508d6e892a9ef21', '54169e10b14d09881eaeaa11753dcdca325d93e4a6f442e1f4eb16278f5b057220b27180ef2df344', 0, '2018-12-31 12:04:30'),
('37f24102dab617d3f5f554fc8d32f87c4d3daff6ef2518cba6ad9eed576efeb149c34ae3de9d9c3b', 'a308283db4377cd35548bb9e41e2e90add7089861b4d746038bfae42be40b55f3f03c04ad57ee05f', 0, '2018-12-30 16:27:09'),
('3826f599940e062a21be6107c37e00e41091749c075da159fcf4dae3262b2b29a5ff48819d21e892', 'c45ae7198c3b7962147955938b4e50b4a209ebc3d971148ae878994cc157eebd56e4ccb14f561b57', 0, '2018-12-06 19:33:38'),
('38f82701442ba092a1f0d39ba7d58890dacb759ac020ec4f7f5d0cc150c6462abe2f6fb28ae7916b', '5dd84cbc98d3ea5d9fa719360e9a928270ee6bafb2af84c46a75c19f6bc4f443d093efcca064b671', 0, '2018-12-26 21:51:52'),
('3922c3b0e9661a368234e235d0e11031a2f472bc744f48919403bacbf6e69360997da9cf600ebdfe', 'f23c7c5eec357e163786790ef9be93a120666e85a0e83fddf9f802613cb4969d9fa12d03991359ca', 0, '2018-12-21 13:58:37'),
('396e5377cc8a1d69bf4dafc1a695758c846cba1ccec7bd9de9ae05a02960bd394de464c38fce5d05', 'b5c59adbfd24a111790ab731795eade90d3e260f028be74e5fab29699f69af8db9c0e3f9ce49c0dd', 0, '2018-12-14 20:49:05'),
('396eb86f04a91ea4054d51074ce57382b0fbda1a9e89d75cb5d76731925480ea51084f97e826d3d4', 'a31bb24aff241b36e2db65f717a6031da528604c3043cd438cd71f84fdb0b0e0bba22cf459af2f78', 0, '2018-12-26 20:55:58'),
('3b31ab1f665f7a418811556899a509060839cf9c714e63870a146f106799a58ba530c5b4c46d61c1', 'a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 0, '2018-12-01 16:59:32'),
('3c49053f6f3a7346b7285e1163246e60b4ed3feb66a97fd653fd325195ae8a50c3120e5874071dff', 'd74a4f2819eb4830809b5e7b903c3923dce76f2fff491ad6071697823f7c0f3162be793124387371', 0, '2018-12-31 12:04:39'),
('3c4d3454203bb029f83f9522efd75252f0d6eee676e201cc576eaf61943cf009cd6537e3002f35c4', 'a78aec244fa6fdc3c379a89de5d87c81dd5168e8d5a42f9e2793f54d620420b0d369e59dd88485d0', 0, '2018-12-29 14:19:46'),
('3d6fb03d1b68e52b3728e0247d73cfdb3ed5c5c934efaae588596be36f36b3a903b90836d318fafc', '07b0aae70ba6122ee13ab98f25dc820be83587b9371998d755d59f98fdc31a5384a861dc4d946553', 0, '2018-12-26 20:18:27'),
('3dc757e5bb307abbc45cef0467330a4dd315e8a9fc42d23f2cab5547c8ac63bfbaea4b9acbfdce32', '215c6af65af791e6b2740c0d6fc10dce317a518564b77b0ae11c28426d77b3eb9b58ae1f80634efd', 0, '2018-12-29 11:43:51'),
('3e1c73ea1e9a0cc44b446478f9efca38a27b66c5c9ae28308a04ed531f09480fa9b1117d56b21444', '3512e555d6b92bf6b9baa5215653be1c5fcff911840a5824da9904d61bacdbf39a6affd2603faa44', 0, '2018-12-28 16:15:03'),
('3ebb5aef0d72eaa6c617259a426bd6014d17485c3649955a7ea05efe05aa662544f666080d3d5731', '481e5d90320c7a9473379f6f9c93ef9348a48ccbf43fc69b38fa68568e3dbba290968ebf3342a604', 0, '2018-12-26 20:32:16'),
('3f1e57a3d929a259244f06337c8cc2e362e45d01d6bbbdf539427c9397cd3739cb354e345225943c', '54562846e6e7419d584a4c79ff76398e7e874af70c78a5fc9b756d0a459582c8be25cfff916c9821', 0, '2018-12-29 12:01:20'),
('3f4922a405eabd6b2ec79a37e636050435dca1d2ef369af874ddc21211ac986f5f78d1c9cd2ca292', 'a99b2ab25cfffafd20dc355ab8ef5a117f11b7dd4ef09d70d354e4800cf5965ccd5187a7b287b96a', 0, '2018-12-29 17:02:48'),
('3f616efb437d0478f185455a92c98fb7c3d016783405296180564bddd7be2f385cab2346962c62d2', '9681dc1a47619318a3b9aa89428b6cf32a7dee7a2fbac4496e85a1d9d3ea7e6b3cd340c5b4d36414', 0, '2018-12-28 17:34:05'),
('4001b71f3a8fd39ed7e78378bacb6fb88c2b9519b8d7ac7e0ba108b07fb2935e621f25e0a24cebaa', '9b6caaaf06adfdea93ac8e556c14cafbbbc5a6372350bb9a76cc5053c709a1d0ee6e19b86b5d5fa7', 0, '2018-12-29 11:41:36'),
('403e228f63dccdfa5ae7a2ec5b493b7944c63eaec7a2cc1723c9ec496a638c9f5c6090b216c42c28', 'b6aadb8ed13777caf919ba85a523bea3fb7aaad1dc23dd00250887cf170c59ffdc21ba07ac965aa6', 0, '2018-12-26 20:52:56'),
('4043f57a181939b12b7b790fb18ca4314eb7241525c9664783c8e6ab53b17655609b9d1f3ecf024c', '900908d12310cc895eeb16ccf68e8dfce9ded8d4082f8f85e6ea4d7a86b74f74ac49bfa679b2546e', 0, '2018-12-31 11:27:04'),
('41993f932ec70a0a560f2b31386942f3e5788018549a5534d9792a64eecffb7ac91f4fe72897fd8b', 'ce5046a6fbece6911567ee0025898c04bc4dc7e6789c0348cdbfe656d484eacb045dd9ce9434467a', 0, '2018-12-28 16:09:05'),
('42102311f2766556df838f9f722b8da86a525b1d0c130574bb1930facc59501fa500356d5351ed98', '89220362a98f77668b0e55a298f10722a95e2a1f09bdf83397b23b52503e1f1d1cb98696a11d20f5', 0, '2018-12-14 20:47:51'),
('42ab8641e31133961cf1fb0f05d48877cb011f0a2ed84b1816949e625bde1e42cbec803e417a2e67', 'f30ff10032e72eae7a6ccf2510f24ebe36892dd548125d74e4d7dd352f4e643c617044ca784b9bf7', 0, '2018-12-29 15:53:32'),
('42fd3314a998c822bfe04907dc9f5e85f2f4c092d8c1cd24c963bc89fd42cd624bc8fb44cac5a25e', '127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 0, '2018-12-01 16:59:08'),
('431c44534b71ec64dbd407572993a7a587b4783f9c855c340c6e00b55f62ce6ed8047b2fc4a49f7e', 'f41a8c78d61b9d9b89abd599d0b97d7bbfad75cbcef21f9430ea0d43139391e8ff64cc293287d811', 0, '2018-12-26 21:54:25'),
('43952e49d7faa221778e84b00f2fc0adc7f51ddde10469ee27b5d2628b091c97cd1a4a85f7c4ed51', '3e67f124430d598c745bc9a170bdfcf8d452ad78a3fdcfa371d6ab464a1881c2879a76bbc16f252e', 0, '2018-12-28 17:32:50'),
('447ebeced7e79efa8e4928d346faa46670ded065e2729910c99170774b824fbfa34ad01412d25b68', '81760047d1550921b6c08b8871480a8d178ea7bd88bfba9df7c2ce4c1ef3ce686a07bce2162cdd8a', 0, '2018-12-20 22:23:57'),
('44f3531ff880e2b70810d1a38379a4e1e5fb7fa691daa9ef344bc34848fe9dcbfc7e0d8713b1b1b9', 'd5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 0, '2018-12-01 16:08:27'),
('478f53f628430722aae86eac6f90910e20950e57da2a6a808c76c6848ca71511bebedc6eb79da8ea', 'e20026ffddda27e4eb1e25b4c5f5fd0e81ed6ffe116b59c7a32a9f08454ad00ecb3d7d929db9b755', 0, '2018-12-31 12:15:42'),
('47af7268f9c23d413f1d7e0af01d9d5cc4192f0b28a8a9acd1b30029b84f2f933558d08fe80ddf81', '4198cdbe9db3c2c2e670eac7436a7228a5f709cac37b3fa66f2cd1fe2aa6358d70a04227f4ed7d51', 0, '2018-12-28 18:46:01'),
('47b558b7612c9abc94fcfab2f69d7924d5bb3bb5856b6e44d127941a99ee1113f94e64259d25ef1b', '4a3ef85eb3e67800105bacc66f66fcbdc911d4049566a4785b893b8870d2494c8cf54eccf72852e8', 0, '2018-12-29 11:38:45'),
('47ed6ff2ddc702114420e00613405be0c6045099abc94f4597529d0ee691bf0721e140adcc7c4d8d', 'dc04a737ce7169cb09c88d43f4598cca335b1c2ec06675e02e651a69f32f6205e2187b4c981dfc4e', 0, '2018-12-13 21:13:22'),
('48caad7a75c235808bbe873ab230451643815f8c1a66356be1d31174d3230c910480f0add9e1e2d8', 'edfc94577fba9d4a52e91cfeced7ceaf63b8060dad62f97547b174b3ce486a2fa865fc5d503d96c9', 0, '2018-12-14 17:10:14'),
('4920f67c7587c378c1270134ae7978bfbb9a5f8bc757c6b98ba0a1d69d8598c1967dac713198cd14', '7862894de790726c5f930b97d34bb2ac875fbaad4b56bc6b1fdc566b0b88c275e8cd121aa98c7f8c', 0, '2018-12-13 22:23:57'),
('49588a56c2017d60a398e2a515621caac739c80dd6c4933461fd0522dd5c22f5f74a892f840fadfe', 'c7f8e2fb4344a31dcf31a8f393bf741d2c1a217e62b88f003a7d6c55899319270cf061a13823695a', 0, '2018-12-06 19:14:13'),
('49594efdf5aab36f96cb3bcc5fc6199cbda3cdca773c9627300852045afd8bca9a55a81ed20dbf0e', '5e783f07f3876c32aa281b138f6a88898b2e8794990e68c3c619c27704e951d0f1ddb0f6a24719d8', 0, '2018-12-26 19:59:21'),
('4aa90c5198c9ebdf77f2ef8d29e1bdaf384c3060897bec09389832b94b499e3b2173ec7cdb39d7ac', '1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 0, '2018-12-01 16:20:16'),
('4b4f0541097a10a555968e88aaa1f813f629fd3de06a65d8ad7e59060b232f0c96fa7eb2b85f1ede', '0b315c61671ef2d9e30197f215e17d57496a0ebe911fc89c2e4cb16ae3137e5338360a53c9fe5777', 0, '2018-12-13 22:25:37'),
('4c1c366e0052a84218e55450f328c2a4a3a9aa90905d0ac0d8b47724ea4492d1acea56240e1dc15f', '25d740cda866cd28b5da2551359f7924b2fb99fe2a5c3541ed3a39ab75159c2f07149342d21b726d', 0, '2018-12-31 12:09:37'),
('4c43adb5b6831058cf177a0888104a8b4465005ab24cf739e88ec15815ab9adf50f24a1bf1137cae', '280e6f6cf9265a98265e30bb2d8ed7d6de8ca86927a43725e3faca9f2dd2b06101c7f525e2e3c3f1', 0, '2018-12-26 22:08:27'),
('4c4e86bd36e046c8a864d521519c355535e788d0b4feec00c76395e1fd379c8a25f488cde3ebc555', '0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 0, '2018-12-01 16:37:29'),
('4ccc9da27645dd5845bc66f6e61e6abcc93c9098c369f759804b77b412d719df164c6565f3509e0b', '0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 0, '2018-12-01 18:53:32'),
('4e209e21defe205810df24213ca4e8371abc140fb1a9d8683163680ad58bbcbf099825556f7f1fd2', '94fedcc688bbdcd5a402e00f1feb939ee05c36c05817989a80b2a2f918a9c3484e9a0d9a29518d96', 0, '2018-12-06 19:13:58'),
('4eec5afeb39de77fc3e4b1b1b5606b1243ea6046d661aee7ce2ffd6f0b945be78da1f3601be48e92', '413f31856afb63203627a5043282ba38362496de0a4a90149abc9d7f2f7e3dbe80e1b2baad2e2527', 0, '2018-12-14 20:42:11'),
('4f17fedaaba842e920318961d78348628958559aefc1980f75bb27032e5e2c7bf3bf253cc91090da', '67f28138dc05f6de3c6838673a98c1293b60e537f04b688537fc9692444348b82d61ed4668f4468f', 0, '2018-12-09 19:24:20'),
('4f5d311d50a35bc5566b290b56c94c83aec4ebae1fb132f67d5003dccfa0f8f22fee016dd397c1c6', 'd51c610d9a3792eff87a1341ae36ddab02a4c796e657a693689f70ebe648c97e7d4c223cf9cc6c07', 0, '2018-12-02 15:49:23'),
('4ff46b61976f7d48e77524e95befaf11b009eff19d014173a6d4754af43dc9d97f04761683592468', '3c8e087ccfb8d3ea2716fa6a29bac6f6ae359ee2b5e366e7af56ea9fd4b7610a4809294ad8c19520', 0, '2018-12-14 22:40:29'),
('50ad1ae53ea529940194aa7074dd852d8f338de48c7cbd083b22af3d61f03539a44f9f0f3083cd81', '3472a6c526a5f0b28972b1a8c017061dd23f47678e15e7b3adfe447dea3f91ea4febe5bece9dc59e', 0, '2018-12-20 22:10:06'),
('511918d540ea416f173a247b1c08610755a2a369977d82f1da7b1218e93f11b3adec30ab4ed9f403', '2c20d8b709616e3284a102be7aefe466db6e004c287fe3fff04a49ca77356f517fa240522afdb7d7', 0, '2018-12-03 16:55:04'),
('52fa009184b2035a8bd8ebe9f5de0d1e78285d06196b961ec42123b71f327ce3603d82afc93c48cf', 'b03c93f72258e4dd87516a40b3da6e3498b938436509f78bfc49054dc7ffc5ef321b21129b853da2', 0, '2019-01-02 09:35:06'),
('542e8faccd797c1fa6eff4e69bd0571afba23d8e574e7d1c5c9d67bb1e3a4f4c70a8c5216f82304c', '3ace7d465e75573b58dcbfbeb311ad856aaad51ee12ea693f10e8cf7e4a14f90278da1a25fd9252e', 0, '2018-12-08 21:04:49'),
('5580278901dd010ab1e394247b6f57d2687739812e54729e5b094fef1108bc1f34d83b175294bd7d', '6ade2824311df05226e5e55d86d6179e426773cab825a5b5bd0f64a931b776f5d710250e076a9f9b', 0, '2018-12-14 20:59:29'),
('5684809071dcd65419bcf24a22e8b2adc7dc50dc7dbf1cd2eecedbad467e33d0ae1a72d52189e6d7', '71b4d373509788d120026bfff92bf160c392b5ebd4cae8db2691cd0da998a142f6e3a2e2bf98dcde', 0, '2018-12-21 21:59:25'),
('585ef2a478b9000c824a90741ace6147b3a15857a10b8469bf91e1d5fd4d45d518fa3ac4730bccb0', 'f7b7b1c1db46a4822c463708c71c329e58184c72f3c233e8eed873257208ef788eee05df1de07d4a', 0, '2018-12-28 18:20:35'),
('590d6c17754ba2ab5793f0032ec6c70c57d0f54ed500f8a905cb9748352f3f7863ae64b66e0b363b', '52d6b64b46f443c51cfa12468ced34607460323682192f6a8d731433d5001728afeb2d1b3073f466', 0, '2018-12-28 17:07:12'),
('593aa84291c9592b4f3286d02bf7f06ccd61374227349ede2923e3a8210be1488d84c011077ab655', '0f201e258c95c555dba55d12780227442300b6b9640045bbcceb61f9de220a976bcdcf6532014ba8', 0, '2018-12-29 14:15:32'),
('5a9ce1229adb612f303fcf3deb3d6c858f42cb9b2576a35416c70bae9ca2cb9c97e4e643f7cd4b81', '3ae8eec9d12a3f300f0d67ccd22c1c60dc46b162e887396f141a066ab0a55a944dc0880c8ce61bad', 0, '2018-12-31 11:48:50'),
('5b3db98cf622b6e96a73fab3f8e2b1175e1ada5862ee6bbf4064880e45b23b599f51f6ac09a2879e', 'c098217b30b7adc9d4e00829aa4d332cdc934111e2fa9d5b842346c3c7ca72d0e1cfb629c1e447b0', 0, '2018-12-31 11:49:52'),
('5d7dc068398bbdd44cd5fc6332b39cd79491419cf0f008090095212f966c387f755321b4cb5892ed', '7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 0, '2018-12-01 16:02:05'),
('5e4e09d3e23077d3936bbdb890b058efc71c27b1800173a8eb772629b2b34cb813f79e610362953b', '10f634e0ae4c4f647a5c7e3a1fdb1785c952649403d0eae5453a1e52f6d7b0bb39d58966c2ebed41', 0, '2018-12-31 12:23:57'),
('5eaee59e12569957e7a958f68941a4d15737a280ccdbb3c1d03d85e8da4ca0c9a34f83083320ca53', 'b38bf9c77cacb84f81a2d6abfc48364ca78f2ea19948c198e1aa4e8cc4a4cf1aa74730d0b2a3977a', 0, '2018-12-26 20:29:30'),
('5f2bf3c0f3d86f8d86e106ed33d7747e4cb15b2f8204b79fce691de9ccfc143d559faa9c72dcb912', '4aa15ccd88d42fc5797ba88d17825b2f3bc34c514c7db445c8faedf01db2f65f1245747d99e138f7', 0, '2018-12-26 20:23:47'),
('5f6d7755dd12fd757e0dc52dc1295b5789aa38bfd81f6596331dc1cd4c9df96ca9520d13d7842fbb', 'a997f49d9445ea92eec29f1172047a08ed8846d1b727daa2f4250bbd9b323a178c1789eba668b728', 0, '2018-12-13 20:25:28'),
('5f97fe8302985b2eaccca6b25998a32a09d9cb47a62093c2d2040b97762f0013a304987ca27b48aa', '5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 0, '2018-12-01 15:30:22'),
('5fcab9d4bce59f4f658e290ec8167a12e4a270f6517f978eecd55b2d18ad48822f2879e8d1b8872a', '5d16904659bace8912ebb823cbdb8e75fcc6cec5c7202a821f8aafa1251e1b49fd53b035c5a37231', 0, '2018-12-29 14:18:31'),
('6088aef9e7d480b423ff14e889045b22810a119263b8469bfeafa06e5492a1da65fa783b1fda93c3', '1739ab16f2d887102a200f737808c55bbbdf9851cb151a3109e9b2710004d6018b632c3b759a9858', 0, '2018-12-26 19:59:21'),
('60ebccad0180c411134fe32f7b0b5f4457d067c382b551da1e2d4c3f8698561358145590e0f29c37', 'f16288d3d55f4b428b26e04815507f00a54d15b78ae6370bd8f2e621455ba79b0eb3688cd8aabc89', 0, '2019-01-02 09:29:41'),
('61f58a456bc36da48ffb4e70ce615585989e68db851bfa76b8405464074c472ac94204df6275e3e2', '31cf0819eb33716c8567a3e9f30096d7be5357e0221687b228edee425e986be0909d3e548697dc26', 0, '2018-12-02 22:20:20'),
('625cda1540118f1f817c6c5d70723089f0543475c75214142e6babc62fb119fb37f16550a04c4e5e', 'fce23485fef1971e9b07c16eff2eb47bdec66319fe423d6541383e3e74a0969b4536dc890bfef6ae', 0, '2018-12-09 20:00:53'),
('627cd7507a5b429266cf22e91026c5dcaf5f1d63051f9be1af0fc33e35016c14e79356ec38fd6552', '4fb701d22bb71c4822a1e95e4205c74c997b501fefbf65c08fc929dd66eeb1a6a779a7b8c62eea42', 0, '2018-12-16 23:34:19'),
('652ad6af52b4b45532126b2ab476d153e9a24b6016e28e260a0c7bca03d2ec25cdf248d2cc360fef', 'aa283d5a97cedbde852ed1f6bda72495c55b02516de84d452a3be0702bc318cf7b8f7d92192e10cb', 0, '2018-12-14 18:40:59'),
('656198c996600fa21b850388f88714145e96a8730b2431784f7d81ce3407400fb6141c0657dd08c2', '14e2c3dfdea2b974287d43bad96392b5db7eb725aa6badf32275b75a8c748a7069f3309343d75d8c', 0, '2018-12-14 21:22:30'),
('65bc79946d6f1d916fb1e35db9e1b9aa4b24dc40bfd10540363b346ce028be1cc8f6d585cd6b4f5f', '1c8282bc5af92c8ccec2028b625f8760feb857d6c73b856dac1b5043f4fe2ea4c3ac2e8e5be24230', 0, '2018-12-08 15:42:48'),
('65eb3211da38b85f0daa4079a661e5cfa335a6d0f02b07c8b89b1e61a6555d944dc819682f603c68', 'b1bd5df09ad853c1f0deb4c3733baf6e2c826e6ab1750e82fe7bd5303c900fe00d16a574c8e6c682', 0, '2018-12-09 19:18:38'),
('6607f0048116377df0b304d7d977b0b8b4a4ca7447780fcfb9bfab46aa32844fb04728888dbaaf82', 'a367007a656639a2237f9fb898ca7c697afacad5a576cf630301d712b7b6a35daf91da8a54e46782', 0, '2018-12-28 17:33:42'),
('66837432f07f424d87776bbd71a99bd54cb477024c8811a5b1d742ed2c3d46a068b7d08da9a732b8', '417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 0, '2018-12-01 15:28:49'),
('66da545c23077b809dd82bffec15da5e2943194125b6ec8d82fe05f26999b67ca625c622384796e5', 'd13f7deb11a75cd135c3871d6d911f7fd6ecdd0c62618444018960fd63e14e0a2efa683a94e6eb93', 0, '2018-12-14 20:47:34'),
('66dbd4e823c85d33ff7ae0b1b26f6c360f5876683a3ebfa01846fdaec04850823b68e40bcdedb277', '9e7add972ef2fdf32f2b15a3eb2f190f13179acec26a665ca0729d23356ba34969d9afb639c79d03', 0, '2018-12-26 19:35:30'),
('66f7e90ab6c11c3001b40a48865586a3db0c68907cdef5244d9769b4e0eb298bc78df9cf6c62f5cc', '83ed82aaae5d8d06bafc2aec94da3e756ed495c6288461243882a6f93ecdb25214f4362fb7d9d90b', 0, '2018-12-03 16:11:12'),
('685b86bba41dd646fbb88d40bf3cba9b4d08560f185ac922d80228c35e9ee1532af5a6b492048e43', '648700c3e5b9366b3e90e20d41490b6d16eec62fa0a005f16229cca72f85a5291044a8439c3dc6b7', 0, '2018-12-26 20:25:05'),
('6911cb3125ab3944eaf10b8966dd55f9461b58415eb7762c9686747350f5d5cfd5c4041eb2fa379f', 'a61685ee7aa364d16b790f41c9e6ecea51ed09b6df5a7e69cc4e029fadd59ae4732ed0ae4b6c2ca8', 0, '2018-12-14 20:46:08'),
('69a121c269bdb9fa36dd59e2a4611a11f3b8f4feba6a2e39802d467299a5a6883ec7810ff41ba777', '4ef4fdbcc588390a395435d8f10b665ca5a9083998c55b6b5889175358a4bde6a12fb37926a1ed79', 0, '2018-12-31 12:16:23'),
('6be271e2682c4a3e11272b29af8fe881d2ae78be2894669b3295d3c8cdb00c60b8aa9aad1dd3d972', '4c496332966e1a142b82494637a441e3cc1ebd4f1b6dac121ba5989c4f1ca5b29144348a7be3a255', 0, '2018-12-29 17:21:15'),
('6c4618e0b8127c343a9163e3ea9c6607835f7cec4144eaa360c392d1bb9a986091e0f147494d06a8', '77a54106e29c0629068a2a9f810637c8110db92fd60a3605ec6849d7dd74e67c8c3bd4c1dbba6819', 0, '2018-12-26 21:13:07'),
('6d1d07f50f143829c1d950c388b704e9144faaa7765668f034a9802a478911982fe1a3af95a72f53', '81300083f18f51a4fe1fd7d9644adeef00384f0a061322716da5fd749b38de285a3a0c3b4ba1355e', 0, '2019-01-02 09:36:03'),
('6d30c6291fed7e4e90c00e0f6402f1a5f2348fbfdb516e5c6b6c3c6a34ff01fb23c30174e12ba96a', 'd426a11ee43ef4ab2a613f033ff584d93604090ae48b21eb4525a5f997f5d5520274ae7918671d0b', 0, '2018-12-21 19:20:54'),
('6d83344bc3510231839d27285262a5098ff95f0db8188e1b75b1991ad25553370c1741572b2e4410', '375c616324594ced36f5af01ce0e2d38b0d8a8685ad510b84334e49d1ff80d674a3388f9862c3a9d', 0, '2018-12-29 17:00:50'),
('6d97041eb0820481256631630ffc28be54dc27bb3f8cbad0f4c772aea2ac72ade1842109a15b5203', '4ad01dbfb164f5ddb8d30a99fb3769a82b540d456ca99589be1ea94f400619c6e2fd9458858f787a', 0, '2018-12-14 20:49:16'),
('6da6725cd42d7fde3a9684510840fdd76aea394a3a2ca31009963dd1f1858fba537d416727765103', 'c7ef4d5fd6e96403af72064f8912244ab9ce40abcc80bf5bc098bd084fb362f88e0bef00773bb1fd', 0, '2018-12-28 17:30:53'),
('6ea9997361b6e93862738a74f9f1b9558d75943d38c5c4f827195210f9d976fe9775df0a45467ea7', 'f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 0, '2018-12-01 15:28:34'),
('6feb3b07197e98b82f5884b4e77348bcccf23aca085019b35f2edc5705ca1e1db44c15d962548e93', '5372aec8f067b85a63f521aa446e0a1e3cf09398e30714cee3de888bcb5da8bf837cc1a4f7107d8e', 0, '2018-12-31 12:05:49'),
('716090115904175b4ef8518a4e6233c4ee5d5550d79648b39e0cbef9a081e343eda6d9cdca8e5686', '6f1b3dc94965662e1ffac7a1493cd09ab89023ed94b790c401f30b37960d71a417d16712a6efb39d', 0, '2018-12-29 11:51:58'),
('7332e104d3ffe04ea6e989bfc61a9339a5ea81de4892d9968219c4b0d83f40be440517200fe5d1ed', 'a19dfccd8a6252f6cb8b67093857ec4e280eea6adfbb3b423a6eadf3e3948e6e93d32c8804731ea2', 0, '2018-12-14 20:46:22'),
('757bc8eff4fede32d381e1350515c984675db76450c06f5170bb0046f8d213c8075b56c1248994f5', 'acc389bca008e13b37bef267dba56c67c37f0909bfb9e320b807b1398fa8b00e78b7f28e9f692cbe', 0, '2018-12-31 12:02:57'),
('770721600ef206e7a69297619e39832a0305ffb1d7ce981d403bef418dc36322b79cd439ecccb113', '4ba9b5a7fc580d5ab2b17a5b02257e2ef80945242ac19b8becd65eea1d570c13be2ade82a8aef35d', 0, '2018-12-14 21:00:36'),
('7770f2c903268059c83805c978f6e02a6cc0eae98a417670cf672c1ceb8317ed4dd617508dafe4b7', '520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 0, '2018-12-01 16:00:35'),
('78ccc24b92abf40c4cafe84c26d276c8f8679237ca4589fa01a2cd8e549ea7016f568910ae3addc5', '77854ca9424790506bcf6c7915a709310ccd4501565c3ca705d41cc3d0f135f47bb69e973266e493', 0, '2018-12-06 15:40:17'),
('790024aee90972dc1753d45e5cbdbf0659fa89023a6e559e1fcf3375f69d7a258beb80106dda80c0', '4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 0, '2018-12-01 16:11:21'),
('79e8c34eaddf3e684bcc394080cf10ab3527444b5e76102bddc5f635ed2cb4078d43bb493fa07f85', 'c32ff9c55bc74da15c7c589549e0a17a168dee12163a08b77e96bf702716eb3c23f1081d8a626f36', 0, '2018-12-26 19:33:43'),
('79ed962c342954cc4a2563d51e1693ff2586af3def89a2fe597258ede3c1ad5e757209c363a1be8a', 'fdc59e1207bf0d143abac71aeee5b8cb9ec9f0ddeb820fd96e323263b47353babd17618f730ca230', 0, '2018-12-26 19:59:16'),
('7a9fc090ddaaa8e8774cbd32725dd20ccb21b42e581ab3cc55de8f2eeb398f69ab241731a8963aa3', 'e11475201aa87316ed623c4a7a626f62bd7e6928e3788d9bb5e03db8f1735ed7b9f260cf350d7012', 0, '2018-12-27 20:54:40'),
('7da292582bc4c848e797be3e1cf300d5822694bbda4d9d4150839fd30591c9c3e2273e8d11401690', 'd359a224fce51322b683e2aa9ab667f08f01279423198af73807daa0774433d002e547fbd6b75943', 0, '2019-01-02 09:44:08'),
('7e095de19fc523b87e5df7677fe2a08d328d8699552ea4e889019259f7b87d3c0d8b96764b04c558', 'c6e9b556edda02599fef1aaefa4b68e415da957cede3680f229a2bc1bedee93a1bf856411902d857', 0, '2018-12-22 14:01:07'),
('7eb43e7d63ca8293f22b7137c97155ec4ecddb7e2d219d57551ca60dad629ad9283b6e1ae7e63f19', 'a8a04e9199e7ef9573085a02efec1e6f2c7722b70494dd4cde28b7310bc93b3f613b4dba4ee6f7f3', 0, '2018-12-29 15:05:22'),
('7f8c2835f6a47b02c3f1316d3542f93aa14f68f92f20f7ef756e0109e780aaf86397cbedfd548822', '001b3461e4738c0ee44df40f6e9482b3e71cd0a73c44dcf33ee5a4e66dd6527859cb672c32129c79', 0, '2018-12-01 16:00:20'),
('803603e72c291380ac75ba2096f49bd16123c38c64799387f92a595d1dc65ecbdc0bf361e22577e1', '0f36417468931c16d37529f6228ccb6d3a7b3940563b53d946e1b1c2340621509c702a8d48d892b7', 0, '2018-12-13 21:12:46'),
('80c30821c621eb619e4d11f7a09c3dd088d769deb790b2708adb05a2b3b4fffa3c9f3c00320c847f', 'fed93845f8624db333ffa440659ea9f0cfdab88ef06f47ab87309b79327782e53914a6a48d066818', 0, '2018-12-31 12:22:23'),
('819fcd84c73f6bc8d04e3b0b2a8483f88e798d7e8abe5a40f0d6393ba6955a0339feee3b8421b5f9', '51f6a992a5ca6007541353badabcfc8412dabe153319cfa122574bd85e98a3aeb7143c469120e5f8', 0, '2018-12-08 21:03:54'),
('829529932b25bd4b73f705fb825b85145ba448c217ab156abd7b40c63a863bd57d11de04ee2f5d18', '9275425ad6ca7b5cb4904fe8b6c9783653647032f9b7f340323b41d85dbaef1d069317ad145830d6', 0, '2019-01-02 09:43:14'),
('8329e63e12d77ba02f78ddb891222a172fff69dd73fc0728dbff4f6f7fa73ba5485d786af9701b91', 'a7c0987a46ac3ced7d00c5d2bda0d1ff37f794acc19b76baacc38d5b164b0c2be9bbed56cf556af9', 0, '2018-12-29 10:58:15'),
('8329f86b6cbf87385b9b0bf812acedc9eeff095394b407b0ef7b230374a55252a4c99a88b79203a4', '1d7807420c5f07e3a508a4cb1ec1b3ac80f06714f552194fff13011e778498ae02aa9dec8e140bf7', 0, '2019-01-02 09:43:47'),
('840607bd13ae0397723b6208a85ac1fc7f5de372a259df72554d2ee1e0e346826654e5f5dd427846', '0448c1a8d379ff9e387597dca387e223bbb795e232313e30aed07c555c6ac30c31080d9f6d8e7b8f', 0, '2018-12-29 15:37:51'),
('84663abd0d8dd72e2da2d804be6966b4917fa64e1bf2e88da3b58a698e4050048216151b37a8c100', 'ebb3b879c8c79deb48c3da7147dfff0591d7f2e4905a5272f31adccf19da1565f19c73da85d8e9e8', 0, '2018-12-29 16:14:57'),
('84d54a91fc61e9f7c9e9ba922a5629290d866fb0b2a5620784d2154dfb7c9a414558b7253c36a109', '690860c6a307aa410bb2ce72e623c26a966c7d3ecd18ae61e7c1da9a336a610c37d56b3e6ed93496', 0, '2018-12-26 19:34:25'),
('851944dccdc9733c5d2c1b18263cdbd67c0d37fc59fb51a4c2a50570088035ae944c881d6b896080', '3e1280b1ec5032d01cb82943169eecb7be7a582a12bb3b18f65b962f65fcfaf289e34b103093e89e', 0, '2018-12-26 20:25:40'),
('85543187b8444f28ece007fb13b7f09cc476bbbaa0fe7831e586b299bcff878d97b562e39cc09437', 'c699f02a398940d5fd74230ff91552bbc79242c2d3409f1e920c2e0e1400fc1c239671a7513d7e99', 0, '2019-01-02 09:33:19'),
('86aa798089352c4d0b6d98098a6dcfbb6c28457461e09ae09c98afc62707bbab713c703bf45f443d', 'c2b024ec8305d4e215e5ec7720cd2a7485dc2cd7eb7b97eeeef28806ac8395c81f560f7916d46fac', 0, '2018-12-31 11:27:04'),
('86b98c97d8a2d2e33e15732b86e36b7e65964ac550778d91b847f12a4d3ba4029ae4315100172bfe', '14f0f3bb307af6c77e6f52d9cd3d88b473523a67c444812277db093a68bf367438df7321bb897fca', 0, '2018-12-26 22:06:30'),
('878f9765457d46f642f2def55d7d175d10e8c48a7a7d44ee8afe9e21e705e278ba4a0017ddfb286d', '6d0da120fd840bd05caba0ca35b6f4decaeb656330f205f83f784c172f0d7e5af18cc37fe09b6d51', 0, '2018-12-26 19:59:16'),
('87e20f22b9e6ca554bf96b55f64238d156ee4d9e8577dd041a32a7d4d606fd29094fdacf010e4e7b', 'f1294337030e7a975a446937b255c12e60c6a1f06e89e14f0328ee9cdd7b581c3833f31e42d009b4', 0, '2018-12-26 19:59:25'),
('8819c2ebc27eefa6d5616020da51274b785d93092787844dae24a951568f1a7ac70a826f4a0e47c0', 'f8e442db25b00428b7ae856ae7710c2f974363560e06d70517d980ecda181abf00791cf48ff3039d', 0, '2018-12-29 16:10:10'),
('88eb08f3a59d9d1d9f2a9b7f80f21e5293c8babbb3206b73a51033c248105a04c8ab39f38448483b', 'd35de1dee55646fa086acff4d97868c4ab27e8799dcc8390eebf179b42c3641505ba0bda5d1db79b', 0, '2018-12-28 17:08:32'),
('89383cb377700e1a2ba218ecc826726d9e66950579b787353e8f4c2ce353b221f6ef8c7eac653d11', 'eaa3c2ab1df047f392183de45a4b395a04f0a3309c586c3cee8724ba712dfa20d0cdd10319ecbd05', 0, '2018-12-31 12:25:45'),
('894acff897c0e8ddd8c0a4d036ebd4642e961b6b02ad584eaa23f77a7eb0bafe2db48c0b8be365eb', '032cf017c54db30d8764f913d2377c1dc864696ab3375b84dca899dfda293d648f6223521041c291', 0, '2018-12-08 21:05:02'),
('8aac92f6c67225463ab5007cb62821bf027b4f423e16667062d1fa26e313bc1e39d523aaee03738f', 'feac7ae96f08266bd5eb56990382f8e995c51bae5b6c7566616463d60ac061bd8cdd886f5844bd4e', 0, '2018-12-26 19:28:24'),
('8cb2dcdeb8e44a2afe847f8449aaa342fe2a13fa20003315d401695112cccccbcaf2289478aef4e4', '3da8eb9c6ac2b1466b646d90d3a1a53f6566e8bc082368ef07cba8e1d79b86611a5d52e40257ffa5', 0, '2018-12-26 21:09:31'),
('8e15090d6db34fa0a1b2c180864b2af3bc4c594d192cd06989a7fc25801c67bf250b40008c5103c5', 'cf8756fdb72dc89cb4f72f1c4bd80ec51a45bd5769e97fc8278e80d79e3bbd5cfb74169d9b00048f', 0, '2018-12-31 12:05:08'),
('8eb68c243e489bb3a11dfda83605dab1d5625a1ff949e0a7b10fe38d7b54f826620c12a20744797b', '6c71fb58216ecb7e1c0ab1d66188df07ae2ae1e4c326d9bde139eb83974dbe53c350a32454045af7', 0, '2018-12-29 17:04:41'),
('9000c3d89370c10a5290a6abbf6a11c494d72116b873e3f74dd344986c0cbea2fee6258222d19d4f', 'c7786bbd110ea330db7e004f5d883f08adf5b6e74ac0c7e7cbc86cb62d120088827ebc0abe13b8bf', 0, '2018-12-03 15:10:15'),
('902421ec87b75cff28a7ee556d7737f4e259d87e9506b679bd34d4624befe458d8ed289b206f5f17', '5df12947523558914ba58bd42f23c586db11afea33b51ff31ca3c41bf27b81de59534d62db357ac8', 0, '2018-12-29 17:05:15'),
('9071e1704ed02e069ccab7ca5bb965c61a930f175f1794c87b7fae08135567d5f3f11bd6bfc92ab3', '99c898a963b3fe03d406e54eeeff4f2f0860807ef3f41225349ab2d227e8162716b625c521af7a33', 0, '2018-12-20 22:17:57'),
('910bf36124857ebdf9c3055f48fedd4c378588043c1594be4eaa0fc558ea56c301ad5e7ae8526937', '35a371b52d9e985d6b74da9c417d8a9dd52962b9c4139064af45985179d1d2b3c2cade420af5d481', 0, '2018-12-31 12:09:49'),
('91e1bdb31ee0107fc91b520a26bd409a9f1947a02bba0ab0e0fc2d98facd3d25b84b4d4526397da3', 'a2cbf5884cf0d3a0edb6d745d52096a38a63b95526d9cf108a19c99f2f0f573f835986d50f576f59', 0, '2018-12-06 19:31:26'),
('92c46e75b4db29d89b01987c9b2e62a1a9030c55d4cce1995fb6005be18dd7a59815dfe6621b413a', '3a0b2a17a3e7544e9a0c8d1b18719a3eadde9e4a3cbc9f2cd4e6a7805aeac453c0362bd6d72bd739', 0, '2018-12-29 17:18:02'),
('936e28ce67e38bdfd4a4896d83945df2d65b728892adea49b037a1490c3af755a6f666ac93360aa5', 'd7e87fb06459cbff41bdb715dbba003159366ed0816c10a6d9c85c584ce8cab3c61f4663b0f5df64', 0, '2018-12-29 17:22:22'),
('93ec712b61a466a48e79a3dc9b6c4dd3489adf4e158bdc941d08b02871e514b5fecef58facf1dcd3', '8fb4c9f1d28262faeda8fa8731675cbbd6f8aa4c1876e31e9dc7c5a24cda33c1b606bc06c2d9a734', 0, '2018-12-20 22:30:39'),
('945119a0ebd484a8ec1093db9a736ef3b1f84ccf6dcbd353ad398fa1568d0e1f06fe926b04e25169', 'dcda87de2bccb3887e49c12aadd0134ac8a271233e890bfb5dce1bb48f6d9050c8708d2c72dce326', 0, '2018-12-31 11:49:55'),
('94bdc3e8b36826c9207113dbaae0e8c893b5496cfbd3f8f5899b5679155e7e2696d9bd2ea01e28f9', '164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 0, '2018-12-01 15:24:11'),
('95b0197597eff4bc072b61175021d892436787e90ef3c216e10d748f313edb12a175bd5b9bcf4146', 'c04424b9ccbb1fc478aa9a058a8f9335477ce59c9e8a5ba42c5aec42e9bef9bf857d98001b88b1a6', 0, '2018-12-31 12:04:04'),
('95bc677a5813712eeb8638a0d81885ef81dd203107dd0e22539e87fb0258dd543f3795dd9620e4a9', 'dca81bf2f5b6e7d7f4db4d45ba20cf64b28d3339492267256339cdfda1faad31bdcbd38b0e754be1', 0, '2018-12-29 15:41:08'),
('96622aa44a95854b120b35ca70863b6c898afa50390b40bc6b3a367936f015be97d212a463fabbe5', 'c332c876f32271b8d489d7fba04f04bdf4a04af650c7177e69beae5ff6ae4c161e34a4b90ee0f24c', 0, '2018-12-26 22:06:01'),
('966993b00ae8cc0a4581ef5b3dc1c27dc24874c0c01e0b406e1d13a1c258d05533ff81f329bb3639', '04cc6bf4a92203b3128d9fb7ab8f66b92a037ca50a82869e36cc55d458d7ec006c5ed48ff86a4ec6', 0, '2018-12-26 19:59:25'),
('96ac8a0ae3f499ea20bbd9dfd3de554e1f72269512519381c1a6a336c0a624c2e1ac2b25f8743b1b', 'b8490871552976bcd632a55d97df14d61fce55ae48d8f5d7eff0037b4f7a7bcdb8e864487f2f0c8c', 0, '2018-12-26 20:43:15'),
('96b0c95fa292476ed4d1c9773df10abbe68439f858a8b76e76c2204330b53d30ea9cd8c281935093', '4f3b5b8274f5f48d7389355ffbf40bbcf6ebb2d94213656ce864ec182961a12d10db8bc753a63f05', 0, '2018-12-26 20:29:41'),
('96b3e0a5bb7aa3991d16eae230c84873ff171626d5ec6fb38b565dbb37979d2347b83bed4b409c67', 'e7f4f287983ccadb79524ce78092cc10cd456146d77c66af71b1d0e8ede0d07e095ef15bbd48f733', 0, '2018-12-31 12:25:42'),
('97470f21dd14cd35bc2c7ed7a3d3bbb9f33207ef0d1acef529c13378e3f8b6da68a7f2176ff370b5', 'ea4030b0e4434652e20c510d8d8bd1efde4f26b017a4ef4baf47e7e8c0b3db09e059fd12971249de', 0, '2018-12-14 16:59:09'),
('988efed4c4e1cff2a0e74c411017e2415013b0851ac2f9d584d1b62b73e1a9f2dfa26c8e53847a1c', 'b6a1cdb173211dbd6f68d169d74fcb6e887ed021509367592bf503ac50130a8b4623c269f037ba08', 0, '2018-12-28 17:04:04'),
('989d95a197423e299c710de00e674964448814197f0a14efa1c50cb5f738e22fac567d2e4050d25f', '2de3b566d48234244738a534e4dab6ae5b150bcef6304ab19348241b91aacfd66c100c34833c8b5f', 0, '2018-12-29 16:55:13'),
('994c106786fbe13ebb6e5ee5ddee0888fcfddf53421c0989f9ca31e7c1c76d271d494349c111c046', '8555731f6a352dc6a5b107260a8a5825ccb9f6c48b76996e66fd70feaf1b5136563993f71e792781', 0, '2018-12-29 10:40:10'),
('99d8d75ca2ed89bad9f371c7ca2318e926bc775b610322125fd204e5176d87d7e03598819b90ab91', '21cf3d8c0c68edda4c4ccce2eda99dce9641fc797935e81982022f19ebcd00d89c0ecf090455abd3', 0, '2018-12-26 19:29:46'),
('99fafc367284e7008ef27cc2584865cf3a3e6408cfb18cb38e0cc0129cb0a462ebb6f73fc7f14a86', '03e9a5f11c24fffd826249d23609880c588b224c47f7b94d4ad56b27155163f8f3be3d1e47eb87e7', 0, '2018-12-28 17:26:01'),
('9bfaf0d80c2f261e87db7748961693daeebcd8f9684f26dd0d932728d8568c5d97f605be9c962b38', '62ae3fb5c4d4ca16dc7c525ea00abaebb13c73800dc376298efffb48720ef9f713908ae7c939a3a0', 0, '2019-01-02 10:01:39'),
('9c3279396776d349cf4894371280bdead9d0f9b185370e8708dd8a04e75e082538fe39051b022f62', 'f276fb0f6edb1158535133598ebedf76cea2bc1ace12c4f71499a27c54cb9eb8b630e8cb84668e0c', 0, '2018-12-14 14:16:07'),
('9c7b2e9de350daafbd62dbdc9122b54eddee6b9a98bbfd038a4b3448783030e5926cac80c373240d', 'aabdd1e40b15776612ed769e7bfc99206ca8969ac99c366a5ab4624adadc35084a68a415bab64062', 0, '2018-12-31 11:49:26'),
('9dbad9fbd80951db11e3b394259c46aee50aef519bd3b50e78efb806eabac68322d0d5088ff2ccfb', 'c762b5f0d75feb25202ff6d6ea617ab2230e2314940dd712af73b11f539fa67cf0f86f08502354c3', 0, '2018-12-26 19:34:11'),
('9dc0c201ee57bb6c54cc531218633d2da192c54321ca2bfe3f2418df392bef2ecc1e66db8265a9cf', '3e906e144d9b89cc884b65475c8bc85ea0a92268770066f6813c754459014169f0dcd6df3ff6364c', 0, '2018-12-31 12:22:41'),
('9e4592d077cf1623675dbcd1b83ffe8f43ec73984eb69db2d5bb1102947b24399dc01e68098615aa', '415cc0897732444e7b5969807bd0d65d95e03913d7457311b26aa6787372f3deb4d0e752eb770b9d', 0, '2018-12-28 15:53:23'),
('9e518801aecef47379f7a4fd08f7d296ae7ff52049e72f09b053d0ab3838c4747655baaab722133a', 'd973e17a483be2774819f4d07b2e9ea612d77d4cc1ab8e320adc0706a9f351f0f15f43f60fa9c062', 0, '2018-12-26 20:57:14'),
('9ea927d4cdb79aa0ccc465333f41c382ccfc95ef9e761e29801f6f74bcd0f6f9ab610cb073955632', 'f94e50b41b5bab08a7671bf8ea403c72e6dab0c5be9b2fb88ba99056cc409c7c567830f3e9e0d871', 0, '2018-12-14 20:50:02'),
('a03e5b76d299d226de29d60ce32b8f2304c506296dcf7d003e8b0cde5e8640bcf3ffd35d5ef5ef42', '781e415dbdf8523bf3e4a32720c9b5a73c678275682a890633a314ad23fe02aad7401574a0297b9e', 0, '2018-12-31 11:46:42'),
('a0c017c062925348a5939a2a7204a7fd76adee2bd228b9f5a4937054c284f8889aa66fc6f27a33a7', '85b6854c1c13287fa219e261862212e8524edde852cea75248fc470fa20ebf4d176b9bba648ccdb0', 0, '2018-12-03 17:26:00'),
('a255498beb560ba3fb16e64533b9a2df10c20a807f2e358b7da470ea7a92539dbdc158d7afccfc13', '18a269572a9e484b010ad0c4d9a565d020be841be84dfac798b4e7dc2bca89eb60a2654a5d0a03f2', 0, '2018-12-15 16:55:10'),
('a2ee8269c63b619851e44c19fd477bb9ed0bcd86d20dd00731cd1991d53f9a9186d1ef96c65fec43', 'ba5170d762930c9c8616ea3574833f0c8875858670a758518c1070a44a41109c680cf4197f620240', 0, '2018-12-14 20:32:46'),
('a32dcdc4fa12f361c9c4fd7ee6b338bdd3d9e3af69fc5586061a078453c24d78910e7f9317dc9df8', '2c37d683dd5bb10e9b0df00217b770d5dd10483b1e71e77286eb0cf3a18941f945d735417a7cc192', 0, '2018-12-21 14:58:11'),
('a37f62c1471573eadcf22f5c8f251b4e18a555a0d2844c03b169246e9e36993c8efc03d0f9cf027c', '48569dc830fc263ecf3de4fcdc9c247c64c50fdb8ae8d70b8f40272ccf07fe943d59bdf87ec471de', 0, '2018-12-09 19:30:16'),
('a4e420d58ccc59d7cb5c2d0eaff6908b29a47ac7761c502d3837af07fe56dee66473cbb5d5fe217b', '17c31704f0dfffaf1169d22d231246c0ff41664c76b84f43413e9b6f5620bbe9ad1b159b6f1391b7', 0, '2018-12-31 12:08:33'),
('a648bdf643b3720df120ef12f0a51c3410cb1b50598a4b63193903db81eea96611bba7c57eeb8cca', '460ccbeb41686ca6e64208e81af9077bad6c43b054fbdc1be6f779300a02d0ecc474de963015c21c', 0, '2018-12-29 15:56:38'),
('a66fbd4c14792a2ae5e9cc88caa33bfff1d1744ba8d7fa1eccd900d5278943b71f15c6813d7d9583', 'daf5fe3a24b7ae97536471cf5e11e66a876496451cb14f8d830360244d1bdaf04c44f9a82c8f80a1', 0, '2018-12-21 18:43:21'),
('a6c2e74e4b1bc940c65c4b42af1d36af084edcecf9275521d287ce6a59738483e55baba975ee300a', '4da07451c6ba15fb6137dbc974fcd138f18cc0b812ea9b1c03d8ba01a85b2517507e4b4160a9db3f', 0, '2018-12-14 20:46:43'),
('a6ccf7e7cb63d5074b23f226ea02d9146087c54a96488c7713177dd771cd2f27cbc64e43c96de887', 'd90cda9748d4e6d23f2c1200ecbeb823a0262f1c2cb370dc22793d78c57b12c0726eb75e4b83bee7', 0, '2018-12-29 12:01:26'),
('a7fd9592529a6a2bed40b8ef8dfcfda8c867c4d317de4a3339fca9e1eebd3857eeff5a1cf3983fab', '011e2ad30c5253c721ee0b8b0686cbdd0aa2ccdf701a175c30647d93a96732a8f62e98b7b901ab56', 0, '2018-12-09 19:26:20'),
('a800463679a580f739fbfab8941281ca2fe1342067a83b83e312292d1b1648d0660b2885b8248e99', '6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 0, '2018-12-01 16:08:34'),
('a832101687dc29676247e74f1a1c5cd25a326b77987a31b0983a28ee418b206d31044f90357e527d', 'e343764dce83b36b2e69f4484dcc5276722b481e6104fd983801170a282f60fea7839d55a6394c32', 0, '2018-12-26 19:59:19'),
('a98f7d04e48f8f4da7fed9ca3c01d98791efc81ec212bd5a99db68dd4bb5dc753ddc10c888a4e00f', '51c9da7b1389d47ed2b5255f4a72bc68fe908b662249cc30b88656124bac3ed1076cdc8b49b2a8ad', 0, '2018-12-31 12:08:34'),
('a9b34dc0c24aacb21b8a2f4064f64353d2bdbd00dd6374f17f1db84f02835775f8c57d137ea6d748', 'd89f8c9a7316e0e1773a7d9b9787f19c1ee5b3fee1fafe63c8d082a65ee7829286a71834088ab47c', 0, '2018-12-26 22:06:50'),
('aa24d98c5fd9555be93e216f173536203f7b3239ed1be1afa45a01f553961f32a44f93629ac62012', 'ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 0, '2018-12-01 16:02:37'),
('ab5a229548ea3b66974af51d499fedfc33254fdc489cc9cd3a2957a10f29fed27d9c580d69b46832', 'c77787f8603d6da7cda7ac9956d3f721be19580c521d5b2f04c3b717d092846e57c40dfb02d158e9', 0, '2018-12-28 17:25:08'),
('ac7b64b416cedd7cdf5b7c72b74580ef2ab51be6355754719533fddd966053d1f47498ef3d75f207', 'f8d4d63308ab809d67999bba766be2d6644d070f5d73cfc92bad767c20cf4b1c12f9cdc236cc7c3b', 0, '2018-12-26 20:23:46'),
('ac82ad31f5d8b1b0028d724fd2304d8c1b1b1407a796de5a9b999e701df11fb75fc4a237ef156423', '3b41a83806a95514cfffa64448d8e235dbd2f53998ebba454bea0a540ed98e5fe6f3e7915c094247', 0, '2018-12-06 19:35:50'),
('b0f46ea2523d46a95a1b8d086b2157ffd098581ef01af57d1c7635355d4dcb3c013e7de6cc194d18', '19a290bb7a78ce80a4bd95f2862c43f57357beeee4d2656bec0054c195b5bc56c73a37d0ed1b3ef7', 0, '2018-12-09 20:00:56'),
('b24cd0f1d7ede9bcd9a094d775bb68073fcc07b9921615ebd118d9167e493fa225c3560f6904068b', 'b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 0, '2018-12-01 15:20:26'),
('b2cb6ddc20ed6d7c8cd139376b14bc8e7e3ae72ec43da67c1ff420a7f10b41420ab058cd3bc2f0e0', '7d4f5ac5543891b55705c7b821dd8b62e162439eef0a7f2b4baaf70fbe0ca0b26687cce811685e23', 0, '2018-12-21 20:50:07'),
('b318b0dd781d101996ceaf8240e12f7ea921b947d8a3e9abe3f43a8a7ebc185cd21ed609c49b4fff', 'a5d35c303b0caa8b766baa33856f9641c1c0c326c73c6e959edd9a3d20198f48eea1af3d3d5a5e46', 0, '2018-12-30 16:27:07'),
('b4d5237bdc9f54bae932b67b758f84ffca7d6ea8df0ce1d11c156146a0ada167d5a88d9a0cbfd05d', '572fac41f901ce6400d691c8f3c82660039f4617dccdea32b67d69237bf3763ae0144d7628cd4545', 0, '2018-12-20 22:29:44'),
('b4d597471b7e15535917741ede6e5fd216201a3d343589bf920a9afe9e02ca0e78425ae12a4a3552', 'b3f45e1a5830b95fbed42eb4acf56825d7f856ae8aaeb37372f1db7f37711fd4ad1b79ab9c88d723', 0, '2018-12-14 14:12:15'),
('b54141251d96736af449029d557acf575dcb8543afd811f4fccc188c63164692841de0940f567284', '97aeb19f32ef1a0405adda0bab665f16968f7c681edb470bb2cf4031345d4e3c6d868190fc7ad538', 0, '2018-12-27 19:34:55'),
('b60fb385d8a99767ad72f2c4ffb4a04e714bcd2e23ed2dea3950507c42b47f96f7a0fd77e3b10b5a', '5a9e18777f2e142e12860c1a14cb4d222b7977aece909e963f75119bc70f1cea1a6ef292765e4709', 0, '2018-12-21 13:39:10'),
('b6252616b57f4af56808935ca1536c2e60a11a3b9a92b26f84959428457b24d4118d16e8487344aa', 'c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 0, '2018-12-01 15:56:02');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('b68d4d236ca710b0e9a70cd0abada5c6322611ba9d2a72f7b42f3cbee6c1639d9f7994e8e62fa002', 'c54737712afe14f3d7ac136148ab85091d0a84253a3b7b835b9ce1c415a91f0e540110bcdd8cff7b', 0, '2018-12-28 17:32:23'),
('b6f5d326049418b72e24fa96539ada01728d08a7bc266c0733076898e51875b2191a4d6f6c4015c4', '05d82f1a8d0b7d258e41bf6c87a00acb9ace1b140401a21a2b56a7dffe99de51a973403516b949fd', 0, '2018-12-06 19:14:31'),
('b72c0571eaabbcfe375dfcb1f6359b1578c1ace0551b1fad2ed21485bef0d3e3db6b3c3ab3e03d90', 'aaf4cb54bd9442049a210929bfbc92d463b061b0ec529a9e7507fbd8348c78f5e8700e76255ffc1d', 0, '2018-12-28 17:23:44'),
('b9a7236f7528ce0d0d2dfc980f874b508f916864d1215ae647b7dc69435b1b541f99de1c336decec', 'c2fdd2aa164853e1531dde4946a73a9a2ca077ff51e0c8913949a0782ec7d3a4f01dfdfc19cf6ddc', 0, '2018-12-26 20:51:12'),
('ba9bc4dbf203edbcfa324ca700538f8b67b8edfed97dc0d41c5a8e00a84ca13bfdeeea3a0682dfa0', '89a76593cd524b1219cd98902ff2171992eccce2573b145d973cfd51b0ea21ec58276c4cea1e2cd5', 0, '2018-12-29 15:25:57'),
('bd2be637297d4246163f76c6894861c209dfe11af7ae2833ba7a7b4afe0e73bd5cfef0286259f335', 'efab4b13a5f40600bf81f4d8f096d2422977703a90a455461c2cd916d54e6a03f66a71af0183f4be', 0, '2018-12-03 15:58:21'),
('bd82137629398161ee5d51895e0668496804505a627c32673b3148a91389a07c868479f952ae9702', 'e3e4aac6e1a158df8092a7845b570cffbadc44d5f9966866eab1ae1319b596a041ca57c951c76cd8', 0, '2018-12-28 17:22:25'),
('bdae86c1cf95a66f1fa024b482a9eaaac0d554aa6989f8a1d63ae9da1578d1ff8f5313c35b53a1f4', 'b8517a1f0173d744c151c0d78d754e29b319dc1e3f7b3b1b79ad5536c4df9d89ed6ef5c3a5a758bd', 0, '2018-12-29 16:04:34'),
('bf0d6d1fd46c63d94f77bba9d2a667526a277873fa2b950930f85d453b6164ed95a95ef4e6d85ba8', '2bcb381f76493d17b00a3316bd0252179a44d23ee7463916f61c8e8cf4b4f2bb7e65fa7359b333c1', 0, '2018-12-28 17:31:34'),
('bf1f68ce09465fb89c28ba4b99fbc4ca97be242b98cdaa0f404d8602284c7a8afb23fad0774e2d82', '9a737066e293983d36e886a892f39644e632ad6c2263a18d4ea5c4fbd5576ba5b669528946258253', 0, '2018-12-06 19:43:29'),
('bfcf0121308dc90b4ef971bd4ca63d49313a5acdb9b6a8abda3b2092134afcf2ed929a4adf17d957', 'd7a152df1b30b71dd23d7f12dd7540b636a92d55879d00c2487e56b00f83b185c17ce4a95cd15585', 0, '2018-12-28 13:56:06'),
('bfdb70859de9744908fced28e8d18c556b2816913f47456502cbf61b1ec09444966c099cbfeae89d', 'b5b89535597112df675602f3f202211101ce34bfa7e7c1b60c94ffa16a7688d6fa2c87afea830d26', 0, '2018-12-31 11:48:47'),
('c0b780481adf6aae83c8e6dd468fd8434c8446d24b892334008a39e79ed0e8ba316d1b10ba66a5cb', 'fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 0, '2018-12-01 15:25:48'),
('c1d66fcf11f3abdbbd9bcbb5133e4eb172580c5b9de0a5a3eadef098e281f7a7225b0d725d5515c1', '909cf61d0a64451e9a9fe2669d9e9c7168ee6e1d2f8a6200a14d40816af6ece39783c5c80358b154', 0, '2018-12-20 22:19:04'),
('c1e38c1dad52895b50be218165b9261e0d2e6dc1da70716664c6a846e823ae21119c5e7389be66fb', '541ae5232ad78d30de5f04ba41f2a974fb8099f967d000b3175576cadbcc1fa04a0dfbad14da1b07', 0, '2018-12-21 13:37:56'),
('c2511090b7cac770db354e48cd30074a6d6e7ccd84d75ae78e36d8724ff29205df2deec852e3b0b2', 'f92c652714b810262e9388153f5508596dd626545e905c29c5570cad77b572b0ce80183662e9c704', 0, '2018-12-28 17:12:44'),
('c2710a3e50443989877be01be6a487fe6ff89d044baea6984eeb1f724609c79451699027bc592b46', '090ef8cdb9e1a41a9cef13242aa110f23f35c6b257a99eaa64911e874e1f5aee88c27c98e4bb50ac', 0, '2018-12-29 13:57:34'),
('c42a08a4bdaa4c0a485ac173255e99ed218bfd3eb28f05db99b9c69f6baec87b7ca601fdd21c8c2b', 'dac308744696aad0f197c6336443a13656f79c56cadf125a054e03e654e9055e1ed18d5fb967fc5b', 0, '2018-12-29 11:22:19'),
('c4408702d70d75415c921b376636119a8568657e1d31f5902d2b08a445f53bd0cdccdd791d5165a9', 'e8eed6fbd5728f0ce8974d9f395bc29f0e700a256b57da76a4649d026231f8f8f65ce0b5adf03287', 0, '2018-12-31 12:15:59'),
('c5a60fcdb42b8af6db4d2df4246018523f2d77624b89a2f440205fcdf095cc3559a83ade65ea9bd8', 'ce3c3dd6056624558648c53d539112d8eb32dd527534d971952f8651446703a175096653b69a4c92', 0, '2018-12-06 18:58:43'),
('c6563b4d2c71e89af206962889dbedf2c5aff0fe8fd95fa3c79a5518f7b8bd6ad124e80e4dfe15a3', '7d0cf616af51978d07b90babceb790c6b3e37b832c1543d8a5870fcff407d1e6a8d30f75937fd340', 0, '2018-12-29 16:08:33'),
('c812f8e73b005dbe47abf8995a6d84bf120f0481746d20ef890983f0cd81b8296c6ce0cd94e77073', '636a7ba7f6b57b68c08ac434f57109ecac87733824423f6e1301857d8511f7c40d53a992d7369dde', 0, '2018-12-29 16:59:00'),
('c8f59cda7d18ed94ed69c343242cf0dbcd36f98b150de34bb3f35e8d0ca64d8e1421f7f4f23d0222', 'b64799c894adfc5a0619e5cf7296970a71b38047b3f13a0eca6cd69e535280442b5385391589dc3a', 0, '2018-12-26 19:29:15'),
('c9b3040882bf4296087f9b09541a323c65fd42deaa85e2bc1e96b22e3ff9b2edd6cbbc5c8e95c4b9', '3e68dda3d1a4f648869728489d339581d600dbed3af1a21b9cae4c3b87f06072a885abf11d7c4267', 0, '2018-12-31 11:49:13'),
('c9f4fdd2b5eaa7ed48c1c4748d35282c8b48afaedba9ec7d9a92277c82c3bc48a2a299aad98dbf2f', '5e44b34a1e7a2f0cd418b2942015b1e395cc1d5839c90c7d0cb82afa372c4a047d854a43d8573251', 0, '2019-01-02 09:34:52'),
('ca029fa68ffefe442417417ed723029878a4076992d88705211d682428587bc378c38c30ece0f12e', '40a811bb005bf00c28e1a010f6372002cda948fe046a44a3990659be5a1cd57d7793e1b8b25eae32', 0, '2019-01-02 08:57:27'),
('cadd23865fb5282a079e6ad5209750dbef6dc792b7b1dae938dcff265073eb5014368f61f68aac1b', 'b4649f511a6416d76ef8d03dca86d6c262a70734dc3044a924af37617b606057c2dea0dba58fc261', 0, '2018-12-26 20:19:03'),
('cae1da42a8aecd3972699274a976d527d50fc2dd8b35472f221b41efa9ef350b6a46cafcb5b76c3f', '20d904b36ab31e6f7631d891b4c44deecb9f5cf2721613e17c550ab993579395a5a8bc7ac9f3b485', 0, '2018-12-26 19:00:45'),
('cb3a7bbdb0694410cddc4287da98e7a1b5389e418aac9e58ebe122ed4e55b15b3fa339bef34cad65', 'bf5ccc5deaf0903e6090e3a03aaadca452e5331a6e3a910a88ddfd70a7b64bbd5898e06d19627348', 0, '2018-12-31 11:45:47'),
('cbef54ecaf1b3d383e35fec2d752955e60404b42834ddddb3fb6dafe72864787d6aa35bc87c90983', '7669e4e012fc345ce6956683d32f5b3cf581c232417d1714b19591395f8c4d8b6c42349b76573ee9', 0, '2018-12-29 12:01:20'),
('ccfd78086ad663795950e96d8a6889ad7e0c719cf7a3770f413671f73e25065725354a42891bd011', '5bfbfa12cefbc80484d550c54a067dbfeea6d1bf5eca37ca6ba650b2412eb7fd387d11520db3dbfd', 0, '2018-12-28 17:08:37'),
('ce31631fad62ed198c80e3c9af7bd76efb4148dcf35d8450dee37c466ae9e2ab8499576759f2c4a8', 'b7086c6bbac63724c48ea779253e591483390a20b5e0e3141283d24d511bd8b77f4f8257e8d01ed8', 0, '2018-12-29 12:03:43'),
('ce691e6a45018c84d6f1c21a93109dcf1f120f3c26a21af951836d13d11c0d63475c13af111cd4b6', '4c2e7a902fca135e6fd398a7a81731eb882c90f94a4dbeb7e67a088070668a365bb7b1dfdaed66c4', 0, '2018-12-26 20:01:13'),
('cfb3660bb62cd540567198d3e3ecf1534286cfdebae527b4bf53cd7d8473a5c3142c55acfe07e8b3', '59b9b6f9d67165073d2f69df8c2df61503e1b43f1b73888ba370b20cc65694bff294761009ea6c75', 0, '2018-12-28 19:56:03'),
('d09e9cc6f6292f9d4a0e607f48bc5432d865ea8f1b4defd95928b147172078d3d475effe2bf10ccd', '23341fb96061be38a34b4dfc93e79edffdd605c7f5638cdf7e4f7f686a8fe7f73614d19bcc3be96a', 0, '2018-12-28 17:05:56'),
('d0c5e28ca7b88b969c7317433a32dfc077e9b6611965e74c7cc3cac982c303308c7dd6d674d2438b', '5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 0, '2018-12-01 16:53:26'),
('d14378ace66f00bc371f6c070abbf5a4ac1e8c80cb6b024cffd3f1081557d4c54da54c12f48b9894', 'd459838c22bfa168d9236ba596e21e32580d0b425520c0cdf7bec7d7bf32503d5ebe30f34cdcbcd7', 0, '2018-12-26 20:02:31'),
('d1b1190aaf58bd968476b33e53ca5087b767b0a8981986c06f9b13e6f81aa1f8516228fecd4f25ae', '66824d7df298de700a170ecf14e4ca1eec32dcca6ae6d2d1a3c725e152f988e0b3efd319bb212ffd', 0, '2018-12-30 13:50:18'),
('d40a2b8d032c75dcaba76ccf2ac1bc7cd28c4cf2a35bbdf5621b90747c4d879ad880fced30564d67', 'a8ab160268dbf75eebb635bc3788d741abdd83339eb990adffa6333a613c311c476281fae1fd6672', 0, '2019-01-02 09:34:58'),
('d524a173f5d3f59e5935b17fcd9c39b5479b0cd90b27769942c5e20536a6f1db2cf65339da09aeb2', '13165a9b3478f3fa04d8cafd104b4be2652cf7b83c051156ce2bda6387cb12ca452a3332bb8c1fc4', 0, '2018-12-26 19:00:34'),
('d5b9db03f4ca605addf7f8a0acc9d8f3182e3fa904167fed14bbf3b7cfb12f848a4c45a0b40bee62', 'ba2ca337e994e8e39974d192d1efe9193b1a486ff4b1c6463f7e5c6cf4887a6b0c2b1bcc307ba2c1', 0, '2019-01-02 09:19:44'),
('d5d076dfc47a88ef46e61267e3ea9c672a55ba4ff74023fb2da3e70626d076ece63a65b3f2dd7f62', 'cea6036ebb389b7efb557236fe8283402a48edf26514d5cd3c2afa5b4922d9da8050f7a217471ec7', 0, '2019-01-02 09:28:29'),
('d6c7d40523d9118c283104ae97f0e2fdf385f58346109726321d7ce641388a8e108ce77375e1cc66', 'b87f78b4ce12481f43948be378db7376c80734186a1fef17c552738d82e279ec64b140a67322099e', 0, '2018-12-26 21:06:29'),
('d73ce27361a27f072124d0c7f6fd5b18c4e4d887aee0bc7d0d1ada6874d7d7de8664220f63e91014', 'ef81eda3345791218b48451301b8e0ba2066f3636083743f314886dd338aa562abacc035077cb90a', 0, '2018-12-29 16:47:12'),
('d7646c7468080d734c3da6520f5e183c3dc55cde05269a10c7ef3989e1e1085a39a5ea6f5034b370', '60b749bf878489a305f6950400893860f4b55582663ecbe21af174589e3bcbc09c104793e07cee2e', 0, '2018-12-29 14:12:08'),
('d78b6c80d9c51dbef6d2fa6b8eb801160a37520c63464b522fc1e7e92da72d38709d4734a7ee75d8', '63c77b461a9e33928cdb31b0f2094f629e2128b375b37fca29d0f17530fb66bd103f3ac73c295175', 0, '2018-12-29 16:48:29'),
('d78c6ce7927b28062fd9d982f669f3482b67ccc76cd9fa70f76ebfb493d1aad87e140c291b894381', '3a8e3169c4d1fb1c34c5b1b605c29c6d44cf787574680feed21b3973967da45ba6177dad0d522d65', 0, '2018-12-28 18:16:09'),
('d7ac0a554d87faa36dedd6037feb64441fd65c0866baf8a5f8a6b25f0015716962a4d0adb0a936ec', '76adb15e5c5523cc5fdbe9cc24fb7c230725a61f4e68db22ea6ab670dbc28605901d0c2038319b1e', 0, '2018-12-26 19:24:56'),
('d801a76a05e5b574b1b6a3c6bfcde982d11f426a933b3cfa1730c2c72ebcfca1581903a85b8520b1', 'b084930759576e49fd770b3920a4c83e5b684d15e0c79b1b75f46d5b80835c292133dd1f365eb59d', 0, '2018-12-13 22:32:57'),
('d92ff4e9d6e34907dc816ce3c7ca9e5b0da17a7d99d42a1db4eaa0f649f4a08b898ecb7f7b668f6b', 'be7ca61cc8c98de6ef1b2667db48178c192aeb6cbe2b7648e65959b562133c129e34c26dad1e6618', 0, '2018-12-29 11:23:32'),
('da4a03b8eaf3f8aedb4c901aef384d42c5f85305661b8bbf086b06ef54517133a1057c61758d1a7c', '84bc9cccc7118d94dcebbd01c2870a565cf6fdcd4e6ed371ee74dcc6a9beb4bea9faf88f573cfe47', 0, '2018-12-31 12:03:57'),
('db998d491a385f877c3b9b4e56b73ab8e9b95e7618875dca635fb23cf6ca7daddf5d1922be941bc8', '73fd7a8dbb3f94aaa12498f400c1c5126f612b1e24924d79872fc282d8e4f7e824f524bfc3fe0641', 0, '2018-12-09 19:11:33'),
('dc1c2bbd7d95c9f49c8f2072b9135b393fd14b5d6acc849055dd097a8629f5fdc6bc051303da034e', '1a284a5bdb861456cb01c861e27c934065937ab83e838acbf2742ea2f71f2df0185f0eaeba379385', 0, '2018-12-21 13:38:27'),
('dc4aa8ff230da4348334e5b5a48fb07765b92a5535f7a159ad3423e2e7f8077d478d7df855e34e00', 'd8cf67f8b039a5ee1a0867dfc2cb3ed29c295791cd9e736a6ba3252a7de6e3f9df0fb23545e8d3eb', 0, '2018-12-29 11:55:42'),
('dccbe0cd40ed2a909bf753c47700fb0325d7301181a7297f8c65ea16f6076b9d956e6a4937c86153', '50ff640820ba7972b3fad6c57f853ffb4178c7183e820c0ba6a549485d4b71c67b84cfc1597a5cd7', 0, '2018-12-29 14:42:08'),
('dcf716f9f605494ce3b0fa84c3b69e8407f202a5edcfe242f7412a0599af6128bd047bd3f8537dd6', 'e971ce64e958a4b515474c8b764ec4014fec2f0b851967eb0c621a393f1d467dbc7af4dd4c299755', 0, '2018-12-07 14:35:19'),
('df3cc7435f1d694316b6337f7c83a97233b4cb0dfc3dd1c0e138e1e404f946b9a157586caf458a60', 'c47eac0e04dc7938256385315c4855a78de14699e1fc2584c11f9bf20d86ad238f3e0a496696993b', 0, '2018-12-26 21:37:53'),
('dff20f48c02273c218269e4c37ee98ce56af4a68fa0fbaa450dbc9a31927642c3f0cb0843d43df3d', 'bb2994c48b40d6b0ed3e7619ff32c54d2830795530271067569f764615e22623f67b7c7b81f622d0', 0, '2018-12-31 12:22:05'),
('e05059e6a20abd9b38145ec0f26ff30046621c73f87313fd823e001578d3eadd2631084579a7fa7b', 'df5e99bcee850046416959db2e4c59808131f2c992a3f7503c1eec6de20401b88be44b7e54724c9c', 0, '2018-12-31 12:04:34'),
('e16a869997f7e7bbd249c2f5d9487787149690b5c0219bf2a45000a80e022f2f03a60e9d7c060309', 'bcd84b85ba160eca1d6639063cf3537929f89a8b939e18dd0a6569df636b96c181deef3545b0c5fb', 0, '2018-12-26 19:59:25'),
('e23ffbeba8d35ad378e479b2bec140686ecc7c4c1bafeabf60d85e091644471af5e7dc429a1a37ab', 'da2ed132c08932fa093ab7ad20425ff3209f2db847769b928952d36215f6c5990260b4399b3b1ef7', 0, '2018-12-29 17:17:15'),
('e2406d3a36cb65470e666ef2c8033bc3b331b191412e72b344e612b1211b2f4fdc52b1f63d320219', 'd1401edaaa28c09473c41c4bea1fa86df91263c54d6e291d07519753f2c20eb6793749f3ccfae849', 0, '2019-01-02 09:22:24'),
('e31f44554450e177b6da276055aeafc1b9a00102abeaba248e861171522feddfdd3bdd097feefe34', 'b630ebd270dd09f45d2d95881eef47bd33ae99f9820b76864a00ba6b9289c854dead7126fa65a243', 0, '2018-12-28 18:30:45'),
('e3ff16baa13e07a3200ab17b273b11fe7daeff87f24fb9187d20723e4a6381740bae2bca8bcaa9a6', '344980f9fd8697cc023d89a238cb50c6f89d83ca030b59fde9f85d321d9d90f3da2af7fa83760886', 0, '2018-12-26 19:37:23'),
('e49f951c4fe8279e4e4583c2f28e4f5e6551f97590cec34de1ac060a1ea79c55d2ef383f4af4624b', '98440fcd13de7391e90696372d06f2dac6cdfcd005301f47ea1a653fffc12dbf8f1dd1b229bd08cd', 0, '2018-12-29 10:19:49'),
('e558b817c27b5c4758e54bab9303345b2eb9c478b4766de2cde79fbb1459b140e0fd0ab10062d379', '7bce1f5fc71dcd7723523ff366d18f2bd93c5cd74e4eec1085492ce490894a895b4336b9a5ec691b', 0, '2018-12-26 21:07:47'),
('e5d0cca96ef6caf010794c4dc1334b4e723cfc4158e4370aef609c699b8daede466e00091fd85c6f', 'bb148451a12a51a155d8bac396f08ee6b80bc5d2da32f58381efa793286e4eb6041ccad9c63bd5b7', 0, '2018-12-29 15:30:36'),
('e5d3a755401c38b9931faa4b8c5bd16bb094892c2a5377db9a312e901df87bbdba84ae5734f5c033', 'b9a3b481be1da27de8c68f30f8bd0d62edf463f347cc5dfe8aab827a0d46b8b7c3f85791d8cdd7b7', 0, '2018-12-20 22:26:22'),
('e60e9c0128d83b4f8454299ebc532b37c8650d96101fbd1add7847a7ced1e2be331fc903aa0963de', '64c73001bc1c1f8e1ff956120701d0d8b1e6667bf76ce1c085f7f80d3538ec6a108a97bea55f1444', 0, '2018-12-29 15:51:49'),
('e6889954f525d1dfb821f17d53d723ec6e513ae15a7dad5890f82f6a6bea06586525f667ab45a0a7', '9719ae011bc5b68a8a0bbb2c4d5fc884198481eae5654e49b77a42fbc6694883ff3c94d5c1d4fdda', 0, '2018-12-31 12:04:01'),
('e6ffa80e878c4920c4577725735d5120c564ee4bed5a98a41756e3d9f43278518356c1a481a5c056', '087d7cf350f5322fa84ac974be411d753a3744abe8f0fb1f381a731d0df5a7b52b17704dc10f5362', 0, '2018-12-31 12:09:31'),
('ea75720214cd847b8fa946fe1b92567a42838f8870a3603ae122931f56b28737a79186818186ea89', 'd52af45d282197f41731e7ec711ab6dc62875d22f1235ed8e10ddf59461d53285307409881cfecb5', 0, '2018-12-26 21:11:45'),
('eaa39ac99f7bc14fadce8ad87616fab7a615e492b932359d882818a7601e0442b97be57b4c8a706e', 'ae0c05c52fc01af8b14cc7eb56ce44acfd7dcdc057a520e3524c18c1def102a58b77c75540f8ab60', 0, '2018-12-29 11:21:57'),
('eafc0f2a900fe7cf9540be2b35243cfeb5469ff17ff45bb2e37a8102f3735c8381f7039911c37673', '3f517f6b978c9e6cb39fd02c536cc1b59bca98dae9df8e0c482c514ee3284edc04ff4044bd0838dc', 0, '2018-12-26 20:28:01'),
('eb03631214d132aa89604ffb74d4a0f51a5a35a1f073aba1f391a0b2e93a0ee671ca2aeba27045f8', '49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 0, '2018-12-01 16:04:46'),
('ec807b2e315e48b6cfce38779c87c8b2c0f31537b47f22f7047f60e0e9d0533115f7dd6cafd4062d', '5e429a9e78764d32465ec73f80b8d704dc88e54b115a7db3c59af94ef59ccf2c869762713215c715', 0, '2018-12-26 21:13:25'),
('ecdcb8036df7087d2a76b225549d34446c7cb27148bb17af9f65fbcf148d3b1226c5b3ee62ccd9bb', 'f8e5c3729e53028d11afbd862b61edaf45cc7feb64d6c14a44ddd174abfeda379e14db402f8beb5c', 0, '2018-12-28 17:05:55'),
('ef4a347f18c87f17b1e3d306e4e767a4ac78a7966e7d56171e9723be5f540b3c0d646b2067ab5d59', '177781d4bbd65184e0d754a98433ec192389f4eb0b7df3ba03aef62af18449bb1c5eeb5c08137b28', 0, '2018-12-28 14:12:16'),
('ef696e735d8b0b42ce039d59b03065e53612ae6ef58dcdf28f4abd4eab53d1032dc66a23bda69076', 'c4561aa92e81b4e9f0b54176d2a98ec19326bc871c4960b08689c0bf525f260f787ef70bfc191d4a', 0, '2018-12-20 22:16:28'),
('ef93434b106d66431b1bee1501760f8df55528b0e7e8a4da74074cfc9035d31078bb89271ffd3cad', 'b88bb94d31a89b2b891f63cd87b09f397a8c29702a222384afbc6b28f3195d4739971c40e8676c9c', 0, '2018-12-14 20:52:36'),
('f0699885a7dfb3e28586c990a00ab7010cdd576f9b6dc04d41a193b424342b6c2f9bbcc5540ec268', '52c17dc3de24c66ed7113364019d430cdf6e27da45e3e69226a432c66ba5d226a0e8befd4656e37e', 0, '2018-12-28 16:37:57'),
('f092fcfb96269986c0cdf5c4c448b0ee579ece831a32379ee80d91a6059505e478f1b4692ab7a4fa', '3e7a6a22fc7ce0f9ad6577c35dcbb08414769a18849c9c1a22bef5a2e71e0570826da6b56f9dcc02', 0, '2018-12-29 16:56:21'),
('f147cf09fb917fd68ba7ae35f49ab44eb4241fd020db2fef163a821130a6d1c0ac8e9c5f3a5bdbbc', 'e560c1038789c555c815afc43c7d321aca2428faada47e9eb8095dba20976cf00e959320bccbf640', 0, '2018-12-14 14:12:49'),
('f1e957e2e93d85a5f061c3daa20c43a72255670587d966569217cddad6c5f7f320fde1afd153267a', 'e039c6d3b0910c91500158287a25cf512ad9d4f6f9b45b71ef95eb16f052e6ebae02abc1c2153e00', 0, '2018-12-31 11:48:41'),
('f3878fcc564b6c010ac92dd793722c39f8b25336a9be73acf33bbab7d28d1c12e75a2dfa00e49681', '83a168ffc00df3a239bfb3ae69b8adf8e7a8db0841ee1972684aa531b6464021b7caff3905f7d850', 0, '2018-12-26 20:30:51'),
('f3979d738bcbcef5358353ed0115323e22f71a9dba897bb841b88ce82ed629a655f536f705aa74f5', '648228a94fc3012b5cbd897ba906431302c020a8db82e5d26df400a36193b0b4fa6380e8ae4cb6b7', 0, '2018-12-14 20:59:55'),
('f889a883e0ea6e0821fa77ccf35209befee7653e63fef8e168ecd41704732e1fa98ece6ea59477cd', 'bc5b734c7582563f9a553b3c2d865861af3d1673977104ec1ea4cdc4abb6fe8c2d948f205cab2301', 0, '2018-12-14 20:51:05'),
('f8a11166d5abc39367f8807111090c777a9ea549e9e83aba6967dbab83c743fa637659a80e7aac4a', 'd2935526316482c152e4587ff8133e411b97aa152d952922f21eab7641a9f4c9b9ce420e8ba64351', 0, '2018-12-14 20:46:32'),
('fad375ace6b7fbe23b821d38f539f5f343c5d21ff7e996981736901f997b7a144da66ed194d3e6d7', 'c94a43b3faf6ad4f39de06e35ea1abb3f82408a44e3b50022e82453868b0b4e3a942c4e119380e31', 0, '2018-12-13 17:40:11'),
('fb4ebd3d1d2131f0d65ceda453a7b6d89ce335136dd6dd57d9dc75490776ad849ada858a222303da', '555aba5493567164adbb30fabdfecb541a4d180e35af013f55533f78e98502e7da4ec745e5b9877c', 0, '2018-12-21 20:14:01'),
('fb63a4e167f38d7384958a171768fa77b5610b56befc2713c60990d44166eec46df21d5800c35a09', 'f80a5d37826b936282fd65a90ebdab5d9574667bae196651c15548d5de79bbd78bdb33f7c3c2fba7', 0, '2018-12-20 21:59:42'),
('fbfe23961165b07f391163783a44f679e494dd7db3e89410c990b2e87624b1264d92e7134b8e7032', '2f0dbcd0a076c2033bd55eee71c08fa4112828600596b9dda8cac27d64d957fd0101638758ac2c58', 0, '2018-12-14 21:18:24'),
('fc42cd2d8b4152ac6e293b8f9d091ff46491d8c3939d3b82db8c20593bf197c6784a42ab6f5f5896', 'ea39cc9d8c848771c9ac26fe1651aef5a0114412fc3298dc709a930375b63aaf47fc4306427fdd9b', 0, '2018-12-29 11:40:28'),
('fc45c3df27096f0ce7796e6ee9b64e83ccda96b750e245109b032700dfcdd3615a5e22dbf6ca6f3a', '38a83441a7339badb4b8b7fda5a4580539534e55b4fc74935a65af3ac58f642895672ec0fc695716', 0, '2018-12-29 10:54:05'),
('fcc442b41b33c768b9c281843f1f8c5e6d65868a532a4d95762365286209de08d27b86ccf7cb6a78', 'a95905954bc92d7a2955ccf0badb886f37f5645817519ccd0e78b0cf516dc388d03e3db75cd114f9', 0, '2018-12-31 12:03:40'),
('fd53e6d5b3e133107a56b985dde24a0b4e79d5a876f1111995034f28c741400993273fdcdff173ef', 'f158342c1ab69df7cc97d886e0ceface483740480b96d99afb824cc358be8bec8af2b726ac41ae7c', 0, '2018-12-29 10:28:42'),
('fda0702978dfd375c7e049ef85e9ccd32d7204373d8cf631405176a8faf73006f73fa208563bcffc', '5ac03113ca656d1bb0b0ad7192d75dc97f6125412a679c28862d8edc1203c0d3e93e50fae5b15c20', 0, '2018-12-14 20:43:25'),
('fe5fa0baf869c39e40cdc2d66749ade1fd5b241c23372f8502eff4ecdb75bb21ca9443e57c6a053a', '4816787151f1c99658585232a1ca96cdd63bb324712f15c3bacc934ed35556daa02463935d779bfb', 0, '2018-12-13 22:45:06'),
('ff5b184ed25925c2b239b20743a0db483cbdda973c4ebaa60f289efd45a8375995ddee77184b3ad3', '949cd4932f25b125dc9603344996616a90582192e4f9d6c37b03c2c00fe2e651b6c618ca19dbff63', 0, '2018-12-26 20:01:10'),
('ff7e6cb9db2cf505d075fdb596d738517d2306ff8f550122bb6a883b2d5140233a2d5baa9ff67a03', '7133114f95fe4268613057a1884b4b831e6aec6c98189508ee1d074f021a7101e03c1dbac807ac30', 0, '2018-12-26 20:52:47'),
('ffefb6031ba9c78df868cf6a1c831fe047eae549f31ba55367bbf632215bfabb6f5b01cf7c9381b8', 'c48557585c005cb258561ed382d48119d698990c44c356739023031c62cdba0b0559c2821dd4f185', 0, '2018-12-29 15:36:31'),
('fff201f4cecb6afe0ec8e87a55c92a8087d03a481d0c340cf3d11f84cf28e4cf4803654be474c9ab', '96fcb5c7c23a8f7f89c26654766b23a200ece915fbb490a0bb0f1af2bdfc90a74af4624f6f856b6c', 0, '2018-12-26 20:28:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papeleria_consignaciones`
--

CREATE TABLE `papeleria_consignaciones` (
  `id_papel_consignaciones` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `papeleria` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_consignacion` float DEFAULT NULL,
  `valor_faltante` float DEFAULT NULL,
  `valor_sobrante` float DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `calificacion_pv` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_trabajo_asignacion`
--

CREATE TABLE `plan_trabajo_asignacion` (
  `id_plan_trabajo` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `idcoordinador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_trabajo_asignacion`
--

INSERT INTO `plan_trabajo_asignacion` (`id_plan_trabajo`, `id_sucursal`, `fecha_creacion`, `id_supervisor`, `estado`, `idcoordinador`) VALUES
(148, 1, '2018-11-29 10:46:15', 1, 0, 3),
(149, 1, '2018-11-29 10:51:42', 1, 0, 3),
(150, 258, '2018-11-29 10:58:22', 17, 0, 3),
(151, 258, '2018-11-29 11:01:33', 17, 0, 3),
(152, 258, '2018-11-29 11:08:18', 17, 0, 3),
(153, 258, '2018-11-29 11:09:19', 17, 0, 3),
(154, 258, '2018-11-29 11:13:08', 17, 0, 3),
(155, 341, '2018-11-29 11:14:36', 11, 0, 3),
(156, 341, '2018-11-29 11:15:56', 11, 0, 3),
(157, 341, '2018-11-29 11:19:55', 11, 0, 3),
(158, 538, '2018-11-29 11:23:13', 17, 0, 3),
(159, 369, '2018-11-29 11:25:28', 17, 0, 3),
(160, 538, '2018-11-29 11:26:31', 17, 0, 3),
(161, 258, '2018-11-29 11:28:56', 17, 0, 3),
(162, 538, '2018-11-29 11:31:49', 17, 0, 3),
(163, 258, '2018-11-29 11:32:59', 17, 0, 3),
(164, 547, '2018-11-29 11:35:49', 17, 0, 3),
(165, 474, '2018-11-29 11:36:57', 17, 0, 3),
(166, 538, '2018-11-29 11:39:03', 17, 0, 3),
(167, 547, '2018-11-29 11:46:17', 17, 0, 3),
(168, 547, '2018-11-29 11:48:58', 17, 0, 3),
(169, 538, '2018-11-29 11:49:59', 17, 0, 3),
(170, 489, '2018-11-29 11:50:53', 17, 0, 3),
(171, 258, '2018-11-29 11:52:28', 17, 0, 3),
(172, 547, '2018-11-29 12:02:28', 17, 0, 3),
(173, 272, '2018-11-29 12:04:08', 17, 0, 3),
(174, 341, '2018-11-29 15:38:53', 11, 0, 3),
(175, 258, '2018-12-03 09:20:56', 17, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_pedido`
--

CREATE TABLE `presupuesto_pedido` (
  `id_presupuesto_pedido` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `id_prioridad` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(224) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`id_prioridad`, `nombre`, `descripcion`) VALUES
(1, 'normal', 'sera normal dicha actividad '),
(2, 'media', 'tendra una prioridad mucho mayor a la normal'),
(5, 'urgente', 'tendra la maxima prioridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `id_cordinador` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(124) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_api` int(11) NOT NULL,
  `id_api_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `id_cordinador`, `nombre`, `descripcion`, `id_api`, `id_api_region`) VALUES
(1, 1, 'REGION EFREN OSORIO', NULL, 265795, 2346896),
(2, 2, 'REGION RODRIGO HERNANDEZ', NULL, 835274, 2346939),
(3, 3, 'REGION ALESSANDRO MONTERO', NULL, 851441, 2346943),
(4, 5, 'REGION CAPITAL', NULL, 11790034, 2346944),
(5, 4, 'REGION MEDELLIN', NULL, 11788526, 2346945);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relevancia`
--

CREATE TABLE `relevancia` (
  `id_relevancia` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `id_frecuencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remisiones`
--

CREATE TABLE `remisiones` (
  `id_remision` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision_completa_inventarios`
--

CREATE TABLE `revision_completa_inventarios` (
  `id_revision` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nombre_rol` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre_rol`, `descripcion`) VALUES
(1, 'Supervisor', 'ROL DE SUPERVISION DE PUNTOS DE VENTA'),
(2, 'Administrador', 'Administrador total del sistema'),
(3, 'Gerencia', 'Acceso limitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_opciones`
--

CREATE TABLE `seguimiento_opciones` (
  `id_seguimiento` int(11) NOT NULL,
  `nombre_opcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_vendedores`
--

CREATE TABLE `seguimiento_vendedores` (
  `id_seguimiento` int(11) NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL,
  `id_prioridad` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calificacion_pv` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_suscursal` int(11) NOT NULL,
  `cod_sucursal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitud` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departamento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_zona` int(11) NOT NULL,
  `id_api_zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_suscursal`, `cod_sucursal`, `nombre`, `direccion`, `longitud`, `latitud`, `departamento`, `id_zona`, `id_api_zona`) VALUES
(1, 'SUCALE0001', 'ALEMANA 01', 'CARRERA 33 NO. 45-68 SAN PIO   ', '0', '7.118401769099574', '2807', 1, 265458),
(2, 'SUCALE0002', 'ALEMANA 02', 'CARRERA 4  N. 11-36 LOCAL 3', '0', '7.125343', '2787', 3, 115385),
(3, 'SUCALE0003', 'ALEMANA 03', 'CALLE 9 NO. 6-96 ESQUINA', '0', '7.125343', '2807', 14, 265454),
(4, 'SUCALE0004', 'ALEMANA 04', 'CARRERA 13 NO. 9-81', '0', '7.125343', '2803', 21, 4550130),
(5, 'SUCALE0005', 'ALEMANA 05', 'CARRERA 6 CALLE 10-99', '0', '7.125343', '2807', 14, 265454),
(6, 'SUCALE0006', 'ALEMANA 06', 'CALLE 48 NO. 22-01', '0', '7.125343', '2807', 3, 115385),
(7, 'SUCALE0010', 'ALEMANA 10', 'CALLE 49 NO. 16-55 PARQUE INFANTIL', '0', '7.125343', '2807', 3, 115385),
(8, 'SUCALE0014', 'ALEMANA 14', 'CARRERA 33 NO. 52-65', '0', '7.125343', '2807', 1, 265458),
(9, 'SUCALE0015', 'ALEMANA 15', 'CARRERA 9 NO. 12-06', '0', '6.466878266836262', '2807', 5, 318944),
(10, 'SUCALE0016', 'ALEMANA 16', 'CALLE 13 NO. 15-59', '0', '6.469511420736335', '2807', 5, 318944),
(11, 'SUCALE0017', 'ALEMANA 17', 'CALLE 52 NO. 27 - 02', '0', '7.125343', '2807', 3, 115385),
(12, 'SUCALE0020', 'ALEMANA 20', 'CALLE 56 NO. 17C-09 LA ISLA', '0', '7.125343', '2807', 1, 265458),
(13, 'SUCALE0021', 'ALEMANA 21', 'CALLE 52A NO. 36D-17', '0', '7.125343', '2807', 3, 115385),
(14, 'SUCALE0022', 'ALEMANA 22', 'CARRERA 10 NO. 10-84', '0', '6.553615848032777', '2807', 5, 318944),
(15, 'SUCALE0023', 'ALEMANA 23', 'CALLE 5 NO. 8-05', '0', '7.125343', '2792', 21, 4550130),
(16, 'SUCALE0024', 'ALEMANA 24', 'CARRERA 16 NO. 11-19', '0', '6.468413386567391', '2807', 5, 318944),
(17, 'SUCALE0025', 'ALEMANA 25', 'CALLE 49 NO. 28-29', '0', '7.125343', '2807', 1, 265458),
(18, 'SUCALE0026', 'ALEMANA 26 LA FOSCAL', 'TRANSVERSAL 154 NO. 150-207 LC-E1 FOSCAL', '0', '7.125343', '2807', 14, 265454),
(19, 'SUCALE0027', 'ALEMANA 27', 'CARRERA 11 NO. 12-36', '0', '6.554521839120526', '2807', 5, 318944),
(20, 'SUCALE0028', 'ALEMANA 28', 'CALLE 50 NO. 13-02', '0', '7.125343', '2807', 3, 115385),
(21, 'SUCALE0029', 'ALEMANA 29', 'CALLE 13 N. 3-12 ', '0', '7.125343', '2787', 3, 115385),
(22, 'SUCALE0031', 'ALEMANA 31', 'CARRERA 2 NO. 3-49', '0', '7.125343', '2792', 21, 4550130),
(23, 'SUCALE0032', 'ALEMANA 32', 'TRANSVERSAL ORIENTAL NO. 35-254 MIR. DEL CACIQUE', '0', '7.125343', '2807', 14, 265454),
(24, 'SUCALE0034', 'ALEMANA 34', 'CARRERA 8 NO. 7-112', '0', '7.125343', '2807', 5, 318944),
(25, 'SUCALE0037', 'ALEMANA 37', 'CARRERA 8 NO. 5-22', '0', '7.125343', '2807', 14, 265454),
(26, 'SUCALE0039', 'ALEMANA 39', 'CALLE 10 NO. 16 - 40', '0', '7.125343', '2807', 5, 318944),
(27, 'SUCALE0040', 'ALEMANA 40', 'CARRERA 10 NO. 16-28', '0', '7.125343', '2787', 5, 318944),
(28, 'SUCALE0041', 'ALEMANA 41', 'CALLE 63 NO. 30-21 CONUCOS', '0', '7.125343', '2807', 1, 265458),
(29, 'SUCALE0042', 'ALEMANA 42', 'CARRERA 33 A  NO. 14-02 B. LOS PINOS  ', '0', '7.134125848556025', '2807', 1, 265458),
(30, 'SUCALE0045', 'ALEMANA 45', 'CARRERA 10 NO. 14-98', '0', '7.125343', '2787', 5, 318944),
(31, 'SUCALE0047', 'ALEMANA 47', 'CARRERA 20 NO. 09 - 102 ESQUINA', '0', '7.125343', '2790', 2, 318947),
(32, 'SUCALE0049', 'ALEMANA 49', 'CARRERA 29 NO. 14-06', '0', '7.125343', '2790', 2, 318947),
(33, 'SUCALE0050', 'ALEMANA 50', 'CARRERA 80 NO. 48-23', '0', '7.125343', '2781', 34, 318972),
(34, 'SUCALE0052', 'ALEMANA 52', 'CARRERA 14 N 7 - 14', '0', '7.125343', '2803', 21, 4550130),
(35, 'SUCALE0053', 'ALEMANA 53', 'CALLE 9 NO. 18 - 27', '0', '7.125343', '2790', 2, 318947),
(36, 'SUCALE0055', 'ALEMANA 55 PLUS', 'CALLE 42 NO. 37 - 06', '0', '7.125343', '2807', 1, 265458),
(37, 'SUCALE0057', 'ALEMANA 57', 'MANZANA C CASA 3 LOCAL 1 SAN TELMO 2', '0', '7.125343', '2807', 14, 265454),
(38, 'SUCALE0059', 'ALEMANA 59', 'CALLE 49 N. 5-24 ', '0', '7.125343', '2807', 3, 115385),
(39, 'SUCALE0060', 'ALEMANA 60', 'CARRERA 26 NO 30-28 CANAVERAL', '0', '7.125343', '2807', 14, 265454),
(40, 'SUCALE0061', 'ALEMANA 61', 'AV. GONZALEZ VALENCIA NO. 55 - 70', '0', '7.125343', '2807', 1, 265458),
(41, 'SUCALE0062', 'ALEMANA 62', 'CALLE 49 NO 16 - 17', '0', '7.125343', '2807', 3, 115385),
(42, 'SUCALE0064', 'ALEMANA 64 CMARKET', 'CARRERA 13 N 55 - 06 CHAPINERO', '0', '7.125343', '2785', 16, 4550114),
(43, 'SUCALE0066', 'ALEMANA 66 CMARKET', 'CARRERA 33 NO 30 A-17 FTE HOSPITAL UNIVERSITARIO', '0', '7.125343', '2807', 1, 265458),
(44, 'SUCALE0067', 'ALEMANA 67 CMARKET', 'CALLE 63 NO. 11-41 PARQUE LOURDES', '0', '7.125343', '2785', 16, 4550114),
(45, 'SUCALE0068', 'ALEMANA 68 CMARKET', 'CARRERA 75 NO. 24 - 20', '0', '7.125343', '2785', 7, 4550131),
(46, 'SUCALE0071', 'ALEMANA 71', 'CALLE 4  NO. 3 - 153 CORREGIMIENTO LA LOMA', '0', '7.125343', '2792', 20, 4550103),
(47, 'SUCALE0076', 'ALEMANA 76', 'CLLE 140  7 C BIS NO 81 LOCAL 2 BARRIO CEDRITOS', '0', '7.125343', '2785', 16, 4550114),
(48, 'SUCALE0078', 'ALEMANA 78', 'CALLE 140 N.12B-28 LOCAL 1-26 DEL CENTRO COMERCIAL PASEO 140', '0', '7.125343', '2785', 16, 4550114),
(49, 'SUCALE0079', 'ALEMANA 79', 'CALLE 10 NO. 6 -19 LOCAL 5', '0', '7.125343', '2798', 6, 4550122),
(50, 'SUCALE0080', 'ALEMANA 80', 'CALLE MOSQUERA NO. 11 - 49 BARRIO CENTRO', '0', '7.125343', '2802', 30, 4550125),
(51, 'SUCALE0081', 'ALEMANA 81', 'CALLE 125 N 19-66 BARRIO SANTA BARBARA', '0', '7.125343', '2785', 16, 4550114),
(52, 'SUCALE0084', 'ALEMANA 84', 'CARRERA 12 NO. 11 - 43', '0', '', '2803', 21, 4550130),
(53, 'SUCALE0085', 'ALEMANA 85', 'CALLE 5 NO. 12-03', '0', '7.125343', '2792', 21, 4550130),
(54, 'SUCALE0086', 'ALEMANA 86', 'CR 19 15N LOCAL 7 PLAZA NORTE ', '0', '7.125343', '2805', 28, 4550121),
(55, 'SUCALE0087', 'ALEMANA 87', 'CARRERA 5 NO. 37-BIS 03 EDIFICIO FONTAINEBLEAU LOCAL 109', '0', '7.125343', '2809', 6, 4550122),
(56, 'SUCALE0088', 'ALEMANA 88', 'CALLE 156 NO. 8 - 17', '0', '7.125343', '2785', 16, 4550114),
(57, 'SUCALE0089', 'ALEMANA 89', 'CALLE 16 NO. 24-76', '0', '7.125343', '2802', 30, 4550125),
(58, 'SUCALE0090', 'ALEMANA 90', 'CARRERA 15 NO. 122-09 SANTA BARBARA', '0', '7.125343', '2785', 16, 4550114),
(59, 'SUCALE0091', 'ALEMANA 91', 'CALLE 18 NO. 14 - 30 BARRIO FATIMA', '0', '7.125343', '2802', 30, 4550125),
(60, 'SUCALE0092', 'ALEMANA 92', 'CARRERA 45 NO.104-A 73 AUTOPISTA NORTE  ', '0', '7.125343', '2785', 16, 4550114),
(61, 'SUCALE0093', 'ALEMANA 93', 'CARRERA 23 NO. 60-98 PLAZA SANTO DOMINGO', '0', '7.125343', '2788', 28, 4550121),
(62, 'SUCALE0094', 'ALEMANA 94 ', 'CARRERA 9 NO. 18B - 35', '0', '2.591888984149953', '2806', 8, 4550123),
(63, 'SUCALE0095', 'ALEMANA 95', 'CALLE 30 NO 28-64 LOCAL 1 ', '0', '7.125343', '2790', 2, 318947),
(64, 'SUCALE0096', 'ALEMANA 96', 'CALLE 16 NO 16-04 PARQUE EL RESURGIMIENTO', '0', '7.125343', '2790', 2, 318947),
(65, 'SUCALE0097', 'ALEMANA 97', 'CALLE 24 NO 20-03 BARRIO PROVIVIENDA', '0', '7.125343', '2790', 2, 318947),
(66, 'SUCALE0098', 'ALEMANA 98', 'CALLE 30 NO 14-03 BARRIO VILLA ROCIO', '0', '7.125343', '2790', 2, 318947),
(67, 'SUCALE0101', 'ALEMANA 101', 'AVENIDA 15 NO. 109 - 18 LOCAL 102', '0', '7.125343', '2785', 16, 4550114),
(68, 'SUCALE0102', 'ALEMANA 102', 'CALLE 35 NO. 36-25', '0', '7.125343', '2801', 2, 318947),
(69, 'SUCALE0103', 'ALEMANA 103 CERRADA', 'CALLE 14 NO. 16-31', '0', '7.125343', '2801', 2, 318947),
(70, 'SUCALE0104', 'ALEMANA 104', 'CARRERA 11 NO. 64 - 18', '0', '7.125343', '2785', 16, 4550114),
(71, 'SUCALE0105', 'ALEMANA 105', 'CRA 29 N 20-76 EN EL BARRIO VILLAMARIA ', '0', '7.125343', '2790', 2, 318947),
(72, 'SUCALE0106', 'ALEMANA 106', 'CALLE 97 N . 20 SUR- 134  MANZANA G URBANIZACION BERLIN  LOCAL N 23 .INTERIOR', '0', '7.125343', '2809', 6, 4550122),
(73, 'SUCALE0107', 'ALEMANA 107', 'DIAGONAL 13 NO. 3E-53 LOCAL 8 CONJUNTO COMERCIAL Y RESIDENCIAL AV. PRADILLA', '0', '7.125343', '2795', 16, 4550114),
(74, 'SUCALE0108', 'ALEMANA 108', 'CRA. 8 N. 48-145 LOCAL 1-25.', '0', '7.125343', '2798', 6, 4550122),
(75, 'SUCALE0109', 'ALEMANA 109', 'KR 6A N. 60-11 LOCAL 106 EDIFICIO SURGIMEDICA', '0', '7.125343', '2809', 6, 4550122),
(76, 'SUCALE0110', 'ALEMANA 110', 'DIAGONAL 48 NO. 27-121', '0', '7.125343', '2807', 3, 115385),
(77, 'SUCALE0111', 'ALEMANA 111', 'CALLE 50 N. 25-35-37-39 PARQUE LA VIDA', '0', '7.125343', '2807', 3, 115385),
(78, 'SUCALE0112', 'ALEMANA 112', 'CALLE 29 NO 31-12 CAAVERAL ORIENTAL ', '0', '7.125343', '2807', 14, 265454),
(79, 'SUCALE0115', 'ALEMANA 115', 'CRA  5 N. 12-05 ESQUINA', '0', '7.125343', '2788', 3, 115385),
(80, 'SUCALE0116', 'ALEMANA 116', 'CARRERA 15 NO. 3AN - 10 LOCAL 219 CC PIE DE CUESTA', '0', '', '2807', 14, 265454),
(81, 'SUCALE0117', 'ALEMANA 117', 'CALLE 52A NO. 36F - 160 PROVIVIENDA', '0', '', '2807', 3, 115385),
(82, 'SUCALE0118', 'ALEMANA 118', 'DIAGONAL 56 N. 18A-88 LOCAL 118 CC SAN SILVESTRE', '0', '', '2807', 3, 115385),
(83, 'SUCALE0121', 'ALEMANA 121', 'CARRERA 10 NO. 9-01 9-05', '0', '', '2810', 28, 4550121),
(84, 'SUCALE0122', 'ALEMANA 122', 'CALLE 35  36 - 55 ', '0', '', '2801', 2, 318947),
(85, 'SUCALE0123', 'ALEMANA 123', 'CARRERA 5 N. 96 - 256 BARRIO EL JARDIN', '0', '', '2809', 6, 4550122),
(86, 'SUCALE0124', 'ALEMANA 124', 'LOCAL 1005 C.C. UNICENTRO', '0', '', '2806', 28, 4550121),
(87, 'SUCALE0125', 'ALEMANA 125', 'CRA 38 NO. 33B - 49 BARRIO EL BARZAL', '0', '', '2801', 2, 318947),
(88, 'SUCALE0126', 'ALEMANA 126', 'CALLE 15 NO 40A - 26 LOCAL 1 BARRIO VILLA MARA', '0', '', '2801', 2, 318947),
(89, 'SUCALE0127', 'ALEMANA 127', 'CARRERA 23 NO. 53A - 04 Y 14', '0', '', '2788', 28, 4550121),
(90, 'SUCALE0128', 'ALEMANA 128', 'CALLE 11 NO. 3 - 73', '0', '', '2810', 28, 4550121),
(91, 'SUCALE0130', 'ALEMANA 130', 'CL 44  80-61 LA AMERICA', '0', '', '2781', 34, 318972),
(92, 'SUCALE0131', 'ALEMANA 131', 'CL 9 SUR  29 D 76 POBLADO', '0', '', '2781', 33, 4550126),
(93, 'SUCALE0132', 'ALEMANA 132', 'CR 43  32 A SUR 27', '0', '', '2781', 33, 4550126),
(94, 'SUCALE0133', 'ALEMANA 133', 'CR 27  35 SUR 180 ', '0', '', '2781', 33, 4550126),
(95, 'SUCALE0134', 'ALEMANA 134', 'CR 81  25-35 BELEN LA PALMA', '0', '', '2781', 34, 318972),
(96, 'SUCALE0135', 'ALEMANA 135', 'CR 74  52-105 LOS COLORES', '0', '', '2781', 34, 318972),
(97, 'SUCALE0136', 'ALEMANA 136', 'CL 33 A  72-107 LAURELES', '0', '', '2781', 34, 318972),
(98, 'SUCALE0137', 'ALEMANA 137', 'VEREDA EL BARRO LOTE 3 PARAJE LLANO GRANDE', '0', '', '2781', 34, 318972),
(99, 'SUCALE0138', 'ALEMANA 138', 'CARRERA 69  42 - 49', '0', '', '2781', 34, 318972),
(100, 'SUCALE0139', 'ALEMANA 139', 'CARRERA 74 NO. 104 - 4 PEDREGAL', '0', '', '2781', 34, 318972),
(101, 'SUCALE0140', 'ALEMANA 140', 'CARRERA 84 NO. 45F - 12', '0', '', '2781', 34, 318972),
(102, 'SUCALE0142', 'ALEMANA 142', 'CARRERA 81 NO. 32 - 13', '0', '', '2781', 34, 318972),
(103, 'SUCALE0146', 'ALEMANA 146', 'CALLE 77 SUR NO. 5A - 195 LC 134', '0', '', '2781', 33, 4550126),
(104, 'SUCALE0147', 'ALEMANA 147', 'CALLE 33 NO. 64 - 174', '0', '', '2781', 34, 318972),
(105, 'SUCALE0149', 'ALEMANA 149', 'CARRERA 32 NO. 1 - 24 LOCAL 111 MALL PLAZA', '0', '', '2781', 33, 4550126),
(106, 'SUCALE0150', 'ALEMANA 150', 'CALLE 14 NO. 13 - 73', '0', '', '2806', 8, 4550123),
(107, 'SUCALE0151', 'ALEMANA 151', 'CALLE 16 N. 5-03', '0', '', '2788', 3, 115385),
(108, 'SUCALE0154', 'ALEMANA 154', 'CALLE 49 N 8-07 LC 142-143', '0', '', '2807', 3, 115385),
(109, 'SUCALE0155', 'ALEMANA 155', 'CARRERA 39 NO. 48 - 62', '0', '', '2807', 1, 265458),
(110, 'SUCALE0156', 'ALEMANA 156', 'CARRERA 40 NO. 33 - 05', '0', '', '2801', 2, 318947),
(111, 'SUCALE0160', 'ALEMANA 160', 'CALLE 200 NO. 13 - 08 LOCAL 3 CONJUNTO RESIDENCIAL MONTESOL', '0', '', '2807', 14, 265454),
(112, 'SUCALE0161', 'ALEMANA 161', 'CARRERA 18 NO. 12 - 59 LOCAL 111 PLATAFORMA 1', '0', '', '2806', 8, 4550123),
(113, 'SUCALE0162', 'ALEMANA 162', 'CARRERA 8 NO. 8 - 30', '0', '', '2795', 37, 4550120),
(114, 'SUCALE0163', 'ALEMANA 163', 'CR 50 49 53 LC CCIAL 104 EDF DAVIVIENDA', '0', '', '2810', 28, 4550121),
(115, 'SUCALE0164', 'ALEMANA 164', 'CALLE 17 NO. 6 - 25', '0', '', '2802', 30, 4550125),
(116, 'SUCALE0165', 'ALEMANA 165', 'CALLE 16 NO. 100 - 138', '0', '', '2810', 31, 4550124),
(117, 'SUCALE0168', 'ALEMANA 168', 'CALLE 13 NO. 43 - 80', '0', '', '2810', 31, 4550124),
(118, 'SUCALE0169', 'ALEMANA 169', 'CARRERA 30 NO. 19 - 63 SAN ALONSO', '0', '', '2807', 1, 265458),
(119, 'SUCALE0170', 'ALEMANA 170', 'CARRERA 9 NO. 6 - 15', '0', '', '2795', 5, 318944),
(120, 'SUCALE0171', 'ALEMANA 171', 'CARRERA 10 NO. 13 - 57', '0', '', '2795', 5, 318944),
(121, 'SUCALE0172', 'ALEMANA 172 CMARKET', 'AVENIDA CALLE 100 NO. 14 - 63 LOCAL 108', '0', '', '2785', 16, 4550114),
(122, 'SUCALE0173', 'ALEMANA 173', 'CALLE 71 NO. 18 - 101 LA LIBERTAD', '0', '', '2807', 3, 115385),
(123, 'SUCALE0174', 'ALEMANA 174', 'CALLE 71 NO. 32 - 03 LA FLORESTA', '0', '', '2807', 3, 115385),
(124, 'SUCALE0176', 'ALEMANA 176', 'AVENIDA PRADILLA 900 ESTE LC 153 CC CENTRO CHIA', '0', '', '2795', 16, 4550114),
(125, 'SUCALE0177', 'ALEMANA 177', 'CARRERA 10 NO. 17 - 27 CENTRO', '0', '', '2795', 37, 4550120),
(126, 'SUCALE0180', 'ALEMANA 180', 'CALLE 24A NO. 68C - 94 LC 1 P 1', '0', '', '2785', 7, 4550131),
(127, 'SUCALE0181', 'ALEMANA 181', 'CARRERA 40 NO. 9A - 28', '0', '', '2781', 33, 4550126),
(128, 'SUCALE0182', 'ALEMANA 182', 'CALLE 16A SUR NO. 32B - 38 LOCAL 104', '0', '', '2781', 33, 4550126),
(129, 'SUCALE0183', 'ALEMANA 183', 'DIAGONAL 75B NO. 2A - 105 LOCAL 1', '0', '', '2781', 33, 4550126),
(130, 'SUCALE0184', 'ALEMANA 184', 'CALLE 51 NO. 51 - 11', '0', '', '2781', 33, 4550126),
(131, 'SUCALE0185', 'ALEMANA 185', 'CALLE 16 SUR NO. 22 - 58', '0', '', '2785', 7, 4550131),
(132, 'SUCALE0186', 'ALEMANA 186', 'CARRERA 14 NO. 8A - 06 LOCAL 1A', '0', '', '2803', 21, 4550130),
(133, 'SUCALE0187', 'ALEMANA 187', 'CALLE 3 NO. 3 - 80 ', '0', '', '2792', 21, 4550130),
(134, 'SUCALE0188', 'ALEMANA 188', 'CALLE 4 NO. 7 - 68', '0', '', '2807', 14, 265454),
(135, 'SUCALE0191', 'ALEMANA 191', 'CARRERA 30 NO. 39 - 41 CENTRO', '0', '', '2801', 2, 318947),
(136, 'SUCALE0201', 'ALEMANA 201', 'CARRERA 9 NO 12 - 03', '0', '7.125343', '2795', 37, 4550120),
(137, 'SUCALE0204', 'ALEMANA 204', 'TRANSVERSAL 12 NO. 16A - 89', '0', '7.125343', '2795', 37, 4550120),
(138, 'SUCALE0205', 'ALEMANA 205', 'CARRERA  6 NO 7 - 03', '0', '7.125343', '2795', 37, 4550120),
(139, 'SUCALE0206', 'ALEMANA 206', 'CARRERA 11 NO 8 - 05', '0', '7.125343', '2795', 37, 4550120),
(140, 'SUCALE0207', 'ALEMANA 207', 'CARRERA 10 NO.12-67 CENTRO', '0', '7.125343', '2795', 37, 4550120),
(141, 'SUCALE0208', 'ALEMANA 208', 'CALLE 20C NO. 5-04 PORVENIR', '0', '7.125343', '2795', 37, 4550120),
(142, 'SUCALE0209', 'ALEMANA 209', 'CALLE 7 NO 26 - 13 CENTRO ', '0', '7.125343', '2809', 37, 4550120),
(143, 'SUCALE0210', 'ALEMANA 210', 'CARRERA 26 NO 5 - 82 ESQUINA', '0', '7.125343', '2809', 37, 4550120),
(144, 'SUCALE0211', 'ALEMANA 211', 'CALLE 7 NO 22-54  LOCAL 6', '0', '7.125343', '2809', 37, 4550120),
(145, 'SUCALE0213', 'ALEMANA 213', ' CARRERA 5 NO 67 A 67', '0', '7.125343', '2809', 6, 4550122),
(146, 'SUCALE0214', 'ALEMANA 214', ' CARRERA 5 NO 62- 90', '0', '7.125343', '2809', 6, 4550122),
(147, 'SUCALE0215', 'ALEMANA 215', 'CARRERA 5A NO 35-26', '0', '7.125343', '2809', 6, 4550122),
(148, 'SUCALE0216', 'ALEMANA 216', 'AVENIDA AMBALA NO 65-02', '0', '7.125343', '2809', 6, 4550122),
(149, 'SUCALE0217', 'ALEMANA 217', ' CARRERA 5 NO 37- 42', '0', '7.125343', '2809', 6, 4550122),
(150, 'SUCALE0218', 'ALEMANA 218', 'AV GUABINAL NO 51-53 HIPERMERCADO MERCACENTRO', '0', '7.125343', '2809', 6, 4550122),
(151, 'SUCALE0219', 'ALEMANA 219', 'CALLE 17 NO. 17-34', '0', '7.125343', '2809', 6, 4550122),
(152, 'SUCALE0220', 'ALEMANA 220', 'CARRERA 5 NO. 21 - 02', '0', '7.125343', '2809', 6, 4550122),
(153, 'SUCALE0221', 'ALEMANA 221 CERRADA', 'CARRERA 5 NO. 17 -04', '0', '7.125343', '2798', 6, 4550122),
(154, 'SUCALE0222', 'ALEMANA 222', 'CARRERA 5 NO.37 B-03  LOCAL 102 SANTA TERESA', '0', '7.125343', '2809', 6, 4550122),
(155, 'SUCALE0223', 'ALEMANA 223 CMARKET', 'CALLE 100 NO.19 A 92', '0', '7.125343', '2785', 16, 4550114),
(156, 'SUCALE0224', 'ALEMANA 224', 'TRANSVERSAL 73D NO. 39A - 59 SUR', '0', '7.125343', '2785', 7, 4550131),
(157, 'SUCALE0225', 'ALEMANA 225', 'AV 15 NO. 116 39 LC 03', '0', '7.125343', '2785', 16, 4550114),
(158, 'SUCALE0226', 'ALEMANA 226', 'CARRERA 16 NO 82- 50', '0', '7.125343', '2785', 16, 4550114),
(159, 'SUCALE0227', 'ALEMANA 227', 'CALLE 19 NO.7-54 LOCAL 3', '0', '7.125343', '2785', 7, 4550131),
(160, 'SUCALE0228', 'ALEMANA 228', 'CALLE 18A NO. 68D - 61', '0', '7.125343', '2785', 7, 4550131),
(161, 'SUCALE0229', 'ALEMANA 229', 'CRA 45 N. 24B-27 EMABAJADA', '0', '7.125343', '2785', 7, 4550131),
(162, 'SUCALE0230', 'ALEMANA 230', 'CARRERA 15  92-38', '0', '7.125343', '2785', 16, 4550114),
(163, 'SUCALE0231', 'ALEMANA 231', 'CARRERA 7 NO. 22-05 LOCAL 101', '0', '7.125343', '2785', 7, 4550131),
(164, 'SUCALE0232', 'ALEMANA 232 CMARKET', 'TRANSVERSAL 94 NO.  80 C -05', '0', '7.125343', '2785', 7, 4550131),
(165, 'SUCALE0233', 'ALEMANA 233', 'CALLE 59 NO. 10-39', '0', '7.125343', '2785', 16, 4550114),
(166, 'SUCALE0234', 'ALEMANA 234', 'CARRERA 12 NO. 6-04', '0', '7.125343', '2795', 5, 318944),
(167, 'SUCALE0235', 'ALEMANA 235', 'CARRERA 10 NO. 5-54', '0', '7.125343', '2795', 5, 318944),
(168, 'SUCALE0236', 'ALEMANA 236', 'CARRERA 16 NO. 4 - 13 LOCAL 102', '0', '7.125343', '2795', 5, 318944),
(169, 'SUCALE0237', 'ALEMANA 237', 'AV. PRADILLA N. 2 ESTE A  71 JUMBO CC SABANA NORTE', '0', '7.125343', '2795', 16, 4550114),
(170, 'SUCALE0242', 'ALEMANA 242', 'CALLE 22 NO 4-78', '0', '7.125343', '2806', 8, 4550123),
(171, 'SUCALE0243', 'ALEMANA 243', 'CRA. 8 NO 7-70', '0', '7.125343', '2810', 28, 4550121),
(172, 'SUCALE0244', 'ALEMANA 244', 'CARRERA 10 NO 18-05', '0', '7.125343', '2806', 8, 4550123),
(173, 'SUCALE0245', 'ALEMANA 245', 'CRA. 9 NO 17-27', '0', '7.125343', '2806', 8, 4550123),
(174, 'SUCALE0246', 'ALEMANA 246', 'CALLE 20 NO 3 C N 03', '0', '7.125343', '2810', 28, 4550121),
(175, 'SUCALE0248', 'ALEMANA 248', 'CARRERA 11 NO. 8-83', '0', '7.125343', '2810', 28, 4550121),
(176, 'SUCALE0250', 'ALEMANA 250', 'CC CIUDAD  VICTORIA  L -217-218', '0', '7.125343', '2806', 8, 4550123),
(177, 'SUCALE0251', 'ALEMANA 251', 'CARRERA 13 NO. 4-11 AVENIDA CIRCUNVALAR', '0', '7.125343', '2806', 8, 4550123),
(178, 'SUCALE0252', 'ALEMANA 252', 'CARRERA 5 CON CALLE 19 ESQUINA', '0', '7.125343', '2806', 8, 4550123),
(179, 'SUCALE0253', 'ALEMANA 253', 'CARRERA. 8 NO 12-79', '0', '7.125343', '2806', 8, 4550123),
(180, 'SUCALE0254', 'ALEMANA 254', 'CARRERA. 7 NO 12-82', '0', '7.125343', '2806', 8, 4550123),
(181, 'SUCALE0255', 'ALEMANA 255', 'CARRERA 8 NO 29-02 CENTRO', '0', '7.125343', '2806', 8, 4550123),
(182, 'SUCALE0256', 'ALEMANA 256', 'CALLE 70 NO 25-63', '0', '7.125343', '2806', 28, 4550121),
(183, 'SUCALE0258', 'ALEMANA 258', 'CALLE 11 NO 8-20', '0', '7.125343', '2788', 28, 4550121),
(184, 'SUCALE0259', 'ALEMANA 259', 'AVDA BOLIVAR CRA 14 NO.13 NORTE 58', '0', '7.125343', '2805', 28, 4550121),
(185, 'SUCALE0260', 'ALEMANA 260', 'CALLE 21 NO. 16B-61 LOC 3 LA  LORENA 3', '0', '7.125343', '2806', 8, 4550123),
(186, 'SUCALE0261', 'ALEMANA 261', 'MANZANA 44 CASA 17 CORALES', '0', '7.125343', '2806', 28, 4550121),
(187, 'SUCALE0262', 'ALEMANA 262', 'CRA. 17 NO 21 - 05', '0', '7.125343', '2806', 8, 4550123),
(188, 'SUCALE0263', 'ALEMANA 263', 'CALLE 24 NO 7-69 EDIF. LA CONCORDIA', '0', '7.125343', '2806', 8, 4550123),
(189, 'SUCALE0264', 'ALEMANA 264', 'C.C. UNICENTRO LOCAL A - 05', '0', '7.125343', '2806', 28, 4550121),
(190, 'SUCALE0265', 'ALEMANA 265', 'CARRERA. 23 NO 20-50', '0', '7.125343', '2788', 28, 4550121),
(191, 'SUCALE0266', 'ALEMANA 266', 'CARRERA 16 NO 36 -98  C. CIAL PROGRESO LOCAL 88', '0', '7.125343', '2806', 8, 4550123),
(192, 'SUCALE0267', 'ALEMANA 267', 'CRA 9 NO 24-78', '0', '7.125343', '2806', 8, 4550123),
(193, 'SUCALE0269', 'ALEMANA 269', 'CALLE 18 NO 127 - 36 LOCAL 10', '0', '7.125343', '2810', 31, 4550124),
(194, 'SUCALE0270', 'ALEMANA 270', 'CALLE 13 NO 31 -45 LOCAL 8 Y 9', '0', '7.125343', '2810', 31, 4550124),
(195, 'SUCALE0271', 'ALEMANA 271', 'CALLE 13 NO 31 -45 LOCAL 17', '0', '7.125343', '2810', 31, 4550124),
(196, 'SUCALE0272', 'ALEMANA 272', 'CALLE 10  38 - 02 SECTOR PARQUE LLERAS', '0', '7.125343', '2781', 33, 4550126),
(197, 'SUCALE0273', 'ALEMANA 273', 'CALLE 5  75 B 25 SECTOR MALL LA MOTA', '0', '7.125343', '2781', 33, 4550126),
(198, 'SUCALE0274', 'ALEMANA 274', 'CALLE 31  76 - 56 SECTOR BELN PARQUE', '0', '7.125343', '2781', 34, 318972),
(199, 'SUCALE0275', 'ALEMANA 275', 'CRA 43  33 - 57 LOCAL 118  PLAZUELA DE SAN DIEGO', '0', '7.125343', '2781', 33, 4550126),
(200, 'SUCALE0276', 'ALEMANA 276', 'CRA 43 A  7 SUR 170 LOCAL  9090 CENTRO CCIAL SANTA FE', '0', '7.125343', '2781', 33, 4550126),
(201, 'SUCALE0277', 'ALEMANA 277', 'CRA 80  50-87 SECTOR CALAZANS', '0', '7.125343', '2781', 34, 318972),
(202, 'SUCALE0279', 'ALEMANA 279', 'CALLE 44  66-50 SECTOR SAN JUAN', '0', '7.125343', '2781', 34, 318972),
(203, 'SUCALE0280', 'ALEMANA 280', 'CLLE 42  69 -115 SECTOR SAN JUANQUIN', '0', '7.125343', '2781', 34, 318972),
(204, 'SUCALE0281', 'ALEMANA 281', 'CALLE 51  46 - 92 SECTOR PRADO', '0', '7.125343', '2781', 34, 318972),
(205, 'SUCALE0285', 'ALEMANA 285', 'CALLE 55  46-33 NEUROLOGICO DE COLOMBIA', '0', '7.125343', '2781', 33, 4550126),
(206, 'SUCALE0287', 'ALEMANA 287', 'CARRERA 26 NO 16 -76 CENTRO', '0', '7.125343', '2802', 30, 4550125),
(207, 'SUCALE0288', 'ALEMANA 288', 'CARRERA 44 NO. 20-05 LOCAL 5 MORASURCO', '0', '7.125343', '2802', 30, 4550125),
(208, 'SUCALE0289', 'ALEMANA 289', 'CALLE 18 NO. 16- 02 SAN JUAN BOSCO', '0', '7.125343', '2802', 30, 4550125),
(209, 'SUCALE0290', 'ALEMANA 290', 'CALLE  18 NO 36  36 PALERMO', '0', '7.125343', '2802', 30, 4550125),
(210, 'SUCALE0291', 'ALEMANA 291', 'CALLE SUCRE FRENTE AL BANCO AGRARIO', '0', '7.125343', '2802', 30, 4550125),
(211, 'SUCALE0294', 'ALEMANA 294', 'CALLE 60 N 6- 15 BARRIO EL LIMONAR', '0', '7.125343', '2809', 6, 4550122),
(212, 'SUCALE0299', 'ALEMANA 299', 'CRA 10 N. 22-104 ', '0', '7.125343', '2787', 5, 318944),
(213, 'SUCALE0300', 'ALEMANA 300', 'CALLE 12  3 - 70 BARRIO CENTRO PLAZA DE CAYCEDO', '0', '7.125343', '2810', 31, 4550124),
(214, 'SUCALE0301', 'ALEMANA 301', 'CALLE 8 N   3 N - 60 BARRIO CENTENARIO', '0', '7.125343', '2810', 31, 4550124),
(215, 'SUCALN0048', 'ALEMANA 48', 'CARRERA 20 NO 8-75 BARRIO CENTRO', '0', '7.125343', '2790', 2, 318947),
(216, 'SUCAND0001', 'DROGUERIA ANDINA', 'CARRERA 10 NO. 17-02    CALLE   REAL CHQUINQUIRA ', '0', '7.125343', '2787', 5, 318944),
(217, 'SUCAND0010', 'ANDINA 10', 'CALLE 6 NO.9-05   LOCAL NO.2', '0', '7.125343', '2800', 15, 319055),
(218, 'SUCANDI001', 'ANDINA 01', 'CARRERA 5  17-41 ESQUINA', '0', '7.125343', '2800', 18, 4549929),
(219, 'SUCANDI002', 'ANDINA 02', 'CARRERA 5  18-34  CENTRO ', '0', '7.125343', '2800', 18, 4549929),
(220, 'SUCANDI003', 'ANDINA 03', 'CALLE 11  8-129 ESQUINA MERCADO PUBLICO ', '0', '7.125343', '2800', 15, 319055),
(221, 'SUCANDI004', 'ANDINA 04', 'CALLE 23  14-17 ', '0', '7.125343', '2800', 18, 4549929),
(222, 'SUCANDI005', 'ANDINA 05', 'CALLE 22   5-79', '0', '7.125343', '2800', 18, 4549929),
(223, 'SUCANDI006', 'ANDINA 06', 'CALLE 24  A  15-07  ', '0', '7.125343', '2800', 18, 4549929),
(224, 'SUCANDI007', 'ANDINA 07', 'CARRERA 4  19 - 60 LOCAL 3 RODADERO', '0', '7.125343', '2800', 26, 4550112),
(225, 'SUCANDI008', 'ANDINA 08', 'CALLE 29B  30B-39 EL TREBOL', '0', '7.125343', '2800', 27, 4550111),
(226, 'SUCANDI009', 'ANDINA 09', 'MANZANA 44 CASA 22 URB EL PANDO LOCAL 1', '0', '7.125343', '2800', 27, 4550111),
(227, 'SUCANDI011', 'ANDINA 11', 'CALLE 30  72-38 LOCAL 2 BARRIO 11 DE NOVIEMBRE', '0', '7.125343', '2800', 15, 319055),
(228, 'SUCANDI012', 'ANDINA 12', 'CALLE 16  32A-115 URBANIZACION GALICIA ', '0', '7.125343', '2800', 15, 319055),
(229, 'SUCANDI014', 'ANDINA 14', 'CALLE 30  5-10 LOCAL 1 ESTACION DE SERVICIO  MANZANARES', '0', '7.125343', '2800', 27, 4550111),
(230, 'SUCANDI015', 'ANDINA 15', 'DIAGONAL 33  9-360 VILLA ELI', '0', '7.125343', '2800', 15, 319055),
(231, 'SUCANDI016', 'ANDINA 16', 'CALLE 29 K   18-03 MZ 69 CASA 14 B. CDELA 29 DE JULIO', '0', '7.125343', '2800', 27, 4550111),
(232, 'SUCANDI017', 'ANDINA 17', 'CARRERA 4  17-26 RODADERO', '0', '7.125343', '2800', 26, 4550112),
(233, 'SUCANDI018', 'ANDINA 18', 'CARRERA 12   6-03 GAIRA', '0', '7.125343', '2800', 26, 4550112),
(234, 'SUCANDI019', 'ANDINA 19', 'CALLE 7  15A-50 BARRIO  20 DE JULIO', '0', '7.125343', '2800', 15, 319055),
(235, 'SUCANDI020', 'ANDINA 20', 'CRA. 19A NO 28C - 128 LOCAL 101  ESQUINA BARRIO LOS NARANJOS ', '0', '7.125343', '2800', 18, 4549929),
(236, 'SUCANDI021', 'ANDINA 21', 'MZ M LOTE 14 CARRERA 24 NO. 43 - 42', '0', '7.125343', '2800', 27, 4550111),
(237, 'SUCANDI022', 'ANDINA 22', 'CARRERA 4TA  21D-31 BARRIO GAIRA ABAJO', '0', '7.125343', '2800', 26, 4550112),
(238, 'SUCANDI023', 'ANDINA 23', 'CARRERA 20 NO. 14 A  BIS  26 LOCAL 1 ', '0', '7.125343', '2799', 25, 4550113),
(239, 'SUCANDI024', 'ANDINA 24', 'CALLE 15 NO. 7 A  - 89 RIOHACHA- RIOHACHA', '0', '7.125343', '2799', 25, 4550113),
(240, 'SUCANDI025', 'ANDINA 25', 'TRANSVERSAL 9   29C-130 LOCAL 104 C.C. LAS PALMAS ', '0', '7.125343', '2800', 27, 4550111),
(241, 'SUCANDI026', 'ANDINA 26', 'CALLE 18 NO 14-84 AV AEROPUERTO- RIOHACHA', '0', '7.125343', '2799', 25, 4550113),
(242, 'SUCANDI027', 'ANDINA 27', 'CALLE 17 KRA 13-02 LAT II', '0', '7.125343', '2800', 26, 4550112),
(243, 'SUCANDI028', 'ANDINA 28', 'VA A CINAGA KILMETRO 14 CENTRO COMERCIAL ZAZUE LOCAL 113.', '0', '7.125343', '2800', 26, 4550112),
(244, 'SUCANDI029', 'ANDINA 29', 'CALLE 12 NO. 9 - 08 LOCAL 1', '0', '', '2800', 15, 319055),
(245, 'SUCANDI030', 'ANDINA 30', 'CARRERA 9 NO.3  03  BARRIO PAZ DEL RIO', '0', '', '2800', 15, 319055),
(246, 'SUCANDI031', 'ANDINA 31', 'CARRERA 22 CALLE 38 LOCAL 102', '0', '', '2800', 27, 4550111),
(247, 'SUCANDI032', 'ANDINA 32', 'CALLE 6 CARRERA 10 - 99 BRR PESCAITO', '0', '', '2800', 15, 319055),
(248, 'SUCANDI033', 'ANDINA 33', 'CASA 7 MZ 27 SECTOR PEPE GNECCO BRR  CIUDADELA', '0', '', '2800', 27, 4550111),
(249, 'SUCANDI034', 'ANDINA 34', 'CARRERA 4 NO. 114 - 303 LC 2', '0', '', '2800', 26, 4550112),
(250, 'SUCANDI035', 'ANDINA 35', 'CALLE 17 NO. 17 - 112', '0', '', '2800', 26, 4550112),
(251, 'SUCANDI036', 'ANDINA 36', 'CALLE 14 NO. 12B - 57', '0', '', '2799', 25, 4550113),
(252, 'SUCANDI037', 'ANDINA 37', 'CARRERA 21 NO. 22 - 04', '0', '', '2800', 18, 4549929),
(253, 'SUCANDI038', 'ANDINA 38', 'CARRERA 1C - 23 - 56 L2', '0', '', '2800', 18, 4549929),
(254, 'SUCANDI040', 'ANDINA 40', 'CALLE 30 NO. 24B - 55', '0', '', '2800', 15, 319055),
(255, 'SUCANDI041', 'ANDINA 41', 'CARRERA 35 NO. 9F - 6 BASTIDAS', '0', '', '2800', 15, 319055),
(256, 'SUCATE0001', 'ATENAS 1', 'MANZANA A LOTE 20 LOS CORALES', '0', '7.125343', '2786', 4, 319001),
(257, 'SUCBOT0001', 'BOTICA 01', 'CALLE 84 NO. 67-54 LOCAL 3 PARAISO', '0', '7.125343', '2784', 10, 318992),
(258, 'SUCBOT0002', 'BOTICA 02', 'CARRERA 38 NO. 71-68 LOCAL 1', '0', '7.125343', '2784', 17, 4549889),
(259, 'SUCBOT0003', 'BOTICA 03', 'CALLE 84 NO. 51B-34', '0', '7.125343', '2784', 19, 327780),
(260, 'SUCBOT0004', 'BOTICA 04', 'CALLE 72 NO. 52-79 LOCAL 6', '0', '7.125343', '2784', 10, 318992),
(261, 'SUCBOT0005', 'BOTICA 05', 'CARRERA 43 NO. 72-09 20 DE JULIO', '0', '7.125343', '2784', 17, 4549889),
(262, 'SUCBOT0006', 'BOTICA 06', 'CARRERA 38 NO. 100-09 ESQUINA COLINA CAMPESTRE  LOCAL 1', '0', '7.125343', '2784', 17, 4549889),
(263, 'SUCBOT0007', 'BOTICA 07', 'CARRERA 74 NO  88 05  VILLA CAROLINA ', '0', '7.125343', '2784', 10, 318992),
(264, 'SUCBOT0008', 'BOTICA 08', 'CALLE 84 NO. 43B-26 LOCAL 1', '0', '7.125343', '2784', 19, 327780),
(265, 'SUCBOT0009', 'BOTICA 09', 'CALLE 93 NO. 45B-53', '0', '7.125343', '2784', 19, 327780),
(266, 'SUCBOT0010', 'BOTICA 10', 'CARRERA 65 NO. 72-11 PRADO', '0', '7.125343', '2784', 10, 318992),
(267, 'SUCBOT0011', 'BOTICA 11', 'CALLE 85 NO. 76-62 SAN MARINO', '0', '7.125343', '2784', 10, 318992),
(268, 'SUCBOT0012', 'BOTICA 12', 'CARRERA 19 NO. 9A - 85 AVENIDA LOS CORTIJOS ', '0', '7.580327791330141', '2792', 20, 4550103),
(269, 'SUCBOT0014', 'BOTICA 14', 'CARRERA 40 NO. 28-03 BOLICHE', '0', '7.125343', '2784', 17, 4549889),
(270, 'SUCBOT0015', 'BOTICA 15', 'CALLE 15 NO. 11C - 75 LOCAL 25 CC POBLADO PLAZA', '0', '7.125343', '2784', 32, 4549905),
(271, 'SUCBOT0016', 'BOTICA 16', 'CALLE 34 NO. 43-06 PASEO BOLIVAR', '0', '7.125343', '2784', 17, 4549889),
(272, 'SUCBOT0017', 'BOTICA 17', 'CARRERA 40 NO. 34-06 LA PAZ', '0', '7.125343', '2784', 17, 4549889),
(273, 'SUCBOT0018', 'BOTICA 18', 'CALLE 19 NO. 4-10 SIMON BOLIVAR', '0', '7.125343', '2784', 17, 4549889),
(274, 'SUCBOT0019', 'BOTICA 19', 'CALLE 45 NO. 1-85 LOCAL 1-21 METROCENTRO', '0', '7.125343', '2784', 32, 4549905),
(275, 'SUCBOT0020', 'BOTICA 20', 'CALLE 48 NO. 43-129 COMFAMILIAR', '0', '7.125343', '2784', 10, 318992),
(276, 'SUCBOT0021', 'BOTICA 21', 'CALLE 45 NO. 14-10  VICTORIA ', '0', '7.125343', '2784', 17, 4549889),
(277, 'SUCBOT0022', 'BOTICA 22', 'CARRERA 46 NO. 61-51 LOCAL 103 BOSTON', '0', '7.125343', '2784', 10, 318992),
(278, 'SUCBOT0023', 'BOTICA 23', 'CALLE 25 NO. 9-102 HOSPITAL', '0', '7.125343', '2784', 32, 4549905),
(279, 'SUCBOT0024', 'BOTICA 24', 'CALLE 19 NO. 19-04 LOCAL ESQUINA', '0', '7.125343', '2784', 32, 4549905),
(280, 'SUCBOT0025', 'BOTICA 25', 'CALLE 2 NO. 5-28  BARRIO CENTRO ', '0', '7.125343', '2784', 19, 327780),
(281, 'SUCBOT0026', 'BOTICA 26', 'CALLE 2 NO. 7-04', '0', '7.125343', '2784', 19, 327780),
(282, 'SUCBOT0027', 'BOTICA 27', 'CALLE 17 NO. 19-08', '0', '7.125343', '2784', 32, 4549905),
(283, 'SUCBOT0028', 'BOTICA 28', 'CALLE 11A NO. 15-08  HOSPITAL', '0', '7.125343', '2799', 25, 4550113),
(284, 'SUCBOT0029', 'BOTICA 29', 'CALLE 7 NO. 6-86', '0', '7.125343', '2799', 25, 4550113),
(285, 'SUCBOT0030', 'BOTICA 30', 'CALLE 11A NO. 12-88 HOSPITAL', '0', '7.125343', '2799', 25, 4550113),
(286, 'SUCBOT0031', 'BOTICA 31', 'CALLE 16 NO. 13B  41 LOCAL 1', '0', '9.3031789772088', '2786', 24, 4549956),
(287, 'SUCBOT0032', 'BOTICA 32', 'CALLE 13 NO. 19-58', '0', '7.125343', '2799', 35, 4550110),
(288, 'SUCBOT0033', 'BOTICA 33', 'CALLE 13 NO. 17-60', '0', '7.125343', '2799', 35, 4550110),
(289, 'SUCBOT0034', 'BOTICA 34', 'CALLE 11 NO. 7-105', '0', '7.125343', '2799', 35, 4550110),
(290, 'SUCBOT0035', 'BOTICA 35', 'CALLE 5 NO. 5-68', '0', '7.125343', '2799', 35, 4550110),
(291, 'SUCBOT0036', 'BOTICA 36', 'CARRERA 6 NO. 2 SUR 89', '0', '7.125343', '2799', 35, 4550110),
(292, 'SUCBOT0037', 'BOTICA 37', 'CALLE 33 NO. 12A - 58 LOCAL 2', '0', '7.125343', '2799', 25, 4550113),
(293, 'SUCBOT0038', 'BOTICA 38', 'CALLE 14 NO. 10 - 123', '0', '7.125343', '2799', 35, 4550110),
(294, 'SUCBOT0039', 'BOTICA 39', 'CALLE 22 NO. 2-37 LOCAL 8 SANTA RITA', '0', '7.125343', '2800', 18, 4549929),
(295, 'SUCBOT0040', 'BOTICA 40', 'CARRERA 14 NO. 22-37 HOSPITAL', '0', '7.125343', '2800', 18, 4549929),
(296, 'SUCBOT0041', 'BOTICA 41', 'CARRERA 5 CALLE 19 ESQUINA', '0', '7.125343', '2800', 18, 4549929),
(297, 'SUCBOT0042', 'BOTICA 42', 'CARRERA 15 NO. 5A-29 GAIRA', '0', '7.125343', '2800', 26, 4550112),
(298, 'SUCBOT0043', 'BOTICA 43', 'AVENIDA LIBERTADOR NO. 27-230 BASTIDAS', '0', '7.125343', '2800', 15, 319055),
(299, 'SUCBOT0044', 'BOTICA 44', 'AV.FERROCARIL CON AV. RIO ESQUINA LOCAL 75 OCEAN MALL', '0', '7.125343', '2800', 18, 4549929),
(300, 'SUCBOT0045', 'BOTICA 45', 'CALLE 10   CARRERA  11 ESQUINA   08 LOCAL 4 PLAZA CENTENARIO ', '0', '7.125343', '2800', 26, 4550112),
(301, 'SUCBOT0046', 'BOTICA 46', 'AVDA FERROCARRRIL CRA 19 C C BOULEVAR LA 19 LOCAL 5', '0', '7.125343', '2800', 27, 4550111),
(302, 'SUCBOT0047', 'BOTICA 47', 'CALLE 6 NO. 11 - 05', '0', '7.125343', '2800', 26, 4550112),
(303, 'SUCBOT0048', 'BOTICA 48', 'TRANSVERSAL 25 NO. 16 C  03', '0', '7.125343', '2792', 35, 4550110),
(304, 'SUCBOT0049', 'BOTICA 49', 'CALLE 6 A NO. 3-94', '0', '7.125343', '2784', 32, 4549905),
(305, 'SUCBOT0050', 'BOTICA 50', 'CARRERA 8 NO. 5-62', '0', '7.125343', '2800', 15, 319055),
(306, 'SUCBOT0051', 'BOTICA 51 ', 'CALLE 77 NO. 23B - 33 LOS ROBLES', '0', '7.125343', '2784', 32, 4549905),
(307, 'SUCBOT0052', 'BOTICA 52', 'CALLE 7 NO. 4-8 ESQUINA', '0', '7.125343', '2800', 23, 4550128),
(308, 'SUCBOT0053', 'BOTICA 53', 'CALLE 7 NO. 18  149 ', '0', '7.125343', '2800', 23, 4550128),
(309, 'SUCBOT0054', 'BOTICA 54', 'CARRERA 8 NO. 8-50 BARRIO LA CONCEPCION ', '0', '7.125343', '2800', 23, 4550128),
(310, 'SUCBOT0055', 'BOTICA 55', 'CALLE 5 CON CARRERA 5 ESQUINA', '0', '7.125343', '2800', 23, 4550128),
(311, 'SUCBOT0056', 'BOTICA 56', 'CARRERA 15 NO. 14-35', '0', '7.125343', '2800', 24, 4549956),
(312, 'SUCBOT0057', 'BOTICA 57', 'CALLE 9 NO. 15-02', '0', '7.125343', '2800', 24, 4549956),
(313, 'SUCBOT0058', 'BOTICA 58', 'CARRERA 10 NO. 10 - 49    ESQUINA ', '0', '7.125343', '2800', 32, 4549905),
(314, 'SUCBOT0059', 'BOTICA 59', 'CALLE 10 CARRERA 11 ESQUINA', '0', '7.125343', '2800', 32, 4549905),
(315, 'SUCBOT0060', 'BOTICA 60', 'AVENIDA HOSPITAL NO. 29-05 BARRIO ZARAGOZILLA', '0', '7.125343', '2786', 13, 4550117),
(316, 'SUCBOT0061', 'BOTICA 61', 'AVENIDA VENEZUELA CENTRO COMERCIAL CANONAZO LOCAL 11', '0', '7.125343', '2786', 29, 4549939),
(317, 'SUCBOT0062', 'BOTICA 62', 'TRASVERSAL 50 NO. 49-68 AVENIDA CRISANTO LUQUE ALTO BOSQUE', '0', '7.125343', '2786', 13, 4550117),
(318, 'SUCBOT0063', 'BOTICA 63', 'CARRERA 3 NO. 5A-60 BOCAGRANDE', '0', '7.125343', '2786', 29, 4549939),
(319, 'SUCBOT0064', 'BOTICA 64', 'CARRERA 71 NO. 31-121 CALLE DEL BIFFI SANTA LUCIA', '0', '7.125343', '2786', 4, 319001),
(320, 'SUCBOT0065', 'BOTICA 65', 'CALLE 25 NO. 19-89 LOCAL 1 MANGA', '0', '7.125343', '2786', 29, 4549939),
(321, 'SUCBOT0066', 'BOTICA 66', 'CALLE 70 NO. 6-99 CRESPO', '0', '7.125343', '2786', 29, 4549939),
(322, 'SUCBOT0067', 'BOTICA 67', 'CALLE 29H NO. 21C 2 -15 LOCAL 3', '0', '7.125343', '2800', 27, 4550111),
(323, 'SUCBOT0068', 'BOTICA 68', 'CALLE DEL JUNCAL ESQUINA DEL COCO NO 49-25', '0', '7.125343', '2786', 13, 4550117),
(324, 'SUCBOT0069', 'BOTICA 69', 'TRANVERSAL 4 NO. 14-03', '0', '7.125343', '2786', 24, 4549956),
(325, 'SUCBOT0070', 'BOTICA 70', 'CARRERA 15 NO. 17A - 150', '0', '7.125343', '2786', 13, 4550117),
(326, 'SUCBOT0072', 'BOTICA 72', 'CALLE DEL MEDIO CARRERA 2DA NO. 18-02', '0', '7.125343', '2786', 23, 4550128),
(327, 'SUCBOT0073', 'BOTICA 73', 'CALLE 37 NO. 2-02', '0', '7.125343', '2794', 36, 4549948),
(328, 'SUCBOT0074', 'BOTICA 74', 'CARRERA 4 NO. 24-08', '0', '7.125343', '2794', 36, 4549948),
(329, 'SUCBOT0075', 'BOTICA 75', 'CARRERA 4 NO. 41-02', '0', '7.125343', '2794', 36, 4549948),
(330, 'SUCBOT0076', 'BOTICA 76', 'DIAGONAL 6 TRANVERSAL 9 NO. 9-02 CAMAJON', '0', '7.125343', '2794', 36, 4549948),
(331, 'SUCBOT0077', 'BOTICA 77', 'CALLE 22 NO. 27D-26 PRADERA', '0', '7.125343', '2794', 36, 4549948),
(332, 'SUCBOT0078', 'BOTICA 78', 'TRANVERSAL 5 NO. 18-07 GRANJA 18', '0', '7.125343', '2794', 36, 4549948),
(333, 'SUCBOT0080', 'BOTICA 80', 'TRANVERSAL 5 DIAGONAL 8-07  GRANJA  2', '0', '7.125343', '2794', 36, 4549948),
(334, 'SUCBOT0081', 'BOTICA 81', 'CALLE 31 NO. 26-53 CANTA CLARO', '0', '7.125343', '2794', 36, 4549948),
(335, 'SUCBOT0083', 'BOTICA 83', 'CALLE 6D NO .22 -86', '0', '7.125343', '2792', 20, 4550103),
(336, 'SUCBOT0084', 'BOTICA 84', 'CARRERA 4 NO. 18-05', '0', '7.125343', '2794', 22, 4550129),
(337, 'SUCBOT0085', 'BOTICA 85', 'CARRERA 8 NO. 19-06 ESQUINA', '0', '7.125343', '2794', 22, 4550129),
(338, 'SUCBOT0086', 'BOTICA 86', 'CALLE 21 NO. 20-06', '0', '7.125343', '2808', 24, 4549956),
(339, 'SUCBOT0087', 'BOTICA 87', ' CARRERA 9 NO. 12A-20 ESQUINA  BARRIO GRANADA ', '0', '7.125343', '2794', 36, 4549948),
(340, 'SUCBOT0088', 'BOTICA 88', 'CARRERA 9 NO. 12-07 NOVALITO', '0', '7.125343', '2792', 20, 4550103),
(341, 'SUCBOT0089', 'BOTICA 89', 'CALLE 16 NO. 18-134 HOSPITAL', '0', '7.125343', '2792', 11, 4550116),
(342, 'SUCBOT0090', 'BOTICA 90', 'CALLE 25A NO. 15-59 12 OCTUBRE', '0', '7.125343', '2792', 35, 4550110),
(343, 'SUCBOT0091', 'BOTICA 91', 'CALLE 16 NO.9-92 ZONA BANCARIA', '0', '7.125343', '2792', 11, 4550116),
(344, 'SUCBOT0092', 'BOTICA 92', 'CALLE 19B NO. 5A-61', '0', '7.125343', '2792', 11, 4550116),
(345, 'SUCBOT0093', 'BOTICA 93', 'CALLE 16 NO. 15-69 CLINICA', '0', '7.125343', '2792', 11, 4550116),
(346, 'SUCBOT0094', 'BOTICA 94', 'CALLE 20BIS NO. 4H-111 SAN ANTONIO  ', '0', '7.125343', '2792', 35, 4550110),
(347, 'SUCBOT0095', 'BOTICA 95', 'CARRERA 19 5 C - 06 LOS MUSICOS   ', '0', '7.125343', '2792', 20, 4550103),
(348, 'SUCBOT0096', 'BOTICA 96', 'CARRERA 18C NO. 23-07 SIMON BOLIVAR', '0', '7.125343', '2792', 35, 4550110),
(349, 'SUCBOT0097', 'BOTICA 97', 'CARRERA 18D NO. 34-04 SAN MARTIN', '0', '7.125343', '2792', 35, 4550110),
(350, 'SUCBOT0098', 'BOTICA 98', 'CARRERA 18 NO. 17-53', '0', '7.125343', '2792', 20, 4550103),
(351, 'SUCBOT0099', 'BOTICA 99', 'DIAGONAL 1 TRANVERSAL 10 ESQUINA', '0', '7.125343', '2792', 11, 4550116),
(352, 'SUCBOT0100', 'BOTICA 100', 'CARRETERA TRONCAL DE ORIENTE NO. 14-93', '0', '7.125343', '2792', 11, 4550116),
(353, 'SUCBOT0101', 'BOTICA 101', 'CARRERA 3 TRANSVERSAL 3  141 LOCAL 4 Y 5 ', '0', '7.125343', '2784', 19, 327780),
(354, 'SUCBOT0102', 'BOTICA 102', 'URBANIZACIN  CONCEPCIN 5  MANZANA F  CASA 3', '0', '7.125343', '2800', 27, 4550111),
(355, 'SUCBOT0103', 'BOTICA 103', 'CARRERA 16 NO 16-04', '0', '7.125343', '2792', 11, 4550116),
(356, 'SUCBOT0110', 'BOTICA 110', 'CARRERA 50 NO. 49 - 55 PARQUE', '0', '7.125343', '2781', 34, 318972),
(357, 'SUCBOT0111', 'BOTICA 111', 'CALLE 20 CARRERA 11 ESQUINA SECTOR PAJONAL', '0', '7.125343', '2781', 22, 4550129),
(358, 'SUCBOT0112', 'BOTICA 112', 'CARRERA 25 NO. 12-27', '0', '7.125343', '2794', 12, 319040),
(359, 'SUCCAR0001', 'DROGUERIA CARACAS', 'AVENIDA 5 CALLE 9 ESQUINA', '0', '7.125343', '2803', 9, 318931),
(360, 'SUCCAS0001', 'ALEMANA 58', 'CARRERA 6 NO. 9-40 CENTRO DE PIEDECUESTA ', '0', '7.125343', '2807', 14, 265454),
(361, 'SUCCOF0001', 'COOFARMA 1', 'CARRERA 32 NO. 30-08', '0', '7.125343', '2807', 1, 265458),
(362, 'SUCCOF0002', 'COOFARMA 2', 'CALLE 4 NO. 7-68', '0', '7.125343', '2807', 14, 265454),
(363, 'SUCCOF0003', 'COOFARMA 3', 'CARRERA 6 NO. 10-55', '0', '7.125343', '2807', 14, 265454),
(364, 'SUCCOF0004', 'COOFARMA 4', 'CALLE 13 NO. 15 - 29', '0', '7.125343', '2807', 5, 318944),
(365, 'SUCCOF0005', 'COOFARMA 5', 'CARRERA 33 NO. 52B-18-24', '0', '7.125343', '2807', 1, 265458),
(366, 'SUCCOF0006', 'COOFARMA 6', 'CARRERA 12 NO. 16 - 09-13', '0', '7.125343', '2807', 5, 318944),
(367, 'SUCCOT0001', 'ALEMANA COOTRACOLTA', 'CALLE 36 NO. 27-52', '0', '7.125343', '2807', 1, 265458),
(368, 'SUCCUC0001', 'DEPOSITO CUCUTA', 'AVENIDA 4 NO. 5-94 CENTRO', '0', '7.125343', '2803', 9, 318931),
(369, 'SUCDIS0001', 'DISPENSARIO 1', 'CALLE 30 NO.1-245   BODEGA 1', '0', '7.125343', '2784', 17, 4549889),
(370, 'SUCDIS0002', 'DISPENSARIO 2', 'CARRERA 47 NO. 81-47', '0', '7.125343', '2784', 19, 327780),
(371, 'SUCDIS0004', 'DISPENSARIO 4', 'CALLE 8 NO. 0 - 40', '0', '7.125343', '2803', 9, 318931),
(372, 'SUCDIS0005', 'DISPENSARIO 5', 'CRA 20 NO. 30 - 8 PISO 1 LOCAL 1', '0', '7.209900314368781', '2786', 4, 319001),
(373, 'SUCDIS0011', 'DISPENSARIO 11', 'AV LIBERTADOR N 24-45 LOCAL 9', '0', '7.125343', '2800', 15, 319055),
(374, 'SUCEVENTOS', 'DROGUERIA ALEMANA', 'CALLE 56 NO. 22 - 54', '0', '', '2807', 14, 265454),
(375, 'SUCFAR0001', 'FARMA SOCIAL 1', 'CARRERA 9 NO. 19 - 02 LOCAL 1', '0', '', '2794', 12, 319040),
(376, 'SUCFAR0002', 'FARMA SOCIAL 2', 'CALLE 26 NO. 13 - 70 ESQUINA', '0', '', '2794', 12, 319040),
(377, 'SUCFAR0003', 'FARMA SOCIAL 3', 'CALLE 28A NO. 31 - 03', '0', '', '2794', 12, 319040),
(378, 'SUCFAR0004', 'FARMA SOCIAL 4', 'CALLE 19 NO. 5 - 05 ESQUINA TRONCAL DEL OCCIDENTE', '0', '', '2794', 22, 4550129),
(379, 'SUCFAR0005', 'FARMA SOCIAL 5', 'CARRERA 23 NO. 11A - 03', '0', '', '2781', 22, 4550129),
(380, 'SUCHOS0001', 'DROGUERIA HOSPITALAR', 'AVENIDA 11E N  5AN - 88 DIAG HOSPITAL ERAZMO MEOS', '0', '7.125343', '2803', 9, 318931),
(381, 'SUCING0001', 'INGLESA 01', 'AVENIDA 4 CALLE 7 ESQUINA CENTRO', '0', '7.125343', '2803', 9, 318931),
(382, 'SUCING0002', 'INGLESA 02', 'AVENIDA 0 CALLE 9 ESQUINA', '0', '7.125343', '2803', 9, 318931),
(383, 'SUCING0003', 'INGLESA 03', 'AVENIDA SAN MARTIN CARRERA 2 NO. 4-115 BOCAGRANDE  LOCAL 1-2', '0', '7.125343', '2786', 29, 4549939),
(384, 'SUCING0004', 'INGLESA 04', 'AVENIDA COLOMBIA NO. 03-54', '0', '7.125343', '2786', 24, 4549956),
(385, 'SUCING0005', 'INGLESA 5 ESQUINAS', 'CARRERA 7A NO. 17-02', '0', '7.125343', '2792', 11, 4550116),
(386, 'SUCING0006', 'INGLESA 06', 'LOS CORALES MANZANA A LOTE 23 LOCAL 1-2 ', '0', '7.125343', '2786', 4, 319001),
(387, 'SUCING0007', 'INGLESA 07', 'CALLE 31 NO. 70-47 BARRIO SAN PEDRO', '0', '7.125343', '2786', 4, 319001),
(388, 'SUCING0008', 'INGLESA 08', 'CALLE 29D NO. 21C 146 PISO 1 LOCAL 2 PIE DE POPA', '0', '7.125343', '2786', 4, 319001),
(389, 'SUCING0009', 'INGLESA 09', 'CLL 2N 14 E  187 VILLA    JUNTO A PRADOS 2 ', '0', '7.125343', '2803', 9, 318931),
(390, 'SUCING0011', 'INGLESA 11', 'CARRERA 30NO. 38-B 16 LOCAL B BARRIO AMBERES', '0', '7.125343', '2786', 4, 319001),
(391, 'SUCING0012', 'ALEMANA 83', 'CALLE 7 NO. 29-150', '0', '7.125343', '2803', 21, 4550130),
(392, 'SUCING0014', 'INGLESA 14', 'AVENIDA GUAIMARAL DIAGONAL AL ISS', '0', '7.125343', '2803', 9, 318931),
(393, 'SUCING0015', 'INGLESA 15', 'TRANSVERSAL 3 NO. 14-62', '0', '7.125343', '2786', 24, 4549956),
(394, 'SUCING0016', 'INGLESA 16', 'SAN PEDRO MANZANA 36 LOTE 14 FRENTE AL AMPARO', '0', '7.125343', '2786', 4, 319001),
(395, 'SUCING0017', 'INGLESA 17', 'CALLE 70 NO. 1-20A BARRIO CRESPO', '0', '7.125343', '2786', 29, 4549939),
(396, 'SUCING0018', 'INGLESA 18', 'CALLE 29D NO. 22B-90', '0', '7.125343', '2786', 4, 319001),
(397, 'SUCING0020', 'INGLESA 20', 'CARRERA 47 NO. 70-10', '0', '7.125343', '2784', 10, 318992),
(398, 'SUCING0021', 'INGLESA 21', 'CARRERA 25 NO. 17 -18', '0', '7.125343', '2794', 12, 319040),
(399, 'SUCING0022', 'INGLESA 22', 'CALLE 20 NO. 17-75', '0', '7.125343', '2808', 24, 4549956),
(400, 'SUCING0023', 'INGLESA 23', 'CARRERA 21 NO. 5B - 02 FRENTE AL HOSPITAL ', '0', '7.125343', '2800', 26, 4550112),
(401, 'SUCING0024', 'INGLESA 24', 'CALLE 17 CARRERA 10 ESQUINA', '0', '7.125343', '2800', 26, 4550112),
(402, 'SUCING0025', 'INGLESA 25', 'CLLE 14 NO.9-176 LOCAL 1 ', '0', '7.125343', '2800', 15, 319055),
(403, 'SUCING0026', 'INGLESA 26', 'CALLE 14 NO. 25-15', '0', '7.125343', '2800', 15, 319055),
(404, 'SUCING0027', 'INGLESA 27', 'CALLE 30 CARRERA 19 ESQUINA', '0', '7.125343', '2800', 27, 4550111),
(405, 'SUCING0028', 'INGLESA 28', 'CALLE 12 NO. 16-122  BARRIO ALFONSO LOPEZ ', '0', '7.125343', '2792', 20, 4550103),
(406, 'SUCING0029', 'INGLESA 29', 'CARRERA 16 NO 14 - 12 CENTRO', '0', '7.125343', '2792', 11, 4550116),
(407, 'SUCING0030', 'INGLESA 30', 'CARRERA 9 NO. 13A-70', '0', '7.125343', '2792', 20, 4550103),
(408, 'SUCING0031', 'INGLESA 31', 'CARRERA 13 NO. 16-31 AVENIDAS LOS ESTUDIANTES', '0', '7.125343', '2794', 22, 4550129),
(409, 'SUCING0032', 'INGLESA 32', 'CARRERA 31 CALLE 1 ESQUINA LOCAL 1', '0', '7.125343', '2794', 22, 4550129),
(410, 'SUCING0033', 'INGLESA 33', 'CALLE 15 NO. 3E-145 MALECON', '0', '7.125343', '2803', 9, 318931),
(411, 'SUCING0034', 'ALEMANA 82', 'CARRERA 49 NO. 5A-35 SANTA CLARA', '0', '7.125343', '2803', 21, 4550130),
(412, 'SUCING0035', 'INGLESA 35', 'CALLE 8 NO. 9-100 GAIRA', '0', '7.125343', '2800', 26, 4550112),
(413, 'SUCING0036', 'INGLESA 36', 'CARRERA 9  NO.5  54 ', '0', '7.125343', '2800', 15, 319055),
(414, 'SUCING0038', 'INGLESA 38', 'CALLE REAL NO. 6-38', '0', '7.125343', '2803', 9, 318931),
(415, 'SUCING0039', 'INGLESA 39', 'PIE DE LA POPA  CALLE REAL DEL MEDIO CON CALLE MOMPOX   30-08', '0', '7.125343', '2786', 4, 319001),
(416, 'SUCING0040', 'INGLESA 40', 'CALLE 17 NO. 13-70 LA ESTACION', '0', '7.125343', '2800', 26, 4550112),
(417, 'SUCING0041', 'INGLESA 41', 'CALLE 29 NO. 50-19 DIAGONAL HOSPITAL UNIVERSITARIO', '0', '7.125343', '2786', 13, 4550117),
(418, 'SUCING0042', 'INGLESA 42', 'TRANSVERSAL 5 NO. 5-06 LA GRANJA', '0', '7.125343', '2794', 12, 319040),
(419, 'SUCING0043', 'INGLESA 43', 'CALLE 20 NO. 3-26 AVENIDA CIRCUNVALAR', '0', '7.125343', '2794', 12, 319040),
(420, 'SUCING0044', 'INGLESA 44', 'CALLE 48 NO. 11 - 04 URB. VILLA DEL RIO ', '0', '7.125343', '2794', 12, 319040),
(421, 'SUCING0045', 'INGLESA 45', 'CLL 15 NO. 06 -PISO 1 LOC 1 BARRIO CENTRO ', '0', '7.125343', '2786', 24, 4549956),
(422, 'SUCING0046', 'INGLESA 46', 'CALLE 82 NO. 46-58 LOCAL 1', '0', '7.125343', '2784', 19, 327780),
(423, 'SUCING0047', 'INGLESA 47', 'CARRERA 30 CALLE 1 NO. 18-41 CORREDOR UNIVERSITARIO CC-LCHAMP', '0', '7.125343', '2784', 19, 327780),
(424, 'SUCING0048', 'INGLESA 48', 'C.C. SANTA CATALINA PLAZA CRA 15 NO. 28 - 27 LOCAL 18 Y 23', '0', '7.125343', '2786', 13, 4550117),
(425, 'SUCING0049', 'INGLESA 49', 'AVENIDA LIBERTADORES FRENTE AL CASD MANZANA 25 LOTE 13 LOCAL 1 ', '0', '7.125343', '2803', 9, 318931),
(426, 'SUCING0050', 'INGLESA 50', 'TRANSVERSAL 5 NO. 10-45', '0', '7.125343', '2794', 12, 319040),
(427, 'SUCING0051', 'INGLESA 51', 'CALLE 6D NO. 18-126', '0', '7.125343', '2792', 20, 4550103),
(428, 'SUCING0052', 'INGLESA 52', 'SECTOR IND EL MAMONAL KM 6 ESTACION SER L 106 PARQUE INDUSTRIAL LAS AMERICAS', '0', '7.125343', '2786', 13, 4550117),
(429, 'SUCING0053', 'INGLESA 53', 'CARRERA 71 NO. 30B-57 MANZANA 1 LOTE 11 SAN PEDRO', '0', '7.125343', '2786', 4, 319001),
(430, 'SUCING0054', 'INGLESA 54', 'CALLE 19  N 17 38 CENTRO ', '0', '7.125343', '2784', 32, 4549905),
(431, 'SUCING0055', 'INGLESA 55', 'AVENIDA 0 NO. 0-71 JUNTO AL MERKAGUSTO', '0', '7.125343', '2803', 9, 318931),
(432, 'SUCING0056', 'INGLESA 56', 'CALLE 16 NO. 98-09 LOS PATIOS', '0', '7.125343', '2803', 9, 318931),
(433, 'SUCING0057', 'INGLESA 57', 'AVENIDA GRAN COLOMBIA NO. 6E-138', '0', '7.125343', '2803', 9, 318931),
(434, 'SUCING0058', 'INGLESA 58', 'CRA 14 A  NO. 24-33 FRENTE AL SENA', '0', '7.125343', '2794', 12, 319040),
(435, 'SUCING0059', 'INGLESA 59', 'CARRERA 18D NO. 22A-06', '0', '7.125343', '2792', 35, 4550110),
(436, 'SUCING0060', 'INGLESA 60', 'MANZANA 80 CASA 7 URBANIZACION EL PANDO', '0', '7.125343', '2800', 27, 4550111),
(437, 'SUCING0061', 'INGLESA 61', 'AVENIDA 3E NO. 4-08 DIAGONAL LA CANASTA', '0', '7.125343', '2803', 9, 318931),
(438, 'SUCING0062', 'INGLESA 62', 'AVENIDA 3 NO. 12-61 BARRIO SAN LUIS', '0', '7.125343', '2803', 9, 318931),
(439, 'SUCING0063', 'INGLESA 63', 'CARRERA 12 SUR NO. 43-38 CIUDADELA 20 DE JULIO', '0', '7.125343', '2784', 32, 4549905),
(440, 'SUCING0064', 'INGLESA 64', 'CASTILLOGRANDE CALLE 5 NO 6-115', '0', '7.125343', '2786', 29, 4549939),
(441, 'SUCING0065', 'INGLESA 65', 'CRA 2 N 31-10 CENTRO', '0', '7.125343', '2794', 12, 319040),
(442, 'SUCING0066', 'INGLESA 66', 'CRA 6 NO. 62-64 LOC 107 PLAZA DE LA CASTELLANA ', '0', '7.125343', '2794', 36, 4549948),
(443, 'SUCING0067', 'INGLESA 67', 'CALLE 7  6 - 74', '0', '7.125343', '2800', 23, 4550128),
(444, 'SUCING0068', 'INGLESA 68', 'CALLE 59 NO. 50-71 LOCAL 1', '0', '7.125343', '2784', 10, 318992),
(445, 'SUCING0069', 'INGLESA 69', 'CALLE 16 NO 17A - 32 SAN VICENTE', '0', '7.125343', '2792', 11, 4550116),
(446, 'SUCING0070', 'INGLESA 70', 'CALLE 3 CRA 10 NO. 3-93', '0', '7.125343', '2800', 15, 319055),
(447, 'SUCING0071', 'INGLESA 71', 'BLAS DE LEZO MANZANA 10C LOTE 10 ETAPA 1', '0', '7.125343', '2786', 4, 319001),
(448, 'SUCING0072', 'INGLESA 72', 'CENTRO COMERCIAL  PORTAL LIBERTADOR  AVENIDA DEL LIBERTADOR NO.26-208  LOCALES NO.17 Y 18', '0', '7.125343', '2800', 15, 319055),
(449, 'SUCING0073', 'INGLESA 73', 'CARRERA 6 NO. 15A-20 ', '0', '7.125343', '2800', 15, 319055),
(450, 'SUCING0074', 'INGLESA 74', 'CALLE 5 NO. 3A-44 PLAZA CENTRAL ', '0', '7.125343', '2792', 11, 4550116),
(451, 'SUCING0075', 'INGLESA 75', 'BOCAGRANDE CARRERA 6 N 5 - 119', '0', '7.125343', '2786', 29, 4549939),
(452, 'SUCING0076', 'INGLESA 76', 'TRANSVERSAL 54  28-04  LOCALES 3 Y 4 B CEBALLOS', '0', '7.125343', '2786', 4, 319001),
(453, 'SUCING0077', 'INGLESA 77', 'MANZANA I6 LOTE 15  O  CALLE 4B N 21-03 LOCAL 6 Y 7 JUAN ATALAYA 1 ETAPA  PRIMERA ETAPA', '0', '7.125343', '2803', 9, 318931),
(454, 'SUCING0078', 'INGLESA 78', ' CARRERA 71 N 31A 219', '0', '7.125343', '2786', 4, 319001),
(455, 'SUCING0079', 'INGLESA 79', 'CALLE 38 B  11-129 LOCAL 1 ', '0', '7.125343', '2784', 17, 4549889),
(456, 'SUCING0080', 'INGLESA 80', 'CALLE 21 NO. 8 - 133', '0', '6.2524279080835985', '2781', 22, 4550129),
(457, 'SUCING0081', 'INGLESA 81', 'CARRERA 6 N 5 59 ', '0', '7.125343', '2803', 9, 318931),
(458, 'SUCING0082', 'INGLESA 82', 'CALLE 15  0-93 BRR LA PLAYA', '0', '7.125343', '2803', 9, 318931),
(459, 'SUCING0083', 'INGLESA 83', 'CARRERA 21 NO. 26 - 09 LOCAL 1', '0', '7.125343', '2786', 29, 4549939),
(460, 'SUCING0084', 'INGLESA 84', 'CALLE 18 NO. 2 -28', '0', '7.125343', '2786', 23, 4550128),
(461, 'SUCING0085', 'INGLESA 85', 'AVENIDA 0 NO. 12 - 04', '0', '7.125343', '2803', 9, 318931),
(462, 'SUCING0086', 'INGLESA 86', 'CALLE 82 NO 57 - 78  LOCAL  1- 01 ', '0', '7.125343', '2784', 10, 318992),
(463, 'SUCING0087', 'INGLESA 87', 'CARRERA 5 NO. 5 - 24  PARQUE PRINCIPAL ', '0', '7.125343', '2803', 9, 318931),
(464, 'SUCING0088', 'INGLESA 88 PLUS', 'CALLE 28 NO. 5 - 56', '0', '7.125343', '2794', 12, 319040),
(465, 'SUCING0089', 'INGLESA 89', 'CARRERA 6 NO.60-24  LOCAL NO.3 ', '0', '7.125343', '2794', 12, 319040),
(466, 'SUCING0090', 'INGLESA 90', ' AEROPUERTO ERNESTO CORTISSOZ  PISO 2', '0', '7.125343', '2784', 32, 4549905),
(467, 'SUCING0091', 'INGLESA 91', 'CARRERA 6 NO. 5  01', '0', '7.125343', '2799', 35, 4550110),
(468, 'SUCING0092', 'INGLESA 92', 'CALLE 14 NO. 8 - 21 LOCAL 1', '0', '7.125343', '2799', 25, 4550113),
(469, 'SUCING0093', 'INGLESA 93', 'CALLE 15 NO. 18 -04', '0', '7.125343', '2799', 35, 4550110),
(470, 'SUCING0094', 'INGLESA 94', 'LOS CALAMARES  ETAPA 3  MANZANA 56  LOTE  17', '0', '7.125343', '2786', 13, 4550117),
(471, 'SUCING0095', 'INGLESA 95', 'CARRERA 1 NO. 6 - 154 LOCAL 6111', '0', '7.125343', '2786', 29, 4549939),
(472, 'SUCING0096', 'INGLESA 96', 'CALLE 17  NO. 8 - 56', '0', '7.125343', '2792', 11, 4550116),
(473, 'SUCING0097', 'INGLESA 97', 'CALLE 13 NO. 1E-67 CAOBOS', '0', '7.125343', '2803', 9, 318931),
(474, 'SUCING0098', 'INGLESA 98', 'CALLE 30 NO. 6B - 215 LOCAL 43 CC PANORAMA', '0', '7.125343', '2784', 17, 4549889),
(475, 'SUCING0099', 'INGLESA 99', 'BARRIO SAN PEDRO MANZANA 5 LOTE 9 ESQUINA', '0', '7.125343', '2786', 4, 319001),
(476, 'SUCING0100', 'INGLESA 100', 'CALLE 106 NO. 50 - 67 LOCAL 14 C.C. GRAN BOULEVAR', '0', '7.125343', '2784', 19, 327780),
(477, 'SUCING0101', 'INGLESA 101', 'CARRERA 7H  33  03 LOCAL 1', '0', '7.125343', '2799', 25, 4550113),
(478, 'SUCING0102', 'INGLESA 102', 'CABRERO  AV SANTANDER NO. 43 - 18 EDIFICIO ZAFIRO', '0', '7.125343', '2786', 29, 4549939),
(479, 'SUCING0103', 'INGLESA 103', 'CRA 9 NO 34-30 EDIFICIO ATABEIRA LOCAL 1', '0', '7.125343', '2786', 29, 4549939),
(480, 'SUCING0104', 'INGLESA 104', 'CALLE 31 NO. 3-62 LOCAL 1', '0', '7.125343', '2794', 12, 319040);
INSERT INTO `sucursales` (`id_suscursal`, `cod_sucursal`, `nombre`, `direccion`, `longitud`, `latitud`, `departamento`, `id_zona`, `id_api_zona`) VALUES
(481, 'SUCING0105', 'INGLESA 105', 'CALLE 85 NO. 50 - 49 L1 DE LA TORRE MEDICA DEL MAR CENTER', '0', '7.125343', '2784', 19, 327780),
(482, 'SUCING0106', 'INGLESA 106', 'CALLE 13 NO. 10  03', '0', '7.125343', '2800', 32, 4549905),
(483, 'SUCING0107', 'INGLESA 107', 'CALLE 11  3 - 02', '0', '7.125343', '2803', 9, 318931),
(484, 'SUCING0108', 'INGLESA 108', 'CARRERA 20 NO. 3 - 06', '0', '7.125343', '2792', 20, 4550103),
(485, 'SUCING0109', 'INGLESA 109', 'CALLE 14 NO. 13 - 39', '0', '7.125343', '2800', 32, 4549905),
(486, 'SUCING0110', 'INGLESA 110', ' URBANIZACION LOS MAYALES  CALLE 31 NO. 6BIS - 90', '0', '7.125343', '2792', 35, 4550110),
(487, 'SUCING0111', 'INGLESA 111', 'CARRERA 18 NO.17-62 LOCAL NO.1', '0', '7.125343', '2792', 20, 4550103),
(488, 'SUCING0112', 'INGLESA 112', 'AVENIDA 5A NO. 4 - 132 PRADOS DEL ESTE', '0', '7.125343', '2803', 9, 318931),
(489, 'SUCING0114', 'INGLESA 114 CERRADA ', 'MEGATIENDA  CALLE 74 NO. 38D  113 LOCAL 40', '0', '7.125343', '2784', 17, 4549889),
(490, 'SUCING0115', 'INGLESA 115', 'CALLE 14 NO. 17  05', '0', '', '2792', 11, 4550116),
(491, 'SUCING0116', 'INGLESA 116', 'CALLE 21 NO 18 -03 LOCAL NO. 3  ', '0', '', '2784', 32, 4549905),
(492, 'SUCING0117', 'INGLESA 117', 'CARRERA 58 NO. 96  178 LOCAL 5 C.C. MALL 98', '0', '', '2784', 19, 327780),
(493, 'SUCING0118', 'INGLESA 118', 'TRANSVERSAL 9 NO. 6  35  ', '0', '', '2794', 36, 4549948),
(494, 'SUCING0119', 'INGLESA 119', 'CALLE 13 NO. 18  110', '0', '', '2799', 35, 4550110),
(495, 'SUCING0120', 'INGLESA 120', 'CARRERA 5 NO.18-73', '0', '', '2794', 22, 4550129),
(496, 'SUCING0121', 'INGLESA 121', 'CARRERA 65 NO. 86 - 191 LOCAL 101 CENTRO COMERCIAL PLAZA NORTE', '0', '', '2784', 10, 318992),
(497, 'SUCING0122', 'INGLESA 122', 'CARRERA 43 NO. 97 - 55 MIRAMAR', '0', '', '2784', 19, 327780),
(498, 'SUCING0123', 'INGLESA 123', 'CALLE 50 NO. 14D - 85 LOCAL 1', '0', '', '2794', 36, 4549948),
(499, 'SUCING0124', 'INGLESA 124', 'CALLE 3 NO. 25 - 27 LC2 CC BRAZUCA', '0', '', '2784', 19, 327780),
(500, 'SUCING0125', 'INGLESA 125', 'CALLE 77 NO. 73 - 73 LO 5', '0', '', '2784', 10, 318992),
(501, 'SUCING0126', 'INGLESA 126', 'CALLE 29 NO. 16 - 16', '0', '', '2794', 12, 319040),
(502, 'SUCING0127', 'INGLESA 127', 'DIAGONAL 13 NO. 7A - 51 LACHARME', '0', '', '2794', 12, 319040),
(503, 'SUCING0128', 'INGLESA 128', 'CARRERA 19 NO. 14 - 97 B. SAN VICENTE', '0', '', '2792', 11, 4550116),
(504, 'SUCING0129', 'INGLESA 129', 'CARRERA 15 NO. 15 - 16', '0', '', '2799', 25, 4550113),
(505, 'SUCING0130', 'INGLESA 130', 'AVENIDA 6A NO. 9 - 51 CENTRO', '0', '', '2803', 9, 318931),
(506, 'SUCING0131', 'INGLESA 131', 'CARRERA 13 11P 70 ESQUINA LOCAL 102', '0', '', '2794', 22, 4550129),
(507, 'SUCING0132', 'INGLESA 132', 'CARRERA 13 NO. 31B - 35 BARRIO TORICES', '0', '', '2786', 29, 4549939),
(508, 'SUCING0133', 'INGLESA 133', 'CALLE 20 NO. 10A - 03 ESQUINA', '0', '', '2794', 22, 4550129),
(509, 'SUCING0134', 'INGLESA 134', 'CARRERA 9 NO. 12 - 57 ESQUINA', '0', '', '2792', 20, 4550103),
(510, 'SUCING0135', 'INGLESA 135', 'CALLE 11 NO. 4 - 51 INTERNACIONAL LECS LC 136', '0', '', '2803', 9, 318931),
(511, 'SUCING0136', 'INGLESA 136', 'AVENIDA 8 NO. 5 - 36 UNI 1 CC BETEL', '0', '', '2803', 9, 318931),
(512, 'SUCING0137', 'INGLESA 137', 'AVENIDA 10 NO. 19 - 33 LC 7 Y 8', '0', '', '2803', 9, 318931),
(513, 'SUCING0138', 'INGLESA 138', 'AVENIDA 3 NO. 13 - 61 LOCAL 3', '0', '', '2803', 9, 318931),
(514, 'SUCING0139', 'INGLESA 139', 'AVENIDA 8A NO. 5 - 04 AVDA LIBERTADORES EDIF CANOA', '0', '', '2803', 9, 318931),
(515, 'SUCING0140', 'INGLESA 140', 'CALLE 13 NO. 12 - 58 CALLE DEL COMERCIO', '0', '', '2794', 24, 4549956),
(516, 'SUCING0141', 'INGLESA 141', 'CALLE 78 NO. 53 - 70 LOCAL 116 CENTRO COMERCIAL VILLA COUNTRY', '0', '', '2784', 10, 318992),
(517, 'SUCING0142', 'INGLESA 142', 'CARRERA 27 C NO. 22 - 03', '0', '', '2794', 36, 4549948),
(518, 'SUCING0143', 'INGLESA 143', 'CALLE 10 NO. 4 - 05', '0', '', '2803', 9, 318931),
(519, 'SUCING0144', 'INGLESA 144', 'CALLE 15 NO. 0 - 21', '0', '', '2803', 9, 318931),
(520, 'SUCING0145', 'INGLESA 145', 'CALLE 3 NO. 4 - 42 LC 4 PLAZA BELLAVISTA', '0', '', '2803', 9, 318931),
(521, 'SUCING0146', 'INGLESA 146', 'CC UNICENTRO LOCAL 1-61', '0', '', '2803', 9, 318931),
(522, 'SUCING0147', 'INGLESA 147', 'CALLE 10 Y 11 DG SANTANDER LC 1 - 54 CC VENTURA PLAZA', '0', '', '2803', 9, 318931),
(523, 'SUCING0149', 'INGLESA 149', 'URBANIZACION SANTA LUCIA BARRIO TERNERA', '0', '', '2786', 4, 319001),
(524, 'SUCING0150', 'INGLESA 150', 'CARRERA 68 NO. 17 - 04 MZ E LOTE 10 URB CARMELO', '0', '', '2786', 13, 4550117),
(525, 'SUCING0151', 'INGLESA 151', 'DIAGONAL 33A NO. 31 L-180 P 1 APTO 2', '0', '', '2786', 13, 4550117),
(526, 'SUCING0152', 'INGLESA 152', 'CARRERA 6 NO. 7 - 83 LOCAL 3', '0', '', '2803', 9, 318931),
(527, 'SUCING0153', 'INGLESA 153', 'CALLE 7 NO. 9C - 32', '0', '', '2784', 19, 327780),
(528, 'SUCING0154', 'INGLESA 154', 'CALLE 1 NO. 25 - 19 - 13 LOCAL 24 Y 25 VILLA LIGIA III', '0', '', '2792', 20, 4550103),
(529, 'SUCING0155', 'INGLESA 155', 'CARRERA 25 NO. 9A - 07 LOCAL 1', '0', '', '2794', 12, 319040),
(530, 'SUCING0156', 'INGLESA 156', 'CARRERA 7 NO. 20 - 04 ESQUINA', '0', '', '2794', 22, 4550129),
(531, 'SUCING0159', 'INGLESA 159', 'PENDIENTE C.COMERCIO', '0', '', '2794', 12, 319040),
(532, 'SUCING0160', 'INGLESA 160', 'CENTRO COMERCIAL SUPER CENTRO LOS EJECUTIVOS LOCAL 44 Y 45', '0', '', '2786', 13, 4550117),
(533, 'SUCING0201', 'INGLESA 201', 'AV.P.H. CL31 N57-106 C.C LOS EJECUTVO LOCAL 96 Y 99', '0', '7.125343', '2786', 13, 4550117),
(534, 'SUCING0203', 'INGLESA 203', 'KRA71 N31A-12 LOCAL 1 BIFFI', '0', '7.125343', '2786', 4, 319001),
(535, 'SUCING0204', 'INGLESA 204', 'URB. LA CASTELLANA KR 66 N 31-11', '0', '7.125343', '2786', 13, 4550117),
(536, 'SUCING0205', 'INGLESA 205', 'AV. JIMENEZ CL 26 N19-58', '0', '7.125343', '2786', 29, 4549939),
(537, 'SUCING0206', 'INGLESA 206', 'C.C.BOCAGRANDE K2 N 8-110 LOCAL 3', '0', '7.125343', '2786', 29, 4549939),
(538, 'SUCING0208', 'INGLESA 208', 'CL 80 KRA 38 -09 ESQ.', '0', '7.125343', '2784', 17, 4549889),
(539, 'SUCING0210', 'INGLESA 210', 'CARRERA 20 NO.11 A  0  BARRIO EL TRIANGULO', '0', '7.125343', '2781', 22, 4550129),
(540, 'SUCING0211', 'INGLESA 211', 'CALLE 22A NO. 4 - 28 LOCAL ESQUINA', '0', '7.125343', '2781', 22, 4550129),
(541, 'SUCL250001', 'DROGAS LA 25', 'CALLE 25 AVENIDA 5 NO 5-03 ESQUINA OSPINA PEREZ', '0', '7.125343', '2803', 9, 318931),
(542, 'SUCMED0001', 'MEDICATEL 1', 'CARRERA 21 NO. 52-08 CONCORDIA ', '0', '7.125343', '2807', 1, 265458),
(543, 'SUCMED0002', 'MEDICATEL 2', 'CARRERA 25 NO. 30-20 CANAVERAL ', '0', '7.125343', '2807', 14, 265454),
(544, 'SUCMED0004', 'MEDICATEL 4', 'CALLE 56 NO. 22 - 64', '0', '7.125343', '2807', 1, 265458),
(545, 'SUCPRO0002', 'INGLESA PROVENZA', 'CL 80 NO 66 - 46 LO 1', '0', '7.125343', '2784', 10, 318992),
(546, 'SUCSEX0001', 'LA SEXTA', 'AVENIDA 6 CALLE 6 NO.02 ESQUINA ', '0', '7.125343', '2803', 9, 318931),
(547, 'SUCSFR0001', 'INGLESA SAN FRANCISC', 'CARRERA 38 NO. 70B-117 LOC 3 SAN FRANCISCO ', '0', '7.125343', '2784', 17, 4549889),
(548, 'SUCSJ10001', 'SAN JUAN 1', 'CALLE 12 AVENIDA 0A NO. 01 ESQUINA LA PLAYA', '0', '7.125343', '2803', 9, 318931),
(549, 'SUCSJ20002', 'SAN JUAN 2', 'AVENIDA LOS LIBERTADORES NO. 1N-19', '0', '7.125343', '2803', 9, 318931),
(550, 'SUCSPA0003', 'ALEMANA 73', 'CR 33 NO 32 - 06', '0', '7.125343', '2807', 1, 265458),
(551, 'SUCALE0190', 'ALEMANA 190', 'AVENIDA 40 NO. 27A - 54 LOCAL 1-2 EDIFICIO AGA', '', '', '2807', 1, 265458);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_seguimiento_usuarios`
--

CREATE TABLE `tabla_seguimiento_usuarios` (
  `idseguimiento_registro` int(11) NOT NULL,
  `id_seguimiento_opciones` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `fecha_seguimiento` datetime NOT NULL,
  `id_plan_trabajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cedula` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `cedula`, `id_api`) VALUES
(1, 'RICARDO', 'chakvera@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '13.516.199', 265813),
(2, 'ALVARO', 'alfemoge@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '13.874.227', 265820),
(3, 'ANDRES', 'amoya.070185@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '91.535.509', 265828),
(4, 'JORGE ', 'jorsan66@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '12.621.676', 335694),
(5, 'OMAR', 'yolyzarazo@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '91.110.133', 336188),
(6, 'CHRISTIAN', 'cristianbarret12@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '5.821.608', 336499),
(7, 'WILMER', 'gatowil000@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '72.344.446', 348252),
(8, 'FERNEY', 'FERNEYMOTTA01@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '12.241.787', 363101),
(9, 'WILMAR', 'Wilmarserranoardila@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '1.102.548.451', 363490),
(10, 'VICTOR', 'victorunidrogas@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '72.347.478', 363755),
(11, 'ALEX', 'alexvera@unidrogas.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '77.159.633', 443652),
(12, 'MICHAEL', 'mlandon86@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '72.345.206', 444531),
(13, 'MARIO', 'mfduarte16@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '1.095.788.968', 447706),
(14, 'MAYERLY', 'mayerlyrondon2306@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '1.098.673.369', 584225),
(15, 'MIGUEL', 'mauc1971@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '85.462.691', 834252),
(16, 'JAIRO', 'jarizarivero@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '9.112.369', 834634),
(17, 'NEIL', 'ne.ko@hotmail.es', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '72.248.516', 835164),
(18, 'CLAUDIA', 'pedrocarbono2012@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '57.433.265', 903697),
(19, 'ALVARO', 'amejia@unidrogas.net.co', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '72.150.613', 904779),
(20, 'ELAINE', 'Jhoela202@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '1.065.565.810', 1113466),
(21, 'MARLON ', 'masver57@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:38:59', '2018-11-24 17:38:59', '88.277.545', 1800567),
(22, 'JORGE', 'jmontes1991@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '1.082.942.967', 11308224),
(23, 'RAFAEL', 'rafabelma@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '1.128.145.974', 11785911),
(24, 'YEINER', 'ysan.ser@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '1.065.591.851', 11786107),
(25, 'ALEXANDER', 'alexanderg1978@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '13.513.627', 11786426),
(26, 'NELSON', 'nelsonmirandamarimon@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '5.122.647', 11786427),
(27, 'YUDIS', 'yqv078@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '36.722.607', 11786428),
(28, 'CARLOS', 'carlosanchez1403@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '85.452.086', 11786429),
(29, 'JEFFREY', 'jeffreyrojiz@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '74381592', 11786961),
(30, 'MARCO', 'marcodemoya@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '72159244', 11787007),
(31, 'RUTH', 'ruthbravo23@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '30.726.342', 11787458),
(32, 'VERONICA', 'veronica.ortega@yahoo.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '29.105.324', 11787518),
(33, 'FABIAN', 'fabianalbor@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '8.639.206', 11787789),
(34, 'DIANA', 'dimipaso@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '43.920.293', 11788122),
(35, 'EDER', 'ederhm0131@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '71.330.319', 11788129),
(36, 'JOSE', 'JSOTO9031@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '1.128.149.055', 11788263),
(37, 'JADER', 'jaderperez69@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '15.611.100', 11788748),
(38, 'LUIS', 'DSBZONA3@YAHOO.ES', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '12.563.589', 11790185),
(39, 'EFREN', 'efoscar26@hotmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '91.259.553', 265795),
(40, 'RODRIGO', 'rhernandez@unidrogas.net.co', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '8.694.539', 835274),
(41, 'ALESSANDRO', 'ffreytte@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '79.466.536', 851441),
(42, 'DANIEL', 'daniels.melendez86@gmail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '1.098.615.330', 11788526),
(43, 'DIEGO ', 'DIEGODURANDAZA@OUTLOOK.COM', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-11-24 17:39:00', '2018-11-24 17:39:00', '16.260.356', 11790034);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `cedula`, `correo`, `password`, `telefono`, `codigo`, `foto`, `id_api`) VALUES
(1, 'RICARDO', 'VERA', '13.516.199', 'chakvera@hotmail.com', '', '3187342319', '00008', '../../../sieunidrogas/gestion/documentos/05062014/SIERH0007_110724_11710676_RICARDO_VERA_VESGA.JPG', 265813),
(2, 'ALVARO', 'MORENO', '13.874.227', 'alfemoge@gmail.com', '', '3228791867', '00009', '../../../sieunidrogas/gestion/documentos/25092014/SIERH0007_180750_11710676_20140925_170417.jpg', 265820),
(3, 'ANDRES', 'MOYA', '91.535.509', 'amoya.070185@gmail.com', '', '3168752160', '00010', '../../../sieunidrogas/gestion/documentos/23092014/SIERH0007_083706_11710676_ANDRES_MOYA.JPG', 265828),
(4, 'JORGE ', 'OTERO', '12.621.676', 'jorsan66@hotmail.com', '', '3174420511', '00058', '../../../sieunidrogas/gestion/documentos/30062018/SIERH0007_113234_11778082_Jorge_Otero.jpg', 335694),
(5, 'OMAR', 'COBOS', '91.110.133', 'yolyzarazo@hotmail.com', '', '7296567', '00075', '../../../sieunidrogas/gestion/documentos/18092014/SIERH0007_110722_11710676_COBOS_LOPEZ_OMAR.jpg', 336188),
(6, 'CHRISTIAN', 'BARRETO', '5.821.608', 'cristianbarret12@hotmail.com', '', '3103099855', '00077', '../../../sieunidrogas/gestion/documentos/05122015/SIERH0007_074947_11710676_IMG-20151204-WA0004.jpg', 336499),
(7, 'WILMER', 'VALBUENA', '72.344.446', 'gatowil000@hotmail.com', '', '7486876-3212622053', '00176', '../../../sieunidrogas/gestion/documentos/03082018/SIERH0007_154547_11710676_WhatsApp_Image_2018-08-03_at_2.56.15_PM.jpeg', 348252),
(8, 'FERNEY', 'MOTTA', '12.241.787', 'FERNEYMOTTA01@hotmail.com', '', '3124555188', '00209', '../../../sieunidrogas/gestion/documentos/13112014/SIERH0007_174322_11710676_FENEY_MOTTA.jpg', 363101),
(9, 'WILMAR', 'SERRANO', '1.102.548.451', 'Wilmarserranoardila@hotmail.com', '', '3173677220', '00232', '../../../sieunidrogas/gestion/documentos/18062014/SIERH0007_173522_11710676_wilmar_serrano.jpg', 363490),
(10, 'VICTOR', 'SILVA', '72.347.478', 'victorunidrogas@hotmail.com', '', '3644868-3174297970', '00246', '../../../sieunidrogas/gestion/documentos/13112014/SIERH0007_171322_11710676_SILVA_PARRA_VICTOR_ALFONSO.jpg', 363755),
(11, 'ALEX', 'VERA', '77.159.633', 'alexvera@unidrogas.com', '', '3103644898', '00446', '../../../sieunidrogas/gestion/documentos/08102014/SIERH0007_082310_11710676_ALEX_VERA_COORDINADOR_ZONA_VALLEDUPAR.png', 443652),
(12, 'MICHAEL', 'RODRIGUEZ', '72.345.206', 'mlandon86@hotmail.com', '', '3013841745', '00452', '../../../sieunidrogas/gestion/documentos/07012015/SIERH0007_101431_11710676_MICHAEL_RODRIGUEZ.jpg', 444531),
(13, 'MARIO', 'DUARTE', '1.095.788.968', 'mfduarte16@hotmail.com', '', '3112027818-6325181', '00500', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_081532_11710676_MARIO_FERNANDO_DULCY_DUARTE.JPG', 447706),
(14, 'MAYERLY', 'RONDON', '1.098.673.369', 'mayerlyrondon2306@gmail.com', '', '3223120648', '00564', '../../../sieunidrogas/gestion/documentos/28052014/SIERH0007_171151_11710676_MAYERLI_RONDON_QUIONEZ.jpg', 584225),
(15, 'MIGUEL', 'URIBE', '85.462.691', 'mauc1971@hotmail.com', '', '4337227', '00607', '../../../sieunidrogas/gestion/documentos/22102014/SIERH0007_082453_11710676_miguel_uribe.jpg', 834252),
(16, 'JAIRO', 'ARIZA', '9.112.369', 'jarizarivero@hotmail.com', '', '3168627059-312600810', '00611', '../../../sieunidrogas/gestion/documentos/11112014/SIERH0007_145949_11710676_Jairo_Ariza.png', 834634),
(17, 'NEIL', 'COVA', '72.248.516', 'ne.ko@hotmail.es', '', '3772529-3014879801', '00612', '../../../sieunidrogas/gestion/documentos/18112014/SIERH0007_094720_11710676_Neil_Cova.jpg', 835164),
(18, 'CLAUDIA', 'FERNANDEZ', '57.433.265', 'pedrocarbono2012@hotmail.com', '', '4352714', '00615', '../../../sieunidrogas/gestion/documentos/05122014/SIERH0007_150527_11710676_CLAUDIA_FERNANDEZ.jpg', 903697),
(19, 'ALVARO', 'MEJIA', '72.150.613', 'amejia@unidrogas.net.co', '', '3627587', '00617', '../../../sieunidrogas/gestion/documentos/20122014/SIERH0007_082509_11710676_Alvaro_G._Mejia_Payn.jpg', 904779),
(20, 'ELAINE', 'NIÃ‘O', '1.065.565.810', 'Jhoela202@hotmail.com', '', '5831617-3173187797', '00887', '../../../sieunidrogas/gestion/documentos/08102014/SIERH0007_092237_11710676_ELAINE_NIO_001.jpg', 1113466),
(21, 'MARLON ', 'SANCHEZ', '88.277.545', 'masver57@gmail.com', '', '5611444', '00964', '../../../sieunidrogas/gestion/documentos/14122015/SIERH0007_170008_11710676_marlom.jpg', 1800567),
(22, 'JORGE', 'MONTES', '1.082.942.967', 'jmontes1991@hotmail.com', '', '3013503772', '01457', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_172200_11710676_JORGE_VAN_MONTES_PEREZ.JPG', 11308224),
(23, 'RAFAEL', 'BELTRAN', '1.128.145.974', 'rafabelma@hotmail.com', '', '3135264394', '01677', '../../../sieunidrogas/gestion/documentos/01112014/SIERH0007_104637_11710676_RAFAEL_ENRIQUE_BELTRAN.jpg', 11785911),
(24, 'YEINER', 'SANCHEZ', '1.065.591.851', 'ysan.ser@gmail.com', '', '3016263505', '01873', '../../../sieunidrogas/gestion/documentos/22102014/SIERH0007_082756_11710676_foto_yeiner_sanchez.jpg', 11786107),
(25, 'NELSON', 'MIRANDA', '5.122.647', 'nelsonmirandamarimon@gmail.com', '', '3107046892', '02193', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_094308_11710676_NELSON_ROSENDO_MIRANDA_MARIMON.JPG', 11786427),
(26, 'YUDIS', 'QUINTERO', '36.722.607', 'yqv078@hotmail.com', '', '3166935578', '02194', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_174355_11710676_YUDIS_EMILSE_QUINTERO_VESGA.JPG', 11786428),
(27, 'CARLOS', 'SANCHEZ', '85.452.086', 'carlosanchez1403@hotmail.com', '', '3168347964', '02195', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_083457_11710676_CARLOS_SANCHEZ_CUEVAS.JPG', 11786429),
(28, 'JEFFREY', 'ROMERO', '74381592', 'jeffreyrojiz@hotmail.com', '', '3115679563', '02727', '../../../sieunidrogas/gestion/documentos/04062014/SIERH0007_151617_11710676_ROMERO_JIMENEZ_JEFREY.jpg', 11786961),
(29, 'MARCO', 'DEMOYA', '72159244', 'marcodemoya@hotmail.com', '', '3103099850', '02773', '../../../sieunidrogas/gestion/documentos/09102014/SIERH0007_083028_11710676_MARCO_DE_MOYA.png', 11787007),
(30, 'RUTH', 'BRAVO', '30.726.342', 'ruthbravo23@gmail.com', '', '3174995423', '05686', '../../../sieunidrogas/gestion/documentos/05112014/SIERH0007_181049_11710676_RUTH_BRAVO.jpg', 11787458),
(31, 'VERONICA', 'ORTEGA', '29.105.324', 'veronica.ortega@yahoo.com', '', '3147332399', '05746', '../../../sieunidrogas/gestion/documentos/13112014/SIERH0007_172539_11710676_veronica_ortega.jpg', 11787518),
(32, 'FABIAN', 'ALBOR', '8.639.206', 'fabianalbor@gmail.com', '', '3627587-3007501996', '06017', '../../../sieunidrogas/gestion/documentos/08042015/SIERH0007_113152_11710676_ALBOR_PACHECO.jpg', 11787789),
(33, 'DIANA', 'PALACIO', '43.920.293', 'dimipaso@gmail.com', '', '3148853103', '06350', '../../../sieunidrogas/gestion/documentos/24092015/SIERH0007_092612_11710676_43920293_Diana_Milena_Palacio_Soto.jpg', 11788122),
(34, 'EDER', 'HERNANDEZ', '71.330.319', 'ederhm0131@gmail.com', '', '3148912599', '06357', '../../../sieunidrogas/gestion/documentos/24092015/SIERH0007_091323_11710676_71330319_Eder_Rubilson_Hernandez_Marulanda.jpg', 11788129),
(35, 'JOSE', 'SOTO', '1.128.149.055', 'JSOTO9031@hotmail.com', '', '3145363655', '06491', '../../../sieunidrogas/gestion/documentos/28112015/SIERH0007_123706_11710676_JOSE_MIGUEL_SOTO.jpg', 11788263),
(36, 'JADER', 'PEREZ', '15.611.100', 'jaderperez69@hotmail.com', '', '3145971838', '06976', '../../../sieunidrogas/gestion/documentos/08082016/SIERH0007_162342_11777387_JAIDER_IVAN_PEREZ_MARTINEZ.jpg', 11788748),
(37, 'LUIS', 'TORRES', '12.563.589', 'DSBZONA3@YAHOO.ES', '', '3163085693-5590163', '08413', '../../../sieunidrogas/gestion/documentos/26042018/SIERH0007_085746_11778082_12563589_TORRES_LEON_LUIS_ALEJANDRO.jpg', 11790185);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `id_usuario_roles` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_api` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`id_usuario_roles`, `id_rol`, `id_usuario`, `estado`, `id_api`) VALUES
(1, 1, 1, 1, 265813),
(2, 1, 2, 1, 265820),
(3, 1, 3, 1, 265828),
(4, 1, 4, 1, 335694),
(5, 1, 5, 1, 336188),
(6, 1, 6, 1, 336499),
(7, 1, 7, 1, 348252),
(8, 1, 8, 1, 363101),
(9, 1, 9, 1, 363490),
(10, 1, 10, 1, 363755),
(11, 1, 11, 1, 443652),
(12, 1, 12, 1, 444531),
(13, 1, 13, 1, 447706),
(14, 1, 14, 1, 584225),
(15, 1, 15, 1, 834252),
(16, 1, 16, 1, 834634),
(17, 1, 17, 1, 835164),
(18, 1, 18, 1, 903697),
(19, 1, 19, 1, 904779),
(20, 1, 20, 1, 1113466),
(21, 1, 21, 1, 1800567),
(22, 1, 22, 1, 11308224),
(23, 1, 23, 1, 11785911),
(24, 1, 24, 1, 11786107),
(25, 1, 25, 1, 11786427),
(26, 1, 26, 1, 11786428),
(27, 1, 27, 1, 11786429),
(28, 1, 28, 1, 11786961),
(29, 1, 29, 1, 11787007),
(30, 1, 30, 1, 11787458),
(31, 1, 31, 1, 11787518),
(32, 1, 32, 1, 11787789),
(33, 1, 33, 1, 11788122),
(34, 1, 34, 1, 11788129),
(35, 1, 35, 1, 11788263),
(36, 1, 36, 1, 11788748),
(37, 1, 37, 1, 11790185);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id_zona` int(11) NOT NULL,
  `descripcion_zona` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_region` int(11) NOT NULL,
  `id_usuario_roles` int(11) NOT NULL,
  `id_api_zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id_zona`, `descripcion_zona`, `id_region`, `id_usuario_roles`, `id_api_zona`) VALUES
(1, 'SUPERV BMANGA CABECERA', 1, 1, 265458),
(2, 'SUPERV LLANOS', 4, 2, 318947),
(3, 'SUPERV BARRANCABERMEJA', 1, 3, 115385),
(4, 'SUPERV BOLIVAR SUR', 2, 4, 319001),
(5, 'SUPERV SOCORRO Y SAN GIL', 1, 5, 318944),
(6, 'SUPERV IBAGUE', 4, 6, 4550122),
(7, 'SUPERV BOGOTA 2', 4, 7, 4550131),
(8, 'SUPERV PEREIRA', 5, 8, 4550123),
(9, 'SUPERV NORTE DE SANTANDER', 1, 9, 318931),
(10, 'SUPERV ATLANTICO', 2, 10, 318992),
(11, 'SUPERV CESAR 2', 3, 11, 4550116),
(12, 'SUPERV CORDOBA 1', 2, 12, 319040),
(13, 'SUPERV BOLIVAR CENTRO Y POBLACIONES', 2, 13, 4550117),
(14, 'SUPERV BMANGA SUR', 1, 14, 265454),
(15, 'SUPERV SANTA MARTA FCION', 2, 15, 319055),
(16, 'SUPERV BOGOTA 1', 4, 16, 4550114),
(17, 'SUPERV BQUILLA CENTRO', 3, 17, 4549889),
(18, 'SUPERV SANTA MARTA ZONA 2', 3, 18, 4549929),
(19, 'SUPERV BQUILLA NORTE', 3, 19, 327780),
(20, 'SUPERV CESAR POBLAC', 3, 20, 4550103),
(21, 'SUPERV OCANA SUR CESAR', 1, 21, 4550130),
(22, 'SUPERV CORDOBA PROVINCIA', 2, 22, 4550129),
(23, 'SUPERV RIO MAGDALENA 2', 3, 23, 4550128),
(24, 'SUPERV RIO MAGDALENA 1', 3, 24, 4549956),
(25, 'SUPERV RIOHACHA', 3, 25, 4550113),
(26, 'SUPERV SANTA MARTA CIENAGA', 2, 26, 4550112),
(27, 'SUPERV SANTA MARTA ZONA 1', 2, 27, 4550111),
(28, 'SUPERV PEREIRA 2', 5, 28, 4550121),
(29, 'SUPERV BOLIVAR NORTE', 3, 29, 4549939),
(30, 'SUPERV NARINO', 4, 30, 4550125),
(31, 'SUPERV CALI', 5, 31, 4550124),
(32, 'SUPERV BQUILLA SUR', 3, 32, 4549905),
(33, 'SUPERV MEDELLIN SUR', 5, 33, 4550126),
(34, 'SUPERV MEDELLIN NORTE', 5, 34, 318972),
(35, 'SUPERV GUAJIRA POBLAC', 3, 35, 4550110),
(36, 'SUPERV CORDOBA 2', 3, 36, 4549948),
(37, 'SUPERV PROVINCIA BOGOTA', 4, 37, 4550120);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `apertura`
--
ALTER TABLE `apertura`
  ADD PRIMARY KEY (`id_apertura`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_relevancia` (`id_prioridad`);

--
-- Indices de la tabla `captura_cliente`
--
ALTER TABLE `captura_cliente`
  ADD PRIMARY KEY (`id_captura_cliente`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  ADD PRIMARY KEY (`id_condiciones`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `convenio_exhibicion`
--
ALTER TABLE `convenio_exhibicion`
  ADD PRIMARY KEY (`iid_convenio_exhibicion`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  ADD PRIMARY KEY (`id_cordinador`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `documentacion_legal`
--
ALTER TABLE `documentacion_legal`
  ADD PRIMARY KEY (`id_documentacion`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_relevancia` (`id_prioridad`);

--
-- Indices de la tabla `evaluacion_pedidos`
--
ALTER TABLE `evaluacion_pedidos`
  ADD PRIMARY KEY (`id_evaluacion_pedidos`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `excesos`
--
ALTER TABLE `excesos`
  ADD PRIMARY KEY (`id_excesos`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  ADD PRIMARY KEY (`id_formula`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `ingreso_sucursal`
--
ALTER TABLE `ingreso_sucursal`
  ADD PRIMARY KEY (`id_ingreso_sucursal`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `libros_faltantes`
--
ALTER TABLE `libros_faltantes`
  ADD PRIMARY KEY (`id_librofaltante`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `libro_agendaclientes`
--
ALTER TABLE `libro_agendaclientes`
  ADD PRIMARY KEY (`id_libro_agendaclientes`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `libro_vencimientos`
--
ALTER TABLE `libro_vencimientos`
  ADD PRIMARY KEY (`id_libro_vencimientos`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `papeleria_consignaciones`
--
ALTER TABLE `papeleria_consignaciones`
  ADD PRIMARY KEY (`id_papel_consignaciones`),
  ADD KEY `id_relevacia` (`id_prioridad`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `plan_trabajo_asignacion`
--
ALTER TABLE `plan_trabajo_asignacion`
  ADD PRIMARY KEY (`id_plan_trabajo`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_supervisor` (`id_supervisor`),
  ADD KEY `idcornidador` (`idcoordinador`);

--
-- Indices de la tabla `presupuesto_pedido`
--
ALTER TABLE `presupuesto_pedido`
  ADD PRIMARY KEY (`id_presupuesto_pedido`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`id_prioridad`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`),
  ADD KEY `id_cordinador` (`id_cordinador`);

--
-- Indices de la tabla `relevancia`
--
ALTER TABLE `relevancia`
  ADD PRIMARY KEY (`id_relevancia`),
  ADD KEY `id_prioridad` (`id_prioridad`),
  ADD KEY `id_frecuencia` (`id_frecuencia`);

--
-- Indices de la tabla `remisiones`
--
ALTER TABLE `remisiones`
  ADD PRIMARY KEY (`id_remision`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `revision_completa_inventarios`
--
ALTER TABLE `revision_completa_inventarios`
  ADD PRIMARY KEY (`id_revision`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `seguimiento_opciones`
--
ALTER TABLE `seguimiento_opciones`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `seguimiento_vendedores`
--
ALTER TABLE `seguimiento_vendedores`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`),
  ADD KEY `id_prioridad` (`id_prioridad`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_suscursal`),
  ADD KEY `id_zona` (`id_zona`);

--
-- Indices de la tabla `tabla_seguimiento_usuarios`
--
ALTER TABLE `tabla_seguimiento_usuarios`
  ADD PRIMARY KEY (`idseguimiento_registro`),
  ADD KEY `id_seguimiento_opciones` (`id_seguimiento_opciones`),
  ADD KEY `id_cordinadores` (`id_users`),
  ADD KEY `id_plan_trabajo` (`id_plan_trabajo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`id_usuario_roles`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id_zona`),
  ADD KEY `id_region` (`id_region`),
  ADD KEY `id_usuario_roles` (`id_usuario_roles`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `apertura`
--
ALTER TABLE `apertura`
  MODIFY `id_apertura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `captura_cliente`
--
ALTER TABLE `captura_cliente`
  MODIFY `id_captura_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  MODIFY `id_condiciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `convenio_exhibicion`
--
ALTER TABLE `convenio_exhibicion`
  MODIFY `iid_convenio_exhibicion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id_cordinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `documentacion_legal`
--
ALTER TABLE `documentacion_legal`
  MODIFY `id_documentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `evaluacion_pedidos`
--
ALTER TABLE `evaluacion_pedidos`
  MODIFY `id_evaluacion_pedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `excesos`
--
ALTER TABLE `excesos`
  MODIFY `id_excesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  MODIFY `id_formula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_sucursal`
--
ALTER TABLE `ingreso_sucursal`
  MODIFY `id_ingreso_sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros_faltantes`
--
ALTER TABLE `libros_faltantes`
  MODIFY `id_librofaltante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro_agendaclientes`
--
ALTER TABLE `libro_agendaclientes`
  MODIFY `id_libro_agendaclientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libro_vencimientos`
--
ALTER TABLE `libro_vencimientos`
  MODIFY `id_libro_vencimientos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `papeleria_consignaciones`
--
ALTER TABLE `papeleria_consignaciones`
  MODIFY `id_papel_consignaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_trabajo_asignacion`
--
ALTER TABLE `plan_trabajo_asignacion`
  MODIFY `id_plan_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT de la tabla `presupuesto_pedido`
--
ALTER TABLE `presupuesto_pedido`
  MODIFY `id_presupuesto_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `id_prioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `relevancia`
--
ALTER TABLE `relevancia`
  MODIFY `id_relevancia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `remisiones`
--
ALTER TABLE `remisiones`
  MODIFY `id_remision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `revision_completa_inventarios`
--
ALTER TABLE `revision_completa_inventarios`
  MODIFY `id_revision` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seguimiento_opciones`
--
ALTER TABLE `seguimiento_opciones`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimiento_vendedores`
--
ALTER TABLE `seguimiento_vendedores`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_suscursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- AUTO_INCREMENT de la tabla `tabla_seguimiento_usuarios`
--
ALTER TABLE `tabla_seguimiento_usuarios`
  MODIFY `idseguimiento_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  MODIFY `id_usuario_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `apertura`
--
ALTER TABLE `apertura`
  ADD CONSTRAINT `apertura_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `apertura_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `captura_cliente`
--
ALTER TABLE `captura_cliente`
  ADD CONSTRAINT `captura_cliente_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `captura_cliente_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  ADD CONSTRAINT `condiciones_locativas_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `condiciones_locativas_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `convenio_exhibicion`
--
ALTER TABLE `convenio_exhibicion`
  ADD CONSTRAINT `convenio_exhibicion_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `convenio_exhibicion_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `documentacion_legal`
--
ALTER TABLE `documentacion_legal`
  ADD CONSTRAINT `documentacion_legal_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `documentacion_legal_ibfk_3` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `evaluacion_pedidos`
--
ALTER TABLE `evaluacion_pedidos`
  ADD CONSTRAINT `evaluacion_pedidos_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `evaluacion_pedidos_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `excesos`
--
ALTER TABLE `excesos`
  ADD CONSTRAINT `excesos_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `excesos_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  ADD CONSTRAINT `formulas_despachos_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `formulas_despachos_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `ingreso_sucursal`
--
ALTER TABLE `ingreso_sucursal`
  ADD CONSTRAINT `ingreso_sucursal_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `ingreso_sucursal_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `kardex_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `libros_faltantes`
--
ALTER TABLE `libros_faltantes`
  ADD CONSTRAINT `libros_faltantes_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `libros_faltantes_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `libro_agendaclientes`
--
ALTER TABLE `libro_agendaclientes`
  ADD CONSTRAINT `libro_agendaclientes_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `libro_agendaclientes_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `libro_vencimientos`
--
ALTER TABLE `libro_vencimientos`
  ADD CONSTRAINT `libro_vencimientos_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `libro_vencimientos_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `papeleria_consignaciones`
--
ALTER TABLE `papeleria_consignaciones`
  ADD CONSTRAINT `papeleria_consignaciones_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `papeleria_consignaciones_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `plan_trabajo_asignacion`
--
ALTER TABLE `plan_trabajo_asignacion`
  ADD CONSTRAINT `plan_trabajo_asignacion_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_suscursal`),
  ADD CONSTRAINT `plan_trabajo_asignacion_ibfk_2` FOREIGN KEY (`id_supervisor`) REFERENCES `usuarios_roles` (`id_usuario_roles`),
  ADD CONSTRAINT `plan_trabajo_asignacion_ibfk_3` FOREIGN KEY (`idcoordinador`) REFERENCES `coordinadores` (`id_cordinador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuesto_pedido`
--
ALTER TABLE `presupuesto_pedido`
  ADD CONSTRAINT `presupuesto_pedido_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `presupuesto_pedido_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`id_cordinador`) REFERENCES `coordinadores` (`id_cordinador`);

--
-- Filtros para la tabla `remisiones`
--
ALTER TABLE `remisiones`
  ADD CONSTRAINT `remisiones_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `remisiones_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `revision_completa_inventarios`
--
ALTER TABLE `revision_completa_inventarios`
  ADD CONSTRAINT `revision_completa_inventarios_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `revision_completa_inventarios_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `seguimiento_vendedores`
--
ALTER TABLE `seguimiento_vendedores`
  ADD CONSTRAINT `seguimiento_vendedores_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `seguimiento_vendedores_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id_zona`);

--
-- Filtros para la tabla `tabla_seguimiento_usuarios`
--
ALTER TABLE `tabla_seguimiento_usuarios`
  ADD CONSTRAINT `tabla_seguimiento_usuarios_ibfk_1` FOREIGN KEY (`id_seguimiento_opciones`) REFERENCES `seguimiento_opciones` (`id_seguimiento`),
  ADD CONSTRAINT `tabla_seguimiento_usuarios_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tabla_seguimiento_usuarios_ibfk_3` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_roles`);

--
-- Filtros para la tabla `zona`
--
ALTER TABLE `zona`
  ADD CONSTRAINT `zona_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`),
  ADD CONSTRAINT `zona_ibfk_3` FOREIGN KEY (`id_usuario_roles`) REFERENCES `usuarios_roles` (`id_usuario_roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
