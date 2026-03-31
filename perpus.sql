-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2026 pada 14.52
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
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori_id` int(11) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `kategori_id`, `stok`, `cover`, `qr_code`, `created_at`, `updated_at`) VALUES
(6, 'To Kill a Mockingbird', 'localhost', 'localhost', '2026', 1, 1, '1772693161_6d368e145c30af1ce6f0.jpg', '1772693164.svg', '2026-03-05 06:46:09', '2026-03-18 13:40:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Sains'),
(2, 'Teknologi'),
(3, 'Sastra'),
(4, 'Sejarah'),
(5, 'Psikologi'),
(6, 'Fiksi'),
(7, 'Non-Fiksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-03-05-032516', 'App\\Database\\Migrations\\CreateRolesTable', 'default', 'App', 1772681251, 1),
(2, '2026-03-05-032517', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1772681251, 1),
(3, '2026-03-05-032518', 'App\\Database\\Migrations\\CreateKategoriTable', 'default', 'App', 1772681251, 1),
(4, '2026-03-05-032519', 'App\\Database\\Migrations\\CreateBukuTable', 'default', 'App', 1772681251, 1),
(5, '2026-03-05-032520', 'App\\Database\\Migrations\\CreatePeminjamanTable', 'default', 'App', 1772681251, 1),
(6, '2026-03-05-130525', 'App\\Database\\Migrations\\AddPaymentFieldsToPeminjaman', 'default', 'App', 1772716281, 2),
(7, '2026-03-07-195400', 'App\\Database\\Migrations\\CreatePaymentsTable', 'default', 'App', 1772888012, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `peminjaman_id` int(11) UNSIGNED NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `peminjaman_id`, `transaction_code`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 'TRX69BAAB6861811', 4000, 'qris', 'paid', '2026-03-18 13:40:56', '2026-03-18 13:42:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `buku_id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') NOT NULL DEFAULT 'Dipinjam',
  `denda` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pembayaran_status` enum('Belum Dibayar','Pending','Lunas','Gagal') DEFAULT 'Belum Dibayar',
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `buku_id`, `nama_lengkap`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `status`, `denda`, `pembayaran_status`, `snap_token`, `created_at`, `updated_at`) VALUES
(3, 3, 6, 'siti', '2026-03-05', '2026-03-12', '2026-03-19', 'Terlambat', 0.00, 'Belum Dibayar', NULL, '2026-03-05 06:50:04', '2026-03-05 06:50:17'),
(4, 3, 6, 'siti', '2026-03-05', '2026-03-12', '2026-03-05', 'Dikembalikan', 0.00, 'Belum Dibayar', NULL, '2026-03-05 06:50:29', '2026-03-05 06:53:48'),
(5, 3, 6, '', '2026-03-05', '2026-03-12', '2026-03-26', 'Terlambat', 0.00, 'Belum Dibayar', NULL, '2026-03-05 07:00:37', '2026-03-05 07:00:37'),
(6, 3, 6, '', '2026-03-05', '2026-03-12', '2026-03-26', 'Dikembalikan', 14000.00, 'Lunas', 'MOCK-SNAP-ee5819b97db04a09', '2026-03-05 07:01:47', '2026-03-26 07:03:39'),
(7, 3, 6, '', '2026-03-07', '2026-03-14', '2026-03-18', 'Dikembalikan', 4000.00, 'Lunas', NULL, '2026-03-07 13:38:24', '2026-03-18 13:42:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Petugas'),
(3, 'Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `nama_lengkap`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$Y.zQdR7Na2P/10JnGKVWNuliEtPbh9KpA/OyL8ehLixwKfVH/o/NC', 1, 'Administrator', 'Kantor Pusat', NULL, '2026-03-05 03:38:48', NULL),
(2, 'petugas1', 'petugas1@example.com', '$2y$10$2mxKFnYnZZ1kk.NDicL7muAJjwKUCx5gxO8Sm9m5YC0PDha2vrMaK', 2, 'Budi Staff', 'Jl. Pustaka No. 10', NULL, '2026-03-05 03:38:48', NULL),
(3, 'member1', 'member1@example.com', '$2y$10$F0NpuevF8TJJ0uec2cI/P.11IFUyA5qH303BUyE1Sdc/P9DAOYpVK', 3, 'Siti Member', 'Jl. Buku No. 5', NULL, '2026-03-05 03:38:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_buku_id_foreign` (`buku_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
