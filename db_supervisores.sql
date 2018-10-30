-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2018 a las 20:15:39
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
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(12, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(13, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(14, '2016_06_01_000004_create_oauth_clients_table', 1),
(15, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(16, '2018_10_29_042808_create_posts_table', 1),
(17, '2018_10_29_141945_create_coordinadors_table', 1),
(18, '2018_10_29_193446_create_roles_table', 2),
(19, '2018_10_29_193625_create_role_user_table', 2);

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
('04e28d2dc3c644ff4c98b2cc34c96120770ce9b1a304d3dc4a565c6e29eb6e5fae2bd0c27dc83f77', 21, 1, NULL, '[\"*\"]', 0, '2018-10-30 20:08:01', '2018-10-30 20:08:01', '2018-10-31 15:08:01'),
('0990aee66551e7029a446b2cf58910ea91ba56d7a9e4f49cd58d49721f9b884f558b02dc3b2185ef', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:28:23', '2018-10-30 03:28:23', '2018-10-30 22:28:23'),
('0ca7ff5164923f7ae0562473861b1244fbdb3d8780201a5929db9877bdd6ec0fa2ee26303d1ce59d', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 02:41:47', '2018-10-30 02:41:47', '2018-10-29 21:42:47'),
('0d54a2c83e29362bfac79b72aee7649a8e773dc0797e7aad07a09ee507a1855f7750cdbdc35be167', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 23:31:26', '2018-10-29 23:31:26', '2018-10-29 18:32:25'),
('109ad115fd3388bd21972f2e824900760ece58ecc87a8fc6d3555b1cc69cc71be3e216dc51d88dcb', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:36:14', '2018-10-30 03:36:14', '2018-10-30 22:36:11'),
('1c9194f6c824d3c001e10a8c09b572ca986c7d02ae74547f63ce7e4028a32e938e39fee7ed73f412', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 19:29:50', '2018-10-29 19:29:50', '2018-10-29 14:30:49'),
('331bf83cff16bc0643b37d22f6fa19e342f1191d49b9fafac0dafb282d365e6b6dcc63a9425bde98', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 02:40:35', '2018-10-30 02:40:35', '2018-10-29 21:41:28'),
('3aeb1489b6ec684bd08f00c505a0a68c0305883501c3d64313e20e6dba8b645a0f48d85fd98ca856', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 19:32:32', '2018-10-29 19:32:32', '2018-10-29 14:33:32'),
('44ea42ad67e9823034727ca1ed298ea8226fe89158231aff170a1ff794a037b318ac521d10ca6dc0', 14, 1, NULL, '[\"*\"]', 0, '2018-10-30 04:17:15', '2018-10-30 04:17:15', '2018-10-30 23:17:14'),
('543db4d261b23a05376954fc8db0ab8e9d6b8576e965935cc9f35689286bc3218f1967fc07a423a5', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 20:48:03', '2018-10-29 20:48:03', '2018-10-29 15:49:03'),
('59e32e68f11052bdc02c3953ad493ab1ce6220faef8f26337011efb0b1c9619e7e2143d8e29c9506', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 20:46:18', '2018-10-29 20:46:18', '2018-10-29 15:47:18'),
('69a8653a1da8c1e596e95ff69d01f0732f064c385f9233385e79603277c8f2a17ea37df78fb42a78', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 19:35:41', '2018-10-29 19:35:41', '2018-10-29 14:36:40'),
('7d99954a6a28fa83bf705f52581690d77bc2a8602d616af7486a688e5d6fe9d85149764c05147146', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 23:33:27', '2018-10-29 23:33:27', '2018-10-29 18:34:26'),
('7f52fedadfefef14e761864d700a122c1104f6285403d430d63c431869bfd004ad79a22502506311', 18, 1, NULL, '[\"*\"]', 0, '2018-10-30 20:02:22', '2018-10-30 20:02:22', '2018-10-31 15:02:19'),
('989e8e2e9cd0b65cbb5fbd231f7475af798dc550a198f1d674c1bc064ee722c8f1c6516958e7abda', 1, 1, NULL, '[\"*\"]', 0, '2018-10-30 00:28:03', '2018-10-30 00:28:03', '2018-10-29 19:29:03'),
('9b2224a0f6a1f693f772a37a1132fd18a200a517d03b1f231db97980b569a12ec37bc0fd4ad1a93f', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 19:30:21', '2018-10-29 19:30:21', '2018-10-29 14:31:21'),
('aacf331e0a2d3aa9b5d0a38bccabd5cb314bac5a31bf261df573292e2b2427e7fe7e92d9dcbd27b1', 11, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:52:22', '2018-10-30 03:52:22', '2018-10-30 22:52:22'),
('b4db7b3b46e0dac32f7324d7b1639e6d132ff49c429af061201df42dc3258d11e302287cf5fef391', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:30:09', '2018-10-30 03:30:09', '2018-10-30 22:30:09'),
('b614cfb6402b09364b5a34fba0158bc3c3e43c21f7edf9e7b541eb2b30a9c50c23968a9dd7493d54', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:18:55', '2018-10-30 03:18:55', '2018-10-30 22:18:55'),
('c78f07e38c7a4805cc9531819a8405683b46d4d4e301c478dfa28a4decc4e278f02e54b978dd37b0', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:18:19', '2018-10-30 03:18:19', '2018-10-30 22:18:19'),
('ccf4e8ceb04b4b22b815d57df934f5b4ae74fe9fb448efc95380d3540642b56e4f52bf9c2e49542a', 22, 1, NULL, '[\"*\"]', 0, '2018-10-30 20:08:58', '2018-10-30 20:08:58', '2018-10-31 15:08:57'),
('d0e8971620610a9b151f0b4ff08c55f8feab611660ff1060ca27fbaebf6dbab7f2a21fe3e5ab7870', 9, 1, NULL, '[\"*\"]', 0, '2018-10-30 03:06:47', '2018-10-30 03:06:47', '2018-10-29 22:07:47'),
('d7693da4c17e07c1c944fce34405a367dd7e7d98880d8f208f414a1024c2bf67471a9758560938d7', 19, 1, NULL, '[\"*\"]', 0, '2018-10-30 20:03:10', '2018-10-30 20:03:10', '2018-10-31 15:03:10'),
('db158f31a5aa1725c79aa8341d23f2cf01dcf8c7ebcfe9a3728239fea082ed91e73d8d4bc4db3c51', 13, 1, NULL, '[\"*\"]', 0, '2018-10-30 04:06:25', '2018-10-30 04:06:25', '2018-10-30 23:06:25'),
('df667a61935045e9961d875d358a49a0f3228c8139fe9491177ba081e6a20954d9e8616fffbae04f', 20, 1, NULL, '[\"*\"]', 0, '2018-10-30 20:06:36', '2018-10-30 20:06:36', '2018-10-31 15:06:36');

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
(1, NULL, 'Laravel Password Grant Client', '7aydUqNEgeOvKTj3QksRrkjY3d5OUoQCLtWu0S16', 'http://localhost', 0, 1, 0, '2018-10-29 19:27:22', '2018-10-29 19:27:22');

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
('04d6ee629482a07ddee7e7bf266a0ccd89f786e353846021a77c7d06b61fc5514f3da07b9f8da8e3', '331bf83cff16bc0643b37d22f6fa19e342f1191d49b9fafac0dafb282d365e6b6dcc63a9425bde98', 0, '2018-11-28 21:40:29'),
('10c870c0ff35e9302007fe308f21b9e40ee817658385501954a1c9827dec96500ac96c66a2b71eb5', '59e32e68f11052bdc02c3953ad493ab1ce6220faef8f26337011efb0b1c9619e7e2143d8e29c9506', 0, '2018-11-28 15:46:18'),
('1972ea344a1fb35cee147b41e0c41acfaa5a82c20a033ea1dce0f944ddb891ba6dd41e8b730ddb95', '44ea42ad67e9823034727ca1ed298ea8226fe89158231aff170a1ff794a037b318ac521d10ca6dc0', 0, '2018-11-28 23:17:14'),
('276b2cf8482752fe3b44816410eb6fd3a1bb9c80ce9cd47d54fbca51e9aa1ce7e425f42fa06103e6', '0d54a2c83e29362bfac79b72aee7649a8e773dc0797e7aad07a09ee507a1855f7750cdbdc35be167', 0, '2018-11-28 18:31:26'),
('3160725e8f83a9b556a7cead8ddeda0ed9ee466b3f9c2e4b3d7ebb16624f6fd5e8f754aa39c8533d', '9b2224a0f6a1f693f772a37a1132fd18a200a517d03b1f231db97980b569a12ec37bc0fd4ad1a93f', 0, '2018-11-28 14:30:21'),
('5633493d12e54b752029aab3dc46acd8fa0e08089f2279e482b2742d35fa23705d983fbca555b06a', '1c9194f6c824d3c001e10a8c09b572ca986c7d02ae74547f63ce7e4028a32e938e39fee7ed73f412', 0, '2018-11-28 14:29:49'),
('5d5eb0da1d48635c3abcec83aeadbb786f3547b3794d25d5666d562e536cef91d961daf7d0f52258', '989e8e2e9cd0b65cbb5fbd231f7475af798dc550a198f1d674c1bc064ee722c8f1c6516958e7abda', 0, '2018-11-28 19:28:03'),
('699721658092d2bb14089bcebcd7145bd7d88193540860bf70deab8ea835e24da3f75761c603f2e2', 'd7693da4c17e07c1c944fce34405a367dd7e7d98880d8f208f414a1024c2bf67471a9758560938d7', 0, '2018-11-29 15:03:10'),
('6a604406d24b2b204969efc94706b5f1400cf408ed55c7a20365912ee6eda9ef9d0d65646f463ebf', '109ad115fd3388bd21972f2e824900760ece58ecc87a8fc6d3555b1cc69cc71be3e216dc51d88dcb', 0, '2018-11-28 22:36:11'),
('6bdbb4d0ea5146cdd5a3c2738ff2d66c649a6cb56a7fc3357ed00463e18d82ba346f440fa0eb9d12', 'db158f31a5aa1725c79aa8341d23f2cf01dcf8c7ebcfe9a3728239fea082ed91e73d8d4bc4db3c51', 0, '2018-11-28 23:06:25'),
('89cc59545adb1331bfc4f9f38bcb16db4f78b4279b9796231252db31ddadb5df2d33186000a4b1b9', '7f52fedadfefef14e761864d700a122c1104f6285403d430d63c431869bfd004ad79a22502506311', 0, '2018-11-29 15:02:19'),
('8ae425f43ed4f1bcd36979a91b68495e76069e6ae5b00fa1cd118ce530d9eb5100580886e41fdc16', '0990aee66551e7029a446b2cf58910ea91ba56d7a9e4f49cd58d49721f9b884f558b02dc3b2185ef', 0, '2018-11-28 22:28:23'),
('9710dbf9cd05dbc8468227e336ab892e78143e06addd5f2592007290d342a247fc0ca1ab9a114046', 'b4db7b3b46e0dac32f7324d7b1639e6d132ff49c429af061201df42dc3258d11e302287cf5fef391', 0, '2018-11-28 22:30:09'),
('9c542db814a3257d77eb46fd1d2edc870e63778ecc66645a440695a25944e14a14208d4643fe1822', '543db4d261b23a05376954fc8db0ab8e9d6b8576e965935cc9f35689286bc3218f1967fc07a423a5', 0, '2018-11-28 15:48:03'),
('a470e78ecdd1e514ef33b00abacd62a931d6ac7103a09f582066ddf532f2ce33de26d615fd48b06b', '3aeb1489b6ec684bd08f00c505a0a68c0305883501c3d64313e20e6dba8b645a0f48d85fd98ca856', 0, '2018-11-28 14:32:32'),
('c9581a7aa88b3a0e204cd5ed0326df6d8f5962a40ff35728c0fac973057895000fa0c96d27269d62', 'd0e8971620610a9b151f0b4ff08c55f8feab611660ff1060ca27fbaebf6dbab7f2a21fe3e5ab7870', 0, '2018-11-28 22:06:47'),
('d1402c5226b97406e373ca754b7125756c90a269efd4131a9e34a443fc0fafcaf8ddacfe908a3d2c', 'ccf4e8ceb04b4b22b815d57df934f5b4ae74fe9fb448efc95380d3540642b56e4f52bf9c2e49542a', 0, '2018-11-29 15:08:57'),
('d1e6c0f01f7352fdbf98bf997d8c3a512325b17fb288b2dc94fa2fc3d82b8f798ceb48c41e01df58', '69a8653a1da8c1e596e95ff69d01f0732f064c385f9233385e79603277c8f2a17ea37df78fb42a78', 0, '2018-11-28 14:35:41'),
('d7ebeea8b6d6235b733bf1f71bc058b590ae3e669626db068223c3a60c2e788b1ab70997eb8b9760', 'aacf331e0a2d3aa9b5d0a38bccabd5cb314bac5a31bf261df573292e2b2427e7fe7e92d9dcbd27b1', 0, '2018-11-28 22:52:22'),
('e3b43eb7b8444d0e03377bf73fcddbee3e6b40dd173af2ccfdcfc0ce890427e6a3ea362527175800', '04e28d2dc3c644ff4c98b2cc34c96120770ce9b1a304d3dc4a565c6e29eb6e5fae2bd0c27dc83f77', 0, '2018-11-29 15:08:01'),
('e928047840c2f1ca06f4a2c27fd0a6e9cc63589f91a7c9969fd2c8fc68041eeeec09eaad9299c897', 'c78f07e38c7a4805cc9531819a8405683b46d4d4e301c478dfa28a4decc4e278f02e54b978dd37b0', 0, '2018-11-28 22:18:19'),
('e9b4f54546105c3890be966baa238989d87e1694da65c806d1149d5e98a8a86a0b22f86f074e53ea', 'df667a61935045e9961d875d358a49a0f3228c8139fe9491177ba081e6a20954d9e8616fffbae04f', 0, '2018-11-29 15:06:36'),
('ebc99e4243045e1993e73bb4fa4fd95920360104bf3da424de417afb6b34e173f2f18b50f4457a6b', 'b614cfb6402b09364b5a34fba0158bc3c3e43c21f7edf9e7b541eb2b30a9c50c23968a9dd7493d54', 0, '2018-11-28 22:18:55'),
('ebf9ea5f2ef16382cb6d2b23c4533564b56d837c9fe5bf652ebcdf3b86c5c7d9cd95fc6cb3eeb415', '7d99954a6a28fa83bf705f52581690d77bc2a8602d616af7486a688e5d6fe9d85149764c05147146', 0, '2018-11-28 18:33:27'),
('f60fe3995e622c7effeca484e2103dc815eecbd4aa9b5c27e0d945e6a557a3f2cff2426a30b78516', '0ca7ff5164923f7ae0562473861b1244fbdb3d8780201a5929db9877bdd6ec0fa2ee26303d1ce59d', 0, '2018-11-28 21:41:47');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'administrador', NULL, NULL),
(2, 'user', 'usuario', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

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
(9, 'fabi', 'fabi@mail.com', NULL, '$2y$10$B4uDLKQ6GERYazQmlj78G./7rYtJC.GUQgPwWHueV6MbIEGS3JRFy', NULL, '2018-10-30 02:40:32', '2018-10-30 02:40:32'),
(10, 'fabi', 'ronald@mail.com', NULL, '$2y$10$8EepDksRR7xj4/J4C1i04ul.tnhrw1bNgdwQH0JB4iSHN5c2FYrgq', NULL, '2018-10-30 03:19:16', '2018-10-30 03:19:16'),
(11, 'fabi', 'ronaldo@mail.com', NULL, '$2y$10$jHeFp87FmGKi.Er/DuFsXumYrdmR6J14GYiVmHTMlnp1aMIcZN1fW', NULL, '2018-10-30 03:52:22', '2018-10-30 03:52:22'),
(12, 'fabi', 'rnaldo@mail.com', NULL, '$2y$10$G/AsfNla0f1AwP9iYP8jL.zs/lgqE6Hh1i4E4555oN/K4nyTcOM8m', NULL, '2018-10-30 04:02:42', '2018-10-30 04:02:42'),
(13, 'faby', 'ffreytte10@gmail.com', NULL, '$2y$10$1KcTad718HJmoxACmrA3DuolPlcyHWAsbSkNMwTXLDneBm1GYjYa.', NULL, '2018-10-30 04:06:25', '2018-10-30 04:06:25'),
(14, 'jeann', 'jjean@mgil.com', NULL, '$2y$10$aXE.awjt/ZdKi5CfpQL2GujPQQEm0.neyPNwAu6P6LASMBW/DEWry', NULL, '2018-10-30 04:17:14', '2018-10-30 04:17:14'),
(15, 'jeannl', 'jeajansn@gmail.com', NULL, '$2y$10$inOh4ClJeFPhUw.uVqf.CeHZjMPTJUk2dSsIV/pWeHLEgQe8pTPQ2', NULL, '2018-10-30 04:18:24', '2018-10-30 04:18:24'),
(16, 'Jeannuel', 'jjeanlink@gaysilolees.com', NULL, '$2y$10$alV4q1yNc3DcyIgiPTalDOcmpGQBsC3bbxisB5CM7.B3thR6giiSS', NULL, '2018-10-30 20:01:41', '2018-10-30 20:01:41'),
(18, 'jeann', 'jeanea@gmail.com', NULL, '$2y$10$OH1dFvIK6ufOsAvKfYgUKOmr8m0PvBX268o0/fYs5i9p/Jp40WxOK', NULL, '2018-10-30 20:02:19', '2018-10-30 20:02:19'),
(19, 'jjean', 'jjean@gmail.com', NULL, '$2y$10$S1WERbt7QVwN9KodHf1ea.oMU2DDTAewRCDY/DB2IzVhxLAkhuwNK', NULL, '2018-10-30 20:03:10', '2018-10-30 20:03:10'),
(20, 'jjeaneaea', 'jjeaaeaea@gmail.com', NULL, '$2y$10$CtSKHYTUtcb/KmDz0GHyMeynij4tDQKsIZ9P5dNbaC5Cioa3NksjC', NULL, '2018-10-30 20:06:36', '2018-10-30 20:06:36'),
(21, 'jjeaneaea', 'tyu@gmail.com', NULL, '$2y$10$SbhmfexhPQ3hVpDz5Hxn2uACBKEDcgFhrZy6iaYjCOLWA3mUmRK46', NULL, '2018-10-30 20:08:01', '2018-10-30 20:08:01'),
(22, 'jjeaneaea', 'ty000u@gmail.com', NULL, '$2y$10$j7F5aFT5ErY7tPmyVAs6WeRAED3T2tWqo3VOxg2YkESHydxVjBTxG', NULL, '2018-10-30 20:08:57', '2018-10-30 20:08:57'),
(23, 'jjeaneaea', 'ty012300u@gmail.com', NULL, '$2y$10$tECPvUXD7gpVnUgnNqIiHOrCZBerkBAw5/W30JGfu/eUTn0PPuy4K', NULL, '2018-10-30 20:13:28', '2018-10-30 20:13:28'),
(24, 'jjeaneaea', 'ty01230123130u@gmail.com', NULL, '$2y$10$wB8jigDEPCG9SBkSa2oLK./DzMnmC4fBXABVEX4A1wN/zwr0isPIq', NULL, '2018-10-30 20:14:16', '2018-10-30 20:14:16'),
(25, 'jjeaneaea', 'ty012302342423123130u@gmail.com', NULL, '$2y$10$w2j.y/V/UMnQQSR9vp5d5O4hjH9zO/qPBnGuLkskJpai6JnR9yHry', NULL, '2018-10-30 20:16:31', '2018-10-30 20:16:31'),
(26, 'jjeaneaea', 'ty012302342423123130u@gmaiasdl.com', NULL, '$2y$10$IystGtqwnS4Fu24SJfiAne.59lSVrq39/CvAoXAEoNhs7Hsd0pL.y', NULL, '2018-10-30 20:16:59', '2018-10-30 20:16:59'),
(27, 'asd', 'asd@gmail.com', NULL, '$2y$10$azJDBS8u.9yUB/wreLDJve9bYVUk0x/K9e.DGtr9AfmKtEP3QX6ra', NULL, '2018-10-30 20:38:45', '2018-10-30 20:38:45'),
(28, 'asd', 'qweq@gmail.com', NULL, '$2y$10$h/nNPW0aeQnAT4TiQmM4tub8vv1Z8ynFCG5wE61VdmwY5se8hKvci', NULL, '2018-10-30 20:43:13', '2018-10-30 20:43:13'),
(29, 'asdasd', '1231312@gmail.com', NULL, '$2y$10$bDUGV40skErh.zfGqL/LoO5tr7WNRtiKdt961t/UD4VGdIivjzVVC', NULL, '2018-10-30 20:43:48', '2018-10-30 20:43:48'),
(30, 'asdads', '123131@gmai.com', NULL, '$2y$10$c1H0gBf2l9UXf8vJ//Rqj.nYPyPmrBDIra0rsm6FRfjUu4SthDyPC', NULL, '2018-10-30 20:44:59', '2018-10-30 20:44:59'),
(31, 'asd', 'sdas@gmai.com', NULL, '$2y$10$y2JUkm3r/.PgR.Gzr/4BJOI.GC6O5QcHrcJK5f.3U.qLeQrLAhrAe', NULL, '2018-10-30 20:45:24', '2018-10-30 20:45:24'),
(32, 'set', '1231@gmail.com', NULL, '$2y$10$WHMSVCBLMUSEdWA7Bfjpu.Mwb7TlrLbnsrQMfY3AVD.F9Bi/TZsRy', NULL, '2018-10-30 21:06:01', '2018-10-30 21:06:01'),
(36, '5ff6', 'sadfrnaldo@mail.com', NULL, '$2y$10$k5G.x5flUxt9aY0AIR3CyeoxDGJfRAOCDPOxL71R8iGuGbcgzp8US', NULL, '2018-10-30 21:20:12', '2018-10-30 21:20:12'),
(37, '5ff6', 'sadfrnadldo@mail.com', NULL, '$2y$10$2IrZNhs4xPk6hkyC7IC1qeo59mDUUb9B0ZwLniBDwO8br/BuB3.8a', NULL, '2018-10-30 21:20:33', '2018-10-30 21:20:33'),
(38, 'set', '123781@gmail.com', NULL, '$2y$10$JFc7G9RKDNlNj4Es03PMIuxNFSfZtvJVrpTctWOctyD0sORlNP2SS', NULL, '2018-10-30 21:22:29', '2018-10-30 21:22:29'),
(39, 'asdasdasd', 'jjea@gmto.com', NULL, '$2y$10$GIIQhgSTQwc.IkS7oUDgzOKOsAtALHBHKQT4RazIECHTUVqew83vO', NULL, '2018-10-30 21:29:15', '2018-10-30 21:29:15'),
(40, 'jeann', '11222@qgmail.com', NULL, '$2y$10$807LdXQlbzV/Lnzp//VVqueO/ML01hYACDTBspplYJmyjbDX0wBmC', NULL, '2018-10-30 21:49:11', '2018-10-30 21:49:11'),
(41, 'jeannn', '123123@gmail.com', NULL, '$2y$10$.l5Nn42TXYrmmLxEwV2t5.FhOnrzBaeq5P7kqLTg00mUOu2qEfgD6', NULL, '2018-10-30 21:49:33', '2018-10-30 21:49:33'),
(42, 'jeannuel', 'aa@gmail.com1', NULL, '$2y$10$k/N1nPJ8qIuyKE6WKn2B4uSN4cQxHW2.EjeGH97JRFZtMWcBXkk0G', NULL, '2018-10-30 21:52:43', '2018-10-30 21:52:43'),
(44, 'jeannlink', 'qqweqew@gmail.com', NULL, '$2y$10$KLP6.eshwKLdSgPWmkXUGebbhwbHwZyr8f9ISOq21o2k3umkrl3.C', NULL, '2018-10-30 23:57:19', '2018-10-30 23:57:19');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
