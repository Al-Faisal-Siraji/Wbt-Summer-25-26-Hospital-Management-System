<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* =========================================
   ADMIN ACCESS CHECK
========================================= */

if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "admin"
) {
    header("Location: router.php?page=login");
    exit();
}


/* =========================================
   DATABASE CONNECTION
========================================= */

require_once BASE_PATH . "/views/partials/database.php";


/* =========================================
   ADMIN INFORMATION
========================================= */

$firstName = $_SESSION["first_name"];


/* =========================================
   TOTAL DOCTORS
========================================= */

$doctorSql = "
    SELECT COUNT(*) AS total_doctors
    FROM doctors
";

$doctorResult = mysqli_query($conn, $doctorSql);

$totalDoctors = 0;

if ($doctorResult) {

    $doctorData = mysqli_fetch_assoc($doctorResult);

    $totalDoctors = $doctorData["total_doctors"];

}


/* =========================================
   TOTAL PATIENTS
========================================= */

$patientSql = "
    SELECT COUNT(*) AS total_patients
    FROM users
    WHERE role = 'patient'
";

$patientResult = mysqli_query($conn, $patientSql);

$totalPatients = 0;

if ($patientResult) {

    $patientData = mysqli_fetch_assoc($patientResult);

    $totalPatients = $patientData["total_patients"];

}


/* =========================================
   TOTAL APPOINTMENTS
========================================= */

$appointmentSql = "
    SELECT COUNT(*) AS total_appointments
    FROM appointments
";

$appointmentResult = mysqli_query($conn, $appointmentSql);

$totalAppointments = 0;

if ($appointmentResult) {

    $appointmentData = mysqli_fetch_assoc($appointmentResult);

    $totalAppointments =
        $appointmentData["total_appointments"];

}


/* =========================================
   TOTAL DEPARTMENTS
========================================= */

$departmentSql = "
    SELECT COUNT(*) AS total_departments
    FROM departments
";

$departmentResult = mysqli_query($conn, $departmentSql);

$totalDepartments = 0;

if ($departmentResult) {

    $departmentData =
        mysqli_fetch_assoc($departmentResult);

    $totalDepartments =
        $departmentData["total_departments"];

}


/* =========================================
   RECENT APPOINTMENTS
========================================= */

$recentSql = "

    SELECT

        appointments.appointment_id,
        appointments.appointment_date,
        appointments.appointment_time,
        appointments.status,

        patients.first_name AS patient_first_name,
        patients.last_name AS patient_last_name,

        doctorsUser.first_name AS doctor_first_name,
        doctorsUser.last_name AS doctor_last_name,

        departments.department_name

    FROM appointments

    INNER JOIN users AS patients
        ON appointments.patient_id = patients.user_id

    INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id

    INNER JOIN users AS doctorsUser
        ON doctors.user_id = doctorsUser.user_id

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