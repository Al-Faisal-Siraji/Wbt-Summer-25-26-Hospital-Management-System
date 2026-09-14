<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* Check if patient is logged in */

if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "patient"
) {
    header("Location: router.php?page=login");
    exit();
}


/* Database connection */

require_once BASE_PATH . "/views/partials/database.php";


/* Get patient information */

$patientId = $_SESSION["user_id"];

$firstName = $_SESSION["first_name"];


/* ==============================
   GET ACTIVE APPOINTMENT
============================== */

$sql = "

    SELECT

        appointments.appointment_id,

        appointments.appointment_date,

        appointments.appointment_time,

        appointments.token_number,

        appointments.status,

        doctors.doctor_id,

        doctors.specialization,

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

        appointments.token_number ASC,

        appointments.appointment_time ASC

    LIMIT 1

";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, 
    "i",
    $patientId
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$appointment = null;


if (mysqli_num_rows($result) > 0) {

    $appointment = mysqli_fetch_assoc($result);

}


/* ==============================
   GET CURRENT QUEUE POSITION
============================== */

$patientsAhead = 0;


if (
    $appointment !== null &&
    !empty($appointment["token_number"])
) {


    $queueSql = "

        SELECT

            COUNT(*) AS patients_ahead

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

        $appointment["doctor_id"],

        $appointment["appointment_date"],

        $appointment["token_number"]

    );


    mysqli_stmt_execute($queueStmt);


    $queueResult = mysqli_stmt_get_result($queueStmt);


    $queueData = mysqli_fetch_assoc($queueResult);


    $patientsAhead = $queueData["patients_ahead"];


    mysqli_stmt_close($queueStmt);

}


/* Close appointment query */

mysqli_stmt_close($stmt);

?>