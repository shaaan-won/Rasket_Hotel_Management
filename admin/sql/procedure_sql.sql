DELIMITER $$

-- Add User
CREATE PROCEDURE AddUser(
    IN p_username VARCHAR(255),
    IN p_password_hash VARCHAR(255),
    IN p_role_id INT,
    IN p_email VARCHAR(255),
    IN p_phone VARCHAR(15)
)
BEGIN
    INSERT INTO Users (username, password_hash, role_id, email, phone)
    VALUES (p_username, p_password_hash, p_role_id, p_email, p_phone);
END $$

-- Get User by ID
CREATE PROCEDURE GetUserByID(
    IN p_user_id INT
)
BEGIN
    SELECT * FROM Users WHERE user_id = p_user_id;
END $$

-- Update User Information
CREATE PROCEDURE UpdateUserInfo(
    IN p_user_id INT,
    IN p_username VARCHAR(255),
    IN p_password_hash VARCHAR(255),
    IN p_role_id INT,
    IN p_email VARCHAR(255),
    IN p_phone VARCHAR(15)
)
BEGIN
    UPDATE Users 
    SET username = p_username, 
        password_hash = p_password_hash, 
        role_id = p_role_id, 
        email = p_email, 
        phone = p_phone 
    WHERE user_id = p_user_id;
END $$

-- Delete User
CREATE PROCEDURE DeleteUser(
    IN p_user_id INT
)
BEGIN
    DELETE FROM Users WHERE user_id = p_user_id;
END $$

-- Add Room
CREATE PROCEDURE AddRoom(
    IN p_room_number VARCHAR(255),
    IN p_room_type_id INT,
    IN p_status ENUM('Available', 'Occupied', 'Maintenance'),
    IN p_description TEXT,
    IN p_price_per_night DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Rooms (room_number, room_type_id, status, description, price_per_night)
    VALUES (p_room_number, p_room_type_id, p_status, p_description, p_price_per_night);
END $$

-- Get Room Availability
CREATE PROCEDURE GetRoomAvailability(
    IN p_status ENUM('Available', 'Occupied', 'Maintenance')
)
BEGIN
    SELECT room_id, room_number, status 
    FROM Rooms 
    WHERE status = p_status;
END $$

-- Update Room Status
CREATE PROCEDURE UpdateRoomStatus(
    IN p_room_id INT,
    IN p_status ENUM('Available', 'Occupied', 'Maintenance')
)
BEGIN
    UPDATE Rooms 
    SET status = p_status
    WHERE room_id = p_room_id;
END $$

-- Delete Room
CREATE PROCEDURE DeleteRoom(
    IN p_room_id INT
)
BEGIN
    DELETE FROM Rooms WHERE room_id = p_room_id;
END $$

-- Create Reservation
CREATE PROCEDURE CreateReservation(
    IN p_user_id INT,
    IN p_room_id INT,
    IN p_check_in_date DATE,
    IN p_check_out_date DATE,
    IN p_special_requests TEXT,
    IN p_status ENUM('Confirmed', 'Pending', 'Canceled')
)
BEGIN
    INSERT INTO Reservations (user_id, room_id, check_in_date, check_out_date, special_requests, status)
    VALUES (p_user_id, p_room_id, p_check_in_date, p_check_out_date, p_special_requests, p_status);
END $$

-- Update Reservation Status
CREATE PROCEDURE UpdateReservationStatus(
    IN p_reservation_id INT,
    IN p_status ENUM('Confirmed', 'Pending', 'Canceled')
)
BEGIN
    UPDATE Reservations 
    SET status = p_status 
    WHERE reservation_id = p_reservation_id;
END $$

-- Delete Reservation
CREATE PROCEDURE DeleteReservation(
    IN p_reservation_id INT
)
BEGIN
    DELETE FROM Reservations WHERE reservation_id = p_reservation_id;
END $$

-- Add Billing Information
CREATE PROCEDURE AddBilling(
    IN p_reservation_id INT,
    IN p_user_id INT,
    IN p_itemized_charges JSON,
    IN p_total_amount DECIMAL(10, 2),
    IN p_payment_status ENUM('Paid', 'Pending'),
    IN p_payment_date TIMESTAMP
)
BEGIN
    INSERT INTO Billing (reservation_id, user_id, itemized_charges, total_amount, payment_status, payment_date)
    VALUES (p_reservation_id, p_user_id, p_itemized_charges, p_total_amount, p_payment_status, p_payment_date);
END $$

-- Get Billing Details by Reservation ID
CREATE PROCEDURE GetBillingByReservationID(
    IN p_reservation_id INT
)
BEGIN
    SELECT * FROM Billing WHERE reservation_id = p_reservation_id;
END $$

-- Update Billing Payment Status
CREATE PROCEDURE UpdateBillingPaymentStatus(
    IN p_bill_id INT,
    IN p_payment_status ENUM('Paid', 'Pending'),
    IN p_payment_date TIMESTAMP
)
BEGIN
    UPDATE Billing 
    SET payment_status = p_payment_status, 
        payment_date = p_payment_date 
    WHERE bill_id = p_bill_id;
END $$

-- Delete Billing Entry
CREATE PROCEDURE DeleteBillingEntry(
    IN p_bill_id INT
)
BEGIN
    DELETE FROM Billing WHERE bill_id = p_bill_id;
END $$

-- Generate Report
CREATE PROCEDURE GenerateReport(
    IN p_report_type VARCHAR(255),
    IN p_generated_by INT,
    IN p_data JSON
)
BEGIN
    INSERT INTO Reports (report_type, generated_by, data)
    VALUES (p_report_type, p_generated_by, p_data);
END $$

-- Insert Customer Feedback
CREATE PROCEDURE InsertCustomerFeedback(
    IN p_user_id INT,
    IN p_comments TEXT,
    IN p_rating INT
)
BEGIN
    INSERT INTO CustomerFeedback (user_id, comments, rating)
    VALUES (p_user_id, p_comments, p_rating);
END $$

DELIMITER ;
