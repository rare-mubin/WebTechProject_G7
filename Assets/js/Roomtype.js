function addRoomType() {
    let roomtypeName = document.getElementById("roomtypeName").value;
    let perNightRate = document.getElementById("perNightRate").value;
    let description = document.getElementById("description").value;
    let maxCapacity = document.getElementById("maxCapacity").value;

    let wifi = document.getElementById("wifi").checked ? 1 : 0;
    let ac = document.getElementById("ac").checked ? 1 : 0;
    let smartTv = document.getElementById("smartTv").checked ? 1 : 0;
    let breakfast = document.getElementById("breakfast").checked ? 1 : 0;

    let roomImage = document.getElementById("roomImage").files[0];

    document.getElementById("roomtypeNameError").innerHTML = "";
    document.getElementById("perNightRateError").innerHTML = "";
    document.getElementById("descriptionError").innerHTML = "";
    document.getElementById("maxCapacityError").innerHTML = "";
    document.getElementById("amenitiesError").innerHTML = "";
    document.getElementById("roomImageError").innerHTML = "";

    let isValid = true;

    if (roomtypeName === "") {
        document.getElementById("roomtypeNameError").innerHTML = "Room type name is required";
        isValid = false;
    } else if (!/^[a-zA-Z-' ]+$/.test(roomtypeName)) {
        document.getElementById("roomtypeNameError").innerHTML = "Only letters and white space allowed";
        isValid = false;
    } else if (roomtypeName.length < 4) {
        document.getElementById("roomtypeNameError").innerHTML = "Room type name should be more than 4 characters";
        isValid = false;
    }

    if (perNightRate === "") {
        document.getElementById("perNightRateError").innerHTML = "Per night rate is required";
        isValid = false;
    } else if (isNaN(perNightRate)) {
        document.getElementById("perNightRateError").innerHTML = "Per night rate must be number";
        isValid = false;
    } else if (Number(perNightRate) <= 0) {
        document.getElementById("perNightRateError").innerHTML = "Per night rate must be greater than 0";
        isValid = false;
    }

    if (description === "") {
        document.getElementById("descriptionError").innerHTML = "Description is required";
        isValid = false;
    }

    if (maxCapacity === "") {
        document.getElementById("maxCapacityError").innerHTML = "Max capacity is required";
        isValid = false;
    } else if (isNaN(maxCapacity)) {
        document.getElementById("maxCapacityError").innerHTML = "Max capacity must be number";
        isValid = false;
    } else if (Number(maxCapacity) <= 0) {
        document.getElementById("maxCapacityError").innerHTML = "Max capacity must be greater than 0";
        isValid = false;
    }

    if (wifi === 0 && ac === 0 && smartTv === 0 && breakfast === 0) {
        document.getElementById("amenitiesError").innerHTML = "Please select at least one amenity";
        isValid = false;
    }

    if (!roomImage) {
        document.getElementById("roomImageError").innerHTML = "Room image is required";
        isValid = false;
    }

    if (isValid === false) {
        return;
    }

    let formData = new FormData();

    formData.append("action", "Add");
    formData.append("roomtypeName", roomtypeName);
    formData.append("perNightRate", perNightRate);
    formData.append("description", description);
    formData.append("maxCapacity", maxCapacity);
    formData.append("wifi", wifi);
    formData.append("ac", ac);
    formData.append("smartTv", smartTv);
    formData.append("breakfast", breakfast);
    formData.append("roomImage", roomImage);

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            let response = xhttp.responseText.trim();

            if (response === "OK") {
                alert("Room type added successfully");
            } else {
                alert(response);
            }
        }
    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roomtypevalidation.php", true);
    xhttp.send(formData);
}
