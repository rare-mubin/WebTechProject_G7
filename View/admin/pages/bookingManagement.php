<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Management</title>
    <style>
        h1 {
            margin-bottom: 16px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 16px;
            align-items: start;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        thead th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 10px;
            border: 1px solid #dddddd;
        }

        tbody td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .sidebar {
            border: 1px solid #dddddd;
            background-color: #ffffff;
            padding: 12px;
        }

        .sidebar h2 {
            margin: 0 0 12px;
            font-size: 16px;
        }

        .sidebar label {
            display: block;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .sidebar input {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            margin-top: 4px;
        }

        .sidebar button {
            width: 100%;
            padding: 8px;
            border: none;
            background-color: #0b5ed7;
            color: #ffffff;
            border-radius: 4px;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #0a53be;
        }
    </style>
</head>
<body onload="event.preventDefault(); loadBookings();">
    <h1>Booking Management</h1>

    <div class="layout">
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Guest Name</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="bookingTableBody"></tbody>
        </table>

        <div id="bookingDetails" class="sidebar">
            <h2>Edit Booking</h2>
            <label>
                Booking ID
                <input type="text" id="editBookingId" />
            </label>
            <label>
                Guest Name
                <input type="text" id="editGuestName" />
            </label>
            <label>
                Room Number
                <input type="text" id="editRoomNumber" />
            </label>
            <label>
                Room Type
                <input type="text" id="editRoomType" />
            </label>
            <label>
                Check-in
                <input type="text" id="editCheckin" />
            </label>
            <label>
                Check-out
                <input type="text" id="editCheckout" />
            </label>
            <label>
                Total Price
                <input type="text" id="editTotalPrice" />
            </label>
            <label>
                Status
                <input type="text" id="editStatus" />
            </label>
            <button type="button" id="saveBookingButton">Save</button>
        </div>
    </div>
</body>
</html>