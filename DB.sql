CREATE DATABASE IF NOT EXISTS dorms_reservation;
USE dorms_reservation;
CREATE TABLE IF NOT EXISTS DormsReservation (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    name VARCHAR(100),
    email VARCHAR(100),
    gender ENUM('Male', 'Female'),
    room_type ENUM('Single', 'Double'),
    check_in_date DATE,
    check_out_date DATE,
    room_number INT,
    occupancy INT,
    reservation_date DATETIME,
    status VARCHAR(20),
    national_id_photo LONGBLOB
);

CREATE TABLE Payments (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  card_number VARCHAR(16),
  card_type ENUM('Visa', 'Mastercard', 'American Express'),
  expiry_date VARCHAR(5),
  cvv VARCHAR(4),
  payment_date DATETIME
);

CREATE TABLE Contacts (
  contact_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  phone_number VARCHAR(20),
  message TEXT,
  contact_date DATETIME
);
CREATE TABLE students (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE admins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);
