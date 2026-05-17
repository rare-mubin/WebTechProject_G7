<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #fff;
        }

        /* ================= NAVBAR ================= */

        .navbar-wrapper {
            width: 100%;
            padding: 0px 80px;
            position: fixed;
            top: 20px;
            left: 0;
            z-index: 1000;
        }

        .navbar-box {
            max-width: 1400px;
            margin: 0 auto;
            padding: 18px 28px;
            background: rgba(0, 0, 0, 0.30);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 32px;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 40px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #d4a762;
        }

        .nav-btn {
            padding: 12px 28px;
            border: 1px solid white;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-btn:hover,
        .nav-btn.active {
            background: white;
            color: black;
        }

        /* ================= AJAX CONTENT ================= */

        #page-content {
            min-height: 100vh;
        }

        #loading {
            display: none;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        #loading.show {
            display: flex;
        }

        #loading::after {
            content: "";
            width: 42px;
            height: 42px;
            border: 3px solid #eee;
            border-top-color: #d4a762;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ================= HERO SECTION ================= */

        .hero {
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45));
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .hero-content {
            color: white;
            max-width: 850px;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-size: 70px;
            line-height: 1.2;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .hero-content p {
            font-size: 18px;
            line-height: 30px;
            margin-bottom: 40px;
            color: #f1f1f1;
        }

        /* ================= BOOKING BOX ================= */

        .booking-box {
            width: 80%;
            max-width: 1520px;
            background: white;
            padding: 25px;
            border-radius: 15px;
            position: absolute;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
        }

        .booking-field {
            text-align: left;
            flex: 1;
            min-width: 0;
            padding: 0 20px;
            border-right: 1px solid #ddd;
        }

        .booking-field label {
            display: block;
            color: #777;
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: 500;
        }

        .booking-field input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 20px;
            font-weight: 600;
            color: #222;
        }

        .booking-btn {
            background: #222;
            color: white;
            border: none;
            padding: 20px 45px;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .booking-btn:hover {
            background: #d4a762;
        }

        /*============================================ABOUT US==============================================================*/

        .about-section {
            padding: 120px 10%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 70px;
            background: #fff;
        }

        .about-text {
            max-width: 430px;
            text-align: center;
        }

        .about-text span,
        .rooms-section span,
        .page-section span {
            color: #d4a762;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .about-text h2,
        .rooms-section h2,
        .page-section h2 {
            font-size: 34px;
            font-weight: 500;
            margin: 12px 0 20px;
            color: #222;
        }

        .about-text p,
        .page-section p {
            color: #666;
            font-size: 14px;
            line-height: 26px;
            margin-bottom: 22px;
        }

        .about-text a {
            color: #222;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .about-images {
            display: flex;
            gap: 20px;
        }

        .about-images img {
            width: 190px;
            height: 260px;
            object-fit: cover;
            background: #eee;
        }

        .rooms-section {
            padding: 25px 0 0;
            text-align: center;
            background: #fff;
        }

        .room-card-wrapper {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .room-card {
            height: 420px;
            position: relative;
            overflow: hidden;
            background: #222;
        }

        .room-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }

        .room-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
        }

        .room-card:hover img {
            transform: scale(1.08);
        }

        .room-info {
            position: absolute;
            left: 28px;
            bottom: 28px;
            z-index: 2;
            color: white;
            text-align: left;
        }

        .room-info h3 {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .room-info p {
            margin-bottom: 18px;
        }

        .room-info strong {
            color: #d4a762;
            font-size: 24px;
        }

        .room-info a {
            color: white;
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
            border-bottom: 1px solid white;
            padding-bottom: 4px;
        }

        #err {
            position: absolute;
            left: 50%;
            bottom: 5px;
            transform: translateX(-50%);
            color: #b42318;
            font-size: 14px;
            font-weight: 600;
        }

        #roomResult {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
            padding: 70px 10%;
            background: #f7f4ef;
        }

        #roomResult:empty {
            display: none;
        }

        #roomResult .room-card {
            height: auto;
            min-height: 0;
            position: relative;
            overflow: visible;
            background: white;
            color: #222;
            padding: 24px;
            border: 1px solid #eadfce;
            border-radius: 8px;
            text-align: left;
            box-shadow: 0 10px 24px rgba(32, 39, 56, 0.08);
        }

        #roomResult .room-card::after {
            display: none;
        }

        #roomResult .room-card h3 {
            color: #222;
            font-size: 24px;
            margin-bottom: 12px;
        }

        #roomResult .room-card p {
            color: #555;
            font-size: 14px;
            line-height: 24px;
            margin-bottom: 8px;
        }

        #roomResult .room-card button {
            margin-top: 12px;
            padding: 12px 18px;
            border: none;
            border-radius: 6px;
            background: #222;
            color: white;
            cursor: pointer;
        }

        #roomResult .room-card button:hover {
            background: #d4a762;
        }

        #roomResult > p {
            grid-column: 1 / -1;
            color: #555;
            text-align: center;
        }

        .page-section {
            min-height: 78vh;
            padding: 170px 10% 90px;
            text-align: center;
            background: #fff;
        }

        .contact-form {
            max-width: 760px;
            margin: 45px auto 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border: 1px solid #ddd;
            outline: none;
            padding: 16px;
            font-size: 15px;
        }

        .contact-form textarea {
            min-height: 150px;
            resize: vertical;
            grid-column: 1 / -1;
        }

        .contact-form button {
            grid-column: 1 / -1;
            justify-self: center;
        }

        /*=====================Footer==============================*/

        .footer {
            background: #202738;
            padding: 70px 10%;
            color: #b8bfcc;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            gap: 80px;
        }

        .footer-about h2 {
            color: white;
            font-size: 34px;
            font-family: Georgia, serif;
            font-weight: 400;
            margin-bottom: 18px;
        }

        .footer-about h2 span {
            color: #d4a762;
        }

        .footer p {
            font-size: 14px;
            line-height: 26px;
            margin-bottom: 8px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .social-links a {
            width: 32px;
            height: 32px;
            border: 1px solid #4b5365;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .social-links a:hover {
            background: #d4a762;
            border-color: #d4a762;
        }

        .footer h4 {
            color: #d4a762;
            font-size: 13px;
            letter-spacing: 2px;
            margin-bottom: 22px;
        }

        .footer-form {
            display: flex;
            margin-top: 18px;
        }

        .footer-form input {
            width: 220px;
            border: none;
            outline: none;
            background: #3a4050;
            color: white;
            padding: 15px;
        }

        .footer-form input::placeholder {
            color: #a8afbd;
        }

        .footer-form button {
            width: 52px;
            border: none;
            background: #d4a762;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 992px) {
            .navbar-wrapper {
                top: 12px;
                padding: 0 20px;
            }

            .navbar-box {
                padding: 14px 18px;
            }

            .nav-links {
                display: none;
            }

            .hero {
                height: auto;
                min-height: 100vh;
                padding: 140px 20px 320px;
            }

            .hero-content h1 {
                font-size: 42px;
            }

            .booking-box {
                flex-direction: column;
                width: 90%;
                bottom: 40px;
            }

            .booking-field {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
                padding: 0 0 15px;
            }

            .booking-field:last-of-type {
                border-bottom: none;
            }

            .booking-btn {
                width: 100%;
            }

            .about-section {
                flex-direction: column;
                padding: 100px 30px;
            }

            .room-card-wrapper,
            .contact-form {
                grid-template-columns: 1fr;
            }

            .room-card {
                height: 360px;
            }

            .page-section {
                padding: 140px 30px 70px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .footer {
                padding: 55px 30px;
            }

            .footer-form input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header class="navbar-wrapper">
        <?php include 'navbar.php'; ?>
    </header>

    <main>
        <div id="loading"></div>
        <div id="page-content">
            <?php include 'pages/home.php'; ?>
        </div>
    </main>
    <footer class="footer">
        <?php include 'footer.php'; ?>
    </footer>
    <script src="../../Assets/js/homepage.js"></script>
</body>
</html>
