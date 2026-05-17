<?php
require_once __DIR__ . "/dataConnection.php";

class RoomTypeModel
{
    private $connection;

    public function __construct()
    {
        $db = new db();
        $this->connection = $db->connection();
        $this->ensureNameColumnAcceptsCustomValues();
    }

    private function ensureNameColumnAcceptsCustomValues()
    {
        $result = $this->connection->query("SHOW COLUMNS FROM room_types LIKE 'name'");
        if ($result && ($column = $result->fetch_assoc()) && stripos($column["Type"], "enum(") === 0) {
            $this->connection->query("ALTER TABLE room_types MODIFY name varchar(100) NOT NULL");
        }
    }

    public function listRoomTypes()
    {
        $sql = "SELECT id, name, description, price_per_night, max_capacity, thumbnail_path, amenities "
            . "FROM room_types ORDER BY id DESC";
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

    public function findRoomType($id)
    {
        $stmt = $this->connection->prepare(
            "SELECT id, name, description, price_per_night, max_capacity, thumbnail_path, amenities FROM room_types WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $decoded = json_decode($row["amenities"] ?? "[]", true);
            $row["amenities"] = is_array($decoded) ? $decoded : [];
        }

        return $row;
    }

    public function createRoomType($name, $description, $pricePerNight, $maxCapacity, $thumbnailPath, $amenities)
    {
        $amenitiesJson = json_encode($amenities);
        $stmt = $this->connection->prepare(
            "INSERT INTO room_types (name, description, price_per_night, max_capacity, thumbnail_path, amenities) "
            . "VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssdiss", $name, $description, $pricePerNight, $maxCapacity, $thumbnailPath, $amenitiesJson);
        return $stmt->execute();
    }

    public function updateRoomType($id, $name, $description, $pricePerNight, $maxCapacity, $thumbnailPath, $amenities)
    {
        $amenitiesJson = json_encode($amenities);

        if ($thumbnailPath !== null) {
            $stmt = $this->connection->prepare(
                "UPDATE room_types SET name = ?, description = ?, price_per_night = ?, max_capacity = ?, "
                . "thumbnail_path = ?, amenities = ? WHERE id = ?"
            );
            $stmt->bind_param("ssdissi", $name, $description, $pricePerNight, $maxCapacity, $thumbnailPath, $amenitiesJson, $id);
        } else {
            $stmt = $this->connection->prepare(
                "UPDATE room_types SET name = ?, description = ?, price_per_night = ?, max_capacity = ?, amenities = ? WHERE id = ?"
            );
            $stmt->bind_param("ssdisi", $name, $description, $pricePerNight, $maxCapacity, $amenitiesJson, $id);
        }

        return $stmt->execute();
    }

    public function deleteRoomType($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM room_types WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getLastError()
    {
        return $this->connection->error;
    }
}
?>
