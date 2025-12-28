<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load config if not already loaded
if (!defined('ADMIN_BASE')) {
    require_once __DIR__ . '/../config.php';
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

// Redirect to login if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        $loginUrl = ADMIN_BASE . '/login.php';
        header('Location: ' . $loginUrl);
        exit;
    }
}

// Get current admin user
function getCurrentAdmin() {
    global $conn;
    if (!isLoggedIn() || !isset($conn)) {
        return null;
    }
    
    try {
        $stmt = $conn->prepare("SELECT id, username, email, full_name, role FROM admin_users WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION['admin_id']);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin ?: null;
    } catch (PDOException $e) {
        error_log("getCurrentAdmin error: " . $e->getMessage());
        return null;
    }
}

// Check if user has admin role
function isAdmin() {
    $admin = getCurrentAdmin();
    return $admin && $admin['role'] === 'admin';
}

// Logout function
function logout() {
    session_unset();
    session_destroy();
    header('Location: ' . ADMIN_BASE . '/login.php');
    exit;
}
