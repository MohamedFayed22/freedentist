-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 03:29 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentist`
--

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dgree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital` int(11) NOT NULL,
  `nationality` int(11) DEFAULT NULL,
  `nation_id` int(11) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`id`, `mobile`, `email`, `password`, `gender`, `photo`, `profile_photo`, `name`, `dgree`, `hospital`, `nationality`, `nation_id`, `birthdate`, `remember_token`, `created_at`, `updated_at`, `otp`) VALUES
(1, '011155560', 'n.oun@nexusacademy.com', '$2y$10$473drbamYTQ0JtoVtEJuR.cPstGctH5aDJPlDZJfZwmXChXwkdIvS', 'Male', '1560610981.jpg', '1560610981.jpg', 'ahmed', '2', 2, 1, 552, '1986-03-05', NULL, '2019-06-15 13:03:01', '2019-06-15 13:03:01', 0),
(3, '12345', 'noha@superaqar.com', '$2y$10$hRMktU0bLZDtRMd8XZEQ8.vkMB/VB3GdxSnZSXoXMIncS2hTHC98G', 'FeMale', 'default.png', 'default.png', 'Noda', '5', 1, 2, 1123, '2000-06-25', NULL, '2019-06-24 18:23:50', '2019-06-24 18:23:50', 0),
(4, '0101100', 'reham@yahoo.com', '$2y$10$9kXRi7bOWwNFZxIOSKRA5.9zJpKLMjysYzvJ5TgPXSz2lqIj23gcS', 'FeMale', 'default.png', 'default.png', 'reham', '4', 2, 2, 1111, '2019-06-05', NULL, '2019-06-25 14:09:18', '2019-06-25 14:09:18', 0),
(5, '5455', 'zalat@yahoo.com', '$2y$10$YTeYxYJiQjx4.Om4JGiw9uZSEVU0bGD8vUd.hYnpxObHqa8vKjFTe', 'FeMale', 'default.png', 'default.png', 'zalat', 'asa', 2, 2, 2, '2019-07-30', NULL, '2019-07-04 06:15:27', '2019-07-04 06:15:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dentist_calanders`
--

CREATE TABLE `dentist_calanders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dentist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dentist_calanders`
--

INSERT INTO `dentist_calanders` (`id`, `hospital_id`, `service_id`, `start_date`, `end_date`, `day`, `start_time`, `end_time`, `created_at`, `updated_at`, `dentist_id`) VALUES
(1, 2, 1, '2019-06-15 00:00:00', '2019-06-15 00:00:00', 'Sunday', '00:00:00', '00:00:00', '2019-06-15 16:40:10', '2019-06-15 16:40:10', 1),
(2, 1, 1, '2019-06-23 00:00:00', '2019-06-25 00:00:00', 'Monday', '01:00:00', '02:00:00', '2019-06-23 10:52:42', '2019-06-23 10:52:42', 1),
(3, 1, 1, '2019-06-23 00:00:00', '2019-06-27 00:00:00', 'Sunday', '06:00:00', '08:00:00', '2019-06-23 10:52:42', '2019-06-23 10:52:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `dentist_id` int(11) DEFAULT NULL,
  `treatment_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_diseases` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diseases` text COLLATE utf8mb4_unicode_ci,
  `is_drugs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drugs` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 pending/ 1 confirm / 3cancel',
  `event_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` int(11) DEFAULT '0' COMMENT '1 follower',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `dentist_id`, `treatment_id`, `hospital_id`, `photo`, `is_diseases`, `diseases`, `is_drugs`, `drugs`, `status`, `event_date`, `created_at`, `updated_at`, `follower_id`, `reason`, `relation`, `start_time`, `end_time`, `description`, `day`) VALUES
(1, 1, 1, 1, 2, '', 'yes', 'dwfewf fvgeg tr', 'No', '', 0, '2019-06-18', NULL, NULL, NULL, NULL, NULL, '00:00:00', '00:00:00', '', ''),
(2, 8, 5, 1, 1, '', 'No', '', 'No', '', 0, '2019-06-18', NULL, NULL, 2, NULL, NULL, '00:00:00', '00:00:00', '', ''),
(3, 1, NULL, 1, 1, '1561368709.jpeg', '0', 'ddd', '0', 'Vitamines', 0, '2019-06-23', '2019-06-24 07:31:49', '2019-06-24 07:31:49', 2, NULL, 0, '201:00:00', '02:00:00', NULL, 'Monday'),
(4, 5, NULL, 1, 1, NULL, 'No', NULL, 'Yes', 'Vitamines', 0, '2019-06-23', '2019-06-24 18:13:15', '2019-06-24 18:13:15', NULL, NULL, 0, '201:00:00', '02:00:00', NULL, 'Monday'),
(5, 8, 5, 1, 1, NULL, 'Yes', NULL, 'Yes', NULL, 3, '2019-07-06', '2019-06-27 16:40:53', '2019-07-04 19:05:06', NULL, NULL, 0, '201:00:00', '02:00:00', NULL, 'Monday');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `name`, `nationality`, `birthdate`, `gender`, `created_at`, `updated_at`, `user_id`, `relation`) VALUES
(1, 'Somia', NULL, '2019-04-02', NULL, '2019-06-15 13:00:19', '2019-06-16 06:11:33', NULL, ''),
(2, 'ahmed Amin', NULL, '1986-03-05', 'Male', '2019-06-15 13:01:18', '2019-06-15 13:01:18', NULL, 'Brother'),
(3, 'MAjed', 1, '1986-03-05', 'Male', '2019-06-16 11:59:18', '2019-06-16 11:59:18', 1, 'Friend'),
(4, 'Mohamed', NULL, '1986-03-05', 'Male', '2019-06-24 18:10:24', '2019-06-24 18:10:24', 5, 'Father');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_address_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_address_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `req_map_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_location` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hospital_name_ar`, `hospital_name_en`, `hospital_address_ar`, `hospital_address_en`, `created_at`, `updated_at`, `req_map_location`, `req_location`) VALUES
(1, 'مستشفى الالماني السعودي', 'German', 'مستشفى الالماني السعودي', 'مستشفى الالماني السعودي', NULL, '2019-06-20 12:57:58', '26.4214,50.0812', NULL),
(2, '', 'Faisal', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lexx_messages`
--

CREATE TABLE `lexx_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lexx_messages`
--

INSERT INTO `lexx_messages` (`id`, `thread_id`, `user_id`, `type`, `body`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 0, 'asdas', '2019-07-04 17:42:40', '2019-07-04 17:42:40', NULL),
(2, 1, 8, 0, 'dsfsdfds', '2019-07-04 17:47:29', '2019-07-04 17:47:29', NULL),
(4, 3, 5, 1, 'مرحبا بك يمكنك بدأ المحادثة', '2019-07-04 19:05:06', '2019-07-04 19:05:06', NULL),
(5, 3, 5, 1, 'sasdas', '2019-07-04 21:31:58', '2019-07-04 21:31:58', NULL),
(6, 3, 8, 2, 'sdasd', '2019-07-04 21:32:11', '2019-07-04 21:32:11', NULL),
(7, 3, 8, 2, 'sdsd', '2019-07-04 21:32:27', '2019-07-04 21:32:27', NULL),
(8, 3, 8, 2, 'sdad', '2019-07-04 21:32:39', '2019-07-04 21:32:39', NULL),
(9, 3, 5, 1, 'dsad', '2019-07-04 21:37:50', '2019-07-04 21:37:50', NULL),
(10, 3, 5, 1, 'sfsdf', '2019-07-04 21:45:32', '2019-07-04 21:45:32', NULL),
(11, 3, 8, 2, '555555', '2019-07-04 21:46:07', '2019-07-04 21:46:07', NULL),
(12, 3, 8, 2, 'rwerw', '2019-07-04 22:03:16', '2019-07-04 22:03:16', NULL),
(13, 3, 8, 2, '55555', '2019-07-04 23:04:26', '2019-07-04 23:04:26', NULL),
(14, 3, 8, 2, 'rterter', '2019-07-04 23:06:47', '2019-07-04 23:06:47', NULL),
(15, 3, 5, 1, 'dsfsdfs', '2019-07-04 23:08:28', '2019-07-04 23:08:28', NULL),
(16, 3, 5, 1, 'ser', '2019-07-04 23:08:39', '2019-07-04 23:08:39', NULL),
(17, 3, 8, 2, '666', '2019-07-04 23:17:48', '2019-07-04 23:17:48', NULL),
(18, 3, 8, 2, 'sdsdfsd', '2019-07-04 23:22:39', '2019-07-04 23:22:39', NULL),
(19, 3, 5, 1, 'dgdsfs', '2019-07-04 23:22:53', '2019-07-04 23:22:53', NULL),
(20, 3, 5, 1, 'dfsfsd', '2019-07-04 23:23:02', '2019-07-04 23:23:02', NULL),
(21, 3, 8, 2, 'reter', '2019-07-04 23:27:06', '2019-07-04 23:27:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lexx_participants`
--

CREATE TABLE `lexx_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lexx_participants`
--

INSERT INTO `lexx_participants` (`id`, `thread_id`, `user_id`, `type`, `last_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 0, '2019-07-04 17:47:29', '2019-07-04 17:42:40', '2019-07-04 17:47:29', NULL),
(2, 1, 1, 0, NULL, '2019-07-04 17:42:40', '2019-07-04 17:42:40', NULL),
(4, 3, 8, 2, '2019-07-04 23:27:06', '2019-07-04 19:05:06', '2019-07-04 23:27:06', NULL),
(5, 3, 5, 1, '2019-07-04 23:23:02', '2019-07-04 19:05:06', '2019-07-04 23:23:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lexx_threads`
--

CREATE TABLE `lexx_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `starred` tinyint(1) NOT NULL DEFAULT '0',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Unique slug for social media sharing. MD5 hashed string',
  `max_participants` int(11) DEFAULT NULL COMMENT 'Max number of participants allowed',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Profile picture for the conversation',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lexx_threads`
--

INSERT INTO `lexx_threads` (`id`, `starred`, `subject`, `slug`, `max_participants`, `start_date`, `end_date`, `avatar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'sdasd', NULL, NULL, '2019-06-30 22:00:00', NULL, NULL, '2019-07-04 17:42:40', '2019-07-04 17:47:29', NULL),
(3, 0, 'محادثة دكتور zalat', NULL, NULL, '2019-07-04 19:05:06', '2019-07-05 22:00:00', NULL, '2019-07-04 19:05:06', '2019-07-04 23:27:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2019_06_03_123303_create_users_table', 1),
(16, '2019_06_11_111128_create_dentists_table', 1),
(17, '2019_06_11_130617_create_nationalities_table', 1),
(19, '2019_06_11_231655_create_hospitals_table', 1),
(23, '2019_06_12_142032_create_services_table', 2),
(24, '2019_06_12_142629_create_offers_table', 2),
(30, '2019_06_11_145013_create_events_table', 3),
(31, '2019_06_15_154109_create_treatments_table', 3),
(32, '2019_06_15_154347_create_dentist_calanders_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nationality_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `nationality_name_ar`, `nationality_name_en`, `created_at`, `updated_at`) VALUES
(1, 's', 'Saudi', NULL, NULL),
(2, '', 'Egyptian', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `photo`, `link`, `created_at`, `updated_at`) VALUES
(1, '1561043216.jpeg', 'zxc', '2019-06-20 13:06:56', '2019-06-20 13:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('eng.nohaoun@yahoo.com', '$2y$10$1U0mMOSsJke5emA41EzwCujSEWKjJE8MTW6fXYe0DRxGoArlxwQ5i', '2019-07-01 13:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `per_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `per_name`) VALUES
(1, 'showuser'),
(2, 'adduser'),
(3, 'edituser'),
(4, 'deleteuser'),
(5, 'showoffer'),
(6, 'addoffer'),
(7, 'editoffer'),
(8, 'deleteoffer'),
(9, 'showhospital'),
(10, 'addhospital'),
(11, 'edithospital'),
(12, 'deletehospital'),
(13, 'showservice'),
(14, 'addservice'),
(15, 'editservice'),
(16, 'deleteservice'),
(26, 'showcontact'),
(27, 'showcomment'),
(28, 'editcomment'),
(29, 'approvecomment'),
(30, 'deletecomment'),
(31, 'showclient'),
(32, 'addclient'),
(33, 'editclient'),
(34, 'deleteclient'),
(35, 'permission'),
(36, 'addcontact'),
(37, 'showorder'),
(38, 'editorder'),
(39, 'deleteorder'),
(40, 'showslider'),
(41, 'addslider'),
(42, 'editslider'),
(43, 'deleteslider'),
(44, 'showlaundry'),
(45, 'addlaundry'),
(46, 'editlaundry'),
(47, 'deletelaundry'),
(48, 'showlaundryrequest'),
(49, 'editlaundryrequest'),
(50, 'deletelaundryrequest'),
(51, 'showbankaccount'),
(52, 'addbankaccount'),
(53, 'editbankaccount'),
(54, 'deletebankaccount'),
(55, 'transfer_info');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`id`, `user_id`, `permission_id`, `updated_at`, `created_at`) VALUES
(958, 2, 5, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(959, 2, 9, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(960, 2, 10, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(961, 2, 11, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(962, 2, 13, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(963, 2, 17, '2019-03-19 08:24:51', '2019-03-19 08:24:51'),
(1120, 2, 1, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1121, 2, 2, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1122, 2, 3, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1123, 2, 4, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1124, 2, 5, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1125, 2, 6, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1126, 2, 7, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1127, 2, 8, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1128, 2, 9, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1129, 2, 10, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1130, 2, 11, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1131, 2, 12, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1132, 2, 13, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1133, 2, 14, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1134, 2, 15, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1135, 2, 16, '2019-04-04 03:42:41', '2019-04-04 03:42:41'),
(1136, 2, 17, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1137, 2, 18, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1138, 2, 19, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1139, 2, 20, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1140, 2, 21, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1141, 2, 22, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1142, 2, 23, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1143, 2, 24, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1144, 2, 25, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1145, 2, 26, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1146, 2, 36, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1147, 2, 27, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1148, 2, 29, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1149, 2, 28, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1150, 2, 30, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1151, 2, 31, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1152, 2, 32, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1153, 2, 33, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1154, 2, 34, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1155, 2, 37, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1156, 2, 38, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1157, 2, 39, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1158, 2, 55, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1159, 2, 40, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1160, 2, 41, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1161, 2, 42, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1162, 2, 43, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1163, 2, 44, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1164, 2, 45, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1165, 2, 46, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1166, 2, 47, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1167, 2, 48, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1168, 2, 49, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1169, 2, 50, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1170, 2, 51, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1171, 2, 52, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1172, 2, 53, '2019-04-04 03:42:42', '2019-04-04 03:42:42'),
(1173, 2, 54, '2019-04-04 03:42:42', '2019-04-04 03:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name_ar`, `service_name_en`, `created_at`, `updated_at`) VALUES
(1, '', 'حشوات', NULL, NULL),
(2, 'علاج لثة', 'علاج لثة', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `treatment_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `treatment_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`id`, `treatment_name_ar`, `treatment_name_en`, `created_at`, `updated_at`) VALUES
(1, 'حشوات', 'حشوات', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT '0',
  `birthdate` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `nationality`, `admin`, `birthdate`, `gender`, `remember_token`, `created_at`, `updated_at`, `otp`) VALUES
(1, 'Noha', '011155520', 'eng.nohaoun@yahoo.com', '$2y$10$473drbamYTQ0JtoVtEJuR.cPstGctH5aDJPlDZJfZwmXChXwkdIvS', 2, 2, '2019-04-02', 'Male', NULL, '2019-06-15 13:00:19', '2019-06-25 14:10:30', 0),
(2, 'ahmed', '55', 'admin@yahoo.com', '$2y$10$ftySR4HF9h0Qp8LtvSckcusBu5ib8gn8tGyGEENtwX4dLMu5JWTPy', NULL, 0, '1986-03-05', 'Male', NULL, '2019-06-15 13:01:18', '2019-06-15 13:01:18', 0),
(3, 'moosa', '0540237587', 'moosabukhamsin@gmail.com', '$2y$10$rFOuWD63QYI8GK.GkjuDS.s.6KXnf8TxQEce/Oa3py6FhjiYJJKWC', NULL, 2, '2019-06-04', 'Male', NULL, '2019-06-17 14:49:41', '2019-06-17 14:49:41', 0),
(4, 'reham  client', '0101455224', 'reham.khairy@fudex.com.sa', '$2y$10$Q5TXOwtvVER05d6cSR8g5eXDLxIFyBxRGGvJyH8joOpn64vlcJefG', NULL, 2, '2019-06-18', NULL, 'HKN1qaFQaau4qSR5lvhLl5D9LsNLYJPhEBcYLI99pOj1jlCQ8tUbj2Rn7ZS7', '2019-06-18 14:45:43', '2019-07-01 16:39:30', 0),
(5, 'Soha', '123', 'eng.nohaoun11111@yahoo.com', '$2y$10$YtvYeoG/hsQ/7vbu7rwYt.TZS37.4HZI2sUMc1ggFUff/CrgliWEm', 2, 2, '2019-04-02', 'FeMale', NULL, '2019-06-24 18:05:09', '2019-06-24 18:05:09', 0),
(6, 'rr', '01012121', 'reham@fudex.com.sa', '$2y$10$Vo7VCJA8rrhtxVkgZ8FCZO5rGpKXsy/OKT2Seaq6KAqhrdpjCVj3K', 2, 2, '2000-01-01', 'Male', NULL, '2019-06-30 13:06:49', '2019-06-30 13:06:49', 0),
(7, 'dff', '01001', 'test@test.com', '$2y$10$kCbHnkFYAfj.UCLp1IrVrOD5phdV7Xa52HNaPeZlatKAq5blschba', 1, 2, '2000-01-01', 'Male', NULL, '2019-06-30 13:07:49', '2019-06-30 13:07:49', 0),
(8, 'amany', '2222', 'amany1@yahoo.com', '$2y$10$aOgLiSFjmCU6e4Zl.pY1j.rpkzn43YRJ3nHCf/5B2KBsI4YyvbJuy', 2, 2, '2019-02-05', 'FeMale', NULL, '2019-07-04 06:12:07', '2019-07-04 06:12:07', 506891055);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dentist_calanders`
--
ALTER TABLE `dentist_calanders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lexx_messages`
--
ALTER TABLE `lexx_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lexx_participants`
--
ALTER TABLE `lexx_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lexx_threads`
--
ALTER TABLE `lexx_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lexx_messages`
--
ALTER TABLE `lexx_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lexx_participants`
--
ALTER TABLE `lexx_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lexx_threads`
--
ALTER TABLE `lexx_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
