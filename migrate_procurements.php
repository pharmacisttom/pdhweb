<?php
// Script to apply migration to the database since the user might have already run the previous SQL
require_once __DIR__ . '/app/Core/Database.php';
require_once __DIR__ . '/app/config/config.php';

try {
    $db = new \App\Core\Database();
    
    // Check if columns exist
    $db->query("SHOW COLUMNS FROM `procurements` LIKE 'budget_year'");
    if(empty($db->resultSet())) {
        $db->query("ALTER TABLE `procurements` ADD `budget_year` INT(4) NOT NULL DEFAULT 2567 AFTER `title`");
        $db->execute();
    }
    
    $db->query("SHOW COLUMNS FROM `procurements` LIKE 'method'");
    if(empty($db->resultSet())) {
        $db->query("ALTER TABLE `procurements` ADD `method` VARCHAR(100) NULL AFTER `project_budget`");
        $db->execute();
    }

    $db->query("ALTER TABLE `procurements` MODIFY `category` ENUM('แผนการจัดซื้อจัดจ้างประจำปี', 'ประกาศราคากลาง/TOR', 'ประกาศผู้ชนะการเสนอราคา', 'สรุปผลการจัดซื้อจัดจ้างรายเดือน (สขร.1)', 'รายงานผลสรุปการจัดซื้อจัดจ้างประจำปี', 'ประกาศจัดซื้อจัดจ้างอื่นๆ') DEFAULT 'ประกาศจัดซื้อจัดจ้างอื่นๆ'");
    $db->execute();

    echo "Migration applied successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
