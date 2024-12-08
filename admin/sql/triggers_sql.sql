DELIMITER $$

-- Trigger 1: Prevent Room Creation if Price is Zero or Negative
CREATE TRIGGER before_insert_room
BEFORE INSERT ON Rooms
FOR EACH ROW
BEGIN
    IF NEW.price_per_night <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Room price must be greater than zero';
    END IF;
END $$

-- Trigger 2: Automatically Update Room Status to "Occupied" when a Reservation is Made
CREATE TRIGGER after_insert_reservation
AFTER INSERT ON Reservations
FOR EACH ROW
BEGIN
    UPDATE Rooms
    SET status = 'Occupied'
    WHERE room_id = NEW.room_id;
END $$

-- Trigger 3: Prevent Changing Room Status if Room is Reserved
CREATE TRIGGER before_update_room_status
BEFORE UPDATE ON Rooms
FOR EACH ROW
BEGIN
    IF OLD.status = 'Occupied' AND NEW.status != OLD.status THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Room status cannot be changed if it is already occupied';
    END IF;
END $$

-- Trigger 4: Update Room Status to "Available" when Reservation is Canceled
CREATE TRIGGER after_update_reservation
AFTER UPDATE ON Reservations
FOR EACH ROW
BEGIN
    IF NEW.status = 'Canceled' AND OLD.status != 'Canceled' THEN
        UPDATE Rooms
        SET status = 'Available'
        WHERE room_id = NEW.room_id;
    END IF;
END $$

-- Trigger 5: Ensure Check-Out Time is After Check-In Time
CREATE TRIGGER before_insert_checkin_checkout
BEFORE INSERT ON CheckInCheckOut
FOR EACH ROW
BEGIN
    IF NEW.check_out_time <= NEW.check_in_time THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Check-out time must be after check-in time';
    END IF;
END $$

-- Trigger 6: Prevent Negative Total Amount in Billing
CREATE TRIGGER before_insert_billing
BEFORE INSERT ON Billing
FOR EACH ROW
BEGIN
    IF NEW.total_amount < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Billing total amount cannot be negative';
    END IF;
END $$

-- Trigger 7: Ensure Rating is Between 1 and 5 in Customer Feedback
CREATE TRIGGER before_insert_customer_feedback
BEFORE INSERT ON CustomerFeedback
FOR EACH ROW
BEGIN
    IF NEW.rating < 1 OR NEW.rating > 5 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Rating must be between 1 and 5';
    END IF;
END $$

-- Trigger 8: Prevent Insertion of Existing Email in Staff Table
CREATE TRIGGER before_insert_staff_email
BEFORE INSERT ON Staff
FOR EACH ROW
BEGIN
    DECLARE email_count INT;
    SELECT COUNT(*) INTO email_count FROM Staff WHERE email = NEW.email;
    IF email_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Email must be unique for each staff member';
    END IF;
END $$

-- Trigger 9: Log New Staff Addition
CREATE TRIGGER after_insert_staff
AFTER INSERT ON Staff
FOR EACH ROW
BEGIN
    INSERT INTO Logs (log_message, created_at)
    VALUES (CONCAT('New staff added: ', NEW.first_name, ' ', NEW.last_name), NOW());
END $$

-- Trigger 10: Log Room Service Request
CREATE TRIGGER after_insert_room_service_request
AFTER INSERT ON RoomServiceRequests
FOR EACH ROW
BEGIN
    INSERT INTO Logs (log_message, created_at)
    VALUES (CONCAT('Room service request made for room ', NEW.room_id, ' by user ', NEW.user_id), NOW());
END $$

-- Trigger 11: Prevent Negative Billing Value During Updates
CREATE TRIGGER before_update_billing
BEFORE UPDATE ON Billing
FOR EACH ROW
BEGIN
    IF NEW.total_amount < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Billing total amount cannot be updated to a negative value';
    END IF;
END $$

-- Trigger 12: Update Staff Performance Score After Performance Review Insertion
CREATE TRIGGER after_insert_performance_review
AFTER INSERT ON PerformanceReviews
FOR EACH ROW
BEGIN
    UPDATE Staff
    SET performance_score = (SELECT AVG(review_score) FROM PerformanceReviews WHERE staff_id = NEW.staff_id)
    WHERE staff_id = NEW.staff_id;
END $$

-- Trigger 13: Check for Valid Report Type Before Inserting Reports
CREATE TRIGGER before_insert_report
BEFORE INSERT ON Reports
FOR EACH ROW
BEGIN
    IF NEW.report_type NOT IN ('Daily Sales', 'Customer Feedback', 'Staff Performance', 'Reservation Summary') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid report type';
    END IF;
END $$

DELIMITER ;
