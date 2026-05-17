<?php
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
