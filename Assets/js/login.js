function loginUser()
{
    event.preventDefault();

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (!email) {
        document.getElementById("emailError").innerText = "Email is required";
        return false;
    } else {
        document.getElementById("emailError").innerText = "";
    }

    if (!password) {
        document.getElementById("passwordError").innerText = "Password is required";
        return false;
    } else {
        document.getElementById("passwordError").innerText = "";
    }

    document.getElementById("errorMessage").innerText = "";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            let response = xhttp.responseText.trim();

            if (response === "OK") {
                alert("Login successful!");
                window.location.href = "guest/Homepage.php";
            } else {
                document.getElementById("errorMessage").innerText = response;
            }
        }
    };

    xhttp.open("POST", "../Controller/loginValidation.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=Login&email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
}
