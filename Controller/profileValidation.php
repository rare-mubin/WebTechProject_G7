<?php
session_start();

require_once __DIR__ . '/../Model/dataConnection.php';
require_once __DIR__ . '/../Model/profileModel.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please log in first.'
    ]);
    exit;
}

try {
    $db = new db();
    $connection = $db->connection();
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed.'
    ]);
    exit;
}

if (!isset($_POST['action']) || $_POST['action'] !== 'updateProfile') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request.'
    ]);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');
$preferredRoomTypeId = trim($_POST['preferred_room_type_id'] ?? '');
$specialRequests = trim($_POST['special_requests'] ?? '');
$subscribeOffers = ($_POST['subscribe_offers'] ?? '0') === '1' ? '1' : '0';

if ($name === '' || $email === '' || $phone === '' || $nationality === '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Name, email, phone, and nationality are required.'
    ]);
    exit;
}

if (!preg_match("/^[a-zA-Z-' ]*$/", $name) || strlen($name) < 3) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Name must be at least 3 characters and contain only letters and spaces.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid email format.'
    ]);
    exit;
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Phone must be exactly 10 digits.'
    ]);
    exit;
}

$profileModel = new ProfileModel();
$roomTypes = $profileModel->getRoomTypes($connection);

if ($preferredRoomTypeId !== '') {
    $validRoomTypeIds = array_map('strval', array_column($roomTypes, 'id'));

    if (!in_array((string) $preferredRoomTypeId, $validRoomTypeIds, true)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Selected room type is invalid.'
        ]);
        exit;
    }
}

$updated = $profileModel->updateProfile(
    $connection,
    $_SESSION['user_id'],
    $name,
    $email,
    $phone,
    $nationality,
    $preferredRoomTypeId,
    $specialRequests
);

if (!$updated) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Could not save profile changes.'
    ]);
    exit;
}

$_SESSION['name'] = $name;

setcookie('subscribe_offers', $subscribeOffers, time() + (365 * 24 * 60 * 60), '/');

echo json_encode([
    'status' => 'success',
    'message' => 'Profile updated successfully.'
]);
?>
