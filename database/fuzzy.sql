-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2024 pada 06.38
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
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_gridk2`
--

INSERT INTO `fungsi_keanggotaan_gridk2` (`id`, `jenis`, `nama_fungsi`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(1, 'Permintaan', 'SK', 'Menurun', 2300, NULL, 4000, '2024-09-22 14:11:14'),
(2, 'Permintaan', 'K', 'Segitiga', 3200, 4000, 4800, '2024-09-22 14:11:14'),
(3, 'Permintaan', 'M', 'Segitiga', 4000, 4800, 5600, '2024-09-22 14:11:14'),
(4, 'Permintaan', 'SM', 'Menaik', 4800, NULL, 6500, '2024-09-22 14:11:14'),
(5, 'Stok', 'SD', 'Menurun', 120, NULL, 310, '2024-09-22 14:25:17'),
(6, 'Stok', 'D', 'Segitiga', 220, 310, 400, '2024-09-22 14:25:17'),
(7, 'Stok', 'B', 'Segitiga', 310, 400, 490, '2024-09-22 14:25:17'),
(8, 'Stok', 'SB', 'Menaik', 400, NULL, 590, '2024-09-22 14:25:17'),
(9, 'Produksi', 'SK', 'Menurun', 2000, NULL, 4000, '2024-09-22 14:35:18'),
(10, 'Produksi', 'K', 'Segitiga', 3000, 4000, 5000, '2024-09-22 14:35:18'),
(11, 'Produksi', 'M', 'Segitiga', 4000, 5000, 6000, '2024-09-22 14:35:18'),
(12, 'Produksi', 'SM', 'Menaik', 5000, NULL, 7150, '2024-09-22 14:35:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_keanggotaan_gridk3`
--

CREATE TABLE `fungsi_keanggotaan_gridk3` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama_fungsi` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_gridk3`
--

INSERT INTO `fungsi_keanggotaan_gridk3` (`id`, `jenis`, `nama_fungsi`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(17, 'Stok', 'SDS', 'Menurun', 120, NULL, 225, '2024-09-20 20:19:20'),
(18, 'Stok', 'SD', 'Segitiga', 173, 225, 277, '2024-09-20 20:19:20'),
(19, 'Stok', 'CD', 'Segitiga', 225, 277, 329, '2024-09-20 20:19:20'),
(20, 'Stok', 'D', 'Segitiga', 277, 329, 381, '2024-09-20 20:19:20'),
(21, 'Stok', 'CB', 'Segitiga', 329, 381, 433, '2024-09-20 20:19:20'),
(22, 'Stok', 'B', 'Segitiga', 381, 433, 485, '2024-09-20 20:19:20'),
(23, 'Stok', 'SB', 'Segitiga', 433, 485, 537, '2024-09-20 20:19:20'),
(24, 'Stok', 'SBS', 'Menaik', 485, NULL, 590, '2024-09-20 20:19:20'),
(25, 'Permintaan', 'SKS', 'Menurun', 2300, NULL, 3235, '2024-09-21 17:05:20'),
(26, 'Permintaan', 'SK', 'Segitiga', 2770, 3235, 3700, '2024-09-21 17:05:20'),
(27, 'Permintaan', 'CK', 'Segitiga', 3235, 3700, 4165, '2024-09-21 17:05:20'),
(28, 'Permintaan', 'K', 'Segitiga', 3700, 4165, 4630, '2024-09-21 17:05:20'),
(29, 'Permintaan', 'CM', 'Segitiga', 4165, 4630, 5090, '2024-09-21 17:05:20'),
(30, 'Permintaan', 'M', 'Segitiga', 4630, 5090, 5560, '2024-09-21 17:05:20'),
(31, 'Permintaan', 'SM', 'Segitiga', 5090, 5560, 6025, '2024-09-21 17:05:20'),
(32, 'Permintaan', 'SMS', 'Menaik', 5560, NULL, 6500, '2024-09-21 17:05:20'),
(33, 'Produksi', 'SKS', 'Menurun', 2000, NULL, 3145, '2024-09-21 17:23:17'),
(34, 'Produksi', 'SK', 'Segitiga', 2573, 3145, 3717, '2024-09-21 17:23:17'),
(35, 'Produksi', 'CK', 'Segitiga', 3145, 3717, 4289, '2024-09-21 17:23:17'),
(36, 'Produksi', 'K', 'Segitiga', 3717, 4289, 4861, '2024-09-21 17:23:17'),
(37, 'Produksi', 'CM', 'Segitiga', 4289, 4861, 5433, '2024-09-21 17:23:17'),
(38, 'Produksi', 'M', 'Segitiga', 4861, 5433, 6005, '2024-09-21 17:23:17'),
(39, 'Produksi', 'SM', 'Segitiga', 5433, 6005, 6577, '2024-09-21 17:23:17'),
(40, 'Produksi', 'SMS', 'Menaik', 6005, NULL, 7150, '2024-09-21 17:23:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_keanggotaan_tsukamoto`
--

CREATE TABLE `fungsi_keanggotaan_tsukamoto` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `nama_fungsi` varchar(50) DEFAULT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) DEFAULT NULL,
  `batas_atas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_keanggotaan_tsukamoto`
--

INSERT INTO `fungsi_keanggotaan_tsukamoto` (`id`, `jenis`, `nama_fungsi`, `tipe`, `batas_bawah`, `batas_tengah`, `batas_atas`, `created_at`) VALUES
(1, 'Permintaan', 'Berkurang', 'Menurun', 2300, NULL, 6500, '2024-09-22 14:50:55'),
(2, 'Permintaan', 'Meningkat', 'Menaik', 2300, NULL, 6500, '2024-09-22 14:50:55'),
(3, 'Stok', 'Sedikit', 'Menurun', 120, NULL, 590, '2024-09-22 15:03:03'),
(4, 'Stok', 'Banyak', 'Menaik', 120, NULL, 590, '2024-09-22 15:03:03'),
(5, 'Produksi', 'Berkurang', 'Menurun', 2000, NULL, 7150, '2024-09-22 15:12:44'),
(6, 'Produksi', 'Meningkat', 'Menaik', 2000, NULL, 7150, '2024-09-22 15:12:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_gridk2`
--

CREATE TABLE `rule_gridk2` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,4) DEFAULT NULL,
  `z1` decimal(10,4) DEFAULT NULL,
  `z2` decimal(10,4) DEFAULT NULL,
  `z` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_gridk2`
--

INSERT INTO `rule_gridk2` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'SK', 'B', 'SK', NULL, NULL, NULL, 0.0000),
('R10', 'M', 'SB', 'M', NULL, NULL, NULL, 0.0000),
('R11', 'SM', 'B', 'SM', NULL, NULL, NULL, 0.0000),
('R12', 'SM', 'SB', 'SM', NULL, NULL, NULL, 0.0000),
('R13', 'M', 'SD', 'M', NULL, NULL, NULL, 0.0000),
('R14', 'M', 'D', 'M', NULL, NULL, NULL, 0.0000),
('R15', 'SM', 'SD', 'SM', NULL, NULL, NULL, 0.0000),
('R16', 'SM', 'D', 'SM', NULL, NULL, NULL, 0.0000),
('R2', 'SK', 'SB', 'SK', NULL, NULL, NULL, 0.0000),
('R3', 'K', 'B', 'K', NULL, NULL, NULL, 0.0000),
('R4', 'K', 'SB', 'K', NULL, NULL, NULL, 0.0000),
('R5', 'SK', 'SD', 'SK', NULL, NULL, NULL, 0.0000),
('R6', 'SK', 'D', 'SK', NULL, NULL, NULL, 0.0000),
('R7', 'K', 'SD', 'K', NULL, NULL, NULL, 0.0000),
('R8', 'K', 'D', 'K', NULL, NULL, NULL, 0.0000),
('R9', 'M', 'B', 'M', NULL, NULL, NULL, 0.0000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_gridk3`
--

CREATE TABLE `rule_gridk3` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,4) DEFAULT NULL,
  `z1` decimal(10,4) DEFAULT NULL,
  `z2` decimal(10,4) DEFAULT NULL,
  `z` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_gridk3`
--

INSERT INTO `rule_gridk3` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'SKS', 'CB', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R10', 'CK', 'B', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R11', 'CK', 'SB', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R12', 'CK', 'SBS', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R13', 'K', 'CB', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R14', 'K', 'B', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R15', 'K', 'SB', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R16', 'K', 'SBS', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R17', 'SKS', 'SDS', 'SKS', 0.2381, 0.0000, 0.0000, 2872.3810),
('R18', 'SKS', 'SD', 'SKS', 0.5192, 0.0000, 0.0000, 2550.4808),
('R19', 'SKS', 'CD', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R2', 'SKS', 'B', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R20', 'SKS', 'D', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R21', 'SK', 'SDS', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R22', 'SK', 'SD', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R23', 'SK', 'CD', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R24', 'SK', 'D', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R25', 'CK', 'SDS', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R26', 'CK', 'SD', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R27', 'CK', 'CD', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R28', 'CK', 'D', 'CK', 0.0000, 0.0000, 0.0000, 0.0000),
('R29', 'K', 'SDS', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R3', 'SKS', 'SB', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R30', 'K', 'SD', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R31', 'K', 'CD', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R32', 'K', 'D', 'K', 0.0000, 0.0000, 0.0000, 0.0000),
('R33', 'CM', 'CB', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R34', 'CM', 'B', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R35', 'CM', 'SB', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R36', 'CM', 'SBS', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R37', 'M', 'CB', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R38', 'M', 'B', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R39', 'M', 'SB', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R4', 'SKS', 'SBS', 'SKS', 0.0000, 0.0000, 0.0000, 0.0000),
('R40', 'M', 'SBS', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R41', 'SM', 'CB', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R42', 'SM', 'B', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R43', 'SM', 'SB', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R44', 'SM', 'SBS', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R45', 'SMS', 'CB', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R46', 'SMS', 'B', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R47', 'SMS', 'SB', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R48', 'SMS', 'SBS', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R49', 'CM', 'SDS', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R5', 'SK', 'CB', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R50', 'CM', 'SD', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R51', 'CM', 'CD', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R52', 'CM', 'D', 'CM', 0.0000, 0.0000, 0.0000, 0.0000),
('R53', 'M', 'SDS', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R54', 'M', 'SD', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R55', 'M', 'CD', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R56', 'M', 'D', 'M', 0.0000, 0.0000, 0.0000, 0.0000),
('R57', 'SM', 'SDS', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R58', 'SM', 'SD', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R59', 'SM', 'CD', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R6', 'SK', 'B', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R60', 'SM', 'D', 'SM', 0.0000, 0.0000, 0.0000, 0.0000),
('R61', 'SMS', 'SDS', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R62', 'SMS', 'SD', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R63', 'SMS', 'CD', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R64', 'SMS', 'D', 'SMS', 0.0000, 0.0000, 0.0000, 0.0000),
('R7', 'SK', 'SB', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R8', 'SK', 'SBS', 'SK', 0.0000, 0.0000, 0.0000, 0.0000),
('R9', 'CK', 'CB', 'CK', 0.0000, 0.0000, 0.0000, 0.0000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rule_tsukamoto`
--

CREATE TABLE `rule_tsukamoto` (
  `id` varchar(10) NOT NULL,
  `permintaan` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `produksi` varchar(50) NOT NULL,
  `alpha_predikat` decimal(10,4) DEFAULT NULL,
  `z1` decimal(10,4) DEFAULT NULL,
  `z2` decimal(10,4) DEFAULT NULL,
  `z` decimal(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rule_tsukamoto`
--

INSERT INTO `rule_tsukamoto` (`id`, `permintaan`, `stok`, `produksi`, `alpha_predikat`, `z1`, `z2`, `z`) VALUES
('R1', 'Berkurang', 'Banyak', 'Berkurang', NULL, NULL, NULL, 0.0000),
('R2', 'Berkurang', 'Sedikit', 'Berkurang', NULL, NULL, NULL, 0.0000),
('R3', 'Meningkat', 'Banyak', 'Meningkat', NULL, NULL, NULL, 0.0000),
('R4', 'Meningkat', 'Sedikit', 'Meningkat', NULL, NULL, NULL, 0.0000);

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
(2, 'M. Yamin', 'yamin', '$2b$12$JnX8Qyje4LorKdGbdLqA9uj7KOEJAC9wvsBFGdmpPWXbc8yiU3CkK', 'admin', '2024-09-21 04:55:33');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_gridk3`
--
ALTER TABLE `fungsi_keanggotaan_gridk3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_tsukamoto`
--
ALTER TABLE `fungsi_keanggotaan_tsukamoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
