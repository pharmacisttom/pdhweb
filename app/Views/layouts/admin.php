<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Admin | <?= SITENAME ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= URLROOT ?>/assets/images/pdh.ico">
    
    <!-- Google Fonts: Noto Sans Thai -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= URLROOT ?>/assets/css/admin.css">
    
    <?php
        $themeColors = \App\Helpers\ThemeHelper::getDailyThemeColors();
    ?>
    <style>
        :root {
            --primary-color: <?= $themeColors['primary'] ?>;
            --secondary-color: <?= $themeColors['secondary'] ?>;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-circle mb-3 border border-3 border-white shadow-sm" width="70" height="70" style="object-fit: cover;">
                <h4>PDH Admin</h4>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?= URLROOT ?>/admin/dashboard"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/banner"><i class="bi bi-images me-2"></i> ป้ายแบนเนอร์</a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/news"><i class="bi bi-newspaper me-2"></i> ข่าวสาร</a>
                </li>
                <li>
                    <a href="#medicalSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-heart-pulse me-2"></i> บริการทางการแพทย์
                    </a>
                    <ul class="collapse list-unstyled" id="medicalSubmenu">
                        <li>
                            <a href="<?= URLROOT ?>/admin/department" class="ps-5"><i class="bi bi-building me-2"></i> กลุ่มงาน/ฝ่าย</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>/admin/service" class="ps-5"><i class="bi bi-card-list me-2"></i> บริการทั้งหมด</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>/admin/clinic" class="ps-5"><i class="bi bi-hospital me-2"></i> คลินิกเฉพาะโรค</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>/admin/doctor" class="ps-5"><i class="bi bi-person-badge me-2"></i> ทำเนียบแพทย์</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#donationSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-box2-heart me-2"></i> ระบบบริจาค
                    </a>
                    <ul class="collapse list-unstyled" id="donationSubmenu">
                        <li>
                            <a href="<?= URLROOT ?>/admin/donationitem" class="ps-5"><i class="bi bi-list-check me-2"></i> จัดการรายการรับบริจาค</a>
                        </li>
                        <li>
                            <a href="<?= URLROOT ?>/admin/donation" class="ps-5"><i class="bi bi-clipboard2-check me-2"></i> ตรวจสอบการบริจาค</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/settings"><i class="bi bi-gear me-2"></i> ตั้งค่าระบบ</a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/auth/logout" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="topbar">
                <div class="d-flex align-items-center">
                    <button type="button" id="sidebarCollapse" class="btn btn-light me-3">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h5 class="mb-0 text-muted fw-bold d-none d-sm-block">PDH Enterprise</h5>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-light position-relative me-3">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </button>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none text-dark" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4 me-2" style="color: var(--primary-color);"></i>
                            <span class="fw-semibold d-none d-md-inline"><?= $_SESSION['user_firstname'] ?? 'Admin' ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/admin/settings"><i class="bi bi-gear me-2"></i> ตั้งค่า</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= URLROOT ?>/auth/logout"><i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main>
                <?php require_once '../app/Views/' . $view . '.php'; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>
