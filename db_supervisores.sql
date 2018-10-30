-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2018 a las 06:21:53
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

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
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(20, '2016_06_01_000004_create_oauth_clients_table', 1),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(22, '2018_10_29_042808_create_posts_table', 1);

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
('47aa9fff94d035b6eb44cf19212493046649107092bd0731d2a31f221306e40c6473a733b63e17d2', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 09:48:10', '2018-10-29 09:48:10', '2018-10-29 04:49:10'),
('671ab5ffdad9aee59db6d18a41988884d0267674cc9dc314963fbc0ea91e0e6386dcca990090d45b', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 10:06:56', '2018-10-29 10:06:56', '2018-10-29 05:07:55'),
('75f26420aa68baf437b5e1e74f2d583fc572a181ccc76ce0d39cfe887f4b433cb0260ecd7ad9bb35', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 10:12:20', '2018-10-29 10:12:20', '2018-10-29 05:13:20'),
('88b6d340fa8ae83249d99ffd3d606827a825ecb85ec7a6ab3423bf7e0c40d155f86afdde2c86d5e9', 1, 1, NULL, '[\"*\"]', 0, '2018-10-29 10:09:52', '2018-10-29 10:09:52', '2018-10-29 05:10:52'),
('b431150d042ce3fa3cab6c5d487fb5e65117a1e62c4540dac8512acc88c2a3991a5b23781c50b371', 1, 1, NULL, '[\"*\"]', 1, '2018-10-29 09:49:41', '2018-10-29 09:49:41', '2018-10-29 04:50:41'),
('ebe1f60a792ff2621a2cfb408b0e197ae9a46116c28bad3fb567daa1e9ae01fceeb9e2bde3c07477', 1, 1, NULL, '[\"*\"]', 1, '2018-10-29 09:50:35', '2018-10-29 09:50:35', '2018-10-29 04:51:35'),
('fb83aebee055360e382ab6aae7b9fc06bd563e39aa7c484acdc04039db8cddc4f116582654320ac6', 1, 1, NULL, '[\"*\"]', 1, '2018-10-29 09:49:02', '2018-10-29 09:49:02', '2018-10-29 04:50:02');

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
(1, NULL, 'Laravel Password Grant Client', 'q9jaQzQvetRUEXqygLe1gc7uqXKhv64k0DJL5zOu', 'http://localhost', 0, 1, 0, '2018-10-29 09:47:52', '2018-10-29 09:47:52');

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
('0d08e166ecc554294e956baf78b11a6a168dda057f2981eabf19d37ff829519b8e4445960deea8d2', '75f26420aa68baf437b5e1e74f2d583fc572a181ccc76ce0d39cfe887f4b433cb0260ecd7ad9bb35', 0, '2018-11-28 05:12:20'),
('2b41732fb81faff19e5f92dc62e7e8d450ba2cd981055e3c88715ea033c4b8756c5205a28a3fe3d2', 'ebe1f60a792ff2621a2cfb408b0e197ae9a46116c28bad3fb567daa1e9ae01fceeb9e2bde3c07477', 1, '2018-11-28 04:50:35'),
('500f49a8d00c70739a265772a004e0f067fe4dd9dc49088550778ecb5edb2e58443dc875c1fa6277', 'fb83aebee055360e382ab6aae7b9fc06bd563e39aa7c484acdc04039db8cddc4f116582654320ac6', 1, '2018-11-28 04:49:02'),
('6150c4f1281ea83e2e3eeb7c0a548f82404979b2151174c8c530a02545eb6fe0af944aeae4901980', 'b431150d042ce3fa3cab6c5d487fb5e65117a1e62c4540dac8512acc88c2a3991a5b23781c50b371', 1, '2018-11-28 04:49:41'),
('80336c021de1b7e7c75257ef147fd319a88f78d1c3cdc88719008650895317bd229a53f5462c1dab', '671ab5ffdad9aee59db6d18a41988884d0267674cc9dc314963fbc0ea91e0e6386dcca990090d45b', 0, '2018-11-28 05:06:55'),
('86221d17335875246b1f2c217698feea27ac8aa73753c2112dcb6f39d9e4417075ff7812751a14e3', '88b6d340fa8ae83249d99ffd3d606827a825ecb85ec7a6ab3423bf7e0c40d155f86afdde2c86d5e9', 0, '2018-11-28 05:09:52'),
('888b49ad58dff1fd60423fced477b52f90370ff97a45e8d28b5efa504e01c2a581cc5e6faf33bd9a', '47aa9fff94d035b6eb44cf19212493046649107092bd0731d2a31f221306e40c6473a733b63e17d2', 0, '2018-11-28 04:48:10');

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

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Title', 'My first content', 1, '2018-10-29 10:00:23', '2018-10-29 10:00:23');

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
(1, 'Ronaldo', 'ronald@mail.com', NULL, '$2y$10$isQxQEYYGH5KCoXunTJsfOkvq4/l2xqOF69PP2EwkR63QAlIhklF2', NULL, '2018-10-29 09:48:10', '2018-10-29 09:48:10');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
