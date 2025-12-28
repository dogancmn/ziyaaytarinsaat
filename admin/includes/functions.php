<?php
// Load config if not already loaded
if (!defined('ADMIN_BASE')) {
    require_once __DIR__ . '/../config.php';
}

// Get site settings
function getSetting($key, $default = '') {
    global $conn;
    if (!isset($conn)) return $default;
    
    try {
        $stmt = $conn->prepare("SELECT setting_value FROM site_settings WHERE setting_key = :key");
        $stmt->bindParam(':key', $key);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['setting_value'] : $default;
    } catch (PDOException $e) {
        return $default;
    }
}

// Update site setting
function updateSetting($key, $value) {
    global $conn;
    if (!isset($conn)) return false;
    
    try {
        $stmt = $conn->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (:key, :value) 
                                ON DUPLICATE KEY UPDATE setting_value = :value, updated_at = CURRENT_TIMESTAMP");
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

// Generate slug from title
function generateSlug($title) {
    $turkish = ['ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü'];
    $english = ['c', 'g', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U'];
    $title = str_replace($turkish, $english, $title);
    $title = strtolower($title);
    $title = preg_replace('/[^a-z0-9]+/', '-', $title);
    $title = trim($title, '-');
    return $title;
}

// Format date
function formatDate($date, $format = 'd.m.Y H:i') {
    if (!$date) return '-';
    try {
        $dateObj = new DateTime($date);
        return $dateObj->format($format);
    } catch (Exception $e) {
        return '-';
    }
}

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Upload image
function uploadImage($file, $folder = 'img/projects/') {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Dosya yüklenemedi.'];
    }
    
    $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowed)) {
        return ['success' => false, 'message' => 'Geçersiz dosya formatı'];
    }
    
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'Dosya boyutu çok büyük (Max: 5MB)'];
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $uploadPath = dirname(__DIR__, 2) . '/' . $folder . $filename;
    
    $uploadDir = dirname($uploadPath);
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['success' => true, 'filename' => $folder . $filename];
    }
    
    return ['success' => false, 'message' => 'Dosya yüklenemedi'];
}

// Delete image
function deleteImage($path) {
    if ($path && file_exists(dirname(__DIR__, 2) . '/' . $path)) {
        return unlink(dirname(__DIR__, 2) . '/' . $path);
    }
    return false;
}
