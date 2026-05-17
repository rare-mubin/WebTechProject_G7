var rooms = [];
var roomTypeOptions = [];

var roomAmenityIcons = {
    WiFi: "fa-wifi",
    AC: "fa-snowflake",
    TV: "fa-tv",
    Minibar: "fa-martini-glass",
    Safe: "fa-vault",
    Bathtub: "fa-bath",
    Balcony: "fa-door-open"
};

loadRoomManagementData();

function escapeRoomHtml(value) {
    return String(value ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function renderRoomAmenities(amenities) {
    if (!Array.isArray(amenities) || amenities.length === 0) {
        return '<span class="muted">No amenities</span>';
    }

    return amenities.map(function (amenity) {
        const icon = roomAmenityIcons[amenity] || "fa-circle-check";
        return `<span class="amenity-chip" title="${escapeRoomHtml(amenity)}"><i class="fa-solid ${icon}"></i>${escapeRoomHtml(amenity)}</span>`;
    }).join("");
}

function loadRoomManagementData() {
    loadRoomTypeOptions();
    loadRooms();
}

function loadRoomTypeOptions() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            roomTypeOptions = response.status === "success" ? response.data : [];
            renderRoomTypeSelects();
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roommanagmentvalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=listRoomTypes");
}

function renderRoomTypeSelects() {
    const roomTypeSelect = document.getElementById("roomType");
    const filterSelect = document.getElementById("roomTypeFilter");

    if (roomTypeSelect) {
        roomTypeSelect.innerHTML = '<option value="">Select Room Type</option>' + roomTypeOptions.map(function (type) {
            return `<option value="${escapeRoomHtml(type.id)}">${escapeRoomHtml(type.name)}</option>`;
        }).join("");
    }

    if (filterSelect) {
        filterSelect.innerHTML = '<option value="">All Type</option>' + roomTypeOptions.map(function (type) {
            return `<option value="${escapeRoomHtml(type.id)}">${escapeRoomHtml(type.name)}</option>`;
        }).join("");
    }
}

function loadRooms() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            rooms = response.status === "success" ? response.data : [];
            renderRooms();
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roommanagmentvalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=listRooms");
}

function getFilteredRooms() {
    const typeFilter = document.getElementById("roomTypeFilter") ? document.getElementById("roomTypeFilter").value : "";
    const statusFilter = document.getElementById("roomStatusFilter") ? document.getElementById("roomStatusFilter").value : "";

    return rooms.filter(function (room) {
        const matchesType = typeFilter === "" || String(room.room_type_id) === typeFilter;
        const matchesStatus = statusFilter === "" || room.status === statusFilter;
        return matchesType && matchesStatus;
    });
}

function renderRooms() {
    const container = document.getElementById("roomRows");
    if (!container) {
        return;
    }

    const filteredRows = getFilteredRooms();
    if (!filteredRows.length) {
        container.innerHTML = '<div class="empty-state">No rooms found.</div>';
        return;
    }

    container.innerHTML = filteredRows.map(function (row) {
        const sourceIndex = rooms.findIndex(function (item) {
            return Number(item.id) === Number(row.id);
        });
        const imagePath = row.thumbnail_path ? `/WebTechProject_G7/${row.thumbnail_path}` : "";
        const statusClass = row.status === "available" ? "green" : "yellow";

        return `<div class="room-row">
            <div class="room-left">
                <div class="room-img">
                    ${imagePath ? `<img src="${escapeRoomHtml(imagePath)}" alt="${escapeRoomHtml(row.room_type_name)}">` : ""}
                </div>
                <div class="room-details">
                    <span>Room: ${escapeRoomHtml(row.room_number)}</span>
                    <span>Floor: ${escapeRoomHtml(row.floor)}</span>
                    <h4>${escapeRoomHtml(row.room_type_name)}</h4>
                </div>
            </div>
            <div class="rate">$${Number(row.price_per_night).toFixed(2)}/Night</div>
            <div class="capacity">${escapeRoomHtml(row.max_capacity)} Guest(s)</div>
            <div class="amenities">${renderRoomAmenities(row.amenities)}</div>
            <div class="status ${statusClass}">${escapeRoomHtml(row.status)}</div>
            <div class="action">
                <button class="edit-btn" type="button" title="Edit Room" onclick="editRoom(${sourceIndex})">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="delete-btn" type="button" title="Delete Room" onclick="deleteRoom(${row.id})">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>`;
    }).join("");
}

function clearRoomErrors() {
    document.getElementById("roomTypeError").innerHTML = "";
    document.getElementById("roomNumberError").innerHTML = "";
    document.getElementById("floorError").innerHTML = "";
    document.getElementById("statusError").innerHTML = "";
}

function addRoom() {
    const roomId = document.getElementById("roomId").value;
    const roomType = document.getElementById("roomType").value;
    const roomNumber = document.getElementById("roomNumber").value.trim();
    const floor = document.getElementById("floor").value.trim();
    const status = document.getElementById("status").value;
    let isValid = true;

    clearRoomErrors();

    if (roomType === "") {
        document.getElementById("roomTypeError").innerHTML = "Please select room type";
        isValid = false;
    }

    if (roomNumber === "") {
        document.getElementById("roomNumberError").innerHTML = "Room number is required";
        isValid = false;
    }

    if (floor === "" || !/^\d+$/.test(floor) || Number(floor) <= 0) {
        document.getElementById("floorError").innerHTML = "Floor must be a positive whole number";
        isValid = false;
    }

    if (status === "") {
        document.getElementById("statusError").innerHTML = "Please select status";
        isValid = false;
    }

    if (!isValid) {
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            alert(response.message);
            if (response.status === "success") {
                resetRoomForm();
                loadRooms();
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roommanagmentvalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
        "action=" + encodeURIComponent(roomId ? "Update" : "Add") +
        "&roomId=" + encodeURIComponent(roomId) +
        "&roomType=" + encodeURIComponent(roomType) +
        "&roomNumber=" + encodeURIComponent(roomNumber) +
        "&floor=" + encodeURIComponent(floor) +
        "&status=" + encodeURIComponent(status)
    );
}

function editRoom(index) {
    const row = rooms[index];
    document.getElementById("roomId").value = row.id;
    document.getElementById("roomType").value = row.room_type_id;
    document.getElementById("roomNumber").value = row.room_number;
    document.getElementById("floor").value = row.floor;
    document.getElementById("status").value = row.status;
    document.getElementById("roomFormTitle").innerText = "Edit Room";
    document.getElementById("roomSubmit").value = "Update Room";
    document.getElementById("cancelRoomEditBtn").style.display = "block";
    clearRoomErrors();
}

function deleteRoom(id) {
    if (!confirm("Delete this room?")) {
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            alert(response.message);
            if (response.status === "success") {
                resetRoomForm();
                loadRooms();
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roommanagmentvalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=Delete&roomId=" + encodeURIComponent(id));
}

function resetRoomForm() {
    document.getElementById("roomForm").reset();
    document.getElementById("roomId").value = "";
    document.getElementById("roomFormTitle").innerText = "Add Room";
    document.getElementById("roomSubmit").value = "Add Room";
    document.getElementById("cancelRoomEditBtn").style.display = "none";
    clearRoomErrors();
}
