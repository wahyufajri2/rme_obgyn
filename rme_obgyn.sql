-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Agu 2024 pada 00.13
-- Versi server: 8.0.30
-- Versi PHP: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rme_obgyn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inti_rekam_medis`
--

CREATE TABLE `inti_rekam_medis` (
  `no_rm` int NOT NULL,
  `keluhan_utama` text NOT NULL,
  `nik` int NOT NULL,
  `id_pengguna` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_akses_pengguna`
--

CREATE TABLE `menu_akses_pengguna` (
  `id` int NOT NULL,
  `id_peran` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `menu_akses_pengguna`
--

INSERT INTO `menu_akses_pengguna` (`id`, `id_peran`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(9, 1, 4),
(10, 1, 5),
(13, 3, 3),
(14, 4, 4),
(15, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_pengguna`
--

CREATE TABLE `menu_pengguna` (
  `id` int NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `menu_pengguna`
--

INSERT INTO `menu_pengguna` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Pendaftaran'),
(3, 'Bidan'),
(4, 'Dokter'),
(5, 'Pengaturan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `nik` int NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_telp` int NOT NULL,
  `alamat` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `suami` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`nik`, `nama_pasien`, `tgl_lahir`, `jenis_kelamin`, `no_telp`, `alamat`, `suami`) VALUES
(2, 'uu', '2023-06-08', 'Laki-laki', 0, 'bandung', ''),
(3, 'budi', '2023-06-05', 'Laki-laki', 0, 'yogya', ''),
(4, 'yayuk', '2023-06-09', 'Laki-laki', 0, 'sleman', ''),
(150, 'wahyu sejati', '2023-06-21', 'Laki-laki', 0, 'cilacap', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_rg` int NOT NULL,
  `tgl_periksa` int NOT NULL,
  `status` enum('Belum','Sedang','Selesai') NOT NULL,
  `nik` int NOT NULL,
  `id_pengguna` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_rg`, `tgl_periksa`, `status`, `nik`, `id_pengguna`) VALUES
(1, 20230510, 'Belum', 1, 21),
(2, 20230509, 'Belum', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kata_sandi` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_peran` int NOT NULL,
  `apakah_aktif` int NOT NULL,
  `tgl_dibuat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `gambar`, `kata_sandi`, `id_peran`, `apakah_aktif`, `tgl_dibuat`) VALUES
(2, 'Wahyu Fajri', 'whybaik2@gmail.com', 'default.jpg', '$2y$10$AmIMfLNANbKBNwp4LS4yXu83HDDr.C2YQ2ntSGcXx/udsh8QPq9am', 1, 1, 0),
(4, 'Al-Fajri', 'wahyufjr02@gmail.com', 'default.jpg', '$2y$10$52pQ13GxgQ/8x9Z2GrwbdOtkoqIFyYYV.6VVjxEab8u5xmYxek.9K', 2, 1, 0),
(7, 'Muhammad', 'muhammad@gmail.com', 'default.jpg', '$2y$10$Nva.QHfx8PVUOzaj4XdMlOfDBQaNg9gOlK84YpHZU8nBnrKUn1Ryy', 3, 1, 1724212062);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peran_pengguna`
--

CREATE TABLE `peran_pengguna` (
  `id` int NOT NULL,
  `peran` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `peran_pengguna`
--

INSERT INTO `peran_pengguna` (`id`, `peran`) VALUES
(1, 'Admin'),
(2, 'Pendaftaran'),
(3, 'Bidan'),
(4, 'Dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu_pengguna`
--

CREATE TABLE `submenu_pengguna` (
  `id` int NOT NULL,
  `id_menu` int NOT NULL,
  `judul` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(128) NOT NULL,
  `ikon` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apakah_aktif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `submenu_pengguna`
--

INSERT INTO `submenu_pengguna` (`id`, `id_menu`, `judul`, `url`, `ikon`, `apakah_aktif`) VALUES
(2, 2, 'Pendaftaran Pasien', 'pendaftaran', 'fas fa-fw fa-solid fa-folder', 1),
(3, 2, 'Master Data Pasien', 'pendaftaran/masterPasien', 'fas fa-fw fa-solid fa-database', 1),
(4, 3, 'Data Rekam Medis', 'bidan/catatRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1),
(7, 5, 'Tambah Akun', 'pengaturan/tambahAkun', 'fas fa-fw fa-solid fa-user-plus', 1),
(8, 1, 'Pendaftaran Pasien', 'admin/lihatPendaftaran', 'fas fa-fw fa-solid fa-folder', 1),
(9, 1, 'Master Data Pasien', 'admin/lihatMasterPasien', 'fas fa-fw fa-solid fa-database', 1),
(10, 1, 'Data Rekam Medis', 'admin/lihatRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1),
(11, 4, 'Data Rekam Medis', 'dokter/lihatRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1),
(12, 5, 'Kelola Peran Akun', 'pengaturan/kelolaAkun', 'fas fa-fw fa-solid fa-user-gear', 1),
(13, 5, 'Kelola Menu', 'pengaturan/kelolaMenu', 'fas fa-fw fa-solid fa-list-check', 1),
(14, 5, 'Kelola Submenu', 'pengaturan/kelolaSubmenu', 'fas fa-fw fa-solid fa-sliders', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inti_rekam_medis`
--
ALTER TABLE `inti_rekam_medis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `menu_akses_pengguna`
--
ALTER TABLE `menu_akses_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_peran` (`id_peran`);

--
-- Indeks untuk tabel `menu_pengguna`
--
ALTER TABLE `menu_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_rg`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peran` (`id_peran`);

--
-- Indeks untuk tabel `peran_pengguna`
--
ALTER TABLE `peran_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu_pengguna`
--
ALTER TABLE `submenu_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inti_rekam_medis`
--
ALTER TABLE `inti_rekam_medis`
  MODIFY `no_rm` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_akses_pengguna`
--
ALTER TABLE `menu_akses_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `menu_pengguna`
--
ALTER TABLE `menu_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `nik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `no_rg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `peran_pengguna`
--
ALTER TABLE `peran_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `submenu_pengguna`
--
ALTER TABLE `submenu_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
