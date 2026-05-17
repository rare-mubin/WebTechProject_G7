function saveProfile() {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const nationality = document.getElementById("nationality").value.trim();
  const preferredRoomTypeId = document.getElementById("preferred_room_type_id").value;
  const specialRequests = document.getElementById("special_requests").value.trim();
  const subscribeOffers = document.getElementById("subscribe_offers").checked ? "1" : "0";
  const responseBox = document.getElementById("profileMessage");

  if (!name || !email || !phone || !nationality) {
    responseBox.innerText = "Name, email, phone, and nationality are required.";
    responseBox.style.color = "#b42318";
    return false;
  }

  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (xhttp.readyState === 4) {
      let response;

      try {
        response = JSON.parse(xhttp.responseText);
      } catch (error) {
        responseBox.innerText = "Could not save profile changes.";
        responseBox.style.color = "#b42318";
        return false;
      }

      responseBox.innerText = response.message;
      responseBox.style.color = response.status === "success" ? "#246b27" : "#b42318";

      if (response.status === "success") {
        const sidebarName = document.getElementById("profileDisplayName");
        const sidebarEmail = document.getElementById("profileDisplayEmail");
        const sidebarPhone = document.getElementById("profileDisplayPhone");
        const sidebarNationality = document.getElementById("profileDisplayNationality");
        const sidebarPreferredRoom = document.getElementById("profilePreferredRoom");
        const sidebarOffers = document.getElementById("profileOffersText");
        const sidebarSpecialRequests = document.getElementById("profileSpecialRequests");
        const roomTypeSelect = document.getElementById("preferred_room_type_id");
        const selectedRoomText = roomTypeSelect.options[roomTypeSelect.selectedIndex].text;

        if (sidebarName) {
          sidebarName.innerText = name;
        }
        if (sidebarEmail) {
          sidebarEmail.innerText = email;
        }
        if (sidebarPhone) {
          sidebarPhone.innerText = phone;
        }
        if (sidebarNationality) {
          sidebarNationality.innerText = nationality;
        }
        if (sidebarPreferredRoom) {
          sidebarPreferredRoom.innerText = preferredRoomTypeId ? selectedRoomText : "Not set";
        }
        if (sidebarOffers) {
          sidebarOffers.innerText = subscribeOffers === "1" ? "Subscribed" : "Not subscribed";
        }
        if (sidebarSpecialRequests) {
          sidebarSpecialRequests.innerText = specialRequests || "None";
        }
      }
    }
  };

  xhttp.open("POST", "/WebTechProject_G7/Controller/profileValidation.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(
    "action=updateProfile" +
      "&name=" + encodeURIComponent(name) +
      "&email=" + encodeURIComponent(email) +
      "&phone=" + encodeURIComponent(phone) +
      "&nationality=" + encodeURIComponent(nationality) +
      "&preferred_room_type_id=" + encodeURIComponent(preferredRoomTypeId) +
      "&special_requests=" + encodeURIComponent(specialRequests) +
      "&subscribe_offers=" + encodeURIComponent(subscribeOffers)
  );

  return false;
}
