<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../Model/dataConnection.php";
require_once __DIR__ . "/../Model/RoomModel.php";
require_once __DIR__ . "/../Model/BookingModel.php";

$roomTypeId = $_GET["room_type_id"] ?? "";
$checkin = $_GET["checkin"] ?? "";
$checkout = $_GET["checkout"] ?? "";
$guests = $_GET["guests"] ?? "1";
$error = $_GET["error"] ?? "";

$DB = new db();
$connection = $DB->connection();
$bookingModel = new BookingModel();

$roomType = $roomTypeId !== "" ? getRoomTypeById($connection, $roomTypeId) : null;
$nights = 0;
$totalPrice = 0;

if ($checkin !== "" && $checkout !== "" && strtotime($checkout) > strtotime($checkin)) {
    $nights = (int) ((strtotime($checkout) - strtotime($checkin)) / 86400);
}

if ($roomType && $nights > 0) {
    $totalPrice = $nights * (float) $roomType["price_per_night"];
}

$userId = $_SESSION["user_id"] ?? $_SESSION["id"] ?? "";
$guest = $userId !== "" ? $bookingModel->getGuestById($connection, $userId) : null;

if (!$guest) {
    $guest = $bookingModel->getLatestGuest($connection);
    $userId = $guest["id"] ?? "";
}

$guestName = $_GET["guest_name"] ?? ($guest["name"] ?? "");
$phone = $_GET["phone"] ?? ($guest["phone"] ?? "");
$email = $_GET["email"] ?? ($guest["email"] ?? "");
$nationality = $_GET["nationality"] ?? ($guest["nationality"] ?? "");
$roomName = $roomType["name"] ?? "Select a room";
$amenities = $roomType["amenities"] ?? [];

require __DIR__ . "/../View/guest/pages/Bookingpage.php";
