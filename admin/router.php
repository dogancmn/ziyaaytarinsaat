<?php
// Admin Panel Router
// Handles routing for admin panel only

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Remove query string
$requestPath = strtok($requestPath, '?');

// Remove /admin prefix if exists
if (strpos($requestPath, '/admin') === 0) {
    $requestPath = substr($requestPath, 6); // Remove '/admin'
}

// Normalize path
if (empty($requestPath) || $requestPath === '/') {
    $requestPath = '/index.php';
}

// Ensure path starts with /
if ($requestPath[0] !== '/') {
    $requestPath = '/' . $requestPath;
}

// If it's a static file (css, js, img, etc.), serve it directly
// Check for static files BEFORE processing PHP files
if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/i', $requestPath) ||
    strpos($requestPath, '/assets/') === 0) {
    
    // Try admin assets first
    $filePath = __DIR__ . $requestPath;
    
    // Normalize path
    $filePath = str_replace('//', '/', $filePath);
    
    // If not found in admin, try root directory (for images, etc.)
    if (!file_exists($filePath) && (strpos($requestPath, '/img/') === 0 || strpos($requestPath, '/css/') === 0 || strpos($requestPath, '/js/') === 0 || strpos($requestPath, '/lib/') === 0)) {
        $rootPath = dirname(__DIR__) . $requestPath;
        $rootPath = str_replace('//', '/', $rootPath);
        if (file_exists($rootPath) && is_file($rootPath)) {
            $filePath = $rootPath;
        }
    }
    
    if (file_exists($filePath) && is_file($filePath)) {
        // Set proper content type
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css' => 'text/css; charset=utf-8',
            'js' => 'application/javascript; charset=utf-8',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject'
        ];
        if (isset($mimeTypes[$ext])) {
            header('Content-Type: ' . $mimeTypes[$ext]);
        }
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }
    http_response_code(404);
    echo "404 - File not found: " . $requestPath;
    exit;
}

// If it's a PHP file, include it
if (preg_match('/\.php$/i', $requestPath)) {
    $filePath = __DIR__ . $requestPath;
    if (file_exists($filePath)) {
        // Clear any output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        // Start fresh output buffer
        ob_start();
        // Change to admin directory to ensure correct relative paths
        $oldCwd = getcwd();
        chdir(__DIR__);
        include $filePath;
        chdir($oldCwd);
        ob_end_flush();
        exit;
    }
}

// Default: try index.php
if ($requestPath === '/' || $requestPath === '') {
    include __DIR__ . '/index.php';
    exit;
}

// 404
http_response_code(404);
echo "404 - Sayfa bulunamadı";
exit;
