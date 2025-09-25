-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Jan 2025 pada 08.50
-- Versi server: 8.0.30
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendataan_tamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id` int NOT NULL,
  `no` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_id` varchar(50) NOT NULL,
  `jumlah` int NOT NULL,
  `perusahaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kendaraan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bertemu_dengan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sudah_buat_janji` enum('Sudah','Belum') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Belum',
  `keperluan` text,
  `tanggal_bertemu` date DEFAULT NULL,
  `jam_bertemu` time DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `status` enum('In','Out','Wait') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Wait',
  `qr_code` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`id`, `no`, `nama`, `no_id`, `jumlah`, `perusahaan`, `nomor_kendaraan`, `jenis_kendaraan`, `bertemu_dengan`, `sudah_buat_janji`, `keperluan`, `tanggal_bertemu`, `jam_bertemu`, `tanggal_masuk`, `tanggal_keluar`, `status`, `qr_code`, `created_at`) VALUES
(228, '20250122-001', 'Muhammad Riza Dwi Prasetia', '22416255201147', 3, 'PT ELASTOMIX IND', 'T 6023 SW', 'MOTOR', 'BPK AGAN', 'Sudah', 'meeting\r\n', '2025-01-22', '10:00:00', '2025-01-22', NULL, 'In', '../assets/qr/20250122-001.png', '2025-01-22 04:08:43'),
(229, '20250122-002', 'Muhammad Riza Dwi Prasetiaaaaa', '22416255201147', 3, 'PT ELASTOMIX IND', 'T 6023 SW', 'MOTOR', 'BPK AGAN', 'Sudah', 'meeting\r\n', '2025-01-22', '10:00:00', '2025-01-22', '2025-01-22 14:41:56', 'Out', '../assets/qr/20250122-002.png', '2025-01-22 04:09:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'petugas',
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama_lengkap`, `email`) VALUES
(1, 'petugas', '123', 'petugas', '', ''),
(2, 'riza', '123', 'petugas', 'Muhammad riza dwi prasetia', 'prasetyagna@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
