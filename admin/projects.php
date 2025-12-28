<?php
$pageTitle = 'Projeler';
require_once 'includes/header.php';
require_once 'includes/functions.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$message = '';
$error = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        try {
            if (isset($conn)) {
                $stmt = $conn->prepare("SELECT image FROM projects WHERE id = :id");
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->execute();
                $project = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($project && !empty($project['image'])) {
                    deleteImage($project['image']);
                }
                
                $stmt = $conn->prepare("DELETE FROM projects WHERE id = :id");
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->execute();
                
                $message = 'Proje başarıyla silindi.';
            }
        } catch (PDOException $e) {
            $error = 'Proje silinirken bir hata oluştu.';
        }
    } else {
        // Save project
        $title = sanitize($_POST['title'] ?? '');
        $slug = !empty($_POST['slug']) ? sanitize($_POST['slug']) : generateSlug($title);
        $city = sanitize($_POST['city'] ?? '');
        $description = $_POST['description'] ?? '';
        $content = $_POST['content'] ?? '';
        $status = $_POST['status'] ?? 'draft';
        $featured = isset($_POST['featured']) ? 1 : 0;
        
        // Handle image upload
        $image = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadImage($_FILES['image'], 'img/projects/');
            if ($upload['success']) {
                if ($image) deleteImage($image);
                $image = $upload['filename'];
            } else {
                $error = $upload['message'];
            }
        }
        
        if (empty($error) && isset($conn)) {
            try {
                if ($id) {
                    $stmt = $conn->prepare("UPDATE projects SET title = :title, slug = :slug, city = :city, description = :description, content = :content, image = :image, status = :status, featured = :featured WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                } else {
                    $stmt = $conn->prepare("INSERT INTO projects (title, slug, city, description, content, image, status, featured) VALUES (:title, :slug, :city, :description, :content, :image, :status, :featured)");
                }
                
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':featured', $featured);
                $stmt->execute();
                
                $message = $id ? 'Proje başarıyla güncellendi.' : 'Proje başarıyla eklendi.';
                $action = 'list';
            } catch (PDOException $e) {
                $error = 'Proje kaydedilirken bir hata oluştu: ' . $e->getMessage();
            }
        }
    }
}

// Get project for edit
$project = null;
if ($action === 'edit' && $id && isset($conn)) {
    try {
        $stmt = $conn->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$project) {
            $action = 'list';
        }
    } catch (PDOException $e) {
        $error = 'Proje bulunamadı.';
        $action = 'list';
    }
}

// List projects
$projects = [];
if ($action === 'list' && isset($conn)) {
    try {
        $stmt = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        $projects = [];
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

<?php if ($action === 'list'): ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Projeler</h1>
        <a href="<?php echo ADMIN_BASE; ?>/projects.php?action=add" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Yeni Proje Ekle
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover data-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Başlık</th>
                            <th>Şehir</th>
                            <th>Durum</th>
                            <th>Öne Çıkan</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Henüz proje eklenmemiş.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($projects as $p): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($p['image'])): ?>
                                        <img src="/<?php echo htmlspecialchars($p['image']); ?>" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                    <?php else: ?>
                                        <div style="width: 60px; height: 60px; background: #e9ecef; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($p['title'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($p['city'] ?? ''); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo ($p['status'] ?? 'draft') === 'published' ? 'success' : 'secondary'; ?>">
                                        <?php echo ($p['status'] ?? 'draft') === 'published' ? 'Yayında' : 'Taslak'; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($p['featured'])): ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo formatDate($p['created_at'] ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo ADMIN_BASE; ?>/projects.php?action=edit&id=<?php echo $p['id'] ?? ''; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Bu projeyi silmek istediğinize emin misiniz?');">
                                        <input type="hidden" name="id" value="<?php echo $p['id'] ?? ''; ?>">
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

<?php else: ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><?php echo $id ? 'Proje Düzenle' : 'Yeni Proje Ekle'; ?></h1>
        <a href="<?php echo ADMIN_BASE; ?>/projects.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Geri Dön
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık *</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="slug" class="form-label">URL Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($project['slug'] ?? ''); ?>">
                            <small class="text-muted">Boş bırakılırsa başlıktan otomatik oluşturulur.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="city" class="form-label">Şehir *</label>
                            <select class="form-select" id="city" name="city" required>
                                <option value="">Seçiniz</option>
                                <option value="Antalya" <?php echo ($project['city'] ?? '') === 'Antalya' ? 'selected' : ''; ?>>Antalya</option>
                                <option value="İstanbul" <?php echo ($project['city'] ?? '') === 'İstanbul' ? 'selected' : ''; ?>>İstanbul</option>
                                <option value="Mersin" <?php echo ($project['city'] ?? '') === 'Mersin' ? 'selected' : ''; ?>>Mersin</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Kısa Açıklama</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">İçerik</label>
                            <textarea class="form-control" id="content" name="content" rows="10"><?php echo htmlspecialchars($project['content'] ?? ''); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Görsel</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <?php if (!empty($project['image'])): ?>
                                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($project['image']); ?>">
                                <img src="/<?php echo htmlspecialchars($project['image']); ?>" class="img-preview mt-2">
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Durum</label>
                            <select class="form-select" id="status" name="status">
                                <option value="draft" <?php echo ($project['status'] ?? 'draft') === 'draft' ? 'selected' : ''; ?>>Taslak</option>
                                <option value="published" <?php echo ($project['status'] ?? '') === 'published' ? 'selected' : ''; ?>>Yayında</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" <?php echo (!empty($project['featured'])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="featured">
                                    Öne Çıkan Proje
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Kaydet
                    </button>
                    <a href="<?php echo ADMIN_BASE; ?>/projects.php" class="btn btn-outline-secondary">İptal</a>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
