<?php
// Example configuration file
// Copy this to config.php and fill in your database credentials
// For Railway/Render, use environment variables instead

$db_host = 'localhost';
$db_name = 'ziyaaytarinsaat';
$db_user = 'root';
$db_pass = '';

// Create connection
try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Veritabanı bağlantısı başarısız.");
}
?>

