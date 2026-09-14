<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* Check if the user is logged in as a patient */
if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "patient"
) {
    header("Location: router.php?page=login");
    exit();
}

/* Get patient information */
$patientId = $_SESSION["user_id"];
$firstName = $_SESSION["first_name"];

/* Connect to database */
require_once BASE_PATH . "/views/partials/database.php";


/* =========================================
   GET ALL PATIENT APPOINTMENTS
========================================= */

$sql = "
    SELECT
        appointments.appointment_id,
        appointments.appointment_date,
        appointments.appointment_time,
        appointments.token_number,
        appointments.status,

        doctors.specialization,
        doctors.consultation_fee,

        users.first_name AS doctor_first_name,
        users.last_name AS doctor_last_name,

        departments.department_name

    FROM appointments

    INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id

    INNER JOIN users
        ON doctors.user_id = users.user_id

    INNER JOIN departments
        ON appointments.department_id = departments.department_id

    WHERE appointments.patient_id = ?

    ORDER BY appointments.appointment_date DESC
";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, 
    "i",
    $patientId
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>