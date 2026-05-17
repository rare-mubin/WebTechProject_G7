<?php
session_start();

include "../Model/dataConnection.php";
include "../Model/BookingModel.php";
include "../Model/RoomModel.php";

function redirectWithBookingError($message)
{
    $query = $_POST;
    unset($query["guest_name"], $query["phone"], $query["email"], $query["nationality"]);
    $query["error"] = $message;

    header("Location: /WebTechProject_G7/Controller/BookingPageController.php?" . http_build_query($query));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
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
$bookingModel = new BookingModel($connection);

if ($userId === "") {
    $guest = $bookingModel->getLatestGuest();
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
    $roomId = $bookingModel->findAvailableRoomId($roomTypeId, $checkin, $checkout, $guests);
    if (!$roomId) {
        $connection->rollback();
        redirectWithBookingError("Sorry, this room type is no longer available for those dates.");
    }

    if (!$bookingModel->updateGuestContact($userId, $guestName, $email, $phone, $nationality)) {
        $connection->rollback();
        redirectWithBookingError("Could not update guest contact details.");
    }

    $bookingId = $bookingModel->createBooking($userId, $roomId, $checkin, $checkout, $totalPrice);
    if (!$bookingId) {
        $connection->rollback();
        redirectWithBookingError("Could not create booking.");
    }

    $connection->commit();
    header("Location: /WebTechProject_G7/Controller/BookingConfirmationController.php?booking_id=" . $bookingId);
    exit;
} catch (Throwable $exception) {
    $connection->rollback();
    redirectWithBookingError("Could not complete booking.");
}
?>
