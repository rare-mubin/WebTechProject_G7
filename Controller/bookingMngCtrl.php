<?php
include "../Model/bookingMngModel.php";

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

echo json_encode([
	"status" => "error",
	"message" => "Invalid request"
]);
exit;
?>
