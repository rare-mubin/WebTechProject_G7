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
        <form class="booking-box" action="search.php" method="get">
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
            <button type="submit" class="booking-btn">Book Now</button>
        </form>
    </div>
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
        <img src="" alt="Hotel exterior">
        <img src="" alt="Hotel room">
    </div>
</section>

<section class="rooms-section">
    <span>WHAT WE OFFER</span>
    <h2>Discover Our Rooms</h2>

    <div class="room-card-wrapper">
        <div class="room-card">
            <img src="" alt="Double Room">
            <div class="room-info">
                <h3>Double Room</h3>
                <p><strong>$199</strong> / Per Night</p>
                <a href="#" class="ajax-link" data-page="rooms" data-title="Rooms">MORE DETAILS</a>
            </div>
        </div>
        <div class="room-card">
            <img src="" alt="Premium King Room">
            <div class="room-info">
                <h3>Premium King Room</h3>
                <p><strong>$159</strong> / Per Night</p>
                <a href="#" class="ajax-link" data-page="rooms" data-title="Rooms">MORE DETAILS</a>
            </div>
        </div>

        <div class="room-card">
            <img src="" alt="Deluxe Room">
            <div class="room-info">
                <h3>Deluxe Room</h3>
                <p><strong>$198</strong> / Per Night</p>
                <a href="#" class="ajax-link" data-page="rooms" data-title="Rooms">MORE DETAILS</a>
            </div>
        </div>
    </div>
</section>
