-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 07 Sep 2024 pada 15.14
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
-- Struktur dari tabel `asesmen_pasien`
--

CREATE TABLE `asesmen_pasien` (
  `id_asesmen_a` int NOT NULL,
  `no_rm` varchar(16) NOT NULL,
  `id_pengguna` int NOT NULL,
  `alasan_masuk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_opname` text,
  `deskripsi_alergi` text,
  `deskripsi_nyeri` text,
  `penurunan_bb` int DEFAULT NULL,
  `nafsu_makan` int DEFAULT NULL,
  `diagnosis_khusus` int DEFAULT NULL,
  `tgl_dietisien` int DEFAULT NULL,
  `hasil_pemeriksaan_diberitahu` int DEFAULT NULL,
  `kolaborasi_dg_dokter` int DEFAULT NULL,
  `edukasi_pasien` int DEFAULT NULL,
  `kesediaan_terima_informasi` int DEFAULT NULL,
  `hambatan_edukasi` int DEFAULT NULL,
  `penerjemah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kebutuhan_edukasi` text,
  `puasa_min_4jam` int DEFAULT NULL,
  `manajemen_nyeri` int DEFAULT NULL,
  `penjelasan_kb` int DEFAULT NULL,
  `persetujuan_kb` int DEFAULT NULL,
  `persiapan_alat` int DEFAULT NULL,
  `kolaborasi_dranestesi` int DEFAULT NULL,
  `cuci_tangan_awal` int DEFAULT NULL,
  `posisi_pasien_berio2` int DEFAULT NULL,
  `pembiusan` int DEFAULT NULL,
  `waktu_kuretage` int DEFAULT NULL,
  `hasil_kuretage` float DEFAULT NULL,
  `jaringan_pa` int DEFAULT NULL,
  `injeksi_metergin` int DEFAULT NULL,
  `lakukan_incici` int DEFAULT NULL,
  `pasang_tampon` int DEFAULT NULL,
  `pasang_cateter` int DEFAULT NULL,
  `tekanan_darah_setelah` int DEFAULT NULL,
  `nadi_setelah` int DEFAULT NULL,
  `respirasi_setelah` int DEFAULT NULL,
  `suhu_badan_setelah` int DEFAULT NULL,
  `saturasio2_setelah` int DEFAULT NULL,
  `dekontaminasi` int DEFAULT NULL,
  `cuci_tangan_akhir` int DEFAULT NULL,
  `mindah_paisen` int DEFAULT NULL,
  `dokumentasi` int DEFAULT NULL,
  `tempat_rujuk` varchar(255) DEFAULT NULL
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
(3, 2, 2),
(10, 1, 5),
(13, 3, 3),
(14, 4, 4),
(22, 1, 3),
(27, 1, 2),
(28, 1, 4);

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
  `no_rm` varchar(16) NOT NULL,
  `nik` bigint UNSIGNED NOT NULL,
  `nama_pasien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_lahir` int NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `suami` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_dibuat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `nik`, `nama_pasien`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `alamat`, `suami`, `tgl_dibuat`) VALUES
('RM-02092024-0001', 1010101010101010, 'Fatimah Azzahra', 1451606400, 'Perempuan', '0895417230806', 'Sidomoyo, Godean, Sleman', 'Fulannn', 1725578618),
('RM-02092024-0002', 2020202020202020, 'Hindun', 1474416000, 'Perempuan', '0895417230806', 'Dusun Mentasan', 'Walid', 1725245946),
('RM-02092024-0003', 5050505050505050, 'Zainab', 1600214400, 'Perempuan', '0895417230806', 'Alas, Jawa Selatan', 'Abu', 1725245977),
('RM-03092024-0001', 6060606060606060, 'siti', 1536105600, 'Perempuan', '0895417230806', 'Alas, Jawa Selatan', 'Fulan', 1725349191),
('RM-05092024-0001', 7070707070707070, 'Azizah', 1441670400, 'Perempuan', '0895417230806', 'Sidomoyo, Godean, Sleman', 'Walid', 1725578665),
('RM-06092024-0001', 9090909090909090, 'Fatimah', 1630886400, 'Perempuan', '0895417230806', 'Dusun Mentasan RT 02 RW 03 Mentasan, Kawunganten, Cilacap, Jawa Tengah', 'Khalid', 1725607260);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `no_rg` varchar(16) NOT NULL,
  `no_rm` varchar(16) NOT NULL,
  `tgl_periksa` int NOT NULL,
  `status` enum('Belum periksa','Sedang periksa','Selesai periksa') NOT NULL,
  `tgl_pendaftaran` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `bangsal` enum('IGD','Rawat Jalan','Rawat Inap') NOT NULL,
  `asuransi` enum('BPJS','Umum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`no_rg`, `no_rm`, `tgl_periksa`, `status`, `tgl_pendaftaran`, `id_pengguna`, `bangsal`, `asuransi`) VALUES
('RG-02092024-0001', 'RM-02092024-0001', 1726099200, 'Belum periksa', 1725246682, 17, 'IGD', 'BPJS'),
('RG-02092024-0002', 'RM-02092024-0002', 1725494400, 'Sedang periksa', 1725246700, 104, 'IGD', 'BPJS'),
('RG-03092024-0001', 'RM-03092024-0001', 1725321600, 'Belum periksa', 1725349931, 17, 'IGD', 'BPJS'),
('RG-06092024-0001', 'RM-06092024-0001', 1725580800, 'Belum periksa', 1725607287, 17, 'Rawat Inap', 'BPJS'),
('RG-07092024-0001', 'RM-02092024-0002', 1725753600, 'Belum periksa', 1725693615, 104, 'IGD', 'BPJS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kata_sandi` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_peran` int NOT NULL,
  `apakah_aktif` int NOT NULL,
  `tgl_dibuat` int NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `qr_code` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `gambar`, `kata_sandi`, `id_peran`, `apakah_aktif`, `tgl_dibuat`, `no_hp`, `qr_code`) VALUES
(14, 'Muhammad Sumbul', 'admin@gmail.com', 'download.png', '$2y$10$0UU8z58bOhUQ8Ca3eX8mjexatNYQsXi1DUUkHXG1Y/L4viMzbYvkS', 1, 1, 1724385074, '0', 'default.jpg'),
(15, 'Sa’d bin Abi Waqqash', 'pendaftaran@gmail.com', 'default.jpg', '$2y$10$.9dXqHYuPnIfDShqg4WsRu9661AGwLHM1Gnq8pMja1R1BIjQujdvS', 2, 1, 1724385225, '0', 'default.jpg'),
(16, 'Khadijah', 'bidan@gmail.com', 'default.jpg', '$2y$10$Q.wal.g14XKIxwVku.z/ZOXx2yZ51PhXNwCyP7ykBKFDuWENdgggm', 3, 1, 1724385287, '0', 'default.jpg'),
(17, 'Ali bin abi thalib', 'dokter@gmail.com', 'profil.png', '$2y$10$OhVhLzzuhIULwv0Si/NK7eIm5ezo0FOOkWOHUM.VbqI/C6yu4R.YS', 4, 1, 1724385332, '0895417230806', 'default.jpg'),
(104, 'Muhammad', 'muhammad@gmail.com', 'default.jpg', '$2y$10$tbnEkun.xFIdPUceAKW4HevcSJFCZbwNhJceY20HMOdV2DIPf5GPe', 4, 1, 1724616097, '0', 'default.jpg'),
(105, 'Dokter Khabib', 'khabib@gmail.com', 'default.jpg', '$2y$10$NpyvsQtnapeUrOjO5uSnAOmrwmCL0BYO4VsBy/HfBCiwyDhz72ZbO', 4, 1, 1724826640, '0', 'default.jpg'),
(106, 'Bidan Yuli', 'bidanyuli@gmail.com', 'default.jpg', '$2y$10$i/WfAaPYmx0p.PAgxZ3Pke0VIu75cmHqLQ3ke4sseea9Qrq4ov/Xe', 3, 1, 1725340467, '0', 'default.jpg'),
(109, 'Fulan', 'fulan@gmail.com', 'default.jpg', '$2y$10$guqQhshByBTJ2TD37OspUODL.rT3HmP1euFhlcMTmlOXFZ3BsEP3y', 1, 1, 1725583088, '089123456789', 'default.jpg');

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
(2, 2, 'Daftar Periksa Pasien', 'pendaftaran', 'fas fa-fw fa-solid fa-folder', 1),
(3, 2, 'Master Data Pasien', 'pendaftaran/masterPasien', 'fas fa-fw fa-solid fa-database', 1),
(4, 3, 'Data Rekam Medis', 'bidan/bidanRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1),
(7, 5, 'Tambah Akun', 'pengaturan/tambahAkun', 'fas fa-fw fa-solid fa-user-plus', 1),
(8, 1, 'Daftar Periksa Pasien', 'admin/lihatPendaftaran', 'fas fa-fw fa-solid fa-folder', 1),
(9, 1, 'Master Data Pasien', 'admin/lihatMasterPasien', 'fas fa-fw fa-solid fa-database', 1),
(10, 1, 'Data Rekam Medis', 'admin/lihatRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1),
(11, 5, 'Kelola Akun', 'pengaturan/kelolaAkun', 'fas fa-fw fa-solid fa-user-gear', 1),
(12, 5, 'Kelola Peran Akun', 'pengaturan/kelolaPeranAkun', 'fas fa-fw fa-solid fa-arrows-down-to-people', 1),
(13, 5, 'Kelola Menu', 'pengaturan/kelolaMenu', 'fas fa-fw fa-solid fa-list-check', 1),
(14, 5, 'Kelola Submenu', 'pengaturan/kelolaSubmenu', 'fas fa-fw fa-solid fa-sliders', 1),
(16, 4, 'Data Rekam Medis', 'dokter/lihatRekamMedis', 'fas fa-fw fa-solid fa-table-cells-row-lock', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `token_pengguna`
--

CREATE TABLE `token_pengguna` (
  `id` int NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `id_pengguna` int NOT NULL,
  `tgl_dibuat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `token_pengguna`
--

INSERT INTO `token_pengguna` (`id`, `email`, `token`, `id_pengguna`, `tgl_dibuat`) VALUES
(1, 'bidan@gmail.com', 'kAnDuZ8gwBtNbZlXaJ3Ih9kIOmAN73KcFTtThVejQHk=', 0, 1724616807),
(2, 'bidan@gmail.com', 'q00DN0wHPH0OcP7E0TAPkJCrpR6I9pUIq+zH2TP4kY0=', 0, 1724616908),
(3, 'khabib@gmail.com', '/qTKKNthkkYxy4xLUnYsH/sgcFBWeaSdwxQt9uKN/io=', 0, 1725341867),
(4, 'khabib@gmail.com', '6zhvNP8n6zxcaz6XxGlPQrR01H194NbQGmhYW7BWsoI=', 0, 1725582650);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asesmen_pasien`
--
ALTER TABLE `asesmen_pasien`
  ADD PRIMARY KEY (`id_asesmen_a`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `no_rm` (`no_rm`);

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
  ADD PRIMARY KEY (`no_rm`) USING BTREE;

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`no_rg`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `no_rm` (`no_rm`) USING BTREE;

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
-- Indeks untuk tabel `token_pengguna`
--
ALTER TABLE `token_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asesmen_pasien`
--
ALTER TABLE `asesmen_pasien`
  MODIFY `id_asesmen_a` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu_akses_pengguna`
--
ALTER TABLE `menu_akses_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `menu_pengguna`
--
ALTER TABLE `menu_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `peran_pengguna`
--
ALTER TABLE `peran_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `submenu_pengguna`
--
ALTER TABLE `submenu_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `token_pengguna`
--
ALTER TABLE `token_pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
