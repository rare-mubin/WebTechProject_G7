function bookingPage() {
  const content = document.getElementById("page-content");

  if (!content) {
    window.location.href = "/WebTechProject_G7/View/guest/pages/BookingPage.php";
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/WebTechProject_G7/View/guest/pages/BookingPage.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      content.innerHTML = xhr.responseText;
      document.title = "Booking Page";
    } else {
      console.error("Failed to load booking page:", xhr.status, xhr.statusText);
      content.innerHTML = "<p>Unable to load booking page. Please try again later.</p>";
    }
  };

  xhr.onerror = function () {
    console.error("Network error while loading booking page.");
    content.innerHTML = "<p>Unable to load booking page. Please check your connection.</p>";
  };

  xhr.send();
}

function searchform() {
  let checkInDate = document.getElementById("checkin").value;
  let checkOutDate = document.getElementById("checkout").value;
  let guests = document.getElementById("guests").value;
  let errorBox = document.getElementById("err");
  let roomResult = document.getElementById("roomResult");
  let today = new Date().toISOString().split("T")[0];

  if (errorBox) {
    errorBox.innerText = "";
  }

  if (checkInDate < today) {
    if (errorBox) {
      errorBox.innerText = "Check-in date must be today or later";
    }
    roomResult.innerHTML = "";
    return;
  }

  if (checkOutDate <= checkInDate) {
    if (errorBox) {
      errorBox.innerText = "Check-out date must be after check-in date";
    }
    roomResult.innerHTML = "";
    return;
  }

  let xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      let response;

      try {
        response = JSON.parse(this.responseText);
      } catch (error) {
        console.error("Invalid JSON response:", this.responseText);
        if (errorBox) {
          errorBox.innerText = "Could not load available rooms.";
        }
        roomResult.innerHTML = "";
        return;
      }

      if (this.status !== 200 || response.status === "error") {
        console.error(response.message || "Room search failed");
        if (errorBox) {
          errorBox.innerText = response.message || "Could not load available rooms.";
        }
        roomResult.innerHTML = "";
        return;
      }

      let rooms = Array.isArray(response) ? response : response.data;
      let res = "";

      if (!rooms || rooms.length === 0) {
        roomResult.innerHTML = "<p>No rooms are available for the selected dates.</p>";
        return;
      }

      for (let i = 0; i < rooms.length; i++) {
        let amenities = Array.isArray(rooms[i].amenities) ? rooms[i].amenities.join(", ") : "";
        res += `
          <div class="room-card">
            <h3>${rooms[i].name}</h3>
            <p>${rooms[i].description || ""}</p>
            <p>Amenities: ${amenities || "Not listed"}</p>
            <p>Price per night: ${Number(rooms[i].price_per_night).toFixed(2)}</p>
            <p>Total price: ${Number(rooms[i].total_price).toFixed(2)}</p>
            <p>Max guest: ${rooms[i].max_capacity}</p>
            <button type="button" onclick="openBookingPage(${rooms[i].id})">Book Now</button>
          </div>
        `;
      }

      console.log(rooms);
      roomResult.innerHTML = res;
    }
  };

  xhttp.open(
    "GET",
    "/WebTechProject_G7/Controller/SearchFormValidate.php?checkin=" + encodeURIComponent(checkInDate) +
      "&checkout=" + encodeURIComponent(checkOutDate) +
      "&guests=" + encodeURIComponent(guests),
    true
  );
  xhttp.send();
}

function openBookingPage(roomTypeId) {
  let checkInDate = document.getElementById("checkin").value;
  let checkOutDate = document.getElementById("checkout").value;
  let guests = document.getElementById("guests").value;

  window.location.href =
    "/WebTechProject_G7/Controller/BookingPageController.php?room_type_id=" + encodeURIComponent(roomTypeId) +
    "&checkin=" + encodeURIComponent(checkInDate) +
    "&checkout=" + encodeURIComponent(checkOutDate) +
    "&guests=" + encodeURIComponent(guests);
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
      if (page === 'profile') {
        loadScriptOnce('/WebTechProject_G7/Assets/js/profile.js', 'profile-js');
      }
      if (page === 'MybookingPage') {
        loadScriptOnce('/WebTechProject_G7/Assets/js/mybooking.js', 'mybookingpage-js');
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
