-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Sep 2024 pada 19.28
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
-- Indeks untuk tabel `fungsi_keanggotaan_gridk3`
--
ALTER TABLE `fungsi_keanggotaan_gridk3`
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
-- AUTO_INCREMENT untuk tabel `fungsi_keanggotaan_gridk3`
--
ALTER TABLE `fungsi_keanggotaan_gridk3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
