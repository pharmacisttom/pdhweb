<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Admin | <?= SITENAME ?></title>
    
    <!-- Google Fonts: Noto Sans Thai -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Noto Sans Thai', sans-serif; background-color: #F8FAFC; color: #0F172A; }
        .sidebar { min-height: 100vh; background-color: #ffffff; border-right: 1px solid #e2e8f0; }
        .sidebar-link { color: #64748B; text-decoration: none; padding: 10px 15px; display: block; border-radius: 8px; margin-bottom: 5px; }
        .sidebar-link:hover, .sidebar-link.active { background-color: #f1f5f9; color: #0ea5e9; font-weight: 500; }
        .top-navbar { background-color: #ffffff; border-bottom: 1px solid #e2e8f0; }
        .main-content { padding: 20px; }
        .card { border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <div class="d-flex align-items-center mb-4 px-2">
                <i class="bi bi-hospital fs-3 text-primary me-2"></i>
                <h5 class="mb-0 fw-bold">PDH Admin</h5>
            </div>
            <ul class="list-unstyled">
                <li><a href="<?= URLROOT ?>/admin/dashboard" class="sidebar-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li><h6 class="text-muted mt-3 mb-2 px-2 text-uppercase" style="font-size: 0.75rem;">Content</h6></li>
                <li><a href="<?= URLROOT ?>/admin/news" class="sidebar-link"><i class="bi bi-newspaper me-2"></i> News</a></li>
                <li><a href="<?= URLROOT ?>/admin/pages" class="sidebar-link"><i class="bi bi-file-earmark-text me-2"></i> Pages</a></li>
                <li><a href="<?= URLROOT ?>/admin/media" class="sidebar-link"><i class="bi bi-images me-2"></i> Media</a></li>
                <li><h6 class="text-muted mt-3 mb-2 px-2 text-uppercase" style="font-size: 0.75rem;">Medical</h6></li>
                <li><a href="<?= URLROOT ?>/admin/departments" class="sidebar-link"><i class="bi bi-diagram-3 me-2"></i> Departments</a></li>
                <li><a href="<?= URLROOT ?>/admin/services" class="sidebar-link"><i class="bi bi-heart-pulse me-2"></i> Services</a></li>
                <li><a href="<?= URLROOT ?>/admin/doctors" class="sidebar-link"><i class="bi bi-person-badge me-2"></i> Doctors</a></li>
                <li><a href="<?= URLROOT ?>/admin/clinics" class="sidebar-link"><i class="bi bi-calendar2-plus me-2"></i> Clinics</a></li>
                <li><h6 class="text-muted mt-3 mb-2 px-2 text-uppercase" style="font-size: 0.75rem;">System</h6></li>
                <li><a href="<?= URLROOT ?>/admin/users" class="sidebar-link"><i class="bi bi-people me-2"></i> Users</a></li>
                <li><a href="<?= URLROOT ?>/admin/settings" class="sidebar-link"><i class="bi bi-gear me-2"></i> Settings</a></li>
                <li><a href="<?= URLROOT ?>/auth/logout" class="sidebar-link text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Wrapper -->
        <div class="flex-grow-1 d-flex flex-column" style="min-width: 0;">
            <!-- Top Navbar -->
            <nav class="top-navbar p-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold"><?= isset($page_title) ? $page_title : 'Dashboard' ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <a href="<?= URLROOT ?>" target="_blank" class="btn btn-sm btn-outline-secondary me-3"><i class="bi bi-box-arrow-up-right me-1"></i> View Site</a>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 me-2 text-primary"></i> 
                            <?= $_SESSION['user_firstname'] ?? 'Admin' ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/admin/profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= URLROOT ?>/auth/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Content -->
            <div class="main-content">
                <?php require_once '../app/Views/' . $view . '.php'; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
