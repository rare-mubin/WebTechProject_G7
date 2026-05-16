loadBookings();
rows = [];
function renderBookingRows(rows) {

	const tbody = document.getElementById("bookingTableBody");
	let html = "";
	for (let i = 0; i < rows.length; i++) {
		html += `<tr onclick="event.preventDefault(); editBookings(${i});">
		<td>${rows[i].id}</td>
		<td>${rows[i].guest_name}</td>
		<td>${rows[i].room_number}</td>
		<td>${rows[i].room_type}</td>
		<td>${rows[i].checkin_date}</td>
		<td>${rows[i].checkout_date}</td>
		<td>${rows[i].total_price}</td>
		<td class="status">${rows[i].status}</td>
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
}
