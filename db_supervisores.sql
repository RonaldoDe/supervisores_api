-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2018 a las 20:37:00
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
-- Estructura de tabla para la tabla `asigancion_permiso`
--

CREATE TABLE `asigancion_permiso` (
  `id_asiganacionP` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `direcc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`id_cordinador`, `nombre`, `apellido`, `cedula`, `correo`, `password`, `telefono`, `direcc`) VALUES
(1, 'faby', 'freyte', 1140830054, 'ffreytte@gmail.com', '123456', 4536485, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cordinadores_permiso`
--

CREATE TABLE `cordinadores_permiso` (
  `id_cordinador_permiso` int(11) NOT NULL,
  `id_cordinadores` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL
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
('0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 23:53:32', '2018-11-01 23:53:32', '2018-11-02 18:53:32'),
('0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:37:29', '2018-11-01 21:37:29', '2018-11-02 16:37:29'),
('127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:08', '2018-11-01 21:59:08', '2018-11-02 16:59:08'),
('164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:11', '2018-11-01 20:24:11', '2018-11-02 15:24:11'),
('1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:16', '2018-11-01 21:20:16', '2018-11-02 16:20:16'),
('417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:49', '2018-11-01 20:28:49', '2018-11-02 15:28:49'),
('49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:46', '2018-11-01 21:04:46', '2018-11-02 16:04:46'),
('4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:11:21', '2018-11-01 21:11:21', '2018-11-02 16:11:21'),
('4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:20:05', '2018-11-01 21:20:05', '2018-11-02 16:20:05'),
('520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:00:34', '2018-11-01 21:00:34', '2018-11-02 16:00:34'),
('5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:30:22', '2018-11-01 20:30:22', '2018-11-02 15:30:22'),
('5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:04:56', '2018-11-01 21:04:56', '2018-11-02 16:04:56'),
('5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:53:26', '2018-11-01 21:53:26', '2018-11-02 16:53:26'),
('6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:34', '2018-11-01 21:08:34', '2018-11-02 16:08:34'),
('7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:05', '2018-11-01 21:02:05', '2018-11-02 16:02:04'),
('856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:59:51', '2018-11-01 20:59:51', '2018-11-02 15:59:51'),
('a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:59:32', '2018-11-01 21:59:32', '2018-11-02 16:59:32'),
('b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:20:26', '2018-11-01 20:20:26', '2018-11-02 15:20:26'),
('b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:05:50', '2018-11-01 21:05:50', '2018-11-02 16:05:50'),
('ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:02:37', '2018-11-01 21:02:37', '2018-11-02 16:02:37'),
('c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:56:08', '2018-11-01 20:56:08', '2018-11-02 15:56:01'),
('c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:26:03', '2018-11-01 20:26:03', '2018-11-02 15:26:03'),
('d5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 21:08:27', '2018-11-01 21:08:27', '2018-11-02 16:08:27'),
('f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 5, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:28:35', '2018-11-01 20:28:35', '2018-11-02 15:28:34'),
('fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:24:20', '2018-11-01 20:24:20', '2018-11-02 15:24:20'),
('fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 4, 1, NULL, '[\"*\"]', 0, '2018-11-01 20:25:48', '2018-11-01 20:25:48', '2018-11-02 15:25:48');

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
('078150626af4c3d7a4dbac1f631c4d37d9ebe6d4340a334584b4fcb9cedd10f7936d23db82230a0e', '4e2903b53fdb69b7bcddc6f3b9f06e3dfc9b93a73d1a977131412bc1ff7eb48dfe42b0c40dd0e69b', 0, '2018-12-01 16:20:05'),
('08a106a849f9b1032c936a3eec73c81b788567b1e9649895d9ef4fd10d7fb7f72f956d266c587b8f', '856aae7a74d698229632bfbc961d136f382ace537c527fa5dda3644271995de67e97b5e6c658fed4', 0, '2018-12-01 15:59:51'),
('0f517964a0e850547eb665d0e0e4f81175217494d4cb51e7e5fed876c9ef385d29653b0584b4876b', 'b27dd06b49b5463464fb5154298f8e6ffd9a7c8a830876d95f6b0158ddced8d8b6d999f9396ce92d', 0, '2018-12-01 16:05:50'),
('18b82cbbc26067f97f756d604af1e69d52e85d5503f0e4697368b1d399479f3e0506db4f27cae66f', '5ad5edbb49d423bdd78add0576c70608467f36776e37153d6646c5d640e993426316a740d45ac44e', 0, '2018-12-01 16:04:56'),
('1c329ea5b4c02345151dcf54dfb5e62a4abf7b27e4856eca3bf686c1221c2b23192334de32853e0b', 'c9c329427b6c4d43bbd73cd7893defdeb67fbb948ec9f3615c03385f109bb7767c62c5c4bcc23d0a', 0, '2018-12-01 15:26:03'),
('33ac79a542d012b89b7fc9a00e9374927005296fd57a44e334afa5a4bdf75eed13fcf46ad5306d94', 'fad1bd6c21c3ed3bbfa3556dd81ac2573c49c00fed701abf4bec04441d1dbe7832cf4515d33895a0', 0, '2018-12-01 15:24:20'),
('3b31ab1f665f7a418811556899a509060839cf9c714e63870a146f106799a58ba530c5b4c46d61c1', 'a524d1831365e41a60a0430d364b2daf345453ca37b08a38d3be7e717e9566ea0970a31428fbe74e', 0, '2018-12-01 16:59:32'),
('42fd3314a998c822bfe04907dc9f5e85f2f4c092d8c1cd24c963bc89fd42cd624bc8fb44cac5a25e', '127bc6b52150ca72c2d1e0a915239e940c62a78aa1a3be9104dbde49e99558706221c0221e6b2510', 0, '2018-12-01 16:59:08'),
('44f3531ff880e2b70810d1a38379a4e1e5fb7fa691daa9ef344bc34848fe9dcbfc7e0d8713b1b1b9', 'd5431fc757cc5baf1e537c0359c96e0d37b3c34de35e54c8081e4d52c0f91b0d495d5c77b3891ce3', 0, '2018-12-01 16:08:27'),
('4aa90c5198c9ebdf77f2ef8d29e1bdaf384c3060897bec09389832b94b499e3b2173ec7cdb39d7ac', '1f2de1a940d1997275639c721c67a72d562af9a3e2b4f43007cc5794d740104ae2f5fe765a108c20', 0, '2018-12-01 16:20:16'),
('4c4e86bd36e046c8a864d521519c355535e788d0b4feec00c76395e1fd379c8a25f488cde3ebc555', '0807225f82f1bfae416982b29d2b413a272b3a3451ab67875ab3525a2d52c569cad34e68d627d179', 0, '2018-12-01 16:37:29'),
('4ccc9da27645dd5845bc66f6e61e6abcc93c9098c369f759804b77b412d719df164c6565f3509e0b', '0784d701492b2eaf1b144c937899565bf2bfe95b7500c03b89e5dbda877968591299876a483dd0b2', 0, '2018-12-01 18:53:32'),
('5d7dc068398bbdd44cd5fc6332b39cd79491419cf0f008090095212f966c387f755321b4cb5892ed', '7ca5d150f50f45f932b4c8aad7099fd6fd9984e3816df1882aef7a1a1c8f726f981b79a2be1a968d', 0, '2018-12-01 16:02:05'),
('5f97fe8302985b2eaccca6b25998a32a09d9cb47a62093c2d2040b97762f0013a304987ca27b48aa', '5a9a5e17481ba49ea576c0b3b81c336ec761bfe83d0e5c4ec9b6f1de615ce27f1559bfeea006aba3', 0, '2018-12-01 15:30:22'),
('66837432f07f424d87776bbd71a99bd54cb477024c8811a5b1d742ed2c3d46a068b7d08da9a732b8', '417ce3fa7b5264d82c8be4d007c6910702893f4d50da8c706e650d3bc0ff114adc83c7ba2d9da523', 0, '2018-12-01 15:28:49'),
('6ea9997361b6e93862738a74f9f1b9558d75943d38c5c4f827195210f9d976fe9775df0a45467ea7', 'f9f11f27b84dd8c534b01ae9a1e1f8b7d1e887446b13713d1b131f97a471b22bc59cd3df033c879e', 0, '2018-12-01 15:28:34'),
('7770f2c903268059c83805c978f6e02a6cc0eae98a417670cf672c1ceb8317ed4dd617508dafe4b7', '520051b1a9c2c816ac2ef2e03f36db8bf9586b2b5dc9bdc70a839721da1277919132d384994c6d80', 0, '2018-12-01 16:00:35'),
('790024aee90972dc1753d45e5cbdbf0659fa89023a6e559e1fcf3375f69d7a258beb80106dda80c0', '4d90ba24f005be7289d13757de4f30cd94c90deb8c73477b33e4f43c19602ea54f6da4f5e05c707a', 0, '2018-12-01 16:11:21'),
('7f8c2835f6a47b02c3f1316d3542f93aa14f68f92f20f7ef756e0109e780aaf86397cbedfd548822', '001b3461e4738c0ee44df40f6e9482b3e71cd0a73c44dcf33ee5a4e66dd6527859cb672c32129c79', 0, '2018-12-01 16:00:20'),
('94bdc3e8b36826c9207113dbaae0e8c893b5496cfbd3f8f5899b5679155e7e2696d9bd2ea01e28f9', '164f2f4d2d2c9fc68b2730562d581d14e10f9a0f2bec72f5473675032f7da992e00e565f400a5dc1', 0, '2018-12-01 15:24:11'),
('a800463679a580f739fbfab8941281ca2fe1342067a83b83e312292d1b1648d0660b2885b8248e99', '6cb383ac65581dd533997ac1826589efc37e04f5ef8d7330cde8c4cf0e35c4fb6cd3018a00dfde21', 0, '2018-12-01 16:08:34'),
('aa24d98c5fd9555be93e216f173536203f7b3239ed1be1afa45a01f553961f32a44f93629ac62012', 'ba79eb60a60a8e61378b7dbf1a11d651231073f578f56ee75b38eeb269df81aebd27460a9faea283', 0, '2018-12-01 16:02:37'),
('b24cd0f1d7ede9bcd9a094d775bb68073fcc07b9921615ebd118d9167e493fa225c3560f6904068b', 'b0475dd6dcb9e98d4206e6f3dfcb9a447c99bdb812bda1170063b5e8bc43854075a98cd81ea5e9ef', 0, '2018-12-01 15:20:26'),
('b6252616b57f4af56808935ca1536c2e60a11a3b9a92b26f84959428457b24d4118d16e8487344aa', 'c2e7214524bb10c035893edaa68ef69b7af1652b9e66ba0c7b33a445fd21c39712d2ee55ee9743ca', 0, '2018-12-01 15:56:02'),
('c0b780481adf6aae83c8e6dd468fd8434c8446d24b892334008a39e79ed0e8ba316d1b10ba66a5cb', 'fbbcc9fdeac8f5ee60090ed89513105ebca229e4042fbd4ec532227d01cd5318307e07eb57c5bd3a', 0, '2018-12-01 15:25:48'),
('d0c5e28ca7b88b969c7317433a32dfc077e9b6611965e74c7cc3cac982c303308c7dd6d674d2438b', '5f80aa501221340765c5bdf9e3fe8196989e4b34934dc6ae2b513ecc0ace4fd8d3f31aaf55a1a15e', 0, '2018-12-01 16:53:26'),
('eb03631214d132aa89604ffb74d4a0f51a5a35a1f073aba1f391a0b2e93a0ee671ca2aeba27045f8', '49aa0ecf77c205f0e82a5bfe17b008c1b9bbf019fcb9f89ca5c3476ae0058736295e02a2826a88d6', 0, '2018-12-01 16:04:46');

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
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `vista` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_permiso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Erick', 'PorFavor Ponte las pilas', 4, '2018-10-31 05:00:00', '2018-10-31 05:00:00');

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
(2, 'Administrador', 'Administrador total del sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_suscursal` int(11) NOT NULL,
  `cod_sucursal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` decimal(50,0) NOT NULL,
  `longitud` decimal(50,0) NOT NULL,
  `latitud` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_cadena` int(11) NOT NULL,
  `id_tipo_poblacion` int(11) NOT NULL,
  `id_zona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_suscursal`, `cod_sucursal`, `nombre`, `direccion`, `longitud`, `latitud`, `id_tipo_cadena`, `id_tipo_poblacion`, `id_zona`) VALUES
(1, 'BOT0020', 'Botica 20', '0', '98', 'kjdjdj8', 0, 0, 1),
(2, 'ING0025', 'Inglesa 25', '0', '3333', '333', 0, 0, 2);

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
(5, 'faby', 'ffreytte@gmail.com', NULL, '$2y$10$tvRBgnPUbkXLMG.DquwlO.JCoeKFNlWTsB6mVOP5tgq1hMckCBWGW', NULL, '2018-10-31 20:48:04', '2018-10-31 20:48:04');

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
(2, 'jeann', 'nuel', 8522, 'pruebas@gmail.com', 'kjsjfdj', 999);

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
(11, 1, 1, 0),
(12, 1, 2, 0);

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
(2, 'Barranquilla-Sur', 1, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asigancion_permiso`
--
ALTER TABLE `asigancion_permiso`
  ADD PRIMARY KEY (`id_asiganacionP`),
  ADD KEY `id_roles` (`id_roles`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  ADD PRIMARY KEY (`id_cordinador`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `cordinadores_permiso`
--
ALTER TABLE `cordinadores_permiso`
  ADD PRIMARY KEY (`id_cordinador_permiso`),
  ADD KEY `id_cordinadores` (`id_cordinadores`),
  ADD KEY `id_permisos` (`id_permisos`);

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
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`),
  ADD KEY `id_cordinador` (`id_cordinador`);

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
-- AUTO_INCREMENT de la tabla `asigancion_permiso`
--
ALTER TABLE `asigancion_permiso`
  MODIFY `id_asiganacionP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id_cordinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cordinadores_permiso`
--
ALTER TABLE `cordinadores_permiso`
  MODIFY `id_cordinador_permiso` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_suscursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  MODIFY `id_usuario_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asigancion_permiso`
--
ALTER TABLE `asigancion_permiso`
  ADD CONSTRAINT `asigancion_permiso_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`),
  ADD CONSTRAINT `asigancion_permiso_ibfk_2` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`);

--
-- Filtros para la tabla `cordinadores_permiso`
--
ALTER TABLE `cordinadores_permiso`
  ADD CONSTRAINT `cordinadores_permiso_ibfk_1` FOREIGN KEY (`id_cordinadores`) REFERENCES `coordinadores` (`id_cordinador`),
  ADD CONSTRAINT `cordinadores_permiso_ibfk_2` FOREIGN KEY (`id_permisos`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`id_cordinador`) REFERENCES `coordinadores` (`id_cordinador`);

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
