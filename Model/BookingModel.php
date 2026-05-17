<?php
class BookingModel
{
    public function getGuestById($connection, $userId)
    {
        $sql = "SELECT id, name, email, phone, nationality FROM users WHERE id = '".$userId."'";
        $result = $connection->query($sql);
        $guest = $result->fetch_assoc();
        return $guest ?: null;
    }

    public function getLatestGuest($connection)
    {
        $sql = "SELECT id, name, email, phone, nationality FROM users WHERE role = 'guest' ORDER BY id DESC LIMIT 1";
        $result = $connection->query($sql);
        $guest = $result->fetch_assoc();
        return $guest ?: null;
    }

    public function updateGuestContact($connection, $userId, $name, $email, $phone, $nationality)
    {
        $sql = "UPDATE users SET name = '".$name."', email = '".$email."', phone = '".$phone."', nationality = '".$nationality."' WHERE id = '".$userId."'";
        $result = $connection->query($sql);
        return $result;
    }

    public function findAvailableRoomId($connection, $roomTypeId, $checkin, $checkout, $guests)
    {
        $sql = "SELECT r.id FROM rooms r JOIN room_types rt ON rt.id = r.room_type_id WHERE r.room_type_id = '".$roomTypeId."' AND rt.max_capacity >= '".$guests."' AND r.status = 'available' AND NOT EXISTS (SELECT 1 FROM bookings b WHERE b.room_id = r.id AND b.status IN ('Pending', 'Confirmed', 'Checked-In') AND b.checkin_date < '".$checkout."' AND b.checkout_date > '".$checkin."') ORDER BY r.id ASC LIMIT 1 FOR UPDATE";
        $result = $connection->query($sql);
        $room = $result->fetch_assoc();
        return $room ? (int) $room["id"] : null;
    }

    public function createBooking($connection, $userId, $roomId, $checkin, $checkout, $totalPrice)
    {
        $status = "Pending";
        $sql = "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, total_price, status) VALUES ('".$userId."', '".$roomId."', '".$checkin."', '".$checkout."', '".$totalPrice."', '".$status."')";
        $connection->query($sql);
        return $connection->insert_id;
    }

    public function getBookingConfirmation($connection, $bookingId)
    {
        $sql = "SELECT b.id, b.checkin_date, b.checkout_date, b.total_price, b.status, rt.name AS room_type, rt.description, r.room_number FROM bookings b JOIN rooms r ON b.room_id = r.id JOIN room_types rt ON r.room_type_id = rt.id WHERE b.id = '".$bookingId."'";
        $result = $connection->query($sql);
        $booking = $result->fetch_assoc();
        return $booking ?: null;
    }
}
