function searchform() {
  let checkInDate = document.getElementById("checkin").value;
  let checkOutDate = document.getElementById("checkout").value;
  let guests = document.getElementById("guests").value;

  let xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response.status == "error") {
        document.getElementById("err").innerText = response.message;
        document.getElementById("roomResult").innerHTML = "";
      } else {
        document.getElementById("err").innerText = "";

        let res = "";

        for (let i = 0; i < response.data.length; i++) {
          res += `
            <div class="room-card">
              <h3>${response.data[i].roomtypeName}</h3>
              <p>${response.data[i].description}</p>
              <p>Price per night: ${response.data[i].perNightRate}</p>
              <p>Max guest: ${response.data[i].maxCapacity}</p>
              <p>WiFi: ${response.data[i].wifi == 1 ? "Yes" : "No"}</p>
              <p>AC: ${response.data[i].ac == 1 ? "Yes" : "No"}</p>
              <p>Smart TV: ${response.data[i].smartTv == 1 ? "Yes" : "No"}</p>
              <p>Breakfast: ${response.data[i].breakfast == 1 ? "Yes" : "No"}</p>
              <button>Book Now</button>
            </div>
          `;
        }

        document.getElementById("roomResult").innerHTML = res;
      }
    }
  };

  xhttp.open("POST", "/WebTechProject_G7/Controller/RoomSearchController.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.send(
    "action=searchRoom" +
    "&checkIn=" + checkInDate +
    "&checkOut=" + checkOutDate +
    "&guests=" + guests
  );
}
