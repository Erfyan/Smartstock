<?php
// config/database.php

$host     = "localhost";
$username = "root";          // ganti jika hosting
$password = "";              // ganti jika hosting
$database = "smartstock_db";

// Buat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset (penting)
mysqli_set_charset($conn, "utf8");
