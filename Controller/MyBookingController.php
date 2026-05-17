<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../Model/dataConnection.php";
require_once __DIR__ . "/../Model/MyBookingModel.php";

function sendJsonResponse($payload, $statusCode = 200)
{
    http_response_code($statusCode);
    header("Content-Type: application/json");
    echo json_encode($payload);
    exit;
}

if (!isset($_SESSION["user_id"])) {
    sendJsonResponse([
        "status" => "error",
        "message" => "Please log in first."
    ], 401);
}

$DB = new db();
$connection = $DB->connection();

$model = new MyBookingModel();
$action = $_POST["action"] ?? "";

if ($action === "getMyBookings") {
    $bookings = $model->getMyBookings($connection, $_SESSION["user_id"]);

    foreach ($bookings as &$booking) {
        $checkinTimestamp = strtotime($booking["checkin_date"]);
        $cancelDeadline = strtotime("+1 day");
        $booking["can_cancel"] = in_array($booking["status"], ["Pending", "Confirmed"]) && $checkinTimestamp > $cancelDeadline;
    }
    unset($booking);

    sendJsonResponse([
        "status" => "success",
        "data" => $bookings
    ]);
}

if ($action === "cancelBooking") {
    $bookingId = $_POST["booking_id"] ?? "";

    if ($bookingId === "" || !is_numeric($bookingId)) {
        sendJsonResponse([
            "status" => "error",
            "message" => "Invalid booking ID."
        ], 400);
    }

    $booking = $model->getBookingById($connection, $bookingId, $_SESSION["user_id"]);
    if (!$booking) {
        sendJsonResponse([
            "status" => "error",
            "message" => "Booking not found."
        ], 404);
    }

    $checkinTimestamp = strtotime($booking["checkin_date"]);
    $cancelDeadline = strtotime("+1 day");
    if (!in_array($booking["status"], ["Pending", "Confirmed"]) || $checkinTimestamp <= $cancelDeadline) {
        sendJsonResponse([
            "status" => "error",
            "message" => "This booking cannot be cancelled."
        ], 400);
    }

    $cancelled = $model->cancelBooking($connection, $bookingId, $_SESSION["user_id"]);
    if ($cancelled) {
        sendJsonResponse([
            "status" => "success",
            "message" => "Booking cancelled successfully."
        ]);
    } else {
        sendJsonResponse([
            "status" => "error",
            "message" => "Could not cancel booking."
        ], 500);
    }
}

sendJsonResponse([
    "status" => "error",
    "message" => "Invalid request."
], 400);
