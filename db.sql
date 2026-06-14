-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for keetech
CREATE DATABASE IF NOT EXISTS `keetech` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `keetech`;

-- Dumping structure for table keetech.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.cache: ~0 rows (approximately)

-- Dumping structure for table keetech.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.cache_locks: ~0 rows (approximately)

-- Dumping structure for table keetech.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.contacts: ~0 rows (approximately)

-- Dumping structure for table keetech.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table keetech.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.jobs: ~0 rows (approximately)

-- Dumping structure for table keetech.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.job_batches: ~0 rows (approximately)

-- Dumping structure for table keetech.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_04_09_163939_create_portfolio_categories_table', 1),
	(5, '2026_04_09_163940_create_services_table', 1),
	(6, '2026_04_09_163941_create_contacts_table', 1),
	(7, '2026_04_09_163941_create_portfolios_table', 1),
	(8, '2026_04_09_163941_create_testimonials_table', 1),
	(9, '2026_04_09_163942_create_site_settings_table', 1),
	(10, '2026_04_09_190314_add_media_and_description_to_portfolio_categories_table', 2);

-- Dumping structure for table keetech.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table keetech.portfolios
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_category_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolios_portfolio_category_id_foreign` (`portfolio_category_id`),
  CONSTRAINT `portfolios_portfolio_category_id_foreign` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.portfolios: ~3 rows (approximately)
INSERT INTO `portfolios` (`id`, `title`, `portfolio_category_id`, `description`, `image`, `client_name`, `project_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Kee POS SaaS', 1, 'Sistem kasir berbasis cloud dengan integrasi stok inventaris real-time untuk jaringan ritel.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA_vGlGCWiMgF914N4TyTAXZNyezWksgrjsmtL3UhUOHBgPV5cHhuc_p40WYVWB4PXkNZlA7JxtmYzn4kAY1lkratGS65be1G6yW5ZkUltTh36wSTd3782DHcnyKC-dTEyKEjy47uuDL3b0SOSOuldqv1fUqbpTi9s5W09taCbP3gA7VeUi9Wy2iWJXLAZSv5WteAT8qgoKpw9fiMYXRJ_QX0FOcjEcJ2DvCEKSbigY8E1yFuXYWTJfT-iwvDmfcsebjdGe4WpqxVTR', 'Kee POS', 'https://pos.keetech.my.id', 1, 1, '2026-04-09 10:17:55', '2026-04-10 02:43:13'),
	(2, 'Enterprise CCTV System', 2, 'Instalasi keamanan terintegrasi dengan akses remote via mobile untuk gedung perkantoran.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBJd8NHp_u9BiqV24Zzu-wPetN2LWM0Zc6Z47DsExfi_sP0JKYOGFl9Ab6PlfC9c0u-xofW1zi4vZYmpdXH96Wa4W9KfDRAQ4dfUmAInsgyVP9d0C60bFDlGW-n8okIG6IPYckuip_N5Nm_l7n6K_wY8ky0_Ece3w7pPeE3AJMwIgLJAXdFTgqCZhpqgfTXaudG9dKsZQm8OLrDhVcbD8F_atbH6c5SemsizXHYbqOmEqGpvq-jTqCFOjnooIw-NXnH-wMEPj7OE5zF', 'PT. Gedung Maju', NULL, 2, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(3, 'Premium Company Profile', 3, 'Website profil perusahaan berstandar internasional dengan performa SEO terbaik.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCugpEwQKmtTpsr7SGwTVztQgWurf97olzWK-v-Oz6V-Kb_nnG9fbSHaLfSbs6dRapEzrGQAGWo3-tTHUy048t3vYhINIkovtNokJF3LQhs7WKJ3QA8Tz-A95jHQTegHVy445AjssSvQo-86wfVYaEENuUs_HfrjU5chvnwYWIlSSKA7CQOgA7ixIMKyEMAKvCf5SJ0dTIPmegtJTHbqGLNR99AmqZ0Fv1AMSwrKGKrmYiLMt5Ha6DzlJ53ERISd95NAqLOx7807HLJ', 'CV. Digital Nusantara', NULL, 3, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55');

-- Dumping structure for table keetech.portfolio_categories
CREATE TABLE IF NOT EXISTS `portfolio_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.portfolio_categories: ~3 rows (approximately)
INSERT INTO `portfolio_categories` (`id`, `name`, `slug`, `image`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Software Dev', 'software-dev', NULL, NULL, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(2, 'IT Infra', 'it-infra', NULL, NULL, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(3, 'Web Design', 'web-design', NULL, NULL, '2026-04-09 10:17:55', '2026-04-09 10:17:55');

-- Dumping structure for table keetech.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'settings',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.services: ~4 rows (approximately)
INSERT INTO `services` (`id`, `icon`, `title`, `description`, `features`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'desktop_windows', 'IT Service', 'Perbaikan dan maintenance perangkat keras untuk menjaga performa optimal bisnis Anda.', '["Hardware Repair", "Maintenance", "OS Installation"]', 1, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(2, 'lan', 'IT Infra', 'Instalasi dan pemeliharaan infrastruktur jaringan serta sistem keamanan terintegrasi.', '["CCTV System", "Networking", "Server Setup"]', 2, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(3, 'code', 'IT Programmer', 'Pengembangan software dan aplikasi custom sesuai kebutuhan bisnis Anda.', '["Web & App Dev", "SaaS Solution", "Custom Softwares"]', 3, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(4, 'inventory_2', 'Procurement', 'Pengadaan perangkat IT berkualitas dengan harga kompetitif dan garansi resmi.', '["Hardware Supply", "Device Lifecycle", "IT Sourcing"]', 4, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55');

-- Dumping structure for table keetech.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.sessions: ~0 rows (approximately)

-- Dumping structure for table keetech.site_settings
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.site_settings: ~38 rows (approximately)
INSERT INTO `site_settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
	(1, 'company_name', 'KeeTech', 'general', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(2, 'company_tagline', 'Solusi Digital Terpadu untuk Bisnis Anda', 'general', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(3, 'company_description', 'Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.', 'general', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(4, 'company_address', 'Jl. Pudaksari V Bumirejo RT01 RW06', 'contact', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(5, 'company_phone', NULL, 'contact', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(6, 'company_email', 'hello@keetech.co.id', 'contact', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(7, 'company_whatsapp', '085799410169', 'contact', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(8, 'social_instagram', 'https://instagram.com/keetech', 'social', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(9, 'social_facebook', 'https://facebook.com/keetech', 'social', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(10, 'social_linkedin', 'https://linkedin.com/company/keetech', 'social', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(11, 'stat_clients', '10+', 'stats', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(12, 'stat_projects', '20+', 'stats', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(13, 'stat_satisfaction', '99%', 'stats', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(14, 'stat_support', '24/7', 'stats', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(15, 'n8n_webhook_url', NULL, 'webhook', '2026-04-09 10:17:55', '2026-04-10 00:15:25'),
	(16, 'stat_experience', '5+', 'stats', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(17, 'why_title_1', 'Harga Transparan', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(18, 'why_desc_1', 'Tidak ada biaya tersembunyi. Semua estimasi diberikan secara jujur dan detail.', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(19, 'why_title_2', 'Dukungan 24/7', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(20, 'why_desc_2', 'Tim teknis kami selalu siap siaga membantu operasional bisnis Anda kapanpun.', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(21, 'why_title_3', 'Garansi Layanan', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(22, 'why_desc_3', 'Kami menjamin kualitas setiap pekerjaan dengan perlindungan garansi resmi.', 'features', '2026-04-09 10:23:16', '2026-04-10 00:15:25'),
	(23, 'hero_badge', '✦ IT SERVICE & SOFTWARE DEVELOPER PROFESIONAL ✦', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(24, 'hero_title', 'Solusi Digital <span>Terpadu</span> untuk Bisnis Anda', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(25, 'hero_description', 'Kami menyediakan layanan IT lengkap — mulai dari perbaikan hardware, infrastruktur jaringan, hingga pengembangan software dan pengadaan perangkat IT.', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(26, 'hero_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIl5hoAzy8INzWtmGt1XM4TFquA9MKQYaREd-_R7ui-3DK_1nRJPEsfOHiG8mZNGpR6DZusQb3tez5Dvt3NtDhXcSrlmEqiQ3_p17TmNiTqtL_1hO_tuGt75tvr2TWnzZtPQdjYTjzkhaZPwMEw1VqDeiVliRUkIZjXVpXStNJMSf4MQ_qRa3MwFs8AMFGsUAFK1Fo-dmdmd7pzihHJk-AUeVzSfKY2NHo9FmM1LjFauySW0hrii9Xv-Wk9NlgFbv_CQyuWc0IIwhi', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(27, 'hero_cta_primary_text', 'Konsultasi Gratis', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(28, 'hero_cta_primary_link', '#kontak', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(29, 'hero_cta_secondary_text', 'Lihat Layanan', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(30, 'hero_cta_secondary_link', '#layanan', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(31, 'hero_floating_title', 'Terpercaya', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(32, 'hero_floating_subtitle', 'ISO 27001 Certified', 'hero', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(33, 'about_heading', 'Mengapa Memilih KeeTech?', 'about', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(34, 'about_image', 'settings/SiND9JhjmQNRs5SHgTmzkQG49fqWuxtNFilBVci6.jpg', 'about', '2026-04-09 21:50:32', '2026-04-12 00:37:05'),
	(35, 'about_experience_years', '5+', 'about', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(36, 'social_whatsapp', 'https://wa.me/6281234567890', 'social', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(37, 'footer_description', 'Penyedia solusi IT komprehensif yang mengedepankan kualitas, transparansi, dan inovasi masa depan untuk bisnis Indonesia.', 'footer', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(38, 'footer_copyright', '© 2026 KeeTech Professional IT Services. All rights reserved.', 'footer', '2026-04-09 21:50:32', '2026-04-10 00:15:25'),
	(39, 'about_image_file', 'settings/72vhVQlSVf1FxlCTe4ToCcgehme756GC57tDEx8U.png', 'general', '2026-04-10 09:05:29', '2026-04-10 09:06:21');

-- Dumping structure for table keetech.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_photo` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '5',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.testimonials: ~3 rows (approximately)
INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `client_photo`, `content`, `rating`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Andi Pratama', 'CTO, Jaya Retail Group', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2m4w3to0e2AGf5zSa_3eopJHf_cdVU-1vWwSq1SSRmcNRYs2mIHFPOU3UDz-sskjKtNNFvtwX8zzGxsQuGmsX9tza6f4LS-yK32GMS2t9IKySbDd5Q8mTz1_cUcqYd7ePCBgkZ3D4z1unuXpuMQCrse04gS0Xs9QciEBXf27iidU8VdPtGLS9m1AV0-M2wfRvUrwnc7VH18kYUvg5DRwECzGgj7L-9RzM8sapbJnN7iLLfeWZpC8TqlRI5-zo8Umx8vhtPZT9ydBJ', 'KeeTech membantu kami melakukan migrasi server dengan sangat lancar. Tidak ada downtime berarti, dan tim mereka sangat responsif.', 5, 0, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(2, 'Sari Wijaya', 'Owner, Coffee House JKT', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6-9ibvl-35x5YAB_Vls4-38Q4zfeIxdzab7YhPVwPsav-pMvmTSl5woaYQlOPTc8UBeIDlPamUYDvsteWAVrL7mULaxbUga3vxKGaY4qo-2k0q1hzDUQ2-2iOncLfBW-Llm-kWMuINoLpDbLOw7omeqkj8eyDgEUMKMsk0yApbxbK6hwWcTBoNb6Hy8aBcuty_h1it_fxTyZfX5rS3eSfMFUFFyA8rR3ZPremjZ9v5pWMnYw6Hp_55LxQlapQ42lS3gd75sbpI-lc', 'Sistem POS yang dibuat KeeTech sangat user-friendly. Karyawan kami bisa langsung menggunakannya tanpa perlu training lama.', 5, 1, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55'),
	(3, 'Budi Santoso', 'Ops Manager, Logistik Maju', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtLe-qEl2P5RwdYo1MHKsYJ58tr4sECPS5UCHuwOGKWBTB1Wy_TR03NDGd0ceWX0vxHs-LfIb0B3DEpbyW98_kqFBocU17Ohe6t-IZp_n_u51cxnOUINUj2vo6WZhkOCwf6m9QPkyhGJexL9rI_4UKfhsxfSF-1sWglqWC37-FGONYGlqCDjbASEW0vYNVzQXTe9Gpu8hoN-AUdowlLN5mNT35qUBdch_OO3EuHYVzSgndLbV-65jnfY56dR4xOFYpXBKMD7h7eQOS', 'Layanan maintenance hardware berkala dari KeeTech membuat operasional kantor kami jauh lebih stabil dan produktif.', 5, 0, 1, '2026-04-09 10:17:55', '2026-04-09 10:17:55');

-- Dumping structure for table keetech.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table keetech.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin KeeTech', 'admin@keetech.co.id', NULL, '$2y$12$V3IsoAtNqmQOstv3nX/pDehM2JcmVbY5bCh9PXuD10EjNScQ.fDE.', NULL, '2026-04-09 10:17:55', '2026-04-09 10:17:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
