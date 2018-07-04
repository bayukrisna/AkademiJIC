-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 Feb 2018 pada 03.24
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `via` varchar(255) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`id`, `username`, `tanggal`, `via`, `jumlah`, `pengirim`, `gambar`, `status`) VALUES
(1, 'admin', '	2017-07-18', 'bank', 50000, 'aldi', '', 'paid'),
(2, 'admin', '	2017-08-14', '1', 111, 'asd', 'Screenshot_(105)1.png', 'pending'),
(3, 'admin', '2018-01-15', '1', 10000, 'aldi', 'Screenshot_(106).png', 'pending'),
(4, 'sengak', '2018-01-15', '2', 10000, 'sengak', 'Screenshot_(105)2.png', 'pending'),
(5, 'user1', '2018-01-17', '1', 10000, 'user1', 'Screenshot_(105)3.png', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `order_id`, `buyer`, `service`, `link`, `quantity`, `price`, `status`, `date`) VALUES
(1, '100', 'admin', 'insatgram', 'https://www.instagram.com/p/BdWYNYYla6x/?taken-by=aldirahmanws', '100', 400, 'Pending', '2018-01-05'),
(2, '10', 'admin', 'instagram', 'aldirahmanws', '50000', 100000, 'Completed', '2018-01-05'),
(3, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'halo', '101', 404, 'Completed', '2018-01-10'),
(4, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'mantap', '100', 400, 'Completed', '2018-01-10'),
(5, '85', 'admin', 'Instagram Followers Views | Server 1 (Max 100k)', 'ea', '101', 505, 'Completed', '2018-01-10'),
(6, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'ea', '100', 400, 'Completed', '2018-01-10'),
(7, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'sad', '101', 404, 'Completed', '2018-01-11'),
(8, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'qwe', '111', 444, 'Completed', '2018-01-11'),
(9, '411', 'admin', 'Instagram Like Worldwide | Server 1 (Max 4k)', 'asd', '100', 400, 'Completed', '2018-01-11'),
(10, '449', 'admin', 'Instagram Followers (HQ, Max 20K, Instant Start, 10% Drop)', 'achnanda7', '100', 1000, 'Completed', '2018-01-15'),
(11, '443', 'admin', 'Instagram Likes (HQ, Max 10K, Instant)', 'https://www.instagram.com/p/Bc_vbhDAYq_/?taken-by=achnanda7', '100', 400, 'Completed', '2018-01-15'),
(12, '445', 'admin', 'Instagram Followers (Instant-2H, 10K/Day, Max 10k)', 'mrizqi_r', '200', 4000, 'Completed', '2018-01-15'),
(13, '445', 'admin', 'Instagram Followers (Instant-2H, 10K/Day, Max 10k)', 'https://www.instagram.com/abwxyz0/', '200', 4000, 'Completed', '2018-01-15'),
(14, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/BdWYNYYla6x/?taken-by=aldirahmanws', '100', 500, 'Completed', '2018-01-15'),
(15, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/aldirahmanws/', '100', 200, 'Completed', '2018-01-16'),
(16, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/Bc19vc0FFbV/?taken-by=aldirahmanws', '100', 200, 'Pending', '2018-01-16'),
(17, '414', 'admin', 'Instagram Likes USA (HQ, Instant, Super Speed)', 'https://www.instagram.com/p/Bc19vc0FFbV/?taken-by=aldirahmanws', '200', 1600, 'Pending', '2018-01-16'),
(18, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/BchOx_ghQrA/?taken-by=mrizqi_r', '200', 400, 'Pending', '2018-01-16'),
(19, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/BchOx_ghQrA/?taken-by=mrizqi_r', '1000', 2000, 'Pending', '2018-01-16'),
(20, '441', 'admin', 'YouTube Views (Non Drop, Lifetime Guarantee, 10-50K/Day)', 'https://www.youtube.com/watch?v=_nsu0Swks7M', '300', 4500, 'Pending', '2018-01-16'),
(21, '411', 'user1', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/Bcj8ozelqzC/?taken-by=aldirahmanws', '100', 200, 'Pending', '2018-01-17'),
(22, '411', 'admin', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/Bc19vc0FFbV/?taken-by=aldirahmanws', '100', 200, 'Pending', '2018-02-14'),
(23, '411', 'demo', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', 'https://www.instagram.com/p/Bcj8ozelqzC/?taken-by=aldirahmanws', '100', 200, 'Pending', '2018-02-14'),
(24, '302', 'demo', 'Facebook Page & Post/Photo/Status/Video Likes (HQ, Instant-3H, Fast, Unlimited)', 'https://www.facebook.com/aldirahmanws/posts/1211935445617972', '100', 1500, 'Pending', '2018-02-14'),
(25, '302', 'demo', 'Facebook Page & Post/Photo/Status/Video Likes (HQ, Instant-3H, Fast, Unlimited)', 'https://www.facebook.com/aldirahmanws/posts/1237267233084793', '100', 1500, 'Pending', '2018-02-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mudah`
--

CREATE TABLE `mudah` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mudah`
--

INSERT INTO `mudah` (`id`, `username`, `password`, `saldo`) VALUES
(1, 'admin', 'admin', '5000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `no` int(10) NOT NULL,
  `category` enum('IG','IGLIKE','IGVIEW','TW','FB','YT','GP','SC','WEB','VINE','CHEAT','WEBS','HOST') COLLATE utf8_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `rate` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `min` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `max` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider_id` int(10) NOT NULL,
  `status` enum('Tersedia','Tidak tersedia') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`no`, `category`, `service`, `rate`, `min`, `max`, `provider_id`, `status`) VALUES
(1, 'IG', 'Instagram Followers (HQ, Max 20K, Instant Start, 10% Drop)', '10', '100', '5000', 449, 'Tersedia'),
(2, 'IG', 'Instagram Followers (Instant-2H, 10K/Day, Max 10k)', '20', '200', '10000', 445, 'Tersedia'),
(3, 'IG', 'Instagram Followers (Username Only, Instant, Real & Active, Max 25k)', '16', '100', '300000', 115, 'Tersedia'),
(4, 'IG', 'Instagram Followers HQ | Server 1 (Max 20k, HQ)[Username]', '28', '100', '20000', 4499, 'Tidak tersedia'),
(5, 'IG', 'Instagram Followers HQ | Server 2 (Max 30k, HQ)[FULL LINK]', '30', '100', '30000', 19, 'Tidak tersedia'),
(6, 'IG', 'Instagram Followers HQ | Server 3 (Max 300k, HQ)[FULL LINK]', '33', '100', '300000', 11, 'Tidak tersedia'),
(7, 'IG', 'Instagram Followers Medium | Server 1 (Max 5k, Fake Account)[FULL LINK]', '15', '100', '5000', 21, 'Tidak tersedia'),
(8, 'IG', 'Instagram Followers Medium | Server 2 (Max 5k, No Refill, No Refund)[USERNAME ONLY]', '16', '100', '5000', 22, 'Tidak tersedia'),
(9, 'IG', 'Instagram Followers Medium | Server 3 (Max 20k, No Refill, No Refund)[FULL LINK]', '20', '100', '20000', 23, 'Tidak tersedia'),
(10, 'IG', 'Instagram Followers Country | Server 1 (Max 12k)[USERNAME ONLY]', '26', '200', '12000', 30, 'Tidak tersedia'),
(11, 'IG', 'Instagram Followers Country | Server 2 (Max 5k, HQ South America)[FULL LINK]', '28', '100', '5000', 31, 'Tidak tersedia'),
(12, 'IG', 'Instagram Followers Unlimited | Server 1 (Max 50k, HQ, Non Drop)[FULL LINK]', '32', '100', '5000', 39, 'Tidak tersedia'),
(13, 'IG', 'Instagram Followers Unlimited | Server 2 (Max 3M, HQ, Non Drop)[FULL LINK]', '35', '100', '3000000', 40, 'Tidak tersedia'),
(14, 'IG', 'âšœ Instagram Followers Indonesia | Server 1 (Max 1k, Manual, Proses 1x24 Jam)[USERNAME ONLY]', '55', '500', '1000', 7, 'Tidak tersedia'),
(15, 'IG', 'âšœ Instagram Followers Indonesia | Server 2 (Max 10k, Manual, Proses 1x24 Jam)[USERNAME ONLY]', '60', '100', '10000', 8, 'Tidak tersedia'),
(16, 'IG', 'âšœ Instagram Followers Indonesia | Server 3 (Max 15k, Manual, Proses 1x24 Jam)[USERNAME ONLY]', '65', '100', '15000', 19, 'Tidak tersedia'),
(17, 'IGLIKE', 'Instagram Likes (HQ, Max 10K, Instant)', '4', '100', '10000', 443, 'Tersedia'),
(18, 'IGLIKE', '	Instagram Likes (Real, Instant, SuperFast, Max 80K)', '2', '100', '80000', 411, 'Tersedia'),
(19, 'IGLIKE', 'Instagram Likes USA (HQ, Instant, Super Speed)', '8', '100', '50000', 414, 'Tersedia'),
(20, 'IGLIKE', 'Instagram Likes UK (HQ, Instant, Super Speed)', '8', '100', '3000', 424, 'Tersedia'),
(21, 'IGVIEW', 'Instagram Views (HQ, Max 15K, Instant)', '5', '100', '50000', 444, 'Tersedia'),
(22, 'IGVIEW', 'Instagram Views (Real, Instant, Unlimited!)', '6', '100', '100000', 31, 'Tersedia'),
(23, 'IGVIEW', 'Instagram Views [USA] HQ (Unlimited, Instant, Real)', '7', '100', '50000', 32, 'Tersedia'),
(24, 'IGVIEW', 'Instagram Views (Instant Start, Non-Drop, HQ)', '8', '100', '1000000', 30, 'Tersedia'),
(25, 'TW', 'Twitter Followers Eggs (USERNAME ONLY, Instant)', '12', '100', '100000', 47, 'Tersedia'),
(26, 'TW', 'Twitter Followers HQ (Max 500k, Instant, Non-Drop, 60D Refill)', '15', '100', '100000', 46, 'Tersedia'),
(27, 'TW', 'Twitter Followers (Real, Instant, 5-15k/Day, Non-Drop, Max 500k)', '13', '100', '60000', 163, 'Tersedia'),
(28, 'TW', 'Twitter Retweets (Max 5M, Fast, HQ, Unlimited)', '16', '100', '5000000', 13, 'Tidak tersedia'),
(29, 'TW', 'Twitter Favorites  (Max 200k, HQ, Real)', '30', '100', '200000', 222, 'Tidak tersedia'),
(30, 'TW', 'Twitter Like  (Max 1M, HQ, Unlimited)', '17', '100', '1000000', 10, 'Tidak tersedia'),
(31, 'TW', 'Twitter Poll Votes  (Max 500k, Fast, HQ, Speed 3k/Day)', '60', '100', '500000', 4, 'Tidak tersedia'),
(32, 'YT', 'YouTube Views (Non Drop, Lifetime Guarantee, 10-50K/Day)', '15', '100', '2500000', 441, 'Tersedia'),
(33, 'YT', 'Youtube Likes (Min 100, Real, Instant, 100-500k/Day, Non-Drop, Unlimited)', '40', '1000', '1000000', 237, 'Tersedia'),
(34, 'YT', 'Youtube Favorites (HQ, Instant, Non-Drop, Lifetime Guarantee, Max 50k)', '135', '100', '1000000', 253, 'Tersedia'),
(35, 'YT', 'Youtube Favorites (HQ, Instant-8 Hour, 20-50k/Day, Non-Drop, Max 50k)', '250', '100', '1000000', 254, 'Tersedia'),
(36, 'YT', 'Youtube Video Shares (HQ, Instant, Unlimited)', '50', '100', '5000', 255, 'Tersedia'),
(37, 'YT', 'Youtube Likes | Server 2 (Max 10k, Non Drop)', '130', '100', '10000', 268, 'Tidak tersedia'),
(38, 'YT', 'Youtube Dislikes (Max 5k, Non Drop)', '200', '100', '5000', 273, 'Tidak tersedia'),
(39, 'YT', 'Youtube Subscribers | Server 1 (Max 150k, HQ, 1-2k/Day)', '500', '100', '150000', 275, 'Tidak tersedia'),
(40, 'YT', 'Youtube Subscribers | Server 2 (Max 150k, HQ, 1k/Day)', '700', '100', '150000', 278, 'Tidak tersedia'),
(41, 'FB', 'REAL Facebook Page Likes (Non Drop, Super Speed, Refill, HQ, 30-50K/Day)', '13', '100', '200000', 448, 'Tersedia'),
(42, 'FB', 'Facebook Page Likes HQ (Non Drop, Instant, WW, Real)', '20', '100', '1000000', 425, 'Tersedia'),
(43, 'FB', 'Facebook Emotions  [ Love ] (Max 20k)', '15', '100', '20000', 318, 'Tersedia'),
(44, 'FB', 'Facebook Emotions [ ahaha ] (Max 20k)', '18', '100', '20000', 96, 'Tersedia'),
(45, 'FB', 'Facebook Emotions [ Wow ] (Max 20k)', '18', '100', '20000', 317, 'Tersedia'),
(46, 'FB', 'Facebook Emotions [ Sad ] (Max 20k)', '18', '100', '20000', 315, 'Tersedia'),
(47, 'FB', 'Facebook Emotions [ Angry ] (Max 15k)', '18', '100', '15000', 98, 'Tersedia'),
(48, 'FB', 'Facebook Page & Post/Photo/Status/Video Likes (HQ, Instant-3H, Fast, Unlimited)', '15', '100', '1000000', 302, 'Tersedia'),
(49, 'FB', 'Facebook Page & Post/Photo/Status/Video Shares (HQ, Instant, 10-30k/Day, Unlimited)', '15', '100', '100000', 307, 'Tersedia'),
(50, 'FB', 'Facebook Video Views (HQ, Instant, Multiples of 1k Only, Unlimited)', '5', '100', '10000000', 312, 'Tersedia'),
(51, 'SC', 'SoundCloud Plays (HQ, Fast Delivery, Unlimited)', '5', '100', '500000', 362, 'Tersedia'),
(52, 'SC', 'SoundCloud Downloads (HQ, Instant, SuperFast, 10k+/Day, Non-Drop, Unlimited)', '7', '100', '1000000', 64, 'Tersedia'),
(53, 'SC', 'SoundCloud Likes (HQ, Instant, Fast Delivery, Unlimited)', '30', '100', '1000000', 66, 'Tersedia'),
(54, 'SC', 'SoundCloud Followers (HQ, Instant, 10k/Day, 50k Base)', '35', '100', '100000', 373, 'Tersedia'),
(55, 'SC', 'SoundCloud Reposts (HQ, Fast, Max 10k)', '50', '100', '1000000', 385, 'Tersedia'),
(56, 'GP', 'Google Plus Followers | Server 1 (Max 5K, HQ, Non Drop)', '220', '100', '5000', 358, 'Tidak tersedia'),
(57, 'GP', 'Google Plus Like (Max 500, HQ)', '250', '20', '500', 361, 'Tidak tersedia'),
(58, 'VINE', 'Vine Followers | Server 1 (Max 200k, HQ, Non Drop, Instant)', '17', '20', '200000', 289, 'Tidak tersedia'),
(59, 'VINE', 'Vine Followers | Server 2 (Max 1M, HQ, Non Drop, Instant)', '20', '100', '1000000', 291, 'Tidak tersedia'),
(60, 'VINE', 'Vine Likes (Max 1M, HQ, Non Drop, Instant)', '17', '20', '1000000', 295, 'Tidak tersedia'),
(61, 'VINE', 'Vine Re-vine (Max 1M, HQ, Non Drop, Instant)', '17', '100', '1000000', 299, 'Tidak tersedia'),
(62, 'VINE', 'Vine Loops (Max 1M, HQ, Non Drop, Instant)', '17', '100', '1000000', 302, 'Tidak tersedia'),
(63, 'VINE', 'Vine Reposts (Max 200k, HQ, Non Drop, Instant)', '20', '2', '200000', 303, 'Tidak tersedia'),
(64, 'VINE', 'Vine Views (Max 20k, Instant, HQ)', '17', '100', '20000', 306, 'Tidak tersedia'),
(65, 'FB', 'Facebook Random Comments (Real, WorldWide, 200/Day, Max 10k)', '600', '100', '200000', 328, 'Tidak tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` int(50) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `email`, `password`, `saldo`, `date`) VALUES
(18, 'eaea', 'eaea', 'eaea@gmail.com', '$2a$08$VnSFCdagX7IRPPjgpfAvMOv9eavcC4rjMLSxgNroXHD4h.ZErpF.y', 0, ''),
(19, 'masuk', 'masuk', 'masuk@ss.cc', '$2a$08$WMWid0S7VX1/U3tD63/ZxeCAow1L4x280WJtnrxb3/egeBu3ggqy.', 0, ''),
(20, 'mantap', 'mantap', 'masuk@ss.cs', '$2a$08$WJIkNZ9oAQQGcPCV8rPSVuxnx/HLqDmx0fTHyZgRiGrj8QkcWiy/W', 0, ''),
(21, 'mantap1', 'mantap1', 'manyasd@fsa.c', '$2a$08$7e4ORdThfAILtNrrBjuQduo18nKBbkwZDacXjdkRgs2g0/KyKkjgy', 0, '0'),
(22, 'mantap1', 'mantap1', 'manyasd@fsa.c', '$2a$08$mg1R5zFwKyPys6ta8cmAMut9U5I2MD/zde7DKVyjr9mLqXuREFPlq', 0, '0'),
(23, 'coe', 'coe', 'coe@ss.s', '$2a$08$sgXG04H6tsXKrXJtJU4mienWuirdvGIsPX3cNXcnl1xv.YSpjenMG', 0, '0'),
(24, 'aseas', 'aseas', 'asea@sdas.csa', '$2a$08$6eDwIC9DUo6v7cqDXoj2ouOV2OFDygI9cbwGL8N8Wr1.duPg/PTRG', 0, '0'),
(25, 'bea', 'bea', 'bea@ss.ss', '$2a$08$Bxg2tOQ5PmYp1ORWp53Rf.Davmpfl2d9.FUzgDz.yfITwJmhtRjJa', 0, '18-01-06'),
(26, 'bea2', 'bea', 'bea@ss.ss', '$2a$08$bPJl/v4UL/66zpoAHLXpcuw3EprPrVFqbPLYK8zRAR1lTkuvDIA4i', 0, '2018-01-06'),
(27, 'aldi', 'aldi', 'aldi@gmail.com', '$2a$08$xCi8qvJD.HPrBjumHz9/Te4TL6mOb2o5oFyKiexP1Vy.AOTHQuv.C', 0, ''),
(28, 'admin', 'admin', 'admin@gmail.com', '$2a$08$XwSqtnKnXkHDh/UWri8WEeDx/8V69eUCE8OcENkPY8G3cC7Tm/YSu', 8100, '2018-01-15'),
(29, 'sengak', 'muhammad sengak', 'sengak@gmail.com', '$2a$08$9KKQSvOabVtZ941BZx.qoufw3T7wIn.WEYgQt3yAt40ZtX8rsPvzG', 20000, '2018-01-15'),
(30, 'demo', 'demo', 'demo@gmail.com', '$2a$08$K0DOzsJ5OgBFPZy3EMySju8FA7rlgDJDc5edn0kznGoaDSIS0Hwk2', 6800, '2018-01-16'),
(32, 'user1', 'user1', 'user1@gmail.com', '$2a$08$KkcPYNphdR0QRkWRnTw24e5XiMWyH9P3CgtG184jmDOh28F36fN5u', 9800, '2018-01-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mudah`
--
ALTER TABLE `mudah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mudah`
--
ALTER TABLE `mudah`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
