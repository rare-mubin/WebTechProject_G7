<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="style/MyBookingPage.css">
</head>
<body>
    <main class="main">
        <section class="bookings-card">

            <div class="top-bar">
                <h2>My Bookings</h2>
                <div class="filter-box">
                    <select>
                        <option>All Type</option>
                        <option>Visited</option>
                        <option>Booked</option>
                        <option>Pre-Booked</option>
                    </select>
                </div>
            </div>
            <div class="table-wrap">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Rate</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="room-info">
                                    <img src="../Image/room1.jpg" alt="Luxury Queen Bed">

                                    <div>
                                        <span>ID: B17</span>
                                        <h4>
                                            Luxury Queen Bed <br>
                                            With Garden View
                                        </h4>
                                    </div>
                                </div>
                            </td>

                            <td class="description">
                                Elegant modern room with luxury lighting,
                                pool access and premium interior decoration.
                            </td>

                            <td class="rate">$1280/Night</td>

                            <td>20 May 2026</td>
                            <td>23 May 2026</td>

                            <td>
                                <span class="status booked">Booked</span>
                            </td>

                            <td>
                                <button class="cancel-btn" type="button">
                                    Cancel
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
