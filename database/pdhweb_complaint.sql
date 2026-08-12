-- Complaints Table (รับเรื่องร้องเรียน/เสนอแนะ)

CREATE TABLE IF NOT EXISTS `complaints` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tracking_code` VARCHAR(50) NOT NULL UNIQUE, -- สำหรับผู้ร้องเรียนเช็คสถานะ
  `fullname` VARCHAR(255) NOT NULL,
  `contact_info` VARCHAR(255) NOT NULL, -- เบอร์โทร หรือ Email
  `topic` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `is_anonymous` TINYINT(1) DEFAULT 0, -- 1 = ไม่ประสงค์ออกนาม (ข้อมูลชื่อจะถูกปกปิดในระบบทั่วไป)
  `status` ENUM('pending', 'investigating', 'resolved', 'rejected') DEFAULT 'pending',
  `admin_response` TEXT NULL, -- คำตอบจากแอดมิน
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
