<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

/* ===============================
   CHECK RECEPTIONIST LOGIN
================================ */

if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "receptionist"
) {
    header("Location: router.php?page=login");
    exit();
}


/* ===============================
   DATABASE CONNECTION
================================ */

require_once BASE_PATH . "/views/partials/database.php";


/* ===============================
   UPDATE APPOINTMENT STATUS
================================ */

$message = "";

if (
    isset($_GET["action"]) &&
    isset($_GET["id"])
) {

    $appointmentId = (int) $_GET["id"];

    $action = $_GET["action"];


    if (
        $action === "confirm" ||
        $action === "complete" ||
        $action === "cancel"
    ) {

        if ($action === "confirm") {

            $newStatus = "confirmed";

        } elseif ($action === "complete") {

            $newStatus = "completed";

        } else {

            $newStatus = "cancelled";

        }


        $updateSql = "
            UPDATE appointments
            SET status = ?
            WHERE appointment_id = ?
        ";


        $updateStmt = mysqli_prepare($conn, $updateSql);


        mysqli_stmt_bind_param($updateStmt, 
            "si",
            $newStatus,
            $appointmentId
        );


        if (mysqli_stmt_execute($updateStmt)) {

            $message =
                "Appointment status updated successfully.";

        } else {

            $message =
                "Something went wrong while updating the appointment.";

        }


        mysqli_stmt_close($updateStmt);

    }

}


/* ===============================
   GET ALL APPOINTMENTS
================================ */

$sql = "

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

        doctors.specialization,

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

        appointments.appointment_date ASC,

        appointments.appointment_time ASC,

        appointments.token_number ASC

";


$result = mysqli_query($conn, $sql);

?>