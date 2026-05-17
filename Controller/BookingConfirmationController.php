<?php
require_once __DIR__ . "/../Model/dataConnection.php";
require_once __DIR__ . "/../Model/BookingModel.php";

$bookingId = $_GET["booking_id"] ?? "";
$booking = null;

if ($bookingId !== "") {
    $DB = new db();
    $connection = $DB->connection();
    $bookingModel = new BookingModel($connection);
    $booking = $bookingModel->getBookingConfirmation($bookingId);
}

require __DIR__ . "/../View/guest/pages/BookingConfirmation.php";
