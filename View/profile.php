<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        :root {
            --bg: #f6f2ea;
            --panel: #ffffff;
            --soft: #f8f6f2;
            --line: #e5ded1;
            --text: #171717;
            --muted: #6f6a63;
            --accent: #9a7d43;
            --accent-dark: #846a39;
            --shadow: 0 16px 36px rgba(76, 58, 29, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(154, 125, 67, 0.10), transparent 22%),
                linear-gradient(180deg, #fbf9f4 0%, #f3eee4 100%);
        }

        .page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 28px 24px 40px;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 28px 32px 18px;
            box-shadow: 0 10px 28px rgba(76, 58, 29, 0.06);
        }

        .topbar h1 {
            margin: 0 0 22px;
            font-size: 2.3rem;
            font-weight: 700;
        }

        .tab {
            display: inline-block;
            padding-bottom: 12px;
            border-bottom: 4px solid #111;
            font-weight: 600;
        }

        .layout {
            margin-top: 18px;
            display: grid;
            grid-template-columns: 420px 1fr;
            gap: 22px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .sidebar {
            padding: 28px;
        }

        .profile-head {
            display: flex;
            align-items: center;
            gap: 18px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--line);
        }

        .avatar {
            width: 94px;
            height: 94px;
            border-radius: 24px;
            background: linear-gradient(135deg, #ffb85f, #da7638);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .profile-head h2 {
            margin: 0 0 8px;
            font-size: 2rem;
            line-height: 1.1;
        }

        .member-code,
        .role-text {
            margin: 0;
            color: var(--muted);
        }

        .info-section {
            padding: 24px 0;
            border-bottom: 1px solid var(--line);
        }

        .info-section:last-of-type {
            border-bottom: 0;
        }

        .info-section h3 {
            margin: 0 0 14px;
            font-size: 1.3rem;
        }

        .info-list {
            display: grid;
            gap: 12px;
        }

        .info-list p {
            margin: 0;
            line-height: 1.5;
        }

        .info-list strong {
            display: inline-block;
            min-width: 135px;
            color: var(--muted);
            font-weight: 600;
        }

        .edit-btn {
            display: inline-flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            margin-top: 24px;
            padding: 16px 18px;
            border-radius: 18px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            font-size: 1.45rem;
        }

        .main-panel {
            background: var(--soft);
            border: 1px solid var(--line);
            border-radius: 24px;
            padding: 24px;
        }

        .main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.85fr);
            gap: 24px;
            align-items: start;
        }

        .form-card,
        .booking-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .form-card {
            padding: 26px;
        }

        .form-card h3,
        .booking-card h3 {
            margin: 0 0 20px;
            font-size: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field,
        .field-full {
            display: grid;
            gap: 8px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            color: #3e382f;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d7cfbf;
            border-radius: 14px;
            font: inherit;
            background: #fffefb;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 4px;
        }

        .checkbox-row input {
            width: 18px;
            height: 18px;
            margin: 0;
        }

        .actions {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
        }

        .save-btn {
            border: 0;
            border-radius: 16px;
            padding: 14px 28px;
            background: var(--accent);
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
        }

        .booking-card {
            min-height: 520px;
            padding: 22px;
            border: 3px solid rgba(154, 125, 67, 0.92);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .booking-body {
            flex: 1;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 28px 10px;
        }

        .booking-title {
            margin: 0 0 18px;
            font-size: 2.25rem;
            line-height: 1.15;
        }

        .booking-details {
            display: grid;
            gap: 12px;
            color: #2f2b26;
        }

        .badge {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(46, 125, 50, 0.14);
            color: #246b27;
            font-weight: 700;
            width: fit-content;
            margin: 6px auto 0;
        }

        .booking-link {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 16px 18px;
            border-radius: 18px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .hint {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #f3ede2;
            color: #5a5143;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        @media (max-width: 1120px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .main-grid {
                grid-template-columns: 1fr;
            }

            .booking-card {
                min-height: 420px;
            }
        }

        @media (max-width: 720px) {
            .page {
                padding: 18px 14px 28px;
            }

            .topbar,
            .card,
            .main-panel,
            .form-card,
            .booking-card {
                border-radius: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .profile-head {
                align-items: flex-start;
            }

            .profile-head h2 {
                font-size: 1.65rem;
            }

            .booking-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="topbar">
            <h1>Profile</h1>
            <span class="tab">Overview</span>
        </header>

        <section class="layout">
            <aside class="card sidebar">
                <div class="profile-head">
                    <div class="avatar">N</div>
                    <div>
                        <h2>Nicholas Swatz</h2>
                        <p class="member-code">#USR246534</p>
                        <p class="role-text">Role: Guest</p>
                    </div>
                </div>

                <div class="info-section">
                    <h3>About</h3>
                    <div class="info-list">
                        <p><strong>Phone:</strong> (629) 555-0123</p>
                        <p><strong>Email:</strong> nicholasswatz@gmail.com</p>
                    </div>
                </div>

                <div class="info-section">
                    <h3>Preferences</h3>
                    <div class="info-list">
                        <p><strong>Nationality:</strong> American</p>
                        <p><strong>Preferred room:</strong> Deluxe Suite</p>
                        <p><strong>Offers:</strong> Subscribed</p>
                    </div>
                </div>

                <div class="info-section">
                    <h3>Account Details</h3>
                    <div class="info-list">
                        <p><strong>Member since:</strong> Jan 05, 2023</p>
                        <p><strong>Special requests:</strong> High floor room, non-smoking</p>
                    </div>
                </div>

                <a href="#edit-profile" class="edit-btn">Edit Profile</a>
            </aside>

            <div class="main-panel">
                <div class="main-grid">
                    <div class="form-card" id="edit-profile">
                        <h3>Profile & Preferences</h3>

                        <form action="#" method="post">
                            <div class="form-grid">
                                <div class="field">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="Nicholas Swatz">
                                </div>

                                <div class="field">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" value="nicholasswatz@gmail.com">
                                </div>

                                <div class="field">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" value="(629) 555-0123">
                                </div>

                                <div class="field">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" id="nationality" name="nationality" value="American">
                                </div>

                                <div class="field-full">
                                    <label for="preferred_room_type_id">Preferred Room Type</label>
                                    <select id="preferred_room_type_id" name="preferred_room_type_id">
                                        <option value="">Select room type</option>
                                        <option value="1">Standard Room</option>
                                        <option value="2" selected>Deluxe Suite</option>
                                        <option value="3">Family Room</option>
                                        <option value="4">Presidential Suite</option>
                                    </select>
                                </div>

                                <div class="field-full">
                                    <label for="special_requests">Special Requests</label>
                                    <textarea id="special_requests" name="special_requests">High floor room, non-smoking</textarea>
                                </div>

                                <div class="field-full">
                                    <label class="checkbox-row" for="subscribe_offers">
                                        <input type="checkbox" id="subscribe_offers" name="subscribe_offers" checked>
                                        <span>Subscribe to offers</span>
                                    </label>
                                </div>
                            </div>

                            <div class="actions">
                                <button type="submit" class="save-btn">Save Changes</button>
                            </div>
                        </form>

                    </div>

                    <div class="booking-card">
                        <div>
                            <h3>Upcoming Booking</h3>
                            <div class="booking-body">
                                <div>
                                    <h4 class="booking-title">Deluxe Suite</h4>
                                    <div class="booking-details">
                                        <span><strong>Check-in:</strong> Jun 18, 2026</span>
                                        <span><strong>Check-out:</strong> Jun 21, 2026</span>
                                        <span><strong>Status:</strong></span>
                                        <span class="badge">Confirmed</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="booking-link">My Bookings</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
