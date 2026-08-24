<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escape($title ?? 'PDH Web Portal') ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --pdh-primary: #10b981; /* Emerald */
            --pdh-secondary: #14b8a6; /* Teal */
            --pdh-accent: #0ea5e9; /* Cyan/Blue */
            --pdh-bg: #f8fafc;
            --pdh-card: #ffffff;
            --pdh-text: #0f172a;
            --pdh-muted: #64748b;
        }
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: var(--pdh-bg);
            color: var(--pdh-text);
        }
        .navbar-pdh {
            background-color: var(--pdh-card);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--pdh-primary) !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-pdh sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= url('/') ?>">
                <i data-lucide="activity" class="me-2 text-success"></i>
                โรงพยาบาลปลวกแดง
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= url('/') ?>">หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">บริการ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ข่าวสาร</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ติดต่อเรา</a></li>
                    <li class="nav-item"><a class="btn btn-outline-success ms-2" href="<?= url('/admin/login') ?>">สำหรับเจ้าหน้าที่</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php
            $viewPath = __DIR__ . '/../' . str_replace('.', '/', $view) . '.php';
            if (file_exists($viewPath)) {
                require $viewPath;
            } else {
                echo "<div class='container mt-5'>View contents not found.</div>";
            }
        ?>
    </main>

    <footer class="bg-white py-4 mt-5 border-top">
        <div class="container text-center text-muted">
            <p class="mb-0">&copy; <?= date('Y') ?> โรงพยาบาลปลวกแดง (Pluak Daeng Hospital). All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
