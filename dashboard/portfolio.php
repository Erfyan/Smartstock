<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';

/* =========================
   DATA PORTOFOLIO (GROUPED)
   ========================= */
$portfolio = mysqli_query($conn, "
    SELECT 
        saham_id,
        SUM(jumlah_lot) AS total_lot,
        SUM(jumlah_lot * 100 * harga_beli) AS total_modal,
        AVG(harga_beli) AS avg_harga
    FROM portofolio
    WHERE user_id = {$_SESSION['user_id']}
    GROUP BY saham_id
    ORDER BY saham_id ASC
");
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/loader.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<style>
.dashboard {
    padding: 32px;
}

/* CARD */
.card-glass {
    background: rgba(255,255,255,.9);
    backdrop-filter: blur(14px);
    border-radius: 22px;
    padding: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}

/* TABLE */
.table thead th {
    border: none;
    color: #6c757d;
    font-weight: 600;
}

.table tbody tr:hover {
    background: rgba(13,110,253,.05);
}
</style>

<div class="dashboard container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Portofolio Saham</h4>
            <div class="text-muted">
                Ringkasan kepemilikan saham Anda
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card-glass">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Kode Saham</th>
                        <th>Total Lot</th>
                        <th>Rata-rata Harga</th>
                        <th>Total Modal</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (mysqli_num_rows($portfolio) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($portfolio)): ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($row['saham_id']); ?></td>
                            <td><?= $row['total_lot']; ?> lot</td>
                            <td>
                                Rp <?= number_format($row['avg_harga'],0,',','.'); ?>
                            </td>
                            <td>
                                Rp <?= number_format($row['total_modal'],0,',','.'); ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            📂 Portofolio masih kosong
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include '../includes/footer.php'; ?>
