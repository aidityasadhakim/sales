-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2020 at 10:23 AM
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
-- Database: `db72_inventori`
--

-- --------------------------------------------------------

--
-- Table structure for table `claim_paids`
--

CREATE TABLE `claim_paids` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `sale_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vicky Priyadi', '08550874282', 'Jalan Aminah SYukur no 82', '2020-06-16 14:37:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `debt_paids`
--

CREATE TABLE `debt_paids` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMin` int(11) NOT NULL,
  `buyPrice` int(11) NOT NULL,
  `salePrice` int(11) NOT NULL,
  `note` text NOT NULL,
  `type` enum('Accessories','Part','Unit') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `slug`, `code`, `name`, `stock`, `stockMin`, `buyPrice`, `salePrice`, `note`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'lcdxiaomi', 'ITM1', 'LCD Xiaomi', 10, 10, 120000, 150000, 'baru', 'Accessories', '2020-06-15 13:56:31', '2020-06-15 14:10:06', NULL),
(2, 'icpowerxiaomi', 'ITM2', 'IC Power XIaomi', 11, 5, 200000, 250000, 'Baik', 'Part', '2020-06-18 13:40:55', '2020-06-18 13:40:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tunai', '2020-06-15 14:52:16', '2020-06-15 14:52:21', NULL),
(2, 'Transfer BCA', '2020-06-24 12:04:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `cash` int(11) DEFAULT NULL,
  `changes` int(11) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `is_cash` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL COMMENT '0:cancel, 1:pending, 2:complete, 3:retur',
  `note` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `transaction_date`, `supplier_id`, `code`, `total`, `cash`, `changes`, `method_id`, `is_cash`, `status`, `note`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020-06-25', 1, 'IHP1', 120000, 120000, 0, 2, 1, 2, 'Pesan LCS', 0, '2020-06-25 12:32:09', '2020-06-25 12:32:09', NULL),
(2, '2020-06-26', 1, 'IHP2', 200000, 200000, 0, 2, 1, 2, '', 0, '2020-06-26 08:09:22', '2020-06-26 08:09:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_id`, `item_id`, `qty`, `price`) VALUES
(1, 1, 1, 1, 120000),
(2, 2, 2, 1, 200000);

--
-- Triggers `purchase_details`
--
DELIMITER $$
CREATE TRIGGER `reverse_stock` AFTER DELETE ON `purchase_details` FOR EACH ROW UPDATE items SET `stock` = `stock` - OLD.qty WHERE id = OLD.item_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `sale_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `cash` int(11) DEFAULT NULL,
  `changes` int(11) DEFAULT NULL,
  `method_id` int(11) NOT NULL,
  `is_cash` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL COMMENT '0:cancel, 1:pending, 2:complete, 3:retur',
  `type` enum('sale','service') NOT NULL,
  `note` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `transaction_date`, `customer_id`, `code`, `total`, `cash`, `changes`, `method_id`, `is_cash`, `status`, `type`, `note`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020-06-25', 1, 'IHS1', 150000, 150000, 0, 1, 1, 2, 'sale', 'Beli LCD', 0, '2020-06-25 12:31:40', '2020-06-25 12:31:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `item_id`, `qty`, `price`) VALUES
(1, 1, 1, 1, 150000);

--
-- Triggers `sale_details`
--
DELIMITER $$
CREATE TRIGGER `return_stock` AFTER DELETE ON `sale_details` FOR EACH ROW UPDATE items SET `stock` = `stock` + OLD.qty WHERE id = OLD.item_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_mutations`
--

CREATE TABLE `stock_mutations` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` enum('sale','purchase','stock','service') NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_mutations`
--

INSERT INTO `stock_mutations` (`id`, `transaction_id`, `item_id`, `amount`, `type`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 2, 10, 'stock', 'Stok Gudang', '2020-06-25 12:30:56', NULL, NULL),
(2, 0, 1, 10, 'stock', 'Stok Gudang', '2020-06-25 12:31:08', NULL, NULL),
(3, 1, 1, -1, 'sale', NULL, '2020-06-25 12:31:40', NULL, NULL),
(4, 1, 1, 1, 'purchase', NULL, '2020-06-25 12:32:09', NULL, NULL),
(5, 2, 2, 1, 'purchase', NULL, '2020-06-26 08:09:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sabo Distributor', '081111111', 'Jalan Pergudangan No 1', NULL, NULL, NULL);

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
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `last_login`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vicky', 'vicky', '7adadcc764313fdbb4acba9149d6fdc9', 1, '2020-06-26 15:52:59', 1, '2020-03-13 00:00:00', '2020-06-24 22:35:26', NULL),
(2, 'Loki', 'loki', 'f930a25e521e81d8a389a0a8522552b3', 3, '2020-06-25 20:38:41', 1, '2020-06-24 22:24:58', '2020-06-24 22:26:28', NULL),
(3, 'Administrator', 'admin', '7488e331b8b64e5794da3fa4eb10ad5d', 1, '2020-06-26 15:52:59', 1, '2020-03-13 00:00:00', '2020-06-24 22:35:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claim_paids`
--
ALTER TABLE `claim_paids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debt_paids`
--
ALTER TABLE `debt_paids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_mutations`
--
ALTER TABLE `stock_mutations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `claim_paids`
--
ALTER TABLE `claim_paids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `debt_paids`
--
ALTER TABLE `debt_paids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_mutations`
--
ALTER TABLE `stock_mutations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
