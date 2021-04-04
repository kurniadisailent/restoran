-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2021 pada 08.47
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username`, `password`, `email`, `created_at`, `updated_at`, `remember_token`) VALUES
(9, 'Rizqy Resha Prameswara', 'Admin', '$2y$10$Vx.e2PsFhOQ6CWkyCM7o5OtFR1.r8qX6fGcOuYtGCYDb0yh//7mE2', 'Rizqyresha22@gmail.com', '2020-11-21 04:42:55', '2020-11-21 04:42:55', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_detail_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `kode_order` varchar(100) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `diskon` int(12) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `no_meja` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `session_id` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id_detail_order`, `id_order`, `kode_order`, `id_menu`, `nama_menu`, `harga_menu`, `diskon`, `total_bayar`, `jumlah_pesan`, `no_meja`, `status`, `session_id`) VALUES
(1, 1, 'ORD0109211', 32, 'Paimon', 1000000, 99, 50000, 5, 1, 'SELESAI', NULL),
(2, 1, 'ORD0109211', 24, 'Jus Jambu', 6000, 5, 34200, 6, 1, 'SELESAI', NULL),
(3, 1, 'ORD0109211', 23, 'Ice Cream Coklat', 12000, 10, 21600, 2, 1, 'SELESAI', NULL),
(4, 2, 'ORD0111211', 26, 'Mi Rebus Rumahan', 7000, 0, 14000, 2, 2, 'SELESAI', NULL),
(5, 2, 'ORD0111211', 27, 'Migoreng Rumahan', 8000, 2, 7840, 1, 2, 'SELESAI', NULL),
(6, 3, 'ORD0111212', 22, 'Hiu Goreng', 40000, 0, 80000, 2, 1, 'SELESAI', NULL),
(7, 4, 'ORD0112211', 24, 'Jus Jambu', 6000, 5, 5700, 1, 1, 'SELESAI', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kasir`
--

CREATE TABLE `tbl_kasir` (
  `id_kasir` int(11) NOT NULL,
  `file_foto_kasir` text NOT NULL,
  `nama_kasir` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` text DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kasir`
--

INSERT INTO `tbl_kasir` (`id_kasir`, `file_foto_kasir`, `nama_kasir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `username`, `password`, `created_at`, `updated_at`, `remember_token`, `status`) VALUES
(1, 'Paimon1607400822.jpg', 'Paimon', 'Perempuan', 'JL.Raya Teyvat', '081283772839', 'paimon@com.com', 'mahoyo', '$2y$10$WaHFeBUwh.IstDWXY7wVLePR3ibDHlRJXbwowiP8BPLxmr7OWZUFi', '2020-12-07 21:13:42', '2020-12-07 21:13:50', NULL, 'Aktif'),
(4, 'widejetsu1608609367.jpg', 'widejetsu', 'Laki-Laki', 'asafasf', '12312', 'asfasf@sfa', '141asfasf', '$2y$10$8/x.QwSGgIUXad2OlpYDxec/zh7jQch5NbzyYliu.bEcN6enu3V3i', '2020-12-21 20:56:07', '2020-12-21 20:56:07', NULL, 'Aktif'),
(5, 'Tacit1610508497.jpg', 'Tacit Tingfang', 'Perempuan', 'alsfkljasfk', '1231212124', 'asfasf@afas', 'kasir', '$2y$10$S77DrXFshHKvNhV/BJA13enk7AebonZFUspLqYonyRRCdY4iS.25m', '2021-01-12 20:28:17', '2021-01-12 20:45:03', NULL, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_transaksi` int(11) DEFAULT NULL,
  `jumlah_penghasilan` int(11) DEFAULT NULL,
  `jumlah_suplier_masuk` int(11) DEFAULT NULL,
  `jumlah_produk_terjual` int(11) DEFAULT NULL,
  `jumlah_uang_keluar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `tanggal`, `jumlah_transaksi`, `jumlah_penghasilan`, `jumlah_suplier_masuk`, `jumlah_produk_terjual`, `jumlah_uang_keluar`) VALUES
(1, '2021-01-09', 1, 110000, NULL, 13, NULL),
(2, '2021-01-11', 2, 125000, NULL, 5, NULL),
(3, '2021-01-13', 2, 12000, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meja`
--

CREATE TABLE `tbl_meja` (
  `id_meja` int(11) NOT NULL,
  `no_meja` varchar(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meja`
--

INSERT INTO `tbl_meja` (`id_meja`, `no_meja`, `keterangan`, `status`) VALUES
(25, '5', 'asfsa', 'KOSONG'),
(26, '6', 'safsaf', 'KOSONG'),
(31, '1', 'safas', 'DITEMPATI'),
(34, '4', 'asdas', 'KOSONG'),
(35, '2', 'asfasf', 'KOSONG'),
(36, '3', 'asfsaf', 'KOSONG'),
(37, '7', 'asfasf', 'KOSONG'),
(38, '8', 'aasfsaf', 'KOSONG'),
(39, '9', 'asfasfsaf', 'KOSONG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `file_gambar_menu` text NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `file_gambar_menu`, `nama_menu`, `nama_kategori`, `deskripsi`, `harga`, `diskon`, `stok`, `status`) VALUES
(22, 'gambar_menu_1609662107.jpg', 'Hiu Goreng', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 40000, 0, 83, 'Tersedia'),
(23, 'gambar_menu_1609662133.jpg', 'Ice Cream Coklat', 'Dessert', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 12000, 10, 92, 'Tersedia'),
(24, 'gambar_menu_1609662164.jpg', 'Jus Jambu', 'Minuman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 6000, 5, 84, 'Tersedia'),
(25, 'gambar_menu_1609662194.jpg', 'Eskrim Magnum', 'Dessert', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 13000, 1, 79, 'Tersedia'),
(26, 'gambar_menu_1609662230.jpg', 'Mi Rebus Rumahan', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 7000, 0, 88, 'Tersedia'),
(27, 'gambar_menu_1609662250.jpg', 'Migoreng Rumahan', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 8000, 2, 95, 'Tersedia'),
(28, 'gambar_menu_1609662273.jpg', 'Nasigoreng Yunani', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 100000, 25, 90, 'Tersedia'),
(29, 'gambar_menu_1609662289.jpg', 'Pepsi', 'Minuman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 5000, 0, 100, 'Tersedia'),
(30, 'gambar_menu_1609662311.jpg', 'Piza Itali', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 40000, 0, 90, 'Tersedia'),
(31, 'gambar_menu_1609662334.jpg', 'Tamusu', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 9000, 3, 100, 'Tersedia'),
(32, 'gambar_menu_1609662367.jpg', 'Paimon', 'Makanan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed auctor justo, ac viverra purus. Integer bibendum faucibus ante ornare pretium. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ac luctus tellus. Sed dapibus eros neque, ut faucibus risus ultricies imperdiet. Vivamus id feugiat orci. Proin facilisis dapibus lectus eget posuere. Nam non sodales enim. Nullam eget augue nec neque laoreet aliquet. Suspendisse eget sagittis turpis.', 1000000, 99, 4, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(11) NOT NULL,
  `kode_order` varchar(100) NOT NULL,
  `id_meja` int(11) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `level_petugas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `kode_order`, `id_meja`, `no_meja`, `id_pelanggan`, `nama_pelanggan`, `tanggal`, `total_bayar`, `keterangan`, `status`, `id_petugas`, `level_petugas`) VALUES
(1, 'ORD0109211', 31, 1, 1, 'Rizqy Resha P', '2021-01-09', 105800, 'nodesc', 'SELESAI', NULL, 'PELANGGAN'),
(2, 'ORD0111211', 35, 2, 1, 'Rizqy Resha P', '2021-01-11', 21840, 'nodesc', 'SELESAI', NULL, 'PELANGGAN'),
(3, 'ORD0111212', 31, 1, 1, 'Rizqy Resha P', '2021-01-11', 80000, 'nodesc', 'SELESAI', NULL, 'PELANGGAN'),
(4, 'ORD0112211', 31, 1, NULL, 'Rizqy Resha', '2021-01-12', 5700, 'nodesc', 'SELESAI', 4, 'waiter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_owner`
--

CREATE TABLE `tbl_owner` (
  `id_owner` int(11) NOT NULL,
  `nama_owner` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_owner`
--

INSERT INTO `tbl_owner` (`id_owner`, `nama_owner`, `username`, `password`, `email`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'RizqyR', 'rizqy', '$2y$10$uGo/dcQBxNJYa2eTAEF9hOtTv2z9TETkdMWrXCDzyMcxOuN1ExCG6', 'rizqy@gmail.com', '2020-12-07 21:45:22', '2020-12-07 21:45:30', NULL),
(5, 'owner', 'owner', '$2y$10$TTwY.FF0/ukRHNOnMoV4O.F0HMBVAoDpyQ.qaNz89kZlc97C1.rMK', 'jafsjk@jhzsdf', '2021-01-12 21:30:19', '2021-01-12 21:30:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(191) NOT NULL,
  `QRpassword` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `username`, `password`, `QRpassword`, `created_at`, `updated_at`, `remember_token`) VALUES
(8, 'Rizqy Resha Prameswara', 'cakrawalagaming0405@gmail.com', 'pelanggan', '$2y$10$P8UfmciUUoq9TCGL3lr73.zvzaRj22.SnvAyHQhYXLI9A2luO6FBi', 'pelanggan21-01-11Bns1drLZM9TFEilbpLLEHt2UXu56rxfnexY8u2RC', '2021-01-11 03:57:59', '2021-01-11 10:32:02', NULL),
(9, 'Rizqy Resha R', 'rizqyresha22@gmail.com', 'rezqy', '$2y$10$dmF2WdWr9qR9suRysDL8WespcJbYZBRo.FPLu1ZkvOHTnl7wGLbAi', 'rezqy21-01-12XEA5Ehv6kHVic3jUgedJmnmM0FNJuieHpJ7dxSEI', '2021-01-12 08:11:37', '2021-01-12 08:11:37', NULL),
(10, 'REZZGER', 'asfgjk@jkasfjk', 'rez', '$2y$10$E9EqPMiHVGwAosPwJLntSOub8YNirUOniFw/aUbBaHWfQx/zA6Kqa', 'rez21-01-12PUq4NIfW4JofROioU7fZMe9Wz4pyHerXEb7RtwZK', '2021-01-12 08:12:22', '2021-01-12 08:12:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaturan`
--

CREATE TABLE `tbl_pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `logo_restoran` text NOT NULL,
  `nama_restoran` text NOT NULL,
  `tentang_restoran` text NOT NULL,
  `baner_1` text NOT NULL,
  `baner_2` text NOT NULL,
  `baner_3` text NOT NULL,
  `small_baner1` text NOT NULL,
  `small_baner2` text NOT NULL,
  `smallbaner` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengaturan`
--

INSERT INTO `tbl_pengaturan` (`id_pengaturan`, `logo_restoran`, `nama_restoran`, `tentang_restoran`, `baner_1`, `baner_2`, `baner_3`, `small_baner1`, `small_baner2`, `smallbaner`) VALUES
(1, 'logo_restoran_1610328913.png', 'WANMIN', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ac sem sit amet turpis vestibulum sollicitudin sit amet et eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec imperdiet nec ex ut rhoncus. Donec pharetra dignissim consectetur. Fusce id lacinia urna. Aliquam dignissim risus metus, sit amet convallis nunc commodo condimentum. Praesent eget finibus ligula. Nulla pretium neque a lacus pulvinar faucibus. Praesent aliquet pulvinar felis, eu convallis purus vulputate eget. Quisque dui justo, pellentesque nec ultricies in, scelerisque sed neque. Nunc eu semper nibh, pretium dapibus eros. Praesent sed suscipit nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id sollicitudin risus, vitae bibendum nisi.\r\n\r\nQuisque sit amet justo at mi varius aliquam et id velit. Proin diam massa, efficitur in ligula eget, porta molestie nulla. Duis nisl orci, sagittis sit amet dictum eget, sollicitudin sit amet odio. Sed dignissim accumsan elit. Morbi in maximus dolor, quis sollicitudin purus. Nullam iaculis arcu ut neque euismod, fringilla posuere dolor interdum. Sed commodo neque at malesuada suscipit.', 'baner1_1610329467.jpg', 'baner2_1610329467.jpg', 'baner3_1610329467.jpg', 'small_baner1_1610332601.jpg', 'small_baner2_1610332601.jpg', 'OFF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `id_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `kode_order` varchar(100) NOT NULL,
  `file_struk_transaksi` text DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `jumlah_menu_dipesan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `level_petugas` varchar(10) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_order`, `kode_order`, `file_struk_transaksi`, `id_pelanggan`, `nama_pelanggan`, `total_bayar`, `jumlah_bayar`, `kembalian`, `jumlah_menu_dipesan`, `tanggal`, `level_petugas`, `id_petugas`) VALUES
(1, 1, 'ORD0109211', NULL, 1, 'Rizqy Resha P', 105800, 110000, 4200, 13, '2021-01-09', 'ADMIN', 9),
(2, 2, 'ORD0111211', NULL, 1, 'Rizqy Resha P', 21840, 25000, 3160, 3, '2021-01-11', 'ADMIN', 9),
(3, 3, 'ORD0111212', NULL, 1, 'Rizqy Resha P', 80000, 100000, 20000, 2, '2021-01-11', 'ADMIN', 9),
(4, 4, 'ORD0112211', NULL, NULL, 'Rizqy Resha', 5700, 6000, 300, 1, '2021-01-13', 'KASIR', 5),
(5, 4, 'ORD0112211', NULL, NULL, 'Rizqy Resha', 5700, 6000, 300, 1, '2021-01-13', 'KASIR', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_waiter`
--

CREATE TABLE `tbl_waiter` (
  `id_waiter` int(11) NOT NULL,
  `file_foto_waiter` text NOT NULL,
  `nama_waiter` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_waiter`
--

INSERT INTO `tbl_waiter` (`id_waiter`, `file_foto_waiter`, `nama_waiter`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, `username`, `password`, `created_at`, `updated_at`, `remember_token`, `status`) VALUES
(2, 'RizqyReshaP1607357158.jpg', 'Rizqy Resha P', 'Laki-Laki', 'jl.rayaklpc', '081224224678', 'cakrawalagaming0405@gmail.com', 'minerf', '$2y$10$.iGQ7uRJ7MUnX57bV5rSMOJQJEzz1QJU.EX.2k0XzgvuKyq/Ftc8S', '2020-12-07 09:05:58', '2020-12-07 18:37:17', NULL, 'Non-Aktif'),
(3, 'GuzAzmiModeDewa1607388856.jpg', 'Guz Azmi Mode Dewa', 'Laki-Laki', 'Jl. Vrindafan rumah krisna rt 01 rw 02', '081382615596', 'zachary56@example.net', 'azmimyazmi', '$2y$10$zhbmoKo1aW4DSZ0zLvJvweEncDtr7GuM39ViPWS234vLFyVlAjcr2', '2020-12-07 17:54:17', '2020-12-07 20:31:24', NULL, 'Non-Aktif'),
(4, 'SEQUID1610500131.jpg', 'SEQUID', 'Perempuan', 'JL. Kwosawoski Rt20 rw100', '081927637212', 'ree@hotmail.com', 'sequid', '$2y$10$uOKKH3hSDeYJX7YWRW4CwefTQLxrInWwngJ0M7H.Q5W8nGTiuIRJ.', '2020-12-07 19:00:38', '2021-01-12 18:08:51', NULL, 'Aktif'),
(5, 'Minerf1607393251.jpg', 'Minerf', 'Laki-Laki', 'JL.Raya Unknown RT20 RW20', '081382615596', 'rizqyresha22@gmail.com', 'minerfamz2', '$2y$10$XKl50zU2Zg4W0r2JXt.5AOmc5lemPCKWnI3o5N3muNRM2yfZZRfFK', '2020-12-07 19:07:31', '2020-12-07 19:09:52', NULL, 'Aktif'),
(6, 'WideBlackZetsu1607393447.jpg', 'Wide Black Zetsu', 'Laki-Laki', 'JLJLKJLSJ', '12341212', 'cakrawalagaming0405@gmail.com', 'minerfamz1', '$2y$10$NwhgqyfkAevrB7VPuOyRsuJ2C.rEMcnq.yDs/0RB758PLRW85PuKm', '2020-12-07 19:10:47', '2020-12-07 20:31:30', NULL, 'Non-Aktif'),
(9, 'Paimon1610500059.jpg', 'Paimon', 'Perempuan', 'Jl. Raya Teyvat Rt01 Rw02', '08192738172', 'paimon@genshin.com', 'waiter', '$2y$10$VmXHo7vWkmsxhrNQMQgTEuIUTAIO763DLkjiZ0CSHaFGOTLA9ViEC', '2021-01-12 18:07:39', '2021-01-12 18:07:39', NULL, 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indeks untuk tabel `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indeks untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tbl_meja`
--
ALTER TABLE `tbl_meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`) USING BTREE;

--
-- Indeks untuk tabel `tbl_owner`
--
ALTER TABLE `tbl_owner`
  ADD PRIMARY KEY (`id_owner`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_pengaturan`
--
ALTER TABLE `tbl_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_waiter`
--
ALTER TABLE `tbl_waiter`
  ADD PRIMARY KEY (`id_waiter`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kasir`
--
ALTER TABLE `tbl_kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_meja`
--
ALTER TABLE `tbl_meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_owner`
--
ALTER TABLE `tbl_owner`
  MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengaturan`
--
ALTER TABLE `tbl_pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_waiter`
--
ALTER TABLE `tbl_waiter`
  MODIFY `id_waiter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
