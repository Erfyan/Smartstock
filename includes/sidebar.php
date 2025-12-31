<?php
// includes/sidebar.php
?>

<style>
/* OVERLAY */
.sidebar-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all .3s ease;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    top: 0;
    left: -260px;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #0d6efd, #6610f2);
    color: white;
    padding: 90px 16px 20px;
    z-index: 1101;
    transition: left .35s cubic-bezier(.4,0,.2,1);
}

/* ACTIVE */
.sidebar-open .sidebar {
    left: 0;
}

.sidebar-open .sidebar-overlay {
    opacity: 1;
    visibility: visible;
}

/* LINK */
.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
    text-decoration: none;
    padding: 12px 16px;
    border-radius: 14px;
    margin-bottom: 8px;
    transition: all .3s ease;
}

.sidebar a:hover {
    background: rgba(255,255,255,.18);
    transform: translateX(6px);
}
</style>

<!-- OVERLAY -->
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="<?= base_url('dashboard/index.php'); ?>">📊 Dashboard</a>
    <a href="<?= base_url('dashboard/portfolio.php'); ?>">💼 Portofolio</a>
    <a href="<?= base_url('dashboard/transaksi.php'); ?>">🔁 Transaksi</a>
    <a href="<?= base_url('auth/logout.php'); ?>">🚪 Logout</a>
</div>
<script>
function toggleSidebar() {
    document.body.classList.toggle('sidebar-open');
}
</script>
