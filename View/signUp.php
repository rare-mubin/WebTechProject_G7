<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="Style/signUp.css">
</head>

<body>
    <div class="signUpPage">
        <div class="signUpWrapper">
            <div class="leftPart">
                <form class="signUpForm" onsubmit="return addGuest();" method="post">

                    <h1 class="pageTitle">Sign Up</h1>
                    <p class="pageSubtitle">Create account</p>

                    <div class="fieldGroup">
                        <label for="name" class="formLabel">Name</label>
                        <input type="text" id="name" name="name" class="formControl" required>
                    </div>

                    <div class="fieldGroup">
                        <label for="email" class="formLabel">Email</label>
                        <input type="email" id="email" name="email" class="formControl" required>
                    </div>

                    <div class="fieldGroup">
                        <label for="phone" class="formLabel">Phone</label>
                        <input type="text" id="phone" name="phone" class="formControl"required>
                    </div>

                    <div class="fieldGroup">
                        <label for="nationality" class="formLabel">Nationality</label>
                        <div class="selectionWrap">
                            <select id="nationality" name="nationality" class="formSelection" >
                                <option value="">Select nationality</option>
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Indian">Indian</option>
                                <option value="Pakistani">Pakistani</option>
                                <option value="Nepali">Nepali</option>
                                <option value="Sri Lankan">Sri Lankan</option>
                                <option value="American">American</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="fieldGroup">
                        <label for="password" class="formLabel">Password</label>
                        <input type="password" id="password" name="password" class="formControl" required>
                    </div>
                    <p id="errorMessage" style='color: red;'></p>
                    <input type="submit" class="submitButton" value="Create Account">

                    <p class="loginLink"> Already have an account? <a href="login.php">Log Up</a></p>
                </form>
            </div>

            <div class="rightPart">
                <div class="hotelRightImage">
                    <img src="assets/images/login-side-image.jpg" alt="Hotel View">
                </div>
            </div>

        </div>
    </div>
    <script src="../Assets/js/signUp.js"></script>
</body>
</html>