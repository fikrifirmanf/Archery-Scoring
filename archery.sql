-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 11:34 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuci_tangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `uuid` varchar(150) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `isi` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`uuid`, `tanggal`, `judul`, `isi`, `created_at`, `updated_at`, `deleted_at`) VALUES
('91d0cbda-89db-4dd4-a9e3-5407cc5ac2bd', '2020-06-01', 'Test', '<b>test</b>', '2020-06-01 05:02:36', '2020-05-31 22:29:16', '2020-05-31 22:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `uuid` varchar(50) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`uuid`, `nama_kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
('25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', 'Recurve', '2020-05-08 02:31:43', NULL, NULL),
('63121c33-029a-46e7-8e44-f3e2db750965', 'Compound', '2020-05-08 02:31:43', NULL, NULL),
('67b67e46-4d03-454d-95ae-e8ff0a0770a1', 'Nasional', '2020-05-08 02:31:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `uuid` varchar(50) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`uuid`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
('107134e6-9019-4e77-8bdb-5cb94b816f90', 'U-25', '2020-06-01 07:07:42', '2020-06-01 07:09:13', NULL),
('ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', 'U-21', '2020-05-08 02:29:20', NULL, NULL),
('f3464888-8727-4e18-94ed-30d2953bfae0', 'U-20', '2020-05-08 02:28:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kompetisi`
--

CREATE TABLE `kompetisi` (
  `uuid` varchar(50) NOT NULL,
  `uuid_peserta` varchar(50) DEFAULT NULL,
  `uuid_skor` varchar(50) DEFAULT NULL,
  `uuid_ronde` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_05_07_024642_create_putri_nasional_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `no_target`
--

CREATE TABLE `no_target` (
  `uuid` varchar(50) NOT NULL,
  `nama_papan` int(11) DEFAULT NULL,
  `no_target` varchar(50) DEFAULT NULL,
  `uuid_panitia` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_target`
--

INSERT INTO `no_target` (`uuid`, `nama_papan`, `no_target`, `uuid_panitia`, `created_at`, `updated_at`, `deleted_at`) VALUES
('001e79f6-e0f4-46fd-aa81-ae25e5283337', 2, 'D', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 06:49:55', NULL, NULL),
('00efd669-87a1-464e-bef5-af97e2ee7ea0', 2, 'C', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 06:49:55', NULL, NULL),
('09f24568-a5a6-4c3f-bc24-b8403b50665a', 2, 'A', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 06:49:55', NULL, NULL),
('1c51d043-1eb9-4261-95af-ce56a40df413', 1, 'A', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 06:49:55', NULL, NULL),
('32292552-4d3a-4926-9cc1-1e554809ea60', 4, 'D', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 06:49:55', NULL, NULL),
('388227f2-4fe7-41fe-998c-87fad56bb18d', 1, 'B', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 06:49:55', NULL, NULL),
('59d49811-75b7-43e0-a1c1-65f7132ef09e', 1, 'D', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 06:49:55', NULL, NULL),
('73162d89-99e3-4b77-a315-f3253dd1d123', 2, 'B', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 06:49:55', NULL, NULL),
('89f4fee3-10e8-4c41-a639-89cac054b34a', 3, 'D', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 06:49:55', NULL, NULL),
('9f9bc4dc-a785-4fd6-b975-d81970e65920', 4, 'B', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 06:49:55', NULL, NULL),
('a5e646cd-34f7-468d-bed7-5259837f163e', 1, 'C', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 06:49:55', NULL, NULL),
('adfc30e0-a318-4d3b-83f5-628eaa0a78ed', 3, 'A', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 06:49:55', NULL, NULL),
('aeaf27a4-c24c-447c-b4b8-c0fecbad97b0', 3, 'B', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 06:49:55', NULL, NULL),
('bc62c5bb-8ae1-4142-a102-fd6f130723ee', 4, 'A', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 06:49:55', NULL, NULL),
('c3b5c739-f5ec-4f9e-a5ae-578932e61f63', 4, 'C', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 06:49:55', NULL, NULL),
('c9845464-5685-426c-a74e-bceb98a34b59', 3, 'C', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 06:49:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `panitia`
--

CREATE TABLE `panitia` (
  `id` varchar(50) NOT NULL,
  `nama_panitia` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panitia`
--

INSERT INTO `panitia` (`id`, `nama_panitia`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0dfc220b-9bbe-45ce-89c9-d7a3ddb19c96', 'Yasngari', '66170ade-4c84-4ffb-bcf6-d778c731b2fd', '091d3ed1-25d3-46ca-97a7-e649ddffd7cb', '2020-05-24 11:37:55', '2020-05-24 04:45:16', '2020-05-24 04:45:16'),
('b2110532-6be7-4287-a0af-bc217964d123', 'Ere', 'ere', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d421', 'Jose', 'jose', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d610', 'Fikri Firman Fadilah', 'fikrifirmanf', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d611', 'Paijo', 'paijo', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d612', 'Ruslam', 'ruslam', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d613', 'Ruslama', 'ruslama', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL),
('b2110532-6be7-4287-a0af-bc217964d614', 'Ruslaman', 'ruslaman', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `uuid` varchar(50) NOT NULL,
  `no_target` varchar(50) DEFAULT NULL,
  `nama_peserta` varchar(50) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `team` varchar(30) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`uuid`, `no_target`, `nama_peserta`, `jk`, `kelas`, `team`, `kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0df7134c-c5ad-4fe3-8909-bbb957be56b5', '4A', 'Fidelya Latifa Cetta J.', 'P', 'U-20', 'DASH DAQU SEMARANG', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('17103852-a287-45fd-94ae-71501ec02d86', '6A', 'Ucup', 'L', 'U-25', 'AZATATECH', 'Compound', '2020-06-02 07:58:18', NULL, NULL),
('23ed2bf3-f884-4dae-b444-d96fac0eb110', '6A', 'Ucup', 'L', 'U-20', 'AZATATECH', 'Nasional', '2020-05-24 03:50:35', '2020-06-02 00:57:21', '2020-06-02 00:57:21'),
('24e3356b-8f52-43c4-9dd6-966259fae712', '1B', 'Yasmin Zahira Rahmani', 'P', 'U-20', 'ABHIPRAYA', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('2b9bc00e-533f-4da1-a85a-55632d7e679f', '2D', 'Sofia Yasmina Nadaa Kamilitya', 'P', 'U-20', 'ARCHERY BMD SLEMAN', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('44d2e250-c7cf-47ae-8994-5517be7ba789', '3A', 'Naila Mutiara Shabrina', 'P', 'U-20', 'DASH DAQU SEMARANG', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('6630ff76-6b87-4289-87c7-368419647d3a', '4C', 'Syaqila Waskita Azzarin', 'P', 'U-20', 'MAFAZA ARCHERY SCHOOL', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('6a230c9b-bdc1-4ef7-bfad-3bb9f3dd8cb4', '3B', 'Chalista Muthia Atthara', 'P', 'U-20', 'ABHIPRAYA', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('6c598e94-978a-4305-8527-869c5e64fc56', '2A', 'Najma Maritza Zahirah T.', 'P', 'U-20', 'DASH DAQU SEMARANG', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('7b370d14-35c5-4293-acc1-29285756cae9', '1D', 'Quinnaura Aufaluella Syahlaa\'k', 'P', 'U-20', 'ARCHERY BMD SLEMAN', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('858d7887-055f-48e0-aaf5-2c5f86e78f2e', '4D', 'Queisha Fatihah Yasa', 'P', 'U-20', 'ARCHERY BMD SLEMAN', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('87e1932f-c86c-4656-834c-747e7d7af474', '1C', 'Shabiva Putri Waluyo', 'P', 'U-20', 'MAFAZA ARCHERY SCHOOL', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('99f9fc03-550e-469b-8bfa-6aea33efca16', '5A', 'Fikri Firman Fadilah', 'L', 'U-20', 'AZATATECH', 'Nasional', '2020-05-24 03:50:08', NULL, NULL),
('a962ef5e-e7be-4e9c-a178-666558463044', '1A', 'Naila Putri Hartadi', 'P', 'U-20', 'DASH DAQU SEMARANG', 'Nasional', '2020-05-20 20:27:35', '2020-06-02 07:51:00', NULL),
('d008d513-f679-4e07-8e6d-9ee916b1ebeb', '4B', 'Dyafi Cantika Cerahati', 'P', 'U-20', 'ABHIPRAYA', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('d63026a7-57ed-4a5d-810a-0e5a6875e06e', '3D', 'Khayra Asheeqa Shahia', 'P', 'U-20', 'ARCHERY BMD SLEMAN', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('dc504a5f-7eb6-4f29-b7bc-90f20a05974a', '3C', 'Essenza Qur\'anieque Putri', 'P', 'U-20', 'MAFAZA ARCHERY SCHOOL', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('e55bc347-0729-4188-8f7b-def3bf94f676', '2B', 'Aikoputeri Trihaniyyah Sausan', 'P', 'U-20', 'ABHIPRAYA', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL),
('ebafa052-623e-4d58-9742-a004444a4800', '2C', 'Nazmi Dhiya Permata', 'P', 'U-20', 'MAFAZA ARCHERY SCHOOL', 'Nasional', '2020-05-20 20:27:35', '2020-05-20 20:27:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ronde`
--

CREATE TABLE `ronde` (
  `uuid` varchar(50) NOT NULL,
  `nama_ronde` varchar(50) NOT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ronde`
--

INSERT INTO `ronde` (`uuid`, `nama_ronde`, `jk`, `created_at`, `updated_at`, `deleted_at`) VALUES
('04a8eff3-98e9-46aa-a68d-b166df207b26', 'Perdelapan Eliminasi Putra', 'L', '2020-05-09 13:58:51', '2020-05-17 08:34:13', NULL),
('30cb2410-37d4-4844-a464-97f83f58a8f8', 'Perdelapan  Eliminasi Putri', 'P', '2020-05-17 08:35:56', NULL, NULL),
('3920d6f3-e997-4ace-8869-9309e42c1719', 'Final Putri', 'P', '2020-05-17 08:36:02', NULL, NULL),
('816440c8-9bf6-4272-9b71-23720b191801', 'Kualifikasi Putra', 'L', '2020-05-10 10:00:28', '2020-05-18 13:16:53', NULL),
('9e807ff1-2582-4015-9b67-37192dc4b61b', 'Semifinal Putra', 'L', '2020-05-10 10:00:21', '2020-05-17 08:33:38', NULL),
('bd37135d-77e6-48e9-ad36-a06a69d5a71b', 'Semifinal Putri', 'P', '2020-05-17 08:35:48', NULL, NULL),
('cb468f51-b4ea-4f6b-9c2a-c47fd8de1ff7', 'Final Putra', 'L', '2020-05-17 08:25:02', NULL, NULL),
('d3b268a0-8b9f-4a55-9e01-00ae3a7fb041', 'Perempat Eliminasi Putra', 'L', '2020-05-21 10:07:58', '2020-06-02 08:10:09', NULL),
('ec3ac315-d2bb-411e-af45-fe432d1e4310', 'Kualifikasi Putri', 'P', '2020-05-18 13:17:06', NULL, NULL),
('f7d54e7e-c823-4b0b-aa2e-9937b4d2edd2', 'Perempat Eliminasi Putri', 'P', '2020-05-21 10:08:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `uuid` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jml_seri` int(11) DEFAULT NULL,
  `jml_panah` int(11) DEFAULT NULL,
  `uuid_ronde` varchar(50) DEFAULT NULL,
  `jml_peserta` int(11) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `uuid_kelas` varchar(50) DEFAULT NULL,
  `uuid_kategori` varchar(50) DEFAULT NULL,
  `input` enum('Otomatis','Manual') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`uuid`, `nama`, `jml_seri`, `jml_panah`, `uuid_ronde`, `jml_peserta`, `jarak`, `uuid_kelas`, `uuid_kategori`, `input`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0ad7b88d-4c0d-4190-b335-59742e25d9d4', 'Kualifikasi Putri U-20', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:53', NULL, NULL),
('0c35a278-8343-4b8d-851e-43dc54693b34', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 07:44:45', NULL, NULL),
('1615c4ba-6ef6-43ca-be54-49060c1d2fe9', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:44:14', NULL, NULL),
('17ef7ef9-d367-4256-bcbf-4d2a137cab31', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 08:07:52', NULL, NULL),
('3b236980-4c1c-402e-9251-1ae410cd16ef', 'Kualifikasi Putri U-20', 4, 4, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 07:10:33', NULL, NULL),
('6e13d9ec-1416-46bf-95a4-c5aeff3d96e5', 'Perdelapan Eliminasi Putri U-20', 6, 6, '30cb2410-37d4-4844-a464-97f83f58a8f8', 8, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', 'Manual', '2020-06-01 14:51:25', NULL, NULL),
('7d347c9e-f4f7-4f81-9e38-6a914a6f9a7a', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:53:56', NULL, NULL),
('a5fd81d5-a757-410a-bfe4-33a761c8be43', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 60, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:50:37', NULL, NULL),
('a6862079-b710-483b-8836-d456cfc67c9d', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 07:34:42', NULL, NULL),
('be62fd1a-b512-46b5-803f-94911c80de31', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 6, 'f3464888-8727-4e18-94ed-30d2953bfae0', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:27', NULL, NULL),
('d828dcd3-91fd-495c-b061-4f1065f39071', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 08:08:57', NULL, NULL),
('d9972c40-5ec8-4ed0-9026-750640d462b4', 'Kualifikasi Putri U-20', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:51:31', NULL, NULL),
('eed9f45f-2c64-4bcf-9852-0d9b46baf80c', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 6, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skor`
--

CREATE TABLE `skor` (
  `uuid` varchar(50) NOT NULL,
  `uuid_peserta` varchar(50) NOT NULL,
  `seri_1` int(11) DEFAULT '0',
  `seri_2` int(11) DEFAULT '0',
  `seri_3` int(11) DEFAULT '0',
  `seri_4` int(11) DEFAULT '0',
  `seri_5` int(11) DEFAULT '0',
  `seri_6` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `sesi` int(11) DEFAULT '1',
  `uuid_rules` varchar(50) DEFAULT NULL,
  `uuid_panitia` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skor`
--

INSERT INTO `skor` (`uuid`, `uuid_peserta`, `seri_1`, `seri_2`, `seri_3`, `seri_4`, `seri_5`, `seri_6`, `total`, `sesi`, `uuid_rules`, `uuid_panitia`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0191fe84-8259-4691-ab54-5c3d5a37ca93', 'e55bc347-0729-4188-8f7b-def3bf94f676', 2, 2, 2, 0, 0, 0, 6, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('0ca96555-48d4-4987-8ce1-af54fae1be30', '7b370d14-35c5-4293-acc1-29285756cae9', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('185e5a07-0338-4028-9958-f248553bc5ce', 'ebafa052-623e-4d58-9742-a004444a4800', 40, 40, 40, 8, 40, 40, 208, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 05:04:43', '2020-05-22 04:57:49', NULL),
('19233339-f174-4458-ac64-24a39cfd354f', 'dc504a5f-7eb6-4f29-b7bc-90f20a05974a', 7, 8, 9, 0, 0, 0, 24, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('1e415fe6-b43f-413d-8457-4a317e3d46e9', 'd008d513-f679-4e07-8e6d-9ee916b1ebeb', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('203cc69a-c1a9-496f-8116-33608baee73a', '99f9fc03-550e-469b-8bfa-6aea33efca16', 0, 0, 0, 0, 0, 0, 0, 1, 'd828dcd3-91fd-495c-b061-4f1065f39071', NULL, '2020-06-01 07:34:03', NULL, NULL),
('21c541dc-2278-4652-85af-bb9109aa876c', '6630ff76-6b87-4289-87c7-368419647d3a', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('36fcbd54-4e5e-4c42-82db-7a866d737842', '44d2e250-c7cf-47ae-8994-5517be7ba789', 34, 39, 32, 0, 0, 0, 105, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 05:04:43', '2020-05-23 02:33:34', NULL),
('3c342249-0702-4c08-8c17-24510c4c61ad', '2b9bc00e-533f-4da1-a85a-55632d7e679f', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('4031ce91-d67c-4fda-b746-0d9091210133', '858d7887-055f-48e0-aaf5-2c5f86e78f2e', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('40bab256-867e-44b2-82e3-6c90d95f6ff6', '6c598e94-978a-4305-8527-869c5e64fc56', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('49b20323-8a38-44e8-9f1c-07b4ebc7e81f', 'd63026a7-57ed-4a5d-810a-0e5a6875e06e', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('8b944fb2-e2c5-42f3-8dc3-0a3716cee29e', '6a230c9b-bdc1-4ef7-bfad-3bb9f3dd8cb4', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('94cc92f6-a7fe-41e8-9375-b5f84c38f989', 'a962ef5e-e7be-4e9c-a178-666558463044', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('95a5a93d-fe87-45f9-b591-328f186fc59d', '0df7134c-c5ad-4fe3-8909-bbb957be56b5', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('ba42971c-2b09-4428-8aa5-ec1e6c69c31a', '87e1932f-c86c-4656-834c-747e7d7af474', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL),
('bf5cedb0-ba16-40c5-bf65-e85c656a9d5d', '23ed2bf3-f884-4dae-b444-d96fac0eb110', 0, 0, 0, 0, 0, 0, 0, 1, 'd828dcd3-91fd-495c-b061-4f1065f39071', NULL, '2020-06-01 07:34:03', NULL, NULL),
('c7beb762-35ba-4bf4-b738-7c319f6370fd', '24e3356b-8f52-43c4-9dd6-966259fae712', 0, 0, 0, 0, 0, 0, 0, 1, '3b236980-4c1c-402e-9251-1ae410cd16ef', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-05-21 05:04:43', '2020-05-21 00:43:30', NULL);

--
-- Triggers `skor`
--
DELIMITER $$
CREATE TRIGGER `skor_before_insert` BEFORE INSERT ON `skor` FOR EACH ROW BEGIN
set new.total = new.seri_1+new.seri_2+new.seri_3+new.seri_4+new.seri_5+new.seri_6;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `skor_before_update` BEFORE UPDATE ON `skor` FOR EACH ROW BEGIN
set new.total = new.seri_1+new.seri_2+new.seri_3+new.seri_4+new.seri_5+new.seri_6;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `uuid` varchar(30) NOT NULL,
  `nama_team` varchar(30) DEFAULT NULL,
  `daerah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`uuid`, `nama_team`, `daerah`, `created_at`, `updated_at`, `deleted_at`) VALUES
('84cae6e1-e44f-4511-8952-5ed370', 'Guwek', 'Purwokerto', '2020-05-08 02:32:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', NULL, '2020-05-24 12:00:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `FK_kompetisi_peserta` (`uuid_peserta`),
  ADD KEY `FK_kompetisi_skor` (`uuid_skor`),
  ADD KEY `FK_kompetisi_ronde` (`uuid_ronde`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_target`
--
ALTER TABLE `no_target`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `FK_no_target_panitia` (`uuid_panitia`);

--
-- Indexes for table `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `ronde`
--
ALTER TABLE `ronde`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `FK_rules_kelas` (`uuid_kelas`),
  ADD KEY `FK_rules_kategori` (`uuid_kategori`),
  ADD KEY `FK_rules_ronde` (`uuid_ronde`);

--
-- Indexes for table `skor`
--
ALTER TABLE `skor`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `FK_skor_peserta` (`uuid_peserta`),
  ADD KEY `FK_skor_panitia` (`uuid_panitia`),
  ADD KEY `FK_skor_rules` (`uuid_rules`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kompetisi`
--
ALTER TABLE `kompetisi`
  ADD CONSTRAINT `FK_kompetisi_peserta` FOREIGN KEY (`uuid_peserta`) REFERENCES `peserta` (`uuid`),
  ADD CONSTRAINT `FK_kompetisi_ronde` FOREIGN KEY (`uuid_ronde`) REFERENCES `ronde` (`uuid`),
  ADD CONSTRAINT `FK_kompetisi_skor` FOREIGN KEY (`uuid_skor`) REFERENCES `skor` (`uuid`);

--
-- Constraints for table `no_target`
--
ALTER TABLE `no_target`
  ADD CONSTRAINT `FK_no_target_panitia` FOREIGN KEY (`uuid_panitia`) REFERENCES `panitia` (`id`);

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `FK_rules_kategori` FOREIGN KEY (`uuid_kategori`) REFERENCES `kategori` (`uuid`),
  ADD CONSTRAINT `FK_rules_kelas` FOREIGN KEY (`uuid_kelas`) REFERENCES `kelas` (`uuid`),
  ADD CONSTRAINT `FK_rules_ronde` FOREIGN KEY (`uuid_ronde`) REFERENCES `ronde` (`uuid`);

--
-- Constraints for table `skor`
--
ALTER TABLE `skor`
  ADD CONSTRAINT `FK_skor_panitia` FOREIGN KEY (`uuid_panitia`) REFERENCES `panitia` (`id`),
  ADD CONSTRAINT `FK_skor_peserta` FOREIGN KEY (`uuid_peserta`) REFERENCES `peserta` (`uuid`),
  ADD CONSTRAINT `FK_skor_rules` FOREIGN KEY (`uuid_rules`) REFERENCES `rules` (`uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
