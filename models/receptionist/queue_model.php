<?php

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

if (
    !isset($_SESSION["user_id"]) ||
    $_SESSION["role"] !== "receptionist"
) {
    header("Location: router.php?page=login");
    exit();
}

require_once BASE_PATH . "/views/partials/database.php";

$firstName = $_SESSION["first_name"];

/*
|--------------------------------------------------------------------------
| SELECT DATE
|--------------------------------------------------------------------------
| By default, today's date is selected.
| The receptionist can choose another date for testing or management.
*/

$selectedDate = isset($_GET["date"]) && !empty($_GET["date"])
    ? $_GET["date"]
    : date("Y-m-d");


/*
|--------------------------------------------------------------------------
| HANDLE QUEUE STATUS UPDATE
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $appointmentId = isset($_POST["appointment_id"])
        ? intval($_POST["appointment_id"])
        : 0;

    $newStatus = isset($_POST["status"])
        ? $_POST["status"]
        : "";

    $allowedStatuses = [
        "scheduled",
        "waiting",
        "calling",
        "in_consultation",
        "completed",
        "skipped"
    ];

    if (
        $appointmentId > 0 &&
        in_array($newStatus, $allowedStatuses)
    ) {

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

        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);
    }

    header(
        "Location: receptionist_queue.php?date=" .
        urlencode($selectedDate)
    );

    exit();
}


/*
|--------------------------------------------------------------------------
| GET QUEUE FOR SELECTED DATE
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        appointments.appointment_id,
        appointments.appointment_date,
        appointments.appointment_time,
        appointments.token_number,
        appointments.status,

        patients.first_name AS patient_first_name,
        patients.last_name AS patient_last_name,

        doctor_users.first_name AS doctor_first_name,
        doctor_users.last_name AS doctor_last_name,

        doctors.specialization,

        departments.department_name

    FROM appointments

    INNER JOIN users AS patients
        ON appointments.patient_id = patients.user_id

    INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id

    INNER JOIN users AS doctor_users
        ON doctors.user_id = doctor_users.user_id

    INNER JOIN departments
        ON appointments.department_id = departments.department_id

    WHERE appointments.appointment_date = ?

    ORDER BY
        appointments.token_number IS NULL ASC,
        appointments.token_number ASC,
        appointments.appointment_time ASC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $selectedDate);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


/*
|--------------------------------------------------------------------------
| QUEUE STATISTICS
|--------------------------------------------------------------------------
*/

$totalPatients = 0;
$waitingPatients = 0;
$callingPatients = 0;
$completedPatients = 0;

$appointments = [];

while ($row = mysqli_fetch_assoc($result)) {

    $appointments[] = $row;

    $totalPatients++;

    if (
        $row["status"] === "waiting" ||
        $row["status"] === "scheduled"
    ) {
        $waitingPatients++;
    }

    if ($row["status"] === "calling") {
        $callingPatients++;
    }

    if ($row["status"] === "completed") {
        $completedPatients++;
    }
}

mysqli_stmt_close($stmt);


/*
|--------------------------------------------------------------------------
| CURRENTLY CALLING PATIENT
|--------------------------------------------------------------------------
*/

$currentPatient = null;

$currentSql = "
    SELECT
        appointments.token_number,
        patients.first_name AS patient_first_name,
        patients.last_name AS patient_last_name,
        doctor_users.first_name AS doctor_first_name,
        doctor_users.last_name AS doctor_last_name,
        departments.department_name

    FROM appointments

    INNER JOIN users AS patients
        ON appointments.patient_id = patients.user_id

    INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id

    INNER JOIN users AS doctor_users
        ON doctors.user_id = doctor_users.user_id

    INNER JOIN departments
        ON appointments.department_id = departments.department_id

    WHERE appointments.appointment_date = ?
    AND appointments.status = 'calling'

    ORDER BY appointments.token_number ASC

    LIMIT 1
";

$currentStmt = mysqli_prepare($conn, $currentSql);
mysqli_stmt_bind_param($currentStmt, "s", $selectedDate);
mysqli_stmt_execute($currentStmt);

$currentResult = mysqli_stmt_get_result($currentStmt);

if (mysqli_num_rows($currentResult) > 0) {
    $currentPatient = mysqli_fetch_assoc($currentResult);
}

mysqli_stmt_close($currentStmt);

?>