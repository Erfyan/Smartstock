<?php
require_once 'config/config.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data (bisa dikembangkan simpan DB / kirim email)
    $nama   = htmlspecialchars($_POST['nama']);
    $email  = htmlspecialchars($_POST['email']);
    $pesan  = htmlspecialchars($_POST['pesan']);

    // Simulasi sukses
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Contact | <?= APP_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            padding: 80px 20px;
        }

        .glass {
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 50px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 30px 60px rgba(0,0,0,.35);
        }

        a.contact-link {
            display: block;
            padding: 12px 18px;
            margin-bottom: 12px;
            border-radius: 14px;
            background: rgba(255,255,255,.15);
            color: white;
            text-decoration: none;
            transition: all .3s ease;
        }

        a.contact-link:hover {
            background: rgba(255,255,255,.3);
            transform: translateY(-2px);
        }

        input, textarea {
            background: rgba(255,255,255,.15) !important;
            border: none !important;
            color: white !important;
        }

        input::placeholder, textarea::placeholder {
            color: rgba(255,255,255,.75);
        }

        .btn-send {
            border-radius: 30px;
            padding: 12px 36px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="glass">

    <h1 class="text-center fw-bold mb-4">Hubungi Kami</h1>

    <p class="text-center opacity-90 mb-5">
        Jangan ragu untuk menghubungi tim <?= APP_NAME; ?> melalui media berikut
        atau kirimkan pesan langsung kepada kami.
    </p>

    <!-- INFO KONTAK -->
    <div class="row mb-5">
        <div class="col-md-6">
            <a href="mailto:support@smartstock.id" class="contact-link">
                📧 Email: <strong>support@smartstock.id</strong>
            </a>
            <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="contact-link">
                📱 WhatsApp: <strong>08xxxxxxxxxx</strong>
            </a>
            <a href="https://instagram.com/smartstock.id" target="_blank" class="contact-link">
                🌐 Instagram: <strong>@smartstock.id</strong>
            </a>
        </div>

        <!-- FORM PESAN -->
        <div class="col-md-6">
            <?php if ($success): ?>
                <div class="alert alert-success text-dark">
                    Pesan berhasil dikirim. Terima kasih telah menghubungi kami.
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control"
                           placeholder="Nama Lengkap" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control"
                           placeholder="Email Aktif" required>
                </div>

                <div class="mb-3">
                    <textarea name="pesan" rows="4" class="form-control"
                              placeholder="Tulis pesan Anda..." required></textarea>
                </div>

                <button type="submit" class="btn btn-light btn-send w-100">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    <div class="text-center">
        <a href="index.php" class="btn btn-outline-light btn-sm">
            ⬅ Kembali ke Beranda
        </a>
    </div>

</div>

</body>
</html>
