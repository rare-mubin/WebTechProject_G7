<?php
require_once __DIR__ . "/../Model/RoomTypeModel.php";

header("Content-Type: application/json");

$allowedAmenities = ["WiFi", "AC", "TV", "Minibar", "Safe", "Bathtub", "Balcony"];

function respond($status, $message, $data = null)
{
    $payload = ["status" => $status, "message" => $message];
    if ($data !== null) {
        $payload["data"] = $data;
    }
    echo json_encode($payload);
    exit;
}

function validateRoomTypeInput($allowedAmenities, $imageRequired)
{
    $name = trim($_POST["roomtypeName"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $pricePerNight = trim($_POST["perNightRate"] ?? "");
    $maxCapacity = trim($_POST["maxCapacity"] ?? "");
    $amenities = $_POST["amenities"] ?? [];

    if (!is_array($amenities)) {
        $amenities = [];
    }

    $amenities = array_values(array_intersect($allowedAmenities, $amenities));

    if ($name === "") {
        respond("error", "Room type name is required");
    }
    if (!preg_match("/^[a-zA-Z0-9-' ]+$/", $name)) {
        respond("error", "Room type name can only contain letters, numbers, spaces, apostrophes, and hyphens");
    }
    if (strlen($name) < 4) {
        respond("error", "Room type name should be more than 4 characters");
    }
    if ($pricePerNight === "" || !is_numeric($pricePerNight) || $pricePerNight <= 0) {
        respond("error", "Per night rate must be a positive number");
    }
    if ($description === "") {
        respond("error", "Description is required");
    }
    if ($maxCapacity === "" || !ctype_digit($maxCapacity) || (int) $maxCapacity <= 0) {
        respond("error", "Max capacity must be a positive whole number");
    }
    if (count($amenities) === 0) {
        respond("error", "Please select at least one amenity");
    }
    if ($imageRequired && (!isset($_FILES["roomImage"]) || $_FILES["roomImage"]["error"] === UPLOAD_ERR_NO_FILE)) {
        respond("error", "Room image is required");
    }

    return [
        "name" => $name,
        "description" => $description,
        "pricePerNight" => (float) $pricePerNight,
        "maxCapacity" => (int) $maxCapacity,
        "amenities" => $amenities
    ];
}

function saveUploadedImage($fieldName)
{
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]["error"] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $file = $_FILES[$fieldName];

    if ($file["error"] !== UPLOAD_ERR_OK) {
        respond("error", "Image upload failed");
    }
    if ($file["size"] > 2 * 1024 * 1024) {
        respond("error", "Room image must be 2 MB or smaller");
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file["tmp_name"]);
    $extensions = ["image/jpeg" => "jpg", "image/png" => "png"];

    if (!isset($extensions[$mime])) {
        respond("error", "Room image must be a JPEG or PNG file");
    }

    $uploadDir = __DIR__ . "/../public/uploads/rooms/";
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        respond("error", "Could not create room upload directory");
    }

    $filename = "room_" . date("YmdHis") . "_" . bin2hex(random_bytes(4)) . "." . $extensions[$mime];
    $target = $uploadDir . $filename;

    if (!move_uploaded_file($file["tmp_name"], $target)) {
        respond("error", "Could not save room image");
    }

    return "public/uploads/rooms/" . $filename;
}

try {
    $action = $_POST["action"] ?? "";
    $model = new RoomTypeModel();

    if ($action === "listRoomTypes") {
        respond("success", "Room type list loaded", $model->listRoomTypes());
    }

    if ($action === "Add" || $action === "Update") {
        $id = (int) ($_POST["roomTypeId"] ?? 0);
        $input = validateRoomTypeInput($allowedAmenities, $action === "Add");
        $thumbnailPath = saveUploadedImage("roomImage");

        if ($action === "Add") {
            $saved = $model->createRoomType(
                $input["name"],
                $input["description"],
                $input["pricePerNight"],
                $input["maxCapacity"],
                $thumbnailPath,
                $input["amenities"]
            );
        } else {
            if ($id <= 0) {
                respond("error", "Invalid room type");
            }
            $saved = $model->updateRoomType(
                $id,
                $input["name"],
                $input["description"],
                $input["pricePerNight"],
                $input["maxCapacity"],
                $thumbnailPath,
                $input["amenities"]
            );
        }

        if (!$saved) {
            respond("error", "Could not save room type. " . $model->getLastError());
        }

        respond("success", $action === "Add" ? "Room type added successfully" : "Room type updated successfully");
    }

    if ($action === "Delete") {
        $id = (int) ($_POST["roomTypeId"] ?? 0);
        if ($id <= 0) {
            respond("error", "Invalid room type");
        }
        if (!$model->deleteRoomType($id)) {
            respond("error", "Could not delete room type. Remove linked rooms first if this type is in use.");
        }
        respond("success", "Room type deleted successfully");
    }

    respond("error", "Invalid request");
} catch (Throwable $error) {
    respond("error", $error->getMessage());
}
?>
