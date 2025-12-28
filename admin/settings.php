<?php
$pageTitle = 'Site Ayarları';
require_once 'includes/header.php';
require_once 'includes/functions.php';

if (!isAdmin()) {
    header('Location: ' . ADMIN_BASE . '/index.php');
    exit;
}

$message = '';
$error = '';

// Save settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($conn)) {
    try {
        foreach ($_POST as $key => $value) {
            if ($key !== 'submit') {
                updateSetting($key, $value);
            }
        }
        $message = 'Ayarlar başarıyla kaydedildi.';
    } catch (Exception $e) {
        $error = 'Ayarlar kaydedilirken bir hata oluştu.';
    }
}

// Get all settings
$settings = [];
if (isset($conn)) {
    try {
        $stmt = $conn->query("SELECT * FROM site_settings ORDER BY setting_key");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        foreach ($results as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    } catch (PDOException $e) {
        $settings = [];
    }
}
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

<h1 class="h3 mb-4">Site Ayarları</h1>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Genel Bilgiler</h5>
                    
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Adı</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_email" class="form-label">E-posta Adresi</label>
                        <input type="email" class="form-control" id="site_email" name="site_email" value="<?php echo htmlspecialchars($settings['site_email'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_phone" class="form-label">Telefon Numarası</label>
                        <input type="text" class="form-control" id="site_phone" name="site_phone" value="<?php echo htmlspecialchars($settings['site_phone'] ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_address" class="form-label">Adres</label>
                        <textarea class="form-control" id="site_address" name="site_address" rows="2"><?php echo htmlspecialchars($settings['site_address'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Açıklaması</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3"><?php echo htmlspecialchars($settings['site_description'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Görünüm</h5>
                    
                    <div class="mb-3">
                        <label for="primary_color" class="form-label">Ana Renk</label>
                        <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="<?php echo htmlspecialchars($settings['primary_color'] ?? '#113940'); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Yolu</label>
                        <input type="text" class="form-control" id="logo" name="logo" value="<?php echo htmlspecialchars($settings['logo'] ?? ''); ?>">
                        <small class="text-muted">Örnek: img/logo_ziya_aytar.png</small>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Ayarları Kaydet
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
