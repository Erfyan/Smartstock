<?php
// middleware/auth_check.php

session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/auth.php");
    exit;
}