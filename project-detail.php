<?php
require_once 'config.php';

$slug = $_GET['slug'] ?? '';

if (empty($slug)) {
    header('Location: project.php');
    exit;
}

try {
    $stmt = $conn->prepare("SELECT * FROM projects WHERE slug = :slug AND status = 'published'");
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$project) {
        header('Location: project.php');
        exit;
    }
    
    // Update view count
    $updateStmt = $conn->prepare("UPDATE projects SET view_count = view_count + 1 WHERE id = :id");
    $updateStmt->bindParam(':id', $project['id']);
    $updateStmt->execute();
    
    // Get related projects
    $relatedStmt = $conn->prepare("SELECT * FROM projects WHERE city = :city AND id != :id AND status = 'published' ORDER BY created_at DESC LIMIT 3");
    $relatedStmt->bindParam(':city', $project['city']);
    $relatedStmt->bindParam(':id', $project['id']);
    $relatedStmt->execute();
    $relatedProjects = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    header('Location: project.php');
    exit;
}

$pageTitle = $project['title'] . " - Ziya Aytar Yapı İnşaat";
$pageDescription = $project['description'] ?? $project['title'];
include "includes/header.php";
?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown"><?php echo htmlspecialchars($project['title']); ?></h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb text-uppercase mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="index.php">Ana Sayfa</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="project.php">Projeler</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page"><?php echo htmlspecialchars($project['title']); ?></li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Project Detail Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if ($project['image']): ?>
                <div class="mb-4">
                    <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="img-fluid rounded">
                </div>
                <?php endif; ?>
                
                <div class="mb-4">
                    <h2 class="mb-3"><?php echo htmlspecialchars($project['title']); ?></h2>
                    <?php if ($project['description']): ?>
                    <p class="lead text-muted"><?php echo htmlspecialchars($project['description']); ?></p>
                    <?php endif; ?>
                </div>
                
                <?php if ($project['content']): ?>
                <div class="project-content">
                    <?php echo nl2br(htmlspecialchars($project['content'])); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Proje Bilgileri</h5>
                        
                        <div class="mb-3">
                            <strong><i class="fas fa-map-marker-alt text-primary me-2"></i>Şehir:</strong><br>
                            <span class="text-muted"><?php echo htmlspecialchars($project['city']); ?></span>
                        </div>
                        
                        <div class="mb-3">
                            <strong><i class="fas fa-calendar text-primary me-2"></i>Oluşturulma:</strong><br>
                            <span class="text-muted"><?php echo date('d.m.Y', strtotime($project['created_at'])); ?></span>
                        </div>
                        
                        <?php if ($project['view_count']): ?>
                        <div class="mb-3">
                            <strong><i class="fas fa-eye text-primary me-2"></i>Görüntülenme:</strong><br>
                            <span class="text-muted"><?php echo number_format($project['view_count']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <hr>
                        
                        <a href="contact.php" class="btn btn-primary w-100">
                            <i class="fas fa-envelope me-2"></i>İletişime Geçin
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if (!empty($relatedProjects)): ?>
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">İlgili Projeler</h3>
                <div class="row g-4">
                    <?php foreach ($relatedProjects as $related): ?>
                    <div class="col-md-4">
                        <div class="project-item position-relative overflow-hidden">
                            <?php if ($related['image']): ?>
                            <img class="img-fluid w-100" src="<?php echo htmlspecialchars($related['image']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>" style="height: 250px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="project-overlay">
                                <div class="project-content">
                                    <h4 class="text-white mb-2"><?php echo htmlspecialchars($related['title']); ?></h4>
                                    <p class="text-white mb-3"><?php echo htmlspecialchars($related['city']); ?></p>
                                    <a href="project-detail.php?slug=<?php echo htmlspecialchars($related['slug']); ?>" class="btn btn-primary btn-sm">Detayları Gör</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- Project Detail End -->

<?php include "includes/footer.php"; ?>

