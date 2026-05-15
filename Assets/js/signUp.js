function addGuest()
{
    console.log("addGuest function called");
    event.preventDefault();
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("password").value;
    let nationality = document.getElementById("nationality").value;

    if (!name) {
        document.getElementById("nameError").innerText = "Name is required";
        return false;
    } else {
        document.getElementById("nameError").innerText = "";
    }
    if (!email) {
        document.getElementById("emailError").innerText = "Email is required";
        return false;
    } else {
        document.getElementById("emailError").innerText = "";
    }
    if (!phone) {
        document.getElementById("phoneError").innerText = "Phone is required";
        return false;
    } else {
        document.getElementById("phoneError").innerText = "";
    }
    if (!nationality) {
        document.getElementById("optionError").innerText = "Nationality is required";
        return false;
    } else {
        document.getElementById("optionError").innerText = "";
    }
    if (!password) {
        document.getElementById("passwordError").innerText = "Password is required";
        return false;
    } else {
        document.getElementById("passwordError").innerText = "";
    }


    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            let response = xhttp.responseText.trim();
            if (response === "OK") {
                alert("Registration successful!");
                window.location.href = "logIn.php";
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