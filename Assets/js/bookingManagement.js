var rows = [];

loadBookings();

function renderBookingRows(rows) {

	const tbody = document.getElementById("bookingTableBody");
	let html = "";

	if (!tbody) {
		return;
	}

	if (rows.length === 0) {
		tbody.innerHTML = '<tr><td colspan="8">No bookings found</td></tr>';
		return;
	}

	for (let i = 0; i < rows.length; i++) {
		html += `<tr onclick="event.preventDefault(); editBookings(${i});">
		<td>${escapeBookingHtml(rows[i].id)}</td>
		<td>${escapeBookingHtml(rows[i].guest_name)}</td>
		<td>${escapeBookingHtml(rows[i].room_number)}</td>
		<td>${escapeBookingHtml(rows[i].room_type)}</td>
		<td>${escapeBookingHtml(rows[i].checkin_date)}</td>
		<td>${escapeBookingHtml(rows[i].checkout_date)}</td>
		<td>${escapeBookingHtml(rows[i].total_price)}</td>
		<td class="status">${escapeBookingHtml(rows[i].status)}</td>
		</tr>`;
	}
	tbody.innerHTML = html;
}

function loadBookings() {
	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (xhttp.readyState === 4 && xhttp.status === 200) {
			let response = JSON.parse(xhttp.responseText);

			if (response.status === "success") {
                rows = response.data;
				renderBookingRows(rows);
			} else {
				renderBookingRows([]);
			}
		}
	};

	xhttp.open("POST", "/WebTechProject_G7/Controller/bookingMngCtrl.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("action=listBookings");
}

function editBookings(index)
{
    document.getElementById("editBookingId").value = rows[index].id;
    document.getElementById("editGuestName").value = rows[index].guest_name;
    document.getElementById("editRoomNumber").value = rows[index].room_number;
    document.getElementById("editRoomType").value = rows[index].room_type;
    document.getElementById("editCheckin").value = rows[index].checkin_date;
    document.getElementById("editCheckout").value = rows[index].checkout_date;
    document.getElementById("editTotalPrice").value = rows[index].total_price;
    document.getElementById("editStatus").value = rows[index].status;
    setBookingMessage("");
}

function updateBookingStatus() {
	const bookingId = document.getElementById("editBookingId").value;
	const status = document.getElementById("editStatus").value;

	if (bookingId === "") {
		setBookingMessage("Please select a booking first.");
		return;
	}

	let xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (xhttp.readyState === 4) {
			if (xhttp.status === 200) {
				let response = JSON.parse(xhttp.responseText);
				setBookingMessage(response.message);

				if (response.status === "success") {
					loadBookings();
				}
			} else {
				setBookingMessage("Could not update booking status.");
			}
		}
	};

	xhttp.open("POST", "/WebTechProject_G7/Controller/bookingMngCtrl.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(
		"action=updateStatus" +
		"&bookingId=" + encodeURIComponent(bookingId) +
		"&status=" + encodeURIComponent(status)
	);
}

function setBookingMessage(message) {
	const messageBox = document.getElementById("bookingUpdateMessage");

	if (messageBox) {
		messageBox.innerHTML = escapeBookingHtml(message);
	}
}

function escapeBookingHtml(value) {
	return String(value ?? "")
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
}

function initBookingManagement() {
	const saveButton = document.getElementById("saveBookingButton");

	if (saveButton) {
		saveButton.addEventListener("click", updateBookingStatus);
	}
}

initBookingManagement();
