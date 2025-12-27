<?php
// Veritabanı Bağlantı Ayarları - ÖRNEK DOSYA
// Bu dosyayı kopyalayıp config.php olarak kaydedin ve bilgilerinizi girin

define('DB_HOST', 'localhost'); // Genellikle localhost
define('DB_USER', 'veritabani_kullanici_adi'); // cPanel'den aldığınız kullanıcı adı
define('DB_PASS', 'veritabani_sifresi'); // cPanel'den aldığınız şifre
define('DB_NAME', 'veritabani_adi'); // cPanel'de oluşturduğunuz veritabanı adı

// Veritabanı bağlantısı
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Türkçe karakter desteği
    $conn->set_charset("utf8mb4");
    
    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>

