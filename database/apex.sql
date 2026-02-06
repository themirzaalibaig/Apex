-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 03:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apex`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]' CHECK (json_valid(`skills`)),
  `cta` varchar(255) NOT NULL,
  `cta_url` varchar(255) NOT NULL,
  `statistics` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '[]' CHECK (json_valid(`statistics`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `video`, `title`, `subtitle`, `description`, `skills`, `cta`, `cta_url`, `statistics`, `created_at`, `updated_at`) VALUES
(4, 'abouts/videos/r2Fh1VfphlL0lnugAAG2x54gEhL0p8G7hdKDRPLK.mp4', 'Crafting Website with Purpose and Passions', 'Driven to the Creativity', 'Our team of designers, developers, and strategists are passionate about bringing your brand’s vision to life through innovative user.', '[{\"name\":\"User Interface Designer\",\"percentage\":\"98\"},{\"name\":\"WordPress Developer\",\"percentage\":\"97\"}]', 'SHADULE A CONSULATION', 'https://localhost:8000/contact', '[{\"number\":\"90\",\"label\":\"Satisfaction Rate  80%\"}]', '2025-10-06 13:49:36', '2025-10-06 13:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What services does Apex SoftBuilt offer?', 'We’ve worked with clients across various industries, including retail, healthcare, technology, education, hospitality, and more. Our team is designed to meet the unique needs of your business.', 'active', '2025-10-01 14:29:42', '2025-10-01 14:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `title1` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `cta` varchar(255) NOT NULL,
  `cta_url` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `subtitle`, `title1`, `title2`, `cta`, `cta_url`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Designing the Future of Your Brand', 'Digital Designs', 'That Deliver', 'Get Started', '/contact', 'active', '2025-10-06 07:58:10', '2025-10-06 07:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `name`, `alt`, `title`, `caption`, `keywords`, `imageable_type`, `imageable_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'services/Pixel-Crafters-Agency.png', 'Pixel-Crafters-Agency', 'Pixel Crafters agency', '', '', '', 'service', 5, 'active', '2025-10-01 13:09:58', '2025-10-01 13:09:58'),
(9, 'services/Mirza Ali Baig FB Cover.png', 'Mirza Ali Baig FB Cover', '', '', '', '', 'service', 1, 'active', '2025-10-01 13:12:31', '2025-10-01 13:12:31'),
(10, 'services/App Development.png', 'App Development', '', '', '', '', 'service', 6, 'active', '2025-10-01 13:24:17', '2025-10-01 13:24:17'),
(11, 'projects/LuxuryStay.png', 'LuxuryStay', '', '', '', '', 'project', 1, 'active', '2025-10-01 13:38:32', '2025-10-01 13:38:32'),
(12, 'projects/LuxuryStay.png', 'LuxuryStay', '', '', '', '', 'project', 2, 'active', '2025-10-01 13:43:03', '2025-10-01 13:43:03'),
(13, 'teams/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', '', '', '', '', 'team', 4, 'active', '2025-10-01 13:59:32', '2025-10-01 13:59:32'),
(14, 'teams/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', '', '', '', '', 'team', 5, 'active', '2025-10-01 13:59:33', '2025-10-01 13:59:33'),
(18, 'teams/oree-mode.png', 'oree-mode', '', '', '', '', 'team', 7, 'active', '2025-10-01 14:13:18', '2025-10-01 14:13:18'),
(19, 'teams/Ali Baig.png', 'Ali Baig', '', '', '', '', 'team', 6, 'active', '2025-10-01 14:20:21', '2025-10-01 14:20:21'),
(20, 'reviews/Ali Baig.png', 'Ali Baig', '', '', '', '', 'review', 1, 'active', '2025-10-01 14:49:06', '2025-10-01 14:49:06'),
(21, 'submenus/Web Development_1759409788.png', 'Web Development', 'Web Development', 'Web Development', NULL, NULL, 'sub_menu', 1, 'active', '2025-10-02 07:56:28', '2025-10-02 07:56:28'),
(22, 'submenus/App Development_1759413347.png', 'App Development', 'App Development', 'App Development', NULL, NULL, 'sub_menu', 2, 'active', '2025-10-02 08:55:47', '2025-10-02 08:55:47'),
(23, 'submenus/Digital Maketing_1759413466.png', 'Digital Maketing', 'Digital Maketing', 'Digital Maketing', NULL, NULL, 'sub_menu', 3, 'active', '2025-10-02 08:57:46', '2025-10-02 08:57:46'),
(24, 'submenus/UI/UX Development_1759413466.png', 'UI/UX Development', 'UI/UX Development', 'UI/UX Development', NULL, NULL, 'sub_menu', 4, 'active', '2025-10-02 08:57:46', '2025-10-02 08:57:46'),
(25, 'submenus/Social Media Marketing_1759413965.png', 'Social Media Marketing', 'Social Media Marketing', 'Social Media Marketing', NULL, NULL, 'sub_menu', 5, 'active', '2025-10-02 09:06:05', '2025-10-02 09:06:05'),
(28, 'services/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', 'others-area', '', '', '', 'service', 1, 'active', '2025-10-02 09:38:13', '2025-10-02 09:38:13'),
(30, 'services/people.png', 'people', 'others-area', '', '', '', 'service', 5, 'active', '2025-10-02 09:43:28', '2025-10-02 09:43:28'),
(31, 'reviews/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', '', '', '', '', 'review', 2, 'active', '2025-10-02 10:56:50', '2025-10-02 10:56:50'),
(33, 'reviews/oree-mode.png', 'oree-mode', 'company-logo', '', '', '', 'review', 2, 'active', '2025-10-06 07:19:00', '2025-10-06 07:19:00'),
(34, 'reviews/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', '', '', '', '', 'review', 3, 'active', '2025-10-06 07:24:45', '2025-10-06 07:24:45'),
(35, 'reviews/oree-mode.png', 'oree-mode', 'company-logo', '', '', '', 'review', 3, 'active', '2025-10-06 07:24:45', '2025-10-06 07:24:45'),
(36, 'services/people.png', 'people', 'others-area', '', '', '', 'service', 6, 'active', '2025-10-06 07:47:06', '2025-10-06 07:47:46'),
(37, 'hero_sections/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', 'main', '', '', '', 'hero_section', 3, 'active', '2025-10-06 07:57:09', '2025-10-06 07:57:09'),
(38, 'hero_sections/Gemini_Generated_Image_gaege4gaege4gaeg.png', 'Gemini_Generated_Image_gaege4gaege4gaeg', 'main', '', '', '', 'hero_section', 4, 'active', '2025-10-06 07:57:09', '2025-10-06 07:57:09'),
(45, 'abouts/LuxuryStay.png', 'LuxuryStay', '', '', '', '', 'about', 4, 'active', '2025-10-06 14:54:06', '2025-10-06 14:54:06'),
(49, 'hero_sections/e4e2ec80-e936-4fb5-9264-9bb86c77fbb7.jfif', 'e4e2ec80-e936-4fb5-9264-9bb86c77fbb7', 'hero', '', '', '', 'hero_section', 5, 'active', '2026-02-04 09:47:01', '2026-02-04 09:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', 'active', '2025-10-02 07:36:31', '2025-10-02 07:46:26'),
(2, 'About', 'about', 'active', '2025-10-02 07:37:28', '2025-10-02 07:46:43'),
(3, 'Services', 'services', 'active', '2025-10-02 07:38:20', '2025-10-02 07:46:52'),
(4, 'Projects', 'portfolio', 'active', '2025-10-02 07:39:18', '2025-10-02 07:47:16'),
(5, 'Client Say\'s', 'testimonials', 'active', '2025-10-02 07:40:01', '2025-10-02 07:47:30'),
(6, 'Blog\'s', 'blog', 'active', '2025-10-02 07:40:21', '2025-10-02 07:47:45');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2025_09_24_142528_create_images_table', 1),
(3, '2025_09_24_142753_create_services_table', 1),
(4, '2025_10_01_182735_create_projects_table', 2),
(5, '2025_10_01_184639_create_teams_table', 3),
(6, '2025_10_01_191513_create_faqs_table', 4),
(7, '2025_10_01_193205_create_reviews_table', 5),
(8, '2025_10_01_195440_create_menus_table', 6),
(9, '2025_10_01_195457_create_sub_menus_table', 6),
(10, '2025_10_06_123500_create_hero_sections_table', 7),
(11, '2025_10_06_180548_create_abouts_table', 8),
(12, '2025_10_06_191127_fix_about_json_columns', 9);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `tags` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `status`, `tags`, `link`, `created_at`, `updated_at`) VALUES
(2, 'Glyde', 'glyde-ride-app', 'Glyde Ride Sharing App', 'active', 'Glyde', 'http://example.com/link/to/document', '2025-10-01 13:43:03', '2025-10-01 13:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `designation`, `email`, `rating`, `review`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Ali Baig', 'CEO', 'baiga8424@gmail.com', '5', 'Partnering with Apex SoftBuild was a turning point for our business. From the start, their team demonstrated a level of professionalism and expertise that’s hard to find. They took time to understand not only our immediate needs but also our long-term vision, and they crafted a solution that truly aligned with both.', 'active', '2025-10-02 10:56:50', '2025-10-02 10:56:50'),
(3, 'Ali Baig', 'CEO', 'baiga8424@gmail.com', '5', 'Working with Apex SoftBuild completely transformed our approach. Their team wasn’t just professional; they genuinely cared about understanding what we needed and where we wanted to go. The result fit our business perfectly, and we could feel their dedication every step of the way.', 'active', '2025-10-06 07:24:45', '2025-10-06 07:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `description`, `tags`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', 'Web Development Service', 'web development,web dev service', 'active', '2025-09-25 09:50:45', '2025-09-25 14:44:21'),
(5, 'Digital Marketing', 'digital-marketing', 'Digital marketing', 'hi', 'active', '2025-09-26 13:03:58', '2025-09-26 13:03:58'),
(6, 'App Development', 'app-development', 'app development service', 'app', 'active', '2025-10-01 13:24:17', '2025-10-01 13:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

CREATE TABLE `sub_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`id`, `name`, `link`, `menu_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', '/web-development', 3, 'active', '2025-10-02 07:38:20', '2025-10-02 07:38:20'),
(2, 'App Development', '/app-development', 3, 'active', '2025-10-02 08:55:47', '2025-10-02 08:55:47'),
(3, 'Digital Maketing', '/digital-marketing', 3, 'active', '2025-10-02 08:57:46', '2025-10-02 08:57:46'),
(4, 'UI/UX Development', '/ui-ux-development', 3, 'active', '2025-10-02 08:57:46', '2025-10-02 08:57:46'),
(5, 'Social Media Marketing', '/social-media-marketing', 3, 'active', '2025-10-02 09:00:00', '2025-10-02 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `github`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Ali Baig', 'CEO', 'baiga8424@gmail.com', 'https://facebook.com/themirzaalibaig', NULL, NULL, NULL, 'https://github.com/themirzaalibaig', 'active', '2025-10-01 14:00:42', '2025-10-01 14:12:43'),
(7, 'Talha Khan', 'P.Dev', NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2025-10-01 14:13:18', '2025-10-01 14:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$12$rR4nOdUwCM8/ceMNwvy.BOxfUeKANSXxqbvBPAw8pGWE8mmITRqSm', '2025-09-25 09:50:00', '2025-09-25 09:50:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_menus_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_menus`
--
ALTER TABLE `sub_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `sub_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
