-- View 1: User Information Summary
CREATE VIEW UserSummary AS
SELECT 
    u.user_id,
    u.username,
    u.email,
    u.phone,
    r.role_name,
    u.created_at
FROM 
    Users u
JOIN 
    Roles r ON u.role_id = r.role_id;

-- View 2: Room Status Summary
CREATE VIEW RoomStatusSummary AS
SELECT 
    r.room_id,
    r.room_number,
    rt.type_name AS room_type,
    r.status,
    r.price_per_night,
    r.description
FROM 
    Rooms r
JOIN 
    RoomTypes rt ON r.room_type_id = rt.room_type_id;

-- View 3: Reservation Details
CREATE VIEW ReservationDetails AS
SELECT 
    res.reservation_id,
    u.username AS guest_name,
    rm.room_number,
    rt.type_name AS room_type,
    res.check_in_date,
    res.check_out_date,
    res.status,
    res.special_requests,
    res.created_at
FROM 
    Reservations res
JOIN 
    Users u ON res.user_id = u.user_id
JOIN 
    Rooms rm ON res.room_id = rm.room_id
JOIN 
    RoomTypes rt ON rm.room_type_id = rt.room_type_id;

-- View 4: Billing Information Summary
CREATE VIEW BillingSummary AS
SELECT 
    b.bill_id,
    u.username AS guest_name,
    res.reservation_id,
    b.total_amount,
    b.payment_status,
    b.payment_date
FROM 
    Billing b
JOIN 
    Users u ON b.user_id = u.user_id
JOIN 
    Reservations res ON b.reservation_id = res.reservation_id;

-- View 5: Staff Overview
CREATE VIEW StaffOverview AS
SELECT 
    s.staff_id,
    CONCAT(s.first_name, ' ', s.last_name) AS full_name,
    sr.role_name,
    s.email,
    s.phone,
    s.hired_date,
    s.performance_score
FROM 
    Staff s
JOIN 
    StaffRoles sr ON s.role_id = sr.role_id;

-- View 6: Room Service Requests Overview
CREATE VIEW RoomServiceRequestSummary AS
SELECT 
    rs.request_id,
    rm.room_number,
    u.username AS guest_name,
    rs.service_details,
    rs.status,
    rs.requested_at,
    rs.completed_at
FROM 
    RoomServiceRequests rs
JOIN 
    Rooms rm ON rs.room_id = rm.room_id
JOIN 
    Users u ON rs.user_id = u.user_id;

-- View 7: Performance Reviews Summary
CREATE VIEW PerformanceReviewSummary AS
SELECT 
    pr.review_id,
    CONCAT(s.first_name, ' ', s.last_name) AS staff_name,
    sr.role_name,
    pr.review_date,
    pr.review_score,
    pr.review_comments
FROM 
    PerformanceReviews pr
JOIN 
    Staff s ON pr.staff_id = s.staff_id
JOIN 
    StaffRoles sr ON s.role_id = sr.role_id;

-- View 8: Customer Feedback Summary
CREATE VIEW CustomerFeedbackSummary AS
SELECT 
    cf.feedback_id,
    u.username AS guest_name,
    cf.comments,
    cf.rating,
    cf.created_at
FROM 
    CustomerFeedback cf
JOIN 
    Users u ON cf.user_id = u.user_id;

-- View 9: Report Details Summary
CREATE VIEW ReportSummary AS
SELECT 
    r.report_id,
    r.report_type,
    u.username AS generated_by,
    r.data,
    r.created_at
FROM 
    Reports r
JOIN 
    Users u ON r.generated_by = u.user_id;

-- View 10: Comprehensive Room Overview
CREATE VIEW ComprehensiveRoomOverview AS
SELECT 
    rm.room_id,
    rm.room_number,
    rt.type_name AS room_type,
    rm.status,
    rm.price_per_night,
    COUNT(res.reservation_id) AS number_of_reservations,
    COUNT(rs.request_id) AS number_of_service_requests
FROM 
    Rooms rm
JOIN 
    RoomTypes rt ON rm.room_type_id = rt.room_type_id
LEFT JOIN 
    Reservations res ON rm.room_id = res.room_id
LEFT JOIN 
    RoomServiceRequests rs ON rm.room_id = rs.room_id
GROUP BY 
    rm.room_id, rt.type_name, rm.status, rm.price_per_night;

-- View 11: Check-In and Check-Out Summary
CREATE VIEW CheckInCheckOutSummary AS
SELECT 
    cico.check_id,
    res.reservation_id,
    u.username AS guest_name,
    rm.room_number,
    cico.check_in_time,
    cico.check_out_time,
    cico.status,
    cico.comments
FROM 
    CheckInCheckOut cico
JOIN 
    Reservations res ON cico.reservation_id = res.reservation_id
JOIN 
    Users u ON res.user_id = u.user_id
JOIN 
    Rooms rm ON res.room_id = rm.room_id;

-- View 12: Enum Values Summary
CREATE VIEW EnumValuesSummary AS
SELECT 
    enum_id,
    enum_name,
    value
FROM 
    EnumValues;

-- View 13: activereservations
CREATE VIEW ActiveReservations AS
SELECT 
    res.reservation_id,
    u.username AS guest_name,
    rm.room_number,
    rt.type_name AS room_type,
    res.check_in_date,
    res.check_out_date,
    res.status
FROM 
    Reservations res
JOIN 
    Users u ON res.user_id = u.user_id
JOIN 
    Rooms rm ON res.room_id = rm.room_id
JOIN 
    RoomTypes rt ON rm.room_type_id = rt.room_type_id
WHERE 
    res.status IN ('Confirmed', 'Pending');

-- View 14: Pendingservicerequests
CREATE VIEW PendingServiceRequests AS
SELECT 
    rs.request_id,
    rm.room_number,
    u.username AS guest_name,
    rs.service_details,
    rs.status,
    rs.requested_at
FROM 
    RoomServiceRequests rs
JOIN 
    Rooms rm ON rs.room_id = rm.room_id
JOIN 
    Users u ON rs.user_id = u.user_id
WHERE 
    rs.status = 'Pending';

-- View 15: Staffworkschedule
CREATE VIEW StaffWorkSchedule AS
SELECT 
    s.staff_id,
    CONCAT(s.first_name, ' ', s.last_name) AS full_name,
    sr.role_name,
    s.email,
    s.phone,
    s.hired_date,
    s.performance_score
FROM 
    Staff s
JOIN 
    StaffRoles sr ON s.role_id = sr.role_id;

-- View 16: ReservationHistory
CREATE VIEW ReservationHistory AS
SELECT 
    res.reservation_id,
    u.username AS guest_name,
    rm.room_number,
    rt.type_name AS room_type,
    res.check_in_date,
    res.check_out_date,
    res.status
FROM 
    Reservations res
JOIN 
    Users u ON res.user_id = u.user_id
JOIN 
    Rooms rm ON res.room_id = rm.room_id
JOIN 
    RoomTypes rt ON rm.room_type_id = rt.room_type_id
WHERE 
    res.status IN ('Checked In', 'Cancelled');

-- View 17: OccupiedRooms
CREATE VIEW OccupiedRooms AS
SELECT 
    rm.room_id,
    rm.room_number,
    rt.type_name AS room_type,
    COUNT(res.reservation_id) AS number_of_reservations
FROM 
    Rooms rm
JOIN 
    RoomTypes rt ON rm.room_type_id = rt.room_type_id
JOIN 
    Reservations res ON rm.room_id = res.room_id
JOIN 
    Users u ON res.user_id = u.user_id
    WHERE 
    res.status = 'Occupied'
GROUP BY 
    rm.room_id, rt.type_name;

-- View 18: StaffPerformanceScores

CREATE VIEW StaffPerformanceScores AS
SELECT 
    s.staff_id,
    CONCAT(s.first_name, ' ', s.last_name) AS staff_name,
    sr.role_name,
    s.performance_score
FROM 
    Staff s
JOIN 
    StaffRoles sr ON s.role_id = sr.role_id
ORDER BY 
    s.performance_score DESC;

-- View 19: HighRatedFeedback
CREATE VIEW HighRatedFeedback AS
SELECT 
    cf.feedback_id,
    u.username AS guest_name,
    cf.comments,
    cf.rating
FROM 
    CustomerFeedback cf
JOIN 
    Users u ON cf.user_id = u.user_id
WHERE 
    cf.rating >= 4;

-- View 20: DetailedBillingReport
CREATE VIEW DetailedBillingReport AS
SELECT 
    b.bill_id,
    u.username AS guest_name,
    res.reservation_id,
    rm.room_number,
    b.total_amount,
    b.payment_status,
    b.payment_date,
    res.check_in_date,
    res.check_out_date
FROM 
    Billing b
JOIN 
    Users u ON b.user_id = u.user_id
JOIN 
    Reservations res ON b.reservation_id = res.reservation_id
JOIN 
    Rooms rm ON res.room_id = rm.room_id;
