<?php
require_once '../config/config.php';
require_once '../middleware/auth_check.php';

// Dummy data (nanti diganti dari DB)
$total_modal   = 15000000;
$total_nilai   = 17800000;
$laba          = $total_nilai - $total_modal;
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/loader.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<style>
.dashboard {
    padding: 32px;
    transition: all .4s cubic-bezier(.4,0,.2,1);
}

.sidebar-open .dashboard {
    padding-left: 300px;
}

/* HERO */
.dashboard-hero {
    background: linear-gradient(135deg,#0d6efd,#6610f2);
    color: white;
    border-radius: 26px;
    padding: 28px 32px;
    box-shadow: 0 30px 60px rgba(0,0,0,.25);
    margin-bottom: 30px;
}

/* CARD STAT */
.stat-card {
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(14px);
    border-radius: 22px;
    padding: 22px;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
    transition: all .35s cubic-bezier(.4,0,.2,1);
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 35px 70px rgba(0,0,0,.25);
}

.stat-value {
    font-size: 1.9rem;
    font-weight: 700;
}

.stat-change {
    font-size: .85rem;
    margin-top: 6px;
}

.up {
    color: #198754;
}
.down {
    color: #dc3545;
}
</style>

    <div class="dashboard-hero">
        <h3 class="fw-bold mb-1">
            Halo, <?= $_SESSION['nama']; ?> 👋
        </h3>
        <p class="opacity-90 mb-0">
            Pantau dan kelola investasi saham Anda dengan lebih cerdas hari ini.
            <div class="text-muted">
                <?= date('l, d F Y'); ?>
            </div>
        </p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Total Modal</div>
            <div class="stat-value">
                Rp <?= number_format($total_modal,0,',','.'); ?>
            </div>
            <div class="stat-change up">
                ▲ +3.2% dari bulan lalu
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Nilai Sekarang</div>
            <div class="stat-value">
                Rp <?= number_format($total_nilai,0,',','.'); ?>
            </div>
            <div class="stat-change up">
                ▲ +<?= number_format(($laba/$total_modal)*100,2); ?>%
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Profit / Loss</div>
            <div class="stat-value <?= $laba >= 0 ? 'up' : 'down'; ?>">
                Rp <?= number_format($laba,0,',','.'); ?>
            </div>
            <div class="stat-change <?= $laba >= 0 ? 'up' : 'down'; ?>">
                <?= $laba >= 0 ? '▲ Profit' : '▼ Loss'; ?>
            </div>
            </div>
        </div>
    </div>


    <!-- MAIN CONTENT -->
    <div class="row g-4">

        <!-- CHART -->
        <div class="col-md-8">
            <div class="card-glass">
                <h6 class="fw-semibold mb-3">Performa Investasi</h6>
                <div class="text-muted">
                    Grafik akan menampilkan tren nilai portofolio saham.
                </div>
                <div class="mt-3 text-center text-muted">
                    📉 Chart akan ditambahkan (Chart.js)
                </div>
            </div>
        </div>

        <!-- INSIGHT -->
        <div class="col-md-4">
            <div class="card-glass insight">
                <h6 class="fw-semibold mb-2">Smart Insight</h6>
                <p class="mb-0 opacity-90">
                    Portofolio Anda mengalami kenaikan sebesar
                    <strong><?= number_format(($laba/$total_modal)*100,2); ?>%</strong>
                    dibanding modal awal.
                </p>
            </div>
        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>