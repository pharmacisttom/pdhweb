-- Database: `pdhweb`

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- --------------------------------------------------------

-- Table structure for table `departments`
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `contact_info` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departments` (`name`, `description`, `icon`) VALUES
('กลุ่มงานการแพทย์', 'รับผิดชอบด้านการตรวจรักษาโรคทั่วไปและเฉพาะทาง', 'bi-hospital'),
('กลุ่มงานทันตกรรม', 'บริการด้านทันตกรรมครบวงจร', 'bi-bandaid'),
('กลุ่มงานเภสัชกรรม', 'บริการจ่ายยาและให้คำปรึกษาด้านยา', 'bi-capsule');

-- --------------------------------------------------------

-- Table structure for table `services`
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `open_time` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `preparation` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`department_id`, `name`, `description`, `open_time`, `location`) VALUES
(1, 'แผนกผู้ป่วยนอก (OPD)', 'ให้บริการตรวจรักษาโรคทั่วไป', 'จันทร์-ศุกร์ 08:00 - 16:00 น.', 'ชั้น 1 อาคารผู้ป่วยนอก'),
(1, 'ห้องฉุกเฉิน (ER)', 'ให้บริการผู้ป่วยฉุกเฉิน อุบัติเหตุ', 'เปิดบริการ 24 ชั่วโมง', 'ชั้น 1 อาคารฉุกเฉิน');

-- --------------------------------------------------------

-- Table structure for table `doctors`
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(50) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `specialty` varchar(150) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `doctors` (`prefix`, `firstname`, `lastname`, `specialty`) VALUES
('พญ.', 'สมหญิง', 'ใจดี', 'อายุรกรรมทั่วไป'),
('นพ.', 'สมชาย', 'รักความสุข', 'ศัลยกรรมกระดูก');

-- --------------------------------------------------------

-- Table structure for table `clinics`
CREATE TABLE IF NOT EXISTS `clinics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `clinics_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `clinics` (`department_id`, `name`, `location`) VALUES
(1, 'คลินิกเบาหวาน (NCD)', 'อาคารผู้ป่วยนอก ชั้น 2'),
(1, 'คลินิกความดันโลหิตสูง', 'อาคารผู้ป่วยนอก ชั้น 2');

-- --------------------------------------------------------

-- Table structure for table `clinic_schedules`
CREATE TABLE IF NOT EXISTS `clinic_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `day_of_week` tinyint(1) NOT NULL COMMENT '0=Sun, 1=Mon, ..., 6=Sat',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `clinic_id` (`clinic_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `clinic_schedules_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  CONSTRAINT `clinic_schedules_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `clinic_schedules` (`clinic_id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 1, 1, '08:00:00', '12:00:00'),
(2, 1, 2, '08:00:00', '12:00:00'),
(1, 2, 3, '13:00:00', '16:00:00');

COMMIT;
