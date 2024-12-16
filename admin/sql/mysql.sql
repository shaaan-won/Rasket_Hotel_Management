-- 1. Users Table
CREATE TABLE if not exists `ht_users` (
  `id`  int(10) auto_increment primary key NOT NULL ,
  `name` varchar(50) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` varchar(50) DEFAULT NULL,
  `verify_code` varchar(50) DEFAULT NULL,
  `inactive` tinyint(1) UNSIGNED DEFAULT 0,
  `mobile` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ht_users`
--

INSERT INTO `ht_users` (`id`, `name`, `role_id`, `password`, `email`, `full_name`, `created_at`, `photo`, `verify_code`, `inactive`, `mobile`, `updated_at`, `ip`, `email_verified_at`, `remember_token`) VALUES
(127, 'admin', 1, '$2y$10$zeyUFTm0vqQ0uAUS04kl4ubY6.2Y0zQXqcFC70XvD.8Ot5s3Om5PG', 'towhid1@outlook.com', 'Mohammad Towhidul Islam', '2024-04-29 05:28:06', '127.jpg', '45354353', 0, '34324324', '2022-02-15 21:00:46', '192.168.150.29', NULL, NULL),
(192, 'naeem', 2, '$2y$10$BTQzbrLdYG9/hSfLBf7mzOLzDG1kp6E90OaMh9jEWBafyGkG6oAt6', 'naymur@gmail.com', 'Naymur Rahman', '2024-04-04 05:43:27', NULL, NULL, 0, '01800000000', NULL, '192.168.150.25', NULL, NULL),
(194, 'jakaria', 2, '$2y$10$Zyt3rgYgF9vnDBhNRN/8lO1BirJFCCNr3rhTRiI.7W1aVIuriBJiS', 'jkp.jakaria@gmail.com', 'jkp', '2024-04-15 04:53:54', NULL, NULL, 0, '01642527454', NULL, '192.168.150.47', NULL, NULL),
(196, 'Aminur', 2, '$2y$10$u1Wku9Uh61adCVAPm6ToSOp.8EgdXkiXo/DGp3oD.i/8o9I6a/Dai', 'amiur@gmail.com', 'Aminur Rahman', '2024-04-04 05:45:19', NULL, NULL, 0, '01800000000', NULL, '192.168.150.25', NULL, NULL),
(197, 'Tanim', 2, '$2y$10$NcNFqz1p2N76l4NH96f4Y.KTU8s/e.CqZB.lD7lewc4rcBvMstgaK', 'tanim@gmail.com', 'Rifat Ahammed Tanim', '2024-04-04 05:54:06', NULL, NULL, 0, '01900000000', NULL, '192.168.150.34', NULL, NULL),
(199, 'midul', 2, '$2y$10$sUhLutkkEUOUTWY2yWi.C.B55DFNOhUrbfFnrzcKM2FK7xdDF6Rby', 'midul@yahoo.com', 'Midul Islam', '2024-04-04 05:50:50', NULL, NULL, 0, '0198748343', NULL, '192.168.150.5', NULL, NULL),
(200, 'Jabed ', 2, '$2y$10$mgdw/E0HYncsz1wZaxygKerTF9VAfiPMnq4TSLsscA5CVHSih/RbS', 'olba@gmail.com', 'Javed ', '2024-04-04 05:59:27', NULL, NULL, 0, '01869546555', NULL, '192.168.150.22', NULL, NULL),
(201, 'omar', 2, '$2y$10$GnOgIBKPRsNIeM3OJExotuuBjGqzgcYGnfQeZpz4pug/GNqiLCWwS', 'omar@gmail.com', 'Omar Faruk', '2024-04-15 04:57:44', NULL, NULL, 0, '343434', NULL, '192.168.150.11', NULL, NULL),
(204, 'Anni', 2, '$2y$10$JWg5tGwzGUwnFT/PZBT4wuqIKAw3Vb6X7kWs9zC3ueLSi1RMzi87W', 'jannatulneasa464@gmail.com', 'Jannatul Neasa', '2024-04-04 05:54:32', NULL, NULL, 0, '3254436756', NULL, '192.168.150.29', NULL, NULL),
(206, 'mir3', 4, '$2y$10$wYZrszbJ9LIadOof3PRIzuHQNnjAQuTanA.JBmsreow3nJm04hCRW', 'mir@gmail.com', 'Mizanur Rahman ', '2024-05-15 07:36:41', 'mir3.png', NULL, 0, '', '0000-00-00 00:00:00', '::1', '0000-00-00 00:00:00', ''),
(209, 'abc', 1, '$2y$10$M52jied3IiUeo/ke8QU5SO0tS5IrW3T7aXVEL3a7l7/HN/4l98XKO', 'abc@gmail.com', NULL, '2024-05-15 06:29:14', 'abc-gmail-com.jpg', NULL, 0, NULL, '2024-05-15 12:08:29', '::1', '0000-00-00 00:00:00', ''),
(213, 'sium', 2, '$2y$10$Ziq..GqX0z4Lf2H4tE62VOsSDmyq8BUhESIhHu4BEfLKvrJLUszOS', 'sium@gmail.com', NULL, '2024-05-15 07:43:08', 'sium.jpeg', NULL, 0, NULL, '0000-00-00 00:00:00', '192.168.150.18', '0000-00-00 00:00:00', '');

CREATE TABLE `ht_roles` (
  `id` int(10) auto_increment primary key NOT NULL,
  `name` varchar(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ht_roles`
--

INSERT INTO `ht_roles` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Admin', '2024-03-02 04:59:14', '2024-03-02 04:59:14'),
(2, 'Manager', '2024-02-28 12:10:59', '2024-02-28 06:10:59'),
(4, 'Guest', '2024-03-07 10:24:21', '2024-03-07 04:24:21'),
(5, 'Manager', '2024-03-07 12:25:34', '2024-03-07 06:25:34'),
(6, 'Manager', '2024-03-07 12:25:53', '2024-03-07 06:25:53');

-- 3. RoomTypes Table
CREATE TABLE ht_room_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    max_occupancy INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. Rooms Table
CREATE TABLE ht_rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room_number VARCHAR(10) UNIQUE NOT NULL,
    room_type_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 5. Reservations Table
CREATE TABLE ht_reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    customer_id INT,
    booking_date timestamp default current_timestamp,
    room_id INT,
    check_in_date DATE,
    check_out_date DATE,
    special_requests TEXT,
    total_amount DECIMAL(10, 2),
    remaining_amount DECIMAL(10, 2),
    payment_status ENUM('Pending', 'Paid', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 6. CheckInCheckOut Table
CREATE TABLE ht_CheckInCheckOut (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    check_in_time TIMESTAMP,
    check_out_time TIMESTAMP,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Billing Table
CREATE TABLE ht_Billings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    user_id INT,
    itemized_charges JSON,
    total_amount DECIMAL(10, 2),
    payment_method VARCHAR(50),
    payment_date timestamp,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. Payments Table
CREATE TABLE ht_Payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    amount DECIMAL(10, 2),
    payment_method_id INT,
    payment_date timestamp,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 9. ServiceRequests Table
CREATE TABLE ht_Room_ServiceRequests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    request_type VARCHAR(50),
    request_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 10. Staff Table
CREATE TABLE ht_staff_details ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
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

-- 11. StaffRoles Table
CREATE TABLE ht_staff_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255),
    permissions JSON
);

-- 12. PerformanceReviews Table
CREATE TABLE ht_performance_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT,
    review_date DATE,
    review_score DECIMAL(3, 2),
    review_comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 13. Reports Table
CREATE TABLE ht_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(255),
    report_data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 14. Payments Methods Table
CREATE TABLE ht_payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT
);

-- 15. CustomerFeedback Table
CREATE TABLE ht_customer_feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    comments TEXT,
    rating INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 16. Customers Table
CREATE TABLE ht_customer_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(15),
    id_card_type_name int(10),
    id_card_number VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 17. id_card_types Table
CREATE TABLE ht_id_card_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_card_type_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 18. work_schedule Table
CREATE TABLE ht_work_schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT,
    day_of_week VARCHAR(10),
    start_time TIME,
    end_time TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- INSERT dummy data into tables

-- Inserting data into ht_room_types table
INSERT INTO ht_room_types (name, description, max_occupancy) 
VALUES 
('Single Room', 'A small room with a single bed, ideal for one person.', 1),
('Double Room', 'A spacious room with two beds, ideal for two people.', 2),
('Suite', 'A luxurious room with a separate living area, perfect for business or long stays.', 4),
('Penthouse', 'A high-end room with panoramic views and luxury amenities.', 2);

-- Inserting data into ht_rooms table
 --eikhane name field neii hobe
INSERT INTO ht_rooms (room_number, room_type_id)
VALUES 
('101', 1),
('102', 2),
('201', 3),
('301', 4);

-- Inserting data into ht_reservations table
INSERT INTO ht_reservations (user_id, customer_id, room_id, check_in_date, check_out_date, special_requests, total_amount, remaining_amount, payment_status) 
VALUES 
(1, 101, 1, '2024-11-26', '2024-11-30', 'No special requests', 200.00, 200.00, 'Pending'),
(2, 102, 2, '2024-12-01', '2024-12-05', 'Late check-in request', 450.00, 450.00, 'Pending'),
(3, 103, 3, '2024-12-10', '2024-12-12', 'Request for extra pillows', 600.00, 600.00, 'Pending'),
(4, 104, 4, '2024-12-15', '2024-12-18', 'Celebrate anniversary', 1200.00, 1200.00, 'Pending');

-- Inserting data into ht_CheckInCheckOut table
INSERT INTO ht_CheckInCheckOut (reservation_id, check_in_time, check_out_time, comments) 
VALUES 
(1, '2024-11-26 14:00:00', '2024-11-30 12:00:00', 'No issues at check-in.'),
(2, '2024-12-01 16:00:00', '2024-12-05 11:00:00', 'Guest requested late check-in and was accommodated.'),
(3, '2024-12-10 15:00:00', '2024-12-12 10:00:00', 'Extra pillows were provided as requested.'),
(4, '2024-12-15 14:30:00', '2024-12-18 12:00:00', 'Guests celebrated their anniversary; everything went smoothly.');

-- Inserting data into ht_Billings table
INSERT INTO ht_Billings (reservation_id, user_id, itemized_charges, total_amount, payment_method, payment_date) 
VALUES 
(1, 1, '{"room_charge": 150.00, "tax": 50.00}', 200.00, 'Credit Card', '2024-11-26'),
(2, 2, '{"room_charge": 400.00, "tax": 50.00}', 450.00, 'Debit Card', '2024-12-01'),
(3, 3, '{"room_charge": 550.00, "tax": 50.00}', 600.00, 'Credit Card', '2024-12-10'),
(4, 4, '{"room_charge": 1000.00, "tax": 200.00}', 1200.00, 'PayPal', '2024-12-15');

-- Inserting data into ht_Payments table
INSERT INTO ht_Payments (reservation_id, amount, payment_method_id, payment_date) 
VALUES 
(1, 200.00, 1, '2024-11-26'),
(2, 450.00, 2, '2024-12-01'),
(3, 600.00, 1, '2024-12-10'),
(4, 1200.00, 3, '2024-12-15');

-- Inserting data into ht_Room_ServiceRequests table
INSERT INTO ht_Room_ServiceRequests (user_id, room_id, request_type, request_description) 
VALUES 
(1, 1, 'Cleaning', 'Requested room cleaning service.'),
(2, 2, 'Food', 'Ordered breakfast to be delivered at 7 AM.'),
(3, 3, 'Laundry', 'Requested laundry pickup for two shirts.'),
(4, 4, 'Spa', 'Requested a massage to be scheduled for the afternoon.');

-- Inserting data into ht_staff_details table
INSERT INTO ht_staff_details (name, first_name, last_name, role_id, email, phone, address, work_schedule, hired_date, performance_score) 
VALUES 
('John Doe', 'John', 'Doe', 1, 'johndoe@hotel.com', '1234567890', '123 Main St', '{"Monday": "9:00-17:00", "Tuesday": "9:00-17:00"}', '2022-01-15', 4.5),
('Jane Smith', 'Jane', 'Smith', 2, 'janesmith@hotel.com', '0987654321', '456 Oak St', '{"Wednesday": "9:00-17:00", "Thursday": "9:00-17:00"}', '2021-07-30', 4.2),
('Alice Johnson', 'Alice', 'Johnson', 3, 'alicejohnson@hotel.com', '1122334455', '789 Pine St', '{"Friday": "9:00-17:00", "Saturday": "9:00-17:00"}', '2023-04-01', 4.8),
('Bob Brown', 'Bob', 'Brown', 1, 'bobbrown@hotel.com', '6677889900', '101 Maple St', '{"Monday": "9:00-17:00", "Friday": "9:00-17:00"}', '2020-09-12', 4.0);

-- Inserting data into ht_staff_roles table
INSERT INTO ht_staff_roles (role_name, permissions) 
VALUES 
('Manager', '{"view_reports": true, "edit_staff": true, "manage_reservations": true}'),
('Housekeeper', '{"clean_rooms": true, "request_assistance": true}'),
('Receptionist', '{"check_in_check_out": true, "assist_guests": true}'),
('Chef', '{"prepare_food": true, "manage_kitchen_inventory": true}');

-- Inserting data into ht_performance_reviews table
INSERT INTO ht_performance_reviews (staff_id, review_date, review_score, review_comments) 
VALUES 
(1, '2024-06-15', 4.5, 'Excellent management skills and customer interaction.'),
(2, '2024-07-15', 4.2, 'Consistently delivers quality work, but needs improvement in time management.'),
(3, '2024-08-15', 4.8, 'Outstanding performance, always going above and beyond for guests.'),
(4, '2024-09-15', 4.0, 'Good performance, but occasional lapses in communication.');

-- Inserting data into ht_reports table
INSERT INTO ht_reports (report_type, report_data) 
VALUES 
('Monthly Revenue', '{"total_revenue": 20000.00, "room_sales": 15000.00, "service_sales": 5000.00}'),
('Staff Performance', '{"average_performance_score": 4.5, "highest_performance_score": 4.8, "lowest_performance_score": 4.0}'),
('Customer Feedback', '{"average_rating": 4.3, "positive_comments": 75, "negative_comments": 25}'),
('Occupancy Report', '{"total_rooms": 100, "rooms_occupied": 80, "vacant_rooms": 20}');

-- Inserting data into ht_payment_methods table
INSERT INTO ht_payment_methods (name, description) 
VALUES 
('Credit Card', 'Payment made using a credit card.'),
('Debit Card', 'Payment made using a debit card.'),
('PayPal', 'Payment made through PayPal.'),
('Cash', 'Payment made using cash.');

-- Inserting data into ht_customer_feedback table
INSERT INTO ht_customer_feedback (user_id, comments, rating) 
VALUES 
(1, 'Great stay, room was clean and comfortable!', 5),
(2, 'Good service, but the check-in process took too long.', 3),
(3, 'The suite was amazing, would definitely book again!', 5),
(4, 'Had a wonderful time, staff was friendly and accommodating.', 4);

-- Inserting data into ht_customer_details table
INSERT INTO ht_customer_details (name, first_name, last_name, email, phone, id_card_type_name, id_card_number, address) 
VALUES 
('Shawon','Michael', 'Green', 'michael.green@example.com', '1231231234', 1, 'A12345678', '321 Elm St'),
('Shawon','Sarah', 'White', 'sarah.white@example.com', '5675675678', 2, 'B23456789', '654 Oak St'),
('Shawon','David', 'Brown', 'david.brown@example.com', '2342342345', 3, 'C34567890', '987 Pine St'),
('Shawon','Emily', 'Taylor', 'emily.taylor@example.com', '8768768765', 3, 'D45678901', '123 Birch St');

-- Inserting data into ht_id_card_types table
INSERT INTO ht_id_card_types (id_card_type_name) 
VALUES 
('Passport'),
('Driver License'),
('National ID'),
('Student ID');

-- Inserting data into ht_work_schedule table
INSERT INTO ht_work_schedule (staff_id, day_of_week, start_time, end_time) 
VALUES 
(1, 'Monday', '09:00:00', '17:00:00'),
(2, 'Wednesday', '09:00:00', '17:00:00'),
(3, 'Friday', '09:00:00', '17:00:00'),
(4, 'Monday', '09:00:00', '17:00:00');


-- Create Divisions Table
CREATE TABLE ht_divisions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    Population BIGINT,
    AreaKm2 DECIMAL(10,2),
    CapitalCity VARCHAR(100)
);

-- Create Districts Table
CREATE TABLE  ht_districts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    Population BIGINT,
    AreaKm2 DECIMAL(10,2),
    DivisionID INT
);

-- Insert Data into Divisions Table
INSERT INTO ht_divisions (name, Population, AreaKm2, CapitalCity) VALUES
('Dhaka', 36433820, 20594.07, 'Dhaka'),
('Chattogram', 29918476, 33771.18, 'Chattogram'),
('Khulna', 15687770, 22284.22, 'Khulna'),
('Rajshahi', 18587776, 18174.30, 'Rajshahi'),
('Barishal', 9234000, 13297.40, 'Barishal'),
('Sylhet', 12016000, 12596.58, 'Sylhet'),
('Rangpur', 17673452, 16027.31, 'Rangpur'),
('Mymensingh', 11309000, 10585.00, 'Mymensingh');

-- Insert Data into Districts Table
INSERT INTO ht_districts (name, Population, AreaKm2, DivisionID) VALUES
-- Dhaka Division (DivisionID = 1)
('Dhaka', 8906039, 1463.60, 1),
('Gazipur', 4266756, 1741.53, 1),
('Kishoreganj', 3024417, 2731.92, 1),
('Manikganj', 1412057, 1378.99, 1),
('Munshiganj', 1618292, 954.96, 1),
('Narayanganj', 2949500, 684.37, 1),
('Narsingdi', 2302990, 1140.76, 1),
('Tangail', 3913273, 3414.25, 1),
('Faridpur', 2040419, 2072.72, 1),
('Madaripur', 1215026, 1144.96, 1),
('Rajbari', 1044165, 1118.26, 1),
('Shariatpur', 1198648, 1174.05, 1),
('Gopalganj', 1171294, 1490.15, 1),

-- Chattogram Division (DivisionID = 2)
('Chattogram', 7657400, 5282.92, 2),
("Cox\'s Bazar" , 2749000, 2491.86, 2),
('Bandarban', 410504, 4479.03, 2),
('Rangamati', 595979, 6116.13, 2),
('Khagrachari', 704500, 2699.56, 2),
('Feni', 1480548, 928.34, 2),
('Noakhali', 3108516, 3685.87, 2),
('Laxmipur', 1751539, 1455.96, 2),
('Cumilla', 5392090, 3146.30, 2),
('Brahmanbaria', 2938676, 1927.11, 2),
('Chandpur', 2496570, 1704.06, 2),

-- Khulna Division (DivisionID = 3)
('Khulna', 2358000, 4394.46, 3),
('Bagerhat', 1474745, 3959.11, 3),
('Satkhira', 2102304, 3858.33, 3),
('Jessore', 2766500, 2606.94, 3),
('Narail', 729177, 990.23, 3),
('Magura', 918419, 1048.12, 3),
('Jhenaidah', 1794673, 1949.62, 3),
('Chuadanga', 1128670, 1170.88, 3),
('Kushtia', 2110283, 1608.80, 3),
('Meherpur', 655392, 716.08, 3),

-- Rajshahi Division (DivisionID = 4)
('Rajshahi', 2630000, 2407.01, 4),
('Pabna', 2660000, 2373.73, 4),
('Natore', 1867885, 1896.05, 4),
('Naogaon', 2606772, 3435.67, 4),
('Joypurhat', 913768, 965.44, 4),
('Bogra', 3416606, 2898.68, 4),
('Chapainawabganj', 1648725, 1702.55, 4),
('Sirajganj', 3162175, 2497.92, 4),

-- Barishal Division (DivisionID = 5)
('Barishal', 2453900, 2787.82, 5),
('Bhola', 1858000, 3403.48, 5),
('Jhalokati', 694231, 758.06, 5),
('Patuakhali', 1660117, 3220.15, 5),
('Pirojpur', 1153714, 1277.80, 5),
('Barguna', 892781, 1831.31, 5),

-- Sylhet Division (DivisionID = 6)
('Sylhet', 3873000, 3490.40, 6),
('Sunamganj', 2418000, 3669.58, 6),
('Moulvibazar', 2105343, 2799.39, 6),
('Habiganj', 2301749, 2637.57, 6),

-- Rangpur Division (DivisionID = 7)
('Rangpur', 3095100, 2308.32, 7),
('Dinajpur', 3062000, 3437.98, 7),
('Gaibandha', 2438100, 2179.27, 7),
('Kurigram', 2292700, 2244.23, 7),
('Lalmonirhat', 1261030, 1241.46, 7),
('Nilphamari', 1917365, 1643.44, 7),
('Panchagarh', 1082111, 1404.63, 7),
('Thakurgaon', 1657389, 1810.99, 7),

-- Mymensingh Division (DivisionID = 8)
('Mymensingh', 5583000, 4363.48, 8),
('Netrokona', 2309000, 2810.40, 8),
('Sherpur', 1467507, 1356.27, 8),
('Jamalpur', 2291000, 2031.98, 8);

--invoices table

CREATE TABLE ht_invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    customer_detail_id INT, -- Links to the guest table
    customer_detail_name VARCHAR(255),
    reservation_id INT NOT NULL, -- Links to the reservations table
    total_amount DECIMAL(10,2) NOT NULL,
    tax_amount DECIMAL(10,2),
    payment_status ENUM('Paid', 'Pending', 'Overdue') DEFAULT 'Pending',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data into the invoices table
INSERT INTO ht_invoices (name, customer_detail_id, customer_detail_name, reservation_id, total_amount, tax_amount, payment_status)
VALUES
('Invoice 1', 1, 'John Doe', 1, 100.00, 10.00, 'Paid'),
('Invoice 2', 2, 'Jane Smith', 2, 200.00, 20.00, 'Pending'),
('Invoice 3', 3, 'Bob Johnson', 3, 150.00, 15.00, 'Overdue');


--bookings table for invoice extract

-- Create the bookings table
Drop table if exists ht_bookings;
CREATE TABLE ht_bookings (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, -- Unique booking ID
    `created_at` DATETIME NOT NULL,                            -- Booking creation timestamp
    `order_total` FLOAT NOT NULL,                              -- Total order amount
    `paid_total` FLOAT NOT NULL,                               -- Total amount paid
    `remark` TEXT DEFAULT NULL,                                -- Additional remarks
    `customer_detail_id` INT(10) UNSIGNED NOT NULL                   -- Associated customer ID
);

-- Create the booking details table for invoices
Drop table if exists ht_booking_details;
CREATE TABLE ht_booking_details (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , -- Unique booking detail ID
    `booking_id` INT(10) UNSIGNED NOT NULL,                    -- Reference to the booking ID
    `room_id` INT(10) UNSIGNED NOT NULL,                       -- Reference to the room ID
    `from_date` DATE NOT NULL,                                 -- Booking start date
    `to_date` DATE NOT NULL,                                   -- Booking end date
    `price` FLOAT NOT NULL                                     -- Price for the stay
);
-- Insert sample data into ht_bookings
INSERT INTO ht_bookings (`id`, `created_at`, `order_total`, `paid_total`, `remark`, `customer_detail_id`) VALUES
(1, '2024-05-22 00:00:00', 1000, 1000, 'Test', 7),
(2, '2024-05-24 00:00:00', 700, 700, 'Test Update Api', 3),
(3, '2024-05-25 00:00:00', 3544, 3544, 'Test', 2),
(4, '2024-05-23 00:00:00', 500, 500, 'Test Api', 3),
(5, '0000-00-00 00:00:00', 446, 446, 'Test', 2),
(6, '0000-00-00 00:00:00', 344, 455, 'test', 1),
(7, '0000-00-00 00:00:00', 5000, 2000, 'NT', 1);



-- Insert sample data into ht_booking_details
INSERT INTO ht_booking_details (`id`, `booking_id`, `room_id`, `from_date`, `to_date`, `price`) VALUES
(1, 1, 1, '2024-05-22', '2024-05-24', 1000),
(2, 2, 2, '2024-05-24', '2024-05-25', 700),
(3, 3, 3, '2024-05-25', '2024-05-26', 3544),
(4, 4, 4, '2024-05-23', '2024-05-24', 500),
(5, 5, 5, '2024-05-24', '2024-05-25', 446),
(6, 6, 6, '2024-05-25', '2024-05-26', 344),
(7, 7, 7, '2024-05-26', '2024-05-27', 5000);


--View table for invoice extract

Create view ht_invoices_view as
select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,
(select name from ht_reservations where id=ht_invoices.reservation_id) as reservation_name,
(select name from ht_rooms where id=(select room_id from ht_reservations where id=ht_invoices.reservation_id)) as room_name,
(select room_number from ht_rooms where id=(select room_id from ht_reservations where id=ht_invoices.reservation_id)) as room_number,
(select name from ht_room_types where id=(select room_type_id from ht_rooms where id=(select room_id from ht_reservations where id=ht_invoices.reservation_id))) as room_type_name,
(select check_in_date from ht_reservations where id=ht_invoices.reservation_id) as check_in,
(select check_out_date from ht_reservations where id=ht_invoices.reservation_id) as check_out,
(select total_amount from ht_reservations where id=ht_invoices.reservation_id) as reservation_total_amount
from ht_invoices ;


