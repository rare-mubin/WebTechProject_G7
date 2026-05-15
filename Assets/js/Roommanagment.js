function addRoom() {


    let roomType = document.getElementById("roomType").value;
    let roomNumber = document.getElementById("roomNumber").value;
    let floor = document.getElementById("floor").value;
    let perNightRate = document.getElementById("perNightRate").value;


    document.getElementById("roomTypeError").innerHTML = "";
    document.getElementById("roomNumberError").innerHTML = "";
    document.getElementById("floorError").innerHTML = "";
    document.getElementById("perNightRateError").innerHTML = "";

    let isValid = true;

    

    if (roomType === "") {
        document.getElementById("roomTypeError").innerHTML = "Please select room type";
        isValid = false;
    }

    if (roomNumber === "") {
        document.getElementById("roomNumberError").innerHTML = "Room number is required";
        isValid = false;
    } else if (isNaN(roomNumber)) {
        document.getElementById("roomNumberError").innerHTML = "Room number must be number";
        isValid = false;
    } else if (Number(roomNumber) <= 0) {
        document.getElementById("roomNumberError").innerHTML = "Room number must be greater than 0";
        isValid = false;
    }

    if (floor === "") {
        document.getElementById("floorError").innerHTML = "Floor is required";
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

    if (isValid === false) {
        return;
    }


    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {

        if (xhttp.readyState === 4 && xhttp.status === 200) {

            let response = xhttp.responseText.trim();

            if (response === "OK") {
                alert("Room added successfully");
            } else {
                alert(response);
            }

        }

    };

    xhttp.open("POST", "/WebTechProject_G7/Controller/Roommanagmentvalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send(
        "action=Add" +
        "&roomType=" + roomType +
        "&roomNumber=" + roomNumber +
        "&floor=" + floor +
        "&perNightRate=" + perNightRate
    );
}
