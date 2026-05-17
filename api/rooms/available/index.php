<?php
header("Content-Type: application/json");

include "../../../Model/dataConnection.php";
include "../../../Model/RoomModel.php";

function sendAvailableJson($payload, $statusCode = 200)
{
    http_response_code($statusCode);
    echo json_encode($payload);
    exit;
}

$checkIn = $_GET["checkin"] ?? $_GET["checkIn"] ?? "";
$checkOut = $_GET["checkout"] ?? $_GET["checkOut"] ?? "";
$guests = $_GET["guests"] ?? "";

if ($checkIn === "" || $checkOut === "" || $guests === "") {
    sendAvailableJson([
        "status" => "error",
        "message" => "All fields are required"
    ], 400);
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkIn)) {
    sendAvailableJson([
        "status" => "error",
        "message" => "Check-in date is invalid"
    ], 400);
}

if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkOut)) {
    sendAvailableJson([
        "status" => "error",
        "message" => "Check-out date is invalid"
    ], 400);
}

if (strtotime($checkIn) < strtotime(date("Y-m-d"))) {
    sendAvailableJson([
        "status" => "error",
        "message" => "Check-in date must be today or later"
    ], 400);
}

if (strtotime($checkOut) <= strtotime($checkIn)) {
    sendAvailableJson([
        "status" => "error",
        "message" => "Check-out date must be after check-in date"
    ], 400);
}

if (!is_numeric($guests) || (int) $guests < 1) {
    sendAvailableJson([
        "status" => "error",
        "message" => "Guest number must be a valid number"
    ], 400);
}

$DB = new db();
$connection = $DB->connection();

sendAvailableJson(getroom($connection, $checkIn, $checkOut, $guests));
?>
