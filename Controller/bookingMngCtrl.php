<?php
include "../Model/bookingMngModel.php";

header("Content-Type: application/json");

if (isset($_POST["action"]) && $_POST["action"] === "listBookings") {
	$model = new BookingMngModel();
	$bookings = $model->fetchBookings();

	echo json_encode([
		"status" => "success",
		"message" => "Booking list loaded",
		"data" => $bookings
	]);
	exit;
}

if (isset($_POST["action"]) && $_POST["action"] === "updateStatus") {
	$bookingId = $_POST["bookingId"] ?? "";
	$status = $_POST["status"] ?? "";
	$allowedStatuses = ["Pending", "Confirmed", "Checked-In", "Checked-Out", "Cancelled"];

	if ($bookingId === "" || !ctype_digit((string) $bookingId) || (int) $bookingId <= 0) {
		echo json_encode([
			"status" => "error",
			"message" => "Invalid booking selected"
		]);
		exit;
	}

	if (!in_array($status, $allowedStatuses, true)) {
		echo json_encode([
			"status" => "error",
			"message" => "Invalid booking status"
		]);
		exit;
	}

	$model = new BookingMngModel();

	if (!$model->bookingExists($bookingId)) {
		echo json_encode([
			"status" => "error",
			"message" => "Booking was not found"
		]);
		exit;
	}

	if (!$model->updateBookingStatus($bookingId, $status)) {
		echo json_encode([
			"status" => "error",
			"message" => "Could not update booking status. " . $model->getLastError()
		]);
		exit;
	}

	echo json_encode([
		"status" => "success",
		"message" => "Booking status updated"
	]);
	exit;
}

echo json_encode([
	"status" => "error",
	"message" => "Invalid request"
]);
exit;
?>
