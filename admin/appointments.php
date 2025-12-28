<?php
$pageTitle = 'Randevular';
require_once 'includes/header.php';
require_once 'includes/functions.php';

$view_id = $_GET['view'] ?? null;
$message = '';
$error = '';

// Update appointment status
if (isset($_POST['update_status']) && isset($conn)) {
    try {
        $stmt = $conn->prepare("UPDATE appointments SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $_POST['status']);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $message = 'Randevu durumu güncellendi.';
    } catch (PDOException $e) {
        $error = 'Randevu güncellenirken bir hata oluştu.';
    }
}

// Delete appointment
if (isset($_POST['delete']) && isset($conn)) {
    try {
        $stmt = $conn->prepare("DELETE FROM appointments WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $message = 'Randevu başarıyla silindi.';
    } catch (PDOException $e) {
        $error = 'Randevu silinirken bir hata oluştu.';
    }
}

// Get single appointment
$appointment = null;
if ($view_id && isset($conn)) {
    try {
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE id = :id");
        $stmt->bindParam(':id', $view_id);
        $stmt->execute();
        $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Randevu bulunamadı.';
    }
}

// Get all appointments
$appointments = [];
if (!$view_id && isset($conn)) {
    try {
        $stmt = $conn->query("SELECT * FROM appointments ORDER BY created_at DESC");
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        $appointments = [];
    }
}

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
?>

<?php if ($message): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($message); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($view_id && $appointment): ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Randevu Detayı</h1>
        <a href="<?php echo ADMIN_BASE; ?>/appointments.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Geri Dön
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Ad Soyad:</strong><br>
                    <?php echo htmlspecialchars($appointment['name'] ?? ''); ?>
                </div>
                <div class="col-md-6">
                    <strong>E-posta:</strong><br>
                    <a href="mailto:<?php echo htmlspecialchars($appointment['email'] ?? ''); ?>">
                        <?php echo htmlspecialchars($appointment['email'] ?? ''); ?>
                    </a>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Telefon:</strong><br>
                    <a href="tel:<?php echo htmlspecialchars($appointment['mobile'] ?? ''); ?>">
                        <?php echo htmlspecialchars($appointment['mobile'] ?? '-'); ?>
                    </a>
                </div>
                <div class="col-md-6">
                    <strong>Hizmet:</strong><br>
                    <?php echo htmlspecialchars($appointment['service'] ?? '-'); ?>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Randevu Tarihi:</strong><br>
                    <?php echo formatDate($appointment['appointment_date'] ?? '', 'd.m.Y'); ?>
                </div>
                <div class="col-md-6">
                    <strong>Randevu Saati:</strong><br>
                    <?php echo !empty($appointment['appointment_time']) ? date('H:i', strtotime($appointment['appointment_time'])) : '-'; ?>
                </div>
            </div>
            
            <?php if (!empty($appointment['message'])): ?>
            <div class="mb-3">
                <strong>Mesaj:</strong><br>
                <div class="p-3 bg-light rounded">
                    <?php echo nl2br(htmlspecialchars($appointment['message'])); ?>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="mb-3">
                <strong>Durum:</strong><br>
                <span class="badge bg-<?php echo $statusClass[$appointment['status'] ?? 'pending'] ?? 'warning'; ?>">
                    <?php echo $statusText[$appointment['status'] ?? 'pending'] ?? 'Bekliyor'; ?>
                </span>
            </div>
            
            <div class="mb-3">
                <strong>Oluşturulma Tarihi:</strong><br>
                <?php echo formatDate($appointment['created_at'] ?? ''); ?>
            </div>
            
            <div class="mt-4">
                <form method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?php echo $appointment['id'] ?? ''; ?>">
                    <select name="status" class="form-select d-inline-block" style="width: auto;">
                        <option value="pending" <?php echo ($appointment['status'] ?? 'pending') === 'pending' ? 'selected' : ''; ?>>Bekliyor</option>
                        <option value="confirmed" <?php echo ($appointment['status'] ?? '') === 'confirmed' ? 'selected' : ''; ?>>Onaylandı</option>
                        <option value="cancelled" <?php echo ($appointment['status'] ?? '') === 'cancelled' ? 'selected' : ''; ?>>İptal</option>
                    </select>
                    <button type="submit" name="update_status" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Durumu Güncelle
                    </button>
                </form>
                
                <a href="mailto:<?php echo htmlspecialchars($appointment['email'] ?? ''); ?>?subject=Randevu: <?php echo urlencode($appointment['service'] ?? ''); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-envelope me-2"></i>E-posta Gönder
                </a>
                
                <form method="POST" style="display: inline;" onsubmit="return confirm('Bu randevuyu silmek istediğinize emin misiniz?');">
                    <input type="hidden" name="id" value="<?php echo $appointment['id'] ?? ''; ?>">
                    <button type="submit" name="delete" class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i>Sil
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php else: ?>
    <h1 class="h3 mb-4">Randevular</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Ad Soyad</th>
                            <th>E-posta</th>
                            <th>Telefon</th>
                            <th>Hizmet</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($appointments)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Henüz randevu yok.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($appointments as $a): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($a['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($a['email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($a['mobile'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($a['service'] ?? '-'); ?></td>
                                <td><?php echo formatDate($a['appointment_date'] ?? '', 'd.m.Y'); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $statusClass[$a['status'] ?? 'pending'] ?? 'warning'; ?>">
                                        <?php echo $statusText[$a['status'] ?? 'pending'] ?? 'Bekliyor'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo ADMIN_BASE; ?>/appointments.php?view=<?php echo $a['id'] ?? ''; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bu randevuyu silmek istediğinize emin misiniz?');">
                                        <input type="hidden" name="id" value="<?php echo $a['id'] ?? ''; ?>">
                                        <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
