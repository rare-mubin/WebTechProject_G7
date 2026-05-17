<?php
require_once __DIR__ . "/../Model/RoomModel.php";
require_once __DIR__ . "/../Model/RoomTypeModel.php";

header("Content-Type: application/json");

function respondRoom($status, $message, $data = null)
{
    $payload = ["status" => $status, "message" => $message];
    if ($data !== null) {
        $payload["data"] = $data;
    }
    echo json_encode($payload);
    exit;
}

function validateRoomInput($connection, $model)
{
    $roomTypeId = trim($_POST["roomType"] ?? "");
    $roomNumber = trim($_POST["roomNumber"] ?? "");
    $floor = trim($_POST["floor"] ?? "");
    $status = trim($_POST["status"] ?? "available");
    $allowedStatuses = ["available", "maintenance"];

    if ($roomTypeId === "" || !ctype_digit($roomTypeId) || !$model->roomTypeExists($connection, (int) $roomTypeId)) {
        respondRoom("error", "Please select a valid room type");
    }
    if ($roomNumber === "") {
        respondRoom("error", "Room number is required");
    }
    if ($floor === "" || !ctype_digit($floor) || (int) $floor <= 0) {
        respondRoom("error", "Floor must be a positive whole number");
    }
    if (!in_array($status, $allowedStatuses, true)) {
        respondRoom("error", "Invalid room status");
    }

    return [
        "roomTypeId" => (int) $roomTypeId,
        "roomNumber" => $roomNumber,
        "floor" => (int) $floor,
        "status" => $status
    ];
}

try {
    $DB = new db();
    $connection = $DB->connection();
    $action = $_POST["action"] ?? "";
    $model = new RoomModel();

    if ($action === "listRooms") {
        respondRoom("success", "Room list loaded", $model->listRooms($connection));
    }

    if ($action === "listRoomTypes") {
        $roomTypeModel = new RoomTypeModel();
        respondRoom("success", "Room type list loaded", $roomTypeModel->listRoomTypes());
    }

    if ($action === "Add" || $action === "Update") {
        $id = (int) ($_POST["roomId"] ?? 0);
        $input = validateRoomInput($connection, $model);

        if ($action === "Add") {
            $saved = $model->createRoom($connection, $input["roomTypeId"], $input["roomNumber"], $input["floor"], $input["status"]);
        } else {
            if ($id <= 0) {
                respondRoom("error", "Invalid room");
            }
            $saved = $model->updateRoom($connection, $id, $input["roomTypeId"], $input["roomNumber"], $input["floor"], $input["status"]);
        }

        if (!$saved) {
            respondRoom("error", "Could not save room. " . $model->getLastError($connection));
        }

        respondRoom("success", $action === "Add" ? "Room added successfully" : "Room updated successfully");
    }

    if ($action === "Delete") {
        $id = (int) ($_POST["roomId"] ?? 0);
        if ($id <= 0) {
            respondRoom("error", "Invalid room");
        }
        if (!$model->deleteRoom($connection, $id)) {
            respondRoom("error", "Could not delete room. This room may have bookings.");
        }
        respondRoom("success", "Room deleted successfully");
    }

    respondRoom("error", "Invalid request");
} catch (Throwable $error) {
    respondRoom("error", $error->getMessage());
}
?>
