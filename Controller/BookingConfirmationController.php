<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../Model/dataConnection.php";
require_once __DIR__ . "/../Model/BookingModel.php";

$bookingId = $_GET["booking_id"] ?? "";
$booking = null;

if ($bookingId !== "") {
    $DB = new db();
    $connection = $DB->connection();
    $bookingModel = new BookingModel();
    $booking = $bookingModel->getBookingConfirmation($connection, $bookingId);
}

require __DIR__ . "/../View/guest/pages/BookingConfirmation.php";
