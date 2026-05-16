<?php
function getroom($connection,$checkin, $checkout)
{
    if (!$connection) {
        return false;
    }
    $sql = "SELECT rt.*
FROM room_types rt
JOIN rooms r ON r.room_type_id = rt.id
WHERE rt.max_capacity >= 2
AND r.status = 'available'
AND r.id NOT IN (
    SELECT room_id
    FROM bookings
    WHERE status IN ('Confirmed', 'Checked-In')
    AND checkin_date < '2026-5-19'
    AND checkout_date > '2026-5-18'
)";
    $result= $connection->query($sql);
    return $result;
}
?>