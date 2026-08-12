<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?><?= SITENAME ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= URLROOT ?>/assets/images/pdh.ico">
    
    <!-- Google Fonts: Noto Sans Thai -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= URLROOT ?>/assets/css/style.css">
    
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

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= URLROOT ?>">
                <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" width="45" height="45" class="me-2 rounded-circle" style="object-fit: cover;" onerror="this.src='https://via.placeholder.com/45x45.png?text=Logo'">
                <div>
                    <h5 class="mb-0 fw-bold text-primary">โรงพยาบาลปลวกแดง</h5>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Pluak Daeng Hospital</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-medium">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= URLROOT ?>">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/about">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            บริการทางการแพทย์
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/department">กลุ่มงานและฝ่าย</a></li>
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/service">บริการทั้งหมด</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/clinic">คลินิกและตารางแพทย์</a></li>
                            <li><a class="dropdown-item" href="<?= URLROOT ?>/doctor">ทำเนียบแพทย์</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/news">ข่าวสาร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/donation">ร่วมบริจาค</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>/contact">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0 d-flex align-items-center">
                        <a class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 fw-bold w-100" href="<?= URLROOT ?>/auth/login">
                            <i class="bi bi-person-badge me-1"></i> สำหรับเจ้าหน้าที่
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php require_once '../app/Views/' . $view . '.php'; ?>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">โรงพยาบาลปลวกแดง</h5>
                    <p class="text-muted"><i class="bi bi-geo-alt-fill me-2"></i>อ.ปลวกแดง จ.ระยอง</p>
                    <p class="text-muted"><i class="bi bi-telephone-fill me-2"></i>038-000000</p>
                    <p class="text-muted"><i class="bi bi-envelope-fill me-2"></i>info@pluakdaenghospital.moph.go.th</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">ลิงก์ด่วน</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><a href="<?= URLROOT ?>" class="text-decoration-none text-muted">หน้าแรก</a></li>
                        <li class="mb-2"><a href="<?= URLROOT ?>/service" class="text-decoration-none text-muted">บริการทางการแพทย์</a></li>
                        <li class="mb-2"><a href="<?= URLROOT ?>/donation" class="text-decoration-none text-muted">ร่วมบริจาค</a></li>
                        <li class="mb-2"><a href="<?= URLROOT ?>/ita" class="text-decoration-none text-muted">ITA / MOIT</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">ติดตามเรา</h5>
                    <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="bi bi-facebook"></i> Facebook</a>
                    <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-line"></i> LINE</a>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted small">
                &copy; <?= date('Y') ?> โรงพยาบาลปลวกแดง. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
