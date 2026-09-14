<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"];

/* =========================
   OVERALL STATISTICS
========================= */

// Total doctors
$totalDoctors = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM doctors");
if ($result) {
    $totalDoctors = mysqli_fetch_assoc($result)["total"];
}

// Total appointments
$totalAppointments = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM appointments");
if ($result) {
    $totalAppointments = mysqli_fetch_assoc($result)["total"];
}

// Completed appointments
$completedAppointments = 0;
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM appointments
    WHERE status = 'completed'
");
if ($result) {
    $completedAppointments = mysqli_fetch_assoc($result)["total"];
}

// Cancelled appointments
$cancelledAppointments = 0;
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM appointments
    WHERE status = 'cancelled'
");
if ($result) {
    $cancelledAppointments = mysqli_fetch_assoc($result)["total"];
}

// Pending appointments
$pendingAppointments = 0;
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM appointments
    WHERE status = 'pending'
");
if ($result) {
    $pendingAppointments = mysqli_fetch_assoc($result)["total"];
}


/* =========================
   DOCTOR PERFORMANCE
========================= */

$doctorPerformance = [];

$sql = "
    SELECT
        d.doctor_id,
        u.first_name,
        u.last_name,
        dep.department_name,
        d.specialization,

        COUNT(a.appointment_id) AS total_appointments,

        SUM(
            CASE
                WHEN a.status = 'completed'
                THEN 1
                ELSE 0
            END
        ) AS completed,

        SUM(
            CASE
                WHEN a.status = 'cancelled'
                THEN 1
                ELSE 0
            END
        ) AS cancelled,

        SUM(
            CASE
                WHEN a.status = 'pending'
                THEN 1
                ELSE 0
            END
        ) AS pending

    FROM doctors d

    INNER JOIN users u
        ON d.user_id = u.user_id

    INNER JOIN departments dep
        ON d.department_id = dep.department_id

    LEFT JOIN appointments a
        ON d.doctor_id = a.doctor_id

    GROUP BY
        d.doctor_id,
        u.first_name,
        u.last_name,
        dep.department_name,
        d.specialization

    ORDER BY total_appointments DESC
";

$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {

        $total = (int)$row["total_appointments"];
        $completed = (int)$row["completed"];

        if ($total > 0) {
            $completionRate = round(($completed / $total) * 100);
        } else {
            $completionRate = 0;
        }

        /*
         * Performance classification
         */
        if ($completionRate >= 80) {
            $performance = "Excellent";
            $performanceClass = "excellent";
        } elseif ($completionRate >= 60) {
            $performance = "Good";
            $performanceClass = "good";
        } elseif ($completionRate >= 40) {
            $performance = "Average";
            $performanceClass = "average";
        } else {
            $performance = "Needs Attention";
            $performanceClass = "attention";
        }

        $row["completion_rate"] = $completionRate;
        $row["performance"] = $performance;
        $row["performance_class"] = $performanceClass;

        $doctorPerformance[] = $row;
    }
}


/* =========================
   OVERALL COMPLETION RATE
========================= */

if ($totalAppointments > 0) {
    $overallCompletionRate = round(
        ($completedAppointments / $totalAppointments) * 100
    );
} else {
    $overallCompletionRate = 0;
}

?>