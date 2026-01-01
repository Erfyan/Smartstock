<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../middleware/auth_check.php';

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM portofolio
    WHERE id = $id
    AND user_id = {$_SESSION['user_id']}
");

header("Location: transaksi.php");
exit;