-- Portfolio Sergio Database Schema
-- MySQL 5.5 Compatible
-- Database: portfolio_sergio_db

CREATE DATABASE IF NOT EXISTS `portfolio_sergio_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `portfolio_sergio_db`;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Default admin user (password: admin123)
-- Password hash generated with password_hash('admin123', PASSWORD_BCRYPT)
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `is_active`, `created_at`, `updated_at`) VALUES
('admin', 'jericosergio2@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mat Jerico Sergio', 1, NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `portfolio_data`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `portfolio_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_key` varchar(50) NOT NULL,
  `data_value` text NOT NULL,
  `data_type` varchar(20) NOT NULL DEFAULT 'string',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_key` (`data_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default portfolio data
INSERT INTO `portfolio_data` (`data_key`, `data_value`, `data_type`, `created_at`, `updated_at`) VALUES
('name', 'Mat Jerico Sergio', 'string', NOW(), NOW()),
('tagline', 'Web Development Engineer', 'string', NOW(), NOW()),
('email', 'jericosergio2@gmail.com', 'string', NOW(), NOW()),
('work_email', 'mjsergio@sdca.edu.ph', 'string', NOW(), NOW()),
('phone', '+63 XXX XXX XXXX', 'string', NOW(), NOW()),
('location', 'Bacoor, Cavite, Philippines', 'string', NOW(), NOW()),
('github', 'https://github.com/jericosergio', 'string', NOW(), NOW()),
('linkedin', 'https://www.linkedin.com/in/jrcsrg', 'string', NOW(), NOW()),
('profile_image', 'assets/profile.jpg', 'string', NOW(), NOW()),
('about', 'Management Information System Head at St. Dominic College of Asia, leading application development and MIS operations for educational technology initiatives. With 3+ years of progressive experience, I build practical systems that serve Registrars, Finance/Treasury, Admissions, Program Chairs, Faculty, and students daily.', 'text', NOW(), NOW()),
('aspirations', 'Continue growing as a technical leader and software engineer, building systems that solve real problems for real people. Passionate about learning modern technologies while maintaining deep expertise in proven tools.', 'text', NOW(), NOW()),
('clients_stakeholders', 'Registrar, Admissions Office, Program Chairs/Deans, Faculty, Students—the day-to-day users I build for and support.', 'text', NOW(), NOW());

-- --------------------------------------------------------
-- Table structure for table `projects`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tech` varchar(500) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_training` tinyint(1) NOT NULL DEFAULT '0',
  `timeline` varchar(100) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `full_description` text,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `featured` (`featured`),
  KEY `is_active` (`is_active`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `project_metrics`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `project_metrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `metric_label` varchar(100) NOT NULL,
  `metric_value` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `fk_project_metrics_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `project_highlights`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `project_highlights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `highlight_text` text NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `fk_project_highlights_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `project_images`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `project_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `fk_project_images_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `skills`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `experience`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `duration` varchar(100) NOT NULL,
  `responsibilities` text NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `education`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `year` varchar(50) NOT NULL,
  `honors` varchar(255) DEFAULT NULL,
  `highlights` text,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Table structure for table `tech_stack`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `tech_stack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `technologies` varchar(500) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Activity log table for CMS actions
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `description` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `created_at` (`created_at`),
  CONSTRAINT `fk_activity_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
