<?php

if (isset($_POST['action']) && $_POST['action'] === 'Add') {

    $roomType = $_POST['roomType'] ?? '';
    $roomNumber = $_POST['roomNumber'] ?? '';
    $floor = $_POST['floor'] ?? '';
    $perNightRate = $_POST['perNightRate'] ?? '';

    if ($roomType === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Please select room type"
        ]);
        exit;
    }

    if ($roomNumber === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Room number is required"
        ]);
        exit;
    }

    if (!is_numeric($roomNumber)) {
        echo json_encode([
            "status" => "error",
            "message" => "Room number must be number"
        ]);
        exit;
    }

    if ($roomNumber <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Room number must be greater than 0"
        ]);
        exit;
    }

    if ($floor === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Floor is required"
        ]);
        exit;
    }

    if ($perNightRate === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Per night rate is required"
        ]);
        exit;
    }

    if (!is_numeric($perNightRate)) {
        echo json_encode([
            "status" => "error",
            "message" => "Per night rate must be number"
        ]);
        exit;
    }

    if ($perNightRate <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Per night rate must be greater than 0"
        ]);
        exit;
    }

    echo json_encode([
        "status" => "success",
        "message" => "Room added successfully"
    ]);
    exit;
}

echo json_encode([
    "status" => "error",
    "message" => "Invalid request"
]);
exit;

?>
