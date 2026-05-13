<!DOCTYPE html>
<html>
<head>
    <title>Booking Page</title>
    <!-- <link rel="stylesheet" href="Style/Bookingpage.css"> -->
</head>
<body>
<section class="booking-page">
  <div class="booking-layout">
    <form class="booking-details"method="POST">
      <h2>Booking Details</h2>

      <div class="form-grid">
        <div class="form-group">
          <label for="checkin">Check-in</label>
          <input type="datetime-local" id="checkin" name="checkin" readonly>
        </div>

        <div class="form-group">
          <label for="checkout">Check-out</label>
          <input type="datetime-local" id="checkout" name="checkout" readonly>
        </div>

        <div class="form-group">
          <label for="guests">No. of Guests</label>
          <input type="number" id="guests" name="guests" min="1" value="1" readonly>
        </div>

        <div class="form-group">
          <label for="room_type">Room Type</label>
          <input type="text" id="room_type" name="room_type" value="Deluxe Room" readonly>
        </div>
      </div>

      <h2 class="contact-title">Contact Details</h2>

      <div class="form-grid">
        <div class="form-group">
          <label for="guest_name">Name</label>
          <input type="text" id="guest_name" name="guest_name" placeholder="Your name" required>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Your phone number" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Your email address" required>
        </div>

        <div class="form-group">
          <label for="nationality">Nationality</label>
          <input type="text" id="nationality" name="nationality" placeholder="Your nationality" required>
        </div>
      </div>

      <button type="submit" class="book-submit">Book Now</button>
    </form>

    <aside class="room-summary-card">
      <img src="" alt="Deluxe Room">

      <div class="room-card-body">
        <div class="room-title-row">
          <h2>Deluxe Room</h2>
          <strong>$250</strong>
        </div>

        <p class="room-desc">
          The room has a comfortable bed, elegant lighting, relaxing interior,
          and premium facilities for a peaceful hotel stay.
        </p>

        <h3>Room Amenities</h3>

        <div class="amenities-list">
          <span>WiFi</span>
          <span>AC</span>
          <span>TV</span>
          <span>Minibar</span>
          <span>Safe</span>
          <span>Bathtub</span>
          <span>Balcony</span>
        </div>

        <div class="total-price-box">
          <span>Total Price</span>
          <input type="text" name="total_price" value="$250" readonly>
        </div>
      </div>
    </aside>
  </div>
</section>
</body>
</html>