<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../Model/dataConnection.php';
require_once __DIR__ . '/../Model/MyBookingModel.php';

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

$model = new MyBookingModel();
$action = $_POST['action'] ?? '';

if ($action === 'getMyBookings') {
    $bookings = $model->getMyBookings($connection, $_SESSION['user_id']);

    foreach ($bookings as &$booking) {
        $checkinTimestamp = strtotime($booking['checkin_date']);
        $cancelDeadline = strtotime('+1 day');
        $booking['can_cancel'] = in_array($booking['status'], ['Pending', 'Confirmed']) && $checkinTimestamp > $cancelDeadline;
    }
    unset($booking);

    echo json_encode([
        'status' => 'success',
        'data' => $bookings
    ]);
    exit;
}

if ($action === 'cancelBooking') {
    $bookingId = $_POST['booking_id'] ?? '';

    if ($bookingId === '' || !is_numeric($bookingId)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid booking ID.'
        ]);
        exit;
    }

    $booking = $model->getBookingById($connection, $bookingId, $_SESSION['user_id']);
    if (!$booking) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Booking not found.'
        ]);
        exit;
    }

    $checkinTimestamp = strtotime($booking['checkin_date']);
    $cancelDeadline = strtotime('+1 day');
    if (!in_array($booking['status'], ['Pending', 'Confirmed']) || $checkinTimestamp <= $cancelDeadline) {
        echo json_encode([
            'status' => 'error',
            'message' => 'This booking cannot be cancelled.'
        ]);
        exit;
    }

    $cancelled = $model->cancelBooking($connection, $bookingId, $_SESSION['user_id']);
    if ($cancelled) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Booking cancelled successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Could not cancel booking.'
        ]);
    }
    exit;
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request.'
]);
exit;
?>
