<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require_once BASE_PATH . "/views/partials/database.php";

/* =========================================================
   1. CHECK LOGIN
   ========================================================= */

if (!isset($_SESSION["user_id"])) {
    header("Location: router.php?page=login");
    exit();
}

$user_id = (int) $_SESSION["user_id"];


/* =========================================================
   2. GET USER
   ========================================================= */

$user_sql = "
    SELECT user_id, first_name, last_name, email, role
    FROM users
    WHERE user_id = ?
    LIMIT 1
";

$user_stmt = mysqli_prepare($conn, $user_sql);
mysqli_stmt_bind_param($user_stmt, "i", $user_id);
mysqli_stmt_execute($user_stmt);

$user_result = mysqli_stmt_get_result($user_stmt);
$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    session_destroy();
    header("Location: router.php?page=login");
    exit();
}


/* =========================================================
   3. CHECK DOCTOR ROLE
   ========================================================= */

$role = strtolower(trim($user["role"]));

if ($role !== "doctor") {
    header("Location: router.php?page=login");
    exit();
}

$_SESSION["role"] = "doctor";

$doctor_name = $user["first_name"] . " " . $user["last_name"];


/* =========================================================
   4. GET DOCTOR PROFILE
   ========================================================= */

$doctor_sql = "
    SELECT
        d.doctor_id,
        d.specialization,
        d.consultation_fee,
        d.availability_status,
        dep.department_name
    FROM doctors d
    LEFT JOIN departments dep
        ON d.department_id = dep.department_id
    WHERE d.user_id = ?
    LIMIT 1
";

$doctor_stmt = mysqli_prepare($conn, $doctor_sql);
mysqli_stmt_bind_param($doctor_stmt, "i", $user_id);
mysqli_stmt_execute($doctor_stmt);

$doctor_result = mysqli_stmt_get_result($doctor_stmt);
$doctor = mysqli_fetch_assoc($doctor_result);

if (!$doctor) {
    die("Doctor profile not found.");
}

$doctor_id = (int) $doctor["doctor_id"];


/* =========================================================
   5. UPDATE APPOINTMENT STATUS
   ========================================================= */

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["appointment_id"]) &&
        isset($_POST["new_status"])
    ) {

        $appointment_id = (int) $_POST["appointment_id"];
        $new_status = strtolower(trim($_POST["new_status"]));

        $allowed_statuses = [
            "pending",
            "scheduled",
            "completed",
            "cancelled"
        ];

        if (in_array($new_status, $allowed_statuses, true)) {

            $update_sql = "
                UPDATE appointments
                SET status = ?
                WHERE appointment_id = ?
                AND doctor_id = ?
            ";

            $update_stmt = mysqli_prepare($conn, $update_sql);

            mysqli_stmt_bind_param($update_stmt, 
                "sii",
                $new_status,
                $appointment_id,
                $doctor_id
            );

            if (mysqli_stmt_execute($update_stmt)) {

                $message = "Appointment status updated successfully.";
                $message_type = "success";

            } else {

                $message = "Unable to update appointment.";
                $message_type = "error";
            }
        }
    }
}


/* =========================================================
   6. FILTER
   ========================================================= */

$filter = "all";

if (isset($_GET["filter"])) {
    $filter = strtolower(trim($_GET["filter"]));
}

$allowed_filters = [
    "all",
    "today",
    "upcoming",
    "completed",
    "cancelled"
];

if (!in_array($filter, $allowed_filters, true)) {
    $filter = "all";
}


/* =========================================================
   7. BUILD APPOINTMENT QUERY
   ========================================================= */

$appointment_sql = "
    SELECT
        a.appointment_id,
        a.appointment_date,
        a.appointment_time,
        a.token_number,
        a.status,
        u.first_name,
        u.last_name,
        u.email
    FROM appointments a
    INNER JOIN users u
        ON a.patient_id = u.user_id
    WHERE a.doctor_id = ?
";

if ($filter === "today") {

    $appointment_sql .= "
        AND a.appointment_date = CURDATE()
    ";

} elseif ($filter === "upcoming") {

    $appointment_sql .= "
        AND a.appointment_date >= CURDATE()
        AND LOWER(a.status) NOT IN ('completed', 'cancelled')
    ";

} elseif ($filter === "completed") {

    $appointment_sql .= "
        AND LOWER(a.status) = 'completed'
    ";

} elseif ($filter === "cancelled") {

    $appointment_sql .= "
        AND LOWER(a.status) = 'cancelled'
    ";
}

$appointment_sql .= "
    ORDER BY
        a.appointment_date DESC,
        a.appointment_time ASC
";


/* =========================================================
   8. GET APPOINTMENTS
   ========================================================= */

$appointment_stmt = mysqli_prepare($conn, $appointment_sql);
mysqli_stmt_bind_param($appointment_stmt, "i", $doctor_id);
mysqli_stmt_execute($appointment_stmt);

$appointment_result = mysqli_stmt_get_result($appointment_stmt);

$appointments = [];

while ($row = mysqli_fetch_assoc($appointment_result)) {
    $appointments[] = $row;
}


/* =========================================================
   9. STATISTICS
   ========================================================= */

$today_count = 0;
$upcoming_count = 0;
$completed_count = 0;
$cancelled_count = 0;

$count_sql = "
    SELECT
        SUM(
            CASE
                WHEN appointment_date = CURDATE()
                THEN 1 ELSE 0
            END
        ) AS today_count,

        SUM(
            CASE
                WHEN appointment_date >= CURDATE()
                AND LOWER(status) NOT IN ('completed', 'cancelled')
                THEN 1 ELSE 0
            END
        ) AS upcoming_count,

        SUM(
            CASE
                WHEN LOWER(status) = 'completed'
                THEN 1 ELSE 0
            END
        ) AS completed_count,

        SUM(
            CASE
                WHEN LOWER(status) = 'cancelled'
                THEN 1 ELSE 0
            END
        ) AS cancelled_count

    FROM appointments
    WHERE doctor_id = ?
";

$count_stmt = mysqli_prepare($conn, $count_sql);
mysqli_stmt_bind_param($count_stmt, "i", $doctor_id);
mysqli_stmt_execute($count_stmt);

$count_result = mysqli_stmt_get_result($count_stmt);
$count_row = mysqli_fetch_assoc($count_result);

$today_count = (int) ($count_row["today_count"] ?? 0);
$upcoming_count = (int) ($count_row["upcoming_count"] ?? 0);
$completed_count = (int) ($count_row["completed_count"] ?? 0);
$cancelled_count = (int) ($count_row["cancelled_count"] ?? 0);

?>