<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: auth.php");
    exit;
}

$email    = trim($_POST['email']);
$password = $_POST['password'];

// Ambil user berdasarkan email
$stmt = mysqli_prepare($conn, "SELECT id, nama_lengkap, email, password, role FROM users WHERE email = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {

    // Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama']    = $user['nama_lengkap'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['role']    = $user['role'];

    header("Location: ../dashboard/index.php");
    exit;

} else {
    header("Location: auth.php?error=login");
    exit;
}