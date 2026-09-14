<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* Check if user is logged in as receptionist */

if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "receptionist"
) {
    header("Location: router.php?page=login");
    exit();
}


/* Get receptionist information */

$firstName = $_SESSION["first_name"];


/* Database connection */

require_once BASE_PATH . "/views/partials/database.php";


/* ===============================
   TOTAL APPOINTMENTS
================================ */

$appointmentSql = "
    SELECT COUNT(*) AS total_appointments
    FROM appointments
";

$appointmentResult = mysqli_query($conn, $appointmentSql);

$appointmentCount = 0;

if ($appointmentResult) {

    $appointmentData =
        mysqli_fetch_assoc($appointmentResult);

    $appointmentCount =
        $appointmentData["total_appointments"];

}


/* ===============================
   TODAY'S APPOINTMENTS
================================ */

$todaySql = "
    SELECT COUNT(*) AS total_today
    FROM appointments
    WHERE appointment_date = CURDATE()
";

$todayResult = mysqli_query($conn, $todaySql);

$todayCount = 0;

if ($todayResult) {

    $todayData =
        mysqli_fetch_assoc($todayResult);

    $todayCount =
        $todayData["total_today"];

}


/* ===============================
   TOTAL PATIENTS
================================ */

$patientSql = "
    SELECT COUNT(*) AS total_patients
    FROM users
    WHERE role = 'patient'
";

$patientResult = mysqli_query($conn, $patientSql);

$patientCount = 0;

if ($patientResult) {

    $patientData =
        mysqli_fetch_assoc($patientResult);

    $patientCount =
        $patientData["total_patients"];

}


/* ===============================
   TOTAL DOCTORS
================================ */

$doctorSql = "
    SELECT COUNT(*) AS total_doctors
    FROM doctors
    WHERE availability_status = 'available'
";

$doctorResult = mysqli_query($conn, $doctorSql);

$doctorCount = 0;

if ($doctorResult) {

    $doctorData =
        mysqli_fetch_assoc($doctorResult);

    $doctorCount =
        $doctorData["total_doctors"];

}


/* ===============================
   RECENT APPOINTMENTS
================================ */

$recentSql = "

    SELECT

        appointments.appointment_id,
        appointments.appointment_date,
        appointments.appointment_time,
        appointments.token_number,
        appointments.status,

        patients.first_name
            AS patient_first_name,

        patients.last_name
            AS patient_last_name,

        doctors_users.first_name
            AS doctor_first_name,

        doctors_users.last_name
            AS doctor_last_name,

        departments.department_name

    FROM appointments

    INNER JOIN users AS patients

        ON appointments.patient_id =
           patients.user_id

    INNER JOIN doctors

        ON appointments.doctor_id =
           doctors.doctor_id

    INNER JOIN users AS doctors_users

        ON doctors.user_id =
           doctors_users.user_id

    INNER JOIN departments

        ON appointments.department_id =
           departments.department_id

    ORDER BY

        appointments.appointment_date DESC,
        appointments.appointment_time DESC

    LIMIT 5

";

$recentResult = mysqli_query($conn, $recentSql);

?>