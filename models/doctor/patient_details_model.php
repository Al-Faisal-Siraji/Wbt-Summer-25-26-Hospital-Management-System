<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
require_once BASE_PATH . "/views/partials/database.php";

/* =========================
   DOCTOR AUTHENTICATION
========================= */

if (!isset($_SESSION['user_id'])) {
    header("Location: router.php?page=login");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Check logged-in user role */
$stmt = mysqli_prepare($conn, "SELECT user_id, first_name, last_name, email, role 
                        FROM users 
                        WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$user_result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($user_result);

if (!$user || strtolower(trim($user['role'])) !== 'doctor') {
    header("Location: router.php?page=login");
    exit();
}

/* =========================
   GET DOCTOR PROFILE
========================= */

$stmt = mysqli_prepare($conn, "
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
");

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$doctor_result = mysqli_stmt_get_result($stmt);
$doctor = mysqli_fetch_assoc($doctor_result);

if (!$doctor) {
    die("Doctor profile not found.");
}

$doctor_id = $doctor['doctor_id'];

/* =========================
   GET PATIENT ID
========================= */

if (!isset($_GET['patient_id']) || !is_numeric($_GET['patient_id'])) {
    header("Location: doctor_patients.php");
    exit();
}

$patient_id = intval($_GET['patient_id']);

/* =========================
   GET PATIENT INFORMATION
   Only allow patients who
   have an appointment with
   this doctor.
========================= */

$stmt = mysqli_prepare($conn, "
    SELECT 
        u.user_id,
        u.first_name,
        u.last_name,
        u.email,
        u.created_at
    FROM users u
    WHERE u.user_id = ?
      AND u.role = 'patient'
      AND EXISTS (
          SELECT 1
          FROM appointments a
          WHERE a.patient_id = ?
            AND a.doctor_id = ?
      )
");

mysqli_stmt_bind_param($stmt, "iii", $patient_id, $patient_id, $doctor_id);
mysqli_stmt_execute($stmt);

$patient_result = mysqli_stmt_get_result($stmt);
$patient = mysqli_fetch_assoc($patient_result);

if (!$patient) {
    die("Patient not found or you do not have access to this patient.");
}

/* =========================
   APPOINTMENT HISTORY
========================= */

$stmt = mysqli_prepare($conn, "
    SELECT
        a.appointment_id,
        a.appointment_date,
        a.appointment_time,
        a.token_number,
        a.status,
        dep.department_name,
        d.specialization
    FROM appointments a
    INNER JOIN doctors d
        ON a.doctor_id = d.doctor_id
    LEFT JOIN departments dep
        ON d.department_id = dep.department_id
    WHERE a.patient_id = ?
      AND a.doctor_id = ?
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
");

mysqli_stmt_bind_param($stmt, "ii", $patient_id, $doctor_id);
mysqli_stmt_execute($stmt);

$history_result = mysqli_stmt_get_result($stmt);

/* =========================
   PATIENT STATISTICS
========================= */

$total_visits = 0;
$completed_visits = 0;
$pending_visits = 0;
$cancelled_visits = 0;

$appointments = [];

while ($row = mysqli_fetch_assoc($history_result)) {

    $appointments[] = $row;

    $total_visits++;

    if ($row['status'] === 'completed') {
        $completed_visits++;
    }

    if ($row['status'] === 'pending' || $row['status'] === 'scheduled') {
        $pending_visits++;
    }

    if ($row['status'] === 'cancelled') {
        $cancelled_visits++;
    }
}
?>