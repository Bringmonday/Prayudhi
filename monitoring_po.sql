-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 03:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_po`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(5) NOT NULL,
  `bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `bulan`) VALUES
(1, 'JANUARI'),
(2, 'FEBRUARI'),
(3, 'MARET'),
(4, 'APRIL'),
(5, 'MEI'),
(6, 'JUNI'),
(7, 'JULI'),
(8, 'AGUSTUS'),
(9, 'SEPTEMBER'),
(10, 'OKTOBER'),
(11, 'NOVEMBER'),
(12, 'DESEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(5) NOT NULL,
  `nama_customer` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`) VALUES
(4, 'PT B.S. INDONESIA'),
(8, 'PT SANDEN INDONESIA'),
(9, 'PT ALPHA INDONESIA '),
(11, 'PT CHEMCO INDONESIA'),
(12, 'PT SANENG INDUSTRIAL'),
(13, 'PT GALIH SEKAR SAKTI'),
(14, 'PT BANSHU INDONESIA'),
(17, 'PT ASTRA JUOKU INDONESIA '),
(18, 'PT ICHIKOH INDONESIA'),
(19, 'PT HONDA TRADING INDONESIA'),
(20, 'PT HONDA POWER PRODUCTS'),
(21, 'PT CIPTA MANDIRI WIRASAKTI'),
(22, 'PT INOAC POLYTECHNO '),
(23, 'PT INDOSPRAY'),
(24, 'PT GAYA MOTOR'),
(25, 'PT ASTRA HONDA MOTOR');

-- --------------------------------------------------------

--
-- Table structure for table `tb_actual_datastok`
--

CREATE TABLE `tb_actual_datastok` (
  `id_data_stok` varchar(20) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `nomor_part` varchar(30) NOT NULL,
  `nama_part` varchar(30) NOT NULL,
  `data_stok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_actual_datastok`
--

INSERT INTO `tb_actual_datastok` (`id_data_stok`, `tanggal_masuk`, `nama_customer`, `nomor_part`, `nama_part`, `data_stok`) VALUES
('MWT-20230927594', '2023-09-27T19:44', 'PT INOAC POLYTECHNO ', 'I-SKB03-PK001', 'Scuff Door Side Rear', '4500'),
('MWT-20230927819', '2023-09-27T19:45', 'PT B.S. INDONESIA', 'BSI130217', 'Housing LPT LD', '5620'),
('MWT-20230927861', '2023-09-27T19:44', 'PT ICHIKOH INDONESIA', 'ICH90-N982', 'Inner Lens', '5000'),
('MWT-20230928506', '2023-09-28T20:27', 'PT ICHIKOH INDONESIA', 'ICH91-N102', 'Inner Housing (L)', '3200'),
('MWT-20230928895', '2023-09-28T20:27', 'PT INOAC POLYTECHNO ', 'I-SKN19-PK009', 'Trimp Comp R', '3200'),
('MWT-20231017475', '2023-10-17T23:23', 'PT B.S. INDONESIA', 'BSI12027562', 'Bracket LPT', '2000'),
('MWT-20231123751', '2023-11-23T13:34', 'PT CIPTA MANDIRI WIRASAKTI', 'CMW01-L234', 'SHOULD ARMREST R/L', '2500');

-- --------------------------------------------------------

--
-- Table structure for table `tb_actual_delivery`
--

CREATE TABLE `tb_actual_delivery` (
  `id_pengiriman` varchar(20) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `nomor_part` varchar(30) NOT NULL,
  `nama_part` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `pengiriman` varchar(20) NOT NULL,
  `bulan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_actual_delivery`
--

INSERT INTO `tb_actual_delivery` (`id_pengiriman`, `tanggal_masuk`, `nama_customer`, `nomor_po`, `nomor_part`, `nama_part`, `satuan`, `pengiriman`, `bulan`) VALUES
('MWT-20230927047', '2023-08-22T20:06', 'PT INOAC POLYTECHNO ', 'L33871264', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1500', 'AGUSTUS'),
('MWT-20230927071', '2023-09-19T20:20', 'PT ICHIKOH INDONESIA', 'ICHKH0962311', 'ICH91-N102', 'Inner Housing (L)', 'Pcs', '1500', 'SEPTEMBER'),
('MWT-20230927145', '2023-09-14T20:07', 'PT INOAC POLYTECHNO ', 'L34812321', 'I-SKB03-PK001', 'Scuff Door Side Rear', 'Pcs', '1000', 'SEPTEMBER'),
('MWT-20230927253', '2023-07-20T20:12', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1500', 'JULI'),
('MWT-20230927285', '2023-09-18T20:08', 'PT ICHIKOH INDONESIA', 'ICHKH0562365', 'ICH90-N982', 'Inner Lens', 'Pcs', '1900', 'SEPTEMBER'),
('MWT-20230927482', '2023-09-12T20:06', 'PT INOAC POLYTECHNO ', 'L34812321', 'I-SKB03-PK001', 'Scuff Door Side Rear', 'Pcs', '1500', 'SEPTEMBER'),
('MWT-20230927830', '2023-08-24T20:06', 'PT INOAC POLYTECHNO ', 'L33871264', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1750', 'AGUSTUS'),
('MWT-20230927862', '2023-09-20T20:10', 'PT ICHIKOH INDONESIA', 'ICHKH0562365', 'ICH90-N982', 'Inner Lens', 'Pcs', '600', 'SEPTEMBER'),
('MWT-20230927964', '2023-07-19T19:52', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1800', 'JULI'),
('MWT-20230928054', '2023-09-28T11:46', 'PT INOAC POLYTECHNO ', 'L349719832', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1200', 'SEPTEMBER'),
('MWT-20230930359', '2023-07-20T19:26', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '500', 'JULI'),
('MWT-20230930437', '2023-07-20T19:20', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '900', 'JULI'),
('MWT-20230930516', '2023-09-14T19:52', 'PT B.S. INDONESIA', '1421/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '500', 'SEPTEMBER'),
('MWT-20231018714', '2023-10-18T17:00', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1000', 'JULI'),
('MWT-20231026907', '2023-10-17T16:54', 'PT INOAC POLYTECHNO ', 'L349719832', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '300', 'SEPTEMBER'),
('MWT-20231123302', '2023-11-23T13:35', 'PT CIPTA MANDIRI WIRASAKTI', 'CMWMWT11L2355', 'CMW01-L234', 'SHOULD ARMREST R/L', 'Pcs', '500', 'NOVEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `tb_akumulasi`
--

CREATE TABLE `tb_akumulasi` (
  `id_pengiriman` varchar(20) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `bulan` varchar(30) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `nomor_part` varchar(30) NOT NULL,
  `nama_part` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `pengiriman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akumulasi`
--

INSERT INTO `tb_akumulasi` (`id_pengiriman`, `nama_customer`, `tanggal_masuk`, `bulan`, `nomor_po`, `nomor_part`, `nama_part`, `satuan`, `pengiriman`) VALUES
('MWT-20230927964', 'PT B.S. INDONESIA', '2023-07-19T19:52', 'JULI', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1800'),
('MWT-20230927047', 'PT INOAC POLYTECHNO ', '2023-08-22T20:06', 'AGUSTUS', 'L33871264', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1500'),
('MWT-20230927830', 'PT INOAC POLYTECHNO ', '2023-08-24T20:06', 'AGUSTUS', 'L33871264', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1750'),
('MWT-20230927482', 'PT INOAC POLYTECHNO ', '2023-09-12T20:06', 'SEPTEMBER', 'L34812321', 'I-SKB03-PK001', 'Scuff Door Side Rear', 'Pcs', '1500'),
('MWT-20230927145', 'PT INOAC POLYTECHNO ', '2023-09-14T20:07', 'SEPTEMBER', 'L34812321', 'I-SKB03-PK001', 'Scuff Door Side Rear', 'Pcs', '1000'),
('MWT-20230927285', 'PT ICHIKOH INDONESIA', '2023-09-18T20:08', 'SEPTEMBER', 'ICHKH0562365', 'ICH90-N982', 'Inner Lens', 'Pcs', '1900'),
('MWT-20230927862', 'PT ICHIKOH INDONESIA', '2023-09-20T20:10', 'SEPTEMBER', 'ICHKH0562365', 'ICH90-N982', 'Inner Lens', 'Pcs', '600'),
('MWT-20230927253', 'PT B.S. INDONESIA', '2023-07-20T20:12', 'JULI', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1500'),
('MWT-20230927071', 'PT ICHIKOH INDONESIA', '2023-09-19T20:20', 'SEPTEMBER', 'ICHKH0962311', 'ICH91-N102', 'Inner Housing (L)', 'Pcs', '1500'),
('MWT-20230928054', 'PT INOAC POLYTECHNO ', '2023-09-28T11:46', 'SEPTEMBER', 'L349719832', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1200'),
('MWT-20230930437', 'PT B.S. INDONESIA', '2023-07-20T19:20', 'JULI', '1432/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '900'),
('MWT-20230930359', 'PT B.S. INDONESIA', '2023-07-20T19:26', 'JULI', '1432/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '500'),
('MWT-20230930516', 'PT B.S. INDONESIA', '2023-09-14T19:52', 'SEPTEMBER', '1421/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '500'),
('MWT-20231018714', 'PT B.S. INDONESIA', '2023-10-18T17:00', 'JULI', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '1000'),
('MWT-20231026907', 'PT INOAC POLYTECHNO ', '2023-10-17T16:54', 'SEPTEMBER', 'L349719832', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '300'),
('MWT-20231123302', 'PT CIPTA MANDIRI WIRASAKTI', '2023-11-23T13:35', 'NOVEMBER', 'CMWMWT11L2355', 'CMW01-L234', 'SHOULD ARMREST R/L', 'Pcs', '500');

-- --------------------------------------------------------

--
-- Table structure for table `tb_part`
--

CREATE TABLE `tb_part` (
  `id_part` int(5) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `nomor_part` varchar(30) NOT NULL,
  `nama_part` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_part`
--

INSERT INTO `tb_part` (`id_part`, `nama_customer`, `nomor_part`, `nama_part`) VALUES
(1, 'PT ICHIKOH INDONESIA', 'ICH91-N102', 'Inner Housing (L)'),
(2, 'PT ICHIKOH INDONESIA', 'ICH90-N982', 'Inner Lens'),
(3, 'PT INOAC POLYTECHNO ', 'I-SKB03-PK001', 'Scuff Door Side Rear'),
(4, 'PT INOAC POLYTECHNO ', 'I-SKN19-PK009', 'Trimp Comp R'),
(5, 'PT B.S. INDONESIA', 'BSI12027562', 'Bracket LPT'),
(6, 'PT B.S. INDONESIA', 'BSI130217', 'Housing LPT LD'),
(11, 'PT CIPTA MANDIRI WIRASAKTI', 'CMW01-L234', 'SHOULD ARMREST R/L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_part_po`
--

CREATE TABLE `tb_part_po` (
  `id_part_po` int(5) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `bulan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_part_po`
--

INSERT INTO `tb_part_po` (`id_part_po`, `nomor_po`, `bulan`) VALUES
(1, 'L33871264', 'AGUSTUS'),
(2, 'L34812321', 'SEPTEMBER'),
(3, 'ICHKH0962311', 'SEPTEMBER'),
(4, 'ICHKH0562365', 'SEPTEMBER'),
(5, '1432/BS/VII/2023', 'JULI'),
(6, 'L349719832', 'SEPTEMBER'),
(7, 'L349971352', 'SEPTEMBER'),
(8, '1421/BS/VII/2023', 'SEPTEMBER'),
(9, 'ICKH1064372', 'OKTOBER'),
(10, 'ICHKH0562365', 'SEPTEMBER'),
(11, 'ICHKH0562365', 'SEPTEMBER'),
(15, 'CMWMWT12L2332', 'NOVEMBER'),
(16, 'CMWMWT11L2355', 'NOVEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `tb_po`
--

CREATE TABLE `tb_po` (
  `id_po` varchar(20) NOT NULL,
  `bulan` varchar(30) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `nomor_po` varchar(30) NOT NULL,
  `nomor_part` varchar(30) NOT NULL,
  `nama_part` varchar(30) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `harga` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_po`
--

INSERT INTO `tb_po` (`id_po`, `bulan`, `tanggal_masuk`, `nama_customer`, `nomor_po`, `nomor_part`, `nama_part`, `satuan`, `jumlah`, `harga`, `keterangan`) VALUES
('MWT-20230927085', 'AGUSTUS', '2023-08-17T19:35', 'PT INOAC POLYTECHNO ', 'L33871264', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '3000', '8000', 'CLOSE BULAN AGUSTUS'),
('MWT-20230927129', 'SEPTEMBER', '2023-09-27T19:35', 'PT INOAC POLYTECHNO ', 'L34812321', 'I-SKB03-PK001', 'Scuff Door Side Rear', 'Pcs', '5000', '5500', '-'),
('MWT-20230927291', 'SEPTEMBER', '2023-09-27T19:33', 'PT ICHIKOH INDONESIA', 'ICHKH0962311', 'ICH91-N102', 'Inner Housing (L)', 'Pcs', '3000', '9000', '-'),
('MWT-20230927768', 'SEPTEMBER', '2023-09-27T19:34', 'PT ICHIKOH INDONESIA', 'ICHKH0962311', 'ICH90-N982', 'Inner Lens', 'Pcs', '2500', '7800', '-'),
('MWT-20230927931', 'JULI', '2023-07-18T19:36', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI12027562', 'Bracket LPT', 'Pcs', '2200', '11000', '-'),
('MWT-20230928625', 'SEPTEMBER', '2023-09-28T11:30', 'PT INOAC POLYTECHNO ', 'L349719832', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '1500', '8000', '-'),
('MWT-20230928687', 'SEPTEMBER', '2023-09-28T21:22', 'PT INOAC POLYTECHNO ', 'L349971352', 'I-SKN19-PK009', 'Trimp Comp R', 'Pcs', '3200', '8000', '-'),
('MWT-20230930035', 'SEPTEMBER', '2023-07-19T15:08', 'PT B.S. INDONESIA', '1421/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '3000', '9000', '-'),
('MWT-20230930317', 'JULI', '2023-07-19T18:52', 'PT B.S. INDONESIA', '1432/BS/VII/2023', 'BSI130217', 'Housing LPT LD', 'Pcs', '3000', '9000', '-'),
('MWT-20230930350', 'SEPTEMBER', '2023-09-30T22:01', 'PT ICHIKOH INDONESIA', 'ICHKH0562365', 'ICH90-N982', 'Inner Lens', 'Pcs', '3500', '7800', '-'),
('MWT-20230930546', 'OKTOBER', '2023-09-30T21:51', 'PT ICHIKOH INDONESIA', 'ICKH1064372', 'ICH91-N102', 'Inner Housing (L)', 'Pcs', '3000', '9000', '-'),
('MWT-20231123276', 'NOVEMBER', '2023-11-23T13:32', 'PT CIPTA MANDIRI WIRASAKTI', 'CMWMWT11L2355', 'CMW01-L234', 'SHOULD ARMREST R/L', 'Pcs', '1000', '9500', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(10) NOT NULL,
  `kode_satuan` varchar(100) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `kode_satuan`, `nama_satuan`) VALUES
(6, 'Pcs', 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `tb_upload_gambar_user`
--

CREATE TABLE `tb_upload_gambar_user` (
  `id` int(11) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `nama_file` varchar(220) NOT NULL,
  `ukuran_file` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_upload_gambar_user`
--

INSERT INTO `tb_upload_gambar_user` (`id`, `username_user`, `nama_file`, `ukuran_file`) VALUES
(4, 'admin', 'nopic2.png', '6.33'),
(6, 'krisnadwia', 'nopic2.png', '6.33'),
(8, 'admnmkt', 'logo4.png', '5.99'),
(9, 'admnppic', 'mwt4.jpeg', '33.33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(20, 'admin', 'admin@gmail.com', '$2y$10$3HNkMOtwX8X88Xb3DIveYuh', 1),
(23, 'user', 'user@gmail.com', '$2y$10$ik61osqbb3LNcJYQHez9mOG', 0),
(26, 'admnmkt', 'mkt1@gmail.com', 'admnmkt', 1),
(27, 'admnppic', 'ppic1@gmail.com', 'admnppic', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tb_actual_datastok`
--
ALTER TABLE `tb_actual_datastok`
  ADD PRIMARY KEY (`id_data_stok`);

--
-- Indexes for table `tb_actual_delivery`
--
ALTER TABLE `tb_actual_delivery`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `tb_part`
--
ALTER TABLE `tb_part`
  ADD PRIMARY KEY (`id_part`);

--
-- Indexes for table `tb_part_po`
--
ALTER TABLE `tb_part_po`
  ADD PRIMARY KEY (`id_part_po`);

--
-- Indexes for table `tb_po`
--
ALTER TABLE `tb_po`
  ADD PRIMARY KEY (`id_po`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_upload_gambar_user`
--
ALTER TABLE `tb_upload_gambar_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_part`
--
ALTER TABLE `tb_part`
  MODIFY `id_part` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_part_po`
--
ALTER TABLE `tb_part_po`
  MODIFY `id_part_po` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_upload_gambar_user`
--
ALTER TABLE `tb_upload_gambar_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
