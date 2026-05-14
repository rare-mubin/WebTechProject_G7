function addGuest()
{
    console.log("addGuest function called");
    event.preventDefault();
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("password").value;
    let nationality = document.getElementById("nationality").value;
    
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
    xhttp.open("POST", "../Controller/RegValidate.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=Add&name=" + name + "&email=" + email + "&password=" + password + "&nationality=" + nationality + "&phone=" + phone);
}