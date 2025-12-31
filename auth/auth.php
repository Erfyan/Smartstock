<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../config/config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SmartStock | Authentication</title>

    <!-- Bootstrap (HANYA GRID & FORM RESET) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --ease: cubic-bezier(.4,0,.2,1);
        }

        * {
            font-family: 'Inter', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at top left, #6ea8fe, transparent 40%),
                radial-gradient(circle at bottom right, #6610f2, transparent 40%),
                linear-gradient(135deg, #0d6efd, #6610f2);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* CONTAINER */
        .auth-container {
            width: 960px;
            height: 540px;
            position: relative;
        }

        /* BRAND PANEL (DEPAN) */
        .brand-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            z-index: 5;
            border-radius: 28px;
            backdrop-filter: blur(20px);
            background: linear-gradient(
                135deg,
                rgba(13,110,253,.95),
                rgba(102,16,242,.95)
            );
            color: white;
            box-shadow:
                0 50px 100px rgba(0,0,0,.45),
                inset 0 0 0 1px rgba(255,255,255,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 50px;
            transition: transform .9s var(--ease);
        }

        /* FORM PANEL (BELAKANG) */
        .form-panel {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 1;
            border-radius: 28px;
            background: rgba(255,255,255,.95);
            box-shadow: 0 40px 80px rgba(0,0,0,.25);
            padding: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .9s var(--ease);
        }

        /* STATE REGISTER */
        .show-register .brand-panel {
            transform: translateX(100%);
        }
        .show-register .form-panel {
            transform: translateX(-100%);
        }

        /* FORM */
        .form-box {
            width: 100%;
            animation: fadeUp .8s var(--ease);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* INPUT */
        .form-control {
            border-radius: 16px;
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            transition: all .3s var(--ease);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13,110,253,.18);
        }

        /* BUTTON */
        .btn-modern {
            border-radius: 16px;
            padding: 14px;
            font-weight: 600;
            transition: all .3s var(--ease);
        }

        .btn-primary {
            background: linear-gradient(135deg,#0d6efd,#6610f2);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(13,110,253,.45);
        }

        /* SWITCH */
        .switch {
            cursor: pointer;
            font-weight: 500;
            color: #0d6efd;
        }
        .switch:hover {
            text-decoration: underline;
        }
        .hero-box img {
        transition: transform .4s ease;
        }
        .hero-box img:hover {
        transform: scale(1.05) rotate(-2deg);
        }

    </style>
</head>
<body>
<?php include '../includes/loader.php'; ?>
<div class="auth-container" id="auth">

    <!-- BRAND (DEPAN) -->
    <div class="brand-panel">
            <img 
            src="<?= base_url('uploads/logo-white.png'); ?>" 
            alt="SmartStock Logo"
            style="
                width: 100px;
                margin-bottom: 20px;
                filter: drop-shadow(0 12px 25px rgba(0,0,0,.4));
            "
        >
        <h1 class="fw-bold mt-2">SmartStock</h1>
        <p class="mt-3 opacity-90">
            Platform modern untuk<br>
            mengelola investasi saham<br>
            secara cerdas & aman
        </p>
        <small class="opacity-75 mt-4">
            Secure • Interactive • Cloud-Based
        </small>
    </div>

    <!-- FORM (BELAKANG) -->
    <div class="form-panel">

        <!-- LOGIN -->
        <div class="form-box login-box">
            <h3 class="fw-bold mb-2">Welcome Back</h3>
            <p class="text-muted mb-4">Login ke SmartStock</p>

            <form method="POST" action="login_process.php">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button class="btn btn-primary btn-modern w-100 mb-3">
                    Login
                </button>
            </form>

            <p class="text-center">
                Belum punya akun?
                <span class="switch" onclick="register()">Register</span>
            </p>
        </div>

        <!-- REGISTER -->
        <div class="form-box register-box d-none">
            <h3 class="fw-bold mb-2">Create Account</h3>
            <p class="text-muted mb-4">Mulai bersama SmartStock</p>

            <form method="POST" action="register_process.php">
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <button class="btn btn-primary btn-modern w-100 mb-3">
                    Register
                </button>
            </form>

            <p class="text-center">
                Sudah punya akun?
                <span class="switch" onclick="login()">Login</span>
            </p>
        </div>

    </div>
</div>

<script>
function register() {
    document.getElementById('auth').classList.add('show-register');
    document.querySelector('.login-box').classList.add('d-none');
    document.querySelector('.register-box').classList.remove('d-none');
}

function login() {
    document.getElementById('auth').classList.remove('show-register');
    document.querySelector('.register-box').classList.add('d-none');
    document.querySelector('.login-box').classList.remove('d-none');
}
</script>

</body>
</html>