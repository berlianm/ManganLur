-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2023 at 01:48 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manganlur`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_menu`
--

CREATE TABLE `gambar_menu` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gambar_menu`
--

INSERT INTO `gambar_menu` (`id`, `menu_id`, `gambar`, `created_at`, `updated_at`) VALUES
(3, 8, '1672898709.jpg', NULL, NULL),
(5, 5, '1672934515.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_menu`
--

CREATE TABLE `jenis_menu` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_menu`
--

INSERT INTO `jenis_menu` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', NULL, NULL, NULL),
(4, 'Minuman', 'Minuman', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `restoran_id` bigint UNSIGNED DEFAULT NULL,
  `jenis_menu_id` bigint UNSIGNED DEFAULT NULL,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double(8,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `restoran_id`, `jenis_menu_id`, `nama_menu`, `harga`, `gambar`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 3, 1, 'Burgerku', 50000.00, '1672821824.jpg', 'Burger', '2023-01-04 01:01:04', '2023-01-04 01:43:44'),
(6, 3, NULL, 'Es Krim', 25000.00, '1672844076.jpg', 'Es Krim', '2023-01-04 01:02:32', '2023-01-04 07:54:36'),
(8, 3, 4, 'Es Krim', 25000.00, '1672898450.jpg', 'Eskrim ku enak', '2023-01-04 23:00:50', '2023-01-04 23:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_03_133936_create_jenis_menu', 1),
(6, '2023_01_03_133937_create_restorans_table', 1),
(7, '2023_01_03_134436_create_menus_table', 1),
(8, '2023_01_03_144241_create_review_menu', 1),
(9, '2023_01_03_144321_create_review_resto', 1),
(10, '2023_01_03_144432_create_gambar_menu', 1),
(11, '2023_01_03_144453_create_rating', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `restoran_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `restoran_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 4, NULL, NULL),
(2, 1, 3, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restorans`
--

CREATE TABLE `restorans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_resto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `lokasi_map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restorans`
--

INSERT INTO `restorans` (`id`, `user_id`, `nama_resto`, `alamat`, `jam_buka`, `jam_tutup`, `lokasi_map`, `gambar`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 2, 'KFC', 'Jl. Dr. Setiabudi No.169, Gegerkalong, Kec. Sukasari, Kota Bandung, Jawa Barat 40153', '09:00:00', '21:00:00', 'https://goo.gl/maps/KRZeun1Cik5j2Bhe8', '1672812896_kfc.jpg', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.041560891543!2d112.17623351451213!3d-8.097244283226265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78ec65f409251b%3A0xdefcdded85c5b2e1!2sAkademi%20Komunitas%20Negeri%20Putra%20Sang%20Fajar%20Blitar!5e0!3m2!1sen!2sid!4v1672896122661!5m2!1sen!2sid\" width=\"400\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, NULL),
(4, 9, 'warungku', 'nde kene', '19:42:00', '07:42:00', NULL, NULL, NULL, NULL, NULL),
(5, 2, 'restobaru', 'alamat', '20:17:00', '20:20:00', NULL, '1673011149_rating.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_menu`
--

CREATE TABLE `review_menu` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_menu`
--

INSERT INTO `review_menu` (`id`, `user_id`, `menu_id`, `review`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 'Enak Banget Kak', NULL, NULL),
(2, 2, 6, 'mantap sih', NULL, NULL),
(3, 1, 5, 'Kayaknya enak nih!!', NULL, NULL),
(5, 2, 8, 'Enak paling ~~', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_resto`
--

CREATE TABLE `review_resto` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `restoran_id` bigint UNSIGNED NOT NULL,
  `review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_resto`
--

INSERT INTO `review_resto` (`id`, `user_id`, `restoran_id`, `review`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'Tempatnya nyaman !!', NULL, NULL),
(2, 1, 3, 'Tempatnya Cukup Luas!!', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','restoran') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@user', NULL, 'user', '$2y$10$3d9ODLvOQzgPh5.jCsBSJ.NBc68tDP4pf/14xoUfSsktUqfuK5lEe', 'user', NULL, '2023-01-03 08:40:50', '2023-01-03 08:40:50'),
(2, 'admin', 'admin@admin', NULL, 'admin', '$2y$10$WJqhacIATlIrzeByP3.jeOH7Yg5.ltZyA25UmAp4qwfOTuEZwuasm', 'restoran', NULL, '2023-01-03 08:41:56', '2023-01-03 08:41:56'),
(3, 'Agung Aldi Prasetya', 'agungaldi34@gmail.com', NULL, 'agung', '$2y$10$buwtDDBwmnv9C3H7IYB/Wutj8NjPJ8XN0cNDNS8bnig5xTKqjTUM2', 'user', NULL, '2023-01-03 09:38:59', '2023-01-03 09:38:59'),
(4, 'resto', 'resto@gmail.com', NULL, 'resto', '$2y$10$6QmEcftK7kW94thULuv36e.3YOROyi0SVlHt3gXCvmkasdi1aOTYu', 'restoran', NULL, '2023-01-05 03:47:12', '2023-01-05 03:47:12'),
(9, 'tokoku', 'tokoku@gmail.com', NULL, 'tokoku', '$2y$10$gZ.uX1haduqlh2/.ZHncteO5P9ChyJwiJJ3Mq6qCDgPexAECIK8QK', 'restoran', NULL, '2023-01-05 05:41:24', '2023-01-05 05:41:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gambar_menu`
--
ALTER TABLE `gambar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gambar_menu_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `jenis_menu`
--
ALTER TABLE `jenis_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restoran_fk` (`restoran_id`),
  ADD KEY `menu_fk` (`jenis_menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_user_id_foreign` (`user_id`),
  ADD KEY `rating_restoran_id_foreign` (`restoran_id`);

--
-- Indexes for table `restorans`
--
ALTER TABLE `restorans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restorans_user_id_foreign` (`user_id`);

--
-- Indexes for table `review_menu`
--
ALTER TABLE `review_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_menu_user_id_foreign` (`user_id`),
  ADD KEY `review_menu_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `review_resto`
--
ALTER TABLE `review_resto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_resto_user_id_foreign` (`user_id`),
  ADD KEY `review_resto_restoran_id_foreign` (`restoran_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar_menu`
--
ALTER TABLE `gambar_menu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_menu`
--
ALTER TABLE `jenis_menu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `restorans`
--
ALTER TABLE `restorans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review_menu`
--
ALTER TABLE `review_menu`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review_resto`
--
ALTER TABLE `review_resto`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gambar_menu`
--
ALTER TABLE `gambar_menu`
  ADD CONSTRAINT `gambar_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menu_fk` FOREIGN KEY (`jenis_menu_id`) REFERENCES `jenis_menu` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `restoran_fk` FOREIGN KEY (`restoran_id`) REFERENCES `restorans` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_restoran_id_foreign` FOREIGN KEY (`restoran_id`) REFERENCES `restorans` (`id`),
  ADD CONSTRAINT `rating_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `restorans`
--
ALTER TABLE `restorans`
  ADD CONSTRAINT `restorans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_menu`
--
ALTER TABLE `review_menu`
  ADD CONSTRAINT `review_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `review_menu_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `review_resto`
--
ALTER TABLE `review_resto`
  ADD CONSTRAINT `review_resto_restoran_id_foreign` FOREIGN KEY (`restoran_id`) REFERENCES `restorans` (`id`),
  ADD CONSTRAINT `review_resto_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
