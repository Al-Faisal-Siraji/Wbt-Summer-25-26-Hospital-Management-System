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
   5. HANDLE STATUS UPDATE
   ========================================================= */

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["appointment_id"], $_POST["new_status"])) {

        $appointment_id = (int) $_POST["appointment_id"];
        $new_status = strtolower(trim($_POST["new_status"]));

        $allowed_statuses = [
            "pending",
            "scheduled",
            "completed",
            "cancelled"
        ];

        if (in_array($new_status, $allowed_statuses, true)) {

            /*
             * Update only appointments belonging
             * to this doctor.
             */

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
                $message = "Unable to update appointment status.";
                $message_type = "error";
            }
        }
    }
}


/* =========================================================
   6. GET TODAY'S QUEUE
   ========================================================= */

$queue = [];

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
    $queue[] = $row;
}


/* =========================================================
   7. QUEUE STATISTICS
   ========================================================= */

$total_today = count($queue);
$waiting = 0;
$completed = 0;
$cancelled = 0;

foreach ($queue as $appointment) {

    $status = strtolower(trim($appointment["status"]));

    if ($status === "completed") {
        $completed++;
    }

    elseif ($status === "cancelled") {
        $cancelled++;
    }

    elseif (
        $status === "pending" ||
        $status === "scheduled"
    ) {
        $waiting++;
    }
}


/* =========================================================
   8. FIND CURRENT PATIENT
   ========================================================= */

$current_patient = null;

foreach ($queue as $appointment) {

    $status = strtolower(trim($appointment["status"]));

    if (
        $status === "pending" ||
        $status === "scheduled"
    ) {
        $current_patient = $appointment;
        break;
    }
}

?>