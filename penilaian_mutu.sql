-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2024 pada 14.17
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
-- Database: `penilaian_mutu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `path_doc_nilai` varchar(256) NOT NULL,
  `path_doc_remedial` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `document`
--

INSERT INTO `document` (`id`, `id_mapel`, `waktu`, `path_doc_nilai`, `path_doc_remedial`) VALUES
(15, 23, '2024-12-15 12:56:39', 'BIN0601_Bahasa Indonesia_Najmi Fadhila_2024-12-15_Catatan_Penilaian.pdf', 'BIN0601_Bahasa Indonesia_Najmi Fadhila_2024-12-15_Laporan_Remedial.pdf'),
(16, 24, '2024-12-15 12:57:08', 'BIN0602_Bahasa Indonesia_Najmi Fadhila_2024-12-15_Catatan_Penilaian.pdf', 'BIN0602_Bahasa Indonesia_Najmi Fadhila_2024-12-15_Laporan_Remedial.pdf'),
(17, 26, '2024-12-15 12:57:53', 'MTK0501_Matematika_Vivianika Nathania_2024-12-15_Catatan_Penilaian.pdf', 'MTK0501_Matematika_Vivianika Nathania_2024-12-15_Laporan_Remedial.pdf'),
(18, 27, '2024-12-15 12:58:09', 'MTK0502_Matematika_Vivianika Nathania_2024-12-15_Catatan_Penilaian.pdf', 'MTK0502_Matematika_Vivianika Nathania_2024-12-15_Laporan_Remedial.pdf'),
(19, 29, '2024-12-15 12:58:54', 'BIG0501_Bahasa Inggris_Alifia Putri_2024-12-15_Catatan_Penilaian.pdf', 'BIG0501_Bahasa Inggris_Alifia Putri_2024-12-15_Laporan_Remedial.pdf'),
(20, 30, '2024-12-15 12:59:08', 'BIG0502_Bahasa Inggris_Alifia Putri_2024-12-15_Catatan_Penilaian.pdf', 'BIG0502_Bahasa Inggris_Alifia Putri_2024-12-15_Laporan_Remedial.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `kode_mapel` varchar(12) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kkm` int(3) NOT NULL,
  `mutu` int(1) DEFAULT 0,
  `kelas` varchar(8) NOT NULL,
  `ta` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `id_guru`, `kode_mapel`, `nama`, `kkm`, `mutu`, `kelas`, `ta`) VALUES
(23, 41, 'BIN0601', 'Bahasa Indonesia', 75, 4, '06 A', 'Ganjil 2024/2025'),
(24, 41, 'BIN0602', 'Bahasa Indonesia', 75, 0, '06 B', 'Ganjil 2024/2025'),
(25, 41, 'BIN0603', 'Bahasa Indonesia', 75, 0, '06 C', 'Ganjil 2024/2025'),
(26, 42, 'MTK0501', 'Matematika', 80, 3, '05 A', 'Ganjil 2024/2025'),
(27, 42, 'MTK0502', 'Matematika', 80, 0, '05 B', 'Ganjil 2024/2025'),
(28, 42, 'MTK0503', 'Matematika', 80, 0, '05 C', 'Ganjil 2024/2025'),
(29, 43, 'BIG0501', 'Bahasa Inggris', 78, 2, '05 A', 'Ganjil 2024/2025'),
(30, 43, 'BIG0502', 'Bahasa Inggris', 78, 0, '05 B', 'Ganjil 2024/2025'),
(31, 43, 'BIG0503', 'Bahasa Inggris', 78, 0, '05 C', 'Ganjil 2024/2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_mutu`
--

CREATE TABLE `penilaian_mutu` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kepsek` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `doc_nilai` tinyint(1) DEFAULT NULL,
  `doc_remedial` tinyint(1) DEFAULT NULL,
  `sesuai_jadwal` tinyint(1) NOT NULL,
  `metode_beragam` tinyint(1) NOT NULL,
  `berkelanjutan` tinyint(1) NOT NULL,
  `peningkatan` tinyint(1) NOT NULL,
  `mutu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian_mutu`
--

INSERT INTO `penilaian_mutu` (`id`, `id_doc`, `id_mapel`, `id_kepsek`, `waktu`, `doc_nilai`, `doc_remedial`, `sesuai_jadwal`, `metode_beragam`, `berkelanjutan`, `peningkatan`, `mutu`) VALUES
(10, 15, 23, 40, '2024-12-15 07:01:34', 1, 1, 1, 1, 1, 1, 4),
(11, 17, 26, 40, '2024-12-15 07:01:48', 1, 1, 1, 1, 1, 0, 3),
(12, 19, 29, 40, '2024-12-15 07:02:18', 1, 1, 1, 1, 0, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `npsm` int(8) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `status` enum('Negeri','Swasta') DEFAULT NULL,
  `bp` enum('SD','SMP','SMA','SMK') DEFAULT NULL,
  `akreditasi` enum('A','B','C','TT') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `npsm`, `nama`, `status`, `bp`, `akreditasi`) VALUES
(20, 10403940, ' SD NEGERI 65 PEKANBARU', 'Negeri', 'SD', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tendik`
--

CREATE TABLE `tendik` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `jabatan` enum('Kepsek','Guru','Pengawas') NOT NULL,
  `pendidikan` enum('SMA/SMK','D1','D2','D3','D4','S1','S2','S3') NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tendik`
--

INSERT INTO `tendik` (`id`, `id_sekolah`, `nama`, `nip`, `jk`, `jabatan`, `pendidikan`, `email`, `password`) VALUES
(40, 20, 'Wahyu', 111111111111111111, 'L', 'Kepsek', 'S2', 'wahyu1111@kepsek.dindikbud.sch.id', '11111111'),
(41, 20, 'Najmi Fadhila', 222222222222222222, 'P', 'Guru', 'S1', 'najmi.fadhila2222@guru.dindikbud.sch.id', '22222222'),
(42, 20, 'Vivianika Nathania', 444444444444444444, 'P', 'Guru', 'S1', 'vivianika.nathania4444@guru.dindikbud.sch.id', '44444444'),
(43, 20, 'Alifia Putri', 33333333333333333, 'P', 'Guru', 'S1', 'alifia.putri3333@guru.dindikbud.sch.id', '33333333'),
(44, 20, 'Alfhat Ramadhan', 555555555555555555, 'L', 'Pengawas', 'S1', 'alfhat.ramadhan5555@pengawas.dindikbud.sch.id', '55555555');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_guru` (`id_guru`);

--
-- Indeks untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mutu_doc` (`id_doc`),
  ADD KEY `fk_mutu_kepsek` (`id_kepsek`),
  ADD KEY `fk_mutu_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tendik`
--
ALTER TABLE `tendik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tendik_sekolah` (`id_sekolah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tendik`
--
ALTER TABLE `tendik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_doc_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`);

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `fk_mapel_guru` FOREIGN KEY (`id_guru`) REFERENCES `tendik` (`id`);

--
-- Ketidakleluasaan untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  ADD CONSTRAINT `fk_mutu_doc` FOREIGN KEY (`id_doc`) REFERENCES `document` (`id`),
  ADD CONSTRAINT `fk_mutu_kepsek` FOREIGN KEY (`id_kepsek`) REFERENCES `tendik` (`id`),
  ADD CONSTRAINT `fk_mutu_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`);

--
-- Ketidakleluasaan untuk tabel `tendik`
--
ALTER TABLE `tendik`
  ADD CONSTRAINT `fk_tendik_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
