<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About | <?= APP_NAME; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            backdrop-filter: blur(14px);
            border-radius: 22px;
            padding: 50px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 30px 60px rgba(0,0,0,.3);
        }

        h1, h2 {
            font-weight: 700;
        }

        p {
            opacity: .92;
            line-height: 1.8;
        }

        ul li {
            margin-bottom: 8px;
        }

        .section {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="glass">

    <h1 class="text-center mb-4">Tentang <?= APP_NAME; ?></h1>

    <!-- PENDAHULUAN -->
    <p>
        <strong><?= APP_NAME; ?></strong> merupakan aplikasi berbasis web yang
        dikembangkan untuk membantu pengguna dalam mengelola, memantau, serta
        menganalisis investasi saham secara terstruktur, informatif, dan mudah
        dipahami. Aplikasi ini dirancang dengan pendekatan modern yang
        mengintegrasikan visualisasi data dan manajemen portofolio secara
        terpusat.
    </p>

    <!-- TUJUAN -->
    <div class="section">
        <h2>🎯 Tujuan Aplikasi</h2>
        <p>
            Tujuan utama pengembangan <?= APP_NAME; ?> adalah menyediakan
            platform digital yang mampu membantu investor, khususnya pemula,
            dalam memahami dan mengelola investasi saham secara lebih sistematis
            dan berbasis data. Aplikasi ini diharapkan dapat menjadi sarana
            pendukung pengambilan keputusan investasi yang lebih rasional dan
            terinformasi.
        </p>
    </div>

    <!-- FUNGSI -->
    <div class="section">
        <h2>⚙️ Fungsi Utama Aplikasi</h2>
        <p>
            <?= APP_NAME; ?> memiliki beberapa fungsi utama yang mendukung proses
            pengelolaan investasi saham, antara lain:
        </p>
        <ul>
            <li>Manajemen portofolio saham secara terpusat dan terdokumentasi.</li>
            <li>Pemantauan performa saham berdasarkan data yang tersimpan.</li>
            <li>Penyajian data investasi dalam bentuk visual yang mudah dipahami.</li>
            <li>Membantu pengguna dalam mengevaluasi strategi investasi.</li>
            <li>Menyediakan sistem berbasis web yang dapat diakses secara fleksibel.</li>
        </ul>
    </div>

    <!-- LATAR BELAKANG -->
    <div class="section">
        <h2>📚 Latar Belakang</h2>
        <p>
            Perkembangan teknologi informasi telah mendorong transformasi
            signifikan dalam dunia investasi, termasuk pada pasar saham.
            Meskipun akses terhadap informasi pasar semakin terbuka, masih banyak
            investor yang mengalami kesulitan dalam mengelola data investasi
            secara terstruktur dan berkelanjutan.
        </p>
        <p>
            Banyak investor, khususnya investor pemula, masih mengandalkan
            pencatatan manual atau aplikasi yang kurang terintegrasi, sehingga
            menyulitkan dalam melakukan analisis dan evaluasi portofolio. Oleh
            karena itu, diperlukan sebuah sistem berbasis web yang mampu
            mengintegrasikan proses pengelolaan data investasi dengan tampilan
            yang intuitif dan informatif. <?= APP_NAME; ?> hadir sebagai solusi
            atas permasalahan tersebut.
        </p>
    </div>

    <!-- ARSITEKTUR -->
    <div class="section">
        <h2>🏗️ Arsitektur Aplikasi</h2>
        <p>
            <?= APP_NAME; ?> dibangun menggunakan arsitektur aplikasi berbasis web
            yang menerapkan pemisahan antara antarmuka pengguna (frontend),
            logika aplikasi (backend), dan basis data (database).
        </p>

        <ul>
            <li>
                <strong>Frontend</strong>  
                <br>
                Menggunakan HTML, CSS, Bootstrap, dan JavaScript untuk
                menampilkan antarmuka yang responsif, modern, dan mudah digunakan.
            </li>
            <li>
                <strong>Backend</strong>  
                <br>
                Dikembangkan menggunakan PHP yang bertanggung jawab dalam
                pengolahan logika bisnis, autentikasi pengguna, serta pengelolaan
                data.
            </li>
            <li>
                <strong>Database</strong>  
                <br>
                Menggunakan sistem manajemen basis data untuk menyimpan data
                pengguna, portofolio, serta informasi saham secara terstruktur.
            </li>
        </ul>

        <p>
            Dengan arsitektur tersebut, aplikasi ini dirancang agar mudah
            dikembangkan, aman, dan memiliki performa yang optimal sesuai dengan
            kebutuhan pengguna.
        </p>
    </div>

    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-light px-4">Kembali ke Beranda</a>
    </div>

</div>

</body>
</html>