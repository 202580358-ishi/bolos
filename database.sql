-- El Nido Haven database
-- Import this in phpMyAdmin (Import tab) if the database is not there yet

CREATE DATABASE IF NOT EXISTS el_nido_haven;
USE el_nido_haven;

-- rooms
CREATE TABLE IF NOT EXISTS rooms (
    room_id INT(11) NOT NULL AUTO_INCREMENT,
    room_name VARCHAR(100) NOT NULL,
    max_capacity INT(11) NOT NULL,
    bed VARCHAR(100) DEFAULT NULL,
    amenities TEXT DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT NULL,
    PRIMARY KEY (room_id)
);

INSERT IGNORE INTO rooms (room_id, room_name, max_capacity, bed, amenities, price) VALUES
(1, 'Tropical Garden Deluxe', 2, 'King-size bed', 'Air conditioning, flat-screen TV, mini-bar, balcony, beach and garden view, pool access and pool breakfast.', 12000.00),
(2, 'Cozy Garden Standard', 2, 'Double bed', 'Air conditioning, pool access, flat-screen TV, comfortable stay.', 8000.00),
(3, 'VIP Beachfront Suite', 4, '2 King sized Bed', 'Air conditioning, flat-screen TV, private balcony, beachfront view, pool access, and complimentary breakfast.', 20000.00);

-- users (sign up / sign in)
CREATE TABLE IF NOT EXISTS users (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer','admin') DEFAULT 'customer',
    PRIMARY KEY (user_id),
    UNIQUE KEY email (email)
);

-- bookings (saved when user clicks Book Now)
CREATE TABLE IF NOT EXISTS bookings (
    booking_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    room_id INT(11) NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    status ENUM('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (booking_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);
