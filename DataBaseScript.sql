USE hotel_r;

CREATE TABLE room_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name ENUM('Standard', 'Deluxe', 'Suite') NOT NULL,
  description TEXT,
  price_per_night DECIMAL(10, 2) NOT NULL,
  max_capacity TINYINT UNSIGNED NOT NULL,
  thumbnail_path VARCHAR(255),
  amenities JSON,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  phone VARCHAR(30),
  nationality VARCHAR(80),
  role ENUM('guest', 'admin') NOT NULL DEFAULT 'guest',
  preferred_room_type_id INT UNSIGNED,
  special_requests TEXT,
  remember_token VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_users_preferred_room_type
    FOREIGN KEY (preferred_room_type_id)
    REFERENCES room_types(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL
);

CREATE TABLE rooms (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  room_type_id INT UNSIGNED NOT NULL,
  room_number VARCHAR(20) NOT NULL UNIQUE,
  floor TINYINT UNSIGNED NOT NULL,
  status ENUM('available', 'maintenance') NOT NULL DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_rooms_room_type
    FOREIGN KEY (room_type_id)
    REFERENCES room_types(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE bookings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  room_id INT UNSIGNED NOT NULL,
  checkin_date DATE NOT NULL,
  checkout_date DATE NOT NULL,
  total_price DECIMAL(10, 2) NOT NULL,
  status ENUM('Pending', 'Confirmed', 'Checked-In', 'Checked-Out', 'Cancelled')
    NOT NULL DEFAULT 'Pending',
  actual_checkin DATETIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_bookings_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT fk_bookings_room
    FOREIGN KEY (room_id)
    REFERENCES rooms(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  CONSTRAINT chk_booking_dates
    CHECK (checkout_date > checkin_date)
);
