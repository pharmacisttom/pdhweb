CREATE TABLE IF NOT EXISTS csr_projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    summary TEXT NOT NULL,
    contribution VARCHAR(255) NULL,
    project_date DATE NULL,
    image VARCHAR(255) NULL,
    website VARCHAR(500) NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_csr_projects_public (is_published, sort_order, project_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
