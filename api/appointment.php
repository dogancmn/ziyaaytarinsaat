<?php
header('Content-Type: application/json; charset=utf-8');
require_once dirname(__DIR__) . '/config.php';

// Check if database connection exists
if (!isset($conn) || $conn === null) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => 'Veritabanı bağlantısı yok. Lütfen config.php dosyasını kontrol edin.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST istekleri kabul edilir.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$service = trim($_POST['service'] ?? '');
$appointment_date = trim($_POST['appointment_date'] ?? '');
$appointment_time = trim($_POST['appointment_time'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validation
if (empty($name) || empty($email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Lütfen ad ve e-posta alanlarını doldurun.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Geçerli bir e-posta adresi girin.']);
    exit;
}

// Combine date and time if both provided
$appointment_datetime = null;
if (!empty($appointment_date) && !empty($appointment_time)) {
    $appointment_datetime = $appointment_date . ' ' . $appointment_time;
} elseif (!empty($appointment_date)) {
    $appointment_datetime = $appointment_date . ' 00:00:00';
}

try {
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, mobile, service, appointment_date, appointment_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $mobile, $service, $appointment_datetime, $appointment_time, $message]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Randevunuz başarıyla oluşturuldu. En kısa sürede size onay e-postası göndereceğiz.'
    ]);
} catch(PDOException $e) {
    error_log("Appointment form error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.']);
}
?>

