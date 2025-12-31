<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
/* TOPBAR */
.topbar {
    height: 72px;
    background: rgba(255,255,255,.8);
    backdrop-filter: blur(14px);
    box-shadow: 0 10px 40px rgba(0,0,0,.08);
    display: flex;
    align-items: center;
    padding: 0 24px;
    position: sticky;
    top: 0;
    z-index: 1100;
    transition: transform .4s cubic-bezier(.4,0,.2,1),
                opacity .3s ease;
}

/* HIDE HEADER WHEN SIDEBAR OPEN */
.sidebar-open .topbar {
    transform: translateY(-100%);
    opacity: 0;
    pointer-events: none;
}

/* MENU BUTTON */
.menu-btn {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    border: none;
    background: rgba(13,110,253,.12);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .3s cubic-bezier(.4,0,.2,1);
}

.menu-btn:hover {
    background: rgba(13,110,253,.22);
    transform: scale(1.08);
}

/* BRAND */
.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: 16px;
    font-weight: 700;
    font-size: 1.05rem;
    color: #0d6efd;
}

/* USER */
.user-info {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 500;
    color: #495057;
}

.user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg,#0d6efd,#6610f2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">

    <button class="menu-btn" onclick="toggleSidebar()">
        ☰
    </button>

    <div class="brand">
        <img src="<?= base_url('uploads/logo-gradient.png'); ?>" height="32">
        SmartStock
    </div>

    <div class="user-info">
        <div class="user-avatar">
            <?= strtoupper(substr($_SESSION['nama'],0,1)); ?>
        </div>
        <?= $_SESSION['nama']; ?>
    </div>

</div>
