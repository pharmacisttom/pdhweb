USE pdhweb;

CREATE TABLE `post_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `short_description` VARCHAR(500) NULL,
  `content` LONGTEXT NOT NULL,
  `cover_image` VARCHAR(255) NULL,
  `category_id` INT NULL,
  `user_id` INT NULL,
  `status` ENUM('draft', 'review', 'approved', 'published', 'archived') DEFAULT 'draft',
  `view_count` INT DEFAULT 0,
  `published_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL,
  FOREIGN KEY (`category_id`) REFERENCES `post_categories`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial Seed Data
INSERT INTO `post_categories` (`name`, `slug`, `description`) VALUES 
('ข่าวประชาสัมพันธ์', 'public-relations', 'ข่าวสารทั่วไปสำหรับประชาชน'),
('ประกาศรับสมัครงาน', 'job-openings', 'ข่าวรับสมัครบุคลากร'),
('ข่าวจัดซื้อจัดจ้าง', 'procurement', 'ประกาศจัดซื้อจัดจ้างของโรงพยาบาล');
