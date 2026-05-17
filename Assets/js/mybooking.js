function loadMyBookings() {
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response;
            try {
                response = JSON.parse(this.responseText);
            } catch (e) {
                document.getElementById("bookingMessage").innerText = "Invalid server response.";
                return;
            }

            if (response.status === "error") {
                document.getElementById("bookingMessage").innerText = response.message;
                document.getElementById("bookingsTableBody").innerHTML = "";
                return;
            }

            document.getElementById("bookingMessage").innerText = "";
            let rows = "";

            if (!response.data || response.data.length === 0) {
                document.getElementById("bookingsTableBody").innerHTML =
                    '<tr><td colspan="7" style="text-align:center;padding:24px 0;">No bookings found.</td></tr>';
                return;
            }

            for (let i = 0; i < response.data.length; i++) {
                let b = response.data[i];
                let statusClass = getStatusClass(b.status);
                let statusLabel = getStatusLabel(b.status);
                let imgPath = b.thumbnail_path ? "../../../" + b.thumbnail_path : "../../../Assets/images/room-placeholder.jpg";
                let cancelBtn = b.can_cancel
                    ? '<button class="cancel-btn" type="button" onclick="cancelBooking(' + b.id + ')">Cancel</button>'
                    : '<span style="color:#6b7280;font-size:13px;">-</span>';

                rows +=
                    '<tr id="booking-row-' + b.id + '">' +
                        '<td>' +
                            '<div class="room-info">' +
                                '<img src="' + imgPath + '" alt="' + b.room_type_name + '">' +
                                '<div>' +
                                    '<span>Room: ' + b.room_number + '</span>' +
                                    '<h4>' + b.room_type_name + '</h4>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td class="description">' + (b.description || "No description") + '</td>' +
                        '<td class="rate">$' + parseFloat(b.total_price).toFixed(2) + '</td>' +
                        '<td>' + formatDate(b.checkin_date) + '</td>' +
                        '<td>' + formatDate(b.checkout_date) + '</td>' +
                        '<td><span class="status ' + statusClass + '">' + statusLabel + '</span></td>' +
                        '<td class="action-cell">' + cancelBtn + '</td>' +
                    '</tr>';
            }

            document.getElementById("bookingsTableBody").innerHTML = rows;
        }
    };

    xhttp.open("POST", "../../../Controller/MyBookingController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=getMyBookings");
}

function cancelBooking(bookingId) {
    if (!confirm("Are you sure you want to cancel this booking?")) {
        return;
    }

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response;
            try {
                response = JSON.parse(this.responseText);
            } catch (e) {
                alert("Invalid server response.");
                return;
            }

            if (response.status === "success") {
                updateBookingRow(bookingId, "Cancelled");
            } else {
                alert(response.message);
            }
        }
    };

    xhttp.open("POST", "../../../Controller/MyBookingController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=cancelBooking&booking_id=" + encodeURIComponent(bookingId));
}

function updateBookingRow(bookingId, status) {
    let row = document.getElementById("booking-row-" + bookingId);
    if (!row) return;

    let badge = row.querySelector(".status");
    if (badge) {
        badge.className = "status " + getStatusClass(status);
        badge.textContent = getStatusLabel(status);
    }

    let actionCell = row.querySelector(".action-cell");
    if (actionCell) {
        actionCell.innerHTML = '<span style="color:#6b7280;font-size:13px;">-</span>';
    }
}

function getStatusClass(status) {
    switch (status) {
        case "Pending": return "pre-booked";
        case "Confirmed": return "booked";
        case "Checked-In":
        case "Checked-Out": return "visited";
        case "Cancelled": return "cancelled";
        default: return "";
    }
}

function getStatusLabel(status) {
    switch (status) {
        case "Pending": return "Pre-Booked";
        case "Confirmed": return "Booked";
        case "Checked-In": return "Visited";
        case "Checked-Out": return "Visited";
        case "Cancelled": return "Cancelled";
        default: return status;
    }
}

function formatDate(dateStr) {
    let d = new Date(dateStr);
    if (isNaN(d.getTime())) return dateStr;
    let months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    return d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
}

document.addEventListener("DOMContentLoaded", loadMyBookings);
