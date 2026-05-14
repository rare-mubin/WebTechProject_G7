function addRoomType() {

    alert("addRoomType function called"); 
    let roomTypeName = document.getElementById('roomtypeName').value;
    let perNightRate = document.getElementById('perNightRate').value;
    let description = document.getElementById('description').value;
    let maxCapacity = document.getElementById('maxCapacity').value;     
    let wifi = document.getElementById('wifi').checked ? 1 : 0;
    let ac = document.getElementById('ac').checked ? 1 : 0;
    let smartTv = document.getElementById('smartTv').checked ? 1 : 0;
    let breakfast = document.getElementById('breakfast').checked ? 1 : 0;
    let roomImage = document.getElementById('roomImage').files[0];  


     let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            let response = xhttp.responseText.trim();
            if (response === "OK") {
                alert("Registration successful!");
            } 
            else {
                document.getElementById("errorMessage").innerText = response;
            }
        }
    };
    xhttp.open("POST", "../Controller/Roomtypevalidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=Add&roomTypeName=" + roomTypeName + "&perNightRate=" + perNightRate + "&description=" + description + "&maxCapacity=" + maxCapacity + "&wifi=" + wifi + "&ac=" + ac + "&smartTv=" + smartTv + "&breakfast=" + breakfast);
}
