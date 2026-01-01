<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';

$saham_id     = $_POST['saham_id'];
$jumlah_lot   = $_POST['jumlah_lot'];
$harga_beli   = $_POST['harga_beli'];
$tanggal_beli = $_POST['tanggal_beli'];

mysqli_query($conn, "
    INSERT INTO portofolio 
    (user_id, saham_id, jumlah_lot, harga_beli, tanggal_beli)
    VALUES (
        {$_SESSION['user_id']},
        '$saham_id',
        $jumlah_lot,
        $harga_beli,
        '$tanggal_beli'
    )
");

header("Location: transaksi.php");
exit;
