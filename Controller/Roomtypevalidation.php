<?php

if (isset($_POST['action']) && $_POST['action'] === 'Add') {
    $roomtypeName = $_POST['roomtypeName'] ?? '';
    $perNightRate = $_POST['perNightRate'] ?? '';
    $description = $_POST['description'] ?? '';
    $maxCapacity = $_POST['maxCapacity'] ?? '';

    $wifi = $_POST['wifi'] ?? 0;
    $ac = $_POST['ac'] ?? 0;
    $smartTv = $_POST['smartTv'] ?? 0;
    $breakfast = $_POST['breakfast'] ?? 0;

    if ($roomtypeName === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Room type name is required"
        ]);
        exit;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $roomtypeName)) {
        echo json_encode([
            "status" => "error",
            "message" => "Only letters and white space allowed in room type name"
        ]);
        exit;
    }

    if (strlen($roomtypeName) < 4) {
        echo json_encode([
            "status" => "error",
            "message" => "Room type name should be more than 4 characters"
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

    if ($description === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Description is required"
        ]);
        exit;
    }

    if ($maxCapacity === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Max capacity is required"
        ]);
        exit;
    }

    if (!is_numeric($maxCapacity)) {
        echo json_encode([
            "status" => "error",
            "message" => "Max capacity must be number"
        ]);
        exit;
    }

    if ($maxCapacity <= 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Max capacity must be greater than 0"
        ]);
        exit;
    }

    if ($wifi == 0 && $ac == 0 && $smartTv == 0 && $breakfast == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Please select at least one amenity"
        ]);
        exit;
    }

    if (!isset($_FILES['roomImage']) || $_FILES['roomImage']['name'] === '') {
        echo json_encode([
            "status" => "error",
            "message" => "Room image is required"
        ]);
        exit;
    }

    echo json_encode([
        "status" => "success",
        "message" => "OK"
    ]);
    exit;
}

echo json_encode([
    "status" => "error",
    "message" => "Invalid request"
]);
exit;

?>
