-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2024 pada 05.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_keanggotaan_gridk2`
--

CREATE TABLE `fungsi_keanggotaan_gridk2` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama_fungsi` varchar(50) DEFAULT NULL,
  `huruf` varchar(1) DEFAULT NULL,
  `subscript` int(11) DEFAULT NULL,
  `superscript` int(11) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_gridk2`
--

INSERT INTO `fungsi_keanggotaan_gridk2` (`id`, `jenis`, `nama_fungsi`, `huruf`, `subscript`, `superscript`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(1, 'Permintaan', 'Sangat Berkurang', 'D', 1, 4, 'Menurun', 2300, NULL, 4000, '2024-09-22 14:11:14'),
(2, 'Permintaan', 'Berkurang', 'D', 1, 3, 'Segitiga', 3200, 4000, 4800, '2024-09-22 14:11:14'),
(3, 'Permintaan', 'Meningkat', 'D', 1, 2, 'Segitiga', 4000, 4800, 5600, '2024-09-22 14:11:14'),
(4, 'Permintaan', 'Sangat Meningkat', 'D', 1, 1, 'Menaik', 4800, NULL, 6500, '2024-09-22 14:11:14'),
(5, 'Stok', 'Sangat Sedikit', 'S', 1, 4, 'Menurun', 120, NULL, 310, '2024-09-22 14:25:17'),
(6, 'Stok', 'Sedikit', 'S', 1, 3, 'Segitiga', 220, 310, 400, '2024-09-22 14:25:17'),
(7, 'Stok', 'Banyak', 'S', 1, 2, 'Segitiga', 310, 400, 490, '2024-09-22 14:25:17'),
(8, 'Stok', 'Sangat Banyak', 'S', 1, 1, 'Menaik', 400, NULL, 590, '2024-09-22 14:25:17'),
(9, 'Produksi', 'Sangat Berkurang', 'P', 1, 4, 'Menurun', 2000, NULL, 4000, '2024-09-22 14:35:18'),
(10, 'Produksi', 'Berkurang', 'P', 1, 3, 'Segitiga', 3000, 4000, 5000, '2024-09-22 14:35:18'),
(11, 'Produksi', 'Meningkat', 'P', 1, 2, 'Segitiga', 4000, 5000, 6000, '2024-09-22 14:35:18'),
(12, 'Produksi', 'Sangat Meningkat', 'P', 1, 1, 'Menaik', 5000, NULL, 7150, '2024-09-22 14:35:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_keanggotaan_gridk3`
--

CREATE TABLE `fungsi_keanggotaan_gridk3` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama_fungsi` varchar(50) DEFAULT NULL,
  `huruf` varchar(1) DEFAULT NULL,
  `subscript` int(11) DEFAULT NULL,
  `superscript` int(11) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_gridk3`
--

INSERT INTO `fungsi_keanggotaan_gridk3` (`id`, `jenis`, `nama_fungsi`, `huruf`, `subscript`, `superscript`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(17, 'Stok', 'Sangat Sedikit Sekali', 'S', 1, 8, 'Menurun', 120, NULL, 225, '2024-09-20 20:19:20'),
(18, 'Stok', 'Sangat Sedikit', 'S', 1, 7, 'Segitiga', 173, 225, 277, '2024-09-20 20:19:20'),
(19, 'Stok', 'Cukup Sedikit', 'S', 1, 6, 'Segitiga', 225, 277, 329, '2024-09-20 20:19:20'),
(20, 'Stok', 'Sedikit', 'S', 1, 5, 'Segitiga', 277, 329, 381, '2024-09-20 20:19:20'),
(21, 'Stok', 'Cukup Banyak', 'S', 1, 4, 'Segitiga', 329, 381, 433, '2024-09-20 20:19:20'),
(22, 'Stok', 'Banyak', 'S', 1, 3, 'Segitiga', 381, 433, 485, '2024-09-20 20:19:20'),
(23, 'Stok', 'Sangat Banyak', 'S', 1, 2, 'Segitiga', 433, 485, 537, '2024-09-20 20:19:20'),
(24, 'Stok', 'Sangat Banyak Sekali', 'S', 1, 1, 'Menaik', 485, NULL, 590, '2024-09-20 20:19:20'),
(25, 'Permintaan', 'Sangat Berkurang Sekali', 'D', 1, 8, 'Menurun', 2300, NULL, 3235, '2024-09-21 17:05:20'),
(26, 'Permintaan', 'Sangat Berkurang', 'D', 1, 7, 'Segitiga', 2770, 3235, 3700, '2024-09-21 17:05:20'),
(27, 'Permintaan', 'Cukup Berkurang', 'D', 1, 6, 'Segitiga', 3235, 3700, 4165, '2024-09-21 17:05:20'),
(28, 'Permintaan', 'Berkurang', 'D', 1, 5, 'Segitiga', 3700, 4165, 4630, '2024-09-21 17:05:20'),
(29, 'Permintaan', 'Cukup Meningkat', 'D', 1, 4, 'Segitiga', 4165, 4630, 5090, '2024-09-21 17:05:20'),
(30, 'Permintaan', 'Meningkat', 'D', 1, 3, 'Segitiga', 4630, 5090, 5560, '2024-09-21 17:05:20'),
(31, 'Permintaan', 'Sangat Meningkat', 'D', 1, 2, 'Segitiga', 5090, 5560, 6025, '2024-09-21 17:05:20'),
(32, 'Permintaan', 'Sangat Meningkat Sekali', 'D', 1, 1, 'Menaik', 5560, NULL, 6500, '2024-09-21 17:05:20'),
(33, 'Produksi', 'Sangat Berkurang Sekali', 'P', 1, 8, 'Menurun', 2000, NULL, 3145, '2024-09-21 17:23:17'),
(34, 'Produksi', 'Sangat Berkurang', 'P', 1, 7, 'Segitiga', 2573, 3145, 3717, '2024-09-21 17:23:17'),
(35, 'Produksi', 'Cukup Berkurang', 'P', 1, 6, 'Segitiga', 3145, 3717, 4289, '2024-09-21 17:23:17'),
(36, 'Produksi', 'Berkurang', 'P', 1, 5, 'Segitiga', 3717, 4289, 4861, '2024-09-21 17:23:17'),
(37, 'Produksi', 'Cukup Meningkat', 'P', 1, 4, 'Segitiga', 4289, 4861, 5433, '2024-09-21 17:23:17'),
(38, 'Produksi', 'Meningkat', 'P', 1, 3, 'Segitiga', 4861, 5433, 6005, '2024-09-21 17:23:17'),
(39, 'Produksi', 'Sangat Meningkat', 'P', 1, 2, 'Segitiga', 5433, 6005, 6577, '2024-09-21 17:23:17'),
(40, 'Produksi', 'Sangat Meningkat Sekali', 'P', 1, 1, 'Menaik', 6005, NULL, 7150, '2024-09-21 17:23:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_keanggotaan_tsukamoto`
--

CREATE TABLE `fungsi_keanggotaan_tsukamoto` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama_fungsi` varchar(50) DEFAULT NULL,
  `huruf` varchar(1) DEFAULT NULL,
  `subscript` int(11) DEFAULT NULL,
  `superscript` int(11) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_tsukamoto`
--

INSERT INTO `fungsi_keanggotaan_tsukamoto` (`id`, `jenis`, `nama_fungsi`, `huruf`, `subscript`, `superscript`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(1, 'Permintaan', 'Berkurang', 'D', 1, NULL, 'Menurun', 2300, NULL, 6500, '2024-09-22 14:50:55'),
(2, 'Permintaan', 'Meningkat', 'D', 2, NULL, 'Menaik', 2300, NULL, 6500, '2024-09-22 14:50:55'),
(3, 'Stok', 'Sedikit', 'S', 1, NULL, 'Menurun', 120, NULL, 590, '2024-09-22 15:03:03'),
(4, 'Stok', 'Banyak', 'S', 2, NULL, 'Menaik', 120, NULL, 590, '2024-09-22 15:03:03'),
(5, 'Produksi', 'Berkurang', 'P', 1, NULL, 'Menurun', 2000, NULL, 7150, '2024-09-22 15:12:44'),
(6, 'Produksi', 'Meningkat', 'P', 2, NULL, 'Menaik', 2000, NULL, 7150, '2024-09-22 15:12:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_variabel`
--

CREATE TABLE `pengaturan_variabel` (
  `id` int(11) NOT NULL,
  `nama_variabel` varchar(50) NOT NULL,
  `nilai_variabel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan_variabel`
--

INSERT INTO `pengaturan_variabel` (`id`, `nama_variabel`, `nilai_variabel`) VALUES
(4, 'stok_maksimum', 590),
(5, 'permintaan', 3900),
(6, 'stok', 310);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_gridk2`
--

CREATE TABLE `rule_gridk2` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,3) DEFAULT NULL,
  `z1` decimal(10,3) DEFAULT NULL,
  `z2` decimal(10,3) DEFAULT NULL,
  `z` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_gridk2`
--

INSERT INTO `rule_gridk2` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'Sangat Berkurang', 'Banyak', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R10', 'Meningkat', 'Sangat Banyak', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R11', 'Sangat Meningkat', 'Banyak', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R12', 'Sangat Meningkat', 'Sangat Banyak', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R13', 'Meningkat', 'Sangat Sedikit', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R14', 'Meningkat', 'Sedikit', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R15', 'Sangat Meningkat', 'Sangat Sedikit', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R16', 'Sangat Meningkat', 'Sedikit', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R2', 'Sangat Berkurang', 'Sangat Banyak', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R3', 'Berkurang', 'Banyak', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R4', 'Berkurang', 'Sangat Banyak', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R5', 'Sangat Berkurang', 'Sangat Sedikit', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R6', 'Sangat Berkurang', 'Sedikit', 'Sangat Berkurang', 0.059, 0.000, 0.000, 3882.000),
('R7', 'Berkurang', 'Sangat Sedikit', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R8', 'Berkurang', 'Sedikit', 'Berkurang', 0.875, 3875.000, 4125.000, 8000.000),
('R9', 'Meningkat', 'Banyak', 'Meningkat', 0.000, 0.000, 0.000, 0.000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_gridk3`
--

CREATE TABLE `rule_gridk3` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,3) DEFAULT NULL,
  `z1` decimal(10,3) DEFAULT NULL,
  `z2` decimal(10,3) DEFAULT NULL,
  `z` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_gridk3`
--

INSERT INTO `rule_gridk3` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'Sangat Berkurang Sekali', 'Cukup Banyak', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R10', 'Cukup Berkurang', 'Banyak', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000),
('R11', 'Cukup Berkurang', 'Sangat Banyak', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000),
('R12', 'Cukup Berkurang', 'Sangat Banyak Sekali', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000),
('R13', 'Berkurang', 'Cukup Banyak', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R14', 'Berkurang', 'Banyak', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R15', 'Berkurang', 'Sangat Banyak', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R16', 'Berkurang', 'Sangat Banyak Sekali', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R17', 'Sangat Berkurang Sekali', 'Sangat Sedikit Sekali', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R18', 'Sangat Berkurang Sekali', 'Sangat Sedikit', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R19', 'Sangat Berkurang Sekali', 'Cukup Sedikit', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R2', 'Sangat Berkurang Sekali', 'Banyak', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R20', 'Sangat Berkurang Sekali', 'Sedikit', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R21', 'Sangat Berkurang', 'Sangat Sedikit Sekali', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R22', 'Sangat Berkurang', 'Sangat Sedikit', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R23', 'Sangat Berkurang', 'Cukup Sedikit', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R24', 'Sangat Berkurang', 'Sedikit', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R25', 'Cukup Berkurang', 'Sangat Sedikit Sekali', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000),
('R26', 'Cukup Berkurang', 'Sangat Sedikit', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000),
('R27', 'Cukup Berkurang', 'Cukup Sedikit', 'Cukup Berkurang', 0.365, 3353.780, 4080.220, 7434.000),
('R28', 'Cukup Berkurang', 'Sedikit', 'Cukup Berkurang', 0.570, 3471.040, 3962.960, 7434.000),
('R29', 'Berkurang', 'Sangat Sedikit Sekali', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R3', 'Sangat Berkurang Sekali', 'Sangat Banyak', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R30', 'Berkurang', 'Sangat Sedikit', 'Berkurang', 0.000, 0.000, 0.000, 0.000),
('R31', 'Berkurang', 'Cukup Sedikit', 'Berkurang', 0.365, 3925.780, 4652.220, 8578.000),
('R32', 'Berkurang', 'Sedikit', 'Berkurang', 0.430, 3962.960, 4615.040, 8578.000),
('R33', 'Cukup Meningkat', 'Cukup Banyak', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R34', 'Cukup Meningkat', 'Banyak', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R35', 'Cukup Meningkat', 'Sangat Banyak', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R36', 'Cukup Meningkat', 'Sangat Banyak Sekali', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R37', 'Meningkat', 'Cukup Banyak', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R38', 'Meningkat', 'Banyak', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R39', 'Meningkat', 'Sangat Banyak', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R4', 'Sangat Berkurang Sekali', 'Sangat Banyak Sekali', 'Sangat Berkurang Sekali', 0.000, 0.000, 0.000, 0.000),
('R40', 'Meningkat', 'Sangat Banyak Sekali', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R41', 'Sangat Meningkat', 'Cukup Banyak', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R42', 'Sangat Meningkat', 'Banyak', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R43', 'Sangat Meningkat', 'Sangat Banyak', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R44', 'Sangat Meningkat', 'Sangat Banyak Sekali', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R45', 'Sangat Meningkat Sekali', 'Cukup Banyak', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R46', 'Sangat Meningkat Sekali', 'Banyak', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R47', 'Sangat Meningkat Sekali', 'Sangat Banyak', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R48', 'Sangat Meningkat Sekali', 'Sangat Banyak Sekali', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R49', 'Cukup Meningkat', 'Sangat Sedikit Sekali', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R5', 'Sangat Berkurang', 'Cukup Banyak', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R50', 'Cukup Meningkat', 'Sangat Sedikit', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R51', 'Cukup Meningkat', 'Cukup Sedikit', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R52', 'Cukup Meningkat', 'Sedikit', 'Cukup Meningkat', 0.000, 0.000, 0.000, 0.000),
('R53', 'Meningkat', 'Sangat Sedikit Sekali', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R54', 'Meningkat', 'Sangat Sedikit', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R55', 'Meningkat', 'Cukup Sedikit', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R56', 'Meningkat', 'Sedikit', 'Meningkat', 0.000, 0.000, 0.000, 0.000),
('R57', 'Sangat Meningkat', 'Sangat Sedikit Sekali', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R58', 'Sangat Meningkat', 'Sangat Sedikit', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R59', 'Sangat Meningkat', 'Cukup Sedikit', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R6', 'Sangat Berkurang', 'Banyak', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R60', 'Sangat Meningkat', 'Sedikit', 'Sangat Meningkat', 0.000, 0.000, 0.000, 0.000),
('R61', 'Sangat Meningkat Sekali', 'Sangat Sedikit Sekali', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R62', 'Sangat Meningkat Sekali', 'Sangat Sedikit', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R63', 'Sangat Meningkat Sekali', 'Cukup Sedikit', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R64', 'Sangat Meningkat Sekali', 'Sedikit', 'Sangat Meningkat Sekali', 0.000, 0.000, 0.000, 0.000),
('R7', 'Sangat Berkurang', 'Sangat Banyak', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R8', 'Sangat Berkurang', 'Sangat Banyak Sekali', 'Sangat Berkurang', 0.000, 0.000, 0.000, 0.000),
('R9', 'Cukup Berkurang', 'Cukup Banyak', 'Cukup Berkurang', 0.000, 0.000, 0.000, 0.000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_tsukamoto`
--

CREATE TABLE `rule_tsukamoto` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,3) DEFAULT NULL,
  `z1` decimal(10,3) DEFAULT NULL,
  `z2` decimal(10,3) DEFAULT NULL,
  `z` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_tsukamoto`
--

INSERT INTO `rule_tsukamoto` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'Berkurang', 'Banyak', 'Berkurang', 0.404, 0.000, 0.000, 5069.400),
('R2', 'Berkurang', 'Sedikit', 'Berkurang', 0.596, 0.000, 0.000, 4080.600),
('R3', 'Meningkat', 'Banyak', 'Meningkat', 0.381, 0.000, 0.000, 3962.150),
('R4', 'Meningkat', 'Sedikit', 'Meningkat', 0.381, 0.000, 0.000, 3962.150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Murni Marbun', 'murni', '$2b$12$JnX8Qyje4LorKdGbdLqA9uj7KOEJAC9wvsBFGdmpPWXbc8yiU3CkK', 'admin', '2024-09-20 13:18:56'),
(2, 'M. Yamin', 'yamin', '$2y$10$OYe6hCklPFJn/bGMa8XLBeWoon1iwrpd8vTVEPLGry5qliD.XuRT2', 'admin', '2024-09-21 04:55:33'),
(5, 'User', 'user', '$2y$10$goTX80z8srcAyQl4YCzj3.vtGM7St57P8EoJI8BthROF0DnS3iLze', 'user', '2024-09-26 16:30:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `fungsi_keanggotaan_gridk2`
--
ALTER TABLE `fungsi_keanggotaan_gridk2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fungsi_keanggotaan_gridk3`
--
ALTER TABLE `fungsi_keanggotaan_gridk3`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fungsi_keanggotaan_tsukamoto`
--
ALTER TABLE `fungsi_keanggotaan_tsukamoto`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan_variabel`
--
ALTER TABLE `pengaturan_variabel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rule_gridk2`
--
ALTER TABLE `rule_gridk2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rule_gridk3`
--
ALTER TABLE `rule_gridk3`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rule_tsukamoto`
--
ALTER TABLE `rule_tsukamoto`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_gridk2`
--
ALTER TABLE `fungsi_keanggotaan_gridk2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_gridk3`
--
ALTER TABLE `fungsi_keanggotaan_gridk3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_tsukamoto`
--
ALTER TABLE `fungsi_keanggotaan_tsukamoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_variabel`
--
ALTER TABLE `pengaturan_variabel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
