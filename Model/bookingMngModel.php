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

	public function bookingExists($bookingId)
	{
		$stmt = $this->connection->prepare("SELECT id FROM bookings WHERE id = ? LIMIT 1");

		if (!$stmt) {
			return false;
		}

		$id = (int) $bookingId;
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$exists = $result->num_rows > 0;
		$stmt->close();

		return $exists;
	}

	public function updateBookingStatus($bookingId, $status)
	{
		$stmt = $this->connection->prepare("UPDATE bookings SET status = ? WHERE id = ?");

		if (!$stmt) {
			return false;
		}

		$id = (int) $bookingId;
		$stmt->bind_param("si", $status, $id);
		$success = $stmt->execute();
		$stmt->close();

		return $success;
	}

	public function getLastError()
	{
		return $this->connection->error;
	}
}
?>
