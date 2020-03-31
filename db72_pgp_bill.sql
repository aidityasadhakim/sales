-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2020 at 08:15 PM
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
-- Database: `db72_pgp_bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `mansions`
--

CREATE TABLE `mansions` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `blok` varchar(10) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `area` int(11) NOT NULL,
  `water_used` int(11) NOT NULL,
  `date_used` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mansions`
--

INSERT INTO `mansions` (`id`, `code`, `type`, `blok`, `owner`, `area`, `water_used`, `date_used`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A1', '36', 'A', 'Vicky', 84, 5, '2020-03-13', '2020-03-13 15:55:41', '2020-03-13 15:56:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `slug` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `slug`, `name`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'electricity', 'Tarif Listrik Per KWH', 1300, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(2, 'water-apartment', 'Tarif Air Apartemen Per Kubik', 5000, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(3, 'water-mansion', 'Tarif Air Mansion Per Kubik', 2000, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(4, 'cleaning-apartment', 'Tarif Kebersihan Per M2 Apartemen', 15000, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(5, 'cleaning-mansion', 'Tarif Kebersihan Per M2 Mansion', 25000, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(6, 'cable-tv', 'TV Kabel', 35000, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL),
(7, 'sinking-fund', 'Sinking Fund', 0, '2020-03-12 16:00:00', '2020-03-17 13:56:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `residences`
--

CREATE TABLE `residences` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `tower` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `blok` varchar(20) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `area` int(11) NOT NULL,
  `electricity_used` int(11) NOT NULL,
  `water_used` int(11) NOT NULL,
  `date_used` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `residences`
--

INSERT INTO `residences` (`id`, `code`, `tower`, `floor`, `blok`, `owner`, `area`, `electricity_used`, `water_used`, `date_used`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A1', 3, 1, 'A', 'Vicky', 45, 10, 8, '2020-03-13', '2020-03-13 15:43:39', '2020-03-13 15:44:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `unit_type` int(11) NOT NULL COMMENT '1:residence,2:mansion',
  `unit_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `period` date NOT NULL,
  `due_date` date NOT NULL,
  `el_last_used` int(11) NOT NULL,
  `el_used` int(11) NOT NULL,
  `el_total_used` int(11) NOT NULL,
  `el_rate` int(11) NOT NULL,
  `abonemen` int(11) NOT NULL,
  `ppju` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `el_total_price` int(11) NOT NULL,
  `water_last_used` int(11) NOT NULL,
  `water_used` int(11) NOT NULL,
  `water_total_used` int(11) NOT NULL,
  `water_rate` int(11) NOT NULL,
  `water_total_price` int(11) NOT NULL,
  `cs_area` int(11) NOT NULL,
  `cs_rate` int(11) NOT NULL,
  `cs_total_price` int(11) NOT NULL,
  `cabletv_total_price` int(11) NOT NULL,
  `sf_total_price` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `unit_type`, `unit_id`, `transaction_date`, `period`, `due_date`, `el_last_used`, `el_used`, `el_total_used`, `el_rate`, `abonemen`, `ppju`, `ppn`, `el_total_price`, `water_last_used`, `water_used`, `water_total_used`, `water_rate`, `water_total_price`, `cs_area`, `cs_rate`, `cs_total_price`, `cabletv_total_price`, `sf_total_price`, `grand_total`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2020-02-10', '2020-02-01', '2020-02-20', 0, 100, 100, 1300, 0, 0, 0, 130000, 0, 10, 10, 5000, 50000, 45, 35000, 1575000, 35000, 0, 1790000, 1, NULL, '2020-03-17 19:12:26', NULL, NULL),
(2, 1, 1, '2020-03-18', '2020-03-01', '2020-03-01', 100, 150, 50, 1300, 0, 0, 0, 65000, 10, 15, 5, 5000, 25000, 45, 35000, 1575000, 35000, 0, 1700000, 1, NULL, '2020-03-17 19:14:41', NULL, NULL);

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
(1, 'Administrator', 'admin', '7488e331b8b64e5794da3fa4eb10ad5d', 1, '2020-03-18 01:53:28', 1, '2020-03-13 00:00:00', '2020-03-13 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mansions`
--
ALTER TABLE `mansions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residences`
--
ALTER TABLE `residences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `mansions`
--
ALTER TABLE `mansions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `residences`
--
ALTER TABLE `residences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
