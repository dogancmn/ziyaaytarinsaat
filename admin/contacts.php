<?php
$pageTitle = 'İletişim Mesajları';
require_once 'includes/header.php';
require_once 'includes/functions.php';

$view_id = $_GET['view'] ?? null;
$message = '';
$error = '';

// Delete contact
if (isset($_POST['delete']) && isset($conn)) {
    try {
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $message = 'Mesaj başarıyla silindi.';
    } catch (PDOException $e) {
        $error = 'Mesaj silinirken bir hata oluştu.';
    }
}

// Get single contact
$contact = null;
if ($view_id && isset($conn)) {
    try {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->bindParam(':id', $view_id);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error = 'Mesaj bulunamadı.';
    }
}

// Get all contacts
$contacts = [];
if (!$view_id && isset($conn)) {
    try {
        $stmt = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        $contacts = [];
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

<?php if ($view_id && $contact): ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Mesaj Detayı</h1>
        <a href="<?php echo ADMIN_BASE; ?>/contacts.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Geri Dön
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Ad Soyad:</strong><br>
                    <?php echo htmlspecialchars($contact['name'] ?? ''); ?>
                </div>
                <div class="col-md-6">
                    <strong>E-posta:</strong><br>
                    <a href="mailto:<?php echo htmlspecialchars($contact['email'] ?? ''); ?>">
                        <?php echo htmlspecialchars($contact['email'] ?? ''); ?>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($contact['subject'])): ?>
            <div class="mb-3">
                <strong>Konu:</strong><br>
                <?php echo htmlspecialchars($contact['subject']); ?>
            </div>
            <?php endif; ?>
            
            <div class="mb-3">
                <strong>Mesaj:</strong><br>
                <div class="p-3 bg-light rounded">
                    <?php echo nl2br(htmlspecialchars($contact['message'] ?? '')); ?>
                </div>
            </div>
            
            <div class="mb-3">
                <strong>Gönderim Tarihi:</strong><br>
                <?php echo formatDate($contact['created_at'] ?? ''); ?>
            </div>
            
            <div class="mt-4">
                <a href="mailto:<?php echo htmlspecialchars($contact['email'] ?? ''); ?>?subject=Re: <?php echo urlencode($contact['subject'] ?? 'İletişim'); ?>" class="btn btn-primary">
                    <i class="fas fa-reply me-2"></i>Yanıtla
                </a>
                <form method="POST" style="display: inline;" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?');">
                    <input type="hidden" name="id" value="<?php echo $contact['id'] ?? ''; ?>">
                    <button type="submit" name="delete" class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i>Sil
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php else: ?>
    <h1 class="h3 mb-4">İletişim Mesajları</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Ad Soyad</th>
                            <th>E-posta</th>
                            <th>Konu</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($contacts)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Henüz mesaj yok.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($contacts as $c): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($c['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($c['email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($c['subject'] ?? '-'); ?></td>
                                <td><?php echo formatDate($c['created_at'] ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo ADMIN_BASE; ?>/contacts.php?view=<?php echo $c['id'] ?? ''; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?');">
                                        <input type="hidden" name="id" value="<?php echo $c['id'] ?? ''; ?>">
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
