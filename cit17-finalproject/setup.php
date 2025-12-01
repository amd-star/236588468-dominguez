<?php
$conn = new mysqli("localhost", "root", "");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// 1. Create DB
$conn->query("DROP DATABASE IF EXISTS pawlish_db");
if ($conn->query("CREATE DATABASE pawlish_db") === TRUE) echo "Database created...<br>";
$conn->select_db("pawlish_db");

// 2. Create Tables
$tables = [
    "users" => "CREATE TABLE users (user_id INT AUTO_INCREMENT PRIMARY KEY, full_name VARCHAR(100), email VARCHAR(100) UNIQUE, password VARCHAR(255), role ENUM('customer','therapist','admin') DEFAULT 'customer')",
    "pets" => "CREATE TABLE pets (pet_id INT AUTO_INCREMENT PRIMARY KEY, owner_id INT, pet_name VARCHAR(50), breed VARCHAR(50), age INT, FOREIGN KEY (owner_id) REFERENCES users(user_id) ON DELETE CASCADE)",
    "services" => "CREATE TABLE services (service_id INT AUTO_INCREMENT PRIMARY KEY, service_name VARCHAR(100), duration INT, price DECIMAL(10,2))",
    "availability" => "CREATE TABLE availability (availability_id INT AUTO_INCREMENT PRIMARY KEY, therapist_id INT, date DATE, start_time TIME, end_time TIME)",
    "appointments" => "CREATE TABLE appointments (appointment_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, pet_id INT, therapist_id INT, service_id INT, appointment_date DATE, start_time TIME, end_time TIME, status ENUM('pending','confirmed','canceled') DEFAULT 'pending', FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE)",
    "payments" => "CREATE TABLE payments (payment_id INT AUTO_INCREMENT PRIMARY KEY, appointment_id INT, amount DECIMAL(10,2), payment_status ENUM('paid','unpaid') DEFAULT 'unpaid', transaction_id VARCHAR(100))",
    "reviews" => "CREATE TABLE reviews (review_id INT AUTO_INCREMENT PRIMARY KEY, appointment_id INT, rating INT, comment TEXT)"
];

foreach ($tables as $name => $sql) { $conn->query($sql); echo "Table $name created...<br>"; }

// 3. Insert Dummy Data
$conn->query("INSERT INTO users (full_name, email, password, role) VALUES ('Admin', 'admin@pawlish.com', '123', 'admin'), ('Gary Groomer', 'gary@pawlish.com', '123', 'therapist'), ('Cathy Customer', 'cathy@gmail.com', '123', 'customer')");
$conn->query("INSERT INTO services (service_name, duration, price) VALUES ('Full Groom', 90, 850.00), ('Bath', 45, 400.00)");
$conn->query("INSERT INTO pets (owner_id, pet_name, breed, age) VALUES (3, 'Brownie', 'Shih Tzu', 2)");

echo "<h3>✅ Setup Complete! <a href='index.php'>Go to Home</a></h3>";
?>