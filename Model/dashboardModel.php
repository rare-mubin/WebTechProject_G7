<?php
require_once __DIR__ . "/dataConnection.php";

class DashboardModel
{
    private $connection;

    public function __construct()
    {
        $db = new db();
        $this->connection = $db->connection();
    }

    public function getTodaysArrivals($today)
    {
        $sql = "SELECT b.id, u.name AS guest_name, r.room_number, rt.name AS room_type, "
            . "b.checkin_date, b.checkout_date, b.status "
            . "FROM bookings b "
            . "JOIN users u ON b.user_id = u.id "
            . "JOIN rooms r ON b.room_id = r.id "
            . "JOIN room_types rt ON r.room_type_id = rt.id "
            . "WHERE b.checkin_date = ? AND b.status = 'Confirmed' "
            . "ORDER BY r.room_number ASC";

        return $this->fetchRowsByDate($sql, $today);
    }

    public function getTodaysDepartures($today)
    {
        $sql = "SELECT b.id, u.name AS guest_name, r.room_number, rt.name AS room_type, "
            . "b.checkin_date, b.checkout_date, b.status "
            . "FROM bookings b "
            . "JOIN users u ON b.user_id = u.id "
            . "JOIN rooms r ON b.room_id = r.id "
            . "JOIN room_types rt ON r.room_type_id = rt.id "
            . "WHERE b.checkout_date = ? AND b.status = 'Checked-In' "
            . "ORDER BY r.room_number ASC";

        return $this->fetchRowsByDate($sql, $today);
    }

    public function countTotalRooms()
    {
        return $this->countByQuery("SELECT COUNT(*) AS total FROM rooms");
    }

    public function countOccupiedRooms()
    {
        return $this->countByQuery(
            "SELECT COUNT(DISTINCT room_id) AS total FROM bookings WHERE status = 'Checked-In'"
        );
    }

    public function countMaintenanceRooms()
    {
        return $this->countByQuery(
            "SELECT COUNT(*) AS total FROM rooms WHERE status = 'maintenance'"
        );
    }

    public function countAvailableRooms()
    {
        return $this->countByQuery(
            "SELECT COUNT(*) AS total "
            . "FROM rooms r "
            . "WHERE r.status = 'available' "
            . "AND NOT EXISTS ("
            . "SELECT 1 FROM bookings b "
            . "WHERE b.room_id = r.id AND b.status = 'Checked-In'"
            . ")"
        );
    }

    public function getRevenueByWeek($startDate, $endDate)
    {
        $sql = "SELECT YEARWEEK(checkin_date, 3) AS week_key, "
            . "SUM(total_price) AS total_revenue "
            . "FROM bookings "
            . "WHERE checkin_date BETWEEN ? AND ? "
            . "GROUP BY YEARWEEK(checkin_date, 3) "
            . "ORDER BY YEARWEEK(checkin_date, 3)";

        $statement = $this->connection->prepare($sql);
        $rows = [];

        if (!$statement) {
            return $rows;
        }

        $statement->bind_param("ss", $startDate, $endDate);
        $statement->execute();
        $result = $statement->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = [
                    "week_key" => $row["week_key"],
                    "total_revenue" => (float) $row["total_revenue"]
                ];
            }
        }

        $statement->close();
        return $rows;
    }

    private function fetchRowsByDate($sql, $date)
    {
        $statement = $this->connection->prepare($sql);
        $rows = [];

        if (!$statement) {
            return $rows;
        }

        $statement->bind_param("s", $date);
        $statement->execute();
        $result = $statement->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        $statement->close();
        return $rows;
    }

    private function countByQuery($sql)
    {
        $result = $this->connection->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();
        return (int) ($row["total"] ?? 0);
    }
}
?>
