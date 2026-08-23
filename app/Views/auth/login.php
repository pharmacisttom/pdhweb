<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบผู้ดูแล - <?= SITENAME ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= URLROOT ?>/assets/images/pdh.ico">
    
    <!-- Google Fonts: Prompt & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-color: #0d9488;
            --primary-dark: #0f766e;
            --bg-color: #0f172a;
        }

        body {
            font-family: 'Prompt', 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at 20% 20%, rgba(13, 148, 136, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 80% 80%, rgba(2, 132, 199, 0.15) 0%, transparent 40%),
                        #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #1e293b;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            color: white;
            text-align: center;
            padding: 32px 24px;
            position: relative;
        }

        .login-logo {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            margin-bottom: 12px;
        }

        .form-control-modern {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15);
        }

        .btn-login {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 4px 15px rgba(13, 148, 136, 0.35);
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #14b8a6, #0f766e);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.45);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <img src="<?= URLROOT ?>/assets/images/pdh.jpg" alt="Logo" class="login-logo" onerror="this.src='https://placehold.co/58x58?text=PDH'">
            <h4 class="mb-1 fw-bold">เข้าสู่ระบบหลังบ้าน</h4>
            <small class="text-white-50">PDH Enterprise Admin Portal</small>
        </div>
        
        <div class="p-4 p-md-5">
            <form action="<?= URLROOT ?>/auth/login" method="POST">
                <?php $csrf_token = \App\Helpers\Security::csrfToken(); ?>
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold small text-muted">ชื่อผู้ใช้งาน (Username)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control form-control-modern rounded-start-0 <?= (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($data['username'] ?? 'admin'); ?>" placeholder="admin" required autofocus>
                    </div>
                    <?php if(!empty($data['username_err'])): ?>
                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i><?= $data['username_err']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold small text-muted">รหัสผ่าน (Password)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" id="passwordInput" name="password" class="form-control form-control-modern rounded-start-0 border-end-0 <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($data['password'] ?? ''); ?>" placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary border-start-0 rounded-end-3" type="button" id="togglePasswordBtn">
                            <i class="bi bi-eye text-muted" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                    <?php if(!empty($data['password_err'])): ?>
                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i><?= $data['password_err']; ?></div>
                    <?php endif; ?>
                </div>



                <button type="submit" class="btn btn-login w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> เข้าสู่ระบบ
                </button>
                
                <div class="text-center">
                    <a href="<?= URLROOT ?>" class="text-decoration-none text-muted small">
                        <i class="bi bi-arrow-left me-1"></i> กลับหน้าเว็บไซต์หลัก
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('passwordInput');
        const passIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passInput && passIcon) {
            toggleBtn.addEventListener('click', function() {
                if (passInput.type === 'password') {
                    passInput.type = 'text';
                    passIcon.classList.remove('bi-eye');
                    passIcon.classList.add('bi-eye-slash');
                } else {
                    passInput.type = 'password';
                    passIcon.classList.remove('bi-eye-slash');
                    passIcon.classList.add('bi-eye');
                }
            });
        }
    });
    </script>
</body>
</html>
