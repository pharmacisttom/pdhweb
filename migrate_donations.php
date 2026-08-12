<?php
require_once __DIR__ . '/app/Core/Database.php';
require_once __DIR__ . '/config/config.php';

try {
    $db = new \App\Core\Database();
    
    // Create donation_items table
    $db->query("CREATE TABLE IF NOT EXISTS `donation_items` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `description` text,
        `type` enum('money', 'equipment', 'general') NOT NULL DEFAULT 'general',
        `target_amount` decimal(12,2) DEFAULT NULL,
        `current_amount` decimal(12,2) DEFAULT 0.00,
        `target_quantity` int(11) DEFAULT NULL,
        `current_quantity` int(11) DEFAULT 0,
        `image` varchar(255) DEFAULT NULL,
        `status` enum('active', 'inactive', 'completed') DEFAULT 'active',
        `created_by` int(11) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `deleted_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    $db->execute();

    // Create donations table
    $db->query("CREATE TABLE IF NOT EXISTS `donations` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `donation_item_id` int(11) NOT NULL,
        `donor_name` varchar(255) NOT NULL,
        `donor_email` varchar(255) DEFAULT NULL,
        `donor_phone` varchar(50) DEFAULT NULL,
        `amount` decimal(12,2) DEFAULT NULL,
        `quantity` int(11) DEFAULT NULL,
        `payment_slip_image` varchar(255) DEFAULT NULL,
        `status` enum('pending', 'approved', 'rejected') DEFAULT 'pending',
        `admin_note` text DEFAULT NULL,
        `approved_by` int(11) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `donation_item_id` (`donation_item_id`),
        CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donation_item_id`) REFERENCES `donation_items` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    $db->execute();

    echo "Migration applied successfully. Tables created: donation_items, donations.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
