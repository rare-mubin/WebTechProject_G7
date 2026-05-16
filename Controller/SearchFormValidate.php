<?php
include "../Model/dataConnection.php";
include "../Model/RoomModel.php";
if (isset($_POST['action']) && $_POST['action'] === "searchRoom") {
    $checkIn = $_POST['checkIn'] ?? "";
    $checkOut = $_POST['checkOut'] ?? "";
    $guestNumber = $_POST['guestNumber'] ?? "";

    // if (empty($checkIn) || empty($checkOut) || empty($guestNumber) {
    //     echo json_encode([
    //         "status" => "error",
    //         "message" => "All fields are required"
    //     ]);
    //     exit;
    // }

    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkIn)) {
        echo json_encode([
            "status" => "error",
            "message" => "Check-in date is invalid"
        ]);
        exit;
    }

    elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $checkOut)) {
        echo json_encode([
            "status" => "error",
            "message" => "Check-out date is invalid"
        ]);
        exit;
    }

    elseif (strtotime($checkIn) < strtotime(date("Y-m-d"))) {
        echo json_encode([
            "status" => "error",
            "message" => "Check-in date must be today or later"
        ]);
        exit;
    }

    elseif (strtotime($checkOut) <= strtotime($checkIn)) {
        echo json_encode([
            "status" => "error",
            "message" => "Check-out date must be after check-in date"
        ]);
        exit;
    }

    // elseif (!is_numeric($guestNumber) || $guestNumber < 1) {
    //     echo json_encode([
    //         "status" => "error",
    //         "message" => "Guest number must be a valid number"
    //     ]);
    //     exit;
    // }

    else {
        $DB = new db();
        $connection = $DB->connection();
        $rooms = getroom($connection, $checkIn, $checkOut);
        
        print_r($rooms);
        // echo json_encode([
        //     "status" => "success",
        //     "message" => "Available rooms loaded successfully",
        //     "data" => $rooms
        // ]);
        echo json_encode($rooms);
        exit;
    }
}
?>