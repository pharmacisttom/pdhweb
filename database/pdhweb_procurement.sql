-- Procurement Table (จัดซื้อจัดจ้าง) รองรับ ITA/MOIT

CREATE TABLE IF NOT EXISTS `procurements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `budget_year` INT(4) NOT NULL, -- ปีงบประมาณ เช่น 2567
  `project_budget` DECIMAL(15,2) NULL, -- วงเงินงบประมาณ
  `method` VARCHAR(100) NULL, -- วิธีจัดซื้อ เช่น เฉพาะเจาะจง, e-bidding, คัดเลือก
  `document_url` VARCHAR(255) NULL, -- URL หรือ Path ไฟล์เอกสารแนบ
  `category` ENUM('แผนการจัดซื้อจัดจ้างประจำปี', 'ประกาศราคากลาง/TOR', 'ประกาศผู้ชนะการเสนอราคา', 'สรุปผลการจัดซื้อจัดจ้างรายเดือน (สขร.1)', 'รายงานผลสรุปการจัดซื้อจัดจ้างประจำปี', 'ประกาศจัดซื้อจัดจ้างอื่นๆ') DEFAULT 'ประกาศจัดซื้อจัดจ้างอื่นๆ',
  `status` ENUM('active', 'archived') DEFAULT 'active',
  `published_at` DATE NOT NULL,
  `created_by` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
