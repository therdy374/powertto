-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 12:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u245217918_powertto`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_sessions`
--

CREATE TABLE `active_sessions` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `date_logs` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `active_sessions`
--

INSERT INTO `active_sessions` (`id`, `userid`, `user_id`, `session_id`, `date_logs`) VALUES
(1, 'lee_123', '7', '5k2kvb8dbnfom5qhvr0vm96a7m', '2024-05-22 17:09:44'),
(2, 'lee_123', '7', 'f8konf200srrhovbrrj2c6lfoj', '2024-05-22 17:10:30'),
(3, 'lee_123', '7', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:24:36'),
(4, 'lee_123', '7', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:25:56'),
(5, 'lee_123', '7', 'cjj6hdiupfboolp7jpichvio79', '2024-05-22 17:26:44'),
(6, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:31:43'),
(7, 'lee_123', '7', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:37:51'),
(8, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:38:05'),
(9, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:38:52'),
(10, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 17:39:22'),
(11, 'lee_123', '7', 'cjj6hdiupfboolp7jpichvio79', '2024-05-22 18:11:04'),
(12, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 18:11:14'),
(13, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 18:40:43'),
(14, 'xxxxxx', '73', 'tviom3it2gmcckraag83qtmhau', '2024-05-22 18:44:39'),
(15, 'xxxxxx', '73', 'cjj6hdiupfboolp7jpichvio79', '2024-05-22 18:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `admin_credit` int(100) NOT NULL DEFAULT 0,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` int(11) NOT NULL,
  `is_ban` int(11) NOT NULL DEFAULT 0,
  `admin_level` varchar(255) NOT NULL,
  `referal_code` varchar(255) NOT NULL,
  `referal_points` int(255) NOT NULL DEFAULT 0,
  `admin_comm` int(255) NOT NULL DEFAULT 0,
  `percentage` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `parent_name`, `name`, `username`, `password`, `phone`, `admin_credit`, `verify_token`, `verify_status`, `is_ban`, `admin_level`, `referal_code`, `referal_points`, `admin_comm`, `percentage`, `created_at`) VALUES
(1, '99369F91', 'admin', 'admin', '$2y$10$K/8b3zqRb88UH8W4nas.C.OSE8tDMW8.On1sLFX76o0fYvtOK60J.', '09655888208', 1062792833, '', 1, 0, '5', '99369F91', 90, 168010, '50%', '2024-01-24 09:38:00'),
(82, '99369F91', 'Test01', 'level_04', '$2y$10$2Bs8i9U4mWahoAHfMlHkHOYNbfbS8xAT62/mJXQtLrS8oLji8RGeu', '1231231223', 0, '', 1, 0, '4', '9FA7B037', 0, 0, '40%', '2024-05-16 18:27:19'),
(83, '99369F91', 'test02', 'level_03', '$2y$10$dqwHNfkwxqOamlWo4.KvzOAxReJHS0oy1OojoGpdK7vwom5uBojP2', '1231231223', 0, '', 1, 0, '3', 'C7BF4CCB', 0, 0, '30%', '2024-05-16 18:30:52'),
(84, '99369F91', 'Test03', 'level_02', '$2y$10$eaGE3IZ26J3D0JZtbv2.3ex4F.5X2l0ENPMZ1wnJotUVIb4.vAuI6', '1231231223', 0, '', 1, 0, '2', 'F2C68B2B', 0, 0, '20%', '2024-05-16 18:35:44'),
(85, '99369F91', 'Test04', 'level_01', '$2y$10$clT0DqcFVa3iCLkjpnsHrOCl.a59YC7cT2pDcgKYsYflg9rN.iawq', '1231231223', 0, '', 1, 0, '1', '85B08A88', 0, 0, '10%', '2024-05-16 18:36:12'),
(86, '99369F91', 'Test05', 'level_0401', '$2y$10$.tYXf6dPx952CPFoNWhu6OMF6m.S2g5okx7jmcvMecKzvRHpkxlM.', '1231231223', 0, '', 1, 0, '4', 'EF176E09', 0, 0, '40%', '2024-05-16 18:41:43'),
(87, '85B08A88', 'Test04_001', 'test04_001', '$2y$10$HImGbS9ODFA2XJL58XS/aeW1tfukTvNi.mYNIHdUGU5psPEMuxy4y', '1231231223', 0, '', 1, 0, '1', '6779AA01', 10, 0, '10%', '2024-05-16 18:54:58'),
(88, 'F2C68B2B', 'Test03_01', 'test03_01', '$2y$10$tQ5T5tbbkeShWy3aFOmG9uIvRC3i4DuwsumoYu7mW5XuvQ.xqzO7y', '1231231223', 0, '', 1, 0, '1', '974EB69D', 0, 0, '10%', '2024-05-16 19:12:56'),
(90, 'C7BF4CCB', 'level03_02', 'level03_02', '$2y$10$BvOpDuHj60xvvFlXYFY2deQTGNDeWjiDXBJ6YE6YiH0YKUwSJ5jUW', '1231231223', 0, '', 1, 0, '2', '7DF52D0F', 0, 0, '20%', '2024-05-16 19:26:12'),
(91, '9FA7B037', 'Level04_03', 'level04_03', '$2y$10$ttKPCtcwlDFy6IDU2SX0W.86S6Yiue88eIYDPMzjPvpCQ9ek18iUq', '1231231223', 0, '', 1, 0, '3', 'F6915491', 0, 0, '30%', '2024-05-16 19:32:58'),
(93, '9FA7B037', 'Level04_01', 'level04_01', '$2y$10$El3Cz3.szFsjEt52pBXpgeAyHCAqo0cE3sIK7mtoEstpP7tZRX6NK', '1231231223', 28500, '', 1, 0, '1', 'A24DDAF0', 0, 28500, '10%', '2024-05-16 19:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `admins_fee`
--

CREATE TABLE `admins_fee` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `admin_fee` varchar(255) NOT NULL,
  `date_purchase` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_fee`
--

INSERT INTO `admins_fee` (`id`, `user_name`, `name`, `user_id`, `admin_fee`, `date_purchase`) VALUES
(1, '', 'lee_123', '7', '15000', '2024-03-20 18:18:34'),
(2, '', 'lee_123', '7', '15000', '2024-03-20 18:24:27'),
(3, '', 'lee_123', '7', '15000', '2024-03-20 19:25:51'),
(4, '', 'lee_123', '7', '15000', '2024-03-20 19:27:04'),
(5, '', 'lee_123', '7', '15000', '2024-03-20 19:27:34'),
(6, '', 'lee_123', '7', '15000', '2024-03-21 11:38:51'),
(7, '', 'lee_123', '7', '1555', '2024-03-21 11:40:50'),
(8, '', 'lee_123', '7', '15000', '2024-03-21 11:47:37'),
(9, '', 'lee_123', '7', '15000', '2024-03-21 11:48:37'),
(10, '', 'lee_123', '7', '15000', '2024-03-21 11:50:28'),
(11, '', 'lee_123', '7', '15000', '2024-03-21 11:52:16'),
(12, '', 'lee_123', '7', '15000', '2024-03-21 11:55:04'),
(13, '', 'lee_123', '7', '15000', '2024-03-21 11:56:10'),
(14, '', 'lee_123', '7', '15000', '2024-03-21 11:56:28'),
(15, '', 'lee_123', '7', '15000', '2024-03-21 11:59:33'),
(16, '', 'lee_123', '7', '15000', '2024-03-21 12:00:36'),
(17, '', 'lee_123', '7', '15000', '2024-03-21 12:02:02'),
(18, '', 'lee_123', '7', '15000', '2024-03-21 12:02:24'),
(19, '', 'lee_123', '7', '15000', '2024-03-21 12:03:18'),
(20, '', 'lee_123', '7', '15000', '2024-03-21 12:05:01'),
(21, '', 'lee_123', '7', '15000', '2024-03-21 12:14:42'),
(22, '', 'lee_123', '7', '15000', '2024-03-21 12:14:57'),
(23, '', 'lee_123', '7', '15000', '2024-03-21 12:16:18'),
(24, '', 'lee_123', '7', '15000', '2024-03-22 14:20:14'),
(25, '', 'lee_123', '7', '15000', '2024-03-22 18:16:47'),
(26, '', 'lee_123', '7', '15000', '2024-03-22 18:36:59'),
(27, '', 'lee_123', '7', '15000', '2024-03-22 18:42:20'),
(28, '', 'lee_123', '7', '15000', '2024-03-22 18:43:30'),
(29, '', 'lee_123', '7', '15000', '2024-03-22 18:45:08'),
(30, '', 'lee_123', '7', '15000', '2024-03-22 19:01:14'),
(31, '', 'lee_123', '7', '15000', '2024-03-22 19:01:42'),
(32, '', 'lee_123', '7', '15000', '2024-03-22 19:03:43'),
(33, '', 'lee_123', '7', '15000', '2024-03-22 19:12:16'),
(34, '', 'lee_123', '7', '15000', '2024-03-22 19:12:36'),
(35, '', 'lee_123', '7', '15000', '2024-03-23 12:43:29'),
(36, '', 'lee_123', '7', '15000', '2024-03-23 12:53:26'),
(37, '', 'lee_123', '7', '15000', '2024-03-23 13:51:06'),
(38, '', 'lee_123', '7', '15000', '2024-03-23 15:59:57'),
(39, '', 'lee_123', '7', '15000', '2024-03-25 14:08:44'),
(40, '', 'lee_123', '7', '15000', '2024-03-26 15:22:17'),
(41, '', 'lee_123', '7', '15000', '2024-03-27 19:45:06'),
(42, '', 'lee_123', '7', '15000', '2024-03-27 19:51:20'),
(43, '', 'lee_123', '7', '15000', '2024-03-29 12:40:14'),
(44, '', 'lee_123', '7', '15000', '2024-03-30 09:38:23'),
(45, '', 'lee_123', '7', '15000', '2024-03-30 09:45:36'),
(46, '', 'lee_123', '7', '15000', '2024-03-30 09:45:42'),
(47, '', 'lee_123', '7', '15000', '2024-03-30 09:47:45'),
(48, '', 'lee_123', '7', '15000', '2024-03-30 09:47:50'),
(49, '', 'lee_123', '7', '15000', '2024-03-30 09:47:57'),
(50, '', 'lee_123', '7', '15000', '2024-03-30 09:49:03'),
(51, '', 'lee_123', '7', '15000', '2024-03-30 09:49:17'),
(52, '', 'lee_123', '7', '15000', '2024-03-30 09:51:20'),
(53, '', 'lee_123', '7', '15000', '2024-03-30 09:51:36'),
(54, '', 'lee_123', '7', '15000', '2024-03-30 09:51:54'),
(55, '', 'lee_123', '7', '15000', '2024-03-30 10:02:07'),
(56, '', 'lee_123', '7', '15000', '2024-03-30 10:02:37'),
(57, '', 'lee_123', '7', '15000', '2024-03-30 10:02:46'),
(58, '', 'lee_123', '7', '15000', '2024-03-30 10:03:09'),
(59, '', 'lee_123', '7', '15000', '2024-03-30 10:03:32'),
(60, '', 'lee_123', '7', '15000', '2024-03-30 10:06:58'),
(61, '', 'lee_123', '7', '15000', '2024-03-30 10:08:21'),
(62, '', 'lee_123', '7', '15000', '2024-03-30 10:08:43'),
(63, '', 'lee_123', '7', '15000', '2024-03-30 10:09:33'),
(64, '', 'lee_123', '7', '15000', '2024-03-30 10:13:21'),
(65, '', 'lee_123', '7', '15000', '2024-04-01 11:14:36'),
(66, '', 'test123', '21', '15000', '2024-04-02 18:48:06'),
(67, '', 'lee_123', '7', '15000', '2024-04-03 16:07:41'),
(68, '', 'lee_123', '7', '15000', '2024-04-03 16:15:06'),
(69, '', 'lee_123', '7', '15000', '2024-04-03 16:15:40'),
(70, '', 'lee_123', '7', '15000', '2024-04-03 16:18:52'),
(71, '', 'lee_123', '7', '15000', '2024-04-03 16:25:29'),
(72, '', 'lee_123', '7', '15000', '2024-04-03 16:29:45'),
(73, '', 'lee_123', '7', '15000', '2024-04-03 16:33:15'),
(74, '', 'lee_123', '7', '15000', '2024-04-03 16:33:26'),
(75, '', 'lee_123', '7', '15000', '2024-04-03 16:33:53'),
(76, '', 'qwe_123', '22', '15000', '2024-04-03 16:59:26'),
(77, '', 'lee_123', '7', '15000', '2024-04-03 17:07:04'),
(78, '', 'lee_123', '7', '15000', '2024-04-03 17:07:30'),
(79, '', 'lee_123', '7', '15000', '2024-04-03 17:34:44'),
(80, '', 'lee_123', '7', '15000', '2024-04-03 17:59:07'),
(81, '', 'lee_123', '7', '15000', '2024-04-03 18:09:42'),
(82, '', 'lee_123', '7', '15000', '2024-04-04 19:44:19'),
(83, '', 'lee_123', '7', '15000', '2024-04-04 19:46:04'),
(84, '', 'lee_123', '7', '15000', '2024-04-04 19:46:15'),
(85, '', 'lee_123', '7', '15000', '2024-04-04 19:46:30'),
(86, '', 'lee_123', '7', '15000', '2024-04-04 19:46:41'),
(87, '', 'lee_123', '7', '15000', '2024-04-04 19:46:56'),
(88, '', 'lee_123', '7', '15000', '2024-04-05 12:03:23'),
(89, '', 'lee_123', '7', '15000', '2024-04-06 15:27:26'),
(90, '', 'lee_123', '7', '15000', '2024-04-07 15:44:49'),
(92, '', 'lee_123', '7', '15000', '2024-04-08 12:01:36'),
(93, '', 'lee_123', '7', '15000', '2024-04-08 12:03:46'),
(94, '', 'lee_123', '7', '15000', '2024-04-08 12:06:21'),
(95, '', 'lee_123', '7', '15000', '2024-04-08 12:06:34'),
(96, '', 'lee_123', '7', '15000', '2024-04-08 12:06:58'),
(97, '', 'lee_123', '7', '15000', '2024-04-08 12:28:09'),
(98, '', 'lee_123', '7', '15000', '2024-04-08 12:38:20'),
(99, '', 'lee_123', '7', '15000', '2024-04-09 12:22:24'),
(100, '', 'lee_123', '7', '15000', '2024-04-09 12:22:34'),
(101, '', 'lee_123', '7', '15000', '2024-04-09 12:23:01'),
(102, '', 'lee_123', '7', '15000', '2024-04-09 12:23:18'),
(103, '', 'lee_123', '7', '15000', '2024-04-09 12:49:46'),
(104, '', 'lee_123', '7', '15000', '2024-04-09 12:50:09'),
(105, '', 'lee_123', '7', '15000', '2024-04-09 12:52:00'),
(106, '', 'lee_123', '7', '15000', '2024-04-09 13:15:05'),
(107, '', 'lee_123', '7', '15000', '2024-04-09 13:15:24'),
(108, '', 'lee_123', '7', '15000', '2024-04-10 13:59:50'),
(109, '', 'lee_123', '7', '15000', '2024-04-10 14:00:02'),
(110, '', 'lee_123', '7', '15000', '2024-04-11 12:36:15'),
(111, '', 'lee_123', '7', '15000', '2024-04-18 18:00:52'),
(112, '', 'lee_123', '7', '15000', '2024-04-18 18:00:59'),
(113, '', 'lee_123', '7', '15000', '2024-04-18 18:01:10'),
(114, '', 'lee_123', '7', '15000', '2024-04-18 18:01:18'),
(115, '', 'lee_123', '7', '15000', '2024-04-18 18:01:26'),
(116, '', 'lee_123', '7', '15000', '2024-04-19 16:53:18'),
(117, '', 'lee_123', '7', '15000', '2024-04-19 16:53:26'),
(118, '', 'lee_123', '7', '15000', '2024-04-19 16:53:34'),
(119, '', 'lee_123', '7', '15000', '2024-04-19 17:13:59'),
(120, '', 'lee_123', '7', '15000', '2024-04-19 19:01:10'),
(121, '', 'lee_123', '7', '15000', '2024-04-22 15:44:30'),
(122, '', 'lee_123', '7', '15000', '2024-04-23 11:31:23'),
(123, '', 'lee_123', '7', '15000', '2024-04-23 11:32:04'),
(124, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-23 11:37:46'),
(125, 'Mae Geronimo', 'mae@123', '10', '15000', '2024-04-23 11:39:14'),
(126, 'Mae Geronimo', 'mae@123', '10', '15000', '2024-04-23 12:03:32'),
(127, 'Mae Geronimo', 'mae@123', '10', '15000', '2024-04-23 12:04:41'),
(128, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-24 10:07:22'),
(129, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:37:47'),
(130, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:37:57'),
(131, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:08'),
(132, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:14'),
(133, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:23'),
(134, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:33'),
(135, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:46'),
(136, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:38:53'),
(137, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:39:00'),
(138, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:39:07'),
(139, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:42:41'),
(140, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:42:50'),
(141, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:42:57'),
(142, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:43:07'),
(143, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:43:15'),
(144, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:43:28'),
(145, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:43:52'),
(146, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:44:20'),
(147, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:44:28'),
(148, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:44:34'),
(149, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 13:44:44'),
(150, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 14:06:53'),
(151, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 17:37:08'),
(152, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 17:37:17'),
(153, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 17:37:28'),
(154, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-04-29 17:37:39'),
(155, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:24:09'),
(156, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:24:16'),
(157, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:24:26'),
(158, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:24:39'),
(159, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:25:24'),
(160, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:27:14'),
(161, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:27:26'),
(162, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:27:37'),
(163, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-04 13:28:01'),
(181, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-06 12:32:19'),
(182, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-06 12:46:00'),
(183, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-06 13:15:43'),
(184, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-06 13:25:10'),
(185, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-06 16:23:11'),
(186, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-07 11:09:38'),
(187, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-07 11:11:21'),
(188, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-07 12:21:35'),
(189, 'Lee Yangsik', 'lee_123', '7', '0', '2024-05-07 12:28:55'),
(190, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:35:52'),
(191, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:41:37'),
(192, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:42:29'),
(193, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:54:53'),
(194, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:57:32'),
(195, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 19:58:35'),
(196, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 20:07:09'),
(197, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-07 20:12:47'),
(198, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-08 10:24:00'),
(199, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 10:25:42'),
(200, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 10:38:42'),
(201, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 10:41:37'),
(202, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 10:56:50'),
(203, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-08 10:59:17'),
(204, 'Mae Geronimo', 'mae@123', '10', '15000', '2024-05-08 12:07:40'),
(205, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 15:55:10'),
(206, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-08 15:57:28'),
(207, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 18:29:12'),
(208, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 18:29:24'),
(209, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 18:29:47'),
(210, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-08 18:44:33'),
(211, 'Mae Geronimo', 'mae@123', '10', '15000', '2024-05-08 18:51:56'),
(212, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 16:09:50'),
(213, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 16:09:57'),
(214, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 16:10:07'),
(215, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 16:10:20'),
(216, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 16:10:51'),
(217, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-09 18:05:45'),
(218, 'Mae Geronimo', 'mae@1234567890', '10', '15000', '2024-05-09 19:47:49'),
(219, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-10 11:34:28'),
(220, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:15:44'),
(221, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:16:31'),
(222, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:16:40'),
(223, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:16:51'),
(224, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:16:59'),
(225, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:17:07'),
(226, 'assaasd', 'aaaaa', '61', '15000', '2024-05-10 16:20:04'),
(227, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:20:43'),
(228, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:21:43'),
(229, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:28:57'),
(230, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:29:47'),
(231, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:30:40'),
(232, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:32:15'),
(233, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:33:51'),
(234, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:34:34'),
(235, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:35:47'),
(236, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:36:38'),
(237, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 11:38:16'),
(238, 'Mae Geronimo', 'mae@1234567890', '10', '15000', '2024-05-11 11:43:19'),
(239, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 13:02:19'),
(240, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 13:03:59'),
(241, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-11 13:06:33'),
(242, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-13 09:49:21'),
(243, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-13 09:50:32'),
(244, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-13 10:06:18'),
(245, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-13 14:50:02'),
(246, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-13 15:39:50'),
(247, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-13 15:49:27'),
(248, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-13 15:53:49'),
(249, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-13 16:54:30'),
(250, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-13 16:55:08'),
(251, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-13 17:05:03'),
(252, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-14 10:50:22'),
(253, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-14 10:51:36'),
(254, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-14 10:52:31'),
(255, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-14 11:27:55'),
(256, 'wqeqwe', 'qweqwe', '60', '15000', '2024-05-14 11:29:39'),
(257, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 17:13:49'),
(258, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 17:14:01'),
(259, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 17:19:46'),
(260, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 17:34:37'),
(261, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 18:45:36'),
(262, 'assaasd', 'aaaaa', '61', '15000', '2024-05-14 18:46:00'),
(263, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 11:44:03'),
(264, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 13:01:20'),
(265, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 14:56:08'),
(266, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 14:56:50'),
(267, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 14:58:53'),
(268, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 15:44:33'),
(269, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 15:54:20'),
(270, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 16:08:39'),
(271, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 16:15:41'),
(272, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 17:36:15'),
(273, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 17:41:00'),
(274, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 17:59:07'),
(275, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 18:12:51'),
(276, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 18:22:00'),
(277, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 18:47:00'),
(278, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-15 19:26:24'),
(279, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 10:49:47'),
(280, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 10:52:36'),
(281, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:01:21'),
(282, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:02:40'),
(283, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:04:57'),
(284, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:05:44'),
(285, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:06:45'),
(286, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:14:14'),
(287, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:15:48'),
(288, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:18:52'),
(289, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:19:14'),
(290, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:41:21'),
(291, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:41:54'),
(292, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:42:07'),
(293, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 11:42:43'),
(294, 'qqq qqqqqq', 'qqqqqq', '66', '15000', '2024-05-16 12:44:32'),
(295, 'qqq qqqqqq', 'qqqqqq', '66', '15000', '2024-05-16 12:45:27'),
(296, 'qqq qqqqqq', 'qqqqqq', '66', '15000', '2024-05-16 12:46:47'),
(297, 'bbb bbbb', 'bbbbbb', '68', '15000', '2024-05-16 13:54:49'),
(298, 'bbb bbbb', 'bbbbbb', '68', '15000', '2024-05-16 13:55:40'),
(299, 'bbb bbbb', 'bbbbbb', '68', '15000', '2024-05-16 13:57:43'),
(300, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 14:56:21'),
(301, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-16 14:56:56'),
(302, 'super@123', 'super@123', '70', '15000', '2024-05-16 15:57:36'),
(303, 'super@123', 'super@123', '70', '15000', '2024-05-16 15:58:34'),
(304, 'eeee eee', 'eeeeee', '71', '15000', '2024-05-16 17:34:02'),
(305, 'eeee eee', 'eeeeee', '71', '15000', '2024-05-16 17:35:06'),
(306, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 11:17:33'),
(307, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 11:20:08'),
(308, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 11:35:43'),
(309, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:37:21'),
(310, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:40:12'),
(311, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:42:39'),
(312, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:43:31'),
(313, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:43:52'),
(314, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-17 15:46:49'),
(315, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-20 17:48:12'),
(316, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-20 17:48:19'),
(317, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-20 17:48:25'),
(318, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-20 17:48:40'),
(319, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 11:10:37'),
(320, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 11:43:30'),
(321, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 11:49:36'),
(322, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 11:58:48'),
(323, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 12:06:22'),
(324, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 12:22:13'),
(325, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-22 15:04:26'),
(326, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-22 16:00:05'),
(327, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-22 16:00:14'),
(328, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-22 16:00:27'),
(329, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 17:38:15'),
(330, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-22 17:39:28'),
(331, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-23 12:32:18'),
(332, 'Lee Yangsik', 'lee_123', '7', '15000', '2024-05-23 16:43:03'),
(333, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-24 18:28:19'),
(334, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-24 18:28:26'),
(335, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-24 18:28:32'),
(336, 'xxx xxxxx', 'xxxxxx', '73', '15000', '2024-05-24 18:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_content` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `name`, `title`, `content`, `status`, `date_content`) VALUES
(1, '관리자', '※  입출금 관련 안내 ※', '<p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\"><br></span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\">입금 : 입금하시기 전에 항상 계좌 확인을 부탁드리며, 계좌 확인을 안 하시면 입금 신청을 하실 수 없습니다 </span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\"><br></span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\">출금 : 제한없음</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\"><br></span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \" malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span style=\"background-color: rgb(255, 255, 255);\">입금하신 보증금 매매율 100% 달성 후 출금 가능합니다 (자금세탁 방지 규정)</span></p>', 'Completed', '2024-03-16 16:28:11'),
(2, '관리자', '※PC & 스마트폰 쿠키파일 삭제 방법 안내※', '<div style=\"text-align: center;\"><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">PC & 스마트폰 쿠키파일 삭제 방법 안내 </span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">PC 및 스마트폰 컨텐츠 이용시 느리거나 장애 발생 시 다음 순서와 같이 진행 해주시길 바랍니다.</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">★ 스마트 폰 ★</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">1. 쿠키/파일삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">- 모바일 앱을 사용하실 때, 오류가 발생하거나 속도가 느리다면, 모바일 브라우저의 쿠키/파일을 삭제해 주시길 바랍니다.</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">[Android]-(갤럭시s시리즈/LG G시리즈,배가시리즈 등)</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">인터넷을 실행하고 홈버튼 왼쪽을 터치해 확인되는 메뉴중, 가장 아래의 [설정]>[개인 정보 보호]> [개인 정보 삭제] 선택 후,</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">방문기록,캐시,쿠키 및 사이트 정보를 선택하고 [완료]를 눌러 삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">[IOS]-아이폰</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">사파리 브라우저 초기화는 [설정]>Safari 접속> 방문 기록을 지우기를 선택하여 삭제하거나, [설정]>Safari>[쿠키 및 데이터 지우기]</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">를 선택하여 삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">2. 실행 중인 앱 종료 및 캐시 삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\"> - 같이 실행되는 앱이 많은 경우 오류가 발생할 수 있습니다. 실행되고 있는 앱들을 정리해 주시길 바랍니다.</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">3. 앱 캐시 삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">[환전설정]>더보기를 클릭하여 [애플리케이션 관리자]를 선택하여 다운로드 된 애플리캐이션 목록 중, 문제가 발생하는 앱을 선택하여</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">[캐시 삭제]을 클릭하여 캐시 삭제</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">★ PC에서 익스플로어 이용시 쿠키 삭제 ★</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">1. 익스플로어 접속</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">2. 오른쪽 상단의 톱니바퀴 모양 클릭(혹은 [도구] 클릭)</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">3. 인터넷옵션 선택</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">4. 일반탭에서 검색기록 항목에서 [삭제]를 클릭</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">5. 쿠키 및 웹사이트 데이터 체크표시 확인 후 [삭제]클릭</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">＊PC 접속시 익스플로어 보다 크롬 (chrome)접속시 크롬에서 지원되는 GPU 가속도 기능으로 인해 접속이 더 원할 합니다.</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">고객센터 문의시 최대한 빠르고 신속하게 순차적으로 처리 하도록 하겠습니다</span></p></div>', 'Completed', '2024-03-16 16:30:02'),
(3, '관리자', '※운영시간 및 입출금 시간 안내※', '<div style=\"text-align: center;\"><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">투자거래가능시간</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">  나스닥 -  평일  : 08:00 ~ 07:00</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">SPX500 -  평일 : 08:00 ~ 07:00</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">오일 - 평일 : 08:00 ~ 07:00</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\"> </span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">입출금거래시간 </span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">입금 : 10:00 ~ 19:00<br style=\"outline: none; margin: 0px; padding: 0px; border: 0px;\">출금 : 10:00 ~ 19:00</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><금요일 PM 19:00 ~ 월요일 AM 10:00 까지 휴무로 입출금 불가합니다></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; font-size: 18px;\">고객센터운영시간 <br style=\"outline: none; margin: 0px; padding: 0px; border: 0px;\">월~금: 10:00 ~ 19:00</span></p><p style=\"outline: none; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52); font-family: \"Malgun Gothic\", dotum, sans-serif; background-color: rgb(255, 255, 255);\"> </p></div>', 'Completed', '2024-03-16 16:30:25'),
(4, '관리자', '※ 차트 기준점 ※', '<div style=\"text-align: center;\"><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">*안녕하세요*</span><br style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\"><br style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">*사용하는 차트는&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">세계 공용</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;차트이며,&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">어느 곳</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;차트를 확인해 보시더라도 같은 차트 흐름으로&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">확인하실 수 있습니다.</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;</span><br style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">*다만 실시간&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">API 값으로</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;차트&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">송출에 있어</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;많은&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">트래픽 값이</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;소모되어 차트&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">제공 처마다</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">시가, 고가, 저가, 종가</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;차이가 조금씩&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">있을 수 있으며</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;&nbsp;</span><br style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">*저희 거래소 역시&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">송출 값이</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;도착하는 시점을 기준으로 두고&nbsp;</span><span style=\"outline: none; margin: 0px; padding: 0px; border: 0px; color: rgb(170, 0, 0); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">운영 중에</span><span style=\"color: rgb(52, 52, 52); font-family: &quot;Malgun Gothic&quot;, dotum, sans-serif; font-size: 15.6px; background-color: rgb(255, 255, 255);\">&nbsp;있습니다</span><br></div>', 'Completed', '2024-03-16 16:30:44'),
(5, '관리자', ' ※ 입출금 관련 안내 ※', '<div><br></div><div><p malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52);\"><span style=\"background-color: rgb(255, 255, 255);\">입금 : 입금하시기 전에 항상 계좌 확인을 부탁드리며, 계좌 확인을 안 하시면 입금 신청을 하실 수 없습니다 </span></p><p malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52);\"><span style=\"background-color: rgb(255, 255, 255);\"><br></span></p><p malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52);\"><span style=\"background-color: rgb(255, 255, 255);\">출금 : 제한없음</span></p><p malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52);\"><span style=\"background-color: rgb(255, 255, 255);\"><br></span></p><p malgun=\"\" gothic\",=\"\" dotum,=\"\" sans-serif;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: none; padding: 0px; border: 0px; font-size: 1.2em; line-height: 1.35em; color: rgb(52, 52, 52);\"><span style=\"background-color: rgb(255, 255, 255);\">입금하신 보증금 매매율 100% 달성 후 출금 가능합니다 (자금세탁 방지 규정)</span></p></div>', 'Completed', '2024-03-16 16:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_service`
--

CREATE TABLE `customer_service` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reply_message` mediumtext NOT NULL,
  `user_request` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_service`
--

INSERT INTO `customer_service` (`id`, `userid`, `name`, `user_id`, `message`, `title`, `reply_message`, `user_request`, `status`, `date_message`) VALUES
(2, '', 'therd Geronimo', '21', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-15 11:08:31'),
(3, '', 'therd Geronimo', '21', '20,000', '입금신청', '20000', '', '입금처리완료', '2024-04-15 11:09:30'),
(4, '', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-22 10:36:46'),
(5, '', 'asdasd', '57', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-22 14:11:06'),
(6, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-22 16:48:06'),
(7, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-22 16:48:13'),
(9, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '<p>asd</p>', '[입금계좌문의]', '답변완료', '2024-04-22 16:49:26'),
(10, 'lee_123', 'Lee Yangsik', '7', '10,000', '입금신청', '10000', '', '입금처리완료', '2024-04-22 17:01:28'),
(12, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-23 11:05:48'),
(13, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-23 11:14:08'),
(14, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-04-23 11:18:02'),
(15, 'qweqwe', 'wqeqwe', '60', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-05-07 19:52:46'),
(16, 'mae@123', 'Mae Geronimo', '10', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-05-08 12:57:22'),
(17, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '입금신청', '<p>asd</p>', '[입금계좌문의]', '답변완료', '2024-05-11 12:57:56'),
(18, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금신청', '100000', '', '입금처리완료', '2024-05-11 12:59:20'),
(19, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '입금신청', '1000000', '', '입금처리완료', '2024-05-11 13:05:09'),
(20, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '입금신청', '1000000', '', '입금처리완료', '2024-05-21 11:45:09'),
(21, '', 'Lee Yangsik', '7', 'asd', 'asd', '', '[입금계좌문의]', '답변대기', '2024-05-23 18:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_mgt`
--

CREATE TABLE `deposit_mgt` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount_deposit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_deposit` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_mgt`
--

INSERT INTO `deposit_mgt` (`id`, `userid`, `name`, `user_id`, `amount_deposit`, `status`, `date_deposit`) VALUES
(5, '', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-08 11:33:12'),
(6, '', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-08 11:38:30'),
(7, '', 'Lee Yangsik', '7', '1000000', 'Completed', '2024-04-08 12:25:49'),
(8, '', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-09 12:29:47'),
(9, '', 'therd Geronimo', '21', '100000', 'Completed', '2024-04-15 11:08:52'),
(10, '', 'therd Geronimo', '21', '20000', 'Completed', '2024-04-15 11:09:40'),
(11, '', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-22 14:10:25'),
(12, '', 'asdasd', '57', '100000', 'Completed', '2024-04-22 14:11:50'),
(14, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-22 16:58:50'),
(15, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-22 16:59:11'),
(16, 'lee_123', 'Lee Yangsik', '7', '10000', 'Completed', '2024-04-22 17:02:23'),
(17, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-23 11:12:28'),
(18, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-23 11:14:20'),
(19, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-04-23 11:18:17'),
(20, 'qweqwe', 'wqeqwe', '60', '100000', 'Completed', '2024-05-07 19:52:57'),
(21, 'mae@123', 'Mae Geronimo', '10', '100000', 'Completed', '2024-05-11 12:58:16'),
(22, 'mae@123', 'Mae Geronimo', '10', '100000', 'Completed', '2024-05-11 12:58:59'),
(23, 'lee_123', 'Lee Yangsik', '7', '100000', 'Completed', '2024-05-11 12:59:43'),
(24, 'lee_123', 'Lee Yangsik', '7', '1000000', 'Completed', '2024-05-11 13:06:05'),
(25, 'lee_123', 'Lee Yangsik', '7', '1000000', 'Completed', '2024-05-21 11:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `generate_numbers`
--

CREATE TABLE `generate_numbers` (
  `gen_id` int(11) NOT NULL,
  `main_numbers` varchar(100) NOT NULL,
  `powerball_number` varchar(20) NOT NULL,
  `winning_price` int(100) NOT NULL DEFAULT 0,
  `generated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generate_numbers`
--

INSERT INTO `generate_numbers` (`gen_id`, `main_numbers`, `powerball_number`, `winning_price`, `generated_at`) VALUES
(7, '6,9,15,19,26', '6', 210000, '2024-02-24 14:45:29'),
(8, '7,12,14,18,23', '8', 1540000, '2024-02-26 09:43:19'),
(9, '7,11,15,21,25', '8', 175000, '2024-02-27 06:35:27'),
(10, '3,9,14,25,3', '2', 700000, '2024-02-28 12:51:29'),
(11, '3,9,10,15,20', '5', 105000, '2024-02-29 20:54:10'),
(12, '3,6,10,25,27', '5', 280000, '2024-03-01 05:33:00'),
(13, '4,7,14,20,24', '3', 665000, '2024-03-02 15:01:55'),
(14, '3,9,15,26,28', '5', 175000, '2024-03-03 15:23:16'),
(15, '3,5,10,13,20', '6', 350000, '2024-03-04 15:56:57'),
(17, '1,2,7,20,24', '6', 840000, '2024-03-06 16:59:08'),
(18, '1,7,15,22,25', '6', 420000, '2024-03-07 16:47:48'),
(19, '4,6,13,19,20', '4', 175000, '2024-03-08 04:32:40'),
(20, '4,8,9,15,22', '4', 140000, '2024-03-09 15:11:08'),
(33, '12,13,14,15,16', '2', 1000000, '2024-03-12 21:44:00'),
(34, '12,13,14,15,16', '14', 1000000, '2024-03-13 01:54:53'),
(35, '12,13,14,15,16', '2', 1000000, '2024-03-14 00:33:31'),
(36, '27,21,22,23,24', '2', 1000000, '2024-03-15 01:18:16'),
(37, '12,13,14,15,16', '2', 1000000, '2024-03-17 17:42:03'),
(38, '12,13,14,15,16', '2', 1000000, '2024-03-18 19:19:06'),
(41, '12,13,14,15,16', '2', 1000000, '2024-03-19 12:27:26'),
(42, '12,13,14,15,16', '2', 1000000, '2024-03-20 11:05:31'),
(43, '12,13,14,15,16', '1', 1000000, '2024-03-21 10:58:57'),
(44, '12,13,14,15,1', '1', 35000, '2024-03-24 15:19:52'),
(45, '12,13,14,15,16', '1', 1000000, '2024-03-25 15:19:43'),
(46, '15,18,25,1,20', '2', 1000000, '2024-03-26 11:39:00'),
(47, '12,13,14,15,16', '2', 1000000, '2024-03-27 10:40:13'),
(48, '12,13,14,15,16', '2', 1000000, '2024-03-28 10:45:32'),
(49, '12,13,14,15,16', '2', 1000000, '2024-03-29 09:54:44'),
(50, '12,13,14,15,16', '2', 1000000, '2024-03-31 10:21:01'),
(51, '12,13,14,15,16', '2', 1000000, '2024-04-01 10:48:36'),
(52, '12,13,14,15,16', '2', 1000000, '2024-04-02 10:30:21'),
(53, '12,13,14,15,16', '2', 1000000, '2024-04-03 12:01:25'),
(54, '12,13,14,15,16', '2', 1000000, '2024-04-03 16:05:05'),
(55, '12,13,14,15,16', '2', 1000000, '2024-04-05 15:27:57'),
(56, '12,13,14,15,16', '2', 1000000, '2024-04-07 11:02:50'),
(57, '12,13,14,15,16', '2', 1000000, '2024-04-08 10:53:04'),
(58, '12,13,14,15,16', '2', 1000000, '2024-04-10 13:55:05'),
(59, '12,13,14,15,16', '2', 1000000, '2024-04-13 00:00:00'),
(60, '12,13,14,15,16', '2', 1000000, '2024-04-14 00:00:00'),
(61, '12,13,14,15,16', '2', 1000000, '2024-04-15 00:00:00'),
(62, '12,13,14,15,16', '2', 1000000, '2024-04-16 00:00:00'),
(63, '12,13,14,15,16', '2', 1000000, '2024-04-17 00:00:00'),
(64, '12,13,14,15,16', '2', 1000000, '2024-04-19 00:00:00'),
(65, '12,13,14,15,16', '2', 1000000, '2024-04-20 00:00:00'),
(66, '12,13,14,15,16', '2', 1000000, '2024-04-21 14:13:53'),
(67, '12,13,14,15,16', '2', 1000000, '2024-04-22 11:40:41'),
(68, '12,13,14,15,16', '2', 1000000, '2024-04-23 00:00:00'),
(69, '12,13,14,15,16', '2', 1000000, '2024-04-26 10:59:27'),
(70, '12,13,14,15,16', '2', 1000000, '2024-04-27 00:00:00'),
(71, '12,13,14,15,16', '2', 1000000, '2024-04-28 10:22:28'),
(72, '12,13,14,15,16', '2', 1000000, '2024-04-29 00:00:00'),
(73, '12,13,14,15,16', '2', 1000000, '2024-04-30 00:00:00'),
(74, '12,13,14,15,16', '2', 1000000, '2024-05-01 00:00:00'),
(75, '12,13,14,15,16', '2', 1000000, '2024-05-05 00:00:00'),
(76, '12,13,14,15,16', '2', 1000000, '2024-05-06 11:11:51'),
(77, '12,13,14,15,16', '2', 1000000, '2024-05-07 16:54:39'),
(78, '12,13,14,15,16', '2', 1000000, '2024-05-08 14:07:48'),
(79, '34, 39, 43, 51, 52', '19', 0, '2024-05-09 20:01:53'),
(80, '12,13,14,15,16', '2', 1000000, '2024-05-10 10:38:55'),
(81, '12,13,14,15,16', '2', 1000000, '2024-05-12 14:49:42'),
(82, '12,13,14,15,16', '2', 1000000, '2024-05-13 11:45:59'),
(83, '12,13,14,15,16', '2', 0, '2024-05-14 11:44:41'),
(84, '12,13,14,15,16', '2', 1000000, '2024-05-15 00:00:00'),
(85, '12,13,14,15,16', '2', 1000000, '2024-05-16 10:40:05'),
(86, '12,13,14,15,16', '2', 1000000, '2024-05-17 11:13:23'),
(87, '12,13,14,15,16', '2', 1000000, '2024-05-18 00:00:00'),
(90, '12,13,14,15,16', '0', 1000000, '2024-05-19 12:07:00'),
(95, '12,13,14,15,16', '1', 1000000, '2024-05-20 00:00:00'),
(96, '12,13,14,15,16', '0', 1000000, '2024-05-21 00:00:00'),
(97, '12,13,14,15,16', '2', 1000000, '2024-05-22 00:00:00'),
(98, '12,13,14,15,16', '2', 1000000, '2024-05-23 11:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `device_use` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `date_logs` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `userid`, `user_id`, `ip_address`, `device_use`, `verify_token`, `date_logs`, `logout_time`) VALUES
(3, '', '7', '::1', 'PC', '', '2024-04-19 16:20:42', '2024-05-22 19:03:16'),
(4, '', '22', '::1', 'PC', '', '2024-04-19 18:21:14', '2024-05-22 19:03:16'),
(5, '', '22', '::1', 'PC', '', '2024-04-19 18:22:19', '2024-05-22 19:03:16'),
(6, '', '7', '::1', 'PC', '', '2024-04-19 18:25:01', '2024-05-22 19:03:16'),
(7, '', '7', '::1', 'PC', '', '2024-04-19 18:26:42', '2024-05-22 19:03:16'),
(8, '', '7', '::1', 'PC', '', '2024-04-19 18:46:12', '2024-05-22 19:03:16'),
(9, '', '7', '::1', 'PC', '', '2024-04-19 18:47:36', '2024-05-22 19:03:16'),
(10, '', '7', '::1', 'PC', '', '2024-04-19 18:48:01', '2024-05-22 19:03:16'),
(11, '', '7', '::1', 'PC', '', '2024-04-19 18:49:38', '2024-05-22 19:03:16'),
(12, '', '7', '::1', 'PC', '', '2024-04-19 18:51:59', '2024-05-22 19:03:16'),
(13, '', '7', '::1', 'PC', '', '2024-04-19 18:54:51', '2024-05-22 19:03:16'),
(14, '', '7', '::1', 'PC', '', '2024-04-19 18:57:10', '2024-05-22 19:03:16'),
(15, '', '7', '::1', 'PC', '', '2024-04-19 18:58:44', '2024-05-22 19:03:16'),
(16, '', '7', '::1', 'PC', '', '2024-04-19 19:00:37', '2024-05-22 19:03:16'),
(17, '', '7', '::1', 'PC', '', '2024-04-19 19:34:35', '2024-05-22 19:03:16'),
(18, '', '7', '::1', 'PC', '', '2024-04-19 19:36:27', '2024-05-22 19:03:16'),
(19, '', '7', '::1', 'PC', '', '2024-04-20 10:40:49', '2024-05-22 19:03:16'),
(20, '', '7', '::1', 'PC', '', '2024-04-20 14:09:29', '2024-05-22 19:03:16'),
(21, '', '25', '::1', 'PC', '', '2024-04-20 14:13:35', '2024-05-22 19:03:16'),
(22, '', '42', '::1', 'PC', '', '2024-04-20 17:39:29', '2024-05-22 19:03:16'),
(23, '', '7', '::1', 'PC', '', '2024-04-22 10:36:38', '2024-05-22 19:03:16'),
(24, '', '54', '::1', 'PC', '', '2024-04-22 13:21:07', '2024-05-22 19:03:16'),
(25, '', '56', '::1', 'PC', '', '2024-04-22 13:29:57', '2024-05-22 19:03:16'),
(26, '', '57', '::1', 'PC', '', '2024-04-22 13:44:47', '2024-05-22 19:03:16'),
(27, '', '7', '::1', 'PC', '', '2024-04-22 15:44:24', '2024-05-22 19:03:16'),
(28, '', '7', '::1', 'PC', '', '2024-04-22 16:48:48', '2024-05-22 19:03:16'),
(29, '', '7', '::1', 'PC', '', '2024-04-23 10:22:50', '2024-05-22 19:03:16'),
(30, '', '7', '::1', 'PC', '', '2024-04-23 10:44:56', '2024-05-22 19:03:16'),
(31, '', '10', '::1', 'PC', '', '2024-04-23 11:39:05', '2024-05-22 19:03:16'),
(32, '', '7', '::1', 'PC', '', '2024-04-23 17:43:46', '2024-05-22 19:03:16'),
(33, '', '7', '::1', 'PC', '', '2024-04-24 13:54:13', '2024-05-22 19:03:16'),
(34, '', '7', '::1', 'PC', '', '2024-04-24 14:43:27', '2024-05-22 19:03:16'),
(35, '', '7', '::1', 'PC', '', '2024-04-25 16:41:50', '2024-05-22 19:03:16'),
(36, '', '7', '::1', 'PC', '', '2024-04-27 11:35:22', '2024-05-22 19:03:16'),
(37, '', '7', '::1', 'PC', '', '2024-04-29 10:13:21', '2024-05-22 19:03:16'),
(38, '', '7', '::1', 'PC', '', '2024-04-29 13:40:44', '2024-05-22 19:03:16'),
(39, '', '7', '::1', 'PC', '', '2024-04-29 13:41:08', '2024-05-22 19:03:16'),
(40, '', '7', '::1', 'PC', '', '2024-04-29 13:42:34', '2024-05-22 19:03:16'),
(41, '', '7', '::1', 'PC', '', '2024-05-01 10:51:53', '2024-05-22 19:03:16'),
(42, '', '7', '::1', 'PC', '', '2024-05-03 18:35:46', '2024-05-22 19:03:16'),
(43, '', '7', '::1', 'PC', '', '2024-05-06 10:44:02', '2024-05-22 19:03:16'),
(44, '', '7', '::1', 'PC', '', '2024-05-06 10:46:59', '2024-05-22 19:03:16'),
(45, '', '7', '::1', 'PC', '', '2024-05-06 10:47:43', '2024-05-22 19:03:16'),
(46, '', '7', '::1', 'PC', '', '2024-05-06 14:40:26', '2024-05-22 19:03:16'),
(47, '', '10', '::1', 'PC', '', '2024-05-06 14:41:43', '2024-05-22 19:03:16'),
(48, '', '7', '::1', 'PC', '', '2024-05-06 15:20:46', '2024-05-22 19:03:16'),
(49, '', '7', '::1', 'Mobile', '', '2024-05-06 16:52:11', '2024-05-22 19:03:16'),
(50, '', '7', '::1', 'Mobile', '', '2024-05-06 18:58:04', '2024-05-22 19:03:16'),
(51, '', '7', '::1', 'Mobile', '', '2024-05-06 19:01:30', '2024-05-22 19:03:16'),
(52, '', '7', '::1', 'PC', '', '2024-05-06 19:39:17', '2024-05-22 19:03:16'),
(53, '', '7', '::1', 'PC', '', '2024-05-06 19:40:25', '2024-05-22 19:03:16'),
(54, '', '7', '::1', 'Mobile', '', '2024-05-07 16:22:15', '2024-05-22 19:03:16'),
(55, '', '7', '::1', 'Mobile', '', '2024-05-07 17:20:16', '2024-05-22 19:03:16'),
(56, '', '60', '::1', 'PC', '', '2024-05-07 19:12:37', '2024-05-22 19:03:16'),
(57, '', '60', '::1', 'PC', '', '2024-05-07 19:15:10', '2024-05-22 19:03:16'),
(58, '', '60', '::1', 'PC', '', '2024-05-07 19:31:48', '2024-05-22 19:03:16'),
(59, '', '60', '::1', 'PC', '', '2024-05-07 19:35:46', '2024-05-22 19:03:16'),
(60, '', '7', '::1', 'PC', '', '2024-05-08 10:23:30', '2024-05-22 19:03:16'),
(61, '', '60', '::1', 'PC', '', '2024-05-08 10:23:50', '2024-05-22 19:03:16'),
(62, '', '7', '::1', 'PC', '', '2024-05-08 10:25:34', '2024-05-22 19:03:16'),
(63, '', '7', '::1', 'PC', '', '2024-05-08 10:37:47', '2024-05-22 19:03:16'),
(64, '', '60', '::1', 'PC', '', '2024-05-08 10:59:12', '2024-05-22 19:03:16'),
(65, '', '10', '::1', 'PC', '', '2024-05-08 12:07:33', '2024-05-22 19:03:16'),
(66, '', '7', '::1', 'PC', '', '2024-05-08 15:55:04', '2024-05-22 19:03:16'),
(67, '', '10', '::1', 'PC', '', '2024-05-08 15:56:47', '2024-05-22 19:03:16'),
(68, '', '60', '::1', 'PC', '', '2024-05-08 15:57:13', '2024-05-22 19:03:16'),
(69, '', '7', '::1', 'PC', '', '2024-05-08 16:57:53', '2024-05-22 19:03:16'),
(70, '', '7', '::1', 'PC', '', '2024-05-08 16:59:00', '2024-05-22 19:03:16'),
(71, '', '7', '::1', 'PC', '', '2024-05-08 17:08:29', '2024-05-22 19:03:16'),
(72, '', '10', '::1', 'PC', '', '2024-05-08 18:51:46', '2024-05-22 19:03:16'),
(73, '', '60', '::1', 'PC', '', '2024-05-09 11:32:25', '2024-05-22 19:03:16'),
(74, '', '7', '::1', 'PC', '', '2024-05-09 11:33:19', '2024-05-22 19:03:16'),
(75, '', '60', '::1', 'PC', '', '2024-05-09 11:33:37', '2024-05-22 19:03:16'),
(76, '', '7', '::1', 'PC', '', '2024-05-09 14:09:11', '2024-05-22 19:03:16'),
(77, '', '7', '::1', 'PC', '', '2024-05-09 17:04:43', '2024-05-22 19:03:16'),
(78, '', '7', '::1', 'PC', '', '2024-05-09 17:08:25', '2024-05-22 19:03:16'),
(79, '', '7', '::1', 'PC', '', '2024-05-09 17:26:44', '2024-05-22 19:03:16'),
(80, '', '7', '::1', 'PC', '', '2024-05-09 17:32:59', '2024-05-22 19:03:16'),
(81, '', '7', '::1', 'PC', '', '2024-05-09 17:34:47', '2024-05-22 19:03:16'),
(82, '', '7', '::1', 'PC', '', '2024-05-09 17:35:10', '2024-05-22 19:03:16'),
(83, '', '7', '::1', 'PC', '', '2024-05-09 17:39:57', '2024-05-22 19:03:16'),
(84, '', '7', '::1', 'PC', '', '2024-05-09 17:40:17', '2024-05-22 19:03:16'),
(85, '', '60', '::1', 'PC', '', '2024-05-09 17:42:21', '2024-05-22 19:03:16'),
(86, '', '7', '::1', 'PC', '', '2024-05-09 17:43:44', '2024-05-22 19:03:16'),
(87, '', '10', '::1', 'Mobile', '', '2024-05-09 19:47:33', '2024-05-22 19:03:16'),
(88, '', '7', '::1', 'PC', '', '2024-05-10 11:34:04', '2024-05-22 19:03:16'),
(89, '', '60', '::1', 'PC', '', '2024-05-10 12:16:20', '2024-05-22 19:03:16'),
(90, '', '61', '::1', 'PC', '', '2024-05-10 14:21:05', '2024-05-22 19:03:16'),
(91, '', '61', '::1', 'PC', '', '2024-05-10 14:22:53', '2024-05-22 19:03:16'),
(92, '', '61', '::1', 'PC', '', '2024-05-10 14:26:05', '2024-05-22 19:03:16'),
(93, '', '61', '::1', 'PC', '', '2024-05-10 14:27:31', '2024-05-22 19:03:16'),
(94, '', '61', '::1', 'PC', '', '2024-05-10 15:12:17', '2024-05-22 19:03:16'),
(95, '', '61', '::1', 'PC', '', '2024-05-10 16:15:09', '2024-05-22 19:03:16'),
(96, '', '61', '::1', 'PC', '', '2024-05-10 16:15:35', '2024-05-22 19:03:16'),
(97, '', '7', '::1', 'PC', '', '2024-05-10 17:06:02', '2024-05-22 19:03:16'),
(98, '', '7', '::1', 'PC', '', '2024-05-10 17:58:19', '2024-05-22 19:03:16'),
(99, '', '61', '::1', 'PC', '', '2024-05-10 18:36:00', '2024-05-22 19:03:16'),
(100, '', '61', '::1', 'PC', '', '2024-05-10 18:39:43', '2024-05-22 19:03:16'),
(101, '', '61', '::1', 'PC', '', '2024-05-10 18:46:37', '2024-05-22 19:03:16'),
(102, '', '62', '::1', 'PC', '', '2024-05-10 18:51:56', '2024-05-22 19:03:16'),
(103, '', '61', '::1', 'PC', '', '2024-05-10 18:53:57', '2024-05-22 19:03:16'),
(104, '', '62', '::1', 'PC', '', '2024-05-10 18:54:07', '2024-05-22 19:03:16'),
(105, '', '62', '::1', 'PC', '', '2024-05-10 18:58:02', '2024-05-22 19:03:16'),
(106, '', '7', '::1', 'PC', '', '2024-05-10 19:27:36', '2024-05-22 19:03:16'),
(107, '', '7', '::1', 'PC', '', '2024-05-10 19:31:22', '2024-05-22 19:03:16'),
(108, '', '7', '::1', 'PC', '', '2024-05-10 19:32:50', '2024-05-22 19:03:16'),
(109, '', '7', '::1', 'PC', '', '2024-05-10 19:41:42', '2024-05-22 19:03:16'),
(110, '', '7', '::1', 'PC', '', '2024-05-10 19:47:39', '2024-05-22 19:03:16'),
(111, '', '7', '::1', 'PC', '', '2024-05-10 19:47:49', '2024-05-22 19:03:16'),
(112, '', '7', '::1', 'PC', '', '2024-05-11 10:38:42', '2024-05-22 19:03:16'),
(113, '', '7', '::1', 'PC', '', '2024-05-11 10:49:47', '2024-05-22 19:03:16'),
(114, '', '7', '::1', 'PC', '', '2024-05-11 10:55:31', '2024-05-22 19:03:16'),
(115, '', '7', '::1', 'PC', '', '2024-05-11 10:58:03', '2024-05-22 19:03:16'),
(116, '', '7', '::1', 'PC', '', '2024-05-11 10:59:03', '2024-05-22 19:03:16'),
(117, '', '7', '::1', 'PC', '', '2024-05-11 11:00:15', '2024-05-22 19:03:16'),
(118, '', '7', '::1', 'PC', '', '2024-05-11 11:04:29', '2024-05-22 19:03:16'),
(119, '', '7', '::1', 'PC', '', '2024-05-11 11:05:47', '2024-05-22 19:03:16'),
(120, '', '7', '::1', 'PC', '', '2024-05-11 11:06:48', '2024-05-22 19:03:16'),
(121, '', '7', '::1', 'PC', '', '2024-05-11 11:17:59', '2024-05-22 19:03:16'),
(122, '', '7', '::1', 'PC', '', '2024-05-11 11:19:14', '2024-05-22 19:03:16'),
(123, '', '7', '::1', 'PC', '', '2024-05-11 11:20:36', '2024-05-22 19:03:16'),
(124, '', '7', '::1', 'PC', '', '2024-05-11 11:36:31', '2024-05-22 19:03:16'),
(125, '', '10', '::1', 'PC', '', '2024-05-11 11:42:34', '2024-05-22 19:03:16'),
(126, '', '7', '::1', 'PC', '', '2024-05-11 12:56:49', '2024-05-22 19:03:16'),
(127, '', '7', '::1', 'PC', '', '2024-05-11 12:57:22', '2024-05-22 19:03:16'),
(128, '', '7', '::1', 'PC', '', '2024-05-11 13:00:22', '2024-05-22 19:03:16'),
(129, '', '7', '::1', 'PC', '', '2024-05-11 13:02:14', '2024-05-22 19:03:16'),
(130, '', '7', '::1', 'PC', '', '2024-05-11 13:03:46', '2024-05-22 19:03:16'),
(131, '', '7', '::1', 'PC', '', '2024-05-11 13:06:28', '2024-05-22 19:03:16'),
(132, '', '7', '::1', 'PC', '', '2024-05-13 09:49:01', '2024-05-22 19:03:16'),
(133, '', '7', '::1', 'PC', '', '2024-05-13 10:06:09', '2024-05-22 19:03:16'),
(134, '', '62', '::1', 'PC', '', '2024-05-13 10:15:15', '2024-05-22 19:03:16'),
(135, '', '62', '::1', 'PC', '', '2024-05-13 10:16:13', '2024-05-22 19:03:16'),
(136, '', '62', '::1', 'PC', '', '2024-05-13 10:17:04', '2024-05-22 19:03:16'),
(137, '', '62', '::1', 'PC', '', '2024-05-13 10:24:00', '2024-05-22 19:03:16'),
(138, '', '7', '::1', 'PC', '', '2024-05-13 10:24:45', '2024-05-22 19:03:16'),
(139, '', '7', '::1', 'PC', '', '2024-05-13 10:25:57', '2024-05-22 19:03:16'),
(140, '', '61', '::1', 'PC', '', '2024-05-13 10:26:39', '2024-05-22 19:03:16'),
(141, '', '61', '::1', 'PC', '', '2024-05-13 10:27:28', '2024-05-22 19:03:16'),
(142, '', '7', '::1', 'PC', '', '2024-05-13 10:33:35', '2024-05-22 19:03:16'),
(143, '', '7', '::1', 'PC', '', '2024-05-13 10:34:21', '2024-05-22 19:03:16'),
(144, '', '7', '::1', 'PC', '', '2024-05-13 14:49:23', '2024-05-22 19:03:16'),
(145, '', '60', '::1', 'PC', '', '2024-05-13 15:49:20', '2024-05-22 19:03:16'),
(146, '', '7', '::1', 'PC', '', '2024-05-14 10:50:15', '2024-05-22 19:03:16'),
(147, '', '60', '::1', 'PC', '', '2024-05-14 11:29:32', '2024-05-22 19:03:16'),
(148, '', '61', '::1', 'PC', '', '2024-05-14 17:13:34', '2024-05-22 19:03:16'),
(149, '', '61', '::1', 'PC', '', '2024-05-14 17:13:43', '2024-05-22 19:03:16'),
(150, '', '7', '::1', 'PC', '', '2024-05-15 11:43:51', '2024-05-22 19:03:16'),
(151, '', '7', '::1', 'PC', '', '2024-05-15 12:40:32', '2024-05-22 19:03:16'),
(152, '', '7', '::1', 'PC', '', '2024-05-15 14:56:35', '2024-05-22 19:03:16'),
(153, '', '7', '::1', 'PC', '', '2024-05-15 15:44:23', '2024-05-22 19:03:16'),
(154, '', '7', '::1', 'PC', '', '2024-05-15 15:56:21', '2024-05-22 19:03:16'),
(155, '', '7', '::1', 'PC', '', '2024-05-15 15:57:03', '2024-05-22 19:03:16'),
(156, '', '7', '::1', 'PC', '', '2024-05-15 15:57:23', '2024-05-22 19:03:16'),
(157, '', '7', '::1', 'PC', '', '2024-05-15 15:59:56', '2024-05-22 19:03:16'),
(158, '', '7', '::1', 'PC', '', '2024-05-15 16:08:33', '2024-05-22 19:03:16'),
(159, '', '7', '::1', 'PC', '', '2024-05-15 16:15:35', '2024-05-22 19:03:16'),
(160, '', '7', '::1', 'PC', '', '2024-05-15 17:02:03', '2024-05-22 19:03:16'),
(161, '', '7', '::1', 'PC', '', '2024-05-15 17:08:24', '2024-05-22 19:03:16'),
(162, '', '7', '::1', 'PC', '', '2024-05-15 17:35:53', '2024-05-22 19:03:16'),
(163, '', '7', '::1', 'PC', '', '2024-05-15 18:08:46', '2024-05-22 19:03:16'),
(164, '', '7', '::1', 'PC', '', '2024-05-15 18:10:04', '2024-05-22 19:03:16'),
(165, '', '7', '::1', 'PC', '', '2024-05-15 18:12:45', '2024-05-22 19:03:16'),
(166, '', '7', '::1', 'PC', '', '2024-05-15 18:33:15', '2024-05-22 19:03:16'),
(167, '', '7', '::1', 'PC', '', '2024-05-15 18:46:54', '2024-05-22 19:03:16'),
(168, '', '7', '::1', 'PC', '', '2024-05-15 19:34:08', '2024-05-22 19:03:16'),
(169, '', '7', '::1', 'PC', '', '2024-05-15 19:34:38', '2024-05-22 19:03:16'),
(170, '', '7', '::1', 'PC', '', '2024-05-16 10:33:50', '2024-05-22 19:03:16'),
(171, '', '7', '::1', 'PC', '', '2024-05-16 11:13:44', '2024-05-22 19:03:16'),
(172, '', '7', '::1', 'PC', '', '2024-05-16 11:41:15', '2024-05-22 19:03:16'),
(173, '', '7', '::1', 'PC', '', '2024-05-16 11:42:38', '2024-05-22 19:03:16'),
(174, '', '66', '::1', 'PC', '', '2024-05-16 12:37:42', '2024-05-22 19:03:16'),
(175, '', '67', '::1', 'PC', '', '2024-05-16 12:49:47', '2024-05-22 19:03:16'),
(176, '', '68', '::1', 'PC', '', '2024-05-16 13:52:32', '2024-05-22 19:03:16'),
(177, '', '68', '::1', 'PC', '', '2024-05-16 13:54:15', '2024-05-22 19:03:16'),
(178, '', '68', '::1', 'PC', '', '2024-05-16 13:54:44', '2024-05-22 19:03:16'),
(179, '', '68', '::1', 'PC', '', '2024-05-16 13:57:00', '2024-05-22 19:03:16'),
(180, '', '68', '::1', 'PC', '', '2024-05-16 13:57:36', '2024-05-22 19:03:16'),
(181, '', '7', '::1', 'PC', '', '2024-05-16 14:56:03', '2024-05-22 19:03:16'),
(182, '', '70', '::1', 'PC', '', '2024-05-16 15:56:49', '2024-05-22 19:03:16'),
(183, '', '71', '::1', 'PC', '', '2024-05-16 17:33:27', '2024-05-22 19:03:16'),
(184, '', '71', '::1', 'PC', '', '2024-05-17 10:39:10', '2024-05-22 19:03:16'),
(185, '', '7', '::1', 'PC', '', '2024-05-17 11:13:18', '2024-05-22 19:03:16'),
(186, '', '7', '::1', 'PC', '', '2024-05-17 11:15:08', '2024-05-22 19:03:16'),
(187, '', '7', '::1', 'PC', '', '2024-05-17 11:15:26', '2024-05-22 19:03:16'),
(188, '', '7', '::1', 'PC', '', '2024-05-17 11:17:25', '2024-05-22 19:03:16'),
(189, '', '7', '::1', 'PC', '', '2024-05-17 11:31:20', '2024-05-22 19:03:16'),
(190, '', '7', '::1', 'PC', '', '2024-05-17 11:35:37', '2024-05-22 19:03:16'),
(191, '', '7', '::1', 'PC', '', '2024-05-17 14:58:38', '2024-05-22 19:03:16'),
(192, '', '7', '::1', 'PC', '', '2024-05-17 15:04:03', '2024-05-22 19:03:16'),
(193, '', '7', '::1', 'PC', '', '2024-05-17 18:28:29', '2024-05-22 19:03:16'),
(194, '', '7', '::1', 'PC', '', '2024-05-17 18:45:55', '2024-05-22 19:03:16'),
(195, '', '7', '::1', 'Mobile', '', '2024-05-17 18:51:06', '2024-05-22 19:03:16'),
(196, '', '7', '::1', 'PC', '', '2024-05-17 19:14:36', '2024-05-22 19:03:16'),
(197, '', '7', '::1', 'PC', '', '2024-05-18 10:36:02', '2024-05-22 19:03:16'),
(198, '', '7', '::1', 'PC', '', '2024-05-18 10:36:52', '2024-05-22 19:03:16'),
(199, '', '7', '::1', 'PC', '', '2024-05-18 11:49:43', '2024-05-22 19:03:16'),
(200, '', '7', '::1', 'PC', '', '2024-05-18 12:20:18', '2024-05-22 19:03:16'),
(201, '', '7', '::1', 'PC', '', '2024-05-18 12:26:25', '2024-05-22 19:03:16'),
(202, '0', '7', '::1', 'PC', '', '2024-05-18 14:36:23', '2024-05-22 19:03:16'),
(203, '0', '7', '::1', 'PC', '', '2024-05-18 14:37:21', '2024-05-22 19:03:16'),
(204, '0', '7', '::1', 'PC', '', '2024-05-18 14:39:02', '2024-05-22 19:03:16'),
(205, '0', '7', '::1', 'PC', '', '2024-05-18 14:40:22', '2024-05-22 19:03:16'),
(206, 'lee_123', '7', '::1', 'PC', '', '2024-05-18 14:43:24', '2024-05-22 19:03:16'),
(207, 'mae@1234567890', '10', '::1', 'PC', '', '2024-05-18 15:11:09', '2024-05-22 19:03:16'),
(208, 'lee_123', '7', '::1', 'PC', '', '2024-05-20 10:49:41', '2024-05-22 19:03:16'),
(209, 'lee_123', '7', '::1', 'PC', '', '2024-05-20 10:50:11', '2024-05-22 19:03:16'),
(210, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 10:48:14', '2024-05-22 19:03:16'),
(211, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 16:40:57', '2024-05-22 19:03:16'),
(212, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 16:44:53', '2024-05-22 19:03:16'),
(213, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 17:32:04', '2024-05-22 19:03:16'),
(214, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 17:32:55', '2024-05-22 19:03:16'),
(215, 'lee_123', '7', '::1', 'PC', '', '2024-05-21 17:33:32', '2024-05-22 19:03:16'),
(216, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 10:30:33', '2024-05-22 19:03:16'),
(217, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 10:55:36', '2024-05-22 19:03:16'),
(218, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 10:59:13', '2024-05-22 19:03:16'),
(219, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:00:16', '2024-05-22 19:03:16'),
(220, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:05:45', '2024-05-22 19:03:16'),
(221, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:07:16', '2024-05-22 19:03:16'),
(222, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:08:12', '2024-05-22 19:03:16'),
(223, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:09:33', '2024-05-22 19:03:16'),
(224, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:10:26', '2024-05-22 19:03:16'),
(225, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:33:53', '2024-05-22 19:03:16'),
(226, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:35:46', '2024-05-22 19:03:16'),
(227, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:40:04', '2024-05-22 19:03:16'),
(228, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:40:53', '2024-05-22 19:03:16'),
(229, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:41:27', '2024-05-22 19:03:16'),
(230, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:42:30', '2024-05-22 19:03:16'),
(231, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:47:05', '2024-05-22 19:03:16'),
(232, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:48:38', '2024-05-22 19:03:16'),
(233, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:49:10', '2024-05-22 19:03:16'),
(234, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:49:27', '2024-05-22 19:03:16'),
(235, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:50:55', '2024-05-22 19:03:16'),
(236, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:51:18', '2024-05-22 19:03:16'),
(237, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:52:20', '2024-05-22 19:03:16'),
(238, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:55:09', '2024-05-22 19:03:16'),
(239, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:55:56', '2024-05-22 19:03:16'),
(240, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:56:11', '2024-05-22 19:03:16'),
(241, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:56:59', '2024-05-22 19:03:16'),
(242, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 11:58:41', '2024-05-22 19:03:16'),
(243, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:00:23', '2024-05-22 19:03:16'),
(244, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:01:23', '2024-05-22 19:03:16'),
(245, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:05:19', '2024-05-22 19:03:16'),
(246, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:05:49', '2024-05-22 19:03:16'),
(247, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:06:15', '2024-05-22 19:03:16'),
(248, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:08:00', '2024-05-22 19:03:16'),
(249, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:12:20', '2024-05-22 19:03:16'),
(250, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:13:04', '2024-05-22 19:03:16'),
(251, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:13:30', '2024-05-22 19:03:16'),
(252, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:14:02', '2024-05-22 19:03:16'),
(253, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:14:37', '2024-05-22 19:03:16'),
(254, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:18:47', '2024-05-22 19:03:16'),
(255, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:21:10', '2024-05-22 19:03:16'),
(256, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:21:37', '2024-05-22 19:03:16'),
(257, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:22:07', '2024-05-22 19:03:16'),
(258, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:43:14', '2024-05-22 19:03:16'),
(259, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 12:43:47', '2024-05-22 19:03:16'),
(260, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 14:17:39', '2024-05-22 19:03:16'),
(261, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 14:44:07', '2024-05-22 19:03:16'),
(262, 'lee_123', '7', '::1', 'PC', '::1', '2024-05-22 15:37:44', '2024-05-22 19:03:16'),
(263, 'lee_123', '7', '::1', 'PC', 'Unknown', '2024-05-22 15:42:56', '2024-05-22 19:03:16'),
(264, 'lee_123', '7', '::1', 'PC', 'Unknown', '2024-05-22 15:45:08', '2024-05-22 19:03:16'),
(265, 'lee_123', '7', '::1', 'PC', 'Unknown', '2024-05-22 15:48:53', '2024-05-22 19:03:16'),
(266, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 15:50:48', '2024-05-22 19:03:16'),
(267, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 15:59:41', '2024-05-22 19:03:16'),
(268, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:28:06', '2024-05-22 19:03:16'),
(269, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:29:23', '2024-05-22 19:03:16'),
(270, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:30:15', '2024-05-22 19:03:16'),
(271, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:34:55', '2024-05-22 19:03:16'),
(272, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:35:44', '2024-05-22 19:03:16'),
(273, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:37:11', '2024-05-22 19:03:16'),
(274, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:37:45', '2024-05-22 19:03:16'),
(275, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:38:15', '2024-05-22 19:03:16'),
(276, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 16:41:22', '2024-05-22 19:03:16'),
(277, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:09:44', '2024-05-22 19:03:16'),
(278, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:10:30', '2024-05-22 19:03:16'),
(279, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:24:36', '2024-05-22 19:03:16'),
(280, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:25:56', '2024-05-22 19:03:16'),
(281, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:26:44', '2024-05-22 19:03:16'),
(282, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 17:31:43', '2024-05-22 19:03:16'),
(283, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 17:37:51', '2024-05-22 19:03:16'),
(284, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 17:38:05', '2024-05-22 19:03:16'),
(285, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 17:38:52', '2024-05-22 19:03:16'),
(286, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 17:39:22', '2024-05-22 19:03:16'),
(287, 'lee_123', '7', '::1', 'PC', '', '2024-05-22 18:11:04', '2024-05-22 19:03:16'),
(288, 'xxxxxx', '73', '::1', 'PC', '', '2024-05-22 18:11:14', '2024-05-22 19:03:16'),
(289, 'xxxxxx', '73', '::1', 'PC', 'df1835f20904afdfbaa210f4579c26b9', '2024-05-22 18:40:43', '2024-05-22 19:03:16'),
(290, 'xxxxxx', '73', '::1', 'PC', 'df1835f20904afdfbaa210f4579c26b9', '2024-05-22 18:44:39', '2024-05-22 19:03:16'),
(291, 'xxxxxx', '73', '::1', 'PC', 'df1835f20904afdfbaa210f4579c26b9', '2024-05-22 18:44:53', '2024-05-22 19:03:16'),
(292, 'xxxxxx', '73', '::1', 'PC', 'df1835f20904afdfbaa210f4579c26b9', '2024-05-22 18:50:25', '2024-05-22 19:03:16'),
(293, 'xxxxxx', '73', '::1', 'PC', 'df1835f20904afdfbaa210f4579c26b9', '2024-05-22 18:54:06', '2024-05-22 19:03:16'),
(294, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-22 18:57:30', '2024-05-22 19:03:16'),
(295, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-22 18:57:53', '2024-05-22 19:03:16'),
(296, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-22 19:16:00', '2024-05-22 19:43:18'),
(297, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-22 19:43:30', '2024-05-22 19:45:09'),
(298, 'lee_123', '7', '::1', 'PC', '', '2024-05-23 11:02:00', '2024-05-23 11:02:00'),
(299, 'lee_123', '7', '::1', 'PC', '', '2024-05-23 11:03:09', '2024-05-23 11:03:09'),
(300, 'lee_123', '7', '::1', 'PC', '', '2024-05-23 11:12:04', '2024-05-23 11:12:04'),
(301, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 11:12:59', '2024-05-23 11:21:26'),
(302, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 11:21:39', '2024-05-23 11:23:10'),
(306, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 11:30:17', '2024-05-23 11:32:22'),
(313, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 11:40:09', '2024-05-23 11:54:55'),
(315, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:03:58', '2024-05-23 12:07:05'),
(316, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:07:11', '2024-05-23 12:11:25'),
(317, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:11:32', '2024-05-23 12:12:40'),
(318, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:13:47', '2024-05-23 12:13:47'),
(319, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:30:52', '2024-05-23 12:30:52'),
(320, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:31:43', '2024-05-23 12:31:43'),
(321, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:32:11', '2024-05-23 12:32:11'),
(322, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:33:20', '2024-05-23 12:33:20'),
(323, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:35:08', '2024-05-23 12:35:08'),
(324, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:35:17', '2024-05-23 12:35:17'),
(325, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:40:28', '2024-05-23 12:40:28'),
(326, 'lee_123', '7', '::1', 'PC', 'b6a7d9bc4a2617c6e291db4278463e7d', '2024-05-23 12:58:28', NULL),
(327, 'lee_123', '7', '::1', 'PC', 'pkm1ktjnfjeh92nftnq0tbcr9n', '2024-05-23 15:59:36', '2024-05-23 15:59:36'),
(328, 'lee_123', '7', '::1', 'PC', '07fb17djveb1d34e14jtcqk6nj', '2024-05-23 16:00:00', '2024-05-23 16:00:00'),
(329, 'lee_123', '7', '::1', 'PC', 'bi9jl6dnamo9m7glm4qtddn4fb', '2024-05-23 16:05:22', '2024-05-23 16:05:22'),
(330, 'lee_123', '7', '::1', 'PC', '376cqcfbpc10ne7a35r11o0oj9', '2024-05-23 16:18:18', '2024-05-23 16:18:18'),
(331, 'lee_123', '7', '::1', 'PC', '0cqtgcfr5ucn3c8mbk0kpmvloh', '2024-05-23 16:18:22', '2024-05-23 16:18:22'),
(332, 'lee_123', '7', '::1', 'PC', '6ocq3tdbes2jmob9ukq1b5cci4', '2024-05-23 16:22:34', '2024-05-23 16:22:34'),
(333, 'lee_123', '7', '::1', 'PC', 'jfp2adbtbpvubpa6qb4av8edbg', '2024-05-23 16:23:23', '2024-05-23 16:23:23'),
(334, 'lee_123', '7', '::1', 'PC', 'ne4m72fmdh4bpjiin2lec4v46g', '2024-05-23 16:26:35', '2024-05-23 16:26:35'),
(335, 'lee_123', '7', '::1', 'PC', 'cog745ltg8hiu5gv42iubkq08a', '2024-05-23 16:26:43', '2024-05-23 16:26:43'),
(336, 'lee_123', '7', '::1', 'PC', 'vpa14n2j9o1fbbbp1np9q6bhd3', '2024-05-23 16:39:45', '2024-05-23 16:39:45'),
(337, 'lee_123', '7', '::1', 'PC', 'to381j8irr303couq45clpqt7m', '2024-05-23 16:39:51', '2024-05-23 16:39:51'),
(338, 'lee_123', '7', '::1', 'PC', 'lgg619m1dlqgj2ed0o442c3mar', '2024-05-23 16:42:04', '2024-05-23 16:42:04'),
(339, 'lee_123', '7', '::1', 'PC', 'sg7qr74e14t81cttgbdfoihdel', '2024-05-23 16:43:16', '2024-05-23 16:43:16'),
(340, 'lee_123', '7', '::1', 'PC', 'ouk5ovvanh398o9vo74h68rinp', '2024-05-23 16:43:58', '2024-05-23 16:43:58'),
(341, 'lee_123', '7', '::1', 'PC', '40cia4kdqijuadafe37761j1om', '2024-05-23 16:44:46', '2024-05-23 16:44:46'),
(342, 'lee_123', '7', '::1', 'PC', 'iupk2n87m04ehurnukngj3clf2', '2024-05-23 16:47:58', '2024-05-23 16:47:58'),
(343, 'lee_123', '7', '::1', 'PC', 'cm35lu0m99j7lphm0ah03n1ta1', '2024-05-23 16:50:24', '2024-05-23 16:50:24'),
(344, 'lee_123', '7', '::1', 'PC', '5a2asrmubg35e9v4tcjsbfm0ov', '2024-05-23 16:54:11', '2024-05-23 16:54:11'),
(345, 'lee_123', '7', '::1', 'PC', 'r545eh4g914lop1321ce7ka1el', '2024-05-23 16:56:08', '2024-05-23 16:56:08'),
(346, 'lee_123', '7', '::1', 'PC', '4qsa17qj761q86ds7hh7ht586t', '2024-05-23 16:57:38', '2024-05-23 16:57:38'),
(347, 'lee_123', '7', '::1', 'PC', 'lvl9f3p21q6dnk9f4cifdsiu0a', '2024-05-23 16:57:53', '2024-05-23 16:57:53'),
(348, 'lee_123', '7', '::1', 'PC', 'bv8i12090o64mf1tnra0kss399', '2024-05-23 16:58:36', '2024-05-23 16:58:36'),
(349, 'lee_123', '7', '::1', 'PC', '3vih9u4lsu87qdv1ebmvq85iva', '2024-05-23 16:59:19', '2024-05-23 16:59:19'),
(350, 'lee_123', '7', '::1', 'PC', 'lrs38ho02t6ud46nj84ecbb6i5', '2024-05-23 16:59:33', '2024-05-23 16:59:33'),
(351, 'lee_123', '7', '::1', 'PC', '075f38etufk5k9dfba6dgsulsa', '2024-05-23 17:00:58', '2024-05-23 17:00:58'),
(352, 'lee_123', '7', '::1', 'PC', 'at71g636mqnfns75e7rebskukk', '2024-05-23 17:01:22', '2024-05-23 17:01:22'),
(353, 'lee_123', '7', '::1', 'PC', 'najehf2a9lpbm217vlrm0igeq3', '2024-05-23 17:09:44', '2024-05-23 17:09:44'),
(354, 'lee_123', '7', '::1', 'PC', 'nc4bdvg1i5isahg356qok3iedo', '2024-05-23 17:09:51', '2024-05-23 17:09:51'),
(355, 'lee_123', '7', '::1', 'PC', '0idonu8md4s9sqpbp8gqknaugv', '2024-05-23 17:14:50', '2024-05-23 17:14:50'),
(356, 'lee_123', '7', '::1', 'PC', 'ep2cq5sev24hom0th8mbvphqa6', '2024-05-23 17:16:56', '2024-05-23 17:16:56'),
(357, 'lee_123', '7', '::1', 'PC', 'rhf0qm0erf8vdstnj5l9sa1ca8', '2024-05-23 17:19:34', '2024-05-23 17:19:34'),
(358, 'lee_123', '7', '::1', 'PC', '2ed8a1lb1tunv6j9brjv2aqh5j', '2024-05-23 17:24:25', '2024-05-23 17:24:25'),
(359, 'lee_123', '7', '::1', 'PC', '8f6he947654t816uhf27ofe9sf', '2024-05-23 17:32:06', '2024-05-23 17:32:06'),
(360, 'lee_123', '7', '::1', 'PC', 'e7lcipfn88k0cce9bvojgns0a3', '2024-05-23 18:05:25', '2024-05-23 18:05:25'),
(361, 'lee_123', '7', '::1', 'PC', 'hkml7l0f4oij0l454lo7ppmdjp', '2024-05-23 18:10:39', '2024-05-23 18:10:39'),
(362, 'lee_123', '7', '::1', 'PC', '4qgpl431cuacnn9dus42md50u5', '2024-05-23 18:11:32', '2024-05-23 18:11:32'),
(363, 'lee_123', '7', '::1', 'PC', '984jevrqj3k7s6gvrlorr23esm', '2024-05-23 18:38:42', '2024-05-23 18:38:42'),
(364, 'lee_123', '7', '::1', 'PC', '4rsn71q0ojh94qbn84h0cohjfa', '2024-05-23 18:51:11', '2024-05-23 18:51:11'),
(365, 'lee_123', '7', '::1', 'PC', '3pnlv35koipcbeg99eleev7brg', '2024-05-23 19:20:30', '2024-05-23 19:20:30'),
(366, 'lee_123', '7', '::1', 'PC', 'ackki32b1sq904vlggk8hv9t01', '2024-05-23 19:50:46', '2024-05-23 19:50:46'),
(367, 'lee_123', '7', '::1', 'PC', 'm6d6c5hrk0j3lfe8v1bsuint29', '2024-05-24 10:27:51', '2024-05-24 10:27:51'),
(368, 'xxxxxx', '73', '::1', 'PC', '4jmvps03vt5868oihvsu5gbh7l', '2024-05-24 18:28:06', '2024-05-24 18:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `powerball_results`
--

CREATE TABLE `powerball_results` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `white_balls` varchar(100) NOT NULL DEFAULT '0',
  `powerball` varchar(100) NOT NULL DEFAULT '0',
  `winning_price` varchar(100) NOT NULL DEFAULT '0',
  `winning_match_numbers` varchar(100) NOT NULL DEFAULT '0',
  `date_draw` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `powerball_results`
--

INSERT INTO `powerball_results` (`id`, `username`, `white_balls`, `powerball`, `winning_price`, `winning_match_numbers`, `date_draw`) VALUES
(1, 'Therdy', '2, 13, 40, 55, 67', '16', '0', '0', '2024-01-09 07:30:25'),
(2, '', '2, 50, 65, 68, 69', '1', '0', '0', '2024-01-09 07:32:35'),
(3, '', '1, 9, 10, 53, 64', '8', '0', '0', '2024-01-09 07:32:41'),
(4, '', '24, 44, 50, 60, 63', '18', '0', '0', '2024-01-09 07:33:25'),
(5, '', '6, 15, 45, 56, 58', '15', '0', '0', '2024-01-09 07:33:41'),
(6, '', '8, 18, 29, 37, 49', '5', '0', '0', '2024-01-09 07:34:22'),
(7, '', '19, 35, 37, 38, 52', '25', '0', '0', '2024-01-09 07:35:11'),
(8, '', '13, 17, 19, 27, 37', '1', '0', '0', '2024-01-09 07:37:08'),
(9, '', '6, 17, 33, 61, 67', '9', '0', '0', '2024-01-09 07:37:10'),
(10, '', '36, 40, 42, 49, 51', '20', '0', '0', '2024-01-09 09:16:58'),
(11, '', '10, 14, 25, 45, 52', '17', '0', '0', '2024-01-10 00:55:38'),
(12, '', '7, 14, 15, 19, 23', '1', '0', '0', '2024-01-10 01:13:01'),
(13, '', '13, 15, 40, 60, 69', '3', '0', '0', '2024-01-10 01:13:52'),
(14, '', '24, 29, 48, 52, 67', '1', '0', '0', '2024-01-10 01:14:02'),
(15, '', '5, 6, 19, 44, 45', '20', '0', '0', '2024-01-10 01:49:32'),
(16, '', '41, 43, 53, 65, 68', '19', '0', '0', '2024-01-10 03:20:32'),
(17, '', '15, 24, 32, 41, 60', '19', '0', '0', '2024-01-10 03:21:28'),
(18, '', '4, 20, 24, 42, 58', '16', '0', '0', '2024-01-10 03:22:51'),
(19, '', '5, 7, 29, 59, 63', '26', '0', '0', '2024-01-10 03:23:04'),
(20, '', '25, 31, 38, 42, 55', '15', '0', '0', '2024-01-10 03:23:28'),
(21, '', '2, 22, 41, 49, 60', '15', '0', '0', '2024-01-10 03:23:50'),
(22, '', '7, 21, 28, 36, 41', '1', '0', '0', '2024-01-10 03:25:11'),
(23, '', '2, 11, 45, 49, 67', '20', '0', '0', '2024-01-10 03:49:51'),
(24, '', '3, 17, 25, 26, 33', '13', '0', '0', '2024-01-10 04:06:38'),
(25, 'Therdy', '3, 7, 22, 55, 60', '15', '0', '0', '2024-01-10 04:06:39'),
(84, 'therdy boy', '2, 21, 23, 31, 58', '4', '0', '0', '2024-01-10 06:30:01'),
(85, '', '16, 41, 55, 57, 68', '9', '0', '0', '2024-01-10 06:40:46'),
(86, '', '3, 6, 27, 53, 59', '10', '0', '0', '2024-01-10 06:42:06'),
(87, '', '4, 24, 27, 31, 66', '10', '0', '0', '2024-01-10 07:13:26'),
(88, '', '4, 7, 30, 50, 63', '23', '0', '0', '2024-01-10 07:13:27'),
(89, '', '16, 33, 47, 50, 57', '21', '0', '0', '2024-01-10 07:13:29'),
(90, '', '12, 25, 32, 37, 38', '16', '0', '0', '2024-01-10 07:13:30'),
(91, '', '17, 40, 42, 50, 51', '5', '0', '0', '2024-01-10 07:13:31'),
(92, '', '9, 19, 22, 27, 31', '18', '0', '0', '2024-01-10 07:13:32'),
(93, '', '1, 38, 44, 49, 59', '23', '0', '0', '2024-01-10 07:13:33'),
(94, '', '18, 43, 48, 65, 66', '11', '0', '0', '2024-01-10 07:13:34'),
(95, '', '16, 22, 36, 44, 49', '3', '0', '0', '2024-01-10 07:13:36'),
(96, '', '17, 18, 33, 41, 67', '13', '0', '0', '2024-01-10 07:13:38'),
(97, '', '12, 15, 22, 23, 68', '1', '0', '0', '2024-01-10 07:13:39'),
(98, '', '8, 20, 22, 26, 50', '25', '0', '0', '2024-01-10 07:13:40'),
(99, '', '18, 28, 29, 46, 51', '15', '0', '0', '2024-01-10 07:13:42'),
(100, '', '16, 22, 26, 27, 52', '7', '0', '0', '2024-01-10 07:13:44'),
(101, '', '1, 15, 18, 19, 23', '20', '0', '0', '2024-01-10 07:13:45'),
(102, '', '13, 14, 19, 28, 58', '7', '0', '0', '2024-01-10 07:13:47'),
(103, '', '3, 21, 35, 44, 64', '4', '0', '0', '2024-01-10 07:13:48'),
(104, '', '11, 28, 43, 45, 50', '21', '0', '0', '2024-01-10 07:13:49'),
(105, '', '10, 37, 50, 61, 66', '5', '0', '0', '2024-01-10 07:13:50'),
(106, '', '25, 31, 35, 45, 58', '11', '0', '0', '2024-01-10 07:13:51'),
(107, '', '8, 11, 30, 37, 50', '6', '0', '0', '2024-01-10 07:13:52'),
(108, '', '4, 6, 13, 22, 30', '16', '0', '0', '2024-01-10 07:13:53'),
(109, '', '38, 39, 41, 57, 68', '21', '0', '0', '2024-01-10 07:13:54'),
(110, '', '3, 17, 27, 28, 43', '21', '0', '0', '2024-01-10 07:13:55'),
(111, '', '14, 26, 31, 37, 52', '25', '0', '0', '2024-01-10 07:13:57'),
(112, '', '1, 5, 6, 7, 28', '21', '0', '0', '2024-01-10 07:13:59'),
(113, '', '10, 25, 28, 33, 55', '22', '0', '0', '2024-01-10 07:14:01'),
(114, '', '2, 17, 19, 27, 42', '20', '0', '0', '2024-01-10 07:14:03'),
(115, '', '19, 35, 45, 47, 50', '16', '0', '0', '2024-01-10 07:14:05'),
(116, '', '16, 37, 39, 43, 47', '3', '0', '0', '2024-01-10 07:14:11'),
(117, '', '24, 53, 54, 59, 60', '20', '0', '0', '2024-01-10 08:11:13'),
(118, '', '24, 28, 43, 46, 62', '11', '0', '0', '2024-01-10 08:57:33'),
(119, '', '8, 20, 31, 54, 66', '4', '0', '0', '2024-01-10 08:57:35'),
(120, '', '4, 8, 44, 48, 63', '21', '0', '0', '2024-01-10 08:57:35'),
(121, '', '11, 25, 27, 57, 60', '2', '0', '0', '2024-01-10 09:01:09'),
(122, '', '3, 28, 31, 36, 47', '12', '0', '0', '2024-01-11 01:09:23'),
(123, '', '23, 40, 42, 48, 65', '10', '0', '0', '2024-01-11 01:16:28'),
(124, '', '17, 23, 46, 47, 48', '11', '0', '0', '2024-01-11 04:38:43'),
(125, '', '22, 23, 24, 50, 63', '26', '0', '0', '2024-01-11 05:25:33'),
(126, '', '8, 48, 49, 55, 62', '10', '0', '0', '2024-01-11 11:40:45'),
(127, '', '30, 40, 61, 66, 68', '7', '0', '0', '2024-01-12 00:12:26'),
(128, '', '8, 17, 54, 65, 66', '13', '0', '0', '2024-01-12 00:36:23'),
(129, '', '3, 22, 39, 49, 54', '20', '0', '0', '2024-01-12 01:01:29'),
(130, '', '6, 7, 10, 22, 59', '3', '0', '0', '2024-01-12 01:03:26'),
(131, '', '13, 20, 31, 41, 42', '2', '0', '0', '2024-01-12 01:06:56'),
(132, '', '8, 9, 28, 57, 63', '6', '0', '0', '2024-01-12 01:07:36'),
(133, '', '7, 9, 18, 34, 53', '8', '0', '0', '2024-01-12 01:16:38'),
(134, '', '10, 26, 38, 49, 67', '19', '0', '0', '2024-01-12 01:17:40'),
(135, '', '4, 11, 13, 16, 30', '22', '0', '0', '2024-01-12 01:21:16'),
(136, '', '7, 13, 18, 50, 69', '12', '0', '0', '2024-01-12 01:22:45'),
(137, '', '41, 45, 60, 62, 67', '23', '0', '0', '2024-01-12 01:23:07'),
(138, '', '6, 13, 20, 33, 51', '20', '0', '0', '2024-01-12 01:25:24'),
(139, '', '18, 22, 37, 55, 62', '19', '0', '0', '2024-01-12 01:34:43'),
(140, '', '3, 21, 23, 36, 61', '4', '0', '0', '2024-01-12 06:07:48'),
(141, '', '7, 26, 41, 46, 55', '14', '0', '0', '2024-01-13 00:51:30'),
(142, '', '13, 26, 30, 39, 61', '3', '0', '0', '2024-01-13 01:16:12'),
(143, '', '7, 26, 44, 62, 68', '19', '0', '0', '2024-01-13 02:12:23'),
(144, '', '24, 28, 42, 47, 57', '12', '0', '0', '2024-01-15 01:59:06'),
(145, '', '2, 10, 12, 42, 51', '23', '0', '0', '2024-01-15 01:59:17'),
(146, '', '4, 17, 24, 49, 61', '9', '0', '0', '2024-01-15 02:01:16'),
(147, '', '1, 31, 39, 49, 51', '18', '0', '0', '2024-01-15 02:01:47'),
(148, '', '2, 9, 21, 46, 59', '17', '0', '0', '2024-01-15 02:03:05'),
(149, '', '9, 31, 42, 53, 60', '15', '0', '0', '2024-01-15 02:03:41'),
(150, '', '2, 6, 35, 44, 68', '5', '0', '0', '2024-01-15 02:09:52'),
(151, '', '15, 25, 48, 49, 68', '15', '0', '0', '2024-01-15 04:44:40'),
(152, '', '28, 33, 37, 44, 50', '26', '0', '0', '2024-01-15 04:45:22'),
(153, '', '27, 28, 38, 43, 66', '23', '0', '0', '2024-01-15 08:19:21'),
(154, '', '13, 23, 34, 35, 39', '24', '0', '0', '2024-01-15 08:21:50'),
(155, '', '15, 51, 55, 57, 61', '22', '0', '0', '2024-01-15 08:31:01'),
(156, '', '18, 34, 52, 55, 64', '19', '0', '0', '2024-01-15 14:37:49'),
(157, '', '14, 30, 47, 56, 65', '9', '0', '0', '2024-01-15 14:39:05'),
(158, '', '9, 11, 38, 48, 62', '24', '0', '0', '2024-01-15 14:39:47'),
(159, '', '8, 20, 33, 35, 39', '7', '0', '0', '2024-01-15 14:43:16'),
(160, '', '18, 32, 34, 44, 65', '2', '0', '0', '2024-01-16 02:47:35'),
(161, '', '18, 21, 44, 64, 69', '15', '0', '0', '2024-01-16 02:48:32'),
(162, '', '3, 15, 56, 62, 67', '10', '0', '0', '2024-01-16 04:54:51'),
(163, '', '3, 22, 33, 34, 62', '18', '0', '0', '2024-01-16 08:36:42'),
(164, '', '5, 6, 19, 49, 51', '21', '0', '0', '2024-01-16 08:36:50'),
(165, '', '4, 19, 36, 54, 61', '17', '0', '0', '2024-01-17 03:04:37'),
(166, '', '1, 36, 40, 45, 60', '2', '0', '0', '2024-01-17 05:42:01'),
(167, '', '4, 10, 30, 49, 57', '15', '0', '0', '2024-01-17 05:42:02'),
(168, '', '9, 19, 31, 45, 65', '23', '0', '0', '2024-01-17 06:00:15'),
(169, '', '9, 16, 38, 47, 65', '17', '0', '0', '2024-01-17 09:04:11'),
(170, '', '14, 19, 46, 52, 68', '14', '0', '0', '2024-01-18 04:14:39'),
(171, '', '14, 15, 37, 42, 63', '22', '0', '0', '2024-01-18 04:46:56'),
(172, '', '2, 24, 28, 39, 57', '11', '0', '0', '2024-01-18 06:30:16'),
(173, '', '6, 11, 15, 25, 52', '12', '0', '0', '2024-01-18 09:38:36'),
(174, '', '5, 17, 34, 48, 61', '25', '0', '0', '2024-01-18 09:38:38'),
(175, '', '9, 27, 33, 50, 62', '17', '0', '0', '2024-01-18 09:38:46'),
(176, '', '7, 12, 15, 36, 63', '5', '0', '0', '2024-01-18 09:38:48'),
(177, '', '6, 14, 19, 36, 43', '22', '0', '0', '2024-01-18 09:39:53'),
(178, '', '3, 24, 29, 38, 51', '4', '0', '0', '2024-01-18 09:39:55'),
(179, '', '21, 25, 34, 53, 59', '9', '0', '0', '2024-01-18 09:39:57'),
(180, '', '4, 14, 31, 35, 42', '24', '0', '0', '2024-01-18 09:39:59'),
(181, '', '4, 31, 38, 59, 65', '23', '0', '0', '2024-01-18 09:40:00'),
(182, '', '2, 3, 42, 47, 55', '7', '0', '0', '2024-01-18 09:40:01'),
(183, '', '7, 20, 35, 49, 54', '21', '0', '0', '2024-01-18 09:40:02'),
(184, '', '27, 30, 38, 49, 63', '3', '0', '0', '2024-01-18 09:40:03'),
(185, '', '5, 9, 44, 54, 59', '25', '0', '0', '2024-01-18 09:40:05'),
(186, '', '13, 14, 30, 39, 40', '7', '0', '0', '2024-01-18 09:40:06'),
(187, '', '2, 38, 39, 47, 69', '26', '0', '0', '2024-01-18 09:40:07'),
(188, '', '12, 17, 22, 23, 49', '14', '0', '0', '2024-01-18 09:40:09'),
(189, '', '19, 32, 34, 36, 51', '1', '0', '0', '2024-01-18 09:40:11'),
(190, '', '21, 30, 44, 55, 56', '3', '0', '0', '2024-01-18 09:40:13'),
(191, '', '6, 42, 50, 63, 68', '8', '0', '0', '2024-01-18 09:40:15'),
(192, '', '7, 20, 55, 64, 69', '10', '0', '0', '2024-01-18 09:40:17'),
(193, '', '3, 23, 39, 57, 66', '16', '0', '0', '2024-01-18 09:40:19'),
(194, '', '10, 13, 37, 58, 65', '11', '0', '0', '2024-01-18 09:40:21'),
(195, '', '15, 31, 42, 57, 66', '11', '0', '0', '2024-01-18 09:40:23'),
(196, '', '5, 6, 51, 53, 57', '2', '0', '0', '2024-01-18 09:40:25'),
(197, '', '11, 27, 53, 59, 66', '7', '0', '0', '2024-01-18 09:40:33'),
(198, '', '17, 25, 26, 28, 60', '24', '0', '0', '2024-01-18 09:42:22'),
(199, '', '17, 19, 27, 55, 56', '17', '0', '0', '2024-01-18 09:43:10'),
(200, '', '36, 38, 44, 48, 61', '1', '0', '0', '2024-01-18 09:45:13'),
(201, '', '8, 37, 47, 57, 60', '12', '0', '0', '2024-01-18 09:45:31'),
(202, '', '2, 19, 22, 30, 46', '21', '0', '0', '2024-01-18 10:06:12'),
(203, '', '11, 15, 17, 51, 66', '13', '0', '0', '2024-01-18 10:06:26'),
(204, '', '21, 30, 39, 55, 63', '25', '0', '0', '2024-01-18 10:10:14'),
(205, '', '8, 13, 37, 38, 68', '2', '0', '0', '2024-01-18 10:10:52'),
(206, '', '19, 28, 31, 56, 63', '16', '0', '0', '2024-01-18 10:14:43'),
(207, '', '4, 14, 20, 24, 28', '24', '0', '0', '2024-01-19 03:39:01'),
(208, '', '17, 19, 32, 34, 45', '8', '0', '0', '2024-01-19 03:40:25'),
(209, '', '4, 6, 14, 26, 39', '6', '0', '0', '2024-01-19 03:41:41'),
(210, '', '13, 18, 31, 42, 51', '1', '0', '0', '2024-01-19 04:00:55'),
(211, '', '7, 32, 41, 54, 64', '26', '0', '0', '2024-01-19 04:01:51'),
(212, '', '44, 46, 48, 54, 67', '17', '0', '0', '2024-01-19 04:10:56'),
(213, '', '37, 42, 61, 64, 69', '15', '0', '0', '2024-01-19 04:15:48'),
(214, '', '12, 19, 23, 56, 67', '23', '0', '0', '2024-01-19 04:39:52'),
(215, '', '3, 4, 6, 32, 63', '6', '0', '0', '2024-01-19 04:40:02'),
(216, '', '13, 28, 32, 33, 60', '15', '0', '0', '2024-01-19 04:41:04'),
(217, '', '15, 30, 54, 60, 69', '4', '0', '0', '2024-01-19 04:42:31'),
(218, '', '19, 32, 37, 43, 53', '16', '0', '0', '2024-01-19 06:50:10'),
(219, '', '13, 29, 52, 54, 66', '3', '0', '0', '2024-01-19 07:30:32'),
(220, '', '9, 18, 26, 36, 53', '24', '0', '0', '2024-01-19 07:34:20'),
(221, '', '5, 19, 35, 49, 55', '11', '0', '0', '2024-01-19 07:35:08'),
(222, '', '1, 4, 48, 57, 62', '20', '0', '0', '2024-01-19 07:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `date_chat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `keyword`, `response`, `date_chat`) VALUES
(1, 'hello', 'Hi there! How can I help you today?', '2024-05-21 16:12:28'),
(2, 'bye', 'Goodbye! Have a great day!', '2024-05-21 16:12:28'),
(5, 'how are you', 'I am just a bot, but I am functioning as expected.', '2024-05-21 16:12:54'),
(6, 'hi', 'Hello there! How can I help you today?', '2024-05-21 18:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_recom`
--

CREATE TABLE `tb_recom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `referrer_id` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition`
--

CREATE TABLE `terms_condition` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_condition`
--

INSERT INTO `terms_condition` (`id`, `content`, `date_create`) VALUES
(1, '<p><font face=\"Verdana\">※ 번호는 수동번호를 직접 선택하거나 빠른 \"자동\"을 이용할 수 있습니다.</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 구매 시 구매 취소 불가하니 신중하게 구매 부탁드립니다.&nbsp;</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 구매한 내역은 구매내역에서 확인하실 수 있습니다</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 구매가능시간은 12:00~22:00 까지 가능합니다</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 당첨자 추첨은 매일 밤 오늘 24:00 에발표합니다</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 룰 의 자세한 사항은 공지사항 페이지를 참고하세요.</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 당첨의 자세한 사항은 당첨자게시판 확인하세요.</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 1회 구매 시 1회 구매 금액은 50,000원입니다</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 구매 시 보유 포인트에서 50,000원 바로 차감 됩니다</font></p><p><font face=\"Verdana\"><br></font></p><p><font face=\"Verdana\">※ 참여하신 50,000원에서 30%의 수수료를 제외한 70%는 상금으로 자동 적립됩니다</font></p>', '2024-03-23 17:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `bod` varchar(11) NOT NULL,
  `credit` int(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_acct_num` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referal_code` varchar(255) NOT NULL,
  `affiliated_agent_code` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` int(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `is_ban` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=not,1=banned',
  `memo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `userid`, `bod`, `credit`, `bank_name`, `bank_acct_num`, `password`, `referal_code`, `affiliated_agent_code`, `percentage`, `verify_token`, `verify_status`, `is_ban`, `memo`, `created_at`) VALUES
(7, 'Lee Yangsik', '09655888208', 'geronimo.t0324@gmail.com', 'lee_123', '2024-04-18', 19900000, '농협은행', 1234567890, '$2y$10$usqHJsouUc2XgAjjDSiUB.YUegF3mqWHEdZ.io8qXFzTZbdv/819q', 'A24DDAF0', '99369F91', '0.10', 'm6d6c5hrk0j3lfe8v1bsuint29', 1, 0, '<p>sample tesga</p>', '2024-02-07 04:33:48'),
(10, 'Mae Geronimo', '09356524415', '', 'mae@1234567890', '2024-02-08', 2177500, 'Bank 1', 123, '$2y$10$cB7VTrn/mVXAH2TBEIu7kujZn1nZlPoHw87OG6Cy83OuoQbmQzomm', 'AF8810F6', '', '', '3ee86efb4e417d282918b8066a2ab04a', 1, 0, '', '2024-02-07 17:38:18'),
(12, '이주성', '01021542121', '', 'eirfkc23', '1977-01-03', 8650000, 'Bank 1', 2147483647, '$2y$10$0ulwKfAiS2arPKpn9rpTXeLePNB75jd7.J.mZDO524lBNIyNqq14S', 'AF8810F6', '', '', 'cdd21395bce1a9138f80e5a9d8a3e60c', 1, 0, '', '2024-02-16 11:27:44'),
(13, '김하운', '01012341234', '', 'ffsd123', '1990-01-03', 900000, 'Bank 1', 2147483647, '$2y$10$w/E.c5b/.tZh4EJVowbG2e2jn.8asnapBEaWleJflcbILX6bOojm.', '', '', '', '5de13776641d86d3725c860f889ee449', 1, 0, '', '2024-02-19 10:14:54'),
(14, '오규성', '0107533692222', '', 'dkjxo1011', '1971-06-08', 4650000, 'Bank 1', 41654646, '$2y$10$SPTNaFUs/ZVHOVBJ/ZBpE.1pYhCUcReJx1J6C/LPSrEewEqSXp..i', '', '', '', 'e3f2959471e7e00cdf4b3c42a58fa808', 1, 0, '', '2024-02-24 14:41:17'),
(15, '최시연', '01032165434645', '', 'cldsuj3', '1990-09-09', 9600000, 'Bank 1', 5464312, '$2y$10$ohX6OQqYs9mGy7spzuKtkOeWE78b3gCHPVbrRpYIr12KzRvwQwU3i', '99369F91', '', '', 'e748864a15257ff58cbacc844f647651', 1, 0, '', '2024-02-26 06:06:45'),
(60, 'wqeqwe ', '09655888208', '', 'qweqwe', '2024-05-02', 9540000, '광주은행', 1234567890, '$2y$10$He6rkJymAOy1HSSL3mGf7uIS5Z3rb8JXaEK2VP02eFKwsnZtpk/PS', '99369F91', '', '', '0cad395e8bfadfb8e48fe0ccbc996d62', 1, 0, 'asdasd', '2024-05-07 10:11:20'),
(61, 'assaasd', '09655888208', 'geronimo.t0324@gmail.com', 'aaaaa', '2024-05-08', 899350000, '농협은행', 1234567890, '$2y$10$1pgOMPTGglrGiIjAgnHjFObyPmag4QiNef5mtj3RVxbAaQqvaUJ3m', '80F9F8B6', '', '', '98aff64688339483eaec881f82e45449', 1, 0, '<p>asdasd asd a</p>', '2024-05-10 05:19:00'),
(62, 'dddddd ddddd', '09655888208', 'r.geronimo07@hotmail.com', 'ddddd', '2024-05-08', 0, '국민은행', 1234567890, '$2y$10$/8EsLvc3ZziP2E.RK7/QWurhYRamIqs7lvIahRvKyBY5uSzCj8To6', '80F9F8B6', '', '', '64c07735f7776e17350eeb57a2422837', 1, 0, '<p>asdsad asdasdasdasd asdasd </p>', '2024-05-10 09:49:48'),
(66, 'qqq qqqqqq', '09655888208', '', 'qqqqqq', '2024-04-28', 9850000, '농협은행', 1234567890, '$2y$10$3FLN5NCjkUjr7yIskDHdge.aIBYg0lfQMIZYHGQXW5D4fA4RcKx/C', 'AF8810F6', '99369F91', '', 'e4542ad07fdf18cbac34845304932e22', 1, 0, '', '2024-05-16 03:31:45'),
(67, 'ssssss', '09655888208', '', 'ssssss', '2024-04-29', 0, '농협은행', 1234567890, '$2y$10$djKtx.vPoQ4HtKFfsn8fGezNldobbYC6eWCzZ6xKNSwTfLE5uIalq', '', '', '', 'fed72358958b55f21b2593b560ab6ffd', 1, 0, '', '2024-05-16 03:48:18'),
(68, 'bbb bbbb', '09655888208', '', 'bbbbbb', '2024-04-28', 899800000, '농협은행', 1234567890, '$2y$10$SB3RVXdJZQByulypfN1veuFCCtjeRSp.jKl0xjpgByvbD7kt8WKJa', '99369F91', '99369F91', '', '84afaaa8b8e2317fb5f3a2275e722555', 1, 0, '', '2024-05-16 04:50:56'),
(69, 'ccc cccccc', '09655888208', '', 'ccccccc', '2024-04-28', 0, '농협은행', 1234567890, '$2y$10$06cLu5vZiknEhEZi/37wCOlzBWFFHiGogaeUtj1.b0LlcVp11b11K', '47948228', '80F9F8B6', '', '746fa9e2cda6189cd16fa169d37e774f', 1, 0, '', '2024-05-16 05:05:06'),
(70, 'super@123', '09655888208', '', 'super@123', '2024-04-29', 899900000, '농협은행', 1234567890, '$2y$10$kQGUiNkk3cfLMPlV9JhJNOfozVY7td1KsXNrayjWZ61cHGnXlvoaK', '60AF54FD', '99369F91', '', 'bfa1aaabd2d3fc99f3301d31e770727a', 1, 1, '', '2024-05-16 06:55:25'),
(71, 'eeee eee', '09655888208', '', 'eeeeee', '2024-04-29', 89900000, '부산은행', 1234567890, '$2y$10$ZKUZLLp69PiL6nncnDIRq.AdtLwK6bbfokX6J9VvqphhzeDEgUM/C', '60AF54FD', '99369F91', '', '6baad0f867c4b077549cad2fb04b3957', 1, 1, '', '2024-05-16 08:32:47'),
(73, 'xxx xxxxx', '09655888208', '', 'xxxxxx', '1987-03-22', 750000, '광주은행', 1234567890, '$2y$10$PcWqgQs4RZQUTqEEIz0NSuZsevaMOXCH/OYlOLwR6TjSGYDx2K8c2', '99369F91', '99369F91', '', '4jmvps03vt5868oihvsu5gbh7l', 1, 0, '<p>asd</p>', '2024-05-22 01:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_cancelled`
--

CREATE TABLE `users_cancelled` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `bod` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_acct_num` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referal_code` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` varchar(255) NOT NULL DEFAULT '0',
  `is_ban` tinyint(2) NOT NULL DEFAULT 0,
  `date_cancelled` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_cancelled`
--

INSERT INTO `users_cancelled` (`id`, `name`, `phone`, `userid`, `bod`, `credit`, `bank_name`, `bank_acct_num`, `password`, `referal_code`, `verify_token`, `verify_status`, `is_ban`, `date_cancelled`) VALUES
(1, 'asdasd', '09655888208', 'asdasd', '2024-04-08', '', '국민은행', '1234567890', '$2y$10$7k6tZ6qXxi6WjxCw3ripR.91lVkZLqUM1l4Hr/s4rLRSsUFJyktcS', '', 'adb99ccf35ea00088c98bc38bd5ee0aa', '0', 0, '2024-04-22 14:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `users_request`
--

CREATE TABLE `users_request` (
  `req_id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 0 COMMENT '0=visible,1=hide',
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_request`
--

INSERT INTO `users_request` (`req_id`, `userid`, `name`, `user_id`, `message`, `status`, `hide`, `date_message`) VALUES
(1, '', 'Lee Yangsik', '7', '10,000', '입금처리완료', 1, '2024-04-08 11:18:59'),
(2, '', 'Lee Yangsik', '7', '20,000', '입금처리완료', 1, '2024-04-08 11:23:42'),
(3, '', 'Lee Yangsik', '7', '20,000', '입금처리완료', 1, '2024-04-08 11:26:26'),
(4, '', 'Lee Yangsik', '7', '10,000', '입금처리완료', 1, '2024-04-08 11:29:36'),
(5, '', 'Lee Yangsik', '7', '100,000', '입금처리완료', 1, '2024-04-08 11:32:56'),
(6, '', 'Lee Yangsik', '7', '100,000', '입금처리완료', 1, '2024-04-08 11:38:00'),
(7, '', 'Lee Yangsik', '7', '100,000', '입금 요청이 취소되었습니다!', 1, '2024-04-08 11:42:56'),
(8, '', 'Lee Yangsik', '7', '1,000,000', '입금처리완료', 1, '2024-04-08 12:25:24'),
(9, '', 'Lee Yangsik', '7', '100,000', '입금처리완료', 1, '2024-04-08 18:07:04'),
(10, '', 'therd Geronimo', '21', '100,000', '입금처리완료', 0, '2024-04-15 11:08:31'),
(11, '', 'therd Geronimo', '21', '20,000', '입금처리완료', 0, '2024-04-15 11:09:30'),
(12, '', 'Lee Yangsik', '7', '100,000', '입금처리완료', 0, '2024-04-22 10:36:46'),
(13, '', 'asdasd', '57', '100,000', '입금처리완료', 0, '2024-04-22 14:11:06'),
(14, 'lee_123', 'Lee Yangsik', '7', '100,000', '답변대기', 0, '2024-04-22 16:49:26'),
(15, 'lee_123', 'Lee Yangsik', '7', '10,000', '입금처리완료', 0, '2024-04-22 17:01:28'),
(16, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금 요청이 취소되었습니다!', 0, '2024-04-22 17:03:27'),
(17, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금처리완료', 0, '2024-04-23 11:05:48'),
(18, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금처리완료', 0, '2024-04-23 11:14:08'),
(19, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금처리완료', 0, '2024-04-23 11:18:02'),
(20, 'qweqwe', 'wqeqwe', '60', '100,000', '입금처리완료', 0, '2024-05-07 19:52:46'),
(21, 'mae@123', 'Mae Geronimo', '10', '100,000', '입금처리완료', 0, '2024-05-08 12:57:22'),
(22, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '답변대기', 0, '2024-05-11 12:57:56'),
(23, 'lee_123', 'Lee Yangsik', '7', '100,000', '입금처리완료', 0, '2024-05-11 12:59:20'),
(24, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '입금처리완료', 0, '2024-05-11 13:05:09'),
(25, 'lee_123', 'Lee Yangsik', '7', '1,000,000', '입금처리완료', 0, '2024-05-21 11:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `users_request_deposit`
--

CREATE TABLE `users_request_deposit` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_withdrawal`
--

CREATE TABLE `users_withdrawal` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount_withdrawal` varchar(255) NOT NULL DEFAULT '0',
  `bank_name` varchar(100) NOT NULL,
  `bank_acct_num` int(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_withdrawal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_withdrawal`
--

INSERT INTO `users_withdrawal` (`id`, `userid`, `name`, `user_id`, `amount_withdrawal`, `bank_name`, `bank_acct_num`, `status`, `date_withdrawal`) VALUES
(4, 'lee_123', '', '7', '50000', 'Bank 2', 1234567890, '출금완료', '2024-04-08 17:31:43'),
(5, 'lee_123', '', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-08 17:39:23'),
(6, 'lee_123', '', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-08 17:42:23'),
(7, 'lee_123', '', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-09 16:47:49'),
(8, 'test123', '', '21', '15000', '국민은행', 1234567890, '출금완료', '2024-04-15 12:09:31'),
(9, '', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 10:52:30'),
(10, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 11:00:13'),
(11, '', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 11:00:22'),
(12, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 11:04:12'),
(13, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 11:16:57'),
(14, 'lee_123', 'Lee Yangsik', '7', '50000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 11:17:45'),
(15, 'lee_123', 'Lee Yangsik', '7', '50000', 'Bank 2', 1234567890, '출금완료', '2024-04-23 18:09:41'),
(16, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-24 14:42:51'),
(17, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-04-24 14:44:35'),
(18, 'lee_123', 'Lee Yangsik', '7', '20000', 'Bank 2', 1234567890, '출금완료', '2024-05-01 19:14:34'),
(19, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-05-06 14:41:02'),
(20, 'lee_123', 'Lee Yangsik', '7', '10000', 'Bank 2', 1234567890, '출금완료', '2024-05-06 14:41:09'),
(21, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:42:31'),
(22, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:42:39'),
(23, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:42:48'),
(24, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:42:55'),
(25, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:13'),
(26, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:20'),
(27, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:28'),
(28, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:36'),
(29, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:44'),
(30, 'mae@123', 'Mae Geronimo', '10', '10000', 'Bank 1', 123, '출금완료', '2024-05-06 14:50:51'),
(33, 'lee_123', 'Lee Yangsik', '7', '50000', '농협은행', 1234567890, '출금완료', '2024-05-18 12:21:03'),
(34, 'lee_123', 'Lee Yangsik', '7', '1000000', '농협은행', 1234567890, '출금완료', '2024-05-21 11:56:04'),
(35, 'lee_123', 'Lee Yangsik', '7', '1000000', '농협은행', 1234567890, '출금완료', '2024-05-21 12:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_purchases`
--

CREATE TABLE `user_purchases` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `selected_numbers` varchar(100) NOT NULL,
  `powerballs` varchar(100) NOT NULL DEFAULT '0',
  `payment` varchar(100) NOT NULL,
  `winning_amount` varchar(255) NOT NULL DEFAULT '0',
  `to_received` int(100) NOT NULL DEFAULT 0,
  `winning_match_numbers` varchar(100) NOT NULL DEFAULT '0',
  `powerball_match` varchar(100) NOT NULL DEFAULT '0',
  `is_ban` int(11) NOT NULL DEFAULT 0 COMMENT '0=not,1=banned',
  `marked` varchar(100) NOT NULL DEFAULT '1' COMMENT '0=mark, 1=not',
  `modes` varchar(255) NOT NULL,
  `purchase_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=active, 1=cancel',
  `referal_code` varchar(255) NOT NULL,
  `affiliated_agent_code` varchar(255) NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 1 COMMENT '0=visible, 1=hide',
  `date_purchase` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_purchases`
--

INSERT INTO `user_purchases` (`id`, `user_name`, `username`, `user_id`, `selected_numbers`, `powerballs`, `payment`, `winning_amount`, `to_received`, `winning_match_numbers`, `powerball_match`, `is_ban`, `marked`, `modes`, `purchase_status`, `referal_code`, `affiliated_agent_code`, `hide`, `date_purchase`) VALUES
(52, '', 'Lee Yangsik', '7', '18, 24, 28, 12, 26', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 07:32:10'),
(53, '', 'Lee Yangsik', '7', '9, 19, 24, 25, 5', '10', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 07:38:51'),
(54, '', 'Lee Yangsik', '7', '8, 9, 10, 11, 12', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 07:40:04'),
(55, '', 'Lee Yangsik', '7', '23, 24, 26, 8, 20', '16', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 07:41:16'),
(56, '', '이주성', '12', '6, 10, 25, 13, 20', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 08:03:39'),
(57, '', '이주성', '12', '17, 11, 8, 3, 25', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 08:09:56'),
(58, '', '이주성', '12', '5, 13, 20, 25, 27', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 08:10:36'),
(59, '', '이주성', '12', '3, 7, 11, 24, 26', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 08:10:58'),
(60, '', '이주성', '12', '17, 2, 9, 22, 11', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 08:11:17'),
(61, '', 'Mae Geronimo', '10', '8, 13, 26, 14, 18', '15', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 09:01:40'),
(62, '', '김민국', '9', '6, 22, 12, 26, 4', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 09:30:04'),
(63, '', '김민국', '9', '25, 9, 7, 14, 13', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 09:39:12'),
(64, '', '김민국', '9', '8, 14, 25, 11, 18', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-19 09:39:56'),
(65, '', '김민국', '9', '14, 3, 22, 23, 15', '17', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 09:48:00'),
(66, '', '김하운', '13', '12, 9, 20, 27, 4', '21', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-19 10:17:18'),
(67, '', '김하운', '13', '6, 11, 22, 3, 1', '23', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 00:06:24'),
(68, '', 'Lee Yangsik', '7', '13,14,15,28,27', '12', '50000', '35000', 227500, '13, 14, 15', '12', 0, '0', 'Manual', 0, '', '', 1, '2024-02-20 07:07:02'),
(69, '', 'Lee Yangsik', '7', '14,4,13,15,16', '8', '50000', '35000', 227500, '14, 13, 15, 16', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-02-20 08:00:29'),
(70, '', '김하운', '13', '3,9,12,22,27', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-20 09:15:20'),
(71, '', '김하운', '13', '9, 23, 18, 27, 17', '15', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:16:05'),
(72, '', '김하운', '13', '14, 3, 11, 5, 20', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:16:16'),
(73, '', '김민국', '9', '18, 2, 16, 5, 8', '24', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:17:00'),
(74, '', '김민국', '9', '3, 8, 27, 16, 26', '25', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:17:09'),
(75, '', '김민국', '9', '15, 10, 6, 28, 20', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:17:17'),
(76, '', '김민국', '9', '17,6,11,25,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-20 09:18:02'),
(77, '', 'Lee Yangsik', '77', '12 13 14 15 16 12', '15', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 09:30:35'),
(78, '', '이주성', '12', '21, 12, 5, 25, 14', '18', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-20 10:52:52'),
(79, '', 'Lee Yangsik', '7', '3,8,11,16,22', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-20 12:17:50'),
(80, '', '김하운', '13', '26,25,22,2,4', '7', '50000', '35000', 0, '', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-21 05:27:54'),
(81, '', 'Lee Yangsik', '7', '19, 15, 1, 27, 10', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-21 11:32:41'),
(82, '', 'Lee Yangsik', '7', '24,25,26,27,28', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-21 11:32:58'),
(83, '', '김민국', '9', '3,10,20,23,26', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-22 08:03:16'),
(84, '', '김민국', '9', '2,4,7,10,13', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-22 08:03:49'),
(85, '', '김민국', '9', '12,13,14,15,16', '12', '50000', '35000', 93333, '12, 13, 14, 15, 16', '12', 0, '0', 'Automatic', 0, '', '', 1, '2024-02-22 08:07:38'),
(86, '', '김민국', '9', '14,6,20,23,17', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-22 08:31:13'),
(87, '', '김하운', '13', '12,13,14,15,16', '12', '50000', '35000', 93333, '12, 13, 14, 15, 16', '12', 0, '0', 'Manual', 0, '', '', 1, '2024-02-22 08:33:38'),
(88, '', '이주성', '12', '12,13,14,15,1', '12', '50000', '35000', 93333, '12, 13, 14, 15', '12', 0, '0', 'Manual', 0, '', '', 1, '2024-02-22 08:36:40'),
(89, '', '이주성', '12', '3,9,25,13,28', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-22 08:56:58'),
(90, '', 'Lee Yangsik', '7', '11, 10, 12, 19, 5', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-22 11:12:44'),
(91, '', '이주성', '12', '3,7,9,20,23', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-23 05:15:34'),
(92, '', '이주성', '12', '2,5,8,13,17', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-23 05:23:24'),
(93, '', '이주성', '12', '7,11,20,24,', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-23 05:39:22'),
(94, '', '이주성', '12', '2,6,8,16,24', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-23 06:21:26'),
(95, '', '김민국', '9', '9,13,22,27,25', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-23 10:53:00'),
(96, '', '김민국', '9', '6,15,9,2,14', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-24 06:16:14'),
(97, '', '김민국', '9', '2,5,19,21,22', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-24 14:38:41'),
(98, '', '오규성', '14', '13,7,4,6,5', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-24 14:43:36'),
(99, '', '오규성', '14', '5,12,24,26,27', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-24 14:43:54'),
(100, '', '오규성', '14', '5,8,10,23,27', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-24 14:44:14'),
(101, '', '오규성', '14', '3,6,26,25,11', '6', '50000', '35000', 210000, '6, 26', '0', 0, '0', 'Manual', 0, '', '', 1, '2024-02-24 14:44:37'),
(102, '', 'Lee Yangsik', '7', '7, 28, 19, 16, 8', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 01:41:19'),
(103, '', '오규성', '14', '7,10,28,26,19', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:17:38'),
(104, '', '오규성', '14', '17, 6, 8, 27, 10', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:18:29'),
(105, '', '김민국', '9', '12, 15, 26, 6, 2', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:19:13'),
(106, '', '김민국', '9', '6,9,10,28,26', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:19:50'),
(107, '', '김민국', '9', '25, 20, 9, 12, 3', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:20:02'),
(108, '', '이주성', '12', '1, 11, 3, 21, 8', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:20:47'),
(109, '', '이주성', '12', '19, 28, 16, 8, 23', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:21:03'),
(110, '', '김하운', '13', '18, 17, 14, 27, 8', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:21:47'),
(111, '', '김하운', '13', '19, 17, 11, 13, 25', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:22:02'),
(112, '', '김하운', '13', '20, 13, 21, 1, 27', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:22:22'),
(113, '', '김하운', '13', '1, 22, 17, 5, 11', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:23:31'),
(114, '', '김하운', '13', '13, 25, 10, 1, 26', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:23:41'),
(115, '', '김하운', '13', '25, 14, 19, 3, 21', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:23:47'),
(116, '', '김하운', '13', '16, 3, 21, 11, 24', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:23:54'),
(117, '', '김하운', '13', '27, 24, 1, 7, 15', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:24:04'),
(118, '', '김하운', '13', '5, 27, 8, 16, 21', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:29:16'),
(119, '', '김하운', '13', '3, 4, 21, 15, 18', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:29:46'),
(120, '', '김하운', '13', '24, 10, 23, 16, 19', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:30:03'),
(121, '', '김하운', '13', '7, 5, 18, 20, 21', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:30:14'),
(122, '', '김하운', '13', '27, 22, 3, 18, 20', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:30:35'),
(123, '', '김하운', '13', '3,6,7,23,27', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:31:02'),
(124, '', '김하운', '13', '5, 9, 6, 27, 15', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:31:35'),
(125, '', '김하운', '13', '6,11,22,26,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:31:53'),
(126, '', '김하운', '13', '6,9,22,25,13', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:32:11'),
(127, '', '김하운', '13', '9, 19, 20, 13, 8', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:32:24'),
(128, '', '김하운', '13', '22, 9, 17, 18, 10', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:32:36'),
(129, '', '김하운', '13', '18, 17, 11, 25, 21', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:39:05'),
(130, '', '김하운', '13', '13, 9, 27, 25, 21', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:39:19'),
(131, '', '김하운', '13', '9,13,12,27,20', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:39:36'),
(132, '', '김하운', '13', '4,6,12,15,18', '8', '50000', '35000', 0, '12, 18', '8', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 05:40:02'),
(133, '', '김하운', '13', '12, 16, 1, 25, 2', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 05:44:23'),
(134, '', '김하운', '13', '1,3,5,20,21', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 06:04:38'),
(135, '', '최시연', '15', '7, 6, 10, 13, 22', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 06:07:50'),
(136, '', '김유진', '16', '16,20,21,27,28', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 06:19:19'),
(137, '', '최순자', '17', '2,7,11,23,24', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 06:27:52'),
(138, '', '최순자', '17', '14, 21, 3, 13, 22', '8', '50000', '35000', 262500, '14', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-02-26 06:28:14'),
(139, '', '최순자', '17', '13, 4, 1, 20, 6', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 06:28:48'),
(140, '', '최순자', '17', '25, 28, 4, 13, 9', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 06:34:28'),
(141, '', '김윤호', '18', '4, 2, 22, 12, 14', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 07:09:55'),
(142, '', '최윤아', '19', '10,14,24,26,27', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-26 07:25:01'),
(143, '', '최윤아', '19', '5, 2, 23, 6, 7', '21', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 09:15:41'),
(144, '', '최윤아', '19', '26, 9, 8, 15, 21', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 09:15:56'),
(145, '', '김아영', '20', '28, 23, 4, 17, 22', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-26 09:35:52'),
(146, '', 'Lee Yangsik', '7', '7,12,14,26,27', '8', '50000', '35000', 787500, '7, 12, 14', '8', 0, '0', 'Manual', 0, '', '', 1, '2024-02-26 09:50:39'),
(147, '', 'Lee Yangsik', '7', '6,7,25,28,14', '8', '50000', '35000', 175000, '7, 25', '8', 0, '0', 'Manual', 0, '', '', 1, '2024-02-27 04:36:01'),
(148, '', 'Lee Yangsik', '7', '1,2,20,22,26', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-27 04:38:19'),
(149, '', '김아영', '20', '4, 18, 13, 6, 22', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-27 06:29:11'),
(150, '', '김아영', '20', '10, 12, 17, 18, 28', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-27 06:32:04'),
(151, '', '김아영', '20', '19, 26, 1, 13, 28', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-27 06:32:18'),
(152, '', '김하운', '13', '12, 2, 1, 24, 28', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-27 09:39:00'),
(153, '', '김민국', '9', '3,7,12,23,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-27 09:44:49'),
(154, '', '김민국', '9', '8, 13, 6, 17, 23', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-27 09:49:24'),
(155, '', 'Lee Yangsik', '7', '5,7,22,23,24', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 01:56:23'),
(156, '', 'Lee Yangsik', '7', '21, 13, 28, 4, 7', '22', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 05:32:02'),
(157, '', '김민국', '9', '2,5,8,11,20', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 06:41:56'),
(158, '', '김민국', '9', '25, 3, 18, 27, 19', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 06:43:46'),
(159, '', '김민국', '9', '21, 24, 18, 10, 3', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:06:36'),
(160, '', 'Mae Geronimo', '10', '25, 7, 26, 22, 16', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:19:47'),
(161, '', 'Mae Geronimo', '10', '6, 21, 15, 4, 14', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:21:21'),
(162, '', 'Mae Geronimo', '10', '8,9,10,14,28', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 07:21:43'),
(163, '', 'Mae Geronimo', '10', '4, 2, 8, 26, 21', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:23:13'),
(164, '', 'Lee Yangsik', '7', '12, 7, 5, 16, 6', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:23:52'),
(165, '', 'Lee Yangsik', '7', '1, 12, 7, 27, 16', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:24:02'),
(166, '', 'Lee Yangsik', '7', '1, 26, 24, 4, 7', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 07:36:04'),
(167, '', '김민국', '9', '2, 6, 19, 14, 8', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 09:21:47'),
(168, '', '김민국', '9', '17, 15, 24, 2, 28', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 09:22:34'),
(169, '', '김민국', '9', '2,10,21,25,7', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 09:26:00'),
(170, '', 'Lee Yangsik', '7', '2,3,18,19,21', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 09:29:53'),
(171, '', '김민국', '9', '4, 22, 23, 19, 16', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 09:30:22'),
(172, '', '김민국', '9', '3,9,22,27,14', '2', '50000', '35000', 700000, '3, 9, 14', '2', 0, '0', 'Manual', 0, '', '', 1, '2024-02-28 09:31:16'),
(173, '', '김민국', '9', '10, 26, 23, 2, 6', '2', '50000', '35000', 0, '', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-28 10:09:22'),
(174, '', '김민국', '9', '1,13,25,11,20', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-02-28 10:09:55'),
(175, '', 'Lee Yangsik', '7', '26, 23, 12, 28, 16', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-29 04:51:49'),
(176, '', '김민국', '9', '20, 22, 9, 10, 13', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-02-29 06:00:27'),
(177, '', '김민국', '9', '5, 10, 22, 4, 6', '5', '50000', '35000', 105000, '', '5', 0, '0', 'Automatic', 0, '', '', 1, '2024-02-29 09:21:39'),
(178, '', 'Lee Yangsik', '7', '28,24,6,14,7', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 01:49:29'),
(179, '', 'Lee Yangsik', '7', '3, 18, 20, 7, 4', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 04:20:42'),
(180, '', '김민국', '9', '26, 2, 15, 24, 9', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 05:30:26'),
(181, '', '김민국', '9', '2,6,11,18,24', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 05:30:42'),
(182, '', '김하운', '13', '13, 10, 9, 7, 5', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 05:31:16'),
(183, '', '김하운', '13', '3,11,14,22,23', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 05:31:33'),
(184, '', '김하운', '13', '24, 26, 14, 19, 22', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 05:31:40'),
(185, '', '김하운', '13', '1,5,6,7,25', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 05:32:02'),
(186, '', '김하운', '13', '3,11,25,28,7', '5', '50000', '35000', 0, '0', '0', 0, '0', 'Manual', 0, '', '', 1, '2024-03-01 05:37:44'),
(187, '', 'Mae Geronimo', '10', '3,6,10,28,23', '5', '50000', '35000', 192500, '3, 6, 10', '5', 0, '0', 'Manual', 0, '', '', 1, '2024-03-01 07:54:26'),
(188, '', 'Mae Geronimo', '10', '4,5,8,24,25', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 09:40:20'),
(189, '', '김하운', '13', '22, 14, 17, 27, 25', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 11:22:14'),
(190, '', '김하운', '13', '21,28,14,9,5', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 11:22:54'),
(191, '', '김하운', '13', '28,7,12,20,26', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 11:23:42'),
(192, '', '김하운', '13', '26, 1, 13, 6, 27', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 11:25:41'),
(193, '', '김하운', '13', '12, 9, 23, 14, 24', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 16:34:41'),
(194, '', '김하운', '13', '23, 24, 4, 3, 8', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-01 16:34:54'),
(195, '', '김민국', '9', '3,7,11,14,20', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-01 16:35:29'),
(197, '', 'Mae Geronimo', '10', '24,14,13,9,4', '6', '50000', '35000', 735000, '24, 14, 4', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-02 12:31:30'),
(198, '', 'Mae Geronimo', '10', '4,5,6,21,22', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 12:31:51'),
(199, '', 'Lee Yangsik', '7', '28,12,26,4,16', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 12:32:56'),
(200, '', 'Lee Yangsik', '7', '4,5,21,22,23', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 12:33:19'),
(201, '', 'Lee Yangsik', '7', '7,27,22,14,26', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 13:00:13'),
(202, '', 'Lee Yangsik', '7', '2,5,4,7,27', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 13:04:04'),
(203, '', 'Lee Yangsik', '7', '7,5,21,22,24', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 13:10:53'),
(204, '', '김민국', '9', '13,11,5,10,17', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 14:59:00'),
(205, '', '김민국', '9', '13,15,14,9,19', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 15:06:54'),
(206, '', 'Lee Yangsik', '7', '16,3,22,15,17', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 15:08:42'),
(207, '', 'Mae Geronimo', '10', '18,3,26,17,4', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 15:23:25'),
(208, '', 'Mae Geronimo', '10', '1,3,23,26,27', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 15:24:08'),
(209, '', '김민국', '9', '22,3,24,25,18', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 19:32:17'),
(210, '', '김아영', '20', '24,3,8,2,16', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 21:04:25'),
(211, '', '김아영', '20', '28,23,21,11,25', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 21:04:45'),
(212, '', '김아영', '20', '26,24,22,7,11', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 21:05:10'),
(213, '', '김아영', '20', '12,15,21,8,6', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 21:06:08'),
(214, '', '김아영', '20', '4,19,6,16,17', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 21:06:16'),
(215, '', '김아영', '20', '24,9,11,3,6', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 21:06:31'),
(216, '', '김아영', '20', '13,23,25,20,16', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-02 21:07:56'),
(217, '', '김아영', '20', '25,28,11,12,13', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-02 21:08:14'),
(218, '', '김아영', '20', '13,3,7,12,4', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-03 12:55:16'),
(219, '', '김아영', '20', '23,6,5,14,8', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-03 18:09:53'),
(220, '', '김아영', '20', '10,1,6,17,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-03 18:15:55'),
(221, '', '이주성', '12', '19,15,5,25,13', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-03 18:19:35'),
(222, '', '김아영', '20', '25,9,8,22,5', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-03 18:59:30'),
(223, '', 'Lee Yangsik', '7', '14,25,19,24,9', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-04 19:24:34'),
(224, '', 'Lee Yangsik', '7', '1,2,17,18,3', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 19:25:02'),
(225, '', 'Lee Yangsik', '7', '1,17,20,22,23', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 19:38:13'),
(226, '', '김아영', '20', '4,9,13,19,23', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:41:35'),
(227, '', '김아영', '20', '5,12,8,22,25', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:44:53'),
(228, '', '이주성', '12', '2,5,14,18,26', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:46:24'),
(229, '', '김아영', '20', '5,6,7,9,20', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:47:00'),
(230, '', '김아영', '20', '22,5,13,17,28', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-04 21:47:25'),
(231, '', '김아영', '20', '9,10,12,13,20', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:48:26'),
(232, '', '김아영', '20', '10', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-04 21:54:21'),
(233, '', 'Lee Yangsik', '7', '21,5,26,14,24', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 11:23:31'),
(234, '', 'Lee Yangsik', '7', '1,17,18,3,4', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 11:23:48'),
(235, '', '김아영', '20', '5,10,24,27,20', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 11:33:48'),
(236, '', 'Lee Yangsik', '7', '', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:10:20'),
(237, '', '김아영', '20', '5,9,22,25', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:10:21'),
(238, '', 'Lee Yangsik', '7', '13,11,6,14,21', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 12:10:29'),
(239, '', '김아영', '20', '8', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:10:45'),
(240, '', '김아영', '20', '12,16,23,8,28', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 12:13:53'),
(241, '', '김아영', '20', '6,11,14,12,7', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 12:14:02'),
(242, '', '김아영', '20', '5,7,10,25,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:14:16'),
(243, '', '김아영', '20', '2,13,24,7,22', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:14:35'),
(244, '', '김아영', '20', '4,6,10,13,24', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:14:52'),
(245, '', 'Lee Yangsik', '7', '', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 12:15:16'),
(246, '', '김아영', '20', '20,4,18,9,23', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 12:18:57'),
(247, '', 'Lee Yangsik', '7', '1,2,3,18,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 13:29:34'),
(248, '', 'Lee Yangsik', '7', '17,23,8,21,28', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 13:30:40'),
(249, '', 'Lee Yangsik', '7', '12,18,28,2,26', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 13:45:27'),
(250, '', '김아영', '20', '4,9,12,22,25', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 13:59:12'),
(251, '', '김아영', '20', '24,13,14,11,16', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 13:59:22'),
(252, '', '김아영', '20', '17,28,13,2,3', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 14:03:27'),
(253, '', '김아영', '20', '11,24,27,20,13', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 14:04:05'),
(254, '', '김아영', '20', '9,5,2,22,23', '3', '50000', '35000', 1400000, '9, 5, 2', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-05 14:05:46'),
(255, '', '김아영', '20', '5,12,8,26,23', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 14:06:07'),
(256, '', '김아영', '20', '25,11,10,21,6', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 14:30:57'),
(257, '', 'Lee Yangsik', '7', '7,11,28,16,23', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 15:20:55'),
(258, '', 'Lee Yangsik', '7', '24,11,25,8,28', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 15:31:29'),
(259, '', 'Lee Yangsik', '7', '1,2,3,18,28', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:31:18'),
(260, '', '김아영', '20', '28,17,24,23,13', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 19:53:26'),
(261, '', '김아영', '20', '6,7,9,11,25', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:54:10'),
(262, '', 'Lee Yangsik', '7', '1,2,20,23,25', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:54:45'),
(263, '', '김아영', '20', '5,9,13,26,20', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:55:29'),
(264, '', '김아영', '20', '13,1,24,8,9', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 19:55:38'),
(265, '', '김아영', '20', '5,8,12,2,18', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:56:25'),
(266, '', 'Lee Yangsik', '7', '1,2,3,18,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:56:31'),
(267, '', '김아영', '20', '4,7,10,12,14', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:56:36'),
(268, '', '김아영', '20', '11,13,12,16,9', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 19:56:43'),
(269, '', 'Lee Yangsik', '7', '17,2,4,20,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 19:57:11'),
(270, '', 'Lee Yangsik', '7', '26,12,10,9,14', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 20:02:05'),
(271, '', '김아영', '20', '20,21,28,16,15', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-05 20:17:10'),
(272, '', '김아영', '20', '4,8,11,22,26', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-05 20:17:43'),
(273, '', 'Lee Yangsik', '7', '1,2,18,20,22', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 10:41:34'),
(274, '', 'Lee Yangsik', '7', '24,5,25,26,18', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 14:19:30'),
(275, '', 'Lee Yangsik', '7', '6,21,22,24,25', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 14:19:59'),
(276, '', '최윤아', '19', '22,24,4,11,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 14:37:19'),
(277, '', '최윤아', '19', '4,7,25,11,27', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 14:39:05'),
(278, '', '오규성', '14', '1,2,7,20,24', '5', '50000', '35000', 840000, '2, 24', 'No Match', 0, '0', 'Manual', 0, '', '', 1, '2024-03-06 15:35:31'),
(279, '', '최시연', '15', '6,8,7,20,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 15:38:01'),
(280, '', '이주성', '12', '20,23,27,5,22', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 15:38:44'),
(281, '', '이주성', '12', '14,10,3,9,28', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 15:38:55'),
(282, '', '김민국', '9', '26,3,20,10,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 15:39:28'),
(283, '', '김민국', '9', '28,9,6,19,11', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 15:39:43'),
(284, '', '최순자', '17', '1,20,24,12,13', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 15:40:43'),
(285, '', '최순자', '17', '2,20,10,13,15', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 15:42:51'),
(286, '', '김윤호', '18', '2,9,10,15,28', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 17:50:04'),
(287, '', 'Lee Yangsik', '7', '7,9,16,5,14', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 17:50:50'),
(288, '', '김유진', '16', '2,3,7,10,19', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 17:50:52'),
(289, '', 'Lee Yangsik', '7', '1,17,18,5,20', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 17:51:03'),
(290, '', '최시연', '15', '19,3,27,14,16', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 17:51:22'),
(291, '', 'Mae Geronimo', '10', '1,2,20,6,25', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 17:51:24'),
(292, '', '최시연', '15', '22,23,3,16,21', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 17:51:32'),
(293, '', 'Mae Geronimo', '10', '1,8,10,21,9', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 17:51:35'),
(294, '', '최시연', '15', '1,3,8,20,27', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-06 17:52:30'),
(295, '', 'mae@123', '10', '25,3,2,15,13', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 18:02:08'),
(296, '', 'lee_123', '7', '1,23,20,8,7', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-06 18:02:40'),
(297, '', 'mae@123', '10', '4,10,6,26,8', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 07:48:28'),
(298, '', 'lee_123', '7', '1,7,15,3,5', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 19:40:45'),
(299, '', 'cldsuj3', '15', '9,17,12,20,10', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 21:50:35'),
(300, '', 'cldsuj3', '15', '9,17,12,20,10', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 21:50:38'),
(301, '', 'cldsuj3', '15', '6,25,10,14,1', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 21:51:00'),
(302, '', 'eirfkc23', '12', '20,26,2,5,1', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:45:57'),
(303, '', 'eirfkc23', '12', '19,3,13,23,25', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:58:52'),
(304, '', 'eirfkc23', '12', '16,3,13,4,9', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:58:59'),
(305, '', 'eirfkc23', '12', '9,26,16,19,13', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:59:05'),
(306, '', 'eirfkc23', '12', '19,9,25,11,12', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:59:12'),
(307, '', 'eirfkc23', '12', '17,23,16,14,6', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:59:33'),
(308, '', 'eirfkc23', '12', '6,25,28,16,18', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-07 23:59:46'),
(309, '', 'eirfkc23', '12', '11,7,22,26,14', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 00:00:01'),
(310, '', 'lee_123', '7', '7,24,8,2,10', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 11:30:34'),
(311, '', 'eirfkc23', '12', '22,8,24,5,12', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 13:31:12'),
(312, '', 'eirfkc23', '12', '12,7,4,14,11', '3', '50000', '35000', 175000, '4', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-08 13:31:34'),
(313, '', 'eirfkc23', '12', '18,8,26,9,21', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 13:31:59'),
(314, '', 'eirfkc23', '12', '6,7,25,22,14', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 20:17:01'),
(315, '', 'lee_123', '7', '1,21,22,23,25', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 22:50:57'),
(316, '', 'lee_123', '7', '3,7,25,28,23', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 22:53:04'),
(317, '', 'eirfkc23', '12', '1,25,7,22,3', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 22:58:52'),
(318, '', 'eirfkc23', '12', '17,13,4,6,10', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 22:59:55'),
(319, '', 'lee_123', '7', '1,2,18,19,20', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 23:00:45'),
(320, '', 'lee_123', '7', '8,17,20,19,22', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 23:04:46'),
(321, '', 'lee_123', '7', '21,20,23,24,25', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 23:05:21'),
(322, '', 'lee_123', '7', '21,17,19,13,1', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 23:15:00'),
(323, '', 'lee_123', '7', '1,3,19,20,21', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-08 23:36:59'),
(324, '', 'lee_123', '7', '4,7,13,23,27', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-08 23:37:16'),
(325, '', 'lee_123', '7', '7,26,22,3,6', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-09 02:55:15'),
(326, '', 'z1234', '9', '20,9,26,4,27', '4', '50000', '35000', 140000, '9, 4', '4', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-09 15:21:32'),
(327, '', 'z1234', '9', '22,6,20,13,5', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-09 15:21:42'),
(328, '', 'z1234', '9', '13,26,11,15,23', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-09 15:21:53'),
(329, '', 'lee_123', '7', '26,6,14,27,3', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-11 15:08:59'),
(330, '', 'lee_123', '7', '1,2,17,18,19', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-11 15:09:23'),
(331, '', 'lee_123', '7', '2,7,9,23,18', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-11 15:13:21'),
(332, '', 'lee_123', '7', '13,9,5,12,8', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-11 17:18:44'),
(333, '', 'lee_123', '7', '19,1,10,11,21', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-11 19:13:43'),
(334, '', 'lee_123', '7', '20,17,15,26,12', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-12 19:13:57'),
(335, '', 'lee_123', '7', '1,15,18,13,2', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-12 19:14:32'),
(336, '', 'lee_123', '7', '5,16,28,1,1', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-12 19:15:16'),
(337, '', 'lee_123', '7', '15,18,1,3,27', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-12 19:45:23'),
(338, '', 'lee_123', '7', '2,7,21,27,24', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-12 20:16:18'),
(339, '', 'lee_123', '7', '9,10,2,11,21', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:19:43'),
(340, '', 'lee_123', '7', '2,22,23,15,6', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:25:56'),
(341, '', 'lee_123', '7', '4,3,6,19,18', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:28:04'),
(342, '', 'lee_123', '7', '25,4,22,20,13', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:28:45'),
(343, '', 'lee_123', '7', '7,2,6,21,17', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:50:14'),
(344, '', 'lee_123', '7', '25,13,22,1,7', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:51:49'),
(345, '', 'lee_123', '7', '19,17,9,22,28', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:52:25'),
(346, '', 'lee_123', '7', '26,15,5,1,4', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:53:51'),
(347, '', 'lee_123', '7', '11,13,24,8,2', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:55:45'),
(348, '', 'lee_123', '7', '15,7,4,18,16', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 00:56:55'),
(349, '', 'lee_123', '7', '11,25,17,2,15', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 01:01:34'),
(350, '', 'lee_123', '7', '9,5,16,17,10', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 01:03:38'),
(351, '', 'lee_123', '7', '22,16,20,3,21', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 05:57:26'),
(352, '', 'lee_123', '7', '18,17,22,1,14', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 05:57:48'),
(353, '', 'lee_123', '7', '3,11,4,20,12', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 05:58:55'),
(354, '', 'lee_123', '7', '25,26,18,21,19', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-13 06:00:19'),
(355, '', 'lee_123', '7', '12,13,14,15,24', '6', '50000', '35000', 595000, '12, 13, 14, 15', 'No Match', 0, '0', 'Manual', 0, '', '', 1, '2024-03-14 20:35:39'),
(356, '', 'lee_123', '7', '7,27,6,21,2', '9', '50000', '35000', 35000, '27, 21', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-15 19:48:29'),
(357, '', 'lee_123', '7', '1,2,27,21,15', '4', '50000', '35000', 35000, '27, 21', 'No Match', 0, '0', 'Manual', 0, '', '', 1, '2024-03-15 19:50:17'),
(358, '', 'lee_123', '7', '12,13,14,15,1', '3', '50000', '35000', 35000, '12,13,14,15', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-17 18:49:07'),
(359, '', 'lee_123', '7', '14,27,28,26,16', '5', '50000', '35000', 105000, '14, 16', 'No Match', 0, '0', 'Automatic', 0, '', '', 1, '2024-03-18 18:57:47'),
(360, '', 'lee_123', '7', '1,17,18,19,22', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-18 18:58:02'),
(361, '', 'lee_123', '7', '20,21,24,26,27', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-18 19:10:37'),
(362, '', 'lee_123', '7', '1,2,17,18,19', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:11:25'),
(363, '', 'lee_123', '7', '1,2,17,18,19', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:11:49'),
(364, '', 'lee_123', '7', '5,2,13,21,20', '5', '50000', '35000', 700000, '13', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-19 17:51:24'),
(365, '', 'lee_123', '7', '1,2,3,4,5', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:52:50'),
(366, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 116667, '1, 2, 3, 4, 5', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:52:59'),
(367, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:53:37'),
(368, '', 'lee_123', '7', '1,2,3,4,5', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:53:53'),
(369, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 17:55:45'),
(370, '', 'lee_123', '7', '1,2,3,4,5', '', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:05:15'),
(371, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:08:18'),
(372, '', 'lee_123', '7', '1,2,3,4,19', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:09:22'),
(374, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:20:47'),
(377, '', 'lee_123', '7', '1,2,3,4,5', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:26:20'),
(378, '', 'lee_123', '7', '1,2,3,4,19', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:27:12'),
(379, '', 'lee_123', '7', '1,2,3,4,6', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 18:27:23'),
(380, '', 'lee_123', '7', '1,4,3,2,17', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-19 19:17:45'),
(381, '', 'lee_123', '7', '3,11,7,8,19', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-19 19:48:27'),
(390, '', 'lee_123', '7', '23,20,3,14,26', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-20 18:18:34'),
(391, '', 'lee_123', '7', '6,11,12,27,25', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-20 18:24:27'),
(392, '', 'lee_123', '7', '7,1,16,27,19', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-20 19:25:51'),
(393, '', 'lee_123', '7', '3,15,25,12,4', '0', '50000', '35000', 175000, '15, 12', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-20 19:27:04'),
(394, '', 'lee_123', '7', '3,27,4,26,6', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-20 19:27:34'),
(395, '', 'lee_123', '7', '13,11,20,26,12', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:38:51'),
(396, '', 'lee_123', '7', '25,17,28,13,24', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:40:50'),
(398, '', 'lee_123', '7', '15,11,1,9,28', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:48:37'),
(399, '', 'lee_123', '7', '27,6,8,26,7', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:50:28'),
(400, '', 'lee_123', '7', '21,13,16,11,12', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:52:16'),
(401, '', 'lee_123', '7', '24,8,3,26,17', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:55:04'),
(402, '', 'lee_123', '7', '28,17,26,16,12', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:56:10'),
(403, '', 'lee_123', '7', '13,7,24,21,10', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:56:28'),
(404, '', 'lee_123', '7', '23,22,10,7,20', '1', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 11:59:33'),
(405, '', 'lee_123', '7', '1,2,3,4,5', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-21 12:00:36'),
(406, '', 'lee_123', '7', '10,6,8,26,7', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 12:02:02'),
(407, '', 'lee_123', '7', '1,2,3,4,19', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-21 12:02:24'),
(408, '', 'lee_123', '7', '7,11,10,28,1', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 12:03:18'),
(409, '', 'lee_123', '7', '5,17,9,21,2', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 12:05:01'),
(410, '', 'lee_123', '7', '28,9,21,3,17', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 12:14:42'),
(411, '', 'lee_123', '7', '1,2,3,4,19', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-21 12:14:57'),
(412, '', 'lee_123', '7', '19,20,27,21,17', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-21 12:16:18'),
(413, '', 'lee_123', '7', '26,7,20,13,19', '6', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 14:20:14'),
(414, '', 'lee_123', '7', '12,3,9,20,4', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 18:16:47'),
(415, '', 'lee_123', '7', '21,11,28,24,3', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 18:36:59'),
(416, '', 'lee_123', '7', '17,9,24,22,4', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 18:42:20'),
(417, '', 'lee_123', '7', '7,4,21,5,15', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 18:43:30'),
(418, '', 'lee_123', '7', '24,27,21,18,7', '5', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 18:45:08'),
(419, '', 'lee_123', '7', '24,26,21,14,28', '9', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 19:01:14'),
(420, '', 'lee_123', '7', '24,20,16,1,17', '2', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 19:01:42'),
(421, '', 'lee_123', '7', '3,27,4,18,10', '0', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 19:03:43'),
(422, '', 'lee_123', '7', '26,16,12,15,21', '9', '50000', '35000', 385000, '16, 12, 15', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-22 19:12:16'),
(423, '', 'lee_123', '7', '1,2,3,4,5', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Manual', 0, '', '', 1, '2024-03-22 19:12:36'),
(424, '', 'lee_123', '7', '18,14,3,11,15', '7', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-23 12:43:29'),
(425, '', 'lee_123', '7', '9,20,22,8,26', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-23 12:53:26'),
(426, '', 'lee_123', '7', '16,27,18,22,28', '3', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-23 13:51:06'),
(427, '', 'lee_123', '7', '16,6,8,14,9', '7', '50000', '35000', 350000, '14', 'No Match', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-24 15:59:57'),
(428, '', 'lee_123', '7', '3,22,8,24,16', '4', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-25 14:08:44'),
(429, '', 'lee_123', '7', '15,18,25,1,20', '8', '50000', '35000', 0, '0', '0', 0, '1', 'Automatic', 0, '', '', 1, '2024-03-26 15:22:17'),
(430, '', 'lee_123', '7', '22,23,24,27,11', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-27 19:45:06'),
(431, '', 'lee_123', '7', '20,2,10,11,14', '9', '50000', '35000', 0, '14', 'No Match', 0, '1', '자동', 0, '', '', 1, '2024-03-28 19:51:20');
INSERT INTO `user_purchases` (`id`, `user_name`, `username`, `user_id`, `selected_numbers`, `powerballs`, `payment`, `winning_amount`, `to_received`, `winning_match_numbers`, `powerball_match`, `is_ban`, `marked`, `modes`, `purchase_status`, `referal_code`, `affiliated_agent_code`, `hide`, `date_purchase`) VALUES
(432, '', 'lee_123', '7', '10,9,19,23,7', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-29 12:40:14'),
(433, '', 'lee_123', '7', '11,1,13,18,16', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:38:23'),
(434, '', 'lee_123', '7', '8,22,21,11,4', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:45:36'),
(435, '', 'lee_123', '7', '6,22,23,3,14', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:45:42'),
(436, '', 'lee_123', '7', '25,26,7,23,8', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:47:45'),
(437, '', 'lee_123', '7', '24,6,13,9,4', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:47:50'),
(438, '', 'lee_123', '7', '1,22,17,2,5', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:47:57'),
(439, '', 'lee_123', '7', '16,18,5,27,4', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:49:03'),
(440, '', 'lee_123', '7', '13,19,3,11,24', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:49:17'),
(441, '', 'lee_123', '7', '7,12,18,20,21', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:51:20'),
(442, '', 'lee_123', '7', '26,9,12,11,20', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:51:36'),
(443, '', 'lee_123', '7', '15,21,24,22,17', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 09:51:54'),
(444, '', 'lee_123', '7', '14,21,23,16,28', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 10:02:07'),
(445, '', 'lee_123', '7', '13,23,9,18,14', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 10:02:37'),
(446, '', 'lee_123', '7', '17,2,19,9,13', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 10:02:46'),
(447, '', 'lee_123', '7', '26,25,3,5,13', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-30 10:03:09'),
(448, '', 'lee_123', '7', '24,10,11,9,18', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-31 10:03:32'),
(449, '', 'lee_123', '7', '15,3,4,23,8', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-31 10:06:58'),
(450, '', 'lee_123', '7', '8,11,5,22,7', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-31 10:08:21'),
(451, '', 'lee_123', '7', '24,26,5,28,2', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-31 10:08:43'),
(452, '', 'lee_123', '7', '28,11,3,7,15', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-03-31 10:09:33'),
(453, '', 'lee_123', '7', '1,2,3,4,5', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-03-31 10:13:21'),
(454, '', 'lee_123', '7', '16,17,18,19,20', '', '50000', '35000', 12312, '19', 'No Match', 0, '1', '수동', 0, '', '', 1, '2024-04-01 11:14:36'),
(455, '', 'test123', '21', '12,20,14,22,24', '7', '50000', '35000', 122, '', 'No Match', 0, '0', '자동', 0, '', '', 1, '2024-04-02 18:48:06'),
(456, '', 'lee_123', '7', '1,2,3,4,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-03 16:07:41'),
(457, '', 'lee_123', '7', '24,8,28,10,20', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:15:06'),
(458, '', 'lee_123', '7', '20,9,16,5,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:15:40'),
(459, '', 'lee_123', '7', '15,27,23,10,21', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:18:52'),
(460, '', 'lee_123', '7', '22,23,24,25,26', '9', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-03 16:25:29'),
(461, '', 'lee_123', '7', '11,3,23,2,6', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:29:45'),
(462, '', 'lee_123', '7', '13,19,3,21,14', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:33:15'),
(463, '', 'lee_123', '7', '14,3,1,18,11', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:33:26'),
(464, '', 'lee_123', '7', '16,17,18,19,20', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-03 16:33:53'),
(465, '', 'qwe_123', '22', '10,15,21,13,2', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 16:59:26'),
(466, '', 'lee_123', '7', '13,6,25,17,23', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 17:07:04'),
(467, '', 'lee_123', '7', '4,13,18,7,17', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 17:07:30'),
(468, '', 'lee_123', '7', '26,9,12,18,27', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 17:34:44'),
(469, '', 'lee_123', '7', '23,8,17,10,5', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 17:59:07'),
(470, '', 'lee_123', '7', '8,5,1,9,16', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-03 18:09:42'),
(471, '', 'lee_123', '7', '1,2,3,4,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-04 19:44:19'),
(472, '', 'lee_123', '7', '1,2,3,4,19', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-04 19:46:04'),
(473, '', 'lee_123', '7', '1,2,17,18,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-04 19:46:15'),
(474, '', 'lee_123', '7', '16,17,18,19,20', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-04 19:46:30'),
(475, '', 'lee_123', '7', '8,14,9,23,6', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-04 19:46:41'),
(476, '', 'lee_123', '7', '2,18,19,20,21', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-04 19:46:56'),
(477, '', 'lee_123', '7', '16,17,18,19,20', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-05 12:03:23'),
(478, '', 'lee_123', '7', '26,13,14,22,17', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-06 15:27:26'),
(479, '', 'lee_123', '7', '1,12,3,18,19', '6', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-07 15:44:49'),
(480, '', 'lee_123', '7', '15,19,17,12,3', '2', '50000', '35000', 245000, '15, 12', '2', 0, '0', '자동', 0, '', '', 1, '2024-04-08 12:01:36'),
(481, '', 'lee_123', '7', '1,2,3,4,19', '9', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-08 12:03:46'),
(482, '', 'lee_123', '7', '1,2,3,4,19', '0', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-08 12:06:21'),
(483, '', 'lee_123', '7', '1,2,17,18,19', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-08 12:06:34'),
(484, '', 'lee_123', '7', '9,8,14,17,10', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-08 12:06:58'),
(485, '', 'lee_123', '7', '23,25,4,16,18', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-08 12:28:09'),
(486, '', 'lee_123', '7', '8,24,9,21,23', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-08 12:38:20'),
(487, '', 'lee_123', '7', '1,2,3,18,19', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-09 12:22:24'),
(488, '', 'lee_123', '7', '4,27,23,20,8', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-09 12:22:34'),
(489, '', 'lee_123', '7', '21,5,12,25,9', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-09 12:23:01'),
(490, '', 'lee_123', '7', '16,17,18,19,20', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-09 12:23:18'),
(491, '', 'lee_123', '7', '27,21,6,16,4', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-09 12:49:46'),
(492, '', 'lee_123', '7', '18,24,7,26,25', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-09 12:50:09'),
(493, '', 'lee_123', '7', '16,17,18,20,19', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-09 12:52:00'),
(494, '', 'lee_123', '7', '16,17,18,19,20', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-09 13:15:05'),
(495, '', 'lee_123', '7', '4,9,18,21,19', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-09 13:15:24'),
(496, '', 'lee_123', '7', '1,2,4,18,19', '9', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-10 13:59:50'),
(497, '', 'lee_123', '7', '11,12,13,14,27', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-10 14:00:02'),
(498, '', 'lee_123', '7', '24,19,26,23,10', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-11 12:36:15'),
(499, '', 'lee_123', '7', '26,20,23,11,15', '4', '50000', '35000', 35000, '15', 'No Match', 0, '0', '자동', 0, '', '', 1, '2024-04-17 18:00:52'),
(500, '', 'lee_123', '7', '8,23,28,21,15', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-18 18:00:59'),
(501, '', 'lee_123', '7', '11,3,27,15,4', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-18 18:01:10'),
(502, '', 'lee_123', '7', '1,2,8,24,19', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-18 18:01:18'),
(503, '', 'lee_123', '7', '3,15,17,12,18', '2', '50000', '35000', 140000, '15', 'No Match', 0, '1', '자동', 0, '', '', 1, '2024-04-18 18:01:26'),
(504, '', 'lee_123', '7', '16,8,3,7,2', '2', '50000', '35000', 50000, '', 'No Match', 0, '0', '자동', 0, '', '', 1, '2024-04-19 16:53:18'),
(505, '', 'lee_123', '7', '22,26,15,5,2', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-19 16:53:26'),
(506, '', 'lee_123', '7', '22,6,25,20,1', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-19 16:53:34'),
(507, '', 'lee_123', '7', '8,9,10,12,16', '5', '50000', '35000', 50000, '9', 'No Match', 0, '0', '자동', 0, '', '', 1, '2024-04-19 17:13:59'),
(508, '', 'lee_123', '7', '21,7,4,16,28', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-19 19:01:10'),
(509, 'Lee Yangsik', 'lee_123', '7', '11,25,19,14,10', '3', '50000', '35000', 350000, '19', 'No Match', 0, '0', '자동', 0, '', '', 1, '2024-04-22 15:44:30'),
(510, 'Lee Yangsik', 'lee_123', '7', '24,1,22,18,2', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-23 11:32:04'),
(511, 'Lee Yangsik', 'lee_123', '7', '13,18,1,2,12', '8', '50000', '35000', 0, '0', '0', 0, '0', '자동', 0, '', '', 1, '2024-04-24 11:37:46'),
(512, 'Mae Geronimo', 'mae@123', '10', '19,5,25,11,12', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-25 11:39:14'),
(513, 'Mae Geronimo', 'mae@123', '10', '1,2,3,4,12', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-04-26 12:03:32'),
(514, 'Mae Geronimo', 'mae@123', '10', '1,16,17,18,12', '3', '50000', '35000', 87500, '', 'No Match', 0, '0', '수동', 0, '', '', 1, '2024-04-27 12:04:41'),
(515, 'Lee Yangsik', 'lee_123', '7', '1,2,17,18,12', '3', '50000', '35000', 35000, '', 'No Match', 0, '1', '수동', 0, '', '', 1, '2024-04-28 10:07:22'),
(516, 'Lee Yangsik', 'lee_123', '7', '26,23,4,3,11', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:37:47'),
(517, 'Lee Yangsik', 'lee_123', '7', '18,15,5,24,21', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:37:57'),
(518, 'Lee Yangsik', 'lee_123', '7', '20,27,19,13,16', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:08'),
(519, 'Lee Yangsik', 'lee_123', '7', '17,2,12,11,16', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:14'),
(520, 'Lee Yangsik', 'lee_123', '7', '12,11,7,9,17', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:23'),
(521, 'Lee Yangsik', 'lee_123', '7', '24,12,26,20,22', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:33'),
(522, 'Lee Yangsik', 'lee_123', '7', '4,3,15,17,18', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:46'),
(523, 'Lee Yangsik', 'lee_123', '7', '1,23,24,22,21', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:38:53'),
(524, 'Lee Yangsik', 'lee_123', '7', '1,7,13,8,19', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:39:00'),
(525, 'Lee Yangsik', 'lee_123', '7', '14,10,8,17,4', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:39:07'),
(526, 'Lee Yangsik', 'lee_123', '7', '18,3,5,8,10', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:42:41'),
(527, 'Lee Yangsik', 'lee_123', '7', '26,28,1,13,20', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:42:50'),
(528, 'Lee Yangsik', 'lee_123', '7', '10,19,2,13,23', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:42:57'),
(529, 'Lee Yangsik', 'lee_123', '7', '7,28,18,8,13', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:43:07'),
(530, 'Lee Yangsik', 'lee_123', '7', '25,20,18,11,14', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:43:15'),
(531, 'Lee Yangsik', 'lee_123', '7', '5,17,15,24,18', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:43:28'),
(532, 'Lee Yangsik', 'lee_123', '7', '19,18,1,24,28', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:43:52'),
(533, 'Lee Yangsik', 'lee_123', '7', '16,28,1,25,14', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 13:44:20'),
(534, 'Lee Yangsik', 'lee_123', '7', '13,28,16,6,12', '6', '50000', '35000', 303333, '6', '6', 0, '0', '자동', 0, '', '', 1, '2024-04-29 13:44:28'),
(535, 'Lee Yangsik', 'lee_123', '7', '8,5,11,22,14', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-30 13:44:34'),
(536, 'Lee Yangsik', 'lee_123', '7', '8,12,13,14,2', '7', '50000', '35000', 0, '', 'No Match', 0, '1', '자동', 0, '', '', 1, '2024-04-30 13:44:44'),
(537, 'Lee Yangsik', 'lee_123', '7', '27,7,12,13,14', '6', '50000', '35000', 0, '', '6', 0, '1', '자동', 0, '', '', 1, '2024-04-29 14:06:53'),
(538, 'Lee Yangsik', 'lee_123', '7', '25,8,10,15,4', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 17:37:08'),
(539, 'Lee Yangsik', 'lee_123', '7', '10,5,20,9,19', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 17:37:17'),
(540, 'Lee Yangsik', 'lee_123', '7', '15,8,10,4,12', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 17:37:28'),
(541, 'Lee Yangsik', 'lee_123', '7', '23,16,2,7,20', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-04-29 17:37:39'),
(542, 'Lee Yangsik', 'lee_123', '7', '7,18,23,19,26', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:24:09'),
(543, 'Lee Yangsik', 'lee_123', '7', '27,12,4,6,20', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:24:16'),
(544, 'Lee Yangsik', 'lee_123', '7', '27,23,2,10,28', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:24:26'),
(545, 'Lee Yangsik', 'lee_123', '7', '1,18,19,22,24', '7', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-05-04 13:24:39'),
(546, 'Lee Yangsik', 'lee_123', '7', '19,20,17,16,26', '2', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '', '', 1, '2024-05-04 13:25:24'),
(547, 'Lee Yangsik', 'lee_123', '7', '8,17,18,20,7', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:27:14'),
(548, 'Lee Yangsik', 'lee_123', '7', '17,8,3,1,25', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:27:26'),
(549, 'Lee Yangsik', 'lee_123', '7', '4,11,28,5,22', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-04 13:27:37'),
(550, 'Lee Yangsik', 'lee_123', '7', '15,22,20,9,5', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-05 13:28:01'),
(568, 'Lee Yangsik', 'lee_123', '7', '24,19,23,7,20', '2', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-06 12:32:19'),
(569, 'Lee Yangsik', 'lee_123', '7', '23,6,7,18,21', '3', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-06 12:46:00'),
(570, 'Lee Yangsik', 'lee_123', '7', '10,23,14,16,5', '4', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-06 13:15:43'),
(571, 'Lee Yangsik', 'lee_123', '7', '1,27,4,2,7', '5', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-06 13:25:10'),
(572, 'Lee Yangsik', 'lee_123', '7', '13,9,10,2,4', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-06 16:23:11'),
(573, 'Lee Yangsik', 'lee_123', '7', '16,11,26,9,6', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-07 11:09:38'),
(574, 'Lee Yangsik', 'lee_123', '7', '24,4,19,3,2', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-07 11:11:21'),
(575, 'Lee Yangsik', 'lee_123', '7', '11,6,12,3,28', '0', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-07 12:21:35'),
(576, 'Lee Yangsik', 'lee_123', '7', '26,12,5,21,18', '8', '0', '0', 0, '0', '0', 0, '1', '자동', 1, '', '', 1, '2024-05-07 12:28:55'),
(577, 'wqeqwe', 'qweqwe', '60', '6,24,27,15,10', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-07 19:35:52'),
(578, 'wqeqwe', 'qweqwe', '60', '1,2,3,18,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '99369F91', '', 1, '2024-05-07 19:41:37'),
(579, 'wqeqwe', 'qweqwe', '60', '1,2,3,4,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '99369F91', '', 1, '2024-05-07 19:42:29'),
(580, 'wqeqwe', 'qweqwe', '60', '21,20,18,10,2', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-07 19:54:53'),
(581, 'wqeqwe', 'qweqwe', '60', '15,14,8,23,2', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-07 19:57:32'),
(582, 'wqeqwe', 'qweqwe', '60', '3,15,5,25,14', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-07 19:58:35'),
(583, 'wqeqwe', 'qweqwe', '60', '7,8,18,16,17', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-07 20:07:09'),
(584, 'wqeqwe', 'qweqwe', '60', '26,8,12,27,24', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-07 20:12:47'),
(585, 'wqeqwe', 'qweqwe', '60', '11,16,6,21,24', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-08 10:24:00'),
(586, 'Lee Yangsik', 'lee_123', '7', '6,16,2,27,1', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 10:25:42'),
(587, 'Lee Yangsik', 'lee_123', '7', '15,7,14,3,21', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 10:38:42'),
(588, 'Lee Yangsik', 'lee_123', '7', '1,24,9,10,20', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 10:41:37'),
(589, 'Lee Yangsik', 'lee_123', '7', '5,6,17,1,2', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 10:56:50'),
(590, 'wqeqwe', 'qweqwe', '60', '26,15,5,19,10', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-08 10:59:17'),
(591, 'Mae Geronimo', 'mae@123', '10', '14,16,18,5,12', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-08 12:07:40'),
(592, 'Lee Yangsik', 'lee_123', '7', '7,28,16,4,15', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 15:55:10'),
(593, 'wqeqwe', 'qweqwe', '60', '16,15,21,24,28', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-08 15:57:28'),
(594, 'Lee Yangsik', 'lee_123', '7', '9,21,19,20,12', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 18:29:12'),
(595, 'Lee Yangsik', 'lee_123', '7', '12,27,6,28,24', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 18:29:24'),
(596, 'Lee Yangsik', 'lee_123', '7', '13,7,9,14,4', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 18:29:47'),
(597, 'Lee Yangsik', 'lee_123', '7', '24,9,22,15,4', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 18:44:33'),
(598, 'Mae Geronimo', 'mae@123', '10', '17,13,20,16,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-08 18:51:56'),
(599, 'Lee Yangsik', 'lee_123', '7', '24,11,14,8,15', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-09 16:09:50'),
(600, 'Lee Yangsik', 'lee_123', '7', '18,19,28,13,27', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-09 16:09:57'),
(601, 'Lee Yangsik', 'lee_123', '7', '25,2,20,3,5', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-09 16:10:07'),
(602, 'Lee Yangsik', 'lee_123', '7', '21,18,3,19,6', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '80F9F8B6', '', 1, '2024-05-09 16:10:20'),
(603, 'Lee Yangsik', 'lee_123', '7', '3,7,10,22,19', '9', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '80F9F8B6', '', 1, '2024-05-09 16:10:51'),
(604, 'Lee Yangsik', 'lee_123', '7', '20,9,18,5,26', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-09 18:05:45'),
(605, 'Mae Geronimo', 'mae@1234567890', '10', '9,11,25,3,21', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-09 19:47:49'),
(606, 'Lee Yangsik', 'lee_123', '7', '8,20,22,2,14', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-10 11:34:28'),
(607, 'assaasd', 'aaaaa', '61', '20,5,21,16,15', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:15:44'),
(608, 'assaasd', 'aaaaa', '61', '20,1,15,13,27', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:16:31'),
(609, 'assaasd', 'aaaaa', '61', '18,27,28,11,24', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:16:40'),
(610, 'assaasd', 'aaaaa', '61', '21,3,24,2,11', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:16:51'),
(611, 'assaasd', 'aaaaa', '61', '21,24,5,12,7', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:16:59'),
(612, 'assaasd', 'aaaaa', '61', '12,26,19,16,4', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:17:07'),
(613, 'assaasd', 'aaaaa', '61', '28,13,7,27,10', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-10 16:20:04'),
(614, 'Lee Yangsik', 'lee_123', '7', '23,10,16,9,5', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:20:43'),
(615, 'Lee Yangsik', 'lee_123', '7', '2,6,21,28,25', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:21:43'),
(616, 'Lee Yangsik', 'lee_123', '7', '1,2,23,14,11', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:28:57'),
(617, 'Lee Yangsik', 'lee_123', '7', '15,14,25,18,28', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:29:47'),
(618, 'Lee Yangsik', 'lee_123', '7', '13,18,2,16,15', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:30:40'),
(619, 'Lee Yangsik', 'lee_123', '7', '26,27,24,12,28', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:32:15'),
(620, 'Lee Yangsik', 'lee_123', '7', '16,27,4,22,25', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:33:51'),
(621, 'Lee Yangsik', 'lee_123', '7', '19,9,16,20,21', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:34:34'),
(622, 'Lee Yangsik', 'lee_123', '7', '25,9,8,23,13', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-11 11:35:47'),
(623, 'Lee Yangsik', 'lee_123', '7', '27,9,8,15,20', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-11 11:36:38'),
(624, 'Lee Yangsik', 'lee_123', '7', '17,15,14,21,22', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-11 11:38:16'),
(625, 'Mae Geronimo', 'mae@1234567890', '10', '17,12,27,22,5', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'AF8810F6', '', 1, '2024-05-11 11:43:19'),
(626, 'Lee Yangsik', 'lee_123', '7', '23,19,22,12,4', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-11 13:02:19'),
(627, 'Lee Yangsik', 'lee_123', '7', '22,16,8,24,11', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-11 13:03:59'),
(628, 'Lee Yangsik', 'lee_123', '7', '18,11,7,1,2', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-11 13:06:33'),
(629, 'Lee Yangsik', 'lee_123', '7', '1,2,3,4,5', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '3156F4FE', '', 1, '2024-05-13 09:49:21'),
(630, 'Lee Yangsik', 'lee_123', '7', '17,18,19,20,21', '8', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '3156F4FE', '', 1, '2024-05-13 09:50:32'),
(631, 'Lee Yangsik', 'lee_123', '7', '17,19,22,21,20', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '3156F4FE', '', 1, '2024-05-13 10:06:18'),
(632, 'Lee Yangsik', 'lee_123', '7', '3,13,10,23,8', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-13 14:50:02'),
(633, 'Lee Yangsik', 'lee_123', '7', '10,11,4,3,13', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-13 15:39:50'),
(634, 'wqeqwe', 'qweqwe', '60', '15,13,17,19,3', '4', '50000', '35000', 175000, '15, 13', 'No Match', 0, '0', '자동', 0, '99369F91', '', 1, '2024-05-13 15:49:27'),
(635, 'wqeqwe', 'qweqwe', '60', '24,26,21,23,12', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-13 15:53:49'),
(636, 'wqeqwe', 'qweqwe', '60', '10,1,25,11,5', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-13 16:54:30'),
(637, 'wqeqwe', 'qweqwe', '60', '22,20,28,3,18', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-13 16:55:08'),
(638, 'wqeqwe', 'qweqwe', '60', '2,25,15,10,14', '1', '50000', '35000', 175000, '15, 14', 'No Match', 0, '0', '자동', 0, '99369F91', '', 1, '2024-05-13 17:05:03'),
(639, 'Lee Yangsik', 'lee_123', '7', '6,28,18,10,15', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-14 10:50:22'),
(640, 'Lee Yangsik', 'lee_123', '7', '8,27,21,13,17', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-14 10:51:36'),
(641, 'Lee Yangsik', 'lee_123', '7', '1,2,3,18,19', '9', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '3156F4FE', '', 1, '2024-05-14 10:52:31'),
(642, 'Lee Yangsik', 'lee_123', '7', '18,13,15,8,3', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-14 11:27:55'),
(643, 'wqeqwe', 'qweqwe', '60', '1,18,5,16,12', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-14 11:29:39'),
(644, 'assaasd', 'aaaaa', '61', '7,5,9,16,3', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '80F9F8B6', '', 1, '2024-05-14 17:13:49'),
(645, 'assaasd', 'aaaaa', '61', '2,1,16,17,18', '2', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '80F9F8B6', '', 1, '2024-05-14 17:14:01'),
(650, 'Lee Yangsik', 'lee_123', '7', '5,25,23,16,26', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-15 11:44:03'),
(651, 'Lee Yangsik', 'lee_123', '7', '25,18,19,8,9', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-15 13:01:20'),
(652, 'Lee Yangsik', 'lee_123', '7', '28,1,4,16,12', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '3156F4FE', '', 1, '2024-05-15 14:56:08'),
(653, 'Lee Yangsik', 'lee_123', '7', '9,11,14,7,5', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '96F18335', '', 1, '2024-05-15 14:56:50'),
(654, 'Lee Yangsik', 'lee_123', '7', '28,7,1,8,26', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '96F18335', '', 1, '2024-05-15 14:58:53'),
(655, 'Lee Yangsik', 'lee_123', '7', '10,18,11,28,21', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '96F18335', '', 1, '2024-05-15 15:44:33'),
(656, 'Lee Yangsik', 'lee_123', '7', '15,1,12,11,14', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '96F18335', '', 1, '2024-05-15 15:54:20'),
(657, 'Lee Yangsik', 'lee_123', '7', '13,11,9,12,19', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'AF8810F6', '', 1, '2024-05-15 16:08:39'),
(658, 'Lee Yangsik', 'lee_123', '7', '13,28,20,16,8', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '', '', 1, '2024-05-15 16:15:41'),
(659, 'Lee Yangsik', 'lee_123', '7', '22,28,16,27,20', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 17:36:15'),
(660, 'Lee Yangsik', 'lee_123', '7', '1,14,16,27,28', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 17:41:00'),
(661, 'Lee Yangsik', 'lee_123', '7', '17,1,10,15,25', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 17:59:07'),
(662, 'Lee Yangsik', 'lee_123', '7', '21,10,28,25,22', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 18:12:51'),
(663, 'Lee Yangsik', 'lee_123', '7', '6,4,24,18,8', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 18:22:00'),
(664, 'Lee Yangsik', 'lee_123', '7', '7,25,11,10,15', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 18:47:00'),
(665, 'Lee Yangsik', 'lee_123', '7', '2,5,26,11,13', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-15 19:26:24'),
(666, 'Lee Yangsik', 'lee_123', '7', '25,27,1,9,12', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 10:49:47'),
(667, 'Lee Yangsik', 'lee_123', '7', '4,25,13,26,11', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 10:52:36'),
(668, 'Lee Yangsik', 'lee_123', '7', '23,14,6,24,3', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:01:21'),
(669, 'Lee Yangsik', 'lee_123', '7', '27,18,20,6,25', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:02:40'),
(670, 'Lee Yangsik', 'lee_123', '7', '3,4,28,25,15', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:04:57'),
(671, 'Lee Yangsik', 'lee_123', '7', '22,20,28,23,27', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:05:44'),
(672, 'Lee Yangsik', 'lee_123', '7', '5,11,17,12,1', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:06:45'),
(673, 'Lee Yangsik', 'lee_123', '7', '14,6,2,27,23', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:14:14'),
(674, 'Lee Yangsik', 'lee_123', '7', '27,8,22,19,1', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:15:48'),
(675, 'Lee Yangsik', 'lee_123', '7', '3,12,13,21,6', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:18:52'),
(676, 'Lee Yangsik', 'lee_123', '7', '4,24,3,22,10', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:19:14'),
(677, 'Lee Yangsik', 'lee_123', '7', '14,10,16,19,17', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:41:21'),
(678, 'Lee Yangsik', 'lee_123', '7', '6,23,20,8,17', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:41:54'),
(679, 'Lee Yangsik', 'lee_123', '7', '7,19,1,20,12', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:42:07'),
(680, 'Lee Yangsik', 'lee_123', '7', '13,2,18,5,22', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '47948228', '', 1, '2024-05-16 11:42:43'),
(681, 'qqq qqqqqq', 'qqqqqq', '66', '5,23,18,13,1', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'AF8810F6', '', 1, '2024-05-16 12:44:32'),
(682, 'qqq qqqqqq', 'qqqqqq', '66', '25,21,6,20,5', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'AF8810F6', '', 1, '2024-05-16 12:45:27'),
(683, 'qqq qqqqqq', 'qqqqqq', '66', '2,18,4,22,1', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'AF8810F6', '', 1, '2024-05-16 12:46:47'),
(684, 'bbb bbbb', 'bbbbbb', '68', '4,18,21,12,13', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-16 13:54:49'),
(685, 'bbb bbbb', 'bbbbbb', '68', '10,1,11,25,28', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-16 13:55:40'),
(686, 'bbb bbbb', 'bbbbbb', '68', '15,14,4,8,7', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '', 1, '2024-05-16 13:57:43'),
(687, 'Lee Yangsik', 'lee_123', '7', '1,2,3,4,19', '5', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '47948228', '', 1, '2024-05-16 14:56:21'),
(688, 'Lee Yangsik', 'lee_123', '7', '11,13,12,16,18', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '47948228', '', 1, '2024-05-16 14:56:56'),
(689, 'super@123', 'super@123', '70', '10,11,23,24,3', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '60AF54FD', '', 1, '2024-05-16 15:57:36'),
(690, 'super@123', 'super@123', '70', '1,2,3,4,5', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, '60AF54FD', '', 1, '2024-05-16 15:58:34'),
(691, 'eeee eee', 'eeeeee', '71', '16,23,14,6,18', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '60AF54FD', '', 1, '2024-05-16 17:34:02'),
(692, 'eeee eee', 'eeeeee', '71', '7,17,22,26,2', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '60AF54FD', '', 1, '2024-05-16 17:35:06'),
(693, 'Lee Yangsik', 'lee_123', '7', '25,6,12,28,1', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '', 1, '2024-05-17 11:17:33'),
(694, 'Lee Yangsik', 'lee_123', '7', '1,3,2,18,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '', 1, '2024-05-17 11:20:08'),
(695, 'Lee Yangsik', 'lee_123', '7', '1,7,2,15,9', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '', 1, '2024-05-17 11:35:43'),
(696, 'Lee Yangsik', 'lee_123', '7', '16,23,1,9,22', '4', '50000', '35000', 11667, '16', 'No Match', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-19 15:37:21'),
(697, 'Lee Yangsik', 'lee_123', '7', '1,2,3,13,23', '4', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-17 15:43:52'),
(698, 'Lee Yangsik', 'lee_123', '7', '1,2,12,22,23', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-17 15:46:49'),
(699, 'Lee Yangsik', 'lee_123', '7', '16,15,28,3,19', '0', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-20 17:48:12'),
(700, 'Lee Yangsik', 'lee_123', '7', '9,1,24,11,8', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-20 17:48:19'),
(701, 'Lee Yangsik', 'lee_123', '7', '7,17,20,16,26', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-20 17:48:25'),
(702, 'Lee Yangsik', 'lee_123', '7', '12,13,14,16,17', '3', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-20 17:48:40'),
(703, 'xxx xxxxx', 'xxxxxx', '73', '2,26,27,19,6', '2', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 11:10:37'),
(704, 'xxx xxxxx', 'xxxxxx', '73', '7,5,2,3,28', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 11:43:30'),
(705, 'xxx xxxxx', 'xxxxxx', '73', '22,9,4,16,25', '6', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 11:49:36'),
(706, 'xxx xxxxx', 'xxxxxx', '73', '23,1,13,3,19', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 11:58:48'),
(707, 'xxx xxxxx', 'xxxxxx', '73', '19,24,22,4,10', '1', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 12:06:22'),
(708, 'xxx xxxxx', 'xxxxxx', '73', '18,11,25,24,15', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 12:22:13'),
(709, 'Lee Yangsik', 'lee_123', '7', '21,22,24,9,23', '8', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-22 15:04:26'),
(710, 'Lee Yangsik', 'lee_123', '7', '1,17,19,21,23', '7', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-22 16:00:05'),
(711, 'Lee Yangsik', 'lee_123', '7', '2,4,6,23,9', '8', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-22 16:00:14'),
(712, 'Lee Yangsik', 'lee_123', '7', '1,16,18,20,22', '7', '50000', '35000', 0, '0', '0', 0, '1', '수동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-22 16:00:27'),
(713, 'xxx xxxxx', 'xxxxxx', '73', '4,19,13,28,18', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 17:38:15'),
(714, 'xxx xxxxx', 'xxxxxx', '73', '14,16,22,20,23', '5', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-22 17:39:28'),
(715, 'Lee Yangsik', 'lee_123', '7', '23,13,4,21,15', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-23 12:32:18'),
(716, 'Lee Yangsik', 'lee_123', '7', '15,21,19,16,6', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, 'A24DDAF0', '99369F91', 1, '2024-05-23 16:43:03'),
(717, 'xxx xxxxx', 'xxxxxx', '73', '10,26,25,9,18', '9', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-24 18:28:19'),
(718, 'xxx xxxxx', 'xxxxxx', '73', '14,5,4,3,9', '7', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-24 18:28:26'),
(719, 'xxx xxxxx', 'xxxxxx', '73', '4,10,8,16,7', '3', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-24 18:28:32'),
(720, 'xxx xxxxx', 'xxxxxx', '73', '18,10,11,24,19', '4', '50000', '35000', 0, '0', '0', 0, '1', '자동', 0, '99369F91', '99369F91', 1, '2024-05-24 18:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_request_withdrawal`
--

CREATE TABLE `user_request_withdrawal` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount_withdrawal` varchar(255) NOT NULL DEFAULT '0',
  `credit_balance` varchar(255) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_acct_num` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_withdrawal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_request_withdrawal`
--

INSERT INTO `user_request_withdrawal` (`id`, `userid`, `name`, `user_id`, `amount_withdrawal`, `credit_balance`, `bank_name`, `bank_acct_num`, `status`, `date_withdrawal`) VALUES
(44, 'xxxxxx', 'xxx xxxxx', '73', '10000', '940000', '광주은행', 1234567890, '답변대기', '2024-05-22 12:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_withdrawal_request`
--

CREATE TABLE `user_withdrawal_request` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount_withdrawal` varchar(255) NOT NULL,
  `credit_balance` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_acct_num` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `hide` int(11) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hide',
  `date_withdrawal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_withdrawal_request`
--

INSERT INTO `user_withdrawal_request` (`id`, `userid`, `name`, `user_id`, `amount_withdrawal`, `credit_balance`, `bank_name`, `bank_acct_num`, `status`, `hide`, `date_withdrawal`) VALUES
(1, '', 'lee_123', '7', '10000', '840400', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-08 17:41:24'),
(2, '', 'lee_123', '7', '10000', '725400', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-09 16:44:23'),
(3, '', 'test123', '21', '15000', '905000', '국민은행', '1234567890', '출금완료', 0, '2024-04-15 12:09:00'),
(4, '', 'Lee Yangsik', '7', '10000', '600862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 10:35:16'),
(5, 'lee_123', 'Lee Yangsik', '7', '10000', '590862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 10:52:12'),
(6, 'lee_123', 'Lee Yangsik', '7', '10000', '580862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 10:58:22'),
(7, 'lee_123', 'Lee Yangsik', '7', '10000', '570862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 11:02:44'),
(8, 'lee_123', 'Lee Yangsik', '7', '10000', '760862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 11:15:11'),
(9, 'lee_123', 'Lee Yangsik', '7', '50000', '710862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 11:17:13'),
(10, 'lee_123', 'Lee Yangsik', '7', '50000', '645862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-23 18:09:22'),
(11, 'lee_123', 'Lee Yangsik', '7', '10000', '585862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-24 13:40:53'),
(12, 'lee_123', 'Lee Yangsik', '7', '10000', '575862', 'Bank 2', '1234567890', '출금완료', 0, '2024-04-24 14:42:32'),
(13, 'lee_123', 'Lee Yangsik', '7', '50000', '525862', 'Bank 2', '1234567890', '답변대기', 0, '2024-04-25 16:42:01'),
(14, 'lee_123', 'Lee Yangsik', '7', '50000', '25700579', 'Bank 2', '1234567890', '취소된 탈퇴', 0, '2024-05-01 19:09:22'),
(15, 'lee_123', 'Lee Yangsik', '7', '20000', '25680579', 'Bank 2', '1234567890', '출금완료', 0, '2024-05-01 19:14:25'),
(16, 'lee_123', 'Lee Yangsik', '7', '123123', '25557456', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:17:12'),
(17, 'lee_123', 'Lee Yangsik', '7', '22222', '25535234', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:22:00'),
(18, 'lee_123', 'Lee Yangsik', '7', '50000', '25485234', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:23:24'),
(19, 'lee_123', 'Lee Yangsik', '7', '11111', '25474123', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:24:28'),
(20, 'lee_123', 'Lee Yangsik', '7', '74123', '25400000', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:25:44'),
(21, 'lee_123', 'Lee Yangsik', '7', '50000', '25350000', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:27:54'),
(22, 'lee_123', 'Lee Yangsik', '7', '10000', '25340000', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:29:12'),
(23, 'lee_123', 'Lee Yangsik', '7', '123123', '25216877', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:32:33'),
(24, 'lee_123', 'Lee Yangsik', '7', '16000', '25200877', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:39:38'),
(25, 'lee_123', 'Lee Yangsik', '7', '877', '25200000', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:46:08'),
(26, 'lee_123', 'Lee Yangsik', '7', '20877', '25180000', 'Bank 2', '1234567890', '취소', 0, '2024-05-01 19:47:02'),
(27, 'lee_123', 'Lee Yangsik', '7', '10000', '24740877', 'Bank 2', '1234567890', '출금완료', 0, '2024-05-04 13:41:26'),
(28, 'lee_123', 'Lee Yangsik', '7', '10000', '9940000', 'Bank 2', '1234567890', '출금완료', 0, '2024-05-06 14:40:40'),
(29, 'mae@123', 'Mae Geronimo', '10', '10000', '2277500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:41:51'),
(30, 'mae@123', 'Mae Geronimo', '10', '10000', '2267500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:42:00'),
(31, 'mae@123', 'Mae Geronimo', '10', '10000', '2257500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:42:10'),
(32, 'mae@123', 'Mae Geronimo', '10', '10000', '2247500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:42:19'),
(33, 'mae@123', 'Mae Geronimo', '10', '10000', '2237500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:25'),
(34, 'mae@123', 'Mae Geronimo', '10', '10000', '2227500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:34'),
(35, 'mae@123', 'Mae Geronimo', '10', '10000', '2217500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:40'),
(36, 'mae@123', 'Mae Geronimo', '10', '10000', '2207500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:46'),
(37, 'mae@123', 'Mae Geronimo', '10', '10000', '2197500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:52'),
(38, 'mae@123', 'Mae Geronimo', '10', '10000', '2187500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:49:57'),
(39, 'mae@123', 'Mae Geronimo', '10', '10000', '2177500', 'Bank 1', '123', '출금완료', 0, '2024-05-06 14:50:02'),
(40, 'qweqwe', 'wqeqwe', '60', '10000', '9840000', '광주은행', '1234567890', '출금완료', 0, '2024-05-07 19:52:05'),
(41, 'lee_123', 'Lee Yangsik', '7', '50000', '447250000', '농협은행', '1234567890', '출금완료', 0, '2024-05-18 12:20:32'),
(42, 'lee_123', 'Lee Yangsik', '7', '1000000', '447061667', '농협은행', '1234567890', '출금완료', 0, '2024-05-21 11:55:33'),
(43, 'lee_123', 'Lee Yangsik', '7', '1000000', '446061667', '농협은행', '1234567890', '출금완료', 0, '2024-05-21 12:21:54'),
(44, 'xxxxxx', 'xxx xxxxx', '73', '10000', '940000', '광주은행', '1234567890', '답변대기', 0, '2024-05-22 12:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `winners_participants`
--

CREATE TABLE `winners_participants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `winning_amount` varchar(255) NOT NULL DEFAULT '0',
  `whiteballs` varchar(255) NOT NULL DEFAULT '0',
  `powerballs` varchar(255) NOT NULL DEFAULT '0',
  `match_numbers` varchar(255) NOT NULL DEFAULT '0',
  `winner_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winners_participants`
--

INSERT INTO `winners_participants` (`id`, `name`, `winning_amount`, `whiteballs`, `powerballs`, `match_numbers`, `winner_date`) VALUES
(1, 'Therdy', '1000000', '0', '0', '0', '2024-02-08 18:22:20'),
(2, 'Lee Yangsik', '100000', '4, 42, 47, 48, 60', '24', '4, 42', '2024-02-09 13:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `winning_price`
--

CREATE TABLE `winning_price` (
  `id` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `price_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `winning_price`
--

INSERT INTO `winning_price` (`id`, `total_price`, `price_date`) VALUES
(1, 945000, '2024-02-19 15:05:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_sessions`
--
ALTER TABLE `active_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins_fee`
--
ALTER TABLE `admins_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_service`
--
ALTER TABLE `customer_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_mgt`
--
ALTER TABLE `deposit_mgt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generate_numbers`
--
ALTER TABLE `generate_numbers`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `powerball_results`
--
ALTER TABLE `powerball_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_recom`
--
ALTER TABLE `tb_recom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_condition`
--
ALTER TABLE `terms_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_cancelled`
--
ALTER TABLE `users_cancelled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_request`
--
ALTER TABLE `users_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `users_request_deposit`
--
ALTER TABLE `users_request_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_withdrawal`
--
ALTER TABLE `users_withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_request_withdrawal`
--
ALTER TABLE `user_request_withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_withdrawal_request`
--
ALTER TABLE `user_withdrawal_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winners_participants`
--
ALTER TABLE `winners_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `winning_price`
--
ALTER TABLE `winning_price`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_sessions`
--
ALTER TABLE `active_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `admins_fee`
--
ALTER TABLE `admins_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_service`
--
ALTER TABLE `customer_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `deposit_mgt`
--
ALTER TABLE `deposit_mgt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `generate_numbers`
--
ALTER TABLE `generate_numbers`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `powerball_results`
--
ALTER TABLE `powerball_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_recom`
--
ALTER TABLE `tb_recom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users_cancelled`
--
ALTER TABLE `users_cancelled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_request`
--
ALTER TABLE `users_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_request_deposit`
--
ALTER TABLE `users_request_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users_withdrawal`
--
ALTER TABLE `users_withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=721;

--
-- AUTO_INCREMENT for table `user_request_withdrawal`
--
ALTER TABLE `user_request_withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_withdrawal_request`
--
ALTER TABLE `user_withdrawal_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `winners_participants`
--
ALTER TABLE `winners_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `winning_price`
--
ALTER TABLE `winning_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
