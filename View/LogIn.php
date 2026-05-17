<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="Style/logIn.css">
</head>
<body>
    <div class="logInPage">
        <div class="logInWrapper">
            <div class="leftPart">
                <form class="loginForm" onsubmit="return loginUser();" method="post">

                    <img src="../Assets/images/logo.png" alt="Hotel Logo" class="logo-image">

                    <h1 class="welcomeTitle">Welcome to MoonLight Hotel</h1>
                    <p class="welcomeTitleErNiche">Log into your account</p>

                    <div class="fieldErGroup">
                        <label for="email" class="formLabel">Email</label>
                        <input type="email" id="email" name="email" class="formControl" placeholder="Enter your email">
                        <p id="emailError" style='color: red;'></p>
                    </div>

                    <div class="fieldErGroup">
                        <label for="password" class="formLabel">Password</label>
                        <input type="password" id="password" name="password" class="formControl password-field" placeholder="Enter your password">
                        <p id="passwordError" style='color: red;'></p>
                    </div>

                    <div class="formErOptions">
                        <label class="rememberMe" for="moneRekhoAmake">
                        <input type="checkbox" id="moneRekhoAmake" name="moneRekhoAmake">
                        <span>Remember Me</span></label>

                        <a href="#" class="forgotLink">Forgot Password?</a>
                    </div>

                    <button type="submit" class="loginButton">Log In</button>
                    <p id="errorMessage" style='color: red;'></p>

                    <p class="signupLink">Don't have any account?<a href="signup.php">Sign Up</a></p>
                </form>
            </div>

            <div class="rightPart">
                <div class="hotelRightImage">
                    <img src="../Assets/images/login-side-image.jpg" alt="Hotel View">
                </div>
            </div>

        </div>
    </div>
    <script src="../Assets/js/login.js"></script>
</body>
</html>
