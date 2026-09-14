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


/* ===============================
   COUNT AVAILABLE DOCTORS
================================ */

$doctorSql = "
    SELECT COUNT(*) AS total_doctors
    FROM doctors
    WHERE availability_status = 'available'
";

$doctorResult = mysqli_query($conn, $doctorSql);

$doctorCount = 0;

if ($doctorResult) {

    $doctorData = mysqli_fetch_assoc($doctorResult);

    $doctorCount = $doctorData["total_doctors"];

}


/* ===============================
   GET UPCOMING APPOINTMENTS
================================ */

$appointmentSql = "

    SELECT

        appointments.appointment_id,
        appointments.appointment_date,
        appointments.appointment_time,
        appointments.token_number,
        appointments.status,

        doctors.doctor_id,
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

    AND appointments.appointment_date >= CURDATE()

    AND appointments.status IN (
        'scheduled',
        'confirmed'
    )

    ORDER BY
        appointments.appointment_date ASC,
        appointments.appointment_time ASC

";


$appointmentStmt = mysqli_prepare($conn, $appointmentSql);

mysqli_stmt_bind_param($appointmentStmt, 
    "i",
    $patientId
);

mysqli_stmt_execute($appointmentStmt);

$appointmentResult = mysqli_stmt_get_result($appointmentStmt);

$appointmentCount = mysqli_num_rows($appointmentResult);


/* Get the nearest appointment */

$nextAppointment = null;

if ($appointmentCount > 0) {

    $nextAppointment = mysqli_fetch_assoc($appointmentResult);

}


/* ===============================
   GET QUEUE INFORMATION
================================ */

$patientsAhead = 0;

if (
    $nextAppointment !== null &&
    $nextAppointment["token_number"] !== null
) {

    $queueSql = "

        SELECT COUNT(*) AS patients_ahead

        FROM appointments

        WHERE doctor_id = ?

        AND appointment_date = ?

        AND token_number < ?

        AND status IN (
            'scheduled',
            'confirmed'
        )

    ";

    $queueStmt = mysqli_prepare($conn, $queueSql);

    mysqli_stmt_bind_param($queueStmt, 
        "isi",
        $nextAppointment["doctor_id"],
        $nextAppointment["appointment_date"],
        $nextAppointment["token_number"]
    );

    mysqli_stmt_execute($queueStmt);

    $queueResult = mysqli_stmt_get_result($queueStmt);

    $queueData = mysqli_fetch_assoc($queueResult);

    $patientsAhead = $queueData["patients_ahead"];

    mysqli_stmt_close($queueStmt);

}


/* ===============================
   CHECKUP HISTORY COUNT
================================ */

$historySql = "

    SELECT COUNT(*) AS total_history

    FROM appointments

    WHERE patient_id = ?

    AND status = 'completed'

";

$historyStmt = mysqli_prepare($conn, $historySql);

mysqli_stmt_bind_param($historyStmt, 
    "i",
    $patientId
);

mysqli_stmt_execute($historyStmt);

$historyResult = mysqli_stmt_get_result($historyStmt);

$historyData = mysqli_fetch_assoc($historyResult);

$historyCount = $historyData["total_history"];

?>