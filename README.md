# Hotel Management System (MVC)

Simple hotel management system built with PHP using an MVC architecture. The app runs on Apache and uses the SQL database bundled with XAMPP (MySQL/MariaDB).

## Requirements

- XAMPP (Apache + MySQL/MariaDB)
- A web browser

## Project Structure (MVC)

- Controller/ - Request handling and app flow
- Model/ - Data access and business logic (includes dataConnection.php)
- View/ - UI templates (includes index.php)

## Setup

1. Copy the project folder to your XAMPP web root:
	- `d:\Apps\XAMPP\htdocs\WebTechProject_G7`
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Create the database using the SQL script:
	- Open `http://localhost/phpmyadmin`
	- Create a new database (example: `hotel_management`)
	- Import `DataBaseScript.sql`
4. Configure database credentials in `Model/dataConnection.php` to match your local setup.

## Run the App

1. Open your browser and go to:
	- `http://localhost/WebTechProject_G7/View/index.php`
2. Use the UI to manage hotel data (rooms, bookings, guests, etc.).

## Notes

- If you use a different database name, update it in `dataConnection.php`.
- Make sure Apache and MySQL services are running before launching the app.
