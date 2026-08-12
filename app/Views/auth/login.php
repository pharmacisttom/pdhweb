<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - <?= SITENAME ?></title>
    <!-- Google Fonts: Noto Sans Thai -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f1f5f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,.05), 0 2px 4px -1px rgba(0,0,0,.03);
        }
        .login-header {
            background-color: #10B981;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 12px 12px 0 0;
        }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="login-header">
            <h4 class="mb-0">เข้าสู่ระบบหลังบ้าน</h4>
            <small><?= SITENAME ?></small>
        </div>
        <div class="card-body p-4">
            <form action="<?= URLROOT ?>/auth/login" method="POST">
            <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
                    <input type="text" name="username" class="form-control <?= (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['username']; ?>">
                    <div class="invalid-feedback"><?= $data['username_err']; ?></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['password']; ?>">
                    <div class="invalid-feedback"><?= $data['password_err']; ?></div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg">เข้าสู่ระบบ</button>
                </div>
                <div class="text-center mt-3">
                    <a href="<?= URLROOT ?>" class="text-decoration-none text-muted"><small>&larr; กลับหน้าเว็บไซต์</small></a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
