<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>PDH Enterprise Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= URLROOT ?>/assets/images/pdh.ico">
    
    <!-- Google Fonts: Prompt & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- TinyMCE 6 Rich Text Classic Editor -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    
    <!-- Admin Modern CSS -->
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
        <!-- Modern Sleek Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="rounded-3 me-3 border border-2 border-primary" width="44" height="44" style="object-fit: cover;" onerror="this.src='https://placehold.co/44x44?text=PDH'">
                <div>
                    <h4>PDH Admin</h4>
                    <small class="text-muted" style="font-size: 0.72rem;">Hospital Enterprise</small>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?= URLROOT ?>/admin/dashboard"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/banner"><i class="bi bi-images"></i> <span>ป้ายแบนเนอร์</span></a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/news"><i class="bi bi-newspaper"></i> <span>ข่าวสาร & ITA</span></a>
                </li>
                <li>
                    <a href="#medicalSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-heart-pulse"></i> <span>บริการทางการแพทย์</span>
                    </a>
                    <ul class="collapse list-unstyled" id="medicalSubmenu">
                        <li><a href="<?= URLROOT ?>/admin/department"><i class="bi bi-building"></i> กลุ่มงาน/ฝ่าย</a></li>
                        <li><a href="<?= URLROOT ?>/admin/service"><i class="bi bi-card-list"></i> บริการผู้ป่วย</a></li>
                        <li><a href="<?= URLROOT ?>/admin/clinic"><i class="bi bi-hospital"></i> คลินิกเฉพาะโรค</a></li>
                        <li><a href="<?= URLROOT ?>/admin/doctor"><i class="bi bi-person-badge"></i> ทำเนียบแพทย์</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#queueSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-clock-history"></i> <span>ระบบคิว & นัดหมาย</span>
                    </a>
                    <ul class="collapse list-unstyled" id="queueSubmenu">
                        <li><a href="<?= URLROOT ?>/admin/queue"><i class="bi bi-display"></i> จัดการเรียกคิว</a></li>
                        <li><a href="<?= URLROOT ?>/admin/appointments"><i class="bi bi-calendar-check"></i> คิวนัดหมาย & ปฏิทิน</a></li>
                        <li><a href="<?= URLROOT ?>/queue/room/1" target="_blank"><i class="bi bi-megaphone"></i> สถานีเรียกคิวห้องตรวจ</a></li>
                        <li><a href="<?= URLROOT ?>/queue/door/1" target="_blank"><i class="bi bi-tv"></i> จอติดหน้าห้องตรวจ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#donationSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="bi bi-box2-heart"></i> <span>ระบบบริจาค</span>
                    </a>
                    <ul class="collapse list-unstyled" id="donationSubmenu">
                        <li><a href="<?= URLROOT ?>/admin/donationitem"><i class="bi bi-list-check"></i> รายการรับบริจาค</a></li>
                        <li><a href="<?= URLROOT ?>/admin/donation"><i class="bi bi-clipboard2-check"></i> ตรวจสอบสลิป</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/complaint"><i class="bi bi-chat-square-dots"></i> <span>เรื่องร้องเรียน</span></a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/procurement"><i class="bi bi-file-earmark-text"></i> <span>จัดซื้อจัดจ้าง</span></a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/admin/settings"><i class="bi bi-gear"></i> <span>ตั้งค่าระบบ</span></a>
                </li>
                <li class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <a href="<?= URLROOT ?>" target="_blank" class="text-info"><i class="bi bi-box-arrow-up-right"></i> <span>ดูหน้าเว็บไซต์</span></a>
                </li>
                <li>
                    <a href="<?= URLROOT ?>/auth/logout" class="text-danger"><i class="bi bi-box-arrow-right"></i> <span>ออกจากระบบ</span></a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button type="button" id="sidebarCollapse" class="btn btn-light rounded-circle shadow-none">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h5 class="mb-0 text-dark fw-bold d-none d-sm-block">ระบบบริหารจัดการโรงพยาบาลปลวกแดง</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= URLROOT ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill d-none d-md-inline-flex align-items-center gap-1">
                        <i class="bi bi-globe"></i> หน้าเว็บหลัก
                    </a>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none text-dark gap-2 p-1 rounded-pill" id="userDropdown" data-bs-toggle="dropdown">
                            <div class="p-2 bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="d-none d-md-block text-start">
                                <span class="fw-bold d-block small"><?= $_SESSION['user_firstname'] ?? 'Admin' ?></span>
                                <small class="text-muted" style="font-size: 0.72rem;">Administrator</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2 mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item rounded-3 py-2" href="<?= URLROOT ?>/admin/settings"><i class="bi bi-gear me-2"></i> ตั้งค่า</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item rounded-3 py-2 text-danger" href="<?= URLROOT ?>/auth/logout"><i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="p-4">
                <?php require_once '../app/Views/' . $view . '.php'; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        // Initialize TinyMCE Classic Editor with Full Formatting Tools
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: 'textarea.tinymce-editor, textarea#content',
                height: 450,
                menubar: 'file edit view insert format tools table help',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons', 'directionality'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | ' +
                         'bold italic underline strikethrough forecolor backcolor | ' +
                         'alignleft aligncenter alignright alignjustify | ' +
                         'bullist numlist outdent indent | link image media table | ' +
                         'removeformat code fullscreen preview',
                content_style: 'body { font-family: Prompt, Arial, sans-serif; font-size: 16px; line-height: 1.7; color: #1e293b; }',
                font_family_formats: 'Prompt=Prompt,sans-serif; Plus Jakarta Sans=Plus Jakarta Sans,sans-serif; Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; Tahoma=tahoma,arial,helvetica,sans-serif; Times New Roman=times new roman,times;',
                fontsize_formats: '12px 14px 16px 18px 20px 24px 28px 32px 36px 48px',
                branding: false,
                promotion: false,
                language: 'th'
            });
        }
    </script>
</body>
</html>
