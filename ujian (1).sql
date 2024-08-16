-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 04:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jml_benar` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `bobot_nilai` int(11) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `ujian_id`, `mahasiswa_id`, `jml_benar`, `nilai`, `bobot_nilai`, `tanggal_mulai`, `tanggal_selesai`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 4, 4, 110, 120, '2023-07-15 12:16:39', '2023-07-15 12:17:25', 1, '2023-07-15 05:16:39', '2023-07-15 05:17:25'),
(7, 1, 4, 2, 30, 30, '2023-07-17 09:55:39', '2023-07-17 10:28:51', 1, '2023-07-17 02:55:39', '2023-07-17 03:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_detail`
--

CREATE TABLE `hasil_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hasil_id` bigint(20) UNSIGNED DEFAULT NULL,
  `soal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_detail`
--

INSERT INTO `hasil_detail` (`id`, `hasil_id`, `soal_id`, `jawaban`, `nilai`, `status`, `created_at`, `updated_at`) VALUES
(11, 6, 5, 'd', 20, 1, '2023-07-15 05:16:39', '2023-07-15 05:16:50'),
(12, 6, 1, 'wanda tersenyum', 40, 2, '2023-07-15 05:16:39', '2023-07-15 05:17:02'),
(13, 6, 2, 'a', 10, 2, '2023-07-15 05:16:39', '2023-07-15 05:17:10'),
(14, 6, 4, 'biru', 40, 2, '2023-07-15 05:16:39', '2023-07-15 05:17:17'),
(15, 6, 3, 'c', 0, 3, '2023-07-15 05:16:39', '2023-07-15 05:17:25'),
(16, 7, 2, 'a', 10, 2, '2023-07-17 02:55:39', '2023-07-17 03:27:58'),
(17, 7, 5, 'd', 20, 2, '2023-07-17 02:55:39', '2023-07-17 03:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(2, 'Manajemen Bisnis', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(3, 'Akuntansi', '2023-07-14 17:37:22', '2023-07-14 17:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_matkul`
--

CREATE TABLE `jurusan_matkul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matkul_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jurusan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `jurusan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(1, 'AX1001', 1, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(2, 'MB2002', 2, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(3, 'AK3003', 3, '2023-07-14 17:37:22', '2023-07-14 17:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_dosen`
--

CREATE TABLE `kelas_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dosen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_dosen`
--

INSERT INTO `kelas_dosen` (`id`, `kelas_id`, `dosen_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '2023-07-15 04:57:27', '2023-07-15 04:57:27'),
(3, 2, 2, '2023-07-15 04:57:27', '2023-07-15 04:57:27'),
(6, 3, 3, '2023-07-15 05:11:55', '2023-07-15 05:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_matkul` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `nama_matkul`, `created_at`, `updated_at`) VALUES
(1, 'Pemrograman Dasar', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(2, 'Basis Data', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(3, 'Algoritma dan Struktur Data', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(4, 'Manajemen Keuangan', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(5, 'Pemasaran', '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(6, 'Akuntansi Keuangan', '2023-07-14 17:37:22', '2023-07-14 17:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_07_01_094537_create_jurusans_table', 1),
(4, '2023_07_01_094608_create_matkuls_table', 1),
(5, '2023_07_01_094627_create_kelas_table', 1),
(6, '2023_07_01_094630_create_users_table', 1),
(7, '2023_07_01_094655_create_jurusan_matkuls_table', 1),
(8, '2023_07_01_094924_create_kelas_dosens_table', 1),
(9, '2023_07_01_094952_create_m_ujians_table', 1),
(10, '2023_07_01_095106_create_soals_table', 1),
(11, '2023_07_01_095204_create_hasils_table', 1),
(12, '2023_07_01_103513_create_hasil_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `matkul_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bobot` int(11) NOT NULL DEFAULT 1,
  `gambar_soal` varchar(255) DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `tipe` int(11) NOT NULL DEFAULT 0,
  `opsi_a` text DEFAULT NULL,
  `opsi_b` text DEFAULT NULL,
  `opsi_c` text DEFAULT NULL,
  `opsi_d` text DEFAULT NULL,
  `opsi_e` text DEFAULT NULL,
  `gambar_a` varchar(255) DEFAULT NULL,
  `gambar_b` varchar(255) DEFAULT NULL,
  `gambar_c` varchar(255) DEFAULT NULL,
  `gambar_d` varchar(255) DEFAULT NULL,
  `gambar_e` varchar(255) DEFAULT NULL,
  `jawaban` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `dosen_id`, `matkul_id`, `bobot`, `gambar_soal`, `soal`, `tipe`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `gambar_a`, `gambar_b`, `gambar_c`, `gambar_d`, `gambar_e`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 40, 'img/gambar_soal/gambar_soal_1689178250.jpg', 'dari gambar dibawah ini jelaskan cara kerjanya', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 10, NULL, '<p>1+1 =</p>', 0, '<p>2</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', '<p>6</p>', NULL, NULL, NULL, NULL, 'img/gambar_opsi/gambar_soal_1689178284.jpg', 'a', NULL, NULL),
(3, 2, 1, 10, NULL, '<p>kamu+dia =</p>', 0, '<p>kita</p>', '<p>mustahil</p>', '<p>haha</p>', '<p>5</p>', '<p>6</p>', NULL, NULL, NULL, NULL, NULL, 'b', NULL, NULL),
(4, 2, 1, 40, 'img/gambar_soal\\gambar_soal_1689397989.jpg', '<p>nebula berwarna</p>', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 05:13:09', '2023-07-15 05:13:09'),
(5, 2, 1, 20, 'img/gambar_soal\\gambar_soal_1689398051.jpg', '<p>siapa kah ini</p>', 0, '<p>war machin</p>', '<p>captain america</p>', '<p>black panter</p>', '<p>winter soldier</p>', '<p>iron man</p>', NULL, NULL, NULL, NULL, NULL, 'd', '2023-07-15 05:14:11', '2023-07-15 05:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `matkul_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_ujian` varchar(255) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `waktu` int(11) NOT NULL DEFAULT 0,
  `jenis` int(11) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id`, `dosen_id`, `matkul_id`, `nama_ujian`, `jumlah_soal`, `waktu`, `jenis`, `token`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'UTS', 2, 60, 0, 'O8JG7F', '2023-07-12 23:11:00', '2023-07-17 23:11:00', NULL, NULL),
(2, 2, 1, 'UTS susulan', 5, 2, 0, 'RAK4XR', '2023-07-14 12:15:00', '2023-07-16 12:15:00', '2023-07-15 05:15:23', '2023-07-15 05:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `matkul_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jurusan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `uid`, `password`, `jk`, `role`, `status`, `matkul_id`, `jurusan_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '0', '$2y$10$Wn4XsovLQCRwOgsif9rDXOUS5QNvVGXSWu0V8BDTFmFVdi04Su6yq', 'Laki-laki', 0, 1, NULL, NULL, NULL, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(2, 'dosen', 'dosen@gmail.com', '12321', '$2y$10$MTYjZsbcIVcuGDicXu3ApOhOtfO7qd2.1fqanCTy3QnkynYtCQMbi', 'male', 1, 1, 1, NULL, NULL, '2023-07-14 17:37:22', '2023-07-18 02:19:01'),
(3, 'dosen2', 'dosen2@gmail.com', '56789', '$2y$10$KSxiliJteLg47b3jghNIJurXtKcEfbD7wBIyKml4KnvsGvWIAqJAC', 'Perempuan', 1, 1, 4, NULL, NULL, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(4, 'mahasiswa', 'mahasiswa@gmail.com', '124124', '$2y$10$eLb7imfY.94807repnUqEOVWze4H9lNfRQwbkbg6K04bX27PwphrS', 'Perempuan', 2, 1, NULL, 1, 1, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(5, 'mahasiswa2', 'mahasiswa2@gmail.com', '567567', '$2y$10$7A/94dyi4MNqVaFLwgPffOqYpTm4CYkba.nZ6WNT1pt5YrVbHzwvm', 'Laki-laki', 2, 1, NULL, 2, 2, '2023-07-14 17:37:22', '2023-07-14 17:37:22'),
(6, 'mahasiswa3', 'mahasiswa3@gmail.com', '989898', '$2y$10$89msuz5RRfxxN6u0ONKeyu3ucG.3IdlVR86VcnUceN3he/3M28iIW', 'Perempuan', 2, 1, NULL, 3, 3, '2023-07-14 17:37:23', '2023-07-14 17:37:23'),
(7, 'daniel', 'daniel@gmail.com', '12321313', '$2y$10$bs5Aotwt71peDWzbMLGZ5.t5KXApWvQnccFRf8CFdZPezWwVmYece', 'Laki-laki', 2, 1, NULL, 1, 1, '2023-07-15 05:11:22', '2023-07-15 05:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_ujian_id_foreign` (`ujian_id`),
  ADD KEY `hasil_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `hasil_detail`
--
ALTER TABLE `hasil_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_detail_hasil_id_foreign` (`hasil_id`),
  ADD KEY `hasil_detail_soal_id_foreign` (`soal_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_matkul_matkul_id_foreign` (`matkul_id`),
  ADD KEY `jurusan_matkul_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_dosen_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelas_dosen_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_dosen_id_foreign` (`dosen_id`),
  ADD KEY `soal_matkul_id_foreign` (`matkul_id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ujian_dosen_id_foreign` (`dosen_id`),
  ADD KEY `ujian_matkul_id_foreign` (`matkul_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uid_unique` (`uid`),
  ADD KEY `users_matkul_id_foreign` (`matkul_id`),
  ADD KEY `users_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hasil_detail`
--
ALTER TABLE `hasil_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_ujian_id_foreign` FOREIGN KEY (`ujian_id`) REFERENCES `ujian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_detail`
--
ALTER TABLE `hasil_detail`
  ADD CONSTRAINT `hasil_detail_hasil_id_foreign` FOREIGN KEY (`hasil_id`) REFERENCES `hasil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_detail_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jurusan_matkul`
--
ALTER TABLE `jurusan_matkul`
  ADD CONSTRAINT `jurusan_matkul_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jurusan_matkul_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas_dosen`
--
ALTER TABLE `kelas_dosen`
  ADD CONSTRAINT `kelas_dosen_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_dosen_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `soal_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ujian_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
