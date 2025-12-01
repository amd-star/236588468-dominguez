CREATE DATABASE IF NOT EXISTS pawlish_db;
USE pawlish_db;

-- 1. Users Table
-- Stores customers, groomers (therapists), and admins.
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'therapist', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Services Table
-- Stores the grooming packages (e.g., Full Cut, Bath, Nail Trim).
CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    description TEXT,
    duration INT NOT NULL COMMENT 'Duration in minutes',
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. Availability Table
-- Tracks when Groomers (Therapists) are working.
CREATE TABLE availability (
    availability_id INT AUTO_INCREMENT PRIMARY KEY,
    therapist_id INT NOT NULL,
    date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    FOREIGN KEY (therapist_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- 4. Appointments Table
-- The core booking table linking a User, a Groomer, and a Service.
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    therapist_id INT NOT NULL,
    service_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    status ENUM('pending', 'confirmed', 'completed', 'canceled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (therapist_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE CASCADE
);

-- 5. Payments Table
-- Tracks transaction details for appointments.
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method ENUM('cash', 'credit_card', 'paypal', 'gcash') NOT NULL,
    payment_status ENUM('paid', 'unpaid', 'refunded') DEFAULT 'unpaid',
    transaction_id VARCHAR(100),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id) ON DELETE CASCADE
);

-- 6. Reviews Table
-- Stores feedback after the service is completed.
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(appointment_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- =============================================
-- DUMMY DATA SEEDING (Optional - To test the system immediately)
-- =============================================

-- Insert Users (1 Admin, 1 Groomer, 1 Customer)
-- Password is 'password123' (hashed for security in real apps, plain here for testing)
INSERT INTO users (full_name, email, phone_number, password, role) VALUES 
('Admin Alice', 'admin@pawlish.com', '09171234567', 'password123', 'admin'),
('Groomer Gary', 'gary@pawlish.com', '09177654321', 'password123', 'therapist'),
('Customer Cathy', 'cathy@gmail.com', '09171112222', 'password123', 'customer');

-- Insert Services
INSERT INTO services (service_name, description, duration, price) VALUES 
('Full Grooming', 'Bath, haircut, nail trim, and ear cleaning.', 90, 850.00),
('Quick Bath', 'Shampoo and blowdry only.', 45, 400.00),
('Tick Treatment', 'Specialized anti-tick and flea bath.', 60, 600.00);

-- Insert Availability for Groomer Gary
INSERT INTO availability (therapist_id, date, start_time, end_time) VALUES
(2, '2025-12-05', '09:00:00', '17:00:00');
