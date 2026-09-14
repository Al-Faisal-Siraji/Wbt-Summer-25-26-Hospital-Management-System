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
   2. GET USER INFORMATION FROM DATABASE
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
   3. CHECK THAT USER IS A DOCTOR
   ========================================================= */

$db_role = strtolower(trim($user["role"]));

if ($db_role !== "doctor") {
    header("Location: router.php?page=login");
    exit();
}

/* Keep session role correct */
$_SESSION["role"] = "doctor";

$doctor_name = $user["first_name"] . " " . $user["last_name"];


/* =========================================================
   4. GET DOCTOR PROFILE
   ========================================================= */

$doctor_sql = "
    SELECT
        d.doctor_id,
        d.department_id,
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


/*
   If this user has a doctor account but no doctor profile
   yet, the dashboard will still open.
*/

$doctor_id = $doctor ? (int) $doctor["doctor_id"] : 0;

$specialization = $doctor["specialization"] ?? "Not assigned";
$department_name = $doctor["department_name"] ?? "Not assigned";
$consultation_fee = $doctor["consultation_fee"] ?? 0;
$availability = $doctor["availability_status"] ?? "unavailable";


/* =========================================================
   5. DASHBOARD STATISTICS
   ========================================================= */

$total_appointments = 0;
$today_appointments = 0;
$pending_appointments = 0;
$completed_appointments = 0;


/* Total appointments */

if ($doctor_id > 0) {

    $sql = "
        SELECT COUNT(*) AS total
        FROM appointments
        WHERE doctor_id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $total_appointments = (int) $row["total"];


    /* Today's appointments */

    $sql = "
        SELECT COUNT(*) AS total
        FROM appointments
        WHERE doctor_id = ?
        AND appointment_date = CURDATE()
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $today_appointments = (int) $row["total"];


    /* Pending appointments */

    $sql = "
        SELECT COUNT(*) AS total
        FROM appointments
        WHERE doctor_id = ?
        AND LOWER(status) IN ('pending', 'scheduled')
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $pending_appointments = (int) $row["total"];


    /* Completed appointments */

    $sql = "
        SELECT COUNT(*) AS total
        FROM appointments
        WHERE doctor_id = ?
        AND LOWER(status) = 'completed'
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $completed_appointments = (int) $row["total"];
}


/* =========================================================
   6. TODAY'S PATIENT QUEUE
   ========================================================= */

$today_queue = [];

if ($doctor_id > 0) {

    $queue_sql = "
        SELECT
            a.appointment_id,
            a.token_number,
            a.appointment_date,
            a.appointment_time,
            a.status,
            u.first_name,
            u.last_name,
            u.email
        FROM appointments a
        INNER JOIN users u
            ON a.patient_id = u.user_id
        WHERE a.doctor_id = ?
        AND a.appointment_date = CURDATE()
        ORDER BY
            a.token_number ASC,
            a.appointment_time ASC
    ";

    $queue_stmt = mysqli_prepare($conn, $queue_sql);
    mysqli_stmt_bind_param($queue_stmt, "i", $doctor_id);
    mysqli_stmt_execute($queue_stmt);

    $queue_result = mysqli_stmt_get_result($queue_stmt);

    while ($row = mysqli_fetch_assoc($queue_result)) {
        $today_queue[] = $row;
    }
}


/* =========================================================
   7. RECENT APPOINTMENTS
   ========================================================= */

$recent_appointments = [];

if ($doctor_id > 0) {

    $recent_sql = "
        SELECT
            a.appointment_id,
            a.appointment_date,
            a.appointment_time,
            a.token_number,
            a.status,
            u.first_name,
            u.last_name
        FROM appointments a
        INNER JOIN users u
            ON a.patient_id = u.user_id
        WHERE a.doctor_id = ?
        ORDER BY
            a.appointment_date DESC,
            a.appointment_time DESC
        LIMIT 5
    ";

    $recent_stmt = mysqli_prepare($conn, $recent_sql);
    mysqli_stmt_bind_param($recent_stmt, "i", $doctor_id);
    mysqli_stmt_execute($recent_stmt);

    $recent_result = mysqli_stmt_get_result($recent_stmt);

    while ($row = mysqli_fetch_assoc($recent_result)) {
        $recent_appointments[] = $row;
    }
}

?>