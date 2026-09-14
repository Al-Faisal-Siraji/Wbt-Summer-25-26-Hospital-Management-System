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

/* Get logged-in user */
$stmt = mysqli_prepare($conn, "
    SELECT user_id, first_name, last_name, email, role
    FROM users
    WHERE user_id = ?
");

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$user_result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($user_result);

if (!$user || strtolower(trim($user['role'])) !== 'doctor') {
    header("Location: router.php?page=login");
    exit();
}

/* =========================
   DOCTOR PROFILE
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
$followup_message = $_SESSION['followup_message'] ?? '';
unset($_SESSION['followup_message']);

/* =========================
   STATUS UPDATE
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {

    $followup_id = filter_input(INPUT_POST, 'followup_id', FILTER_VALIDATE_INT);
    $new_status = $_POST['status'] ?? '';

    $allowed_statuses = [
        'pending',
        'completed',
        'cancelled'
    ];

    if ($followup_id && in_array($new_status, $allowed_statuses, true)) {

        $stmt = mysqli_prepare($conn, "
            UPDATE doctor_followups
            SET status = ?
            WHERE followup_id = ?
              AND doctor_id = ?
        ");

        mysqli_stmt_bind_param($stmt, 
            "sii",
            $new_status,
            $followup_id,
            $doctor_id
        );

        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) === 1) {
            $_SESSION['followup_message'] = 'Follow-up status updated.';
        } else {
            $_SESSION['followup_message'] = 'Follow-up was not found or could not be updated.';
        }
    } else {
        $_SESSION['followup_message'] = 'Invalid follow-up status request.';
    }

    header("Location: doctor_followups.php");
    exit();
}

/* =========================
   DELETE FOLLOW-UP
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_followup'])) {

    $followup_id = filter_input(INPUT_POST, 'followup_id', FILTER_VALIDATE_INT);

    if (!$followup_id) {
        $_SESSION['followup_message'] = 'Invalid follow-up selected.';
        header("Location: doctor_followups.php");
        exit();
    }

    $stmt = mysqli_prepare($conn, "
        DELETE FROM doctor_followups
        WHERE followup_id = ?
          AND doctor_id = ?
    ");

    mysqli_stmt_bind_param($stmt, 
        "ii",
        $followup_id,
        $doctor_id
    );

    if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) === 1) {
        $_SESSION['followup_message'] = 'Follow-up deleted.';
    } else {
        $_SESSION['followup_message'] = 'Follow-up was not found or could not be deleted.';
    }

    header("Location: doctor_followups.php");
    exit();
}

/* =========================
   ADD FOLLOW-UP
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_followup'])) {

    $patient_id = filter_input(INPUT_POST, 'patient_id', FILTER_VALIDATE_INT);
    $followup_date = trim($_POST['followup_date'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
    $date_timestamp = strtotime($followup_date);

    if (!$patient_id || $date_timestamp === false || date('Y-m-d', $date_timestamp) !== $followup_date || $followup_date < date('Y-m-d')) {
        $_SESSION['followup_message'] = 'Choose a patient and a valid follow-up date.';
        header("Location: doctor_followups.php");
        exit();
    }

    /*
       Check that this patient has
       an appointment with this doctor.
    */

    $stmt = mysqli_prepare($conn, "
        SELECT appointment_id
        FROM appointments
        WHERE patient_id = ?
          AND doctor_id = ?
        ORDER BY appointment_date DESC, appointment_time DESC
        LIMIT 1
    ");

    mysqli_stmt_bind_param($stmt, 
        "ii",
        $patient_id,
        $doctor_id
    );

    mysqli_stmt_execute($stmt);

    $appointment_result = mysqli_stmt_get_result($stmt);
    $appointment = mysqli_fetch_assoc($appointment_result);

    if ($appointment) {

        $appointment_id = $appointment['appointment_id'];
        $status = 'pending';

        $stmt = mysqli_prepare($conn, "
            INSERT INTO doctor_followups
            (
                doctor_id,
                patient_id,
                appointment_id,
                followup_date,
                notes,
                status
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        mysqli_stmt_bind_param($stmt, 
            "iiisss",
            $doctor_id,
            $patient_id,
            $appointment_id,
            $followup_date,
            $notes,
            $status
        );

        $_SESSION['followup_message'] = mysqli_stmt_execute($stmt)
            ? 'Follow-up scheduled successfully.'
            : 'Could not save the follow-up. Please try again.';
    } else {
        $_SESSION['followup_message'] = 'Select a patient who has an appointment with you.';
    }

    header("Location: doctor_followups.php");
    exit();
}

/* =========================
   GET DOCTOR'S PATIENTS
========================= */

$patients = [];

$stmt = mysqli_prepare($conn, "
    SELECT DISTINCT
        u.user_id,
        u.first_name,
        u.last_name,
        u.email
    FROM users u
    INNER JOIN appointments a
        ON u.user_id = a.patient_id
    WHERE u.role = 'patient'
      AND a.doctor_id = ?
    ORDER BY u.first_name, u.last_name
");

mysqli_stmt_bind_param($stmt, "i", $doctor_id);
mysqli_stmt_execute($stmt);

$patient_result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($patient_result)) {
    $patients[] = $row;
}

/* =========================
   GET FOLLOW-UPS
========================= */

$followups = [];

$stmt = mysqli_prepare($conn, "
    SELECT
        f.followup_id,
        f.followup_date,
        f.notes,
        f.status,

        u.first_name,
        u.last_name,
        u.email,

        a.appointment_date,
        a.token_number

    FROM doctor_followups f

    INNER JOIN users u
        ON f.patient_id = u.user_id

    LEFT JOIN appointments a
        ON f.appointment_id = a.appointment_id

    WHERE f.doctor_id = ?

    ORDER BY
        f.followup_date ASC,
        f.created_at DESC
");

mysqli_stmt_bind_param($stmt, "i", $doctor_id);
mysqli_stmt_execute($stmt);

$followup_result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($followup_result)) {
    $followups[] = $row;
}

/* =========================
   STATISTICS
========================= */

$total_followups = 0;
$pending_followups = 0;
$completed_followups = 0;
$cancelled_followups = 0;

foreach ($followups as $followup) {

    $total_followups++;

    if ($followup['status'] === 'pending') {
        $pending_followups++;
    }

    if ($followup['status'] === 'completed') {
        $completed_followups++;
    }

    if ($followup['status'] === 'cancelled') {
        $cancelled_followups++;
    }
}

?>