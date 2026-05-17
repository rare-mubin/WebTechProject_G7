<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../Model/dataConnection.php";
require_once __DIR__ . "/../Model/BookingModel.php";
require_once __DIR__ . "/../Model/RoomModel.php";

function sendJsonResponse($payload, $statusCode = 200)
{
    http_response_code($statusCode);
    header("Content-Type: application/json");
    echo json_encode($payload);
    exit;
}

function isJsonRequest()
{
    return (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) === "xmlhttprequest")
        || (isset($_SERVER["HTTP_ACCEPT"]) && strpos($_SERVER["HTTP_ACCEPT"], "application/json") !== false);
}

function redirectWithBookingError($message)
{
    if (isJsonRequest()) {
        sendJsonResponse([
            "status" => "error",
            "message" => $message
        ], 400);
    }

    $query = $_POST;
    unset($query["guest_name"], $query["phone"], $query["email"], $query["nationality"]);
    $query["error"] = $message;

    header("Location: /WebTechProject_G7/Controller/BookingPageController.php?" . http_build_query($query));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    if (isJsonRequest()) {
        sendJsonResponse([
            "status" => "error",
            "message" => "Invalid request method."
        ], 405);
    }

    header("Location: /WebTechProject_G7/View/guest/Homepage.php");
    exit;
}

$roomTypeId = $_POST["room_type_id"] ?? "";
$checkin = $_POST["checkin"] ?? "";
$checkout = $_POST["checkout"] ?? "";
$guests = $_POST["guests"] ?? "";
$guestName = trim($_POST["guest_name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$email = trim($_POST["email"] ?? "");
$nationality = trim($_POST["nationality"] ?? "");
$userId = $_SESSION["user_id"] ?? $_SESSION["id"] ?? ($_POST["user_id"] ?? "");

if ($roomTypeId === "" || $checkin === "" || $checkout === "" || $guests === "") {
    redirectWithBookingError("Booking details are missing.");
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkin) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkout)) {
    redirectWithBookingError("Booking dates are invalid.");
}

if (strtotime($checkin) < strtotime(date("Y-m-d"))) {
    redirectWithBookingError("Check-in date must be today or later.");
}

if (strtotime($checkout) <= strtotime($checkin)) {
    redirectWithBookingError("Check-out date must be after check-in date.");
}

if (!is_numeric($guests) || (int) $guests < 1) {
    redirectWithBookingError("Guest number must be valid.");
}

if ($guestName === "" || $phone === "" || $email === "" || $nationality === "") {
    redirectWithBookingError("Guest contact details are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithBookingError("Email address is invalid.");
}

$DB = new db();
$connection = $DB->connection();
$bookingModel = new BookingModel();

if ($userId === "") {
    $guest = $bookingModel->getLatestGuest($connection);
    $userId = $guest["id"] ?? "";
}

if ($userId === "") {
    redirectWithBookingError("Please create a guest profile before booking.");
}

$roomType = getRoomTypeById($connection, $roomTypeId);
if (!$roomType) {
    redirectWithBookingError("Selected room type was not found.");
}

if ($roomType["max_capacity"] < (int) $guests) {
    redirectWithBookingError("Selected room type cannot fit this number of guests.");
}

$nights = (int) ((strtotime($checkout) - strtotime($checkin)) / 86400);
$totalPrice = $nights * (float) $roomType["price_per_night"];

$connection->begin_transaction();

try {
    $roomId = $bookingModel->findAvailableRoomId($connection, $roomTypeId, $checkin, $checkout, $guests);
    if (!$roomId) {
        $connection->rollback();
        redirectWithBookingError("Sorry, this room type is no longer available for those dates.");
    }

    if (!$bookingModel->updateGuestContact($connection, $userId, $guestName, $email, $phone, $nationality)) {
        $connection->rollback();
        redirectWithBookingError("Could not update guest contact details.");
    }

    $bookingId = $bookingModel->createBooking($connection, $userId, $roomId, $checkin, $checkout, $totalPrice);
    if (!$bookingId) {
        $connection->rollback();
        redirectWithBookingError("Could not create booking.");
    }

    $connection->commit();

    if (isJsonRequest()) {
        sendJsonResponse([
            "status" => "success",
            "message" => "Booking created successfully.",
            "booking_id" => $bookingId,
            "redirect" => "/WebTechProject_G7/Controller/BookingConfirmationController.php?booking_id=" . $bookingId
        ], 200);
    }

    header("Location: /WebTechProject_G7/Controller/BookingConfirmationController.php?booking_id=" . $bookingId);
    exit;
} catch (Throwable $exception) {
    $connection->rollback();
    redirectWithBookingError("Could not complete booking.");
}
