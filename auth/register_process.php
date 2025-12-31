<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: auth.php");
    exit;
}

$nama     = trim($_POST['nama']);
$email    = trim($_POST['email']);
$password = $_POST['password'];

// Validasi email sudah ada
$check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($check, "s", $email);
mysqli_stmt_execute($check);
$checkResult = mysqli_stmt_get_result($check);

if (mysqli_num_rows($checkResult) > 0) {
    header("Location: auth.php?error=email");
    exit;
}

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Simpan user
$stmt = mysqli_prepare($conn, "
    INSERT INTO users (nama_lengkap, email, password, role)
    VALUES (?, ?, ?, 'investor')
");

mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $password_hash);

if (mysqli_stmt_execute($stmt)) {
    header("Location: auth.php?success=register");
    exit;
} else {
    header("Location: auth.php?error=register");
    exit;
}