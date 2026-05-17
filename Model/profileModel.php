<?php
class ProfileModel
{
    public function getUserProfile($connection, $userId)
    {
        $sql = $connection->prepare(
            "SELECT u.id, u.name, u.email, u.phone, u.nationality, u.role,
                    u.preferred_room_type_id, u.special_requests, rt.name AS preferred_room_type_name
             FROM users u
             LEFT JOIN room_types rt ON rt.id = u.preferred_room_type_id
             WHERE u.id = ?
             LIMIT 1"
        );

        if (!$sql) {
            return null;
        }

        $id = (int) $userId;
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $user = $result->fetch_assoc();
        $sql->close();

        return $user ?: null;
    }

    public function getRoomTypes($connection)
    {
        $roomTypes = [];
        $result = $connection->query("SELECT id, name FROM room_types ORDER BY name ASC");

        if (!$result) {
            return $roomTypes;
        }

        while ($row = $result->fetch_assoc()) {
            $roomTypes[] = $row;
        }

        return $roomTypes;
    }

    public function updateProfile($connection, $userId, $name, $email, $phone, $nationality, $preferredRoomTypeId, $specialRequests)
    {
        $id = (int) $userId;

        if ($preferredRoomTypeId === "") {
            $sql = $connection->prepare(
                "UPDATE users
                 SET name = ?, email = ?, phone = ?, nationality = ?, preferred_room_type_id = NULL, special_requests = ?
                 WHERE id = ?"
            );

            if (!$sql) {
                return false;
            }

            $sql->bind_param("sssssi", $name, $email, $phone, $nationality, $specialRequests, $id);
        } else {
            $sql = $connection->prepare(
                "UPDATE users
                 SET name = ?, email = ?, phone = ?, nationality = ?, preferred_room_type_id = ?, special_requests = ?
                 WHERE id = ?"
            );

            if (!$sql) {
                return false;
            }

            $preferredId = (int) $preferredRoomTypeId;
            $sql->bind_param("ssssisi", $name, $email, $phone, $nationality, $preferredId, $specialRequests, $id);
        }

        $success = $sql->execute();
        $sql->close();

        return $success;
    }

    public function getUpcomingBooking($connection, $userId)
    {
        $sql = $connection->prepare(
            "SELECT b.checkin_date, b.checkout_date, b.status, rt.name AS room_type_name
             FROM bookings b
             INNER JOIN rooms r ON r.id = b.room_id
             INNER JOIN room_types rt ON rt.id = r.room_type_id
             WHERE b.user_id = ?
             AND b.checkin_date >= CURDATE()
             AND b.status NOT IN ('Cancelled', 'Checked-Out')
             ORDER BY b.checkin_date ASC
             LIMIT 1"
        );

        if (!$sql) {
            return null;
        }

        $id = (int) $userId;
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $booking = $result->fetch_assoc();
        $sql->close();

        return $booking ?: null;
    }
}
?>
