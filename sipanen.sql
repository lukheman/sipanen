-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 03:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipanen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$12$By51GjOmzzU9cBoNoaGC4uNGfKr0NOqbljJ1lyfTglqv7Z3igS9XO',
  `photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$YFgfGDfbjbcqpsHuNhW4X./H9UxE6DTSIrOrUaVMicHoy3FIC.RJm', NULL, 'UE17EttoQiu84N44iXOR16hLdOHbnAyxTuWOZSjMmkO0YiCD3EPvTP9IEmXV', '2026-01-13 10:53:20', '2026-01-13 10:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_panen`
--

CREATE TABLE `hasil_panen` (
  `id_hasil_panen` bigint(20) UNSIGNED NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `id_tanaman` bigint(20) UNSIGNED NOT NULL,
  `id_kecamatan` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_panen`
--

INSERT INTO `hasil_panen` (`id_hasil_panen`, `jumlah`, `tahun`, `id_tanaman`, `id_kecamatan`, `created_at`, `updated_at`) VALUES
(201, '313.913', '2021', 11, 3, '2026-01-13 11:02:15', '2026-01-13 11:02:15'),
(202, '21.156', '2021', 12, 3, '2026-01-13 11:02:39', '2026-01-13 11:02:39'),
(203, '73.454', '2021', 14, 3, '2026-01-13 11:03:05', '2026-01-13 11:03:05'),
(204, '15.750', '2021', 15, 3, '2026-01-13 11:03:24', '2026-01-13 11:03:24'),
(205, '7.030', '2021', 16, 3, '2026-01-13 11:03:42', '2026-01-13 11:03:42'),
(206, '4.300', '2021', 17, 3, '2026-01-13 11:04:04', '2026-01-13 11:04:04'),
(207, '288.569', '2022', 11, 3, '2026-01-13 11:05:15', '2026-01-13 11:05:15'),
(208, '3.538', '2022', 12, 3, '2026-01-13 11:05:40', '2026-01-13 11:05:40'),
(209, '1.09154', '2022', 14, 3, '2026-01-13 11:06:12', '2026-01-13 11:06:12'),
(210, '11.264', '2022', 15, 3, '2026-01-13 11:06:32', '2026-01-13 11:06:32'),
(211, '6.588', '2022', 16, 3, '2026-01-13 11:07:01', '2026-01-13 11:07:01'),
(212, '3.876', '2022', 17, 3, '2026-01-13 11:07:21', '2026-01-13 11:07:21'),
(213, '1.8732', '2021', 11, 2, '2026-01-13 11:09:37', '2026-01-13 11:09:37'),
(214, '315.726', '2021', 12, 2, '2026-01-13 11:10:11', '2026-01-13 11:10:11'),
(215, '94.053', '2021', 14, 2, '2026-01-13 11:10:37', '2026-01-13 11:10:37'),
(216, '2.713', '2021', 15, 2, '2026-01-13 11:11:00', '2026-01-13 11:11:00'),
(217, '22.800', '2021', 16, 2, '2026-01-13 11:11:21', '2026-01-13 11:11:21'),
(218, '2.437', '2021', 17, 2, '2026-01-13 11:11:44', '2026-01-13 11:11:44'),
(219, '17.067', '2021', 20, 2, '2026-01-13 11:12:22', '2026-01-13 11:12:22'),
(220, '2.0942', '2022', 11, 2, '2026-01-13 11:13:16', '2026-01-13 11:13:16'),
(221, '289.432', '2022', 12, 2, '2026-01-13 11:13:40', '2026-01-13 11:13:40'),
(222, '1.3398', '2022', 14, 2, '2026-01-13 11:14:08', '2026-01-13 11:14:08'),
(223, '3.115', '2022', 15, 2, '2026-01-13 11:14:32', '2026-01-13 11:14:32'),
(224, '22.333', '2022', 16, 2, '2026-01-13 11:16:03', '2026-01-13 11:16:03'),
(225, '2.485', '2022', 17, 2, '2026-01-13 11:16:22', '2026-01-13 11:16:22'),
(226, '20.650', '2022', 20, 2, '2026-01-13 11:16:57', '2026-01-13 11:16:57'),
(227, '95.821', '2021', 11, 4, '2026-01-13 11:21:38', '2026-01-13 11:21:38'),
(228, '10.600', '2021', 12, 4, '2026-01-13 11:22:14', '2026-01-13 11:22:14'),
(229, '605.27', '2021', 14, 4, '2026-01-13 11:22:42', '2026-01-13 11:22:42'),
(230, '133.56', '2021', 15, 4, '2026-01-13 11:23:01', '2026-01-13 11:23:01'),
(231, '379.94', '2021', 16, 4, '2026-01-13 11:23:25', '2026-01-13 11:23:25'),
(232, '3.913', '2021', 20, 4, '2026-01-13 11:24:00', '2026-01-13 11:24:00'),
(233, '1.0536', '2023', 11, 4, '2026-01-13 11:25:30', '2026-01-13 11:25:30'),
(234, '21.400', '2023', 12, 4, '2026-01-13 11:25:50', '2026-01-13 11:25:50'),
(235, '705.397', '2023', 14, 4, '2026-01-13 11:26:11', '2026-01-13 11:26:11'),
(236, '2.960', '2023', 15, 4, '2026-01-13 11:26:34', '2026-01-13 11:26:34'),
(237, '198.721', '2021', 11, 5, '2026-01-13 11:28:30', '2026-01-13 11:28:30'),
(238, '92.200', '2021', 12, 5, '2026-01-13 11:28:52', '2026-01-13 11:28:52'),
(239, '711.00', '2021', 13, 5, '2026-01-13 11:29:17', '2026-01-13 11:29:17'),
(240, '264.94', '2021', 14, 5, '2026-01-13 11:29:37', '2026-01-13 11:29:37'),
(241, '13.110', '2021', 15, 5, '2026-01-13 11:30:03', '2026-01-13 11:30:03'),
(242, '13.625', '2021', 16, 5, '2026-01-13 11:30:23', '2026-01-13 11:30:23'),
(243, '23.236', '2021', 17, 5, '2026-01-13 11:30:41', '2026-01-13 11:30:41'),
(244, '133.429', '2022', 11, 5, '2026-01-13 11:32:05', '2026-01-13 11:32:05'),
(245, '85.256', '2022', 12, 5, '2026-01-13 11:32:26', '2026-01-13 11:32:26'),
(246, '647.096', '2022', 13, 5, '2026-01-13 11:32:48', '2026-01-13 11:32:48'),
(247, '539.64', '2022', 14, 5, '2026-01-13 11:33:07', '2026-01-13 11:33:07'),
(248, '8.257', '2022', 15, 5, '2026-01-13 11:33:29', '2026-01-13 11:33:29'),
(249, '14.810', '2022', 16, 5, '2026-01-13 11:33:49', '2026-01-13 11:33:49'),
(250, '324.76', '2022', 11, 9, '2026-01-13 11:35:44', '2026-01-13 11:35:44'),
(251, '542.688', '2022', 12, 9, '2026-01-13 11:36:02', '2026-01-13 11:36:02'),
(252, '399.353', '2022', 14, 9, '2026-01-13 11:36:40', '2026-01-13 11:36:40'),
(253, '24.625', '2022', 14, 9, '2026-01-13 11:36:57', '2026-01-13 11:36:57'),
(254, '33.15', '2022', 15, 9, '2026-01-13 11:37:13', '2026-01-13 11:37:13'),
(255, '208.15', '2022', 16, 9, '2026-01-13 11:37:30', '2026-01-13 11:37:30'),
(256, '300.108', '2023', 11, 9, '2026-01-13 11:39:37', '2026-01-13 11:39:37'),
(257, '427.405', '2023', 12, 9, '2026-01-13 11:39:57', '2026-01-13 11:39:57'),
(258, '364.604', '2023', 13, 9, '2026-01-13 11:40:17', '2026-01-13 11:40:17'),
(259, '19.500', '2023', 14, 9, '2026-01-13 11:40:33', '2026-01-13 11:40:33'),
(260, '34.08', '2023', 15, 9, '2026-01-13 11:44:30', '2026-01-13 11:44:30'),
(261, '185.40', '2023', 16, 9, '2026-01-13 11:44:50', '2026-01-13 11:44:50'),
(262, '26.838', '2021', 12, 6, '2026-01-13 11:46:47', '2026-01-13 11:46:47'),
(263, '321.700', '2021', 13, 6, '2026-01-13 11:47:14', '2026-01-13 11:47:14'),
(264, '1.314', '2021', 14, 6, '2026-01-13 11:47:36', '2026-01-13 11:47:36'),
(265, '2.351', '2021', 16, 6, '2026-01-13 11:47:59', '2026-01-13 11:47:59'),
(266, '18.268', '2021', 17, 6, '2026-01-13 11:48:24', '2026-01-13 11:48:24'),
(267, '3.289', '2021', 20, 6, '2026-01-13 11:48:53', '2026-01-13 11:48:53'),
(268, '27.477', '2022', 12, 6, '2026-01-13 11:50:03', '2026-01-13 11:50:03'),
(269, '632.677', '2022', 13, 6, '2026-01-13 11:50:31', '2026-01-13 11:50:31'),
(270, '1.434', '2022', 14, 6, '2026-01-13 11:50:54', '2026-01-13 11:50:54'),
(271, '17.758', '2022', 17, 6, '2026-01-13 11:52:02', '2026-01-13 11:52:02'),
(272, '810.18', '2022', 18, 6, '2026-01-13 11:52:40', '2026-01-13 11:52:40'),
(273, '3.406', '2022', 20, 6, '2026-01-13 11:53:04', '2026-01-13 11:53:04'),
(274, '291.436', '2023', 11, 12, '2026-01-13 11:55:37', '2026-01-13 11:55:37'),
(275, '118.471', '2023', 12, 12, '2026-01-13 11:56:04', '2026-01-13 11:56:04'),
(276, '463.957', '2023', 14, 12, '2026-01-13 11:56:30', '2026-01-13 11:56:30'),
(277, '4.746', '2023', 15, 12, '2026-01-13 11:56:59', '2026-01-13 11:56:59'),
(278, '3.233', '2023', 16, 12, '2026-01-13 11:57:23', '2026-01-13 11:57:23'),
(279, '1.196', '2023', 17, 12, '2026-01-13 11:57:45', '2026-01-13 11:57:45'),
(280, '2.696', '2023', 20, 12, '2026-01-13 11:58:31', '2026-01-13 11:58:31'),
(281, '284.333', '2022', 11, 12, '2026-01-13 12:00:09', '2026-01-13 12:00:09'),
(282, '116.409', '2022', 12, 12, '2026-01-13 12:01:02', '2026-01-13 12:01:02'),
(283, '448.016', '2022', 14, 12, '2026-01-13 12:01:26', '2026-01-13 12:01:26'),
(284, '4.647', '2022', 15, 12, '2026-01-13 12:01:47', '2026-01-13 12:01:47'),
(285, '3.030', '2022', 16, 12, '2026-01-13 12:02:07', '2026-01-13 12:02:07'),
(286, '1.147', '2022', 17, 12, '2026-01-13 12:02:52', '2026-01-13 12:02:52'),
(287, '2.790', '2022', 20, 12, '2026-01-13 12:03:31', '2026-01-13 12:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Baula', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(2, 'Iwoimendaa', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(3, 'Kolaka', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(4, 'Latambaga', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(5, 'Polinggona', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(6, 'Pomalaa', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(7, 'Samaturu', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(8, 'Tanggetada', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(9, 'Toari', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(10, 'Watubangga', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(11, 'Wolo', '2026-01-13 10:53:20', '2026-01-13 10:53:20'),
(12, 'Wundulako', '2026-01-13 10:53:20', '2026-01-13 10:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_dinas`
--

CREATE TABLE `kepala_dinas` (
  `id_kepala_dinas` bigint(20) UNSIGNED NOT NULL,
  `nama_kepala_dinas` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$12$sx3UPEfMloK/jkicqALoUO4lVuV48xnSNAHnPsQ4ZYmzBHBKFSuni',
  `tanggal_lahir` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kepala_dinas`
--

INSERT INTO `kepala_dinas` (`id_kepala_dinas`, `nama_kepala_dinas`, `email`, `password`, `tanggal_lahir`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Dinas Kolaka', 'kepaladinas@gmail.com', '$2y$12$5VGMdTrpwmv8SzI/vkZyVuabwxTcGJUFW/sW6BNoScERNXsabatxm', '2026-01-02', NULL, 'igLdjZtSxD5hIhZDBQlOOIrnhQ7qgj0J8DROHrpAMxLo0fG14slCO3hlsVzO', '2026-01-13 10:53:21', '2026-01-13 10:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `id_validasi` bigint(20) UNSIGNED NOT NULL,
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_08_04_072911_create_kecamatan_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_02_22_015547_create_users_table', 1),
(5, '0001_02_22_015639_create_kepala_dinas_table', 1),
(6, '2025_08_27_012621_create_tanaman_table', 1),
(7, '2025_08_27_223612_create_hasil_panen_table', 1),
(8, '2025_10_22_000000_create_validasis_table', 1),
(9, '2025_10_22_114006_create_petugas_table', 1),
(10, '2025_10_22_114007_create_laporan_table', 1),
(11, '2025_11_15_032210_create_admins_table', 1),
(12, '2025_11_15_034909_drop_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$12$AVhA18QRqQ.9UCDkwuF3Zu6.dKPNsph70nxDjAyknYCyqsEsKBfIm',
  `photo` varchar(255) DEFAULT NULL,
  `id_kecamatan` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `email`, `password`, `photo`, `id_kecamatan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Petugas Baula', 'petugas_baula@gmail.com', '$2y$12$G4rDqxSnxcAwN6ZMZKdPXejaaIN3WTbgb9k2jcKuEppG7DXNsVfEW', NULL, 1, NULL, '2026-01-13 10:53:21', '2026-01-13 10:53:21'),
(2, 'Petugas Iwoimendaa', 'petugas_iwoimendaa@gmail.com', '$2y$12$W9Auk0KNGA2cOxTfO8niCeV7NBqyxDRy.Y.6o.6s/9khGB849MPrq', NULL, 2, 'x8W8f68rZ6pSmFwkDLvyfzl3FmibECSdL0t0hvakgOqXh7R7VFRtAserKmDh', '2026-01-13 10:53:21', '2026-01-13 10:53:21'),
(3, 'Petugas Kolaka', 'petugas_kolaka@gmail.com', '$2y$12$j/TWATLFZ.I4ZGF/OqPmVOhs9Abzc5LbVwL2pD9dmt11PzJ0rVfKa', NULL, 3, '9tygvCRZ6WA3Nmrc2lKD5z0QbVZcUZ5O3qYZiDnDpevFG2TcewxSvtTzdXvH', '2026-01-13 10:53:21', '2026-01-13 10:53:21'),
(4, 'Petugas Latambaga', 'petugas_latambaga@gmail.com', '$2y$12$gQNe7y1SHh7qt2RKUGwHBOZaK5f.4eWWizuijkQboMkrLVXavXbvC', NULL, 4, 'jKtgLwqFSJEM9PuleVaxtZqfrFh6D2TYU9AkFEq9u2t9jAVANzrJvErarKE1', '2026-01-13 10:53:22', '2026-01-13 10:53:22'),
(5, 'Petugas Polinggona', 'petugas_polinggona@gmail.com', '$2y$12$k9UdTZZBq3A80uEIwODjnOKgCat0LSdMPmgevjY/a/fTk52eirLLO', NULL, 5, 'N9sUIGW9Z7ukZEa3bJsgykOl7aI5CY8fiqDVdXqwMWcSLoDbSGygz1SzNjbF', '2026-01-13 10:53:22', '2026-01-13 10:53:22'),
(6, 'Petugas Pomalaa', 'petugas_pomalaa@gmail.com', '$2y$12$Ne7hVKRCdkVdm99VDYxsUui0viJmi0ctvJsf7/a6.RTjy79.cjkDO', NULL, 6, 'di26twEdVv3xO6xRy7DSKmxWuxgHSqlNcQAmxqTvDsTOiAu3V6T8RSeuoRA5', '2026-01-13 10:53:22', '2026-01-13 10:53:22'),
(7, 'Petugas Samaturu', 'petugas_samaturu@gmail.com', '$2y$12$8RlgiCGikTZYaLPHDfAJ4.vfAvaqD3e3o0674zx.LxHdsE2eeGitm', NULL, 7, NULL, '2026-01-13 10:53:23', '2026-01-13 10:53:23'),
(8, 'Petugas Tanggetada', 'petugas_tanggetada@gmail.com', '$2y$12$aRc2U/H4Q6cS.nuPuMr3Ae3eUN1MwQ.8L2tqaQn6Y9xS3Aa37DcG.', NULL, 8, NULL, '2026-01-13 10:53:23', '2026-01-13 10:53:23'),
(9, 'Petugas Toari', 'petugas_toari@gmail.com', '$2y$12$oDkwg83aT372iH3hJsbSd.m8UWnYjIoKXguJrDduZ1oF1f84qEY62', NULL, 9, 'lYbIRlDKKjM5gFokKjSokK7T0zmcQcNkQStRG9GDDqrHUP9GvWas8wan3ICm', '2026-01-13 10:53:23', '2026-01-13 10:53:23'),
(10, 'Petugas Watubangga', 'petugas_watubangga@gmail.com', '$2y$12$cvSlfOeZvtaaLOrup7sf8e87Yw8C/OX1ZarG/krqUrYOdubFygOKq', NULL, 10, NULL, '2026-01-13 10:53:24', '2026-01-13 10:53:24'),
(11, 'Petugas Wolo', 'petugas_wolo@gmail.com', '$2y$12$YCs67dIGL82vB3dCSxGHBeG2194FF0hxRdXg3teSlbSUdJqoki0k.', NULL, 11, NULL, '2026-01-13 10:53:24', '2026-01-13 10:53:24'),
(12, 'Petugas Wundulako', 'petugas_wundulako@gmail.com', '$2y$12$L3Vn8PCfES5n/ADuIWDO8e7lrXAGHuBmDfMU7XH2yb7noL0JlkDdO', NULL, 12, 'MHFMO57xkIuzAtCBGbOEnFaJAnT4Rq3TXFdz89ZvS6wHuOY7sn9OW3IVMcSi', '2026-01-13 10:53:24', '2026-01-13 10:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('MfJ0KxZZiRnlx0DlnZ76xuQVZfVDgU2qxTjLY1xK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjZNUG10N29FTVkxcFBodGtna3BNc0c3aHVhdmw5TEdGdllEaVExTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768454769),
('uDw4soALg2hJQEtRsD3wto1IdBvU4TG7EgmTdSOz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY21sa0wyakdNaTJod1JJYVd2QnBEU291M0VkRGE2a2Z1UTNCRmF2aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rZWNhbWF0YW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1768456057);

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id_tanaman` bigint(20) UNSIGNED NOT NULL,
  `nama_tanaman` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id_tanaman`, `nama_tanaman`, `created_at`, `updated_at`) VALUES
(11, 'Kakao', '2026-01-13 10:57:20', '2026-01-13 10:57:20'),
(12, 'Kelapa Dalam', '2026-01-13 10:57:46', '2026-01-13 10:57:46'),
(13, 'Kelapa Sawit', '2026-01-13 10:57:59', '2026-01-13 10:57:59'),
(14, 'Cengkeh', '2026-01-13 10:58:10', '2026-01-13 10:58:10'),
(15, 'Kopi Robusta', '2026-01-13 10:58:23', '2026-01-13 10:58:23'),
(16, 'Lada', '2026-01-13 10:58:34', '2026-01-13 10:58:34'),
(17, 'Jambu Mete', '2026-01-13 10:58:47', '2026-01-13 10:58:47'),
(18, 'Kemiri', '2026-01-13 10:59:14', '2026-01-13 10:59:14'),
(19, 'Pinang', '2026-01-13 10:59:28', '2026-01-13 10:59:28'),
(20, 'Sagu', '2026-01-13 10:59:38', '2026-01-13 10:59:38'),
(21, 'Pala', '2026-01-13 10:59:48', '2026-01-13 10:59:48'),
(22, 'Karet', '2026-01-13 10:59:59', '2026-01-13 10:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE `validasi` (
  `id_validasi` bigint(20) UNSIGNED NOT NULL,
  `status_validasi` enum('Belum Divalidasi','Valid','Tidak Valid') NOT NULL DEFAULT 'Belum Divalidasi',
  `id_hasil_panen` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `validasi`
--

INSERT INTO `validasi` (`id_validasi`, `status_validasi`, `id_hasil_panen`, `created_at`, `updated_at`) VALUES
(201, 'Belum Divalidasi', 201, '2026-01-13 11:02:15', '2026-01-13 11:02:15'),
(202, 'Belum Divalidasi', 202, '2026-01-13 11:02:39', '2026-01-13 11:02:39'),
(203, 'Belum Divalidasi', 203, '2026-01-13 11:03:05', '2026-01-13 11:03:05'),
(204, 'Belum Divalidasi', 204, '2026-01-13 11:03:24', '2026-01-13 11:03:24'),
(205, 'Belum Divalidasi', 205, '2026-01-13 11:03:42', '2026-01-13 11:03:42'),
(206, 'Belum Divalidasi', 206, '2026-01-13 11:04:04', '2026-01-13 11:04:04'),
(207, 'Belum Divalidasi', 207, '2026-01-13 11:05:15', '2026-01-13 11:05:15'),
(208, 'Belum Divalidasi', 208, '2026-01-13 11:05:40', '2026-01-13 11:05:40'),
(209, 'Belum Divalidasi', 209, '2026-01-13 11:06:12', '2026-01-13 11:06:12'),
(210, 'Belum Divalidasi', 210, '2026-01-13 11:06:32', '2026-01-13 11:06:32'),
(211, 'Belum Divalidasi', 211, '2026-01-13 11:07:01', '2026-01-13 11:07:01'),
(212, 'Belum Divalidasi', 212, '2026-01-13 11:07:22', '2026-01-13 11:07:22'),
(213, 'Belum Divalidasi', 213, '2026-01-13 11:09:37', '2026-01-13 11:09:37'),
(214, 'Belum Divalidasi', 214, '2026-01-13 11:10:11', '2026-01-13 11:10:11'),
(215, 'Belum Divalidasi', 215, '2026-01-13 11:10:37', '2026-01-13 11:10:37'),
(216, 'Belum Divalidasi', 216, '2026-01-13 11:11:00', '2026-01-13 11:11:00'),
(217, 'Belum Divalidasi', 217, '2026-01-13 11:11:21', '2026-01-13 11:11:21'),
(218, 'Belum Divalidasi', 218, '2026-01-13 11:11:44', '2026-01-13 11:11:44'),
(219, 'Belum Divalidasi', 219, '2026-01-13 11:12:22', '2026-01-13 11:12:22'),
(220, 'Belum Divalidasi', 220, '2026-01-13 11:13:16', '2026-01-13 11:13:16'),
(221, 'Belum Divalidasi', 221, '2026-01-13 11:13:40', '2026-01-13 11:13:40'),
(222, 'Belum Divalidasi', 222, '2026-01-13 11:14:08', '2026-01-13 11:14:08'),
(223, 'Belum Divalidasi', 223, '2026-01-13 11:14:32', '2026-01-13 11:14:32'),
(224, 'Belum Divalidasi', 224, '2026-01-13 11:16:03', '2026-01-13 11:16:03'),
(225, 'Belum Divalidasi', 225, '2026-01-13 11:16:22', '2026-01-13 11:16:22'),
(226, 'Belum Divalidasi', 226, '2026-01-13 11:16:57', '2026-01-13 11:16:57'),
(227, 'Belum Divalidasi', 227, '2026-01-13 11:21:38', '2026-01-13 11:21:38'),
(228, 'Belum Divalidasi', 228, '2026-01-13 11:22:14', '2026-01-13 11:22:14'),
(229, 'Belum Divalidasi', 229, '2026-01-13 11:22:42', '2026-01-13 11:22:42'),
(230, 'Belum Divalidasi', 230, '2026-01-13 11:23:01', '2026-01-13 11:23:01'),
(231, 'Belum Divalidasi', 231, '2026-01-13 11:23:25', '2026-01-13 11:23:25'),
(232, 'Belum Divalidasi', 232, '2026-01-13 11:24:00', '2026-01-13 11:24:00'),
(233, 'Belum Divalidasi', 233, '2026-01-13 11:25:30', '2026-01-13 11:25:30'),
(234, 'Belum Divalidasi', 234, '2026-01-13 11:25:50', '2026-01-13 11:25:50'),
(235, 'Belum Divalidasi', 235, '2026-01-13 11:26:11', '2026-01-13 11:26:11'),
(236, 'Belum Divalidasi', 236, '2026-01-13 11:26:34', '2026-01-13 11:26:34'),
(237, 'Belum Divalidasi', 237, '2026-01-13 11:28:30', '2026-01-13 11:28:30'),
(238, 'Belum Divalidasi', 238, '2026-01-13 11:28:52', '2026-01-13 11:28:52'),
(239, 'Belum Divalidasi', 239, '2026-01-13 11:29:17', '2026-01-13 11:29:17'),
(240, 'Belum Divalidasi', 240, '2026-01-13 11:29:37', '2026-01-13 11:29:37'),
(241, 'Belum Divalidasi', 241, '2026-01-13 11:30:03', '2026-01-13 11:30:03'),
(242, 'Belum Divalidasi', 242, '2026-01-13 11:30:23', '2026-01-13 11:30:23'),
(243, 'Valid', 243, '2026-01-13 11:30:41', '2026-01-13 12:04:31'),
(244, 'Belum Divalidasi', 244, '2026-01-13 11:32:05', '2026-01-13 11:32:05'),
(245, 'Belum Divalidasi', 245, '2026-01-13 11:32:26', '2026-01-13 11:32:26'),
(246, 'Belum Divalidasi', 246, '2026-01-13 11:32:48', '2026-01-13 11:32:48'),
(247, 'Belum Divalidasi', 247, '2026-01-13 11:33:07', '2026-01-13 11:33:07'),
(248, 'Belum Divalidasi', 248, '2026-01-13 11:33:29', '2026-01-13 11:33:29'),
(249, 'Belum Divalidasi', 249, '2026-01-13 11:33:49', '2026-01-13 11:33:49'),
(250, 'Belum Divalidasi', 250, '2026-01-13 11:35:44', '2026-01-13 11:35:44'),
(251, 'Belum Divalidasi', 251, '2026-01-13 11:36:02', '2026-01-13 11:36:02'),
(252, 'Belum Divalidasi', 252, '2026-01-13 11:36:40', '2026-01-13 11:36:40'),
(253, 'Belum Divalidasi', 253, '2026-01-13 11:36:57', '2026-01-13 11:36:57'),
(254, 'Belum Divalidasi', 254, '2026-01-13 11:37:13', '2026-01-13 11:37:13'),
(255, 'Belum Divalidasi', 255, '2026-01-13 11:37:30', '2026-01-13 11:37:30'),
(256, 'Belum Divalidasi', 256, '2026-01-13 11:39:37', '2026-01-13 11:39:37'),
(257, 'Belum Divalidasi', 257, '2026-01-13 11:39:57', '2026-01-13 11:39:57'),
(258, 'Belum Divalidasi', 258, '2026-01-13 11:40:17', '2026-01-13 11:40:17'),
(259, 'Belum Divalidasi', 259, '2026-01-13 11:40:33', '2026-01-13 11:40:33'),
(260, 'Belum Divalidasi', 260, '2026-01-13 11:44:30', '2026-01-13 11:44:30'),
(261, 'Belum Divalidasi', 261, '2026-01-13 11:44:50', '2026-01-13 11:44:50'),
(262, 'Valid', 262, '2026-01-13 11:46:47', '2026-01-13 12:04:27'),
(263, 'Valid', 263, '2026-01-13 11:47:14', '2026-01-13 12:04:22'),
(264, 'Valid', 264, '2026-01-13 11:47:36', '2026-01-13 12:04:19'),
(265, 'Valid', 265, '2026-01-13 11:47:59', '2026-01-13 12:04:15'),
(266, 'Valid', 266, '2026-01-13 11:48:24', '2026-01-13 12:04:11'),
(267, 'Valid', 267, '2026-01-13 11:48:53', '2026-01-13 12:04:07'),
(268, 'Belum Divalidasi', 268, '2026-01-13 11:50:03', '2026-01-13 11:50:03'),
(269, 'Belum Divalidasi', 269, '2026-01-13 11:50:31', '2026-01-13 11:50:31'),
(270, 'Belum Divalidasi', 270, '2026-01-13 11:50:54', '2026-01-13 11:50:54'),
(271, 'Belum Divalidasi', 271, '2026-01-13 11:52:02', '2026-01-13 11:52:02'),
(272, 'Belum Divalidasi', 272, '2026-01-13 11:52:40', '2026-01-13 11:52:40'),
(273, 'Belum Divalidasi', 273, '2026-01-13 11:53:04', '2026-01-13 11:53:04'),
(274, 'Belum Divalidasi', 274, '2026-01-13 11:55:37', '2026-01-13 11:55:37'),
(275, 'Belum Divalidasi', 275, '2026-01-13 11:56:04', '2026-01-13 11:56:04'),
(276, 'Belum Divalidasi', 276, '2026-01-13 11:56:30', '2026-01-13 11:56:30'),
(277, 'Belum Divalidasi', 277, '2026-01-13 11:56:59', '2026-01-13 11:56:59'),
(278, 'Belum Divalidasi', 278, '2026-01-13 11:57:23', '2026-01-13 11:57:23'),
(279, 'Belum Divalidasi', 279, '2026-01-13 11:57:45', '2026-01-13 11:57:45'),
(280, 'Belum Divalidasi', 280, '2026-01-13 11:58:31', '2026-01-13 11:58:31'),
(281, 'Belum Divalidasi', 281, '2026-01-13 12:00:09', '2026-01-13 12:00:09'),
(282, 'Belum Divalidasi', 282, '2026-01-13 12:01:02', '2026-01-13 12:01:02'),
(283, 'Belum Divalidasi', 283, '2026-01-13 12:01:26', '2026-01-13 12:01:26'),
(284, 'Belum Divalidasi', 284, '2026-01-13 12:01:47', '2026-01-13 12:01:47'),
(285, 'Belum Divalidasi', 285, '2026-01-13 12:02:07', '2026-01-13 12:02:07'),
(286, 'Belum Divalidasi', 286, '2026-01-13 12:02:52', '2026-01-13 12:02:52'),
(287, 'Belum Divalidasi', 287, '2026-01-13 12:03:31', '2026-01-13 12:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_panen`
--
ALTER TABLE `hasil_panen`
  ADD PRIMARY KEY (`id_hasil_panen`),
  ADD KEY `hasil_panen_id_tanaman_foreign` (`id_tanaman`),
  ADD KEY `hasil_panen_id_kecamatan_foreign` (`id_kecamatan`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kepala_dinas`
--
ALTER TABLE `kepala_dinas`
  ADD PRIMARY KEY (`id_kepala_dinas`),
  ADD UNIQUE KEY `kepala_dinas_email_unique` (`email`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `laporan_id_validasi_foreign` (`id_validasi`),
  ADD KEY `laporan_id_petugas_foreign` (`id_petugas`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `petugas_email_unique` (`email`),
  ADD KEY `petugas_id_kecamatan_foreign` (`id_kecamatan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id_tanaman`);

--
-- Indexes for table `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id_validasi`),
  ADD KEY `validasi_id_hasil_panen_foreign` (`id_hasil_panen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_panen`
--
ALTER TABLE `hasil_panen`
  MODIFY `id_hasil_panen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kepala_dinas`
--
ALTER TABLE `kepala_dinas`
  MODIFY `id_kepala_dinas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id_tanaman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id_validasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_panen`
--
ALTER TABLE `hasil_panen`
  ADD CONSTRAINT `hasil_panen_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_panen_id_tanaman_foreign` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_id_petugas_foreign` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_id_validasi_foreign` FOREIGN KEY (`id_validasi`) REFERENCES `validasi` (`id_validasi`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE CASCADE;

--
-- Constraints for table `validasi`
--
ALTER TABLE `validasi`
  ADD CONSTRAINT `validasi_id_hasil_panen_foreign` FOREIGN KEY (`id_hasil_panen`) REFERENCES `hasil_panen` (`id_hasil_panen`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
