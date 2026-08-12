ALTER TABLE `donation_items` 
ADD COLUMN `created_by` int(11) NULL AFTER `status`,
ADD COLUMN `deleted_at` timestamp NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `donations` 
ADD COLUMN `approved_by` int(11) NULL AFTER `status`;
