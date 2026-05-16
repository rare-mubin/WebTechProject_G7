<?php
require_once __DIR__ . "/dataConnection.php";

class BookingMngModel
{
	private $connection;

	public function __construct()
	{
		$db = new db();
		$this->connection = $db->connection();
	}

	public function fetchBookings()
	{
		$sql = "SELECT b.id, u.name AS guest_name, r.room_number, rt.name AS room_type, "
			. "b.checkin_date, b.checkout_date, b.total_price, b.status "
			. "FROM bookings b "
			. "JOIN users u ON b.user_id = u.id "
			. "JOIN rooms r ON b.room_id = r.id "
			. "JOIN room_types rt ON r.room_type_id = rt.id "
			. "ORDER BY b.created_at DESC";

		$result = $this->connection->query($sql);
		$rows = [];

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return $rows;
	}
}
?>
