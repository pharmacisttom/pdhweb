<?php
    // Track visitor visit
    \App\Helpers\TrackerHelper::track();
    $visitStats = \App\Helpers\TrackerHelper::getStats();
    $themeColors = \App\Helpers\ThemeHelper::getDailyThemeColors();

    // Fetch site social settings
    $dbLayout = new \App\Core\Database();
    $dbLayout->query("SELECT setting_key, setting_value FROM settings");
    $rawSettings = $dbLayout->resultSet();
    $siteSettings = [];
    foreach ($rawSettings as $rs) {
        $siteSettings[$rs->setting_key] = $rs->setting_value;
    }
    $fbUrl = $siteSettings['facebook_page_url'] ?? 'https://www.facebook.com/pluakdaenghospital';
    $fbMessenger = $siteSettings['facebook_messenger_url'] ?? 'https://m.me/pluakdaenghospital';
    $lineOaId = $siteSettings['line_oa_id'] ?? '@pluakdaenghos';
    $lineUrl = $siteSettings['line_add_friend_url'] ?? 'https://page.line.me/pluakdaenghos';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>โรงพยาบาลปลวกแดง (Pluak Daeng Hospital)</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= URLROOT ?>/assets/images/pdh.ico">
    
    <!-- Open Graph for Social Media Sharing -->
    <meta property="og:url" content="<?= URLROOT . '/' . ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '', '/') ?>">
    <meta property="og:type" content="<?= isset($og_type) ? $og_type : 'website' ?>">
    <meta property="og:title" content="<?= isset($page_title) ? $page_title . ' - ' : '' ?>โรงพยาบาลปลวกแดง">
    <meta property="og:description" content="<?= isset($og_description) ? $og_description : 'โรงพยาบาลปลวกแดง - ดูแลด้วยมาตรฐาน ใส่ใจประชาชน' ?>">
    <meta property="og:image" content="<?= isset($og_image) ? $og_image : URLROOT . '/assets/images/pdh.jpg' ?>">
    
    <!-- Google Fonts: Prompt & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom Modern CSS with Cache Buster -->
    <link rel="stylesheet" href="<?= URLROOT ?>/assets/css/style.css?v=<?= time() ?>">
    
    <style>
        :root {
            --primary-color: #0b5e96;
            --secondary-color: #2f9ed8;
        }
    </style>
</head>
<body>

    <!-- Top Notice & Emergency Bar -->
    <div class="top-notice-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span class="d-flex align-items-center gap-1"><i class="bi bi-clock-fill text-warning"></i> <span>ฉุกเฉิน 24 ชั่วโมง</span></span>
                <span class="d-flex align-items-center gap-1"><i class="bi bi-geo-alt-fill text-info"></i> <span>อ.ปลวกแดง จ.ระยอง</span></span>
                <!-- Active Device Detection Pill in Topbar -->
                <span class="device-indicator-pill" id="topDeviceBadge" title="อุปกรณ์ที่ท่านกำลังใช้งาน">
                    <i class="bi bi-display"></i> <span id="topDeviceText">ตรวจจับอุปกรณ์...</span>
                </span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= htmlspecialchars($fbUrl) ?>" target="_blank" class="text-white-50 text-decoration-none small d-flex align-items-center gap-1 hover-white" title="Facebook Page">
                    <i class="bi bi-facebook text-info"></i> <span>Facebook</span>
                </a>
                <a href="<?= htmlspecialchars($lineUrl) ?>" target="_blank" class="text-white-50 text-decoration-none small d-flex align-items-center gap-1 hover-white" title="LINE Official Account">
                    <i class="bi bi-line text-success"></i> <span>LINE OA (<?= htmlspecialchars($lineOaId) ?>)</span>
                </a>
                <span class="text-white-50 small ms-2 ps-2 border-start border-secondary">
                    <i class="bi bi-eye-fill text-primary me-1"></i> ผู้เข้าชมวันนี้: <strong class="text-white"><?= number_format($visitStats['today']) ?></strong>
                </span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky-top">
        <nav class="navbar navbar-expand-xl main-navbar">
            <div class="container">
                <!-- Hospital Brand Logo & Title -->
                <a class="navbar-brand d-flex align-items-center gap-3 py-1 text-decoration-none" href="<?= URLROOT ?>">
                    <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="hospital-logo" width="48" height="48" onerror="this.src='https://placehold.co/48x48?text=PDH'">
                    <div class="brand-text-block">
                        <span class="brand-title">โรงพยาบาลปลวกแดง</span>
                        <span class="brand-subtitle">PLUAK DAENG HOSPITAL</span>
                    </div>
                </a>
                
                <button class="navbar-toggler border-0 shadow-none p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-1 text-dark"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto mb-2 mb-xl-0 align-items-xl-center gap-1">
                        <li class="nav-item">
                            <a class="nav-link <?= (empty($_GET['url']) || $_GET['url'] == 'home') ? 'active' : '' ?>" href="<?= URLROOT ?>">
                                <i class="bi bi-house-door-fill me-1"></i> หน้าแรก
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= (isset($_GET['url']) && in_array($_GET['url'], ['doctors', 'clinics', 'services'])) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                บริการทางการแพทย์
                            </a>
                            <ul class="dropdown-menu dropdown-menu-modern shadow-lg border-0 rounded-4 p-2 mt-2">
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/appointment"><i class="bi bi-calendar-check-fill me-2 text-warning"></i> จองคิวนัดหมาย (ปฏิทิน)</a></li>
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/doctors"><i class="bi bi-person-badge me-2 text-primary"></i> ทำเนียบแพทย์</a></li>
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/clinics"><i class="bi bi-hospital me-2 text-primary"></i> คลินิกเฉพาะโรค & ตารางตรวจ</a></li>
                                <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/services"><i class="bi bi-card-checklist me-2 text-primary"></i> บริการผู้ป่วยนอก/ใน</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'news')) ? 'active' : '' ?>" href="<?= URLROOT ?>/news">
                                ข่าวสาร
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'queue')) ? 'active' : '' ?>" href="<?= URLROOT ?>/queue">
                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 me-1"><i class="bi bi-broadcast"></i></span> ระบบคิว
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'donation')) ? 'active' : '' ?>" href="<?= URLROOT ?>/donations">
                                <i class="bi bi-heart-fill text-danger me-1"></i> ร่วมบริจาค
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'ita')) ? 'active' : '' ?>" href="<?= URLROOT ?>/ita">
                                <i class="bi bi-shield-check me-1"></i> ITA / MOIT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'complaint')) ? 'active' : '' ?>" href="<?= URLROOT ?>/complaint">
                                ร้องเรียน/ข้อเสนอแนะ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (isset($_GET['url']) && str_starts_with($_GET['url'], 'contact')) ? 'active' : '' ?>" href="<?= URLROOT ?>/contact">
                                ติดต่อเรา
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center ms-xl-3 mt-3 mt-xl-0">
                        <a href="tel:1669" class="btn btn-emergency-hotline rounded-pill px-4 py-2 text-white fw-bold d-inline-flex align-items-center gap-2 text-decoration-none shadow-sm">
                            <i class="bi bi-telephone-outbound-fill fs-6"></i>
                            <span>สายด่วน 1669</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Body -->
    <main class="main-content-wrapper">
        <?php require APPROOT . '/app/Views/' . $view . '.php'; ?>
    </main>

    <!-- Floating Social Contacts (FB Messenger & LINE OA) -->
    <div class="floating-social-widget">
        <!-- LINE OA Button -->
        <a href="<?= htmlspecialchars($lineUrl) ?>" target="_blank" class="social-btn-line" title="คุยกับเราผ่าน LINE OA">
            <span class="social-badge-label">แอดไลน์ <?= htmlspecialchars($lineOaId) ?></span>
            <i class="bi bi-line fs-4"></i>
        </a>
        <!-- Facebook Messenger Button -->
        <a href="<?= htmlspecialchars($fbMessenger) ?>" target="_blank" class="social-btn-facebook" title="ส่งข้อความ Facebook Messenger">
            <span class="social-badge-label">ทักแชท Facebook</span>
            <i class="bi bi-messenger fs-4"></i>
        </a>
    </div>

    <!-- Live Responsive Device Indicator (Floating Pill on Bottom Left) -->
    <div class="floating-device-indicator" id="floatingDevicePill" title="โหมดการแสดงผลปัจจุบัน">
        <span class="device-icon-bubble" id="floatingDeviceIcon"><i class="bi bi-laptop"></i></span>
        <div>
            <span class="device-text-title" id="floatingDeviceName">Desktop</span>
            <span class="device-text-sub" id="floatingScreenRes">1920 × 1080</span>
        </div>
    </div>

    <!-- Modern Medical Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-3 border border-2 border-white" width="48" height="48" style="object-fit: cover;">
                        <div>
                            <h5 class="mb-0 fw-bold text-white">โรงพยาบาลปลวกแดง</h5>
                            <small class="text-white-50">Pluak Daeng Hospital</small>
                        </div>
                    </div>
                    <p class="text-white-50 small mb-3">
                        โรงพยาบาลปลวกแดง มุ่งมั่นให้บริการทางการแพทย์ที่ได้มาตรฐาน ด้วยความปลอดภัย ใส่ใจ และพัฒนาคุณภาพอย่างต่อเนื่องเพื่อสุขภาวะของชุมชน
                    </p>
                    <div class="d-flex gap-2">
                        <a href="<?= htmlspecialchars($fbUrl) ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="<?= htmlspecialchars($lineUrl) ?>" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;" title="LINE OA"><i class="bi bi-line"></i></a>
                        <a href="mailto:pluakdaenghospital@gmail.com" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;" title="Email"><i class="bi bi-envelope"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3">บริการผู้ป่วย</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= URLROOT ?>/doctors" class="footer-link">ค้นหาแพทย์</a></li>
                        <li><a href="<?= URLROOT ?>/clinics" class="footer-link">ตารางออกตรวจ</a></li>
                        <li><a href="<?= URLROOT ?>/queue" class="footer-link">ระบบคิวตรวจ</a></li>
                        <li><a href="<?= URLROOT ?>/donations" class="footer-link">ร่วมบริจาค</a></li>
                        <li><a href="<?= URLROOT ?>/complaint" class="footer-link">รับเรื่องร้องเรียน</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-white mb-3">เกี่ยวกับองค์กร</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= URLROOT ?>/page/about" class="footer-link">ประวัติโรงพยาบาล</a></li>
                        <li><a href="<?= URLROOT ?>/page/executives" class="footer-link">คณะผู้บริหาร</a></li>
                        <li><a href="<?= URLROOT ?>/department" class="footer-link">โครงสร้างกลุ่มงาน</a></li>
                        <li><a href="<?= URLROOT ?>/procurement" class="footer-link">จัดซื้อจัดจ้าง</a></li>
                        <li><a href="<?= URLROOT ?>/ita" class="footer-link">การประเมิน ITA/MOIT</a></li>
                        <li><a href="<?= URLROOT ?>/risk" class="footer-link"><i class="bi bi-shield-exclamation text-warning me-1"></i> ระบบความเสี่ยง (HRMS)</a></li>
                        <li><a href="<?= URLROOT ?>/contact" class="footer-link">ติดต่อเรา & เบอร์ภายใน</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold text-white mb-3">ติดต่อโรงพยาบาล</h6>
                    <ul class="list-unstyled text-white-50 small">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill text-danger me-2"></i><?= htmlspecialchars($siteSettings['address'] ?? '111 ม.1 ต.ปลวกแดง อ.ปลวกแดง จ.ระยอง 21140') ?></li>
                        <li class="mb-2"><i class="bi bi-telephone-fill text-success me-2"></i>โทรศัพท์: <?= htmlspecialchars($siteSettings['telephone'] ?? '038-659-188') ?></li>
                        <li class="mb-2"><i class="bi bi-ambulance text-warning me-2"></i>แจ้งเหตุฉุกเฉิน: 1669 (ตลอด 24 ชม.)</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill text-info me-2"></i>อีเมล: <?= htmlspecialchars($siteSettings['email'] ?? 'pluakdaenghospital@gmail.com') ?></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Stats Counter Bar -->
            <div class="visitor-counter-bar">
                <div class="row align-items-center text-center text-md-start">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                            <i class="bi bi-bar-chart-fill text-primary fs-5"></i>
                            <span class="fw-bold text-white">สถิติการเข้าชมเว็บไซต์</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2 gap-md-3">
                            <div class="stat-badge-chip">
                                <span class="label">วันนี้:</span>
                                <span class="val"><?= number_format($visitStats['today']) ?></span>
                            </div>
                            <div class="stat-badge-chip">
                                <span class="label">เดือนนี้:</span>
                                <span class="val"><?= number_format($visitStats['month'] ?? $visitStats['this_month'] ?? 0) ?></span>
                            </div>
                            <div class="stat-badge-chip">
                                <span class="label">รวมทั้งหมด:</span>
                                <span class="val highlight"><?= number_format($visitStats['total']) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="small text-white-50">
                    &copy; <?= date('Y') ?> โรงพยาบาลปลวกแดง (Pluak Daeng Hospital). สงวนลิขสิทธิ์ทั้งหมด
                </div>
                <div class="small">
                    <a href="<?= URLROOT ?>/auth/login" class="text-white-50 text-decoration-none me-3"><i class="bi bi-shield-lock-fill me-1"></i> เข้าสู่ระบบผู้ดูแล</a>
                    <a href="<?= URLROOT ?>/privacy" class="text-white-50 text-decoration-none">นโยบายความเป็นส่วนตัว (PDPA)</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Real-time Responsive Device Detector Script -->
    <script>
    function updateDeviceDetection() {
        const width = window.innerWidth;
        const height = window.innerHeight;
        let deviceType = 'Desktop (คอมพิวเตอร์)';
        let deviceIcon = 'bi-laptop';
        let shortName = 'Desktop';

        if (width < 768) {
            deviceType = 'Mobile (มือถือ)';
            deviceIcon = 'bi-phone';
            shortName = 'Mobile';
        } else if (width < 1024) {
            deviceType = 'Tablet (แท็บเล็ต)';
            deviceIcon = 'bi-tablet';
            shortName = 'Tablet';
        }

        // Update Topbar Badge
        const topText = document.getElementById('topDeviceText');
        if (topText) {
            topText.innerText = deviceType + ' (' + width + 'px)';
        }

        // Update Floating Indicator
        const floatingName = document.getElementById('floatingDeviceName');
        const floatingIcon = document.getElementById('floatingDeviceIcon');
        const floatingRes = document.getElementById('floatingScreenRes');
        if (floatingName) floatingName.innerText = shortName;
        if (floatingIcon) floatingIcon.innerHTML = '<i class="bi ' + deviceIcon + '"></i>';
        if (floatingRes) floatingRes.innerText = width + ' × ' + height;
    }

    window.addEventListener('resize', updateDeviceDetection);
    document.addEventListener('DOMContentLoaded', updateDeviceDetection);
    </script>
</body>
</html>
