<?php
header("Content-Type: application/json");

include "../Model/dataConnection.php";
include "../Model/RoomModel.php";

function sendJson($payload, $statusCode = 200)
{
    http_response_code($statusCode);
    echo json_encode($payload);
    exit;
}

$methodData = $_SERVER["REQUEST_METHOD"] === "GET" ? $_GET : $_POST;
$action = $methodData["action"] ?? "searchRoom";

if ($action !== "searchRoom") {
    sendJson([
        "status" => "error",
        "message" => "Invalid request"
    ], 400);
}

$checkIn = $methodData["checkIn"] ?? $methodData["checkin"] ?? "";
$checkOut = $methodData["checkOut"] ?? $methodData["checkout"] ?? "";
$guestNumber = $methodData["guests"] ?? $methodData["guestNumber"] ?? "";

if ($checkIn === "" || $checkOut === "" || $guestNumber === "") {
    sendJson([
        "status" => "error",
        "message" => "All fields are required"
    ], 400);
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkIn)) {
    sendJson([
        "status" => "error",
        "message" => "Check-in date is invalid"
    ], 400);
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkOut)) {
    sendJson([
        "status" => "error",
        "message" => "Check-out date is invalid"
    ], 400);
}

if (strtotime($checkIn) < strtotime(date("Y-m-d"))) {
    sendJson([
        "status" => "error",
        "message" => "Check-in date must be today or later"
    ], 400);
}

if (strtotime($checkOut) <= strtotime($checkIn)) {
    sendJson([
        "status" => "error",
        "message" => "Check-out date must be after check-in date"
    ], 400);
}

if (!is_numeric($guestNumber) || (int) $guestNumber < 1) {
    sendJson([
        "status" => "error",
        "message" => "Guest number must be a valid number"
    ], 400);
}

$DB = new db();
$connection = $DB->connection();
$rooms = getroom($connection, $checkIn, $checkOut, $guestNumber);

sendJson([
    "status" => "success",
    "message" => "Available rooms loaded successfully",
    "data" => $rooms
]);
?>
