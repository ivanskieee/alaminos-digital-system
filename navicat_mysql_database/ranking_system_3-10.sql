-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 12:42 PM
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
-- Database: `rankingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `address` varchar(100) DEFAULT NULL,
  `phoneNo` int(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `birth_date` datetime(6) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `role`, `address`, `phoneNo`, `gender`, `birth_date`, `status`) VALUES
(3, 'Jade Kevin Balocos', 'kevinbalocos@gmail.com', '$2y$10$i006lFip3Dh56WeQlfUVcuLSIcgJwKPPwlsAvCF4R13taJr8nK5BO', 'admin', '123', 123, 'Male', '2025-01-23 00:00:00.000000', 'approved'),
(4, '123@123', 'kevinbalocos03@gmail.com', '$2y$10$sPnc5HWiMaRjhlkVLbk0VO2zNlNo1bcpoQ6mm0P3heTpzXO3oxfGe', 'admin', '123', 123, 'Male', '2025-01-31 00:00:00.000000', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_notifications`
--

CREATE TABLE `attendance_notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_notifications`
--

INSERT INTO `attendance_notifications` (`id`, `message`, `created_at`) VALUES
(240, 'jade check-in at 12:41 PM', '2025-02-01 12:41:45'),
(241, 'jade check-out at 12:41 PM', '2025-02-01 12:41:47'),
(242, 'jade check-in at 12:41 PM', '2025-02-01 12:41:47'),
(243, 'jade check-out at 12:41 PM', '2025-02-01 12:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `admin_id`, `action`, `timestamp`, `is_read`, `status`) VALUES
(1, 3, 'Logged out', '2025-02-23 14:59:07', 0, 'read'),
(2, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-23 14:59:13', 0, 'read'),
(3, 3, 'Sent file upload notification to user: Isabella Jane Cooper (User ID: 49) for 123', '2025-02-23 14:59:20', 0, 'read'),
(4, 3, 'Updated file (ID: 516) status from \'pending\' to \'approved\'', '2025-02-23 14:59:27', 0, 'read'),
(5, 3, 'Granted 24 points to user (ID: 163) for file type \'123\'', '2025-02-23 14:59:27', 0, 'read'),
(6, 3, 'Sent message to 123123: \'123\'', '2025-02-23 14:59:31', 0, 'read'),
(7, 3, 'Logged out', '2025-02-23 15:00:01', 0, 'read'),
(8, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-23 15:00:22', 0, 'read'),
(9, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-24 19:05:13', 0, 'read'),
(10, 3, 'Bulk updated file statuses to \'approved\' for files: fish (ID: 500), monograph published (ID: 502), monograph published (ID: 503), 123 (ID: 504),  (ID: 505),  (ID: 506), 123 (ID: 507), 123 (ID: 508), 123 (ID: 516), 123 (ID: 517), 123 (ID: 518), 123 (ID: 519), 123 (ID: 520)', '2025-02-24 19:06:25', 0, 'read'),
(11, 3, 'Updated file (ID: 522) status from \'pending\' to \'denied\'', '2025-02-24 19:07:25', 0, 'read'),
(12, 3, 'Added new file type: 51 (Category: Mandatory, Points: 123)', '2025-02-24 19:08:19', 0, 'read'),
(13, 3, 'Added new file type: 523 (Category: Yearly, Points: 23)', '2025-02-24 19:08:23', 0, 'read'),
(14, 3, 'Updated file type status: 523 (ID: 106) to approved', '2025-02-24 19:08:26', 0, 'read'),
(15, 3, 'Updated file type status: 51 (ID: 105) to approved', '2025-02-24 19:08:26', 0, 'read'),
(16, 3, 'Set the yearly reset date to: 2025-07-01-01', '2025-02-24 19:47:29', 0, 'read'),
(17, 3, 'Added 123 points for all users.', '2025-02-24 19:47:42', 0, 'read'),
(18, 3, 'Added 123 points for all users.', '2025-02-24 19:47:42', 0, 'read'),
(19, 3, 'Added 123 points for all users.', '2025-02-24 19:47:42', 0, 'read'),
(20, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(21, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(22, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(23, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(24, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(25, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(26, 3, 'Added 123 points for all users.', '2025-02-24 19:47:43', 0, 'read'),
(27, 3, 'Added 123 points for all users.', '2025-02-24 19:47:44', 0, 'read'),
(28, 3, 'Added 123 points for all users.', '2025-02-24 19:47:44', 0, 'read'),
(29, 3, 'Rank points reset to 0 for all users.', '2025-02-24 19:47:47', 0, 'read'),
(30, 3, 'Added new file type: 123 (Category: General, Points: 123)', '2025-02-24 19:47:54', 0, 'read'),
(31, 3, 'Added new file type: 141 (Category: General, Points: 123)', '2025-02-24 19:48:23', 0, 'read'),
(32, 3, 'Added new file type: 151 (Category: General, Points: 123)', '2025-02-24 19:48:31', 0, 'read'),
(33, 3, 'Moved user to pending (User ID: 163)', '2025-02-24 19:51:53', 0, 'read'),
(34, 3, 'Approved user account (User ID: 163)', '2025-02-24 19:52:23', 0, 'read'),
(35, 3, 'Added new file type: 1123 (Category: General, Points: 123)', '2025-02-24 19:53:51', 0, 'read'),
(36, 3, 'Added new file type: 123 (Category: General, Points: 154)', '2025-02-24 19:53:56', 0, 'read'),
(37, 3, 'Added new file type: 123 (Category: General, Points: 154)', '2025-02-24 19:53:56', 0, 'read'),
(38, 3, 'Bulk updated file types (IDs: 104, 107, 108, 109, 110, 111, 112) to status: approved', '2025-02-24 20:21:42', 0, 'read'),
(39, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-25 20:00:37', 0, 'read'),
(40, 3, 'Added 123 points for all users.', '2025-02-25 20:00:43', 0, 'read'),
(41, 3, 'Added 123 points for all users.', '2025-02-25 20:00:45', 0, 'read'),
(42, 3, 'Added 123 points for all users.', '2025-02-25 20:00:45', 0, 'read'),
(43, 3, 'Added 123 points for all users.', '2025-02-25 20:00:53', 0, 'read'),
(44, 3, 'Added 123 points for all users.', '2025-02-25 20:00:53', 0, 'read'),
(45, 3, 'Added 123 points for all users.', '2025-02-25 20:00:53', 0, 'read'),
(46, 3, 'Added 123 points for all users.', '2025-02-25 20:00:53', 0, 'read'),
(47, 3, 'Added 123 points for all users.', '2025-02-25 20:00:54', 0, 'read'),
(48, 3, 'Added 123 points for all users.', '2025-02-25 20:00:57', 0, 'read'),
(49, 3, 'Added 123 points for all users.', '2025-02-25 20:00:57', 0, 'read'),
(50, 3, 'Added 123 points for all users.', '2025-02-25 20:00:58', 0, 'read'),
(51, 3, 'Added 123 points for all users.', '2025-02-25 20:00:58', 0, 'read'),
(52, 3, 'Added 123 points for all users.', '2025-02-25 20:00:58', 0, 'read'),
(53, 3, 'Added 123 points for all users.', '2025-02-25 20:00:58', 0, 'read'),
(54, 3, 'Added 123 points for all users.', '2025-02-25 20:00:59', 0, 'read'),
(55, 3, 'Added 123 points for all users.', '2025-02-25 20:00:59', 0, 'read'),
(56, 3, 'Added 123 points for all users.', '2025-02-25 20:01:00', 0, 'read'),
(57, 3, 'Added 123 points for all users.', '2025-02-25 20:01:00', 0, 'read'),
(58, 3, 'Added 515 points for all users.', '2025-02-25 20:01:07', 0, 'read'),
(59, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(60, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(61, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(62, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(63, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(64, 3, 'Added 515 points for all users.', '2025-02-25 20:01:08', 0, 'read'),
(65, 3, 'Reduced 132 points for all users.', '2025-02-25 20:02:07', 0, 'read'),
(66, 3, 'Added 15123 points for all users.', '2025-02-25 20:04:06', 0, 'read'),
(67, 3, 'Added 15123 points for all users.', '2025-02-25 20:04:06', 0, 'read'),
(68, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:10', 0, 'read'),
(69, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:10', 0, 'read'),
(70, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:13', 0, 'read'),
(71, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:13', 0, 'read'),
(72, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:14', 0, 'read'),
(73, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:14', 0, 'read'),
(74, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:14', 0, 'read'),
(75, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:14', 0, 'read'),
(76, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(77, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(78, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(79, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(80, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(81, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(82, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(83, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(84, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(85, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(86, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(87, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:15', 0, 'read'),
(88, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:16', 0, 'read'),
(89, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:16', 0, 'read'),
(90, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:16', 0, 'read'),
(91, 3, 'Reduced 123 points for all users.', '2025-02-25 20:04:16', 0, 'read'),
(92, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:04:17', 0, 'read'),
(93, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:04:17', 0, 'read'),
(94, 3, 'Rank points reset to 0 for all users.', '2025-02-25 20:04:19', 0, 'read'),
(95, 3, 'Added 100 points for all users.', '2025-02-25 20:05:11', 0, 'read'),
(96, 3, 'Added 100 points for all users.', '2025-02-25 20:05:12', 0, 'read'),
(97, 3, 'Added 100 points for all users.', '2025-02-25 20:05:15', 0, 'read'),
(98, 3, 'Added 100 points for all users.', '2025-02-25 20:05:15', 0, 'read'),
(99, 3, 'Added 100 points for all users.', '2025-02-25 20:05:15', 0, 'read'),
(100, 3, 'Added 100 points for all users.', '2025-02-25 20:05:15', 0, 'read'),
(101, 3, 'Added 100 points for all users.', '2025-02-25 20:05:17', 0, 'read'),
(102, 3, 'Added 100 points for all users.', '2025-02-25 20:05:17', 0, 'read'),
(103, 3, 'Added 100 points for all users.', '2025-02-25 20:05:17', 0, 'read'),
(104, 3, 'Added 100 points for all users.', '2025-02-25 20:05:17', 0, 'read'),
(105, 3, 'Added 100 points for all users.', '2025-02-25 20:05:18', 0, 'read'),
(106, 3, 'Added 100 points for all users.', '2025-02-25 20:05:18', 0, 'read'),
(107, 3, 'Added 100 points for all users.', '2025-02-25 20:05:19', 0, 'read'),
(108, 3, 'Added 100 points for all users.', '2025-02-25 20:05:19', 0, 'read'),
(109, 3, 'Added 100 points for all users.', '2025-02-25 20:05:22', 0, 'read'),
(110, 3, 'Added 100 points for all users.', '2025-02-25 20:05:22', 0, 'read'),
(111, 3, 'Added 100 points for all users.', '2025-02-25 20:05:22', 0, 'read'),
(112, 3, 'Added 100 points for all users.', '2025-02-25 20:05:22', 0, 'read'),
(113, 3, 'Added 100 points for all users.', '2025-02-25 20:05:23', 0, 'read'),
(114, 3, 'Added 100 points for all users.', '2025-02-25 20:05:23', 0, 'read'),
(115, 3, 'Added 100 points for all users.', '2025-02-25 20:05:24', 0, 'read'),
(116, 3, 'Added 100 points for all users.', '2025-02-25 20:05:24', 0, 'read'),
(117, 3, 'Added 100 points for all users.', '2025-02-25 20:05:25', 0, 'read'),
(118, 3, 'Added 100 points for all users.', '2025-02-25 20:05:25', 0, 'read'),
(119, 3, 'Added 100 points for all users.', '2025-02-25 20:05:26', 0, 'read'),
(120, 3, 'Added 100 points for all users.', '2025-02-25 20:05:26', 0, 'read'),
(121, 3, 'Added 123 points for all users.', '2025-02-25 20:05:57', 0, 'read'),
(122, 3, 'Added 123 points for all users.', '2025-02-25 20:05:58', 0, 'read'),
(123, 3, 'Added 123 points for all users.', '2025-02-25 20:05:58', 0, 'read'),
(124, 3, 'Added 123 points for all users.', '2025-02-25 20:05:58', 0, 'read'),
(125, 3, 'Added 123 points for all users.', '2025-02-25 20:05:58', 0, 'read'),
(126, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(127, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(128, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(129, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(130, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(131, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(132, 3, 'Added 123 points for all users.', '2025-02-25 20:05:59', 0, 'read'),
(133, 3, 'Added 123 points for all users.', '2025-02-25 20:06:00', 0, 'read'),
(134, 3, 'Added 123 points for all users.', '2025-02-25 20:06:00', 0, 'read'),
(135, 3, 'Added 123 points for all users.', '2025-02-25 20:06:00', 0, 'read'),
(136, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(137, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(138, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(139, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(140, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(141, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(142, 3, 'Added 123 points for all users.', '2025-02-25 20:06:01', 0, 'read'),
(143, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(144, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(145, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(146, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(147, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(148, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(149, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(150, 3, 'Added 123 points for all users.', '2025-02-25 20:06:02', 0, 'read'),
(151, 3, 'Added 123 points for all users.', '2025-02-25 20:06:03', 0, 'read'),
(152, 3, 'Added 123 points for all users.', '2025-02-25 20:06:03', 0, 'read'),
(153, 3, 'Added 1235151 points for all users.', '2025-02-25 20:06:05', 0, 'read'),
(154, 3, 'Added 1235151 points for all users.', '2025-02-25 20:06:06', 0, 'read'),
(155, 3, 'Added 1235151 points for all users.', '2025-02-25 20:06:06', 0, 'read'),
(156, 3, 'Added 1235151 points for all users.', '2025-02-25 20:06:06', 0, 'read'),
(157, 3, 'Added 1235151 points for all users.', '2025-02-25 20:06:06', 0, 'read'),
(158, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:10', 0, 'read'),
(159, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:10', 0, 'read'),
(160, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(161, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(162, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(163, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(164, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(165, 3, 'Reduced 1515 points for all users.', '2025-02-25 20:06:11', 0, 'read'),
(166, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:09', 0, 'read'),
(167, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:09', 0, 'read'),
(168, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:09', 0, 'read'),
(169, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:09', 0, 'read'),
(170, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(171, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(172, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(173, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(174, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(175, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(176, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(177, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:10', 0, 'read'),
(178, 3, 'Reduced 1213 points for all users.', '2025-02-25 20:07:11', 0, 'read'),
(179, 3, 'Reduced 123 points for all users.', '2025-02-25 20:07:47', 0, 'read'),
(180, 3, 'Reduced 123 points for all users.', '2025-02-25 20:07:47', 0, 'read'),
(181, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:51', 0, 'read'),
(182, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:51', 0, 'read'),
(183, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:51', 0, 'read'),
(184, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(185, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(186, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(187, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(188, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(189, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(190, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(191, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(192, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(193, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(194, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:52', 0, 'read'),
(195, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(196, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(197, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(198, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(199, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(200, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(201, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(202, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(203, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(204, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:53', 0, 'read'),
(205, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(206, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(207, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(208, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(209, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(210, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(211, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(212, 3, 'Reduced 12351 points for all users.', '2025-02-25 20:07:54', 0, 'read'),
(213, 3, 'Reduced 123515 points for all users.', '2025-02-25 20:07:55', 0, 'read'),
(214, 3, 'Reduced 123515 points for all users.', '2025-02-25 20:07:55', 0, 'read'),
(215, 3, 'Reduced 123515 points for all users.', '2025-02-25 20:07:56', 0, 'read'),
(216, 3, 'Reduced 123515 points for all users.', '2025-02-25 20:07:56', 0, 'read'),
(217, 3, 'Reduced 12351523 points for all users.', '2025-02-25 20:07:58', 0, 'read'),
(218, 3, 'Reduced 12351523 points for all users.', '2025-02-25 20:07:58', 0, 'read'),
(219, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:03', 0, 'read'),
(220, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:03', 0, 'read'),
(221, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(222, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(223, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(224, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(225, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(226, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(227, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:04', 0, 'read'),
(228, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:05', 0, 'read'),
(229, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(230, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(231, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(232, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(233, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(234, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:06', 0, 'read'),
(235, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(236, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(237, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(238, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(239, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(240, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(241, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(242, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(243, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(244, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:07', 0, 'read'),
(245, 3, 'Added 123123 points for all users.', '2025-02-25 20:08:10', 0, 'read'),
(246, 3, 'Added 123123 points for all users.', '2025-02-25 20:08:10', 0, 'read'),
(247, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:14', 0, 'read'),
(248, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:14', 0, 'read'),
(249, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:16', 0, 'read'),
(250, 3, 'Reduced 14 points for all users.', '2025-02-25 20:08:16', 0, 'read'),
(251, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(252, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(253, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(254, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(255, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(256, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:17', 0, 'read'),
(257, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:18', 0, 'read'),
(258, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:18', 0, 'read'),
(259, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:18', 0, 'read'),
(260, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:18', 0, 'read'),
(261, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:19', 0, 'read'),
(262, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:19', 0, 'read'),
(263, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:19', 0, 'read'),
(264, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:19', 0, 'read'),
(265, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:20', 0, 'read'),
(266, 3, 'Reduced 14512 points for all users.', '2025-02-25 20:08:20', 0, 'read'),
(267, 3, 'Added 123123 points for all users.', '2025-02-25 20:08:22', 0, 'read'),
(268, 3, 'Added 123123 points for all users.', '2025-02-25 20:08:22', 0, 'read'),
(269, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:32', 0, 'read'),
(270, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:32', 0, 'read'),
(271, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(272, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(273, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(274, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(275, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(276, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(277, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(278, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(279, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(280, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:33', 0, 'read'),
(281, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:34', 0, 'read'),
(282, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:34', 0, 'read'),
(283, 3, 'Rank points reset to 0 for all users.', '2025-02-25 20:08:35', 0, 'read'),
(284, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:38', 0, 'read'),
(285, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:38', 0, 'read'),
(286, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:39', 0, 'read'),
(287, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:39', 0, 'read'),
(288, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:39', 0, 'read'),
(289, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:39', 0, 'read'),
(290, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:40', 0, 'read'),
(291, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:40', 0, 'read'),
(292, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:40', 0, 'read'),
(293, 3, 'Reduced 1000 points for all users.', '2025-02-25 20:08:40', 0, 'read'),
(294, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:51', 0, 'read'),
(295, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:51', 0, 'read'),
(296, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:51', 0, 'read'),
(297, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:51', 0, 'read'),
(298, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:53', 0, 'read'),
(299, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:53', 0, 'read'),
(300, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:54', 0, 'read'),
(301, 3, 'Added 1000 points for all users.', '2025-02-25 20:08:54', 0, 'read'),
(302, 3, 'Added 132 points for all users.', '2025-02-25 20:17:10', 0, 'read'),
(303, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:13', 0, 'read'),
(304, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:13', 0, 'read'),
(305, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:13', 0, 'read'),
(306, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:13', 0, 'read'),
(307, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:14', 0, 'read'),
(308, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:14', 0, 'read'),
(309, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:14', 0, 'read'),
(310, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:14', 0, 'read'),
(311, 3, 'Rank points reset to 0 for all users.', '2025-02-25 20:17:15', 0, 'read'),
(312, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:18', 0, 'read'),
(313, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:18', 0, 'read'),
(314, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:18', 0, 'read'),
(315, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:18', 0, 'read'),
(316, 3, 'Reduced 23 points for all users.', '2025-02-25 20:17:20', 0, 'read'),
(317, 3, 'Reduced 23 points for all users.', '2025-02-25 20:17:21', 0, 'read'),
(318, 3, 'Reduced 23 points for all users.', '2025-02-25 20:17:21', 0, 'read'),
(319, 3, 'Reduced 23 points for all users.', '2025-02-25 20:17:21', 0, 'read'),
(320, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:22', 0, 'read'),
(321, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:22', 0, 'read'),
(322, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(323, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(324, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(325, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(326, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(327, 3, 'Reduced 231 points for all users.', '2025-02-25 20:17:23', 0, 'read'),
(328, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:40', 0, 'read'),
(329, 3, 'Added 1324 points for all users.', '2025-02-25 20:17:40', 0, 'read'),
(330, 3, 'Rank points reset to 0 for all users.', '2025-02-25 20:17:53', 0, 'read'),
(331, 3, 'Added 123 points for all users.', '2025-02-25 20:19:36', 0, 'read'),
(332, 3, 'Added 123 points for all users.', '2025-02-25 20:19:36', 0, 'read'),
(333, 3, 'Added 123 points for all users.', '2025-02-25 20:19:36', 0, 'read'),
(334, 3, 'Added 123 points for all users.', '2025-02-25 20:19:38', 0, 'read'),
(335, 3, 'Added 123 points for all users.', '2025-02-25 20:19:39', 0, 'read'),
(336, 3, 'Added 123 points for all users.', '2025-02-25 20:19:40', 0, 'read'),
(337, 3, 'Added 123 points for all users.', '2025-02-25 20:19:40', 0, 'read'),
(338, 3, 'Reduced 123 points for all users.', '2025-02-25 20:19:43', 0, 'read'),
(339, 3, 'Reduced 123 points for all users.', '2025-02-25 20:19:43', 0, 'read'),
(340, 3, 'Reduced 123 points for all users.', '2025-02-25 20:19:44', 0, 'read'),
(341, 3, 'Rank points reset to 0 for all users.', '2025-02-25 20:19:46', 0, 'read'),
(342, 3, 'Reduced 123 points for all users.', '2025-02-25 20:19:47', 0, 'read'),
(343, 3, 'Reduced 123 points for all users.', '2025-02-25 20:19:47', 0, 'read'),
(344, 3, 'Added 123 points for all users.', '2025-02-25 20:19:49', 0, 'read'),
(345, 3, 'Added 123 points for all users.', '2025-02-25 20:19:49', 0, 'read'),
(346, 3, 'Added 123 points for all users.', '2025-02-25 20:19:49', 0, 'read'),
(347, 3, 'Added 123 points for all users.', '2025-02-25 20:19:49', 0, 'read'),
(348, 3, 'Added 123 points for all users.', '2025-02-25 20:19:49', 0, 'read'),
(349, 3, 'Added 123 points for all users.', '2025-02-25 20:19:50', 0, 'read'),
(350, 3, 'Added 123 points for all users.', '2025-02-25 20:19:50', 0, 'read'),
(351, 3, 'Added 123 points for all users.', '2025-02-25 20:19:51', 0, 'read'),
(352, 3, 'Added 123 points for all users.', '2025-02-25 20:19:51', 0, 'read'),
(353, 3, 'Added 123 points for all users.', '2025-02-25 20:19:51', 0, 'read'),
(354, 3, 'Added 123 points for all users.', '2025-02-25 20:19:51', 0, 'read'),
(355, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(356, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(357, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(358, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(359, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(360, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(361, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(362, 3, 'Added 123 points for all users.', '2025-02-25 20:19:52', 0, 'read'),
(363, 3, 'Set the yearly reset date to: 2021-01-01', '2025-02-25 20:22:25', 0, 'read'),
(364, 3, 'Set the yearly reset date to: 2025-00-01', '2025-02-25 20:26:49', 0, 'read'),
(365, 3, 'Set the yearly reset date to: 5-00-01', '2025-02-25 20:31:35', 0, 'read'),
(366, 3, 'Set the yearly reset date to: 2027-00-01', '2025-02-25 20:31:45', 0, 'read'),
(367, 3, 'Set the yearly reset date to: 2027-07-01-01', '2025-02-25 20:34:33', 0, 'read'),
(368, 3, 'Set the yearly reset date to: 2026-01-01-01', '2025-02-25 20:39:51', 0, 'read'),
(369, 3, 'Set the yearly reset date to: 2025-08-00-01', '2025-02-25 20:44:52', 0, 'read'),
(370, 3, 'Set the yearly reset date to: 2025-08-00-01', '2025-02-25 20:44:53', 0, 'read'),
(371, 3, 'Set the yearly reset date to: 2025-08-00-01', '2025-02-25 20:44:59', 0, 'read'),
(372, 3, 'Set the yearly reset date to: 2027-07-00-01', '2025-02-25 20:45:14', 0, 'read'),
(373, 3, 'Set the yearly reset date to: 2025-08-01-01', '2025-02-25 20:49:38', 0, 'read'),
(374, 3, 'Set the yearly reset date to: 2026-06-01-01', '2025-02-25 20:53:12', 0, 'read'),
(375, 3, 'Added 123 points for all users.', '2025-02-25 20:56:01', 0, 'read'),
(376, 3, 'Added 123 points for all users.', '2025-02-25 20:56:01', 0, 'read'),
(377, 3, 'Added 123 points for all users.', '2025-02-25 20:56:02', 0, 'read'),
(378, 3, 'Added 123 points for all users.', '2025-02-25 20:56:03', 0, 'read'),
(379, 3, 'Added 12313 points for all users.', '2025-02-25 20:56:17', 0, 'read'),
(380, 3, 'Added 12313 points for all users.', '2025-02-25 21:00:45', 0, 'read'),
(381, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-26 06:18:42', 0, 'read'),
(382, 3, 'Added 123 points for all users.', '2025-02-26 06:18:50', 0, 'read'),
(383, 3, 'Added 123 points for all users.', '2025-02-26 06:18:50', 0, 'read'),
(384, 3, 'Added 123 points for all users.', '2025-02-26 06:18:51', 0, 'read'),
(385, 3, 'Added 123 points for all users.', '2025-02-26 06:18:51', 0, 'read'),
(386, 3, 'Added 123 points for all users.', '2025-02-26 06:18:52', 0, 'read'),
(387, 3, 'Rank points reset to 0 for all users.', '2025-02-26 06:21:09', 0, 'read'),
(388, 3, 'Rank points reset to 0 for all users.', '2025-02-26 06:34:33', 0, 'read'),
(389, 3, 'Bulk updated file types (IDs: 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112) to status: pending', '2025-02-26 06:39:02', 0, 'read'),
(390, 3, 'Bulk updated file types (IDs: 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112) to status: approved', '2025-02-26 06:39:28', 0, 'read'),
(391, 3, 'Bulk updated file types (IDs: 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112) to status: pending', '2025-02-26 06:39:48', 0, 'read'),
(392, 3, 'Bulk updated file types (IDs: 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 94, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112) to status: approved', '2025-02-26 06:40:32', 0, 'read'),
(393, 3, 'Bulk updated file types (IDs: 94) to status: pending', '2025-02-26 06:40:35', 0, 'read'),
(394, 3, 'Bulk updated file types (IDs: 103) to status: pending', '2025-02-26 06:41:10', 0, 'read'),
(395, 3, 'Bulk updated file types (IDs: 104) to status: pending', '2025-02-26 06:41:31', 0, 'read'),
(396, 3, 'Deleted file type: 123 (ID: 94)', '2025-02-26 06:59:31', 0, 'read'),
(397, 3, 'Bulk updated file types (IDs: 103, 104, 103, 104) to status: approved', '2025-02-26 07:01:31', 0, 'read'),
(398, 3, 'Sent file upload notification to user: Isabella Jane Cooper (User ID: 49) for 123', '2025-02-26 07:01:43', 0, 'read'),
(399, 3, 'Bulk updated file types (IDs: 103) to status: pending', '2025-02-26 07:05:12', 0, 'read'),
(400, 3, 'Bulk updated file types (IDs: 104) to status: pending', '2025-02-26 07:05:17', 0, 'read'),
(401, 3, 'Bulk updated file types (IDs: 105) to status: pending', '2025-02-26 07:05:22', 0, 'read'),
(402, 3, 'Bulk updated file types (IDs: 106) to status: pending', '2025-02-26 07:05:30', 0, 'read'),
(403, 3, 'Added new file type: 123 (Category: General, Points: 123)', '2025-02-26 07:05:36', 0, 'read'),
(404, 3, 'Bulk updated file types (IDs: 107, 108, 109, 110, 111, 112, 107, 108, 109, 110, 111, 112) to status: pending', '2025-02-26 07:05:42', 0, 'read'),
(405, 3, 'Bulk updated file types (IDs: 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113) to status: approved', '2025-02-26 07:06:11', 0, 'read'),
(406, 3, 'Updated address for user (ID: 48) from \'123\' to \'123123\'', '2025-02-26 12:30:15', 0, 'read'),
(407, 3, 'Updated user information (ID: 48) successfully.', '2025-02-26 12:30:15', 0, 'read'),
(408, 3, 'Updated email for user (ID: 48) from \'22@231\' to \'22@2312\'', '2025-02-26 12:30:21', 0, 'read'),
(409, 3, 'Updated user information (ID: 48) successfully.', '2025-02-26 12:30:21', 0, 'read'),
(410, 3, 'Updated phoneNo for user (ID: 48) from \'12334\' to \'123342\'', '2025-02-26 12:35:07', 0, 'read'),
(411, 3, 'Updated user information (ID: 48) successfully.', '2025-02-26 12:35:07', 0, 'read'),
(412, 3, 'Updated phoneNo for user (ID: 55) from \'123456789\' to \'09054651578\'', '2025-02-26 12:47:56', 0, 'read'),
(413, 3, 'Updated user information (ID: 55) successfully.', '2025-02-26 12:47:56', 0, 'read'),
(414, 3, 'Updated phoneNo for user (ID: 166) from \'123123\' to \'123123515\'', '2025-02-26 12:48:04', 0, 'read'),
(415, 3, 'Updated gender for user (ID: 166) from \'Female\' to \'male\'', '2025-02-26 12:48:04', 0, 'read'),
(416, 3, 'Updated user information (ID: 166) successfully.', '2025-02-26 12:48:04', 0, 'read'),
(417, 3, 'Updated username for user (ID: 62) from \'Samuel Lucas Bailey\n\' to \'Samuel Lucas Bailey\'', '2025-02-26 12:48:09', 0, 'read'),
(418, 3, 'Updated phoneNo for user (ID: 62) from \'123\' to \'123112\'', '2025-02-26 12:48:10', 0, 'read'),
(419, 3, 'Updated gender for user (ID: 62) from \'Male\' to \'male\'', '2025-02-26 12:48:10', 0, 'read'),
(420, 3, 'Updated user information (ID: 62) successfully.', '2025-02-26 12:48:10', 0, 'read'),
(421, 3, 'Updated user information (ID: 62) successfully.', '2025-02-26 12:48:10', 0, 'read'),
(422, 3, 'Updated phoneNo for user (ID: 63) from \'123\' to \'515151\'', '2025-02-26 12:48:14', 0, 'read'),
(423, 3, 'Updated user information (ID: 63) successfully.', '2025-02-26 12:48:14', 0, 'read'),
(424, 3, 'Updated phoneNo for user (ID: 63) from \'515151\' to \'9054651578\'', '2025-02-26 12:48:25', 0, 'read'),
(425, 3, 'Updated user information (ID: 63) successfully.', '2025-02-26 12:48:25', 0, 'read'),
(426, 3, 'Updated phoneNo for user (ID: 90) from \'123\' to \'09999561979\'', '2025-02-26 12:48:42', 0, 'read'),
(427, 3, 'Updated gender for user (ID: 90) from \'Male\' to \'male\'', '2025-02-26 12:48:42', 0, 'read'),
(428, 3, 'Updated user information (ID: 90) successfully.', '2025-02-26 12:48:42', 0, 'read'),
(429, 3, 'Updated phoneNo for user (ID: 123) from \'123\' to \'21312312313\'', '2025-02-26 12:48:49', 0, 'read'),
(430, 3, 'Updated gender for user (ID: 123) from \'Male\' to \'male\'', '2025-02-26 12:48:49', 0, 'read'),
(431, 3, 'Updated user information (ID: 123) successfully.', '2025-02-26 12:48:49', 0, 'read'),
(432, 3, 'Updated phoneNo for user (ID: 123) from \'2147483647\' to \'21312312313\'', '2025-02-26 12:48:49', 0, 'read'),
(433, 3, 'Updated user information (ID: 123) successfully.', '2025-02-26 12:48:49', 0, 'read'),
(434, 3, 'Updated phoneNo for user (ID: 90) from \'2147483647\' to \'0905465\'', '2025-02-26 12:49:04', 0, 'read'),
(435, 3, 'Updated user information (ID: 90) successfully.', '2025-02-26 12:49:04', 0, 'read'),
(436, 3, 'Logged out', '2025-02-26 14:14:24', 0, 'read'),
(437, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-26 19:32:13', 0, 'read'),
(438, 3, 'Logged out', '2025-02-26 19:33:16', 0, 'read'),
(439, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-26 19:58:59', 0, 'read'),
(440, 3, 'Rank points reset to 0 for all users.', '2025-02-26 20:46:17', 0, 'read'),
(441, 3, 'Added 123 points for all users.', '2025-02-26 20:46:22', 0, 'read'),
(442, 3, 'Rank points reset to 0 for all users.', '2025-02-26 20:46:39', 0, 'read'),
(443, 3, 'Added 515 points for all users.', '2025-02-26 20:46:45', 0, 'read'),
(444, 3, 'Added 51523 points for all users.', '2025-02-26 20:46:49', 0, 'read'),
(445, 3, 'Added 51523 points for all users.', '2025-02-26 20:46:49', 0, 'read'),
(446, 3, 'Rank points reset to 0 for all users.', '2025-02-26 20:46:57', 0, 'read'),
(447, 3, 'Added 10000 points for all users.', '2025-02-26 20:47:03', 0, 'read'),
(448, 3, 'Added 10000 points for all users.', '2025-02-26 20:47:04', 0, 'read'),
(449, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:08', 0, 'read'),
(450, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:08', 0, 'read'),
(451, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:08', 0, 'read'),
(452, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:08', 0, 'read'),
(453, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:08', 0, 'read'),
(454, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:09', 0, 'read'),
(455, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:09', 0, 'read'),
(456, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:09', 0, 'read'),
(457, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:10', 0, 'read'),
(458, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:10', 0, 'read'),
(459, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:10', 0, 'read'),
(460, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(461, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(462, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(463, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(464, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(465, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(466, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:11', 0, 'read'),
(467, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:12', 0, 'read'),
(468, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:12', 0, 'read'),
(469, 3, 'Reduced 1000 points for all users.', '2025-02-26 20:47:12', 0, 'read'),
(470, 3, 'Added 10000 points for all users.', '2025-02-26 20:47:16', 0, 'read'),
(471, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-02-28 22:09:18', 0, 'read'),
(472, 3, 'Approved user account (User ID: 48)', '2025-02-28 22:10:03', 0, 'read'),
(473, 3, 'Approved user account (User ID: 49)', '2025-02-28 22:10:59', 0, 'read'),
(474, 3, 'Approved user account (User ID: 51)', '2025-02-28 22:11:24', 0, 'read'),
(475, 3, 'Approved user account (User ID: 55)', '2025-02-28 22:12:21', 0, 'read'),
(476, 3, 'Rejected user account (User ID: 63)', '2025-02-28 22:13:20', 0, 'read'),
(477, 3, 'Approved user account (User ID: 158)', '2025-02-28 22:13:37', 0, 'read'),
(478, 3, 'Approved user account (User ID: 159)', '2025-02-28 22:14:06', 0, 'read'),
(479, 3, 'Approved user account (User ID: 161)', '2025-02-28 22:14:55', 0, 'read'),
(480, 3, 'Approved user account (User ID: 162)', '2025-02-28 22:15:12', 0, 'read'),
(481, 3, 'Approved user account (User ID: 164)', '2025-02-28 22:15:17', 0, 'read'),
(482, 3, 'Approved user account (User ID: 165)', '2025-02-28 22:15:25', 0, 'read'),
(483, 3, 'Approved admin account (Admin ID: 3)', '2025-02-28 22:16:08', 0, 'read'),
(484, 3, 'Logged out', '2025-02-28 22:16:23', 0, 'read'),
(485, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 07:55:59', 0, 'read'),
(486, 3, 'Logged out', '2025-03-01 07:56:46', 0, 'read'),
(487, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 07:57:14', 0, 'read'),
(488, 3, 'Updated phoneNo for user (ID: 62) from \'123112\' to \'123112123\'', '2025-03-01 07:57:21', 0, 'read'),
(489, 3, 'Updated user information (ID: 62) successfully.', '2025-03-01 07:57:21', 0, 'read'),
(490, 3, 'Updated phoneNo for user (ID: 51) from \'1232422\' to \'123242212313\'', '2025-03-01 07:57:43', 0, 'read'),
(491, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:57:43', 0, 'read'),
(492, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'123\'', '2025-03-01 07:58:16', 0, 'read'),
(493, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:16', 0, 'read'),
(494, 3, 'Updated phoneNo for user (ID: 51) from \'123\' to \'123123\'', '2025-03-01 07:58:27', 0, 'read'),
(495, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:27', 0, 'read'),
(496, 3, 'Updated phoneNo for user (ID: 51) from \'123123\' to \'1231233\'', '2025-03-01 07:58:31', 0, 'read'),
(497, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:31', 0, 'read'),
(498, 3, 'Updated phoneNo for user (ID: 51) from \'1231233\' to \'12312334\'', '2025-03-01 07:58:35', 0, 'read'),
(499, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:35', 0, 'read'),
(500, 3, 'Updated phoneNo for user (ID: 51) from \'12312334\' to \'1231233441\'', '2025-03-01 07:58:46', 0, 'read'),
(501, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:46', 0, 'read'),
(502, 3, 'Updated phoneNo for user (ID: 51) from \'1231233441\' to \'12312334411\'', '2025-03-01 07:58:51', 0, 'read'),
(503, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:58:51', 0, 'read'),
(504, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'1234567891\'', '2025-03-01 07:59:04', 0, 'read'),
(505, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:59:04', 0, 'read'),
(506, 3, 'Updated phoneNo for user (ID: 51) from \'1234567891\' to \'12345678910\'', '2025-03-01 07:59:09', 0, 'read'),
(507, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:59:09', 0, 'read'),
(508, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'09054651578\'', '2025-03-01 07:59:53', 0, 'read'),
(509, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 07:59:53', 0, 'read'),
(510, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'09054651589\'', '2025-03-01 08:00:04', 0, 'read'),
(511, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:00:04', 0, 'read'),
(512, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'1234567891\'', '2025-03-01 08:00:16', 0, 'read'),
(513, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:00:16', 0, 'read'),
(514, 3, 'Updated phoneNo for user (ID: 51) from \'1234567891\' to \'12345678911\'', '2025-03-01 08:00:19', 0, 'read'),
(515, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:00:19', 0, 'read'),
(516, 3, 'Logged out', '2025-03-01 08:00:31', 0, 'read'),
(517, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 08:03:21', 0, 'read'),
(518, 3, 'Updated phoneNo for user (ID: 51) from \'2147483647\' to \'09054651578\'', '2025-03-01 08:06:43', 0, 'read'),
(519, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:06:43', 0, 'read'),
(520, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:06:44', 0, 'read'),
(521, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:06:55', 0, 'read'),
(522, 3, 'Updated phoneNo for user (ID: 53) from \'123456789\' to \'09054651578\'', '2025-03-01 08:07:12', 0, 'read'),
(523, 3, 'Updated gender for user (ID: 53) from \'Male\' to \'male\'', '2025-03-01 08:07:12', 0, 'read'),
(524, 3, 'Updated user information (ID: 53) successfully.', '2025-03-01 08:07:12', 0, 'read'),
(525, 3, 'Logged out', '2025-03-01 08:07:30', 0, 'read'),
(526, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 08:08:10', 0, 'read'),
(527, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:09:37', 0, 'read'),
(528, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:10:52', 0, 'read'),
(529, 3, 'Updated phoneNo for user (ID: 51) from \'09054651578\' to \'09054651578asda\'', '2025-03-01 08:11:03', 0, 'read'),
(530, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:11:03', 0, 'read'),
(531, 3, 'Updated phoneNo for user (ID: 51) from \'09054651578asda\' to \'09054651578123\'', '2025-03-01 08:11:08', 0, 'read'),
(532, 3, 'Updated user information (ID: 51) successfully.', '2025-03-01 08:11:08', 0, 'read'),
(533, 3, 'Logged out', '2025-03-01 08:11:16', 0, 'read'),
(534, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 08:15:14', 0, 'read'),
(535, 3, 'Logged out', '2025-03-01 08:30:07', 0, 'read'),
(536, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 14:24:17', 0, 'read'),
(537, 3, 'Logged out', '2025-03-01 14:30:12', 0, 'read'),
(538, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-01 19:51:20', 0, 'read'),
(539, 3, 'Set the yearly reset date to: 2025-04-01-01', '2025-03-01 19:52:26', 0, 'read'),
(540, 3, 'Set the yearly reset date to: 2026-06-01-01', '2025-03-01 19:54:10', 0, 'read'),
(541, 3, 'Added 25 points for all users.', '2025-03-01 19:54:29', 0, 'read'),
(542, 3, 'Added 25 points for all users.', '2025-03-01 19:54:30', 0, 'read'),
(543, 3, 'Added 25 points for all users.', '2025-03-01 19:54:30', 0, 'read'),
(544, 3, 'Added 25 points for all users.', '2025-03-01 19:54:30', 0, 'read'),
(545, 3, 'Added 25 points for all users.', '2025-03-01 19:54:31', 0, 'read'),
(546, 3, 'Added 25 points for all users.', '2025-03-01 19:54:32', 0, 'read'),
(547, 3, 'Reduced 25 points for all users.', '2025-03-01 19:54:37', 0, 'read'),
(548, 3, 'Reduced 25 points for all users.', '2025-03-01 19:54:38', 0, 'read'),
(549, 3, 'Rank points reset to 0 for all users.', '2025-03-01 19:54:40', 0, 'read'),
(550, 3, 'Added 25 points for all users.', '2025-03-01 19:54:42', 0, 'read'),
(551, 3, 'Added 25 points for all users.', '2025-03-01 19:54:43', 0, 'read'),
(552, 3, 'Added 25 points for all users.', '2025-03-01 19:54:43', 0, 'read'),
(553, 3, 'Added 25100 points for all users.', '2025-03-01 19:54:46', 0, 'read'),
(554, 3, 'Rank points reset to 0 for all users.', '2025-03-01 19:54:53', 0, 'read'),
(555, 3, 'Added 25100 points for all users.', '2025-03-01 19:54:56', 0, 'read'),
(556, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-02 09:02:16', 0, 'read'),
(557, 3, 'Set the yearly reset date to: 2025-08-01-01', '2025-03-02 09:03:10', 0, 'read'),
(558, 3, 'Set the yearly reset date to: 2025-03-01-01', '2025-03-02 09:03:17', 0, 'read'),
(559, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-04 12:10:31', 0, 'read'),
(560, 3, 'Logged out', '2025-03-04 12:12:52', 0, 'read'),
(561, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-04 12:16:23', 0, 'read'),
(562, 3, 'Added 123 points for all users.', '2025-03-04 12:19:24', 0, 'read'),
(563, 3, 'Added 51515 points for all users.', '2025-03-04 12:19:36', 0, 'read'),
(564, 3, 'Updated username for user (ID: 158) from \'123123\' to \'Jade Kevin Balocos\'', '2025-03-04 12:20:57', 0, 'read'),
(565, 3, 'Updated email for user (ID: 158) from \'kevinbalocos@asd.com\' to \'kevinbalocos@asd.cadsom\'', '2025-03-04 12:20:57', 0, 'read'),
(566, 3, 'Updated phoneNo for user (ID: 158) from \'123\' to \'09054651578\'', '2025-03-04 12:20:57', 0, 'read'),
(567, 3, 'Updated gender for user (ID: 158) from \'Male\' to \'male\'', '2025-03-04 12:20:57', 0, 'read'),
(568, 3, 'Updated user information (ID: 158) successfully.', '2025-03-04 12:20:57', 0, 'read'),
(569, 3, 'Updated email for user (ID: 158) from \'kevinbalocos@asd.cadsom\' to \'kevinbalocos@gmail.com\'', '2025-03-04 12:21:51', 0, 'read'),
(570, 3, 'Updated user information (ID: 158) successfully.', '2025-03-04 12:21:51', 0, 'read'),
(571, 3, 'Bulk updated file types (IDs: 104, 105, 106) to status: pending', '2025-03-04 12:56:04', 0, 'read'),
(572, 3, 'Updated file (ID: 521) status from \'pending\' to \'approved\'', '2025-03-04 19:06:56', 0, 'read'),
(573, 3, 'Granted 123 points to user (ID: 163) for file type \'123\'', '2025-03-04 19:06:56', 0, 'read'),
(574, 3, 'Sent message to 123123: \'123\'', '2025-03-04 19:25:54', 0, 'read'),
(575, 3, 'Bulk deleted files: 123 (ID: 516), 123 (ID: 517), 123 (ID: 518), 123 (ID: 519), 123 (ID: 520), 123 (ID: 521), 123 (ID: 522), 123 (ID: 523), 51 (ID: 524), 523 (ID: 525), 123 (ID: 526), 51 (ID: 527), 523 (ID: 528), 123 (ID: 529), 123 (ID: 530), 123 (ID: 531), 123 (ID: 532), 141 (ID: 533), 1123 (ID: 534), 123 (ID: 535), 123 (ID: 536), 141 (ID: 537), 123 (ID: 538)', '2025-03-04 19:28:07', 0, 'read'),
(576, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-04 19:34:20', 0, 'read'),
(577, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-04 19:34:20', 0, 'read'),
(578, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-04 19:34:20', 0, 'read');
INSERT INTO `audit_logs` (`id`, `admin_id`, `action`, `timestamp`, `is_read`, `status`) VALUES
(579, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-04 19:34:20', 0, 'read'),
(580, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-04 19:34:20', 0, 'read'),
(581, 3, 'Sent message to Jade Kevin Balocos: \'123123\'', '2025-03-04 19:34:27', 0, 'read'),
(582, 3, 'Sent message to Jade Kevin Balocos: \'12312351\'', '2025-03-04 19:34:34', 0, 'read'),
(583, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-05 20:02:47', 0, 'read'),
(584, 3, 'Updated file (ID: 540) status from \'pending\' to \'denied\'', '2025-03-05 20:19:12', 0, 'read'),
(585, 3, 'Updated file (ID: 539) status from \'pending\' to \'approved\'', '2025-03-05 20:20:33', 0, 'read'),
(586, 3, 'Granted 123 points to user (ID: 158) for file type \'123\'', '2025-03-05 20:20:33', 0, 'read'),
(587, 3, 'Updated file (ID: 541) status from \'pending\' to \'approved\'', '2025-03-05 20:21:07', 0, 'read'),
(588, 3, 'Granted 123 points to user (ID: 158) for file type \'123\'', '2025-03-05 20:21:07', 0, 'read'),
(589, 3, 'Updated file type status: 123 (ID: 107) to remove_from_approve', '2025-03-05 20:22:17', 0, 'read'),
(590, 3, 'Updated file type status: 123 (ID: 103) to approved', '2025-03-05 20:22:22', 0, 'read'),
(591, 3, 'Updated file type status: 123 (ID: 103) to approved', '2025-03-05 20:22:22', 0, 'read'),
(592, 3, 'Updated file type status: 123 (ID: 104) to approved', '2025-03-05 20:22:22', 0, 'read'),
(593, 3, 'Updated file type status: 51 (ID: 105) to approved', '2025-03-05 20:22:23', 0, 'read'),
(594, 3, 'Updated file type status: 51 (ID: 105) to approved', '2025-03-05 20:22:23', 0, 'read'),
(595, 3, 'Updated file type status: 523 (ID: 106) to approved', '2025-03-05 20:22:23', 0, 'read'),
(596, 3, 'Updated file type status: 123 (ID: 107) to approved', '2025-03-05 20:22:23', 0, 'read'),
(597, 3, 'Rank points reset to 0 for all users.', '2025-03-05 20:22:49', 0, 'read'),
(598, 3, 'Reduced 123 points for all users.', '2025-03-05 20:22:51', 0, 'read'),
(599, 3, 'Reduced 123 points for all users.', '2025-03-05 20:22:51', 0, 'read'),
(600, 3, 'Reduced 123 points for all users.', '2025-03-05 20:22:53', 0, 'read'),
(601, 3, 'Reduced 123 points for all users.', '2025-03-05 20:22:53', 0, 'read'),
(602, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-06 19:58:14', 0, 'read'),
(603, 3, 'Sent file upload notification to user: Henry William Adams (User ID: 53) for 123', '2025-03-06 19:58:28', 0, 'read'),
(604, 3, 'Sent file upload notification to user: Henry William Adams (User ID: 53) for 123', '2025-03-06 19:58:28', 0, 'read'),
(605, 3, 'Sent file upload notification to user: Henry William Adams (User ID: 53) for 123', '2025-03-06 19:58:31', 0, 'read'),
(606, 3, 'Sent file upload notification to user: Henry William Adams (User ID: 53) for 523', '2025-03-06 19:58:34', 0, 'read'),
(607, 3, 'Added new file type: 123 (Category: General, Points: 123)', '2025-03-06 20:06:09', 0, 'read'),
(608, 3, 'Deleted file (ID: 502, Path: ./uploads/requirements/1739577219_679b865c7d603.docx)', '2025-03-06 20:08:10', 0, 'read'),
(609, 3, 'Deleted file (ID: 500, Path: ./uploads/mandatory_requirements/1739577214_679a2bee89c9c.docx)', '2025-03-06 20:08:15', 0, 'read'),
(610, 3, 'Deleted file (ID: 504, Path: ./uploads/requirements/1739588827_679a29c570a89__2_.docx)', '2025-03-06 20:08:19', 0, 'read'),
(611, 3, 'Deleted file (ID: 503, Path: ./uploads/requirements/1739577219_679b865c7d6031.docx)', '2025-03-06 20:08:25', 0, 'read'),
(612, 3, 'Rejected user account (User ID: 168)', '2025-03-06 21:13:32', 0, 'read'),
(613, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 07:28:01', 0, 'read'),
(614, 3, 'Logged out', '2025-03-08 07:29:35', 0, 'read'),
(615, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 20:56:48', 0, 'read'),
(616, 3, 'Logged out', '2025-03-08 21:02:01', 0, 'read'),
(617, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:04:53', 0, 'read'),
(618, 3, 'Logged out', '2025-03-08 21:06:26', 0, 'read'),
(619, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:06:45', 0, 'read'),
(620, 3, 'Logged out', '2025-03-08 21:07:01', 0, 'read'),
(621, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:07:41', 0, 'read'),
(622, 3, 'Logged out', '2025-03-08 21:07:59', 0, 'read'),
(623, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:08:52', 0, 'read'),
(624, 3, 'Added 12 points for all users.', '2025-03-08 21:17:56', 0, 'read'),
(625, 3, 'Added 12 points for all users.', '2025-03-08 21:17:56', 0, 'read'),
(626, 3, 'Added 12 points for all users.', '2025-03-08 21:17:57', 0, 'read'),
(627, 3, 'Added 12 points for all users.', '2025-03-08 21:17:57', 0, 'read'),
(628, 3, 'Added 12 points for all users.', '2025-03-08 21:17:57', 0, 'read'),
(629, 3, 'Added 12 points for all users.', '2025-03-08 21:17:57', 0, 'read'),
(630, 3, 'Added 12 points for all users.', '2025-03-08 21:17:58', 0, 'read'),
(631, 3, 'Added 12 points for all users.', '2025-03-08 21:17:58', 0, 'read'),
(632, 3, 'Added 12 points for all users.', '2025-03-08 21:17:58', 0, 'read'),
(633, 3, 'Added 1241 points for all users.', '2025-03-08 21:17:59', 0, 'read'),
(634, 3, 'Added 1241 points for all users.', '2025-03-08 21:17:59', 0, 'read'),
(635, 3, 'Added 1241 points for all users.', '2025-03-08 21:17:59', 0, 'read'),
(636, 3, 'Added 1241 points for all users.', '2025-03-08 21:17:59', 0, 'read'),
(637, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(638, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(639, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(640, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(641, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(642, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:00', 0, 'read'),
(643, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(644, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(645, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(646, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(647, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(648, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(649, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(650, 3, 'Added 1241 points for all users.', '2025-03-08 21:18:01', 0, 'read'),
(651, 3, 'Reduced 23 points for all users.', '2025-03-08 21:18:08', 0, 'read'),
(652, 3, 'Reduced 23123 points for all users.', '2025-03-08 21:18:10', 0, 'read'),
(653, 3, 'Logged out', '2025-03-08 21:19:56', 0, 'read'),
(654, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:25:28', 0, 'read'),
(655, 3, 'Logged out', '2025-03-08 21:26:25', 0, 'read'),
(656, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:26:44', 0, 'read'),
(657, 3, 'Logged out', '2025-03-08 21:26:51', 0, 'read'),
(658, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:26:57', 0, 'read'),
(659, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:27:43', 0, 'read'),
(660, 3, 'Logged out', '2025-03-08 21:27:55', 0, 'read'),
(661, 4, 'Admin logged in (Admin ID: 4, Email: kevinbalocos03@gmail.com)', '2025-03-08 21:27:59', 0, 'read'),
(662, 4, 'Logged out', '2025-03-08 21:28:15', 0, 'read'),
(663, 4, 'Admin logged in (Admin ID: 4, Email: kevinbalocos03@gmail.com)', '2025-03-08 21:28:22', 0, 'read'),
(664, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:28:48', 0, 'read'),
(665, 3, 'Logged out', '2025-03-08 21:28:56', 0, 'read'),
(666, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:29:16', 0, 'read'),
(667, 3, 'Logged out', '2025-03-08 21:29:21', 0, 'read'),
(668, 4, 'Admin logged in (Admin ID: 4, Email: kevinbalocos03@gmail.com)', '2025-03-08 21:29:26', 0, 'read'),
(669, 4, 'Logged out', '2025-03-08 21:30:05', 0, 'read'),
(670, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:41:17', 0, 'read'),
(671, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:42:00', 0, 'read'),
(672, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:42:35', 0, 'read'),
(673, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:42:36', 0, 'read'),
(674, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:42:36', 0, 'read'),
(675, 3, 'Logged out', '2025-03-08 21:45:53', 0, 'read'),
(676, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:45:59', 0, 'read'),
(677, 3, 'Logged out', '2025-03-08 21:51:05', 0, 'read'),
(678, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:51:11', 0, 'read'),
(679, 3, 'Logged out', '2025-03-08 21:52:48', 0, 'read'),
(680, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:53:05', 0, 'read'),
(681, 3, 'Logged out', '2025-03-08 21:56:58', 0, 'read'),
(682, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 21:57:05', 0, 'read'),
(683, 3, 'Logged out', '2025-03-08 21:57:25', 0, 'read'),
(684, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 22:00:08', 0, 'read'),
(685, 3, 'Deleted user (ID: 48) - Username: Liam Alexanders Carter, Email: 22@2312', '2025-03-08 22:13:18', 0, 'read'),
(686, 3, 'Deleted user (ID: 49) - Username: Isabella Jane Cooper, Email: 55@55', '2025-03-08 22:13:25', 0, 'read'),
(687, 3, 'Updated username for user (ID: 53) from \'Henry William Adams\' to \'Henry William Adamss\'', '2025-03-08 22:16:17', 0, 'read'),
(688, 3, 'Updated email for user (ID: 53) from \'richmond@besmonte\' to \'richmonds@besmonte\'', '2025-03-08 22:16:17', 0, 'read'),
(689, 3, 'Updated address for user (ID: 53) from \'sta.felomina\' to \'sta.felominas\'', '2025-03-08 22:16:17', 0, 'read'),
(690, 3, 'Updated phoneNo for user (ID: 53) from \'9054651578\' to \'90546515781\'', '2025-03-08 22:16:17', 0, 'read'),
(691, 3, 'Updated gender for user (ID: 53) from \'male\' to \'female\'', '2025-03-08 22:16:17', 0, 'read'),
(692, 3, 'Updated birth_date for user (ID: 53) from \'2013-08-14\' to \'2013-08-01\'', '2025-03-08 22:16:17', 0, 'read'),
(693, 3, 'Updated user information (ID: 53) successfully.', '2025-03-08 22:16:17', 0, 'read'),
(694, 3, 'Deleted user (ID: 53) - Username: Henry William Adamss, Email: richmonds@besmonte', '2025-03-08 22:16:28', 0, 'read'),
(695, 3, 'Logged out', '2025-03-08 22:17:56', 0, 'read'),
(696, 4, 'Admin logged in (Admin ID: 4, Email: kevinbalocos03@gmail.com)', '2025-03-08 22:18:28', 0, 'read'),
(697, 4, 'Logged out', '2025-03-08 22:20:21', 0, 'read'),
(698, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-08 22:20:26', 0, 'read'),
(699, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 09:01:45', 0, 'read'),
(700, 3, 'Sent message to Jade Kevin Balocos: \'123\'', '2025-03-09 09:05:49', 0, 'read'),
(701, 3, 'Logged out', '2025-03-09 10:10:46', 0, 'read'),
(702, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 10:43:44', 0, 'read'),
(703, 3, 'Logged out', '2025-03-09 10:44:38', 0, 'read'),
(704, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 11:52:49', 0, 'read'),
(705, 3, 'Logged out', '2025-03-09 11:54:34', 0, 'read'),
(706, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 11:54:53', 0, 'read'),
(707, 3, 'Logged out', '2025-03-09 11:55:25', 0, 'read'),
(708, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 11:56:07', 0, 'read'),
(709, 3, 'Logged out', '2025-03-09 11:58:57', 0, 'read'),
(710, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 12:28:18', 0, 'read'),
(711, 3, 'Updated file (ID: 557) status from \'pending\' to \'approved\'', '2025-03-09 12:28:32', 0, 'read'),
(712, 3, 'Granted 123 points to user (ID: 163) for file type \'123\'', '2025-03-09 12:28:32', 0, 'read'),
(713, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 15:29:42', 0, 'read'),
(714, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:21', 0, 'read'),
(715, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:24', 0, 'read'),
(716, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:24', 0, 'read'),
(717, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:27', 0, 'read'),
(718, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:27', 0, 'read'),
(719, 3, 'Added 123 points for all users.', '2025-03-09 16:10:34', 0, 'read'),
(720, 3, 'Added 123 points for all users.', '2025-03-09 16:10:34', 0, 'read'),
(721, 3, 'Added 123 points for all users.', '2025-03-09 16:10:34', 0, 'read'),
(722, 3, 'Added 123 points for all users.', '2025-03-09 16:10:35', 0, 'read'),
(723, 3, 'Added 123 points for all users.', '2025-03-09 16:10:35', 0, 'read'),
(724, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:10:36', 0, 'read'),
(725, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:12:28', 0, 'read'),
(726, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:12:29', 0, 'read'),
(727, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:12:29', 0, 'read'),
(728, 3, 'Set the yearly reset date to: 2025-01-01', '2025-03-09 16:17:37', 0, 'read'),
(729, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:18:41', 0, 'read'),
(730, 3, 'Set the yearly reset date to: -01-01', '2025-03-09 16:18:41', 0, 'read'),
(731, 3, 'Set the yearly reset date to: 2025-04-00-01', '2025-03-09 16:21:40', 0, 'read'),
(732, 3, 'Set the yearly reset date to: 2025-04-00-01', '2025-03-09 16:21:47', 0, 'read'),
(733, 3, 'Set the yearly reset date to: 2025-04-01-01', '2025-03-09 16:21:55', 0, 'read'),
(734, 3, 'Set the yearly reset date to: 2025-05-01-01', '2025-03-09 16:22:01', 0, 'read'),
(735, 3, 'Set the yearly reset date to: 2025-04-01-01', '2025-03-09 16:22:06', 0, 'read'),
(736, 3, 'Set the yearly reset date to: 2025-08-01-01', '2025-03-09 16:22:30', 0, 'read'),
(737, 3, 'Set the yearly reset date to: 2025-08-01-01', '2025-03-09 16:22:30', 0, 'read'),
(738, 3, 'Set the yearly reset date to: 2025-06-01-01', '2025-03-09 16:22:36', 0, 'read'),
(739, 3, 'Set the yearly reset date to: 2025-02-01-01', '2025-03-09 16:22:41', 0, 'read'),
(740, 3, 'Updated file (ID: 558) status from \'pending\' to \'approved\'', '2025-03-09 16:28:13', 0, 'read'),
(741, 3, 'Granted 123 points to user (ID: 163) for file type \'123\'', '2025-03-09 16:28:13', 0, 'read'),
(742, 3, 'Added 123 points for all users.', '2025-03-09 16:35:19', 0, 'read'),
(743, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(744, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(745, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(746, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(747, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(748, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(749, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(750, 3, 'Added 123 points for all users.', '2025-03-09 16:35:20', 0, 'read'),
(751, 3, 'Added 123 points for all users.', '2025-03-09 16:35:21', 0, 'read'),
(752, 3, 'Added 123 points for all users.', '2025-03-09 16:35:21', 0, 'read'),
(753, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:25', 0, 'read'),
(754, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:26', 0, 'read'),
(755, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:26', 0, 'read'),
(756, 3, 'Rank points reset to 0 for all users.', '2025-03-09 16:35:30', 0, 'read'),
(757, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:31', 0, 'read'),
(758, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:31', 0, 'read'),
(759, 3, 'Rank points reset to 0 for all users.', '2025-03-09 16:35:32', 0, 'read'),
(760, 3, 'Added 12323 points for all users.', '2025-03-09 16:35:33', 0, 'read'),
(761, 3, 'Rank points reset to 0 for all users.', '2025-03-09 16:35:35', 0, 'read'),
(762, 3, 'Added 12354 points for all users.', '2025-03-09 16:36:55', 0, 'read'),
(763, 3, 'Added 12354 points for all users.', '2025-03-09 16:36:55', 0, 'read'),
(764, 3, 'Added 12354 points for all users.', '2025-03-09 16:36:56', 0, 'read'),
(765, 3, 'Rank points reset to 0 for all users.', '2025-03-09 17:00:17', 0, 'read'),
(766, 3, 'Added 123123 points for user: Amelia Claire Morgan', '2025-03-09 17:00:19', 0, 'read'),
(767, 3, 'Added 123123 points for user: Amelia Claire Morgan', '2025-03-09 17:00:20', 0, 'read'),
(768, 3, 'Added 123132 points for user: Alexanders Ryan Hughes', '2025-03-09 17:02:42', 0, 'read'),
(769, 3, 'Added 123132 points for user: Alexanders Ryan Hughes', '2025-03-09 17:02:43', 0, 'read'),
(770, 3, 'Added 123132 points for user: Alexanders Ryan Hughes', '2025-03-09 17:02:43', 0, 'read'),
(771, 3, 'Logged out', '2025-03-09 17:22:03', 0, 'read'),
(772, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 17:22:10', 0, 'read'),
(773, 3, 'Deleted user (ID: 55) - Username: Alexanders Ryan Hughes, Email: monde@mamon', '2025-03-09 17:51:08', 0, 'read'),
(774, 3, 'Logged out', '2025-03-09 17:52:10', 0, 'read'),
(775, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 18:01:56', 0, 'read'),
(776, 3, 'Logged out', '2025-03-09 18:37:29', 0, 'read'),
(777, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 18:43:44', 0, 'read'),
(778, 3, 'Updated email for user (ID: 158) from \'kevinbalocos@gmail.coma\' to \'kevinbalocos@gmail.com\'', '2025-03-09 20:20:24', 0, 'read'),
(779, 3, 'Updated user information (ID: 158) successfully.', '2025-03-09 20:20:24', 0, 'read'),
(780, 3, 'Logged out', '2025-03-09 20:23:55', 0, 'read'),
(781, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 20:33:51', 0, 'read'),
(782, 3, 'Logged out', '2025-03-09 20:33:56', 0, 'read'),
(783, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 20:36:31', 0, 'read'),
(784, 3, 'Logged out', '2025-03-09 20:37:03', 0, 'read'),
(785, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-09 20:39:40', 0, 'read'),
(786, 3, 'Logged out', '2025-03-09 20:39:54', 0, 'read'),
(787, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-10 07:08:01', 0, 'read'),
(788, 3, 'Updated email for user (ID: 51) from \'123@55232\' to \'ameliaClaire@gmail.com\'', '2025-03-10 07:09:56', 0, 'read'),
(789, 3, 'Updated user information (ID: 51) successfully.', '2025-03-10 07:09:56', 0, 'read'),
(790, 3, 'Logged out', '2025-03-10 07:10:12', 0, 'read'),
(791, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-10 09:26:12', 0, 'read'),
(792, 3, 'Bulk updated file types (IDs: 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113) to status: pending', '2025-03-10 11:03:18', 0, 'read'),
(793, 3, 'Bulk updated file types (IDs: 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114) to status: approved', '2025-03-10 15:02:11', 0, 'read'),
(794, 3, 'Updated file (ID: 560) status from \'pending\' to \'approved\'', '2025-03-10 17:45:19', 0, 'read'),
(795, 3, 'Granted 123 points to user (ID: 158) for file type \'123\'', '2025-03-10 17:45:19', 0, 'read'),
(796, 3, 'Sent message to Jade Kevin Balocos: \'Blurry\'', '2025-03-10 17:45:42', 0, 'read'),
(797, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-10 17:46:55', 0, 'unread'),
(798, 3, 'Logged out', '2025-03-10 18:00:08', 0, 'unread'),
(799, 3, 'Admin logged in (Admin ID: 3, Email: kevinbalocos@gmail.com)', '2025-03-10 18:02:22', 0, 'unread'),
(800, 3, 'Logged out', '2025-03-10 18:05:13', 0, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('sent','delivered','seen') DEFAULT 'sent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `status`) VALUES
(1, 88, 3, '123', '2025-02-02 21:19:03', 'sent'),
(2, 88, 3, '123', '2025-02-02 21:19:03', 'sent'),
(3, 88, 90, '123', '2025-02-02 21:19:16', 'sent'),
(4, 88, 88, '123', '2025-02-02 21:19:21', 'sent'),
(5, 88, 88, '123', '2025-02-02 21:19:36', 'sent'),
(6, 88, 56, '123', '2025-02-02 21:21:31', 'sent'),
(7, 88, 56, '123', '2025-02-02 21:21:31', 'sent'),
(8, 88, 88, '123', '2025-02-02 21:22:01', 'sent'),
(9, 88, 88, '123', '2025-02-02 21:25:12', 'sent'),
(10, 88, 88, '24', '2025-02-02 21:25:15', 'sent'),
(11, 88, 3, '123', '2025-02-02 21:25:26', 'sent'),
(12, 88, 3, '24', '2025-02-02 21:25:39', 'sent'),
(13, 88, 3, '24242', '2025-02-02 21:25:41', 'sent'),
(14, 88, 90, '242', '2025-02-02 21:25:55', 'sent'),
(15, 90, 88, '242', '2025-02-02 21:26:15', 'sent'),
(16, 88, 3, '123', '2025-02-02 21:30:37', 'sent'),
(17, 90, 3, '24', '2025-02-02 21:31:25', 'sent'),
(18, 90, 3, '123', '2025-02-02 21:31:40', 'sent'),
(19, 90, 88, '242', '2025-02-02 21:31:44', 'sent'),
(20, 90, 88, '123', '2025-02-02 21:32:01', 'sent'),
(21, 90, 88, '24', '2025-02-02 21:32:06', 'sent'),
(22, 90, 88, 'Hello bitch', '2025-02-02 21:32:16', 'sent'),
(23, 90, 88, 'asd', '2025-02-02 21:32:20', 'sent'),
(24, 90, 2, '123', '2025-02-02 21:33:35', 'sent'),
(25, 90, 90, '123', '2025-02-02 21:34:03', 'sent'),
(26, 90, 90, 'asd', '2025-02-02 21:34:09', 'sent'),
(27, 90, 88, 'aasd', '2025-02-02 21:34:24', 'sent'),
(28, 90, 88, '123', '2025-02-02 21:36:23', 'sent'),
(29, 90, 88, '123', '2025-02-02 21:37:04', 'sent'),
(30, 90, 88, '24', '2025-02-02 21:37:09', 'sent'),
(31, 90, 88, '24', '2025-02-02 21:37:09', 'sent'),
(32, 90, 88, 'asdadada', '2025-02-02 21:37:21', 'sent'),
(33, 90, 88, 'qweqew', '2025-02-02 21:37:53', 'sent'),
(34, 90, 88, 'HELLO', '2025-02-02 21:37:58', 'sent'),
(35, 90, 88, 'asd', '2025-02-02 21:38:38', 'sent'),
(36, 90, 88, 'BITCH', '2025-02-02 21:38:46', 'sent'),
(37, 90, 88, 'BITCH', '2025-02-02 21:38:47', 'sent'),
(38, 90, 88, 'asdad', '2025-02-02 21:38:52', 'sent'),
(39, 90, 88, '123', '2025-02-02 22:09:05', 'sent'),
(40, 90, 88, '5115', '2025-02-02 22:09:09', 'sent'),
(41, 90, 3, '24', '2025-02-02 22:11:11', 'sent'),
(42, 90, 3, '24', '2025-02-02 22:11:25', 'sent'),
(43, 90, 88, '123', '2025-02-02 22:23:46', 'sent'),
(44, 90, 88, 'asd', '2025-02-02 22:23:56', 'sent'),
(45, 90, 90, '123', '2025-02-02 22:28:56', 'sent'),
(46, 90, 2, '123', '2025-02-02 22:29:11', 'sent'),
(47, 90, 2, '123', '2025-02-02 22:29:14', 'sent'),
(48, 90, 88, '123', '2025-02-02 22:40:20', 'sent'),
(49, 90, 3, '123', '2025-02-02 22:40:24', 'sent'),
(50, 90, 3, '123', '2025-02-02 22:40:24', 'sent'),
(51, 90, 3, '24', '2025-02-02 22:40:26', 'sent'),
(52, 90, 3, '24', '2025-02-02 22:40:26', 'sent'),
(53, 90, 3, '2', '2025-02-02 22:40:29', 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `contact_frontpage`
--

CREATE TABLE `contact_frontpage` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_frontpage`
--

INSERT INTO `contact_frontpage` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(12, 'asdad', 'kevinbalocos@gmail.com', '123123', '2025-02-16 12:55:31'),
(13, 'asdad', 'kevinbalocos@gmail.com', '123', '2025-02-16 12:59:37'),
(14, '123', 'kevinbalocos@gmail.com', '123', '2025-02-16 12:59:40'),
(15, '123', 'kevinbalocos@gmail.com', '12313', '2025-02-16 12:59:43'),
(16, 'Jade Kevin Balocos', 'kevinbalocos@gmail.com', 'This system is very good', '2025-02-16 13:03:50'),
(17, 'Richmond Besmonte', 'kevinbalocos@gmail.com', 'kevin', '2025-02-16 13:09:48'),
(18, 'Jade Kevin Balocos', 'kevinbalocos@gmail.com', 'ASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDDASDSADADSADADASDD', '2025-03-09 20:39:06'),
(19, 'asd', 'kevinbalocos@gmail.com', '123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123123', '2025-03-09 20:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
(3, 'Arts and Science'),
(5, 'College of Business and Accountancy'),
(2, 'College of Computer Studies'),
(4, 'College Of Education'),
(6, 'College of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_faculties`
--

CREATE TABLE `faculty_faculties` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_faculties`
--

INSERT INTO `faculty_faculties` (`id`, `faculty_name`) VALUES
(1, 'asdad');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_manual`
--

CREATE TABLE `faculty_manual` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `points` float DEFAULT NULL,
  `max_points` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_ranks`
--

CREATE TABLE `faculty_ranks` (
  `id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_ranks`
--

INSERT INTO `faculty_ranks` (`id`, `rank_name`) VALUES
(4, '123'),
(2, '1231'),
(1, 'asdads');

-- --------------------------------------------------------

--
-- Table structure for table `file_submissions`
--

CREATE TABLE `file_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `submitted_at` datetime NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `next_rank_label` varchar(255) DEFAULT NULL,
  `next_rank_order` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_submissions`
--

INSERT INTO `file_submissions` (`id`, `user_id`, `file_path`, `label`, `submitted_at`, `approved`, `next_rank_label`, `next_rank_order`) VALUES
(149, 158, 'uploads/rank_requirements_faculty/pakyusad.jpg', 'BS/AB with Government Examination with Complete Academic Requirements, no thesis', '2025-03-05 19:56:12', 1, 'BS/AB with Full MA', 'Assistant Professor I'),
(154, 158, 'uploads/rank_requirements_faculty/authentication2.jpg', 'BS/AB with Full MA', '2025-03-10 09:22:36', 1, 'Full MA with Government', 'Assistant Professor II'),
(155, 158, 'uploads/rank_requirements_faculty/RANKINGsystemicon.jpg', 'Full MA with Government', '2025-03-10 09:27:03', 1, 'Full MA with 3-15 Doctoral Units', 'Associate Professor I'),
(156, 158, 'uploads/rank_requirements_faculty/authentication4.jpg', 'Full MA with 3-15 Doctoral Units', '2025-03-10 09:29:58', 1, 'Full MA with 18-30 Doctoral Units', 'Associate Professor II'),
(157, 158, 'uploads/rank_requirements_faculty/authentication.jpg', 'Full MA with 18-30 Doctoral Units', '2025-03-10 09:35:07', 0, 'Full MA with 33-45 Doctoral Units', 'Associate Professor III');

-- --------------------------------------------------------

--
-- Table structure for table `file_types`
--

CREATE TABLE `file_types` (
  `id` int(11) NOT NULL,
  `category` enum('General','Mandatory','Yearly') NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `points` int(11) DEFAULT 0,
  `status` enum('pending','approved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_types`
--

INSERT INTO `file_types` (`id`, `category`, `type_name`, `points`, `status`) VALUES
(103, 'General', '123', 123, 'approved'),
(104, 'General', '123', 123, 'approved'),
(105, 'Mandatory', '51', 123, 'approved'),
(106, 'Yearly', '523', 23, 'approved'),
(107, 'General', '123', 123, 'approved'),
(108, 'General', '141', 123, 'approved'),
(109, 'General', '151', 123, 'approved'),
(110, 'General', '1123', 123, 'approved'),
(111, 'General', '123', 154, 'approved'),
(112, 'General', '123', 154, 'approved'),
(113, 'General', '123', 123, 'approved'),
(114, 'General', '123', 123, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` datetime DEFAULT current_timestamp(),
  `message_rankingtask` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_faculty_rankup`
--

CREATE TABLE `notifications_faculty_rankup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications_faculty_rankup`
--

INSERT INTO `notifications_faculty_rankup` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(10, 88, 'Your file submission has been declined.', 'unread', '2025-02-14 23:47:29'),
(12, 163, 'Your file submission has been declined.', 'read', '2025-03-01 06:15:59'),
(13, 163, 'Your file submission has been declined.', 'read', '2025-03-01 06:16:02'),
(14, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:31:56'),
(15, 163, 'Your file submission has been declined.', 'read', '2025-03-01 06:32:29'),
(16, 163, 'Your file submission has been declined.', 'read', '2025-03-01 06:32:32'),
(17, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:34:53'),
(18, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:35:07'),
(19, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:39:04'),
(20, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:39:59'),
(21, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-01 06:41:37'),
(23, 163, 'Your file has been approved, and you\'ve been awarded 1000 points. Your rank has been updated!', 'read', '2025-03-08 14:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_requirements`
--

CREATE TABLE `notifications_requirements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications_requirements`
--

INSERT INTO `notifications_requirements` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(157, 158, 'Your 123 file has been approved.', 'unread', '2025-03-10 09:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `notification_message_the_user`
--

CREATE TABLE `notification_message_the_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_message_the_user`
--

INSERT INTO `notification_message_the_user` (`id`, `user_id`, `message`, `created_at`, `status`) VALUES
(97, 158, 'Blurry', '2025-03-10 09:45:42', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `notif_rankingtask`
--

CREATE TABLE `notif_rankingtask` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notif_rankingtask`
--

INSERT INTO `notif_rankingtask` (`id`, `message`, `created_at`) VALUES
(52, 'Yearly points reset to 0.', '2025-02-25 20:23:08'),
(53, 'Yearly points reset to 0.', '2025-02-25 20:26:50'),
(54, 'Yearly points reset to 0.', '2025-02-25 20:31:37'),
(55, 'Yearly points reset to 0.', '2025-02-25 20:31:46'),
(56, 'Yearly points reset to 0.', '2025-02-25 20:44:53'),
(57, 'Yearly points reset to 0.', '2025-02-25 20:45:02'),
(58, 'Yearly points reset to 0.', '2025-02-25 20:45:15'),
(59, 'Yearly points reset to 0.', '2025-03-01 19:51:20'),
(60, 'Yearly points reset to 0.', '2025-03-02 09:03:19'),
(61, 'Yearly points reset to 0.', '2025-03-09 16:10:23'),
(62, 'Yearly points reset to 0.', '2025-03-09 16:10:26'),
(63, 'Yearly points reset to 0.', '2025-03-09 16:10:29'),
(64, 'Yearly points reset to 0.', '2025-03-09 16:10:38'),
(65, 'Yearly points reset to 0.', '2025-03-09 16:12:31'),
(66, 'Yearly points reset to 0.', '2025-03-09 16:17:40'),
(67, 'Yearly points reset to 0.', '2025-03-09 16:18:44'),
(68, 'Yearly points reset to 0.', '2025-03-09 16:21:42'),
(69, 'Yearly points reset to 0.', '2025-03-09 16:21:50'),
(70, 'Yearly points reset to 0.', '2025-03-09 16:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `rankbytask_notifications`
--

CREATE TABLE `rankbytask_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `name`) VALUES
(6, 'Assistant Professor I'),
(7, 'Assistant Professor II'),
(8, 'Associate Professor I'),
(9, 'Associate Professor II'),
(10, 'Associate Professor III'),
(11, 'Associate Professor IV'),
(3, 'Instructor I'),
(4, 'Instructor II'),
(5, 'Instructor III'),
(12, 'Professor I'),
(13, 'Professor II');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `reset_date` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `reset_date`, `updated_at`) VALUES
(1, '2026-01-01', '2025-03-09 08:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `user_id` int(255) NOT NULL,
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_for` varchar(255) NOT NULL DEFAULT '',
  `owner` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Not Started',
  `due_date` date NOT NULL,
  `modification_count` varchar(255) DEFAULT NULL,
  `created_at` time DEFAULT NULL,
  `task_points` int(11) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`user_id`, `id`, `task_name`, `task_for`, `owner`, `status`, `due_date`, `modification_count`, `created_at`, `task_points`) VALUES
(0, 225, 'TASK 1', '93', 'OWNER 1', 'Not Started', '2025-01-30', NULL, '10:24:15', 100);

-- --------------------------------------------------------

--
-- Table structure for table `userrequirements`
--

CREATE TABLE `userrequirements` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `uploaded_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','approved','denied') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `approved_general` int(11) DEFAULT 0,
  `approved_mandatory` int(11) DEFAULT 0,
  `approved_yearly` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrequirements`
--

INSERT INTO `userrequirements` (`id`, `user_id`, `file_name`, `file_path`, `file_type`, `uploaded_at`, `updated_at`, `status`, `created_at`, `approved_general`, `approved_mandatory`, `approved_yearly`) VALUES
(560, 158, '1741590137_authentication2.jpg', 'uploads/requirements/1741590137_authentication2.jpg', '123', '2025-03-10 15:02:17', '2025-03-10 17:45:19', 'approved', '2025-03-10 15:02:17', 0, 0, 0),
(561, 158, '1741590142_RANKINGsystemicon.jpg', 'uploads/mandatory_requirements/1741590142_RANKINGsystemicon.jpg', '51', '2025-03-10 15:02:22', NULL, 'pending', '2025-03-10 15:02:22', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(22) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNo` varchar(100) DEFAULT '',
  `gender` varchar(100) DEFAULT NULL,
  `birth_date` datetime(6) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `uploaded_profile_image` varchar(255) DEFAULT NULL,
  `profile_progress` float DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `points` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rank` varchar(255) DEFAULT 'Instructor I',
  `faculty` varchar(100) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `address`, `phoneNo`, `gender`, `birth_date`, `profile_image`, `uploaded_profile_image`, `profile_progress`, `role`, `points`, `rank`, `faculty`, `status`, `created_at`) VALUES
(51, 'Amelia Claire Morgan', 'ameliaClaire@gmail.com', '$2y$10$zdFL.1QCl9FHwCMIF3NDpOZmOMJ3mClP0A7OYG4Q6c8ZSeLIq71EO', '1232', '09054651578123', 'male', '2023-12-20 00:00:00.000000', NULL, NULL, NULL, 'user', 246246.00, '123', 'College of Computer Studies', 'approved', '2025-02-01 12:27:20'),
(62, 'Samuel Lucas Bailey', '123123123@123123123', '$2y$10$sL319MarmLAPM6p5HcCZeeUIu2RzjdHJ.oYm5Ok1FP2.czD1kDsT.', '123', '123112123', 'male', '2024-12-12 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, NULL, 'College of Computer Studies', 'rejected', '2025-02-01 12:27:20'),
(63, 'Ethan Thomas Ramirez', 'ethan@gmail.com', '$2y$10$chAZniKQG99EjQ9B/d6IL.FQlYDqI7o6GZuu07OAlYjNfL//7QxMe', '123', '2147483647', 'male', '2024-12-14 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, NULL, 'College of Computer Studies', 'rejected', '2025-02-01 12:27:20'),
(90, '24@24', '24@24', '$2y$10$P1bhhlbVLNimtVIjHRSMUe1UOzpbdZ6aLN5C8p9PHIklu/q40akyi', '123', '905465', 'male', '2025-01-31 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'approved', '2025-02-01 12:27:20'),
(123, '12@12', '12@12', '$2y$10$oyiU/9625.iATXkR6LFNdOjlKRE4h3mLdcTbOhVh5aDcCe6cjfKje', '123', '2147483647', 'male', '2025-01-25 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor II', 'College of Computer Studies', 'approved', '2025-02-01 12:27:20'),
(158, 'Jade Kevin Balocos', 'kevinbalocos@gmail.com', '$2y$10$lUV921olKq83AF.cgd79UO9v5bMOQRuyTxYoJN761TRB7pczeTy3S', 'San Pablo City, Laguna', '09054651578', 'Male', '2003-06-26 00:00:00.000000', NULL, 'uploads/profile_images/67ce46dfd5551.jpg', NULL, 'user', 3123.00, 'Associate Professor II', 'College of Computer Studies', 'approved', '2025-02-15 20:58:02'),
(159, '123123', 'kasdadsadadadasdsadad@gmail.com', '$2y$10$IL0bXLXPm4jCHBKirafFyep4Yo0jny/BViL8ByHYIVVS5YS6YhvXa', '123123', '123', 'Male', '2025-02-21 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Assistant Professor I', 'College of Computer Studies', 'approved', '2025-02-15 21:01:25'),
(160, '12313', '123132@yahoo.com', '$2y$10$WrQKvZSTu/eYVJqvsa1xUeC4rCCr9mQBwlMxYBJ/2xqbof1Dn0A.a', '1231', '123', 'Male', '2025-02-07 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Assistant Professor II', 'College of Computer Studies', 'approved', '2025-02-15 21:05:34'),
(161, '123123123', 'asjdajdjajd@gmai.comn', '$2y$10$p21P7ALXxHpQOBSocGhGsOVag/ZM6JmkY2WVvFYUqYPAAmj6iUVP6', '123123', '123', 'Male', '2025-02-01 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Associate Professor I', 'College of Computer Studies', 'approved', '2025-02-15 21:06:18'),
(162, 'kevin', 'kevinbalocos03@gmail.com', '$2y$10$XsqMKjd7JGdVqybXwygzd.BkXjHyJCGkIx.CqaascZ8ZsS8iIDDBW', '123', '123', 'Male', '2025-02-02 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Associate Professor II', 'College of Computer Studies', 'approved', '2025-02-16 09:38:35'),
(164, '123123@123', '123@123213.com', '$2y$10$INApBXBjtmCgEImeo3El6uU38X4nYkt4pVJ5LMPkgQmoEHOCPMp9S', '123', '2147483647', 'Female', '2003-11-14 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Associate Professor IV', 'College of Computer Studies', 'approved', '2025-02-16 10:28:04'),
(165, '12313', '123@123123.com', '$2y$10$i3XagZ4UmuiZboie2bBwfeBn8wb2RmZWJxFRjVx3rHRylYLMU/T5a', '123', '123', 'Male', '2025-02-26 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Professor I', 'College of Computer Studies', 'approved', '2025-02-16 10:29:26'),
(166, '123@123', '123123@123.com', '$2y$10$3pIegQjlvZy02AOn0DpN6.eY0EF/HmBqFgDjizPabO4vBct9t8l8C', '123123', '123123515', 'male', '2025-02-12 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'approved', '2025-02-16 10:30:30'),
(167, 'jade', 'kevinbalocos123@gmail.com', '$2y$10$zjU44d88IzsezfWID3.EQ.vFCzPqWCcWMmUgANVQL/Pg7BYEGUnKe', 'TAGAdiyanlang', '2147483647', 'Male', '2025-02-05 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'approved', '2025-02-17 18:16:32'),
(168, 'asd', 'asdasd@gmail.com', '$2y$10$VSpWtDmSHk96u3fVR8bXaON7YtgDz8/TIjPOP8kFiUssX4OliHrNi', 'asd', '0', 'Male', '2025-02-20 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'rejected', '2025-02-18 19:07:57'),
(169, '123', '123@gmail.com', '$2y$10$yFCVGgiCF8MOv9T4z9FeYuM9TpVUtYo6V9ltLp8bI2ykr8IXodH1u', '123', '123', 'Male', '2025-02-13 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'pending', '2025-02-18 19:08:25'),
(170, '13212313', '123123313@123123.com', '$2y$10$Czr0TgxNxhtsXb517dpSjuwctlgEKWGATTcu.xv3ba4KK207gOJMq', '123123', '2147483647', 'Male', '2003-08-16 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'rejected', '2025-02-18 19:27:08'),
(171, '13212313', '123123313@123123.com', '$2y$10$gsGZydjJciPonC0k.nNfE.3vR1pw.wHYJer1BotOYxYKTd0yCegMi', '123123', '2147483647', 'Male', '2003-08-16 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'pending', '2025-02-18 19:27:08'),
(172, 'Jade Kevin Balocos', 'kevinbalocos1@gmail.com', '$2y$10$eH3j9hC7HFVzXFW1R6mr2OcVnzzUq8kXq93VB4plfOZyA31xcF802', 'TAGAdiyanlang', '2147483647', 'Male', '2003-08-16 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'rejected', '2025-02-26 19:58:28'),
(173, 'jade', 'kevinbalocos123s@gmail.com', '$2y$10$c9mVyDJhEs8Dln5vKdxmmOm/OO7XU4oXkBZxiuQm9a/otJa9pwwWu', '123', '2147483647', 'Male', '2003-08-16 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'pending', '2025-03-01 08:03:03'),
(174, 'asdasd', 'kevinbalocoss03@gmail.com', '$2y$10$muDbezPvddMHUN/xCErAAOxEv3SwHi/hcYblQM4Hf7IZd4aDe9SiW', 'asdad', '9054651578', 'Male', '2003-03-13 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'pending', '2025-03-01 08:08:02'),
(175, 'qweqe', 'qweqeqeqe@gmai.com', '$2y$10$D07xKNchw.jfFLV9e0WJFe.BE3ZsuYScUXg3P3oOneb21WBEleVRC', 'San Pablo City, Laguna', '09054651578', 'Male', '2003-05-15 00:00:00.000000', NULL, NULL, NULL, 'user', 0.00, 'Instructor I', 'College of Computer Studies', 'pending', '2025-03-01 08:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_rank_history`
--

CREATE TABLE `user_rank_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_uploadedtask`
--

CREATE TABLE `user_uploadedtask` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_at` datetime DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attendance_notifications`
--
ALTER TABLE `attendance_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_frontpage`
--
ALTER TABLE `contact_frontpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `faculty_faculties`
--
ALTER TABLE `faculty_faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculty_name` (`faculty_name`);

--
-- Indexes for table `faculty_manual`
--
ALTER TABLE `faculty_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_ranks`
--
ALTER TABLE `faculty_ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rank_name` (`rank_name`);

--
-- Indexes for table `file_submissions`
--
ALTER TABLE `file_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_submissions_ibfk_1` (`user_id`);

--
-- Indexes for table `file_types`
--
ALTER TABLE `file_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications_faculty_rankup`
--
ALTER TABLE `notifications_faculty_rankup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_requirements`
--
ALTER TABLE `notifications_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification_message_the_user`
--
ALTER TABLE `notification_message_the_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notif_rankingtask`
--
ALTER TABLE `notif_rankingtask`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rankbytask_notifications`
--
ALTER TABLE `rankbytask_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrequirements`
--
ALTER TABLE `userrequirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rank_history`
--
ALTER TABLE `user_rank_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_uploadedtask`
--
ALTER TABLE `user_uploadedtask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance_notifications`
--
ALTER TABLE `attendance_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=801;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `contact_frontpage`
--
ALTER TABLE `contact_frontpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `faculty_faculties`
--
ALTER TABLE `faculty_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_manual`
--
ALTER TABLE `faculty_manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_ranks`
--
ALTER TABLE `faculty_ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_submissions`
--
ALTER TABLE `file_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `file_types`
--
ALTER TABLE `file_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `notifications_faculty_rankup`
--
ALTER TABLE `notifications_faculty_rankup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications_requirements`
--
ALTER TABLE `notifications_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `notification_message_the_user`
--
ALTER TABLE `notification_message_the_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `notif_rankingtask`
--
ALTER TABLE `notif_rankingtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `rankbytask_notifications`
--
ALTER TABLE `rankbytask_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `userrequirements`
--
ALTER TABLE `userrequirements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=562;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `user_rank_history`
--
ALTER TABLE `user_rank_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_uploadedtask`
--
ALTER TABLE `user_uploadedtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `file_submissions`
--
ALTER TABLE `file_submissions`
  ADD CONSTRAINT `file_submissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications_requirements`
--
ALTER TABLE `notifications_requirements`
  ADD CONSTRAINT `notifications_requirements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_message_the_user`
--
ALTER TABLE `notification_message_the_user`
  ADD CONSTRAINT `notification_message_the_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rankbytask_notifications`
--
ALTER TABLE `rankbytask_notifications`
  ADD CONSTRAINT `rankbytask_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_rank_history`
--
ALTER TABLE `user_rank_history`
  ADD CONSTRAINT `user_rank_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_uploadedtask`
--
ALTER TABLE `user_uploadedtask`
  ADD CONSTRAINT `user_uploadedtask_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
