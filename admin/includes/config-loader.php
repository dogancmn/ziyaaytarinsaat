<?php
// Centralized config loader for admin panel
// This ensures config.php is loaded correctly regardless of file location

// This file is in admin/includes/, so go up 2 levels to reach root
$rootDir = dirname(__DIR__, 2);
$configPath = $rootDir . '/config.php';

if (file_exists($configPath)) {
    require_once $configPath;
} else {
    die('Config dosyası bulunamadı: ' . $configPath . '<br>Lütfen config.php dosyasının root dizinde olduğundan emin olun.');
}

