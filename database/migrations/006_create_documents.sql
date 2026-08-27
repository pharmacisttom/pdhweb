CREATE TABLE IF NOT EXISTS documents (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    document_number VARCHAR(100) NULL,
    category ENUM('download', 'official_order') NOT NULL DEFAULT 'download',
    file_name VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    file_size INT UNSIGNED NOT NULL DEFAULT 0,
    issued_date DATE NULL,
    status ENUM('draft', 'published') NOT NULL DEFAULT 'published',
    created_by INT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_documents_public (category, status, issued_date),
    INDEX idx_documents_deleted (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
