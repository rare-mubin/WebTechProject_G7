<section class="hero">
    <div class="hero-content">
        <h1>
            In A Great Hotel, You Don’t Just Stay, You Belong
        </h1>

        <p>
            Find your perfect stay with ease explore a wide range of rooms,
            grab great deals, and book your ideal getaway today
        </p>
    </div>

    <div class="booking-box-wrapper">
        <form class="booking-box" onsubmit="event.preventDefault();searchform();"method="get">
            <div class="booking-field">
                <label for="checkin">Check In</label>
                <input type="date" id="checkin" name="Checkin" required>
            </div>
            <div class="booking-field">
                <label for="checkout">Check Out</label>
                <input type="date" id="checkout" name="Checkout" required>
            </div>
            <div class="booking-field">
                <label for="guests">Person</label>
                <input type="number" id="guests" name="guests" min="1" value="1" required>
            </div>
            <button type="submit"  class="booking-btn">Book Now</button>
        </form>
        <p id="err"></p>
    </div>
</section>
<section id="roomResult">

</section>
<section class="about-section">
    <div class="about-text">
        <span>ABOUT US</span>
        <h2>Moonlight Luxury Hotel</h2>
        <p>
            Moonlight is a relaxing online accommodation site where guests can
            search rooms, compare details, and book their perfect stay easily.
        </p>
        <a href="#" class="ajax-link" data-page="facilities" data-title="Facilities">READ MORE</a>
    </div>

    <div class="about-images">
        <img src="../../public/uploads/rooms/Ambiente-Skyline-03-1.jpg" alt="Hotel View">
        <img src="../../public/uploads/rooms/Luxary-Bed-Room.jpg" alt="Hotel room">
    </div>
</section>

