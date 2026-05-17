<?php
function getroom($connection, $checkin, $checkout, $guests)
{
    if (!$connection) {
        return [];
    }

    $sql = "SELECT
                rt.id,
                rt.name,
                rt.description,
                rt.price_per_night,
                rt.max_capacity,
                rt.thumbnail_path,
                rt.amenities,
                (DATEDIFF(?, ?) * rt.price_per_night) AS total_price
            FROM room_types rt
            WHERE rt.max_capacity >= ?
            AND EXISTS (
                SELECT 1
                FROM rooms r
                WHERE r.room_type_id = rt.id
                AND r.status = 'available'
                AND NOT EXISTS (
                    SELECT 1
                    FROM bookings b
                    WHERE b.room_id = r.id
                    AND b.status IN ('Confirmed', 'Checked-In')
                    AND b.checkin_date < ?
                    AND b.checkout_date > ?
                )
            )
            ORDER BY rt.price_per_night ASC";

    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        return [];
    }

    $guestCount = (int) $guests;
    $stmt->bind_param("ssiss", $checkout, $checkin, $guestCount, $checkout, $checkin);
    $stmt->execute();
    $result = $stmt->get_result();

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

    $stmt->close();
    return $rooms;
}

function getRoomTypeById($connection, $roomTypeId)
{
    if (!$connection) {
        return null;
    }

    $stmt = $connection->prepare("SELECT * FROM room_types WHERE id = ?");
    if (!$stmt) {
        return null;
    }

    $id = (int) $roomTypeId;
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $roomType = $result->fetch_assoc();
    $stmt->close();

    if (!$roomType) {
        return null;
    }

    $amenities = json_decode($roomType["amenities"] ?? "[]", true);
    $roomType["amenities"] = is_array($amenities) ? $amenities : [];
    $roomType["price_per_night"] = (float) $roomType["price_per_night"];
    $roomType["max_capacity"] = (int) $roomType["max_capacity"];

    return $roomType;
require_once __DIR__ . "/dataConnection.php";

class RoomModel
{
    private $connection;

    public function __construct()
    {
        $db = new db();
        $this->connection = $db->connection();
    }

    public function listRooms()
    {
        $sql = "SELECT r.id, r.room_type_id, r.room_number, r.floor, r.status, "
            . "rt.name AS room_type_name, rt.price_per_night, rt.max_capacity, rt.thumbnail_path, rt.amenities "
            . "FROM rooms r JOIN room_types rt ON r.room_type_id = rt.id "
            . "ORDER BY r.room_number ASC";
        $result = $this->connection->query($sql);
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

    public function createRoom($roomTypeId, $roomNumber, $floor, $status)
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO rooms (room_type_id, room_number, floor, status) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isis", $roomTypeId, $roomNumber, $floor, $status);
        return $stmt->execute();
    }

    public function updateRoom($id, $roomTypeId, $roomNumber, $floor, $status)
    {
        $stmt = $this->connection->prepare(
            "UPDATE rooms SET room_type_id = ?, room_number = ?, floor = ?, status = ? WHERE id = ?"
        );
        $stmt->bind_param("isisi", $roomTypeId, $roomNumber, $floor, $status, $id);
        return $stmt->execute();
    }

    public function deleteRoom($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function roomTypeExists($roomTypeId)
    {
        $stmt = $this->connection->prepare("SELECT id FROM room_types WHERE id = ?");
        $stmt->bind_param("i", $roomTypeId);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function getLastError()
    {
        return $this->connection->error;
    }
}
?>
