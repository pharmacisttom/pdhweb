-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pdhweb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `hn_number` varchar(50) DEFAULT NULL,
  `patient_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `booking_ref` varchar(50) DEFAULT NULL,
  `time_slot` enum('morning','afternoon') DEFAULT 'morning',
  `queue_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `clinic_id` (`clinic_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE SET NULL,
  CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL,
  CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,NULL,'67-004512','???????? ?????????','081-234-5678',1,1,NULL,'2026-08-24','09:00:00','??????????????????????????????????????','pending','2026-08-23 13:33:04','2026-08-23 13:33:04',NULL,'PDH-20260824-6657','morning','QM-001');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `old_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_data`)),
  `new_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_data`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,2,'LOGIN','auth',NULL,NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','2026-08-12 04:03:07'),(2,2,'LOGIN','auth',NULL,NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','2026-08-12 11:53:21'),(3,1,'LOGIN','auth',NULL,NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','2026-08-23 12:57:41'),(4,1,'LOGOUT','auth',NULL,NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','2026-08-24 09:33:43'),(5,1,'LOGIN','auth',NULL,NULL,NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','2026-08-24 10:02:49');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (3,'โรงพยาบาลปลวกแดง มุ่งมั่นสู่ความเป็นเลิศด้านการบริการทางการแพทย์','slider_1.jpg','http://localhost/pdhweb/services',1,'active',NULL,'2026-08-23 13:22:51','2026-08-24 09:01:09'),(4,'ทีมแพทย์ผู้เชี่ยวชาญและเทคโนโลยีการตรวจรักษาที่ทันสมัย ใส่ใจทุกชีวิต','slider_2.jpg','http://localhost/pdhweb/doctors',2,'active',NULL,'2026-08-23 13:22:51','2026-08-24 09:01:09');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_schedules`
--

DROP TABLE IF EXISTS `clinic_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinic_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `day_of_week` tinyint(1) NOT NULL COMMENT '0=Sun, 1=Mon, ..., 6=Sat',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `clinic_id` (`clinic_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `clinic_schedules_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  CONSTRAINT `clinic_schedules_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_schedules`
--

LOCK TABLES `clinic_schedules` WRITE;
/*!40000 ALTER TABLE `clinic_schedules` DISABLE KEYS */;
INSERT INTO `clinic_schedules` VALUES (1,1,1,1,'08:00:00','12:00:00',NULL,'2026-08-12 12:49:22'),(2,2,1,2,'08:00:00','12:00:00',NULL,'2026-08-12 12:49:22'),(3,1,2,3,'13:00:00','16:00:00',NULL,'2026-08-12 12:49:22');
/*!40000 ALTER TABLE `clinic_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinics`
--

DROP TABLE IF EXISTS `clinics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `clinics_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinics`
--

LOCK TABLES `clinics` WRITE;
/*!40000 ALTER TABLE `clinics` DISABLE KEYS */;
INSERT INTO `clinics` VALUES (1,1,'คลินิกเบาหวาน (NCD)','บริการตรวจรักษาและติดตามอาการผู้ป่วยเบาหวาน','ห้องตรวจ 1 อาคารผู้ป่วยนอก',NULL,NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(2,1,'คลินิกความดันโลหิตสูง','บริการตรวจรักษาและติดตามอาการผู้ป่วยความดันโลหิตสูง','ห้องตรวจ 2 อาคารผู้ป่วยนอก',NULL,NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(3,2,'คลินิกทันตกรรม','บริการทันตกรรมครบวงจร รักษาสุขภาพช่องปาก','ชั้น 2 อาคารบริการ',NULL,NULL,'active','2026-08-23 13:06:33','2026-08-24 09:01:09',NULL),(4,1,'คลินิกฝากครรภ์และวางแผนครอบครัว','บริการตรวจสุขภาพมารดาและทารกในครรภ์','ห้องตรวจ 4 อาคารผู้ป่วยนอก',NULL,NULL,'active','2026-08-23 13:06:33','2026-08-24 09:01:09',NULL);
/*!40000 ALTER TABLE `clinics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_code` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_anonymous` tinyint(1) DEFAULT 0,
  `status` enum('pending','investigating','resolved','rejected') DEFAULT 'pending',
  `admin_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tracking_code` (`tracking_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `contact_info` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'กลุ่มงานการแพทย์','รับผิดชอบด้านการตรวจรักษาโรคทั่วไปและเฉพาะทาง',NULL,'bi-hospital',NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(2,'กลุ่มงานทันตกรรม','บริการด้านทันตกรรมครบวงจร',NULL,'bi-bandaid',NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(3,'กลุ่มงานเภสัชกรรม','บริการจ่ายยาและให้คำปรึกษาด้านยา',NULL,'bi-capsule',NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(4,'กลุ่มงานอุบัติเหตุและฉุกเฉิน','บริการกู้ชีพและอุบัติเหตุฉุกเฉินตลอด 24 ชั่วโมง',NULL,'bi-ambulance',NULL,'active','2026-08-23 13:06:14','2026-08-24 09:01:09',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(50) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `specialty` varchar(150) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'พญ.','สมหญิง','ใจดี',NULL,'นายแพทย์ชำนาญการพิเศษ','อายุรแพทย์','ผู้เชี่ยวชาญด้านอายุรกรรมทั่วไปและโรคเรื้อรัง','active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(2,'นพ.','สมชาย','รักความสุข',NULL,'นายแพทย์ชำนาญการ','กุมารแพทย์','ผู้เชี่ยวชาญด้านกุมารเวชกรรมและการดูแลสุขภาพเด็ก','active','2026-08-12 12:49:22','2026-08-24 09:01:09',NULL),(3,'ทพญ.','สุพัตรา','ยิ้มสวย',NULL,'ทันตแพทย์ชำนาญการ','ทันตแพทย์','ผู้เชี่ยวชาญด้านทันตกรรมบูรณะและสุขภาพช่องปาก','active','2026-08-23 13:06:33','2026-08-24 09:01:09',NULL),(4,'นพ.','เกรียงไกร','รักษาดี',NULL,'นายแพทย์ชำนาญการ','ศัลยแพทย์กระดูกและข้อ','ผู้เชี่ยวชาญด้านกระดูก ข้อ และอุบัติเหตุ','active','2026-08-23 13:06:33','2026-08-24 09:01:09',NULL);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donation_items`
--

DROP TABLE IF EXISTS `donation_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donation_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` enum('general','money','equipment') DEFAULT 'general',
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `target_amount` decimal(10,2) DEFAULT 0.00,
  `current_amount` decimal(10,2) DEFAULT 0.00,
  `target_quantity` int(11) DEFAULT 0,
  `current_quantity` int(11) DEFAULT 0,
  `status` enum('active','inactive','completed') DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donation_items`
--

LOCK TABLES `donation_items` WRITE;
/*!40000 ALTER TABLE `donation_items` DISABLE KEYS */;
INSERT INTO `donation_items` VALUES (3,'จัดซื้อเครื่องช่วยหายใจสำหรับผู้ป่วยวิกฤต (ICU)','general','ร่วมบริจาคสมทบทุนจัดซื้อเครื่องช่วยหายใจประสิทธิภาพสูง เพื่อรองรับผู้ป่วยฉุกเฉินและวิกฤตของโรงพยาบาลปลวกแดง',NULL,500000.00,185000.00,0,0,'active',NULL,'2026-08-23 13:10:52','2026-08-24 09:01:09',NULL),(4,'กองทุนสงเคราะห์ผู้ป่วยยากไร้และผู้ด้อยโอกาส','general','สมทบทุนช่วยเหลือค่ารักษาพยาบาล อุปกรณ์การแพทย์ และค่าเดินทางสำหรับผู้ป่วยยากไร้ในพื้นที่อำเภอปลวกแดง',NULL,200000.00,94500.00,0,0,'active',NULL,'2026-08-23 13:10:52','2026-08-24 09:01:09',NULL),(5,'จัดซื้อเตียงผู้ป่วยระบบไฟฟ้าและเครื่องเฝ้าระวังสัญญาณชีพ','money','สมทบทุนจัดซื้อเตียงผู้ป่วยระบบไฟฟ้า 3 ไก และมอนิเตอร์เฝ้าระวังสัญญาณชีพ เพื่อเพิ่มศักยภาพการดูแลผู้ป่วยใน (IPD)',NULL,350000.00,168000.00,0,0,'active',NULL,'2026-08-24 09:41:26','2026-08-24 09:41:26',NULL),(6,'กองทุนพัฒนาศูนย์บริบาลผู้ป่วยระยะประคับประคอง (Palliative Care)','general','สนับสนุนอุปกรณ์ผลิตออกซิเจน ที่นอนลม และยาบรรเทาอาการสำหรับผู้ป่วยติดเตียงและผู้ป่วยระยะท้ายที่บ้าน',NULL,150000.00,89500.00,0,0,'active',NULL,'2026-08-24 09:41:26','2026-08-24 09:41:26',NULL);
/*!40000 ALTER TABLE `donation_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_item_id` int(11) NOT NULL,
  `donor_name` varchar(100) NOT NULL,
  `donor_phone` varchar(20) DEFAULT NULL,
  `donor_email` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `payment_slip_image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `approved_by` int(11) DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `donation_item_id` (`donation_item_id`),
  CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donation_item_id`) REFERENCES `donation_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donations`
--

LOCK TABLES `donations` WRITE;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
INSERT INTO `donations` VALUES (1,3,'บริษัท สยามอีสเทิร์น อินดัสเตรียล จำกัด (มหาชน)','081-999-XXXX',NULL,50000.00,NULL,NULL,'approved',NULL,NULL,'2026-08-23 09:41:26','2026-08-24 09:41:26'),(2,3,'คุณสมศักดิ์ และครอบครัวเจริญพานิช','089-123-XXXX',NULL,10000.00,NULL,NULL,'approved',NULL,NULL,'2026-08-22 09:41:26','2026-08-24 09:41:26'),(3,4,'คุณวิภาวรรณ รัตนศิริ (เพื่อผู้ป่วยยากไร้)','086-456-XXXX',NULL,5000.00,NULL,NULL,'approved',NULL,NULL,'2026-08-21 09:41:26','2026-08-24 09:41:26'),(4,3,'ผู้มีจิตศรัทธา ไม่ประสงค์ออกนาม','085-789-XXXX',NULL,20000.00,NULL,NULL,'approved',NULL,NULL,'2026-08-20 09:41:26','2026-08-24 09:41:26'),(5,4,'กลุ่มเพื่อนศิษย์เก่าระยองวิทยาคม รุ่น 34','081-333-XXXX',NULL,15000.00,NULL,NULL,'approved',NULL,NULL,'2026-08-19 09:41:26','2026-08-24 09:41:26');
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_logs`
--

DROP TABLE IF EXISTS `login_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `status` enum('success','failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_logs`
--

LOCK TABLES `login_logs` WRITE;
/*!40000 ALTER TABLE `login_logs` DISABLE KEYS */;
INSERT INTO `login_logs` VALUES (1,2,'adminpdh','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','success','2026-08-12 04:03:07'),(2,2,'adminpdh','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','success','2026-08-12 11:53:21'),(3,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:50:35'),(4,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:50:41'),(5,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:50:46'),(6,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:50:54'),(7,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:51:04'),(8,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-23 12:57:31'),(9,1,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','success','2026-08-23 12:57:41'),(10,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-24 10:02:40'),(11,NULL,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','failed','2026-08-24 10:02:42'),(12,1,'admin','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','success','2026-08-24 10:02:49');
/*!40000 ALTER TABLE `login_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `open_new_tab` tinyint(1) DEFAULT 0,
  `order_num` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main Menu','header','active','2026-08-12 03:50:05'),(2,'Footer Links','footer','active','2026-08-12 03:50:05');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'general',
  `status` enum('published','draft','archived') DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'ทรงพระเจริญ','news-1','','ด้วยเกล้าด้วยกระหม่อมขอเดชะ\r\nคณะผู้บริหารโรงพยาบาลปลวกแดง','1786536812_cafb60d0.jfif',NULL,'general','published','2026-08-12 14:13:32',2,'2026-08-12 12:13:32','2026-08-24 09:01:10',NULL),(2,'ประกาศผู้ชนะการเสนอราคา ประกวดราคาซื้อเครื่องกำเนิดไฟฟ้า ขนาด ๕๐๐ กิโลวัตต์ จำนวน ๑ เครื่อง','ประกาศผู้ชนะการเสนอราคา-ประกวดราคาซื้อเครื่องกำเนิดไฟฟ้า-ขนาด-๕๐๐-กิโลวัตต์-จำนวน-๑-เครื่อง','','ประกาศผู้ชนะการเสนอราคา ประกวดราคาซื้อเครื่องกำเนิดไฟฟ้า ขนาด ๕๐๐ กิโลวัตต์ จำนวน ๑ เครื่อง ด้วยวิธีประกวดราคาอิเล็กทรอนิกส์ (e-bidding)','default-news.jpg','1786538736_8494.pdf','procurement','published','2026-08-12 14:45:36',2,'2026-08-12 12:45:36','2026-08-24 09:02:55',NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'draft',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'ประวัติความเป็นมาโรงพยาบาลปลวกแดง','about','<div class=\"about-hospital-wrapper\">\n    <div class=\"row g-4 align-items-center mb-5\">\n        <div class=\"col-lg-6\">\n            <h3 class=\"fw-bold text-dark mb-3\">โรงพยาบาลปลวกแดง (Pluak Daeng Hospital)</h3>\n            <p class=\"text-secondary lh-lg mb-3\">\n                โรงพยาบาลปลวกแดง สังกัดสำนักงานสาธารณสุขจังหวัดระยอง สำนักงานปลัดกระทรวงสาธารณสุข เริ่มก่อตั้งขึ้นเพื่อรองรับการให้บริการสาธารณสุขแก่ประชาชนในอำเภอปลวกแดงและพื้นที่ใกล้เคียง ซึ่งเป็นพื้นที่ที่มีการเติบโตอย่างรวดเร็วทางเศรษฐกิจและอุตสาหกรรมในภาคตะวันออก\n            </p>\n            <p class=\"text-secondary lh-lg mb-0\">\n                ปัจจุบันโรงพยาบาลปลวกแดงได้พัฒนาศักยภาพในการให้บริการทางการแพทย์อย่างต่อเนื่อง ทั้งแผนกผู้ป่วยนอก (OPD), แผนกอุบัติเหตุและฉุกเฉิน (ER 24 ชั่วโมง), แผนกผู้ป่วยใน (IPD), บริการตรวจวินิจฉัยทางรังสีวิทยาและห้องปฏิบัติการที่ทันสมัย เพื่อมุ่งสู่การเป็นโรงพยาบาลคุณภาพมาตรฐานระดับสากล\n            </p>\n        </div>\n        <div class=\"col-lg-6\">\n            <div class=\"card border-0 shadow-sm rounded-4 overflow-hidden p-3 bg-light\">\n                <div class=\"d-flex align-items-center gap-3 mb-3\">\n                    <div class=\"rounded-circle bg-primary bg-opacity-10 p-3 text-primary\">\n                        <i class=\"bi bi-geo-alt-fill fs-2\"></i>\n                    </div>\n                    <div>\n                        <div class=\"fw-bold text-dark\">ที่ตั้งโรงพยาบาล</div>\n                        <small class=\"text-muted\">272 หมู่ 1 ถนนเทศบาล 8 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140</small>\n                    </div>\n                </div>\n                <div class=\"d-flex align-items-center gap-3\">\n                    <div class=\"rounded-circle bg-success bg-opacity-10 p-3 text-success\">\n                        <i class=\"bi bi-telephone-fill fs-2\"></i>\n                    </div>\n                    <div>\n                        <div class=\"fw-bold text-dark\">โทรศัพท์ติดต่อ</div>\n                        <small class=\"text-muted\">033-650-413 (สายตรงฉุกเฉิน / ประชาสัมพันธ์)</small>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n\n    <div class=\"card border-0 bg-primary bg-opacity-10 rounded-4 p-4 p-md-5 mb-4\">\n        <h4 class=\"fw-bold text-primary mb-3\"><i class=\"bi bi-award-fill me-2\"></i>มาตรฐานและการรับรองคุณภาพ</h4>\n        <p class=\"text-dark mb-0 lh-lg\">\n            โรงพยาบาลปลวกแดงได้รับการรับรองกระบวนการคุณภาพมาตรฐานโรงพยาบาล (Hospital Accreditation - HA) และมุ่งเน้นการพัฒนาตามแนวทาง 2P Safety (Patient and Personal Safety) เพื่อสร้างความมั่นใจและความปลอดภัยสูงสุดแก่ผู้รับบริการและบุคลากรทางการแพทย์ทุกท่าน\n        </p>\n    </div>\n</div>','published',1,'2026-08-24 10:05:40','2026-08-24 10:05:40',NULL),(2,'คณะผู้บริหารโรงพยาบาลปลวกแดง','executives','<div class=\"executives-wrapper\">\n    <div class=\"text-center mb-5\">\n        <h3 class=\"fw-bold text-dark\">โครงสร้างคณะผู้บริหาร</h3>\n        <p class=\"text-muted\">โรงพยาบาลปลวกแดง สำนักงานสาธารณสุขจังหวัดระยอง</p>\n    </div>\n\n    <div class=\"row g-4 justify-content-center\">\n        <!-- ผู้อำนวยการโรงพยาบาล -->\n        <div class=\"col-md-6 col-lg-5 text-center\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <div class=\"mx-auto mb-3 rounded-circle overflow-hidden bg-light d-flex align-items-center justify-content-center\" style=\"width: 140px; height: 140px; border: 4px solid #0d9488;\">\n                    <i class=\"bi bi-person-fill text-primary\" style=\"font-size: 5rem;\"></i>\n                </div>\n                <h5 class=\"fw-bold text-dark mb-1\">นายแพทย์ผู้อำนวยการโรงพยาบาล</h5>\n                <span class=\"badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3\">ผู้อำนวยการโรงพยาบาลปลวกแดง</span>\n                <p class=\"small text-muted mb-0\">ผู้นำในการขับเคลื่อนคุณภาพการบริการทางการแพทย์และการพัฒนาระบบสุขภาพชุมชน</p>\n            </div>\n        </div>\n    </div>\n\n    <div class=\"row g-4 justify-content-center mt-3\">\n        <!-- รองผู้อำนวยการฝ่ายการแพทย์ -->\n        <div class=\"col-md-4 text-center\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <div class=\"mx-auto mb-3 rounded-circle overflow-hidden bg-light d-flex align-items-center justify-content-center\" style=\"width: 110px; height: 110px; border: 3px solid #0284c7;\">\n                    <i class=\"bi bi-person-badge text-info\" style=\"font-size: 3.5rem;\"></i>\n                </div>\n                <h6 class=\"fw-bold text-dark mb-1\">หัวหน้ากลุ่มงานการแพทย์</h6>\n                <p class=\"small text-muted mb-0\">ดูแลมาตรฐานการรักษาพยาบาลและการบริการทางการแพทย์</p>\n            </div>\n        </div>\n\n        <!-- หัวหน้ากลุ่มการพยาบาล -->\n        <div class=\"col-md-4 text-center\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <div class=\"mx-auto mb-3 rounded-circle overflow-hidden bg-light d-flex align-items-center justify-content-center\" style=\"width: 110px; height: 110px; border: 3px solid #10b981;\">\n                    <i class=\"bi bi-heart-pulse text-success\" style=\"font-size: 3.5rem;\"></i>\n                </div>\n                <h6 class=\"fw-bold text-dark mb-1\">หัวหน้ากลุ่มงานการพยาบาล</h6>\n                <p class=\"small text-muted mb-0\">ดูแลมาตรฐานการพยาบาลและการดูแลผู้ป่วยอย่างอบอุ่น</p>\n            </div>\n        </div>\n\n        <!-- หัวหน้ากลุ่มงานบริหารทั่วไป -->\n        <div class=\"col-md-4 text-center\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <div class=\"mx-auto mb-3 rounded-circle overflow-hidden bg-light d-flex align-items-center justify-content-center\" style=\"width: 110px; height: 110px; border: 3px solid #f59e0b;\">\n                    <i class=\"bi bi-building text-warning\" style=\"font-size: 3.5rem;\"></i>\n                </div>\n                <h6 class=\"fw-bold text-dark mb-1\">หัวหน้ากลุ่มงานบริหารทั่วไป</h6>\n                <p class=\"small text-muted mb-0\">ดูแลงานสนับสนุน ธุรการ พัสดุ การเงิน และอาคารสถานที่</p>\n            </div>\n        </div>\n    </div>\n</div>','published',1,'2026-08-24 10:05:40','2026-08-24 10:05:40',NULL),(3,'วิสัยทัศน์ พันธกิจ ค่านิยม และเป้าหมาย','vision','<div class=\"vision-mission-wrapper\">\n    <!-- Vision -->\n    <div class=\"card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 text-white\" style=\"background: linear-gradient(135deg, #093f35 0%, #0d9488 100%);\">\n        <div class=\"d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-15 mb-3 border border-white border-opacity-25\">\n            <i class=\"bi bi-eye-fill text-warning\"></i>\n            <span class=\"small fw-semibold\">VISION</span>\n        </div>\n        <h3 class=\"fw-bold mb-2\">วิสัยทัศน์ (Vision)</h3>\n        <p class=\"fs-5 mb-0 opacity-90\">\n            \"โรงพยาบาลชุมชนคุณภาพชั้นนำ มุ่งสู่การบริการที่เป็นเลิศ ประชาชนสุขภาพดี ภาคีมีส่วนร่วม บุคลากรมีความสุข\"\n        </p>\n    </div>\n\n    <!-- Mission Grid -->\n    <div class=\"row g-4 mb-4\">\n        <div class=\"col-md-6\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <h5 class=\"fw-bold text-primary mb-3\"><i class=\"bi bi-flag-fill me-2\"></i>พันธกิจ (Mission)</h5>\n                <ul class=\"list-unstyled d-flex flex-column gap-2 mb-0 text-secondary lh-base\">\n                    <li class=\"d-flex gap-2\">\n                        <i class=\"bi bi-check-circle-fill text-success mt-1\"></i>\n                        <span>ให้บริการสุขภาพแบบองค์รวมที่มีคุณภาพและได้มาตรฐานระดับสากล</span>\n                    </li>\n                    <li class=\"d-flex gap-2\">\n                        <i class=\"bi bi-check-circle-fill text-success mt-1\"></i>\n                        <span>พัฒนาระบบสุขภาพปฐมภูมิและสร้างความเข้มแข็งของภาคีเครือข่ายสุขภาพชุมชน</span>\n                    </li>\n                    <li class=\"d-flex gap-2\">\n                        <i class=\"bi bi-check-circle-fill text-success mt-1\"></i>\n                        <span>นำเทคโนโลยีดิจิทัลมาประยุกต์ใช้เพื่อเพิ่มประสิทธิภาพการบริการและความสะดวกรวดเร็ว</span>\n                    </li>\n                    <li class=\"d-flex gap-2\">\n                        <i class=\"bi bi-check-circle-fill text-success mt-1\"></i>\n                        <span>ส่งเสริมบรรยากาศการทำงานที่มีความสุข มีคุณธรรม และโปร่งใสตรวจสอบได้</span>\n                    </li>\n                </ul>\n            </div>\n        </div>\n\n        <div class=\"col-md-6\">\n            <div class=\"card border-0 shadow-sm rounded-4 p-4 h-100 bg-white\">\n                <h5 class=\"fw-bold text-success mb-3\"><i class=\"bi bi-gem me-2\"></i>ค่านิยมหลัก (Core Values) - MOPH</h5>\n                <div class=\"d-flex flex-column gap-3\">\n                    <div class=\"d-flex align-items-start gap-3\">\n                        <span class=\"badge bg-primary rounded-pill px-3 py-2\">M</span>\n                        <div><strong>Mastery:</strong> เป็นนายตัวเอง เป็นผู้เชี่ยวชาญ และใฝ่รู้</div>\n                    </div>\n                    <div class=\"d-flex align-items-start gap-3\">\n                        <span class=\"badge bg-success rounded-pill px-3 py-2\">O</span>\n                        <div><strong>Originality:</strong> เร่งสร้างสิ่งใหม่ สร้างสรรค์นวัตกรรม</div>\n                    </div>\n                    <div class=\"d-flex align-items-start gap-3\">\n                        <span class=\"badge bg-info rounded-pill px-3 py-2\">P</span>\n                        <div><strong>People Centered:</strong> ยึดประชาชนและผู้รับบริการเป็นศูนย์กลาง</div>\n                    </div>\n                    <div class=\"d-flex align-items-start gap-3\">\n                        <span class=\"badge bg-warning rounded-pill px-3 py-2 text-dark\">H</span>\n                        <div><strong>Humility:</strong> อ่อนน้อมถ่อมตน มีจิตใจบริการ</div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>','published',1,'2026-08-24 10:05:40','2026-08-24 10:05:40',NULL),(4,'สิทธิและหน้าที่ของผู้รับบริการ (Patient Rights)','patient-rights','<div class=\"patient-rights-wrapper\">\n    <div class=\"card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4\">\n        <h4 class=\"fw-bold text-primary mb-3\"><i class=\"bi bi-shield-shaded me-2\"></i>คำประกาศสิทธิและข้อพึงปฏิบัติของผู้ป่วย</h4>\n        <p class=\"text-secondary lh-lg mb-4\">\n            โรงพยาบาลปลวกแดงตระหนักถึงความสำคัญของสิทธิผู้ป่วย เพื่อให้การรักษาพยาบาลเป็นไปอย่างมีมาตรฐาน ถูกต้องตามหลักวิชาชีพและกฎหมาย โดยยึดหลักความเคารพในศักดิ์ศรีความเป็นมนุษย์\n        </p>\n\n        <h5 class=\"fw-bold text-dark mb-3\">1. สิทธิของผู้ป่วย</h5>\n        <ul class=\"text-secondary lh-lg mb-4\">\n            <li>ผู้ป่วยทุกคนมีสิทธิขั้นพื้นฐานที่จะได้รับการรักษาพยาบาลและการดูแลสุขภาพที่ได้มาตรฐานวิชาชีพ โดยไม่มีการเลือกปฏิบัติ</li>\n            <li>ผู้ป่วยมีสิทธิได้รับทราบข้อมูลเกี่ยวกับความเจ็บป่วย แผนการรักษา ทางเลือกในการรักษา และผลข้างเคียงที่อาจเกิดขึ้น</li>\n            <li>ผู้ป่วยมีสิทธิได้รับการปกปิดข้อมูลด้านสุขภาพเป็นความลับ เว้นแต่จะได้รับความยินยอมจากผู้ป่วยหรือตามที่กฎหมายกำหนด</li>\n            <li>ผู้ป่วยมีสิทธิได้รับการปฏิบัติด้วยความเคารพในศักดิ์ศรีและความเป็นส่วนตัวในระหว่างการตรวจรักษา</li>\n        </ul>\n\n        <h5 class=\"fw-bold text-dark mb-3\">2. ข้อพึงปฏิบัติของผู้ป่วย</h5>\n        <ul class=\"text-secondary lh-lg mb-0\">\n            <li>ให้ข้อมูลด้านสุขภาพและประวัติการรักษาที่ถูกต้องและครบถ้วนแก่บุคลากรทางการแพทย์</li>\n            <li>ปฏิบัติตามคำแนะนำและแผนการรักษาของแพทย์และบุคลากรทางการแพทย์อย่างเคร่งครัด</li>\n            <li>เคารพสิทธิ ความเป็นส่วนตัว และความสงบเรียบร้อยของผู้ป่วยท่านอื่นในสถานพยาบาล</li>\n            <li>ให้ความร่วมมือในการรักษาระเบียบและปฏิบัติตามมาตรการความปลอดภัยของโรงพยาบาล</li>\n        </ul>\n    </div>\n</div>','published',1,'2026-08-24 10:05:40','2026-08-24 10:05:40',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'news.view','View news','news','2026-08-12 03:50:05'),(2,'news.create','Create news','news','2026-08-12 03:50:05'),(3,'news.edit','Edit news','news','2026-08-12 03:50:05'),(4,'news.delete','Delete news','news','2026-08-12 03:50:05'),(5,'news.approve','Approve news','news','2026-08-12 03:50:05'),(6,'news.publish','Publish news','news','2026-08-12 03:50:05'),(7,'users.manage','Manage users','users','2026-08-12 03:50:05'),(8,'settings.manage','Manage settings','settings','2026-08-12 03:50:05');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (1,'ข่าวประชาสัมพันธ์','public-relations','ข่าวสารทั่วไปสำหรับประชาชน','2026-08-11 02:50:44','2026-08-24 09:01:10',NULL),(2,'ประกาศรับสมัครงาน','job-openings','ข่าวรับสมัครบุคลากร','2026-08-11 02:50:44','2026-08-24 09:01:10',NULL),(3,'ข่าวจัดซื้อจัดจ้าง','procurement','ประกาศจัดซื้อจัดจ้างของโรงพยาบาล','2026-08-11 02:50:44','2026-08-24 09:01:10',NULL);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `content` longtext NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('draft','review','approved','published','archived') DEFAULT 'draft',
  `view_count` int(11) DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurements`
--

DROP TABLE IF EXISTS `procurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procurements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `budget_year` int(4) NOT NULL,
  `project_budget` decimal(15,2) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `document_url` varchar(255) DEFAULT NULL,
  `category` varchar(150) NOT NULL DEFAULT 'ประกาศจัดซื้อจัดจ้าง',
  `status` enum('active','archived') DEFAULT 'active',
  `published_at` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `procurements_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurements`
--

LOCK TABLES `procurements` WRITE;
/*!40000 ALTER TABLE `procurements` DISABLE KEYS */;
INSERT INTO `procurements` VALUES (1,'ประกาศประกวดราคาซื้อเครื่องกำเนิดไฟฟ้า ขนาด 500 กิโลวัตต์ จำนวน 1 เครื่อง',2567,1850000.00,'ประกวดราคาอิเล็กทรอนิกส์ (e-bidding)',NULL,'ประกาศจัดซื้อจัดจ้าง','active','2026-08-23',NULL,'2026-08-23 13:10:52','2026-08-24 09:47:53',NULL),(2,'แผนการจัดซื้อจัดจ้างยาและเวชภัณฑ์ ประจำปีงบประมาณ 2567',2567,5000000.00,'คัดเลือก',NULL,'แผนการจัดซื้อจัดจ้าง','active','2026-08-23',NULL,'2026-08-23 13:10:52','2026-08-24 09:47:53',NULL),(3,'ประกาศผู้ชนะการเสนอราคา จ้างเหมาบริการรักษาความปลอดภัย ประจำปีงบประมาณ 2568',2568,960000.00,'e-Bidding','','สรุปผลการจัดซื้อจัดจ้าง','active','2026-08-20',NULL,'2026-08-24 09:47:53','2026-08-24 09:47:53',NULL),(4,'ประกาศราคากลางและการจัดซื้อครุภัณฑ์การแพทย์ เครื่องติดตามการทำงานของหัวใจและหลอดเลือด',2567,750000.00,'ประกวดราคาอิเล็กทรอนิกส์','','ประกาศจัดซื้อจัดจ้าง','active','2026-08-18',NULL,'2026-08-24 09:47:53','2026-08-24 09:47:53',NULL),(5,'สรุปผลการจัดซื้อจัดจ้างในรอบเดือน (สขร.1) ประจำเดือน กรกฎาคม 2567',2567,1250000.00,'เฉพาะเจาะจง','','สรุปผลการจัดซื้อจัดจ้าง','active','2026-08-15',NULL,'2026-08-24 09:47:53','2026-08-24 09:47:53',NULL);
/*!40000 ALTER TABLE `procurements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `queues`
--

DROP TABLE IF EXISTS `queues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `queue_number` varchar(20) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `status` enum('waiting','calling','completed','skipped') DEFAULT 'waiting',
  `date_issued` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `counter_number` varchar(50) DEFAULT '1',
  `service_type` varchar(50) DEFAULT 'general',
  `phone` varchar(50) DEFAULT NULL,
  `estimated_wait_minutes` int(11) DEFAULT 10,
  `called_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `queues_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queues`
--

LOCK TABLES `queues` WRITE;
/*!40000 ALTER TABLE `queues` DISABLE KEYS */;
INSERT INTO `queues` VALUES (5,1,'A-001','นางสมพร สดใส','calling','2026-08-23','2026-08-23 13:41:27','2026-08-24 09:01:10','1','general','081-234-5678',10,'2026-08-23 13:41:41',NULL),(6,1,'P-001','ด.ช. ภูมิใจ ยิ้มแย้ม','calling','2026-08-23','2026-08-23 13:41:27','2026-08-24 09:01:10','1','pediatric','089-876-5432',10,'2026-08-23 13:41:47',NULL),(7,1,'D-001','นายมานะ ตั้งใจดี','calling','2026-08-23','2026-08-23 13:41:27','2026-08-24 09:01:10','1','dental','086-555-1234',10,'2026-08-23 13:43:22',NULL),(8,1,'A-002','นางสาวกนกวรรณ รุ่งเรือง','calling','2026-08-23','2026-08-23 13:41:27','2026-08-24 09:01:10','1','general','084-999-8877',10,'2026-08-23 13:48:34',NULL);
/*!40000 ALTER TABLE `queues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','Full access to all modules','2026-08-10 11:21:03'),(2,'Website Admin','Manage website content and settings','2026-08-10 11:21:03'),(3,'Content Admin','Manage specific content areas','2026-08-10 11:21:03');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,'แผนกผู้ป่วยนอก (OPD)','ให้บริการตรวจรักษาโรคทั่วไป',NULL,'จันทร์-ศุกร์ 08:00 - 16:00 น.','ชั้น 1 อาคารผู้ป่วยนอก',NULL,NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:10',NULL),(2,1,'ห้องฉุกเฉิน (ER)','ให้บริการผู้ป่วยฉุกเฉิน อุบัติเหตุ',NULL,'เปิดบริการ 24 ชั่วโมง','ชั้น 1 อาคารฉุกเฉิน',NULL,NULL,'active','2026-08-12 12:49:22','2026-08-24 09:01:10',NULL),(3,2,'คลินิกทันตกรรมครบวงจร','บริการตรวจสุขภาพช่องปาก อุดฟัน ถอนฟัน ขูดหินปูน',NULL,'จันทร์-ศุกร์ 08:30 - 15:30 น.','ชั้น 2 อาคารบริการ',NULL,NULL,'active','2026-08-23 13:06:14','2026-08-24 09:01:10',NULL),(4,3,'ห้องจ่ายยาและให้คำปรึกษา','บริการจ่ายยาและแนะนำการใช้ยาโดยเภสัชกร',NULL,'เปิดบริการ 24 ชั่วโมง','ชั้น 1 อาคารผู้ป่วยนอก',NULL,NULL,'active','2026-08-23 13:06:14','2026-08-24 09:01:10',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'hospital_name_th','โรงพยาบาลปลวกแดง'),(2,'hospital_name_en','Pluak Daeng Hospital'),(3,'address','272 หมู่ 1 ถนนเทศบาล 8 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140'),(4,'telephone','033-650-413'),(5,'email','pluakdaenghospital@gmail.com'),(6,'news_categories','[{\"slug\":\"general\",\"name\":\"ข่าวประชาสัมพันธ์ทั่วไป\"},{\"slug\":\"service\",\"name\":\"ข่าวบริการโรงพยาบาล\"},{\"slug\":\"procurement\",\"name\":\"ข่าวจัดซื้อจัดจ้าง\"}]'),(9,'latitude','12.969940'),(10,'longitude','101.218922'),(11,'google_maps_embed','https://maps.google.com/maps?q=12.969940,101.218922&hl=th&z=17&output=embed');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@pdhweb.local','$2y$10$rv2YS4uZtA/.Y5f5AEqs5.ylU.nQ4K4XcAkWu4ZGf.f6Be9VZTag.',1,'Super','Admin','active','2026-08-24 10:02:49','2026-08-10 11:21:03','2026-08-24 10:02:49',NULL),(2,'adminpdh','adminpdh@pdhweb.local','$2y$10$Fdl2zPamGJ9Zo3gSWXqjOeb.78MStizbdoJ.9AyROJcO3PFgWpbxa',1,'Admin','PDH','active','2026-08-12 11:53:21','2026-08-12 04:00:58','2026-08-23 12:54:35',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit_logs`
--

DROP TABLE IF EXISTS `visit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `device_type` enum('mobile','tablet','desktop') NOT NULL DEFAULT 'desktop',
  `browser` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `page_url` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_visit_date` (`visit_date`),
  KEY `idx_device` (`device_type`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit_logs`
--

LOCK TABLES `visit_logs` WRITE;
/*!40000 ALTER TABLE `visit_logs` DISABLE KEYS */;
INSERT INTO `visit_logs` VALUES (1,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-23','2026-08-23 12:50:23'),(2,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-23','2026-08-23 13:08:26'),(3,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-23','2026-08-23 13:19:01'),(4,'127.0.0.1','desktop','Other',NULL,'/pdhweb/','2026-08-23','2026-08-23 13:26:30'),(5,'::1','desktop','Chrome',NULL,'/pdhweb/queue','2026-08-23','2026-08-23 13:33:19'),(6,'::1','desktop','Edge',NULL,'/pdhweb/queue/door/1','2026-08-23','2026-08-23 13:50:10'),(7,'::1','desktop','Other',NULL,'/pdhweb/public/','2026-08-24','2026-08-24 08:52:31'),(8,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-24','2026-08-24 08:53:17'),(9,'::1','desktop','Other',NULL,'/pdhweb/','2026-08-24','2026-08-24 09:05:10'),(10,'::1','desktop','Other',NULL,'/pdhweb/public/','2026-08-24','2026-08-24 09:05:20'),(11,'::1','desktop','Other',NULL,'/pdhweb/public/','2026-08-24','2026-08-24 09:05:54'),(12,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-24','2026-08-24 09:06:03'),(13,'::1','desktop','Other',NULL,'/pdhweb/ita','2026-08-24','2026-08-24 09:24:20'),(14,'::1','desktop','Chrome',NULL,'/pdhweb/public/ita','2026-08-24','2026-08-24 09:24:41'),(15,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 09:28:14'),(16,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 09:30:47'),(17,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 09:31:41'),(18,'::1','desktop','Other',NULL,'/pdhweb/','2026-08-24','2026-08-24 09:32:51'),(19,'::1','desktop','Chrome',NULL,'/pdhweb/public/','2026-08-24','2026-08-24 09:33:45'),(20,'::1','desktop','Other',NULL,'/pdhweb/risk','2026-08-24','2026-08-24 09:35:49'),(21,'::1','desktop','Other',NULL,'/pdhweb/hrms','2026-08-24','2026-08-24 09:36:04'),(22,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 09:42:12'),(23,'::1','desktop','Other',NULL,'/pdhweb/donation','2026-08-24','2026-08-24 09:42:21'),(24,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 09:42:37'),(25,'::1','desktop','Chrome',NULL,'/pdhweb/','2026-08-24','2026-08-24 09:43:11'),(26,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 09:45:02'),(27,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 09:45:12'),(28,'::1','desktop','Other',NULL,'/pdhweb/public/donations','2026-08-24','2026-08-24 09:45:44'),(29,'::1','desktop','Other',NULL,'/pdhweb/procurement','2026-08-24','2026-08-24 09:48:27'),(30,'::1','desktop','Other',NULL,'/pdhweb/public/procurement','2026-08-24','2026-08-24 09:48:35'),(31,'::1','desktop','Chrome',NULL,'/pdhweb/public/','2026-08-24','2026-08-24 10:02:34'),(32,'::1','desktop','Other',NULL,'/pdhweb/','2026-08-24','2026-08-24 10:04:39'),(33,'::1','desktop','Other',NULL,'/pdhweb/news','2026-08-24','2026-08-24 10:04:39'),(34,'::1','desktop','Other',NULL,'/pdhweb/ita','2026-08-24','2026-08-24 10:04:39'),(35,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 10:04:39'),(36,'::1','desktop','Other',NULL,'/pdhweb/risk','2026-08-24','2026-08-24 10:04:39'),(37,'::1','desktop','Other',NULL,'/pdhweb/hrms','2026-08-24','2026-08-24 10:04:39'),(38,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:04:39'),(39,'::1','desktop','Other',NULL,'/pdhweb/donation','2026-08-24','2026-08-24 10:04:39'),(40,'::1','desktop','Other',NULL,'/pdhweb/doctors','2026-08-24','2026-08-24 10:04:39'),(41,'::1','desktop','Other',NULL,'/pdhweb/doctor','2026-08-24','2026-08-24 10:04:39'),(42,'::1','desktop','Other',NULL,'/pdhweb/clinics','2026-08-24','2026-08-24 10:04:39'),(43,'::1','desktop','Other',NULL,'/pdhweb/clinic','2026-08-24','2026-08-24 10:04:39'),(44,'::1','desktop','Other',NULL,'/pdhweb/services','2026-08-24','2026-08-24 10:04:39'),(45,'::1','desktop','Other',NULL,'/pdhweb/service','2026-08-24','2026-08-24 10:04:39'),(46,'::1','desktop','Other',NULL,'/pdhweb/department','2026-08-24','2026-08-24 10:04:39'),(47,'::1','desktop','Other',NULL,'/pdhweb/departments','2026-08-24','2026-08-24 10:04:39'),(48,'::1','desktop','Other',NULL,'/pdhweb/procurement','2026-08-24','2026-08-24 10:04:39'),(49,'::1','desktop','Other',NULL,'/pdhweb/complaint','2026-08-24','2026-08-24 10:04:39'),(50,'::1','desktop','Other',NULL,'/pdhweb/appointment','2026-08-24','2026-08-24 10:04:39'),(51,'::1','desktop','Other',NULL,'/pdhweb/queue','2026-08-24','2026-08-24 10:04:39'),(52,'::1','desktop','Other',NULL,'/pdhweb/queue/kiosk','2026-08-24','2026-08-24 10:04:39'),(53,'::1','desktop','Chrome',NULL,'/pdhweb/public/donations','2026-08-24','2026-08-24 10:06:08'),(54,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:06:19'),(55,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:06:34'),(56,'::1','desktop','Other',NULL,'/pdhweb/','2026-08-24','2026-08-24 10:07:33'),(57,'::1','desktop','Other',NULL,'/pdhweb/news','2026-08-24','2026-08-24 10:07:33'),(58,'::1','desktop','Other',NULL,'/pdhweb/ita','2026-08-24','2026-08-24 10:07:33'),(59,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 10:07:33'),(60,'::1','desktop','Other',NULL,'/pdhweb/risk','2026-08-24','2026-08-24 10:07:33'),(61,'::1','desktop','Other',NULL,'/pdhweb/hrms','2026-08-24','2026-08-24 10:07:33'),(62,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:07:33'),(63,'::1','desktop','Other',NULL,'/pdhweb/donation','2026-08-24','2026-08-24 10:07:33'),(64,'::1','desktop','Other',NULL,'/pdhweb/doctors','2026-08-24','2026-08-24 10:07:33'),(65,'::1','desktop','Other',NULL,'/pdhweb/doctor','2026-08-24','2026-08-24 10:07:33'),(66,'::1','desktop','Other',NULL,'/pdhweb/clinics','2026-08-24','2026-08-24 10:07:33'),(67,'::1','desktop','Other',NULL,'/pdhweb/clinic','2026-08-24','2026-08-24 10:07:33'),(68,'::1','desktop','Other',NULL,'/pdhweb/services','2026-08-24','2026-08-24 10:07:33'),(69,'::1','desktop','Other',NULL,'/pdhweb/service','2026-08-24','2026-08-24 10:07:33'),(70,'::1','desktop','Other',NULL,'/pdhweb/department','2026-08-24','2026-08-24 10:07:33'),(71,'::1','desktop','Other',NULL,'/pdhweb/departments','2026-08-24','2026-08-24 10:07:33'),(72,'::1','desktop','Other',NULL,'/pdhweb/procurement','2026-08-24','2026-08-24 10:07:33'),(73,'::1','desktop','Other',NULL,'/pdhweb/complaint','2026-08-24','2026-08-24 10:07:33'),(74,'::1','desktop','Other',NULL,'/pdhweb/appointment','2026-08-24','2026-08-24 10:07:33'),(75,'::1','desktop','Other',NULL,'/pdhweb/queue','2026-08-24','2026-08-24 10:07:33'),(76,'::1','desktop','Other',NULL,'/pdhweb/queue/kiosk','2026-08-24','2026-08-24 10:07:33'),(77,'::1','desktop','Other',NULL,'/pdhweb/page/about','2026-08-24','2026-08-24 10:07:33'),(78,'::1','desktop','Other',NULL,'/pdhweb/page/executives','2026-08-24','2026-08-24 10:07:33'),(79,'::1','desktop','Other',NULL,'/pdhweb/page/vision','2026-08-24','2026-08-24 10:07:33'),(80,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:08:33'),(81,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:09:08'),(82,'::1','desktop','Other',NULL,'/pdhweb/','2026-08-24','2026-08-24 10:10:13'),(83,'::1','desktop','Other',NULL,'/pdhweb/news','2026-08-24','2026-08-24 10:10:13'),(84,'::1','desktop','Other',NULL,'/pdhweb/ita','2026-08-24','2026-08-24 10:10:13'),(85,'::1','desktop','Other',NULL,'/pdhweb/contact','2026-08-24','2026-08-24 10:10:13'),(86,'::1','desktop','Other',NULL,'/pdhweb/risk','2026-08-24','2026-08-24 10:10:13'),(87,'::1','desktop','Other',NULL,'/pdhweb/hrms','2026-08-24','2026-08-24 10:10:13'),(88,'::1','desktop','Other',NULL,'/pdhweb/donations','2026-08-24','2026-08-24 10:10:13'),(89,'::1','desktop','Other',NULL,'/pdhweb/donation','2026-08-24','2026-08-24 10:10:13'),(90,'::1','desktop','Other',NULL,'/pdhweb/doctors','2026-08-24','2026-08-24 10:10:13'),(91,'::1','desktop','Other',NULL,'/pdhweb/doctor','2026-08-24','2026-08-24 10:10:13'),(92,'::1','desktop','Other',NULL,'/pdhweb/clinics','2026-08-24','2026-08-24 10:10:13'),(93,'::1','desktop','Other',NULL,'/pdhweb/clinic','2026-08-24','2026-08-24 10:10:13'),(94,'::1','desktop','Other',NULL,'/pdhweb/services','2026-08-24','2026-08-24 10:10:13'),(95,'::1','desktop','Other',NULL,'/pdhweb/service','2026-08-24','2026-08-24 10:10:13'),(96,'::1','desktop','Other',NULL,'/pdhweb/department','2026-08-24','2026-08-24 10:10:13'),(97,'::1','desktop','Other',NULL,'/pdhweb/departments','2026-08-24','2026-08-24 10:10:13'),(98,'::1','desktop','Other',NULL,'/pdhweb/procurement','2026-08-24','2026-08-24 10:10:13'),(99,'::1','desktop','Other',NULL,'/pdhweb/complaint','2026-08-24','2026-08-24 10:10:13'),(100,'::1','desktop','Other',NULL,'/pdhweb/appointment','2026-08-24','2026-08-24 10:10:13'),(101,'::1','desktop','Other',NULL,'/pdhweb/queue','2026-08-24','2026-08-24 10:10:13'),(102,'::1','desktop','Other',NULL,'/pdhweb/queue/kiosk','2026-08-24','2026-08-24 10:10:13'),(103,'::1','desktop','Other',NULL,'/pdhweb/page/about','2026-08-24','2026-08-24 10:10:13'),(104,'::1','desktop','Other',NULL,'/pdhweb/page/executives','2026-08-24','2026-08-24 10:10:13'),(105,'::1','desktop','Other',NULL,'/pdhweb/page/vision','2026-08-24','2026-08-24 10:10:13');
/*!40000 ALTER TABLE `visit_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-24 17:10:29
