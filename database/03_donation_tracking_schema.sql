-- ==========================================================
-- Migration: Add tracking_code to donations table
-- ==========================================================

ALTER TABLE `donations` 
ADD COLUMN IF NOT EXISTS `tracking_code` VARCHAR(50) NULL UNIQUE AFTER `donation_item_id`;

-- Update existing records with default tracking code format
UPDATE `donations` 
SET `tracking_code` = CONCAT('PDH-DON-', DATE_FORMAT(COALESCE(created_at, NOW()), '%Y%m%d'), '-', LPAD(HEX(id * 137 + 100), 4, '0'))
WHERE `tracking_code` IS NULL OR `tracking_code` = '';
