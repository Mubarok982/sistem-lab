-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 08:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `apresiasi_ujian_skripsi`
--

CREATE TABLE `apresiasi_ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `id_penguji` bigint(20) UNSIGNED NOT NULL,
  `apresiasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apresiasi_ujian_skripsi`
--

INSERT INTO `apresiasi_ujian_skripsi` (`id`, `id_ujian_skripsi`, `id_penguji`, `apresiasi`) VALUES
(16, 37, 43, 'asdasda'),
(18, 37, 35, 'asdasdsadaxxxxx');

-- --------------------------------------------------------

--
-- Table structure for table `data_dosen`
--

CREATE TABLE `data_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nidk` varchar(20) NOT NULL,
  `prodi` enum('Teknik Informatika S1','Teknologi Informasi D3','Teknik Industri S1','Teknik Mesin S1','Mesin Otomotif D3') NOT NULL,
  `ttd` text DEFAULT NULL,
  `is_kaprodi` tinyint(1) NOT NULL DEFAULT 0,
  `is_praktisi` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_dosen`
--

INSERT INTO `data_dosen` (`id`, `nidk`, `prodi`, `ttd`, `is_kaprodi`, `is_praktisi`) VALUES
(13, '057508191', 'Teknik Informatika S1', '1746407366_ttd_pak_mukhtar_png-removebg-preview.png', 0, 0),
(16, '027108182', 'Teknologi Informasi D3', '1746418736_ttd_pak_arri_1.PNG', 1, 0),
(21, '107906052', 'Teknik Informatika S1', '1746407380_ttd_pak_andi_png-removebg-preview.png', 0, 0),
(26, '107806051', 'Teknik Informatika S1', '1746407388_ttd_pak_bambang-removebg-preview.png', 0, 0),
(31, '107306024', 'Teknik Informatika S1', '1746407396_ttd_pak_agung-removebg-preview.png', 0, 0),
(32, '987008138', 'Teknik Informatika S1', '1746418727_ttd_pak_nur.PNG', 0, 0),
(33, '057108188', 'Teknik Informatika S1', '1745996763_Pak_Hendra.png', 0, 0),
(34, '067206024', 'Teknik Informatika S1', '1745996777_Pak_Uky.png', 0, 0),
(35, '139006116', 'Teknik Informatika S1', '1745996792_Bu_Endah.png', 0, 0),
(36, '158808135', 'Teknik Informatika S1', '1745996639_Pak_Agus.png', 0, 0),
(37, '158108139', 'Teknik Informatika S1', '1745996801_Pak_Ully.png', 0, 0),
(38, '168508156', 'Teknik Informatika S1', '1745996810_Bu_Ardhin.png', 0, 0),
(39, '168208163', 'Teknik Informatika S1', '1745996823_Pak_Setiya.png', 1, 0),
(40, '188508188', 'Teknik Informatika S1', '1745996831_Pak_Dimas.png', 0, 0),
(41, '187708189', 'Teknik Informatika S1', '1745996840_Bu_Mai.png', 0, 0),
(42, '199208245', 'Teknik Informatika S1', '1745996848_Bu_Pristi.png', 0, 0),
(43, '219108337', 'Teknik Informatika S1', '1745996857_Pak_rofi.png', 0, 0),
(47, '187708197', 'Teknik Informatika S1', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_mahasiswa`
--

CREATE TABLE `data_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `angkatan` year(4) NOT NULL,
  `prodi` enum('Teknik Informatika S1','Teknologi Informasi D3','Teknik Industri S1','Teknik Mesin S1','Mesin Otomotif D3') NOT NULL,
  `is_skripsi` tinyint(1) DEFAULT 0,
  `alamat` text DEFAULT NULL,
  `status_beasiswa` enum('Aktif','Tidak Aktif') NOT NULL,
  `status_mahasiswa` enum('Murni','Konversi','Transfer') NOT NULL,
  `ttd` text NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tempat_tgl_lahir` varchar(100) DEFAULT NULL,
  `nama_ortu_dengan_gelar` varchar(255) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `dokumen_identitas` varchar(255) NOT NULL,
  `sertifikat_toefl_niit` varchar(255) DEFAULT NULL,
  `sertifikat_office_puskom` varchar(255) NOT NULL,
  `sertifikat_btq_ibadah` varchar(255) NOT NULL,
  `sertifikat_bahasa` varchar(255) NOT NULL,
  `sertifikat_kompetensi_ujian_komprehensif` varchar(255) NOT NULL,
  `sertifikat_semaba_ppk_masta` varchar(255) NOT NULL,
  `sertifikat_kkn` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` (`id`, `jenis_kelamin`, `email`, `telepon`, `angkatan`, `prodi`, `is_skripsi`, `alamat`, `status_beasiswa`, `status_mahasiswa`, `ttd`, `nik`, `tempat_tgl_lahir`, `nama_ortu_dengan_gelar`, `kelas`, `dokumen_identitas`, `sertifikat_toefl_niit`, `sertifikat_office_puskom`, `sertifikat_btq_ibadah`, `sertifikat_bahasa`, `sertifikat_kompetensi_ujian_komprehensif`, `sertifikat_semaba_ppk_masta`, `sertifikat_kkn`) VALUES
(9, 'Laki-laki', 'ichwantaufiq30@gmail.com', '131231312313213', '2018', 'Teknik Informatika S1', 0, 'Magelang', 'Tidak Aktif', 'Murni', 'ttd_1748415558.png', '123131231231', 'Magelang, 11 Oktober 1995', 'Wahyuni', 'Reguler', '', NULL, '', '', '', '', '', ''),
(44, 'Laki-laki', NULL, NULL, '2023', 'Teknik Informatika S1', 0, NULL, 'Tidak Aktif', '', '', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', ''),
(45, 'Laki-laki', NULL, NULL, '2020', 'Teknologi Informasi D3', 0, NULL, 'Tidak Aktif', '', '', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', ''),
(46, 'Laki-laki', NULL, NULL, '2020', 'Teknik Informatika S1', 0, NULL, 'Tidak Aktif', '', '', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', ''),
(48, NULL, NULL, NULL, '2023', 'Teknik Informatika S1', 0, NULL, 'Tidak Aktif', 'Murni', '', NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', ''),
(58, 'Laki-laki', 'herma.fanani@unimma.ac.id', '081213123131', '2014', 'Teknik Informatika S1', 0, 'Magelang', 'Tidak Aktif', 'Murni', 'ttd_1748413468.png', '3308081010950004', 'Magelang, 10 Oktober 1995', 'Wahyuni', 'Reguler', '', NULL, '', '', '', '', '', ''),
(60, 'Laki-laki', 'herma.fanani12@unimma.ac.id', '081213123131131', '2019', 'Teknik Informatika S1', 0, 'Magelang', 'Tidak Aktif', 'Murni', '', NULL, NULL, NULL, 'Reguler', '', NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_ujian_skripsi`
--

CREATE TABLE `jenis_ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `rumus` enum('informatika sempro','informatika sidang','non informatika','informatika 2025') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_ujian_skripsi`
--

INSERT INTO `jenis_ujian_skripsi` (`id`, `nama`, `rumus`) VALUES
(1, 'Seminar Proposal Teknik Lama', 'informatika sempro'),
(2, 'Sidang Pendadaran Teknik Lama', 'informatika sidang'),
(7, 'Seminar Proposal Teknik Industri', 'non informatika'),
(9, 'Sidang Pendadaran Teknik Industri', 'non informatika'),
(16, 'Seminar Proposal Informatika 2025', 'informatika 2025'),
(17, 'Sidang Pendadaran Informatika 2025', 'informatika 2025');

-- --------------------------------------------------------

--
-- Table structure for table `mstr_akun`
--

CREATE TABLE `mstr_akun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `role` enum('dosen','mahasiswa','operator','tata_usaha') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mstr_akun`
--

INSERT INTO `mstr_akun` (`id`, `username`, `password`, `nama`, `foto`, `role`) VALUES
(1, 'admin', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'John Doe', '', 'operator'),
(9, '18.0504.0059', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Muhammad Devananda Andika Putra', 'profile_6811e606353fc0_42049343.PNG', 'mahasiswa'),
(13, '0602047502', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Mukhtar Hanafi, ST., MCs.', '', 'dosen'),
(16, '0616127102', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'R. Arri Widyanto, S.Kom.,MT', '', 'dosen'),
(21, '0623087901', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Andi Widiyanto, M.Kom', '', 'dosen'),
(26, '0623107802', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Bambang Pujiarto, M.Kom', '', 'dosen'),
(31, '0624077302', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Nugroho Agung Prabowo, ST.,M.Kom', NULL, 'dosen'),
(32, '0605037002', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Nuryanto, ST., M. Kom', NULL, 'dosen'),
(33, '0624077101', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Purwono Hendradi, M.Kom', NULL, 'dosen'),
(34, '0605107201', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Dr. Uky Yudatama, S.Si.,M.Kom., M.M', NULL, 'dosen'),
(35, '0601129001', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Endah Ratna Arumi, M. Cs.', NULL, 'dosen'),
(36, '0617088801', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Agus Setiawan, M.Eng', NULL, 'dosen'),
(37, '0512128101', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Emilya Ully Artha, M.Kom', NULL, 'dosen'),
(38, '0619048501', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Ardhin Primadewi, S.Si, M.TI.', NULL, 'dosen'),
(39, '0631088203', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Setiya Nugroho, ST., M.Eng.', NULL, 'dosen'),
(40, '0602058502', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Dimas Sasongko, S. Kom., M. Eng', NULL, 'dosen'),
(41, '0612117702', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Maimunah, S. Si., M. Kom', NULL, 'dosen'),
(42, '0618129201', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Pristi Sukmasetya, S.Komp., M.Kom', NULL, 'dosen'),
(43, '0631079101', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Rofi Abul Hasani, S.Kom., M.Eng', NULL, 'dosen'),
(44, '23.0504.0099', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Arif Zain', NULL, 'mahasiswa'),
(45, '20.0504.0101', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Azwar Wicaksono Heru Saputro', NULL, 'mahasiswa'),
(46, '20.0504.0070', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Baruna Bima Fatkurrohman', NULL, 'mahasiswa'),
(47, '0601107702', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Ir. Affan Rifa\'i, ST., M.T.', NULL, 'dosen'),
(48, '20.0502.0070', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'fadil abdilah', NULL, 'mahasiswa'),
(58, '14.0504.0014', '$2y$10$kZrSExjLOtd5fyGMrfm2.u11K7Skec4v3rXKWdhsRZBhGcAhiYcM2', 'Ichwan Taufiq', NULL, 'mahasiswa'),
(59, '0504', '25d55ad283aa400af464c76d713c07ad', 'Tata Usaha', NULL, 'tata_usaha'),
(60, '12313123123132', '25d55ad283aa400af464c76d713c07ad', 'saya', NULL, 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `mstr_komponen_nilai_ujian_skripsi`
--

CREATE TABLE `mstr_komponen_nilai_ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `keterangan_berita_acara` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `bobot` float NOT NULL,
  `bobot_berita_acara` float DEFAULT NULL,
  `jenis_nilai` enum('naskah','presentasi') NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `id_jenis_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `jenis_indikator` enum('1-5','10-100') NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mstr_komponen_nilai_ujian_skripsi`
--

INSERT INTO `mstr_komponen_nilai_ujian_skripsi` (`id`, `keterangan`, `keterangan_berita_acara`, `gambar`, `bobot`, `bobot_berita_acara`, `jenis_nilai`, `status`, `id_jenis_ujian_skripsi`, `jenis_indikator`, `urutan`) VALUES
(26, 'Naskah BAB 1 Pendahuluan', 'Naskah BAB 1', '1740277475_Naskah_1.png', 2, NULL, 'naskah', 'aktif', 1, '1-5', 0),
(27, 'Rumusan Masalah', '', '1740277496_Naskah_2.png', 2, NULL, 'naskah', 'aktif', 1, '1-5', 0),
(28, 'Naskah BAB 2 Penelitian Relevan & Landasan Teori', 'BAB 3', '1740277513_Naskah_3.png', 2, NULL, 'naskah', 'aktif', 1, '1-5', 0),
(29, 'Naskah BAB 3 Metode Penelitian', 'BAB 2', '1740277530_Naskah_4.png', 4, NULL, 'naskah', 'aktif', 1, '1-5', 0),
(30, 'Kemampuan Presentasi', 'Kualitas Penalaran)', '1740277551_Presentasi_1.png', 3, NULL, 'presentasi', 'aktif', 1, '1-5', 0),
(31, 'Penguasaan Materi', 'Penguasaan Materi', '1740277606_Presentasi_2.png', 4, NULL, 'presentasi', 'aktif', 1, '1-5', 0),
(32, 'Kualitas Penalaran', 'Presentasi (Kemampuan Presentasi', '1740277626_Presentasi_3.png', 3, NULL, 'presentasi', 'aktif', 1, '1-5', 0),
(33, 'Naskah BAB 4', 'Naskah BAB 4', '1740312426_naskah_1.png', 2, NULL, 'naskah', 'aktif', 2, '1-5', 0),
(34, 'Rumusan Masalah', '', '1740312436_naskah_2.png', 3, NULL, 'naskah', 'aktif', 2, '1-5', 0),
(35, 'Naskah BAB 5', 'Sumber Bacaan', '1740312444_naskah_3.png', 1, 15, 'naskah', 'aktif', 2, '1-5', 0),
(36, 'Sumber Bacaan', 'BAB 5', '1740312452_naskah_4.png', 1, NULL, 'naskah', 'aktif', 2, '1-5', 0),
(37, 'Kesesuaian Format Penulisan', 'Kesesuaian Format Penulisan', '1740312462_naskah_5.png', 1, NULL, 'naskah', 'aktif', 2, '1-5', 0),
(38, 'Presentasi penguasaan dan pemahaman materi', 'Kualitas penalaran', '1740312473_presentasi_1.png', 2, 10, 'presentasi', 'aktif', 2, '1-5', 0),
(39, 'Kualitas penalaran', 'Kesesuaian format penulisan)', '1740312483_presentasi_2.png', 2, NULL, 'presentasi', 'aktif', 2, '1-5', 0),
(40, 'Kesesuaian format penulisan', 'Presentasi (Penguasaan dan Pemahaman Materi', '1740312491_presentasi_3.png', 2, NULL, 'presentasi', 'aktif', 2, '1-5', 0),
(41, 'Kesesuaian judul, masalah, tujuan, kajian pustaka dan metode penelitian', '', NULL, 0.3, NULL, 'naskah', 'aktif', 7, '10-100', 0),
(42, 'Penguasaan dan pemahaman materi', '', NULL, 0.2, NULL, 'naskah', 'aktif', 7, '10-100', 0),
(43, 'Presentasi (sikap dan perilaku dalam penyampaian)', '', NULL, 0.2, NULL, 'naskah', 'aktif', 7, '10-100', 0),
(44, 'Kualitas jawaban dari pertanyaan', '', NULL, 0.3, NULL, 'naskah', 'aktif', 7, '10-100', 0),
(56, 'Relevansi topik TA dengan (1) body of knowledge program studi, (2) profil lulusan dan CPL, serta (3) roadmap penelitian Fakultas/Prodi.', 'Relevansi topik TA dengan (1) body of knowledge program studi, (2) profil lulusan dan CPL, serta (3) roadmap penelitian Fakultas/Prodi.', '1745759145_Kriteria_1_Informatika_Proposal_New.png', 1, NULL, 'naskah', 'aktif', 16, '10-100', 1),
(57, 'Kualitas proses deduktif: (1) Inovasi dan kebaruan ide/gagasan, (2) Perumusan masalah, (3) Tinjauan literatur, (4) Kerangka konsep, dan (5) Hipotesis.', 'Kualitas proses deduktif: (1) Inovasi dan kebaruan ide/gagasan, (2) Perumusan masalah, (3) Tinjauan literatur, (4) Kerangka konsep, dan (5) Hipotesis.', '1745759247_Kriteria_2_Informatika_Proposal_New.png', 1, NULL, 'naskah', 'aktif', 16, '10-100', 2),
(58, 'Presentasi laporan: (1) Typografi, (2) Kerapian dan kejelasan instrumen pendukung berupa gambar dan tabel, dan (3) Struktur dan keterkaitan antar bab', 'Presentasi laporan: (1) Typografi, (2) Kerapian dan kejelasan instrumen pendukung berupa gambar dan tabel, dan (3) Struktur dan keterkaitan antar bab', '1745759257_Kriteria_3_Informatika_Proposal_New.png', 1, NULL, 'naskah', 'aktif', 16, '10-100', 3),
(59, 'Penguasaan materi: (1) Kemampuan mengkomunikasikan ide, dan (2) Kemampuan merespons pertanyaan.', 'Penguasaan materi: (1) Kemampuan mengkomunikasikan ide, dan (2) Kemampuan merespons pertanyaan.', '1745759287_Kriteria_4_Informatika_Proposal_New.png', 1, NULL, 'naskah', 'aktif', 16, '10-100', 4),
(60, 'Kemampuan bekerja sama dalam tim (termasuk dengan pembimbing), berbagi tanggung jawab, dan memberikan kontribusi yang konstruktif.', 'Kemampuan bekerja sama dalam tim (termasuk dengan pembimbing), berbagi tanggung jawab, dan memberikan kontribusi yang konstruktif.', '1745759297_Kriteria_5_Informatika_Proposal_New.png', 1, NULL, 'naskah', 'aktif', 16, '10-100', 5),
(61, 'Relevansi topik TA dengan (1) body of knowledge program studi, (2) profil lulusan dan CPL, serta (3) roadmap penelitian Fakultas/Prodi.', 'Relevansi topik TA dengan (1) body of knowledge program studi, (2) profil lulusan dan CPL, serta (3) roadmap penelitian Fakultas/Prodi.', '1745759311_Kriteria_1_Informatika_Pendadaran_New.png', 1, NULL, 'naskah', 'aktif', 17, '10-100', 0),
(62, 'Kualitas proses induktif: (1) Keakuratan metode, (2) Penyajian hasil, (3) Pembahasan, dan (4) Kualitas penyimpulan.', 'Kualitas proses induktif: (1) Keakuratan metode, (2) Penyajian hasil, (3) Pembahasan, dan (4) Kualitas penyimpulan.', '1745759321_Kriteria_2_Informatika_Pendadaran_New.png', 1, NULL, 'naskah', 'aktif', 17, '10-100', 0),
(63, 'Presentasi laporan: (1) Typografi, (2) Kerapian dan kejelasan instrumen pendukung berupa gambar dan tabel, dan (3) Struktur dan keterkaitan antar bab.', 'Presentasi laporan: (1) Typografi, (2) Kerapian dan kejelasan instrumen pendukung berupa gambar dan tabel, dan (3) Struktur dan keterkaitan antar bab.', '1745759328_Kriteria_3_Informatika_Pendadaran_New.png', 1, NULL, 'naskah', 'aktif', 17, '10-100', 0),
(64, 'Penguasaan materi: (1) Kemampuan mengkomunikasikan ide, dan (2) Kemampuan merespons pertanyaan.', 'Penguasaan materi: (1) Kemampuan mengkomunikasikan ide, dan (2) Kemampuan merespons pertanyaan.', '1745759336_Kriteria_4_Informatika_Pendadaran_New.png', 1, NULL, 'naskah', 'aktif', 17, '10-100', 0),
(65, 'Kemampuan bekerja sama dalam tim (termasuk dengan pembimbing), berbagi tanggung jawab, dan memberikan kontribusi yang konstruktif.', 'Kemampuan bekerja sama dalam tim (termasuk dengan pembimbing), berbagi tanggung jawab, dan memberikan kontribusi yang konstruktif.', '1745759343_Kriteria_5_Informatika_Pendadaran_New.png', 1, NULL, 'naskah', 'aktif', 17, '10-100', 0),
(66, 'Kesesuaian judul, masalah, tujuan, kajian pustaka dan metode penelitian', '', NULL, 0.3, NULL, 'naskah', 'aktif', 9, '10-100', 0),
(67, 'Penguasaan dan pemahaman materi', '', NULL, 0.2, NULL, 'naskah', 'aktif', 9, '10-100', 0),
(68, 'Presentasi (sikap dan perilaku dalam penyampaian)', '', NULL, 0.2, NULL, 'naskah', 'aktif', 9, '10-100', 0),
(69, 'Kualitas jawaban dari pertanyaan', '', NULL, 0.3, NULL, 'naskah', 'aktif', 9, '10-100', 0);

-- --------------------------------------------------------

--
-- Table structure for table `saran_ujian_skripsi`
--

CREATE TABLE `saran_ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `id_penguji` bigint(20) UNSIGNED NOT NULL,
  `saran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `saran_ujian_skripsi`
--

INSERT INTO `saran_ujian_skripsi` (`id`, `id_ujian_skripsi`, `id_penguji`, `saran`) VALUES
(1, 37, 36, 'asdadsa'),
(3, 37, 35, 'asdasdsadas');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE `skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mahasiswa` bigint(20) UNSIGNED NOT NULL,
  `tema` enum('Software Engineering','Networking','Artificial Intelligence') NOT NULL,
  `judul` text NOT NULL,
  `pembimbing1` bigint(20) UNSIGNED DEFAULT NULL,
  `pembimbing2` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_pengajuan_judul` date NOT NULL,
  `skema` enum('Reguler','Penyetaraan') NOT NULL,
  `naskah` text DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skripsi`
--

INSERT INTO `skripsi` (`id`, `id_mahasiswa`, `tema`, `judul`, `pembimbing1`, `pembimbing2`, `tgl_pengajuan_judul`, `skema`, `naskah`, `nilai_akhir`) VALUES
(12, 9, '', 'Implementasi Metode Simple Moving Average dan Safety Stock Pada Sistem Informasi Obat', 35, 43, '2025-02-10', '', 'skripsi_680ed931aa3cf3_89266124.pdf', NULL),
(15, 44, '', 'Penerapan OCR pada Sistem Arsip Digital Menggunakan Metode Regular Expression dan TextRank', 36, 40, '2025-02-03', '', 'skripsi_680a2819ab18c1_14598001.pdf', NULL),
(16, 45, '', 'Mobile ISPN (Instrumen Skrining Penempatan Narapidana) Di Lembaga Pemasyarakatan Kelas Iia Magelang', 13, 36, '2025-02-03', '', 'skripsi_680e6af6f37574_27321094.pdf', NULL),
(17, 46, '', 'Sistem Rekapitulasi Tingkat Kegemaran Membaca Dari Transaksi Membaca Di Perpustakaan Komunitas. Studi Kasus Komunitas Literasi Sosial Magelang.', 13, 39, '2025-02-03', '', NULL, NULL),
(22, 58, 'Software Engineering', 'apa ya', 36, 21, '2025-05-23', 'Reguler', NULL, NULL),
(23, 48, 'Artificial Intelligence', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 36, 38, '2025-06-16', 'Reguler', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syarat_pendadaran`
--

CREATE TABLE `syarat_pendadaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naskah` varchar(255) NOT NULL,
  `id_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `berita_acara_seminar` varchar(255) DEFAULT NULL,
  `daftar_nilai_sementara` varchar(255) NOT NULL,
  `krs_terbaru` varchar(255) NOT NULL,
  `dokumen_identitas` varchar(255) NOT NULL,
  `sertifikat_toefl_niit` varchar(255) DEFAULT NULL,
  `sertifikat_office_puskom` varchar(255) NOT NULL,
  `sertifikat_btq_ibadah` varchar(255) NOT NULL,
  `sertifikat_bahasa` varchar(255) NOT NULL,
  `sertifikat_kompetensi_ujian_komprehensif` varchar(255) NOT NULL,
  `sertifikat_semaba_ppk_masta` varchar(255) NOT NULL,
  `sertifikat_kkn` varchar(255) NOT NULL,
  `buku_kendali_bimbingan` varchar(255) NOT NULL,
  `bukti_pembayaran_sidang` varchar(255) NOT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syarat_pendadaran`
--

INSERT INTO `syarat_pendadaran` (`id`, `naskah`, `id_ujian_skripsi`, `berita_acara_seminar`, `daftar_nilai_sementara`, `krs_terbaru`, `dokumen_identitas`, `sertifikat_toefl_niit`, `sertifikat_office_puskom`, `sertifikat_btq_ibadah`, `sertifikat_bahasa`, `sertifikat_kompetensi_ujian_komprehensif`, `sertifikat_semaba_ppk_masta`, `sertifikat_kkn`, `buku_kendali_bimbingan`, `bukti_pembayaran_sidang`, `ipk`, `status`, `catatan`) VALUES
(4, '', 70, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0.00, NULL, NULL),
(5, 'naskah_689eaaf6be2a13_97723358.pdf', 68, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syarat_sempro`
--

CREATE TABLE `syarat_sempro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naskah` varchar(255) NOT NULL,
  `id_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `fotokopi_daftar_nilai` varchar(255) DEFAULT NULL,
  `fotokopi_krs` varchar(255) DEFAULT NULL,
  `buku_kendali_bimbingan` varchar(255) DEFAULT NULL,
  `lembar_revisi_ba_dan_tanda_terima_laporan_kp` varchar(255) DEFAULT NULL,
  `bukti_seminar_teman` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syarat_sempro`
--

INSERT INTO `syarat_sempro` (`id`, `naskah`, `id_ujian_skripsi`, `fotokopi_daftar_nilai`, `fotokopi_krs`, `buku_kendali_bimbingan`, `lembar_revisi_ba_dan_tanda_terima_laporan_kp`, `bukti_seminar_teman`, `status`, `catatan`) VALUES
(12, '6811d941e576d.pdf', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '683ffff1cb1ce.pdf', 69, '68400003679ce.pdf', '683ffff1cd305.pdf', '683ffff1c770c.pdf', NULL, '683ffff1c950b.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai_ujian_skripsi`
--

CREATE TABLE `tbl_nilai_ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_komponen_nilai` bigint(20) UNSIGNED NOT NULL,
  `id_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `id_penguji` bigint(20) UNSIGNED NOT NULL,
  `nilai` float NOT NULL CHECK (`nilai` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nilai_ujian_skripsi`
--

INSERT INTO `tbl_nilai_ujian_skripsi` (`id`, `id_komponen_nilai`, `id_ujian_skripsi`, `id_penguji`, `nilai`) VALUES
(413, 56, 37, 32, 81),
(414, 57, 37, 32, 82),
(415, 58, 37, 32, 83),
(416, 59, 37, 32, 84),
(417, 60, 37, 32, 85),
(463, 56, 37, 31, 81),
(464, 57, 37, 31, 82),
(465, 58, 37, 31, 81),
(466, 59, 37, 31, 80),
(467, 60, 37, 31, 81),
(478, 56, 37, 35, 80),
(479, 57, 37, 35, 80),
(480, 58, 37, 35, 81),
(481, 59, 37, 35, 80),
(482, 60, 37, 35, 80),
(483, 56, 37, 43, 81),
(484, 57, 37, 43, 82),
(485, 58, 37, 43, 83),
(486, 59, 37, 43, 84),
(487, 60, 37, 43, 85);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_skripsi`
--

CREATE TABLE `ujian_skripsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_skripsi` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `penguji1` bigint(20) UNSIGNED DEFAULT NULL,
  `penguji2` bigint(20) UNSIGNED DEFAULT NULL,
  `penguji3` bigint(20) UNSIGNED DEFAULT NULL,
  `id_jenis_ujian_skripsi` bigint(20) UNSIGNED NOT NULL,
  `persetujuan_pembimbing1` tinyint(1) DEFAULT 0,
  `persetujuan_pembimbing2` tinyint(1) DEFAULT 0,
  `status` enum('Berlangsung','Diterima','Perbaikan','Mengulang') DEFAULT 'Berlangsung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian_skripsi`
--

INSERT INTO `ujian_skripsi` (`id`, `id_skripsi`, `tanggal`, `tanggal_daftar`, `ruang`, `penguji1`, `penguji2`, `penguji3`, `id_jenis_ujian_skripsi`, `persetujuan_pembimbing1`, `persetujuan_pembimbing2`, `status`) VALUES
(37, 12, '2025-05-09', '2025-01-01', 'R-203', 31, 32, NULL, 16, 1, 0, 'Perbaikan'),
(68, 12, '2025-08-15', '2025-05-01', 'R-203', 13, 32, NULL, 17, 0, 0, 'Berlangsung'),
(69, 22, NULL, '2025-05-23', NULL, NULL, NULL, NULL, 16, 0, 0, 'Berlangsung'),
(70, 22, NULL, '2025-05-23', NULL, NULL, NULL, NULL, 17, 0, 0, 'Berlangsung'),
(71, 23, NULL, '2025-06-16', NULL, NULL, NULL, NULL, 16, 0, 0, 'Berlangsung');

-- --------------------------------------------------------

--
-- Table structure for table `validasi_syarat_pendadaran`
--

CREATE TABLE `validasi_syarat_pendadaran` (
  `id` int(11) NOT NULL,
  `id_syarat_pendadaran` bigint(20) UNSIGNED NOT NULL,
  `nama_field_syarat` varchar(100) NOT NULL,
  `status` enum('Diterima','Revisi','Menunggu') NOT NULL DEFAULT 'Menunggu',
  `catatan` text DEFAULT NULL,
  `id_validator` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `validasi_syarat_sempro`
--

CREATE TABLE `validasi_syarat_sempro` (
  `id` int(11) NOT NULL,
  `id_syarat_sempro` bigint(20) UNSIGNED NOT NULL,
  `nama_field_syarat` varchar(100) NOT NULL,
  `status` enum('Diterima','Revisi','Menunggu') NOT NULL DEFAULT 'Menunggu',
  `catatan` text DEFAULT NULL,
  `id_validator` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apresiasi_ujian_skripsi`
--
ALTER TABLE `apresiasi_ujian_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_apresisasi_penguji` (`id_penguji`),
  ADD KEY `fk_apresisasi_ujian_skripsi` (`id_ujian_skripsi`);

--
-- Indexes for table `data_dosen`
--
ALTER TABLE `data_dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidk` (`nidk`);

--
-- Indexes for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telepon` (`telepon`);

--
-- Indexes for table `jenis_ujian_skripsi`
--
ALTER TABLE `jenis_ujian_skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mstr_akun`
--
ALTER TABLE `mstr_akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mstr_komponen_nilai_ujian_skripsi`
--
ALTER TABLE `mstr_komponen_nilai_ujian_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mst_komponen_jenis_skripsi` (`id_jenis_ujian_skripsi`);

--
-- Indexes for table `saran_ujian_skripsi`
--
ALTER TABLE `saran_ujian_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saran_penguji` (`id_penguji`),
  ADD KEY `fk_saran_ujian_skripsi` (`id_ujian_skripsi`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `pembimbing1` (`pembimbing1`),
  ADD KEY `pembimbing2` (`pembimbing2`);

--
-- Indexes for table `syarat_pendadaran`
--
ALTER TABLE `syarat_pendadaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian_skripsi` (`id_ujian_skripsi`);

--
-- Indexes for table `syarat_sempro`
--
ALTER TABLE `syarat_sempro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian_skripsi` (`id_ujian_skripsi`);

--
-- Indexes for table `tbl_nilai_ujian_skripsi`
--
ALTER TABLE `tbl_nilai_ujian_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_sempro` (`id_ujian_skripsi`,`id_komponen_nilai`,`id_penguji`),
  ADD KEY `tbl_nilai_sempro_ibfk_3` (`id_penguji`),
  ADD KEY `tbl_nilai_sempro_ibfk_4` (`id_komponen_nilai`);

--
-- Indexes for table `ujian_skripsi`
--
ALTER TABLE `ujian_skripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_skripsi` (`id_skripsi`),
  ADD KEY `penguji1` (`penguji1`),
  ADD KEY `penguji2` (`penguji2`),
  ADD KEY `fk_ujian_jenis` (`id_jenis_ujian_skripsi`),
  ADD KEY `penguji3` (`penguji3`);

--
-- Indexes for table `validasi_syarat_pendadaran`
--
ALTER TABLE `validasi_syarat_pendadaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_syarat_field` (`id_syarat_pendadaran`,`nama_field_syarat`);

--
-- Indexes for table `validasi_syarat_sempro`
--
ALTER TABLE `validasi_syarat_sempro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_syarat_field` (`id_syarat_sempro`,`nama_field_syarat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apresiasi_ujian_skripsi`
--
ALTER TABLE `apresiasi_ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jenis_ujian_skripsi`
--
ALTER TABLE `jenis_ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mstr_akun`
--
ALTER TABLE `mstr_akun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `mstr_komponen_nilai_ujian_skripsi`
--
ALTER TABLE `mstr_komponen_nilai_ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `saran_ujian_skripsi`
--
ALTER TABLE `saran_ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `syarat_pendadaran`
--
ALTER TABLE `syarat_pendadaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `syarat_sempro`
--
ALTER TABLE `syarat_sempro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_nilai_ujian_skripsi`
--
ALTER TABLE `tbl_nilai_ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `ujian_skripsi`
--
ALTER TABLE `ujian_skripsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `validasi_syarat_pendadaran`
--
ALTER TABLE `validasi_syarat_pendadaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `validasi_syarat_sempro`
--
ALTER TABLE `validasi_syarat_sempro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apresiasi_ujian_skripsi`
--
ALTER TABLE `apresiasi_ujian_skripsi`
  ADD CONSTRAINT `fk_apresisasi_penguji` FOREIGN KEY (`id_penguji`) REFERENCES `data_dosen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_apresisasi_ujian_skripsi` FOREIGN KEY (`id_ujian_skripsi`) REFERENCES `ujian_skripsi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `data_dosen`
--
ALTER TABLE `data_dosen`
  ADD CONSTRAINT `data_dosen_ibfk_1` FOREIGN KEY (`id`) REFERENCES `mstr_akun` (`id`);

--
-- Constraints for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  ADD CONSTRAINT `data_mahasiswa_ibfk_1` FOREIGN KEY (`id`) REFERENCES `mstr_akun` (`id`);

--
-- Constraints for table `mstr_komponen_nilai_ujian_skripsi`
--
ALTER TABLE `mstr_komponen_nilai_ujian_skripsi`
  ADD CONSTRAINT `fk_mst_komponen_jenis_skripsi` FOREIGN KEY (`id_jenis_ujian_skripsi`) REFERENCES `jenis_ujian_skripsi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `saran_ujian_skripsi`
--
ALTER TABLE `saran_ujian_skripsi`
  ADD CONSTRAINT `fk_saran_penguji` FOREIGN KEY (`id_penguji`) REFERENCES `data_dosen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_saran_ujian_skripsi` FOREIGN KEY (`id_ujian_skripsi`) REFERENCES `ujian_skripsi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD CONSTRAINT `skripsi_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `data_mahasiswa` (`id`),
  ADD CONSTRAINT `skripsi_ibfk_2` FOREIGN KEY (`pembimbing1`) REFERENCES `data_dosen` (`id`),
  ADD CONSTRAINT `skripsi_ibfk_3` FOREIGN KEY (`pembimbing2`) REFERENCES `data_dosen` (`id`);

--
-- Constraints for table `syarat_pendadaran`
--
ALTER TABLE `syarat_pendadaran`
  ADD CONSTRAINT `syarat_pendadaran_ibfk_1` FOREIGN KEY (`id_ujian_skripsi`) REFERENCES `ujian_skripsi` (`id`);

--
-- Constraints for table `syarat_sempro`
--
ALTER TABLE `syarat_sempro`
  ADD CONSTRAINT `syarat_sempro_ibfk_1` FOREIGN KEY (`id_ujian_skripsi`) REFERENCES `ujian_skripsi` (`id`);

--
-- Constraints for table `tbl_nilai_ujian_skripsi`
--
ALTER TABLE `tbl_nilai_ujian_skripsi`
  ADD CONSTRAINT `tbl_nilai_ujian_skripsi_ibfk_2` FOREIGN KEY (`id_ujian_skripsi`) REFERENCES `ujian_skripsi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_nilai_ujian_skripsi_ibfk_3` FOREIGN KEY (`id_penguji`) REFERENCES `data_dosen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_nilai_ujian_skripsi_ibfk_4` FOREIGN KEY (`id_komponen_nilai`) REFERENCES `mstr_komponen_nilai_ujian_skripsi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ujian_skripsi`
--
ALTER TABLE `ujian_skripsi`
  ADD CONSTRAINT `fk_ujian_jenis` FOREIGN KEY (`id_jenis_ujian_skripsi`) REFERENCES `jenis_ujian_skripsi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ujian_skripsi_penguji3` FOREIGN KEY (`penguji3`) REFERENCES `data_dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ujian_skripsi_ibfk_1` FOREIGN KEY (`id_skripsi`) REFERENCES `skripsi` (`id`),
  ADD CONSTRAINT `ujian_skripsi_ibfk_2` FOREIGN KEY (`penguji1`) REFERENCES `data_dosen` (`id`),
  ADD CONSTRAINT `ujian_skripsi_ibfk_3` FOREIGN KEY (`penguji2`) REFERENCES `data_dosen` (`id`);

--
-- Constraints for table `validasi_syarat_pendadaran`
--
ALTER TABLE `validasi_syarat_pendadaran`
  ADD CONSTRAINT `validasi_syarat_pendadaran_ibfk_1` FOREIGN KEY (`id_syarat_pendadaran`) REFERENCES `syarat_pendadaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `validasi_syarat_sempro`
--
ALTER TABLE `validasi_syarat_sempro`
  ADD CONSTRAINT `validasi_syarat_sempro_ibfk_1` FOREIGN KEY (`id_syarat_sempro`) REFERENCES `syarat_sempro` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
