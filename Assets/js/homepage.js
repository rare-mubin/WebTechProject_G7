function searchform() {
  let checkInDate = document.getElementById("checkin").value;
  let checkOutDate = document.getElementById("checkout").value;
  let guests = document.getElementById("guests").value;

  let xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);

      if (response == "error") {
        console.error(response.message);
        document.getElementById("err").innerText = response.message;
        document.getElementById("roomResult").innerHTML = "";
      } else {
        //document.getElementById("err").innerText = "";

        let res = "";

        for (let i = 0; i < response.data.length; i++) {
          res += `
            <div class="room-card">
              <h3>${response.data[i].name}</h3>
              <p>${response.data[i].description}</p>
              <p>Price per night: ${response.data[i].price_per_night}</p>
              <p>Max guest: ${response.data[i].max_capacity}</p>
              <button>Book Now</button>
            </div>
          `;
        }
        console.log(response);
        document.getElementById("roomResult").innerHTML = res;
      }
    }
  };

  xhttp.open("POST", "/WebTechProject_G7/Controller/SearchFormValidate.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.send(
    "action=searchRoom" +
    "&checkIn=" + checkInDate +
    "&checkOut=" + checkOutDate +
    "&guests=" + guests
  );
}










function handleLinkClick(e) {
  e.preventDefault();

  const page = this.dataset.page;
  const title = this.dataset.title;

  const links = document.querySelectorAll(".nav-link");
  links.forEach(function (link) {
    link.classList.toggle("active", link.dataset.page === page);
  });

  const content = document.getElementById("page-content");
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "pages/" + page + ".php", true);

  xhr.onload = function () {
    if (xhr.status === 200 && content) {
      content.innerHTML = xhr.responseText;
      document.title = title || document.title;

       if (page === 'Roomtype') {
        loadScriptOnce('/WebTechProject_G7/Assets/js/Roomtype.js', 'roomtype-js');
      }
      
    }
  };

  xhr.send();
}

function loadScriptOnce(src, id) {
  
  const existing = document.getElementById(id);
  if (existing) {
    existing.remove();
  }

  const script = document.createElement('script');
  script.src = src;
  script.id = id;
  document.body.appendChild(script);
}

function initDashboard() {
  const links = document.querySelectorAll(".nav-link[data-page]");
  links.forEach(function (link) {
    link.addEventListener("click", handleLinkClick);
  });
}



document.addEventListener("DOMContentLoaded", initDashboard);