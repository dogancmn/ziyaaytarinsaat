<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config.php';

// Sadece POST isteklerini kabul et
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Sadece POST istekleri kabul edilir']);
    exit;
}

// Form verilerini al
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$appointment_date = isset($_POST['appointment_date']) ? trim($_POST['appointment_date']) : '';
$appointment_time = isset($_POST['appointment_time']) ? trim($_POST['appointment_time']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validasyon
$errors = [];

if (empty($name)) {
    $errors[] = 'Ad alanı zorunludur';
}

if (empty($email)) {
    $errors[] = 'E-posta alanı zorunludur';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Geçerli bir e-posta adresi giriniz';
}

if (empty($mobile)) {
    $errors[] = 'Telefon numarası zorunludur';
}

if (empty($service)) {
    $errors[] = 'Hizmet seçimi zorunludur';
}

if (empty($appointment_date)) {
    $errors[] = 'Tarih seçimi zorunludur';
}

if (empty($appointment_time)) {
    $errors[] = 'Saat seçimi zorunludur';
}

// Hata varsa döndür
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Tarih formatını düzelt (datetimepicker'dan gelen formatı MySQL'e uygun hale getir)
// Örnek: "12/25/2024" -> "2024-12-25"
if (preg_match('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', $appointment_date, $matches)) {
    $appointment_date = sprintf('%04d-%02d-%02d', $matches[3], $matches[1], $matches[2]);
}

// Saat formatını düzelt (datetimepicker'dan gelen formatı MySQL'e uygun hale getir)
// Örnek: "2:30 PM" -> "14:30:00"
$appointment_time = date('H:i:s', strtotime($appointment_time));

// SQL injection koruması için prepared statement kullan
$stmt = $conn->prepare("INSERT INTO appointments (name, email, mobile, service, appointment_date, appointment_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $mobile, $service, $appointment_date, $appointment_time, $message);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Randevunuz başarıyla alındı! En kısa sürede size onay e-postası göndereceğiz.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
    ]);
}

$stmt->close();
$conn->close();
?>

