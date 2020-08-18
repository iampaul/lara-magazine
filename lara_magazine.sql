-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 06:51 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_magazine`
--

-- --------------------------------------------------------

--
-- Table structure for table `st_admins`
--

CREATE TABLE `st_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `st_admins`
--

INSERT INTO `st_admins` (`id`, `name`, `email`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$GyLXzFFJ4abXJ0cc86K6S.q3zEPLDW8daQFfruCHOmnhJXLmVerr.', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `st_failed_jobs`
--

CREATE TABLE `st_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `st_magazines`
--

CREATE TABLE `st_magazines` (
  `magazine_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `frequency` enum('week','month','year') NOT NULL DEFAULT 'week',
  `stripe_id` varchar(75) DEFAULT NULL,
  `status` enum('ACTIVE','DISABLED') NOT NULL DEFAULT 'DISABLED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st_magazines`
--

INSERT INTO `st_magazines` (`magazine_id`, `name`, `image`, `price`, `frequency`, `stripe_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Magazine A', 'magazine-a_1597723439.jpg', 50.00, 'week', 'prod_Hr4BntzsYmVSH0', 'ACTIVE', '2020-08-17 22:33:59', '2020-08-17 22:34:01'),
(2, 'Magazine B', 'magazine-b_1597723463.jpg', 100.00, 'month', 'prod_Hr4CBE7S2bvPNv', 'ACTIVE', '2020-08-17 22:34:23', '2020-08-17 22:34:24'),
(3, 'Magazine C', 'magazine-c_1597723493.jpg', 500.00, 'year', 'prod_Hr4CXQwF8IfIgz', 'ACTIVE', '2020-08-17 22:34:53', '2020-08-17 22:34:54'),
(4, 'Magazine D', 'magazine-d_1597723519.jpg', 120.00, 'month', 'prod_Hr4DnBOlmalOXI', 'ACTIVE', '2020-08-17 22:35:19', '2020-08-17 22:35:21'),
(5, 'Magazine E', 'magazine-e_1597723547.jpg', 150.00, 'month', 'prod_Hr4DRUx9KfxDpp', 'ACTIVE', '2020-08-17 22:35:47', '2020-08-17 22:35:48'),
(6, 'Magazine F New', 'magazine-f_1597723577.jpg', 70.00, 'week', 'prod_Hr4DYrOgZSC3Wq', 'ACTIVE', '2020-08-17 22:36:17', '2020-08-17 23:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `st_migrations`
--

CREATE TABLE `st_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `st_migrations`
--

INSERT INTO `st_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_17_110736_create_admins_table', 2),
(5, '2020_08_17_133928_create_magazines', 3),
(6, '2019_05_03_000001_create_customer_columns', 4),
(7, '2019_05_03_000002_create_subscriptions_table', 4),
(8, '2019_05_03_000003_create_subscription_items_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `st_password_resets`
--

CREATE TABLE `st_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `st_password_resets`
--

INSERT INTO `st_password_resets` (`email`, `token`, `created_at`) VALUES
('paul@gmail.com', '$2y$10$MYIxB2a/vcXm2WqFIBWwdONhc8MVy483Ck6Z2TFDb9LtProK2wJ8W', '2020-08-16 09:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `st_users`
--

CREATE TABLE `st_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `st_users`
--

INSERT INTO `st_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `stripe_id`, `created_at`, `updated_at`) VALUES
(1, 'Paul', 'paul@gmail.com', NULL, '$2y$10$FImxKEvkbKyYeBIvDjOKXOvmdgrNn/TLYRe1GKSzBkH9NOnj5aRYK', NULL, 'cus_Hr4d14m147ftRR', '2020-08-17 22:56:11', '2020-08-17 23:01:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `st_admins`
--
ALTER TABLE `st_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `st_failed_jobs`
--
ALTER TABLE `st_failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_magazines`
--
ALTER TABLE `st_magazines`
  ADD PRIMARY KEY (`magazine_id`);

--
-- Indexes for table `st_migrations`
--
ALTER TABLE `st_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_password_resets`
--
ALTER TABLE `st_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `st_users`
--
ALTER TABLE `st_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `st_admins`
--
ALTER TABLE `st_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `st_failed_jobs`
--
ALTER TABLE `st_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `st_magazines`
--
ALTER TABLE `st_magazines`
  MODIFY `magazine_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `st_migrations`
--
ALTER TABLE `st_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `st_users`
--
ALTER TABLE `st_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
