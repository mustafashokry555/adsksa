-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2025 at 03:23 PM
-- Server version: 10.6.19-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arabcare_testApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `fee` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `vat` double(8,2) NOT NULL DEFAULT 0.00,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `cancel_by_patient` enum('0','1') NOT NULL DEFAULT '0',
  `payment_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Unpaid',
  `payment_date` datetime DEFAULT NULL,
  `status_changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `booking_for` varchar(255) DEFAULT NULL,
  `concern` varchar(255) DEFAULT NULL,
  `appointment_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `insurance_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `patient_id`, `hospital_id`, `appointment_date`, `appointment_time`, `fee`, `discount`, `vat`, `status`, `cancel_by_patient`, `payment_status`, `payment_date`, `status_changed_by`, `created_at`, `updated_at`, `booking_for`, `concern`, `appointment_type`, `description`, `insurance_id`) VALUES
(1, 122, 123, 5, '2025-01-23', '08:00:00', 150, 0, 0.00, 'C', '0', 'Unpaid', NULL, NULL, '2025-01-22 13:59:20', '2025-01-22 13:59:20', NULL, NULL, NULL, NULL, NULL),
(2, 119, 7, 3, '2025-01-28', '15:30:00', 0, 0, 0.00, 'P', '0', 'Unpaid', NULL, NULL, '2025-01-22 17:21:19', '2025-01-22 17:21:19', NULL, NULL, NULL, NULL, NULL),
(3, 121, 123, 5, '2025-01-28', '11:00:00', 200, 0, 0.00, 'C', '0', 'Unpaid', NULL, NULL, '2025-01-25 00:54:46', '2025-01-25 00:54:46', NULL, NULL, NULL, NULL, NULL),
(4, 121, 123, 5, '2025-01-30', '19:30:00', 0, 0, 0.00, 'C', '0', 'Unpaid', NULL, NULL, '2025-01-28 17:12:28', '2025-01-29 00:21:49', NULL, NULL, NULL, NULL, NULL),
(5, 121, 123, 5, '2025-02-03', '10:00:00', 0, 0, 0.00, 'U', '0', 'Unpaid', NULL, NULL, '2025-02-01 17:30:50', '2025-02-01 17:31:41', NULL, NULL, NULL, NULL, NULL),
(6, 121, 123, 5, '2025-02-03', '11:00:00', 0, 0, 0.00, 'D', '1', 'Unpaid', NULL, NULL, '2025-02-01 17:31:04', '2025-02-18 15:31:09', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE `app_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notifications` tinyint(1) NOT NULL DEFAULT 0,
  `msg_option` tinyint(1) NOT NULL DEFAULT 0,
  `call_option` tinyint(1) NOT NULL DEFAULT 0,
  `video_call_option` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `subject_en` varchar(255) NOT NULL,
  `subject_ar` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `hospital_id`, `image`, `subject_en`, `subject_ar`, `is_active`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 5, '1738067797-abah.png', 'Bannar', 'بانر', 1, '2025-02-28 05:00:00', '2025-01-22 21:12:32', '2025-01-28 17:36:37'),
(2, 3, '1738067854-jordan.jpg', 'Bannar1', 'بانر', 1, '2025-02-28 05:00:00', '2025-01-24 23:51:20', '2025-01-28 17:37:34'),
(3, 7, '1738073677-2022-11-27.jpg', 'Bannar2', 'بانر2', 1, '2025-02-28 05:00:00', '2025-01-28 19:14:37', '2025-01-28 19:14:37'),
(4, 6, '1738073710-2328684.jpeg', 'Bannar3', 'بانر3', 1, '2025-02-28 05:00:00', '2025-01-28 19:15:10', '2025-01-28 19:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_title_en` varchar(255) NOT NULL,
  `blog_title_ar` varchar(255) DEFAULT NULL,
  `blog_body_en` text NOT NULL,
  `blog_body_ar` varchar(255) DEFAULT NULL,
  `blog_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `slug`, `user_id`, `blog_title_en`, `blog_title_ar`, `blog_body_en`, `blog_body_ar`, `blog_image`, `created_at`, `updated_at`) VALUES
(1, '', 1, 'T', 't', 'ttttt', 'hhhhhh', '1739874411-Optha2.png', '2025-02-18 15:26:51', '2025-02-18 15:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name_en`, `name_ar`, `country_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(25, 'Riyadh', 'الرياض', 1, NULL, NULL, NULL),
(26, 'Jeddah', 'جدة', 1, NULL, NULL, NULL),
(27, 'Mecca', 'مكة المكرمة', 1, NULL, NULL, NULL),
(28, 'Medina', 'المدينة المنورة', 1, NULL, NULL, NULL),
(29, 'Ad Dammām', 'الدمام', 1, NULL, NULL, NULL),
(30, 'Tabuk', 'تبوك', 1, NULL, NULL, NULL),
(31, 'Al Hufuf', 'الهفوف', 1, NULL, NULL, NULL),
(32, 'Al Qatif', 'القطيف', 1, NULL, NULL, NULL),
(33, 'Al Hillah', 'الهيلة', 1, NULL, NULL, NULL),
(34, 'Ata’if', 'الطائف', 1, NULL, NULL, NULL),
(35, 'Al Jubayl', 'الجبيل', 1, NULL, NULL, NULL),
(36, 'Buraydah', 'بريدة', 1, NULL, NULL, NULL),
(37, 'Ḩafr al Bāţin', 'حفر الباطن', 1, NULL, NULL, NULL),
(38, 'Yanbu', 'ينبع', 1, NULL, NULL, NULL),
(39, 'Ha’il', 'حائل', 1, NULL, NULL, NULL),
(40, 'Abha', 'أبها', 1, NULL, NULL, NULL),
(41, 'Sakaka', 'سكاكا', 1, NULL, NULL, NULL),
(42, 'Al Qurayyat', 'القريات', 1, NULL, NULL, NULL),
(43, 'Jazan', 'جازان', 1, NULL, NULL, NULL),
(44, 'Najran', 'نجران', 1, NULL, NULL, NULL),
(45, 'Al Wajh', 'الوجه', 1, NULL, NULL, NULL),
(46, 'Arar', 'عرعر', 1, NULL, NULL, NULL),
(47, 'Al Baḩah', 'الباحة', 1, NULL, NULL, NULL),
(48, 'Tathlith', 'تثليث', 1, NULL, NULL, NULL),
(49, 'Cairo', 'القاهره', 2, NULL, '2025-01-20 23:18:21', '2025-01-20 23:18:21'),
(50, 'Amman', 'عمان', 3, NULL, '2025-01-20 23:18:21', '2025-01-20 23:18:21'),
(51, 'Al-Ahsa', 'الأحساء', 1, NULL, NULL, NULL),
(52, 'Khafji', 'الخفجي', 1, NULL, NULL, NULL),
(53, 'Khobar', 'الخبر', 1, NULL, NULL, NULL),
(54, 'Saihat', 'سيهات', 1, NULL, NULL, NULL),
(55, 'Jubail Industrial', 'الجبيل الصناعية', 1, NULL, NULL, NULL),
(56, 'Dhahran', 'الظهران', 1, NULL, NULL, NULL),
(57, 'Unaizah', 'عنيزة', 1, NULL, NULL, NULL),
(58, 'Sabya', 'صبياء', 1, NULL, NULL, NULL),
(59, 'Khamis Mushait', 'خميس مشيط', 1, NULL, NULL, NULL),
(60, 'Muhayil Asir', 'محايل عسير', 1, NULL, NULL, NULL),
(61, 'Al-Hawiyah', 'الحوية', 1, NULL, NULL, NULL),
(62, 'Al-Aqiq', 'العقيق', 1, NULL, NULL, NULL),
(63, 'Al-Mandaq', 'المندق', 1, NULL, NULL, NULL),
(64, 'Baljurashi', 'بلجرشي', 1, NULL, NULL, NULL),
(65, 'Tabarjal', 'طبرجل', 1, NULL, NULL, NULL),
(66, 'Rafha', 'رفحاء', 1, NULL, NULL, NULL),
(67, 'Turaif', 'طريف', 1, NULL, NULL, NULL),
(68, 'Dawadmi', 'الدوادمي', 1, NULL, NULL, NULL),
(69, 'Majmaah', 'المجمعة', 1, NULL, NULL, NULL),
(70, 'Muzahimiyah', 'المزاحمية', 1, NULL, NULL, NULL),
(71, 'Afif', 'عفيف', 1, NULL, NULL, NULL),
(72, 'Diriyah', 'الدرعية', 1, NULL, NULL, NULL),
(73, 'Al-Kharj', 'الخرج', 1, NULL, NULL, NULL),
(74, 'As-Sulayyil', 'السليل', 1, NULL, NULL, NULL),
(75, 'Az Zulfi', 'الزلفي', 1, NULL, NULL, NULL),
(76, 'Wadi ad-Dawasir', 'وادي الدواسر', 1, NULL, NULL, NULL),
(77, 'Al-Quwayiyah', 'القويعية', 1, NULL, NULL, NULL),
(78, 'Al-Uyaynah', 'العيينه', 1, NULL, NULL, NULL),
(79, 'Ar-Rtawiyah', 'الأرطاوية', 1, NULL, NULL, NULL),
(80, 'Hotat Sudair', 'حوطة سدير', 1, NULL, NULL, NULL),
(81, 'Hotat Bani Tamim', 'حوطة بني تميم', 1, NULL, NULL, NULL),
(82, 'Anak', 'عنك', 1, NULL, NULL, NULL),
(83, 'Safwa', 'صفوى', 1, NULL, NULL, NULL),
(84, 'Buqayq', 'بقيق', 1, NULL, NULL, NULL),
(85, 'Al-Mubarraz', 'المبرز', 1, NULL, NULL, NULL),
(86, 'Nairyah', 'النعيرية', 1, NULL, NULL, NULL),
(87, 'Ras Tanura', 'رأس تنورة', 1, NULL, NULL, NULL),
(88, 'Tarout', 'تاروت', 1, NULL, NULL, NULL),
(89, 'Al-Bukayriyah', 'البكيرية', 1, NULL, NULL, NULL),
(90, 'Ar Rass', 'الرس', 1, NULL, NULL, NULL),
(91, 'Riyadh Al-Khubara', 'رياض الخبراء', 1, NULL, NULL, NULL),
(92, 'Al-Mithnab', 'المذنب', 1, NULL, NULL, NULL),
(93, 'Badr', 'بدر', 1, NULL, NULL, NULL),
(94, 'Tayma', 'تيماء', 1, NULL, NULL, NULL),
(95, 'Umluj', 'أملج', 1, NULL, NULL, NULL),
(96, 'Duba', 'ضباء', 1, NULL, NULL, NULL),
(97, 'Haql', 'حقل', 1, NULL, NULL, NULL),
(98, 'Ahad Al Masarihah', 'أحد المسارحة', 1, NULL, NULL, NULL),
(99, 'Shaqiq', 'شقيق', 1, NULL, NULL, NULL),
(100, 'Bish', 'بيش', 1, NULL, NULL, NULL),
(101, 'Ad-Darb', 'الدرب', 1, NULL, NULL, NULL),
(102, 'Al-Aridah', 'العارضة', 1, NULL, NULL, NULL),
(103, 'Baqaa', 'بقعاء', 1, NULL, NULL, NULL),
(104, 'Sabt Al Alayah', 'سبت العلايه', 1, NULL, NULL, NULL),
(105, 'Ahad Rafidah', 'أحد رفيده', 1, NULL, NULL, NULL),
(106, 'An-Namas', 'النماص', 1, NULL, NULL, NULL),
(107, 'Sarat Abidah', 'سراة عبيدة', 1, NULL, NULL, NULL),
(108, 'Dhahran Al Janoub', 'ظهران الجنوب', 1, NULL, NULL, NULL),
(109, 'Wadi Bin Hashbal', 'وادي بن هشبل', 1, NULL, NULL, NULL),
(110, 'Bisha', 'بيشة', 1, NULL, NULL, NULL),
(111, 'Al Qunfudhah', 'القنفذة', 1, NULL, NULL, NULL),
(112, 'Ranyah', 'رنيه', 1, NULL, NULL, NULL),
(113, 'Al Jumum', 'الجموم', 1, NULL, NULL, NULL),
(114, 'Rabigh', 'رابغ', 1, NULL, NULL, NULL),
(115, 'Al Lith', 'الليث', 1, NULL, NULL, NULL),
(116, 'Khulais', 'خليص', 1, NULL, NULL, NULL),
(117, 'Thuwal', 'ثول', 1, NULL, NULL, NULL),
(118, 'Asfan', 'عسفان', 1, NULL, NULL, NULL),
(119, 'Sharurah', 'شرورة', 1, NULL, NULL, NULL),
(120, 'Al-Badai', 'البدائع', 1, NULL, NULL, NULL),
(121, 'Al-Ula', 'العلا', 1, NULL, NULL, NULL),
(122, 'Abu Arish', 'أبو عريش', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `clinic_title` varchar(255) NOT NULL,
  `clinic_location` varchar(255) NOT NULL,
  `clinic_fee` varchar(255) NOT NULL,
  `clinic_start_time` time NOT NULL,
  `clinic_end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_en`, `name_ar`, `code`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Saudi Arabia', 'السعوديه', 'SA', NULL, '2024-12-01 04:21:12', '2024-12-01 02:22:40'),
(2, 'Egypt', 'مصر', 'EGY', NULL, '2024-12-01 04:22:58', '2024-12-01 04:22:58'),
(3, 'Jordan', 'الأردن', 'JO', NULL, '2024-12-01 04:22:58', '2024-12-01 04:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `experience_title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genral_settings`
--

CREATE TABLE `genral_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genral_settings`
--

INSERT INTO `genral_settings` (`id`, `key`, `value`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'vat', '15', 'invoice', '2023-04-25 17:29:17', '2023-04-25 17:29:17'),
(2, 'footer_text', 'VAT IS VAT', 'invoice', '2023-04-25 17:29:17', '2023-04-25 17:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `insurance_id` int(11) DEFAULT NULL,
  `hospital_name_en` varchar(255) NOT NULL,
  `hospital_name_ar` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `long` double(20,15) DEFAULT NULL,
  `lat` decimal(20,15) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `about1` text DEFAULT NULL,
  `about2` text DEFAULT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `profile_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`profile_images`)),
  `mail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `hospital_type_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `insurance_id`, `hospital_name_en`, `hospital_name_ar`, `city_id`, `address`, `city`, `country`, `state`, `zip`, `image`, `created_at`, `updated_at`, `location`, `long`, `lat`, `about`, `about1`, `about2`, `opening_hours`, `profile_images`, `mail`, `phone`, `whatsapp`, `facebook`, `instagram`, `tiktok`, `hospital_type_id`) VALUES
(1, NULL, 'Qasr Eleiny Hospital Cairo', 'مستشفي القصر العينى بالقاهره', 49, 'Qasr Eleiny St - Cairo - Egypt', 'Cairo', 'Egypt', 'Cairo', '11562', '1737398029-IMG-20200427-WA0029(1).jpg', '2025-01-20 23:33:49', '2025-01-21 23:07:24', '48 شارع القصر العيني, 11519, جاردن سيتي, Cairo, Cairo, Egypt', 31.233267000000000, 30.033415000000000, 'Originally established in 1827 during the reign of Muhammad Ali Pasha.\nIt is named after Sheikh Al-Aini, who donated the land where the original hospital was built.', 'Produces a significant number of Egypt\'s doctors and medical professionals each year.\r\nIt serves as a teaching hospital for Cairo University’s Faculty of Medicine.', 'Offers both general and specialized medical services in areas like surgery, internal medicine, pediatrics, and cardiology.\r\nKnown for its comprehensive medical care, it handles millions of cases annually.', '24', '[\"1737398029-IMG-20200427-WA0029.jpg\",\"1737398029-maxresdefault.jpg\",\"1737398029-\\u0627\\u0644\\u0642\\u0635\\u0631-\\u0627\\u0644\\u0639\\u064a\\u0646\\u0649.png\",\"1737398029-\\u0642\\u0635\\u0631-\\u0627\\u0644\\u0639\\u064a\\u0646\\u064a.jpg\"]', NULL, '01050768820', '01050768820', 'https://www.facebook.com/groups/133315840673665', 'https://www.instagram.com/doc.tor_k.a196/', 'https://www.tiktok.com/@aboodjamel14', NULL),
(3, NULL, 'Jordan Hospital', 'مستشفى الاردن', 50, 'Amman, Queen Noor Street Amman, Jordan 11152', 'Amman < عمان >', 'Jordan', 'Amman', '11152', '1737739871-jordan.jpg', '2025-01-21 00:57:04', '2025-01-24 22:31:11', 'عمّان, Amman, Jordan', 35.914190329563326, 31.954321656433464, 'Jordan Hospital and Medical Center is a 350-, level III academic hospital and the largest private academic hospital in Jordan . Jordan Hospital is known for its excellence in all fields of medicine and its highly qualified medical staff , most of whom were trained in America and Europe and hold the highest international degrees in their fields of specialization .\r\n\r\nJordan Hospital provides highly specialized medical services provided by multidisciplinary teams. It is the only private medical institution in the region that performs liver transplantation and has an excellent record in kidney transplantation for adults and children . The Cardiology Department is recognized regionally as a leader in advanced and modern cardiovascular procedures . It also includes advanced minimally invasive thoracic surgeries through single holes and without anesthesia for critical patients . American-trained and certified surgeons perform advanced laparoscopic surgeries and bariatric surgery. The Orthopedics and Joints Department provides advanced hip and knee replacement surgery supported by a specialized rehabilitation team . Jordan Hospital also provides advanced and distinguished eye surgeries, plastic and reconstructive surgery, neurosurgery and gynecology, making it a well-established and recognized hospital in the region .', '.', '.', '24', '[\"1737739871-j.jpg\",\"1737739871-jordan.jpg\",\"1737739871-jordan1.jpg\",\"1737739871-jordan2.jpg\"]', NULL, '5608080 6 00962', 'https://www.jordan-hospital.com/', 'https://www.facebook.com/JordanHospital/', 'https://www.instagram.com/JordanHospital/', NULL, NULL),
(5, NULL, 'Ali Bin Ali Hospital', 'مستشفى علي بن علي', 25, 'KSA, Riyadh, Aziziyah, Mohammed Rashid Road P.O Box 7520 Riyadh 14515', 'Riyadh', 'Saudi Arabia', 'Riyadh', '14515', '1737482244-abah.png', '2025-01-21 22:57:24', '2025-01-24 22:27:53', '7326 محمد رشيد رضا, Riyadh, Riyadh, Saudi Arabia', 46.768474718697490, 24.573359119813404, 'ِAli Bin Ali Hospital is considered one of the private hospitals in Riyadh City, which being established and starting from 2020. It has a capacity of 100 beds. We are looking to be one of the most prominent providers of health care services in the Kingdom of Saudi Arabia. The hospital services consist mainly of diagnostic, curative, preventive and rehabilitative services of daily care. All Bin Ali Hospital is also keen on providing high quality healthcare services with a professional healthcare provider and distinctive management services. The hospital contains advanced facilities for patients in outpatient clinics and other departments with focus on the importance of patient safety standards. The hospital is a pioneer in the field of integrated healthcare with more than 70 specialties in the field.', '.', '.', '24', '[\"1737482244-abah.png\",\"1737739576-a1.jpg\",\"1737739576-a2.jpg\",\"1737739576-a3.jpg\"]', 'info@alibinali.sa', '0112600000', '0112600000', 'alibinali.sa', 'alibinali.sa', 'alibinali.sa', NULL),
(6, NULL, 'Dr. Sulaiman Al Habib Hospital - Ryadh', 'مستشفى الدكتور سليمان الحبيب', 25, 'Dr. Sulaiman Al Habib Olaya Medical Complex King Fahd Rd, Al Olaya, Riyadh 12214', 'Riyadh', 'Saudi Arabia', 'Riyadh', '8807 الملك فهد, Riyadh, Riyadh, Saudi Arabia', '1738073028-2328684.jpeg', '2025-01-28 19:03:48', '2025-02-01 21:32:23', '6401 شارع عبد العزيز بن مساعد بن جلوي, الدحو, Riyadh, Riyadh, Saudi Arabia', 46.716667000000000, 24.633333000000000, '.', '.', '.', '24', '[\"1738073028-2328684.jpeg\",\"1738073761-a.jpg\",\"1738073761-a1.jpg\",\"1738073761-a2.jpg\",\"1738075132-GQ7A9904.jpg\"]', NULL, '+966 11 525 9999', '+966 92 006 6666', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', NULL),
(7, NULL, 'Dr. Solaiman Fakeeh Hospital', 'مستشفى الدكتور سليمان فقيه', 25, 'حي الياسمين, RAYB7058، 7058 رقم 3، 2537, Riyadh 13325', NULL, NULL, 'Riyadh', '13325', '1738073552-2022-11-27.jpg', '2025-01-28 19:12:32', '2025-01-28 19:12:32', '3269 رقم 3, Riyadh, Riyadh, Saudi Arabia', 46.838699077562040, 24.575196278010083, '.', '.', '.', '.', '[\"1738073552-2022-03-03.jpg\",\"1738073552-2022-11-27.jpg\",\"1738073552-2023-05-28.jpg\",\"1738073552-2024-08-27.jpg\",\"1738073552-DSFH - Riyadh - Waiting Area 7th Floor.png\",\"1738073552-Emergency Room - Maternity 2.jpg\"]', NULL, '800 120 9999', '00966920012777', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', NULL),
(8, NULL, 'Dr. Sulaiman Al Habib Hospital - Jeddah', 'مستشفى الدكتور سليمان الحبيب - جدة', 26, 'G658+W95, Al Fayha\'a, Jeddah 22245', 'Jeddah', 'Saudi Arabia', 'Jeddah', '22245', '1738427515-1712830151718.jpeg', '2025-02-01 21:31:55', '2025-02-01 21:44:00', 'Calle Paseo De Las Torres Sur 11241, 22246 Terrazas del Valle, Baja California, Mexico', 46.701340200000000, 24.794278300000000, 'We provide a wide range of medical services that cover various medical conditions and are tailored to meet the needs of patient.', 'We provide a wide range of medical services that cover various medical conditions and are tailored to meet the needs of patient.', 'We provide a wide range of medical services that cover various medical conditions and are tailored to meet the needs of patient.', '24', '[\"1738427515-2284797.jpg\",\"1738427515-1712830151718.jpeg\",\"1738427515-Takhassusi.png\"]', NULL, '012 744 4444', '012 744 4444', 'https://hmg.com/', 'https://hmg.com/', 'https://hmg.com/', NULL),
(9, NULL, 'United Doctors Hospitla', 'مستشفى الاطباء المتحدون', 26, 'Jeddah, Mecca, Saudi Arabia', 'Jeddah < جدة >', 'Saudi Arabia', 'Jeddah', '23456', '1738529488-HDU.jpg', '2025-02-03 00:51:41', '2025-02-03 01:51:28', '2656 شارع صاري, Jiddah, Mecca, Saudi Arabia', 39.165348000000000, 21.581549000000000, 'United Doctors Hospital Earns Prestigious Accreditation: A Testament to Excellence in Healthcare.', 'United Doctors Hospital Earns Prestigious Accreditation: A Testament to Excellence in Healthcare.', 'United Doctors Hospital Earns Prestigious Accreditation: A Testament to Excellence in Healthcare.', '24', '[\"1738529451-15.jpg\",\"1738529451-1451.jpg\",\"1738529451-HDU.jpg\",\"1738529451-og-8axrd6leZT-1725379582.jpg\",\"1738529451-\\u0645\\u0633\\u062a\\u0634\\u0641\\u0649-\\u0627\\u0644\\u0627\\u0637\\u0628\\u0627\\u0621-\\u0627\\u0644\\u0645\\u062a\\u062d\\u062f\\u0648\\u0646-6.jpg\"]', NULL, '012-653-33-33', '012-653-33-33', 'https://udh.sa', 'https://udh.sa', 'https://udh.sa', NULL),
(10, NULL, 'مستشفى المواطن علي بن محمد بن محفر بن علي', 'مستشفى المواطن علي بن محمد بن محفر بن علي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2600000', NULL, NULL, NULL, NULL, 1),
(11, NULL, 'المستشفى الوطني', 'المستشفى الوطني', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4761211', NULL, NULL, NULL, NULL, 1),
(12, NULL, 'سليمان الحبيب السويدي - مستشفى شركة صحة السويدي الطبية', 'سليمان الحبيب السويدي - مستشفى شركة صحة السويدي الطبية', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4754444', NULL, NULL, NULL, NULL, 1),
(13, NULL, 'شركة مستشفى الدكتور سليمان فقيه الطبية', 'شركة مستشفى الدكتور سليمان فقيه الطبية', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001209999', NULL, NULL, NULL, NULL, 1),
(14, NULL, 'شركة مستشفى فكتوريا الطبي السعودي', 'شركة مستشفى فكتوريا الطبي السعودي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2099999', NULL, NULL, NULL, NULL, 1),
(15, NULL, 'مستشفى الازهار الطبي', 'مستشفى الازهار الطبي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2366788', NULL, NULL, NULL, NULL, 1),
(16, NULL, 'مستشفى الاسرة الدولي', 'مستشفى الاسرة الدولي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4311111', NULL, NULL, NULL, NULL, 1),
(17, NULL, 'مستشفى الجافل الدولي', 'مستشفى الجافل الدولي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4322222', NULL, NULL, NULL, NULL, 1),
(18, NULL, 'مستشفى الجزيره الطبي', 'مستشفى الجزيره الطبي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '920005322', NULL, NULL, NULL, NULL, 1),
(19, NULL, 'مستشفى الحمادي - فرع السويدي', 'مستشفى الحمادي - فرع السويدي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4250000', NULL, NULL, NULL, NULL, 1),
(20, NULL, 'مستشفى الحمادي - فرع النزهة', 'مستشفى الحمادي - فرع النزهة', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4837777', NULL, NULL, NULL, NULL, 1),
(21, NULL, 'مستشفى الحياة الوطني فرع شركة الانماء للخدمات الطبية - الرياض', 'مستشفى الحياة الوطني فرع شركة الانماء للخدمات الطبية - الرياض', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4455555', NULL, NULL, NULL, NULL, 1),
(22, NULL, 'مستشفى الدرعية', 'مستشفى الدرعية', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4919726', NULL, NULL, NULL, NULL, 1),
(23, NULL, 'مستشفى الدكتور / سليمان الحبيب', 'مستشفى الدكتور / سليمان الحبيب', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4909999', NULL, NULL, NULL, NULL, 1),
(24, NULL, 'مستشفى الدكتور سليمان الحبيب للنساء والولادة', 'مستشفى الدكتور سليمان الحبيب للنساء والولادة', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4622224', NULL, NULL, NULL, NULL, 1),
(25, NULL, 'مستشفى الدكتور/ عبدالرحمن المشاري', 'مستشفى الدكتور/ عبدالرحمن المشاري', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4657700', NULL, NULL, NULL, NULL, 1),
(26, NULL, 'مستشفى السلام الطبي - الرياض', 'مستشفى السلام الطبي - الرياض', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2222211', NULL, NULL, NULL, NULL, 1),
(27, NULL, 'مستشفى الفلاح الدولي', 'مستشفى الفلاح الدولي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4463737', NULL, NULL, NULL, NULL, 1),
(28, NULL, 'مستشفى المركز التخصصي الطبي', 'مستشفى المركز التخصصي الطبي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4343800', NULL, NULL, NULL, NULL, 1),
(29, NULL, 'مستشفى المركز التخصصي الطبي 2', 'مستشفى المركز التخصصي الطبي 2', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4343800', NULL, NULL, NULL, NULL, 1),
(30, NULL, 'مستشفى المملكه', 'مستشفى المملكه', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2751111', NULL, NULL, NULL, NULL, 1),
(31, NULL, 'مستشفى النخبة - العليا', 'مستشفى النخبة - العليا', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4616777', NULL, NULL, NULL, NULL, 1),
(32, NULL, 'مستشفى الهلال الاخضر', 'مستشفى الهلال الاخضر', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4644434', NULL, NULL, NULL, NULL, 1),
(33, NULL, 'مستشفى دار الشفاء الاهلي', 'مستشفى دار الشفاء الاهلي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4012029', NULL, NULL, NULL, NULL, 1),
(34, NULL, 'مستشفى دلــــه', 'مستشفى دلــــه', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2995555', NULL, NULL, NULL, NULL, 1),
(35, NULL, 'مستشفى رابية الطبي', 'مستشفى رابية الطبي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4999000', NULL, NULL, NULL, NULL, 1),
(36, NULL, 'مستشفى رعاية الرياض', 'مستشفى رعاية الرياض', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4933000', NULL, NULL, NULL, NULL, 1),
(37, NULL, 'مستشفى سند', 'مستشفى سند', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2407778', NULL, NULL, NULL, NULL, 1),
(38, NULL, 'مستشفى شركة الدارة الطبية', 'مستشفى شركة الدارة الطبية', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4207800', NULL, NULL, NULL, NULL, 1),
(39, NULL, 'مستشفى شركة الدكتور محمد راشد الفقيه و شريكة', 'مستشفى شركة الدكتور محمد راشد الفقيه و شريكة', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4560000', NULL, NULL, NULL, NULL, 1),
(40, NULL, 'مستشفى شركة المواساة للخدمات الطبية - حي غرناطة', 'مستشفى شركة المواساة للخدمات الطبية - حي غرناطة', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4130000', NULL, NULL, NULL, NULL, 1),
(41, NULL, 'مستشفى شركة دله نمار الصحية القابضة - الرياض', 'مستشفى شركة دله نمار الصحية القابضة - الرياض', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-8275555', NULL, NULL, NULL, NULL, 1),
(42, NULL, 'مستشفى شركة مغربي فرع شركة مستشفيات ومراكز مغربي', 'مستشفى شركة مغربي فرع شركة مستشفيات ومراكز مغربي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4705656', NULL, NULL, NULL, NULL, 1),
(43, NULL, 'مستشفى شركه بيت البترجي و د/ زهير السباعي الطبيه', 'مستشفى شركه بيت البترجي و د/ زهير السباعي الطبيه', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4873000', NULL, NULL, NULL, NULL, 1),
(44, NULL, 'مستشفى عبيد التخصصي فرع شركة المشاريع الطبية المتحدة', 'مستشفى عبيد التخصصي فرع شركة المشاريع الطبية المتحدة', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4767222', NULL, NULL, NULL, NULL, 1),
(45, NULL, 'مستشفى عناية العائلة - الرياض', 'مستشفى عناية العائلة - الرياض', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-2454444', NULL, NULL, NULL, NULL, 1),
(46, NULL, 'مركز مغربي  (كأحد أقسام مستشفى المواساة بالدمام)', 'مركز مغربي  (كأحد أقسام مستشفى المواساة بالدمام)', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8180000', NULL, NULL, NULL, NULL, 1),
(47, NULL, 'مركز مغربي بمستشفى الأحساء', 'مركز مغربي بمستشفى الأحساء', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5360000', NULL, NULL, NULL, NULL, 1),
(48, NULL, 'مستشفى الأحساء - ومركز مغربي', 'مستشفى الأحساء - ومركز مغربي', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5844000', NULL, NULL, NULL, NULL, 1),
(49, NULL, 'مستشفى الخفجي الأهلي بالخفجي', 'مستشفى الخفجي الأهلي بالخفجي', 52, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-7661111', NULL, NULL, NULL, NULL, 1),
(50, NULL, 'مستشفى الدكتور الحسن النعمي التخصصي - الدمام', 'مستشفى الدكتور الحسن النعمي التخصصي - الدمام', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8467777', NULL, NULL, NULL, NULL, 1),
(51, NULL, 'مستشفى الرعاية التخصصية بالخبر', 'مستشفى الرعاية التخصصية بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8956056', NULL, NULL, NULL, NULL, 1),
(52, NULL, 'مستشفى الروضة العام - الدمام', 'مستشفى الروضة العام - الدمام', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8346555', NULL, NULL, NULL, NULL, 1),
(53, NULL, 'مستشفى الزهراء العام - بالقطيف', 'مستشفى الزهراء العام - بالقطيف', 32, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8555000', NULL, NULL, NULL, NULL, 1),
(54, NULL, 'مستشفى السعودي الألماني فرع ش الشرق الاوسط للرعاية الصحية', 'مستشفى السعودي الألماني فرع ش الشرق الاوسط للرعاية الصحية', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8016000', NULL, NULL, NULL, NULL, 1),
(55, NULL, 'مستشفى السلامة بالخبر', 'مستشفى السلامة بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8641011', NULL, NULL, NULL, NULL, 1),
(56, NULL, 'مستشفى الصـادق بسيهات', 'مستشفى الصـادق بسيهات', 54, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8500160', NULL, NULL, NULL, NULL, 1),
(57, NULL, 'مستشفى المانع العام بالأحساء', 'مستشفى المانع العام بالأحساء', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5887000', NULL, NULL, NULL, NULL, 1),
(58, NULL, 'مستشفى المانع العام بالجبيل', 'مستشفى المانع العام بالجبيل', 55, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-3412000', NULL, NULL, NULL, NULL, 1),
(59, NULL, 'مستشفى المانع العام بالخبر', 'مستشفى المانع العام بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8987000', NULL, NULL, NULL, NULL, 1),
(60, NULL, 'مستشفى المانع العام بالدمام', 'مستشفى المانع العام بالدمام', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8262111', NULL, NULL, NULL, NULL, 1),
(61, NULL, 'مستشفى المواساة - الجبيل', 'مستشفى المواساة - الجبيل', 55, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-3490000', NULL, NULL, NULL, NULL, 1),
(62, NULL, 'مستشفى المواساة - الخبر', 'مستشفى المواساة - الخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8196666', NULL, NULL, NULL, NULL, 1),
(63, NULL, 'مستشفى المواساة بالدمام', 'مستشفى المواساة بالدمام', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8200000', NULL, NULL, NULL, NULL, 1),
(64, NULL, 'مستشفى المواساة بالقطيف', 'مستشفى المواساة بالقطيف', 32, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8512222', NULL, NULL, NULL, NULL, 1),
(65, NULL, 'مستشفى اليوسف بالخبر', 'مستشفى اليوسف بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8642736', NULL, NULL, NULL, NULL, 1),
(66, NULL, 'مستشفى تداوي للخدمات الطبية  بالدمام', 'مستشفى تداوي للخدمات الطبية  بالدمام', 29, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8348777', NULL, NULL, NULL, NULL, 1),
(67, NULL, 'مستشفى جاما الطبي بالدمام', 'مستشفى جاما الطبي بالدمام', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8591515', NULL, NULL, NULL, NULL, 1),
(68, NULL, 'مستشفى د. نور محمد خان العام - حفر الباطن', 'مستشفى د. نور محمد خان العام - حفر الباطن', 37, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-7225550', NULL, NULL, NULL, NULL, 1),
(69, NULL, 'مستشفى شركة السلام للخدمات الطبية', 'مستشفى شركة السلام للخدمات الطبية', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '138145555', NULL, NULL, NULL, NULL, 1),
(70, NULL, 'مستشفى شركة المعالي الطبية', 'مستشفى شركة المعالي الطبية', 37, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-7663628', NULL, NULL, NULL, NULL, 1),
(71, NULL, 'مستشفى شركة حسين علي محمد العلي بالأحساء', 'مستشفى شركة حسين علي محمد العلي بالأحساء', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5827777', NULL, NULL, NULL, NULL, 1),
(72, NULL, 'مستشفى شركة سي إم آر سي العربية السعودية-بالظهران', 'مستشفى شركة سي إم آر سي العربية السعودية-بالظهران', 56, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9200013122', NULL, NULL, NULL, NULL, 1),
(73, NULL, 'مستشفى عبدالعزيز الموسى بالأحساء', 'مستشفى عبدالعزيز الموسى بالأحساء', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5369666', NULL, NULL, NULL, NULL, 1),
(74, NULL, 'مستشفى عبيد التخصصي فرع شركة المشاريع الطبية المتحدة-الاحساء', 'مستشفى عبيد التخصصي فرع شركة المشاريع الطبية المتحدة-الاحساء', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5303333', NULL, NULL, NULL, NULL, 1),
(75, NULL, 'مستشفى فرع شركة صحة الشرق الطبية المحدودة بالخبر', 'مستشفى فرع شركة صحة الشرق الطبية المحدودة بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8711111', NULL, NULL, NULL, NULL, 1),
(76, NULL, 'مستشفى محمد الدوسري بالخبر', 'مستشفى محمد الدوسري بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8945524', NULL, NULL, NULL, NULL, 1),
(77, NULL, 'مستشفى محمد فخري والدكتور أحمد ناصر القرزعي-بالخبر', 'مستشفى محمد فخري والدكتور أحمد ناصر القرزعي-بالخبر', 53, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-8954960', NULL, NULL, NULL, NULL, 1),
(78, NULL, 'مركز مغربي للعيون و الاسنان كأحد اقسام مستشفى القصيم الوطني', 'مركز مغربي للعيون و الاسنان كأحد اقسام مستشفى القصيم الوطني', 36, NULL, NULL, NULL, 'القصيم', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-3280618', NULL, NULL, NULL, NULL, 1),
(79, NULL, 'مستشفى الحياة الوطني - بعنيزة - القصيم', 'مستشفى الحياة الوطني - بعنيزة - القصيم', 57, NULL, NULL, NULL, 'القصيم', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-3636600', NULL, NULL, NULL, NULL, 1),
(80, NULL, 'مستشفى الدكتور / سليمان الحبيب', 'مستشفى الدكتور / سليمان الحبيب', 36, NULL, NULL, NULL, 'القصيم', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-3166666', NULL, NULL, NULL, NULL, 1),
(81, NULL, 'مستشفى الفريح للولادة ببريدة', 'مستشفى الفريح للولادة ببريدة', 36, NULL, NULL, NULL, 'القصيم', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-3245501', NULL, NULL, NULL, NULL, 1),
(82, NULL, 'مستشفى القصيم الوطني', 'مستشفى القصيم الوطني', 36, NULL, NULL, NULL, 'القصيم', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-3836100', NULL, NULL, NULL, NULL, 1),
(83, NULL, 'شركة بيت البترجي الطبية - مستشفى السعودي الألماني', 'شركة بيت البترجي الطبية - مستشفى السعودي الألماني', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8406000', NULL, NULL, NULL, NULL, 1),
(84, NULL, 'مركز مغربي (بمستشفى المواساة المدينة المنورة)', 'مركز مغربي (بمستشفى المواساة المدينة المنورة)', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8423252', NULL, NULL, NULL, NULL, 1),
(85, NULL, 'مستشفى الحياة الوطني-المدينة المنورة', 'مستشفى الحياة الوطني-المدينة المنورة', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8677777', NULL, NULL, NULL, NULL, 1),
(86, NULL, 'مستشفى الزهراء الخاص', 'مستشفى الزهراء الخاص', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8488808', NULL, NULL, NULL, NULL, 1),
(87, NULL, 'مستشفى المدينه الوطني', 'مستشفى المدينه الوطني', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8444444', NULL, NULL, NULL, NULL, 1),
(88, NULL, 'مستشفى المواساة للخدمات الطبية  - المدينة المنورة', 'مستشفى المواساة للخدمات الطبية  - المدينة المنورة', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '500170150', NULL, NULL, NULL, NULL, 1),
(89, NULL, 'مستشفى انصاري محمود المنزلاوي', 'مستشفى انصاري محمود المنزلاوي', 38, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-3925111', NULL, NULL, NULL, NULL, 1),
(90, NULL, 'مستشفى حامد سليمان الاحمدي', 'مستشفى حامد سليمان الاحمدي', 28, NULL, NULL, NULL, 'المدينة المنورة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-8362996', NULL, NULL, NULL, NULL, 1),
(91, NULL, 'شركة مستشفى الأمير فهد بن سلطان', 'شركة مستشفى الأمير فهد بن سلطان', 30, NULL, NULL, NULL, 'تبوك', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014-4238486', NULL, NULL, NULL, NULL, 1),
(92, NULL, 'مستشفى الحياة الوطني -  بمدينة جازان', 'مستشفى الحياة الوطني -  بمدينة جازان', 43, NULL, NULL, NULL, 'جيزان', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-3311111', NULL, NULL, NULL, NULL, 1),
(93, NULL, 'مستشفى العميس - جازان', 'مستشفى العميس - جازان', 43, NULL, NULL, NULL, 'جيزان', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-3226633', NULL, NULL, NULL, NULL, 1),
(94, NULL, 'مستشفى العميس الأهلي صبياء', 'مستشفى العميس الأهلي صبياء', 58, NULL, NULL, NULL, 'جيزان', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-3266633', NULL, NULL, NULL, NULL, 1),
(95, NULL, 'مستشفى الأنوار الطبي - حائل', 'مستشفى الأنوار الطبي - حائل', 39, NULL, NULL, NULL, 'حائل', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-5332222', NULL, NULL, NULL, NULL, 1),
(96, NULL, 'مستشفى سلامات - حائل', 'مستشفى سلامات - حائل', 39, NULL, NULL, NULL, 'حائل', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-5366666', NULL, NULL, NULL, NULL, 1),
(97, NULL, 'مستشفى شركة حائل الوطنية للخدمات الصحية', 'مستشفى شركة حائل الوطنية للخدمات الصحية', 39, NULL, NULL, NULL, 'حائل', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '016-5411111', NULL, NULL, NULL, NULL, 1),
(98, NULL, 'المستشفى الأهلي', 'المستشفى الأهلي', 59, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2350000', NULL, NULL, NULL, NULL, 1),
(99, NULL, 'المستشفى التخصصي فرع شركة العناية الفائقة للاستثمار', 'المستشفى التخصصي فرع شركة العناية الفائقة للاستثمار', 40, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '920012152', NULL, NULL, NULL, NULL, 1),
(100, NULL, 'مركز بن رشد لطب العيون وجراحة اليوم الواحد كأحد اقسام (مستشفى الحياة الوطني-خميس مشيط)', 'مركز بن رشد لطب العيون وجراحة اليوم الواحد كأحد اقسام (مستشفى الحياة الوطني-خميس مشيط)', 59, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2331301', NULL, NULL, NULL, NULL, 1),
(101, NULL, 'مستشفى ابها الخاص', 'مستشفى ابها الخاص', 40, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2292222', NULL, NULL, NULL, NULL, 1),
(102, NULL, 'مستشفى الحياة الوطني - خميس مشيط', 'مستشفى الحياة الوطني - خميس مشيط', 59, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2334444', NULL, NULL, NULL, NULL, 1),
(103, NULL, 'مستشفى د . حسن محمد البار للنساء والولاده والاطفال بابها', 'مستشفى د . حسن محمد البار للنساء والولاده والاطفال بابها', 40, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2282222', NULL, NULL, NULL, NULL, 1),
(104, NULL, 'مستشفى محايل الاهلي', 'مستشفى محايل الاهلي', 60, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2856666', NULL, NULL, NULL, NULL, 1),
(105, NULL, 'مستشفى مستشارك الطبي- خميس مشيط', 'مستشفى مستشارك الطبي- خميس مشيط', 59, NULL, NULL, NULL, 'عسير', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-2200066', NULL, NULL, NULL, NULL, 1),
(106, NULL, 'المستشفى الأهلي السعودي', 'المستشفى الأهلي السعودي', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-5562177', NULL, NULL, NULL, NULL, 1),
(107, NULL, 'المستشفى السعودي الألماني', 'المستشفى السعودي الألماني', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-2606000', NULL, NULL, NULL, NULL, 1),
(108, NULL, 'المستشفى السعودي بجده', 'المستشفى السعودي بجده', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6711831', NULL, NULL, NULL, NULL, 1),
(109, NULL, 'فرع شركة مستشفى الدكتور سليمان عبدالقادر فقيه حي البساتين', 'فرع شركة مستشفى الدكتور سليمان عبدالقادر فقيه حي البساتين', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-2296400', NULL, NULL, NULL, NULL, 1),
(110, NULL, 'مستشفى الأطباء المتحدون', 'مستشفى الأطباء المتحدون', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6533333', NULL, NULL, NULL, NULL, 1),
(111, NULL, 'مستشفى الجدعاني', 'مستشفى الجدعاني', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6772221', NULL, NULL, NULL, NULL, 1),
(112, NULL, 'مستشفى الجدعاني الجديد', 'مستشفى الجدعاني الجديد', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6368100', NULL, NULL, NULL, NULL, 1),
(113, NULL, 'مستشفى الحمراء', 'مستشفى الحمراء', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6653939', NULL, NULL, NULL, NULL, 1),
(114, NULL, 'مستشفى الدكتور سمير عباس - جده', 'مستشفى الدكتور سمير عباس - جده', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6187777', NULL, NULL, NULL, NULL, 1),
(115, NULL, 'مستشفى الدكتور/ سليمان فقيه', 'مستشفى الدكتور/ سليمان فقيه', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6655000', NULL, NULL, NULL, NULL, 1),
(116, NULL, 'مستشفى الزهراء بجدة', 'مستشفى الزهراء بجدة', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6823331', NULL, NULL, NULL, NULL, 1),
(117, NULL, 'مستشفى الشفاء - مكه المكرمة', 'مستشفى الشفاء - مكه المكرمة', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-5369779', NULL, NULL, NULL, NULL, 1),
(118, NULL, 'مستشفى الظافر (30 ) سرير', 'مستشفى الظافر (30 ) سرير', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6256666', NULL, NULL, NULL, NULL, 1),
(119, NULL, 'مستشفى العدواني الاهلي', 'مستشفى العدواني الاهلي', 34, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-7340000', NULL, NULL, NULL, NULL, 1),
(120, NULL, 'مستشفى المستقبل الطبي', 'مستشفى المستقبل الطبي', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6875255', NULL, NULL, NULL, NULL, 1),
(121, NULL, 'مستشفى المغربي للعيون (30) سرير', 'مستشفى المغربي للعيون (30) سرير', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6365000', NULL, NULL, NULL, NULL, 1),
(122, NULL, 'مستشفى النهضة الاهلي', 'مستشفى النهضة الاهلي', 61, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-7250600', NULL, NULL, NULL, NULL, 1),
(123, NULL, 'مستشفى أبو زناده', 'مستشفى أبو زناده', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6510652', NULL, NULL, NULL, NULL, 1),
(124, NULL, 'مستشفى أندلسيه حي الجامعة', 'مستشفى أندلسيه حي الجامعة', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6806666', NULL, NULL, NULL, NULL, 1),
(125, NULL, 'مستشفى باقدو والدكتور عرفان', 'مستشفى باقدو والدكتور عرفان', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6820022', NULL, NULL, NULL, NULL, 1),
(126, NULL, 'مستشفى بقشان العام', 'مستشفى بقشان العام', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6691222', NULL, NULL, NULL, NULL, 1),
(127, NULL, 'مستشفى جامعة الملك عبدالعزيز بجدة', 'مستشفى جامعة الملك عبدالعزيز بجدة', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '126408222', NULL, NULL, NULL, NULL, 1),
(128, NULL, 'مستشفى جدة الاهلي', 'مستشفى جدة الاهلي', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6710040', NULL, NULL, NULL, NULL, 1),
(129, NULL, 'مستشفى جدة الوطني الجديد', 'مستشفى جدة الوطني الجديد', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6675000', NULL, NULL, NULL, NULL, 1),
(130, NULL, 'مستشفى جدة الوطني القديم بجده', 'مستشفى جدة الوطني القديم بجده', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6313131', NULL, NULL, NULL, NULL, 1),
(131, NULL, 'مستشفى د. عبدالرحمن بخش', 'مستشفى د. عبدالرحمن بخش', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6510555', NULL, NULL, NULL, NULL, 1),
(132, NULL, 'مستشفى د/ حسان أمين غزاوي(30) سرير', 'مستشفى د/ حسان أمين غزاوي(30) سرير', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6636333', NULL, NULL, NULL, NULL, 1),
(133, NULL, 'مستشفى شركة الشرق الوسط للرعاية الصحية بمكة', 'مستشفى شركة الشرق الوسط للرعاية الصحية بمكة', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '500777369', NULL, NULL, NULL, NULL, 1),
(134, NULL, 'مستشفى شركة المركز الطبي الدولي المحدوده', 'مستشفى شركة المركز الطبي الدولي المحدوده', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6509000', NULL, NULL, NULL, NULL, 1),
(135, NULL, 'مستشفى عبداللطيف جميل', 'مستشفى عبداللطيف جميل', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6770001', NULL, NULL, NULL, NULL, 1),
(136, NULL, 'مستشفى فرع شركة الشرق الأوسط للرعاية الصحية فرع الروابي', 'مستشفى فرع شركة الشرق الأوسط للرعاية الصحية فرع الروابي', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '920007997', NULL, NULL, NULL, NULL, 1),
(137, NULL, 'مستشفى كلية ابن سيناء للعلوم الطبية', 'مستشفى كلية ابن سيناء للعلوم الطبية', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6355566', NULL, NULL, NULL, NULL, 1),
(138, NULL, 'مستشفى محمد صالح باشراحيل', 'مستشفى محمد صالح باشراحيل', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-5204444', NULL, NULL, NULL, NULL, 1),
(139, NULL, 'مستشفى مركز مكة الطبي بالعمره', 'مستشفى مركز مكة الطبي بالعمره', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-5222222', NULL, NULL, NULL, NULL, 1),
(140, NULL, 'مستشفى هاله عيسى بن لادن', 'مستشفى هاله عيسى بن لادن', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6603332', NULL, NULL, NULL, NULL, 1),
(141, NULL, 'شركة مستشفى تخصصي نجران الطبي', 'شركة مستشفى تخصصي نجران الطبي', 44, NULL, NULL, NULL, 'نجران', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-5227888', NULL, NULL, NULL, NULL, 1),
(142, NULL, 'مستشفى الشفاء التخصصي', 'مستشفى الشفاء التخصصي', 44, NULL, NULL, NULL, 'نجران', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-5426666', NULL, NULL, NULL, NULL, 1),
(143, NULL, 'مستشفى الظافر', 'مستشفى الظافر', 44, NULL, NULL, NULL, 'نجران', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017-5235000', NULL, NULL, NULL, NULL, 1),
(144, NULL, 'مستشفى المركز التخصصي الطبي', 'مستشفى المركز التخصصي الطبي', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4343800', NULL, NULL, NULL, NULL, 1),
(145, NULL, 'مستشفى المركز التخصصي الطبي 2', 'مستشفى المركز التخصصي الطبي 2', 25, NULL, NULL, NULL, 'الرياض', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '011-4343800', NULL, NULL, NULL, NULL, 1),
(146, NULL, 'مستشفى الأحساء - ومركز مغربي', 'مستشفى الأحساء - ومركز مغربي', 51, NULL, NULL, NULL, 'الشرقية', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013-5844000', NULL, NULL, NULL, NULL, 1),
(147, NULL, 'مستشفى المركز الطبي الدولي', 'مستشفى المركز الطبي الدولي', 26, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-6509000', NULL, NULL, NULL, NULL, 1),
(148, NULL, 'مستشفى مركز مكة الطبي بالعمره', 'مستشفى مركز مكة الطبي بالعمره', 27, NULL, NULL, NULL, 'مكة المكرمة', NULL, 'hospital_default.jpg', '2025-02-08 23:15:36', '2025-02-08 23:16:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '012-5222222', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_insurance`
--

CREATE TABLE `hospital_insurance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `insurance_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_insurance`
--

INSERT INTO `hospital_insurance` (`id`, `hospital_id`, `insurance_id`, `created_at`, `updated_at`) VALUES
(7, 5, 20, NULL, NULL),
(8, 3, 20, NULL, NULL),
(9, 1, 20, NULL, NULL),
(10, 6, 20, NULL, NULL),
(11, 6, 21, NULL, NULL),
(12, 7, 20, NULL, NULL),
(13, 7, 21, NULL, NULL),
(14, 8, 20, NULL, NULL),
(15, 8, 21, NULL, NULL),
(16, 9, 20, NULL, NULL),
(17, 9, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_reviews`
--

CREATE TABLE `hospital_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `star_rated` varchar(1) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_body` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_types`
--

CREATE TABLE `hospital_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_types`
--

INSERT INTO `hospital_types` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'مستشفى', 'Hospital', '2025-02-09 05:36:25', '2025-02-09 05:36:25'),
(2, 'مركز طبي متخصص', 'Medical Center', '2025-02-09 05:36:59', '2025-02-09 05:36:59'),
(3, 'مجمع طبي متخصص', 'Medical Complex', '2025-02-09 05:36:59', '2025-02-09 05:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`id`, `user_id`, `name_en`, `name_ar`, `city`, `state`, `address`, `phone1`, `phone2`, `fax`, `email`, `created_at`, `updated_at`) VALUES
(20, 1, 'Bupa', 'بوبا العربية للتأمين', 'Amman < عمان >', 'Amman', 'Amman, Queen Noor Street Amman, Jordan 11152', '0252631471', '0252631471', '0252631471', 'info@buba.com', '2025-01-21 22:43:04', '2025-01-21 22:43:04'),
(21, 1, 'No insurance', 'بدون تأمين', '.', '.', '.', '111111111111111', '111111111111111', '.', 'null@null.com', '2025-01-28 18:52:41', '2025-01-28 18:52:41');

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_02_01_182405_create_specialities_table', 1),
(5, '2023_02_04_092540_create_hospitals_table', 1),
(6, '2023_02_04_092541_create_users_table', 1),
(7, '2023_02_09_101722_create_education_table', 1),
(8, '2023_02_09_101751_create_experiences_table', 1),
(9, '2023_02_09_105841_create_services_table', 1),
(10, '2023_02_13_065931_create_schedules_table', 1),
(11, '2023_02_16_080950_create_specializations_table', 1),
(12, '2023_02_16_175915_create_clinics_table', 1),
(13, '2023_02_21_090218_create_appointments_table', 1),
(14, '2023_02_23_121253_create_blogs_table', 1),
(15, '2023_02_28_100010_create_settings_table', 1),
(16, '2023_03_01_032540_create_schedule_settings_table', 1),
(17, '2023_03_13_070219_create_reviews_table', 1),
(18, '2023_03_27_150132_create_genral_settings_table', 1),
(21, '2023_04_17_154116_create_unavailabilities_table', 4),
(22, '2023_09_16_171918_create_notifications_table', 5),
(24, '2023_04_12_165215_create_regular_availabilities_table', 7),
(25, '2023_04_13_190032_create_one_time_availabilities_table', 7),
(26, '2023_09_21_202031_create_insuraces_table', 8),
(27, '2023_09_26_200843_add_columns_to_appointments', 9),
(28, '2023_09_27_192242_create_wishlists_table', 10),
(29, '2023_10_04_200542_add_insurance_id_to_appointments_table', 11),
(30, '2023_10_05_203023_create_newsletters_table', 12),
(31, '2023_10_03_195831_add_columns_to_users', 13),
(32, '2023_10_11_191329_create_hospital_insurance_table', 13),
(33, '2023_10_12_203638_create_contact_us_table', 14),
(34, '2023_10_15_172653_add_timezone_to_users_table', 15),
(35, '2024_06_04_091814_patians_dettails', 16),
(36, '2024_06_07_120145_app_setting', 17),
(37, '2024_06_07_122601_add_user_code', 18),
(38, '2024_07_20_150605_add_specialities_lang', 19),
(39, '2024_07_20_204418_add_insurances_lang', 20),
(40, '2024_07_30_190258_add_hospital_lang', 21),
(41, '2024_07_30_191102_add_users_lang', 21),
(42, '2024_07_30_191604_add_blog_lang', 21),
(43, '2024_09_04_130041_patient_comments', 22),
(44, '2024_10_04_214828_hospital_reviews', 23),
(45, '2024_10_07_194457_add_hospitaldata', 24),
(46, '2024_10_25_195751_create_banners_table', 25),
(47, '2024_11_16_221237_hospital_profile_imgs', 26),
(48, '2024_11_23_182559_hospital_social', 27),
(49, '2024_11_25_223547_countries', 28),
(50, '2024_11_25_223548_cities', 28),
(51, '2024_11_30_174322_add_city_id_to_users_table', 28),
(52, '2024_11_30_174441_add_city_id_to_hospitals_table', 28),
(53, '2024_11_30_233045_rename_column_in_hospital_mail', 29),
(54, '2024_11_30_233857_make_columns_nullable_in_hospital', 29),
(55, '2025_01_24_205511_create_offers_tabel', 30),
(56, '2025_02_08_120022_create_hospital_types_table', 31),
(57, '2025_02_08_120102_add_hospital_type_id_to_hospitals_table', 31),
(58, '2025_02_18_133625_change_instagram_column_type_in_settings_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', NULL, NULL),
(5, 'admin@admin.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `isRead` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `appointment_id`, `from_id`, `to_id`, `message`, `isRead`, `created_at`, `updated_at`) VALUES
(19, 6, 123, 121, 'Appointment (#6) Has Been Canceled By Patient', 1, '2025-02-18 15:31:09', '2025-02-18 15:31:09'),
(20, 6, 123, 121, 'Appointment (#6) Has Been Canceled By Patient', 1, '2025-02-18 15:31:15', '2025-02-18 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_ar` text NOT NULL,
  `content_en` text NOT NULL,
  `type` enum('image','video') NOT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title_ar`, `title_en`, `content_ar`, `content_en`, `type`, `video_link`, `images`, `hospital_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'اختبار1', 'test1', 'مسنثب سميثبن سمينب تسم بثسمن', 'slifh lskgj s isjfg slfj', 'image', NULL, '[\"1739789417-JwJSJrLyObsNa5ipQD6JEQLiqy06mANsYvWbN6Vn.jpg\",\"1739789417-rAvDZSzq0RxOFfr6SeRefjtIMM2T8boWSUcNGwyT.jpg\"]', 1, 1, '2025-02-17 15:50:17', '2025-02-17 15:51:53'),
(2, 'يسونل', 'اختبر', 'يبل ايبا ي يقل ي', 'بيال رسثفل يبا', 'video', 'https://www.youtube.com/watch?v=5CPh4CXdTB8', '[]', 5, 1, '2025-02-17 15:51:34', '2025-02-17 15:51:47'),
(3, 'اختبار 6', 'Test6', 'يبمل يلا ينب يمبنتل نميت', 'slgi lisg dig hrig hi', 'video', 'https://www.youtube.com/watch?v=5CPh4CXdTB8', '[\"1739995111-1694243691-Screenshot-2022-02-08-012937.jpg\"]', 3, 1, '2025-02-20 00:54:38', '2025-02-20 00:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `one_time_availabilities`
--

CREATE TABLE `one_time_availabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time_interval` int(11) NOT NULL DEFAULT 15,
  `slots` text DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `patient_comments`
--

CREATE TABLE `patient_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_comments`
--

INSERT INTO `patient_comments` (`id`, `subject`, `name`, `email`, `mobile`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Name', 'test@gmail.com', '123456789', 'Test Msg', '2025-01-27 23:05:00', '2025-01-27 23:05:00'),
(2, 'Test', 'Name', 'test@gmail.com', '123456789', 'Test Msg', '2025-01-27 23:24:16', '2025-01-27 23:24:16'),
(3, 'Test', 'Name', 'test@gmail.com', '123456789', 'Test Msg', '2025-01-27 23:32:59', '2025-01-27 23:32:59'),
(4, 'bdbdbdd', 'bvdb', 'bdbdbd@gmail.com', '959994545', 'DB dbdb', '2025-01-28 12:47:24', '2025-01-28 12:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `disease` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`disease`)),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `height`, `weight`, `disease`, `user_id`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 101, '2024-06-10 02:17:17', '2024-06-10 02:17:17'),
(13, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 112, '2024-08-17 16:10:08', '2024-08-17 16:10:08'),
(16, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 124, '2025-01-24 16:25:04', '2025-01-24 16:25:04'),
(17, '180.0', '75.0', '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 125, '2025-01-24 16:32:36', '2025-01-24 16:32:36'),
(24, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 134, '2025-01-25 02:13:21', '2025-01-25 02:13:21'),
(25, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 135, '2025-01-28 12:46:34', '2025-01-28 12:46:34'),
(26, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 141, '2025-01-29 14:54:51', '2025-01-29 14:54:51'),
(27, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 142, '2025-01-29 15:02:17', '2025-01-29 15:02:17'),
(28, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 143, '2025-01-29 15:17:47', '2025-01-29 15:17:47'),
(29, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 144, '2025-01-29 15:26:16', '2025-01-29 15:26:16'),
(30, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 145, '2025-01-29 15:30:58', '2025-01-29 15:30:58'),
(31, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 146, '2025-01-29 16:42:15', '2025-01-29 16:42:15'),
(32, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 147, '2025-01-30 13:52:07', '2025-01-30 13:52:07'),
(33, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 148, '2025-01-30 13:56:41', '2025-01-30 13:56:41'),
(34, '170.0', '70.0', '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 149, '2025-01-30 16:40:18', '2025-01-30 16:40:18'),
(35, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 155, '2025-02-05 18:19:45', '2025-02-05 18:19:45'),
(36, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 156, '2025-02-12 14:06:27', '2025-02-12 14:06:27'),
(37, NULL, NULL, '\"{\\\"diabetes\\\":\\\"0\\\",\\\"pressure\\\":\\\"0\\\",\\\"disability\\\":\\\"0\\\",\\\"medical_history\\\":\\\"0\\\"}\"', 157, '2025-02-19 17:37:51', '2025-02-19 17:37:51');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 42, 'MyApp', 'ccbdd2b4cdb309012eacbda599ed49afe4516676b8efa978a426e1023af84dc0', '[\"*\"]', NULL, '2023-09-27 17:14:54', '2023-09-27 17:14:54'),
(2, 'App\\Models\\User', 49, 'MyApp', '2dce728b3fd2791de4c4c5527437fce562f744c7c81255377a58a6e0add89ed4', '[\"*\"]', NULL, '2023-10-10 17:44:32', '2023-10-10 17:44:32'),
(3, 'App\\Models\\User', 52, 'MyApp', 'b1c1aa31d0ff36f575a849beff6d3fb5e0bd973b39bed76591c175f261604f81', '[\"*\"]', NULL, '2023-10-15 11:47:17', '2023-10-15 11:47:17'),
(4, 'App\\Models\\User', 52, 'MyApp', '28498264a1170f907cf3a4f7e4c266bf3ab918e16d3063dd2bdc72b39de2975e', '[\"*\"]', NULL, '2023-10-15 11:51:51', '2023-10-15 11:51:51'),
(5, 'App\\Models\\User', 52, 'MyApp', '79a34160cba4ef2b065374de1418f6853324d0737d70a822f6b47d8b0690a78d', '[\"*\"]', NULL, '2023-10-15 12:21:41', '2023-10-15 12:21:41'),
(6, 'App\\Models\\User', 50, 'MyApp', '413e80b21d49e73102bcb1fb4638f93e0d92d8b293a6c305dfda97ce72632352', '[\"*\"]', '2023-10-19 05:18:34', '2023-10-15 12:26:16', '2023-10-19 05:18:34'),
(7, 'App\\Models\\User', 52, 'MyApp', 'e1b2c9ca0e3842a06d99503bf847e98cc391ddfa0544c018c0e4b94647d4a3f3', '[\"*\"]', NULL, '2023-10-16 06:40:36', '2023-10-16 06:40:36'),
(8, 'App\\Models\\User', 52, 'MyApp', '86b1d7ef92f1f1a970d7668b9b0b214cf770c28b0775bd731689f76d3aa4dcab', '[\"*\"]', NULL, '2023-10-16 07:37:08', '2023-10-16 07:37:08'),
(9, 'App\\Models\\User', 52, 'MyApp', '5a1b7858c296ed99334138ab11aee8ff4ca78d621c50caee8c3c0db27b8c1658', '[\"*\"]', NULL, '2023-10-17 12:40:14', '2023-10-17 12:40:14'),
(10, 'App\\Models\\User', 52, 'MyApp', '92e1d0eed9793d608e2ed223d6aeba2a1f4affc2ed8928e90dcb7ddeae4eca41', '[\"*\"]', NULL, '2023-10-17 12:41:42', '2023-10-17 12:41:42'),
(11, 'App\\Models\\User', 52, 'MyApp', '3bfd240074ac30ef3961558aa7addf753fe58a2d6db04e0a88f3bd7f52e85321', '[\"*\"]', NULL, '2023-10-17 12:47:04', '2023-10-17 12:47:04'),
(12, 'App\\Models\\User', 52, 'MyApp', 'd00fe5c4fb440e9119c0ea2f36d8c3f082340a75e5cdb65462de1f5849ee6945', '[\"*\"]', NULL, '2023-10-17 12:50:38', '2023-10-17 12:50:38'),
(13, 'App\\Models\\User', 52, 'MyApp', '4c72cf8cd159e7cf3738288f5faa47c7df44fc77523d643a6569f8926f64a50c', '[\"*\"]', NULL, '2023-10-18 16:56:47', '2023-10-18 16:56:47'),
(14, 'App\\Models\\User', 52, 'MyApp', '342311d0d0d7047a5604b329a08494ee47ef05af1b6e9426486c36d654d4a34d', '[\"*\"]', NULL, '2023-10-18 17:24:16', '2023-10-18 17:24:16'),
(15, 'App\\Models\\User', 52, 'MyApp', 'd384aa2dd3b1a5a7cde7cd9f7f1ef8570f3005970edfd48795420deb94596f54', '[\"*\"]', '2023-10-19 05:19:09', '2023-10-18 19:05:05', '2023-10-19 05:19:09'),
(16, 'App\\Models\\User', 52, 'MyApp', 'b92d6d727e021aa5a1d3ac57c8346e837e6c1316b410f7fc1fa1950895207e47', '[\"*\"]', '2023-10-30 11:28:54', '2023-10-19 05:42:28', '2023-10-30 11:28:54'),
(17, 'App\\Models\\User', 61, 'MyApp', 'e576963a5f65904eaafafc16a28368baa7e97455376e68c1c48c23ab063d1e9f', '[\"*\"]', NULL, '2023-10-23 19:53:01', '2023-10-23 19:53:01'),
(18, 'App\\Models\\User', 61, 'MyApp', 'a5fa3b4159a760dd635ce4d95ca0bd081e62bfc6aa1b225861a4365d960e6c05', '[\"*\"]', NULL, '2023-10-24 14:10:51', '2023-10-24 14:10:51'),
(19, 'App\\Models\\User', 77, 'MyApp', 'cb7e37ff66c0dcbd6045d9b5a31952a14b35a002e1b2343b1d94de295e59d303', '[\"*\"]', NULL, '2023-10-31 08:39:15', '2023-10-31 08:39:15'),
(20, 'App\\Models\\User', 77, 'MyApp', 'c734387c32da9cf5d7c80c6d464a828c59a7c6f56f78898aafe826a63705b4a1', '[\"*\"]', '2023-10-31 12:07:29', '2023-10-31 08:46:41', '2023-10-31 12:07:29'),
(21, 'App\\Models\\User', 78, 'MyApp', 'c6730b7f73ea592985c64fcceada7a58ac8ec42a4021ad8d5149ceb7af149117', '[\"*\"]', '2023-10-31 10:49:38', '2023-10-31 10:49:03', '2023-10-31 10:49:38'),
(22, 'App\\Models\\User', 78, 'MyApp', 'a0cb24305e0441f3a78fa5ee0330682d6bc28d5b0818973bf3ad2a76cb128ff3', '[\"*\"]', '2023-11-16 16:53:45', '2023-10-31 10:50:28', '2023-11-16 16:53:45'),
(23, 'App\\Models\\User', 82, 'MyApp', '44eb975060f1668bc692cd14c45902f79b1220a3079149d0d384c0d4d9a71ad4', '[\"*\"]', '2023-11-01 13:19:17', '2023-11-01 13:16:22', '2023-11-01 13:19:17'),
(24, 'App\\Models\\User', 82, 'MyApp', 'a4a59fc5d25d03a2f68bc65be696b38fa6c81f47c3dca09f04d4e9f9451ab79c', '[\"*\"]', '2023-11-02 06:12:53', '2023-11-01 13:20:12', '2023-11-02 06:12:53'),
(25, 'App\\Models\\User', 78, 'MyApp', 'dc404b851a628a6533a9bfea01419276a2b18d71a5a78ff3a56385a89fb0bd25', '[\"*\"]', '2023-11-06 16:41:52', '2023-11-02 06:21:45', '2023-11-06 16:41:52'),
(26, 'App\\Models\\User', 78, 'MyApp', '5b5b75e729b627827c9e36b8a91c6edf5b327b3fad7274ccfc3d80c22ea2d532', '[\"*\"]', '2023-11-08 10:05:22', '2023-11-06 16:42:46', '2023-11-08 10:05:22'),
(27, 'App\\Models\\User', 78, 'MyApp', '610a2494eb6489d6b82e5cd36ed5a151d9859d309a7bbbd42ed0b6a69a32080d', '[\"*\"]', '2023-11-17 17:02:05', '2023-11-10 11:10:39', '2023-11-17 17:02:05'),
(28, 'App\\Models\\User', 78, 'MyApp', '5c402c89cc2a4921b5c8a1ed7b29f931b490797e684ccb1e174c940b99fe151b', '[\"*\"]', '2023-11-10 11:35:24', '2023-11-10 11:35:24', '2023-11-10 11:35:24'),
(29, 'App\\Models\\User', 78, 'MyApp', '181f37ab8e68a93cc9ddfbe278da7171705bc14dff81619130a9f3f71889c00f', '[\"*\"]', '2023-11-10 11:41:51', '2023-11-10 11:37:11', '2023-11-10 11:41:51'),
(30, 'App\\Models\\User', 78, 'MyApp', 'a3dbbd95adfcd8d751d287e3b10615424ffdf2545361a26c542769528f52d86b', '[\"*\"]', '2023-11-10 11:52:58', '2023-11-10 11:49:28', '2023-11-10 11:52:58'),
(31, 'App\\Models\\User', 78, 'MyApp', 'c00678688f7b69c858516490409cf740d0bcfe05d43847c5f1262acea6556af9', '[\"*\"]', '2023-11-10 11:54:40', '2023-11-10 11:54:27', '2023-11-10 11:54:40'),
(32, 'App\\Models\\User', 78, 'MyApp', '27d0ddde1477ddf7eb2364831259deb5ddbecd07c03eaf27330e77062ac80d0f', '[\"*\"]', '2023-11-10 12:14:07', '2023-11-10 11:56:09', '2023-11-10 12:14:07'),
(33, 'App\\Models\\User', 78, 'MyApp', 'f57c6ed447eaf1d0e71a62274b8ea0144a8b52088bf2b222396f079ec49862b8', '[\"*\"]', '2023-11-10 12:47:27', '2023-11-10 12:35:59', '2023-11-10 12:47:27'),
(34, 'App\\Models\\User', 78, 'MyApp', '8aaf545b4c8892abc04a2366bc3d045da90f507f785b7a672cfbd9a0e248352c', '[\"*\"]', '2023-11-11 12:48:59', '2023-11-10 13:11:25', '2023-11-11 12:48:59'),
(35, 'App\\Models\\User', 78, 'MyApp', '7c263d5276a580e4e240b2f7785b14e7d60c1859a3c42b80db8faae0d13306b8', '[\"*\"]', '2023-11-14 06:28:28', '2023-11-11 12:59:40', '2023-11-14 06:28:28'),
(36, 'App\\Models\\User', 78, 'MyApp', '80d271985d2051e3a3b54a57ec37e656b5cf380d40cee6994177c005019a06ec', '[\"*\"]', '2023-11-14 06:50:48', '2023-11-14 06:47:42', '2023-11-14 06:50:48'),
(37, 'App\\Models\\User', 78, 'MyApp', '560ef7b827e607fe8c71f9b965fa4737c5b2b5e3b82ba10651b1c099f0008683', '[\"*\"]', '2023-11-14 06:51:38', '2023-11-14 06:51:38', '2023-11-14 06:51:38'),
(38, 'App\\Models\\User', 78, 'MyApp', 'd53974d754baa0f0eb8fba22d6e1e59e5744ce30766552d3a465c64187702303', '[\"*\"]', '2023-11-14 12:36:38', '2023-11-14 12:36:38', '2023-11-14 12:36:38'),
(39, 'App\\Models\\User', 78, 'MyApp', '11a40289ab6383becbed59f7b2b23661b4b72c78be53bd2271d957509a63513d', '[\"*\"]', '2023-11-14 12:40:51', '2023-11-14 12:40:51', '2023-11-14 12:40:51'),
(40, 'App\\Models\\User', 78, 'MyApp', 'fe56947488f84d2ac0578c294deb1f40898a7b86ca6df3e1fd542e2fc83610c0', '[\"*\"]', '2023-11-15 06:49:08', '2023-11-15 06:47:23', '2023-11-15 06:49:08'),
(41, 'App\\Models\\User', 78, 'MyApp', '2c525679ecb9c81e60d4c698de2e3544877d0a57b0d516e6818160776d5cb1da', '[\"*\"]', '2023-11-15 09:28:03', '2023-11-15 07:59:21', '2023-11-15 09:28:03'),
(42, 'App\\Models\\User', 78, 'MyApp', 'd5cee7d4773b9f8ebb984647dfb6815630f75d335bd1881d4ce70ca20cf0eb65', '[\"*\"]', '2023-11-15 09:30:04', '2023-11-15 09:29:02', '2023-11-15 09:30:04'),
(43, 'App\\Models\\User', 78, 'MyApp', '60aa7341b66c724f874fcb2863018c00dd2407d2fb9e8a415aaebbe50110c217', '[\"*\"]', '2023-11-16 08:18:13', '2023-11-16 06:16:44', '2023-11-16 08:18:13'),
(44, 'App\\Models\\User', 78, 'MyApp', 'fc7a798c93e78f87341211598ad5df3a70865ddf53cc76784ac7bf29c677f680', '[\"*\"]', '2023-11-16 08:00:05', '2023-11-16 07:58:52', '2023-11-16 08:00:05'),
(45, 'App\\Models\\User', 78, 'MyApp', '68aa4883753aa96348c0e45c93a8e00e69b43a701220427be42bc63b906418c0', '[\"*\"]', '2023-11-16 08:51:36', '2023-11-16 08:36:53', '2023-11-16 08:51:36'),
(46, 'App\\Models\\User', 78, 'MyApp', 'a77239f1069be6c79527b3eb362907f99ef6c031efdd2a04ef11fdb657d40d67', '[\"*\"]', '2023-11-16 08:58:46', '2023-11-16 08:54:45', '2023-11-16 08:58:46'),
(47, 'App\\Models\\User', 78, 'MyApp', 'e270da290d9bebf1bdecc6a015d92fae060c3a211d0643231f59b61fd8d9d4ca', '[\"*\"]', '2023-11-16 16:51:12', '2023-11-16 09:00:29', '2023-11-16 16:51:12'),
(48, 'App\\Models\\User', 78, 'MyApp', '13747203e289b70aa5eda125d611542c01bf51da9d6ca4a83aab1794b28009e3', '[\"*\"]', '2023-11-16 16:54:06', '2023-11-16 16:51:56', '2023-11-16 16:54:06'),
(49, 'App\\Models\\User', 78, 'MyApp', 'dad819cf6cc471d25c06910978bece5b63cdfd21720932f12d114dfc0ac017e4', '[\"*\"]', '2023-11-18 18:30:43', '2023-11-16 17:06:00', '2023-11-18 18:30:43'),
(50, 'App\\Models\\User', 78, 'MyApp', 'b59cf7165a951eb66ce53ba37eb7dafe11df57182efc66856c047cd43f05890f', '[\"*\"]', '2023-11-16 17:49:05', '2023-11-16 17:42:56', '2023-11-16 17:49:05'),
(51, 'App\\Models\\User', 7, 'MyApp', '435b52c49cdde161deb80233d47b8bdf7e32ff5030203372e98d2a0f2a4bf317', '[\"*\"]', '2024-05-25 22:14:43', '2024-05-25 22:13:59', '2024-05-25 22:14:43'),
(52, 'App\\Models\\User', 7, 'MyApp', 'dc30dec19dc4831b5c982dd195d429a0ecaa829ab7bf9cce3e6ba21478b26baf', '[\"*\"]', NULL, '2024-05-27 15:37:06', '2024-05-27 15:37:06'),
(53, 'App\\Models\\User', 7, 'MyApp', '383cb24e05e51e4feb37b4cc1803d56f5a3d39c78b1f5abf16a2a8613639b184', '[\"*\"]', '2024-05-27 15:46:12', '2024-05-27 15:46:06', '2024-05-27 15:46:12'),
(54, 'App\\Models\\User', 7, 'MyApp', 'a8e4a9ce166b7beb3f156d2784ce920b12790b40461cd8e35b34d5ea95de0489', '[\"*\"]', '2024-05-27 15:47:38', '2024-05-27 15:47:38', '2024-05-27 15:47:38'),
(55, 'App\\Models\\User', 7, 'MyApp', 'ea26205a7e980da0d253de890dc80d67c038f4742862fea0e5e37f870dd58608', '[\"*\"]', '2024-05-27 15:47:44', '2024-05-27 15:47:44', '2024-05-27 15:47:44'),
(56, 'App\\Models\\User', 7, 'MyApp', 'f816947e5ccfe4389df72c8f37f93b32a5357b18496cd6ff6bb28ba6ddb032dc', '[\"*\"]', '2024-05-27 15:51:25', '2024-05-27 15:51:24', '2024-05-27 15:51:25'),
(57, 'App\\Models\\User', 7, 'MyApp', '92bdb4ce934ce6d41324e88d1d3f403935b27c8b819e28e2c03492a181348b3d', '[\"*\"]', '2024-05-27 15:51:41', '2024-05-27 15:51:40', '2024-05-27 15:51:41'),
(58, 'App\\Models\\User', 7, 'MyApp', '60609f6958f158a5b49d51b063c07e8ccbb705e75502127b33d036e5e8f20130', '[\"*\"]', '2024-05-27 15:52:03', '2024-05-27 15:52:03', '2024-05-27 15:52:03'),
(59, 'App\\Models\\User', 7, 'MyApp', 'deadb3bc8e8ac382805015ed0c5693bee5b61f9ab0a651ba74d1e70c96e46e88', '[\"*\"]', '2024-05-27 16:01:05', '2024-05-27 16:01:02', '2024-05-27 16:01:05'),
(60, 'App\\Models\\User', 7, 'MyApp', '8823ea4284ac189784fbef3c993b6c67ae1b57d52858ffb4d20810f755739c0d', '[\"*\"]', '2024-05-27 16:01:59', '2024-05-27 16:01:56', '2024-05-27 16:01:59'),
(61, 'App\\Models\\User', 7, 'MyApp', 'ea070864e7e7f23039cd9721317ee491d4471da7754042fc81b201445612b821', '[\"*\"]', NULL, '2024-05-27 19:12:44', '2024-05-27 19:12:44'),
(62, 'App\\Models\\User', 7, 'MyApp', 'de877f19f50acc76eb299b6e8450faabb1c0816970ee5ea379dc4dc02e747b27', '[\"*\"]', NULL, '2024-05-27 19:18:03', '2024-05-27 19:18:03'),
(63, 'App\\Models\\User', 7, 'MyApp', 'a3d697934c046fa033d44ce1260d7d164402ddc3f40e4e6c01fa9b378fe22ab6', '[\"*\"]', NULL, '2024-05-27 19:18:17', '2024-05-27 19:18:17'),
(64, 'App\\Models\\User', 7, 'MyApp', 'ec2f4351578cbdc6245cd7466f804c01df46cb39759ff87b085bff31d63ed62c', '[\"*\"]', NULL, '2024-05-27 19:19:09', '2024-05-27 19:19:09'),
(65, 'App\\Models\\User', 7, 'MyApp', 'f49ba9913374fe8bab767ba132463b8a5b9c84a784eb740fe695803306d224b2', '[\"*\"]', NULL, '2024-05-27 19:20:00', '2024-05-27 19:20:00'),
(66, 'App\\Models\\User', 7, 'MyApp', 'd17e02ddb56abeb626816d17c0a547176230e348ddb91876c2c64cefc44042fd', '[\"*\"]', '2024-05-27 19:20:38', '2024-05-27 19:20:38', '2024-05-27 19:20:38'),
(67, 'App\\Models\\User', 7, 'MyApp', '92693a3b125584437a1be8d8b614f5ff5a3781ce15e6f2566ed9b775f1784bd8', '[\"*\"]', '2024-05-27 19:20:54', '2024-05-27 19:20:54', '2024-05-27 19:20:54'),
(68, 'App\\Models\\User', 7, 'MyApp', '7b577ca38d25d675abc08a26287e6f153dade7aac4836cddaf8185023bd04f07', '[\"*\"]', '2024-05-27 19:21:48', '2024-05-27 19:21:48', '2024-05-27 19:21:48'),
(69, 'App\\Models\\User', 7, 'MyApp', '4869f7af9e9431bbb44b2f4a6eedb637e0851d7ce676db844abccc4797effa35', '[\"*\"]', '2024-05-27 19:22:23', '2024-05-27 19:22:16', '2024-05-27 19:22:23'),
(70, 'App\\Models\\User', 7, 'MyApp', 'ae0a5ef1795be7f44c8627f62cb1ea57be990c0a824f6cfa4bf95c403df24488', '[\"*\"]', '2024-05-27 19:22:49', '2024-05-27 19:22:49', '2024-05-27 19:22:49'),
(71, 'App\\Models\\User', 7, 'MyApp', 'dc9e5779fc4044bad28924812b58e417b74d8b04f79ea5abdc7a1633f995928f', '[\"*\"]', '2024-05-27 19:24:05', '2024-05-27 19:24:05', '2024-05-27 19:24:05'),
(72, 'App\\Models\\User', 7, 'MyApp', 'b430def6a6485cd12e8ec2f807d04550f91398f6393685b5b347a5dbf6f8f2a7', '[\"*\"]', '2024-05-27 19:24:16', '2024-05-27 19:24:15', '2024-05-27 19:24:16'),
(73, 'App\\Models\\User', 7, 'MyApp', 'a688e42c444aca4e107ce4bf13b9a3bf9661d56b7ae76f42c92191230953c000', '[\"*\"]', '2024-05-27 19:27:39', '2024-05-27 19:27:39', '2024-05-27 19:27:39'),
(74, 'App\\Models\\User', 7, 'MyApp', '345f056f27fb4a0607770e26d5005060fb77b6b833e5a276ccad1628318fd2de', '[\"*\"]', '2024-05-27 20:05:40', '2024-05-27 20:05:40', '2024-05-27 20:05:40'),
(75, 'App\\Models\\User', 7, 'MyApp', '0b20bb910d2ce4948ae32d4db1a55cdf2e4077297b824c5c390e8e6cf7f5ea5d', '[\"*\"]', '2024-05-27 20:06:43', '2024-05-27 20:06:43', '2024-05-27 20:06:43'),
(76, 'App\\Models\\User', 7, 'MyApp', 'a62004d328950adf9cb04b6e02437c8a7cbe83ae6cbbad2a41a0b1b3fe527f89', '[\"*\"]', '2024-05-27 20:07:40', '2024-05-27 20:07:39', '2024-05-27 20:07:40'),
(77, 'App\\Models\\User', 7, 'MyApp', '1e0df427fd549c0a0ec296c2aea14dfe20f4719e265d356a1c88256e6fd3b076', '[\"*\"]', '2024-05-27 20:08:00', '2024-05-27 20:08:00', '2024-05-27 20:08:00'),
(78, 'App\\Models\\User', 7, 'MyApp', 'c881f1c63d1dfc5e76c432bd11b837194e355cf4f6092d08a03c9f510ec2bd22', '[\"*\"]', '2024-05-27 20:14:16', '2024-05-27 20:14:16', '2024-05-27 20:14:16'),
(79, 'App\\Models\\User', 7, 'MyApp', '8cd3f1405ea8c442b6b2b997a1c8f1c07c7b4d88fd57b801093eee3da813bb49', '[\"*\"]', '2024-05-27 20:15:05', '2024-05-27 20:15:05', '2024-05-27 20:15:05'),
(80, 'App\\Models\\User', 7, 'MyApp', 'c7afcf2c14e8896ab1a083c027a2b430cf19cd03ba6ed4bc62922828464dc1f5', '[\"*\"]', '2024-05-27 20:15:07', '2024-05-27 20:15:06', '2024-05-27 20:15:07'),
(81, 'App\\Models\\User', 7, 'MyApp', 'a5c0f244656a613c975a6a4db999aa989372a487042df094b6f645517b7df709', '[\"*\"]', '2024-05-27 20:15:48', '2024-05-27 20:15:48', '2024-05-27 20:15:48'),
(82, 'App\\Models\\User', 7, 'MyApp', '6c14ab88b97898995e80d0b2956593cfdf241de9fd6c4654e9cb75377d29a08c', '[\"*\"]', '2024-05-27 20:15:53', '2024-05-27 20:15:53', '2024-05-27 20:15:53'),
(83, 'App\\Models\\User', 7, 'MyApp', '511789a356c9a50e91f5970922416e96d722407bddca7756f4e3641f922e88e6', '[\"*\"]', '2024-05-27 20:15:59', '2024-05-27 20:15:58', '2024-05-27 20:15:59'),
(84, 'App\\Models\\User', 7, 'MyApp', '83e82f2e23e5281828ab7f828421764728b3be23e0266c39bc1cb4c68ddcfb07', '[\"*\"]', '2024-05-27 20:16:06', '2024-05-27 20:16:06', '2024-05-27 20:16:06'),
(85, 'App\\Models\\User', 7, 'MyApp', 'b485998724467c9c67f9731726136d804af7cfa52460fc0bc05a375232c0eea0', '[\"*\"]', '2024-05-27 20:16:16', '2024-05-27 20:16:15', '2024-05-27 20:16:16'),
(86, 'App\\Models\\User', 7, 'MyApp', 'd9df3635555a178f3036ec28b0042e91428cb046826271c4f17adc127fd25bc7', '[\"*\"]', '2024-05-27 20:17:36', '2024-05-27 20:17:36', '2024-05-27 20:17:36'),
(87, 'App\\Models\\User', 7, 'MyApp', '13605bb671d2531ce9f35b4f67d72bb965010c4ec17cea22084ee5022c0c2455', '[\"*\"]', '2024-05-28 18:14:58', '2024-05-28 18:14:58', '2024-05-28 18:14:58'),
(88, 'App\\Models\\User', 7, 'MyApp', '2f180f71abf42d25b83815a6d1b7d6164ef3f1d0ce99a3f854e8fcf9734b9f08', '[\"*\"]', '2024-05-28 18:24:38', '2024-05-28 18:24:38', '2024-05-28 18:24:38'),
(89, 'App\\Models\\User', 7, 'MyApp', 'bd776382f3ddca0481c895cb25c9214e213112d177fdc5a4cb14cfc4498b090b', '[\"*\"]', '2024-05-29 19:44:40', '2024-05-29 19:44:40', '2024-05-29 19:44:40'),
(90, 'App\\Models\\User', 7, 'MyApp', '9d3f0767caa68080fc2ae2de790f2654f208f64fd2ac1033d2422d4623ec733b', '[\"*\"]', '2024-05-29 19:45:04', '2024-05-29 19:45:04', '2024-05-29 19:45:04'),
(91, 'App\\Models\\User', 7, 'MyApp', 'eb382148df03da3f5e0f853b2872fc0c0f0c58ddd0e69927d8deea563bf234d8', '[\"*\"]', '2024-05-29 19:45:07', '2024-05-29 19:45:07', '2024-05-29 19:45:07'),
(92, 'App\\Models\\User', 7, 'MyApp', '129bcb29d9c5f39f08880498b3f7a8b0d57bbc412d4a3ee80a4d6cad5a99c38c', '[\"*\"]', '2024-05-29 19:45:20', '2024-05-29 19:45:20', '2024-05-29 19:45:20'),
(93, 'App\\Models\\User', 7, 'MyApp', 'da937aa162581be7019949b21e8e16d143ecdba7681ba9b80e0f6e6223410927', '[\"*\"]', '2024-05-29 19:45:22', '2024-05-29 19:45:20', '2024-05-29 19:45:22'),
(94, 'App\\Models\\User', 7, 'MyApp', '2fa311b80291a004d12ed082e2961b15444baf6ad0d0a9152273d38ef06c079c', '[\"*\"]', '2024-05-29 19:47:08', '2024-05-29 19:47:07', '2024-05-29 19:47:08'),
(95, 'App\\Models\\User', 7, 'MyApp', '6d4b2f03d730eeb77a9a6718f1e9417268798242912fdcac64c4397bc93e2c9d', '[\"*\"]', '2024-05-29 19:47:10', '2024-05-29 19:47:08', '2024-05-29 19:47:10'),
(96, 'App\\Models\\User', 7, 'MyApp', '2777f66498ca67e72322f5f4ff2f7d3e8a504bb70ef9d9500f9308e32190f200', '[\"*\"]', NULL, '2024-05-29 19:49:57', '2024-05-29 19:49:57'),
(97, 'App\\Models\\User', 7, 'MyApp', '8336634982d6d1add8add65b3f0bf8d215d491d87a7675e149457d76f9fad85f', '[\"*\"]', '2024-05-29 19:49:57', '2024-05-29 19:49:57', '2024-05-29 19:49:57'),
(98, 'App\\Models\\User', 7, 'MyApp', 'cd6d424d13b36cb747e7547aff6e083506b10a514e8dc2df36b8d34ed70f63b1', '[\"*\"]', '2024-05-29 20:23:29', '2024-05-29 20:23:29', '2024-05-29 20:23:29'),
(99, 'App\\Models\\User', 7, 'MyApp', '2f45d1f2ad84810003b752556e725e20b5fadcd834f61f2953e479b73a9a60da', '[\"*\"]', '2024-05-29 20:23:29', '2024-05-29 20:23:29', '2024-05-29 20:23:29'),
(100, 'App\\Models\\User', 7, 'MyApp', 'ba00deb1a6af05b0376232381cb2fe87bbaf8bda9eb95b29dd3cd64f0db09ff6', '[\"*\"]', '2024-05-29 20:31:44', '2024-05-29 20:31:44', '2024-05-29 20:31:44'),
(101, 'App\\Models\\User', 7, 'MyApp', 'db1f6d206dbef5d97bee84f0db532f4f4f5fe1bb260fbff06d5bcad4106a6656', '[\"*\"]', '2024-05-29 20:31:46', '2024-05-29 20:31:44', '2024-05-29 20:31:46'),
(102, 'App\\Models\\User', 7, 'MyApp', '4f273de394bb8b72cfba4898250e9a77d61b7cd1b30ede0cf41f452d93060d55', '[\"*\"]', '2024-05-29 20:38:59', '2024-05-29 20:38:58', '2024-05-29 20:38:59'),
(103, 'App\\Models\\User', 7, 'MyApp', 'ed8cb0bd044b36024a0fd65e882dbea2b3417592e4bf5ae16221d99ba3c28240', '[\"*\"]', '2024-05-29 20:38:59', '2024-05-29 20:38:59', '2024-05-29 20:38:59'),
(104, 'App\\Models\\User', 7, 'MyApp', 'c01ba8318c197ff50e0ec6b8b86632ac1afbd69b6fec2e7f8058b0bbcde5f79d', '[\"*\"]', '2024-05-29 22:04:56', '2024-05-29 22:04:55', '2024-05-29 22:04:56'),
(105, 'App\\Models\\User', 7, 'MyApp', '8e6e43b44b57dccb208618e8dea5d7aee4fa6207483f4ad2452b5cd210d50e15', '[\"*\"]', '2024-05-29 23:02:25', '2024-05-29 23:02:24', '2024-05-29 23:02:25'),
(106, 'App\\Models\\User', 7, 'MyApp', '704a2bec990a0251b934be4fbb5c4c8d7d1041da1d05ef00f24a50a6ed3eb679', '[\"*\"]', '2024-05-29 23:02:26', '2024-05-29 23:02:25', '2024-05-29 23:02:26'),
(107, 'App\\Models\\User', 7, 'MyApp', 'd48ef52de784621289b9a627efff58e1e1a9725c6ae75d497c0f24d6152ae41d', '[\"*\"]', '2024-05-29 23:05:44', '2024-05-29 23:05:43', '2024-05-29 23:05:44'),
(108, 'App\\Models\\User', 7, 'MyApp', '8740fb082c3f81544b02fd679a3091145a5426c13bf930f381cd48ce4c45dae5', '[\"*\"]', '2024-05-29 23:05:45', '2024-05-29 23:05:44', '2024-05-29 23:05:45'),
(109, 'App\\Models\\User', 7, 'MyApp', '15eb49d12a784ca265f028413aacc81b2f446af17dc4b8eec2b2f38e5ee5a32d', '[\"*\"]', '2024-05-30 02:12:22', '2024-05-30 02:12:21', '2024-05-30 02:12:22'),
(110, 'App\\Models\\User', 7, 'MyApp', 'dc8407c290d3858a9ecf1514c368e80f752e1f24be4844b1b138bb3f1a83e4fb', '[\"*\"]', '2024-05-30 02:41:46', '2024-05-30 02:41:45', '2024-05-30 02:41:46'),
(111, 'App\\Models\\User', 7, 'MyApp', 'e07456cf43b45c1892b8b6e5bf62375a5c0712cf5dd11cc865702ba00a411c53', '[\"*\"]', '2024-05-30 02:41:48', '2024-05-30 02:41:46', '2024-05-30 02:41:48'),
(112, 'App\\Models\\User', 7, 'MyApp', 'dfc3f406e3125cfe7100e24628e626ea3c9ab046e0e50fc67bd1ec286f769b98', '[\"*\"]', '2024-05-30 02:45:08', '2024-05-30 02:45:08', '2024-05-30 02:45:08'),
(113, 'App\\Models\\User', 7, 'MyApp', 'a4254f8d55d229418af13d37b770c7d7dc9bd817394479427170511fa0518862', '[\"*\"]', '2024-05-30 02:45:10', '2024-05-30 02:45:08', '2024-05-30 02:45:10'),
(114, 'App\\Models\\User', 7, 'MyApp', '16f980d84d0b088dad00d38cc5b185178dfb58b9dc750f22bf400296a0c2fc28', '[\"*\"]', '2024-05-30 03:23:26', '2024-05-30 03:23:25', '2024-05-30 03:23:26'),
(115, 'App\\Models\\User', 7, 'MyApp', 'c7ff7c71985030d9bb1b50d460fe084d3900fe1507f7ec64d97a7c8e6a0bd94c', '[\"*\"]', '2024-05-30 03:23:27', '2024-05-30 03:23:26', '2024-05-30 03:23:27'),
(116, 'App\\Models\\User', 7, 'MyApp', 'a6b9c1a53b8c11d7b5ea149b27708f905d579a262f94acd39bb45fc1b1335415', '[\"*\"]', '2024-05-30 03:26:50', '2024-05-30 03:26:49', '2024-05-30 03:26:50'),
(117, 'App\\Models\\User', 7, 'MyApp', '7b1d775a9c2660da83d26fd1b7ef1cec1347621f9848eba235fc2063dd34ae8f', '[\"*\"]', '2024-06-02 22:35:33', '2024-06-02 22:35:32', '2024-06-02 22:35:33'),
(118, 'App\\Models\\User', 7, 'MyApp', '96bf382d74b199833d86ea87ba05e5e9b335536c4feaa7a016dcd4c3609bda13', '[\"*\"]', '2024-06-02 23:18:43', '2024-06-02 23:18:43', '2024-06-02 23:18:43'),
(119, 'App\\Models\\User', 7, 'MyApp', '54f46a4f249cabd91af0153d66940f5b95b3cbeb7cb73ab367afda49108206c4', '[\"*\"]', '2024-06-02 23:18:45', '2024-06-02 23:18:43', '2024-06-02 23:18:45'),
(120, 'App\\Models\\User', 7, 'MyApp', '90d50f7db546adf2a00fe4bf7e40c6954c9fe3f62285532313e86d12d34e0ff7', '[\"*\"]', '2024-06-02 23:29:36', '2024-06-02 23:29:36', '2024-06-02 23:29:36'),
(121, 'App\\Models\\User', 7, 'MyApp', 'e43f6ab5fe6c4340dcd0467c57bf3568bd3bb41f1980ab1294a0655a1b7b19e8', '[\"*\"]', '2024-06-02 23:29:36', '2024-06-02 23:29:36', '2024-06-02 23:29:36'),
(122, 'App\\Models\\User', 7, 'MyApp', 'cd924a9f6c8333002d4b9d1ca16b4464d875013c6d4a4034e8fbc54836e63bf6', '[\"*\"]', '2024-06-03 02:14:35', '2024-06-03 02:14:35', '2024-06-03 02:14:35'),
(123, 'App\\Models\\User', 7, 'MyApp', '8f6b73e0bd732af4d596b8928a8149feb8ae2967e370f70b89f97f9f773f6ecc', '[\"*\"]', '2024-06-03 02:22:01', '2024-06-03 02:22:01', '2024-06-03 02:22:01'),
(124, 'App\\Models\\User', 7, 'MyApp', '55da28d5ac02c98d79ae23e6a37e367135660973a4489d6b365ce8eb89367cf8', '[\"*\"]', '2024-06-03 02:34:25', '2024-06-03 02:34:24', '2024-06-03 02:34:25'),
(125, 'App\\Models\\User', 7, 'MyApp', '75873f35fa5e83dcd16aec1cb477d7ac2b3b290d59d67efb2080156fd45cbd95', '[\"*\"]', '2024-06-04 00:36:15', '2024-06-04 00:36:14', '2024-06-04 00:36:15'),
(126, 'App\\Models\\User', 7, 'MyApp', 'a0c2c295c67190a112700712ebd0713e98904e029a7f35de782892a240e06f17', '[\"*\"]', '2024-06-04 02:01:32', '2024-06-04 02:01:32', '2024-06-04 02:01:32'),
(127, 'App\\Models\\User', 7, 'MyApp', '2343f62c4f1719245f27f2246fd6bdcbee1af58239b83f4746de6873369089c4', '[\"*\"]', '2024-06-04 02:01:32', '2024-06-04 02:01:32', '2024-06-04 02:01:32'),
(128, 'App\\Models\\User', 7, 'MyApp', '95eb100e4a6523f1fb1c5ae1d7179e6a1ffe18c750a8b2fdd772ce74f4d21f59', '[\"*\"]', '2024-06-04 19:38:45', '2024-06-04 19:38:45', '2024-06-04 19:38:45'),
(129, 'App\\Models\\User', 7, 'MyApp', '62ba17918199b23a23240442ebbb28a594a947120a182e0db116f3bc8a3659bc', '[\"*\"]', '2024-06-04 20:13:30', '2024-06-04 20:13:30', '2024-06-04 20:13:30'),
(130, 'App\\Models\\User', 7, 'MyApp', '2657b478a3da30f29561b70841907f0ea167272159f810aafcfbe5ea6eeaecae', '[\"*\"]', '2024-06-04 20:14:32', '2024-06-04 20:14:31', '2024-06-04 20:14:32'),
(131, 'App\\Models\\User', 7, 'MyApp', '86abf5c196a2851f1d979bd63d9f6225304c2dd9945960214d359a464912f633', '[\"*\"]', '2024-06-04 20:14:33', '2024-06-04 20:14:32', '2024-06-04 20:14:33'),
(132, 'App\\Models\\User', 7, 'MyApp', 'f3a77d9fad0cabeb8d52316f5f3b74e9fd3fb150f26dd0aa08def16ee083d08e', '[\"*\"]', '2024-06-05 00:12:41', '2024-06-05 00:12:40', '2024-06-05 00:12:41'),
(133, 'App\\Models\\User', 7, 'MyApp', 'fc1637e33afd14f5ba3831cba21609aa25948335294403eca119ac74bff88873', '[\"*\"]', '2024-06-05 01:32:46', '2024-06-05 01:32:46', '2024-06-05 01:32:46'),
(134, 'App\\Models\\User', 7, 'MyApp', '84dc9ef96162141c322c7870b5f1be71ede0f214064d8093e1cdaaf6a23acbf9', '[\"*\"]', '2024-06-05 01:32:47', '2024-06-05 01:32:46', '2024-06-05 01:32:47'),
(135, 'App\\Models\\User', 7, 'MyApp', 'fb34c464e5f126b92838dcb539c64d67b8a11dbf26065dd5291e6456b0d00cb0', '[\"*\"]', '2024-06-05 19:06:52', '2024-06-05 19:06:51', '2024-06-05 19:06:52'),
(136, 'App\\Models\\User', 7, 'MyApp', 'd005d2d8e1da95340ddd4f223f836d357a1cf9dd22a678a1fd776ed04657857f', '[\"*\"]', '2024-06-05 19:16:06', '2024-06-05 19:16:05', '2024-06-05 19:16:06'),
(137, 'App\\Models\\User', 7, 'MyApp', '2ea8f1731868b0f927a0d946c5cf3067f8a68e8d2d9d7446d56c23233eb689c6', '[\"*\"]', '2024-06-05 19:16:06', '2024-06-05 19:16:06', '2024-06-05 19:16:06'),
(138, 'App\\Models\\User', 7, 'MyApp', 'c252d1eba42944c829a57fbdca22aef16330384636c3be90d34660844e7f58ee', '[\"*\"]', '2024-06-05 19:40:41', '2024-06-05 19:40:40', '2024-06-05 19:40:41'),
(139, 'App\\Models\\User', 7, 'MyApp', '66f15a8f2a8b03c2d11d337bac19d89886d15cb379a0f3d6219bbe78a31b399f', '[\"*\"]', '2024-06-05 19:49:49', '2024-06-05 19:49:49', '2024-06-05 19:49:49'),
(140, 'App\\Models\\User', 7, 'MyApp', 'ca7423cc3b62b8720543781f89a478ef6197714bc047508515299c2ec64d54c3', '[\"*\"]', '2024-06-05 19:49:51', '2024-06-05 19:49:49', '2024-06-05 19:49:51'),
(141, 'App\\Models\\User', 7, 'MyApp', 'd11213a54e7746a631b5c00ff73350d328f018d90886c5a90bb206d964b1e5d9', '[\"*\"]', '2024-06-05 19:52:06', '2024-06-05 19:52:05', '2024-06-05 19:52:06'),
(142, 'App\\Models\\User', 7, 'MyApp', 'e744544a6a8e54728f8fb49c7d7f83e886cdaf18e18fa6441b482a63e4928d1a', '[\"*\"]', '2024-06-05 19:52:06', '2024-06-05 19:52:05', '2024-06-05 19:52:06'),
(143, 'App\\Models\\User', 7, 'MyApp', '5bf909a5a6445214868df1fe6d47fab996b8ed3258b24d18665129536a8719ef', '[\"*\"]', NULL, '2024-06-05 19:58:29', '2024-06-05 19:58:29'),
(144, 'App\\Models\\User', 7, 'MyApp', '6b5006e7925dae8a9d700c96380a27604336e62bacdbd748c3ebf11c3bb1975a', '[\"*\"]', NULL, '2024-06-05 19:58:29', '2024-06-05 19:58:29'),
(145, 'App\\Models\\User', 7, 'MyApp', '06ddc8aeae32d0acdb659448cab9a63de48f0b5e292ae7aecc015a12b0f4df52', '[\"*\"]', '2024-06-05 19:58:34', '2024-06-05 19:58:34', '2024-06-05 19:58:34'),
(146, 'App\\Models\\User', 7, 'MyApp', '8337606128de874f19968a745cf13277525d7ed7264da6721c415bf6505735d6', '[\"*\"]', '2024-06-05 19:58:34', '2024-06-05 19:58:34', '2024-06-05 19:58:34'),
(147, 'App\\Models\\User', 7, 'MyApp', 'e4c941121df77d2aa229e48bc00a9bf9b51217adb6597f3c9ebbe48c5e3c49b6', '[\"*\"]', '2024-06-05 20:00:04', '2024-06-05 20:00:03', '2024-06-05 20:00:04'),
(148, 'App\\Models\\User', 7, 'MyApp', '7ef702ee4af9de76c3b620ccb965836e4c0d523e88534882851910b072f34bb4', '[\"*\"]', '2024-06-05 20:00:05', '2024-06-05 20:00:04', '2024-06-05 20:00:05'),
(149, 'App\\Models\\User', 7, 'MyApp', '78490e86d0caae5f1e360b7c20bc09378a2a2eb5df519646b1d73203c0a3737a', '[\"*\"]', '2024-06-05 20:03:15', '2024-06-05 20:03:15', '2024-06-05 20:03:15'),
(150, 'App\\Models\\User', 7, 'MyApp', 'f56e3e4b742fecd103852fe4a4129652dba80bf377d457bd2afaac835916d1d0', '[\"*\"]', '2024-06-05 20:03:16', '2024-06-05 20:03:15', '2024-06-05 20:03:16'),
(151, 'App\\Models\\User', 7, 'MyApp', 'a1962e14021f557fe7697fb4c2cf42e099e18a00478b57ee7f82bb7982f04837', '[\"*\"]', '2024-06-05 20:03:59', '2024-06-05 20:03:58', '2024-06-05 20:03:59'),
(152, 'App\\Models\\User', 7, 'MyApp', '0a619974afed8bec1dcabbc2d5b870fda1733fed28063d1326d30045899c9fa6', '[\"*\"]', '2024-06-05 20:04:01', '2024-06-05 20:03:59', '2024-06-05 20:04:01'),
(153, 'App\\Models\\User', 7, 'MyApp', '9d8230127bb96417d637755c7515faa04cdd11a28e39bbbf3ba8e370a9356710', '[\"*\"]', '2024-06-05 21:50:33', '2024-06-05 21:50:33', '2024-06-05 21:50:33'),
(154, 'App\\Models\\User', 7, 'MyApp', 'f85892df2b26680c60a00dd56e972da9b3c761ebb3076da160a93ac4e5f7c1a3', '[\"*\"]', '2024-06-05 21:55:59', '2024-06-05 21:55:59', '2024-06-05 21:55:59'),
(155, 'App\\Models\\User', 7, 'MyApp', '88037dd4f1c5ed4dc5e2e39317f57faa763043182f69f65767e00a152690d7b0', '[\"*\"]', '2024-06-05 21:56:01', '2024-06-05 21:55:59', '2024-06-05 21:56:01'),
(156, 'App\\Models\\User', 7, 'MyApp', 'dbd61405a7ccdb3aed543b75ef463d83314b3305eca16dc27543ae815c67801e', '[\"*\"]', '2024-06-05 22:08:32', '2024-06-05 22:08:32', '2024-06-05 22:08:32'),
(157, 'App\\Models\\User', 7, 'MyApp', 'ac60886578c2630ec47fedf57638a1a8ba03812d6726719c3ce7eaeb71a42117', '[\"*\"]', '2024-06-05 22:08:32', '2024-06-05 22:08:32', '2024-06-05 22:08:32'),
(158, 'App\\Models\\User', 7, 'MyApp', '80e673b5ad1862826f29a79668d6269ff37254c8d0f68e25809919bdd808e90c', '[\"*\"]', '2024-06-06 02:14:56', '2024-06-06 02:14:56', '2024-06-06 02:14:56'),
(159, 'App\\Models\\User', 7, 'MyApp', 'f90d8dac958f9bc4fbd760e8f892c9414b8625913709920bc687a4d031d5811a', '[\"*\"]', '2024-06-06 02:30:55', '2024-06-06 02:30:54', '2024-06-06 02:30:55'),
(160, 'App\\Models\\User', 7, 'MyApp', '0c884f64ed0c78b53442958821fe385df5954cdd255c04636b953b652fb793a1', '[\"*\"]', '2024-06-06 02:30:57', '2024-06-06 02:30:55', '2024-06-06 02:30:57'),
(161, 'App\\Models\\User', 100, 'MyApp', 'bfc795df1e408c21cbec1ded7799f9b47831de83592a5d9afa30653e4a94d796', '[\"*\"]', '2024-07-20 23:37:14', '2024-06-09 05:39:57', '2024-07-20 23:37:14'),
(162, 'App\\Models\\User', 7, 'MyApp', '6eb6ea2ec4f0212599f20afe0033aadfb35858ff73c9f240ce138ccf9945d1fc', '[\"*\"]', '2024-06-10 00:31:59', '2024-06-10 00:31:56', '2024-06-10 00:31:59'),
(163, 'App\\Models\\User', 7, 'MyApp', '62034d87fee5149cdaa7bab1356e86402be66d4e9500d4ba8404b078d3ad7b53', '[\"*\"]', '2024-06-10 00:32:45', '2024-06-10 00:32:43', '2024-06-10 00:32:45'),
(164, 'App\\Models\\User', 7, 'MyApp', '51c9b0fef86d5fec9555a846709c53d220998f0a1159fdd501967c6e179e0f96', '[\"*\"]', '2024-06-10 00:34:11', '2024-06-10 00:32:45', '2024-06-10 00:34:11'),
(165, 'App\\Models\\User', 7, 'MyApp', 'ac322154f1e15d4519e0f2a0f66d6c335395a4bef8306c05321b5f43c5a6c066', '[\"*\"]', '2024-06-10 01:07:14', '2024-06-10 01:07:11', '2024-06-10 01:07:14'),
(166, 'App\\Models\\User', 7, 'MyApp', '8ac93bedeaeaf57bd5b27c46a0d7b2e40193f8b2fc3adced8bb9f6d4a2a4d3d4', '[\"*\"]', '2024-06-10 01:07:14', '2024-06-10 01:07:11', '2024-06-10 01:07:14'),
(167, 'App\\Models\\User', 7, 'MyApp', 'b460b007977c71ee696d59fcaaac0b467ce1656f51678426c32fb795b49f840e', '[\"*\"]', '2024-06-10 01:29:37', '2024-06-10 01:29:36', '2024-06-10 01:29:37'),
(168, 'App\\Models\\User', 7, 'MyApp', '612576197f9f81b60568bba1ce4931bb5977538e9fc2f577c809aad1854030e5', '[\"*\"]', '2024-06-10 01:29:38', '2024-06-10 01:29:37', '2024-06-10 01:29:38'),
(169, 'App\\Models\\User', 7, 'MyApp', '6601f0551cb0c82a99964c4ca93c669c7fa2d146bc86770818aec93b0dc2837a', '[\"*\"]', '2024-06-10 01:30:57', '2024-06-10 01:30:57', '2024-06-10 01:30:57'),
(170, 'App\\Models\\User', 7, 'MyApp', 'ec1b8d91b3647181f9ee7d638f549ae4a186628a0dbccb3c9625e62b50bd1c97', '[\"*\"]', '2024-06-10 01:32:17', '2024-06-10 01:32:16', '2024-06-10 01:32:17'),
(171, 'App\\Models\\User', 7, 'MyApp', 'beb1c370d6b7f795897b18b8abb39f742233d5f16cd0cfe4334b63eb734f5520', '[\"*\"]', '2024-06-10 01:33:48', '2024-06-10 01:33:48', '2024-06-10 01:33:48'),
(172, 'App\\Models\\User', 7, 'MyApp', '5935ab00a32b00d8ec982363ceefeadb7b679bc73c1754e9af5de89c9f5ad943', '[\"*\"]', '2024-06-10 01:34:25', '2024-06-10 01:34:24', '2024-06-10 01:34:25'),
(173, 'App\\Models\\User', 106, 'MyApp', '54fbe7e87ef4def603052c982b9fc657739d7edc366f1bd2e43c6f7bf5f6e07c', '[\"*\"]', NULL, '2024-06-10 02:54:27', '2024-06-10 02:54:27'),
(174, 'App\\Models\\User', 107, 'MyApp', '8abfddfc9c8e056c5f4d0a22bbfb19cc149592da50d285e6081f3e15b892aa82', '[\"*\"]', NULL, '2024-06-10 02:56:21', '2024-06-10 02:56:21'),
(175, 'App\\Models\\User', 108, 'MyApp', '590f84bb8214219633aebabe63e3ef3088615e69f5c43d8094e288be672fc4c2', '[\"*\"]', '2024-06-10 02:57:21', '2024-06-10 02:57:15', '2024-06-10 02:57:21'),
(176, 'App\\Models\\User', 109, 'MyApp', 'ae3f5721a8260ffc2e7635f1cd56167e91b0b4fdac61d2164961009cecd0c9b5', '[\"*\"]', '2024-06-10 02:58:14', '2024-06-10 02:58:13', '2024-06-10 02:58:14'),
(177, 'App\\Models\\User', 109, 'MyApp', 'fe9c602be387d2db1f2f968074d983894d9f358c26ebf7b2704cc2c0449a11df', '[\"*\"]', '2024-06-10 02:59:15', '2024-06-10 02:59:15', '2024-06-10 02:59:15'),
(178, 'App\\Models\\User', 109, 'MyApp', '33946670a9859bc8d16ecd8bde56669ca41611f7f9870b9995c288808dde614c', '[\"*\"]', '2024-06-10 02:59:17', '2024-06-10 02:59:15', '2024-06-10 02:59:17'),
(179, 'App\\Models\\User', 110, 'MyApp', 'b7ac74a80d6d9615b338d6adfdb173bd44568d9cc8ba911e91bdb4b8a22e6784', '[\"*\"]', '2024-06-11 02:08:10', '2024-06-11 02:08:09', '2024-06-11 02:08:10'),
(180, 'App\\Models\\User', 110, 'MyApp', '79a2030df80aceaaf885e109bb7e9b281b915694698acf8cefcb43969ac0e83b', '[\"*\"]', '2024-06-11 02:15:12', '2024-06-11 02:15:12', '2024-06-11 02:15:12'),
(181, 'App\\Models\\User', 110, 'MyApp', '24d5f2e5f3f68bd65334f716a906a2b9bc2781f24b8ca44f579e09bbc80dff09', '[\"*\"]', '2024-06-11 02:15:12', '2024-06-11 02:15:12', '2024-06-11 02:15:12'),
(182, 'App\\Models\\User', 110, 'MyApp', '4eda17c59ab654b10714a59860a8a4caa9238da1c923e424208f8819a3fbdb5f', '[\"*\"]', '2024-06-11 02:17:38', '2024-06-11 02:17:15', '2024-06-11 02:17:38'),
(183, 'App\\Models\\User', 110, 'MyApp', 'bf5354a11a98500343b525dd7687468eb70b325249f7b1d4e8431e7fa2827d91', '[\"*\"]', '2024-06-11 02:17:38', '2024-06-11 02:17:15', '2024-06-11 02:17:38'),
(184, 'App\\Models\\User', 110, 'MyApp', '98af417bc7ced0e62fb97cc71081cc217eb72d77f6ca418636a248d3177ff68e', '[\"*\"]', '2024-06-11 02:20:18', '2024-06-11 02:20:15', '2024-06-11 02:20:18'),
(185, 'App\\Models\\User', 110, 'MyApp', '0059001d7781ea1274cee6f815c7c86654bf7dbe3968a349b42baf198ba76253', '[\"*\"]', '2024-06-11 02:20:21', '2024-06-11 02:20:16', '2024-06-11 02:20:21'),
(186, 'App\\Models\\User', 111, 'MyApp', '4e52c2e2abeb8b84caf49b30328ee38eb6cac70579c539366ecee1f170db4bc5', '[\"*\"]', '2024-06-11 02:30:47', '2024-06-11 02:30:42', '2024-06-11 02:30:47'),
(187, 'App\\Models\\User', 7, 'MyApp', '22a1ef463512c948389822f3e9cfde09ec65a3b5e0ca42bf91e84a617892f740', '[\"*\"]', '2024-06-11 02:35:59', '2024-06-11 02:35:59', '2024-06-11 02:35:59'),
(188, 'App\\Models\\User', 7, 'MyApp', '2db98590546859ed174803a25fa3ce756b80b14bf3797ef140f4b3532129f243', '[\"*\"]', '2024-06-11 02:41:24', '2024-06-11 02:41:19', '2024-06-11 02:41:24'),
(189, 'App\\Models\\User', 7, 'MyApp', '1adc12f24efb29c262825d0246e9605449de1b52d752fe31bd0b6386a674d712', '[\"*\"]', '2024-06-11 02:41:24', '2024-06-11 02:41:22', '2024-06-11 02:41:24'),
(190, 'App\\Models\\User', 111, 'MyApp', '2b736f0660b6b3a86cfdada864c5d63d0379ac88ca1aa407f4905586ff971dab', '[\"*\"]', '2024-06-11 02:54:02', '2024-06-11 02:54:02', '2024-06-11 02:54:02'),
(191, 'App\\Models\\User', 111, 'MyApp', '5f47362c7f60004d2baf0f517e3b3feb099974e5835db2e74f20dc1c5158c046', '[\"*\"]', NULL, '2024-06-11 02:54:18', '2024-06-11 02:54:18'),
(192, 'App\\Models\\User', 111, 'MyApp', '28b94c54019eb87bf9d851d4e5c882f105c5b74ef010f038fc8f1f6ebf8712d9', '[\"*\"]', '2024-06-11 02:54:18', '2024-06-11 02:54:18', '2024-06-11 02:54:18'),
(193, 'App\\Models\\User', 7, 'MyApp', '1e31b7a18680350d54c2986e26072620b30cb3019823ffa2f9f0f2ea44ab2981', '[\"*\"]', '2024-06-11 03:00:23', '2024-06-11 02:59:37', '2024-06-11 03:00:23'),
(194, 'App\\Models\\User', 7, 'MyApp', '4387e12d3da2b7391fc92c18e098a3aa008ac567ddd8aab97f729e1106187fee', '[\"*\"]', '2024-06-11 03:07:51', '2024-06-11 03:07:51', '2024-06-11 03:07:51'),
(195, 'App\\Models\\User', 111, 'MyApp', '7a3ceb4fee1addf70a4dc53dd3f34f7e491876540cf3d4ee2511c0f1f99a3c32', '[\"*\"]', '2024-06-11 03:13:56', '2024-06-11 03:13:56', '2024-06-11 03:13:56'),
(196, 'App\\Models\\User', 106, 'MyApp', 'acd4c8a298ffd4175e019dcef6b49f959cc5bd9c9a02920970863ec0b6e772d6', '[\"*\"]', '2024-06-12 01:30:26', '2024-06-12 01:30:25', '2024-06-12 01:30:26'),
(197, 'App\\Models\\User', 7, 'MyApp', '199954fc49e03fc9946676b169cc5300759f09588f6d42117582c3b425e27efc', '[\"*\"]', '2024-06-26 22:22:03', '2024-06-26 22:22:03', '2024-06-26 22:22:03'),
(198, 'App\\Models\\User', 7, 'MyApp', 'cc22c45abb3d6f53b2f456dc1e1a93df5e123ec51cbaabb7e190b505c12655a3', '[\"*\"]', '2024-06-26 22:22:25', '2024-06-26 22:22:24', '2024-06-26 22:22:25'),
(199, 'App\\Models\\User', 7, 'MyApp', '36b5c4a11e6fe3505dcde3c43cd72152d9ac3e365bb0dd624a1d14264167144f', '[\"*\"]', '2024-06-29 19:05:16', '2024-06-29 19:05:16', '2024-06-29 19:05:16'),
(200, 'App\\Models\\User', 7, 'MyApp', 'ed13db10c798ba0e73b4f2711a05bec0b8bf88910f940625faecf245c591aad0', '[\"*\"]', '2024-06-29 19:43:24', '2024-06-29 19:43:24', '2024-06-29 19:43:24'),
(201, 'App\\Models\\User', 7, 'MyApp', '4541be72ec9d070031cdf3731855a8d79c45463299831f495a503dc15d4821b7', '[\"*\"]', '2024-06-29 19:43:25', '2024-06-29 19:43:24', '2024-06-29 19:43:25'),
(202, 'App\\Models\\User', 7, 'MyApp', 'ff952b5e92d4009d25ba49ee1cb56e794846817710b1f021826d598d93f42925', '[\"*\"]', '2024-06-29 21:44:24', '2024-06-29 21:44:24', '2024-06-29 21:44:24'),
(203, 'App\\Models\\User', 7, 'MyApp', '04f076439e535269c8e3562ea430c3bf1fd5d2ade88198c1a5b53dab29a34671', '[\"*\"]', '2024-06-30 00:51:19', '2024-06-30 00:51:18', '2024-06-30 00:51:19'),
(204, 'App\\Models\\User', 7, 'MyApp', 'f9b4d9ecd683dd2df3fa8cc68f185210416545006b9d7fee80176aa3e693d815', '[\"*\"]', '2024-06-30 22:28:46', '2024-06-30 22:28:45', '2024-06-30 22:28:46'),
(205, 'App\\Models\\User', 7, 'MyApp', 'e7d309e342d3e4c3e4248e723277f4f807fe49ffc40f24150060f820b970507e', '[\"*\"]', '2024-06-30 22:56:57', '2024-06-30 22:56:57', '2024-06-30 22:56:57'),
(206, 'App\\Models\\User', 7, 'MyApp', 'b08513846ecc7d7e6e77192e54c3fa4b0b057cca2bd5e798bca8c3266bde791a', '[\"*\"]', '2024-06-30 22:56:58', '2024-06-30 22:56:57', '2024-06-30 22:56:58'),
(207, 'App\\Models\\User', 7, 'MyApp', '39763e5625eb1afde48a8562fc6fcec3323c8ea902b05d3572e39391fbc6a613', '[\"*\"]', '2024-06-30 23:38:29', '2024-06-30 23:38:29', '2024-06-30 23:38:29'),
(208, 'App\\Models\\User', 7, 'MyApp', '81c0e73afd81ad39a39310010a8541ebf67cef0b03deae3fc4599b0380d6dffc', '[\"*\"]', NULL, '2024-06-30 23:38:29', '2024-06-30 23:38:29'),
(209, 'App\\Models\\User', 7, 'MyApp', 'dc9b5076b77c025be0411a7cec52b009628375c25fc60fd13453f703e0936d31', '[\"*\"]', '2024-07-03 18:43:18', '2024-07-03 18:43:18', '2024-07-03 18:43:18'),
(210, 'App\\Models\\User', 7, 'MyApp', 'd18b6184758a941af0f49743af2f9290dd911ed0c4771f0b009d2666352ba380', '[\"*\"]', '2024-07-08 19:45:08', '2024-07-08 19:45:08', '2024-07-08 19:45:08'),
(211, 'App\\Models\\User', 7, 'MyApp', '6bc7fa328439eaf677f42dd071be2aa7cf03b8303b35618ab1430ecb348670bf', '[\"*\"]', '2024-07-08 21:32:38', '2024-07-08 21:32:38', '2024-07-08 21:32:38'),
(212, 'App\\Models\\User', 7, 'MyApp', 'd721db85a094cb951513a69ea77d293d333def669cff0d974f066cf92f1fb223', '[\"*\"]', '2024-07-09 02:29:57', '2024-07-09 02:29:57', '2024-07-09 02:29:57'),
(213, 'App\\Models\\User', 7, 'MyApp', 'bc72679cdba57ad46d1e2c31cc0f5d2f947e33521527effa95b6781b8ec7bea0', '[\"*\"]', '2024-07-11 16:07:01', '2024-07-11 16:07:00', '2024-07-11 16:07:01'),
(214, 'App\\Models\\User', 7, 'MyApp', '5301106400b2bda077104e5965a87a6eeb7bda2f41a236ca5fe5d84f1f72014c', '[\"*\"]', '2024-07-15 15:00:56', '2024-07-15 15:00:55', '2024-07-15 15:00:56'),
(215, 'App\\Models\\User', 7, 'MyApp', 'e0fa2b3cb15c4ae3e84bd609da85aa8f4ea329f72a901825d0670f01bbafbb18', '[\"*\"]', '2024-07-15 15:26:18', '2024-07-15 15:26:18', '2024-07-15 15:26:18'),
(216, 'App\\Models\\User', 7, 'MyApp', 'f05947298640278e730c5e9b2e34ce4ce976eb93443c8ebea63dbb8509b1ea99', '[\"*\"]', '2024-07-15 15:26:34', '2024-07-15 15:26:34', '2024-07-15 15:26:34'),
(217, 'App\\Models\\User', 7, 'MyApp', '0567a417f93c951d7a10e16c5bbe9de2b858c69677990c0f90a76ba076061515', '[\"*\"]', '2024-07-18 18:04:52', '2024-07-18 18:04:39', '2024-07-18 18:04:52'),
(218, 'App\\Models\\User', 7, 'MyApp', '3d3cf593671495a3aa7675671e104fbc9fcace704caa3c7854027a485e8e4148', '[\"*\"]', '2024-07-18 19:51:41', '2024-07-18 19:51:40', '2024-07-18 19:51:41'),
(219, 'App\\Models\\User', 7, 'MyApp', 'b7d9c9a0404c4ad302d13fac08652d28c090283e498d830a70bc0ef6f898bb87', '[\"*\"]', '2024-07-18 19:51:43', '2024-07-18 19:51:41', '2024-07-18 19:51:43'),
(220, 'App\\Models\\User', 7, 'MyApp', '2907ec85ee16f556043317d0072330c35d6a172ac2e13b0b4bbd93ec27feb769', '[\"*\"]', '2024-07-22 02:09:57', '2024-07-22 02:09:57', '2024-07-22 02:09:57'),
(221, 'App\\Models\\User', 7, 'MyApp', '28135d940f0d2cd52763ad574e8ba7c0d17fc66d2f1d1d9e87ad9d884ee6629d', '[\"*\"]', '2024-07-23 15:12:05', '2024-07-23 15:12:04', '2024-07-23 15:12:05'),
(222, 'App\\Models\\User', 7, 'MyApp', '9acb313d69c64f50bcf32f163b9308ff579467f517817563afb0318549baa616', '[\"*\"]', '2024-07-23 16:37:39', '2024-07-23 16:37:38', '2024-07-23 16:37:39'),
(223, 'App\\Models\\User', 7, 'MyApp', '0a8469ee9f2ffc8d17a406c211c2a200f8b39752478c9b3ea3b1aafb56459987', '[\"*\"]', '2024-07-23 16:37:39', '2024-07-23 16:37:38', '2024-07-23 16:37:39'),
(224, 'App\\Models\\User', 7, 'MyApp', '51ae2c30a238b5aa182c5c7237b51234de50295015b81806151e8dfabd1acb42', '[\"*\"]', '2024-07-23 16:42:41', '2024-07-23 16:42:41', '2024-07-23 16:42:41'),
(225, 'App\\Models\\User', 7, 'MyApp', '318ad8294919b67cba040481574e2792aac63d86aed07ac55aa5c05c8f328f35', '[\"*\"]', '2024-07-23 16:42:41', '2024-07-23 16:42:41', '2024-07-23 16:42:41'),
(226, 'App\\Models\\User', 7, 'MyApp', 'fa102d3e0f03f2694a8635c990a8a02062ddc08e13342ea3bcc2d41ae5105195', '[\"*\"]', '2024-07-23 16:47:37', '2024-07-23 16:47:37', '2024-07-23 16:47:37'),
(227, 'App\\Models\\User', 7, 'MyApp', 'f9c945889a48a1add1055d40db5f9595c7622440a7b8e5ea6ed543783e0f1e5d', '[\"*\"]', '2024-07-23 16:47:38', '2024-07-23 16:47:37', '2024-07-23 16:47:38'),
(228, 'App\\Models\\User', 7, 'MyApp', 'e014d1c64c7d6bcb09310bd2d1e0aa093a0062b16204d0acca41811f954188f4', '[\"*\"]', '2024-07-23 16:48:48', '2024-07-23 16:48:05', '2024-07-23 16:48:48'),
(229, 'App\\Models\\User', 7, 'MyApp', 'd1aa60b88a9e830f8038758795a5156baccd91571fed4a8e7f8a6d34a2a5e36a', '[\"*\"]', '2024-07-23 16:52:38', '2024-07-23 16:49:01', '2024-07-23 16:52:38'),
(230, 'App\\Models\\User', 7, 'MyApp', '074f84891b1eafd1057c18b2ccfbbbee3f10a269ae4620367903fdea05e6f686', '[\"*\"]', '2024-07-23 16:53:55', '2024-07-23 16:53:01', '2024-07-23 16:53:55'),
(231, 'App\\Models\\User', 7, 'MyApp', 'ce1dc8d7296cbfd1d95c11282b6553e9ff878253ab19f18a81a9f04909e411ce', '[\"*\"]', '2024-07-23 16:54:25', '2024-07-23 16:54:01', '2024-07-23 16:54:25'),
(232, 'App\\Models\\User', 7, 'MyApp', '3a30435d1fa96ae294751335379578344805627c0f582c58a2624e7a7bd56788', '[\"*\"]', '2024-07-23 16:56:59', '2024-07-23 16:54:32', '2024-07-23 16:56:59'),
(233, 'App\\Models\\User', 7, 'MyApp', '41fcb4cd056f588c3c03b48de629398a4615e38d59e26bc22993a0bf65cb748a', '[\"*\"]', NULL, '2024-07-23 16:57:05', '2024-07-23 16:57:05'),
(234, 'App\\Models\\User', 7, 'MyApp', '5882a009cf65a2851c8a26abb1e876bd79b92e7040537b9aaec8beb329ba3b1a', '[\"*\"]', '2024-07-23 16:57:11', '2024-07-23 16:57:05', '2024-07-23 16:57:11'),
(235, 'App\\Models\\User', 7, 'MyApp', 'a19ceae23adecf59c0413d398b9164289b2798d2dabf700cc12680aea85f2503', '[\"*\"]', '2024-07-23 17:00:32', '2024-07-23 16:58:58', '2024-07-23 17:00:32'),
(236, 'App\\Models\\User', 7, 'MyApp', 'ab0108dd6894ca0a8660473eb449976551677d469f03b3e6e32d3cf74636ba0c', '[\"*\"]', '2024-07-23 17:08:56', '2024-07-23 17:08:38', '2024-07-23 17:08:56'),
(237, 'App\\Models\\User', 7, 'MyApp', '64049478b7db5e8c086458f568f72fca32d283d0643f2c6b37be67e6dc07b05e', '[\"*\"]', '2024-07-23 17:40:01', '2024-07-23 17:40:01', '2024-07-23 17:40:01'),
(238, 'App\\Models\\User', 7, 'MyApp', '6ee1fe8dcd917840401cd125f6eca7e2142a86aa6330a1c131af4bfca3e5eb04', '[\"*\"]', '2024-07-23 17:40:01', '2024-07-23 17:40:01', '2024-07-23 17:40:01'),
(239, 'App\\Models\\User', 7, 'MyApp', '0dd797984eb5b34101323c8eebaecdb172af53272243e72a51b8e468f75e5535', '[\"*\"]', '2024-07-23 17:42:04', '2024-07-23 17:42:04', '2024-07-23 17:42:04'),
(240, 'App\\Models\\User', 7, 'MyApp', '84d5b4bcda5d3f389991cb63832298d160dd17e6f34d179c32c254924b455802', '[\"*\"]', '2024-07-23 17:42:04', '2024-07-23 17:42:04', '2024-07-23 17:42:04'),
(241, 'App\\Models\\User', 7, 'MyApp', 'c25b58b9b8550fe8b5f5e3396c86fad4b9243551c22843d9ad1c44f2d854f756', '[\"*\"]', '2024-07-23 18:25:51', '2024-07-23 18:25:50', '2024-07-23 18:25:51'),
(242, 'App\\Models\\User', 7, 'MyApp', 'd7f3923a04ee21a51dfc23171015fd8fca36667dc0a61811d80c78f8540b269b', '[\"*\"]', '2024-07-23 18:25:51', '2024-07-23 18:25:51', '2024-07-23 18:25:51'),
(243, 'App\\Models\\User', 7, 'MyApp', '9bdf5f1cef0ba0869d8d88bab93993f51d82e713e3dfe8770a9f85fee58f5a80', '[\"*\"]', '2024-07-28 12:51:30', '2024-07-28 12:51:21', '2024-07-28 12:51:30'),
(244, 'App\\Models\\User', 7, 'MyApp', 'f230e5ddd6fab30d2b88239279aeb2e8edfd8bbd41c47de379ec9adbb96c6982', '[\"*\"]', '2024-07-29 02:32:38', '2024-07-29 02:32:37', '2024-07-29 02:32:38'),
(245, 'App\\Models\\User', 7, 'MyApp', 'e668724d6db5038348d8b87be3c544f7f12da35614b748cf85af0a35bab441ea', '[\"*\"]', '2024-08-12 01:35:45', '2024-08-12 01:35:44', '2024-08-12 01:35:45'),
(246, 'App\\Models\\User', 7, 'MyApp', '75c1a8594de1d41b96fb6c97a87cfacf5bc9964110e4130eb1499a534eac76ec', '[\"*\"]', '2024-08-12 02:31:28', '2024-08-12 02:31:28', '2024-08-12 02:31:28'),
(247, 'App\\Models\\User', 7, 'MyApp', 'a98f3033d51171c8213cdf2f2efcd944a0954a3775812b56e1808399c9107fd2', '[\"*\"]', '2024-08-12 02:31:28', '2024-08-12 02:31:28', '2024-08-12 02:31:28'),
(248, 'App\\Models\\User', 7, 'MyApp', 'fd1a2d1d112e3913db70fd0c1092b00c46170e3da0adfee60c9fc8ff93aa00ac', '[\"*\"]', '2024-08-12 02:45:57', '2024-08-12 02:45:57', '2024-08-12 02:45:57'),
(249, 'App\\Models\\User', 7, 'MyApp', '20c65c08a116012db04867baf557d125c2fbe1a9d9264d21fed171d55801e2df', '[\"*\"]', '2024-08-12 02:45:57', '2024-08-12 02:45:57', '2024-08-12 02:45:57'),
(250, 'App\\Models\\User', 7, 'MyApp', 'f66f43066e1a996f0e52d154977758315d8a9131ef39c34d16f2370cab95a697', '[\"*\"]', '2024-08-12 03:14:42', '2024-08-12 03:14:42', '2024-08-12 03:14:42'),
(251, 'App\\Models\\User', 7, 'MyApp', 'cb05329e50423929b506a6806a25510dfa68f4180e6d68aadfbe4040f981f3f6', '[\"*\"]', '2024-08-12 03:14:42', '2024-08-12 03:14:42', '2024-08-12 03:14:42'),
(252, 'App\\Models\\User', 7, 'MyApp', '8cf8b47c13829e43b92368d0dbb4cf484e729b0dcfcb41b582340209cb9aec41', '[\"*\"]', NULL, '2024-08-12 03:20:34', '2024-08-12 03:20:34'),
(253, 'App\\Models\\User', 7, 'MyApp', 'fbb329a286c66dfe160d914cfbf745e865a0cbed604b65ad407f282e373a671d', '[\"*\"]', '2024-08-12 03:23:24', '2024-08-12 03:20:34', '2024-08-12 03:23:24'),
(254, 'App\\Models\\User', 7, 'MyApp', '3ad5430556df5d823accac5741575db65db86960bdfe4dd69d4d6f7c7f00a07d', '[\"*\"]', '2024-08-12 03:23:35', '2024-08-12 03:23:32', '2024-08-12 03:23:35'),
(255, 'App\\Models\\User', 7, 'MyApp', '85c3194f82f97462abbc2e76f1bf796ee355a9428a427a8d0c1aacf42fa7ef8b', '[\"*\"]', '2024-08-12 03:23:37', '2024-08-12 03:23:35', '2024-08-12 03:23:37'),
(256, 'App\\Models\\User', 7, 'MyApp', '15f94ea9bb48c7d88d663237bf12d794cfd657841008b9568d1aabd950b3c56b', '[\"*\"]', '2024-08-12 03:25:01', '2024-08-12 03:25:00', '2024-08-12 03:25:01'),
(257, 'App\\Models\\User', 7, 'MyApp', 'a389895fe637e8ae5d95ad4c78f5222099726b0cd3f9bbe21b3a9967d08a1eba', '[\"*\"]', '2024-08-12 03:25:01', '2024-08-12 03:25:00', '2024-08-12 03:25:01'),
(258, 'App\\Models\\User', 7, 'MyApp', '100ef5611b5fe002c060fc9e8373682448e2dcfc886e09caaf01b20bc7f5a366', '[\"*\"]', '2024-08-12 03:45:52', '2024-08-12 03:45:52', '2024-08-12 03:45:52'),
(259, 'App\\Models\\User', 7, 'MyApp', '2f516707407f535ccaa57019bc7028e5473185583a2969873b572edf5f71b59b', '[\"*\"]', '2024-08-12 03:45:53', '2024-08-12 03:45:52', '2024-08-12 03:45:53'),
(260, 'App\\Models\\User', 7, 'MyApp', '24b662c416b46975c921984db0d47ab31eba76b868c36ff644cfeffd13de08cb', '[\"*\"]', '2024-08-12 03:46:43', '2024-08-12 03:46:43', '2024-08-12 03:46:43'),
(261, 'App\\Models\\User', 7, 'MyApp', '88b4adae3fef7b46aa76926692a914c46cb98f540416295b3c0520ae180c166f', '[\"*\"]', '2024-08-12 03:46:45', '2024-08-12 03:46:43', '2024-08-12 03:46:45'),
(262, 'App\\Models\\User', 7, 'MyApp', '28fa73ab7aa505547769c4274ff04e60aa992d02e77a1df73d598f6cc8ca6f53', '[\"*\"]', '2024-08-12 03:58:44', '2024-08-12 03:58:44', '2024-08-12 03:58:44'),
(263, 'App\\Models\\User', 7, 'MyApp', 'd047b2d2f81c952bc2650ee50ce18dc2e32bf821a7fd789a5f786777f95c456a', '[\"*\"]', '2024-08-12 03:58:44', '2024-08-12 03:58:44', '2024-08-12 03:58:44'),
(264, 'App\\Models\\User', 7, 'MyApp', 'a771c3de7e29cb3300a5d1909ab2dfa59af646bb74c34b3ffdd4a189fb6d8de0', '[\"*\"]', '2024-08-12 14:50:45', '2024-08-12 14:50:44', '2024-08-12 14:50:45'),
(265, 'App\\Models\\User', 7, 'MyApp', '589b34de4f9db831c5c4bad4da25cfe06751d3b32d7d2e39cd5696d6e2515bfb', '[\"*\"]', NULL, '2024-08-12 16:38:36', '2024-08-12 16:38:36'),
(266, 'App\\Models\\User', 7, 'MyApp', '5e971e9b4162ec4908541c24e1d85abc5e47acf6c8ef59e2e192a558cc581efe', '[\"*\"]', '2024-08-12 16:38:44', '2024-08-12 16:38:37', '2024-08-12 16:38:44'),
(267, 'App\\Models\\User', 7, 'MyApp', '6719843c46383968391369185208d544b6211d81507e5313302d21523bbf3d57', '[\"*\"]', '2024-08-14 19:07:20', '2024-08-14 19:07:19', '2024-08-14 19:07:20'),
(268, 'App\\Models\\User', 7, 'MyApp', '6c580c3cf07cd99674ff9faeb202349f6f51bd03e21b68c3bb5eeb1dff72da89', '[\"*\"]', '2024-08-14 19:19:39', '2024-08-14 19:19:39', '2024-08-14 19:19:39'),
(269, 'App\\Models\\User', 7, 'MyApp', '8c7b8480eb0eff50e8c8468e557cff3771d9e69637cc0ad341a1511085802c9e', '[\"*\"]', '2024-08-14 19:19:41', '2024-08-14 19:19:39', '2024-08-14 19:19:41'),
(270, 'App\\Models\\User', 7, 'MyApp', 'd6194d38b952d1dd9faec745e0d16be5942a29f2474c5f2ddea0edd35e8c517c', '[\"*\"]', '2024-08-14 19:42:26', '2024-08-14 19:42:25', '2024-08-14 19:42:26');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(271, 'App\\Models\\User', 7, 'MyApp', '82697db778e03424f59cc041c795c492185581c57af0d409f9a4b5aea792f2ad', '[\"*\"]', '2024-08-14 19:42:43', '2024-08-14 19:42:26', '2024-08-14 19:42:43'),
(272, 'App\\Models\\User', 7, 'MyApp', '194147a72edbb2bcf510728a575b751bf0ff40714485040648b1841ad404733b', '[\"*\"]', '2024-08-14 19:43:27', '2024-08-14 19:43:27', '2024-08-14 19:43:27'),
(273, 'App\\Models\\User', 7, 'MyApp', 'c3fd5f6b216b99e71ef61c742b3b5b8bf8df285b9bf204311ac60642dbc64916', '[\"*\"]', '2024-08-14 19:45:25', '2024-08-14 19:43:27', '2024-08-14 19:45:25'),
(274, 'App\\Models\\User', 100, 'MyApp', '29b6dd4bb486272621c9e2e892bd0255cbe5aa230110145b999c13ad07b48eb1', '[\"*\"]', NULL, '2024-08-15 12:30:07', '2024-08-15 12:30:07'),
(275, 'App\\Models\\User', 100, 'MyApp', 'ae4ed2f876606431e7963313bef72a0fb462c071ac4e6acad9e9d38f7da56437', '[\"*\"]', '2024-08-15 17:49:42', '2024-08-15 12:30:22', '2024-08-15 17:49:42'),
(276, 'App\\Models\\User', 100, 'MyApp', '7a88ae3e431b1e964ea1ec9bf0878b125995b1939c56134fa60dbb89e0888cba', '[\"*\"]', NULL, '2024-08-17 15:41:25', '2024-08-17 15:41:25'),
(277, 'App\\Models\\User', 7, 'MyApp', '9a591921b804c5b106339d54dccc143e1764b269b08c895047bc6a8aef98218d', '[\"*\"]', '2024-08-17 16:44:10', '2024-08-17 15:58:40', '2024-08-17 16:44:10'),
(278, 'App\\Models\\User', 112, 'MyApp', '747a719e0e49ccd88cdbec8afcdf8dcba4935892dbbbc02d18384abc5de5cbab', '[\"*\"]', '2024-08-17 16:12:38', '2024-08-17 16:10:13', '2024-08-17 16:12:38'),
(279, 'App\\Models\\User', 7, 'MyApp', '6e0e05543c9f3330874e08dd4adf676bb6b6330eb0901da03012f7979ac51ba7', '[\"*\"]', '2024-08-17 17:17:56', '2024-08-17 17:17:56', '2024-08-17 17:17:56'),
(280, 'App\\Models\\User', 7, 'MyApp', 'ca1a67937e306a04c75118ef7db1ab50510ec2c167666a61d022cab9f959205f', '[\"*\"]', '2024-08-17 17:21:33', '2024-08-17 17:17:56', '2024-08-17 17:21:33'),
(281, 'App\\Models\\User', 7, 'MyApp', '0373feb281a038338a74edcbcf38b8250338981c1b714190bde11169e6806251', '[\"*\"]', '2024-08-17 17:37:29', '2024-08-17 17:37:29', '2024-08-17 17:37:29'),
(282, 'App\\Models\\User', 7, 'MyApp', '8d9c0e5dd1abe636f5f453c8027335de9471155d9684573fbde11ae12759348a', '[\"*\"]', '2024-08-17 17:37:30', '2024-08-17 17:37:29', '2024-08-17 17:37:30'),
(283, 'App\\Models\\User', 7, 'MyApp', 'd8482088104d41589b674526f7d784c89b86da7c138ba402618b8813d3b11e83', '[\"*\"]', '2024-08-17 17:55:50', '2024-08-17 17:55:50', '2024-08-17 17:55:50'),
(284, 'App\\Models\\User', 7, 'MyApp', '4037b13339b63f3a679fc6216033f5d3428b1e9dff6273df0ecc7c40a00ae262', '[\"*\"]', '2024-08-17 18:12:16', '2024-08-17 18:12:15', '2024-08-17 18:12:16'),
(285, 'App\\Models\\User', 7, 'MyApp', '3b636b8608242027e5a145ba048e079d9f06bb3ca090c6205203b33414c1cfca', '[\"*\"]', '2024-08-17 18:12:17', '2024-08-17 18:12:16', '2024-08-17 18:12:17'),
(286, 'App\\Models\\User', 7, 'MyApp', 'fa0297d9603a07e50c73d2e0ddc44e9458faf4a8a0c322b12ce7fa8a77c5ee7f', '[\"*\"]', '2024-08-17 18:25:43', '2024-08-17 18:25:43', '2024-08-17 18:25:43'),
(287, 'App\\Models\\User', 7, 'MyApp', '18ab8f74fcc9f8b6c8c9236da376d8ca40e74985d6bbcf1f42d631563c9e2df8', '[\"*\"]', '2024-08-17 18:36:49', '2024-08-17 18:25:44', '2024-08-17 18:36:49'),
(288, 'App\\Models\\User', 7, 'MyApp', '708f79fc98095626890997c9d8aaf493500f662f194ee308833c2f786a4bf753', '[\"*\"]', '2024-08-17 19:05:13', '2024-08-17 19:05:12', '2024-08-17 19:05:13'),
(289, 'App\\Models\\User', 7, 'MyApp', 'a955c15b504b6da689913c5523a47c91bc5ea2aefcbd6cda3ffbba821e8ab469', '[\"*\"]', '2024-08-17 19:19:03', '2024-08-17 19:05:13', '2024-08-17 19:19:03'),
(290, 'App\\Models\\User', 7, 'MyApp', '292143507b9df1d3f17e613f0330f53fcc6fb69fd437772f025b2e86d70a22bc', '[\"*\"]', '2024-08-17 19:21:33', '2024-08-17 19:21:32', '2024-08-17 19:21:33'),
(291, 'App\\Models\\User', 7, 'MyApp', 'a342bb6e33d2dd89bfaeb046ae3b6047cd5aee0175fed49bdf8eb5172857415e', '[\"*\"]', '2024-08-17 19:21:33', '2024-08-17 19:21:32', '2024-08-17 19:21:33'),
(292, 'App\\Models\\User', 7, 'MyApp', '1386b9320b137104bd50eb8f9d0b255ea06e09afa0dc5a601ef2ce285c0d383a', '[\"*\"]', '2024-08-17 19:22:15', '2024-08-17 19:22:14', '2024-08-17 19:22:15'),
(293, 'App\\Models\\User', 7, 'MyApp', '0c1ca5b793098ab705086f5d66d19cadb0d59389fa226a40cf8bf2664204a0b0', '[\"*\"]', '2024-08-17 19:22:15', '2024-08-17 19:22:14', '2024-08-17 19:22:15'),
(294, 'App\\Models\\User', 7, 'MyApp', 'adf6c5b32d9e6aab2f58119f993de46092887d126749c55b81b508548a4b90d1', '[\"*\"]', '2024-08-17 19:22:50', '2024-08-17 19:22:49', '2024-08-17 19:22:50'),
(295, 'App\\Models\\User', 7, 'MyApp', '27b8dec2dcf76adfe6ce9dcd99f92f4545a2de6865c76a52e775be492cc0f057', '[\"*\"]', '2024-08-17 19:22:51', '2024-08-17 19:22:50', '2024-08-17 19:22:51'),
(296, 'App\\Models\\User', 7, 'MyApp', '63b4ad7e98966b5f4c417c82d8d5152dfeca3669bcf786d1020d8f89869b7228', '[\"*\"]', '2024-08-17 20:27:44', '2024-08-17 20:27:44', '2024-08-17 20:27:44'),
(297, 'App\\Models\\User', 7, 'MyApp', '1c9e61d664540fe6f21d0be0af00d193a802aba4b397cffb7714d084452bb0d0', '[\"*\"]', '2024-08-17 20:27:44', '2024-08-17 20:27:44', '2024-08-17 20:27:44'),
(298, 'App\\Models\\User', 100, 'MyApp', '041237bf299d74a9fc2c0a12bdc419686695c7d7f980c48fb17d45c3917e9ab1', '[\"*\"]', '2024-10-26 21:16:13', '2024-08-17 20:28:03', '2024-10-26 21:16:13'),
(299, 'App\\Models\\User', 7, 'MyApp', 'd854294933b67e45d54323edd25f69722ea03782a2123b5a7c8033c50516987b', '[\"*\"]', '2024-08-17 20:28:12', '2024-08-17 20:28:11', '2024-08-17 20:28:12'),
(300, 'App\\Models\\User', 7, 'MyApp', 'eaa02828aebf42b68eef6b0efcbb05931e78a7393fa44a578bdd554831a15a91', '[\"*\"]', '2024-08-17 20:28:12', '2024-08-17 20:28:12', '2024-08-17 20:28:12'),
(301, 'App\\Models\\User', 100, 'MyApp', 'ee68b05eedf222c440414be64e0c6c022748931f627f3d5774dbc0e47cc18884', '[\"*\"]', '2024-08-18 02:55:50', '2024-08-17 20:30:18', '2024-08-18 02:55:50'),
(302, 'App\\Models\\User', 7, 'MyApp', 'fa65a5f8a43c64c16b316abef2e32d26d8df5cb85abd652182268d13c4adab69', '[\"*\"]', '2024-08-17 20:32:10', '2024-08-17 20:32:10', '2024-08-17 20:32:10'),
(303, 'App\\Models\\User', 7, 'MyApp', '9d6f63a93df742b5ead02e09c74b821ad385312b3d1690cc32e1b9578bb82497', '[\"*\"]', '2024-08-17 21:12:27', '2024-08-17 20:32:10', '2024-08-17 21:12:27'),
(304, 'App\\Models\\User', 7, 'MyApp', '1043a0db8c9d802de43de316d7461049ddd7de24038c46e50c159f713dbcc8fc', '[\"*\"]', '2024-08-17 21:34:05', '2024-08-17 21:34:05', '2024-08-17 21:34:05'),
(305, 'App\\Models\\User', 7, 'MyApp', '2b1deef9f0bce166f394152ed8a8fce11ee6e38095c1fdbf65ae7d1b5d19a6c9', '[\"*\"]', '2024-08-17 21:52:35', '2024-08-17 21:52:34', '2024-08-17 21:52:35'),
(306, 'App\\Models\\User', 7, 'MyApp', '79220b4c3cf325d40d6631e7da80ac0c03cf3e31640c5c35b4ba4fde32590cdc', '[\"*\"]', '2024-08-17 21:52:37', '2024-08-17 21:52:35', '2024-08-17 21:52:37'),
(307, 'App\\Models\\User', 7, 'MyApp', 'd1a294b3bd7cc04b964342e15a052f87602e90acc54ce4c9033200997354a341', '[\"*\"]', '2024-08-17 21:53:15', '2024-08-17 21:53:00', '2024-08-17 21:53:15'),
(308, 'App\\Models\\User', 7, 'MyApp', '2a12b0dee3e75b8ede72c5f6700ff8e25a78a9711fff4634e5c72f5cc02b2fce', '[\"*\"]', NULL, '2024-08-18 00:03:45', '2024-08-18 00:03:45'),
(309, 'App\\Models\\User', 7, 'MyApp', 'bdcb77803c8dac44e3d571ba9f1fcff31d3b78aa670225eed20381417cf39584', '[\"*\"]', '2024-08-18 00:03:45', '2024-08-18 00:03:45', '2024-08-18 00:03:45'),
(310, 'App\\Models\\User', 7, 'MyApp', '8251b7dd30816f705458c835f8101b557cbf948371e2caae25d93621001193aa', '[\"*\"]', '2024-08-18 00:08:53', '2024-08-18 00:08:52', '2024-08-18 00:08:53'),
(311, 'App\\Models\\User', 7, 'MyApp', '79c4f1cc308147fde4822247351f9df48570a9c7632960977cfd0e52c0f33bf9', '[\"*\"]', '2024-08-18 00:08:53', '2024-08-18 00:08:53', '2024-08-18 00:08:53'),
(312, 'App\\Models\\User', 7, 'MyApp', 'b90d37cb592f5512c87475c01791a90d59e6a6c920292b8efafb396ac4ff0cfc', '[\"*\"]', '2024-08-18 00:27:39', '2024-08-18 00:27:39', '2024-08-18 00:27:39'),
(313, 'App\\Models\\User', 7, 'MyApp', '4e0d4e9ababacb5129cfe77843b82dcecb158d9da2044a8fbbdd8b220100bc31', '[\"*\"]', '2024-08-18 02:17:10', '2024-08-18 00:27:39', '2024-08-18 02:17:10'),
(314, 'App\\Models\\User', 7, 'MyApp', 'd7225b4d2977b80a1b041f8949b987605ad9edd7418dc7d45968bf742b3d6b2d', '[\"*\"]', '2024-08-18 01:04:41', '2024-08-18 01:04:41', '2024-08-18 01:04:41'),
(315, 'App\\Models\\User', 7, 'MyApp', '81815b33de8d7d06b99450a7d6195fdc791b67c4aae403aa67a399bbefa49352', '[\"*\"]', '2024-08-18 01:04:41', '2024-08-18 01:04:41', '2024-08-18 01:04:41'),
(316, 'App\\Models\\User', 7, 'MyApp', 'f3284c93451544e83be8d85312bbd530b40f91eea46373d6ed445786dedb87d0', '[\"*\"]', '2024-08-18 01:07:02', '2024-08-18 01:07:02', '2024-08-18 01:07:02'),
(317, 'App\\Models\\User', 7, 'MyApp', '6456bf6390648ca52563c6ffc19705617709cf33f1503ad9b5075d63f28087a1', '[\"*\"]', '2024-08-18 01:07:03', '2024-08-18 01:07:02', '2024-08-18 01:07:03'),
(318, 'App\\Models\\User', 7, 'MyApp', '9e4cb15c73e4577243d008f025a03ad3336f3519a2a59ff5c16cde44dd64d903', '[\"*\"]', '2024-08-18 01:09:18', '2024-08-18 01:09:18', '2024-08-18 01:09:18'),
(319, 'App\\Models\\User', 7, 'MyApp', 'ccff6c3842791103a19bd467a8206b63a4c2e7bb51f91c1ce152c192127b7d84', '[\"*\"]', '2024-08-18 01:09:19', '2024-08-18 01:09:18', '2024-08-18 01:09:19'),
(320, 'App\\Models\\User', 7, 'MyApp', '08b3b32c03c2f70bcbd93f784479d4a8663033b2d00b29d5a8d30f7da24611c4', '[\"*\"]', '2024-08-18 01:24:45', '2024-08-18 01:24:44', '2024-08-18 01:24:45'),
(321, 'App\\Models\\User', 7, 'MyApp', '5c9272b8206b7f4ed6a1b83c10179b47b26fb2d420d797e1145ab048b1d04751', '[\"*\"]', '2024-08-18 01:24:45', '2024-08-18 01:24:45', '2024-08-18 01:24:45'),
(322, 'App\\Models\\User', 7, 'MyApp', '8af64d6eb178f5f2ae8a11196a7678279290b7fec706dc91af05bb18d3e2182f', '[\"*\"]', '2024-08-18 01:38:22', '2024-08-18 01:38:21', '2024-08-18 01:38:22'),
(323, 'App\\Models\\User', 7, 'MyApp', 'ca50a3ab6f231c9f5eff41ab3d7da2ebc33ded4b0b1bcf13f8cda86a9999c0ab', '[\"*\"]', '2024-08-18 01:38:22', '2024-08-18 01:38:21', '2024-08-18 01:38:22'),
(324, 'App\\Models\\User', 7, 'MyApp', '3f1142e67f45b5d39675f89a05f0baf940d14ea841cf7745534e223ae1c14022', '[\"*\"]', '2024-08-18 01:39:59', '2024-08-18 01:39:59', '2024-08-18 01:39:59'),
(325, 'App\\Models\\User', 7, 'MyApp', '43bee79d1321e6b78de0575a16d3ba0792daf078f7149ce47d49f29cdd2bf473', '[\"*\"]', '2024-08-18 01:40:00', '2024-08-18 01:39:59', '2024-08-18 01:40:00'),
(326, 'App\\Models\\User', 7, 'MyApp', 'f8fbdff40736866a442e71530f27ff8985405b9b25f9cbf1934a2c797d922dd1', '[\"*\"]', '2024-08-18 02:23:55', '2024-08-18 02:23:55', '2024-08-18 02:23:55'),
(327, 'App\\Models\\User', 7, 'MyApp', '02be59f0bd7f49dfc78ac941d0999e2e81ea84610cfd780d137cfe76f73b540d', '[\"*\"]', '2024-08-18 02:38:21', '2024-08-18 02:23:55', '2024-08-18 02:38:21'),
(328, 'App\\Models\\User', 7, 'MyApp', 'bfc5e7f03f7a786d5a28b883ab06f92095462ecb7448b33426e22c497d5fc03a', '[\"*\"]', '2024-08-18 02:40:56', '2024-08-18 02:40:56', '2024-08-18 02:40:56'),
(329, 'App\\Models\\User', 7, 'MyApp', 'd319c929402bbb402fe5d0bde245622e1c909db3c1fb4c5a7ab27e7d5ab49a1a', '[\"*\"]', '2024-08-18 02:45:37', '2024-08-18 02:40:56', '2024-08-18 02:45:37'),
(330, 'App\\Models\\User', 7, 'MyApp', '7ba4c64708e89675b3955d1f9a23754f923c140e8224722fce3c70e558147610', '[\"*\"]', NULL, '2024-08-18 02:45:51', '2024-08-18 02:45:51'),
(331, 'App\\Models\\User', 7, 'MyApp', 'a028b071789bedbfa24ef8a4523f3a99c299828ec386b8501a2bb078000375a2', '[\"*\"]', '2024-08-18 02:55:58', '2024-08-18 02:45:52', '2024-08-18 02:55:58'),
(332, 'App\\Models\\User', 7, 'MyApp', 'c054aa502a8c3854c555f42ed82b565655b85c4756e3336060893b0b2a3a50fa', '[\"*\"]', '2024-08-18 02:46:38', '2024-08-18 02:46:32', '2024-08-18 02:46:38'),
(333, 'App\\Models\\User', 7, 'MyApp', 'b9d71dc5bedfae668b4344a62cfbee6d213606b57b9342c862cd77f81263ad9f', '[\"*\"]', '2024-08-18 02:53:47', '2024-08-18 02:53:08', '2024-08-18 02:53:47'),
(334, 'App\\Models\\User', 7, 'MyApp', 'f0a3864b58cf3e7b64d97fd1c7760935ec0adb53ce1a99c1ed79a94acfb78d04', '[\"*\"]', '2024-08-18 02:54:55', '2024-08-18 02:54:43', '2024-08-18 02:54:55'),
(335, 'App\\Models\\User', 7, 'MyApp', '84662b697351529c2b1a88aea5e795ae72912f26b31440340b60db79cb6e5391', '[\"*\"]', '2024-08-18 03:00:00', '2024-08-18 02:57:30', '2024-08-18 03:00:00'),
(336, 'App\\Models\\User', 7, 'MyApp', 'a2b6584a20d44004e1aea257c01bbaae6f74c9a43792800d5c0a6f9010b7d718', '[\"*\"]', '2024-08-18 03:01:27', '2024-08-18 03:01:26', '2024-08-18 03:01:27'),
(337, 'App\\Models\\User', 7, 'MyApp', '96b56628aa20e50eb77cc1ba41158e92a52ffea17e19fbca48ec4ca793bbb7ba', '[\"*\"]', '2024-08-18 03:02:01', '2024-08-18 03:01:26', '2024-08-18 03:02:01'),
(338, 'App\\Models\\User', 7, 'MyApp', '2f67b67865b348ee75bc2df7dab34d079f2c5b4dbd7cdba756e3074512fe0b43', '[\"*\"]', '2024-08-18 03:35:17', '2024-08-18 03:35:17', '2024-08-18 03:35:17'),
(339, 'App\\Models\\User', 7, 'MyApp', '81b129f7338b7203b19799c56523eb684c7adc6d3102396b123fdd6d69232dc5', '[\"*\"]', '2024-08-18 03:35:18', '2024-08-18 03:35:17', '2024-08-18 03:35:18'),
(340, 'App\\Models\\User', 7, 'MyApp', 'c3f4fab9dfa40cd82adeb6c8bf90ef17730d30b9d9bab957b6bf6f21b0315cd1', '[\"*\"]', '2024-08-18 03:59:12', '2024-08-18 03:59:11', '2024-08-18 03:59:12'),
(341, 'App\\Models\\User', 7, 'MyApp', '94929dd049ca20f366ff24e2541a627d5eb5e188d6109c03b266ee722eb5647a', '[\"*\"]', '2024-08-18 03:59:15', '2024-08-18 03:59:14', '2024-08-18 03:59:15'),
(342, 'App\\Models\\User', 7, 'MyApp', '45db6ff6f79d0457ee76fd77cef3ccaea6abfbc9742d5a673a9194bbb0f8b74f', '[\"*\"]', NULL, '2024-08-18 04:04:46', '2024-08-18 04:04:46'),
(343, 'App\\Models\\User', 7, 'MyApp', 'd8b34de04eaab4c3f458e41b636f9518df79ec1a7ce8a5b0a874789c3ffe2929', '[\"*\"]', '2024-08-18 04:05:32', '2024-08-18 04:04:47', '2024-08-18 04:05:32'),
(344, 'App\\Models\\User', 7, 'MyApp', 'aeb90834ad02acb316301e15a6b57142343b9f4a39a8aac074a4141806d2c297', '[\"*\"]', '2024-08-18 04:08:24', '2024-08-18 04:08:23', '2024-08-18 04:08:24'),
(345, 'App\\Models\\User', 7, 'MyApp', '10a7d3818ce3a73d6f06d0c9f1861b32e6d20a44409269694b529903749bd321', '[\"*\"]', '2024-08-18 04:08:26', '2024-08-18 04:08:24', '2024-08-18 04:08:26'),
(346, 'App\\Models\\User', 7, 'MyApp', '9e9ffdfbd6d3e1ffcefe7208aaf26cae897b0dd19adec7647c96e9eded8b23ea', '[\"*\"]', '2024-08-18 04:12:39', '2024-08-18 04:12:39', '2024-08-18 04:12:39'),
(347, 'App\\Models\\User', 7, 'MyApp', '6d0f5331227550749bc867d3e98441f7864138bc1edfecfd49b9219d6dc5f846', '[\"*\"]', '2024-08-18 04:12:39', '2024-08-18 04:12:39', '2024-08-18 04:12:39'),
(348, 'App\\Models\\User', 7, 'MyApp', '2c2d64ae43cfc06fea052dfd1872a406e4ff362c771954eed42fb18719c4fa8b', '[\"*\"]', '2024-08-18 04:20:44', '2024-08-18 04:20:23', '2024-08-18 04:20:44'),
(349, 'App\\Models\\User', 7, 'MyApp', '3ee88e1a1e8b19110607876f81df0af6706e439681b71184f1c7303d152f9dbf', '[\"*\"]', '2024-08-19 13:24:34', '2024-08-19 13:24:33', '2024-08-19 13:24:34'),
(350, 'App\\Models\\User', 7, 'MyApp', '0a2903dcf17a3e20bb8cc263565b1cb24dfcc1a7c20d17197b94f80e6acd5c10', '[\"*\"]', '2024-08-19 13:27:08', '2024-08-19 13:27:08', '2024-08-19 13:27:08'),
(351, 'App\\Models\\User', 7, 'MyApp', '7803d15c42162d7bf9d27e5f592ffafbce26ffde0d1aae626d293758c08628fc', '[\"*\"]', '2024-08-19 13:36:00', '2024-08-19 13:36:00', '2024-08-19 13:36:00'),
(352, 'App\\Models\\User', 7, 'MyApp', '4499012434722821826a633e5a09a18fcc1699acbc4c9ba1fd3441fa792f8dc0', '[\"*\"]', '2024-08-19 13:36:00', '2024-08-19 13:36:00', '2024-08-19 13:36:00'),
(353, 'App\\Models\\User', 7, 'MyApp', 'c4453aa7afa19efa0a3a1f7a88d01d454ca48e5b3941fe8939343dd1ae58f257', '[\"*\"]', '2024-08-19 13:36:13', '2024-08-19 13:36:13', '2024-08-19 13:36:13'),
(354, 'App\\Models\\User', 7, 'MyApp', '82ff3eccac20e9c86f886982b1a214e8b81b98650b9ee9f810eebf36c230992f', '[\"*\"]', '2024-08-19 13:36:14', '2024-08-19 13:36:13', '2024-08-19 13:36:14'),
(355, 'App\\Models\\User', 7, 'MyApp', '8088171ac7557be164fbed520cfdd7da05414bd8a46abcd244be7c4991322e35', '[\"*\"]', '2024-08-19 13:37:52', '2024-08-19 13:37:51', '2024-08-19 13:37:52'),
(356, 'App\\Models\\User', 7, 'MyApp', 'd9515cd0c09b2925c6ec5215633f3d648908fd92edc27f4e97ac7f10252bdf37', '[\"*\"]', '2024-08-19 13:37:52', '2024-08-19 13:37:51', '2024-08-19 13:37:52'),
(357, 'App\\Models\\User', 7, 'MyApp', '0c5e5c4d273b75e9ba348b475338cbe2acbae6b7faadefa27ce3ee36f87345b1', '[\"*\"]', '2024-08-19 13:38:59', '2024-08-19 13:38:59', '2024-08-19 13:38:59'),
(358, 'App\\Models\\User', 7, 'MyApp', '395927c04892c1f1cfc8816f81dea6ec530179c22ecad72a348f0ae99d76273d', '[\"*\"]', '2024-08-19 13:38:59', '2024-08-19 13:38:59', '2024-08-19 13:38:59'),
(359, 'App\\Models\\User', 7, 'MyApp', 'd91ee49848c20882454ac82a8fb1aef5a95407fd372e1ec5cc18b87289991374', '[\"*\"]', '2024-08-19 13:40:52', '2024-08-19 13:40:52', '2024-08-19 13:40:52'),
(360, 'App\\Models\\User', 7, 'MyApp', '87647558d8647884d405892d67442dc031c4a932dd6ec3768d02fde71797f890', '[\"*\"]', '2024-08-19 13:40:52', '2024-08-19 13:40:52', '2024-08-19 13:40:52'),
(361, 'App\\Models\\User', 7, 'MyApp', 'a701aba06c0fe8253a120779beab13d374f4078d95520fc2f021811edd119411', '[\"*\"]', '2024-08-19 13:41:06', '2024-08-19 13:41:05', '2024-08-19 13:41:06'),
(362, 'App\\Models\\User', 7, 'MyApp', 'a9585f5ad2ca58a6deeeece659be47808740c2ad06b4a47ca585580afcf09087', '[\"*\"]', '2024-08-19 13:41:08', '2024-08-19 13:41:07', '2024-08-19 13:41:08'),
(363, 'App\\Models\\User', 7, 'MyApp', 'cd69fd80dcb089f492a954f0ad5c911acbb578b745c5554f3be4fe7adce48e52', '[\"*\"]', '2024-08-19 13:41:59', '2024-08-19 13:41:59', '2024-08-19 13:41:59'),
(364, 'App\\Models\\User', 7, 'MyApp', '8619dc26f3ff4ed2bb361c3842552805869f707144d20880b4ec351414eeb4a4', '[\"*\"]', '2024-08-19 13:42:01', '2024-08-19 13:41:59', '2024-08-19 13:42:01'),
(365, 'App\\Models\\User', 7, 'MyApp', '521470e614e4a24b1dcb8465ac68483e7219a4a7d23a11867705490694e5051a', '[\"*\"]', '2024-08-19 14:10:26', '2024-08-19 14:10:26', '2024-08-19 14:10:26'),
(366, 'App\\Models\\User', 7, 'MyApp', '925f1290a80aa839c1bec3f9818cde3c8e12eb22789f5684a4b6cf4d439b8e61', '[\"*\"]', '2024-08-19 14:37:28', '2024-08-19 14:37:28', '2024-08-19 14:37:28'),
(367, 'App\\Models\\User', 7, 'MyApp', '2f0362251ef78a83afd4f2220a4b91358907a4773aac91bc2d73d1e60e70f4cc', '[\"*\"]', '2024-08-19 15:03:17', '2024-08-19 15:01:05', '2024-08-19 15:03:17'),
(368, 'App\\Models\\User', 7, 'MyApp', 'aa7c4821dd6f02ed53e311957d5a0168f46de7c0be1f34c7556defde4541f0bb', '[\"*\"]', '2024-08-19 15:04:14', '2024-08-19 15:04:13', '2024-08-19 15:04:14'),
(369, 'App\\Models\\User', 7, 'MyApp', '804bfe2e40e5182c0fde2c37df88b10f7d34ee45b9953e925ff46af0c8d36242', '[\"*\"]', '2024-08-19 16:42:03', '2024-08-19 16:42:02', '2024-08-19 16:42:03'),
(370, 'App\\Models\\User', 7, 'MyApp', 'fa3198103bc1f86a8799795faec94706bc27de65e3d6d8670a3aba650a44ad52', '[\"*\"]', NULL, '2024-08-19 16:43:02', '2024-08-19 16:43:02'),
(371, 'App\\Models\\User', 7, 'MyApp', '27188783116d7703ca9d031b9603fcd5d0d3840657b8ef9a7c5762ecf3b4e4ee', '[\"*\"]', '2024-08-19 16:43:02', '2024-08-19 16:43:02', '2024-08-19 16:43:02'),
(372, 'App\\Models\\User', 7, 'MyApp', 'f3b76c5a7c53d89153a3e1bb613ba4a47984ee37491bcfa8910cb2ad607f244e', '[\"*\"]', '2024-08-19 16:51:29', '2024-08-19 16:46:31', '2024-08-19 16:51:29'),
(373, 'App\\Models\\User', 7, 'MyApp', '345a86fa2149de1bfe6e64abfb8880ee98faedff04853a497c3cf09036f0ea44', '[\"*\"]', '2024-08-19 17:17:21', '2024-08-19 17:17:20', '2024-08-19 17:17:21'),
(374, 'App\\Models\\User', 7, 'MyApp', '9f1731e480321e86b47b8ffd531ae40ef5ab4ee2c026ede10a1ef68fc4c7b459', '[\"*\"]', '2024-08-19 17:18:27', '2024-08-19 17:18:27', '2024-08-19 17:18:27'),
(375, 'App\\Models\\User', 7, 'MyApp', '8b1465e5f584e1009499edb220ec84bd3acb6d58d46acd8de4a3e96a15d486ff', '[\"*\"]', '2024-08-19 17:18:28', '2024-08-19 17:18:27', '2024-08-19 17:18:28'),
(376, 'App\\Models\\User', 7, 'MyApp', '34ef81987bbc1aefb92d651621d2c218bee23c0eb6595e4e1c9d6f46640f273f', '[\"*\"]', NULL, '2024-08-19 17:21:44', '2024-08-19 17:21:44'),
(377, 'App\\Models\\User', 7, 'MyApp', '609b9b6f2cb41e41a491c669d5955bf2ad6ba41493c417e1148c1a4150e605eb', '[\"*\"]', '2024-08-19 17:21:45', '2024-08-19 17:21:44', '2024-08-19 17:21:45'),
(378, 'App\\Models\\User', 7, 'MyApp', '18d5450629c73d8961a1fd3626a4e55dd7b2b50cb6ec09b5e3fbd1ea896c7c8b', '[\"*\"]', '2024-08-19 17:22:26', '2024-08-19 17:22:26', '2024-08-19 17:22:26'),
(379, 'App\\Models\\User', 7, 'MyApp', '6d474a7a1d1b69d542065e6cf454e65fc96516e54406e5da4acc6021854cbac9', '[\"*\"]', '2024-08-19 17:22:26', '2024-08-19 17:22:26', '2024-08-19 17:22:26'),
(380, 'App\\Models\\User', 7, 'MyApp', 'ecaebe43246577de3c335b082dd4ffcdcef8730fb336a7e1eb7b0125c5c67aad', '[\"*\"]', '2024-08-19 17:22:49', '2024-08-19 17:22:49', '2024-08-19 17:22:49'),
(381, 'App\\Models\\User', 7, 'MyApp', 'cec62a4f0322377447f7173c691e6b3dc9f18bc86a40d9fc962c67d96df9cb87', '[\"*\"]', '2024-08-19 17:22:49', '2024-08-19 17:22:49', '2024-08-19 17:22:49'),
(382, 'App\\Models\\User', 7, 'MyApp', '40759e642ccac86bde6cdcb9425618c1889f74d1bf8ef2dfa8842a39033fbb3d', '[\"*\"]', '2024-08-19 17:23:47', '2024-08-19 17:23:47', '2024-08-19 17:23:47'),
(383, 'App\\Models\\User', 7, 'MyApp', 'f1fab7bd4141be8a6f33fad7f41b13d2c59c8dcc32639687c97d938812123fc0', '[\"*\"]', '2024-08-19 17:23:47', '2024-08-19 17:23:47', '2024-08-19 17:23:47'),
(384, 'App\\Models\\User', 7, 'MyApp', '47bf168fbcf96f47137cdd49734045b78a22128bea4f1b8d8b4996aee72633cf', '[\"*\"]', '2024-08-19 17:24:10', '2024-08-19 17:24:09', '2024-08-19 17:24:10'),
(385, 'App\\Models\\User', 7, 'MyApp', 'c745bcbf880c0f615e198d783b49dde02a58c8f3b5ef60548293e8b1a822ec20', '[\"*\"]', '2024-08-19 17:24:10', '2024-08-19 17:24:09', '2024-08-19 17:24:10'),
(386, 'App\\Models\\User', 7, 'MyApp', 'f35ad7ab9c98334489492984217233ad9515e406f76702d5888b850bf441362b', '[\"*\"]', '2024-08-19 17:24:32', '2024-08-19 17:24:32', '2024-08-19 17:24:32'),
(387, 'App\\Models\\User', 7, 'MyApp', '2b8541a765ce57548c50e6f981ef2bba1d4ad8cc91257c0a5e55dcaab80962b7', '[\"*\"]', '2024-08-19 17:24:32', '2024-08-19 17:24:32', '2024-08-19 17:24:32'),
(388, 'App\\Models\\User', 7, 'MyApp', 'b3931828a9367dae943b7fa929bd8f6e403f90fef26ab566414fcfab8e09baed', '[\"*\"]', '2024-08-19 17:48:37', '2024-08-19 17:48:37', '2024-08-19 17:48:37'),
(389, 'App\\Models\\User', 7, 'MyApp', '775a53778a672b329f07e5a7b14139c6301e2916e88fa926c97fa47cd235d682', '[\"*\"]', '2024-08-19 17:48:37', '2024-08-19 17:48:37', '2024-08-19 17:48:37'),
(390, 'App\\Models\\User', 7, 'MyApp', '2baa48dba29fc6cd46a0d0af545d969a03faac23b9c0e5606b840babcdba1234', '[\"*\"]', '2024-08-19 17:49:39', '2024-08-19 17:49:39', '2024-08-19 17:49:39'),
(391, 'App\\Models\\User', 7, 'MyApp', '8701d3df18c4159561dc67b7d1d02e9423537de1594a2c92abe63e5a4346aacd', '[\"*\"]', '2024-08-19 17:49:39', '2024-08-19 17:49:39', '2024-08-19 17:49:39'),
(392, 'App\\Models\\User', 7, 'MyApp', 'f1404b3a8d4b7b73ac46044001bd72ede8fb57d1ef457e89fdddd9d4580297a3', '[\"*\"]', '2024-08-19 18:36:11', '2024-08-19 18:36:10', '2024-08-19 18:36:11'),
(393, 'App\\Models\\User', 7, 'MyApp', '6b5a65ea1ac180d1c3c5ce386aa82564187e567ce888bc715edd47f127cc2a8e', '[\"*\"]', '2024-08-19 18:36:12', '2024-08-19 18:36:11', '2024-08-19 18:36:12'),
(394, 'App\\Models\\User', 7, 'MyApp', '8e707b61085ca005cc12ef53e8455fcc929a362d359e6d8db98ae0e8e2ebdb4b', '[\"*\"]', '2024-08-20 01:13:47', '2024-08-20 01:13:46', '2024-08-20 01:13:47'),
(395, 'App\\Models\\User', 7, 'MyApp', 'dca0450d446066f09ebe0b0615f533504326c1dfa2e241c08b728c260bf46257', '[\"*\"]', '2024-08-20 01:17:01', '2024-08-20 01:16:49', '2024-08-20 01:17:01'),
(396, 'App\\Models\\User', 7, 'MyApp', '4195b324cd2a78ec6e31732c47899a78c00df757deb121373a606b999f9fc487', '[\"*\"]', NULL, '2024-08-20 01:16:49', '2024-08-20 01:16:49'),
(397, 'App\\Models\\User', 7, 'MyApp', '1fceb1477e8f3ada53067503c4f6a9305eea112f11463032d541169953f8b526', '[\"*\"]', NULL, '2024-08-20 01:17:20', '2024-08-20 01:17:20'),
(398, 'App\\Models\\User', 7, 'MyApp', '287f3424de1d9967e1f05df34ff5340b1335d5e5ba0a5c73b9daac7fb46262e8', '[\"*\"]', '2024-08-20 01:17:21', '2024-08-20 01:17:20', '2024-08-20 01:17:21'),
(399, 'App\\Models\\User', 7, 'MyApp', '2c6601d2ca9226396d3613e567df2f1faffeedc6fb391aad57f9e9b90876a9cd', '[\"*\"]', '2024-08-20 01:34:16', '2024-08-20 01:29:56', '2024-08-20 01:34:16'),
(400, 'App\\Models\\User', 7, 'MyApp', 'd37b94384a5d31d9b8c2bb863c25192c74e9fd426c79ca0b9f837a8b13b15134', '[\"*\"]', '2024-08-22 15:37:12', '2024-08-22 14:12:00', '2024-08-22 15:37:12'),
(401, 'App\\Models\\User', 7, 'MyApp', '54285ec4c4b3504cdd9100eef07342f6df254e47b7104bd88b0cd9d00541a735', '[\"*\"]', '2024-08-22 16:51:40', '2024-08-22 16:51:40', '2024-08-22 16:51:40'),
(402, 'App\\Models\\User', 7, 'MyApp', 'f4364c0189af04ef96703db899735719d38623fdd943c717016a03beaf4144c1', '[\"*\"]', '2024-08-22 18:38:14', '2024-08-22 16:51:40', '2024-08-22 18:38:14'),
(403, 'App\\Models\\User', 7, 'MyApp', 'add4317c39538db3b767e18bb4b0e56a7661f941f86e979f2c8ccf95e291fdde', '[\"*\"]', NULL, '2024-08-24 01:37:36', '2024-08-24 01:37:36'),
(404, 'App\\Models\\User', 7, 'MyApp', '6f018a6374688152ebbeb1e61ec23353370c0b181377de7a04edc46ca4cbb758', '[\"*\"]', '2024-08-24 01:37:36', '2024-08-24 01:37:36', '2024-08-24 01:37:36'),
(405, 'App\\Models\\User', 7, 'MyApp', 'be8f8212a6241c2d3db53f1718f6bcae144057878252f5cc197e8707b79d0466', '[\"*\"]', '2024-08-25 14:08:10', '2024-08-25 13:29:49', '2024-08-25 14:08:10'),
(406, 'App\\Models\\User', 7, 'MyApp', '41f1e4f4cb83f5755ccc6f2b057a9b09dfbd72a6c59c3a38c50a5221ddf4f354', '[\"*\"]', '2024-09-03 01:37:25', '2024-09-03 01:37:24', '2024-09-03 01:37:25'),
(407, 'App\\Models\\User', 7, 'MyApp', 'b423cf2fdb32f861d0cfa68d0569b3753fc9b027087f89173f535144138d7fc4', '[\"*\"]', '2024-09-03 01:38:03', '2024-09-03 01:38:02', '2024-09-03 01:38:03'),
(408, 'App\\Models\\User', 7, 'MyApp', 'ac69f783734420ff276c622f97db5321133a33e94a0b0b23ba65961d2e9cd49f', '[\"*\"]', '2024-09-03 02:04:36', '2024-09-03 02:04:36', '2024-09-03 02:04:36'),
(409, 'App\\Models\\User', 7, 'MyApp', '0f3265babb70f47dc47741e4f37bfe6fd69020142637e24af1a8924a951b58cb', '[\"*\"]', '2024-09-03 18:28:32', '2024-09-03 18:28:32', '2024-09-03 18:28:32'),
(410, 'App\\Models\\User', 7, 'MyApp', 'a149855ec188a3c6bd3f6817d27dff77d866708a0b350c6d945bb16f30f5a900', '[\"*\"]', '2024-09-05 20:22:43', '2024-09-05 20:22:42', '2024-09-05 20:22:43'),
(411, 'App\\Models\\User', 7, 'MyApp', 'c2d3a7e7b5cbc2454721d935ab5e5147fc139abba5ea7dfb8a33bde3e90d8967', '[\"*\"]', '2024-09-05 21:12:42', '2024-09-05 21:12:40', '2024-09-05 21:12:42'),
(412, 'App\\Models\\User', 7, 'MyApp', 'c551563ea983ed04245dcb032535c23aa5b99340cd0bfcad0e9dc08329cd624a', '[\"*\"]', '2024-09-06 19:45:19', '2024-09-06 19:45:19', '2024-09-06 19:45:19'),
(413, 'App\\Models\\User', 7, 'MyApp', 'ed297fd3e9a64a87bd697f957467436357f3c546deb6cee21c7e96bdbc04a3d0', '[\"*\"]', '2024-09-06 20:03:19', '2024-09-06 20:03:19', '2024-09-06 20:03:19'),
(414, 'App\\Models\\User', 7, 'MyApp', '1a09a328fe29348ef44dc7d54c4b721b9c09e0821f87c2825482bee306bab70f', '[\"*\"]', '2024-09-06 20:03:19', '2024-09-06 20:03:19', '2024-09-06 20:03:19'),
(415, 'App\\Models\\User', 7, 'MyApp', 'e5c1e96004a9290a37d76268a6b3a9626efe2cc6c63bdcb9df21256f7c64a1b8', '[\"*\"]', '2024-09-06 20:10:27', '2024-09-06 20:10:27', '2024-09-06 20:10:27'),
(416, 'App\\Models\\User', 7, 'MyApp', '7869c4469e4c6a98f991a984c2362ee52fe3c06b9af96ce6ca5cef24bcfafa87', '[\"*\"]', '2024-09-06 20:10:28', '2024-09-06 20:10:27', '2024-09-06 20:10:28'),
(417, 'App\\Models\\User', 7, 'MyApp', '9b1a7a0e55bac7eb2095c7463a9e5475c23149ef5e831fb1179f0ca5ef2d88f8', '[\"*\"]', NULL, '2024-09-06 20:12:27', '2024-09-06 20:12:27'),
(418, 'App\\Models\\User', 7, 'MyApp', '72f6046b79e25641bd58b6832566726dfa92437d28d7fd0668f8bab982f28159', '[\"*\"]', '2024-09-06 20:12:28', '2024-09-06 20:12:27', '2024-09-06 20:12:28'),
(419, 'App\\Models\\User', 7, 'MyApp', '97424444832f76fde22cb009c82b07859736f39cda5bbb35a399767846d6faae', '[\"*\"]', '2024-09-07 00:11:38', '2024-09-07 00:11:37', '2024-09-07 00:11:38'),
(420, 'App\\Models\\User', 7, 'MyApp', 'e6a47910e204e4146ff7f205237c05ca73209f6aff42734813e7c865339831a8', '[\"*\"]', '2024-09-07 00:11:39', '2024-09-07 00:11:37', '2024-09-07 00:11:39'),
(421, 'App\\Models\\User', 7, 'MyApp', '2973747a371465cfa3a0c97e13ea9fbcb234666005030cfbf9e29c4c6ec8a051', '[\"*\"]', NULL, '2024-09-07 02:29:44', '2024-09-07 02:29:44'),
(422, 'App\\Models\\User', 7, 'MyApp', 'be0e4ee368412b085a520c9f31c7e1c72a0f6b868c0a03eff374beefd6b5c157', '[\"*\"]', '2024-09-07 02:29:45', '2024-09-07 02:29:44', '2024-09-07 02:29:45'),
(423, 'App\\Models\\User', 7, 'MyApp', 'f7b69b081d47b37b7317d9b4489336ec433f1f997f0c78f879712489f8ed6a03', '[\"*\"]', '2024-09-08 15:26:02', '2024-09-08 15:26:01', '2024-09-08 15:26:02'),
(424, 'App\\Models\\User', 7, 'MyApp', '4f15339b9a2417cd78463bd47c4957200401c7ff6253616b0fba409217940e9f', '[\"*\"]', '2024-09-08 15:33:40', '2024-09-08 15:33:40', '2024-09-08 15:33:40'),
(425, 'App\\Models\\User', 7, 'MyApp', '7b6584328ee0a6f78c73d9a01090e409ee7e63b77486dd69a33f9388adffa9c4', '[\"*\"]', NULL, '2024-09-08 15:33:40', '2024-09-08 15:33:40'),
(426, 'App\\Models\\User', 7, 'MyApp', '5b37ca70f3a0a5373b351cf4f0a9fafa82fa47b2a6f1b249a67cdb8d279762ba', '[\"*\"]', '2024-09-08 15:36:19', '2024-09-08 15:36:19', '2024-09-08 15:36:19'),
(427, 'App\\Models\\User', 7, 'MyApp', '132a4caa77c5cb8d54e950d8c4f529e07207ab1c14ef9fdb70a1635bf484b53a', '[\"*\"]', '2024-09-08 15:36:19', '2024-09-08 15:36:19', '2024-09-08 15:36:19'),
(428, 'App\\Models\\User', 7, 'MyApp', '1e29373066aeea078b83be1c6c14bd0844e05a78e1ba9405699eb87b88d08b20', '[\"*\"]', '2024-09-08 15:50:41', '2024-09-08 15:50:39', '2024-09-08 15:50:41'),
(429, 'App\\Models\\User', 7, 'MyApp', 'bba85f75685befed5444e80587da3e2eafc9813638818b8cde7edf9b667a3af4', '[\"*\"]', '2024-09-08 17:44:20', '2024-09-08 15:50:43', '2024-09-08 17:44:20'),
(430, 'App\\Models\\User', 7, 'MyApp', 'cfbe9be568ff169cfdb8299f53475ce4cd1239005f766671a75c7eb5ccd05990', '[\"*\"]', '2024-09-08 19:12:56', '2024-09-08 18:19:45', '2024-09-08 19:12:56'),
(431, 'App\\Models\\User', 7, 'MyApp', 'a70ddc41f1f817f9f069cebd2ff1ff925ad542cc4d2b273ce92997420fce861e', '[\"*\"]', NULL, '2024-09-10 09:45:47', '2024-09-10 09:45:47'),
(432, 'App\\Models\\User', 7, 'MyApp', '4944b2a64dea03a1ea2293cc97865e9ccd649b093adf33a5af3d1f2188c70b7b', '[\"*\"]', '2024-09-10 09:45:47', '2024-09-10 09:45:47', '2024-09-10 09:45:47'),
(433, 'App\\Models\\User', 7, 'MyApp', '5088c83876af57cad83f6d7be400c3383c15af0251c9a4abad2e0565679bcd9a', '[\"*\"]', '2024-09-10 15:15:58', '2024-09-10 15:15:58', '2024-09-10 15:15:58'),
(434, 'App\\Models\\User', 7, 'MyApp', '746b28a0228239d45bb2481b9fdb934794d5123f56f67c766707cad42c629e03', '[\"*\"]', '2024-09-10 15:17:26', '2024-09-10 15:17:26', '2024-09-10 15:17:26'),
(435, 'App\\Models\\User', 7, 'MyApp', 'ea675a767e2fae15766f372a241d0129672e7eabc6334c5fd542b22af31f7527', '[\"*\"]', '2024-09-10 15:17:26', '2024-09-10 15:17:26', '2024-09-10 15:17:26'),
(436, 'App\\Models\\User', 7, 'MyApp', 'ca215eaf52980373e77a85a3abbd78e4de242516a5c3daed3664283df53ddd4b', '[\"*\"]', '2024-09-10 15:21:22', '2024-09-10 15:21:22', '2024-09-10 15:21:22'),
(437, 'App\\Models\\User', 7, 'MyApp', 'bbbc591bdeaba87b6b20dcbf0cbce67d99cb16bb03ca7df39e00e2fbaa76e9ea', '[\"*\"]', '2024-09-10 15:24:49', '2024-09-10 15:24:49', '2024-09-10 15:24:49'),
(438, 'App\\Models\\User', 7, 'MyApp', '08105e8e1833899e8eb82bb2d3da7720b57b28b880718546443c7c00a4cd315c', '[\"*\"]', '2024-09-10 15:24:49', '2024-09-10 15:24:49', '2024-09-10 15:24:49'),
(439, 'App\\Models\\User', 7, 'MyApp', 'a21355f0b72bccf02d5b94e6238193707558daff04df6d2b797afa2494c71293', '[\"*\"]', '2024-09-10 15:26:45', '2024-09-10 15:26:44', '2024-09-10 15:26:45'),
(440, 'App\\Models\\User', 7, 'MyApp', 'd7e8c16c93db292168e8a705b58c792d21259201e48c24d99a8bdedfc70624b5', '[\"*\"]', '2024-09-10 15:26:45', '2024-09-10 15:26:44', '2024-09-10 15:26:45'),
(441, 'App\\Models\\User', 7, 'MyApp', 'fafccbbffba67256490e1602eb3b067ae3dc2648e3d49bd02bb5f61d4f3cbe74', '[\"*\"]', NULL, '2024-09-10 15:33:55', '2024-09-10 15:33:55'),
(442, 'App\\Models\\User', 7, 'MyApp', '4dacd9a1d27a4c74dd21f4e3bf56b8925095bd518b9508432ccc77d2b7be7329', '[\"*\"]', '2024-09-10 15:33:55', '2024-09-10 15:33:55', '2024-09-10 15:33:55'),
(443, 'App\\Models\\User', 7, 'MyApp', '3087bf5b35eda00b0e103ffd7b012868ed92cfdadd2aa7f35a4fba6fb420ed3d', '[\"*\"]', '2024-09-10 16:26:48', '2024-09-10 15:49:57', '2024-09-10 16:26:48'),
(444, 'App\\Models\\User', 7, 'MyApp', '21341b1e18a751c3166d752ca5226ae55dea7d57b57cd6319c2739abc3b62b4a', '[\"*\"]', '2024-09-22 18:13:04', '2024-09-22 18:12:10', '2024-09-22 18:13:04'),
(445, 'App\\Models\\User', 7, 'MyApp', '64b226bfdec96764d90cf4eb86f5385089e89c9e5703f952bf426d82a3524db5', '[\"*\"]', '2024-09-28 22:28:10', '2024-09-28 21:19:22', '2024-09-28 22:28:10'),
(446, 'App\\Models\\User', 7, 'MyApp', '661cf476aaefe862c61f03ee3cd7e2a9fa06a5bac0e5a491a92c980c7035461e', '[\"*\"]', '2024-09-28 22:28:20', '2024-09-28 22:28:19', '2024-09-28 22:28:20'),
(447, 'App\\Models\\User', 7, 'MyApp', '68a31e41930c6b482602cbee9631011bb8ad721936864609f2ecbae0482d2ef6', '[\"*\"]', '2024-09-28 23:26:41', '2024-09-28 22:28:20', '2024-09-28 23:26:41'),
(448, 'App\\Models\\User', 7, 'MyApp', 'e40fe60bea57980dbc4fa327e82d2bda0aa165c375fa21e927b75a48fa997fff', '[\"*\"]', '2024-09-28 23:27:50', '2024-09-28 23:27:50', '2024-09-28 23:27:50'),
(449, 'App\\Models\\User', 7, 'MyApp', 'e28b53ccbbc959e6516489ff1f394650d083871a11a86e52080e5c11d4c6c234', '[\"*\"]', '2024-09-28 23:27:56', '2024-09-28 23:27:50', '2024-09-28 23:27:56'),
(450, 'App\\Models\\User', 7, 'MyApp', '57761a5c13d862f3129a303cb662a0109b1414dd56f50367fc59cf215cd63144', '[\"*\"]', '2024-09-28 23:41:16', '2024-09-28 23:36:44', '2024-09-28 23:41:16'),
(451, 'App\\Models\\User', 7, 'MyApp', 'e5530ac1320d632344864ace86c1c2d98838d83ab28e56cdd2b8c86c3d75a53d', '[\"*\"]', '2024-09-28 23:41:27', '2024-09-28 23:41:27', '2024-09-28 23:41:27'),
(452, 'App\\Models\\User', 7, 'MyApp', 'c35179d2854d9c67018f3cadcbb2d5b0bf341c2b5a6e6f610150b6c87ce4b84b', '[\"*\"]', '2024-09-28 23:41:52', '2024-09-28 23:41:27', '2024-09-28 23:41:52'),
(453, 'App\\Models\\User', 7, 'MyApp', '9ef89710e08ec955e737b6c8923a8cf4dcc71533c05b1e700d61e39bfc5eda0e', '[\"*\"]', '2024-09-28 23:51:33', '2024-09-28 23:43:52', '2024-09-28 23:51:33'),
(454, 'App\\Models\\User', 7, 'MyApp', '6d576ee4160ec5de4cdcf4c6aad2db00f722080e160d247942528d9388554f82', '[\"*\"]', '2024-09-28 23:55:40', '2024-09-28 23:52:26', '2024-09-28 23:55:40'),
(455, 'App\\Models\\User', 7, 'MyApp', '0794d1b6af6a69db0984d9a49422f92b616a1d5b869be36aad59ce7e04b0eb47', '[\"*\"]', '2024-09-28 23:56:15', '2024-09-28 23:56:15', '2024-09-28 23:56:15'),
(456, 'App\\Models\\User', 7, 'MyApp', '8f949aa3f9c5b202e0d688fa907d875d28f8e6d76d0921e35bdd311659145457', '[\"*\"]', '2024-09-28 23:56:21', '2024-09-28 23:56:15', '2024-09-28 23:56:21'),
(457, 'App\\Models\\User', 7, 'MyApp', 'd54248d1d5be3d3ebf1be89ffe24c32ebeed6cd275875983f3407a878374d7a4', '[\"*\"]', '2024-09-28 23:57:10', '2024-09-28 23:57:10', '2024-09-28 23:57:10'),
(458, 'App\\Models\\User', 7, 'MyApp', '549c57a1c273818547e2c0bff9c9001e912e075acd4edb80fdc382dc412216dc', '[\"*\"]', '2024-09-28 23:57:20', '2024-09-28 23:57:10', '2024-09-28 23:57:20'),
(459, 'App\\Models\\User', 7, 'MyApp', 'ac5f93410fe077c6620bca3209e688f92c2b5f10d6535269a1628eedf05667d2', '[\"*\"]', '2024-09-29 00:04:35', '2024-09-28 23:58:27', '2024-09-29 00:04:35'),
(460, 'App\\Models\\User', 7, 'MyApp', '2b129e03900e32c5861d0fe6de693fb3297f01558b94ec7f87545c9d81ed6ba4', '[\"*\"]', '2024-09-29 00:08:53', '2024-09-29 00:08:53', '2024-09-29 00:08:53'),
(461, 'App\\Models\\User', 7, 'MyApp', '3209302c2c800d1fcb81df22c503488458418fb41041dcecbbd82823c7e0cc99', '[\"*\"]', '2024-09-29 00:32:53', '2024-09-29 00:32:53', '2024-09-29 00:32:53'),
(462, 'App\\Models\\User', 7, 'MyApp', 'd28497ab8355d884f732e68abedb6257db82b7477f8c27f84834eb3bdcfb6fcd', '[\"*\"]', '2024-09-29 01:04:33', '2024-09-29 00:34:19', '2024-09-29 01:04:33'),
(463, 'App\\Models\\User', 7, 'MyApp', 'ece03c411cefcead22e6099c829471568c3df3e2410f877fcc7939b00778a275', '[\"*\"]', '2024-09-29 23:58:23', '2024-09-29 23:58:22', '2024-09-29 23:58:23'),
(464, 'App\\Models\\User', 7, 'MyApp', '86c1228ed92f6cd3b59e692a9797a67b2353c32a3319a1ef90e6b2d66eaa9985', '[\"*\"]', '2024-10-05 14:02:39', '2024-10-05 13:58:34', '2024-10-05 14:02:39'),
(465, 'App\\Models\\User', 7, 'MyApp', '991a5f887095c1805bc4dddfc70280ce93511f3d6c0173a9360d5fb9758a7542', '[\"*\"]', '2024-10-05 13:58:58', '2024-10-05 13:58:57', '2024-10-05 13:58:58'),
(466, 'App\\Models\\User', 7, 'MyApp', 'fb69ecc9926f1849cbe35b7ff27a5f3e35fa5542dd3bc0290153cefd4923e80e', '[\"*\"]', '2024-10-05 13:59:08', '2024-10-05 13:58:57', '2024-10-05 13:59:08'),
(467, 'App\\Models\\User', 7, 'MyApp', 'b59feca1e783e32e7dca7855830bdcdf3ba569aa8ae101a93841d78283b7d45d', '[\"*\"]', '2024-10-05 14:17:43', '2024-10-05 14:17:43', '2024-10-05 14:17:43'),
(468, 'App\\Models\\User', 7, 'MyApp', '0fa7559e9d87f0f4e6c6527e857e34dc580990df81ce708401e18cf26dab3f75', '[\"*\"]', '2024-10-05 14:45:08', '2024-10-05 14:45:08', '2024-10-05 14:45:08'),
(469, 'App\\Models\\User', 7, 'MyApp', 'fb6bf2c1877f003d1e4f5e6fb1beef2b4ba2aa2da48fc04fd29be2b2a6bf1621', '[\"*\"]', '2024-10-05 14:45:08', '2024-10-05 14:45:08', '2024-10-05 14:45:08'),
(470, 'App\\Models\\User', 7, 'MyApp', '3e56712ee1992c851ec423fdd8dddcf4561ab156f6fa89a0bbacc17967fb570d', '[\"*\"]', '2024-10-21 02:21:25', '2024-10-21 02:15:53', '2024-10-21 02:21:25'),
(471, 'App\\Models\\User', 7, 'MyApp', '6ab1e39b22e1d9454dc316a7924492172b063f6366032dd83806eafd388f7d9f', '[\"*\"]', '2024-10-21 02:26:17', '2024-10-21 02:25:23', '2024-10-21 02:26:17'),
(472, 'App\\Models\\User', 7, 'MyApp', '2a73ffcc22f31fbad2376300a9492f91dde966a416972544717c5b4710c3f83f', '[\"*\"]', '2024-10-21 18:14:16', '2024-10-21 18:14:16', '2024-10-21 18:14:16'),
(473, 'App\\Models\\User', 7, 'MyApp', 'c10a32f33b3d186aa60d4bebcdec447fb0284a259b6dca890aa00cdb2f95efdf', '[\"*\"]', '2024-10-21 22:19:26', '2024-10-21 21:49:47', '2024-10-21 22:19:26'),
(474, 'App\\Models\\User', 7, 'MyApp', 'c363ce0092d9a868ad0d399bfcc024d37878e8db51cbaaa788baf52a548c958c', '[\"*\"]', '2024-10-22 01:24:36', '2024-10-21 23:35:35', '2024-10-22 01:24:36'),
(475, 'App\\Models\\User', 7, 'MyApp', '4377328a71e7cc798b3ae874616a03dafe7710a27d6728870fb80c4df16de54f', '[\"*\"]', '2024-10-22 01:32:13', '2024-10-22 01:27:27', '2024-10-22 01:32:13'),
(476, 'App\\Models\\User', 7, 'MyApp', '377423e27347036b178a3d97736cc7e41ed3430d5f3aabe522bd637ab42d3fe3', '[\"*\"]', '2024-10-22 01:40:28', '2024-10-22 01:40:28', '2024-10-22 01:40:28'),
(477, 'App\\Models\\User', 7, 'MyApp', '8ae9053a55fa3fe9ec0b42039469107320083dc96da06be06a5161e46c828bb4', '[\"*\"]', '2024-10-22 01:40:45', '2024-10-22 01:40:28', '2024-10-22 01:40:45'),
(478, 'App\\Models\\User', 7, 'MyApp', 'adbbfbfe5fae5b381640d28c43ce486f0b2bcdba080213cab72f7e64728914e6', '[\"*\"]', '2024-10-22 01:44:12', '2024-10-22 01:44:11', '2024-10-22 01:44:12'),
(479, 'App\\Models\\User', 7, 'MyApp', 'd7f0b87a0664f5ff170bfd1f9da87946d7468890623fe85a8266974007601b2c', '[\"*\"]', '2024-10-22 02:00:54', '2024-10-22 01:44:12', '2024-10-22 02:00:54'),
(480, 'App\\Models\\User', 7, 'MyApp', 'ec742f73729f89e368a1359e702b60b57d26777218d383f884e8011f2217d943', '[\"*\"]', '2024-10-22 02:17:49', '2024-10-22 02:17:49', '2024-10-22 02:17:49'),
(481, 'App\\Models\\User', 7, 'MyApp', 'bc8245495ec173a9275358d4485fb80da57f8036ebc77689d37a9e521412b325', '[\"*\"]', '2024-10-23 12:35:56', '2024-10-23 12:35:55', '2024-10-23 12:35:56'),
(482, 'App\\Models\\User', 7, 'MyApp', 'a7d91f914f3527562f49a05f5b3c73b2a408b94011d3f2099a6adc4df935bcb6', '[\"*\"]', '2024-10-23 13:34:04', '2024-10-23 13:34:03', '2024-10-23 13:34:04'),
(483, 'App\\Models\\User', 7, 'MyApp', '9d026062ad45b0049d4962d8af4ee8c3dcb729dcad1225386eea78c8a30d5aa2', '[\"*\"]', '2024-10-23 14:14:29', '2024-10-23 13:39:58', '2024-10-23 14:14:29'),
(484, 'App\\Models\\User', 7, 'MyApp', 'f0ca9667b683ffa0192916fd7098f639daa2dfd2ecfa8b66ef120808439bba12', '[\"*\"]', '2024-10-23 15:37:17', '2024-10-23 15:37:17', '2024-10-23 15:37:17'),
(485, 'App\\Models\\User', 7, 'MyApp', '54e96fef447a4d7b81d86d3c31c9048e19f34fb75e60f5a40574dcd5f98ff9a8', '[\"*\"]', '2024-10-23 18:05:16', '2024-10-23 17:00:59', '2024-10-23 18:05:16'),
(486, 'App\\Models\\User', 7, 'MyApp', '8c44052106a1a16a54367ca125e2c2752f552871dcd82ffd954b4c4fa1b02325', '[\"*\"]', '2024-10-23 18:13:11', '2024-10-23 18:13:11', '2024-10-23 18:13:11'),
(487, 'App\\Models\\User', 7, 'MyApp', '996f60627d506c543275af15f9c4ccdf150ae31f2eb65a1eb04273961fa33186', '[\"*\"]', '2024-10-23 19:57:46', '2024-10-23 19:57:46', '2024-10-23 19:57:46'),
(488, 'App\\Models\\User', 7, 'MyApp', '84ecee975badef4550f82ef274e3f3e56562a62b114d12faf594c7c2d39a1dc3', '[\"*\"]', '2024-10-23 19:57:48', '2024-10-23 19:57:46', '2024-10-23 19:57:48'),
(489, 'App\\Models\\User', 7, 'MyApp', 'fc1a8ae4dbba337881d538c7101f1c2aa9c051142c4e67ce0366eb5e7f22c7d2', '[\"*\"]', '2024-10-24 13:14:42', '2024-10-24 13:14:42', '2024-10-24 13:14:42'),
(490, 'App\\Models\\User', 7, 'MyApp', '9820f9084595eab298aa230d39a20f629edb5c1e6324da3fd26bf26a426e40a8', '[\"*\"]', '2024-10-24 23:39:32', '2024-10-24 23:23:56', '2024-10-24 23:39:32'),
(491, 'App\\Models\\User', 7, 'MyApp', '5465b9727acf0b82ac50fd66a176e8a3621d8722efb74d466b9e567ee823271e', '[\"*\"]', '2024-10-25 00:58:44', '2024-10-25 00:54:22', '2024-10-25 00:58:44'),
(492, 'App\\Models\\User', 7, 'MyApp', 'fe2561a3b77e80588e5a94001464bc84aec712b6df6b0675c26c104f8a903887', '[\"*\"]', '2024-10-25 01:23:29', '2024-10-25 01:23:29', '2024-10-25 01:23:29'),
(493, 'App\\Models\\User', 7, 'MyApp', 'cabdb3d07d2b3aa2e31da882be8ade264956da37526f244489a5a5b10534ceff', '[\"*\"]', '2024-10-25 01:23:30', '2024-10-25 01:23:29', '2024-10-25 01:23:30'),
(494, 'App\\Models\\User', 7, 'MyApp', '1cb08a7478d471a6e32cab08d9f5dc25747b56937a9315b2bb671b96c0b7c3df', '[\"*\"]', '2024-10-25 01:26:59', '2024-10-25 01:26:59', '2024-10-25 01:26:59'),
(495, 'App\\Models\\User', 7, 'MyApp', '6fe1351c3d964a3f20ae735c8d5741a84763e576e4ed96cffc08f9435e8180c6', '[\"*\"]', '2024-10-25 01:26:59', '2024-10-25 01:26:59', '2024-10-25 01:26:59'),
(496, 'App\\Models\\User', 7, 'MyApp', '991d9aa301cdebfffee903502c2012da3351b0b4fdc7db38475e69b1ec42b43f', '[\"*\"]', '2024-10-25 01:40:39', '2024-10-25 01:40:38', '2024-10-25 01:40:39'),
(497, 'App\\Models\\User', 7, 'MyApp', 'cca2b89b4667a31927ac2773bde7a037200d079252ebb01d573a5607e869fc7c', '[\"*\"]', '2024-10-25 01:40:39', '2024-10-25 01:40:39', '2024-10-25 01:40:39'),
(498, 'App\\Models\\User', 7, 'MyApp', 'bc84fac985a37fb76171ea1598f44bcdacf96db1063b78ad4a4e7eac39e9c522', '[\"*\"]', '2024-10-25 01:59:43', '2024-10-25 01:58:17', '2024-10-25 01:59:43'),
(499, 'App\\Models\\User', 7, 'MyApp', '274e23bc201653b2b8df623dbbcf252960d8970f4078632c1913fdfc48253438', '[\"*\"]', NULL, '2024-10-25 01:59:49', '2024-10-25 01:59:49'),
(500, 'App\\Models\\User', 7, 'MyApp', '179992e9de284c83645e49653751798d7072fc97fee78f84d685d4efef8a12f5', '[\"*\"]', '2024-10-25 01:59:49', '2024-10-25 01:59:49', '2024-10-25 01:59:49'),
(501, 'App\\Models\\User', 7, 'MyApp', 'f4726353247d2eb1a9d9015338455bc3350194179b615c8cc91d6805ea4b2b3d', '[\"*\"]', '2024-10-25 02:01:03', '2024-10-25 02:01:03', '2024-10-25 02:01:03'),
(502, 'App\\Models\\User', 7, 'MyApp', '4ec3de8de4b12534df89688a4fab01e8d5955b800f2ca9738b42b4bb70e4f856', '[\"*\"]', '2024-10-25 02:01:03', '2024-10-25 02:01:03', '2024-10-25 02:01:03'),
(503, 'App\\Models\\User', 7, 'MyApp', '0344a8dc8d725f4cede7deeb4f87780d3e6370455e09495af80bf53c04feb622', '[\"*\"]', '2024-10-25 21:59:38', '2024-10-25 21:59:36', '2024-10-25 21:59:38'),
(504, 'App\\Models\\User', 7, 'MyApp', '371440b2125ad46f4554e33fcbc3ade3deeb2edaf471c3ce8af685c6456cad18', '[\"*\"]', '2024-10-25 21:59:51', '2024-10-25 21:59:51', '2024-10-25 21:59:51'),
(505, 'App\\Models\\User', 7, 'MyApp', 'dff9e428dfed44561219d778f4f32c65b9d08f2efe40aba219354bdba2789df7', '[\"*\"]', '2024-10-25 21:59:55', '2024-10-25 21:59:55', '2024-10-25 21:59:55'),
(506, 'App\\Models\\User', 7, 'MyApp', '83e52e37860f7b07059418a452e2a62eb9c2382560e7d40f2c360d73e5159ea3', '[\"*\"]', '2024-10-26 10:52:50', '2024-10-26 10:49:38', '2024-10-26 10:52:50'),
(507, 'App\\Models\\User', 7, 'MyApp', '97937554023de107c827af699697ad1c2756c51a2011663d5a3f66107afca0c0', '[\"*\"]', '2024-10-26 10:53:21', '2024-10-26 10:53:07', '2024-10-26 10:53:21'),
(508, 'App\\Models\\User', 7, 'MyApp', '48c54cfc2c9247873e5897aed6849fb4ba165e59128af02f480051ffeb7293ba', '[\"*\"]', '2024-10-26 19:31:38', '2024-10-26 19:22:12', '2024-10-26 19:31:38'),
(509, 'App\\Models\\User', 7, 'MyApp', '667d0a854f7dd393c484ee7c69882b44e35443cbee22893f61c3f0e738ad9d6c', '[\"*\"]', '2024-10-26 19:38:49', '2024-10-26 19:31:51', '2024-10-26 19:38:49'),
(510, 'App\\Models\\User', 7, 'MyApp', 'bdaad332fc537a5f974cbf2eb6a45460af02ed8d0894c9513a6d5e19f5631c2a', '[\"*\"]', '2024-10-26 20:47:38', '2024-10-26 20:47:38', '2024-10-26 20:47:38'),
(511, 'App\\Models\\User', 7, 'MyApp', '36c4cad5d125aa1624fec3e57069934a47e861604fba7ac456284946faa0696b', '[\"*\"]', '2024-10-26 20:48:08', '2024-10-26 20:47:38', '2024-10-26 20:48:08'),
(512, 'App\\Models\\User', 114, 'MyApp', '50b9be07d880be23c58736006d8564a9d2f0270fea4bf855f93a1bdaeff675f6', '[\"*\"]', '2024-10-26 21:01:42', '2024-10-26 21:01:42', '2024-10-26 21:01:42'),
(513, 'App\\Models\\User', 7, 'MyApp', 'e38e42a955e17338903c6c69a79fa2a494f6f4268813079b8603b075043d7377', '[\"*\"]', '2024-10-26 21:12:57', '2024-10-26 21:02:59', '2024-10-26 21:12:57'),
(514, 'App\\Models\\User', 7, 'MyApp', '64858b847b72e9e93a0cc3ad9368fb74a4ac89982756c67a7d0b9235c150497a', '[\"*\"]', '2024-10-26 21:13:31', '2024-10-26 21:13:03', '2024-10-26 21:13:31'),
(515, 'App\\Models\\User', 7, 'MyApp', '86a7a9fc2b86217125c5262c3435765dbc1df89d361aabd30382f3d7718aaaae', '[\"*\"]', '2024-10-26 21:31:34', '2024-10-26 21:31:33', '2024-10-26 21:31:34'),
(516, 'App\\Models\\User', 7, 'MyApp', 'ab03c5d8a0789f115eb4d1e0614415ebfb9752b62250866eb8139589491038ca', '[\"*\"]', '2024-10-26 21:31:34', '2024-10-26 21:31:33', '2024-10-26 21:31:34'),
(517, 'App\\Models\\User', 7, 'MyApp', '95e36b041f0201e9825f37fa95712e756e32a6fd65270a62d0de52699352e280', '[\"*\"]', '2024-10-26 21:31:44', '2024-10-26 21:31:44', '2024-10-26 21:31:44'),
(518, 'App\\Models\\User', 7, 'MyApp', 'af45570c4131d6a2efce154504981f255935b03ccb6b636fac04ccc8f9db356c', '[\"*\"]', '2024-10-26 21:32:00', '2024-10-26 21:31:59', '2024-10-26 21:32:00'),
(519, 'App\\Models\\User', 7, 'MyApp', '1f61ef56d87f7ccc40af40cf7d1d4247746b1955c9cdf16ab7849b2fe6f285ba', '[\"*\"]', '2024-10-26 21:32:00', '2024-10-26 21:32:00', '2024-10-26 21:32:00'),
(520, 'App\\Models\\User', 7, 'MyApp', '9fac64b5392a7a557e373181132141f967baa1891d317a9af82005cdf8c4e99f', '[\"*\"]', '2024-10-26 22:52:24', '2024-10-26 22:52:23', '2024-10-26 22:52:24'),
(521, 'App\\Models\\User', 7, 'MyApp', 'e7902c90547b4243dd54c82895fac95f1f9c166d2141c0d9e32fbbda91aa2c3a', '[\"*\"]', '2024-10-26 22:55:38', '2024-10-26 22:55:37', '2024-10-26 22:55:38'),
(522, 'App\\Models\\User', 7, 'MyApp', 'b8511f519968978818da954dbabea7b1f6c61bf3ed01646f0d5158d2d59be3af', '[\"*\"]', '2024-10-26 22:55:38', '2024-10-26 22:55:37', '2024-10-26 22:55:38'),
(523, 'App\\Models\\User', 7, 'MyApp', '13539efd5e2e4092903ed00411b7020d35864945347879195fb575f4bea180e0', '[\"*\"]', '2024-10-26 23:04:23', '2024-10-26 23:04:22', '2024-10-26 23:04:23'),
(524, 'App\\Models\\User', 7, 'MyApp', 'c831d2452a17b87d95587a8eb6ba954080fde270aca4fcb42afb6a4697b7921a', '[\"*\"]', '2024-10-27 00:04:22', '2024-10-27 00:04:22', '2024-10-27 00:04:22'),
(525, 'App\\Models\\User', 7, 'MyApp', 'a1aa6375e4d62d446023099cca6e0e86fa735c1ec63c0b5dfc0820f73191d523', '[\"*\"]', '2024-10-27 00:04:22', '2024-10-27 00:04:22', '2024-10-27 00:04:22'),
(526, 'App\\Models\\User', 7, 'MyApp', 'e1e0af1c66625b69ff86b71ab79c10bb84caf104bb56539e4abf47c6f9e2293f', '[\"*\"]', NULL, '2024-10-27 00:26:19', '2024-10-27 00:26:19'),
(527, 'App\\Models\\User', 7, 'MyApp', 'b45ba696f3c37fd9fefc54ee5fceb46614739994dec7caa1ebf526897158fac7', '[\"*\"]', '2024-10-27 00:26:20', '2024-10-27 00:26:19', '2024-10-27 00:26:20'),
(528, 'App\\Models\\User', 7, 'MyApp', 'ada6e5e89211e2223bef80f59871304bd222dfe70e739f487d2ef5ce5e2f1577', '[\"*\"]', '2024-10-27 00:59:19', '2024-10-27 00:59:18', '2024-10-27 00:59:19'),
(529, 'App\\Models\\User', 7, 'MyApp', '89b830e1d48ca4a528ae58c35daef216814249b40a4df73640da6413ca30770b', '[\"*\"]', '2024-10-27 00:59:19', '2024-10-27 00:59:19', '2024-10-27 00:59:19'),
(530, 'App\\Models\\User', 7, 'MyApp', 'e47b5bc4aa6a6497ac632c533d17f258c798aace41730f56a18aaca4b011b036', '[\"*\"]', NULL, '2024-10-27 03:03:02', '2024-10-27 03:03:02'),
(531, 'App\\Models\\User', 7, 'MyApp', '5979bf4144441c29177fe389f23d3c851a45d54dc007c5b1b76ece5003747c82', '[\"*\"]', '2024-10-27 03:07:15', '2024-10-27 03:03:02', '2024-10-27 03:07:15'),
(532, 'App\\Models\\User', 7, 'MyApp', '4c1909a76048d61b3862d68dcfe95c9fd852e18b063c15c3759551d80a930bb8', '[\"*\"]', '2024-10-27 13:21:07', '2024-10-27 13:21:06', '2024-10-27 13:21:07'),
(533, 'App\\Models\\User', 7, 'MyApp', '84cb0e3bb0aa7a692f0972957fc0e0a81a0dcf76f0e8d926c5ad426a2701efda', '[\"*\"]', '2024-10-27 17:38:26', '2024-10-27 17:38:25', '2024-10-27 17:38:26'),
(534, 'App\\Models\\User', 7, 'MyApp', 'f72240ea877d7cf08dfc75e185039f2fb2697c3e4f0e38b9c83556c28a21c000', '[\"*\"]', '2024-10-28 21:29:02', '2024-10-28 20:47:23', '2024-10-28 21:29:02'),
(535, 'App\\Models\\User', 7, 'MyApp', '16e96b44bcd78286906f3bb5ce98167852cc0bc31a99a73b065752079712fe12', '[\"*\"]', '2024-10-28 22:58:32', '2024-10-28 22:58:31', '2024-10-28 22:58:32'),
(536, 'App\\Models\\User', 7, 'MyApp', '9e3f9c8c884728e36c52893b13f0516bd0dfee19c2b0446d5eee026e9c4736b5', '[\"*\"]', NULL, '2024-10-28 23:01:22', '2024-10-28 23:01:22'),
(537, 'App\\Models\\User', 7, 'MyApp', 'f09f7e81f46fe430fd14554fb51e045c573caea8b966ea19cd47b4224c7d5527', '[\"*\"]', '2024-10-28 23:02:22', '2024-10-28 23:01:22', '2024-10-28 23:02:22'),
(538, 'App\\Models\\User', 7, 'MyApp', '064d0e9c27a143c0d25d0612eaf2b3bd727fd6b1dd1b1065b9868c69420aaf01', '[\"*\"]', NULL, '2024-10-28 23:02:32', '2024-10-28 23:02:32'),
(539, 'App\\Models\\User', 7, 'MyApp', 'dd5111ee3be0a05e682d3f23d9f102231d8bc70d3844f08700c017ca29cbd095', '[\"*\"]', '2024-10-28 23:02:45', '2024-10-28 23:02:32', '2024-10-28 23:02:45');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(540, 'App\\Models\\User', 7, 'MyApp', '01bbb63dcfef4f4450f4f27adcc57f066eda24b6cdf44f922ba907adfb023b3e', '[\"*\"]', NULL, '2024-10-28 23:02:56', '2024-10-28 23:02:56'),
(541, 'App\\Models\\User', 7, 'MyApp', '847ad04473d3f670096fb95b2173443bc5aea8aa05ca23fbc755a708acfe44ee', '[\"*\"]', '2024-10-28 23:03:26', '2024-10-28 23:02:56', '2024-10-28 23:03:26'),
(542, 'App\\Models\\User', 7, 'MyApp', '9d7687d58e5ede3c973232b3f5feb6150b8fdcd16b7f9dde2cb4d4e5b29962e8', '[\"*\"]', NULL, '2024-10-28 23:03:40', '2024-10-28 23:03:40'),
(543, 'App\\Models\\User', 7, 'MyApp', '3c8793d507b1747d9a80f3c92385bec3b81b70d804ed85fcfa27367a65ba445f', '[\"*\"]', '2024-10-28 23:04:02', '2024-10-28 23:03:40', '2024-10-28 23:04:02'),
(544, 'App\\Models\\User', 7, 'MyApp', '773b1a7168319aa98f7c7443a6164103ad4be76b98d8043b044c700fb685e2ed', '[\"*\"]', '2024-10-29 02:32:10', '2024-10-29 02:32:09', '2024-10-29 02:32:10'),
(545, 'App\\Models\\User', 7, 'MyApp', 'd68050201e3ef766613abadbb3cd950f4dd367dd8b37e55c294a1457b8fd9005', '[\"*\"]', NULL, '2024-10-29 02:35:19', '2024-10-29 02:35:19'),
(546, 'App\\Models\\User', 7, 'MyApp', '823697644472fc0719fb9f14a1d9bacfcf8619ca6c398b2ed61678a70e092012', '[\"*\"]', '2024-10-29 02:35:59', '2024-10-29 02:35:19', '2024-10-29 02:35:59'),
(547, 'App\\Models\\User', 7, 'MyApp', '2d3b97c303a37811a9b943f75bebadb858b5001a21c7b33d981957a11f44f28a', '[\"*\"]', '2024-10-29 02:38:28', '2024-10-29 02:37:52', '2024-10-29 02:38:28'),
(548, 'App\\Models\\User', 7, 'MyApp', 'ad00eb569aec96b236a7223058aa987ba358bc5191cba69738f59c7a26ae5cd7', '[\"*\"]', '2024-10-29 02:39:36', '2024-10-29 02:39:35', '2024-10-29 02:39:36'),
(549, 'App\\Models\\User', 7, 'MyApp', 'a229ebf06f02365eda2a50c45ccd6b4babffb71c9fd590127a31392ee59eaa3a', '[\"*\"]', '2024-10-29 02:40:04', '2024-10-29 02:39:35', '2024-10-29 02:40:04'),
(550, 'App\\Models\\User', 7, 'MyApp', '0d71f00af46674b056afaa6781812328ade634a74965afd10613172ee385949b', '[\"*\"]', '2024-10-29 02:48:40', '2024-10-29 02:48:40', '2024-10-29 02:48:40'),
(551, 'App\\Models\\User', 7, 'MyApp', 'c9111f3b140680394a64f11523ae8650d82a073e78ad5bf13c9c37cb7dd7dd64', '[\"*\"]', '2024-10-29 03:02:32', '2024-10-29 02:48:40', '2024-10-29 03:02:32'),
(552, 'App\\Models\\User', 7, 'MyApp', '808b4841736b5d918269331475a96ee9b02146e8c812b74a0858775f5837c31d', '[\"*\"]', '2024-10-29 03:04:03', '2024-10-29 03:03:16', '2024-10-29 03:04:03'),
(553, 'App\\Models\\User', 7, 'MyApp', '6bf1aee03ebc9da9cf736bc27674bac7972c82d56bf9542f6e2ebb11373ff021', '[\"*\"]', NULL, '2024-10-29 03:07:13', '2024-10-29 03:07:13'),
(554, 'App\\Models\\User', 7, 'MyApp', '7024e5a1dcfc87b9a600282a3e8edabd8029a385c29ed6f44bb4e21226728a4e', '[\"*\"]', '2024-10-29 03:17:25', '2024-10-29 03:07:13', '2024-10-29 03:17:25'),
(555, 'App\\Models\\User', 7, 'MyApp', '889506cd1d14901d7db74c1285ee38173320b09f58d9475389c801b3f6015c76', '[\"*\"]', '2024-10-29 03:26:05', '2024-10-29 03:24:57', '2024-10-29 03:26:05'),
(556, 'App\\Models\\User', 7, 'MyApp', 'a0da78788bde7a5c9351681186d8a0f077346938b4badb261f9440586815826e', '[\"*\"]', '2024-10-29 12:35:20', '2024-10-29 12:35:20', '2024-10-29 12:35:20'),
(557, 'App\\Models\\User', 7, 'MyApp', '833c34a2449b1551e5709b4f7a63c755750c7c38d3146f42c5d75fcfa119e635', '[\"*\"]', NULL, '2024-10-29 12:35:20', '2024-10-29 12:35:20'),
(558, 'App\\Models\\User', 7, 'MyApp', '9ff18c6b1053920289279a7b8e17462c24491443a5d3f0304fa09e4ea984f13b', '[\"*\"]', '2024-10-29 12:35:47', '2024-10-29 12:35:47', '2024-10-29 12:35:47'),
(559, 'App\\Models\\User', 7, 'MyApp', '341a04ee788845f67c3f62b6009e9a448541853e8ca1e5a9e05fe58dc3770b0b', '[\"*\"]', NULL, '2024-10-29 12:35:47', '2024-10-29 12:35:47'),
(560, 'App\\Models\\User', 7, 'MyApp', '11e86274ec979c19e763afc05176735f12a8bdf2b6d74200c3169b98b31297ad', '[\"*\"]', '2024-10-29 12:35:56', '2024-10-29 12:35:56', '2024-10-29 12:35:56'),
(561, 'App\\Models\\User', 7, 'MyApp', 'a1b0c026df3c466341859101f4cd3eb4565cdab1f5f43cbbc90fd4c1e0420248', '[\"*\"]', '2024-10-29 12:36:17', '2024-10-29 12:35:56', '2024-10-29 12:36:17'),
(562, 'App\\Models\\User', 7, 'MyApp', '560fdab657b257bd4958a52a2592995d77afa12547889cda67f4574c7b6baf53', '[\"*\"]', '2024-10-29 12:39:14', '2024-10-29 12:37:59', '2024-10-29 12:39:14'),
(563, 'App\\Models\\User', 7, 'MyApp', '5bc02f98d37ceffb76e459272b4a01808183556f7ec39f8ac6bcb2e2b4d0ed51', '[\"*\"]', '2024-10-29 12:40:00', '2024-10-29 12:39:27', '2024-10-29 12:40:00'),
(564, 'App\\Models\\User', 7, 'MyApp', 'b8afa641cdda825f3ac147512db4ab378f81ea0f4cfa2621c297e52bfdbaf266', '[\"*\"]', '2024-10-30 16:47:10', '2024-10-30 16:47:10', '2024-10-30 16:47:10'),
(565, 'App\\Models\\User', 7, 'MyApp', '61fd3ed2ca58a38c8406d920ccfe53c0e69117a2680316953d315ee2cb0f2de9', '[\"*\"]', '2024-10-30 16:47:19', '2024-10-30 16:47:19', '2024-10-30 16:47:19'),
(566, 'App\\Models\\User', 7, 'MyApp', '63ce8943a72eeb5d4e1aaff3a2061b76eced159f4b9ba97266da9e190befa93f', '[\"*\"]', '2024-10-31 12:37:02', '2024-10-31 12:37:02', '2024-10-31 12:37:02'),
(567, 'App\\Models\\User', 7, 'MyApp', '328959c8305f38ff4072f87ae5b68e21cb439f21ec34934fddbcc6f42b084e88', '[\"*\"]', '2024-10-31 12:37:03', '2024-10-31 12:37:02', '2024-10-31 12:37:03'),
(568, 'App\\Models\\User', 7, 'MyApp', 'f7de9daf4bcba571d2aa33ca10a39a6c694342ef3797364785c1392be068438b', '[\"*\"]', '2024-10-31 12:43:35', '2024-10-31 12:37:24', '2024-10-31 12:43:35'),
(569, 'App\\Models\\User', 7, 'MyApp', '3f9971f482f2ad78cbfa9174f8cd184edcabd58037475eb6de6c42a1c4e9c465', '[\"*\"]', '2024-10-31 13:46:33', '2024-10-31 13:41:45', '2024-10-31 13:46:33'),
(570, 'App\\Models\\User', 7, 'MyApp', '46149fe166b58c510ed8d1393af8c4407411cd161451644795d7d49bed950894', '[\"*\"]', '2024-11-01 22:45:10', '2024-11-01 22:45:09', '2024-11-01 22:45:10'),
(571, 'App\\Models\\User', 7, 'MyApp', '205948614ee6466ea4ffa5b61b19fb17ad8be4628c2148c2a62569b66a0fce24', '[\"*\"]', '2024-11-01 23:26:38', '2024-11-01 23:26:37', '2024-11-01 23:26:38'),
(572, 'App\\Models\\User', 7, 'MyApp', '2a79b65911ec403620ac6c3d267396e5097b8b00af746827126077dc50ebf903', '[\"*\"]', '2024-11-01 23:26:38', '2024-11-01 23:26:37', '2024-11-01 23:26:38'),
(573, 'App\\Models\\User', 7, 'MyApp', 'cafb1124b3b5ce2960cf24ff4f227de2cc88c4bcd6328946b01c54cf8fd2bad7', '[\"*\"]', '2024-11-01 23:30:15', '2024-11-01 23:30:14', '2024-11-01 23:30:15'),
(574, 'App\\Models\\User', 7, 'MyApp', '4168e986b03c68129d91a28039249bbdd4081b8cb2bf1b5397c1d69398a6aa7b', '[\"*\"]', '2024-11-01 23:30:15', '2024-11-01 23:30:15', '2024-11-01 23:30:15'),
(575, 'App\\Models\\User', 7, 'MyApp', '41b839aaec8697e3494763ae7b6dff2cc59a0c8807229e1c43a6f01bed488977', '[\"*\"]', NULL, '2024-11-01 23:30:40', '2024-11-01 23:30:40'),
(576, 'App\\Models\\User', 7, 'MyApp', 'fb35f3dbbd2068d5f8338a9e051025cfd7addd16db8c8a8cc356f1bfdb97b3d5', '[\"*\"]', '2024-11-01 23:30:40', '2024-11-01 23:30:40', '2024-11-01 23:30:40'),
(577, 'App\\Models\\User', 7, 'MyApp', 'd0abb17a72e5dbb50e3dbc3b6e18db542d9094e2f781003b9be084d3a152b8b2', '[\"*\"]', NULL, '2024-11-01 23:35:51', '2024-11-01 23:35:51'),
(578, 'App\\Models\\User', 7, 'MyApp', '5373a6eff21d4d7ac27e7cb036f0a6cec21a9ec14081ee4ef91a24325785e59e', '[\"*\"]', '2024-11-01 23:35:52', '2024-11-01 23:35:51', '2024-11-01 23:35:52'),
(579, 'App\\Models\\User', 7, 'MyApp', '4fa5c5fc670b7532682ae85a308ba36c1538ce7a3adc71293fee9028defc6dfb', '[\"*\"]', '2024-11-02 00:26:00', '2024-11-02 00:26:00', '2024-11-02 00:26:00'),
(580, 'App\\Models\\User', 7, 'MyApp', 'f1f182e47833c9db00bad94afa90ea6ae0b4b5e538f9ab2cecccffe7fccf36d1', '[\"*\"]', '2024-11-02 00:26:00', '2024-11-02 00:26:00', '2024-11-02 00:26:00'),
(581, 'App\\Models\\User', 7, 'MyApp', 'e0e713248ecced6ccaa2db3361371e80f447ed8770c6810334bfc7b7f48cd8c9', '[\"*\"]', '2024-11-02 00:45:25', '2024-11-02 00:45:25', '2024-11-02 00:45:25'),
(582, 'App\\Models\\User', 7, 'MyApp', '07413b5262a8c102c2bec80687cc61e9f1d9f067699ceddc5c32b7bd18f816ed', '[\"*\"]', '2024-11-02 00:45:25', '2024-11-02 00:45:25', '2024-11-02 00:45:25'),
(583, 'App\\Models\\User', 7, 'MyApp', '9ca630f6cc39662cb1f83b870666c78cc69b77d8efe7cbd881f8ef4be8bb2c4a', '[\"*\"]', '2024-11-02 00:46:59', '2024-11-02 00:46:58', '2024-11-02 00:46:59'),
(584, 'App\\Models\\User', 7, 'MyApp', '2bd584635ff1bea0254c09805e18845354c9b4117fc4937d0a49e9e846cc6754', '[\"*\"]', '2024-11-02 00:46:59', '2024-11-02 00:46:58', '2024-11-02 00:46:59'),
(585, 'App\\Models\\User', 7, 'MyApp', '6474602cce421210ea91dc022e92d97ae49ea3453ce453ba58030a74a40c1e19', '[\"*\"]', '2024-11-02 00:50:12', '2024-11-02 00:50:11', '2024-11-02 00:50:12'),
(586, 'App\\Models\\User', 7, 'MyApp', '9259e7572b3952dab05b7780a673a48fa41263df2658222f111bc19c14fdccf0', '[\"*\"]', '2024-11-02 01:41:11', '2024-11-02 01:41:11', '2024-11-02 01:41:11'),
(587, 'App\\Models\\User', 7, 'MyApp', 'b3f36307913c81807ab4950d41748e61893add8ccfb8af37cc8ed0f9abb51b0b', '[\"*\"]', '2024-11-02 01:41:11', '2024-11-02 01:41:11', '2024-11-02 01:41:11'),
(588, 'App\\Models\\User', 7, 'MyApp', '1dceb13ae51207e4450519da5ea6f76f5ec2a4e6ac034faa1f59bbc709271733', '[\"*\"]', '2024-11-02 01:41:12', '2024-11-02 01:41:12', '2024-11-02 01:41:12'),
(589, 'App\\Models\\User', 7, 'MyApp', 'da74620ec1dd7241906e8aac4fa7e13ee004a22d5bea9d719cd6b873e4f9697a', '[\"*\"]', NULL, '2024-11-02 01:41:12', '2024-11-02 01:41:12'),
(590, 'App\\Models\\User', 7, 'MyApp', '70b90a537765a467475b9c4cf996fcbd45a68a61c639e4e9f2068f6d805b0e9c', '[\"*\"]', '2024-11-02 01:41:12', '2024-11-02 01:41:12', '2024-11-02 01:41:12'),
(591, 'App\\Models\\User', 7, 'MyApp', 'c034f38f50ca2b594b8737eb606240df898776728720ab0f9ca4536b0c700b83', '[\"*\"]', '2024-11-02 01:41:13', '2024-11-02 01:41:13', '2024-11-02 01:41:13'),
(592, 'App\\Models\\User', 7, 'MyApp', 'ac92f2788481abdb1c32ce4342cd562c3b2dc55ed13dab90d806de70387ee4a4', '[\"*\"]', NULL, '2024-11-02 01:41:13', '2024-11-02 01:41:13'),
(593, 'App\\Models\\User', 7, 'MyApp', 'bd823c56aa5b20871ef3ed60b18df73a53910e784a744c721b0a3b9f9e28ce5f', '[\"*\"]', '2024-11-02 01:41:13', '2024-11-02 01:41:13', '2024-11-02 01:41:13'),
(594, 'App\\Models\\User', 7, 'MyApp', 'efd275cba6f2f8b92101dad6d9e2a8cc0c69536560150d8fe49c1f658ece1c0f', '[\"*\"]', '2024-11-02 01:41:14', '2024-11-02 01:41:14', '2024-11-02 01:41:14'),
(595, 'App\\Models\\User', 7, 'MyApp', 'f2eb836f4d19e81b95c06ff368342889bd943477bc68a8d8848b139d64811498', '[\"*\"]', NULL, '2024-11-02 01:41:14', '2024-11-02 01:41:14'),
(596, 'App\\Models\\User', 7, 'MyApp', 'bc76e59362d46ce1ce44e40239ac16d59e7733bfa1ca7764b6d1dab4844da113', '[\"*\"]', NULL, '2024-11-02 01:41:14', '2024-11-02 01:41:14'),
(597, 'App\\Models\\User', 7, 'MyApp', 'b9ba11e4686f1442b7fccfba9df295b433549b55fa5e2813511073d0d2b0645e', '[\"*\"]', NULL, '2024-11-02 01:41:14', '2024-11-02 01:41:14'),
(598, 'App\\Models\\User', 7, 'MyApp', '2c71bc6fd8eedca2f88f6eb78c2be6167195cb5ff016b307a0656597678d81ba', '[\"*\"]', '2024-11-02 01:41:14', '2024-11-02 01:41:14', '2024-11-02 01:41:14'),
(599, 'App\\Models\\User', 7, 'MyApp', '79cb6b2a024c94802214962d57a621744db40f643979c7b9d9a1bdb711a56e21', '[\"*\"]', '2024-11-02 01:41:15', '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(600, 'App\\Models\\User', 7, 'MyApp', 'c6d23699dbf930f1ca1b7944b52b345dcf24aa582410e84fd87d45c2851d6243', '[\"*\"]', NULL, '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(601, 'App\\Models\\User', 7, 'MyApp', '003779cb933b9850f6cdca84f6f991b91f607757fd817cabdaeab1e7b75392fb', '[\"*\"]', '2024-11-02 01:41:15', '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(602, 'App\\Models\\User', 7, 'MyApp', '515c3cc3d786e9b836283a50e0ae0282ca8dfd11a70e3695ebb66f4df3bafc6f', '[\"*\"]', NULL, '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(603, 'App\\Models\\User', 7, 'MyApp', 'ad9afe5bbb0f9a5f2fb7f90355c30eb3cad4449b96b36e73627cef0d230dae92', '[\"*\"]', '2024-11-02 01:41:15', '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(604, 'App\\Models\\User', 7, 'MyApp', '80ac06d2bd22e39e63a362ff58466d2c4ee6b4215a12690444f677b7531db5d6', '[\"*\"]', NULL, '2024-11-02 01:41:15', '2024-11-02 01:41:15'),
(605, 'App\\Models\\User', 7, 'MyApp', 'a362d1fe0a440c61b708d8c66e04ece72533ed6bc99b4442633872b830cef896', '[\"*\"]', NULL, '2024-11-02 01:41:16', '2024-11-02 01:41:16'),
(606, 'App\\Models\\User', 7, 'MyApp', 'f4c49bf249e8d4cf75d0f9a9ae5d51a9265e82deba6c491b30d3757d69184ef9', '[\"*\"]', NULL, '2024-11-02 01:41:16', '2024-11-02 01:41:16'),
(607, 'App\\Models\\User', 7, 'MyApp', 'a6eb384c9b57c1be1eea92a4366b82aeda67820d6281513ca44cdaa7dd2aa9c4', '[\"*\"]', NULL, '2024-11-02 01:41:16', '2024-11-02 01:41:16'),
(608, 'App\\Models\\User', 7, 'MyApp', 'dcd10c953a53a6275c7e8a85b708840e5fd4a244929cfdc3e2ede8cd51548a2e', '[\"*\"]', '2024-11-02 01:41:17', '2024-11-02 01:41:16', '2024-11-02 01:41:17'),
(609, 'App\\Models\\User', 7, 'MyApp', 'b2051b693419dcfc3f7f22dfdab6f32307ff05247d8910899c758f04d216cb24', '[\"*\"]', NULL, '2024-11-02 01:41:16', '2024-11-02 01:41:16'),
(610, 'App\\Models\\User', 7, 'MyApp', 'e9e594c849457fdb397761852e1e58a4343d0a1949993917cb1f898e0b3a816e', '[\"*\"]', '2024-11-02 01:41:18', '2024-11-02 01:41:16', '2024-11-02 01:41:18'),
(611, 'App\\Models\\User', 7, 'MyApp', '03df3e8c11f0ef8e59820b916572bd5d69e6f81be8f77e1c9b4358f6bd302456', '[\"*\"]', NULL, '2024-11-02 01:41:16', '2024-11-02 01:41:16'),
(612, 'App\\Models\\User', 7, 'MyApp', 'ca977313d71c4dedfdc506cd08831eb425e718d95740d5172b8c7d409ed30cb8', '[\"*\"]', '2024-11-02 01:41:17', '2024-11-02 01:41:16', '2024-11-02 01:41:17'),
(613, 'App\\Models\\User', 7, 'MyApp', 'd1eba81e9f2fcdab99b7e55cd90ec7ad5e4e89479488d642152e3fd779a910d8', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(614, 'App\\Models\\User', 7, 'MyApp', '7ed014f4f377261df283e77c841ee388a56e8b277d004d877472de43e135bd80', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(615, 'App\\Models\\User', 7, 'MyApp', '2cbd45265ba4914b248272b4049d1e8e13318df0cab20326855867a137d89992', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(616, 'App\\Models\\User', 7, 'MyApp', 'afbe6c84096f2d0f6a16ec2359c42e7a5ea421186e188754b97f9d67b6162479', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(617, 'App\\Models\\User', 7, 'MyApp', 'b81c4b48739abde275ed21d35bbcc21c3bc23092562a9c04b1b0678d30a62ebe', '[\"*\"]', '2024-11-02 01:41:18', '2024-11-02 01:41:17', '2024-11-02 01:41:18'),
(618, 'App\\Models\\User', 7, 'MyApp', '2f59f29b5a29df8cf3efbe1c911424a6279aafd2c13838cda1173888e7c171f4', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(619, 'App\\Models\\User', 7, 'MyApp', 'd34c456f3170cbb0a54697e826e56193db82616f85942681a4e45e3bfb5d8b2e', '[\"*\"]', '2024-11-02 01:41:18', '2024-11-02 01:41:17', '2024-11-02 01:41:18'),
(620, 'App\\Models\\User', 7, 'MyApp', 'a63de399bfcf2e4b9a13281d15877e289350b2e4513590196bf1e77c21764556', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(621, 'App\\Models\\User', 7, 'MyApp', '82fca3c26a5f3448bec265043d2c5b274f1947e3da8661605ab0e73d6ff64da5', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(622, 'App\\Models\\User', 7, 'MyApp', '4bcf5835eb9a9bdef9d2687e2cd265fc14c13e7af985bd41d070d3f0f701274c', '[\"*\"]', '2024-11-02 01:41:18', '2024-11-02 01:41:17', '2024-11-02 01:41:18'),
(623, 'App\\Models\\User', 7, 'MyApp', 'f7a4f4b68745e4c36a531d7c182bb2de9aa2835f812ecf2f1782bb3297e1a6d5', '[\"*\"]', NULL, '2024-11-02 01:41:17', '2024-11-02 01:41:17'),
(624, 'App\\Models\\User', 7, 'MyApp', 'da89414fcb8e349327c1c6afa2a673219200c096fc16c5938ca549d17ec00591', '[\"*\"]', '2024-11-02 01:41:19', '2024-11-02 01:41:17', '2024-11-02 01:41:19'),
(625, 'App\\Models\\User', 7, 'MyApp', '1ba1539ec8ed1b1baecf825715a62f172141a5ec6de254d0003902d165370925', '[\"*\"]', '2024-11-02 01:41:19', '2024-11-02 01:41:18', '2024-11-02 01:41:19'),
(626, 'App\\Models\\User', 7, 'MyApp', 'a7f2801f9bd7916d480994df10b57c2fd78288a7669cb24bd9c61213d6ee8b46', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(627, 'App\\Models\\User', 7, 'MyApp', '8a2ce67f854b279337f410aa74caac43858d936259c7dd56e758dc20d110ff1c', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(628, 'App\\Models\\User', 7, 'MyApp', '8a8f7705b86bf9d7ce989a0ee5a98469e4b0db4a1046843347f393d33ba7b3dc', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(629, 'App\\Models\\User', 7, 'MyApp', '3b152880c6709b51b1ec36c4a92bca2eacf2ae827f4d5d047bc62744877f2cae', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(630, 'App\\Models\\User', 7, 'MyApp', 'd5e0fe3de497b36ae431d616a8d7c473ed9e34017e28b54f7323fb19ec61fd0b', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(631, 'App\\Models\\User', 7, 'MyApp', '55dfc63e7d37070047fe3e73c9af72346b6dcb94670e5c95ea2f91737e4f0c82', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(632, 'App\\Models\\User', 7, 'MyApp', 'a8d3e93cdd0bb484a07d819a39411792dea21495d52ce49bedf86c44796a7495', '[\"*\"]', '2024-11-02 01:41:19', '2024-11-02 01:41:18', '2024-11-02 01:41:19'),
(633, 'App\\Models\\User', 7, 'MyApp', '9f1ee0f5534781d43ca82751ea5dc445220e21a27ee997dcefadb278e75b3819', '[\"*\"]', '2024-11-02 01:41:19', '2024-11-02 01:41:18', '2024-11-02 01:41:19'),
(634, 'App\\Models\\User', 7, 'MyApp', '03c5d5ef98c3c25c4f104776b7b2648a3bf7c2c23cda2eac4bc145d7083289a1', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(635, 'App\\Models\\User', 7, 'MyApp', '302bdd8fc434dffc313d792a0eafd6ea1aad651659c08cbdb179d8b09de399de', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(636, 'App\\Models\\User', 7, 'MyApp', '9e68267f069d9ef729f47220c3ed0aefd80e070fc0cd0d724133d73ffdef7f0a', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(637, 'App\\Models\\User', 7, 'MyApp', '0871edf01d3908e2905c818d8f705e22b5f5866e08e2bd4e7f8654ac674cde03', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(638, 'App\\Models\\User', 7, 'MyApp', '0e581cc39eeff552bca82d3a38334ed17ef3edcda7d05a33b2015f69515163fe', '[\"*\"]', '2024-11-02 01:41:20', '2024-11-02 01:41:18', '2024-11-02 01:41:20'),
(639, 'App\\Models\\User', 7, 'MyApp', 'ba9d92995461b9b7ead48f33e504ec3cfe1c83c7939f26b7386dc96238bdb3df', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(640, 'App\\Models\\User', 7, 'MyApp', '80d4b4289ddc24536093074acdb4aff9af45851db104e833766d8761654092dc', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(641, 'App\\Models\\User', 7, 'MyApp', '2167e8bc011be1501c1be8b307cff8a41ea515c3845a9db2a48e11c7a5c86b5d', '[\"*\"]', NULL, '2024-11-02 01:41:18', '2024-11-02 01:41:18'),
(642, 'App\\Models\\User', 7, 'MyApp', '813265bda06f5e129e9698cd99b052723d80e0a07361a4510ebd5df992b9a3ce', '[\"*\"]', NULL, '2024-11-02 01:41:19', '2024-11-02 01:41:19'),
(643, 'App\\Models\\User', 7, 'MyApp', '290bb7df93a2ffa4b578c00bf2e3100f522836121ce95768bef29d6f4cc81b78', '[\"*\"]', NULL, '2024-11-02 01:41:19', '2024-11-02 01:41:19'),
(644, 'App\\Models\\User', 7, 'MyApp', 'cc297eba62b07a8bc2551be5d4198fd5da33e94126c85644398ec3d5183b6d7b', '[\"*\"]', NULL, '2024-11-02 01:41:19', '2024-11-02 01:41:19'),
(645, 'App\\Models\\User', 7, 'MyApp', '43c2b788a69e72ff0a0a32f131357e5fcea57e6ae79cf07a807666d70aeafb75', '[\"*\"]', NULL, '2024-11-02 01:41:19', '2024-11-02 01:41:19'),
(646, 'App\\Models\\User', 7, 'MyApp', 'c14a07a1ffc6ee0fbef1dbc1dcc2ac608f6b4c00c30122f2d9d6438a15904d17', '[\"*\"]', NULL, '2024-11-02 01:41:19', '2024-11-02 01:41:19'),
(647, 'App\\Models\\User', 7, 'MyApp', 'a902413add4bf22408865dd95a147791ab04b684c5e5f47f84368b7f5ac3c295', '[\"*\"]', '2024-11-02 01:41:22', '2024-11-02 01:41:19', '2024-11-02 01:41:22'),
(648, 'App\\Models\\User', 7, 'MyApp', '5ae16053404b42a583b751c0a24cace039bda9c9899cdc6cb3e2b0fb93bb2953', '[\"*\"]', '2024-11-02 01:42:35', '2024-11-02 01:42:34', '2024-11-02 01:42:35'),
(649, 'App\\Models\\User', 7, 'MyApp', 'aa68da2ded8582d595dc24b0be076a4fd019b1c5dab2c70788fa1e9e79bfb86f', '[\"*\"]', '2024-11-02 01:42:35', '2024-11-02 01:42:35', '2024-11-02 01:42:35'),
(650, 'App\\Models\\User', 7, 'MyApp', '0ec669344d0dd6dd638f141c95ede9296afeb90569e22cb11d001fabf1fefe60', '[\"*\"]', '2024-11-02 01:42:36', '2024-11-02 01:42:35', '2024-11-02 01:42:36'),
(651, 'App\\Models\\User', 7, 'MyApp', 'b138c91c3b9a20992e9676a9957185ee3037feb370ffc7a5b06307ba0a6a1b55', '[\"*\"]', NULL, '2024-11-02 01:42:35', '2024-11-02 01:42:35'),
(652, 'App\\Models\\User', 7, 'MyApp', 'fb5f34a3a8c588f84451b933fbe67ed9157479ea8bff12386afe2238489fbeb1', '[\"*\"]', '2024-11-02 01:42:36', '2024-11-02 01:42:35', '2024-11-02 01:42:36'),
(653, 'App\\Models\\User', 7, 'MyApp', '0448c26c6b33c3f65798c3251f76efbb66e265ed277de61a42202659197099cd', '[\"*\"]', '2024-11-02 01:42:37', '2024-11-02 01:42:36', '2024-11-02 01:42:37'),
(654, 'App\\Models\\User', 7, 'MyApp', '3de54ee23408a5585856a08024fe89fed3ff69e01ced08105ecba5e962c1421d', '[\"*\"]', '2024-11-02 01:42:37', '2024-11-02 01:42:36', '2024-11-02 01:42:37'),
(655, 'App\\Models\\User', 7, 'MyApp', '540143a973e41c7d2d8749f579582cbc836b0d64d837af1a587b3222d254798e', '[\"*\"]', NULL, '2024-11-02 01:42:36', '2024-11-02 01:42:36'),
(656, 'App\\Models\\User', 7, 'MyApp', 'a24c3728e29e071c9714ef734fa26ecd898e0e69a2c4a4b26a81ff56a298642e', '[\"*\"]', NULL, '2024-11-02 01:42:36', '2024-11-02 01:42:36'),
(657, 'App\\Models\\User', 7, 'MyApp', 'cf4f903dd17a8cd52c8ce96fdff57800c4df65646137bd94e31bf588c60c4e97', '[\"*\"]', NULL, '2024-11-02 01:42:36', '2024-11-02 01:42:36'),
(658, 'App\\Models\\User', 7, 'MyApp', '115008ec61b8f0c8bd9fccf003cf5f40b07ba76a44c6f79b7217bd0101d1920a', '[\"*\"]', '2024-11-02 01:42:37', '2024-11-02 01:42:36', '2024-11-02 01:42:37'),
(659, 'App\\Models\\User', 7, 'MyApp', '0f394b511a635d3de084193e22be6fbe8044f367842875ed26bc8c1467284280', '[\"*\"]', NULL, '2024-11-02 01:42:37', '2024-11-02 01:42:37'),
(660, 'App\\Models\\User', 7, 'MyApp', '40bca6f041c1304b18cea6c02a69c0b221f4a2e12cfe7c446e100cfd800f0c2e', '[\"*\"]', NULL, '2024-11-02 01:42:37', '2024-11-02 01:42:37'),
(661, 'App\\Models\\User', 7, 'MyApp', '5a2000fd1f5fbd7c95c71b91aa8fea04d97ee700f89700659741620179263011', '[\"*\"]', '2024-11-02 01:42:39', '2024-11-02 01:42:37', '2024-11-02 01:42:39'),
(662, 'App\\Models\\User', 7, 'MyApp', '0f5d61ae13a37faf32ba2a5057c3a0ead5d5338a9c19ec033c14ce061df8d962', '[\"*\"]', NULL, '2024-11-02 01:42:38', '2024-11-02 01:42:38'),
(663, 'App\\Models\\User', 7, 'MyApp', '798ad521ae3ec180929a0a53759757d89cc9791aa57419236ef684e3e0c7a3ed', '[\"*\"]', NULL, '2024-11-02 01:42:38', '2024-11-02 01:42:38'),
(664, 'App\\Models\\User', 7, 'MyApp', '5c2acfe04bed077117365f1249ffa3645acc8a21cf527c6bb54b33bc70f10c86', '[\"*\"]', NULL, '2024-11-02 01:42:38', '2024-11-02 01:42:38'),
(665, 'App\\Models\\User', 7, 'MyApp', '8bb92e8f6b6467a04098f871670919891dad0ea0cdd35ec0b2beb401edaa9f94', '[\"*\"]', '2024-11-02 01:42:39', '2024-11-02 01:42:38', '2024-11-02 01:42:39'),
(666, 'App\\Models\\User', 7, 'MyApp', 'bb468e8660ddafbb801127ac7853226dcbde973767b0004f96a4ce29bea1ef55', '[\"*\"]', NULL, '2024-11-02 01:42:38', '2024-11-02 01:42:38'),
(667, 'App\\Models\\User', 7, 'MyApp', '4666eb02e35a6abc5c1a3442c9dc4048359fa2abc6f6b63bf99a9d3e87f4e3c8', '[\"*\"]', '2024-11-02 01:42:39', '2024-11-02 01:42:38', '2024-11-02 01:42:39'),
(668, 'App\\Models\\User', 7, 'MyApp', '5b44b7eb172084a458ae054ffbcc561d425d054182ffb16cddc2d45cd8357ca4', '[\"*\"]', NULL, '2024-11-02 01:42:38', '2024-11-02 01:42:38'),
(669, 'App\\Models\\User', 7, 'MyApp', '4c7a1925499dea329065cac184cc598f8302772832d86c7cc0a1779629825ab4', '[\"*\"]', '2024-11-02 01:42:40', '2024-11-02 01:42:38', '2024-11-02 01:42:40'),
(670, 'App\\Models\\User', 7, 'MyApp', 'a816087ab844b6a0148832b2dd47d2d6cb8580eef368aabf33e0ea0973e5a972', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(671, 'App\\Models\\User', 7, 'MyApp', 'ca360e09584236ae51e1fd4b0244e0c9415c7ba6cb65699094bf9749893fef05', '[\"*\"]', '2024-11-02 01:42:40', '2024-11-02 01:42:39', '2024-11-02 01:42:40'),
(672, 'App\\Models\\User', 7, 'MyApp', '1787b3f50bb6a858e823bf1f147a51533e7688283597f9df892308ea447b7de9', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(673, 'App\\Models\\User', 7, 'MyApp', 'dc1c7ee48d02c51d13ce0f6e536eae523731314c434b3952bc666d24b6c1e423', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:39', '2024-11-02 01:42:41'),
(674, 'App\\Models\\User', 7, 'MyApp', 'a14072a2a06385b55b3c284a50f9908113baf176248094a924e94e8abd87ba10', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(675, 'App\\Models\\User', 7, 'MyApp', '9277e6ee0f65c5aa3f47d93f94f7639dec25c2aa3fee381578a8c213b1f1fb49', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(676, 'App\\Models\\User', 7, 'MyApp', '35f9f3cb19031422c6c6fa48151b43c84d34da734ecbaffae4042cf7945265e0', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(677, 'App\\Models\\User', 7, 'MyApp', '1b5013c1f30dd1b6e8f3a9788374c279f92d881398082d438eb193ee0a312a7f', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(678, 'App\\Models\\User', 7, 'MyApp', '1ed36c9091692d2d96c63371e752e76c0848c847557e4c76bda634b653b16ad1', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(679, 'App\\Models\\User', 7, 'MyApp', 'cb65f3bc3fd644d9a3e9b7066698f717884b95b5cd1ecd3a231ab29a10490218', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(680, 'App\\Models\\User', 7, 'MyApp', 'adc4fbefadb904467fa79269890e63dfac019ed84837d441ab27f7c2e8e2f4d2', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(681, 'App\\Models\\User', 7, 'MyApp', 'd34a67fc5a109effea0d5af8dd2e3b673a244723cab4b36946c0cf1201a4160d', '[\"*\"]', NULL, '2024-11-02 01:42:39', '2024-11-02 01:42:39'),
(682, 'App\\Models\\User', 7, 'MyApp', 'ab57a83ba5e9ec2321bc19c519ab47c884a29179ab54e2206ae94e8c5f9ab4e7', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(683, 'App\\Models\\User', 7, 'MyApp', 'cc1d23b1ffd0dec19e4a8c6bf0e1bce5e6a37d49846e4b594413b5659874a41e', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(684, 'App\\Models\\User', 7, 'MyApp', '4cd062aa6e7ead8bce8a7a7c8a388c6497a36cc48882d5b6670ea0e53a5fa6f4', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(685, 'App\\Models\\User', 7, 'MyApp', '6e4d4ece0df3ace97eb1984f534fed2390b0d5fbe17abb98ac2115b70b2c7615', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(686, 'App\\Models\\User', 7, 'MyApp', '12e2f86de3db5e04a6016bf2f2551d95bad179354d46d62cbb27cf9a4488aa7c', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:40', '2024-11-02 01:42:41'),
(687, 'App\\Models\\User', 7, 'MyApp', 'af6b6ec5d89b94581f394e74522cc8fea55022bc1e230762cf79017466130744', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:40', '2024-11-02 01:42:41'),
(688, 'App\\Models\\User', 7, 'MyApp', 'b3d36e10f8e6ec5ddaa7801c14ab6284c4647ad4b68a1387704ceefee683d92c', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(689, 'App\\Models\\User', 7, 'MyApp', 'cc3cc09b41e84883e6d2b729e0720d340d5c2a339ac199143f937a83657c4d36', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(690, 'App\\Models\\User', 7, 'MyApp', '6cb7870e0d197f99db0b512f1117358eff5031c1b5759014b9a5c4902b284f4c', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(691, 'App\\Models\\User', 7, 'MyApp', 'aa1d666c8c32025426416cd19da4d14234abc795e3d7659f95d3a3c3324c7617', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:40', '2024-11-02 01:42:41'),
(692, 'App\\Models\\User', 7, 'MyApp', '2d1aadc51b8afdc5081cc570bdcf88f677276b77b93213570489c372eb330541', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(693, 'App\\Models\\User', 7, 'MyApp', '5faebf5d7f43f6f3d767f7c8148cec484a54d11c8c15172ddb32cd650c3bdb7c', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:40', '2024-11-02 01:42:41'),
(694, 'App\\Models\\User', 7, 'MyApp', 'c8f859684312b5ba38ff5a9ceb2944cf5e9fbaf8a25803510943593bd6d37db5', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(695, 'App\\Models\\User', 7, 'MyApp', '83bbc18f798691c2f02128a58638530e7c3e7dae118fd0ced78351104f9f8507', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(696, 'App\\Models\\User', 7, 'MyApp', '01709fecdd8da815ae6c59fb2e981e8cfe61579fa38900818908164d41883580', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(697, 'App\\Models\\User', 7, 'MyApp', '68ead3c0d05668c3e6641e4c319dac0fefd6ac0419435cce8fefa8510eae48bc', '[\"*\"]', '2024-11-02 01:42:41', '2024-11-02 01:42:40', '2024-11-02 01:42:41'),
(698, 'App\\Models\\User', 7, 'MyApp', '2902247dc6a664932f4b5aca0a58dc56e1c8bb852b06925bc4d33071117f6b83', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(699, 'App\\Models\\User', 7, 'MyApp', '1a86fba73e77c96278a8d33cf2c9cbd58bbf9d50411b5e0a6b0158015d106c7e', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(700, 'App\\Models\\User', 7, 'MyApp', '9c4224491c10233b2d8e1c1b059fc4955071be6b816f4fd980999ec30322701b', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(701, 'App\\Models\\User', 7, 'MyApp', '6358c062506ab1f70903c1415e8106f788d3d5f6a6941bfc0dc1ce416bd769ec', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(702, 'App\\Models\\User', 7, 'MyApp', '0321780a33bef916561d3523985d3a56752a50694e890ffac515682cea5f4231', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(703, 'App\\Models\\User', 7, 'MyApp', 'c2b33f9efd0e1cfee70131be7a1777b5012e622a012b9c17870a9f763b31dd65', '[\"*\"]', '2024-11-02 01:42:42', '2024-11-02 01:42:40', '2024-11-02 01:42:42'),
(704, 'App\\Models\\User', 7, 'MyApp', '4a5f5e9e07123e73740bffc663505219e291cbf66cc610d761b377e5716c4d43', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(705, 'App\\Models\\User', 7, 'MyApp', 'ecd7f0b10a981b546116bb9e6748f35bc6c81bb65ec5f5ade0e4bad037214714', '[\"*\"]', NULL, '2024-11-02 01:42:40', '2024-11-02 01:42:40'),
(706, 'App\\Models\\User', 7, 'MyApp', '1c93e79020e5f69553db56917f0d0bec5314e3126aaf9aaa868fe374079f64ad', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(707, 'App\\Models\\User', 7, 'MyApp', '0b7e758ae0844498bb5f7cf78196c185c43feb488a8a9f9a2ee31d618e10f04e', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(708, 'App\\Models\\User', 7, 'MyApp', 'f03a903352db928208e10ed91cc4987dea42ace63aac76bb0c2953317156282f', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(709, 'App\\Models\\User', 7, 'MyApp', '1813d050cb9d04ce5f398332789ce293171d73e207f8f5b6b9dc28c5047912ba', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(710, 'App\\Models\\User', 7, 'MyApp', 'e3b1a8760e0ed37e541083818b913c33591cdbc4c709f2814de9a4d000d45c7b', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(711, 'App\\Models\\User', 7, 'MyApp', 'c2e99426ff9acbc4a9689b411c25984570dc9f14094da57618278339a2b5cd92', '[\"*\"]', '2024-11-02 01:43:09', '2024-11-02 01:42:41', '2024-11-02 01:43:09'),
(712, 'App\\Models\\User', 7, 'MyApp', 'ab9b5b8916816e8d6b5c789522bc5dd295a4e5de9edde39c9c9509bc20d8e9fc', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(713, 'App\\Models\\User', 7, 'MyApp', '29df6f20abf1d4462f8a7ab28814bce87b2ca2e75244526d6767ce425f23a462', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(714, 'App\\Models\\User', 7, 'MyApp', '7254992f7c18b7637b5c81d2b5a23a2f2826b971a71dc58eb29c67f8f8a8ab67', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(715, 'App\\Models\\User', 7, 'MyApp', 'f3156e2b024be140a41a9a7f7f04940b6a62ad7fe629377c916834e10217ca38', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(716, 'App\\Models\\User', 7, 'MyApp', '5f3a4bf616881b76ea8d1f718a0101fc422c9163a9346cab4b02258d2807fb18', '[\"*\"]', '2024-11-02 01:43:10', '2024-11-02 01:42:41', '2024-11-02 01:43:10'),
(717, 'App\\Models\\User', 7, 'MyApp', 'a0002e103d68c1bd1bf76827504449c0f93794adf58efbb12558418ec2c187bb', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(718, 'App\\Models\\User', 7, 'MyApp', '16f8a4107466b81726d3e2e8217fee38ca8d2627ca29a3f4be2810cb1c01d143', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(719, 'App\\Models\\User', 7, 'MyApp', '724a5463bbd643b0cd66d0973151f8bc6ce79a5e8303acf06e93edc8e905a66f', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(720, 'App\\Models\\User', 7, 'MyApp', 'c4fd19811d0184774e6414860c1f47138197af8ee0ea500a93e72bb72820160d', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(721, 'App\\Models\\User', 7, 'MyApp', 'f249ce3cd0f40a62cd5fa5691508a24771ef5bd257ab04d97a20429d87cd47e9', '[\"*\"]', NULL, '2024-11-02 01:42:41', '2024-11-02 01:42:41'),
(722, 'App\\Models\\User', 7, 'MyApp', '2d5b7149d4498c99981fdb8919a7e854d159c52bc79fa21923542bd8138da34c', '[\"*\"]', '2024-11-02 01:43:48', '2024-11-02 01:43:48', '2024-11-02 01:43:48'),
(723, 'App\\Models\\User', 7, 'MyApp', '3838ab6150fe99d46d637966bf6a35f8524acfceea96c13142303da36f33b99b', '[\"*\"]', '2024-11-02 01:43:49', '2024-11-02 01:43:48', '2024-11-02 01:43:49'),
(724, 'App\\Models\\User', 7, 'MyApp', 'a8f5ca840165453dfbf28e519520e7f28eda8a49b15ab4c7103ede4b5ffe07a4', '[\"*\"]', '2024-11-02 01:43:49', '2024-11-02 01:43:49', '2024-11-02 01:43:49'),
(725, 'App\\Models\\User', 7, 'MyApp', '236d203c9e384833aa2641990c157d71e1929f0c9e5f6420190cfb6b0607c24c', '[\"*\"]', NULL, '2024-11-02 01:43:49', '2024-11-02 01:43:49'),
(726, 'App\\Models\\User', 7, 'MyApp', '0b4380346a8643af0d80c3ca7b559577c85bea0458f3f74cf96500e48330240d', '[\"*\"]', '2024-11-02 01:43:50', '2024-11-02 01:43:49', '2024-11-02 01:43:50'),
(727, 'App\\Models\\User', 7, 'MyApp', '391fb890fc8464b2730401bde2ca54a27e7ee5b110722921437b7c5db396d86c', '[\"*\"]', '2024-11-02 01:43:50', '2024-11-02 01:43:50', '2024-11-02 01:43:50'),
(728, 'App\\Models\\User', 7, 'MyApp', '10a9d8ce01af913bc74c9ccefe3be5c036342fe5cd215954ef94ae205216f717', '[\"*\"]', NULL, '2024-11-02 01:43:50', '2024-11-02 01:43:50'),
(729, 'App\\Models\\User', 7, 'MyApp', '6560a7dc94c20af5052841dbaa6a9c0542f592eb9c30fcef288820d693d5c229', '[\"*\"]', NULL, '2024-11-02 01:43:50', '2024-11-02 01:43:50'),
(730, 'App\\Models\\User', 7, 'MyApp', '165914d562e4e3fbf856b4875774782980e55387b4f5b60bf19ec395fdb875bc', '[\"*\"]', NULL, '2024-11-02 01:43:50', '2024-11-02 01:43:50'),
(731, 'App\\Models\\User', 7, 'MyApp', '94a54aaec41ba1edcc9f9a2d1e6eeb4231bd72bc8e3141a7718853c5e6aa942b', '[\"*\"]', '2024-11-02 01:43:51', '2024-11-02 01:43:50', '2024-11-02 01:43:51'),
(732, 'App\\Models\\User', 7, 'MyApp', 'b17c583a7bac9b25def75fe06d6d3aaf4aa4fe0aa59ae567237644778d2e229e', '[\"*\"]', '2024-11-02 01:43:51', '2024-11-02 01:43:51', '2024-11-02 01:43:51'),
(733, 'App\\Models\\User', 7, 'MyApp', '9c278c212fe9e2072985ec546ba39d08330fc03a985861c1ca79ae05d7b90263', '[\"*\"]', NULL, '2024-11-02 01:43:51', '2024-11-02 01:43:51'),
(734, 'App\\Models\\User', 7, 'MyApp', '931e30e02c8fe4405d779a812385ce71b59d1fe3979a0c54bf8089cb3eba3bf4', '[\"*\"]', '2024-11-02 01:43:52', '2024-11-02 01:43:51', '2024-11-02 01:43:52'),
(735, 'App\\Models\\User', 7, 'MyApp', '8be5041397c087cc197133b36fcb1b2607dad196ae566483f30c70e2c5d1401f', '[\"*\"]', NULL, '2024-11-02 01:43:51', '2024-11-02 01:43:51'),
(736, 'App\\Models\\User', 7, 'MyApp', 'd51a77c216e09a80ff6bdfa6a0ec22c6960f1bdba6bd19d5d00e1cac5b66f944', '[\"*\"]', NULL, '2024-11-02 01:43:51', '2024-11-02 01:43:51'),
(737, 'App\\Models\\User', 7, 'MyApp', '2c25de9267ee55bea1ad761114cc4bf6be5a1aed5a952f962844bc70c0203baf', '[\"*\"]', '2024-11-02 01:43:52', '2024-11-02 01:43:51', '2024-11-02 01:43:52'),
(738, 'App\\Models\\User', 7, 'MyApp', '988a2d6b8b17abfb8889a91581afbcef3c07d68cc4f42b73d28da34f4d3814be', '[\"*\"]', '2024-11-02 01:43:52', '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(739, 'App\\Models\\User', 7, 'MyApp', '5b09b275dd423074d109dd76a42e7875c5d3a4735d5dd40b5d0dd745cabaeb6b', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(740, 'App\\Models\\User', 7, 'MyApp', '037d9d805c0b1d0c90ac3da082e60bd47a1fc679f03f76dc48c0ad9bd10939e3', '[\"*\"]', '2024-11-02 01:43:53', '2024-11-02 01:43:52', '2024-11-02 01:43:53'),
(741, 'App\\Models\\User', 7, 'MyApp', '6c4e6651014b65c1054641182e9b704e5f69be796770e405c59974a3df356abb', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(742, 'App\\Models\\User', 7, 'MyApp', 'ffc31444f9c4aba5a697906039099cb5562f2293ee760c3cf0591b73e7d75fd2', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(743, 'App\\Models\\User', 7, 'MyApp', '0f9b249f5a311c4a046dd88e8de4a70ed7f65d41ac44ab8844fa559f635781d4', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(744, 'App\\Models\\User', 7, 'MyApp', 'f72ced7e63f98f091411b20937d29c147e3d4caaeb16aa9e28887c47d5e07414', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(745, 'App\\Models\\User', 7, 'MyApp', '360ac10e75a8197562c829a86b20bf2d797438df44e307580498a78034e483b0', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(746, 'App\\Models\\User', 7, 'MyApp', '3303d1d2eda922b302fe41f718b93ad527275604b32592263680c9ef0373d0fb', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(747, 'App\\Models\\User', 7, 'MyApp', '49be9ed2c1bd5f0eaab699ff7123366a43b9ca5a21f3ae61c3144a6e616f0fcd', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(748, 'App\\Models\\User', 7, 'MyApp', 'cdb7aafb3ca0bcaf3b21472deed156e18c2f1b921298ab6c1ce75d7c8aad4b26', '[\"*\"]', '2024-11-02 01:43:54', '2024-11-02 01:43:52', '2024-11-02 01:43:54'),
(749, 'App\\Models\\User', 7, 'MyApp', 'f5094d8ef50a0bc53d3655cc77d60316989666fc854ee8395a11f33c97f4071b', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(750, 'App\\Models\\User', 7, 'MyApp', '3f2f6d69f7bafd12e6dcd506be6250f0f2c7b3c84b2133ff22f4acf6572ea65d', '[\"*\"]', NULL, '2024-11-02 01:43:52', '2024-11-02 01:43:52'),
(751, 'App\\Models\\User', 7, 'MyApp', '43b269597110f24d30fb35aee1c389ae5b2fbd35e0d59b3f127007ac8104516a', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(752, 'App\\Models\\User', 7, 'MyApp', 'c61ba5e8adfdd3e4d41f306f0370f0601698811bbdf9f732b10084a3c5aa0534', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(753, 'App\\Models\\User', 7, 'MyApp', '3a1ec63449c0c20ab4881144b485db3d84c484f0e38bf952f9c09cbda8fc1be1', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(754, 'App\\Models\\User', 7, 'MyApp', '5d304ac7ce16499b63d175b621ed7606a6a03285f806983c8ef0cd067a55aca2', '[\"*\"]', '2024-11-02 01:43:55', '2024-11-02 01:43:53', '2024-11-02 01:43:55'),
(755, 'App\\Models\\User', 7, 'MyApp', 'f48bfe3553d9b1cd21ed7a8c83278529d7c14952c8b124d6a9391e3cb93f5571', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(756, 'App\\Models\\User', 7, 'MyApp', 'c7b114467d2f55b53e07cafafe3b3021e1b1aa5c659453c503b0e0e375f22694', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(757, 'App\\Models\\User', 7, 'MyApp', 'fc3e63478ffb9c2eb7ca1f2ddf12b63c8c824c667774309c8eb364e28bd3a843', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(758, 'App\\Models\\User', 7, 'MyApp', '885c658891b283d375c6656e2c64c9cf343205cd9afb1a8ff22f6ee2931b6756', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(759, 'App\\Models\\User', 7, 'MyApp', 'f3828e206dab5da18e6fbb531438bb2389ea8f2ed7b391dfb89556429edef198', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(760, 'App\\Models\\User', 7, 'MyApp', '96a4cfb79f68fa6848da21624f8b96871d7f5707baaed8bb93eeb1c597042599', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(761, 'App\\Models\\User', 7, 'MyApp', '6309328455f4ae0ce78043208d5bb64a33ab5adfc5d81f441841c721c433cb90', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(762, 'App\\Models\\User', 7, 'MyApp', 'a5cf59b3f58f6276b062568b581a883530a1036792af288913159e6264957208', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(763, 'App\\Models\\User', 7, 'MyApp', 'aaaa88041383eb691d5e573f867d0756c4317ead1e9c16a2b0a1556fba2a9061', '[\"*\"]', '2024-11-02 01:43:55', '2024-11-02 01:43:53', '2024-11-02 01:43:55'),
(764, 'App\\Models\\User', 7, 'MyApp', '15c2a04a192d46cbbc9b3655d7f2334b39c8195c84958ee597d924185956beab', '[\"*\"]', NULL, '2024-11-02 01:43:53', '2024-11-02 01:43:53'),
(765, 'App\\Models\\User', 7, 'MyApp', '3ed35974f775b217786bcb368c12d648ace54b6e0ef14737145a34edd21d9bd0', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(766, 'App\\Models\\User', 7, 'MyApp', 'e5c205bf030f1f6743b85848852a1212126633f877c07fd3124a2c4c2a21bfa3', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(767, 'App\\Models\\User', 7, 'MyApp', 'ac2fdae237bfc74e926ae883258c4470b2464ddea933800d1b7016c255d79488', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(768, 'App\\Models\\User', 7, 'MyApp', '1eca4c81f93ba514022dae9a101385b7cdd89ca4cd50cf70c183d63463e84486', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(769, 'App\\Models\\User', 7, 'MyApp', '2051207f1fd91531939b7f331bde25af12975a6f983424609f20cf1e6858409e', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(770, 'App\\Models\\User', 7, 'MyApp', '0c78afe251792640576ff9b52066ec4f8488987fd6d596beeb97b0c9da2cb172', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(771, 'App\\Models\\User', 7, 'MyApp', '6068ecedd3f661c52dd8bd5e062f97640919a9cf37bb176b8edb637bad154782', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(772, 'App\\Models\\User', 7, 'MyApp', '544de68fe3f981af5de456746c3c4cd2e353e5a97ac6fb570d88684fb9fd1d1d', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(773, 'App\\Models\\User', 7, 'MyApp', 'e4a2faeabd695f0dedee574e22ddf0c73164bd4b8550bfa8626662f41214b377', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(774, 'App\\Models\\User', 7, 'MyApp', '3834f229c89b54e5708ff2a13e82a4ad531da5a2f90f8cedc222706d9d8cfbbc', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(775, 'App\\Models\\User', 7, 'MyApp', 'dcf35caeb71a10a998263eaf7865fee3a2a8ca289fc78ad3bfc4413a89da3c41', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(776, 'App\\Models\\User', 7, 'MyApp', '57fac420a3918bbeb6f1fd4b4f6896915eff92b3e3dfb5d1c590fe30b734c1b3', '[\"*\"]', '2024-11-02 01:43:56', '2024-11-02 01:43:54', '2024-11-02 01:43:56'),
(777, 'App\\Models\\User', 7, 'MyApp', '8e5a1b7cad9a876acb90f22edfe7ad6e681297f5951e937b2e38e4ffd033858f', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(778, 'App\\Models\\User', 7, 'MyApp', '78eb623c84a7b7d981246d526662c83440b8efabe2bc3a0fbc2a0e03ef140f32', '[\"*\"]', NULL, '2024-11-02 01:43:54', '2024-11-02 01:43:54'),
(779, 'App\\Models\\User', 7, 'MyApp', 'c56a508108ac04330aa8dd36c1642900553ba9fa57c7d45b2b2993d56f7a80d0', '[\"*\"]', '2024-11-02 01:44:14', '2024-11-02 01:43:54', '2024-11-02 01:44:14'),
(780, 'App\\Models\\User', 7, 'MyApp', '6b29b967fefa8761fef8d46169b0f8e617ca1756c68d8ca0321e1208e83d32a7', '[\"*\"]', '2024-11-02 01:44:55', '2024-11-02 01:44:54', '2024-11-02 01:44:55'),
(781, 'App\\Models\\User', 7, 'MyApp', '2f792dd0e2eb4ec9e94ea0155291259d08667455f32dca2907df57b2d17a993d', '[\"*\"]', '2024-11-02 01:44:55', '2024-11-02 01:44:55', '2024-11-02 01:44:55'),
(782, 'App\\Models\\User', 7, 'MyApp', '7d5f463c8f2b7a0cb91bb0638aa1fcecbc4c74175b1a18c32e403102e633039c', '[\"*\"]', '2024-11-02 01:44:57', '2024-11-02 01:44:56', '2024-11-02 01:44:57'),
(783, 'App\\Models\\User', 7, 'MyApp', '4deb0eadd5a39d2f4a18c8262a22fcb3dc9c2c13141f671ea23eae08dfe595b4', '[\"*\"]', NULL, '2024-11-02 01:44:57', '2024-11-02 01:44:57'),
(784, 'App\\Models\\User', 7, 'MyApp', 'ee12fb2831d6d4e1e7b8d5b662608cb375322cbdc5c3f299ab34ea75659c708d', '[\"*\"]', '2024-11-02 01:44:58', '2024-11-02 01:44:57', '2024-11-02 01:44:58'),
(785, 'App\\Models\\User', 7, 'MyApp', '6ee5f866712c2119fb6431a6904cfb49d030c868e6242601435475bbe1aa6d60', '[\"*\"]', '2024-11-02 01:44:58', '2024-11-02 01:44:58', '2024-11-02 01:44:58'),
(786, 'App\\Models\\User', 7, 'MyApp', 'b4e8356fe966c33e14b42717662b1a1f6975fa501d72e21bec029647b195e177', '[\"*\"]', '2024-11-02 01:44:59', '2024-11-02 01:44:58', '2024-11-02 01:44:59'),
(787, 'App\\Models\\User', 7, 'MyApp', '5ae86d4e4216807c229a3ec120db01030c0271a07dc894ac94007cc0dfea2cf1', '[\"*\"]', NULL, '2024-11-02 01:44:58', '2024-11-02 01:44:58'),
(788, 'App\\Models\\User', 7, 'MyApp', '228431f48d44436590cda40ee55ef5228b9e1c147101285e8b6dab96f9d9ef79', '[\"*\"]', '2024-11-02 01:45:00', '2024-11-02 01:44:59', '2024-11-02 01:45:00'),
(789, 'App\\Models\\User', 7, 'MyApp', '14d5593c82ea1df8d432d6119d67627aa613c5c64fc759d2534b743f2a4a98e7', '[\"*\"]', NULL, '2024-11-02 01:44:59', '2024-11-02 01:44:59'),
(790, 'App\\Models\\User', 7, 'MyApp', '9ffd69cb2c9070be521ed7897594ffeb33977054cbce015b47885660155353d0', '[\"*\"]', '2024-11-02 01:45:00', '2024-11-02 01:44:59', '2024-11-02 01:45:00'),
(791, 'App\\Models\\User', 7, 'MyApp', '93d4c0f03e49d217758c2cda46e5e2b9202e1cf9dfdaacb237836c46f2b152ce', '[\"*\"]', '2024-11-02 01:45:01', '2024-11-02 01:45:00', '2024-11-02 01:45:01'),
(792, 'App\\Models\\User', 7, 'MyApp', '6d629ed40bab34d74cd9bc07812e948cc0ddb23c5d819966fd5da32f1259be25', '[\"*\"]', NULL, '2024-11-02 01:45:01', '2024-11-02 01:45:01'),
(793, 'App\\Models\\User', 7, 'MyApp', '587bd8a6aae95fc246107497638ef4444de903dfa1ec2be1cb9e7e40972a0e24', '[\"*\"]', '2024-11-02 01:45:02', '2024-11-02 01:45:01', '2024-11-02 01:45:02'),
(794, 'App\\Models\\User', 7, 'MyApp', '61c78f294489cfe596acb878476f5d29286bd52369f6619d3935f50809b57e34', '[\"*\"]', '2024-11-02 01:45:02', '2024-11-02 01:45:02', '2024-11-02 01:45:02'),
(795, 'App\\Models\\User', 7, 'MyApp', '83e821f28b12a04c728c08dcbd3f9261736419f29b4e5d379364c8db154a22cd', '[\"*\"]', '2024-11-02 01:45:03', '2024-11-02 01:45:02', '2024-11-02 01:45:03'),
(796, 'App\\Models\\User', 7, 'MyApp', 'b878539ef943db2a8ef33bdd44d422f317af47876658138a29ba86261d2c2b1b', '[\"*\"]', NULL, '2024-11-02 01:45:02', '2024-11-02 01:45:02'),
(797, 'App\\Models\\User', 7, 'MyApp', '760b1726343db8575396f48d96634a90e07b019b5c1b5eec7518a8f32b33a8ba', '[\"*\"]', '2024-11-02 01:45:03', '2024-11-02 01:45:02', '2024-11-02 01:45:03'),
(798, 'App\\Models\\User', 7, 'MyApp', '884660c1598091f45dc6c02c34dd4d3c92597fe2591eacdce064b9f09f38b58b', '[\"*\"]', '2024-11-02 01:45:03', '2024-11-02 01:45:02', '2024-11-02 01:45:03'),
(799, 'App\\Models\\User', 7, 'MyApp', '6e673da095f4a9094482da00e16905dd8a539ed8309043c85a7c2e699bb2f8f0', '[\"*\"]', NULL, '2024-11-02 01:45:02', '2024-11-02 01:45:02'),
(800, 'App\\Models\\User', 7, 'MyApp', '506e4081445d2e2d32a9850e99c3ee3c7bf574f088e4d7ca06583f5e460402fb', '[\"*\"]', '2024-11-02 01:45:03', '2024-11-02 01:45:02', '2024-11-02 01:45:03'),
(801, 'App\\Models\\User', 7, 'MyApp', '0c7e23196620527a2db78e3c98a42be385037576e69c3e130e229d0d7bcb25c1', '[\"*\"]', NULL, '2024-11-02 01:45:03', '2024-11-02 01:45:03'),
(802, 'App\\Models\\User', 7, 'MyApp', '1eb7854f2c5a0943b2110a0a7c29f9f8a1292a9eb5867695cd2f38bbc8e26f7f', '[\"*\"]', '2024-11-02 01:45:04', '2024-11-02 01:45:03', '2024-11-02 01:45:04'),
(803, 'App\\Models\\User', 7, 'MyApp', 'c7ff24d514ef0b07e94ae97ad671aba9729cf29c1a13978de5a3853590cb3f09', '[\"*\"]', '2024-11-02 01:45:04', '2024-11-02 01:45:03', '2024-11-02 01:45:04'),
(804, 'App\\Models\\User', 7, 'MyApp', '9ba80c43f33320591f916ffdf87fbbe19515c7a75f0f342c6735da3dae312cd9', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(805, 'App\\Models\\User', 7, 'MyApp', '1f37db93069bc301baa803998fe547dcb34a2cf5bbe7f9f8caa842a400bc0d2c', '[\"*\"]', '2024-11-02 01:45:04', '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(806, 'App\\Models\\User', 7, 'MyApp', '2a177bca78b7b7efbe0b30200842c54b6d60564749e3265e69d549378ecdd927', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(807, 'App\\Models\\User', 7, 'MyApp', '3ce633b7c1da132830718d12efe6c6cbb581cf220c0c65c26745a6dd83bce4cb', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(808, 'App\\Models\\User', 7, 'MyApp', '2ab9e751271f37b4d983fc2e2406d0d9de61cacbde9438c618205ad40f1da6b7', '[\"*\"]', '2024-11-02 01:45:04', '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(809, 'App\\Models\\User', 7, 'MyApp', '9c21b75e34db30a42ce368543a19753bb1bee5f590cbc972a155ba543ca94b16', '[\"*\"]', '2024-11-02 01:45:04', '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(810, 'App\\Models\\User', 7, 'MyApp', '93e389f9168f4c6627c9bd537af0e32441cf4cad949e8785d4c0323244673bb1', '[\"*\"]', '2024-11-02 01:45:06', '2024-11-02 01:45:04', '2024-11-02 01:45:06'),
(811, 'App\\Models\\User', 7, 'MyApp', '4b1aa1f397e2f6c13512c9bc8f010ca6ecb636bd226cc205c80b7060cd1219c7', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(812, 'App\\Models\\User', 7, 'MyApp', '6c47c1e27b10a7f28c51124195d02832352893b52975714b1f6bc0182cc12441', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(813, 'App\\Models\\User', 7, 'MyApp', 'a725eb34120d7474446e20c07ff2de84592347d0c75d6569af1e97e28ac1249e', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(814, 'App\\Models\\User', 7, 'MyApp', 'e4785d38c6b302f5a275dab668d9d012ee6c4fb60bcf64f6cc0d50c4d9ec80a7', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(815, 'App\\Models\\User', 7, 'MyApp', '89b59677e4823943006306079f5d0e5f75179becbba73333daf4eb85e9443d68', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(816, 'App\\Models\\User', 7, 'MyApp', '99d0328a25bcf7d295dda31be5fb8d103858adc812b15199931a669a8066a73a', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(817, 'App\\Models\\User', 7, 'MyApp', '87d82f14fee2b972c59585a338fd20702143fdcf6a7b9863a4856a09127882ec', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(818, 'App\\Models\\User', 7, 'MyApp', '45ddc4e67f0de392459479db8038834e5ccf1c17c076179a19de9779f7616450', '[\"*\"]', NULL, '2024-11-02 01:45:04', '2024-11-02 01:45:04'),
(819, 'App\\Models\\User', 7, 'MyApp', 'ff716a58d211da9e189717d320fa95d001f9c2610928607e3b5ea07056c00b08', '[\"*\"]', NULL, '2024-11-02 01:45:05', '2024-11-02 01:45:05'),
(820, 'App\\Models\\User', 7, 'MyApp', '13a0a570b0d3daf9caff9a53b3c1c86b8acebfa0d2f0d293ccf62b58461bad8e', '[\"*\"]', '2024-11-02 01:45:07', '2024-11-02 01:45:05', '2024-11-02 01:45:07'),
(821, 'App\\Models\\User', 7, 'MyApp', 'd77755e584ad05a237e4db54cf45161f76adbacfb8899c46a0d3d2eda784cd31', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(822, 'App\\Models\\User', 7, 'MyApp', 'da54bef15b4168b456031e8df53554ca272eed53978172f01508b174d03a4530', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(823, 'App\\Models\\User', 7, 'MyApp', 'c12934c31edd3ac5fdb24750221bfb012635f70ee3960681ec22c8cbaaf7b235', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(824, 'App\\Models\\User', 7, 'MyApp', '2598b1bfb6979a6310916ec46d1a2a896b510f216c306d90e86625bae6cc87b8', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(825, 'App\\Models\\User', 7, 'MyApp', '6caf43da35dae18b113a23e2e60aff9fdea3df31310a697ba6a5a7407a8e4ed6', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(826, 'App\\Models\\User', 7, 'MyApp', 'a1746f6c11eb5981ab9820b57132b3f425f7622f77db922201635b090f9acff6', '[\"*\"]', '2024-11-02 01:45:07', '2024-11-02 01:45:06', '2024-11-02 01:45:07'),
(827, 'App\\Models\\User', 7, 'MyApp', '61815b0d896abe42dbf766a9692350800e5c43c86017e251fce649de087c0676', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(828, 'App\\Models\\User', 7, 'MyApp', '23ce4887f5ecb53481e66e481cd01d94b4cd7f92181f8b0f489f95c055f930f2', '[\"*\"]', '2024-11-02 01:45:07', '2024-11-02 01:45:06', '2024-11-02 01:45:07'),
(829, 'App\\Models\\User', 7, 'MyApp', '65e449fcf15ffe35d6313dae04d1b11d75294febeec8975dfe70ad9c5913368f', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(830, 'App\\Models\\User', 7, 'MyApp', 'b4359e675dea6839e6e443f218f45de153815da50c682ce52b7f3446b556052e', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(831, 'App\\Models\\User', 7, 'MyApp', '30fadf25f02e24220300384a45366e114028f3fd313e2820006d48217fc27371', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(832, 'App\\Models\\User', 7, 'MyApp', '291dadad512c477e9a92230711ebe005c7f1d3e3c7b6d1c37af1eff1da6027ca', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(833, 'App\\Models\\User', 7, 'MyApp', '6a2b9f20faed9796b9dd8885cd0784e8c4daef688c4b2ca23d2e7536fa5d7280', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(834, 'App\\Models\\User', 7, 'MyApp', '9de3da679d916192ce4581aa3edbfecd060b621df8f92f13551f383080922e66', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(835, 'App\\Models\\User', 7, 'MyApp', '36d0abb6bae80c153e10d8cff3f96e8984df5793102a608326390701176c94c8', '[\"*\"]', NULL, '2024-11-02 01:45:06', '2024-11-02 01:45:06'),
(836, 'App\\Models\\User', 7, 'MyApp', '8e7099f479c5f62ffdcf4e8a78dd83bac98ed3fc2ab224af886c6b192da84e8c', '[\"*\"]', '2024-11-02 01:45:07', '2024-11-02 01:45:06', '2024-11-02 01:45:07'),
(837, 'App\\Models\\User', 7, 'MyApp', '8ec66b0a8a15eea4e4b37d49b473f53f818ad00bb6c1d497831e53ee8d368ca6', '[\"*\"]', NULL, '2024-11-02 01:45:07', '2024-11-02 01:45:07'),
(838, 'App\\Models\\User', 7, 'MyApp', 'd9b8cb02c9d5c64b75ffb1da3e051565ab45830ddc951f58c20ae263c4818d1e', '[\"*\"]', NULL, '2024-11-02 01:45:07', '2024-11-02 01:45:07'),
(839, 'App\\Models\\User', 7, 'MyApp', '2262efa5bb6ee4a80d06168e5035200196e0d5b7bf33756b12cba1d9f144087c', '[\"*\"]', NULL, '2024-11-02 01:45:07', '2024-11-02 01:45:07'),
(840, 'App\\Models\\User', 7, 'MyApp', '72fcb296c5299c1438de7a18069edc2794f6f601c4a10baafede624cec0dc2fb', '[\"*\"]', '2024-11-02 01:45:31', '2024-11-02 01:45:07', '2024-11-02 01:45:31'),
(841, 'App\\Models\\User', 7, 'MyApp', 'dda029c5f81f963d6c79a50374fd464db05afb6d83fd060c4ce6a294b022980c', '[\"*\"]', '2024-11-02 01:47:08', '2024-11-02 01:46:18', '2024-11-02 01:47:08'),
(842, 'App\\Models\\User', 7, 'MyApp', '2301f1c02c1605d997917334e35307e8fcd9b9ba9bcd78a93eec8e161b386bf4', '[\"*\"]', '2024-11-02 01:47:08', '2024-11-02 01:46:22', '2024-11-02 01:47:08'),
(843, 'App\\Models\\User', 7, 'MyApp', 'e0f21567a048eed48a58251aa35e92a8d23f11590c4a235f264cb7be1b39d592', '[\"*\"]', '2024-11-02 01:50:42', '2024-11-02 01:50:27', '2024-11-02 01:50:42'),
(844, 'App\\Models\\User', 7, 'MyApp', '7b64ceb6653267af5802b9d821594c0f648d0286c85a97d1c4a1dab034f49181', '[\"*\"]', NULL, '2024-11-02 01:50:27', '2024-11-02 01:50:27'),
(845, 'App\\Models\\User', 7, 'MyApp', 'dae57a4b1cb6225c2851dec1b55b9d9e9c52b8a533ac96fe41501b1bdb8eff7b', '[\"*\"]', NULL, '2024-11-02 01:51:03', '2024-11-02 01:51:03'),
(846, 'App\\Models\\User', 7, 'MyApp', '710f4c171d90e21ac1bdc3e5d36a369282e80e66ccf8400370d05e19dad47c26', '[\"*\"]', NULL, '2024-11-02 01:51:03', '2024-11-02 01:51:03'),
(847, 'App\\Models\\User', 7, 'MyApp', 'b5f2ebced15c92b27cff33ea0bb242a0dae822fa1764af2a9d2af820764d5ec1', '[\"*\"]', NULL, '2024-11-02 01:51:29', '2024-11-02 01:51:29'),
(848, 'App\\Models\\User', 7, 'MyApp', '8d900eec03418911d1f1fea2871aa4746614a31966e6f83c142d35adea13519f', '[\"*\"]', NULL, '2024-11-02 01:51:29', '2024-11-02 01:51:29'),
(849, 'App\\Models\\User', 7, 'MyApp', '5bff7326a72b61d957b6d6ae449ef887e08c1c7cfa96ce2e8082b0a34a3c3f21', '[\"*\"]', '2024-11-02 01:52:09', '2024-11-02 01:52:05', '2024-11-02 01:52:09'),
(850, 'App\\Models\\User', 7, 'MyApp', 'f60560e8b0a5a8457bb88f123be63c8e1fa8a9690e1072d127932069b2f996ed', '[\"*\"]', '2024-11-02 01:52:09', '2024-11-02 01:52:06', '2024-11-02 01:52:09'),
(851, 'App\\Models\\User', 7, 'MyApp', 'e3bb58cb6089cf391728b81829181c000062a10f9f335bacd9d8470dee3b26ec', '[\"*\"]', '2024-11-02 01:52:11', '2024-11-02 01:52:10', '2024-11-02 01:52:11'),
(852, 'App\\Models\\User', 7, 'MyApp', 'c9e2dc3e17e2c42bc150603ed655ef0484a1e6690890504c3279b66a27c1f16b', '[\"*\"]', NULL, '2024-11-02 01:52:10', '2024-11-02 01:52:10'),
(853, 'App\\Models\\User', 7, 'MyApp', '94453843b3b3e792e5a20a0d7c20818d268fd1cf0a56adfc7a67c9a93f5141bd', '[\"*\"]', '2024-11-02 01:52:14', '2024-11-02 01:52:12', '2024-11-02 01:52:14'),
(854, 'App\\Models\\User', 7, 'MyApp', '957b785b1ab1adba1b42af91d6cbeb85d86128033ac344a36f569953bcb36f0c', '[\"*\"]', '2024-11-02 01:52:14', '2024-11-02 01:52:12', '2024-11-02 01:52:14'),
(855, 'App\\Models\\User', 7, 'MyApp', '03a7b44c00dec78a6a05df296fdd4c14a24f986242884411191b87c0ad2565db', '[\"*\"]', '2024-11-02 01:52:16', '2024-11-02 01:52:15', '2024-11-02 01:52:16'),
(856, 'App\\Models\\User', 7, 'MyApp', '27cf147a55d500dba112f92132e315ecac799411ef950ac6f142334db3b19947', '[\"*\"]', NULL, '2024-11-02 01:52:15', '2024-11-02 01:52:15'),
(857, 'App\\Models\\User', 7, 'MyApp', '666f4255c523be4fc59b643c6fb5bcd3311a7432e8b213c99305b77d1f321a95', '[\"*\"]', '2024-11-02 01:52:18', '2024-11-02 01:52:16', '2024-11-02 01:52:18'),
(858, 'App\\Models\\User', 7, 'MyApp', '4baf6e54c8f32823528917600788efcbb1837e595988009eb67b03c69ccaa3b0', '[\"*\"]', '2024-11-02 01:52:19', '2024-11-02 01:52:19', '2024-11-02 01:52:19'),
(859, 'App\\Models\\User', 7, 'MyApp', 'a409bb69acc2a08037760c88ca92a1950691f08c96ba89d59cbfd1dc5f8b672a', '[\"*\"]', NULL, '2024-11-02 01:52:19', '2024-11-02 01:52:19'),
(860, 'App\\Models\\User', 7, 'MyApp', '9943a1f969f50018a211828c7d4a7a25031f0d42d0c8abd24ed502d86d4fca10', '[\"*\"]', '2024-11-02 01:52:21', '2024-11-02 01:52:20', '2024-11-02 01:52:21'),
(861, 'App\\Models\\User', 7, 'MyApp', '1842eec731052b31585594b0e13d292185dcfb372626d23b6e2553ec52092765', '[\"*\"]', '2024-11-02 01:52:26', '2024-11-02 01:52:23', '2024-11-02 01:52:26'),
(862, 'App\\Models\\User', 7, 'MyApp', '52c80ed36c655413f6930e5689f875175fe5f85a98290257fbd5706237dacfff', '[\"*\"]', '2024-11-02 01:52:26', '2024-11-02 01:52:23', '2024-11-02 01:52:26'),
(863, 'App\\Models\\User', 7, 'MyApp', '2474683c85ccba1e3179fcea4be90dcf7b28fbc74e8344c3ddd4c5fe0b1dbf74', '[\"*\"]', '2024-11-02 01:52:27', '2024-11-02 01:52:26', '2024-11-02 01:52:27'),
(864, 'App\\Models\\User', 7, 'MyApp', 'b16b0737fbf66b8fa197ea9c218867eca30bcb449acc8c8dedc8c049bfdbc015', '[\"*\"]', '2024-11-02 01:52:28', '2024-11-02 01:52:28', '2024-11-02 01:52:28'),
(865, 'App\\Models\\User', 7, 'MyApp', 'dd403d4132683184181a1e9196a2ce934abf3a47abc4232e9a94bc0891b0931a', '[\"*\"]', NULL, '2024-11-02 01:52:28', '2024-11-02 01:52:28'),
(866, 'App\\Models\\User', 7, 'MyApp', 'd956a7430a0febc453b7ba356c3117de8be18be2fcad701bc40594a785aa6f80', '[\"*\"]', '2024-11-02 01:52:30', '2024-11-02 01:52:28', '2024-11-02 01:52:30'),
(867, 'App\\Models\\User', 7, 'MyApp', 'd0e9df247eb1abd484129142782cfc66ae6da940ecfd07c0279b234ee5ae0f15', '[\"*\"]', '2024-11-02 01:52:30', '2024-11-02 01:52:30', '2024-11-02 01:52:30'),
(868, 'App\\Models\\User', 7, 'MyApp', 'b770e9508278d083fd3b6f6e1a567af1566773264846b2599cd8de42ed2729e0', '[\"*\"]', NULL, '2024-11-02 01:52:30', '2024-11-02 01:52:30'),
(869, 'App\\Models\\User', 7, 'MyApp', 'e777de35c0d59d7994b913786a4293bf29650dca650912f836b4bf8a69765fdc', '[\"*\"]', '2024-11-02 01:52:31', '2024-11-02 01:52:30', '2024-11-02 01:52:31'),
(870, 'App\\Models\\User', 7, 'MyApp', '24e60a782e96afa7ff7ea191d3f345f56a70eb7ce973da1385fdb006b5ece216', '[\"*\"]', '2024-11-02 01:52:31', '2024-11-02 01:52:31', '2024-11-02 01:52:31'),
(871, 'App\\Models\\User', 7, 'MyApp', '8e4063cb049226aacc0768b3aa078fa607b754db7fe0276e6bf35e8c0e440a95', '[\"*\"]', '2024-11-02 01:52:31', '2024-11-02 01:52:31', '2024-11-02 01:52:31'),
(872, 'App\\Models\\User', 7, 'MyApp', 'cfbe624de7dd139d1d96403579df1a78346c34f07a499a5ef9efd6ed4ab25c25', '[\"*\"]', NULL, '2024-11-02 01:52:31', '2024-11-02 01:52:31'),
(873, 'App\\Models\\User', 7, 'MyApp', 'b664f0f36cdd324a92d10430ddd89ef8627d91b305c19dbc402ac98fbd776567', '[\"*\"]', NULL, '2024-11-02 01:52:31', '2024-11-02 01:52:31'),
(874, 'App\\Models\\User', 7, 'MyApp', '7052a2d132a6c4c8b45856b845c966d00cd6505c03f10c2518fb5b52a06eda55', '[\"*\"]', '2024-11-02 01:52:32', '2024-11-02 01:52:31', '2024-11-02 01:52:32'),
(875, 'App\\Models\\User', 7, 'MyApp', '5a62a77f6cbd0da3f95642fc1ad9d7b706887f1bc8d72f7800fe32254b40b000', '[\"*\"]', '2024-11-02 01:52:32', '2024-11-02 01:52:31', '2024-11-02 01:52:32'),
(876, 'App\\Models\\User', 7, 'MyApp', 'd421f66bc87c005b71aace59cb1e216b0e8799cdd90b66f7baa2817df33c5e7b', '[\"*\"]', NULL, '2024-11-02 01:52:32', '2024-11-02 01:52:32'),
(877, 'App\\Models\\User', 7, 'MyApp', '6136d5a823ea3a880dc75fee3a9c47c88b7e855b7295a935a80469b71579754e', '[\"*\"]', NULL, '2024-11-02 01:52:32', '2024-11-02 01:52:32'),
(878, 'App\\Models\\User', 7, 'MyApp', '7735f3a9645f09b6e14d2764eed57ce1cf21317d8af2e230e25ce17113ebb136', '[\"*\"]', '2024-11-02 01:52:32', '2024-11-02 01:52:32', '2024-11-02 01:52:32'),
(879, 'App\\Models\\User', 7, 'MyApp', '126c5a7240066d5c13e091cf7052d1b58e98b83386f3fe8eaadce40f94015ce4', '[\"*\"]', NULL, '2024-11-02 01:52:33', '2024-11-02 01:52:33'),
(880, 'App\\Models\\User', 7, 'MyApp', 'f0108a31c04cbea0e8b80a01cda73758d884b50656a4e99c841ac4409efb304d', '[\"*\"]', NULL, '2024-11-02 01:52:33', '2024-11-02 01:52:33'),
(881, 'App\\Models\\User', 7, 'MyApp', 'a232a83df1cc6b0f7b6de4783578278c06ea7547f3baec7ab98e937a0274a24b', '[\"*\"]', NULL, '2024-11-02 01:52:33', '2024-11-02 01:52:33'),
(882, 'App\\Models\\User', 7, 'MyApp', 'b3a6cd05d90bc704d93a3a96bd9c5f37065e8ba1f07f8784fcb9548f88705812', '[\"*\"]', NULL, '2024-11-02 01:52:33', '2024-11-02 01:52:33'),
(883, 'App\\Models\\User', 7, 'MyApp', 'e46c347f42261f8f33f3af455b0002e3d4dec50b73ea0d739ca226704fb80169', '[\"*\"]', '2024-11-02 01:52:37', '2024-11-02 01:52:33', '2024-11-02 01:52:37'),
(884, 'App\\Models\\User', 7, 'MyApp', 'ae43fec4a6b91f115e38aef8516112edfb7e4f51c6d90d20877cffd67652eb1d', '[\"*\"]', NULL, '2024-11-02 01:52:34', '2024-11-02 01:52:34'),
(885, 'App\\Models\\User', 7, 'MyApp', '986a1dc248322068669651c85b244b2aa6367e060141496c40d741e68dfa959e', '[\"*\"]', '2024-11-02 01:52:38', '2024-11-02 01:52:34', '2024-11-02 01:52:38'),
(886, 'App\\Models\\User', 7, 'MyApp', '1d83159ffa376a2f23cd376b34c66bad10fc0c68fa68dc442b805e68f893cf80', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(887, 'App\\Models\\User', 7, 'MyApp', 'be285eed27b0dd051ab80c23ce4a2ddb508f3978c969f0381cd634b6640c6a55', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(888, 'App\\Models\\User', 7, 'MyApp', '757b9f3439bd01b9aeae389d9321268d18ba4afe0a0dad3195a9ad8a883470cc', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(889, 'App\\Models\\User', 7, 'MyApp', '4313686a31c40c1c93aa3a569323e8d60f168661ce74f81bae302a8590194b3e', '[\"*\"]', '2024-11-02 01:52:37', '2024-11-02 01:52:35', '2024-11-02 01:52:37'),
(890, 'App\\Models\\User', 7, 'MyApp', '1c496b148ea5f36f0a43bc88fd1dcb3c89829943e47389021fce965cd9ddfee1', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(891, 'App\\Models\\User', 7, 'MyApp', '6c5a1bbb58aa074c32e35dc69c3f1e50bc0fcf864753ea682709ac5152c75286', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(892, 'App\\Models\\User', 7, 'MyApp', '959cabb641e942eb0a546adf3c69636a3bd3a3917e5c8d2b3e384231c6790ba4', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(893, 'App\\Models\\User', 7, 'MyApp', 'fcb5ff9394d6493c4c5f4dbf4367e68f1cf130ca24b14ece68a06b1596a52ca2', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(894, 'App\\Models\\User', 7, 'MyApp', '3b3f798691973e0dccea2504bf47086a46b22a96219120da350bac3e80f2b473', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(895, 'App\\Models\\User', 7, 'MyApp', '738acc772dd991079c9f2def8b3eaca0ba6ef7e3d854732e72fb79c10cea2758', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(896, 'App\\Models\\User', 7, 'MyApp', '54620ee221e6d2e684f296b382bcceaa84bb89dde0d4cdbad69f653325e785f8', '[\"*\"]', '2024-11-02 01:52:37', '2024-11-02 01:52:35', '2024-11-02 01:52:37'),
(897, 'App\\Models\\User', 7, 'MyApp', '5e6ab3ba4401945de092508e1dce0b5ee9f4768e5e0cad36988646e261bf0adf', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(898, 'App\\Models\\User', 7, 'MyApp', 'f7408c441bcd36dbb50fb363a8d15118d32aff79ac52202b249b0edb56c26c5d', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(899, 'App\\Models\\User', 7, 'MyApp', 'e58e7408a4916aef2444e37e582b8bd7d8fa1b45764971d9b4d11e0da6ded573', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(900, 'App\\Models\\User', 7, 'MyApp', 'ac16023d75ce1f22549c0def8dcb91284c5399662b4eb7a14dca3c77b2e80889', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(901, 'App\\Models\\User', 7, 'MyApp', '82bd8c3e0afcd03739fc247b41c48ed0b625ce94f1bc1df2b00046e57d2c65bd', '[\"*\"]', '2024-11-02 01:52:37', '2024-11-02 01:52:35', '2024-11-02 01:52:37'),
(902, 'App\\Models\\User', 7, 'MyApp', '3d920285f68b70fc2b1b14b381b8fe46da70f37c8283ecb47d4c48031e4f14ba', '[\"*\"]', NULL, '2024-11-02 01:52:35', '2024-11-02 01:52:35'),
(903, 'App\\Models\\User', 7, 'MyApp', '804338b2d3d86fb88ac59827ef89eba89d2e999b03197e493d9c9eb5499c5514', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(904, 'App\\Models\\User', 7, 'MyApp', 'f52a2d8b612b8a1c4324b4045fdbe87df8447f34e5bb1ca323c4c252278209ce', '[\"*\"]', '2024-11-02 01:52:38', '2024-11-02 01:52:36', '2024-11-02 01:52:38'),
(905, 'App\\Models\\User', 7, 'MyApp', 'bcd45157aa21fca08497107de9013a7c474df69a8a262fd59301b3244b4f448f', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(906, 'App\\Models\\User', 7, 'MyApp', '54b70f3d175d5c7a4022493fab3f96c57ee2705fa3814e67c0a4f36a9d2cd832', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(907, 'App\\Models\\User', 7, 'MyApp', 'f28c978eefafb3c796c9bbb3ec997d4757ad412b903ae37ec1dcde9071ac64bc', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(908, 'App\\Models\\User', 7, 'MyApp', '4ea5ae66e61768776b766734ce9bfe777fe4548aa8fe0730e243e8ecabfc0fe7', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(909, 'App\\Models\\User', 7, 'MyApp', '01826df8d459891e07e7330ffeb4029bf0160e314554f2364fcff8411c429c6a', '[\"*\"]', '2024-11-02 01:52:38', '2024-11-02 01:52:36', '2024-11-02 01:52:38'),
(910, 'App\\Models\\User', 7, 'MyApp', '653d9569c0c6b2f4906d3512883410010b1589aaa139d84953de7758d225c136', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(911, 'App\\Models\\User', 7, 'MyApp', 'c4ddedf60c8438fda914cf7fa0cc258befa9f0e9f7bcff7f244deed8f9aa1c84', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(912, 'App\\Models\\User', 7, 'MyApp', 'b1822e270cbfd6e334d2f84d7de4fc8d4abe94163a71c812cf67e9e94c327ee7', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(913, 'App\\Models\\User', 7, 'MyApp', '1533d5b115b1ed9ee95f59ba9b953b08d1b6de17fe5767bf4ecf9e9a2794f4b7', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(914, 'App\\Models\\User', 7, 'MyApp', 'a66c1b99ea3d7ba22f417396c84cdea7a1eed4db1d16badb18313f9dc53678c8', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(915, 'App\\Models\\User', 7, 'MyApp', 'd60e332bae1eea581cbb78d7411a98570983094991bd882acef1ba077e20ded7', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(916, 'App\\Models\\User', 7, 'MyApp', '25ab9bc2b5bdd50e5fa24efad5af57e76de1335706bd9325d4c683b560ac0d1e', '[\"*\"]', '2024-11-02 01:52:38', '2024-11-02 01:52:36', '2024-11-02 01:52:38'),
(917, 'App\\Models\\User', 7, 'MyApp', 'f7abdc0db595b992141935e0432746f48b27e71e40a55aae3584f3eae87dbdb1', '[\"*\"]', '2024-11-02 01:52:37', '2024-11-02 01:52:36', '2024-11-02 01:52:37'),
(918, 'App\\Models\\User', 7, 'MyApp', 'e95bc1a596ecc46d7c1ef0e00a70fc8af83429ac014dcf6fb90d1ac80fb126a2', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(919, 'App\\Models\\User', 7, 'MyApp', 'b112058490679195f3698d44c2aa7336c0294efea91f687a13137163217abaff', '[\"*\"]', '2024-11-02 01:52:38', '2024-11-02 01:52:36', '2024-11-02 01:52:38'),
(920, 'App\\Models\\User', 7, 'MyApp', '4de13bcc43001a8a7d5ac330fd22955dff04729617154a36896e213512d917b0', '[\"*\"]', NULL, '2024-11-02 01:52:36', '2024-11-02 01:52:36'),
(921, 'App\\Models\\User', 7, 'MyApp', 'a8dced38459e1c70320527068a319c3b9b5e4f840f1d9c65600bdfa4b11cae45', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(922, 'App\\Models\\User', 7, 'MyApp', 'a174b8c646fa87b38bb6b8cc5f7130698048901bda7c8b7380228bf3526432e6', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(923, 'App\\Models\\User', 7, 'MyApp', 'a3dbe15eb743e19710c7949358cdbab230921d39d13149289ef1880ca1fdda8e', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(924, 'App\\Models\\User', 7, 'MyApp', '103952a1fad598b830445ad711b173e5fdee293f337fb9b523daa3d5ae9443fd', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(925, 'App\\Models\\User', 7, 'MyApp', '4f8b8d9d154bd880a8b57e88fcae7221597593e79a2552b908b930c72ba28c2c', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(926, 'App\\Models\\User', 7, 'MyApp', '1b3a807e4e7475662466d5df7914dabe3c900740aa64624f76c22ebfd9816a0c', '[\"*\"]', NULL, '2024-11-02 01:52:37', '2024-11-02 01:52:37'),
(927, 'App\\Models\\User', 7, 'MyApp', 'b31cecc0e74e9b4ae75977780bab94f3ca5a643aad0e1242af7e49ac4abb9f17', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(928, 'App\\Models\\User', 7, 'MyApp', 'cc0e24f848ab3a7e83c0f7c6c63a69b9189a14388340082f3956c11bb240b4aa', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(929, 'App\\Models\\User', 7, 'MyApp', '0fce9c767792074554c7966ab91b2d268bd1c192f6ad943dbf6eb9501bd64e2d', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(930, 'App\\Models\\User', 7, 'MyApp', '0066ff4bd3136056014c7af6fec0b531a38c9c4a45e77477dfd0bfbca1b50079', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(931, 'App\\Models\\User', 7, 'MyApp', '45156739d6f6fd8c8e493cd65a270a6f2fbac84d234a8196258bde7f51a26f99', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(932, 'App\\Models\\User', 7, 'MyApp', '0e9da3f9852700c3a8aea2355114d04d8c5d1911b11b4d5e8d24b76b96a7e176', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(933, 'App\\Models\\User', 7, 'MyApp', 'f1cead35030c9889d52fd4fe834b0612c0f56e153edb472f45666e5d5eba8681', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(934, 'App\\Models\\User', 7, 'MyApp', '10b935d6050d02b5d0b9667a81fc95e3216ccf5028bd604b192e829cb2ced08f', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(935, 'App\\Models\\User', 7, 'MyApp', '4f8a07db8cda0cd4aeb496b20b1c2ad4cc23a2ee059512229d93e89661aa40fe', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(936, 'App\\Models\\User', 7, 'MyApp', '5260e0817975d3831b918bfca0200d3f92fd143a2066cee151e8fd6d8e77b278', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(937, 'App\\Models\\User', 7, 'MyApp', '76827e8d7099274d2d1c17ab7da5b0839367b5683b217fe1f0e668d0c1263caf', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(938, 'App\\Models\\User', 7, 'MyApp', '7d6d58908f6d306352ed6cd46e6a7f7dc7c8db74bb4f6833894f53fe721b76c4', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(939, 'App\\Models\\User', 7, 'MyApp', 'b810b194cc6bca37f114800387c72cd7a7a4c2f712cbf29f7ff41bad0cbf815b', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(940, 'App\\Models\\User', 7, 'MyApp', 'f7d22a870d2d7e3a27eab42d125bf08dc077f0d8fd3f18590e998b6d38ac598e', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(941, 'App\\Models\\User', 7, 'MyApp', '2a13239bea9f9a6660bb374510182304acf7a4bdb266ac34f377e6d12ed79788', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(942, 'App\\Models\\User', 7, 'MyApp', '4095fc012e99eeb085d7a72bd1271b7240d9bc86fcb6a86a09a2fa830c6367df', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(943, 'App\\Models\\User', 7, 'MyApp', 'c0615421819d82c4acc27d48b3f84616953b67eecb43aa5502b4838c1cda161d', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(944, 'App\\Models\\User', 7, 'MyApp', '5c9a8ee2d906094239e3948e2060cb3b844532067781ecb3663cd286690dfc63', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(945, 'App\\Models\\User', 7, 'MyApp', '575c075afa46b0d3b2001b74f9ccf1b03b3b0ddac87b5778c6ae1ee1ef8a79ad', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(946, 'App\\Models\\User', 7, 'MyApp', '5d038c63a6dbac8b3d56e86030de3d484316e31b524efbeb10a4e7a41b15c490', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(947, 'App\\Models\\User', 7, 'MyApp', 'cf43826c63e12341003cb4b68b100752f3344f82921e047a6caddb619356b379', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(948, 'App\\Models\\User', 7, 'MyApp', '6032e624eab336fc63cca8fba506f433dc87f4a4ba598e9a784a0553d9a754f4', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(949, 'App\\Models\\User', 7, 'MyApp', 'f3b0d770dcb7a5997615488eb35d75fe59c7ac011e7ed39f45081d7b4de92ddb', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(950, 'App\\Models\\User', 7, 'MyApp', 'c0e64b85e88ccc48a069fe3664c6f0538dbcc166b1d9ede4536ffa48fd472037', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(951, 'App\\Models\\User', 7, 'MyApp', 'ee1069d51c81016c1c8f57e75e4309c7775b129ec631237f00a63faade6a66cf', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(952, 'App\\Models\\User', 7, 'MyApp', '46e639dee4ee5552eac5efa06f1139ad67a88f13eb90629c9e6e373a810a326c', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(953, 'App\\Models\\User', 7, 'MyApp', '1382a7f3b216d4d591e5f7f1b340f0ee80857e00ff736805828376e1ec2446d3', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(954, 'App\\Models\\User', 7, 'MyApp', '130ad0bd8412bb0d6b0915a64f4ae80c3bf15c874f9cf0c822b57b8a6d7cc8e3', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(955, 'App\\Models\\User', 7, 'MyApp', '8484d16f80aac51eaced24702015fcf0500bf49526cd371f6c4d2e5712d6b747', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(956, 'App\\Models\\User', 7, 'MyApp', 'b6131a4d4f8e29e0cbe3283abc5525261a147fbafa456c64faa9234c25d3b6c6', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(957, 'App\\Models\\User', 7, 'MyApp', '5e715607d82e0b6ea97881be2506bbcf9004106accf1162c53bcd04a27a3e3f4', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(958, 'App\\Models\\User', 7, 'MyApp', '6721ba14d1676753c783e06bef24750ffbf7313492f36bac2a45326944713b35', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(959, 'App\\Models\\User', 7, 'MyApp', '67e5936619531c6c53f8dcc0f99179b313793692b0c85163a32ab6405a617b0a', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(960, 'App\\Models\\User', 7, 'MyApp', '4f3e7a321be1b265b4994c9e93509b16bf0db6f1b42624a0b90e91b5d1345caa', '[\"*\"]', NULL, '2024-11-02 01:52:38', '2024-11-02 01:52:38'),
(961, 'App\\Models\\User', 7, 'MyApp', '79ea4479556e9325f02679f07d624583fffff603deca6bc942eb2fd857d79dee', '[\"*\"]', NULL, '2024-11-02 01:52:39', '2024-11-02 01:52:39'),
(962, 'App\\Models\\User', 7, 'MyApp', '5e57237061ffea963f1c626ad77b3441067fc0cdf3afb85a987898045f9d7cbe', '[\"*\"]', NULL, '2024-11-02 01:52:39', '2024-11-02 01:52:39'),
(963, 'App\\Models\\User', 7, 'MyApp', 'a83a1f94b5d835ccc17b869be106e4c704ca5d454c03390527966b04cc653705', '[\"*\"]', '2024-11-02 01:54:12', '2024-11-02 01:53:52', '2024-11-02 01:54:12'),
(964, 'App\\Models\\User', 7, 'MyApp', '2251504cc1e9d5dcbaa588400eb7d4b3267c7e4c1d8279d43060bde767342ccf', '[\"*\"]', '2024-11-02 02:13:28', '2024-11-02 02:03:49', '2024-11-02 02:13:28'),
(965, 'App\\Models\\User', 7, 'MyApp', '4e7275c483b39f31e73f4c7e664f0b1b1a8ede01285da45fb156d9fb0f93d059', '[\"*\"]', '2024-11-02 02:19:07', '2024-11-02 02:19:06', '2024-11-02 02:19:07'),
(966, 'App\\Models\\User', 7, 'MyApp', '19de1ccf03b71e4955d1fe70e2fa8e4d7841f192634e8e699fb08384cebdec40', '[\"*\"]', '2024-11-02 02:19:22', '2024-11-02 02:19:22', '2024-11-02 02:19:22'),
(967, 'App\\Models\\User', 7, 'MyApp', '9b2d671e8b4f3648ca782d6e601d3005993e041bcb4b38cbee782945815d47fb', '[\"*\"]', '2024-11-02 05:07:56', '2024-11-02 02:19:22', '2024-11-02 05:07:56'),
(968, 'App\\Models\\User', 7, 'MyApp', '10d7fb990dfe03e2748d2cde5ffaed0765f54f8f89e21046f72140ec4cf697e8', '[\"*\"]', '2024-11-02 16:42:02', '2024-11-02 16:42:01', '2024-11-02 16:42:02'),
(969, 'App\\Models\\User', 7, 'MyApp', 'f08a6e63ab5a87bd3a97ad21a1c8ecc3d0ce83e34899d6a86a0727cd448686aa', '[\"*\"]', NULL, '2024-11-02 16:43:37', '2024-11-02 16:43:37'),
(970, 'App\\Models\\User', 7, 'MyApp', '20302326b2fcaa7a4d08db753496f8c8a05ee56f0c58e5e897419b48cd2e169a', '[\"*\"]', '2024-11-02 16:43:38', '2024-11-02 16:43:37', '2024-11-02 16:43:38'),
(971, 'App\\Models\\User', 7, 'MyApp', '47463f91848fb59a24154d89e9b86911e16c40b859464e602d14007c4276a0dc', '[\"*\"]', '2024-11-02 16:45:37', '2024-11-02 16:45:36', '2024-11-02 16:45:37'),
(972, 'App\\Models\\User', 7, 'MyApp', '50d8d03e9e70cff993b69eaadf950e345092c63b3e9f0d56b97be3936c3b5f5b', '[\"*\"]', '2024-11-02 19:47:37', '2024-11-02 16:45:36', '2024-11-02 19:47:37'),
(973, 'App\\Models\\User', 7, 'MyApp', '97103e25ec3cb0337727c71509201c7cef9d137ad8aee6906846e7e194a841ff', '[\"*\"]', '2024-11-02 19:47:49', '2024-11-02 19:47:48', '2024-11-02 19:47:49'),
(974, 'App\\Models\\User', 7, 'MyApp', '5719ff83acc334b40dcf6e8022b160fd6675b8e0a94ac8367ff71acda977a693', '[\"*\"]', '2024-11-02 19:47:49', '2024-11-02 19:47:48', '2024-11-02 19:47:49'),
(975, 'App\\Models\\User', 7, 'MyApp', 'b551a949216398c9463e72137f83effa01a6b74906409af171a6b2ce0e1d7f39', '[\"*\"]', '2024-11-02 19:48:12', '2024-11-02 19:48:12', '2024-11-02 19:48:12'),
(976, 'App\\Models\\User', 7, 'MyApp', 'd6f9e0721ff082856d962cb4bd58ef5c6ed8a8954a149677fab97e6365bad65e', '[\"*\"]', '2024-11-02 19:51:01', '2024-11-02 19:48:12', '2024-11-02 19:51:01'),
(977, 'App\\Models\\User', 7, 'MyApp', '6c003dbe5aa756d24afc80c3f4532f90089b6442e77d6b47777b6884ed388dcb', '[\"*\"]', '2024-11-02 20:55:59', '2024-11-02 20:55:59', '2024-11-02 20:55:59'),
(978, 'App\\Models\\User', 7, 'MyApp', '06e1cc79622a1d12e439eb2758d4370652331501bdf9186439a1a7d2b0def7ac', '[\"*\"]', '2024-11-02 20:55:59', '2024-11-02 20:55:59', '2024-11-02 20:55:59'),
(979, 'App\\Models\\User', 7, 'MyApp', '3b1dac201d01723280f8cac89dcaa5eb4ad16de1fe51b56b83acda08c28ad91b', '[\"*\"]', '2024-11-03 13:02:14', '2024-11-03 12:49:19', '2024-11-03 13:02:14'),
(980, 'App\\Models\\User', 7, 'MyApp', 'e3476bd7daa3c78ab380852627639a60ddd08d4510e64300ae77f384051c2b1d', '[\"*\"]', NULL, '2024-11-05 23:05:06', '2024-11-05 23:05:06'),
(981, 'App\\Models\\User', 7, 'MyApp', '29455e1b447a64a0d6bdd9a6d4916981d4275b79aaec2d54d72c3685ea821fee', '[\"*\"]', '2024-11-05 23:05:06', '2024-11-05 23:05:06', '2024-11-05 23:05:06'),
(982, 'App\\Models\\User', 7, 'MyApp', '73ad03aaf8658533dc3602eb98a8672193ea4c26b5baa02ac353fda16d8939cd', '[\"*\"]', NULL, '2024-11-06 03:43:15', '2024-11-06 03:43:15'),
(983, 'App\\Models\\User', 7, 'MyApp', '2821b4fccda1743d5a6d81360e517a970a3db536c7388a770778dae1e3862f72', '[\"*\"]', '2024-11-06 03:43:16', '2024-11-06 03:43:15', '2024-11-06 03:43:16'),
(984, 'App\\Models\\User', 7, 'MyApp', '57bea21a272dee0ef2f412335e296aed033e64967067fbf9afb34c1a8d6d37ef', '[\"*\"]', '2024-11-06 14:39:03', '2024-11-06 13:21:14', '2024-11-06 14:39:03'),
(985, 'App\\Models\\User', 7, 'MyApp', '8bedcea1ae34924321d32917c7814471b2939ae8150d41b98c3f8e739a1b9d4c', '[\"*\"]', '2024-11-06 14:39:38', '2024-11-06 14:39:37', '2024-11-06 14:39:38'),
(986, 'App\\Models\\User', 7, 'MyApp', '8bd64f458fc925efda196ecda742340688e8c7ce0d632a6b69f80d4b34058dfb', '[\"*\"]', '2024-11-06 14:43:34', '2024-11-06 14:39:37', '2024-11-06 14:43:34'),
(987, 'App\\Models\\User', 7, 'MyApp', '90e2235a9da423333152e44031c5131e2d781a99f2ba4f1b254423c90525e262', '[\"*\"]', '2024-11-06 15:00:38', '2024-11-06 15:00:37', '2024-11-06 15:00:38'),
(988, 'App\\Models\\User', 7, 'MyApp', 'f7004b5ca435c73b9d881b269ec27ba496d94432848a8193dabc08eddc61c34e', '[\"*\"]', '2024-11-06 15:18:51', '2024-11-06 15:12:25', '2024-11-06 15:18:51'),
(989, 'App\\Models\\User', 7, 'MyApp', '8f59b80c1aafc8295d072c215ecdec560ee6f822d6ec2b422bd10ef00ef31f29', '[\"*\"]', '2024-11-06 15:53:25', '2024-11-06 15:53:24', '2024-11-06 15:53:25'),
(990, 'App\\Models\\User', 7, 'MyApp', '7e9701a96f4089f16803ec7a5116c159737177cce9931b9ab2d31d7eb06397e6', '[\"*\"]', '2024-11-06 15:59:43', '2024-11-06 15:59:43', '2024-11-06 15:59:43'),
(991, 'App\\Models\\User', 7, 'MyApp', '3a38961907a9fec383b7e27465e9200d49420b27ece1a25c5abe1630605ba60d', '[\"*\"]', '2024-11-06 16:05:28', '2024-11-06 15:59:43', '2024-11-06 16:05:28'),
(992, 'App\\Models\\User', 7, 'MyApp', '9d2dfb490e5d3ccdfd930282714ea21ade850660dfc25976d8efbaa915a76524', '[\"*\"]', '2024-11-11 18:07:44', '2024-11-11 17:43:34', '2024-11-11 18:07:44'),
(993, 'App\\Models\\User', 7, 'MyApp', '80146f23ae8a04426fe527003f7dd55d00b472c536c351a265b267dd50476e9b', '[\"*\"]', '2024-11-11 18:19:59', '2024-11-11 18:19:59', '2024-11-11 18:19:59'),
(994, 'App\\Models\\User', 7, 'MyApp', 'ed2964852d24a0da1738b44cdac05c657ccdd5697da717d8decc5cc94155385a', '[\"*\"]', '2024-11-11 19:00:09', '2024-11-11 18:19:59', '2024-11-11 19:00:09'),
(995, 'App\\Models\\User', 7, 'MyApp', 'e47708537dc435e7a9ec872819be069c35897a14b81b006489f2ee1d3ac3ed89', '[\"*\"]', NULL, '2024-11-11 23:14:05', '2024-11-11 23:14:05'),
(996, 'App\\Models\\User', 7, 'MyApp', '059ba6f5b88af721f5617795c9fe878e66b3e7651c40b58a3b266d1d296600a6', '[\"*\"]', '2024-11-11 23:14:41', '2024-11-11 23:14:05', '2024-11-11 23:14:41'),
(997, 'App\\Models\\User', 7, 'MyApp', 'c74ee1159b32b2bf52e8b71f2ee3af9e8be1cf22beb31ca0a9e1910a9f7e5a88', '[\"*\"]', NULL, '2024-11-11 23:16:29', '2024-11-11 23:16:29'),
(998, 'App\\Models\\User', 7, 'MyApp', 'b72bc059ed8795d63dfadc516a98c860b387b5992bf19eb0072b38fe7b37f146', '[\"*\"]', '2024-11-11 23:16:29', '2024-11-11 23:16:29', '2024-11-11 23:16:29'),
(999, 'App\\Models\\User', 7, 'MyApp', '8a29a338ed7b29ed796d7296afd11a03600704bdf507c2e74dd77ce90e019d4f', '[\"*\"]', NULL, '2024-11-11 23:16:37', '2024-11-11 23:16:37'),
(1000, 'App\\Models\\User', 7, 'MyApp', 'b8b8fa5272c5ab0e3b85e7b78e07c0459a395b6f890c4e42a6c6f78cef748edb', '[\"*\"]', '2024-11-11 23:16:37', '2024-11-11 23:16:37', '2024-11-11 23:16:37'),
(1001, 'App\\Models\\User', 7, 'MyApp', '48418b7c1e793f90035e4d270af2da14012a361463394880f34d66242094ad60', '[\"*\"]', '2024-11-11 23:37:45', '2024-11-11 23:37:45', '2024-11-11 23:37:45'),
(1002, 'App\\Models\\User', 7, 'MyApp', '6ed42aac8688b1557298ee8c608ab545077986f41e4e992b859a05d63b52d7cc', '[\"*\"]', '2024-11-11 23:57:31', '2024-11-11 23:37:45', '2024-11-11 23:57:31'),
(1003, 'App\\Models\\User', 7, 'MyApp', '80af8680b13147cff46ab814582775e490072176f77c9649c75203b397f0f236', '[\"*\"]', '2024-11-12 17:31:35', '2024-11-12 16:12:57', '2024-11-12 17:31:35'),
(1004, 'App\\Models\\User', 7, 'MyApp', '46175b2b667250999b2e0b68eff7fdf4be2adc83994c0d01ddf8fd9f498b7a00', '[\"*\"]', '2024-11-12 17:31:42', '2024-11-12 17:31:41', '2024-11-12 17:31:42'),
(1005, 'App\\Models\\User', 7, 'MyApp', '05f1fddc96b1979e807bf18256e74331d099e5972cb582d4cabaab48bc6ff640', '[\"*\"]', '2024-11-12 18:17:19', '2024-11-12 17:31:41', '2024-11-12 18:17:19'),
(1006, 'App\\Models\\User', 7, 'MyApp', 'd00caafc1b189cafa5f13828d696f7192cbc63bd6127526d36d8e8dbfd052ba9', '[\"*\"]', '2024-11-12 18:36:02', '2024-11-12 18:36:02', '2024-11-12 18:36:02'),
(1007, 'App\\Models\\User', 7, 'MyApp', '58ff81e8c9b0627060788dec2927288b1e5d7a7a2e65281ef17f91a1c90c633c', '[\"*\"]', '2024-11-12 18:36:37', '2024-11-12 18:36:02', '2024-11-12 18:36:37'),
(1008, 'App\\Models\\User', 7, 'MyApp', '8c27b597543e803e333a30630724a86113fbb114b3f57f69f85fbd870ac5f790', '[\"*\"]', NULL, '2024-11-12 18:56:15', '2024-11-12 18:56:15'),
(1009, 'App\\Models\\User', 7, 'MyApp', 'd62091332cca0c7e7f9f343385f6088a2f2f41af7ccbced2a8c5ede751798a19', '[\"*\"]', '2024-11-12 19:14:48', '2024-11-12 18:56:15', '2024-11-12 19:14:48'),
(1010, 'App\\Models\\User', 7, 'MyApp', '428572e6a4a019bf0a58d8dabb463778f3db3dc5e86866f05293fc84cfcdaa39', '[\"*\"]', NULL, '2024-11-12 19:17:56', '2024-11-12 19:17:56'),
(1011, 'App\\Models\\User', 7, 'MyApp', '2247625846fe587a1be3e57ef47d7e31355ef659188fc1acb324fe75da350748', '[\"*\"]', '2024-11-12 21:30:50', '2024-11-12 19:17:56', '2024-11-12 21:30:50'),
(1012, 'App\\Models\\User', 7, 'MyApp', '18924e1f1666797aea0f4e0f916299c05f11452087e462b7518955d53ccf05ae', '[\"*\"]', '2024-11-12 21:37:34', '2024-11-12 21:37:33', '2024-11-12 21:37:34'),
(1013, 'App\\Models\\User', 7, 'MyApp', '10554006da293bb209c80dfd68671c6a5cab31ca29d8f1c9237ddb5e3b8a3cae', '[\"*\"]', '2024-11-12 21:40:18', '2024-11-12 21:40:18', '2024-11-12 21:40:18'),
(1014, 'App\\Models\\User', 7, 'MyApp', '54b8dac6a2b7b79b083cbc8a754ac4931e7fa11e7d1097c2e6230f4e0b71cba8', '[\"*\"]', '2024-11-13 00:34:19', '2024-11-13 00:34:19', '2024-11-13 00:34:19'),
(1015, 'App\\Models\\User', 7, 'MyApp', '1b59fa1e7fddac723f5c38b89144b8d418dea9903dd116f860e6796b6f38195d', '[\"*\"]', '2024-11-13 17:12:37', '2024-11-13 17:12:37', '2024-11-13 17:12:37'),
(1016, 'App\\Models\\User', 7, 'MyApp', 'f11f980171abae546cde1d35026550ddbbb29c1509e277b3b19ceda86f573157', '[\"*\"]', '2024-11-13 17:12:46', '2024-11-13 17:12:46', '2024-11-13 17:12:46'),
(1017, 'App\\Models\\User', 7, 'MyApp', '5d93724227f5b0bf903f95104ba7a36ca10ac11012da4e0ef16e6a33d79bca15', '[\"*\"]', '2024-11-13 17:12:46', '2024-11-13 17:12:46', '2024-11-13 17:12:46'),
(1018, 'App\\Models\\User', 7, 'MyApp', '8b0fa76341c705b7a09b3cbf77546ee4b502ffd64388150810ac515e1bbba737', '[\"*\"]', '2024-11-13 23:49:34', '2024-11-13 23:49:34', '2024-11-13 23:49:34'),
(1019, 'App\\Models\\User', 7, 'MyApp', '5e1ececdca949dea9add9c7c2fc28447cf2a61c34f5a2d908d036753d1321023', '[\"*\"]', '2024-11-14 00:03:21', '2024-11-14 00:01:16', '2024-11-14 00:03:21'),
(1020, 'App\\Models\\User', 7, 'MyApp', 'ca337392562fd45b22714903c8f1185ba6654cbab56d9e7fdddced3570f392e0', '[\"*\"]', '2024-11-14 00:20:45', '2024-11-14 00:07:09', '2024-11-14 00:20:45'),
(1021, 'App\\Models\\User', 7, 'MyApp', 'b7647afa8cf732fa0c085c7ca131c1e81085c0a765b3e85607b2875da2799a46', '[\"*\"]', '2024-11-14 00:37:35', '2024-11-14 00:37:34', '2024-11-14 00:37:35'),
(1022, 'App\\Models\\User', 7, 'MyApp', 'cc439346d52a33b69f1da9f6fac17838ddd14416ff6615f26763d168e10c2a6f', '[\"*\"]', '2024-11-14 00:41:55', '2024-11-14 00:37:34', '2024-11-14 00:41:55'),
(1023, 'App\\Models\\User', 7, 'MyApp', '6a3f3a35aff6e1a298cdfb7443d1343d3ba62b2c56dc151014f67e042c807d25', '[\"*\"]', '2024-11-14 00:46:47', '2024-11-14 00:43:28', '2024-11-14 00:46:47'),
(1024, 'App\\Models\\User', 7, 'MyApp', 'be15844b650893b2c147b2d3e0f4808e44d2251f6c35a4949a89f8672c879512', '[\"*\"]', '2024-11-14 00:47:40', '2024-11-14 00:47:40', '2024-11-14 00:47:40'),
(1025, 'App\\Models\\User', 7, 'MyApp', 'a7ba8d4b0729b0b750b4c20a46d812ea6188f0e74b46d9649aae991e53b3cf08', '[\"*\"]', '2024-11-14 00:47:40', '2024-11-14 00:47:40', '2024-11-14 00:47:40'),
(1026, 'App\\Models\\User', 7, 'MyApp', 'd7fe9eae2b8b9217de1b2a07a33c6daba5eb0baec680c4bef2b140d059dc06b3', '[\"*\"]', '2024-11-14 00:48:17', '2024-11-14 00:48:17', '2024-11-14 00:48:17'),
(1027, 'App\\Models\\User', 7, 'MyApp', '366a428f45fc29abe82f19448a2035ed9e6ad885c644ed3249c6f6401335c50b', '[\"*\"]', '2024-11-14 00:48:17', '2024-11-14 00:48:17', '2024-11-14 00:48:17'),
(1028, 'App\\Models\\User', 7, 'MyApp', 'b37e8767d03b3d9fb79ccad6af7769ed5c53538504a2408b2802c700984f7665', '[\"*\"]', NULL, '2024-11-14 00:48:45', '2024-11-14 00:48:45'),
(1029, 'App\\Models\\User', 7, 'MyApp', '40ea8f7b204c05a99e24fbf7117de311bc9dd53f93b2d50f8021c2552d6f746b', '[\"*\"]', '2024-11-14 00:48:45', '2024-11-14 00:48:45', '2024-11-14 00:48:45'),
(1030, 'App\\Models\\User', 7, 'MyApp', '024f1e1fcb09f6ffebbc6401d431c2789204675bc704c41f1dbafa1b0c2eb48b', '[\"*\"]', NULL, '2024-11-14 00:49:28', '2024-11-14 00:49:28'),
(1031, 'App\\Models\\User', 7, 'MyApp', 'c3310860a5930eb89bd624b4b209f27187931b382971d96057debfd701f0a545', '[\"*\"]', '2024-11-14 00:49:28', '2024-11-14 00:49:28', '2024-11-14 00:49:28'),
(1032, 'App\\Models\\User', 7, 'MyApp', '4037ec25337a532d30adb62900320a1d7570c29b98384c3c5873a8d7c2031699', '[\"*\"]', NULL, '2024-11-14 00:49:43', '2024-11-14 00:49:43'),
(1033, 'App\\Models\\User', 7, 'MyApp', '34a15ad631113bf62e96fd79e5a7e06962c14b9c53ad17a702ac751cc6db1f23', '[\"*\"]', '2024-11-14 00:49:43', '2024-11-14 00:49:43', '2024-11-14 00:49:43'),
(1034, 'App\\Models\\User', 7, 'MyApp', 'eec9e883fdc7465add84e81a63933973c57d4515ccea999b1dc5025500e5f43d', '[\"*\"]', '2024-11-15 23:23:18', '2024-11-15 23:23:18', '2024-11-15 23:23:18'),
(1035, 'App\\Models\\User', 7, 'MyApp', '144622e762def0707c62bf0b092001add0f0b6425a9bcc94d8536ab914a12726', '[\"*\"]', '2024-11-15 23:23:18', '2024-11-15 23:23:18', '2024-11-15 23:23:18'),
(1036, 'App\\Models\\User', 7, 'MyApp', '78fad032f2bcee6616175fdb073fc81425f145549b87ff6357b31eae1400fee9', '[\"*\"]', '2024-11-16 21:32:33', '2024-11-16 20:17:05', '2024-11-16 21:32:33'),
(1037, 'App\\Models\\User', 7, 'MyApp', '01fbf0d0f6cd9ec133c83b3e94c2bac765f6b305d2874a769ea78904e8734430', '[\"*\"]', '2024-11-17 20:47:57', '2024-11-17 20:47:57', '2024-11-17 20:47:57'),
(1038, 'App\\Models\\User', 7, 'MyApp', 'd365521b6bc65b33b60e7925a63bbff07c75aeed78873503c2fcfaf4755d719f', '[\"*\"]', '2024-11-17 20:48:11', '2024-11-17 20:47:57', '2024-11-17 20:48:11'),
(1039, 'App\\Models\\User', 7, 'MyApp', '22b52410c7cca7c4d4c8180688945ceba1cbb93f80948d9f8b1be6b46d4c4580', '[\"*\"]', '2024-11-19 23:42:11', '2024-11-19 23:41:00', '2024-11-19 23:42:11'),
(1040, 'App\\Models\\User', 7, 'MyApp', '5b8c3cab5cf9c677a8cab7b279c77ed823da4972472b44fa71e0f476a1071839', '[\"*\"]', '2024-11-19 23:41:00', '2024-11-19 23:41:00', '2024-11-19 23:41:00'),
(1041, 'App\\Models\\User', 7, 'MyApp', 'f24affbe62e5aa0b648d2b58aee8b55d1383a98292d66d17f7ca9080c9b60ef5', '[\"*\"]', '2024-11-22 22:42:06', '2024-11-22 22:41:52', '2024-11-22 22:42:06'),
(1042, 'App\\Models\\User', 7, 'MyApp', '1de75b1835bec98dd57b810d5d06e0693787a2d12aa93e20cdcd8161db587b47', '[\"*\"]', NULL, '2024-11-22 22:41:52', '2024-11-22 22:41:52'),
(1043, 'App\\Models\\User', 7, 'MyApp', '48603607ba884149ec6c28796da5b80a97464b0422bb4023a14af2663908571c', '[\"*\"]', '2024-11-24 23:15:57', '2024-11-24 23:15:57', '2024-11-24 23:15:57'),
(1044, 'App\\Models\\User', 7, 'MyApp', '79550d90e0944fb29737ee74a0bfc977b30dc91ba8388294158469fdec45b647', '[\"*\"]', '2024-11-24 23:48:43', '2024-11-24 23:48:43', '2024-11-24 23:48:43'),
(1045, 'App\\Models\\User', 7, 'MyApp', 'e6583383ccff1a7174124deee09899d59bce6fbfc4e7f7f819dc4798f9d8ce0a', '[\"*\"]', NULL, '2024-11-26 23:19:00', '2024-11-26 23:19:00'),
(1046, 'App\\Models\\User', 7, 'MyApp', 'bbf3c0d622b85225318af297ccc5635cb6d7a5120ff8cc57a24d5a2e903d5f85', '[\"*\"]', '2024-11-26 23:19:28', '2024-11-26 23:19:00', '2024-11-26 23:19:28'),
(1047, 'App\\Models\\User', 7, 'MyApp', '9567bb3cde6c5b1f0436114e1c56de3ffbfed01877ec0e6092fe311f3f2d1b17', '[\"*\"]', '2024-12-01 14:44:21', '2024-12-01 14:44:20', '2024-12-01 14:44:21'),
(1048, 'App\\Models\\User', 7, 'MyApp', '8a8835bfa3a7c9fd2b7c5906e303b02111906ead776f9fd6159ae43258539d7c', '[\"*\"]', '2024-12-05 03:45:40', '2024-12-05 03:45:40', '2024-12-05 03:45:40'),
(1049, 'App\\Models\\User', 7, 'MyApp', '02d851cc66131b9920ecac903d8e52c1d6a2b96d452b1b40391bbe26ffdcad7b', '[\"*\"]', NULL, '2024-12-05 03:47:45', '2024-12-05 03:47:45'),
(1050, 'App\\Models\\User', 7, 'MyApp', 'e5ea933f526db90c80fabac4472c2b694be382c0293e48a0c71708aff23b62de', '[\"*\"]', '2024-12-05 03:51:54', '2024-12-05 03:51:54', '2024-12-05 03:51:54'),
(1051, 'App\\Models\\User', 7, 'MyApp', 'defe15698522f19fc44a21a1e900681a58a5894fc6e8c15d76ca358d6742a4fa', '[\"*\"]', '2024-12-05 03:52:41', '2024-12-05 03:52:03', '2024-12-05 03:52:41'),
(1052, 'App\\Models\\User', 7, 'MyApp', '649296c2d5fa912a990f85e9dcd115986b4036c73040df34d4317b54519461f9', '[\"*\"]', '2024-12-05 03:52:56', '2024-12-05 03:52:43', '2024-12-05 03:52:56'),
(1053, 'App\\Models\\User', 7, 'MyApp', '297d30affa092945e1c72c90369c185581696ed1d7b26b824c07f32c69c6d84a', '[\"*\"]', '2024-12-05 03:52:56', '2024-12-05 03:52:43', '2024-12-05 03:52:56'),
(1054, 'App\\Models\\User', 7, 'MyApp', '60d20aa2321c212a87b4842e8566037d37b67d5d1a3fecf2a74edb4f3aff3fe1', '[\"*\"]', '2024-12-05 04:11:19', '2024-12-05 04:11:19', '2024-12-05 04:11:19'),
(1055, 'App\\Models\\User', 7, 'MyApp', '4cdd9bc397c8376154d59bb8196274af4a07cc1189ca150574eb8d6cbcbc5405', '[\"*\"]', '2024-12-05 04:22:30', '2024-12-05 04:22:29', '2024-12-05 04:22:30'),
(1056, 'App\\Models\\User', 7, 'MyApp', '78f2ed07900f5d9e7d2711f0a7a44ae9e4d617cc52c8183a09db665925e60a04', '[\"*\"]', '2024-12-05 04:52:35', '2024-12-05 04:52:34', '2024-12-05 04:52:35'),
(1057, 'App\\Models\\User', 7, 'MyApp', '7eec1484db005a33354447b958dc8acad7776a89294cb4be6bc205887aa033ca', '[\"*\"]', '2024-12-05 04:53:37', '2024-12-05 04:53:36', '2024-12-05 04:53:37'),
(1058, 'App\\Models\\User', 7, 'MyApp', '2d5526d8238b424d8ead03c15edc183ecd7fae9806774677da10307837cc2ca3', '[\"*\"]', '2024-12-05 04:53:37', '2024-12-05 04:53:37', '2024-12-05 04:53:37'),
(1059, 'App\\Models\\User', 7, 'MyApp', '35fa372e066253157c433b9d4feb221cdceaa6824f80f6047aad1402e756edf4', '[\"*\"]', '2024-12-05 04:54:20', '2024-12-05 04:54:20', '2024-12-05 04:54:20'),
(1060, 'App\\Models\\User', 7, 'MyApp', '6ed27d40ec6516c376eb0b5095a7c0d3b71e0d2477ba3787f5b5bbfeff5bdd4e', '[\"*\"]', '2024-12-05 04:54:20', '2024-12-05 04:54:20', '2024-12-05 04:54:20'),
(1061, 'App\\Models\\User', 7, 'MyApp', 'b6d6ef0d1cbf156881e1fa18b87d8ebb03a30f473cc9ce02865bb10eb639b9c1', '[\"*\"]', '2024-12-05 04:58:01', '2024-12-05 04:58:01', '2024-12-05 04:58:01'),
(1062, 'App\\Models\\User', 7, 'MyApp', 'f790a25a91612dc502990a08cd64a229f315ef6125fc29b471293883505f064c', '[\"*\"]', '2024-12-05 04:58:01', '2024-12-05 04:58:01', '2024-12-05 04:58:01'),
(1063, 'App\\Models\\User', 7, 'MyApp', '05ccdd745aa639d3b10a8aeb03b6999d8b8b8ec986f4f680c1da4f67a78f1ba5', '[\"*\"]', '2024-12-05 05:01:28', '2024-12-05 05:01:28', '2024-12-05 05:01:28'),
(1064, 'App\\Models\\User', 7, 'MyApp', '7dd2fee35b71147e01cf5ab694fdac51a0e90386ef49c260a3a25aeea0c9b6da', '[\"*\"]', '2024-12-05 05:01:28', '2024-12-05 05:01:28', '2024-12-05 05:01:28'),
(1065, 'App\\Models\\User', 7, 'MyApp', '6cdac00929bbe15f6254acd8fda6705c647a4c50a8b5cac6347de4130dbbab12', '[\"*\"]', '2024-12-05 15:50:05', '2024-12-05 15:50:04', '2024-12-05 15:50:05'),
(1066, 'App\\Models\\User', 7, 'MyApp', '74f5911196f6830ad5317338958a8236c3412dfd3fb22aeaa1d28e888c8fe2ff', '[\"*\"]', '2024-12-05 16:33:29', '2024-12-05 16:33:28', '2024-12-05 16:33:29'),
(1067, 'App\\Models\\User', 7, 'MyApp', 'ed342f99abc8832cc97195e71a8fa1bf8f2bc3db505467ba0129ebf88828824e', '[\"*\"]', '2024-12-05 16:34:35', '2024-12-05 16:34:34', '2024-12-05 16:34:35'),
(1068, 'App\\Models\\User', 7, 'MyApp', 'bedd30dc05603fb1749a23520e9067c1b99db180b095f435c6256564dc9cf78f', '[\"*\"]', '2024-12-05 16:34:35', '2024-12-05 16:34:35', '2024-12-05 16:34:35'),
(1069, 'App\\Models\\User', 7, 'MyApp', '477a9fabcc5bd5cfd8724bd9b29930520995de0d5a49270355d2dc55049a2c56', '[\"*\"]', '2024-12-05 16:41:16', '2024-12-05 16:41:16', '2024-12-05 16:41:16'),
(1070, 'App\\Models\\User', 7, 'MyApp', 'bbecbb8d936d90001d35eeb225ec83e03e04c0429aa1ca7daea500e7cf038650', '[\"*\"]', '2024-12-05 16:41:16', '2024-12-05 16:41:16', '2024-12-05 16:41:16'),
(1071, 'App\\Models\\User', 7, 'MyApp', '34985642e71e28e93f5cb67cb25df6554e1308a90d3087c2a3f50d2a78f8480c', '[\"*\"]', NULL, '2024-12-05 17:12:27', '2024-12-05 17:12:27'),
(1072, 'App\\Models\\User', 7, 'MyApp', '8da96053368301fb2af6088e6fc8ad554370cb587a2164c60fa40192371edc2e', '[\"*\"]', '2024-12-05 17:12:27', '2024-12-05 17:12:27', '2024-12-05 17:12:27'),
(1073, 'App\\Models\\User', 7, 'MyApp', '7941aa628063febfae79fd548095916f8f7970366a77cf199c1813c0dea439d7', '[\"*\"]', NULL, '2024-12-05 17:21:55', '2024-12-05 17:21:55'),
(1074, 'App\\Models\\User', 7, 'MyApp', 'aec31ce272af1a56a7a707b70d3b494ac35ad967eebb127b2b1217411214f385', '[\"*\"]', '2024-12-05 17:21:55', '2024-12-05 17:21:55', '2024-12-05 17:21:55'),
(1075, 'App\\Models\\User', 7, 'MyApp', '0e938d296123c80604ebf6e3d5f8b02093e205869ffbf214bafe057fac6e93a1', '[\"*\"]', '2024-12-05 17:38:16', '2024-12-05 17:38:15', '2024-12-05 17:38:16'),
(1076, 'App\\Models\\User', 7, 'MyApp', 'f8263f03d180eda8bf4e97384cc0e035c065555cdb65aa7ede36508725a39f96', '[\"*\"]', '2024-12-05 17:47:28', '2024-12-05 17:45:32', '2024-12-05 17:47:28'),
(1077, 'App\\Models\\User', 7, 'MyApp', '22b0577325e2e7de11f0fe4cd69738b0c8b336f5325654cef3ed3ab4ac0441a2', '[\"*\"]', '2024-12-31 21:13:34', '2024-12-31 21:13:18', '2024-12-31 21:13:34'),
(1078, 'App\\Models\\User', 7, 'MyApp', '51094d7038c3e2dd7eb4b25c1c1af5e380173bad94b5ecfe08d8af25644aa733', '[\"*\"]', '2024-12-31 23:01:31', '2024-12-31 23:01:30', '2024-12-31 23:01:31'),
(1079, 'App\\Models\\User', 7, 'MyApp', '9124b18c5da0cf96c443d8bcf8e1363270dc1a092043d5904c683c23644a11a9', '[\"*\"]', '2024-12-31 23:19:40', '2024-12-31 23:19:39', '2024-12-31 23:19:40'),
(1080, 'App\\Models\\User', 7, 'MyApp', 'fbd695c6253e8991e40b3933b2575196225d99b4657b98694c2d8c658b0764f3', '[\"*\"]', '2024-12-31 23:19:40', '2024-12-31 23:19:40', '2024-12-31 23:19:40'),
(1081, 'App\\Models\\User', 7, 'MyApp', 'b88985d636b8dcf1e914f48f1521f205b9aa01d3ed0f17e9a05fce5a06d95af0', '[\"*\"]', NULL, '2025-01-01 02:20:06', '2025-01-01 02:20:06'),
(1082, 'App\\Models\\User', 7, 'MyApp', '1a07004157ca325107e9f9482c9eab1a79fc35496f829118a7c2cdf00246d52c', '[\"*\"]', '2025-01-01 02:20:06', '2025-01-01 02:20:06', '2025-01-01 02:20:06'),
(1083, 'App\\Models\\User', 7, 'MyApp', 'd803a232662ac6c4a945c51cfda13a88eb3572b8f7c60694de9d83526c43671d', '[\"*\"]', '2025-01-02 19:06:00', '2025-01-02 19:06:00', '2025-01-02 19:06:00'),
(1084, 'App\\Models\\User', 7, 'MyApp', 'ff8e3ce48c165bdd2209f3d7d1d5a9aeecc2f003397843a146db04dc435ca749', '[\"*\"]', '2025-01-02 19:22:35', '2025-01-02 19:22:35', '2025-01-02 19:22:35'),
(1085, 'App\\Models\\User', 7, 'MyApp', '2f30f9b2ad3b244f3d29879f34958e6a701580355f69617869c263cdc6e407d2', '[\"*\"]', NULL, '2025-01-05 19:21:07', '2025-01-05 19:21:07'),
(1086, 'App\\Models\\User', 7, 'MyApp', 'c0112433b9c0c382fd0bb519ca629756a275d5daf610310910c2295302a11c45', '[\"*\"]', '2025-01-05 19:21:07', '2025-01-05 19:21:07', '2025-01-05 19:21:07'),
(1087, 'App\\Models\\User', 7, 'MyApp', 'bae33f3d18fa3613cd9b7eddb45444cba572c62ec482aa200f5c53af2632ed2b', '[\"*\"]', '2025-01-05 19:41:17', '2025-01-05 19:41:16', '2025-01-05 19:41:17'),
(1088, 'App\\Models\\User', 7, 'MyApp', 'f6415864a65b62a94379c80fe0b63dd686926bd76f7875800c46adc052d46602', '[\"*\"]', '2025-01-05 19:41:49', '2025-01-05 19:41:49', '2025-01-05 19:41:49'),
(1089, 'App\\Models\\User', 7, 'MyApp', '629c70f77414974b6c18f9adf8dc93e5188af1060f95186d83f05fa66237fe44', '[\"*\"]', '2025-01-05 19:41:50', '2025-01-05 19:41:49', '2025-01-05 19:41:50'),
(1090, 'App\\Models\\User', 7, 'MyApp', '7da4f0dad02268d77bec80be15217efaf98cb5a544626100fadf33d552b4578f', '[\"*\"]', '2025-01-05 19:42:18', '2025-01-05 19:42:17', '2025-01-05 19:42:18'),
(1091, 'App\\Models\\User', 7, 'MyApp', '0cf020de3f1acafd655a68eff5ac03da15d4435b54038481c56e8563a250a5b4', '[\"*\"]', '2025-01-05 19:42:18', '2025-01-05 19:42:17', '2025-01-05 19:42:18'),
(1092, 'App\\Models\\User', 7, 'MyApp', '1d6b834f20d7b7b36a93973fb25711679dd3e1bbee89db7877459745560e07fa', '[\"*\"]', '2025-01-05 19:43:45', '2025-01-05 19:43:44', '2025-01-05 19:43:45'),
(1093, 'App\\Models\\User', 7, 'MyApp', '407afeb1ab3e4a9cabfd08f2b767d1fcea02fd7e953ed9b40c287e1a9fa100a9', '[\"*\"]', '2025-01-05 19:45:00', '2025-01-05 19:44:54', '2025-01-05 19:45:00'),
(1094, 'App\\Models\\User', 7, 'MyApp', '50c44131c4bfaddc6a2997cf281fc46015defcb78005065984e7b4fdfbdaa50a', '[\"*\"]', '2025-01-05 19:45:38', '2025-01-05 19:45:37', '2025-01-05 19:45:38'),
(1095, 'App\\Models\\User', 7, 'MyApp', '1c61ae97f0c66d4e71c477be915c6f73e08dc85bd48047f9bea28e7145f654fd', '[\"*\"]', '2025-01-05 19:46:48', '2025-01-05 19:46:06', '2025-01-05 19:46:48'),
(1096, 'App\\Models\\User', 7, 'MyApp', 'bf021b1c7453c5695c04101f0bddff147d91a81cd23a7f89b859468544c88c58', '[\"*\"]', '2025-01-05 19:47:44', '2025-01-05 19:47:44', '2025-01-05 19:47:44'),
(1097, 'App\\Models\\User', 7, 'MyApp', 'e199547c8f6aa8b6bbccff25aba105b7a1720f812e371590fd86d24cba7b78b3', '[\"*\"]', '2025-01-05 19:47:48', '2025-01-05 19:47:48', '2025-01-05 19:47:48'),
(1098, 'App\\Models\\User', 7, 'MyApp', '4f97321bd8a4b256253c4f4c5ff6bd43e7ae872b5b08fdaa17491dfc420be5fa', '[\"*\"]', '2025-01-05 19:49:28', '2025-01-05 19:49:27', '2025-01-05 19:49:28'),
(1099, 'App\\Models\\User', 7, 'MyApp', '463a01fed6dbd0c26f9fe0fffdea872deea58d12ba3e08db8c2fd3dfb2dfd4a6', '[\"*\"]', '2025-01-05 19:49:31', '2025-01-05 19:49:29', '2025-01-05 19:49:31');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1100, 'App\\Models\\User', 7, 'MyApp', '3de85d643d4362ecd5f9ba4b39cd26a4ebd1251367732d35d2e6168b92bfe821', '[\"*\"]', '2025-01-05 19:50:55', '2025-01-05 19:50:54', '2025-01-05 19:50:55'),
(1101, 'App\\Models\\User', 7, 'MyApp', 'e7804aebf02d455abd021e817befa6cc55d3d4db02b8914d723e6a56e0537070', '[\"*\"]', '2025-01-05 19:50:56', '2025-01-05 19:50:55', '2025-01-05 19:50:56'),
(1102, 'App\\Models\\User', 7, 'MyApp', '0c10006bf71e5f900db6d5f936950ddd3dcd8944e283a118a254bf3f97612fc4', '[\"*\"]', '2025-01-05 19:57:03', '2025-01-05 19:57:03', '2025-01-05 19:57:03'),
(1103, 'App\\Models\\User', 7, 'MyApp', '931c11cd983e007049882ab85d7b5aa9ef6fb9d0ca458c2e319014057a2c7563', '[\"*\"]', NULL, '2025-01-05 19:57:03', '2025-01-05 19:57:03'),
(1104, 'App\\Models\\User', 7, 'MyApp', '83b63b1a55240afeebef2c3e90fa9fa229837f0d172c0dc88400ad38ea198643', '[\"*\"]', '2025-01-05 20:03:51', '2025-01-05 20:03:50', '2025-01-05 20:03:51'),
(1105, 'App\\Models\\User', 7, 'MyApp', '0e4480b33aa320eaa99935a73bfdee000f91fb8569819ee5abd4707199e2017b', '[\"*\"]', '2025-01-05 20:03:52', '2025-01-05 20:03:51', '2025-01-05 20:03:52'),
(1106, 'App\\Models\\User', 7, 'MyApp', 'afcb8b865663aceb58758b976e91e4d1d0a297bfa6a8d72a1836d9d8fcd97cb9', '[\"*\"]', NULL, '2025-01-05 20:08:48', '2025-01-05 20:08:48'),
(1107, 'App\\Models\\User', 7, 'MyApp', '63a290514bd06c0ac4fb4ee4305978b5fc50ba72c31e51f329988d2ca577fc2b', '[\"*\"]', '2025-01-05 20:08:49', '2025-01-05 20:08:48', '2025-01-05 20:08:49'),
(1108, 'App\\Models\\User', 7, 'MyApp', 'cb43f8d5a9467906ee0d7cde592b98c9467962b92ff89355e7e074e272ac8e30', '[\"*\"]', NULL, '2025-01-05 20:14:41', '2025-01-05 20:14:41'),
(1109, 'App\\Models\\User', 7, 'MyApp', 'c8542a4012d121e4a1353c17abd23d55a226162fcf3d3612e1dc621acc2d1fd4', '[\"*\"]', '2025-01-05 20:14:42', '2025-01-05 20:14:41', '2025-01-05 20:14:42'),
(1110, 'App\\Models\\User', 7, 'MyApp', 'ed03138b428fb91706783d426a74c5ca993664994c531a08d98920a1e5489866', '[\"*\"]', NULL, '2025-01-05 20:15:57', '2025-01-05 20:15:57'),
(1111, 'App\\Models\\User', 7, 'MyApp', '07bb393b930ed115dde6d1682436e57e8767e3d7712a3243e2d4ee20848c5797', '[\"*\"]', '2025-01-05 20:15:58', '2025-01-05 20:15:57', '2025-01-05 20:15:58'),
(1112, 'App\\Models\\User', 7, 'MyApp', '175c10e584880c77a4864ae45ff5821dfa9d56c2b61ed72baf23519c37516b5e', '[\"*\"]', '2025-01-05 20:34:48', '2025-01-05 20:34:47', '2025-01-05 20:34:48'),
(1113, 'App\\Models\\User', 7, 'MyApp', '122a642787e905fcef7ae2b2939ee34e77dd4a42cb0923f4cef0c20e8808cd91', '[\"*\"]', '2025-01-05 20:34:51', '2025-01-05 20:34:51', '2025-01-05 20:34:51'),
(1114, 'App\\Models\\User', 7, 'MyApp', '7da091d27c1653500c5e290e5aa05ddf216c5cf750c7b643a890b0cef96b1d2c', '[\"*\"]', NULL, '2025-01-06 02:47:26', '2025-01-06 02:47:26'),
(1115, 'App\\Models\\User', 7, 'MyApp', 'e926b7fb680edf9a7577be37282f131fb3120cbc7281eb5c389d7f40bcba747b', '[\"*\"]', NULL, '2025-01-06 02:47:26', '2025-01-06 02:47:26'),
(1116, 'App\\Models\\User', 7, 'MyApp', '92520c1e6bcd3cba6f513eae71f6cdc48aeba2c0b217aae29a41e083b76b64a6', '[\"*\"]', '2025-01-06 02:47:32', '2025-01-06 02:47:31', '2025-01-06 02:47:32'),
(1117, 'App\\Models\\User', 7, 'MyApp', '85b092858a00f4b7e39ca5d4d27b0ea7c6d1c58f854eefcb4d11b96153f4dd4e', '[\"*\"]', '2025-01-06 02:47:56', '2025-01-06 02:47:32', '2025-01-06 02:47:56'),
(1118, 'App\\Models\\User', 7, 'MyApp', 'c03eedbcf0a0677aba8afd44c1a4d2cea70c9b9da1b6b21b7295bcfe005f6f55', '[\"*\"]', NULL, '2025-01-22 01:09:58', '2025-01-22 01:09:58'),
(1119, 'App\\Models\\User', 113, 'MyApp', '37f1db6e96737f185d73b51bd4110e407e1b21063598b691bc80425e4651d7ba', '[\"*\"]', '2025-02-02 21:43:50', '2025-01-22 01:11:10', '2025-02-02 21:43:50'),
(1120, 'App\\Models\\User', 7, 'MyApp', 'a7791b2f5e996de190d4209f41650c1bab3999f3321fc36e83e5161f40efcc99', '[\"*\"]', '2025-01-22 01:14:52', '2025-01-22 01:13:32', '2025-01-22 01:14:52'),
(1121, 'App\\Models\\User', 113, 'MyApp', 'c57d8219dddcb294625f3bc4a27ec8df74ac6d16f5c22a1e016e97e19ce9e931', '[\"*\"]', NULL, '2025-01-22 01:23:48', '2025-01-22 01:23:48'),
(1122, 'App\\Models\\User', 113, 'MyApp', '78989145f383349dbb5c0e48b23e9deff08d89436433915b00ec1b1dafa5a616', '[\"*\"]', NULL, '2025-01-22 01:24:24', '2025-01-22 01:24:24'),
(1123, 'App\\Models\\User', 7, 'MyApp', '743262736a005b4cb0f86ef8af823c7af845c268473d9d3532c574a2df81b645', '[\"*\"]', NULL, '2025-01-22 01:43:30', '2025-01-22 01:43:30'),
(1124, 'App\\Models\\User', 7, 'MyApp', '85e58cf7d51c0cf2fdee9c016f9f98393b2e8df31c367eee8bb40e982a55415e', '[\"*\"]', '2025-01-22 01:43:30', '2025-01-22 01:43:30', '2025-01-22 01:43:30'),
(1125, 'App\\Models\\User', 7, 'MyApp', '7706ed16243a80ef42558a1946e530e8f14cae3086fdf7f80377dc0f9048a5f0', '[\"*\"]', '2025-01-22 15:48:15', '2025-01-22 15:48:14', '2025-01-22 15:48:15'),
(1126, 'App\\Models\\User', 7, 'MyApp', 'fb64d805ecbf578e8c1ad519560d0afad926e9b249812be1cbfc84580858c4e2', '[\"*\"]', '2025-01-22 16:04:02', '2025-01-22 16:04:02', '2025-01-22 16:04:02'),
(1127, 'App\\Models\\User', 7, 'MyApp', '250f40692de6729fa87229f37f7f0e1ce5876b672e24e5ac97cd97d1060166bb', '[\"*\"]', '2025-01-22 16:04:05', '2025-01-22 16:04:05', '2025-01-22 16:04:05'),
(1128, 'App\\Models\\User', 7, 'MyApp', '57f60211d7219d12afac22a8d40b5d1736071cb2bd4204dad84682bcd6caab3a', '[\"*\"]', '2025-01-22 16:19:06', '2025-01-22 16:19:06', '2025-01-22 16:19:06'),
(1129, 'App\\Models\\User', 7, 'MyApp', '0b84f17147ea14f9579492f920d2be1275b7e7ae0fe57c914c0f4de7f4ebed4f', '[\"*\"]', '2025-01-22 16:59:52', '2025-01-22 16:48:35', '2025-01-22 16:59:52'),
(1130, 'App\\Models\\User', 7, 'MyApp', '4617715efd78ec6be040b31485600f8170b298d926b61d2ea779bd583c2a4701', '[\"*\"]', '2025-01-22 17:03:59', '2025-01-22 17:03:58', '2025-01-22 17:03:59'),
(1131, 'App\\Models\\User', 7, 'MyApp', 'df6c959218096d6b34ac08d881cbde0a4400885c361d793329334100f08cca7d', '[\"*\"]', '2025-01-22 17:04:01', '2025-01-22 17:04:01', '2025-01-22 17:04:01'),
(1132, 'App\\Models\\User', 7, 'MyApp', '20e586daa08db76a7732879f5d63a2e7299c7a8b769e1e3ee4303e7101a26c5e', '[\"*\"]', '2025-01-22 17:05:03', '2025-01-22 17:05:03', '2025-01-22 17:05:03'),
(1133, 'App\\Models\\User', 7, 'MyApp', '60b92158a1fdfa1e8dd1e1318804e4d6451f4a1abf90feb5f8b1b9ead0abf3be', '[\"*\"]', '2025-01-22 17:06:35', '2025-01-22 17:06:35', '2025-01-22 17:06:35'),
(1134, 'App\\Models\\User', 7, 'MyApp', '43c773658056052ece819d67295c31a598d52eefa86c5760a9da7d9cc576c5fa', '[\"*\"]', '2025-01-22 17:06:51', '2025-01-22 17:06:51', '2025-01-22 17:06:51'),
(1135, 'App\\Models\\User', 7, 'MyApp', '04a3d0a4423b035c5967047d8f8a396f9b1083ea461679bdb3d63c544953e37a', '[\"*\"]', '2025-01-22 17:07:06', '2025-01-22 17:07:06', '2025-01-22 17:07:06'),
(1136, 'App\\Models\\User', 7, 'MyApp', '3bb31f9d0d2a87bac1322b8d2f71dea3f8d789f81cf5edb12b13af13c73c41b6', '[\"*\"]', '2025-01-22 17:08:18', '2025-01-22 17:08:17', '2025-01-22 17:08:18'),
(1137, 'App\\Models\\User', 7, 'MyApp', '59d878f0c668b00774764b4062eab1647b4cf4343ea5bc6f78fb393e4d710eec', '[\"*\"]', '2025-01-22 17:08:59', '2025-01-22 17:08:59', '2025-01-22 17:08:59'),
(1138, 'App\\Models\\User', 7, 'MyApp', 'b75901c36495e8050e082c484f94af20863d9b1b3819019c91dfd6af8964f8ef', '[\"*\"]', '2025-01-22 17:09:29', '2025-01-22 17:09:29', '2025-01-22 17:09:29'),
(1139, 'App\\Models\\User', 7, 'MyApp', '1b0f5d261c96dae75e5ca3d8c8e662a908ca383b5ae76ad74beea908469c8966', '[\"*\"]', '2025-01-22 17:11:00', '2025-01-22 17:10:59', '2025-01-22 17:11:00'),
(1140, 'App\\Models\\User', 7, 'MyApp', 'ebf00a337f78ad127664fa80a6b31d794f32f6cf06e3d9d8dc42d8eacb5501b4', '[\"*\"]', NULL, '2025-01-22 17:13:32', '2025-01-22 17:13:32'),
(1141, 'App\\Models\\User', 7, 'MyApp', '9b1c76b387f3a1ee3370223213e12312cf40b7994a10742b7d96554898514a81', '[\"*\"]', '2025-01-22 17:13:32', '2025-01-22 17:13:32', '2025-01-22 17:13:32'),
(1142, 'App\\Models\\User', 7, 'MyApp', '7034a095f4e31924201c10f17ea27f491f9651d71dd65b57f169d7e4a27119b0', '[\"*\"]', '2025-01-22 17:21:19', '2025-01-22 17:13:46', '2025-01-22 17:21:19'),
(1143, 'App\\Models\\User', 7, 'MyApp', '172f2f95ca162bb4f27c68896386a23e6ffcac1fe05615f505e8f94166a7f08a', '[\"*\"]', '2025-01-22 17:29:29', '2025-01-22 17:29:29', '2025-01-22 17:29:29'),
(1144, 'App\\Models\\User', 7, 'MyApp', 'faeb4cc130c05cb131a5f260919ad9107d2c6f1a51cb92e609d2686e1addeda7', '[\"*\"]', '2025-01-22 18:55:02', '2025-01-22 17:29:32', '2025-01-22 18:55:02'),
(1145, 'App\\Models\\User', 7, 'MyApp', 'd78eedb18a0db07637892188a873185d0691e3b054138c6cea9c9ee6239642f1', '[\"*\"]', '2025-01-22 18:55:46', '2025-01-22 18:55:46', '2025-01-22 18:55:46'),
(1146, 'App\\Models\\User', 7, 'MyApp', 'dd9446e4ef720bb41108e02e51ac677573171cec06157c44ded8269fa97db9b0', '[\"*\"]', '2025-01-22 19:29:55', '2025-01-22 19:29:55', '2025-01-22 19:29:55'),
(1147, 'App\\Models\\User', 7, 'MyApp', '58e52532bfe147d29731ddf184c64948d617e0d9f11af7a8dc27525cf04908a6', '[\"*\"]', '2025-01-22 19:32:37', '2025-01-22 19:32:37', '2025-01-22 19:32:37'),
(1148, 'App\\Models\\User', 7, 'MyApp', 'c2b2355e8399b6dadab30c8a6fdaa3e7a6e0cffd410a34bf2a5547b026024016', '[\"*\"]', NULL, '2025-01-22 19:32:37', '2025-01-22 19:32:37'),
(1149, 'App\\Models\\User', 7, 'MyApp', 'eea78795a3b004115bb306812f3f71ca48b9d73f066c5c274e3281f663122f08', '[\"*\"]', NULL, '2025-01-22 19:35:49', '2025-01-22 19:35:49'),
(1150, 'App\\Models\\User', 7, 'MyApp', '818ad40d876b74750ad8cfbbc1d23caeba5bf151759d6a2fb7425476cdcb8de1', '[\"*\"]', '2025-01-22 19:35:49', '2025-01-22 19:35:49', '2025-01-22 19:35:49'),
(1151, 'App\\Models\\User', 7, 'MyApp', '138f61dbdfbbbfa229e1fa68ea55b8ef8dad01821ad98bed07da8c298f1668a5', '[\"*\"]', NULL, '2025-01-22 19:37:10', '2025-01-22 19:37:10'),
(1152, 'App\\Models\\User', 7, 'MyApp', '464512ecf6151cbffc2eecc1bd5c258494a98755d268a977280373040196603f', '[\"*\"]', '2025-01-22 19:37:11', '2025-01-22 19:37:10', '2025-01-22 19:37:11'),
(1153, 'App\\Models\\User', 7, 'MyApp', 'b28cfbc81e26d52a72fb862057fd768fbdf89c09e21398e4e1ec50037dffd18a', '[\"*\"]', '2025-01-22 19:38:31', '2025-01-22 19:38:30', '2025-01-22 19:38:31'),
(1154, 'App\\Models\\User', 7, 'MyApp', '8915c6b549c5b6399ce59cf958beb3864022f22df19c5eef3c48002fbd7f31ef', '[\"*\"]', '2025-01-22 19:38:54', '2025-01-22 19:38:54', '2025-01-22 19:38:54'),
(1155, 'App\\Models\\User', 7, 'MyApp', '49c288666242105e8b0e2f38c887f0899c8c59def453f2da6c8ed8c3fb7af23d', '[\"*\"]', '2025-01-22 19:38:54', '2025-01-22 19:38:54', '2025-01-22 19:38:54'),
(1156, 'App\\Models\\User', 7, 'MyApp', '42a3f74dab0dcae0f601a61c2ec4ecc06277e05e63149341069da5dc7fd54523', '[\"*\"]', '2025-01-22 19:39:11', '2025-01-22 19:39:10', '2025-01-22 19:39:11'),
(1157, 'App\\Models\\User', 7, 'MyApp', '06e75357897e949c0ae43067074b113b403c52649ebaafaa456ec80037a481e3', '[\"*\"]', '2025-01-22 19:39:11', '2025-01-22 19:39:10', '2025-01-22 19:39:11'),
(1158, 'App\\Models\\User', 7, 'MyApp', '5eab6d720cdf10a3c8f13f403dae989f6f8e48dfb9e09a9cac68bb174065d08d', '[\"*\"]', '2025-01-22 19:39:33', '2025-01-22 19:39:33', '2025-01-22 19:39:33'),
(1159, 'App\\Models\\User', 7, 'MyApp', '7d4b6ab51d2e124becd719ff1b52aa5855cd619f1d23c0d3c1a49936664a2bc7', '[\"*\"]', '2025-01-22 19:42:38', '2025-01-22 19:42:37', '2025-01-22 19:42:38'),
(1160, 'App\\Models\\User', 7, 'MyApp', '43d058069acac676dc378b6be08fc5d4eceefac101b71913c1cc5df2df956728', '[\"*\"]', '2025-01-22 19:43:23', '2025-01-22 19:43:22', '2025-01-22 19:43:23'),
(1161, 'App\\Models\\User', 7, 'MyApp', '705b3d90d2779058d23e8ed4784b6fdae36f369ba1e18bff65ee392c947f1a23', '[\"*\"]', '2025-01-23 15:10:55', '2025-01-23 15:09:59', '2025-01-23 15:10:55'),
(1162, 'App\\Models\\User', 7, 'MyApp', 'a1518758505bd8dc14a98ceecf5d0edcf6ed0851924696574af472db40e4375b', '[\"*\"]', '2025-01-23 22:34:51', '2025-01-23 22:34:51', '2025-01-23 22:34:51'),
(1163, 'App\\Models\\User', 125, 'MyApp', 'ebded0d0d42b5bb0efd9019f691f16d9ef337e77787aae2d32d8ad7a6d73073c', '[\"*\"]', '2025-01-24 16:33:44', '2025-01-24 16:33:12', '2025-01-24 16:33:44'),
(1164, 'App\\Models\\User', 126, 'MyApp', 'bbebd6f015b88924ce5b096b53810b8918e5393b4cdfaeb054c346cd42b0019b', '[\"*\"]', '2025-01-24 23:04:28', '2025-01-24 23:01:05', '2025-01-24 23:04:28'),
(1165, 'App\\Models\\User', 126, 'MyApp', '608eccdec32137932952f2e4d91ee4a49c203b808729451c3d44435def2d2c1f', '[\"*\"]', NULL, '2025-01-24 23:04:50', '2025-01-24 23:04:50'),
(1166, 'App\\Models\\User', 126, 'MyApp', 'd91443040d10ceb8402d57195c81740146b1c6c5484646e06f37f1897e9c07cc', '[\"*\"]', '2025-01-24 23:04:54', '2025-01-24 23:04:51', '2025-01-24 23:04:54'),
(1167, 'App\\Models\\User', 127, 'MyApp', '07f5b14b0b3994b356ba705e3e6c30403a45d7da3a79b61f9905fea802d9e4bb', '[\"*\"]', '2025-01-24 23:06:57', '2025-01-24 23:06:51', '2025-01-24 23:06:57'),
(1168, 'App\\Models\\User', 128, 'MyApp', '7144380ee703f48d184839eddbebfc00d0cb3bf8f150d0176420519982f263f2', '[\"*\"]', '2025-01-24 23:12:13', '2025-01-24 23:12:13', '2025-01-24 23:12:13'),
(1169, 'App\\Models\\User', 7, 'MyApp', 'f669f769494581cb3ba6cdd7e9fc6410827578af66747c03ad8f0b8c96836a58', '[\"*\"]', '2025-01-24 23:14:06', '2025-01-24 23:14:05', '2025-01-24 23:14:06'),
(1170, 'App\\Models\\User', 129, 'MyApp', '502a6e4ad3e9472bcb3c64667d39bf4ecb6195128a9437fc9adab63c80583bb8', '[\"*\"]', '2025-01-24 23:28:53', '2025-01-24 23:28:52', '2025-01-24 23:28:53'),
(1171, 'App\\Models\\User', 131, 'MyApp', '62e2f4425de125747b82bd6e611f375d781234cd0a896b7047cf8b62840acbce', '[\"*\"]', '2025-01-25 00:31:33', '2025-01-25 00:31:27', '2025-01-25 00:31:33'),
(1172, 'App\\Models\\User', 132, 'MyApp', 'ce67f9cae6f578dd9abd57a0be90d029be3ffdd4be0be5c6aa65e54ead274754', '[\"*\"]', '2025-01-25 00:36:58', '2025-01-25 00:36:55', '2025-01-25 00:36:58'),
(1173, 'App\\Models\\User', 7, 'MyApp', '965056d09305bcdcd62574f9a646d3e591b7edc63ff5f1e1ba20e3476f871c10', '[\"*\"]', '2025-01-25 01:16:57', '2025-01-25 01:14:21', '2025-01-25 01:16:57'),
(1174, 'App\\Models\\User', 134, 'MyApp', '0a09a4200d8a57bd1ec03f116f727c673ce3a626a3f6ae779fdcdf417564eae6', '[\"*\"]', '2025-01-25 02:13:22', '2025-01-25 02:13:21', '2025-01-25 02:13:22'),
(1175, 'App\\Models\\User', 128, 'MyApp', 'b2ebfe652fe7353a55d73a6d58cf0d64fc8782e39c77f23abd66406186e88fe7', '[\"*\"]', NULL, '2025-01-25 02:25:35', '2025-01-25 02:25:35'),
(1176, 'App\\Models\\User', 128, 'MyApp', '8cd9b77a78f2b2d5a3d79de28abb28983490830ad3fcd6a00c12b323f6055c8b', '[\"*\"]', '2025-01-25 02:25:35', '2025-01-25 02:25:35', '2025-01-25 02:25:35'),
(1177, 'App\\Models\\User', 129, 'MyApp', 'a8a1026cfb548546b2aa8ba94a7c35c74b5efbdf4fba6bd10114b4eb4883c83c', '[\"*\"]', '2025-01-25 02:39:09', '2025-01-25 02:38:59', '2025-01-25 02:39:09'),
(1178, 'App\\Models\\User', 134, 'MyApp', '52b97105838f5c525f78650e3be41b9b1589ab396aa693349c189cfa5c6bb54c', '[\"*\"]', '2025-01-25 03:15:45', '2025-01-25 03:15:45', '2025-01-25 03:15:45'),
(1179, 'App\\Models\\User', 134, 'MyApp', '48db810c25cf02257f2ab7fbceea51630685366d5ce9de257d9efef8f85dd9d8', '[\"*\"]', '2025-01-25 03:16:06', '2025-01-25 03:16:06', '2025-01-25 03:16:06'),
(1180, 'App\\Models\\User', 126, 'MyApp', '9bd9056eb61538a07af89a2296523e25cb051ce902285db8e6648a2b36e9d386', '[\"*\"]', '2025-01-25 03:18:32', '2025-01-25 03:18:32', '2025-01-25 03:18:32'),
(1181, 'App\\Models\\User', 134, 'MyApp', 'f994668856ac2f8ce583e30a12951fc3e669d2a46919833e5877b5b5f8fa3a48', '[\"*\"]', '2025-01-26 13:04:50', '2025-01-26 13:04:49', '2025-01-26 13:04:50'),
(1182, 'App\\Models\\User', 134, 'MyApp', '681736a218d50e96c6db5f43f5f057f3d1227ae202b1db699ddd49312ed6f9ec', '[\"*\"]', '2025-01-26 17:43:29', '2025-01-26 17:43:28', '2025-01-26 17:43:29'),
(1183, 'App\\Models\\User', 134, 'MyApp', '3553dc1de165338f1cd5da2857c2d4a93ee8f6c7a22aa744616e585dbbe862c4', '[\"*\"]', '2025-01-26 18:51:23', '2025-01-26 18:51:23', '2025-01-26 18:51:23'),
(1184, 'App\\Models\\User', 134, 'MyApp', '9f117d26b13647c39cba5207949b2f7bbcab40f6099819d6c80cf343fd4734a2', '[\"*\"]', '2025-01-27 21:37:53', '2025-01-27 21:36:32', '2025-01-27 21:37:53'),
(1185, 'App\\Models\\User', 7, 'MyApp', '5ca15fdce9819825dfafb9a1e325af03fba4f573f60c9b0217030e4a0d7b32b9', '[\"*\"]', '2025-01-27 21:38:26', '2025-01-27 21:38:26', '2025-01-27 21:38:26'),
(1186, 'App\\Models\\User', 134, 'MyApp', '2faa33c3348d99941e22c516b4ff56d307ee74d0b0e5e1d78ba361c5bbdee715', '[\"*\"]', '2025-01-27 22:08:20', '2025-01-27 22:08:20', '2025-01-27 22:08:20'),
(1187, 'App\\Models\\User', 134, 'MyApp', 'c0e4a2a1bee81123b27dc5a58a09732f0741b8d5cc35de18b58c09a753336754', '[\"*\"]', '2025-01-27 22:08:20', '2025-01-27 22:08:20', '2025-01-27 22:08:20'),
(1188, 'App\\Models\\User', 7, 'MyApp', 'beacac82d4252f1fa640a23b7d8082e0af4a69c95e490e096691cc001cf75589', '[\"*\"]', '2025-01-27 22:44:41', '2025-01-27 22:44:41', '2025-01-27 22:44:41'),
(1189, 'App\\Models\\User', 7, 'MyApp', '658619999b970e3626cdb0bfd32df59f266c1f3c83b679656fe9dba04600c50a', '[\"*\"]', NULL, '2025-01-27 22:44:41', '2025-01-27 22:44:41'),
(1190, 'App\\Models\\User', 7, 'MyApp', 'ffe54cd50c471130c7102a1edede378c567e9b782f3d30a3d93f47366d7a3721', '[\"*\"]', NULL, '2025-01-27 22:48:22', '2025-01-27 22:48:22'),
(1191, 'App\\Models\\User', 7, 'MyApp', '7141bfb36987faa23b51104b62a7adea9a272dc3c722dd3d35344cbb07d1ee2d', '[\"*\"]', '2025-01-27 22:48:22', '2025-01-27 22:48:22', '2025-01-27 22:48:22'),
(1192, 'App\\Models\\User', 7, 'MyApp', '6caa6edb6c5ff238b5c3ba38f1044362a8bef484314c8a7e4046326eb8252629', '[\"*\"]', '2025-01-27 22:59:21', '2025-01-27 22:59:21', '2025-01-27 22:59:21'),
(1193, 'App\\Models\\User', 7, 'MyApp', '446dc6d36b82e00244b1ec8eb597a7dcf7941b1b986d89a81160628f2649376d', '[\"*\"]', NULL, '2025-01-27 23:26:56', '2025-01-27 23:26:56'),
(1194, 'App\\Models\\User', 7, 'MyApp', 'b1b65b27cc5ee9ee0f5b8ef74f5546e1d3b2939e4ff1b7f06ed73bcd0583d866', '[\"*\"]', '2025-01-27 23:26:56', '2025-01-27 23:26:56', '2025-01-27 23:26:56'),
(1195, 'App\\Models\\User', 7, 'MyApp', '44129aa5870921a1ad4a3f7f7cf198df9396c651d574110d90ed0009df3b3f6f', '[\"*\"]', '2025-01-27 23:27:25', '2025-01-27 23:27:25', '2025-01-27 23:27:25'),
(1196, 'App\\Models\\User', 7, 'MyApp', '85638b6accfbdc3fb1e9d5dcd72a18b20a58fe2770af813f09e819415063cc44', '[\"*\"]', '2025-01-27 23:27:25', '2025-01-27 23:27:25', '2025-01-27 23:27:25'),
(1197, 'App\\Models\\User', 7, 'MyApp', '115295332b0e4bfc71a27d21dc1a7d95c3a4b997bb74c0a4001fdbef79f436e1', '[\"*\"]', '2025-01-27 23:28:16', '2025-01-27 23:28:16', '2025-01-27 23:28:16'),
(1198, 'App\\Models\\User', 7, 'MyApp', '0f4b66971de8d5b1abd0a95c00e6c2bf66c31ef3e10ca4d7abe6c5358f151a45', '[\"*\"]', '2025-01-27 23:28:16', '2025-01-27 23:28:16', '2025-01-27 23:28:16'),
(1199, 'App\\Models\\User', 7, 'MyApp', 'd143cb6b61922c33e9e8ba303b7f02ce4c8cd4f39effd93a06ea07b633bfdb88', '[\"*\"]', '2025-01-27 23:28:29', '2025-01-27 23:28:28', '2025-01-27 23:28:29'),
(1200, 'App\\Models\\User', 7, 'MyApp', '8d2c10c8284ebe6ac8b51e480f47406f48353c53a12a7977bdadd48c08da4337', '[\"*\"]', '2025-01-27 23:28:29', '2025-01-27 23:28:29', '2025-01-27 23:28:29'),
(1201, 'App\\Models\\User', 7, 'MyApp', '61e9bae039a9f148ee1c637120232488f6e453d594f6a403c959cfd2bef3a615', '[\"*\"]', '2025-01-27 23:30:06', '2025-01-27 23:30:06', '2025-01-27 23:30:06'),
(1202, 'App\\Models\\User', 7, 'MyApp', 'a80aaff4be5f070495651b2368c7e45d5f4a0d407ee173090a01b2b333d1e7c0', '[\"*\"]', '2025-01-27 23:30:06', '2025-01-27 23:30:06', '2025-01-27 23:30:06'),
(1203, 'App\\Models\\User', 7, 'MyApp', '9f4a09d11ed37f949d5b637c44a133621dff4e821e621e8e7547985c800c3d07', '[\"*\"]', '2025-01-27 23:32:55', '2025-01-27 23:32:55', '2025-01-27 23:32:55'),
(1204, 'App\\Models\\User', 7, 'MyApp', '8c80e9dbfa143a363fc08b7f0b77f4d566932e7d287cc5652dfd87feff1c8fd1', '[\"*\"]', '2025-01-27 23:32:55', '2025-01-27 23:32:55', '2025-01-27 23:32:55'),
(1205, 'App\\Models\\User', 7, 'MyApp', '0c4512d845efa0f751c68716047a3defa169c576be08eb5ef8b75bcede45455d', '[\"*\"]', NULL, '2025-01-27 23:41:47', '2025-01-27 23:41:47'),
(1206, 'App\\Models\\User', 7, 'MyApp', '8964b3423e5c6d1e4349a49be1d9599c659dd343e47643e0ee5ff7c7307b32c2', '[\"*\"]', '2025-01-27 23:41:48', '2025-01-27 23:41:47', '2025-01-27 23:41:48'),
(1207, 'App\\Models\\User', 7, 'MyApp', '5c1af3b4684a22dfcaef8059467b549bfa161c006403500f29d0eba27a8fc259', '[\"*\"]', '2025-01-28 00:00:53', '2025-01-27 23:51:51', '2025-01-28 00:00:53'),
(1208, 'App\\Models\\User', 7, 'MyApp', 'c2ecde0d4caebda317d27e39e373227aa9042ba84c39ca64dfff6e837dc9d83c', '[\"*\"]', '2025-01-28 00:15:25', '2025-01-28 00:15:24', '2025-01-28 00:15:25'),
(1209, 'App\\Models\\User', 7, 'MyApp', 'dcafe3e48d4af259c291506f48dfc093145743f8a9aeeb745fe5ef6e2089b3b0', '[\"*\"]', '2025-01-28 00:15:25', '2025-01-28 00:15:24', '2025-01-28 00:15:25'),
(1210, 'App\\Models\\User', 134, 'MyApp', '3f5dc1a62a6f627b8a9009244e0dd13dc67232404177add0f3ff167dd9953c25', '[\"*\"]', '2025-01-28 00:21:18', '2025-01-28 00:21:18', '2025-01-28 00:21:18'),
(1211, 'App\\Models\\User', 134, 'MyApp', 'ad650734c62821e5ed9fd14bdb361c566d3a564e2a4ad430723d50a0561eec69', '[\"*\"]', '2025-01-28 04:45:08', '2025-01-28 04:45:08', '2025-01-28 04:45:08'),
(1212, 'App\\Models\\User', 126, 'MyApp', '73bd7db243beafd3263ecc22246749efffdf0a15b95d4a52a8499ad737babf99', '[\"*\"]', NULL, '2025-01-28 12:39:30', '2025-01-28 12:39:30'),
(1213, 'App\\Models\\User', 126, 'MyApp', '7b3b91051abe8058c73393f668937f4a2423cefa47348a1f4453267269cd3ffc', '[\"*\"]', '2025-01-28 12:39:30', '2025-01-28 12:39:30', '2025-01-28 12:39:30'),
(1214, 'App\\Models\\User', 126, 'MyApp', 'ae8d7d6de93e9f6cf93714ba6f5943ec0f3e171ab460edf903e11770e5742aee', '[\"*\"]', '2025-01-28 12:39:52', '2025-01-28 12:39:51', '2025-01-28 12:39:52'),
(1215, 'App\\Models\\User', 126, 'MyApp', 'b6acb6e08c3779b69c67f32c74fbfe5226f88baa0f099dc78db11325f4e9aad5', '[\"*\"]', '2025-01-28 12:39:58', '2025-01-28 12:39:57', '2025-01-28 12:39:58'),
(1216, 'App\\Models\\User', 7, 'MyApp', '5d740f73e905d8fd955e6f5c8b03d1ec29ea40d6dcb57fc0c936d04e252d2907', '[\"*\"]', '2025-01-28 12:42:31', '2025-01-28 12:42:31', '2025-01-28 12:42:31'),
(1217, 'App\\Models\\User', 7, 'MyApp', '356c186fdccf449fba0599c503867d4be5510c4457058b378aad8c6a769a7b03', '[\"*\"]', '2025-01-28 12:43:38', '2025-01-28 12:43:38', '2025-01-28 12:43:38'),
(1218, 'App\\Models\\User', 7, 'MyApp', '919a3829aca18d57fca0f12a09be0744ecf1de7d1c896641e92cb015f28f0668', '[\"*\"]', '2025-01-28 12:43:39', '2025-01-28 12:43:38', '2025-01-28 12:43:39'),
(1219, 'App\\Models\\User', 135, 'MyApp', 'e720852b2744c4a17fcfe773db585ba35d5e7a310afc651329b84ad85594dd5c', '[\"*\"]', '2025-01-28 12:46:35', '2025-01-28 12:46:35', '2025-01-28 12:46:35'),
(1220, 'App\\Models\\User', 7, 'MyApp', '48faa9a5ebc49266a998fc582687c20561b8ba7138763319ce177174258c3e39', '[\"*\"]', '2025-01-28 14:51:03', '2025-01-28 14:51:03', '2025-01-28 14:51:03'),
(1221, 'App\\Models\\User', 7, 'MyApp', '5d72fae8679b0559cf1eea66ebccfed0f1cb13cecb0007af625ce904afcafcbc', '[\"*\"]', '2025-01-28 15:06:12', '2025-01-28 15:06:12', '2025-01-28 15:06:12'),
(1222, 'App\\Models\\User', 7, 'MyApp', '8c8f9408c708489fe1d798c7d891b19b291768bbcafc91b799d9d0e1ba3b72c3', '[\"*\"]', '2025-01-28 15:06:12', '2025-01-28 15:06:12', '2025-01-28 15:06:12'),
(1223, 'App\\Models\\User', 123, 'MyApp', 'ad3905363a61f2e2a6edb838fff730608395ec19eb54f1738519e50f4ab8dc6a', '[\"*\"]', '2025-01-28 17:27:47', '2025-01-28 17:11:58', '2025-01-28 17:27:47'),
(1224, 'App\\Models\\User', 123, 'MyApp', 'ded6e45aae12d0dcbce6a6d970cca402bcc7f914a634b3146a7df8743c4d7169', '[\"*\"]', '2025-01-28 17:29:37', '2025-01-28 17:29:37', '2025-01-28 17:29:37'),
(1225, 'App\\Models\\User', 123, 'MyApp', '68c425187b20fcb990776b0ba28249003d736b93ea24e36b009596c14b71d7f2', '[\"*\"]', '2025-01-28 17:31:14', '2025-01-28 17:31:13', '2025-01-28 17:31:14'),
(1226, 'App\\Models\\User', 134, 'MyApp', '4a159acd390fd2ef2fb51301ca3bf38f9159570ea5385b587513f8a9e6f3ddc3', '[\"*\"]', '2025-01-28 17:33:41', '2025-01-28 17:33:41', '2025-01-28 17:33:41'),
(1227, 'App\\Models\\User', 123, 'MyApp', '9964e131dcca115e4cf5cebe430d06d69f41bdaa7817dde8acf87085d04db47b', '[\"*\"]', '2025-01-28 17:37:40', '2025-01-28 17:37:40', '2025-01-28 17:37:40'),
(1228, 'App\\Models\\User', 7, 'MyApp', '29f7d64938a0029970d3bedde3830e1f5ad619fe6c9626635e51b630d8d212ad', '[\"*\"]', '2025-01-28 18:20:14', '2025-01-28 18:20:14', '2025-01-28 18:20:14'),
(1229, 'App\\Models\\User', 123, 'MyApp', '0b1a11dba5eb9ae1e647c1d2cce09a2b404f471a7f7b16934f0a5062b59926ac', '[\"*\"]', '2025-01-28 18:37:13', '2025-01-28 18:37:12', '2025-01-28 18:37:13'),
(1230, 'App\\Models\\User', 123, 'MyApp', '5b6bf43159578810241c7b3660cfb4f180cc3174bf79c9ac7820deb3be454d31', '[\"*\"]', '2025-01-28 18:37:50', '2025-01-28 18:37:34', '2025-01-28 18:37:50'),
(1231, 'App\\Models\\User', 123, 'MyApp', 'a44de2a1efd88b51d17bfeaa0ddce3b33f8d6934bf6a751064ee04ab26da7153', '[\"*\"]', '2025-01-28 18:41:48', '2025-01-28 18:41:47', '2025-01-28 18:41:48'),
(1232, 'App\\Models\\User', 123, 'MyApp', 'bb64d5d279344bea5e0dd7ae078f48173306f7d36ad2fa193624642dd0c09d28', '[\"*\"]', '2025-01-28 18:45:10', '2025-01-28 18:45:10', '2025-01-28 18:45:10'),
(1233, 'App\\Models\\User', 123, 'MyApp', '39b474d2553d501ecb5ba06ba5ae2d28585643d5c0df870186e44ebf5dc826e2', '[\"*\"]', '2025-01-28 19:03:56', '2025-01-28 19:03:56', '2025-01-28 19:03:56'),
(1234, 'App\\Models\\User', 123, 'MyApp', '4bfa392b1cc0df351f17cf83cc2f40e2effdae31870967f572642f3fc7ac7aae', '[\"*\"]', '2025-01-28 19:12:41', '2025-01-28 19:12:40', '2025-01-28 19:12:41'),
(1235, 'App\\Models\\User', 123, 'MyApp', 'df8f35987ab3bd26483b49d42945b0aa985f94f0b5e61e494f88e591f5d5d9c2', '[\"*\"]', '2025-01-28 19:16:09', '2025-01-28 19:16:09', '2025-01-28 19:16:09'),
(1236, 'App\\Models\\User', 123, 'MyApp', '102628510dfa7c9eac6b05c5a9e424983879c2aebc216663a500a77def17ba44', '[\"*\"]', '2025-01-28 19:24:44', '2025-01-28 19:24:44', '2025-01-28 19:24:44'),
(1237, 'App\\Models\\User', 123, 'MyApp', '32b107bef4ace88b133818138ea47ba7431e3386aa66261345843862d190643b', '[\"*\"]', '2025-01-28 19:25:27', '2025-01-28 19:25:27', '2025-01-28 19:25:27'),
(1238, 'App\\Models\\User', 123, 'MyApp', 'a6f3929312b56e044f5018bac1177c177637fe4fee5e0617a2012033515f0da0', '[\"*\"]', '2025-01-28 19:37:01', '2025-01-28 19:37:01', '2025-01-28 19:37:01'),
(1239, 'App\\Models\\User', 123, 'MyApp', '20760866e605d7cf51eeae602c337884172114c0bd22985b2d37f589ae1e29e6', '[\"*\"]', '2025-01-28 19:39:00', '2025-01-28 19:39:00', '2025-01-28 19:39:00'),
(1240, 'App\\Models\\User', 123, 'MyApp', '32d71ea885c7e9aa5d7d81c08319b0124d75ea64cfa8682ada1147a3be0fc8e3', '[\"*\"]', '2025-01-28 19:47:43', '2025-01-28 19:47:43', '2025-01-28 19:47:43'),
(1241, 'App\\Models\\User', 123, 'MyApp', 'fd3994411c7f82fb49151f30de9eac1b1827cb7a71f8c16ed4c015e7b8878a09', '[\"*\"]', '2025-01-28 19:53:32', '2025-01-28 19:53:31', '2025-01-28 19:53:32'),
(1242, 'App\\Models\\User', 123, 'MyApp', '2ed1e3655c715c47f4d96601ece7069a2d06d2d470b107922e3d22cfb1f26ead', '[\"*\"]', '2025-01-28 19:55:35', '2025-01-28 19:54:21', '2025-01-28 19:55:35'),
(1243, 'App\\Models\\User', 123, 'MyApp', 'e2f658abf4cb7ee2d12160128d3d246ea7c27445b75f9a22480d69588c258a3d', '[\"*\"]', '2025-01-28 20:07:43', '2025-01-28 20:07:43', '2025-01-28 20:07:43'),
(1244, 'App\\Models\\User', 123, 'MyApp', 'bbae4588c3a4aced625b8a62327b381f7f1d2811421397e6a38ff196734e29c7', '[\"*\"]', '2025-01-28 21:28:05', '2025-01-28 21:27:33', '2025-01-28 21:28:05'),
(1245, 'App\\Models\\User', 123, 'MyApp', 'a4cd40f81107a50b60053cafaee87deaf98a5bc05d56264f0eb94f826753d341', '[\"*\"]', '2025-01-28 22:40:44', '2025-01-28 22:40:44', '2025-01-28 22:40:44'),
(1246, 'App\\Models\\User', 123, 'MyApp', '42fe255f48d576b72f4bcf59f5bee31785e8a7891b892fda9f9709cd7c7c8d6b', '[\"*\"]', '2025-01-28 22:42:52', '2025-01-28 22:42:15', '2025-01-28 22:42:52'),
(1247, 'App\\Models\\User', 123, 'MyApp', '3d87797bc03689408f889535b478dc572ec84070b6d745c769b4c2374521a2e8', '[\"*\"]', '2025-01-28 22:49:55', '2025-01-28 22:49:55', '2025-01-28 22:49:55'),
(1248, 'App\\Models\\User', 123, 'MyApp', '66393ed37bfec270b52ccc7d7143cf6acf000cd4e410108ef7e7a86ba6a3c304', '[\"*\"]', '2025-01-28 22:49:58', '2025-01-28 22:49:58', '2025-01-28 22:49:58'),
(1249, 'App\\Models\\User', 123, 'MyApp', '83fd7b7c7180d1151322e3f7f349eb522f2378411c586a91f1d139d8a95ccdf8', '[\"*\"]', '2025-01-28 23:26:56', '2025-01-28 23:26:56', '2025-01-28 23:26:56'),
(1250, 'App\\Models\\User', 134, 'MyApp', '6f67ac2d2dc08b16384481e68766f07b98fedaa3ca74dbc936dd2ba0781433ee', '[\"*\"]', NULL, '2025-01-28 23:28:14', '2025-01-28 23:28:14'),
(1251, 'App\\Models\\User', 134, 'MyApp', '15750be5ad161afc45b06799c2369a2cc6b359dc843c6b39e8796a4feb13e757', '[\"*\"]', '2025-01-28 23:28:15', '2025-01-28 23:28:14', '2025-01-28 23:28:15'),
(1252, 'App\\Models\\User', 123, 'MyApp', '2fbd81106b41eadd8ac3e55a3a16b284c7019ed01dff7b1ec8d7429551ffe36e', '[\"*\"]', '2025-01-28 23:30:00', '2025-01-28 23:30:00', '2025-01-28 23:30:00'),
(1253, 'App\\Models\\User', 135, 'MyApp', 'ecb6c079b3c75f9fe1283c956a9bcd75fc403ba308d8ea39ccf7805849a9fd5e', '[\"*\"]', '2025-01-28 23:35:59', '2025-01-28 23:35:58', '2025-01-28 23:35:59'),
(1254, 'App\\Models\\User', 135, 'MyApp', 'f6357d9ec704a42deb8dd94e7152c2325055ec418eaae008061951937073e3e7', '[\"*\"]', '2025-01-28 23:50:00', '2025-01-28 23:35:58', '2025-01-28 23:50:00'),
(1255, 'App\\Models\\User', 123, 'MyApp', '7c22e4ffc5ee0e5e54e6ab670016ae56e3b86d53cbe13803b7c79ad6c332f808', '[\"*\"]', '2025-01-28 23:36:36', '2025-01-28 23:36:36', '2025-01-28 23:36:36'),
(1256, 'App\\Models\\User', 123, 'MyApp', 'ed21955c26d17c7fb42d2b05fa4cdde115fd0c57b66c451cc1f653142f1dc2f4', '[\"*\"]', '2025-01-28 23:37:41', '2025-01-28 23:37:41', '2025-01-28 23:37:41'),
(1257, 'App\\Models\\User', 135, 'MyApp', '8bf7f5be50dd04109d2f5475e52c06726568dd8e4f0cd17eec181c1f329fe234', '[\"*\"]', '2025-01-28 23:59:51', '2025-01-28 23:59:51', '2025-01-28 23:59:51'),
(1258, 'App\\Models\\User', 134, 'MyApp', '29fe48a43562acda55054e9ab37e80c49429f79a5105f715077750444c9ddcdf', '[\"*\"]', '2025-01-29 12:19:31', '2025-01-29 12:19:31', '2025-01-29 12:19:31'),
(1259, 'App\\Models\\User', 126, 'MyApp', 'def08354762eabc361a03fa616afa0f919580b5837a15811712f12afa3993b29', '[\"*\"]', '2025-01-29 13:14:39', '2025-01-29 13:14:39', '2025-01-29 13:14:39'),
(1260, 'App\\Models\\User', 126, 'MyApp', '803401fa23082d6a7d3fd541a744952871b50890a437d47f18938cf81ccb6b19', '[\"*\"]', '2025-01-29 13:14:40', '2025-01-29 13:14:40', '2025-01-29 13:14:40'),
(1261, 'App\\Models\\User', 134, 'MyApp', '66880ca48f944442ef94593f56ba80d4bf18fbf34d87d24cbc489ec2aa64f55b', '[\"*\"]', NULL, '2025-01-29 13:25:31', '2025-01-29 13:25:31'),
(1262, 'App\\Models\\User', 134, 'MyApp', 'c42f819c28c6d426ffb9b423c7634f3f61bb62933dadaf3603999f6ed581d985', '[\"*\"]', '2025-01-29 13:50:36', '2025-01-29 13:50:36', '2025-01-29 13:50:36'),
(1263, 'App\\Models\\User', 123, 'MyApp', '9549569c7e0dfffc39b4dabc96b135949cf5cae9ecbf39285ca684b96edecb32', '[\"*\"]', '2025-01-29 14:21:47', '2025-01-29 14:21:47', '2025-01-29 14:21:47'),
(1264, 'App\\Models\\User', 123, 'MyApp', 'b0eca4a58faa2cd10c55cf6da42e1d0bcdd63b89122c24d68680f23dd795115e', '[\"*\"]', '2025-01-29 14:31:51', '2025-01-29 14:31:51', '2025-01-29 14:31:51'),
(1265, 'App\\Models\\User', 134, 'MyApp', '78eba870ec3e65ad2c3ff97295f124358645b4ac6c05da2aed4ee0964bc00be2', '[\"*\"]', '2025-01-29 14:50:08', '2025-01-29 14:50:08', '2025-01-29 14:50:08'),
(1266, 'App\\Models\\User', 126, 'MyApp', 'f5cc1b6599c9a2690ff81d9893c6a923b10232ca01631e893511a955b2c043d2', '[\"*\"]', '2025-01-29 14:54:44', '2025-01-29 14:54:44', '2025-01-29 14:54:44'),
(1267, 'App\\Models\\User', 123, 'MyApp', '8b006a7c7484cab7035d4626dd7523f56c643e1f45769dc136219a30c4017e8a', '[\"*\"]', '2025-01-29 14:55:42', '2025-01-29 14:55:41', '2025-01-29 14:55:42'),
(1268, 'App\\Models\\User', 123, 'MyApp', '53fb6da51256787ecbf19ac6d0ffeb105871d86717527a9e965928eeddd78ede', '[\"*\"]', '2025-01-29 14:56:53', '2025-01-29 14:56:53', '2025-01-29 14:56:53'),
(1269, 'App\\Models\\User', 135, 'MyApp', 'c4d4894f9ed1e09c61084db53a59e327d86e0ce19a5f33aa68abb8db41987e65', '[\"*\"]', '2025-01-29 15:00:35', '2025-01-29 15:00:35', '2025-01-29 15:00:35'),
(1270, 'App\\Models\\User', 142, 'MyApp', 'cb5e208cda6430a15e91a58aa5177373f6becbe64bdac6a01450f0a0fb2c67c0', '[\"*\"]', NULL, '2025-01-29 15:04:47', '2025-01-29 15:04:47'),
(1271, 'App\\Models\\User', 143, 'MyApp', '06a4963d7c7f85c3c2ec58eaa169561fe9e8793668f1249de8cfd868eee8c149', '[\"*\"]', '2025-01-29 15:17:47', '2025-01-29 15:17:47', '2025-01-29 15:17:47'),
(1272, 'App\\Models\\User', 143, 'MyApp', 'f324b3ee605027888887b20d6accf93e22e67e7bd9901771ce87622eab322ab4', '[\"*\"]', '2025-01-29 15:19:25', '2025-01-29 15:19:25', '2025-01-29 15:19:25'),
(1273, 'App\\Models\\User', 143, 'MyApp', '02d72e371e61b5f50ad0f6b659c54fde43104382ba13f5be683cf4d173360ea4', '[\"*\"]', '2025-01-29 15:23:52', '2025-01-29 15:23:51', '2025-01-29 15:23:52'),
(1274, 'App\\Models\\User', 143, 'MyApp', '3b6dccd0af7749cdc6a52a4258c373de052873c4b577252d8b228ce07977c8bb', '[\"*\"]', '2025-01-29 15:23:54', '2025-01-29 15:23:53', '2025-01-29 15:23:54'),
(1275, 'App\\Models\\User', 143, 'MyApp', 'b39e70c636a632903e39b5d23aabf379f95f2b6a0c670fe0fcf1606b1ad6c9d8', '[\"*\"]', '2025-01-29 15:25:16', '2025-01-29 15:25:16', '2025-01-29 15:25:16'),
(1276, 'App\\Models\\User', 143, 'MyApp', '9f639596539d043f8591507d7ab8a24bf334456c1f587a5cfb2059f2798bb61d', '[\"*\"]', '2025-01-29 15:25:48', '2025-01-29 15:25:47', '2025-01-29 15:25:48'),
(1277, 'App\\Models\\User', 144, 'MyApp', 'd74f73e4ac9b76448967c4993dbea74d015d6a9c296b2ffbe3abd4cc4ddacec0', '[\"*\"]', '2025-01-29 15:26:17', '2025-01-29 15:26:16', '2025-01-29 15:26:17'),
(1278, 'App\\Models\\User', 145, 'MyApp', 'fc0b6dcd16c21421779d1154cc07d4b32d1fa84249de8f119c2544a809fbb4ce', '[\"*\"]', '2025-01-29 15:30:59', '2025-01-29 15:30:58', '2025-01-29 15:30:59'),
(1279, 'App\\Models\\User', 145, 'MyApp', '68f089eac1f2b8e9034ffd8b03d7c049fbcf7afbe26584836729ee9501134eb8', '[\"*\"]', '2025-01-29 15:33:03', '2025-01-29 15:33:03', '2025-01-29 15:33:03'),
(1280, 'App\\Models\\User', 123, 'MyApp', '45d2f7571045ad3fb26e73a1af371b2529bd58c9ef78e8e2adad316147d140a8', '[\"*\"]', '2025-01-29 16:00:12', '2025-01-29 16:00:12', '2025-01-29 16:00:12'),
(1281, 'App\\Models\\User', 123, 'MyApp', '9e02d822f754794e62d371869469193b23482362209667b4f8f606ee6bf257cd', '[\"*\"]', '2025-01-29 16:00:49', '2025-01-29 16:00:49', '2025-01-29 16:00:49'),
(1282, 'App\\Models\\User', 123, 'MyApp', 'be3f8d775fbb2fcdf6475e7dc2188395c662f9827a6d09f7643b46903c767470', '[\"*\"]', '2025-01-29 16:06:14', '2025-01-29 16:06:14', '2025-01-29 16:06:14'),
(1283, 'App\\Models\\User', 143, 'MyApp', 'f3fcd4e11579bed82045170f1653522c6d571b0728a08c6a6baadb6359d60757', '[\"*\"]', '2025-01-29 16:09:06', '2025-01-29 16:09:05', '2025-01-29 16:09:06'),
(1284, 'App\\Models\\User', 123, 'MyApp', '7aba7b6ffc2b7fad18913fc51c78850faf1c9872ccdfcafce55f1b26045eb59a', '[\"*\"]', '2025-01-29 16:09:55', '2025-01-29 16:09:55', '2025-01-29 16:09:55'),
(1285, 'App\\Models\\User', 143, 'MyApp', 'bb8c5058628c280a622e36073ef474bdba7c993b26b44d1e2cdb2aba6491fae8', '[\"*\"]', '2025-01-29 16:24:26', '2025-01-29 16:24:25', '2025-01-29 16:24:26'),
(1286, 'App\\Models\\User', 143, 'MyApp', 'a7e9dbd79e34132d5c9dc4472cdee06e102c92f3e252ddf7a466ee759ce34d94', '[\"*\"]', '2025-01-29 16:26:10', '2025-01-29 16:26:09', '2025-01-29 16:26:10'),
(1287, 'App\\Models\\User', 143, 'MyApp', '433da33de958f55adf58ea5b818b697b580f936ba73b0d53d46af4e7b94e6a59', '[\"*\"]', '2025-01-29 16:28:18', '2025-01-29 16:28:18', '2025-01-29 16:28:18'),
(1288, 'App\\Models\\User', 146, 'MyApp', 'a3a10b4bdad9516cc26c0e7ddc7fbc21c4973c694dc0ef3be6d0ed95d3a608e4', '[\"*\"]', '2025-01-29 16:42:15', '2025-01-29 16:42:15', '2025-01-29 16:42:15'),
(1289, 'App\\Models\\User', 143, 'MyApp', 'f693ae6e10c1506f3618074d52d620d4f5d075d91bb2cd28e8797ee616d1f048', '[\"*\"]', '2025-01-29 17:10:23', '2025-01-29 17:10:23', '2025-01-29 17:10:23'),
(1290, 'App\\Models\\User', 143, 'MyApp', 'aead42dda7eea28bcf73d30fa3331a6974da83ab2a4be02b1ace47debe15ded5', '[\"*\"]', '2025-01-29 17:12:49', '2025-01-29 17:12:49', '2025-01-29 17:12:49'),
(1291, 'App\\Models\\User', 143, 'MyApp', '32b604929f22cf734a346b224efefead95da2124227149df0c53767186f57de7', '[\"*\"]', '2025-01-29 17:12:58', '2025-01-29 17:12:57', '2025-01-29 17:12:58'),
(1292, 'App\\Models\\User', 143, 'MyApp', 'd56f35d811bf0c7370cae1b28b39e3eb9ff01ea7711ac2da769f26e444ca2ff9', '[\"*\"]', '2025-01-29 17:12:58', '2025-01-29 17:12:58', '2025-01-29 17:12:58'),
(1293, 'App\\Models\\User', 123, 'MyApp', '70b27e2e5e279ef36176edc2ee5be6ea758ca904bd35871729d1885c0a26b45c', '[\"*\"]', '2025-01-29 17:30:43', '2025-01-29 17:30:43', '2025-01-29 17:30:43'),
(1294, 'App\\Models\\User', 123, 'MyApp', '80e0ba0c4e36149eabb1476f0da4d557c826848e7f3245620d9197d316ab25f2', '[\"*\"]', '2025-01-29 17:36:23', '2025-01-29 17:36:23', '2025-01-29 17:36:23'),
(1295, 'App\\Models\\User', 123, 'MyApp', '4f081ad18155ddafd5a022c4c2501f49d0cf1c3735d6e5c42f018a24e726bff9', '[\"*\"]', '2025-01-29 17:48:35', '2025-01-29 17:48:35', '2025-01-29 17:48:35'),
(1296, 'App\\Models\\User', 123, 'MyApp', '6a35a3b3915a565fc6b3a13ffa79b7d6101a07c180b70452d7c7662f78810516', '[\"*\"]', '2025-01-29 20:56:01', '2025-01-29 20:56:00', '2025-01-29 20:56:01'),
(1297, 'App\\Models\\User', 123, 'MyApp', 'a621b52b9d0e935361f13c4e229366845683823afe531fee51271be8ea5f907e', '[\"*\"]', '2025-01-29 21:02:39', '2025-01-29 21:02:26', '2025-01-29 21:02:39'),
(1298, 'App\\Models\\User', 123, 'MyApp', 'fc3c9a25224e33961c2755ca474a9c1a27700404360dd9d5fefc775b665cfca4', '[\"*\"]', '2025-01-30 03:43:14', '2025-01-30 03:43:14', '2025-01-30 03:43:14'),
(1299, 'App\\Models\\User', 147, 'MyApp', '8afb09de8ac241cfa7495dfc35e98724a345f86f89dd83d4c8dcdea06789306d', '[\"*\"]', '2025-01-30 13:52:09', '2025-01-30 13:52:08', '2025-01-30 13:52:09'),
(1300, 'App\\Models\\User', 148, 'MyApp', '4cb74996f8d1839494e4e015c20f8e58b4a6139cd3c3a31255db99599c0bd9e0', '[\"*\"]', '2025-01-30 13:57:04', '2025-01-30 13:56:41', '2025-01-30 13:57:04'),
(1301, 'App\\Models\\User', 123, 'MyApp', 'b51c69dababa9b9eb111efb99b3e171877e683e2387d3aad6edeb350a32bcd41', '[\"*\"]', '2025-01-30 16:17:03', '2025-01-30 16:17:03', '2025-01-30 16:17:03'),
(1302, 'App\\Models\\User', 149, 'MyApp', '85fbd9c904386964f46e157d0b7edece14c4b99585caa4212ac993fbed21a210', '[\"*\"]', '2025-01-30 16:40:19', '2025-01-30 16:40:19', '2025-01-30 16:40:19'),
(1303, 'App\\Models\\User', 149, 'MyApp', 'd15549a0acf524d98f2339552eebb08d5c765bf0f5893a4bb4eb8f31e24aac5b', '[\"*\"]', '2025-01-30 18:55:59', '2025-01-30 18:55:59', '2025-01-30 18:55:59'),
(1304, 'App\\Models\\User', 149, 'MyApp', 'bf287cc69e85d38390322c8af74a9930b3a47f9817559a6d9fec0dc791a7db72', '[\"*\"]', '2025-01-30 20:41:03', '2025-01-30 20:38:44', '2025-01-30 20:41:03'),
(1305, 'App\\Models\\User', 123, 'MyApp', '4a8ff974c438226a67de2255ddf167308685e286824e82fb39404009e10c7d2f', '[\"*\"]', '2025-01-31 00:04:45', '2025-01-31 00:04:45', '2025-01-31 00:04:45'),
(1306, 'App\\Models\\User', 123, 'MyApp', '0b14c6d568824fe157e31ab3b53b43205da89828c3bfdbb9249e31415239030f', '[\"*\"]', '2025-01-31 03:13:07', '2025-01-31 03:12:55', '2025-01-31 03:13:07'),
(1307, 'App\\Models\\User', 123, 'MyApp', '4c112e05c1ed5ca0855854955a29ddf4acae8c085b168f1be7ecc9236bc7c1de', '[\"*\"]', '2025-01-31 20:10:26', '2025-01-31 20:10:26', '2025-01-31 20:10:26'),
(1308, 'App\\Models\\User', 143, 'MyApp', 'e1c17df18a5aff7cb644bc5c9acc3bf7974ebadb05407ee9d28086a58e14f95a', '[\"*\"]', '2025-01-31 21:21:35', '2025-01-31 21:21:35', '2025-01-31 21:21:35'),
(1309, 'App\\Models\\User', 143, 'MyApp', '3ca18470b638dbdca297dff2eb0975e24e621dfd7fdb5cfc940de60e25cf9fb7', '[\"*\"]', '2025-01-31 21:22:29', '2025-01-31 21:22:29', '2025-01-31 21:22:29'),
(1310, 'App\\Models\\User', 149, 'MyApp', '12a8d91445c2047e94b21a50a457b283709c1e13cae8793d5080618f1a94c4ec', '[\"*\"]', '2025-01-31 21:28:08', '2025-01-31 21:28:08', '2025-01-31 21:28:08'),
(1311, 'App\\Models\\User', 149, 'MyApp', 'c2f2eee535c7f314973db45977a090d771b56569baaf1cb264375829b3273e37', '[\"*\"]', '2025-02-01 02:48:30', '2025-02-01 02:48:17', '2025-02-01 02:48:30'),
(1312, 'App\\Models\\User', 149, 'MyApp', '1c507bc37662ff6fe29fbb3edc21d443403aa8eb8f44901b3925a1bc76578bbd', '[\"*\"]', '2025-02-01 17:27:39', '2025-02-01 17:27:37', '2025-02-01 17:27:39'),
(1313, 'App\\Models\\User', 123, 'MyApp', '5601684f6eca5c2745490955fbdb8fbf41cb9953479afd6e35455e5d972e29c9', '[\"*\"]', '2025-02-01 17:31:41', '2025-02-01 17:28:07', '2025-02-01 17:31:41'),
(1314, 'App\\Models\\User', 123, 'MyApp', '1b2716ab6fd72ac95af1167c8c9860509c225cb8a37b883edc67106a324f53a4', '[\"*\"]', '2025-02-01 20:37:51', '2025-02-01 20:37:51', '2025-02-01 20:37:51'),
(1315, 'App\\Models\\User', 123, 'MyApp', '16f2af1ec24ea6e5cc6006bb7ec5c33cb24fe7d964c511d468ffab3b13167520', '[\"*\"]', '2025-02-01 21:40:36', '2025-02-01 21:40:36', '2025-02-01 21:40:36'),
(1316, 'App\\Models\\User', 123, 'MyApp', 'f2a4d91587ca578d27135f0cffd8429e57292ed815f2c8b8e5ea36d63614c3d7', '[\"*\"]', '2025-02-01 21:40:44', '2025-02-01 21:40:44', '2025-02-01 21:40:44'),
(1317, 'App\\Models\\User', 123, 'MyApp', 'c425329725ad4f90562ea1c41c2649f80c7bda6871785d2d9c8dbd50b13dd224', '[\"*\"]', '2025-02-01 21:44:07', '2025-02-01 21:44:06', '2025-02-01 21:44:07'),
(1318, 'App\\Models\\User', 123, 'MyApp', '45fee4597cef5180ca8a76a3f8c10c91de4cb63cab2ff2465a8ce0ec6cf06eef', '[\"*\"]', '2025-02-01 21:45:26', '2025-02-01 21:45:26', '2025-02-01 21:45:26'),
(1319, 'App\\Models\\User', 143, 'MyApp', '2ca7d45910067ee285c40923ab73d1f0b807faddf724ccf370c940c329c6c3d6', '[\"*\"]', '2025-02-01 21:54:33', '2025-02-01 21:54:33', '2025-02-01 21:54:33'),
(1320, 'App\\Models\\User', 123, 'MyApp', 'a04205f6416449071cf5b099d5aca32ff9225444b071eee4ac0318f3312525e0', '[\"*\"]', '2025-02-01 23:21:31', '2025-02-01 23:21:31', '2025-02-01 23:21:31'),
(1321, 'App\\Models\\User', 123, 'MyApp', 'b0540e19b589a97195286a62eb8899f9cb4e492e4f602c868f272fb7d852edbe', '[\"*\"]', '2025-02-02 00:37:55', '2025-02-02 00:37:55', '2025-02-02 00:37:55'),
(1322, 'App\\Models\\User', 149, 'MyApp', 'e3843e6837517549d2d225ba17b7208143b583eda9c70732682a6f00f04e6d52', '[\"*\"]', '2025-02-02 00:38:37', '2025-02-02 00:38:15', '2025-02-02 00:38:37'),
(1323, 'App\\Models\\User', 149, 'MyApp', 'a16778eec18a446dab3fc42b31ed5157a2215f5edadab5c4acd3e3c5bfad0537', '[\"*\"]', '2025-02-02 00:39:06', '2025-02-02 00:39:05', '2025-02-02 00:39:06'),
(1324, 'App\\Models\\User', 149, 'MyApp', 'cbf37e4ae09906dd75e08dba20c420a8f5694157763d36fcacd7077553ae2d6b', '[\"*\"]', '2025-02-02 00:43:38', '2025-02-02 00:43:37', '2025-02-02 00:43:38'),
(1325, 'App\\Models\\User', 149, 'MyApp', '8a990fdbde189b4f1772bc80bae112303a9012fcc27fb98e66abbf82ea82f307', '[\"*\"]', '2025-02-02 01:27:37', '2025-02-02 01:27:35', '2025-02-02 01:27:37'),
(1326, 'App\\Models\\User', 123, 'MyApp', 'f3770f8bf9417c27a895ffcf650f2614d23b8e9e65ea59cab499373def6fb045', '[\"*\"]', '2025-02-02 01:28:02', '2025-02-02 01:27:59', '2025-02-02 01:28:02'),
(1327, 'App\\Models\\User', 7, 'MyApp', 'c5da90ad19724a74175571fdde5dd2d170bfd7f3af8a6ac1bda3ec79620bae6d', '[\"*\"]', '2025-02-02 14:22:57', '2025-02-02 14:22:57', '2025-02-02 14:22:57'),
(1328, 'App\\Models\\User', 7, 'MyApp', 'fcf2a362b38f7f427a9a5ba0898d8baf92f80b91c2b07de05676269fba9482f1', '[\"*\"]', '2025-02-02 14:23:05', '2025-02-02 14:23:04', '2025-02-02 14:23:05'),
(1329, 'App\\Models\\User', 145, 'MyApp', '448dd7816c03fce86b1549e3a591f54ea5681047d292157c57bb4ec94c00596f', '[\"*\"]', '2025-02-02 14:31:57', '2025-02-02 14:31:56', '2025-02-02 14:31:57'),
(1330, 'App\\Models\\User', 145, 'MyApp', 'e6be76979079e257a89ece2c6155a341150bae1750ca976ec46a7be2f84dfdfe', '[\"*\"]', '2025-02-02 14:32:19', '2025-02-02 14:32:19', '2025-02-02 14:32:19'),
(1331, 'App\\Models\\User', 7, 'MyApp', '1fa8301fdc92bf4edf11e05d7385558a1bc3350302e7d8ba1a928ea91c0d5939', '[\"*\"]', '2025-02-02 14:37:18', '2025-02-02 14:37:18', '2025-02-02 14:37:18'),
(1332, 'App\\Models\\User', 7, 'MyApp', '4c3c2c104a142b90e3622553227c6a05e4fc1d75cef40e293af4a6c29d667cf0', '[\"*\"]', '2025-02-02 14:41:36', '2025-02-02 14:41:36', '2025-02-02 14:41:36'),
(1333, 'App\\Models\\User', 7, 'MyApp', '68ffe91a5c3140485ad8be2968c32fb01e2ebc6075c8f07dade97afb5a3827b2', '[\"*\"]', '2025-02-02 14:43:45', '2025-02-02 14:43:45', '2025-02-02 14:43:45'),
(1334, 'App\\Models\\User', 7, 'MyApp', 'f09ce6e29d5b44b03fc4c211833a216181709a8814abadb80b8fb88d526bf295', '[\"*\"]', '2025-02-02 14:45:48', '2025-02-02 14:45:48', '2025-02-02 14:45:48'),
(1335, 'App\\Models\\User', 7, 'MyApp', '1fe068c6346b213693e344e9ee7be1f5507251335089bfadc88ecd081a73b506', '[\"*\"]', '2025-02-02 16:15:49', '2025-02-02 16:15:48', '2025-02-02 16:15:49'),
(1336, 'App\\Models\\User', 7, 'MyApp', '052745a2bcd7d417109d7b1c8eda0c08a882803f8b6233e8bc0885eefd4a21b2', '[\"*\"]', NULL, '2025-02-02 17:15:38', '2025-02-02 17:15:38'),
(1337, 'App\\Models\\User', 7, 'MyApp', '464043ff977ec4de9c0825219d229ebf1fa8bad13b82d017e637c69c5e7a89eb', '[\"*\"]', '2025-02-02 17:15:38', '2025-02-02 17:15:38', '2025-02-02 17:15:38'),
(1338, 'App\\Models\\User', 7, 'MyApp', 'a21266c519ee1172e3952092c1cbb6f83b58de7896a41804fc0e6070eeb3c626', '[\"*\"]', '2025-02-02 17:21:35', '2025-02-02 17:19:00', '2025-02-02 17:21:35'),
(1339, 'App\\Models\\User', 143, 'MyApp', '1f01984a4e25448350eef6fb958b3379a2bee94ddeff06a0ea518c157c7ecae8', '[\"*\"]', '2025-02-02 17:53:41', '2025-02-02 17:26:00', '2025-02-02 17:53:41'),
(1340, 'App\\Models\\User', 7, 'MyApp', 'e79439f55f97c923d8d2800a22ff628d99776345e32da8291c485ef2531b1af0', '[\"*\"]', '2025-02-02 19:41:29', '2025-02-02 19:41:29', '2025-02-02 19:41:29'),
(1341, 'App\\Models\\User', 7, 'MyApp', 'a3c1b04898f9e6db6a8ea2377ce373765b891b53591c95608e3270bc8ed1015a', '[\"*\"]', '2025-02-02 19:42:50', '2025-02-02 19:42:50', '2025-02-02 19:42:50'),
(1342, 'App\\Models\\User', 7, 'MyApp', '46552c37b4c53d8849b090f2e896f21036d865fc2fecedc60e4497c6b7a64852', '[\"*\"]', '2025-02-02 20:00:04', '2025-02-02 19:42:55', '2025-02-02 20:00:04'),
(1343, 'App\\Models\\User', 7, 'MyApp', '45bba18634ba8b835a1c43fcdb600123fc61ff8a27e21e537930065d908ffcc6', '[\"*\"]', '2025-02-02 20:00:27', '2025-02-02 20:00:27', '2025-02-02 20:00:27'),
(1344, 'App\\Models\\User', 7, 'MyApp', '2b6500abf41b7ccd3f92535357d8846985294f2be53f11a20b38e0c0e4daa30d', '[\"*\"]', '2025-02-02 20:01:01', '2025-02-02 20:01:01', '2025-02-02 20:01:01'),
(1345, 'App\\Models\\User', 7, 'MyApp', '33f552e1fa419b6a874b340e0501c057dc7e886d96c4f346c2cee02014a73021', '[\"*\"]', '2025-02-02 20:01:01', '2025-02-02 20:01:01', '2025-02-02 20:01:01'),
(1346, 'App\\Models\\User', 7, 'MyApp', 'e8540dc46fd3cbb039b6ac8dda474984fc81866b2ef86de61ddbcdfa0016ac6d', '[\"*\"]', '2025-02-02 20:01:15', '2025-02-02 20:01:15', '2025-02-02 20:01:15'),
(1347, 'App\\Models\\User', 7, 'MyApp', 'e0e85b67f6d222a83ed57c4669bb4440972b99da2fdf63dd87141f0c759c106d', '[\"*\"]', '2025-02-02 20:01:16', '2025-02-02 20:01:16', '2025-02-02 20:01:16'),
(1348, 'App\\Models\\User', 7, 'MyApp', '42509b3e3c04a91981d55aa30d30c02f10b374c056c3e5a09284a92a9f8e73f8', '[\"*\"]', '2025-02-02 20:25:07', '2025-02-02 20:25:06', '2025-02-02 20:25:07'),
(1349, 'App\\Models\\User', 7, 'MyApp', '664772be07173de2f9b770aa6b2341494def5e24421eac73c19f2c0fce5794a3', '[\"*\"]', '2025-02-02 20:25:09', '2025-02-02 20:25:08', '2025-02-02 20:25:09'),
(1350, 'App\\Models\\User', 7, 'MyApp', '57fd6edec66936e150cb2d8a1b7ae54839cfc1999dd8a8b34e3005ceb2fe826e', '[\"*\"]', '2025-02-02 20:25:16', '2025-02-02 20:25:15', '2025-02-02 20:25:16'),
(1351, 'App\\Models\\User', 7, 'MyApp', '823fe21190be2cc857ddd6ffd7a05923790a0ade859c74b40f6a470760011035', '[\"*\"]', '2025-02-02 20:25:23', '2025-02-02 20:25:23', '2025-02-02 20:25:23'),
(1352, 'App\\Models\\User', 143, 'MyApp', 'e4cfde9227dd828e6157a230cce1b492969a644e546ac00e13e345fe3488e7d9', '[\"*\"]', '2025-02-02 20:26:14', '2025-02-02 20:26:14', '2025-02-02 20:26:14'),
(1353, 'App\\Models\\User', 143, 'MyApp', '8231e18b4be045ff72517ba182b6d19ca2327245ce2eba6f0f3d3b0d92734a5a', '[\"*\"]', '2025-02-02 20:26:35', '2025-02-02 20:26:35', '2025-02-02 20:26:35'),
(1354, 'App\\Models\\User', 7, 'MyApp', '46c222b31e7b2673292c18349187ef485274e49acbeb01049ad2f47cb472e595', '[\"*\"]', '2025-02-02 20:27:20', '2025-02-02 20:27:20', '2025-02-02 20:27:20'),
(1355, 'App\\Models\\User', 143, 'MyApp', '1e04a7a1e01d88c73acf3a54c658e12899b79cf0ca0acc33c4b6b0030bf28b38', '[\"*\"]', '2025-02-02 20:31:52', '2025-02-02 20:31:52', '2025-02-02 20:31:52'),
(1356, 'App\\Models\\User', 143, 'MyApp', '1aff7bcbf37525027642370f5bc15e31c097d91cc09581082db4379619b4e196', '[\"*\"]', '2025-02-02 20:32:50', '2025-02-02 20:32:50', '2025-02-02 20:32:50'),
(1357, 'App\\Models\\User', 143, 'MyApp', '5f14316247a15b211f758f1af743926845b0a2f3578d6b11b0d76e696221e71f', '[\"*\"]', '2025-02-02 21:40:37', '2025-02-02 21:40:04', '2025-02-02 21:40:37'),
(1358, 'App\\Models\\User', 143, 'MyApp', 'd2721208ec7750cfe8371f35c2035361992301bf35b4b5e2f0428cf4b6bf5491', '[\"*\"]', '2025-02-02 21:40:47', '2025-02-02 21:40:47', '2025-02-02 21:40:47'),
(1359, 'App\\Models\\User', 143, 'MyApp', 'a3c6957d54fcce567413c6170d1e1286e54d532fb234d93bc2188c739b67a345', '[\"*\"]', '2025-02-02 21:42:13', '2025-02-02 21:40:47', '2025-02-02 21:42:13'),
(1360, 'App\\Models\\User', 143, 'MyApp', 'd398b8dbf0c1b79edb43a348c718aa404641bcc13f79ecec39114e309a493840', '[\"*\"]', '2025-02-02 21:42:55', '2025-02-02 21:42:55', '2025-02-02 21:42:55'),
(1361, 'App\\Models\\User', 143, 'MyApp', '9d8e490b2e2cc5dfb65de86e6e9140958b2f707d12cab2a89a331c7ee46a5570', '[\"*\"]', '2025-02-02 21:42:55', '2025-02-02 21:42:55', '2025-02-02 21:42:55'),
(1362, 'App\\Models\\User', 113, 'MyApp', 'c591a9cdc2ee4922dfecabd9400a5c95aaab03e2ad95723eda667cf3c23595c1', '[\"*\"]', '2025-02-02 21:46:05', '2025-02-02 21:44:44', '2025-02-02 21:46:05'),
(1363, 'App\\Models\\User', 143, 'MyApp', 'ed2674bb3c1ab334a88fc334c4c415eddd948fac9f4d2521d765740f6077ddef', '[\"*\"]', '2025-02-02 23:33:50', '2025-02-02 23:07:21', '2025-02-02 23:33:50'),
(1364, 'App\\Models\\User', 143, 'MyApp', 'e2178520df5a741c6adfd954f171389c01c093646055e9e7aafdf51edc565374', '[\"*\"]', NULL, '2025-02-02 23:08:23', '2025-02-02 23:08:23'),
(1365, 'App\\Models\\User', 143, 'MyApp', '1522fe4f9c533b235917204756ed9619735b8405c00de871157b6e43fbbbca96', '[\"*\"]', '2025-02-02 23:08:24', '2025-02-02 23:08:23', '2025-02-02 23:08:24'),
(1366, 'App\\Models\\User', 143, 'MyApp', 'ab4ef1bcfbce8ca824b56a753e76dfbc4414011c9676fa1974c30078c022357f', '[\"*\"]', '2025-02-02 23:08:24', '2025-02-02 23:08:24', '2025-02-02 23:08:24');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1367, 'App\\Models\\User', 143, 'MyApp', '52d91eed8c6ffc1e60e3d38edeecc008b24d49510231eb0b5ed5807218dd2166', '[\"*\"]', '2025-02-05 18:18:31', '2025-02-02 23:08:25', '2025-02-05 18:18:31'),
(1368, 'App\\Models\\User', 123, 'MyApp', '750f6e8c4dec0623ab73c006e410b5c1754fbc83806173a48a5985e00bdb1346', '[\"*\"]', '2025-02-02 23:10:37', '2025-02-02 23:08:38', '2025-02-02 23:10:37'),
(1369, 'App\\Models\\User', 123, 'MyApp', 'c981ad96d25a5a00501332b3bc92ffc6a402fa839863f486d06575969cec601e', '[\"*\"]', '2025-02-02 23:12:27', '2025-02-02 23:12:27', '2025-02-02 23:12:27'),
(1370, 'App\\Models\\User', 7, 'MyApp', '46bd177860e6a551664ad098f41ecd1178e76ee2a2e297ee4be392083df65ffd', '[\"*\"]', '2025-02-02 23:32:07', '2025-02-02 23:32:07', '2025-02-02 23:32:07'),
(1371, 'App\\Models\\User', 143, 'MyApp', '140e489675f05bb4801fc1f38c4a11fd9a636f1bd658d773cd38d215c2c6dc5a', '[\"*\"]', '2025-02-02 23:32:28', '2025-02-02 23:32:28', '2025-02-02 23:32:28'),
(1372, 'App\\Models\\User', 143, 'MyApp', 'b3610bb4c550220b687b9ec5c66a73dd9da036f6cf6842ccf487033087abec91', '[\"*\"]', '2025-02-02 23:35:19', '2025-02-02 23:35:19', '2025-02-02 23:35:19'),
(1373, 'App\\Models\\User', 145, 'MyApp', 'af459e4373fd5d2adf0090b3ac0341d66d45192666ff731709f871991351a640', '[\"*\"]', '2025-02-02 23:37:15', '2025-02-02 23:37:15', '2025-02-02 23:37:15'),
(1374, 'App\\Models\\User', 123, 'MyApp', '16681519a6ee3c2e94237b0b429b7ae86e9a01c2e2bb34b747910d2690ac7e1d', '[\"*\"]', '2025-02-03 01:02:42', '2025-02-03 01:02:42', '2025-02-03 01:02:42'),
(1375, 'App\\Models\\User', 123, 'MyApp', '81a840c6781960942efcaabc5a4b31f09a0f111fed069e985aea3f31b90c20b6', '[\"*\"]', '2025-02-03 01:17:05', '2025-02-03 01:17:05', '2025-02-03 01:17:05'),
(1376, 'App\\Models\\User', 123, 'MyApp', '97ec476d71ab003787581fed1800161be23b0996e26dd7df86157fee1a8c5d79', '[\"*\"]', '2025-02-03 01:31:17', '2025-02-03 01:31:16', '2025-02-03 01:31:17'),
(1377, 'App\\Models\\User', 143, 'MyApp', '184710acb7810571ec5282626ccac76e28901ddc25b2752286571fc7626bd353', '[\"*\"]', '2025-02-03 01:37:12', '2025-02-03 01:37:11', '2025-02-03 01:37:12'),
(1378, 'App\\Models\\User', 143, 'MyApp', '65975f18b645049319ab57185965386745597ce38ce00ae4c1c69d17e6d74c9d', '[\"*\"]', '2025-02-05 18:13:49', '2025-02-03 01:37:25', '2025-02-05 18:13:49'),
(1379, 'App\\Models\\User', 123, 'MyApp', 'e9cf9439eac2c0095bdb099402bbd79349239672bf5ebd1089a0841fdc9764cf', '[\"*\"]', '2025-02-03 01:42:41', '2025-02-03 01:42:41', '2025-02-03 01:42:41'),
(1380, 'App\\Models\\User', 123, 'MyApp', '050bfba1759b3d4825525387edcbaac3e102be70692767f7cf0024258011997f', '[\"*\"]', '2025-02-03 01:45:32', '2025-02-03 01:45:32', '2025-02-03 01:45:32'),
(1381, 'App\\Models\\User', 123, 'MyApp', '973b09629d03820f9ed4d0b0fa217fffa060c36ceca8a6d22788925da56e9ed6', '[\"*\"]', '2025-02-03 01:51:09', '2025-02-03 01:51:09', '2025-02-03 01:51:09'),
(1382, 'App\\Models\\User', 7, 'MyApp', '0ac211a05254c1ca40053ae71a9fc16ea7195d29ddf882b967046857a1f98358', '[\"*\"]', '2025-02-03 14:36:37', '2025-02-03 14:36:37', '2025-02-03 14:36:37'),
(1383, 'App\\Models\\User', 7, 'MyApp', 'a96f4be18c6cba3a63a60b326a49318af7383f660e3f26d1619e1f90326ec85d', '[\"*\"]', '2025-02-03 14:39:53', '2025-02-03 14:39:53', '2025-02-03 14:39:53'),
(1384, 'App\\Models\\User', 7, 'MyApp', 'b65cb4575ae5579aa158b01422aa039e3e8503cce39257407c618deda9a882cd', '[\"*\"]', '2025-02-03 14:46:11', '2025-02-03 14:46:11', '2025-02-03 14:46:11'),
(1385, 'App\\Models\\User', 7, 'MyApp', '33789c3da7f0b353016b9b5a7e119f691511f33939d97dbec8ee2e34414b293e', '[\"*\"]', '2025-02-03 14:46:12', '2025-02-03 14:46:12', '2025-02-03 14:46:12'),
(1386, 'App\\Models\\User', 7, 'MyApp', '7106f353a21d11489efbfa56d96a9ff646101967dfa28b0daa80727cec026a8f', '[\"*\"]', '2025-02-03 14:47:57', '2025-02-03 14:47:36', '2025-02-03 14:47:57'),
(1387, 'App\\Models\\User', 7, 'MyApp', '05816c08d22d0652aa46a84b5ba6a5466ad1b16eb0173b9c5bb5bef9d731f442', '[\"*\"]', '2025-02-03 14:55:23', '2025-02-03 14:55:19', '2025-02-03 14:55:23'),
(1388, 'App\\Models\\User', 7, 'MyApp', '368b16f65383ed5f068c9cffa8fc7067d5b77161137b14f6f2b13df278f4c178', '[\"*\"]', '2025-02-03 14:55:54', '2025-02-03 14:55:32', '2025-02-03 14:55:54'),
(1389, 'App\\Models\\User', 7, 'MyApp', '2c21833cfec84486717781ef3d9a59d204d19f3128a958773c8ec169cabfb6a9', '[\"*\"]', '2025-02-03 14:57:54', '2025-02-03 14:57:28', '2025-02-03 14:57:54'),
(1390, 'App\\Models\\User', 7, 'MyApp', 'a674d1f58de4d664beb2cdc01eee1bafbe50ba2332296a35e7c43f47b215af9e', '[\"*\"]', '2025-02-03 14:58:13', '2025-02-03 14:58:12', '2025-02-03 14:58:13'),
(1391, 'App\\Models\\User', 7, 'MyApp', '39c8601cae394be8a311ce4da97ad189efda44d1dd60369a45058e48e3ff888d', '[\"*\"]', '2025-02-03 14:59:43', '2025-02-03 14:59:40', '2025-02-03 14:59:43'),
(1392, 'App\\Models\\User', 7, 'MyApp', '555c59e790e4f231c1e6232fbd902782db595e4196effbec6f70a82106f645bf', '[\"*\"]', '2025-02-03 15:01:52', '2025-02-03 15:01:52', '2025-02-03 15:01:52'),
(1393, 'App\\Models\\User', 7, 'MyApp', '85b6ceecfd7b1e04eb35847d1fa3f5233c1e227dcdba0467806b8ffb3b9a7c76', '[\"*\"]', '2025-02-03 15:01:54', '2025-02-03 15:01:53', '2025-02-03 15:01:54'),
(1394, 'App\\Models\\User', 7, 'MyApp', 'aabcf1cc1f0cdcf924cb7476426e64c8f9382628776a4eeb356a7f28c028d7e0', '[\"*\"]', '2025-02-03 16:24:47', '2025-02-03 16:24:46', '2025-02-03 16:24:47'),
(1395, 'App\\Models\\User', 7, 'MyApp', '190435a84018a38b7076df1d4355095375d33d050a64b9548dc58a4942ffeb8a', '[\"*\"]', '2025-02-03 16:35:25', '2025-02-03 16:35:25', '2025-02-03 16:35:25'),
(1396, 'App\\Models\\User', 7, 'MyApp', 'fdb3f13e6d8d799a6d8b234a0cf95042399a6ab9ddf8fb7384e59edc52c67641', '[\"*\"]', '2025-02-03 16:45:32', '2025-02-03 16:45:32', '2025-02-03 16:45:32'),
(1397, 'App\\Models\\User', 7, 'MyApp', '6d3d77dfe5f8d67f5e05216a02f3dd6f8727697d9ab7573c0cd4387fd2f3fe3d', '[\"*\"]', '2025-02-03 16:45:36', '2025-02-03 16:45:35', '2025-02-03 16:45:36'),
(1398, 'App\\Models\\User', 123, 'MyApp', 'c4bc6e0e9f81d12efb855c3616aa47cf05b4f90325f06a577ff9c1bb16513dc2', '[\"*\"]', '2025-02-03 17:17:53', '2025-02-03 17:17:53', '2025-02-03 17:17:53'),
(1399, 'App\\Models\\User', 7, 'MyApp', 'f9c3fb3cc3fa148f1c5d55679ab131dd32d911f9b91eeccbe7469b1961e78dfc', '[\"*\"]', '2025-02-03 17:29:02', '2025-02-03 17:29:02', '2025-02-03 17:29:02'),
(1400, 'App\\Models\\User', 7, 'MyApp', 'c8fa19db80c0ac49774a5493077b53a608fade6f934f582f868607f465a6a2bb', '[\"*\"]', '2025-02-03 17:33:48', '2025-02-03 17:33:46', '2025-02-03 17:33:48'),
(1401, 'App\\Models\\User', 7, 'MyApp', '0124289dad0c7201ab1a08c99cdfb63039a584e6fbf09d178283a7ff30760a7e', '[\"*\"]', '2025-02-03 18:02:14', '2025-02-03 18:01:01', '2025-02-03 18:02:14'),
(1402, 'App\\Models\\User', 123, 'MyApp', '42e7a49f5582af0886549d96f5a3f3b45e5ee871f87dac17224c9692cffaf649', '[\"*\"]', '2025-02-03 19:25:19', '2025-02-03 19:25:19', '2025-02-03 19:25:19'),
(1403, 'App\\Models\\User', 123, 'MyApp', 'c728c8cc50e668880a1945324afe589d734cec39ff2c092144803c317190c1f5', '[\"*\"]', '2025-02-03 19:58:24', '2025-02-03 19:58:24', '2025-02-03 19:58:24'),
(1404, 'App\\Models\\User', 143, 'MyApp', '404bae8ad753721b654df134cb9a4d78c7f07bc7683e2078347f93f5ec96b2a9', '[\"*\"]', '2025-02-04 12:35:03', '2025-02-04 11:47:16', '2025-02-04 12:35:03'),
(1405, 'App\\Models\\User', 143, 'MyApp', 'c75b61a641e2ac70a24955353bb6e2d7727c2f72d55f9131b9297480726fedb5', '[\"*\"]', NULL, '2025-02-04 12:32:02', '2025-02-04 12:32:02'),
(1406, 'App\\Models\\User', 143, 'MyApp', '5d8f8a0d2fbfc84d71877eb7d939265b9f03af267359a1136f0540811e34e43c', '[\"*\"]', NULL, '2025-02-04 12:35:00', '2025-02-04 12:35:00'),
(1407, 'App\\Models\\User', 143, 'MyApp', '04809209c38396c7d4f220813a422df076f252bfdeea7288cb09169009488680', '[\"*\"]', NULL, '2025-02-04 12:35:03', '2025-02-04 12:35:03'),
(1408, 'App\\Models\\User', 123, 'MyApp', '0a356de5353c3a2b94f89db67e283ce7105e7c0cc8df54b7ab1223df72616917', '[\"*\"]', '2025-02-04 12:54:26', '2025-02-04 12:54:26', '2025-02-04 12:54:26'),
(1409, 'App\\Models\\User', 123, 'MyApp', '4ae72720fb839c816683a2a6e814eb441c099683890cfd6d08d6730f59519b1e', '[\"*\"]', '2025-02-04 16:30:53', '2025-02-04 16:30:53', '2025-02-04 16:30:53'),
(1410, 'App\\Models\\User', 123, 'MyApp', '9f933550ce59ecf8e3166a2cfdaa57dd87e84b66b001bdef06ea58337ffc04e0', '[\"*\"]', '2025-02-04 23:20:41', '2025-02-04 23:20:40', '2025-02-04 23:20:41'),
(1411, 'App\\Models\\User', 123, 'MyApp', 'cc5a129ac117e2928464509c2a684f5a3d1a0e2ee09b8334199ab693b43c3b7e', '[\"*\"]', '2025-02-05 15:00:31', '2025-02-05 15:00:30', '2025-02-05 15:00:31'),
(1412, 'App\\Models\\User', 123, 'MyApp', '72f85236a6f1e03af621e20feb3dabe4b68a9495ca03a1c236a04b4edeb39a10', '[\"*\"]', '2025-02-05 16:43:48', '2025-02-05 16:43:48', '2025-02-05 16:43:48'),
(1413, 'App\\Models\\User', 149, 'MyApp', '0d626dbad65ad7ca414591d1a77dc198850a38bc8f2b5f0cc2e20e2d2a6dfb23', '[\"*\"]', '2025-02-05 17:00:38', '2025-02-05 16:59:34', '2025-02-05 17:00:38'),
(1414, 'App\\Models\\User', 149, 'MyApp', '7635426170911989e5efe959b4a9d429eb3a70753fa4590021b06bb2200e92c2', '[\"*\"]', '2025-02-05 17:02:37', '2025-02-05 17:02:37', '2025-02-05 17:02:37'),
(1415, 'App\\Models\\User', 149, 'MyApp', 'ab031c544c2c61f415a36d2ac8c2e927b4da534488432ff102b69fb8f5da6ed7', '[\"*\"]', '2025-02-05 17:06:06', '2025-02-05 17:06:06', '2025-02-05 17:06:06'),
(1416, 'App\\Models\\User', 149, 'MyApp', 'efc0f76cee6c5e2ea534636ea52a8a0134de929e96fafdd48bd6287badf13e5f', '[\"*\"]', NULL, '2025-02-05 17:12:50', '2025-02-05 17:12:50'),
(1417, 'App\\Models\\User', 149, 'MyApp', '79f68b404dcce204529b7a5f2e500aaa75fd660c5925c39f109bccbd1c43a2c0', '[\"*\"]', '2025-02-05 17:12:50', '2025-02-05 17:12:50', '2025-02-05 17:12:50'),
(1418, 'App\\Models\\User', 145, 'MyApp', '2dc54864dfdfc35a6fec38c0adbe0a98803c3f92d71489fe3919c434a8e9297b', '[\"*\"]', '2025-02-05 17:24:46', '2025-02-05 17:24:46', '2025-02-05 17:24:46'),
(1419, 'App\\Models\\User', 143, 'MyApp', 'a13c9924d0fdc3c26f4e3b07edea3fe18ec2092d3f35aeac929fa8e67214dd92', '[\"*\"]', NULL, '2025-02-05 18:12:59', '2025-02-05 18:12:59'),
(1420, 'App\\Models\\User', 143, 'MyApp', '430f5e88e3d740799ee6815dd1887accbc39690154704eea8cd6895d58592e13', '[\"*\"]', NULL, '2025-02-05 18:13:06', '2025-02-05 18:13:06'),
(1421, 'App\\Models\\User', 143, 'MyApp', '80269c93f68198ec798b39580ca6ca8d0d1794008550c678b2a236b6067fbaaf', '[\"*\"]', NULL, '2025-02-05 18:13:48', '2025-02-05 18:13:48'),
(1422, 'App\\Models\\User', 143, 'MyApp', '3e5a5d7a8c85bb59449d1d1438b464bca9ee7eac19508a64759382c22c656ca5', '[\"*\"]', NULL, '2025-02-05 18:14:55', '2025-02-05 18:14:55'),
(1423, 'App\\Models\\User', 7, 'MyApp', '4808263976531e32bad682394f3715e000a848eaa889c68a022c126b0530aa68', '[\"*\"]', NULL, '2025-02-05 18:16:15', '2025-02-05 18:16:15'),
(1424, 'App\\Models\\User', 7, 'MyApp', '63454269e6835298038af33a3334c36d33b82dca620ee2f2416247a4e22cefec', '[\"*\"]', NULL, '2025-02-05 18:17:08', '2025-02-05 18:17:08'),
(1425, 'App\\Models\\User', 7, 'MyApp', '41d0cf9058019ecc18750074fccd217e37f1d8cb9fd18cfd228fba4c643af87e', '[\"*\"]', NULL, '2025-02-05 18:17:21', '2025-02-05 18:17:21'),
(1426, 'App\\Models\\User', 7, 'MyApp', '496ed008d5493ca8256f91be7a7e05a1213c2b752dbb7dde50b5ffde5c4c0875', '[\"*\"]', NULL, '2025-02-05 18:18:28', '2025-02-05 18:18:28'),
(1427, 'App\\Models\\User', 143, 'MyApp', '3fedf0c7ff3912f14b50b9be1ad7a9d10d44afd01f9f07e006becc98199e753f', '[\"*\"]', NULL, '2025-02-05 18:18:31', '2025-02-05 18:18:31'),
(1428, 'App\\Models\\User', 7, 'MyApp', '85981d11a3e7a7293d2005584fed459aff717155b90ecb02a50200982c3eb5cf', '[\"*\"]', NULL, '2025-02-05 18:18:46', '2025-02-05 18:18:46'),
(1429, 'App\\Models\\User', 145, 'MyApp', '672021d277b752091d2f87f58a43c894954005f8e8f637c6b356c2f52784a980', '[\"*\"]', '2025-02-05 18:20:12', '2025-02-05 18:20:11', '2025-02-05 18:20:12'),
(1430, 'App\\Models\\User', 7, 'MyApp', '6cc685cb367bc3c712acd7c27ec63d42d701dfcdd7bbfddd557d8a2f96e953a5', '[\"*\"]', '2025-02-05 18:21:00', '2025-02-05 18:20:32', '2025-02-05 18:21:00'),
(1431, 'App\\Models\\User', 143, 'MyApp', '7e16d96ae8306a1bf3521d1ad21170cc71af5661bb5b0e9fa18998fc44b86ea8', '[\"*\"]', NULL, '2025-02-05 18:20:55', '2025-02-05 18:20:55'),
(1432, 'App\\Models\\User', 7, 'MyApp', '9c5d759f519d54942a673324a7ee72918fe6f68fb6543896d80bbd547f74c5f0', '[\"*\"]', NULL, '2025-02-05 18:21:00', '2025-02-05 18:21:00'),
(1433, 'App\\Models\\User', 7, 'MyApp', 'b96f0dc0a64090c61372b05713859dbc29afa973b7fc6a57bcab1a64b376d24e', '[\"*\"]', NULL, '2025-02-05 18:21:52', '2025-02-05 18:21:52'),
(1434, 'App\\Models\\User', 7, 'MyApp', '63b5cea20f46a69ea45bbcfe1d245b3842c9b0cd6f79e2e3e8633f2027aab6b4', '[\"*\"]', NULL, '2025-02-05 18:22:07', '2025-02-05 18:22:07'),
(1435, 'App\\Models\\User', 7, 'MyApp', '85e9ead9560aaeb1c5b9abbd4f2f178c3ccded60d71c5f75bf71ee1f7a45e2d4', '[\"*\"]', NULL, '2025-02-05 18:22:09', '2025-02-05 18:22:09'),
(1436, 'App\\Models\\User', 7, 'MyApp', 'b42869c13a45e143228092e589cc3f6bbefc56ded2d715039d24afa980c7d186', '[\"*\"]', NULL, '2025-02-05 18:22:10', '2025-02-05 18:22:10'),
(1437, 'App\\Models\\User', 7, 'MyApp', '5dabf3722d38d779d8f1082bb6f8e7cb7f9b2340b5e081e1c9e72166ffc0942a', '[\"*\"]', NULL, '2025-02-05 18:22:12', '2025-02-05 18:22:12'),
(1438, 'App\\Models\\User', 7, 'MyApp', 'a1cdbc03ea5acaa9568562952e6849c9cd2f7d8092fd8a4fb8cccf54954abeb2', '[\"*\"]', NULL, '2025-02-05 18:22:14', '2025-02-05 18:22:14'),
(1439, 'App\\Models\\User', 7, 'MyApp', '9d3fb8380c04a7ea1faaee8aa2ef8c16b25aba00ac9d33d32cc280bb6a9d6001', '[\"*\"]', NULL, '2025-02-05 18:22:24', '2025-02-05 18:22:24'),
(1440, 'App\\Models\\User', 7, 'MyApp', '50c63fa1e2df77123004a7353160dbb224a759c4b6ba6935ce854ff838ecbdea', '[\"*\"]', NULL, '2025-02-05 18:23:04', '2025-02-05 18:23:04'),
(1441, 'App\\Models\\User', 7, 'MyApp', 'b14ba59ee3676e2e3f805489efa4bc04570d6fa53891632238edd4e30d8de32b', '[\"*\"]', NULL, '2025-02-05 18:23:07', '2025-02-05 18:23:07'),
(1442, 'App\\Models\\User', 7, 'MyApp', '12e06180c21c80463bfa13299a3ab75fcc43a48b8e23eaea84ebc542da4e3d7f', '[\"*\"]', NULL, '2025-02-05 18:23:08', '2025-02-05 18:23:08'),
(1443, 'App\\Models\\User', 7, 'MyApp', 'd347009cdc999b02bdebd3e1e8243b4472a9d6bd3485909bdbf9ee7871a79660', '[\"*\"]', NULL, '2025-02-05 18:23:10', '2025-02-05 18:23:10'),
(1444, 'App\\Models\\User', 7, 'MyApp', 'aa46664c01063eacd46644eaf748bb521896210f7f8683e9a9b57f72bb981112', '[\"*\"]', NULL, '2025-02-05 18:23:11', '2025-02-05 18:23:11'),
(1445, 'App\\Models\\User', 7, 'MyApp', 'd8255d6463473e56ba64041cef19250f688e3de23e8e778657ff7373998a3a83', '[\"*\"]', NULL, '2025-02-05 18:23:12', '2025-02-05 18:23:12'),
(1446, 'App\\Models\\User', 7, 'MyApp', '54c0918ed30faa58bb63e4a2df886dede6a35d74a41dda59649c721639f73647', '[\"*\"]', NULL, '2025-02-05 18:24:02', '2025-02-05 18:24:02'),
(1447, 'App\\Models\\User', 7, 'MyApp', '8c95dc5fc32632cb2bd23acc5bc6a7fafcfcedb28fb7dc237d1739f00d6a4d21', '[\"*\"]', NULL, '2025-02-05 18:24:46', '2025-02-05 18:24:46'),
(1448, 'App\\Models\\User', 7, 'MyApp', 'cc8941dd449ca42388bb1d6a192c666d4ba62de06d9e939570a4a74e0ac5f568', '[\"*\"]', NULL, '2025-02-05 18:25:54', '2025-02-05 18:25:54'),
(1449, 'App\\Models\\User', 7, 'MyApp', '3ee1bc8bba6d41872bf6279dce13949dbfa3f7f0e5c52659993575d8035cd755', '[\"*\"]', NULL, '2025-02-05 18:26:23', '2025-02-05 18:26:23'),
(1450, 'App\\Models\\User', 7, 'MyApp', '2cf2cec8a9a1800d1e52c090aa84ff02c02d341faa5cccf4ff120b0851f69476', '[\"*\"]', NULL, '2025-02-05 18:32:00', '2025-02-05 18:32:00'),
(1451, 'App\\Models\\User', 7, 'MyApp', 'fac1232d4ecc0b6bcec15ab2f2268706b9cbf30210ad685b6a0b0045794a3df3', '[\"*\"]', NULL, '2025-02-05 18:32:30', '2025-02-05 18:32:30'),
(1452, 'App\\Models\\User', 7, 'MyApp', 'eaf6de79fc68142b333f0b28024a46ff1a33e28359d787a455e074d8989cf136', '[\"*\"]', '2025-02-05 18:33:10', '2025-02-05 18:33:06', '2025-02-05 18:33:10'),
(1453, 'App\\Models\\User', 7, 'MyApp', '41d9b5dfc52a2aebe66afeb96c4cfc8a5f6af2938e438459b6f7a364f14fb69d', '[\"*\"]', '2025-02-05 18:37:58', '2025-02-05 18:37:43', '2025-02-05 18:37:58'),
(1454, 'App\\Models\\User', 7, 'MyApp', '4d4c512fba3397bb4f41aeff2e27c18f649efd91d68dbef25e8a4d71ec04855d', '[\"*\"]', '2025-02-05 18:39:48', '2025-02-05 18:39:47', '2025-02-05 18:39:48'),
(1455, 'App\\Models\\User', 7, 'MyApp', '096bb51220edec16b2a14b2723e252c36e4114b273a3760ee21b03e4be7350f3', '[\"*\"]', '2025-02-05 19:30:36', '2025-02-05 19:30:33', '2025-02-05 19:30:36'),
(1456, 'App\\Models\\User', 7, 'MyApp', 'f549cbcd418631ad17bc2de3d946be13ca26eee9fd78305ecc47830016c68d05', '[\"*\"]', '2025-02-05 19:56:26', '2025-02-05 19:56:03', '2025-02-05 19:56:26'),
(1457, 'App\\Models\\User', 123, 'MyApp', '637522c915b3148532424f1582c73c4848c7f4d4664d811c8b771a4cbb8d95c4', '[\"*\"]', '2025-02-05 21:26:06', '2025-02-05 21:26:06', '2025-02-05 21:26:06'),
(1458, 'App\\Models\\User', 123, 'MyApp', 'c13a28baa0c62cabffa3e604e1947ba6b6c18a2d90c2e5ceef3d22b0e41903e6', '[\"*\"]', '2025-02-05 21:33:36', '2025-02-05 21:33:36', '2025-02-05 21:33:36'),
(1459, 'App\\Models\\User', 123, 'MyApp', 'bf077a8812147a43f665baec3fa212c6a17770a6b117af92e3eeac7008fe1887', '[\"*\"]', '2025-02-05 21:46:53', '2025-02-05 21:46:43', '2025-02-05 21:46:53'),
(1460, 'App\\Models\\User', 123, 'MyApp', 'a15a8f49abbd4d5989c9b951d7166e30410f060f12725c90684a648e160c59de', '[\"*\"]', '2025-02-05 21:52:08', '2025-02-05 21:52:08', '2025-02-05 21:52:08'),
(1461, 'App\\Models\\User', 123, 'MyApp', '89c41b4251f5102460a887c2a7ea9059e88ef8d2c3e06745ef64c3ef3503c9f4', '[\"*\"]', '2025-02-05 22:02:49', '2025-02-05 22:02:31', '2025-02-05 22:02:49'),
(1462, 'App\\Models\\User', 123, 'MyApp', 'e44281d85fcb033ae6c60024ccf51a542dca28d7b07a120070d48481551aff64', '[\"*\"]', '2025-02-05 22:31:54', '2025-02-05 22:31:54', '2025-02-05 22:31:54'),
(1463, 'App\\Models\\User', 7, 'MyApp', '2e6c5943117e67fd803ae2be66c2fb83c725aa492bd4c411682df8f46bf09c8e', '[\"*\"]', NULL, '2025-02-05 23:28:10', '2025-02-05 23:28:10'),
(1464, 'App\\Models\\User', 7, 'MyApp', '8e41b9cc2cd70283236e50131d88f47e89f3392982226b0aea9aa2b14270e77f', '[\"*\"]', '2025-02-05 23:28:56', '2025-02-05 23:28:10', '2025-02-05 23:28:56'),
(1465, 'App\\Models\\User', 7, 'MyApp', 'b205fe4a6be681031f4435d1ab41def429594b8d6c0022fa438696272bbe36d1', '[\"*\"]', '2025-02-06 00:04:55', '2025-02-06 00:04:30', '2025-02-06 00:04:55'),
(1466, 'App\\Models\\User', 7, 'MyApp', '1e20cd82403671fc3e57fb226bda536857cfcaa650f7f32e139fd4fd457a6e59', '[\"*\"]', '2025-02-06 00:37:42', '2025-02-06 00:37:42', '2025-02-06 00:37:42'),
(1467, 'App\\Models\\User', 123, 'MyApp', '288f2c1c6550b155fc2d0d1ffd0afa4cb6aafbf903e1ccfc1e5ced6f781a33d1', '[\"*\"]', '2025-02-07 00:45:05', '2025-02-07 00:44:51', '2025-02-07 00:45:05'),
(1468, 'App\\Models\\User', 123, 'MyApp', '6e9af2e9760d71383915ef64db6f2176a6bce97f0f2017a3f4d61fb632c80567', '[\"*\"]', '2025-02-07 15:56:59', '2025-02-07 15:56:59', '2025-02-07 15:56:59'),
(1469, 'App\\Models\\User', 123, 'MyApp', '3ede66fbc642d7fe6d0b9e16baaf4d8364d017b307458f2b218cc2ef127750a2', '[\"*\"]', '2025-02-08 17:06:17', '2025-02-08 17:06:17', '2025-02-08 17:06:17'),
(1470, 'App\\Models\\User', 149, 'MyApp', '2cfdd6dbb2d624847e996df2515f118955fa6024b88414878db5bab256baee4a', '[\"*\"]', '2025-02-08 18:07:18', '2025-02-08 18:07:18', '2025-02-08 18:07:18'),
(1471, 'App\\Models\\User', 149, 'MyApp', '171d79e390682590ef8150f73bd91c866816dbb8b83df81872fd3e94c6a7f89b', '[\"*\"]', '2025-02-08 18:08:44', '2025-02-08 18:07:18', '2025-02-08 18:08:44'),
(1472, 'App\\Models\\User', 123, 'MyApp', 'b83601c56f1cc2fd805db329f566823f2193f0cde17661004e8038947b2ee2da', '[\"*\"]', '2025-02-08 18:44:50', '2025-02-08 18:44:50', '2025-02-08 18:44:50'),
(1473, 'App\\Models\\User', 123, 'MyApp', '11c029fe41486697a4ad726634867e9e280324f811813e86ac6c2093b00e66d1', '[\"*\"]', '2025-02-08 19:00:29', '2025-02-08 19:00:28', '2025-02-08 19:00:29'),
(1474, 'App\\Models\\User', 123, 'MyApp', '21d6646bfcd9cb51056bd658557d7c45351db52b8a391ffcb2fd7339eb5011ce', '[\"*\"]', '2025-02-08 20:45:30', '2025-02-08 20:45:30', '2025-02-08 20:45:30'),
(1475, 'App\\Models\\User', 7, 'MyApp', '54b5516265421ad5ac31b78098959d7e731f583ed2145cf0ec4588340bfe8315', '[\"*\"]', '2025-02-08 22:48:24', '2025-02-08 22:47:31', '2025-02-08 22:48:24'),
(1476, 'App\\Models\\User', 7, 'MyApp', '11088e4988b9467de227be365c6f4f32b97100677b7843ff950686ce45175691', '[\"*\"]', NULL, '2025-02-09 04:01:34', '2025-02-09 04:01:34'),
(1477, 'App\\Models\\User', 7, 'MyApp', '24b0d6675f6aac44dd628045cfa8761ac6c08267c5cd1f63b6fe0ab4e7e4a901', '[\"*\"]', '2025-02-09 04:01:34', '2025-02-09 04:01:34', '2025-02-09 04:01:34'),
(1478, 'App\\Models\\User', 7, 'MyApp', 'e1307124135dd5d2d13bd6504d9f771785c7613ba412f0007bebfe5581ec3d28', '[\"*\"]', '2025-02-09 04:01:58', '2025-02-09 04:01:58', '2025-02-09 04:01:58'),
(1479, 'App\\Models\\User', 7, 'MyApp', 'bbf2fd07998b85fe0bb1c14454386e22f2ddb8c332211143138a815bf4fc3b6d', '[\"*\"]', '2025-02-09 05:34:14', '2025-02-09 05:34:14', '2025-02-09 05:34:14'),
(1480, 'App\\Models\\User', 123, 'MyApp', '415a60280be60cf466edc445727e51e8f39669ce969d335becaf8ac2c31f5579', '[\"*\"]', '2025-02-09 14:54:43', '2025-02-09 14:54:43', '2025-02-09 14:54:43'),
(1481, 'App\\Models\\User', 123, 'MyApp', '13bd63c17c1b710cac05dd82d977252cbdd917d5d22659765dabece7c31bf159', '[\"*\"]', '2025-02-09 20:35:16', '2025-02-09 20:35:16', '2025-02-09 20:35:16'),
(1482, 'App\\Models\\User', 123, 'MyApp', '24b2e1882791b65d68e5d4e047ae325dbaceb1ed4c46cfdb7a82e56792224a00', '[\"*\"]', '2025-02-10 23:35:27', '2025-02-10 23:35:27', '2025-02-10 23:35:27'),
(1483, 'App\\Models\\User', 7, 'MyApp', '65a8ac8067b607e63e652834e1bcabc687ae7b367e30bebb2b62e8937e8795ff', '[\"*\"]', '2025-02-11 05:48:08', '2025-02-11 05:48:08', '2025-02-11 05:48:08'),
(1484, 'App\\Models\\User', 7, 'MyApp', '6bb5ae63f3af732f7df542a69547986689f36b0921f8b5a18fb4495215b6ea79', '[\"*\"]', '2025-02-11 05:48:15', '2025-02-11 05:48:15', '2025-02-11 05:48:15'),
(1485, 'App\\Models\\User', 156, 'MyApp', '5aeadb676837edd5ae09fd0feeef3298e1b882cc14c2a538e8b3e8a1806c6c09', '[\"*\"]', '2025-02-12 14:06:28', '2025-02-12 14:06:28', '2025-02-12 14:06:28'),
(1486, 'App\\Models\\User', 123, 'MyApp', '7427850f60c8fc86aff97b4088b8bd04ace685a0d02089e6e1aa0c205dc3e6b7', '[\"*\"]', '2025-02-12 19:17:59', '2025-02-12 19:17:59', '2025-02-12 19:17:59'),
(1487, 'App\\Models\\User', 123, 'MyApp', 'bf17906e6b2c9120bc5cf2551fe541fee144961485b1f1b78ce3472cf14615b9', '[\"*\"]', '2025-02-12 22:33:12', '2025-02-12 22:33:12', '2025-02-12 22:33:12'),
(1488, 'App\\Models\\User', 123, 'MyApp', '56f894368105ac5901b4b804106bdd02762bb86e7673c4982ec6bd7a80121666', '[\"*\"]', '2025-02-13 21:18:13', '2025-02-13 21:09:32', '2025-02-13 21:18:13'),
(1489, 'App\\Models\\User', 123, 'MyApp', '4ac074357072e7fbe5303560a66f8374429c804f4f537869644617da5804106f', '[\"*\"]', '2025-02-13 23:42:32', '2025-02-13 23:42:32', '2025-02-13 23:42:32'),
(1490, 'App\\Models\\User', 123, 'MyApp', 'b1fa629f9685eca5bc04c671036a62e94bdbc87b065f1c662c6d997ff16f4854', '[\"*\"]', '2025-02-14 00:13:28', '2025-02-14 00:13:28', '2025-02-14 00:13:28'),
(1491, 'App\\Models\\User', 123, 'MyApp', '96206c2c0a02ad8de3e6c2c17886f7aa7634e2145e1542360b35b1b60c15f0f0', '[\"*\"]', '2025-02-14 16:43:27', '2025-02-14 16:43:27', '2025-02-14 16:43:27'),
(1492, 'App\\Models\\User', 7, 'MyApp', 'de638bdecc4d06fefb54c5beb8ba5cda9a3a525c217a103d89f281754a1ae569', '[\"*\"]', '2025-02-15 14:47:26', '2025-02-15 14:47:18', '2025-02-15 14:47:26'),
(1493, 'App\\Models\\User', 123, 'MyApp', 'b26df6edc23305cdb953b38d378c10ab7e55e07385a2b7fee657a1ebde368c88', '[\"*\"]', '2025-02-15 14:56:11', '2025-02-15 14:56:11', '2025-02-15 14:56:11'),
(1494, 'App\\Models\\User', 123, 'MyApp', '877c917b113caffa5b5d89be39b622f86e27302847a33149e3067b47139840ce', '[\"*\"]', '2025-02-15 15:18:49', '2025-02-15 15:18:49', '2025-02-15 15:18:49'),
(1495, 'App\\Models\\User', 7, 'MyApp', '6d16f9e9c0e274f4df9eb5f3970448341592572387478d6cdfa8ee3ba6f6ecf9', '[\"*\"]', '2025-02-15 21:33:02', '2025-02-15 21:33:02', '2025-02-15 21:33:02'),
(1496, 'App\\Models\\User', 7, 'MyApp', '2e9a209424f489ab17cb83b7f8754b32f35b137f0e43fcf987194de792f62b07', '[\"*\"]', '2025-02-15 21:33:23', '2025-02-15 21:33:02', '2025-02-15 21:33:23'),
(1497, 'App\\Models\\User', 7, 'MyApp', '99c49336c920658a69bf33992d9e857bd9b9372bef9e0c454623acea28721b44', '[\"*\"]', '2025-02-15 22:02:18', '2025-02-15 22:02:17', '2025-02-15 22:02:18'),
(1498, 'App\\Models\\User', 7, 'MyApp', '716d5214ef7b964e2705a865fcda9272b146f31570b736ab0cde6306c258a0a8', '[\"*\"]', '2025-02-16 00:36:28', '2025-02-16 00:36:27', '2025-02-16 00:36:28'),
(1499, 'App\\Models\\User', 156, 'MyApp', '3dcf440222856e45d73ebdf532a5259431d9cef1ac870e5bc1f4f8997a3b4e38', '[\"*\"]', '2025-02-16 00:48:51', '2025-02-16 00:48:51', '2025-02-16 00:48:51'),
(1500, 'App\\Models\\User', 156, 'MyApp', '873d3b32b52093f02f1dc7bef9e0323dc94b283c5d3aaa69711f23e8611a7f67', '[\"*\"]', NULL, '2025-02-16 00:48:53', '2025-02-16 00:48:53'),
(1501, 'App\\Models\\User', 156, 'MyApp', '6f5593f9715b25235c0587b52fd02aa2f4218183d5c188cad3c0ff0c4535030a', '[\"*\"]', '2025-02-16 00:49:45', '2025-02-16 00:49:45', '2025-02-16 00:49:45'),
(1502, 'App\\Models\\User', 156, 'MyApp', '1b332af490cf103f7a8afe427f903e5ae676f3e0eb88aeb7fdfeafca67796b75', '[\"*\"]', '2025-02-16 00:49:46', '2025-02-16 00:49:45', '2025-02-16 00:49:46'),
(1503, 'App\\Models\\User', 156, 'MyApp', 'ad3b9235cc2e11625fb58ad686debe4235c772efa67823556c963ded18d10f61', '[\"*\"]', '2025-02-16 00:49:56', '2025-02-16 00:49:56', '2025-02-16 00:49:56'),
(1504, 'App\\Models\\User', 156, 'MyApp', 'db04c34c979859817329a41dc7a35d12e946413ace8bd21facce6d9233b2487d', '[\"*\"]', '2025-02-16 00:49:56', '2025-02-16 00:49:56', '2025-02-16 00:49:56'),
(1505, 'App\\Models\\User', 143, 'MyApp', '3ac9b98ea8391f96d594caacdf401a52b86219c5fc58b6ee4ff905d77b3f30b1', '[\"*\"]', '2025-02-16 00:52:53', '2025-02-16 00:52:53', '2025-02-16 00:52:53'),
(1506, 'App\\Models\\User', 7, 'MyApp', 'bbfaaafee80cbe0244c375d50198e58c75c6ee997ea40e4a24d8be26945838a0', '[\"*\"]', '2025-02-16 14:56:23', '2025-02-16 14:43:37', '2025-02-16 14:56:23'),
(1507, 'App\\Models\\User', 7, 'MyApp', '4645f4216b785abdda0456f5e56e58f77a641af90496a8498fba5ae86fa0b182', '[\"*\"]', '2025-02-16 14:57:48', '2025-02-16 14:57:34', '2025-02-16 14:57:48'),
(1508, 'App\\Models\\User', 7, 'MyApp', '9ffc68034eee0b2b6652a7914cc4c698b161e8af15caacdf279c631c0e1fa7df', '[\"*\"]', '2025-02-17 11:36:33', '2025-02-17 11:36:33', '2025-02-17 11:36:33'),
(1509, 'App\\Models\\User', 7, 'MyApp', '4a367150540d4ab5876009fea35bc48c6e49a3ece61e2cb8dc1f55330c2004a9', '[\"*\"]', '2025-02-17 12:14:55', '2025-02-17 12:14:08', '2025-02-17 12:14:55'),
(1510, 'App\\Models\\User', 7, 'MyApp', '887e398cc4cd5134b80f43af1be9d69c78462dc06c0306760a5740734488df79', '[\"*\"]', '2025-02-17 12:34:55', '2025-02-17 12:34:26', '2025-02-17 12:34:55'),
(1511, 'App\\Models\\User', 7, 'MyApp', '349be91557dd5131d28d46644646143902d2552be6cd95c8036ae5a8119d0954', '[\"*\"]', '2025-02-17 17:30:05', '2025-02-17 12:42:42', '2025-02-17 17:30:05'),
(1512, 'App\\Models\\User', 7, 'MyApp', 'd98a5a33e88c2b19bdfe1560392ecd2715ac9d19c7936ca801a8a92b319d27f2', '[\"*\"]', '2025-02-17 14:03:11', '2025-02-17 12:45:30', '2025-02-17 14:03:11'),
(1513, 'App\\Models\\User', 143, 'MyApp', '4d76b1eef2d82bdac59ecd1788580683fa6979f84dacbbe2883f4620e3e16363', '[\"*\"]', '2025-02-17 16:30:31', '2025-02-17 14:08:00', '2025-02-17 16:30:31'),
(1514, 'App\\Models\\User', 7, 'MyApp', 'e04200d124fc271714ce5599a1bf8225d3e54cad11d6ec82f681686c726dccb8', '[\"*\"]', '2025-02-17 15:01:38', '2025-02-17 14:15:19', '2025-02-17 15:01:38'),
(1515, 'App\\Models\\User', 143, 'MyApp', '365cf33160f9cc5693f4fd152274be9ff084f63f940aa5abc97aac4d87990f60', '[\"*\"]', '2025-02-17 14:57:48', '2025-02-17 14:57:15', '2025-02-17 14:57:48'),
(1516, 'App\\Models\\User', 143, 'MyApp', '7b455f29e1a16c2a71099a4a70effe3f6d6c2261fba12df10c59e5e54f02fe38', '[\"*\"]', '2025-02-17 16:03:06', '2025-02-17 15:42:36', '2025-02-17 16:03:06'),
(1517, 'App\\Models\\User', 7, 'MyApp', 'fffdc47a2bb3a7d3718faf011c2cac4ea50ef691fbf61f76fc1a0955c9359a39', '[\"*\"]', '2025-02-17 15:59:15', '2025-02-17 15:44:42', '2025-02-17 15:59:15'),
(1518, 'App\\Models\\User', 7, 'MyApp', 'bc2b86d752d37f6492ad7596f122d85167d15c7a3c78bc6a8666f0794249759e', '[\"*\"]', NULL, '2025-02-17 15:44:42', '2025-02-17 15:44:42'),
(1519, 'App\\Models\\User', 7, 'MyApp', 'd2b729571ee04d1d2c3764be438d568bacd26f6e2163cec562f0590e792856c6', '[\"*\"]', '2025-02-17 16:27:40', '2025-02-17 16:27:39', '2025-02-17 16:27:40'),
(1520, 'App\\Models\\User', 7, 'MyApp', '857b0cd14121b1a33663c5bdf16536bde22c02e55e51bd12ed12b8d084f6ddbf', '[\"*\"]', '2025-02-17 16:27:43', '2025-02-17 16:27:40', '2025-02-17 16:27:43'),
(1521, 'App\\Models\\User', 7, 'MyApp', '13c584fc94861491d78d4b78172e5cef5d2c16945e3a20decb4ecf3685e3a6d6', '[\"*\"]', NULL, '2025-02-17 17:29:45', '2025-02-17 17:29:45'),
(1522, 'App\\Models\\User', 7, 'MyApp', '3e0c8687eb5fdddb6d421f0593cb5aac3a965f0301efc740386ed5707a1dd0dc', '[\"*\"]', '2025-02-17 17:30:53', '2025-02-17 17:29:45', '2025-02-17 17:30:53'),
(1523, 'App\\Models\\User', 7, 'MyApp', 'ea24ab5a28f07e8b7db4180a09fcfe1ee904763b36e711eff201a1f0a907df12', '[\"*\"]', '2025-02-17 17:31:15', '2025-02-17 17:31:15', '2025-02-17 17:31:15'),
(1524, 'App\\Models\\User', 7, 'MyApp', '1440b0734b718e1fa9695cd30cb595509326f134074eaecebe70edee8301f7d7', '[\"*\"]', '2025-02-17 17:31:18', '2025-02-17 17:31:15', '2025-02-17 17:31:18'),
(1525, 'App\\Models\\User', 7, 'MyApp', '36f2c749c988732fa0c3980f7c7222666527e1f185f996881ef1b72be40f0bce', '[\"*\"]', '2025-02-17 17:31:44', '2025-02-17 17:31:44', '2025-02-17 17:31:44'),
(1526, 'App\\Models\\User', 7, 'MyApp', '9e8856d91fcfb4ee0cba26b8fd30332df51e8c6bad7fe59f4fdc5e66ac676666', '[\"*\"]', '2025-02-17 17:31:58', '2025-02-17 17:31:44', '2025-02-17 17:31:58'),
(1527, 'App\\Models\\User', 7, 'MyApp', '8020ec645cdab748d50842bbccd60ef251203fa5593c0d91ca7a038a9229e194', '[\"*\"]', '2025-02-17 17:36:57', '2025-02-17 17:35:52', '2025-02-17 17:36:57'),
(1528, 'App\\Models\\User', 7, 'MyApp', '462c9b3be23d0c1d3c12ba43f9e99ee78ccc75d1f85ddd051aac45f16a2f8e1c', '[\"*\"]', NULL, '2025-02-17 17:35:52', '2025-02-17 17:35:52'),
(1529, 'App\\Models\\User', 7, 'MyApp', '91738ab88c6cd071fc10a658804d46080c4e853b736377c0a9b7528dd0f212fe', '[\"*\"]', '2025-02-17 17:37:56', '2025-02-17 17:37:56', '2025-02-17 17:37:56'),
(1530, 'App\\Models\\User', 7, 'MyApp', '18fd05ecf397dd4fd69ba52c28db1aa2d6330371d1a1480987467ce8a2ed3d81', '[\"*\"]', '2025-02-17 17:38:27', '2025-02-17 17:37:56', '2025-02-17 17:38:27'),
(1531, 'App\\Models\\User', 7, 'MyApp', '2f419f4f486e3527b829d0689b535f50673001558b529709024f39ad9f8414e2', '[\"*\"]', '2025-02-17 17:38:44', '2025-02-17 17:38:44', '2025-02-17 17:38:44'),
(1532, 'App\\Models\\User', 7, 'MyApp', '86c44b5feed61585dce5644df1bd541a7b461acfb572a9d4d3e2673e452bae9a', '[\"*\"]', '2025-02-17 17:40:29', '2025-02-17 17:38:44', '2025-02-17 17:40:29'),
(1533, 'App\\Models\\User', 7, 'MyApp', 'fa194613f6a2ed52857fffaae5d0675851e92b2b52c4e1810002b7f044ac9ed3', '[\"*\"]', '2025-02-17 18:28:59', '2025-02-17 18:22:53', '2025-02-17 18:28:59'),
(1534, 'App\\Models\\User', 143, 'MyApp', '16150331f3e72c83e4c7535bcf52d6d90b06acf5368a56a4c56a66683227a13f', '[\"*\"]', '2025-02-17 18:32:00', '2025-02-17 18:32:00', '2025-02-17 18:32:00'),
(1535, 'App\\Models\\User', 143, 'MyApp', 'a38ddedc43c5f386b2ee4c45dfa8c3af5ce60fc44d3847c6fb9a52bfa5fdc566', '[\"*\"]', '2025-02-17 18:47:07', '2025-02-17 18:46:36', '2025-02-17 18:47:07'),
(1536, 'App\\Models\\User', 7, 'MyApp', '2c4cab20601a7608a256e2e37cd48caafe9bd49012afc1796816b359673f8eca', '[\"*\"]', '2025-02-18 18:31:39', '2025-02-18 18:31:38', '2025-02-18 18:31:39'),
(1537, 'App\\Models\\User', 157, 'MyApp', '791e3a23bb58649663f777c079cac9148d886f4e4ebe718b97e60ef381845502', '[\"*\"]', '2025-02-19 17:37:51', '2025-02-19 17:37:51', '2025-02-19 17:37:51'),
(1538, 'App\\Models\\User', 157, 'MyApp', 'b1e1adfab53a173be36e2c96b2c47b693261bc673b85a6c63786b7b5c60a2da0', '[\"*\"]', '2025-02-19 17:42:10', '2025-02-19 17:37:58', '2025-02-19 17:42:10'),
(1539, 'App\\Models\\User', 7, 'MyApp', '0efa3a82096278d74feaf7a09d30fe55fa9bcf3975537cc39ebe3f56d9dc20b2', '[\"*\"]', '2025-02-19 21:56:54', '2025-02-19 21:56:54', '2025-02-19 21:56:54'),
(1540, 'App\\Models\\User', 7, 'MyApp', 'c96add4dcbe9728b7c580c53fdcd99d35f8599ace0fae71a71c0e92bc27472ef', '[\"*\"]', '2025-02-19 23:19:41', '2025-02-19 23:19:39', '2025-02-19 23:19:41'),
(1541, 'App\\Models\\User', 7, 'MyApp', 'da6b5a8af5fa0acf0ad0f80fe1056171da47d004207ec332780eae84a03cdab1', '[\"*\"]', '2025-02-19 23:44:58', '2025-02-19 23:44:28', '2025-02-19 23:44:58'),
(1542, 'App\\Models\\User', 7, 'MyApp', 'fdc63f16a15843d7e793261cd9e915e2f9871105064503409b6f61d955207820', '[\"*\"]', '2025-02-19 23:50:23', '2025-02-19 23:49:26', '2025-02-19 23:50:23'),
(1543, 'App\\Models\\User', 7, 'MyApp', '7659d6676ff87f2536f73eb82075c7768aee14aebd9e9ba17b5d64d48a8c79d3', '[\"*\"]', '2025-02-19 23:53:16', '2025-02-19 23:51:28', '2025-02-19 23:53:16'),
(1544, 'App\\Models\\User', 7, 'MyApp', 'd67e04d7b2c5d0374e3cbd725a7507e7b550526f5d40c6fa69d1848de029212d', '[\"*\"]', '2025-02-19 23:58:47', '2025-02-19 23:58:15', '2025-02-19 23:58:47'),
(1545, 'App\\Models\\User', 7, 'MyApp', '6f22c58f9a19be47f31561290b7260094e250951b74c87d24f4e775728568967', '[\"*\"]', '2025-02-20 00:00:12', '2025-02-20 00:00:04', '2025-02-20 00:00:12'),
(1546, 'App\\Models\\User', 7, 'MyApp', '36493ec583029bacd0830199752bc388834a63bf4786d7a71eec6c7a826f2f8f', '[\"*\"]', '2025-02-20 00:00:52', '2025-02-20 00:00:29', '2025-02-20 00:00:52'),
(1547, 'App\\Models\\User', 7, 'MyApp', 'd173f465803f47cb6bab5fd0bdd3bb420aa1f7fa1f29ef7eec3e058466a4467e', '[\"*\"]', '2025-02-20 00:05:10', '2025-02-20 00:05:10', '2025-02-20 00:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `regular_availabilities`
--

CREATE TABLE `regular_availabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_interval` int(11) NOT NULL DEFAULT 15,
  `week_day` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
  `slots` text DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regular_availabilities`
--

INSERT INTO `regular_availabilities` (`id`, `time_interval`, `week_day`, `slots`, `hospital_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(1, 15, 'monday', '[{\"start_time\":\"08:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', NULL, 122, '2025-01-22 13:47:00', '2025-01-22 13:47:00'),
(2, 15, 'sunday', '[{\"start_time\":\"08:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', NULL, 122, '2025-01-22 13:47:39', '2025-01-22 13:47:39'),
(3, 15, 'tuesday', '[{\"start_time\":\"08:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', NULL, 122, '2025-01-22 13:48:16', '2025-01-22 13:48:16'),
(4, 15, 'wednesday', '[{\"start_time\":\"08:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', NULL, 122, '2025-01-22 13:49:02', '2025-01-22 13:49:02'),
(5, 15, 'thursday', '[{\"start_time\":\"08:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', NULL, 122, '2025-01-22 13:49:48', '2025-01-22 13:49:48'),
(6, 30, 'tuesday', '[{\"start_time\":\"10:00\",\"end_time\":\"16:00\"},{\"start_time\":\"20:30\",\"end_time\":\"23:00\"}]', NULL, 119, '2025-01-22 17:19:49', '2025-01-22 17:19:58'),
(7, 15, 'saturday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"20:00\"}]', NULL, 122, '2025-01-24 22:36:43', '2025-01-24 22:36:43'),
(8, 30, 'sunday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"20:00\"}]', 5, 121, '2025-01-24 22:38:49', '2025-01-24 22:38:49'),
(9, 30, 'monday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', 5, 121, '2025-01-24 22:39:33', '2025-01-24 22:39:33'),
(10, 30, 'tuesday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"21:00\"}]', 5, 121, '2025-01-24 22:40:12', '2025-01-24 22:40:12'),
(11, 30, 'wednesday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"20:00\"}]', 5, 121, '2025-01-24 22:40:52', '2025-01-24 22:40:52'),
(12, 30, 'thursday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"20:00\"}]', 5, 121, '2025-01-24 22:41:23', '2025-01-24 22:41:23'),
(13, 30, 'saturday', '[{\"start_time\":\"09:00\",\"end_time\":\"12:00\"},{\"start_time\":\"16:00\",\"end_time\":\"20:00\"}]', 5, 121, '2025-01-24 22:42:00', '2025-01-24 22:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED DEFAULT NULL,
  `star_rated` varchar(1) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_body` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `doctor_id`, `hospital_id`, `star_rated`, `review_title`, `review_body`, `created_at`, `updated_at`) VALUES
(1, 7, 119, NULL, '3', 'this is a review', 'this is a review this is a review\r\nthis is a review', '2025-01-22 20:18:42', '2025-01-22 20:18:42'),
(2, 113, 119, NULL, '2', '123', '111 ', '2025-01-22 20:39:27', '2025-01-22 20:39:27'),
(3, 123, 121, 5, '5', 'Professional Doctor', 'Professional Doctor', '2025-01-25 01:21:41', '2025-01-25 01:21:41'),
(4, 113, 130, 3, '3', 'test', 'test', '2025-01-27 22:00:44', '2025-01-27 22:00:44'),
(5, 123, 140, 6, '4', 'Professional Doctor', 'Professional Doctor', '2025-01-28 19:52:56', '2025-01-28 19:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_settings`
--

CREATE TABLE `schedule_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `time_interval` varchar(255) NOT NULL DEFAULT '15',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `service_title`, `created_at`, `updated_at`) VALUES
(1, 3, 'blood test', '2023-09-05 11:58:18', '2023-09-05 11:58:18'),
(2, 3, 'heart checkup', '2023-09-05 11:58:18', '2023-09-05 11:58:18'),
(3, 3, 'ECG', '2023-09-05 11:58:18', '2023-09-05 11:58:18'),
(4, 3, 'dilesis', '2023-09-05 11:58:18', '2023-09-05 11:58:18'),
(5, 71, 'ortho', '2023-10-26 07:05:50', '2023-10-26 07:05:50'),
(6, 8, 'Cardiology', '2024-11-12 17:38:25', '2024-11-12 17:38:25'),
(7, 8, 'Cathlab', '2024-11-12 17:38:25', '2024-11-12 17:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `website_name`, `email`, `phone`, `logo`, `favicon`, `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `country`, `facebook`, `twitter`, `youtube`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'Medical Services Booking system', 'info@arabcares.com', '+966569902444', '', NULL, '4139 Ibn Al Saudi street 23456 Jeddah Saudia Arabia', '4139 Ibn Al Saudi street 23456 Jeddah Saudia Arabia', 'Jeddah', 'Select', '23456', 'Test', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', 'https://app.arabcares.com/#', NULL, '2023-04-07 02:17:05', '2025-01-22 21:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name_en`, `name_ar`, `image`, `created_at`, `updated_at`) VALUES
(1, 'cardiology', 'أمراض القلب', '1694772148-icons8-cardiology-64.png', '2023-04-07 19:09:08', '2023-09-15 10:02:28'),
(2, 'Neurology', 'طب الأعصاب', '1738528649-Neurology.jpg', '2023-04-07 19:11:46', '2025-02-03 01:37:29'),
(3, 'Otolaryngology', 'أنف أذن حنجرة', '1737749815-ENT.png', '2023-04-24 22:22:54', '2025-01-25 01:16:55'),
(4, 'Ophthalmology', 'طب العيون', '1737749762-Obgyn.png', '2023-04-24 22:24:35', '2025-01-25 01:16:02'),
(5, 'Orthopedics', 'جراحة عظام', '1737749627-ortho.png', '2023-04-24 22:25:00', '2025-01-25 01:13:47'),
(6, 'Pulmonology', 'الصدرية', '1737749687-Pulmonology.png', '2023-04-24 22:25:35', '2025-01-25 01:14:47'),
(7, 'OB/Gyne', 'نسائية و توليد', '1737749737-Obgyn.png', '2023-04-24 22:27:42', '2025-01-25 01:15:37'),
(11, 'Dentals', 'طب الاسنان', '1737749593-dental.png', '2023-08-27 09:25:32', '2025-01-25 01:13:13'),
(15, 'Padiatric', 'طب أطفال', '1737748596-Pedia.png', '2023-09-25 07:59:54', '2025-01-25 00:56:36'),
(16, 'Urology', 'مسالك بولية', '1737749546-urology.png', '2023-10-09 16:44:17', '2025-01-25 01:12:26'),
(17, 'Dermatology', 'جلدية', '1737749491-dental.png', '2023-10-10 06:38:16', '2025-01-25 01:11:31'),
(18, 'general surgery', 'جراحة عامة', '1737743242-GS.png', '2023-10-10 06:40:54', '2025-01-24 23:27:22'),
(20, 'Audiology', 'السمعيات', '1738071896-Untitled design.png', '2025-01-28 18:37:07', '2025-01-28 18:44:56'),
(21, 'Rheumatology', 'طب الروماتيزم', '1738526246-Rheumatology.png', '2025-02-03 00:57:26', '2025-02-03 00:57:26'),
(22, 'Nephrologist', 'الأمراض الباطنية والكلى', '1738528367-Nephrologist1.jpg', '2025-02-03 01:24:15', '2025-02-03 01:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unavailabilities`
--

CREATE TABLE `unavailabilities` (
  `date` date DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unavailabilities`
--

INSERT INTO `unavailabilities` (`date`, `hospital_id`, `doctor_id`) VALUES
('2025-01-24', NULL, 122),
('2025-01-31', NULL, 122);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED DEFAULT NULL,
  `speciality_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'placeholder.png',
  `description` text DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `user_type` varchar(1) NOT NULL DEFAULT 'U',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `pricing` float DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '$2y$10$tWQdG8FB6dG0GrZX1HViGu/9FT1NMesTASJkAHAts6p.NoPblugVu',
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) NOT NULL DEFAULT 'UTC',
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hospital_id`, `speciality_id`, `name_en`, `name_ar`, `username`, `profile_image`, `description`, `city_id`, `address`, `country`, `state`, `zip_code`, `date_of_birth`, `gender`, `age`, `blood_group`, `email`, `mobile`, `user_type`, `email_verified_at`, `pricing`, `password`, `twitter`, `facebook`, `linkedin`, `pinterest`, `instagram`, `youtube`, `status`, `remember_token`, `created_at`, `updated_at`, `last_name`, `marital_status`, `emergency_contact_name`, `emergency_contact_number`, `nationality`, `address_line_1`, `address_line_2`, `timezone`, `code`) VALUES
(1, NULL, NULL, 'Admin', 'مسئول', 'admin', '1737562551-logo.jpg', NULL, NULL, 'Cairo', 'Egypt', 'Cairo', '11148', '2001-12-03', 'M', 23, NULL, 'admin@arabcares.com', '00966569902444', 'A', '2025-01-22 00:20:44', NULL, '$2y$10$oBIyWim9QOsqnRZDNaHjBOKwFhFcwSJ/7xmzXs2vE5Ka6AjFG1oNq', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-22 00:20:44', '2025-02-20 00:52:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Africa/Cairo', NULL),
(7, NULL, NULL, 'Mustafa Mohamed Shokry', NULL, NULL, '1739991652_1000076373.jpg', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dijy@info.com', NULL, 'U', NULL, 20, '$2y$10$MYZMbQOqO9SGPxLqyN1SGexXVFIUE5KlOnJRMoeR1/T7QCUQR/zGm', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2023-04-14 01:14:39', '2025-02-20 00:00:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(101, NULL, NULL, 'eslam', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '1999-01-01', NULL, NULL, NULL, 't1@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$TI7Tn4U7z3MdR5IlIMlQHepk3HtD0v/3di3gL2wQwwLmGtIp56Ne2', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2024-06-10 02:17:17', '2024-06-10 02:17:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(112, NULL, NULL, 'Youif Omar', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'yousifomar110@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$vTqcG6T1O/AgJEOfOCUamucg.GDIppySyZGlx3tGXeTRf1LWlf98.', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2024-08-17 16:10:08', '2024-08-17 16:10:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(115, 1, NULL, 'Qasr Eleiny Hospital Cairo', 'مستشفي القصر العينى بالقاهره', NULL, '1737398029-IMG-20200427-WA0029 (1).jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zazomazazoma@gmail.com', NULL, 'H', NULL, NULL, '$2y$10$HOZjXrdbZkpzoBd/Uk4ALeNd9hRyDFszySayHQieipWedmh5nzdju', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-20 23:33:49', '2025-01-21 23:07:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(116, 1, 1, 'Ahmed Alaa', 'أحمد علاء', NULL, '1737398283-د.أحمد-المصري.png', NULL, NULL, 'Cairo -Egypt', 'Egypt', 'Cairo', '11562', NULL, 'M', NULL, NULL, 'em20000@gmail.com', NULL, 'D', NULL, 50, '$2y$10$pll32yf1kIxUsbuRIv37e.pN9afwc085gaknxm0i4sDHzW0.yMbau', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-20 23:38:03', '2025-01-20 23:38:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(117, 3, NULL, 'Jordan Hospital', 'مستشفى الاردن', NULL, '1737403024-jordan-hospital-buliding.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'johopital@arabcares.com', NULL, 'H', NULL, NULL, '$2y$10$S5ZppuLEvXzUe4MTi09sfOe41JBd.LYHm85SC6F/bQFGM489IK8ta', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-21 00:57:05', '2025-01-24 22:31:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asia/Riyadh', NULL),
(118, 4, NULL, 'Mustafa Shokry', 'Mustafa Shokry', NULL, '1737403041-1694245184-fun-3d-cartoon-illustration-indian-doctor.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mu@hospital.com', NULL, 'H', NULL, NULL, '$2y$10$5gahi0Xz4ZbZlQZvf4Zuhegzh6KjR4LpU3nTkauAE44CwFeryf6va', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-21 00:57:21', '2025-02-02 23:19:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Africa/Cairo', NULL),
(119, 3, 18, 'Ahmed Bashir', 'أحمد بشير', NULL, '1737479418-ahmad-bashir-260x360.png', NULL, NULL, 'Amman, Queen Noor Street Amman, Jordan 11152', 'Jordan', 'Amman', '11152', NULL, 'M', NULL, NULL, 'ahmed@www.jordan-hospital.com', NULL, 'D', NULL, 60, '$2y$10$4YOsWvxZA7dvG6eILFweZOZFdD3KrYOGpk3hjFCCWzjmmshV4t60m', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-21 22:10:18', '2025-01-24 23:12:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(120, 5, NULL, 'Ali Bin Ali Hospital', 'مستشفى علي بن علي', NULL, '1737482244-abah.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ab@arabcares.com', NULL, 'H', NULL, NULL, '$2y$10$mKZIC9/S3A4a15W.tct9k.6gM519Ev8J2yAaGkIABFbKoM4X4Mg0i', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-21 22:57:24', '2025-01-24 22:37:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asia/Riyadh', NULL),
(121, 5, 5, 'Hamzah Bani Younes', 'حمزة بني يونس', NULL, '1737482492-Hamzah.jpg', NULL, NULL, 'KSA, Riyadh, Aziziyah, Mohammed Rashid Road P.O, Riyadh 14515', 'Saudi Arabia', 'Riyadh', '14515', NULL, 'M', NULL, NULL, 'hamzah@arabcares.com', NULL, 'D', NULL, 200, '$2y$10$uxBIBTrIvkTxQQDhqtKCpuPsabUeZWeLz9SskEm27LMqxN7L9BOyG', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-21 23:01:32', '2025-02-03 00:00:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asia/Riyadh', NULL),
(122, 5, 15, 'Nahla El Sherbiny', 'نهلة الشربيني', NULL, '1737535473-Nahla.jpg', NULL, NULL, 'KSA, Riyadh, Aziziyah, Mohammed Rashid Road, Riyadh 14515', 'Saudi Arabia', 'Riyadh', '14515', NULL, 'F', NULL, NULL, 'nahla@test.com', NULL, 'D', NULL, 130, '$2y$10$b5DiZqmp9PydYCsg36bx8evHu2LuoQL7muGwXep0XNG2zrF2VHz3C', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-22 13:44:33', '2025-01-22 13:45:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(123, NULL, NULL, 'Ali', 'علي', NULL, '1738075621-User_icon_2.svg.png', NULL, NULL, 'Amman', NULL, NULL, NULL, NULL, 'M', NULL, NULL, 'user@test.com', '123456789123', 'U', NULL, NULL, '$2y$10$4t/oYy.FDovyvTyF3BarmubpDWH.AHjoA.ljzyUSNZd91Yn3KVVJ6', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-22 13:58:14', '2025-02-18 15:31:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asia/Riyadh', NULL),
(124, NULL, NULL, 'Yousif', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-07', NULL, NULL, NULL, 'yousif@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$tXBLRCuXA.QLZONei9558eyYBFDsy4bT/.nPkSl9tnR1yCovuCVG2', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-24 16:25:04', '2025-01-24 16:25:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(125, NULL, NULL, 'omar', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '1980-01-01', NULL, NULL, NULL, 'omar@gmail.com', '152515660', 'U', NULL, NULL, '$2y$10$viXz7n6aMenfiq.tZZAlbeuZx3HsABz2HKcNsAmGm55tJKqRS86SC', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-24 16:32:36', '2025-01-24 16:32:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(130, 3, 15, 'Dina Zbidi', 'دينا زبيدي', NULL, '1737743717-dina-zbidi.png', NULL, NULL, 'Amman, Queen Noor Street Amman, Jordan 11152', 'Jordan', 'Amman', '11152', NULL, 'F', NULL, NULL, 'dina@arabcares.com', NULL, 'D', NULL, 65, '$2y$10$EOyevb0nPaNwyLiP83R2cOOiXTDyl4uIWzJXwA2NHhc90w.AVP1bS', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-24 23:35:17', '2025-01-24 23:35:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(133, 3, 5, 'Khalid Ata', 'خالد عطا', NULL, '1737748028-khalid-ata.png', NULL, NULL, 'Amman, Queen Noor Street Amman, Jordan 11152', 'Jordan', 'Amman', '11152', NULL, 'M', NULL, NULL, 'khalid@jordan-hospital.com', NULL, 'D', NULL, 55, '$2y$10$B247J3x2tH5aseRJpcl0WuiICHlK7PobWI2cFFMoZo961f2F5Gma.', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-25 00:47:08', '2025-01-25 00:47:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(134, NULL, NULL, 'مصطفى شكرى', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mush@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$BKKrVXbneg9cMH3TQ5fk1.LDbid5yXQpF5vaXV8EhikUwqxxKnz5S', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-25 02:13:21', '2025-01-25 02:13:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(135, NULL, NULL, 'tested', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tested@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$ZJsCcYoScYKoya5Y0VfxaeJfKCqxFjdfjF5lxVixbqn3xGmCrctNG', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 12:46:34', '2025-01-28 12:46:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(136, 5, 20, 'Abdulaziz  Alasimi', 'عبدالعزيز العصيمي', NULL, '1738071693-د-عبدالعزيزي-العصيمي-اخصائي-أول-الأمراض-السمعية-300x300-1.jpg', NULL, NULL, 'KSA, Riyadh, Aziziyah, Mohammed Rashid Road, Riyadh 14515', 'Saudi Arabia', 'Riyadh', '14515', NULL, 'M', NULL, NULL, 'abdulaziz@arabcares.com', NULL, 'D', NULL, 150, '$2y$10$E/FpHL0CwiW210IXd8gBvekgB4YkSrgJywR/X.GW9ftNYImmw2zr6', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 18:41:33', '2025-01-28 18:41:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(137, 6, NULL, 'Dr. Sulaiman Al Habib Hospital - Ryadh', 'مستشفى الدكتور سليمان الحبيب', NULL, '1738073028-2328684.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'habib@arabcares.com', NULL, 'H', NULL, NULL, '$2y$10$wPHJvNoAGJ5t9.VpAUVVAOCp7ES9di.Nqjv2asBuNxxuhWTIendcu', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 19:03:48', '2025-02-01 21:32:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Asia/Riyadh', NULL),
(138, 7, NULL, 'fakeeh', 'fakeeh', NULL, '1738073552-2022-11-27.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fakeeh@arabcares.com', NULL, 'H', NULL, NULL, '$2y$10$5eHVkFoQSa2wUVZs1BL1A.S9rOrPMkwSQkeZGRR1oOmJ3pnIQQcrG', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 19:12:32', '2025-01-28 19:12:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(139, 7, 1, 'Wael Alqarawi', 'وائل القرعاوي', NULL, '1738074273-dr-wael-alqarawi.jpeg', NULL, NULL, 'حي الياسمين, RAYB7058، 7058 رقم 3، 2537, Riyadh 13325 Riyadh', 'Saudi Arabia', 'Riyadh', '13325', NULL, 'M', NULL, NULL, 'wael@arabcares.com', NULL, 'D', NULL, 100.5, '$2y$10$tFQIOGW0jf9O3ARQuN/14OqOxZUnTV6tqQD52XFlauF1leRoTOzn2', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 19:24:33', '2025-02-02 23:54:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(140, 6, 3, 'Tahani Al Moqbe', 'تهاني المقبل', NULL, '1738075006-70223.png', NULL, NULL, 'Dr. Sulaiman Al Habib Olaya Medical Complex King Fahd Rd, Al Olaya, Riyadh 12214', 'Saudi Arabia', 'Riyadh', '12214', NULL, 'F', NULL, NULL, 'Tahani@arabcares.com', NULL, 'D', NULL, 100, '$2y$10$YkFl.zpy19SGVXVwcyFETOeQFtg9RsVfcBveAFh0d7BpNW/Km.786', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-28 19:36:46', '2025-02-02 23:51:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(141, NULL, NULL, 'Mustafa Shokry', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-07', NULL, NULL, NULL, 'mustafa123@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$xcS/ZyIZCTVUalwplrN78eeHogl6lqUpnE2W4nyLCJtQtmeiPa2kW', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 14:54:51', '2025-01-29 14:54:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(142, NULL, NULL, 'Mustafa Shokry', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-07', NULL, NULL, NULL, 'joker@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$yI3DVqYZuM70YJHlVphcbuqwF8KHMAPre7/upZrZBgssl/oL37UA2', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 15:02:17', '2025-01-29 15:02:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(143, NULL, NULL, 'Mustafa Mohamed Shokry', NULL, NULL, '1739789082_Arab_Care.jpg', NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test6@gmail.com', NULL, 'U', NULL, NULL, '$2y$10$.UZX9FmBlZhLN1EHFK.ryetnABm6gK34l/M1y6/xf5z0PIAYsEjCm', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 15:17:47', '2025-02-17 18:46:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Africa/Cairo', 'Mobile App'),
(144, NULL, NULL, 'mm ss', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mmssaaddgg@gmail.com', '923956789', 'U', NULL, NULL, '$2y$10$vkFEfm2p/xYf301e1/eIEeHs8uRuY1/G5VugvOpulydpXOwZz0kYu', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 15:26:16', '2025-01-29 15:26:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(145, NULL, NULL, 'hshshs', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hdhsh@hehrh.djdh', '147852369', 'U', NULL, NULL, '$2y$10$KGFuEQt1BgG3gH9eNzZchO1p8jfMCkWdO6xeL9NmaU2AssBwD4g1K', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 15:30:58', '2025-01-29 15:30:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(146, NULL, NULL, 'sefrsdf', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fsefsef@sdfsdf.sdfsef', '641619816', 'U', NULL, NULL, '$2y$10$8UFCbPTJw9uglmIka7bTceLJlSrG2ocfXyrvk/ugf0YTMOTPJ8CGa', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-29 16:42:15', '2025-01-29 16:42:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(147, NULL, NULL, 'Mohamed', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mohamed@mohamed.com', '753479654', 'U', NULL, NULL, '$2y$10$vqcuWmwZbOuE0F054ZihFeTxS6GJQ8Qm61xH1TU7BBaK67MUegGBi', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-30 13:52:07', '2025-01-30 13:52:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(148, NULL, NULL, 'محمد بن رمضان', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ramadan@mustafa.com', '753479654', 'U', NULL, NULL, '$2y$10$2cNXZIaJJqVQKKj4rAAdWeIErZXDu0HrjOpA23be7lSaXH91SBaA6', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-30 13:56:41', '2025-01-30 13:56:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(149, NULL, NULL, 'man', NULL, NULL, 'images/images/images/images/placeholder.png', NULL, NULL, 'Riyadh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'man@test.com', NULL, 'U', NULL, NULL, '$2y$10$Y8aGClocoTgy0Uf/yEsgBuYdLqQ5LyFLOyaktOJkU6GqmI/54rzgu', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-01-30 16:40:18', '2025-02-02 00:38:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(150, 8, NULL, 'Dr. Sulaiman Al Habib Hospital - Jeddah', 'مستشفى الدكتور سليمان الحبيب - جدة', NULL, '1738427515-1712830151718.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'H@123456', NULL, 'H', NULL, NULL, '$2y$10$hv1iohutHcxru.odf.NvHORKJ2W6aSV5WQRRLtSjfmLxYWV5klnMi', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-01 21:31:55', '2025-02-01 21:44:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(151, 9, NULL, 'United Doctors Hospitla', 'مستشفى الاطباء المتحدون', NULL, '1738525901-HDU.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'udh@test.com', NULL, 'H', NULL, NULL, '$2y$10$39QjgyKBsHZve0STUEVtRupOykrkLjoGSM/SQuOYUHkgtaCUVbDsu', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-03 00:51:41', '2025-02-03 01:45:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(152, 9, 21, 'Maysa Haroon', 'مايسه هارون', NULL, '1738526385-Maysaharoon.jpg', NULL, NULL, 'Jeddah, Mecca, Saudi Arabia', 'Saudi Arabia', 'Jeddah', '23456', NULL, 'F', NULL, NULL, 'maysa@arabcares.com', NULL, 'D', NULL, 150, '$2y$10$5LuTy2sI/LbpoFfyV12mJOMtKfLnJHCFafJPLYS196EQ6SfwbTTuG', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-03 00:59:45', '2025-02-03 00:59:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(153, 9, 22, 'Sherif Mamdooh', 'شريف ممدوح', NULL, '1738527978-Sherifmamdooh.jpg', NULL, NULL, 'Jeddah, Mecca, Saudi Arabia , Jeddah', 'Saudi Arabia', 'Jeddah', '23456', NULL, 'M', NULL, NULL, 'sherif@arabcares.com', NULL, 'D', NULL, 250, '$2y$10$vw/AuYGNw8LijFDdN2PyVeI61s3KlX7YY83MgpY1wiWsl4n/LeJnO', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-03 01:26:18', '2025-02-03 01:26:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(154, 9, 2, 'Reham Said', 'ريهام سعيد', NULL, '1738528947-Rehamsaid-400x400.jpg', NULL, NULL, 'Jeddah, Mecca, Saudi Arabia , Jeddah', 'Saudi Arabia', 'Jeddah', '23456', NULL, 'F', NULL, NULL, 'Reham@arabcares.com', NULL, 'D', NULL, 150, '$2y$10$ljfarrBQfPQG0LF.Wo6cVeTpPuAsbyP9uFeJ7XMC8Uy92jRRKqNcm', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-03 01:42:27', '2025-02-03 01:42:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', NULL),
(155, NULL, NULL, 'Mustafa Shokry', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-07', NULL, NULL, NULL, 'test9@gmail.com', '123456789', 'U', NULL, NULL, '$2y$10$KbuIkgqqkyQWbCCEi99Hd.Pxipodrgc0sy73VlIarsaNkPBvIjRUC', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-05 18:19:45', '2025-02-05 18:19:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(156, NULL, NULL, 'mu test', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test10@gmail.com', '089764523', 'U', NULL, NULL, '$2y$10$rXeOQ0NBQGWhNH2zBftChudBAQUpCFQyjNM.u5NqKrsV4MgxlIR8G', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-12 14:06:27', '2025-02-12 14:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App'),
(157, NULL, NULL, 'Waad', NULL, NULL, 'placeholder.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'waad.jawad@hotmail.com', '599857280', 'U', NULL, NULL, '$2y$10$wSWPhcMJwMaAtRLAa5geeO6ecVPB2OnLhvyWURrjKYdvRAiUWLi.O', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, '2025-02-19 17:37:51', '2025-02-19 17:37:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UTC', 'Mobile App');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `doctor_id`, `patient_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 121, 123, 0, NULL, NULL),
(4, 130, 123, 0, NULL, NULL),
(5, 139, 7, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_doctor_id_index` (`doctor_id`),
  ADD KEY `appointments_patient_id_index` (`patient_id`),
  ADD KEY `appointments_hospital_id_index` (`hospital_id`),
  ADD KEY `appointments_insurance_id_foreign` (`insurance_id`);

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_setting_user_id_foreign` (`user_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_hospital_id_foreign` (`hospital_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinics_user_id_index` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_user_id_index` (`user_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_user_id_index` (`user_id`);

--
-- Indexes for table `genral_settings`
--
ALTER TABLE `genral_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitals_city_id_foreign` (`city_id`),
  ADD KEY `hospitals_hospital_type_id_foreign` (`hospital_type_id`);

--
-- Indexes for table `hospital_insurance`
--
ALTER TABLE `hospital_insurance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_insurance_hospital_id_foreign` (`hospital_id`),
  ADD KEY `hospital_insurance_insurance_id_foreign` (`insurance_id`);

--
-- Indexes for table `hospital_reviews`
--
ALTER TABLE `hospital_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_reviews_user_id_index` (`user_id`),
  ADD KEY `hospital_reviews_hospital_id_index` (`hospital_id`);

--
-- Indexes for table `hospital_types`
--
ALTER TABLE `hospital_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_appointment_id_foreign` (`appointment_id`),
  ADD KEY `notifications_from_id_foreign` (`from_id`),
  ADD KEY `notifications_to_id_foreign` (`to_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_hospital_id_foreign` (`hospital_id`);

--
-- Indexes for table `one_time_availabilities`
--
ALTER TABLE `one_time_availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_comments`
--
ALTER TABLE `patient_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regular_availabilities`
--
ALTER TABLE `regular_availabilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_settings`
--
ALTER TABLE `schedule_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genral_settings`
--
ALTER TABLE `genral_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `hospital_insurance`
--
ALTER TABLE `hospital_insurance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hospital_reviews`
--
ALTER TABLE `hospital_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_types`
--
ALTER TABLE `hospital_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `one_time_availabilities`
--
ALTER TABLE `one_time_availabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_comments`
--
ALTER TABLE `patient_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1548;

--
-- AUTO_INCREMENT for table `regular_availabilities`
--
ALTER TABLE `regular_availabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_settings`
--
ALTER TABLE `schedule_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD CONSTRAINT `app_setting_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hospitals_hospital_type_id_foreign` FOREIGN KEY (`hospital_type_id`) REFERENCES `hospital_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hospital_insurance`
--
ALTER TABLE `hospital_insurance`
  ADD CONSTRAINT `hospital_insurance_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hospital_insurance_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospital_reviews`
--
ALTER TABLE `hospital_reviews`
  ADD CONSTRAINT `hospital_reviews_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hospital_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `insurances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
