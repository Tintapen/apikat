-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apikat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_aplikasi`
--

CREATE TABLE `tb_aplikasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_aplikasi`
--

INSERT INTO `tb_aplikasi` (`id`, `nama`, `telp`, `email`, `alamat`, `logo`) VALUES
(1, 'APIKAT', '085717199834', 'windinurmalasari@gmail.com', 'Bekasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_backupdb`
--

CREATE TABLE `tb_backupdb` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `database` varchar(256) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dipinjam`
--

CREATE TABLE `tb_dipinjam` (
  `id` int(11) NOT NULL,
  `idPeminjaman` int(11) NOT NULL,
  `idPerangkat` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `catatan` text NOT NULL,
  `idUserpengembalian` int(11) NOT NULL,
  `tglPengembalian` datetime NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dipinjam`
--

INSERT INTO `tb_dipinjam` (`id`, `idPeminjaman`, `idPerangkat`, `idKategori`, `nama`, `deskripsi`, `jumlah`, `status`, `catatan`, `idUserpengembalian`, `tglPengembalian`, `terdaftar`) VALUES
(11, 4, 1, 1, 'Laptop Lenovo', 'Lenovo Core i5 Gen 10', 1, 'Disetujui', 'Silahkan ambil perangkat ke kantor ICT', 1, '2022-12-26 15:12:56', '2022-12-22 17:27:41'),
(18, 9, 2, 2, 'Epson Proyektor', 'Lengkap dengan kabel HDMI dan tas\r\n', 1, 'Diproses', '', 0, '0000-00-00 00:00:00', '2022-12-28 21:57:00'),
(19, 10, 1, 1, 'Laptop Lenovo', 'Lenovo Core i5 Gen 10', 1, 'Disetujui', 'Silahkan ambil perangkat pada pukul 09.00 ', 0, '0000-00-00 00:00:00', '2022-12-28 22:10:21'),
(22, 12, 2, 2, 'Epson Proyektor', 'Lengkap dengan kabel HDMI dan tas\r\n', 1, 'Disetujui', 'Silahkan ambil perangkat pada pukul 09.00 ', 0, '0000-00-00 00:00:00', '2023-01-03 21:30:37'),
(23, 13, 1, 1, 'Laptop Lenovo', 'Lenovo Core i5 Gen 10', 1, 'Diproses', '', 0, '0000-00-00 00:00:00', '2023-01-04 08:43:17'),
(25, 14, 2, 2, 'Epson Projector EB-U42', 'Lengkap dengan kabel HDMI dan tas', 1, 'Diproses', '', 0, '0000-00-00 00:00:00', '2023-01-05 11:45:18'),
(29, 19, 2, 2, 'Epson Projector EB-U42', 'Lengkap dengan kabel HDMI dan tas', 1, 'Diproses', '', 0, '0000-00-00 00:00:00', '2023-06-06 18:32:54'),
(30, 19, 1, 1, 'HP 348 G4 Core i5', 'Lengkap bersama dengan charger, mouse dan tas', 2, 'Diproses', '', 0, '0000-00-00 00:00:00', '2023-06-06 18:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fungsi`
--

CREATE TABLE `tb_fungsi` (
  `id` int(11) NOT NULL,
  `fungsi` varchar(256) NOT NULL,
  `keterangan` text NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fungsi`
--

INSERT INTO `tb_fungsi` (`id`, `fungsi`, `keterangan`, `terdaftar`) VALUES
(1, 'ICT', 'Information, Communication and Technology', '2022-12-21 11:03:43'),
(2, 'LR', 'Legal and Relation', '2022-12-22 11:17:50'),
(3, 'PE', 'Petroleum Engineer', '2022-12-22 11:18:15'),
(4, 'SCM', 'Supply Chain Management', '2022-12-29 07:43:06'),
(5, 'HSSE', 'Health, Safety, Security, and Environmental', '2022-12-29 07:44:35'),
(6, 'Prod', 'Production', '2022-12-29 07:45:06'),
(7, 'RAM', 'Reliability, Availability and Maintainability', '2022-12-29 07:45:43'),
(8, 'Finance', 'Finance', '2022-12-29 07:46:06'),
(9, 'WOWS', 'Workover/Well Service', '2022-12-29 07:47:11'),
(10, 'Medic', 'Medical', '2022-12-29 07:47:27'),
(11, 'OPS', 'Operasional', '2022-12-29 08:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(256) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kategori`, `terdaftar`) VALUES
(1, 'Laptop', '2022-12-20 13:43:47'),
(2, 'Proyektor', '2022-12-22 11:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `ipAddress` varchar(32) NOT NULL,
  `device` text NOT NULL,
  `status` varchar(16) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `idUser`, `ipAddress`, `device`, `status`, `terdaftar`) VALUES
(1, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 13:43:23'),
(2, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 13:44:27'),
(3, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 13:44:31'),
(4, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 13:47:13'),
(5, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 13:47:17'),
(6, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 13:47:42'),
(7, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 13:47:50'),
(8, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 13:48:48'),
(9, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 13:49:00'),
(10, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:18:17'),
(11, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:18:27'),
(12, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:20:17'),
(13, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:20:21'),
(14, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:20:34'),
(15, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:20:41'),
(16, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:20:56'),
(17, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:21:01'),
(18, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:21:44'),
(19, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:24:01'),
(20, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:42:49'),
(21, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:42:54'),
(22, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 14:44:07'),
(23, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-20 14:44:10'),
(24, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-20 15:07:09'),
(25, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 01:52:13'),
(26, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 02:49:38'),
(27, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 02:49:44'),
(28, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:08:13'),
(29, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:08:17'),
(30, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:08:30'),
(31, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:08:36'),
(32, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:23:18'),
(33, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:23:23'),
(34, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:26:52'),
(35, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:26:58'),
(36, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:27:21'),
(37, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:27:29'),
(38, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:29:48'),
(39, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:29:53'),
(40, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:30:06'),
(41, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:30:10'),
(42, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 03:30:23'),
(43, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 03:30:27'),
(44, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 04:48:20'),
(45, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 04:48:26'),
(46, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:22:25'),
(47, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:22:33'),
(48, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:24:54'),
(49, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:24:59'),
(50, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:30:29'),
(51, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:30:35'),
(52, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:31:05'),
(53, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:31:09'),
(54, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:31:30'),
(55, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:31:36'),
(56, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Logout', '2022-12-22 05:31:42'),
(57, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0', 'Login', '2022-12-22 05:31:47'),
(58, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:14:26'),
(59, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:22:58'),
(60, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:23:07'),
(61, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:23:07'),
(62, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:25:24'),
(63, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:25:35'),
(64, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:27:48'),
(65, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:27:52'),
(66, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:28:50'),
(67, 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:29:08'),
(68, 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:30:05'),
(69, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:30:09'),
(70, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-22 17:37:40'),
(71, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-22 17:37:44'),
(72, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-26 15:11:37'),
(73, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-26 15:27:40'),
(74, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-26 20:37:00'),
(75, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-26 20:37:11'),
(76, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-26 20:39:21'),
(77, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-26 20:40:17'),
(78, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-26 20:52:11'),
(79, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-26 20:55:55'),
(80, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-27 21:31:39'),
(81, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 21:20:15'),
(82, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-28 21:41:05'),
(83, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 21:44:41'),
(84, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-28 21:47:37'),
(85, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 21:47:52'),
(86, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-28 22:07:26'),
(87, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 22:07:32'),
(88, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 22:09:13'),
(89, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-28 22:35:59'),
(90, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-28 22:37:16'),
(91, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2022-12-29 00:27:03'),
(92, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-29 01:06:46'),
(93, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-29 07:42:15'),
(94, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-30 13:26:55'),
(95, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-30 19:04:38'),
(96, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2022-12-31 21:44:39'),
(97, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-01 10:35:38'),
(98, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-01 11:05:56'),
(99, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-01 11:06:34'),
(100, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-01 11:07:00'),
(101, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-02 08:40:31'),
(102, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-02 08:40:55'),
(103, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-02 19:13:40'),
(104, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-02 19:15:16'),
(105, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-02 19:16:26'),
(106, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-02 19:30:30'),
(107, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 19:58:31'),
(108, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 20:00:34'),
(109, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 20:00:44'),
(110, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 20:01:51'),
(111, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:26:49'),
(112, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 21:27:43'),
(113, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:27:47'),
(114, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 21:28:06'),
(115, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:28:17'),
(116, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 21:28:35'),
(117, 6, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:29:30'),
(118, 6, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 21:30:55'),
(119, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:30:58'),
(120, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-03 21:42:18'),
(121, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-03 21:56:31'),
(122, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 07:52:05'),
(123, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 14:15:36'),
(124, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 14:58:00'),
(125, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 14:58:07'),
(126, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:00:06'),
(127, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:00:14'),
(128, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:03:26'),
(129, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:03:29'),
(130, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:05:40'),
(131, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:06:32'),
(132, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:23:42'),
(133, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:24:47'),
(134, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:24:58'),
(135, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:25:19'),
(136, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 15:29:31'),
(137, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 15:36:03'),
(138, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 16:49:10'),
(139, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 16:49:17'),
(140, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-04 16:49:35'),
(141, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-04 17:19:21'),
(142, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 01:58:21'),
(143, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:29:31'),
(144, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:29:38'),
(145, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:34:10'),
(146, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:34:12'),
(147, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:34:47'),
(148, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:34:55'),
(149, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:36:10'),
(150, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:36:13'),
(151, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:36:32'),
(152, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:36:41'),
(153, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:42:24'),
(154, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:42:26'),
(155, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:42:37'),
(156, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:42:46'),
(157, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 02:44:27'),
(158, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 02:44:29'),
(159, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 11:36:36'),
(160, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 11:44:44'),
(161, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 11:44:47'),
(162, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 11:47:15'),
(163, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 11:48:09'),
(164, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 11:48:43'),
(165, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 11:48:48'),
(166, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 11:56:32'),
(167, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-05 11:56:39'),
(168, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Logout', '2023-01-05 11:57:27'),
(169, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'Login', '2023-01-09 14:02:07'),
(170, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'Login', '2023-01-19 23:13:33'),
(171, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'Logout', '2023-01-19 23:19:58'),
(172, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'Login', '2023-01-22 22:52:55'),
(173, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:37:08'),
(174, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 11:38:46'),
(175, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:38:56'),
(176, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 11:45:06'),
(177, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:45:23'),
(178, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 11:46:13'),
(179, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:47:26'),
(180, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 11:47:39'),
(181, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:47:51'),
(182, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 11:56:04'),
(183, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 12:02:53'),
(184, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 12:03:10'),
(185, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 13:33:59'),
(186, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 13:34:01'),
(187, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 13:50:38'),
(188, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 13:50:50'),
(189, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 13:53:49'),
(190, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 13:53:53'),
(191, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Logout', '2023-06-06 13:54:10'),
(192, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 13:54:19'),
(193, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Login', '2023-06-06 18:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifikasi`
--

CREATE TABLE `tb_notifikasi` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `dibaca` varchar(32) NOT NULL,
  `tujuan` varchar(256) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_notifikasi`
--

INSERT INTO `tb_notifikasi` (`id`, `idUser`, `keterangan`, `dibaca`, `tujuan`, `terdaftar`) VALUES
(1, 2, 'Mengajukan peminjaman perangkat', 'Sudah Dibaca', 'Administrator', '2022-12-22 17:27:23'),
(3, 2, 'Pengajuan peminjaman telah direspon', 'Sudah Dibaca', 'User', '2022-12-22 17:30:35'),
(4, 3, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2022-12-22 17:31:07'),
(6, 4, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2022-12-26 20:46:21'),
(8, 1, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2022-12-27 21:36:39'),
(9, 1, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2022-12-27 21:36:48'),
(11, 1, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2022-12-27 21:41:58'),
(12, 2, 'Mengajukan peminjaman perangkat', 'Sudah Dibaca', 'Administrator', '2022-12-28 21:56:37'),
(13, 2, 'Mengajukan peminjaman perangkat', 'Sudah Dibaca', 'Administrator', '2022-12-28 22:10:15'),
(14, 2, 'Pengajuan peminjaman telah direspon', 'Sudah Dibaca', 'User', '2022-12-28 22:10:45'),
(16, 6, 'Mengajukan peminjaman perangkat', 'Sudah Dibaca', 'Administrator', '2023-01-03 21:30:00'),
(17, 6, 'Pengajuan peminjaman telah direspon', 'Belum Dibaca', 'User', '2023-01-03 21:31:23'),
(20, 1, 'Mengajukan peminjaman perangkat', 'Belum Dibaca', 'Administrator', '2023-06-06 11:40:06'),
(21, 1, 'Mengajukan peminjaman perangkat', 'Belum Dibaca', 'Administrator', '2023-06-06 13:46:41'),
(22, 2, 'Mengajukan peminjaman perangkat', 'Belum Dibaca', 'Administrator', '2023-06-06 18:21:57'),
(23, 2, 'Mengajukan peminjaman perangkat', 'Belum Dibaca', 'Administrator', '2023-06-06 18:31:35'),
(24, 2, 'Mengajukan peminjaman perangkat', 'Belum Dibaca', 'Administrator', '2023-06-06 18:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `nomor` varchar(32) NOT NULL,
  `tanggalPinjam` date NOT NULL,
  `tanggalKembali` date NOT NULL,
  `keperluan` text NOT NULL,
  `keterangan` text NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id`, `idUser`, `nomor`, `tanggalPinjam`, `tanggalKembali`, `keperluan`, `keterangan`, `terdaftar`) VALUES
(4, 2, '20221', '2022-12-22', '2022-12-23', 'Dinas luar', 'Perlu untuk kepentingan dinas', '2022-12-22 17:27:23'),
(9, 2, '20229', '2022-12-30', '2023-01-02', 'Rapat', 'Rapat outdoor', '2022-12-28 21:56:37'),
(10, 2, '202210', '2022-12-28', '2022-12-29', 'Sosialisasi', 'Perlu untuk acara sosialisasi aplikasi', '2022-12-28 22:10:15'),
(12, 6, '202311', '2023-01-03', '2023-01-04', 'Dinas Luar', '-', '2023-01-03 21:30:00'),
(16, 1, '202313', '2023-06-06', '2023-06-07', 'Dinas Luar', 'Supply Chain Management', '2023-06-06 13:46:41'),
(19, 2, '202317', '2023-06-06', '2023-06-07', 'Kursus', 'Supply Chain Management', '2023-06-06 18:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perangkat`
--

CREATE TABLE `tb_perangkat` (
  `id` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(11) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_perangkat`
--

INSERT INTO `tb_perangkat` (`id`, `idKategori`, `nama`, `deskripsi`, `stok`, `terdaftar`) VALUES
(1, 1, 'HP 348 G4 Core i5', 'Lengkap bersama dengan charger, mouse dan tas', 6, '2022-12-20 13:44:23'),
(2, 2, 'Epson Projector EB-U42', 'Lengkap dengan kabel HDMI dan tas', 1, '2022-12-20 13:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tokens`
--

CREATE TABLE `tb_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tb_user_id` int(10) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_tokens`
--

INSERT INTO `tb_tokens` (`id`, `token`, `tb_user_id`, `created`) VALUES
(1, '6e802bd82829fc9d5eecb1d4d60d82', 4, '2022-12-26'),
(2, '866bf91b2eb8b07615c34c6addb885', 4, '2022-12-26'),
(3, '0b44c62970d4edde12b5341adfaca2', 2, '2023-01-04'),
(4, '7c31622b616177ac4485f1862021da', 2, '2023-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `idFungsi` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `skin` varchar(8) NOT NULL,
  `level` varchar(16) NOT NULL,
  `terdaftar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `idFungsi`, `nama`, `telp`, `email`, `username`, `password`, `foto`, `skin`, `level`, `terdaftar`) VALUES
(1, 0, 'Admin', '081234567890', 'kerjapraktik17@gmail.com', 'admin', '$2y$10$tPaAMNwz8CCTVQaJ9WSuSOA7dhXPRJW0MSL/hKzrotArgnuHbli1O', 'no-image.png', 'blue', 'Administrator', '2022-12-20 04:31:24'),
(2, 1, 'Windi Nurmalasari', '089629258285', 'windinurmalasari@gmail.com', 'user', '$2y$10$eHjCpJpXM4BUge1zz0e0QO7LiSAo/1E1fhmdEpPIhwZhJe6TRSd/O', 'no-image.png', 'purple', 'User', '2022-12-20 13:43:40'),
(6, 6, 'Arief Ginanjar', '081234567890', 'ariefginanjar@gmail.com', 'arief', '$2y$10$KyxY5NNEHvhSViGvnYdkXevZTD.vzME85xCupkTE/2PmhEzdxtRgS', 'no-image.png', 'blue', 'User', '2023-01-03 21:29:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_backupdb`
--
ALTER TABLE `tb_backupdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_dipinjam`
--
ALTER TABLE `tb_dipinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fungsi`
--
ALTER TABLE `tb_fungsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tokens`
--
ALTER TABLE `tb_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_aplikasi`
--
ALTER TABLE `tb_aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_backupdb`
--
ALTER TABLE `tb_backupdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_dipinjam`
--
ALTER TABLE `tb_dipinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_fungsi`
--
ALTER TABLE `tb_fungsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `tb_notifikasi`
--
ALTER TABLE `tb_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_perangkat`
--
ALTER TABLE `tb_perangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tokens`
--
ALTER TABLE `tb_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
