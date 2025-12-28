<?php
session_start();
require_once __DIR__ . '/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Kullanıcı adı ve şifre gereklidir.';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, username, email, password, full_name, role FROM admin_users WHERE username = :username OR email = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];
                
                // Update last login
                $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = CURRENT_TIMESTAMP WHERE id = :id");
                $updateStmt->bindParam(':id', $user['id']);
                $updateStmt->execute();
                
                header('Location: ' . ADMIN_BASE . '/index.php');
                exit;
            } else {
                $error = 'Kullanıcı adı veya şifre hatalı.';
            }
        } catch (PDOException $e) {
            $error = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        }
    }
}

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: ' . ADMIN_BASE . '/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi - Ziya Aytar Yapı İnşaat</title>
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
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #113940 0%, #0d2d33 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .login-header img {
            max-width: 150px;
            margin-bottom: 20px;
            filter: brightness(0) invert(1);
        }
        .login-header h2 {
            margin: 0;
            font-weight: 600;
        }
        .login-body {
            padding: 40px 30px;
        }
        .form-control:focus {
            border-color: #113940;
            box-shadow: 0 0 0 0.2rem rgba(17, 57, 64, 0.25);
        }
        .btn-primary {
            background: #113940;
            border-color: #113940;
        }
        .btn-primary:hover {
            background: #0d2d33;
            border-color: #0d2d33;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <img src="/img/logo_ziya_aytar.png" alt="Logo" class="img-fluid" onerror="this.style.display='none'">
            <h2>Admin Paneli</h2>
            <p class="mb-0">Yönetim paneline giriş yapın</p>
        </div>
        <div class="login-body">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">
                        <i class="fas fa-user me-2"></i>Kullanıcı Adı veya E-posta
                    </label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Şifre
                    </label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="fas fa-sign-in-alt me-2"></i>Giriş Yap
                </button>
            </form>
            
            <div class="mt-4 text-center text-muted small">
                <p class="mb-0">Varsayılan: admin / admin123</p>
                <p class="mb-0 mt-2"><small>İlk girişten sonra şifrenizi değiştirin!</small></p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
