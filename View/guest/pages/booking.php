<section class="page-section">
    <span>BOOK NOW</span>
    <h2>Reserve Your Stay</h2>
    <p>Select your check in date, check out date, and number of guests.</p>

    <form class="booking-box" action="search.php" method="get" style="position: static; transform: none; margin: 45px auto 0;">
        <div class="booking-field">
            <label for="book-checkin">Check In</label>
            <input type="date" id="book-checkin" name="Checkin" required>
        </div>
        <div class="booking-field">
            <label for="book-checkout">Check Out</label>
            <input type="date" id="book-checkout" name="Checkout" required>
        </div>
        <div class="booking-field">
            <label for="book-guests">Person</label>
            <input type="number" id="book-guests" name="guests" min="1" value="1" required>
        </div>
        <button type="submit" class="booking-btn">Book Now</button>
    </form>
</section>
