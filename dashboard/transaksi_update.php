<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';

$id           = $_POST['id'];
$saham_id     = $_POST['saham_id'];
$jumlah_lot   = $_POST['jumlah_lot'];
$harga_beli   = $_POST['harga_beli'];
$tanggal_beli = $_POST['tanggal_beli'];

mysqli_query($conn, "
    UPDATE portofolio SET
        saham_id = '$saham_id',
        jumlah_lot = $jumlah_lot,
        harga_beli = $harga_beli,
        tanggal_beli = '$tanggal_beli'
    WHERE id = $id
    AND user_id = {$_SESSION['user_id']}
");

header("Location: transaksi.php");
exit;
