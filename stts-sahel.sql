-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 05:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stts-sahel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Dashboard', 'icon-chart-bar', '/', NULL, NULL, '2023-06-22 05:33:12'),
(2, 0, 8, 'Admin', 'icon-server', '', NULL, NULL, '2023-07-11 06:45:43'),
(3, 2, 9, 'Users', 'icon-users', 'auth/users', NULL, NULL, '2023-07-11 06:45:43'),
(4, 2, 10, 'Roles', 'icon-user', 'auth/roles', NULL, NULL, '2023-07-11 06:45:43'),
(5, 2, 11, 'Permission', 'icon-ban', 'auth/permissions', NULL, NULL, '2023-07-11 06:45:43'),
(6, 2, 12, 'Menu', 'icon-bars', 'auth/menu', NULL, NULL, '2023-07-11 06:45:43'),
(7, 2, 13, 'Operation log', 'icon-history', 'auth/logs', NULL, NULL, '2023-07-11 06:45:43'),
(20, 0, 2, 'Application forms', 'fa-align-left', NULL, NULL, '2023-06-21 05:09:46', '2023-07-11 06:31:30'),
(21, 20, 3, 'Seed Producer Form', 'fa-anchor', 'seed-producers', NULL, '2023-06-21 08:15:28', '2023-07-11 06:36:46'),
(22, 0, 6, 'System settings', 'icon-anchor', NULL, NULL, '2023-06-21 08:16:51', '2023-07-11 09:43:23'),
(23, 22, 7, 'Crops', 'icon-seedling', 'crops', NULL, '2023-06-21 08:17:16', '2023-07-11 06:45:43'),
(47, 20, 4, 'Crop-declarations', 'fa-wpforms', 'crop-declarations', NULL, '2023-07-11 06:45:38', '2023-07-11 06:45:43'),
(48, 20, 5, 'Field inspections', 'fa-adjust', 'field-inspections', NULL, '2023-07-11 09:43:16', '2023-07-11 09:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_operation_log`
--

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:26:25', '2023-05-11 09:26:25'),
(2, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:31:58', '2023-05-11 09:31:58'),
(3, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:35:12', '2023-05-11 09:35:12'),
(4, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:35:52', '2023-05-11 09:35:52'),
(5, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:38:26', '2023-05-11 09:38:26'),
(6, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:39:53', '2023-05-11 09:39:53'),
(7, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:40:07', '2023-05-11 09:40:07'),
(8, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:40:12', '2023-05-11 09:40:12'),
(9, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:40:16', '2023-05-11 09:40:16'),
(10, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:41:08', '2023-05-11 09:41:08'),
(11, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:41:25', '2023-05-11 09:41:25'),
(12, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:41:45', '2023-05-11 09:41:45'),
(13, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:42:13', '2023-05-11 09:42:13'),
(14, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-11 09:42:18', '2023-05-11 09:42:18'),
(15, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-11 09:42:59', '2023-05-11 09:42:59'),
(16, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 09:43:23', '2023-05-11 09:43:23'),
(17, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-11 09:43:47', '2023-05-11 09:43:47'),
(18, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-05-11 09:43:51', '2023-05-11 09:43:51'),
(19, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-05-11 09:48:42', '2023-05-11 09:48:42'),
(20, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"lanok\",\"name\":\"Lenore Cooper\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"Pa$$w0rd!\",\"roles\":[\"1\",null],\"search_terms\":null,\"permissions\":[\"1\",null],\"_token\":\"M1qtDHUcGgvMLLtg3DBZPYV4neferSz5ZrD2oBdN\",\"after-save\":\"view\"}', '2023-05-11 09:49:12', '2023-05-11 09:49:12'),
(21, 1, 'admin/auth/users/4', 'GET', '127.0.0.1', '[]', '2023-05-11 09:49:13', '2023-05-11 09:49:13'),
(22, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-11 09:49:23', '2023-05-11 09:49:23'),
(23, 1, 'admin/auth/users/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-11 09:49:28', '2023-05-11 09:49:28'),
(24, 1, 'admin/auth/users/1', 'PUT', '127.0.0.1', '{\"username\":\"admin\",\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"roles\":[\"1\",null],\"search_terms\":null,\"permissions\":[\"1\",null],\"_token\":\"M1qtDHUcGgvMLLtg3DBZPYV4neferSz5ZrD2oBdN\",\"_method\":\"PUT\"}', '2023-05-11 09:50:11', '2023-05-11 09:50:11'),
(25, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-11 09:50:12', '2023-05-11 09:50:12'),
(26, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-11 09:50:19', '2023-05-11 09:50:19'),
(27, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-11 09:50:58', '2023-05-11 09:50:58'),
(28, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 10:25:44', '2023-05-11 10:25:44'),
(29, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-11 10:26:04', '2023-05-11 10:26:04'),
(30, 5, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-11 10:27:52', '2023-05-11 10:27:52'),
(31, 5, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-11 10:32:14', '2023-05-11 10:32:14'),
(32, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 04:33:43', '2023-05-12 04:33:43'),
(33, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 05:05:05', '2023-05-12 05:05:05'),
(34, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 06:43:55', '2023-05-12 06:43:55'),
(35, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-12 06:44:07', '2023-05-12 06:44:07'),
(36, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 07:08:10', '2023-05-12 07:08:10'),
(37, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-12 07:08:16', '2023-05-12 07:08:16'),
(38, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 08:26:40', '2023-05-12 08:26:40'),
(39, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-12 08:26:47', '2023-05-12 08:26:47'),
(40, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 10:17:25', '2023-05-12 10:17:25'),
(41, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-12 10:17:40', '2023-05-12 10:17:40'),
(42, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 10:17:40', '2023-05-12 10:17:40'),
(43, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-12 10:17:59', '2023-05-12 10:17:59'),
(44, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 10:17:59', '2023-05-12 10:17:59'),
(45, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-12 10:18:19', '2023-05-12 10:18:19'),
(46, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-12 10:18:20', '2023-05-12 10:18:20'),
(47, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-12 10:18:28', '2023-05-12 10:18:28'),
(48, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-15 07:30:29', '2023-05-15 07:30:29'),
(49, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-15 07:30:58', '2023-05-15 07:30:58'),
(50, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-15 07:30:58', '2023-05-15 07:30:58'),
(51, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-15 07:31:08', '2023-05-15 07:31:08'),
(52, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 03:34:17', '2023-05-16 03:34:17'),
(53, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-16 03:34:31', '2023-05-16 03:34:31'),
(54, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 03:34:31', '2023-05-16 03:34:31'),
(55, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 03:35:39', '2023-05-16 03:35:39'),
(56, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 03:35:46', '2023-05-16 03:35:46'),
(57, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 14:55:04', '2023-05-16 14:55:04'),
(58, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 14:57:53', '2023-05-16 14:57:53'),
(59, 6, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-16 14:58:16', '2023-05-16 14:58:16'),
(60, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 14:58:16', '2023-05-16 14:58:16'),
(61, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 14:58:22', '2023-05-16 14:58:22'),
(62, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 14:59:17', '2023-05-16 14:59:17'),
(63, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 14:59:27', '2023-05-16 14:59:27'),
(64, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 14:59:34', '2023-05-16 14:59:34'),
(65, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 14:59:41', '2023-05-16 14:59:41'),
(66, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 15:01:38', '2023-05-16 15:01:38'),
(67, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 15:01:50', '2023-05-16 15:01:50'),
(68, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 15:02:02', '2023-05-16 15:02:02'),
(69, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-16 15:02:12', '2023-05-16 15:02:12'),
(70, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-16 15:02:16', '2023-05-16 15:02:16'),
(71, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-16 15:02:58', '2023-05-16 15:02:58'),
(72, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 15:03:06', '2023-05-16 15:03:06'),
(73, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 15:03:14', '2023-05-16 15:03:14'),
(74, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 15:03:25', '2023-05-16 15:03:25'),
(75, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 15:03:41', '2023-05-16 15:03:41'),
(76, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-16 15:03:56', '2023-05-16 15:03:56'),
(77, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-16 15:04:20', '2023-05-16 15:04:20'),
(78, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 15:04:53', '2023-05-16 15:04:53'),
(79, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-16 15:14:43', '2023-05-16 15:14:43'),
(80, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-16 15:15:44', '2023-05-16 15:15:44'),
(81, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 07:30:45', '2023-05-18 07:30:45'),
(82, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:31:05', '2023-05-18 07:31:05'),
(83, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"wrraqVEUU6P05iI8rV0hXtrY1Qx5Tm9nwtRGaNk3\"}', '2023-05-18 07:33:12', '2023-05-18 07:33:12'),
(84, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:33:13', '2023-05-18 07:33:13'),
(85, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:33:18', '2023-05-18 07:33:18'),
(86, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-align-justify\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wrraqVEUU6P05iI8rV0hXtrY1Qx5Tm9nwtRGaNk3\"}', '2023-05-18 07:34:27', '2023-05-18 07:34:27'),
(87, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:34:28', '2023-05-18 07:34:28'),
(88, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 07:34:34', '2023-05-18 07:34:34'),
(89, 1, 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"wrraqVEUU6P05iI8rV0hXtrY1Qx5Tm9nwtRGaNk3\",\"_method\":\"PUT\"}', '2023-05-18 07:34:42', '2023-05-18 07:34:42'),
(90, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:34:42', '2023-05-18 07:34:42'),
(91, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 07:34:47', '2023-05-18 07:34:47'),
(92, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 07:34:53', '2023-05-18 07:34:53'),
(93, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 07:36:43', '2023-05-18 07:36:43'),
(94, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 07:57:17', '2023-05-18 07:57:17'),
(95, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 07:57:24', '2023-05-18 07:57:24'),
(96, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 07:59:12', '2023-05-18 07:59:12'),
(97, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 07:59:29', '2023-05-18 07:59:29'),
(98, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 07:59:48', '2023-05-18 07:59:48'),
(99, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 07:59:54', '2023-05-18 07:59:54'),
(100, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 08:02:26', '2023-05-18 08:02:26'),
(101, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 08:02:30', '2023-05-18 08:02:30'),
(102, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 08:02:34', '2023-05-18 08:02:34'),
(103, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 08:05:39', '2023-05-18 08:05:39'),
(104, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 08:05:48', '2023-05-18 08:05:48'),
(105, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:06:13', '2023-05-18 08:06:13'),
(106, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:07:35', '2023-05-18 08:07:35'),
(107, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:07:39', '2023-05-18 08:07:39'),
(108, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 08:07:46', '2023-05-18 08:07:46'),
(109, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 08:09:57', '2023-05-18 08:09:57'),
(110, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:10:00', '2023-05-18 08:10:00'),
(111, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:10:03', '2023-05-18 08:10:03'),
(112, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:10:23', '2023-05-18 08:10:23'),
(113, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:10:27', '2023-05-18 08:10:27'),
(114, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:12:27', '2023-05-18 08:12:27'),
(115, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:12:30', '2023-05-18 08:12:30'),
(116, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:13:35', '2023-05-18 08:13:35'),
(117, 1, 'admin/form-sr4s/lang', 'GET', '127.0.0.1', '[]', '2023-05-18 08:13:47', '2023-05-18 08:13:47'),
(118, 1, 'admin/form-sr4s/fr', 'GET', '127.0.0.1', '[]', '2023-05-18 08:14:00', '2023-05-18 08:14:00'),
(119, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:15:14', '2023-05-18 08:15:14'),
(120, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:20:27', '2023-05-18 08:20:27'),
(121, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:21:19', '2023-05-18 08:21:19'),
(122, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:28:29', '2023-05-18 08:28:29'),
(123, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:29:35', '2023-05-18 08:29:35'),
(124, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:31:03', '2023-05-18 08:31:03'),
(125, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:32:06', '2023-05-18 08:32:06'),
(126, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:36:23', '2023-05-18 08:36:23'),
(127, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,application-category,company_initials,created_at,id,status,valid_from,valid_until\"}', '2023-05-18 08:36:27', '2023-05-18 08:36:27'),
(128, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 08:36:40', '2023-05-18 08:36:40'),
(129, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 08:39:20', '2023-05-18 08:39:20'),
(130, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:39:27', '2023-05-18 08:39:27'),
(131, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:40:15', '2023-05-18 08:40:15'),
(132, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:40:17', '2023-05-18 08:40:17'),
(133, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 08:40:31', '2023-05-18 08:40:31'),
(134, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 08:40:43', '2023-05-18 08:40:43'),
(135, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 08:45:08', '2023-05-18 08:45:08'),
(136, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 08:45:28', '2023-05-18 08:45:28'),
(137, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:45:36', '2023-05-18 08:45:36'),
(138, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:45:56', '2023-05-18 08:45:56'),
(139, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:54:46', '2023-05-18 08:54:46'),
(140, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:54:49', '2023-05-18 08:54:49'),
(141, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:55:10', '2023-05-18 08:55:10'),
(142, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:55:12', '2023-05-18 08:55:12'),
(143, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:55:51', '2023-05-18 08:55:51'),
(144, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 08:55:54', '2023-05-18 08:55:54'),
(145, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 09:07:49', '2023-05-18 09:07:49'),
(146, 1, 'admin/form-sr4s', 'POST', '127.0.0.1', '{\"administrator_id\":\"20\",\"application-category\":\"Est est assumenda pe\",\"address\":\"Ab officiis fuga Ni\",\"company_initials\":\"Best Bennett Traders\",\"premises_location\":\"Illum laboris sit\",\"years_of_experience\":\"2014\",\"experience_in\":\"Sequi corrupti quis\",\"dealers_in_other\":\"Molestiae do eos ius\",\"dealers_in\":\"Officia irure in in\",\"processing_of\":\"Tempore obcaecati s\",\"processing_of_other\":\"Pariatur Magnam eum\",\"marketing_of\":\"Explicabo Reiciendi\",\"marketing_of_other\":\"Dolorem sit veritat\",\"have_adequate_land\":\"off\",\"land_size\":\"35\",\"have_adequate_equipment\":\"off\",\"equipment\":\"Laboris et quibusdam\",\"have_contractual_agreement\":\"on\",\"have_contractual_agreement_cb\":\"on\",\"have_adequate_field_officers\":\"off\",\"have_conversant_seed_matters\":\"on\",\"have_conversant_seed_matters_cb\":\"on\",\"souce_of_seed\":\"Mollitia velit praes\",\"have_adequate_land_for_production\":\"off\",\"have_internal_quality_program\":\"off\",\"receipt\":\"Ut voluptatibus cons\",\"accept_declaration\":\"on\",\"accept_declaration_cb\":\"on\",\"valid_from\":\"2023-01-31 04:14:05\",\"valid_until\":\"2023-05-09 12:00:00\",\"status\":\"Amet deserunt totam\",\"inspector_id\":\"94\",\"status_comment\":\"Nobis id expedita u\",\"souce_of_seed_other\":\"Voluptatem ipsam dol\",\"_token\":\"D36qL5TiBJHq40MwkNwEECCh8hj1hkFyAxis0trq\",\"after-save\":\"view\"}', '2023-05-18 09:33:17', '2023-05-18 09:33:17'),
(147, 1, 'admin/form-sr4s/1', 'GET', '127.0.0.1', '[]', '2023-05-18 09:33:18', '2023-05-18 09:33:18'),
(148, 1, 'admin/form-sr4s/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 09:33:45', '2023-05-18 09:33:45'),
(149, 1, 'admin/form-sr4s/1', 'PUT', '127.0.0.1', '{\"administrator_id\":\"20\",\"application-category\":\"Est est assumenda pe\",\"address\":\"Ab officiis fuga Ni\",\"company_initials\":\"Best Bennett Traders\",\"premises_location\":\"Illum laboris sit\",\"years_of_experience\":\"2014\",\"experience_in\":\"Sequi corrupti quis\",\"dealers_in_other\":\"Molestiae do eos ius\",\"dealers_in\":\"Officia irure in in\",\"processing_of\":\"Tempore obcaecati s\",\"processing_of_other\":\"Pariatur Magnam eum\",\"marketing_of\":\"Explicabo Reiciendi\",\"marketing_of_other\":\"Dolorem sit veritat\",\"have_adequate_land\":\"0\",\"land_size\":\"35\",\"have_adequate_equipment\":\"0\",\"equipment\":\"Laboris et quibusdam\",\"have_contractual_agreement\":\"1\",\"have_contractual_agreement_cb\":\"on\",\"have_adequate_field_officers\":\"0\",\"have_conversant_seed_matters\":\"1\",\"have_conversant_seed_matters_cb\":\"on\",\"souce_of_seed\":\"Mollitia velit praes\",\"have_adequate_land_for_production\":\"0\",\"have_internal_quality_program\":\"on\",\"have_internal_quality_program_cb\":\"on\",\"receipt\":\"Ut voluptatibus cons\",\"accept_declaration\":\"1\",\"accept_declaration_cb\":\"on\",\"valid_from\":\"2023-01-31 04:14:05\",\"valid_until\":\"2023-05-09 12:00:00\",\"status\":\"Amet deserunt totam\",\"inspector_id\":\"94\",\"status_comment\":\"Nobis id expedita u\",\"souce_of_seed_other\":\"Voluptatem ipsam dol\",\"_token\":\"D36qL5TiBJHq40MwkNwEECCh8hj1hkFyAxis0trq\",\"_method\":\"PUT\"}', '2023-05-18 09:33:59', '2023-05-18 09:33:59'),
(150, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:33:59', '2023-05-18 09:33:59'),
(151, 1, 'admin/form-sr4s/1', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"D36qL5TiBJHq40MwkNwEECCh8hj1hkFyAxis0trq\"}', '2023-05-18 09:34:18', '2023-05-18 09:34:18'),
(152, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:34:19', '2023-05-18 09:34:19'),
(153, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 09:34:25', '2023-05-18 09:34:25'),
(154, 1, 'admin/form-sr4s', 'POST', '127.0.0.1', '{\"administrator_id\":\"95\",\"application-category\":\"Amet sit voluptas c\",\"address\":\"Veritatis expedita u\",\"company_initials\":\"Bean Frost Co\",\"premises_location\":\"Ab voluptas quis off\",\"years_of_experience\":\"1972\",\"experience_in\":\"Praesentium est non\",\"dealers_in_other\":\"Quia voluptatum in p\",\"dealers_in\":\"Rerum et ipsum quas\",\"processing_of\":\"Numquam et consectet\",\"processing_of_other\":\"Et consectetur dolo\",\"marketing_of\":\"Beatae sit non in ci\",\"marketing_of_other\":\"Deserunt iste natus\",\"have_adequate_land\":\"off\",\"land_size\":\"64\",\"have_adequate_equipment\":\"on\",\"have_adequate_equipment_cb\":\"on\",\"equipment\":\"Et sit neque labore\",\"have_contractual_agreement\":\"on\",\"have_contractual_agreement_cb\":\"on\",\"have_adequate_field_officers\":\"off\",\"have_conversant_seed_matters\":\"off\",\"souce_of_seed\":\"Provident perspicia\",\"have_adequate_land_for_production\":\"off\",\"have_internal_quality_program\":\"on\",\"have_internal_quality_program_cb\":\"on\",\"receipt\":\"Veritatis magni fugi\",\"accept_declaration\":\"on\",\"accept_declaration_cb\":\"on\",\"valid_from\":\"2023-05-18 07:58:51\",\"valid_until\":\"2023-05-16 12:00:00\",\"status\":\"Minus dolore earum u\",\"inspector_id\":\"64\",\"status_comment\":\"Dolor pariatur Esse\",\"souce_of_seed_other\":\"Duis sunt sint aute\",\"_token\":\"D36qL5TiBJHq40MwkNwEECCh8hj1hkFyAxis0trq\",\"after-save\":\"continue_creating\"}', '2023-05-18 09:34:44', '2023-05-18 09:34:44'),
(155, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 09:34:44', '2023-05-18 09:34:44'),
(156, 1, 'admin/form-sr4s', 'POST', '127.0.0.1', '{\"administrator_id\":\"16\",\"application-category\":\"Reprehenderit deser\",\"address\":\"Excepteur qui nulla\",\"company_initials\":\"Barber and Steele Trading\",\"premises_location\":\"Dicta blanditiis ape\",\"years_of_experience\":\"1972\",\"experience_in\":\"Id quia ipsam dolor\",\"dealers_in_other\":\"Minim sed ea sunt ve\",\"dealers_in\":\"Itaque voluptas quia\",\"processing_of\":\"Assumenda illum off\",\"processing_of_other\":\"Itaque aut est deser\",\"marketing_of\":\"Doloribus et dolorib\",\"marketing_of_other\":\"Hic et sit sit archi\",\"have_adequate_land\":\"on\",\"have_adequate_land_cb\":\"on\",\"land_size\":\"98\",\"have_adequate_equipment\":\"on\",\"have_adequate_equipment_cb\":\"on\",\"equipment\":\"Consectetur laborum\",\"have_contractual_agreement\":\"on\",\"have_contractual_agreement_cb\":\"on\",\"have_adequate_field_officers\":\"off\",\"have_conversant_seed_matters\":\"on\",\"have_conversant_seed_matters_cb\":\"on\",\"souce_of_seed\":\"Ducimus omnis natus\",\"have_adequate_land_for_production\":\"on\",\"have_adequate_land_for_production_cb\":\"on\",\"have_internal_quality_program\":\"on\",\"have_internal_quality_program_cb\":\"on\",\"receipt\":\"Dolorum dicta sunt q\",\"accept_declaration\":\"on\",\"accept_declaration_cb\":\"on\",\"valid_from\":\"2023-05-18 12:13:00\",\"valid_until\":null,\"status\":\"Voluptatem impedit\",\"inspector_id\":\"21\",\"status_comment\":\"Dolore veniam ea om\",\"souce_of_seed_other\":\"Voluptatem dolore a\",\"_token\":\"D36qL5TiBJHq40MwkNwEECCh8hj1hkFyAxis0trq\",\"after-save\":\"continue_editing\"}', '2023-05-18 09:35:09', '2023-05-18 09:35:09'),
(157, 1, 'admin/form-sr4s/3/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 09:35:09', '2023-05-18 09:35:09'),
(158, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:35:17', '2023-05-18 09:35:17'),
(159, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 09:35:56', '2023-05-18 09:35:56'),
(160, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 09:36:28', '2023-05-18 09:36:28'),
(161, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 09:37:22', '2023-05-18 09:37:22'),
(162, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:37:35', '2023-05-18 09:37:35'),
(163, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 09:37:40', '2023-05-18 09:37:40'),
(164, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:37:49', '2023-05-18 09:37:49'),
(165, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:41:43', '2023-05-18 09:41:43'),
(166, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 09:41:52', '2023-05-18 09:41:52'),
(167, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:41:56', '2023-05-18 09:41:56'),
(168, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:01', '2023-05-18 09:42:01'),
(169, 6, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:11', '2023-05-18 09:42:11'),
(170, 6, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:19', '2023-05-18 09:42:19'),
(171, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:35', '2023-05-18 09:42:35'),
(172, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:45', '2023-05-18 09:42:45'),
(173, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:42:48', '2023-05-18 09:42:48'),
(174, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:53:15', '2023-05-18 09:53:15'),
(175, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 09:53:52', '2023-05-18 09:53:52'),
(176, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:00:16', '2023-05-18 10:00:16'),
(177, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 10:00:34', '2023-05-18 10:00:34'),
(178, 1, 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"admin.SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"O13f2svIaIx32LU1izze9NKYnYn64V64Ayx2Mm8c\",\"_method\":\"PUT\"}', '2023-05-18 10:00:55', '2023-05-18 10:00:55'),
(179, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:00:56', '2023-05-18 10:00:56'),
(180, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:01:02', '2023-05-18 10:01:02'),
(181, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 10:01:11', '2023-05-18 10:01:11'),
(182, 1, 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"O13f2svIaIx32LU1izze9NKYnYn64V64Ayx2Mm8c\",\"_method\":\"PUT\"}', '2023-05-18 10:01:28', '2023-05-18 10:01:28'),
(183, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:01:28', '2023-05-18 10:01:28'),
(184, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 10:01:49', '2023-05-18 10:01:49'),
(185, 1, 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"admin.menu_titles.SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"O13f2svIaIx32LU1izze9NKYnYn64V64Ayx2Mm8c\",\"_method\":\"PUT\"}', '2023-05-18 10:02:16', '2023-05-18 10:02:16'),
(186, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:02:17', '2023-05-18 10:02:17'),
(187, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-18 10:02:23', '2023-05-18 10:02:23'),
(188, 1, 'admin/auth/menu/8', 'PUT', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"SR4 - Form\",\"icon\":\"icon-align-justify\",\"uri\":\"form-sr4s\",\"roles\":[null],\"permission\":null,\"_token\":\"O13f2svIaIx32LU1izze9NKYnYn64V64Ayx2Mm8c\",\"_method\":\"PUT\"}', '2023-05-18 10:02:33', '2023-05-18 10:02:33'),
(189, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-18 10:02:33', '2023-05-18 10:02:33'),
(190, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:04:49', '2023-05-18 10:04:49'),
(191, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:04:53', '2023-05-18 10:04:53'),
(192, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:05:44', '2023-05-18 10:05:44'),
(193, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:06:19', '2023-05-18 10:06:19'),
(194, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:50:09', '2023-05-18 10:50:09'),
(195, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:50:14', '2023-05-18 10:50:14'),
(196, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:51:12', '2023-05-18 10:51:12'),
(197, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:52:03', '2023-05-18 10:52:03'),
(198, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 10:52:16', '2023-05-18 10:52:16'),
(199, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 10:52:31', '2023-05-18 10:52:31'),
(200, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 10:52:40', '2023-05-18 10:52:40'),
(201, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:52:47', '2023-05-18 10:52:47'),
(202, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:58:38', '2023-05-18 10:58:38'),
(203, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:58:42', '2023-05-18 10:58:42'),
(204, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 10:59:17', '2023-05-18 10:59:17'),
(205, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:24:56', '2023-05-18 11:24:56'),
(206, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:25:09', '2023-05-18 11:25:09'),
(207, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-18 11:25:14', '2023-05-18 11:25:14'),
(208, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-18 11:25:38', '2023-05-18 11:25:38'),
(209, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-18 11:25:47', '2023-05-18 11:25:47'),
(210, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:25:52', '2023-05-18 11:25:52'),
(211, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:27:31', '2023-05-18 11:27:31'),
(212, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:35:25', '2023-05-18 11:35:25'),
(213, 1, 'admin/form-sr4s/create', 'GET', '127.0.0.1', '[]', '2023-05-18 11:37:58', '2023-05-18 11:37:58'),
(214, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:12:15', '2023-05-19 03:12:15'),
(215, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-19 03:12:30', '2023-05-19 03:12:30'),
(216, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:13:32', '2023-05-19 03:13:32'),
(217, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:15:59', '2023-05-19 03:15:59'),
(218, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:16:19', '2023-05-19 03:16:19'),
(219, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:17:16', '2023-05-19 03:17:16'),
(220, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:17:18', '2023-05-19 03:17:18'),
(221, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:19:04', '2023-05-19 03:19:04'),
(222, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:20:53', '2023-05-19 03:20:53'),
(223, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:21:54', '2023-05-19 03:21:54'),
(224, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:21:59', '2023-05-19 03:21:59'),
(225, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:22:02', '2023-05-19 03:22:02'),
(226, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-19 03:24:15', '2023-05-19 03:24:15'),
(227, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:24:21', '2023-05-19 03:24:21'),
(228, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:30:09', '2023-05-19 03:30:09'),
(229, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:30:52', '2023-05-19 03:30:52'),
(230, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:31:45', '2023-05-19 03:31:45'),
(231, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:32:44', '2023-05-19 03:32:44'),
(232, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:33:04', '2023-05-19 03:33:04'),
(233, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:33:09', '2023-05-19 03:33:09'),
(234, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:34:02', '2023-05-19 03:34:02'),
(235, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:34:10', '2023-05-19 03:34:10'),
(236, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:35:15', '2023-05-19 03:35:15'),
(237, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:36:03', '2023-05-19 03:36:03'),
(238, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-05-19 03:36:15', '2023-05-19 03:36:15'),
(239, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:36:35', '2023-05-19 03:36:35'),
(240, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:37:56', '2023-05-19 03:37:56'),
(241, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:41:21', '2023-05-19 03:41:21'),
(242, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:42:37', '2023-05-19 03:42:37'),
(243, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:43:44', '2023-05-19 03:43:44'),
(244, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:44:27', '2023-05-19 03:44:27'),
(245, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:47:33', '2023-05-19 03:47:33'),
(246, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:48:01', '2023-05-19 03:48:01'),
(247, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:48:03', '2023-05-19 03:48:03'),
(248, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:48:19', '2023-05-19 03:48:19'),
(249, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 03:49:29', '2023-05-19 03:49:29'),
(250, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 03:52:25', '2023-05-19 03:52:25'),
(251, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 03:53:13', '2023-05-19 03:53:13'),
(252, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 03:54:54', '2023-05-19 03:54:54'),
(253, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 03:55:11', '2023-05-19 03:55:11'),
(254, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 03:57:02', '2023-05-19 03:57:02'),
(255, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 03:57:26', '2023-05-19 03:57:26'),
(256, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:57:31', '2023-05-19 03:57:31'),
(257, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:57:33', '2023-05-19 03:57:33'),
(258, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:59:49', '2023-05-19 03:59:49'),
(259, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 03:59:52', '2023-05-19 03:59:52'),
(260, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:00:09', '2023-05-19 04:00:09'),
(261, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:00:48', '2023-05-19 04:00:48'),
(262, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:01:38', '2023-05-19 04:01:38'),
(263, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:03:09', '2023-05-19 04:03:09'),
(264, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:03:49', '2023-05-19 04:03:49'),
(265, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:03:52', '2023-05-19 04:03:52'),
(266, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 04:03:58', '2023-05-19 04:03:58'),
(267, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:04:01', '2023-05-19 04:04:01'),
(268, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:06:07', '2023-05-19 04:06:07'),
(269, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:06:47', '2023-05-19 04:06:47'),
(270, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:07:11', '2023-05-19 04:07:11'),
(271, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:07:25', '2023-05-19 04:07:25'),
(272, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:07:28', '2023-05-19 04:07:28'),
(273, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:08:18', '2023-05-19 04:08:18'),
(274, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:09:14', '2023-05-19 04:09:14'),
(275, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:09:17', '2023-05-19 04:09:17'),
(276, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:09:50', '2023-05-19 04:09:50'),
(277, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:10:48', '2023-05-19 04:10:48'),
(278, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:11:59', '2023-05-19 04:11:59'),
(279, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-19 04:12:08', '2023-05-19 04:12:08'),
(280, 1, 'admin/form-sr4s/2', 'GET', '127.0.0.1', '[]', '2023-05-19 04:12:12', '2023-05-19 04:12:12'),
(281, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:12:24', '2023-05-19 04:12:24'),
(282, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:13:45', '2023-05-19 04:13:45'),
(283, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:14:35', '2023-05-19 04:14:35'),
(284, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:14:39', '2023-05-19 04:14:39'),
(285, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:15:32', '2023-05-19 04:15:32'),
(286, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:15:58', '2023-05-19 04:15:58'),
(287, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:16:01', '2023-05-19 04:16:01'),
(288, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:16:25', '2023-05-19 04:16:25'),
(289, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:16:28', '2023-05-19 04:16:28'),
(290, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:16:46', '2023-05-19 04:16:46'),
(291, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:16:49', '2023-05-19 04:16:49'),
(292, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:17:37', '2023-05-19 04:17:37'),
(293, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:17:41', '2023-05-19 04:17:41'),
(294, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:18:10', '2023-05-19 04:18:10'),
(295, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:19:13', '2023-05-19 04:19:13'),
(296, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:20:03', '2023-05-19 04:20:03'),
(297, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:20:57', '2023-05-19 04:20:57'),
(298, 1, 'admin/form-sr4s/2/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 04:22:23', '2023-05-19 04:22:23'),
(299, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:22:26', '2023-05-19 04:22:26'),
(300, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 04:23:47', '2023-05-19 04:23:47'),
(301, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-19 04:23:53', '2023-05-19 04:23:53'),
(302, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-19 04:34:27', '2023-05-19 04:34:27'),
(303, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-19 04:35:12', '2023-05-19 04:35:12'),
(304, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '[]', '2023-05-19 04:57:37', '2023-05-19 04:57:37'),
(305, 1, 'admin/helpers/terminal/database', 'GET', '127.0.0.1', '[]', '2023-05-19 04:57:46', '2023-05-19 04:57:46'),
(306, 1, 'admin/helpers/terminal/artisan', 'GET', '127.0.0.1', '[]', '2023-05-19 04:57:50', '2023-05-19 04:57:50'),
(307, 1, 'admin/helpers/routes', 'GET', '127.0.0.1', '[]', '2023-05-19 04:57:55', '2023-05-19 04:57:55'),
(308, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-19 10:00:13', '2023-05-19 10:00:13'),
(309, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-05-19 10:00:31', '2023-05-19 10:00:31'),
(310, 1, 'admin/auth/roles/1/edit', 'GET', '127.0.0.1', '[]', '2023-05-19 10:00:42', '2023-05-19 10:00:42'),
(311, 1, 'admin/auth/roles/1', 'PUT', '127.0.0.1', '{\"slug\":\"developer\",\"name\":\"Developer\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",null],\"_token\":\"HRJo9zmW76LHEDhIdg1uig4fdd1PzJwJn7uiIpgt\",\"_method\":\"PUT\"}', '2023-05-19 10:02:19', '2023-05-19 10:02:19'),
(312, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-05-19 10:02:19', '2023-05-19 10:02:19'),
(313, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '[]', '2023-05-19 10:02:28', '2023-05-19 10:02:28'),
(314, 1, 'admin/auth/roles', 'POST', '127.0.0.1', '{\"slug\":\"administrator\",\"name\":\"Administrator\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",null],\"_token\":\"HRJo9zmW76LHEDhIdg1uig4fdd1PzJwJn7uiIpgt\"}', '2023-05-19 10:03:37', '2023-05-19 10:03:37'),
(315, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-05-19 10:03:37', '2023-05-19 10:03:37'),
(316, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-22 10:48:15', '2023-05-22 10:48:15'),
(317, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-22 10:49:29', '2023-05-22 10:49:29'),
(318, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-22 10:49:29', '2023-05-22 10:49:29'),
(319, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-22 10:49:42', '2023-05-22 10:49:42'),
(320, 1, 'admin/auth/menu/8/edit', 'GET', '127.0.0.1', '[]', '2023-05-22 10:50:13', '2023-05-22 10:50:13'),
(321, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-22 10:50:25', '2023-05-22 10:50:25'),
(322, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:09', '2023-05-23 10:48:09'),
(323, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:27', '2023-05-23 10:48:27'),
(324, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:40', '2023-05-23 10:48:40'),
(325, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:40', '2023-05-23 10:48:40'),
(326, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:46', '2023-05-23 10:48:46'),
(327, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:49', '2023-05-23 10:48:49'),
(328, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-05-23 10:48:56', '2023-05-23 10:48:56'),
(329, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-23 10:51:18', '2023-05-23 10:51:18'),
(330, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"9\",\"search_terms\":null,\"title\":\"sr6\",\"icon\":\"icon-american-sign-language-interpreting\",\"uri\":\"form-sr6s\",\"roles\":[null],\"permission\":null,\"_token\":\"Z0PXd4r5i68AUosNRaC4dZtdGnhQn1cW8xVSCkoN\"}', '2023-05-23 10:51:57', '2023-05-23 10:51:57'),
(331, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-23 10:51:58', '2023-05-23 10:51:58'),
(332, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:08', '2023-05-23 10:52:08'),
(333, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:12', '2023-05-23 10:52:12'),
(334, 1, 'admin/form-sr6s/create', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:17', '2023-05-23 10:52:17'),
(335, 1, 'admin/form-sr6s', 'POST', '127.0.0.1', '{\"administrator_id\":\"3\",\"application-category\":\"Necessitatibus sint\",\"address\":\"In unde blanditiis u\",\"company_initials\":\"Koch Higgins Associates\",\"_token\":\"Z0PXd4r5i68AUosNRaC4dZtdGnhQn1cW8xVSCkoN\"}', '2023-05-23 10:52:23', '2023-05-23 10:52:23'),
(336, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:24', '2023-05-23 10:52:24'),
(337, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:28', '2023-05-23 10:52:28'),
(338, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:29', '2023-05-23 10:52:29'),
(339, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:30', '2023-05-23 10:52:30'),
(340, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:30', '2023-05-23 10:52:30'),
(341, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:31', '2023-05-23 10:52:31'),
(342, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:32', '2023-05-23 10:52:32'),
(343, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:33', '2023-05-23 10:52:33'),
(344, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:34', '2023-05-23 10:52:34'),
(345, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:35', '2023-05-23 10:52:35'),
(346, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:36', '2023-05-23 10:52:36'),
(347, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:37', '2023-05-23 10:52:37'),
(348, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:38', '2023-05-23 10:52:38'),
(349, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:39', '2023-05-23 10:52:39'),
(350, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:40', '2023-05-23 10:52:40'),
(351, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:41', '2023-05-23 10:52:41'),
(352, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:42', '2023-05-23 10:52:42'),
(353, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:43', '2023-05-23 10:52:43'),
(354, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:43', '2023-05-23 10:52:43'),
(355, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:44', '2023-05-23 10:52:44'),
(356, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:45', '2023-05-23 10:52:45'),
(357, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:52:46', '2023-05-23 10:52:46'),
(358, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:26', '2023-05-23 10:53:26'),
(359, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:27', '2023-05-23 10:53:27'),
(360, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:28', '2023-05-23 10:53:28'),
(361, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:28', '2023-05-23 10:53:28'),
(362, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:29', '2023-05-23 10:53:29'),
(363, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:30', '2023-05-23 10:53:30'),
(364, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:31', '2023-05-23 10:53:31'),
(365, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:32', '2023-05-23 10:53:32'),
(366, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:33', '2023-05-23 10:53:33'),
(367, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:34', '2023-05-23 10:53:34'),
(368, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:35', '2023-05-23 10:53:35'),
(369, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:35', '2023-05-23 10:53:35'),
(370, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:36', '2023-05-23 10:53:36'),
(371, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:37', '2023-05-23 10:53:37'),
(372, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:38', '2023-05-23 10:53:38'),
(373, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:39', '2023-05-23 10:53:39'),
(374, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:40', '2023-05-23 10:53:40'),
(375, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:41', '2023-05-23 10:53:41'),
(376, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:42', '2023-05-23 10:53:42'),
(377, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:43', '2023-05-23 10:53:43'),
(378, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:53:44', '2023-05-23 10:53:44'),
(379, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 10:59:26', '2023-05-23 10:59:26'),
(380, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:02:57', '2023-05-23 11:02:57'),
(381, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:05:02', '2023-05-23 11:05:02'),
(382, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:06:43', '2023-05-23 11:06:43'),
(383, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:19:45', '2023-05-23 11:19:45'),
(384, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:23', '2023-05-23 11:23:23'),
(385, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:28', '2023-05-23 11:23:28'),
(386, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:34', '2023-05-23 11:23:34'),
(387, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:35', '2023-05-23 11:23:35'),
(388, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:35', '2023-05-23 11:23:35'),
(389, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:36', '2023-05-23 11:23:36'),
(390, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:37', '2023-05-23 11:23:37'),
(391, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:38', '2023-05-23 11:23:38'),
(392, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:39', '2023-05-23 11:23:39'),
(393, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:40', '2023-05-23 11:23:40'),
(394, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:41', '2023-05-23 11:23:41'),
(395, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:42', '2023-05-23 11:23:42'),
(396, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:43', '2023-05-23 11:23:43'),
(397, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:44', '2023-05-23 11:23:44'),
(398, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:45', '2023-05-23 11:23:45'),
(399, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:45', '2023-05-23 11:23:45'),
(400, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:46', '2023-05-23 11:23:46'),
(401, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:47', '2023-05-23 11:23:47'),
(402, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:48', '2023-05-23 11:23:48'),
(403, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:49', '2023-05-23 11:23:49'),
(404, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:50', '2023-05-23 11:23:50'),
(405, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:51', '2023-05-23 11:23:51');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(406, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:23:52', '2023-05-23 11:23:52'),
(407, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:24:25', '2023-05-23 11:24:25'),
(408, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:26:00', '2023-05-23 11:26:00'),
(409, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:27:00', '2023-05-23 11:27:00'),
(410, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:27:49', '2023-05-23 11:27:49'),
(411, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 11:28:01', '2023-05-23 11:28:01'),
(412, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '{\"_export_\":\"all\"}', '2023-05-23 11:28:09', '2023-05-23 11:28:09'),
(413, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-23 11:34:00', '2023-05-23 11:34:00'),
(414, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:34:03', '2023-05-23 11:34:03'),
(415, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:35:00', '2023-05-23 11:35:00'),
(416, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:35:03', '2023-05-23 11:35:03'),
(417, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-23 11:35:34', '2023-05-23 11:35:34'),
(418, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-05-25 10:09:02', '2023-05-25 10:09:02'),
(419, 1, 'admin/form-sr6s', 'GET', '127.0.0.1', '[]', '2023-05-25 10:09:08', '2023-05-25 10:09:08'),
(420, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-25 10:09:12', '2023-05-25 10:09:12'),
(421, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-25 10:10:35', '2023-05-25 10:10:35'),
(422, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-25 10:10:40', '2023-05-25 10:10:40'),
(423, 1, 'admin/form-sr6s/1', 'GET', '127.0.0.1', '[]', '2023-05-25 10:23:14', '2023-05-25 10:23:14'),
(424, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-02 04:20:07', '2023-06-02 04:20:07'),
(425, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:20:19', '2023-06-02 04:20:19'),
(426, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,qr_code\"}', '2023-06-02 04:22:32', '2023-06-02 04:22:32'),
(427, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '{\"_columns_\":\"administrator_id,qr_code\"}', '2023-06-02 04:28:47', '2023-06-02 04:28:47'),
(428, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:29:31', '2023-06-02 04:29:31'),
(429, 1, 'admin/form-sr4s/2', 'GET', '127.0.0.1', '[]', '2023-06-02 04:29:45', '2023-06-02 04:29:45'),
(430, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:30:18', '2023-06-02 04:30:18'),
(431, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:31:35', '2023-06-02 04:31:35'),
(432, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:35:07', '2023-06-02 04:35:07'),
(433, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:35:10', '2023-06-02 04:35:10'),
(434, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 04:35:39', '2023-06-02 04:35:39'),
(435, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 05:16:41', '2023-06-02 05:16:41'),
(436, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-06-02 05:16:56', '2023-06-02 05:16:56'),
(437, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-02 05:16:57', '2023-06-02 05:16:57'),
(438, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-06-02 05:34:34', '2023-06-02 05:34:34'),
(439, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-02 05:34:36', '2023-06-02 05:34:36'),
(440, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 05:34:46', '2023-06-02 05:34:46'),
(441, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 05:48:34', '2023-06-02 05:48:34'),
(442, 1, 'admin/form-sr4s', 'GET', '127.0.0.1', '[]', '2023-06-02 05:49:22', '2023-06-02 05:49:22'),
(443, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-05 03:20:48', '2023-06-05 03:20:48'),
(444, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 03:21:05', '2023-06-05 03:21:05'),
(445, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Track And Trace\",\"icon\":\"icon-mask\",\"uri\":\"track-and-trace\",\"roles\":[null],\"permission\":null,\"_token\":\"YayZoisg2Ptrbjd0SBieNkx1Qyh8t0h45vurj6QA\"}', '2023-06-05 03:22:46', '2023-06-05 03:22:46'),
(446, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 03:22:47', '2023-06-05 03:22:47'),
(447, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 03:22:51', '2023-06-05 03:22:51'),
(448, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:24:39', '2023-06-05 03:24:39'),
(449, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:25:35', '2023-06-05 03:25:35'),
(450, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:28:40', '2023-06-05 03:28:40'),
(451, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:29:48', '2023-06-05 03:29:48'),
(452, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:29:54', '2023-06-05 03:29:54'),
(453, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:31:03', '2023-06-05 03:31:03'),
(454, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:31:54', '2023-06-05 03:31:54'),
(455, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:32:36', '2023-06-05 03:32:36'),
(456, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:33:12', '2023-06-05 03:33:12'),
(457, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:35:14', '2023-06-05 03:35:14'),
(458, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:38:10', '2023-06-05 03:38:10'),
(459, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:39:31', '2023-06-05 03:39:31'),
(460, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:40:06', '2023-06-05 03:40:06'),
(461, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:40:41', '2023-06-05 03:40:41'),
(462, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:40:56', '2023-06-05 03:40:56'),
(463, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:43:16', '2023-06-05 03:43:16'),
(464, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 03:43:27', '2023-06-05 03:43:27'),
(465, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 03:43:31', '2023-06-05 03:43:31'),
(466, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:43:35', '2023-06-05 03:43:35'),
(467, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:47:49', '2023-06-05 03:47:49'),
(468, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:48:17', '2023-06-05 03:48:17'),
(469, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:48:30', '2023-06-05 03:48:30'),
(470, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:50:16', '2023-06-05 03:50:16'),
(471, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:51:08', '2023-06-05 03:51:08'),
(472, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:51:28', '2023-06-05 03:51:28'),
(473, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:53:31', '2023-06-05 03:53:31'),
(474, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:54:47', '2023-06-05 03:54:47'),
(475, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:56:31', '2023-06-05 03:56:31'),
(476, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:58:15', '2023-06-05 03:58:15'),
(477, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:58:43', '2023-06-05 03:58:43'),
(478, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:59:55', '2023-06-05 03:59:55'),
(479, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 03:59:59', '2023-06-05 03:59:59'),
(480, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:00:31', '2023-06-05 04:00:31'),
(481, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:01:26', '2023-06-05 04:01:26'),
(482, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:08:04', '2023-06-05 04:08:04'),
(483, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:09:33', '2023-06-05 04:09:33'),
(484, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:10:06', '2023-06-05 04:10:06'),
(485, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:14:44', '2023-06-05 04:14:44'),
(486, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:15:21', '2023-06-05 04:15:21'),
(487, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:15:32', '2023-06-05 04:15:32'),
(488, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:17:12', '2023-06-05 04:17:12'),
(489, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:19:53', '2023-06-05 04:19:53'),
(490, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:25:20', '2023-06-05 04:25:20'),
(491, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:29:47', '2023-06-05 04:29:47'),
(492, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:30:15', '2023-06-05 04:30:15'),
(493, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:31:35', '2023-06-05 04:31:35'),
(494, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:34:14', '2023-06-05 04:34:14'),
(495, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:35:19', '2023-06-05 04:35:19'),
(496, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:37:10', '2023-06-05 04:37:10'),
(497, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:38:41', '2023-06-05 04:38:41'),
(498, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:41:55', '2023-06-05 04:41:55'),
(499, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:44:52', '2023-06-05 04:44:52'),
(500, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:46:32', '2023-06-05 04:46:32'),
(501, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:48:32', '2023-06-05 04:48:32'),
(502, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:50:01', '2023-06-05 04:50:01'),
(503, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:50:37', '2023-06-05 04:50:37'),
(504, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:51:27', '2023-06-05 04:51:27'),
(505, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 04:51:36', '2023-06-05 04:51:36'),
(506, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-05 04:51:40', '2023-06-05 04:51:40'),
(507, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:52:06', '2023-06-05 04:52:06'),
(508, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 04:53:57', '2023-06-05 04:53:57'),
(509, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 05:08:03', '2023-06-05 05:08:03'),
(510, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 05:41:13', '2023-06-05 05:41:13'),
(511, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 05:43:35', '2023-06-05 05:43:35'),
(512, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 05:49:04', '2023-06-05 05:49:04'),
(513, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 05:49:17', '2023-06-05 05:49:17'),
(514, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 06:25:46', '2023-06-05 06:25:46'),
(515, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 06:31:57', '2023-06-05 06:31:57'),
(516, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 06:48:22', '2023-06-05 06:48:22'),
(517, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 06:49:26', '2023-06-05 06:49:26'),
(518, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 07:02:33', '2023-06-05 07:02:33'),
(519, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 07:02:39', '2023-06-05 07:02:39'),
(520, 1, 'admin/track-and-trace', 'POST', '127.0.0.1', '{\"_token\":\"YayZoisg2Ptrbjd0SBieNkx1Qyh8t0h45vurj6QA\",\"lot_number\":\"2\"}', '2023-06-05 07:02:44', '2023-06-05 07:02:44'),
(521, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 07:09:42', '2023-06-05 07:09:42'),
(522, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 07:09:44', '2023-06-05 07:09:44'),
(523, 1, 'admin/track-and-trace', 'POST', '127.0.0.1', '{\"_token\":\"YayZoisg2Ptrbjd0SBieNkx1Qyh8t0h45vurj6QA\",\"lot_number\":\"2\"}', '2023-06-05 07:09:51', '2023-06-05 07:09:51'),
(524, 1, 'admin/auth/login', 'GET', '127.0.0.1', '[]', '2023-06-05 09:03:48', '2023-06-05 09:03:48'),
(525, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-05 09:03:48', '2023-06-05 09:03:48'),
(526, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:03:54', '2023-06-05 09:03:54'),
(527, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:08:10', '2023-06-05 09:08:10'),
(528, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:08:37', '2023-06-05 09:08:37'),
(529, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:20:10', '2023-06-05 09:20:10'),
(530, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:23:33', '2023-06-05 09:23:33'),
(531, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:30:13', '2023-06-05 09:30:13'),
(532, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:32:17', '2023-06-05 09:32:17'),
(533, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:37:37', '2023-06-05 09:37:37'),
(534, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:38:36', '2023-06-05 09:38:36'),
(535, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:41:00', '2023-06-05 09:41:00'),
(536, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:42:32', '2023-06-05 09:42:32'),
(537, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:43:32', '2023-06-05 09:43:32'),
(538, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:45:59', '2023-06-05 09:45:59'),
(539, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:46:54', '2023-06-05 09:46:54'),
(540, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:47:23', '2023-06-05 09:47:23'),
(541, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:49:45', '2023-06-05 09:49:45'),
(542, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:52:41', '2023-06-05 09:52:41'),
(543, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 09:53:24', '2023-06-05 09:53:24'),
(544, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 10:30:52', '2023-06-05 10:30:52'),
(545, 1, 'admin/scheduling', 'GET', '127.0.0.1', '[]', '2023-06-05 10:34:31', '2023-06-05 10:34:31'),
(546, 1, 'admin/scheduling', 'GET', '127.0.0.1', '[]', '2023-06-05 10:54:57', '2023-06-05 10:54:57'),
(547, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-05 10:55:30', '2023-06-05 10:55:30'),
(548, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-14 03:23:22', '2023-06-14 03:23:22'),
(549, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-14 03:23:32', '2023-06-14 03:23:32'),
(550, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-14 03:29:25', '2023-06-14 03:29:25'),
(551, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-14 10:27:46', '2023-06-14 10:27:46'),
(552, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-14 10:27:55', '2023-06-14 10:27:55'),
(553, 1, 'admin/track-and-trace', 'GET', '127.0.0.1', '[]', '2023-06-14 10:34:03', '2023-06-14 10:34:03'),
(554, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 08:13:39', '2023-06-20 08:13:39'),
(555, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 08:14:29', '2023-06-20 08:14:29'),
(556, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 08:16:29', '2023-06-20 08:16:29'),
(557, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 08:16:37', '2023-06-20 08:16:37'),
(558, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-06-20 08:16:40', '2023-06-20 08:16:40'),
(559, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 08:17:14', '2023-06-20 08:17:14'),
(560, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 08:53:45', '2023-06-20 08:53:45'),
(561, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 08:53:56', '2023-06-20 08:53:56'),
(562, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 09:12:36', '2023-06-20 09:12:36'),
(563, 1, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"c244ausC7KNi7zHYZ2FJiVacoK4yR5Leimc8zWWt\",\"username\":\"admin\",\"password\":\"*****-filtered-out-*****\"}', '2023-06-20 10:07:56', '2023-06-20 10:07:56'),
(564, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 10:07:56', '2023-06-20 10:07:56'),
(565, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 10:08:03', '2023-06-20 10:08:03'),
(566, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 10:20:06', '2023-06-20 10:20:06'),
(567, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 10:20:15', '2023-06-20 10:20:15'),
(568, 8, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 10:56:32', '2023-06-20 10:56:32'),
(569, 8, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 10:57:00', '2023-06-20 10:57:00'),
(570, 8, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 11:02:55', '2023-06-20 11:02:55'),
(571, 8, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 11:05:46', '2023-06-20 11:05:46'),
(572, 8, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 11:07:19', '2023-06-20 11:07:19'),
(573, 8, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-20 11:11:51', '2023-06-20 11:11:51'),
(574, 8, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-20 11:20:44', '2023-06-20 11:20:44'),
(575, 18, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"uXP4IcpAj1nblZ4rOOajUleTw4h7YmNe9sHYx0Uo\",\"username\":\"nomukezi\",\"password\":\"*****-filtered-out-*****\"}', '2023-06-20 12:09:10', '2023-06-20 12:09:10'),
(580, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-21 05:04:13', '2023-06-21 05:04:13'),
(581, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:04:22', '2023-06-21 05:04:22'),
(582, 1, 'admin/auth/menu/19', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:04:30', '2023-06-21 05:04:30'),
(583, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:04:31', '2023-06-21 05:04:31'),
(584, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:14', '2023-06-21 05:05:14'),
(585, 1, 'admin/auth/menu/9', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:05:19', '2023-06-21 05:05:19'),
(586, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:20', '2023-06-21 05:05:20'),
(587, 1, 'admin/auth/menu/10', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:05:39', '2023-06-21 05:05:39'),
(588, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:39', '2023-06-21 05:05:39'),
(589, 1, 'admin/auth/menu/15', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:05:45', '2023-06-21 05:05:45'),
(590, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:46', '2023-06-21 05:05:46'),
(591, 1, 'admin/auth/menu/16', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:05:49', '2023-06-21 05:05:49'),
(592, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:50', '2023-06-21 05:05:50'),
(593, 1, 'admin/auth/menu/17', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:05:53', '2023-06-21 05:05:53'),
(594, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:54', '2023-06-21 05:05:54'),
(595, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:05:57', '2023-06-21 05:05:57'),
(596, 1, 'admin/_handle_action_', 'POST', '127.0.0.1', '{\"_model\":\"OpenAdmin_Admin_Auth_Database_OperationLog\",\"_action\":\"OpenAdmin_Admin_Grid_Tools_BatchDelete\",\"_key\":\"579,578,577,576\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:08:10', '2023-06-21 05:08:10'),
(597, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:08:29', '2023-06-21 05:08:29'),
(598, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-file-alt\",\"uri\":null,\"roles\":[null],\"permission\":\"*\",\"_token\":\"Fr0T5M61wo5APkgOxxB0W1v58DbmtHaSwRerdUXd\"}', '2023-06-21 05:09:46', '2023-06-21 05:09:46'),
(599, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 05:09:46', '2023-06-21 05:09:46'),
(600, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-21 08:13:21', '2023-06-21 08:13:21'),
(601, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:13:36', '2023-06-21 08:13:36'),
(602, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[null],\"permission\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:15:28', '2023-06-21 08:15:28'),
(603, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:15:28', '2023-06-21 08:15:28'),
(604, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"System settings\",\"icon\":\"icon-anchor\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:16:51', '2023-06-21 08:16:51'),
(605, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:16:51', '2023-06-21 08:16:51'),
(606, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"22\",\"search_terms\":null,\"title\":\"Crops\",\"icon\":\"icon-seedling\",\"uri\":\"crops\",\"roles\":[null],\"permission\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:17:16', '2023-06-21 08:17:16'),
(607, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:17:16', '2023-06-21 08:17:16'),
(608, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"22\",\"search_terms\":null,\"title\":\"Crop Varieties\",\"icon\":\"icon-asterisk\",\"uri\":\"crop-varieties\",\"roles\":[null],\"permission\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:18:09', '2023-06-21 08:18:09'),
(609, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:18:09', '2023-06-21 08:18:09'),
(610, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:18:11', '2023-06-21 08:18:11'),
(611, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:18:16', '2023-06-21 08:18:16'),
(612, 1, 'admin/crop-varieties', 'GET', '127.0.0.1', '[]', '2023-06-21 08:18:21', '2023-06-21 08:18:21'),
(613, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 08:18:32', '2023-06-21 08:18:32'),
(614, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:22:30', '2023-06-21 08:22:30'),
(615, 1, 'admin/auth/menu/24', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:22:36', '2023-06-21 08:22:36'),
(616, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:22:36', '2023-06-21 08:22:36'),
(617, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-21 08:23:02', '2023-06-21 08:23:02'),
(618, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:23:07', '2023-06-21 08:23:07'),
(619, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-06-21 08:23:09', '2023-06-21 08:23:09'),
(620, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-06-21 08:26:36', '2023-06-21 08:26:36'),
(621, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_inspections\":\"5\",\"number_of_days_before_submission\":\"5\",\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Rafael Harrington Maize\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":null,\"id\":null,\"_remove_\":\"1\"},\"new_3\":{\"crop_variety_name\":null,\"id\":null,\"_remove_\":\"1\"},\"new_4\":{\"crop_variety_name\":\"Pokato Maize\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:28:38', '2023-06-21 08:28:38'),
(622, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:28:39', '2023-06-21 08:28:39'),
(623, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:28:49', '2023-06-21 08:28:49'),
(624, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:29:03', '2023-06-21 08:29:03'),
(625, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:32:32', '2023-06-21 08:32:32'),
(626, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:32:46', '2023-06-21 08:32:46'),
(627, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:33:19', '2023-06-21 08:33:19'),
(628, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:33:43', '2023-06-21 08:33:43'),
(629, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:33:55', '2023-06-21 08:33:55'),
(630, 1, 'admin/crops/1', 'GET', '127.0.0.1', '{\"_export_\":\"all\",\"crop_id\":\"1\"}', '2023-06-21 08:33:59', '2023-06-21 08:33:59'),
(631, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:34:21', '2023-06-21 08:34:21'),
(632, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:34:44', '2023-06-21 08:34:44'),
(633, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:34:51', '2023-06-21 08:34:51'),
(634, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:40:18', '2023-06-21 08:40:18'),
(635, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:40:52', '2023-06-21 08:40:52'),
(636, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:40:54', '2023-06-21 08:40:54'),
(637, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:40:59', '2023-06-21 08:40:59'),
(638, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:41:32', '2023-06-21 08:41:32'),
(639, 1, 'admin/crop-varieties/1/edit', 'GET', '127.0.0.1', '[]', '2023-06-21 08:41:37', '2023-06-21 08:41:37'),
(640, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:41:45', '2023-06-21 08:41:45'),
(641, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:41:52', '2023-06-21 08:41:52'),
(642, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:41:56', '2023-06-21 08:41:56'),
(643, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:51:12', '2023-06-21 08:51:12'),
(644, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:16', '2023-06-21 08:51:16'),
(645, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:19', '2023-06-21 08:51:19'),
(646, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:19', '2023-06-21 08:51:19'),
(647, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:20', '2023-06-21 08:51:20'),
(648, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:21', '2023-06-21 08:51:21'),
(649, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:22', '2023-06-21 08:51:22'),
(650, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:23', '2023-06-21 08:51:23'),
(651, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:24', '2023-06-21 08:51:24'),
(652, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:25', '2023-06-21 08:51:25'),
(653, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:26', '2023-06-21 08:51:26'),
(654, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:26', '2023-06-21 08:51:26'),
(655, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:26', '2023-06-21 08:51:26'),
(656, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:51:44', '2023-06-21 08:51:44'),
(657, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:52:17', '2023-06-21 08:52:17'),
(658, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:52:40', '2023-06-21 08:52:40'),
(659, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:54:24', '2023-06-21 08:54:24'),
(660, 1, 'admin/crops/1/edit', 'GET', '127.0.0.1', '[]', '2023-06-21 08:54:29', '2023-06-21 08:54:29'),
(661, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 08:54:37', '2023-06-21 08:54:37'),
(662, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:54:41', '2023-06-21 08:54:41'),
(663, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:54:45', '2023-06-21 08:54:45'),
(664, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:55:03', '2023-06-21 08:55:03'),
(665, 1, 'admin/crops', 'POST', '127.0.0.1', '[]', '2023-06-21 08:55:03', '2023-06-21 08:55:03'),
(666, 1, 'admin/crop-varieties/create', 'GET', '127.0.0.1', '{\"crop_id\":\"1\"}', '2023-06-21 08:55:04', '2023-06-21 08:55:04'),
(667, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:55:28', '2023-06-21 08:55:28'),
(668, 1, 'admin/crop-varieties/2', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 08:55:36', '2023-06-21 08:55:36'),
(669, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:55:37', '2023-06-21 08:55:37'),
(670, 1, 'admin/crop-varieties/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:55:45', '2023-06-21 08:55:45'),
(671, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:55:53', '2023-06-21 08:55:53'),
(672, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:57:28', '2023-06-21 08:57:28'),
(673, 1, 'admin/crops/1', 'GET', '127.0.0.1', '[]', '2023-06-21 08:59:09', '2023-06-21 08:59:09'),
(674, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 09:00:08', '2023-06-21 09:00:08'),
(675, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:00:12', '2023-06-21 09:00:12'),
(676, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Beans\",\"number_of_inspections\":\"5\",\"number_of_days_before_submission\":\"5\",\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Akeem Turner Beans\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Aurora Harper Beans\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"Colton Neal Beans\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\",\"after-save\":\"view\"}', '2023-06-21 09:00:53', '2023-06-21 09:00:53'),
(677, 1, 'admin/crops/2', 'GET', '127.0.0.1', '[]', '2023-06-21 09:00:54', '2023-06-21 09:00:54'),
(678, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 09:01:13', '2023-06-21 09:01:13'),
(679, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 09:01:30', '2023-06-21 09:01:30'),
(680, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:01:35', '2023-06-21 09:01:35'),
(681, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:07:32', '2023-06-21 09:07:32'),
(682, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:07:55', '2023-06-21 09:07:55'),
(683, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:16:24', '2023-06-21 09:16:24'),
(684, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:21:32', '2023-06-21 09:21:32'),
(685, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:23:17', '2023-06-21 09:23:17'),
(686, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:28:09', '2023-06-21 09:28:09'),
(687, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:29:26', '2023-06-21 09:29:26'),
(688, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-21 09:29:47', '2023-06-21 09:29:47'),
(689, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:29:50', '2023-06-21 09:29:50'),
(690, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:30:39', '2023-06-21 09:30:39'),
(691, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 09:30:44', '2023-06-21 09:30:44'),
(692, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:30:47', '2023-06-21 09:30:47'),
(693, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:36:28', '2023-06-21 09:36:28'),
(694, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:39:39', '2023-06-21 09:39:39'),
(695, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:40:31', '2023-06-21 09:40:31'),
(696, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:40:53', '2023-06-21 09:40:53'),
(697, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:43:22', '2023-06-21 09:43:22'),
(698, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:44:40', '2023-06-21 09:44:40'),
(699, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:45:01', '2023-06-21 09:45:01'),
(700, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:47:26', '2023-06-21 09:47:26'),
(701, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:56:16', '2023-06-21 09:56:16'),
(702, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:57:09', '2023-06-21 09:57:09'),
(703, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:58:19', '2023-06-21 09:58:19'),
(704, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"producer_registration_number\":\"532\",\"producer_category\":\"Consectetur totam p\",\"name_of_applicant\":\"Serina Chang\",\"applicant_phone_number\":\"+1 (585) 556-6727\",\"applicant_email\":\"sirydoluf@mailinator.com\",\"premises_location\":\"Quisquam aliquam qui\",\"proposed_farm_location\":\"Est cum enim tempor\",\"years_of_experience\":\"1988\",\"gardening_history_description\":\"Animi cum velit dol\",\"storage_facilities_description\":\"Rem ipsum ad eos ea\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Aut non sunt consect\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Odit lorem dolorem i\",\"status\":\"Cupiditate eos incid\",\"status_comment\":\"Cupiditate occaecat\",\"inspector\":\"Illo at laudantium\",\"grower_number\":\"924\",\"valid_from\":\"2023-06-21 23:32:54\",\"valid_until\":\"2023-06-14 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"1\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 09:59:04', '2023-06-21 09:59:04'),
(705, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 09:59:05', '2023-06-21 09:59:05'),
(706, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:03:54', '2023-06-21 10:03:54'),
(707, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:04:33', '2023-06-21 10:04:33'),
(708, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"administrator_id\":\"1\",\"producer_registration_number\":\"253\",\"producer_category\":\"Commodo nihil adipis\",\"name_of_applicant\":\"Byron Oneil\",\"applicant_phone_number\":\"+1 (472) 869-4679\",\"applicant_email\":\"kycaqypily@mailinator.com\",\"premises_location\":\"Ullam explicabo Lab\",\"proposed_farm_location\":\"Eiusmod laudantium\",\"years_of_experience\":\"2001\",\"gardening_history_description\":\"Asperiores est conse\",\"storage_facilities_description\":\"Dolor accusantium ac\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Qui tempora ad fugit\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Incidunt reprehende\",\"status\":\"Totam dolore ut est\",\"status_comment\":\"Laudantium cupidita\",\"inspector_id\":\"70\",\"grower_number\":\"326\",\"valid_from\":\"2023-11-24 15:35:21\",\"valid_until\":\"2023-06-30 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 10:05:05', '2023-06-21 10:05:05'),
(709, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:05:06', '2023-06-21 10:05:06'),
(710, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:05:59', '2023-06-21 10:05:59'),
(711, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"393\",\"producer_category\":\"Deserunt enim eius l\",\"name_of_applicant\":\"Shannon Fox\",\"applicant_phone_number\":\"+1 (414) 594-9073\",\"applicant_email\":\"tuco@mailinator.com\",\"premises_location\":\"Quis voluptatem anim\",\"proposed_farm_location\":\"Voluptas omnis nulla\",\"years_of_experience\":\"1991\",\"gardening_history_description\":\"Cumque itaque veniam\",\"storage_facilities_description\":\"Incidunt id aspern\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Assumenda adipisicin\",\"aware_of_minimum_standards\":\"off\",\"receipt\":\"Atque molestiae iust\",\"status\":\"In minim voluptatibu\",\"status_comment\":\"Nulla quas et volupt\",\"inspector_id\":\"66\",\"grower_number\":\"637\",\"valid_from\":\"2023-06-21 04:39:50\",\"valid_until\":\"2023-07-01 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 10:06:24', '2023-06-21 10:06:24'),
(712, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:06:25', '2023-06-21 10:06:25'),
(713, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:09:07', '2023-06-21 10:09:07'),
(714, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"68\",\"producer_category\":\"Ducimus nisi ut seq\",\"name_of_applicant\":\"Emerson Duffy\",\"applicant_phone_number\":\"+1 (495) 724-1985\",\"applicant_email\":\"lupe@mailinator.com\",\"premises_location\":\"Minus qui ex quae te\",\"proposed_farm_location\":\"Quisquam qui qui eu\",\"years_of_experience\":\"1970\",\"gardening_history_description\":\"Possimus odit maior\",\"storage_facilities_description\":\"Voluptate animi off\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"A ducimus cum exerc\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Velit ab reprehender\",\"status\":\"Temporibus voluptate\",\"status_comment\":\"Qui ab et ullam in\",\"inspector_id\":\"30\",\"grower_number\":\"634\",\"valid_from\":\"2023-06-21 01:15:00\",\"valid_until\":\"2023-07-01 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\"}', '2023-06-21 10:09:27', '2023-06-21 10:09:27'),
(715, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:09:28', '2023-06-21 10:09:28'),
(716, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:12:15', '2023-06-21 10:12:15'),
(717, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"707\",\"producer_category\":\"Dolore veritatis vol\",\"name_of_applicant\":\"Moana Kirkland\",\"applicant_phone_number\":\"+1 (833) 795-9611\",\"applicant_email\":\"zakysupuga@mailinator.com\",\"premises_location\":\"Aspernatur eu et vol\",\"proposed_farm_location\":\"Aperiam voluptas min\",\"years_of_experience\":\"2001\",\"gardening_history_description\":\"Explicabo Temporibu\",\"storage_facilities_description\":\"Ducimus cumque quib\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Magna impedit qui a\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Quod ut tempore por\",\"status\":\"Temporibus rem ex no\",\"status_comment\":\"Ipsum omnis dolorem\",\"inspector_id\":\"2\",\"grower_number\":\"55\",\"valid_from\":\"2023-06-21 04:05:59\",\"valid_until\":\"2023-06-30 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\",\"after-save\":\"view\"}', '2023-06-21 10:12:35', '2023-06-21 10:12:35'),
(718, 1, 'admin/seed-producers/3', 'GET', '127.0.0.1', '[]', '2023-06-21 10:12:36', '2023-06-21 10:12:36'),
(719, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:15:30', '2023-06-21 10:15:30'),
(720, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:15:34', '2023-06-21 10:15:34'),
(721, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"707\",\"producer_category\":\"Sed nulla lorem in v\",\"name_of_applicant\":\"Coby Conley\",\"applicant_phone_number\":\"+1 (906) 191-7966\",\"applicant_email\":\"xosejyt@mailinator.com\",\"premises_location\":\"Beatae architecto qu\",\"proposed_farm_location\":\"Itaque dolores eveni\",\"years_of_experience\":\"1995\",\"gardening_history_description\":\"Maiores nihil rerum\",\"storage_facilities_description\":\"Dolor magnam fuga C\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Adipisci occaecat ex\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Porro laborum earum\",\"status\":\"Sit dolores commodo\",\"status_comment\":\"Et sed laborum aut d\",\"inspector_id\":\"75\",\"grower_number\":\"356\",\"valid_from\":\"2023-06-21 06:49:21\",\"valid_until\":\"2023-06-23 12:00:00\",\"crop_seed_producers\":{\"new_1\":{\"crop_id\":\"2\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_id\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"search_terms\":null,\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\",\"after-save\":\"view\"}', '2023-06-21 10:15:56', '2023-06-21 10:15:56'),
(722, 1, 'admin/seed-producers/4', 'GET', '127.0.0.1', '[]', '2023-06-21 10:15:56', '2023-06-21 10:15:56'),
(723, 1, 'admin/seed-producers/4', 'GET', '127.0.0.1', '[]', '2023-06-21 10:22:55', '2023-06-21 10:22:55'),
(724, 1, 'admin/seed-producers/4', 'GET', '127.0.0.1', '[]', '2023-06-21 10:23:55', '2023-06-21 10:23:55'),
(725, 1, 'admin/seed-producers/4', 'GET', '127.0.0.1', '[]', '2023-06-21 10:24:34', '2023-06-21 10:24:34'),
(726, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:25:38', '2023-06-21 10:25:38'),
(727, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:25:45', '2023-06-21 10:25:45'),
(728, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-21 10:26:30', '2023-06-21 10:26:30'),
(729, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"$2y$10$wUxMHDEkPtHPSdDtIpjtce.Eb1Z1UaxSn7coMmwvNK1.XxoGNAXBe\",\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\",\"_method\":\"PUT\"}', '2023-06-21 10:26:55', '2023-06-21 10:26:55'),
(730, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-21 10:26:56', '2023-06-21 10:26:56'),
(731, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"_token\":\"1Y9O5OIU08KKRFUUrhG09lMhHIqdlLN0qkpdZTQr\",\"_method\":\"PUT\"}', '2023-06-21 10:27:30', '2023-06-21 10:27:30'),
(732, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-21 10:27:31', '2023-06-21 10:27:31'),
(733, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-21 10:27:38', '2023-06-21 10:27:38'),
(734, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-21 10:31:39', '2023-06-21 10:31:39'),
(735, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-21 10:31:43', '2023-06-21 10:31:43'),
(736, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-21 10:31:50', '2023-06-21 10:31:50'),
(737, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:31:56', '2023-06-21 10:31:56'),
(738, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-21 10:32:14', '2023-06-21 10:32:14'),
(739, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-21 10:45:26', '2023-06-21 10:45:26'),
(740, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:45:33', '2023-06-21 10:45:33'),
(741, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:45:37', '2023-06-21 10:45:37'),
(742, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-06-21 10:47:04', '2023-06-21 10:47:04'),
(743, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-21 10:47:19', '2023-06-21 10:47:19'),
(744, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-21 10:47:23', '2023-06-21 10:47:23'),
(745, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-21 10:47:30', '2023-06-21 10:47:30'),
(746, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 05:07:12', '2023-06-22 05:07:12'),
(747, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:07:23', '2023-06-22 05:07:23'),
(748, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Qds Producer\",\"icon\":\"icon-seedling\",\"uri\":\"qds-producer\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:08:04', '2023-06-22 05:08:04'),
(749, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:08:05', '2023-06-22 05:08:05'),
(750, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Co-operatives\",\"icon\":\"icon-layer-group\",\"uri\":\"cooperatives\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:08:50', '2023-06-22 05:08:50'),
(751, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:08:51', '2023-06-22 05:08:51'),
(752, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-book-open\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:09:58', '2023-06-22 05:09:58'),
(753, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:09:59', '2023-06-22 05:09:59'),
(754, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Planting Returns\",\"icon\":\"icon-seedling\",\"uri\":\"planting-returns\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:10:36', '2023-06-22 05:10:36'),
(755, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:10:36', '2023-06-22 05:10:36'),
(756, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-hands\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:11:30', '2023-06-22 05:11:30'),
(757, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:11:31', '2023-06-22 05:11:31'),
(758, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"29\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-users\",\"uri\":\"agro-dealers\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:12:37', '2023-06-22 05:12:37'),
(759, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:12:38', '2023-06-22 05:12:38'),
(760, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Agro Dealer Agreements\",\"icon\":\"icon-file-archive\",\"uri\":\"agro-dealer-agreements\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:14:01', '2023-06-22 05:14:01'),
(761, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:14:01', '2023-06-22 05:14:01'),
(762, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Contracts\",\"icon\":\"icon-book-open\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:16:15', '2023-06-22 05:16:15'),
(763, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:16:16', '2023-06-22 05:16:16'),
(764, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"32\",\"search_terms\":null,\"title\":\"Out Grower Contracts\",\"icon\":\"icon-address-card\",\"uri\":\"out-grower-contracts\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:17:00', '2023-06-22 05:17:00'),
(765, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:17:01', '2023-06-22 05:17:01'),
(766, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"32\",\"search_terms\":null,\"title\":\"Certification Fomrs\",\"icon\":\"icon-address-card\",\"uri\":\"certification-forms\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:18:05', '2023-06-22 05:18:05');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(767, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:18:05', '2023-06-22 05:18:05'),
(768, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Seed Stock and Labels\",\"icon\":\"icon-seedling\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:23:10', '2023-06-22 05:23:10'),
(769, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:23:10', '2023-06-22 05:23:10'),
(770, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Load Stock\",\"icon\":\"icon-layer-group\",\"uri\":\"load-stocks\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:24:26', '2023-06-22 05:24:26'),
(771, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:24:26', '2023-06-22 05:24:26'),
(772, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"35\",\"search_terms\":null,\"title\":\"Seed Labels\",\"icon\":\"icon-sticky-note\",\"uri\":\"seed-labels\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:25:19', '2023-06-22 05:25:19'),
(773, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:25:20', '2023-06-22 05:25:20'),
(774, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Pre Orders\",\"icon\":\"icon-cart-arrow-down\",\"uri\":\"pre-orders\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:26:20', '2023-06-22 05:26:20'),
(775, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:26:20', '2023-06-22 05:26:20'),
(776, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Inspections\",\"icon\":\"icon-brain\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:27:08', '2023-06-22 05:27:08'),
(777, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:27:08', '2023-06-22 05:27:08'),
(778, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"39\",\"search_terms\":null,\"title\":\"Field Inspection\",\"icon\":\"icon-apple-alt\",\"uri\":\"field-inspections\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:28:22', '2023-06-22 05:28:22'),
(779, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:28:22', '2023-06-22 05:28:22'),
(780, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"39\",\"search_terms\":null,\"title\":\"Seed Lab\",\"icon\":\"icon-medkit\",\"uri\":\"seed-lab-test-reports\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:29:17', '2023-06-22 05:29:17'),
(781, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:29:17', '2023-06-22 05:29:17'),
(782, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:29:25', '2023-06-22 05:29:25'),
(783, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:31:05', '2023-06-22 05:31:05'),
(784, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:31:41', '2023-06-22 05:31:41'),
(785, 1, 'admin/auth/menu/6/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 05:31:58', '2023-06-22 05:31:58'),
(786, 1, 'admin/auth/menu/6/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:13', '2023-06-22 05:32:13'),
(787, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:23', '2023-06-22 05:32:23'),
(788, 1, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:28', '2023-06-22 05:32:28'),
(789, 1, 'admin/agro-dealers', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:33', '2023-06-22 05:32:33'),
(790, 1, 'admin/agro-dealer-agreements', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:36', '2023-06-22 05:32:36'),
(791, 1, 'admin/agro-dealer-agreements', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:38', '2023-06-22 05:32:38'),
(792, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:48', '2023-06-22 05:32:48'),
(793, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_order\":\"[{\\\"id\\\":\\\"20\\\",\\\"children\\\":[{\\\"id\\\":\\\"21\\\"},{\\\"id\\\":\\\"25\\\"},{\\\"id\\\":\\\"26\\\"}]},{\\\"id\\\":\\\"22\\\",\\\"children\\\":[{\\\"id\\\":\\\"23\\\"}]},{\\\"id\\\":\\\"27\\\",\\\"children\\\":[{\\\"id\\\":\\\"28\\\"}]},{\\\"id\\\":\\\"29\\\",\\\"children\\\":[{\\\"id\\\":\\\"30\\\"},{\\\"id\\\":\\\"31\\\"}]},{\\\"id\\\":\\\"32\\\",\\\"children\\\":[{\\\"id\\\":\\\"33\\\"},{\\\"id\\\":\\\"34\\\"}]},{\\\"id\\\":\\\"35\\\",\\\"children\\\":[{\\\"id\\\":\\\"37\\\"}]},{\\\"id\\\":\\\"36\\\"},{\\\"id\\\":\\\"38\\\"},{\\\"id\\\":\\\"39\\\",\\\"children\\\":[{\\\"id\\\":\\\"40\\\"},{\\\"id\\\":\\\"41\\\"}]},{\\\"id\\\":\\\"1\\\"},{\\\"id\\\":\\\"2\\\",\\\"children\\\":[{\\\"id\\\":\\\"3\\\"},{\\\"id\\\":\\\"4\\\"},{\\\"id\\\":\\\"5\\\"},{\\\"id\\\":\\\"6\\\"},{\\\"id\\\":\\\"7\\\"}]}]\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:32:57', '2023-06-22 05:32:57'),
(794, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:32:58', '2023-06-22 05:32:58'),
(795, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_order\":\"[{\\\"id\\\":\\\"1\\\"},{\\\"id\\\":\\\"20\\\",\\\"children\\\":[{\\\"id\\\":\\\"21\\\"},{\\\"id\\\":\\\"25\\\"},{\\\"id\\\":\\\"26\\\"}]},{\\\"id\\\":\\\"22\\\",\\\"children\\\":[{\\\"id\\\":\\\"23\\\"}]},{\\\"id\\\":\\\"27\\\",\\\"children\\\":[{\\\"id\\\":\\\"28\\\"}]},{\\\"id\\\":\\\"29\\\",\\\"children\\\":[{\\\"id\\\":\\\"30\\\"},{\\\"id\\\":\\\"31\\\"}]},{\\\"id\\\":\\\"32\\\",\\\"children\\\":[{\\\"id\\\":\\\"33\\\"},{\\\"id\\\":\\\"34\\\"}]},{\\\"id\\\":\\\"35\\\",\\\"children\\\":[{\\\"id\\\":\\\"37\\\"}]},{\\\"id\\\":\\\"36\\\"},{\\\"id\\\":\\\"38\\\"},{\\\"id\\\":\\\"39\\\",\\\"children\\\":[{\\\"id\\\":\\\"40\\\"},{\\\"id\\\":\\\"41\\\"}]},{\\\"id\\\":\\\"2\\\",\\\"children\\\":[{\\\"id\\\":\\\"3\\\"},{\\\"id\\\":\\\"4\\\"},{\\\"id\\\":\\\"5\\\"},{\\\"id\\\":\\\"6\\\"},{\\\"id\\\":\\\"7\\\"}]}]\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:33:12', '2023-06-22 05:33:12'),
(796, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:33:13', '2023-06-22 05:33:13'),
(797, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:33:16', '2023-06-22 05:33:16'),
(798, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_order\":\"[{\\\"id\\\":\\\"1\\\"},{\\\"id\\\":\\\"20\\\",\\\"children\\\":[{\\\"id\\\":\\\"21\\\"},{\\\"id\\\":\\\"25\\\"},{\\\"id\\\":\\\"26\\\"}]},{\\\"id\\\":\\\"27\\\",\\\"children\\\":[{\\\"id\\\":\\\"28\\\"}]},{\\\"id\\\":\\\"29\\\",\\\"children\\\":[{\\\"id\\\":\\\"30\\\"},{\\\"id\\\":\\\"31\\\"}]},{\\\"id\\\":\\\"32\\\",\\\"children\\\":[{\\\"id\\\":\\\"33\\\"},{\\\"id\\\":\\\"34\\\"}]},{\\\"id\\\":\\\"35\\\",\\\"children\\\":[{\\\"id\\\":\\\"36\\\"},{\\\"id\\\":\\\"37\\\"}]},{\\\"id\\\":\\\"39\\\",\\\"children\\\":[{\\\"id\\\":\\\"40\\\"},{\\\"id\\\":\\\"41\\\"}]},{\\\"id\\\":\\\"38\\\"},{\\\"id\\\":\\\"22\\\",\\\"children\\\":[{\\\"id\\\":\\\"23\\\"}]},{\\\"id\\\":\\\"2\\\",\\\"children\\\":[{\\\"id\\\":\\\"3\\\"},{\\\"id\\\":\\\"4\\\"},{\\\"id\\\":\\\"5\\\"},{\\\"id\\\":\\\"6\\\"},{\\\"id\\\":\\\"7\\\"}]}]\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:34:20', '2023-06-22 05:34:20'),
(799, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:34:20', '2023-06-22 05:34:20'),
(800, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 05:34:29', '2023-06-22 05:34:29'),
(801, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-06-22 05:34:41', '2023-06-22 05:34:41'),
(802, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:34:52', '2023-06-22 05:34:52'),
(803, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:35:16', '2023-06-22 05:35:16'),
(804, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"User Profile\",\"icon\":\"icon-user-alt\",\"uri\":\"auth\\/setting\",\"roles\":[null],\"permission\":null,\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\"}', '2023-06-22 05:36:32', '2023-06-22 05:36:32'),
(805, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:36:33', '2023-06-22 05:36:33'),
(806, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 05:36:39', '2023-06-22 05:36:39'),
(807, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:36:44', '2023-06-22 05:36:44'),
(808, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"$2y$10$FSN\\/kfNjlk6aewTg\\/BMjxujVUGlGQ0VPagJoFoAJgh7sJVCR.rioO\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\",\"_method\":\"PUT\"}', '2023-06-22 05:37:07', '2023-06-22 05:37:07'),
(809, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:37:08', '2023-06-22 05:37:08'),
(810, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\",\"_method\":\"PUT\"}', '2023-06-22 05:37:46', '2023-06-22 05:37:46'),
(811, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:37:47', '2023-06-22 05:37:47'),
(812, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:37:53', '2023-06-22 05:37:53'),
(813, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:41:57', '2023-06-22 05:41:57'),
(814, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:42:02', '2023-06-22 05:42:02'),
(815, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:42:17', '2023-06-22 05:42:17'),
(816, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:43:21', '2023-06-22 05:43:21'),
(817, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 05:44:50', '2023-06-22 05:44:50'),
(818, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 05:45:35', '2023-06-22 05:45:35'),
(819, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 05:49:05', '2023-06-22 05:49:05'),
(820, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:01:49', '2023-06-22 06:01:49'),
(821, 1, 'admin/auth/setting', 'PUT', '127.0.0.1', '{\"name\":\"Administrator\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"_token\":\"wdUIMpD5fESYi0QFzXiIrj1RrC91Vkm50lcwqsYL\",\"_method\":\"PUT\"}', '2023-06-22 06:02:19', '2023-06-22 06:02:19'),
(822, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:02:20', '2023-06-22 06:02:20'),
(823, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:02:28', '2023-06-22 06:02:28'),
(824, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:08:37', '2023-06-22 06:08:37'),
(825, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 06:08:42', '2023-06-22 06:08:42'),
(826, 29, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 06:13:52', '2023-06-22 06:13:52'),
(827, 29, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:14:47', '2023-06-22 06:14:47'),
(828, 29, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:14:54', '2023-06-22 06:14:54'),
(829, 29, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:14:58', '2023-06-22 06:14:58'),
(830, 29, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:01', '2023-06-22 06:15:01'),
(831, 29, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:06', '2023-06-22 06:15:06'),
(832, 29, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:12', '2023-06-22 06:15:12'),
(833, 29, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:15', '2023-06-22 06:15:15'),
(834, 29, 'admin/agro-dealers', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:19', '2023-06-22 06:15:19'),
(835, 29, 'admin/agro-dealer-agreements', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:21', '2023-06-22 06:15:21'),
(836, 29, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:28', '2023-06-22 06:15:28'),
(837, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 06:15:33', '2023-06-22 06:15:33'),
(838, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 06:29:32', '2023-06-22 06:29:32'),
(839, 39, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 09:24:02', '2023-06-22 09:24:02'),
(840, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 09:44:10', '2023-06-22 09:44:10'),
(841, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 09:44:19', '2023-06-22 09:44:19'),
(842, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 09:46:39', '2023-06-22 09:46:39'),
(843, 40, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 09:47:22', '2023-06-22 09:47:22'),
(844, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 09:47:52', '2023-06-22 09:47:52'),
(845, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 09:56:13', '2023-06-22 09:56:13'),
(846, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 09:56:18', '2023-06-22 09:56:18'),
(847, 43, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:04:10', '2023-06-22 10:04:10'),
(848, 43, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 10:04:20', '2023-06-22 10:04:20'),
(849, 43, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 10:05:00', '2023-06-22 10:05:00'),
(850, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:07:42', '2023-06-22 10:07:42'),
(851, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:07:53', '2023-06-22 10:07:53'),
(852, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:08:03', '2023-06-22 10:08:03'),
(853, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-06-22 10:08:41', '2023-06-22 10:08:41'),
(854, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '[]', '2023-06-22 10:08:57', '2023-06-22 10:08:57'),
(855, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-06-22 10:09:03', '2023-06-22 10:09:03'),
(856, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '[]', '2023-06-22 10:09:07', '2023-06-22 10:09:07'),
(857, 1, 'admin/auth/roles', 'POST', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"2\",\"3\",\"4\",null],\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\"}', '2023-06-22 10:09:54', '2023-06-22 10:09:54'),
(858, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-06-22 10:09:54', '2023-06-22 10:09:54'),
(859, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:20', '2023-06-22 10:10:20'),
(860, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:24', '2023-06-22 10:10:24'),
(861, 1, 'admin/auth/menu/1', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Dashboard\",\"icon\":\"icon-chart-bar\",\"uri\":\"\\/\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:10:38', '2023-06-22 10:10:38'),
(862, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:39', '2023-06-22 10:10:39'),
(863, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:44', '2023-06-22 10:10:44'),
(864, 1, 'admin/auth/menu/20', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-file-alt\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":\"*\",\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:10:52', '2023-06-22 10:10:52'),
(865, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:53', '2023-06-22 10:10:53'),
(866, 1, 'admin/auth/menu/27/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:10:56', '2023-06-22 10:10:56'),
(867, 1, 'admin/auth/menu/27', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-book-open\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:11:04', '2023-06-22 10:11:04'),
(868, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:04', '2023-06-22 10:11:04'),
(869, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:08', '2023-06-22 10:11:08'),
(870, 1, 'admin/auth/menu/29', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-hands\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:11:17', '2023-06-22 10:11:17'),
(871, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:17', '2023-06-22 10:11:17'),
(872, 1, 'admin/auth/menu/32/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:24', '2023-06-22 10:11:24'),
(873, 1, 'admin/auth/menu/32', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Contracts\",\"icon\":\"icon-book-open\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:11:30', '2023-06-22 10:11:30'),
(874, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:30', '2023-06-22 10:11:30'),
(875, 1, 'admin/auth/menu/35/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:36', '2023-06-22 10:11:36'),
(876, 1, 'admin/auth/menu/35', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Seed Stock and Labels\",\"icon\":\"icon-seedling\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:11:45', '2023-06-22 10:11:45'),
(877, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:45', '2023-06-22 10:11:45'),
(878, 1, 'admin/auth/menu/39/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:11:57', '2023-06-22 10:11:57'),
(879, 1, 'admin/auth/menu/39', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Inspections\",\"icon\":\"icon-brain\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:12:03', '2023-06-22 10:12:03'),
(880, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:03', '2023-06-22 10:12:03'),
(881, 1, 'admin/auth/menu/38/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:18', '2023-06-22 10:12:18'),
(882, 1, 'admin/auth/menu/38', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Pre Orders\",\"icon\":\"icon-cart-arrow-down\",\"uri\":\"pre-orders\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"QSsKmspjnbtjjjZqpuMzJ0jRINQAlha79GzUhDb8\",\"_method\":\"PUT\"}', '2023-06-22 10:12:25', '2023-06-22 10:12:25'),
(883, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:25', '2023-06-22 10:12:25'),
(884, 1, 'admin/auth/menu/38/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:32', '2023-06-22 10:12:32'),
(885, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:42', '2023-06-22 10:12:42'),
(886, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:12:56', '2023-06-22 10:12:56'),
(887, 40, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-22 10:13:08', '2023-06-22 10:13:08'),
(888, 40, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:00', '2023-06-22 10:14:00'),
(889, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:10', '2023-06-22 10:14:10'),
(890, 40, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:14', '2023-06-22 10:14:14'),
(891, 40, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:20', '2023-06-22 10:14:20'),
(892, 40, 'admin/agro-dealers', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:24', '2023-06-22 10:14:24'),
(893, 40, 'admin/agro-dealer-agreements', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:27', '2023-06-22 10:14:27'),
(894, 40, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:45', '2023-06-22 10:14:45'),
(895, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:14:50', '2023-06-22 10:14:50'),
(896, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:03', '2023-06-22 10:16:03'),
(897, 1, 'admin/auth/menu/22/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:09', '2023-06-22 10:16:09'),
(898, 1, 'admin/auth/menu/22', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"System settings\",\"icon\":\"icon-anchor\",\"uri\":null,\"roles\":[\"2\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:16:20', '2023-06-22 10:16:20'),
(899, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:20', '2023-06-22 10:16:20'),
(900, 1, 'admin/auth/menu/41/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:29', '2023-06-22 10:16:29'),
(901, 1, 'admin/auth/menu/41', 'PUT', '127.0.0.1', '{\"parent_id\":\"39\",\"search_terms\":null,\"title\":\"Seed Lab\",\"icon\":\"icon-medkit\",\"uri\":\"seed-lab-test-reports\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:16:34', '2023-06-22 10:16:34'),
(902, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:35', '2023-06-22 10:16:35'),
(903, 1, 'admin/auth/menu/40/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:41', '2023-06-22 10:16:41'),
(904, 1, 'admin/auth/menu/40', 'PUT', '127.0.0.1', '{\"parent_id\":\"39\",\"search_terms\":null,\"title\":\"Field Inspection\",\"icon\":\"icon-apple-alt\",\"uri\":\"field-inspections\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:16:45', '2023-06-22 10:16:45'),
(905, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:46', '2023-06-22 10:16:46'),
(906, 1, 'admin/auth/menu/37/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:52', '2023-06-22 10:16:52'),
(907, 1, 'admin/auth/menu/37', 'PUT', '127.0.0.1', '{\"parent_id\":\"35\",\"search_terms\":null,\"title\":\"Seed Labels\",\"icon\":\"icon-sticky-note\",\"uri\":\"seed-labels\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:16:57', '2023-06-22 10:16:57'),
(908, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:16:58', '2023-06-22 10:16:58'),
(909, 1, 'admin/auth/menu/36/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:05', '2023-06-22 10:17:05'),
(910, 1, 'admin/auth/menu/36', 'PUT', '127.0.0.1', '{\"parent_id\":\"35\",\"search_terms\":null,\"title\":\"Load Stock\",\"icon\":\"icon-layer-group\",\"uri\":\"load-stocks\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:17:10', '2023-06-22 10:17:10'),
(911, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:11', '2023-06-22 10:17:11'),
(912, 1, 'admin/auth/menu/34/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:27', '2023-06-22 10:17:27'),
(913, 1, 'admin/auth/menu/34', 'PUT', '127.0.0.1', '{\"parent_id\":\"32\",\"search_terms\":null,\"title\":\"Certification Fomrs\",\"icon\":\"icon-address-card\",\"uri\":\"certification-forms\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:17:33', '2023-06-22 10:17:33'),
(914, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:34', '2023-06-22 10:17:34'),
(915, 1, 'admin/auth/menu/33/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:48', '2023-06-22 10:17:48'),
(916, 1, 'admin/auth/menu/33', 'PUT', '127.0.0.1', '{\"parent_id\":\"32\",\"search_terms\":null,\"title\":\"Out Grower Contracts\",\"icon\":\"icon-address-card\",\"uri\":\"out-grower-contracts\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:17:54', '2023-06-22 10:17:54'),
(917, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:17:55', '2023-06-22 10:17:55'),
(918, 1, 'admin/auth/menu/31/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:10', '2023-06-22 10:18:10'),
(919, 1, 'admin/auth/menu/31', 'PUT', '127.0.0.1', '{\"parent_id\":\"29\",\"search_terms\":null,\"title\":\"Agro Dealer Agreements\",\"icon\":\"icon-file-archive\",\"uri\":\"agro-dealer-agreements\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:18:16', '2023-06-22 10:18:16'),
(920, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:16', '2023-06-22 10:18:16'),
(921, 1, 'admin/auth/menu/30/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:22', '2023-06-22 10:18:22'),
(922, 1, 'admin/auth/menu/30', 'PUT', '127.0.0.1', '{\"parent_id\":\"29\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-users\",\"uri\":\"agro-dealers\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:18:27', '2023-06-22 10:18:27'),
(923, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:28', '2023-06-22 10:18:28'),
(924, 1, 'admin/auth/menu/28/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:45', '2023-06-22 10:18:45'),
(925, 1, 'admin/auth/menu/28', 'PUT', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Planting Returns\",\"icon\":\"icon-seedling\",\"uri\":\"planting-returns\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:18:51', '2023-06-22 10:18:51'),
(926, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:18:51', '2023-06-22 10:18:51'),
(927, 1, 'admin/auth/menu/26/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:06', '2023-06-22 10:19:06'),
(928, 1, 'admin/auth/menu/26', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Co-operatives\",\"icon\":\"icon-layer-group\",\"uri\":\"cooperatives\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:19:11', '2023-06-22 10:19:11'),
(929, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:12', '2023-06-22 10:19:12'),
(930, 1, 'admin/auth/menu/25/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:16', '2023-06-22 10:19:16'),
(931, 1, 'admin/auth/menu/25', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Qds Producer\",\"icon\":\"icon-seedling\",\"uri\":\"qds-producer\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:19:25', '2023-06-22 10:19:25'),
(932, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:25', '2023-06-22 10:19:25'),
(933, 1, 'admin/auth/menu/25/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:38', '2023-06-22 10:19:38'),
(934, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:43', '2023-06-22 10:19:43'),
(935, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-06-22 10:19:47', '2023-06-22 10:19:47'),
(936, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\",\"_method\":\"PUT\"}', '2023-06-22 10:19:59', '2023-06-22 10:19:59'),
(937, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:20:00', '2023-06-22 10:20:00'),
(938, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-06-22 10:20:24', '2023-06-22 10:20:24'),
(939, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-22 10:20:34', '2023-06-22 10:20:34'),
(940, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:20:41', '2023-06-22 10:20:41'),
(941, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_order\":\"[{\\\"id\\\":\\\"1\\\"},{\\\"id\\\":\\\"20\\\",\\\"children\\\":[{\\\"id\\\":\\\"21\\\"},{\\\"id\\\":\\\"25\\\"},{\\\"id\\\":\\\"26\\\"}]},{\\\"id\\\":\\\"27\\\",\\\"children\\\":[{\\\"id\\\":\\\"28\\\"}]},{\\\"id\\\":\\\"29\\\",\\\"children\\\":[{\\\"id\\\":\\\"30\\\"},{\\\"id\\\":\\\"31\\\"}]},{\\\"id\\\":\\\"32\\\",\\\"children\\\":[{\\\"id\\\":\\\"33\\\"},{\\\"id\\\":\\\"34\\\"}]},{\\\"id\\\":\\\"35\\\",\\\"children\\\":[{\\\"id\\\":\\\"36\\\"},{\\\"id\\\":\\\"37\\\"}]},{\\\"id\\\":\\\"39\\\",\\\"children\\\":[{\\\"id\\\":\\\"40\\\"},{\\\"id\\\":\\\"41\\\"}]},{\\\"id\\\":\\\"38\\\"},{\\\"id\\\":\\\"22\\\",\\\"children\\\":[{\\\"id\\\":\\\"23\\\"}]},{\\\"id\\\":\\\"42\\\"},{\\\"id\\\":\\\"2\\\",\\\"children\\\":[{\\\"id\\\":\\\"3\\\"},{\\\"id\\\":\\\"4\\\"},{\\\"id\\\":\\\"5\\\"},{\\\"id\\\":\\\"6\\\"},{\\\"id\\\":\\\"7\\\"}]}]\",\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\"}', '2023-06-22 10:21:05', '2023-06-22 10:21:05'),
(942, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:21:05', '2023-06-22 10:21:05'),
(943, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:21:09', '2023-06-22 10:21:09'),
(944, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"39\",\"search_terms\":null,\"title\":\"Seed Sample Request\",\"icon\":\"icon-seedling\",\"uri\":\"seed-sampling-requests\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"auPnaq8sTbp3ptrlvNDuIfXduWc8Eq3PrSvXfdJi\"}', '2023-06-22 10:40:01', '2023-06-22 10:40:01'),
(945, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-06-22 10:40:01', '2023-06-22 10:40:01'),
(946, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-06-22 10:49:13', '2023-06-22 10:49:13'),
(947, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-06-23 09:04:12', '2023-06-23 09:04:12'),
(948, 1, 'admin/pre-orders', 'GET', '127.0.0.1', '[]', '2023-06-23 09:06:31', '2023-06-23 09:06:31'),
(949, 1, 'admin/pre-orders', 'GET', '127.0.0.1', '[]', '2023-06-23 09:15:04', '2023-06-23 09:15:04'),
(950, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 06:53:56', '2023-07-03 06:53:56'),
(951, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 06:57:16', '2023-07-03 06:57:16'),
(952, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 06:59:17', '2023-07-03 06:59:17'),
(953, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 07:00:24', '2023-07-03 07:00:24'),
(954, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 07:00:40', '2023-07-03 07:00:40'),
(955, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 07:01:25', '2023-07-03 07:01:25'),
(956, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 07:01:54', '2023-07-03 07:01:54'),
(957, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 07:02:48', '2023-07-03 07:02:48'),
(958, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-03 07:17:53', '2023-07-03 07:17:53'),
(959, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-03 11:07:49', '2023-07-03 11:07:49'),
(960, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-03 11:08:16', '2023-07-03 11:08:16'),
(961, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-03 11:08:28', '2023-07-03 11:08:28'),
(962, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-03 11:08:45', '2023-07-03 11:08:45'),
(963, 1, 'admin/seed-producers/3', 'GET', '127.0.0.1', '[]', '2023-07-03 11:08:49', '2023-07-03 11:08:49'),
(964, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-04 08:41:50', '2023-07-04 08:41:50'),
(965, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 08:43:12', '2023-07-04 08:43:12'),
(966, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 09:00:13', '2023-07-04 09:00:13'),
(967, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-04 09:00:24', '2023-07-04 09:00:24'),
(968, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:00:38', '2023-07-04 09:00:38'),
(969, 1, 'admin/auth/roles', 'POST', '127.0.0.1', '{\"slug\":\"inspector\",\"name\":\"Inspector\",\"permissions\":[\"2\",\"3\",\"4\",null],\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 09:01:18', '2023-07-04 09:01:18'),
(970, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-04 09:01:19', '2023-07-04 09:01:19'),
(971, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-04 09:01:40', '2023-07-04 09:01:40'),
(972, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:01:56', '2023-07-04 09:01:56'),
(973, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"inspectorA\",\"name\":\"Ray Meyers\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"inspector\",\"roles\":[\"4\",null],\"search_terms\":null,\"permissions\":[\"3\",\"2\",\"4\",null],\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\",\"after-save\":\"continue_creating\"}', '2023-07-04 09:03:23', '2023-07-04 09:03:23'),
(974, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:03:25', '2023-07-04 09:03:25'),
(975, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:14:08', '2023-07-04 09:14:08'),
(976, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:16:03', '2023-07-04 09:16:03'),
(977, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"inspectorA\",\"name\":\"Athena Castaneda\",\"email\":\"vonupat@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"password\",\"roles\":[\"4\",null],\"search_terms\":null,\"permissions\":[\"4\",\"2\",\"3\",null],\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 09:18:21', '2023-07-04 09:18:21'),
(978, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-04 09:18:22', '2023-07-04 09:18:22'),
(979, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:18:32', '2023-07-04 09:18:32'),
(980, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"busiw\",\"name\":\"Randall Martinez\",\"email\":\"lorilyhetu@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"password\",\"roles\":[\"4\",null],\"search_terms\":null,\"permissions\":[\"2\",\"3\",\"4\",null],\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 09:20:00', '2023-07-04 09:20:00'),
(981, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-04 09:20:01', '2023-07-04 09:20:01'),
(982, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"per_page\":\"50\"}', '2023-07-04 09:20:16', '2023-07-04 09:20:16'),
(983, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:20:20', '2023-07-04 09:20:20'),
(984, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"rilter\",\"name\":\"Hilel Powers\",\"email\":\"bimunazit@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"password\",\"roles\":[\"2\",null],\"search_terms\":null,\"permissions\":[\"4\",\"3\",\"2\",null],\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\",\"after-save\":\"view\"}', '2023-07-04 09:21:22', '2023-07-04 09:21:22'),
(985, 1, 'admin/auth/users/46', 'GET', '127.0.0.1', '[]', '2023-07-04 09:21:23', '2023-07-04 09:21:23'),
(986, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-04 09:21:37', '2023-07-04 09:21:37'),
(987, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 09:24:26', '2023-07-04 09:24:26'),
(988, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-04 10:13:44', '2023-07-04 10:13:44'),
(989, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 10:13:53', '2023-07-04 10:13:53'),
(990, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 10:13:56', '2023-07-04 10:13:56'),
(991, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"587\",\"producer_category\":\"Ut et est asperiores\",\"name_of_applicant\":\"Brielle Rich\",\"applicant_phone_number\":\"+1 (291) 344-9507\",\"applicant_email\":\"rugebazok@mailinator.com\",\"premises_location\":\"Eu fugiat magna sun\",\"proposed_farm_location\":\"Porro laudantium et\",\"years_of_experience\":\"2003\",\"gardening_history_description\":\"Officia vero officia\",\"storage_facilities_description\":\"Tenetur omnis explic\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Nulla molestiae ex o\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Veniam et ut vel ma\",\"status\":\"Dolor ea voluptate c\",\"status_comment\":\"Aliquam et nulla occ\",\"inspector_id\":\"66\",\"grower_number\":\"827\",\"valid_from\":\"2023-07-04 21:55:52\",\"valid_until\":null,\"crop_seed_producers\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\",\"after-save\":\"view\"}', '2023-07-04 10:14:33', '2023-07-04 10:14:33'),
(992, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 10:14:34', '2023-07-04 10:14:34'),
(993, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 10:21:32', '2023-07-04 10:21:32'),
(994, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 10:24:07', '2023-07-04 10:24:07'),
(995, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:13:01', '2023-07-04 11:13:01'),
(996, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:20:46', '2023-07-04 11:20:46'),
(997, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:22:11', '2023-07-04 11:22:11'),
(998, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:23:15', '2023-07-04 11:23:15'),
(999, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"828\",\"producer_category\":\"Dolorem ipsum obcae\",\"name_of_applicant\":\"Shelby Forbes\",\"applicant_phone_number\":\"+1 (279) 372-5724\",\"applicant_email\":\"cuxigin@mailinator.com\",\"premises_location\":\"Architecto quidem ex\",\"proposed_farm_location\":\"Odit reprehenderit\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Consequatur quia des\",\"storage_facilities_description\":\"Expedita eos ut vol\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Commodo expedita pro\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Error blanditiis vol\",\"status\":\"Autem nulla dicta ar\",\"status_comment\":\"Esse est dicta volu\",\"inspector_id\":\"59\",\"grower_number\":\"305\",\"valid_from\":\"2023-07-04 21:48:11\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 11:24:00', '2023-07-04 11:24:00'),
(1000, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:24:00', '2023-07-04 11:24:00'),
(1001, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"828\",\"producer_category\":\"Dolorem ipsum obcae\",\"name_of_applicant\":\"Shelby Forbes\",\"applicant_phone_number\":\"+1 (279) 372-5724\",\"applicant_email\":\"cuxigin@mailinator.com\",\"premises_location\":\"Architecto quidem ex\",\"proposed_farm_location\":\"Odit reprehenderit\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Consequatur quia des\",\"storage_facilities_description\":\"Expedita eos ut vol\",\"have_adequate_isolation\":\"off\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Commodo expedita pro\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Error blanditiis vol\",\"status\":\"Autem nulla dicta ar\",\"status_comment\":\"Esse est dicta volu\",\"inspector_id\":\"59\",\"grower_number\":\"305\",\"valid_from\":\"2023-07-04 21:48:11\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 11:24:06', '2023-07-04 11:24:06'),
(1002, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:24:07', '2023-07-04 11:24:07'),
(1003, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:25:10', '2023-07-04 11:25:10'),
(1004, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:25:46', '2023-07-04 11:25:46'),
(1005, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"49\",\"producer_category\":\"Commodo cum excepteu\",\"name_of_applicant\":\"Howard Goodwin\",\"applicant_phone_number\":\"+1 (569) 953-4435\",\"applicant_email\":\"zihosycoz@mailinator.com\",\"premises_location\":\"Dolor quasi veritati\",\"proposed_farm_location\":\"Excepteur sunt maxi\",\"years_of_experience\":\"1980\",\"gardening_history_description\":\"Exercitation maxime\",\"storage_facilities_description\":\"Mollit fugiat nostr\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Voluptas labore dolo\",\"aware_of_minimum_standards\":\"on\",\"aware_of_minimum_standards_cb\":\"on\",\"receipt\":\"Voluptas magna aliqu\",\"status\":\"Consequatur Elit l\",\"status_comment\":\"Sed ipsa quis nemo\",\"inspector_id\":\"54\",\"grower_number\":\"219\",\"valid_from\":\"2023-07-04 15:02:24\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\",\"after-save\":\"view\"}', '2023-07-04 11:26:06', '2023-07-04 11:26:06'),
(1006, 1, 'admin/seed-producers/8', 'GET', '127.0.0.1', '[]', '2023-07-04 11:26:07', '2023-07-04 11:26:07'),
(1007, 1, 'admin/seed-producers/8', 'GET', '127.0.0.1', '[]', '2023-07-04 11:30:30', '2023-07-04 11:30:30'),
(1008, 1, 'admin/seed-producers/8', 'GET', '127.0.0.1', '[]', '2023-07-04 11:33:18', '2023-07-04 11:33:18'),
(1009, 1, 'admin/seed-producers/8', 'GET', '127.0.0.1', '[]', '2023-07-04 11:33:36', '2023-07-04 11:33:36'),
(1010, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:19', '2023-07-04 11:34:19'),
(1011, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:23', '2023-07-04 11:34:23'),
(1012, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"6\",\"producer_category\":\"Quis optio minim no\",\"name_of_applicant\":\"Sebastian Golden\",\"applicant_phone_number\":\"+1 (133) 218-1605\",\"applicant_email\":\"conot@mailinator.com\",\"premises_location\":\"Est ipsum repellendu\",\"proposed_farm_location\":\"At sunt aut ut totam\",\"years_of_experience\":\"2014\",\"gardening_history_description\":\"Voluptas iure in des\",\"storage_facilities_description\":\"Molestiae voluptatem\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Voluptas non nostrud\",\"aware_of_minimum_standards\":\"off\",\"receipt\":\"Et et consectetur si\",\"status\":\"Nobis pariatur Aliq\",\"status_comment\":\"Ea quae consequat C\",\"inspector_id\":\"16\",\"grower_number\":\"947\",\"valid_from\":\"2023-07-04 06:53:32\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UFnC8KGr3azn5hrghN7XQgLVGOJyZZzfVwjuToqL\"}', '2023-07-04 11:34:40', '2023-07-04 11:34:40'),
(1013, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:40', '2023-07-04 11:34:40'),
(1014, 1, 'admin/seed-producers/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:47', '2023-07-04 11:34:47'),
(1015, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:52', '2023-07-04 11:34:52'),
(1016, 1, 'admin/seed-producers/9', 'GET', '127.0.0.1', '[]', '2023-07-04 11:34:56', '2023-07-04 11:34:56'),
(1017, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 03:02:38', '2023-07-05 03:02:38'),
(1018, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 03:04:59', '2023-07-05 03:04:59'),
(1019, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:05', '2023-07-05 03:05:05'),
(1020, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:07', '2023-07-05 03:05:07'),
(1021, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:07', '2023-07-05 03:05:07'),
(1022, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:08', '2023-07-05 03:05:08'),
(1023, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:09', '2023-07-05 03:05:09'),
(1024, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:10', '2023-07-05 03:05:10'),
(1025, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:11', '2023-07-05 03:05:11'),
(1026, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:12', '2023-07-05 03:05:12'),
(1027, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:13', '2023-07-05 03:05:13'),
(1028, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:14', '2023-07-05 03:05:14'),
(1029, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:15', '2023-07-05 03:05:15'),
(1030, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:16', '2023-07-05 03:05:16'),
(1031, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:17', '2023-07-05 03:05:17'),
(1032, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:18', '2023-07-05 03:05:18'),
(1033, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:19', '2023-07-05 03:05:19'),
(1034, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:20', '2023-07-05 03:05:20'),
(1035, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:21', '2023-07-05 03:05:21'),
(1036, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:22', '2023-07-05 03:05:22'),
(1037, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:23', '2023-07-05 03:05:23'),
(1038, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:24', '2023-07-05 03:05:24'),
(1039, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:24', '2023-07-05 03:05:24'),
(1040, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:25', '2023-07-05 03:05:25'),
(1041, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:26', '2023-07-05 03:05:26'),
(1042, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:27', '2023-07-05 03:05:27'),
(1043, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:28', '2023-07-05 03:05:28'),
(1044, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:29', '2023-07-05 03:05:29'),
(1045, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:30', '2023-07-05 03:05:30'),
(1046, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:31', '2023-07-05 03:05:31'),
(1047, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:32', '2023-07-05 03:05:32'),
(1048, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:32', '2023-07-05 03:05:32'),
(1049, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:33', '2023-07-05 03:05:33'),
(1050, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:34', '2023-07-05 03:05:34'),
(1051, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:35', '2023-07-05 03:05:35'),
(1052, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:36', '2023-07-05 03:05:36'),
(1053, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:37', '2023-07-05 03:05:37'),
(1054, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:38', '2023-07-05 03:05:38'),
(1055, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:39', '2023-07-05 03:05:39'),
(1056, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:40', '2023-07-05 03:05:40'),
(1057, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:40', '2023-07-05 03:05:40'),
(1058, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:41', '2023-07-05 03:05:41'),
(1059, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:42', '2023-07-05 03:05:42'),
(1060, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:43', '2023-07-05 03:05:43'),
(1061, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:44', '2023-07-05 03:05:44'),
(1062, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:45', '2023-07-05 03:05:45'),
(1063, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:46', '2023-07-05 03:05:46'),
(1064, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:47', '2023-07-05 03:05:47'),
(1065, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:48', '2023-07-05 03:05:48'),
(1066, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:48', '2023-07-05 03:05:48'),
(1067, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:49', '2023-07-05 03:05:49'),
(1068, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:50', '2023-07-05 03:05:50'),
(1069, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:51', '2023-07-05 03:05:51'),
(1070, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:52', '2023-07-05 03:05:52'),
(1071, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:53', '2023-07-05 03:05:53'),
(1072, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:54', '2023-07-05 03:05:54'),
(1073, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:55', '2023-07-05 03:05:55');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1074, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:56', '2023-07-05 03:05:56'),
(1075, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:57', '2023-07-05 03:05:57'),
(1076, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:57', '2023-07-05 03:05:57'),
(1077, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:58', '2023-07-05 03:05:58'),
(1078, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:05:59', '2023-07-05 03:05:59'),
(1079, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:00', '2023-07-05 03:06:00'),
(1080, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:01', '2023-07-05 03:06:01'),
(1081, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:02', '2023-07-05 03:06:02'),
(1082, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:03', '2023-07-05 03:06:03'),
(1083, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:04', '2023-07-05 03:06:04'),
(1084, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:04', '2023-07-05 03:06:04'),
(1085, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:05', '2023-07-05 03:06:05'),
(1086, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:06', '2023-07-05 03:06:06'),
(1087, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:07', '2023-07-05 03:06:07'),
(1088, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:08', '2023-07-05 03:06:08'),
(1089, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:09', '2023-07-05 03:06:09'),
(1090, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:10', '2023-07-05 03:06:10'),
(1091, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:11', '2023-07-05 03:06:11'),
(1092, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:12', '2023-07-05 03:06:12'),
(1093, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:12', '2023-07-05 03:06:12'),
(1094, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:13', '2023-07-05 03:06:13'),
(1095, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:14', '2023-07-05 03:06:14'),
(1096, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:15', '2023-07-05 03:06:15'),
(1097, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:16', '2023-07-05 03:06:16'),
(1098, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:17', '2023-07-05 03:06:17'),
(1099, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:18', '2023-07-05 03:06:18'),
(1100, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:19', '2023-07-05 03:06:19'),
(1101, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:19', '2023-07-05 03:06:19'),
(1102, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:20', '2023-07-05 03:06:20'),
(1103, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:22', '2023-07-05 03:06:22'),
(1104, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:23', '2023-07-05 03:06:23'),
(1105, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:24', '2023-07-05 03:06:24'),
(1106, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:25', '2023-07-05 03:06:25'),
(1107, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:25', '2023-07-05 03:06:25'),
(1108, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:26', '2023-07-05 03:06:26'),
(1109, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:27', '2023-07-05 03:06:27'),
(1110, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:28', '2023-07-05 03:06:28'),
(1111, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:29', '2023-07-05 03:06:29'),
(1112, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:30', '2023-07-05 03:06:30'),
(1113, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:31', '2023-07-05 03:06:31'),
(1114, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:32', '2023-07-05 03:06:32'),
(1115, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:33', '2023-07-05 03:06:33'),
(1116, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:33', '2023-07-05 03:06:33'),
(1117, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:34', '2023-07-05 03:06:34'),
(1118, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:35', '2023-07-05 03:06:35'),
(1119, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:36', '2023-07-05 03:06:36'),
(1120, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:37', '2023-07-05 03:06:37'),
(1121, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:38', '2023-07-05 03:06:38'),
(1122, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:39', '2023-07-05 03:06:39'),
(1123, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:06:40', '2023-07-05 03:06:40'),
(1124, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:02', '2023-07-05 03:07:02'),
(1125, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:03', '2023-07-05 03:07:03'),
(1126, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:04', '2023-07-05 03:07:04'),
(1127, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:05', '2023-07-05 03:07:05'),
(1128, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:06', '2023-07-05 03:07:06'),
(1129, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:07', '2023-07-05 03:07:07'),
(1130, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:07', '2023-07-05 03:07:07'),
(1131, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:08', '2023-07-05 03:07:08'),
(1132, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:09', '2023-07-05 03:07:09'),
(1133, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:10', '2023-07-05 03:07:10'),
(1134, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:11', '2023-07-05 03:07:11'),
(1135, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:12', '2023-07-05 03:07:12'),
(1136, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:13', '2023-07-05 03:07:13'),
(1137, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:14', '2023-07-05 03:07:14'),
(1138, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:15', '2023-07-05 03:07:15'),
(1139, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:15', '2023-07-05 03:07:15'),
(1140, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:16', '2023-07-05 03:07:16'),
(1141, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:17', '2023-07-05 03:07:17'),
(1142, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:18', '2023-07-05 03:07:18'),
(1143, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:19', '2023-07-05 03:07:19'),
(1144, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:07:19', '2023-07-05 03:07:19'),
(1145, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:08:48', '2023-07-05 03:08:48'),
(1146, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:09:04', '2023-07-05 03:09:04'),
(1147, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:10:12', '2023-07-05 03:10:12'),
(1148, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 03:13:37', '2023-07-05 03:13:37'),
(1149, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:15:06', '2023-07-05 04:15:06'),
(1150, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:22:04', '2023-07-05 04:22:04'),
(1151, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:23:29', '2023-07-05 04:23:29'),
(1152, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:24:13', '2023-07-05 04:24:13'),
(1153, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:24:39', '2023-07-05 04:24:39'),
(1154, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:25:52', '2023-07-05 04:25:52'),
(1155, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:27:08', '2023-07-05 04:27:08'),
(1156, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:27:25', '2023-07-05 04:27:25'),
(1157, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:27:39', '2023-07-05 04:27:39'),
(1158, 1, 'admin/_handle_action_', 'POST', '127.0.0.1', '{\"_model\":\"App_Models_SeedProducer\",\"_action\":\"OpenAdmin_Admin_Grid_Tools_BatchDelete\",\"_key\":\"3,4,8,9\",\"_token\":\"UcJg2eA3IQaok6lzVlhToJumvp0jkoamFzwCpRPE\"}', '2023-07-05 04:27:54', '2023-07-05 04:27:54'),
(1159, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:27:55', '2023-07-05 04:27:55'),
(1160, 1, 'admin/seed-producers/3,4,8,9', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"UcJg2eA3IQaok6lzVlhToJumvp0jkoamFzwCpRPE\"}', '2023-07-05 04:27:57', '2023-07-05 04:27:57'),
(1161, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:27:57', '2023-07-05 04:27:57'),
(1162, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:29:42', '2023-07-05 04:29:42'),
(1163, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:29:59', '2023-07-05 04:29:59'),
(1164, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:30:21', '2023-07-05 04:30:21'),
(1165, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:31:08', '2023-07-05 04:31:08'),
(1166, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:32:18', '2023-07-05 04:32:18'),
(1167, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:32:23', '2023-07-05 04:32:23'),
(1168, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"359\",\"producer_category\":\"Elit fuga Libero o\",\"name_of_applicant\":\"Cooper Cleveland\",\"applicant_phone_number\":\"+1 (165) 149-8637\",\"applicant_email\":\"tizugywyn@mailinator.com\",\"premises_location\":\"Dolorum eu quasi vel\",\"proposed_farm_location\":\"Magni ab rerum sint\",\"years_of_experience\":\"Moody and Holden Traders\",\"gardening_history_description\":\"Non officia explicab\",\"storage_facilities_description\":\"Fugiat labore enim u\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Excepteur consequunt\",\"receipt\":\"Enim soluta irure do\",\"status\":\"Non praesentium Nam\",\"status_comment\":\"Aut eveniet cupidat\",\"inspector_id\":\"4\",\"grower_number\":\"93\",\"valid_from\":\"2001-01-01 20:33:49\",\"valid_until\":null,\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UcJg2eA3IQaok6lzVlhToJumvp0jkoamFzwCpRPE\"}', '2023-07-05 04:32:48', '2023-07-05 04:32:48'),
(1169, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:32:49', '2023-07-05 04:32:49'),
(1170, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"359\",\"producer_category\":\"Elit fuga Libero o\",\"name_of_applicant\":\"Cooper Cleveland\",\"applicant_phone_number\":\"+1 (165) 149-8637\",\"applicant_email\":\"tizugywyn@mailinator.com\",\"premises_location\":\"Dolorum eu quasi vel\",\"proposed_farm_location\":\"Magni ab rerum sint\",\"years_of_experience\":\"Moody and Holden Traders\",\"gardening_history_description\":\"Non officia explicab\",\"storage_facilities_description\":\"Fugiat labore enim u\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Excepteur consequunt\",\"receipt\":\"Enim soluta irure do\",\"status\":\"Non praesentium Nam\",\"status_comment\":\"Aut eveniet cupidat\",\"inspector_id\":\"4\",\"grower_number\":null,\"valid_from\":\"2001-01-01 20:33:49\",\"valid_until\":null,\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"_token\":\"UcJg2eA3IQaok6lzVlhToJumvp0jkoamFzwCpRPE\"}', '2023-07-05 04:32:51', '2023-07-05 04:32:51'),
(1171, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:32:51', '2023-07-05 04:32:51'),
(1172, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:39:56', '2023-07-05 04:39:56'),
(1173, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 04:40:13', '2023-07-05 04:40:13'),
(1174, 1, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"536\",\"producer_category\":\"In aut laboris alias\",\"name_of_applicant\":\"Fulton Moreno\",\"applicant_phone_number\":\"+1 (895) 179-4101\",\"applicant_email\":\"syqogefi@mailinator.com\",\"premises_location\":\"Eius atque quasi ull\",\"proposed_farm_location\":\"Ex ipsam optio in d\",\"years_of_experience\":\"Anthony and Ball LLC\",\"gardening_history_description\":\"Vel qui ullam deseru\",\"storage_facilities_description\":\"Minus Nam ad in eos\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Ut est quia ad ut su\",\"receipt\":\"Et non quibusdam qui\",\"status\":\"Et iusto ipsum in i\",\"status_comment\":\"Nulla rerum consecte\",\"inspector_id\":\"22\",\"grower_number\":\"749\",\"valid_from\":\"2016-01-01 21:31:41\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"_token\":\"UcJg2eA3IQaok6lzVlhToJumvp0jkoamFzwCpRPE\"}', '2023-07-05 04:40:31', '2023-07-05 04:40:31'),
(1175, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 04:40:31', '2023-07-05 04:40:31'),
(1176, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 04:40:35', '2023-07-05 04:40:35'),
(1177, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 04:41:32', '2023-07-05 04:41:32'),
(1178, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 04:42:29', '2023-07-05 04:42:29'),
(1179, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 04:52:43', '2023-07-05 04:52:43'),
(1180, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 05:05:28', '2023-07-05 05:05:28'),
(1181, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 05:05:40', '2023-07-05 05:05:40'),
(1182, 46, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:20', '2023-07-05 05:06:20'),
(1183, 46, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:26', '2023-07-05 05:06:26'),
(1184, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:32', '2023-07-05 05:06:32'),
(1185, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:36', '2023-07-05 05:06:36'),
(1186, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:37', '2023-07-05 05:06:37'),
(1187, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:39', '2023-07-05 05:06:39'),
(1188, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:40', '2023-07-05 05:06:40'),
(1189, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:41', '2023-07-05 05:06:41'),
(1190, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:43', '2023-07-05 05:06:43'),
(1191, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:44', '2023-07-05 05:06:44'),
(1192, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:45', '2023-07-05 05:06:45'),
(1193, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:47', '2023-07-05 05:06:47'),
(1194, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:48', '2023-07-05 05:06:48'),
(1195, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:49', '2023-07-05 05:06:49'),
(1196, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:51', '2023-07-05 05:06:51'),
(1197, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:52', '2023-07-05 05:06:52'),
(1198, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:53', '2023-07-05 05:06:53'),
(1199, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:55', '2023-07-05 05:06:55'),
(1200, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:56', '2023-07-05 05:06:56'),
(1201, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:57', '2023-07-05 05:06:57'),
(1202, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:06:59', '2023-07-05 05:06:59'),
(1203, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:07:00', '2023-07-05 05:07:00'),
(1204, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:07:01', '2023-07-05 05:07:01'),
(1205, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 05:16:23', '2023-07-05 05:16:23'),
(1206, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:16:34', '2023-07-05 05:16:34'),
(1207, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:17:06', '2023-07-05 05:17:06'),
(1208, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:17:15', '2023-07-05 05:17:15'),
(1209, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:19:48', '2023-07-05 05:19:48'),
(1210, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:31:36', '2023-07-05 05:31:36'),
(1211, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:33:52', '2023-07-05 05:33:52'),
(1212, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:35:19', '2023-07-05 05:35:19'),
(1213, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:35:41', '2023-07-05 05:35:41'),
(1214, 46, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 05:35:56', '2023-07-05 05:35:56'),
(1215, 46, 'admin/seed-producers/10', 'PUT', '127.0.0.1', '{\"user_id\":\"1\",\"producer_registration_number\":\"536\",\"producer_category\":\"In aut laboris alias\",\"name_of_applicant\":\"Fulton Moreno\",\"applicant_phone_number\":\"+1 (895) 179-4101\",\"applicant_email\":\"syqogefi@mailinator.com\",\"premises_location\":\"Eius atque quasi ull\",\"proposed_farm_location\":\"Ex ipsam optio in d\",\"years_of_experience\":\"Anthony and Ball LLC\",\"gardening_history_description\":\"Vel qui ullam deseru\",\"storage_facilities_description\":\"Minus Nam ad in eos\",\"have_adequate_isolation\":\"0\",\"labor_details\":\"Ut est quia ad ut su\",\"receipt\":\"Et non quibusdam qui\",\"inspector_id\":\"44\",\"search_terms\":null,\"status\":\"Et iusto ipsum in i\",\"status_comment\":\"Nulla rerum consecte\",\"grower_number\":null,\"valid_from\":\"2016-01-01 21:31:41\",\"valid_until\":\"2023-07-29 12:00:00\",\"crops\":[\"2\",\"1\",null],\"_token\":\"CwFTYrwms9Qu7ZZwiQESlSRnzl46YwsiG7BJNIKy\",\"_method\":\"PUT\"}', '2023-07-05 05:36:06', '2023-07-05 05:36:06'),
(1216, 46, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 05:36:07', '2023-07-05 05:36:07'),
(1217, 46, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 05:57:44', '2023-07-05 05:57:44'),
(1218, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:33', '2023-07-05 06:16:33'),
(1219, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:37', '2023-07-05 06:16:37'),
(1220, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:38', '2023-07-05 06:16:38'),
(1221, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:38', '2023-07-05 06:16:38'),
(1222, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:39', '2023-07-05 06:16:39'),
(1223, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:40', '2023-07-05 06:16:40'),
(1224, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:41', '2023-07-05 06:16:41'),
(1225, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:42', '2023-07-05 06:16:42'),
(1226, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:43', '2023-07-05 06:16:43'),
(1227, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:44', '2023-07-05 06:16:44'),
(1228, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:45', '2023-07-05 06:16:45'),
(1229, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:45', '2023-07-05 06:16:45'),
(1230, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:46', '2023-07-05 06:16:46'),
(1231, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:47', '2023-07-05 06:16:47'),
(1232, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:48', '2023-07-05 06:16:48'),
(1233, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:48', '2023-07-05 06:16:48'),
(1234, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:16:49', '2023-07-05 06:16:49'),
(1235, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:17:29', '2023-07-05 06:17:29'),
(1236, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:18:40', '2023-07-05 06:18:40'),
(1237, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:18:54', '2023-07-05 06:18:54'),
(1238, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:19:13', '2023-07-05 06:19:13'),
(1239, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:19:46', '2023-07-05 06:19:46'),
(1240, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:21:54', '2023-07-05 06:21:54'),
(1241, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:23:10', '2023-07-05 06:23:10'),
(1242, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:23:24', '2023-07-05 06:23:24'),
(1243, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:28:41', '2023-07-05 06:28:41'),
(1244, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:29:25', '2023-07-05 06:29:25'),
(1245, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:29:27', '2023-07-05 06:29:27'),
(1246, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 06:29:36', '2023-07-05 06:29:36'),
(1247, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 08:24:17', '2023-07-05 08:24:17'),
(1248, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 08:24:35', '2023-07-05 08:24:35'),
(1249, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 08:35:24', '2023-07-05 08:35:24'),
(1250, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 08:35:28', '2023-07-05 08:35:28'),
(1251, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 08:58:21', '2023-07-05 08:58:21'),
(1252, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 08:58:29', '2023-07-05 08:58:29'),
(1253, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:05:48', '2023-07-05 09:05:48'),
(1254, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:11:19', '2023-07-05 09:11:19'),
(1255, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_export_\":\"all\"}', '2023-07-05 09:11:26', '2023-07-05 09:11:26'),
(1256, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:12:05', '2023-07-05 09:12:05'),
(1257, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:12:26', '2023-07-05 09:12:26'),
(1258, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:13:08', '2023-07-05 09:13:08'),
(1259, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:15:39', '2023-07-05 09:15:39'),
(1260, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 09:15:41', '2023-07-05 09:15:41'),
(1261, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 09:19:10', '2023-07-05 09:19:10'),
(1262, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 09:19:36', '2023-07-05 09:19:36'),
(1263, 1, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 09:27:44', '2023-07-05 09:27:44'),
(1264, 1, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:27:48', '2023-07-05 09:27:48'),
(1265, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:28:11', '2023-07-05 09:28:11'),
(1266, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 09:34:48', '2023-07-05 09:34:48'),
(1267, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 09:34:53', '2023-07-05 09:34:53'),
(1268, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 09:34:57', '2023-07-05 09:34:57'),
(1269, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 09:35:14', '2023-07-05 09:35:14'),
(1270, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-05 09:35:48', '2023-07-05 09:35:48'),
(1271, 44, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:36:15', '2023-07-05 09:36:15'),
(1272, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:36:30', '2023-07-05 09:36:30'),
(1273, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:36:34', '2023-07-05 09:36:34'),
(1274, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:38:13', '2023-07-05 09:38:13'),
(1275, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:38:33', '2023-07-05 09:38:33'),
(1276, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:38:37', '2023-07-05 09:38:37'),
(1277, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:30', '2023-07-05 09:39:30'),
(1278, 1, 'admin/auth/menu/27/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:32', '2023-07-05 09:39:32'),
(1279, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:41', '2023-07-05 09:39:41'),
(1280, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:44', '2023-07-05 09:39:44'),
(1281, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[\"2\",\"1\",\"3\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:39:50', '2023-07-05 09:39:50'),
(1282, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:50', '2023-07-05 09:39:50'),
(1283, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:39:54', '2023-07-05 09:39:54'),
(1284, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:40:28', '2023-07-05 09:40:28'),
(1285, 40, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:40:32', '2023-07-05 09:40:32'),
(1286, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 09:40:40', '2023-07-05 09:40:40'),
(1287, 1, 'admin/auth/users/43/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:40:51', '2023-07-05 09:40:51'),
(1288, 40, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-05 09:41:03', '2023-07-05 09:41:03'),
(1289, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:41:58', '2023-07-05 09:41:58'),
(1290, 44, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:42:08', '2023-07-05 09:42:08'),
(1291, 44, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 09:42:10', '2023-07-05 09:42:10'),
(1292, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:44:40', '2023-07-05 09:44:40'),
(1293, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:44:41', '2023-07-05 09:44:41'),
(1294, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 09:45:37', '2023-07-05 09:45:37'),
(1295, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:46:46', '2023-07-05 09:46:46'),
(1296, 1, 'admin/auth/menu/42/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:46:53', '2023-07-05 09:46:53'),
(1297, 1, 'admin/auth/menu/42', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"User Profile\",\"icon\":\"icon-user-alt\",\"uri\":\"auth\\/setting\",\"roles\":[\"4\",\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:47:23', '2023-07-05 09:47:23'),
(1298, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:47:23', '2023-07-05 09:47:23'),
(1299, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:47:34', '2023-07-05 09:47:34'),
(1300, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:47:37', '2023-07-05 09:47:37'),
(1301, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:08', '2023-07-05 09:48:08'),
(1302, 1, 'admin/auth/menu/20', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-file-alt\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":\"*\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:18', '2023-07-05 09:48:18'),
(1303, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:18', '2023-07-05 09:48:18'),
(1304, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:21', '2023-07-05 09:48:21'),
(1305, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:26', '2023-07-05 09:48:26'),
(1306, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:26', '2023-07-05 09:48:26'),
(1307, 1, 'admin/auth/menu/25/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:28', '2023-07-05 09:48:28'),
(1308, 1, 'admin/auth/menu/25', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Qds Producer\",\"icon\":\"icon-seedling\",\"uri\":\"qds-producer\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:32', '2023-07-05 09:48:32'),
(1309, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:32', '2023-07-05 09:48:32'),
(1310, 1, 'admin/auth/menu/26/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:35', '2023-07-05 09:48:35'),
(1311, 1, 'admin/auth/menu/26', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Co-operatives\",\"icon\":\"icon-layer-group\",\"uri\":\"cooperatives\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:39', '2023-07-05 09:48:39'),
(1312, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:40', '2023-07-05 09:48:40'),
(1313, 1, 'admin/auth/menu/27/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:42', '2023-07-05 09:48:42'),
(1314, 1, 'admin/auth/menu/27', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-book-open\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:47', '2023-07-05 09:48:47'),
(1315, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:47', '2023-07-05 09:48:47'),
(1316, 1, 'admin/auth/menu/28/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:49', '2023-07-05 09:48:49'),
(1317, 1, 'admin/auth/menu/28', 'PUT', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Planting Returns\",\"icon\":\"icon-seedling\",\"uri\":\"planting-returns\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:48:53', '2023-07-05 09:48:53'),
(1318, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:48:53', '2023-07-05 09:48:53'),
(1319, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:06', '2023-07-05 09:49:06'),
(1320, 1, 'admin/auth/menu/30/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:08', '2023-07-05 09:49:08'),
(1321, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:09', '2023-07-05 09:49:09'),
(1322, 1, 'admin/auth/menu/30/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:09', '2023-07-05 09:49:09'),
(1323, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:10', '2023-07-05 09:49:10'),
(1324, 1, 'admin/auth/menu/30/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:10', '2023-07-05 09:49:10'),
(1325, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:10', '2023-07-05 09:49:10'),
(1326, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:11', '2023-07-05 09:49:11'),
(1327, 1, 'admin/auth/menu/29/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:11', '2023-07-05 09:49:11'),
(1328, 1, 'admin/auth/menu/29', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-hands\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:49:13', '2023-07-05 09:49:13'),
(1329, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:14', '2023-07-05 09:49:14'),
(1330, 1, 'admin/auth/menu/30/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:17', '2023-07-05 09:49:17'),
(1331, 1, 'admin/auth/menu/30', 'PUT', '127.0.0.1', '{\"parent_id\":\"29\",\"search_terms\":null,\"title\":\"Agro Dealers\",\"icon\":\"icon-users\",\"uri\":\"agro-dealers\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:49:20', '2023-07-05 09:49:20'),
(1332, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:20', '2023-07-05 09:49:20'),
(1333, 1, 'admin/auth/menu/31/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:25', '2023-07-05 09:49:25'),
(1334, 1, 'admin/auth/menu/31', 'PUT', '127.0.0.1', '{\"parent_id\":\"29\",\"search_terms\":null,\"title\":\"Agro Dealer Agreements\",\"icon\":\"icon-file-archive\",\"uri\":\"agro-dealer-agreements\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:49:29', '2023-07-05 09:49:29'),
(1335, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:29', '2023-07-05 09:49:29'),
(1336, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:49:58', '2023-07-05 09:49:58'),
(1337, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:30', '2023-07-05 09:50:30'),
(1338, 1, 'admin/auth/menu/20', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-file-alt\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":\"*\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:50:36', '2023-07-05 09:50:36'),
(1339, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:37', '2023-07-05 09:50:37'),
(1340, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:40', '2023-07-05 09:50:40'),
(1341, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:50:42', '2023-07-05 09:50:42'),
(1342, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:43', '2023-07-05 09:50:43'),
(1343, 1, 'admin/auth/menu/25/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:46', '2023-07-05 09:50:46'),
(1344, 1, 'admin/auth/menu/25', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Qds Producer\",\"icon\":\"icon-seedling\",\"uri\":\"qds-producer\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:50:48', '2023-07-05 09:50:48'),
(1345, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:49', '2023-07-05 09:50:49'),
(1346, 1, 'admin/auth/menu/26/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:52', '2023-07-05 09:50:52'),
(1347, 1, 'admin/auth/menu/26', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Co-operatives\",\"icon\":\"icon-layer-group\",\"uri\":\"cooperatives\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:50:54', '2023-07-05 09:50:54'),
(1348, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:50:54', '2023-07-05 09:50:54'),
(1349, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:06', '2023-07-05 09:51:06'),
(1350, 1, 'admin/auth/menu/27/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:22', '2023-07-05 09:51:22'),
(1351, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:31', '2023-07-05 09:51:31'),
(1352, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:34', '2023-07-05 09:51:34'),
(1353, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:47', '2023-07-05 09:51:47'),
(1354, 1, 'admin/auth/menu/27/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:50', '2023-07-05 09:51:50'),
(1355, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:51:59', '2023-07-05 09:51:59'),
(1356, 1, 'admin/auth/menu/28/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:03', '2023-07-05 09:52:03'),
(1357, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:06', '2023-07-05 09:52:06'),
(1358, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:09', '2023-07-05 09:52:09'),
(1359, 1, 'admin/auth/menu/20', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Application forms\",\"icon\":\"icon-file-alt\",\"uri\":null,\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:52:16', '2023-07-05 09:52:16'),
(1360, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:16', '2023-07-05 09:52:16'),
(1361, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:24', '2023-07-05 09:52:24'),
(1362, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:52:34', '2023-07-05 09:52:34'),
(1363, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:06', '2023-07-05 09:53:06'),
(1364, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:18', '2023-07-05 09:53:18'),
(1365, 44, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:33', '2023-07-05 09:53:33'),
(1366, 1, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:47', '2023-07-05 09:53:47'),
(1367, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:49', '2023-07-05 09:53:49'),
(1368, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:53:58', '2023-07-05 09:53:58'),
(1369, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 09:54:01', '2023-07-05 09:54:01'),
(1370, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"search_terms\":null,\"title\":\"Seed Producers\",\"icon\":\"icon-seedling\",\"uri\":\"seed-producers\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 09:54:42', '2023-07-05 09:54:42'),
(1371, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-05 09:54:42', '2023-07-05 09:54:42'),
(1372, 44, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:10', '2023-07-05 09:55:10'),
(1373, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:14', '2023-07-05 09:55:14'),
(1374, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:38', '2023-07-05 09:55:38'),
(1375, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:39', '2023-07-05 09:55:39'),
(1376, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:41', '2023-07-05 09:55:41'),
(1377, 44, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 09:55:42', '2023-07-05 09:55:42'),
(1378, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:06:28', '2023-07-05 10:06:28'),
(1379, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:06:39', '2023-07-05 10:06:39'),
(1380, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:06:55', '2023-07-05 10:06:55'),
(1381, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:07:49', '2023-07-05 10:07:49'),
(1382, 1, 'admin/_handle_action_', 'POST', '127.0.0.1', '{\"_model\":\"OpenAdmin_Admin_Auth_Database_Administrator\",\"_action\":\"OpenAdmin_Admin_Grid_Tools_BatchEdit\",\"_key\":\"40,43,44,45,46\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:02', '2023-07-05 10:08:02'),
(1383, 1, 'admin/auth/users/40/edit', 'GET', '127.0.0.1', '{\"ids\":[\"43\",\"44\",\"45\",\"46\"]}', '2023-07-05 10:08:04', '2023-07-05 10:08:04'),
(1384, 1, 'admin/auth/users/40/edit', 'GET', '127.0.0.1', '{\"ids\":[\"43\",\"44\",\"45\",\"46\"]}', '2023-07-05 10:08:04', '2023-07-05 10:08:04'),
(1385, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:14', '2023-07-05 10:08:14'),
(1386, 1, 'admin/auth/users/46', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:24', '2023-07-05 10:08:24'),
(1387, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:24', '2023-07-05 10:08:24'),
(1388, 1, 'admin/auth/users/45', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:28', '2023-07-05 10:08:28'),
(1389, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:28', '2023-07-05 10:08:28'),
(1390, 1, 'admin/auth/users/44', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:32', '2023-07-05 10:08:32'),
(1391, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:33', '2023-07-05 10:08:33'),
(1392, 1, 'admin/auth/users/43', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:36', '2023-07-05 10:08:36'),
(1393, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:37', '2023-07-05 10:08:37'),
(1394, 1, 'admin/auth/users/40', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:08:41', '2023-07-05 10:08:41'),
(1395, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:42', '2023-07-05 10:08:42'),
(1396, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:08:49', '2023-07-05 10:08:49'),
(1397, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"commissioner\",\"name\":\"Briar Russell\",\"email\":\"xowe@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"roles\":[\"2\",null],\"search_terms\":null,\"permissions\":[\"3\",\"4\",\"2\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:10:00', '2023-07-05 10:10:00'),
(1398, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:10:01', '2023-07-05 10:10:01'),
(1399, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 10:10:22', '2023-07-05 10:10:22'),
(1400, 47, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-05 10:10:33', '2023-07-05 10:10:33'),
(1401, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:10:38', '2023-07-05 10:10:38'),
(1402, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"basic-user\",\"name\":\"Tamekah Carter\",\"email\":\"ziravobawa@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"roles\":[\"3\",null],\"search_terms\":null,\"permissions\":[null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:11:22', '2023-07-05 10:11:22'),
(1403, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:11:23', '2023-07-05 10:11:23'),
(1404, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 10:11:45', '2023-07-05 10:11:45'),
(1405, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:12:15', '2023-07-05 10:12:15'),
(1406, 1, 'admin/auth/users', 'POST', '127.0.0.1', '{\"username\":\"inspector\",\"name\":\"Bertha Lucas\",\"email\":\"xubyf@mailinator.com\",\"password\":\"*****-filtered-out-*****\",\"password_confirmation\":\"admin\",\"roles\":[\"4\",null],\"search_terms\":null,\"permissions\":[null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:12:51', '2023-07-05 10:12:51'),
(1407, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-05 10:12:51', '2023-07-05 10:12:51'),
(1408, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:20', '2023-07-05 10:13:20'),
(1409, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:33', '2023-07-05 10:13:33'),
(1410, 49, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:41', '2023-07-05 10:13:41'),
(1411, 49, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:46', '2023-07-05 10:13:46'),
(1412, 49, 'admin/agro-dealers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:49', '2023-07-05 10:13:49'),
(1413, 49, 'admin/agro-dealer-agreements', 'GET', '127.0.0.1', '[]', '2023-07-05 10:13:51', '2023-07-05 10:13:51'),
(1414, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:00', '2023-07-05 10:14:00'),
(1415, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:12', '2023-07-05 10:14:12'),
(1416, 48, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:15', '2023-07-05 10:14:15'),
(1417, 1, 'admin/auth/roles/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:27', '2023-07-05 10:14:27'),
(1418, 1, 'admin/auth/roles/3', 'PUT', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"2\",\"3\",\"4\",\"5\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:14:39', '2023-07-05 10:14:39'),
(1419, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:39', '2023-07-05 10:14:39'),
(1420, 48, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:44', '2023-07-05 10:14:44'),
(1421, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:46', '2023-07-05 10:14:46'),
(1422, 48, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:50', '2023-07-05 10:14:50'),
(1423, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:14:51', '2023-07-05 10:14:51'),
(1424, 1, 'admin/auth/roles/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:04', '2023-07-05 10:15:04'),
(1425, 1, 'admin/auth/roles/3', 'PUT', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:15:09', '2023-07-05 10:15:09'),
(1426, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:10', '2023-07-05 10:15:10'),
(1427, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:17', '2023-07-05 10:15:17'),
(1428, 48, 'admin/cooperatives', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:24', '2023-07-05 10:15:24'),
(1429, 48, 'admin/planting-returns', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:27', '2023-07-05 10:15:27'),
(1430, 1, 'admin/auth/roles/4/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:34', '2023-07-05 10:15:34'),
(1431, 1, 'admin/auth/roles/4', 'PUT', '127.0.0.1', '{\"slug\":\"inspector\",\"name\":\"Inspector\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:15:39', '2023-07-05 10:15:39'),
(1432, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:39', '2023-07-05 10:15:39'),
(1433, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:15:41', '2023-07-05 10:15:41'),
(1434, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:04', '2023-07-05 10:17:04'),
(1435, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:09', '2023-07-05 10:17:09'),
(1436, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:18', '2023-07-05 10:17:18'),
(1437, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:21', '2023-07-05 10:17:21'),
(1438, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:25', '2023-07-05 10:17:25'),
(1439, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:17:55', '2023-07-05 10:17:55'),
(1440, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:18:45', '2023-07-05 10:18:45');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1441, 1, 'admin/auth/permissions', 'POST', '127.0.0.1', '{\"slug\":\"seed producers\",\"name\":\"Seed Producers\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\"}', '2023-07-05 10:18:57', '2023-07-05 10:18:57'),
(1442, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:18:58', '2023-07-05 10:18:58'),
(1443, 1, 'admin/auth/permissions/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:19:08', '2023-07-05 10:19:08'),
(1444, 1, 'admin/auth/permissions/10', 'PUT', '127.0.0.1', '{\"slug\":\"seed producers\",\"name\":\"Seed Producers\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"seed-producers\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:19:14', '2023-07-05 10:19:14'),
(1445, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:19:15', '2023-07-05 10:19:15'),
(1446, 1, 'admin/auth/permissions/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:19:24', '2023-07-05 10:19:24'),
(1447, 1, 'admin/auth/permissions/10', 'PUT', '127.0.0.1', '{\"slug\":\"seed producers\",\"name\":\"Seed Producers\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/seed-producers\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:19:29', '2023-07-05 10:19:29'),
(1448, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:19:30', '2023-07-05 10:19:30'),
(1449, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:19:46', '2023-07-05 10:19:46'),
(1450, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:23', '2023-07-05 10:20:23'),
(1451, 1, 'admin/auth/roles/4/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:26', '2023-07-05 10:20:26'),
(1452, 1, 'admin/auth/roles/4', 'PUT', '127.0.0.1', '{\"slug\":\"inspector\",\"name\":\"Inspector\",\"permissions\":[\"2\",\"3\",\"4\",\"10\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:20:36', '2023-07-05 10:20:36'),
(1453, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:37', '2023-07-05 10:20:37'),
(1454, 1, 'admin/auth/roles/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:39', '2023-07-05 10:20:39'),
(1455, 1, 'admin/auth/roles/3', 'PUT', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"2\",\"3\",\"4\",\"5\",\"10\",null],\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:20:44', '2023-07-05 10:20:44'),
(1456, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:44', '2023-07-05 10:20:44'),
(1457, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:50', '2023-07-05 10:20:50'),
(1458, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:20:52', '2023-07-05 10:20:52'),
(1459, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:03', '2023-07-05 10:21:03'),
(1460, 48, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:10', '2023-07-05 10:21:10'),
(1461, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:35', '2023-07-05 10:21:35'),
(1462, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:53', '2023-07-05 10:21:53'),
(1463, 48, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:55', '2023-07-05 10:21:55'),
(1464, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:21:59', '2023-07-05 10:21:59'),
(1465, 48, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 10:22:01', '2023-07-05 10:22:01'),
(1466, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:22:12', '2023-07-05 10:22:12'),
(1467, 1, 'admin/auth/permissions/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:22:59', '2023-07-05 10:22:59'),
(1468, 1, 'admin/auth/permissions/10', 'PUT', '127.0.0.1', '{\"slug\":\"seed producers\",\"name\":\"Seed Producers\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/seed-producers\\/*\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:23:07', '2023-07-05 10:23:07'),
(1469, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:07', '2023-07-05 10:23:07'),
(1470, 48, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:17', '2023-07-05 10:23:17'),
(1471, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:27', '2023-07-05 10:23:27'),
(1472, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:30', '2023-07-05 10:23:30'),
(1473, 1, 'admin/auth/permissions/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:46', '2023-07-05 10:23:46'),
(1474, 1, 'admin/auth/permissions/10', 'PUT', '127.0.0.1', '{\"slug\":\"seed producers\",\"name\":\"Seed Producers\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/seed-producers*\",\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:23:51', '2023-07-05 10:23:51'),
(1475, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:51', '2023-07-05 10:23:51'),
(1476, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:23:58', '2023-07-05 10:23:58'),
(1477, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:00', '2023-07-05 10:24:00'),
(1478, 48, 'admin/seed-producers/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:02', '2023-07-05 10:24:02'),
(1479, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:05', '2023-07-05 10:24:05'),
(1480, 48, 'admin/seed-producers/10', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:07', '2023-07-05 10:24:07'),
(1481, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:09', '2023-07-05 10:24:09'),
(1482, 48, 'admin/seed-producers/10', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"0C0V5B1Kbf8dRYDX0wpIYp41orHaDukywfvMd54E\"}', '2023-07-05 10:24:13', '2023-07-05 10:24:13'),
(1483, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:13', '2023-07-05 10:24:13'),
(1484, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:20', '2023-07-05 10:24:20'),
(1485, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:24:30', '2023-07-05 10:24:30'),
(1486, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:01', '2023-07-05 10:25:01'),
(1487, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:21', '2023-07-05 10:25:21'),
(1488, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_registration_number\":\"412\",\"producer_category\":\"Et architecto laudan\",\"name_of_applicant\":\"Marvin Taylor\",\"applicant_phone_number\":\"+1 (726) 953-2592\",\"applicant_email\":\"nylotapik@mailinator.com\",\"premises_location\":\"Ea do rerum perferen\",\"proposed_farm_location\":\"Id aperiam vel quo i\",\"years_of_experience\":\"Estes Warren Plc\",\"gardening_history_description\":\"Non enim sunt velit\",\"storage_facilities_description\":\"Aut autem minim offi\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Ipsum veniam anim r\",\"receipt\":\"Sit labore voluptat\",\"_token\":\"0C0V5B1Kbf8dRYDX0wpIYp41orHaDukywfvMd54E\",\"after-save\":\"view\"}', '2023-07-05 10:25:35', '2023-07-05 10:25:35'),
(1489, 48, 'admin/seed-producers/11', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:35', '2023-07-05 10:25:35'),
(1490, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:42', '2023-07-05 10:25:42'),
(1491, 1, 'admin/seed-producers/11', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:46', '2023-07-05 10:25:46'),
(1492, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:25:56', '2023-07-05 10:25:56'),
(1493, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-05 10:26:03', '2023-07-05 10:26:03'),
(1494, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:27:20', '2023-07-05 10:27:20'),
(1495, 1, 'admin/seed-producers/11', 'GET', '127.0.0.1', '[]', '2023-07-05 10:27:23', '2023-07-05 10:27:23'),
(1496, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:27:24', '2023-07-05 10:27:24'),
(1497, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:27:53', '2023-07-05 10:27:53'),
(1498, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:29:47', '2023-07-05 10:29:47'),
(1499, 1, 'admin/seed-producers/11', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Marvin Taylor\",\"premises_location\":\"Ea do rerum perferen\",\"proposed_farm_location\":\"Id aperiam vel quo i\",\"inspector_id\":\"49\",\"search_terms\":null,\"_token\":\"4Mfv7mECaiWsVZYWIqrIoyAt50XJyTuJhQWPSsWh\",\"_method\":\"PUT\"}', '2023-07-05 10:30:14', '2023-07-05 10:30:14'),
(1500, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:30:15', '2023-07-05 10:30:15'),
(1501, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:30:30', '2023-07-05 10:30:30'),
(1502, 49, 'admin/seed-producers/11', 'GET', '127.0.0.1', '[]', '2023-07-05 10:30:35', '2023-07-05 10:30:35'),
(1503, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:30:37', '2023-07-05 10:30:37'),
(1504, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 10:33:57', '2023-07-05 10:33:57'),
(1505, 1, 'admin/seed-producers/11', 'GET', '127.0.0.1', '[]', '2023-07-05 10:33:59', '2023-07-05 10:33:59'),
(1506, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:34:02', '2023-07-05 10:34:02'),
(1507, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:34:13', '2023-07-05 10:34:13'),
(1508, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 10:51:05', '2023-07-05 10:51:05'),
(1509, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:01:23', '2023-07-05 11:01:23'),
(1510, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:02:20', '2023-07-05 11:02:20'),
(1511, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:02:59', '2023-07-05 11:02:59'),
(1512, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:04:40', '2023-07-05 11:04:40'),
(1513, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:04:44', '2023-07-05 11:04:44'),
(1514, 49, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:06:11', '2023-07-05 11:06:11'),
(1515, 49, 'admin/seed-producers/11', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"status\":\"1\",\"grower_number\":\"Grower\\/50081538\",\"valid_from\":\"2023-07-05 14:06:11\",\"valid_until\":\"2023-07-29 14:06:11\",\"status_comment\":null,\"_token\":\"vcwwjf3XulBep0xFOX8srBs4qIyknwWgzBToIV9W\",\"_method\":\"PUT\"}', '2023-07-05 11:13:09', '2023-07-05 11:13:09'),
(1516, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 11:13:10', '2023-07-05 11:13:10'),
(1517, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 11:14:42', '2023-07-05 11:14:42'),
(1518, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 11:19:58', '2023-07-05 11:19:58'),
(1519, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:26:29', '2023-07-05 11:26:29'),
(1520, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:27:52', '2023-07-05 11:27:52'),
(1521, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:28:15', '2023-07-05 11:28:15'),
(1522, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:29:44', '2023-07-05 11:29:44'),
(1523, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:30:43', '2023-07-05 11:30:43'),
(1524, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-05 11:33:45', '2023-07-05 11:33:45'),
(1525, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:35:04', '2023-07-05 11:35:04'),
(1526, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:35:12', '2023-07-05 11:35:12'),
(1527, 1, 'admin/seed-producers/11/edit', 'GET', '127.0.0.1', '[]', '2023-07-05 11:35:32', '2023-07-05 11:35:32'),
(1528, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:11:48', '2023-07-06 07:11:48'),
(1529, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:28:32', '2023-07-06 07:28:32'),
(1530, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:32:55', '2023-07-06 07:32:55'),
(1531, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:34:27', '2023-07-06 07:34:27'),
(1532, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:35:21', '2023-07-06 07:35:21'),
(1533, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:10', '2023-07-06 07:36:10'),
(1534, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:16', '2023-07-06 07:36:16'),
(1535, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:18', '2023-07-06 07:36:18'),
(1536, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:19', '2023-07-06 07:36:19'),
(1537, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:23', '2023-07-06 07:36:23'),
(1538, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 07:36:24', '2023-07-06 07:36:24'),
(1539, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-06 08:06:42', '2023-07-06 08:06:42'),
(1540, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-06 08:06:48', '2023-07-06 08:06:48'),
(1541, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 08:07:32', '2023-07-06 08:07:32'),
(1542, 1, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"prTTmQ1YhX1h4EkQjcNs7BfAq4ZTmXlppZbmVytl\",\"username\":\"basic-user\",\"password\":\"*****-filtered-out-*****\"}', '2023-07-06 08:08:14', '2023-07-06 08:08:14'),
(1543, 1, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"prTTmQ1YhX1h4EkQjcNs7BfAq4ZTmXlppZbmVytl\",\"username\":\"basic-user\",\"password\":\"*****-filtered-out-*****\"}', '2023-07-06 08:08:43', '2023-07-06 08:08:43'),
(1544, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 08:08:44', '2023-07-06 08:08:44'),
(1545, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-06 08:08:48', '2023-07-06 08:08:48'),
(1546, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:08:52', '2023-07-06 08:08:52'),
(1547, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:09:53', '2023-07-06 08:09:53'),
(1548, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Est lorem ex nisi n\",\"name_of_applicant\":\"Allegra Hahn\",\"applicant_phone_number\":\"+1 (665) 144-2054\",\"applicant_email\":\"minacus@mailinator.com\",\"premises_location\":\"Dolor non perferendi\",\"proposed_farm_location\":\"Quae et quaerat vel\",\"years_of_experience\":\"Riddle and Morris Associates\",\"gardening_history_description\":\"Quis ipsum numquam\",\"storage_facilities_description\":\"Eum deserunt esse ne\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Amet incidunt lore\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Saepe tempor quis ve\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:10:07', '2023-07-06 08:10:07'),
(1549, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:10:07', '2023-07-06 08:10:07'),
(1550, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Est lorem ex nisi n\",\"name_of_applicant\":\"Allegra Hahn\",\"applicant_phone_number\":\"+1 (665) 144-2054\",\"applicant_email\":\"minacus@mailinator.com\",\"premises_location\":\"Dolor non perferendi\",\"proposed_farm_location\":\"Quae et quaerat vel\",\"years_of_experience\":\"Riddle and Morris Associates\",\"gardening_history_description\":\"Quis ipsum numquam\",\"storage_facilities_description\":\"Eum deserunt esse ne\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Amet incidunt lore\",\"crops\":[\"2\",\"1\",null],\"search_terms\":null,\"receipt\":\"Saepe tempor quis ve\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:10:09', '2023-07-06 08:10:09'),
(1551, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:10:10', '2023-07-06 08:10:10'),
(1552, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:11:46', '2023-07-06 08:11:46'),
(1553, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Qui fugiat perspici\",\"name_of_applicant\":\"Brandon Wright\",\"applicant_phone_number\":\"+1 (203) 628-1431\",\"applicant_email\":\"rylanimix@mailinator.com\",\"premises_location\":\"Ex quibusdam velit c\",\"proposed_farm_location\":\"Ipsam doloribus et m\",\"years_of_experience\":\"Riggs Santana Traders\",\"gardening_history_description\":\"Ipsum repellendus L\",\"storage_facilities_description\":\"A pariatur Voluptat\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Non aut et exercitat\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Doloremque sit alia\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:11:53', '2023-07-06 08:11:53'),
(1554, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:11:54', '2023-07-06 08:11:54'),
(1555, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:12:28', '2023-07-06 08:12:28'),
(1556, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Natus illo duis et e\",\"name_of_applicant\":\"Akeem William\",\"applicant_phone_number\":\"+1 (131) 218-6249\",\"applicant_email\":\"howeb@mailinator.com\",\"premises_location\":\"Quaerat in accusamus\",\"proposed_farm_location\":\"Repellendus Culpa t\",\"years_of_experience\":\"Tyler Richardson Inc\",\"gardening_history_description\":\"Recusandae Dolorem\",\"storage_facilities_description\":\"Iste quia laboris om\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Reprehenderit ullam\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Sed ullamco do volup\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:12:36', '2023-07-06 08:12:36'),
(1557, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:12:36', '2023-07-06 08:12:36'),
(1558, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:14:16', '2023-07-06 08:14:16'),
(1559, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Fugiat est ad volup\",\"name_of_applicant\":\"Fay Simmons\",\"applicant_phone_number\":\"+1 (342) 536-6834\",\"applicant_email\":\"tyni@mailinator.com\",\"premises_location\":\"Consequatur Optio\",\"proposed_farm_location\":\"Fugit qui dolores e\",\"years_of_experience\":\"Elliott Heath Associates\",\"gardening_history_description\":\"Eaque non esse volup\",\"storage_facilities_description\":\"Eum exercitationem u\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Odio beatae totam fu\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Elit earum harum et\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:14:26', '2023-07-06 08:14:26'),
(1560, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:14:27', '2023-07-06 08:14:27'),
(1561, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:14:53', '2023-07-06 08:14:53'),
(1562, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:14:56', '2023-07-06 08:14:56'),
(1563, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Voluptas fugiat seq\",\"name_of_applicant\":\"David Bell\",\"applicant_phone_number\":\"+1 (973) 547-5373\",\"applicant_email\":\"bime@mailinator.com\",\"premises_location\":\"Voluptatem aliqua\",\"proposed_farm_location\":\"Qui enim unde eum es\",\"years_of_experience\":\"Vang Vinson Co\",\"gardening_history_description\":\"Voluptate eos ut qui\",\"storage_facilities_description\":\"Consectetur porro e\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Modi quos rerum veri\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Cupiditate dolorum q\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:15:04', '2023-07-06 08:15:04'),
(1564, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:15:05', '2023-07-06 08:15:05'),
(1565, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:15:26', '2023-07-06 08:15:26'),
(1566, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Eveniet nobis ut vo\",\"name_of_applicant\":\"Herman Holden\",\"applicant_phone_number\":\"+1 (515) 979-6282\",\"applicant_email\":\"tony@mailinator.com\",\"premises_location\":\"Reprehenderit dolor\",\"proposed_farm_location\":\"Ut tempor sint eius\",\"years_of_experience\":\"Sargent Murray Trading\",\"gardening_history_description\":\"Et illum aute venia\",\"storage_facilities_description\":\"Ipsum eos deserunt\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Modi a vel et eius e\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Laborum in vel exerc\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:15:31', '2023-07-06 08:15:31'),
(1567, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:15:32', '2023-07-06 08:15:32'),
(1568, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:21:09', '2023-07-06 08:21:09'),
(1569, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Nisi id illum corru\",\"name_of_applicant\":\"Irene Moon\",\"applicant_phone_number\":\"+1 (698) 469-7574\",\"applicant_email\":\"valevuwa@mailinator.com\",\"premises_location\":\"Dolor ex est volupt\",\"proposed_farm_location\":\"Quidem aliquip numqu\",\"years_of_experience\":\"Benson Duke Trading\",\"gardening_history_description\":\"Aut irure fugiat odi\",\"storage_facilities_description\":\"Amet dolorem dolor\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Non voluptatem Dist\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Reiciendis exercitat\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:21:36', '2023-07-06 08:21:36'),
(1570, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:21:37', '2023-07-06 08:21:37'),
(1571, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:22:48', '2023-07-06 08:22:48'),
(1572, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Nisi laudantium ven\",\"name_of_applicant\":\"Glenna Walker\",\"applicant_phone_number\":\"+1 (375) 267-9548\",\"applicant_email\":\"kyqysocef@mailinator.com\",\"premises_location\":\"Expedita nulla ex vo\",\"proposed_farm_location\":\"Nulla suscipit est d\",\"years_of_experience\":\"Leblanc Cantu LLC\",\"gardening_history_description\":\"Deserunt libero sed\",\"storage_facilities_description\":\"Saepe laboris odio c\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Deserunt in voluptat\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Cupidatat in reprehe\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:22:54', '2023-07-06 08:22:54'),
(1573, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:22:55', '2023-07-06 08:22:55'),
(1574, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:23:25', '2023-07-06 08:23:25'),
(1575, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Dolor accusantium es\",\"name_of_applicant\":\"Blythe Hansen\",\"applicant_phone_number\":\"+1 (219) 731-4076\",\"applicant_email\":\"pixyvydijo@mailinator.com\",\"premises_location\":\"Animi est amet exp\",\"proposed_farm_location\":\"Rem aperiam ipsum e\",\"years_of_experience\":\"Nielsen Cantu Inc\",\"gardening_history_description\":\"Sequi aut earum enim\",\"storage_facilities_description\":\"Quaerat eveniet eiu\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Officia et in occaec\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Pariatur Minima ex\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:23:30', '2023-07-06 08:23:30'),
(1576, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:23:30', '2023-07-06 08:23:30'),
(1577, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Dolor accusantium es\",\"name_of_applicant\":\"Blythe Hansen\",\"applicant_phone_number\":\"+1 (219) 731-4076\",\"applicant_email\":\"pixyvydijo@mailinator.com\",\"premises_location\":\"Animi est amet exp\",\"proposed_farm_location\":\"Rem aperiam ipsum e\",\"years_of_experience\":\"Nielsen Cantu Inc\",\"gardening_history_description\":\"Sequi aut earum enim\",\"storage_facilities_description\":\"Quaerat eveniet eiu\",\"have_adequate_isolation\":\"off\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Officia et in occaec\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Pariatur Minima ex\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:23:32', '2023-07-06 08:23:32'),
(1578, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:23:33', '2023-07-06 08:23:33'),
(1579, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:24:18', '2023-07-06 08:24:18'),
(1580, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Molestiae beatae min\",\"name_of_applicant\":\"Zeus Gallagher\",\"applicant_phone_number\":\"+1 (117) 165-4082\",\"applicant_email\":\"xolujuxylo@mailinator.com\",\"premises_location\":\"Nihil qui in magni v\",\"proposed_farm_location\":\"Dicta labore in moll\",\"years_of_experience\":\"Ramos and Sims Plc\",\"gardening_history_description\":\"Expedita magna Nam a\",\"storage_facilities_description\":\"Dolorem et praesenti\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Quis ipsam eligendi\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Reprehenderit quod\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:24:24', '2023-07-06 08:24:24'),
(1581, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:24:24', '2023-07-06 08:24:24'),
(1582, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:26:09', '2023-07-06 08:26:09'),
(1583, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Placeat ex aut iure\",\"name_of_applicant\":\"Walter Scott\",\"applicant_phone_number\":\"+1 (104) 755-5187\",\"applicant_email\":\"fico@mailinator.com\",\"premises_location\":\"Ipsum rerum irure ve\",\"proposed_farm_location\":\"Aliquid voluptatibus\",\"years_of_experience\":\"Cantu and Clay LLC\",\"gardening_history_description\":\"Possimus in labore\",\"storage_facilities_description\":\"Ex ea qui consequat\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Est consequatur eaq\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Optio excepteur ven\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:26:15', '2023-07-06 08:26:15'),
(1584, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:26:15', '2023-07-06 08:26:15'),
(1585, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:26:52', '2023-07-06 08:26:52'),
(1586, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Aliquid dicta fuga\",\"name_of_applicant\":\"Ainsley Weber\",\"applicant_phone_number\":\"+1 (914) 413-3293\",\"applicant_email\":\"riwih@mailinator.com\",\"premises_location\":\"Eiusmod Nam qui ea r\",\"proposed_farm_location\":\"Sunt commodi provid\",\"years_of_experience\":\"Barnes Donovan Co\",\"gardening_history_description\":\"At nulla assumenda u\",\"storage_facilities_description\":\"In eveniet asperior\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Exercitationem labor\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Id pariatur Quidem\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:26:57', '2023-07-06 08:26:57'),
(1587, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:26:57', '2023-07-06 08:26:57'),
(1588, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:27:26', '2023-07-06 08:27:26'),
(1589, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Aliquid deleniti ut\",\"name_of_applicant\":\"Hyacinth Leon\",\"applicant_phone_number\":\"+1 (227) 135-2408\",\"applicant_email\":\"qovebu@mailinator.com\",\"premises_location\":\"Temporibus lorem acc\",\"proposed_farm_location\":\"Nisi qui tempora et\",\"years_of_experience\":\"Vasquez and Jackson LLC\",\"gardening_history_description\":\"Nostrud eaque sed in\",\"storage_facilities_description\":\"Anim quos quos quia\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Fugit et aut rerum\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Consectetur reicien\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:27:33', '2023-07-06 08:27:33'),
(1590, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:27:34', '2023-07-06 08:27:34'),
(1591, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:28:56', '2023-07-06 08:28:56'),
(1592, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Iusto do enim dolore\",\"name_of_applicant\":\"Orla Holden\",\"applicant_phone_number\":\"+1 (206) 685-8757\",\"applicant_email\":\"case@mailinator.com\",\"premises_location\":\"Et ipsum possimus\",\"proposed_farm_location\":\"Nulla cumque tempore\",\"years_of_experience\":\"Byers Petersen Traders\",\"gardening_history_description\":\"In ex optio eum ani\",\"storage_facilities_description\":\"Nostrum non quam est\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Asperiores quis aspe\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Praesentium in est p\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:29:01', '2023-07-06 08:29:01'),
(1593, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:29:01', '2023-07-06 08:29:01'),
(1594, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:32:23', '2023-07-06 08:32:23'),
(1595, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Perferendis qui fugi\",\"name_of_applicant\":\"Nero Zamora\",\"applicant_phone_number\":\"+1 (347) 925-7176\",\"applicant_email\":\"jicysezebe@mailinator.com\",\"premises_location\":\"A vitae voluptatem f\",\"proposed_farm_location\":\"Ex cillum voluptates\",\"years_of_experience\":\"Norton Cross Associates\",\"gardening_history_description\":\"Fugit voluptate lor\",\"storage_facilities_description\":\"Accusantium quo enim\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Tempor velit nostrud\",\"crops\":[\"1\",\"2\",null],\"search_terms\":null,\"receipt\":\"Consequuntur volupta\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\",\"after-save\":\"view\"}', '2023-07-06 08:32:31', '2023-07-06 08:32:31'),
(1596, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:32:32', '2023-07-06 08:32:32'),
(1597, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:49:48', '2023-07-06 08:49:48'),
(1598, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Et rem ullamco id ve\",\"name_of_applicant\":\"Wilma Battle\",\"applicant_phone_number\":\"+1 (573) 895-7243\",\"applicant_email\":\"gakeh@mailinator.com\",\"premises_location\":\"Quas dignissimos qui\",\"proposed_farm_location\":\"Iste quisquam aut as\",\"years_of_experience\":\"Sosa and Fitzgerald Inc\",\"gardening_history_description\":\"Neque nisi molestiae\",\"storage_facilities_description\":\"Corporis quia sed la\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Enim quia officiis n\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Enim nostrud sit non\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:49:54', '2023-07-06 08:49:54'),
(1599, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:49:55', '2023-07-06 08:49:55'),
(1600, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:51:04', '2023-07-06 08:51:04'),
(1601, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Ex eiusmod ea sed au\",\"name_of_applicant\":\"Harding Rodgers\",\"applicant_phone_number\":\"+1 (985) 899-9593\",\"applicant_email\":\"mybysipa@mailinator.com\",\"premises_location\":\"Ad quaerat excepturi\",\"proposed_farm_location\":\"Non lorem incidunt\",\"years_of_experience\":\"Bryan and Harrison Traders\",\"gardening_history_description\":\"Voluptatem Consequa\",\"storage_facilities_description\":\"Dignissimos eaque co\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Commodi id natus rei\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Enim qui ipsum elit\",\"_token\":\"r1igjsmYUvA6xEuLghMFSdDWYHk4xtH8hWhaVrrD\"}', '2023-07-06 08:51:10', '2023-07-06 08:51:10'),
(1602, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 08:51:10', '2023-07-06 08:51:10'),
(1603, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 10:55:06', '2023-07-06 10:55:06'),
(1604, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:04:34', '2023-07-06 11:04:34'),
(1605, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-06 11:04:42', '2023-07-06 11:04:42'),
(1606, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:04:44', '2023-07-06 11:04:44'),
(1607, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Quidem incididunt ex\",\"name_of_applicant\":\"Dalton Mckay\",\"applicant_phone_number\":\"+1 (312) 608-2655\",\"applicant_email\":\"kapapysas@mailinator.com\",\"premises_location\":\"Dicta magni dolores\",\"proposed_farm_location\":\"Delectus similique\",\"years_of_experience\":\"Walters and Hayes Co\",\"gardening_history_description\":\"Ut laudantium repud\",\"storage_facilities_description\":\"Anim dolore qui natu\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Consequatur molestia\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Repellendus Ipsum\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\",\"after-save\":\"view\"}', '2023-07-06 11:04:54', '2023-07-06 11:04:54'),
(1608, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:04:55', '2023-07-06 11:04:55'),
(1609, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:05:29', '2023-07-06 11:05:29'),
(1610, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Sint sed cillum quia\",\"name_of_applicant\":\"Vielka Collins\",\"applicant_phone_number\":\"+1 (575) 239-1274\",\"applicant_email\":\"lytete@mailinator.com\",\"premises_location\":\"Deserunt consectetur\",\"proposed_farm_location\":\"Et non non id tempor\",\"years_of_experience\":\"Guerra and Figueroa LLC\",\"gardening_history_description\":\"Minus dolore maxime\",\"storage_facilities_description\":\"Do doloremque consec\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Consequatur in est\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Non accusamus conseq\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\"}', '2023-07-06 11:05:38', '2023-07-06 11:05:38'),
(1611, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:05:38', '2023-07-06 11:05:38'),
(1612, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:06:11', '2023-07-06 11:06:11'),
(1613, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Cum proident velit\",\"name_of_applicant\":\"Tiger Morris\",\"applicant_phone_number\":\"+1 (972) 623-5592\",\"applicant_email\":\"nyjemim@mailinator.com\",\"premises_location\":\"Rerum odit Nam paria\",\"proposed_farm_location\":\"Nisi quis quia quo n\",\"years_of_experience\":\"Saunders Nixon Traders\",\"gardening_history_description\":\"Sed et et est quod q\",\"storage_facilities_description\":\"Magnam tempore fugi\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Adipisicing iste dic\",\"search_terms\":\"Quo\",\"crops\":[null],\"receipt\":\"Ad perspiciatis tem\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\"}', '2023-07-06 11:06:20', '2023-07-06 11:06:20'),
(1614, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:06:21', '2023-07-06 11:06:21'),
(1615, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:11:18', '2023-07-06 11:11:18'),
(1616, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Qui modi mollit veli\",\"name_of_applicant\":\"Hollee Lawson\",\"applicant_phone_number\":\"+1 (612) 764-1009\",\"applicant_email\":\"gugiho@mailinator.com\",\"premises_location\":\"Aliquam aspernatur e\",\"proposed_farm_location\":\"Animi dignissimos r\",\"years_of_experience\":\"Wilkins Watkins Inc\",\"gardening_history_description\":\"Eligendi consectetur\",\"storage_facilities_description\":\"Id nobis nulla aliqu\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Do est dolore incidu\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Adipisicing ipsum i\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\",\"after-save\":\"view\"}', '2023-07-06 11:11:29', '2023-07-06 11:11:29'),
(1617, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:11:30', '2023-07-06 11:11:30'),
(1618, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:20:13', '2023-07-06 11:20:13'),
(1619, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Consectetur dolorem\",\"name_of_applicant\":\"Cassandra Dixon\",\"applicant_phone_number\":\"+1 (554) 412-2012\",\"applicant_email\":\"wonejodowa@mailinator.com\",\"premises_location\":\"Minim sunt esse et o\",\"proposed_farm_location\":\"Sed molestiae laudan\",\"years_of_experience\":\"Morrison and Callahan Trading\",\"gardening_history_description\":\"Adipisci et et velit\",\"storage_facilities_description\":\"Officiis ut consequa\",\"have_adequate_isolation\":\"on\",\"have_adequate_isolation_cb\":\"on\",\"labor_details\":\"Velit ut tempore p\",\"crops\":[\"2\",null],\"search_terms\":null,\"receipt\":\"Voluptate nostrud es\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\"}', '2023-07-06 11:20:23', '2023-07-06 11:20:23'),
(1620, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:20:30', '2023-07-06 11:20:30'),
(1621, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-06 11:23:35', '2023-07-06 11:23:35'),
(1622, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_category\":\"Dolores quo dolor qu\",\"name_of_applicant\":\"Susan Mclaughlin\",\"applicant_phone_number\":\"+1 (573) 755-4714\",\"applicant_email\":\"soryxef@mailinator.com\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"years_of_experience\":\"Madden Malone Trading\",\"gardening_history_description\":\"Quo error vel vitae\",\"storage_facilities_description\":\"Error molestias illo\",\"have_adequate_isolation\":\"off\",\"labor_details\":\"Qui aliquip soluta m\",\"crops\":[\"1\",null],\"search_terms\":null,\"receipt\":\"Voluptatem sint en\",\"_token\":\"rPHZexKRKkT1jXaXKGE8ffcoPALeIaYP3rfEQJbA\"}', '2023-07-06 11:23:42', '2023-07-06 11:23:42'),
(1623, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-06 11:23:42', '2023-07-06 11:23:42'),
(1624, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-06 11:23:49', '2023-07-06 11:23:49'),
(1625, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:12', '2023-07-06 11:24:12'),
(1626, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:30', '2023-07-06 11:24:30'),
(1627, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:35', '2023-07-06 11:24:35'),
(1628, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:46', '2023-07-06 11:24:46'),
(1629, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:49', '2023-07-06 11:24:49'),
(1630, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:50', '2023-07-06 11:24:50'),
(1631, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:52', '2023-07-06 11:24:52'),
(1632, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:54', '2023-07-06 11:24:54'),
(1633, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:24:57', '2023-07-06 11:24:57'),
(1634, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:25:05', '2023-07-06 11:25:05'),
(1635, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:25:07', '2023-07-06 11:25:07'),
(1636, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:25:08', '2023-07-06 11:25:08'),
(1637, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:25:11', '2023-07-06 11:25:11'),
(1638, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:25:12', '2023-07-06 11:25:12'),
(1639, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:26:17', '2023-07-06 11:26:17'),
(1640, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:27:12', '2023-07-06 11:27:12'),
(1641, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:28:08', '2023-07-06 11:28:08'),
(1642, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:30:34', '2023-07-06 11:30:34'),
(1643, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:44:02', '2023-07-06 11:44:02'),
(1644, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:44:29', '2023-07-06 11:44:29'),
(1645, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:44:53', '2023-07-06 11:44:53'),
(1646, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:45:02', '2023-07-06 11:45:02'),
(1647, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:47:29', '2023-07-06 11:47:29'),
(1648, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:48:10', '2023-07-06 11:48:10'),
(1649, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:49:34', '2023-07-06 11:49:34'),
(1650, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:50:41', '2023-07-06 11:50:41'),
(1651, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:29', '2023-07-06 11:54:29'),
(1652, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:31', '2023-07-06 11:54:31'),
(1653, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:33', '2023-07-06 11:54:33'),
(1654, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:34', '2023-07-06 11:54:34'),
(1655, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:45', '2023-07-06 11:54:45'),
(1656, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:46', '2023-07-06 11:54:46'),
(1657, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:54:47', '2023-07-06 11:54:47'),
(1658, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-06 11:56:43', '2023-07-06 11:56:43'),
(1659, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 11:56:51', '2023-07-06 11:56:51'),
(1660, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 11:58:24', '2023-07-06 11:58:24'),
(1661, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 11:58:38', '2023-07-06 11:58:38'),
(1662, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 11:59:29', '2023-07-06 11:59:29'),
(1663, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 12:00:39', '2023-07-06 12:00:39'),
(1664, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 12:01:45', '2023-07-06 12:01:45'),
(1665, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 12:05:20', '2023-07-06 12:05:20'),
(1666, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 12:06:12', '2023-07-06 12:06:12'),
(1667, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-06 12:08:47', '2023-07-06 12:08:47'),
(1668, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:01:21', '2023-07-07 06:01:21'),
(1669, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:04:25', '2023-07-07 06:04:25'),
(1670, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:06:09', '2023-07-07 06:06:09'),
(1671, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:12:24', '2023-07-07 06:12:24'),
(1672, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:14:05', '2023-07-07 06:14:05'),
(1673, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:23:39', '2023-07-07 06:23:39'),
(1674, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:26:10', '2023-07-07 06:26:10'),
(1675, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:29:49', '2023-07-07 06:29:49'),
(1676, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 06:41:56', '2023-07-07 06:41:56'),
(1677, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:42:09', '2023-07-07 06:42:09'),
(1678, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:42:49', '2023-07-07 06:42:49'),
(1679, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:43:02', '2023-07-07 06:43:02'),
(1680, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:43:15', '2023-07-07 06:43:15'),
(1681, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:43:27', '2023-07-07 06:43:27'),
(1682, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:54:39', '2023-07-07 06:54:39'),
(1683, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 06:55:11', '2023-07-07 06:55:11'),
(1684, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 06:55:13', '2023-07-07 06:55:13'),
(1685, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 09:58:41', '2023-07-07 09:58:41'),
(1686, 47, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 09:58:46', '2023-07-07 09:58:46'),
(1687, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 09:58:48', '2023-07-07 09:58:48'),
(1688, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 09:58:54', '2023-07-07 09:58:54'),
(1689, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 09:58:56', '2023-07-07 09:58:56'),
(1690, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 09:59:49', '2023-07-07 09:59:49'),
(1691, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 09:59:54', '2023-07-07 09:59:54'),
(1692, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 09:59:55', '2023-07-07 09:59:55'),
(1693, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:00:51', '2023-07-07 10:00:51'),
(1694, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:00:56', '2023-07-07 10:00:56'),
(1695, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:00:57', '2023-07-07 10:00:57'),
(1696, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:01:48', '2023-07-07 10:01:48'),
(1697, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:01:52', '2023-07-07 10:01:52'),
(1698, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:01:53', '2023-07-07 10:01:53'),
(1699, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:02:23', '2023-07-07 10:02:23'),
(1700, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:02:27', '2023-07-07 10:02:27'),
(1701, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:02:27', '2023-07-07 10:02:27');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1702, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:12:39', '2023-07-07 10:12:39'),
(1703, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:13:04', '2023-07-07 10:13:04'),
(1704, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:13:10', '2023-07-07 10:13:10'),
(1705, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:13:11', '2023-07-07 10:13:11'),
(1706, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:13:42', '2023-07-07 10:13:42'),
(1707, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:13:46', '2023-07-07 10:13:46'),
(1708, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:13:47', '2023-07-07 10:13:47'),
(1709, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:14:09', '2023-07-07 10:14:09'),
(1710, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:14:14', '2023-07-07 10:14:14'),
(1711, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:14:19', '2023-07-07 10:14:19'),
(1712, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:14:20', '2023-07-07 10:14:20'),
(1713, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:14:46', '2023-07-07 10:14:46'),
(1714, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:14:50', '2023-07-07 10:14:50'),
(1715, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:14:57', '2023-07-07 10:14:57'),
(1716, 47, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:16:21', '2023-07-07 10:16:21'),
(1717, 47, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"name_of_applicant\":\"Susan Mclaughlin\",\"premises_location\":\"Eius ullamco sunt eo\",\"proposed_farm_location\":\"Qui velit voluptas q\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"1\",\"_token\":\"5XAECQUHsYqWlyuc7AlF9LfZZ80NsMSXUVdnoCQY\",\"_method\":\"PUT\"}', '2023-07-07 10:16:25', '2023-07-07 10:16:25'),
(1718, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 10:16:29', '2023-07-07 10:16:29'),
(1719, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 10:16:41', '2023-07-07 10:16:41'),
(1720, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 10:16:52', '2023-07-07 10:16:52'),
(1721, 49, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 10:17:00', '2023-07-07 10:17:00'),
(1722, 49, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:17:03', '2023-07-07 10:17:03'),
(1723, 49, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:18:46', '2023-07-07 10:18:46'),
(1724, 49, 'admin/seed-producers/34/edit', 'GET', '127.0.0.1', '[]', '2023-07-07 10:19:36', '2023-07-07 10:19:36'),
(1725, 49, 'admin/seed-producers/34', 'PUT', '127.0.0.1', '{\"user_id\":\"48\",\"status\":\"3\",\"producer_registration_number\":\"SeedProducer\\/10609615\",\"grower_number\":\"Grower\\/75976427\",\"valid_from\":\"2023-07-07 13:19:36\",\"valid_until\":\"2023-07-29 13:19:36\",\"status_comment\":null,\"_token\":\"fEmufHhEXK8hnIs0GHJdGWbpznI5UNOIsaoyaWHS\",\"_method\":\"PUT\"}', '2023-07-07 10:19:53', '2023-07-07 10:19:53'),
(1726, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 10:19:57', '2023-07-07 10:19:57'),
(1727, 49, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 10:20:02', '2023-07-07 10:20:02'),
(1728, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-07 10:20:26', '2023-07-07 10:20:26'),
(1729, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-07 10:20:35', '2023-07-07 10:20:35'),
(1730, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 10:47:23', '2023-07-07 10:47:23'),
(1731, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:15:09', '2023-07-07 11:15:09'),
(1732, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:16:08', '2023-07-07 11:16:08'),
(1733, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:26:27', '2023-07-07 11:26:27'),
(1734, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:31:58', '2023-07-07 11:31:58'),
(1735, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:34:21', '2023-07-07 11:34:21'),
(1736, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:36:21', '2023-07-07 11:36:21'),
(1737, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:39:10', '2023-07-07 11:39:10'),
(1738, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:40:04', '2023-07-07 11:40:04'),
(1739, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:47:33', '2023-07-07 11:47:33'),
(1740, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:47:35', '2023-07-07 11:47:35'),
(1741, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:48:16', '2023-07-07 11:48:16'),
(1742, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-07 11:50:26', '2023-07-07 11:50:26'),
(1743, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 11:50:29', '2023-07-07 11:50:29'),
(1744, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 11:50:42', '2023-07-07 11:50:42'),
(1745, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 11:51:54', '2023-07-07 11:51:54'),
(1746, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 11:52:48', '2023-07-07 11:52:48'),
(1747, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 11:55:48', '2023-07-07 11:55:48'),
(1748, 47, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_sort\":{\"column\":\"status\",\"type\":\"desc\"}}', '2023-07-07 12:02:23', '2023-07-07 12:02:23'),
(1749, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 06:27:15', '2023-07-08 06:27:15'),
(1750, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:00', '2023-07-08 06:28:00'),
(1751, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:01', '2023-07-08 06:28:01'),
(1752, 1, 'admin/auth/menu/28/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:05', '2023-07-08 06:28:05'),
(1753, 1, 'admin/auth/menu/28', 'PUT', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-seedling\",\"uri\":\"crop-declarations\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"wKcKdoIQdCa52vxkJGxnR0ZK73QEGH6RGQ4OlPZr\",\"_method\":\"PUT\"}', '2023-07-08 06:28:39', '2023-07-08 06:28:39'),
(1754, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:40', '2023-07-08 06:28:40'),
(1755, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:44', '2023-07-08 06:28:44'),
(1756, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:48', '2023-07-08 06:28:48'),
(1757, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:28:57', '2023-07-08 06:28:57'),
(1758, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 06:29:00', '2023-07-08 06:29:00'),
(1759, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:32:05', '2023-07-08 06:32:05'),
(1760, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"22\",\"search_terms\":null,\"title\":\"Inspection Types\",\"icon\":\"icon-check-circle\",\"uri\":\"inspection-types\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"wKcKdoIQdCa52vxkJGxnR0ZK73QEGH6RGQ4OlPZr\"}', '2023-07-08 06:33:09', '2023-07-08 06:33:09'),
(1761, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-08 06:33:09', '2023-07-08 06:33:09'),
(1762, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:29', '2023-07-08 06:44:29'),
(1763, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:32', '2023-07-08 06:44:32'),
(1764, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:36', '2023-07-08 06:44:36'),
(1765, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:39', '2023-07-08 06:44:39'),
(1766, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:42', '2023-07-08 06:44:42'),
(1767, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:46', '2023-07-08 06:44:46'),
(1768, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:49', '2023-07-08 06:44:49'),
(1769, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:50', '2023-07-08 06:44:50'),
(1770, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:52', '2023-07-08 06:44:52'),
(1771, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:53', '2023-07-08 06:44:53'),
(1772, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:54', '2023-07-08 06:44:54'),
(1773, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:55', '2023-07-08 06:44:55'),
(1774, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:56', '2023-07-08 06:44:56'),
(1775, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:56', '2023-07-08 06:44:56'),
(1776, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:57', '2023-07-08 06:44:57'),
(1777, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:57', '2023-07-08 06:44:57'),
(1778, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:58', '2023-07-08 06:44:58'),
(1779, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:58', '2023-07-08 06:44:58'),
(1780, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:44:59', '2023-07-08 06:44:59'),
(1781, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:45:00', '2023-07-08 06:45:00'),
(1782, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:45:00', '2023-07-08 06:45:00'),
(1783, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:45:01', '2023-07-08 06:45:01'),
(1784, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:45:11', '2023-07-08 06:45:11'),
(1785, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:47:50', '2023-07-08 06:47:50'),
(1786, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:48:25', '2023-07-08 06:48:25'),
(1787, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:37', '2023-07-08 06:49:37'),
(1788, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:41', '2023-07-08 06:49:41'),
(1789, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:43', '2023-07-08 06:49:43'),
(1790, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:44', '2023-07-08 06:49:44'),
(1791, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:45', '2023-07-08 06:49:45'),
(1792, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:46', '2023-07-08 06:49:46'),
(1793, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:47', '2023-07-08 06:49:47'),
(1794, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:48', '2023-07-08 06:49:48'),
(1795, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:49', '2023-07-08 06:49:49'),
(1796, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:50', '2023-07-08 06:49:50'),
(1797, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:50', '2023-07-08 06:49:50'),
(1798, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:51', '2023-07-08 06:49:51'),
(1799, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:52', '2023-07-08 06:49:52'),
(1800, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:53', '2023-07-08 06:49:53'),
(1801, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:54', '2023-07-08 06:49:54'),
(1802, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:55', '2023-07-08 06:49:55'),
(1803, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:56', '2023-07-08 06:49:56'),
(1804, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:57', '2023-07-08 06:49:57'),
(1805, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:58', '2023-07-08 06:49:58'),
(1806, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:49:59', '2023-07-08 06:49:59'),
(1807, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:50:00', '2023-07-08 06:50:00'),
(1808, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:50:00', '2023-07-08 06:50:00'),
(1809, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:50:01', '2023-07-08 06:50:01'),
(1810, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:51:24', '2023-07-08 06:51:24'),
(1811, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 06:53:01', '2023-07-08 06:53:01'),
(1812, 1, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"wKcKdoIQdCa52vxkJGxnR0ZK73QEGH6RGQ4OlPZr\",\"username\":\"admin\",\"password\":\"*****-filtered-out-*****\"}', '2023-07-08 07:10:32', '2023-07-08 07:10:32'),
(1813, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 07:10:34', '2023-07-08 07:10:34'),
(1814, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:10:43', '2023-07-08 07:10:43'),
(1815, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:10:47', '2023-07-08 07:10:47'),
(1816, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:11:03', '2023-07-08 07:11:03'),
(1817, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:11:42', '2023-07-08 07:11:42'),
(1818, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:11:48', '2023-07-08 07:11:48'),
(1819, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:11:50', '2023-07-08 07:11:50'),
(1820, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:12:21', '2023-07-08 07:12:21'),
(1821, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:12:24', '2023-07-08 07:12:24'),
(1822, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:12:28', '2023-07-08 07:12:28'),
(1823, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:12:33', '2023-07-08 07:12:33'),
(1824, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:12:35', '2023-07-08 07:12:35'),
(1825, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:13:04', '2023-07-08 07:13:04'),
(1826, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:13:10', '2023-07-08 07:13:10'),
(1827, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:13:27', '2023-07-08 07:13:27'),
(1828, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:13:31', '2023-07-08 07:13:31'),
(1829, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:13:32', '2023-07-08 07:13:32'),
(1830, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:14:14', '2023-07-08 07:14:14'),
(1831, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:27:06', '2023-07-08 07:27:06'),
(1832, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:27:28', '2023-07-08 07:27:28'),
(1833, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:28:04', '2023-07-08 07:28:04'),
(1834, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:29:53', '2023-07-08 07:29:53'),
(1835, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:29:56', '2023-07-08 07:29:56'),
(1836, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:29:58', '2023-07-08 07:29:58'),
(1837, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:30:27', '2023-07-08 07:30:27'),
(1838, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:30:29', '2023-07-08 07:30:29'),
(1839, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:30:31', '2023-07-08 07:30:31'),
(1840, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:30:37', '2023-07-08 07:30:37'),
(1841, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 07:31:06', '2023-07-08 07:31:06'),
(1842, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:31:19', '2023-07-08 07:31:19'),
(1843, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-08 07:31:36', '2023-07-08 07:31:36'),
(1844, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:31:47', '2023-07-08 07:31:47'),
(1845, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-08 07:32:05', '2023-07-08 07:32:05'),
(1846, 1, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:32:11', '2023-07-08 07:32:11'),
(1847, 1, 'admin/auth/permissions', 'POST', '127.0.0.1', '{\"slug\":\"crop declaration\",\"name\":\"Crop Declaration\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/crop-declarations*\",\"_token\":\"9lLTJmReoAIkLTSrrqDhm8bmysHeSSt71zweDV8z\"}', '2023-07-08 07:33:04', '2023-07-08 07:33:04'),
(1848, 1, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:04', '2023-07-08 07:33:04'),
(1849, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:13', '2023-07-08 07:33:13'),
(1850, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:31', '2023-07-08 07:33:31'),
(1851, 1, 'admin/auth/users/48/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:35', '2023-07-08 07:33:35'),
(1852, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:39', '2023-07-08 07:33:39'),
(1853, 1, 'admin/auth/roles/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 07:33:46', '2023-07-08 07:33:46'),
(1854, 1, 'admin/auth/roles/3', 'PUT', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"2\",\"3\",\"4\",\"5\",\"10\",\"11\",null],\"_token\":\"9lLTJmReoAIkLTSrrqDhm8bmysHeSSt71zweDV8z\",\"_method\":\"PUT\"}', '2023-07-08 07:34:01', '2023-07-08 07:34:01'),
(1855, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:02', '2023-07-08 07:34:02'),
(1856, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:07', '2023-07-08 07:34:07'),
(1857, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:09', '2023-07-08 07:34:09'),
(1858, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:17', '2023-07-08 07:34:17'),
(1859, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:37', '2023-07-08 07:34:37'),
(1860, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:40', '2023-07-08 07:34:40'),
(1861, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:34:41', '2023-07-08 07:34:41'),
(1862, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:02', '2023-07-08 07:37:02'),
(1863, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:06', '2023-07-08 07:37:06'),
(1864, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:08', '2023-07-08 07:37:08'),
(1865, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:14', '2023-07-08 07:37:14'),
(1866, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:16', '2023-07-08 07:37:16'),
(1867, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:37:17', '2023-07-08 07:37:17'),
(1868, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:38:22', '2023-07-08 07:38:22'),
(1869, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:38:27', '2023-07-08 07:38:27'),
(1870, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:43:50', '2023-07-08 07:43:50'),
(1871, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:43:55', '2023-07-08 07:43:55'),
(1872, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:44:11', '2023-07-08 07:44:11'),
(1873, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:44:16', '2023-07-08 07:44:16'),
(1874, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 07:44:24', '2023-07-08 07:44:24'),
(1875, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:43', '2023-07-08 10:04:43'),
(1876, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:48', '2023-07-08 10:04:48'),
(1877, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:50', '2023-07-08 10:04:50'),
(1878, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:52', '2023-07-08 10:04:52'),
(1879, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:52', '2023-07-08 10:04:52'),
(1880, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:53', '2023-07-08 10:04:53'),
(1881, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:53', '2023-07-08 10:04:53'),
(1882, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:54', '2023-07-08 10:04:54'),
(1883, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:54', '2023-07-08 10:04:54'),
(1884, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:54', '2023-07-08 10:04:54'),
(1885, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:55', '2023-07-08 10:04:55'),
(1886, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:55', '2023-07-08 10:04:55'),
(1887, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:56', '2023-07-08 10:04:56'),
(1888, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:56', '2023-07-08 10:04:56'),
(1889, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:57', '2023-07-08 10:04:57'),
(1890, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:57', '2023-07-08 10:04:57'),
(1891, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:58', '2023-07-08 10:04:58'),
(1892, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:58', '2023-07-08 10:04:58'),
(1893, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:59', '2023-07-08 10:04:59'),
(1894, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:04:59', '2023-07-08 10:04:59'),
(1895, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:05:00', '2023-07-08 10:05:00'),
(1896, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:05:00', '2023-07-08 10:05:00'),
(1897, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:05:01', '2023-07-08 10:05:01'),
(1898, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:06:09', '2023-07-08 10:06:09'),
(1899, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:06:55', '2023-07-08 10:06:55'),
(1900, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 10:08:57', '2023-07-08 10:08:57'),
(1901, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:18', '2023-07-08 12:31:18'),
(1902, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:25', '2023-07-08 12:31:25'),
(1903, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:28', '2023-07-08 12:31:28'),
(1904, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:31', '2023-07-08 12:31:31'),
(1905, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:33', '2023-07-08 12:31:33'),
(1906, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:34', '2023-07-08 12:31:34'),
(1907, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:36', '2023-07-08 12:31:36'),
(1908, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:37', '2023-07-08 12:31:37'),
(1909, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:39', '2023-07-08 12:31:39'),
(1910, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:40', '2023-07-08 12:31:40'),
(1911, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:41', '2023-07-08 12:31:41'),
(1912, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:43', '2023-07-08 12:31:43'),
(1913, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:44', '2023-07-08 12:31:44'),
(1914, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:46', '2023-07-08 12:31:46'),
(1915, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:47', '2023-07-08 12:31:47'),
(1916, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:49', '2023-07-08 12:31:49'),
(1917, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:50', '2023-07-08 12:31:50'),
(1918, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:51', '2023-07-08 12:31:51'),
(1919, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:53', '2023-07-08 12:31:53'),
(1920, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:54', '2023-07-08 12:31:54'),
(1921, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:56', '2023-07-08 12:31:56'),
(1922, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:57', '2023-07-08 12:31:57'),
(1923, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:31:59', '2023-07-08 12:31:59'),
(1924, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:32:37', '2023-07-08 12:32:37'),
(1925, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:34:12', '2023-07-08 12:34:12'),
(1926, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 12:35:00', '2023-07-08 12:35:00'),
(1927, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '[]', '2023-07-08 12:35:06', '2023-07-08 12:35:06'),
(1928, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-08 12:35:09', '2023-07-08 12:35:09'),
(1929, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:35:11', '2023-07-08 12:35:11'),
(1930, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:35:46', '2023-07-08 12:35:46'),
(1931, 1, 'admin/inspection-types', 'POST', '127.0.0.1', '{\"inspection_type_name\":\"Pre-flowering\",\"period_after_planting\":\"40\",\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\"}', '2023-07-08 12:36:00', '2023-07-08 12:36:00'),
(1932, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:00', '2023-07-08 12:36:00'),
(1933, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:03', '2023-07-08 12:36:03'),
(1934, 1, 'admin/inspection-types', 'POST', '127.0.0.1', '{\"inspection_type_name\":\"Flowering\",\"period_after_planting\":\"50\",\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\"}', '2023-07-08 12:36:18', '2023-07-08 12:36:18'),
(1935, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:19', '2023-07-08 12:36:19'),
(1936, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:22', '2023-07-08 12:36:22'),
(1937, 1, 'admin/inspection-types', 'POST', '127.0.0.1', '{\"inspection_type_name\":\"Pre-harvest\",\"period_after_planting\":\"30\",\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\"}', '2023-07-08 12:36:36', '2023-07-08 12:36:36'),
(1938, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:37', '2023-07-08 12:36:37'),
(1939, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:52', '2023-07-08 12:36:52'),
(1940, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:36:54', '2023-07-08 12:36:54'),
(1941, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_inspections\":\"3\",\"number_of_days_before_submission\":\"20\",\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Tiger Booker\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Indira Savage\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"Rooney Burt\",\"id\":null,\"_remove_\":\"0\"},\"new_4\":{\"crop_variety_name\":\"Cyrus Holden\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\",\"after-save\":\"view\"}', '2023-07-08 12:37:38', '2023-07-08 12:37:38'),
(1942, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:37:38', '2023-07-08 12:37:38'),
(1943, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_inspections\":\"3\",\"number_of_days_before_submission\":\"20\",\"crop_varieties\":{\"new___LA_KEY__\":{\"crop_variety_name\":\"Cyrus Holden\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\"}', '2023-07-08 12:37:40', '2023-07-08 12:37:40'),
(1944, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:37:40', '2023-07-08 12:37:40'),
(1945, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:39:50', '2023-07-08 12:39:50'),
(1946, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_inspections\":\"3\",\"number_of_days_before_submission\":\"20\",\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Kasper Thompson\",\"crop_variety_code\":\"KT-Maize\",\"crop_variety_generation\":\"Elit dolore non id\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Ursula Salazar\",\"crop_variety_code\":\"US-Maize\",\"crop_variety_generation\":\"Assumenda ullamco au\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"Tashya Ferguson\",\"crop_variety_code\":\"TF-Maize\",\"crop_variety_generation\":\"Occaecat qui sit quo\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\"}', '2023-07-08 12:40:56', '2023-07-08 12:40:56'),
(1947, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 12:40:57', '2023-07-08 12:40:57'),
(1948, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:40:59', '2023-07-08 12:40:59'),
(1949, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Beans\",\"number_of_inspections\":\"2\",\"number_of_days_before_submission\":\"979\",\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Carter Rivers\",\"crop_variety_code\":\"FR-Beans\",\"crop_variety_generation\":\"Vitae id laudantium\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Howard Velasquez\",\"crop_variety_code\":\"HV-Beans\",\"crop_variety_generation\":\"Qui saepe commodi of\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"vjccHOReOwyEf62OnYPcOCgyqFF4ou3uIirX5mpZ\",\"after-save\":\"view\"}', '2023-07-08 12:41:39', '2023-07-08 12:41:39'),
(1950, 1, 'admin/crops/6', 'GET', '127.0.0.1', '[]', '2023-07-08 12:41:40', '2023-07-08 12:41:40'),
(1951, 1, 'admin/crops/6', 'GET', '127.0.0.1', '[]', '2023-07-08 12:44:45', '2023-07-08 12:44:45'),
(1952, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 12:44:56', '2023-07-08 12:44:56'),
(1953, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 12:45:07', '2023-07-08 12:45:07'),
(1954, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:32', '2023-07-08 13:02:32'),
(1955, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:35', '2023-07-08 13:02:35'),
(1956, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:36', '2023-07-08 13:02:36'),
(1957, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:37', '2023-07-08 13:02:37'),
(1958, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:39', '2023-07-08 13:02:39'),
(1959, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:40', '2023-07-08 13:02:40'),
(1960, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:42', '2023-07-08 13:02:42'),
(1961, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:43', '2023-07-08 13:02:43'),
(1962, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:44', '2023-07-08 13:02:44'),
(1963, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:46', '2023-07-08 13:02:46'),
(1964, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:47', '2023-07-08 13:02:47'),
(1965, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:48', '2023-07-08 13:02:48'),
(1966, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:50', '2023-07-08 13:02:50'),
(1967, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:51', '2023-07-08 13:02:51'),
(1968, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:52', '2023-07-08 13:02:52'),
(1969, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:54', '2023-07-08 13:02:54'),
(1970, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:55', '2023-07-08 13:02:55'),
(1971, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:56', '2023-07-08 13:02:56'),
(1972, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:58', '2023-07-08 13:02:58'),
(1973, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:02:59', '2023-07-08 13:02:59'),
(1974, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:03:01', '2023-07-08 13:03:01'),
(1975, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:03:02', '2023-07-08 13:03:02'),
(1976, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:03:34', '2023-07-08 13:03:34'),
(1977, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:05:07', '2023-07-08 13:05:07'),
(1978, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:05:17', '2023-07-08 13:05:17'),
(1979, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:05:21', '2023-07-08 13:05:21'),
(1980, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:05:23', '2023-07-08 13:05:23'),
(1981, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:07:40', '2023-07-08 13:07:40'),
(1982, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:07:43', '2023-07-08 13:07:43'),
(1983, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:07:46', '2023-07-08 13:07:46'),
(1984, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:09:52', '2023-07-08 13:09:52'),
(1985, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:09:54', '2023-07-08 13:09:54'),
(1986, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:09:56', '2023-07-08 13:09:56'),
(1987, 48, 'admin/seed-producers/34', 'GET', '127.0.0.1', '[]', '2023-07-08 13:09:58', '2023-07-08 13:09:58'),
(1988, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:11:13', '2023-07-08 13:11:13'),
(1989, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:13:13', '2023-07-08 13:13:13'),
(1990, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:14:14', '2023-07-08 13:14:14'),
(1991, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"Tamekah Carter\",\"phone_number\":\"+1 (236) 567-9079\",\"applicant_registration_number\":\"498\",\"seed_producer_id\":\"34\",\"garden_size\":\"333330\",\"gps_coordinates_1\":\"88880\",\"gps_coordinates_2\":\"877540\",\"gps_coordinates_3\":\"897760\",\"gps_coordinates_4\":\"789960\",\"field_name\":\"Anika Cleveland\",\"district_region\":\"Ut in inventore aut\",\"circle\":\"Nostrud adipisci sun\",\"township\":\"Omnis nihil mollit n\",\"village\":\"Non sint at eum con\",\"planting_date\":\"2012-01-01\",\"quantity_of_seed_planted\":\"421\",\"expected_yield\":\"64\",\"seed_supplier_name\":\"Lara Fulton\",\"seed_supplier_registration_number\":\"188\",\"source_lot_number\":\"SA34523\",\"origin_of_variety\":\"Sunt sint eos mole\",\"garden_location_latitude\":\"88990\",\"garden_location_longitude\":\"88760\",\"crop_varieties\":[\"4\",\"2\",\"1\",\"5\",\"3\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\",\"after-save\":\"view\"}', '2023-07-08 13:16:51', '2023-07-08 13:16:51'),
(1992, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:16:51', '2023-07-08 13:16:51'),
(1993, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:25:05', '2023-07-08 13:25:05'),
(1994, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:25:29', '2023-07-08 13:25:29'),
(1995, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:25:32', '2023-07-08 13:25:32'),
(1996, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:27:31', '2023-07-08 13:27:31'),
(1997, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"applicant_name\":\"Tamekah Carter\",\"phone_number\":\"+1 (638) 526-3856\",\"applicant_registration_number\":\"681\",\"seed_producer_id\":\"34\",\"garden_size\":\"6677880\",\"gps_coordinates_1\":\"888750\",\"gps_coordinates_2\":\"78890\",\"gps_coordinates_3\":\"87640\",\"gps_coordinates_4\":\"976540\",\"field_name\":\"Willa Vang\",\"district_region\":\"Voluptate voluptas q\",\"circle\":\"Eum in quae dolor re\",\"township\":\"Nisi quia earum aute\",\"village\":\"Aliqua Id non ut p\",\"planting_date\":\"1975-01-01\",\"quantity_of_seed_planted\":\"120\",\"expected_yield\":\"41\",\"seed_supplier_name\":\"Erica Greene\",\"seed_supplier_registration_number\":\"728\",\"source_lot_number\":\"847\",\"origin_of_variety\":\"Ducimus adipisci qu\",\"garden_location_latitude\":\"54320\",\"garden_location_longitude\":\"98870\",\"crop_varieties\":[\"4\",\"1\",\"2\",\"5\",\"3\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\",\"after-save\":\"view\"}', '2023-07-08 13:28:46', '2023-07-08 13:28:46'),
(1998, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:28:47', '2023-07-08 13:28:47'),
(1999, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"applicant_name\":\"Tamekah Carter\",\"phone_number\":\"+1 (638) 526-3856\",\"applicant_registration_number\":\"681\",\"seed_producer_id\":\"34\",\"garden_size\":\"6677880\",\"gps_coordinates_1\":\"888750\",\"gps_coordinates_2\":\"78890\",\"gps_coordinates_3\":\"87640\",\"gps_coordinates_4\":\"976540\",\"field_name\":\"Willa Vang\",\"district_region\":\"Voluptate voluptas q\",\"circle\":\"Eum in quae dolor re\",\"township\":\"Nisi quia earum aute\",\"village\":\"Aliqua Id non ut p\",\"planting_date\":\"1975-01-01\",\"quantity_of_seed_planted\":\"120\",\"expected_yield\":\"41\",\"seed_supplier_name\":\"Erica Greene\",\"seed_supplier_registration_number\":\"728\",\"source_lot_number\":\"847\",\"origin_of_variety\":\"Ducimus adipisci qu\",\"garden_location_latitude\":\"54320\",\"garden_location_longitude\":\"98870\",\"crop_varieties\":[\"4\",\"5\",\"1\",\"3\",\"2\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\"}', '2023-07-08 13:30:30', '2023-07-08 13:30:30'),
(2000, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:30:31', '2023-07-08 13:30:31'),
(2001, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"phone_number\":\"+1 (638) 526-3856\",\"applicant_registration_number\":\"681\",\"seed_producer_id\":\"34\",\"garden_size\":\"5.0\",\"gps_coordinates_1\":\"888750\",\"gps_coordinates_2\":\"78890\",\"gps_coordinates_3\":\"87640\",\"gps_coordinates_4\":\"976540\",\"field_name\":\"Willa Vang\",\"district_region\":\"Voluptate voluptas q\",\"circle\":\"Eum in quae dolor re\",\"township\":\"Nisi quia earum aute\",\"village\":\"Aliqua Id non ut p\",\"planting_date\":\"1975-01-01\",\"quantity_of_seed_planted\":\"120\",\"expected_yield\":\"41\",\"seed_supplier_name\":\"Erica Greene\",\"seed_supplier_registration_number\":\"728\",\"source_lot_number\":\"847\",\"origin_of_variety\":\"Ducimus adipisci qu\",\"garden_location_latitude\":\"54320\",\"garden_location_longitude\":\"98870\",\"crop_varieties\":[\"4\",\"5\",\"1\",\"3\",\"2\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\"}', '2023-07-08 13:31:03', '2023-07-08 13:31:03'),
(2002, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:31:04', '2023-07-08 13:31:04'),
(2003, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"phone_number\":\"+1 (638) 526-3856\",\"applicant_registration_number\":\"681\",\"seed_producer_id\":\"34\",\"garden_size\":\"5.0\",\"gps_coordinates_1\":\"11.0\",\"gps_coordinates_2\":\"56.0\",\"gps_coordinates_3\":\"89.0\",\"gps_coordinates_4\":\"4.0\",\"field_name\":\"Willa Vang\",\"district_region\":\"Voluptate voluptas q\",\"circle\":\"Eum in quae dolor re\",\"township\":\"Nisi quia earum aute\",\"village\":\"Aliqua Id non ut p\",\"planting_date\":\"1975-01-01\",\"quantity_of_seed_planted\":\"120\",\"expected_yield\":\"41\",\"seed_supplier_name\":\"Erica Greene\",\"seed_supplier_registration_number\":\"728\",\"source_lot_number\":\"847\",\"origin_of_variety\":\"Ducimus adipisci qu\",\"garden_location_latitude\":\"8.0\",\"garden_location_longitude\":\"7.0\",\"crop_varieties\":[\"4\",\"5\",\"1\",\"3\",\"2\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\"}', '2023-07-08 13:32:16', '2023-07-08 13:32:16'),
(2004, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:32:16', '2023-07-08 13:32:16'),
(2005, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:33:18', '2023-07-08 13:33:18'),
(2006, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:35:56', '2023-07-08 13:35:56'),
(2007, 48, 'admin/crop-declarations/1', 'GET', '127.0.0.1', '[]', '2023-07-08 13:35:58', '2023-07-08 13:35:58'),
(2008, 48, 'admin/crop-declarations/1', 'GET', '127.0.0.1', '[]', '2023-07-08 13:36:27', '2023-07-08 13:36:27'),
(2009, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:36:30', '2023-07-08 13:36:30'),
(2010, 48, 'admin/crop-declarations/1', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\"}', '2023-07-08 13:36:34', '2023-07-08 13:36:34'),
(2011, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:36:34', '2023-07-08 13:36:34'),
(2012, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:36:37', '2023-07-08 13:36:37'),
(2013, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"phone_number\":\"+1 (234) 312-1942\",\"applicant_registration_number\":\"218\",\"seed_producer_id\":\"34\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Jason Bray\",\"district_region\":\"Necessitatibus perfe\",\"circle\":\"Ad dolor fugiat labo\",\"township\":\"Assumenda explicabo\",\"village\":\"Autem et unde facili\",\"planting_date\":\"1996-01-01\",\"quantity_of_seed_planted\":\"663\",\"expected_yield\":\"23\",\"seed_supplier_name\":\"Miranda Lamb\",\"seed_supplier_registration_number\":\"118\",\"source_lot_number\":\"366\",\"origin_of_variety\":\"Veniam dolorum aut\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"crop_varieties\":[\"4\",\"5\",\"1\",\"3\",\"2\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\",\"after-save\":\"view\"}', '2023-07-08 13:37:38', '2023-07-08 13:37:38'),
(2014, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:37:39', '2023-07-08 13:37:39'),
(2015, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 13:37:49', '2023-07-08 13:37:49'),
(2016, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"phone_number\":\"+1 (944) 436-8308\",\"applicant_registration_number\":\"192\",\"seed_producer_id\":\"34\",\"garden_size\":\"5.0\",\"gps_coordinates_1\":\"5.0\",\"gps_coordinates_2\":\"5.0\",\"gps_coordinates_3\":\"8.0\",\"gps_coordinates_4\":\"9.0\",\"field_name\":\"Neil Burke\",\"district_region\":\"Ad sint molestias ex\",\"circle\":\"Vero id recusandae\",\"township\":\"Cillum omnis nulla d\",\"village\":\"Veniam reiciendis q\",\"planting_date\":\"1991-01-01\",\"quantity_of_seed_planted\":\"530\",\"expected_yield\":\"37\",\"seed_supplier_name\":\"Addison Fisher\",\"seed_supplier_registration_number\":\"836\",\"source_lot_number\":\"421\",\"origin_of_variety\":\"Facilis velit dolore\",\"garden_location_latitude\":\"9.0\",\"garden_location_longitude\":\"8.0\",\"crop_varieties\":[\"4\",\"5\",\"1\",\"3\",\"2\",null],\"search_terms\":null,\"_token\":\"tfnnhz4fRY4Q3kMlgJNLol7U5yZP0ZzktZmVARhI\"}', '2023-07-08 13:38:57', '2023-07-08 13:38:57'),
(2017, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 13:39:13', '2023-07-08 13:39:13'),
(2018, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 13:39:28', '2023-07-08 13:39:28'),
(2019, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 13:40:18', '2023-07-08 13:40:18'),
(2020, 47, 'admin/crop-declarations/2', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:12', '2023-07-08 13:43:12'),
(2021, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:18', '2023-07-08 13:43:18'),
(2022, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:22', '2023-07-08 13:43:22'),
(2023, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:25', '2023-07-08 13:43:25'),
(2024, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:28', '2023-07-08 13:43:28'),
(2025, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:31', '2023-07-08 13:43:31'),
(2026, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:35', '2023-07-08 13:43:35'),
(2027, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:38', '2023-07-08 13:43:38'),
(2028, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:41', '2023-07-08 13:43:41'),
(2029, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:44', '2023-07-08 13:43:44'),
(2030, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:48', '2023-07-08 13:43:48'),
(2031, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:51', '2023-07-08 13:43:51'),
(2032, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:54', '2023-07-08 13:43:54'),
(2033, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:57', '2023-07-08 13:43:57'),
(2034, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:43:59', '2023-07-08 13:43:59'),
(2035, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:02', '2023-07-08 13:44:02'),
(2036, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:05', '2023-07-08 13:44:05'),
(2037, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:08', '2023-07-08 13:44:08'),
(2038, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:11', '2023-07-08 13:44:11'),
(2039, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:15', '2023-07-08 13:44:15'),
(2040, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:18', '2023-07-08 13:44:18');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(2041, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 13:44:21', '2023-07-08 13:44:21'),
(2042, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:14:55', '2023-07-08 14:14:55'),
(2043, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:00', '2023-07-08 14:15:00'),
(2044, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:03', '2023-07-08 14:15:03'),
(2045, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:05', '2023-07-08 14:15:05'),
(2046, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:07', '2023-07-08 14:15:07'),
(2047, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:08', '2023-07-08 14:15:08'),
(2048, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:10', '2023-07-08 14:15:10'),
(2049, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:13', '2023-07-08 14:15:13'),
(2050, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:15', '2023-07-08 14:15:15'),
(2051, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:17', '2023-07-08 14:15:17'),
(2052, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:19', '2023-07-08 14:15:19'),
(2053, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:21', '2023-07-08 14:15:21'),
(2054, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:23', '2023-07-08 14:15:23'),
(2055, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:25', '2023-07-08 14:15:25'),
(2056, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:27', '2023-07-08 14:15:27'),
(2057, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:29', '2023-07-08 14:15:29'),
(2058, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:31', '2023-07-08 14:15:31'),
(2059, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:32', '2023-07-08 14:15:32'),
(2060, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:35', '2023-07-08 14:15:35'),
(2061, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:37', '2023-07-08 14:15:37'),
(2062, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:39', '2023-07-08 14:15:39'),
(2063, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:51', '2023-07-08 14:15:51'),
(2064, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:15:58', '2023-07-08 14:15:58'),
(2065, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 14:16:02', '2023-07-08 14:16:02'),
(2066, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:16:11', '2023-07-08 14:16:11'),
(2067, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 14:17:21', '2023-07-08 14:17:21'),
(2068, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 16:07:47', '2023-07-08 16:07:47'),
(2069, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:03', '2023-07-08 16:12:03'),
(2070, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:13', '2023-07-08 16:12:13'),
(2071, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:16', '2023-07-08 16:12:16'),
(2072, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:20', '2023-07-08 16:12:20'),
(2073, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:24', '2023-07-08 16:12:24'),
(2074, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:28', '2023-07-08 16:12:28'),
(2075, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:31', '2023-07-08 16:12:31'),
(2076, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:33', '2023-07-08 16:12:33'),
(2077, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:35', '2023-07-08 16:12:35'),
(2078, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:37', '2023-07-08 16:12:37'),
(2079, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:12:39', '2023-07-08 16:12:39'),
(2080, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:13:25', '2023-07-08 16:13:25'),
(2081, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:13:32', '2023-07-08 16:13:32'),
(2082, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:14:25', '2023-07-08 16:14:25'),
(2083, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:30:09', '2023-07-08 16:30:09'),
(2084, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_days_before_submission\":\"542\",\"inspection_types\":[\"2\",\"1\",\"3\",null],\"search_terms\":null,\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Graiden Maize\",\"crop_variety_code\":\"Natus sed eum nemo e\",\"crop_variety_generation\":\"Aliquid cupidatat mo\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Alfreda Booker maize\",\"crop_variety_code\":\"Elit debitis saepe\",\"crop_variety_generation\":\"Ut nobis nihil quia\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"Ria Brewer maize\",\"crop_variety_code\":\"Dolor dicta debitis\",\"crop_variety_generation\":\"Officia consectetur\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"uQpf80wNpasmMEU9Nhb4zBs2taxI8RNPoJCNPHg3\",\"after-save\":\"view\"}', '2023-07-08 16:31:17', '2023-07-08 16:31:17'),
(2085, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:31:21', '2023-07-08 16:31:21'),
(2086, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_days_before_submission\":\"542\",\"inspection_types\":[\"2\",\"1\",\"3\",null],\"search_terms\":null,\"crop_varieties\":{\"new___LA_KEY__\":{\"crop_variety_name\":\"Ria Brewer maize\",\"crop_variety_code\":\"Dolor dicta debitis\",\"crop_variety_generation\":\"Officia consectetur\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"uQpf80wNpasmMEU9Nhb4zBs2taxI8RNPoJCNPHg3\"}', '2023-07-08 16:34:04', '2023-07-08 16:34:04'),
(2087, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:34:04', '2023-07-08 16:34:04'),
(2088, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:34:27', '2023-07-08 16:34:27'),
(2089, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:34:30', '2023-07-08 16:34:30'),
(2090, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_days_before_submission\":\"631\",\"inspection_types\":[\"2\",\"1\",\"3\",null],\"search_terms\":null,\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Raya Maize\",\"crop_variety_code\":\"Aut eligendi enim te\",\"crop_variety_generation\":\"Nisi hic et omnis vo\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Murphy Decker Maize\",\"crop_variety_code\":\"Iusto quo amet aliq\",\"crop_variety_generation\":\"Quia voluptates lore\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"William Young Maize\",\"crop_variety_code\":\"Ut autem cillum ut q\",\"crop_variety_generation\":\"Voluptatum anim aut\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"uQpf80wNpasmMEU9Nhb4zBs2taxI8RNPoJCNPHg3\"}', '2023-07-08 16:35:15', '2023-07-08 16:35:15'),
(2091, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:35:16', '2023-07-08 16:35:16'),
(2092, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:38:12', '2023-07-08 16:38:12'),
(2093, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Maize\",\"number_of_days_before_submission\":\"413\",\"inspection_types\":[\"2\",\"3\",\"1\",null],\"search_terms\":null,\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Chadwick Pierce maize\",\"crop_variety_code\":\"Ut enim aliquam cupi\",\"crop_variety_generation\":\"Quia consequatur co\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Audra Daugherty maize\",\"crop_variety_code\":\"Eos quis exercitati\",\"crop_variety_generation\":\"Quis consequuntur de\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"crop_variety_name\":\"Cleo Knox maize\",\"crop_variety_code\":\"Tempora quia nobis a\",\"crop_variety_generation\":\"Sit voluptatem liber\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"uQpf80wNpasmMEU9Nhb4zBs2taxI8RNPoJCNPHg3\"}', '2023-07-08 16:38:45', '2023-07-08 16:38:45'),
(2094, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 16:38:45', '2023-07-08 16:38:45'),
(2095, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:38:50', '2023-07-08 16:38:50'),
(2096, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 16:38:56', '2023-07-08 16:38:56'),
(2097, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:38:58', '2023-07-08 16:38:58'),
(2098, 1, 'admin/crops', 'POST', '127.0.0.1', '{\"crop_name\":\"Beans\",\"number_of_days_before_submission\":\"352\",\"inspection_types\":[\"2\",\"1\",null],\"search_terms\":null,\"crop_varieties\":{\"new_1\":{\"crop_variety_name\":\"Thomas Downs Beans\",\"crop_variety_code\":\"Rerum iure illo omni\",\"crop_variety_generation\":\"Aut assumenda non fu\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"crop_variety_name\":\"Audrey Kline Beans\",\"crop_variety_code\":\"Dicta in dolore sunt\",\"crop_variety_generation\":\"Ullamco voluptatem\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"uQpf80wNpasmMEU9Nhb4zBs2taxI8RNPoJCNPHg3\",\"after-save\":\"view\"}', '2023-07-08 16:39:27', '2023-07-08 16:39:27'),
(2099, 1, 'admin/crops/11', 'GET', '127.0.0.1', '[]', '2023-07-08 16:39:27', '2023-07-08 16:39:27'),
(2100, 1, 'admin/crops/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:39:32', '2023-07-08 16:39:32'),
(2101, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-08 16:39:35', '2023-07-08 16:39:35'),
(2102, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 16:39:43', '2023-07-08 16:39:43'),
(2103, 1, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 16:39:49', '2023-07-08 16:39:49'),
(2104, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 16:40:13', '2023-07-08 16:40:13'),
(2105, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 16:40:20', '2023-07-08 16:40:20'),
(2106, 48, 'admin/crop-declarations/2', 'GET', '127.0.0.1', '[]', '2023-07-08 16:40:31', '2023-07-08 16:40:31'),
(2107, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:40:36', '2023-07-08 16:40:36'),
(2108, 48, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"phone_number\":\"1\",\"applicant_registration_number\":\"192\",\"seed_producer_id\":\"34\",\"garden_size\":\"5.00\",\"gps_coordinates_1\":\"5.000000\",\"gps_coordinates_2\":\"5.000000\",\"gps_coordinates_3\":\"8.000000\",\"gps_coordinates_4\":\"9.000000\",\"field_name\":\"Neil Burke\",\"district_region\":\"Ad sint molestias ex\",\"circle\":\"Vero id recusandae\",\"township\":\"Cillum omnis nulla d\",\"village\":\"Veniam reiciendis q\",\"planting_date\":\"1991-01-01\",\"quantity_of_seed_planted\":\"530\",\"expected_yield\":\"37\",\"seed_supplier_name\":\"Addison Fisher\",\"seed_supplier_registration_number\":\"836\",\"source_lot_number\":\"421\",\"origin_of_variety\":\"Facilis velit dolore\",\"garden_location_latitude\":\"9.000000\",\"garden_location_longitude\":\"8.000000\",\"crop_varieties\":[\"7\",\"9\",null],\"search_terms\":null,\"_token\":\"CMupNxRcZXuGBDpI352yLHATju9Yzm2CwP9uWfk0\",\"_method\":\"PUT\"}', '2023-07-08 16:41:10', '2023-07-08 16:41:10'),
(2109, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 16:41:10', '2023-07-08 16:41:10'),
(2110, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-08 16:41:27', '2023-07-08 16:41:27'),
(2111, 47, 'admin/crop-declarations/2', 'GET', '127.0.0.1', '[]', '2023-07-08 16:41:40', '2023-07-08 16:41:40'),
(2112, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:41:43', '2023-07-08 16:41:43'),
(2113, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:50', '2023-07-08 16:48:50'),
(2114, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:51', '2023-07-08 16:48:51'),
(2115, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:51', '2023-07-08 16:48:51'),
(2116, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:52', '2023-07-08 16:48:52'),
(2117, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:52', '2023-07-08 16:48:52'),
(2118, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:53', '2023-07-08 16:48:53'),
(2119, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:53', '2023-07-08 16:48:53'),
(2120, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:54', '2023-07-08 16:48:54'),
(2121, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:54', '2023-07-08 16:48:54'),
(2122, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:55', '2023-07-08 16:48:55'),
(2123, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:55', '2023-07-08 16:48:55'),
(2124, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:56', '2023-07-08 16:48:56'),
(2125, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:56', '2023-07-08 16:48:56'),
(2126, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:57', '2023-07-08 16:48:57'),
(2127, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:57', '2023-07-08 16:48:57'),
(2128, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:58', '2023-07-08 16:48:58'),
(2129, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:58', '2023-07-08 16:48:58'),
(2130, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:59', '2023-07-08 16:48:59'),
(2131, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:48:59', '2023-07-08 16:48:59'),
(2132, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:49:00', '2023-07-08 16:49:00'),
(2133, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:49:00', '2023-07-08 16:49:00'),
(2134, 48, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 16:49:37', '2023-07-08 16:49:37'),
(2135, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:13:19', '2023-07-08 17:13:19'),
(2136, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"name_of_applicant\":\"Briar Russell\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:13:26', '2023-07-08 17:13:26'),
(2137, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:13:26', '2023-07-08 17:13:26'),
(2138, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:15:28', '2023-07-08 17:15:28'),
(2139, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:15:32', '2023-07-08 17:15:32'),
(2140, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:15:44', '2023-07-08 17:15:44'),
(2141, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:16:12', '2023-07-08 17:16:12'),
(2142, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:16:15', '2023-07-08 17:16:15'),
(2143, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:16:22', '2023-07-08 17:16:22'),
(2144, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:16:45', '2023-07-08 17:16:45'),
(2145, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:16:55', '2023-07-08 17:16:55'),
(2146, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:17:02', '2023-07-08 17:17:02'),
(2147, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:30:23', '2023-07-08 17:30:23'),
(2148, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:30:30', '2023-07-08 17:30:30'),
(2149, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:30:44', '2023-07-08 17:30:44'),
(2150, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:31:22', '2023-07-08 17:31:22'),
(2151, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:32:11', '2023-07-08 17:32:11'),
(2152, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:32:18', '2023-07-08 17:32:18'),
(2153, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:32:34', '2023-07-08 17:32:34'),
(2154, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:32:45', '2023-07-08 17:32:45'),
(2155, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:32:55', '2023-07-08 17:32:55'),
(2156, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:33:21', '2023-07-08 17:33:21'),
(2157, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"47\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:33:27', '2023-07-08 17:33:27'),
(2158, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:33:35', '2023-07-08 17:33:35'),
(2159, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:35:43', '2023-07-08 17:35:43'),
(2160, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:36:16', '2023-07-08 17:36:16'),
(2161, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:36:22', '2023-07-08 17:36:22'),
(2162, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:36:31', '2023-07-08 17:36:31'),
(2163, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:37:36', '2023-07-08 17:37:36'),
(2164, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:37:39', '2023-07-08 17:37:39'),
(2165, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:38:42', '2023-07-08 17:38:42'),
(2166, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:38:47', '2023-07-08 17:38:47'),
(2167, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:39:00', '2023-07-08 17:39:00'),
(2168, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:40:05', '2023-07-08 17:40:05'),
(2169, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:40:11', '2023-07-08 17:40:11'),
(2170, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:40:19', '2023-07-08 17:40:19'),
(2171, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:40:28', '2023-07-08 17:40:28'),
(2172, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:41:28', '2023-07-08 17:41:28'),
(2173, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:41:33', '2023-07-08 17:41:33'),
(2174, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:41:34', '2023-07-08 17:41:34'),
(2175, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:42:34', '2023-07-08 17:42:34'),
(2176, 47, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-08 17:42:37', '2023-07-08 17:42:37'),
(2177, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:42:39', '2023-07-08 17:42:39'),
(2178, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:42:42', '2023-07-08 17:42:42'),
(2179, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:42:47', '2023-07-08 17:42:47'),
(2180, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:42:48', '2023-07-08 17:42:48'),
(2181, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-08 17:43:33', '2023-07-08 17:43:33'),
(2182, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:43:36', '2023-07-08 17:43:36'),
(2183, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:43:42', '2023-07-08 17:43:42'),
(2184, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:43:46', '2023-07-08 17:43:46'),
(2185, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:44:26', '2023-07-08 17:44:26'),
(2186, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crop-declarations\"}', '2023-07-08 17:44:32', '2023-07-08 17:44:32'),
(2187, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:44:39', '2023-07-08 17:44:39'),
(2188, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:45:24', '2023-07-08 17:45:24'),
(2189, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:45:36', '2023-07-08 17:45:36'),
(2190, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:45:43', '2023-07-08 17:45:43'),
(2191, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:46:10', '2023-07-08 17:46:10'),
(2192, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:46:19', '2023-07-08 17:46:19'),
(2193, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:46:27', '2023-07-08 17:46:27'),
(2194, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:48:03', '2023-07-08 17:48:03'),
(2195, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:48:11', '2023-07-08 17:48:11'),
(2196, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:48:17', '2023-07-08 17:48:17'),
(2197, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:50:08', '2023-07-08 17:50:08'),
(2198, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:50:18', '2023-07-08 17:50:18'),
(2199, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:50:41', '2023-07-08 17:50:41'),
(2200, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:51:02', '2023-07-08 17:51:02'),
(2201, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:51:08', '2023-07-08 17:51:08'),
(2202, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:51:09', '2023-07-08 17:51:09'),
(2203, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:51:35', '2023-07-08 17:51:35'),
(2204, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:51:43', '2023-07-08 17:51:43'),
(2205, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:51:44', '2023-07-08 17:51:44'),
(2206, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:54:11', '2023-07-08 17:54:11'),
(2207, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:54:18', '2023-07-08 17:54:18'),
(2208, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:54:19', '2023-07-08 17:54:19'),
(2209, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:54:32', '2023-07-08 17:54:32'),
(2210, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:54:38', '2023-07-08 17:54:38'),
(2211, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:54:39', '2023-07-08 17:54:39'),
(2212, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:56:44', '2023-07-08 17:56:44'),
(2213, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 17:56:50', '2023-07-08 17:56:50'),
(2214, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 17:56:51', '2023-07-08 17:56:51'),
(2215, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:04:44', '2023-07-08 18:04:44'),
(2216, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:04:52', '2023-07-08 18:04:52'),
(2217, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:04:53', '2023-07-08 18:04:53'),
(2218, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:06:21', '2023-07-08 18:06:21'),
(2219, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:06:32', '2023-07-08 18:06:32'),
(2220, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:06:33', '2023-07-08 18:06:33'),
(2221, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:08:55', '2023-07-08 18:08:55'),
(2222, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:09:02', '2023-07-08 18:09:02'),
(2223, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:09:03', '2023-07-08 18:09:03'),
(2224, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:13:13', '2023-07-08 18:13:13'),
(2225, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:13:21', '2023-07-08 18:13:21'),
(2226, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:13:22', '2023-07-08 18:13:22'),
(2227, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:17:02', '2023-07-08 18:17:02'),
(2228, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:17:08', '2023-07-08 18:17:08'),
(2229, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:17:09', '2023-07-08 18:17:09'),
(2230, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:21:49', '2023-07-08 18:21:49'),
(2231, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:21:58', '2023-07-08 18:21:58'),
(2232, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:21:59', '2023-07-08 18:21:59'),
(2233, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:33:25', '2023-07-08 18:33:25'),
(2234, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:33:33', '2023-07-08 18:33:33'),
(2235, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:33:40', '2023-07-08 18:33:40'),
(2236, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:35:58', '2023-07-08 18:35:58'),
(2237, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:36:05', '2023-07-08 18:36:05'),
(2238, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:36:12', '2023-07-08 18:36:12'),
(2239, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:39:13', '2023-07-08 18:39:13'),
(2240, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:39:22', '2023-07-08 18:39:22'),
(2241, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"Wk1KalRe7a7o8vsWC8nWzV3G5cGq0J2ZLrxWxKDH\",\"_method\":\"PUT\"}', '2023-07-08 18:39:29', '2023-07-08 18:39:29'),
(2242, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-08 18:39:36', '2023-07-08 18:39:36'),
(2243, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 02:07:22', '2023-07-09 02:07:22'),
(2244, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 02:07:37', '2023-07-09 02:07:37'),
(2245, 47, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-09 02:07:43', '2023-07-09 02:07:43'),
(2246, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 02:07:46', '2023-07-09 02:07:46'),
(2247, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:07:48', '2023-07-09 02:07:48'),
(2248, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:08:04', '2023-07-09 02:08:04'),
(2249, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:08:19', '2023-07-09 02:08:19'),
(2250, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:10:52', '2023-07-09 02:10:52'),
(2251, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:10:59', '2023-07-09 02:10:59'),
(2252, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:11:07', '2023-07-09 02:11:07'),
(2253, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:12:41', '2023-07-09 02:12:41'),
(2254, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:12:46', '2023-07-09 02:12:46'),
(2255, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:12:52', '2023-07-09 02:12:52'),
(2256, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:15:18', '2023-07-09 02:15:18'),
(2257, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:15:24', '2023-07-09 02:15:24'),
(2258, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:15:29', '2023-07-09 02:15:29'),
(2259, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:19:20', '2023-07-09 02:19:20'),
(2260, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:19:30', '2023-07-09 02:19:30'),
(2261, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:19:36', '2023-07-09 02:19:36'),
(2262, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 02:21:05', '2023-07-09 02:21:05'),
(2263, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"iAxrln5XTwOsW7q1WnvSSdC92CabQ67AWggv8xLx\",\"_method\":\"PUT\"}', '2023-07-09 02:21:11', '2023-07-09 02:21:11'),
(2264, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 02:21:16', '2023-07-09 02:21:16'),
(2265, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 04:32:45', '2023-07-09 04:32:45'),
(2266, 49, 'admin/crop-declarations/2', 'GET', '127.0.0.1', '[]', '2023-07-09 04:32:53', '2023-07-09 04:32:53'),
(2267, 49, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 04:32:59', '2023-07-09 04:32:59'),
(2268, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 04:33:44', '2023-07-09 04:33:44'),
(2269, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-09 04:34:01', '2023-07-09 04:34:01'),
(2270, 1, 'admin/auth/menu/28/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 04:34:07', '2023-07-09 04:34:07'),
(2271, 1, 'admin/auth/menu/28', 'PUT', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-seedling\",\"uri\":\"crop-declarations\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"FAJPHuiM3n3HtcyWth7p49Qd74NTzp2W8LbaGRaW\",\"_method\":\"PUT\"}', '2023-07-09 04:35:15', '2023-07-09 04:35:15'),
(2272, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-09 04:35:15', '2023-07-09 04:35:15'),
(2273, 1, 'admin/auth/menu/28', 'PUT', '127.0.0.1', '{\"parent_id\":\"27\",\"search_terms\":null,\"title\":\"Crop Declaration\",\"icon\":\"icon-seedling\",\"uri\":\"crop-declarations\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"FAJPHuiM3n3HtcyWth7p49Qd74NTzp2W8LbaGRaW\",\"_method\":\"PUT\"}', '2023-07-09 04:35:16', '2023-07-09 04:35:16'),
(2274, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-09 04:35:16', '2023-07-09 04:35:16'),
(2275, 1, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:35:20', '2023-07-09 04:35:20'),
(2276, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 04:37:58', '2023-07-09 04:37:58'),
(2277, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:38:11', '2023-07-09 04:38:11'),
(2278, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:41:26', '2023-07-09 04:41:26'),
(2279, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:44:08', '2023-07-09 04:44:08'),
(2280, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:44:11', '2023-07-09 04:44:11'),
(2281, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:45:21', '2023-07-09 04:45:21'),
(2282, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:45:39', '2023-07-09 04:45:39'),
(2283, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:47:22', '2023-07-09 04:47:22'),
(2284, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:48:21', '2023-07-09 04:48:21'),
(2285, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:49:49', '2023-07-09 04:49:49'),
(2286, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:50:51', '2023-07-09 04:50:51'),
(2287, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:51:51', '2023-07-09 04:51:51'),
(2288, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 04:52:57', '2023-07-09 04:52:57'),
(2289, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 05:02:11', '2023-07-09 05:02:11'),
(2290, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 09:04:12', '2023-07-09 09:04:12'),
(2291, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 09:04:20', '2023-07-09 09:04:20'),
(2292, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:04:30', '2023-07-09 09:04:30'),
(2293, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-09 09:14:18', '2023-07-09 09:14:18'),
(2294, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 09:14:24', '2023-07-09 09:14:24'),
(2295, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:14:28', '2023-07-09 09:14:28'),
(2296, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:14:34', '2023-07-09 09:14:34'),
(2297, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:14:52', '2023-07-09 09:14:52'),
(2298, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:14:58', '2023-07-09 09:14:58'),
(2299, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:14:58', '2023-07-09 09:14:58'),
(2300, 47, 'admin/crop-declarations/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:15:35', '2023-07-09 09:15:35'),
(2301, 47, 'admin/crop-declarations/2', 'PUT', '127.0.0.1', '{\"applicant_id\":\"48\",\"field_name\":\"Neil Burke\",\"planting_date\":\"1991-01-01\",\"inspector_id\":\"49\",\"search_terms\":null,\"status\":\"2\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:15:39', '2023-07-09 09:15:39'),
(2302, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 09:15:50', '2023-07-09 09:15:50'),
(2303, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 09:26:43', '2023-07-09 09:26:43'),
(2304, 47, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-09 09:26:46', '2023-07-09 09:26:46'),
(2305, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:26:55', '2023-07-09 09:26:55'),
(2306, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:28:23', '2023-07-09 09:28:23'),
(2307, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:35:20', '2023-07-09 09:35:20'),
(2308, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:35:24', '2023-07-09 09:35:24'),
(2309, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:35:34', '2023-07-09 09:35:34'),
(2310, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:35:35', '2023-07-09 09:35:35'),
(2311, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:35:53', '2023-07-09 09:35:53'),
(2312, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:37:44', '2023-07-09 09:37:44'),
(2313, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:37:48', '2023-07-09 09:37:48'),
(2314, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:39:02', '2023-07-09 09:39:02'),
(2315, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-09 09:39:12', '2023-07-09 09:39:12'),
(2316, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:40:26', '2023-07-09 09:40:26'),
(2317, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:40:52', '2023-07-09 09:40:52'),
(2318, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:42:10', '2023-07-09 09:42:10'),
(2319, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:42:15', '2023-07-09 09:42:15'),
(2320, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:42:23', '2023-07-09 09:42:23'),
(2321, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:43:24', '2023-07-09 09:43:24'),
(2322, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:43:24', '2023-07-09 09:43:24'),
(2323, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:43:28', '2023-07-09 09:43:28'),
(2324, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:43:33', '2023-07-09 09:43:33'),
(2325, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:43:34', '2023-07-09 09:43:34'),
(2326, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:46:22', '2023-07-09 09:46:22'),
(2327, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"0\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\\/6\"}', '2023-07-09 09:46:29', '2023-07-09 09:46:29'),
(2328, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:48:25', '2023-07-09 09:48:25'),
(2329, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:48:29', '2023-07-09 09:48:29');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(2330, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:48:37', '2023-07-09 09:48:37'),
(2331, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:48:37', '2023-07-09 09:48:37'),
(2332, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:49:49', '2023-07-09 09:49:49'),
(2333, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:50:25', '2023-07-09 09:50:25'),
(2334, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-27\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\\/6\"}', '2023-07-09 09:50:34', '2023-07-09 09:50:34'),
(2335, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:56:30', '2023-07-09 09:56:30'),
(2336, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 09:56:33', '2023-07-09 09:56:33'),
(2337, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:56:40', '2023-07-09 09:56:40'),
(2338, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-02\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:56:48', '2023-07-09 09:56:48'),
(2339, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:57:58', '2023-07-09 09:57:58'),
(2340, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:58:02', '2023-07-09 09:58:02'),
(2341, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"0\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:58:07', '2023-07-09 09:58:07'),
(2342, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 09:59:41', '2023-07-09 09:59:41'),
(2343, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 09:59:44', '2023-07-09 09:59:44'),
(2344, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-02\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 09:59:54', '2023-07-09 09:59:54'),
(2345, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 10:01:10', '2023-07-09 10:01:10'),
(2346, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:01:14', '2023-07-09 10:01:14'),
(2347, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-04\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:01:22', '2023-07-09 10:01:22'),
(2348, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:01:23', '2023-07-09 10:01:23'),
(2349, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:02:23', '2023-07-09 10:02:23'),
(2350, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:02:27', '2023-07-09 10:02:27'),
(2351, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"0\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:02:37', '2023-07-09 10:02:37'),
(2352, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:02:37', '2023-07-09 10:02:37'),
(2353, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:06:46', '2023-07-09 10:06:46'),
(2354, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:06:55', '2023-07-09 10:06:55'),
(2355, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-30\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:07:03', '2023-07-09 10:07:03'),
(2356, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 10:13:24', '2023-07-09 10:13:24'),
(2357, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:13:29', '2023-07-09 10:13:29'),
(2358, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:13:38', '2023-07-09 10:13:38'),
(2359, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-10-06\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:13:45', '2023-07-09 10:13:45'),
(2360, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:14:46', '2023-07-09 10:14:46'),
(2361, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:14:48', '2023-07-09 10:14:48'),
(2362, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:14:49', '2023-07-09 10:14:49'),
(2363, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:15:04', '2023-07-09 10:15:04'),
(2364, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:15:10', '2023-07-09 10:15:10'),
(2365, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:15:15', '2023-07-09 10:15:15'),
(2366, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 10:16:57', '2023-07-09 10:16:57'),
(2367, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:17:00', '2023-07-09 10:17:00'),
(2368, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:17:05', '2023-07-09 10:17:05'),
(2369, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:17:11', '2023-07-09 10:17:11'),
(2370, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:17:12', '2023-07-09 10:17:12'),
(2371, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:19:23', '2023-07-09 10:19:23'),
(2372, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:19:28', '2023-07-09 10:19:28'),
(2373, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:19:33', '2023-07-09 10:19:33'),
(2374, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:19:33', '2023-07-09 10:19:33'),
(2375, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:21:17', '2023-07-09 10:21:17'),
(2376, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:21:34', '2023-07-09 10:21:34'),
(2377, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:21:42', '2023-07-09 10:21:42'),
(2378, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:21:42', '2023-07-09 10:21:42'),
(2379, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:22:48', '2023-07-09 10:22:48'),
(2380, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:22:54', '2023-07-09 10:22:54'),
(2381, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:23:04', '2023-07-09 10:23:04'),
(2382, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:23:04', '2023-07-09 10:23:04'),
(2383, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:24:24', '2023-07-09 10:24:24'),
(2384, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:24:30', '2023-07-09 10:24:30'),
(2385, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:24:36', '2023-07-09 10:24:36'),
(2386, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:24:36', '2023-07-09 10:24:36'),
(2387, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:30:11', '2023-07-09 10:30:11'),
(2388, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:30:21', '2023-07-09 10:30:21'),
(2389, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"is_active\":\"1\",\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-07\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:30:41', '2023-07-09 10:30:41'),
(2390, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:30:42', '2023-07-09 10:30:42'),
(2391, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:33:35', '2023-07-09 10:33:35'),
(2392, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:33:42', '2023-07-09 10:33:42'),
(2393, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:33:54', '2023-07-09 10:33:54'),
(2394, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"is_active\":\"1\",\"is_active_cb\":\"on\",\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-10-06\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-09 10:34:04', '2023-07-09 10:34:04'),
(2395, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:34:04', '2023-07-09 10:34:04'),
(2396, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:35:14', '2023-07-09 10:35:14'),
(2397, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:35:22', '2023-07-09 10:35:22'),
(2398, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"is_active\":\"1\",\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-10-06\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:35:32', '2023-07-09 10:35:32'),
(2399, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:35:32', '2023-07-09 10:35:32'),
(2400, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:36:47', '2023-07-09 10:36:47'),
(2401, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:37:09', '2023-07-09 10:37:09'),
(2402, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:37:13', '2023-07-09 10:37:13'),
(2403, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:37:19', '2023-07-09 10:37:19'),
(2404, 47, 'admin/field-inspections/6', 'GET', '127.0.0.1', '[]', '2023-07-09 10:41:13', '2023-07-09 10:41:13'),
(2405, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:41:17', '2023-07-09 10:41:17'),
(2406, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:41:40', '2023-07-09 10:41:40'),
(2407, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\\/6\"}', '2023-07-09 10:42:10', '2023-07-09 10:42:10'),
(2408, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:43:31', '2023-07-09 10:43:31'),
(2409, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:45:13', '2023-07-09 10:45:13'),
(2410, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:45:16', '2023-07-09 10:45:16'),
(2411, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:46:03', '2023-07-09 10:46:03'),
(2412, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:46:07', '2023-07-09 10:46:07'),
(2413, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"0\",\"inspection_date\":\"2023-10-06\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:46:15', '2023-07-09 10:46:15'),
(2414, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:46:16', '2023-07-09 10:46:16'),
(2415, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:04', '2023-07-09 10:47:04'),
(2416, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-10-06\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:47:11', '2023-07-09 10:47:11'),
(2417, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:12', '2023-07-09 10:47:12'),
(2418, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:23', '2023-07-09 10:47:23'),
(2419, 47, 'admin/field-inspections/7', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"2\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:47:28', '2023-07-09 10:47:28'),
(2420, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:29', '2023-07-09 10:47:29'),
(2421, 47, 'admin/field-inspections/8/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:41', '2023-07-09 10:47:41'),
(2422, 47, 'admin/field-inspections/8', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"3\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-07-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:47:47', '2023-07-09 10:47:47'),
(2423, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:47:48', '2023-07-09 10:47:48'),
(2424, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:49:34', '2023-07-09 10:49:34'),
(2425, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:49:37', '2023-07-09 10:49:37'),
(2426, 47, 'admin/field-inspections/7', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"2\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-05\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:49:46', '2023-07-09 10:49:46'),
(2427, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:49:48', '2023-07-09 10:49:48'),
(2428, 47, 'admin/field-inspections/7', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"2\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-05\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:49:52', '2023-07-09 10:49:52'),
(2429, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:49:53', '2023-07-09 10:49:53'),
(2430, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:51:31', '2023-07-09 10:51:31'),
(2431, 47, 'admin/field-inspections/7', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"2\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-05\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-09 10:51:39', '2023-07-09 10:51:39'),
(2432, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:51:39', '2023-07-09 10:51:39'),
(2433, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:51:47', '2023-07-09 10:51:47'),
(2434, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:52:02', '2023-07-09 10:52:02'),
(2435, 47, 'admin/field-inspections/9', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"9\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-04\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:52:10', '2023-07-09 10:52:10'),
(2436, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:52:10', '2023-07-09 10:52:10'),
(2437, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 10:53:44', '2023-07-09 10:53:44'),
(2438, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:53:49', '2023-07-09 10:53:49'),
(2439, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:53:55', '2023-07-09 10:53:55'),
(2440, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:53:56', '2023-07-09 10:53:56'),
(2441, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:54:19', '2023-07-09 10:54:19'),
(2442, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-09 10:54:26', '2023-07-09 10:54:26'),
(2443, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:54:27', '2023-07-09 10:54:27'),
(2444, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:58:42', '2023-07-09 10:58:42'),
(2445, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 10:58:48', '2023-07-09 10:58:48'),
(2446, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 10:58:49', '2023-07-09 10:58:49'),
(2447, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:00:02', '2023-07-09 11:00:02'),
(2448, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:00:08', '2023-07-09 11:00:08'),
(2449, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:00:09', '2023-07-09 11:00:09'),
(2450, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:01:45', '2023-07-09 11:01:45'),
(2451, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:01:50', '2023-07-09 11:01:50'),
(2452, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:01:51', '2023-07-09 11:01:51'),
(2453, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:02:17', '2023-07-09 11:02:17'),
(2454, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:02:25', '2023-07-09 11:02:25'),
(2455, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:02:26', '2023-07-09 11:02:26'),
(2456, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:03:53', '2023-07-09 11:03:53'),
(2457, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:03:58', '2023-07-09 11:03:58'),
(2458, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-11-11\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:04:04', '2023-07-09 11:04:04'),
(2459, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:04:04', '2023-07-09 11:04:04'),
(2460, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:04:48', '2023-07-09 11:04:48'),
(2461, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:04', '2023-07-09 11:05:04'),
(2462, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:08', '2023-07-09 11:05:08'),
(2463, 47, 'admin/field-inspections/6', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"1\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-12-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:05:16', '2023-07-09 11:05:16'),
(2464, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:16', '2023-07-09 11:05:16'),
(2465, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:26', '2023-07-09 11:05:26'),
(2466, 47, 'admin/field-inspections/7', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"2\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-09-09\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:05:34', '2023-07-09 11:05:34'),
(2467, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:34', '2023-07-09 11:05:34'),
(2468, 47, 'admin/field-inspections/8/edit', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:45', '2023-07-09 11:05:45'),
(2469, 47, 'admin/field-inspections/8', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"crop_declaration_id\":\"2\",\"crop_variety_id\":\"7\",\"inspection_type_id\":\"3\",\"applicant_id\":\"48\",\"physical_address\":null,\"type_of_inspection\":null,\"field_size\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"remarks\":null,\"inspector_id\":\"49\",\"signature\":null,\"field_decision\":\"1\",\"inspection_date\":\"2023-08-05\",\"_token\":\"j78b8MjtPfnjFPFg0Y3JBCeqZ7ae9HDOKCwSIqXg\",\"_method\":\"PUT\"}', '2023-07-09 11:05:52', '2023-07-09 11:05:52'),
(2470, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-09 11:05:52', '2023-07-09 11:05:52'),
(2471, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 02:51:51', '2023-07-10 02:51:51'),
(2472, 49, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-10 02:53:08', '2023-07-10 02:53:08'),
(2473, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 02:53:38', '2023-07-10 02:53:38'),
(2474, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 02:53:46', '2023-07-10 02:53:46'),
(2475, 48, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-10 02:53:51', '2023-07-10 02:53:51'),
(2476, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 02:53:59', '2023-07-10 02:53:59'),
(2477, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:07', '2023-07-10 02:54:07'),
(2478, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:19', '2023-07-10 02:54:19'),
(2479, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:21', '2023-07-10 02:54:21'),
(2480, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:22', '2023-07-10 02:54:22'),
(2481, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:22', '2023-07-10 02:54:22'),
(2482, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:23', '2023-07-10 02:54:23'),
(2483, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:23', '2023-07-10 02:54:23'),
(2484, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:24', '2023-07-10 02:54:24'),
(2485, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:24', '2023-07-10 02:54:24'),
(2486, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:25', '2023-07-10 02:54:25'),
(2487, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:25', '2023-07-10 02:54:25'),
(2488, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:26', '2023-07-10 02:54:26'),
(2489, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:26', '2023-07-10 02:54:26'),
(2490, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:27', '2023-07-10 02:54:27'),
(2491, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:27', '2023-07-10 02:54:27'),
(2492, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:28', '2023-07-10 02:54:28'),
(2493, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:28', '2023-07-10 02:54:28'),
(2494, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:29', '2023-07-10 02:54:29'),
(2495, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:29', '2023-07-10 02:54:29'),
(2496, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:30', '2023-07-10 02:54:30'),
(2497, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:30', '2023-07-10 02:54:30'),
(2498, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:54:31', '2023-07-10 02:54:31'),
(2499, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:56:48', '2023-07-10 02:56:48'),
(2500, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:56:54', '2023-07-10 02:56:54'),
(2501, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:57:41', '2023-07-10 02:57:41'),
(2502, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:58:50', '2023-07-10 02:58:50'),
(2503, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 02:58:53', '2023-07-10 02:58:53'),
(2504, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:02:27', '2023-07-10 03:02:27'),
(2505, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:03:15', '2023-07-10 03:03:15'),
(2506, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:04:49', '2023-07-10 03:04:49'),
(2507, 47, 'admin/field-inspections/7/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:04:51', '2023-07-10 03:04:51'),
(2508, 47, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"KSuujfnRLN3xfv0fz5OBI24RZY5owSlWHyEkwdTQ\",\"username\":\"commissioner\",\"password\":\"*****-filtered-out-*****\"}', '2023-07-10 03:05:29', '2023-07-10 03:05:29'),
(2509, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:29', '2023-07-10 03:05:29'),
(2510, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:51', '2023-07-10 03:05:51'),
(2511, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:56', '2023-07-10 03:05:56'),
(2512, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:56', '2023-07-10 03:05:56'),
(2513, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:57', '2023-07-10 03:05:57'),
(2514, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:57', '2023-07-10 03:05:57'),
(2515, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:58', '2023-07-10 03:05:58'),
(2516, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:58', '2023-07-10 03:05:58'),
(2517, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:05:59', '2023-07-10 03:05:59'),
(2518, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:00', '2023-07-10 03:06:00'),
(2519, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:00', '2023-07-10 03:06:00'),
(2520, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:01', '2023-07-10 03:06:01'),
(2521, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:01', '2023-07-10 03:06:01'),
(2522, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:02', '2023-07-10 03:06:02'),
(2523, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:02', '2023-07-10 03:06:02'),
(2524, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:03', '2023-07-10 03:06:03'),
(2525, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:03', '2023-07-10 03:06:03'),
(2526, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:03', '2023-07-10 03:06:03'),
(2527, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:04', '2023-07-10 03:06:04'),
(2528, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:04', '2023-07-10 03:06:04'),
(2529, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:05', '2023-07-10 03:06:05'),
(2530, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:05', '2023-07-10 03:06:05'),
(2531, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:06:06', '2023-07-10 03:06:06'),
(2532, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:08:38', '2023-07-10 03:08:38'),
(2533, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 03:08:41', '2023-07-10 03:08:41'),
(2534, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:39:30', '2023-07-10 04:39:30'),
(2535, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:42:48', '2023-07-10 04:42:48'),
(2536, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:42:56', '2023-07-10 04:42:56'),
(2537, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:42:59', '2023-07-10 04:42:59'),
(2538, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:43:39', '2023-07-10 04:43:39'),
(2539, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:43:45', '2023-07-10 04:43:45'),
(2540, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:43:54', '2023-07-10 04:43:54'),
(2541, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:44:12', '2023-07-10 04:44:12'),
(2542, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:44:18', '2023-07-10 04:44:18'),
(2543, 47, 'admin/field-inspections/8/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:44:24', '2023-07-10 04:44:24'),
(2544, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:44:28', '2023-07-10 04:44:28'),
(2545, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:45:45', '2023-07-10 04:45:45'),
(2546, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:45:48', '2023-07-10 04:45:48'),
(2547, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:46:17', '2023-07-10 04:46:17'),
(2548, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:46:23', '2023-07-10 04:46:23'),
(2549, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:46:25', '2023-07-10 04:46:25'),
(2550, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:46:55', '2023-07-10 04:46:55'),
(2551, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:47:17', '2023-07-10 04:47:17'),
(2552, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:15', '2023-07-10 04:48:15'),
(2553, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:17', '2023-07-10 04:48:17'),
(2554, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:19', '2023-07-10 04:48:19'),
(2555, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:22', '2023-07-10 04:48:22'),
(2556, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:26', '2023-07-10 04:48:26'),
(2557, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:29', '2023-07-10 04:48:29'),
(2558, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:48:31', '2023-07-10 04:48:31'),
(2559, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:49:23', '2023-07-10 04:49:23'),
(2560, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:49:57', '2023-07-10 04:49:57'),
(2561, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:00', '2023-07-10 04:50:00'),
(2562, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:03', '2023-07-10 04:50:03'),
(2563, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:05', '2023-07-10 04:50:05'),
(2564, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:07', '2023-07-10 04:50:07'),
(2565, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:09', '2023-07-10 04:50:09'),
(2566, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:12', '2023-07-10 04:50:12'),
(2567, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:50:15', '2023-07-10 04:50:15'),
(2568, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:51:49', '2023-07-10 04:51:49'),
(2569, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:51:53', '2023-07-10 04:51:53'),
(2570, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:52:38', '2023-07-10 04:52:38'),
(2571, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:52:49', '2023-07-10 04:52:49'),
(2572, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:52:52', '2023-07-10 04:52:52'),
(2573, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:53:02', '2023-07-10 04:53:02'),
(2574, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:53:14', '2023-07-10 04:53:14'),
(2575, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:53:31', '2023-07-10 04:53:31'),
(2576, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:53:33', '2023-07-10 04:53:33'),
(2577, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 04:54:18', '2023-07-10 04:54:18'),
(2578, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:54:22', '2023-07-10 04:54:22'),
(2579, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:54:53', '2023-07-10 04:54:53'),
(2580, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 04:57:46', '2023-07-10 04:57:46'),
(2581, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:00:19', '2023-07-10 05:00:19'),
(2582, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:00:59', '2023-07-10 05:00:59'),
(2583, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:01:59', '2023-07-10 05:01:59'),
(2584, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:02:26', '2023-07-10 05:02:26'),
(2585, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:03:37', '2023-07-10 05:03:37'),
(2586, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:04:06', '2023-07-10 05:04:06'),
(2587, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:05:02', '2023-07-10 05:05:02'),
(2588, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:08:31', '2023-07-10 05:08:31'),
(2589, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:10:19', '2023-07-10 05:10:19'),
(2590, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:10:53', '2023-07-10 05:10:53'),
(2591, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:11:10', '2023-07-10 05:11:10'),
(2592, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:11:41', '2023-07-10 05:11:41'),
(2593, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:13:23', '2023-07-10 05:13:23');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(2594, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:14:11', '2023-07-10 05:14:11'),
(2595, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:14:42', '2023-07-10 05:14:42'),
(2596, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:14:59', '2023-07-10 05:14:59'),
(2597, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:15:34', '2023-07-10 05:15:34'),
(2598, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:15:36', '2023-07-10 05:15:36'),
(2599, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:16:32', '2023-07-10 05:16:32'),
(2600, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:17:02', '2023-07-10 05:17:02'),
(2601, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:17:40', '2023-07-10 05:17:40'),
(2602, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:18:35', '2023-07-10 05:18:35'),
(2603, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:19:03', '2023-07-10 05:19:03'),
(2604, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:19:24', '2023-07-10 05:19:24'),
(2605, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:19:47', '2023-07-10 05:19:47'),
(2606, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:01', '2023-07-10 05:20:01'),
(2607, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:05', '2023-07-10 05:20:05'),
(2608, 47, 'admin/field-inspections/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:11', '2023-07-10 05:20:11'),
(2609, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:14', '2023-07-10 05:20:14'),
(2610, 47, 'admin/field-inspections/8/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:16', '2023-07-10 05:20:16'),
(2611, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:21', '2023-07-10 05:20:21'),
(2612, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:51', '2023-07-10 05:20:51'),
(2613, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:53', '2023-07-10 05:20:53'),
(2614, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:54', '2023-07-10 05:20:54'),
(2615, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:54', '2023-07-10 05:20:54'),
(2616, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:55', '2023-07-10 05:20:55'),
(2617, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:55', '2023-07-10 05:20:55'),
(2618, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:56', '2023-07-10 05:20:56'),
(2619, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:56', '2023-07-10 05:20:56'),
(2620, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:57', '2023-07-10 05:20:57'),
(2621, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:57', '2023-07-10 05:20:57'),
(2622, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:58', '2023-07-10 05:20:58'),
(2623, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:58', '2023-07-10 05:20:58'),
(2624, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:59', '2023-07-10 05:20:59'),
(2625, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:20:59', '2023-07-10 05:20:59'),
(2626, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:00', '2023-07-10 05:21:00'),
(2627, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:00', '2023-07-10 05:21:00'),
(2628, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:01', '2023-07-10 05:21:01'),
(2629, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:01', '2023-07-10 05:21:01'),
(2630, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:02', '2023-07-10 05:21:02'),
(2631, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:02', '2023-07-10 05:21:02'),
(2632, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:03', '2023-07-10 05:21:03'),
(2633, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:03', '2023-07-10 05:21:03'),
(2634, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:47', '2023-07-10 05:21:47'),
(2635, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:21:50', '2023-07-10 05:21:50'),
(2636, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:22:08', '2023-07-10 05:22:08'),
(2637, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:25:34', '2023-07-10 05:25:34'),
(2638, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:25:42', '2023-07-10 05:25:42'),
(2639, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:48', '2023-07-10 05:33:48'),
(2640, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:51', '2023-07-10 05:33:51'),
(2641, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:52', '2023-07-10 05:33:52'),
(2642, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:52', '2023-07-10 05:33:52'),
(2643, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:53', '2023-07-10 05:33:53'),
(2644, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:53', '2023-07-10 05:33:53'),
(2645, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:54', '2023-07-10 05:33:54'),
(2646, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:54', '2023-07-10 05:33:54'),
(2647, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:55', '2023-07-10 05:33:55'),
(2648, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:55', '2023-07-10 05:33:55'),
(2649, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:56', '2023-07-10 05:33:56'),
(2650, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:56', '2023-07-10 05:33:56'),
(2651, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:57', '2023-07-10 05:33:57'),
(2652, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:57', '2023-07-10 05:33:57'),
(2653, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:58', '2023-07-10 05:33:58'),
(2654, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:58', '2023-07-10 05:33:58'),
(2655, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:33:59', '2023-07-10 05:33:59'),
(2656, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:34:00', '2023-07-10 05:34:00'),
(2657, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:34:00', '2023-07-10 05:34:00'),
(2658, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:34:01', '2023-07-10 05:34:01'),
(2659, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:34:01', '2023-07-10 05:34:01'),
(2660, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:34:02', '2023-07-10 05:34:02'),
(2661, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:41:13', '2023-07-10 05:41:13'),
(2662, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:41:36', '2023-07-10 05:41:36'),
(2663, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:43:42', '2023-07-10 05:43:42'),
(2664, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:43:45', '2023-07-10 05:43:45'),
(2665, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:44:30', '2023-07-10 05:44:30'),
(2666, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:44:33', '2023-07-10 05:44:33'),
(2667, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:44:59', '2023-07-10 05:44:59'),
(2668, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:45:01', '2023-07-10 05:45:01'),
(2669, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:45:42', '2023-07-10 05:45:42'),
(2670, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:46:51', '2023-07-10 05:46:51'),
(2671, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:49:21', '2023-07-10 05:49:21'),
(2672, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:53:03', '2023-07-10 05:53:03'),
(2673, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:53:44', '2023-07-10 05:53:44'),
(2674, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:55:18', '2023-07-10 05:55:18'),
(2675, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:57:18', '2023-07-10 05:57:18'),
(2676, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:57:40', '2023-07-10 05:57:40'),
(2677, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 05:59:26', '2023-07-10 05:59:26'),
(2678, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:01:22', '2023-07-10 06:01:22'),
(2679, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:02:02', '2023-07-10 06:02:02'),
(2680, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:02:53', '2023-07-10 06:02:53'),
(2681, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:03:59', '2023-07-10 06:03:59'),
(2682, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:05:32', '2023-07-10 06:05:32'),
(2683, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:06:03', '2023-07-10 06:06:03'),
(2684, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:09:02', '2023-07-10 06:09:02'),
(2685, 47, 'admin/field-inspections/6/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 06:09:39', '2023-07-10 06:09:39'),
(2686, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 06:09:43', '2023-07-10 06:09:43'),
(2687, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 06:11:57', '2023-07-10 06:11:57'),
(2688, 47, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-10 06:12:17', '2023-07-10 06:12:17'),
(2689, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 06:12:33', '2023-07-10 06:12:33'),
(2690, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 06:12:36', '2023-07-10 06:12:36'),
(2691, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 07:45:00', '2023-07-10 07:45:00'),
(2692, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:45:08', '2023-07-10 07:45:08'),
(2693, 47, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Track and Trace\",\"icon\":\"icon-arrows-alt-h\",\"uri\":\"track-and-traces\",\"roles\":[null],\"permission\":null,\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\"}', '2023-07-10 07:45:57', '2023-07-10 07:45:57'),
(2694, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:45:57', '2023-07-10 07:45:57'),
(2695, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:46:31', '2023-07-10 07:46:31'),
(2696, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 07:46:35', '2023-07-10 07:46:35'),
(2697, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:47:46', '2023-07-10 07:47:46'),
(2698, 47, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"search_terms\":null,\"title\":\"Market place\",\"icon\":\"icon-shopping-cart\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\"}', '2023-07-10 07:48:35', '2023-07-10 07:48:35'),
(2699, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:48:35', '2023-07-10 07:48:35'),
(2700, 47, 'admin/auth/menu/38/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 07:49:26', '2023-07-10 07:49:26'),
(2701, 47, 'admin/auth/menu/38', 'PUT', '127.0.0.1', '{\"parent_id\":\"46\",\"search_terms\":null,\"title\":\"Pre Orders\",\"icon\":\"icon-cart-arrow-down\",\"uri\":\"pre-orders\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":null,\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 07:49:49', '2023-07-10 07:49:49'),
(2702, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 07:49:49', '2023-07-10 07:49:49'),
(2703, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 07:58:20', '2023-07-10 07:58:20'),
(2704, 47, 'admin/auth/permissions/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:58:27', '2023-07-10 07:58:27'),
(2705, 47, 'admin/auth/permissions', 'POST', '127.0.0.1', '{\"slug\":\"load stock\",\"name\":\"Load stock\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/load-stocks*\",\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\"}', '2023-07-10 07:59:11', '2023-07-10 07:59:11'),
(2706, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:11', '2023-07-10 07:59:11'),
(2707, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:22', '2023-07-10 07:59:22'),
(2708, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:24', '2023-07-10 07:59:24'),
(2709, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:26', '2023-07-10 07:59:26'),
(2710, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:28', '2023-07-10 07:59:28'),
(2711, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:29', '2023-07-10 07:59:29'),
(2712, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:31', '2023-07-10 07:59:31'),
(2713, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:32', '2023-07-10 07:59:32'),
(2714, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:34', '2023-07-10 07:59:34'),
(2715, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:36', '2023-07-10 07:59:36'),
(2716, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:37', '2023-07-10 07:59:37'),
(2717, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:39', '2023-07-10 07:59:39'),
(2718, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:40', '2023-07-10 07:59:40'),
(2719, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:42', '2023-07-10 07:59:42'),
(2720, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:43', '2023-07-10 07:59:43'),
(2721, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:45', '2023-07-10 07:59:45'),
(2722, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:46', '2023-07-10 07:59:46'),
(2723, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:48', '2023-07-10 07:59:48'),
(2724, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:49', '2023-07-10 07:59:49'),
(2725, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:50', '2023-07-10 07:59:50'),
(2726, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:50', '2023-07-10 07:59:50'),
(2727, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:51', '2023-07-10 07:59:51'),
(2728, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 07:59:52', '2023-07-10 07:59:52'),
(2729, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 08:00:29', '2023-07-10 08:00:29'),
(2730, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 08:00:36', '2023-07-10 08:00:36'),
(2731, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:00:41', '2023-07-10 08:00:41'),
(2732, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:00:43', '2023-07-10 08:00:43'),
(2733, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:02:00', '2023-07-10 08:02:00'),
(2734, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:02:03', '2023-07-10 08:02:03'),
(2735, 47, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:02:34', '2023-07-10 08:02:34'),
(2736, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 08:03:24', '2023-07-10 08:03:24'),
(2737, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:03:33', '2023-07-10 08:03:33'),
(2738, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:03:46', '2023-07-10 08:03:46'),
(2739, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 08:03:58', '2023-07-10 08:03:58'),
(2740, 47, 'admin/auth/menu/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:04:04', '2023-07-10 08:04:04'),
(2741, 47, 'admin/auth/menu/36', 'PUT', '127.0.0.1', '{\"parent_id\":\"35\",\"search_terms\":null,\"title\":\"Load Stock\",\"icon\":\"icon-layer-group\",\"uri\":\"load-stocks\",\"roles\":[\"2\",\"3\",\"1\",null],\"permission\":\"load stock\",\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:04:17', '2023-07-10 08:04:17'),
(2742, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 08:04:17', '2023-07-10 08:04:17'),
(2743, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:04:25', '2023-07-10 08:04:25'),
(2744, 47, 'admin/auth/menu/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:04:47', '2023-07-10 08:04:47'),
(2745, 47, 'admin/auth/menu/36', 'PUT', '127.0.0.1', '{\"parent_id\":\"35\",\"search_terms\":null,\"title\":\"Load Stock\",\"icon\":\"icon-layer-group\",\"uri\":\"load-stocks\",\"roles\":[\"2\",\"3\",\"1\",\"4\",null],\"permission\":null,\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:04:58', '2023-07-10 08:04:58'),
(2746, 47, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-10 08:04:58', '2023-07-10 08:04:58'),
(2747, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 08:05:14', '2023-07-10 08:05:14'),
(2748, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:21', '2023-07-10 08:06:21'),
(2749, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:28', '2023-07-10 08:06:28'),
(2750, 48, 'admin/seed-labels', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:30', '2023-07-10 08:06:30'),
(2751, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:33', '2023-07-10 08:06:33'),
(2752, 48, 'admin/out-grower-contracts', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:36', '2023-07-10 08:06:36'),
(2753, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:40', '2023-07-10 08:06:40'),
(2754, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:06:51', '2023-07-10 08:06:51'),
(2755, 48, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:00', '2023-07-10 08:07:00'),
(2756, 47, 'admin/auth/permissions/10', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:16', '2023-07-10 08:07:16'),
(2757, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:21', '2023-07-10 08:07:21'),
(2758, 47, 'admin/auth/permissions/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:25', '2023-07-10 08:07:25'),
(2759, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:34', '2023-07-10 08:07:34'),
(2760, 47, 'admin/auth/permissions/12/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:39', '2023-07-10 08:07:39'),
(2761, 47, 'admin/auth/permissions/12', 'PUT', '127.0.0.1', '{\"slug\":\"load stock\",\"name\":\"Load stock\",\"search_terms\":null,\"http_method\":[null],\"http_path\":\"\\/load-stocks*\",\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:07:43', '2023-07-10 08:07:43'),
(2762, 47, 'admin/auth/permissions', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:44', '2023-07-10 08:07:44'),
(2763, 47, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:49', '2023-07-10 08:07:49'),
(2764, 47, 'admin/auth/roles/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:07:54', '2023-07-10 08:07:54'),
(2765, 47, 'admin/auth/roles/3', 'PUT', '127.0.0.1', '{\"slug\":\"basic-user\",\"name\":\"Basic User\",\"permissions\":[\"2\",\"3\",\"4\",\"5\",\"10\",\"11\",\"12\",null],\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:08:00', '2023-07-10 08:08:00'),
(2766, 47, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:01', '2023-07-10 08:08:01'),
(2767, 47, 'admin/auth/roles/4/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:15', '2023-07-10 08:08:15'),
(2768, 47, 'admin/auth/roles/4', 'PUT', '127.0.0.1', '{\"slug\":\"inspector\",\"name\":\"Inspector\",\"permissions\":[\"2\",\"3\",\"4\",\"10\",\"11\",\"12\",null],\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:08:24', '2023-07-10 08:08:24'),
(2769, 47, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:25', '2023-07-10 08:08:25'),
(2770, 47, 'admin/auth/roles/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:36', '2023-07-10 08:08:36'),
(2771, 47, 'admin/auth/roles/2', 'PUT', '127.0.0.1', '{\"slug\":\"administrator\",\"name\":\"Administrator\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"10\",\"11\",\"12\",null],\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"_method\":\"PUT\"}', '2023-07-10 08:08:45', '2023-07-10 08:08:45'),
(2772, 47, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:46', '2023-07-10 08:08:46'),
(2773, 48, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:08:58', '2023-07-10 08:08:58'),
(2774, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:09:03', '2023-07-10 08:09:03'),
(2775, 48, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:09:06', '2023-07-10 08:09:06'),
(2776, 48, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:09:33', '2023-07-10 08:09:33'),
(2777, 48, 'admin/load-stocks', 'POST', '127.0.0.1', '{\"load_stock_number\":\"385\",\"planting_return_number\":\"171\",\"name_of_applicant\":\"Cullen Gilmore\",\"registration_number\":\"57\",\"seed_class\":\"Perspiciatis fugiat\",\"field_size\":null,\"yield_quantity\":\"174\",\"last_field_inspection_date\":\"1988-03-12\",\"load_stock_date\":\"2023-02-04\",\"last_field_inspection_remarks\":\"Sit nisi distinctio\",\"_token\":\"tEjQ19wp5TR0hcskInhHfXdAWsfQwrnpEOTVp3IG\"}', '2023-07-10 08:09:50', '2023-07-10 08:09:50'),
(2778, 48, 'admin/load-stocks/create', 'GET', '127.0.0.1', '[]', '2023-07-10 08:09:51', '2023-07-10 08:09:51'),
(2779, 48, 'admin/load-stocks', 'POST', '127.0.0.1', '{\"load_stock_number\":\"385\",\"planting_return_number\":\"171\",\"name_of_applicant\":\"Cullen Gilmore\",\"registration_number\":\"57\",\"seed_class\":\"Perspiciatis fugiat\",\"field_size\":\"22\",\"yield_quantity\":\"174\",\"last_field_inspection_date\":\"1988-03-12\",\"load_stock_date\":\"2023-02-04\",\"last_field_inspection_remarks\":\"Sit nisi distinctio\",\"_token\":\"tEjQ19wp5TR0hcskInhHfXdAWsfQwrnpEOTVp3IG\"}', '2023-07-10 08:10:02', '2023-07-10 08:10:02'),
(2780, 48, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 08:10:02', '2023-07-10 08:10:02'),
(2781, 47, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:48', '2023-07-10 08:35:48'),
(2782, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:50', '2023-07-10 08:35:50'),
(2783, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:52', '2023-07-10 08:35:52'),
(2784, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:54', '2023-07-10 08:35:54'),
(2785, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:55', '2023-07-10 08:35:55'),
(2786, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:57', '2023-07-10 08:35:57'),
(2787, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:35:58', '2023-07-10 08:35:58'),
(2788, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:00', '2023-07-10 08:36:00'),
(2789, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:01', '2023-07-10 08:36:01'),
(2790, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:03', '2023-07-10 08:36:03'),
(2791, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:04', '2023-07-10 08:36:04'),
(2792, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:05', '2023-07-10 08:36:05'),
(2793, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:07', '2023-07-10 08:36:07'),
(2794, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:09', '2023-07-10 08:36:09'),
(2795, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:10', '2023-07-10 08:36:10'),
(2796, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:12', '2023-07-10 08:36:12'),
(2797, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:13', '2023-07-10 08:36:13'),
(2798, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:14', '2023-07-10 08:36:14'),
(2799, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:16', '2023-07-10 08:36:16'),
(2800, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:17', '2023-07-10 08:36:17'),
(2801, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:19', '2023-07-10 08:36:19'),
(2802, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:36:20', '2023-07-10 08:36:20'),
(2803, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:47', '2023-07-10 08:42:47'),
(2804, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:49', '2023-07-10 08:42:49'),
(2805, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:51', '2023-07-10 08:42:51'),
(2806, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:52', '2023-07-10 08:42:52'),
(2807, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:54', '2023-07-10 08:42:54'),
(2808, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:56', '2023-07-10 08:42:56'),
(2809, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:57', '2023-07-10 08:42:57'),
(2810, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:42:59', '2023-07-10 08:42:59'),
(2811, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:00', '2023-07-10 08:43:00'),
(2812, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:02', '2023-07-10 08:43:02'),
(2813, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:04', '2023-07-10 08:43:04'),
(2814, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:05', '2023-07-10 08:43:05'),
(2815, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:07', '2023-07-10 08:43:07'),
(2816, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:08', '2023-07-10 08:43:08'),
(2817, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:10', '2023-07-10 08:43:10'),
(2818, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:11', '2023-07-10 08:43:11'),
(2819, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:13', '2023-07-10 08:43:13'),
(2820, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:14', '2023-07-10 08:43:14'),
(2821, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:16', '2023-07-10 08:43:16'),
(2822, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:17', '2023-07-10 08:43:17'),
(2823, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:43:19', '2023-07-10 08:43:19'),
(2824, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:01', '2023-07-10 08:45:01'),
(2825, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:02', '2023-07-10 08:45:02'),
(2826, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:04', '2023-07-10 08:45:04'),
(2827, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:05', '2023-07-10 08:45:05'),
(2828, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:06', '2023-07-10 08:45:06'),
(2829, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:08', '2023-07-10 08:45:08'),
(2830, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:09', '2023-07-10 08:45:09'),
(2831, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:11', '2023-07-10 08:45:11'),
(2832, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:12', '2023-07-10 08:45:12'),
(2833, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:14', '2023-07-10 08:45:14'),
(2834, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:15', '2023-07-10 08:45:15'),
(2835, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:17', '2023-07-10 08:45:17'),
(2836, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:18', '2023-07-10 08:45:18'),
(2837, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:19', '2023-07-10 08:45:19'),
(2838, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:21', '2023-07-10 08:45:21'),
(2839, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:22', '2023-07-10 08:45:22'),
(2840, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:24', '2023-07-10 08:45:24'),
(2841, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:25', '2023-07-10 08:45:25'),
(2842, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:27', '2023-07-10 08:45:27'),
(2843, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:28', '2023-07-10 08:45:28'),
(2844, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:45:29', '2023-07-10 08:45:29'),
(2845, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:47:31', '2023-07-10 08:47:31'),
(2846, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:48:28', '2023-07-10 08:48:28'),
(2847, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:48:49', '2023-07-10 08:48:49'),
(2848, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:49:10', '2023-07-10 08:49:10'),
(2849, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:49:30', '2023-07-10 08:49:30'),
(2850, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:53:26', '2023-07-10 08:53:26'),
(2851, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:54:17', '2023-07-10 08:54:17'),
(2852, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:55:02', '2023-07-10 08:55:02'),
(2853, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:56:30', '2023-07-10 08:56:30'),
(2854, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:56:45', '2023-07-10 08:56:45'),
(2855, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 08:56:50', '2023-07-10 08:56:50'),
(2856, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:00:12', '2023-07-10 09:00:12'),
(2857, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:01:54', '2023-07-10 09:01:54'),
(2858, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:03:09', '2023-07-10 09:03:09'),
(2859, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:03:55', '2023-07-10 09:03:55'),
(2860, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:03:59', '2023-07-10 09:03:59'),
(2861, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:05:45', '2023-07-10 09:05:45'),
(2862, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:13:02', '2023-07-10 09:13:02'),
(2863, 47, 'admin/track-and-traces', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"lot_number\":null}', '2023-07-10 09:13:21', '2023-07-10 09:13:21'),
(2864, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:15:45', '2023-07-10 09:15:45'),
(2865, 47, 'admin/track-and-traces', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"lot_number\":null}', '2023-07-10 09:15:55', '2023-07-10 09:15:55'),
(2866, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:16:08', '2023-07-10 09:16:08'),
(2867, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:16:41', '2023-07-10 09:16:41'),
(2868, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:17:32', '2023-07-10 09:17:32'),
(2869, 47, 'admin/track-and-traces', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"lot_number\":null}', '2023-07-10 09:17:37', '2023-07-10 09:17:37'),
(2870, 47, 'admin/track-and-traces', 'GET', '127.0.0.1', '[]', '2023-07-10 09:18:33', '2023-07-10 09:18:33'),
(2871, 47, 'admin/track-and-traces', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"lot_number\":null}', '2023-07-10 09:18:45', '2023-07-10 09:18:45'),
(2872, 47, 'admin/track-and-traces', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"lot_number\":null}', '2023-07-10 09:19:30', '2023-07-10 09:19:30'),
(2873, 47, 'admin/auth/login', 'POST', '127.0.0.1', '{\"_token\":\"YAAtffwXHnbXQQsd6hZ4vNVusx9mpqZH39NQuBHi\",\"username\":\"admin\",\"password\":\"*****-filtered-out-*****\"}', '2023-07-10 09:50:25', '2023-07-10 09:50:25'),
(2874, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 09:50:25', '2023-07-10 09:50:25'),
(2875, 1, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 09:51:59', '2023-07-10 09:51:59'),
(2876, 1, 'admin/load-stocks/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 09:52:11', '2023-07-10 09:52:11'),
(2877, 1, 'admin/load-stocks/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 10:02:43', '2023-07-10 10:02:43'),
(2878, 1, 'admin/load-stocks/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-10 10:03:05', '2023-07-10 10:03:05'),
(2879, 47, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:36', '2023-07-10 10:12:36'),
(2880, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:42', '2023-07-10 10:12:42'),
(2881, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:43', '2023-07-10 10:12:43'),
(2882, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:45', '2023-07-10 10:12:45'),
(2883, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:46', '2023-07-10 10:12:46'),
(2884, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:47', '2023-07-10 10:12:47'),
(2885, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:49', '2023-07-10 10:12:49'),
(2886, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:50', '2023-07-10 10:12:50'),
(2887, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:52', '2023-07-10 10:12:52'),
(2888, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:53', '2023-07-10 10:12:53'),
(2889, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:55', '2023-07-10 10:12:55'),
(2890, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:56', '2023-07-10 10:12:56'),
(2891, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:58', '2023-07-10 10:12:58'),
(2892, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:12:59', '2023-07-10 10:12:59'),
(2893, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:01', '2023-07-10 10:13:01'),
(2894, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:02', '2023-07-10 10:13:02'),
(2895, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:04', '2023-07-10 10:13:04'),
(2896, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:05', '2023-07-10 10:13:05'),
(2897, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:07', '2023-07-10 10:13:07'),
(2898, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:08', '2023-07-10 10:13:08'),
(2899, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:10', '2023-07-10 10:13:10'),
(2900, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:13:11', '2023-07-10 10:13:11'),
(2901, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:16', '2023-07-10 10:15:16'),
(2902, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:17', '2023-07-10 10:15:17'),
(2903, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:19', '2023-07-10 10:15:19'),
(2904, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:20', '2023-07-10 10:15:20'),
(2905, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:22', '2023-07-10 10:15:22'),
(2906, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:23', '2023-07-10 10:15:23'),
(2907, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:25', '2023-07-10 10:15:25'),
(2908, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:26', '2023-07-10 10:15:26'),
(2909, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:28', '2023-07-10 10:15:28'),
(2910, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:29', '2023-07-10 10:15:29'),
(2911, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:31', '2023-07-10 10:15:31'),
(2912, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:32', '2023-07-10 10:15:32'),
(2913, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:33', '2023-07-10 10:15:33'),
(2914, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:35', '2023-07-10 10:15:35'),
(2915, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:36', '2023-07-10 10:15:36'),
(2916, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:38', '2023-07-10 10:15:38'),
(2917, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:39', '2023-07-10 10:15:39'),
(2918, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:41', '2023-07-10 10:15:41'),
(2919, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:42', '2023-07-10 10:15:42'),
(2920, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:43', '2023-07-10 10:15:43'),
(2921, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:45', '2023-07-10 10:15:45'),
(2922, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:15:51', '2023-07-10 10:15:51'),
(2923, 47, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:16:19', '2023-07-10 10:16:19'),
(2924, 1, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:40:32', '2023-07-10 10:40:32'),
(2925, 1, 'admin/load-stocks', 'GET', '127.0.0.1', '[]', '2023-07-10 10:40:38', '2023-07-10 10:40:38'),
(2926, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-10 10:40:44', '2023-07-10 10:40:44'),
(2927, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-10 10:40:51', '2023-07-10 10:40:51'),
(2928, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 03:06:35', '2023-07-11 03:06:35'),
(2929, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 03:07:17', '2023-07-11 03:07:17'),
(2930, 1, 'admin/seed-producers/34', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"N0Ws75WFXO9ZQItbGjhGUBIG8zWfXDikqIrBmnkn\"}', '2023-07-11 03:07:24', '2023-07-11 03:07:24'),
(2931, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 03:07:24', '2023-07-11 03:07:24'),
(2932, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '[]', '2023-07-11 03:27:01', '2023-07-11 03:27:01'),
(2933, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 03:27:22', '2023-07-11 03:27:22'),
(2934, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 03:27:57', '2023-07-11 03:27:57'),
(2935, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 03:27:59', '2023-07-11 03:27:59'),
(2936, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 04:43:32', '2023-07-11 04:43:32'),
(2937, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 04:43:43', '2023-07-11 04:43:43'),
(2938, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 04:44:03', '2023-07-11 04:44:03'),
(2939, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:01:53', '2023-07-11 05:01:53'),
(2940, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:04:34', '2023-07-11 05:04:34'),
(2941, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:05:09', '2023-07-11 05:05:09'),
(2942, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:05:38', '2023-07-11 05:05:38'),
(2943, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:05:51', '2023-07-11 05:05:51'),
(2944, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:06:30', '2023-07-11 05:06:30'),
(2945, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:06:38', '2023-07-11 05:06:38'),
(2946, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:06:44', '2023-07-11 05:06:44'),
(2947, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:06:56', '2023-07-11 05:06:56'),
(2948, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:17', '2023-07-11 05:07:17'),
(2949, 1, 'admin/auth/menu/46', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 05:07:28', '2023-07-11 05:07:28'),
(2950, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:28', '2023-07-11 05:07:28'),
(2951, 1, 'admin/auth/menu/29', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 05:07:45', '2023-07-11 05:07:45'),
(2952, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:45', '2023-07-11 05:07:45'),
(2953, 1, 'admin/auth/menu/32', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 05:07:49', '2023-07-11 05:07:49'),
(2954, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:50', '2023-07-11 05:07:50'),
(2955, 1, 'admin/auth/menu/35', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 05:07:52', '2023-07-11 05:07:52'),
(2956, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:53', '2023-07-11 05:07:53'),
(2957, 1, 'admin/auth/menu/39', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 05:07:56', '2023-07-11 05:07:56'),
(2958, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:07:57', '2023-07-11 05:07:57'),
(2959, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:08:08', '2023-07-11 05:08:08'),
(2960, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:08:20', '2023-07-11 05:08:20'),
(2961, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:08:36', '2023-07-11 05:08:36'),
(2962, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:19:50', '2023-07-11 05:19:50'),
(2963, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:19:52', '2023-07-11 05:19:52'),
(2964, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:20:03', '2023-07-11 05:20:03'),
(2965, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:21:29', '2023-07-11 05:21:29'),
(2966, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:22:20', '2023-07-11 05:22:20'),
(2967, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 05:23:46', '2023-07-11 05:23:46'),
(2968, 1, 'admin/auth/roles/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:24:45', '2023-07-11 05:24:45'),
(2969, 1, 'admin/auth/roles/2', 'PUT', '127.0.0.1', '{\"slug\":\"comissioner\",\"name\":\"Comissioner\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"10\",\"11\",\"12\",null],\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/roles\"}', '2023-07-11 05:25:05', '2023-07-11 05:25:05'),
(2970, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 05:25:05', '2023-07-11 05:25:05'),
(2971, 1, 'admin/auth/roles/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:25:35', '2023-07-11 05:25:35'),
(2972, 1, 'admin/auth/roles/2', 'PUT', '127.0.0.1', '{\"slug\":\"commissioner\",\"name\":\"Commissioner\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"10\",\"11\",\"12\",null],\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/roles\"}', '2023-07-11 05:25:49', '2023-07-11 05:25:49'),
(2973, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 05:25:50', '2023-07-11 05:25:50'),
(2974, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 05:26:57', '2023-07-11 05:26:57'),
(2975, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:03', '2023-07-11 05:27:03'),
(2976, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:06', '2023-07-11 05:27:06'),
(2977, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:14', '2023-07-11 05:27:14'),
(2978, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:29', '2023-07-11 05:27:29'),
(2979, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:31', '2023-07-11 05:27:31'),
(2980, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:27:32', '2023-07-11 05:27:32'),
(2981, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:07', '2023-07-11 05:29:07'),
(2982, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:09', '2023-07-11 05:29:09'),
(2983, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:16', '2023-07-11 05:29:16'),
(2984, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:20', '2023-07-11 05:29:20'),
(2985, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:23', '2023-07-11 05:29:23'),
(2986, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:43', '2023-07-11 05:29:43'),
(2987, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:29:54', '2023-07-11 05:29:54'),
(2988, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:29:58', '2023-07-11 05:29:58'),
(2989, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:30:00', '2023-07-11 05:30:00'),
(2990, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:30:07', '2023-07-11 05:30:07'),
(2991, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 05:30:28', '2023-07-11 05:30:28'),
(2992, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:30:58', '2023-07-11 05:30:58'),
(2993, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:30:59', '2023-07-11 05:30:59'),
(2994, 1, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:34:25', '2023-07-11 05:34:25'),
(2995, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:35:17', '2023-07-11 05:35:17'),
(2996, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_registration_number\":\"845\",\"producer_category\":\"Ipsum voluptates ex\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"0\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"3\"}', '2023-07-11 05:35:27', '2023-07-11 05:35:27'),
(2997, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:35:28', '2023-07-11 05:35:28');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(2998, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_registration_number\":\"845\",\"producer_category\":\"Ipsum voluptates ex\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\"}', '2023-07-11 05:41:09', '2023-07-11 05:41:09'),
(2999, 48, 'admin/seed-producers/create', 'GET', '127.0.0.1', '[]', '2023-07-11 05:41:10', '2023-07-11 05:41:10'),
(3000, 48, 'admin/seed-producers', 'POST', '127.0.0.1', '{\"user_id\":\"48\",\"producer_registration_number\":\"845\",\"producer_category\":\"Ipsum voluptates ex\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\"}', '2023-07-11 05:44:06', '2023-07-11 05:44:06'),
(3001, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:44:23', '2023-07-11 05:44:23'),
(3002, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 05:44:24', '2023-07-11 05:44:24'),
(3003, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 05:47:45', '2023-07-11 05:47:45'),
(3004, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:53:09', '2023-07-11 05:53:09'),
(3005, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:53:24', '2023-07-11 05:53:24'),
(3006, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:53:30', '2023-07-11 05:53:30'),
(3007, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:54:29', '2023-07-11 05:54:29'),
(3008, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:55:12', '2023-07-11 05:55:12'),
(3009, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:55:46', '2023-07-11 05:55:46'),
(3010, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:57:58', '2023-07-11 05:57:58'),
(3011, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 05:59:53', '2023-07-11 05:59:53'),
(3012, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:00:10', '2023-07-11 06:00:10'),
(3013, 48, 'admin/seed-producers/36', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:00:18', '2023-07-11 06:00:18'),
(3014, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:00:19', '2023-07-11 06:00:19'),
(3015, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:04:10', '2023-07-11 06:04:10'),
(3016, 48, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"producer_registration_number\":\"845\",\"producer_category\":\"Seed-breeder\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"_method\":\"PUT\"}', '2023-07-11 06:04:17', '2023-07-11 06:04:17'),
(3017, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:04:17', '2023-07-11 06:04:17'),
(3018, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:04:34', '2023-07-11 06:04:34'),
(3019, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:04:58', '2023-07-11 06:04:58'),
(3020, 1, 'admin/auth/users/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:05:09', '2023-07-11 06:05:09'),
(3021, 1, 'admin/auth/users/1', 'PUT', '127.0.0.1', '{\"username\":\"admin\",\"name\":\"Administrator\",\"password\":\"$2y$10$BOjyoibuKryFHhhAWkEaMuC8tyBTQmxnZNBVoCgYUc9KvLW43YfB2\",\"password_confirmation\":\"$2y$10$BOjyoibuKryFHhhAWkEaMuC8tyBTQmxnZNBVoCgYUc9KvLW43YfB2\",\"roles\":[\"1\",\"2\",null],\"permissions\":[\"1\",null],\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/users\"}', '2023-07-11 06:05:14', '2023-07-11 06:05:14'),
(3022, 1, 'admin/auth/users', 'GET', '127.0.0.1', '[]', '2023-07-11 06:05:15', '2023-07-11 06:05:15'),
(3023, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:05:18', '2023-07-11 06:05:18'),
(3024, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:05:22', '2023-07-11 06:05:22'),
(3025, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:06:30', '2023-07-11 06:06:30'),
(3026, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:08:44', '2023-07-11 06:08:44'),
(3027, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:09:23', '2023-07-11 06:09:23'),
(3028, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:09:38', '2023-07-11 06:09:38'),
(3029, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:10:02', '2023-07-11 06:10:02'),
(3030, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:11:36', '2023-07-11 06:11:36'),
(3031, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:12:14', '2023-07-11 06:12:14'),
(3032, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:12:34', '2023-07-11 06:12:34'),
(3033, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:12:36', '2023-07-11 06:12:36'),
(3034, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:13:35', '2023-07-11 06:13:35'),
(3035, 1, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"status\":\"accepted\",\"status_comment\":null,\"grower_number\":\"37840\",\"valid_from\":\"2023-07-11 09:12:14\",\"valid_until\":\"2023-07-11 09:12:14\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\"}', '2023-07-11 06:13:41', '2023-07-11 06:13:41'),
(3036, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:13:42', '2023-07-11 06:13:42'),
(3037, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:15:12', '2023-07-11 06:15:12'),
(3038, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:15:19', '2023-07-11 06:15:19'),
(3039, 1, 'admin/auth/setting', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:24:57', '2023-07-11 06:24:57'),
(3040, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:25:03', '2023-07-11 06:25:03'),
(3041, 1, 'admin/auth/users/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:25:06', '2023-07-11 06:25:06'),
(3042, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:25:11', '2023-07-11 06:25:11'),
(3043, 1, 'admin/auth/roles/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:25:13', '2023-07-11 06:25:13'),
(3044, 1, 'admin/auth/roles', 'POST', '127.0.0.1', '{\"slug\":\"grower\",\"name\":\"Seed grower\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",null],\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/roles\"}', '2023-07-11 06:26:13', '2023-07-11 06:26:13'),
(3045, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 06:26:13', '2023-07-11 06:26:13'),
(3046, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:30:13', '2023-07-11 06:30:13'),
(3047, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:30:18', '2023-07-11 06:30:18'),
(3048, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:30:21', '2023-07-11 06:30:21'),
(3049, 1, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"status\":\"accepted\",\"status_comment\":\"good\",\"grower_number\":\"37840\",\"valid_from\":\"2023-07-11 09:12:14\",\"valid_until\":\"2023-07-11 09:12:14\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:30:40', '2023-07-11 06:30:40'),
(3050, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:30:40', '2023-07-11 06:30:40'),
(3051, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:30:44', '2023-07-11 06:30:44'),
(3052, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:31:06', '2023-07-11 06:31:06'),
(3053, 1, 'admin/auth/menu/20/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:31:11', '2023-07-11 06:31:11'),
(3054, 1, 'admin/auth/menu/20', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Application forms\",\"icon\":\"fa-align-left\",\"uri\":null,\"roles\":[\"1\",\"2\",\"3\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:31:30', '2023-07-11 06:31:30'),
(3055, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:31:31', '2023-07-11 06:31:31'),
(3056, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:31:34', '2023-07-11 06:31:34'),
(3057, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Seed Producers\",\"icon\":\"fa-anchor\",\"uri\":\"seed-producers\",\"roles\":[\"1\",\"2\",\"3\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:31:44', '2023-07-11 06:31:44'),
(3058, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:31:44', '2023-07-11 06:31:44'),
(3059, 1, 'admin/auth/menu/25/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:31:48', '2023-07-11 06:31:48'),
(3060, 1, 'admin/auth/menu/25', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Qds Producer\",\"icon\":\"fa-align-left\",\"uri\":\"qds-producer\",\"roles\":[\"2\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:32:14', '2023-07-11 06:32:14'),
(3061, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:32:15', '2023-07-11 06:32:15'),
(3062, 1, 'admin/auth/menu/26/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:32:17', '2023-07-11 06:32:17'),
(3063, 1, 'admin/auth/menu/26', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Co-operatives\",\"icon\":\"fa-anchor\",\"uri\":\"cooperatives\",\"roles\":[\"2\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:32:36', '2023-07-11 06:32:36'),
(3064, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:32:36', '2023-07-11 06:32:36'),
(3065, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:32:40', '2023-07-11 06:32:40'),
(3066, 1, 'admin/auth/menu/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:32:52', '2023-07-11 06:32:52'),
(3067, 1, 'admin/auth/menu/1', 'PUT', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Dashboard\",\"icon\":\"icon-chart-bar\",\"uri\":\"\\/\",\"roles\":[null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:32:59', '2023-07-11 06:32:59'),
(3068, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:32:59', '2023-07-11 06:32:59'),
(3069, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:33:02', '2023-07-11 06:33:02'),
(3070, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:04', '2023-07-11 06:33:04'),
(3071, 1, 'admin/auth/menu/45', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:33:10', '2023-07-11 06:33:10'),
(3072, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:10', '2023-07-11 06:33:10'),
(3073, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 06:33:12', '2023-07-11 06:33:12'),
(3074, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:17', '2023-07-11 06:33:17'),
(3075, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:33:26', '2023-07-11 06:33:26'),
(3076, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:28', '2023-07-11 06:33:28'),
(3077, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:29', '2023-07-11 06:33:29'),
(3078, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:38', '2023-07-11 06:33:38'),
(3079, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:33:40', '2023-07-11 06:33:40'),
(3080, 1, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"status\":\"rejected\",\"status_comment\":\"good\",\"grower_number\":\"37840\",\"valid_from\":\"2023-07-11 09:12:14\",\"valid_until\":\"2023-07-11 09:12:14\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:33:46', '2023-07-11 06:33:46'),
(3081, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:33:46', '2023-07-11 06:33:46'),
(3082, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 06:33:48', '2023-07-11 06:33:48'),
(3083, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:34:12', '2023-07-11 06:34:12'),
(3084, 1, 'admin/auth/menu/27', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:34:21', '2023-07-11 06:34:21'),
(3085, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:34:22', '2023-07-11 06:34:22'),
(3086, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 06:34:25', '2023-07-11 06:34:25'),
(3087, 1, 'admin/auth/menu/42', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:34:37', '2023-07-11 06:34:37'),
(3088, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:34:37', '2023-07-11 06:34:37'),
(3089, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 06:34:39', '2023-07-11 06:34:39'),
(3090, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:34:45', '2023-07-11 06:34:45'),
(3091, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:34:49', '2023-07-11 06:34:49'),
(3092, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:34:56', '2023-07-11 06:34:56'),
(3093, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:35:27', '2023-07-11 06:35:27'),
(3094, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:35:45', '2023-07-11 06:35:45'),
(3095, 1, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:35:48', '2023-07-11 06:35:48'),
(3096, 1, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"status\":\"accepted\",\"status_comment\":\"good\",\"grower_number\":\"37840\",\"valid_from\":\"2023-07-11 09:12:14\",\"valid_until\":\"2023-07-11 09:12:14\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:35:52', '2023-07-11 06:35:52'),
(3097, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:35:52', '2023-07-11 06:35:52'),
(3098, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:35:55', '2023-07-11 06:35:55'),
(3099, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:36:16', '2023-07-11 06:36:16'),
(3100, 1, 'admin/auth/menu/25', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:36:23', '2023-07-11 06:36:23'),
(3101, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:36:23', '2023-07-11 06:36:23'),
(3102, 1, 'admin/auth/menu/26', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:36:26', '2023-07-11 06:36:26'),
(3103, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:36:26', '2023-07-11 06:36:26'),
(3104, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:36:30', '2023-07-11 06:36:30'),
(3105, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:36:39', '2023-07-11 06:36:39'),
(3106, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Seed Producer Form\",\"icon\":\"fa-anchor\",\"uri\":\"seed-producers\",\"roles\":[\"1\",\"2\",\"3\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 06:36:46', '2023-07-11 06:36:46'),
(3107, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:36:47', '2023-07-11 06:36:47'),
(3108, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:36:49', '2023-07-11 06:36:49'),
(3109, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:36:52', '2023-07-11 06:36:52'),
(3110, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:36:59', '2023-07-11 06:36:59'),
(3111, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:38:58', '2023-07-11 06:38:58'),
(3112, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:39:00', '2023-07-11 06:39:00'),
(3113, 48, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"producer_registration_number\":\"845\",\"producer_category\":\"Seed-breeder\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:39:04', '2023-07-11 06:39:04'),
(3114, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 06:39:05', '2023-07-11 06:39:05'),
(3115, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:39:08', '2023-07-11 06:39:08'),
(3116, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:39:52', '2023-07-11 06:39:52'),
(3117, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:39:55', '2023-07-11 06:39:55'),
(3118, 48, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"producer_registration_number\":\"845\",\"producer_category\":\"Individual-grower\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur e\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:40:01', '2023-07-11 06:40:01'),
(3119, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:40:01', '2023-07-11 06:40:01'),
(3120, 48, 'admin/seed-producers/36/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:40:32', '2023-07-11 06:40:32'),
(3121, 48, 'admin/seed-producers/36', 'PUT', '127.0.0.1', '{\"producer_registration_number\":\"845\",\"producer_category\":\"Individual-grower\",\"name_of_applicant\":\"Mona Finley\",\"applicant_phone_number\":\"+1 (492) 882-7817\",\"applicant_email\":\"vexyje@mailinator.com\",\"premises_location\":\"Quia sint voluptas q\",\"proposed_farm_location\":\"Aut tenetur animi e\",\"years_of_experience\":\"1986\",\"gardening_history_description\":\"Aliquip odio in sit\",\"storage_facilities_description\":\"Soluta consectetur eaa\",\"have_adequate_isolation\":\"1\",\"labor_details\":\"Culpa nesciunt des\",\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/seed-producers\"}', '2023-07-11 06:40:48', '2023-07-11 06:40:48'),
(3122, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:40:48', '2023-07-11 06:40:48'),
(3123, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:44:20', '2023-07-11 06:44:20'),
(3124, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:44:30', '2023-07-11 06:44:30'),
(3125, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Crop-declarations\",\"icon\":\"fa-wpforms\",\"uri\":\"crop-declarations\",\"roles\":[\"2\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 06:45:38', '2023-07-11 06:45:38'),
(3126, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:45:38', '2023-07-11 06:45:38'),
(3127, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":20,\\\"children\\\":[{\\\"id\\\":21},{\\\"id\\\":47}]},{\\\"id\\\":22,\\\"children\\\":[{\\\"id\\\":44},{\\\"id\\\":23}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2023-07-11 06:45:43', '2023-07-11 06:45:43'),
(3128, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:45:44', '2023-07-11 06:45:44'),
(3129, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 06:45:45', '2023-07-11 06:45:45'),
(3130, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:45:49', '2023-07-11 06:45:49'),
(3131, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:45:55', '2023-07-11 06:45:55'),
(3132, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 06:45:58', '2023-07-11 06:45:58'),
(3133, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 06:46:03', '2023-07-11 06:46:03'),
(3134, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:46:06', '2023-07-11 06:46:06'),
(3135, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:46:10', '2023-07-11 06:46:10'),
(3136, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:48:47', '2023-07-11 06:48:47'),
(3137, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:48:48', '2023-07-11 06:48:48'),
(3138, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:48:53', '2023-07-11 06:48:53'),
(3139, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:48:55', '2023-07-11 06:48:55'),
(3140, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:49:33', '2023-07-11 06:49:33'),
(3141, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:50:10', '2023-07-11 06:50:10'),
(3142, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:50:32', '2023-07-11 06:50:32'),
(3143, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:57:30', '2023-07-11 06:57:30'),
(3144, 48, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 06:57:46', '2023-07-11 06:57:46'),
(3145, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:57:57', '2023-07-11 06:57:57'),
(3146, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:57:59', '2023-07-11 06:57:59'),
(3147, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 06:57:59', '2023-07-11 06:57:59'),
(3148, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:58:02', '2023-07-11 06:58:02'),
(3149, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:58:50', '2023-07-11 06:58:50'),
(3150, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:58:57', '2023-07-11 06:58:57'),
(3151, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 06:58:59', '2023-07-11 06:58:59'),
(3152, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:59:04', '2023-07-11 06:59:04'),
(3153, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 06:59:25', '2023-07-11 06:59:25'),
(3154, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:02:30', '2023-07-11 07:02:30'),
(3155, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:11:57', '2023-07-11 07:11:57'),
(3156, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:12:18', '2023-07-11 07:12:18'),
(3157, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:12:19', '2023-07-11 07:12:19'),
(3158, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:12:20', '2023-07-11 07:12:20'),
(3159, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:12:32', '2023-07-11 07:12:32'),
(3160, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:13:22', '2023-07-11 07:13:22'),
(3161, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:13:33', '2023-07-11 07:13:33'),
(3162, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:15:53', '2023-07-11 07:15:53'),
(3163, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:19:55', '2023-07-11 07:19:55'),
(3164, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:20:14', '2023-07-11 07:20:14'),
(3165, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:20:45', '2023-07-11 07:20:45'),
(3166, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:21:04', '2023-07-11 07:21:04'),
(3167, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:21:06', '2023-07-11 07:21:06'),
(3168, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:22:56', '2023-07-11 07:22:56'),
(3169, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:23:00', '2023-07-11 07:23:00'),
(3170, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:23:06', '2023-07-11 07:23:06'),
(3171, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:23:12', '2023-07-11 07:23:12'),
(3172, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:23:23', '2023-07-11 07:23:23'),
(3173, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 07:25:05', '2023-07-11 07:25:05'),
(3174, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:25:14', '2023-07-11 07:25:14'),
(3175, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 07:26:01', '2023-07-11 07:26:01'),
(3176, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 07:26:42', '2023-07-11 07:26:42'),
(3177, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 07:26:56', '2023-07-11 07:26:56'),
(3178, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 07:30:39', '2023-07-11 07:30:39'),
(3179, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:31:26', '2023-07-11 07:31:26'),
(3180, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 07:31:29', '2023-07-11 07:31:29'),
(3181, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:31:34', '2023-07-11 07:31:34'),
(3182, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:38:40', '2023-07-11 07:38:40'),
(3183, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:38:57', '2023-07-11 07:38:57'),
(3184, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:39:06', '2023-07-11 07:39:06'),
(3185, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:39:14', '2023-07-11 07:39:14'),
(3186, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:39:43', '2023-07-11 07:39:43'),
(3187, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:12', '2023-07-11 07:41:12'),
(3188, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:14', '2023-07-11 07:41:14'),
(3189, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:15', '2023-07-11 07:41:15'),
(3190, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 07:41:15', '2023-07-11 07:41:15'),
(3191, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 07:41:43', '2023-07-11 07:41:43'),
(3192, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:51', '2023-07-11 07:41:51'),
(3193, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:56', '2023-07-11 07:41:56'),
(3194, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:41:57', '2023-07-11 07:41:57'),
(3195, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:42:00', '2023-07-11 07:42:00'),
(3196, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:42:55', '2023-07-11 07:42:55'),
(3197, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:43:14', '2023-07-11 07:43:14'),
(3198, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:43:20', '2023-07-11 07:43:20'),
(3199, 1, 'admin/crops/10', 'PUT', '127.0.0.1', '{\"crop_name\":\"Maize\",\"crop_code\":null,\"number_of_days_before_submission\":\"413\",\"seed_viability_period\":null,\"number_of_inspections\":\"4\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crops\"}', '2023-07-11 07:43:26', '2023-07-11 07:43:26'),
(3200, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 07:43:26', '2023-07-11 07:43:26'),
(3201, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 07:44:18', '2023-07-11 07:44:18'),
(3202, 1, 'admin/crops/11/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:44:21', '2023-07-11 07:44:21'),
(3203, 1, 'admin/crops/11', 'PUT', '127.0.0.1', '{\"crop_name\":\"Beans\",\"crop_code\":null,\"number_of_days_before_submission\":\"352\",\"seed_viability_period\":null,\"number_of_inspections\":\"5\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crops\"}', '2023-07-11 07:44:27', '2023-07-11 07:44:27'),
(3204, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 07:44:27', '2023-07-11 07:44:27'),
(3205, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:44:33', '2023-07-11 07:44:33'),
(3206, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (227) 997-3485\",\"applicant_registration_number\":\"564\",\"seed_producer_id\":\"0\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Plato Hicks\",\"district_region\":\"Odit veniam volupta\",\"circle\":\"Enim nemo quo conseq\",\"township\":\"Eum at voluptate ips\",\"village\":\"Commodo ut a est ha\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"321\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Rhea Patton\",\"seed_supplier_registration_number\":\"760\",\"source_lot_number\":\"573\",\"origin_of_variety\":\"Vel tempor occaecat\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\"}', '2023-07-11 07:44:48', '2023-07-11 07:44:48'),
(3207, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:44:49', '2023-07-11 07:44:49'),
(3208, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:45:48', '2023-07-11 07:45:48'),
(3209, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:45:51', '2023-07-11 07:45:51'),
(3210, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:46:27', '2023-07-11 07:46:27'),
(3211, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (394) 486-4597\",\"applicant_registration_number\":\"788\",\"seed_producer_id\":\"0\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Bernard Ryan\",\"district_region\":\"Tempora dolor nemo m\",\"circle\":\"Officia illum quasi\",\"township\":\"Odio tempor consecte\",\"village\":\"Totam optio quod la\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"564\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Olivia Bishop\",\"seed_supplier_registration_number\":\"419\",\"source_lot_number\":\"741\",\"origin_of_variety\":\"Hic dolor impedit m\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crop-declarations\"}', '2023-07-11 07:46:41', '2023-07-11 07:46:41'),
(3212, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:46:42', '2023-07-11 07:46:42'),
(3213, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:48:35', '2023-07-11 07:48:35'),
(3214, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:49:35', '2023-07-11 07:49:35'),
(3215, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '[]', '2023-07-11 07:49:37', '2023-07-11 07:49:37'),
(3216, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:49:38', '2023-07-11 07:49:38'),
(3217, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:49:38', '2023-07-11 07:49:38'),
(3218, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:49:40', '2023-07-11 07:49:40'),
(3219, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:49:50', '2023-07-11 07:49:50'),
(3220, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"seed_producer_id\":\"36\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (919) 681-3536\",\"applicant_registration_number\":\"723\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Jeanette Rocha\",\"district_region\":\"Expedita qui porro e\",\"circle\":\"Ut quos quas placeat\",\"township\":\"Quasi explicabo Eos\",\"village\":\"Quas excepteur earum\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"611\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Leila Giles\",\"seed_supplier_registration_number\":\"103\",\"source_lot_number\":\"977\",\"origin_of_variety\":\"Laudantium quae cor\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\"}', '2023-07-11 07:50:03', '2023-07-11 07:50:03'),
(3221, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:50:03', '2023-07-11 07:50:03'),
(3222, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:50:12', '2023-07-11 07:50:12'),
(3223, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:50:28', '2023-07-11 07:50:28'),
(3224, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:50:31', '2023-07-11 07:50:31'),
(3225, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:50:33', '2023-07-11 07:50:33'),
(3226, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"seed_producer_id\":\"36\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (903) 808-7877\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crop-declarations\"}', '2023-07-11 07:50:42', '2023-07-11 07:50:42'),
(3227, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:50:42', '2023-07-11 07:50:42'),
(3228, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"seed_producer_id\":\"36\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (903) 808-7877\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\"}', '2023-07-11 07:51:44', '2023-07-11 07:51:44'),
(3229, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:51:45', '2023-07-11 07:51:45'),
(3230, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"seed_producer_id\":\"36\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (903) 808-7877\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\"}', '2023-07-11 07:52:38', '2023-07-11 07:52:38'),
(3231, 48, 'admin/crop-declarations/create', 'GET', '127.0.0.1', '[]', '2023-07-11 07:52:39', '2023-07-11 07:52:39'),
(3232, 48, 'admin/crop-declarations', 'POST', '127.0.0.1', '{\"applicant_id\":\"48\",\"seed_producer_id\":\"36\",\"crop_variety_id\":\"6\",\"phone_number\":\"+1 (903) 808-7877\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"_token\":\"tpjzeqIegsx6V3W18ozkDK85IZ9fcx7ApUhIT5ug\",\"after-save\":\"1\"}', '2023-07-11 07:54:57', '2023-07-11 07:54:57'),
(3233, 48, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 07:54:57', '2023-07-11 07:54:57'),
(3234, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 07:55:00', '2023-07-11 07:55:00'),
(3235, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 08:10:44', '2023-07-11 08:10:44'),
(3236, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:10:47', '2023-07-11 08:10:47'),
(3237, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 08:11:58', '2023-07-11 08:11:58'),
(3238, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 08:13:03', '2023-07-11 08:13:03'),
(3239, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 08:16:24', '2023-07-11 08:16:24'),
(3240, 48, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:16:32', '2023-07-11 08:16:32'),
(3241, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:16:36', '2023-07-11 08:16:36'),
(3242, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:16:42', '2023-07-11 08:16:42'),
(3243, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:16:44', '2023-07-11 08:16:44'),
(3244, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:16:59', '2023-07-11 08:16:59'),
(3245, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:17:01', '2023-07-11 08:17:01'),
(3246, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 08:18:17', '2023-07-11 08:18:17'),
(3247, 1, 'admin/crop-declarations/9', 'PUT', '127.0.0.1', '{\"crop_variety_id\":\"6\",\"phone_number\":\"1\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"status\":\"accepted\",\"status_comment\":null,\"inspector_id\":\"49\",\"remarks\":\"some\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crop-declarations\"}', '2023-07-11 08:18:45', '2023-07-11 08:18:45'),
(3248, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:18:45', '2023-07-11 08:18:45'),
(3249, 1, 'admin/crop-declarations/9', 'PUT', '127.0.0.1', '{\"crop_variety_id\":\"6\",\"phone_number\":\"1\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"status\":\"accepted\",\"status_comment\":null,\"inspector_id\":\"49\",\"remarks\":\"some\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"after-save\":\"1\",\"_method\":\"PUT\"}', '2023-07-11 08:19:46', '2023-07-11 08:19:46'),
(3250, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:19:46', '2023-07-11 08:19:46'),
(3251, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:21:23', '2023-07-11 08:21:23'),
(3252, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:22:40', '2023-07-11 08:22:40'),
(3253, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:23:57', '2023-07-11 08:23:57'),
(3254, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:24:41', '2023-07-11 08:24:41'),
(3255, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:25:12', '2023-07-11 08:25:12'),
(3256, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:27:10', '2023-07-11 08:27:10'),
(3257, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:28:02', '2023-07-11 08:28:02'),
(3258, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 08:45:05', '2023-07-11 08:45:05'),
(3259, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:45:17', '2023-07-11 08:45:17'),
(3260, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:45:20', '2023-07-11 08:45:20'),
(3261, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:45:29', '2023-07-11 08:45:29'),
(3262, 1, 'admin/inspection-types/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:45:31', '2023-07-11 08:45:31'),
(3263, 1, 'admin/inspection-types/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:47:50', '2023-07-11 08:47:50'),
(3264, 1, 'admin/inspection-types/2/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 08:48:12', '2023-07-11 08:48:12'),
(3265, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:48:14', '2023-07-11 08:48:14'),
(3266, 1, 'admin/inspection-types/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:48:35', '2023-07-11 08:48:35');
INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(3267, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:48:42', '2023-07-11 08:48:42'),
(3268, 1, 'admin/inspection-types/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:48:47', '2023-07-11 08:48:47'),
(3269, 1, 'admin/inspection-types/1', 'PUT', '127.0.0.1', '{\"crop_id\":\"10\",\"inspection_type_name\":\"Pre-flowering\",\"order\":\"1\",\"period_after_planting\":\"40\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/inspection-types\"}', '2023-07-11 08:48:58', '2023-07-11 08:48:58'),
(3270, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-11 08:48:58', '2023-07-11 08:48:58'),
(3271, 1, 'admin/inspection-types/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:49:00', '2023-07-11 08:49:00'),
(3272, 1, 'admin/inspection-types/2', 'PUT', '127.0.0.1', '{\"crop_id\":\"10\",\"inspection_type_name\":\"Flowering\",\"order\":\"2\",\"period_after_planting\":\"50\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/inspection-types\"}', '2023-07-11 08:49:07', '2023-07-11 08:49:07'),
(3273, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-11 08:49:07', '2023-07-11 08:49:07'),
(3274, 1, 'admin/inspection-types/3/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:49:09', '2023-07-11 08:49:09'),
(3275, 1, 'admin/inspection-types/3', 'PUT', '127.0.0.1', '{\"crop_id\":\"10\",\"inspection_type_name\":\"Pre-harvest\",\"order\":\"3\",\"period_after_planting\":\"30\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/inspection-types\"}', '2023-07-11 08:49:18', '2023-07-11 08:49:18'),
(3276, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-11 08:49:18', '2023-07-11 08:49:18'),
(3277, 1, 'admin/inspection-types/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:49:20', '2023-07-11 08:49:20'),
(3278, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:49:35', '2023-07-11 08:49:35'),
(3279, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '[]', '2023-07-11 08:50:30', '2023-07-11 08:50:30'),
(3280, 1, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 08:53:53', '2023-07-11 08:53:53'),
(3281, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:53:56', '2023-07-11 08:53:56'),
(3282, 1, 'admin/crops/10/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:00', '2023-07-11 08:54:00'),
(3283, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:26', '2023-07-11 08:54:26'),
(3284, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:28', '2023-07-11 08:54:28'),
(3285, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:32', '2023-07-11 08:54:32'),
(3286, 1, 'admin/crops/11/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:36', '2023-07-11 08:54:36'),
(3287, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:54:43', '2023-07-11 08:54:43'),
(3288, 1, 'admin/inspection-types', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:55:02', '2023-07-11 08:55:02'),
(3289, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:55:22', '2023-07-11 08:55:22'),
(3290, 1, 'admin/crops/11/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:55:26', '2023-07-11 08:55:26'),
(3291, 1, 'admin/crops/11', 'PUT', '127.0.0.1', '{\"crop_name\":\"Beans\",\"crop_code\":null,\"number_of_days_before_submission\":\"352\",\"seed_viability_period\":null,\"number_of_inspections\":\"5\",\"inspection_types\":{\"new_1\":{\"inspection_type_name\":\"Pre-flowring\",\"order\":\"1\",\"period_after_planting\":\"30\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"inspection_type_name\":\"Flowerin\",\"order\":\"2\",\"period_after_planting\":\"40\",\"id\":null,\"_remove_\":\"0\"},\"new_3\":{\"inspection_type_name\":\"Pre-harvesting\",\"order\":\"3\",\"period_after_planting\":\"50\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crops\"}', '2023-07-11 08:56:38', '2023-07-11 08:56:38'),
(3292, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 08:56:39', '2023-07-11 08:56:39'),
(3293, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:56:49', '2023-07-11 08:56:49'),
(3294, 1, 'admin/crops/11/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:57:45', '2023-07-11 08:57:45'),
(3295, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:58:24', '2023-07-11 08:58:24'),
(3296, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 08:58:34', '2023-07-11 08:58:34'),
(3297, 1, 'admin/auth/menu/44', 'DELETE', '127.0.0.1', '{\"_method\":\"delete\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 08:58:40', '2023-07-11 08:58:40'),
(3298, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:58:41', '2023-07-11 08:58:41'),
(3299, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 08:58:45', '2023-07-11 08:58:45'),
(3300, 1, 'admin/crops', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 08:58:48', '2023-07-11 08:58:48'),
(3301, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 09:00:09', '2023-07-11 09:00:09'),
(3302, 1, 'admin/crops', 'GET', '127.0.0.1', '[]', '2023-07-11 09:00:32', '2023-07-11 09:00:32'),
(3303, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:01:29', '2023-07-11 09:01:29'),
(3304, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:02:06', '2023-07-11 09:02:06'),
(3305, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:02:14', '2023-07-11 09:02:14'),
(3306, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:03:05', '2023-07-11 09:03:05'),
(3307, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:03:20', '2023-07-11 09:03:20'),
(3308, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:18:22', '2023-07-11 09:18:22'),
(3309, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:18:45', '2023-07-11 09:18:45'),
(3310, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:19:49', '2023-07-11 09:19:49'),
(3311, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:20:48', '2023-07-11 09:20:48'),
(3312, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:23:15', '2023-07-11 09:23:15'),
(3313, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:28:20', '2023-07-11 09:28:20'),
(3314, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:29:16', '2023-07-11 09:29:16'),
(3315, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:29:58', '2023-07-11 09:29:58'),
(3316, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:01', '2023-07-11 09:30:01'),
(3317, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:02', '2023-07-11 09:30:02'),
(3318, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:54', '2023-07-11 09:30:54'),
(3319, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:55', '2023-07-11 09:30:55'),
(3320, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:57', '2023-07-11 09:30:57'),
(3321, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:30:58', '2023-07-11 09:30:58'),
(3322, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:31:54', '2023-07-11 09:31:54'),
(3323, 1, 'admin/crop-declarations/9', 'PUT', '127.0.0.1', '{\"crop_variety_id\":\"6\",\"phone_number\":\"413\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"status\":\"accepted\",\"remarks\":\"some\",\"inspector_id\":\"49\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\"}', '2023-07-11 09:32:06', '2023-07-11 09:32:06'),
(3324, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:32:06', '2023-07-11 09:32:06'),
(3325, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:33:48', '2023-07-11 09:33:48'),
(3326, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:34:04', '2023-07-11 09:34:04'),
(3327, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:34:18', '2023-07-11 09:34:18'),
(3328, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:37:54', '2023-07-11 09:37:54'),
(3329, 1, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 09:39:01', '2023-07-11 09:39:01'),
(3330, 1, 'admin/crop-declarations/9', 'PUT', '127.0.0.1', '{\"crop_variety_id\":\"6\",\"phone_number\":\"413\",\"applicant_registration_number\":\"473\",\"garden_size\":null,\"gps_coordinates_1\":null,\"gps_coordinates_2\":null,\"gps_coordinates_3\":null,\"gps_coordinates_4\":null,\"field_name\":\"Yoshi Ferguson\",\"district_region\":\"Minus et exercitatio\",\"circle\":\"Eveniet quam offici\",\"township\":\"Autem harum culpa v\",\"village\":\"Lorem aliquam est ni\",\"planting_date\":\"2023-07-11\",\"quantity_of_seed_planted\":\"306\",\"expected_yield\":\"0\",\"seed_supplier_name\":\"Yetta Oneill\",\"seed_supplier_registration_number\":\"688\",\"source_lot_number\":\"835\",\"origin_of_variety\":\"Voluptatibus laboris\",\"garden_location_latitude\":null,\"garden_location_longitude\":null,\"status\":\"Inspection assigned\",\"remarks\":\"some\",\"inspector_id\":\"49\",\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/crop-declarations\"}', '2023-07-11 09:39:05', '2023-07-11 09:39:05'),
(3331, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:39:05', '2023-07-11 09:39:05'),
(3332, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 09:42:38', '2023-07-11 09:42:38'),
(3333, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Field inspections\",\"icon\":\"fa-adjust\",\"uri\":\"field-inspections\",\"roles\":[\"2\",\"4\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\"}', '2023-07-11 09:43:16', '2023-07-11 09:43:16'),
(3334, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 09:43:17', '2023-07-11 09:43:17'),
(3335, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":20,\\\"children\\\":[{\\\"id\\\":21},{\\\"id\\\":47},{\\\"id\\\":48}]},{\\\"id\\\":22,\\\"children\\\":[{\\\"id\\\":23}]},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}', '2023-07-11 09:43:23', '2023-07-11 09:43:23'),
(3336, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:43:23', '2023-07-11 09:43:23'),
(3337, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 09:43:31', '2023-07-11 09:43:31'),
(3338, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:43:34', '2023-07-11 09:43:34'),
(3339, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:45:56', '2023-07-11 09:45:56'),
(3340, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:45:56', '2023-07-11 09:45:56'),
(3341, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:46:49', '2023-07-11 09:46:49'),
(3342, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:47:02', '2023-07-11 09:47:02'),
(3343, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:47:31', '2023-07-11 09:47:31'),
(3344, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:37', '2023-07-11 09:50:37'),
(3345, 48, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:38', '2023-07-11 09:50:38'),
(3346, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:40', '2023-07-11 09:50:40'),
(3347, 48, 'admin/crop-declarations/9/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:44', '2023-07-11 09:50:44'),
(3348, 48, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:48', '2023-07-11 09:50:48'),
(3349, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:50:57', '2023-07-11 09:50:57'),
(3350, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:52:09', '2023-07-11 09:52:09'),
(3351, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:52:53', '2023-07-11 09:52:53'),
(3352, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:53:16', '2023-07-11 09:53:16'),
(3353, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"is_active\":[\"0\"],\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:53:20', '2023-07-11 09:53:20'),
(3354, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"is_active\":[\"1\"],\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:53:24', '2023-07-11 09:53:24'),
(3355, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:53:26', '2023-07-11 09:53:26'),
(3356, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:53:48', '2023-07-11 09:53:48'),
(3357, 48, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:53:56', '2023-07-11 09:53:56'),
(3358, 48, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:54:34', '2023-07-11 09:54:34'),
(3359, 48, 'admin/auth/logout', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:54:52', '2023-07-11 09:54:52'),
(3360, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 09:55:07', '2023-07-11 09:55:07'),
(3361, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:55:31', '2023-07-11 09:55:31'),
(3362, 1, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:55:34', '2023-07-11 09:55:34'),
(3363, 1, 'admin/auth/menu/21', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Seed Producer Form\",\"icon\":\"fa-anchor\",\"uri\":\"seed-producers\",\"roles\":[\"1\",\"2\",\"3\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 09:55:41', '2023-07-11 09:55:41'),
(3364, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 09:55:41', '2023-07-11 09:55:41'),
(3365, 1, 'admin/auth/menu/47/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:55:44', '2023-07-11 09:55:44'),
(3366, 1, 'admin/auth/menu/47', 'PUT', '127.0.0.1', '{\"parent_id\":\"20\",\"title\":\"Crop-declarations\",\"icon\":\"fa-wpforms\",\"uri\":\"crop-declarations\",\"roles\":[\"2\",\"5\",null],\"permission\":null,\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}', '2023-07-11 09:55:50', '2023-07-11 09:55:50'),
(3367, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 09:55:51', '2023-07-11 09:55:51'),
(3368, 49, 'admin', 'GET', '127.0.0.1', '[]', '2023-07-11 09:55:53', '2023-07-11 09:55:53'),
(3369, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:55:56', '2023-07-11 09:55:56'),
(3370, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:56:05', '2023-07-11 09:56:05'),
(3371, 1, 'admin/auth/roles/4/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:56:11', '2023-07-11 09:56:11'),
(3372, 1, 'admin/auth/roles/4', 'PUT', '127.0.0.1', '{\"slug\":\"inspector\",\"name\":\"Inspector\",\"permissions\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",null],\"_token\":\"Be8qK2vyv2Tck7iOcPoKvkXH2RXfbNXvb6791VIH\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/roles\"}', '2023-07-11 09:56:14', '2023-07-11 09:56:14'),
(3373, 1, 'admin/auth/roles', 'GET', '127.0.0.1', '[]', '2023-07-11 09:56:15', '2023-07-11 09:56:15'),
(3374, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:56:17', '2023-07-11 09:56:17'),
(3375, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:56:20', '2023-07-11 09:56:20'),
(3376, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:56:28', '2023-07-11 09:56:28'),
(3377, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 09:57:10', '2023-07-11 09:57:10'),
(3378, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 09:59:00', '2023-07-11 09:59:00'),
(3379, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:00:34', '2023-07-11 10:00:34'),
(3380, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:01:14', '2023-07-11 10:01:14'),
(3381, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:01:20', '2023-07-11 10:01:20'),
(3382, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:02:52', '2023-07-11 10:02:52'),
(3383, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:03:36', '2023-07-11 10:03:36'),
(3384, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:05:05', '2023-07-11 10:05:05'),
(3385, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:07:05', '2023-07-11 10:07:05'),
(3386, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:07:15', '2023-07-11 10:07:15'),
(3387, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:07:30', '2023-07-11 10:07:30'),
(3388, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:07:57', '2023-07-11 10:07:57'),
(3389, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:08:20', '2023-07-11 10:08:20'),
(3390, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:08:33', '2023-07-11 10:08:33'),
(3391, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:08:41', '2023-07-11 10:08:41'),
(3392, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:09:26', '2023-07-11 10:09:26'),
(3393, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:09:30', '2023-07-11 10:09:30'),
(3394, 49, 'admin/field-inspections/1', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":\"36\",\"field_size\":null,\"type_of_inspection\":\"Nostrud incidunt es\",\"seed_generation\":\"Enim aut est omnis e\",\"crop_condition\":\"Et ea quo voluptas e\",\"field_spacing\":\"In ex asperiores nes\",\"estimated_yield\":null,\"signature\":\"Ad eum qui corrupti\",\"field_decision\":\"accepted\",\"remarks\":\"Nemo accusantium mol\",\"_token\":\"cpcGNbcKcYAEr8DaO1mGXNUMUmEEGnEOr4D8CJst\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-11 10:11:26', '2023-07-11 10:11:26'),
(3395, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:11:26', '2023-07-11 10:11:26'),
(3396, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:11:28', '2023-07-11 10:11:28'),
(3397, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:12:23', '2023-07-11 10:12:23'),
(3398, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:13:28', '2023-07-11 10:13:28'),
(3399, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:13:30', '2023-07-11 10:13:30'),
(3400, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:18:49', '2023-07-11 10:18:49'),
(3401, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:20:31', '2023-07-11 10:20:31'),
(3402, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:22:00', '2023-07-11 10:22:00'),
(3403, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:23:01', '2023-07-11 10:23:01'),
(3404, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:24:17', '2023-07-11 10:24:17'),
(3405, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:29:30', '2023-07-11 10:29:30'),
(3406, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:29:55', '2023-07-11 10:29:55'),
(3407, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:30:12', '2023-07-11 10:30:12'),
(3408, 49, 'admin/field-inspections/2/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:30:31', '2023-07-11 10:30:31'),
(3409, 49, 'admin/field-inspections/2', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"field_size\":null,\"type_of_inspection\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"signature\":null,\"field_decision\":\"accepted\",\"remarks\":\"asas\",\"_token\":\"cpcGNbcKcYAEr8DaO1mGXNUMUmEEGnEOr4D8CJst\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-11 10:30:36', '2023-07-11 10:30:36'),
(3410, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:30:37', '2023-07-11 10:30:37'),
(3411, 49, 'admin/field-inspections/3/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:31:08', '2023-07-11 10:31:08'),
(3412, 49, 'admin/field-inspections/3', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"field_size\":null,\"type_of_inspection\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"signature\":null,\"field_decision\":\"accepted\",\"remarks\":null,\"_token\":\"cpcGNbcKcYAEr8DaO1mGXNUMUmEEGnEOr4D8CJst\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-11 10:31:32', '2023-07-11 10:31:32'),
(3413, 49, 'admin/field-inspections/3/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:31:32', '2023-07-11 10:31:32'),
(3414, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:31:35', '2023-07-11 10:31:35'),
(3415, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:32:49', '2023-07-11 10:32:49'),
(3416, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:34:24', '2023-07-11 10:34:24'),
(3417, 49, 'admin/field-inspections/3/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:34:27', '2023-07-11 10:34:27'),
(3418, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:34:37', '2023-07-11 10:34:37'),
(3419, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:34:38', '2023-07-11 10:34:38'),
(3420, 49, 'admin/field-inspections/3', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":null,\"field_size\":null,\"type_of_inspection\":null,\"seed_generation\":null,\"crop_condition\":null,\"field_spacing\":null,\"estimated_yield\":null,\"signature\":null,\"field_decision\":\"accepted\",\"remarks\":\"1as\",\"_token\":\"cpcGNbcKcYAEr8DaO1mGXNUMUmEEGnEOr4D8CJst\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/field-inspections\"}', '2023-07-11 10:34:46', '2023-07-11 10:34:46'),
(3421, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:34:46', '2023-07-11 10:34:46'),
(3422, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 10:34:50', '2023-07-11 10:34:50'),
(3423, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:35:20', '2023-07-11 10:35:20'),
(3424, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:36:39', '2023-07-11 10:36:39'),
(3425, 49, 'admin/field-inspections/1/edit', 'GET', '127.0.0.1', '[]', '2023-07-11 10:37:02', '2023-07-11 10:37:02'),
(3426, 49, 'admin/field-inspections/1', 'PUT', '127.0.0.1', '{\"field_inspection_form_number\":\"36\",\"field_size\":null,\"type_of_inspection\":\"Nostrud incidunt es\",\"seed_generation\":\"Enim aut est omnis e\",\"crop_condition\":\"Et ea quo voluptas e\",\"field_spacing\":\"In ex asperiores nes\",\"estimated_yield\":null,\"signature\":\"Ad eum qui corrupti\",\"field_decision\":\"rejected\",\"remarks\":\"Nemo\",\"_token\":\"cpcGNbcKcYAEr8DaO1mGXNUMUmEEGnEOr4D8CJst\",\"_method\":\"PUT\"}', '2023-07-11 10:37:16', '2023-07-11 10:37:16'),
(3427, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:37:16', '2023-07-11 10:37:16'),
(3428, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 10:37:20', '2023-07-11 10:37:20'),
(3429, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 10:37:22', '2023-07-11 10:37:22'),
(3430, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:38:18', '2023-07-11 10:38:18'),
(3431, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:39:00', '2023-07-11 10:39:00'),
(3432, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:39:15', '2023-07-11 10:39:15'),
(3433, 49, 'admin/field-inspections', 'GET', '127.0.0.1', '[]', '2023-07-11 10:39:17', '2023-07-11 10:39:17'),
(3434, 1, 'admin/crop-declarations', 'GET', '127.0.0.1', '[]', '2023-07-11 10:39:22', '2023-07-11 10:39:22'),
(3435, 1, 'admin/field-inspections', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:39:33', '2023-07-11 10:39:33'),
(3436, 1, 'admin/seed-producers', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 10:39:42', '2023-07-11 10:39:42'),
(3437, 49, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2023-07-11 12:10:22', '2023-07-11 12:10:22'),
(3438, 49, 'admin/auth/menu/21/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2023-07-11 12:10:28', '2023-07-11 12:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL),
(6, 'Admin helpers', 'ext.helpers', '', '/helpers/*', '2023-05-19 04:56:45', '2023-05-19 04:56:45'),
(7, 'Api tester', 'ext.api-tester', '', '/api-tester*', '2023-05-19 05:05:37', '2023-05-19 05:05:37'),
(8, 'Scheduling', 'ext.scheduling', '', '/scheduling*', '2023-05-19 05:10:00', '2023-05-19 05:10:00'),
(9, 'Logs', 'ext.log-viewer', '', '/logs*', '2023-05-19 05:15:08', '2023-05-19 05:15:08'),
(10, 'Seed Producers', 'seed producers', '', '/seed-producers*', '2023-07-05 10:18:58', '2023-07-05 10:23:51'),
(11, 'Crop Declaration', 'crop declaration', '', '/crop-declarations*', '2023-07-08 07:33:04', '2023-07-08 07:33:04'),
(12, 'Load stock', 'load stock', '', '/load-stocks*', '2023-07-10 07:59:11', '2023-07-10 07:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'developer', '2023-05-11 08:52:17', '2023-05-19 10:02:19'),
(2, 'Commissioner', 'commissioner', '2023-05-19 10:03:37', '2023-07-11 05:25:49'),
(3, 'Basic User', 'basic-user', '2023-06-22 10:09:54', '2023-06-22 10:09:54'),
(4, 'Inspector', 'inspector', '2023-07-04 09:01:18', '2023-07-04 09:01:18'),
(5, 'Seed grower', 'grower', '2023-07-11 06:26:13', '2023-07-11 06:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(2, 20, NULL, NULL),
(3, 20, NULL, NULL),
(1, 20, NULL, NULL),
(2, 38, NULL, NULL),
(3, 38, NULL, NULL),
(1, 38, NULL, NULL),
(2, 22, NULL, NULL),
(1, 22, NULL, NULL),
(2, 41, NULL, NULL),
(3, 41, NULL, NULL),
(1, 41, NULL, NULL),
(2, 40, NULL, NULL),
(3, 40, NULL, NULL),
(1, 40, NULL, NULL),
(2, 37, NULL, NULL),
(3, 37, NULL, NULL),
(1, 37, NULL, NULL),
(2, 36, NULL, NULL),
(3, 36, NULL, NULL),
(1, 36, NULL, NULL),
(2, 34, NULL, NULL),
(3, 34, NULL, NULL),
(1, 34, NULL, NULL),
(2, 33, NULL, NULL),
(3, 33, NULL, NULL),
(1, 33, NULL, NULL),
(2, 31, NULL, NULL),
(3, 31, NULL, NULL),
(1, 31, NULL, NULL),
(2, 30, NULL, NULL),
(3, 30, NULL, NULL),
(1, 30, NULL, NULL),
(2, 28, NULL, NULL),
(3, 28, NULL, NULL),
(1, 28, NULL, NULL),
(2, 21, NULL, NULL),
(3, 21, NULL, NULL),
(1, 21, NULL, NULL),
(2, 43, NULL, NULL),
(3, 43, NULL, NULL),
(1, 43, NULL, NULL),
(4, 20, NULL, NULL),
(4, 28, NULL, NULL),
(4, 30, NULL, NULL),
(4, 31, NULL, NULL),
(4, 36, NULL, NULL),
(5, 20, NULL, NULL),
(5, 21, NULL, NULL),
(2, 47, NULL, NULL),
(5, 47, NULL, NULL),
(2, 48, NULL, NULL),
(4, 48, NULL, NULL),
(5, 48, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(1, 5, NULL, NULL),
(1, 6, NULL, NULL),
(1, 7, NULL, NULL),
(1, 8, NULL, NULL),
(1, 9, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(3, 2, NULL, NULL),
(3, 3, NULL, NULL),
(3, 4, NULL, NULL),
(4, 2, NULL, NULL),
(4, 3, NULL, NULL),
(4, 4, NULL, NULL),
(3, 5, NULL, NULL),
(4, 10, NULL, NULL),
(3, 10, NULL, NULL),
(3, 11, NULL, NULL),
(3, 12, NULL, NULL),
(4, 11, NULL, NULL),
(4, 12, NULL, NULL),
(2, 10, NULL, NULL),
(2, 11, NULL, NULL),
(2, 12, NULL, NULL),
(5, 1, NULL, NULL),
(5, 2, NULL, NULL),
(5, 3, NULL, NULL),
(5, 4, NULL, NULL),
(5, 5, NULL, NULL),
(5, 6, NULL, NULL),
(5, 7, NULL, NULL),
(5, 8, NULL, NULL),
(5, 9, NULL, NULL),
(5, 10, NULL, NULL),
(5, 11, NULL, NULL),
(5, 12, NULL, NULL),
(4, 1, NULL, NULL),
(4, 5, NULL, NULL),
(4, 6, NULL, NULL),
(4, 7, NULL, NULL),
(4, 8, NULL, NULL),
(4, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`, `id`) VALUES
(1, 1, NULL, NULL, 1),
(1, 4, NULL, NULL, 2),
(2, 47, NULL, NULL, 3),
(4, 49, NULL, NULL, 5),
(2, 1, NULL, NULL, 6),
(5, 48, '2023-07-11 06:40:48', '2023-07-11 06:40:48', 11),
(3, 50, NULL, NULL, 12),
(5, 50, '2023-07-11 11:40:17', '2023-07-11 11:40:17', 13),
(3, 51, NULL, NULL, 14),
(5, 51, '2023-07-11 11:43:18', '2023-07-11 11:43:18', 15),
(3, 52, NULL, NULL, 16),
(5, 52, '2023-07-11 11:44:45', '2023-07-11 11:44:45', 17),
(3, 53, NULL, NULL, 18),
(5, 53, '2023-07-11 11:45:46', '2023-07-11 11:45:46', 19),
(3, 54, NULL, NULL, 20),
(5, 54, '2023-07-11 11:46:16', '2023-07-11 11:46:16', 21),
(3, 55, NULL, NULL, 22),
(5, 55, '2023-07-11 11:46:54', '2023-07-11 11:46:54', 23),
(3, 56, NULL, NULL, 24),
(5, 56, '2023-07-11 11:47:42', '2023-07-11 11:47:42', 25),
(3, 57, NULL, NULL, 26),
(5, 57, '2023-07-11 11:48:10', '2023-07-11 11:48:10', 27),
(3, 58, NULL, NULL, 28),
(5, 58, '2023-07-11 11:48:48', '2023-07-11 11:48:48', 29),
(3, 59, NULL, NULL, 30),
(5, 59, '2023-07-11 11:50:43', '2023-07-11 11:50:43', 31),
(3, 60, NULL, NULL, 32),
(5, 60, '2023-07-11 11:51:23', '2023-07-11 11:51:23', 33),
(3, 61, NULL, NULL, 34),
(5, 61, '2023-07-11 11:52:09', '2023-07-11 11:52:09', 35),
(3, 62, NULL, NULL, 36),
(5, 62, '2023-07-11 11:52:47', '2023-07-11 11:52:47', 37);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`, `email`) VALUES
(1, '', '', 'admin', '$2y$10$BOjyoibuKryFHhhAWkEaMuC8tyBTQmxnZNBVoCgYUc9KvLW43YfB2', 'Administrator', 'images/user.jpg', NULL, '2023-05-11 08:52:16', '2023-06-22 06:02:20', NULL),
(47, NULL, NULL, 'commissioner', '$2y$10$DoH1HIqDmlCI8rr5uh6HBu4a2JBQe6chB7XdSrfTXelVB1OVINVo6', 'Briar Russell', 'images/house.jpg', NULL, '2023-07-05 10:10:00', '2023-07-05 10:10:00', 'amokolpriscilla@gmail.com'),
(48, NULL, NULL, 'basic-user', '$2y$10$.hADKX2jLtUIYMv8HaqKcuG1uDdcXcj5299fHYKjo0ktiW94EI00q', 'Tamekah Carter', 'images/default.png', 'M0tPA6xKUwLEUnMmmW12PEkMVZyc3uwMnNxyiRhpmvEQyq1sP6X6QAN2hzMZ', '2023-07-05 10:11:22', '2023-07-05 10:11:22', 'amokolpriscilla@gmail.com'),
(49, NULL, NULL, 'inspector', '$2y$10$e9nEQQllPOVeqAaJ.MoPGeWPboskst52FENNWelSadpAYyPAszqPi', 'Bertha Lucas', NULL, 'QYiCgFP03wYcLbmcXCuSHOaSI7ZBvpn29Tc5NH5b9A9IXvX7mvDYfElhZdc6', '2023-07-05 10:12:51', '2023-07-05 10:12:51', 'amokolpriscilla@gmail.com'),
(50, NULL, NULL, 'api@gmail.com', '$2y$10$lwHXFlFL7uecBQL2oYRNF.k5844gFcbyywZJOeluMSGo05bDFC6.m', 'API Test User', NULL, NULL, '2023-07-11 11:40:17', '2023-07-11 11:40:17', 'api@gmail.com'),
(51, NULL, NULL, 'api1@gmail.com', '$2y$10$tvUD5fHGWdtiuGmGkD5Jne8cc20eAjaVRYAkgKfWSa6CSMYtnw3gG', 'API Test User', NULL, NULL, '2023-07-11 11:43:18', '2023-07-11 11:43:18', 'api1@gmail.com'),
(52, NULL, NULL, 'api3@gmail.com', '$2y$10$vvWRpKK96umS6aBEX38wrOpoigOoIMgkzYDCdJaqCfsc5a/UqFzFq', 'API Test User', NULL, NULL, '2023-07-11 11:44:45', '2023-07-11 11:44:45', 'api3@gmail.com'),
(53, NULL, NULL, 'api3@gmail.com1', '$2y$10$S/I1iM3cF6nrsSWIQ/FR/e/BjZsi3Y78gdqbBi5C.Jdk2BmQ40TsO', 'API Test User', NULL, NULL, '2023-07-11 11:45:46', '2023-07-11 11:45:46', 'api3@gmail.com1'),
(54, NULL, NULL, 'api3@gmail.com1s', '$2y$10$C8qa1nUzEmyyZOPiEdWzqujMpIjwf2KefzuXL8mNjEb3LUGwuTqVG', 'API Test User', NULL, NULL, '2023-07-11 11:46:16', '2023-07-11 11:46:16', 'api3@gmail.com1s'),
(55, NULL, NULL, 'api3@gmail.com1sa', '$2y$10$V4CDGjeeiiBNED8OZU/j9uWh1rGpRV/RJZlD4ygdZyLPV87xRCVm.', 'API Test User', NULL, NULL, '2023-07-11 11:46:54', '2023-07-11 11:46:54', 'api3@gmail.com1sa'),
(56, NULL, NULL, 'api3@gmail.com1sa1', '$2y$10$AFZ10IrSGA0L3OAt4oIPbeiHyZdIpgHcL9v2PqbHrFXfq6OYDC3T2', 'API Test User 1', NULL, NULL, '2023-07-11 11:47:41', '2023-07-11 11:47:41', 'api3@gmail.com1sa1'),
(57, NULL, NULL, 'api3@gmail.com1sa1a', '$2y$10$XL99yoBmvTo8mnQOGyN1qudTO5yar8AyKa9vhAX4qlPCK6pAxgZMe', 'API Test User 1', NULL, NULL, '2023-07-11 11:48:10', '2023-07-11 11:48:10', 'api3@gmail.com1sa1a'),
(58, NULL, NULL, 'api3@gmail.co1', '$2y$10$nZuVOM8hexulxOYer/W96e5C0tDef2iwzlqX7CPmWozjYQ9fihjYq', 'API Test User 1', NULL, NULL, '2023-07-11 11:48:48', '2023-07-11 11:48:48', 'api3@gmail.co1'),
(59, NULL, NULL, 'api3@gmail.com4', '$2y$10$QanDBTc3/12huaxgEkC93OE03ZEZSSmlW.OlvXcoKfLuUa/qBdDAa', 'API Test User 1', NULL, NULL, '2023-07-11 11:50:43', '2023-07-11 11:50:43', 'api3@gmail.com4'),
(60, NULL, NULL, 'api3@gmail.com4a', '$2y$10$CccYioVGne4lnU87m.rsQ.czV3qaIIHXleLg6a4KSOCrMkYexFqye', 'API Test User 1', NULL, NULL, '2023-07-11 11:51:23', '2023-07-11 11:51:23', 'api3@gmail.com4a'),
(61, NULL, NULL, 'api3@gmail.com4aq', '$2y$10$sKt/zINiqMKIPhS0gPa8juWpEaaGlITXtyzVq.70DBO9hVVE.rvW6', 'API Test User 1', NULL, NULL, '2023-07-11 11:52:09', '2023-07-11 11:52:09', 'api3@gmail.com4aq'),
(62, NULL, NULL, 'api3@gmail.com4aqa', '$2y$10$vKPuhc4FfjVyrnR8eSo0QOZ8jYhagg5BuQ0hhZxxhjs50vqKKDKeG', 'API Test User 1', NULL, NULL, '2023-07-11 11:52:47', '2023-07-11 11:52:47', 'api3@gmail.com4aqa');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user_permissions`
--

INSERT INTO `admin_user_permissions` (`user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, NULL),
(1, 1, NULL, NULL),
(47, 3, NULL, NULL),
(47, 4, NULL, NULL),
(47, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agro_dealers`
--

CREATE TABLE `agro_dealers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agro_dealer_reg_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town_plot_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dealers_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_in_operation` int(10) UNSIGNED NOT NULL,
  `business_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trading_license_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachments_certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agro_dealer_agreements`
--

CREATE TABLE `agro_dealer_agreements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agro_dealer_agreement_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreement_effective_date` date NOT NULL,
  `date_of_agreement` date NOT NULL,
  `signed_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agreement_term_or_duration` int(11) NOT NULL,
  `termination_clauses_and_conditions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `confidentiality_obligations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `non_disclosure_agreements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification_forms`
--

CREATE TABLE `certification_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicants_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicants_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certification_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity_period` date NOT NULL,
  `application_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assessment_evaluation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supporting_documents` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `declaration_agreement` tinyint(1) NOT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cooperatives`
--

CREATE TABLE `cooperatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cooperative_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooperative_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cooperative_physical_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_to_members` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectives_or_goals` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `crop_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_code` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_days_before_submission` int(11) NOT NULL,
  `seed_viability_period` int(11) DEFAULT NULL,
  `number_of_inspections` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `created_at`, `updated_at`, `crop_name`, `crop_code`, `number_of_days_before_submission`, `seed_viability_period`, `number_of_inspections`) VALUES
(10, '2023-07-08 16:38:45', '2023-07-11 07:43:26', 'Maize', NULL, 413, NULL, 4),
(11, '2023-07-08 16:39:27', '2023-07-11 07:44:27', 'Beans', NULL, 352, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `crop_declarations`
--

CREATE TABLE `crop_declarations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seed_producer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `garden_size` decimal(8,2) DEFAULT NULL,
  `gps_coordinates_1` decimal(10,6) DEFAULT NULL,
  `gps_coordinates_2` decimal(10,6) DEFAULT NULL,
  `gps_coordinates_3` decimal(10,6) DEFAULT NULL,
  `gps_coordinates_4` decimal(10,6) DEFAULT NULL,
  `field_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `circle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `township` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planting_date` date DEFAULT NULL,
  `quantity_of_seed_planted` int(11) DEFAULT NULL,
  `expected_yield` int(11) DEFAULT NULL,
  `seed_supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seed_supplier_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_lot_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin_of_variety` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garden_location_latitude` decimal(10,6) DEFAULT NULL,
  `garden_location_longitude` decimal(10,6) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `inspector_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lot_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `crop_variety_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crop_declarations`
--

INSERT INTO `crop_declarations` (`id`, `applicant_id`, `phone_number`, `applicant_registration_number`, `seed_producer_id`, `garden_size`, `gps_coordinates_1`, `gps_coordinates_2`, `gps_coordinates_3`, `gps_coordinates_4`, `field_name`, `district_region`, `circle`, `township`, `village`, `planting_date`, `quantity_of_seed_planted`, `expected_yield`, `seed_supplier_name`, `seed_supplier_registration_number`, `source_lot_number`, `origin_of_variety`, `garden_location_latitude`, `garden_location_longitude`, `status`, `inspector_id`, `lot_number`, `remarks`, `created_at`, `updated_at`, `crop_variety_id`) VALUES
(9, 48, '413', '473', 36, NULL, NULL, NULL, NULL, NULL, 'Yoshi Ferguson', 'Minus et exercitatio', 'Eveniet quam offici', 'Autem harum culpa v', 'Lorem aliquam est ni', '2023-07-11', 306, 0, 'Yetta Oneill', '688', '835', 'Voluptatibus laboris', NULL, NULL, 'rejected', 49, NULL, 'sometest', '2023-07-11 07:54:57', '2023-07-11 10:39:01', 6);

-- --------------------------------------------------------

--
-- Table structure for table `crop_inspection_type`
--

CREATE TABLE `crop_inspection_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `inspection_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crop_inspection_type`
--

INSERT INTO `crop_inspection_type` (`id`, `crop_id`, `inspection_type_id`, `created_at`, `updated_at`) VALUES
(1, 10, 2, NULL, NULL),
(2, 10, 3, NULL, NULL),
(3, 10, 1, NULL, NULL),
(4, 11, 2, NULL, NULL),
(5, 11, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crop_seed_producers`
--

CREATE TABLE `crop_seed_producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `seed_producer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crop_varieties`
--

CREATE TABLE `crop_varieties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_id` bigint(20) UNSIGNED NOT NULL,
  `crop_variety_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_variety_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_variety_generation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crop_varieties`
--

INSERT INTO `crop_varieties` (`id`, `crop_id`, `crop_variety_name`, `crop_variety_code`, `crop_variety_generation`, `created_at`, `updated_at`) VALUES
(6, 10, 'Chadwick Pierce maize', 'Ut enim aliquam cupi', 'Quia consequatur co', '2023-07-08 16:38:45', '2023-07-08 16:38:45'),
(7, 10, 'Audra Daugherty maize', 'Eos quis exercitati', 'Quis consequuntur de', '2023-07-08 16:38:45', '2023-07-08 16:38:45'),
(8, 10, 'Cleo Knox maize', 'Tempora quia nobis a', 'Sit voluptatem liber', '2023-07-08 16:38:45', '2023-07-08 16:38:45'),
(9, 11, 'Thomas Downs Beans', 'Rerum iure illo omni', 'Aut assumenda non fu', '2023-07-08 16:39:27', '2023-07-08 16:39:27'),
(10, 11, 'Audrey Kline Beans', 'Dicta in dolore sunt', 'Ullamco voluptatem', '2023-07-08 16:39:27', '2023-07-08 16:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `crop_variety_crop_declaration`
--

CREATE TABLE `crop_variety_crop_declaration` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_variety_id` bigint(20) UNSIGNED NOT NULL,
  `crop_declaration_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crop_variety_inspection_type`
--

CREATE TABLE `crop_variety_inspection_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crop_variety_id` bigint(20) UNSIGNED NOT NULL,
  `inspection_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_inspections`
--

CREATE TABLE `field_inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field_inspection_form_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crop_declaration_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crop_variety_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inspection_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `applicant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_inspection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_size` double(8,2) UNSIGNED DEFAULT NULL,
  `seed_generation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crop_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_spacing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_yield` double(8,2) UNSIGNED DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspector_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_decision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `is_done` int(11) DEFAULT NULL,
  `inspection_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_number` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field_inspections`
--

INSERT INTO `field_inspections` (`id`, `field_inspection_form_number`, `crop_declaration_id`, `crop_variety_id`, `inspection_type_id`, `applicant_id`, `physical_address`, `type_of_inspection`, `field_size`, `seed_generation`, `crop_condition`, `field_spacing`, `estimated_yield`, `remarks`, `inspector_id`, `signature`, `field_decision`, `is_active`, `is_done`, `inspection_date`, `created_at`, `updated_at`, `order_number`) VALUES
(1, '36', '9', 6, 1, '48', 'Lorem aliquam est ni', 'Nostrud incidunt es', NULL, 'Enim aut est omnis e', 'Et ea quo voluptas e', 'In ex asperiores nes', NULL, 'Nemo', '49', 'Ad eum qui corrupti', 'rejected', 0, 1, '2023-08-20', '2023-07-11 09:50:44', '2023-07-11 10:37:16', 1),
(2, NULL, '9', 6, 2, '48', 'Lorem aliquam est ni', NULL, NULL, NULL, NULL, NULL, NULL, 'asas', '49', NULL, 'accepted', 0, 1, '2023-08-30', '2023-07-11 09:50:44', '2023-07-11 10:30:36', 2),
(3, NULL, '9', 6, 3, '48', 'Lorem aliquam est ni', NULL, NULL, NULL, NULL, NULL, NULL, '1as', '49', NULL, 'rejected', 0, 0, '2023-08-10', '2023-07-11 09:50:44', '2023-07-11 10:39:01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_types`
--

CREATE TABLE `inspection_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inspection_type_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `period_after_planting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inspection_types`
--

INSERT INTO `inspection_types` (`id`, `inspection_type_name`, `order`, `period_after_planting`, `created_at`, `updated_at`, `crop_id`) VALUES
(1, 'Pre-flowering', 1, 40, '2023-07-08 12:36:00', '2023-07-11 08:48:58', 10),
(2, 'Flowering', 2, 50, '2023-07-08 12:36:18', '2023-07-11 08:49:07', 10),
(3, 'Pre-harvest', 3, 30, '2023-07-08 12:36:36', '2023-07-11 08:49:18', 10),
(4, 'Pre-flowring', 1, 30, '2023-07-11 08:56:39', '2023-07-11 08:56:39', 11),
(5, 'Flowerin', 2, 40, '2023-07-11 08:56:39', '2023-07-11 08:56:39', 11),
(6, 'Pre-harvesting', 3, 50, '2023-07-11 08:56:39', '2023-07-11 08:56:39', 11);

-- --------------------------------------------------------

--
-- Table structure for table `load_stocks`
--

CREATE TABLE `load_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `load_stock_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planting_return_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_id` int(255) NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_size` double(8,2) UNSIGNED NOT NULL COMMENT 'In Acres',
  `yield_quantity` double(8,2) UNSIGNED NOT NULL,
  `last_field_inspection_date` date NOT NULL,
  `load_stock_date` date NOT NULL,
  `last_field_inspection_remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `load_stocks`
--

INSERT INTO `load_stocks` (`id`, `load_stock_number`, `planting_return_number`, `applicant_id`, `registration_number`, `seed_class`, `field_size`, `yield_quantity`, `last_field_inspection_date`, `load_stock_date`, `last_field_inspection_remarks`, `valid_from`, `valid_until`, `created_at`, `updated_at`, `status`) VALUES
(1, '385', '171', 48, '57', 'Perspiciatis fugiat', 22.00, 174.00, '1988-03-12', '2023-02-04', 'Sit nisi distinctio', NULL, NULL, '2023-07-10 08:10:02', '2023-07-10 08:10:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_01_04_173148_create_admin_tables', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_06_21_082619_create_seed_producers_table', 2),
(11, '2023_06_21_093712_create_crops_table', 3),
(16, '2023_06_21_104856_create_crop_seed_producers_table', 7),
(18, '2023_06_21_135121_create_qds_producers_table', 8),
(19, '2023_06_21_140233_create_cooperatives_table', 9),
(20, '2023_06_21_140916_create_planting_returns_table', 10),
(21, '2023_06_21_141516_create_out_grower_contracts_table', 11),
(22, '2023_06_21_141922_create_load_stocks_table', 12),
(23, '2023_06_21_142437_create_seed_labels_table', 13),
(24, '2023_06_21_143257_create_agro_dealers_table', 14),
(26, '2023_06_21_144545_create_seed_lab_test_reports_table', 16),
(27, '2023_06_21_144933_create_certification_forms_table', 17),
(28, '2023_06_21_145258_create_agro_dealer_agreements_table', 18),
(29, '2023_06_21_145631_create_pre_orders_table', 19),
(30, '2023_06_22_133436_create_seed_sampling_requests_table', 20),
(31, '2023_07_05_144311_create_notifications_table', 21),
(32, '2023_06_21_094229_create_crop_varieties_table', 22),
(33, '2023_07_08_031444_create_crop_declarations_table', 23),
(34, '2023_07_08_073537_create_crop_variety_crop_declaration_table', 23),
(35, '2023_07_08_081647_create_inspection_types_table', 23),
(38, '2023_07_08_180750_create_crop_variety_inspection_type_table', 24),
(39, '2023_07_08_180819_create_crop_inspection_type_table', 24),
(41, '2023_06_21_143952_create_field_inspections_table', 25),
(42, '2023_07_10_071517_create_seed_classes_table', 26),
(43, '2023_07_10_104332_create_track_and_traces_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `created_at`, `updated_at`, `receiver_id`, `role_id`, `message`, `form_link`, `link`, `status`, `model`, `model_id`) VALUES
(57, '2023-07-09 09:15:40', '2023-07-09 09:15:40', 49, NULL, 'Dear Bertha Lucas, you have been assigned to inspect crop-declarations.', 'http://127.0.0.1:8000/admin/crop-declarations/2', 'http://127.0.0.1:8000/admin/auth/login', 'Unread', 'CropDeclaration', '2'),
(68, '2023-07-11 09:29:16', '2023-07-11 09:29:16', NULL, 2, 'Administrator has applied for a {$entity} ', 'http://127.0.0.1:8000/admin/edit/11', 'http://127.0.0.1:8000/admin/auth/login', 'Unread', 'FieldInspection', '11');

-- --------------------------------------------------------

--
-- Table structure for table `out_grower_contracts`
--

CREATE TABLE `out_grower_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_company_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `out_grower_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `out_grower_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_county` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plot_number` int(11) NOT NULL,
  `contract_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `out_grower_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('juhecok@mailinator.com', '$2y$10$hU1yjCqk9jGa7KRw6vXG1etW4tJm5UvtA7zB4pWCiv1oFz3z1TyNy', '2023-05-12 07:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pre_orders`
--

CREATE TABLE `pre_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variety` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `preferred_delivery_date` date DEFAULT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_physical_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seed_delivery_preferences` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qds_producers`
--

CREATE TABLE `qds_producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qds_producer_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_of_applicant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_physical_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years_of_experience` bigint(20) UNSIGNED NOT NULL,
  `crop_and_variety_experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_of` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_adequate_land` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_adequate_storage` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_adequate_equipment` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_contractual_agreement` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_field_officers` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_knowledgeable_personnel` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_size` int(11) NOT NULL,
  `quality_control_mechanisms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seed_classes`
--

CREATE TABLE `seed_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seed_labels`
--

CREATE TABLE `seed_labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seed_label_request_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_lab_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_packages` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_of_seed` double(8,2) UNSIGNED NOT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_date` date NOT NULL,
  `applicant_remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seed_lab_test_reports`
--

CREATE TABLE `seed_lab_test_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seed_lab_test_report_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_sample_request_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planting_return_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seed_sample_size` double(8,2) UNSIGNED NOT NULL,
  `testing_methods` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `germination_test_results` double(8,2) UNSIGNED NOT NULL,
  `purity_test_results` double(8,2) UNSIGNED NOT NULL,
  `moisture_content_test_results` double(8,2) UNSIGNED NOT NULL,
  `additional_tests_results` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_decision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_and_signature` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seed_producers`
--

CREATE TABLE `seed_producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `producer_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producer_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_applicant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premises_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposed_farm_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years_of_experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gardening_history_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_facilities_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_adequate_isolation` tinyint(4) DEFAULT NULL,
  `labor_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `status_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inspector_id` int(25) DEFAULT NULL,
  `grower_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_from` timestamp NULL DEFAULT NULL,
  `valid_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seed_producers`
--

INSERT INTO `seed_producers` (`id`, `user_id`, `producer_registration_number`, `producer_category`, `name_of_applicant`, `applicant_phone_number`, `applicant_email`, `premises_location`, `proposed_farm_location`, `years_of_experience`, `gardening_history_description`, `storage_facilities_description`, `have_adequate_isolation`, `labor_details`, `receipt`, `status`, `status_comment`, `inspector_id`, `grower_number`, `valid_from`, `valid_until`, `created_at`, `updated_at`) VALUES
(36, 48, '845', 'Individual-grower', 'Mona Finley', '+1 (492) 882-7817', 'vexyje@mailinator.com', 'Quia sint voluptas q', 'Aut tenetur animi e', '1986', 'Aliquip odio in sit', 'Soluta consectetur eaa', 1, 'Culpa nesciunt des', NULL, 'accepted', 'good', NULL, '37840', '2023-07-11 06:12:14', '2023-07-11 06:12:14', '2023-07-11 05:44:06', '2023-07-11 06:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `seed_sampling_requests`
--

CREATE TABLE `seed_sampling_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sample_request_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `load_stock_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_request_date` date NOT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicant_remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_and_traces`
--

CREATE TABLE `track_and_traces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`),
  ADD UNIQUE KEY `admin_permissions_slug_unique` (`slug`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`),
  ADD UNIQUE KEY `admin_roles_slug_unique` (`slug`);

--
-- Indexes for table `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- Indexes for table `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Indexes for table `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- Indexes for table `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- Indexes for table `agro_dealers`
--
ALTER TABLE `agro_dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agro_dealer_agreements`
--
ALTER TABLE `agro_dealer_agreements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certification_forms`
--
ALTER TABLE `certification_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cooperatives`
--
ALTER TABLE `cooperatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_declarations`
--
ALTER TABLE `crop_declarations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_declarations_seed_producer_id_foreign` (`seed_producer_id`);

--
-- Indexes for table `crop_inspection_type`
--
ALTER TABLE `crop_inspection_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_inspection_type_crop_id_foreign` (`crop_id`),
  ADD KEY `crop_inspection_type_inspection_type_id_foreign` (`inspection_type_id`);

--
-- Indexes for table `crop_seed_producers`
--
ALTER TABLE `crop_seed_producers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_seed_producers_crop_id_foreign` (`crop_id`),
  ADD KEY `crop_seed_producers_seed_producer_id_foreign` (`seed_producer_id`);

--
-- Indexes for table `crop_varieties`
--
ALTER TABLE `crop_varieties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_varieties_crop_id_foreign` (`crop_id`);

--
-- Indexes for table `crop_variety_crop_declaration`
--
ALTER TABLE `crop_variety_crop_declaration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_variety_crop_declaration_crop_variety_id_foreign` (`crop_variety_id`),
  ADD KEY `crop_variety_crop_declaration_crop_declaration_id_foreign` (`crop_declaration_id`);

--
-- Indexes for table `crop_variety_inspection_type`
--
ALTER TABLE `crop_variety_inspection_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_variety_inspection_type_crop_variety_id_foreign` (`crop_variety_id`),
  ADD KEY `crop_variety_inspection_type_inspection_type_id_foreign` (`inspection_type_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `field_inspections`
--
ALTER TABLE `field_inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_inspections_crop_variety_id_foreign` (`crop_variety_id`),
  ADD KEY `field_inspections_inspection_type_id_foreign` (`inspection_type_id`);

--
-- Indexes for table `inspection_types`
--
ALTER TABLE `inspection_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `load_stocks`
--
ALTER TABLE `load_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `out_grower_contracts`
--
ALTER TABLE `out_grower_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qds_producers`
--
ALTER TABLE `qds_producers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seed_classes`
--
ALTER TABLE `seed_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seed_labels`
--
ALTER TABLE `seed_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seed_lab_test_reports`
--
ALTER TABLE `seed_lab_test_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seed_producers`
--
ALTER TABLE `seed_producers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seed_sampling_requests`
--
ALTER TABLE `seed_sampling_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_and_traces`
--
ALTER TABLE `track_and_traces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3439;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_role_users`
--
ALTER TABLE `admin_role_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `agro_dealers`
--
ALTER TABLE `agro_dealers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agro_dealer_agreements`
--
ALTER TABLE `agro_dealer_agreements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certification_forms`
--
ALTER TABLE `certification_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cooperatives`
--
ALTER TABLE `cooperatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `crop_declarations`
--
ALTER TABLE `crop_declarations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `crop_inspection_type`
--
ALTER TABLE `crop_inspection_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crop_seed_producers`
--
ALTER TABLE `crop_seed_producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `crop_varieties`
--
ALTER TABLE `crop_varieties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crop_variety_crop_declaration`
--
ALTER TABLE `crop_variety_crop_declaration`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `crop_variety_inspection_type`
--
ALTER TABLE `crop_variety_inspection_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_inspections`
--
ALTER TABLE `field_inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inspection_types`
--
ALTER TABLE `inspection_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `load_stocks`
--
ALTER TABLE `load_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `out_grower_contracts`
--
ALTER TABLE `out_grower_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qds_producers`
--
ALTER TABLE `qds_producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seed_classes`
--
ALTER TABLE `seed_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seed_labels`
--
ALTER TABLE `seed_labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seed_lab_test_reports`
--
ALTER TABLE `seed_lab_test_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seed_producers`
--
ALTER TABLE `seed_producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `seed_sampling_requests`
--
ALTER TABLE `seed_sampling_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track_and_traces`
--
ALTER TABLE `track_and_traces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop_declarations`
--
ALTER TABLE `crop_declarations`
  ADD CONSTRAINT `crop_declarations_seed_producer_id_foreign` FOREIGN KEY (`seed_producer_id`) REFERENCES `seed_producers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_inspection_type`
--
ALTER TABLE `crop_inspection_type`
  ADD CONSTRAINT `crop_inspection_type_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_inspection_type_inspection_type_id_foreign` FOREIGN KEY (`inspection_type_id`) REFERENCES `inspection_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_seed_producers`
--
ALTER TABLE `crop_seed_producers`
  ADD CONSTRAINT `crop_seed_producers_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_seed_producers_seed_producer_id_foreign` FOREIGN KEY (`seed_producer_id`) REFERENCES `seed_producers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_varieties`
--
ALTER TABLE `crop_varieties`
  ADD CONSTRAINT `crop_varieties_crop_id_foreign` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_variety_crop_declaration`
--
ALTER TABLE `crop_variety_crop_declaration`
  ADD CONSTRAINT `crop_variety_crop_declaration_crop_declaration_id_foreign` FOREIGN KEY (`crop_declaration_id`) REFERENCES `crop_declarations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_variety_crop_declaration_crop_variety_id_foreign` FOREIGN KEY (`crop_variety_id`) REFERENCES `crop_varieties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crop_variety_inspection_type`
--
ALTER TABLE `crop_variety_inspection_type`
  ADD CONSTRAINT `crop_variety_inspection_type_crop_variety_id_foreign` FOREIGN KEY (`crop_variety_id`) REFERENCES `crop_varieties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crop_variety_inspection_type_inspection_type_id_foreign` FOREIGN KEY (`inspection_type_id`) REFERENCES `inspection_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `field_inspections`
--
ALTER TABLE `field_inspections`
  ADD CONSTRAINT `field_inspections_crop_variety_id_foreign` FOREIGN KEY (`crop_variety_id`) REFERENCES `crop_varieties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `field_inspections_inspection_type_id_foreign` FOREIGN KEY (`inspection_type_id`) REFERENCES `inspection_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
