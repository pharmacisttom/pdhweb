CREATE TABLE IF NOT EXISTS `donation_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` enum('general', 'money', 'equipment') DEFAULT 'general',
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `target_amount` decimal(10,2) DEFAULT '0.00',
  `current_amount` decimal(10,2) DEFAULT '0.00',
  `target_quantity` int(11) DEFAULT '0',
  `current_quantity` int(11) DEFAULT '0',
  `status` enum('active', 'inactive', 'completed') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donation_item_id` int(11) NOT NULL,
  `donor_name` varchar(100) NOT NULL,
  `donor_phone` varchar(20) DEFAULT NULL,
  `donor_email` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `payment_slip_image` varchar(255) DEFAULT NULL,
  `status` enum('pending', 'approved', 'rejected') DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`donation_item_id`) REFERENCES `donation_items`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
