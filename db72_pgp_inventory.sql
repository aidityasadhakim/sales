-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2020 at 09:50 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db72_pgp_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AC', '2020-03-31 05:30:29', '2020-03-31 05:30:49', NULL),
(2, 'Remote AC', '2020-03-31 05:58:27', NULL, NULL),
(3, 'TV', '2020-03-31 05:58:32', NULL, NULL),
(4, 'Remote TV', '2020-03-31 05:58:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1:developer, 2:owner',
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `type`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'DPU', 1, '2020-02-13 21:09:03', NULL, NULL),
(2, 1, 'Ipong', 1, '2020-02-13 21:10:15', NULL, NULL),
(3, 1, 'Aqil', 1, '2020-02-13 21:10:22', NULL, NULL),
(4, 1, 'Sari', 1, '2020-02-13 21:10:25', NULL, NULL),
(5, 1, 'Titik', 1, '2020-02-13 21:10:34', NULL, NULL),
(6, 1, 'Ratih', 1, '2020-02-13 21:10:38', NULL, NULL),
(7, 1, 'Rajiman', 1, '2020-02-13 21:10:45', NULL, NULL),
(8, 1, 'Amri', 1, '2020-02-13 21:11:05', NULL, NULL),
(9, 2, 'Imansyah', 1, '2020-02-13 21:11:13', NULL, NULL),
(10, 2, 'Tommy', 1, '2020-02-13 21:11:25', NULL, NULL),
(11, 2, 'Irwan', 1, '2020-02-13 21:11:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `tower_id` int(11) NOT NULL,
  `name` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1:developer, 2:owner',
  `owner_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `tower_id`, `name`, `type`, `owner_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 12, 'BC', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:50:47', NULL),
(6, 12, 'BI', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 14:10:20', NULL),
(8, 13, 'BN', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-09 09:17:05', NULL),
(9, 13, 'BC', 2, NULL, 1, '2020-03-30 17:01:05', '2020-01-26 08:49:29', NULL),
(11, 20, 'BC', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 02:44:43', NULL),
(13, 20, 'AF', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:49:09', NULL),
(14, 20, 'BH', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 15:09:08', NULL),
(15, 21, 'AI', 2, NULL, 1, '2020-03-30 17:01:05', '2020-03-03 02:48:30', NULL),
(16, 21, 'AG', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-12 14:29:37', NULL),
(17, 21, 'AB', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 09:53:08', NULL),
(19, 23, 'BC', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-15 15:07:29', NULL),
(20, 23, 'BG', 2, NULL, 1, '2020-02-13 05:23:11', '2020-02-13 06:23:11', NULL),
(21, 23, 'BF', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-01 02:08:47', NULL),
(23, 23, 'AI', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-06 04:13:29', NULL),
(24, 13, 'BT', 2, NULL, 1, '2020-03-30 17:01:05', '2019-11-15 07:39:16', NULL),
(26, 15, 'BP', 1, 1, 1, '2020-03-30 17:01:05', '2020-02-16 06:53:49', NULL),
(27, 15, 'BG', 1, NULL, 1, '2020-03-30 17:01:05', '2020-01-08 07:35:46', NULL),
(28, 16, 'BC', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:55:19', NULL),
(29, 16, 'BN', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 10:49:28', NULL),
(30, 16, 'BP', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-12 07:04:04', NULL),
(31, 16, 'BB', 1, NULL, 1, '2020-02-12 08:49:23', '2020-02-12 09:49:23', NULL),
(32, 16, 'BQ', 2, NULL, 1, '2020-03-30 17:01:05', '2020-01-07 02:08:54', NULL),
(33, 16, 'BT', 2, NULL, 1, '2020-03-30 17:01:05', '2019-11-20 11:47:41', NULL),
(34, 16, 'BS', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 11:46:31', NULL),
(35, 13, 'BL', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 06:23:34', NULL),
(36, 17, 'BA', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-12 08:32:59', NULL),
(37, 17, 'BP', 2, NULL, 1, '2020-02-12 08:50:35', '2020-02-12 09:50:35', NULL),
(38, 17, 'BS', 2, NULL, 1, '2020-02-07 23:10:54', '2020-02-08 00:10:54', NULL),
(39, 17, 'BR', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:48:33', NULL),
(40, 18, 'BG', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:53:26', NULL),
(41, 18, 'BI', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:49:53', NULL),
(42, 18, 'BJ', 1, NULL, 1, '2020-02-12 08:49:19', '2020-02-12 09:49:19', NULL),
(43, 18, 'BP', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 02:51:16', NULL),
(44, 13, 'BP', 1, NULL, 1, '2020-02-12 08:49:15', '2020-02-12 09:49:15', NULL),
(45, 13, 'BR', 2, NULL, 1, '2020-01-29 01:55:28', '2020-01-29 02:55:28', NULL),
(46, 18, 'BN', 1, NULL, 1, '2020-02-13 01:43:48', '2020-02-13 02:43:48', NULL),
(47, 16, 'BO', 1, NULL, 1, '2020-02-13 01:43:41', '2020-02-13 02:43:41', NULL),
(48, 17, 'BH', 2, NULL, 1, '2020-02-08 06:26:12', '2020-02-08 07:26:12', NULL),
(50, 19, 'BD', 1, NULL, 1, '2020-03-30 17:01:05', '2020-03-13 03:43:59', NULL),
(51, 19, 'BG', 1, NULL, 1, '2020-02-12 08:49:03', '2020-02-12 09:49:03', NULL),
(52, 23, 'BA', 1, NULL, 1, '2020-02-10 04:29:26', '2020-02-10 05:29:26', NULL),
(53, 15, 'BF', 2, NULL, 1, '2019-12-11 10:28:47', '2019-12-11 11:28:47', NULL),
(55, 15, 'BH', 1, NULL, 1, '2020-03-30 17:01:05', '2020-01-27 00:19:22', NULL),
(56, 22, 'AA', 2, 10, 1, '2020-02-13 21:33:28', '2020-02-13 21:33:28', NULL),
(57, 22, 'AC', 2, 10, 1, '2020-02-13 21:33:49', '2020-02-13 21:33:49', NULL),
(58, 23, 'AA', 2, NULL, 1, '2020-03-30 17:01:05', '2020-01-01 11:44:44', NULL),
(59, 13, 'BH', 1, NULL, 1, '2020-01-17 07:09:47', '2020-01-17 08:09:47', NULL),
(60, 13, 'BQ', 1, NULL, 1, '2020-03-30 17:01:05', '2020-01-24 08:28:30', NULL),
(62, 16, 'BH', 2, NULL, 1, '2020-03-30 17:01:05', '2019-11-21 07:27:25', NULL),
(66, 23, 'AG', 2, NULL, 1, '2020-02-12 08:49:46', '2020-02-12 09:49:46', NULL),
(68, 2, 'BF', 2, NULL, 1, '2020-02-10 06:02:55', '2020-02-10 07:02:55', NULL),
(69, 19, 'AG', 2, NULL, 1, '2019-12-12 04:06:25', '2019-12-12 05:06:25', NULL),
(70, 22, 'AF', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 14:19:37', NULL),
(72, 2, 'BD', 2, NULL, 1, '2020-01-24 06:24:10', '2020-01-24 07:24:10', NULL),
(73, 19, 'BI', 2, NULL, 1, '2020-02-12 08:49:40', '2020-02-12 09:49:40', NULL),
(74, 14, 'BR', 2, NULL, 1, '2020-01-29 03:28:06', '2020-01-29 04:28:06', NULL),
(75, 17, 'BF', 2, NULL, 1, '2020-02-10 04:27:07', '2020-02-10 05:27:07', NULL),
(76, 12, 'BA', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-15 15:09:28', NULL),
(77, 17, 'BT', 2, NULL, 1, '2020-02-13 05:22:38', '2020-02-13 06:22:38', NULL),
(78, 21, 'AA', 2, NULL, 1, '2020-02-04 10:05:40', '2020-02-04 11:05:40', NULL),
(79, 22, 'BA', 1, NULL, 1, '2020-02-10 04:29:05', '2020-02-10 05:29:05', NULL),
(81, 22, 'AH', 1, NULL, 1, '2020-02-10 04:28:51', '2020-02-10 05:28:51', NULL),
(82, 13, 'BE', 2, NULL, 1, '2019-11-02 05:22:51', '2019-11-02 06:22:51', NULL),
(86, 15, 'BM', 1, 1, 1, '2020-02-13 21:32:23', '2020-02-13 21:32:23', NULL),
(87, 12, 'BT', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 15:31:34', NULL),
(90, 16, 'BG', 1, NULL, 1, '2020-02-10 04:28:34', '2020-02-10 05:28:34', NULL),
(91, 16, 'BD', 1, NULL, 1, '2020-02-09 08:39:53', '2020-02-09 09:39:53', NULL),
(93, 13, 'BA', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 08:56:00', NULL),
(97, 22, 'BB', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-12 14:15:19', NULL),
(98, 21, 'BD', 1, NULL, 1, '2020-02-10 04:28:31', '2020-02-10 05:28:31', NULL),
(100, 22, 'BJ', 2, NULL, 1, '2020-01-04 06:20:08', '2020-01-04 07:20:08', NULL),
(101, 2, 'BA', 2, 11, 1, '2020-02-13 21:34:13', '2020-02-13 21:34:13', NULL),
(107, 20, 'AB', 1, NULL, 1, '2020-02-18 04:02:36', '2020-02-18 04:02:36', NULL),
(108, 17, 'BQ', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 05:04:04', NULL),
(110, 23, 'AE', 1, 2, 1, '2020-03-30 17:01:05', '2020-02-16 07:04:58', NULL),
(111, 22, 'AE', 1, NULL, 1, '2020-02-12 08:48:52', '2020-02-12 09:48:52', NULL),
(112, 22, 'BD', 1, NULL, 1, '2020-02-13 01:43:36', '2020-02-13 02:43:36', NULL),
(113, 22, 'BH', 1, NULL, 1, '2020-02-10 04:28:10', '2020-02-10 05:28:10', NULL),
(118, 21, 'BE', 1, NULL, 1, '2020-02-10 04:28:06', '2020-02-10 05:28:06', NULL),
(120, 21, 'AD', 1, NULL, 1, '2020-02-12 08:48:40', '2020-02-12 09:48:40', NULL),
(122, 18, 'BD', 1, NULL, 1, '2020-03-30 17:01:05', '2020-01-24 08:29:09', NULL),
(124, 15, 'BB', 1, NULL, 1, '2020-02-10 05:21:16', '2020-02-10 06:21:16', NULL),
(125, 15, 'BD', 1, NULL, 1, '2020-02-10 04:27:58', '2020-02-10 05:27:58', NULL),
(126, 12, 'BN', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-15 15:08:58', NULL),
(127, 17, 'BO', 1, NULL, 1, '2019-11-19 09:18:30', '0000-00-00 00:00:00', NULL),
(128, 22, 'AI', 1, 2, 1, '2020-02-13 21:33:04', '2020-02-13 21:33:04', NULL),
(129, 2, 'BB', 2, 11, 1, '2020-02-13 21:34:23', '2020-02-13 21:34:23', NULL),
(131, 13, 'BB', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-02 02:05:21', NULL),
(132, 21, 'BH', 1, NULL, 1, '2020-02-10 00:33:21', '2020-02-10 01:33:21', NULL),
(133, 22, 'AG', 2, NULL, 1, '2020-01-04 11:08:45', '2020-01-04 12:08:45', NULL),
(134, 2, 'BJ', 2, NULL, 1, '2020-03-30 17:01:05', '2020-02-13 02:50:53', NULL),
(135, 15, 'BE', 1, NULL, 1, '2020-03-30 17:01:05', '2020-02-15 15:02:57', NULL),
(136, 15, 'BO', 1, NULL, 1, '2020-02-10 00:33:13', '2020-02-10 01:33:13', NULL),
(137, 17, 'BC', 1, NULL, 1, '2020-02-10 00:33:06', '2020-02-10 01:33:06', NULL),
(138, 15, 'BA', 1, NULL, 1, '2020-02-12 04:18:34', '2020-02-12 05:18:34', NULL),
(139, 15, 'BI', 1, NULL, 1, '2020-02-10 00:33:00', '2020-02-10 01:33:00', NULL),
(141, 21, 'BF', 1, NULL, 1, '2020-02-10 00:32:57', '2020-02-10 01:32:57', NULL),
(142, 17, 'BE', 1, NULL, 1, '2020-02-10 00:32:53', '2020-02-10 01:32:53', NULL),
(145, 20, 'BA', 2, NULL, 1, '2020-03-30 17:01:05', '2020-01-18 11:20:47', NULL),
(146, 22, 'BF', 1, NULL, 1, '2020-02-12 08:48:37', '2020-02-12 09:48:37', NULL),
(150, 15, 'BS', 1, NULL, 1, '2020-02-10 00:32:49', '2020-02-10 01:32:49', NULL),
(153, 19, 'AF', 1, 1, 1, '2020-03-31 06:03:04', '2020-03-31 06:03:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `towers`
--

CREATE TABLE `towers` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towers`
--

INSERT INTO `towers` (`id`, `parent_id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, '4', 1, '2019-06-06 05:37:19', '2019-06-05 22:37:19', NULL),
(2, 1, '1', 1, '2019-05-12 07:44:49', '0000-00-00 00:00:00', NULL),
(4, 3, 'BG', 1, '2019-06-06 05:34:46', '2019-06-05 22:34:46', NULL),
(5, 3, 'BM', 1, '2019-06-06 05:34:34', '2019-06-05 22:34:34', NULL),
(7, 0, '3', 1, '2019-06-05 22:35:02', '0000-00-00 00:00:00', NULL),
(12, 7, '1', 1, '2019-06-05 22:40:04', '0000-00-00 00:00:00', NULL),
(13, 7, '2', 1, '2019-06-05 22:40:13', '0000-00-00 00:00:00', NULL),
(14, 7, '3', 1, '2019-06-05 22:40:17', '0000-00-00 00:00:00', NULL),
(15, 7, '4', 1, '2019-06-05 22:40:22', '0000-00-00 00:00:00', NULL),
(16, 7, '5', 1, '2019-06-05 22:40:31', '0000-00-00 00:00:00', NULL),
(17, 7, '6', 1, '2019-06-05 22:40:35', '0000-00-00 00:00:00', NULL),
(18, 7, '7', 1, '2019-06-05 22:42:44', '0000-00-00 00:00:00', NULL),
(19, 1, '2', 1, '2019-06-05 22:43:03', '0000-00-00 00:00:00', NULL),
(20, 1, '3', 1, '2019-06-05 22:43:09', '0000-00-00 00:00:00', NULL),
(21, 1, '4', 1, '2019-06-05 22:43:14', '0000-00-00 00:00:00', NULL),
(22, 1, '5', 1, '2019-06-05 22:43:21', '0000-00-00 00:00:00', NULL),
(23, 1, '6', 1, '2019-06-05 22:43:27', '0000-00-00 00:00:00', NULL),
(24, 1, '7', 1, '2019-06-05 22:43:35', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_facilities`
--

CREATE TABLE `unit_facilities` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_facilities`
--

INSERT INTO `unit_facilities` (`id`, `unit_id`, `facility_id`, `user_id`) VALUES
(3, 153, 1, 1),
(4, 153, 2, 1),
(5, 153, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_images`
--

CREATE TABLE `unit_images` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `last_login`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '7488e331b8b64e5794da3fa4eb10ad5d', 1, '2020-03-31 13:36:45', 1, '2020-03-13 00:00:00', '2020-03-13 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towers`
--
ALTER TABLE `towers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_facilities`
--
ALTER TABLE `unit_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_images`
--
ALTER TABLE `unit_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `towers`
--
ALTER TABLE `towers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `unit_facilities`
--
ALTER TABLE `unit_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_images`
--
ALTER TABLE `unit_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
