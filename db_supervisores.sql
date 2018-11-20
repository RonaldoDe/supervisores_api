-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2018 a las 21:56:35
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
(6, 2, 1, 'apertura', 'Apertura'),
(7, 2, 5, 'documentacion_legal', 'Documentacion Legal'),
(8, 2, 2, 'kardex', 'Kardex');

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

--
-- Volcado de datos para la tabla `condiciones_locativas`
--

INSERT INTO `condiciones_locativas` (`id_condiciones`, `id_plan_trabajo`, `id_prioridad`, `calificacion`, `fecha_inicio`, `fecha_fin`, `fecha_mod`, `observacion`, `calificacion_pv`, `estado`) VALUES
(1, 2, 1, NULL, '2018-11-08 00:00:00', '2018-12-09 00:00:00', NULL, '', NULL, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinadores`
--

CREATE TABLE `coordinadores` (
  `id_cordinador` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`id_cordinador`, `nombre`, `apellido`, `cedula`, `correo`, `password`, `telefono`, `asignado`) VALUES
(1, 'faby', 'freyte', 1140830054, 'ffreytte@gmail.com', '123456', 4536485, 1),
(2, 'jhonatan', 'cudris', 154541, 'jhona4@gmail.com', '123456', 54112, 1),
(3, 'max', 'lorduy', 145786214, 'max@gmail.com', '123456', 321456, 0);

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
(4, 2, 1, NULL, '2018-11-20 00:00:00', '2018-11-21 00:00:00', NULL, '', NULL, 'Activo');

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
('032cf017c54db30d8764f913d2377c1dc864696ab3375b84dca899dfda293d648f6223521041c291', 4, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:05:02', '2018-11-09 02:05:02', '2018-11-09 21:05:02'),
('05d82f1a8d0b7d258e41bf6c87a00acb9ace1b140401a21a2b56a7dffe99de51a973403516b949fd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:14:31', '2018-11-07 00:14:31', '2018-11-07 19:14:31'),
('0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 23:53:32', '2018-11-01 23:53:32', '2018-11-02 18:53:32'),
('0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:37:29', '2018-11-01 21:37:29', '2018-11-02 16:37:29'),
('0ad9365c341d9e68a021ffcd7244420a19c4a8ed187171b6bb231fe2044d6b2ff4cce29071d6e69e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:48:49', '2018-11-15 01:48:49', '2018-11-15 20:48:49'),
('0b315c61671ef2d9e30197f215e17d57496a0ebe911fc89c2e4cb16ae3137e5338360a53c9fe5777', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:25:37', '2018-11-14 03:25:37', '2018-11-14 22:25:37'),
('0f36417468931c16d37529f6228ccb6d3a7b3940563b53d946e1b1c2340621509c702a8d48d892b7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 02:12:46', '2018-11-14 02:12:46', '2018-11-14 21:12:46'),
('127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:08', '2018-11-01 21:59:08', '2018-11-02 16:59:08'),
('14e2c3dfdea2b974287d43bad96392b5db7eb725aa6badf32275b75a8c748a7069f3309343d75d8c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:22:30', '2018-11-15 02:22:30', '2018-11-15 21:22:30'),
('164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:11', '2018-11-01 20:24:11', '2018-11-02 15:24:11'),
('18a269572a9e484b010ad0c4d9a565d020be841be84dfac798b4e7dc2bca89eb60a2654a5d0a03f2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 21:55:11', '2018-11-15 21:55:11', '2018-11-16 16:55:10'),
('19a290bb7a78ce80a4bd95f2862c43f57357beeee4d2656bec0054c195b5bc56c73a37d0ed1b3ef7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:00:56', '2018-11-10 01:00:56', '2018-11-10 20:00:56'),
('1c138d7d27550c6ace5b52ab496a9f75b4f7706fcd5b74e36dce0eb3fa980bc6c2fd49ccdc9e2aa4', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:25:11', '2018-11-10 00:25:11', '2018-11-10 19:25:11'),
('1c8282bc5af92c8ccec2028b625f8760feb857d6c73b856dac1b5043f4fe2ea4c3ac2e8e5be24230', 5, 1, NULL, '[\"*\"]', 0, '2018-11-08 20:42:50', '2018-11-08 20:42:50', '2018-11-09 15:42:48'),
('1d6377af047073965ceccd43a765adbc7b299e705aea22a21e2f9ca0769346ef003506e8d7c08539', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 20:11:11', '2018-11-14 20:11:11', '2018-11-15 15:11:10'),
('1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:16', '2018-11-01 21:20:16', '2018-11-02 16:20:16'),
('26307e19863b5e7e0936a995609c0b80ed46f42b4f9b6a59389ce486f6836a248c2b4d46859e123b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 19:35:07', '2018-11-07 19:35:07', '2018-11-08 14:35:06'),
('2699d9dc01d7438b6c333205efdae42160d035560909a25b5e1fc433cd1bfabaa83d189eee0e5f66', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:33:57', '2018-11-07 00:33:57', '2018-11-07 19:33:57'),
('2c20d8b709616e3284a102be7aefe466db6e004c287fe3fff04a49ca77356f517fa240522afdb7d7', 18, 1, NULL, '[\"*\"]', 0, '2018-11-03 21:55:04', '2018-11-03 21:55:04', '2018-11-04 16:55:04'),
('2f0dbcd0a076c2033bd55eee71c08fa4112828600596b9dda8cac27d64d957fd0101638758ac2c58', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:18:24', '2018-11-15 02:18:24', '2018-11-15 21:18:24'),
('2ffcccf6d9cc1098c96e2d06b18446a54d308654a00d27e306b376fafc686b672153c52900989f58', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:16', '2018-11-15 01:47:16', '2018-11-15 20:47:16'),
('31cf0819eb33716c8567a3e9f30096d7be5357e0221687b228edee425e986be0909d3e548697dc26', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 03:20:22', '2018-11-03 03:20:22', '2018-11-03 22:20:20'),
('36c8f9fb52e49c1801ebb9d115ab45799066a4da41aa7894e157039022c8de80da31327b4b8a529b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:41:33', '2018-11-15 01:41:33', '2018-11-15 20:41:32'),
('3ace7d465e75573b58dcbfbeb311ad856aaad51ee12ea693f10e8cf7e4a14f90278da1a25fd9252e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:04:49', '2018-11-09 02:04:49', '2018-11-09 21:04:49'),
('3b41a83806a95514cfffa64448d8e235dbd2f53998ebba454bea0a540ed98e5fe6f3e7915c094247', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:35:50', '2018-11-07 00:35:50', '2018-11-07 19:35:50'),
('3c8e087ccfb8d3ea2716fa6a29bac6f6ae359ee2b5e366e7af56ea9fd4b7610a4809294ad8c19520', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 03:40:29', '2018-11-15 03:40:29', '2018-11-15 22:40:29'),
('3f94f536ae868d4973b63b8ed2918f313bba799532fcf79d8326b3726749fa49f4b235378db1be23', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:16:54', '2018-11-09 02:16:54', '2018-11-09 21:16:54'),
('413f31856afb63203627a5043282ba38362496de0a4a90149abc9d7f2f7e3dbe80e1b2baad2e2527', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:42:11', '2018-11-15 01:42:11', '2018-11-15 20:42:11'),
('417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:49', '2018-11-01 20:28:49', '2018-11-02 15:28:49'),
('4816787151f1c99658585232a1ca96cdd63bb324712f15c3bacc934ed35556daa02463935d779bfb', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:45:06', '2018-11-14 03:45:06', '2018-11-14 22:45:06'),
('48569dc830fc263ecf3de4fcdc9c247c64c50fdb8ae8d70b8f40272ccf07fe943d59bdf87ec471de', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:30:16', '2018-11-10 00:30:16', '2018-11-10 19:30:15'),
('49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:46', '2018-11-01 21:04:46', '2018-11-02 16:04:46'),
('4ad01dbfb164f5ddb8d30a99fb3769a82b540d456ca99589be1ea94f400619c6e2fd9458858f787a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:49:16', '2018-11-15 01:49:16', '2018-11-15 20:49:16'),
('4ba9b5a7fc580d5ab2b17a5b02257e2ef80945242ac19b8becd65eea1d570c13be2ade82a8aef35d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:00:36', '2018-11-15 02:00:36', '2018-11-15 21:00:36'),
('4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:11:21', '2018-11-01 21:11:21', '2018-11-02 16:11:21'),
('4da07451c6ba15fb6137dbc974fcd138f18cc0b812ea9b1c03d8ba01a85b2517507e4b4160a9db3f', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:43', '2018-11-15 01:46:43', '2018-11-15 20:46:43'),
('4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:05', '2018-11-01 21:20:05', '2018-11-02 16:20:05'),
('4fb701d22bb71c4822a1e95e4205c74c997b501fefbf65c08fc929dd66eeb1a6a779a7b8c62eea42', 5, 1, NULL, '[\"*\"]', 0, '2018-11-17 04:34:22', '2018-11-17 04:34:22', '2018-11-17 23:34:19'),
('508243a82af3dc011bea7e56b5a6024c1fb0957bfa791849b81e4832d3f51f5a0c7e80eb6bae5bad', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 00:59:40', '2018-11-02 00:59:40', '2018-11-02 19:59:39'),
('51f6a992a5ca6007541353badabcfc8412dabe153319cfa122574bd85e98a3aeb7143c469120e5f8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:03:57', '2018-11-09 02:03:57', '2018-11-09 21:03:53'),
('520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:00:34', '2018-11-01 21:00:34', '2018-11-02 16:00:34'),
('53b9e684b82c30db819e8a8a103651434f7b4e8a7785500b82668a7d07b6cb880870f850f0892667', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 01:05:35', '2018-11-02 01:05:35', '2018-11-02 20:05:35'),
('5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:30:22', '2018-11-01 20:30:22', '2018-11-02 15:30:22'),
('5ac03113ca656d1bb0b0ad7192d75dc97f6125412a679c28862d8edc1203c0d3e93e50fae5b15c20', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:43:25', '2018-11-15 01:43:25', '2018-11-15 20:43:25'),
('5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:56', '2018-11-01 21:04:56', '2018-11-02 16:04:56'),
('5d1aa2e4eb5ab82443e27768ff86c9fda15db9de5b7a601751ca07cedf2841cf4fb63ec46feb4cfd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:00:02', '2018-11-14 03:00:02', '2018-11-14 22:00:02'),
('5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:53:26', '2018-11-01 21:53:26', '2018-11-02 16:53:26'),
('5fb5e4dc7237f496be72f6c247c9ac02bb7249862d10f19ece2e9d4b140995dbe835b053d9c21f90', 5, 1, NULL, '[\"*\"]', 0, '2018-11-09 02:04:33', '2018-11-09 02:04:33', '2018-11-09 21:04:33'),
('648228a94fc3012b5cbd897ba906431302c020a8db82e5d26df400a36193b0b4fa6380e8ae4cb6b7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:55', '2018-11-15 01:59:55', '2018-11-15 20:59:55'),
('67f28138dc05f6de3c6838673a98c1293b60e537f04b688537fc9692444348b82d61ed4668f4468f', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:24:20', '2018-11-10 00:24:20', '2018-11-10 19:24:20'),
('6ade2824311df05226e5e55d86d6179e426773cab825a5b5bd0f64a931b776f5d710250e076a9f9b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:29', '2018-11-15 01:59:29', '2018-11-15 20:59:29'),
('6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:34', '2018-11-01 21:08:34', '2018-11-02 16:08:34'),
('73fd7a8dbb3f94aaa12498f400c1c5126f612b1e24924d79872fc282d8e4f7e824f524bfc3fe0641', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:11:34', '2018-11-10 00:11:34', '2018-11-10 19:11:33'),
('77854ca9424790506bcf6c7915a709310ccd4501565c3ca705d41cc3d0f135f47bb69e973266e493', 5, 1, NULL, '[\"*\"]', 0, '2018-11-06 20:40:21', '2018-11-06 20:40:21', '2018-11-07 15:40:16'),
('7862894de790726c5f930b97d34bb2ac875fbaad4b56bc6b1fdc566b0b88c275e8cd121aa98c7f8c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:23:57', '2018-11-14 03:23:57', '2018-11-14 22:23:57'),
('7ae121074eccbe7203bb0a4e9fe9094ce9e9ad682e6afd2fa0861e27de712880bdc3bae1e2731253', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:59:41', '2018-11-15 01:59:41', '2018-11-15 20:59:41'),
('7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:05', '2018-11-01 21:02:05', '2018-11-02 16:02:04'),
('83ed82aaae5d8d06bafc2aec94da3e756ed495c6288461243882a6f93ecdb25214f4362fb7d9d90b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 21:11:12', '2018-11-03 21:11:12', '2018-11-04 16:11:12'),
('856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:59:51', '2018-11-01 20:59:51', '2018-11-02 15:59:51'),
('85b6854c1c13287fa219e261862212e8524edde852cea75248fc470fa20ebf4d176b9bba648ccdb0', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 22:26:01', '2018-11-03 22:26:01', '2018-11-04 17:26:00'),
('89220362a98f77668b0e55a298f10722a95e2a1f09bdf83397b23b52503e1f1d1cb98696a11d20f5', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:51', '2018-11-15 01:47:51', '2018-11-15 20:47:51'),
('94fedcc688bbdcd5a402e00f1feb939ee05c36c05817989a80b2a2f918a9c3484e9a0d9a29518d96', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:13:58', '2018-11-07 00:13:58', '2018-11-07 19:13:58'),
('9a737066e293983d36e886a892f39644e632ad6c2263a18d4ea5c4fbd5576ba5b669528946258253', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:43:29', '2018-11-07 00:43:29', '2018-11-07 19:43:29'),
('a19dfccd8a6252f6cb8b67093857ec4e280eea6adfbb3b423a6eadf3e3948e6e93d32c8804731ea2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:22', '2018-11-15 01:46:22', '2018-11-15 20:46:22'),
('a2cbf5884cf0d3a0edb6d745d52096a38a63b95526d9cf108a19c99f2f0f573f835986d50f576f59', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:31:26', '2018-11-07 00:31:26', '2018-11-07 19:31:26'),
('a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:32', '2018-11-01 21:59:32', '2018-11-02 16:59:32'),
('a61685ee7aa364d16b790f41c9e6ecea51ed09b6df5a7e69cc4e029fadd59ae4732ed0ae4b6c2ca8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:08', '2018-11-15 01:46:08', '2018-11-15 20:46:08'),
('a997f49d9445ea92eec29f1172047a08ed8846d1b727daa2f4250bbd9b323a178c1789eba668b728', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 01:25:29', '2018-11-14 01:25:29', '2018-11-14 20:25:28'),
('aa283d5a97cedbde852ed1f6bda72495c55b02516de84d452a3be0702bc318cf7b8f7d92192e10cb', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 23:41:05', '2018-11-14 23:41:05', '2018-11-15 18:40:59'),
('b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:20:26', '2018-11-01 20:20:26', '2018-11-02 15:20:26'),
('b084930759576e49fd770b3920a4c83e5b684d15e0c79b1b75f46d5b80835c292133dd1f365eb59d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 03:32:56', '2018-11-14 03:32:56', '2018-11-14 22:32:56'),
('b1bd5df09ad853c1f0deb4c3733baf6e2c826e6ab1750e82fe7bd5303c900fe00d16a574c8e6c682', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 00:18:38', '2018-11-10 00:18:38', '2018-11-10 19:18:38'),
('b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:05:50', '2018-11-01 21:05:50', '2018-11-02 16:05:50'),
('b3f45e1a5830b95fbed42eb4acf56825d7f856ae8aaeb37372f1db7f37711fd4ad1b79ab9c88d723', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:12:19', '2018-11-14 19:12:19', '2018-11-15 14:12:14'),
('b5c59adbfd24a111790ab731795eade90d3e260f028be74e5fab29699f69af8db9c0e3f9ce49c0dd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:49:05', '2018-11-15 01:49:05', '2018-11-15 20:49:05'),
('b7c50f863849c6f2b6c3eec49013bf489b4de0d76a4bdd046195d2d625711cdfcbc4b9ab71858bc7', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:18:31', '2018-11-15 02:18:31', '2018-11-15 21:18:31'),
('b88bb94d31a89b2b891f63cd87b09f397a8c29702a222384afbc6b28f3195d4739971c40e8676c9c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:52:36', '2018-11-15 01:52:36', '2018-11-15 20:52:36'),
('ba5170d762930c9c8616ea3574833f0c8875858670a758518c1070a44a41109c680cf4197f620240', 35, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:32:51', '2018-11-15 01:32:51', '2018-11-15 20:32:46'),
('ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:37', '2018-11-01 21:02:37', '2018-11-02 16:02:37'),
('bc5b734c7582563f9a553b3c2d865861af3d1673977104ec1ea4cdc4abb6fe8c2d948f205cab2301', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:51:05', '2018-11-15 01:51:05', '2018-11-15 20:51:05'),
('bc9db1916f4a2ef77bf7d61b4eb755cc7cbd4a15e5bc9b3e4209485367858f4d7a2e3c6c23ebc4b8', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:06:15', '2018-11-10 01:06:15', '2018-11-10 20:06:15'),
('c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:56:08', '2018-11-01 20:56:08', '2018-11-02 15:56:01'),
('c45ae7198c3b7962147955938b4e50b4a209ebc3d971148ae878994cc157eebd56e4ccb14f561b57', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:33:38', '2018-11-07 00:33:38', '2018-11-07 19:33:38'),
('c7786bbd110ea330db7e004f5d883f08adf5b6e74ac0c7e7cbc86cb62d120088827ebc0abe13b8bf', 5, 1, NULL, '[\"*\"]', 0, '2018-11-03 20:10:18', '2018-11-03 20:10:18', '2018-11-04 15:10:15'),
('c7f8e2fb4344a31dcf31a8f393bf741d2c1a217e62b88f003a7d6c55899319270cf061a13823695a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:14:13', '2018-11-07 00:14:13', '2018-11-07 19:14:13'),
('c94a43b3faf6ad4f39de06e35ea1abb3f82408a44e3b50022e82453868b0b4e3a942c4e119380e31', 5, 1, NULL, '[\"*\"]', 0, '2018-11-13 22:40:12', '2018-11-13 22:40:12', '2018-11-14 17:40:11'),
('c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:26:03', '2018-11-01 20:26:03', '2018-11-02 15:26:03'),
('cc14da9269a01e228a582bbfdcad60e2c72dc6b9e82e18c1ee8cff30b27b60229e5aa2ab9e3e77dd', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:58:29', '2018-11-15 01:58:29', '2018-11-15 20:58:29'),
('ce3c3dd6056624558648c53d539112d8eb32dd527534d971952f8651446703a175096653b69a4c92', 29, 1, NULL, '[\"*\"]', 0, '2018-11-06 23:58:46', '2018-11-06 23:58:46', '2018-11-07 18:58:43'),
('d13f7deb11a75cd135c3871d6d911f7fd6ecdd0c62618444018960fd63e14e0a2efa683a94e6eb93', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:47:34', '2018-11-15 01:47:34', '2018-11-15 20:47:34'),
('d2935526316482c152e4587ff8133e411b97aa152d952922f21eab7641a9f4c9b9ce420e8ba64351', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:46:32', '2018-11-15 01:46:32', '2018-11-15 20:46:32'),
('d51c610d9a3792eff87a1341ae36ddab02a4c796e657a693689f70ebe648c97e7d4c223cf9cc6c07', 5, 1, NULL, '[\"*\"]', 0, '2018-11-02 20:49:25', '2018-11-02 20:49:25', '2018-11-03 15:49:23'),
('d5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:27', '2018-11-01 21:08:27', '2018-11-02 16:08:27'),
('dc04a737ce7169cb09c88d43f4598cca335b1c2ec06675e02e651a69f32f6205e2187b4c981dfc4e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 02:13:22', '2018-11-14 02:13:22', '2018-11-14 21:13:22'),
('e560c1038789c555c815afc43c7d321aca2428faada47e9eb8095dba20976cf00e959320bccbf640', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:12:49', '2018-11-14 19:12:49', '2018-11-15 14:12:49'),
('e971ce64e958a4b515474c8b764ec4014fec2f0b851967eb0c621a393f1d467dbc7af4dd4c299755', 5, 1, NULL, '[\"*\"]', 0, '2018-11-07 19:35:19', '2018-11-07 19:35:19', '2018-11-08 14:35:19'),
('ea4030b0e4434652e20c510d8d8bd1efde4f26b017a4ef4baf47e7e8c0b3db09e059fd12971249de', 35, 1, NULL, '[\"*\"]', 0, '2018-11-14 21:59:11', '2018-11-14 21:59:11', '2018-11-15 16:59:09'),
('ea8f5d94f3dbd9e53a1254bc18e05ceda0aa24cd96c81ab991be74e2e23a20ec61597c3dc787db9b', 4, 1, NULL, '[\"*\"]', 0, '2018-11-07 00:34:17', '2018-11-07 00:34:17', '2018-11-07 19:34:17'),
('edb454f6a2b5d8cf1d8c90ae943c4f029ecc0cd47bf854caab3388c16314bf471877537b7262c605', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 02:01:42', '2018-11-15 02:01:42', '2018-11-15 21:01:42'),
('edfc94577fba9d4a52e91cfeced7ceaf63b8060dad62f97547b174b3ce486a2fa865fc5d503d96c9', 35, 1, NULL, '[\"*\"]', 0, '2018-11-14 22:10:15', '2018-11-14 22:10:15', '2018-11-15 17:10:14'),
('efab4b13a5f40600bf81f4d8f096d2422977703a90a455461c2cd916d54e6a03f66a71af0183f4be', 18, 1, NULL, '[\"*\"]', 0, '2018-11-03 20:58:23', '2018-11-03 20:58:23', '2018-11-04 15:58:21'),
('f276fb0f6edb1158535133598ebedf76cea2bc1ace12c4f71499a27c54cb9eb8b630e8cb84668e0c', 5, 1, NULL, '[\"*\"]', 0, '2018-11-14 19:16:06', '2018-11-14 19:16:06', '2018-11-15 14:16:05'),
('f94e50b41b5bab08a7671bf8ea403c72e6dab0c5be9b2fb88ba99056cc409c7c567830f3e9e0d871', 5, 1, NULL, '[\"*\"]', 0, '2018-11-15 01:50:02', '2018-11-15 01:50:02', '2018-11-15 20:50:02'),
('f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:35', '2018-11-01 20:28:35', '2018-11-02 15:28:34'),
('fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:20', '2018-11-01 20:24:20', '2018-11-02 15:24:20'),
('fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:25:48', '2018-11-01 20:25:48', '2018-11-02 15:25:48'),
('fce23485fef1971e9b07c16eff2eb47bdec66319fe423d6541383e3e74a0969b4536dc890bfef6ae', 5, 1, NULL, '[\"*\"]', 0, '2018-11-10 01:00:56', '2018-11-10 01:00:56', '2018-11-10 20:00:53');

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
('01a746acf1b42cbfac3ad84e4837b9713f4791d97cd588ef52816fc8caee9f9846234c6e46bb47fa', '508243a82af3dc011bea7e56b5a6024c1fb0957bfa791849b81e4832d3f51f5a0c7e80eb6bae5bad', 0, '2018-12-01 19:59:39'),
('02879985f8da1907325b8fd50791f4c3800758d527bc426f3f2879c2250fb964116a83e8cccc78c7', '1c138d7d27550c6ace5b52ab496a9f75b4f7706fcd5b74e36dce0eb3fa980bc6c2fd49ccdc9e2aa4', 0, '2018-12-09 19:25:11'),
('078150626af4c3d7a4dbac1f631c4d37d9ebe6d4340a334584b4fcb9cedd10f7936d23db82230a0e', '4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 0, '2018-12-01 16:20:05'),
('08a106a849f9b1032c936a3eec73c81b788567b1e9649895d9ef4fd10d7fb7f72f956d266c587b8f', '856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 0, '2018-12-01 15:59:51'),
('09e990d37c091cf68c04e1de53d4c680fa8b8a54add0e6cf0d11cd7c4be83a734ba5966afaf1d748', '5fb5e4dc7237f496be72f6c247c9ac02bb7249862d10f19ece2e9d4b140995dbe835b053d9c21f90', 0, '2018-12-08 21:04:33'),
('0a396d6c9d5e50022340bff6546a39463e3827e5e690e7616831d7ac1bae25f6e571fa69d2b566e5', '1d6377af047073965ceccd43a765adbc7b299e705aea22a21e2f9ca0769346ef003506e8d7c08539', 0, '2018-12-14 15:11:11'),
('0f517964a0e850547eb665d0e0e4f81175217494d4cb51e7e5fed876c9ef385d29653b0584b4876b', 'b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 0, '2018-12-01 16:05:50'),
('0f844d7ce394e9ce2c8e1849dac16094d888ac455489a1ba99220d1a362c1dc5021756e22788d874', 'cc14da9269a01e228a582bbfdcad60e2c72dc6b9e82e18c1ee8cff30b27b60229e5aa2ab9e3e77dd', 0, '2018-12-14 20:58:29'),
('119c43c6324c50364a7851aa108552f0da0a680fa328413bffbf7e8e97218306d17ef5d12fca0244', 'edb454f6a2b5d8cf1d8c90ae943c4f029ecc0cd47bf854caab3388c16314bf471877537b7262c605', 0, '2018-12-14 21:01:42'),
('154a5b9fb13ca35bbc8f871220b8642e028a7a3ab1f78419ac27a36289ee1df1d2eff4c7715849a8', '36c8f9fb52e49c1801ebb9d115ab45799066a4da41aa7894e157039022c8de80da31327b4b8a529b', 0, '2018-12-14 20:41:33'),
('17cf77d6ace0a0411c49043ad2ebaa80bf7df998f6c7756c9763885683cdf544aade1747918d23cb', '3f94f536ae868d4973b63b8ed2918f313bba799532fcf79d8326b3726749fa49f4b235378db1be23', 0, '2018-12-08 21:16:54'),
('1814f73ab8b153dd8e5a70d5b8404718172db290b7bf7f3c89ae2d1cdd29f33bc608f6dd4ea4fab3', '53b9e684b82c30db819e8a8a103651434f7b4e8a7785500b82668a7d07b6cb880870f850f0892667', 0, '2018-12-01 20:05:35'),
('18b82cbbc26067f97f756d604af1e69d52e85d5503f0e4697368b1d399479f3e0506db4f27cae66f', '5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 0, '2018-12-01 16:04:56'),
('1bf87b4b6511a8a7b371c816a4b505699ac2d64d3dcf08a0cba05c92ce9f6d3122e5c807c5f45756', 'bc9db1916f4a2ef77bf7d61b4eb755cc7cbd4a15e5bc9b3e4209485367858f4d7a2e3c6c23ebc4b8', 0, '2018-12-09 20:06:15'),
('1c329ea5b4c02345151dcf54dfb5e62a4abf7b27e4856eca3bf686c1221c2b23192334de32853e0b', 'c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 0, '2018-12-01 15:26:03'),
('22f97429fcde116728c1b18ad90ce24d137586789b95c010ab8bea2aa37a3918fb19350c949ebaf7', '2699d9dc01d7438b6c333205efdae42160d035560909a25b5e1fc433cd1bfabaa83d189eee0e5f66', 0, '2018-12-06 19:33:57'),
('28466b97378c472e987d6aa1e8bc7e86b89b8fbb9716eb13ec5c84b4200d2a8abcf50fbaf323c25c', 'ea8f5d94f3dbd9e53a1254bc18e05ceda0aa24cd96c81ab991be74e2e23a20ec61597c3dc787db9b', 0, '2018-12-06 19:34:17'),
('2b1c79a33e59bb569dab8d60f267c5542f6cfc41dd536c54e29cd19af06d89b1beeb031db7a9337b', '5d1aa2e4eb5ab82443e27768ff86c9fda15db9de5b7a601751ca07cedf2841cf4fb63ec46feb4cfd', 0, '2018-12-13 22:00:02'),
('2c112fb11d74a5ead08635726a2e5ce7f6c1d4350992ebe69e62a11cfcbf3ac963c33b355b7d52e4', 'b7c50f863849c6f2b6c3eec49013bf489b4de0d76a4bdd046195d2d625711cdfcbc4b9ab71858bc7', 0, '2018-12-14 21:18:31'),
('2f8de5c5353fd23fd27d36bc01032ec07796f8a7ebb524976d92e2eddbfcac80c092bc491ff47756', '7ae121074eccbe7203bb0a4e9fe9094ce9e9ad682e6afd2fa0861e27de712880bdc3bae1e2731253', 0, '2018-12-14 20:59:41'),
('31f6a0dc9119f1497a07227101e0c421cc1842c1e152da9931023693c7501de933e1259257cbbf78', '2ffcccf6d9cc1098c96e2d06b18446a54d308654a00d27e306b376fafc686b672153c52900989f58', 0, '2018-12-14 20:47:16'),
('32c76d7b38445892e6405acc5434f4bfc337ef015aa133fcbe4dfc348a15333419c6dc61d32f8342', '0ad9365c341d9e68a021ffcd7244420a19c4a8ed187171b6bb231fe2044d6b2ff4cce29071d6e69e', 0, '2018-12-14 20:48:49'),
('33ac79a542d012b89b7fc9a00e9374927005296fd57a44e334afa5a4bdf75eed13fcf46ad5306d94', 'fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 0, '2018-12-01 15:24:20'),
('342548af9438db13a6708e8812da6e9a6c624966d42868dc2a7d2731ca8e390d45111015fe47aca9', '26307e19863b5e7e0936a995609c0b80ed46f42b4f9b6a59389ce486f6836a248c2b4d46859e123b', 0, '2018-12-07 14:35:06'),
('3826f599940e062a21be6107c37e00e41091749c075da159fcf4dae3262b2b29a5ff48819d21e892', 'c45ae7198c3b7962147955938b4e50b4a209ebc3d971148ae878994cc157eebd56e4ccb14f561b57', 0, '2018-12-06 19:33:38'),
('396e5377cc8a1d69bf4dafc1a695758c846cba1ccec7bd9de9ae05a02960bd394de464c38fce5d05', 'b5c59adbfd24a111790ab731795eade90d3e260f028be74e5fab29699f69af8db9c0e3f9ce49c0dd', 0, '2018-12-14 20:49:05'),
('3b31ab1f665f7a418811556899a509060839cf9c714e63870a146f106799a58ba530c5b4c46d61c1', 'a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 0, '2018-12-01 16:59:32'),
('42102311f2766556df838f9f722b8da86a525b1d0c130574bb1930facc59501fa500356d5351ed98', '89220362a98f77668b0e55a298f10722a95e2a1f09bdf83397b23b52503e1f1d1cb98696a11d20f5', 0, '2018-12-14 20:47:51'),
('42fd3314a998c822bfe04907dc9f5e85f2f4c092d8c1cd24c963bc89fd42cd624bc8fb44cac5a25e', '127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 0, '2018-12-01 16:59:08'),
('44f3531ff880e2b70810d1a38379a4e1e5fb7fa691daa9ef344bc34848fe9dcbfc7e0d8713b1b1b9', 'd5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 0, '2018-12-01 16:08:27'),
('47ed6ff2ddc702114420e00613405be0c6045099abc94f4597529d0ee691bf0721e140adcc7c4d8d', 'dc04a737ce7169cb09c88d43f4598cca335b1c2ec06675e02e651a69f32f6205e2187b4c981dfc4e', 0, '2018-12-13 21:13:22'),
('48caad7a75c235808bbe873ab230451643815f8c1a66356be1d31174d3230c910480f0add9e1e2d8', 'edfc94577fba9d4a52e91cfeced7ceaf63b8060dad62f97547b174b3ce486a2fa865fc5d503d96c9', 0, '2018-12-14 17:10:14'),
('4920f67c7587c378c1270134ae7978bfbb9a5f8bc757c6b98ba0a1d69d8598c1967dac713198cd14', '7862894de790726c5f930b97d34bb2ac875fbaad4b56bc6b1fdc566b0b88c275e8cd121aa98c7f8c', 0, '2018-12-13 22:23:57'),
('49588a56c2017d60a398e2a515621caac739c80dd6c4933461fd0522dd5c22f5f74a892f840fadfe', 'c7f8e2fb4344a31dcf31a8f393bf741d2c1a217e62b88f003a7d6c55899319270cf061a13823695a', 0, '2018-12-06 19:14:13'),
('4aa90c5198c9ebdf77f2ef8d29e1bdaf384c3060897bec09389832b94b499e3b2173ec7cdb39d7ac', '1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 0, '2018-12-01 16:20:16'),
('4b4f0541097a10a555968e88aaa1f813f629fd3de06a65d8ad7e59060b232f0c96fa7eb2b85f1ede', '0b315c61671ef2d9e30197f215e17d57496a0ebe911fc89c2e4cb16ae3137e5338360a53c9fe5777', 0, '2018-12-13 22:25:37'),
('4c4e86bd36e046c8a864d521519c355535e788d0b4feec00c76395e1fd379c8a25f488cde3ebc555', '0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 0, '2018-12-01 16:37:29'),
('4ccc9da27645dd5845bc66f6e61e6abcc93c9098c369f759804b77b412d719df164c6565f3509e0b', '0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 0, '2018-12-01 18:53:32'),
('4e209e21defe205810df24213ca4e8371abc140fb1a9d8683163680ad58bbcbf099825556f7f1fd2', '94fedcc688bbdcd5a402e00f1feb939ee05c36c05817989a80b2a2f918a9c3484e9a0d9a29518d96', 0, '2018-12-06 19:13:58'),
('4eec5afeb39de77fc3e4b1b1b5606b1243ea6046d661aee7ce2ffd6f0b945be78da1f3601be48e92', '413f31856afb63203627a5043282ba38362496de0a4a90149abc9d7f2f7e3dbe80e1b2baad2e2527', 0, '2018-12-14 20:42:11'),
('4f17fedaaba842e920318961d78348628958559aefc1980f75bb27032e5e2c7bf3bf253cc91090da', '67f28138dc05f6de3c6838673a98c1293b60e537f04b688537fc9692444348b82d61ed4668f4468f', 0, '2018-12-09 19:24:20'),
('4f5d311d50a35bc5566b290b56c94c83aec4ebae1fb132f67d5003dccfa0f8f22fee016dd397c1c6', 'd51c610d9a3792eff87a1341ae36ddab02a4c796e657a693689f70ebe648c97e7d4c223cf9cc6c07', 0, '2018-12-02 15:49:23'),
('4ff46b61976f7d48e77524e95befaf11b009eff19d014173a6d4754af43dc9d97f04761683592468', '3c8e087ccfb8d3ea2716fa6a29bac6f6ae359ee2b5e366e7af56ea9fd4b7610a4809294ad8c19520', 0, '2018-12-14 22:40:29'),
('511918d540ea416f173a247b1c08610755a2a369977d82f1da7b1218e93f11b3adec30ab4ed9f403', '2c20d8b709616e3284a102be7aefe466db6e004c287fe3fff04a49ca77356f517fa240522afdb7d7', 0, '2018-12-03 16:55:04'),
('542e8faccd797c1fa6eff4e69bd0571afba23d8e574e7d1c5c9d67bb1e3a4f4c70a8c5216f82304c', '3ace7d465e75573b58dcbfbeb311ad856aaad51ee12ea693f10e8cf7e4a14f90278da1a25fd9252e', 0, '2018-12-08 21:04:49'),
('5580278901dd010ab1e394247b6f57d2687739812e54729e5b094fef1108bc1f34d83b175294bd7d', '6ade2824311df05226e5e55d86d6179e426773cab825a5b5bd0f64a931b776f5d710250e076a9f9b', 0, '2018-12-14 20:59:29'),
('5d7dc068398bbdd44cd5fc6332b39cd79491419cf0f008090095212f966c387f755321b4cb5892ed', '7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 0, '2018-12-01 16:02:05'),
('5f6d7755dd12fd757e0dc52dc1295b5789aa38bfd81f6596331dc1cd4c9df96ca9520d13d7842fbb', 'a997f49d9445ea92eec29f1172047a08ed8846d1b727daa2f4250bbd9b323a178c1789eba668b728', 0, '2018-12-13 20:25:28'),
('5f97fe8302985b2eaccca6b25998a32a09d9cb47a62093c2d2040b97762f0013a304987ca27b48aa', '5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 0, '2018-12-01 15:30:22'),
('61f58a456bc36da48ffb4e70ce615585989e68db851bfa76b8405464074c472ac94204df6275e3e2', '31cf0819eb33716c8567a3e9f30096d7be5357e0221687b228edee425e986be0909d3e548697dc26', 0, '2018-12-02 22:20:20'),
('625cda1540118f1f817c6c5d70723089f0543475c75214142e6babc62fb119fb37f16550a04c4e5e', 'fce23485fef1971e9b07c16eff2eb47bdec66319fe423d6541383e3e74a0969b4536dc890bfef6ae', 0, '2018-12-09 20:00:53'),
('627cd7507a5b429266cf22e91026c5dcaf5f1d63051f9be1af0fc33e35016c14e79356ec38fd6552', '4fb701d22bb71c4822a1e95e4205c74c997b501fefbf65c08fc929dd66eeb1a6a779a7b8c62eea42', 0, '2018-12-16 23:34:19'),
('652ad6af52b4b45532126b2ab476d153e9a24b6016e28e260a0c7bca03d2ec25cdf248d2cc360fef', 'aa283d5a97cedbde852ed1f6bda72495c55b02516de84d452a3be0702bc318cf7b8f7d92192e10cb', 0, '2018-12-14 18:40:59'),
('656198c996600fa21b850388f88714145e96a8730b2431784f7d81ce3407400fb6141c0657dd08c2', '14e2c3dfdea2b974287d43bad96392b5db7eb725aa6badf32275b75a8c748a7069f3309343d75d8c', 0, '2018-12-14 21:22:30'),
('65bc79946d6f1d916fb1e35db9e1b9aa4b24dc40bfd10540363b346ce028be1cc8f6d585cd6b4f5f', '1c8282bc5af92c8ccec2028b625f8760feb857d6c73b856dac1b5043f4fe2ea4c3ac2e8e5be24230', 0, '2018-12-08 15:42:48'),
('65eb3211da38b85f0daa4079a661e5cfa335a6d0f02b07c8b89b1e61a6555d944dc819682f603c68', 'b1bd5df09ad853c1f0deb4c3733baf6e2c826e6ab1750e82fe7bd5303c900fe00d16a574c8e6c682', 0, '2018-12-09 19:18:38'),
('66837432f07f424d87776bbd71a99bd54cb477024c8811a5b1d742ed2c3d46a068b7d08da9a732b8', '417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 0, '2018-12-01 15:28:49'),
('66da545c23077b809dd82bffec15da5e2943194125b6ec8d82fe05f26999b67ca625c622384796e5', 'd13f7deb11a75cd135c3871d6d911f7fd6ecdd0c62618444018960fd63e14e0a2efa683a94e6eb93', 0, '2018-12-14 20:47:34'),
('66f7e90ab6c11c3001b40a48865586a3db0c68907cdef5244d9769b4e0eb298bc78df9cf6c62f5cc', '83ed82aaae5d8d06bafc2aec94da3e756ed495c6288461243882a6f93ecdb25214f4362fb7d9d90b', 0, '2018-12-03 16:11:12'),
('6911cb3125ab3944eaf10b8966dd55f9461b58415eb7762c9686747350f5d5cfd5c4041eb2fa379f', 'a61685ee7aa364d16b790f41c9e6ecea51ed09b6df5a7e69cc4e029fadd59ae4732ed0ae4b6c2ca8', 0, '2018-12-14 20:46:08'),
('6d97041eb0820481256631630ffc28be54dc27bb3f8cbad0f4c772aea2ac72ade1842109a15b5203', '4ad01dbfb164f5ddb8d30a99fb3769a82b540d456ca99589be1ea94f400619c6e2fd9458858f787a', 0, '2018-12-14 20:49:16'),
('6ea9997361b6e93862738a74f9f1b9558d75943d38c5c4f827195210f9d976fe9775df0a45467ea7', 'f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 0, '2018-12-01 15:28:34'),
('7332e104d3ffe04ea6e989bfc61a9339a5ea81de4892d9968219c4b0d83f40be440517200fe5d1ed', 'a19dfccd8a6252f6cb8b67093857ec4e280eea6adfbb3b423a6eadf3e3948e6e93d32c8804731ea2', 0, '2018-12-14 20:46:22'),
('770721600ef206e7a69297619e39832a0305ffb1d7ce981d403bef418dc36322b79cd439ecccb113', '4ba9b5a7fc580d5ab2b17a5b02257e2ef80945242ac19b8becd65eea1d570c13be2ade82a8aef35d', 0, '2018-12-14 21:00:36'),
('7770f2c903268059c83805c978f6e02a6cc0eae98a417670cf672c1ceb8317ed4dd617508dafe4b7', '520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 0, '2018-12-01 16:00:35'),
('78ccc24b92abf40c4cafe84c26d276c8f8679237ca4589fa01a2cd8e549ea7016f568910ae3addc5', '77854ca9424790506bcf6c7915a709310ccd4501565c3ca705d41cc3d0f135f47bb69e973266e493', 0, '2018-12-06 15:40:17'),
('790024aee90972dc1753d45e5cbdbf0659fa89023a6e559e1fcf3375f69d7a258beb80106dda80c0', '4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 0, '2018-12-01 16:11:21'),
('7f8c2835f6a47b02c3f1316d3542f93aa14f68f92f20f7ef756e0109e780aaf86397cbedfd548822', '001b3461e4738c0ee44df40f6e9482b3e71cd0a73c44dcf33ee5a4e66dd6527859cb672c32129c79', 0, '2018-12-01 16:00:20'),
('803603e72c291380ac75ba2096f49bd16123c38c64799387f92a595d1dc65ecbdc0bf361e22577e1', '0f36417468931c16d37529f6228ccb6d3a7b3940563b53d946e1b1c2340621509c702a8d48d892b7', 0, '2018-12-13 21:12:46'),
('819fcd84c73f6bc8d04e3b0b2a8483f88e798d7e8abe5a40f0d6393ba6955a0339feee3b8421b5f9', '51f6a992a5ca6007541353badabcfc8412dabe153319cfa122574bd85e98a3aeb7143c469120e5f8', 0, '2018-12-08 21:03:54'),
('894acff897c0e8ddd8c0a4d036ebd4642e961b6b02ad584eaa23f77a7eb0bafe2db48c0b8be365eb', '032cf017c54db30d8764f913d2377c1dc864696ab3375b84dca899dfda293d648f6223521041c291', 0, '2018-12-08 21:05:02'),
('9000c3d89370c10a5290a6abbf6a11c494d72116b873e3f74dd344986c0cbea2fee6258222d19d4f', 'c7786bbd110ea330db7e004f5d883f08adf5b6e74ac0c7e7cbc86cb62d120088827ebc0abe13b8bf', 0, '2018-12-03 15:10:15'),
('91e1bdb31ee0107fc91b520a26bd409a9f1947a02bba0ab0e0fc2d98facd3d25b84b4d4526397da3', 'a2cbf5884cf0d3a0edb6d745d52096a38a63b95526d9cf108a19c99f2f0f573f835986d50f576f59', 0, '2018-12-06 19:31:26'),
('94bdc3e8b36826c9207113dbaae0e8c893b5496cfbd3f8f5899b5679155e7e2696d9bd2ea01e28f9', '164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 0, '2018-12-01 15:24:11'),
('97470f21dd14cd35bc2c7ed7a3d3bbb9f33207ef0d1acef529c13378e3f8b6da68a7f2176ff370b5', 'ea4030b0e4434652e20c510d8d8bd1efde4f26b017a4ef4baf47e7e8c0b3db09e059fd12971249de', 0, '2018-12-14 16:59:09'),
('9c3279396776d349cf4894371280bdead9d0f9b185370e8708dd8a04e75e082538fe39051b022f62', 'f276fb0f6edb1158535133598ebedf76cea2bc1ace12c4f71499a27c54cb9eb8b630e8cb84668e0c', 0, '2018-12-14 14:16:07'),
('9ea927d4cdb79aa0ccc465333f41c382ccfc95ef9e761e29801f6f74bcd0f6f9ab610cb073955632', 'f94e50b41b5bab08a7671bf8ea403c72e6dab0c5be9b2fb88ba99056cc409c7c567830f3e9e0d871', 0, '2018-12-14 20:50:02'),
('a0c017c062925348a5939a2a7204a7fd76adee2bd228b9f5a4937054c284f8889aa66fc6f27a33a7', '85b6854c1c13287fa219e261862212e8524edde852cea75248fc470fa20ebf4d176b9bba648ccdb0', 0, '2018-12-03 17:26:00'),
('a255498beb560ba3fb16e64533b9a2df10c20a807f2e358b7da470ea7a92539dbdc158d7afccfc13', '18a269572a9e484b010ad0c4d9a565d020be841be84dfac798b4e7dc2bca89eb60a2654a5d0a03f2', 0, '2018-12-15 16:55:10'),
('a2ee8269c63b619851e44c19fd477bb9ed0bcd86d20dd00731cd1991d53f9a9186d1ef96c65fec43', 'ba5170d762930c9c8616ea3574833f0c8875858670a758518c1070a44a41109c680cf4197f620240', 0, '2018-12-14 20:32:46'),
('a37f62c1471573eadcf22f5c8f251b4e18a555a0d2844c03b169246e9e36993c8efc03d0f9cf027c', '48569dc830fc263ecf3de4fcdc9c247c64c50fdb8ae8d70b8f40272ccf07fe943d59bdf87ec471de', 0, '2018-12-09 19:30:16'),
('a6c2e74e4b1bc940c65c4b42af1d36af084edcecf9275521d287ce6a59738483e55baba975ee300a', '4da07451c6ba15fb6137dbc974fcd138f18cc0b812ea9b1c03d8ba01a85b2517507e4b4160a9db3f', 0, '2018-12-14 20:46:43'),
('a7fd9592529a6a2bed40b8ef8dfcfda8c867c4d317de4a3339fca9e1eebd3857eeff5a1cf3983fab', '011e2ad30c5253c721ee0b8b0686cbdd0aa2ccdf701a175c30647d93a96732a8f62e98b7b901ab56', 0, '2018-12-09 19:26:20'),
('a800463679a580f739fbfab8941281ca2fe1342067a83b83e312292d1b1648d0660b2885b8248e99', '6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 0, '2018-12-01 16:08:34'),
('aa24d98c5fd9555be93e216f173536203f7b3239ed1be1afa45a01f553961f32a44f93629ac62012', 'ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 0, '2018-12-01 16:02:37'),
('ac82ad31f5d8b1b0028d724fd2304d8c1b1b1407a796de5a9b999e701df11fb75fc4a237ef156423', '3b41a83806a95514cfffa64448d8e235dbd2f53998ebba454bea0a540ed98e5fe6f3e7915c094247', 0, '2018-12-06 19:35:50'),
('b0f46ea2523d46a95a1b8d086b2157ffd098581ef01af57d1c7635355d4dcb3c013e7de6cc194d18', '19a290bb7a78ce80a4bd95f2862c43f57357beeee4d2656bec0054c195b5bc56c73a37d0ed1b3ef7', 0, '2018-12-09 20:00:56'),
('b24cd0f1d7ede9bcd9a094d775bb68073fcc07b9921615ebd118d9167e493fa225c3560f6904068b', 'b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 0, '2018-12-01 15:20:26'),
('b4d597471b7e15535917741ede6e5fd216201a3d343589bf920a9afe9e02ca0e78425ae12a4a3552', 'b3f45e1a5830b95fbed42eb4acf56825d7f856ae8aaeb37372f1db7f37711fd4ad1b79ab9c88d723', 0, '2018-12-14 14:12:15'),
('b6252616b57f4af56808935ca1536c2e60a11a3b9a92b26f84959428457b24d4118d16e8487344aa', 'c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 0, '2018-12-01 15:56:02'),
('b6f5d326049418b72e24fa96539ada01728d08a7bc266c0733076898e51875b2191a4d6f6c4015c4', '05d82f1a8d0b7d258e41bf6c87a00acb9ace1b140401a21a2b56a7dffe99de51a973403516b949fd', 0, '2018-12-06 19:14:31'),
('bd2be637297d4246163f76c6894861c209dfe11af7ae2833ba7a7b4afe0e73bd5cfef0286259f335', 'efab4b13a5f40600bf81f4d8f096d2422977703a90a455461c2cd916d54e6a03f66a71af0183f4be', 0, '2018-12-03 15:58:21'),
('bf1f68ce09465fb89c28ba4b99fbc4ca97be242b98cdaa0f404d8602284c7a8afb23fad0774e2d82', '9a737066e293983d36e886a892f39644e632ad6c2263a18d4ea5c4fbd5576ba5b669528946258253', 0, '2018-12-06 19:43:29'),
('c0b780481adf6aae83c8e6dd468fd8434c8446d24b892334008a39e79ed0e8ba316d1b10ba66a5cb', 'fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 0, '2018-12-01 15:25:48'),
('c5a60fcdb42b8af6db4d2df4246018523f2d77624b89a2f440205fcdf095cc3559a83ade65ea9bd8', 'ce3c3dd6056624558648c53d539112d8eb32dd527534d971952f8651446703a175096653b69a4c92', 0, '2018-12-06 18:58:43'),
('d0c5e28ca7b88b969c7317433a32dfc077e9b6611965e74c7cc3cac982c303308c7dd6d674d2438b', '5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 0, '2018-12-01 16:53:26'),
('d801a76a05e5b574b1b6a3c6bfcde982d11f426a933b3cfa1730c2c72ebcfca1581903a85b8520b1', 'b084930759576e49fd770b3920a4c83e5b684d15e0c79b1b75f46d5b80835c292133dd1f365eb59d', 0, '2018-12-13 22:32:57'),
('db998d491a385f877c3b9b4e56b73ab8e9b95e7618875dca635fb23cf6ca7daddf5d1922be941bc8', '73fd7a8dbb3f94aaa12498f400c1c5126f612b1e24924d79872fc282d8e4f7e824f524bfc3fe0641', 0, '2018-12-09 19:11:33'),
('dcf716f9f605494ce3b0fa84c3b69e8407f202a5edcfe242f7412a0599af6128bd047bd3f8537dd6', 'e971ce64e958a4b515474c8b764ec4014fec2f0b851967eb0c621a393f1d467dbc7af4dd4c299755', 0, '2018-12-07 14:35:19'),
('eb03631214d132aa89604ffb74d4a0f51a5a35a1f073aba1f391a0b2e93a0ee671ca2aeba27045f8', '49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 0, '2018-12-01 16:04:46'),
('ef93434b106d66431b1bee1501760f8df55528b0e7e8a4da74074cfc9035d31078bb89271ffd3cad', 'b88bb94d31a89b2b891f63cd87b09f397a8c29702a222384afbc6b28f3195d4739971c40e8676c9c', 0, '2018-12-14 20:52:36'),
('f147cf09fb917fd68ba7ae35f49ab44eb4241fd020db2fef163a821130a6d1c0ac8e9c5f3a5bdbbc', 'e560c1038789c555c815afc43c7d321aca2428faada47e9eb8095dba20976cf00e959320bccbf640', 0, '2018-12-14 14:12:49'),
('f3979d738bcbcef5358353ed0115323e22f71a9dba897bb841b88ce82ed629a655f536f705aa74f5', '648228a94fc3012b5cbd897ba906431302c020a8db82e5d26df400a36193b0b4fa6380e8ae4cb6b7', 0, '2018-12-14 20:59:55'),
('f889a883e0ea6e0821fa77ccf35209befee7653e63fef8e168ecd41704732e1fa98ece6ea59477cd', 'bc5b734c7582563f9a553b3c2d865861af3d1673977104ec1ea4cdc4abb6fe8c2d948f205cab2301', 0, '2018-12-14 20:51:05'),
('f8a11166d5abc39367f8807111090c777a9ea549e9e83aba6967dbab83c743fa637659a80e7aac4a', 'd2935526316482c152e4587ff8133e411b97aa152d952922f21eab7641a9f4c9b9ce420e8ba64351', 0, '2018-12-14 20:46:32'),
('fad375ace6b7fbe23b821d38f539f5f343c5d21ff7e996981736901f997b7a144da66ed194d3e6d7', 'c94a43b3faf6ad4f39de06e35ea1abb3f82408a44e3b50022e82453868b0b4e3a942c4e119380e31', 0, '2018-12-13 17:40:11'),
('fbfe23961165b07f391163783a44f679e494dd7db3e89410c990b2e87624b1264d92e7134b8e7032', '2f0dbcd0a076c2033bd55eee71c08fa4112828600596b9dda8cac27d64d957fd0101638758ac2c58', 0, '2018-12-14 21:18:24'),
('fda0702978dfd375c7e049ef85e9ccd32d7204373d8cf631405176a8faf73006f73fa208563bcffc', '5ac03113ca656d1bb0b0ad7192d75dc97f6125412a679c28862d8edc1203c0d3e93e50fae5b15c20', 0, '2018-12-14 20:43:25'),
('fe5fa0baf869c39e40cdc2d66749ade1fd5b241c23372f8502eff4ecdb75bb21ca9443e57c6a053a', '4816787151f1c99658585232a1ca96cdd63bb324712f15c3bacc934ed35556daa02463935d779bfb', 0, '2018-12-13 22:45:06');

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
  `fecha_creacion` date NOT NULL,
  `id_supervisor` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_trabajo_asignacion`
--

INSERT INTO `plan_trabajo_asignacion` (`id_plan_trabajo`, `id_sucursal`, `fecha_creacion`, `id_supervisor`, `estado`) VALUES
(1, 1, '2018-11-09', 11, 0),
(2, 1, '2018-11-02', 11, 0);

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
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(124) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `id_cordinador`, `nombre`, `descripcion`) VALUES
(1, 1, 'COSTA ATLANTICA ', 'COSTA NORTE DE COLOMBIA');

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

--
-- Volcado de datos para la tabla `remisiones`
--

INSERT INTO `remisiones` (`id_remision`, `id_plan_trabajo`, `id_prioridad`, `calificacion`, `fecha_inicio`, `fecha_fin`, `fecha_mod`, `observacion`, `calificacion_pv`, `estado`) VALUES
(1, 2, 1, NULL, '2018-11-09 00:00:00', '2018-11-19 23:59:00', NULL, '', NULL, 'Activo'),
(2, 2, 1, NULL, '2018-11-02 00:00:00', '2018-11-18 23:59:00', NULL, '', NULL, 'Activo'),
(3, 2, 1, NULL, '2018-11-05 00:00:00', '2018-11-17 23:59:00', NULL, '', NULL, 'Activo');

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
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_suscursal` int(11) NOT NULL,
  `cod_sucursal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitud` decimal(50,0) NOT NULL,
  `latitud` decimal(50,0) NOT NULL,
  `id_tipo_cadena` int(11) NOT NULL,
  `id_tipo_poblacion` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_suscursal`, `cod_sucursal`, `nombre`, `direccion`, `longitud`, `latitud`, `id_tipo_cadena`, `id_tipo_poblacion`, `id_zona`) VALUES
(1, 'BOT0020', 'Botica 20', '0', '98', '0', 0, 0, 1),
(2, 'ING0025', 'Inglesa 25', '0', '3333', '333', 0, 0, 2),
(3, 'BOT0023', 'Botica21', '0', '4453', '0', 0, 0, 1),
(5, 'BOT0022', 'boticaprueba', 'cra 7c', '45', '12', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jeann', 'pruebas@gmail.com', NULL, '$2y$10$tvRBgnPUbkXLMG.DquwlO.JCoeKFNlWTsB6mVOP5tgq1hMckCBWGW', NULL, '2018-10-31 01:31:30', '2018-10-31 01:31:30'),
(2, 'faby', 'is@ggm.com', NULL, '$2y$10$ej0dPMbCvPJDM0lc70GSHeLZ2WhqMhds.eOLI7wluFchG2yvmySvK', NULL, '2018-10-31 01:36:16', '2018-10-31 01:36:16'),
(3, 'jeannuel', 'jjeasdada@gmail.com', NULL, '$2y$10$YDNrirf559cKUPu0oUum/eOl6OySBANoI5PwXVqviyWv1WuqafzjK', NULL, '2018-10-31 01:38:52', '2018-10-31 01:38:52'),
(4, 'Ronaldo', 'ronaldodo@mail.com', NULL, '$2y$10$u4CCshmLkKB8Ij1S5p61ceI9f1RwtteyGAKSaI3J1mOcun4qwG81W', NULL, '2018-10-31 02:29:48', '2018-10-31 02:29:48'),
(5, 'faby', 'ffreytte@gmail.com', NULL, '$2y$10$tvRBgnPUbkXLMG.DquwlO.JCoeKFNlWTsB6mVOP5tgq1hMckCBWGW', NULL, '2018-10-31 20:48:04', '2018-10-31 20:48:04'),
(6, 'jhonatan', 'jhona@gmail.com', NULL, '$2y$10$Zv7WtM5bf5mmLYoryfrPSuU4bsP/Hod7AqiB8BNGiAc1DBNb7vYei', NULL, '2018-11-02 02:05:31', '2018-11-02 02:05:31'),
(13, 'jhonatan', 'jhona1@gmail.com', NULL, '$2y$10$NSyw.c/btM/nOa68l16O/eC2p.qbFJHVb7Y5mVPC3kHyC0.mfKgZm', NULL, '2018-11-02 03:49:12', '2018-11-02 03:49:12'),
(14, 'jhonatan', 'jhona2@gmail.com', NULL, '$2y$10$PUcEPKK0BdKvHSHRIYln6O86hevFg3ppO1seLu.dkjtuuZnPhOAmW', NULL, '2018-11-02 03:50:24', '2018-11-02 03:50:24'),
(15, 'jhonatan', 'jhona3@gmail.com', NULL, '$2y$10$UaTicor5vexcVgyUS1nL1ugtrK1.9SA0/94d9o5tIV3iFV4be2er2', NULL, '2018-11-02 03:51:28', '2018-11-02 03:51:28'),
(18, 'jhonatan', 'jhona4@gmail.com', NULL, '$2y$10$T67JJoaDM6QWUkhlwFteSOeXYsEdM7Kaq2BlaSAvPjxnCDvBCE2cK', NULL, '2018-11-02 03:56:16', '2018-11-02 03:56:16'),
(29, 'jhonatan', 'jhona5@gmail.com', NULL, '$2y$10$pqbWZNX8MvyeY7d1naDrmeRVyI02jR5ouuCWOJFMOtjA1gK3aWDFy', NULL, '2018-11-02 04:06:18', '2018-11-02 04:06:18'),
(30, 'probando', 'probando@gmail.com', NULL, '$2y$10$aBxgqDvkd.emBRbtnM00aOLdR/mvZfMlIayCBfLrGduZfpxvebB8K', NULL, '2018-11-02 21:04:02', '2018-11-02 21:04:02'),
(31, 'probando', 'probando89@gmail.com', NULL, '$2y$10$7X50NgJ6C2mKjigSNlLqguK8S6.eX4Bw2pVDj8ZhPSEawqtvLUH12', NULL, '2018-11-02 21:07:17', '2018-11-02 21:07:17'),
(35, 'administrador', 'admin@gmail.com', NULL, '$2y$10$0GL8bYTDbGOSDcop9n9byOrVHS..ifsIn5xTvuG0bA4Bu8Rlc5muu', NULL, '2018-11-03 20:23:17', '2018-11-03 20:23:17'),
(38, 'max', 'max@gmail.com', NULL, '$2y$10$jsnOeFeuNhu38gEBAnBm9elgdAvSby9zM45VU8Q63twcunvNU7M.a', NULL, '2018-11-14 22:13:26', '2018-11-14 22:13:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `cedula`, `correo`, `password`, `telefono`) VALUES
(1, 'Ronaldo', 'fr', 1148855, 'ronaldodo@mail.com', '123456789', 852963),
(2, 'jeann', 'nuel', 8522, 'pruebas@gmail.com', 'kjsjfdj', 999),
(7, 'jhonatan', 'cudris', 154541, 'jhona5@gmail.com', '123456', 54112),
(8, 'probando', 'prueba', 1234567, 'probando@gmail.com', '123456', 41424),
(9, 'probando', 'prueba', 12345678, 'probando89@gmail.com', '12345678', 41424),
(10, 'administrador', 'admin', 123456789, 'admin@gmail.com', '123456', 123456);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `id_usuario_roles` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`id_usuario_roles`, `id_rol`, `id_usuario`, `estado`) VALUES
(11, 1, 1, 1),
(12, 1, 2, 0),
(16, 3, 7, 0),
(17, 1, 8, 1),
(18, 1, 9, 0),
(19, 2, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id_zona` int(11) NOT NULL,
  `descripcion_zona` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_region` int(11) NOT NULL,
  `id_usuario_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id_zona`, `descripcion_zona`, `id_region`, `id_usuario_roles`) VALUES
(1, 'Barranquila-Norte', 1, 11),
(2, 'Barranquilla-Sur', 1, 12),
(9, 'zonaloca', 1, 17);

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
-- Indices de la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  ADD PRIMARY KEY (`id_condiciones`),
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
-- Indices de la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  ADD PRIMARY KEY (`id_formula`),
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
  ADD KEY `id_supervisor` (`id_supervisor`);

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
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_suscursal`),
  ADD KEY `id_tipo_cadena` (`id_tipo_cadena`),
  ADD KEY `id_tipo_poblacion` (`id_tipo_poblacion`),
  ADD KEY `id_zona` (`id_zona`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `apertura`
--
ALTER TABLE `apertura`
  MODIFY `id_apertura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  MODIFY `id_condiciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id_cordinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentacion_legal`
--
ALTER TABLE `documentacion_legal`
  MODIFY `id_documentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  MODIFY `id_formula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_plan_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `id_prioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `relevancia`
--
ALTER TABLE `relevancia`
  MODIFY `id_relevancia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `remisiones`
--
ALTER TABLE `remisiones`
  MODIFY `id_remision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_suscursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  MODIFY `id_usuario_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Filtros para la tabla `condiciones_locativas`
--
ALTER TABLE `condiciones_locativas`
  ADD CONSTRAINT `condiciones_locativas_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `condiciones_locativas_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `documentacion_legal`
--
ALTER TABLE `documentacion_legal`
  ADD CONSTRAINT `documentacion_legal_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `documentacion_legal_ibfk_3` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

--
-- Filtros para la tabla `formulas_despachos`
--
ALTER TABLE `formulas_despachos`
  ADD CONSTRAINT `formulas_despachos_ibfk_1` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`),
  ADD CONSTRAINT `formulas_despachos_ibfk_2` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`);

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_plan_trabajo`) REFERENCES `plan_trabajo_asignacion` (`id_plan_trabajo`),
  ADD CONSTRAINT `kardex_ibfk_2` FOREIGN KEY (`id_prioridad`) REFERENCES `prioridad` (`id_prioridad`);

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
  ADD CONSTRAINT `plan_trabajo_asignacion_ibfk_2` FOREIGN KEY (`id_supervisor`) REFERENCES `usuarios_roles` (`id_usuario_roles`);

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
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id_zona`);

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
  ADD CONSTRAINT `zona_ibfk_1` FOREIGN KEY (`id_usuario_roles`) REFERENCES `usuarios_roles` (`id_usuario_roles`),
  ADD CONSTRAINT `zona_ibfk_2` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
