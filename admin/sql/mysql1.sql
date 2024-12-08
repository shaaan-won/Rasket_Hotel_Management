-- 1. Users Table
CREATE TABLE ht_users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255),
    role_id INT,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Roles Table
CREATE TABLE Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255),
    -- permissions JSON,
    -- created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    -- alter table roles add column created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
);



-- 3. RoomTypes Table
CREATE TABLE RoomTypes (
    room_type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(255),
    description TEXT,
    max_occupancy INT
);

-- 4. Rooms Table
CREATE TABLE Rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(255) UNIQUE,
    room_type_id INT,
    status ENUM('Available', 'Occupied', 'Maintenance'),
    description TEXT,
    price_per_night DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. Reservations Table
CREATE TABLE Reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    check_in_date DATE,
    check_out_date DATE,
    special_requests TEXT,
    status ENUM('Confirmed', 'Pending', 'Canceled'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 6. CheckInCheckOut Table
CREATE TABLE CheckInCheckOut (
    check_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    check_in_time TIMESTAMP,
    check_out_time TIMESTAMP,
    status ENUM('Checked-In', 'Checked-Out'),
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Billing Table
CREATE TABLE Billing (
    bill_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    user_id INT,
    itemized_charges JSON,
    total_amount DECIMAL(10, 2),
    payment_status ENUM('Paid', 'Pending'),
    payment_date TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. RoomServiceRequests Table
CREATE TABLE RoomServiceRequests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT,
    user_id INT,
    service_details TEXT,
    status ENUM('Pending', 'Completed'),
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP
);

-- 9. StaffRoles Table
CREATE TABLE StaffRoles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255),
    permissions JSON
);

-- 10. Staff Table
CREATE TABLE Staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    role_id INT,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(15),
    address TEXT,
    work_schedule JSON,
    hired_date DATE,
    performance_score DECIMAL(3, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 11. PerformanceReviews Table
CREATE TABLE PerformanceReviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT,
    review_date DATE,
    review_score DECIMAL(3, 2),
    review_comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 12. Reports Table
CREATE TABLE Reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(255),
    generated_by INT,
    data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 13. CustomerFeedback Table
CREATE TABLE CustomerFeedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    comments TEXT,
    rating INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 14. payments Table
CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    amount DECIMAL(10, 2),
    payment_method_id INT,
    payment_date TIMESTAMP
);

-- 15. PaymentMethods Table
CREATE TABLE PaymentMethods (
    method_id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(255),
    description TEXT
);


-- Enum Values Table for Room Status, Reservation Status, Billing Status, Service Request Status , payment method
CREATE TABLE EnumValues (
    enum_id INT AUTO_INCREMENT PRIMARY KEY,
    enum_name VARCHAR(255),
    value VARCHAR(255)
);

-- Insert default Enum values into EnumValues table
INSERT INTO EnumValues (enum_name, value) VALUES 
('RoomStatus', 'Available'),
('RoomStatus', 'Occupied'),
('RoomStatus', 'Maintenance'),
('ReservationStatus', 'Confirmed'),
('ReservationStatus', 'Pending'),
('ReservationStatus', 'Canceled'),
('BillingStatus', 'Paid'),
('BillingStatus', 'Pending'),
('ServiceRequestStatus', 'Pending'),
('ServiceRequestStatus', 'Completed'),
('PaymentMethod', 'Credit Card'),
('PaymentMethod', 'PayPal'),
('PaymentMethod', 'Bitcoin');





-- Insert Dummy Data into Tables

-- Insert Roles
INSERT INTO Roles (role_name, permissions) VALUES 
('Admin', '{"create": true, "read": true, "update": true, "delete": true}'),
('Manager', '{"create": true, "read": true, "update": true, "delete": false}'),
('Guest', '{"create": true, "read": true, "update": false, "delete": false}'),
('Staff', '{"create": true, "read": true, "update": true, "delete": false}');

-- Insert Users
INSERT INTO Users (username, password_hash, role_id, email, phone) VALUES 
('admin_user', 'hashedpassword123', 1, 'admin@example.com', '555-0001'),
('manager_user', 'hashedpassword456', 2, 'manager@example.com', '555-0002'),
('guest_user', 'hashedpassword789', 3, 'guest@example.com', '555-0003'),
('staff_user', 'hashedpassword321', 4, 'staff@example.com', '555-0004');

-- Insert RoomTypes
INSERT INTO RoomTypes (type_name, description, max_occupancy) VALUES 
('Single', 'A single occupancy room with a bed, desk, and basic amenities', 1),
('Double', 'A double occupancy room with two beds and essential amenities', 2),
('Suite', 'A luxury suite with a bedroom, living area, and enhanced amenities', 4),
('Penthouse', 'A top-floor suite with panoramic views and premium amenities', 4);

-- Insert Rooms
INSERT INTO Rooms (room_number, room_type_id, status, description, price_per_night) VALUES 
('101', 1, 'Available', 'A cozy single room with a comfortable bed and a desk.', 100.00),
('102', 2, 'Occupied', 'A double room with two beds and a large window.', 150.00),
('103', 3, 'Maintenance', 'A spacious suite with a king-size bed and living area.', 300.00),
('104', 4, 'Available', 'A penthouse with luxury amenities and panoramic views.', 500.00);

-- Insert Reservations
INSERT INTO Reservations (user_id, room_id, check_in_date, check_out_date, special_requests, status) VALUES 
(1, 1, '2024-12-01', '2024-12-05', 'Late check-in', 'Confirmed'),
(2, 2, '2024-12-02', '2024-12-06', 'Extra pillows', 'Pending'),
(3, 3, '2024-12-03', '2024-12-07', 'Non-smoking room', 'Confirmed'),
(4, 4, '2024-12-04', '2024-12-08', 'High floor', 'Canceled');

-- Insert CheckInCheckOut
INSERT INTO CheckInCheckOut (reservation_id, check_in_time, check_out_time, status, comments) VALUES 
(1, '2024-12-01 14:00:00', '2024-12-05 10:00:00', 'Checked-In', 'Smooth check-in process'),
(2, '2024-12-02 15:00:00', '2024-12-06 12:00:00', 'Checked-Out', 'Guest requested a late check-out'),
(3, '2024-12-03 13:00:00', '2024-12-07 11:00:00', 'Checked-In', 'No issues during stay'),
(4, NULL, NULL, 'Checked-Out', 'Reservation canceled');

-- Insert Billing
INSERT INTO Billing (reservation_id, user_id, itemized_charges, total_amount, payment_status, payment_date) VALUES 
(1, 1, '{"room_charge": 500.00, "tax": 50.00}', 550.00, 'Paid', '2024-12-01'),
(2, 2, '{"room_charge": 600.00, "tax": 60.00}', 660.00, 'Pending', NULL),
(3, 3, '{"room_charge": 1200.00, "tax": 120.00}', 1320.00, 'Paid', '2024-12-03'),
(4, 4, '{"room_charge": 2000.00, "tax": 200.00}', 2200.00, 'Pending', NULL);

-- Insert RoomServiceRequests
INSERT INTO RoomServiceRequests (room_id, user_id, service_details, status) VALUES 
(1, 1, 'Extra towels and water', 'Completed'),
(2, 2, 'Room cleaning', 'Pending'),
(3, 3, 'Request for a bottle of wine', 'Completed'),
(4, 4, 'Additional blanket', 'Pending');

-- Insert StaffRoles
INSERT INTO StaffRoles (role_name, permissions) VALUES 
('Housekeeping', '{"create": false, "read": true, "update": true, "delete": false}'),
('Receptionist', '{"create": true, "read": true, "update": true, "delete": false}'),
('Manager', '{"create": true, "read": true, "update": true, "delete": true}'),
('Security', '{"create": false, "read": true, "update": false, "delete": true}');

-- Insert Staff
INSERT INTO Staff (first_name, last_name, role_id, email, phone, address, work_schedule, hired_date, performance_score) VALUES 
('John', 'Doe', 1, 'john.doe@hotel.com', '555-0101', '123 Elm St', '{"monday": "9-5", "tuesday": "9-5"}', '2023-01-01', 4.5),
('Jane', 'Smith', 2, 'jane.smith@hotel.com', '555-0102', '456 Oak St', '{"monday": "9-5", "wednesday": "9-5"}', '2023-02-01', 4.7),
('Bob', 'Johnson', 3, 'bob.johnson@hotel.com', '555-0103', '789 Pine St', '{"monday": "9-5", "friday": "9-5"}', '2023-03-01', 4.8),
('Alice', 'Williams', 4, 'alice.williams@hotel.com', '555-0104', '321 Maple St', '{"monday": "9-5", "thursday": "9-5"}', '2023-04-01', 4.3);

-- Insert PerformanceReviews
INSERT INTO PerformanceReviews (staff_id, review_date, review_score, review_comments) VALUES 
(1, '2024-11-01', 4.5, 'Excellent service, very reliable'),
(2, '2024-11-02', 4.7, 'Great customer interaction skills'),
(3, '2024-11-03', 4.8, 'Highly productive and helpful'),
(4, '2024-11-04', 4.3, 'Good, but could improve time management');

-- Insert Reports
INSERT INTO Reports (report_type, generated_by, data) VALUES 
('Daily Sales', 1, '{"total_sales": 10000.00, "rooms_sold": 20}'),
('Customer Feedback', 2, '{"positive_feedback": 30, "negative_feedback": 5}'),
('Staff Performance', 3, '{"staff_ratings": [4.5, 4.7, 4.8]}'),
('Reservation Summary', 4, '{"total_reservations": 50, "canceled": 5}');

-- Insert CustomerFeedback
INSERT INTO CustomerFeedback (user_id, comments, rating) VALUES 
(1, 'Great experience, will stay again', 5),
(2, 'Room was fine, but noisy at night', 3),
(3, 'Loved the suite, will recommend to others', 4),
(4, 'Canceled stay due to personal reasons', 2);

-- Insert PaymentMethods
INSERT INTO PaymentMethods (method_name, description) VALUES 
('Credit Card', 'Accepts credit card payments'),
('Debit Card', 'Accepts debit card payments'),
('Cash', 'Accepts cash payments'),
('PayPal', 'Accepts PayPal payments'),
('Bitcoin', 'Accepts Bitcoin payments');

-- Insert Payments
INSERT INTO Payments (reservation_id, payment_method_id, amount, payment_date) VALUES 
(1, 1, 500.00, '2024-12-01'),
(2, 2, 1000.00, '2024-12-02'),
(3, 3, 1500.00, '2024-12-03'),
(4, 4, 2000.00, '2024-12-04'),
(5, 5, 2500.00, '2024-12-05');

-- Views For Admin DASHBOARD
CREATE VIEW AdminDashboard AS
SELECT 
    -- Rooms Summary
    (SELECT COUNT(*) FROM Rooms) AS total_rooms,
    (SELECT COUNT(*) FROM Rooms WHERE status = 'Available') AS available_rooms,
    (SELECT COUNT(*) FROM Rooms WHERE status = 'Occupied') AS occupied_rooms,
    (SELECT COUNT(*) FROM Rooms WHERE status = 'Maintenance') AS maintenance_rooms,

    -- Reservations Summary
    (SELECT COUNT(*) FROM Reservations) AS total_reservations,
    (SELECT COUNT(*) FROM Reservations WHERE status = 'Confirmed') AS confirmed_reservations,
    (SELECT COUNT(*) FROM Reservations WHERE status = 'Pending') AS pending_reservations,
    (SELECT COUNT(*) FROM Reservations WHERE status = 'Canceled') AS canceled_reservations,

    -- Billing and Revenue Summary
    (SELECT SUM(total_amount) FROM Billing) AS total_revenue,
    (SELECT SUM(total_amount) FROM Billing WHERE DATE(payment_date) = CURDATE()) AS today_revenue,
    (SELECT COUNT(*) FROM Billing WHERE payment_status = 'Pending') AS pending_payments,

    -- Staff Summary
    (SELECT COUNT(*) FROM Staff) AS total_staff,
    (SELECT AVG(performance_score) FROM Staff) AS avg_staff_performance,

    -- Customer Feedback Summary
    (SELECT COUNT(*) FROM CustomerFeedback) AS total_feedback,
    (SELECT COUNT(*) FROM CustomerFeedback WHERE rating < 3) AS negative_feedback,
    (SELECT AVG(rating) FROM CustomerFeedback) AS avg_customer_rating;

    -- Reports Summary
    (SELECT COUNT(*) FROM Reports) AS total_reports,
    (SELECT COUNT(*) FROM Reports WHERE report_type = 'Daily Sales') AS daily_sales_reports,
    (SELECT COUNT(*) FROM Reports WHERE report_type = 'Customer Feedback') AS customer_feedback_reports,
    (SELECT COUNT(*) FROM Reports WHERE report_type = 'Staff Performance') AS staff_performance_reports,
    (SELECT COUNT(*) FROM Reports WHERE report_type = 'Reservation Summary') AS reservation_summary_reports;




--Here’s a query to generate a high-level admin dashboard overview:

-- Total Rooms, Available vs. Occupied Rooms
-- SELECT 
--     COUNT(*) AS total_rooms,
--     SUM(CASE WHEN status = 'Available' THEN 1 ELSE 0 END) AS available_rooms,
--     SUM(CASE WHEN status = 'Occupied' THEN 1 ELSE 0 END) AS occupied_rooms
-- FROM Rooms;

-- -- Total Reservations by Status
-- SELECT 
--     COUNT(*) AS total_reservations,
--     SUM(CASE WHEN status = 'Confirmed' THEN 1 ELSE 0 END) AS confirmed_reservations,
--     SUM(CASE WHEN status = 'Pending' THEN 1 ELSE 0 END) AS pending_reservations,
--     SUM(CASE WHEN status = 'Canceled' THEN 1 ELSE 0 END) AS canceled_reservations
-- FROM Reservations;

-- -- Total Revenue
-- SELECT 
--     SUM(total_amount) AS total_revenue,
--     SUM(CASE WHEN payment_date >= CURRENT_DATE THEN total_amount ELSE 0 END) AS today_revenue
-- FROM Billing;

-- -- Average Customer Rating
-- SELECT 
--     AVG(rating) AS average_rating
-- FROM CustomerFeedback;

-- -- Total Staff
-- SELECT 
--     COUNT(*) AS total_staff,
--     AVG(performance_score) AS average_performance_score
-- FROM Staff;

