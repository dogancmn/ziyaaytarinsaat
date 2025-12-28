<?php
$pageTitle = 'Dashboard';
require_once 'includes/header.php';
require_once 'includes/functions.php';

// Get statistics
$stats = ['projects' => 0, 'published_projects' => 0, 'contacts' => 0, 'recent_contacts' => 0, 'appointments' => 0, 'pending_appointments' => 0];
$recent_contacts = [];
$recent_appointments = [];

try {
    if (isset($conn)) {
        // Total projects
        $stmt = $conn->query("SELECT COUNT(*) as total FROM projects");
        $stats['projects'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Published projects
        $stmt = $conn->query("SELECT COUNT(*) as total FROM projects WHERE status = 'published'");
        $stats['published_projects'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Total contacts
        $stmt = $conn->query("SELECT COUNT(*) as total FROM contacts");
        $stats['contacts'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Unread contacts (last 7 days)
        $stmt = $conn->query("SELECT COUNT(*) as total FROM contacts WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
        $stats['recent_contacts'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Total appointments
        $stmt = $conn->query("SELECT COUNT(*) as total FROM appointments");
        $stats['appointments'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Pending appointments
        $stmt = $conn->query("SELECT COUNT(*) as total FROM appointments WHERE status = 'pending'");
        $stats['pending_appointments'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        
        // Recent contacts
        $stmt = $conn->prepare("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5");
        $stmt->execute();
        $recent_contacts = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        
        // Recent appointments
        $stmt = $conn->prepare("SELECT * FROM appointments ORDER BY created_at DESC LIMIT 5");
        $stmt->execute();
        $recent_appointments = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
} catch (PDOException $e) {
    // Silently fail, stats will be 0
}
?>

<div class="page-header mb-4">
    <h1 class="h3 mb-0">Dashboard</h1>
    <p class="text-muted">Hoş geldiniz, <?php echo htmlspecialchars($currentAdmin['full_name'] ?? $currentAdmin['username'] ?? 'Admin'); ?>!</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-building"></i>
        </div>
        <div class="stat-value"><?php echo $stats['projects']; ?></div>
        <div class="stat-label">Toplam Proje</div>
        <small class="text-muted"><?php echo $stats['published_projects']; ?> yayında</small>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-value"><?php echo $stats['contacts']; ?></div>
        <div class="stat-label">İletişim Mesajı</div>
        <small class="text-muted"><?php echo $stats['recent_contacts']; ?> son 7 günde</small>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-value"><?php echo $stats['appointments']; ?></div>
        <div class="stat-label">Randevu</div>
        <small class="text-muted"><?php echo $stats['pending_appointments']; ?> bekleyen</small>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-envelope me-2"></i>Son İletişim Mesajları
            </div>
            <div class="card-body">
                <?php if (empty($recent_contacts)): ?>
                    <p class="text-muted text-center py-3">Henüz mesaj yok.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>E-posta</th>
                                    <th>Tarih</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_contacts as $contact): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($contact['name'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($contact['email'] ?? ''); ?></td>
                                    <td><?php echo formatDate($contact['created_at'] ?? ''); ?></td>
                                    <td>
                                        <a href="<?php echo ADMIN_BASE; ?>/contacts.php?view=<?php echo $contact['id'] ?? ''; ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?php echo ADMIN_BASE; ?>/contacts.php" class="btn btn-sm btn-primary">Tümünü Gör</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calendar-alt me-2"></i>Son Randevular
            </div>
            <div class="card-body">
                <?php if (empty($recent_appointments)): ?>
                    <p class="text-muted text-center py-3">Henüz randevu yok.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Hizmet</th>
                                    <th>Tarih</th>
                                    <th>Durum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_appointments as $appointment): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($appointment['name'] ?? ''); ?></td>
                                    <td><?php echo htmlspecialchars($appointment['service'] ?? '-'); ?></td>
                                    <td><?php echo formatDate($appointment['appointment_date'] ?? '', 'd.m.Y'); ?></td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'pending' => 'warning',
                                            'confirmed' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $statusText = [
                                            'pending' => 'Bekliyor',
                                            'confirmed' => 'Onaylandı',
                                            'cancelled' => 'İptal'
                                        ];
                                        $status = $appointment['status'] ?? 'pending';
                                        ?>
                                        <span class="badge bg-<?php echo $statusClass[$status] ?? 'warning'; ?>">
                                            <?php echo $statusText[$status] ?? 'Bekliyor'; ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?php echo ADMIN_BASE; ?>/appointments.php" class="btn btn-sm btn-primary">Tümünü Gör</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
