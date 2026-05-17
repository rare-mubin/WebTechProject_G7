<?php
class MyBookingModel
{
    public function getMyBookings($connection, $userId)
    {
        $sql = "SELECT b.id, b.checkin_date, b.checkout_date, b.total_price, b.status, rt.name AS room_type_name, rt.description, rt.thumbnail_path, r.room_number FROM bookings b JOIN rooms r ON r.id = b.room_id JOIN room_types rt ON rt.id = r.room_type_id WHERE b.user_id = '".$userId."' ORDER BY b.created_at DESC";
        $result = $connection->query($sql);
        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        return $bookings;
    }

    public function getBookingById($connection, $bookingId, $userId)
    {
        $sql = "SELECT b.id, b.checkin_date, b.status FROM bookings b WHERE b.id = '".$bookingId."' AND b.user_id = '".$userId."'";
        $result = $connection->query($sql);
        $booking = $result->fetch_assoc();
        return $booking ?: null;
    }

    public function cancelBooking($connection, $bookingId, $userId)
    {
        $sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = '".$bookingId."' AND user_id = '".$userId."'";
        $result = $connection->query($sql);
        return $result && $connection->affected_rows > 0;
    }
}
