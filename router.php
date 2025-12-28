<?php
// Router for PHP built-in server
// This file handles routing for static files and PHP files
// Admin panel is handled separately

// Start output buffering
if (!ob_get_level()) {
    ob_start();
}

$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Remove query string
$requestPath = strtok($requestPath, '?');

// Skip admin panel - let it handle its own routing
if (strpos($requestPath, '/admin') === 0) {
    // Admin panel requests - use admin router
    $adminRouter = __DIR__ . '/admin/router.php';
    if (file_exists($adminRouter)) {
        // Clear ALL output buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        // Preserve original REQUEST_URI for admin router
        $_SERVER['REQUEST_URI'] = $requestPath;
        // Change to admin directory to ensure correct paths
        $oldCwd = getcwd();
        chdir(__DIR__ . '/admin');
        // Include admin router - it will handle everything
        include $adminRouter;
        chdir($oldCwd);
        exit;
    }
    // Fallback: let PHP built-in server handle it directly
    return false;
}

// If it's a static file (css, js, img, lib, etc.), serve it directly
if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/i', $requestPath) || 
    strpos($requestPath, '/lib/') === 0 || 
    strpos($requestPath, '/css/') === 0 || 
    strpos($requestPath, '/js/') === 0 || 
    strpos($requestPath, '/img/') === 0 ||
    strpos($requestPath, '/maps/') === 0) {
    
    $filePath = __DIR__ . $requestPath;
    
    // Normalize path (remove double slashes, etc.)
    $filePath = str_replace('//', '/', $filePath);
    
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
    // File not found, return 404
    http_response_code(404);
    echo "404 - File not found: " . $requestPath;
    exit;
}

// If it's a directory, try index.php
if (is_dir(__DIR__ . $requestPath) && $requestPath !== '/') {
    $indexFile = __DIR__ . $requestPath . '/index.php';
    if (file_exists($indexFile)) {
        include $indexFile;
        return true;
    }
}

// If it's a PHP file, include it
if (preg_match('/\.php$/i', $requestPath)) {
    $filePath = __DIR__ . $requestPath;
    if (file_exists($filePath)) {
        include $filePath;
        return true;
    }
}

// Default: try index.php
if ($requestPath === '/' || $requestPath === '') {
    include __DIR__ . '/index.php';
    return true;
}

// 404
http_response_code(404);
echo "404 - Sayfa bulunamadı";
return true;

