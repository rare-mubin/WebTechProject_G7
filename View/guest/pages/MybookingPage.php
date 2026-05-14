<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="style/MyBookingPage.css">

    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background: #f4f7fb;
    color: #111827;
}

.main {
    width: 100%;
    min-height: 100vh;
    padding: 32px;
}

.bookings-card {
    width: 100%;
    background: #ffffff;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
}

.top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 26px;
}

.top-bar h2 {
    font-size: 28px;
    font-weight: 800;
}

.filter-box select {
    width: 150px;
    height: 44px;
    border: 1px solid #d6deea;
    border-radius: 10px;
    padding: 0 14px;
    background: #fff;
    color: #374151;
    font-size: 14px;
    outline: none;
}

.table-wrap {
    width: 100%;
    overflow-x: auto;
}

.booking-table {
    width: 100%;
    min-width: 1150px;
    border-collapse: collapse;
}

.booking-table th {
    color: #4b5563;
    font-size: 14px;
    font-weight: 800;
    text-align: left;
    padding: 14px 16px;
    border-bottom: 1px solid #e5e7eb;
}

.booking-table td {
    padding: 22px 16px;
    border-bottom: 1px solid #eef2f7;
    vertical-align: middle;
    font-size: 14px;
}

.room-info {
    display: flex;
    align-items: center;
    gap: 18px;
    min-width: 300px;
}

.room-info img {
    width: 105px;
    height: 78px;
    border-radius: 8px;
    object-fit: cover;
    background: #e5e7eb;
}

.room-info span {
    color: #6b7280;
    font-size: 13px;
}

.room-info h4 {
    margin-top: 6px;
    color: #111827;
    font-size: 15px;
    line-height: 1.45;
}

.description {
    max-width: 280px;
    color: #374151;
    line-height: 1.6;
}

.rate {
    color: #000;
    font-weight: 800;
    white-space: nowrap;
}

.status {
    display: inline-block;
    border-radius: 999px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 800;
}

.status.booked {
    background: #e8f7ef;
    color: #15803d;
}

.status.pre-booked {
    background: #fff7d6;
    color: #a16207;
}

.status.visited {
    background: #e8f1ff;
    color: #1d4ed8;
}

.cancel-btn,
.view-btn {
    border: none;
    border-radius: 9px;
    padding: 11px 16px;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
}

.cancel-btn {
    background: #fee2e2;
    color: #dc2626;
}

.cancel-btn:hover {
    background: #dc2626;
    color: #ffffff;
}

.view-btn {
    background: #e8eef7;
    color: #263445;
}

.view-btn:hover {
    background: #263445;
    color: #ffffff;
}

@media (max-width: 768px) {
    .main {
        padding: 18px;
    }

    .bookings-card {
        padding: 20px;
    }

    .top-bar {
        align-items: stretch;
        flex-direction: column;
    }

    .filter-box select {
        width: 100%;
    }
}

    </style>
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
