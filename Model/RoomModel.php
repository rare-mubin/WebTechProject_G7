<?php
require_once __DIR__ . "/dataConnection.php";

function getroom($connection, $checkin, $checkout, $guests)
{
    if (!$connection) {
        return [];
    }

    $sql = "SELECT rt.id, rt.name, rt.description, rt.price_per_night, rt.max_capacity, rt.thumbnail_path, rt.amenities, 
    (DATEDIFF('".$checkout."', '".$checkin."') * rt.price_per_night) AS total_price FROM room_types rt WHERE rt.max_capacity >= '".$guests."' 
    AND EXISTS (SELECT 1 FROM rooms r WHERE r.room_type_id = rt.id AND r.status = 'available' AND NOT EXISTS (SELECT 1 FROM bookings b WHERE b.room_id = r.id AND b.status IN ('Confirmed', 'Checked-In') 
    AND b.checkin_date < '".$checkout."' AND b.checkout_date > '".$checkin."')) ORDER BY rt.price_per_night ASC";
    $result = $connection->query($sql);
    if (!$result) {
        return [];
    }

    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $amenities = json_decode($row["amenities"] ?? "[]", true);
        if (!is_array($amenities)) {
            $amenities = [];
        }

        $row["amenities"] = $amenities;
        $row["price_per_night"] = (float) $row["price_per_night"];
        $row["total_price"] = (float) $row["total_price"];
        $row["max_capacity"] = (int) $row["max_capacity"];

        $rooms[] = $row;
    }

    return $rooms;
}

function getRoomTypeById($connection, $roomTypeId)
{
    if (!$connection) {
        return null;
    }

    $sql = "SELECT * FROM room_types WHERE id = '".$roomTypeId."'";
    $result = $connection->query($sql);
    $roomType = $result->fetch_assoc();

    if (!$roomType) {
        return null;
    }

    $amenities = json_decode($roomType["amenities"] ?? "[]", true);
    $roomType["amenities"] = is_array($amenities) ? $amenities : [];
    $roomType["price_per_night"] = (float) $roomType["price_per_night"];
    $roomType["max_capacity"] = (int) $roomType["max_capacity"];

    return $roomType;
}

class RoomModel
{
    public function listRooms($connection)
    {
        $sql = "SELECT r.id, r.room_type_id, r.room_number, r.floor, r.status, rt.name AS room_type_name, rt.price_per_night, rt.max_capacity, rt.thumbnail_path, rt.amenities FROM rooms r JOIN room_types rt ON r.room_type_id = rt.id ORDER BY r.room_number ASC";
        $result = $connection->query($sql);
        $rows = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $decoded = json_decode($row["amenities"] ?? "[]", true);
                $row["amenities"] = is_array($decoded) ? $decoded : [];
                $rows[] = $row;
            }
        }

        return $rows;
    }

    public function createRoom($connection, $roomTypeId, $roomNumber, $floor, $status)
    {
        $sql = "INSERT INTO rooms (room_type_id, room_number, floor, status) VALUES ('".$roomTypeId."', '".$roomNumber."', '".$floor."', '".$status."')";
        $result = $connection->query($sql);
        return $result;
    }

    public function updateRoom($connection, $id, $roomTypeId, $roomNumber, $floor, $status)
    {
        $sql = "UPDATE rooms SET room_type_id = '".$roomTypeId."', room_number = '".$roomNumber."', floor = '".$floor."', status = '".$status."' WHERE id = '".$id."'";
        $result = $connection->query($sql);
        return $result;
    }

    public function deleteRoom($connection, $id)
    {
        $sql = "DELETE FROM rooms WHERE id = '".$id."'";
        $result = $connection->query($sql);
        return $result;
    }

    public function roomTypeExists($connection, $roomTypeId)
    {
        $sql = "SELECT id FROM room_types WHERE id = '".$roomTypeId."'";
        $result = $connection->query($sql);
        return $result && $result->num_rows > 0;
    }

    public function getLastError($connection)
    {
        return $connection->error;
    }
}
