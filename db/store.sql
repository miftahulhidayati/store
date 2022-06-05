-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2022 pada 17.59
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_category_product`
--

CREATE TABLE `ms_category_product` (
  `ID_CATEGORY_PRODUCT` int(11) NOT NULL,
  `CODE` varchar(10) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `IP_LOG` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_category_product`
--

INSERT INTO `ms_category_product` (`ID_CATEGORY_PRODUCT`, `CODE`, `NAME`, `STATUS`, `CREATED_DATE`, `CREATED_BY`, `DATE_LOG`, `USER_LOG`, `IP_LOG`) VALUES
(1, 'P1', 'PAKET MAJOO', 1, '2022-06-03 17:58:44', 'ADMIN', '2022-06-04 11:50:49', 'ADMIN', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_module_previlege`
--

CREATE TABLE `ms_module_previlege` (
  `ID` int(11) NOT NULL,
  `MODULE_NAME` varchar(250) DEFAULT NULL,
  `MENU_LEVEL` int(11) NOT NULL,
  `MENU_PARENT` int(11) DEFAULT NULL,
  `CONTROLLER` varchar(250) DEFAULT NULL,
  `FUNCTION` varchar(250) DEFAULT NULL,
  `ICON` text NOT NULL,
  `MENU_SEQ` varchar(45) NOT NULL,
  `ACTIVE` int(11) DEFAULT '1',
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_module_previlege`
--

INSERT INTO `ms_module_previlege` (`ID`, `MODULE_NAME`, `MENU_LEVEL`, `MENU_PARENT`, `CONTROLLER`, `FUNCTION`, `ICON`, `MENU_SEQ`, `ACTIVE`, `CREATED_BY`, `CREATED_DATE`, `USER_LOG`, `DATE_LOG`) VALUES
(1, 'Dashboard', 0, NULL, 'dashboard', 'index', ' ri-dashboard-line', 'A', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(2, 'User Management', 0, NULL, NULL, NULL, ' ri-team-line', 'B', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(3, 'Manage User', 1, 2, 'users', 'index', '', 'BA', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(4, 'User Group', 1, 2, 'user_group', 'index', '', 'BB', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(5, 'Module Privilege', 1, 2, 'module_p', 'index', ' ', 'BC', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(6, 'User Group Privilege', 1, 2, 'user_group_p', 'index', ' ', 'BD', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(7, 'Master Data', 0, NULL, NULL, NULL, 'bx bx-data', 'C', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(8, 'Product', 1, 7, 'product', 'index', '', 'CB', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(9, 'Category Product', 1, 7, 'category_product', 'index', '', 'CA', 1, 'miftahulhdyt', '2022-06-03 22:41:46', NULL, NULL),
(10, 'List Product', 0, NULL, 'product', 'list_product', ' ri-table-line\r\n', 'D', 1, 'miftahulhdyt', '2022-06-04 16:54:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_product`
--

CREATE TABLE `ms_product` (
  `ID_PRODUCT` int(11) NOT NULL,
  `ID_CATEGORY_PRODUCT` int(11) NOT NULL,
  `NAME` varchar(250) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `PRICE` int(11) NOT NULL,
  `IMAGE_URL` text NOT NULL,
  `STATUS` int(11) NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `IP_LOG` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_product`
--

INSERT INTO `ms_product` (`ID_PRODUCT`, `ID_CATEGORY_PRODUCT`, `NAME`, `DESCRIPTION`, `PRICE`, `IMAGE_URL`, `STATUS`, `CREATED_DATE`, `CREATED_BY`, `DATE_LOG`, `USER_LOG`, `IP_LOG`) VALUES
(2, 1, 'Majoo Lifestyle', '<p><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</i></p>', 3500000, 'assets/uploads/product/2022/06/paket-lifestyle2206045.png', 1, '2022-06-04 10:57:38', 'ADMIN', '2022-06-04 11:49:39', 'ADMIN', NULL),
(3, 1, 'Majoo Advance', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 3000000, 'assets/uploads/product/2022/06/paket-advance2206045.png', 1, '2022-06-04 11:10:30', 'ADMIN', '2022-06-04 11:48:57', 'ADMIN', NULL),
(4, 1, 'Majoo Pro', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>', 2750000, 'assets/uploads/product/2022/06/standardrepo2206045.png', 1, '2022-06-04 11:34:30', 'ADMIN', '2022-06-04 11:48:02', 'ADMIN', NULL),
(5, 1, 'Majoo Desktop', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 3500000, 'assets/uploads/product/2022/06/paket-desktop2206045.png', 1, '2022-06-04 11:50:15', 'ADMIN', '2022-06-04 11:50:15', 'ADMIN', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_users`
--

CREATE TABLE `ms_users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `GROUP_ID` int(11) NOT NULL,
  `ID_STORE` int(11) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `NAME` varchar(250) DEFAULT NULL,
  `POSITION` varchar(500) DEFAULT NULL,
  `EMAIL` varchar(250) DEFAULT NULL,
  `STATUS` enum('0','1') NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL,
  `IP_LOG` varchar(200) DEFAULT NULL,
  `LAST_UPDATE_PASSWORD` timestamp NULL DEFAULT NULL,
  `HASH` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_users`
--

INSERT INTO `ms_users` (`ID`, `USERNAME`, `GROUP_ID`, `ID_STORE`, `PASSWORD`, `NAME`, `POSITION`, `EMAIL`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `USER_LOG`, `DATE_LOG`, `IP_LOG`, `LAST_UPDATE_PASSWORD`, `HASH`) VALUES
(1, 'ADMIN', 1, NULL, '35efe8c1d5a4cff24bee76cc79d1dbf9', 'ADMIN', 'ADMIN', 'ADMIN@ADMIN.COM', '1', 'SYSTEM', '2021-01-20 15:06:24', 'NIEVE', '2022-06-03 17:39:42', NULL, NULL, 'HhqpZuDmdx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user_group`
--

CREATE TABLE `ms_user_group` (
  `ID` int(11) NOT NULL,
  `USER_GROUP_NAME` varchar(250) DEFAULT NULL,
  `STATUS` enum('0','1') NOT NULL DEFAULT '1',
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL,
  `IP_LOG` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_user_group`
--

INSERT INTO `ms_user_group` (`ID`, `USER_GROUP_NAME`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `USER_LOG`, `DATE_LOG`, `IP_LOG`) VALUES
(1, 'SUPER', '1', 'miftahulhdyt', '2021-08-05 19:02:36', 'miftahulhdyt', '2021-01-20 14:56:00', NULL),
(2, 'STORE2', '0', 'NIEVE', '2022-04-26 13:42:33', 'ADMIN', '2022-06-04 12:01:51', NULL),
(3, 'TEST', '1', 'ADMIN', '2022-06-04 12:02:11', 'ADMIN', '2022-06-04 12:02:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user_group_previlege`
--

CREATE TABLE `ms_user_group_previlege` (
  `ID` int(11) NOT NULL,
  `USER_GROUP_ID` int(11) NOT NULL,
  `MODULE_PREVILEGE_ID` int(11) NOT NULL,
  `IS_CREATE` int(11) NOT NULL DEFAULT '0',
  `IS_READ` int(11) NOT NULL DEFAULT '0',
  `IS_UPDATE` int(11) NOT NULL DEFAULT '0',
  `IS_DELETE` int(11) NOT NULL DEFAULT '0',
  `IS_EXPORT` int(11) NOT NULL DEFAULT '0',
  `IS_IMPORT` int(11) NOT NULL DEFAULT '0',
  `CREATED_BY` varchar(250) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `USER_LOG` varchar(250) DEFAULT NULL,
  `DATE_LOG` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_user_group_previlege`
--

INSERT INTO `ms_user_group_previlege` (`ID`, `USER_GROUP_ID`, `MODULE_PREVILEGE_ID`, `IS_CREATE`, `IS_READ`, `IS_UPDATE`, `IS_DELETE`, `IS_EXPORT`, `IS_IMPORT`, `CREATED_BY`, `CREATED_DATE`, `USER_LOG`, `DATE_LOG`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-05-19 15:41:50', 'NIEVE', '2022-05-17 11:30:57'),
(2, 1, 2, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-01-20 15:08:43', 'SYSTEM', '2021-01-20 15:08:43'),
(3, 1, 3, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-05-19 15:41:50', 'NIEVE', '2022-05-17 11:30:57'),
(4, 1, 4, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-05-19 15:41:50', 'NIEVE', '2022-05-17 11:30:57'),
(5, 1, 5, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-05-19 15:41:50', 'NIEVE', '2022-05-17 11:30:57'),
(6, 1, 6, 1, 1, 1, 1, 1, 1, 'SYSTEM', '2021-05-19 15:41:50', 'NIEVE', '2022-05-17 11:30:57'),
(7, 1, 8, 1, 1, 1, 1, 1, 1, 'NIEVE', '2021-05-19 15:41:51', 'NIEVE', '2022-05-17 11:30:57'),
(8, 1, 9, 1, 1, 1, 1, 1, 1, 'NIEVE', '2021-01-22 10:49:12', 'NIEVE', '2022-05-17 11:30:57'),
(9, 1, 10, 1, 1, 1, 1, 1, 1, 'NIEVE', '2021-01-22 10:49:12', 'NIEVE', '2022-05-17 11:30:57'),
(10, 1, 11, 1, 1, 1, 1, 1, 1, 'NIEVE', '2021-05-19 15:41:51', 'NIEVE', '2021-05-19 15:41:51'),
(2245, 1, 7, 1, 1, 1, 1, 1, 1, 'NIEVE', '2022-03-15 10:53:45', 'NIEVE', '2022-03-15 10:53:45'),
(2246, 2, 0, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:42:33', 'NIEVE', '2022-04-26 13:42:33'),
(2247, 2, 1, 1, 1, 1, 1, 1, 1, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2248, 2, 3, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2249, 2, 4, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2250, 2, 5, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2251, 2, 6, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2252, 2, 8, 0, 0, 0, 0, 0, 0, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2253, 2, 9, 1, 1, 1, 1, 1, 1, 'NIEVE', '2022-04-26 13:43:16', 'NAVBOGOR', '2022-04-28 10:05:45'),
(2254, 3, 0, 0, 0, 0, 0, 0, 0, 'ADMIN', '2022-06-04 12:02:11', 'ADMIN', '2022-06-04 12:02:11'),
(2255, 3, 1, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2256, 3, 3, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2257, 3, 4, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2258, 3, 5, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2259, 3, 6, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2260, 3, 9, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31'),
(2261, 3, 8, 1, 1, 1, 1, 1, 1, 'ADMIN', '2022-06-04 12:02:31', 'ADMIN', '2022-06-04 12:02:31');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_tblusers`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_tblusers` (
`ID` int(11)
,`USERNAME` varchar(100)
,`GROUP_ID` int(11)
,`ID_STORE` int(11)
,`PASSWORD` varchar(100)
,`NAME` varchar(250)
,`POSITION` varchar(500)
,`EMAIL` varchar(250)
,`STATUS` enum('0','1')
,`CREATED_BY` varchar(250)
,`CREATED_DATE` datetime
,`USER_LOG` varchar(250)
,`DATE_LOG` datetime
,`IP_LOG` varchar(200)
,`LAST_UPDATE_PASSWORD` timestamp
,`HASH` varchar(100)
,`USER_GROUP_NAME` varchar(250)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tblusers`
--
DROP TABLE IF EXISTS `v_tblusers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tblusers`  AS  select `a`.`ID` AS `ID`,`a`.`USERNAME` AS `USERNAME`,`a`.`GROUP_ID` AS `GROUP_ID`,`a`.`ID_STORE` AS `ID_STORE`,`a`.`PASSWORD` AS `PASSWORD`,`a`.`NAME` AS `NAME`,`a`.`POSITION` AS `POSITION`,`a`.`EMAIL` AS `EMAIL`,`a`.`STATUS` AS `STATUS`,`a`.`CREATED_BY` AS `CREATED_BY`,`a`.`CREATED_DATE` AS `CREATED_DATE`,`a`.`USER_LOG` AS `USER_LOG`,`a`.`DATE_LOG` AS `DATE_LOG`,`a`.`IP_LOG` AS `IP_LOG`,`a`.`LAST_UPDATE_PASSWORD` AS `LAST_UPDATE_PASSWORD`,`a`.`HASH` AS `HASH`,`c`.`USER_GROUP_NAME` AS `USER_GROUP_NAME` from (`ms_users` `a` left join `ms_user_group` `c` on((`a`.`GROUP_ID` = `c`.`ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ms_category_product`
--
ALTER TABLE `ms_category_product`
  ADD PRIMARY KEY (`ID_CATEGORY_PRODUCT`);

--
-- Indeks untuk tabel `ms_module_previlege`
--
ALTER TABLE `ms_module_previlege`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `ms_product`
--
ALTER TABLE `ms_product`
  ADD PRIMARY KEY (`ID_PRODUCT`),
  ADD KEY `ID_PRODUCT_CATEGORY` (`ID_CATEGORY_PRODUCT`);

--
-- Indeks untuk tabel `ms_users`
--
ALTER TABLE `ms_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME_UNIQUE` (`USERNAME`);

--
-- Indeks untuk tabel `ms_user_group`
--
ALTER TABLE `ms_user_group`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USER_GROUP_NAME_UNIQUE` (`USER_GROUP_NAME`);

--
-- Indeks untuk tabel `ms_user_group_previlege`
--
ALTER TABLE `ms_user_group_previlege`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ms_category_product`
--
ALTER TABLE `ms_category_product`
  MODIFY `ID_CATEGORY_PRODUCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ms_module_previlege`
--
ALTER TABLE `ms_module_previlege`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `ms_product`
--
ALTER TABLE `ms_product`
  MODIFY `ID_PRODUCT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ms_users`
--
ALTER TABLE `ms_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ms_user_group`
--
ALTER TABLE `ms_user_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ms_user_group_previlege`
--
ALTER TABLE `ms_user_group_previlege`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2262;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ms_product`
--
ALTER TABLE `ms_product`
  ADD CONSTRAINT `MS_PRODUCT_ibfk_1` FOREIGN KEY (`ID_CATEGORY_PRODUCT`) REFERENCES `ms_category_product` (`ID_CATEGORY_PRODUCT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
