<?php
class BookingModel
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getGuestById($userId)
    {
        $stmt = $this->connection->prepare("SELECT id, name, email, phone, nationality FROM users WHERE id = ?");
        if (!$stmt) {
            return null;
        }

        $id = (int) $userId;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $guest = $result->fetch_assoc();
        $stmt->close();

        return $guest ?: null;
    }

    public function getLatestGuest()
    {
        $result = $this->connection->query("SELECT id, name, email, phone, nationality FROM users WHERE role = 'guest' ORDER BY id DESC LIMIT 1");
        if (!$result) {
            return null;
        }

        $guest = $result->fetch_assoc();
        return $guest ?: null;
    }

    public function updateGuestContact($userId, $name, $email, $phone, $nationality)
    {
        $stmt = $this->connection->prepare("UPDATE users SET name = ?, email = ?, phone = ?, nationality = ? WHERE id = ?");
        if (!$stmt) {
            return false;
        }

        $id = (int) $userId;
        $stmt->bind_param("ssssi", $name, $email, $phone, $nationality, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function findAvailableRoomId($roomTypeId, $checkin, $checkout, $guests)
    {
        $sql = "SELECT r.id
                FROM rooms r
                JOIN room_types rt ON rt.id = r.room_type_id
                WHERE r.room_type_id = ?
                AND rt.max_capacity >= ?
                AND r.status = 'available'
                AND NOT EXISTS (
                    SELECT 1
                    FROM bookings b
                    WHERE b.room_id = r.id
                    AND b.status IN ('Pending', 'Confirmed', 'Checked-In')
                    AND b.checkin_date < ?
                    AND b.checkout_date > ?
                )
                ORDER BY r.id ASC
                LIMIT 1
                FOR UPDATE";

        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $typeId = (int) $roomTypeId;
        $guestCount = (int) $guests;
        $stmt->bind_param("iiss", $typeId, $guestCount, $checkout, $checkin);
        $stmt->execute();
        $result = $stmt->get_result();
        $room = $result->fetch_assoc();
        $stmt->close();

        return $room ? (int) $room["id"] : null;
    }

    public function createBooking($userId, $roomId, $checkin, $checkout, $totalPrice)
    {
        $status = "Pending";
        $stmt = $this->connection->prepare(
            "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, total_price, status)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        if (!$stmt) {
            return null;
        }

        $guestId = (int) $userId;
        $selectedRoomId = (int) $roomId;
        $price = (float) $totalPrice;
        $stmt->bind_param("iissds", $guestId, $selectedRoomId, $checkin, $checkout, $price, $status);
        $success = $stmt->execute();
        $bookingId = $success ? $stmt->insert_id : null;
        $stmt->close();

        return $bookingId;
    }

    public function getBookingConfirmation($bookingId)
    {
        $sql = "SELECT b.id, b.checkin_date, b.checkout_date, b.total_price, b.status,
                       rt.name AS room_type, rt.description, r.room_number
                FROM bookings b
                JOIN rooms r ON b.room_id = r.id
                JOIN room_types rt ON r.room_type_id = rt.id
                WHERE b.id = ?";

        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $id = (int) $bookingId;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
        $stmt->close();

        return $booking ?: null;
    }
}
?>
