function mybooking() {
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
            <tr>
                            <td>
                                <div class="room-info">
                                    <img src="../Image/room1.jpg" alt="Luxury Queen Bed">

                                    <div>
                                        <span>${response.data[i].roomtypeName}</span>
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
                                 <button onclick="deleteRegistration(${response.data[i].student_id})">Cancel</button>
                            </td>
                        </tr>
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