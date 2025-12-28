<?php
require_once __DIR__ . '/includes/config-loader.php';

// Check if already installed
try {
    $stmt = $conn->query("SELECT COUNT(*) as count FROM admin_users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        die('Admin paneli zaten kurulu! <a href="login.php">Giriş yapın</a>');
    }
} catch (PDOException $e) {
    // Tables don't exist, continue installation
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Read and execute SQL file
        $sql = file_get_contents('../database.sql');
        
        // Remove CREATE DATABASE and USE statements (database already exists)
        $sql = preg_replace('/CREATE DATABASE.*?;/i', '', $sql);
        $sql = preg_replace('/USE.*?;/i', '', $sql);
        
        // Split by semicolon and execute each statement
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^--/', $statement)) {
                try {
                    $conn->exec($statement);
                } catch (PDOException $e) {
                    // Ignore "table already exists" errors
                    if (strpos($e->getMessage(), 'already exists') === false) {
                        throw $e;
                    }
                }
            }
        }
        
        $message = 'Kurulum başarıyla tamamlandı! Admin paneline giriş yapabilirsiniz.';
    } catch (Exception $e) {
        $error = 'Kurulum sırasında bir hata oluştu: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Kurulumu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #113940 0%, #0d2d33 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .install-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
        }
        .install-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .install-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="install-card">
        <div class="install-header">
            <img src="../img/logo_ziya_aytar.png" alt="Logo" class="img-fluid">
            <h2>Admin Panel Kurulumu</h2>
            <p class="text-muted">Veritabanı tablolarını oluşturmak için devam edin</p>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i><?php echo $message; ?>
                <div class="mt-3">
                    <a href="login.php" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Giriş Yap
                    </a>
                </div>
            </div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Bu işlem aşağıdaki tabloları oluşturacak:
                <ul class="mb-0 mt-2">
                    <li>admin_users (Admin kullanıcıları)</li>
                    <li>projects (Projeler)</li>
                    <li>site_settings (Site ayarları)</li>
                </li>
                <li>Mevcut tablolar güncellenecek (contacts, appointments)</li>
            </div>
            
            <form method="POST">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-database me-2"></i>Kurulumu Başlat
                    </button>
                </div>
            </form>
            
            <div class="mt-4 text-center text-muted small">
                <p class="mb-0">Varsayılan giriş bilgileri:</p>
                <p class="mb-0"><strong>Kullanıcı:</strong> admin</p>
                <p class="mb-0"><strong>Şifre:</strong> admin123</p>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

