<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escape($title ?? 'Admin Login') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .login-header {
            background-color: #10b981;
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <i data-lucide="shield-check" style="width: 48px; height: 48px; margin-bottom: 1rem;"></i>
            <h4 class="mb-0">PDH Web Portal</h4>
            <small>ระบบบริหารจัดการเว็บไซต์</small>
        </div>
        <div class="card-body p-4">
            <!-- Flash messages handled by SweetAlert in footer -->

            <form action="<?= url('/admin/login') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label text-muted">ชื่อผู้ใช้งาน (Username)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i data-lucide="user" style="width:18px;"></i></span>
                        <input type="text" name="username" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted">รหัสผ่าน (Password)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i data-lucide="lock" style="width:18px;"></i></span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2 fw-bold">เข้าสู่ระบบ</button>
            </form>
            <div class="text-center mt-3">
                <a href="<?= url('/') ?>" class="text-decoration-none text-muted small"><i data-lucide="arrow-left" style="width:14px;"></i> กลับสู่หน้าหลัก</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        lucide.createIcons();
    </script>
    
    <?php if (isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'เข้าสู่ระบบไม่สำเร็จ',
            text: '<?= escape($_SESSION['error']) ?>',
            confirmButtonColor: '#10b981'
        });
    </script>
    <?php unset($_SESSION['error']); endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: '<?= escape($_SESSION['success']) ?>',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    <?php unset($_SESSION['success']); endif; ?>
</body>
</html>
