-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Hazırlanma Vaxtı: 25 Okt, 2021 saat 10:07
-- Server versiyası: 8.0.21
-- PHP Versiyası: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Verilənlər Bazası: `newsystem`
--

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `academic_hours`
--

DROP TABLE IF EXISTS `academic_hours`;
CREATE TABLE IF NOT EXISTS `academic_hours` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `minutes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `academic_hours_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `academic_hours`
--

INSERT INTO `academic_hours` (`id`, `note`, `price`, `minutes`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'note', 1, '30', 1, '2021-09-03 07:07:21', '2021-09-03 07:07:21', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `age_categories`
--

DROP TABLE IF EXISTS `age_categories`;
CREATE TABLE IF NOT EXISTS `age_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `age_categories_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `age_categories`
--

INSERT INTO `age_categories` (`id`, `note`, `title`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Young', 'Young', 1, '2021-09-03 07:05:22', '2021-09-03 07:05:22', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED DEFAULT NULL,
  `student` tinyint DEFAULT NULL,
  `manager` tinyint DEFAULT NULL,
  `teacher` tinyint DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_company_foreign` (`company`),
  KEY `announcements_user_foreign` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `announcements`
--

INSERT INTO `announcements` (`id`, `company`, `user`, `student`, `manager`, `teacher`, `note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Yeni sistem yaradildi.', 0, '2021-09-25 03:23:02', '2021-09-25 03:25:26', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `map` bigint UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_map_foreign` (`map`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `attendance_maps`
--

DROP TABLE IF EXISTS `attendance_maps`;
CREATE TABLE IF NOT EXISTS `attendance_maps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `office` bigint UNSIGNED NOT NULL,
  `teacher` bigint UNSIGNED DEFAULT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `student` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_maps_company_foreign` (`company`),
  KEY `attendance_maps_office_foreign` (`office`),
  KEY `attendance_maps_teacher_foreign` (`teacher`),
  KEY `attendance_maps_lesson_foreign` (`lesson`),
  KEY `attendance_maps_student_foreign` (`student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_company_foreign` (`company`),
  KEY `books_assignee_foreign` (`assignee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `companies`
--

INSERT INTO `companies` (`id`, `name`, `mobile`, `phone`, `email`, `password`, `address`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedin`, `logo`, `currency`, `status`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'British Centre', '+994514598208', NULL, 'mqalayciyev@mail.ru', '$2y$10$ZU9zp.grpRBEK.hkHa2Y2u8s7cCBhmDTjjCW8WJWvkPoIo1xLBbqq', 'Cefer Cabbarli 44 Caspian Plaza', NULL, NULL, NULL, NULL, NULL, 'http://127.0.0.1:8000/assets/british-centre/british centre_logo_1630658514.png', 'azn', 1, 1, '2021-09-01 09:16:47', '2021-10-12 05:06:18', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `company_payments`
--

DROP TABLE IF EXISTS `company_payments`;
CREATE TABLE IF NOT EXISTS `company_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_payments_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `company_payments`
--

INSERT INTO `company_payments` (`id`, `amount`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '150', 1, '2021-10-22 14:12:34', '2021-10-22 14:12:42', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `corparate_clients`
--

DROP TABLE IF EXISTS `corparate_clients`;
CREATE TABLE IF NOT EXISTS `corparate_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `corparate_clients_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `corparate_clients`
--

INSERT INTO `corparate_clients` (`id`, `name`, `address`, `position`, `mobile`, `phone`, `email`, `website`, `note`, `status`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mehemmed Qalayciyev', 'Baki Huseyinbala Eliyev 9', NULL, '+994514598208', '+994514598208', 'qalayciyev@gmail.com', 'https://inova.az/', 'dasfsdf', '1', 1, '2021-09-03 05:14:07', '2021-09-25 03:20:27', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `demo_lessons`
--

DROP TABLE IF EXISTS `demo_lessons`;
CREATE TABLE IF NOT EXISTS `demo_lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `office` bigint UNSIGNED NOT NULL,
  `teacher` bigint UNSIGNED DEFAULT NULL,
  `student` bigint UNSIGNED NOT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demo_lessons_company_foreign` (`company`),
  KEY `demo_lessons_office_foreign` (`office`),
  KEY `demo_lessons_teacher_foreign` (`teacher`),
  KEY `demo_lessons_student_foreign` (`student`),
  KEY `demo_lessons_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `demo_lessons`
--

INSERT INTO `demo_lessons` (`id`, `company`, `office`, `teacher`, `student`, `lesson`, `date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 4, 1, '2021-09-10T19:20', '0', '2021-09-03 09:18:42', '2021-09-03 09:18:42', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `student` bigint UNSIGNED DEFAULT NULL,
  `teacher` bigint UNSIGNED DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_company_foreign` (`company`),
  KEY `evaluations_student_foreign` (`student`),
  KEY `evaluations_teacher_foreign` (`teacher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `office` bigint UNSIGNED NOT NULL,
  `type` bigint UNSIGNED DEFAULT NULL,
  `test` bigint UNSIGNED NOT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exams_company_foreign` (`company`),
  KEY `exams_office_foreign` (`office`),
  KEY `exams_type_foreign` (`type`),
  KEY `test` (`test`),
  KEY `added_by` (`added_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `exams`
--

INSERT INTO `exams` (`id`, `name`, `company`, `office`, `type`, `test`, `added_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Exam 1', 1, 1, 1, 2, 2, '1', '2021-10-11 04:53:44', '2021-10-11 04:53:44', NULL),
(3, 'Exam 2', 1, 1, 1, 2, 3, '1', '2021-10-11 05:30:58', '2021-10-11 05:30:58', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `exam_levels`
--

DROP TABLE IF EXISTS `exam_levels`;
CREATE TABLE IF NOT EXISTS `exam_levels` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam` bigint UNSIGNED NOT NULL,
  `level` bigint UNSIGNED NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_levels_company_foreign` (`company`),
  KEY `exam_levels_exam_foreign` (`exam`),
  KEY `exam_levels_level_foreign` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `exam_levels`
--

INSERT INTO `exam_levels` (`id`, `exam`, `level`, `company`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2021-10-11 04:53:44', '2021-10-11 04:53:44'),
(2, 3, 1, 1, '2021-10-11 05:30:58', '2021-10-11 05:30:58');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `exam_results`
--

DROP TABLE IF EXISTS `exam_results`;
CREATE TABLE IF NOT EXISTS `exam_results` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `exam` bigint UNSIGNED NOT NULL,
  `student` bigint UNSIGNED NOT NULL,
  `question` bigint UNSIGNED NOT NULL,
  `answer` bigint UNSIGNED NOT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_results_company_foreign` (`company`),
  KEY `exam_results_exam_foreign` (`exam`),
  KEY `exam_results_student_foreign` (`student`),
  KEY `exam_results_question_foreign` (`question`),
  KEY `exam_results_answer_foreign` (`answer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `exam_types`
--

DROP TABLE IF EXISTS `exam_types`;
CREATE TABLE IF NOT EXISTS `exam_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_types_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `exam_types`
--

INSERT INTO `exam_types` (`id`, `title`, `note`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Exam Type 1', 'Exam Type 1', 1, '2021-09-03 07:04:05', '2021-09-03 07:04:05', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `group_lessons`
--

DROP TABLE IF EXISTS `group_lessons`;
CREATE TABLE IF NOT EXISTS `group_lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `office` bigint UNSIGNED NOT NULL,
  `level` bigint UNSIGNED DEFAULT NULL,
  `hours` bigint NOT NULL,
  `teacher` bigint UNSIGNED DEFAULT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `capacity` int NOT NULL,
  `age_category` bigint UNSIGNED DEFAULT NULL,
  `type` bigint UNSIGNED DEFAULT NULL,
  `price` bigint UNSIGNED DEFAULT NULL,
  `monday` tinyint DEFAULT NULL,
  `tuesday` tinyint DEFAULT NULL,
  `wednesday` tinyint DEFAULT NULL,
  `thursday` tinyint DEFAULT NULL,
  `friday` tinyint DEFAULT NULL,
  `saturday` tinyint DEFAULT NULL,
  `sunday` tinyint DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_lessons_company_foreign` (`company`),
  KEY `group_lessons_office_foreign` (`office`),
  KEY `group_lessons_teacher_foreign` (`teacher`),
  KEY `group_lessons_level_foreign` (`level`),
  KEY `group_lessons_price_foreign` (`price`),
  KEY `group_lessons_type_foreign` (`type`),
  KEY `group_lessons_age_category_foreign` (`age_category`),
  KEY `group_lessons_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `group_lessons`
--

INSERT INTO `group_lessons` (`id`, `name`, `company`, `office`, `level`, `hours`, `teacher`, `lesson`, `capacity`, `age_category`, `type`, `price`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Qrup 1', 1, 1, 1, 1, 3, 1, 3, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-09-03 08:31:14', '2021-09-03 08:31:14', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `group_students`
--

DROP TABLE IF EXISTS `group_students`;
CREATE TABLE IF NOT EXISTS `group_students` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `group` bigint UNSIGNED NOT NULL,
  `student` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_students_company_foreign` (`company`),
  KEY `group_students_group_foreign` (`group`),
  KEY `group_students_student_foreign` (`student`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `group_students`
--

INSERT INTO `group_students` (`id`, `company`, `group`, `student`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 4, '2021-10-11 02:41:21', '2021-10-11 02:41:21', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `group_study_days`
--

DROP TABLE IF EXISTS `group_study_days`;
CREATE TABLE IF NOT EXISTS `group_study_days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `group` bigint UNSIGNED NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `monday` tinyint NOT NULL DEFAULT '0',
  `tuesday` tinyint NOT NULL DEFAULT '0',
  `wednesday` tinyint NOT NULL DEFAULT '0',
  `thursday` tinyint NOT NULL DEFAULT '0',
  `friday` tinyint NOT NULL DEFAULT '0',
  `saturday` tinyint NOT NULL DEFAULT '0',
  `sunday` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_study_days_company_foreign` (`company`),
  KEY `group_study_days_group_foreign` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `group_study_days`
--

INSERT INTO `group_study_days` (`id`, `group`, `company`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, 0, 1, 0, 0, 0, 0, '2021-09-03 08:31:14', '2021-09-03 08:31:14', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_company_foreign` (`company`),
  KEY `images_assignee_foreign` (`assignee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `leads`
--

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignee` bigint UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_company_foreign` (`company`),
  KEY `leads_assignee_foreign` (`assignee`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `leads`
--

INSERT INTO `leads` (`id`, `first_name`, `last_name`, `title`, `purpose`, `source`, `email`, `mobile`, `phone`, `address`, `assignee`, `status`, `description`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Faiq', 'Aslanov', NULL, 'asdasdasd75', 'Call', 'qalayciyev@gmail.com', '+994514598208', '+994707250903', 'Baki Huseyinbala Eliyev 9', 1, NULL, 'asdasd', 1, '2021-09-03 05:07:49', '2021-10-11 07:09:35', NULL),
(2, 'Ruslan', 'Qurbanov', NULL, 'asdasdasd75', 'Letter', 'qalayciyev@gmail.com', '+994514598208', NULL, 'Baki Huseyinbala Eliyev 9', 3, NULL, 'uikk', 1, '2021-10-11 06:55:31', '2021-10-11 06:59:37', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `leads_notes`
--

DROP TABLE IF EXISTS `leads_notes`;
CREATE TABLE IF NOT EXISTS `leads_notes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `leads` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_notes_leads_foreign` (`leads`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `leads_notes`
--

INSERT INTO `leads_notes` (`id`, `leads`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, '2021-09-03 05:07:49', '2021-09-03 05:09:37', '2021-09-03 05:09:37'),
(2, 1, 'Leads noteasdd', '2021-09-03 05:09:27', '2021-09-03 05:09:43', NULL),
(3, 1, 'Leads note', '2021-09-03 05:09:27', '2021-09-03 05:09:35', '2021-09-03 05:09:35'),
(4, 2, NULL, '2021-10-11 06:55:31', '2021-10-11 06:57:17', '2021-10-11 06:57:17'),
(5, 2, 'Leads note', '2021-10-11 06:57:13', '2021-10-11 07:06:36', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `learning_types`
--

DROP TABLE IF EXISTS `learning_types`;
CREATE TABLE IF NOT EXISTS `learning_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `learning_types_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `learning_types`
--

INSERT INTO `learning_types` (`id`, `note`, `title`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Learning Type 1', 'Learning Type 1', 1, '2021-09-03 07:03:15', '2021-09-03 07:03:15', NULL),
(2, 'Learning Type 1', 'Learning Type 1', 1, '2021-09-03 07:03:15', '2021-09-03 07:03:21', '2021-09-03 07:03:21');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `company`, `note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 1, 'English Language', 1, '2021-09-03 07:00:47', '2021-10-12 03:36:38', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE IF NOT EXISTS `levels` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `levels_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `levels`
--

INSERT INTO `levels` (`id`, `note`, `title`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Beginner Level', 'Beginner', 1, '2021-09-03 07:02:05', '2021-09-03 07:02:10', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audio_company_foreign` (`company`),
  KEY `audio_assignee_foreign` (`assignee`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `media`
--

INSERT INTO `media` (`id`, `company`, `assignee`, `title`, `file`, `type`, `note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'socar', 'http://127.0.0.1:8000/assets/british-centre/media/british-centre_image_1633437849.jpg', 'image', 'socar image logo', '0', '2021-10-05 08:44:09', '2021-10-05 08:44:09', NULL),
(2, 1, 3, 'Audio', 'http://127.0.0.1:8000/assets/british-centre/media/british-centre_audio_1633511416.mp3', 'audio', 'Audio file', '0', '2021-10-06 05:10:16', '2021-10-06 05:10:16', NULL),
(3, 1, 1, 'book', 'http://127.0.0.1:8000/assets/british-centre/media/british-centre_book_1633512829.docx', 'book', 'book file', '0', '2021-10-06 05:33:49', '2021-10-06 05:33:49', NULL),
(4, 1, 1, 'English Lesson', 'http://127.0.0.1:8000/assets/british-centre/media/british-centre_video_1633513193.mp4', 'video', 'English Lesson', '0', '2021-10-06 05:39:53', '2021-10-06 05:39:53', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender` bigint UNSIGNED NOT NULL,
  `receiving` bigint UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_company_foreign` (`company`),
  KEY `messages_sender_foreign` (`sender`),
  KEY `messages_receiving_foreign` (`receiving`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiving`, `message`, `file_name`, `file_url`, `status`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 'Salam', NULL, NULL, 1, 1, '2021-10-05 03:58:28', '2021-10-12 06:13:50', NULL),
(4, 4, 1, 'hey', NULL, NULL, 1, 1, '2021-10-05 04:29:44', '2021-10-12 06:13:50', NULL),
(5, 4, 1, 'salam', NULL, NULL, 1, 1, '2021-10-05 04:33:15', '2021-10-12 06:13:50', NULL),
(6, 4, 1, 'salammm', NULL, NULL, 1, 1, '2021-10-05 04:35:37', '2021-10-12 06:13:50', NULL),
(7, 4, 1, 'salammmm', NULL, NULL, 1, 1, '2021-10-05 04:36:04', '2021-10-12 06:13:50', NULL),
(9, 4, 1, 'email list', 'arif_suleymanov_1633423191.csv', 'http://127.0.0.1:8000/assets/british-centre/message_files', 1, 1, '2021-10-05 04:39:51', '2021-10-12 06:13:50', NULL),
(10, 1, 4, 'salam', NULL, NULL, 0, 1, '2021-10-06 02:51:21', '2021-10-07 02:27:16', NULL),
(11, 1, 4, 'hey', 'mehemmed_qalayciyev_1633510045.docx', 'http://127.0.0.1:8000/assets/british-centre/message_files', 0, 1, '2021-10-06 04:47:25', '2021-10-07 02:27:16', NULL),
(12, 4, 2, 'salam', NULL, NULL, 1, 1, '2021-10-07 03:23:25', '2021-10-12 06:13:50', NULL),
(13, 2, 4, 'salam...', NULL, NULL, 0, 1, '2021-10-07 03:27:33', '2021-10-07 03:27:33', '2021-10-04 07:40:23');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2021_04_22_095352_create_companies_table', 1),
(7, '2021_04_22_122325_create_age_categories_table', 2),
(8, '2021_04_22_122410_create_levels_table', 3),
(9, '2021_04_22_122457_create_learning_types_table', 4),
(10, '2021_04_22_122558_create_academic_hours_table', 5),
(11, '2021_04_22_122630_create_teacher_payments_table', 6),
(12, '2021_04_22_122900_create_offices_table', 7),
(13, '2021_04_22_125831_create_permissions_table', 8),
(14, '2021_04_22_122831_create_corparate_clients_table', 9),
(15, '2014_10_12_000000_create_users_table', 10),
(16, '2021_05_03_111129_create_teacher_levels_table', 11),
(17, '2021_04_22_130427_create_lessons_table', 12),
(18, '2021_04_22_122244_create_teacher_lessons_table', 13),
(19, '2021_04_23_075524_create_exam_types_table', 14),
(20, '2021_04_22_123708_create_exams_table', 15),
(49, '2021_05_28_114258_create_exam_levels_table', 36),
(22, '2021_04_22_122725_create_leads_table', 17),
(23, '2021_04_22_124029_create_tests_table', 18),
(24, '2021_04_23_081558_create_questions_table', 19),
(25, '2021_04_23_103324_create_question_answers_table', 20),
(26, '2021_04_22_123910_create_exam_results_table', 21),
(27, '2021_04_22_123851_create_books_table', 22),
(28, '2021_04_22_123929_create_videos_table', 22),
(29, '2021_04_22_123947_create_images_table', 22),
(30, '2021_04_22_124002_create_audio_table', 22),
(31, '2021_04_22_125029_create_leads_notes_table', 23),
(32, '2021_05_03_130436_create_student_study_days_table', 24),
(33, '2021_05_03_135523_create_student_lessons_table', 24),
(34, '2021_04_22_122700_create_tasks_table', 25),
(35, '2021_04_22_122748_create_messages_table', 26),
(36, '2021_04_22_123206_create_announcements_table', 27),
(37, '2021_04_22_123546_create_group_lessons_table', 28),
(38, '2021_04_22_123614_create_private_lessons_table', 28),
(39, '2021_04_22_123644_create_demo_lessons_table', 29),
(40, '2021_05_26_075048_create_group_study_days_table', 30),
(41, '2021_05_26_131754_create_private_study_days_table', 30),
(42, '2021_04_23_101207_create_group_students_table', 31),
(43, '2021_04_22_124251_create_evaluations_table', 32),
(44, '2021_04_22_124639_create_notifications_table', 32),
(45, '2021_04_22_124121_create_schedulings_table', 33),
(46, '2021_04_22_124153_create_payments_table', 33),
(47, '2021_04_22_123818_create_attendance_maps_table', 34),
(48, '2021_04_23_080500_create_attendances_table', 35),
(50, '2014_10_12_100000_create_password_resets_table', 37),
(51, '2021_10_22_133900_create_company_payments_table', 37);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `from` bigint UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_company_foreign` (`company`),
  KEY `notifications_user_foreign` (`user`),
  KEY `notifications_from_foreign` (`from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('269931ab26f3d8112638f81a1a2a754d071b416bcbc16472228aaa09918e10695aa8177b72765f7a', 4, 8, 'User Logged', '[]', 1, '2021-10-05 03:20:03', '2021-10-05 03:20:03', '2021-10-06 07:20:04'),
('21a03ff1f40f04aa3e3e146f3bd3cd0b745ae2f9cd82c2dd11784e8b21d40d1a77f65a4a24f8e7b4', 1, 8, 'User Logged', '[]', 1, '2021-09-03 04:24:06', '2021-09-03 04:24:06', '2021-09-04 08:24:06'),
('b51ba76b7f8cad493231f1dad021fddadc7317023395e5ad5e36ae945850ab49d949edf80440994c', 1, 8, 'User Logged', '[]', 1, '2021-09-03 04:14:54', '2021-09-03 04:14:54', '2021-09-04 08:14:54'),
('75e430b6125a368e205c3a0ccc311fbf6993d3c48699c0cee8b87e1ee4fa9a79328753f3b65a2cb3', 1, 8, 'User Logged', '[]', 1, '2021-09-03 04:13:16', '2021-09-03 04:13:16', '2021-09-04 08:13:16'),
('992b2140a1c602e6954581e7cc201e97645bec0f7f4acefb0e1ec37dae73e8d27fa2471ceeb08fe7', 1, 8, 'User Logged', '[]', 1, '2021-09-03 03:47:01', '2021-09-03 03:47:01', '2021-09-04 07:47:02'),
('57726341492318e35035172d0caf60bd3c37f6af9c2454c21ad9d9bd79336557708c7e93f0e52f58', 1, 8, 'User Logged', '[]', 1, '2021-09-02 02:56:36', '2021-09-02 02:56:36', '2021-09-03 06:56:38'),
('1a6c6dac007dcb061d38a61caf8eafcdbe5b0891a62131abc20646637322d9e1d9cbf20881e07165', 1, 8, 'User Logged', '[]', 0, '2021-10-05 07:25:02', '2021-10-05 07:25:02', '2021-10-06 11:25:02'),
('b49cea46ee5d6eb8e4a84f777a5ea80735c992f9eb99ef3b9100b6818587b1562e6e5f6346f2a6d7', 1, 8, 'User Logged', '[]', 1, '2021-10-05 07:28:50', '2021-10-05 07:28:50', '2021-10-06 11:28:50'),
('a50d5f64d359ce0cb4bc9f3d4a3121fa35ba5246a2d3444631d0253f7ee027835bd9aa4405898955', 1, 8, 'User Logged', '[]', 1, '2021-10-05 08:05:11', '2021-10-05 08:05:11', '2021-10-06 12:05:11'),
('7e89dca29cdb216feec607c7cb04ce7224c043dbad1c25838f5ecd5da231743e80b1b1a3aed5e807', 2, 8, 'User Logged', '[]', 1, '2021-10-05 08:09:50', '2021-10-05 08:09:50', '2021-10-06 12:09:50'),
('b1ce815d14eb62610947cc679f6de07267f3a71642463399446c259c784ecb12ef366964ae14ac02', 3, 8, 'User Logged', '[]', 0, '2021-10-05 08:16:47', '2021-10-05 08:16:47', '2021-10-06 12:16:47'),
('ac6c2e2c86360ce4251822632a9b757365eb7b9f2893a5117ea6b6139856f44ffbbda61097365f9f', 1, 8, 'User Logged', '[]', 1, '2021-10-06 02:35:21', '2021-10-06 02:35:21', '2021-10-07 06:35:26'),
('83e31e91480919b40778b83d94e95fde274ae5ab657fe8771d09e9899d67aea4e24bff9140d1fdae', 3, 8, 'User Logged', '[]', 0, '2021-10-06 02:35:50', '2021-10-06 02:35:50', '2021-10-07 06:35:50'),
('7f50532187aa98a88714974aed92b1b67ca0a052376743184fea60803627ad86310cd3033723f4c1', 4, 8, 'User Logged', '[]', 0, '2021-10-06 02:36:13', '2021-10-06 02:36:13', '2021-10-07 06:36:13'),
('e763b3a305cf97a19e638c2d0ab43362d3dbc36367894146b95876db841f1d3da7f2cd95033bfdf9', 1, 8, 'User Logged', '[]', 1, '2021-10-06 06:25:16', '2021-10-06 06:25:16', '2021-10-07 10:25:17'),
('8fce1d0ae0b8d07d4e2b88bc9199b050caa0b657c69ef55f8428659c64e029be8692b94b0f368e0c', 1, 8, 'User Logged', '[]', 1, '2021-10-06 06:35:20', '2021-10-06 06:35:20', '2021-10-07 10:35:20'),
('a97695b1bc263052be7884b2dc6335b19992b1fc7fa69bd2b1a3dc2f3bbb328a4cf6136149e843c6', 1, 8, 'User Logged', '[]', 1, '2021-10-06 06:36:11', '2021-10-06 06:36:11', '2021-10-07 10:36:11'),
('06478ccc32a0f0c281442331e64ce7d90339cd3ffdbafe9eaec1c989bb8c6e1191a28866bb8fe34d', 1, 8, 'User Logged', '[]', 1, '2021-10-06 06:37:54', '2021-10-06 06:37:54', '2021-10-07 10:37:54'),
('b516909d9b45184ee2b82c7f42da09f2094d24d2cba0f157721c149cf3fcb6fae309370df2ff944a', 1, 8, 'User Logged', '[]', 1, '2021-10-06 06:44:46', '2021-10-06 06:44:46', '2021-10-07 10:44:46'),
('69d17e3d6379aadc637831ec676d7dbf58fbd8ea46821b0d36eb8e77a6b4a0b368fe8e9b1fff61ec', 1, 8, 'User Logged', '[]', 1, '2021-10-06 07:23:03', '2021-10-06 07:23:03', '2021-10-07 11:23:03'),
('e672bcf77a41a7487fe2a2502eeecad2f71f4ef641476c5a608c6e8f6c963a7444c217716ea08816', 1, 8, 'User Logged', '[]', 1, '2021-10-06 07:23:38', '2021-10-06 07:23:38', '2021-10-07 11:23:39'),
('2fc8f74d9018d2f137b549e406e131f5f339982553523a5ffeb05dc8ffc9c2b2a0a90bb1087bb046', 2, 8, 'User Logged', '[]', 1, '2021-10-07 03:27:15', '2021-10-07 03:27:15', '2021-10-08 07:27:15'),
('611084eaa8d0d8ada05c0ffc12e8fceb696c4aa50029da377c51a9c18226954effea4bca1b33d979', 1, 8, 'User Logged', '[]', 0, '2021-10-11 07:41:39', '2021-10-11 07:41:39', '2021-10-12 11:41:40');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(7, NULL, 'php artisan passport:install', 'wU4yYYI4xuNCDLjahsHY8F4MaBexWZMGChRPkx7t', NULL, 'http://localhost', 1, 0, 0, '2021-09-01 10:09:56', '2021-09-01 10:09:56'),
(8, NULL, 'Laravel Personal Access Client', 'dYIDyRFmmscLEwc4eezlJ5YaxxILHZ2GGIIBpQwd', NULL, 'http://localhost', 1, 0, 0, '2021-09-01 10:10:48', '2021-09-01 10:10:48'),
(9, NULL, 'Laravel Password Grant Client', 'YjnRRzphUV6NipOfNgt5ts9zanbZmETIn4hLOhBi', 'users', 'http://localhost', 0, 1, 0, '2021-09-01 10:10:48', '2021-09-01 10:10:48');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(4, 7, '2021-09-01 10:09:56', '2021-09-01 10:09:56'),
(5, 8, '2021-09-01 10:10:48', '2021-09-01 10:10:48');

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `offices`
--

DROP TABLE IF EXISTS `offices`;
CREATE TABLE IF NOT EXISTS `offices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classrooms` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offices_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `offices`
--

INSERT INTO `offices` (`id`, `name`, `address`, `mobile`, `phone`, `email`, `classrooms`, `capacity`, `note`, `status`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Caspian Plaza', 'Cefer Cabbarli 44', '+994514598208', '+994514598208', 'qalayciyev@gmail.com', '9', '30', 'Caspian Plaza Bas Ofisi', '1', 1, '2021-09-03 05:15:51', '2021-09-25 03:20:35', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `payer` bigint UNSIGNED DEFAULT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `office` bigint UNSIGNED DEFAULT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_due` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payment_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_company_foreign` (`company`),
  KEY `payments_payer_foreign` (`payer`),
  KEY `payments_assignee_foreign` (`assignee`),
  KEY `payments_office_foreign` (`office`),
  KEY `payments_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `payments`
--

INSERT INTO `payments` (`id`, `company`, `payer`, `assignee`, `office`, `lesson`, `status`, `payment_value`, `price`, `payment_due`, `note`, `payment_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, NULL, 1, 1, 'Incompletely paid', '1', '2', '-1', 'tam odenilmeyib', '2021-09-25', '2021-09-25 03:33:41', '2021-10-12 05:05:29', NULL),
(2, 1, 4, NULL, 1, 1, 'Paid', '3', '2', '1', 'tam ödənilib', '2021-09-24', '2021-09-25 03:52:57', '2021-09-25 03:52:57', NULL),
(3, 1, 4, NULL, 1, 1, 'Incompletely paid', '1', '2', '-1', '456', '2021-10-12', '2021-10-12 05:02:23', '2021-10-12 05:02:23', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `role` bigint UNSIGNED NOT NULL,
  `delete` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_company_foreign` (`company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `private_lessons`
--

DROP TABLE IF EXISTS `private_lessons`;
CREATE TABLE IF NOT EXISTS `private_lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `hours` bigint NOT NULL,
  `teacher` bigint UNSIGNED DEFAULT NULL,
  `student` bigint UNSIGNED NOT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `price` bigint UNSIGNED DEFAULT NULL,
  `monday` tinyint DEFAULT NULL,
  `tuesday` tinyint DEFAULT NULL,
  `wednesday` tinyint DEFAULT NULL,
  `thursday` tinyint DEFAULT NULL,
  `friday` tinyint DEFAULT NULL,
  `saturday` tinyint DEFAULT NULL,
  `sunday` tinyint DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `private_lessons_company_foreign` (`company`),
  KEY `private_lessons_student_foreign` (`student`),
  KEY `private_lessons_teacher_foreign` (`teacher`),
  KEY `private_lessons_price_foreign` (`price`),
  KEY `private_lessons_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `private_lessons`
--

INSERT INTO `private_lessons` (`id`, `company`, `hours`, `teacher`, `student`, `lesson`, `price`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 4, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2021-09-03 08:47:29', '2021-09-03 09:05:24', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `private_study_days`
--

DROP TABLE IF EXISTS `private_study_days`;
CREATE TABLE IF NOT EXISTS `private_study_days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `private` bigint UNSIGNED NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `monday` tinyint NOT NULL DEFAULT '0',
  `tuesday` tinyint NOT NULL DEFAULT '0',
  `wednesday` tinyint NOT NULL DEFAULT '0',
  `thursday` tinyint NOT NULL DEFAULT '0',
  `friday` tinyint NOT NULL DEFAULT '0',
  `saturday` tinyint NOT NULL DEFAULT '0',
  `sunday` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `private_study_days_company_foreign` (`company`),
  KEY `private_study_days_private_foreign` (`private`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `private_study_days`
--

INSERT INTO `private_study_days` (`id`, `private`, `company`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, 1, 0, 0, 0, 1, 0, 0, 0, '2021-09-03 09:05:24', '2021-09-03 09:05:24', NULL),
(6, 1, 1, 1, 0, 0, 0, 0, 0, 0, '2021-09-03 09:05:24', '2021-09-03 09:05:24', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `test` bigint UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_test_foreign` (`test`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `questions`
--

INSERT INTO `questions` (`id`, `test`, `question`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, '3+5=?', '2021-10-11 05:00:06', '2021-10-11 05:25:16', NULL),
(3, 2, '5*30', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(4, 3, '(8+6)*2=?', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `question_answers`
--

DROP TABLE IF EXISTS `question_answers`;
CREATE TABLE IF NOT EXISTS `question_answers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` bigint UNSIGNED NOT NULL,
  `true` tinyint NOT NULL DEFAULT '0',
  `answer` text COLLATE utf8mb4_unicode_ci,
  `answer_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_answers_question_foreign` (`question`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `question_answers`
--

INSERT INTO `question_answers` (`id`, `question`, `true`, `answer`, `answer_title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 3, 1, '150', 'answer_true', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(12, 3, 0, '1500', 'answer_1', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(13, 3, 0, '50', 'answer_2', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(14, 3, 0, '80', 'answer_3', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(15, 3, 0, '100', 'answer_4', '2021-10-11 05:05:53', '2021-10-11 05:05:53', NULL),
(16, 2, 1, '8', 'answer_true', '2021-10-11 05:25:16', '2021-10-11 05:25:16', NULL),
(17, 2, 0, '7', 'answer_1', '2021-10-11 05:25:16', '2021-10-11 05:25:16', NULL),
(18, 2, 0, '9', 'answer_2', '2021-10-11 05:25:16', '2021-10-11 05:25:16', NULL),
(19, 2, 0, '1', 'answer_3', '2021-10-11 05:25:16', '2021-10-11 05:25:16', NULL),
(20, 2, 0, '4', 'answer_4', '2021-10-11 05:25:16', '2021-10-11 05:25:16', NULL),
(21, 4, 1, '28', 'answer_true', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL),
(22, 4, 0, '15', 'answer_1', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL),
(23, 4, 0, '32', 'answer_2', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL),
(24, 4, 0, '20', 'answer_3', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL),
(25, 4, 0, '50', 'answer_4', '2021-10-11 05:32:31', '2021-10-11 05:32:31', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `schedulings`
--

DROP TABLE IF EXISTS `schedulings`;
CREATE TABLE IF NOT EXISTS `schedulings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `task` bigint UNSIGNED DEFAULT NULL,
  `date_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_start` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_end` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedulings_company_foreign` (`company`),
  KEY `schedulings_assignee_foreign` (`assignee`),
  KEY `schedulings_task_foreign` (`task`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `student_lessons`
--

DROP TABLE IF EXISTS `student_lessons`;
CREATE TABLE IF NOT EXISTS `student_lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student` bigint UNSIGNED NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `lesson` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_lessons_company_foreign` (`company`),
  KEY `student_lessons_student_foreign` (`student`),
  KEY `student_lessons_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `student_lessons`
--

INSERT INTO `student_lessons` (`id`, `student`, `company`, `lesson`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 1, '2021-09-03 08:35:51', '2021-09-03 08:35:51', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `student_study_days`
--

DROP TABLE IF EXISTS `student_study_days`;
CREATE TABLE IF NOT EXISTS `student_study_days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `student` bigint UNSIGNED NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `monday` tinyint NOT NULL DEFAULT '0',
  `tuesday` tinyint NOT NULL DEFAULT '0',
  `wednesday` tinyint NOT NULL DEFAULT '0',
  `thursday` tinyint NOT NULL DEFAULT '0',
  `friday` tinyint NOT NULL DEFAULT '0',
  `saturday` tinyint NOT NULL DEFAULT '0',
  `sunday` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_study_days_company_foreign` (`company`),
  KEY `student_study_days_student_foreign` (`student`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puspose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignee` bigint UNSIGNED NOT NULL,
  `for_all` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_company_foreign` (`company`),
  KEY `tasks_assignee_foreign` (`assignee`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `tasks`
--

INSERT INTO `tasks` (`id`, `priority`, `client`, `direction`, `method`, `puspose`, `email`, `mobile`, `start_date`, `end_date`, `start_time`, `end_time`, `assignee`, `for_all`, `status`, `note`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-03', '2021-09-10', '12:52', '14:52', 1, NULL, '2', 'xfsdfsdasdasd', 1, '2021-09-03 04:58:19', '2021-10-11 09:36:14', NULL),
(2, '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-05', '2021-10-06', '11:26', '11:26', 4, NULL, '2', 'note', 1, '2021-10-05 03:26:48', '2021-10-05 03:27:53', NULL),
(3, '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-11', '2021-10-13', '17:35', '21:35', 1, NULL, '1', NULL, 1, '2021-10-11 09:36:08', '2021-10-11 09:36:08', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `teacher_lessons`
--

DROP TABLE IF EXISTS `teacher_lessons`;
CREATE TABLE IF NOT EXISTS `teacher_lessons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher` bigint UNSIGNED NOT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_lessons_company_foreign` (`company`),
  KEY `teacher_lessons_teacher_foreign` (`teacher`),
  KEY `teacher_lessons_lesson_foreign` (`lesson`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `teacher_lessons`
--

INSERT INTO `teacher_lessons` (`id`, `teacher`, `lesson`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 3, 1, 1, '2021-10-01 03:34:15', '2021-10-01 03:34:15', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `teacher_levels`
--

DROP TABLE IF EXISTS `teacher_levels`;
CREATE TABLE IF NOT EXISTS `teacher_levels` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher` bigint UNSIGNED NOT NULL,
  `level` bigint UNSIGNED DEFAULT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_levels_company_foreign` (`company`),
  KEY `teacher_levels_teacher_foreign` (`teacher`),
  KEY `teacher_levels_level_foreign` (`level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `teacher_levels`
--

INSERT INTO `teacher_levels` (`id`, `teacher`, `level`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 3, 1, 1, '2021-10-01 03:34:15', '2021-10-01 03:34:15', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `teacher_payments`
--

DROP TABLE IF EXISTS `teacher_payments`;
CREATE TABLE IF NOT EXISTS `teacher_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `minutes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_payments_company_foreign` (`company`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `teacher_payments`
--

INSERT INTO `teacher_payments` (`id`, `title`, `note`, `minutes`, `price`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Salary 1', 'Salary 1', '45', '1.5', 1, '2021-09-03 07:14:00', '2021-09-03 07:14:00', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson` bigint UNSIGNED DEFAULT NULL,
  `for_exam` int NOT NULL DEFAULT '0',
  `level` bigint UNSIGNED DEFAULT NULL,
  `age_category` bigint UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_company_foreign` (`company`),
  KEY `tests_assignee_foreign` (`added_by`),
  KEY `tests_lesson_foreign` (`lesson`),
  KEY `tests_exam_foreign` (`for_exam`),
  KEY `tests_level_foreign` (`level`),
  KEY `tests_age_category_foreign` (`age_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `tests`
--

INSERT INTO `tests` (`id`, `company`, `added_by`, `name`, `lesson`, `for_exam`, `level`, `age_category`, `note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 'English 1', 1, 0, 1, NULL, NULL, '1', '2021-10-11 02:45:42', '2021-10-12 05:02:34', NULL),
(2, 1, 2, 'Test 2', 1, 1, 1, NULL, NULL, '1', '2021-10-11 04:27:35', '2021-10-11 04:27:35', NULL),
(3, 1, 3, 'Test 3', 1, 0, 1, NULL, NULL, '1', '2021-10-11 05:31:35', '2021-10-11 05:31:35', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` int DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `person_first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_relationship` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `login` int NOT NULL,
  `level` bigint UNSIGNED DEFAULT NULL,
  `age_category` bigint UNSIGNED DEFAULT NULL,
  `learning_type` bigint UNSIGNED DEFAULT NULL,
  `corparate` bigint UNSIGNED DEFAULT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `salary` bigint UNSIGNED DEFAULT NULL,
  `permission` bigint UNSIGNED DEFAULT NULL,
  `company` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_company_foreign` (`company`),
  KEY `users_corparate_foreign` (`corparate`),
  KEY `users_permission_foreign` (`permission`),
  KEY `users_level_foreign` (`level`),
  KEY `users_age_category_foreign` (`age_category`),
  KEY `users_learning_type_foreign` (`learning_type`),
  KEY `users_salary_foreign` (`salary`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sxemi çıxarılan cedvel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `image`, `mobile`, `phone`, `address`, `office`, `date`, `gender`, `note`, `person_first_name`, `person_last_name`, `person_relationship`, `person_mobile`, `person_email`, `initial_date`, `initial_contact`, `purpose`, `type`, `status`, `login`, `level`, `age_category`, `learning_type`, `corparate`, `added_by`, `salary`, `permission`, `company`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mehemmed', 'Qalayciyev', 'mqalayciyev@mail.ru', NULL, '$2y$10$ZU9zp.grpRBEK.hkHa2Y2u8s7cCBhmDTjjCW8WJWvkPoIo1xLBbqq', 'http://127.0.0.1:8000/assets/british-centre/profile/mehemmed_qalayciyev_profile_1633433132.webp', '+994514598208', NULL, NULL, 1, '1997-11-19', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-09-01 09:17:13', '2021-10-05 07:30:21', NULL),
(2, 'Arzu', 'Huseynova', 'arzu@gmail.com', NULL, '$2y$10$1IGOJTC4vGTwFLsDTXCNhuDzouVevBdj1W9JpIy7HeilC45UnvabS', 'http://127.0.0.1:8000/assets/british-centre/profile/mehemmed_heybulla_profile_1633435814.webp', '+994514598208', NULL, 'Baki Huseyinbala Eliyev 9', 1, '1995-04-15', 'female', 'ssdasdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, '2021-09-03 05:38:10', '2021-10-05 08:10:53', NULL),
(3, 'Rustem', 'Eliyev', 'rustem@gmail.com', NULL, '$2y$10$XdcO/6x8Yph9t6Qw4/1NW.9RNNhdHLgjFHUk1s.epWjyqcmrbrSLa', 'http://127.0.0.1:8000/assets/british-centre/profile/rustem_eliyev_profile_1633436771.webp', '+994514598208', NULL, 'Baki Huseyinbala Eliyev 9', 1, '1994-08-06', 'male', 'dfgdfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 2, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, NULL, '2021-09-03 07:27:52', '2021-10-05 08:32:06', NULL),
(4, 'Arif', 'Suleymanov', 'arif@gmail.com', NULL, '$2y$10$saCwrvjdBQZmKt4PZs9k7.PJqhaFTzKZlyNjvFqyAxJFAE1X.JkUS', 'http://127.0.0.1:8000/assets/british-centre/profile/arif_suleymanov_profile_1633428142.webp', '+994514598208', '+994707250903', NULL, 1, '1997-11-19', 'male', 'rtgyh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 3, 1, 1, NULL, NULL, 1, NULL, NULL, 1, NULL, '2021-09-03 08:29:04', '2021-10-06 02:36:35', NULL);

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` bigint UNSIGNED NOT NULL,
  `assignee` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `videos_company_foreign` (`company`),
  KEY `videos_assignee_foreign` (`assignee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_hours`
--
ALTER TABLE `academic_hours`
  ADD CONSTRAINT `academic_hours_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `age_categories`
--
ALTER TABLE `age_categories`
  ADD CONSTRAINT `age_categories_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcements_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_map_foreign` FOREIGN KEY (`map`) REFERENCES `attendance_maps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_maps`
--
ALTER TABLE `attendance_maps`
  ADD CONSTRAINT `attendance_maps_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_maps_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `attendance_maps_office_foreign` FOREIGN KEY (`office`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_maps_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `attendance_maps_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `books_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_payments`
--
ALTER TABLE `company_payments`
  ADD CONSTRAINT `company_payments_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `corparate_clients`
--
ALTER TABLE `corparate_clients`
  ADD CONSTRAINT `corparate_clients_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demo_lessons`
--
ALTER TABLE `demo_lessons`
  ADD CONSTRAINT `demo_lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demo_lessons_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `demo_lessons_office_foreign` FOREIGN KEY (`office`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demo_lessons_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demo_lessons_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluations_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`test`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `exams_office_foreign` FOREIGN KEY (`office`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_type_foreign` FOREIGN KEY (`type`) REFERENCES `exam_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `exam_levels`
--
ALTER TABLE `exam_levels`
  ADD CONSTRAINT `exam_levels_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_levels_exam_foreign` FOREIGN KEY (`exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_levels_level_foreign` FOREIGN KEY (`level`) REFERENCES `levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_answer_foreign` FOREIGN KEY (`answer`) REFERENCES `question_answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_exam_foreign` FOREIGN KEY (`exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_question_foreign` FOREIGN KEY (`question`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_results_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD CONSTRAINT `exam_types_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_lessons`
--
ALTER TABLE `group_lessons`
  ADD CONSTRAINT `group_lessons_age_category_foreign` FOREIGN KEY (`age_category`) REFERENCES `age_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_lessons_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_lessons_level_foreign` FOREIGN KEY (`level`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_lessons_office_foreign` FOREIGN KEY (`office`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_lessons_price_foreign` FOREIGN KEY (`price`) REFERENCES `academic_hours` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_lessons_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `group_lessons_type_foreign` FOREIGN KEY (`type`) REFERENCES `learning_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `group_students`
--
ALTER TABLE `group_students`
  ADD CONSTRAINT `group_students_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_students_group_foreign` FOREIGN KEY (`group`) REFERENCES `group_lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_students_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_study_days`
--
ALTER TABLE `group_study_days`
  ADD CONSTRAINT `group_study_days_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_study_days_group_foreign` FOREIGN KEY (`group`) REFERENCES `group_lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `images_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leads_notes`
--
ALTER TABLE `leads_notes`
  ADD CONSTRAINT `leads_notes_leads_foreign` FOREIGN KEY (`leads`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `learning_types`
--
ALTER TABLE `learning_types`
  ADD CONSTRAINT `learning_types_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `levels`
--
ALTER TABLE `levels`
  ADD CONSTRAINT `levels_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `audio_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `audio_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_receiving_foreign` FOREIGN KEY (`receiving`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offices`
--
ALTER TABLE `offices`
  ADD CONSTRAINT `offices_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_office_foreign` FOREIGN KEY (`office`) REFERENCES `offices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_payer_foreign` FOREIGN KEY (`payer`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `private_lessons`
--
ALTER TABLE `private_lessons`
  ADD CONSTRAINT `private_lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_lessons_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `private_lessons_price_foreign` FOREIGN KEY (`price`) REFERENCES `academic_hours` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `private_lessons_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_lessons_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `private_study_days`
--
ALTER TABLE `private_study_days`
  ADD CONSTRAINT `private_study_days_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `private_study_days_private_foreign` FOREIGN KEY (`private`) REFERENCES `private_lessons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_test_foreign` FOREIGN KEY (`test`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `question_answers_question_foreign` FOREIGN KEY (`question`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedulings`
--
ALTER TABLE `schedulings`
  ADD CONSTRAINT `schedulings_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `schedulings_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedulings_task_foreign` FOREIGN KEY (`task`) REFERENCES `tasks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_lessons`
--
ALTER TABLE `student_lessons`
  ADD CONSTRAINT `student_lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_lessons_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_lessons_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_study_days`
--
ALTER TABLE `student_study_days`
  ADD CONSTRAINT `student_study_days_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_study_days_student_foreign` FOREIGN KEY (`student`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_lessons`
--
ALTER TABLE `teacher_lessons`
  ADD CONSTRAINT `teacher_lessons_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_lessons_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `teacher_lessons_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_levels`
--
ALTER TABLE `teacher_levels`
  ADD CONSTRAINT `teacher_levels_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_levels_level_foreign` FOREIGN KEY (`level`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `teacher_levels_teacher_foreign` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_payments`
--
ALTER TABLE `teacher_payments`
  ADD CONSTRAINT `teacher_payments_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_age_category_foreign` FOREIGN KEY (`age_category`) REFERENCES `age_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tests_assignee_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tests_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tests_lesson_foreign` FOREIGN KEY (`lesson`) REFERENCES `lessons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tests_level_foreign` FOREIGN KEY (`level`) REFERENCES `levels` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_age_category_foreign` FOREIGN KEY (`age_category`) REFERENCES `age_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_corparate_foreign` FOREIGN KEY (`corparate`) REFERENCES `corparate_clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_learning_type_foreign` FOREIGN KEY (`learning_type`) REFERENCES `learning_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_level_foreign` FOREIGN KEY (`level`) REFERENCES `levels` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_permission_foreign` FOREIGN KEY (`permission`) REFERENCES `permissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_salary_foreign` FOREIGN KEY (`salary`) REFERENCES `teacher_payments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_assignee_foreign` FOREIGN KEY (`assignee`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `videos_company_foreign` FOREIGN KEY (`company`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
