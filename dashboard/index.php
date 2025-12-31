<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';
$labels = [];
$nilai_portofolio = [];
$query = mysqli_query($conn, "
    SELECT tanggal, total_nilai
    FROM portfolio_history
    WHERE user_id = {$_SESSION['user_id']}
    ORDER BY tanggal ASC
");

if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $labels[] = date('M Y', strtotime($row['tanggal']));
        $nilai_portofolio[] = (float)$row['total_nilai'];
    }
}

/* =========================
   TOTAL MODAL (DARI PORTOFOLIO)
   ========================= */
$q_modal = mysqli_query($conn, "
    SELECT SUM(jumlah_lot * 100 * harga_beli) AS total_modal
    FROM portofolio
    WHERE user_id = {$_SESSION['user_id']}
");

$data_modal = mysqli_fetch_assoc($q_modal);
$total_modal = $data_modal['total_modal'] ?? 0;

/* =========================
   NILAI SEKARANG (TERAKHIR)
   ========================= */
$q_nilai = mysqli_query($conn, "
    SELECT total_nilai
    FROM portfolio_history
    WHERE user_id = {$_SESSION['user_id']}
    ORDER BY tanggal DESC
    LIMIT 1
");

$data_nilai = mysqli_fetch_assoc($q_nilai);
$total_nilai = $data_nilai['total_nilai'] ?? 0;

/* =========================
   LABA / RUGI
   ========================= */
$laba = $total_nilai - $total_modal;
$persen_laba = ($total_modal > 0) ? ($laba / $total_modal) * 100 : 0;

/* =========================
   PERSENTASE LABA (AMAN)
   ========================= */
$persen_laba = ($total_modal > 0)
    ? ($laba / $total_modal) * 100
    : 0;
?>
<?= number_format($persen_laba, 2); ?>%
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
.text-muted {
    color: #000000ff !important;
    font-style: italic;
    text-align: center;
    background-color: #ffffffff;
    width: 250px;
    margin-left: 80%;
    border-radius: 8px;
    box-shadow: 2px 10px 20px rgba(0,0,0,.1);
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
        <div class="stat-change <?= $persen_laba >= 0 ? 'up' : 'down'; ?>">
            <?= $persen_laba >= 0 ? '▲ +' : '▼ '; ?>
            <?= number_format(abs($persen_laba), 2); ?>%
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0">Performa Investasi</h6>
                <span class="text-muted small">6 bulan terakhir</span>
            </div>
<?php if (!empty($labels)): ?>
                <canvas id="portfolioChart" height="120"></canvas>
            <?php else: ?>
                <div class="text-center text-muted py-5">
                    📉 Belum ada data performa investasi
                </div>
            <?php endif; ?>



        <!-- INSIGHT -->
    <div class="col-md-4">
        <div class="card-glass insight">
            <h6 class="fw-semibold mb-2">Smart Insight</h6>
            <p class="mb-0 opacity-90">
                Portofolio Anda mengalami kenaikan sebesar
                <strong><?= number_format($persen_laba, 2); ?>%</strong>
                dibanding modal awal.
            </p>
        </div>
    </div>

    </div>

</div>
<script>
const ctx = document.getElementById('portfolioChart').getContext('2d');

// Data dari PHP
const labels = <?= json_encode($labels); ?>;
const dataPortofolio = <?= json_encode($nilai_portofolio); ?>;

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Nilai Portofolio (Rp)',
            data: dataPortofolio,
            fill: true,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,.15)',
            tension: 0.4,
            pointRadius: 4,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>

<?php include '../includes/footer.php'; ?>