-- Create database (if not already created)
CREATE DATABASE IF NOT EXISTS hrts_db;
USE hrts_db;

-- Users table (collects user name, email and hashed password)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Rooms table (each room is categorized as basic, normal or deluxe)
CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category ENUM('basic', 'normal', 'deluxe') NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,  -- price per night in Kenyan Shillings
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings table (stores booking info including taxi details)
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    taxi_category ENUM('medium', 'large', 'luxury') NOT NULL,
    arrival_point VARCHAR(150) NOT NULL,  -- drop-off location e.g., airport, rail station, bus station
    total_price DECIMAL(10,2) NOT NULL,     -- combined room and taxi price
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    driver_details VARCHAR(255),          -- simulated driver info
    car_number_plate VARCHAR(50),         -- simulated car plate
    pickup_time TIME,                     -- simulated pickup time
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- Insert sample room data
INSERT INTO rooms (category, name, description, price, image) VALUES
('basic', 'Basic Room', 'A comfortable basic room.', 3000.00, 'images/basic.jpg'),
('normal', 'Normal Room', 'A well-appointed normal room.', 5000.00, 'images/normal.jpg'),
('deluxe', 'Deluxe Room', 'A luxurious deluxe room with sea view.', 8000.00, 'images/deluxe.jpg');
