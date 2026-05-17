<?php
class MyBookingModel
{
    public function getMyBookings($connection, $userId)
    {
        $stmt = $connection->prepare(
            "SELECT b.id, b.checkin_date, b.checkout_date, b.total_price, b.status,
                    rt.name AS room_type_name, rt.description, rt.thumbnail_path, r.room_number
             FROM bookings b
             JOIN rooms r ON r.id = b.room_id
             JOIN room_types rt ON rt.id = r.room_type_id
             WHERE b.user_id = ?
             ORDER BY b.created_at DESC"
        );

        if (!$stmt) {
            return [];
        }

        $id = (int) $userId;
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }

        $stmt->close();
        return $bookings;
    }

    public function getBookingById($connection, $bookingId, $userId)
    {
        $stmt = $connection->prepare(
            "SELECT b.id, b.checkin_date, b.status
             FROM bookings b
             WHERE b.id = ? AND b.user_id = ?"
        );

        if (!$stmt) {
            return null;
        }

        $bid = (int) $bookingId;
        $uid = (int) $userId;
        $stmt->bind_param("ii", $bid, $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
        $stmt->close();

        return $booking ?: null;
    }

    public function cancelBooking($connection, $bookingId, $userId)
    {
        $stmt = $connection->prepare(
            "UPDATE bookings
             SET status = 'Cancelled'
             WHERE id = ? AND user_id = ?"
        );

        if (!$stmt) {
            return false;
        }

        $bid = (int) $bookingId;
        $uid = (int) $userId;
        $stmt->bind_param("ii", $bid, $uid);
        $success = $stmt->execute();
        $stmt->close();

        return $success && $connection->affected_rows > 0;
    }
}
?>
