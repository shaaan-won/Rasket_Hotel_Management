CREATE VIEW AdminDashboard AS
SELECT
    -- Rooms Summary
    (SELECT COUNT(*) FROM ht_rooms) AS total_rooms,
    (SELECT COUNT(*) FROM ht_rooms WHERE status = 'Available') AS available_rooms,
    (SELECT COUNT(*) FROM ht_rooms WHERE status = 'Occupied') AS occupied_rooms,
    (SELECT COUNT(*) FROM ht_rooms WHERE status = 'Maintenance') AS maintenance_rooms,

    -- Reservations Summary
    (SELECT COUNT(*) FROM ht_reservations) AS total_reservations,
    (SELECT COUNT(*) FROM ht_reservations WHERE status = 'Confirmed') AS confirmed_reservations,
    (SELECT COUNT(*) FROM ht_reservations WHERE status = 'Pending') AS pending_reservations,
    (SELECT COUNT(*) FROM ht_reservations WHERE status = 'Canceled') AS canceled_reservations,

    -- Billing and Revenue Summary
    (SELECT SUM(total_amount) FROM ht_billing) AS total_revenue,
    (SELECT SUM(total_amount) FROM ht_billing WHERE DATE(payment_date) = CURDATE()) AS today_revenue,
    (SELECT COUNT(*) FROM ht_billing WHERE payment_status = 'Pending') AS pending_payments,

    -- Staff Summary
    (SELECT COUNT(*) FROM ht_staff_details) AS total_staff,
    (SELECT AVG(performance_score) FROM ht_staff_details) AS avg_staff_performance,

    -- Customer Feedback Summary
    (SELECT COUNT(*) FROM ht_customer_feedback) AS total_feedback,
    (SELECT COUNT(*) FROM ht_customer_feedback WHERE rating < 3) AS negative_feedback,
    (SELECT AVG(rating) FROM ht_customer_feedback) AS avg_customer_rating,

    -- Reports Summary
    (SELECT COUNT(*) FROM ht_reports) AS total_reports,
    (SELECT COUNT(*) FROM ht_reports WHERE report_type = 'Daily Sales') AS daily_sales_reports,
    (SELECT COUNT(*) FROM ht_reports WHERE report_type = 'Customer Feedback') AS customer_feedback_reports,
    (SELECT COUNT(*) FROM ht_reports WHERE report_type = 'Staff Performance') AS staff_performance_reports,
    (SELECT COUNT(*) FROM ht_reports WHERE report_type = 'Reservation Summary') AS reservation_summary_reports,
    (SELECT COUNT(*) FROM ht_reports WHERE report_type = 'Billing and Revenue') AS billing_revenue_reports;