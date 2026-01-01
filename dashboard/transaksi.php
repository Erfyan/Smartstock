<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';

/* =========================
   AMBIL DATA TRANSAKSI USER
   ========================= */
$transaksi = mysqli_query($conn, "
    SELECT *
    FROM portofolio
    WHERE user_id = {$_SESSION['user_id']}
    ORDER BY tanggal_beli DESC
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

.table tbody tr {
    transition: background .2s ease;
}

.table tbody tr:hover {
    background: rgba(13,110,253,.05);
}
</style>

<div class="dashboard container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Transaksi Saham</h4>
            <div class="text-muted">
                Kelola transaksi pembelian saham Anda
            </div>
        </div>

        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Transaksi
        </button>
    </div>

    <!-- TABLE -->
    <div class="card-glass">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Saham</th>
                        <th>Lot</th>
                        <th>Harga Beli</th>
                        <th>Total</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (mysqli_num_rows($transaksi) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
                        <tr>
                            <td><?= date('d M Y', strtotime($row['tanggal_beli'])); ?></td>
                            <td><?= htmlspecialchars($row['saham_id']); ?></td>
                            <td><?= $row['jumlah_lot']; ?> lot</td>
                            <td>Rp <?= number_format($row['harga_beli'],0,',','.'); ?></td>
                            <td>
                                Rp <?= number_format($row['jumlah_lot'] * 100 * $row['harga_beli'],0,',','.'); ?>
                            </td>
                            <td class="text-end">
                                <button 
                                    class="btn btn-sm btn-outline-primary rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit<?= $row['id']; ?>">
                                    Edit
                                </button>
                                <a 
                                    href="transaksi_delete.php?id=<?= $row['id']; ?>" 
                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            📭 Belum ada transaksi saham
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- =======================
     MODAL TAMBAH TRANSAKSI
     ======================= -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="transaksi_process.php" class="modal-content border-0 rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Tambah Transaksi Saham</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kode Saham</label>
                    <input type="text" name="saham_id" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Lot</label>
                    <input type="number" name="jumlah_lot" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Beli / Lembar</label>
                    <input type="number" name="harga_beli" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Beli</label>
                    <input type="date" name="tanggal_beli" class="form-control rounded-pill" required>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- =======================
     MODAL EDIT TRANSAKSI
     ======================= -->
<?php
mysqli_data_seek($transaksi, 0);
while ($row = mysqli_fetch_assoc($transaksi)):
?>
<div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="transaksi_update.php" class="modal-content border-0 rounded-4">

            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kode Saham</label>
                    <input type="text" name="saham_id" class="form-control rounded-pill"
                        value="<?= htmlspecialchars($row['saham_id']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Lot</label>
                    <input type="number" name="jumlah_lot" class="form-control rounded-pill"
                        value="<?= $row['jumlah_lot']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Beli / Lembar</label>
                    <input type="number" name="harga_beli" class="form-control rounded-pill"
                        value="<?= $row['harga_beli']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Beli</label>
                    <input type="date" name="tanggal_beli" class="form-control rounded-pill"
                        value="<?= $row['tanggal_beli']; ?>" required>
                </div>
            </div>

            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
<?php endwhile; ?>

<?php include '../includes/footer.php'; ?>