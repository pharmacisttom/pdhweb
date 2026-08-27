CREATE TABLE IF NOT EXISTS schema_migrations (
    filename VARCHAR(255) NOT NULL PRIMARY KEY,
    applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS permissions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) DEFAULT NULL,
    module VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS role_permissions (
    role_id INT NOT NULL,
    permission_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    KEY role_permissions_permission_id (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO permissions (name, description, module) VALUES
('dashboard.view', 'View dashboard', 'dashboard'),
('news.view', 'View news', 'news'), ('news.manage', 'Manage news', 'news'),
('banners.view', 'View banners', 'banners'), ('banners.manage', 'Manage banners', 'banners'),
('departments.view', 'View departments', 'departments'), ('departments.manage', 'Manage departments', 'departments'),
('services.view', 'View services', 'services'), ('services.manage', 'Manage services', 'services'),
('clinics.view', 'View clinics', 'clinics'), ('clinics.manage', 'Manage clinics', 'clinics'),
('doctors.view', 'View doctors', 'doctors'), ('doctors.manage', 'Manage doctors', 'doctors'),
('donations.view', 'View donations', 'donations'), ('donations.manage', 'Manage donations', 'donations'),
('procurements.view', 'View procurements', 'procurements'), ('procurements.manage', 'Manage procurements', 'procurements'),
('complaints.view', 'View complaints', 'complaints'), ('complaints.manage', 'Manage complaints', 'complaints'),
('appointments.view', 'View appointments', 'appointments'), ('appointments.manage', 'Manage appointments', 'appointments'),
('queues.view', 'View queues', 'queues'), ('queues.manage', 'Manage queues', 'queues'),
('pages.view', 'View pages', 'pages'), ('pages.manage', 'Manage pages', 'pages'),
('settings.view', 'View settings', 'settings'), ('settings.manage', 'Manage settings', 'settings'),
('audit_logs.view', 'View audit logs', 'audit_logs'), ('audit_logs.manage', 'Manage audit logs', 'audit_logs'),
('users.view', 'View users', 'users'), ('users.manage', 'Manage users', 'users');

INSERT IGNORE INTO role_permissions (role_id, permission_id)
SELECT 1, id FROM permissions;
