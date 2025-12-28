<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/auth.php';
requireLogin();

$currentAdmin = getCurrentAdmin();
if (!$currentAdmin) {
    logout();
}

$pageTitle = $pageTitle ?? 'Dashboard';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link href="/admin/assets/css/admin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <img src="/img/logo_ziya_aytar.png" alt="Logo" class="sidebar-logo" onerror="this.style.display='none'">
                <h4 class="sidebar-title">Admin Panel</h4>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="<?php echo ADMIN_BASE; ?>/index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ADMIN_BASE; ?>/projects.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>">
                        <i class="fas fa-building"></i>
                        <span>Projeler</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ADMIN_BASE; ?>/contacts.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contacts.php' ? 'active' : ''; ?>">
                        <i class="fas fa-envelope"></i>
                        <span>İletişim Mesajları</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo ADMIN_BASE; ?>/appointments.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'appointments.php' ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Randevular</span>
                    </a>
                </li>
                <?php if (isAdmin()): ?>
                <li>
                    <a href="<?php echo ADMIN_BASE; ?>/settings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                        <i class="fas fa-cog"></i>
                        <span>Ayarlar</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <div class="user-name"><?php echo htmlspecialchars($currentAdmin['full_name'] ?? $currentAdmin['username'] ?? 'Admin'); ?></div>
                        <div class="user-role"><?php echo ($currentAdmin && $currentAdmin['role'] == 'admin') ? 'Yönetici' : 'Editör'; ?></div>
                    </div>
                </div>
                <a href="<?php echo ADMIN_BASE; ?>/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Çıkış Yap</span>
                </a>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <button id="sidebarToggle" class="btn btn-link">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-right">
                    <a href="/index.php" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt me-1"></i>
                        Siteyi Görüntüle
                    </a>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="content-wrapper">
