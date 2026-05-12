<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hotel Login</title>
    </head>
    <body>
        <div class="loginPage">
            <form method="POST">
                    <img src="hotel_logo.png" alt="Hotel Logo"> 
                    <h1>Welcome to MoonLight</h1>
                    <p>Log into your account</p>
                    
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div>
                        <label for="remember me">
                        <input type="checkbox" id="remember me" name="remember me">
                        <span>Remember Me</span>
                        </label>
                    </div>

                        <a href="forgot_password.php">Forgot Password?</a>

                        <button type="submit">Log In</button>

                    <div>
                        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                    </div>

                </table>
            </form>
        </div>
        <div class="rightside">
            <img src="hotel_image.jpg" alt="Hotel Image">
        </div>
    </body>
</html>