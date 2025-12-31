<?php
// config/config.php

// ==========================
// KONFIGURASI APLIKASI
// ==========================

define('APP_NAME', 'SmartStock Sistem');
define('APP_TAGLINE', 'Manajemen Investasi Berbasis Cloud');

// Base URL (sesuaikan folder project)
define('BASE_URL', 'http://localhost/smartstock/');

// Timezone
date_default_timezone_set('Asia/Makassar');

// ==========================
// KONFIGURASI SESSION
// ==========================

ini_set('session.gc_maxlifetime', 3600); // 1 jam
session_set_cookie_params(3600);

// ==========================
// KONFIGURASI KEAMANAN
// ==========================

// Mode debug (false saat production)
define('APP_DEBUG', true);

// ==========================
// HELPER FUNCTION
// ==========================

function base_url($path = '') {
    return BASE_URL . ltrim($path, '/');
}
