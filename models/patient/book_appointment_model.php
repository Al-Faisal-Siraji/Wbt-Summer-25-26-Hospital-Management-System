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


/* Check doctor ID */

if (
    !isset($_GET["doctor_id"]) ||
    empty($_GET["doctor_id"])
) {
    header("Location: doctors.php");
    exit();
}


$doctorId = (int) $_GET["doctor_id"];


/* Get selected doctor information */

$sql = "
    SELECT
        doctors.doctor_id,
        doctors.department_id,
        doctors.specialization,
        doctors.consultation_fee,
        doctors.availability_status,

        users.first_name,
        users.last_name,

        departments.department_name

    FROM doctors

    INNER JOIN users
        ON doctors.user_id = users.user_id

    INNER JOIN departments
        ON doctors.department_id = departments.department_id

    WHERE doctors.doctor_id = ?
";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, 
    "i",
    $doctorId
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


/* Check if doctor exists */

if (mysqli_num_rows($result) === 0) {

    header("Location: doctors.php");
    exit();

}


$doctor = mysqli_fetch_assoc($result);


/* Check availability */

if ($doctor["availability_status"] !== "available") {

    header("Location: doctors.php");
    exit();

}


/* Appointment booking */

$message = "";
$messageType = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $appointmentDate = $_POST["appointment_date"];


    /* Prevent booking for past dates */

    if ($appointmentDate < date("Y-m-d")) {

        $message = "You cannot select a past date.";

        $messageType = "error";

    } else {


        /*
           GENERATE TOKEN NUMBER

           Count appointments for this doctor
           on the selected date.

           Example:
           0 appointments → Token 1
           1 appointment  → Token 2
           2 appointments → Token 3
        */

        $tokenSql = "

            SELECT COUNT(*) AS total_appointments

            FROM appointments

            WHERE doctor_id = ?
            AND appointment_date = ?

        ";


        $tokenStmt = mysqli_prepare($conn, $tokenSql);


        mysqli_stmt_bind_param($tokenStmt, 

            "is",

            $doctorId,
            $appointmentDate

        );


        mysqli_stmt_execute($tokenStmt);


        $tokenResult = mysqli_stmt_get_result($tokenStmt);


        $tokenData = mysqli_fetch_assoc($tokenResult);


        $tokenNumber =

            $tokenData["total_appointments"] + 1;


        mysqli_stmt_close($tokenStmt);


        /*
           ASSIGN DEFAULT APPOINTMENT TIME

           Later we can create different time slots.
        */

        $appointmentTime = "10:00:00";


        /* Insert appointment */

        $insertSql = "

            INSERT INTO appointments (

                patient_id,
                doctor_id,
                department_id,
                appointment_date,
                appointment_time,
                token_number,
                status

            )

            VALUES (?, ?, ?, ?, ?, ?, 'scheduled')

        ";


        $insertStmt = mysqli_prepare($conn, $insertSql);


        $departmentId = $doctor["department_id"];


        mysqli_stmt_bind_param($insertStmt, 

            "iiissi",

            $patientId,
            $doctorId,
            $departmentId,
            $appointmentDate,
            $appointmentTime,
            $tokenNumber

        );


        if (mysqli_stmt_execute($insertStmt)) {


            $message =

                "Appointment booked successfully! Your token number is "

                . $tokenNumber

                . ".";


            $messageType = "success";


        } else {


            $message =

                "Something went wrong. Please try again.";


            $messageType = "error";

        }


        mysqli_stmt_close($insertStmt);


    }

}

?>