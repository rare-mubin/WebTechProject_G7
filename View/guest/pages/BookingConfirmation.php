<?php
include "../../../Model/dataConnection.php";
include "../../../Model/BookingModel.php";

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

$bookingId = $_GET["booking_id"] ?? "";
$booking = null;

if ($bookingId !== "") {
    $DB = new db();
    $connection = $DB->connection();
    $bookingModel = new BookingModel($connection);
    $booking = $bookingModel->getBookingConfirmation($bookingId);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f3f5f9;
            font-family: 'Poppins', sans-serif;
            color: #111;
        }

        .confirmation-card {
            width: min(680px, calc(100% - 32px));
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            padding: 38px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 30px;
        }

        .status {
            display: inline-block;
            margin-bottom: 28px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #fff7d6;
            color: #956000;
            font-weight: 700;
        }

        .details {
            display: grid;
            gap: 14px;
            margin-bottom: 30px;
        }

        .details p {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin: 0;
            padding-bottom: 14px;
            border-bottom: 1px solid #e8ebf0;
        }

        .details strong {
            color: #555;
        }

        a {
            display: inline-flex;
            padding: 13px 18px;
            border-radius: 7px;
            background: #111;
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            background: #b66b10;
        }
    </style>
</head>
<body>
    <section class="confirmation-card">
        <?php if ($booking) { ?>
            <h1>Booking Confirmed</h1>
            <span class="status"><?php echo e($booking["status"]); ?></span>

            <div class="details">
                <p><strong>Booking ID</strong> <span>#<?php echo e($booking["id"]); ?></span></p>
                <p><strong>Room Type</strong> <span><?php echo e($booking["room_type"]); ?></span></p>
                <p><strong>Room Number</strong> <span><?php echo e($booking["room_number"]); ?></span></p>
                <p><strong>Check-in</strong> <span><?php echo e($booking["checkin_date"]); ?></span></p>
                <p><strong>Check-out</strong> <span><?php echo e($booking["checkout_date"]); ?></span></p>
                <p><strong>Total Price</strong> <span><?php echo e(number_format((float) $booking["total_price"], 2)); ?></span></p>
            </div>
        <?php } else { ?>
            <h1>Booking Not Found</h1>
            <p>The booking confirmation could not be loaded.</p>
        <?php } ?>

        <a href="/WebTechProject_G7/View/guest/Homepage.php">Back to Home</a>
    </section>
</body>
</html>
