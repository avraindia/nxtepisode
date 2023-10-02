-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2023 at 09:26 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `next_episode_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `category_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'TOPWEAR', '0', NULL, NULL, '2023-09-07 14:00:43', '2023-09-07 14:00:43'),
(2, 'BOTTOMWEAR', '0', NULL, NULL, '2023-09-07 14:01:57', '2023-09-07 14:01:57'),
(3, 'SHOES & ACCESORIES', '0', NULL, NULL, '2023-09-07 14:02:19', '2023-09-07 14:02:19'),
(4, 'SNEAKERS', '0', NULL, NULL, '2023-09-07 14:02:39', '2023-09-07 14:02:39'),
(5, 'ACCESORIES', '0', NULL, NULL, '2023-09-07 14:03:00', '2023-09-07 14:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_address`
--

DROP TABLE IF EXISTS `checkout_address`;
CREATE TABLE IF NOT EXISTS `checkout_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `first_name` varchar(199) DEFAULT NULL,
  `last_name` varchar(199) DEFAULT NULL,
  `house_no` varchar(199) DEFAULT NULL,
  `street_name` varchar(199) DEFAULT NULL,
  `landmark` varchar(199) DEFAULT NULL,
  `postal_code` varchar(199) DEFAULT NULL,
  `city_district` varchar(199) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `state` bigint(20) UNSIGNED DEFAULT NULL,
  `default_address` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `state` (`state`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout_address`
--

INSERT INTO `checkout_address` (`id`, `user_id`, `first_name`, `last_name`, `house_no`, `street_name`, `landmark`, `postal_code`, `city_district`, `phone_no`, `country`, `state`, `default_address`, `created_at`, `updated_at`) VALUES
(1, 8, 'Samiran', 'Chakraborty', '15/1', 'K.B. Pramanick Street', 'Tara Maa Mandir, Buroshib Tala', '741404', 'Santipur, Nadia', '8617451215', 'India', 24, 0, '2023-10-02 13:17:14', '2023-10-02 15:04:22'),
(3, 8, 'Rakesh', 'Nandy', '20/3', 'Keota Kalibari', 'Keota Kalibari', '748596', 'Bandel, Hooghly', '7485963314', 'India', 24, 1, '2023-10-02 15:04:22', '2023-10-02 15:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_08_12_053221_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_description`, `created_at`, `updated_at`) VALUES
(2, 'Size', NULL, '2023-09-09 07:25:09', '2023-09-09 07:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `option_values`
--

DROP TABLE IF EXISTS `option_values`;
CREATE TABLE IF NOT EXISTS `option_values` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `option_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option_values`
--

INSERT INTO `option_values` (`id`, `option_id`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 2, 'XXS', '2023-09-09 07:55:03', '2023-09-09 07:55:03'),
(2, 2, 'XS', '2023-09-09 07:56:22', '2023-09-09 07:56:22'),
(3, 2, 'S', '2023-09-09 07:56:41', '2023-09-09 07:56:41'),
(4, 2, 'M', '2023-09-09 07:56:53', '2023-09-09 07:56:53'),
(5, 2, 'L', '2023-09-09 07:57:15', '2023-09-09 07:57:15'),
(6, 2, 'XL', '2023-09-09 07:57:23', '2023-09-09 07:57:23'),
(7, 2, 'XXL', '2023-09-09 07:57:29', '2023-09-09 08:03:49'),
(9, 2, 'XXXL', '2023-09-09 08:05:47', '2023-09-09 08:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `user_id`, `permission`, `created_at`, `updated_at`) VALUES
(1, 2, 'show_dashboard_menu', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(2, 2, 'show_user_menu', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(3, 2, 'show_product_menu', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(4, 2, 'add_product', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(5, 2, 'view_product', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(6, 2, 'edit_product', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(7, 2, 'delete_product', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(8, 3, 'show_dashboard_menu', '2023-08-24 13:27:59', '2023-08-24 13:27:59'),
(9, 3, 'show_user_menu', '2023-08-24 13:27:59', '2023-08-24 13:27:59'),
(10, 3, 'show_product_menu', '2023-08-24 13:27:59', '2023-08-24 13:27:59'),
(11, 3, 'add_product', '2023-08-24 13:27:59', '2023-08-24 13:27:59'),
(12, 3, 'view_product', '2023-08-24 13:27:59', '2023-08-24 13:27:59'),
(14, 4, 'show_dashboard_menu', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(15, 4, 'show_user_menu', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(16, 4, 'show_product_menu', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(17, 4, 'add_product', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(18, 4, 'view_product', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(19, 4, 'edit_product', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(20, 4, 'delete_product', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(22, 3, 'edit_product', '2023-08-24 15:31:52', '2023-08-24 15:31:52'),
(23, 6, 'show_dashboard_menu', '2023-09-06 14:08:50', '2023-09-06 14:08:50'),
(24, 6, 'show_user_menu', '2023-09-06 14:08:50', '2023-09-06 14:08:50'),
(25, 6, 'show_product_menu', '2023-09-06 14:08:50', '2023-09-06 14:08:50'),
(26, 6, 'add_product', '2023-09-06 14:08:50', '2023-09-06 14:08:50'),
(27, 6, 'view_product', '2023-09-06 14:08:50', '2023-09-06 14:08:50'),
(28, 6, 'edit_product', '2023-09-06 14:08:50', '2023-09-06 14:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_cat_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `product_mrp` decimal(10,2) NOT NULL,
  `theme_ids` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_main_cat_id_foreign` (`main_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `main_cat_id`, `product_mrp`, `theme_ids`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Coral', 1, '1299.00', '3,4,5,6,7,8', 1, 0, '2023-09-08 02:37:10', '2023-09-12 13:29:07'),
(2, 'Black Panther', 1, '899.00', '1,2,4,5', 1, 0, '2023-09-10 13:59:11', '2023-09-12 13:29:42'),
(3, 'Wakanda Forever', 1, '1999.00', '6,7,8', 1, 0, '2023-09-10 14:00:22', '2023-09-12 13:29:55'),
(4, 'Tribal Pattern', 1, '1299.00', '1,4,5,6', 1, 0, '2023-09-08 02:37:10', '2023-09-12 13:30:08'),
(5, 'Denim Blue', 1, '899.00', '1,3,6,7', 1, 0, '2023-09-10 13:59:11', '2023-09-12 13:30:22'),
(6, 'The Last Uchiha', 1, '1999.00', '3,4,5,8', 1, 0, '2023-09-10 14:00:22', '2023-09-12 13:30:36'),
(7, 'Ironman Shield', 1, '299.00', '1,2,3,4', 1, 0, '2023-09-19 15:28:21', '2023-09-19 15:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_gallery`
--

DROP TABLE IF EXISTS `product_gallery`;
CREATE TABLE IF NOT EXISTS `product_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variation_id` (`product_variation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_variation_id`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 1, '5c8e5878bc244175b7ef32171023b5d0_1695494104.webp', '2023-09-23 13:05:04', '2023-09-23 13:05:04'),
(2, 1, '71NbeYK99UL._AC_UY350__1695494104.jpg', '2023-09-23 13:05:04', '2023-09-23 13:05:04'),
(3, 1, '10120_1695494104.jpg', '2023-09-23 13:05:04', '2023-09-23 13:05:04'),
(4, 1, '970233_Clay-Orange_Model_Front_1_1695494104.webp', '2023-09-23 13:05:05', '2023-09-23 13:05:05'),
(5, 2, 'black_sulphur_1695579792.jpg', '2023-09-24 12:53:13', '2023-09-24 12:53:13'),
(6, 2, 'check-shirt_1695579793.jpg', '2023-09-24 12:53:13', '2023-09-24 12:53:13'),
(7, 2, 'hmgoepprod_1695579793.jpg', '2023-09-24 12:53:13', '2023-09-24 12:53:13'),
(8, 3, 'hmgoepprod_1695579878.jpg', '2023-09-24 12:54:39', '2023-09-24 12:54:39'),
(9, 3, 'images_1695579879.jpg', '2023-09-24 12:54:39', '2023-09-24 12:54:39'),
(10, 3, 'lmsh004058_1_1695579879.jpg', '2023-09-24 12:54:39', '2023-09-24 12:54:39'),
(11, 3, 'red_plain_1695579879.jpg', '2023-09-24 12:54:39', '2023-09-24 12:54:39'),
(12, 3, 'Snitch_14thJune21_1280_1695579879.webp', '2023-09-24 12:54:40', '2023-09-24 12:54:40'),
(13, 3, 'ssrco,slim_fit_t_shirt,mens,101010_01c5ca27c6,front,tall_portrait,750x1000_1695579880.jpg', '2023-09-24 12:54:40', '2023-09-24 12:54:40'),
(14, 4, '71NbeYK99UL._AC_UY350__1695579949.jpg', '2023-09-24 12:55:49', '2023-09-24 12:55:49'),
(15, 4, '10120_1695579949.jpg', '2023-09-24 12:55:49', '2023-09-24 12:55:49'),
(16, 4, '970233_Clay-Orange_Model_Front_1_1695579949.webp', '2023-09-24 12:55:50', '2023-09-24 12:55:50'),
(17, 5, '5c8e5878bc244175b7ef32171023b5d0_1695583069.webp', '2023-09-24 13:47:49', '2023-09-24 13:47:49'),
(18, 5, '71NbeYK99UL._AC_UY350__1695583069.jpg', '2023-09-24 13:47:50', '2023-09-24 13:47:50'),
(19, 5, '10120_1695583070.jpg', '2023-09-24 13:47:50', '2023-09-24 13:47:50'),
(20, 5, '970233_Clay-Orange_Model_Front_1_1695583070.webp', '2023-09-24 13:47:50', '2023-09-24 13:47:50'),
(21, 6, 'black_sulphur_1695583249.jpg', '2023-09-24 13:50:49', '2023-09-24 13:50:49'),
(22, 6, 'check-shirt_1695583249.jpg', '2023-09-24 13:50:49', '2023-09-24 13:50:49'),
(23, 6, 'hmgoepprod_1695583249.jpg', '2023-09-24 13:50:50', '2023-09-24 13:50:50'),
(24, 6, 'images_1695583250.jpg', '2023-09-24 13:50:50', '2023-09-24 13:50:50'),
(25, 7, '71NbeYK99UL._AC_UY350__1695583346.jpg', '2023-09-24 13:52:26', '2023-09-24 13:52:26'),
(26, 7, '10120_1695583346.jpg', '2023-09-24 13:52:26', '2023-09-24 13:52:26'),
(27, 7, 'check-shirt_1695583346.jpg', '2023-09-24 13:52:27', '2023-09-24 13:52:27'),
(28, 7, 'hmgoepprod_1695583347.jpg', '2023-09-24 13:52:27', '2023-09-24 13:52:27'),
(29, 7, 'red_plain_1695583347.jpg', '2023-09-24 13:52:27', '2023-09-24 13:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

DROP TABLE IF EXISTS `product_inventory`;
CREATE TABLE IF NOT EXISTS `product_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `option_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `option_value_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `inventory_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `current_stock` bigint(20) NOT NULL DEFAULT '0',
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `option_id` (`option_id`),
  KEY `option_value_id` (`option_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `option_id`, `option_value_id`, `inventory_price`, `current_stock`, `sku`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '1300.00', 48, '', '2023-09-25 06:49:08', '2023-09-25 06:52:08'),
(2, 1, 2, 2, '1305.00', 30, '', '2023-09-25 06:53:07', '2023-09-25 06:53:17'),
(3, 1, 2, 3, '0.00', 30, '', '2023-09-25 06:53:44', '2023-09-25 06:53:44'),
(4, 1, 2, 4, '0.00', 50, '', '2023-09-25 06:53:56', '2023-09-25 06:53:56'),
(5, 1, 2, 7, '0.00', 25, '', '2023-09-25 06:54:10', '2023-09-25 06:54:10'),
(6, 2, 2, 1, '890.00', 30, '', '2023-09-25 06:55:33', '2023-09-25 06:55:33'),
(7, 2, 2, 2, '0.00', 2, '', '2023-09-25 06:55:38', '2023-09-25 06:55:38'),
(8, 2, 2, 5, '0.00', 3, '', '2023-09-25 06:55:41', '2023-09-25 06:55:41'),
(9, 2, 2, 7, '0.00', 60, '', '2023-09-25 06:55:50', '2023-09-25 06:55:50'),
(10, 3, 2, 1, '0.00', 50, '', '2023-09-25 06:56:11', '2023-09-25 06:56:11'),
(11, 3, 2, 2, '0.00', 40, '', '2023-09-25 06:56:21', '2023-09-25 06:56:21'),
(12, 3, 2, 4, '0.00', 30, '', '2023-09-25 06:56:33', '2023-09-25 06:56:33'),
(13, 3, 2, 7, '0.00', 45, '', '2023-09-25 06:56:41', '2023-09-25 06:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

DROP TABLE IF EXISTS `product_variation`;
CREATE TABLE IF NOT EXISTS `product_variation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `fitting_title` varchar(191) DEFAULT NULL,
  `fitting_type` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `gender` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `details` text,
  `description` text,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fitting_type` (`fitting_type`),
  KEY `gender` (`gender`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`id`, `product_id`, `fitting_title`, `fitting_type`, `gender`, `details`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Coral Regular fitting for male wear', 1, 1, '<div><b>Material &amp; Care:</b><br></div><p></p><div><div>98% Cotton 2% Spandex</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b>&nbsp;India (and proud)</div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><div><u>connect@thesouledstore.com</u></div></div>', '<p><b>Shop for Solids: Black Cloud Wash (Straight Fit) Men Cargo Jeans Online.<br></b></p><div><div><div><span><b>MRP: Rs. 3999/- incl. of all taxes</b></span></div></div></div>', 1, '2023-09-23 13:05:04', '2023-09-23 14:45:09'),
(2, 1, 'Coral Regular fit for Female', 1, 2, '<div><b>Material &amp; Care:</b></div><div>100% Cotton</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b><span>&nbsp;</span>India (and proud)<br><br>Hey Souledsters! You must have noticed that we\'ve said goodbye to the little Mr. Souls sleeve label that we\'ve had through the years. But always remember, when you shop from our app, website, stores, or online marketplaces, you\'re always getting the genuine real deal!<br></div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><p></p><div><u>connect@thesouledstore.com</u></div>', '<p>Shop for TSS Originals: My Anxiety Got Me Racing T-Shirts at The Souled Store.<br><br>MRP: Rs. 999/- incl. of all taxes.<br></p>', 1, '2023-09-24 12:53:12', '2023-09-24 12:53:12'),
(3, 1, 'Coral oversized fitting for Male', 2, 1, '<div><b>Material &amp; Care:</b></div><div>100% Cotton</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b><span>&nbsp;</span>India (and proud)<br><br>Hey Souledsters! You must have noticed that we\'ve said goodbye to the little Mr. Souls sleeve label that we\'ve had through the years. But always remember, when you shop from our app, website, stores, or online marketplaces, you\'re always getting the genuine real deal!<br></div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><p></p><div><u>connect@thesouledstore.com</u></div>', '<p>Shop for TSS Originals: My Anxiety Got Me Racing T-Shirts at The Souled Store.<br><br>MRP: Rs. 999/- incl. of all taxes.<br></p>', 1, '2023-09-24 12:54:38', '2023-09-24 12:54:38'),
(4, 1, 'Coral oversized fitting for Female', 2, 2, '<div><b>Material &amp; Care:</b></div><div>100% Cotton</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b><span>&nbsp;</span>India (and proud)<br><br>Hey Souledsters! You must have noticed that we\'ve said goodbye to the little Mr. Souls sleeve label that we\'ve had through the years. But always remember, when you shop from our app, website, stores, or online marketplaces, you\'re always getting the genuine real deal!<br></div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><p></p><div><u>connect@thesouledstore.com</u></div>', '<p>Shop for TSS Originals: My Anxiety Got Me Racing T-Shirts at The Souled Store.<br><br>MRP: Rs. 999/- incl. of all taxes.<br></p>', 1, '2023-09-24 12:55:49', '2023-09-24 12:55:49'),
(5, 2, 'BLACK PANTHER Regular fit for male', 1, 1, '<div><b>Material &amp; Care:</b><br></div><p></p><div><div>98% Cotton 2% Spandex</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b>&nbsp;India (and proud)</div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><div><u>connect@thesouledstore.com</u></div></div>', '<p>Shop for Solids: Mid Blue Men Cargo Jeans at The Souled Store.<br><br>MRP: Rs. 3999/- incl. of all taxes.<br></p>', 1, '2023-09-24 13:47:49', '2023-09-24 13:47:49'),
(6, 2, 'BLACK PANTHER Regular fit for female', 1, 2, '<div><b>Material &amp; Care:</b><br></div><p></p><div><div>98% Cotton 2% Spandex</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b>&nbsp;India (and proud)</div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><div><u>connect@thesouledstore.com</u></div></div>', '<p>Shop for Solids: Mid Blue Men Cargo Jeans at The Souled Store.<br><br>MRP: Rs. 3999/- incl. of all taxes.<br></p>', 1, '2023-09-24 13:50:49', '2023-09-24 13:50:49'),
(7, 2, 'BLACK PANTHER Oversized fit for male', 2, 1, '<div><b>Material &amp; Care:</b><br></div><p></p><div><div>98% Cotton 2% Spandex</div><div>Machine Wash</div><div></div><div><br><b>Country of Origin:</b>&nbsp;India (and proud)</div><div><br><b>Manufactured &amp; Sold By:</b></div><div>The Souled Store Pvt. Ltd.</div><div>224, Tantia Jogani Industrial Premises</div><div>J.R. Boricha Marg</div><div>Lower Parel (E)</div><div>Mumbai - 11</div><div><u>connect@thesouledstore.com</u></div></div>', '<p>Shop for Solids: Mid Blue Men Cargo Jeans at The Souled Store.<br><br>MRP: Rs. 3999/- incl. of all taxes.<br></p>', 1, '2023-09-24 13:52:26', '2023-09-24 13:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

DROP TABLE IF EXISTS `promo_code`;
CREATE TABLE IF NOT EXISTS `promo_code` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `code`, `valid_from`, `valid_to`, `discount_in`, `discount`, `discount_description`, `created_at`, `updated_at`) VALUES
(1, 'Promo_Flat_20', '2023-09-25', '2023-10-25', 'percentage', '20', NULL, '2023-10-02 08:28:15', '2023-10-02 08:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2023-08-11 18:30:00', '2023-08-11 18:30:00'),
(2, 'custom_user', 'Custom User', '2023-08-22 18:30:00', '2023-08-22 18:30:00'),
(3, 'frontend_user', 'Frontend User', '2023-08-22 18:30:00', '2023-08-22 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta_title`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 'shipping_fee', '20.00', '2023-10-02 08:01:49', '2023-10-02 08:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `size_gallery`
--

DROP TABLE IF EXISTS `size_gallery`;
CREATE TABLE IF NOT EXISTS `size_gallery` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `size_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variation_id` (`product_variation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_gallery`
--

INSERT INTO `size_gallery` (`id`, `product_variation_id`, `size_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1_1695494105.jpg', '2023-09-23 13:05:05', '2023-09-23 13:05:05'),
(2, 1, '2_1695494105.jpeg', '2023-09-23 13:05:05', '2023-09-23 13:05:05'),
(3, 1, '3_1695494105.png', '2023-09-23 13:05:05', '2023-09-23 13:05:05'),
(4, 2, '5_1695579793.png', '2023-09-24 12:53:14', '2023-09-24 12:53:14'),
(5, 2, '6_1695579794.png', '2023-09-24 12:53:14', '2023-09-24 12:53:14'),
(6, 3, '2_1695579880.jpeg', '2023-09-24 12:54:40', '2023-09-24 12:54:40'),
(7, 3, '3_1695579880.png', '2023-09-24 12:54:40', '2023-09-24 12:54:40'),
(8, 3, '4_1695579880.png', '2023-09-24 12:54:40', '2023-09-24 12:54:40'),
(9, 4, '1_1695579950.jpg', '2023-09-24 12:55:50', '2023-09-24 12:55:50'),
(10, 4, '2_1695579950.jpeg', '2023-09-24 12:55:50', '2023-09-24 12:55:50'),
(11, 4, '3_1695579950.png', '2023-09-24 12:55:50', '2023-09-24 12:55:50'),
(12, 5, '2_1695583070.jpeg', '2023-09-24 13:47:51', '2023-09-24 13:47:51'),
(13, 5, '3_1695583071.png', '2023-09-24 13:47:51', '2023-09-24 13:47:51'),
(14, 5, '4_1695583071.png', '2023-09-24 13:47:51', '2023-09-24 13:47:51'),
(15, 6, '5_1695583250.png', '2023-09-24 13:50:50', '2023-09-24 13:50:50'),
(16, 6, '6_1695583250.png', '2023-09-24 13:50:50', '2023-09-24 13:50:50'),
(17, 6, '7_1695583250.jpg', '2023-09-24 13:50:50', '2023-09-24 13:50:50'),
(18, 7, '2_1695583347.jpeg', '2023-09-24 13:52:27', '2023-09-24 13:52:27'),
(19, 7, '3_1695583347.png', '2023-09-24 13:52:27', '2023-09-24 13:52:27'),
(20, 7, '6_1695583347.png', '2023-09-24 13:52:28', '2023-09-24 13:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'ANDHRA PRADESH'),
(2, 'ASSAM'),
(3, 'ARUNACHAL PRADESH'),
(4, 'BIHAR'),
(5, 'GUJRAT'),
(6, 'HARYANA'),
(7, 'HIMACHAL PRADESH'),
(8, 'JAMMU & KASHMIR'),
(9, 'KARNATAKA'),
(10, 'KERALA'),
(11, 'MADHYA PRADESH'),
(12, 'MAHARASHTRA'),
(13, 'MANIPUR'),
(14, 'MEGHALAYA'),
(15, 'MIZORAM'),
(16, 'NAGALAND'),
(17, 'ORISSA'),
(18, 'PUNJAB'),
(19, 'RAJASTHAN'),
(20, 'SIKKIM'),
(21, 'TAMIL NADU'),
(22, 'TRIPURA'),
(23, 'UTTAR PRADESH'),
(24, 'WEST BENGAL'),
(25, 'DELHI'),
(26, 'GOA'),
(27, 'PONDICHERY'),
(28, 'LAKSHDWEEP'),
(29, 'DAMAN & DIU'),
(30, 'DADRA & NAGAR'),
(31, 'CHANDIGARH'),
(32, 'ANDAMAN & NICOBAR'),
(33, 'UTTARANCHAL'),
(34, 'JHARKHAND'),
(35, 'CHATTISGARH');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `theme_name`, `theme_description`, `created_at`, `updated_at`) VALUES
(1, 'Jetsons', NULL, '2023-09-12 07:20:45', '2023-09-12 07:20:45'),
(2, 'Donald Duck', NULL, '2023-09-12 07:21:15', '2023-09-12 07:21:15'),
(3, 'The Office', NULL, '2023-09-12 07:21:34', '2023-09-12 07:21:34'),
(4, 'Transformers', NULL, '2023-09-12 07:21:48', '2023-09-12 07:21:48'),
(5, 'Micky Mouse', NULL, '2023-09-12 07:22:05', '2023-09-12 07:22:05'),
(6, 'Star Wars', NULL, '2023-09-12 07:22:27', '2023-09-12 07:22:27'),
(7, 'Deadpool', NULL, '2023-09-12 07:22:40', '2023-09-12 07:22:40'),
(8, 'Archie Comics', NULL, '2023-09-12 07:23:01', '2023-09-12 09:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type_name`, `type_description`, `created_at`, `updated_at`) VALUES
(1, 'Regular', NULL, '2023-09-10 12:28:22', '2023-09-10 12:28:22'),
(2, 'Oversized', NULL, '2023-09-10 12:28:22', '2023-09-10 12:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `google_id`, `remember_token`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Administrator', 'admin@admin.admin', '2023-08-11 18:30:00', '$2a$12$yYVKfm1D8HZNVNKfRSFzsez9vvc2iMtERZIrJ.D2o.FRmBCeOPaLS', NULL, NULL, 1, '2023-08-11 18:30:00', '2023-08-11 18:30:00', NULL),
(2, 2, 'John Wick', 'john@gmail.com', NULL, '$2y$10$53RYBKmWVe9ATxfpQ1TZjObOdG6YawxyPnqdrHlj16rDyBIFh5FBa', NULL, NULL, 1, '2023-08-23 14:41:07', '2023-08-23 14:41:07', NULL),
(3, 2, 'Nilabhra Chakraborty', 'nilu@gmail.com', NULL, '$2y$10$wAQbqvla1afMjF/M4kXE.uue5KJ7skKvOIfevGGBiAbHeb.5IWdZy', NULL, NULL, 1, '2023-08-24 13:27:59', '2023-08-24 15:40:17', NULL),
(4, 2, 'Rakesh Nandy', 'rakesh@gmail.com', NULL, '$2y$10$2ECBbis40gaDH3wtkqCNDumhD84e9icQCNEiXKrVICyHu42HkvixS', NULL, NULL, 1, '2023-08-24 13:30:05', '2023-08-24 13:30:05', NULL),
(5, 3, 'Subham Gill', 'subham@gmail.com', NULL, '$2y$10$jfH.aCHgWxSmUkSAw.6qoux1YNft3jEz4/AMKuMzZ3Fx00qcW.GdW', NULL, NULL, 1, '2023-08-25 14:30:10', '2023-08-25 14:30:10', NULL),
(6, 2, 'Anup', 'anup@gmail.com', NULL, '$2y$10$LBlirx5C32WSk/pwAtIwzuUUhRvKnsj2/NlcSovCMV3KP6OI.AEc6', NULL, NULL, 1, '2023-09-06 14:08:50', '2023-09-06 14:36:05', NULL),
(8, 3, 'Anupom Roy', 'anupom@gmail.com', NULL, '$2y$10$21A1zLHMDXKV1NloS.1eh.dTUjGwAyeMoGF2EQq4IkJyD5llt1HDi', NULL, NULL, 1, '2023-09-30 13:21:39', '2023-09-30 13:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `full_name`, `email`, `phone_number`, `gender`, `created_at`, `updated_at`) VALUES
(1, 2, 'John Wick', 'john@gmail.com', NULL, 'm', '2023-08-23 14:41:07', '2023-08-23 14:41:07'),
(2, 3, 'Nilabhra Chakraborty', 'nilu@gmail.com', '222222', 'm', '2023-08-24 13:27:59', '2023-08-24 15:40:17'),
(3, 4, 'Rakesh Nandy', 'rakesh@gmail.com', NULL, 'm', '2023-08-24 13:30:05', '2023-08-24 13:30:05'),
(4, 5, 'Subham Gill', 'subham@gmail.com', '7987897987987987979', 'm', '2023-08-25 14:30:10', '2023-08-25 14:30:10'),
(5, 6, 'Anup', 'anup@gmail.com', NULL, 'm', '2023-09-06 14:08:50', '2023-09-06 14:36:05'),
(7, 8, 'Anupom Roy', 'anupom@gmail.com', '63634533', 'm', '2023-09-30 13:21:39', '2023-09-30 13:21:39');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option_values`
--
ALTER TABLE `option_values`
  ADD CONSTRAINT `option_values_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`main_cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD CONSTRAINT `product_inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_inventory_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `product_inventory_ibfk_3` FOREIGN KEY (`option_value_id`) REFERENCES `option_values` (`id`);

--
-- Constraints for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD CONSTRAINT `product_variation_ibfk_1` FOREIGN KEY (`fitting_type`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `product_variation_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
