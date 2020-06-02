-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 06:13 PM
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
  `kategori_artikel` enum('Umum','Petunjuk') DEFAULT NULL,
  `isi` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`uuid`, `tanggal`, `judul`, `kategori_artikel`, `isi`, `created_at`, `updated_at`, `deleted_at`) VALUES
('04ac78e8-eb1e-4da2-8318-8c457036f1dd', '2020-06-02', 'Petunjuk untuk panitia/wasit', 'Petunjuk', '<ol><li>Berdoa pokonya</li></ol>', '2020-06-02 11:56:38', NULL, NULL),
('91d0cbda-89db-4dd4-a9e3-5407cc5ac2bd', '2020-06-01', 'Test', NULL, '<b>test</b>', '2020-06-01 05:02:36', '2020-05-31 22:29:16', '2020-05-31 22:29:16'),
('bba55f5e-9250-4f9d-8bc0-0b0570e9b1fd', '2020-06-02', 'Kompetisi', 'Umum', '<p>Kompetisi</p>', '2020-06-02 11:56:52', '2020-06-02 11:58:35', NULL),
('f41a5124-260f-443a-87de-a1ba2e0a0fcb', '2020-06-02', 'Petunjuk untuk admin', 'Petunjuk', '<ol><li>Berdoa dulu ya</li></ol>', '2020-06-02 11:56:19', NULL, NULL);

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
('b2110532-6be7-4287-a0af-bc217964d611', 'Paijo', 'paijo', '$2y$10$ZMXSDv2lrnVNSSOEWxttiOnmI9AKlbHx6CiYaDyUmWnfQLUC2/Tti', '2020-05-12 08:47:23', NULL, NULL);

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
  `sesi` int(11) DEFAULT '1',
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

INSERT INTO `rules` (`uuid`, `nama`, `jml_seri`, `jml_panah`, `uuid_ronde`, `jml_peserta`, `jarak`, `sesi`, `uuid_kelas`, `uuid_kategori`, `input`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0ad7b88d-4c0d-4190-b335-59742e25d9d4', 'Kualifikasi Putri U-20', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:53', NULL, NULL),
('0c35a278-8343-4b8d-851e-43dc54693b34', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 07:44:45', NULL, NULL),
('1615c4ba-6ef6-43ca-be54-49060c1d2fe9', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:44:14', '2020-06-02 07:59:02', '2020-06-02 07:59:02'),
('17ef7ef9-d367-4256-bcbf-4d2a137cab31', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 08:07:52', NULL, NULL),
('1f670685-afb9-46b0-8742-b2f82ef0b6bc', 'Kualifikasi Putra U-20 Sesi 1', 4, 4, '816440c8-9bf6-4272-9b71-23720b191801', 4, 4, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', 'Otomatis', '2020-06-02 15:10:36', NULL, NULL),
('3b236980-4c1c-402e-9251-1ae410cd16ef', 'Kualifikasi Putri U-20', 4, 4, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 07:10:33', '2020-06-02 08:28:26', '2020-06-02 08:28:26'),
('4a0e335c-3c25-4049-ac4a-4c14e739a1ce', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', 'Otomatis', '2020-06-02 15:03:32', '2020-06-02 08:05:51', '2020-06-02 08:05:51'),
('5c89e973-98a4-47d5-a6df-eae21c6fe847', 'Kualifikasi Putra U-20', 4, 42, '816440c8-9bf6-4272-9b71-23720b191801', 23, 4, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', 'Otomatis', '2020-06-02 15:06:16', '2020-06-02 08:10:21', '2020-06-02 08:10:21'),
('6e13d9ec-1416-46bf-95a4-c5aeff3d96e5', 'Perdelapan Eliminasi Putra U-21', 4, 4, '04a8eff3-98e9-46aa-a68d-b166df207b26', 16, 51, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', 'Manual', '2020-06-01 14:51:25', '2020-06-02 11:38:13', NULL),
('7d347c9e-f4f7-4f81-9e38-6a914a6f9a7a', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:53:56', NULL, NULL),
('9aa20c6f-71e1-4259-b8f0-df6c20614ead', 'Perdelapan  Eliminasi Putri U-20', 6, 6, '30cb2410-37d4-4844-a464-97f83f58a8f8', 16, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', 'Manual', '2020-06-02 11:39:39', NULL, NULL),
('9c6fe7c7-644f-455c-bfdf-a3f3baa36d22', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', 'Otomatis', '2020-06-02 14:59:30', '2020-06-02 08:03:12', '2020-06-02 08:03:12'),
('a5fd81d5-a757-410a-bfe4-33a761c8be43', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 60, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:50:37', '2020-06-02 08:12:21', '2020-06-02 08:12:21'),
('a6862079-b710-483b-8836-d456cfc67c9d', 'Kualifikasi Putri U-21', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 07:34:42', NULL, NULL),
('ae25d19d-a955-4a23-84fa-95568c381c2a', 'Perdelapan Eliminasi Putra U-21', 6, 6, '04a8eff3-98e9-46aa-a68d-b166df207b26', 16, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', 'Manual', '2020-06-02 15:14:38', NULL, NULL),
('be62fd1a-b512-46b5-803f-94911c80de31', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 6, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:27', NULL, NULL),
('c5cf0086-ab38-4a3c-a781-db6205f69421', 'Kualifikasi Putri U-20 Sesi 1', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', 'Otomatis', '2020-06-02 15:28:49', NULL, NULL),
('caef9ae9-592e-4de2-961e-e1df61b404d0', 'Kualifikasi Putra U-20 Sesi 2', 4, 4, '816440c8-9bf6-4272-9b71-23720b191801', 4, 4, 2, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', 'Otomatis', '2020-06-02 15:10:36', NULL, NULL),
('cb9134a4-0fba-40b0-9213-a27964e2d803', 'Perdelapan Eliminasi Putra U-21', 6, 6, '04a8eff3-98e9-46aa-a68d-b166df207b26', 24, 50, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '63121c33-029a-46e7-8e44-f3e2db750965', 'Manual', '2020-06-02 15:12:51', '2020-06-02 08:13:18', '2020-06-02 08:13:18'),
('d828dcd3-91fd-495c-b061-4f1065f39071', 'Kualifikasi Putra U-20', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', NULL, '2020-05-20 08:08:57', NULL, NULL),
('d9972c40-5ec8-4ed0-9026-750640d462b4', 'Kualifikasi Putri U-20', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 1, 'f3464888-8727-4e18-94ed-30d2953bfae0', '63121c33-029a-46e7-8e44-f3e2db750965', NULL, '2020-05-20 07:51:31', NULL, NULL),
('e7535b53-8c41-4574-bd18-a0e6496e318e', 'Kualifikasi Putri U-20 Sesi 2', 6, 6, 'ec3ac315-d2bb-411e-af45-fe432d1e4310', 24, 50, 2, 'f3464888-8727-4e18-94ed-30d2953bfae0', '67b67e46-4d03-454d-95ae-e8ff0a0770a1', 'Otomatis', '2020-06-02 15:28:49', NULL, NULL),
('eed9f45f-2c64-4bcf-9852-0d9b46baf80c', 'Kualifikasi Putra U-21', 6, 6, '816440c8-9bf6-4272-9b71-23720b191801', 24, 6, 1, 'ebd74f1f-28bf-4c48-acdb-c3bf3a6f4f38', '25fe57c9-5045-45d7-95fc-3e0e90c6ec6c', NULL, '2020-05-20 12:11:03', NULL, NULL);

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
('162fea7e-ff0e-437a-b493-075bbdae1510', '0df7134c-c5ad-4fe3-8909-bbb957be56b5', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('17459c06-fe32-4cd1-8457-1ec4b611a210', '44d2e250-c7cf-47ae-8994-5517be7ba789', 0, 0, 0, 0, 0, 40, 40, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:48:42', '2020-06-02 09:07:29', NULL),
('20352bce-7fde-42ea-b2e8-485ab8c6438f', 'e55bc347-0729-4188-8f7b-def3bf94f676', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('2919fb03-f9f8-42c8-a6cc-cfb1236624ca', '6c598e94-978a-4305-8527-869c5e64fc56', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('2e36c429-e8d6-4c2b-b5d4-57a5b99139b0', '24e3356b-8f52-43c4-9dd6-966259fae712', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('3271a19c-bf54-4092-8ddf-9bff47dad919', '6630ff76-6b87-4289-87c7-368419647d3a', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('370f2fd0-d12e-410f-aa4e-00b79f73a1e0', 'dc504a5f-7eb6-4f29-b7bc-90f20a05974a', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('4b40dda2-cc90-4a08-be5e-5a1d0fbc42bf', '6c598e94-978a-4305-8527-869c5e64fc56', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('53565f5b-04ac-4dfb-9fc4-3bb7dd65bfd8', '44d2e250-c7cf-47ae-8994-5517be7ba789', 0, 0, 0, 0, 0, 40, 40, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:49:17', '2020-06-02 09:02:06', NULL),
('583cf866-b0dc-4b5c-bf06-3045f0c3d238', '0df7134c-c5ad-4fe3-8909-bbb957be56b5', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('5c7ede9b-95d8-4d74-aeb7-f6783aba4589', '7b370d14-35c5-4293-acc1-29285756cae9', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('63deeabf-fcce-43d8-948a-2f9ed0813761', '24e3356b-8f52-43c4-9dd6-966259fae712', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('6601fe80-4550-4f5e-aa6b-3be65686ab15', 'd008d513-f679-4e07-8e6d-9ee916b1ebeb', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('717e1602-d909-4c1f-b0f0-e3407065978b', 'e55bc347-0729-4188-8f7b-def3bf94f676', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('76559e73-03d1-46f0-bf0a-abf6acc0add2', '6630ff76-6b87-4289-87c7-368419647d3a', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('8b54b2fa-972d-4088-ab6e-d5efc44d6e09', '858d7887-055f-48e0-aaf5-2c5f86e78f2e', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('9a86a3f5-537c-49a1-aad9-82a0848e58d2', 'a962ef5e-e7be-4e9c-a178-666558463044', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('9ad42edd-4273-435c-b2aa-0b5b1a83578b', '2b9bc00e-533f-4da1-a85a-55632d7e679f', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('af0ea0e1-d678-48ca-ac42-1185b18558a2', 'ebafa052-623e-4d58-9742-a004444a4800', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('af6341db-5085-4e3e-8fb9-027a3589372a', 'd008d513-f679-4e07-8e6d-9ee916b1ebeb', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('b919de3e-f3e2-4a3c-977f-15179d00bc5b', 'a962ef5e-e7be-4e9c-a178-666558463044', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('c96ead1a-0151-4092-8d51-fb63bf7da913', '858d7887-055f-48e0-aaf5-2c5f86e78f2e', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d611', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('ce13532e-41c5-4756-944a-1fb5385222a0', '87e1932f-c86c-4656-834c-747e7d7af474', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('d0e84e59-4548-4e39-94b8-07dadf2a93ba', '2b9bc00e-533f-4da1-a85a-55632d7e679f', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('de894f8c-a8e3-4fe4-84a7-0459e2500786', '87e1932f-c86c-4656-834c-747e7d7af474', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('e510761a-bd14-4478-99d2-e975c7e1578b', 'd63026a7-57ed-4a5d-810a-0e5a6875e06e', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('e6a254d1-c621-4369-9f08-52d0cecce787', '6a230c9b-bdc1-4ef7-bfad-3bb9f3dd8cb4', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('e827cf6a-7740-4326-949e-ba6bf73d6d1b', 'ebafa052-623e-4d58-9742-a004444a4800', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d421', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('f6cb7848-a5e1-4592-9c0f-b0df9b0b49a0', '7b370d14-35c5-4293-acc1-29285756cae9', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d123', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL),
('fd4a9c1c-cdd5-47bd-95b2-7f46fbf8d614', 'd63026a7-57ed-4a5d-810a-0e5a6875e06e', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('fe1e0ea8-0f5f-4afb-b15e-7d300680eab3', 'dc504a5f-7eb6-4f29-b7bc-90f20a05974a', 0, 0, 0, 0, 0, 0, 0, 1, 'c5cf0086-ab38-4a3c-a781-db6205f69421', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:48:42', '2020-06-02 08:49:40', NULL),
('fe8aa0a6-d9b0-400d-bc80-67092627ceb4', '6a230c9b-bdc1-4ef7-bfad-3bb9f3dd8cb4', 0, 0, 0, 0, 0, 0, 0, 2, 'e7535b53-8c41-4574-bd18-a0e6496e318e', 'b2110532-6be7-4287-a0af-bc217964d610', '2020-06-02 15:49:17', '2020-06-02 08:49:40', NULL);

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
  `id` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
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
('943f705c-dee0-4bc5-9315-1e2c6668889a', 'Admin', 'admin', '$2y$10$I15wqz2tFE4LudZfP4qD8Oal35WXUkaPo1SQe5rjiSUbptl/Gmfkm', NULL, '2020-06-02 14:10:11', '2020-06-02 07:10:11');

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
