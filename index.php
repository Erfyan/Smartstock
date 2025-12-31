<?php
require_once 'config/config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --ease: cubic-bezier(.4,0,.2,1);
        }

        * { font-family: 'Inter', system-ui, sans-serif; }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 20% 20%, #6ea8fe33, transparent 40%),
                radial-gradient(circle at 80% 80%, #6610f233, transparent 40%),
                linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            overflow: hidden;
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 20px;
        }

        .hero-box {
            max-width: 760px;
            z-index: 5;
            animation: fadeUp 1s var(--ease);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero h1 {
            font-size: 3.4rem;
            font-weight: 800;
        }

        .hero p {
            font-size: 1.25rem;
            opacity: .9;
        }

        /* CTA */
        .btn-cta {
            margin-top: 30px;
            padding: 14px 38px;
            font-size: 1.1rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all .3s var(--ease);
        }

        .btn-cta:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,.35);
        }

        /* STOCK DECOR */
        .stock-line {
            position: absolute;
            width: 120%;
            height: 120px;
            border-top: 2px dashed rgba(255,255,255,.15);
            top: 65%;
            left: -10%;
            transform: rotate(-4deg);
            animation: moveLine 12s linear infinite;
        }

        @keyframes moveLine {
            from { transform: translateX(0) rotate(-4deg); }
            to { transform: translateX(-200px) rotate(-4deg); }
        }

        .floating {
            position: absolute;
            font-size: 2rem;
            opacity: .75;
            animation: float 6s infinite ease-in-out;
        }

        .float-1 { top: 20%; left: 15%; }
        .float-2 { top: 30%; right: 18%; animation-delay: 1s; }
        .float-3 { bottom: 20%; left: 25%; animation-delay: 2s; }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }

        /* GLASS CARD */
        .glass-info {
            position: absolute;
            bottom: 60px;
            right: 60px;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 20px 24px;
            box-shadow: 0 30px 60px rgba(0,0,0,.3);
            animation: fadeUp 1.2s var(--ease);
        }
        .landing-logo {
            width: 160px;              /* ukuran utama */
            margin-bottom: 24px;
            filter: drop-shadow(0 18px 35px rgba(0,0,0,.35));
            transition: transform .5s cubic-bezier(.4,0,.2,1);
        }

        .landing-logo:hover {
            transform: scale(1.08) rotate(-2deg);
        }

    </style>
</head>
<body>
<?php include 'includes/loader.php'; ?>
<!-- DECOR -->
<div class="stock-line"></div>

<div class="floating float-1">📈</div>
<div class="floating float-2">💹</div>
<div class="floating float-3">📊</div>

<!-- HERO -->
<section class="hero">
    <div class="hero-box">
        <img 
            src="<?= base_url('uploads/3.png'); ?>" 
            alt="SmartStock Logo"
            class="landing-logo">
        <h1><?= APP_NAME; ?></h1>
        <p class="mt-3 mb-4">
            Platform modern untuk mengelola, memantau, dan
            menganalisis investasi saham secara cerdas dan interaktif.
        </p>

        <a href="<?= base_url('auth/auth.php'); ?>" class="btn btn-light btn-cta">
            Mulai Sekarang
        </a>

        <div class="mt-4 opacity-75">
            Analisis • Portofolio • Cloud
        </div>
    </div>
</section>

<!-- INFO GLASS -->
<div class="glass-info">
    <strong>Market Insight</strong>
    <div class="small opacity-75">
        Pantau performa saham secara real-time
    </div>
</div>

</body>
</html>