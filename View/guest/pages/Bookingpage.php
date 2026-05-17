<?php
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Page</title>
    <style>
      .booking-page {
  background: #f3f5f9;
  padding: 40px 8% 70px;
  font-family: 'Poppins', sans-serif;
}

.booking-layout {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 48px;
  align-items: start;
  max-width: 1500px;
  margin: 0 auto;
}

.booking-details,
.room-summary-card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.06);
}

.booking-details {
  padding: 34px;
}

.booking-details h2 {
  font-size: 22px;
  margin-bottom: 22px;
  color: #111;
}

.booking-error {
  background: #fff0f0;
  border: 1px solid #f0b4b4;
  color: #a61111;
  padding: 13px 16px;
  border-radius: 7px;
  margin-bottom: 22px;
}

.contact-title {
  margin-top: 34px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    column-gap: 28px;
    row-gap: 22px;
    gap: 50px;
}

.form-group {
    min-width: 0;
}

.form-group label {
    display: block;
    font-size: 14px;
    color: #111;
    margin-bottom: 8px;
}

.form-group input,
.form-group select {
    width: 100%;
    height: 48px;
    border: 1px solid #bfc3ca;
    border-radius: 7px;
    padding: 0 14px;
    font-size: 14px;
    outline: none;
    background: #fff;
}


.form-group input:focus,
.form-group select:focus {
  border-color: #b66b10;
}

.book-submit {
  width: 100%;
  height: 58px;
  margin-top: 36px;
  border: none;
  border-radius: 7px;
  background: #000;
  color: #fff;
  font-size: 18px;
  cursor: pointer;
}

.book-submit:hover {
  background: #b66b10;
}

.book-submit:disabled {
  background: #9aa0aa;
  cursor: not-allowed;
}

.room-summary-card {
  overflow: hidden;
}

.room-summary-card img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  display: block;
  background: #d9dde4;
}

.room-card-body {
  padding: 26px;
}

.room-title-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  margin-bottom: 14px;
}

.room-title-row h2 {
  font-size: 28px;
  color: #111;
  margin: 0;
}

.room-title-row strong {
  font-size: 28px;
  color: #111;
}

.room-desc {
  color: #555;
  font-size: 14px;
  line-height: 24px;
  margin-bottom: 24px;
}

.room-card-body h3 {
  font-size: 16px;
  margin-bottom: 16px;
  color: #111;
}

.amenities-list {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px 20px;
  margin-bottom: 26px;
}

.amenities-list span {
  color: #555;
  font-size: 14px;
}

.amenities-list span::before {
  content: "✓";
  color: #b66b10;
  font-weight: 700;
  margin-right: 8px;
}

.total-price-box {
  border-top: 1px solid #e2e5ea;
  padding-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.total-price-box span {
  font-size: 16px;
  font-weight: 600;
}

.total-price-box input {
  width: 140px;
  border: none;
  background: #f3f5f9;
  color: #111;
  font-size: 20px;
  font-weight: 700;
  text-align: right;
  padding: 10px;
  border-radius: 6px;
  outline: none;
}

@media (max-width: 992px) {
  .booking-layout {
    grid-template-columns: 1fr;
  }

  .form-grid {
    grid-template-columns: 1fr;
  }

  .booking-page {
    padding: 30px 20px;
  }
}
    </style>
</head>
<body>
<section class="booking-page">
  <div class="booking-layout">
    <form class="booking-details" method="POST" action="/WebTechProject_G7/Controller/BookingController.php">
      <h2>Booking Details</h2>

      <?php if ($error !== "") { ?>
        <div class="booking-error"><?php echo e($error); ?></div>
      <?php } ?>

      <?php if (!$roomType) { ?>
        <div class="booking-error">Please choose a room from the availability results first.</div>
      <?php } ?>

      <input type="hidden" name="room_type_id" value="<?php echo e($roomTypeId); ?>">
      <input type="hidden" name="user_id" value="<?php echo e($userId); ?>">

      <div class="form-grid">
        <div class="form-group">
          <label for="checkin">Check-in</label>
          <input type="date" id="checkin" name="checkin" value="<?php echo e($checkin); ?>" readonly required>
        </div>

        <div class="form-group">
          <label for="checkout">Check-out</label>
          <input type="date" id="checkout" name="checkout" value="<?php echo e($checkout); ?>" readonly required>
        </div>

        <div class="form-group">
          <label for="guests">No. of Guests</label>
          <input type="number" id="guests" name="guests" min="1" value="<?php echo e($guests); ?>" readonly required>
        </div>

        <div class="form-group">
          <label for="room_type">Room Type</label>
          <input type="text" id="room_type" name="room_type" value="<?php echo e($roomName); ?>" readonly>
        </div>
      </div>

      <h2 class="contact-title">Contact Details</h2>

      <div class="form-grid">
        <div class="form-group">
          <label for="guest_name">Name</label>
          <input type="text" id="guest_name" name="guest_name" value="<?php echo e($guestName); ?>" placeholder="Your name" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" value="<?php echo e($phone); ?>" placeholder="Your phone number" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo e($email); ?>" placeholder="Your email address" required>
        </div>

        <div class="form-group">
          <label for="nationality">Nationality</label>
          <input type="text" id="nationality" name="nationality" value="<?php echo e($nationality); ?>" placeholder="Your nationality" required>
        </div>
      </div>

      <button type="submit" class="book-submit" <?php echo (!$roomType || $nights < 1 || $userId === "") ? "disabled" : ""; ?>>Confirm Booking</button>
    </form>

    <aside class="room-summary-card">
      <img src="<?php echo e($roomType["thumbnail_path"] ?? ""); ?>" alt="<?php echo e($roomName); ?>">

      <div class="room-card-body">
        <div class="room-title-row">
          <h2><?php echo e($roomName); ?></h2>
          <strong><?php echo e(number_format((float) ($roomType["price_per_night"] ?? 0), 2)); ?></strong>
        </div>

        <p class="room-desc">
          <?php echo e($roomType["description"] ?? "Choose an available room to see the booking summary."); ?>
        </p>

        <h3>Room Amenities</h3>

        <div class="amenities-list">
          <?php if (count($amenities) > 0) { ?>
            <?php foreach ($amenities as $amenity) { ?>
              <span><?php echo e($amenity); ?></span>
            <?php } ?>
          <?php } else { ?>
              <span>Not listed</span>
          <?php } ?>
        </div>

        <div class="total-price-box">
          <span>Total Price</span>
          <input type="text" name="total_price" value="<?php echo e(number_format($totalPrice, 2)); ?>" readonly>
        </div>
      </div>
    </aside>
  </div>
</section>
</body>
</html>
