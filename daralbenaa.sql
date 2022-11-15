-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 10:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daralbenaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `offer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `direct_date` date DEFAULT NULL,
  `application_type` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `identity_number` varchar(255) NOT NULL,
  `identity_expiration_date` date DEFAULT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `employee_address` text DEFAULT NULL,
  `another_phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `social_security` varchar(255) NOT NULL DEFAULT 'no',
  `documents_complete` varchar(255) NOT NULL DEFAULT 'no',
  `medical_insurance` varchar(255) NOT NULL DEFAULT 'no',
  `support_registered` varchar(255) NOT NULL DEFAULT 'no',
  `status` varchar(255) NOT NULL DEFAULT 'waiting',
  `decline_reason` text DEFAULT NULL,
  `direct_work_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `supervisor_id`, `offer_id`, `date`, `direct_date`, `application_type`, `dept_id`, `project_id`, `identity_number`, `identity_expiration_date`, `basic_salary`, `passport_number`, `employee_address`, `another_phone_number`, `email`, `notes`, `social_security`, `documents_complete`, `medical_insurance`, `support_registered`, `status`, `decline_reason`, `direct_work_status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '2022-06-01', NULL, 'new_contract', 9, NULL, '1086854302', '2026-01-22', '3000', NULL, 'الرياض حي قرطبة', '055555555555', 'ahmed@gmail.com', 'لا يوجد', 'no', 'no', 'no', 'no', 'approved', NULL, NULL, '2022-06-20 12:21:20', '2022-07-17 10:07:43'),
(4, 139, 4, '2022-07-02', '2022-07-31', 'new_contract', 2, NULL, '1522222288885', '2022-07-28', '2000', NULL, NULL, NULL, NULL, NULL, 'no', 'no', 'no', 'no', 'waiting', NULL, 1, '2022-07-17 17:46:04', '2022-07-24 17:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `application_reviewer`
--

CREATE TABLE `application_reviewer` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `supervisor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_reviewer`
--

INSERT INTO `application_reviewer` (`id`, `application_id`, `dept_id`, `job_title_id`, `review`, `notes`, `created_at`, `updated_at`, `supervisor_id`) VALUES
(5, 4, 2, 3, 'approved', 'test', '2022-07-17 17:46:04', '2022-07-17 22:47:00', 1),
(6, 4, 2, 12, 'approved', 'test232', '2022-07-17 17:46:04', '2022-07-17 22:47:00', 1),
(7, 4, 2, 5, 'approved', 'teeest', '2022-07-18 13:29:31', '2022-07-18 13:29:48', 139);

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `identity_number` varchar(255) NOT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `employee_address` text DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `another_phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `contract_period` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `housing_allowance` varchar(255) NOT NULL,
  `transport_allowance` varchar(255) NOT NULL,
  `another_allowance` varchar(255) NOT NULL,
  `total_salary` varchar(255) NOT NULL,
  `employee_signature` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'waiting',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `application_id`, `employee_id`, `date`, `employee_name`, `nationality_id`, `identity_number`, `passport_number`, `employee_address`, `phone_number`, `another_phone_number`, `email`, `job_title_id`, `contract_period`, `start_date`, `end_date`, `basic_salary`, `housing_allowance`, `transport_allowance`, `another_allowance`, `total_salary`, `employee_signature`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-20', 'أحمد ابراهيم أحمد الغامدي', 7, '1086854302', NULL, NULL, '0533131286', NULL, NULL, 17, '1', '2022-06-20', '2023-06-20', '3000', '1000', '0', '3000', '7000', 'public/uploads/signature/62b067b449553.png', 'approved', NULL, '2022-06-20 12:21:20', '2022-06-20 12:27:32'),
(4, 4, 4, '2022-07-17', 'abdelrahman', 4, '1522222288885', NULL, NULL, '05123456789', NULL, NULL, 5, '1', '2022-07-17', '2023-07-17', '2000', '200', '200', '0', '2400', NULL, 'waiting', NULL, '2022-07-17 17:46:04', '2022-07-17 17:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE `depts` (
  `id` int(11) NOT NULL,
  `dept_name_ar` varchar(255) NOT NULL,
  `dept_name_en` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depts`
--

INSERT INTO `depts` (`id`, `dept_name_ar`, `dept_name_en`, `created_at`, `updated_at`) VALUES
(2, 'الادارة الهندسية 1', 'Engineering Management', '2022-03-29 04:09:26', '2022-05-19 10:40:18'),
(3, 'الادارة المالية', 'Financial Management', '2022-03-29 04:09:35', '2022-03-29 04:09:35'),
(4, 'ادارة المشتريات', 'Purchase Management', '2022-03-29 04:10:23', '2022-03-29 04:10:23'),
(7, 'ادارة الحسابات', 'Account Management', '2022-03-29 04:11:02', '2022-03-29 04:11:02'),
(8, 'ادارة المخازن', 'Store Management', '2022-03-29 04:11:16', '2022-03-29 04:11:16'),
(9, 'ادارة الموارد البشرية', 'Human Resource Management', '2022-03-29 05:21:37', '2022-03-29 05:21:37'),
(10, 'ادارة شئون العاملين', 'Personnel Affairs Department', '2022-03-29 16:21:59', '2022-03-29 16:21:59'),
(11, 'الادارة العامة', 'General Management', '2022-04-12 17:03:00', '2022-04-12 17:03:00'),
(15, 'ادارة المشاريع', 'Project Management', '2022-05-17 08:32:57', '2022-06-22 05:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `dept_job_title`
--

CREATE TABLE `dept_job_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `job_title_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dept_job_title`
--

INSERT INTO `dept_job_title` (`id`, `dept_id`, `job_title_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(9, 2, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_clear` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `identity_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `total_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weekend_vacation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yearly_vacation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name_ar`, `name_en`, `email`, `phone_number`, `job_number`, `email_verified_at`, `password`, `password_clear`, `role_name`, `Status`, `identity_number`, `passport_number`, `contract_period`, `dept_id`, `project_id`, `job_title_id`, `nationality_id`, `total_salary`, `weekend_vacation`, `yearly_vacation`, `identity_file`, `cv_file`, `api_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'أحمد ابراهيم أحمد الغامدي', 'أحمد ابراهيم أحمد الغامدي', NULL, '0533131286', '4859', NULL, '$2y$10$4rlhjv.w4.ptrC5ThRde4u7SbPbnpra1JPiukXRQsFmsq8l5uemZi', '79638205', 'موظف', 'active', '1086854302', NULL, '1', 9, NULL, 17, 7, '7000', '1', '21', NULL, NULL, NULL, NULL, '2022-06-20 12:21:20', '2022-06-20 12:21:20', NULL),
(4, 'abdelrahman', 'abdelrahman', NULL, '05123456789', '4860', NULL, '$2y$10$6qsvo1xNAJZFJkR6b43vDu6vKayyciM08hw7aJ79S5zj/NusP6BRm', '45732061', 'موظف', 'active', '1522222288885', NULL, '1', 2, NULL, 5, 4, '2400', '1', '21', NULL, NULL, NULL, NULL, '2022-07-17 17:46:04', '2022-07-17 17:46:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees_transfers`
--

CREATE TABLE `employees_transfers` (
  `id` int(11) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `old_dept_id` int(11) NOT NULL,
  `old_project_id` int(11) NOT NULL,
  `new_dept_id` int(11) NOT NULL,
  `new_project_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees_transfers`
--

INSERT INTO `employees_transfers` (`id`, `employee_id`, `old_dept_id`, `old_project_id`, `new_dept_id`, `new_project_id`, `date`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 11, 14, 15, 5, '2022-07-30', 'Qui corporis dicta a', 'waiting', '2022-07-24 17:47:02', '2022-07-24 17:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `employee_cert`
--

CREATE TABLE `employee_cert` (
  `id` int(11) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `cert_file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_password_resets`
--

CREATE TABLE `employee_password_resets` (
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(11) NOT NULL,
  `job_title_ar` varchar(255) NOT NULL,
  `job_title_en` varchar(255) NOT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `dept_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_titles`
--

INSERT INTO `job_titles` (`id`, `job_title_ar`, `job_title_en`, `rank`, `dept_id`, `created_at`, `updated_at`) VALUES
(1, 'رئيس مجلس الاداره', 'Chairman of Board of Directors', '1', 2, '2022-03-31 14:13:47', '2022-04-03 00:32:10'),
(2, 'مدير الادارة المالية', 'Financial Manager', '3', 3, '2022-03-31 15:29:59', '2022-06-22 06:18:04'),
(3, 'رئيس قطاع', 'Head of sector', NULL, 2, '2022-03-31 15:30:23', '2022-03-31 15:30:23'),
(4, 'مدير المشاريع', 'projects manager', '4', 15, '2022-03-31 15:30:47', '2022-06-22 05:08:42'),
(5, 'مدير مشروع', 'project manager', '4', 15, '2022-03-31 15:31:07', '2022-06-22 05:15:04'),
(6, 'مدير تنفيذي', 'Executive Director', NULL, 2, '2022-03-31 15:31:35', '2022-03-31 15:31:35'),
(7, 'مكتب فنى', 'technical office', NULL, 2, '2022-03-31 15:31:55', '2022-03-31 15:31:55'),
(11, 'مهندس تنفيذي', 'executive engineer', NULL, 2, '2022-03-31 15:37:49', '2022-03-31 15:37:49'),
(12, 'المشرف العام', 'Supervisor', '1', 11, '2022-03-31 15:37:59', '2022-06-22 05:14:24'),
(13, 'المدير العام', 'General Manager', '1', 11, '2022-04-12 17:03:25', '2022-04-12 17:03:25'),
(17, 'مدير موراد البشرية', 'HR Manager', '2', 9, '2022-06-05 05:23:24', '2022-06-22 05:13:19'),
(18, 'مهندس كهربائى', 'Electrical Engineer', '4', 15, '2022-06-22 10:45:07', '2022-06-22 10:45:07');

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
(1, '2022_05_23_165520_add_direct_work_status_to_applications_table', 1),
(2, '2022_06_19_115507_add_deleted_at_to_employees', 2),
(3, '2022_07_17_215412_create_dept_job_title_pivot_table', 3),
(4, '2022_07_18_005542_add_user_id_to_application_reviewer', 4),
(5, '2022_07_18_181105_add_supervisor_id_to_applications', 5),
(7, '2022_07_19_154516_add_direct_date_to_applications', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Supervisor', 1),
(1, 'App\\Models\\Supervisor', 133),
(1, 'App\\Models\\Supervisor', 136),
(9, 'App\\Models\\Supervisor', 135),
(9, 'App\\Models\\Supervisor', 139),
(11, 'App\\Models\\Supervisor', 134),
(12, 'App\\Models\\Supervisor', 138),
(13, 'App\\Models\\Supervisor', 137);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL,
  `nationality_ar` varchar(255) NOT NULL,
  `nationality_en` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `nationality_ar`, `nationality_en`, `created_at`, `updated_at`) VALUES
(4, 'مصرى', 'Egyptian', '2022-04-03 03:05:20', '2022-04-03 03:05:20'),
(5, 'اليمن', 'Yamen', '2022-04-03 03:05:29', '2022-06-22 06:44:29'),
(6, 'فليبنى', 'Alfilibiyn', '2022-04-03 03:05:38', '2022-06-22 06:43:05'),
(7, 'سعودي', 'Saudi', '2022-04-19 09:00:10', '2022-04-19 09:00:10'),
(9, 'الهند', 'India', '2022-05-17 08:39:33', '2022-05-17 08:39:33'),
(10, 'بنجلاديش', 'bangldush', '2022-06-20 12:33:25', '2022-06-22 05:22:57'),
(11, 'سودانى', 'Alsuwdan', '2022-06-22 06:44:07', '2022-06-22 06:44:07'),
(12, 'باكستانى', 'Pakistani', '2022-06-22 06:46:38', '2022-06-22 06:46:38'),
(13, 'قبائل نازحة  سعودي', 'Qabayil Naziha  Saudi', '2022-06-22 06:49:06', '2022-06-22 06:49:06'),
(14, 'نبيبالى', 'Nepali', '2022-06-22 06:50:24', '2022-06-22 06:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `housing_allowance` varchar(255) NOT NULL,
  `transport_allowance` varchar(255) NOT NULL,
  `another_allowance` varchar(255) NOT NULL,
  `total_salary` varchar(255) NOT NULL,
  `weekend_vacation` varchar(255) NOT NULL,
  `yearly_vacation` varchar(255) NOT NULL,
  `contract_period` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL,
  `employee_response` varchar(255) NOT NULL DEFAULT 'waiting',
  `decline_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `employee_name`, `phone_number`, `nationality_id`, `job_title_id`, `basic_salary`, `housing_allowance`, `transport_allowance`, `another_allowance`, `total_salary`, `weekend_vacation`, `yearly_vacation`, `contract_period`, `expired_at`, `employee_response`, `decline_reason`, `created_at`, `updated_at`) VALUES
(1, 'أحمد ابراهيم أحمد الغامدي', '0533131286', 7, 17, '3000', '1000', '0', '3000', '7000', '1', '21', '1', '2022-06-22 15:13:48', 'approved', '', '2022-06-20 12:13:48', '2022-06-20 12:16:37'),
(3, 'مهند حسين عبدالمعين مغربل', '0543240002', 7, 18, '5000', '2000', '2700', '0', '9700', '1', '21', '1', '2022-06-24 13:48:15', 'approved', '', '2022-06-22 10:48:15', '2022-06-22 11:00:13'),
(4, 'abdelrahman', '05123456789', 4, 5, '2000', '200', '200', '0', '2400', '1', '21', '1', '2022-07-19 20:33:55', 'approved', '', '2022-07-17 17:33:55', '2022-07-17 17:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'اضافة مشرف', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(2, 'عرض مشرف', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(3, 'تعديل مشرف', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(4, 'حذف مشرف', 'supervisor', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(5, 'اضافة موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(6, 'عرض موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(7, 'تعديل موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(8, 'حذف موظف', 'employee', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(9, 'اضافة صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(10, 'عرض صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(11, 'تعديل صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(12, 'حذف صلاحية', 'privilege', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(13, 'اضافة ادارة', 'dept', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(14, 'عرض ادارة', 'dept', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(15, 'تعديل ادارة', 'dept', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(16, 'حذف ادارة', 'dept', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(17, 'اضافة مشروع', 'project', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(18, 'عرض مشروع', 'project', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(19, 'تعديل مشروع', 'project', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(20, 'حذف مشروع', 'project', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(21, 'اضافة مسمى وظيفى', 'job_title', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(22, 'عرض مسمى وظيفى', 'job_title', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(23, 'تعديل مسمى وظيفى', 'job_title', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(24, 'حذف مسمى وظيفى', 'job_title', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(25, 'اضافة جنسية', 'nationality', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(26, 'عرض جنسية', 'nationality', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(27, 'تعديل جنسية', 'nationality', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(28, 'حذف جنسية', 'nationality', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(29, 'اضافة عرض وظيفي', 'offer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(30, 'عرض عرض وظيفي', 'offer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(31, 'تعديل عرض وظيفي', 'offer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(32, 'حذف عرض وظيفي', 'offer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(33, 'اضافة قرار توظيف', 'application', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(34, 'عرض قرار توظيف', 'application', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(35, 'تعديل قرار توظيف', 'application', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(36, 'حذف قرار توظيف', 'application', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(37, 'اضافة عقد عمل', 'contract', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(38, 'عرض عقد عمل', 'contract', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(39, 'تعديل عقد عمل', 'contract', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(40, 'حذف عقد عمل', 'contract', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(41, 'اضافة طلب نقل', 'transfer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(42, 'عرض طلب نقل', 'transfer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(43, 'تعديل طلب نقل', 'transfer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(44, 'حذف طلب نقل', 'transfer', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(45, 'تقارير العقود', 'report', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(46, 'عرض مباشرة العمل', 'direct-work', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42'),
(47, 'تعديل مباشرة العمل', 'direct-work', 'supervisor-web', '2022-03-04 14:29:42', '2022-03-04 14:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name_ar` varchar(255) NOT NULL,
  `project_name_en` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name_ar`, `project_name_en`, `dept_id`, `added_date`, `project_end_date`, `created_at`, `updated_at`) VALUES
(5, 'مجمع اسكان قوى الامن بحفر الباطن', 'Hafr Al-Batin', 15, '2020-09-09', '2023-09-09', '2022-05-09 10:17:48', '2022-06-22 07:19:45'),
(6, 'مدينة الامير عبدالله بن جلوي بالاحساء', 'Prince Abdullah bin Jalawi city in Al-Ahsa', 15, '2019-06-06', '2022-10-10', '2022-05-17 08:35:10', '2022-06-22 07:33:26'),
(7, 'المباني المجاورة-وزارة الحرس الوطني', 'Almabani Almujawira', 15, '2019-09-09', '2024-09-09', '2022-06-22 07:25:08', '2022-06-22 07:25:08'),
(8, 'مكتب الرئيس-وزارة الرياضة', 'Maktab Alrayiys', 15, '2019-09-09', '2022-09-09', '2022-06-22 07:26:35', '2022-06-22 07:26:35'),
(9, 'المطابع-وزارة الرياضة', 'Almatabie', 15, '2020-01-01', '2022-12-12', '2022-06-22 07:27:44', '2022-06-22 07:27:44'),
(10, 'قوات الامن الخاصة', 'Quaat Alamin Alkhasa', 15, '2019-12-12', '2022-12-12', '2022-06-22 07:29:22', '2022-06-22 07:29:22'),
(11, 'مدينة الامير بدر السكنية', 'Prince Badr Residential City', 15, '2020-11-11', '2023-10-10', '2022-06-22 07:30:44', '2022-06-22 07:30:44'),
(12, 'نادي الخليج-وزارة الرياضة', 'Nadi alkhalij', 15, '2021-04-04', '2024-04-04', '2022-06-22 07:31:33', '2022-06-22 07:46:34'),
(13, 'سدايا -المدينة الرقمية', 'Sadaya', 15, '2022-02-02', '2025-02-02', '2022-06-22 07:32:57', '2022-06-22 07:32:57'),
(14, 'الادارة العامة', 'Aladara', 11, '2021-11-24', '2030-12-12', '2022-06-22 07:40:16', '2022-06-22 07:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `renewal`
--

CREATE TABLE `renewal` (
  `id` int(11) NOT NULL,
  `period` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `contract_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'supervisor-web', '2021-08-23 01:40:49', '2021-08-23 01:40:49'),
(9, 'مدير الموارد البشرية', 'supervisor-web', '2022-05-17 08:39:12', '2022-06-22 05:30:28'),
(11, 'مدير المشاريع', 'supervisor-web', '2022-05-24 11:53:10', '2022-06-22 05:22:17'),
(12, 'مدير الادارة المالية', 'supervisor-web', '2022-06-19 09:55:27', '2022-06-22 06:17:42'),
(13, 'المشرف العام', 'supervisor-web', '2022-06-22 05:20:07', '2022-06-22 05:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 9),
(1, 12),
(1, 13),
(2, 1),
(2, 9),
(2, 11),
(2, 13),
(3, 1),
(3, 9),
(3, 11),
(3, 13),
(4, 1),
(4, 13),
(5, 1),
(5, 9),
(5, 11),
(5, 12),
(5, 13),
(6, 1),
(6, 9),
(6, 11),
(6, 13),
(7, 1),
(7, 9),
(7, 13),
(8, 1),
(8, 13),
(9, 1),
(9, 9),
(9, 11),
(9, 12),
(9, 13),
(10, 1),
(10, 9),
(10, 11),
(10, 13),
(11, 1),
(11, 9),
(11, 13),
(12, 1),
(12, 13),
(13, 1),
(13, 9),
(13, 11),
(13, 12),
(13, 13),
(14, 1),
(14, 9),
(14, 11),
(14, 13),
(15, 1),
(15, 9),
(15, 11),
(15, 13),
(16, 1),
(16, 11),
(16, 13),
(17, 1),
(17, 9),
(17, 11),
(17, 12),
(17, 13),
(18, 1),
(18, 9),
(18, 11),
(18, 13),
(19, 1),
(19, 9),
(19, 11),
(19, 13),
(20, 1),
(20, 11),
(20, 13),
(21, 1),
(21, 9),
(21, 11),
(21, 12),
(21, 13),
(22, 1),
(22, 9),
(22, 11),
(22, 13),
(23, 1),
(23, 9),
(23, 11),
(23, 13),
(24, 1),
(24, 11),
(24, 13),
(25, 1),
(25, 9),
(25, 11),
(25, 12),
(25, 13),
(26, 1),
(26, 9),
(26, 11),
(26, 13),
(27, 1),
(27, 9),
(27, 11),
(27, 13),
(28, 1),
(28, 11),
(28, 13),
(29, 1),
(29, 9),
(29, 12),
(29, 13),
(30, 1),
(30, 9),
(30, 13),
(31, 1),
(31, 9),
(31, 13),
(32, 1),
(32, 13),
(33, 1),
(33, 9),
(33, 11),
(33, 12),
(33, 13),
(34, 1),
(34, 9),
(34, 11),
(34, 13),
(35, 1),
(35, 9),
(35, 11),
(35, 13),
(36, 1),
(36, 11),
(36, 13),
(37, 1),
(37, 9),
(37, 12),
(37, 13),
(38, 1),
(38, 9),
(38, 13),
(39, 1),
(39, 9),
(39, 13),
(40, 1),
(40, 13),
(41, 1),
(41, 9),
(41, 11),
(41, 13),
(42, 1),
(42, 9),
(42, 11),
(42, 13),
(43, 1),
(43, 9),
(43, 11),
(43, 13),
(44, 1),
(44, 11),
(44, 13),
(46, 1),
(47, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supervisor_name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `job_title_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `supervisor_name_ar`, `supervisor_name_en`, `email`, `phone_number`, `profile_pic`, `dept_id`, `job_title_id`, `email_verified_at`, `password`, `role_name`, `Status`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'admin', 'admin@admin.com', '0548809871', 'uploads/profiles/supervisors/1/logo.png', NULL, 1, NULL, '$2y$10$n3yMwBohREWlA4jqQh3rlOAfymVGQoFtLHvHyLxe84DF18KA8HdUW', 'مدير النظام', 'active', NULL, NULL, NULL, '2022-05-26 12:53:01'),
(134, 'ابراهيم الوابل', 'IbrahimAlwabel', 'ibrahim.alwabel@daralbena.com', '0567894977', NULL, 15, 5, NULL, '$2y$10$sg.YewH9gsIHzE.7PDbjru4/qKnazWtxuMbkadexifxyXxHqAZQ92', 'مدير المشاريع', 'active', NULL, NULL, '2022-05-24 11:56:41', '2022-06-22 06:10:42'),
(135, 'احمد الغامدي', 'ahmed alghamdi', 'a.alghamdi@daralbena.com', '0592711798', NULL, 9, 17, NULL, '$2y$10$5/H0SgKO/NmtgWVjaAn28eVuJ5XQ49Qi5XyoaMOF0BO9atM.Bff6O', 'مدير الموارد البشرية', 'active', NULL, NULL, '2022-06-19 09:50:55', '2022-07-17 11:12:40'),
(136, 'اسماعيل', 'ismail', 'ismail@daralbena.com', '0556790299', NULL, 9, 13, NULL, '$2y$10$DYu.gVzO2IZZH48blKP2V.pt3hq1B.t4LvVtYWpoPIotCK3m/Oa2G', 'مدير النظام', 'active', NULL, NULL, '2022-06-19 10:27:12', '2022-06-26 09:36:04'),
(137, 'بدر البراك', 'Badr Al-Barrak', 'b.albarrak@daralbena.com', '0564646459', NULL, 11, 12, NULL, '$2y$10$qIXMsfReK/CigmGULVMc0uNjQjM3CWKWetTjZC.l77fdWVx5S.55e', 'المشرف العام', 'active', NULL, NULL, '2022-06-22 05:47:05', '2022-06-22 06:11:56'),
(138, 'محمد مكين', 'Mohammed Makin', 'makeendaralbena@gmail.com', '0545345761', NULL, 3, 2, NULL, '$2y$10$kt/Oc26hWt7VERQfpFFxkepxaUaQgJ/q7lxCXW5HwZPXMUtWpaymO', 'مدير مالى', 'active', NULL, NULL, '2022-06-22 06:16:19', '2022-06-22 06:16:19'),
(139, 'test', 'test', 'test@test.com', '05123456789', NULL, 2, 17, NULL, '$2y$10$wOnr30b.e4jEx2J8kKaccOxxgua2L6Q3Sff6DR1bvQdvxIpKAn0A6', 'مدير الموارد البشرية', 'active', NULL, NULL, '2022-07-17 17:53:42', '2022-07-18 13:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_password_resets`
--

CREATE TABLE `supervisor_password_resets` (
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisor_password_resets`
--

INSERT INTO `supervisor_password_resets` (`phone_number`, `otp`, `created_at`) VALUES
('0548809871', '1848', '2022-05-22 18:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_project`
--

CREATE TABLE `supervisor_project` (
  `id` int(11) NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor_project`
--

INSERT INTO `supervisor_project` (`id`, `supervisor_id`, `project_id`, `created_at`, `updated_at`) VALUES
(18, 134, 5, '2022-05-24 11:56:41', '2022-05-24 11:56:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id_6` (`dept_id`),
  ADD KEY `project_id_6` (`project_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `application_reviewer`
--
ALTER TABLE `application_reviewer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `dept_id_7` (`dept_id`),
  ADD KEY `job_title_id_7` (`job_title_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nationality_id_9` (`nationality_id`),
  ADD KEY `job_title_id_9` (`job_title_id`),
  ADD KEY `application_id_2` (`application_id`),
  ADD KEY `employee_id_9` (`employee_id`);

--
-- Indexes for table `depts`
--
ALTER TABLE `depts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept_job_title`
--
ALTER TABLE `dept_job_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_job_title_dept_id_index` (`dept_id`),
  ADD KEY `dept_job_title_job_title_id_index` (`job_title_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`),
  ADD KEY `dept_id_4` (`dept_id`),
  ADD KEY `project_id_4` (`project_id`),
  ADD KEY `job_title_id_4` (`job_title_id`),
  ADD KEY `nationality_id_4` (`nationality_id`);

--
-- Indexes for table `employees_transfers`
--
ALTER TABLE `employees_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `old_dept_id` (`old_dept_id`),
  ADD KEY `new_dept_id` (`new_dept_id`),
  ADD KEY `old_project_id` (`old_project_id`),
  ADD KEY `new_project_id` (`new_project_id`);

--
-- Indexes for table `employee_cert`
--
ALTER TABLE `employee_cert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id_12` (`employee_id`);

--
-- Indexes for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id_5` (`dept_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nationality_id_5` (`nationality_id`),
  ADD KEY `job_title_id_5` (`job_title_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `renewal`
--
ALTER TABLE `renewal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_id_3` (`contract_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`),
  ADD KEY `dept_id_2` (`dept_id`),
  ADD KEY `job_title_id` (`job_title_id`);

--
-- Indexes for table `supervisor_project`
--
ALTER TABLE `supervisor_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_id` (`supervisor_id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `application_reviewer`
--
ALTER TABLE `application_reviewer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `depts`
--
ALTER TABLE `depts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `dept_job_title`
--
ALTER TABLE `dept_job_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees_transfers`
--
ALTER TABLE `employees_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_cert`
--
ALTER TABLE `employee_cert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `renewal`
--
ALTER TABLE `renewal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `supervisor_project`
--
ALTER TABLE `supervisor_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `dept_id_6` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_id` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_id_6` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `application_reviewer`
--
ALTER TABLE `application_reviewer`
  ADD CONSTRAINT `application_id` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dept_id_7` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_title_id_7` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `application_id_2` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_id_9` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_title_id_9` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nationality_id_9` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `dept_id_4` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_title_id_4` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nationality_id_4` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_id_4` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees_transfers`
--
ALTER TABLE `employees_transfers`
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `new_dept_id` FOREIGN KEY (`new_dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `new_project_id` FOREIGN KEY (`new_project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `old_dept_id` FOREIGN KEY (`old_dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `old_project_id` FOREIGN KEY (`old_project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_cert`
--
ALTER TABLE `employee_cert`
  ADD CONSTRAINT `employee_id_12` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_titles`
--
ALTER TABLE `job_titles`
  ADD CONSTRAINT `dept_id_5` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `job_title_id_5` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nationality_id_5` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `dept_id` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `renewal`
--
ALTER TABLE `renewal`
  ADD CONSTRAINT `contract_id_3` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `dept_id_2` FOREIGN KEY (`dept_id`) REFERENCES `depts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_title_id` FOREIGN KEY (`job_title_id`) REFERENCES `job_titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisor_project`
--
ALTER TABLE `supervisor_project`
  ADD CONSTRAINT `project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisor_id` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
