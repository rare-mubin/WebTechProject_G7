var roomTypes = [];

var amenityIcons = {
    WiFi: "fa-wifi",
    AC: "fa-snowflake",
    TV: "fa-tv",
    Minibar: "fa-martini-glass",
    Safe: "fa-vault",
    Bathtub: "fa-bath",
    Balcony: "fa-door-open"
};

loadRoomTypes();

function escapeHtml(value) {
    return String(value ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function renderAmenityIcons(amenities) {
    if (!Array.isArray(amenities) || amenities.length === 0) {
        return '<span class="muted">No amenities</span>';
    }

    return amenities.map(function (amenity) {
        const icon = amenityIcons[amenity] || "fa-circle-check";
        return `<span class="amenity-chip" title="${escapeHtml(amenity)}"><i class="fa-solid ${icon}"></i>${escapeHtml(amenity)}</span>`;
    }).join("");
}

function renderRoomTypes(rows) {
    const container = document.getElementById("roomTypeRows");
    if (!container) {
        return;
    }

    if (!rows.length) {
        container.innerHTML = '<div class="empty-state">No room types found.</div>';
        return;
    }

    container.innerHTML = rows.map(function (row, index) {
        const imagePath = row.thumbnail_path ? `/WebTechProject_G7/${row.thumbnail_path}` : "";
        return `<div class="room-row">
            <div class="room-left">
                <div class="room-img">
                    ${imagePath ? `<img src="${escapeHtml(imagePath)}" alt="${escapeHtml(row.name)}">` : ""}
                </div>
                <div class="room-details">
                    <span>ID: ${escapeHtml(row.id)}</span>
                    <h4>${escapeHtml(row.name)}</h4>
                </div>
            </div>
            <div class="description">${escapeHtml(row.description)}</div>
            <div class="rate">$${Number(row.price_per_night).toFixed(2)}/Night</div>
            <div class="capacity">${escapeHtml(row.max_capacity)} Guest(s)</div>
            <div class="amenities">${renderAmenityIcons(row.amenities)}</div>
            <div class="action">
                <button class="edit-btn" type="button" title="Edit Room Type" onclick="editRoomType(${index})">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="delete-btn" type="button" title="Delete Room Type" onclick="deleteRoomType(${row.id})">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>`;
    }).join("");
}

function loadRoomTypes() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            roomTypes = response.status === "success" ? response.data : [];
            renderRoomTypes(roomTypes);
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roomtypevalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=listRoomTypes");
}

function clearRoomTypeErrors() {
    document.getElementById("roomtypeNameError").innerHTML = "";
    document.getElementById("perNightRateError").innerHTML = "";
    document.getElementById("descriptionError").innerHTML = "";
    document.getElementById("maxCapacityError").innerHTML = "";
    document.getElementById("amenitiesError").innerHTML = "";
    document.getElementById("roomImageError").innerHTML = "";
}

function getCheckedAmenities() {
    return Array.from(document.querySelectorAll('input[name="amenities[]"]:checked')).map(function (input) {
        return input.value;
    });
}

function validateRoomTypeForm(isEditMode) {
    const roomtypeName = document.getElementById("roomtypeName").value.trim();
    const perNightRate = document.getElementById("perNightRate").value.trim();
    const description = document.getElementById("description").value.trim();
    const maxCapacity = document.getElementById("maxCapacity").value.trim();
    const roomImage = document.getElementById("roomImage").files[0];
    const amenities = getCheckedAmenities();

    clearRoomTypeErrors();
    let isValid = true;

    if (roomtypeName === "") {
        document.getElementById("roomtypeNameError").innerHTML = "Room type name is required";
        isValid = false;
    } else if (!/^[a-zA-Z0-9-' ]+$/.test(roomtypeName)) {
        document.getElementById("roomtypeNameError").innerHTML = "Only letters, numbers, spaces, apostrophes, and hyphens allowed";
        isValid = false;
    } else if (roomtypeName.length < 4) {
        document.getElementById("roomtypeNameError").innerHTML = "Room type name should be more than 4 characters";
        isValid = false;
    }

    if (perNightRate === "" || isNaN(perNightRate) || Number(perNightRate) <= 0) {
        document.getElementById("perNightRateError").innerHTML = "Per night rate must be a positive number";
        isValid = false;
    }

    if (description === "") {
        document.getElementById("descriptionError").innerHTML = "Description is required";
        isValid = false;
    }

    if (maxCapacity === "" || !/^\d+$/.test(maxCapacity) || Number(maxCapacity) <= 0) {
        document.getElementById("maxCapacityError").innerHTML = "Max capacity must be a positive whole number";
        isValid = false;
    }

    if (amenities.length === 0) {
        document.getElementById("amenitiesError").innerHTML = "Please select at least one amenity";
        isValid = false;
    }

    if (!isEditMode && !roomImage) {
        document.getElementById("roomImageError").innerHTML = "Room image is required";
        isValid = false;
    }

    if (roomImage) {
        const allowedTypes = ["image/jpeg", "image/png"];
        if (!allowedTypes.includes(roomImage.type)) {
            document.getElementById("roomImageError").innerHTML = "Only JPEG and PNG images are allowed";
            isValid = false;
        } else if (roomImage.size > 2 * 1024 * 1024) {
            document.getElementById("roomImageError").innerHTML = "Image must be 2 MB or smaller";
            isValid = false;
        }
    }

    return isValid;
}

function saveRoomType() {
    const roomTypeId = document.getElementById("roomTypeId").value;
    const isEditMode = roomTypeId !== "";

    if (!validateRoomTypeForm(isEditMode)) {
        return;
    }

    const formData = new FormData();
    formData.append("action", isEditMode ? "Update" : "Add");
    formData.append("roomTypeId", roomTypeId);
    formData.append("roomtypeName", document.getElementById("roomtypeName").value.trim());
    formData.append("perNightRate", document.getElementById("perNightRate").value.trim());
    formData.append("description", document.getElementById("description").value.trim());
    formData.append("maxCapacity", document.getElementById("maxCapacity").value.trim());

    getCheckedAmenities().forEach(function (amenity) {
        formData.append("amenities[]", amenity);
    });

    const roomImage = document.getElementById("roomImage").files[0];
    if (roomImage) {
        formData.append("roomImage", roomImage);
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            alert(response.message);
            if (response.status === "success") {
                resetRoomTypeForm();
                loadRoomTypes();
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roomtypevalidation.php", true);
    xhttp.send(formData);
}

function editRoomType(index) {
    const row = roomTypes[index];
    document.getElementById("roomTypeId").value = row.id;
    document.getElementById("roomtypeName").value = row.name;
    document.getElementById("perNightRate").value = row.price_per_night;
    document.getElementById("description").value = row.description || "";
    document.getElementById("maxCapacity").value = row.max_capacity;

    document.querySelectorAll('input[name="amenities[]"]').forEach(function (input) {
        input.checked = Array.isArray(row.amenities) && row.amenities.includes(input.value);
    });

    document.getElementById("roomImage").value = "";
    document.getElementById("roomTypeFormTitle").innerText = "Edit Room Type";
    document.getElementById("roomTypeSubmit").value = "Update Room Type";
    document.getElementById("cancelEditBtn").style.display = "block";
    clearRoomTypeErrors();
}

function deleteRoomType(id) {
    if (!confirm("Delete this room type?")) {
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            const response = JSON.parse(xhttp.responseText);
            alert(response.message);
            if (response.status === "success") {
                resetRoomTypeForm();
                loadRoomTypes();
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roomtypevalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=Delete&roomTypeId=" + encodeURIComponent(id));
}

function resetRoomTypeForm() {
    document.getElementById("roomTypeForm").reset();
    document.getElementById("roomTypeId").value = "";
    document.getElementById("roomTypeFormTitle").innerText = "Add Room Type";
    document.getElementById("roomTypeSubmit").value = "Add Room Type";
    document.getElementById("cancelEditBtn").style.display = "none";
    clearRoomTypeErrors();
}
