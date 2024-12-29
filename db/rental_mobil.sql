-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2024 pada 10.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mobil_tryandaasu`
--

CREATE TABLE `tbl_mobil_tryandaasu` (
  `no_plat_tryandaasu` varchar(10) NOT NULL,
  `nama_mobil_tryandaasu` varchar(25) DEFAULT NULL,
  `brand_mobil_tryandaasu` varchar(25) DEFAULT NULL,
  `tipe_transmisi_tryandaasu` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_mobil_tryandaasu`
--

INSERT INTO `tbl_mobil_tryandaasu` (`no_plat_tryandaasu`, `nama_mobil_tryandaasu`, `brand_mobil_tryandaasu`, `tipe_transmisi_tryandaasu`) VALUES
('a23232', 'Avanza JIN TUA', 'BANGLADESH', 'Manual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan_tryandaasu`
--

CREATE TABLE `tbl_pelanggan_tryandaasu` (
  `nik_ktp_tryandaasu` varchar(16) NOT NULL,
  `nama_tryandaasu` varchar(35) DEFAULT NULL,
  `no_hp_tryandaasu` varchar(15) DEFAULT NULL,
  `alamat_tryandaasu` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pelanggan_tryandaasu`
--

INSERT INTO `tbl_pelanggan_tryandaasu` (`nik_ktp_tryandaasu`, `nama_tryandaasu`, `no_hp_tryandaasu`, `alamat_tryandaasu`) VALUES
('2222222222222222', 'Tryanda Anggita Suwito', '08119191919', 'Banjar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rental_tryandaasu`
--

CREATE TABLE `tbl_rental_tryandaasu` (
  `no_trx_tryandaasu` varchar(20) NOT NULL,
  `nik_ktp_tryandaasu` varchar(16) DEFAULT NULL,
  `no_plat_tryandaasu` varchar(10) DEFAULT NULL,
  `tgl_rental_tryandaasu` date DEFAULT NULL,
  `jam_rental_tryandaasu` time DEFAULT NULL,
  `harga_tryandaasu` int(11) DEFAULT NULL,
  `lama_tryandaasu` int(11) DEFAULT NULL,
  `total_bayar_tryandaasu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_rental_tryandaasu`
--

INSERT INTO `tbl_rental_tryandaasu` (`no_trx_tryandaasu`, `nik_ktp_tryandaasu`, `no_plat_tryandaasu`, `tgl_rental_tryandaasu`, `jam_rental_tryandaasu`, `harga_tryandaasu`, `lama_tryandaasu`, `total_bayar_tryandaasu`) VALUES
('343', '2222222222222222', 'a23232', '2024-02-12', '12:02:00', 1200000000, 12, 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_tryandaasu`
--

CREATE TABLE `tbl_user_tryandaasu` (
  `id_user_tryandaasu` int(11) NOT NULL,
  `username_tryandaasu` varchar(50) NOT NULL,
  `password_tryandaasu` varchar(32) NOT NULL,
  `level_tryandaasu` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user_tryandaasu`
--

INSERT INTO `tbl_user_tryandaasu` (`id_user_tryandaasu`, `username_tryandaasu`, `password_tryandaasu`, `level_tryandaasu`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_mobil_tryandaasu`
--
ALTER TABLE `tbl_mobil_tryandaasu`
  ADD PRIMARY KEY (`no_plat_tryandaasu`);

--
-- Indeks untuk tabel `tbl_pelanggan_tryandaasu`
--
ALTER TABLE `tbl_pelanggan_tryandaasu`
  ADD PRIMARY KEY (`nik_ktp_tryandaasu`);

--
-- Indeks untuk tabel `tbl_rental_tryandaasu`
--
ALTER TABLE `tbl_rental_tryandaasu`
  ADD PRIMARY KEY (`no_trx_tryandaasu`),
  ADD KEY `nik_ktp_tryandaasu` (`nik_ktp_tryandaasu`),
  ADD KEY `no_plat_tryandaasu` (`no_plat_tryandaasu`);

--
-- Indeks untuk tabel `tbl_user_tryandaasu`
--
ALTER TABLE `tbl_user_tryandaasu`
  ADD PRIMARY KEY (`id_user_tryandaasu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_user_tryandaasu`
--
ALTER TABLE `tbl_user_tryandaasu`
  MODIFY `id_user_tryandaasu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_rental_tryandaasu`
--
ALTER TABLE `tbl_rental_tryandaasu`
  ADD CONSTRAINT `tbl_rental_tryandaasu_ibfk_1` FOREIGN KEY (`nik_ktp_tryandaasu`) REFERENCES `tbl_pelanggan_tryandaasu` (`nik_ktp_tryandaasu`),
  ADD CONSTRAINT `tbl_rental_tryandaasu_ibfk_2` FOREIGN KEY (`no_plat_tryandaasu`) REFERENCES `tbl_mobil_tryandaasu` (`no_plat_tryandaasu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
