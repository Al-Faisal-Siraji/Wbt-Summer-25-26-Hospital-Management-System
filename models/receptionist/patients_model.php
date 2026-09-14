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
   GET ALL PATIENTS
================================ */

$patientSql = "

    SELECT
        users.user_id,
        users.first_name,
        users.last_name,
        users.email,
        users.created_at,

        COUNT(appointments.appointment_id) AS total_appointments

    FROM users

    LEFT JOIN appointments
        ON users.user_id = appointments.patient_id

    WHERE users.role = 'patient'

    GROUP BY
        users.user_id,
        users.first_name,
        users.last_name,
        users.email,
        users.created_at

    ORDER BY users.created_at DESC

";

$patientResult = mysqli_query($conn, $patientSql);


/* ===============================
   TOTAL PATIENTS
================================ */

$countSql = "

    SELECT COUNT(*) AS total_patients
    FROM users
    WHERE role = 'patient'

";

$countResult = mysqli_query($conn, $countSql);

$totalPatients = 0;

if ($countResult) {

    $countData = mysqli_fetch_assoc($countResult);

    $totalPatients = $countData["total_patients"];

}

?>